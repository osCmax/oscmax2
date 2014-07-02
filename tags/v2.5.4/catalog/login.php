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

// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled (or the session has not started)
  if ($session_started == false) {
    tep_redirect(tep_href_link(FILENAME_COOKIE_USAGE));
  }

  require(bts_select('language', FILENAME_LOGIN));

  $error = false;
  // BOF PHONE ORDER

  //if (isset($_GET['action']) && ($_GET['action'] == 'process')) {

  if ((isset($_GET['action']) && ($_GET['action'] == 'process')) || ((isset($_POST['action']) && ($_POST['action'] == 'process')))) {
    // reset cart if using admin login
	if (isset($_POST['admin'])) {
      $cart->reset();
      $wishList->reset();
    }	  

  // EOF PHONE ORDER
    $email_address = tep_db_prepare_input($_POST['email_address']);
    $password = tep_db_prepare_input($_POST['password']);

// Check if email exists
// LINE CHANGED: MOD - Separate Pricing per Customer
//  $check_customer_query = tep_db_query("select customers_id, customers_firstname, customers_password, customers_email_address, customers_default_address_id from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "'");
    $check_customer_query = tep_db_query("select customers_id, customers_firstname, customers_group_id, customers_password, customers_email_address, customers_default_address_id , guest_account from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "' and guest_account='0'");
    if (!tep_db_num_rows($check_customer_query)) {
	  // Email address not in database
      $error = true;
	  //Added by PGM
	  tep_db_query("insert into " . TABLE_CUSTOMER_LOG . " values ('', '" . (addslashes($email_address)) . "', '" . $_SERVER['REMOTE_ADDR'] . "', 'Wrong Username', now())");
    } else {
	  // Email in database now lets check the password
      $check_customer = tep_db_fetch_array($check_customer_query);
      // Check that password is good
      // BOF PHONE ORDER
	  $checked = '';
      // If $_POST(['action']) is set then lets check where they have come from
	  if (isset($_POST['action'])) {
        $referrer = $_SERVER['HTTP_REFERER'];
	    // We should have the admin folder name in the $_POST vars
	    if (strpos($referrer, $_POST['admin']) !== false) {
	      $checked = 'pass';
	    } else {
	      $checked = 'fail';
	    }
	  }
	  
	  //if (!tep_validate_password($password, $check_customer['customers_password'])) {
	  if (!tep_validate_password($password, $check_customer['customers_password']) && !isset($_POST['action'])) {
	  // Password does not match and customer did not come from admin 
        $error = true;
		tep_db_query("insert into " . TABLE_CUSTOMER_LOG . " values ('', '" . (addslashes($email_address)) . "', '" . $_SERVER['REMOTE_ADDR'] . "', 'Wrong Password', now())");
	  } elseif (isset($_POST['action']) && $checked == 'fail') {
	  // Password does not match and customer looks like they came from admin but admin dir does not match - potential hack attempt
	    $error = true;
		tep_db_query("insert into " . TABLE_CUSTOMER_LOG . " values ('', '" . (addslashes($email_address)) . "', '" . $_SERVER['REMOTE_ADDR'] . "', 'Hack Attempt', now())");
      } else {
	  // Password matched or phone order via admin passed
        //if (SESSION_RECREATE == 'True' && !isset($_POST['action'])) {
		if ($checked == 'pass') {
          tep_db_query("insert into " . TABLE_CUSTOMER_LOG . " values ('', '" . (addslashes($email_address)) . "', '" . $_SERVER['REMOTE_ADDR'] . "', 'Admin as Customer', now())");
		} else {
		  tep_db_query("insert into " . TABLE_CUSTOMER_LOG . " values ('', '" . (addslashes($email_address)) . "', '" . $_SERVER['REMOTE_ADDR'] . "', 'Logged In', now())");  
		}
		// Create session
		tep_session_recreate();

		
	// EOF PHONE ORDER	
        //}
// BOF: MOD - Separate Pricing Per Customer: choice for logging in under any customer_group_id
// note that tax rates depend on your registered address!
        if (isset($_GET['skip']) && $_GET['skip'] != 'true' && $_POST['email_address'] == SPPC_TOGGLE_LOGIN_PASSWORD ) {
          $existing_customers_query = tep_db_query("select customers_group_id, customers_group_name from " . TABLE_CUSTOMERS_GROUPS . " order by customers_group_id ");
          echo '<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">';
          print ("\n<html ");
          echo HTML_PARAMS; 
          print (">\n<head>\n<title>Choose a Customer Group</title>\n<meta http-equiv=\"Content-Type\" content=\"text/html; charset=");
          echo CHARSET;
          print ("\"\n<base href=\"");
          echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG;
          print ("\">\n<link rel=\"stylesheet\" type=\"text/css\" href=\"stylesheet.css\">\n");
          echo '<body bgcolor="#ffffff" style="margin:0">';
          print ("\n<table border=\"0\" width=\"100%\">\n<tr>\n<td style=\"vertical-align: middle\" align=\"middle\">\n");
          echo tep_draw_form('login', tep_href_link(FILENAME_LOGIN, 'action=process&skip=true', 'SSL'));
          print ("\n<table border=\"0\" bgcolor=\"#f1f9fe\" cellspacing=\"10\" style=\"border: 1px solid #7b9ebd;\">\n<tr>\n<td class=\"main\">\n");
          $index = 0;
          while ($existing_customers =  tep_db_fetch_array($existing_customers_query)) {
            $existing_customers_array[] = array("id" => $existing_customers['customers_group_id'], "text" => "&#160;".$existing_customers['customers_group_name']."&#160;");
            ++$index;
          }
          print ("<h1>Choose a Customer Group</h1>\n</td>\n</tr>\n<tr>\n<td align=\"center\">\n");
          echo tep_draw_pull_down_menu('new_customers_group_id', $existing_customers_array, $check_customer['customers_group_id']);
          print ("\n<tr>\n<td class=\"main\">&#160;<br />\n&#160;");
          print ("<input type=\"hidden\" name=\"email_address\" value=\"".$_POST['email_address']."\">");
          print ("<input type=\"hidden\" name=\"password\" value=\"".$_POST['password']."\">\n</td>\n</tr>\n<tr>\n<td align=\"right\">\n");
          echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE);
          print ("</td>\n</tr>\n</table>\n</form>\n</td>\n</tr>\n</table>\n</body>\n</html>\n");
          exit;
        }
// EOF: MOD - Separate Pricing Per Customer: choice for logging in under any customer_group_id
        $check_country_query = tep_db_query("select entry_country_id, entry_zone_id from " . TABLE_ADDRESS_BOOK . " where customers_id = '" . (int)$check_customer['customers_id'] . "' and address_book_id = '" . (int)$check_customer['customers_default_address_id'] . "'");
        $check_country = tep_db_fetch_array($check_country_query);

        $customer_id = $check_customer['customers_id'];
        $customer_default_address_id = $check_customer['customers_default_address_id'];
        $customer_first_name = $check_customer['customers_firstname'];
// BOF: MOD - Separate Pricing per Customer
        if (isset($_GET['skip']) && $_GET['skip'] == 'true' && $_POST['email_address'] == SPPC_TOGGLE_LOGIN_PASSWORD && isset($_POST['new_customers_group_id']))  {
          $sppc_customer_group_id = $_POST['new_customers_group_id'] ;
          $check_customer_group_tax = tep_db_query("select customers_group_show_tax, customers_group_tax_exempt from " . TABLE_CUSTOMERS_GROUPS . " where customers_group_id = '" .(int)$_POST['new_customers_group_id'] . "'");
        } else {
          $sppc_customer_group_id = $check_customer['customers_group_id'];
          $check_customer_group_tax = tep_db_query("select customers_group_show_tax, customers_group_tax_exempt from " . TABLE_CUSTOMERS_GROUPS . " where customers_group_id = '" .(int)$check_customer['customers_group_id'] . "'");
        }
        $customer_group_tax = tep_db_fetch_array($check_customer_group_tax);
        $sppc_customer_group_show_tax = (int)$customer_group_tax['customers_group_show_tax'];
        $sppc_customer_group_tax_exempt = (int)$customer_group_tax['customers_group_tax_exempt'];

// PriceFormatterStore is already instantiated with the retail customer group id
    if ($sppc_customer_group_id != 0) {
      unset($pfs);
      $pfs = new PriceFormatterStore;
    }

// EOF: MOD - Separate Pricing per Customer
        $customer_country_id = $check_country['entry_country_id'];
        $customer_zone_id = $check_country['entry_zone_id'];
        tep_session_register('customer_id');
        tep_session_register('customer_default_address_id');
        tep_session_register('customer_first_name');
// BOF: MOD - Separate Pricing per Customer
        tep_session_register('sppc_customer_group_id');
        tep_session_register('sppc_customer_group_show_tax');
        tep_session_register('sppc_customer_group_tax_exempt');
// EOF: MOD - Separate Pricing per Customer
        tep_session_register('customer_country_id');
        tep_session_register('customer_zone_id');

        tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_of_last_logon = now(), customers_info_number_of_logons = customers_info_number_of_logons+1 where customers_info_id = '" . (int)$customer_id . "'");

// BOF - MOD: CREDIT CLASS Gift Voucher Contribution
// add these new codes:
        if (tep_session_is_registered('floating_gv_code')) {
          $gv_query = tep_db_query("SELECT c.coupon_id, c.coupon_amount, IF(rt.coupon_id>0, 'true', 'false') AS redeemed FROM ". TABLE_COUPONS ." c LEFT JOIN ". TABLE_COUPON_REDEEM_TRACK." rt USING(coupon_id), ". TABLE_COUPON_EMAIL_TRACK ." et WHERE c.coupon_code = '". $floating_gv_code ."' AND c.coupon_id = et.coupon_id");
          // check if coupon exist
          if (tep_db_num_rows($gv_query) >0) {
            $coupon = tep_db_fetch_array($gv_query);
            // check if coupon_id exist and coupon not redeemed
            if($coupon['coupon_id']>0 && $coupon['redeemed'] == 'false') {
              tep_session_unregister('floating_gv_code');
              $gv_query = tep_db_query("insert into  " . TABLE_COUPON_REDEEM_TRACK . " (coupon_id, customer_id, redeem_date, redeem_ip) values ('" . $coupon['coupon_id'] . "', '" . $customer_id . "', now(),'" . $REMOTE_ADDR . "')");
              $gv_update = tep_db_query("update " . TABLE_COUPONS . " set coupon_active = 'N' where coupon_id = '" . $coupon['coupon_id'] . "'");
              tep_gv_account_update($customer_id, $coupon['coupon_id']);
            }
          }
        }
// EOF - MOD: CREDIT CLASS Gift Voucher Contribution

// restore cart contents
        $cart->restore_contents();

//BOF: MOD - Wishlist 3.5
// restore wishlist to sesssion
        $wishList->restore_wishlist();
//EOF: MOD - Wishlist 3.5

        if (sizeof($navigation->snapshot) > 0) {
          $origin_href = tep_href_link($navigation->snapshot['page'], tep_array_to_string($navigation->snapshot['get'], array(tep_session_name())), $navigation->snapshot['mode']);
          $navigation->clear_snapshot();
          tep_redirect($origin_href);
        } else {
          tep_redirect(tep_href_link(FILENAME_DEFAULT));
        }
      }
    }
  }

  if ($error == true) {
    $messageStack->add('login', TEXT_LOGIN_ERROR);
  }

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_LOGIN, '', 'SSL'));

  $content = CONTENT_LOGIN;
  $javascript = $content . '.js';

  include (bts_select('main')); // BTSv1.5


  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>