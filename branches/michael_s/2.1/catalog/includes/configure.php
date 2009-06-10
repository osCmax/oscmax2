<?php
/*
  osCMax v2.0, Open Source E-Commerce Solutions
  http://www.osCDox.com

  Copyright 2006 osCMax2005 osCMax

  Released under the GNU General Public License
*/

// Define the webserver and path parameters
// * DIR_FS_* = Filesystem directories (local/physical)
// * DIR_WS_* = Webserver directories (virtual/URL)
  define('HTTP_SERVER', 'http://localhost');
  define('HTTPS_SERVER', 'http://localhost');
  define('ENABLE_SSL', false);
  define('HTTP_COOKIE_DOMAIN', 'localhost');
  define('HTTPS_COOKIE_DOMAIN', 'localhost');
  define('HTTP_COOKIE_PATH', '/oscmax2/catalog/');
  define('HTTPS_COOKIE_PATH', '/oscmax2/catalog/');
  define('DIR_WS_HTTP_CATALOG', '/oscmax2/catalog/');
  define('DIR_WS_HTTPS_CATALOG', '/oscmax2/catalog/');
  define('DIR_WS_IMAGES', 'images/');
  define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
  define('DIR_WS_INCLUDES', 'includes/');
  define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
  define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');


  define('DIR_WS_DOWNLOAD_PUBLIC', 'pub/');
  define('DIR_FS_CATALOG', 'C:/xampp/htdocs/oscmax2/catalog/');
  define('DIR_FS_DOWNLOAD', DIR_FS_CATALOG . 'download/');
  define('DIR_FS_DOWNLOAD_PUBLIC', DIR_FS_CATALOG . 'pub/');


// define our database connection
  define('DB_SERVER', 'localhost');
  define('DB_SERVER_USERNAME', 'root');
  define('DB_SERVER_PASSWORD', '');
  define('DB_DATABASE', 'oscmax202');
  define('USE_PCONNECT', 'false');
  define('STORE_SESSIONS', 'mysql');
?>