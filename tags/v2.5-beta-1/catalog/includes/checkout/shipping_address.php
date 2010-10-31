<div id="shippingAddress"><?php
 if (tep_session_is_registered('customer_id') && ONEPAGE_CHECKOUT_SHOW_ADDRESS_INPUT_FIELDS == 'False'){
	 if((int)$sendto<1)	 	$sendto = $billto;
	 echo tep_address_label($customer_id, $sendto, true, ' ', '<br>');
 }else{
	 if (tep_session_is_registered('onepage')){
		 $shippingAddress = $onepage['delivery'];
	 }
	 if(ONEPAGE_ADDR_LAYOUT == 'vertical') {
	   include(DIR_WS_INCLUDES.'checkout/shipping_address_vertical.php');
	 }else{
	   include(DIR_WS_INCLUDES.'checkout/shipping_address_horizontal.php');
	 }
 }
?></div>