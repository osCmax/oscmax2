<?php
/*
  WebMakers.com Added: Free Payments and Shipping
  Written by Linda McGrath osCOMMERCE@WebMakers.com
  http://www.thewebmakerscorner.com

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

  class freeshipper {
    var $code, $title, $description, $icon, $enabled;

// BOF: WebMakers.com Added: Free Payments and Shipping
// class constructor
    function freeshipper() {
      global $order, $cart;
      $this->code = 'freeshipper';
      $this->title = MODULE_SHIPPING_FREESHIPPER_TEXT_TITLE;
      $this->description = MODULE_SHIPPING_FREESHIPPER_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_SHIPPING_FREESHIPPER_SORT_ORDER;
      $this->icon = DIR_WS_ICONS . 'shipping_free_shipper.jpg';
      $this->tax_class = MODULE_SHIPPING_FREESHIPPER_TAX_CLASS;
      $this->enabled = ((MODULE_SHIPPING_FREESHIPPER_STATUS == 'True') ? true : false);

// Only show if weight is 0
//      if ( (!strstr($PHP_SELF,'modules.php')) || $cart->show_weight()==0) {
        $this->enabled = MODULE_SHIPPING_FREESHIPPER_STATUS;
        if ( ($this->enabled == true) && ((int)MODULE_SHIPPING_FREESHIPPER_ZONE > 0) ) {
          $check_flag = false;
          $check_query = tep_db_query("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_SHIPPING_FREESHIPPER_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");
          while ($check = tep_db_fetch_array($check_query)) {
            if ($check['zone_id'] < 1) {
              $check_flag = true;
              break;
            } elseif ($check['zone_id'] == $order->delivery['zone_id']) {
              $check_flag = true;
              break;
            }
          }

          if ($check_flag == false) {
            $this->enabled = false;
          }
        }
//      }
// EOF: WebMakers.com Added: Free Payments and Shipping
    }

// class methods
    function quote($method = '') {
      global $order;

      $this->quotes = array('id' => $this->code,
                            'module' => MODULE_SHIPPING_FREESHIPPER_TEXT_TITLE,
                            'methods' => array(array('id' => $this->code,
                                                     'title' => '<FONT COLOR=FF0000><B>' . MODULE_SHIPPING_FREESHIPPER_TEXT_WAY . '</B></FONT>',
                                                     'cost' => SHIPPING_HANDLING + MODULE_SHIPPING_FREESHIPPER_COST)));

      if ($this->tax_class > 0) {
        $this->quotes['tax'] = tep_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
      }
      if (tep_not_null($this->icon)) $this->quotes['icon'] = tep_image($this->icon, $this->title);

      return $this->quotes;
    }

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_FREESHIPPER_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Enable Free Shipping', 'MODULE_SHIPPING_FREESHIPPER_STATUS', '1', 'Do you want to offer Free shipping?', '6', '5', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Free Shipping Cost', 'MODULE_SHIPPING_FREESHIPPER_COST', '0.00', 'What is the Shipping cost? The Handling fee will also be added.', '6', '6', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Tax Class', 'MODULE_SHIPPING_FREESHIPPER_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', '6', '0', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Shipping Zone', 'MODULE_SHIPPING_FREESHIPPER_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', '6', '0', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_SHIPPING_FREESHIPPER_SORT_ORDER', '0', 'Sort order of display.', '6', '0', now())");
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
      return array('MODULE_SHIPPING_FREESHIPPER_STATUS', 'MODULE_SHIPPING_FREESHIPPER_COST', 'MODULE_SHIPPING_FREESHIPPER_TAX_CLASS', 'MODULE_SHIPPING_FREESHIPPER_ZONE', 'MODULE_SHIPPING_FREESHIPPER_SORT_ORDER');
    }
  }
?>