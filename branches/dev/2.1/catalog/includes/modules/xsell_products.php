<?php
/* 
$Id: xsell_products.php 12 2006-06-22 04:10:28Z user $

osCMax Power E-Commerce 
<http://oscdox.com> 

Copyright 2006 osCMax2005 osCMax, 2002 osCommerce 

Released under the GNU General Public License 
*/ 

if ($_GET['products_id']) { 
  $xsell_query = tep_db_query("select distinct p.products_id, p.products_image, pd.products_name, p.products_tax_class_id, products_price from " . TABLE_PRODUCTS_XSELL . " xp, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where xp.products_id = '" . $HTTP_GET_VARS['products_id'] . "' and xp.xsell_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' and p.products_status = '1' order by xp.sort_order asc limit " . MAX_DISPLAY_ALSO_PURCHASED);
$num_products_xsell = tep_db_num_rows($xsell_query); 

  // PGM WORKS OUT NUMBER OF ROWS AND SPACES NEEDED
	  $total_products_xs = tep_db_num_rows($xsell_query);
	  $div3_xs = round($total_products_xs / 3 , 2);
	  $div3main_xs = floor($div3_xs);
	  $div3check_xs = $div3_xs - $div3main_xs;
	  $div3rows_xs = $div3_xs - $div3check_xs;
  // PGM END	

      if ($total_products_xs <= 3) { ?>
	    <style>
	      a.left, a.right { visibility:hidden !important; }
	    </style>  
<?php }

    if ($num_products_xsell >= MIN_DISPLAY_ALSO_PURCHASED) { 

      if (USE_XSELL_HORIZ_SCROLLER == 'true') {
	?>
    <!-- xsell_products //-->
    
    <?php
      $info_box_contents = array();
      $info_box_contents[] = array('align' => 'left', 'text' => '&nbsp;' . TEXT_XSELL_PRODUCTS);
      new contentBoxHeading($info_box_contents);
	?>

	<table class="infoBoxScrolling" width="100%" cellspacing="0" cellpadding="0" border="0">
      <tr valign="middle">
        <td>

    <!-- "previous page" action -->
    <a class="prev browse left"></a>

      <!-- root element for scrollable -->
      <div class="scrollable">   
   
        <!-- root element for the items -->
        <div class="items">

      <?php
      $row = 0;
      $col = 0;

      while ($xsell = tep_db_fetch_array($xsell_query)) {
 
        $xsell['specials_new_products_price'] = tep_get_products_special_price($xsell['products_id']); 
		  if ($xsell['specials_new_products_price']) { 
            $xsell_price =  '<span style="text-decoration:line-through">' . $currencies->display_price($xsell['products_price'], tep_get_tax_rate($xsell['products_tax_class_id'])) . '</span>&nbsp;&nbsp;'; 
            $xsell_price .= '<span class="productSpecialPrice">' . $currencies->display_price($xsell['specials_new_products_price'], tep_get_tax_rate($xsell['products_tax_class_id'])) . '</span>'; 
          } else { 
            $xsell_price =  $currencies->display_price($xsell['products_price'], tep_get_tax_rate($xsell['products_tax_class_id'])); 
	      } 

		  $display_code = '<td width="33%" class="smallText"><br><center><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $xsell['products_id']) . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $xsell['products_image'], $xsell['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $xsell['products_id']) . '">' . $xsell['products_name'] .'</a><br>' . $xsell_price . '<br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $xsell['products_id']) . '">' . tep_image_button('button_more_info.gif', IMAGE_BUTTON_MORE_INFO) . '</a><a href="' . tep_href_link( FILENAME_PRODUCT_INFO, 'products_id=' . $product_info['products_id'] .  '&amp;action=buy_now&product_to_buy_id=' . $xsell['products_id'], 'NONSSL') . '">' . tep_image_button('button_buy_now.gif', '' . $xsell['products_name'] . '') .'</a></center></td>';
 
	  if  (($div3rows_xs <> $row) && ($col == 0)) {
		$output .= '<div><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr valign="middle">' . $display_code;
      } // end if
		
	  if (($div3rows_xs <> $row) && ($col == 1)) {
        $output .= $display_code;
	  } // end if 
		
	  if (($div3rows_xs <> $row) && ($col == 2)) {
        $output .= $display_code . '</tr></table></div>';
   	  } // end if
	
	// Check to seee if this is the final row
		  if (($row == $div3rows_xs) && ($div3check_xs <> 0)) { 
			if ($div3check_xs < 0.5) {
			  //This is the last row and needs two spaces
			  $output .= '<div><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr valign="middle">' . $display_code . '<td width="33%">&nbsp;</td><td width="33%">&nbsp;</td></tr></table></div>'; 	
			} // end if
			
			elseif (($div3check_xs > 0.5) && ($col == 0)) {
			  //This is the last row and needs one space but is only the first column 
			  $output .= '<div><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr valign="middle">' . $display_code; 
			} // end else if
			
			elseif (($div3check_xs > 0.5) && ($col == 1)) {
			  //This is the last row and needs one space and is the second column and needs a spacer
			  $output .= $display_code . '<td width="33%">&nbsp;</td></tr></table></div>'; 
			} // end elseif
		  } // end $row if
	
		$col ++;
        if ($col > 2) {
		  $col = 0;
          $row ++;
        } // end if 
      } // end while
	  
	  echo $output;
?>
   </div>
</div>

    <!-- "next page" action -->
    <a class="next browse right"></a>
    <!-- xsell_products_eof //-->

        </td>
      </tr>
    </table>

<?php
	} // end if $num_products_xsell
  } // end conditional scroller code
  ?> 
    <!-- xsell_products //-->
    <?php
	
	if (USE_XSELL_HORIZ_SCROLLER != 'true') {  
	
      $info_box_contents = array();
      $info_box_contents[] = array('align' => 'left', 'text' => TEXT_XSELL_PRODUCTS);
      new contentBoxHeading($info_box_contents);

      $row = 0;
      $col = 0;
      $info_box_contents = array();
      while ($xsell = tep_db_fetch_array($xsell_query)) {
 
        $xsell['specials_new_products_price'] = tep_get_products_special_price($xsell['products_id']); 

		if ($xsell['specials_new_products_price']) { 
      	  $xsell_price =  '<span style="text-decoration:line-through">' . $currencies->display_price($xsell['products_price'], tep_get_tax_rate($xsell['products_tax_class_id'])) . '</span><br>'; 
      	  $xsell_price .= '<span class="productSpecialPrice">' . $currencies->display_price($xsell['specials_new_products_price'], tep_get_tax_rate($xsell['products_tax_class_id'])) . '</span>'; 
    	} else { 
	      $xsell_price =  $currencies->display_price($xsell['products_price'], tep_get_tax_rate($xsell['products_tax_class_id'])); 
	    } 
     
	  $info_box_contents[$row][$col] = array('align' => 'center',
                                             'params' => 'class="smallText" width="33%" valign="top"',
                                             'text' => '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $xsell['products_id']) . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $xsell['products_image'], $xsell['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $xsell['products_id']) . '">' . $xsell['products_name'] .'</a><br>' . $xsell_price. '<br><a href="' . tep_href_link(FILENAME_DEFAULT, tep_get_all_get_params(array('action')) . 'action=buy_now&products_id=' . $xsell['products_id'], 'NONSSL') . '">' . tep_image_button('button_buy_now.gif', TEXT_BUY . $xsell['products_name'] . TEXT_NOW) .'</a>');
      $col ++;
        if ($col > 2) {
          $col = 0;
          $row ++;
        }
      } // end while
      new contentBox($info_box_contents);
  } // end traditional code
?>
    <!-- xsell_products //-->
	<table>
	  <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
    </table>
<?php
  } // end if $_GET
?>