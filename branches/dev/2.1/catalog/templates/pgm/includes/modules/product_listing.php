<?php
/*
$Id: product_listing.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/


?>
<!-- PGM SORT ORDER, NUMBER DISPLAY, GRID SWITCH -->
<?php

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
  if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {

$list = '<table align="center"><tr><td width="20" align="center"><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('list')). 'list=list') . '"> ' . tep_image(DIR_WS_TEMPLATES . 'images/list.png', 'View as List') . '</a></td><td width="80" class="smallText"><a class="filterbox" href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('list')). 'list=list') . '">View as List</a></td></tr></table>';

$grid = '<table align="center"><tr><td width="20" align="center"><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('list')). 'list=manufacturer') . '"> ' . tep_image(DIR_WS_TEMPLATES . 'images/grid.png', 'View as Grid') . '</a></td><td width="80" class="smallText"><a class="filterbox" href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('list')). 'list=manufacturer') . '">View as Grid</a></td></tr></table>';

$page_nav = '<table border="0" width="100%" cellspacing="0" cellpadding="2" class="filterbox"><tr><td class="smallText" width="33%">' .  $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS) . '</td><td class="smallText" width="33%" align="center">' . $list . '</td><td class="smallText" width="33%" align="right">' . TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))) . '</td></tr>';

$drop = '<tr><td class="smallText">Results/Page: '. tep_draw_form('maxdisplay', tep_href_link(basename($PHP_SELF), '', $request_type, false), 'get') . $get_vars . (isset($_GET['sort']) ? tep_draw_hidden_field('sort', $_GET['sort']) : '') .  tep_draw_pull_down_menu('max', $max_display, $_GET['max'], 'onChange="this.form.submit();"') . tep_hide_session_id().'</form></td><td align="center">' . $grid . '</td><td class="smallText" align="right">Sort Order: ' . tep_draw_form('sorting', tep_href_link(basename($PHP_SELF), '', $request_type, false), 'get') . $get_vars . (isset($_GET['max']) ? tep_draw_hidden_field('max', $_GET['max']) : '') . tep_draw_pull_down_menu('sort', $sort_array, $_GET['sort'], 'onChange="this.form.submit();"') . tep_hide_session_id().'</form></td></tr></table>';

echo $page_nav;
echo $drop;
echo tep_draw_separator('pixel_trans.gif', '100%', '10');

?>
<!-- PGM SORT ORDER, NUMBER DISPLAY, GRID SWITCH -->

<?php
  }
  
  $list_box_contents = array();

  for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
    switch ($column_list[$col]) {
      case 'PRODUCT_LIST_MODEL':
        $lc_text = TABLE_HEADING_MODEL;
        $lc_align = '';
// LINE ADDED
        $lc_class = 'class="headerNavigation"';
        break;
      case 'PRODUCT_LIST_NAME':
        $lc_text = TABLE_HEADING_PRODUCTS;
        $lc_align = '';
// LINE ADDED
        $lc_class = 'class="headerNavigation"';
        break;
      case 'PRODUCT_LIST_MANUFACTURER':
        $lc_text = TABLE_HEADING_MANUFACTURER;
        $lc_align = '';
// LINE ADDED
        $lc_class = 'class="headerNavigation"';
        break;
      case 'PRODUCT_LIST_PRICE':
        $lc_text = TABLE_HEADING_PRICE;
        $lc_align = 'right';
// LINE ADDED
        $lc_class = 'class="headerNavigation"';
        break;
      case 'PRODUCT_LIST_QUANTITY':
        $lc_text = TABLE_HEADING_QUANTITY;
        $lc_align = 'right';
// LINE ADDED
        $lc_class = 'class="headerNavigation"';
        break;
      case 'PRODUCT_LIST_WEIGHT':
        $lc_text = TABLE_HEADING_WEIGHT;
        $lc_align = 'right';
// LINE ADDED
        $lc_class = 'class="headerNavigation"';
        break;
      case 'PRODUCT_LIST_IMAGE':
        $lc_text = TABLE_HEADING_IMAGE;
        $lc_align = 'center';
// LINE ADDED
        $lc_class = 'class="headerNavigation"';
        break;
      case 'PRODUCT_LIST_BUY_NOW':
// Bugfix 0000069        
//      $lc_text = '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action', 'pName')) . 'action=buy_now&products_id=' . $listing['products_id']) . '">' . tep_image_button('button_buy_now.gif', IMAGE_BUTTON_BUY_NOW) . '</a> ';
        $lc_text = TABLE_HEADING_BUY_NOW;
// LINE ADDED
        $lc_align = 'center';
        break;
    }

    if ( ($column_list[$col] != 'PRODUCT_LIST_BUY_NOW') && ($column_list[$col] != 'PRODUCT_LIST_IMAGE') ) {
      $lc_text = tep_create_sort_heading($_GET['sort'], $col+1, $lc_text);
    }

    $list_box_contents[0][] = array('align' => $lc_align,
// OLD                              'params' => 'class="productListing-heading"',
                                    'params' => $lc_class,
                                    'text' => '&nbsp;' . $lc_text . '&nbsp;');
  }

  if ($listing_split->number_of_rows > 0) {
    $rows = 0;
    $listing_query = tep_db_query($listing_split->sql_query);
// BOF: MOD - Separate Pricing per Customer
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
    for ($n = 1 ; $n < count($list_of_prdct_ids) ; $n++) {
      $select_list_of_prdct_ids .= "or products_id = '".$list_of_prdct_ids[$n]."' ";
    }
  }

// get all product prices for products with the particular customer_group_id
// however not necessary for customer_group_id = 0
  if ($customer_group_id != '0') {
    $pg_query = tep_db_query("select pg.products_id, customers_group_price as price from " . TABLE_PRODUCTS_GROUPS . " pg where (".$select_list_of_prdct_ids.") and pg.customers_group_id = '".$customer_group_id."' ");
//  $no_of_pg_products = tep_db_num_rows($pg_query) ;
    while ($pg_array = tep_db_fetch_array($pg_query)) {
      $new_prices[] = array ('products_id' => $pg_array['products_id'], 'products_price' => $pg_array['price'], 'specials_new_products_price' => '', 'final_price' => $pg_array['price']);
    }
    for ($x = 0; $x < $no_of_listings; $x++) {
// replace products prices with those from customers_group table
      if(!empty($new_prices)) {
        for ($i = 0; $i < count($new_prices); $i++) {
          if( $listing[$x]['products_id'] == $new_prices[$i]['products_id'] ) {
            $listing[$x]['products_price'] = $new_prices[$i]['products_price'];
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
	for ($x = 0; $x < $no_of_listings; $x++) {
// EOF: MOD - Separate Pricing per Customer

      $rows++;

      if (($rows/2) == floor($rows/2)) {
        $list_box_contents[] = array('params' => 'class="productListing-even"');
      } else {
        $list_box_contents[] = array('params' => 'class="productListing-odd"');
      }

      $cur_row = sizeof($list_box_contents) - 1;

      for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
        $lc_align = '';

// BOF: MOD - Separate Pricing per Customer - Added on may lines [$x]
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
              $lc_text = '&nbsp;<s>' .  $currencies->display_price($listing[$x]['products_price'], tep_get_tax_rate($listing[$x]['products_tax_class_id'])) . '</s>&nbsp;&nbsp;<span class="productSpecialPrice">' . $currencies->display_price($listing[$x]['specials_new_products_price'], tep_get_tax_rate($listing[$x]['products_tax_class_id'])) . '</span>&nbsp;';
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
            break;
          case 'PRODUCT_LIST_BUY_NOW':
            $lc_align = 'center';
            $lc_text = '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $listing[$x]['products_id']) . '">' . tep_image_button('button_buy_now.gif', IMAGE_BUTTON_BUY_NOW) . '</a>&nbsp;';
            break;
// EOF: MOD - Separate Pricing per Customer - Added on may lines [$x]
        }

        $list_box_contents[$cur_row][] = array('align' => $lc_align,
                                               'params' => 'class="productListing-data"',
                                               'text'  => $lc_text);
      }
    }

    new productListingBox($list_box_contents);
  } else {
    $list_box_contents = array();

    $list_box_contents[0] = array('params' => 'class="productListing-odd"');
    $list_box_contents[0][] = array('params' => 'class="productListing-data"',
                                   'text' => TEXT_NO_PRODUCTS);

    new productListingBox($list_box_contents);
  }

  if ( ($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td class="smallText"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
    <td class="smallText" align="right"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
  </tr>
</table>
<?php
  }
?>