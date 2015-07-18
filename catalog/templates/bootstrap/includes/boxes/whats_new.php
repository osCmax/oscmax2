<?php
/*
$Id: whats_new.php 1857 2012-06-20 01:21:38Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// adapted for Separate Pricing Per Customer v4.2 2007/08/10, Hide products and categories from groups 2008/08/04
// Most of this file is changed or moved to BTS - Basic Template System - format.

// BOF Hide products and categories from groups
if ($random_product = tep_random_select("select p.products_id, p.products_image, p.products_tax_class_id, p.products_price from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_TO_CATEGORIES .  " using(products_id) left join " . TABLE_CATEGORIES . " using(categories_id) where products_status = '1' and find_in_set('".$customer_group_id."', p.products_hide_from_groups) = '0' order by products_date_added desc limit " . MAX_RANDOM_SELECT_NEW)) {
// EOF Hide products and categories from groups
?>
<!-- whats_new //-->
<?php
  $boxHeading = '<a href="' . tep_href_link(FILENAME_DEFAULT, "new_products=1") . '">' . BOX_HEADING_WHATS_NEW . '</a>';

  $boxContent_attributes = ' align="center"';
  $boxLink = '<a href="' . tep_href_link(FILENAME_DEFAULT, "new_products=1") . '">' . tep_image(bts_select('images', 'infobox/arrow_right.png'), ICON_ARROW_RIGHT) . '</a>';
  $box_base_name = 'whats_new'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
  
  $pf->loadProduct($random_product['products_id'], $languages_id, NULL, NULL);        
		
  $random_product['products_name'] = tep_get_products_name($random_product['products_id']);

  $boxContent = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $random_product['products_image'], $random_product['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $random_product['products_id']) . '">' . $random_product['products_name'] . '</a><br>' . $pf->getPriceStringShort();

  include (bts_select('boxes', $box_base_name)); // BTS 1.5
    
  // Clear vars to prevent showing on next infobox
  $boxLink = '';
  $boxContent_attributes = '';
?>
<!-- whats_new_eof //-->
<?php
}
?>