<?php
/* 
$Id$

osCmax e-Commerce 
http://www.oscmax.com 

Copyright 2000 - 2011 osCmax

Released under the GNU General Public License 
*/ 

if ($_GET['products_id']) { 
  $xsell_query = tep_db_query("select distinct p.products_id, p.products_image, pd.products_name, p.products_model from " . TABLE_PRODUCTS_XSELL . " xp, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where xp.products_id = '" . $_GET['products_id'] . "' and xp.xsell_id = p.products_id and p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' and p.products_status = '1' and find_in_set('" . $customer_group_id . "', p.products_hide_from_groups) = '0' order by xp.sort_order asc limit " . MAX_DISPLAY_ALSO_PURCHASED);
$num_products_xsell = tep_db_num_rows($xsell_query); 
if ($num_products_xsell != 0) { // Check query is not blank

  // PGM WORKS OUT NUMBER OF ROWS AND SPACES NEEDED
	  $total_products_xs = tep_db_num_rows($xsell_query);
	  $div3_xs = round($total_products_xs / 3 , 2);
	  $div3main_xs = floor($div3_xs);
	  $div3check_xs = $div3_xs - $div3main_xs;
	  $div3rows_xs = $div3_xs - $div3check_xs;
  // PGM END	
  
  // BOF Separate Price per Customer
          if(!tep_session_is_registered('sppc_customer_group_id')) { 
            $customer_group_id = '0';
          } else {
            $customer_group_id = $sppc_customer_group_id;
          }
  // EOF Separate Price per Customer
  
    if ($num_products_xsell >= MIN_DISPLAY_ALSO_PURCHASED) { 

      if (USE_XSELL_HORIZ_SCROLLER == 'true') {
	?>
    <!-- xsell_products //-->
    <style type="text/css">
	.scrollable { width: <?php echo SCROLLER_WIDTH; ?>px; height: <?php echo SCROLLER_HEIGHT; ?>px }
	.items div { width: <?php echo SCROLLER_WIDTH; ?>px; }
	 a.browse { margin: <?php echo (SCROLLER_HEIGHT - 56)/2; ?>px 0px; /* Set the margin to height of scroller - height of buttons 56 / 2;  */ }
    <?php if ($total_products_xs <= 3) { ?>
	      a.left, a.right { visibility:hidden !important; }
    <?php } ?>
	</style>

    
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
	  $output = '';

      while ($xsell = tep_db_fetch_array($xsell_query)) {
 
        $pf->loadProduct($xsell['products_id'], $languages_id, NULL, NULL);

		  $display_code = '<td width="33%" class="smallText"><br><center><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $xsell['products_id']) . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $xsell['products_image'], $xsell['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $xsell['products_id']) . '">' . $xsell['products_name'] .'</a><br>' . $pf->getPriceStringShort() . '<br>' . $pf->getProductButtons($xsell['products_id'], FILENAME_PRODUCT_INFO, $xsell['products_model'], $xsell['products_name']) . '</center></td>';
 
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
 
        $pf->loadProduct($xsell['products_id'], $languages_id, NULL, NULL);
     
	  $info_box_contents[$row][$col] = array('align' => 'center',
                                             'params' => 'class="smallText" width="33%" valign="top"',
                                             'text' => '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $xsell['products_id']) . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $xsell['products_image'], $xsell['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a><br><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $xsell['products_id']) . '">' . $xsell['products_name'] .'</a><br>' . $pf->getPriceStringShort() . '<br>' . $pf->getProductButtons($xsell['products_id'], FILENAME_PRODUCT_INFO, $xsell['products_model'], $xsell['products_name']));
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
  } // end if ($num_products_xsell != 0)
} // end if $_GET
?>