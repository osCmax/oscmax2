<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

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
// BOF - MOD: CREDIT CLASS Gift Voucher Contribution
  if (tep_session_is_registered('cot_gv')) tep_session_unregister('cot_gv');
// EOF - MOD: CREDIT CLASS Gift Voucher Contribution

// if the customer is not logged on, redirect them to the login page
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// if there is nothing in the customers cart, redirect them to the shopping cart page
  if ($cart->count_contents() < 1) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }

// if no shipping method has been selected, redirect the customer to the shipping method selection page
  if (!tep_session_is_registered('shipping')) {
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }

// avoid hack attempts during the checkout procedure by checking the internal cartID
  if (isset($cart->cartID) && tep_session_is_registered('cartID')) {
    if ($cart->cartID != $cartID) {
      tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
    }
  }
// BOF - MOD: CREDIT CLASS Gift Voucher Contribution
// if we have been here before and are coming back get rid of the credit covers variable
  if(tep_session_is_registered('credit_covers')) tep_session_unregister('credit_covers');
  if(tep_session_is_registered('cot_gv')) tep_session_unregister('cot_gv');
// EOF - MOD: CREDIT CLASS Gift Voucher Contribution

// Stock Check
  if ( (STOCK_CHECK == 'true') && (STOCK_ALLOW_CHECKOUT != 'true') ) {
// BOF: MOD - QT Pro
//    $products = $cart->get_products();
//    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
//      if (tep_check_stock($products[$i]['id'], $products[$i]['quantity'])) {
//        tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
//        break;
//      }
    $products = $cart->get_products();
    $any_out_of_stock = 0;
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
     if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
       $stock_check = tep_check_stock($products[$i]['id'], $products[$i]['quantity'], $products[$i]['attributes']);
     }
     else{
       $stock_check = tep_check_stock($products[$i]['id'], $products[$i]['quantity']);
     }
     if ($stock_check) $any_out_of_stock = 1;
  	}
    if ($any_out_of_stock == 1) {
      tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
      break;
// EOF: MOD - QT Pro
    }
  }
/// Start - CREDIT CLASS Gift Voucher Contribution
// #################### THIS MOD IS OPTIONAL! ######################
// load the selected shipping module
 require(DIR_WS_CLASSES . 'shipping.php');
 $shipping_modules = new shipping($shipping);
// #################### THIS MOD WAS OPTIONAL! ######################
// End - CREDIT CLASS Gift Voucher Contribution

// if no billing destination address was selected, use the customers own address as default
  if (!tep_session_is_registered('billto')) {
    tep_session_register('billto');
    $billto = $customer_default_address_id;
  } else {
// verify the selected billing address
    if ( (is_array($billto) && empty($billto)) || is_numeric($billto) ) {
      $check_address_query = tep_db_query("select count(*) as total from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$customer_id . "' and address_book_id = '" . (int)$billto . "'");
      $check_address = tep_db_fetch_array($check_address_query);

      if ($check_address['total'] != '1') {
        $billto = $customer_default_address_id;
        if (tep_session_is_registered('payment')) tep_session_unregister('payment');
      }
    }
  }

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order;
// BOF - MOD: CREDIT CLASS Gift Voucher Contribution
  require(DIR_WS_CLASSES . 'order_total.php');
  $order_total_modules = new order_total;
  $order_total_modules->clear_posts();
// EOF - MOD: CREDIT CLASS Gift Voucher Contribution

  if (!tep_session_is_registered('comments')) tep_session_register('comments');
  if (isset($_POST['comments']) && tep_not_null($_POST['comments'])) {
    $comments = tep_db_prepare_input($_POST['comments']);
  }

  $total_weight = $cart->show_weight();
  $total_count = $cart->count_contents();
// LINE ADDED: MOD - CREDIT CLASS Gift Voucher Contribution
  $total_count = $cart->count_contents_virtual();

// load all enabled payment modules
  require(DIR_WS_CLASSES . 'payment.php');
  $payment_modules = new payment;

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_PAYMENT);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL'));

  $content = CONTENT_CHECKOUT_PAYMENT;

  $javascript = $content . '.js.php';

  include (bts_select('main')); // BTSv1.5


  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>