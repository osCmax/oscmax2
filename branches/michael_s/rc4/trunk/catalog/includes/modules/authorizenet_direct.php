<?php
/*
  osCommerce 2.2 (Snapshot on November 10, 2002) Open Source E-Commerce Solutions
  Authorizenet ADC Direct Connection
  Last Update: November 10, 2002
  Author: Bao Nguyen
  Email: baonguyenx@yahoo.com

  Update: August 13, 2003
  Added: Transaction Key, Sort Order
  Author: Austin Renfroe (Austin519)
  Email: Austin519@aol.com

  Updated for: Authorize.net Consolidated v1.4
  Date: February 28, 2004
  Added: Credit Card Processing Mode, Currency Code, Company Information, Updated Billing Address, Invoice Number, Echeck Foundation, Debug Code
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
  Added: Relay Response var, Test and Debug Mode, cURL var for admin module, cURL autofind, Windows 2003 Compatibility
  Author: Austin Renfroe (Austin519), some code thanks to dreamscape
  Email: Austin519@aol.com
*/

	unset($form_data);
	$xx = '';
	for ($i=0; $i<sizeof($order->products); $i++) {
		$xx .= $order->products[$i]['qty'] . '-' . ($order->products[$i]['name']) . '**'; 
	}
	//Austin519 - added transaction key, ccmode
	$form_data = array(
	x_Login => MODULE_PAYMENT_AUTHORIZENET_LOGIN,
	x_Tran_Key => MODULE_PAYMENT_AUTHORIZENET_TRANSKEY,
	x_Relay_Response => 'FALSE',
	x_Delim_Data => 'TRUE',
	x_Version => '3.1',
	x_Type => MODULE_PAYMENT_AUTHORIZENET_CCMODE == 'Authorize Only' ? 'AUTH_ONLY' : 'AUTH_CAPTURE',
	x_Method => MODULE_PAYMENT_AUTHORIZENET_METHOD == 'Credit Card' ? 'CC' : 'ECHECK',
	x_Amount => number_format($order->info['total'], 2),
	x_Currency_Code => "{$order->info['currency']}",
	x_Email_Customer => MODULE_PAYMENT_AUTHORIZENET_EMAIL_CUSTOMER == 'True' ? 'TRUE': 'FALSE',
	x_Email_Merchant => MODULE_PAYMENT_AUTHORIZENET_EMAIL_MERCHANT == 'True' ? 'TRUE': 'FALSE',
	x_Cust_ID => "$customer_id",
	x_Invoice_Num => "$insert_id",
	x_First_Name => "{$order->billing['firstname']}",
	x_Last_Name => "{$order->billing['lastname']}",
	x_Company => "{$order->billing['company']}",
	x_Address => "{$order->billing['street_address']}",
	x_City => "{$order->billing['city']}",
	x_State => "{$order->billing['state']}",
	x_Zip => "{$order->billing['postcode']}",
	x_Country => "{$order->billing['country']['title']}",
	x_Phone => "{$order->customer['telephone']}",
	x_Email => "{$order->customer['email_address']}",
	x_Ship_To_First_Name => "{$order->delivery['firstname']}",
	x_Ship_To_Last_Name => "{$order->delivery['lastname']}",
	x_Ship_To_Company => "{$order->delivery['company']}",	
	x_Ship_To_Address => "{$order->delivery['street_address']}",
	x_Ship_To_City => "{$order->delivery['city']}",
	x_Ship_To_State => "{$order->delivery['state']}",
	x_Ship_To_Zip => "{$order->delivery['postcode']}",
	x_Ship_To_Country => "{$order->delivery['country']['title']}",
	x_Customer_IP => "{$HTTP_SERVER_VARS['REMOTE_ADDR']}",
	x_Description => "$xx",
	tep_session_name() => tep_session_id());

	if(MODULE_PAYMENT_AUTHORIZENET_METHOD == 'Credit Card') {
		$form_data['x_Card_Num'] = "$x_Card_Num";
		$form_data['x_Exp_Date'] = "$x_Exp_Date";
		$form_data['x_Card_Code'] = "$x_Card_Code";
	}
	else {
		//E-check Information (Currently NOT IMPLEMENTED!)
		$form_data['x_Recurring_Billing'] = '';
		$form_data['x_Bank_Aba_Code'] = '';
		$form_data['x_Bank_Acct_Num'] = '';
		$form_data['x_Bank_Acct_Type'] = '';
		$form_data['x_Bank_Name'] = '';
		$form_data['x_Bank_Acct_Name'] = '';
		$form_data['x_echeck_type'] = '';
		$form_data['x_drivers_license_num'] = '';
		$form_data['x_drivers_license_state'] = '';
		$form_data['x_drivers_license_DOB'] = '';
	}
	if((MODULE_PAYMENT_AUTHORIZENET_TESTMODE == 'Test') || (MODULE_PAYMENT_AUTHORIZENET_TESTMODE == 'Test And Debug')) {
		$form_data['x_Test_Request'] = 'TRUE';
	}

	// concatenate order information variables to $data
	while(list($key, $value) = each($form_data)) {
		$data .= $key . '=' . urlencode(ereg_replace(',', '', $value)) . '&';
	}
	
	// take the last & out for the string
	$data = substr($data, 0, -1);

	/* Debug code - will dump cURL data to a file when
	 * the admin module Transaction Mode is set to Test and Debug.
	 * The file is written into the root directory of the catalog
	 */
	if (MODULE_PAYMENT_AUTHORIZENET_TESTMODE == 'Test And Debug') {
		$filename = './authnet_debug.txt';
		$fp = fopen($filename, "a");
		$write = fputs($fp, $data);
		fclose($fp);
	}
	unset($response);

/******************************************************************************************
 * Post order info data to Authorize.net, make sure you have curl installed
 *    Those with cURL not compiled into PHP (Windows users, some Linux users): 
 *          Please type in your path in the admin module.  The code below will TRY to find
 *          your cURL path for you (may not work under Windows) and if it finds it, will
 *          default to that, but you should enter your cURL path in the admin module to be
 *          sure.  You no longer need to edit the code manually in this file (that code thanks
 *          to dreamscape).
 *    Those with cURL compiled into PHP (some Linux users):
 *          This should work without any editing if cURL is compiled into your PHP and you
 *          have PHP configured to realize it (per the PHP guides).
 ******************************************************************************************
 */
	if (MODULE_PAYMENT_AUTHORIZENET_CURL == 'Not Compiled') {
		if (function_exists('exec')) {
			exec('which curl', $curl_output);
			if ($curl_output) {
				$curl_path = $curl_output[0];
			}
			else {
				$curl_path = MODULE_PAYMENT_AUTHORIZENET_CURL_PATH;
			}
		}
		exec("$curl_path -d \"$data\" https://secure.authorize.net/gateway/transact.dll", $response);
	}
	else {
		$url = "https://secure.authorize.net/gateway/transact.dll";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_VERBOSE, 0);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);  //Windows 2003 Compatibility 
		$authorize = curl_exec($ch);
		curl_close($ch);
		$response = split(",", $authorize);
	}
?>