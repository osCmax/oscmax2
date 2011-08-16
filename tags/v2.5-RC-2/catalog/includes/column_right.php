<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com
  adapted for Separate Pricing Per Customer v4.2.x, Hide products and categories from groups 2008/08/05

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
// BOF: MOD - INFO BOXES - now pulled dynamically as per setting in admin 

  $column_query = tep_db_query('select configuration_column as cfgcol, configuration_title as cfgtitle, configuration_value as cfgvalue, configuration_key as cfgkey, box_heading from ' . TABLE_THEME_CONFIGURATION . ' order by location');
  while ($column = tep_db_fetch_array($column_query)) {

    $column['cfgtitle'] = str_replace(' ', '_', $column['cfgtitle']);
    $column['cfgtitle'] = str_replace("'", '', $column['cfgtitle']);

    if ( ($column['cfgvalue'] == 'yes') && ($column['cfgcol'] == 'right')) {
      if ( file_exists(DIR_WS_BOXES . $column['cfgtitle'] . '.php') ) {
        require(DIR_WS_BOXES . $column['cfgtitle'] . '.php');
      } 
    }
  }
// EOF: MOD - INFO BOXES - now pulled dynamically as per setting in admin 
?>