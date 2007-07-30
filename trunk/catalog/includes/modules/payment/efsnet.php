<?php
/*

$Id: efsnet.php 3 2006-05-27 04:59:07Z user $
	
   osCommerce 2.2, Open Source E-Commerce Solutions
   EFSnet Named Pair Connection
   Last Update: 08/03/03
   Author: John Nelson
   Email: info@phpmage.com
   
   This class is based off of the authorize.net payment module.  If anything does not work,
   or any updates are made to improve it's behavior, please email me any changes or
   questions you may have.
   
   DISCLAIMER:
   
     This code is distributed in the hope that it will be useful, but without any warranty;
     without even the implied warranty of merchantability or fitness for a particular
     purpose.

*/
class efsnet {
	
	// class constructor
	function efsnet() {
		global $order;

		$this->code = 'efsnet';
		$this->title = MODULE_PAYMENT_EFSNET_TEXT_TITLE;
		$this->description = MODULE_PAYMENT_EFSNET_TEXT_DESCRIPTION;
		$this->enabled = ((MODULE_PAYMENT_EFSNET_STATUS == 'True') ? true : false);
		$this->sort_order = MODULE_PAYMENT_EFSNET_SORT_ORDER;
		
		if ((int)MODULE_PAYMENT_EFSNET_ORDER_STATUS_ID > 0) {
		$this->order_status = MODULE_PAYMENT_EFSNET_ORDER_STATUS_ID;
		}

		if (is_object($order)) $this->update_status();
	}
	
	function pre_confirmation_check() {
		global $HTTP_POST_VARS;
		include(DIR_WS_CLASSES . 'cc_validation.php');
		$cc_validation = new cc_validation();
		$result = $cc_validation->validate($HTTP_POST_VARS['efsnet_cc_number'], $HTTP_POST_VARS['efsnet_cc_expires_month'], $HTTP_POST_VARS['efsnet_cc_expires_year']);
		
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
        $payment_error_return = 'payment_error=' . $this->code . '&error=' . urlencode($error) . '&efsnet_cc_owner=' . urlencode($HTTP_POST_VARS['efsnet_cc_owner']) . '&efsnet_cc_expires_month=' . $HTTP_POST_VARS['efsnet_cc_expires_month'] . '&efsnet_cc_expires_year=' . $HTTP_POST_VARS['efsnet_cc_expires_year'];

        tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, $payment_error_return, 'SSL', true, false));
      }

      $this->cc_card_type = $cc_validation->cc_type;
      $this->cc_card_number = $cc_validation->cc_number;
      $this->cc_expiry_month = $cc_validation->cc_expiry_month;
      $this->cc_expiry_year = $cc_validation->cc_expiry_year;

		
	}
	
	function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_EFSNET_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_EFSNET_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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
            '    var cc_owner = document.checkout_payment.efsnet_cc_owner.value;' . "\n" .
            '    var cc_number = document.checkout_payment.efsnet_cc_number.value;' . "\n" .
            '    if (cc_owner == "" || cc_owner.length < ' . CC_OWNER_MIN_LENGTH . ') {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_EFSNET_TEXT_JS_CC_OWNER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '    if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_EFSNET_TEXT_JS_CC_NUMBER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '  }' . "\n";

      return $js;
    }
    
    function selection() {
      global $order;

      for ($i=1; $i<13; $i++) {
        $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%B',mktime(0,0,0,$i,1,2000)));
      }

      $today = getdate(); 
      for ($i=$today['year']; $i < $today['year']+10; $i++) {
        $expires_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
      }
      $selection = array('id' => $this->code,
                         'module' => $this->title,
                         'fields' => array(array('title' => MODULE_PAYMENT_EFSNET_TEXT_CREDIT_CARD_OWNER,
                                                 'field' => tep_draw_input_field('efsnet_cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])),
                                           array('title' => MODULE_PAYMENT_EFSNET_TEXT_CREDIT_CARD_NUMBER,
                                                 'field' => tep_draw_input_field('efsnet_cc_number')),
                                           array('title' => MODULE_PAYMENT_EFSNET_TEXT_CREDIT_CARD_EXPIRES,
                                                 'field' => tep_draw_pull_down_menu('efsnet_cc_expires_month', $expires_month) . '&nbsp;' . tep_draw_pull_down_menu('efsnet_cc_expires_year', $expires_year))));

      return $selection;
    }


	
	function confirmation() {
		global $order;
	}
	
	function process_button() {
		global $HTTP_SERVER_VARS, $order, $customer_id;
		// place credit card variables into the form for the transact method
		foreach($_POST as $var => $val)
			echo '<input type="hidden" name="'.$var.'" value="'.$val.'">'."\r\n";
	}
	
	// this function is ran before the order is processed
	function before_process() {
		global $order;
		$result = $this->transact();
		if ($result['ResponseCode'] == '00') return;
		if ($result['ResponseCode'] == '0') return;
		
		if (($result['ResponseCode'] != '0')||($result['ResponseCode'] != '00')) {
        tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(MODULE_PAYMENT_EFSNET_TEXT_DECLINED_MESSAGE.$result['ResultMessage'].$result['data'].print_r($order->info, true)), 'SSL', true, false));
      	}
      	
      	// Any other ResponseCode is an error as well
      	tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(MODULE_PAYMENT_EFSNET_TEXT_ERROR_MESSAGE.$result['ResultMessage'].$result['data'].print_r($order->info, true)), 'SSL', true, false));
  	  	return $result();
	}
	
	function after_process() {
		global $order;
	}
	
	function get_error() {
      global $HTTP_GET_VARS;

      $error = array('title' => MODULE_PAYMENT_EFSNET_TEXT_ERROR,
                     'error' => stripslashes(urldecode($HTTP_GET_VARS['error'])));

      return $error;
    }
	
	// execute the transaction
	function transact() {
		global $HTTP_SERVER_VARS, $order, $customer_id;
		unset($form_data);
		
		$form_data = array(
		Method => MODULE_PAYMENT_EFSNET_METHOD,
		StoreID => MODULE_PAYMENT_EFSNET_STOREID,
		StoreKey   => MODULE_PAYMENT_EFSNET_STOREKEY,
		ApplicationID => 'EFSNet OSCommerce Method',
		ReferenceNumber => $customer_id,
		TransactionAmount => number_format($order->info['total'], 2),
		SalesTaxAmount => number_format($order->info['tax'], 2),
		AccountNumber => $_POST['efsnet_cc_number'],
		ExpirationMonth => $_POST['efsnet_cc_expires_month'],
		ExpirationYear => $_POST['efsnet_cc_expires_month'],		
		BillingName => urlencode($_POST['efsnet_cc_owner']),
		BillingAddress => $order->customer['street_address'],
		BillingCity => $order->customer['city'],
		BillingState => $order->customer['state'],
		BillingPostalCode => $order->customer['postcode'],
		BillingCountry => $order->customer['country']['title'],
		BillingPhone => $order->customer['telephone'],
		BillingEmail => $order->customer['email_address'],
		ShippingName => urlencode($order->delivery['firstname']." ".$order->delivery['lastname']),
		ShippingAddress => $order->delivery['street_address'],
		ShippingCity => $order->delivery['city'],
		ShippingState => $order->delivery['state'],
		ShippingPostalCode => $order->delivery['postcode'],
		ShippingCountry => $order->delivery['country']['title'],
		ClientIPAddress => $_SERVER['REMOTE_ADDR']
		);
		
		// concatenate order information variables to $data
		while(list($key, $value) = each($form_data)) 
		{	$data .= $key . '=' . urlencode(ereg_replace(',', '', $value)) . '&';		}
		
		// take the last & out for the string
		$data = substr($data, 0, -1);
		
		unset($response);
		
		
		// Post order info data to EFSNet, make sure you have curl installed
		
		//BEGIN PHP_CURL.DLL CODE - Author: Peter Drake - 4/29/03
		//Use for Win32 or Unix-type systems with php-curl.dll
		// Get a CURL handle
		$curl_handle = curl_init ();
		
		// Tell CURL the URL of the CGI
		if (MODULE_PAYMENT_EFSNET_TESTMODE == 'Test')
			curl_setopt ($curl_handle, CURLOPT_URL, "https://testefsnet.concordebiz.com/EFSnet.dll");
			else curl_setopt ($curl_handle, CURLOPT_URL, "https://efsnet.concordebiz.com/efsnet.dll");
		
		// This section sets various options. See http://www.php.net/manual/en/function.curl-setopt.php
		// for more details
		curl_setopt ($curl_handle, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt ($curl_handle, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt ($curl_handle, CURLOPT_POST, 1);
		curl_setopt ($curl_handle, CURLOPT_POSTFIELDS, $data);
		
		// Perform the POST and get the data returned by the server.
		$response = curl_exec ($curl_handle) or die ("There has been an error connecting to EFSNet.");
		
		// Close the CURL handle
		curl_close ($curl_handle);
		
		$details = explode("&", $response);
		
		foreach($details as $row) {
			$tmp = explode("=",$row);
			$result[$tmp[0]] = $tmp[1];
		}
		unset($tmp);
		$result['data'] = $data;
		return $result;

		
		//END PHP_CURL.DLL CODE
	}
	
	// check to see if this module is installed already
	function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_EFSNET_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }
	
	// install the module
	function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable EFSnet Module', 'MODULE_PAYMENT_EFSNET_STATUS', 'True', 'Do you want to accept EFSNet payments?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Login Username', 'MODULE_PAYMENT_EFSNET_STOREID', 'testing', 'The StoreID used for the EFSNet service', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Transaction Key', 'MODULE_PAYMENT_EFSNET_STOREKEY', 'Test', 'Store Key used for encrypting data', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Mode', 'MODULE_PAYMENT_EFSNET_TESTMODE', 'Test', 'Transaction mode used for processing orders', '6', '0', 'tep_cfg_select_option(array(\'Test\', \'Production\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Method', 'MODULE_PAYMENT_EFSNET_METHOD', 'CreditCardCharge', 'Transaction method used for processing orders', '6', '0', 'tep_cfg_select_option(array(\'CreditCardCharge\',\'CreditCardAuthorize\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_EFSNET_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_EFSNET_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_EFSNET_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
    }
    
    // remove the module
    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }
    
    // keys that this module installs into the configuration database
    function keys() {
      return array('MODULE_PAYMENT_EFSNET_STATUS', 'MODULE_PAYMENT_EFSNET_STOREID', 'MODULE_PAYMENT_EFSNET_STOREKEY', 'MODULE_PAYMENT_EFSNET_TESTMODE', 'MODULE_PAYMENT_EFSNET_METHOD', 'MODULE_PAYMENT_EFSNET_ZONE', 'MODULE_PAYMENT_EFSNET_ORDER_STATUS_ID', 'MODULE_PAYMENT_EFSNET_SORT_ORDER');
    }




}
?>