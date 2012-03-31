<!-- START SYSTEM TAB -->
<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

$system_setup_errors = 0;
$system_config_errors = 0;
$system_permission_errors = 0;
$system_setup_warnings = 0;
$system_config_warnings = 0;
$system_permission_warnings = 0;
?>

<table border="0" cellspacing="1" cellpadding="2" align="center" width="100%">
  <tr class="dataTableHeadingRow">
    <td class="dataTableHeadingContent" align="left"><?php echo DASHBOARD_SYSTEM_CONFIG; ?></td>
  </tr>

  <!-- Start check for SEO URLs needing PHP 5.2+ -->
  <?php
  if ( (strnatcmp(phpversion(),'5.2.0') < 0) && (SEO_URLS_ENABLED == 'true') ) { $system_config_warnings++; ?>
  <tr>
	<td class="messageStackError"><?php echo tep_image(DIR_WS_ICONS . 'warning.gif') . ' ' . WARNING_SEO_PHP_VERSION_LOW; ?></td>
  </tr>
  <?php } ?>
  <!-- End check for SEO URLs needing PHP 5.2+ -->
  
  <!-- Start check for PWA and OPC -->
  <?php
  if ( (PURCHASE_WITHOUT_ACCOUNT == 'yes') && (ONEPAGE_CHECKOUT_ENABLED == 'True') ) { $system_config_errors++; ?>
  <tr>
	<td class="messageStackError"><?php echo tep_image(DIR_WS_ICONS . 'error.gif') . ' ' . DASHBOARD_PWA_OPC_ERROR; ?></td>
  </tr>
  <?php } ?>
  <!-- End check for PWA and OPC -->
   
  <!-- Start check for OPC email -->
  <?php
  if ( (ONEPAGE_DEBUG_EMAIL_ADDRESS == 'set.me.to.valid@email.address') && (ONEPAGE_CHECKOUT_ENABLED == 'True') ) { $system_config_warnings++; ?>
  <tr>
	<td class="messageStackError"><?php echo tep_image(DIR_WS_ICONS . 'warning.gif') . ' ' . DASHBOARD_OPC_EMAIL_ERROR; ?></td>
  </tr>
  <?php } ?>
  <!-- End check for OPC email -->
  
  <!-- Start check for Affiliate email -->
  <?php
  $configuration_query = tep_db_query("select configuration_value from " . TABLE_THEME_CONFIGURATION . " where configuration_title = 'affiliate'");
  while ($configuration = tep_db_fetch_array($configuration_query)) {
    $affiliate_status = $configuration['configuration_value']; 
  }

  if ( (AFFILIATE_EMAIL_ADDRESS == '<affiliate@localhost.com>') && ($affiliate_status == 'yes') ) { $system_config_warnings++; ?>
  <tr>
	<td class="messageStackError"><?php echo tep_image(DIR_WS_ICONS . 'warning.gif') . ' ' . DASHBOARD_AFFILIATE_EMAIL_ERROR; ?></td>
  </tr>
  <?php } ?>
  <!-- End check for Affiliate email -->
  
  <!-- Start display of final message for system_config_errors -->
  <?php
  if ( ($system_config_errors == 0) && ($system_config_warnings == 0) ) { ?>
  <tr>
	<td class="messageStackSuccess"><?php echo DASHBOARD_NO_ERRORS_DETECTED_CONFIG; ?></td>
  </tr>
  <?php } else { ?>
  <tr>
	<td class="messageStackAlert"><b><?php echo $system_config_errors . DASHBOARD_ALERT_ERRORS_DETECTED_CONFIG . ' ' . $system_config_warnings . DASHBOARD_ALERT_WARNINGS_DETECTED_CONFIG; ?></b></td>
  </tr>
  <?php } ?>
  <!-- End display of final message for system_config_errors -->  
  
  <tr>
    <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
  </tr>      
  <tr class="dataTableHeadingRow">
    <td class="dataTableHeadingContent" align="left"><?php echo DASHBOARD_SYSTEM_SETUP; ?></td>
  </tr> 
     
  <!-- Start check for install directory -->
  <?php
  if (is_dir(DIR_FS_CATALOG . 'install/')) { $system_setup_errors++;  ?>
  <tr>
	<td class="messageStackError"><?php echo tep_image(DIR_WS_ICONS . 'error.gif') . ' ' . WARNING_INSTALL_DIRECTORY_EXISTS; ?></td>
  </tr>
  <?php } ?>
  <!-- End check for install directory -->

  <!-- Start check session.auto_start is disabled -->
  <?php
    if ( (function_exists('ini_get')) && (ini_get('session.auto_start') == '1') ) { $system_setup_errors++;  ?>
  <tr>
	<td class="messageStackError"><?php echo tep_image(DIR_WS_ICONS . 'error.gif') . ' ' . WARNING_SESSION_AUTO_START; ?></td>
  </tr>
  <?php } ?>
  <!-- End check session.auto_start is disabled -->
        
  <!-- Start display of final message for system_setup_errors -->
  <?php
  if ( ($system_setup_errors == 0) && ($system_setup_warnings == 0) ) { ?>
  <tr>
	<td class="messageStackSuccess"><?php echo DASHBOARD_NO_ERRORS_DETECTED_SETUP; ?></td>
  </tr>
  <?php } else { ?>
  <tr>
	<td class="messageStackAlert"><b><?php echo $system_setup_errors . DASHBOARD_ALERT_ERRORS_DETECTED_SETUP . ' ' . $system_setup_warnings . DASHBOARD_ALERT_WARNINGS_DETECTED_SETUP;  ?></b></td>
  </tr>
  <?php } ?>
  <!-- End display of final message for system_setup_errors -->
  

  <tr>
    <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
  </tr>      
  <tr class="dataTableHeadingRow">      
    <td class="dataTableHeadingContent" align="left"><?php echo DASHBOARD_PERMISSIONS; ?></td>
  </tr>
  
  <!-- Start check for configure file -->
  <?php
  if ( (file_exists(dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php')) && (is_writeable(dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php')) ) { $system_permission_errors++; ?>
  <tr>
	<td class="messageStackError"><?php echo tep_image(DIR_WS_ICONS . 'error.gif') . ' ' . WARNING_ADMIN_CONFIG_FILE_WRITEABLE; ?></td>
  </tr>
  <?php } ?>
   <?php
  if ( (file_exists(DIR_FS_CATALOG . 'includes/configure.php')) && (is_writeable(DIR_FS_CATALOG . 'includes/configure.php')) ) { $system_permission_errors++; ?>
  <tr>
	<td class="messageStackError"><?php echo tep_image(DIR_WS_ICONS . 'error.gif') . ' ' . WARNING_CONFIG_FILE_WRITEABLE; ?></td>
  </tr>
  <?php } ?>
  <!-- End check for configure file -->

  <!-- Start check for session folder -->
  <?php
  if (STORE_SESSIONS == '') {
    if (!is_dir(tep_session_save_path())) { $system_permission_errors++; ?>
  <tr>
	<td class="messageStackError"><?php echo tep_image(DIR_WS_ICONS . 'error.gif') . ' ' . WARNING_SESSION_DIRECTORY_NON_EXISTENT; ?></td>
  </tr>
  <?php
    } elseif (!is_writeable(tep_session_save_path())) { $system_permission_errors++; ?>
  <tr>
	<td class="messageStackError"><?php echo tep_image(DIR_WS_ICONS . 'error.gif') . ' ' . WARNING_SESSION_DIRECTORY_NOT_WRITEABLE; ?></td>
  </tr>
  <?php
    }
  }
  ?>
  <!-- End check for session folder -->

  <!-- Start php globals check -->
  <?php
  if ( ((int)ini_get('register_globals') == 1) ) { $system_permission_errors++; ?>
  <tr>
	<td class="messageStackError"><?php echo tep_image(DIR_WS_ICONS . 'error.gif') . ' ' . WARNING_GLOBALS_ENABLED; ?></td>
  </tr>
  <?php } ?>
  <!-- End  php globals check -->

  <!-- Start admin directory -->
  <?php
  $admin_check = trim(str_replace(DIR_WS_CATALOG, '', DIR_WS_ADMIN), '/');
  if ($admin_check === 'admin') { $system_permission_warnings++; ?>
  <tr>
	<td class="messageStackError"><?php echo tep_image(DIR_WS_ICONS . 'warning.gif') . ' ' . WARNING_ADMIN_NOT_RENAMED; ?></td>
  </tr>
  <?php } ?>
  <!-- End admin directory -->
  
  <!-- Start image directory checks -->
  <?php
  
  $image_types_big = strtoupper(DYNAMIC_MOPICS_BIG_IMAGE_TYPES) . ',' . strtolower(DYNAMIC_MOPICS_BIG_IMAGE_TYPES);
  $image_types_thumbs = strtoupper(DYNAMIC_MOPICS_THUMB_IMAGE_TYPES) . ',' . strtolower(DYNAMIC_MOPICS_THUMB_IMAGE_TYPES);

  $all_files = array();
  $image_files = array();
  $extra_files = array();
  $all_files = glob(DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR . '*.*');
  $image_files = glob(DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR . '*.{' . $image_types_big . '}', GLOB_BRACE);
  $extra_files = array_diff($all_files, $image_files);
  if (count($extra_files) > 0) { $system_permission_warnings++; ?>
  <tr>
	<td class="messageStackError"><?php echo tep_image(DIR_WS_ICONS . 'warning.gif') . ' ' . WARNING_PHP_FILES_IN_BIGIMAGES; 
	foreach ($extra_files as $file) { echo '<br>' . $file; }
	?></td>
  </tr>
  <?php }
  $all_files = array();
  $image_files = array();
  $extra_files = array();
  $all_files = glob(DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_PRODUCTS_DIR . '*.*');
  $image_files = glob(DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_PRODUCTS_DIR . '*.{' . $image_types_big . '}', GLOB_BRACE);
  $extra_files = array_diff($all_files, $image_files);
  if (count($extra_files) > 0) { $system_permission_warnings++; ?>
  <tr>
	<td class="messageStackError"><?php echo tep_image(DIR_WS_ICONS . 'warning.gif') . ' ' . WARNING_PHP_FILES_IN_PRODUCTS; 
	foreach ($extra_files as $file) { echo '<br>' . $file; }
	?></td>
  </tr>
  <?php }
  $all_files = array();
  $image_files = array();
  $extra_files = array();
  $all_files = glob(DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . '*.*');
  $image_files = glob(DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . '*.{' . $image_types_thumbs . '}', GLOB_BRACE);
  $extra_files = array_diff($all_files, $image_files);
  if (count($extra_files) > 0) { $system_permission_warnings++; ?>
  <tr>
	<td class="messageStackError"><?php echo tep_image(DIR_WS_ICONS . 'warning.gif') . ' ' . WARNING_PHP_FILES_IN_THUMBS; 
	foreach ($extra_files as $file) { echo '<br>' . $file; }
	?></td>
  </tr>
  <?php } ?>
  <!-- End image directory checks -->
  
  <!-- Start check download directory -->
  <?php
  if ( (!is_dir(DIR_FS_CATALOG . 'download/')) && (DOWNLOAD_ENABLED == 'true') ) { $system_permission_errors++; ?>
  <tr>
	<td class="messageStackError"><?php echo tep_image(DIR_WS_ICONS . 'error.gif') . ' ' . WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT; ?></td>
  </tr>
  <?php } ?>
  <!-- End check download directory -->
  
  <!-- Start check cache directory -->
  <?php  
  if (is_dir(DIR_FS_CACHE)) {
    if (!is_writeable(DIR_FS_CACHE)) { ?>
  <tr>
	<td class="messageStackError"><?php echo tep_image(DIR_WS_ICONS . 'error.gif') . ' ' . ERROR_CACHE_DIRECTORY_NOT_WRITEABLE; ?></td>
  </tr>
  <?php
	}
  } else {
  ?>
  <tr>
	<td class="messageStackError"><?php echo tep_image(DIR_WS_ICONS . 'error.gif') . ' ' . ERROR_CACHE_DIRECTORY_DOES_NOT_EXIST; ?></td>
  </tr>
  <?php
  } ?>
  <!-- End check cache directory -->

  <!-- Start display of final message for system_permission_errors -->
  <?php
  if ( ($system_permission_errors == 0) && ($system_permission_warnings == 0) ) { ?>
  <tr>
	<td class="messageStackSuccess"><?php echo DASHBOARD_NO_ERRORS_DETECTED_PERMISSION; ?></td>
  </tr>
  <?php } else { ?>
  <tr>
	<td class="messageStackAlert"><b><?php echo $system_permission_errors . DASHBOARD_ALERT_ERRORS_DETECTED_PERMISSION . ' ' . $system_permission_warnings . DASHBOARD_ALERT_WARNINGS_DETECTED_PERMISSION; ?></b></td>
  </tr>
  <?php } ?>
  <!-- End display of final message for system_permission_errors -->

</table>
<!-- END SYSTEM TAB -->