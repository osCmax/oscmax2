<?php
/*
  Contribution by Emmanuel Alliel <manu@maboutique.biz>

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

  class paybox {
    var $code, $title, $description, $enabled;

// class constructor
    function paybox() {
      global $order;

      $this->code = 'paybox';
      $this->title = MODULE_PAYMENT_PAYBOX_TEXT_TITLE;
      $this->description = MODULE_PAYMENT_PAYBOX_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_PAYMENT_PAYBOX_SORT_ORDER;
      $this->enabled = ((MODULE_PAYMENT_PAYBOX_STATUS == 'True') ? true : false);

      if ((int)MODULE_PAYMENT_PAYBOX_ORDER_STATUS_ID > 0) {
        $this->order_status = MODULE_PAYMENT_PAYBOX_ORDER_STATUS_ID;
      }

      if (is_object($order)) $this->update_status();

      $this->form_action_url = MODULE_PAYMENT_PAYBOX_CGI;
    }

// class methods
    function update_status() {
      global $order;

      if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_PAYBOX_ZONE > 0) ) {
        $check_flag = false;
        $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_PAYBOX_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
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
                   'module' => $this->title);
    }

    function pre_confirmation_check() {
      return false;
    }

    function confirmation() {
      return false;
    }

    function process_button() {
      global $order;

      $process_button_string = tep_draw_hidden_field('IBS_MODE', '1') .
                               tep_draw_hidden_field('IBS_SITE', '1999888') .
                               tep_draw_hidden_field('IBS_RANG', '99') .
                               tep_draw_hidden_field('IBS_TOTAL', $order->info['total'] * 100) .
                               tep_draw_hidden_field('IBS_DEVISE', '978') .
                       	       tep_draw_hidden_field('IBS_CMD', $order->customer['email_address'] . '|' . $order->info['total']) .
	                       tep_draw_hidden_field('IBS_PORTEUR', $order->customer['email_address']) .
                               tep_draw_hidden_field('IBS_RETOUR', 'IBS_TOTAL:M;IBS_CMD:R;auto:A;trans:T') .
	tep_draw_hidden_field('IBS_ANNULE', tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=' . $this->code, 'NONSSL', true)) .
	tep_draw_hidden_field('IBS_REFUSE', tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error=' . $this->code, 'NONSSL', true)) .
                               tep_draw_hidden_field('IBS_EFFECTUE', tep_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL', false)) .
                               tep_draw_hidden_field(tep_session_name(), tep_session_id()) .
                               tep_draw_hidden_field('options', 'test_status=' . $test_status . ',dups=false,cb_post=true,cb_flds=' . tep_session_name());

      return $process_button_string;
    }

    function before_process() {
      global $_POST;

      if ($_POST['valid'] == 'true') {
        if ($remote_host = getenv('REMOTE_HOST')) {
          if ($remote_host != 'paybox.com') {
            $remote_host = gethostbyaddr($remote_host);
          }
          if ($remote_host != 'paybox.com') {
            tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, tep_session_name() . '=' . $_POST[tep_session_name()] . '&payment_error=' . $this->code, 'SSL', false, false));
          }
        } else {
          tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, tep_session_name() . '=' . $_POST[tep_session_name()] . '&payment_error=' . $this->code, 'SSL', false, false));
        }
      }
    }

    function after_process() {
      return false;
    }

    function get_error() {
      global $_GET;

      if (isset($_GET['message']) && (strlen($_GET['message']) > 0)) {
        $error = stripslashes(urldecode($_GET['message']));
      } else {
        $error = MODULE_PAYMENT_PAYBOX_TEXT_ERROR_MESSAGE;
      }

      return array('title' => MODULE_PAYMENT_PAYBOX_TEXT_ERROR,
                   'error' => $error);
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_PAYBOX_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Enable Paybox Module', 'MODULE_PAYMENT_PAYBOX_STATUS', 'True', 'Activer ce module Paybox ?', '6', '1', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('IBS_SITE', 'MODULE_PAYMENT_PAYBOX_IBS_SITE', '1999888', 'IBS_SITE fournit par Paybox', '6', '2', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('IBS_RANG', 'MODULE_PAYMENT_PAYBOX_IBS_RANG', '99', 'IBS_RANG fournit par Paybox', '6', '3', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('CGI Path', 'MODULE_PAYMENT_PAYBOX_CGI', 'http://www.maboutique.biz/cgi-bin/paybox.cgi', 'Chemin de votre module CGI fournit par Paybox', '6', '4', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort order of display.', 'MODULE_PAYMENT_PAYBOX_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', '6', '0', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Payment Zone', 'MODULE_PAYMENT_PAYBOX_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', '6', '2', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('Set Order Status', 'MODULE_PAYMENT_PAYBOX_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', '6', '0', 'tep_cfg_pull_down_order_statuses(', 'tep_get_order_status_name', now())");
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      return array('MODULE_PAYMENT_PAYBOX_STATUS', 'MODULE_PAYMENT_PAYBOX_IBS_SITE', 'MODULE_PAYMENT_PAYBOX_IBS_RANG', 'MODULE_PAYMENT_PAYBOX_CGI', 'MODULE_PAYMENT_PAYBOX_ZONE', 'MODULE_PAYMENT_PAYBOX_ORDER_STATUS_ID', 'MODULE_PAYMENT_PAYBOX_SORT_ORDER');
    }
  }
?>
