<?php
/*
$Id: account_history_info.php 3 2006-05-27 04:59:07Z user $

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

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// BEGIN Customer Comments contrib section 1
	if (isset($_GET['action']) && ($_GET['action'] == 'update_order') ) {
       $oID = tep_db_prepare_input($_GET['order_id']);
       $comments = tep_db_prepare_input($_POST['comments']);

// verify that customer is the same one associated with this order
       $customer_check = tep_db_fetch_array(tep_db_query("select customers_id from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'"));
       if(tep_not_null($comments) && ($customer_check['customers_id'] == $customer_id))
       {
        $order_updated = false;
		$check_status_query = tep_db_query("select o.customers_name, o.customers_email_address, o.orders_status, o.date_purchased, os.downloads_flag  from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_STATUS . " os where o.orders_id = '" . (int)$oID . "' and o.orders_status = os.orders_status_id and os.language_id = 1");
        $check_status = tep_db_fetch_array($check_status_query);

// update the order status in the database
        if (($check_status['orders_status'] != CUSTOMER_COMMENTS_NEW_STATUS) || tep_not_null($comments)) {

// BOF: PGM EDIT TO PASS THROUGH DOWNLOAD FLAG
			if ($check_status['downloads_flag'] == 1) {
			// PASS THROUGH DOWNLOADS OKAY (1)
          		tep_db_query("update " . TABLE_ORDERS . " set orders_status = '" . CUSTOMER_COMMENTS_NEW_STATUS_DL . "', last_modified = now() where orders_id = '" . (int)$oID . "'");

// update the order comments in the database
          		tep_db_query("insert into " . TABLE_ORDERS_STATUS_HISTORY . " (orders_id, orders_status_id, date_added, customer_notified, comments) values ('" . (int)$oID . "', '" . CUSTOMER_COMMENTS_NEW_STATUS_DL . "', now(), '" . tep_db_input($customer_notified) . "', '" . tep_db_input($comments)  . "')");

          		$order_updated = true;
        	} else {
			// PASS THROUGH DOWNLOADS NOT OKAY (0)
          		tep_db_query("update " . TABLE_ORDERS . " set orders_status = '" . CUSTOMER_COMMENTS_NEW_STATUS . "', last_modified = now() where orders_id = '" . (int)$oID . "'");

// update the order comments in the database
          		tep_db_query("insert into " . TABLE_ORDERS_STATUS_HISTORY . " (orders_id, orders_status_id, date_added, customer_notified, comments) values ('" . (int)$oID . "', '" . CUSTOMER_COMMENTS_NEW_STATUS . "', now(), '" . tep_db_input($customer_notified) . "', '" . tep_db_input($comments)  . "')");

          		$order_updated = true;
			}
	   }

// EOF: PGM EDIT TO PASS THROUGH DOWNLOAD FLAG       
	   }

        if ($order_updated == true) {

// send notification email that customer has updated their order
          if ( (CUSTOMER_COMMENTS_NOTIFY == 'true') && ($_GET['action'] == 'update_order') ) {
	          tep_mail(STORE_OWNER, EMAIL_FROM, 'Order ' . $_GET['order_id'] . ' has been updated by the customer', 'Order ' . $_GET['order_id'] . ' has been updated by the customer as follows:<br>' . $comments, $check_status['customers_name'], $check_status['customers_email_address']);
          }

          tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, tep_get_all_get_params(array('action')) . 'action=updated'));
        } else {
          tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, tep_get_all_get_params(array('action')) . 'action=not_updated'));
        }
  }


  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'updated')) {
      $messageStack->add('header', SUCCESS_ORDER_UPDATED, 'success');
  }

  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'not_updated')) {
	  $messageStack->add('header', WARNING_ORDER_NOT_UPDATED, 'warning');
  }
// END Customer Comments contrib section 1

  if (!isset($_GET['order_id']) || (isset($_GET['order_id']) && !is_numeric($_GET['order_id']))) {
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
  }
  
  $customer_info_query = tep_db_query("select customers_id from " . TABLE_ORDERS . " where orders_id = '". (int)$_GET['order_id'] . "'");
  $customer_info = tep_db_fetch_array($customer_info_query);
  if ($customer_info['customers_id'] != $customer_id) {
    tep_redirect(tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_HISTORY_INFO);

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL'));
  $breadcrumb->add(sprintf(NAVBAR_TITLE_3, $_GET['order_id']), tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $_GET['order_id'], 'SSL'));

  require(DIR_WS_CLASSES . 'order.php');
  $order = new order($_GET['order_id']);

  $content = CONTENT_ACCOUNT_HISTORY_INFO;

  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
