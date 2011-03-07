<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com
  adapted for Separate Pricing Per Customer 4.2.x, Hide products and categories from groups 2008/08/03

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// start the timer for the page parse time log
  define('PAGE_PARSE_START_TIME', microtime());
//LINE ADDED
$debug = array();

// set the level of error reporting
  error_reporting(E_ALL & ~E_NOTICE & ~'E_DEPRECATED');

// check support for register_globals
  if (function_exists('ini_get') && (ini_get('register_globals') == false) && (PHP_VERSION < 4.3) ) {
    exit('Server Requirement Error: register_globals is disabled in your PHP configuration. This can be enabled in your php.ini configuration file or in the .htaccess file in your catalog directory. Please use PHP 4.3+ if register_globals cannot be enabled on the server.');
  }
// LINE ADDED: added to support PHP 5.0.x by TJ
$HTTP_GET_VARS = $_GET; $HTTP_POST_VARS = $_POST;

// Set the local configuration parameters - mainly for developers
  if (file_exists('includes/local/configure.php')) include('includes/local/configure.php');

// include server parameters
  require('includes/configure.php');

  if (strlen(DB_SERVER) < 1) {
    if (is_dir('install')) {
      header('Location: install/index.php');
    }
  }

// define the project version
  define('PROJECT_VERSION', 'osCmax v2.5 Beta 3');

// some code to solve compatibility issues
  require(DIR_WS_FUNCTIONS . 'compatibility.php');

// set the type of request (secure or not)
  $request_type = (isset($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on')) ? 'SSL' : 'NONSSL';

  /**
  * USU5 function to return the base filename
  */
  function usu5_base_filename() {
    // Probably won't get past SCRIPT_NAME unless this is reporting cgi location
    $base = new ArrayIterator( array( 'SCRIPT_NAME', 'PHP_SELF', 'REQUEST_URI', 'ORIG_PATH_INFO', 'HTTP_X_ORIGINAL_URL', 'HTTP_X_REWRITE_URL' ) );
    while ( $base->valid() ) {
      if ( array_key_exists(  $base->current(), $_SERVER ) && !empty(  $_SERVER[$base->current()] ) ) {
        if ( false !== strpos( $_SERVER[$base->current()], '.php' ) ) {
           // ignore processing if this script is not running in the catalog directory
           if ( dirname($_SERVER[$base->current()]).'/' != DIR_WS_HTTP_CATALOG) {
              return $_SERVER[$base->current()];
              }
          preg_match( '@[a-z0-9_]+\.php@i', $_SERVER[$base->current()], $matches );
          if ( is_array( $matches ) && ( array_key_exists( 0, $matches ) )
                                    && ( substr( $matches[0], -4, 4 ) == '.php' )
                                    && ( is_readable( $matches[0] ) || ( false !== strpos( $_SERVER[$base->current()], 'ext/modules/' ) ) ) ) {
            return $matches[0];
          }
        }
      }
      $base->next();
    }
    // Some odd server set ups return / for SCRIPT_NAME and PHP_SELF when accessed as mysite.com (no index.php) where they usually return /index.php
    if ( ( $_SERVER['SCRIPT_NAME'] == '/' ) || ( $_SERVER['PHP_SELF'] == '/' ) ) {
      return HTTP_SERVER;
    }
    trigger_error( 'USU5 could not find a valid base filename, please inform the developer.', E_USER_WARNING );
  } // End function
// set php_self in the local scope
  $PHP_SELF = usu5_base_filename();

  if ($request_type == 'NONSSL') {
    define('DIR_WS_CATALOG', DIR_WS_HTTP_CATALOG);
  } else {
    define('DIR_WS_CATALOG', DIR_WS_HTTPS_CATALOG);
  }

// include the list of project filenames
  require(DIR_WS_INCLUDES . 'filenames.php');

// include the list of project database tables
  require(DIR_WS_INCLUDES . 'database_tables.php');

// customization for the design layout
  define('BOX_WIDTH', 125); // how wide the boxes should be in pixels (default: 125)

// include the database functions
  require(DIR_WS_FUNCTIONS . 'database.php');

// make a connection to the database... now
  tep_db_connect() or die('Unable to connect to database server!');

// set the application parameters
  $configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);
  while ($configuration = tep_db_fetch_array($configuration_query)) {
    define($configuration['cfgKey'], $configuration['cfgValue']);
  }

// if gzip_compression is enabled, start to buffer the output
  if ( (GZIP_COMPRESSION == 'true') && ($ext_zlib_loaded = extension_loaded('zlib')) && (PHP_VERSION >= '4') ) {
    if (($ini_zlib_output_compression = (int)ini_get('zlib.output_compression')) < 1) {
      if (PHP_VERSION >= '4.0.4') {
        ob_start('ob_gzhandler');
      } else {
        include(DIR_WS_FUNCTIONS . 'gzip_compression.php');
        ob_start();
        ob_implicit_flush();
      }
    } else {
      ini_set('zlib.output_compression_level', GZIP_LEVEL);
    }
  }

// define general functions used application-wide
  require(DIR_WS_FUNCTIONS . 'general.php');
  require(DIR_WS_FUNCTIONS . 'html_output.php');

// set the cookie domain
  $cookie_domain = (($request_type == 'NONSSL') ? HTTP_COOKIE_DOMAIN : HTTPS_COOKIE_DOMAIN);
  $cookie_path = (($request_type == 'NONSSL') ? HTTP_COOKIE_PATH : HTTPS_COOKIE_PATH);

// include cache functions if enabled
  if (USE_CACHE == 'true') include(DIR_WS_FUNCTIONS . 'cache.php');

// BOF: MOD - Wishlist 3.5
// include wishlist class
   require(DIR_WS_CLASSES . 'wishlist.php');
// EOF: MOD - Wishlist 3.5

// include shopping cart class
  require(DIR_WS_CLASSES . 'shopping_cart.php');

// include navigation history class
  require(DIR_WS_CLASSES . 'navigation_history.php');

// define how the session functions will be used
  require(DIR_WS_FUNCTIONS . 'sessions.php');

// set the session name and save path
  tep_session_name('osCsid');
  tep_session_save_path(SESSION_WRITE_DIRECTORY);

// set the session cookie parameters
   if (function_exists('session_set_cookie_params')) {
    session_set_cookie_params(0, $cookie_path, $cookie_domain);
  } elseif (function_exists('ini_set')) {
    ini_set('session.cookie_lifetime', '0');
    ini_set('session.cookie_path', $cookie_path);
    ini_set('session.cookie_domain', $cookie_domain);
  }

// set the session ID if it exists
   if (isset($_POST[tep_session_name()])) {
     tep_session_id($_POST[tep_session_name()]);
   } elseif ( ($request_type == 'SSL') && isset($_GET[tep_session_name()]) ) {
     tep_session_id($_GET[tep_session_name()]);
   }

// start the session
  $session_started = false;
  if (SESSION_FORCE_COOKIE_USE == 'True') {
    tep_setcookie('cookie_test', 'please_accept_for_session', time()+60*60*24*30, $cookie_path, $cookie_domain);

    if (isset($HTTP_COOKIE_VARS['cookie_test'])) {
      tep_session_start();
      $session_started = true;
    }
  } elseif (SESSION_BLOCK_SPIDERS == 'True') {
    $user_agent = strtolower(getenv('HTTP_USER_AGENT'));
    $spider_flag = false;

    if (tep_not_null($user_agent)) {
      $spiders = file(DIR_WS_INCLUDES . 'spiders.txt');

      for ($i=0, $n=sizeof($spiders); $i<$n; $i++) {
        if (tep_not_null($spiders[$i])) {
          if (is_integer(strpos($user_agent, trim($spiders[$i])))) {
            $spider_flag = true;
            break;
          }
        }
      }
    }

    if ($spider_flag == false) {
      tep_session_start();
      $session_started = true;
    }
  } else {
    tep_session_start();
    $session_started = true;
  }

  if ( ($session_started == true) && (PHP_VERSION >= 4.3) && function_exists('ini_get') && (ini_get('register_globals') == false) ) {
    extract($_SESSION, EXTR_OVERWRITE+EXTR_REFS);
  }

// initialize a session token
  if (!tep_session_is_registered('sessiontoken')) {
    $sessiontoken = md5(tep_rand() . tep_rand() . tep_rand() . tep_rand());
    tep_session_register('sessiontoken');
  }

// set SID once, even if empty
  $SID = (defined('SID') ? SID : '');

// verify the ssl_session_id if the feature is enabled
  if ( ($request_type == 'SSL') && (SESSION_CHECK_SSL_SESSION_ID == 'True') && (ENABLE_SSL == true) && ($session_started == true) ) {
    $ssl_session_id = getenv('SSL_SESSION_ID');
    if (!tep_session_is_registered('SSL_SESSION_ID')) {
      $SESSION_SSL_ID = $ssl_session_id;
      tep_session_register('SESSION_SSL_ID');
    }

    if ($SESSION_SSL_ID != $ssl_session_id) {
      tep_session_destroy();
      tep_redirect(tep_href_link(FILENAME_SSL_CHECK));
    }
  }

// verify the browser user agent if the feature is enabled
  if (SESSION_CHECK_USER_AGENT == 'True') {
    $http_user_agent = getenv('HTTP_USER_AGENT');
    if (!tep_session_is_registered('SESSION_USER_AGENT')) {
      $SESSION_USER_AGENT = $http_user_agent;
      tep_session_register('SESSION_USER_AGENT');
    }

    if ($SESSION_USER_AGENT != $http_user_agent) {
      tep_session_destroy();
      tep_redirect(tep_href_link(FILENAME_LOGIN));
    }
  }

// verify the IP address if the feature is enabled
  if (SESSION_CHECK_IP_ADDRESS == 'True') {
    $ip_address = tep_get_ip_address();
    if (!tep_session_is_registered('SESSION_IP_ADDRESS')) {
      $SESSION_IP_ADDRESS = $ip_address;
      tep_session_register('SESSION_IP_ADDRESS');
    }

    if ($SESSION_IP_ADDRESS != $ip_address) {
      tep_session_destroy();
      tep_redirect(tep_href_link(FILENAME_LOGIN));
    }
  }

// create the shopping cart
  if (!tep_session_is_registered('cart') || !is_object($cart)) {
    tep_session_register('cart');
    $cart = new shoppingCart;
  }

// call for price
  define ('CALL_FOR_PRICE_VALUE', -1);

// include currencies class and create an instance
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

// BOF QPBPP for SPPC
  // include the price formatter classes for the price breaks contribution
  require(DIR_WS_CLASSES . 'PriceFormatter.php');
  $pf = new PriceFormatter;
  require(DIR_WS_CLASSES . 'PriceFormatterStore.php');
  $pfs = new PriceFormatterStore;
// EOF QPBPP for SPPC

// include the mail classes
  require(DIR_WS_CLASSES . 'mime.php');
  require(DIR_WS_CLASSES . 'email.php');

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
  require(DIR_WS_LANGUAGES . $language . '/core.php');
  
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

// include the language locale
  require(DIR_WS_LANGUAGES . $language . '/locale/locale.php');
// LINE ADDED - CREDIT CLASS Gift Voucher Contribution
  require(DIR_WS_LANGUAGES . $language . '/add_ccgvdc.php');


// BOF: MOD
// ULTIMATE Seo Urls 5 by FWR Media
  if (!isset($seo_urls) || !is_object($seo_urls)) {
    include_once DIR_WS_MODULES . 'ultimate_seo_urls5' . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR . 'usu.php';
    $seo_urls = new usu($languages_id, $request_type, $session_started, $SID);
  }
  $seo_urls->initiate($SID, $languages_id, $language);

// EOF: ULTIMATE Seo Urls 5 by FWR Media
// EOF: MOD

// currency
  if (!tep_session_is_registered('currency') || isset($_GET['currency']) || ( (USE_DEFAULT_LANGUAGE_CURRENCY == 'true') && (LANGUAGE_CURRENCY != $currency) ) ) {
    if (!tep_session_is_registered('currency')) tep_session_register('currency');

    if (isset($_GET['currency']) && $currencies->is_set($_GET['currency'])) {
      $currency = $_GET['currency'];
    } else {
      $currency = (USE_DEFAULT_LANGUAGE_CURRENCY == 'true') ? LANGUAGE_CURRENCY : DEFAULT_CURRENCY;
    }
  }

  // navigation history
  if (!tep_session_is_registered('navigation') || !is_object($navigation)) {
    tep_session_register('navigation');
    $navigation = new navigationHistory;
  }
  $navigation->add_current_page();

// BOF: MOD - Down for Maintenance except for admin ip
if (EXCLUDE_ADMIN_IP_FOR_MAINTENANCE != getenv('REMOTE_ADDR')){
  if (DOWN_FOR_MAINTENANCE=='true' and !strstr($PHP_SELF,DOWN_FOR_MAINTENANCE_FILENAME)) { tep_redirect(tep_href_link(DOWN_FOR_MAINTENANCE_FILENAME)); }
  }
// do not let people get to down for maintenance page if not turned on
if (DOWN_FOR_MAINTENANCE=='false' and strstr($PHP_SELF,DOWN_FOR_MAINTENANCE_FILENAME)) {
    tep_redirect(tep_href_link(FILENAME_DEFAULT));
}
// EOF: MOD - Down for Maintenance

// BOF: MOD - Wishlist 3.5
// wishlist data
  if (!tep_session_is_registered('wishList') || !is_object($wishList)) {
        tep_session_register('wishList');
        $wishList = new wishlist;
     }

 //Wishlist actions (must be before shopping cart actions)
   if(isset($_POST['wishlist_x'])) {
      if(isset($_POST['products_id'])) {
          if(isset($_POST['id'])) {
              $attributes_id = $_POST['id'];
              tep_session_register('attributes_id');
           }
           $wishlist_id = $_POST['products_id'];
           tep_session_register('wishlist_id');
      }
      tep_redirect(tep_href_link(FILENAME_WISHLIST));
   }
// EOF: MOD - Wishlist 3.5

// BOF: set product attribute types
  define('PRODUCTS_OPTIONS_TYPE_SELECT', 0);
  define('PRODUCTS_OPTIONS_TYPE_RADIO', 3);
  define('PRODUCTS_OPTIONS_TYPE_CHECKBOX', 4);
// EOF: set product attribute types
// BOF: PWA - Fix to prevent blank order; JimbobobHacker; 30 Sep 2010; Mod: 355
if (tep_session_is_registered('customer_id') && (isset($_GET['products_id']) || isset($_POST['products_id']))) {
  $query = tep_db_query("select customers_id from " . TABLE_CUSTOMERS . " where customers_id = " . (int)$customer_id);
  if (tep_db_num_rows($query) == 0) {
    tep_session_unregister('customer_id');
  }
}
// EOF: PWA

// BOF Separate Pricing Per Customer, Hide products and categories from groups

  if (isset($_SESSION['sppc_customer_group_id']) && $_SESSION['sppc_customer_group_id'] != '0') {
    $customer_group_id = $_SESSION['sppc_customer_group_id'];
  } else {
    $customer_group_id = '0';
  }


// Shopping cart actions
  if (isset($_GET['action'])) {
// redirect the customer to a friendly cookie-must-be-enabled page if cookies are disabled
    if ($session_started == false) {
      tep_redirect(tep_href_link(FILENAME_COOKIE_USAGE));
    }
      $hide_product = false;
   /* the shopping_cart page and some others sends an array 'products_id' or 'notify'.
      That is dealt with separately. For the following code two new functions (tep_get_hide_status
      and tep_get_hide_status_single) should have been added to /includes/functions/general.php */
      if (isset($_POST['products_id']) && !is_array($_POST['products_id'])) {
         $pid_for_hide = (int)$_POST['products_id'];
      } elseif (isset($_GET['products_id'])) {
         $pid_for_hide = (int)$_GET['products_id'];
      } elseif (isset($_GET['pid'])) {
         $pid_for_hide = (int)$_GET['pid'];
      } elseif (isset($_GET['notify']) && !is_array($_GET['notify'])) {
         $pid_for_hide = (int)$_GET['notify'];
         } elseif (isset($_POST['notify']) && !is_array($_POST['notify'])) {
            $pid_for_hide = (int)$_POST['notify'];
         }
     if (tep_not_null($pid_for_hide)) {
         $hide_product = tep_get_hide_status_single($customer_group_id, $pid_for_hide);
     } else {
         $hide_product = false;
     } // end if/else (tep_not_null($pid_for_hide))

      $temp_post_get_array = array();
      $hide_status_products = array();
      if (is_array($_POST['products_id']) && tep_not_null($_POST['products_id']) && tep_not_null($_POST['products_id'][0])) {
         $temp_post_get_array = $_POST['products_id'];
         $hide_status_products = tep_get_hide_status($hide_status_products, $customer_group_id, $temp_post_get_array);
      }
      if (is_array($_GET['products_id']) && tep_not_null($_GET['products_id']) && tep_not_null($_GET['products_id'][0])) {
         $temp_post_get_array = $_GET['products_id'];
         $hide_status_products = tep_get_hide_status($hide_status_products, $customer_group_id, $temp_post_get_array);
      }
      if (is_array($_POST['notify']) && tep_not_null($_POST['notify']) && tep_not_null($_POST['notify'][0])) {
         $temp_post_get_array = $_POST['notify'];
         $hide_status_products = tep_get_hide_status($hide_status_products, $customer_group_id, $temp_post_get_array);
      }
      if (is_array($_GET['notify']) && tep_not_null($_GET['notify']) && tep_not_null($_GET['notify'][0])) {
      $temp_post_get_array = $_GET['notify'];
         $hide_status_products = tep_get_hide_status($hide_status_products, $customer_group_id, $temp_post_get_array);
     }

    if (!$hide_product) { // product does not need to be hidden from the customer group
// EOF Separate Pricing Per Customer v4.2.x, Hide products from groups mod

    if (DISPLAY_CART == 'true') {
      $goto =  FILENAME_SHOPPING_CART;
// LINE MOD: Ultimate SEO URLs v2.1 removed 'cName', 'pName'
     $parameters = array('action', 'cPath', 'products_id', 'pid');
    } else {
      $goto = basename($PHP_SELF);
      if ($_GET['action'] == 'buy_now') {
// LINE MOD: Ultimate SEO URLs v2.1 removed 'pName'
        $parameters = array('action', 'pid', 'products_id');
      } else {
        $parameters = array('action', 'pid');
      }
    }
    switch ($_GET['action']) {
      // customer wants to update the product quantity in their shopping cart
      case 'update_product' : for ($i=0, $n=sizeof($_POST['products_id']); $i<$n; $i++) {
        if (in_array($_POST['products_id'][$i], (is_array($_POST['cart_delete']) ? $_POST['cart_delete'] : array()))) {
          $cart->remove($_POST['products_id'][$i]);
          } else {
            $attributes = ($_POST['id'][$_POST['products_id'][$i]]) ? $_POST['id'][$_POST['products_id'][$i]] : '';
//          $cart->add_cart($_POST['products_id'][$i], $_POST['cart_quantity'][$i], $attributes, false);
// BOF SPPC, Hide products and categories from groups
                                  foreach($hide_status_products as $key => $subarray) {
                                    if ($subarray['products_id'] == tep_get_prid($_POST['products_id'][$i]) && $subarray['hidden'] == '0') {
                                  $cart->add_cart($_POST['products_id'][$i], $_POST['cart_quantity'][$i], $attributes, false);
                                  }
                                  } // end foreach($hide_status_products as $key => $subarray)
// EOF SPPC, Hide products and categories from groups
        }
      }
      tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
      break;
// customer adds a product from the products page
// BOF: MOD - QT Pro
//    case 'add_product' :    if (isset($_POST['products_id']) && is_numeric($_POST['products_id'])) {
//                              $cart->add_cart($_POST['products_id'], $cart->get_quantity(tep_get_uprid($_POST['products_id'], $_POST['id']))+1, $_POST['id']);
      case 'add_product' :    if (isset($_POST['products_id']) && is_numeric($_POST['products_id']) && ($_POST['products_id']==(int)$_POST['products_id'])) {
        $attributes=array();
        if (isset($_POST['attrcomb']) && (preg_match("/^\d{1,10}-\d{1,10}(,\d{1,10}-\d{1,10})*$/",$_POST['attrcomb']))) {
          $attrlist=explode(',',$_POST['attrcomb']);
          foreach ($attrlist as $attr) {
            list($oid, $oval)=explode('-',$attr);
            if (is_numeric($oid) && $oid==(int)$oid && is_numeric($oval) && $oval==(int)$oval)
              $attributes[$oid]=$oval;
          }
        }
        if (isset($_POST['id']) && is_array($_POST['id'])) {
          foreach ($_POST['id'] as $key=>$val) {
            if (is_numeric($key) && $key==(int)$key && is_numeric($val) && $val==(int)$val)
              $attributes=$attributes + $_POST['id'];
          }
        }
        $cart->add_cart($_POST['products_id'], $cart->get_quantity(tep_get_uprid($_POST['products_id'], $attributes))+$_POST['cart_quantity'], $attributes);
// EOF: MOD - QT Pro
                    }
        tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
        break;
// performed by the 'buy now' button in product listings and review page
      case 'buy_now' :        if (isset($_GET['products_id'])) {

            if (tep_has_product_attributes($_GET['products_id'])) {
              tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id']));
            } else {
              $cart->add_cart($_GET['products_id'], $cart->get_quantity($_GET['products_id'])+1);
            }
          }
            tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
          break;

      case 'notify' : if (tep_session_is_registered('customer_id')) {
                      if (isset($_GET['products_id'])) {
                        $notify = $_GET['products_id'];
                      } elseif (isset($_GET['notify'])) {
                        $notify = $_GET['notify'];
                      } elseif (isset($_POST['notify'])) {
                        $notify = $_POST['notify'];
                      } else {
                        tep_redirect(tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action', 'notify'))));
                      }
                      if (!is_array($notify)) $notify = array($notify);
                      for ($i=0, $n=sizeof($notify); $i<$n; $i++) {
                        $check_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $notify[$i] . "' and customers_id = '" . $customer_id . "'");
                        $check = tep_db_fetch_array($check_query);
//                        if ($check['count'] < 1) {
//                          tep_db_query("insert into " . TABLE_PRODUCTS_NOTIFICATIONS . " (products_id, customers_id, date_added) values ('" . $notify[$i] . "', '" . $customer_id . "', now())");
//                        }
// BOF SPPC, Hide products and categories from groups
      if (is_array($hide_status_products) && tep_not_null($hide_status_products)) {
                                  foreach($hide_status_products as $key => $subarray) {
                                    if ($subarray['products_id'] == tep_get_prid($notify[$i]) && $subarray['hidden'] == '0') {
                                      if ($check['count'] < 1) {
                                        tep_db_query("insert into " . TABLE_PRODUCTS_NOTIFICATIONS . " (products_id, customers_id, date_added) values ('" . $notify[$i] . "', '" . $customer_id . "', now())");
                                      }
                                    } // end if ($subarray['products_id'] == tep_get_prid($notify[$i])...
                                  } // end foreach ($hide_status_products as $key => $subarray)
      } else {
                                    if ($check['count'] < 1) {
                                      tep_db_query("insert into " . TABLE_PRODUCTS_NOTIFICATIONS . " (products_id, customers_id, date_added) values ('" . $notify[$i] . "', '" . $customer_id . "', now())");
                                    }
      }
// EOF SPPC, Hide products and categories from groups
                      }
                      tep_redirect(tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action', 'notify'))));
                    } else {
                      $navigation->set_snapshot();
                      tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
                    }
                    break;
      case 'notify_remove' :  if (tep_session_is_registered('customer_id') && isset($_GET['products_id'])) {
                                $check_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $_GET['products_id'] . "' and customers_id = '" . $customer_id . "'");
                                $check = tep_db_fetch_array($check_query);
                                if ($check['count'] > 0) {
                                  tep_db_query("delete from " . TABLE_PRODUCTS_NOTIFICATIONS . " where products_id = '" . $_GET['products_id'] . "' and customers_id = '" . $customer_id . "'");
                                }
                                tep_redirect(tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('action'))));
                              } else {
                                $navigation->set_snapshot();
                                tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
                              }
                              break;
      case 'cust_order' :     if (tep_session_is_registered('customer_id') && isset($_GET['pid'])) {
                                if (tep_has_product_attributes($_GET['pid'])) {
                                  tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['pid']));
                                } else {
                                  $cart->add_cart($_GET['pid'], $cart->get_quantity($_GET['pid'])+1);
                                }
                              }
                              tep_redirect(tep_href_link($goto, tep_get_all_get_params($parameters)));
                              break;
	  case 'remove_product' : if (isset($_GET['products_id'])) {
	               	            $cart->remove($_GET['products_id']);
        	                  }
                            tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
            	              break;
	  case 'clear_cart' :     $cart->reset(true);
                              break;
	  case 'remove_wishlist_product' :    if (isset($_GET['wishlist_id'])) {
	               	                      $wishList->remove($_GET['wishlist_id']);
        	                              }
            	                          break;

	  case 'clear_wishlist' : $wishList->reset(true);
                              break;

//                            } // end switch $_GET['action']
//                           } // end if is set $_GET['action']
//
//
// // include the who's online functions
    } // end switch
// BOF Separate Pricing Per Customer v4.2.x, Hide products from groups mod
    } else { // $hide_product is true
       tep_redirect(tep_href_link(FILENAME_DEFAULT));
    }
// EOF Separate Pricing Per Customer v4.2.x, Hide products from groups mod
  } // if (isset($_GET['action']))

// include the who's online functions
  require(DIR_WS_FUNCTIONS . 'whos_online.php');
  tep_update_whos_online();

// include the password crypto functions
  require(DIR_WS_FUNCTIONS . 'password_funcs.php');

// include validation functions (right now only email address)
  require(DIR_WS_FUNCTIONS . 'validations.php');

// split-page-results
  require(DIR_WS_CLASSES . 'split_page_results.php');

// infobox
  require(DIR_WS_CLASSES . 'boxes.php');

// auto activate and expire banners
  require(DIR_WS_FUNCTIONS . 'banner.php');
  tep_activate_banners();
  tep_expire_banners();

// auto expire special products
  require(DIR_WS_FUNCTIONS . 'specials.php');
  tep_expire_specials();

// BOF Open Featured Sets
  require(DIR_WS_FUNCTIONS . 'featured_sets.php');
  if (SUSPEND_FEATURED_SETS_EXPIRING=='false') {
    // auto expire featured products
    tep_expire_featured();
    // auto expire featured manufacturers
    tep_expire_featured_manufacturers();
    // auto expire featured manufacturer
    tep_expire_featured_manufacturer();
    // auto expire featured categories
    tep_expire_featured_categories();
  }
// EOF Open Featured Sets

// calculate category path
  if (isset($_GET['cPath'])) {
    $cPath = $_GET['cPath'];
  } elseif (isset($_GET['products_id']) && !isset($_GET['manufacturers_id'])) {
    $cPath = tep_get_product_path($_GET['products_id']);
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

// include the breadcrumb class and start the breadcrumb trail
  require(DIR_WS_CLASSES . 'breadcrumb.php');
  $breadcrumb = new breadcrumb;

  $breadcrumb->add(HEADER_TITLE_TOP, HTTP_SERVER);
  $breadcrumb->add(HEADER_TITLE_CATALOG, tep_href_link(FILENAME_DEFAULT));

// add category names or the manufacturer name to the breadcrumb trail
//   if (isset($cPath_array)) {
//     for ($i=0, $n=sizeof($cPath_array); $i<$n; $i++) {
//       $categories_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$cPath_array[$i] . "' and language_id = '" . (int)$languages_id . "'");
// add category names or the manufacturer name to the breadcrumb trail
// BOF SPPC Hide products and categories from groups
  if (isset($cPath_array)) {
    for ($i=0, $n=sizeof($cPath_array); $i<$n; $i++) {
      $categories_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " cd left join " . TABLE_CATEGORIES . " c using(categories_id) where cd.categories_id = '" . (int)$cPath_array[$i] . "' and language_id = '" . (int)$languages_id . "' and find_in_set('" . $customer_group_id . "', categories_hide_from_groups) = 0");
// EOF SPPC Hide products and categories from groups

      if (tep_db_num_rows($categories_query) > 0) {
        $categories = tep_db_fetch_array($categories_query);
        $breadcrumb->add($categories['categories_name'], tep_href_link(FILENAME_DEFAULT, 'cPath=' . implode('_', array_slice($cPath_array, 0, ($i+1)))));
      } else {
        break;
      }
    }
  } elseif (isset($_GET['manufacturers_id'])) {
    $manufacturers_query = tep_db_query("select manufacturers_name from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'");
    if (tep_db_num_rows($manufacturers_query)) {
      $manufacturers = tep_db_fetch_array($manufacturers_query);
      $breadcrumb->add($manufacturers['manufacturers_name'], tep_href_link(FILENAME_DEFAULT, 'manufacturers_id=' . $_GET['manufacturers_id']));
    }
  }

// add the products model to the breadcrumb trail
  if ((isset($_GET['products_id'])) && (BREADCRUMB_SHOW_PRODUCT_MODEL == 'True')) {
//    $model_query = tep_db_query("select products_model from " . TABLE_PRODUCTS . " where products_id = '" . (int)$_GET['products_id'] . "'");
// BOF SPPC Hide products and categories from groups
    $model_query = tep_db_query("select p.products_model from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c using(products_id) left join " . TABLE_CATEGORIES . " c using(categories_id) where p.products_id = '" . (int)$_GET['products_id'] . "' and find_in_set('".$customer_group_id."', products_hide_from_groups) = 0 and find_in_set('" . $customer_group_id . "', categories_hide_from_groups) = 0");
// EOF SPPC Hide products and categories from groups


    if (tep_db_num_rows($model_query)) {
      $model = tep_db_fetch_array($model_query);
      $breadcrumb->add($model['products_model'], tep_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . $cPath . '&products_id=' . $_GET['products_id']));
    }
  }

// BOF: MOD - articles functions
  require(DIR_WS_FUNCTIONS . 'articles.php');
  require(DIR_WS_FUNCTIONS . 'article_header_tags.php');

// calculate topic path
  if (isset($_GET['tPath'])) {
    $tPath = $_GET['tPath'];
  } elseif (isset($_GET['articles_id']) && !isset($_GET['authors_id'])) {
    $tPath = tep_get_article_path($_GET['articles_id']);
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

// add topic names or the author name to the breadcrumb trail
  if (isset($tPath_array)) {
	$breadcrumb->add(BOX_HEADING_ARTICLES, tep_href_link(FILENAME_ARTICLES, '', 'NONSSL'));
    for ($i=0, $n=sizeof($tPath_array); $i<$n; $i++) {
      $topics_query = tep_db_query("select topics_name from " . TABLE_TOPICS_DESCRIPTION . " where topics_id = '" . (int)$tPath_array[$i] . "' and language_id = '" . (int)$languages_id . "'");
      if (tep_db_num_rows($topics_query) > 0) {
        $topics = tep_db_fetch_array($topics_query);
        $breadcrumb->add($topics['topics_name'], tep_href_link(FILENAME_ARTICLES, 'tPath=' . implode('_', array_slice($tPath_array, 0, ($i+1)))));
      } else {
        break;
      }
    }
  } elseif (isset($_GET['authors_id'])) {
    $authors_query = tep_db_query("select authors_name from " . TABLE_AUTHORS . " where authors_id = '" . (int)$_GET['authors_id'] . "'");
    if (tep_db_num_rows($authors_query)) {
      $authors = tep_db_fetch_array($authors_query);
      $breadcrumb->add('Articles by ' . $authors['authors_name'], tep_href_link(FILENAME_ARTICLES, 'authors_id=' . $_GET['authors_id']));
    }
  }

// add the articles name to the breadcrumb trail
  if (isset($_GET['articles_id'])) {
    $article_query = tep_db_query("select articles_name from " . TABLE_ARTICLES_DESCRIPTION . " where articles_id = '" . (int)$_GET['articles_id'] . "'");
    if (tep_db_num_rows($article_query)) {
      $article = tep_db_fetch_array($article_query);
      if (isset($_GET['authors_id'])) {
        $breadcrumb->add($article['articles_name'], tep_href_link(FILENAME_ARTICLE_INFO, 'authors_id=' . $_GET['authors_id'] . '&articles_id=' . $_GET['articles_id']));
      } else {
        $breadcrumb->add($article['articles_name'], tep_href_link(FILENAME_ARTICLE_INFO, 'tPath=' . $tPath . '&articles_id=' . $_GET['articles_id']));
      }
    }
  }

// add only if Header Tags not already installed
  require(DIR_WS_FUNCTIONS . 'clean_html_comments.php');
// EOF: MOD - articles functions

// initialize the message stack for output messages
  require(DIR_WS_CLASSES . 'message_stack.php');
  $messageStack = new messageStack;

// set which precautions should be checked
  define('WARN_INSTALL_EXISTENCE', 'true');
  define('WARN_CONFIG_WRITEABLE', 'true');
  define('WARN_SESSION_DIRECTORY_NOT_WRITEABLE', 'true');
  define('WARN_SESSION_AUTO_START', 'true');
  define('WARN_DOWNLOAD_DIRECTORY_NOT_READABLE', 'true');
// LINE ADDED: MOD - OSC-AFFILIATE
  require(DIR_WS_INCLUDES . 'affiliate_application_top.php');
// LINE ADDED - MOD: CREDIT CLASS Gift Voucher Contribution
  require(DIR_WS_INCLUDES . 'add_ccgvdc_application_top.php');

// LINE ADDED: MOD - BTS
  require(DIR_WS_INCLUDES . 'configure_bts.php');
// BOF: MOD - NEW OSC tax class
  require('includes/classes/tax.php');
  $osC_Tax = new osC_Tax;
// EOF: MOD - NEW OSC tax class

// BOF: MOD - Page cache contribution - by Chemo
// Define the pages to be cached in the $cache_pages array
  $cache_pages = array('index.php', 'product_info.php');
  if (!tep_session_is_registered('customer_id') && ENABLE_PAGE_CACHE == 'true') {
// Start the output buffer for the shopping cart
    ob_start();
    require(DIR_WS_BOXES . 'shopping_cart.php');
    $cart_cache = ob_get_clean();
// End the output buffer for cart and save as $cart_cache string

// Loop through the $cache_pages array and start caching if found
    foreach ($cache_pages as $index => $page){
      if ( strpos($_SERVER['PHP_SELF'], $page) ){
        include_once(DIR_WS_CLASSES . 'page_cache.php');
        $page_cache = new page_cache($cart_cache);
        // The cache timelife is set globally
        // in the admin control panel settings
        // Example below overrides the setting to 60 minutes
        // Leave blank to use default setting
        // $page_cache->cache_this_page(60);
        $page_cache->cache_this_page();
      }
    }
  }
// PWA BOF
  if (tep_session_is_registered('customer_id') && tep_session_is_registered('customer_is_guest') && substr(basename($PHP_SELF),0,7)=='account') tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
// PWA EOF
?>
