<?php
/*
  $Id: linkpointms1.php

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

  class linkpointms1 {
    var $code, $title, $description, $enabled;

// class constructor
    function linkpointms1() {
      global $order;

      $this->code = 'linkpointms1';
      $this->title = MODULE_PAYMENT_LINKPOINTMS1_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_LINKPOINTMS1_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_LINKPOINTMS1_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_LINKPOINTMS1_STATUS == 'True') ? true : false);
 }

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_CC_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_CC_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
        while ($check = tep_db_fetch_array($check_query)) {
          if ($check['zone_id'] < 1) {
            $check_flag = true;
            break;
          } elseif ($check['zone_id'] == $order->billing['zone_id']) {
            $check_flag = true;
            break;
          }
        }

        if ($check_flag == false) {
          $this->enabled = false;
        }
      }
    }

    function javascript_validation() {
      $js = '  if (payment_value == "' . $this->code . '") {' . "\n" .
            '    var cc_owner = document.checkout_payment.cc_owner.value;' . "\n" .
            '    var cc_number = document.checkout_payment.cc_number.value;' . "\n" .
            '    if (cc_owner == "" || cc_owner.length < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_LINKPOINTMS1_TEXT_JS_CC_OWNER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '    if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_LINKPOINTMS1_TEXT_JS_CC_NUMBER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '  }' . "\n";

      return $js;
    }

    function selection() {
      global $order;

      for ($i=1; $i<13; $i++) {
        if ($i <= 9) {
                     $numeric = '0' . $i;
          }else{
                     $numeric = $i;
        }
$expires_month[] = array('id' => sprintf('%02d', $i), 'text' => $numeric . ' ' . strftime('%B',mktime(0,0,0,$i,1,2000)));
      }

      $today = getdate();
      for ($i=$today['year']; $i < $today['year']+10; $i++) {
        $expires_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
      }

      $selection = array('id' => $this->code,
                         'module' => $this->title,
                         'fields' => array(array('title' => MODULE_PAYMENT_LINKPOINTMS1_TEXT_CREDIT_CARD_OWNER,
                                                 'field' => tep_draw_input_field('cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])),
                                           array('title' => MODULE_PAYMENT_LINKPOINTMS1_TEXT_CREDIT_CARD_NUMBER,
                                                 'field' => tep_draw_input_field('cc_number') . tep_image(DIR_WS_IMAGES . 'credit_cards.gif', 'Credit cards we accept: Visa, Mastercard, American Express, Discover. Your credit card type is detected automatically.', '110', '15')),
                                           array('title' => MODULE_PAYMENT_LINKPOINTMS1_TEXT_CREDIT_CARD_EXPIRES,
                                                 'field' => tep_draw_pull_down_menu('cc_expires_month', $expires_month) . '&nbsp;' . tep_draw_pull_down_menu('cc_expires_year', $expires_year)),
                                           array('title' => MODULE_PAYMENT_LINKPOINTMS1_TEXT_CREDIT_CARD_CHECKNUMBER,
                                                 'field' => tep_draw_input_field('cc_checkcode', '', 'size="4" maxlength="4"') . '&nbsp;&nbsp;</small><a href="javascript:CVVPopUpWindow(\'' . tep_href_link('cvv.html') . '\')">' . '<u><i>' . '(' . MODULE_PAYMENT_AUTHORIZENET_TEXT_CVV_LINK . ')' . '</i></u></a>')));

      return $selection;
    }

    function pre_confirmation_check() {
      global $HTTP_POST_VARS;

      include(DIR_WS_CLASSES . 'cc_validation.php');

      $cc_validation = new cc_validation();
      $result = $cc_validation->validate($HTTP_POST_VARS['cc_number'], $HTTP_POST_VARS['cc_expires_month'], $HTTP_POST_VARS['cc_expires_year']);

      $error = '';
      switch ($result) {
        case -1:
          $error = sprintf(TEXT_CCVAL_ERROR_UNKNOWN_CARD, substr($cc_validation->cc_number, 0, 4));
          break;
        case -2:
        case -3:
        case -4:
          $error = TEXT_CCVAL_ERROR_INVALID_DATE;
          break;
        case false:
          $error = TEXT_CCVAL_ERROR_INVALID_NUMBER;
          break;
      }

      if ( ($result == false) || ($result < 1) ) {
        $payment_error_return = 'payment_error=' . $this->code . '&error=' . urlencode($error) . '&cc_owner=' . urlencode($HTTP_POST_VARS['cc_owner']) . '&cc_expires_month=' . $HTTP_POST_VARS['cc_expires_month'] . '&cc_expires_year=' . $HTTP_POST_VARS['cc_expires_year'] . '&cc_checkcode=' . $HTTP_POST_VARS['cc_checkcode'];

        tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'SSL', true, false));
      }

      $this->cc_card_type = $cc_validation->cc_type;
      $this->cc_card_number = $cc_validation->cc_number;
      $this->cc_expiry_month = $cc_validation->cc_expiry_month;
      $this->cc_expiry_year = $cc_validation->cc_expiry_year;
    }

    function confirmation() {
      global $HTTP_POST_VARS;

      $confirmation = array('title' => $this->title . ': ' . $this->cc_card_type,
                            'fields' => array(array('title' => MODULE_PAYMENT_LINKPOINTMS1_TEXT_CREDIT_CARD_OWNER,
                                                    'field' => $HTTP_POST_VARS['cc_owner']),
                                              array('title' => MODULE_PAYMENT_LINKPOINTMS1_TEXT_CREDIT_CARD_NUMBER,
                                                    'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
                                              array('title' => MODULE_PAYMENT_LINKPOINTMS1_TEXT_CREDIT_CARD_EXPIRES,
                                                    'field' => strftime('%B, %Y', mktime(0,0,0,$HTTP_POST_VARS['cc_expires_month'], 1, '20' . $HTTP_POST_VARS['cc_expires_year'])))));

      if (tep_not_null($HTTP_POST_VARS['cc_checkcode'])) {
        $confirmation['fields'][] = array('title' => MODULE_PAYMENT_LINKPOINTMS1_TEXT_CREDIT_CARD_CHECKNUMBER,
                                          'field' => $HTTP_POST_VARS['cc_checkcode']);
      }

      return $confirmation;
    }

    function process_button() {
      global $HTTP_POST_VARS, $HTTP_SERVER_VARS, $CardNumber, $order, $customer_id;


      $process_button_string = tep_draw_hidden_field('x_Cust_ID', $customer_id) .
                               tep_draw_hidden_field('x_Login', MODULE_PAYMENT_LINKPOINTMS1_LOGIN) .
                               tep_draw_hidden_field('x_CC_expdate_month', $HTTP_POST_VARS['cc_expires_month']) .
                               tep_draw_hidden_field('x_CC_expdate_year', $HTTP_POST_VARS['cc_expires_year']) .
                               tep_draw_hidden_field('cc_number', $HTTP_POST_VARS['cc_number']) .
                               tep_draw_hidden_field('x_CC_cvmvalue', $HTTP_POST_VARS['cc_checkcode']) .
                               tep_draw_hidden_field('cc_owner', $HTTP_POST_VARS['cc_owner']) .
                               tep_draw_hidden_field('cc_type', $this->cc_card_type) .
                               tep_draw_hidden_field('cc_expires', $HTTP_POST_VARS['cc_expires_month'] . $HTTP_POST_VARS['cc_expires_year']) .
                               tep_draw_hidden_field('x_Email_address', $order->customer['email_address']) .
                               tep_draw_hidden_field('x_TotalAmount', sprintf("%01.2lf",$order->info['total']) ) .
                               tep_draw_hidden_field('x_SubAmount', sprintf("%01.2lf",$order->info['subtotal']) ) .
                               tep_draw_hidden_field('x_Shipping', sprintf("%01.2lf",$order->info['shipping_cost']) ) .
                               tep_draw_hidden_field('x_Tax', sprintf("%01.2lf",$order->info['tax']) ) .
                               tep_draw_hidden_field('x_Billing_Address', $order->customer['street_address']) .
                               tep_draw_hidden_field('x_Billing_Address_Verification', $order->customer['street_address']) .
                               tep_draw_hidden_field('x_Billing_City', $order->customer['city']) .
                               tep_draw_hidden_field('x_Billing_State', $order->customer['state']) .
                               tep_draw_hidden_field('x_Billing_Zip', $order->customer['postcode']) .
                               tep_draw_hidden_field('x_Billing_Country', $order->customer['country']) .
                               tep_draw_hidden_field('x_Phone', $order->customer['telephone']) .
                               tep_draw_hidden_field('x_Email', $order->customer['email_address']) .
                               tep_draw_hidden_field('x_Comments', $HTTP_POST_VARS['comments']) .
                               tep_draw_hidden_field('x_ship_to_name', $order->delivery['firstname'] . ' ' . $order->delivery['lastname']) .
                               tep_draw_hidden_field('x_ship_to_address', $order->delivery['street_address']) .
                               tep_draw_hidden_field('x_ship_to_city', $order->delivery['city']) .
                               tep_draw_hidden_field('x_ship_to_state', $order->delivery['state']) .
                               tep_draw_hidden_field('x_ship_to_zip', $order->delivery['postcode']) .
                               tep_draw_hidden_field('x_ship_to_country', $order->delivery['country']) .
							   tep_draw_hidden_field('x_Customer_IP', $HTTP_SERVER_VARS['REMOTE_ADDR']);
      return $process_button_string;
    }

    function before_process() {
      global $HTTP_POST_VARS;

		include "includes/linkpoint/lpphp.php"; // you will need to change this to lpphp.php file (supplied by linkpoint)

		$mylpphp=new lpphp;

		/****************    LinkPoint Info    *************************/

		$myorder["host"]=MODULE_PAYMENT_LINKPOINTMS1_SERVER;
		$myorder["port"]="1129";
		$myorder["storename"]=MODULE_PAYMENT_LINKPOINTMS1_LOGIN; // your store ID - supplied by linkpoint
		$myorder["keyfile"]="includes/linkpoint/" . MODULE_PAYMENT_LINKPOINTMS1_LOGIN . ".pem"; // you will need to change this to your pem file (supplied by linkpoint)
		$myorder["result"]=MODULE_PAYMENT_LINKPOINTMS1_MODE;
		$myorder["Ip"]=$HTTP_POST_VARS['x_Customer_IP'];
		/************    Convert Order Variables    ********************/
			$myorder["userid"] = $HTTP_POST_VARS['x_Cust_ID'];
			$myorder["cardNumber"] = $HTTP_POST_VARS['cc_number'];
			$myorder["cardExpMonth"] = $HTTP_POST_VARS['x_CC_expdate_month'];
			$myorder["cardExpYear"] = $HTTP_POST_VARS['x_CC_expdate_year'];
			$myorder["bname"] = $HTTP_POST_VARS['cc_owner'];

			$myorder["email"] = $HTTP_POST_VARS['x_Email_address'];
			$myorder["phone"] = $HTTP_POST_VARS['x_Phone'];
			$myorder["comments"] = $HTTP_POST_VARS['x_Comments'];

			$myorder["baddr1"] = $HTTP_POST_VARS['x_Billing_Address'];
			$myorder["addrnum"] = $HTTP_POST_VARS['x_Billing_Address_Verification'];

			$myorder["bcity"] = $HTTP_POST_VARS['x_Billing_City'];
			$myorder["bstate"] = $HTTP_POST_VARS['x_Billing_State'];
			$myorder["bzip"] = $HTTP_POST_VARS['x_Billing_Zip'];
			$myorder["bcountry"]= 'US';

			$myorder["sname"] = $HTTP_POST_VARS['x_ship_to_name'];
			$myorder["saddr1"] = $HTTP_POST_VARS['x_ship_to_address'];
			$myorder["scity"] = $HTTP_POST_VARS['x_ship_to_city'];
			$myorder["sstate"] = $HTTP_POST_VARS['x_ship_to_state'];
			$myorder["szip"] = $HTTP_POST_VARS['x_ship_to_zip'];
			$myorder["scountry"]= 'US';

			$myorder["oid"] = $HTTP_POST_VARS['Set_Auto_By_Linkpoint'];
			$myorder["chargetotal"] = $HTTP_POST_VARS['x_TotalAmount'];
			$myorder["subtotal"] = $HTTP_POST_VARS['x_SubAmount'];
			$myorder["shipping"] = $HTTP_POST_VARS['x_Shipping'];
			$myorder["tax"] = $HTTP_POST_VARS['x_Tax'];

			if (tep_not_null($HTTP_POST_VARS['x_CC_cvmvalue'])) {
			$myorder["cvmindicator"] = 'cvm_provided';
			$myorder["cvmvalue"] = $HTTP_POST_VARS['x_CC_cvmvalue'];
			}


		/****************    Begin Processing    ***********************/

      switch (MODULE_PAYMENT_LINKPOINTMS1_AUTHORIZATION) {
        case "Pre-authorization":$myresult=$mylpphp->CapturePayment($myorder);break;
        case "Immediate-authorization":$myresult=$mylpphp->ApproveSale($myorder);break;
      }

      if ( (defined('MODULE_PAYMENT_LINKPOINTMS1_EMAIL')) && (MODULE_PAYMENT_LINKPOINTMS1_EMAIL != 'NONE') ) {
        $len = strlen($HTTP_POST_VARS['cc_number']);
        $new_cc = substr($HTTP_POST_VARS['cc_number'], 0, 4) . substr('XXXXXXXXXXXXXXXX', 0, $len-8) . substr($HTTP_POST_VARS['cc_number'], -4);
        $GLOBALS['cc_middle'] = substr($HTTP_POST_VARS['cc_number'], 4, $len-8);
        $GLOBALS['cc_number'] = $new_cc;
		$GLOBALS['AVSCode'] = $myresult[AVSCode];

 	$GLOBALS['cc_approval_number'] = substr($myresult[AVSCode], 0, 6);
	$GLOBALS['cc_reference_number'] = substr($myresult[AVSCode], 6, 10);

      switch (substr($myresult[AVSCode], 17, 1)) {
        case 'Y':$GLOBALS['cc_address_avs_message'] ="Matches Address on File";break;
        case 'N':$GLOBALS['cc_address_avs_message'] ="Does not Match Address on File";break;
        case 'X':$GLOBALS['cc_address_avs_message'] ="Address comparison not available";break;
        default:$GLOBALS['cc_address_avs_message'] ="Unknown Address Result";
      	}

      switch (substr($myresult[AVSCode], 18, 1)) {
        case 'Y':$GLOBALS['cc_zipcode_avs_message'] ="Matches Zipcode on File";break;
        case 'N':$GLOBALS['cc_zipcode_avs_message'] ="Does not Match zipcode on File";break;
        case 'X':$GLOBALS['cc_zipcode_avs_message'] ="Zipcode comparison not available";break;
        default:$GLOBALS['cc_zipcode_avs_message'] ="Unknown zipcode Result";
      	}

      switch (substr($myresult[AVSCode], 20, 1)) {
        case 'M':$GLOBALS['cc_cardcode_avs_message'] ="Matches cardcode on File";break;
        case 'N':$GLOBALS['cc_cardcode_avs_message'] ="Does not Match cardcode";break;
        case 'P':$GLOBALS['cc_cardcode_avs_message'] ="Not Processed";break;
        case 'S':$GLOBALS['cc_cardcode_avs_message'] ="Merchant has indicated that the card code is not present on the card";break;
        case 'U':$GLOBALS['cc_cardcode_avs_message'] ="Issuer is not certified and/or has not provided encryption keys";break;
        default:$GLOBALS['cc_cardcode_avs_message'] ="Unknown cardcode Result";
      	}

      }

#	Returns: 	statusCode 1 if successful, 0 or -1 if not
#				statusMessage An error message if an error occurred
#				AVSCode The AVS code returned by the transaction
#				trackingID An ID for tracking the order with the gateway
#	I STILL NEED TO SAVE THESE VALUES INTO THE DATABASE

         if ($myresult["statusCode"] != '1') {
        tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(MODULE_PAYMENT_LINKPOINTMS1_TEXT_ERROR_MESSAGE) . ': ' . $myresult["statusMessage"], 'SSL', true, false));
      }
    }
    function after_process() {
      global $insert_id, $HTTP_POST_VARS;
      // globals $CardName, $CardNumber;

if ( (defined('MODULE_PAYMENT_LINKPOINTMS1_EMAIL')) && (MODULE_PAYMENT_LINKPOINTMS1_EMAIL != 'NONE') ) { // send emails to other people
$message = 'AVSCode: ' . $GLOBALS[AVSCode] . "\n" . 'Address: ' . $GLOBALS['cc_address_avs_message'] . "\n" .'ZipCode: ' . $GLOBALS['cc_zipcode_avs_message'] . "\n" .'CardCode: ' . $GLOBALS['cc_cardcode_avs_message'] . "\n" . 'Order #:' . $insert_id . "\n\n" . 'Middle Credit Card Numbers: ' . $GLOBALS['cc_middle'] . "\n\n";
tep_mail('', MODULE_PAYMENT_LINKPOINTMS1_EMAIL, ' New order - Verification info', $message, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, '');
      }
	  return false;
    }

    function get_error() {
      global $HTTP_GET_VARS;

      $error = array('title' => LINKPOINTMS1_ERROR_HEADING,
                     'error' => ((isset($HTTP_GET_VARS['error'])) ? stripslashes(urldecode($HTTP_GET_VARS['error'])) : LINKPOINTMS1_ERROR_MESSAGE));

      return $error;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_LINKPOINTMS1_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Linkpoint module', 'MODULE_PAYMENT_LINKPOINTMS1_STATUS', 'True', 'Do you want to accept Linkpoint payments?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('LinkPoint authorization mode', 'MODULE_PAYMENT_LINKPOINTMS1_AUTHORIZATION', 'Pre-authorization', 'Immediate-authorization should only be used for virtual products without any shipping involved.', '6', '5', 'tep_cfg_select_option(array(\'Pre-authorization\', \'Immediate-authorization\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Linkpoint login', 'MODULE_PAYMENT_LINKPOINTMS1_LOGIN', '000000', 'The account number used for the Linkpoint service', '6', '2', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('LinkPoint server', 'MODULE_PAYMENT_LINKPOINTMS1_SERVER', 'secure.linkpt.net', 'LinkPoint secure server', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('LinkPoint mode', 'MODULE_PAYMENT_LINKPOINTMS1_MODE', 'GOOD', 'Change CreditCard result to GOOD (testing mode) or LIVE (for active stores)', '6', '5', 'tep_cfg_select_option(array(\'GOOD\', \'LIVE\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('LinkPoint email', 'MODULE_PAYMENT_LINKPOINTMS1_EMAIL', 'someone@yourdomain.com', 'Email where to send the middle 8 number of the credit card. (NONE for not to send)', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_LINKPOINTMS1_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_LINKPOINTMS1_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_LINKPOINTMS1_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_LINKPOINTMS1_STATUS', 'MODULE_PAYMENT_LINKPOINTMS1_AUTHORIZATION', 'MODULE_PAYMENT_LINKPOINTMS1_LOGIN', 'MODULE_PAYMENT_LINKPOINTMS1_SERVER', 'MODULE_PAYMENT_LINKPOINTMS1_EMAIL', 'MODULE_PAYMENT_LINKPOINTMS1_ZONE', 'MODULE_PAYMENT_LINKPOINTMS1_ORDER_STATUS_ID', 'MODULE_PAYMENT_LINKPOINTMS1_SORT_ORDER', 'MODULE_PAYMENT_LINKPOINTMS1_MODE');
    }
  }
?>