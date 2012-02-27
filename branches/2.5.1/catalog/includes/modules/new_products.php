<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  // This checks if we are using this module at the index_nested level
  if ( (!isset($new_products_category_id)) || ($new_products_category_id == '0') ) {
  // BOF Separate Pricing per Customer, Hide products and categories from groups
    $new_products_query = tep_db_query("select distinct p.products_id, p.products_image, p.products_tax_class_id, p.products_price as products_price, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c using(products_id) left join " . TABLE_CATEGORIES . " c using(categories_id) where p.products_id = pd.products_id and products_status = '1' and find_in_set('" . $customer_group_id . "', products_hide_from_groups) = 0 and find_in_set('" . $customer_group_id . "', categories_hide_from_groups) = 0 and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added desc limit " . MAX_DISPLAY_NEW_PRODUCTS); 
  } else {
    $new_products_query = tep_db_query("select distinct p.products_id, p.products_image, p.products_tax_class_id, p.products_price as products_price, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c using(products_id) left join " . TABLE_CATEGORIES . " c using(categories_id) where p.products_id = pd.products_id and c.parent_id = '" . (int)$new_products_category_id . "' and p.products_status = '1' and find_in_set('" . (int)$new_products_category_id . "', products_hide_from_groups) = 0 and find_in_set('" . (int)$new_products_category_id . "', categories_hide_from_groups) = 0 and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added desc limit ". MAX_DISPLAY_NEW_PRODUCTS);
  }
  
  if (($no_of_new_products = tep_db_num_rows($new_products_query)) > 0) {
  ?>
<!-- new_products //-->
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td>
  <?php

    // Add heading to infobox	
	$box_content = array();
    $box_content[] = array('align' => 'left', 'text' => '<a href="' . tep_href_link(FILENAME_DEFAULT, "new_products=1") . '" class="headerNavigation">' . sprintf(TABLE_HEADING_NEW_PRODUCTS, strftime('%B')) . '</a>');
    new infoBoxHeading($box_content, true, true, tep_href_link(FILENAME_DEFAULT, "new_products=1"));
  
    $row = 0;
    $col = 0;
    $box_content = array();
	
    while ($new_products = tep_db_fetch_array($new_products_query)) {
		
	  $pf->loadProduct($new_products['products_id'], $languages_id, NULL, NULL);
		
        $box_content[$row][$col] = array('align' => 'center',
                                         'params' => 'class="smallText" width="33%" valign="top"',
                                         'text' => '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $new_products['products_image'], $new_products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products['products_id']) . '">' . $new_products['products_name'] . '</a><br>' . $pf->getPriceStringShort() . '<br>' . $pf->getProductButtons($new_products['products_id'], basename($PHP_SELF), $new_products['products_model'], $new_products['products_name']));
									   
      $col ++;
      if ($col > 2) {
        $col = 0;
        $row ++;
      } // end if
    } // end while ($new_products = tep_db_fetch_array($new_products_query)) {
	new contentBox($box_content);
	?>
    </td>
  </tr>
  <tr>
    <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
  </tr>
</table>
<!-- new_products_eof //-->
<?php
  } //  end if (($no_of_new_products = tep_db_num_rows($new_products_query)) > 0)
?>