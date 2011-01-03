<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.


  if ($random_product = tep_random_select("select products_id, products_image, products_tax_class_id, products_price from " . TABLE_PRODUCTS . " where products_status = '1' order by products_date_added desc limit " . MAX_RANDOM_SELECT_NEW)) {
?>
<!-- whats_new //-->
<?php
    $boxHeading = BOX_HEADING_WHATS_NEW;
    $corner_left = 'square';
    $corner_right = 'square';
    $boxContent_attributes = ' align="center"';
    $boxLink = '<a href="' . tep_href_link(FILENAME_PRODUCTS_NEW) . '"><img src="' . DIR_WS_TEMPLATES . 'images/more.png" border="0" alt="more" title=" more " width="16" height="16"></a>';
    $box_base_name = 'whats_new'; // for easy unique box template setup (added BTSv1.2)
    $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

    $random_product['products_name'] = tep_get_products_name($random_product['products_id']);
    $random_product['specials_new_products_price'] = tep_get_products_special_price($random_product['products_id']);
// BOF Separate Pricing Per Customer
// global variable (session) $sppc_customer_group_id -> local variable customer_group_id

  if(!tep_session_is_registered('sppc_customer_group_id')) { 
  $customer_group_id = '0';
  } else {
   $customer_group_id = $sppc_customer_group_id;
  }
    
       if ($customer_group_id !='0') {
	$customer_group_price_query = tep_db_query("select customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . $random_product['products_id'] . "' and customers_group_id =  '" . $customer_group_id . "'");
	  if ($customer_group_price = tep_db_fetch_array($customer_group_price_query)) {
	    $random_product['products_price'] = $customer_group_price['customers_group_price'];
	  }
     }
// EOF Separate Pricing Per Customer
    if (tep_not_null($random_product['specials_new_products_price'])) {
      $whats_new_price = '<span style="text-decoration:line-through">' . $currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</span><br>';
      $whats_new_price .= '<span class="productSpecialPrice">' . $currencies->display_price($random_product['specials_new_products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</span>';
    } else {
      $whats_new_price = $currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id']));
    }

    $boxContent = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $random_product['products_image'], $random_product['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . $random_product['products_name'] . '</a><br>' . $whats_new_price;





include (bts_select('boxes', $box_base_name)); // BTS 1.5
    $boxLink = '';
    $boxContent_attributes = '';
?>
<!-- whats_new_eof //-->
<?php
  }
?>
