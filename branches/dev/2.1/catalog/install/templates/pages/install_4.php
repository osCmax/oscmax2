<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  // Check language pack for installer
  if (isset($_GET['language'])) {
    $language_selected = ($_GET['language']);
  } elseif (isset($_POST['language'])) {
	$language_selected = ($_POST['language']);  
  } else {
	$language_selected = 'english';
  }

  require('../includes/database_tables.php');

  osc_db_connect(trim($_POST['DB_SERVER']), trim($_POST['DB_SERVER_USERNAME']), trim($_POST['DB_SERVER_PASSWORD']));
  osc_db_select_db(trim($_POST['DB_DATABASE']));

  osc_db_query('update ' . TABLE_CONFIGURATION . ' set configuration_value = "' . trim($_POST['CFG_STORE_NAME']) . '" where configuration_key = "STORE_NAME"');
  osc_db_query('update ' . TABLE_CONFIGURATION . ' set configuration_value = "' . trim($_POST['CFG_STORE_OWNER_FIRSTNAME']) . ' ' .  trim($_POST['CFG_STORE_OWNER_LASTNAME']) . '" where configuration_key = "STORE_OWNER"');
  osc_db_query('update ' . TABLE_CONFIGURATION . ' set configuration_value = "' . trim($_POST['CFG_STORE_OWNER_EMAIL_ADDRESS']) . '" where configuration_key = "STORE_OWNER_EMAIL_ADDRESS"');

  if (!empty($_POST['CFG_STORE_OWNER_NAME']) && !empty($_POST['CFG_STORE_OWNER_EMAIL_ADDRESS'])) {
    osc_db_query('update ' . TABLE_CONFIGURATION . ' set configuration_value = "\"' . trim($_POST['CFG_STORE_OWNER_NAME']) . '\" <' . trim($_POST['CFG_STORE_OWNER_EMAIL_ADDRESS']) . '>" where configuration_key = "EMAIL_FROM"');
  }

  $check_query = osc_db_query('select admin_username from ' . TABLE_ADMINISTRATORS . ' where admin_username = "' . trim($_POST['CFG_ADMINISTRATOR_USERNAME']) . '"');

  if (osc_db_num_rows($check_query)) {
    osc_db_query('update ' . TABLE_ADMINISTRATORS . ' set admin_password = "' . osc_encrypt_string(trim($_POST['CFG_ADMINISTRATOR_PASSWORD'])) . '" where admin_username = "' . trim($_POST['CFG_ADMINISTRATOR_USERNAME']) . '"');
  } else {
    osc_db_query('insert into ' . TABLE_ADMINISTRATORS . ' (admin_groups_id, admin_username, admin_firstname, admin_lastname, admin_email_address, admin_password, admin_created) values (1, "' . trim($_POST['CFG_ADMINISTRATOR_USERNAME']) . '", "' . trim($_POST['CFG_STORE_OWNER_FIRSTNAME']) . '", "' . trim($_POST['CFG_STORE_OWNER_LASTNAME']) . '", "' . trim($_POST['CFG_STORE_OWNER_EMAIL_ADDRESS']) . '", "' . osc_encrypt_string(trim($_POST['CFG_ADMINISTRATOR_PASSWORD'])) . '", now())');
  }
  
// BOF: PGM Renaming the Admin Folder
  $admin_folder = trim($_POST['CFG_ADMIN_FOLDER']);
  if ($admin_folder != 'admin') {
  	rename ('../admin', '../' . $admin_folder);
	$admin_folder_renamed = 'true';
  }
// EOF: PGM Renaming the Admin Folder

?>
<div id="menublock">
  <ul id="menutabs">
    <li><a href="index.php" id="first"><?php echo TAB_START; ?></a></li>
    <li><a href="install.php?step=1&language=<?php echo $language_selected; ?>"><?php echo TAB_DATABASE_SERVER; ?></a></li>
    <li><a href="install.php?step=2&language=<?php echo $language_selected; ?>"><?php echo TAB_WEB_SERVER; ?></a></li>
    <li><a href="install.php?step=3&language=<?php echo $language_selected; ?>"><?php echo TAB_STORE_SETTINGS; ?></a></li>
    <li><a href="#" id="active"><?php echo TAB_FINISHED; ?></a></li>
  </ul>
</div>

<div class="mainBlock">
  <?php echo TEXT_FINISHED; ?>
</div>

<div class="contentBlock">
  <div class="contentPane">
  
<?php
  $dir_fs_document_root = $_POST['DIR_FS_DOCUMENT_ROOT'];
  if ((substr($dir_fs_document_root, -1) != '\\') && (substr($dir_fs_document_root, -1) != '/')) {
    if (strrpos($dir_fs_document_root, '\\') !== false) {
      $dir_fs_document_root .= '\\';
    } else {
      $dir_fs_document_root .= '/';
    }
  }

  $http_url = parse_url($_POST['HTTP_WWW_ADDRESS']);
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
                   '  osCmax e-Commerce' . "\n" .
                   '  http://www.oscmax.com' . "\n" .
                   '' . "\n" .
                   '  Copyright 2000 - 2011 osCmax' . "\n" .
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
                   '  define(\'DB_SERVER\', \'' . trim($_POST['DB_SERVER']) . '\');' . "\n" .
                   '  define(\'DB_SERVER_USERNAME\', \'' . trim($_POST['DB_SERVER_USERNAME']) . '\');' . "\n" .
                   '  define(\'DB_SERVER_PASSWORD\', \'' . trim($_POST['DB_SERVER_PASSWORD']) . '\');' . "\n" .
                   '  define(\'DB_DATABASE\', \'' . trim($_POST['DB_DATABASE']) . '\');' . "\n" .
                   '  define(\'USE_PCONNECT\', \'false\');' . "\n" .
                   '  define(\'STORE_SESSIONS\', \'mysql\');' . "\n" .
                   '?>';

  $fp = fopen($dir_fs_document_root . 'includes/configure.php', 'w');
  fputs($fp, $file_contents);
  fclose($fp);

  $file_contents = '<?php' . "\n" .
                   '/*' . "\n" .
                   '  osCmax e-Commerce' . "\n" .
                   '  http://www.oscmax.com' . "\n" .
                   '' . "\n" .
                   '  Copyright 2000 - 2011 osCmax' . "\n" .
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
                   '  define(\'DB_SERVER\', \'' . trim($_POST['DB_SERVER']) . '\');' . "\n" .
                   '  define(\'DB_SERVER_USERNAME\', \'' . trim($_POST['DB_SERVER_USERNAME']) . '\');' . "\n" .
                   '  define(\'DB_SERVER_PASSWORD\', \'' . trim($_POST['DB_SERVER_PASSWORD']) . '\');' . "\n" .
                   '  define(\'DB_DATABASE\', \'' . trim($_POST['DB_DATABASE']) . '\');' . "\n" .
                   '  define(\'USE_PCONNECT\', \'false\');' . "\n" .
                   '  define(\'STORE_SESSIONS\', \'mysql\');' . "\n" .
                   '?>';

  $fp = fopen($dir_fs_document_root . $admin_folder . '/includes/configure.php', 'w');
  fputs($fp, $file_contents);
  fclose($fp);
?>

<table width="100%" cellspacing="0" cellpadding="0">
	<tr>
	<?php
	// BOF: PGM Renaming the Admin Folder
	if ($admin_folder_renamed == 'true') {
		echo '<td class="messageStackSuccess" colspan="2">' . TEXT_ADMIN_RENAMED_1 . $admin_folder . TEXT_ADMIN_RENAMED_2;
	} else {
	  	echo '<td class="messageStackAlert" colspan="2">' . TEXT_ADMIN_NOT_RENAMED;
  	}
	// EOF: PGM Renaming the Admin Folder
	?>
	<tr>
		<td height="2">&nbsp;</td>
	</tr>
	<tr>
		<td class="messageStackSuccess" colspan="2"><?php echo TEXT_INSTALLATION_SUCCESSFUL; ?></td>
	</tr>
    <tr>
		<td height="2">&nbsp;</td>
	</tr>
    <tr>
        <td align="center" width="50%"><a href="<?php echo $http_server . $http_catalog . 'index.php'; ?>" target="_blank"><img src="images/catalog.png" alt="<?php echo IMAGE_CATALOG; ?>" /></a></td>
        <td align="center" width="50%"><a href="<?php echo $http_server . $http_catalog . $admin_folder . '/index.php?language=' . substr($language_selected, 0, 2); ?>" target="_blank"><img src="images/admin.png" alt="<?php echo IMAGE_ADMIN; ?>" /></a></td>
    </tr>
    <tr>
        <td align="center" width="50%"><a href="<?php echo $http_server . $http_catalog . 'index.php'; ?>" target="_blank"><img src="includes/languages/<?php echo $language_selected; ?>/images/buttons/button_catalog.gif" alt="<?php echo IMAGE_CATALOG; ?>" /></a></td>
        <td align="center" width="50%"><a href="<?php echo $http_server . $http_catalog . $admin_folder . '/index.php'; ?>" target="_blank"><img src="includes/languages/<?php echo $language_selected; ?>/images/buttons/button_administration_tool.gif" alt="<?php echo IMAGE_ADMIN; ?>" /></a></td>
    </tr>
</table>

  </div>
</div>