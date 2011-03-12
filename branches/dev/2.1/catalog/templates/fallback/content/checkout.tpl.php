<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<!-- body_text //-->
<noscript>
 <table width="100%"><tr><td class="messageStackError"><?php echo TEXT_NO_JAVASCRIPT; ?></td></tr></table>
 <?php echo TEXT_ENABLE_JAVSCRIPT_INSTRUCTIONS; ?>
</noscript>
<div id="pageContentContainer" style="display:none;">
   <?php echo tep_draw_form('checkout', tep_href_link(FILENAME_CHECKOUT, '', $request_type)) . tep_draw_hidden_field('action', 'process'); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
	 <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
	  <tr>
	   <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
	  </tr>
	  <!--<tr>
	   <td class="main" align="center" style="height:100px;"><div id="ajaxLoader" style="display:none;"<img src="ext/jQuery/themes/smoothness/images/ajax_load.gif"><br>Please wait while ajax requests finish...</div></td>
	  </tr>-->
	 </table></td>
	</tr>
	<tr>
	 <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
	</tr>
<?php
  if (isset($_GET['payment_error']) && is_object(${$_GET['payment_error']}) && ($error = ${$_GET['payment_error']}->get_error())) {
?>
	<tr>
	 <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
	  <tr>
	   <td class="main"><b><?php echo $error['title']; ?></b></td>
	  </tr>
	 </table></td>
	</tr>
	<tr>
	 <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBoxNotice">
	  <tr class="infoBoxNoticeContents">
	   <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
		<tr>
		 <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
		 <td class="main" width="100%" valign="top"><?php
		 if($error['error']!='')
  			    echo htmlspecialchars_decode($error['error']);
			 else
  			    echo TEXT_PAYMENT_METHOD_UPDATE_ERROR; ?>
  			</td>
		 <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
		</tr>
	   </table></td>
	  </tr>
	 </table></td>
	</tr>
	<tr>
	 <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
	</tr>
<?php
  }
?>
	<tr>
	 <td class="main" width="50%"><?php
	  $header = TABLE_HEADING_PRODUCTS;

	  ob_start();
	  include(DIR_WS_INCLUDES . 'checkout/cart.php');
	  $cartContents = ob_get_contents();
	  ob_end_clean();

	  $cartContents .= '<br><div style="float:right" class="orderTotals">' .
	  (MODULE_ORDER_TOTAL_INSTALLED ? '<table cellpadding="2" cellspacing="0" border="0">' . $order_total_modules->output() . '</table>' : '') . '</div>';

	  buildInfobox($header, $cartContents);
	  echo tep_image_submit('button_update_cart.gif', IMAGE_UPDATE_CART, 'name="updateQuantities" id="updateCartButton" style="display:none"');
	 ?></td>
	</tr>
	<tr>
	 <td class="main" style="padding-top:5px;"><table cellpadding="0" cellspacing="0" border="0" width="100%">
	  <tr>
	   <td class="main" width="50%" align="left"><?php
		if (MODULE_ORDER_TOTAL_COUPON_STATUS == 'true'){
			echo '<table cellpadding="2" cellspacing="0" border="0">
			 <tr>
			  <td class="main"><b>' . TEXT_HAVE_COUPON_CCGV . '</b></td>
			 </tr>
			 <tr>
			  <td class="main">' . tep_draw_input_field('gv_redeem_code', '') . '</td>
			  <td class="main">' . tep_image_submit('button_redeem.gif', IMAGE_REDEEM_VOUCHER, 'id="voucherRedeem"') . '</td>
			 </tr>
			</table>';
		}
		//BOF KGT
		if (MODULE_ORDER_TOTAL_DISCOUNT_COUPON_STATUS == 'true'){
			echo '<table cellpadding="2" cellspacing="0" border="0">
			 <tr>
			  <td class="main"><b>' . TEXT_HAVE_COUPON_CCGV . '</b></td>
			 </tr>
			 <tr>
			  <td class="main">' . tep_draw_input_field('coupon', '') . '</td>
			  <td class="main">' . tep_image_submit('button_redeem.gif', IMAGE_REDEEM_VOUCHER, 'id="voucherRedeemCoupon"') . '</td>
			 </tr>
			</table>';
		}
		//EOF KGT
	   ?></td>
	   <td class="main" width="50%" align="right"><table cellpadding="2" cellspacing="0" border="0">
	   </table></td>
	  </tr>
	 </table></td>
	</tr>
	<tr>
	 <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
	</tr>
	<tr>
	 <td>


   <table border="0" width="100%" cellspacing="0" cellpadding="2">
	  <tr>
	   <td class="main" width="<?php echo (ONEPAGE_ADDR_LAYOUT == 'vertical' ? '100%' : '50%');?>" valign="top"><?php
		$header = TABLE_HEADING_BILLING_ADDRESS;

		ob_start();
		include(DIR_WS_INCLUDES . 'checkout/billing_address.php');
		$billingAddress = ob_get_contents();
		ob_end_clean();

		$billingAddress = '<table border="0" width="100%" cellspacing="0" cellpadding="2">
		 <tr id="logInRow"' . (isset($_SESSION['customer_id']) ? ' style="display:none"' : '') . '>
		  <td class="main"> ' . TEXT_EXISTING_CUSTOMER_LOGIN .' <a href="' . fixSeoLink(tep_href_link(FILENAME_LOGIN)) . '" id="loginButton">' . tep_image_button('button_login.gif', IMAGE_LOGIN) . '</a></td>
		 </tr>
		</table>' . $billingAddress;


		buildInfobox($header, $billingAddress);
	   ?><table id="changeBillingAddressTable" border="0" width="100%" cellspacing="0" cellpadding="2"<?php echo (isset($_SESSION['customer_id']) ? '' : ' style="display:none"');?>>
    		<tr>
    		 <td class="main" align="right"><a id="changeBillingAddress" href="<?php echo tep_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', $request_type);?>"><?php echo tep_image_button('button_change_address.gif', IMAGE_BUTTON_CHANGE_ADDRESS);?></a></td>
    		</tr>
  	   </table>
     </td>
<?php if(ONEPAGE_ADDR_LAYOUT == 'vertical') {?>
    </tr>
<?php } ?>

<?php
  if ($onepage['shippingEnabled'] === true){
?>
<?php if(ONEPAGE_ADDR_LAYOUT == 'vertical') {?>
    <tr>
<?php } ?>
	   <td class="main" width="<?php echo (ONEPAGE_ADDR_LAYOUT == 'vertical' ? '100%' : '50%'); ?>" valign="top"><?php
		$header = TABLE_HEADING_SHIPPING_ADDRESS;

		ob_start();
		include(DIR_WS_INCLUDES . 'checkout/shipping_address.php');
		$shippingAddress = ob_get_contents();
		ob_end_clean();

		if (!tep_session_is_registered('customer_id')){
			$shippingAddress = '<table border="0" width="100%" cellspacing="0" cellpadding="2">
			 <tr>
			  <td class="main">' . TEXT_DIFFERENT_SHIPPING . ' <input type="checkbox" name="diffShipping" id="diffShipping" value="1"></td>
			 </tr>
			</table>' . $shippingAddress;
		}

		buildInfobox($header, $shippingAddress);
	   ?><table id="changeShippingAddressTable" border="0" width="100%" cellspacing="0" cellpadding="2" <?php echo (isset($_SESSION['customer_id']) ? '' : ' style="display:none"');?>>
		<tr>
		 <td class="main" align="right"><a id="changeShippingAddress" href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', $request_type);?>"><?php echo tep_image_button('button_change_address.gif', IMAGE_BUTTON_CHANGE_ADDRESS);?></a></td>
		</tr>
	   </table></td>
<?php
  }
?>
	  </tr>
	 </table></td>
	</tr>
	<tr>
	 <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
	</tr>
	  <tr>
		<td><?php
		$header = TABLE_HEADING_PAYMENT_METHOD;

		$paymentMethod = '';
		if (isset($_SESSION['customer_id'])){
			ob_start();
			include(DIR_WS_INCLUDES . 'checkout/payment_method.php');
			$paymentMethod = ob_get_contents();
			ob_end_clean();
		}

		$paymentMethod = '<div id="noPaymentAddress" class="main noAddress" align="center" style="font-size:15px;' . (isset($_SESSION['customer_id']) ? 'display:none;' : '') . '">Please fill in your <b>billing address</b> for payment options</div><div id="paymentMethods"' . (!isset($_SESSION['customer_id']) ? ' style="display:none;"' : '') . '>' . $paymentMethod . '</div>';
		buildInfobox($header, $paymentMethod);
	   ?></td>
	  </tr>
	  <tr>
		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
	  </tr>
<?php
  if ($onepage['shippingEnabled'] === true){
	  if (tep_count_shipping_modules() > 0) {
?>
	  <tr>
		<td><?php
		$header = TABLE_HEADING_SHIPPING_METHOD;

		$shippingMethod = '';
		if (isset($_SESSION['customer_id'])){
			ob_start();
			include(DIR_WS_INCLUDES . 'checkout/shipping_method.php');
			$shippingMethod = ob_get_contents();
			ob_end_clean();
		}

		$shippingMethod = '<div id="noShippingAddress" class="main noAddress" align="center" style="font-size:15px;' . (isset($_SESSION['customer_id']) ? 'display:none;' : '') . '">Please fill in <b>at least</b> your billing address to get shipping quotes.</div><div id="shippingMethods"' . (!isset($_SESSION['customer_id']) ? ' style="display:none;"' : '') . '>' . $shippingMethod . '</div>';
		buildInfobox($header, $shippingMethod);
	   ?></td>
	  </tr>
	  <tr>
		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
	  </tr>
<?php
	  }
  }
?>
	  <tr>
		<td><?php
		$header = TABLE_HEADING_COMMENTS;

		ob_start();
		include(DIR_WS_INCLUDES . 'checkout/comments.php');
		$commentBox = ob_get_contents();
		ob_end_clean();

		buildInfobox($header, $commentBox);
	   ?></td>
	  </tr>
	  <tr>
		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
	  </tr>
      
<?php if (MATC == 'true') { ?>
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="1" cellpadding="2">
            <tr>
              <td id="MATCtd" class="messageStackAlert" align="center"><?php echo tep_draw_checkbox_field('MATC','true', false, 'id="MATC" onClick="javascript:switchMATC()"'); ?><?php echo TERMS_PART_1; ?><a id="conditions" href="<?php echo $HTTP_SERVER . DIR_WS_CATALOG . 'conditions.php?info_id=11&languages_id=' . (isset($languages_id) ? $languages_id : '1'); ?>" title="<?php echo TERMS_PART_2; ?>"><?php echo TERMS_PART_2; ?></a>
              </td>
            </tr>
          </table>
        </td>
      </tr>
	  <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
	  <tr>
		<td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
		  <tr class="infoBoxContents" id="checkoutYesScript" style="display:none;">
			<td><table border="0" width="100%" cellspacing="0" cellpadding="2">
			  <tr>
				<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
				<td class="main" id="checkoutMessage"><?php echo '<b>' . TITLE_CONTINUE_CHECKOUT_PROCEDURE . '</b><br>' . TEXT_CONTINUE_CHECKOUT_PROCEDURE; ?></td>
                
				<td class="main" align="right"><span id="enableMATC"><?php if(ONEPAGE_CHECKOUT_LOADER_POPUP == 'False'){ ?><div id="ajaxMessages" style="display:none;"></div><?php } ?><div id="checkoutButtonContainer"><?php echo tep_image_submit('button_confirm_order.gif', IMAGE_BUTTON_CONTINUE, 'id="checkoutButton" formUrl="' . tep_href_link(FILENAME_CHECKOUT_PROCESS, '', $request_type) . '"'); ?><input type="hidden" name="formUrl" id="formUrl" value=""></div><div id="paymentHiddenFields" style="display:none;"></div></span>
                <span id="disableMATC" style="cursor: pointer;"><?php echo tep_image_button('button_MAT.gif', IMAGE_BUTTON_MAT, ' onClick="javascript:warnMATC()"'); ?></span></td>
				<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
			  </tr>
			</table></td>
		  </tr>
<?php } else { ?>
      
	  <tr>
		<td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
		  <tr class="infoBoxContents" id="checkoutYesScript" style="display:none;">
			<td><table border="0" width="100%" cellspacing="0" cellpadding="2">
			  <tr>
				<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
				<td class="main" id="checkoutMessage"><?php echo '<b>' . TITLE_CONTINUE_CHECKOUT_PROCEDURE . '</b><br>' . TEXT_CONTINUE_CHECKOUT_PROCEDURE; ?></td>
                
				<td class="main" align="right"><?php if(ONEPAGE_CHECKOUT_LOADER_POPUP == 'False'){ ?><div id="ajaxMessages" style="display:none;"></div><?php } ?><div id="checkoutButtonContainer"><?php echo tep_image_submit('button_confirm_order.gif', IMAGE_BUTTON_CONTINUE, 'id="checkoutButton" formUrl="' . tep_href_link(FILENAME_CHECKOUT_PROCESS, '', $request_type) . '"'); ?><input type="hidden" name="formUrl" id="formUrl" value=""></div><div id="paymentHiddenFields" style="display:none;"></div></td>
				<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
			  </tr>
			</table></td>
		  </tr>
<?php } ?>

		  <tr class="infoBoxContents" id="checkoutNoScript">
			<td><table border="0" width="100%" cellspacing="0" cellpadding="2">
			  <tr>
				<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
				<td class="main"><?php echo '<b>' . TITLE_CONTINUE_CHECKOUT_PROCEDURE . '</b><br>to update/view your order.'; ?></td>
				<td class="main" align="right"><?php echo tep_image_submit('button_update.gif', IMAGE_BUTTON_UPDATE); ?></td>
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
		<td><table border="0" width="100%" cellspacing="0" cellpadding="0">
		  <tr>
			<td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="50%" align="right"><?php echo tep_image(DIR_WS_ICONS . 'checkout_bullet.gif'); ?></td>
				<td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
			  </tr>
			</table></td>
			<td width="25%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
			  <tr>
				<td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
				<td width="50%"><?php echo tep_draw_separator('pixel_silver.gif', '1', '5'); ?></td>
			  </tr>
			</table></td>
		  </tr>
		  <tr>
			<td align="center" width="25%" class="checkoutBarTo"><?php echo CHECKOUT_BAR_CONFIRMATION; ?></td>
			<td align="center" width="25%" class="checkoutBarTo"><?php echo CHECKOUT_BAR_FINISHED; ?></td>
		  </tr>
		</table></td>
	  </tr>
	</table></form>
	</div>
<!-- body_text_eof //-->
<!-- dialogs_bof //-->
<div id="loginBox" title="Log Into My Account" style="display:none;"><table cellpadding="2" cellspacing="0" border="0">
 <tr>
  <td class="main"><?php echo ENTRY_EMAIL_ADDRESS;?></td>
  <td><?php echo tep_draw_input_field('email_address');?></td>
 </tr>
 <tr>
  <td class="main"><?php echo ENTRY_PASSWORD;?></td>
  <td><?php echo tep_draw_password_field('password');?></td>
 </tr>
 <tr>
  <td colspan="2" align="right" class="main"><a href="<?php echo tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL');?>"><?php echo TEXT_PASSWORD_FORGOTTEN;?></a></td>
 </tr>
 <tr>
  <td colspan="2" align="right"><?php echo tep_image_button('button_login.gif', IMAGE_BUTTON_LOGIN, 'id="loginWindowSubmit"');?></td>
 </tr>
</table></div>
<div id="addressBook" title="Address Book test" style="display:none"></div>
<div id="newAddress" title="New Address test" style="display:none"></div>
<?php
if(ONEPAGE_CHECKOUT_LOADER_POPUP == 'True')
{?>
<div id="ajaxMessages" style="display:none;"></div>
<?php
}?>
<!-- dialogs_eof//-->
