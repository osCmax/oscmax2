<?php
/*
  osCMax v2.0, Open Source E-Commerce Solutions
  http://www.osCDox.com

  Copyright 2006 osCMax2005 osCMax, 2003 osCommerce

  Released under the GNU General Public License
*/

// Define the webserver and path parameters
// * DIR_FS_* = Filesystem directories (local/physical)
// * DIR_WS_* = Webserver directories (virtual/URL)
  define('HTTP_SERVER', ''); // eg, http://localhost - should not be empty for productive servers
  define('HTTP_CATALOG_SERVER', '');
  define('HTTPS_CATALOG_SERVER', '');
  define('ENABLE_SSL_CATALOG', ''); // secure webserver for catalog module
  define('DIR_FS_DOCUMENT_ROOT', ''); // where the pages are located on the server
  define('DIR_WS_ADMIN', ''); // absolute path required
  define('DIR_FS_ADMIN', ''); // absolute pate required
  define('DIR_WS_CATALOG', ''); // absolute path required
  define('DIR_FS_CATALOG', ''); // absolute path required
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
  define('DB_SERVER', ''); // eg, localhost - should not be empty for productive servers
  define('DB_SERVER_USERNAME', '');
  define('DB_SERVER_PASSWORD', '');
  define('DB_DATABASE', '');
  define('USE_PCONNECT', 'false'); // use persisstent connections?
  define('STORE_SESSIONS', 'mysql'); // leave empty '' for default handler or set to 'mysql'
?>