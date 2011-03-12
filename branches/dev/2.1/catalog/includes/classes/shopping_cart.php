<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

//   adapted for Separate Pricing Per Customer v4.2 2008/03/07, Hide products and categories from groups 2008/08/03

  class shoppingCart {
    var $contents, $total, $weight, $cartID, $content_type;

// LINE ADDED: MOD - indvship
var $shiptotal;

    function shoppingCart() {
      $this->reset();
    }

    function restore_contents() {
// BOF - MOD: CREDIT CLASS Gift Voucher Contribution
//    global $customer_id;
      global $customer_id, $gv_id, $REMOTE_ADDR, $languages_id; // languages_id needed for PriceFormatter - QPBPP
// EOF - MOD: CREDIT CLASS Gift Voucher Contribution

      if (!tep_session_is_registered('customer_id')) return false;

// insert current cart contents in database
      if (is_array($this->contents)) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
          $qty = $this->contents[$products_id]['qty'];

// BOF QPBPP for SPPC adjust quantity blocks and min_order_qty for this customer group
// warnings about this are raised in PriceFormatter
      $pf = new PriceFormatter;
      $pf->loadProduct(tep_get_prid($products_id), $languages_id);
      $qty = $pf->adjustQty($qty);
// EOF QPBPP for SPPC

          $product_query = tep_db_query("select products_id from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id) . "'");
          if (!tep_db_num_rows($product_query)) {
            tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET . " (customers_id, products_id, customers_basket_quantity, customers_basket_date_added) values ('" . (int)$customer_id . "', '" . tep_db_input($products_id) . "', '" . tep_db_input($qty) . "', '" . date('Ymd') . "')");
            if (isset($this->contents[$products_id]['attributes'])) {
              reset($this->contents[$products_id]['attributes']);
              while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
                tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " (customers_id, products_id, products_options_id, products_options_value_id) values ('" . (int)$customer_id . "', '" . tep_db_input($products_id) . "', '" . (int)$option . "', '" . (int)$value . "')");
              }
            }
          } else {
            tep_db_query("update " . TABLE_CUSTOMERS_BASKET . " set customers_basket_quantity = '" . tep_db_input($qty) . "' where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id) . "'");
          }
        }
// BOF - MOD: CREDIT CLASS Gift Voucher Contribution
        if (tep_session_is_registered('gv_id')) {
          $gv_query = tep_db_query("insert into  " . TABLE_COUPON_REDEEM_TRACK . " (coupon_id, customer_id, redeem_date, redeem_ip) values ('" . $gv_id . "', '" . (int)$customer_id . "', now(),'" . $REMOTE_ADDR . "')");
          $gv_update = tep_db_query("update " . TABLE_COUPONS . " set coupon_active = 'N' where coupon_id = '" . $gv_id . "'");
          tep_gv_account_update($customer_id, $gv_id);
          tep_session_unregister('gv_id');
        }
// EOF - MOD: CREDIT CLASS Gift Voucher Contribution
      }

// reset per-session cart contents, but not the database contents
      $this->reset(false);
// LINE MODED: QPBPP for SPPC v4.2$
// BOF QPBPP for SPPC
      $products_query = tep_db_query("select cb.products_id, ptdc.discount_categories_id, customers_basket_quantity from " . TABLE_CUSTOMERS_BASKET . " cb left join (select products_id, discount_categories_id from " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " where customers_group_id = '" . $this->cg_id . "') as ptdc on cb.products_id = ptdc.products_id where customers_id = '" . (int)$customer_id . "'");
      while ($products = tep_db_fetch_array($products_query)) {
        $this->contents[$products['products_id']] = array('qty' => $products['customers_basket_quantity'], 'discount_categories_id' => $products['discount_categories_id']);
// EOF QPBPP for SPPC

// attributes
        $attributes_query = tep_db_query("select products_options_id, products_options_value_id from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products['products_id']) . "'");
        while ($attributes = tep_db_fetch_array($attributes_query)) {
          $this->contents[$products['products_id']]['attributes'][$attributes['products_options_id']] = $attributes['products_options_value_id'];
        }
      }

      $this->cleanup();
// assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
      $this->cartID = $this->generate_cart_id();
    }

    function reset($reset_database = false) {
      global $customer_id;

      $this->contents = array();
      $this->total = 0;
      $this->weight = 0;

//LINE ADDED: MOD - indvship
      $this->shiptotal = 0;
      $this->content_type = false;

      if (tep_session_is_registered('customer_id') && ($reset_database == true)) {
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "'");
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "'");
      }

      unset($this->cartID);
      if (tep_session_is_registered('cartID')) tep_session_unregister('cartID');
    }

    function add_cart($products_id, $qty = '1', $attributes = '', $notify = true) {
      global $new_products_id_in_cart, $customer_id;

      $products_id_string = tep_get_uprid($products_id, $attributes);
      $products_id = tep_get_prid($products_id_string);

      if (defined('MAX_QTY_IN_CART') && (MAX_QTY_IN_CART > 0) && ((int)$qty > MAX_QTY_IN_CART)) {
        $qty = MAX_QTY_IN_CART;
      }

// BOF QPBPP for SPPC
      $pf = new PriceFormatter;
      $pf->loadProduct($products_id);
      $qty = $pf->adjustQty($qty);
      $discount_category = $pf->get_discount_category();
// EOF QPBPP for SPPC

      $attributes_pass_check = true;

      if (is_array($attributes)) {
        reset($attributes);
        while (list($option, $value) = each($attributes)) {
          if (!is_numeric($option) || !is_numeric($value)) {
            $attributes_pass_check = false;
            break;
          }
        }
      }

      if (is_numeric($products_id) && is_numeric($qty) && ($attributes_pass_check == true)) {
        $check_product_query = tep_db_query("select products_status from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
        $check_product = tep_db_fetch_array($check_product_query);

        if (($check_product !== false) && ($check_product['products_status'] == '1')) {
          if ($notify == true) {
            $new_products_id_in_cart = $products_id;
            tep_session_register('new_products_id_in_cart');
          }

// BOF QPBPP for SPPC
          if ($this->in_cart($products_id_string)) {
            $this->update_quantity($products_id_string, $qty, $attributes, $discount_category);
          } else {
            $this->contents[$products_id_string] = array('qty' => (int)$qty, 'discount_categories_id' => $discount_category);
// EOF QPBPP for SPPC

// insert into database
            if (tep_session_is_registered('customer_id')) tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET . " (customers_id, products_id, customers_basket_quantity, customers_basket_date_added) values ('" . (int)$customer_id . "', '" . tep_db_input($products_id_string) . "', '" . (int)$qty . "', '" . date('Ymd') . "')");

            if (is_array($attributes)) {
              reset($attributes);
              while (list($option, $value) = each($attributes)) {
                $this->contents[$products_id_string]['attributes'][$option] = $value;
// insert into database
                if (tep_session_is_registered('customer_id')) tep_db_query("insert into " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " (customers_id, products_id, products_options_id, products_options_value_id) values ('" . (int)$customer_id . "', '" . tep_db_input($products_id_string) . "', '" . (int)$option . "', '" . (int)$value . "')");
              }
            }
          }

          $this->cleanup();

// assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
          $this->cartID = $this->generate_cart_id();
        }
      }
    }

// BOF QPBPP for SPPC
    function update_quantity($products_id, $quantity = '', $attributes = '', $discount_categories_id = NULL) {
// EOF QPBPP for SPPC
      global $customer_id;

      $products_id_string = tep_get_uprid($products_id, $attributes);
      $products_id = tep_get_prid($products_id_string);

      if (defined('MAX_QTY_IN_CART') && (MAX_QTY_IN_CART > 0) && ((int)$quantity > MAX_QTY_IN_CART)) {
        $quantity = MAX_QTY_IN_CART;
      }

      $attributes_pass_check = true;

      if (is_array($attributes)) {
        reset($attributes);
        while (list($option, $value) = each($attributes)) {
          if (!is_numeric($option) || !is_numeric($value)) {
            $attributes_pass_check = false;
            break;
          }
        }
      }

      if (is_numeric($products_id) && isset($this->contents[$products_id_string]) && is_numeric($quantity) && ($attributes_pass_check == true)) {
// BOF QPBPP for SPPC
        $this->contents[$products_id_string] = array('qty' => (int)$quantity, 'discount_categories_id' => $discount_categories_id);
// EOF QPBPP for SPPC
// update database
        if (tep_session_is_registered('customer_id')) tep_db_query("update " . TABLE_CUSTOMERS_BASKET . " set customers_basket_quantity = '" . (int)$quantity . "' where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id_string) . "'");

        if (is_array($attributes)) {
          reset($attributes);
          while (list($option, $value) = each($attributes)) {
            $this->contents[$products_id_string]['attributes'][$option] = $value;
// update database
            if (tep_session_is_registered('customer_id')) tep_db_query("update " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " set products_options_value_id = '" . (int)$value . "' where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id_string) . "' and products_options_id = '" . (int)$option . "'");
          }
        }
      }
    }

    function cleanup() {
      global $customer_id;

      reset($this->contents);
      while (list($key,) = each($this->contents)) {
        if ($this->contents[$key]['qty'] < 1) {
          unset($this->contents[$key]);
// remove from database
          if (tep_session_is_registered('customer_id')) {
            tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($key) . "'");
            tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($key) . "'");
          }
        }
      }
    }

    function count_contents() {  // get total number of items in cart
      $total_items = 0;
      if (is_array($this->contents)) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
          $total_items += $this->get_quantity($products_id);
        }
      }

      return $total_items;
    }

    function get_quantity($products_id) {
      if (isset($this->contents[$products_id])) {
        return $this->contents[$products_id]['qty'];
      } else {
        return 0;
      }
    }

    function in_cart($products_id) {
      if (isset($this->contents[$products_id])) {
        return true;
      } else {
        return false;
      }
    }

    function remove($products_id) {
      global $customer_id;

      unset($this->contents[$products_id]);
// remove from database
      if (tep_session_is_registered('customer_id')) {
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id) . "'");
        tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . (int)$customer_id . "' and products_id = '" . tep_db_input($products_id) . "'");
      }

// assign a temporary unique ID to the order contents to prevent hack attempts during the checkout procedure
      $this->cartID = $this->generate_cart_id();
    }

    function remove_all() {
      $this->reset();
    }

    function get_product_id_list() {
      $product_id_list = '';
      if (is_array($this->contents)) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
          $product_id_list .= ', ' . $products_id;
        }
      }

      return substr($product_id_list, 2);
    }

    function calculate() {
      global $currencies, $languages_id, $pfs; // for QPBPP added: $languages_id, $pfs

//  LINE ADDED - MOD: CREDIT CLASS Gift Voucher Contribution
      $this->total_virtual = 0;

      $this->total = 0;
      $this->weight = 0;

// LINE ADDED: MOD - indvship
      $this->shiptotal = 0;
      if (!is_array($this->contents)) return 0;
        $discount_category_quantity = array(); // calculates no of items per discount category in shopping basket
      foreach ($this->contents as $products_id => $contents_array) {
          if(tep_not_null($contents_array['discount_categories_id'])) {
            if (!isset($discount_category_quantity[$contents_array['discount_categories_id']])) {
                $discount_category_quantity[$contents_array['discount_categories_id']] = $contents_array['qty'];
            } else {
                $discount_category_quantity[$contents_array['discount_categories_id']] += $contents_array['qty'];
            }
          }
      } // end foreach

   $pf = new PriceFormatter;
// EOF QPBPP for SPPC
// EOF: MOD - Separate Pricing Per Customer

      reset($this->contents);
      while (list($products_id, ) = each($this->contents)) {
        $qty = $this->contents[$products_id]['qty'];

// BOF QPBPP for SPPC
      if (tep_not_null($this->contents[$products_id]['discount_categories_id'])) {
        $nof_items_in_cart_same_cat = $discount_category_quantity[$this->contents[$products_id]['discount_categories_id']];
        $nof_other_items_in_cart_same_cat = $nof_items_in_cart_same_cat - $qty;
      } else {
          $nof_other_items_in_cart_same_cat = 0;
      }
// EOF QPBPP for SPPC

// BOF: MOD - Separate Pricing Per Customer
// global variable (session) $sppc_customer_group_id -> class variable cg_id
        global $sppc_customer_group_id;
        if(!tep_session_is_registered('sppc_customer_group_id')) {
          $this->cg_id = '0';
        } else {
          $this->cg_id = $sppc_customer_group_id;
        }
        // BOF QPBPP for SPPC



// LINE MOFIFIED - Added "products_ship_price"
        //$product_query = tep_db_query("select products_id, products_price, products_ins_price, products_ship_price, products_tax_class_id, products_weight from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
        $pf->loadProduct($products_id, $languages_id);
        //if ($product = tep_db_fetch_array($product_query)) {
        if ($product = $pfs->getPriceFormatterData($products_id)) {
// BOF - MOD: CREDIT CLASS Gift Voucher Contribution
          $no_count = 1;
          $gv_query = tep_db_query("select products_model from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
          $gv_result = tep_db_fetch_array($gv_query);
          if (preg_match('{^GIFT}', $gv_result['products_model'])) {
            $no_count = 0;
          }
// EOF - MOD: CREDIT CLASS Gift Voucher Contribution

          $prid = $product['products_id'];
          $products_tax = tep_get_tax_rate($product['products_tax_class_id']);
          $products_price = $pf->computePrice($qty, $nof_other_items_in_cart_same_cat);
          $products_weight = $product['products_weight'];
          $products_length = $product['products_length'];
          $products_width = $product['products_width'];
          $products_height = $product['products_height'];
          $products_ready_to_ship = $product['products_ready_to_ship'];
//LINE ADDED - mod indvship
          $products_ship_price = $product['products_ship_price'];

// BOF: MOD - Separate Price per Customer Mod - EDIT FOR QPBPP FOR SPPC V4.2
//          $specials_query = tep_db_query("select specials_new_products_price from " . TABLE_SPECIALS . " where products_id = '" . (int)$prid . "' and status = '1'");
//          if (tep_db_num_rows ($specials_query)) {
//            $specials = tep_db_fetch_array($specials_query);
//            $products_price = $specials['specials_new_products_price'];
//          }
/*          $specials_price = tep_get_products_special_price((int)$prid);
          if (tep_not_null($specials_price)) {
            $products_price = $specials_price;
          } elseif ($this->cg_id != 0){
            $customer_group_price_query = tep_db_query("select customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . (int)$prid . "' and customers_group_id =  '" . $this->cg_id . "'");
            if ($customer_group_price = tep_db_fetch_array($customer_group_price_query)) {
              $products_price = $customer_group_price['customers_group_price'];
            }
          }*/
// BOF - MOD: CREDIT CLASS Gift Voucher Contribution
          $this->total_virtual += tep_add_tax($products_price, $products_tax) * $qty * $no_count;// ICW CREDIT CLASS;

          $this->weight_virtual += ($qty * $products_weight) * $no_count;
// EOF - MOD: CREDIT CLASS Gift Voucher Contribution

          $this->total += $currencies->calculate_price($products_price, $products_tax, $qty);
// LINE ADDED: MOD - indvship
          $this->shiptotal += ($products_ship_price * $qty);
          $this->weight += ($qty * $products_weight);
        }

// attributes price
        if (isset($this->contents[$products_id]['attributes'])) {
          reset($this->contents[$products_id]['attributes']);
          while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
            // START: More Product Weight
            // $attribute_price_query = tep_db_query("select options_values_price, price_prefix, options_values_weight from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$prid . "' and options_id = '" . (int)$option . "' and options_values_id = '" . (int)$value . "'");
            $attribute_price_query = tep_db_query("select options_values_price, price_prefix, options_values_weight, weight_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$prid . "' and options_id = '" . (int)$option . "' and options_values_id = '" . (int)$value . "'");
            // END: More Product Weight
            $attribute_price = tep_db_fetch_array($attribute_price_query);
            if ($attribute_price['price_prefix'] == '+') {
              $this->total += $currencies->calculate_price($attribute_price['options_values_price'], $products_tax, $qty);
            } else {
              $this->total -= $currencies->calculate_price($attribute_price['options_values_price'], $products_tax, $qty);
            }
            // START: More Product Weight
            if ($attribute_price['weight_prefix'] == '+') {
              $this->weight += $qty * $attribute_price['options_values_weight'];
            } else {
              $this->weight -= $qty * $attribute_price['options_values_weight'];
            }
            // END: More Product Weight
          }
        }
      }
    }

    function attributes_price($products_id) {
      $attributes_price = 0;

      if (isset($this->contents[$products_id]['attributes'])) {
        reset($this->contents[$products_id]['attributes']);
        while (list($option, $value) = each($this->contents[$products_id]['attributes'])) {
          $attribute_price_query = tep_db_query("select options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$products_id . "' and options_id = '" . (int)$option . "' and options_values_id = '" . (int)$value . "'");
          $attribute_price = tep_db_fetch_array($attribute_price_query);
          if ($attribute_price['price_prefix'] == '+') {
            $attributes_price += $attribute_price['options_values_price'];
          } else {
            $attributes_price -= $attribute_price['options_values_price'];
          }
        }
      }

      return $attributes_price;
    }

    function get_products() {
      global $languages_id, $pfs; // PriceFormatterStore added;
// BOF Separate Pricing Per Customer
// global variable (session) $sppc_customer_group_id -> class variable cg_id
      global $sppc_customer_group_id;

      if(!tep_session_is_registered('sppc_customer_group_id')) {
        $this->cg_id = '0';
      } else {
        $this->cg_id = $sppc_customer_group_id;
      }
// EOF Separate Pricing Per Customer
      if (!is_array($this->contents)) return false;

// BOF QPBPP for SPPC
      $discount_category_quantity = array();
      foreach ($this->contents as $products_id => $contents_array) {
          if(tep_not_null($contents_array['discount_categories_id'])) {
            if (!isset($discount_category_quantity[$contents_array['discount_categories_id']])) {
                $discount_category_quantity[$contents_array['discount_categories_id']] = $contents_array['qty'];
            } else {
                $discount_category_quantity[$contents_array['discount_categories_id']] += $contents_array['qty'];
            }
          }
      } // end foreach

      $pf = new PriceFormatter;
// EOF QPBPP for SPPC

      $products_array = array();
      reset($this->contents);
      while (list($products_id, ) = each($this->contents)) {
// BOF QPBPP for SPPC
      $pf->loadProduct($products_id, $languages_id); // does query if necessary and adds to
      // PriceFormatterStore or gets info from it next
      if ($products = $pfs->getPriceFormatterData($products_id)) {
       if (tep_not_null($this->contents[$products_id]['discount_categories_id'])) {
          $nof_items_in_cart_same_cat =  $discount_category_quantity[$this->contents[$products_id]['discount_categories_id']];
          $nof_other_items_in_cart_same_cat = $nof_items_in_cart_same_cat - $this->contents[$products_id]['qty'];
        } else {
          $nof_other_items_in_cart_same_cat = 0;
        }
          $products_price = $pf->computePrice($this->contents[$products_id]['qty'], $nof_other_items_in_cart_same_cat);
// EOF QPBPP for SPPC
// BOF Attribute Product Codes
                $attribute_code_array = array();
                if (is_array($this->contents[$products_id]['attributes'])) {
                  $i = 0;
                  foreach ($this->contents[$products_id]['attributes'] as $attributes) {
                    $option = array_keys($this->contents[$products_id]['attributes']);
                    $value = $this->contents[$products_id]['attributes'];
                    $attribute_code_query = tep_db_query("select code_suffix, suffix_sort_order from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$products_id . "' and options_id = '" . (int)$option[$i] . "' and options_values_id = '" . (int)$value[$option[$i]] . "' order by suffix_sort_order ASC");
                    $attribute_code = tep_db_fetch_array($attribute_code_query);
                    if (tep_not_null($attribute_code['code_suffix'])) {
                      $attribute_code_array[(int)$attribute_code['suffix_sort_order']] = $attribute_code['code_suffix'];
                    } // end if
                    $i++;
                  } // end foreach

        $separator = '-';
    //  if (count($attribute_code_array) > 1) {
        //      $separator = '-';
        //} elseif (count($attribute_code_array) == 1) {
        //  $separator = '/';
        //}

                  $products_code = $products['products_model'] . $separator . implode("-", $attribute_code_array);
                } else {
                  $products_code = $products['products_model'];
                }
// EOF Attribute Product Codes
//        $products_array[] = array('id' => $products_id,
          $products_array[] = array('id' => tep_get_uprid($products_id, $this->contents[$products_id]['attributes']),
                                    'name' => $products['products_name'],
                                    'model' => $products['products_model'],
                                    'code' => $products_code,
                                    'image' => $products['products_image'],
// BOF QPBPP for SPPC
                                    'discount_categories_id' => $this->contents[$products_id]['discount_categories_id'],
// EOF QPBPP for SPPC
                                    'price' => $products_price,
                                    'quantity' => $this->contents[$products_id]['qty'],
                                    'weight' => $products['products_weight'],
                                    'length' => $products['products_length'],
                                    'width' => $products['products_width'],
                                    'height' => $products['products_height'],
                                    'ready_to_ship' => $products['products_ready_to_ship'],
                                    'final_price' => ($products_price + $this->attributes_price($products_id)),
                                    'tax_class_id' => $products['products_tax_class_id'],
                                    'attributes' => (isset($this->contents[$products_id]['attributes']) ? $this->contents[$products_id]['attributes'] : ''));
        }
      }

      return $products_array;
    }

    function show_total() {
      $this->calculate();

      return $this->total;
    }

// BOF: MOD - Separate item shipping
function get_shiptotal() {
    $this->calculate();

    return $this->shiptotal;
    }
// EOF: MOD - Separate item shipping

    function show_weight() {
      $this->calculate();

      return $this->weight;
    }

// BOF - MOD: CREDIT CLASS Gift Voucher Contribution
    function show_total_virtual() {
      $this->calculate();

      return $this->total_virtual;
    }

    function show_weight_virtual() {
      $this->calculate();

      return $this->weight_virtual;
    }
// EOF - MOD: CREDIT CLASS Gift Voucher Contribution

    function generate_cart_id($length = 5) {
      return tep_create_random_value($length, 'digits');
    }

    function get_content_type() {
      $this->content_type = false;

      if ( (DOWNLOAD_ENABLED == 'true') && ($this->count_contents() > 0) ) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
          if (isset($this->contents[$products_id]['attributes'])) {
            reset($this->contents[$products_id]['attributes']);
            while (list(, $value) = each($this->contents[$products_id]['attributes'])) {
              $virtual_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD . " pad where pa.products_id = '" . (int)$products_id . "' and pa.options_values_id = '" . (int)$value . "' and pa.products_attributes_id = pad.products_attributes_id");
              $virtual_check = tep_db_fetch_array($virtual_check_query);

              if ($virtual_check['total'] > 0) {
                switch ($this->content_type) {
                  case 'physical':
                    $this->content_type = 'mixed';

                    return $this->content_type;
                    break;
                  default:
                    $this->content_type = 'virtual';
                    break;
                }
              } else {
                switch ($this->content_type) {
                  case 'virtual':
                    $this->content_type = 'mixed';

                    return $this->content_type;
                    break;
                  default:
                    $this->content_type = 'physical';
                    break;
                }
              }
            }

// BOF - MOD: CREDIT CLASS Gift Voucher Contribution
          } elseif ($this->show_weight() == 0) {
            reset($this->contents);
            while (list($products_id, ) = each($this->contents)) {
              $virtual_check_query = tep_db_query("select products_weight from " . TABLE_PRODUCTS . " where products_id = '" . $products_id . "'");
              $virtual_check = tep_db_fetch_array($virtual_check_query);
              if ($virtual_check['products_weight'] == 0) {
                switch ($this->content_type) {
                  case 'physical':
                    $this->content_type = 'mixed';

                    return $this->content_type;
                    break;
                  default:
                    $this->content_type = 'virtual';
                    break;
                }
              } else {
                switch ($this->content_type) {
                  case 'virtual':
                    $this->content_type = 'mixed';

                    return $this->content_type;
                    break;
                  default:
                    $this->content_type = 'physical';
                    break;
                }
              }
            }
// EOF - MOD: CREDIT CLASS Gift Voucher Contribution

          } else {
            switch ($this->content_type) {
              case 'virtual':
                $this->content_type = 'mixed';

                return $this->content_type;
                break;
              default:
                $this->content_type = 'physical';
                break;
            }
          }
        }
      } else {
        $this->content_type = 'physical';
      }

      return $this->content_type;
    }

    function unserialize($broken) {
      for(reset($broken);$kv=each($broken);) {
        $key=$kv['key'];
        if (gettype($this->$key)!="user function")
        $this->$key=$kv['value'];
      }
    }

// BOF - MOD: CREDIT CLASS Gift Voucher Contribution
// amend count_contents to show nil contents for shipping
// as we don't want to quote for 'virtual' item
// GLOBAL CONSTANTS if NO_COUNT_ZERO_WEIGHT is true then we don't count any product with a weight
// which is less than or equal to MINIMUM_WEIGHT
// otherwise we just don't count gift certificates
    function count_contents_virtual() {  // get total number of items in cart disregard gift vouchers
      $total_items = 0;
      if (is_array($this->contents)) {
        reset($this->contents);
        while (list($products_id, ) = each($this->contents)) {
          $no_count = false;
          $gv_query = tep_db_query("select products_model from " . TABLE_PRODUCTS . " where products_id = '" . $products_id . "'");
          $gv_result = tep_db_fetch_array($gv_query);
          if (preg_match('/^GIFT/', $gv_result['products_model'])) {
            $no_count=true;
          }
          if (NO_COUNT_ZERO_WEIGHT == 1) {
            $gv_query = tep_db_query("select products_weight from " . TABLE_PRODUCTS . " where products_id = '" . tep_get_prid($products_id) . "'");
            $gv_result=tep_db_fetch_array($gv_query);
            if ($gv_result['products_weight']<=MINIMUM_WEIGHT) {
              $no_count=true;
            }
          }
          if (!$no_count) $total_items += $this->get_quantity($products_id);
        }
      }
      return $total_items;
    }
// EOF - MOD: CREDIT CLASS Gift Voucher Contribution
  }
?>