<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
      echo tep_draw_form('order', tep_href_link(FILENAME_CHECKOUT_SUCCESS, 'action=update', 'SSL')); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '4'); ?></td>
      </tr>
	  <tr>
        <td class="productinfo_header"><table border="0" width="100%" cellspacing="4" cellpadding="2">
          <tr>
            <td valign="middle" align="center"><?php echo tep_image(DIR_WS_ICONS . 'complete.png', $HEADING_TITLE); ?></td>
            <td valign="top" class="main"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?><div align="center" class="pageHeading"><?php echo HEADING_TITLE; ?></div><br><?php echo TEXT_SUCCESS; ?><br><br>
<?php
  //PWA BOF
  if (!tep_session_is_registered('customer_is_guest')) {
  //PWA EOF
/* One Page Checkout - BEGIN */
  if (tep_session_is_registered('customer_id')) {
/* One Page Checkout - END */
  if ($global['global_product_notifications'] != '1') {
    echo TEXT_NOTIFY_PRODUCTS . '<br><p class="productsNotifications">';

    $products_displayed = array();
    for ($i=0, $n=sizeof($products_array); $i<$n; $i++) {
      if (!in_array($products_array[$i]['id'], $products_displayed)) {
        echo tep_draw_checkbox_field('notify[]', $products_array[$i]['id']) . ' ' . $products_array[$i]['text'] . '<br>';
        $products_displayed[] = $products_array[$i]['id'];
      }
    }

    echo '</p>';
  } else {
    echo  TEXT_SEE_ORDERS . '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '"><u>' . LOGIN_BOX_MY_ACCOUNT . '</u></a>' . TEXT_SEE_ORDERS_1 . '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '"><u>' . LOGIN_BOX_ACCOUNT_HISTORY . '</u></a><br><br>' . TEXT_CONTACT_STORE_OWNER . '<a href="' . tep_href_link(FILENAME_CONTACT_US) . '"><u>' . TEXT_STORE_OWNER . '</u></a>';
    }
/* One Page Checkout - BEGIN */
  }
/* One Page Checkout - END */    
  //PWA BOF
  }
  //PWA EOF
?>
            <h3><?php echo TEXT_THANKS_FOR_SHOPPING; ?></h3></td>
          </tr>
        </table></td>
      </tr>
<?php
// Start - CREDIT CLASS Gift Voucher Contribution
  require('add_checkout_success.php');
// End - CREDIT CLASS Gift Voucher Contribution
 ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td align="right" class="main"><?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <?php if (ONEPAGE_CHECKOUT_ENABLED == 'True') { ?>
      <tr>
		<td><table border="0" width="100%" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="50%" align="right"><?php echo tep_draw_separator('pixel_silver.gif', '1', '5'); ?></td>
				<td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
			  </tr>
			</table></td>
			<td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
                <td width="50%" align="left"><?php echo tep_image(DIR_WS_ICONS . 'checkout_bullet.gif'); ?></td>
			  </tr>
			</table></td>
		  </tr>
		  <tr>
			<td align="center" width="25%" class="checkoutBarTo"><?php echo CHECKOUT_BAR_CONFIRMATION; ?></td>
			<td align="center" width="25%" class="checkoutBarCurrent"><?php echo CHECKOUT_BAR_FINISHED; ?></td>
		  </tr>
		</table></td>
	  </tr>
      <?php } else { ?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%" align="right"><?php echo tep_draw_separator('pixel_silver.gif', '1', '5'); ?></td>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
              </tr>
            </table></td>
            <td width="25%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
            <td width="25%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
            <td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
                <td width="50%"><?php echo tep_image(DIR_WS_ICONS . 'checkout_bullet.gif'); ?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td align="center" width="25%" class="checkoutBarFrom"><?php echo CHECKOUT_BAR_DELIVERY; ?></td>
            <td align="center" width="25%" class="checkoutBarFrom"><?php echo CHECKOUT_BAR_PAYMENT; ?></td>
            <td align="center" width="25%" class="checkoutBarFrom"><?php echo CHECKOUT_BAR_CONFIRMATION; ?></td>
            <td align="center" width="25%" class="checkoutBarCurrent"><?php echo CHECKOUT_BAR_FINISHED; ?></td>
          </tr>
        </table></td>
      </tr>
      <?php } ?>
<?php if (DOWNLOAD_ENABLED == 'true') include(DIR_WS_MODULES . 'downloads.php');
  //---PayPal WPP Modification START ---//
    tep_paypal_wpp_ep_button(FILENAME_SHOPPING_CART);
  //---PayPal WPP Modification END ---// 
?>
    </table></form>