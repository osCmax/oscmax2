<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

/*
    adapted for QPBPP for SPPC version 2.0 2008/11/08
    PriceFormatter.php - module to support quantity pricing

    Created 2003, Beezle Software based on some code mods by WasaLab Oy (Thanks!)
    
    Refactored 2008, Moved pricebreak data into dedicated table
*/

class PriceFormatter {

  function PriceFormatter() {
    $this->thePrice = -1;
    $this->taxClass = -1;
    $this->qtyBlocks = 1;
    $this->products_min_order_qty = 1; // min order quantity added in QPBPP for SPPC v2.0
    $this->price_breaks = array();
    $this->hasQuantityPrice = false;  
    $this->hiPrice = -1;
    $this->lowPrice = -1;
    $this->hasSpecialPrice = false; //tep_not_null($this->specialPrice);
    $this->specialPrice = NULL; //$prices['specials_new_products_price'];
  }

  function loadProduct($product_id, $language_id = 1, $listing = NULL, $price_breaks_from_listing = NULL) {
    global $pfs;
    $this->cg_id = $this->get_customer_group_id();

    $product_id = tep_get_prid($product_id); // only use integers here
    // returns NULL if the price break information is not yet stored
    $stored_price_formatter_data = $pfs->getPriceFormatterData($product_id);
    if (tep_not_null($stored_price_formatter_data)) {
      //Use data from the cache with some conversions
      $price_formatter_data = $stored_price_formatter_data;
      unset($stored_price_formatter_data);
    }

  if (!isset($price_formatter_data)) {
    if ($listing == NULL) {
      //Collect required data
       $sql = "select pd.products_name, p.products_model, p.products_image, p.products_id," .
   " p.manufacturers_id, p.products_price, p.products_weight, p.products_quantity," .
   " p.products_qty_blocks as qtyBlocks, p.products_min_order_qty, p.products_tax_class_id," .
   " NULL as specials_new_products_price," .
   " ptdc.discount_categories_id from " . TABLE_PRODUCTS . " p left join (select products_id, discount_categories_id from " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . "" .
   " where products_id = '" . (int)$product_id . "' and customers_group_id = '" . $this->cg_id . "') as ptdc on " .
   " p.products_id = ptdc.products_id, " .
   " " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1'" .
   " and pd.products_id = p.products_id " .
   " and p.products_id = '" . (int)$product_id . "'" .
   " and pd.language_id = '". (int)$language_id ."'";


      $product_info_query = tep_db_query($sql);
      $product_info = tep_db_fetch_array($product_info_query);
      
  if ($this->cg_id != '0') {
  // re-set qty blocks and min order qty to 1: do not use values for retail customers
      $product_info['qtyBlocks'] = 1;
      $product_info['products_min_order_qty'] = 1;

      $customer_group_price_query = tep_db_query("select customers_group_price, products_qty_blocks as qtyBlocks, products_min_order_qty from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . (int)$product_id . "' and customers_group_id =  '" . $this->cg_id . "'");
      
      if ($customer_group_price = tep_db_fetch_array($customer_group_price_query)) {
// customer group price can be null when qty blocks or min order qty is used
        if (tep_not_null($customer_group_price['customers_group_price'])) {
        $product_info['products_price'] = $customer_group_price['customers_group_price'];
        }
        $product_info['qtyBlocks'] = $customer_group_price['qtyBlocks'];
        $product_info['products_min_order_qty'] = $customer_group_price['products_min_order_qty'];
      }
  } // end if ($this->cg_id != '0')
  // now get the specials price for this customer_group and add it to product_info array
  $special_price_query = tep_db_query("select specials_new_products_price from " . TABLE_SPECIALS . " where products_id = " . (int)$product_id . " and status = '1' and customers_group_id = '" . $this->cg_id . "'");
  if ($specials_price = tep_db_fetch_array($special_price_query)) {
	  $product_info['specials_new_products_price'] = $specials_price['specials_new_products_price'];
  }
      //Price-breaks

        $price_breaks_array = array();
        $price_breaks_query = tep_db_query("select products_price, products_qty from " . TABLE_PRODUCTS_PRICE_BREAK . " where products_id = '" . (int)$product_id . "' and customers_group_id = '" . $this->cg_id . "' order by products_qty");
        while ($price_break = tep_db_fetch_array($price_breaks_query)) {
          $price_breaks_array[] = $price_break;
        }
    
      //Compose cachable structure
      $price_formatter_data = array(
        'products_name' => $product_info['products_name'],
        'products_model' => $product_info['products_model'],
        'products_image' => $product_info['products_image'],
        'products_id' =>  $product_info['products_id'],
        'manufacturers_id' =>  $product_info['manufacturers_id'],
        'products_price' => $product_info['products_price'],
        'specials_new_products_price' => $product_info['specials_new_products_price'],
        'products_tax_class_id' => $product_info['products_tax_class_id'],
        'discount_categories_id' => $product_info['discount_categories_id'],
        'products_weight' => $product_info['products_weight'],
        'products_quantity' => $product_info['products_quantity'],
        'price_breaks' => $price_breaks_array,
        'qtyBlocks' => $product_info['qtyBlocks'],
        'products_min_order_qty' => $product_info['products_min_order_qty']);

      //Add to cache
      $pfs->addPriceFormatterData($product_id, $price_formatter_data);
    } else { // data from product listing
      //Compose cachable structure
      $price_formatter_data = array(
        'products_name' => (isset($listing['products_name']) ? $listing['products_name'] : ''),
        'products_model' => (isset($listing['products_model']) ? $listing['products_model'] : ''),
        'products_image' => (isset($listing['products_image']) ? $listing['products_image'] : ''),
        'products_id' => (isset($listing['products_id']) ? $listing['products_id'] : ''),
        'manufacturers_id' => (isset($listing['manufacturers_id']) ? $listing['manufacturers_id'] : ''),
        'products_price' => (isset($listing['products_price']) ? $listing['products_price'] : ''),
        'specials_new_products_price' => (isset($listing['specials_new_products_price']) ? $listing['specials_new_products_price'] : ''),
        'products_tax_class_id' => (isset($listing['products_tax_class_id']) ? $listing['products_tax_class_id'] : ''),
        'discount_categories_id' => (isset($listing['discount_categories_id']) ? $listing['discount_categories_id'] : ''),
        'products_weight' => (isset($listing['products_weight']) ? $listing['products_weight'] : ''),
        'products_quantity' => (isset($listing['products_quantity']) ? $listing['products_quantity'] : ''),
        'price_breaks' => $price_breaks_from_listing,
        'qtyBlocks' => (isset($listing['qtyBlocks']) ? $listing['qtyBlocks'] : ''),
        'products_min_order_qty' => (isset($listing['products_min_order_qty']) ? $listing['products_min_order_qty'] : ''));
      //Add to cache
      $pfs->addPriceFormatterData($product_id, $price_formatter_data);
    }
  } // end if (!isset($price_formatter_data))
    
    //Assign members
    $this->product_id = $product_id; // needed for adjustQty
    $this->thePrice = $price_formatter_data['products_price'];
    $this->taxClass = $price_formatter_data['products_tax_class_id'];
    $this->qtyBlocks = $price_formatter_data['qtyBlocks'];
    $this->products_min_order_qty = $price_formatter_data['products_min_order_qty'];
    $this->discount_categories_id = $price_formatter_data['discount_categories_id'];
    $this->price_breaks = $price_formatter_data['price_breaks'];
    $this->specialPrice = $price_formatter_data['specials_new_products_price'];
    $this->hasSpecialPrice = tep_not_null($this->specialPrice);

    //Custom      
    $this->hasQuantityPrice = false;
    $this->hiPrice = $this->thePrice;
    $this->lowPrice = $this->thePrice;
    if (count($this->price_breaks) > 0) {
      $this->hasQuantityPrice = true;
      foreach($this->price_breaks as $price_break) {
        $this->hiPrice = max($this->hiPrice, $price_break['products_price']);
        $this->lowPrice = min($this->lowPrice, $price_break['products_price']);
      }
    }

    /*
    Change support special prices
    If any price level has a price greater than the special
    price lower it to the special price
    If product is in the shopping_cart $this->price_breaks can be empty
    */
    if (true == $this->hasSpecialPrice && is_array($this->price_breaks)) {
      foreach($this->price_breaks as $key => $price_break) {
        $this->price_breaks[$key]['products_price'] = min($price_break['products_price'], $this->specialPrice);
      }
    }
    //end changes to support special prices
  }
  
  function computePrice($qty, $nof_other_items_in_cart_same_cat = 0)
  {
    $qty = $this->adjustQty($qty);

    // Add the number of other items in the cart from the same category to see if a price break is reached
    $qty += $nof_other_items_in_cart_same_cat;

    // Compute base price, taking into account the possibility of a special
    $price = (true == $this->hasSpecialPrice) ? $this->specialPrice : $this->thePrice;

    if (is_array($this->price_breaks) && count($this->price_breaks) > 0) {
      foreach($this->price_breaks as $price_break) {
        if ($qty >= $price_break['products_qty']) {
          $price = $price_break['products_price'];
        }
      }
    } // end if (is_array($this->price_breaks) && count($this->price_breaks) > 0)

    return $price;
  }

  function adjustQty($qty, $qtyBlocks = NULL) {
    // Force QTY_BLOCKS granularity
    if (!tep_not_null($qtyBlocks)) {
      $qtyBlocks = $this->getQtyBlocks();
    }
    $minimum_order_quantity = $this->getMinOrderQty();
     if (defined('MAX_QTY_IN_CART') && (MAX_QTY_IN_CART > 0) && ((int)$qty > MAX_QTY_IN_CART)) {
        $qty = MAX_QTY_IN_CART;
      }
    
    if ($qty < 1) {
      $qty = 1;
      }

    if ($qtyBlocks >= 1) {
      $remove_session_min_order_qty_not_met = 0;
      if ($qty < $minimum_order_quantity) {
        $qty = $minimum_order_quantity; // make sure quantity is minimum order quantity first
        $_SESSION['min_order_qty_not_met'][] = $this->product_id;
      }
      if ($qty < $qtyBlocks) {
        $qty = $qtyBlocks;
        $_SESSION['qty_blocks_not_met'][] = $this->product_id;
        $remove_session_min_order_qty_not_met = 1;
      }
      if (($qty % $qtyBlocks) != 0) {
        $qty += ($qtyBlocks - ($qty % $qtyBlocks));
        if (defined('MAX_QTY_IN_CART') && (MAX_QTY_IN_CART > 0) && ($qty > MAX_QTY_IN_CART)) {
          $qty -= $qtyBlocks;
        }

        $_SESSION['qty_blocks_not_met'][] = $this->product_id;
        $remove_session_min_order_qty_not_met = 1;
      }
      // no two different warnings for the same product
      if ($remove_session_min_order_qty_not_met == 1 && isset($_SESSION['min_order_qty_not_met'])) {
        foreach ($_SESSION['min_order_qty_not_met'] as $moq_key => $moq_pid) {
          if ($moq_pid == $this->product_id) {
            unset($_SESSION['min_order_qty_not_met'][$moq_key]);
          }
        }
      } // end if ($remove_session_min_order_qty_not_met == 1 && isset(...
    }
    return $qty;
  }
  
  function getQtyBlocks() {
    return $this->qtyBlocks;
  }

  function getMinOrderQty() {
    return $this->products_min_order_qty;
  }

  function get_discount_category() {
    return $this->discount_categories_id;
  }

  function getPrice() {
    return $this->thePrice;
  }

  function getLowPrice() {
    return $this->lowPrice;
  }

  function getHiPrice() {
    return $this->hiPrice;
  }

  function hasSpecialPrice() {
    return $this->hasSpecialPrice;
  }

  function hasQuantityPrice() {
    return $this->hasQuantityPrice;
  }

  function getDiscountSaving($original_price, $discount_price) {
    $difference = $original_price - $discount_price;
    $percentage = (($difference / $original_price) * 100);
    if ($percentage == '0') {
    return '- ';
    } else {
      return round ($percentage) . '%';
    }
  }

  function getPriceString($style='productPriceInBox') {
    global $currencies;

    // If you want to change the format of the price/quantity table
    // displayed on the product information page, here is where you do it.
    $styling = 'padding-left: 10px;padding-right:10px;';
    $no_of_price_breaks = count($this->price_breaks);
    $qtyBlocks = $this->getQtyBlocks();

    if (true == $this->hasQuantityPrice) {
// if number of price breaks exceeds a number (set in Admin_>Configuration->Price breaks)
// a dropdown with price breaks followed by "from Low Price" is shown instead of table.
    if ($no_of_price_breaks >= (defined('NOF_PRICE_BREAKS_FOR_DROPDOWN') ? NOF_PRICE_BREAKS_FOR_DROPDOWN : 5)) {
      $lc_text = $this->getPriceDropDown();
      return $lc_text;
    }

      $lc_text = '<table border="0" cellspacing="0" cellpadding="0" class="infoBox" align="right">
              <tr valign="top">
              <td>
              <table border="0" cellspacing="1" cellpadding="4" class="infobox">' . "\n";
      $lc_text .= '<tr valign="top">' . "\n";
      $lc_text .= '<td style="' . $styling . '" class="infoBoxHeading">' . TEXT_ENTER_QUANTITY .'</td>' . "\n";
      if ($this->price_breaks[0]['products_qty'] > $this->products_min_order_qty) {
        $lc_text .= '<td align="center" class="infoBoxHeading">' . $this->products_min_order_qty;
        if (($this->price_breaks[0]['products_qty'] - $this->products_min_order_qty) > $qtyBlocks) {
          $lc_text .= '-' . ($this->price_breaks[0]['products_qty'] - $qtyBlocks);
        }
        $lc_text .= '</td>' . "\n";
      } // end if ($this->price_breaks[0]['products_qty'] > $this->products_min_order_qty)
      
      foreach($this->price_breaks as $key => $price_break) {
          $lc_text .= '<td align="center" style="' . $styling . '" class="infoBoxHeading">'
            . $price_break['products_qty'];
          if ($key == $no_of_price_breaks -1) {
            $lc_text .= '+&nbsp;</td>' . "\n";
          } else {
            if (($this->price_breaks[$key + 1]['products_qty'] - $this->price_breaks[$key]['products_qty']) > $qtyBlocks) {
            $lc_text .= '-' . ($this->price_breaks[$key+1]['products_qty'] - $qtyBlocks) . '</td>' . "\n";
            }
          } 
      } // end foreach($this->price_breaks as $key => $price_break)
      $lc_text .= '</tr>' . "\n";
      $lc_text .= '<tr valign="top">
      <td style="' . $styling . '" class="infoBoxContents">' . TEXT_PRICE_PER_PIECE . '</td>' . "\n";

      if (true == $this->hasSpecialPrice && ($this->price_breaks[0]['products_qty'] > $this->products_min_order_qty)) {
        $lc_text .= '<td align="center" style="' . $styling . '" class="infoBoxContents">';
        $lc_text .= '<s>'
        . $currencies->display_price($this->thePrice, tep_get_tax_rate($this->taxClass))
        . '</s>&nbsp;&nbsp;<span class="productSpecialPrice">'
        . $currencies->display_price($this->specialPrice, tep_get_tax_rate($this->taxClass))
        . '</span>&nbsp;'
        .'</td>' . "\n";
      } elseif ($this->price_breaks[0]['products_qty'] > $this->products_min_order_qty) {
        $lc_text .= '<td align="center" style="' . $styling . '" class="infoBoxContents">'
        . $currencies->display_price($this->thePrice, tep_get_tax_rate($this->taxClass))
        . '</td>' . "\n";
      }
      
      foreach($this->price_breaks as $price_break) {
          $lc_text .= '<td align="center" style="' . $styling . '" class="infoBoxContents">'
            . $currencies->display_price($price_break['products_price'], tep_get_tax_rate($this->taxClass))
            .'</td>' . "\n";
      }
      $lc_text .= '</tr>' . "\n";
  
      // Begin saving calculation
      $base_price = $this->thePrice;
      // if you have a min order quantity set, this might be the first entry
      // in the price break table so let's check for that
      if ($this->products_min_order_qty > 1 && $this->products_min_order_qty == $this->price_breaks[0]['products_qty']) {
        $base_price = $this->price_breaks[0]['products_price'];
      }
      // in case of a special price the "Savings" are calculated against the normal price
      // apart from the first column which calculates against the special price
      $lc_text .= '<tr valign="top">
      <td style="' . $styling . '" class="infoBoxContents">' . TEXT_SAVINGS . '</td>' . "\n";
      if (true == $this->hasSpecialPrice && ($this->price_breaks[0]['products_qty'] > $this->products_min_order_qty)) {
        $lc_text .= '<td align="center" class="infoBoxContents">'
        . $this->getDiscountSaving($base_price, $this->specialPrice)
        .'</td>' . "\n";
      } elseif ($this->price_breaks[0]['products_qty'] > $this->products_min_order_qty) {
        $lc_text .= '<td align="center" class="infoBoxContents">- </td>' . "\n";
      }

      foreach($this->price_breaks as $price_break) {
        if ($price_break['products_qty'] > $this->qtyBlocks) {
          $lc_text .= '<td align="center" style="' . $styling . '" class="infoBoxContents">'
          . $this->getDiscountSaving($base_price, $price_break['products_price'])
          .'</td>' . "\n";
        } else {
          $lc_text .= '<td align="center" class="infoBoxContents">- </td>' . "\n";
        }
      }
      $lc_text .= '</tr></table></td></tr></table>';
    } else {
      if (true == $this->hasSpecialPrice) {
        $lc_text = '&nbsp;<s>'
        . $currencies->display_price($this->thePrice, tep_get_tax_rate($this->taxClass))
        . '</s>&nbsp;&nbsp;<span class="productSpecialPrice">'
        . $currencies->display_price($this->specialPrice, tep_get_tax_rate($this->taxClass))
        . '</span>&nbsp;';
      } else {
        $lc_text = '&nbsp;'
        . $currencies->display_price($this->thePrice, tep_get_tax_rate($this->taxClass))
        . '&nbsp;';
      }
    }
    return $lc_text;
  }

  function getPriceStringShort() {
    global $currencies;

    if (true == $this->hasSpecialPrice) {
        $lc_text = '&nbsp;<big><s>'
        . $currencies->display_price($this->thePrice, tep_get_tax_rate($this->taxClass))
        . '</s>&nbsp;<span class="productSpecialPrice">' . TEXT_ON_SALE
        . $currencies->display_price($this->specialPrice, tep_get_tax_rate($this->taxClass))
        . '</span></big>&nbsp;';
    } elseif ( (true == $this->hasQuantityPrice) && (PRICE_BREAK_PRICE != 'off') ) {
      if (PRICE_BREAK_PRICE == 'high') {
	    $lc_text = '&nbsp;<big>' . TEXT_PRICE_BREAKS
        . $currencies->display_price($this->hiPrice, tep_get_tax_rate($this->taxClass))
        . '&nbsp;</big>';
	  } else {
	    $lc_text = '&nbsp;<big>' . TEXT_PRICE_BREAKS
        . $currencies->display_price($this->lowPrice, tep_get_tax_rate($this->taxClass))
        . '&nbsp;</big>';
	  }
    } else {
        $lc_text = '&nbsp;<big>'
        . $currencies->display_price($this->thePrice, tep_get_tax_rate($this->taxClass))
        . '&nbsp;</big>';
    }
    return $lc_text;
  }

  function getPriceDropDown() {
    global $currencies;
    $no_of_price_breaks = count($this->price_breaks);
    $qtyBlocks = $this->getQtyBlocks();

      $dropdown_price_breaks = array();
      $i = 0;
      $pb_text = '';
      if ($this->price_breaks[0]['products_qty'] > $this->products_min_order_qty) {
        $pb_text = PB_DROPDOWN_BEFORE . $this->products_min_order_qty;
        if (($this->price_breaks[0]['products_qty'] - $this->products_min_order_qty) > $qtyBlocks) {
          $pb_text .= '-' . ($this->price_breaks[0]['products_qty'] - $qtyBlocks);
        }
        $pb_text .= PB_DROPDOWN_BETWEEN . $currencies->display_price($this->hiPrice, tep_get_tax_rate($this->taxClass)) . PB_DROPDOWN_AFTER;
        $dropdown_price_breaks[] = array('id' => $i, 'text' => $pb_text);
        $i++;
      } // end if ($this->price_breaks[0]['products_qty'] > $this->products_min_order_qty)

     for ($z = 0; $z < $no_of_price_breaks; $z++) {
       $pb_text = PB_DROPDOWN_BEFORE . $this->price_breaks[$z]['products_qty']; // start again
       if ($z == $no_of_price_breaks -1) {
         // last one
         $pb_text .= '+';
       } else {
         if (($this->price_breaks[$z + 1]['products_qty'] - $this->price_breaks[$z]['products_qty']) > $qtyBlocks) {
           $pb_text .= '-' . ($this->price_breaks[$z + 1]['products_qty'] - $qtyBlocks);
         }
       }
       $pb_text .= PB_DROPDOWN_BETWEEN . $currencies->display_price($this->price_breaks[$z]['products_price'], tep_get_tax_rate($this->taxClass)) . PB_DROPDOWN_AFTER;
       $dropdown_price_breaks[] = array('id' => $i, 'text' => $pb_text);
       $i++;
		 } // end for ($z = 0; $z < $no_of_price_breaks; $z++)
		 $dropdown = tep_draw_pull_down_menu('price_breaks', $dropdown_price_breaks, '0', 'style="font-weight: normal"');
     $dropdown .= '&nbsp;<span class="smallText">' . PB_FROM . '</span>&nbsp;' . $currencies->display_price($this->lowPrice, tep_get_tax_rate($this->taxClass)) . "\n";

     return $dropdown;
  }
  
/* Old (original formatting)

// style for productPriceInBox is (needs to be added to your stylesheet or head of page)
// TD.productPriceInBox {
//  font-family: Verdana, Arial, sans-serif;
//  font-size: 10px;
//  background: #eeeeee;
// }

  function getPriceString($style='"productPriceInBox"') {
    global $currencies;

    if (true == $this->hasSpecialPrice) {
      $lc_text = '<table align="top" border="1" cellspacing="0" cellpadding="0">';
      $lc_text .= '<tr><td align="center" class=' . $style. ' colspan="2">';
      $lc_text .= '&nbsp;<s>'
        . $currencies->display_price($this->thePrice, tep_get_tax_rate($this->taxClass))
        . '</s>&nbsp;&nbsp;<span class="productSpecialPrice">'
        . $currencies->display_price($this->specialPrice, tep_get_tax_rate($this->taxClass))
        . '</span>&nbsp;'
        .'</td></tr>';
    }
    else
    {
      $lc_text = '<table align="top" border="1" cellspacing="0" cellpadding="0">';
      $lc_text .= '<tr><td align="center" class=' . $style. ' colspan="2">'
        . $currencies->display_price($this->thePrice, tep_get_tax_rate($this->taxClass))
        . '</td></tr>';
    }
    
    // If you want to change the format of the price/quantity table
    // displayed on the product information page, here is where you do it.

    if(true == $this->hasQuantityPrice) {
      foreach($this->price_breaks as $price_break) {
        $lc_text .= '<tr><td class='.$style.'>'
          . $price_break['products_qty']
          .'+&nbsp;</td><td class='.$style.'>'
          . $currencies->display_price($price_break['products_price'], tep_get_tax_rate($this->taxClass))
          .'</td></tr>';
      }
      $lc_text .= '</table>';
    } else {
      if (true == $this->hasSpecialPrice) {
        $lc_text = '&nbsp;<s>'
          . $currencies->display_price($this->thePrice, tep_get_tax_rate($this->taxClass))
          . '</s>&nbsp;&nbsp;<span class="productSpecialPrice">'
          . $currencies->display_price($this->specialPrice, tep_get_tax_rate($this->taxClass))
          . '</span>&nbsp;';
      } else {
        $lc_text = '&nbsp;'
          . $currencies->display_price($this->thePrice, tep_get_tax_rate($this->taxClass))
          . '&nbsp;';
      }
    }

    return $lc_text;
  }

  function getPriceStringShort() {
    global $currencies;

    if (true == $this->hasSpecialPrice) {
      $lc_text = '&nbsp;<s>'
        . $currencies->display_price($this->thePrice, tep_get_tax_rate($this->taxClass))
        . '</s>&nbsp;&nbsp;<span class="productSpecialPrice">'
        . $currencies->display_price($this->specialPrice, tep_get_tax_rate($this->taxClass))
        . '</span>&nbsp;';
    } else {
      if(true == $this->hasQuantityPrice) {
        $lc_text = '&nbsp;'
          . $currencies->display_price($this->lowPrice, tep_get_tax_rate($this->taxClass))
          . ' - '
          . $currencies->display_price($this->hiPrice, tep_get_tax_rate($this->taxClass))
          . '&nbsp;';
      } else {
        $lc_text = '&nbsp;'
          . $currencies->display_price($this->thePrice, tep_get_tax_rate($this->taxClass))
          . '&nbsp;';
      }
    }
    return $lc_text;
  }
  */
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
