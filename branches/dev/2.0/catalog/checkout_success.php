<?php
/*
$Id: checkout_success.php 3 2006-05-27 04:59:07Z user $

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

// if the customer is not logged on, redirect them to the shopping cart page
  if (!tep_session_is_registered('customer_id')) {
    tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
  }

  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'update')) {
    $notify_string = '';

    if (isset($HTTP_POST_VARS['notify']) && !empty($HTTP_POST_VARS['notify'])) {
      $notify = $HTTP_POST_VARS['notify'];

      if (!is_array($notify)) {
        $notify = array($notify);
      }

      for ($i=0, $n=sizeof($notify); $i<$n; $i++) {
        if (is_numeric($notify[$i])) {
          $notify_string .= 'notify[]=' . $notify[$i] . '&';
        }
      }
    }

// BOF:
//    tep_redirect(tep_href_link(FILENAME_DEFAULT, $notify_string));
// Added a check for a Guest checkout and cleared the session - 030411 
    if (tep_session_is_registered('noaccount')) { 
      tep_session_destroy(); 
      tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'NONSSL')); 
    } else { 
      tep_redirect(tep_href_link(FILENAME_DEFAULT, $notify_string, 'SSL')); 
    }
// EOF:
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CHECKOUT_SUCCESS);

  $breadcrumb->add(NAVBAR_TITLE_1);
//  $breadcrumb->add(NAVBAR_TITLE_2);  //Removed for PWA 0.8

  $global_query = tep_db_query("select global_product_notifications from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customer_id . "'");
  $global = tep_db_fetch_array($global_query);

  if ($global['global_product_notifications'] != '1') {
    $orders_query = tep_db_query("select orders_id from " . TABLE_ORDERS . " where customers_id = '" . (int)$customer_id . "' order by date_purchased desc limit 1");
    $orders = tep_db_fetch_array($orders_query);

    $products_array = array();
    $products_query = tep_db_query("select products_id, products_name from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$orders['orders_id'] . "' order by products_name");
    while ($products = tep_db_fetch_array($products_query)) {
      $products_array[] = array('id' => $products['products_id'],
                                'text' => $products['products_name']);
    }
  }

// BOF: MOD - PWA:  Added a check for a Guest checkout and cleared the session - 030411 v0.71
if (tep_session_is_registered('noaccount')) {
 $order_update = array('purchased_without_account' => '1');
 tep_db_perform(TABLE_ORDERS, $order_update, 'update', "orders_id = '".$orders['orders_id']."'");
//  tep_db_query("insert into " . TABLE_ORDERS . " (purchased_without_account) values ('1') where orders_id = '" . (int)$orders['orders_id'] . "'");
 tep_db_query("delete from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . tep_db_input($customer_id) . "'");
 tep_db_query("delete from " . TABLE_CUSTOMERS . " where customers_id = '" . tep_db_input($customer_id) . "'");
 tep_db_query("delete from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . tep_db_input($customer_id) . "'");
 tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . tep_db_input($customer_id) . "'");
 tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . tep_db_input($customer_id) . "'");
 tep_db_query("delete from " . TABLE_WHOS_ONLINE . " where customer_id = '" . tep_db_input($customer_id) . "'");
 tep_session_destroy();

// BOF: Bugfix 0000062
// OK, so this was a PWA, so lets check for other MIA PWA accounts, and clear them as well!!
  $old_customers_query = tep_db_query("select c.customers_id, c.purchased_without_account as pwa, ci.customers_info_date_account_created as date from " . TABLE_CUSTOMERS_INFO . " ci left join " . TABLE_CUSTOMERS . " c on ci.customers_info_id = c.customers_id");
  while ($old_customer = tep_db_fetch_array($old_customers_query)) {
//the second and third part of this if statement should be moved into the mysql select as a where clause...
    if ((!tep_session_is_registered($old_customer['customers_id'])) && //dont't want to delete PWA accounts with registered sessions...
        ((strtotime($old_customer['date']) + (60*60)) < time()) && //make sure the MIA PWA account is at least an hour old (is this old enough? ...its worked well for me so far... a session is 24 minutes, so I figure its safe)
        ($old_customer['pwa'] == 1) ) { //Oh, and make sure it IS a PWA...
//Then delete it like we did above... might be able to compact this code, but...
      tep_db_query("delete from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . $old_customer['customers_id'] . "'");
      tep_db_query("delete from " . TABLE_CUSTOMERS . " where customers_id = '" . $old_customer['customers_id'] . "'");
      tep_db_query("delete from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . $old_customer['customers_id'] . "'");
      tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where customers_id = '" . $old_customer['customers_id'] . "'");
      tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where customers_id = '" . $old_customer['customers_id'] . "'");
      tep_db_query("delete from " . TABLE_WHOS_ONLINE . " where customer_id = '" . $old_customer['customers_id'] . "'");
    }
  }
// EOF: Bugfix 0000062
}
// EOF: MOD - PWA:  Added a check for a Guest checkout and cleared the session - 030411 v0.71

  $content = CONTENT_CHECKOUT_SUCCESS;

  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>