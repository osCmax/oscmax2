<?php
/*
$Id: taxes.php 2009-11-14 19:38:07Z user pgmarshall

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2009 osCMax, 2006 osCMax ,2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- taxes //-->
<?php
  $contents = '';
  $contents = (				       tep_admin_jqmenu(FILENAME_COUNTRIES, BOX_TAXES_COUNTRIES, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_ZONES, BOX_TAXES_ZONES, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_GEO_ZONES, BOX_TAXES_GEO_ZONES, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_TAX_CLASSES, BOX_TAXES_TAX_CLASSES, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_TAX_RATES, BOX_TAXES_TAX_RATES, 'TOP'));
  print_r($contents);
?>
<!-- taxes_eof //-->