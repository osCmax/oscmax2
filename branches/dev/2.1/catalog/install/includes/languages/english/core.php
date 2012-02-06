<?php
/*
$Id:$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('TEXT_OSCMAX_WEBSITE', 'osCmax Website');
define('TEXT_FORUM', 'Support');
define('TEXT_DOCUMENTATION', 'Documentation');
define('TEXT_WIKI', 'Wiki');
define('TEXT_FOOTER_DISCLAIMER', 'osCmax provides no warranty and is redistributable under the <a href="http://www.fsf.org/licenses/gpl.txt" target="_blank">GNU General Public License</a>');

define('TAB_START', 'Start');
define('TAB_DATABASE_SERVER', 'Database Server');
define('TAB_WEB_SERVER', 'Web Server');
define('TAB_STORE_SETTINGS', 'Store Settings');
define('TAB_FINISHED', 'Finished');

define('TEXT_PHP_VERSION', 'PHP Version');
define('TEXT_PHP_SETTINGS', 'PHP Settings');
define('TEXT_PHP_EXTENSIONS', 'PHP Extensions');
define('TEXT_ON', 'On');
define('TEXT_OFF', 'Off');

define('IMAGE_CONTINUE', 'Continue');
define('IMAGE_CANCEL', 'Cancel');
define('IMGAE_RETRY', 'Retry');
define('IMAGE_ADMIN', 'Administration Tool');
define('IMAGE_CATALOG', 'Catalog');

// Start Page
define('TEXT_WELCOME_TO_OSCMAX', 'Welcome to osCmax ');
define('TEXT_INDEX_MAIN_BLOCK', '<p>osCmax allows you to sell products worldwide with your own online store. The administration side manages products, customers, orders, newsletters, specials, and more to successfully build and thrive on the success of your online business.</p>
  <p>osCmax is based on osCommerce Online Merchant 2.2 and is aimed at making deployment of your site faster and easier than ever. osCmax is backwards compatible with osCommerce Online Merchant 2.2 and thus you can leverage the largest community for an online shopping cart solution: over 140,000 registered store owners and developers who help one another out and have provided over 4,000 add-ons that extend the features and potential of your online store.</p>
  <p>osCmax and its add-ons are available for free under an Open Source license to help you start selling online sooner without any licensing fees or limitations involved.</p><p>&nbsp;</p><p>&nbsp;</p><br />');
define('TEXT_REGISTER_GLOBALS_ERROR', 'Compatibility with register_globals is supported from PHP 4.3+. This setting <u>must be enabled</u> due to an older PHP version being used.');
define('TEXT_PERMISSIONS_ERROR', '<p>The webserver is not able to save the installation parameters to its configuration files.</p><p>The following files need to have their file permissions set to world-writeable (chmod 777):</p><p></p>');
define('TEXT_CORRECT_ERROR', '<p class="messageStackAlert">Please correct the errors shown above and retry the installation procedure with the changes in place.</p>
');
define('TEXT_RESTART_WEB_SERVER_ERROR', '<p class="messageStackAlert"><i>Changing webserver configuration parameters may require the webserver service to be restarted before the changes take affect.</i>');
define('TEXT_SERVER_SUCCESS', 'The webserver environment has been verified to proceed with a successful installation and configuration of your online store.<br /><br />Please continue to start the installation procedure.');

// Step 1 - Database Server
define('TEXT_DATABASE_SERVER_BLOCK', '<p>The database server stores the content of the online store such as product information, customer information, and the orders that have been made.</p><p>Please consult your server administrator if your database server parameters are not yet known.</p>');
define('TEXT_DATABASE_SERVER', 'Database Server');
define('TEXT_DATABASE_SERVER_DESC', 'The address of the database server in the form of a hostname or IP address.');
define('TEXT_DATABASE_USERNAME', 'Username');
define('TEXT_DATABASE_USERNAME_DESC', 'The username used to connect to the database server.');
define('TEXT_DATABASE_PASSWORD', 'Password');
define('TEXT_DATABASE_PASSWORD_DESC', 'The password that is used together with the username to connect to the database server.');
define('TEXT_DATABASE_NAME', 'Database Name');
define('TEXT_DATABASE_NAME_DESC', 'The name of the database to hold the data in.');
define('TEXT_DATABASE_SUCCESS', 'Database imported successfully.');
define('TEXT_DATABASE_IMPORTING', 'The database structure is now being imported. Please be patient during this procedure.');
define('TEXT_DATABASE_PROBLEM', 'There was a problem importing the database. The following error had occured:<br><br>%s<br><br>Please verify the connection parameters and try again.');
define('TEXT_DATBASE_CONNECTION_ERROR', 'There was a problem connecting to the database server. The following error had occured:<br><br>%s<br><br>Please verify the connection parameters and try again.');
define('TEXT_TESTING_DATABASE', 'Testing database connection.');

// Step 2 - Web Server
define('TEXT_WEB_SERVER', '<p>The web server takes care of serving the pages of your online store to your guests and customers. The web server parameters make sure the links to the pages point to the correct location.</p>');
define('TEXT_WWW_ADDRESS', 'WWW Address');
define('TEXT_WEB_ADDRESS', 'The web address to the online store.');
define('TEXT_WEBSERVER_ROOT_DIR', 'Webserver Root Directory');
define('TEXT_WEBSERVER_DIRECTORY', 'The directory where the online store is installed on the server.');

// Step 3 - Store Setup
define('TEXT_STORE_SETUP', '<p>Here you can define the name of your online store and the contact information for the store owner.</p><p>The administrator username and password are used to log into the protected administration tool section.</p>');
define('TEXT_STORE_NAME', 'Store Name');
define('TEXT_STORE_NAME_DESC', 'The name of the online store that is presented to the public.');
define('TEXT_FIRST_NAME', 'Store Owner First Name');
define('TEXT_FIRST_NAME_DESC', 'The first name of the store owner that is presented to the public.');
define('TEXT_LAST_NAME', 'Store Owner Last Name');
define('TEXT_LAST_NAME_DESC', 'The last name of the store owner that is presented to the public.');
define('TEXT_EMAIL', 'Store Owner E-Mail Address');
define('TEXT_EMAIL_DESC', 'The e-mail address of the store owner that is presented to the public.');
define('TEXT_USERNAME', 'Administrator Username');
define('TEXT_USERNAME_DESC', 'The administrator username to use for the administration tool.');
define('TEXT_PASSWORD', 'Administrator Password');
define('TEXT_PASSWORD_DESC', 'The password to use for the administrator account.');
define('TEXT_ADMIN_FOLDER_NAME', 'Admin Folder Name');
define('TEXT_CHANGE_ADMIN_FOLDER', 'The name of folder in which the admin files should be kept.  It is <b>recommended that you change this</b> from the default setting of <b>admin</b> to improve your site\'s security. If you want to read more about security please <a href="http://wiki.oscdox.com/v2.5/setting_up_security" target="_blank">read the wiki</a>.');
define('TEXT_ADMIN_NO_PERMISSION', 'We have been unable to obtain sufficient file permissions to allow you to change the name of your <b>admin/</b> folder. <br><br>For instructions on how to resolve this issue, please <a href="http://wiki.oscdox.com/v2.5/installation_troubleshooting" target="_blank">See this help page</a>. <br><br>You should rename this folder to improve your store security.  For instructions on how to manually do this once you have corrected your server settings please <a href="http://wiki.oscdox.com/v2.5/setting_up_security" target="_blank">read the wiki</a>.');
define('TEXT_NO_CONFIG_PERMISSIONS', 'The installer cannot create your configure.php files. <br/> Permissions are incorrect on several directories!');
define('TEXT_NO_CONFIG_PERMISSIONS_DESC', ' You will need to change permissions to 755 or 777 on the following directories. <br />Once you have done this, reload this page and you will be able to continue the installation. If you still see this error after changing permissions and reloading this page, see the documentation for in depth <a href="http://wiki.oscdox.com/v2.5/installation_troubleshooting" target="_blank">Troubleshooting</a>. <br><br>Change permissions to 755 or 777 (hint, try 755 first. If it doesn\'t work, try 777) on the following directories:<br><br>');


// Finished
define('TEXT_FINISHED', '<h1>Installation Complete</h1><p>Congratulations on installing and configuring osCmax as your online store solution!</p><p>We wish you all the best with the success of your online store and welcome you to join and participate in our community.</p><p align="right"><i><b>- The osCmax team</b></i></p>');
define('TEXT_ADMIN_RENAMED_1', 'Congratulations! Your admin folder has been renamed to ');
define('TEXT_ADMIN_RENAMED_2', '.<br><br>If you would like to read more information about further security measures you can take a look at the <a href="http://wiki.oscdox.com/v2.5/setting_up_security" target="_blank">Wiki documentation.</a>');
define('TEXT_ADMIN_NOT_RENAMED', 'You have not renamed your <b>admin</b> folder!  We highly recommend that you do this on live stores to increase security.  <br><br>Please read the <a href="http://wiki.oscdox.com/v2.5/setting_up_security" target="_blank">Wiki documentation for more information about securing your site properly.</a>');
define('TEXT_INSTALLATION_SUCCESSFUL', 'The installation and configuration was successful!');
?>