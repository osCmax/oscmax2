<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<!-- administrator //-->

<?php
  $contents = '';
  $contents = (                    tep_admin_jqmenu(FILENAME_ADMIN_MEMBERS, BOX_ADMINISTRATOR_MEMBERS, 'TOP') .
								   tep_admin_jqmenu(FILENAME_ADMIN_GROUPS, BOX_ADMIN_GROUPS, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_ADMIN_FILES, BOX_ADMINISTRATOR_BOXES, 'TOP') .
								   tep_admin_jqmenu(FILENAME_CONFIGURATION_GZIP, BOX_CONFIGURATION_GZIP, 'TOP') .
								   tep_admin_jqmenu(FILENAME_CONFIGURATION_LOGGING_CACHE, BOX_CONFIGURATION_LOGGING_CACHE, 'TOP', 'submenu') . '<ul>' .
								     tep_admin_jqmenu(FILENAME_CONFIGURATION_LOGGING_CACHE, BOX_CONFIGURATION_LOGGING, 'TOP') .
									 tep_admin_jqmenu(FILENAME_CONFIGURATION_CACHE, BOX_CONFIGURATION_CACHE, 'TOP') .
									 tep_admin_jqmenu(FILENAME_CONFIGURATION_PAGE_CACHE, BOX_CONFIGURATION_PAGE_CACHE, 'TOP') .
								     tep_admin_jqmenu(FILENAME_CACHE, BOX_TOOLS_CACHE, 'TOP', '') .
 								   '</ul>' .
								   tep_admin_jqmenu(FILENAME_CONFIGURATION_SESSIONS, BOX_CONFIGURATION_SESSIONS, 'TOP') . 
								   tep_admin_jqmenu(FILENAME_CONFIGURATION_MAINTENANCE, BOX_CONFIGURATION_MAINTENANCE, 'TOP') . 
								   tep_admin_jqmenu(FILENAME_QUICK_LINKS, BOX_TOOLS_QUICK_LINKS, 'TOP') .
								   tep_admin_jqmenu(FILENAME_MERCHANT_INFO, BOX_CONFIGURATION_USEFUL, 'TOP', 'submenu') . '<ul>' .
                                     tep_admin_jqmenu(FILENAME_MERCHANT_INFO, BOX_MERCHANT_INFO, 'TOP') .
                                     tep_admin_jqmenu(FILENAME_PAYPAL_INFO, BOX_PAYPAL_INFO, 'TOP') .
								     '<li><a href="http://www.aabox.com/ssl-certificates" target="_blank">SSL Certificates</a></li>' .
								     '<li><a href="http://www.aabox.com/oscmax-hosting" target="_blank">osCmax Hosting</a></li>' .
								     '<li><a href="http://www.aabox.com/domain-names-and-services" target="_blank">Register Domains</a></li>' .
								   '</ul>');
  print_r($contents);
?>
<!-- administrator_eof //-->