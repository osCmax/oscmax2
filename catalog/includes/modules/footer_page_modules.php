<?php
/*
$Id: footer_page_modules.php 1857 2012-06-20 01:21:38Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>

<?php

$page_modules_query_raw = "select pm_filename, pm_active, pm_page, pm_cg_hide, pm_sort_order from " . TABLE_PM_CONFIGURATION . " where pm_page = 'footer' and pm_filename <>'' and pm_active = 'yes' and NOT find_in_set('" . $customer_group_id . "', pm_cg_hide) order by pm_sort_order";
  $page_modules_query = tep_db_query($page_modules_query_raw);
      while ($pm = tep_db_fetch_array($page_modules_query)) {
		  include(DIR_WS_MODULES . $pm['pm_filename']);
	  }
?>