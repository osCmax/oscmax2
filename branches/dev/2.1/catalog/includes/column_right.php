<?php
/*
$Id: column_right.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com
  adapted for Separate Pricing Per Customer v4.2.x, Hide products and categories from groups 2008/08/05

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/
// BOF: MOD - INFO BOXES - now pulled dynamically as per setting in admin 
/*
  require(DIR_WS_BOXES . 'loginbox.php');
  include(DIR_WS_BOXES . 'wishlist.php');

  require(DIR_WS_BOXES . 'shopping_cart.php');
// BOF: Wish List 2.3 Start
  if (tep_session_is_registered('customer_id')) include(DIR_WS_BOXES .'wishlist.php');
// EOF: Wish List 2.3 End

//  if (isset($HTTP_GET_VARS['products_id'])) include(DIR_WS_BOXES . 'manufacturer_info.php');
// 
//   if (tep_session_is_registered('customer_id')) include(DIR_WS_BOXES . 'order_history.php');
// 
//   if (isset($HTTP_GET_VARS['products_id'])) {
//     if (tep_session_is_registered('customer_id')) {
//       $check_query = tep_db_query("select count(*) as count from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customer_id . "' and global_product_notifications = '1'");
//       $check = tep_db_fetch_array($check_query);
//       if ($check['count'] > 0) {
//         include(DIR_WS_BOXES . 'best_sellers.php');
//       } else {
//         include(DIR_WS_BOXES . 'product_notifications.php');
//       }
//     } else {
//       include(DIR_WS_BOXES . 'product_notifications.php');
//     }
//   } else {
//     include(DIR_WS_BOXES . 'best_sellers.php');
//   }
// 
//   if (isset($HTTP_GET_VARS['products_id'])) {
//     if (basename($PHP_SELF) != FILENAME_TELL_A_FRIEND) include(DIR_WS_BOXES . 'tell_a_friend.php');
//   } else {
//     include(DIR_WS_BOXES . 'specials.php');
//   }
// 
//   require(DIR_WS_BOXES . 'reviews.php');
// BOF Separate Pricing Per Customer v4.2, Hide products and categories from groups

  if (isset($_SESSION['sppc_customer_group_id']) && $_SESSION['sppc_customer_group_id'] != '0') {
  $customer_group_id = $_SESSION['sppc_customer_group_id'];
  } else {
   $customer_group_id = '0';
  }  
  global $hide_product; // is determined in product_info.php
// on other pages we'll check it with a query
   if (!isset($hide_product) && isset($HTTP_GET_VARS['products_id'])) {
      $hide_product = tep_get_hide_status_single($customer_group_id, (int)$HTTP_GET_VARS['products_id']);
   }

  if (isset($HTTP_GET_VARS['products_id']) && $hide_product == false) include(DIR_WS_BOXES . 'manufacturer_info.php');

  if (tep_session_is_registered('customer_id') && (! tep_session_is_registered('customer_is_guest')) ) include(DIR_WS_BOXES . 'order_history.php');

  if (isset($HTTP_GET_VARS['products_id'])) {
    if (tep_session_is_registered('customer_id')) {
     $check_query = tep_db_query("select count(*) as count from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customer_id . "' and global_product_notifications = '1'");
      $check = tep_db_fetch_array($check_query);
     if ($check['count'] > 0) {
        include(DIR_WS_BOXES . 'best_sellers.php');
     } else {
        (($hide_product == false )? include(DIR_WS_BOXES . 'product_notifications.php') : '');
     }
    } else {
      (($hide_product == false)? include(DIR_WS_BOXES . 'product_notifications.php') : '');
    }
  } else { 
   include(DIR_WS_BOXES . 'best_sellers.php');
  }

  if (isset($HTTP_GET_VARS['products_id'])) {
    if (basename($PHP_SELF) != FILENAME_TELL_A_FRIEND && $hide_product == false) { include(DIR_WS_BOXES . 'tell_a_friend.php');
  } // end if (basename($PHP_SELF) != FILENAME_TELL_A_FRIEND && $hide_product == false)
  } else {
    include(DIR_WS_BOXES . 'specials.php');
  } // end if (isset($HTTP_GET_VARS['products_id']))

  if ($hide_product == false) {
  require(DIR_WS_BOXES . 'reviews.php');
  }
// EOF Separate Pricing Per Customer v4.2, Hide products and categories from groups

// BOF: MOD - Article Manager
  require(DIR_WS_BOXES . 'authors.php');
  require(DIR_WS_BOXES . 'articles.php');

  if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
    include(DIR_WS_BOXES . 'languages.php');
    include(DIR_WS_BOXES . 'currencies.php');
  }
// BOF: MOD - INFO BOXES - now pulled dynamically as per setting in admin 
*/

  $column_query = tep_db_query('select configuration_column as cfgcol, configuration_title as cfgtitle, configuration_value as cfgvalue, configuration_key as cfgkey, box_heading from ' . TABLE_THEME_CONFIGURATION . ' order by location');
  while ($column = tep_db_fetch_array($column_query)) {

    $column['cfgtitle'] = str_replace(' ', '_', $column['cfgtitle']);
    $column['cfgtitle'] = str_replace("'", '', $column['cfgtitle']);

    if ( ($column['cfgvalue'] == 'yes') && ($column['cfgcol'] == 'right')) {

      //define($column['cfgkey'],$column['box_heading']);

      if ( file_exists(DIR_WS_BOXES . $column['cfgtitle'] . '.php') ) {
        require(DIR_WS_BOXES . $column['cfgtitle'] . '.php');
      } 
    }
  }
// EOF: MOD - INFO BOXES - now pulled dynamically as per setting in admin 
?>