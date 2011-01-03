<?php
/*
$Id: shipping.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

  class shipping {
    var $modules;

// class constructor
    function shipping($module = '') {
// LINE CHANGED: MOD - Downloads Controller - Added $cart
      global $language, $PHP_SELF, $cart;

// LINE ADDED: MOD - Individual Shipping Prices
      $shiptotal = $cart->get_shiptotal();

      if (defined('MODULE_SHIPPING_INSTALLED') && tep_not_null(MODULE_SHIPPING_INSTALLED)) {
// BOF: MOD - Separate Pricing Per Customer, next line original code
//      $this->modules = explode(';', MODULE_SHIPPING_INSTALLED);
        global $sppc_customer_group_id, $customer_id;
        if (isset($_SESSION['sppc_customer_group_id']) && $_SESSION['sppc_customer_group_id'] != '0') {
          $customer_group_id = $_SESSION['sppc_customer_group_id'];
        } else {
          $customer_group_id = '0';
        }
        $customer_shipment_query = tep_db_query("select IF(c.customers_shipment_allowed <> '', c.customers_shipment_allowed, cg.group_shipment_allowed) as shipment_allowed from " . TABLE_CUSTOMERS . " c, " . TABLE_CUSTOMERS_GROUPS . " cg where c.customers_id = '" . $customer_id . "' and cg.customers_group_id =  '" . $customer_group_id . "'");
        if ($customer_shipment = tep_db_fetch_array($customer_shipment_query)  ) {
          if (tep_not_null($customer_shipment['shipment_allowed']) ) {
            $temp_shipment_array = explode(';', $customer_shipment['shipment_allowed']);
            $installed_modules = explode(';', MODULE_SHIPPING_INSTALLED);
            for ($n = 0; $n < sizeof($installed_modules) ; $n++) {
// check to see if a shipping module is not de-installed
              if ( in_array($installed_modules[$n], $temp_shipment_array ) ) {
                $shipment_array[] = $installed_modules[$n];
              }
            } // end for loop
            $this->modules = $shipment_array;
          } else {
            $this->modules = explode(';', MODULE_SHIPPING_INSTALLED);
          }
        } else { // default
          $this->modules = explode(';', MODULE_SHIPPING_INSTALLED);
        }
// EOF: MOD - Separate Pricing Per Customer
        $include_modules = array();

        if ( (tep_not_null($module)) && (in_array(substr($module['id'], 0, strpos($module['id'], '_')) . '.' . substr($PHP_SELF, (strrpos($PHP_SELF, '.')+1)), $this->modules)) ) {
          $include_modules[] = array('class' => substr($module['id'], 0, strpos($module['id'], '_')), 'file' => substr($module['id'], 0, strpos($module['id'], '_')) . '.' . substr($PHP_SELF, (strrpos($PHP_SELF, '.')+1)));
        } else {
          reset($this->modules);

// BOF: MOD - Downloads Controller - Free Shipping and Payments
// Show either normal shipping modules or free shipping module when Free Shipping Module is On
          // Free Shipping Only
          if (tep_get_configuration_key_value('MODULE_SHIPPING_FREESHIPPER_STATUS') and $cart->show_weight()==0) {
            $include_modules[] = array('class'=> 'freeshipper', 'file' => 'freeshipper.php'); }
          if (tep_get_configuration_key_value('MODULE_SHIPPING_INDVSHIP_STATUS') and $shiptotal) {
            $include_modules[] = array('class'=> 'indvship', 'file' => 'indvship.php');
          } else {
          // All Other Shipping Modules
            while (list(, $value) = each($this->modules)) {
              $class = substr($value, 0, strrpos($value, '.'));
              // Don't show Free Shipping Module
              if ($class !='freeshipper')  { if ($class != 'indvship') {
                $include_modules[] = array('class' => $class, 'file' => $value);} }
            }
// EOF: MOD - Downloads Controller - Free Shipping and Payments
          }
        }

        for ($i=0, $n=sizeof($include_modules); $i<$n; $i++) {
          include(DIR_WS_LANGUAGES . $language . '/' . $include_modules[$i]['file']);
          include(DIR_WS_MODULES . 'shipping/' . $include_modules[$i]['file']);

          $GLOBALS[$include_modules[$i]['class']] = new $include_modules[$i]['class'];
        }
      }
    }

    function quote($method = '', $module = '') {
      global $total_weight, $shipping_weight, $shipping_quoted, $shipping_num_boxes;

      $quotes_array = array();

      if (is_array($this->modules)) {
        $shipping_quoted = '';
        $shipping_num_boxes = 1;
        $shipping_weight = $total_weight;

        if (SHIPPING_BOX_WEIGHT >= $shipping_weight*SHIPPING_BOX_PADDING/100) {
          $shipping_weight = $shipping_weight+SHIPPING_BOX_WEIGHT;
        } else {
          $shipping_weight = $shipping_weight + ($shipping_weight*SHIPPING_BOX_PADDING/100);
        }

        if ($shipping_weight > SHIPPING_MAX_WEIGHT) { // Split into many boxes
          $shipping_num_boxes = ceil($shipping_weight/SHIPPING_MAX_WEIGHT);
          $shipping_weight = $shipping_weight/$shipping_num_boxes;
        }

        $include_quotes = array();

        reset($this->modules);
        while (list(, $value) = each($this->modules)) {
          $class = substr($value, 0, strrpos($value, '.'));
          if (tep_not_null($module)) {
            if ( ($module == $class) && ($GLOBALS[$class]->enabled) ) {
              $include_quotes[] = $class;
            }
          } elseif ($GLOBALS[$class]->enabled) {
            $include_quotes[] = $class;
          }
        }

        $size = sizeof($include_quotes);
        for ($i=0; $i<$size; $i++) {
          $quotes = $GLOBALS[$include_quotes[$i]]->quote($method);
          if (is_array($quotes)) $quotes_array[] = $quotes;
        }
      }

      return $quotes_array;
    }

    function cheapest() {
      if (is_array($this->modules)) {
        $rates = array();

        reset($this->modules);
        while (list(, $value) = each($this->modules)) {
          $class = substr($value, 0, strrpos($value, '.'));
          if ($GLOBALS[$class]->enabled) {
            $quotes = $GLOBALS[$class]->quotes;
            for ($i=0, $n=sizeof($quotes['methods']); $i<$n; $i++) {
              if (isset($quotes['methods'][$i]['cost']) && tep_not_null($quotes['methods'][$i]['cost'])) {
                $rates[] = array('id' => $quotes['id'] . '_' . $quotes['methods'][$i]['id'],
                                 'title' => $quotes['module'] . ' (' . $quotes['methods'][$i]['title'] . ')',
                                 'cost' => $quotes['methods'][$i]['cost']);
              }
            }
          }
        }

        $cheapest = false;
        for ($i=0, $n=sizeof($rates); $i<$n; $i++) {
          if (is_array($cheapest)) {
            if ($rates[$i]['cost'] < $cheapest['cost']) {
              $cheapest = $rates[$i];
            }
          } else {
            $cheapest = $rates[$i];
          }
        }

        return $cheapest;
      }
    }
  }
?>