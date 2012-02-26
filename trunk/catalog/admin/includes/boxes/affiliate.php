<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<!-- affiliates //-->
<?php
  $contents = '';
  $contents = (  				   tep_admin_jqmenu(FILENAME_AFFILIATE_SUMMARY, BOX_AFFILIATE_SUMMARY, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_AFFILIATE, BOX_AFFILIATE, 'TOP') .   
                                   tep_admin_jqmenu(FILENAME_AFFILIATE_PAYMENT, BOX_AFFILIATE_PAYMENT, 'TOP') .   
                                   tep_admin_jqmenu(FILENAME_AFFILIATE_SALES, BOX_AFFILIATE_SALES, 'TOP') .   
                                   tep_admin_jqmenu(FILENAME_AFFILIATE_CLICKS, BOX_AFFILIATE_CLICKS, 'TOP') .   
                                   tep_admin_jqmenu(FILENAME_AFFILIATE_BANNER_MANAGER, BOX_AFFILIATE_BANNERS, 'TOP') .   
                                   tep_admin_jqmenu(FILENAME_AFFILIATE_NEWS, BOX_AFFILIATE_NEWS, 'TOP') .
								   tep_admin_jqmenu(FILENAME_AFFILIATE_NEWSLETTERS, BOX_AFFILIATE_NEWSLETTER_MANAGER, 'TOP') .
								   tep_admin_jqmenu(FILENAME_AFFILIATE_CONTACT, BOX_AFFILIATE_CONTACT, 'TOP'));
  print_r($contents);
?>
<!-- affiliates_eof //-->