<div id="shippingAddress"><?php
 if (tep_session_is_registered('customer_id') && ONEPAGE_CHECKOUT_SHOW_ADDRESS_INPUT_FIELDS == 'False'){
	 if((int)$sendto<1)	 	$sendto = $billto;
	 echo tep_address_label($customer_id, $sendto, true, ' ', '<br>');
 }else{
	 if (tep_session_is_registered('onepage')){
		 $shippingAddress = $onepage['delivery'];
	 }
?>
<table border="0" width="" cellspacing="0" cellpadding="2">
 <tr>
  <td colspan="2"><table cellpadding="0" cellspacing="0" border="0" width="100%">
   <tr>
	<td class="main" width=""><?php echo ENTRY_FIRST_NAME; ?></td>
	<td class="main" width="120"><?php echo tep_draw_input_field('shipping_firstname', $shippingAddress['firstname'], 'class="required" style="width:100px;float:left;"'); ?></td>
	<td class="main" width=""><?php echo ENTRY_LAST_NAME; ?></td>
	<td class="main" width="120"><?php echo tep_draw_input_field('shipping_lastname', $shippingAddress['lastname'], 'class="required" style="width:100px;float:left;"'); ?></td>
   </tr>
  </table></td>
 </tr>
<?php
  if (ACCOUNT_COMPANY == 'true') {
?>
 <tr>
  <td class="main"><?php echo ENTRY_COMPANY; ?></td>
  <td class="main"><?php echo tep_draw_input_field('shipping_company', '', 'style="width:150px;float:left;"'); ?></td>
 </tr>
<?php
  }
?>
 <tr>
  <td class="main"><?php echo ENTRY_COUNTRY; ?></td>
  <td class="main"><?php echo tep_get_country_list('shipping_country', (isset($shippingAddress['country_id']) ? $shippingAddress['country_id'] : ONEPAGE_DEFAULT_COUNTRY), 'class="required" style="float:left;"'); ?></td>
 </tr>
 <tr>
  <td class="main"><?php echo ENTRY_STREET_ADDRESS; ?></td>
  <td class="main"><?php echo tep_draw_input_field('shipping_street_address', $shippingAddress['street_address'], 'class="required" style="width:150px;float:left;"'); ?></td>
 </tr>
<?php
  if (ACCOUNT_SUBURB == 'true') {
?>
 <tr>
  <td class="main"><?php echo ENTRY_SUBURB; ?></td>
  <td class="main"><?php echo tep_draw_input_field('shipping_suburb', $shippingAddress['suburb'], 'style="width:150px;float:left;"'); ?></td>
 </tr>
<?php
  }
?>
 <tr>
  <td colspan="2">
    
    
    
<?php if(ONEPAGE_ADDR_LAYOUT == 'vertical') {?>
    <table cellpadding="0" cellspacing="0" border="0" width="">
      <tr>
	      <td class="main" width="" nowrap><?php echo ENTRY_CITY; ?></td>
        <td class="main" width="100" nowrap><?php echo tep_draw_input_field('shipping_city', $shippingAddress['city'], 'class="required" style="width:80px;float:left;"'); ?></td>
<?php
  if (ACCOUNT_STATE == 'true') {
?>
        <td class="main" width=""><?php echo ENTRY_STATE; ?></td>
<?php
  }
?>
<?php
  if (ACCOUNT_STATE == 'true') {
	$defaultCountry = (isset($shippingAddress) && tep_not_null($shippingAddress['country_id']) ? $shippingAddress['country_id'] : ONEPAGE_DEFAULT_COUNTRY);
?>
        <td class="main" width="150" id="stateCol_delivery"><?php echo $onePageCheckout->getAjaxStateField($defaultCountry, 'delivery');?><div <?php if(tep_not_null($shippingAddress['zone_id']) || tep_not_null($shippingAddress['state'])){ ?>class= "success_icon ui-icon-green ui-icon-circle-check" <?php }else{?> class="required_icon ui-icon-red ui-icon-gear" <?php } ?> style="margin-left: 3px; margin-top: 1px; float: left;" title="Required" /></div></td>
<?php
  }
?>
<?php
if(ONEPAGE_ZIP_BELOW == 'False'){
?>
        <td class="main" width=""><?php echo ENTRY_POST_CODE; ?></td>
<?php
}
?>
<?php
if(ONEPAGE_ZIP_BELOW == 'False'){
?>
        <td class="main" width="100"><?php echo tep_draw_input_field('shipping_zipcode', $shippingAddress['postcode'], 'class="required" style="width:80px;float:left;"'); ?></td>
<?php
}
?>
      </tr>
  </table>
<?php } else { ?>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
   <tr>
  <td class="main" width="33%"><?php echo ENTRY_CITY; ?></td>
<?php
  if (ACCOUNT_STATE == 'true') {
?>
  <td class="main" width="33%"><?php echo ENTRY_STATE; ?></td>
<?php
  }
?>
<?php
if(ONEPAGE_ZIP_BELOW == 'False'){
?>
  <td class="main" width="33%"><?php echo ENTRY_POST_CODE; ?></td>
<?php
}
?>
   </tr>
   <tr>
  <td class="main" width="33%"><?php echo tep_draw_input_field('shipping_city', $shippingAddress['city'], 'class="required" style="width:80%;float:left;"'); ?></td>
<?php
  if (ACCOUNT_STATE == 'true') {
  $defaultCountry = (isset($shippingAddress) && tep_not_null($shippingAddress['country_id']) ? $shippingAddress['country_id'] : ONEPAGE_DEFAULT_COUNTRY);
?>
  <td class="main" width="33%" id="stateCol_delivery"><?php echo $onePageCheckout->getAjaxStateField($defaultCountry, 'delivery');?>
  <div <?php if(tep_not_null($shippingAddress['zone_id']) || tep_not_null($shippingAddress['state'])){ ?>class= "success_icon ui-icon-green ui-icon-circle-check" <?php }else{?> class="required_icon ui-icon-red ui-icon-gear" <?php } ?> style="margin-left: 3px; margin-top: 1px; float: left;" title="Required" /></div>
  </td>
<?php
  }
?>
<?php
if(ONEPAGE_ZIP_BELOW == 'False'){
?>
  <td class="main" width="33%"><?php echo tep_draw_input_field('shipping_zipcode', $shippingAddress['postcode'], 'class="required" style="width:80%;float:left;"'); ?></td>
<?php
}
?>
   </tr>
  </table>
<?php } ?>
  
  
  </td>
 </tr>
  <?php
if(ONEPAGE_ZIP_BELOW == 'True'){
?>
<tr>
  <td><table cellpadding="0" cellspacing="0" border="0" width="100%">
   <tr>
<td class="main" width="50%">&nbsp;</td>
<td class="main"  width="50%" ><span style="float:left;"><?php echo ENTRY_POST_CODE.'&nbsp;&nbsp;' ?></span>
<?php echo tep_draw_input_field('shipping_zipcode', $shippingAddress['postcode'], 'class="required" style="width:42%;float:left;"'); ?>
</td>
</tr>
</table>
</td>
</tr>
<?php
}
?>
 
</table><?php
 }
?></div>