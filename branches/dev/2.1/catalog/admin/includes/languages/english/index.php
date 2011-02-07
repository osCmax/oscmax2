<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Choose an action..');

define('BOX_TITLE_ORDERS', 'Orders');
define('BOX_TITLE_STATISTICS', 'Statistics');

define('BOX_ENTRY_SUPPORT_SITE', 'Support Site');
define('BOX_ENTRY_SUPPORT_FORUMS', 'Support Forums');
define('BOX_ENTRY_MAILING_LISTS', 'Mailing Lists');
define('BOX_ENTRY_BUG_REPORTS', 'Bug Reports');
define('BOX_ENTRY_FAQ', 'FAQ');
define('BOX_ENTRY_LIVE_DISCUSSIONS', 'Live Discussions');
define('BOX_ENTRY_CVS_REPOSITORY', 'CVS Repository');
define('BOX_ENTRY_INFORMATION_PORTAL', 'Information Portal');
define('BOX_ENTRY_OSCDOX', 'osCDox.com');
define('BOX_ENTRY_TEMPLATE_STORE', 'osCmax Templates');

define('BOX_ENTRY_AABOX', 'osCmax Hosting<br>$12.99/mo');
define('BOX_ENTRY_PAYPAL', 'Paypal Account Signup');
define('BOX_ENTRY_MERCHANT', 'Get A Merchant Account');
define('BOX_ENTRY_DOMAINS', 'Purchase Domains');
define('BOX_ENTRY_SSL', 'Purchase SSL Certificate');

define('BOX_ENTRY_CUSTOMERS', 'Customers:');
define('BOX_ENTRY_PRODUCTS', 'Products:');
define('BOX_ENTRY_REVIEWS', 'Reviews:');

define('BOX_CONNECTION_PROTECTED', 'You are protected by a %s secure SSL connection.');
define('BOX_CONNECTION_UNPROTECTED', 'You are <font color="#ff0000">not</font> protected by a secure SSL connection.');
define('BOX_CONNECTION_UNKNOWN', 'unknown');

define('CATALOG_CONTENTS', 'Contents');

define('REPORTS_PRODUCTS', 'Products');
define('REPORTS_ORDERS', 'Orders');

define('TOOLS_BACKUP', 'Backup');
define('TOOLS_BANNERS', 'Banners');
define('TOOLS_FILES', 'Files');

define('TEXT_TAB1', 'Sales');
define('TEXT_TAB2', 'Products');
define('TEXT_TAB3', 'Admin Log');
define('TEXT_TAB4', 'Customer Log');
define('TEXT_TAB5', 'HTTP Error Log');
define('TEXT_TAB6', 'System');

define('VIEW_COMPLETE_REPORT', 'View complete report');

define('DASHBOARD_IP', 'IP Address');
define('DASHBOARD_NO', 'No.');
define('DASHBOARD_TIME', 'Date and Time');
define('DASHBOARD_USER', 'User ID');
define('DASHBOARD_EVENT', 'Event Type');
define('DASHBOARD_RANK', 'Rank');
define('DASHBOARD_PRODUCT', 'Product');
define('DASHBOARD_QUANTITY', 'Qty');
define('DASHBOARD_VIEWED', 'Products Viewed');

define('DASHBOARD_TOP_TEN', 'Top Ten Customers');
define('DASHBOARD_TOP_TEN_CUSTOMER', 'Customer Name');
define('DASHBOARD_TOP_TEN_TOTAL', 'Total');

define('DASHBOARD_ORDERS', 'Orders Snapshot');
define('DASHBOARD_ORDERS_STATUS', 'Order Status');

define('DASHBOARD_DATABASE', 'Database Snapshot');
define('DASHBOARD_DATABASE_CUST', 'Number of customers:');
define('DASHBOARD_DATABASE_PROD', 'Number of products:');
define('DASHBOARD_DATABASE_SPEC', 'Special Offers:');


define('DASHBOARD_PRODUCTS_V', 'Products Viewed');
define('DASHBOARD_PRODUCTS_V_VIEWS', 'Views');

define('DASHBOARD_PRODUCTS_P', 'Products Purchased');
define('DASHBOARD_PRODUCTS_P_PURCHASED', 'Purchased');

define('DASHBOARD_HTTP_URL', 'URL');
define('DASHBOARD_HTTP_BROWSER', 'Browser');
define('DASHBOARD_HTTP_REFER', 'Referer');
define('DASHBOARD_HTTP_ERROR', 'Error Type');


define('DASHBOARD_SYSTEM_CONFIG', 'System Configuration');
define('DASHBOARD_SYSTEM_SETUP', 'System Setup');
define('DASHBOARD_PERMISSIONS', 'Permissions &amp; Security'); 

define('DASHBOARD_NO_ERRORS_DETECTED_CONFIG', 'No errors detected in your System Configuration.');
define('DASHBOARD_ALERT_ERRORS_DETECTED_CONFIG', ' system configuration error(s);');
define('DASHBOARD_ALERT_WARNINGS_DETECTED_CONFIG', ' system configuration warning(s);');

define('DASHBOARD_NO_ERRORS_DETECTED_SETUP', 'No errors detected in your System Setup.');
define('DASHBOARD_ALERT_ERRORS_DETECTED_SETUP', ' system setup error(s); ');
define('DASHBOARD_ALERT_WARNINGS_DETECTED_SETUP', ' system setup warning(s); ');

define('DASHBOARD_NO_ERRORS_DETECTED_PERMISSION', 'No errors detected in your Permissions.');
define('DASHBOARD_ALERT_ERRORS_DETECTED_PERMISSION', ' permissions error(s)');
define('DASHBOARD_ALERT_WARNINGS_DETECTED_PERMISSION', ' permissions warning(s); ');

define('DASHBOARD_PWA_OPC_ERROR', 'Warning: You have set <u><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=7575&amp;cID=3069', 'NONSSL') . '">One Page Checkout</a></u> and <u><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=5&amp;cID=1449', 'NONSSL') . '">Purchase Without Account</a></u> to be enabled.  Please disable one of these modules.');
define('DASHBOARD_OPC_EMAIL_ERROR', 'Warning: You have enabled One Page Checkout but not set up the <u><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=7575&amp;cID=3079', 'NONSSL') . '">debug email address yet</a></u>.');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Error: Installation directory exists at: ' . (DIR_FS_CATALOG . 'install/') . '. Please remove this directory for security reasons.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Error: I am able to write to the configuration file: ' . (DIR_FS_CATALOG) . 'includes/configure.php. This is a potential security risk - please set the right user permissions on this file.');
define('WARNING_ADMIN_CONFIG_FILE_WRITEABLE', 'Error: I am able to write to the configuration file: ' . (DIR_FS_ADMIN) . 'includes/configure.php. This is a potential security risk - please set the right user permissions on this file.');

define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Error: The sessions directory does not exist: ' . tep_session_save_path() . '. Sessions will not work until this directory is created.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Warning: I am not able to write to the sessions directory: ' . tep_session_save_path() . '. Sessions will not work until the right user permissions are set.');
define('WARNING_SEO_PHP_VERSION_LOW', 'Error: Your webserver is running ' . PHP_VERSION . ' which is not sufficient for running SEO URLs. Please disable this module until you have upgraded your version of PHP.');
define('WARNING_SESSION_AUTO_START', 'Warning: session.auto_start is enabled - please disable this php feature in php.ini and restart the web server.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Warning: The downloadable products directory does not exist: ' . dirname(DIR_FS_CATALOG) . '/download. Downloadable products will not work until this directory is valid.');
define('WARNING_ADMIN_NOT_RENAMED', 'Warning: You have not renamed your admin folder.  This is a potential security risk <u><a href="http://wiki.oscdox.com/v2.5/setting_up_security" target="_blank">please read the wiki to find out how to do this</a></u>.');
define('WARNING_PHP_FILES_IN_BIGIMAGES', 'Warning: You have PHP files in the ' . DIR_FS_CATALOG . DYNAMIC_MOPICS_BIGIMAGES_DIR . ' image folder.  This maybe an indication of malicious software on your server.');
define('WARNING_PHP_FILES_IN_PRODUCTS', 'Warning: You have PHP files in the ' . DIR_FS_CATALOG . DYNAMIC_MOPICS_PRODUCTS_DIR . ' image folder.  This maybe an indication of malicious software on your server.');
define('WARNING_PHP_FILES_IN_THUMBS', 'Warning: You have PHP files in the ' . DIR_FS_CATALOG . DYNAMIC_MOPICS_THUMBS_DIR . ' image folder.  This maybe an indication of malicious software on your server.');
?>