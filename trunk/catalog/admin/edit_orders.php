<?php
/*
$Id: edit_orders.php 14 2006-07-28 17:42:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
  
  Original file written by Jonathan Hilgeman of SiteCreative.com
    
*/
  
  // First things first: get the required includes, classes, etc.
  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();
  
  include(DIR_WS_CLASSES . 'order.php');

  //set a default tax class
  //shipping tax is added to the default tax class
   $default_tax_class = 1; 
   
 // Then we get down to the nitty gritty
   $orders_statuses = array();
  $orders_status_array = array();
  $orders_status_query = tep_db_query("select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$languages_id . "'");
  while ($orders_status = tep_db_fetch_array($orders_status_query)) {
    $orders_statuses[] = array('id' => $orders_status['orders_status_id'],
                               'text' => $orders_status['orders_status_name']);
    $orders_status_array[$orders_status['orders_status_id']] = $orders_status['orders_status_name'];
  }

  $action = (isset($_GET['action']) ? $_GET['action'] : 'edit');

  // Update Inventory Quantity
  if (tep_not_null($action)) {
    switch ($action) {
    	
	// 1. UPDATE ORDER ###############################################################################################
	case 'update_order':
		
		$oID = tep_db_prepare_input($_GET['oID']);
		$order = new order($oID);
		$status = tep_db_prepare_input($_POST['status']);
		//tax business
		//Following three functions are defined in includes/functions/general.php
		$countryid = tep_get_country_id($_POST['update_delivery_country']);
		$zoneid = tep_get_zone_id($countryid, $_POST['update_delivery_state']);
		$default_tax_name  = tep_get_tax_description($default_tax_class, $countryid, $zoneid);
		
		// 1.1 UPDATE ORDER INFO #####
		
		$UpdateOrders = "UPDATE " . TABLE_ORDERS . " SET 
	    customers_name = '" . tep_db_input(stripslashes($_POST['update_customer_name'])) . "',
	    customers_company = '" . tep_db_input(stripslashes($_POST['update_customer_company'])) . "',
	    customers_street_address = '" . tep_db_input(stripslashes($_POST['update_customer_street_address'])) . "',
	    customers_suburb = '" . tep_db_input(stripslashes($_POST['update_customer_suburb'])) . "',
	    customers_city = '" . tep_db_input(stripslashes($_POST['update_customer_city'])) . "',
	    customers_state = '" . tep_db_input(stripslashes($_POST['update_customer_state'])) . "',
	    customers_postcode = '" . tep_db_input($_POST['update_customer_postcode']) . "',
	    customers_country = '" . tep_db_input(stripslashes($_POST['update_customer_country'])) . "',
	    customers_telephone = '" . tep_db_input($_POST['update_customer_telephone']) . "',
	    customers_email_address = '" . tep_db_input($_POST['update_customer_email_address']) . "',";
		
		$UpdateOrders .= "
		billing_name = '" . tep_db_input(stripslashes($_POST['update_billing_name'])) . "',
		billing_company = '" . tep_db_input(stripslashes($_POST['update_billing_company'])) . "',
	    billing_street_address = '" . tep_db_input(stripslashes($_POST['update_billing_street_address'])) . "',
		billing_suburb = '" . tep_db_input(stripslashes($_POST['update_billing_suburb'])) . "',
		billing_city = '" . tep_db_input(stripslashes($_POST['update_billing_city'])) . "',
		billing_state = '" . tep_db_input(stripslashes($_POST['update_billing_state'])) . "',
		billing_postcode = '" . tep_db_input($_POST['update_billing_postcode']) . "',
		billing_country = '" . tep_db_input(stripslashes($_POST['update_billing_country'])) . "',";
		
		$UpdateOrders .= "
		delivery_name = '" . tep_db_input(stripslashes($_POST['update_delivery_name'])) . "',
		delivery_company = '" . tep_db_input(stripslashes($_POST['update_delivery_company'])) . "',
		delivery_street_address = '" . tep_db_input(stripslashes($_POST['update_delivery_street_address'])) . "',
		delivery_suburb = '" . tep_db_input(stripslashes($_POST['update_delivery_suburb'])) . "',
		delivery_city = '" . tep_db_input(stripslashes($_POST['update_delivery_city'])) . "',
		delivery_state = '" . tep_db_input(stripslashes($_POST['update_delivery_state'])) . "',
		delivery_postcode = '" . tep_db_input($_POST['update_delivery_postcode']) . "',
		delivery_country = '" . tep_db_input(stripslashes($_POST['update_delivery_country'])) . "',
               	payment_method = '" . tep_db_input(stripslashes($_POST['update_info_payment_method'])) . "',
		cc_type = '" . tep_db_input($_POST['update_info_cc_type']) . "',
		cc_owner = '" . tep_db_input($_POST['update_info_cc_owner']) . "',
		cc_number = '" . tep_db_input($_POST['update_info_cc_number']) . "',
		cc_expires = '" . tep_db_input($_POST['update_info_cc_expires']) . "',
		shipping_tax = '" . tep_db_input($_POST['update_shipping_tax']) . "'";
		
		$UpdateOrders .= " where orders_id = '" . tep_db_input($_GET['oID']) . "';";

		tep_db_query($UpdateOrders);
		$order_updated = true;

    // 1.2 UPDATE STATUS HISTORY & SEND EMAIL TO CUSTOMER IF NECESSARY #####

    $check_status_query = tep_db_query("SELECT
	customers_name, customers_email_address, orders_status, date_purchased 
	FROM " . TABLE_ORDERS . " WHERE orders_id = '" . (int)$oID . "'");
    $check_status = tep_db_fetch_array($check_status_query); 
	
  if (($check_status['orders_status'] != $_POST['status']) || (tep_not_null($_POST['comments']))) {

        tep_db_query("UPDATE " . TABLE_ORDERS . " SET 
					  orders_status = '" . tep_db_input($_POST['status']) . "', 
                      last_modified = now() 
                      WHERE orders_id = '" . (int)$oID . "'");
		
		 // Notify Customer ?
      $customer_notified = '0';
			if (isset($_POST['notify']) && ($_POST['notify'] == 'on')) {
			  $notify_comments = '';
			  if (isset($_POST['notify_comments']) && ($_POST['notify_comments'] == 'on')) {
			    $notify_comments = sprintf(EMAIL_TEXT_COMMENTS_UPDATE, $_POST['comments']) . "\n\n";
			  }
			  $email = STORE_NAME . "\n" . EMAIL_SEPARATOR . "\n" . EMAIL_TEXT_ORDER_NUMBER . ' ' . $oID . "\n" . EMAIL_TEXT_INVOICE_URL . ' ' . tep_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $oID, 'SSL') . "\n" . EMAIL_TEXT_DATE_ORDERED . ' ' . tep_date_long($check_status['date_purchased']) . "\n\n" . sprintf(EMAIL_TEXT_STATUS_UPDATE, $orders_status_array[$status]) . $notify_comments . sprintf(EMAIL_TEXT_STATUS_UPDATE2);
			  tep_mail($check_status['customers_name'], $check_status['customers_email_address'], EMAIL_TEXT_SUBJECT, $email, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
			  $customer_notified = '1';
			}			  
          		
			tep_db_query("INSERT into " . TABLE_ORDERS_STATUS_HISTORY . " 
			(orders_id, orders_status_id, date_added, customer_notified, comments) 
			values ('" . tep_db_input($_GET['oID']) . "', 
				'" . tep_db_input($_POST['status']) . "', 
				now(), 
				" . tep_db_input($customer_notified) . ", 
				'" . tep_db_input($_POST['comments'])  . "')");
			}

	// 1.3 UPDATE PRODUCTS #####
		$RunningSubTotal = 0;
		$RunningTax = array($default_tax_name => 0);

    // Do pre-check for subtotal field existence
		$ot_subtotal_found = false;
		$ot_total_found = false;
		if (is_array ($_POST['update_totals'])) {
	foreach($_POST['update_totals'] as $total_details) {
		  extract($total_details,EXTR_PREFIX_ALL,"ot");
			if($ot_class == "ot_subtotal") {
			  $ot_subtotal_found = true;
    	break;
			}
			
			if($ot_class == "ot_total"){
			$ot_total_found = true;
			break;
			}
		}//end foreach() 
		}//end if (is_array())
		        
		// 1.3.1 Update orders_products Table
		if (is_array ($_POST['update_products'])){
		foreach($_POST['update_products'] as $orders_products_id => $products_details)	{
		if (!tep_not_null($products_details["qty"])) $products_details["qty"] = 0;
		
			// 1.3.1.1 Update Inventory Quantity
			$order_query = tep_db_query("SELECT products_id, products_quantity 
			FROM " . TABLE_ORDERS_PRODUCTS . " 
			WHERE orders_id = '" . (int)$oID . "'
			AND orders_products_id = '$orders_products_id'");
			$order = tep_db_fetch_array($order_query);
			
			// First we do a stock check 
			
			if ($products_details["qty"] != $order['products_quantity']){
			$quantity_difference = ($products_details["qty"] - $order['products_quantity']);
				if (STOCK_CHECK == 'true'){
				    tep_db_query("UPDATE " . TABLE_PRODUCTS . " SET 
					products_quantity = products_quantity - " . $quantity_difference . ",
					products_ordered = products_ordered + " . $quantity_difference . " 
					WHERE products_id = '" . (int)$order['products_id'] . "'");
					} else {
					tep_db_query ("UPDATE " . TABLE_PRODUCTS . " SET
					products_ordered = products_ordered + " . $quantity_difference . "
					WHERE products_id = '" . (int)$order['products_id'] . "'");
				}
			}
               
			 //Then we check if the product should be deleted  
			 if (isset($products_details['delete'])){
			 //update quantities first
			 if (STOCK_CHECK == 'true'){
				    tep_db_query("UPDATE " . TABLE_PRODUCTS . " SET 
					products_quantity = products_quantity + " . $products_details["qty"] . ",
					products_ordered = products_ordered - " . $products_details["qty"] . " 
					WHERE products_id = '" . (int)$order['products_id'] . "'");
					} else {
					tep_db_query ("UPDATE " . TABLE_PRODUCTS . " SET
					products_ordered = products_ordered - " . $products_details["qty"] . "
					WHERE products_id = '" . (int)$order['products_id'] . "'");
					}
					
			//then delete the little bugger
			$Query = "DELETE FROM " . TABLE_ORDERS_PRODUCTS . " 
			WHERE orders_id = '" . (int)$oID . "' 
			AND orders_products_id = '$orders_products_id';";
				tep_db_query($Query);
							
				// and all its attributes
				if(isset($products_details[attributes]))
				{
				$Query = "DELETE FROM " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " 
				WHERE orders_id = '" . (int)$oID . "' 
				AND orders_products_id = '$orders_products_id';";
				tep_db_query($Query);
				}
				
			
			}// end of if (isset($products_details['delete']))
			
			   else { // if we don't delete, we update
				$Query = "UPDATE " . TABLE_ORDERS_PRODUCTS . " SET
					products_model = '" . $products_details["model"] . "',
					products_name = '" . tep_html_quotes($products_details["name"]) . "',
					products_price = '" . $products_details["price"] . "',
					final_price = '" . $products_details["final_price"] . "',
					products_tax = '" . $products_details["tax"] . "',
					products_quantity = '" . $products_details["qty"] . "'
					WHERE orders_id = '" . (int)$oID . "'
					AND orders_products_id = '$orders_products_id';";
				tep_db_query($Query);
                        	
   				//update subtotal and total during update function
				if (DISPLAY_PRICE_WITH_TAX == 'true') {
				$RunningSubTotal += (($products_details['tax']/100 + 1) * ($products_details['qty'] * $products_details['final_price'])); 
				} else {
				$RunningSubTotal += $products_details["qty"] * $products_details["final_price"];
				}
                
				$RunningTax[$products_details['tax_description']] += (($products_details['tax']/100) * ($products_details['qty'] * $products_details['final_price']));
				
				// Update Any Attributes
				if(isset($products_details[attributes]))
				{ foreach($products_details["attributes"] as $orders_products_attributes_id => $attributes_details) {
					$Query = "UPDATE " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " set
						products_options = '" . $attributes_details["option"] . "',
						products_options_values = '" . $attributes_details["value"] . "',
						options_values_price ='" . $attributes_details["price"] . "',
						price_prefix ='" . $attributes_details["prefix"] . "'
						where orders_products_attributes_id = '$orders_products_attributes_id';";
						tep_db_query($Query);
					}//end of foreach($products_details["attributes"]
				}// end of if(isset($products_details[attributes]))
				}// end of if/else (isset($products_details['delete']))
			
		}//end of foreach
		}//end of if (is_array())
		
		// 1.4 UPDATE SHIPPING, CUSTOM FEES, DISOUNTS, TAXES, AND TOTALS #####
		
	// 1.4.0.1 Shipping Tax
		 	
			if (is_array ($_POST['update_totals'])){
			foreach($_POST['update_totals'] as $total_index => $total_details)
			{
				extract($total_details,EXTR_PREFIX_ALL,"ot");
				if($ot_class == "ot_shipping")//a good place to add in custom total components
				{
				    if (DISPLAY_PRICE_WITH_TAX == 'true') {//the shipping charge includes tax
			$RunningTax[$default_tax_name] += ($ot_value * $_POST['update_shipping_tax']) / ($_POST['update_shipping_tax'] + 100);
					} else { //shipping tax is in addition to the shipping charge
	$RunningTax[$default_tax_name] += (($_POST['update_shipping_tax'] / 100) * $ot_value);
					}
				}
			  }
		    }
		
		//1.4.1.0
		$RunningTotal = 0;
		$sort_order = 0;
			
			// 1.4.1.1  If ot_tax doesn't exist, but $RunningTax has been calculated, create an appropriate entry in the db and add tax to the subtotal or total as appropriate
			if (array_sum($RunningTax) != 0) {
			foreach ($RunningTax as $key => $val) {
			
			if (is_array ($_POST['update_totals'])){//1
			foreach($_POST['update_totals'] as $total_details)	{//2
				extract($total_details,EXTR_PREFIX_ALL,"ot");
				$ot_tax_found = 0;
				 if (($ot_class == "ot_tax") && (preg_replace("/:$/","",$ot_title) == $key))
				 {//3
					$ot_tax_found = 1;
					break;
					}//end 3
				}//end 2
//bizzarro code needed to input text value into db properly
//I still don't understand why 
//text = '" . $currencies->format($val, true, $order->info['currency'], $order->info['currency_value']) . "', 
//isn't adequate.  Maybe I never will
	if ($ot_class == "ot_total" || $ot_class == "ot_tax" || $ot_class == "ot_subtotal" || 
	$ot_class == "ot_shipping" || $ot_class == "ot_custom" || $ot_class == "ot_loworderfee") {
		$order = new order($oID);
        $RunningTax[$default_tax_name] += 0 * $products_details['tax'] / $order->info['currency_value'] / 100 ; 
		  }//end bizarro code
				}// end 1
			
				if (($val > 0) && ($ot_tax_found != 1)) {
				$sort_order++;
			$Query = "INSERT INTO " . TABLE_ORDERS_TOTAL . " SET
			orders_id = '" . (int)$oID . "',
			title ='" . $key . ":',
            text = '" . $currencies->format($val, true, $order->info['currency'], $order->info['currency_value']) . "',
		    value = '" . $val . "',
			class = 'ot_tax',
			sort_order = '2'";
			tep_db_query($Query);
			$ot_tax_found = 1;
						
			if (DISPLAY_PRICE_WITH_TAX != 'true') {
				 $RunningTotal += $val;
				} //end if (DISPLAY_PRICE_WITH_TAX != 'true')
				} //end if (($val > 0) && ($ot_tax_found != 1)) {
			 } //end foreach ($RunningTax as $key => $val)
		} //end if (array_sum($RunningTax) != 0)
						
  ////////////////////OPTIONAL- create entries for subtotal and/or total if none exists
				/*			
			//1.4.1.2
			/////////////////////////Add in subtotal to db if it doesn't already exist
			if (($RunningSubTotal >0) && ($ot_subtotal_found != true)) {
				$Query = 'INSERT INTO ' . TABLE_ORDERS_TOTAL . ' SET
							orders_id = "' . (int)$oID . '",
							title ="' . ENTRY_SUB_TOTAL . '",
							text = "' . $currencies->format($RunningSubTotal, true, $order->info['currency'], $order->info['currency_value']) . '",
				            value = "' . $RunningSubTotal . '",
							class = "ot_subtotal",
							sort_order = "1"';
						tep_db_query($Query);
						$ot_subtotal_found = true;
						$RunningTotal += $RunningSubTotal;
						}
						
						//1.4.1.3
  /////////////////////////Add in total to db if it doesn't already exist
			if (($RunningTotal >0) && ($ot_total_found != true)) {
				$Query = 'INSERT INTO ' . TABLE_ORDERS_TOTAL . ' SET
							orders_id = "' . (int)$oID . '",
							title ="' . ENTRY_TOTAL . '",
							text = "' . $currencies->format($RunningTotal, true, $order->info['currency'], $order->info['currency_value']) . '",
				            value = "' . $RunningTotal . '",
							class = "ot_total",
							sort_order = "4"';
						tep_db_query($Query);
						$ot_total_found = true;
						}
						*/
  //////////////////////////end optional section
						
	// 1.4.2. Summing up total
			if (is_array ($_POST['update_totals'])) {
			foreach($_POST['update_totals'] as $total_index => $total_details)	{ 
			
			extract($total_details,EXTR_PREFIX_ALL,"ot");
			if (trim($ot_title)) {
			     $sort_order++;
					
					if ($ot_class == "ot_subtotal") {
						$ot_value = $RunningSubTotal;
					}	
										
					if ($ot_class == "ot_tax") {
						$ot_value = $RunningTax[preg_replace("/:$/","",$ot_title)];
					}

				   	if ($ot_class == "ot_total") {
					$ot_value = $RunningTotal;
				         		          
				    if ( !$ot_subtotal_found ) 
				    { // There was no subtotal on this order, lets add the running subtotal in.
				     $ot_value +=  $RunningSubTotal;
				     }
				     }
									
			  // Set $ot_text (display-formatted value)
              $order = new order($oID);
              $ot_text = $currencies->format($ot_value, true, $order->info['currency'], $order->info['currency_value']);
						
				if ($ot_class == "ot_total") {
				$ot_text = "<b>" . $ot_text . "</b>";
					}
					
					if($ot_total_id > 0) { // Already in database --> Update
						$Query = "UPDATE " . TABLE_ORDERS_TOTAL . " SET
							title = '" . $ot_title . "',
							text = '" . $ot_text . "',
							value = '" . $ot_value . "',
							sort_order = '" . $sort_order . "'
							WHERE orders_total_id = '". $ot_total_id . "'
							AND orders_id = '" . (int)$oID . "'";
						tep_db_query($Query);
					} else { // New Insert (ie ot_custom)
						$Query = "INSERT INTO " . TABLE_ORDERS_TOTAL . " SET
							orders_id = '" . (int)$oID . "',
							title = '" . $ot_title . "',
							text = '" . $ot_text . "',
							value = '" . $ot_value . "',
							class = '" . $ot_class . "',
							sort_order = '" . $sort_order . "'";
						tep_db_query($Query);
					}
										
					if ($ot_class == "ot_tax") {
					
					if (DISPLAY_PRICE_WITH_TAX != 'true') { 
					//we don't add tax to the total here because it's already added to the subtotal
						$RunningTotal += $ot_value;
						}
						} else {
						$RunningTotal += $ot_value;
						}
				}
				
	if (!trim($ot_value) && ($ot_class != "ot_shipping") && ($ot_class != "ot_subtotal") && ($ot_class != "ot_total")) { // value = 0 => Delete Total Piece
				
					$Query = "DELETE from " . TABLE_ORDERS_TOTAL . " 
					WHERE orders_id = '" . (int)$oID . "' 
					AND orders_total_id = '$ot_total_id'";
					tep_db_query($Query);
				}
				
		}
}//end if (is_array())
		
		// 1.5 SUCCESS MESSAGE #####
		
		if ($order_updated)	{
			$messageStack->add_session(SUCCESS_ORDER_UPDATED, 'success');
		}

		tep_redirect(tep_href_link(FILENAME_ORDERS_EDIT, tep_get_all_get_params(array('action')) . 'action=edit'));
		
	break;

	// 2. ADD A PRODUCT ###############################################################################################
	case 'add_product':
	
		if($_POST['step'] == 5)
		{
		// 2.1 GET ORDER INFO #####
			
			$oID = tep_db_prepare_input($_GET['oID']);
			$order = new order($oID);
			$AddedOptionsPrice = 0;
			
			//tax business
			// Following three functions are defined in includes/functions/general.php
			$countryid = tep_get_country_id($order->delivery["country"]);
			$zoneid = tep_get_zone_id($countryid, $order->delivery["state"]);
			$default_tax_name  = tep_get_tax_description($default_tax_class, $countryid, $zoneid);
			
		// 2.1.1 Get Product Attribute Info
			if(is_array ($_POST['add_product_options']))
			{
				foreach($_POST['add_product_options'] as $option_id => $option_value_id)
				{
					$result = tep_db_query("SELECT * FROM " . TABLE_PRODUCTS_ATTRIBUTES . " 
					pa LEFT JOIN " . TABLE_PRODUCTS_OPTIONS . " po 
					ON po.products_options_id=pa.options_id 
					LEFT JOIN " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov 
					ON pov.products_options_values_id=pa.options_values_id 
					WHERE products_id=" . $_POST['add_product_products_id'] . " 
					and options_id=" . $option_id . " 
					and options_values_id=" . $option_value_id . " 
					and po.language_id = '" . (int)$languages_id . "' 
					and pov.language_id = '" . (int)$languages_id . "'");
					
					$row = tep_db_fetch_array($result);
					extract($row, EXTR_PREFIX_ALL, "opt");
					if ($opt_price_prefix == '-')
					{$AddedOptionsPrice -= $opt_options_values_price;}
					else //default to positive
					{$AddedOptionsPrice += $opt_options_values_price;}
					$option_value_details[$option_id][$option_value_id] = array (
					"options_values_price" => $opt_options_values_price,
					"price_prefix" => $opt_price_prefix);
					$option_names[$option_id] = $opt_products_options_name;
					$option_values_names[$option_value_id] = $opt_products_options_values_name;
				}
			}

	// 2.1.2 Get Product Info
				$InfoQuery = "SELECT 
				p.products_model, p.products_price, pd.products_name, p.products_tax_class_id 
				from " . TABLE_PRODUCTS . " p
				LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd 
				ON pd.products_id=p.products_id 
				WHERE p.products_id=" . $_POST['add_product_products_id'] . " 
				AND pd.language_id = '" . (int)$languages_id . "'";
			    $result = tep_db_query($InfoQuery);

			$row = tep_db_fetch_array($result);
			extract($row, EXTR_PREFIX_ALL, "p");
			
			// 2.1.3  Pull specials price from db if there is an active offer
			$special_price = tep_db_query("
			SELECT specials_new_products_price 
			FROM " . TABLE_SPECIALS . " 
			WHERE products_id =". $_POST['add_product_products_id'] . " 
			AND status");
			$new_price = tep_db_fetch_array($special_price);
			
			if ($new_price) 
			{ $p_products_price = $new_price['specials_new_products_price']; }
			
			// 2.2 UPDATE ORDER ####
            $Query = "INSERT INTO " . TABLE_ORDERS_PRODUCTS . " SET
              orders_id = '" . (int)$oID . "',
              products_id = '" . $_POST['add_product_products_id'] . "',
              products_model = '" . $p_products_model . "',
              products_name = '" . tep_html_quotes($p_products_name) . "',
              products_price = '". $p_products_price . "',
              final_price = '" . ($p_products_price + $AddedOptionsPrice) . "',
           products_tax = '" . tep_get_tax_rate($p_products_tax_class_id, $countryid, $zoneid) . "',
              products_quantity = '" . $_POST['add_product_quantity'] . "'";
              tep_db_query($Query);
              $new_product_id = tep_db_insert_id();
			
			// 2.2.1 Update inventory Quantity
			//This is only done if store is set up to use stock
			if (STOCK_CHECK == 'true'){
			tep_db_query("UPDATE " . TABLE_PRODUCTS . " SET
			products_quantity = products_quantity - " . $_POST['add_product_quantity'] . " 
			WHERE products_id = '" . $_POST['add_product_products_id'] . "'");
			}
			
			//2.2.1.1 Update products_ordered info
			tep_db_query ("UPDATE " . TABLE_PRODUCTS . " SET
			products_ordered = products_ordered + " . $_POST['add_product_quantity'] . "
			WHERE products_id = '" . $_POST['add_product_products_id'] . "'");
           			
			//2.2.1.2 keep a record of the products attributes
			if (is_array ($_POST['add_product_options'])) {
				foreach($_POST['add_product_options'] as $option_id => $option_value_id) {
				$Query = "INSERT INTO " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " SET
						orders_id = '" . (int)$oID . "',
						orders_products_id = '" . $new_product_id . "',
						products_options = '" . $option_names[$option_id] . "',
						products_options_values = '" . 
						tep_db_input($option_values_names[$option_value_id]) . "',
						
                       options_values_price = '" . 
		$option_value_details[$option_id][$option_value_id]['options_values_price'] . "',
		
						price_prefix = '" . 
						$option_value_details[$option_id][$option_value_id]['price_prefix'] . "'";
						
					tep_db_query($Query);
				}
			}
			
			// 2.2.2 Calculate Tax and Sub-Totals
			$order = new order($oID);
			$RunningSubTotal = 0;
			$RunningTax = array($default_tax_name => 0);

       		//just adding in shipping tax, don't mind me
		$ot_shipping_query = tep_db_query("
		SELECT class, value 
		FROM " . TABLE_ORDERS_TOTAL . " 
		WHERE orders_id = '" . (int)$oID . "'");
		$ot_shipping_value = tep_db_fetch_array($ot_shipping_query);
			
			
	if ($ot_shipping_value['class'] == 'ot_shipping')//a good place to add in other fields to tax
		{
		if (DISPLAY_PRICE_WITH_TAX == 'true') {
			$RunningTax[$default_tax_name] += ($ot_shipping_value['value'] * $order->info['shipping_tax'] / ($order->info['shipping_tax'] + 100));
				} else {
			$RunningTax[$default_tax_name] += (($order->info['shipping_tax'] / 100) * $ot_shipping_value['value']);
					
					}// end if (DISPLAY_PRICE_WITH_TAX == 'true') {
					}// end if ($ot_shipping_value['class'] == 'ot_shipping')
		
		// end shipping tax calcs
			 
  for ($i=0; $i<sizeof($order->products); $i++) {

        // This calculatiion of Subtotal and Tax is part of the 'add a product' process
		if (DISPLAY_PRICE_WITH_TAX == 'true') {
		$RunningSubTotal += (($order->products[$i]['tax'] / 100 + 1) * ($order->products[$i]['qty'] * $order->products[$i]['final_price']));
		} else {
		$RunningSubTotal += ($order->products[$i]['qty'] * $order->products[$i]['final_price']);
		}
		
		$RunningTax[$order->products[$i]['tax_description']] += (($order->products[$i]['tax'] / 100) * ($order->products[$i]['qty'] * $order->products[$i]['final_price']));		
			
			}// end of for ($i=0; $i<sizeof($order->products); $i++) {
			
			
			
		// 2.2.2.1 Tax
		foreach ($RunningTax as $key => $val) {
			$Query = 'UPDATE ' . TABLE_ORDERS_TOTAL . ' set
			text = "' . $currencies->format($val, true, $order->info['currency'], $order->info['currency_value']) . '",
			value = "' . $val . '"
			WHERE class= "ot_tax" 
			AND title = "' . $key . '" 
			AND orders_id= "' . (int)$oID . '"';
			tep_db_query($Query);
			}
			
			
			// 2.2.2.2 Sub-Total
			$Query = 'UPDATE ' . TABLE_ORDERS_TOTAL . ' SET
				text = "' . $currencies->format($RunningSubTotal, true, $order->info['currency'], $order->info['currency_value']) . '",
				value = "' . $RunningSubTotal . '"
				WHERE class="ot_subtotal" 
				AND orders_id= "' . (int)$oID . '"';
			tep_db_query($Query);
			
			// 2.2.2.3 Total
			if (DISPLAY_PRICE_WITH_TAX == 'true') {
			$Query = 'SELECT sum(value) 
			AS total_value from ' . TABLE_ORDERS_TOTAL . '
			WHERE class != "ot_total" 
			AND class != "ot_tax" 
			AND orders_id= "' . (int)$oID . '"';
			$result = tep_db_query($Query);
			$row = tep_db_fetch_array($result);
			$Total = $row['total_value'];
			} else {
			$Query = 'SELECT sum(value) 
			AS total_value from ' . TABLE_ORDERS_TOTAL . '
			WHERE class != "ot_total" 
			AND orders_id= "' . (int)$oID . '"';
			$result = tep_db_query($Query);
			$row = tep_db_fetch_array($result);
			$Total = $row['total_value'];
			}

			$Query = 'UPDATE ' . TABLE_ORDERS_TOTAL . ' set
				text = "' . $currencies->format($Total, true, $order->info['currency'], $order->info['currency_value']) . '",
				value = "' . $Total . '"
				WHERE class="ot_total" and orders_id= "' . (int)$oID . '"';
			tep_db_query($Query);

			// 2.3 REDIRECTION #####
			tep_redirect(tep_href_link(FILENAME_ORDERS_EDIT, tep_get_all_get_params(array('action')) . 'action=edit'));

		}
	
	  break;
		
  }
}

  if (($action == 'edit') && isset($_GET['oID'])) {
    $oID = tep_db_prepare_input($_GET['oID']);

    $orders_query = tep_db_query("select orders_id from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");
    $order_exists = true;
    if (!tep_db_num_rows($orders_query)) {
      $order_exists = false;
      $messageStack->add(sprintf(ERROR_ORDER_DOES_NOT_EXIST, $oID), 'error');
    }
  }
?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<style type="text/css">
  
  .SubTitle {
  font-family: Verdana, Arial, Helvetica, sans-serif;
  font-size: 11px;
  font-weight: bold;
  color: #29ADB8;
  }
  
  .hidden
  {
  position: absolute;
  left: -1500em;
  }
  
  .update1 {
  font-family: Verdana, Arial, Helvetica, sans-serif;
  font-size: 12px;
  background-color: #DBF5F7;
  }
  
  .update2 {
  background-color: #AFE9ED;
  }
  
  .update3 {
  background-color: #97E1E8;
  }
  
  .update4 {
  background-color: #79DAE1;
  }
  
  .update5 {
  background-color: #4DCCD7;
  }
  
  
</style>
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript" src="includes/javascript/overlib_mini.js"><!-- overLIB (c) Erik Bosrup --></script>
</head>
<body>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
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
		
<?php if (($action == 'edit') && ($order_exists == true)) { $order = new order($oID); ?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE . '&nbsp;(' . HEADING_TITLE_NUMBER . '&nbsp;' . $oID . '&nbsp;' . HEADING_TITLE_DATE  . '&nbsp;' . tep_datetime_short($order->info['date_purchased']) . ')'; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
             <td class="pageHeading" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array('oID', 'action')) . 'oID=' . $_GET['oID'] . '&action=edit') . '">' . tep_image_button('button_details.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_ORDERS_INVOICE, 'oID=' . $_GET['oID']) . '" TARGET="_blank">' . tep_image_button('button_invoice.gif', IMAGE_ORDERS_INVOICE) . '</a> <a href="' . tep_href_link(FILENAME_ORDERS_PACKINGSLIP, 'oID=' . $_GET['oID']) . '" TARGET="_blank">' . tep_image_button('button_packingslip.gif', IMAGE_ORDERS_PACKINGSLIP) . '</a> <a href="' . tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array('action'))) . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a> '; ?></td>
          </tr>
		</table></td>
      </tr>

<!-- Begin Addresses Block -->
     <tr><?php echo tep_draw_form('edit_order', FILENAME_ORDERS_EDIT, tep_get_all_get_params(array('action')) . 'action=update_order'); ?>
	  </tr>
      <tr>
	      <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '1'); ?></td>
      </tr>   

	<!-- Begin Update Block -->
      <tr>
	      <td>
          <table width="100%" border="0" cellpadding="2" cellspacing="1">
            <tr>
              <td class="update1"><?php echo HINT_PRESS_UPDATE; ?></td>
              <td class="update2" width="10">&nbsp;</td>
              <td class="update3" width="10">&nbsp;</td>
              <td class="update4" width="10">&nbsp;</td>
              <td class="update5" width="120" align="center"><?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE); ?></td>
	          </tr>
          </table>
				</td>
      </tr>
      <tr>
	      <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>   
	<!-- End of Update Block -->

      <tr>
	    <td class="SubTitle" valign="bottom"><?php echo MENUE_TITLE_CUSTOMER; ?></td>
	  </tr>
      <tr>
	      <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '1'); ?></td>
      </tr>   

			<tr>
			  <td>
      <script language="javascript"><!--

<?php echo "DISPLAY_PAYMENT_METHOD_DROPDOWN = '".DISPLAY_PAYMENT_METHOD_DROPDOWN."';"; ?>

<?php $countryid = tep_get_country_id($order->delivery["country"]);
	$zoneid = tep_get_zone_id($countryid, $order->delivery["state"]);
	$default_tax_name  = tep_get_tax_description($default_tax_class, $countryid, $zoneid);
	//default tax class is set at the top of the file
    echo "defaultTaxName = '" . $default_tax_name . "';"; ?>

addLoadListener(init);

function init()
{
  var optional = document.getElementById("optional");
  optional.className = "hidden";
  //START dropdown option for payment method by quick_fixer
  //new browsers support W3C - DOM Level 2
	if (document.getElementById) {
		//for payment dropdown menu use this
  		if (DISPLAY_PAYMENT_METHOD_DROPDOWN == 'true') { 
			var selObj = document.getElementById('update_info_payment_method');
			var selIndex = selObj.selectedIndex;
		
			//optional FOR TESTING WITH DROPDOWN input fields named txtIndex, txtValue and, txtText which outputs the index value***
			//0,1,2, based on position; the optional value (which may be different than the text value displayed); and the text value displayed in***
			//the dropdown menu
			//var txtIndexObj = document.getElementById('txtIndex');
			//var txtValueObj = document.getElementById('txtValue');
			//var txtTextObj = document.getElementById('txtText');
			//optional input fields***
			//OUTPUT optional input fields***
			//txtIndexObj.value = selIndex;
			//txtValueObj.value = selObj.options[selIndex].value;
			//txtTextObj.value = selObj.options[selIndex].text;
			//OUTPUT optional input fields***
			//text in lieu of value supported by firefox and mozilla but not others SO MAKE SURE text and optional value are the same (in the payment dropdown they are)
			if (selObj.options[selIndex].text) {
				var paymentMethod = selObj.options[selIndex].text;
			}
			else {
				var paymentMethod = selObj.options[selIndex].value;
			}
		}
		else {
			//if you only use an input field to display payment method use this
			var selObj = document.getElementById('update_info_payment_method');
			var paymentMethod = selObj.value;
		}
			              
	}
	//old browsers that don't support W3C - DOM Level 2
	else {
		//for payment dropdown menu use this
  		if (DISPLAY_PAYMENT_METHOD_DROPDOWN == 'true') { 
			var selObj = document.edit_order.update_info_payment_method;
			var selIndex = selObj.selectedIndex;
		
			//optional FOR TESTING WITH DROPDOWN input fields named txtIndex, txtValue and, txtText which outputs the index value***
			//0,1,2, based on position; the optional value (which may be different than the text value displayed); and the text value displayed in***
			//the dropdown menu
			//var txtIndexObj = document.forms.edit_order["txtIndex"].value;
			//var txtValueObj = document.forms.edit_order["txtValue"].value;
			//var txtTextObj = document.forms.edit_order["txtText"].value;
			//optional input fields***
			//OUTPUT optional input fields***
			//txtIndexObj.value = selIndex;
			//txtValueObj.value = selObj.options[selIndex].value;
			//txtTextObj.value = selObj.options[selIndex].text;
			//OUTPUT optional input fields***
			//text in lieu of value supported by firefox and mozilla but not others SO MAKE SURE text and optional value are the same (in the payment dropdown they are)
			if (selObj.options[selIndex].text) {
				var paymentMethod = selObj.options[selIndex].text;
			}
			else {
				var paymentMethod = selObj.options[selIndex].value;
			}
		}
		else {
			//if you only use an input field to display payment method use this
			var paymentMethod = document.forms.edit_order["update_info_payment_method"].value;
		}
	}
//END dropdown option for payment method by quick_fixer
  if (paymentMethod == "<?php echo ENTRY_CREDIT_CARD ?>") {
  optional.className = "";
  return true;
  } else {
  optional.className = "hidden";
  return true;
  }
  
 }

  function addLoadListener(fn)
{
  if (typeof window.addEventListener != 'undefined')
  {
    window.addEventListener('load', fn, false);
  }
  else if (typeof document.addEventListener != 'undefined')
  {
    document.addEventListener('load', fn, false);
  }
  else if (typeof window.attachEvent != 'undefined')
  {
    window.attachEvent('onload', fn);
  }
  else
  {
    var oldfn = window.onload;
    if (typeof window.onload != 'function')
    {
      window.onload = fn;
    }
    else
    {
      window.onload = function()
      {
        oldfn();
        fn();
      };
    }
  }
}
  
  function doRound(x, places) {  //we only have so much space
    return Math.round(x * Math.pow(10, places)) / Math.pow(10, places);
 }
 
 function doFormat(x, places)  //keeps all calculated values the same length
{
var a = doRound(x, places);
var s = a.toString();

var decimalIndex = s.indexOf(".");
if (places > 0 && decimalIndex < 0)
{
decimalIndex = s.length;
s += '.';
}
while (decimalIndex + places + 1 > s.length)
{
s += '0';
}
return s;
}

 function getAttributesPrices(pid){ //get any attributes prices that may exist 
var sum =0;
var el=document.getElementsByTagName('input');//all the input elements
for(var i=0;i<el.length;i++){
if(el[i].id.indexOf(pid)>-1){
var aid=el[i].id.replace(pid,'').replace('a', '');//extract the attribute id
var p=el[i].id.replace(pid,'').replace(/\d/g,'');
if((p=='a') && (document.getElementById(pid + '_' + aid + '_prefix').value) == '-') {
sum-=Number(el[i].value);
}
if((p=='a') && (document.getElementById(pid + '_' + aid + '_prefix').value) == '+') {
sum+=Number(el[i].value);
}
}
}
return sum
}

function getTaxTotals(action, taxdescription){ //find the right place to put the tax totals
var sum =0;
var el=document.getElementsByTagName('input');//all the input elements
for(var i=0;i<el.length;i++){

if (action == 'tax'){
if(el[i].id.indexOf(taxdescription)>-1){
var p=el[i].id.replace(taxdescription,'').replace(/\d/g,'');
//defaultTaxName=replace(defaultTaxName,'').replace(/\d/g,'');//strip numbers from defaultTaxName because function strips numbers from the id
if(p=='p'){
sum+=Number(el[i].value);
}//end p = p

//shipping tax is added to the default tax class
  if ((p == 'ot_shipping') || (p == defaultTaxName + 'ot_shipping')) {
  var taxRate = document.getElementById("shipping_tax-" + defaultTaxName).value;
  <?php
  if (DISPLAY_PRICE_WITH_TAX == 'true') { ?>//shipping tax is part of the shipping charge
  sum += Number(el[i].value) * taxRate / (Number(taxRate) + 100); 
  <?php } else { ?>//shipping tax is in addition to the shipping charge
  sum += Number(el[i].value) * taxRate / 100; 
  <?php } ?>
  }//end if p == ot_shipping
 
}//end if taxdescription >-1
}//end if action = tax

} //end for(var i=0;i<el.length;i++){
return sum
} //end function getTaxTotals

  function updateTotals(action, taxdescription){ //do the totals
  var sum =0;
  var el=document.getElementsByTagName('input');//all the input elements
  for(var i=0;i<el.length;i++){
  var pid=el[i].id.replace(/\d/g,'');//removes the numbers from id
 
  if (action == 'subtotal') {
  <?php if (DISPLAY_PRICE_WITH_TAX == 'true') { ?>
  if(pid == 'p-total_incl')// display price with tax => total including tax
  <?php } else { ?>
  if(pid == 'p-total_excl')// display price without tax => total excluding tax
  <?php } ?>
  {
  sum+=Number(el[i].value);
  }
  } 

  if ((action == 'weight') && (pid == 'p-total_weight')) {
  sum += Number(el[i].value);
  }

if (action =='total'){
//I cheat here- the grand total always includes the value of the various totals including tax of 
//each item, regardless of individual shop settings.  So I take the various Total incls, all the
//ot_customs, ot_loworderfees, and any ot_shipping value, and voila
if ((pid ==  'ot_custom') || (pid == defaultTaxName + 'ot_shipping') || (pid == 'p-total_incl') || (pid == 'ot_loworderfee')) {
sum += Number(el[i].value);
  }
  
 <?php
 if (DISPLAY_PRICE_WITH_TAX != 'true') //when set to true, shipping charge already includes tax
 {  ?>
 //calculates the shipping tax 
 //This has to be done independently since the grand total doesn't count the various tax totals
  if (pid == defaultTaxName + 'ot_shipping') {
  var taxRate = document.getElementById("shipping_tax-" + defaultTaxName).value; 
  sum += Number(el[i].value) * taxRate / 100; 
    }//end if pid == defaultTaxName + 'ot_shipping'
   <?php } ?>
   
    } //end if action == total

  } //end for(var i=0;i<el.length;i++)
  
  return sum
  }//end function updateTotals()
  
  function updatePrices(action, pid, taxdescription) { 
  //calculates all the different values as new entries are typed
    var qty = document.getElementById(pid + "-qty").value;
	var taxRate = document.getElementById(pid + "-tax").value;
	var weight = document.getElementById(pid + "-weight").value;
	var attValue = getAttributesPrices(pid);
			
	if ((action == 'qty') || (action == 'tax') || (action == 'att_price') || (action == 'price')) {
	
	var finalPriceValue = document.getElementById(pid + "-price").value;
	var priceInclValue = document.getElementById(pid + "-price").value;
	var totalInclValue = document.getElementById(pid + "-price").value;
	var totalExclValue = document.getElementById(pid + "-price").value;
	var totalWeight = document.getElementById(pid + "-weight").value;
			
	finalPriceValue = Number(attValue) + Number(finalPriceValue);
	priceInclValue = ( Number(attValue) + Number(priceInclValue) ) * ((taxRate / 100) + 1);
	totalInclValue = ( Number(attValue) + Number(totalInclValue) ) * ((taxRate / 100) + 1) * qty;
	totalExclValue = ( Number(attValue) + Number(totalExclValue) ) * qty;
	totalWeight = totalWeight * qty;
	taxValue = taxRate * finalPriceValue / 100 * qty;
	
	}
	
	if (action == 'final_price') {
	
	var priceValue = document.getElementById(pid + "-final_price").value;
	var priceInclValue = document.getElementById(pid + "-final_price").value;
	var totalInclValue = document.getElementById(pid + "-final_price").value;
	var totalExclValue = document.getElementById(pid + "-final_price").value;
	var taxValue = document.getElementById(pid + "-final_price").value;
		
	priceValue = Number(priceValue) - Number(attValue);
	priceInclValue = priceInclValue * ((taxRate / 100) + 1);
	totalInclValue = totalInclValue * ((taxRate / 100) + 1) * qty;
	totalExclValue = totalExclValue * qty;
	taxValue = taxRate * taxValue / 100 * qty;
		
	} //end if ((action == 'qty') || (action == 'tax') || (action == 'final_price')) 
	
	if (action == 'price_incl') {
	
	var priceValue = document.getElementById(pid + "-price_incl").value;
	var finalPriceValue = document.getElementById(pid + "-price_incl").value;
	var totalInclValue = document.getElementById(pid + "-price_incl").value;
	var totalExclValue = document.getElementById(pid + "-price_incl").value;
		
	priceValue = Number(finalPriceValue / ((taxRate / 100) + 1)) - Number(attValue);
	finalPriceValue = finalPriceValue / ((taxRate / 100) + 1);
	totalInclValue = totalInclValue * qty;
	totalExclValue = totalExclValue * qty / ((taxRate / 100) + 1);
	taxValue = taxRate * finalPriceValue / 100 * qty;
	
	} //end of if (action == 'price_incl')
	
	if (action == 'total_excl') {
	
	var priceValue = document.getElementById(pid + "-total_excl").value;
	var finalPriceValue = document.getElementById(pid + "-total_excl").value;
	var priceInclValue = document.getElementById(pid + "-total_excl").value;
	var totalInclValue = document.getElementById(pid + "-total_excl").value;
			
	priceValue = ( Number (finalPriceValue / qty) ) - Number (attValue);
	finalPriceValue = finalPriceValue / qty;
	priceInclValue = priceInclValue * ((taxRate / 100) + 1) / qty;
	totalInclValue = totalInclValue * ((taxRate / 100) + 1);
	taxValue = taxRate * finalPriceValue / 100 * qty;
	
	} //end of if (action == 'total_excl')
	
	if (action == 'total_incl') {
	
	var priceValue = document.getElementById(pid + "-total_incl").value;
	var finalPriceValue = document.getElementById(pid + "-total_incl").value;
	var priceInclValue = document.getElementById(pid + "-total_incl").value;
	var totalExclValue = document.getElementById(pid + "-total_incl").value;
		
	priceValue = Number (finalPriceValue / ((taxRate / 100) + 1) / qty) - Number(attValue)
	finalPriceValue = finalPriceValue / ((taxRate / 100) + 1) / qty;
	priceInclValue = priceInclValue / qty;
	totalExclValue = totalExclValue / ((taxRate / 100) + 1);
	taxValue = taxRate * finalPriceValue / 100 * qty;
	
	} //end of if (action == 'total_incl')
	
	if (action == 'qty') {
	document.getElementById(pid + "-total_weight").value = doFormat(totalWeight, 2);
	var totalOrderWeight = updateTotals('weight');//performed after formatting weight above
	document.getElementById("total_order_weight").value = doFormat(totalOrderWeight, 2);
	}
	
	if ((action != 'qty') && (action != 'tax') && (action != 'att_price') && (action != 'price')) {
	document.getElementById(pid + "-price").value = doFormat(priceValue, 4);
	}
	
	if (action != 'final_price') {
	document.getElementById(pid + "-final_price").value = doFormat(finalPriceValue, 4);
	}
	
	if ((action != 'qty') && (action != 'price_incl')) {
	document.getElementById(pid + "-price_incl").value = doFormat(priceInclValue, 4);
	}
	
	if ((action != 'tax') && (action != 'total_excl')) {
	document.getElementById(pid + "-total_excl").value = doFormat(totalExclValue, 4);
	}
	
	if (action != 'total_incl') {
	document.getElementById(pid + "-total_incl").value = doFormat(totalInclValue, 4);
	}
	
	document.getElementById(taxdescription + pid).value = doFormat(taxValue, 4);
	
	var subTotal = updateTotals('subtotal', taxdescription);
	document.getElementById("ot_subtotal").value = doFormat(subTotal, 4);
	
	var taxTotal = getTaxTotals('tax', taxdescription);
	var field = document.getElementById(taxdescription + "-total");
    if (field) field.value = doFormat(taxTotal, 4);//tax fields won't necessarily exist
	
	var preTotal = updateTotals('total', taxdescription);
	//var total = Number(preTotal) + Number(subTotal);
	document.getElementById("ot_total").value = doFormat(preTotal, 4);
	
	} //end function updatePrices(action, pid)
	
    function getTotals(action, taxdescription) { 
	//called when updating editable total components such as shipping
	var subTotal = updateTotals('subtotal', taxdescription);
	document.getElementById("ot_subtotal").value = doFormat(subTotal, 4);
	
	//need to perform special step if shipping charge is changed
	if (action == 'shipping') {
	var taxTotal = getTaxTotals('tax', taxdescription);
	var field = document.getElementById(taxdescription + "-total");
	if (field) field.value = doFormat(taxTotal, 4);
	}//end if action == shipping
	
	var preTotal = updateTotals('total', taxdescription);
	//var total = Number(preTotal) + Number(subTotal);
	document.getElementById("ot_total").value = doFormat(preTotal, 4);
	} //end function updateTotals

 //--></script>
 
<table border="0" class="dataTableRow" cellpadding="2" cellspacing="0">
  <tr class="dataTableHeadingRow">
    <td class="dataTableHeadingContent" width="80"></td>
    <td class="dataTableHeadingContent" width="150"><?php echo ENTRY_CUSTOMER_ADDRESS; ?></td>
    <td class="dataTableHeadingContent" width="6">&nbsp;</td>
    <td class="dataTableHeadingContent" width="150"><?php echo ENTRY_SHIPPING_ADDRESS; ?> <a href="#" onMouseOver="return overlib('<?php echo HINT_SHIPPING_ADDRESS; ?>', BELOW, RIGHT);" onMouseOut="return nd();" ><img src="images/icon_info.gif" border= "0" width="13" height="13" /></a></td>
	 <td class="dataTableHeadingContent" width="6">&nbsp;</td>
    <td class="dataTableHeadingContent" width="150"><?php echo ENTRY_BILLING_ADDRESS; ?></td>
  </tr>
 <?php
  if (ACCOUNT_COMPANY == 'true') {
?>
 <tr>
    <td class="main"><b><?php echo ENTRY_CUSTOMER_COMPANY; ?>: </b></td>
    <td><span class="main"><input name="update_customer_company" size="30" value="<?php echo tep_html_quotes($order->customer['company']); ?>" /></span></td>
		<td>&nbsp;</td>
    <td><span class="main"><input name="update_delivery_company" size="30" value="<?php echo tep_html_quotes($order->delivery['company']); ?>" /></span></td>
	<td>&nbsp;</td>
    <td><span class="main"><input name="update_billing_company" size="30" value="<?php echo tep_html_quotes($order->billing['company']); ?>" /></span></td>
  </tr>
  <?php
  }
?>
  <tr>
    <td class="main"><b><?php echo ENTRY_CUSTOMER_NAME; ?>: </b></td>
    <td><span class="main"><input name="update_customer_name" size="30" value="<?php echo tep_html_quotes($order->customer['name']); ?>" /></span></td>
    <td>&nbsp;</td>
    <td><span class="main"><input name="update_delivery_name" size="30" value="<?php echo tep_html_quotes($order->delivery['name']); ?>" /></span></td>
	<td>&nbsp;</td>
    <td><span class="main"><input name="update_billing_name" size="30" value="<?php echo tep_html_quotes($order->billing['name']); ?>" /></span></td>
  </tr>
  <tr>
    <td class="main"><b><?php echo ENTRY_ADDRESS; ?>: </b></td>
    <td><span class="main"><input name="update_customer_street_address" size="30" value="<?php echo tep_html_quotes($order->customer['street_address']); ?>" /></span></td>
    <td>&nbsp;</td>
    <td><span class="main"><input name="update_delivery_street_address" size="30" value="<?php echo tep_html_quotes($order->delivery['street_address']); ?>" /></span></td>
	<td>&nbsp;</td>
    <td><span class="main"><input name="update_billing_street_address" size="30" value="<?php echo tep_html_quotes($order->billing['street_address']); ?>" /></span></td>
  </tr>
  <?php
  if (ACCOUNT_SUBURB == 'true') {
?>
  <tr>
    <td class="main"><b><?php echo ENTRY_CUSTOMER_SUBURB; ?>: </b></td>
    <td><span class="main"><input name="update_customer_suburb" size="30" value="<?php echo tep_html_quotes($order->customer['suburb']); ?>" /></span></td>
    <td>&nbsp;</td>
    <td><span class="main"><input name="update_delivery_suburb" size="30" value="<?php echo tep_html_quotes($order->delivery['suburb']); ?>" /></span></td>
	<td>&nbsp;</td>
    <td><span class="main"><input name="update_billing_suburb" size="30" value="<?php echo tep_html_quotes($order->billing['suburb']); ?>" /></span></td>
  </tr>
  <?php
  }
?>
  <tr>
    <td class="main"><b><?php echo ENTRY_CUSTOMER_CITY; ?>: </b></td>
    <td><span class="main"><input name="update_customer_city" size="30" value="<?php echo tep_html_quotes($order->customer['city']); ?>" /></span></td>
    <td>&nbsp;</td>
    <td><span class="main"><input name="update_delivery_city" size="30" value="<?php echo tep_html_quotes($order->delivery['city']); ?>" /></span></td>
	<td>&nbsp;</td>
    <td><span class="main"><input name="update_billing_city" size="30" value="<?php echo tep_html_quotes($order->billing['city']); ?>" /></span></td>
  </tr>
  <?php
  if (ACCOUNT_STATE == 'true') {
?>
  <tr>
    <td class="main"><b><?php echo ENTRY_CUSTOMER_STATE; ?>: </b></td>
    <td><span class="main"><input name="update_customer_state" size="30" value="<?php echo tep_html_quotes($order->customer['state']); ?>" /></span></td>
    <td>&nbsp;</td>
    <td><span class="main"><input name="update_delivery_state" size="30" value="<?php echo tep_html_quotes($order->delivery['state']); ?>" /></span></td>
	<td>&nbsp;</td>
    <td><span class="main"><input name="update_billing_state" size="30" value="<?php echo tep_html_quotes($order->billing['state']); ?>" /></span></td>
  </tr>
  <?php
  }
?>
  <tr>
    <td class="main"><b><?php echo ENTRY_CUSTOMER_POSTCODE; ?>: </b></td>
    <td><span class="main"><input name="update_customer_postcode" size="30" value="<?php echo $order->customer['postcode']; ?>" /></span></td>
    <td>&nbsp;</td>
    <td><span class="main"><input name="update_delivery_postcode" size="30" value="<?php echo $order->delivery['postcode']; ?>" /></span></td>
	 <td>&nbsp;</td>
    <td><span class="main"><input name="update_billing_postcode" size="30" value="<?php echo $order->billing['postcode']; ?>" /></span></td>
  </tr>
  <tr>
    <td class="main"><b><?php echo ENTRY_CUSTOMER_COUNTRY; ?>: </b></td>
    <td><span class="main"><input name="update_customer_country" size="30" value="<?php echo tep_html_quotes($order->customer['country']); ?>" /></span></td>
    <td>&nbsp;</td>
    <td><span class="main"><input name="update_delivery_country" size="30" value="<?php echo tep_html_quotes($order->delivery['country']); ?>" /></span></td>
	<td>&nbsp;</td>
    <td><span class="main"><input name="update_billing_country" size="30" value="<?php echo tep_html_quotes($order->billing['country']); ?>" /></span></td>
  </tr>
  <tr>
    <td class="main"><b><?php echo ENTRY_CUSTOMER_PHONE; ?>: </b></td>
    <td><span class="main"><input name="update_customer_telephone" size="30" value="<?php echo $order->customer['telephone']; ?>" /></span></td>
   <td colspan="4"></td>
  </tr>
  <tr>
    <td class="main"><b><?php echo ENTRY_CUSTOMER_EMAIL; ?>: </b></td>
    <td><span class="main"><input name="update_customer_email_address" size="30" value="<?php echo $order->customer['email_address']; ?>" /></span></td>
  <td colspan="4"></td>
	</tr>
</table>
				</td>
			</tr>
<!-- End Addresses Block -->

      <tr>
	      <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>      

<!-- Begin Payment Block -->
      <tr>
	      <td class="SubTitle"><?php echo MENUE_TITLE_PAYMENT; ?></td>
			</tr>
      <tr>
	      <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '1'); ?></td>
      </tr>   
      <tr>
	      <td>
				
<table border="0" cellspacing="0" cellpadding="2" class="dataTableRow">
  <tr class="dataTableHeadingRow">
    <td colspan="2" class="dataTableHeadingContent" valign="bottom"><?php echo ENTRY_PAYMENT_METHOD; ?> <a href="#" onMouseOver="return overlib('<?php echo HINT_UPDATE_TO_CC . ENTRY_CREDIT_CARD . HINT_UPDATE_TO_CC2; ?>', BELOW, RIGHT);" onMouseOut="return nd();" ><img src="images/icon_info.gif" border="0" width="13" height="13" /></a></td>
	</tr>
  <tr>
	  <td colspan="2" class="main">
	  <?php 
	  //START for payment dropdown menu use this by quick_fixer
  		if (DISPLAY_PAYMENT_METHOD_DROPDOWN == 'true') { 
		
		  // Get list of all payment modules available
  $enabled_payment = array();
  $module_directory = DIR_FS_CATALOG_MODULES . 'payment/';
  $file_extension = substr($PHP_SELF, strrpos($PHP_SELF, '.'));

  if ($dir = @dir($module_directory)) {
    while ($file = $dir->read()) {
      if (!is_dir( $module_directory . $file)) {
        if (substr($file, strrpos($file, '.')) == $file_extension) {
          $directory_array[] = $file;
        }
      }
    }
    sort($directory_array);
    $dir->close();
  }

  // For each available payment module, check if enabled
  for ($i=0, $n=sizeof($directory_array); $i<$n; $i++) {
    $file = $directory_array[$i];

    include(DIR_FS_CATALOG_LANGUAGES . $language . '/modules/payment/' . $file);
    include($module_directory . $file);

    $class = substr($file, 0, strrpos($file, '.'));
    if (tep_class_exists($class)) {
      $module = new $class;
      if ($module->check() > 0) {
        // If module enabled create array of titles
      	$enabled_payment[] = array('id' => $module->title, 'text' => $module->title);
		
		//if the payment method is the same as the payment module title then don't add it to dropdown menu
		if ($module->title == $order->info['payment_method']) {
			$paymentMatchExists='true';	
		}
      }
   }
 }
 		//just in case the payment method found in db is not the same as the payment module title then make it part of the dropdown array or else it cannot be the selected default value
		if ($paymentMatchExists !='true') {
			$enabled_payment[] = array('id' => $order->info['payment_method'], 'text' => $order->info['payment_method']);	
 }
 $enabled_payment[] = array('id' => 'Other', 'text' => 'Other');	
		//draw the dropdown menu for payment methods and default to the order value
	  		echo tep_draw_pull_down_menu('update_info_payment_method', $enabled_payment, $order->info['payment_method'], 'id="update_info_payment_method" onChange="init()"'); 
		}
	  	else {
		//draw the input field for payment methods and default to the order value
	  ?><input name="update_info_payment_method" size="35" value="<?php echo $order->info['payment_method']; ?>" id="update_info_payment_method" onKeyUp="init()"/><?php
	  }
	  //END for payment dropdown menu use this by quick_fixer
	?></td>
	</tr>

	<!-- Begin Credit Card Info Block -->
	  <tr><td>
	  
	  <table id="optional">
	 <tr>
	    <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
	  </tr>
	  <tr>
	    <td class="main"><?php echo ENTRY_CREDIT_CARD_TYPE; ?></td>
	    <td class="main"><input name="update_info_cc_type" size="20" value="<?php echo $order->info['cc_type']; ?>" /></td>
	  </tr>
	  <tr>
	    <td class="main"><?php echo ENTRY_CREDIT_CARD_OWNER; ?></td>
	    <td class="main"><input name="update_info_cc_owner" size="20" value="<?php echo $order->info['cc_owner']; ?>" /></td>
	  </tr>
	  <tr>
	    <td class="main"><?php echo ENTRY_CREDIT_CARD_NUMBER; ?></td>
	    <td class="main"><input name="update_info_cc_number" size="20" value="<?php echo $order->info['cc_number']; ?>" /></td>
	  </tr>
	  <tr>
	    <td class="main"><?php echo ENTRY_CREDIT_CARD_EXPIRES; ?></td>
	    <td class="main"><input name="update_info_cc_expires" size="4" value="<?php echo $order->info['cc_expires']; ?>" maxlength="4" /></td>
	  </tr>
	  </table>
	  
	  </td></tr>
	
  <!-- End Credit Card Info Block -->
	
</table>
 
   </td>
      </tr>
	 
<!-- End Payment Block -->
	
      <tr>
	      <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>

<!-- Begin Products Listing Block -->
      <tr>
	      <td class="SubTitle"><?php echo MENUE_TITLE_ORDER; ?> <a href="#" onMouseOver="return overlib('<?php echo HINT_PRODUCTS_PRICES; ?>', BELOW, RIGHT);" onMouseOut="return nd();" ><img src="images/icon_info.gif" border= "0" width="13" height="13" /></a></td>
			</tr>
      <tr>
	      <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '1'); ?></td>
      </tr>   
      <tr>
	      <td>
	
	<table border="0" width="100%" cellspacing="0" cellpadding="2">
		<tr class="dataTableHeadingRow">
	  <td class="dataTableHeadingContent"><?php  echo TABLE_HEADING_DELETE; ?></td>
	  <td class="dataTableHeadingContent"><?php  echo TABLE_HEADING_QUANTITY; ?></td>
	  <td class="dataTableHeadingContent"><?php  echo TABLE_HEADING_PRODUCTS; ?></td>
	  <td class="dataTableHeadingContent"><?php  echo TABLE_HEADING_PRODUCTS_MODEL; ?></td>
	  <td class="dataTableHeadingContent"><?php  echo TABLE_HEADING_TAX; ?></td>
	  <td class="dataTableHeadingContent"><?php  echo TABLE_HEADING_BASE_PRICE; ?> <a href="#" onMouseOver="return overlib('<?php echo HINT_BASE_PRICE; ?>', BELOW, RIGHT);" onMouseOut="return nd();" ><img src="images/icon_info.gif" border= "0" width="13" height="13" /></a></td>
	  <td class="dataTableHeadingContent"><?php  echo TABLE_HEADING_UNIT_PRICE; ?> <a href="#" onMouseOver="return overlib('<?php echo HINT_PRICE_EXCL; ?>', BELOW, RIGHT);" onMouseOut="return nd();" ><img src="images/icon_info.gif" border= "0" width="13" height="13" /></a></td>
	  <td class="dataTableHeadingContent"><?php  echo TABLE_HEADING_UNIT_PRICE_TAXED; ?> <a href="#" onMouseOver="return overlib('<?php echo HINT_PRICE_INCL; ?>', BELOW, RIGHT);" onMouseOut="return nd();" ><img src="images/icon_info.gif" border= "0" width="13" height="13" /></a></td>
	  <td class="dataTableHeadingContent"><?php  echo TABLE_HEADING_TOTAL_PRICE; ?> <a href="#" onMouseOver="return overlib('<?php echo HINT_TOTAL_EXCL; ?>', BELOW, RIGHT);" onMouseOut="return nd();" ><img src="images/icon_info.gif" border= "0" width="13" height="13" /></a></td>
	  <td class="dataTableHeadingContent"><?php  echo TABLE_HEADING_TOTAL_PRICE_TAXED; ?> <a href="#" onMouseOver="return overlib('<?php echo HINT_TOTAL_INCL; ?>', BELOW, RIGHT);" onMouseOut="return nd();" ><img src="images/icon_info.gif" border= "0" width="13" height="13" /></a></td>
	  <td class="dataTableHeadingContent"><?php  echo TABLE_HEADING_PRODUCTS_WEIGHT; ?></td>
	</tr>
	<?php

	for ($i=0; $i<sizeof($order->products); $i++) {
	//calculate total weight
	$products_weight = array($order->products[$i]['weight'] * $order->products[$i]['qty']);
    foreach ($products_weight as $key => $value);
    $total_weight += $value;
    //end total weight
	$orders_products_id = $order->products[$i]['orders_products_id'];
		$RowStyle = "dataTableContent";
		echo '	  <tr class="dataTableRow">' . "\n" .
		     '	    <td class="' . $RowStyle . '" valign="top"><div align="center">' . "<input name='update_products[$orders_products_id][delete]' type='checkbox' /></div></td>\n" . 
			 '	    <td class="' . $RowStyle . '" align="right" valign="top"><div align="center">' . "<input name='update_products[$orders_products_id][qty]' size='2' value='" . $order->products[$i]['qty'] . "' onKeyUp=\"updatePrices('qty', 'p" . $orders_products_id . "', '" . $order->products[$i]['tax_description'] . "')\" id='p" . $orders_products_id . "-qty' /></div></td>\n" . 
 		     '	    <td class="' . $RowStyle . '" valign="top">' . "<input name='update_products[$orders_products_id][name]' size='35' value='" . $order->products[$i]['name'] . "'>";
		
		// Has Attributes? 
		if (sizeof($order->products[$i]['attributes']) > 0) {
			for ($j=0; $j<sizeof($order->products[$i]['attributes']); $j++) {
				$orders_products_attributes_id = $order->products[$i]['attributes'][$j]['orders_products_attributes_id'];
				echo '<br /><nobr><small>&nbsp;<i> - ' . "<input name='update_products[$orders_products_id][attributes][$orders_products_attributes_id][option]' size='6' value='" . $order->products[$i]['attributes'][$j]['option'] . "'>" . ': ' . "<input name='update_products[$orders_products_id][attributes][$orders_products_attributes_id][value]' size='10' value='" . $order->products[$i]['attributes'][$j]['value'] . "'>" . ': ' . "</i><input name='update_products[$orders_products_id][attributes][$orders_products_attributes_id][prefix]' size='1' id='p" . $orders_products_id . "_" . $orders_products_attributes_id . "_prefix' value='" . $order->products[$i]['attributes'][$j]['prefix'] . "' onKeyUp=\"updatePrices('att_price', 'p" . $orders_products_id . "', '" . $order->products[$i]['tax_description'] . "', '" . $orders_products_attributes_id . "')\">" . ': ' . "<input name='update_products[$orders_products_id][attributes][$orders_products_attributes_id][price]' size='7' value='" . $order->products[$i]['attributes'][$j]['price'] . "' onKeyUp=\"updatePrices('att_price', 'p" . $orders_products_id . "', '" . $order->products[$i]['tax_description'] . "', '" . $orders_products_attributes_id . "')\" id='p". $orders_products_id . "a" . $orders_products_attributes_id . "'>";
				echo '</small></nobr>';
			}
		}
		
		echo '	    </td>' . "\n" .
		     '	    <td class="' . $RowStyle . '" valign="top">' . "<input name='update_products[$orders_products_id][model]' size='12' value='" . $order->products[$i]['model'] . "'>" . '</td>' . "\n" .
		     '	    <td class="' . $RowStyle . '" valign="top">' . "<input name='update_products[$orders_products_id][tax]' size='6' value='" . tep_display_tax_value($order->products[$i]['tax']) . "' onKeyUp=\"updatePrices('tax', 'p" . $orders_products_id . "', '" . $order->products[$i]['tax_description'] . "')\" id='p" . $orders_products_id . "-tax' />" . 
			 "<input type='hidden' name='update_products[$orders_products_id][tax_description]' value='".$order->products[$i]['tax_description']."'>" . 
			 "<input type='hidden' name='" . $order->products[$i]['tax_description'] . 'p' . $orders_products_id . "' id='" . $order->products[$i]['tax_description'] . 'p' . $orders_products_id . "' value='" . number_format(($order->products[$i]['tax'] * $order->products[$i]['final_price'] / 100 * $order->products[$i]['qty']), 4, '.', '') . "'>" . 
			 '</td>' . "\n" .
		     '	    <td class="' . $RowStyle . '" align="right" valign="top">' . "<input name='update_products[$orders_products_id][price]' size='7' value='" . number_format($order->products[$i]['price'], 4, '.', '') . "' onKeyUp=\"updatePrices('price', 'p" . $orders_products_id . "', '" . $order->products[$i]['tax_description'] . "')\" id='p" . $orders_products_id . "-price' />" . '</td>' . "\n" .
			 '	    <td class="' . $RowStyle . '" align="right" valign="top">' . "<input name='update_products[$orders_products_id][final_price]' size='7' value='" . number_format($order->products[$i]['final_price'], 4, '.', '') . "' onKeyUp=\"updatePrices('final_price', 'p" . $orders_products_id . "', '" . $order->products[$i]['tax_description'] . "')\" id='p" . $orders_products_id . "-final_price' />" . '</td>' . "\n" . 
		     '	    <td class="' . $RowStyle . '" align="right" valign="top">' . "<input name='update_products[$orders_products_id][price_incl]' size='7' value='" . number_format(($order->products[$i]['final_price'] * (($order->products[$i]['tax']/100) + 1)), 4, '.', '') . "' onKeyUp=\"updatePrices('price_incl', 'p" . $orders_products_id . "', '" . $order->products[$i]['tax_description'] . "')\" id='p" . $orders_products_id . "-price_incl' />" . '</td>' . "\n" . 
		     '	    <td class="' . $RowStyle . '" align="right" valign="top">' . "<input name='update_products[$orders_products_id][total_excl]' size='7' value='" . number_format($order->products[$i]['final_price'] * $order->products[$i]['qty'], 4, '.', '') . "' onKeyUp=\"updatePrices('total_excl', 'p" . $orders_products_id . "', '" . $order->products[$i]['tax_description'] . "')\" id='p" . $orders_products_id . "-total_excl' />" . '</td>' . "\n" . 
		     '	    <td class="' . $RowStyle . '" align="right" valign="top">' . "<input name='update_products[$orders_products_id][total_incl]' size='7' value='" . number_format((($order->products[$i]['final_price'] * (($order->products[$i]['tax']/100) + 1))) * $order->products[$i]['qty'], 4, '.', '') . "' onKeyUp=\"updatePrices('total_incl', 'p" . $orders_products_id . "', '" . $order->products[$i]['tax_description'] . "')\" id='p" . $orders_products_id . "-total_incl' />" . '</td>' . "\n" .
			 '	    <td class="' . $RowStyle . '" align="right" valign="top">'  . 
		"<input name='update_products[$orders_products_id][total_weight]' size='6' value='" . number_format(($order->products[$i]['weight'] * $order->products[$i]['qty']), 2, '.', '') . "' id='p" . $orders_products_id . "-total_weight' readonly='readonly'>" . "<input type='hidden' name='update_products[$orders_products_id][weight]' value='" . $order->products[$i]['weight'] . "' id='p" . $orders_products_id . "-weight'>"  . '</td>' . "\n" .
			 '	  </tr>' . "\n" .
			 '     <tr><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>' . "\n";
	}
?>
</table> 
        </td>
      <tr>
	      <td>
		<table width="100%" cellpadding="0" cellspacing="0">
					  <tr>
  <td align="right"><?php echo '<a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action')) . 'action=add_product&step=1') . '">' . tep_image_button('button_add_article.gif', ADDING_TITLE) . '</a>'; ?></td>
						</tr>
					</table>
			  </td>
      </tr>
      <tr>
	      <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
			
	<!-- End Products Listings Block -->

	<!-- Begin Update Block -->
      <tr>
	      <td>
          <table width="100%" border="0" cellpadding="2" cellspacing="1">
            <tr>
              <td class="update1"><?php echo HINT_PRESS_UPDATE; ?></td>
              <td class="update2" width="10">&nbsp;</td>
              <td class="update3" width="10">&nbsp;</td>
              <td class="update4" width="10">&nbsp;</td>
              <td class="update5" width="120" align="center"><?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE); ?></td>
	          </tr>
          </table>
				</td>
      </tr>
      <tr>
	      <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>   
	<!-- End of Update Block -->

	<!-- Begin Order Total Block -->
      <tr>
	      <td class="SubTitle"><?php echo MENUE_TITLE_TOTAL; ?> <a href="#" onMouseOver="return overlib('<?php echo HINT_TOTALS; ?>', BELOW, RIGHT);" onMouseOut="return nd();" ><img src="images/icon_info.gif" border= "0" width="13" height="13" /></a></td>
			</tr>
      <tr>
	      <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '1'); ?></td>
      </tr>   
      <tr>
	      <td>
	<table border="0" cellspacing="0" cellpadding="2" class="dataTableRow">
      <tr class="dataTableHeadingRow">
	  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TOTAL_MODULE; ?></td>
	  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS_WEIGHT; ?></td>
	  <td class="dataTableHeadingContent"width="1"><?php echo tep_draw_separator('pixel_trans.gif', '1', '1'); ?></td>
	  </tr>
	  <tr>
	  <td class="smallText" align="right"><b><?php echo TABLE_HEADING_TOTAL_WEIGHT; ?></b></td>
	  <td class="smallText" align="right"><?php  echo '<input name="total_order_weight" id="total_order_weight" size="10" value="' . number_format($total_weight, 2, '.', '') . '" readonly="readonly" />'; ?></td>
	  <td></td>
	   </tr>
	<tr class="dataTableHeadingRow">
	  <td class="dataTableHeadingContent"></td>
	  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TAX; ?></td>
	  <td class="dataTableHeadingContent"width="1"><?php echo tep_draw_separator('pixel_trans.gif', '1', '1'); ?></td>
	  </tr>
	  <tr>
	  <td class="smallText" align="right"><b><?php echo TABLE_HEADING_SHIPPING_TAX; ?></b></td>
	  <td class="smallText" align="right"><input name="update_shipping_tax" size="10" onKeyUp="getTotals('shipping', '<?php 
	$countryid = tep_get_country_id($order->delivery["country"]);
	$zoneid = tep_get_zone_id($countryid, $order->delivery["state"]);
	$default_tax_name  = tep_get_tax_description($default_tax_class, $countryid, $zoneid);
	//default tax class is set at the top of the file
	echo $default_tax_name; ?>')" value="<?php echo tep_display_tax_value($order->info['shipping_tax']); ?>" id="shipping_tax-<?php echo $default_tax_name; ?>" /></td>
	  <td></td>
	   </tr>
		<tr class="dataTableHeadingRow">
	  <td class="dataTableHeadingContent"></td>
	  <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TOTAL_AMOUNT; ?></td>
	  <td class="dataTableHeadingContent"width="1"><?php echo tep_draw_separator('pixel_trans.gif', '1', '1'); ?></td>
	</tr>
<?php
// START OF MAKING ALL INPUT FIELDS THE SAME LENGTH 
	$max_length = 0;
	$TotalsLengthArray = array();
	for ($i=0; $i<sizeof($order->totals); $i++) {
		$TotalsLengthArray[] = array("Name" => $order->totals[$i]['title']);
	}
	reset($TotalsLengthArray);
	foreach($TotalsLengthArray as $TotalIndex => $TotalDetails) {
		if (strlen($TotalDetails["Name"]) > $max_length) {
			$max_length = strlen($TotalDetails["Name"]);
		}
	}
// END OF MAKING ALL INPUT FIELDS THE SAME LENGTH

	$TotalsArray = array();
		for ($i=0; $i<sizeof($order->totals); $i++) {
		$TotalsArray[] = array(
		"Name" => $order->totals[$i]['title'], 
		"Price" => number_format($order->totals[$i]['value'], 2, '.', ''), 
		"Class" => $order->totals[$i]['class'], 
		"TotalID" => $order->totals[$i]['orders_total_id']);
		
		$TotalsArray[] = array(
		"Name" => "", 
		"Price" => "", 
		"Class" => "ot_custom", 
		"TotalID" => "0");
	}
	
	array_pop($TotalsArray);
	foreach($TotalsArray as $TotalIndex => $TotalDetails)
	{
		$TotalStyle = "smallText";
		
		if ($TotalDetails["Class"] == "ot_total" || $TotalDetails["Class"] == "ot_subtotal") {
			$id = $TotalDetails["Class"];//subtotal and total should each only exist once
			
			} elseif ($TotalDetails["Class"] == "ot_tax") {
			$id = preg_replace("/:$/", "", $TotalDetails["Name"]) . '-total';
			
			} elseif ($TotalDetails["Class"] == "ot_shipping") {
			$id = $default_tax_name . $TotalDetails["Class"] . $TotalIndex;
			
			} else {
			$id = $TotalDetails["Class"] . $TotalIndex;
			}
			
		if(//tax, subtotal, and total are not editable, but have all the same format
		$TotalDetails["Class"] == "ot_total" || 
		$TotalDetails["Class"] == "ot_subtotal" || 
		$TotalDetails["Class"] == "ot_tax")
		{
					
			echo '	<tr>' . "\n" .
				   '		<td align="right" class="' . $TotalStyle . '"><b>' . $TotalDetails["Name"] . '</b></td>' .
				   '		<td align="right" class="' . $TotalStyle . '">' . 
				            "<input name='" . $TotalDetails["Name"] . "' size='10' value='" . $TotalDetails["Price"] . "' id='" . $id . "' readonly='readonly' />" . 
						    "<input name='update_totals[$TotalIndex][title]' type='hidden' value='" . trim($TotalDetails["Name"]) . "'>" . 
						    "<input name='update_totals[$TotalIndex][value]' type='hidden' value='" . $TotalDetails["Price"] . "'>" . 
						    "<input name='update_totals[$TotalIndex][class]' type='hidden' value='" . $TotalDetails["Class"] . "'>\n" . 
						    "<input type='hidden' name='update_totals[$TotalIndex][total_id]' value='" . $TotalDetails["TotalID"] . "'>" . '</td>' . 
				   '		<td align="right" class="' . $TotalStyle . '"><b>' . tep_draw_separator('pixel_trans.gif', '1', '17') . '</b>' . 
				   '	</tr>' . "\n";
		}
		else //the other total components are editable
		{
			echo '	<tr>' . "\n" .
				   '		<td align="right" class="' . $TotalStyle . '">' . "<input name='update_totals[$TotalIndex][title]' size='" . $max_length . "' value='" . tep_html_quotes($TotalDetails["Name"]) . "'>" . '</td>' . "\n" .
				   '		<td align="right" class="' . $TotalStyle . '">' . "<input name='update_totals[$TotalIndex][value]' size='10' value='" . $TotalDetails["Price"] . "' id='" . $id . "' onKeyUp=\"getTotals('shipping', '" . $default_tax_name . "')\">" . 
						    "<input type='hidden' name='update_totals[$TotalIndex][class]' value='" . $TotalDetails["Class"] . "'>" . 
						    "<input type='hidden' name='update_totals[$TotalIndex][total_id]' value='" . $TotalDetails["TotalID"] . "'>" . 
				   '		<td align="right" class="' . $TotalStyle . '"><b>' . tep_draw_separator('pixel_trans.gif', '1', '17') . '</b>' . 
					 '   </td>' . "\n" .
				   '	</tr>' . "\n";
		}
	}
	
		?>
</table>

	      </td>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
	<!-- End Order Total Block -->
	
	<!-- Begin Status Block -->
      <tr>
	      <td class="SubTitle"><?php echo MENUE_TITLE_STATUS; ?></td>
			</tr>
      <tr>
	      <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '1'); ?></td>
      </tr> 
      <tr>
        <td class="main">
				  
<table border="0" cellspacing="0" cellpadding="2" class="dataTableRow">
  <tr class="dataTableHeadingRow">
    <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_DATE_ADDED; ?></td>
    <td class="dataTableHeadingContent" align="left" width="10">&nbsp;</td>
    <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_CUSTOMER_NOTIFIED; ?></td>
    <td class="dataTableHeadingContent" align="left" width="10">&nbsp;</td>
    <td class="dataTableHeadingContent" align="left"><?php echo HEADING_TITLE_STATUS; ?></td>
   <td class="dataTableHeadingContent" align="left" width="10">&nbsp;</td>
    <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_COMMENTS; ?></td>
   </tr>
<?php
$orders_history_query = tep_db_query("select * from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_id = '" . tep_db_input($oID) . "' order by date_added");
if (tep_db_num_rows($orders_history_query)) {
  while ($orders_history = tep_db_fetch_array($orders_history_query)) {
    echo '  <tr>' . "\n" .
         '    <td class="smallText" align="center">' . tep_datetime_short($orders_history['date_added']) . '</td>' . "\n" .
         '    <td class="dataTableHeadingContent" align="left" width="10">&nbsp;</td>' . "\n" .
         '    <td class="smallText" align="center">';
    if ($orders_history['customer_notified'] == '1') {
      echo tep_image(DIR_WS_ICONS . 'tick.gif', ICON_TICK) . "</td>\n";
    } else {
      echo tep_image(DIR_WS_ICONS . 'cross.gif', ICON_CROSS) . "</td>\n";
    }
    echo '    <td class="dataTableHeadingContent" align="left" width="10">&nbsp;</td>' . "\n" .
         '    <td class="smallText" align="left">' . $orders_status_array[$orders_history['orders_status_id']] . '</td>' . "\n";
   echo '    <td class="dataTableHeadingContent" align="left" width="10">&nbsp;</td>' . "\n" .
           '    <td class="smallText" align="left">' . nl2br(tep_db_output($orders_history['comments'])) . '&nbsp;</td>' . "\n";
  echo '  </tr>' . "\n";
  }
} else {
  echo '  <tr>' . "\n" .
       '    <td class="smallText" colspan="5">' . TEXT_NO_ORDER_HISTORY . '</td>' . "\n" .
       '  </tr>' . "\n";
}
?>
</table>

			  </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '1'); ?></td>
      </tr>
      <tr>
			  <td>	
						
<table border="0" cellspacing="0" cellpadding="2" class="dataTableRow">
  <tr class="dataTableHeadingRow">
    <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_STATUS; ?></td>
    <td class="main" width="10">&nbsp;</td>
    <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_COMMENTS; ?></td>
  </tr>
	<tr>
	  <td>
		  <table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td class="main"><b><?php echo ENTRY_STATUS; ?></b></td>
          <td class="main" align="right"><?php echo tep_draw_pull_down_menu('status', $orders_statuses, $order->info['orders_status']); ?></td>
        </tr>
        <tr>
          <td class="main"><b><?php echo ENTRY_NOTIFY_CUSTOMER; ?></b></td>
          <td class="main" align="right"><?php echo tep_draw_checkbox_field('notify', '', false); ?></td>
        </tr>
        <tr>
          <td class="main"><b><?php echo ENTRY_NOTIFY_COMMENTS; ?></b></td>
          <td class="main" align="right"><?php echo tep_draw_checkbox_field('notify_comments', '', false); ?></td>
        </tr>
     </table>
	  </td>
    <td class="main" width="10">&nbsp;</td>
    <td class="main">
    <?php echo tep_draw_textarea_field('comments', 'soft', '40', '5', ''); ?>
    </td>
  </tr>
</table>
			  </td>
			</tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
	<!-- End of Status Block -->
	
	<!-- Begin Update Block -->
	
      <tr>
	      <td class="SubTitle"><?php echo MENUE_TITLE_UPDATE; ?></td>
			</tr>
      <tr>
	      <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '1'); ?></td>
      </tr>   
      <tr>
	      <td>
          <table width="100%" border="0" cellpadding="2" cellspacing="1">
            <tr>
              <td class="update1"><?php echo HINT_PRESS_UPDATE; ?></td>
              <td class="update2" width="10">&nbsp;</td>
              <td class="update3" width="10">&nbsp;</td>
              <td class="update4" width="10">&nbsp;</td>
              <td class="update5" width="120" align="center"><?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE); ?></td>
	          </tr>
          </table>
				</td>
      </tr>
	<!-- End of Update Block -->
	
      </form>
			
<?php
}
if($action == "add_product")
{
?>
      <tr>
        <td width="100%">
				  <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
		      <td class="pageHeading"><?php echo ADDING_TITLE; ?> (No. <?php echo $oID; ?>)</td>
              <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
              <td class="pageHeading" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_ORDERS_EDIT, tep_get_all_get_params(array('action'))) . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
            </tr>
          </table>
				</td>
      </tr>

<?php
	// ############################################################################
	//   Get List of All Products
	// ############################################################################

		$result = tep_db_query("
		SELECT products_name, p.products_id, categories_name, ptc.categories_id 
		FROM " . TABLE_PRODUCTS . " p 
		LEFT JOIN " . TABLE_PRODUCTS_DESCRIPTION . " pd 
		ON pd.products_id=p.products_id 
		LEFT JOIN " . TABLE_PRODUCTS_TO_CATEGORIES . " ptc 
		ON ptc.products_id=p.products_id 
		LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd 
		ON cd.categories_id=ptc.categories_id 
		WHERE pd.language_id = '" . (int)$languages_id . "' 
		ORDER BY categories_name");
		while($row = tep_db_fetch_array($result))
		{
			extract($row,EXTR_PREFIX_ALL,"db");
			$ProductList[$db_categories_id][$db_products_id] = $db_products_name;
			$CategoryList[$db_categories_id] = $db_categories_name;
			$LastCategory = $db_categories_name;
		}
		
	// ############################################################################
	//   Add Products Steps
	// ############################################################################
	echo '<tr><td><table border="0">' . "\n";
		
		// Set Defaults
			if(!isset($_POST['add_product_categories_id']))
			$add_product_categories_id = 0;

			if(!isset($_POST['add_product_products_id']))
			$add_product_products_id = 0;
			
			// Step 1: Choose Category
			echo '<tr class="dataTableRow">' . tep_draw_form('addProduct', FILENAME_ORDERS_EDIT,'oID=' . $_GET['oID'] . '&action=' . $_GET['action']) . "\n";
			echo '<td class="dataTableContent" align="right"><b>' . ADDPRODUCT_TEXT_STEP . ' 1:</b></td>' .  "\n";
			echo '<td class="dataTableContent" valign="top">';
			if (isset($_POST['add_product_categories_id'])) {
			$current_category_id = $_POST['add_product_categories_id'];
			}
			echo ' ' . tep_draw_pull_down_menu('add_product_categories_id', tep_get_category_tree(), $current_category_id, 'onChange="this.form.submit();"');
			echo '<input type="hidden" name="step" value="2">' . "\n";
			echo '</td>' . "\n";
			echo '<td class="dataTableContent">' . ADDPRODUCT_TEXT_STEP1 . '</td>' . "\n";
			echo '</form></tr>' . "\n";
			echo '<tr><td colspan="3">&nbsp;</td></tr>' . "\n";
		   
		// Step 2: Choose Product
           if(($_POST['step'] > 1) && ($_POST['add_product_categories_id'] > 0))
		   {
           echo '<tr class="dataTableRow">' . tep_draw_form('addProduct', FILENAME_ORDERS_EDIT,'oID=' . $_GET['oID'] . '&action=' . $_GET['action']) . "\n";
           echo '<td class="dataTableContent" align="right"><b>' . ADDPRODUCT_TEXT_STEP . ' 2: </b></td>' . "\n";
           echo '<td class="dataTableContent" valign="top"><select name="add_product_products_id" onChange="this.form.submit();">';
           $ProductOptions = "<option value='0'>" . ADDPRODUCT_TEXT_SELECT_PRODUCT . "\n";
           asort($ProductList[$_POST['add_product_categories_id']]);
           foreach($ProductList[$_POST['add_product_categories_id']] as $ProductID => $ProductName)
           {
              $ProductOptions .= "<option value='$ProductID'> $ProductName\n";
           }
		   if(isset($_POST['add_product_products_id'])){
         $ProductOptions = str_replace("value='" . $_POST['add_product_products_id'] . "'", "value='" . $_POST['add_product_products_id'] . "' selected=\"selected\"", $ProductOptions);
           }
		   echo ' ' . $ProductOptions .  ' ';
           echo '</select></td>' . "\n";
           echo '<input type="hidden" name="add_product_categories_id" value=' . $_POST['add_product_categories_id'] . '>';
           echo '<input type="hidden" name="step" value="3">' . "\n";
           echo '<td class="dataTableContent">' . ADDPRODUCT_TEXT_STEP2 . '</td>' . "\n";
           echo '</form></tr>' . "\n";
           echo '<tr><td colspan="3">&nbsp;</td></tr>' . "\n";
           }

		// Step 3: Choose Options
		if(($_POST['step'] > 2) && ($_POST['add_product_products_id'] > 0))
		
		{
			// Get Options for Products	
           $products_attributes_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . $_POST['add_product_products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "'");
    $products_attributes = tep_db_fetch_array($products_attributes_query);
    if ($products_attributes['total'] == 0) {
				echo '<tr class="dataTableRow">' . "\n";
				echo '<td class="dataTableContent" align="right"><b>' . ADDPRODUCT_TEXT_STEP . ' 3: </b></td>' . "\n";
				echo '<td class="dataTableContent" valign="top" colspan="2"><i>' . ADDPRODUCT_TEXT_OPTIONS_NOTEXIST . '</i></td>' . "\n";
				echo '</tr>' . "\n";
				$_POST['step'] = 4;
			}
			else //product options exist
			{
			echo '<tr class="dataTableRow">' . tep_draw_form('addProduct', FILENAME_ORDERS_EDIT,'oID=' . $_GET['oID'] . '&action=' . $_GET['action']) . "\n";
				echo '<td class="dataTableContent" align="right"><b>' . ADDPRODUCT_TEXT_STEP . ' 3: </b></td><td class="dataTableContent" valign="top">';
				
				$products_options_name_query = tep_db_query("select distinct popt.products_options_id, popt.products_options_name from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_ATTRIBUTES . " patrib where patrib.products_id='" . $_POST['add_product_products_id'] . "' and patrib.options_id = popt.products_options_id and popt.language_id = '" . (int)$languages_id . "' order by popt.products_options_name");
      while ($products_options_name = tep_db_fetch_array($products_options_name_query)) {
        $products_options_array = array();
        $products_options_query = tep_db_query("select pov.products_options_values_id, pov.products_options_values_name, pa.options_values_price, pa.price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " pa, " . TABLE_PRODUCTS_OPTIONS_VALUES . " pov where pa.products_id = '" . $_POST['add_product_products_id'] . "' and pa.options_id = '" . (int)$products_options_name['products_options_id'] . "' and pa.options_values_id = pov.products_options_values_id and pov.language_id = '" . (int)$languages_id . "'");
        while ($products_options = tep_db_fetch_array($products_options_query)) {
          $products_options_array[] = array('id' => $products_options['products_options_values_id'], 'text' => $products_options['products_options_values_name']);
          if ($products_options['options_values_price'] != '0') {
            $products_options_array[sizeof($products_options_array)-1]['text'] .= ' (' . $products_options['price_prefix'] . $currencies->display_price($products_options['options_values_price'], tep_get_tax_rate($product_info['products_tax_class_id'])) .') ';
          }
        }

        if(isset($_POST['add_product_options'])) {
          $selected_attribute = $_POST['add_product_options'][$products_options_name['products_options_id']];
        } else {
          $selected_attribute = false;
        }
			echo $products_options_name['products_options_name'] . ':' . "\n";
			echo tep_draw_pull_down_menu('add_product_options[' . $products_options_name['products_options_id'] . ']', $products_options_array, $selected_attribute) . '<br />' . "\n";
		}
		
				echo '</td>';
				echo '<td class="dataTableContent" align="center"><input type="submit" value="' . ADDPRODUCT_TEXT_OPTIONS_CONFIRM . '">';
				echo '<input type="hidden" name="add_product_categories_id" value=' . $_POST['add_product_categories_id']. '>';
				echo '<input type="hidden" name="add_product_products_id" value=' . $_POST['add_product_products_id'] . '>';
				echo '<input type="hidden" name="step" value="4">';
				echo '</td>' . "\n";
				echo '</form></tr>' . "\n";
			}

			echo '<tr><td colspan="3">&nbsp;</td></tr>' . "\n";
		}

		// Step 4: Confirm
		if($_POST['step'] > 3)
		
		{
		   	echo '<tr class="dataTableRow">' . tep_draw_form('addProduct', FILENAME_ORDERS_EDIT,'oID=' . $_GET['oID'] . '&action=' . $_GET['action']) . "\n";
			echo '<td class="dataTableContent" align="right"><b>' . ADDPRODUCT_TEXT_STEP . ' 4: </b></td>';
			echo '<td class="dataTableContent" valign="top"><input name="add_product_quantity" size="2" value="1"> ' . ADDPRODUCT_TEXT_CONFIRM_QUANTITY . '</td>';
			echo '<td class="dataTableContent" align="center"><input type="submit" value="' . ADDPRODUCT_TEXT_CONFIRM_ADDNOW . '">';

			if(is_array ($_POST['add_product_options']))
			{
				foreach($_POST['add_product_options'] as $option_id => $option_value_id)
				{
					echo '<input type="hidden" name="add_product_options[' . $option_id . ']" value="' . $option_value_id . '">';
				}
			}
			echo '<input type="hidden" name="add_product_categories_id" value=' . $_POST['add_product_categories_id'] . '>';
			echo '<input type="hidden" name="add_product_products_id" value=' . $_POST['add_product_products_id'] . '>';
			echo '<input type="hidden" name="step" value="5">';
			echo '</td>' . "\n";
			echo '</form></tr>' . "\n";
		}
		
		echo '</table></td></tr>' . "\n";
}  
?>
    </table></td>
<!-- body_text_eof //-->
  </tr></table>
<!-- body_eof //-->
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php');
?>