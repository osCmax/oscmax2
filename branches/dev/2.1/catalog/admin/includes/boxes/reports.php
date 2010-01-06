<?php
/*
$Id: reports.php 2009-11-14 19:38:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2009 osCMax, 2006 osCMax ,2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- reports //-->
<?php
  $contents = '';

  $contents = (					   tep_admin_jqmenu(FILENAME_STATS_PRODUCTS_VIEWED, BOX_REPORTS_PRODUCTS_VIEWED) .
                                   tep_admin_jqmenu(FILENAME_STATS_PRODUCTS_PURCHASED, BOX_REPORTS_PRODUCTS_PURCHASED) .
                                   tep_admin_jqmenu(FILENAME_STATS_MONTHLY_SALES, BOX_REPORTS_MONTHLY_SALES) .
								   tep_admin_jqmenu(FILENAME_STATS_DETAILED_MONTHLY_SALES, BOX_REPORTS_DETAILED_MONTHLY_SALES) .
                                   tep_admin_jqmenu(FILENAME_STATS_RECOVER_CART_SALES, BOX_REPORTS_RECOVER_CART_SALES) .
				 				   tep_admin_jqmenu(FILENAME_MISSING_PICS, BOX_REPORTS_MISSING_PICS) .
                                   tep_admin_jqmenu(FILENAME_STATS_CUSTOMERS, BOX_REPORTS_ORDERS_TOTAL));
  print_r($contents);
?>
<!-- reports_eof //-->