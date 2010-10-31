    <?php echo tep_draw_form('cart_quantity', tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action')) . 'action=add_product')); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
<?php
  if ($product_check['total'] < 1) {
   // BOF Separate Price per Customer
     if(!tep_session_is_registered('sppc_customer_group_id')) { 
     $customer_group_id = '0';
     } else {
      $customer_group_id = $sppc_customer_group_id;
     }
   // EOF Separate Price per Customer
?>
      <tr>
        <td><?php new infoBox(array(array('text' => TEXT_PRODUCT_NOT_FOUND))); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
  } else {
    $product_info_query = tep_db_query("select p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_quantity, p.products_image, pd.products_url, p.products_price, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
    $product_info = tep_db_fetch_array($product_info_query);

    tep_db_query("update " . TABLE_PRODUCTS_DESCRIPTION . " set products_viewed = products_viewed+1 where products_id = '" . (int)$_GET['products_id'] . "' and language_id = '" . (int)$languages_id . "'");

    if ($new_price = tep_get_products_special_price($product_info['products_id'])) {
// BOF Separate Price per Customer

        $scustomer_group_price_query = tep_db_query("select customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . (int)$_GET['products_id']. "' and customers_group_id =  '" . $customer_group_id . "'");
        if ($scustomer_group_price = tep_db_fetch_array($scustomer_group_price_query)) {
        $product_info['products_price']= $scustomer_group_price['customers_group_price'];
	}
// EOF Separate Price per Customer
      $products_price = '<span style="text-decoration:line-through">' . $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span> <span class="productSpecialPrice">' . $currencies->display_price($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';
    } else {
// BOF Separate Price per Customer
        $scustomer_group_price_query = tep_db_query("select customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . (int)$_GET['products_id']. "' and customers_group_id =  '" . $customer_group_id . "'");
        if ($scustomer_group_price = tep_db_fetch_array($scustomer_group_price_query)) {
        $product_info['products_price']= $scustomer_group_price['customers_group_price'];
	}
// EOF Separate Price per Customer
      $products_price = $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id']));
    }

    if (tep_not_null($product_info['products_model'])) {
      $products_name = $product_info['products_name'] . '<br><span class="smallText">[' . $product_info['products_model'] . ']</span>';
    } else {
      $products_name = $product_info['products_name'];
    }

// BOF: Mod - Wishlist
//DISPLAY PRODUCT WAS ADDED TO WISHLIST IF WISHLIST REDIRECT IS ENABLED
    if(tep_session_is_registered('wishlist_id')) {
?>  
      <tr>
        <td class="messageStackSuccess"><?php echo PRODUCT_ADDED_TO_WISHLIST; ?></td>
      </tr> 
<?php
      tep_session_unregister('wishlist_id');
    }
// EOF: Mod - Wishlist
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading" valign="top"><?php echo $products_name; ?></td>
            <td align="right" valign="top"><h2><?php echo $products_price; ?></h2></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main">
<?php
		//// BEGIN:  Added for Dynamic MoPics v3.000
    if (tep_not_null($product_info['products_image'])) {
?>
          <table border="0" cellspacing="0" cellpadding="2" align="right">
            <tr>
              <td align="center" class="smallText">
<?php
			$image_lg = mopics_get_imagebase($product_info['products_image'], DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR);
			if ($lg_image_ext = mopics_file_exists($image_lg, DYNAMIC_MOPICS_BIG_IMAGE_TYPES)) {
				$image_size = @getimagesize($image_lg . '.' . $lg_image_ext);
				
			//BOF SLIMBOX
			$lightlarge = $image_lg . "." . $lg_image_ext;
?>
<script type="text/javascript"><!--
document.write('<?php echo '<a href="' . tep_href_link($lightlarge) . '" target="_blank" rel="lightbox[group]" title="'.$product_info['products_name'].'" >' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $product_info['products_image'], $product_info['products_name'], PRODUCT_IMAGE_WIDTH, PRODUCT_IMAGE_HEIGHT, 'hspace="4" vspace="4"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>');
//--></script>
<noscript>
<?php echo '<a href="' . tep_href_link($lightlarge) . '" target="_blank" rel="lightbox[group]" title="'.$product_info['products_name'].'" >' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $product_info['products_image'], $product_info['products_name'], PRODUCT_IMAGE_WIDTH, PRODUCT_IMAGE_HEIGHT, 'hspace="4" vspace="4"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>
</noscript>
<!--		 EOF SLIMBOX   -->

<?php
			} else {
          echo tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $product_info['products_image'], stripslashes($product_info['products_name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
			}
?>
              </td>
            </tr>
          </table>
<?php
    }
		//// END:  Added for Dynamic MoPics v3.000
?>
          <p><?php echo stripslashes($product_info['products_description']); ?></p>
<?php
    $products_attributes_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . (int)$_GET['products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "'");
    $products_attributes = tep_db_fetch_array($products_attributes_query);
    if ($products_attributes['total'] > 0) {
//++++ QT Pro: Begin Changed code
      $products_id=(preg_match("/^\d{1,10}(\{\d{1,10}\}\d{1,10})*$/",$_GET['products_id']) ? $_GET['products_id'] : (int)$_GET['products_id']); 
      require(DIR_WS_CLASSES . 'pad_' . PRODINFO_ATTRIBUTE_PLUGIN . '.php');
      $class = 'pad_' . PRODINFO_ATTRIBUTE_PLUGIN;
      $pad = new $class($products_id);
      echo $pad->draw();
//++++ QT Pro: End Changed Code
    }
?>
        </td>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
		//// BEGIN:  Added for Dynamic MoPics v3.000
 if (is_file(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $product_info['products_image']) && DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $product_info['products_image'] != "pixel_trans.gif"){
 					 include(DIR_WS_MODULES . 'dynamic_mopics.php');   	
	   } 
		//// END:  Added for Dynamic MoPics v3.000
?>
</center>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
    $reviews_query = tep_db_query("select count(*) as count from " . TABLE_REVIEWS . " where products_id = '" . (int)$_GET['products_id'] . "'");
    $reviews = tep_db_fetch_array($reviews_query);
    if ($reviews['count'] > 0) {
?>
      <tr>
        <td class="main"><?php echo TEXT_CURRENT_REVIEWS . ' ' . $reviews['count']; ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
    }

    if (tep_not_null($product_info['products_url'])) {
?>
      <tr>
        <td class="main"><?php echo sprintf(TEXT_MORE_INFORMATION, tep_href_link(FILENAME_REDIRECT, 'action=url&goto=' . urlencode($product_info['products_url']), 'NONSSL', true, false)); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
    }

    if ($product_info['products_date_available'] > date('Y-m-d H:i:s')) {
?>
      <tr>
        <td align="center" class="smallText"><?php echo sprintf(TEXT_DATE_AVAILABLE, tep_date_long($product_info['products_date_available'])); ?></td>
      </tr>
<?php
    } else {
?>
      <tr>
        <td align="center" class="smallText"><?php echo sprintf(TEXT_DATE_ADDED, tep_date_long($product_info['products_date_added'])); ?></td>
      </tr>
<?php
    }
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td class="main"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS, tep_get_all_get_params()) . '">' . tep_image_button('button_reviews.gif', IMAGE_BUTTON_REVIEWS) . '</a>'; ?></td>
                <!-- Wish List 3.5 Start -->
                <td align="center"><?php echo tep_image_submit('button_wishlist.gif', 'Add to Wishlist', 'name="wishlist" value="wishlist"'); ?></td>
                <!-- Wish List 3.5 End   -->
                <td class="main" align="right"><?php echo tep_draw_hidden_field('products_id', $product_info['products_id']) . tep_image_submit('button_in_cart.gif', IMAGE_BUTTON_IN_CART); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td>
<?php

//added for cross -sell
   if ( (USE_CACHE == 'true') && !SID) {
    echo tep_cache_also_purchased(3600);
     include(DIR_WS_MODULES . FILENAME_XSELL_PRODUCTS);
   } else {
     include(DIR_WS_MODULES . FILENAME_XSELL_PRODUCTS);
      include(DIR_WS_MODULES . FILENAME_ALSO_PURCHASED_PRODUCTS);
    }
  }
?>
        </td>
      </tr>
    </table></form>