<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

    echo tep_draw_form('product_reviews_write', tep_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, 'action=process&products_id=' . $_GET['products_id']), 'post', 'onSubmit="return checkForm();"'); ?>
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
                    document.write('<?php echo '<a href="' . tep_href_link($lightlarge) . '" target="_blank" id="image_big" rel="lightbox[group]" title="'.addslashes($product_info['products_name']).'" >' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR . $product_info['products_image'], addslashes($product_info['products_name']), PRODUCT_IMAGE_WIDTH, PRODUCT_IMAGE_HEIGHT, 'hspace="4" vspace="4"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>');
    //-->
                    </script>
                    <noscript>
                    <?php echo '<a href="' . tep_href_link($lightlarge) . '" target="_blank" rel="lightbox[group]" title="'.addslashes($product_info['products_name']).'" >' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR . $product_info['products_image'], addslashes($product_info['products_name']), PRODUCT_IMAGE_WIDTH, PRODUCT_IMAGE_HEIGHT, 'hspace="4" vspace="4"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>
                    </noscript>
                    <?php
            	} else {
          			echo tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR . $product_info['products_image'], stripslashes($product_info['products_name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
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
<?php
  if ($messageStack->size('review') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('review'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td class="main"><?php echo '<b>' . SUB_TITLE_FROM . '</b> ' . tep_output_string_protected($customer['customers_firstname'] . ' ' . $customer['customers_lastname']); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo SUB_TITLE_REVIEW; ?></b></td>
      </tr>
      <tr>
        <td class="main"><?php echo tep_draw_textarea_field('review', 60, 8); ?></td>
      </tr>
      <tr>
        <td>
          <table width="100%" border="0" cellspacing="0" cellpadding="2">
            <tr valign="top">
              <td class="main">Rating: <span id="stars-cap"></span><div id="stars-wrapper1"><?php echo tep_draw_radio_field('rating', '1', '', 'title="Poor"') . ' ' . tep_draw_radio_field('rating', '2', '', 'title="Fair"') . ' ' . tep_draw_radio_field('rating', '3','','title="Average"') . ' ' . tep_draw_radio_field('rating', '4','','title="Good"') . ' ' . tep_draw_radio_field('rating', '5','','title="Excellent"'); ?></div></td>
              <td class="smallText" align="right"><?php echo TEXT_NO_HTML; ?></td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="productinfo_buttons">
          <table border="0" width="100%" cellspacing="0" cellpadding="2">
            <tr>
              <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              <td class="main" align="left"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params(array('reviews_id', 'action'))) . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
              <td class="main" align="right"><?php echo tep_image_submit('button_submit_review.gif', IMAGE_BUTTON_CONTINUE); ?></td>
              <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
            </tr>
          </table>
        </td>
      </tr>  
    </table>
  </form>