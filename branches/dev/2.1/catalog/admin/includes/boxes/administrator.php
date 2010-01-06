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
  $contents = (                    tep_admin_jqmenu(FILENAME_ADMIN_MEMBERS, BOX_ADMINISTRATOR_MEMBERS) .
                                   tep_admin_jqmenu(FILENAME_ADMIN_FILES, BOX_ADMINISTRATOR_BOXES).
                                   tep_admin_jqmenu('merchant_info.php' , 'Merchant Application').
                                   tep_admin_jqmenu('paypal_info.php' , 'Paypal Signup').
                                   tep_admin_jqmenu('ssl_info.php' , 'SSL Certificates').
                                   tep_admin_jqmenu('hosting_info.php' , 'osCMax Hosting').
                                   tep_admin_jqmenu('domain_info.php' , 'Register Domains').
                                   tep_admin_jqmenu('affiliate_info.php', 'Affiliate Program'));
  print_r($contents);
?>
<!-- administrator_eof //-->