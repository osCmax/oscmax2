<?php
/*
  $Id: whos_online.php,v 3.5.4 2008/7/8 SteveDallas Exp $
  
  2008 Jul 08 v3.5.4 Glen Hoag aka SteveDallas Modified TEXT_NUMBER_OF_CUSTOMERS for formatting change
  2008 Jun 13 v3.5   Glen Hoag aka SteveDallas Moved version number out of language files
                                               Added string TEXT_ACTIVE_CUSTOMERS
                                               Added string TEXT_SHOW_BOTS

  updated version number because of version number jumble and provide installation instructions.
  corection french by azer
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

// added for version 1.9 - to be translated to the right language BOF ******
define('AZER_WHOSONLINE_WHOIS_URL', 'http://www.dnsstuff.com/tools/whois.ch?ip='); //for version 2.9 by azer - whois ip
define('TEXT_NOT_AVAILABLE', '   <b>Note:</b> N/A = IP non available'); //for version 2.9 by azer was missing
define('TEXT_LAST_REFRESH', 'Last refresh at'); //for version 2.9 by azer was missing
define('TEXT_EMPTY', 'Empty'); //for version 2.8 by azer was missing
define('TEXT_MY_IP_ADDRESS', 'My IP adresss '); //for version 2.8 by azer was missing
define('TABLE_HEADING_COUNTRY', 'Country'); // azerc : 25oct05 for contrib whos_online with country and flag
// added for version 1.9 EOF *************************************************

define('HEADING_TITLE', 'Who\'s Online');  // Version update to 3.2 because of multiple 1.x and 2.x jumble.  apr-07 by nerbonne
define('TABLE_HEADING_ONLINE', 'Online');
define('TABLE_HEADING_CUSTOMER_ID', 'ID');
define('TABLE_HEADING_FULL_NAME', 'Name');
define('TABLE_HEADING_IP_ADDRESS', 'IP address');
define('TABLE_HEADING_ENTRY_TIME', 'Entry');
define('TABLE_HEADING_LAST_CLICK', 'Last click');
define('TABLE_HEADING_LAST_PAGE_URL', 'Last URL');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_SHOPPING_CART', 'Shopping cart');
define('TEXT_SHOPPING_CART_SUBTOTAL', 'Subtotal');
define('TEXT_NUMBER_OF_CUSTOMER', 'Visitors online (Considered inactive after 5 minutes. Removed after 15 minutes)');
define('TEXT_NUMBER_OF_CUSTOMERS', 'Visitors online (Considered inactive after 5 minutes. Removed after 15 minutes)');
define('TABLE_HEADING_HTTP_REFERER', 'Referer?');
define('TEXT_HTTP_REFERER_URL', 'HTTP Referer URL');
define('TEXT_HTTP_REFERER_FOUND', 'Yes');
define('TEXT_HTTP_REFERER_NOT_FOUND', 'Not found');
define('TEXT_STATUS_ACTIVE_CART', 'Active with cart');
define('TEXT_STATUS_ACTIVE_NOCART', 'Active with no cart');
define('TEXT_STATUS_INACTIVE_CART', 'Inactive with cart');
define('TEXT_STATUS_INACTIVE_NOCART', 'Inactive with no cart');
define('TEXT_STATUS_NO_SESSION_BOT', 'Inactive bot with no session?'); //Azer !!! check if right description
define('TEXT_STATUS_INACTIVE_BOT', 'Inactive bot with session '); //Azer !!! check if right description
define('TEXT_STATUS_ACTIVE_BOT', 'Active bot with session '); //Azer !!! check if right description
define('TABLE_HEADING_COUNTRY', 'Country');
define('TABLE_HEADING_USER_SESSION', 'Session?');
define('TEXT_IN_SESSION', 'Yes');
define('TEXT_NO_SESSION', 'No');

define('TEXT_OSCID', 'osCsid');
define('TEXT_PROFILE_DISPLAY', 'Profile display');
define('TEXT_USER_AGENT', 'User agent');
define('TEXT_ERROR', 'Error!');
define('TEXT_ADMIN', 'Admin');
define('TEXT_DUPLICATE_IP', 'Duplicate IP');
define('TEXT_DUPLICATE_IPS', 'Duplicate IPs');
define('TEXT_BOT', 'Bot');
define('TEXT_BOTS', 'Bots');
define('TEXT_ME', 'Myself!');
define('TEXT_ALL', 'All');
define('TEXT_REAL_CUSTOMER', 'Real customer');
define('TEXT_REAL_CUSTOMERS', 'Real customers');
define('TEXT_ACTIVE_CUSTOMER', ' is active.');
define('TEXT_ACTIVE_CUSTOMERS', ' are active.');

define('TEXT_YOUR_IP_ADDRESS', 'Your IP address');
define('TEXT_SET_REFRESH_RATE', 'Refresh rate');
define('TEXT_NONE_', 'None');
define('TEXT_CUSTOMERS', 'Customers');
define('TEXT_SHOW_BOTS', 'Show bots');
define('TEXT_SHOW_MAP', 'Show map');
define('TEXT_COUNTRY', 'Country');
define('TEXT_REGION', 'Region');
define('TEXT_CITY', 'City');
?>
