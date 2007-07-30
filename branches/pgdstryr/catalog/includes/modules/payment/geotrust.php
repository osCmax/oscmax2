<?php
/*
$Id: geotrust.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax / Paul Kim

  Released under the GNU General Public License
*/

  class geotrust{
    var $code, $title, $description, $enabled;

// class constructor
    function geotrust() {
      global $order;

      $this->code = 'geotrust';
      $this->title = MODULE_PAYMENT_GEOTRUST_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_GEOTRUST_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_GEOTRUST_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_GEOTRUST_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_GEOTRUST_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_GEOTRUST_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

      $this->form_action_url = 'https://developer.skipjackic.com/scripts/EvolvCC.dll?Authorize';
    }

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_GEOTRUST_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_GEOTRUST_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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
            '    var cc_number = document.checkout_payment.geotrust_cc_number.value;' . "\n" .
            '    if (cc_number == "" || cc_number.length < ' . CC_NUMBER_MIN_LENGTH . ') {' . "\n" .
            '      error_message = error_message + "' . MODULE_PAYMENT_GEOTRUST_TEXT_JS_CC_NUMBER . '";' . "\n" .
            '      error = 1;' . "\n" .
            '    }' . "\n" .
            '  }' . "\n";

      return $js;
    }

    function selection() {
      global $order;

      for ($i=1; $i < 13; $i++) {
        $expires_month[] = array('id' => sprintf('%02d', $i), 'text' => strftime('%B',mktime(0,0,0,$i,1,2000)));
      }

      $today = getdate(); 
      for ($i=$today['year']; $i < $today['year']+10; $i++) {
        $expires_year[] = array('id' => strftime('%y',mktime(0,0,0,1,1,$i)), 'text' => strftime('%Y',mktime(0,0,0,1,1,$i)));
      }

      $selection = array('id' => $this->code,
                         'module' => $this->title,
                         'fields' => array(array('title' => MODULE_PAYMENT_GEOTRUST_TEXT_CREDIT_CARD_OWNER_FIRST_NAME,
                                                 'field' => tep_draw_input_field('geotrust_cc_owner_firstname', $order->billing['firstname'])),
                                           array('title' => MODULE_PAYMENT_GEOTRUST_TEXT_CREDIT_CARD_OWNER_LAST_NAME,
                                                 'field' => tep_draw_input_field('geotrust_cc_owner_lastname', $order->billing['lastname'])),
                                           array('title' => MODULE_PAYMENT_GEOTRUST_TEXT_CREDIT_CARD_NUMBER,
                                                 'field' => tep_draw_input_field('geotrust_cc_number')),
                                           array('title' => MODULE_PAYMENT_GEOTRUST_TEXT_CREDIT_CARD_EXPIRES,
                                                 'field' => tep_draw_pull_down_menu('geotrust_cc_expires_month', $expires_month) . '&nbsp;' . tep_draw_pull_down_menu('geotrust_cc_expires_year', $expires_year)),
                                           array('title' => MODULE_PAYMENT_GEOTRUST_TEXT_CREDIT_CARD_CVV2,
                                                 'field' => tep_draw_input_field('geotrust_cc_cvv2', '', 'size="4" maxlength="3"') . '&nbsp;<small>' . MODULE_PAYMENT_GEOTRUST_TEXT_CREDIT_CARD_CVV2_LOCATION . '</small>')));

      return $selection;
    }

    function pre_confirmation_check() {
      global $HTTP_POST_VARS;

      include(DIR_WS_CLASSES . 'cc_validation.php');

      $cc_validation = new cc_validation();
      $result = $cc_validation->validate($HTTP_POST_VARS['geotrust_cc_number'], $HTTP_POST_VARS['geotrust_cc_expires_month'], $HTTP_POST_VARS['geotrust_cc_expires_year']);

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
        $payment_error_return = 'payment_error=' . $this->code . '&error=' . urlencode($error) . '&geotrust_cc_owner_firstname=' . urlencode($HTTP_POST_VARS['geotrust_cc_owner_firstname']) . '&geotrust_cc_owner_lastname=' . urlencode($HTTP_POST_VARS['geotrust_cc_owner_lastname']) . '&geotrust_cc_expires_month=' . $HTTP_POST_VARS['geotrust_cc_expires_month'] . '&geotrust_cc_expires_year=' . $HTTP_POST_VARS['geotrust_cc_expires_year'];

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
                            'fields' => array(array('title' => MODULE_PAYMENT_GEOTRUST_TEXT_CREDIT_CARD_OWNER,
                                                    'field' => $HTTP_POST_VARS['geotrust_cc_owner_firstname'] . ' ' . $HTTP_POST_VARS['geotrust_cc_owner_lastname']),
                                              array('title' => MODULE_PAYMENT_GEOTRUST_TEXT_CREDIT_CARD_NUMBER,
                                                    'field' => substr($this->cc_card_number, 0, 4) . str_repeat('X', (strlen($this->cc_card_number) - 8)) . substr($this->cc_card_number, -4)),
                                              array('title' => MODULE_PAYMENT_GEOTRUST_TEXT_CREDIT_CARD_EXPIRES,
                                                    'field' => strftime('%B, %Y', mktime(0,0,0,$HTTP_POST_VARS['geotrust_cc_expires_month'], 1, '20' . $HTTP_POST_VARS['geotrust_cc_expires_year'])))));

      return $confirmation;
    }

    function process_button() {
      global $HTTP_POST_VARS, $order;

	   $process_button_string =  tep_draw_hidden_field('Month', $this->cc_expiry_month) .
							   tep_draw_hidden_field('Year', substr($this->cc_expiry_year, -2)) .
                               tep_draw_hidden_field('Accountnumber', $this->cc_card_number) .
							   tep_draw_hidden_field('Serialnumber', MODULE_PAYMENT_GEOTRUST_MERCHANT_ID) .
                               tep_draw_hidden_field('Ordernumber', STORE_NAME . date('YmdHis')) .
                               tep_draw_hidden_field('Transactionamount', number_format($order->info['total'], 2, '', '')) .
							   tep_draw_hidden_field('Orderstring', 'Teanas~' . date('YmdHis') . '~' . number_format($order->info['total'], 2, '', '') . '~1~Y||') .
							   tep_draw_hidden_field('cvv2', $HTTP_POST_VARS['geotrust_cc_cvv2']) .
                               tep_draw_hidden_field('sjname', $HTTP_POST_VARS['geotrust_cc_owner_firstname'] . ' ' . $HTTP_POST_VARS['geotrust_cc_owner_lastname']) .
                               tep_draw_hidden_field('Streetaddress', $order->billing['street_address']) .
                               tep_draw_hidden_field('Streetaddress2', $order->billing['suburb']) .
                               tep_draw_hidden_field('City', $order->billing['city']) .
                               tep_draw_hidden_field('State', $order->billing['state']) .
                               tep_draw_hidden_field('Zipcode', $order->billing['postcode']) .
                               tep_draw_hidden_field('Country', $order->billing['country']['title']) .
                               tep_draw_hidden_field('Shiptophone', $order->customer['telephone']) .
                               tep_draw_hidden_field('Email', $order->customer['email_address']) .
                               tep_draw_hidden_field('Shiptoname', $order->delivery['firstname'] . ' ' . $order->delivery['lastname']) .
                               tep_draw_hidden_field('Shiptostreetaddress', $order->delivery['street_address']) .
                               tep_draw_hidden_field('Shiptostreetaddress2', $order->delivery['suburb']) .
                               tep_draw_hidden_field('Shiptocity', $order->delivery['city']) .
                               tep_draw_hidden_field('Shiptostate', $order->delivery['state']) .
                               tep_draw_hidden_field('Shiptozipcode', $order->delivery['postcode']) .
                               tep_draw_hidden_field('Shiptocountry', $order->delivery['country']['title']);

      return $process_button_string;
    }

    function before_process() {
      global $HTTP_POST_VARS;

      if ($HTTP_POST_VARS['szIsApproved'] != '1') {
			tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(MODULE_PAYMENT_GEOTRUST_TEXT_ERROR_MESSAGE), 'SSL', true, false));
      }
    }

    function after_process() {
      return false;
    }

    function get_error() {
      global $HTTP_GET_VARS;

      $error = array('title' => MODULE_PAYMENT_GEOTRUST_TEXT_ERROR,
                     'error' => stripslashes(urldecode($HTTP_GET_VARS['error'])));

      return $error;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_GEOTRUST_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable GeoTrust QuickPayments Module', 'MODULE_PAYMENT_GEOTRUST_STATUS', 'True', 'Do you want to accept GeoTrust QuickPayments?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Merchant ID', 'MODULE_PAYMENT_GEOTRUST_MERCHANT_ID', 'serial #', 'Merchant Serial # to use for the GEOTRUST QuickPayments service', '6', '2', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_GEOTRUST_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_GEOTRUST_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_GEOTRUST_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_GEOTRUST_STATUS', 'MODULE_PAYMENT_GEOTRUST_MERCHANT_ID', 'MODULE_PAYMENT_GEOTRUST_ZONE', 'MODULE_PAYMENT_GEOTRUST_ORDER_STATUS_ID', 'MODULE_PAYMENT_GEOTRUST_SORT_ORDER');
    }
  }
?>
