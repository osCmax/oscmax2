<?php
/*
$Id: administrator.php 2009-11-14 19:38:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2009 osCMax, 2006 osCMax ,2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- administrator //-->

<?php
  $contents = '';
  $contents = (                    tep_admin_jqmenu(FILENAME_ADMIN_MEMBERS, BOX_ADMINISTRATOR_MEMBERS, TOP) .
                                   tep_admin_jqmenu(FILENAME_ADMIN_FILES, BOX_ADMINISTRATOR_BOXES, TOP).
								   tep_admin_jqmenu('affiliate_info.php', 'Affiliate Program', TOP) .
								   '<li><a href="#">Useful Links</a><ul>' .
                                   tep_admin_jqmenu('merchant_info.php' , 'Merchant Application', TOP) .
                                   tep_admin_jqmenu('paypal_info.php' , 'Paypal Signup', TOP) .
								   '<li><a href="http://www.aabox.com/ssl-certificates" target="_blank">SSL Certificates</a></li>' .
								   '<li><a href="http://www.aabox.com/oscmax-hosting" target="_blank">osCMax Hosting</a></li>' .
								   '<li><a href="http://www.aabox.com/domain-names-and-services" target="_blank">Register Domains</a></li>' .
								   '</ul>');
  print_r($contents);
?>
<!-- administrator_eof //-->