<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Gift Voucher System v1.0
  Copyright 2000 - 2011 osCmax
  http://www.phesis.org

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');

// if the customer is not logged on, redirect them to the login page
if (!tep_session_is_registered('customer_id')) {
$navigation->set_snapshot();
tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
}
// check for a voucher number in the url
  if (isset($_GET['gv_no'])) {
    $error = true;
 $voucher_number=tep_db_prepare_input($_GET['gv_no']);
    $gv_query = tep_db_query("select c.coupon_id, c.coupon_amount from " . TABLE_COUPONS . " c, " . TABLE_COUPON_EMAIL_TRACK . " et where coupon_code = '" . addslashes($voucher_number) . "' and c.coupon_id = et.coupon_id");
    if (tep_db_num_rows($gv_query) >0) {
      $coupon = tep_db_fetch_array($gv_query);

      $redeem_query = tep_db_query("select coupon_id from ". TABLE_COUPON_REDEEM_TRACK . " where coupon_id = '" . $coupon['coupon_id'] . "'");

      if (tep_db_num_rows($redeem_query) == 0 ) {
        // check for required session variables
        if (!tep_session_is_registered('gv_id')) {
          tep_session_register('gv_id');
        }
        $gv_id = $coupon['coupon_id'];
        $error = false;
      } else {
        $error = true;
      }
    }
  } else {
    tep_redirect(FILENAME_DEFAULT);
  }
  
  if ((!$error) && (tep_session_is_registered('customer_id'))) {
    // Update redeem status
    $gv_query = tep_db_query("insert into  " . TABLE_COUPON_REDEEM_TRACK . " (coupon_id, customer_id, redeem_date, redeem_ip) values ('" . $coupon['coupon_id'] . "', '" . $customer_id . "', now(),'" . $REMOTE_ADDR . "')");
    $gv_update = tep_db_query("update " . TABLE_COUPONS . " set coupon_active = 'N' where coupon_id = '" . $coupon['coupon_id'] . "'");
    tep_gv_account_update($customer_id, $gv_id);
    tep_session_unregister('gv_id');   
  } 
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_GV_REDEEM);

  $breadcrumb->add(NAVBAR_TITLE); 

  $content = CONTENT_GV_REDEEM;

  include (bts_select('main')); // BTSv1.5


  require(DIR_WS_INCLUDES . 'application_bottom.php'); 
  ?>