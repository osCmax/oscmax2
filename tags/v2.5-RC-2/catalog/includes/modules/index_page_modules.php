<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>

<?php
$page_modules_query_raw = "select pm_filename, pm_active, pm_page, pm_sort_order from " . TABLE_PM_CONFIGURATION . " where pm_page = 'index' and pm_filename <>'' and pm_active = 'yes' order by pm_sort_order";
	$page_modules_query = tep_db_query($page_modules_query_raw);
      while ($pm = tep_db_fetch_array($page_modules_query)) {
		  include(DIR_WS_MODULES . $pm['pm_filename']);
	  }
?>