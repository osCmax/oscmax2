<?php
/*
  osCMax v2.0, Open Source E-Commerce Solutions
  http://www.osCDox.com

  Copyright 2008 osCMax, 2008 osCommerce

  Released under the GNU General Public License
*/

// Define the webserver and path parameters
// * DIR_FS_* = Filesystem directories (local/physical)
// * DIR_WS_* = Webserver directories (virtual/URL)
  define('HTTP_SERVER', 'http://localhost');
  define('HTTP_CATALOG_SERVER', 'http://localhost');
  define('HTTPS_CATALOG_SERVER', 'http://localhost');
  define('ENABLE_SSL_CATALOG', 'false');
  define('DIR_FS_DOCUMENT_ROOT', 'C:/xampp/htdocs/oscmax2/catalog/');
  define('DIR_WS_ADMIN', '/oscmax2/catalog/admin/');
  define('DIR_FS_ADMIN', 'C:/xampp/htdocs/oscmax2/catalog/admin/');
  define('DIR_WS_CATALOG', '/oscmax2/catalog/');
  define('DIR_FS_CATALOG', 'C:/xampp/htdocs/oscmax2/catalog/');
  define('DIR_WS_IMAGES', 'images/');
  define('DIR_WS_ICONS', DIR_WS_IMAGES . 'icons/');
  define('DIR_WS_CATALOG_IMAGES', DIR_WS_CATALOG . 'images/');
  define('DIR_WS_INCLUDES', 'includes/');
  define('DIR_WS_BOXES', DIR_WS_INCLUDES . 'boxes/');
  define('DIR_WS_FUNCTIONS', DIR_WS_INCLUDES . 'functions/');
  define('DIR_WS_CLASSES', DIR_WS_INCLUDES . 'classes/');
  define('DIR_WS_MODULES', DIR_WS_INCLUDES . 'modules/');
  define('DIR_WS_LANGUAGES', DIR_WS_INCLUDES . 'languages/');
  define('DIR_WS_CATALOG_LANGUAGES', DIR_WS_CATALOG . 'includes/languages/');
  define('DIR_FS_CATALOG_LANGUAGES', DIR_FS_CATALOG . 'includes/languages/');
  define('DIR_FS_CATALOG_IMAGES', DIR_FS_CATALOG . 'images/');
  define('DIR_FS_CATALOG_MODULES', DIR_FS_CATALOG . 'includes/modules/');
  define('DIR_FS_BACKUP', DIR_FS_ADMIN . 'backups/');
  define('DIR_FCKEDITOR', DIR_FS_CATALOG . 'FCKeditor/');
  define('DIR_WS_FCKEDITOR', DIR_WS_CATALOG . 'FCKeditor/');

// define our database connection
  define('DB_SERVER', 'localhost');
  define('DB_SERVER_USERNAME', 'root');
  define('DB_SERVER_PASSWORD', '');
  define('DB_DATABASE', 'oscmax202');
  define('USE_PCONNECT', 'false');
  define('STORE_SESSIONS', 'mysql');
?>