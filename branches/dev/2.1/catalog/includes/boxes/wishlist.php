<?php
/*
  $Id: wishlist.php,v 1.0 2005/02/22 Michael Sasek


  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.

?>
<!-- wishlist //-->
<?php

  $boxHeading = '<a href="' . tep_href_link(FILENAME_WISHLIST) . '">' . BOX_HEADING_CUSTOMER_WISHLIST . '</a>';
  
  $corner_top_left = 'rounded';
  $corner_top_right = 'rounded';
  $corner_bottom_left = 'rounded';
  $corner_bottom_right = 'rounded'; 
  
  $boxContent_attributes = '';
  $boxLink = '<a href="' . tep_href_link(FILENAME_WISHLIST) . '"><img src="' . DIR_WS_TEMPLATES . 'images/infobox/arrow_right.png" border="0" alt="more" title="more"></a>';  
  $box_base_name = 'wishlist'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

  $boxContent = '';

	if (is_array(isset($wishList->wishID)) && !empty($wishList->wishID)) {
	reset($wishList->wishID);

	if (count($wishList->wishID) < MAX_DISPLAY_WISHLIST_BOX) {

		$boxContent = '<table>';
    $counter = 1;

// LOOP THROUGH EACH PRODUCT ID TO DISPLAY IN THE WISHLIST BOX
  while (list($wishlist_id, ) = each($wishList->wishID)) {
    $wishlist_id = tep_get_prid($wishlist_id);

      $products_query = tep_db_query("select pd.products_id, pd.products_name, pd.products_description, p.products_image, p.products_price, p.products_tax_class_id, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from (" . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd) left join " . TABLE_SPECIALS . " s on (p.products_id = s.products_id) where pd.products_id = '" . $wishlist_id . "' and p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' order by products_name");
      $products = tep_db_fetch_array($products_query);

      $boxContent .= '<tr><td class="boxText" valign="top">0' . $counter . '.</td>';
      $boxContent .= '<td class="boxText"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products['products_id'], 'NONSSL') . '">' . $products['products_name'] . '</a></td></tr>';
    
      $counter++;
    }

  $boxContent .= '</table>';

  } else {

    $boxContent = '<div class="boxText">' . sprintf(TEXT_WISHLIST_COUNT, count($wishList->wishID)) . '</div>';

  }

  } else {

    $boxContent = '<div class="boxText">' . BOX_WISHLIST_EMPTY . '</div>';

  }


include (bts_select('boxes', $box_base_name)); // BTS 1.5
?>
<!-- wishlist_eof //-->