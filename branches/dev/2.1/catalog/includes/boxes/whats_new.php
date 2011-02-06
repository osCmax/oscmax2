<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// adapted for Separate Pricing Per Customer v4.2 2007/08/10, Hide products and categories from groups 2008/08/04
// Most of this file is changed or moved to BTS - Basic Template System - format.


//  if ($random_product = tep_random_select("select products_id, products_image, products_tax_class_id, products_price from " . TABLE_PRODUCTS . " where products_status = '1' order by products_date_added desc limit " . MAX_RANDOM_SELECT_NEW)) {
 // BOF Hide products and categories from groups
  if ($random_product = tep_random_select("select p.products_id, p.products_image, p.products_tax_class_id, p.products_price from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_TO_CATEGORIES .  " using(products_id) left join " . TABLE_CATEGORIES . " using(categories_id) where products_status = '1' and find_in_set('".$customer_group_id."', p.products_hide_from_groups) = '0' order by products_date_added desc limit " . MAX_RANDOM_SELECT_NEW)) {
 // EOF Hide products and categories from groups


?>
<!-- whats_new //-->
<?php
  $boxHeading = '<a href="' . tep_href_link(FILENAME_DEFAULT, "new_products=1") . '">' . BOX_HEADING_WHATS_NEW . '</a>';

  $corner_top_left = 'rounded';
  $corner_top_right = 'rounded';
  $corner_bottom_left = 'rounded';
  $corner_bottom_right = 'rounded';

  $boxContent_attributes = ' align="center"';
  $boxLink = '<a href="' . tep_href_link(FILENAME_DEFAULT, "new_products=1") . '"><img src="' . DIR_WS_TEMPLATES . 'images/infobox/arrow_right.png" border="0" alt="more" title=" more "></a>';
  $box_base_name = 'whats_new'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

    $random_product['products_name'] = tep_get_products_name($random_product['products_id']);
    $random_product['specials_new_products_price'] = tep_get_products_special_price($random_product['products_id']);
// BOF Separate Pricing Per Customer
// global variable (session) $sppc_customer_group_id -> local variable customer_group_id

  if (isset($_SESSION['sppc_customer_group_id']) && $_SESSION['sppc_customer_group_id'] != '0') {
    $customer_group_id = $_SESSION['sppc_customer_group_id'];
  } else {
    $customer_group_id = '0';
  }

       if ($customer_group_id !='0') {
	$customer_group_price_query = tep_db_query("select customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . $random_product['products_id'] . "' and customers_group_id =  '" . $customer_group_id . "' and customers_group_price != 'null'");
	  if ($customer_group_price = tep_db_fetch_array($customer_group_price_query)) {
	    $random_product['products_price'] = $customer_group_price['customers_group_price'];
	  }
     }
// EOF Separate Pricing Per Customer
    if (tep_not_null($random_product['specials_new_products_price'])) {
      $whats_new_price = '<span style="text-decoration:line-through">' . $currencies->display_price($random_product['products_price'], tep_get_tax_rate($random_product['products_tax_class_id'])) . '</span>&nbsp;&nbsp;';
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