<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com
  adapted for Separate Pricing Per Customer v4.2, Hide products and categories from groups 2008/08/05

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<!-- new_products //-->
<table width="100%" cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td>
   <?php
   if (isset($_SESSION['sppc_customer_group_id']) && $_SESSION['sppc_customer_group_id'] != '0') {
      $customer_group_id = $_SESSION['sppc_customer_group_id'];
    } else {
     $customer_group_id = '0';
   }

  if ( (!isset($new_products_category_id)) || ($new_products_category_id == '0') ) {
  // BOF Separate Pricing per Customer, Hide products and categories from groups
    $new_products_query = tep_db_query("select distinct p.products_id, p.products_image, p.products_tax_class_id, p.products_price as products_price, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c using(products_id) left join " . TABLE_CATEGORIES . " c using(categories_id) where p.products_id = pd.products_id and products_status = '1' and find_in_set('" . $customer_group_id . "', products_hide_from_groups) = 0 and find_in_set('" . $customer_group_id . "', categories_hide_from_groups) = 0 and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added desc limit " . MAX_DISPLAY_NEW_PRODUCTS); 
  } else {
    $new_products_query = tep_db_query("select distinct p.products_id, p.products_image, p.products_tax_class_id, p.products_price as products_price, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c using(products_id) left join " . TABLE_CATEGORIES . " c using(categories_id) where p.products_id = pd.products_id and c.parent_id = '" . (int)$new_products_category_id . "' and p.products_status = '1' and find_in_set('" . $customer_group_id . "', products_hide_from_groups) = 0 and find_in_set('" . $customer_group_id . "', categories_hide_from_groups) = 0 and pd.language_id = '" . (int)$languages_id . "' order by p.products_date_added desc limit ". MAX_DISPLAY_NEW_PRODUCTS);
  }
  
  if (($no_of_new_products = tep_db_num_rows($new_products_query)) > 0) {
    // Add heading to infobox	
	$box_content = array();
    $box_content[] = array('align' => 'left', 'text' => '<a href="' . tep_href_link(FILENAME_DEFAULT, "new_products=1") . '" class="headerNavigation">' . sprintf(TABLE_HEADING_NEW_PRODUCTS, strftime('%B')) . '</a>');
    new infoBoxHeading($box_content, true, true, tep_href_link(FILENAME_DEFAULT, "new_products=1"));
  
	while ($_new_products = tep_db_fetch_array($new_products_query)) {
	$new_products[] = $_new_products;
	$list_of_prdct_ids[] = $_new_products['products_id'];
	} 

    $select_list_of_prdct_ids = "products_id = '".$list_of_prdct_ids[0]."' ";
    if ($no_of_new_products > 1) {
      for ($n = 1 ; $n < count($list_of_prdct_ids) ; $n++) {
        $select_list_of_prdct_ids .= "or products_id = '".$list_of_prdct_ids[$n]."' ";   
      }
    }
    // get all customers_group_prices for products with the particular customer_group_id
    // however not necessary for customer_group_id = 0
    if ($customer_group_id != '0') {
      $pg_query = tep_db_query("select pg.products_id, pg.customers_group_price as price from " . TABLE_PRODUCTS_GROUPS . " pg where (" . $select_list_of_prdct_ids . ") and pg.customers_group_id = '" . $customer_group_id . "' and pg.customers_group_price != 'null'");
	  while ($pg_array = tep_db_fetch_array($pg_query)) {
	    $new_prices[] = array ('products_id' => $pg_array['products_id'], 'products_price' => $pg_array['price'], 'specials_new_products_price' => '');
	  }

      for ($x = 0; $x < $no_of_new_products; $x++) {
      // replace products prices with those from customers_group table
        if(!empty($new_prices)) {
	      for ($i = 0; $i < count($new_prices); $i++) {
		    if( $new_products[$x]['products_id'] == $new_prices[$i]['products_id'] ) {
			  $new_products[$x]['products_price'] = $new_prices[$i]['products_price'];
		    } // end if
	      } // end for
	    } // end if(!empty($new_prices)
      } // end for ($x = 0; $x < $no_of_products_new; $x++)
    } // end if ($customer_group_id != '0')

// an extra query is needed for all the specials
	$specials_query = tep_db_query("select products_id, specials_new_products_price from " . TABLE_SPECIALS . " where (".$select_list_of_prdct_ids.") and status = '1' and customers_group_id = '" .$customer_group_id. "' ");
	while ($specials_array = tep_db_fetch_array($specials_query)) {
	  $new_s_prices[] = array ('products_id' => $specials_array['products_id'], 'specials_new_products_price' => $specials_array['specials_new_products_price']);
	} // end while

    // replace products_price with the correct specials_new_products_price
    if(!empty($new_s_prices)) {
	  for ($x = 0; $x < $no_of_new_products; $x++) { 
	    for ($i = 0; $i < count($new_s_prices); $i++) {
		  if( $new_products[$x]['products_id'] == $new_s_prices[$i]['products_id'] ) {
			$new_products[$x]['products_price'] = $new_s_prices[$i]['specials_new_products_price'];
		  } // end if 
	    } // end for
	  } // end for
	} // // end if(!empty($new_s_prices)

    $row = 0;
    $col = 0;
    //  $info_box_contents = array();
    $box_content = array();

    //  while ($new_products = tep_db_fetch_array($new_products_query)) {
    for ($x = 0; $x < $no_of_new_products; $x++) {
      $new_products[$x]['products_name'] = tep_get_products_name($new_products[$x]['products_id']);

      $box_content[$row][$col] = array('align' => 'center',
                                       'params' => 'class="smallText" width="33%" valign="top"',
                                       'text' => '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products[$x]['products_id']) . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $new_products[$x]['products_image'], $new_products[$x]['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $new_products[$x]['products_id']) . '">' . $new_products[$x]['products_name'] . '</a><br>' . $currencies->display_price($new_products[$x]['products_price'], tep_get_tax_rate($new_products[$x]['products_tax_class_id'])));

      $col ++;
      if ($col > 2) {
        $col = 0;
        $row ++;
      } // end if
    } // end for ($x = 0; $x < $no_of_new_products; $x++)
	new contentBox($box_content);
	?>
    </td>
  </tr>
  <tr>
    <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>
    <?php
  } //  end if (($no_of_new_products = tep_db_num_rows($new_products_query)) > 0)
// EOF: MOD - Separate Pricing per Customer
?>
    </td>
  </tr>
</table>
<!-- new_products_eof //-->