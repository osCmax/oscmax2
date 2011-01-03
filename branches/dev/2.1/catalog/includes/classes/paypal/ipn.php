<?php
/*
$Id: ipn.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

class paypal_ipn {
  // $_debug 0 == none, 1 == loose or 2 == strict
  var $_debug,$_debug_string, $key,$_response_string,$_debug_email,$_paypal_ipn_id;

  function paypal_ipn($email,$post_vars='',$session_id,$debug='0') {
    $this->_debug_email = $email;
    $this->_debug = $debug;
    $transaction_list = array('web_accept','cart','send_money','reversal'); //accepted transactions
    if ( !in_array($post_vars['txn_type'],$transaction_list) ) {
      if ($this->_debug) $this->send_email(UNKNOWN_TXN_TYPE,sprintf(UNKNOWN_TXN_TYPE_MSG, $post_vars['txn_type']));
    } else if(strlen($post_vars['txn_id']) == 17) {
      //Looks like a PayPal transaction
      $this->_init($post_vars,$session_id);
    } else {
      if ($this->_debug) $this->send_email(UNKNOWN_POST,sprintf(UNKNOWN_POST_MSG,$_SERVER['REMOTE_ADDR']));
    }
  }

//For now it seems that the only custom variable required is the session id
/*

  function set_custom_vars($var_array,$custom_list) {
    reset($var_array);
    while(list($key,$val) = each ($var_array)) {
      $customer_var = split('=',$val);
      for($i=0;$i < count($custom_list); $i++) {
        if( !strcmp($custom_list[$i],$customer_var[0])) $this->key[$customer_var[0]] = $customer_var[1];
      }
    }
  }
*/
  function _init($post_vars,$session_id) {
    $this->_debug_string = '';
    $this->key = array();
    $this->_response_string = 'cmd=_notify-validate';
    reset($post_vars);
    foreach ($post_vars as $var => $val) {
      if ($this->_debug) $this->_debug_string .= $var . '=' . $val .'&';
      if (get_magic_quotes_gpc()) $val = stripslashes($val);
      if (!strcasecmp($var,'cmd') || !eregi("^[_0-9a-z-]{1,34}$",$var)) {
        unset($var); unset($val);
      }
      if ($var != '') {
        if(!strcmp($var,'custom')){
          //assumes the custom variable is always specifiec as an array
          //$this->set_custom_vars(explode('&',$val),$custom_list);
          $this->key[$session_id] = $val;
        } else {
          $this->key[$var] = $val;
        }
        $this->_response_string .= '&' . $var . '=' . urlencode($val);
      }
    }
    unset($post_vars);
    if ($this->_debug > 1) $this->debug_email();
    if(!$this->_debug) unset($this->_debug_string);
  }

  function authenticate($domain) {
    $paypal_response = '';
    $curl_flag = function_exists('curl_exec');
    if($curl_flag) {
      $ch = @curl_init();
      @curl_setopt($ch, CURLOPT_URL, "https://$domain/cgi-bin/webscr");
      @curl_setopt($ch, CURLOPT_POST, true);
      @curl_setopt($ch, CURLOPT_POSTFIELDSIZE, 0);
      @curl_setopt($ch, CURLOPT_POSTFIELDS, $this->_response_string);
      @curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      @curl_setopt($ch, CURLOPT_TIMEOUT, 60);
      $paypal_response = @curl_exec($ch);
      @curl_close($ch);
      if($paypal_response == '') $curl_flag = false;
    }
    if(!$curl_flag) {
      $header .= "POST /cgi-bin/webscr HTTP/1.0\r\n";
      $header .= "Content-Type: application/x-www-form-urlencoded\r\n";
      $header .= "Content-Length: ".strlen($this->_response_string)."\r\n\r\n";
      $socket = 'ssl://'; $port = '443';
      $fp = @fsockopen ($socket.$domain,$port, $errno, $errstr, 30);
      if(!$fp) {
        $socket = 'tcp://'; $port = '80';
        $fp = @fsockopen ($socket.$domain,$port, $errno, $errstr, 30);
      }
      if(!$fp) {
          $paypal_https_response = @file('https://'.$domain.'/cgi-bin/webscr?'.$this->_response_string);
          $paypal_response = @$paypal_https_response[0];
          if (!$paypal_response) {
            $paypal_http_response = @file('http://'.$domain.'/cgi-bin/webscr?'.$this->_response_string);
            $paypal_response = @$paypal_http_response[0];
            if (!$paypal_response && ($this->_debug > 1)) $this->send_email(HTTP_ERROR,sprintf(HTTP_ERROR_MSG,$curl_flag,$socket,$domain,$port));
          }
      } else {
        @fputs($fp, $header . $this->_response_string);
        while (!feof($fp)) {
          $paypal_response .= @fgets($fp, 1024);
        }
        @fclose($log);
      }
      unset($this->_response_string);
    }

    /*if($this->_debug > 1) {
      $log = @fopen("ipn.txt", "w");
      @fwrite($log,$paypal_response);
      @fclose($log);
    }*/

    if (strstr($paypal_response,'VERIFIED')) {
      if($this->_debug > 1) $this->send_email(RESPONSE_VERIFIED,sprintf(RESPONSE_MSG,$curl_flag,$socket,$domain,$port,$paypal_response));
      return true;
    } else if (strstr($paypal_response,'INVALID')) {
      if($this->_debug > 1) $this->send_email(RESPONSE_INVALID,sprintf(RESPONSE_MSG,$curl_flag,$socket,$domain,$port,$paypal_response));
      return false;
    } else {
      if($this->_debug) $this->send_email(RESPONSE_UNKNOWN,sprintf(RESPONSE_MSG,$curl_flag,$socket,$domain,$port,$paypal_response));
      return false;
    }
  }

 //Test both receiver email address and business ID
 function validate_receiver_email($receiver_email,$business) {
    if(!strcmp($receiver_email,$this->key['receiver_email']) && !strcmp($business,$this->key['business'])) {
      if($this->_debug > 1) $this->send_email(EMAIL_RECEIVER,sprintf(EMAIL_RECEIVER_MSG,$receiver_email,$business,$this->key['receiver_email'],$this->key['business']));
      return true;
    } else {
      if($this->_debug) $this->send_email(EMAIL_RECEIVER,sprintf(EMAIL_RECEIVER_ERROR_MSG,$receiver_email,$business,$this->key['receiver_email'],$this->key['business'],$this->key['txn_id']));
      return false;
    }
  }

 function unique_txn_id() {
    $txn_id_query = tep_db_query("select paypal_ipn_id,txn_id from " . TABLE_PAYPAL_IPN . " where txn_id = '" . $this->key['txn_id'] . "'");
    if (!tep_db_num_rows($txn_id_query)) { //txn_id doesn't exist
      return true;
    } else {
      if($this->_debug > 1) $this->send_email(TXN_DUPLICATE,sprintf(TXN_DUPLICATE_MSG,$this->key['txn_id']));
      return false;
    }
 }

  //retrieve the id value of an associated parameter from db table
  //i.e get_name_id('txn_type_id','txn_type_name',$this->key['txn_type'],$languages_id,TABLE_PAYPAL_IPN_TXN_TYPE)
  //However this seems to be an overkill especially as we might be racing against the customer's
  //eagerness to click the PayPal continue button!
  /*function get_name_id($column_name,$column_id,$column_value,$languages_id,$table_name) {
      $sql_query = tep_db_query("select ".$column_name." from " . $table_name . " where ".$column_id." = '" . $column_value . "' and language_id = '".(int)$languages_id."'");
    if(!tep_db_num_rows($sql_query)) {
      return '';
    } else {
      $result = tep_db_fetch_array($sql_query);
      return $result[$column_name];
    }
  }*/

  function insert_ipn_txn() {
    //because get_name_id() is not being used, $languages_id is no longer needed
    $txn_type_id = array ('web_accept' => 1, 'cart' => 2 , 'send_money' => 3, 'reversal' => 4 );
    $reason_code_id = array ('chargeback' => 1, 'guarantee' => 2 , 'buyer_complaint' => 3, 'other' => 4 );
    $payment_type_id = array ('instant' => 1, 'echeck' => 2 );
    $payment_staus_id = array ('Completed' => 1, 'Pending' => 2 , 'Failed' => 3, 'Denied' => 4, 'Refunded' => 5, 'Cancelled' => 6);
    $pending_reason_id = array ('echeck' => 1, 'multi-currency' => 2 , 'intl' => 3, 'verify' => 4, 'address' => 5, 'upgrade' => 6, 'unilateral' => 7, 'other' => 8);
    $mc_currency_id = array ('USD' => 1, 'GBP' => 2 , 'EUR' => 3, 'CAD' => 4, 'JPY' => 5 );
    $address_status_id = array ('confirmed' => 1, 'unconfirmed' => 2 );
    $sql_data_array = array(
        'txn_type'            => $txn_type_id[$this->key['txn_type']],
        'reason_code'         => $reason_code_id[$this->key['reason_code']],
        'payment_type'        => $payment_type_id[$this->key['payment_type']],
        'payment_status'      => $payment_staus_id[$this->key['payment_status']],
        'pending_reason'      => $pending_reason_id[$this->key['pending_reason']],
        'invoice'             => $this->key['invoice'],
        'mc_currency'         => $mc_currency_id[$this->key['mc_currency']],
        'first_name'          => $this->key['first_name'],
        'last_name'           => $this->key['last_name'],
        'payer_business_name' => $this->key['payer_business_name'],
        'address_name'        => $this->key['address_name'],
        'address_street'      => $this->key['address_street'],
        'address_city'        => $this->key['address_city'],
        'address_state'       => $this->key['address_state'],
        'address_zip'         => $this->key['address_zip'],
        'address_country'     => $this->key['address_country'],
        'address_status'      => $address_status_id[$this->key['address_status']],
        'address_owner'       => $this->key['address_owner'],
        'payer_email'         => $this->key['payer_email'],
        'ebay_address_id'     => $this->key['ebay_address_id'],
        'payer_id'            => $this->key['payer_id'],
        'payer_status'        => $this->key['payer_status'],
        'payment_date'        => $this->key['payment_date'],
        'business'            => $this->key['business'],
        'receiver_email'      => $this->key['receiver_email'],
        'receiver_id'         => $this->key['receiver_id'],
        'paypal_address_id'   => $this->key['papal_address_id'],
        'txn_id'              => $this->key['txn_id'],
        'notify_version'      => $this->key['notify_version'],
        'verify_sign'         => $this->key['verify_sign'],
        'date_added'          => 'now()');
    tep_db_perform(TABLE_PAYPAL_IPN, $sql_data_array);
    $this->_paypal_ipn_id = tep_db_insert_id();
    $sql_data_array = array(
        'paypal_ipn_id'       => $this->_paypal_ipn_id,
        'num_cart_items'      => $this->key['txn_type'] == 'cart' ? $this->key['num_cart_items'] : 1,
        'mc_gross'            => $this->key['mc_gross'],
        'mc_fee'              => $this->key['mc_fee'],
        'payment_gross'       => $this->key['payment_gross'],
        'payment_fee'         => $this->key['payment_fee'],
        'settle_amount'       => $this->key['settle_amount'],
        'settle_currency'     => $this->key['settle_currency'],
        'exchange_rate'       => $this->key['exchange_rate']);
    tep_db_perform(TABLE_PAYPAL_IPN_ORDERS, $sql_data_array);
    $sql_data_array = array(
        'paypal_ipn_id'       => $this->_paypal_ipn_id,
        'memo'                => tep_db_prepare_input($this->key['memo']));
    tep_db_perform(TABLE_PAYPAL_IPN_ORDERS_MEMO, $sql_data_array);
    if($this->_debug > 1) $this->send_email(IPN_TXN_INSERT,sprintf(IPN_TXN_INSERT_MSG,$this->_paypal_ipn_id));
  }

  function get_paypal_ipn_id() {
    return $this->_paypal_ipn_id;
  }

  //returns the IPN transaction type
  //For Version 1.5 they are web_accept,cart,send_money and reversal
  function txn_type() {
    return $this->key['txn_type'];
  }

  //Debug function to output the IPN to the display
  function debug_info() {
    $debug_string = '';
    reset($this->key);
    foreach ($this->key as $var => $val) $debug_string .= "$var => $val\n<br/>";
    return $debug_string;
  }

  //Debug function to email the PayPal account holder
  function debug_email() {
    $debug_mail_string = sprintf(DEBUG_MSG,str_replace('&', "\r\n", $this->_debug_string ),str_replace('&', "\r\n", $this->_response_string ));
    $this->send_email(DEBUG,$debug_mail_string);
  }

  function send_email($subject='',$msg='') {
    $this->_email('', $this->_debug_email, $subject,  nl2br($msg), STORE_NAME, $this->_debug_email);
  }

  function _email($to_name,$to_address,$subject,$text,$from_name,$from_address) {
    $from_address = strtolower(trim($from_address));
    $subject = STORE_NAME." PayPal IPN: ".$subject;
    $msg = strip_tags($text);
    tep_mail($to_name, $to_address, $subject, $msg, $from_name, $from_address);
  }
}//end class
?>
