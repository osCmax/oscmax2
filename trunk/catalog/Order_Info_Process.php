<?php
/*
$Id: Order_Info_Process.php 3 2006-05-27 04:59:07Z user $
  by Richy C.

        OSCommerce v2.2MS1

   Modified versions of create_account.php and related
  files.  Allowing 'purchase without account'.

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN);

  define('FILENAME_ORDER_INFO', 'Order_Info.php');
  define('FILENAME_ORDER_INFO_PROCESS', 'Order_Info_Process.php');

  if (!@$HTTP_POST_VARS['action']) {
    tep_redirect(tep_href_link(FILENAME_ORDER_INFO, '', 'NONSSL'));
  }

  $gender = tep_db_prepare_input($HTTP_POST_VARS['gender']);
  $firstname = tep_db_prepare_input($HTTP_POST_VARS['firstname']);
  $lastname = tep_db_prepare_input($HTTP_POST_VARS['lastname']);
  if (ACCOUNT_DOB == 'true') $dob = tep_db_prepare_input($HTTP_POST_VARS['dob']);
  $email_address = tep_db_prepare_input($HTTP_POST_VARS['email_address']);
  $telephone = tep_db_prepare_input($HTTP_POST_VARS['telephone']);
  $fax = tep_db_prepare_input($HTTP_POST_VARS['fax']);
  $newsletter = tep_db_prepare_input($HTTP_POST_VARS['newsletter']);
//  $password = tep_db_prepare_input($HTTP_POST_VARS['password']);
        $password = tep_db_prepare_input('');
  $confirmation = tep_db_prepare_input($HTTP_POST_VARS['confirmation']);
  $street_address = tep_db_prepare_input($HTTP_POST_VARS['street_address']);
  if (ACCOUNT_COMPANY == 'true') $company = tep_db_prepare_input($HTTP_POST_VARS['company']);
  if (ACCOUNT_SUBURB == 'true') $suburb = tep_db_prepare_input($HTTP_POST_VARS['suburb']);
  $postcode = tep_db_prepare_input($HTTP_POST_VARS['postcode']);
  $city = tep_db_prepare_input($HTTP_POST_VARS['city']);
// BOF: Bugfix 0000050
// $zone_id = tep_db_prepare_input($HTTP_POST_VARS['zone_id']);
// $state = tep_db_prepare_input($HTTP_POST_VARS['state']);
  if (ACCOUNT_STATE == 'true') {
    $state = tep_db_prepare_input($HTTP_POST_VARS['state']);
    if (isset($HTTP_POST_VARS['zone_id'])) {
      $zone_id = tep_db_prepare_input($HTTP_POST_VARS['zone_id']);
    } else {
      $zone_id = false;
    }
  }
// EOF: Bugfix 0000050
  $country = tep_db_prepare_input($HTTP_POST_VARS['country']);

  $error = false; // reset error flag

    // +Country-State Selector
  $refresh = false;
  if (isset($HTTP_POST_VARS['action']) && (($HTTP_POST_VARS['action'] == 'process') || ($HTTP_POST_VARS['action'] == 'refresh'))) {
    if ($HTTP_POST_VARS['action'] == 'process')  $process = true;
	if ($HTTP_POST_VARS['action'] == 'refresh') $refresh = true;
  // -Country-State Selector

  if (ACCOUNT_GENDER == 'true') {
    if (($gender == 'm') || ($gender == 'f')) {
      $entry_gender_error = false;
    } else {
      $error = true;
      $entry_gender_error = true;
    }
  }

      // +Country-State Selector
	if ($process) {
	// -Country-State Selector
    $error = false;

  if (strlen($firstname) < ENTRY_FIRST_NAME_MIN_LENGTH) {
    $error = true;
    $entry_firstname_error = true;
  } else {
    $entry_firstname_error = false;
  }

  if (strlen($lastname) < ENTRY_LAST_NAME_MIN_LENGTH) {
    $error = true;
    $entry_lastname_error = true;
  } else {
    $entry_lastname_error = false;
  }

  if (ACCOUNT_DOB == 'true') {
    if (checkdate(substr(tep_date_raw($dob), 4, 2), substr(tep_date_raw($dob), 6, 2), substr(tep_date_raw($dob), 0, 4))) {
      $entry_date_of_birth_error = false;
    } else {
      $error = true;
      $entry_date_of_birth_error = true;
    }
  }

  if (strlen($email_address) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
    $error = true;
    $entry_email_address_error = true;
  } else {
    $entry_email_address_error = false;
  }

  if (!tep_validate_email($email_address)) {
    $error = true;
    $entry_email_address_check_error = true;
  } else {
    $entry_email_address_check_error = false;
  }

  if (strlen($street_address) < ENTRY_STREET_ADDRESS_MIN_LENGTH) {
    $error = true;
    $entry_street_address_error = true;
  } else {
    $entry_street_address_error = false;
  }

  if (strlen($postcode) < ENTRY_POSTCODE_MIN_LENGTH) {
    $error = true;
    $entry_post_code_error = true;
  } else {
    $entry_post_code_error = false;
  }

  if (strlen($city) < ENTRY_CITY_MIN_LENGTH) {
    $error = true;
    $entry_city_error = true;
  } else {
    $entry_city_error = false;
  }

  if (!$country) {
    $error = true;
    $entry_country_error = true;
  } else {
    $entry_country_error = false;
  }

  if (ACCOUNT_STATE == 'true') {
// BOF: Bugfix 0000050
// BOF: MOD - Country-State Selector
/*  $zones_array = array();
    $zones_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = " . $country . " order by zone_name");
    while ($zones_values = tep_db_fetch_array($zones_query)) {
      $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
    }
	  if (count($zones_array) > 0) {
      echo tep_draw_pull_down_menu('state', $zones_array);
		  } else {
		    echo tep_draw_input_field('state');
		  }
    }
*/
// EOF: MOD - Country-State Selector
    $zone_id = 0;
    $check_query = tep_db_query("select count(*) as total from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "'");
    $check = tep_db_fetch_array($check_query);
    $entry_state_has_zones = ($check['total'] > 0);
    if ($entry_state_has_zones == true) {
      $zone_query = tep_db_query("select distinct zone_id from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and (zone_name like '" . tep_db_input($state) . "%' or zone_code like '%" . tep_db_input($state) . "%')");
      if (tep_db_num_rows($zone_query) == 1) {
        $zone = tep_db_fetch_array($zone_query);
        $zone_id = $zone['zone_id'];
      } else {
        $error = true;
        $messageStack->add('create_account', ENTRY_STATE_ERROR_SELECT);
       }
    } else {
      if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
        $error = true;
        $messageStack->add('create_account', ENTRY_STATE_ERROR);
      }
    }
// EOF: Bugfix 0000050
  }

  if (strlen($telephone) < ENTRY_TELEPHONE_MIN_LENGTH) {
    $error = true;
    $entry_telephone_error = true;
  } else {
    $entry_telephone_error = false;
  }

/*
  $passlen = strlen($password);
  if ($passlen < ENTRY_PASSWORD_MIN_LENGTH) {
    $error = true;
    $entry_password_error = true;
  } else {
    $entry_password_error = false;
  }

  if ($password != $confirmation) {
    $error = true;
    $entry_password_error = true;
  }
*/

	$entry_password_error = false;
/*
  $check_email = tep_db_query("select customers_email_address from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($email_address) . "' and customers_id <> '" . tep_db_input($customer_id) . "'");
  if (tep_db_num_rows($check_email)) {
    $error = true;
    $entry_email_address_exists = true;
  } else {
    $entry_email_address_exists = false;
  }
*/

	$entry_email_address_exists = false;

  if ($error == true) {
    $processed = true;

    $breadcrumb->add(NAV_ORDER_INFO, tep_href_link(FILENAME_ORDER_INFO, '', 'NONSSL'));
// DDB - 040622 - no need    $breadcrumb->add(NAVBAR_TITLE_2);
$content = Order_Info_Process;
  } else {

		// PWA 0.70 : SELECT using new method of determining a customer has purchased without account:
    $check_customer_query = tep_db_query("select customers_id, purchased_without_account,
			customers_firstname, customers_password, customers_email_address,
			customers_default_address_id from " . TABLE_CUSTOMERS . "
			where upper(customers_email_address) = '" . strtoupper($HTTP_POST_VARS['email_address']) . "' and
        upper(customers_firstname) = '" . strtoupper($HTTP_POST_VARS['firstname']) . "' and
        upper(customers_lastname) = '" . strtoupper($HTTP_POST_VARS['lastname']) . "'");

// if password is EMPTY (null) and e-mail address is same then we just load up their account information.
// could be security flaw -- might want to setup password = somestring and have it recheck here (during the first initial
// creation

    $check_customer = tep_db_fetch_array($check_customer_query);
    
    if (tep_db_num_rows($check_customer_query)) {

      // PWA 0.70 added this for backwards compatibility with older versions of PWA
      // that made a blank password, causing logins to fail:
      if(!$check_customer['purchased_without_account']) {
        list($md5hash, $salt) = explode(':',$check_customer['customers_password']);
        if(md5($salt) == $md5hash) {
          // password was blank; customer purchased without account using a previous version of PWA code
          $check_customer['purchased_without_account'] = 1;
        }
      }

      if ($check_customer['purchased_without_account'] != 1) {
        // Customer found and has account - make them log in.
        tep_redirect(tep_href_link(FILENAME_LOGIN, 
          'login=fail&reason=' . urlencode(
          str_replace('{EMAIL_ADDRESS}',$check_customer['customers_email_address'],PWA_FAIL_ACCOUNT_EXISTS)), 'SSL'));
      } else {
        // Customer found but no account - fetch their details.
        
        $customer_id = $check_customer['customers_id'];
        // now get latest address book entry:
        $get_default_address = tep_db_query("select address_book_id, entry_country_id, entry_zone_id from " . TABLE_ADDRESS_BOOK . "
          where customers_id = '" . $customer_id . "' ORDER BY address_book_id DESC LIMIT 1");
        $default_address = tep_db_fetch_array($get_default_address);
        $customer_default_address_id = $default_address['address_book_id'];
        $customer_first_name = $check_customer['customers_firstname'];
        $customer_country_id = $default_address['entry_country_id'];
        $customer_zone_id = $default_address['entry_zone_id'];
        tep_session_register('customer_id');
        tep_session_register('customer_default_address_id');
        tep_session_register('customer_first_name');
        tep_session_register('customer_country_id');
        tep_session_register('customer_zone_id');
        // PWA 0.71 update returning customer's address book:
        $customer_update = array('customers_firstname' => $firstname,
          'customers_lastname' => $lastname,
          'customers_telephone' => $telephone,
          'customers_fax' => $fax);
        if (ACCOUNT_GENDER == 'true') $customer_update['customers_gender'] = $gender;
        tep_db_perform(TABLE_CUSTOMERS, $customer_update, 'update', "customers_id = '".$customer_id."'");
   
        $address_book_update = array('customers_id' => $customer_id,
          'entry_firstname' => $firstname,
          'entry_lastname' => $lastname,
          'entry_street_address' => $street_address,
          'entry_postcode' => $postcode,
          'entry_city' => $city,
          'entry_country_id' => $country);
        if (ACCOUNT_GENDER == 'true') $address_book_update['entry_gender'] = $gender;
        if (ACCOUNT_COMPANY == 'true') $address_book_update['entry_company'] = $company;
        if (ACCOUNT_SUBURB == 'true') $address_book_update['entry_suburb'] = $suburb;
        if (ACCOUNT_STATE == 'true') {
          if ($zone_id > 0) {
            $address_book_update['entry_zone_id'] = $zone_id;
            $address_book_update['entry_state'] = '';
          } else {
            $address_book_update['entry_zone_id'] = '0';
            $address_book_update['entry_state'] = $state;
          }
        }
        
        tep_db_perform(TABLE_ADDRESS_BOOK, $address_book_update, 'update', "address_book_id = '".$customer_default_address_id."'");
      } // if-else $pass_ok
  
      if ($HTTP_POST_VARS['setcookie'] == '1') {
        setcookie('email_address', $HTTP_POST_VARS['email_address'], time()+2592000);
        setcookie('password', $HTTP_POST_VARS['password'], time()+2592000);
        setcookie('first_name', $customer_first_name, time()+2592000);
      } elseif ( ($HTTP_COOKIE_VARS['email_address']) && ($HTTP_COOKIE_VARS['password']) ) {
        setcookie('email_address', '');
        setcookie('password', '');
        setcookie('first_name', '');
      } // if cookies

      $date_now = date('Ymd');
      tep_db_query("update " . TABLE_CUSTOMERS_INFO . " set customers_info_date_of_last_logon = now(),
        customers_info_number_of_logons = customers_info_number_of_logons+1 where customers_info_id = '" . $customer_id . "'");

      } else {
      // if customer_exist = NO

    // PWA 0.70 : new way of determining a customer purchased without an account : just say so!
    $sql_data_array = array('purchased_without_account' => 1,
                            'customers_firstname' => $firstname,
                            'customers_lastname' => $lastname,
                            'customers_email_address' => $email_address,
                            'customers_telephone' => $telephone,
                            'customers_fax' => $fax,
                            'customers_newsletter' => $newsletter,
                            'customers_password' => tep_encrypt_password($password));
//                          'customers_default_address_id' => 1);

    if (ACCOUNT_GENDER == 'true') $sql_data_array['customers_gender'] = $gender;
    if (ACCOUNT_DOB == 'true') $sql_data_array['customers_dob'] = tep_date_raw($dob);

    tep_db_perform(TABLE_CUSTOMERS, $sql_data_array);

    $customer_id = tep_db_insert_id();

    $sql_data_array = array('customers_id' => $customer_id,
                            'address_book_id' => $address_id,
                            'entry_firstname' => $firstname,
                            'entry_lastname' => $lastname,
                            'entry_street_address' => $street_address,
                            'entry_postcode' => $postcode,
                            'entry_city' => $city,
                            'entry_country_id' => $country);

    if (ACCOUNT_GENDER == 'true') $sql_data_array['entry_gender'] = $gender;
    if (ACCOUNT_COMPANY == 'true') $sql_data_array['entry_company'] = $company;
    if (ACCOUNT_SUBURB == 'true') $sql_data_array['entry_suburb'] = $suburb;
    if (ACCOUNT_STATE == 'true') {
      if ($zone_id > 0) {
        $sql_data_array['entry_zone_id'] = $zone_id;
        $sql_data_array['entry_state'] = '';
      } else {
        $sql_data_array['entry_zone_id'] = '0';
        $sql_data_array['entry_state'] = $state;
      }
    }

    tep_db_perform(TABLE_ADDRESS_BOOK, $sql_data_array);
      $address_id = tep_db_insert_id();

      tep_db_query("update " . TABLE_CUSTOMERS . " set customers_default_address_id = '" . (int)$address_id . "' where customers_id = '" . (int)$customer_id . "'");

      tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . (int)$customer_id . "', '0', now())");
//    tep_db_query("insert into " . TABLE_CUSTOMERS_INFO . " (customers_info_id, customers_info_number_of_logons, customers_info_date_account_created) values ('" . tep_db_input($customer_id) . "', '0', now())");

    $customer_first_name = $firstname;
    $customer_default_address_id = $address_id;
    $customer_country_id = $country;
    $customer_zone_id = $zone_id;
    tep_session_register('customer_id');
    tep_session_register('customer_first_name');
    tep_session_register('customer_default_address_id');
    tep_session_register('customer_country_id');
    tep_session_register('customer_zone_id');

	} // ELSE CUSTOMER=NO

// restore cart contents
    $cart->restore_contents();

    // build the message content
// DDB - 040622 - no mail will be sent
//    $name = $firstname . " " . $lastname;
//
//    if (ACCOUNT_GENDER == 'true') {
//       if ($HTTP_POST_VARS['gender'] == 'm') {
//         $email_text = EMAIL_GREET_MR;
//       } else {
//         $email_text = EMAIL_GREET_MS;
//       }
//    } else {
//      $email_text = EMAIL_GREET_NONE;
//    }
//
//    $email_text .= EMAIL_WELCOME . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_WARNING;
//    tep_mail($name, $email_address, EMAIL_SUBJECT, nl2br($email_text), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, '');

//    tep_redirect(tep_href_link(FILENAME_CREATE_ACCOUNT_SUCCESS, '', 'SSL'));

    tep_session_register('noaccount');

    tep_redirect(tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));

  }

// BOF: MOD - Country-State Selector
 }
if ($HTTP_POST_VARS['action'] == 'refresh') {$state = '';}
if (!isset($country)){$country = DEFAULT_COUNTRY;}
// EOF: MOD - Country-State Selector
}
  $content = Order_Info;
  include (bts_select('main', $content_template)); // BTSv1.5
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>