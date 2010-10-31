<?php

// ship_fedex.php
// for managing federal express shipments
// - makes a form for adding additional info about a shipment
// - sends a ship request to fedex
// - returns a shipping label & formats it for printing
// - cancels an existing ship request
// - builds a shipping manifest

// debugging
// setting to 1 displays the array of all shipping 
// and manifest data when a ship request is made	
	$debug = 0;

  require('includes/application_top.php');
  require(DIR_WS_FUNCTIONS . 'ship_fedex.php');

	$action = $_GET['action'];
	$order = $_GET['oID'];
	$send_email_on_shipping = 0;   //set to 0 to disable, set to 1 to enable automatic email of tracking number
	
////
// make a new ship request
	
	if($action=='ship') {

		if (!$order) {
			die (ERROR_NO_ORDER_NUMBER);
			}
	
		include(DIR_WS_INCLUDES . 'abbreviate.php'); // used to abbreviate state & country names
		require(DIR_WS_INCLUDES . 'fedexdc.php');

// array of characters we don't want in phone numbers		
		$unwanted = array('(',')','-','.',' '); 

		$transaction_code = 21; // 21 is a ship request
				
// get the country we're shipping from
		$country_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'STORE_COUNTRY'");
		$country_value = tep_db_fetch_array($country_query);
		$country = tep_get_country_name($country_value['configuration_value']);
// abbreviate it for fedex (United States = US etc.)
		$senders_country = abbreviate_country($country);

// get sender's fedex info from configuration table
// (requires installation & configuration of FedEx RealTime Quotes)
	
		$fedex_vars = array (
			10=>'MODULE_SHIPPING_FEDEX1_ACCOUNT', // 0
			498=>'MODULE_SHIPPING_FEDEX1_METER', 	// 1
			75=>'MODULE_SHIPPING_FEDEX1_WEIGHT',	// 2
			4=>'STORE_NAME',											// 3
			5=>'MODULE_SHIPPING_FEDEX1_ADDRESS_1',// 4
			6=>'MODULE_SHIPPING_FEDEX1_ADDRESS_2',// 5
			7=>'MODULE_SHIPPING_FEDEX1_CITY',			// 6
			8=>'MODULE_SHIPPING_FEDEX1_STATE',		// 7
			9=>'MODULE_SHIPPING_FEDEX1_POSTAL',		// 8
			183=>'MODULE_SHIPPING_FEDEX1_PHONE',	// 9
			68=>'DEFAULT_CURRENCY',								// 10
			);
				
		$i = 0;
		$fedex_keys = array_keys($fedex_vars);
				
		foreach($fedex_vars as $var) {
			$value_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = '" . $var . "'");
			$value = tep_db_fetch_array($value_query);
			$value = $value['configuration_value'];
			if (($var == 'MODULE_SHIPPING_FEDEX1_ACCOUNT') && (!$value)) {
				die (ERROR_FEDEX_QUOTES_NOT_INSTALLED);
				}
		
// get rid of dashes, parentheses and periods in shipper's telephone number
			if ($fedex_keys[$i]==183) {
				$value = trim(str_replace($unwanted, '', $value));
				$fedex_vars[$fedex_keys[$i]] = $value;
				}
			else {
				$fedex_vars[$fedex_keys[$i]] = $value;
				}
			$i++;
			}
				
////
// create new FedExDC object
		$fed = new FedExDC($shipVars[0][10],$shipVars[1][498]);
	
// get all information from the order record
		$order_query = tep_db_query("select * from orders where orders_id = $order");
	
		$order_info = tep_db_fetch_array($order_query);

// abbreviate the delivery state (function is in abbreviate.php)
		$delivery_state = abbreviate_state($order_info['delivery_state']);

// abbreviate the delivery country (function is in abbreviate.php)
		$delivery_country = abbreviate_country($order_info['delivery_country']);

// get rid of dashes, parentheses and periods in customer's telephone number
		$delivery_phone = trim(str_replace($unwanted, '', $order_info['customers_telephone']));

// get the transaction value
		$value_query = tep_db_query("select value from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . $order . "' and class='ot_subtotal'");
		$order_value = tep_db_fetch_array($value_query);
		$order_value = round($order_value['value'], 0);

//// some form variables		
		
// format the form date (comes in as mm-dd-yyyy)
		$date_array = explode('-',$_POST['pickup_date']);
		$corrected_date = $date_array[2] . $date_array[0] . $date_array[1];
				
// determine whether the ship date is today or later
		if ($corrected_date == date(Ymd)) {
			$future = 'N'; // today
			}
		else {
			$future = 'Y';  // later date
			}
				
// start the array for fedex
		$shipData = array(
     	0=> 	$transaction_code // transaction code
      ,16=>   $delivery_state // delivery state
      ,13=>   $order_info['delivery_street_address'] // delivery address
      ,1273=> $_POST['packaging_type'] // packaging type (01 is customer packaging)
      ,1274=> $_POST['service_type'] // 
      ,18=>   $delivery_phone // customer's phone number
      ,15=>   $order_info['delivery_city']
      ,23=>   $_POST['bill_type'] // payment type (1 is bill to sender)
      ,117=>  $senders_country // sender's country
      ,17=>   $order_info['delivery_postcode'] // postal code it's going to
      ,50=>   $delivery_country // country it's going to
      ,11 =>	$order_info['delivery_company'] // recipient's company name
			,12=>   name_case($order_info['delivery_name']) // recipient's contact name
      ,1333=> $_POST['dropoff_type'] // drop off type (1 is regular pickup)
			,1415=> $order_value . '.00' // total order value, forced to 2 decimal places
      ,1368 => 2 // label type (2 is standard)
      ,1369 => 1 // printer type (1 is laser)
      ,1370 => 5 // label media (5 is plain paper)
      ,3002 => $_POST['package_invoice'] // invoice number
      ,25 => $_POST['package_reference'] // reference number
      ,3001 => $_POST['package_po'] // purchase order number
      ,38 => $_POST['package_department'] // department name
			,24 => $corrected_date  // ship date					
			,1119 => $future // future day shipment
			,2975 => 'Y'	// keep your fedex number off the label
	    );

// if it's home delivery (90), add the "residential delivery flag" (440)
		if ($_POST['service_type'] == 90) {
			$shipData[440] = 'Y';
			}
		else {
			$shipData[440] = 'N';
			}

// if it's an oversized shipment...
		if ($oversized) {
			$shipData[3124] = $_POST['oversized'];
			}
				
////
// if there's no meter number in the database, ask for a new one
		if (!$fedex_vars[498]) {
			$fed = new FedExDC($fedex_keys[10]);
						
// variables needed to subscribe
			$requestData = array (
				0 => 211, // 211 is the transaction code for a subscription request
				10 => $fedex_vars[10], // account number
				4003 => $fedex_vars[4], // contact name, using store name for now
				4008 => $fedex_vars[5], // street address
				4011 => $fedex_vars[7], // city
				4012 => $fedex_vars[8], // state
				4013 => $fedex_vars[9], // postal code
				4014 => $senders_country, // country
				4015 => $fedex_vars[183] // phone number
				);
						
			$keyRequest = $fed->subscribe($requestData);
// todo: add appropriate error checking for at least some of the possible errors
			if ($error = $fed->getError()) {
				echo '<pre>';
				print_r($requestData);
				echo '</pre>';
				echo '<pre>';
				print_r($keyRequest);
				echo '</pre>';
				die("ERROR: ". $error);
				}
			else {
				tep_db_query("update " . TABLE_CONFIGURATION . " set configuration_value = '" . $keyRequest[498] . "' where configuration_key = 'MODULE_SHIPPING_FEDEX1_METER'");
				$fedex_vars[498] = $keyRequest[498];
				}
			}
// end meter request

////
// put the form array together with the stuff from the database
		$shipData = $shipData+$fedex_vars;

// determine shipment type (either ground or express)
// (this is used in the call to fedexdc.php)
		if (($_POST['service_type'] == 92) or ($_POST['service_type'] == 90)) {
			$ship_type = 'ship_ground';
			}
		else {
			$ship_type = 'ship_express';
			}

////
// request shipment(s) and post data to shipping manifest

		for ($i = 1; $_POST['package_num'] >= $i; $i++) {
			
// data for shipping_manifest
			$manifest_data = array (
			delivery_id => '',
			orders_id => $order,
			delivery_name => name_case($order_info['customers_name']),
			delivery_company => '',
			delivery_address_1 => $order_info['delivery_street_address'],
			delivery_address_2 => '',
			delivery_city => $order_info['delivery_city'],
			delivery_state => $delivery_state,
			delivery_postcode => $order_info['delivery_postcode'],
			delivery_phone => $order_info['customers_telephone'],
			package_weight => $weight,
			package_value => $order_value,
			oversized => $oversized,
			pickup_date => $corrected_date,
			shipping_type => $_POST['service_type'],
			residential => $shipData[440],
			cod => '',
			);
						
// get the package weight/total weight and format it to one decimal place
			$total_weight = round($_POST['package_weight'], 1);
			$total_weight = sprintf("%01.1f", $total_weight);

// deal with multiple packages

			if ($_POST['package_num'] > 1 ) {
				$shipData[116] = $_POST['package_num'];
				$shipData[1117] = $i;
				$manifest_data['multiple'] = $i;
						
				if ($i == 1) {
					if ($debug) {
						$shipData[1400] = $total_weight;
						$package_weight = $_POST['package_' . $i . '_weight'];
						$package_weight = sprintf("%01.1f", $package_weight);
						$shipData[1401] = $package_weight;
						echo SHIPMENT_REQUEST_DATA . $i . ':<br><pre>';
						print_r($shipData);
						echo '</pre>';
						$manifest_data['tracking_num'] = 'master_trackNum';
						echo MANIFEST_DATA . $i . ':<br><pre>';
						print_r($manifest_data);
						echo '</pre>';
						}
					else {
						$shipData[1400] = $total_weight;						
						$package_weight = round($_POST['package_' . $i . '_weight'],1);
						$package_weight = sprintf("%01.1f", $package_weight);
						$shipData[1401] = $package_weight;
						$master_trackNum = tep_ship_request($shipData,$ship_type,$order);
						$manifest_data['tracking_num'] = $master_trackNum;
						}
					}
				else {
					if ($debug) {
						$shipData[1123] = 'master_trackNum';
						$package_weight = $_POST['package_' . $i . '_weight'];
						$package_weight = sprintf("%01.1f", $package_weight);
						$shipData[1401] = $package_weight;
						echo SHIPMENT_REQUEST_DATA . $i . ':<br><pre>';
						print_r($shipData);
						echo '</pre>';
						$manifest_data['tracking_num'] = 'trackNum';
						echo MANIFEST_DATA . $i . ':<br><pre>';
						print_r($manifest_data);
						echo '</pre>';
						}
					else {
						$shipData[1123] = $master_trackNum;
						$package_weight = round($_POST['package_' . $i . '_weight'],1);
						$package_weight = sprintf("%01.1f", $package_weight);
						$shipData[1401] = $package_weight;
						$trackNum = tep_ship_request($shipData,$ship_type,$order);
						$manifest_data['tracking_num'] = $trackNum;
						}
					}
				}
// for single package shipments
			elseif ($_POST['package_num'] == 1) {
				if ($debug) {
					$shipData[1401] = $total_weight;
					echo SHIPMENT_REQUEST_DATA . $i . ':<br><pre>';
					print_r($shipData);
					echo '</pre>';
					$manifest_data['tracking_num'] = 'master_trackNum';
					echo MANIFEST_DATA . $i . ':<br><pre>';
					print_r($manifest_data);
					echo '</pre>';
					}
				else {
					$shipData[1401] = $total_weight;
					$master_trackNum = tep_ship_request($shipData,$ship_type,$order);
					$manifest_data['tracking_num'] = $master_trackNum;
					}			
				}					
// post data to shipping manifest
			if ($debug==0) {
				tep_db_perform(TABLE_SHIPPING_MANIFEST, $manifest_data);
				}
			}
		
		if ($debug) {
			die(RUNNING_IN_DEBUG);
			}
				
////
// update the order record	

// if there's a master tracking number, keep it with the order
			if ($master_trackNum) {
				$trackNum = $master_trackNum;
				}
				
// store the tracking number
			tep_db_query("update " . TABLE_ORDERS . " set fedex_tracking='" . $trackNum . "' where orders_id = " . $order . "");
				
// add comment to order history
			$fedex_comments = ORDER_HISTORY_DELIVERED . $trackNum;							

// ...mark the order record "delivered"...
			$update_status = array ('orders_status' => 3);
			tep_db_perform(TABLE_ORDERS, $update_status, 'update', "orders_id = '" . $order . "'");

			if ($send_email_on_shipping) {
				$customer_notified = '1';
			}
			else {
				$customer_notified = '0';
			}
								
			tep_db_query("insert into " . TABLE_ORDERS_STATUS_HISTORY . " (orders_id, orders_status_id, date_added, customer_notified, comments) values ('" . $order . "', '3', now(), '" . $customer_notified . "', '" . $fedex_comments  . "')");

// send email automatically on shipping
			if ($send_email_on_shipping) {
		        $check_status_query = tep_db_query("select customers_name, customers_email_address, orders_status, date_purchased from " . TABLE_ORDERS . " where orders_id = '" . (int)$order . "'");
	    	    $check_status = tep_db_fetch_array($check_status_query);
	
	   			if (tep_not_null($trackNum)) {
					$email_notify_tracking = sprintf(EMAIL_TEXT_TRACKING_NUMBER) . "\n" . URL_TO_TRACK1 . nl2br(tep_output_string_protected($trackNum)) . "\n\n";
				};
				
	            $email_txt = STORE_NAME . "\n" . EMAIL_SEPARATOR . "\n" . EMAIL_TEXT_ORDER_NUMBER . ' ' . $order . "\n" . EMAIL_TEXT_INVOICE_URL . ' ' . tep_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $order, 'SSL') . "\n" . EMAIL_TEXT_DATE_ORDERED . ' ' . tep_date_long($check_status['date_purchased']) . "\n\n" . $email_notify_tracking . sprintf(EMAIL_TEXT_STATUS_UPDATE, 'Shipped');
				tep_mail($check_status['customers_name'], $check_status['customers_email_address'], EMAIL_TEXT_SUBJECT, $email_txt, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
			}
								
// ... and display the new label without manifest entry for express shipments
			$ship_type_query = tep_db_query("select shipping_type from " . TABLE_SHIPPING_MANIFEST . " where orders_id = '" . $order . "'");
			$ship_type = tep_db_fetch_array($ship_type_query);
			if ($service_type < 89) {
				$delete_manifest_query = tep_db_query("delete from " . TABLE_SHIPPING_MANIFEST . " where orders_id = '" . $order . "'");
			}
			tep_redirect('fedex_popup.php?num=' . $trackNum . '&oID=' . $order . '&multiple=' . $shipData[1117]);
	}

// end ship request

// if "action" is anything other than "ship," we can write out a regular admin page

	else {

////
// cancel a scheduled shipment

		if($action=='cancel') {
		
			if (!$order) {
				echo ERROR_NO_ORDER_SPECIFIED;
				}
			elseif ($order) {

				require(DIR_WS_INCLUDES . 'fedexdc.php');
				$transaction_code = "023";
				
// get required config variables
				$fedex_vars = array (
				10=>'MODULE_SHIPPING_FEDEX1_ACCOUNT',
				498=>'MODULE_SHIPPING_FEDEX1_METER'
				);

// determine if we're using test or production gateway
			$value_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_FEDEX1_SERVER'");
			$value = tep_db_fetch_array($value_query);
			$fedex_gateway = $value['configuration_value'];
					
			$i = 0;
			$fedex_keys = array_keys($fedex_vars);
				
			foreach($fedex_vars as $var) {
				$value_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = '" . $var . "'");
				$value = tep_db_fetch_array($value_query);
				$value = $value['configuration_value'];
		
				$fedex_vars[$fedex_keys[$i]] = $value;

				$i++;
			}					
					
// create new FedExDC object
			$fed = new FedExDC($fedex_vars[10],$fedex_vars[498]);
				
// get the tracking number from the order record
			$fedex_tracking_query = tep_db_query("select fedex_tracking from " . TABLE_ORDERS . " where orders_id = '" . $order . "'");
			$r = tep_db_fetch_array($fedex_tracking_query);
			$fedex_tracking = $r['fedex_tracking'];
			
// get the shipment type from the shipping manifest
			$ship_type_query = tep_db_query("select shipping_type from " . TABLE_SHIPPING_MANIFEST . " where orders_id = '" . $order . "'");
			$ship_type = tep_db_fetch_array($ship_type_query);
			if (($ship_type['shipping_type'] == 90) or ($ship_type['shipping_type'] == 92)) {
				$ship_type = 'FDXG';
				}
			else {
				$ship_type = 'FDXE';
				}
				
// simple array with transaction code, tracking number, carrier code
			$cancelData = array (
				0 => $transaction_code,
				1 => ORDER_NUMBER . $order, // order number, optional
				29 => $fedex_tracking,
				3025 => $ship_type
				);
				
			$cancelData = $fedex_keys+$cancelData;
				
// remove shipment data from the shipping manifest
			$delete_manifest_query = tep_db_query("delete from " . TABLE_SHIPPING_MANIFEST . " where orders_id = '" . $order . "'");
			if ($delete_manifest_query) {
				}
			elseif (!$delete_manifest_query) {
				echo COULD_NOT_DELETE_ENTRIES;
				} 

// cancel the shipment
			$cancelRet = $fed->cancel_ground($cancelData);
				
// todo: add appropriate error checking for at least some of the possible errors
			if ($error = $fed->getError()) {
				die(ERROR . $error);
				}
		
// delete the tracking number from the order record
			$delete_trackNum = array('fedex_tracking' => '');
	
			tep_db_perform(TABLE_ORDERS, $delete_trackNum, 'update', "orders_id = '" . $order . "'");

// ...mark the order record "pending"...
			$update_status = array ('orders_status' => 2);
			tep_db_perform(TABLE_ORDERS, $update_status, 'update', "orders_id = '" . $order . "'");

// ...add a comment to the order history to show what we've done...
			$fedex_comments = ORDER_HISTORY_CANCELLED . $trackNum;
					
			tep_db_query("insert into " . TABLE_ORDERS_STATUS_HISTORY . " (orders_id, orders_status_id, date_added, customer_notified, comments) values ('" . $order . "', 2, now(), '', '" . $fedex_comments  . "')");

// ...delete the record from the manifest...
			tep_db_query("delete from " . TABLE_SHIPPING_MANIFEST . " where orders_id = '" . $order . "'");
			
// ...and refresh the orders page
			tep_redirect(FILENAME_ORDERS . '?oID=' . $order);
			}
		}

////
// make the form for additional shipment information
	
	elseif($action=='new') {
		$order = $_GET['oID'];

// determine if we're using test or production gateway
		$value_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_FEDEX1_SERVER'");
		$value = tep_db_fetch_array($value_query);
		$fedex_gateway = $value['configuration_value'];
			
// arrays for shipping options; include as many or as few as you like
		$packaging_type = array();
		$packaging_type[] = array('id' => '01', 'text' => 'Other Packaging');
		$packaging_type[] = array('id' => '02', 'text' => 'FedEx Pak');
		$packaging_type[] = array('id' => '03', 'text' => 'FedEx Box');
		$packaging_type[] = array('id' => '04', 'text' => 'FedEx Tube');
		$packaging_type[] = array('id' => '06', 'text' => 'FedEx Envelope');
			

		$service_type = array();
		$service_type[] = array('id' => '92', 'text' => 'FedEx Ground Service');
		$service_type[] = array('id' => '01', 'text' => 'FedEx Priority');
		$service_type[] = array('id' => '03', 'text' => 'FedEx 2day');
		$service_type[] = array('id' => '05', 'text' => 'FedEx Standard Overnight');
		$service_type[] = array('id' => '06', 'text' => 'FedEx First Overnight');
		$service_type[] = array('id' => '20', 'text' => 'FedEx Express Saver');
		$service_type[] = array('id' => '70', 'text' => 'FedEx 1day Freight');
		$service_type[] = array('id' => '80', 'text' => 'FedEx 2day Freight');
		$service_type[] = array('id' => '83', 'text' => 'FedEx 3dayFreight');
		$service_type[] = array('id' => '90', 'text' => 'FedEx Home Delivery');
			
		$bill_type = array();
		$bill_type[] = array('id' => '01', 'text' => 'Bill sender (Prepaid)');
		$bill_type[] = array('id' => '02', 'text' => 'Bill recipient');
		$bill_type[] = array('id' => '03', 'text' => 'Bill third party');
		$bill_type[] = array('id' => '04', 'text' => 'Bill credit card');
		$bill_type[] = array('id' => '05', 'text' => 'Bill recipient for FedEx Ground');

		$dropoff_type = array();
		$dropoff_type[] = array('id' => 1, 'text' => 'Regular pickup');
		$dropoff_type[] = array('id' => 2, 'text' => 'Request courier');
		$dropoff_type[] = array('id' => 3, 'text' => 'Drop box');
		$dropoff_type[] = array('id' => 4, 'text' => 'Drop at BSC');
		$dropoff_type[] = array('id' => 5, 'text' => 'Drop at station');

		$oversized = array();
		$oversized[] = array('id' => 0, 'text' => '');
		$oversized[] = array('id' => 1, 'text' => 1);
		$oversized[] = array('id' => 2, 'text' => 2);
		$oversized[] = array('id' => 3, 'text' => 3);
								
// get & format tomorrow's date for default pickup date
		$default_pickup_date = date('m-d-Y',strtotime('today'));
		
// get the shipping method
		$shipping_query = tep_db_query("select title from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . $order . "' and class='ot_shipping'");
		$shipping_method = tep_db_fetch_array($shipping_query);
		$shipping_method = trim($shipping_method['title'], ':');
		
		$shipping_method_keywords = array('90' => 'Home Delivery', 
										  '92' => 'Ground Service', 
										  '01' => 'Priority', 
										  '03' => '2 Day Air', 
										  '05' => 'Standard Overnight', 
										  '06' => 'First Overnight', 
										  '20' => 'Express Saver');
	
		$shipping_type='92'; // default to Fedex Ground								  
		while (list($shipping_index, $shipping_keyword) = each($shipping_method_keywords)){					
			if (false !== strpos($shipping_method, $shipping_keyword)){
	    		  $shipping_type=$shipping_index;
	    		  break 1;
	    	}
    	}
    	   		
// get orders information
		$order_query = tep_db_query("select * from orders where orders_id = $order");	
		$order_info = tep_db_fetch_array($order_query);

		// abbreviate the delivery country (function is in abbreviate.php)
		$delivery_country = $order_info['delivery_country'];
 		
// get the order qty and item weights
		$order_qty_query = tep_db_query("select * from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . $order . "'");
		$order_qty = 0;
		$order_weight = 0;
		$order_item_html = '';
		if (tep_db_num_rows($order_qty_query)) {
      		while ($order_qtys = tep_db_fetch_array($order_qty_query)){
	      		$order_item_html = $order_item_html . '          <tr>' . "\n" .
             		'            <td class="smallText" align="center">' . $order_qtys['products_quantity'] . ' * ' .
             		$order_qtys['products_name'] . '</td>' . "\n" .
             		'            <td class="smallText" align="center">';
            	$order_qty = $order_qty + $order_qtys['products_quantity'];
            	$products_id = $order_qtys['products_id'];
				$products_weight_query = tep_db_query("select * from " . TABLE_PRODUCTS . " where products_id = '" . $products_id . "'");
				if (tep_db_num_rows($products_weight_query)) {
					$products_weights = tep_db_fetch_array($products_weight_query);
					$order_weight = $order_weight + ($order_qtys['products_quantity'] * ($products_weights['products_weight']));
					$item_weights[] = $products_weights['products_weight'];
				}
        	}
			$order_weight = $order_weight + SHIPPING_BOX_WEIGHT;
			$order_weight = round($order_weight,1);
			$order_weight = sprintf("%01.1f", $order_weight);
		}
 	}

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/javascript/jquery-ui-1.8.2.custom.css">
<script type="text/javascript" src="includes/general.js"></script>

<script type="text/javascript">
function validate() {
	weight=ship_fedex.package_weight.value;
	if (weight=='') {
		alert('<?php echo ENTER_PACKAGE_WEIGHT; ?>');
		event.returnValue=false;
		}
	package_num=ship_fedex.package_num.value;
	if (package_num=='') {
		alert('<?php echo ENTER_NUMBER_PACKAGES; ?>');
		event.returnValue=false;
		}
	}
</script>

</head>
<body>
<!-- header //-->
<?php
  require(DIR_WS_INCLUDES . 'header.php');
?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
<?php
	// if it's a new shipment, write out the form for more data
	if ($action=='new') {
?>
          <tr>
            <td class="pageHeading"><?php 
						echo HEADING_TITLE;
						if ($order) {
							echo ', ' . ORDER_NUMBER . $order;
							}
						elseif (!$order) {
							echo ERROR_NO_ORDER_SPECIFIED;
							}
						?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
            <td class="pageHeading" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_ORDERS, 'oID=' . $order) . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
            <?php echo $order_item_html;?>

          </tr>
        </table></td>
      </tr>
      <tr>
        <td>
        		<?php
        			// if quantity = 1, skip to shipping directly
        			if ($order_qty == 1){
					    echo tep_draw_form('ship_fedex', FILENAME_SHIP_FEDEX, 'cPath=' . $cPath . '&cID=' . $_GET['cID'] . '&oID=' . $order . '&action=ship', 'post', 'enctype="multipart/form-data"  onsubmit="validate();"');
					}
					// otherwise, go to a 2nd screen to key in individual weights
					else {
						echo tep_draw_form('ship_fedex', FILENAME_SHIP_FEDEX, 'cPath=' . $cPath . '&cID=' . $_GET['cID'] . '&oID=' . $order . '&action=post1', 'post', 'enctype="multipart/form-data"  onsubmit="validate();"');
					}
				?>
					<input type="hidden" name="order_item_html" value='<?php echo urlencode(serialize($order_item_html)); ?>'/>
					<input type="hidden" name="item_weights" value='<?php echo urlencode(serialize($item_weights)); ?>'/>
					<input type="hidden" name="fedex_gateway" value="<?php echo $fedex_gateway; ?>"/>
					<table width="70%" border="0" cellspacing="0" cellpadding="2">
          	<tr>
          	  <td colspan="3"><?php echo tep_draw_separator('pixel_trans.gif', '1', '15'); ?></td>
          	</tr>
          				<tr>
							<td class="main" align="right"><b><u>Required Fields</u></b></td>
							<td></td>
							<td></td>
						</tr>
						
						<tr>
							<td class="main" align="right">Number of Packages:</td>
							<td class="main">&nbsp;</td>
							<td class="main"><?php echo tep_draw_input_field('package_num',$order_qty,'size="2"'); ?></td>
						</tr>
						<tr>
							<td class="main" align="right">Oversized?</td>
							<td class="main">&nbsp;</td>
							<td class="main"><?php echo tep_draw_pull_down_menu('oversized',$oversized); ?></td>
						</tr>
						<tr>
							<td class="main" align="right">Packaging Type ("other" for ground shipments):</td>
							<td class="main">&nbsp;</td>
							<td class="main"><?php echo tep_draw_pull_down_menu('packaging_type',$packaging_type); ?></td>
						</tr>
						<tr>
							<td class="main" align="right">Type of Service:</td>
							<td class="main">&nbsp;</td>
							<td class="main"><?php echo tep_draw_pull_down_menu('service_type',$service_type, $shipping_type); ?></td>
						</tr>
						<tr>
							<td class="main" align="right">Payment Type:</td>
							<td class="main">&nbsp;</td>
							<td class="main"><?php echo tep_draw_pull_down_menu('bill_type',$bill_type); ?></td>
						</tr>
						<tr>
							<td class="main" align="right">Dropoff Type:</td>
							<td class="main">&nbsp;</td>
							<td class="main"><?php echo tep_draw_pull_down_menu('dropoff_type',$dropoff_type); ?></td>
						</tr>
						<tr>
							<td class="main" align="right">Pickup date (yyyymmdd):</td>
							<td class="main">&nbsp;</td>
							<td class="main"><?php echo tep_draw_input_field('pickup_date',$default_pickup_date,'size="9"'); ?></td>
						</tr>

						<tr>
						<?php
							if ($package_num > 1) {
								echo '<td class="main" align="right">' . TOTAL_WEIGHT . '</td>';
								}
							else {
								echo '<td class="main" align="right">' . PACKAGE_WEIGHT . '</td>';
								}
						?>
								<td class="main">&nbsp;</td>
								<td class="main"><?php echo tep_draw_input_field('package_weight',(string) $order_weight,'size="2"'); ?></td>
						</tr>
						
						<tr>
						  <td class="main">&nbsp;</td>
						</tr>
						<tr>
							<td class="main" align="right"><b><u>Optional Fields</u></b></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td class="main" align="right">Invoice #:</td>
							<td class="main">&nbsp;</td>
							<td class="main"><?php echo tep_draw_input_field('package_invoice','','size="33" maxlength="30"'); ?></td>
						</tr>
						<tr>
							<td class="main" align="right">Reference #:</td>
							<td class="main">&nbsp;</td>
							<td class="main"><?php echo tep_draw_input_field('package_reference','','size="33" maxlength="30"'); ?></td>
						</tr>
						<tr>
							<td class="main" align="right">Purchase Order #:</td>
							<td class="main">&nbsp;</td>
							<td class="main"><?php echo tep_draw_input_field('package_po',$order,'size="33" maxlength="30"'); ?></td>
						</tr>
						<tr>
							<td class="main" align="right">Department Name:</td>
							<td class="main">&nbsp;</td>
							<td class="main"><?php echo tep_draw_input_field('package_department','','size="10" maxlength="10"'); ?></td>
						</tr>
																		
						<tr>
							<td colspan="3"><?php echo tep_draw_separator('pixel_trans.gif', '1', '15'); ?></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><?php echo tep_image_submit('button_submit.gif', IMAGE_SUBMIT); ?></td>
						<tr>
					</table>
		</form>
<?php
		}
		
	// new form accepts total weight and individual weights
	// if there are multiple packages
	elseif ($action=='post1') {
		$package_num = $_POST['package_num'];
		$order_item_html = unserialize(urldecode($_POST['order_item_html']));
		$item_weights = unserialize(urldecode($_POST['item_weights']));
?>		
          <tr>
            <td class="pageHeading"><?php 
						echo HEADING_TITLE;
						if ($order) {
							echo ', ' . ORDER_NUMBER . $order;
							}
						elseif (!$order) {
							echo ERROR_NO_ORDER_SPECIFIED;
							}
						?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
            <td class="pageHeading" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_ORDERS, 'oID=' . $order) . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
            <?php echo $order_item_html;?>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>
					<?php echo tep_draw_form('ship_fedex', FILENAME_SHIP_FEDEX, 'cPath=' . $cPath . '&cID=' . $_GET['cID'] . '&oID=' . $order . '&action=ship', 'post', 'enctype="multipart/form-data"  onsubmit="validate();"'); ?>
					<input type="hidden" name="fedex_gateway" value="<?php echo $fedex_gateway; ?>"/>
					<input type="hidden" name="package_num" value = "<?php echo $package_num; ?>"/>
					<input type="hidden" name="oversized" value="<?php echo $_POST['oversized']; ?>"/>
					<input type="hidden" name="residential" value="<?php echo $_POST['residential']; ?>"/>
					<input type="hidden" name="packaging_type" value="<?php echo $_POST['packaging_type']; ?>"/>
					<input type="hidden" name="service_type" value="<?php echo $_POST['service_type']; ?>"/>
					<input type="hidden" name="payment_type" value="<?php echo $_POST['payment_type']; ?>"/>
					<input type="hidden" name="bill_type" value="<?php echo $_POST['bill_type']; ?>"/>
					<input type="hidden" name="dropoff_type" value="<?php echo $_POST['dropoff_type']; ?>"/>
					<input type="hidden" name="pickup_date" value="<?php echo $_POST['pickup_date']; ?>"/>
					<input type="hidden" name="package_invoice" value="<?php echo $_POST['package_invoice']; ?>"/>
					<input type="hidden" name="package_reference" value="<?php echo $_POST['package_reference']; ?>"/>
					<input type="hidden" name="package_po" value="<?php echo $_POST['package_po']; ?>"/>
					<input type="hidden" name="package_department" value="<?php echo $_POST['package_department']; ?>"/>
					<table width="70%" border="0" cellspacing="0" cellpadding="2">
          	<tr>
          	  <td colspan="3"><?php echo tep_draw_separator('pixel_trans.gif', '1', '15'); ?></td>
          	</tr>
						<tr>
							<td class="main" align="right">
<?php
						if ($package_num > 1) {
							echo TOTAL_WEIGHT . '</td>';
							}
						else {
							echo PACKAGE_WEIGHT . '</td>';
							}
?>
							<td class="main">&nbsp;</td>
							<td class="main"><?php echo tep_draw_input_field('package_weight','','size="2"'); ?></td>
						</tr>

<?php
						if ($package_num > 1) {
							echo '<tr>';
							for ($i = 1; $i <= $package_num; $i++) {
								echo '<td class="main" align="right">Package #' . $i . ' Weight:</td>';
								echo '<td class="main">&nbsp;</td>';
								$item_weight_rounded = sprintf("%01.1f", array_pop($item_weights));
								echo '<td class="main">' . tep_draw_input_field('package_' . $i . '_weight', $item_weight_rounded, 'size="2"') . '</td>';
								$div = $i/3;
								if (is_int($div) && ($i != $package_num)) {
									echo '</tr><tr>';
									}
								}
							echo '</tr>';
						}
?>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td><?php echo tep_image_submit('button_submit.gif', IMAGE_SUBMIT); ?></td>
						<tr>
					</table>
					</form>
<?php
			}
?>
					</td>
						
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); 
}
?>	