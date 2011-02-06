<?php
/* 
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

/*
  Open Featured Sets products listing module
*/

if (isset($featured_products_array)) {
if (sizeof($featured_products_array) <> '0') { 
  
  $num_columns = (sizeof($featured_products_array)>(int)FEATURED_PRODUCTS_COLUMNS?FEATURED_PRODUCTS_COLUMNS:sizeof($featured_products_array));
  
  if (isset($featured_product_category_id) && tep_not_null($featured_product_category_id)) {
    $the_categories_name_query= tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id= '" . $featured_product_category_id . "' and language_id= '" . $languages_id . "'");

    $the_categories_name = tep_db_fetch_array($the_categories_name_query);
    $featured_product_category_name = $the_categories_name['categories_name'];
  }
  if ((FEATURED_SET_STYLE == '5') || (FEATURED_SET_STYLE == '6')) {
    $info_box_heading = array();
    $info_box_heading[] = array('text' => (!empty($featured_product_category_name)?$featured_product_category_name.' ':'') . OPEN_FEATURED_BOX_HEADING );

    new infoBoxHeading($info_box_heading,true,true);
  }
  
  if ((FEATURED_SET_STYLE == '1') || (FEATURED_SET_STYLE == '3')) { 
    echo '&nbsp;<br /><div align="left" class="pageHeading">'.(!empty($featured_product_category_name)?$featured_product_category_name.' ':'').OPEN_FEATURED_BOX_HEADING.'</div>&nbsp;<br />'."\n";
  }	
  
  $info_box_contents = array();
  $info_box_contents[] = array('text' => '<table border="0" width="100%"'.($num_columns==1?' cellspacing="0" cellpadding="0"':' cellspacing="0" cellpadding="0"').'><tr>' );
  
  for($i=0,$col=1; $i<sizeof($featured_products_array); $i++,$col++) { 
  
  	// BOF Separate Price per Customer
    if(!tep_session_is_registered('sppc_customer_group_id')) { 
      $customer_group_id = '0';
    } else {
      $customer_group_id = $sppc_customer_group_id;
    }
    $scustomer_group_price_query = tep_db_query("select customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . (int)$featured_products_array[$i]['id']. "' and customers_group_id =  '" . $customer_group_id . "'");
    if ($scustomer_group_price = tep_db_fetch_array($scustomer_group_price_query)) {
      $featured_products_array[$i]['price'] = $scustomer_group_price['customers_group_price'];
	}
    // EOF Separate Price per Customer
  
    if (($featured_products_array[$i]['specials_price']) && ($featured_products_array[$i]['specials_status'] == '1')) { 
      $products_price = '<s>' .  $currencies->display_price($featured_products_array[$i]['price'], tep_get_tax_rate($featured_products_array[$i]['tax_class_id'])) . '</s>&nbsp;&nbsp;<span class="productSpecialPrice">' . $currencies->display_price($featured_products_array[$i]['specials_price'], tep_get_tax_rate($featured_products_array[$i]['tax_class_id'])) . '</span>'; 
    } else { 
      $products_price = $currencies->display_price($featured_products_array[$i]['price'], tep_get_tax_rate($featured_products_array[$i]['tax_class_id'])); 
    } 

    if ($featured_products_array[$i]['shortdescription'] != '') { 
      $current_description = $featured_products_array[$i]['shortdescription']; 
    } else { 
	  if (OPEN_FEATURED_LIMIT_DESCRIPTION_BY=='words') {
        $bah = explode(" ", $featured_products_array[$i]['description']); 
		$word_count = count($bah);
		$current_description = '';
        for($desc=0 ; $desc<min(MAX_FEATURED_WORD_DESCRIPTION, $word_count); $desc++) 
        { 
          $current_description .= $bah[$desc]." "; 
        }  
	  } else {
        $current_description = substr($featured_products_array[$i]['description'],0,MAX_FEATURED_WORD_DESCRIPTION)." "; 
	  }
    } 
	
    $info_box_contents[0]['text'] .= '<td valign="top" align="center" width="'.floor(100/$num_columns).'%">';

    if (SHOW_MORE_INFO == 'True') {
      $more_info = '<br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id']) . '">' . tep_image_button('button_more_info.gif', IMAGE_BUTTON_MORE_INFO) . '</a> ';
	} else {
      $more_info = '<br>';
	}

if (FEATURED_SET_SHOW_BUY_NOW_BUTTONS=='true') {
  //original buy now link
  $buy_now_link = '<a href="' . tep_href_link(FILENAME_DEFAULT, tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . tep_image_button('button_buy_now.gif', IMAGE_BUTTON_BUY_NOW) . '</a>';
  //sid killer buy now link
  //$buy_now_link = '<br><form name="buy_now" method="post" action="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now', 'NONSSL') . '"><input type="hidden" name="products_id" value="' . $featured_products_array[$i]['id'] . '">' . tep_image_submit('button_buy_now.gif', IMAGE_BUTTON_BUY_NOW) . '</form>';
} else {
  //disabled
  $buy_now_link = '';
}



  if ((FEATURED_SET == '1') && (FEATURED_SET_STYLE == '1')) { 
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.FEATURED_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25);
    $info_box_contents[0]['text'] .= '" align="left" valign="top" class="featuredProducts"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_products_array[$i]['image'], $featured_products_array[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td><td align="left" valign="top" class="featuredProducts"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . $featured_products_array[$i]['name'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description; 
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td><td align="left" valign="top" class="featuredProducts">' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $more_info . $buy_now_link . '</td></tr></table>';
  }



  if ((FEATURED_SET == '1') && ((FEATURED_SET_STYLE == '2') || (FEATURED_SET_STYLE == '5'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.FEATURED_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25) . '" align="left" valign="top" class="featuredProducts"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_products_array[$i]['image'], $featured_products_array[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td><td align="left" valign="top" class="featuredProducts"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . $featured_products_array[$i]['name'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description; 
	$info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td><td align="left" valign="top" class="featuredProducts">' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $more_info . $buy_now_link . '</td></tr></table>';
  }



  if ((FEATURED_SET == '1') && (FEATURED_SET_STYLE == '3')) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.FEATURED_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25);
    $info_box_contents[0]['text'] .= '" align="left" valign="top" class="featuredProducts" style="height: '.FEATURED_VLINE_IMAGE_HEIGHT.'px;"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES .  DYNAMIC_MOPICS_THUMBS_DIR . $featured_products_array[$i]['image'], $featured_products_array[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td><td align="left" valign="top" class="featuredProducts"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . $featured_products_array[$i]['name'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description; 
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td><td align="left" valign="top" class="featuredProducts">' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $more_info . $buy_now_link . '</td>'.(((FEATURED_PRODUCTS_COLUMNS>1)&&(($col/$num_columns)!=floor($col/$num_columns)) && (($i+1) != sizeof($featured_products_array)))?'<td align="center" width="'.FEATURED_LINE_THICKNESS.'" style="height: '.FEATURED_VLINE_IMAGE_HEIGHT.'px;"><div style="background-color: #'.FEATURED_LINE_COLOR.'; height: '.FEATURED_VLINE_IMAGE_HEIGHT.'px; width: '.FEATURED_LINE_THICKNESS.'px;">' . tep_image(DIR_WS_IMAGES . ('pixel_trans.gif'), '', FEATURED_LINE_THICKNESS, FEATURED_VLINE_IMAGE_HEIGHT) . '</div></td>':'').'</tr></table>';
  }



  if ((FEATURED_SET == '1') && ((FEATURED_SET_STYLE == '4') || (FEATURED_SET_STYLE == '6'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.FEATURED_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25) . '" align="left" valign="top" class="featuredProducts"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_products_array[$i]['image'], $featured_products_array[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td><td align="left" valign="top" class="featuredProducts"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . $featured_products_array[$i]['name'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description; 
	$info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td><td align="left" valign="top" class="featuredProducts">' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $more_info . $buy_now_link . '</td></tr></table>';
  }







  if ((FEATURED_SET == '2') && (FEATURED_SET_STYLE == '1')) { 
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.FEATURED_CELLPADDING.'"><tr><td align="left" valign="top" class="featuredProducts"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_products_array[$i]['image'], $featured_products_array[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td></tr><tr><td width="25%" align="center" valign="top" class="featuredProducts"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . $featured_products_array[$i]['name'] . '</a></div></td></tr><tr><td valign="top" class="featuredProducts" width="25%">';
    $info_box_contents[0]['text'] .= $current_description; 
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td></tr><tr><td align="left" valign="top" class="featuredProducts">' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $more_info . $buy_now_link . '</td></tr></table>';
  }



  if ((FEATURED_SET == '2') && ((FEATURED_SET_STYLE == '2') || (FEATURED_SET_STYLE == '5'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.FEATURED_CELLPADDING.'"><tr><td align="left" valign="top" class="featuredProducts"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_products_array[$i]['image'], $featured_products_array[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td></tr><tr><td width="25%" align="center" valign="top" class="featuredProducts"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . $featured_products_array[$i]['name'] . '</a></div></td></tr><tr><td valign="top" class="featuredProducts" width="25%">';
    $info_box_contents[0]['text'] .= $current_description; 
	$info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td></tr><tr><td align="left" valign="top" class="featuredProducts">' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $more_info . $buy_now_link . '</td></tr></table>';
  }



  if ((FEATURED_SET == '2') && (FEATURED_SET_STYLE == '3')) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.FEATURED_CELLPADDING.'"><tr><td align="left" valign="top" class="featuredProducts" style="height: '.FEATURED_VLINE_IMAGE_HEIGHT.'px;"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_products_array[$i]['image'], $featured_products_array[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . $featured_products_array[$i]['name'] . '</a></div><br>';
    $info_box_contents[0]['text'] .= $current_description; 
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $more_info . $buy_now_link . '</td>'.(((FEATURED_PRODUCTS_COLUMNS>1)&&(($col/$num_columns)!=floor($col/$num_columns)) && (($i+1) != sizeof($featured_products_array)))?'<td align="center" width="'.FEATURED_LINE_THICKNESS.'" style="height: '.FEATURED_VLINE_IMAGE_HEIGHT.'px;"><div style="background-color: #'.FEATURED_LINE_COLOR.'; height: '.FEATURED_VLINE_IMAGE_HEIGHT.'px; width: '.FEATURED_LINE_THICKNESS.'px;">' . tep_image(DIR_WS_IMAGES . ('pixel_trans.gif'), '', FEATURED_LINE_THICKNESS, FEATURED_VLINE_IMAGE_HEIGHT) . '</div></td>':'').'</tr></table>';
  }



  if ((FEATURED_SET == '2') && ((FEATURED_SET_STYLE == '4') || (FEATURED_SET_STYLE == '6'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.FEATURED_CELLPADDING.'"><tr><td align="left" valign="top" class="featuredProducts"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_products_array[$i]['image'], $featured_products_array[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td></tr><tr><td width="25%" align="center" valign="top" class="featuredProducts"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . $featured_products_array[$i]['name'] . '</a></div></td></tr><tr><td valign="top" class="featuredProducts" width="25%">';
    $info_box_contents[0]['text'] .= $current_description; 
	$info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td></tr><tr><td align="left" valign="top" class="featuredProducts">' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $more_info . $buy_now_link . '</td></tr></table>';
  }



  if ((FEATURED_SET == '3') && (FEATURED_SET_STYLE == '1')) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.FEATURED_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25);
    $info_box_contents[0]['text'] .= '" align="center" valign="top" class="featuredProducts"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_products_array[$i]['image'], $featured_products_array[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $more_info . $buy_now_link . '</td><td align="left" valign="top" class="featuredProducts"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . $featured_products_array[$i]['name'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description; 
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td></tr></table>';
  }



  if ((FEATURED_SET == '3') && ((FEATURED_SET_STYLE == '2') || (FEATURED_SET_STYLE == '5'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.FEATURED_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25) . '" align="center" valign="top" class="featuredProducts"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_products_array[$i]['image'], $featured_products_array[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $more_info . $buy_now_link . '</td><td align="left" valign="top" class="featuredProducts"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . $featured_products_array[$i]['name'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description; 
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td></tr></table>';
  }



  if ((FEATURED_SET == '3') && (FEATURED_SET_STYLE == '3')) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.FEATURED_CELLPADDING.'"><tr>';
    $info_box_contents[0]['text'] .= '<td width="' . (SMALL_IMAGE_WIDTH + 25) . '" align="center" valign="top" class="featuredProducts" style="height: '.FEATURED_VLINE_IMAGE_HEIGHT.'px;"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_products_array[$i]['image'], $featured_products_array[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $more_info . $buy_now_link . '</td><td align="left" valign="top" class="featuredProducts"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . $featured_products_array[$i]['name'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description; 
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td>'.(((FEATURED_PRODUCTS_COLUMNS>1)&&(($col/$num_columns)!=floor($col/$num_columns)) && (($i+1) != sizeof($featured_products_array)))?'<td align="center" width="'.FEATURED_LINE_THICKNESS.'" style="height: '.FEATURED_VLINE_IMAGE_HEIGHT.'px;"><div style="background-color: #'.FEATURED_LINE_COLOR.'; height: '.FEATURED_VLINE_IMAGE_HEIGHT.'px; width: '.FEATURED_LINE_THICKNESS.'px;">' . tep_image(DIR_WS_IMAGES . ('pixel_trans.gif'), '', FEATURED_LINE_THICKNESS, FEATURED_VLINE_IMAGE_HEIGHT) . '</div></td>':'').'</tr></table>';
  }



  if ((FEATURED_SET == '3') && ((FEATURED_SET_STYLE == '4') || (FEATURED_SET_STYLE == '6'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.FEATURED_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25) . '" align="center" valign="top" class="featuredProducts"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_products_array[$i]['image'], $featured_products_array[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $more_info . $buy_now_link . '</td><td align="left" valign="top" class="featuredProducts"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . $featured_products_array[$i]['name'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description; 
    $info_box_contents[0]['text'] .= $featured_products_array[$i]['shortdescription'] . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td></tr></table>';
  }







    if ((FEATURED_SET == '4') && (FEATURED_SET_STYLE == '1')) {
      $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.FEATURED_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25);
      $info_box_contents[0]['text'] .= '" align="center" valign="top" class="featuredProducts"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_products_array[$i]['image'], $featured_products_array[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><div align="center"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . $featured_products_array[$i]['name'] . '</a></div>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $more_info . $buy_now_link . '</td></tr></table>';
    }



    if ((FEATURED_SET == '4') && ((FEATURED_SET_STYLE == '2') || (FEATURED_SET_STYLE == '5'))) {
      $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.FEATURED_CELLPADDING.'"><tr><td align="center" valign="top" class="featuredProducts"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_products_array[$i]['image'], $featured_products_array[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><div align="center"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . $featured_products_array[$i]['name'] . '</a></div>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $more_info . $buy_now_link . '</td></tr></table>';
    }



    if ((FEATURED_SET == '4') && (FEATURED_SET_STYLE == '3')) {
      $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr>';
      $info_box_contents[0]['text'] .= '<td style="height: '.FEATURED_VLINE_IMAGE_HEIGHT.'px;"><table border="0" cellspacing="0" cellpadding="'.FEATURED_CELLPADDING.'" width="100%"><tr><td align="center" valign="top" class="featuredProducts"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_products_array[$i]['image'], $featured_products_array[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';
	  $info_box_contents[0]['text'] .= '<br><div align="center"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . $featured_products_array[$i]['name'] . '</a></div>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $more_info . $buy_now_link . '</td></tr></table></td>';
	  $info_box_contents[0]['text'] .= (((FEATURED_PRODUCTS_COLUMNS>1)&&(($col/$num_columns)!=floor($col/$num_columns)) && (($i+1) != sizeof($featured_products_array)))?'<td align="center" width="'.FEATURED_LINE_THICKNESS.'" style="height: '.FEATURED_VLINE_IMAGE_HEIGHT.'px;"><div style="background-color: #'.FEATURED_LINE_COLOR.'; height: '.FEATURED_VLINE_IMAGE_HEIGHT.'px; width: '.FEATURED_LINE_THICKNESS.'px;">' . tep_image(DIR_WS_IMAGES . ('pixel_trans.gif'), '', FEATURED_LINE_THICKNESS, FEATURED_VLINE_IMAGE_HEIGHT) . '</div></td>':'');
	  $info_box_contents[0]['text'] .= '</tr></table>';
    }



    if ((FEATURED_SET == '4') && ((FEATURED_SET_STYLE == '4') || (FEATURED_SET_STYLE == '6'))) {
      $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.FEATURED_CELLPADDING.'"><tr><td align="center" valign="top" class="featuredProducts"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_products_array[$i]['image'], $featured_products_array[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><div align="center"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_products_array[$i]['id'], 'NONSSL') . '">' . $featured_products_array[$i]['name'] . '</a></div>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $more_info . $buy_now_link . '</td></tr></table>';
    }



    $info_box_contents[0]['text'] .= '</td>'."\n";

    if (($col/$num_columns) == floor($col/$num_columns)) { 
      if ((((FEATURED_SET == '1') && (FEATURED_SET_STYLE == '3')) or ((FEATURED_SET == '2') && (FEATURED_SET_STYLE == '3')) or ((FEATURED_SET == '3') && (FEATURED_SET_STYLE == '3')) or ((FEATURED_SET == '4') && (FEATURED_SET_STYLE == '3'))) && ((($col / $num_columns) == floor($col / $num_columns)) && (($i+1) != sizeof($featured_products_array)))){
        $info_box_contents[0]['text'] .= '</tr><tr><td colspan="' . $num_columns . '" align="center"><div style="background-color: #'.FEATURED_LINE_COLOR.'; height: '.FEATURED_LINE_THICKNESS.'px; width: 100%;">' . tep_image(DIR_WS_IMAGES . ('pixel_trans.gif'), '', '1', FEATURED_LINE_THICKNESS) . '</div></td>'."\n"; 
      }elseif (FEATURED_SET_STYLE == '1'){
        $info_box_contents[0]['text'] .= '</tr><tr><td colspan="' . $num_columns . '" class="featuredProducts">'. tep_draw_separator('pixel_trans.gif', '10', '10') .'</td>'."\n"; 
      }else{
        $info_box_contents[0]['text'] .= '</tr><tr><td colspan="' . $num_columns . '" class="featuredProducts">'. tep_draw_separator('pixel_trans.gif', '6', '6') .'</td>'."\n"; 
      }
	  if (($i+1) != sizeof($featured_products_array)) {
	    $info_box_contents[0]['text'] .= '</tr><tr>'."\n";
	  }
    }
	
  } // end: for()
  while (($i/$num_columns) != floor($i/$num_columns)) {
    $info_box_contents[0]['text'] .= '<td>&nbsp;</td>'."\n";
	$i++;
  }
  $info_box_contents[0]['text'] .= '</tr></table>'."\n";
  
  
  if ((FEATURED_SET_STYLE == '2') || (FEATURED_SET_STYLE == '4') || (FEATURED_SET_STYLE == '5') || (FEATURED_SET_STYLE == '6')) {
    new contentBox($info_box_contents);
  } else {
    echo $info_box_contents[0]['text'];
  }
  
  if ((FEATURED_SET_STYLE == '4') || (FEATURED_SET_STYLE == '6')) {
    //echo '<img src="images/info_box_' . FEATURED_SET_STYLE_SHADOW . '_shadow.gif" width="100%" height="13" alt="">';
  }
  
  echo tep_draw_separator('pixel_trans.gif', '100%', '10');
  
} // end: if()
}
?>