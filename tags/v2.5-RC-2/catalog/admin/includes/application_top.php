<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// Start the clock for the page parse time log
  define('PAGE_PARSE_START_TIME', microtime());

// Set the level of error reporting
//  error_reporting(E_ALL);
  error_reporting(E_ALL & ~E_NOTICE & ~'E_DEPRECATED');

// check support for register_globals
  if (function_exists('ini_get') && (ini_get('register_globals') == false) && (PHP_VERSION < 4.3) ) {
    exit('Server Requirement Error: register_globals is disabled in your PHP configuration. This can be enabled in your php.ini configuration file or in the .htaccess file in your catalog directory. Please use PHP 4.3+ if register_globals cannot be enabled on the server.');
  }

// Set the local configuration parameters - mainly for developers
  if (file_exists('includes/local/configure.php')) include('includes/local/configure.php');

// Include application configuration parameters
  require('includes/configure.php');

// Define the project version
  define('PROJECT_VERSION', 'osCmax v2.5 RC2');

// some code to solve compatibility issues
  require(DIR_WS_FUNCTIONS . 'compatibility.php');

// set php_self in the local scope
  $PHP_SELF = $_SERVER['PHP_SELF'];

// Used in the "Backup Manager" to compress backups
  define('LOCAL_EXE_GZIP', '/usr/bin/gzip');
  define('LOCAL_EXE_GUNZIP', '/usr/bin/gunzip');
  define('LOCAL_EXE_ZIP', '/usr/local/bin/zip');
  define('LOCAL_EXE_UNZIP', '/usr/local/bin/unzip');

// include the list of project filenames
  require(DIR_WS_INCLUDES . 'filenames.php');

// include the list of project database tables
  require(DIR_WS_INCLUDES . 'database_tables.php');

// customization for the design layout
  define('BOX_WIDTH', 125); // how wide the boxes should be in pixels (default: 125)

// Define how do we update currency exchange rates
// Possible values are 'oanda' 'xe' or ''
  define('CURRENCY_SERVER_PRIMARY', 'oanda');
  define('CURRENCY_SERVER_BACKUP', 'xe');

// include the database functions
  require(DIR_WS_FUNCTIONS . 'database.php');

// make a connection to the database... now
  tep_db_connect() or die('Unable to connect to database server!');

// set application wide parameters
  $configuration_query = tep_db_query('select distinct configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);
  while ($configuration = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
  }

// define our general functions used application-wide
  require(DIR_WS_FUNCTIONS . 'general.php');
  require(DIR_WS_FUNCTIONS . 'html_output.php');

// LINE ADDED: MOD - Admin w/access levels
  require(DIR_WS_FUNCTIONS . 'password_funcs.php');

// initialize the logger class
  require(DIR_WS_CLASSES . 'logger.php');

// include shopping cart class
  require(DIR_WS_CLASSES . 'shopping_cart.php');

// define how the session functions will be used
  require(DIR_WS_FUNCTIONS . 'sessions.php');

// set the session name and save path
  tep_session_name('osCAdminID');
  tep_session_save_path(SESSION_WRITE_DIRECTORY);

// set the session cookie parameters
   if (function_exists('session_set_cookie_params')) {
    session_set_cookie_params(0, DIR_WS_ADMIN);
  } elseif (function_exists('ini_set')) {
    ini_set('session.cookie_lifetime', '0');
    ini_set('session.cookie_path', DIR_WS_ADMIN);
  }

// lets start our session
  tep_session_start();

  if ( (PHP_VERSION >= 4.3) && function_exists('ini_get') && (ini_get('register_globals') == false) ) {
    extract($_SESSION, EXTR_OVERWRITE+EXTR_REFS);
  }

// set the language
  if (!tep_session_is_registered('language') || isset($_GET['language'])) {
    if (!tep_session_is_registered('language')) {
      tep_session_register('language');
      tep_session_register('languages_id');
    }

    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language();

    if (isset($_GET['language']) && tep_not_null($_GET['language'])) {
      $lng->set_language($_GET['language']);
    } else {
      $lng->get_browser_language();
    }

    $language = $lng->language['directory'];
    $languages_id = $lng->language['id'];
  }

// include the language translations
// Code moved further below since messageStack class must be initiated first.

// define our localization functions
  require(DIR_WS_FUNCTIONS . 'localization.php');

// Include validation functions (right now only email address)
  require(DIR_WS_FUNCTIONS . 'validations.php');

// setup our boxes
  require(DIR_WS_CLASSES . 'table_block.php');
  require(DIR_WS_CLASSES . 'box.php');

// initialize the message stack for output messages
  require(DIR_WS_CLASSES . 'message_stack.php');
  $messageStack = new messageStack;

// split-page-results
  require(DIR_WS_CLASSES . 'split_page_results.php');

// entry/item info classes
  require(DIR_WS_CLASSES . 'object_info.php');

// email classes
  require(DIR_WS_CLASSES . 'mime.php');
  require(DIR_WS_CLASSES . 'email.php');

// file uploading class
  require(DIR_WS_CLASSES . 'upload.php');

// include the language translations
// BOF: [TiM's osC Solutions] Display english for missing language files
  if (file_exists(DIR_WS_LANGUAGES . $language . '/core.php')) {
    require_once(DIR_WS_LANGUAGES . $language . '/core.php');
  } else {
    if (file_exists(DIR_WS_LANGUAGES . $language . '/core.php')) {
      $messageStack->add('Missing language file (' . DIR_WS_LANGUAGES . $language . '/core.php). Using english instead.', 'error');
      require_once(DIR_WS_LANGUAGES . $language . '/core.php');
    }
  }

  $current_page = basename($PHP_SELF);
  if (file_exists(DIR_WS_LANGUAGES . $language . '/' . $current_page)) {
    include_once(DIR_WS_LANGUAGES . $language . '/' . $current_page);
  } else {
    if (file_exists(DIR_WS_LANGUAGES . 'english/' . $current_page)) {
      $messageStack->add('Missing language file ('. DIR_WS_LANGUAGES . $language . '/' . $current_page .'). Using english instead.', 'error');
      include_once(DIR_WS_LANGUAGES . 'english/' . $current_page);
    }
  }
// EOF: [TiM's osC Solutions] Display english for missing language files

// BOF: [TiM's osC Solutions] ISO-8859-1/UTF-8 dual support
  switch (strtolower(CHARSET)) {
    case 'utf-8':
      tep_db_query("SET character set utf8");
      break;
    case 'iso-8859-1':
      tep_db_query("SET character set latin1");
      break;
  }
// EOF: [TiM's osC Solutions] ISO-8859-1/UTF-8 dual support

// LINE ADDED - CREDIT CLASS Gift Voucher Contribution
require(DIR_WS_LANGUAGES . $language . '/add_ccgvdc.php');

// calculate category path
  if (isset($_GET['cPath'])) {
    $cPath = $_GET['cPath'];
  } else {
    $cPath = '';
  }

  if (tep_not_null($cPath)) {
    $cPath_array = tep_parse_category_path($cPath);
    $cPath = implode('_', $cPath_array);
    $current_category_id = $cPath_array[(sizeof($cPath_array)-1)];
  } else {
    $current_category_id = 0;
  }

// default open navigation box
  if (!tep_session_is_registered('selected_box')) {
    tep_session_register('selected_box');
    $selected_box = 'configuration';
  }

  if (isset($_GET['selected_box'])) {
    $selected_box = $_GET['selected_box'];
  }

// the following cache blocks are used in the Tools->Cache section
// ('language' in the filename is automatically replaced by available languages)
//  $cache_blocks = array(array('title' => TEXT_CACHE_CATEGORIES, 'code' => 'categories', 'file' => 'categories_box-language.cache', 'multiple' => true),
//                         array('title' => TEXT_CACHE_MANUFACTURERS, 'code' => 'manufacturers', 'file' => 'manufacturers_box-language.cache', 'multiple' => true),
//                         array('title' => TEXT_CACHE_ALSO_PURCHASED, 'code' => 'also_purchased', 'file' => 'also_purchased-language.cache', 'multiple' => true)
//                        );
// adapted for Hide products and categories from groups
  $cache_blocks = array(array('title' => TEXT_CACHE_CATEGORIES, 'code' => 'categories', 'file' => 'categories_box-language-cg', 'multiple' => true),
                        array('title' => TEXT_CACHE_MANUFACTURERS, 'code' => 'manufacturers', 'file' => 'manufacturers_box-language', 'multiple' => true),
                        array('title' => TEXT_CACHE_ALSO_PURCHASED, 'code' => 'also_purchased', 'file' => 'also_purchased-language-cg', 'multiple' => true)
                       );

// check if a default currency is set
  if (!defined('DEFAULT_CURRENCY')) {
    $messageStack->add(ERROR_NO_DEFAULT_CURRENCY_DEFINED, 'error');
  }

// check if a default language is set
  if (!defined('DEFAULT_LANGUAGE')) {
    $messageStack->add(ERROR_NO_DEFAULT_LANGUAGE_DEFINED, 'error');
  }

  if (function_exists('ini_get') && ((bool)ini_get('file_uploads') == false) ) {
    $messageStack->add(WARNING_FILE_UPLOADS_DISABLED, 'warning');
  }

// BOF: MOD - Admin w/access levels
  if (basename($_SERVER['SCRIPT_FILENAME']) != FILENAME_LOGIN && basename($_SERVER['SCRIPT_FILENAME']) != FILENAME_PASSWORD_FORGOTTEN && basename($_SERVER['SCRIPT_FILENAME']) != FILENAME_FORBIDDEN) {
    tep_admin_check_login();
  }
  
  if (substr_count($_SERVER['SCRIPT_FILENAME'],'.php') > 1) {
    tep_admin_check_login(); 
  }
// EOF: MOD - Admin w/access levels

// LINE ADDED: MOD - OSC-AFFILIATE
  require('includes/affiliate_application_top.php');

// LINE ADDED: MOD - CREDIT CLASS Gift Voucher Contribution
  require(DIR_WS_INCLUDES . 'add_ccgvdc_application_top.php');

// LINE ADDED: MOD - articles functions
  require(DIR_WS_FUNCTIONS . 'articles.php');

// BOF: MOD - Article Manager
  if (isset($_GET['tPath'])) {
    $tPath = $_GET['tPath'];
  } else {
    $tPath = '';
  }

  if (tep_not_null($tPath)) {
    $tPath_array = tep_parse_topic_path($tPath);
    $tPath = implode('_', $tPath_array);
    $current_topic_id = $tPath_array[(sizeof($tPath_array)-1)];
  } else {
    $current_topic_id = 0;
  }
// EOF: MOD - Article Manager

// BOF: FedEx Labels
  define('DIR_WS_FEDEX_LABELS', DIR_WS_IMAGES . 'fedex/');
// EOF: FedEx Labels
?>