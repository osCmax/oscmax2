<!-- body_text //-->
    <?php echo tep_draw_form('cart_quantity', tep_href_link(FILENAME_PRODUCT_INFO, tep_get_all_get_params(array('action')) . 'action=add_product')); ?>
    <table class="productListing" width="100%" cellspacing="0" cellpadding="1" border="0">
      <tr valign="top">
        <td valign="top" align="center">Thank you for buying with</td>
      </tr>
      <tr valign="top">
        <td valign="top" align="center"><img src="http://checkout.google.com/seller/images/google_checkout.gif" /></td>
      </tr>
      <tr valign="top">
        <td class="main"><?php echo TEXT_ITEMS_PURCHASED ?></td>
      </tr>
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
    $product_info_query = tep_db_query("select p.products_id, pd.products_name, pd.products_description, p.products_model, p.products_quantity, p.products_image, pd.products_url, p.products_price, p.products_tax_class_id, p.products_date_added, p.products_date_available, p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id in (" . $products . ") and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "'");
    while ($product_info = tep_db_fetch_array($product_info_query)) {
      if ($new_price = tep_get_products_special_price($product_info['products_id'])) {
// BOF Separate Price per Customer

        $scustomer_group_price_query = tep_db_query("select customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . (int)$HTTP_GET_VARS['products_id']. "' and customers_group_id =  '" . $customer_group_id . "'");
        if ($scustomer_group_price = tep_db_fetch_array($scustomer_group_price_query)) {
        $product_info['products_price']= $scustomer_group_price['customers_group_price'];
	}
// EOF Separate Price per Customer
        $products_price = '<s>' . $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) . '</s> <span class="productSpecialPrice">' . $currencies->display_price($new_price, tep_get_tax_rate($product_info['products_tax_class_id'])) . '</span>';
      } else {
// BOF Separate Price per Customer
        $scustomer_group_price_query = tep_db_query("select customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . (int)$HTTP_GET_VARS['products_id']. "' and customers_group_id =  '" . $customer_group_id . "'");
        if ($scustomer_group_price = tep_db_fetch_array($scustomer_group_price_query)) {
        $product_info['products_price']= $scustomer_group_price['customers_group_price'];
	}
// EOF Separate Price per Customer
        $products_price = $currencies->display_price($product_info['products_price'], tep_get_tax_rate($product_info['products_tax_class_id']));
      }
  
      if (tep_not_null($product_info['products_model'])) {
        $products_name = $product_info['products_name'] . '&nbsp&nbsp&nbsp<span class="smallText">[' . $product_info['products_model'] . ']</span>';
      } else {
        $products_name = $product_info['products_name'];
      }
?>
        <tr class="productListing-odd">
          <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="pageHeading" valign="top"><?php echo $products_name; ?></td>
<!--              <td class="pageHeading" align="right" valign="top"><?php echo $products_price; ?></td> -->
            </tr>
          </table></td>
        </tr>
        <tr>
          <td class="main">
<?php
      if (0 && tep_not_null($product_info['products_image'])) {
?>
            <table border="0" cellspacing="0" cellpadding="2" align="right">
              <tr>
                <td align="center" class="smallText">
  <script language="javascript"><!--
  document.write('<?php echo '<a href="javascript:popupWindow(\\\'' . tep_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $product_info['products_id']) . '\\\')">' . tep_image(DIR_WS_IMAGES . $product_info['products_image'], addslashes($product_info['products_name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'hspace="5" vspace="5"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>');
  //--></script>
  <noscript>
  <?php echo '<a href="' . tep_href_link(DIR_WS_IMAGES . $product_info['products_image']) . '" target="_blank">' . tep_image(DIR_WS_IMAGES . $product_info['products_image'], $product_info['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'hspace="5" vspace="5"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>
  </noscript>
                </td>
              </tr>
            </table>
<?php
      }
    }
  }
?>
        </td>
      </tr>
      
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td>
          <?php
//          $products = '7,19,20,21,22';
            if (isset($products)) {
              $orders_query = tep_db_query("select p.products_id, p.products_image from " .
                         "" . TABLE_ORDERS_PRODUCTS . " opa, " . TABLE_ORDERS_PRODUCTS . " opb, " .
                         "" . TABLE_ORDERS . " o, " . TABLE_PRODUCTS . " p where opa.products_id in " .
                         "(" . $products . ")" .
                         " and opa.orders_id = opb.orders_id and opb.products_id not in " .
                         "(" . $products . ") and opb.products_id " .
                         "= p.products_id and opb.orders_id = o.orders_id and p.products_status " .
                         "= '1' group by p.products_id order by o.date_purchased " .
                         "desc limit " . MAX_DISPLAY_ALSO_PURCHASED);
              
              
              $num_products_ordered = tep_db_num_rows($orders_query);
              if ($num_products_ordered >= MIN_DISPLAY_ALSO_PURCHASED) {
          ?>
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
<?php
$cart->reset(true);
?>
<!-- body_text_eof //-->
