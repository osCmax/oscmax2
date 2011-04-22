<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.


  if (isset($_GET['products_id'])) {
  	  if (tep_session_is_registered('customer_id')) {
  	        $check_query = tep_db_query("select count(*) as count from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customer_id . "' and global_product_notifications <> '1'");
      $check = tep_db_fetch_array($check_query);
      if ($check['count'] > 0) {
  	
?>
<!-- notifications //-->
<?php
    $boxHeading = BOX_HEADING_NOTIFICATIONS;
  
  $corner_top_left = 'rounded';
  $corner_top_right = 'rounded';
  $corner_bottom_left = 'rounded';
  $corner_bottom_right = 'rounded'; 
  
  $boxContent_attributes = '';
  $boxLink = '<a href="' . tep_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL') . '"><img src="' . DIR_WS_TEMPLATES . 'images/infobox/arrow_right.png" border="0" alt="' . ICON_ARROW_RIGHT . '" title="' . ICON_ARROW_RIGHT . '"></a>';
  $box_base_name = 'product_notifications'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

    if (tep_session_is_registered('customer_id')) {
      $check_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . (int)$_GET['products_id'] . "' and customers_id = '" . (int)$customer_id . "'");
      $check = tep_db_fetch_array($check_query);

      $notification_exists = (($check['count'] > 0) ? true : false);
    } else {
      $notification_exists = false;
    }

    if ($notification_exists == true) {
      $boxContent = '<table border="0" cellspacing="0" cellpadding="2"><tr><td class="infoBoxContents"><center><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=notify_remove', $request_type) . '">' . tep_image(bts_select('icons', 'notifications_del.png'), IMAGE_BUTTON_REMOVE_NOTIFICATIONS) . '</a></center></td></tr><tr><td class="infoBoxContents"><center><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=notify_remove', $request_type) . '">' . sprintf(BOX_NOTIFICATIONS_NOTIFY_REMOVE, tep_get_products_name($_GET['products_id'])) .'</a></center></td></tr></table>';
    } else {
      $boxContent = '<table border="0" cellspacing="0" cellpadding="2"><tr><td class="infoBoxContents"><center><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=notify', $request_type) . '">' . tep_image(bts_select('icons', 'notifications.png'), IMAGE_BUTTON_NOTIFICATIONS) . '</a></center></td></tr><tr><td class="infoBoxContents"><center><a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=notify', $request_type) . '">' . sprintf(BOX_NOTIFICATIONS_NOTIFY, tep_get_products_name($_GET['products_id'])) .'</a></center></td></tr></table>';
    }





include (bts_select('boxes', $box_base_name)); // BTS 1.5
    $boxLink = '';
  }
}
}
?>
