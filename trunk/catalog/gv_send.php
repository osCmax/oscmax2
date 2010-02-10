<?php
/*
$Id: gv_send.php 14 2006-07-28 17:42:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Gift Voucher System v1.0
  Copyright 2006 osCMax2001, 2002 Ian C Wilson
  http://www.phesis.org

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');

  require('includes/classes/http_client.php');

// if the customer is not logged on, redirect them to the login page
  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_GV_SEND);

  if (($HTTP_POST_VARS['back_x']) || ($HTTP_POST_VARS['back_y'])) {
    $HTTP_GET_VARS['action'] = '';
  }
  if ($HTTP_GET_VARS['action'] == 'send') {
    $error = false;
    if (!tep_validate_email(trim($HTTP_POST_VARS['email']))) {
      $error = true;
      $error_email = ERROR_ENTRY_EMAIL_ADDRESS_CHECK;
    }
    $gv_query = tep_db_query("select amount from " . TABLE_COUPON_GV_CUSTOMER . " where customer_id = '" . $customer_id . "'");
    $gv_result = tep_db_fetch_array($gv_query);
    $customer_amount = $gv_result['amount'];
    $gv_amount = trim($HTTP_POST_VARS['amount']);
    if (ereg('[^0-9/.]', $gv_amount)) {
      $error = true;
      $error_amount = ERROR_ENTRY_AMOUNT_CHECK; 
    }
    if ($gv_amount>$customer_amount || $gv_amount == 0) {
      $error = true; 
      $error_amount = ERROR_ENTRY_AMOUNT_CHECK; 
    } 
  }
  if ($HTTP_GET_VARS['action'] == 'process') {
    $id1 = create_coupon_code($mail['customers_email_address']);
    $gv_query = tep_db_query("select amount from " . TABLE_COUPON_GV_CUSTOMER . " where customer_id='".$customer_id."'");
    $gv_result=tep_db_fetch_array($gv_query);
    $new_amount=$gv_result['amount']-$HTTP_POST_VARS['amount'];
    if ($new_amount<0) {
      $error= true;
      $error_amount = ERROR_ENTRY_AMOUNT_CHECK; 
      $HTTP_GET_VARS['action'] = 'send';
    } else {
      $gv_query=tep_db_query("update " . TABLE_COUPON_GV_CUSTOMER . " set amount = '" . $new_amount . "' where customer_id = '" . $customer_id . "'");
      $gv_query=tep_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . $customer_id . "'");
      $gv_customer=tep_db_fetch_array($gv_query);
      $gv_query=tep_db_query("insert into " . TABLE_COUPONS . " (coupon_type, coupon_code, date_created, coupon_amount) values ('G', '" . $id1 . "', NOW(), '" . $HTTP_POST_VARS['amount'] . "')");
      $insert_id = tep_db_insert_id($gv_query);
      $gv_query=tep_db_query("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, sent_lastname, emailed_to, date_sent) values ('" . $insert_id . "' ,'" . $customer_id . "', '" . addslashes($gv_customer['customers_firstname']) . "', '" . addslashes($gv_customer['customers_lastname']) . "', '" . $HTTP_POST_VARS['email'] . "', now())");

      $gv_email = STORE_NAME . "\n" .
              EMAIL_SEPARATOR . "\n" .
              sprintf(EMAIL_GV_TEXT_HEADER, $currencies->format($HTTP_POST_VARS['amount'])) . "\n" .
              EMAIL_SEPARATOR . "\n" . 
              sprintf(EMAIL_GV_FROM, stripslashes($HTTP_POST_VARS['send_name'])) . "\n";
      if (isset($HTTP_POST_VARS['message'])) {
        $gv_email .= EMAIL_GV_MESSAGE . "\n";
        if (isset($HTTP_POST_VARS['to_name'])) {
          $gv_email .= sprintf(EMAIL_GV_SEND_TO, stripslashes($HTTP_POST_VARS['to_name'])) . "\n\n";
        }
        $gv_email .= stripslashes($HTTP_POST_VARS['message']) . "\n\n";
      } 
      $gv_email .= sprintf(EMAIL_GV_REDEEM, $id1) . "\n\n";
      $gv_email .= EMAIL_GV_LINK . ' ' . "<a HREF='" . 
// ################# Added CGV
      tep_href_link(FILENAME_GV_REDEEM, 'gv_no=' . $id1,'NONSSL',false) . "'>" . tep_href_link(FILENAME_GV_REDEEM, 'gv_no=' .       $id1,'NONSSL',false) . "</a>\n" ;
// ################# End Added CGV
      $gv_email .= "\n\n";  
      $gv_email .= EMAIL_GV_FIXED_FOOTER . "\n\n";
      $gv_email .= EMAIL_GV_SHOP_FOOTER . "\n\n";;
      $gv_email_subject = sprintf(EMAIL_GV_TEXT_SUBJECT, stripslashes($HTTP_POST_VARS['send_name']));             
      tep_mail('', $HTTP_POST_VARS['email'], $gv_email_subject, nl2br($gv_email), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, '');
    }
  }
  $breadcrumb->add(NAVBAR_TITLE);

  $content = CONTENT_GV_SEND;

  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php'); 
  ?>