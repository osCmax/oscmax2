<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

    echo tep_draw_form('cart_quantity', tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action')) . 'action=add_product')); ?>
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td class="productinfo_header">
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="pageHeading" valign="top"><?php echo $products_name; ?></td>
              <td class="pageHeading" align="right" valign="top"><?php echo $products_price; ?></td>
            </tr>
          </table>
        </td>
      </tr>
      
<?php
      $reviews_query_raw = "select r.reviews_id, left(rd.reviews_text, 100) as reviews_text, r.reviews_rating, r.date_added, r.customers_name from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd where r.products_id = '" . (int)$product_info['products_id'] . "' and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$languages_id . "' order by r.reviews_id desc";
      $reviews_split = new splitPageResults($reviews_query_raw, MAX_DISPLAY_NEW_REVIEWS);

  if ($reviews_split->number_of_rows > 0) {
    if ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3')) {
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td>        
          <table border="0" width="100%" cellspacing="0" cellpadding="2" class="filterbox">
            <tr>
              <td class="smallText"><?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?></td>
              <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info'))); ?></td>
            </tr>
          </table>
        </td>
      </tr>  
<?php
    } // end if 
  }  // end if
?>

      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td align="center" class="productinfo_imagebig">
<?php
	//// BEGIN:  Added for Dynamic MoPics v3.000
    if (tep_not_null($product_info['products_image'])) {

	            $image_lg = mopics_get_imagebase($product_info['products_image'], DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR);
    	        if ($lg_image_ext = mopics_file_exists($image_lg, DYNAMIC_MOPICS_BIG_IMAGE_TYPES)) {
        	        $image_size = @getimagesize($image_lg . '.' . $lg_image_ext);

            		//BOF SLIMBOX
            		$lightlarge = $image_lg . "." . $lg_image_ext;
					?>               
					<script type="text/javascript"><!--
                    document.write('<?php echo '<a href="' . tep_href_link($lightlarge) . '" target="_blank" id="image_big" rel="lightbox[group]" title="'.addslashes($product_info['products_name']).'" >' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_PRODUCTS_DIR . $product_info['products_image'], addslashes($product_info['products_name']), PRODUCT_IMAGE_WIDTH, PRODUCT_IMAGE_HEIGHT, 'hspace="4" vspace="4"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '<\/a>'; ?>');
    //-->
                    </script>
                    <noscript>
                    <?php echo '<a href="' . tep_href_link($lightlarge) . '" target="_blank" rel="lightbox[group]" title="'.addslashes($product_info['products_name']).'" >' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_PRODUCTS_DIR . $product_info['products_image'], addslashes($product_info['products_name']), PRODUCT_IMAGE_WIDTH, PRODUCT_IMAGE_HEIGHT, 'hspace="4" vspace="4"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>
                    </noscript>
                    <?php
            	} else {
          			echo tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_PRODUCTS_DIR . $product_info['products_image'], stripslashes($product_info['products_name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
            	}
	
	} // end if
?>
              </td>
              <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '10'); ?></td>
              <td class="productinfo_description">
              <?php
			  
			  $query = "select p.products_id, pd.products_name, pd.products_description, pd.tab1, pd.tab2, pd.tab3, pd.tab4, pd.tab5, pd.tab6, p.products_model, p.products_quantity, p.products_image, pd.products_url, p.products_msrp, p.products_price, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'";
          	  $product_info_query = tep_db_query($query);	
	          $product_info = tep_db_fetch_array($product_info_query);
			  
              echo stripslashes($product_info['products_description']);
			  ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>

      <tr>
        <td colspan="3" class="productinfo_buttons">
          <table border="0" width="100%" cellspacing="1" cellpadding="2">
            <tr>
              <td>
                <table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td class="main" align="left"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params()) . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
                	<!-- Wish List 3.5 Start -->
                	<td align="center"><?php echo tep_image_submit('button_wishlist.gif', 'Add to Wishlist', 'name="wishlist" value="wishlist"'); ?></td>
 	                <!-- Wish List 3.5 End   -->
       	            <!-- ADDED PLUS AND MINUS BUTTONS PGM -->
                    <td class="main" align="right" width="250">
                      <table width="200" border="0" cellpadding="0">
                        <tr>
                        <?php // START EASY CALL FOR PRICE v1.4
                          if ($product_info['products_price'] == CALL_FOR_PRICE_VALUE){ ?>
						    <td class="main" align="right" rowspan="2"><?php echo '<a href="' . tep_href_link(FILENAME_CONTACT_US, 'enquiry=Price Inquiry%0D%0A%0D%0AModel: ' . $product_info['products_model'] . '%0D%0AProduct Name: ' . $product_info['products_name'] . '%0D%0AProduct URL: ' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $product_info['products_id'] .'%0D%0A%0D%0A') . '') . '">' . tep_image_submit('button_cfp.gif', IMAGE_BUTTON_CFP); ?></a></td>
                        <?php } else { ?>  
                       	  	<td align="center"><img src="<?php echo DIR_WS_ICONS . 'plus.png' ?>" onclick="TextBox_AddToIntValue('product-quantity-{{product.id}}',+1)" alt="plus 1" class="plusminus"></td>
                          	<td rowspan="2" align="center"><?php echo tep_draw_input_field('cart_quantity', $pf->adjustQty(1), 'size="2" id="product-quantity-{{product.id}}"'); ?></td>
                            <?php // START: PGM Edit to switch Add to Cart image if stock = 0
							  if ($product_info['products_quantity'] == 0 && STOCK_IMAGE_SWITCH == 'true') { ?>
							    <td class="main" align="right" rowspan="2"><?php echo tep_draw_hidden_field('products_id', $product_info['products_id']) . tep_image_submit('button_out_of_stock.gif', IMAGE_BUTTON_IN_CART); ?></td>
							<?php } else { ?>
								<td class="main" align="right" rowspan="2"><?php echo tep_draw_hidden_field('products_id', $product_info['products_id']) . tep_image_submit('button_in_cart.gif', IMAGE_BUTTON_IN_CART); ?></td>
							<?php } // END: PGM Edit to switch Add to Cart image if stock = 0 ?>
                        </tr>
                        <tr>
                          <td align="center"><img src="<?php echo DIR_WS_ICONS . 'minus.png' ?>" onclick="TextBox_AddToIntValue('product-quantity-{{product.id}}',-1)" alt="minus 1" class="plusminus"></td>
                        <?php } // END: EASY CALL FOR PRICE v1.4 ?>
                        </tr>
                      </table>
                    </td>
                    <!-- ADDED PLUS AND MINUS BUTTONS PGM -->
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td colspan="3" class="productinfo_buttons">
          <table border="0" width="100%" cellspacing="1" cellpadding="2">
            <tr>
              <td>
                <table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main" align="center"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, tep_get_all_get_params()) . '">' . tep_image_button('button_write_review.gif', IMAGE_BUTTON_WRITE_REVIEW) . '</a>'; ?></td>
</td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>      

<?php
    if ($reviews_split->number_of_rows > 0) {

      $reviews_query = tep_db_query($reviews_split->sql_query);
      while ($reviews = tep_db_fetch_array($reviews_query)) {
?>
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="2">
            <tr>
              <td class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $product_info['products_id'] . '&reviews_id=' . $reviews['reviews_id']) . '"><u><b>' . sprintf(TEXT_REVIEW_BY, tep_output_string_protected($reviews['customers_name'])) . '</b></u></a>'; ?></td>
              <td class="smallText" align="right"><?php echo sprintf(TEXT_REVIEW_DATE_ADDED, tep_date_short($reviews['date_added'])); ?></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
            <tr class="infoBoxContents">
              <td>
                <table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td valign="top" class="main">
                      <table width="100%">
                        <tr>
                          <td valign="top" class="main" colspan="2"><?php echo tep_break_string(tep_output_string_protected($reviews['reviews_text']), 60, '-<br>') . ((strlen($reviews['reviews_text']) >= 100) ? '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $product_info['products_id'] . '&reviews_id=' . $reviews['reviews_id']) . '">' . TEXT_READ_MORE . '</a>' : ''); ?></td>
                        </tr>
                        <tr>
                          <td valign="top" class="main"><?php echo sprintf(TEXT_REVIEW_RATING, tep_image(DIR_WS_IMAGES . 'icons/stars_' . $reviews['reviews_rating'] . '.gif', sprintf(TEXT_OF_5_STARS, $reviews['reviews_rating'])), sprintf(TEXT_OF_5_STARS, $reviews['reviews_rating'])) . '</i>'; ?></td>
                          <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $product_info['products_id'] . '&reviews_id=' . $reviews['reviews_id']) . '">' . tep_image_button('button_read_review.gif', $reviews['products_name']); ?></td>
                        </tr>
                      </table>
                    </td>
                    <td width="10" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
      } // end while
?>
<?php
    } else {
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><?php new infoBox(array(array('text' => TEXT_NO_REVIEWS))); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  } 

  if (($reviews_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="2"  class="filterbox">
            <tr>
              <td class="smallText"><?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?></td>
              <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info'))); ?></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  } // end if
?>
    </table>
</form>