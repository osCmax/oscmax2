<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  class authorizenet_cc_aim {
    var $code, $title, $description, $enabled;
    var $accepted_cc, $card_types, $allowed_types;

//class constructor
    function authorizenet_cc_aim() {
      global $order;

      $this->signature = 'authorizenet|authorizenet_cc_aim|1.0|2.2';
      $this->api_version = '3.1';

      $this->code = 'authorizenet_cc_aim';
      $this->title = MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_TITLE;
      $this->public_title = MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_PUBLIC_TITLE;
      $this->description = MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_AUTHORIZENET_CC_AIM_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_AUTHORIZENET_CC_AIM_STATUS == 'True') ? true : false);
//MOD for credit card selection
      $this->accepted_cc = MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ACCEPTED_CC;

//MOD array for credit card selection
      $this->card_types = array('Visa' => MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_VISA,
                                'Mastercard' => MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_MASTERCARD,
                                'Amex' => MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_AMEX,
                                'Discover' => MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TEXT_DISCOVER);

      $this->allowed_types = array();

// Credit card list
      $cc_array = explode(', ', MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ACCEPTED_CC);
      while (list($key, $value) = each($cc_array)) {
        $this->allowed_types[$value] = $this->card_types[$value];
      }

      if ((int)MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();
    }

// class methods

//MOD concatenate to get CC images
    function get_cc_images() {
      $cc_images = '';
      reset($this->allowed_types);
      while (list($key, $value) = each($this->allowed_types)) {
        $cc_images .= tep_image(DIR_WS_ICONS . $key . '.gif', $value);
      }
      return $cc_images;
    }

    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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
      return false;
    }

    function selection() {
      return array('id' => $this->code,
                   'module' => $this->public_title . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $this->get_cc_images());
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      global $order;

      for ($i=1; $i<13; $i++) {
        $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%B',mktime(0,0,0,$i,1,2000)));
      }

      $today = getdate(); 
      for ($i=$today['year']; $i < $today['year']+10; $i++) {
        $expires_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
      }

      $confirmation = array('fields' => array(array('title' => $this->get_cc_images()),
                                              array('title' => MODULE_PAYMENT_AUTHORIZENET_CC_AIM_CREDIT_CARD_OWNER,
                                                    'field' => tep_draw_input_field('cc_owner', $order->billing['firstname'] . ' ' . $order->billing['lastname'])),
                                              array('title' => MODULE_PAYMENT_AUTHORIZENET_CC_AIM_CREDIT_CARD_NUMBER,
                                                    'field' => tep_draw_input_field('cc_number_nh-dns')),
                                              array('title' => MODULE_PAYMENT_AUTHORIZENET_CC_AIM_CREDIT_CARD_EXPIRES,
                                                    'field' => tep_draw_pull_down_menu('cc_expires_month', $expires_month) . '&nbsp;' . tep_draw_pull_down_menu('cc_expires_year', $expires_year)),
                                              array('title' => MODULE_PAYMENT_AUTHORIZENET_CC_AIM_CREDIT_CARD_CVC,
                                                    'field' => tep_draw_input_field('cc_cvc_nh-dns', '', 'size="5" maxlength="4"'))));

      return $confirmation;
    }

    function process_button() {
      return false;
    }

    function before_process() {
      global $_POST, $customer_id, $order, $sendto, $currency;

// A.NET INVOICE NUMBER FIX
// find the next order_id to pass as x_Invoice_Num
        $next_inv = '';
        $inv_id = tep_db_query("select orders_id from " . TABLE_ORDERS . " order by orders_id DESC limit 1");
        $last_inv = tep_db_fetch_array($inv_id);
        $next_inv = $last_inv['orders_id']+1;
// END A.NET INVOICE NUMBER FIX
      $params = array('x_login' => substr(MODULE_PAYMENT_AUTHORIZENET_CC_AIM_LOGIN_ID, 0, 20),
                      'x_tran_key' => substr(MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_KEY, 0, 16),
                      'x_version' => '3.1',
                      'x_delim_data' => 'TRUE',
                      'x_delim_char' => ',',
                      'x_encap_char' => '"',
                      'x_relay_response' => 'FALSE',
                      'x_first_name' => substr($order->billing['firstname'], 0, 50),
                      'x_last_name' => substr($order->billing['lastname'], 0, 50),
                      'x_company' => substr($order->billing['company'], 0, 50),
                      'x_address' => substr($order->billing['street_address'], 0, 60),
                      'x_city' => substr($order->billing['city'], 0, 40),
                      'x_state' => substr($order->billing['state'], 0, 40),
                      'x_zip' => substr($order->billing['postcode'], 0, 20),
                      'x_country' => substr($order->billing['country']['title'], 0, 60),
                      'x_phone' => substr($order->customer['telephone'], 0, 25),
                      'x_cust_id' => substr($customer_id, 0, 20),
                      'x_customer_ip' => tep_get_ip_address(),
                      'x_email' => substr($order->customer['email_address'], 0, 255),
// ADD Invoice_Num next line
                      'x_Invoice_Num' => $next_inv,
                      'x_description' => substr(STORE_NAME, 0, 255),
                      'x_amount' => substr($this->format_raw($order->info['total']), 0, 15),
                      'x_currency_code' => substr($currency, 0, 3),
                      'x_method' => 'CC',
                      'x_type' => ((MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_METHOD == 'Capture') ? 'AUTH_CAPTURE' : 'AUTH_ONLY'),
                      'x_card_num' => substr($_POST['cc_number_nh-dns'], 0, 22),
                      'x_exp_date' => $_POST['cc_expires_month'] . $_POST['cc_expires_year'],
                      'x_card_code' => substr($_POST['cc_cvc_nh-dns'], 0, 4));

      if (is_numeric($sendto) && ($sendto > 0)) {
        $params['x_ship_to_first_name'] = substr($order->delivery['firstname'], 0, 50);
        $params['x_ship_to_last_name'] = substr($order->delivery['lastname'], 0, 50);
        $params['x_ship_to_company'] = substr($order->delivery['company'], 0, 50);
        $params['x_ship_to_address'] = substr($order->delivery['street_address'], 0, 60);
        $params['x_ship_to_city'] = substr($order->delivery['city'], 0, 40);
        $params['x_ship_to_state'] = substr($order->delivery['state'], 0, 40);
        $params['x_ship_to_zip'] = substr($order->delivery['postcode'], 0, 20);
        $params['x_ship_to_country'] = substr($order->delivery['country']['title'], 0, 60);
      }

      if (MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_MODE == 'Test') {
        $params['x_test_request'] = 'TRUE';
      }

      $tax_value = 0;

      foreach ($order->info['tax_groups'] as $key => $value) {
        if ($value > 0) {
          $tax_value += $this->format_raw($value);
        }
      }

      if ($tax_value > 0) {
        $params['x_tax'] = $this->format_raw($tax_value);
      }

      $params['x_freight'] = $this->format_raw($order->info['shipping_cost']);

      $post_string = '';

      foreach ($params as $key => $value) {
        $post_string .= $key . '=' . urlencode(trim($value)) . '&';
      }

      $post_string = substr($post_string, 0, -1);

      for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
        $post_string .= '&x_line_item=' . urlencode($i+1) . '<|>' . urlencode(substr($order->products[$i]['name'], 0, 31)) . '<|>' . urlencode(substr($order->products[$i]['name'], 0, 255)) . '<|>' . urlencode($order->products[$i]['qty']) . '<|>' . urlencode($this->format_raw($order->products[$i]['final_price'])) . '<|>' . urlencode($order->products[$i]['tax'] > 0 ? 'YES' : 'NO');
      }

      switch (MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_SERVER) {
        case 'Live':
          $gateway_url = 'https://secure.authorize.net/gateway/transact.dll';
          break;

        default:
          $gateway_url = 'https://test.authorize.net/gateway/transact.dll';
          break;
      }

      $transaction_response = $this->sendTransactionToGateway($gateway_url, $post_string);

      if (!empty($transaction_response)) {
        $regs = preg_split("/,(?=(?:[^\"]*\"[^\"]*\")*(?![^\"]*\"))/", $transaction_response);

        foreach ($regs as $key => $value) {
          $regs[$key] = substr($value, 1, -1); // remove double quotes
        }
      } else {
        $regs = array('-1', '-1', '-1');
      }

      $error = false;

      if ($regs[0] == '1') {
        if (tep_not_null(MODULE_PAYMENT_AUTHORIZENET_CC_AIM_MD5_HASH)) {
          if (strtoupper($regs[37]) != strtoupper(md5(MODULE_PAYMENT_AUTHORIZENET_CC_AIM_MD5_HASH . MODULE_PAYMENT_AUTHORIZENET_CC_AIM_LOGIN_ID . $regs[6] . $this->format_raw($order->info['total'])))) {
            $error = 'general';
          }
        }
      } else {
        switch ($regs[2]) {
          case '7':
            $error = 'invalid_expiration_date';
            break;

          case '8':
            $error = 'expired';
            break;

          case '6':
          case '17':
          case '28':
            $error = 'declined';
            break;

          case '78':
            $error = 'cvc';
            break;

          default:
            $error = 'general';
            break;
        }
      }

      if ($error != false) {
        tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=' . $this->code . '&error=' . $error, 'SSL'));
      }
    }

    function after_process() {
      return false;
    }

    function get_error() {
      global $_GET;

      $error_message = MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ERROR_GENERAL;

      switch ($_GET['error']) {
        case 'invalid_expiration_date':
          $error_message = MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ERROR_INVALID_EXP_DATE;
          break;

        case 'expired':
          $error_message = MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ERROR_EXPIRED;
          break;

        case 'declined':
          $error_message = MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ERROR_DECLINED;
          break;

        case 'cvc':
          $error_message = MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ERROR_CVC;
          break;

        default:
          $error_message = MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ERROR_GENERAL;
          break;
      }

      $error = array('title' => MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ERROR_TITLE,
                     'error' => $error_message);

      return $error;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Authorize.net Credit Card AIM', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_STATUS', 'False', 'Do you want to accept Authorize.net Credit Card AIM payments?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Login ID', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_LOGIN_ID', '', 'The login ID used for the Authorize.net service', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Transaction Key', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_KEY', '', 'Transaction key used for encrypting data', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('MD5 Hash', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_MD5_HASH', '', 'The MD5 hash value to verify transactions with', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Server', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_SERVER', 'Live', 'Perform transactions on the live or test server. The test server should only be used by developers with Authorize.net test accounts.', '6', '0', 'tep_cfg_select_option(array(\'Live\', \'Test\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Mode', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_MODE', 'Live', 'Transaction mode used for processing orders', '6', '0', 'tep_cfg_select_option(array(\'Live\', \'Test\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Method', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_METHOD', 'Authorization', 'The processing method to use for each transaction.', '6', '0', 'tep_cfg_select_option(array(\'Authorization\', \'Capture\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('cURL Program Location', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_CURL', '/usr/bin/curl', 'The location to the cURL program application.', '6', '0' , now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Accepted Credit Cards', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ACCEPTED_CC', 'Visa, Mastercard', 'The credit cards you currently accept', '6', '0', '_selectOptions(array(\'Visa\', \'Mastercard\', \'Amex\',\'Discover\'), ', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_AUTHORIZENET_CC_AIM_STATUS', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_LOGIN_ID', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_KEY', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_MD5_HASH', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_SERVER', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_MODE', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_TRANSACTION_METHOD', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ZONE', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ORDER_STATUS_ID', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_SORT_ORDER', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_CURL', 'MODULE_PAYMENT_AUTHORIZENET_CC_AIM_ACCEPTED_CC');
    }

    function _hmac($key, $data) {
      if (function_exists('mhash') && defined('MHASH_MD5')) {
        return bin2hex(mhash(MHASH_MD5, $data, $key));
      }

// RFC 2104 HMAC implementation for php.
// Creates an md5 HMAC.
// Eliminates the need to install mhash to compute a HMAC
// Hacked by Lance Rushing

      $b = 64; // byte length for md5
      if (strlen($key) > $b) {
        $key = pack("H*",md5($key));
      }

      $key = str_pad($key, $b, chr(0x00));
      $ipad = str_pad('', $b, chr(0x36));
      $opad = str_pad('', $b, chr(0x5c));
      $k_ipad = $key ^ $ipad ;
      $k_opad = $key ^ $opad;

      return md5($k_opad . pack("H*",md5($k_ipad . $data)));
    }

    function sendTransactionToGateway($url, $parameters) {
      $server = parse_url($url);

      if (isset($server['port']) === false) {
        $server['port'] = ($server['scheme'] == 'https') ? 443 : 80;
      }

      if (isset($server['path']) === false) {
        $server['path'] = '/';
      }

      if (isset($server['user']) && isset($server['pass'])) {
        $header[] = 'Authorization: Basic ' . base64_encode($server['user'] . ':' . $server['pass']);
      }

      if (function_exists('curl_init')) {
        $curl = curl_init($server['scheme'] . '://' . $server['host'] . $server['path'] . (isset($server['query']) ? '?' . $server['query'] : ''));
        curl_setopt($curl, CURLOPT_PORT, $server['port']);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_SSLVERSION, 3);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_FORBID_REUSE, 1);
        curl_setopt($curl, CURLOPT_FRESH_CONNECT, 1);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $parameters);

        $result = curl_exec($curl);

        curl_close($curl);
      } else {
        exec(escapeshellarg(MODULE_PAYMENT_AUTHORIZENET_CC_AIM_CURL) . ' -d ' . escapeshellarg($parameters) . ' "' . $server['scheme'] . '://' . $server['host'] . $server['path'] . (isset($server['query']) ? '?' . $server['query'] : '') . '" -P ' . $server['port'] . ' -k', $result);
        $result = implode("\n", $result);
      }

      return $result;
    }

// format prices without currency formatting
    function format_raw($number, $currency_code = '', $currency_value = '') {
      global $currencies, $currency;

      if (empty($currency_code) || !$this->is_set($currency_code)) {
        $currency_code = $currency;
      }

      if (empty($currency_value) || !is_numeric($currency_value)) {
        $currency_value = $currencies->currencies[$currency_code]['value'];
      }

      return number_format(tep_round($number * $currency_value, $currencies->currencies[$currency_code]['decimal_places']), $currencies->currencies[$currency_code]['decimal_places'], '.', '');
    }
  }
  //MOD Credit Card Checkbox Implementation
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
