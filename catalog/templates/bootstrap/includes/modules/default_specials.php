<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  $default_specials_query = tep_db_query("select p.products_id, pd.products_name, p.products_image from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' and find_in_set('" . $customer_group_id . "', p.products_hide_from_groups) = '0' and s.customers_group_id = '" . $customer_group_id . "' order by s.specials_date_added desc limit " . MAX_DISPLAY_SPECIAL_PRODUCTS);
  
  if (($no_of_default_specials = tep_db_num_rows($default_specials_query)) > 0) {
	  
    $new_specials_content = NULL;
    while ($default_specials = tep_db_fetch_array($default_specials_query)) {
    
    $pf->loadProduct($default_specials['products_id'], $languages_id, NULL, NULL);
    
      $new_special_content .= '<div class="col-sm-6 col-md-4">';
      $new_special_content .= '  <div class="thumbnail equal-height productHolder">';
      $new_special_content .= '    <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $default_specials['products_id']) . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $default_specials['products_image'], $default_specials['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
      $new_special_content .= '    <div class="caption">';
      $new_special_content .= '      <p class="text-center"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $default_specials['products_id']) . '">' . $new_products['products_name'] . '</a></p>';
      $new_special_content .= '      <hr>';
      $new_special_content .= '      <p class="text-center">' . $pf->getPriceStringShort() . '</p>';
      $new_special_content .= '      <div class="text-center">';
      $new_special_content .= '        <div class="btn-group">' . $pf->getBootstrapProductButtons($default_specials['products_id'], basename($PHP_SELF), $default_specials['products_model'], $default_specials['products_name']) . '</div>';
      $new_special_content .= '      </div>';
      $new_special_content .= '    </div>';
      $new_special_content .= '  </div>';
      $new_special_content .= '</div>';
    }
?>

  <h3>
  <?php echo TABLE_HEADING_DEFAULT_SPECIALS; ?>
  <div class="pull-right"><button type="button" class="btn btn-default btn-xs"><a href="' . tep_href_link(FILENAME_DEFAULT, "show_specials=1") . '">More <span class="glyphicon glyphicon-chevron-right"></span></a></button></div>
  </h3>

  <div class="row">
    <?php echo $new_special_content; ?>
  </div>
      
<?php
  } // if (($no_of_default_specials = tep_db_num_rows($default_specials_query)) > 0)
?>
