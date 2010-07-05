<?php
/*
  $Id: checkout_shipping.php 1739 2007-12-20 00:52:16Z hpdl $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/
// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)
  //define('CHARSET', 'UTF-8');

  require('includes/application_top.php');
  require('includes/classes/http_client.php');

  if (ONEPAGE_LOGIN_REQUIRED == 'true'){
	  if (!tep_session_is_registered('customer_id')){
		  $navigation->set_snapshot(array('mode' => 'SSL', 'page' => FILENAME_CHECKOUT));
		  tep_redirect(tep_href_link(FILENAME_LOGIN));
	  }
  }
  

  if (isset($_GET['rType'])){
	  //header('content-type: text/html; charset=' . CHARSET);
  }

  //if(isset($_REQUEST['gv_redeem_code']) && tep_not_null($_REQUEST['gv_redeem_code']) && $_REQUEST['gv_redeem_code'] == 'redeem code'){
  if(isset($_REQUEST['gv_redeem_code']) && tep_not_null($_REQUEST['gv_redeem_code'])){
    $_REQUEST['gv_redeem_code'] = '';
    $_POST['gv_redeem_code'] = '';
  }


  if(isset($_REQUEST['coupon']) && tep_not_null($_REQUEST['coupon']) && $_REQUEST['coupon'] == 'redeem code'){
    $_REQUEST['coupon'] = '';
    $_POST['coupon'] = '';
  }

  require('includes/classes/onepage_checkout.php');
  $onePageCheckout = new osC_onePageCheckout();

  if (!isset($_GET['rType']) && !isset($_GET['action']) && !isset($_POST['action']) && !isset($_GET['error_message']) && !isset($_GET['payment_error'])){
	  $onePageCheckout->init();
  }
  //BOF KGT
  if (MODULE_ORDER_TOTAL_DISCOUNT_COUPON_STATUS == 'true'){
    if(isset($_POST['code']))
    {
      if(!tep_session_is_registered('coupon'))
        tep_session_register('coupon');
      $coupon = $_POST['code'];
    }
  }
  //EOF KGT
  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;

  $onePageCheckout->loadSessionVars();
  $onePageCheckout->fixTaxes();

//  print_r($order);
// register a random ID in the session to check throughout the checkout procedure
// against alterations in the shopping cart contents
  if (!tep_session_is_registered('cartID')) tep_session_register('cartID');
  $cartID = $cart->cartID;

// if the order contains only virtual products, forward the customer to the billing page as
// a shipping address is not needed

  if (!isset($_GET['action']) && !isset($_POST['action'])){
	  // Start - CREDIT CLASS Gift Voucher Contribution
	  //  if ($order->content_type == 'virtual') {
	  if ($order->content_type == 'virtual' || $order->content_type == 'virtual_weight' ) {
		  // End - CREDIT CLASS Gift Voucher Contribution
		  $shipping = false;
		  $sendto = false;
	  }
  }

  $total_weight = $cart->show_weight();
  $total_count = $cart->count_contents();
  if (method_exists($cart, 'count_contents_virtual')){
	  // Start - CREDIT CLASS Gift Voucher Contribution
	  $total_count = $cart->count_contents_virtual();
	  // End - CREDIT CLASS Gift Voucher Contribution
  }

// load all enabled shipping modules
  require(DIR_WS_CLASSES . 'shipping.php');
  $shipping_modules = new shipping;

// load all enabled payment modules
  require(DIR_WS_CLASSES . 'payment.php');
  $payment_modules = new payment;

  require(DIR_WS_CLASSES . 'order_total.php');
  $order_total_modules = new order_total;
  $order_total_modules->process();

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT);

  $action = (isset($_POST['action']) ? $_POST['action'] : '');
  if (isset($_POST['updateQuantities_x'])){
	  $action = 'updateQuantities';
  }
  if (isset($_GET['action']) && $_GET['action']=='process_confirm'){
	  $action = 'process_confirm';
  }
  if (tep_not_null($action)){
	  ob_start();
	  if(isset($_POST) && is_array($_POST))
			$onePageCheckout->decode_post_vars();
	  switch($action){
		  case 'process_confirm':
        echo $onePageCheckout->confirmCheckout();
      break;
      case 'process':
			  echo $onePageCheckout->processCheckout();
		  break;
		  case 'countrySelect':
			  echo $onePageCheckout->getAjaxStateField();
		  break;
 		  case 'countrySelect_edit':
			  echo $onePageCheckout->getAjaxStateFieldEdit();
		  break;

		  case 'processLogin':
			  echo $onePageCheckout->processAjaxLogin($_POST['email'], $_POST['pass']);
		  break;
		  case 'removeProduct':
			  echo $onePageCheckout->removeProductFromCart($_POST['pID']);
		  break;
		  case 'updateQuantities':
			  echo $onePageCheckout->updateCartProducts($_POST['qty'], $_POST['id']);
		  break;
		  case 'setPaymentMethod':
			  echo $onePageCheckout->setPaymentMethod($_POST['method']);
		  break;
		  case 'setGV':
			  echo $onePageCheckout->setGiftVoucher($_POST['method']);
		  break;
		  case 'updatePayment':
				echo $onePageCheckout->updatePayment();
			break;
		  case 'redeemPoints':
			  echo $onePageCheckout->redeemPoints($_POST['points']);
		  break;
		  case 'clearPoints':
			  echo $onePageCheckout->clearPoints();
		  break;
		  case 'setShippingMethod':
			  echo $onePageCheckout->setShippingMethod($_POST['method']);
		  break;
		  case 'setSendTo':
		  case 'setBillTo':
			  echo $onePageCheckout->setCheckoutAddress($action);
		  break;
		  case 'checkEmailAddress':
			  echo $onePageCheckout->checkEmailAddress($_POST['emailAddress']);
		  break;
		  case 'saveAddress':
		  case 'addNewAddress':
			  echo $onePageCheckout->saveAddress($action);
		  break;
		  case 'selectAddress':
			  echo $onePageCheckout->setAddress($_POST['address_type'], $_POST['address']);
		  break;
		  case 'redeemVoucher':
			  echo $onePageCheckout->redeemCoupon($_POST['code']);
		  break;
		  case 'setMembershipPlan':
			  echo $onePageCheckout->setMembershipPlan($_POST['planID']);
		  break;
		  case 'updateCartView':
			  if ($cart->count_contents() == 0){
				  echo 'none';
			  }else{
				  include(DIR_WS_INCLUDES . 'checkout/cart.php');
			  }
		  break;
		  case 'updateShippingMethods':
			  include(DIR_WS_INCLUDES . 'checkout/shipping_method.php');
		  break;
		  case 'updatePaymentMethods':
			 // include(DIR_WS_INCLUDES . 'checkout/payment_method.php');
		  break;
		  case 'getOrderTotals':
			  if (MODULE_ORDER_TOTAL_INSTALLED){
				  echo '<table cellpadding="2" cellspacing="0" border="0">' .
					   $order_total_modules->output() .
					   '</table>';
			  }
		  break;
		  case 'getProductsFinal':
			  include(DIR_WS_INCLUDES . 'checkout/products_final.php');
		  break;
		  case 'getNewAddressForm':
		  case 'getAddressBook':
			  $addresses_count = tep_count_customer_address_book_entries();
			  if ($action == 'getAddressBook'){
				  $addressType = $_POST['addressType'];
				  include(DIR_WS_INCLUDES . 'checkout/address_book.php');
			  }else{
				  include(DIR_WS_INCLUDES . 'checkout/new_address.php');
			  }
		  break;
		  case 'getEditAddressForm':
			  $aID = tep_db_prepare_input($_POST['addressID']);
			  $Qaddress = tep_db_query('select * from ' . TABLE_ADDRESS_BOOK . ' where customers_id = "' . $customer_id . '" and address_book_id = "' . $aID . '"');
			  $address = tep_db_fetch_array($Qaddress);
			  
			  include(DIR_WS_INCLUDES . 'checkout/edit_address.php');
		  break;
		  case 'getBillingAddress':
			  include(DIR_WS_INCLUDES . 'checkout/billing_address.php');
		  break;
		  case 'getShippingAddress':
			  include(DIR_WS_INCLUDES . 'checkout/shipping_address.php');
		  break;
	  }

	  $content = ob_get_contents();
	  ob_end_clean();
	  if($action=='process')
      echo $content;
    else
      echo utf8_encode($content);
	  tep_session_close();
	  tep_exit();
  }
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_CHECKOUT, '', $request_type));

  function buildInfobox($header, $contents){
	  global $action;
		$info_box_contents = array();
	  if(isset($action) && tep_not_null($action))
			$info_box_contents[] = array('text' => utf8_encode($header));
	  else
			$info_box_contents[] = array('text' => ($header));
	  new infoBoxHeading($info_box_contents, false, false);

	  $info_box_contents = array();

		if(isset($action) && tep_not_null($action))
			$info_box_contents[] = array('text' => utf8_encode($contents));
		else
			$info_box_contents[] = array('text' => ($contents));
	  new infoBox($info_box_contents);
  }

  function fixSeoLink($url){
	  return str_replace('&amp;', '&', $url);
  }
  



  $content = CONTENT_ONE_PAGE_CHECKOUT;
  $javascript = $content . '.js.php';


  include (bts_select('main', $content_template)); // BTSv1.5
require(DIR_WS_INCLUDES . 'application_bottom.php');
?>