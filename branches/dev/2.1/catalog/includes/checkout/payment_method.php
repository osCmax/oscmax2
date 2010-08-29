<table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  $selection = $payment_modules->selection();
  // *** BEGIN GOOGLE CHECKOUT ***
  // Skips Google Checkout as a payment option on the payments page since that option
  // is provided in the checkout page.
  for ($i = 0, $n = sizeof($selection); $i < $n; $i++) {
    if ($selection[$i]['id'] == 'googlecheckout') {
      array_splice($selection, $i, 1);
      break;
    }
  }
  // *** END GOOGLE CHECKOUT ***
  for ($i = 0, $n = sizeof($selection); $i < $n; $i++) {
    if ($selection[$i]['id'] == 'ccerr') {
      array_splice($selection, $i, 1);
      break;
    }
  }
  
  $paymentMethod = '';
  if (tep_session_is_registered('onepage')){
	  $paymentMethod = $onepage['info']['payment_method'];
  }

  if ($paymentMethod == ''){
	$paymentMethod = ONEPAGE_DEFAULT_PAYMENT;
  }

  if (sizeof($selection) > 1) {
?>
 <tr>
  <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
  <td class="main" width="50%" valign="top"><?php echo TEXT_SELECT_PAYMENT_METHOD; ?></td>
  <td class="main" width="50%" valign="top" align="right"></td>
  <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
 </tr>
<?php
  } else {
?>
 <tr>
  <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
  <td class="main" width="100%" colspan="2"><?php echo TEXT_ENTER_PAYMENT_INFORMATION; ?></td>
  <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
 </tr>
<?php
  }

  $radio_buttons = 0;
  for ($i=0, $n=sizeof($selection); $i<$n; $i++) {
?>
 <tr>
  <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
  <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
   <tr class="moduleRow paymentRow<?php echo ($selection[$i]['id'] == $paymentMethod ? ' moduleRowSelected' : '');?>">
	<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
	<td class="main" width="10"><?php
	 if (sizeof($selection) > 1) {
		 echo tep_draw_radio_field('payment', $selection[$i]['id'], ($selection[$i]['id'] == $paymentMethod));
	 } else {
		 echo tep_draw_hidden_field('payment', $selection[$i]['id']);
	 }
	?></td>
	<td class="main" width="100%"><b><?php echo $selection[$i]['module']; ?></b></td>
	<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
   </tr>
<?php
	if (isset($selection[$i]['error'])) {
?>
   <tr>
	<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
	<td class="main" colspan="2"><?php echo $selection[$i]['error']; ?></td>
	<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
   </tr>
<?php
	} elseif (isset($selection[$i]['fields']) && is_array($selection[$i]['fields']) && ($selection[$i]['id'] == $paymentMethod)) {
?>
   <tr>
	<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
	<td colspan="2"><table border="0" cellspacing="0" cellpadding="2" class="paymentFields" width="100%">
<?php
	  for ($j=0, $n2=sizeof($selection[$i]['fields']); $j<$n2; $j++) {
?>
	 <tr>
	  <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
	  <td class="main"><?php echo $selection[$i]['fields'][$j]['title']; ?></td>
	  <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
	  <td class="main"><?php echo $selection[$i]['fields'][$j]['field']; ?></td>
	  <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
	 </tr>
<?php
	  }
?>
	</table></td>
	<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
   </tr>
<?php
	}
?>
  </table></td>
  <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
 </tr>
<?php
	$radio_buttons++;
  }

  // Start - CREDIT CLASS Gift Voucher Contribution
  if(MODULE_ORDER_TOTAL_COUPON_STATUS == 'true')
  if (tep_session_is_registered('customer_id')) {
	  $gv_query = tep_db_query("select amount from " . TABLE_COUPON_GV_CUSTOMER . " where customer_id = '" . $customer_id . "'");
  	$gv_result = tep_db_fetch_array($gv_query);
    if ($gv_result['amount']>0){
  		echo '              <tr><td width="10">' .  tep_draw_separator('pixel_trans.gif', '10', '1') .'</td><td colspan=2>' . "\n" .
  			 '              <table border="0" cellpadding="2" cellspacing="0" width="100%"><tr class="moduleRow" onclick="clearRadeos()">' . "\n" .
  			 '              <td width="10">' .  tep_draw_separator('pixel_trans.gif', '10', '1') .'</td><td class="main">' . $gv_result['text'];

  		echo $order_total_modules->sub_credit_selection();
  	}
  }
// End - CREDIT CLASS Gift Voucher Contribution

if (is_array($buysafe_result) && $buysafe_result['IsBuySafeEnabled'] == 'true')
  {?>
    <tr><td colspan="4"><table>
    <?php
    $buysafe_module->draw_payment_page();
    ?>
    </td></tr></table>
   <?php
  }
//BOF Points/Rewards
  if ((USE_POINTS_SYSTEM == 'true') && (USE_REDEEM_SYSTEM == 'true')) {
    echo "<tr><td colspan=\"4\"><table>";
	  echo points_selection();
	  if (tep_not_null(USE_REFERRAL_SYSTEM) && (tep_count_customer_orders() == 0)) {
		  echo referral_input();
	  }
    echo "</table></td></tr>";
  }
//EOF Points/Rewards
?>
</table>