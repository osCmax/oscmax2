<?php
/* \
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

/*
   adapted for QPBPP for SPPC v 2.0 2008/11/08
   
   an object to store the price breaks and products_quantity of a product once queried by the 
   class PriceFormatter.php to avoid it being queried more than once and tep_get_stock to be executed
   for each product on the page shopping_cart.php
*/ 
   
class PriceFormatterStore {
  var $priceFormatterData = array();
  
  function PriceFormatterStore() {
    global $cart, $languages_id;
    $this->cg_id = $this->get_customer_group_id();

      if (is_object($cart)) {
        $product_id_list = $cart->get_product_id_list();
          if (tep_not_null($product_id_list)) {
// get rid of attributes first
            $product_id_list_array = array();
            $product_id_list_temp_array = explode(",", $product_id_list);
            foreach ($product_id_list_temp_array as $key => $value) {
// only add valid values: issue with the first value in the product id list
// being empty which gave an error in the next query [e.g. products_id in (,52,48)]
// on checkout
            $valid_value = tep_get_prid($value);
             if (tep_not_null($valid_value)) {
               $product_id_list_array[] = $valid_value;
             }
            }
            $product_id_list_array = array_unique($product_id_list_array);
            unset($product_id_list);
            $product_id_list = implode(",", $product_id_list_array);
// now do one query for all products in the shopping basket
   $sql = "select pd.products_name, p.products_model, p.products_image, p.products_id," .
   " p.manufacturers_id, p.products_price, p.products_weight, p.products_quantity," .
   " p.products_qty_blocks as qtyBlocks, p.products_min_order_qty, p.products_tax_class_id," .
   " NULL as specials_new_products_price," .
   " ptdc.discount_categories_id from " . TABLE_PRODUCTS . " p left join (select products_id, discount_categories_id from " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . "" .
   " where products_id in (" . $product_id_list . ") and customers_group_id = '" . $this->cg_id . "') as ptdc on " .
   " p.products_id = ptdc.products_id, " .
   " " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1'" .
   " and pd.products_id = p.products_id " .
   " and p.products_id in (" . $product_id_list . ")" .
   " and pd.language_id = '". (int)$languages_id ."'";

      $product_info_query = tep_db_query($sql);
      $no_of_listings = tep_db_num_rows($product_info_query);
         while ($_product_info = tep_db_fetch_array($product_info_query)) {
          $_product_info['price_breaks'] = array(); // filled later
          if ($this->cg_id != '0') {
// re-set qty blocks and min order qty to 1: do not use values for retail customers
             $_product_info['qtyBlocks'] = 1;
             $_product_info['products_min_order_qty'] = 1;
          }
          $product_info[] = $_product_info;
//  $this->addPriceFormatterData($product_info['products_id'], $product_info);
        } // end while ($_product_info = ...
// get all product prices for products with the particular customer_group_id
// however not necessary for customer group  0 (retail)
       if ($this->cg_id != '0') {
         $pg_query = tep_db_query("select pg.products_id, pg.customers_group_price, pg.products_qty_blocks as qtyBlocks, pg.products_min_order_qty from " . TABLE_PRODUCTS_GROUPS . " pg where " .
              " pg.products_id in (" . $product_id_list . ") and pg.customers_group_id = '" . $this->cg_id . "'");

         while ($pg_array = tep_db_fetch_array($pg_query)) {
           $new_prices[] = array ('products_id' => $pg_array['products_id'], 'products_price' => $pg_array['customers_group_price'], 
           'qtyBlocks' => $pg_array['qtyBlocks'],
           'products_min_order_qty' => $pg_array['products_min_order_qty']);
         }

           for ($x = 0; $x < $no_of_listings; $x++) {
// replace products prices with those from customers_group table
             if (!empty($new_prices)) {
               $no_of_new_prices = count($new_prices);
               for ($i = 0; $i < $no_of_new_prices ; $i++) {
                 if ($product_info[$x]['products_id'] == $new_prices[$i]['products_id'] ) {
// customer group price can be NULL so use retail if empty
                   if ((int)$new_prices[$i]['products_price'] > 0 ) {
                     $product_info[$x]['products_price'] = $new_prices[$i]['products_price'];
                    }
// qty blocks already re-set to 1 above
                   if ((int)$new_prices[$i]['qtyBlocks'] > 1 ) {
                     $product_info[$x]['qtyBlocks'] = $new_prices[$i]['qtyBlocks'];
                    }
// min order qty already re-set to 1 above
                   if ((int)$new_prices[$i]['products_min_order_qty'] > 1 ) {
                     $product_info[$x]['products_min_order_qty'] = $new_prices[$i]['products_min_order_qty'];
                    }
                }
              }
            } // end if(!empty($new_prices)
          } // end for ($x = 0; $x < $no_of_listings; $x++)
        } // end if ($this->cg_id != '0')

// an extra query is needed for all the specials

       $specials_query = tep_db_query("select products_id, specials_new_products_price from " . TABLE_SPECIALS . " where products_id in (" . $product_id_list . ") and status = '1' and customers_group_id = '" . $this->cg_id . "'");
          while ($specials_array = tep_db_fetch_array($specials_query)) {
            $new_s_prices[] = array ('products_id' => $specials_array['products_id'], 'specials_new_products_price' => $specials_array['specials_new_products_price']);
          }

// add the correct specials_new_products_price and replace final_price
          for ($x = 0; $x < $no_of_listings; $x++) {
            if (!empty($new_s_prices)) {
              $no_of_new_s_prices = count($new_s_prices);
              for ($i = 0; $i < $no_of_new_s_prices; $i++) {
                if ($product_info[$x]['products_id'] == $new_s_prices[$i]['products_id'] ) {
                  $product_info[$x]['specials_new_products_price'] = $new_s_prices[$i]['specials_new_products_price'];
                 }
              }
            } // end if(!empty($new_s_prices)
// finally add all the data
           $this->addPriceFormatterData($product_info[$x]['products_id'], $product_info[$x]);
          } // end for ($x = 0; $x < $no_of_listings; $x++)
        $price_breaks_query = tep_db_query("select products_id, products_price, products_qty from  " . TABLE_PRODUCTS_PRICE_BREAK . " where products_id in (" . $product_id_list . ") and customers_group_id = '" . $this->cg_id . "' order by products_id, products_qty");
		
        while ($price_break = tep_db_fetch_array($price_breaks_query)) {
          $price_breaks_array[$price_break['products_id']][] = array('products_price' => $price_break['products_price'], 'products_qty' => $price_break['products_qty']);
        }
		
        $no_of_pricebreaks = (isset($price_break_array) ? count($price_breaks_array) : 0);
        
		if ($no_of_pricebreaks > 0) {
          foreach ($this->priceFormatterData as $products_id => $price_break_array) {
            foreach ($price_breaks_array as $pb_products_id => $pb_price_break) {
              if ($pb_products_id == $products_id) {
                $this->priceFormatterData[$products_id]['price_breaks'] = $pb_price_break;
              }
            }
          } // end foreach ($this->priceFormatterData as $products_id etc.
        } // end if ($no_of_pricebreaks > 0)
        
        
      } // end if tep_not_null($product_id_list)
    } // end if (is_object($cart)
  }

  function addPriceFormatterData($products_id, $price_formatter_data) {
    $this->priceFormatterData[$products_id] = $price_formatter_data;
  }
  
  function getPriceFormatterData($product_id) {
    $products_id = tep_get_prid($product_id);
    if(isset($this->priceFormatterData[$products_id]) && tep_not_null($this->priceFormatterData[$products_id])) {
      return $this->priceFormatterData[$products_id];
    }	else {
      return NULL;
    }
  }

  function getStock($product_id) {
    $products_id = tep_get_prid($product_id);
      if (isset($this->priceFormatterData[$products_id]) && tep_not_null($this->priceFormatterData[$products_id])) {
         return $this->priceFormatterData[$products_id]['products_quantity'];
      } else {
      return false;
      }
   }

// added for Separate Pricing Per Customer, returns customer_group_id
    function get_customer_group_id() {
      if (isset($_SESSION['sppc_customer_group_id']) && $_SESSION['sppc_customer_group_id'] != '0') {
        $_cg_id = $_SESSION['sppc_customer_group_id'];
      } else {
         $_cg_id = 0;
      }
      return $_cg_id;
    }
}
?>
