<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.

// If you want to only show this on a product page uncomment the next line and the one at the bottom
// if (isset($_GET['products_id'])) {
 
// BOF Hide products and categories from groups
if ($random_product = tep_random_select("select p.products_id, pd.products_name, p.products_image from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' and find_in_set('" . $customer_group_id . "', p.products_hide_from_groups) = '0' and s.customers_group_id = '" . $customer_group_id . "' order by s.specials_date_added desc limit " . MAX_RANDOM_SELECT_SPECIALS)) {
// EOF Hide products and categories from groups	  
?>
<!-- specials //-->
<?php
  $boxHeading = '<a href="' . tep_href_link(FILENAME_DEFAULT, "show_specials=1") . '">' . BOX_HEADING_SPECIALS . '</a>';
  $corner_top_left = 'rounded';
  $corner_top_right = 'rounded';
  $corner_bottom_left = 'rounded';
  $corner_bottom_right = 'rounded'; 
  
  $boxContent_attributes = ' align="center"';
  $boxLink = '<a href="' . tep_href_link(FILENAME_DEFAULT, "show_specials=1") . '">' . tep_image(bts_select('images', 'infobox/arrow_right.png'), ICON_ARROW_RIGHT) . '</a>';
  $box_base_name = 'specials'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
  
  $pf->loadProduct($random_product['products_id'], $languages_id, NULL, NULL); 
  
  $boxContent = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product["products_id"]) . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $random_product['products_image'], $random_product['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . $random_product['products_name'] . '</a><br>' . $pf->getPriceStringShort();

  include (bts_select('boxes', $box_base_name)); // BTS 1.5

  // Clear vars to prevent showing on next infobox
  $boxLink = '';
  $boxContent_attributes = '';
?>
<!-- specials_eof //-->
<?php
  }
// If you want to only show this on a product page uncomment the next line as well as the one at the top
// } 
?>
