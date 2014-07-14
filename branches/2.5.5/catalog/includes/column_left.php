<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// BOF: MOD - INFO BOXES - now pulled dynamically as per setting in admin 

  // Set $box_width variable according to the BOX_WIDTH_LEFT
  unset($box_width);
  $box_width = BOX_WIDTH_LEFT;

  $column_query = tep_db_query('select configuration_column as cfgcol, configuration_title as cfgtitle, configuration_value as cfgvalue, configuration_key as cfgkey, box_heading from ' . TABLE_THEME_CONFIGURATION . ' order by location');
  while ($column = tep_db_fetch_array($column_query)) {

    $column['cfgtitle'] = str_replace(' ', '_', $column['cfgtitle']);
    $column['cfgtitle'] = str_replace("'", '', $column['cfgtitle']);

    if ( ($column['cfgvalue'] == 'yes') && ($column['cfgcol'] == 'left')) {
      if ( file_exists(DIR_WS_BOXES . $column['cfgtitle'] . '.php') ) {
		require(bts_select('include', 'boxes/' . $column['cfgtitle'] . '.php'));
      } 
    }
  }
// EOF: MOD - INFO BOXES - now pulled dynamically as per setting in admin 
?>