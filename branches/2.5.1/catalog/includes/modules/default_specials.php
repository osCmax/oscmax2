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
?>
<!-- default_specials //-->
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
    <tr>
      <td>

<?php
  $info_box_contents = array();
  $info_box_contents[] = array('align' => 'left', 'text' => '<a href="' . tep_href_link(FILENAME_DEFAULT, "show_specials=1") . '" class="headerNavigation">' . TABLE_HEADING_DEFAULT_SPECIALS . '</a>');																																																																																					
  new infoBoxHeading($info_box_contents, true, true, tep_href_link(FILENAME_DEFAULT, "show_specials=1"));

  $row = 0;
  $col = 0;

  while ($default_specials = tep_db_fetch_array($default_specials_query)) {
	  
	$pf->loadProduct($default_specials['products_id'], $languages_id, NULL, NULL);
		
    $info_box_contents[$row][$col] = array ('align' => 'center',
                                            'params' =>'class="smallText"',
                                            'text' => '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $default_specials['products_id']) . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $default_specials['products_image'], $default_specials['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $default_specials['products_id']) . '">' . $default_specials['products_name'] . '</a><br>' . $pf->getPriceStringShort() . '<br>' . $pf->getProductButtons($default_specials['products_id'], basename($PHP_SELF), $default_specials['products_model'], $default_specials['products_name']));
          
    $col ++;
    if ($col >= 3) {
      $col = 0;
      $row ++;
    }
  }
  new contentBox($info_box_contents);
?>
      </td>
    </tr>
    <tr>
      <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
    </tr>
  </table>
<!-- default_specials_eof //-->
<?php
  } // if (($no_of_default_specials = tep_db_num_rows($default_specials_query)) > 0)
?>