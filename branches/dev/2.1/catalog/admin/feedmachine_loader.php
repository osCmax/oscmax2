<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
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
  
  if( tep_db_num_rows(tep_db_query('show tables like \'feedmachine\'')) == 0 ) {
    tep_db_query('CREATE TABLE `feedmachine` (
                  `id` INT( 11 ) NOT NULL AUTO_INCREMENT ,
                  `config_filename` VARCHAR( 64 ) NOT NULL ,
                  `filename` VARCHAR( 64 ) NOT NULL ,
                  `ftp_status` TINYINT( 1 ) NOT NULL DEFAULT \'0\',
                  `ftp_server` VARCHAR( 128 ) NOT NULL ,
                  `ftp_path` VARCHAR( 128 ) NOT NULL ,
                  `ftp_username` VARCHAR( 64 ) NOT NULL ,
                  `ftp_password` VARCHAR( 128 ) NOT NULL ,
                  `ftp_upload_period` INT( 11 ) NOT NULL ,
                  `language_code` CHAR( 2 ) NOT NULL ,
                  `currency_code` CHAR( 3 ) NOT NULL ,
                  `countries_iso_2` CHAR( 2 ) NOT NULL ,
                  `url_parameters` VARCHAR( 255 ) NOT NULL ,
                  PRIMARY KEY ( `id` ),
                  UNIQUE ( `config_filename` )
                  )');
  }
  
  //Get store country code
  $store_country_code_array = tep_db_fetch_array(tep_db_query('select countries_iso_code_2 as code from ' . TABLE_COUNTRIES . ' where countries_id = ' . (int)STORE_COUNTRY));
  $store_country_code = $store_country_code_array['code'];
  
  $fm_installed_configs = array();
  $fm_installed_configs_query = tep_db_query('select * from feedmachine');
  if( tep_db_num_rows($fm_installed_configs_query) > 0 ) {
    while( $fm_installed_configs_array = tep_db_fetch_array($fm_installed_configs_query) ) {
      if( file_exists($installation_path . 'fm-feed-configs/' . $fm_installed_configs_array['config_filename']) ) {
        $fm_installed_configs[ $fm_installed_configs_array['config_filename'] ] = $fm_installed_configs_array;
      }
      else {
        tep_db_query('delete from feedmachine where config_filename = \'' . tep_db_input($fm_installed_configs_array['config_filename']) . '\'');
      }
    }
  }
  
  $fm_configs = array();
  $dir = @dir($installation_path . 'fm-feed-configs');
  while( $file = $dir->read() ) {
    $feeds = array();
    if( !is_dir($installation_path . 'fm-feed-configs/' . $file) ) {
      include($installation_path . 'fm-feed-configs/' . $file);
      if( isset($feed_config) ) {
        if( !isset($fm_installed_configs[ $file ]) ) {
          $feed_name = current(explode('.php', $file));
          $data = array('config_filename' => $file,
                        'filename' => $feed_config['filename'],
                        'language_code' => DEFAULT_LANGUAGE,
                        'currency_code' => DEFAULT_CURRENCY,
                        'countries_iso_2' => $store_country_code,
                        'ftp_upload_period' => '30',
                        'url_parameters' => ( 'utm_source=' . urlencode($feed_name) . '&amp;utm_medium=product_search&amp;utm_campaign=' . urlencode($feed_name) ));
          tep_db_perform('feedmachine', $data);
          $fm_installed_configs[ $file ] = $data;
        }
        $fm_configs[ $file ] = array_merge($feed_config, $fm_installed_configs[ $file ]);
      }
    }
  }
  
  $feeds = $fm_configs;

?>