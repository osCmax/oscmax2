<?php
/*
$Id: tools.php 2009-11-14 19:38:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2009 osCMax, 2006 osCMax ,2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- tools //-->
<?php
  $contents = '';

  $contents = (					   tep_admin_jqmenu(FILENAME_BACKUP, BOX_TOOLS_BACKUP) .
								   tep_admin_jqmenu(FILENAME_RECOVER_CART_SALES, BOX_TOOLS_RECOVER_CART) .
                                   tep_admin_jqmenu(FILENAME_BANNER_MANAGER, BOX_TOOLS_BANNER_MANAGER) .
                                   tep_admin_jqmenu(FILENAME_BATCH_PRINT, BOX_TOOLS_BATCH_CENTER) . 
				  				   tep_admin_jqmenu(FILENAME_MAIL, BOX_TOOLS_MAIL) .
                                   tep_admin_jqmenu(FILENAME_NEWSLETTERS, BOX_TOOLS_NEWSLETTER_MANAGER) .
                                   tep_admin_jqmenu(FILENAME_PACKAGING, BOX_TOOLS_PACKAGING) .
                                   tep_admin_jqmenu(FILENAME_UPS_BOXES_USED, BOX_TOOLS_UPS_BOXES_USED) . 
								   tep_admin_jqmenu(FILENAME_QTPRODOCTOR, BOX_TOOLS_QTPRODOCTOR) .
								   tep_admin_jqmenu(FILENAME_CACHE, BOX_TOOLS_CACHE) .
								   tep_admin_jqmenu(FILENAME_SERVER_INFO, BOX_TOOLS_SERVER_INFO) .
                                   tep_admin_jqmenu(FILENAME_WHOS_ONLINE, BOX_TOOLS_WHOS_ONLINE));
  print_r($contents);
?>
<!-- tools_eof //-->