<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<!-- gv_admin //-->
<?php
  $contents = '';
  $contents = (					   tep_admin_jqmenu(FILENAME_COUPON_ADMIN, BOX_COUPON_ADMIN, 'TOP') .
								   tep_admin_jqmenu(FILENAME_GV_QUEUE, BOX_GV_ADMIN_QUEUE, 'TOP') .
								   tep_admin_jqmenu(FILENAME_GV_MAIL, BOX_GV_ADMIN_MAIL, 'TOP') .
								   tep_admin_jqmenu(FILENAME_GV_SENT, BOX_GV_ADMIN_SENT, 'TOP'));
  print_r($contents);
?>
<!-- gv_admin_eof //-->