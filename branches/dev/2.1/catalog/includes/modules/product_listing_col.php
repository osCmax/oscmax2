<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<!-- PGM fix for Corner Banners in Internet Explorer -->
<!--[if lte IE 8]>
<style>
img.corner_banner { display:inline-block; margin-left:-105px; margin-top:-7px; position:absolute; } 
</style>
<![endif]-->

<!-- PGM SORT ORDER, NUMBER DISPLAY, GRID SWITCH -->
<?php

if (tep_not_null($_GET['sort'])) $_GET['sort'] = $_GET['sort'];
$max_results = (tep_not_null(isset($_GET['max'])) ? $_GET['max'] : MAX_CATALOG_DISPLAY_SEARCH_RESULTS);

// sort order array
for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
      switch ($column_list[$i]) {
        case 'PRODUCT_LIST_NAME':
          $sort_array[] = array('id' => $i . 'a', 'text' => TEXT_PRODUCT_NAME_AZ);
		  $sort_array[] = array('id' => $i . 'd', 'text' => TEXT_PRODUCT_NAME_ZA);
          break;
        case 'PRODUCT_LIST_PRICE':
		  $sort_array[] = array('id' => $i . 'a', 'text' => TEXT_PRICE_LOW_HIGH);
		  $sort_array[] = array('id' => $i . 'd', 'text' => TEXT_PRICE_HIGH_LOW);
          break;
		case 'PRODUCT_LIST_BESTSELLER':
		  $sort_array[] = array('id' => $i . 'd', 'text' => TEXT_PRICE_BESTSELLER);
          break;	
      }
    }

// Max Results Array		
for ($i=1, $n=5; $i<$n; $i++) {		
		$max_display[] = array('id' => MAX_CATALOG_DISPLAY_SEARCH_RESULTS * $i, 'text' => MAX_CATALOG_DISPLAY_SEARCH_RESULTS * $i); 
		}	
		$max_display[] = array('id' => 1000000, 'text' => TEXT_SHOW_ALL);

// store GET vars		
$get_vars = '';
    reset($_GET);
    while (list($key, $value) = each($_GET)) {
      if ( ($key != 'sort') && ($key != 'max') && ($key != tep_session_name()) && ($key != 'x') && ($key != 'y') ) {
        $get_vars .= tep_draw_hidden_field($key, $value);
      }
    }

// set gridlist session variable to list
$_SESSION['gridlist'] = 'grid';

$listing_split = new splitPageResults($listing_sql, $max_results, 'p.products_id');
  if ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) {

$list = '<table align="left"><tr><td width="20" align="center"><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('gridlist')). 'gridlist=list') . '"> ' . tep_image(DIR_WS_ICONS . 'list.png', 'View as List') . '</a></td><td class="smallText"><a class="filterbox" href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('gridlist')). 'gridlist=list') . '">' . TEXT_VIEW_AS_LIST . '</a></td></tr></table>';

$grid = '<table align="left"><tr><td width="20" align="center"><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('gridlist')). 'gridlist=grid') . '"> ' . tep_image(DIR_WS_ICONS . 'grid.png', 'View as Grid') . '</a></td><td class="smallText"><a class="filterbox" href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('gridlist')). 'gridlist=grid') . '">' . TEXT_VIEW_AS_GRID . '</a></td></tr></table>';

// BOF SPPC Hide products and categories from groups
  $page =  $_SERVER["SCRIPT_NAME"];
  $break = Explode('/', $page);
  $pfile = $break[count($break) - 1];
  
    if (PRODUCT_LIST_FILTER > 0) {
      if (isset($_GET['manufacturers_id'])) {
        $filterlist_sql = "select distinct c.categories_id as id, cd.categories_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where p.products_status = '1' and find_in_set('" . $customer_group_id . "', categories_hide_from_groups) = 0 and find_in_set('".$customer_group_id."', products_hide_from_groups) = 0 and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p2c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' order by c.sort_order, cd.categories_name";
      } else {
        $filterlist_sql= "select distinct m.manufacturers_id as id, m.manufacturers_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES . " using(categories_id), " . TABLE_MANUFACTURERS . " m where p.products_status = '1' and find_in_set('" . $customer_group_id . "', categories_hide_from_groups) = 0 and find_in_set('".$customer_group_id."', products_hide_from_groups) = 0 and p.manufacturers_id = m.manufacturers_id and p.products_id = p2c.products_id and p2c.categories_id = '" . (int)$current_category_id . "' order by m.manufacturers_name";
      }
// EOF SPPC Hide products and categories from groups

	  $filter = '';
      $filterlist_query = tep_db_query($filterlist_sql);
      if ( (tep_db_num_rows($filterlist_query) > 1) && ($pfile != 'advanced_search_result.php') ) {
        $filter .= tep_draw_form('filter', FILENAME_DEFAULT, 'get') . TEXT_SHOW . '&nbsp;';
        if (isset($_GET['manufacturers_id'])) {
        $filter .= tep_draw_hidden_field('manufacturers_id', $_GET['manufacturers_id']);
          $options = array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES));
        } else {
          $filter .= tep_draw_hidden_field('cPath', $cPath);
          $options = array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS));
        } // end if
        $filter .= tep_draw_hidden_field('sort', $_GET['sort']);
        while ($filterlist = tep_db_fetch_array($filterlist_query)) {
          $options[] = array('id' => $filterlist['id'], 'text' => $filterlist['name']);
        } // end while
        $filter .= tep_draw_pull_down_menu('filter_id', $options, (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''), 'onchange="this.form.submit()"');
        $filter .= tep_hide_session_id() . '</form>' . "\n";
      } else {
		$filter .= $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS);
	  }
	} // end PRODUCT FILTER if

if ($listing_split->number_of_rows > 0) {
  $page_count = TEXT_PAGE . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y')));
} else {
  $page_count = '';
}

$filterbox_left = '<table border="0" width="100%" cellspacing="0" cellpadding="2"><tr><td class="smallText">' . $filter . '</td></tr><tr><td class="smallText">' . TEXT_RESULTS_PAGE . tep_draw_form('maxdisplay', tep_href_link(basename($PHP_SELF), '', $request_type, false), 'get') . $get_vars . (isset($_GET['sort']) ? tep_draw_hidden_field('sort', $_GET['sort']) : '') .  tep_draw_pull_down_menu('max', $max_display, $max_results, 'onChange="this.form.submit();"') . tep_hide_session_id().'</form></td></tr></table>';

$filterbox_center = '<table border="0" width="100%" cellspacing="0" cellpadding="2"><tr><td align="center"><table><tr><td class="smallText">' . $list . '</td></tr><tr><td>' . $grid . '</td></tr></table></td></tr></table>';

$filterbox_right = '<table border="0" width="100%" cellspacing="2" cellpadding="2"><tr><td class="smallText" align="right">' . $page_count . '</td></tr><tr><td class="smallText" align="right">' . TEXT_SORT_ORDER . tep_draw_form('sorting', tep_href_link(basename($PHP_SELF), '', $request_type, false), 'get') . $get_vars . (isset($_GET['max']) ? tep_draw_hidden_field('max', $_GET['max']) : '') . tep_draw_pull_down_menu('sort', $sort_array, $_GET['sort'], 'onChange="this.form.submit();"') . tep_hide_session_id().'</form></td></tr></table>'; 

$filterbox = '<table border="0" width="100%" cellspacing="0" cellpadding="0" class="filterbox"><tr><td class="smallText" width="37%">' .  $filterbox_left . '</td><td class="smallText" width="26%" align="center">' . $filterbox_center . '</td><td class="smallText" width="37%" align="right">' . $filterbox_right . '</td></tr></table>';

echo $filterbox;
echo tep_draw_separator('pixel_trans.gif', '100%', '10');

?>
<!-- PGM SORT ORDER, NUMBER DISPLAY, GRID SWITCH -->
<!-- begin extra product fields -->
		
            <?php
            $epf_list = array();
			foreach ($epf as $e) {
              if ($e['restrict']) $epf_list[] = $e['field'];
            }
			$epf_number = count($epf_list);
			if ($epf_number > 0) { // hide epf if blank ?>
        	  <table border="0" width="100%" cellspacing="0" cellpadding="2" class="filterbox">
          		<tr>
            	  <td class="main" align="right" colspan="2">
					<?php
                      echo tep_draw_form('epf_restrict', FILENAME_DEFAULT, 'get');
                      if (is_array($_GET) && (sizeof($_GET) > 0)) {
                        reset($_GET);
                        while (list($key, $value) = each($_GET)) {
                          if ( (strlen($value) > 0) && ($key != tep_session_name()) && (!in_array($key, $epf_list)) ) {
                            echo tep_draw_hidden_field($key, $value);
                          }
                        }
                      }
                      foreach ($epf as $e) {
                        if ($e['restrict']) {
                          echo sprintf(TEXT_RESTRICT_TO, $e['label'], tep_draw_pull_down_menu($e['field'], tep_build_epf_pulldown($e['id'], $languages_id, array(array('id' => '', 'text' => TEXT_ANY_VALUE))),'', 'onchange="this.form.submit()"')) . '<br>';
                        }
                      }
                      ?>
                      </form>
            	  </td>
          		</tr>
        	  </table>
           <?php 
           echo tep_draw_separator('pixel_trans.gif', '100%', '10');
           } // end if to hide epf ?>
<!-- end extra product fields -->
<?php
  }
  
  // Display search term alternative
  echo $pw_string;

  $list_box_contents = array();

  if ($listing_split->number_of_rows > 0) {
    $row = 0;
    $rows = 0;
    $column = 0;
    $listing_query = tep_db_query($listing_split->sql_query);
// BOF: Separate Pricing per Customer
    $no_of_listings = tep_db_num_rows($listing_query);
// global variable (session) $sppc_customer_group_id -> local variable customer_group_id

  if (!tep_session_is_registered('sppc_customer_group_id')) {
    $customer_group_id = '0';
  } else {
    $customer_group_id = $sppc_customer_group_id;
  }

  while ($_listing = tep_db_fetch_array($listing_query)) {
// BOF QPBPP for SPPC
    $_listing['discount_categories_id'] = NULL;
    $listing[] = $_listing;
    $list_of_prdct_ids[] = $_listing['products_id'];
  }
  $list_of_prdct_ids = array_unique($list_of_prdct_ids);
// EOF QPBPP for SPPC
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
        
		// Load product using PriceFormatter class
		$price_breaks_from_listing = array();
        if (isset($price_breaks_array[$listing[$x]['products_id']])) {
          $price_breaks_from_listing = $price_breaks_array[$listing[$x]['products_id']];
        }
        $pf->loadProduct($listing[$x]['products_id'], $languages_id, NULL, $price_breaks_from_listing);        
		
		$lc_align = '';

        switch ($column_list[$col]) {
		  case 'PRODUCT_LIST_BESTSELLER':
		  $lc_text = '';
		  break;
		  case 'PRODUCT_CORNER_BANNER':
		  $lc_text = '&nbsp;';
		  
		  // Last Few Remaining Corner Banner
		  if (CB_LAST_FEW == 'true') { 
		    if ($listing[$x]['products_quantity'] <= CB_LAST_FEW_NO) {
	 	      $lc_text = '<img class="corner_banner" src="' . DIR_WS_IMAGES . 'corner_banners/' . $language . '/last_few.png" alt="">';
            }	
		  }
		  // Top Rated Corner Banner
		  if (CB_TOP_RATED == 'true') {
		    $reviews_query = tep_db_query("select avg(reviews_rating) as reviews_average from " . TABLE_REVIEWS . " where approved = '1' and products_id = '" . $listing[$x]['products_id'] . "' GROUP BY products_id");
              $reviews = tep_db_fetch_array($reviews_query);
                if ($reviews['reviews_average'] >= CB_TOP_RATED_NO) {
                  $lc_text = '<img class="corner_banner" src="' . DIR_WS_IMAGES . 'corner_banners/' . $language . '/top_rated.png" alt="">';
                }
		  }
		  // Featured Product Corner Banner
		  if (CB_FEATURED == 'true') {
		    if ($listing[$x]['products_featured'] == 1) {
	 	      $lc_text = '<img class="corner_banner" src="' . DIR_WS_IMAGES . 'corner_banners/' . $language . '/featured.png" alt="">';
            }	
		  }
		  
		  // Special Offer Price Corner Banner
		  if (CB_SPECIALS == 'true') {
		    if ($pf->hasSpecialPrice() == true) {			 
			  //Find out discount and round to nearest 5
			  $fullprice = $pf->getPrice();
			  $saleprice = $pf->specialPrice(); 
			  $discount = (((($fullprice * 100) - ($saleprice * 100)) / ($fullprice * 100)) * 100);
			  $rounded_discount = floor($discount / 5) * 5; 
			    if ($rounded_discount >= CB_SPECIALS_NO) { 
                  $lc_text = '<img class="corner_banner" src="' . DIR_WS_IMAGES . 'corner_banners/' . $language . '/save' . $rounded_discount . '.png" alt="">';
				}
            } 
		  }
		  // Call for Price Corner Banner
		  if (CB_CALL_FOR_PRICE == 'true') {
		    if ($pf->getPrice() == CALL_FOR_PRICE_VALUE) {
		      $lc_text = '<img class="corner_banner" src="' . DIR_WS_IMAGES . 'corner_banners/' . $language . '/callforprice.png" alt="">';
		    }
		  }
		  // Out of Stock Corner Banner
		  if (CB_OUT_OF_STOCK == 'true') {
		    if ($listing[$x]['products_quantity'] < 1) {
		      $lc_text = '<img class="corner_banner" src="' . DIR_WS_IMAGES . 'corner_banners/' . $language . '/out_of_stock.png" alt="">';
		    }
		  }	
		  
		  // Add product link to corner banner
		  if (isset($_GET['manufacturers_id'])) {
              $lc_inc_link = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $_GET['manufacturers_id'] . '&products_id=' . $listing[$x]['products_id']) . '">';
          } else {
              $lc_inc_link = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $listing[$x]['products_id']) . '">';
          }
		  // but we only want the link if there is a corner banner
		  if ($lc_text !== '&nbsp;') {
		    $lc_inc_link .= $lc_text . '</a>';
		    $lc_text = $lc_inc_link;
		  }
		  break;
          case 'PRODUCT_LIST_MODEL':
            $lc_align = '';
            $lc_text = '&nbsp;' . $listing[$x]['products_model'] . '&nbsp;';
            break;
          case 'PRODUCT_LIST_NAME':
            // begin extra product fields
            $extra = '';
            foreach ($epf as $e) {
              if ($e['listing']) {
                $mt = ($e['uses_list'] && !$e['multi_select'] ? ($listing[$e['field']] == 0) : !tep_not_null($listing[$e['field']]));
                if (!$mt) { // only list fields that aren't empty
                  $extra .= '<br><b>' . $e['label'] . ': </b>';
                  if ($e['uses_list']) {
                    if ($e['multi_select']) {
                      $epf_values = explode('|', trim($listing[$e['field']], '|'));
                      $epf_string = '';
                      foreach ($epf_values as $v) {
                        $epf_string .= tep_get_extra_field_list_value($v) . ', ';
                      }
                      $extra .= trim($epf_string, ', ');
                    } else {
                      $extra .= tep_get_extra_field_list_value($listing[$e['field']],$e['show_chain'] == 1);
                    }
                  } else {
                    $extra .= $listing[$e['field']];
                  }
                }
              }
            }
            // end extra product fields
            $lc_align = '';
            if (isset($_GET['manufacturers_id'])) {
              $lc_text = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'manufacturers_id=' . $_GET['manufacturers_id'] . '&products_id=' . $listing[$x]['products_id']) . '">' . $listing[$x]['products_name'] /*begin epf*/ . $extra /*end epf*/ . '</a>';
            } else {
              $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, ($cPath ? 'cPath=' . $cPath . '&' : '') . 'products_id=' . $listing[$x]['products_id']) . '">' . $listing[$x]['products_name'] /*begin epf*/ . $extra /*end epf*/ . '</a>&nbsp;';
            }
            break;
          case 'PRODUCT_LIST_MANUFACTURER':
            $lc_align = '';
            $lc_text = '&nbsp;<a href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $listing[$x]['manufacturers_id']) . '">' . $listing[$x]['manufacturers_name'] . '</a>&nbsp;';
            break;
          case 'PRODUCT_LIST_PRICE':
            $lc_align = 'right';
// BOF QPBPP for SPPC
            $lc_text = $pf->getPriceStringShort();
// EOF QPBPP for SPPC
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
		   if (SHOW_MORE_INFO == 'True') {
			  $more_info = '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $listing[$x]['products_id']) . '">' . tep_image_button('button_more_info.gif', IMAGE_BUTTON_MORE_INFO) . '</a>';
			} else {
			  $more_info = '';
			}
		   if ($pf->getPrice() == CALL_FOR_PRICE_VALUE){ //fix for call for price
			  $lc_text = $more_info . ' <a href="' . tep_href_link(FILENAME_CONTACT_US, 'enquiry=' . TEXT_QUESTION_PRICE_ENQUIRY . '%0D%0A%0D%0A' . TEXT_QUESTION_MODEL . '%20' . str_replace(' ', '%20', $listing[$x]['products_model']) . '%0D%0A' . TEXT_QUESTION_PRODUCT_NAME . '%20' . str_replace(' ', '%20', $listing[$x]['products_name']) . '%0D%0A' . TEXT_QUESTION_PRODUCT_ID . '%20' . $listing[$x]['products_id'] . '%0D%0A%0D%0A') . '">' . tep_image_button('button_cfp.gif', IMAGE_BUTTON_CFP) . '</a>';
			} elseif ($listing[$x]['products_quantity'] < 1 && STOCK_IMAGE_SWITCH == 'true') {
			  $lc_text = tep_image_submit('button_out_of_stock.gif', IMAGE_OUT_OF_STOCK);
			} else {
              $lc_text = $more_info . ' <a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action', 'pName')) . 'action=buy_now&products_id=' . $listing[$x]['products_id']) . '">' . tep_image_button('button_buy_now.gif', IMAGE_BUTTON_BUY_NOW) . '</a> ';
			}
           break;
        }
        $product_contents[] = $lc_text;

      }
      $lc_text = implode('<br>', $product_contents);
	  
	  // Hack to remove <br> from front of string in case it starts with a line break.
	  if (substr($lc_text, 0, 4) == '<br>') { $lc_text = substr($lc_text, 4); }
	  
	  $list_box_contents[$row][$column] = array('align' => 'center',
                                                'params' => 'class="productListing-data"',
                                                'text'  => $lc_text);
	  
	  $column ++;
	  
	  //Adds a spacer column between the product column - checks if it is the last column - if it is leave it out.
	  if ($column != PRODUCT_LIST_NUM_COLUMNS + 2) { // Adds 2 to the column count to allow for spacers
	  $list_box_contents[$row][$column] = array('align' => 'center',
                                                'params' => 'class="productListing-data-spacer"',
                                                'text'  => tep_draw_separator('pixel_trans.gif', '10', '10'));
	  $column ++;
	  }

			if ($column >= PRODUCT_LIST_NUM_COLUMNS + (PRODUCT_LIST_NUM_COLUMNS-1)) {
        	  $row ++;
			  // Add a row spacer between the product rows
			  $list_box_contents[$row][0] = array('align' => 'center',
                                                'params' => 'class="productListing-data-spacer"',
                                                'text'  => tep_draw_separator('pixel_trans.gif', '10', '10'));
			  
			  $row ++;
        	  $column = 0;
			}

    } // line 102 (N of listing per current page)
    if ($column > 0){
    	for ($x = $column; $x < PRODUCT_LIST_NUM_COLUMNS + (PRODUCT_LIST_NUM_COLUMNS-1); $x++){ // Adds 2 to the column count to allow for spacers
    		
    		$list_box_contents[$row][$column] = array('align' => 'center',
                                              'params' => 'class="productListing-data-blank" ',
                                              'text'  => "&nbsp;");
 				$column++;
    		
    	}
    }
    
    

    new productListingBox($list_box_contents);
  } else { // from line 21
    $list_box_contents = array();

    $list_box_contents[0] = array('params' => 'class="productListing-odd"');
    $list_box_contents[0][] = array('params' => 'class="productListing-data"',
                                    'text' => TEXT_NO_PRODUCTS);

    new productListingBox($list_box_contents);
  }

if ( ($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>
<table width="100%" cellspacing="0" cellpadding="0" border="0">
  <tr>
    <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
  </tr>
</table>

<table class="filterbox" width="100%" cellpadding="2" cellspacing="0" border="0">
  <tr>
    <td class="smallText"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
    <td class="smallText" align="right"><?php echo $page_count; ?></td>
  </tr>
</table>
<?php
}
?>