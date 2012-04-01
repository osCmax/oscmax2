<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<!-- localization //-->
<?php
  $contents = '';
  $contents = (                    tep_admin_jqmenu(FILENAME_CURRENCIES, BOX_LOCALIZATION_CURRENCIES, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_LANGUAGES, BOX_LOCALIZATION_LANGUAGES, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_ORDERS_STATUS, BOX_LOCALIZATION_ORDERS_STATUS, 'TOP') .
								   tep_admin_jqmenu(FILENAME_PREMADE, BOX_PREMADE, 'TOP'));

  print_r($contents);
?>
<!-- localization_eof //-->