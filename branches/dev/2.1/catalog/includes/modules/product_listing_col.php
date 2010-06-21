<?php
/*
$Id: product_listing_col.php 14 2006-07-28 17:42:07Z user $
*/
?>
<!-- PGM SORT ORDER, NUMBER DISPLAY, GRID SWITCH -->

<?php

$thumbnail_view = (isset($_GET['list']) ? $_GET['list'] : 'list'); 

if (tep_not_null($_GET['sort'])) $_GET['sort'] = $_GET['sort'];
$max_results = (tep_not_null($_GET['max']) ? $_GET['max'] : MAX_DISPLAY_SEARCH_RESULTS);


// sort order array
for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
      switch ($column_list[$i]) {
        case 'PRODUCT_LIST_NAME':
          $sort_array[] = array('id' => '2a', 'text' => 'Product Name (A-Z)');
		  $sort_array[] = array('id' => '2d', 'text' => 'Product Name (Z-A)');
          break;
        case 'PRODUCT_LIST_PRICE':
		  $sort_array[] = array('id' => '3a', 'text' => 'Price (Low - High)');
		  $sort_array[] = array('id' => '3d', 'text' => 'Price (High - Low)');
          break;	
      }
    }

// Max Results Array		
for ($i=1, $n=5; $i<$n; $i++) {		
		$max_display[] = array('id' => MAX_DISPLAY_SEARCH_RESULTS * $i, 'text' => MAX_DISPLAY_SEARCH_RESULTS * $i); 
		}	
		$max_display[] = array('id' => 1000000, 'text' => 'Show All');

// store GET vars		
$get_vars = '';
    reset($_GET);
    while (list($key, $value) = each($_GET)) {
      if ( ($key != 'sort') && ($key != 'max') && ($key != tep_session_name()) && ($key != 'x') && ($key != 'y') ) {
        $get_vars .= tep_draw_hidden_field($key, $value);
      }
    }

$listing_split = new splitPageResults($listing_sql, $max_results, 'p.products_id');
  if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {

$list = '<table align="center"><tr><td width="20" align="center"><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('list')). 'list=list') . '"> ' . tep_image(DIR_WS_ICONS . 'list.png', 'View as List') . '</a></td><td width="80" class="smallText"><a class="filterbox" href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('list')). 'list=list') . '">View as List</a></td></tr></table>';

$grid = '<table align="center"><tr><td width="20" align="center"><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('list')). 'list=grid') . '"> ' . tep_image(DIR_WS_ICONS . 'grid.png', 'View as Grid') . '</a></td><td width="80" class="smallText"><a class="filterbox" href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('list')). 'list=grid') . '">View as Grid</a></td></tr></table>';

$page_nav = '<table border="0" width="100%" cellspacing="0" cellpadding="2" class="filterbox"><tr><td class="smallText" width="33%">' .  $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS) . '</td><td class="smallText" width="33%" align="center">' . $list . '</td><td class="smallText" width="33%" align="right">' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))) . '</td></tr>';

$drop = '<tr><td class="smallText">Results/Page: '. tep_draw_form('maxdisplay', tep_href_link(basename($PHP_SELF), '', $request_type, false), 'get') . $get_vars . (isset($_GET['sort']) ? tep_draw_hidden_field('sort', $_GET['sort']) : '') .  tep_draw_pull_down_menu('max', $max_display, $_GET['max'], 'onChange="this.form.submit();"') . tep_hide_session_id().'</form></td><td align="center">' . $grid . '</td><td class="smallText" align="right">Sort Order: ' . tep_draw_form('sorting', tep_href_link(basename($PHP_SELF), '', $request_type, false), 'get') . $get_vars . (isset($_GET['max']) ? tep_draw_hidden_field('max', $_GET['max']) : '') . tep_draw_pull_down_menu('sort', $sort_array, $_GET['sort'], 'onChange="this.form.submit();"') . tep_hide_session_id().'</form></td></tr></table>';

echo $page_nav;
echo $drop;
echo tep_draw_separator('pixel_trans.gif', '100%', '10');

?>
<!-- PGM SORT ORDER, NUMBER DISPLAY, GRID SWITCH -->

<?php
  }

  $list_box_contents = array();

  if ($listing_split->number_of_rows > 0) {
$row = 0;
  $rows = 0;
   $column = 0;
   $listing_query = tep_db_query($listing_split->sql_query);
// BOF Separate Pricing per Customer
   $no_of_listings = tep_db_num_rows($listing_query);
// global variable (session) $sppc_customer_group_id -> local variable customer_group_id

 if(!tep_session_is_registered('sppc_customer_group_id')) {
 $customer_group_id = '0';
 } else {
  $customer_group_id = $sppc_customer_group_id;
 }

while ($_listing = tep_db_fetch_array($listing_query)) {
$listing[] = $_listing;
$list_of_prdct_ids[] = $_listing['products_id'];
}
// next part is a debug feature, when uncommented it will print the info that this module receives
/*
  echo '<pre>';
  print_r($listing);
  echo '</pre>';
*/
 $select_list_of_prdct_ids = "products_id = '".$list_of_prdct_ids[0]."' ";
 if ($no_of_listings > 1) {
  for ($n = 1; $n < count($list_of_prdct_ids); $n++) {
  $select_list_of_prdct_ids .= "or products_id = '".$list_of_prdct_ids[$n]."' ";
  }
}

// get all product prices for products with the particular customer_group_id
// however not necessary for customer_group_id = 0
if ($customer_group_id != '0') {
 $pg_query = tep_db_query("select pg.products_id, customers_group_price as price from " . TABLE_PRODUCTS_GROUPS . " pg where (".$select_list_of_prdct_ids.") and pg.customers_group_id = '".$customer_group_id."' ");
//   $no_of_pg_products = tep_db_num_rows($pg_query);
while ($pg_array = tep_db_fetch_array($pg_query)) {
$new_prices[] = array ('products_id' => $pg_array['products_id'], 'products_price' => $pg_array['price'], 'specials_new_products_price' => '', 'final_price' => $pg_array['price']);
}
  for ($x = 0; $x < $no_of_listings; $x++) {
// replace products prices with those from customers_group table
     if(!empty($new_prices)) {
        for ($i = 0; $i < count($new_prices); $i++) {
    if( $listing[$x]['products_id'] == $new_prices[$i]['products_id'] ) {
 $listing[$x]['products_price'] = $new_prices[$i]['products_price'];
 $listing[$x]['specials_new_products_price'] = $new_prices[$i]['specials_new_products_price'];
 $listing[$x]['final_price'] = $new_prices[$i]['final_price'];
 }
    }
} // end if(!empty($new_prices)
$listing[$x]['specials_new_products_price'] = ''; // makes sure that a retail specials price doesn't carry over to another customer group
$listing[$x]['final_price'] = $listing[$x]['products_price']; // final price should not be the retail special price
 } // end for ($x = 0; $x < $no_of_listings; $x++)
} // end if ($customer_group_id != '0')
// an extra query is needed for all the specials

$specials_query = tep_db_query("select products_id, specials_new_products_price from " . TABLE_SPECIALS . " where (".$select_list_of_prdct_ids.") and status = '1' and customers_group_id = '" .$customer_group_id. "'");
while ($specials_array = tep_db_fetch_array($specials_query)) {
$new_s_prices[] = array ('products_id' => $specials_array['products_id'], 'products_price' => '', 'specials_new_products_price' => $specials_array['specials_new_products_price'] , 'final_price' => $specials_array['specials_new_products_price']);
}

// add the correct specials_new_products_price and replace final_price
for ($x = 0; $x < $no_of_listings; $x++) {

       if(!empty($new_s_prices)) {
    for ($i = 0; $i < count($new_s_prices); $i++) {
  if( $listing[$x]['products_id'] == $new_s_prices[$i]['products_id'] ) {
    $listing[$x]['specials_new_products_price'] = $new_s_prices[$i]['specials_new_products_price'];
    $listing[$x]['final_price'] = $new_s_prices[$i]['final_price'];
  }
       }
   } // end if(!empty($new_s_prices)
} // end for ($x = 0; $x < $no_of_listings; $x++)

//    while ($listing = tep_db_fetch_array($listing_query)) { (was original code)
// WARNING the code assumes there are three products per row. To use a different number change the number
// at line 195: if ($column >= 3) and the code to fill up the table row below that accordingly
  $counter = $row;
  $class_for_buy_now = 'class="productListing-odd"';
  $list_box_contents[$row] = array('params' => 'class="productListing-odd"');
for ($x = 0; $x < $no_of_listings; $x++) {

     $rows++;

    if (($rows/2) == floor($rows/2) && ($row > $counter)) {
      $list_box_contents[$row] = array('params' => 'class="productListing-even"');
      $class_for_buy_now = 'class="productListing-even"';
      $counter = $row;
    } else {
     if ($row > $counter) {
      $list_box_contents[$row] = array('params' => 'class="productListing-odd"');
      $class_for_buy_now = 'class="productListing-odd"';
      $counter = $row;
     }
    }
      $product_contents = array();

      for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
        $lc_align = '';

        switch ($column_list[$col]) {
          case 'PRODUCT_LIST_MODEL':
            $lc_align = '';
           $lc_text = '&nbsp;' . $listing[$x]['products_model'] . '&nbsp;';
            break;
          case 'PRODUCT_LIST_NAME':
            $lc_align = '';
            if (isset($_GET['manufacturers_id'])) {
             $lc_text = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $_GET['manufacturers_id'] . '&products_id=' . $listing[$x]['products_id']) . '">' . $listing[$x]['products_name'] . '</a>';
            } else {
             $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $listing[$x]['products_id']) . '">' . $listing[$x]['products_name'] . '</a>&nbsp;';
            }
            break;
          case 'PRODUCT_LIST_MANUFACTURER':
            $lc_align = '';
           $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $listing[$x]['manufacturers_id']) . '">' . $listing[$x]['manufacturers_name'] . '</a>&nbsp;';
            break;
          case 'PRODUCT_LIST_PRICE':
            $lc_align = 'right';


           if (tep_not_null($listing[$x]['specials_new_products_price'])) {
             $lc_text = '&nbsp;<span style="text-decoration:line-through">' .  $currencies->display_price($listing[$x]['products_price'], tep_get_tax_rate($listing[$x]['products_tax_class_id'])) . '</span><br>&nbsp;&nbsp;<span class="productSpecialPrice">' . $currencies->display_price($listing[$x]['specials_new_products_price'], tep_get_tax_rate($listing[$x]['products_tax_class_id'])) . '</span>&nbsp;';
            } else {
             $lc_text = '&nbsp;' . $currencies->display_price($listing[$x]['products_price'], tep_get_tax_rate($listing[$x]['products_tax_class_id'])) . '&nbsp;';
            }
            break;
          case 'PRODUCT_LIST_QUANTITY':
            $lc_align = 'right';
           $lc_text = '&nbsp;' . $listing[$x]['products_quantity'] . '&nbsp;';
            break;
          case 'PRODUCT_LIST_WEIGHT':
            $lc_align = 'right';
           $lc_text = '&nbsp;' . $listing[$x]['products_weight'] . '&nbsp;';
            break;
          case 'PRODUCT_LIST_IMAGE':
            $lc_align = 'center';
            if (isset($_GET['manufacturers_id'])) {
             $lc_text = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $_GET['manufacturers_id'] . '&products_id=' . $listing[$x]['products_id']) . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $listing[$x]['products_image'], $listing[$x]['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
            } else {
             $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $listing[$x]['products_id']) . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $listing[$x]['products_image'], $listing[$x]['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>&nbsp;';
            }
           break; // EOF Separate Pricing per Customer
          case 'PRODUCT_LIST_BUY_NOW':
           $lc_align = 'center';
           $lc_text = '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action', 'pName')) . 'action=buy_now&products_id=' . $listing[$x]['products_id']) . '">' . tep_image_button('button_buy_now.gif', IMAGE_BUTTON_BUY_NOW) . '</a> ';
           break;
        }
        $product_contents[] = $lc_text;

      }
      $lc_text = implode('<br>', $product_contents);
      $list_box_contents[$row][$column] = array('align' => 'center',
                                                'params' => 'class="productListing-data"',
                                                'text'  => $lc_text);
      $column ++;

			if ($column >= PRODUCT_LIST_NUM_COLUMNS) {
        $row ++;
        $column = 0;
			}

    } // line 102 (N of listing per current page)
    if ($column > 0){
    	for ($x = $column; $x < PRODUCT_LIST_NUM_COLUMNS; $x++){
    		
    		$list_box_contents[$row][$column] = array('align' => 'center',
                                              'params' => 'class="productListing-data" ',
                                              'text'  => "&nbsp;");
 				$column++;
    		
    	}
    }
    
    

    new productListingBox($list_box_contents);
  } else { // from line 21
    $list_box_contents = array();

    $list_box_contents[0] = array('params' => 'class="productListing-odd"');
    $list_box_contents[0][] = array('params' => 'class="productListing-data" yyyyyy',
                                   'text' => TEXT_NO_PRODUCTS);

    new productListingBox($list_box_contents);
  }

  if ( ($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
  	<td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
  </tr>
</table>
<table class="filterbox" width="100%" cellpadding="2" cellspacing="0" border="0">
  <tr>
    <td class="smallText"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
    <td class="smallText" align="right"><?php echo $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
  </tr>
</table>
<?php
  }
?>