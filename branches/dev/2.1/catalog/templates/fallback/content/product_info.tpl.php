    <?php echo tep_draw_form('cart_quantity', tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action')) . 'action=add_product')); ?><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if ($product_check['total'] < 1) {
//  adapted for Separate Pricing Per Customer v4.2 2007/06/23, Hide products and categories from groups 2008/08/05
// BOF Separate Pricing Per Customer, Hide products and categories from groups
      $hide_product = true; // needed for column_right
// EOF Separate Pricing Per Customer, Hide products and categories from groups
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
    $product_info_query = tep_db_query("select p.products_id, pd.products_name, pd.products_description, pd.tab1, pd.tab2, pd.tab3, pd.tab4, pd.tab5, pd.tab6, p.products_model, p.products_quantity, p.products_image, pd.products_url, p.products_price, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
    $product_info = tep_db_fetch_array($product_info_query);

    tep_db_query("update " . TABLE_PRODUCTS_DESCRIPTION . " set products_viewed = products_viewed+1 where products_id = '" . (int)$_GET['products_id'] . "' and language_id = '" . (int)$languages_id . "'");

// BOF QPBPP for SPPC
    $pf->loadProduct((int)$_GET['products_id'], (int)$languages_id);
    $products_price = $pf->getPriceString();
// EOF QPBPP for SPPC

// BOF QPBPP for SPPC
  $min_order_qty = $pf->getMinOrderQty();
    if ($min_order_qty > 1) {
      $products_name .= '<br><span class="smallText">' . MINIMUM_ORDER_TEXT . $min_order_qty . '</span>';
    }
// EOF QPBPP for SPPC

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
        <td>
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
        <td class="main">
<?php
        //// BEGIN:  Added for Dynamic MoPics v3.000
    if (tep_not_null($product_info['products_image'])) {
?>
          <table border="0" cellspacing="0" cellpadding="0">
            <tr valign="top">
              <td align="left" width="100%">
                <table width="100%">
                    <tr><td width="100%">
                    <?php
                    // BOF: Tabs by PGM
                    if(USE_PRODUCT_DESCRIPTION_TABS != 'True') {
                              echo stripslashes($product_info['products_description']);
                              } else {
                              include(DIR_WS_MODULES . 'product_tabs.php'); }
                    // EOF: Tabs by PGM
                    ?>
                    </td></tr>
                    <tr>
                        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '4'); ?></td>
                    </tr>
                    <tr><td class="prod_attributes">
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
    }

//Display a table with which attributecombinations is on stock to the customer?
if(PRODINFO_ATTRIBUTE_DISPLAY_STOCK_LIST == 'True'): require(DIR_WS_MODULES . "qtpro_stock_table.php"); endif;

//++++ QT Pro: End Changed Code
?>
                    </td></tr>
                 </table>
              </td>
              <td align="center" class="smallText">
              <?php echo tep_draw_separator('pixel_trans.gif', '100%', '25'); ?>
<?php
            $image_lg = mopics_get_imagebase($product_info['products_image'], DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR);
            if ($lg_image_ext = mopics_file_exists($image_lg, DYNAMIC_MOPICS_BIG_IMAGE_TYPES)) {
                $image_size = @getimagesize($image_lg . '.' . $lg_image_ext);

            //BOF SLIMBOX
            $lightlarge = $image_lg . "." . $lg_image_ext;
?>
<script language="javascript"><!--
document.write('<?php echo '<a href="' . tep_href_link($lightlarge) . '" target="_blank" rel="lightbox[group]" title="'.addslashes($product_info['products_name']).'" >' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $product_info['products_image'], addslashes($product_info['products_name']), PRODUCT_IMAGE_WIDTH, PRODUCT_IMAGE_HEIGHT, 'hspace="4" vspace="4"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>');
//--></script>
<noscript>
<?php echo '<a href="' . tep_href_link($lightlarge) . '" target="_blank" rel="lightbox[group]" title="'.addslashes($product_info['products_name']).'" >' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $product_info['products_image'], addslashes($product_info['products_name']), PRODUCT_IMAGE_WIDTH, PRODUCT_IMAGE_HEIGHT, 'hspace="4" vspace="4"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>
</noscript>
<!--         EOF SLIMBOX   -->

<?php
            } else {
          echo tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $product_info['products_image'], stripslashes($product_info['products_name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
            }

//++++ QT Pro: Begin Changed code
    if (tep_not_null($product_info['products_image'])) {
?>
              </td>
            </tr>
          </table>
<?php
}
//++++ QT Pro: End Changed Code
}
        //// END:  Added for Dynamic MoPics v3.000
?>

<center>
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
?>
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
                <!-- ADDED PLUS AND MINUS BUTTONS PGM -->
                    <td class="main" align="right" width="250">
                      <table width="200" border="0" cellpadding="0">
                          <tr>
                            <td align="center"><img src="<?php echo DIR_WS_ICONS . 'plus.png' ?>" onclick="TextBox_AddToIntValue('product-quantity-{{product.id}}',+1)" alt="plus 1" ></td>
                            <td rowspan="2" align="center"><?php echo tep_draw_input_field('cart_quantity', $pf->adjustQty(1), 'size="2" id="product-quantity-{{product.id}}"'); ?></td>
                            <?php // START: PGM Edit to switch Add to Cart image if stock = 0
                            if ($product_info['products_quantity'] == 0 && STOCK_IMAGE_SWITCH == 'true') { ?>

                <td class="main align="right" rowspan="2">
					<?php echo tep_draw_hidden_field('products_id', $product_info['products_id']) . tep_image_submit('button_out_of_stock.gif', IMAGE_BUTTON_IN_CART); ?>
                </td>

                            <?php } else { ?>

                <td class="main" align="right" rowspan="2">
                	<?php echo tep_draw_hidden_field('products_id', $product_info['products_id']) . tep_image_submit('button_in_cart.gif', IMAGE_BUTTON_IN_CART); ?>
                </td>

                            <?php } // END: PGM Edit to switch Add to Cart image if stock = 0 ?>
                          </tr>
                          <tr>
                            <td align="center"><img src="<?php echo DIR_WS_ICONS . 'minus.png' ?>" onclick="TextBox_AddToIntValue('product-quantity-{{product.id}}',-1)" alt="minus 1" ></td>
                          </tr>
                        </table>
                   </td>
                <!-- ADDED PLUS AND MINUS BUTTONS PGM -->
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>
            <table width="100%">
              <tr>
                <td class="main" align="left" width="15%">
                <?php
                    $reviews_query = tep_db_query("select count(*) as count from " . TABLE_REVIEWS . " where products_id = '" . (int)$_GET['products_id'] . "'");
                    $reviews = tep_db_fetch_array($reviews_query);
                    if ($reviews['count'] > 0) {
                ?>
                <?php echo TEXT_CURRENT_REVIEWS . ' ' . $reviews['count']; ?></td>
                <?php
                    }
                ?>
                <?php if ($product_info['products_date_available'] > date('Y-m-d H:i:s')) { ?>
                <td align="center" class="smallText" width="70%"><?php echo sprintf(TEXT_DATE_AVAILABLE, tep_date_long($product_info['products_date_available'])); ?></td>
                <?php } else { ?>
                <td align="center" class="smallText" width="70%"><?php echo sprintf(TEXT_DATE_ADDED, tep_date_long($product_info['products_date_added'])); ?></td>
                <?php } ?>
                <td align="right" width="15%">&nbsp;</td>
              </tr>
            </table>
        </td>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td>

<!-- Page Module Controller -->
	<?php include (DIR_WS_MODULES . FILENAME_PI_PAGE_MODULES); ?>
<!-- Page Module Controller -->

<?php
  }
?>
        </td>
      </tr>
    </table></form>