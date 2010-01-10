<?php
/*
$Id: customers.php 2009-11-14 19:38:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2009 osCMax, 2006 osCMax ,2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- customers //-->
<?php
  $contents = '';
  $contents = (	   				   tep_admin_jqmenu(FILENAME_CUSTOMERS, BOX_CUSTOMERS_CUSTOMERS) .
                                   tep_admin_jqmenu(FILENAME_CUSTOMERS_GROUPS, BOX_CUSTOMERS_GROUPS) .
                                   tep_admin_jqmenu(FILENAME_CREATE_ACCOUNT, BOX_MANUAL_ORDER_CREATE_ACCOUNT) .
								   tep_admin_jqmenu(FILENAME_PHONE_ORDER, BOX_PHONE_ORDER) .
                                   tep_admin_jqmenu(FILENAME_CREATE_ORDER, BOX_MANUAL_ORDER_CREATE_ORDER) .
                                   tep_admin_jqmenu(FILENAME_ORDERS, BOX_CUSTOMERS_ORDERS) .
								   tep_admin_jqmenu(FILENAME_CUSTOMERS_EXPORT, BOX_CUSTOMERS_EXPORT));
  print_r($contents);
?>
<!-- customers_eof //-->