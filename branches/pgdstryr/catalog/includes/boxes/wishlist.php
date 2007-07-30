<?php
/*
  $Id: wishlist.php,v 1.0 2005/02/22 Michael Sasek


  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.

  if (tep_session_is_registered('customer_id')){

?>
<!-- wishlist //-->
<?php

  $boxHeading = BOX_HEADING_CUSTOMER_WISHLIST;
  $corner_left = 'square';
  $corner_right = 'square';
  $box_base_name = 'wishlist'; // for easy unique box template setup (added BTSv1.2)

  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

    $boxContent = '';
    
  // retreive the wishlist
  // $wishlist_query = tep_db_query("select * from " . TABLE_WISHLIST . " WHERE customers_id=$customer_id");
  $wishlist_query_raw = "select * from " . TABLE_WISHLIST . " WHERE customers_id = $customer_id order by products_name";
  $wishlist_query = tep_db_query($wishlist_query_raw);  

  if (tep_db_num_rows($wishlist_query)) {
	if (tep_db_num_rows($wishlist_query) < MAX_DISPLAY_WISHLIST_BOX) {
    $product_ids = '';
    while ($wishlist = tep_db_fetch_array($wishlist_query)) {
      $product_ids .= $wishlist['products_id'] . ',';
    }
    $product_ids = substr($product_ids, 0, -1);

    $boxContent = '<table border="0" width="100%" cellspacing="0" cellpadding="0">' . "\n";
    $products_query = tep_db_query("select products_id, products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id in (" . $product_ids . ") and language_id = '" . $languages_id . "' order by products_name");
    while ($products = tep_db_fetch_array($products_query)) {


        $boxContent .= '  <tr>' . "\n" .
                                     '    <td class="infoBoxContents"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . tep_get_product_path($products['products_id']) . '&products_id=' . $products['products_id'], 'NONSSL') . '">' . $products['products_name'] . '</a></td>' . "\n" .
                                     '      </tr>' . "\n" .
                                     '      <tr>' . "\n" .
// BoF Modification by: R. Siebert (VINI & VITA)
                                     '    <td class="infoBoxContents" align="center" valign="bottom"> ' .
                                     // Wish List 2.3 Start
                                     tep_draw_form('product_' . $products['products_id'], tep_href_link(FILENAME_WISHLIST)) . tep_draw_hidden_field('products_id', $products['products_id']) . tep_draw_hidden_field('wishlist_action', 'wishlist_add_cart') ;
                                     if ($customer_id > 0) {
                                        $wishlist_products_attributes_query = tep_db_query("select products_options_id as po, products_options_value_id as pov from " . TABLE_WISHLIST_ATTRIBUTES . " where customers_id='" . $customer_id . "' and products_id = '" . $products['products_id'] . "'");
                                        while ($wishlist_products_attributes = tep_db_fetch_array($wishlist_products_attributes_query)) {
                                            // Populate $id[] with products attributes
                                            $boxContent .= tep_draw_hidden_field('id['.$wishlist_products_attributes['po'].']', $wishlist_products_attributes['pov']);
                                        }
                                     }
                                     
                                     $boxContent .= tep_image_submit('button_wishlist_buy.gif', BOX_TEXT_MOVE_TO_CART) .
                                                                  '<a href="' . tep_href_link(FILENAME_WISHLIST, tep_get_all_get_params(array('action')) . 'action=remove_wishlist&pid=' . $products['products_id'], 'NONSSL') . '">' . 
                                                                  tep_image_button ('button_wishlist_remove.gif', BOX_TEXT_DELETE) .
                                                                  '</a></form>'. tep_draw_separator('pixel_black.gif', '100%', '1'). '</td>' . "\n";
									// Wish List 2.3 End
// EoF Modification by: R. Siebert (VINI & VITA)

								 tep_draw_separator('pixel_black.gif', '100%', '1') . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '</td></tr>' . "\n";
    }
	    } else {



    $boxContent = '<table border="0" width="100%" cellspacing="0" cellpadding="0">' . "\n";
	$boxContent .= '<tr><td class="infoBoxContents">' . sprintf(TEXT_WISHLIST_COUNT, tep_db_num_rows($wishlist_query)) . '</td></tr>' . "\n";
	  }
	} else {
    $boxContent = '<table border="0" width="100%" cellspacing="0" cellpadding="0">' . "\n";
	$boxContent .= '<tr><td class="infoBoxContents">' . BOX_WISHLIST_EMPTY . '</td></tr>' . "\n";
  }
    $boxContent .= '<tr><td colspan="3" align="right" class="smallText"><a href="' . tep_href_link(FILENAME_WISHLIST, '','NONSSL') . '"><u> ' . BOX_HEADING_CUSTOMER_WISHLIST . '</u> [+]</a></td></tr>' . "\n";
//    $boxContent .= '<tr><td colspan="3" align="right" class="smallText"><a href="javascript:popupWindowWishlist(\'' . tep_href_link('popup_' . FILENAME_WISHLIST_HELP, '','NONSSL') . '\')"><u>'. BOX_HEADING_CUSTOMER_WISHLIST . ' Help</u> [?]</a></td></tr>' . "\n"; // Popup link
    $boxContent .= '<tr><td colspan="3" align="right" class="smallText"><a href="' . tep_href_link(FILENAME_WISHLIST_HELP, '','NONSSL') . '"><u> ' . BOX_HEADING_CUSTOMER_WISHLIST_HELP . '</u> [?]</a></td></tr>' . "\n"; // Normal link
    $boxContent .= '</table>';
	
//    $info_box_contents[] = array('align' => 'left',
//                                 'text'  => $boxContent);

    //new infoBox($info_box_contents);

include (bts_select('boxes', $box_base_name)); // BTS 1.5
}
?>
<!-- wishlist_eof //-->