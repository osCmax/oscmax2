<?php
/*
$Id: default_specials.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax

  Released under the GNU General Public License
*/
?>

<!-- default_specials //-->
<?php
     $default_specials_query = tep_db_query("select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and s.products_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' and s.customers_group_id = ". (int)$customer_group_id." order by s.specials_date_added DESC limit " . MAX_DISPLAY_SPECIAL_PRODUCTS);
     $default_specials = tep_db_fetch_array($default_specials_query);

         if (isset($default_specials['products_id'])) { ?>        
          <tr>
            <td>
            
<?php
$info_box_contents = array();
//  $info_box_contents[] = array('align' => 'left', 'text' => sprintf(TABLE_HEADING_DEFAULT_SPECIALS, strftime('%B')));
  $info_box_contents[] = array('align' => 'left', 'text' => '<a href="' . tep_href_link(FILENAME_SPECIALS) . '" class="headerNavigation">' . sprintf(TABLE_HEADING_DEFAULT_SPECIALS, strftime('%B') . '</a>'));
  new infoBoxHeading($info_box_contents, true, true, tep_href_link(FILENAME_SPECIALS));

// BOF Separate Price Per Customer
//  global variable (session): $sppc_customers_group_id -> local variable $customer_group_id
  if(!tep_session_is_registered('sppc_customer_group_id')) {
  $customer_group_id = '0';
  } else {
   $customer_group_id = $sppc_customer_group_id;
  }

/*   $specials_query_raw = "select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and s.products_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' order by s.specials_date_added DESC"; */

// BOF: Bugfix 0000061
//  $specials_query_raw = "select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and s.products_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' and s.customers_group_id = ". (int)$customer_group_id." order by s.specials_date_added DESC";
  if ($customer_group_id == '0') {
    $specials_query_raw = "select p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s where p.products_status = '1' and s.products_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' and s.customers_group_id = ". (int)$customer_group_id." order by s.specials_date_added DESC";
  } else {
    $specials_query_raw = "select p.products_id, pd.products_name, IF(pg.customers_group_price IS NOT NULL,pg.customers_group_price, p.products_price) as products_price, p.products_tax_class_id, p.products_image, s.specials_new_products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_SPECIALS . " s LEFT JOIN " . TABLE_PRODUCTS_GROUPS . " pg using (products_id, customers_group_id) where p.products_status = '1' and p.products_id = s.products_id and pd.products_id = s.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1' and s.customers_group_id= '".$customer_group_id."' order by s.specials_date_added desc";
  }
// EOF: Bugfix 0000061
  $specials_split = new splitPageResults($specials_query_raw, MAX_DISPLAY_SPECIAL_PRODUCTS);
    $row = 0;
    $col = 0;
    $specials_query = tep_db_query($specials_split->sql_query);
    $no_of_specials = tep_db_num_rows($specials_query);
// get all product prices from the table products_groups in one query
// traverse specials_query for products_id's, store the query result in a numbered array
   while ($_specials = tep_db_fetch_array($specials_query)) {
     $specials[] = $_specials;
     $list_of_prdct_ids[] = $_specials['products_id'];
   } // end while ($_specials = tep_db_fetch_array($specials_query))
// a line needed for the selection of the products_id's
  $pg_list_of_prdct_ids = "products_id = '".$list_of_prdct_ids[0]."' ";
  if ($no_of_specials > 1) {
   for ($n = 1 ; $n < count($list_of_prdct_ids) ; $n++) {
   $pg_list_of_prdct_ids .= "or products_id = '".$list_of_prdct_ids[$n]."' ";
   }
}
// now get all the customers_group_price's
$pg_query = tep_db_query("select products_id, customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where (".$pg_list_of_prdct_ids.") and customers_group_id =  '" . $customer_group_id . "'");
// put all the info in an array called new_prices
	while ($pg_array = tep_db_fetch_array($pg_query)) {
	$new_prices[] = array ('products_id' => $pg_array['products_id'], 'products_price' => $pg_array['customers_group_price']);
	}
// we already got the results from the query and put them into an array, can't use while now
//    while ($specials = tep_db_fetch_array($specials_query)) {
	for ($x = 0; $x < $no_of_specials; $x++) {
          $info_box_contents[$row][$col] = array ('align' => 'center',
                                                  'params' =>'class="smallText"',
//                                                'text' => '<td><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $specials[$x]['products_id']) . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $specials[$x]['products_image'], $specials[$x]['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $specials[$x]['products_id']) . '">' . $specials[$x]['products_name'] . '</a><br><span style="text-decoration:line-through">' . $currencies->display_price($specials[$x]['products_price'], tep_get_tax_rate($specials[$x]['products_tax_class_id'])) . '</span><br><span class="productSpecialPrice">' . $currencies->display_price($specials[$x]['specials_new_products_price'], tep_get_tax_rate($specials[$x]['products_tax_class_id'])) . '</td>');
                                                  'text' => '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $specials[$x]['products_id']) . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $specials[$x]['products_image'], $specials[$x]['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $specials[$x]['products_id']) . '">' . $specials[$x]['products_name'] . '</a><br><span style="text-decoration:line-through">' . $currencies->display_price($specials[$x]['products_price'], tep_get_tax_rate($specials[$x]['products_tax_class_id'])) . '</span><br><span class="productSpecialPrice">' . $currencies->display_price($specials[$x]['specials_new_products_price'], tep_get_tax_rate($specials[$x]['products_tax_class_id']))); 
          $col ++;
          if ($col >= 3) {
          $col = 0;
          $row ++;
          }
// replace products prices with those from customers_group table
        if(!empty($new_prices)) {
	    for ($i = 0; $i < count($new_prices); $i++) {
		    if( $specials[$x]['products_id'] == $new_prices[$i]['products_id'] ) {
			$specials[$x]['products_price'] = $new_prices[$i]['products_price'];
		    }
	    }
        } // end if(!empty($new_prices)
// EOF Separate Price per Customer, specials code
}
  new contentBox($info_box_contents);
?>
<?php
    } // Ends if at start of file to check for 0 specials   
?>
          </td>
        </tr>
<!-- default_specials_eof //-->