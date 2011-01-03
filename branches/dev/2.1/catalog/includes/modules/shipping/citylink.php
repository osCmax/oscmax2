<?php
/*   $Id: Initial CityLink Nextday by Stuart Newton 21 August 2006
	 Demo: http://www.almatcomputers.co.uk
	 Rates: 10:11.6,15:14.1,20:16.60,25:19.1,30:21.6,35:24.1,40:26.6,45:29.1,50:31.6,55:34.1,60:36.6,65:39.1,70:41.6,75:44.1,80:46.6,100:56.6,125:69.1,150:81.6,200:106.6
*/

  class citylink {
    var $code, $title, $description, $enabled, $num_zones;

// class constructor
    function citylink() {
	global $order, $total_weight;
      $this->code = 'citylink';
      $this->title = MODULE_SHIPPING_CITYLINK_TEXT_TITLE;
      $this->description = MODULE_SHIPPING_CITYLINK_TEXT_DESCRIPTION;
      $this->sort_order = MODULE_SHIPPING_CITYLINK_SORT_ORDER;
      $this->icon = DIR_WS_ICONS . 'shipping_citylink.gif'; // upload icon to catalog/images/icon directory
      $this->tax_class = MODULE_SHIPPING_CITYLINK_TAX_CLASS;
      $this->enabled = ((MODULE_SHIPPING_CITYLINK_STATUS == 'True') ? true : false);
      $this->num_zones = 1;
	  
	   		 if ($total_weight < 3) {  	// If total ship weight is less than 3.00Kg do not show this shipping method
			  $this->enabled = false;	// Anything under 3Kg its not economically wise to use this method (Royal Mail recommended)
		 }								// To remove this 3.00Kg limit, simply delete these 3 lines
		 	
    }


 
// class methods
    function quote($method = '') {
	global $order, $total_weight, $shipping_weight, $shipping_num_boxes;
      $dest_country = $order->delivery['country']['iso_code_2'];
      $dest_zone = 0;
      $error = false;
	  	if ($order->delivery['country']['iso_code_2'] == 'GB')  {  // Only UK Customers to see shipping method. Hide everbody else.
          for ($i=1; $i<=$this->num_zones; $i++) {
          $countries_table = constant('MODULE_SHIPPING_CITYLINK_COUNTRIES_' . $i);
          $country_zones = split("[,]", $countries_table);
          if (in_array($dest_country, $country_zones)) {
            $dest_zone = $i;
            break;
          }
        }
// Enhanced charges applied to Citylink weights		
$ic = 0;
 if ($total_weight > 30) $ic = 10;
 if ($total_weight > 100) $ic = 15;
 if ($total_weight > 150) $ic = 25;
 if ($total_weight > 200) $ic = 45;
		
      if ($dest_zone == 0) {
        $error = true;
      } else {
        $shipping = -1;
        $zones_cost = constant('MODULE_SHIPPING_CITYLINK_COST_' . $dest_zone);

        $zones_table = split("[:,]" , $zones_cost);
        $size = sizeof($zones_table);
        for ($i=0; $i<$size; $i+=2) {
          if ($shipping_weight <= $zones_table[$i]) {
            $shipping = $zones_table[$i+1];
			if(tep_not_null($method) )
			// Text shown on Checkout_Confirmation
			$shipping_method = ''; // Leaving this entry blank causes only the shipping title to show i.e Royal Mail 1st Class Std 	  
			else
			// Text shown on Checkout_shipping -  Delivery Weight : 0.7 Kg's (Ships normally within 1 to 3 days)
			$shipping_method = MODULE_SHIPPING_CITYLINK_TEXT_WAY . ' : ' . $shipping_weight . ' ' . MODULE_SHIPPING_CITYLINK_TEXT_UNITS . ' ' . MODULE_SHIPPING_CITYLINK_DELIVERY_TIMES; 
			break;
          }
        }

        if ($shipping == -1) {
          $shipping_cost = 0;
          $shipping_method = MODULE_SHIPPING_CITYLINK_UNDEFINED_RATE;
        } else {
          $shipping_cost = ($shipping * $shipping_num_boxes) + $ic + constant('MODULE_SHIPPING_CITYLINK_HANDLING_' . $dest_zone);
        }
      }

      $this->quotes = array('id' => $this->code,
                            'module' => MODULE_SHIPPING_CITYLINK_TEXT_TITLE,
                            'methods' => array(array('id' => $this->code,
                                                     'title' => $shipping_method,
                                                     'cost' => $shipping_cost)));

      if ($this->tax_class > 0) {
        $this->quotes['tax'] = tep_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
      }

      if (tep_not_null($this->icon)) $this->quotes['icon'] = tep_image($this->icon, $this->title);

      if ($error == true) $this->quotes['error'] = MODULE_SHIPPING_CITYLINK_INVALID_ZONE;

      return $this->quotes;
	}
	}

    function check() {
      if (!isset($this->_check)) {
        $check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_CITYLINK_STATUS'");
        $this->_check = tep_db_num_rows($check_query);
      }
      return $this->_check;
    }

    function install() {
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES ('Enable Initial Citylink Delivery', 'MODULE_SHIPPING_CITYLINK_STATUS', 'True', 'Do you want to offer this shipping option?', '6', '0', 'tep_cfg_select_option(array(\'True\', \'False\'), ', now())");
	  
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Tax Class', 'MODULE_SHIPPING_CITYLINK_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', '6', '0', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");
	  
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_SHIPPING_CITYLINK_SORT_ORDER', '7', 'Sort order of display (1 shown first 99 etc shown last to customer)', '6', '0', now())");
	  
      for ($i = 1; $i <= $this->num_zones; $i++) {
        $default_countries = '';
        if ($i == 1) {
          $default_countries = 'GB';
        }
      tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('ISO Country Code', 'MODULE_SHIPPING_CITYLINK_COUNTRIES_" . $i ."', '" . $default_countries . "', 'Enter the two digit ISO code for which this shipping method applies too. (Default: GB)', '6', '0', now())");
	  
	  tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Initial Citylink Rates', 'MODULE_SHIPPING_CITYLINK_COST_" . $i ."', '10:11.6,15:14.1,20:16.60,25:19.1,30:21.6,35:24.1,40:26.6,45:29.1,50:31.6,55:34.1,60:36.6,65:39.1,70:41.6,75:44.1,80:46.6,100:56.6,125:69.1,150:81.6,200:106.6', 'Enter values upto 5,2 decimal places. (12345.67) Example: .1:1,.25:1.27 - Weights less than or equal to 0.1Kg would cost £1.00, Weights less than or equal to 0.25g but more than 0.1Kg will cost £1.27. Do not enter KG or £ symbols.', '6', '0', now())");
        tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Packaging / Handling Fee', 'MODULE_SHIPPING_CITYLINK_HANDLING_" . $i."', '0', 'If you want to add extra costs to customers for jiffy bags etc, the cost can be entered below (eg enter 1.50 for a value of £1.50)', '6', '0', now())");
      }
    }

    function remove() {
      tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in ('" . implode("', '", $this->keys()) . "')");
    }

    function keys() {
      $keys = array('MODULE_SHIPPING_CITYLINK_STATUS', 'MODULE_SHIPPING_CITYLINK_TAX_CLASS', 'MODULE_SHIPPING_CITYLINK_SORT_ORDER');

      for ($i=1; $i<=$this->num_zones; $i++) {
        $keys[] = 'MODULE_SHIPPING_CITYLINK_COUNTRIES_' . $i;
        $keys[] = 'MODULE_SHIPPING_CITYLINK_COST_' . $i;
        $keys[] = 'MODULE_SHIPPING_CITYLINK_HANDLING_' . $i;
      }

      return $keys;
    }
  }
?>