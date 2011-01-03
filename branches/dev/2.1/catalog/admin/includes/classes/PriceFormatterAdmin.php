<?php
/*
  $Id: PriceFormatterAdmin.php - version for SPPC, v1.8 2008/11/08 JanZ Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

/*
    PriceFormatterAdmin.php - module to display quantity pricing in admin/categories.php

    Created 2003, Beezle Software based on some code mods by WasaLab Oy (Thanks!)
    
    Refactored 2008, Moved pricebreak data into dedicated table
*/

class PriceFormatter {

  function PriceFormatter() {
    $this->thePrice = -1;
    $this->taxClass = -1;
    $this->qtyBlocks = 1;
    $this->products_min_order_qty = 1;
    $this->price_breaks = array();
    $this->hasQuantityPrice = false;  
    $this->hiPrice = -1;
    $this->lowPrice = -1;
  }

  function loadProduct($product_id, $products_price, $products_tax_class_id, $qtyBlocks = 1, $price_breaks_array = NULL, $min_order_qty = 1) {
    // Collect required data (show for retail only)
    // in a preview read=only no data for the price break available
    if (!tep_not_null($price_breaks_array)) {
      $price_breaks_array = array();
      $price_breaks_query = tep_db_query("select products_price, products_qty from " . TABLE_PRODUCTS_PRICE_BREAK . " where products_id = '" . (int)$product_id . "' and customers_group_id = '0' order by products_qty");
      while ($price_break = tep_db_fetch_array($price_breaks_query)) {
        $price_breaks_array[] = $price_break;
      }
    }
    
    //Assign members
    $this->thePrice = $products_price;
    $this->taxClass = $products_tax_class_id;
    $this->qtyBlocks = ($qtyBlocks < 1 ? 1 : $qtyBlocks);
    $this->price_breaks = $price_breaks_array;
    $this->products_min_order_qty = ($min_order_qty < 1? 1 : $min_order_qty);

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
  }

  function getQtyBlocks() {
    return $this->qtyBlocks;
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

// this is the same function as in catalog/includes/classes/PriceFormatter.ph
// however the class infoBoxContents is changed to infoBoxContent here!

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
      <td style="' . $styling . '" class="infoBoxContent">' . TEXT_PRICE_PER_PIECE . '</td>' . "\n";

      if (true == $this->hasSpecialPrice && ($this->price_breaks[0]['products_qty'] > $this->products_min_order_qty)) {
        $lc_text .= '<td align="center" style="' . $styling . '" class="infoBoxContent">';
        $lc_text .= '<s>'
        . $currencies->display_price($this->thePrice, tep_get_tax_rate($this->taxClass))
        . '</s>&nbsp;&nbsp;<span class="productSpecialPrice">'
        . $currencies->display_price($this->specialPrice, tep_get_tax_rate($this->taxClass))
        . '</span>&nbsp;'
        .'</td>' . "\n";
      } elseif ($this->price_breaks[0]['products_qty'] > $this->products_min_order_qty) {
        $lc_text .= '<td align="center" style="' . $styling . '" class="infoBoxContent">'
        . $currencies->display_price($this->thePrice, tep_get_tax_rate($this->taxClass))
        . '</td>' . "\n";
      }
      
      foreach($this->price_breaks as $price_break) {
          $lc_text .= '<td align="center" style="' . $styling . '" class="infoBoxContent">'
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
      <td style="' . $styling . '" class="infoBoxContent">' . TEXT_SAVINGS . '</td>' . "\n";
      if (true == $this->hasSpecialPrice && ($this->price_breaks[0]['products_qty'] > $this->products_min_order_qty)) {
        $lc_text .= '<td align="center" class="infoBoxContent">'
        . $this->getDiscountSaving($base_price, $this->specialPrice)
        .'</td>' . "\n";
      } elseif ($this->price_breaks[0]['products_qty'] > $this->products_min_order_qty) {
        $lc_text .= '<td align="center" class="infoBoxContent">- </td>' . "\n";
      }

      foreach($this->price_breaks as $price_break) {
        if ($price_break['products_qty'] > $this->qtyBlocks) {
          $lc_text .= '<td align="center" style="' . $styling . '" class="infoBoxContent">'
          . $this->getDiscountSaving($base_price, $price_break['products_price'])
          .'</td>' . "\n";
        } else {
          $lc_text .= '<td align="center" class="infoBoxContent">- </td>' . "\n";
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
     $dropdown .= '&nbsp;<span class="smalltext">' . PB_FROM . '</span>&nbsp;' . $currencies->display_price($this->lowPrice, tep_get_tax_rate($this->taxClass)) . "\n";

     return $dropdown;
  }
}
?>
