<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

	function ajax_get_zones_html($country, $default_zone = '', $ajax_output = true) {
		$output = '';

		$zones_array = array();    
		$zones_query = tep_db_query("select zone_id, zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' order by zone_name");
		while ($zones_values = tep_db_fetch_array($zones_query)) {
			$zones_array[] = array('id' => $zones_values['zone_id'], 'text' => $zones_values['zone_name']);
		}

		if ( tep_db_num_rows($zones_query) ) {
			$output .= tep_draw_pull_down_menu('zone_id', $zones_array, $default_zone);	  
		} else {
			$output .= tep_draw_input_field('state', $default_zone);
		}  
		if (tep_not_null(ENTRY_STATE_TEXT)) $output .= '&nbsp;<span class="inputRequirement">' . ENTRY_STATE_TEXT;			
		
		if ($ajax_output) {
			header('Content-type: text/html; charset='.CHARSET);
			echo $output;
		} else {
			return $output;
		}
	}
?>