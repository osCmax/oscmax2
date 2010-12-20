<?php
/*
$Id: customers.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Customers');
define('HEADING_TITLE_SEARCH', 'Search:');

define('TABLE_HEADING_FIRSTNAME', 'First Name');
define('TABLE_HEADING_LASTNAME', 'Last Name');
// BOF: MOD - Separate Pricing Per Customer
define('TABLE_HEADING_CUSTOMERS_GROUPS', 'Customer&#160;Group');
define('TABLE_HEADING_REQUEST_AUTHENTICATION', 'RA');
define('ENTRY_CUSTOMERS_PAYMENT_SET', 'Set payment modules for the customer');
define('ENTRY_CUSTOMERS_PAYMENT_DEFAULT', 'Use settings from Group or Configuration');
define('ENTRY_CUSTOMERS_PAYMENT_SET_EXPLAIN', 'If you choose <b><i>Set payment modules for the customer</i></b> but do not check any of the boxes, default settings (Group settings or Configuration) will still be used.');
define('ENTRY_CUSTOMERS_SHIPPING_SET', 'Set shipping modules for the customer');
define('ENTRY_CUSTOMERS_SHIPPING_DEFAULT', 'Use settings from Group or Configuration');
define('ENTRY_CUSTOMERS_SHIPPING_SET_EXPLAIN', 'If you choose <b><i>Set shipping modules for the customer</i></b> but do not check any of the boxes, default settings (Group settings or Configuration) will still be used.');
// EOF: MOD - Separate Pricing Per Customer
define('TABLE_HEADING_ACCOUNT_CREATED', 'Account Created');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_DATE_ACCOUNT_CREATED', 'Account Created:');
define('TEXT_DATE_ACCOUNT_LAST_MODIFIED', 'Last Modified:');
define('TEXT_INFO_DATE_LAST_LOGON', 'Last Logon:');
define('TEXT_INFO_NUMBER_OF_LOGONS', 'Number of Logons:');
define('TEXT_INFO_COUNTRY', 'Country:');
define('TEXT_INFO_NUMBER_OF_REVIEWS', 'Number of Reviews:');
define('TEXT_DELETE_INTRO', 'Are you sure you want to delete this customer?');
define('TEXT_DELETE_REVIEWS', 'Delete %s review(s)');
define('TEXT_INFO_HEADING_DELETE_CUSTOMER', 'Delete Customer');
define('PLEASE_SELECT', 'Select One');

define('IMAGE_BUTTON_ADD_COMMENT', 'Add Comment');
define('TEXT_COMMENTS', 'Comments');
define('TEXT_ADD_A_COMMENT', 'Add a comment:');
define('TEXT_NOTES', 'Notes:');
define('TEXT_AUTHOR', 'Author:');
?>
