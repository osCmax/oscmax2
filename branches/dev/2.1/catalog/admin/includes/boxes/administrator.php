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
                                   tep_admin_jqmenu(FILENAME_ADMIN_FILES, BOX_ADMINISTRATOR_BOXES, 'TOP') .
								   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=14', 'NONSSL') . '">' . BOX_CONFIGURATION_GZIP . '</a></li>' .
						           '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=10', 'NONSSL') . '">' . BOX_CONFIGURATION_LOGGING_CACHE . '</a><ul>' .
								   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=10', 'NONSSL') . '">' . BOX_CONFIGURATION_LOGGING . '</a></li>' .
								   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=11', 'NONSSL') . '">' . BOX_CONFIGURATION_CACHE . '</a></li>' .
								   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=55', 'NONSSL') . '">' . BOX_CONFIGURATION_PAGE_CACHE . '</a></li>' .
								   tep_admin_jqmenu(FILENAME_CACHE, BOX_TOOLS_CACHE, 'TOP') .
 								   '</ul>' .
								   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=15', 'NONSSL') . '">' . BOX_CONFIGURATION_SESSIONS . '</a></li>' .
								   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=16', 'NONSSL') . '">' . BOX_CONFIGURATION_MAINTENANCE . '</a></li>' .
								   tep_admin_jqmenu('affiliate_info.php', BOX_HEADING_AFFILIATES, 'TOP') .
								   tep_admin_jqmenu(FILENAME_QUICK_LINKS, BOX_TOOLS_QUICK_LINKS, 'TOP') .
								   '<li><a href="#">' . BOX_CONFIGURATION_USEFUL . '</a><ul>' .
                                   tep_admin_jqmenu('merchant_info.php' , 'Merchant Application', 'TOP') .
                                   tep_admin_jqmenu('paypal_info.php' , 'Paypal Signup', 'TOP') .
								   '<li><a href="http://www.aabox.com/ssl-certificates" target="_blank">SSL Certificates</a></li>' .
								   '<li><a href="http://www.aabox.com/oscmax-hosting" target="_blank">osCmax Hosting</a></li>' .
								   '<li><a href="http://www.aabox.com/domain-names-and-services" target="_blank">Register Domains</a></li>' .
								   '</ul>');
  print_r($contents);
?>
<!-- administrator_eof //-->