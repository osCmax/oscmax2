<?php
/*
ot_loyalty_discount.php
$Id: ot_loyalty_discount.php 14 2006-07-28 17:42:07Z user $


  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Plic License
*/

  class ot_loyalty_discount {
    var $title, $output;

    function ot_loyalty_discount() {
      $this->code = 'ot_loyalty_discount';
      $this->title = MODULE_LOYALTY_DISCOUNT_TITLE;
      $this->description = MODULE_LOYALTY_DISCOUNT_DESCRIPTION;
      $this->enabled = MODULE_LOYALTY_DISCOUNT_STATUS;
      $this->sort_order = MODULE_LOYALTY_DISCOUNT_SORT_ORDER;
      $this->include_shipping = MODULE_LOYALTY_DISCOUNT_INC_SHIPPING;
      $this->include_tax = MODULE_LOYALTY_DISCOUNT_INC_TAX;
      $this->calculate_tax = MODULE_LOYALTY_DISCOUNT_CALC_TAX;
      $this->table = MODULE_LOYALTY_DISCOUNT_TABLE;
	  $this->loyalty_order_status = MODULE_LOYALTY_DISCOUNT_ORDER_STATUS;
	  $this->cum_order_period = MODULE_LOYALTY_DISCOUNT_CUMORDER_PERIOD;
      $this->output = array();
    }

    function process() {
      global $order, $ot_subtotal, $currencies;
      $od_amount = $this->calculate_credit($this->get_order_total(), $this->get_cum_order_total());
      if ($od_amount>0) {
      $this->deduction = $od_amount;
      $this->output[] = array('title' => $this->title . ':<br>' . MODULE_LOYALTY_DISCOUNT_SPENT . $currencies->format($this->cum_order_total) . $this->period_string . MODULE_LOYALTY_DISCOUNT_QUALIFY . $this->od_pc . '%:',
                              'text' => '<b>' . $currencies->format($od_amount) . '</b>',
                              'value' => $od_amount);
    $order->info['total'] = $order->info['total'] - $od_amount;
    if ($this->sort_order < $ot_subtotal->sort_order) {
      $order->info['subtotal'] = $order->info['subtotal'] - $od_amount;
    }
}
    }


  function calculate_credit($amount_order, $amount_cum_order) {
    global $order;
    $od_amount=0;
    $table_cost = preg_split('/[:,]/' , MODULE_LOYALTY_DISCOUNT_TABLE);
    for ($i = 0; $i < count($table_cost); $i+=2) {
          if ($amount_cum_order >= $table_cost[$i]) {
            $od_pc = $table_cost[$i+1];
			$this->od_pc = $od_pc;
          }
        }
// Calculate tax reduction if necessary
    if($this->calculate_tax == 'true') {
// Calculate main tax reduction
      $tod_amount = round($order->info['tax']*10)/10*$od_pc/100;
      $order->info['tax'] = $order->info['tax'] - $tod_amount;
// Calculate tax group deductions
      reset($order->info['tax_groups']);
      while (list($key, $value) = each($order->info['tax_groups'])) {
        $god_amount = round($value*10)/10*$od_pc/100;
        $order->info['tax_groups'][$key] = $order->info['tax_groups'][$key] - $god_amount;
      }
    }
    $od_amount = round($amount_order*10)/10*$od_pc/100;
    $od_amount = $od_amount + $tod_amount;
    return $od_amount;
  }


  function get_order_total() {
    global  $order, $cart;
    $order_total = $order->info['total'];
// Check if gift voucher is in cart and adjust total
    $products = $cart->get_products();
    for ($i=0; $i<sizeof($products); $i++) {
      $t_prid = tep_get_prid($products[$i]['id']);
      $gv_query = tep_db_query("select products_price, products_tax_class_id, products_model from " . TABLE_PRODUCTS . " where products_id = '" . $t_prid . "'");
      $gv_result = tep_db_fetch_array($gv_query);
      if (preg_match('/^GIFT/im', addslashes($gv_result['products_model']))) {
        $qty = $cart->get_quantity($t_prid);
        $products_tax = tep_get_tax_rate($gv_result['products_tax_class_id']);
        if ($this->include_tax =='false') {
           $gv_amount = $gv_result['products_price'] * $qty;
        } else {
          $gv_amount = ($gv_result['products_price'] + tep_calculate_tax($gv_result['products_price'],$products_tax)) * $qty;
        }
        $order_total=$order_total - $gv_amount;
      }
    }
    if ($this->include_tax == 'false') $order_total=$order_total-$order->info['tax'];
    if ($this->include_shipping == 'false') $order_total=$order_total-$order->info['shipping_cost'];
    return $order_total;
  }

	function get_cum_order_total() {
	  global $order, $customer_id;
    $history_query_raw = "select o.date_purchased, ot.value as order_total from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id) where o.customers_id = '" . $customer_id . "' and ot.class = 'ot_subtotal' and o.orders_status = '" . $this->loyalty_order_status . "' order by date_purchased DESC";
  	  $history_query = tep_db_query($history_query_raw);
	  if (tep_db_num_rows($history_query)) {
	  $cum_order_total = 0;
	  $cutoff_date = $this->get_cutoff_date();
      while ($history = tep_db_fetch_array($history_query)) {
	    if ($this->get_date_in_period($cutoff_date, $history['date_purchased']) == true){
	    $cum_order_total = $cum_order_total + $history['order_total'];
	    }
	  }
	  $this->cum_order_total = $cum_order_total;
	  return $cum_order_total;


	  } else {
	  $cum_order_total = 0;
	  $this->cum_order_total = $cum_order_total;
	  return $cum_order_total;
	  }
	}

	function get_cutoff_date() {
	  $rightnow = time();
	  switch ($this->cum_order_period) {
	  case alltime:
	  $this->period_string = MODULE_LOYALTY_DISCOUNT_WITHUS;
	  $cutoff_date = 0;
	  return $cutoff_date;
	  break;
	  case year:
	  $this->period_string = MODULE_LOYALTY_DISCOUNT_LAST . MODULE_LOYALTY_DISCOUNT_YEAR;
	  $cutoff_date = $rightnow - (60*60*24*365);
	  return $cutoff_date;
	  break;
	  case quarter:
	  $this->period_string = MODULE_LOYALTY_DISCOUNT_LAST . MODULE_LOYALTY_DISCOUNT_QUARTER;
	  $cutoff_date = $rightnow - (60*60*24*92);
	  return $cutoff_date;
	  break;
	  case month:
	  $this->period_string = MODULE_LOYALTY_DISCOUNT_LAST . MODULE_LOYALTY_DISCOUNT_MONTH;
	  $cutoff_date = $rightnow - (60*60*24*31);
	  return $cutoff_date;
	  break;
	  default:
	  $cutoff_date = $rightnow;
	  return $cutoff_date;
	  }
	}

      function get_date_in_period($cutoff_date, $raw_date) {
    if ( ($raw_date == '0000-00-00 00:00:00') || ($raw_date == '') ) return false;

    $year = (int)substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = (int)substr($raw_date, 8, 2);
    $hour = (int)substr($raw_date, 11, 2);
    $minute = (int)substr($raw_date, 14, 2);
    $second = (int)substr($raw_date, 17, 2);

    $order_date_purchased = mktime($hour,$minute,$second,$month,$day,$year);
	if ($order_date_purchased >= $cutoff_date) {return true;}
	else {return false;}
  }


    function check() {
      if (!isset($this->check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_LOYALTY_DISCOUNT_STATUS'");
        $this->check = tep_db_num_rows($check_query);
      }

      return $this->check;
    }

    function keys() {
      return array('MODULE_LOYALTY_DISCOUNT_STATUS', 'MODULE_LOYALTY_DISCOUNT_SORT_ORDER', 'MODULE_LOYALTY_DISCOUNT_CUMORDER_PERIOD', 'MODULE_LOYALTY_DISCOUNT_TABLE', 'MODULE_LOYALTY_DISCOUNT_INC_SHIPPING', 'MODULE_LOYALTY_DISCOUNT_INC_TAX', 'MODULE_LOYALTY_DISCOUNT_CALC_TAX', 'MODULE_LOYALTY_DISCOUNT_ORDER_STATUS');
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display Total', 'MODULE_LOYALTY_DISCOUNT_STATUS', 'true', 'Do you want to enable the Order Discount?', '6', '1','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_LOYALTY_DISCOUNT_SORT_ORDER', '999', 'Sort order of display.', '6', '2', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Include Shipping', 'MODULE_LOYALTY_DISCOUNT_INC_SHIPPING', 'true', 'Include Shipping in calculation', '6', '3', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Include Tax', 'MODULE_LOYALTY_DISCOUNT_INC_TAX', 'true', 'Include Tax in calculation.', '6', '4','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Calculate Tax', 'MODULE_LOYALTY_DISCOUNT_CALC_TAX', 'false', 'Re-calculate Tax on discounted amount.', '6', '5','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Cumulative order total period', 'MODULE_LOYALTY_DISCOUNT_CUMORDER_PERIOD', 'year', 'Set the period over which to calculate cumulative order total.', '6', '6','tep_cfg_select_option(array(\'alltime\', \'year\', \'quarter\', \'month\'), ', now())");
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Discount Percentage', 'MODULE_LOYALTY_DISCOUNT_TABLE', '1000:5,1500:7.5,2000:10,3000:12.5,5000:15', 'Set the cumulative order total breaks per period set above, and discount percentages', '6', '7', now())");
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Order Status', 'MODULE_LOYALTY_DISCOUNT_ORDER_STATUS', '3', 'Set the minimum order status for an order to add it to the total amount ordered', '6', '8', now())");
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
  }
?>