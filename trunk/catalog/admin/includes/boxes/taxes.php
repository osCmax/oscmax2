<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

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