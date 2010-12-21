<?php
/*
$Id: checkout_confirmation.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');
/* One Page Checkout - BEGIN */
  if (ONEPAGE_CHECKOUT_ENABLED == 'True'){
      tep_redirect(tep_href_link(FILENAME_CHECKOUT, $_SERVER['QUERY_STRING'], 'SSL'));

  }
/* One Page Checkout - END */

// if the customer is not logged on, redirect them to the login page
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot(array('mode' => 'SSL', 'page' => FILENAME_CHECKOUT_PAYMENT));
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($cart->count_contents() < 1) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }

// avoid hack attempts during the checkout procedure by checking the internal cartID
  if (isset($cart->cartID) && tep_session_is_registered('cartID')) {
    if ($cart->cartID != $cartID) {
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
  }

// if no shipping method has been selected, redirect the customer to the shipping method selection page
  if (!tep_session_is_registered('shipping')) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }

  if (!tep_session_is_registered('payment')) tep_session_register('payment');
  if (isset($_POST['payment'])) $payment = $_POST['payment'];

  if (!tep_session_is_registered('comments')) tep_session_register('comments');
  if (tep_not_null($_POST['comments'])) {
    $comments = tep_db_prepare_input($_POST['comments']);
  }

// load the selected payment module
  require(DIR_WS_CLASSES . 'payment.php');
// Start - CREDIT CLASS Gift Voucher Contribution
  if ($credit_covers) $payment='credit_covers';
  require(DIR_WS_CLASSES . 'order_total.php');
// End - CREDIT CLASS Gift Voucher Contribution
  $payment_modules = new payment($payment);

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;

  $payment_modules->update_status();

// Start - CREDIT CLASS Gift Voucher Contribution
  $order_total_modules = new order_total;
  $order_total_modules->collect_posts();
  $order_total_modules->pre_confirmation_check();

// >>> FOR ERROR gv_redeem_code NULL
if (isset($_POST['gv_redeem_code']) && ($_POST['gv_redeem_code'] == null)) {tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));}
// <<< end for error

//  if ( ( is_array($payment_modules->modules) && (sizeof($payment_modules->modules) > 1) && !is_object($$payment) ) || (is_object($$payment) && ($$payment->enabled == false)) ) {
  if ( (is_array($payment_modules->modules)) && (sizeof($payment_modules->modules) > 1) && (!is_object($$payment)) && (!$credit_covers) ) {
// End - CREDIT CLASS Gift Voucher Contribution

    tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(ERROR_NO_PAYMENT_MODULE_SELECTED), 'SSL'));
  }

  if (is_array($payment_modules->modules)) {
    $payment_modules->pre_confirmation_check();
  }

// load the selected shipping module
  require(DIR_WS_CLASSES . 'shipping.php');
  $shipping_modules = new shipping($shipping);

// Start - CREDIT CLASS Gift Voucher Contribution
//  require(DIR_WS_CLASSES . 'order_total.php');
//  $order_total_modules = new order_total;
// End - CREDIT CLASS Gift Voucher Contribution

  $order_total_modules->process();
// Stock Check
  $any_out_of_stock = false;
  if (STOCK_CHECK == 'true') {
// BOF: MOD - QT Pro
//    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
//      if (tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty'])) {
    $check_stock='';
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      if (isset($order->products[$i]['attributes']) && is_array($order->products[$i]['attributes'])) {
        $attributes=array();
        foreach ($order->products[$i]['attributes'] as $attribute) {
          $attributes[$attribute['option_id']]=$attribute['value_id'];
        }
        $check_stock[$i] = tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty'], $attributes);
      } else {
        $check_stock[$i] = tep_check_stock($order->products[$i]['id'], $order->products[$i]['qty']);
      }
      if ($check_stock[$i]) {
// EOF: MOD - QT Pro
        $any_out_of_stock = true;
      }
    }
    // Out of Stock
    if ( (STOCK_ALLOW_CHECKOUT != 'true') && ($any_out_of_stock == true) ) {
      tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
    }
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_CONFIRMATION);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2);

  $content = CONTENT_CHECKOUT_CONFIRMATION;

  include (bts_select('main')); // BTSv1.5


  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>