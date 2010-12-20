<div id="billingAddress"><?php
 if (tep_session_is_registered('customer_id') && ONEPAGE_CHECKOUT_SHOW_ADDRESS_INPUT_FIELDS == 'False'){
	 echo tep_address_label($customer_id, $billto, true, ' ', '<br>');
 }else{
	 if (tep_session_is_registered('onepage')){
		 $billingAddress = $onepage['billing'];
		 $customerAddress = $onepage['customer'];
	 }
	 if(ONEPAGE_ADDR_LAYOUT == 'vertical') {
    include(DIR_WS_INCLUDES.'checkout/billing_address_vertical.php');
 }else
 {
   include(DIR_WS_INCLUDES.'checkout/billing_address_horizontal.php');
 }
 
}
?></div>