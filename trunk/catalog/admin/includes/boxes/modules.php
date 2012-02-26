<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<!-- modules -->
<?php
$contents = '';

    $contents = (				   tep_admin_jqmenu(FILENAME_MODULES_PAYMENT, BOX_MODULES_PAYMENT, 'TOP') .
	                               tep_admin_jqmenu(FILENAME_MODULES_SHIPPING, BOX_MODULES_SHIPPING, 'TOP') .
	                               tep_admin_jqmenu(FILENAME_MODULES_ORDER_TOTAL, BOX_MODULES_ORDER_TOTAL, 'TOP'));
  print_r($contents);
?>
<!-- modules_eof //-->