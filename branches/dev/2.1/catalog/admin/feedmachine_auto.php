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

error_reporting(E_ALL ^ E_NOTICE);

$installation_path = dirname(__FILE__) . '/';
require_once($installation_path . 'feedmachine_config.php');

$catalog_path = defined('FM_CATALOG_DIRECTORY') ? FM_CATALOG_DIRECTORY : '../';
chdir($catalog_path);
$catalog_path = getcwd() . '/';

$start_session = false;
require_once('includes/application_top.php');
tep_session_destroy();

require_once($installation_path . 'feedmachine_loader.php');

error_reporting(E_ALL ^ E_NOTICE);

if( !defined('FM_AUTO_TEST_MODE_LEVEL') ) define('FM_AUTO_TEST_MODE_LEVEL', 0);
if( !defined('FM_AUTO_GRACE_PERIOD_MINUTES') ) define('FM_AUTO_GRACE_PERIOD_MINUTES', 60);
if( !defined('FM_AUTO_DATE_FORMAT') ) define('FM_AUTO_DATE_FORMAT', 'Y-m-d H:i:s T');
if( !defined('FM_AUTO_REPORTING') ) define('FM_AUTO_REPORTING', true);
if( !defined('FM_AUTO_REPORT_EMAIL_ADDRESS') ) define('FM_AUTO_REPORT_EMAIL_ADDRESS', STORE_OWNER_EMAIL_ADDRESS);
define('FM_AUTO_TEST_EMAIL_ADDRESS', '');

$feedmachine_auto = true;

$fm_auto_report = array();
$fm_auto_report['global_update_triggers'] = array();
$fm_auto_report['notices'] = array();

$fm_run_start_time_array = explode(' ', microtime());
$fm_run_start_time = $fm_run_start_time_array[0] + $fm_run_start_time_array[1];
$fm_auto_report['run_start_time'] = date(FM_AUTO_DATE_FORMAT, floor($fm_run_start_time));

$force_update = isset($_GET['force_update']) ? true : ( defined('FEEDMACHINE_AUTO_FORCE_UPDATES') ? FEEDMACHINE_AUTO_FORCE_UPDATES : false );
if( $force_update ) $fm_auto_report['global_update_triggers'][] = 'this was a force update';

if( $force_update ) {
  $fm_auto_report['notices'][] = 'this was a manual update';
}

if( isset($_SERVER['HTTP_HOST']) ) {
  $fm_auto_report['notices'][] = 'this run was triggered via HTTP';
}

$updated = false;
$global_update = false;
$ftp_feeds = false;
$generate = array();
$ftp_send = array();
$feeds_current_info = array();
foreach( $feeds as $feed_id => $feed ) {
  if( empty($feeds[$feed_id]['name']) ) $feeds[$feed_id]['name'] = $feed['filename'];
  $generate[$feed_id] = false;
  $ftp_send[$feed_id] = false;
  $feeds_current_info[$feed_id] = array('name' => $feeds[$feed_id]['name'], 'last_upload' => 0, 'configuration_hash' => md5(serialize($feed)));
  $fm_auto_report['feeds'][ $feeds[$feed_id]['name'] ]['update_status'] = 'feed not updated(0)';
  $fm_auto_report['feeds'][ $feeds[$feed_id]['name'] ]['upload_trigger_status'] = 'feed upload not triggered(0)';
  $fm_auto_report['feeds'][ $feeds[$feed_id]['name'] ]['upload_status'] = 'feed was not uploaded(0)';
}

//load current stats
$global_current_info = array();

$result = tep_db_query('SELECT COUNT(*) AS count, SUM(products_price)/COUNT(*) as average_price, IF(MAX(products_last_modified)>MAX(products_date_added), UNIX_TIMESTAMP(MAX(products_last_modified)), UNIX_TIMESTAMP(MAX(products_date_added))) as last_updated FROM ' . TABLE_PRODUCTS);
$products_info = tep_db_fetch_array($result);
$global_current_info['products_last_updated']       = array('desc'  => 'products updated',
                                                            'value' => $products_info['last_updated']);
$global_current_info['products_average_price']      = array('desc'  => 'prices updated',
                                                            'value' => number_format($products_info['average_price'], 6));
$global_current_info['products_count']              = array('desc'  => 'products created/deleted',
                                                            'value' => $products_info['count']);

$result = tep_db_query('SELECT COUNT(*) AS count FROM ' . TABLE_PRODUCTS . ' WHERE products_status = 0');
$products_info = tep_db_fetch_array($result);
$global_current_info['products_status_zero']        = array('desc'  => 'products turned on/off',
                                                            'value' => $products_info['count']);

$result = tep_db_query('SELECT COUNT(*) AS count FROM ' . TABLE_PRODUCTS . ' WHERE products_quantity = 0');
$products_info = tep_db_fetch_array($result);
$global_current_info['products_quantity_zero']      = array('desc'  => 'products out-of-stock/back-in-stock',
                                                            'value' => $products_info['count']);

$result = tep_db_query('SELECT COUNT(*) AS count, IF(MAX(specials_last_modified)>MAX(specials_date_added), UNIX_TIMESTAMP(MAX(specials_last_modified)), UNIX_TIMESTAMP(MAX(specials_date_added))) as last_updated FROM ' . TABLE_SPECIALS);
$specials_info = tep_db_fetch_array($result);
$global_current_info['specials_last_updated']       = array('desc'  => 'specials updated',
                                                            'value' => $specials_info['last_updated']);
$global_current_info['specials_count']              = array('desc'  => 'specials created/deleted',
                                                            'value' => $specials_info['count']);

$result = tep_db_query('SELECT COUNT(*) AS count, IF(MAX(last_modified)>MAX(date_added), UNIX_TIMESTAMP(MAX(last_modified)), UNIX_TIMESTAMP(MAX(date_added))) as last_updated FROM ' . TABLE_CATEGORIES);
$categories_info = tep_db_fetch_array($result);
$global_current_info['categories_last_updated']     = array('desc'  => 'categories updated',
                                                            'value' => $categories_info['last_updated']);
$global_current_info['categories_count']            = array('desc'  => 'categories created/deleted',
                                                            'value' => $categories_info['count']);


//check to see if the catalog is currently being updated
$last_updated_date = max(array($global_current_info['products_last_updated']['value'], $global_current_info['specials_last_updated']['value'], $global_current_info['categories_last_updated']['value']));
if( $last_updated_date > (time()-FM_AUTO_GRACE_PERIOD_MINUTES*60) && $last_updated_date < (time()+FM_AUTO_GRACE_PERIOD_MINUTES*60) && !$force_update ) {
  echo 'Catalog is currently being updated: not generating or sending feeds.';
  tep_exit();
}

//run checks
$fmu = FM_SAVE_LOCATION . 'fm-info.txt';
if( !$force_update && file_exists($fmu) ) { 
  $update_file = file($fmu);
  $update_info = explode('|', trim($update_file[0]));
  unset($update_file[0]);
  
  $update_info_feeds = array();
  foreach( $update_file as $info ) {
    $temp = explode('|', trim($info));
	$update_info_feeds[$temp[0]]['last_upload'] = $temp[1];
	$update_info_feeds[$temp[0]]['configuration_hash'] = isset($temp[2]) ? $temp[2] : '';
	$update_info_feeds[$temp[0]]['last_generation'] = isset($temp[3]) ? $temp[3] : '';
  }
  
  foreach( $feeds as $feed_id => $feed ) {
    if( isset($update_info_feeds[ $feed['name'] ]) ) {
	  $feeds_current_info[$feed_id]['last_upload'] = $update_info_feeds[ $feed['name'] ]['last_upload'];
	  $feeds_current_info[$feed_id]['last_generation'] = $update_info_feeds[ $feed['name'] ]['last_generation'];
	}
  }
  
  $count = 0;
  foreach( $global_current_info as $value ) {
	if( !isset($update_info[$count]) ) {
	  $global_update = true;
	  $fm_auto_report['global_update_triggers'][] = 'the update info file did not match the current format (possibly a feedmachine auto version upgrade)';
	  break;
	}
	elseif( $value['value'] != $update_info[$count] ) {
	  $global_update = true;
	  $fm_auto_report['global_update_triggers'][] = $value['desc'];
    }
    ++$count;
  }
  
  if( !$global_update ) {
	foreach( $feeds as $feed_id => $feed ) {
	  if( !isset($update_info_feeds[ $feed['name'] ]) ) {
		$generate[$feed_id] = true;
		$updated = true;
		continue;
	  }
	  if( $update_info_feeds[ $feed['name'] ]['configuration_hash'] != $feeds_current_info[$feed_id]['configuration_hash'] ) {
		$generate[$feed_id] = true;
		$updated = true;
		continue;
	  }
	  if( isset($feed['force_regeneration_period']) && $update_info_feeds[$feed['name']]['last_generation'] <= (time()-$feed['force_regeneration_period']*86400) ) {
		$generate[$feed_id] = true;
		$updated = true;
		continue;
	  }
	}
  }
  
}
else {
  $global_update = true;
  if( !file_exists($fmu) ) $fm_auto_report['global_update_triggers'][] = 'first run (the update info file did not exist)';
}

if( $force_update ) $global_update = true;
if( $global_update ) {
  $updated = true;
  foreach( $feeds as $feed_id => $feed ) {
    $generate[$feed_id] = true;
  }
}

if( $updated ) {
  
  $all_feeds = $feeds;
  foreach( $generate as $feed_id => $status ) {
	if( $status ) {
	  $feeds_current_info[$feed_id]['last_generation'] = time();
	}
	else {
	  unset($feeds[$feed_id]);
	}
  }
  
  require($installation_path . 'feedmachine.php');
  
  $feeds = $all_feeds;
  unset($all_feeds);
  
  $ftp_feeds = true;
  
  foreach( $feeds as $feed_id => $feed ) {
	$ftp_send[$feed_id] = true;
	$fm_auto_report['feeds'][ $feed['name'] ]['upload_trigger_status'] = 'feed upload triggered due to update';
	
	if( $force_update ) {
	  $fm_auto_report['feeds'][ $feed['name'] ]['update_status'] = 'feed updated as part of a force update';
	}
	elseif( $global_update ) {
	  $fm_auto_report['feeds'][ $feed['name'] ]['update_status'] = 'feed updated as part of a global update';
	}
	elseif( $generate[$feed_id] ) {
	  $fm_auto_report['feeds'][ $feed['name'] ]['update_status'] = 'feed updated due to configuration change';
	}
	else {
	  $ftp_send[$feed_id] = false;
	  $fm_auto_report['feeds'][ $feed['name'] ]['update_status'] = 'feed not updated';
	  $fm_auto_report['feeds'][ $feed['name'] ]['upload_trigger_status'] = 'feed upload not triggered';
	}
  }
  
}
else {

  $catalog_last_updated = max(array($products_info['last_updated'], $specials_info['last_updated'], $categories_info['last_updated']));
  
  foreach( $feeds as $feed_id => $feed ) {
	if( isset($feed['ftp_status']) && $feed['ftp_status'] == '0' ) {
	  continue;
	}
	if( empty($feed['ftp_server']) ) {
	  continue;
    }
	if( $update_info_feeds[$feed['name']]['last_upload'] < $catalog_last_updated ) {
	  $ftp_feeds = true;
	  $ftp_send[$feed_id] = true;
	  $fm_auto_report['feeds'][ $feed['name'] ]['upload_trigger_status'] = 'feed upload triggered because ftp failed previously';
	  continue;
	}
	if( isset($feed['ftp_upload_period']) && $update_info_feeds[$feed['name']]['last_upload'] <= (time()-$feed['ftp_upload_period']*86400) ) {
	  $ftp_feeds = true;
	  $ftp_send[$feed_id] = true;
	  $fm_auto_report['feeds'][ $feed['name'] ]['upload_trigger_status'] = 'feed upload triggered because upload period has passed';
	}
  }

}

//

set_time_limit(0);

if( defined('PRODUCTION') && !PRODUCTION ) {
  $ftp_feeds = false;
  $fm_auto_report['notices'][] = 'feeds not sent because feedmachine auto was run on a non-production server';
}

//Uploading of feeds
$ftp_errors = false;
if( $ftp_feeds ) {

  foreach( $feeds as $feed_id => $feed ) {
  
	if( isset($feed['ftp_status']) && $feed['ftp_status'] == '0' ) {
	  $fm_auto_report['feeds'][ $feed['name'] ]['upload_trigger_status'] = 'feed upload not triggered because feed upload is disabled';
	  continue;
	}
	
	if( empty($feed['ftp_server']) ) {
	  $fm_auto_report['feeds'][ $feed['name'] ]['upload_trigger_status'] = 'feed upload not triggered because ftp is not configured';
	  continue;
	}
	
	if( !$ftp_send[$feed_id] ) {
	  continue;
	}
	
	if( !empty($feed['ftp_server']) ) {
	  $errors[$feed_id] = array();
	  
	  $filename = $feed['filename'];
	  $upload_filename = !empty($feed['upload_filename']) ? $feed['upload_filename'] : $filename;
	  $file = $catalog_path . FM_SAVE_LOCATION . $filename;
	  
	  if( !isset($feed['compression_compress']) ) $feed['compression_compress'] = false;
	  if( !isset($feed['ftp_send_compressed']) ) $feed['ftp_send_compressed'] = false;
	  
	  if( $feed['ftp_send_compressed'] || ( $feed['compression_compress'] && $feed['compression_delete_original'] ) ) {
	    if( $feed['compression_compress'] ) {
	      $filename = $feed['compression_filename'];
		  $file = $catalog_path . FM_SAVE_LOCATION . $filename;
	    }
	    else {
		  $gzdata = gzencode(file_get_contents($file), 9);
		  $filename = 'fm-temp-compressed.gz';
		  $file = $catalog_path . FM_SAVE_LOCATION . $filename;
		  
          $fp = fopen($file, 'w');
          fwrite($fp, $gzdata);
          fclose($fp);
		  chmod($file, 0777);
	    }
	  }
	  
	  $connected = false;
	  switch( true ) { 
	    case true:
	      if( !file_exists($file) ) {
		    $errors[$feed_id][] = 'The feed file ' . $filename . ' could not be found for upload';
			break;
		  }
		  
		  $ftp_connect_status = false;
		  for( $i=1; $i<=5; ++$i ) {
		    if( ($ftp = ftp_connect($feed['ftp_server'])) ) {
			  $ftp_connect_status = true;
			  break;
			}
			sleep(3);
		  }
		  if( !$ftp_connect_status ) {
		    $errors[$feed_id][] = 'Could not connect to ftp server: ' . $feed['ftp_server'];
			break;
		  }
		  $connected = true;
	      
		  $ftp_login_status = false;
		  for( $i=1; $i<=5; ++$i ) {
		    if( ($ftp_login = ftp_login($ftp, $feed['ftp_username'], $feed['ftp_password'])) ) {
			  $ftp_login_status = true;
			  break;
			}
			sleep(3);
		  }
		  if( !$ftp_login_status ) {
		    $errors[$feed_id][] = 'Could not log into ftp server: ' . $feed['ftp_server'];
			break;
		  }
		  
		  if( !isset($feed['ftp_passive_mode']) ) $feed['ftp_passive_mode'] = true;
		  
		  $passive_mode = false;
		  if( $feed['ftp_passive_mode'] ) {
		    $passive_mode = true;
			ftp_pasv($ftp, $passive_mode);
	      }
		  
		  $ftp_put_status = false;
		  for( $i=1; $i<=5; ++$i ) {
			if( $i >= 3 ) {
			  $passive_mode = !$passive_mode;
			  ftp_pasv($ftp, $passive_mode);
		    }
			if( ftp_put($ftp, $feed['ftp_path'] . $upload_filename, $file, ( $feed['ftp_send_compressed'] ? FTP_BINARY : FTP_ASCII )) ) {
			  if( $feed['ftp_passive_mode'] != $passive_mode ) {
			    $fm_auto_report['notices'][] = 'The ftp passive mode setting for ' . $feed['name'] . ' (set to ' . ( $feed['ftp_passive_mode'] ? 'true' : 'false' ) . ') would appear to be incorrect: Feedmachine Auto has uploaded successfully with the alternate setting after failing with the configured setting.';
			  }
			  $ftp_put_status = true;
			  break;
			}
			sleep(3);
		  }
		  if( !$ftp_put_status ) {
		    $errors[$feed_id][] = 'There was a problem sending ' . $filename . ' to ftp server: ' . $feed['ftp_server'];
			break;
		  }
	      $feeds_current_info[$feed_id]['last_upload'] = time();
		  break;
	  }
	  if( $connected ) {
	    ftp_close($ftp);
	  }
	  
	  if( !$feed['compression_compress'] && $feed['ftp_send_compressed'] ) {
	    unlink($file);
	  }
	  
	  if( empty($errors[$feed_id]) ) {
	    $fm_auto_report['feeds'][ $feed['name'] ]['upload_status'] = 'upload successful!';
	  }
	  else {
	    $ftp_errors = true;
		$fm_auto_report['feeds'][ $feed['name'] ]['upload_status'] = implode(';', $errors[$feed_id]);
	  }
	  
	}
  
  }
  
  if( $ftp_errors ) $fm_auto_report['notices'][] = 'there were ftp errors';
  
}

//Make a new update info file if necessary
if( $updated || $ftp_feeds ) {
  $new_update_file = array();
  $new_update_file[0] = array();
  foreach( $global_current_info as $key => $value ) {
    $new_update_file[0][] = $value['value'];
  }
  foreach( $feeds_current_info as $new_info ) {
    $new_update_file[] = $new_info;
  }
  $output = '';
  foreach( $new_update_file as $value ) {
    $output .= "\n" . ( is_array($value) ? implode('|', $value) : $value );
  }
  $output = substr($output, 1);
  
  if( file_exists($fmu) ) {
    unlink($fmu);
  }
  $fp = fopen($fmu, 'a');
  $fwrite = fwrite($fp, $output);
  fclose($fp);
  chmod($fmu, 0777);
}

/*
if( function_exists('curl_init') ) {
  $ch = curl_init(); curl_setopt($ch, CURLOPT_HEADER, false); curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); curl_setopt($ch, CURLOPT_URL, 'http://www.osc-sol.co.uk/updates/update_checker_v1.00.php?package=feedmachine_auto&version=' . FEEDMACHINE_AUTO_VERSION . '&domain=' . urlencode(HTTP_SERVER) . '&email=' . urlencode(STORE_OWNER_EMAIL_ADDRESS)); $response = curl_exec($ch); curl_close($ch); 
}
*/

$fm_run_end_time_array = explode(' ', microtime());
$fm_run_end_time = $fm_run_end_time_array[0] + $fm_run_end_time_array[1];
$fm_auto_report['run_end_time'] = date(FM_AUTO_DATE_FORMAT, floor($fm_run_end_time));
$fm_auto_report['runtime'] = $fm_run_end_time - $fm_run_start_time;

/*CONSTRUCT REPORT*/

$report =
'-----------------------
Feedmachine Report
-----------------------

start time: ' . $fm_auto_report['run_start_time'] . '
end time: ' . $fm_auto_report['run_end_time'] . '
runtime: ' . $fm_auto_report['runtime'] . '

';

$report .= '
GLOBAL UPDATE TRIGGERS
----------------------
';

if( empty($fm_auto_report['global_update_triggers']) ) {
  $report .= '(no global update triggers)' . "\n";
}
else {
  foreach( $fm_auto_report['global_update_triggers'] as $value ) {
    $report .= $value . "\n";
  }
}

$report .= '
NOTICES
-------
';

if( empty($fm_auto_report['notices']) ) {
  $report .= '(no notices)';
}
else {
  foreach( $fm_auto_report['notices'] as $value ) {
    $report .= $value . "\n";
  }
}

$report .= '

                        F   E   E   D   S

';

foreach( $fm_auto_report['feeds'] as $feed_name => $feed_report ) {
  $report .= $feed_name . "\n" . '------------' . "\n" . 'update status: ' . $feed_report['update_status'] . "\n" . 'upload trigger status: ' . $feed_report['upload_trigger_status'] . "\n" . 'upload status: ' . $feed_report['upload_status'] . "\n\n";
}

/******************/

//SEND REPORT
if( $updated || $ftp_feeds ) {
  if( FM_AUTO_REPORTING ) tep_mail(STORE_OWNER, FM_AUTO_REPORT_EMAIL_ADDRESS, 'Feedmachine Auto Report', $report, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
  if( FM_AUTO_TEST_MODE_LEVEL >= 2 || ( FM_AUTO_TEST_MODE_LEVEL >= 1 && $ftp_errors ) ) {
    tep_mail(STORE_OWNER, FM_AUTO_TEST_EMAIL_ADDRESS, 'Feedmachine Auto Report', $report, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
  }
}
elseif( FM_AUTO_TEST_MODE_LEVEL >= 3 ) {
  tep_mail(STORE_OWNER, FM_AUTO_TEST_EMAIL_ADDRESS, 'Feedmachine Auto Report', $report, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
}

//OUTPUT REPORT
if( isset($_SERVER['HTTP_HOST']) ) echo '<pre>';
echo $report;
if( isset($_SERVER['HTTP_HOST']) ) echo '</pre>

<script language="javascript"><!--
  opener.location.reload(true);
//--></script>';

tep_exit();

?>
