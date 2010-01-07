<?php
/*
$Id: localization.php 2009-11-14 19:38:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2009 osCMax, 2006 osCMax ,2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- localization //-->
<?php
  $contents = '';
  $contents = (                    tep_admin_jqmenu(FILENAME_CURRENCIES, BOX_LOCALIZATION_CURRENCIES) .
                                   tep_admin_jqmenu(FILENAME_LANGUAGES, BOX_LOCALIZATION_LANGUAGES) .
                                   tep_admin_jqmenu(FILENAME_ORDERS_STATUS, BOX_LOCALIZATION_ORDERS_STATUS));

  print_r($contents);
?>
<!-- localization_eof //-->