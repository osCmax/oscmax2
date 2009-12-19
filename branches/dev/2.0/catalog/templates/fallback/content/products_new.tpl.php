    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_products_new.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  $products_new_array = array();

  $products_new_query_raw = "select p.products_id, p.products_model, pd.products_name, p.products_image, p.products_price, p.products_tax_class_id, p.products_date_added, m.manufacturers_name from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on (p.manufacturers_id = m.manufacturers_id), " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and month(p.products_date_added) = month(now()) order by p.products_date_added DESC, pd.products_name";
  $products_new_split = new splitPageResults($products_new_query_raw, MAX_DISPLAY_PRODUCTS_NEW);

  if (($products_new_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo $products_new_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $products_new_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if ($products_new_split->number_of_rows > 0) {
// BOF Separate Price Per Customer
//  global variable (session): $sppc_customers_group_id -> local variable $customer_group_id

  if(!tep_session_is_registered('sppc_customer_group_id')) { 
  $customer_group_id = '0';
  } else {
   $customer_group_id = $sppc_customer_group_id;
  }
    $products_new_query = tep_db_query($products_new_split->sql_query);
    $no_of_products_new = tep_db_num_rows($products_new_query);
    while ($_products_new = tep_db_fetch_array($products_new_query)) {
  	$products_new[] = $_products_new;
	$list_of_prdct_ids[] = $_products_new['products_id'];  
    }
    
  $select_list_of_prdct_ids = "products_id = '".$list_of_prdct_ids[0]."' ";
   if ($no_of_products_new > 1) {
      for ($n = 1 ; $n < count($list_of_prdct_ids) ; $n++) {
      $select_list_of_prdct_ids .= "or products_id = '".$list_of_prdct_ids[$n]."' ";   
      }
   }

// get all customers_group_prices for products with the particular customer_group_id
// however not necessary for customer_group_id
if ($customer_group_id != '0') {
  $pg_query = tep_db_query("select pg.products_id, customers_group_price as price from " . TABLE_PRODUCTS_GROUPS . " pg where (".$select_list_of_prdct_ids.") and pg.customers_group_id = '".$customer_group_id."'");
	while ($pg_array = tep_db_fetch_array($pg_query)) {
	$new_prices[] = array ('products_id' => $pg_array['products_id'], 'products_price' => $pg_array['price'], 'specials_new_products_price' => '');
	}

   for ($x = 0; $x < $no_of_products_new; $x++) {
// replace products prices with those from customers_group table
// originally they would be obtained with an extra query for every new product:
//   if ($new_price = tep_get_products_special_price($products_new['products_id'])) {
      
        if(!empty($new_prices)) {
	    for ($i = 0; $i < count($new_prices); $i++) {
		    if( $products_new[$x]['products_id'] == $new_prices[$i]['products_id'] ) {
			$products_new[$x]['products_price'] = $new_prices[$i]['products_price'];
		    }
	    }
	} // end if(!empty($new_prices)
   } // end for ($x = 0; $x < $no_of_products_new; $x++)
} // end if ($customer_group_id != '0')

// an extra query is needed for all the specials

	$specials_query = tep_db_query("select s.products_id, specials_new_products_price from " . TABLE_SPECIALS . " s  where (".$select_list_of_prdct_ids.") and status = '1' and s.customers_group_id = '" .$customer_group_id. "'");
	while ($specials_array = tep_db_fetch_array($specials_query)) {
	$new_prices[] = array ('products_id' => $specials_array['products_id'], 'products_price' => '', 'specials_new_products_price' => $specials_array['specials_new_products_price']);
	}

// replace specials_new_products_price with those those for the customers_group_id
	for ($x = 0; $x < $no_of_products_new; $x++) {
      
        if(!empty($new_prices)) {
	    for ($i = 0; $i < count($new_prices); $i++) {
		    if( $products_new[$x]['products_id'] == $new_prices[$i]['products_id'] ) {
			$products_new[$x]['specials_new_products_price'] = $new_prices[$i]['specials_new_products_price'];
		    }
	       }
	   } // end if(!empty($new_prices)
//	} // end for ($x = 0; $x < $no_of_products_new; $x++)
		
	if (tep_not_null($products_new[$x]['specials_new_products_price'])) {
	        $products_price = '<span style="text-decoration:line-through">' . $currencies->display_price($products_new[$x]['products_price'], tep_get_tax_rate($products_new[$x]['products_tax_class_id'])) . '</span> <span class="productSpecialPrice">' . $currencies->display_price($products_new[$x]['specials_new_products_price'], tep_get_tax_rate($products_new[$x]['products_tax_class_id'])) . '</span>';
	} else {
		$products_price = $currencies->display_price($products_new[$x]['products_price'], tep_get_tax_rate($products_new[$x]['products_tax_class_id']));
	}
?>
          <tr>
            <td width="<?php echo SMALL_IMAGE_WIDTH + 10; ?>" valign="top" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_new[$x]['products_id']) . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $products_new[$x]['products_image'],addslashes($products_new[$x]['products_name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>'; ?></td>
            <td valign="top" class="main"><?php 
	$display_manufacturer = '';
	if (PRODUCT_LIST_MANUFACTURER)$display_manufacturer = '<br>' . TEXT_MANUFACTURER . ' ' . $products_new[$x]['manufacturers_name'] ;
            
            echo '<a href="' 
            . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products_new[$x]['products_id']) . '"><strong><u>' . $products_new[$x]['products_name'] . '</u></strong></a><br>Model:'. $products_new[$x]['products_model'] . '<br>' . TEXT_DATE_ADDED . ' ' . tep_date_long($products_new[$x]['products_date_added']) 
            . $display_manufacturer
            . '<br><br>' . TEXT_PRICE . ' ' . $products_price; ?></td>
            <td align="right" valign="middle" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCTS_NEW, tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $products_new[$x]['products_id']) . '">' . tep_image_button('button_in_cart.gif', IMAGE_BUTTON_IN_CART) . '</a>'; ?></td>
          </tr>
          <tr>
            <td colspan="3"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
<?php // EOF Separate Pricing Per Customer
   } // end for ($x = 0; $x < $products_new_split->number_of_rows; $x++)
 }  else { 
?>
          <tr>
            <td class="main"><?php echo TEXT_NO_NEW_PRODUCTS; ?></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
<?php
  }
?>
        </table></td>
      </tr>
<?php
  if (($products_new_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo $products_new_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $products_new_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
    </table>

