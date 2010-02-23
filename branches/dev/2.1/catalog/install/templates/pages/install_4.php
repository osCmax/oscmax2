<?php
/*
$Id: install_4.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2009 osCMax

  Released under the GNU General Public License
*/

  require('../includes/database_tables.php');

  osc_db_connect(trim($HTTP_POST_VARS['DB_SERVER']), trim($HTTP_POST_VARS['DB_SERVER_USERNAME']), trim($HTTP_POST_VARS['DB_SERVER_PASSWORD']));
  osc_db_select_db(trim($HTTP_POST_VARS['DB_DATABASE']));

  osc_db_query('update ' . TABLE_CONFIGURATION . ' set configuration_value = "' . trim($HTTP_POST_VARS['CFG_STORE_NAME']) . '" where configuration_key = "STORE_NAME"');
  osc_db_query('update ' . TABLE_CONFIGURATION . ' set configuration_value = "' . trim($HTTP_POST_VARS['CFG_STORE_OWNER_FIRSTNAME']) . ' ' .  trim($HTTP_POST_VARS['CFG_STORE_OWNER_LASTNAME']) . '" where configuration_key = "STORE_OWNER"');
  osc_db_query('update ' . TABLE_CONFIGURATION . ' set configuration_value = "' . trim($HTTP_POST_VARS['CFG_STORE_OWNER_EMAIL_ADDRESS']) . '" where configuration_key = "STORE_OWNER_EMAIL_ADDRESS"');

  if (!empty($HTTP_POST_VARS['CFG_STORE_OWNER_NAME']) && !empty($HTTP_POST_VARS['CFG_STORE_OWNER_EMAIL_ADDRESS'])) {
    osc_db_query('update ' . TABLE_CONFIGURATION . ' set configuration_value = "\"' . trim($HTTP_POST_VARS['CFG_STORE_OWNER_NAME']) . '\" <' . trim($HTTP_POST_VARS['CFG_STORE_OWNER_EMAIL_ADDRESS']) . '>" where configuration_key = "EMAIL_FROM"');
  }

  $check_query = osc_db_query('select admin_username from ' . TABLE_ADMINISTRATORS . ' where admin_username = "' . trim($HTTP_POST_VARS['CFG_ADMINISTRATOR_USERNAME']) . '"');

  if (osc_db_num_rows($check_query)) {
    osc_db_query('update ' . TABLE_ADMINISTRATORS . ' set admin_password = "' . osc_encrypt_string(trim($HTTP_POST_VARS['CFG_ADMINISTRATOR_PASSWORD'])) . '" where admin_username = "' . trim($HTTP_POST_VARS['CFG_ADMINISTRATOR_USERNAME']) . '"');
  } else {
    osc_db_query('insert into ' . TABLE_ADMINISTRATORS . ' (admin_groups_id, admin_username, admin_firstname, admin_lastname, admin_email_address, admin_password, admin_created) values (1, "' . trim($HTTP_POST_VARS['CFG_ADMINISTRATOR_USERNAME']) . '", "' . trim($HTTP_POST_VARS['CFG_STORE_OWNER_FIRSTNAME']) . '", "' . trim($HTTP_POST_VARS['CFG_STORE_OWNER_LASTNAME']) . '", "' . trim($HTTP_POST_VARS['CFG_STORE_OWNER_EMAIL_ADDRESS']) . '", "' . osc_encrypt_string(trim($HTTP_POST_VARS['CFG_ADMINISTRATOR_PASSWORD'])) . '", now())');
  }
  
  $admin_folder = trim($HTTP_POST_VARS['CFG_ADMIN_FOLDER']);
  
  rename ('../admin', '../' . $admin_folder);
?>

<div class="mainBlock">
  <div class="stepsBox">
    <ol>
      <li>Database Server</li>
      <li>Web Server</li>
      <li>Online Store Settings</li>
      <li style="font-weight: bold;">Finished!</li>
    </ol>
  </div>

  <h1>New Installation</h1>

  <p>This web-based installation routine will correctly setup and configure osCMax Power E-Commerce to run on this server.</p>
  <p>Please follow the on-screen instructions that will take you through the database server, web server, and store configuration options. If help is needed at any stage, please consult the documentation or seek help at the community support forums.</p>
</div>

<div class="contentBlock">
  <div class="infoPane">
    <h3>Step 4: Finished!</h3>

    <div class="infoPaneContents">
      <p>Congratulations on installing and configuring osCMax Power E-Commerce as your online store solution!</p>
      <p>We wish you all the best with the success of your online store and welcome you to join and participate in our community.</p>
      <p align="right">- The osCMax Team</p>
    </div>
  </div>

  <div class="contentPane">
    <h2>Finished!</h2>

<?php
  $dir_fs_document_root = $HTTP_POST_VARS['DIR_FS_DOCUMENT_ROOT'];
  if ((substr($dir_fs_document_root, -1) != '\\') && (substr($dir_fs_document_root, -1) != '/')) {
    if (strrpos($dir_fs_document_root, '\\') !== false) {
      $dir_fs_document_root .= '\\';
    } else {
      $dir_fs_document_root .= '/';
    }
  }

  $http_url = parse_url($HTTP_POST_VARS['HTTP_WWW_ADDRESS']);
  $http_server = $http_url['scheme'] . '://' . $http_url['host'];
  $http_catalog = $http_url['path'];
  if (isset($http_url['port']) && !empty($http_url['port'])) {
    $http_server .= ':' . $http_url['port'];
  }

  if (substr($http_catalog, -1) != '/') {
    $http_catalog .= '/';
  }

  $file_contents = '<?php' . "\n" .
                   '/*' . "\n" .
                   '  osCMax v2.0, Open Source E-Commerce Solutions' . "\n" .
                   '  http://www.osCDox.com' . "\n" .
                   '' . "\n" .
                   '  Copyright 2006 osCMax2005 osCMax' . "\n" .
                   '' . "\n" .
                   '  Released under the GNU General Public License' . "\n" .
                   '*/' . "\n" .
                   '' . "\n" .
                   '// Define the webserver and path parameters' . "\n" .
                   '// * DIR_FS_* = Filesystem directories (local/physical)' . "\n" .
                   '// * DIR_WS_* = Webserver directories (virtual/URL)' . "\n" .
                   '  define(\'HTTP_SERVER\', \'' . $http_server . '\');' . "\n" .
                   '  define(\'HTTPS_SERVER\', \'' . $http_server . '\');' . "\n" .
                   '  define(\'ENABLE_SSL\', false);' . "\n" .
                   '  define(\'HTTP_COOKIE_DOMAIN\', \'' . $http_url['host'] . '\');' . "\n" .
                   '  define(\'HTTPS_COOKIE_DOMAIN\', \'' . $http_url['host'] . '\');' . "\n" .
                   '  define(\'HTTP_COOKIE_PATH\', \'' . $http_catalog . '\');' . "\n" .
                   '  define(\'HTTPS_COOKIE_PATH\', \'' . $http_catalog . '\');' . "\n" .
                   '  define(\'DIR_WS_HTTP_CATALOG\', \'' . $http_catalog . '\');' . "\n" .
                   '  define(\'DIR_WS_HTTPS_CATALOG\', \'' . $http_catalog . '\');' . "\n" .
                   '  define(\'DIR_WS_IMAGES\', \'images/\');' . "\n" .
                   '  define(\'DIR_WS_ICONS\', DIR_WS_IMAGES . \'icons/\');' . "\n" .
                   '  define(\'DIR_WS_INCLUDES\', \'includes/\');' . "\n" .
                   '  define(\'DIR_WS_BOXES\', DIR_WS_INCLUDES . \'boxes/\');' . "\n" .
                   '  define(\'DIR_WS_FUNCTIONS\', DIR_WS_INCLUDES . \'functions/\');' . "\n" .
                   '  define(\'DIR_WS_CLASSES\', DIR_WS_INCLUDES . \'classes/\');' . "\n" .
                   '  define(\'DIR_WS_MODULES\', DIR_WS_INCLUDES . \'modules/\');' . "\n" .
                   '  define(\'DIR_WS_LANGUAGES\', DIR_WS_INCLUDES . \'languages/\');' . "\n\n" .
                   '' . "\n" .
                   '  define(\'DIR_WS_DOWNLOAD_PUBLIC\', \'pub/\');' . "\n" .
                   '  define(\'DIR_FS_CATALOG\', \'' . $dir_fs_document_root . '\');' . "\n" .
                   '  define(\'DIR_FS_DOWNLOAD\', DIR_FS_CATALOG . \'download/\');' . "\n" .
                   '  define(\'DIR_FS_DOWNLOAD_PUBLIC\', DIR_FS_CATALOG . \'pub/\');' . "\n\n" .
                   '' . "\n" .
                   '// define our database connection' . "\n" .
                   '  define(\'DB_SERVER\', \'' . trim($HTTP_POST_VARS['DB_SERVER']) . '\');' . "\n" .
                   '  define(\'DB_SERVER_USERNAME\', \'' . trim($HTTP_POST_VARS['DB_SERVER_USERNAME']) . '\');' . "\n" .
                   '  define(\'DB_SERVER_PASSWORD\', \'' . trim($HTTP_POST_VARS['DB_SERVER_PASSWORD']) . '\');' . "\n" .
                   '  define(\'DB_DATABASE\', \'' . trim($HTTP_POST_VARS['DB_DATABASE']) . '\');' . "\n" .
                   '  define(\'USE_PCONNECT\', \'false\');' . "\n" .
                   '  define(\'STORE_SESSIONS\', \'mysql\');' . "\n" .
                   '?>';

  $fp = fopen($dir_fs_document_root . 'includes/configure.php', 'w');
  fputs($fp, $file_contents);
  fclose($fp);

  $file_contents = '<?php' . "\n" .
                   '/*' . "\n" .
                   '  osCMax v2.0, Open Source E-Commerce Solutions' . "\n" .
                   '  http://www.osCDox.com' . "\n" .
                   '' . "\n" .
                   '  Copyright 2008 osCMax, 2008 osCommerce' . "\n" .
                   '' . "\n" .
                   '  Released under the GNU General Public License' . "\n" .
                   '*/' . "\n" .
                   '' . "\n" .
                   '// Define the webserver and path parameters' . "\n" .
                   '// * DIR_FS_* = Filesystem directories (local/physical)' . "\n" .
                   '// * DIR_WS_* = Webserver directories (virtual/URL)' . "\n" .
                   '  define(\'HTTP_SERVER\', \'' . $http_server . '\');' . "\n" .
                   '  define(\'HTTP_CATALOG_SERVER\', \'' . $http_server . '\');' . "\n" .
                   '  define(\'HTTPS_CATALOG_SERVER\', \'' . $http_server . '\');' . "\n" .
                   '  define(\'ENABLE_SSL_CATALOG\', \'false\');' . "\n" .
                   '  define(\'DIR_FS_DOCUMENT_ROOT\', \'' . $dir_fs_document_root . '\');' . "\n" .
                   '  define(\'DIR_WS_ADMIN\', \'' . $http_catalog . $admin_folder . '/\');' . "\n" .
                   '  define(\'DIR_FS_ADMIN\', \'' . $dir_fs_document_root . $admin_folder . '/\');' . "\n" .
                   '  define(\'DIR_WS_CATALOG\', \'' . $http_catalog . '\');' . "\n" .
                   '  define(\'DIR_FS_CATALOG\', \'' . $dir_fs_document_root . '\');' . "\n" .
                   '  define(\'DIR_WS_IMAGES\', \'images/\');' . "\n" .
                   '  define(\'DIR_WS_ICONS\', DIR_WS_IMAGES . \'icons/\');' . "\n" .
                   '  define(\'DIR_WS_CATALOG_IMAGES\', DIR_WS_CATALOG . \'images/\');' . "\n" .
                   '  define(\'DIR_WS_INCLUDES\', \'includes/\');' . "\n" .
                   '  define(\'DIR_WS_BOXES\', DIR_WS_INCLUDES . \'boxes/\');' . "\n" .
                   '  define(\'DIR_WS_FUNCTIONS\', DIR_WS_INCLUDES . \'functions/\');' . "\n" .
                   '  define(\'DIR_WS_CLASSES\', DIR_WS_INCLUDES . \'classes/\');' . "\n" .
                   '  define(\'DIR_WS_MODULES\', DIR_WS_INCLUDES . \'modules/\');' . "\n" .
                   '  define(\'DIR_WS_LANGUAGES\', DIR_WS_INCLUDES . \'languages/\');' . "\n" .
                   '  define(\'DIR_WS_CATALOG_LANGUAGES\', DIR_WS_CATALOG . \'includes/languages/\');' . "\n" .
                   '  define(\'DIR_FS_CATALOG_LANGUAGES\', DIR_FS_CATALOG . \'includes/languages/\');' . "\n" .
                   '  define(\'DIR_FS_CATALOG_IMAGES\', DIR_FS_CATALOG . \'images/\');' . "\n" .
                   '  define(\'DIR_FS_CATALOG_MODULES\', DIR_FS_CATALOG . \'includes/modules/\');' . "\n" .
                   '  define(\'DIR_FS_BACKUP\', DIR_FS_ADMIN . \'backups/\');' . "\n" .
                   '  define(\'DIR_FCKEDITOR\', DIR_FS_CATALOG . \'FCKeditor/\');' . "\n" .
                   '  define(\'DIR_WS_FCKEDITOR\', DIR_WS_CATALOG . \'FCKeditor/\');' . "\n" .
                   '' . "\n" .
                   '// define our database connection' . "\n" .
                   '  define(\'DB_SERVER\', \'' . trim($HTTP_POST_VARS['DB_SERVER']) . '\');' . "\n" .
                   '  define(\'DB_SERVER_USERNAME\', \'' . trim($HTTP_POST_VARS['DB_SERVER_USERNAME']) . '\');' . "\n" .
                   '  define(\'DB_SERVER_PASSWORD\', \'' . trim($HTTP_POST_VARS['DB_SERVER_PASSWORD']) . '\');' . "\n" .
                   '  define(\'DB_DATABASE\', \'' . trim($HTTP_POST_VARS['DB_DATABASE']) . '\');' . "\n" .
                   '  define(\'USE_PCONNECT\', \'false\');' . "\n" .
                   '  define(\'STORE_SESSIONS\', \'mysql\');' . "\n" .
                   '?>';

  $fp = fopen($dir_fs_document_root . $admin_folder . '/includes/configure.php', 'w');
  fputs($fp, $file_contents);
  fclose($fp);
?>

    <p>The installation and configuration was successful!</p>

    <br />

    <table border="0" width="99%" cellspacing="0" cellpadding="0">
      <tr>
        <td align="center" width="50%"><a href="<?php echo $http_server . $http_catalog . 'index.php'; ?>" target="_blank"><img src="images/button_catalog.gif" border="0" alt="Catalog" /></a></td>
        <td align="center" width="50%"><a href="<?php echo $http_server . $http_catalog . $admin_folder . '/index.php'; ?>" target="_blank"><img src="images/button_administration_tool.gif" border="0" alt="Administration Tool" /></a></td>
      </tr>
    </table>
  </div>
</div>
