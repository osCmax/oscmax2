<?php
/*
  osCommerce 2.2 (Snapshot on November 10, 2002) Open Source E-Commerce Solutions
  Authorizenet ADC Direct Connection
  Last Update: November 10, 2002
  Author: Bao Nguyen
  Email: baonguyenx@yahoo.com  

  Updated for: Authorize.net Consolidated v1.3
  Date: August 13, 2003
  Added: Transaction Key, Sort Order
  Author: Austin Renfroe (Austin519)
  Email: Austin519@aol.com

  Updated for: Authorize.net Consolidated v1.4
  Date: February 28, 2004
  Added: Credit Card Processing Mode, Rudimentary Error Checking
  Author: Austin Renfroe (Austin519)
  Email: Austin519@aol.com

  Updated for: Authorize.net Consolidated v1.4
  Date: March 1, 2004
  Added: Linux Compatibility
  Author: Austin Renfroe (Austin519)
  Email: Austin519@aol.com

  Updated for: Authorize.net Consolidated v1.5
  Date: March 12, 2004
  Added: CVV Card Specific Checking, CC Images
  Author: Austin Renfroe (Austin519), some code thanks to Dansken
  Email: Austin519@aol.com

  Updated for: Authorize.net Consolidated v1.5
  Date: March 24, 2004
  Added: Dynamic CC Images, Credit Card Selection In Admin Module,
         Credit Card Pulldown Menu, Java CVV "What is this?" Popup
  Author: Austin Renfroe (Austin519), some code thanks to dreamscape
  Email: Austin519@aol.com
*/

  class authorizenet {
    var $code, $title, $description, $enabled, $sort_order;
    var $accepted_cc, $card_types, $allowed_types;

// class constructor
    function authorizenet() {
      $this->code = 'authorizenet';
      $this->title = MODULE_PAYMENT_AUTHORIZENET_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_AUTHORIZENET_TEXT_DESCRIPTION;
	$this->sort_order = MODULE_PAYMENT_AUTHORIZENET_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_AUTHORIZENET_STATUS == 'True') ? true : false);
	$this->accepted_cc = MODULE_PAYMENT_AUTHORIZENET_ACCEPTED_CC;

	//array for credit card selection
	$this->card_types = array('Visa' => MODULE_PAYMENT_AUTHORIZENET_TEXT_VISA,
				'Mastercard' => MODULE_PAYMENT_AUTHORIZENET_TEXT_MASTERCARD,
				'Amex' => MODULE_PAYMENT_AUTHORIZENET_TEXT_AMEX,
				'Discover' => MODULE_PAYMENT_AUTHORIZENET_TEXT_DISCOVER);
				
	$this->allowed_types = array();

	// Credit card pulldown list
	$cc_array = explode(', ', MODULE_PAYMENT_AUTHORIZENET_ACCEPTED_CC);
	while (list($key, $value) = each($cc_array)) {
		$this->allowed_types[$value] = $this->card_types[$value];
	}

	// Processing via Authorize.net AIM
      $this->form_action_url = tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', false);
    }

// class methods

//concatenate to get CC images
function get_cc_images() {
	$cc_images = '';
	reset($this->allowed_types);
	while (list($key, $value) = each($this->allowed_types)) {
		$cc_images .= tep_image(DIR_WS_ICONS . $key . '.gif', $value);
	}
	return $cc_images;
}

function javascript_validation() {
      $js = '  if (payment_value == "' . $this->code . '") {' . "\n" .
            '    var cc_owner = document.checkout_payment.authorizenet_cc_owner.value;' . "\n" .
            '    var cc_number = document.checkout_payment.authorizenet_cc_number.value;' . "\n" .
            '    var cc_cvv = document.checkout_payment.cvv.value;' . "\n" .
            '    if (cc_owner == "" || cc_owner.length < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_OWNER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '    if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_NUMBER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '    if (cc_cvv != "" && cc_cvv.length < "3") {' . "\n".
            '      error_message = error_message + "' . MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_CVV . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '  }' . "\n";

      return $js;
    }

    function selection() {
      global $order;
	reset($this->allowed_types);
	while (list($key, $value) = each($this->allowed_types)) {
		$card_menu[] = array('id' => $key, 'text' => $value);
	}

      for ($i=1; $i<13; $i++) {
        $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%B',mktime(0,0,0,$i,1,2000)));
      }

      $today = getdate(); 
      for ($i=$today['year']; $i < $today['year']+10; $i++) {
        $expires_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
      }

	$selection = array('id' => $this->code,
		'module' => $this->title . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $this->get_cc_images(),
		'fields' => array(array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_TYPE,
			'field' => tep_draw_pull_down_menu('credit_card_type', $card_menu)),
		array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_OWNER,
			'field' => tep_draw_input_field('authorizenet_cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])),
		array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_NUMBER,
			'field' => tep_draw_input_field('authorizenet_cc_number')),
		array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_EXPIRES,
			'field' => tep_draw_pull_down_menu('authorizenet_cc_expires_month', $expires_month) . '&nbsp;' . tep_draw_pull_down_menu('authorizenet_cc_expires_year', $expires_year)),
		array('title' => 'CVV number ' . ' ' .'<a href="javascript:CVVPopUpWindow(\'' . tep_href_link('cvv.html') . '\')">' . '<u><i>' . '(' . MODULE_PAYMENT_AUTHORIZENET_TEXT_CVV_LINK . ')' . '</i></u></a>',
			'field' => tep_draw_input_field('cvv','',"SIZE=4, MAXLENGTH=4"))));
       return $selection;
    }

    function pre_confirmation_check() {
      global $HTTP_POST_VARS, $cvv;
      include(DIR_WS_CLASSES . 'cc_validation.php');
      $cc_validation = new cc_validation();
	$result = $cc_validation->validate($HTTP_POST_VARS['authorizenet_cc_number'], $HTTP_POST_VARS['authorizenet_cc_expires_month'], $HTTP_POST_VARS['authorizenet_cc_expires_year'], $HTTP_POST_VARS['cvv'], $HTTP_POST_VARS['credit_card_type']);
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
		case -5:
			$error = TEXT_CCVAL_ERROR_CARD_TYPE_MISMATCH;
			break;
		case -6;
			$error = TEXT_CCVAL_ERROR_CVV_LENGTH;
			break; 
		case false:
			$error = TEXT_CCVAL_ERROR_INVALID_NUMBER;
			break;
	}

      if ( ($result == false) || ($result < 1) ) {
        $payment_error_return = 'payment_error=' . $this->code . '&error=' . urlencode($error) . '&authorizenet_cc_owner=' . urlencode($HTTP_POST_VARS['authorizenet_cc_owner']) . '&authorizenet_cc_expires_month=' . $HTTP_POST_VARS['authorizenet_cc_expires_month'] . '&authorizenet_cc_expires_year=' . $HTTP_POST_VARS['authorizenet_cc_expires_year'];
        tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'SSL', true, false));
      }

      $this->cc_card_type = $cc_validation->cc_type;
      $this->cc_card_number = $cc_validation->cc_number;
      $this->cc_expiry_month = $cc_validation->cc_expiry_month;
      $this->cc_expiry_year = $cc_validation->cc_expiry_year;
      $x_Card_Code = $HTTP_POST_VARS['cvv'];
    }

    function confirmation() {
      global $HTTP_POST_VARS, $x_Card_Code;
       $x_Card_Code=$HTTP_POST_VARS['cvv'];
       $confirmation = array('title' => $this->title . ': ' . $this->cc_card_type,
                            'fields' => array(array('title' => 'CVV number',
                                                    'field' => $HTTP_POST_VARS['cvv']),
                                                    array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_OWNER,
                                                    'field' => $HTTP_POST_VARS['authorizenet_cc_owner']),
                                              array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_NUMBER,
                                                    'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
                                              array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_EXPIRES,
                                                    'field' => strftime('%B, %Y', mktime(0,0,0,$HTTP_POST_VARS['authorizenet_cc_expires_month'], 1, '20' . $HTTP_POST_VARS['authorizenet_cc_expires_year'])))));
      $x_Card_Code=$HTTP_POST_VARS['cvv'];
      return $confirmation;
    }

    function process_button() {
	   // Change made by using ADC Direct Connection
        $x_Card_Code=$HTTP_POST_VARS['cvv'];

      $process_button_string = tep_draw_hidden_field('x_Card_Code', $HTTP_POST_VARS['cvv']) . 
                               tep_draw_hidden_field('x_Card_Num', $this->cc_card_number) .
                               tep_draw_hidden_field('x_Exp_Date', $this->cc_expiry_month . substr($this->cc_expiry_year, -2));

      $process_button_string .= tep_draw_hidden_field(tep_session_name(), tep_session_id());
      return $process_button_string;
    }

    function before_process() {
	  global $response;
	  
	  // Change made by using ADC Direct Connection
		$response_vars = explode(',', $response[0]);
		$x_response_code = $response_vars[0];
		$x_response_subcode = $response_vars[1];
		$x_response_reason_code = $response_vars[2];
		$x_response_reason_text = $response_vars[3];
	
	if ($x_response_code != '1') {
		tep_db_query("delete from " . TABLE_ORDERS . " where orders_id = '" . (int)$insert_id . "'"); //Remove order
		if($x_response_code == '') {
			tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode('The server cannot connect to Authorize.net.  Please check your cURL and server settings.'), 'SSL', true, false));
		}
		else if($x_response_code == '2') {
			tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode('Your credit card was declined ') . urlencode('(') . urlencode("$x_response_reason_code") . urlencode('): ') . urlencode("$x_response_reason_text"), 'SSL', true, false));
		}
		else if($x_response_code == '3') {
			tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode('There was an error processing your credit card ') . urlencode('(') . urlencode("$x_response_reason_code") . urlencode('): ') . urlencode("$x_response_reason_text"), 'SSL', true, false));
		}
		else {
		      tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode('There was an unspecified error processing your credit card.'), 'SSL', true, false));
		}
	}
    }

    function after_process() {
      return false;
    }

    function get_error() {
      global $HTTP_GET_VARS;

      $error = array('title' => MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR,
                     'error' => stripslashes(urldecode($HTTP_GET_VARS['error'])));
      return $error;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_AUTHORIZENET_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Authorize.net Module', 'MODULE_PAYMENT_AUTHORIZENET_STATUS', 'True', 'Do you want to accept payments through Authorize.net?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Login Username', 'MODULE_PAYMENT_AUTHORIZENET_LOGIN', 'Your Login Name', 'The login username used for the Authorize.net service', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Login Transaction Key', 'MODULE_PAYMENT_AUTHORIZENET_TRANSKEY', 'Your Transaction Key', 'The transaction key used for the Authorize.net service', '6', '0', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('cURL Setup', 'MODULE_PAYMENT_AUTHORIZENET_CURL', 'Not Compiled', 'Whether cURL is compiled into PHP or not.  Windows users, select not compiled.', '6', '0', 'tep_cfg_select_option(array(\'Not Compiled\', \'Compiled\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('cURL Path', 'MODULE_PAYMENT_AUTHORIZENET_CURL_PATH', 'The Path To cURL', 'For Not Compiled mode only, input path to the cURL binary (i.e. c:/curl/curl)', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Mode', 'MODULE_PAYMENT_AUTHORIZENET_TESTMODE', 'Test', 'Transaction mode used for processing orders', '6', '0', 'tep_cfg_select_option(array(\'Test\', \'Test And Debug\', \'Production\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Method', 'MODULE_PAYMENT_AUTHORIZENET_METHOD', 'Credit Card', 'Transaction method used for processing orders', '6', '0', 'tep_cfg_select_option(array(\'Credit Card\', \'eCheck\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Processing Mode', 'MODULE_PAYMENT_AUTHORIZENET_CCMODE', 'Authorize And Capture', 'Credit card processing mode', '6', '0', 'tep_cfg_select_option(array(\'Authorize And Capture\', \'Authorize Only\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order Of Display', 'MODULE_PAYMENT_AUTHORIZENET_SORT_ORDER', '1', 'The order in which this payment type is dislayed. Lowest is displayed first.', '6', '0' , now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Customer Notifications', 'MODULE_PAYMENT_AUTHORIZENET_EMAIL_CUSTOMER', 'False', 'Should Authorize.Net e-mail a receipt to the customer?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Accepted Credit Cards', 'MODULE_PAYMENT_AUTHORIZENET_ACCEPTED_CC', 'Visa, Mastercard', 'The credit cards you currently accept', '6', '0', '_selectOptions(array(\'Visa\', \'Mastercard\', \'Amex\',\'Discover\'), ', now())");
    }

    function remove() {
      $keys = '';
      $keys_array = $this->keys();
      for ($i=0; $i<sizeof($keys_array); $i++) {
        $keys .= "'" . $keys_array[$i] . "',";
      }
      $keys = substr($keys, 0, -1);
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in (" . $keys . ")");
    }

    function keys() {
      return array('MODULE_PAYMENT_AUTHORIZENET_STATUS', 'MODULE_PAYMENT_AUTHORIZENET_LOGIN', 'MODULE_PAYMENT_AUTHORIZENET_TRANSKEY', 'MODULE_PAYMENT_AUTHORIZENET_CURL', 'MODULE_PAYMENT_AUTHORIZENET_CURL_PATH', 'MODULE_PAYMENT_AUTHORIZENET_TESTMODE', 'MODULE_PAYMENT_AUTHORIZENET_METHOD', 'MODULE_PAYMENT_AUTHORIZENET_CCMODE', 'MODULE_PAYMENT_AUTHORIZENET_SORT_ORDER', 'MODULE_PAYMENT_AUTHORIZENET_EMAIL_CUSTOMER', 'MODULE_PAYMENT_AUTHORIZENET_ACCEPTED_CC');
    }
  }

// Authorize.net Consolidated Credit Card Checkbox Implementation
// Code from UPS Choice v1.7 - Fritz Clapp (aka dreamscape, thanks Fritz!)
function _selectOptions($select_array, $key_value, $key = '') {
	for ($i=0; $i<(sizeof($select_array)); $i++) {
		$name = (($key) ? 'configuration[' . $key . '][]' : 'configuration_value');
		$string .= '<br><input type="checkbox" name="' . $name . '" value="' . $select_array[$i] . '"';
		$key_values = explode(", ", $key_value);
		if (in_array($select_array[$i], $key_values)) $string .= ' checked="checked"';
		$string .= '> ' . $select_array[$i];
	} 
	return $string;
}
?>