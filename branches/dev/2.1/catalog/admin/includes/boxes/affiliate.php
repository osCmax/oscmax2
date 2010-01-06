<?php
/*
$Id: affiliate.php 2009-11-14 19:38:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2009 osCMax, 2006 osCMax, 2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- affiliates //-->
<?php
  $contents = '';
  $contents = (  				   tep_admin_jqmenu(FILENAME_AFFILIATE_SUMMARY, BOX_AFFILIATE_SUMMARY) .
                                   tep_admin_jqmenu(FILENAME_AFFILIATE, BOX_AFFILIATE) .   
                                   tep_admin_jqmenu(FILENAME_AFFILIATE_PAYMENT, BOX_AFFILIATE_PAYMENT) .   
                                   tep_admin_jqmenu(FILENAME_AFFILIATE_SALES, BOX_AFFILIATE_SALES) .   
                                   tep_admin_jqmenu(FILENAME_AFFILIATE_CLICKS, BOX_AFFILIATE_CLICKS) .   
                                   tep_admin_jqmenu(FILENAME_AFFILIATE_BANNER_MANAGER, BOX_AFFILIATE_BANNERS) .   
                                   tep_admin_jqmenu(FILENAME_AFFILIATE_NEWS, BOX_AFFILIATE_NEWS) .
								   tep_admin_jqmenu(FILENAME_AFFILIATE_NEWSLETTERS, BOX_AFFILIATE_NEWSLETTER_MANAGER) .
								   tep_admin_jqmenu(FILENAME_AFFILIATE_CONTACT, BOX_AFFILIATE_CONTACT));
  print_r($contents);
?>
<!-- affiliates_eof //-->