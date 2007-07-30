<?php
/*
$Id: pm2checkout.php 14 2006-07-28 17:42:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
  Updated April 1 2005 by Alex Seto (me at alexseto.com)

  Updates May 13 2004 by http://www.rayservers.com
*/

  class pm2checkout {
    var $code, $title, $description, $enabled;

// class constructor
    function pm2checkout() {
      global $order;

      $this->code = 'pm2checkout';
      $this->title = MODULE_PAYMENT_2CHECKOUT_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_2CHECKOUT_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_2CHECKOUT_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_2CHECKOUT_STATUS == 'True') ? true : false);
      $this->check_hash = ((MODULE_PAYMENT_2CHECKOUT_CHECK_HASH == 'True') ? true : false);
      $this->secret_word = MODULE_PAYMENT_2CHECKOUT_SECRET_WORD;
      $this->login_id = MODULE_PAYMENT_2CHECKOUT_LOGIN;

      if ((int)MODULE_PAYMENT_2CHECKOUT_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_2CHECKOUT_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

      // $this->form_action_url = 'https://www.2checkout.com/cgi-bin/Abuyers/purchase.2c';
      $this->form_action_url = 'https://www2.2checkout.com/2co/buyer/purchase';
    }

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_2CHECKOUT_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_2CHECKOUT_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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

    function selection() {  // from Paypal_IPN
      $img_visa = DIR_WS_MODULES . 'payment/2co/images/visa.gif';
      $img_mc = DIR_WS_MODULES . 'payment/2co/images/mastercard.gif';
      $img_discover = DIR_WS_MODULES . 'payment/2co/images/discover.gif';
      $img_amex = DIR_WS_MODULES . 'payment/2co/images/amex.gif';
      $img_diners = DIR_WS_MODULES . 'payment/2co/images/diners.gif';
      $img_jcb = DIR_WS_MODULES . 'payment/2co/images/jcb.gif';
      $co_cc_txt = sprintf(MODULE_PAYMENT_2CHECKOUT_CC_TEXT,
                  tep_image($img_visa,' Visa ','','','align=ABSMIDDLE'),
                  tep_image($img_mc,' MasterCard ','','','align=ABSMIDDLE'),
                  tep_image($img_discover,' Discover ','','','align=ABSMIDDLE'),
                  tep_image($img_amex,' American Express ','','','align=ABSMIDDLE'),
                  tep_image($img_diners,' Diners Club ','','','align=ABSMIDDLE'),
                  tep_image($img_jcb,' JCB ','','','align=ABSMIDDLE')
                  );
      $fields[] = array('title' => '', //MODULE_PAYMENT_2CHECKOUT_TEXT_TITLE,
                        'field' => '<div><b>' . $co_cc_txt . '</b></div>');
      return array('id' => $this->code,
                   'module' => $this->title,
                   'fields' => $fields);
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      global $HTTP_POST_VARS;
      //if (DEFAULT_CURRENCY <> 'CAD')
      //$title = $this->title . MODULE_PAYMENT_2CHECKOUT_CURRENCY_CONVERSITION;
      //else
      $title = $this->title;
      $confirmation = array('title' => $title);

      return $confirmation;
    }

    function process_button() {
      global $HTTP_POST_VARS, $order, $currency, $currencies, $demo;
      global $i, $n, $shipping, $text, $languages_id;

      //if (DEFAULT_CURRENCY <> 'CAD')
      //{
      //$cOrderTotal = $currencies->get_value("CAD") * $order->info['total'];
      //}
      //else
      $cOrderTotal = $order->info['total'];

      if (MODULE_PAYMENT_2CHECKOUT_TESTMODE == 'Test')
        $demo = 'Y';
      else
        $demo = '';

      $process_button_string = '';

      // fill 2Checkout V2 details with osc order info
      // these fields automate product creation on 2checkout's site. comment out all except c_prod if you do not want this feature
      for ($i = 0, $n = sizeof($order->products); $i < $n; $i++) {
        $process_button_string .= tep_draw_hidden_field('c_prod_' . $i, $order->products[$i]['model'] . ',' . $order->products[$i]['qty']);
        $process_button_string .= tep_draw_hidden_field('c_name_' . $i, $order->products[$i]['name']);

        // format product description (from Short Description contrib)
        $product_id = $order->products[$i]['id'];
        $product_query = tep_db_query("select products_description from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . $product_id . "' and language_id = '" . $languages_id . "'");
        $product_description = tep_db_fetch_array($product_query);
        $text = $product_description['products_description'];
        $text = strip_tags($text);
        $text = nl2br($text);
        $text = str_replace("<br />","<br>",$text);
        $process_button_string .= tep_draw_hidden_field('c_description_' . $i, $text);
        $process_button_string .= tep_draw_hidden_field('c_price_' . $i, $order->products[$i]['final_price']);
        // $process_button_string .= tep_draw_hidden_field('c_tangible_' . $i, 'Y'); // uncomment and change to N if you sell only non-tangible (ie downloadable) goods
      }

      $process_button_string .= tep_draw_hidden_field('sh_cost', $shipping['cost']);

      $process_button_string .= tep_draw_hidden_field('x_login', MODULE_PAYMENT_2CHECKOUT_LOGIN) .
                                tep_draw_hidden_field('x_amount', number_format($cOrderTotal, 2, '.', '')) .
                                tep_draw_hidden_field('x_invoice_num', date('YmdHis')) .
                                tep_draw_hidden_field('demo', $demo) .
                                tep_draw_hidden_field('fixed', 'Y') . // If you set this parameter equal to Y, it will disable the following objects on the checkout page: “Save Changes” button, quantity selector data field, “Continue Shopping” button
                                tep_draw_hidden_field('id_type', '1') . // corresponds with c_prod parameter. '1' for vendor_product_id, '2' for assigned_product_id
                                tep_draw_hidden_field('x_first_name', $order->customer['firstname']) .
                                tep_draw_hidden_field('x_last_name', $order->customer['lastname']) .
                                tep_draw_hidden_field('x_address', $order->customer['street_address']) .
                                tep_draw_hidden_field('street_address2', $order->customer['suburb']) .
                                tep_draw_hidden_field('x_city', $order->customer['city']) .
                                tep_draw_hidden_field('x_state', $order->customer['state']) .
                                tep_draw_hidden_field('x_zip', $order->customer['postcode']) .
                                tep_draw_hidden_field('x_country', $order->customer['country']['title']) .
                                tep_draw_hidden_field('x_email', $order->customer['email_address']) .
                                tep_draw_hidden_field('x_phone', $order->customer['telephone']) .
                                tep_draw_hidden_field('x_ship_to_first_name', $order->delivery['firstname']) .
                                tep_draw_hidden_field('x_ship_to_last_name', $order->delivery['lastname']) .
                                tep_draw_hidden_field('x_ship_to_address', $order->delivery['street_address']) .
                                tep_draw_hidden_field('x_ship_to_city', $order->delivery['city']) .
                                tep_draw_hidden_field('x_ship_to_state', $order->delivery['state']) .
                                tep_draw_hidden_field('x_ship_to_zip', $order->delivery['postcode']) .
                                tep_draw_hidden_field('x_ship_to_country', $order->delivery['country']['title']) .
                                tep_draw_hidden_field('tco_currency', $currency) .
                                tep_draw_hidden_field('pay_method', 'CC') .
                                // tep_draw_hidden_field('x_Receipt_Link_URL', tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL')) . // Direct Return MUST be set to NO for this to work
                                tep_draw_hidden_field('x_email_merchant', ((MODULE_PAYMENT_2CHECKOUT_EMAIL_MERCHANT == 'True') ? 'TRUE' : 'FALSE'));
      return $process_button_string;
    }

    function before_process() {
/*
      global $HTTP_POST_VARS;

      if ($HTTP_POST_VARS['x_response_code'] != '1') {
        tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'error_message=' . urlencode(MODULE_PAYMENT_2CHECKOUT_TEXT_ERROR_MESSAGE), 'SSL', true, false));
      }
*/
      return false;

    }

    function after_process() {
      return false;
    }

    function get_error() {
      global $HTTP_GET_VARS;

      $error = array('title' => MODULE_PAYMENT_2CHECKOUT_TEXT_ERROR,
                     'error' => stripslashes(urldecode($HTTP_GET_VARS['error'])));

      return $error;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_2CHECKOUT_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable 2CheckOut Module', 'MODULE_PAYMENT_2CHECKOUT_STATUS', 'True', 'Do you want to accept 2CheckOut payments?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Login/Store Number', 'MODULE_PAYMENT_2CHECKOUT_LOGIN', '18157', 'Login/Store Number used for the 2CheckOut service', '6', '2', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Transaction Mode', 'MODULE_PAYMENT_2CHECKOUT_TESTMODE', 'Test', 'Transaction mode used for the 2Checkout service', '6', '3', 'tep_cfg_select_option(array(\'Test\', \'Production\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Merchant Notifications', 'MODULE_PAYMENT_2CHECKOUT_EMAIL_MERCHANT', 'True', 'Should 2CheckOut e-mail a receipt to the store owner?', '6', '4', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_2CHECKOUT_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '5', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_2CHECKOUT_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '6', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_2CHECKOUT_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '7', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Check MD5 hash', 'MODULE_PAYMENT_2CHECKOUT_CHECK_HASH', 'False', 'Should the 2CheckOut MD5 hash facilty to be checked?', '6', '8', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Secret Word', 'MODULE_PAYMENT_2CHECKOUT_SECRET_WORD', 'tango', 'Secret word for the 2CheckOut MD5 hash facility', '6', '9', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_2CHECKOUT_STATUS', 'MODULE_PAYMENT_2CHECKOUT_LOGIN', 'MODULE_PAYMENT_2CHECKOUT_TESTMODE', 'MODULE_PAYMENT_2CHECKOUT_EMAIL_MERCHANT', 'MODULE_PAYMENT_2CHECKOUT_ZONE', 'MODULE_PAYMENT_2CHECKOUT_ORDER_STATUS_ID', 'MODULE_PAYMENT_2CHECKOUT_SORT_ORDER', 'MODULE_PAYMENT_2CHECKOUT_CHECK_HASH', 'MODULE_PAYMENT_2CHECKOUT_SECRET_WORD');
    }
  }
?>
