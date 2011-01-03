<?php
/* 
  $Id: featured_manufacturer.php,v 1.01 03/10/2004 dd/mm/yyyyy 21:00:00 surfalot.com Exp $

  Open Featured Sets manufacturer listing module

Made for:
  osCommerce, Open Source E-Commerce Solutions 
  http://www.oscommerce.com 
  Copyright (c) 2004 osCommerce 
  Released under the GNU General Public License 
  
*/

if (isset($featured_manufacturer_products_array)) {
if (sizeof($featured_manufacturer_products_array) <> '0') { 

  $num_columns = (sizeof($featured_manufacturer_products_array)>(int)FEATURED_MANUFACTURER_COLUMNS?FEATURED_MANUFACTURER_COLUMNS:sizeof($featured_manufacturer_products_array));

  //if ((FEATURED_MANUFACTURER_SET_STYLE == '5') || (FEATURED_MANUFACTURER_SET_STYLE == '6')) {
    $info_box_heading = array();
    $info_box_heading[] = array('text' => OPEN_FEATURED_BOX_MANUFACTURER_HEADING);

    new infoBoxHeading($info_box_heading,true,true);
  //}

  $info_box_contents = array();
  
  $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr>';
  $info_box_contents[0]['text'] .= '<td valign="middle" align="right" width="40%" class="main"><a href="' . tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $featured_manufacturer_products_array[0]['mid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_manufacturer_products_array[0]['mimage'], $featured_manufacturer_products_array[0]['mname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td><td valign="middle" align="left" width="60%" class="main">'.OPEN_FEATURED_BOX_MANUFACTURER_HEADING.'<br><b>'.$featured_manufacturer_products_array[0]['mname'].'</b></td>';
  $info_box_contents[0]['text'] .= '</tr></table>'; 
   
  $info_box_contents[0]['text'] .= '&nbsp;<br>';  

  $info_box_contents[0]['text'] .= '<table border="0" width="100%"'.($num_columns==1?' cellspacing="0" cellpadding="0"':' cellspacing="0" cellpadding="0"').'><tr>';
  
  for($i=0,$col=1; $i<sizeof($featured_manufacturer_products_array); $i++,$col++) {
  
  	// BOF Separate Price per Customer
    if(!tep_session_is_registered('sppc_customer_group_id')) { 
      $customer_group_id = '0';
    } else {
      $customer_group_id = $sppc_customer_group_id;
    }
    $scustomer_group_price_query = tep_db_query("select customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . (int)$featured_manufacturer_products_array[$i]['pid']. "' and customers_group_id =  '" . $customer_group_id . "'");
    if ($scustomer_group_price = tep_db_fetch_array($scustomer_group_price_query)) {
      $featured_manufacturer_products_array[$i]['pprice'] = $scustomer_group_price['customers_group_price'];
	}
    // EOF Separate Price per Customer
  
    $special_price = tep_get_products_special_price($featured_manufacturer_products_array[$i]['pid']);
    if ($special_price) {
      $products_price = '<s>' .  $currencies->display_price($featured_manufacturer_products_array[$i]['pprice'], tep_get_tax_rate($featured_manufacturer_products_array[$i]['ptax_class_id'])) . '</s>&nbsp;&nbsp;<span class="productSpecialPrice">' . $currencies->display_price($special_price, tep_get_tax_rate($featured_manufacturer_products_array[$i]['ptax_class_id'])) . '</span>'; 
    } else { 
      $products_price = $currencies->display_price($featured_manufacturer_products_array[$i]['pprice'], tep_get_tax_rate($featured_manufacturer_products_array[$i]['ptax_class_id'])); 
    } 
	
    if ($featured_manufacturer_products_array[$i]['pshortdescription'] != '') { 
      $current_description = $featured_manufacturer_products_array[$i]['pshortdescription']; 
    } else {
	  if (OPEN_FEATURED_LIMIT_DESCRIPTION_BY=='words') {
        $bah = explode(" ", $featured_manufacturer_products_array[$i]['pdescription']); 
		$word_count = count($bah);
        $current_description = '';
		for($desc=0 ; $desc<min(MAX_FEATURED_MANUFACTURER_WORD_DESCRIPTION, $word_count); $desc++) 
        { 
          $current_description .= $bah[$desc]." "; 
        }  
	  } else {
        $current_description = substr($featured_manufacturer_products_array[$i]['pdescription'],0,MAX_FEATURED_MANUFACTURER_WORD_DESCRIPTION)." "; 
	  }
    } 
	
    $info_box_contents[0]['text'] .= '<td valign="top" align="center" width="'.floor(100/$num_columns).'%">';


    if (FEATURED_SET_SHOW_BUY_NOW_BUTTONS=='true') {
      //original buy now button
      $buy_now_link = '<br><a href="' . tep_href_link(FILENAME_DEFAULT, tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . tep_image_button('button_buy_now.gif', IMAGE_BUTTON_BUY_NOW) . '</a>';
      //sid killer buy now button: http://www.oscommerce.com/community/contributions,952
      //$buy_now_link = '<br><form name="buy_now" method="post" action="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=buy_now', 'NONSSL') . '"><input type="hidden" name="products_id" value="' . $featured_manufacturer_products_array[$i]['pid'] . '">' . tep_image_submit('button_buy_now.gif', IMAGE_BUTTON_BUY_NOW) . '</form>';
    } else {
      //disabled
      $buy_now_link = '';
    }



  if ((FEATURED_MANUFACTURER_SET == '1') && (FEATURED_MANUFACTURER_SET_STYLE == '1')) { 
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.MANUFACTURER_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25) . '" align="center" valign="top" class="featuredManufacturerWP"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_manufacturer_products_array[$i]['pimage'], $featured_manufacturer_products_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td><td align="left" valign="top" class="featuredManufacturerWP"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . $featured_manufacturer_products_array[$i]['pname'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description;
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td><td align="left" valign="top" class="featuredManufacturerWP">' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . str_replace('&nbsp;&nbsp;','<br>',$products_price) . '' . $buy_now_link . '</td></tr></table>'."\n";
  }



  if ((FEATURED_MANUFACTURER_SET == '1') && ((FEATURED_MANUFACTURER_SET_STYLE == '2') || (FEATURED_MANUFACTURER_SET_STYLE == '5'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.MANUFACTURER_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25) . '" align="left" valign="top" class="featuredManufacturerWP"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_manufacturer_products_array[$i]['pimage'], $featured_manufacturer_products_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td><td align="left" valign="top" class="featuredManufacturerWP"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . $featured_manufacturer_products_array[$i]['pname'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description;
	$info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td><td align="left" valign="top" class="featuredManufacturerWP">' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . str_replace('&nbsp;&nbsp;','<br>',$products_price) . '' . $buy_now_link . '</td></tr></table>'."\n";
  }



  if ((FEATURED_MANUFACTURER_SET == '1') && (FEATURED_MANUFACTURER_SET_STYLE == '3')) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.MANUFACTURER_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25) . '" align="left" valign="top" class="featuredManufacturerWP" style="height: '.MANUFACTURER_VLINE_IMAGE_HEIGHT.'px;"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_manufacturer_products_array[$i]['pimage'], $featured_manufacturer_products_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td><td align="left" valign="top" class="featuredManufacturerWP"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . $featured_manufacturer_products_array[$i]['pname'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description;
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td>';
    $info_box_contents[0]['text'] .= '<td align="left" valign="top" class="featuredManufacturerWP">' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . str_replace('&nbsp;&nbsp;','<br>',$products_price) . '' . $buy_now_link . '</td>'.(((FEATURED_MANUFACTURER_COLUMNS>1)&&(($col/$num_columns)!=floor($col/$num_columns)))?'<td align="center" class="featuredManufacturerWP" width="'.MANUFACTURER_LINE_THICKNESS.'" style="height: '.MANUFACTURER_VLINE_IMAGE_HEIGHT.'px;"><div style="background-color: #'.MANUFACTURER_LINE_COLOR.'; height: '.MANUFACTURER_VLINE_IMAGE_HEIGHT.'px; width: '.MANUFACTURER_LINE_THICKNESS.'px;">' . tep_image(DIR_WS_IMAGES . ('pixel_trans.gif'), '', MANUFACTURER_LINE_THICKNESS, MANUFACTURER_VLINE_IMAGE_HEIGHT) . '</div></td>':'').'</tr></table>'."\n";
  }



  if ((FEATURED_MANUFACTURER_SET == '1') && ((FEATURED_MANUFACTURER_SET_STYLE == '4') || (FEATURED_MANUFACTURER_SET_STYLE == '6'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.MANUFACTURER_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25) . '" align="left" valign="top" class="featuredManufacturerWP"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_manufacturer_products_array[$i]['pimage'], $featured_manufacturer_products_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td><td align="left" valign="top" class="featuredManufacturerWP"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . $featured_manufacturer_products_array[$i]['pname'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description;
	$info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO .        '</font></a>&nbsp;</td><td align="left" valign="top" class="featuredManufacturerWP">' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . str_replace('&nbsp;&nbsp;','<br>',$products_price) . '' . $buy_now_link . '</td></tr></table>'."\n";
  }





  if ((FEATURED_MANUFACTURER_SET == '2') && (FEATURED_MANUFACTURER_SET_STYLE == '1')) { 
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.MANUFACTURER_CELLPADDING.'"><tr><td align="left" valign="top" class="featuredManufacturerWP"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_manufacturer_products_array[$i]['pimage'], $featured_manufacturer_products_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td></tr><tr><td align="center" valign="top" class="featuredManufacturerWP"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . $featured_manufacturer_products_array[$i]['pname'] . '</a></div></td></tr><tr><td valign="top" class="featuredManufacturerWP">';
    $info_box_contents[0]['text'] .= $current_description;
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td></tr><tr><td align="left" valign="top" class="featuredManufacturerWP">' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $buy_now_link . '</td></tr></table>'."\n";
  }



  if ((FEATURED_MANUFACTURER_SET == '2') && ((FEATURED_MANUFACTURER_SET_STYLE == '2') || (FEATURED_MANUFACTURER_SET_STYLE == '5'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.MANUFACTURER_CELLPADDING.'"><tr><td align="left" valign="top" class="featuredManufacturerWP"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_manufacturer_products_array[$i]['pimage'], $featured_manufacturer_products_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td></tr><tr><td align="center" valign="top" class="featuredManufacturerWP"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . $featured_manufacturer_products_array[$i]['pname'] . '</a></div></td></tr><tr><td valign="top" class="featuredManufacturerWP">';
    $info_box_contents[0]['text'] .= $current_description;
	$info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td></tr><tr><td align="left" valign="top" class="featuredManufacturerWP">' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $buy_now_link . '</td></tr></table>'."\n";
  }



  if ((FEATURED_MANUFACTURER_SET == '2') && (FEATURED_MANUFACTURER_SET_STYLE == '3')) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.MANUFACTURER_CELLPADDING.'"><tr><td align="left" valign="top" class="featuredManufacturerWP" style="height: '.MANUFACTURER_VLINE_IMAGE_HEIGHT.'px;"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_manufacturer_products_array[$i]['pimage'], $featured_manufacturer_products_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . $featured_manufacturer_products_array[$i]['pname'] . '</a></div><br>';
    $info_box_contents[0]['text'] .= $current_description;
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;<br>' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $buy_now_link . '</td>'.(((FEATURED_MANUFACTURER_COLUMNS>1)&&(($col/$num_columns)!=floor($col/$num_columns)))?'<td align="center" class="featuredManufacturerWP" width="'.MANUFACTURER_LINE_THICKNESS.'" style="height: '.MANUFACTURER_VLINE_IMAGE_HEIGHT.'px;"><div style="background-color: #'.MANUFACTURER_LINE_COLOR.'; height: '.MANUFACTURER_VLINE_IMAGE_HEIGHT.'px; width: '.MANUFACTURER_LINE_THICKNESS.'px;">' . tep_image(DIR_WS_IMAGES . ('pixel_trans.gif'), '', MANUFACTURER_LINE_THICKNESS, MANUFACTURER_VLINE_IMAGE_HEIGHT) . '</div></td>':'').'</tr></table>'."\n";
  }



  if ((FEATURED_MANUFACTURER_SET == '2') && ((FEATURED_MANUFACTURER_SET_STYLE == '4') || (FEATURED_MANUFACTURER_SET_STYLE == '6'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.MANUFACTURER_CELLPADDING.'"><tr><td align="left" valign="top" class="featuredManufacturerWP"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_manufacturer_products_array[$i]['pimage'], $featured_manufacturer_products_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td></tr><tr><td align="center" valign="top" class="featuredManufacturerWP"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . $featured_manufacturer_products_array[$i]['pname'] . '</a></div></td></tr><tr><td valign="top" class="featuredManufacturerWP">';
    $info_box_contents[0]['text'] .= $current_description;
	$info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO .       '</font></a>&nbsp;</td></tr><tr><td align="left" valign="top" class="featuredManufacturerWP">' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . $products_price . '' . $buy_now_link . '</td></tr></table>'."\n";
  }




  if ((FEATURED_MANUFACTURER_SET == '3') && (FEATURED_MANUFACTURER_SET_STYLE == '1')) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.MANUFACTURER_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25) . '" align="center" valign="top" class="featuredManufacturerWP"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_manufacturer_products_array[$i]['pimage'], $featured_manufacturer_products_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . str_replace('&nbsp;&nbsp;','<br>',$products_price) . '' . $buy_now_link . '</td><td align="left" valign="top" class="featuredManufacturerWP"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . $featured_manufacturer_products_array[$i]['pname'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description;
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td></tr></table>'."\n";
  }



  if ((FEATURED_MANUFACTURER_SET == '3') && ((FEATURED_MANUFACTURER_SET_STYLE == '2') || (FEATURED_MANUFACTURER_SET_STYLE == '5'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.MANUFACTURER_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25) . '" align="center" valign="top" class="featuredManufacturerWP"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_manufacturer_products_array[$i]['pimage'], $featured_manufacturer_products_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . str_replace('&nbsp;&nbsp;','<br>',$products_price) . '' . $buy_now_link . '</td><td align="left" valign="top" class="featuredManufacturerWP"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . $featured_manufacturer_products_array[$i]['pname'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description;
	$info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td></tr></table>'."\n";
  }



  if ((FEATURED_MANUFACTURER_SET == '3') && (FEATURED_MANUFACTURER_SET_STYLE == '3')) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.MANUFACTURER_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25) . '" align="center" valign="top" class="featuredManufacturerWP" style="height: '.MANUFACTURER_VLINE_IMAGE_HEIGHT.'px;"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_manufacturer_products_array[$i]['pimage'], $featured_manufacturer_products_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . 
	  '</a><br>' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . str_replace('&nbsp;&nbsp;','<br>',$products_price) . '' . $buy_now_link . '</td><td align="left" valign="top" class="featuredManufacturerWP"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . $featured_manufacturer_products_array[$i]['pname'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description;
    $info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td>'.(((FEATURED_MANUFACTURER_COLUMNS>1)&&(($col/$num_columns)!=floor($col/$num_columns)))?'<td align="center" class="featuredManufacturerWP" width="'.MANUFACTURER_LINE_THICKNESS.'" style="height: '.MANUFACTURER_VLINE_IMAGE_HEIGHT.'px;"><div style="background-color: #'.MANUFACTURER_LINE_COLOR.'; height: '.MANUFACTURER_VLINE_IMAGE_HEIGHT.'px; width: '.MANUFACTURER_LINE_THICKNESS.'px;">' . tep_image(DIR_WS_IMAGES . ('pixel_trans.gif'), '', MANUFACTURER_LINE_THICKNESS, MANUFACTURER_VLINE_IMAGE_HEIGHT) . '</div></td>':'').'</tr></table>'."\n";
  }



  if ((FEATURED_MANUFACTURER_SET == '3') && ((FEATURED_MANUFACTURER_SET_STYLE == '4') || (FEATURED_MANUFACTURER_SET_STYLE == '6'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.MANUFACTURER_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25) . '" align="center" valign="top" class="featuredManufacturerWP"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_manufacturer_products_array[$i]['pimage'], $featured_manufacturer_products_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . str_replace('&nbsp;&nbsp;','<br>',$products_price) . '' . $buy_now_link . '</td><td align="left" valign="top" class="featuredManufacturerWP"><div align="left"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . $featured_manufacturer_products_array[$i]['pname'] . '</a></div>';
    $info_box_contents[0]['text'] .= $current_description;
	$info_box_contents[0]['text'] .= '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '"><font color="#FF0000">' . TEXT_MORE_INFO . '</font></a>&nbsp;</td></tr></table>'."\n";
  }




  if ((FEATURED_MANUFACTURER_SET == '4') && (FEATURED_MANUFACTURER_SET_STYLE == '1')) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.MANUFACTURER_CELLPADDING.'"><tr><td width="' . (SMALL_IMAGE_WIDTH + 25) . '" align="center" valign="top" class="featuredManufacturerWP"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_manufacturer_products_array[$i]['pimage'], $featured_manufacturer_products_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">';
	$info_box_contents[0]['text'] .= $featured_manufacturer_products_array[$i]['pname'] . '</a><br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . str_replace('&nbsp;&nbsp;','<br>',$products_price) . '' . $buy_now_link . '</td></tr></table>'."\n";
  }



  if ((FEATURED_MANUFACTURER_SET == '4') && ((FEATURED_MANUFACTURER_SET_STYLE == '2') || (FEATURED_MANUFACTURER_SET_STYLE == '5'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.MANUFACTURER_CELLPADDING.'"><tr><td align="center" valign="top" class="featuredManufacturerWP"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_manufacturer_products_array[$i]['pimage'], $featured_manufacturer_products_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . 
       '<br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . $featured_manufacturer_products_array[$i]['pname'] . '</a><br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . str_replace('&nbsp;&nbsp;','<br>',$products_price) . '' . $buy_now_link . '</td></tr></table>'."\n";
  }



  if ((FEATURED_MANUFACTURER_SET == '4') && (FEATURED_MANUFACTURER_SET_STYLE == '3')) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="0"><tr><td style="height: '.MANUFACTURER_VLINE_IMAGE_HEIGHT.'px;"><table border="0" width="100%" cellspacing="0" cellpadding="'.MANUFACTURER_CELLPADDING.'"><tr><td align="center" valign="top" class="featuredManufacturerWP"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_manufacturer_products_array[$i]['pimage'], $featured_manufacturer_products_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5');
	$info_box_contents[0]['text'] .= '<br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . $featured_manufacturer_products_array[$i]['pname'] . '</a><br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . str_replace('&nbsp;&nbsp;','<br>',$products_price) . '' . $buy_now_link . '</td></tr></table></td>'.(((FEATURED_MANUFACTURER_COLUMNS>1)&&(($col/$num_columns)!=floor($col/$num_columns)))?'<td align="center" class="featuredManufacturerWP" width="'.MANUFACTURER_LINE_THICKNESS.'" style="height: '.MANUFACTURER_VLINE_IMAGE_HEIGHT.'px;"><div style="background-color: #'.MANUFACTURER_LINE_COLOR.'; height: '.MANUFACTURER_VLINE_IMAGE_HEIGHT.'px; width: '.MANUFACTURER_LINE_THICKNESS.'px;">' . tep_image(DIR_WS_IMAGES . ('pixel_trans.gif'), '', MANUFACTURER_LINE_THICKNESS, MANUFACTURER_VLINE_IMAGE_HEIGHT) . '</div></td>':'').'</tr></table>'."\n";
  }



  if ((FEATURED_MANUFACTURER_SET == '4') && ((FEATURED_MANUFACTURER_SET_STYLE == '4') || (FEATURED_MANUFACTURER_SET_STYLE == '6'))) {
    $info_box_contents[0]['text'] .= '<table border="0" width="100%" cellspacing="0" cellpadding="'.MANUFACTURER_CELLPADDING.'"><tr><td align="center" valign="top" class="featuredManufacturerWP"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $featured_manufacturer_products_array[$i]['pimage'], $featured_manufacturer_products_array[$i]['pname'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br>' . tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . 
      '<br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $featured_manufacturer_products_array[$i]['pid'], 'NONSSL') . '">' . $featured_manufacturer_products_array[$i]['pname'] . '</a><br>' . OPEN_FEATURED_TABLE_HEADING_PRICE . str_replace('&nbsp;&nbsp;','<br>',$products_price) . '' . $buy_now_link . '</td></tr></table>'."\n";
  }


    $info_box_contents[0]['text'] .= '</td>'."\n";

    if (($col/$num_columns) == floor($col/$num_columns)) { 
      if ((((FEATURED_MANUFACTURER_SET == '1') && (FEATURED_MANUFACTURER_SET_STYLE == '3')) or ((FEATURED_MANUFACTURER_SET == '2') && (FEATURED_MANUFACTURER_SET_STYLE == '3')) or ((FEATURED_MANUFACTURER_SET == '3') && (FEATURED_MANUFACTURER_SET_STYLE == '3')) or ((FEATURED_MANUFACTURER_SET == '4') && (FEATURED_MANUFACTURER_SET_STYLE == '3'))) && (($i+1) != sizeof($featured_manufacturer_products_array))){
        $info_box_contents[0]['text'] .= '</tr><tr><td colspan="' . $num_columns . '" align="center" valign="top" class="featuredManufacturerWP"><div style="background-color: #'.MANUFACTURER_LINE_COLOR.'; height: '.MANUFACTURER_LINE_THICKNESS.'px; width: 100%;">' . tep_image(DIR_WS_IMAGES . ('pixel_trans.gif'), '', '1', MANUFACTURER_LINE_THICKNESS) . '</div></td>'."\n"; 
      }else{
        $info_box_contents[0]['text'] .= '</tr><tr><td colspan="' . $num_columns . '" class="featuredManufacturerWP">&nbsp;</td>'."\n"; 
      }
      if (($i+1) != sizeof($featured_manufacturer_products_array)) { 
	    $info_box_contents[0]['text'] .= '</tr><tr>'."\n";
      } 
    }
	
  } // end: for()
  while (($i/$num_columns) != floor($i/$num_columns)) {
    $info_box_contents[0]['text'] .= '<td>&nbsp;</td>'."\n";
	$i++;
  }
  $info_box_contents[0]['text'] .= '</tr></table>'."\n";
  
  
  if ((FEATURED_MANUFACTURER_SET_STYLE == '2') || (FEATURED_MANUFACTURER_SET_STYLE == '4') || (FEATURED_MANUFACTURER_SET_STYLE == '5') || (FEATURED_MANUFACTURER_SET_STYLE == '6')) {
    new contentBox($info_box_contents);
  } else {
    echo $info_box_contents[0]['text'];
  }
  
  if ((FEATURED_MANUFACTURER_SET_STYLE == '4') || (FEATURED_MANUFACTURER_SET_STYLE == '6')) {
    //echo '<img src="images/info_box_' . FEATURED_SET_STYLE_SHADOW . '_shadow.gif" width="100%" height="13" alt="">';
  }
  
  echo tep_draw_separator('pixel_trans.gif', '100%', '10');
  
} // end: if()
}
?>