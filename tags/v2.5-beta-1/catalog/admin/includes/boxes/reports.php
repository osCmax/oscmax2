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

  $contents = (					   tep_admin_jqmenu(FILENAME_STATS_PRODUCTS_VIEWED, BOX_REPORTS_PRODUCTS_VIEWED, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_STATS_PRODUCTS_PURCHASED, BOX_REPORTS_PRODUCTS_PURCHASED, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_STATS_CUSTOMERS, BOX_REPORTS_ORDERS_TOTAL, 'TOP') .
								   tep_admin_jqmenu(FILENAME_STATS_REGISTER_CUSTOMER_NO_PURCHASE, BOX_REPORTS_STATS_REGISTER_CUSTOMER_NO_PURCHASE, 'TOP') .
								   tep_admin_jqmenu(FILENAME_STATS_WISHLIST, BOX_REPORTS_WISHLIST, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_STATS_MONTHLY_SALES, BOX_REPORTS_MONTHLY_SALES, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_STATS_RECOVER_CART_SALES, BOX_REPORTS_RECOVER_CART_SALES, 'TOP') .
								   tep_admin_jqmenu(FILENAME_SHIPPING_MANIFEST, BOX_SHIPPING_MANIFEST, 'BLANK') .
								   tep_admin_jqmenu(FILENAME_STATS_LOW_STOCK_ATTRIB, BOX_REPORTS_STATS_LOW_STOCK_ATTRIB, 'TOP') .
								   tep_admin_jqmenu(FILENAME_STATS_CREDITS, BOX_REPORTS_CREDITS, 'TOP') .
								   tep_admin_jqmenu(FILENAME_STATS_ADMIN_LOGGING, BOX_REPORTS_ADMIN_LOGGING, 'TOP') .
								   tep_admin_jqmenu(FILENAME_STATS_CUST_LOGGING, BOX_REPORTS_CUST_LOGGING, 'TOP') .
								   tep_admin_jqmenu(FILENAME_STATS_HTTP_ERROR, BOX_REPORTS_HTTP_ERROR, 'TOP'));
  print_r($contents);
?>
<!-- reports_eof //-->