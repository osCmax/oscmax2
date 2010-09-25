<?php

/**
 * The Feedmachine Solution
 *
 * Generate feeds for any product search engine, e.g. Google Product Search, PriceGrabber, BizRate,
 * DealTime, mySimon, Shopping.com, Yahoo! Shopping, PriceRunner.
 * @package the-feedmachine-solution
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @version 5.02
 * @link http://www.osc-solutions.co.uk/ osCommerce Solutions
 * @copyright Copyright 2005-, Lech Madrzyk
 * @author Lech Madrzyk
 */

  require('includes/application_top.php');
  
  ini_set('display_errors', 'On');
  
  $action = isset($_POST['action']) ? $_POST['action'] : ( isset($_GET['action']) ? $_GET['action'] : false );
  
  $installation_path = dirname(__FILE__) . '/';
  require_once($installation_path . 'feedmachine_config.php');
  
  $catalog_path = defined('FM_CATALOG_DIRECTORY') ? FM_CATALOG_DIRECTORY : '../';
  chdir($catalog_path);
  $catalog_path = getcwd() . '/';
  
  chdir($installation_path);
  
  require_once($installation_path . 'feedmachine_loader.php');
  
  $feeds_location_web = HTTP_CATALOG_SERVER . DIR_WS_CATALOG . FM_SAVE_LOCATION;
  $feeds_location_fs = $catalog_path . FM_SAVE_LOCATION;
  
  switch( $action ) {
    case 'update':
	  if( !empty($_POST['feeds_update']) && is_array($_POST['feeds_update']) ) {
        foreach( $_POST['feeds_update'] as $config_filename => $config ) {
          $data = array('filename' => tep_db_prepare_input($config['filename']),
                        'ftp_status' => tep_db_prepare_input($config['ftp_status']),
                        'ftp_server' => tep_db_prepare_input($config['ftp_server']),
                        'ftp_path' => tep_db_prepare_input($config['ftp_path']),
                        'ftp_username' => tep_db_prepare_input($config['ftp_username']),
                        'ftp_password' => tep_db_prepare_input($config['ftp_password']),
                        'ftp_upload_period' => tep_db_prepare_input($config['ftp_upload_period']),
                        'language_code' => tep_db_prepare_input($config['language_code']),
                        'currency_code' => tep_db_prepare_input($config['currency_code']),
                        'countries_iso_2' => tep_db_prepare_input($config['countries_iso_2']),
                        'url_parameters' => tep_db_prepare_input($config['url_parameters']));
          tep_db_perform('feedmachine', $data, 'update', 'config_filename = \'' . $config_filename . '\'');
        }
        $messageStack->add_session('Feed settings updated!', 'success');
      }
	  tep_redirect(tep_href_link('feedmachine_admin.php'));
      break;
  }

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/javascript/jquery-ui-1.8.2.custom.css">
<style type="text/css">
<!--
input {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 10px;
}
-->
</style>
<script type="text/javascript" src="includes/general.js"></script>
<script type="text/javascript"><!--
function runFeedmachine() {
  window.open('<?php echo tep_href_link('feedmachine_auto.php', 'force_update=1'); ?>','feedmachine_console','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=700,height=400,screenX=150,screenY=150,top=150,left=150')
}
//--></script>
</head>
<body onLoad="SetFocus();">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top">
    <?php echo tep_draw_form('feedmachine_admin', 'feedmachine_admin.php') . tep_draw_hidden_field('action', 'update'); ?>
	<table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">Feedmachine Admin</td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', 1, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td class="smallText"><input onClick="runFeedmachine()" type="button" value="Generate and Upload Feeds Now"></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><!--<div style="padding: 1px; border: 1px solid #000000; overflow: auto; height: 300px;">--><table border="0" width="100%" cellspacing="0" cellpadding="1">
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent">Config Filename</td>
            <td class="dataTableHeadingContent">Feed Filename</td>
			<td class="dataTableHeadingContent">View</td>
            <td class="dataTableHeadingContent">Language</td>
            <td class="dataTableHeadingContent">Currency</td>
            <td class="dataTableHeadingContent">Country</td>
            <td class="dataTableHeadingContent">URL Params</td>
            <td class="dataTableHeadingContent">FTP</td>
			<td class="dataTableHeadingContent">FTP Server</td>
			<td class="dataTableHeadingContent">FTP Path</td>
            <td class="dataTableHeadingContent">FTP Username</td>
            <td class="dataTableHeadingContent">FTP Password</td>
            <td class="dataTableHeadingContent">Period</td>
		  </tr>
<?php
  //Build Languages Array
  $languages = array();
  $languages_query = tep_db_query('SELECT * FROM ' . TABLE_LANGUAGES . ' ORDER BY code');
  while( $languages_row = tep_db_fetch_array($languages_query) ) {
    $languages[] = array('id'   => $languages_row['code'],
                         'text' => $languages_row['code']);
  }
  //

  //Build Currencies Array
  $currencies = array();
  $currencies_query = tep_db_query('SELECT * FROM ' . TABLE_CURRENCIES . ' ORDER BY code');
  while( $currencies_row = tep_db_fetch_array($currencies_query) ) {
    $currencies[] = array('id'   => $currencies_row['code'],
                          'text' => $currencies_row['code']);
  }
  //

  //Build Countries Array
  $countries = array();
  $countries_query = tep_db_query('SELECT * FROM ' . TABLE_COUNTRIES . ' ORDER BY countries_iso_code_2');
  while( $countries_row = tep_db_fetch_array($countries_query) ) {
    $countries[] = array('id'   => $countries_row['countries_iso_code_2'],
                         'text' => $countries_row['countries_iso_code_2']);
  }
  //
  
  foreach( $feeds as $config_filename => $feed ) {
?>
          <tr class="dataTableRow">
            <td class="main" style="font-size: 9px;"><?php echo current(explode('.php', $config_filename)); ?></td>
            <td class="main"><?php echo tep_draw_input_field('feeds_update[' . $config_filename . '][filename]', $feed['filename'], 'size="14"'); ?></td>
			<td class="main"><?php echo file_exists($feeds_location_fs . $feed['filename']) ? '<a href="' . $feeds_location_web . $feed['filename'] . '" target="_blank">' . tep_image(DIR_WS_ICONS . 'preview.gif', ICON_PREVIEW) . '</a>' : '&nbsp;'; ?></td>
            <td class="main"><?php echo tep_draw_pull_down_menu('feeds_update[' . $config_filename . '][language_code]', $languages, $feed['language_code']); ?></td>
            <td class="main"><?php echo tep_draw_pull_down_menu('feeds_update[' . $config_filename . '][currency_code]', $currencies, $feed['currency_code']); ?></td>
            <td class="main"><?php echo tep_draw_pull_down_menu('feeds_update[' . $config_filename . '][countries_iso_2]', $countries, $feed['countries_iso_2']); ?></td>
			<td class="main"><?php echo tep_draw_input_field('feeds_update[' . $config_filename . '][url_parameters]', $feed['url_parameters'], 'size="11"'); ?></td>
			<td class="main"><?php echo tep_draw_pull_down_menu('feeds_update[' . $config_filename . '][ftp_status]', array(array('id' => '0', 'text' => 'Off'), array('id' => '1', 'text' => 'On')), $feed['ftp_status']); ?></td>
			<td class="main"><?php echo tep_draw_input_field('feeds_update[' . $config_filename . '][ftp_server]', $feed['ftp_server'], 'size="12"'); ?></td>
            <td class="main"><?php echo tep_draw_input_field('feeds_update[' . $config_filename . '][ftp_path]', $feed['ftp_path'], 'size="8"'); ?></td>
            <td class="main"><?php echo tep_draw_input_field('feeds_update[' . $config_filename . '][ftp_username]', $feed['ftp_username'], 'size="12"'); ?></td>
            <td class="main"><?php echo tep_draw_input_field('feeds_update[' . $config_filename . '][ftp_password]', $feed['ftp_password'], 'size="12"'); ?></td>
            <td class="main"><?php echo tep_draw_input_field('feeds_update[' . $config_filename . '][ftp_upload_period]', $feed['ftp_upload_period'], 'size="2"'); ?></td>
		  </tr>
<?php
  }
?>
		  </tr>
        </table>
        <!--</div>-->
		</td>
      </tr>
	  <tr>
	    <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
	  </tr>
	  <tr>
	    <td class="main" align="right"><?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE); ?></td>
	  </tr>
      <tr>
        <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="smallText">
          <table border="0" width="300" cellspacing="0" cellpadding="2" align="right" style="padding: 3px;">
            <tr class="infoBoxHeading">
              <td class="infoBoxHeading"><b>Key</b></td>
            </tr>
            <tr>
              <td class="infoBoxContent">
              <b>Config Filename:</b> Filename of the feed configuration in <i>fm-feed-configs/</i> (displayed without the &quot;.php&quot; extension)<br>
              <b>Feed Filename:</b> Filename of the feed that is created from the configuration<br>
              <b>View:</b> Click on icon to view the feed (if it exists)<br>
              <b>Country:</b> This is used to determine the tax set-up of the feed.<br>
              <b>URL Params:</b> Additional parameters (in the form <i>var1=val1&amp;var2=var2</i>) to add to the links output in the feed. E.g. for Google Analytics: <i>utm_source=[SOURCE]&amp;utm_medium=[MEDIUM]&amp;utm_campaign=[CAMPAIGN]</i><br>
              <b>Period:</b> How often (in days) to re-upload a feed if there haven't been any changes. This can be set to prevent your feeds from expiring. <i>Applies to Feedmachine Auto only</i><br>
              </td>
            </tr>
          </table>
          <p><b>FS Location of your feeds configuration directory (where to upload new feed configurations)</b><br><?php echo $installation_path . 'fm-feed-configs/'; ?></p>
          <p><b>Web Location of your feeds</b><br><?php echo $feeds_location_web; ?></p>
          <p><b>FS Location of your feeds</b><br><?php echo $feeds_location_fs; ?></p>
          <p><b>Automation</b><br>To automate feed generation and upload, create a cron job to run the following command every 2 hours:<br><br>php <?php echo $installation_path . 'feedmachine_auto.php'; ?><br><br>Feedmachine Auto will generate and upload your feeds when it detects that your catalog has been updated. It also features a period of grace to ensure that your feeds are not generated in the middle of a catalog update.</p>
          <p><b>Donations</b><br>If you like the feedmachine solution and would like to say thank you,<br>please send a gift via PayPal to thanks@osc-solutions.co.uk.</p>
          <p><b>Help / Other Work</b><br>If you need help setting up more complex feed configurations or have other work, please visit my website and send a message using the contact form.</p>
        </td>
      </tr>
    </table>
	</form>
    </td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
