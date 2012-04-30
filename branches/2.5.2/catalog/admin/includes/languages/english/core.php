<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// BOF: MOD - Admin w/levels
// header text in includes/header.php
define('HEADER_TITLE_ACCOUNT', 'My Account/Password');
define('HEADER_TITLE_LOGOFF', 'Logoff');

// Admin Account
define('BOX_HEADING_MY_ACCOUNT', 'My Account');

// configuration box text in includes/boxes/administrator.php
define('BOX_HEADING_ADMINISTRATOR', 'Administrator');
define('BOX_ADMINISTRATOR_MEMBERS', 'Admin Members');
define('BOX_ADMINISTRATOR_MEMBER', 'Members');
define('BOX_ADMINISTRATOR_BOXES', 'File Access');
define('BOX_ADMINISTRATOR_UPGRADE', 'Upgrade System');
define('BOX_ADMIN_GROUPS', 'Admin Groups');
define('BOX_MERCHANT_INFO', 'Merchant Application');
define('BOX_PAYPAL_INFO', 'Paypal Signup');

// Filename defines for Admin Group Permissions - when file permission needed but not menu item.
define('FILE_GC_DASHBOARD', '<b>Google Checkout Dashboard</b>');
define('FILE_COUPON_RESTRICT', '<b>Coupon Restrict</b>');
define('FILE_VALID_PRODUCTS', '<b>Valid Products</b>');
define('FILE_VALID_CATEGORIES', '<b>Valid Categories</b>');
define('FILE_LIST_PRODUCTS', '<b>List Products</b>');
define('FILE_LIST_CATEGORIES', '<b>List Categories</b>');
define('FILE_TREE_VIEW', '<b>Treeview</b>');
define('FILE_BANNER_STATISTICS', '<b>Banner Statistics File</b>');
define('FILE_STOCK', '<b>Product Stock File</b>');
define('FILE_NEW_ATTRIBUTES_CONFIG', '<b>Attributes Config Variables</b>'); 
define('FILE_COMMON_REPORTS', '<b>Reports File</b>');
define('FILE_FEDEX', '<b>Fedex File</b>');
define('FILE_AFFILIATE', '<b>Affiliate File</b>');
define('FILE_FEEDMACHINE', '<b>Feedmachine File</b>');
define('FILE_EASYPOPULATE', '</b>Easypopulate File</b>');
define('FILE_ATTRIBUTE', '<b>Attributes File</b>');
define('FILE_DISCOUNT_CATEGORIES', '<b>Discount Categories File</b>');
define('FILE_CREATE_ACCOUNT', '<b>Create Account File</b>');
define('FILE_ORDER', '<b>Order File</b>');
define('FILE_PAYPAL', '<b>PayPal File</b>');
define('FILE_INFORMATION', '<b>Information Pages File</b>');

// images
define('IMAGE_FILE_PERMISSION', 'File Permissions');
define('IMAGE_GROUPS', 'Groups List');
define('IMAGE_INSERT_FILE', 'Insert File');
define('IMAGE_MEMBERS', 'Members List');
define('IMAGE_NEW_GROUP', 'New Group');
define('IMAGE_NEW_MEMBER', 'New Member');
define('IMAGE_NEXT', 'Next');

// constants for use in tep_prev_next_display function
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> filenames)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> members)');
// EOF: MOD - Admin w/levels

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..

////
if (ENGLISH_SWITCH == 'UK') { // Use UK format for store

setlocale(LC_TIME, 'en_UK.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format dd/mm/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
}

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');

define('JS_STATE', '* The \'County\' entry must be selected.\n');
define('JS_DOB', '* The \'Date of Birth\' entry must be in the format: dd/mm/yyyy.\n');
define('JS_ZONE', '* The \'County\' entry must be selected from the list for this country.');
define('JS_POST_CODE', '* The \'Post Code\' entry must have at least ' . ENTRY_POSTCODE_MIN_LENGTH . ' characters.\n');

define('ENTRY_SUBURB', 'Address Line 2:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Post Code:');
define('ENTRY_POST_CODE_TEXT', '&nbsp;<span class="errorText">*</span>');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' chars</span>');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(eg. 21/05/1970)</span>');
define('ENTRY_DATE_OF_BIRTH_TEXT', '&nbsp;<span class="errorText">*</span>&nbsp;(eg. 21/05/1970)');
define('ENTRY_STATE', 'County:');
define('ENTRY_STATE_TEXT', '');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">required</span>');

////
} else { // Use US Format in Admin
////

setlocale(LC_TIME, 'en_US.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%m/%d/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'm/d/Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'm/d/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);
  }
}

// text for date of birth example
define('DOB_FORMAT_STRING', 'mm/dd/yyyy');

define('JS_STATE', '* The \'State\' entry must be selected.\n');
define('JS_DOB', '* The \'Date of Birth\' entry must be in the format: mm/dd/yyyy.\n');
define('JS_ZONE', '* The \'State\' entry must be selected from the list for this country.');
define('JS_POST_CODE', '* The \'Zip Code\' entry must have at least ' . ENTRY_POSTCODE_MIN_LENGTH . ' characters.\n');

define('ENTRY_SUBURB', 'Suburb:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Zip Code:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' chars</span>');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(eg. 05/21/1970)</span>');
define('ENTRY_DATE_OF_BIRTH_TEXT', '&nbsp;<small>(eg. 05/21/1970) <font color="#AABBDD">required</font></small>');
define('ENTRY_STATE', 'State:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">required</span>');

} //End Language if
////

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="en"');

// LINE ADDED: MOD -Separate Pricing per Customer
define('ENTRY_CUSTOMERS_GROUP_NAME', 'Customer Group:');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', PROJECT_VERSION);

// BOF: MOD - ORDER EDIT
// Create account & order
define('BOX_HEADING_MANUAL_ORDER', 'Manual Orders');
define('BOX_MANUAL_ORDER_CREATE_ACCOUNT', 'Create Account');
define('BOX_MANUAL_ORDER_CREATE_ORDER', 'Create Order');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Please Select');
define('PULL_DOWN_DEFAULT_DOTS', 'Please Select ... ');
define('PULL_DOWN_NA', 'N/A');
define('TYPE_BELOW', 'Type Below');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Admin');
define('HEADER_TITLE_SUPPORT_SITE', 'osCmax Forums');
define('HEADER_TITLE_ONLINE_CATALOG', 'Catalog');
define('HEADER_TITLE_ADMINISTRATION', 'Admin');
define('HEADER_TITLE_OSCDOX', 'osCmax User Manual');
define('HEADER_TITLE_AABOX', 'osCmax');

// text for gender
define('MALE', 'Male');
define('FEMALE', 'Female');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configuration');
define('BOX_CONFIGURATION_GENERAL_SETTINGS', 'General Settings');
define('BOX_CONFIGURATION_MYSTORE', 'My Store');
define('BOX_CONFIGURATION_LOGGING', 'Logging');
define('BOX_CONFIGURATION_CACHE', 'Cache');

// BOF: Added for super-friendly admin menu:
define('BOX_CONFIGURATION_MIN_VALUES', 'Minimum Values');
define('BOX_CONFIGURATION_MAX_VALUES', 'Maximum Values');
define('BOX_CONFIGURATION_IMAGES', 'Images');
define('BOX_CONFIGURATION_CUSTOMER_DETAILS', 'Customer Details');
define('BOX_CONFIGURATION_SHIPPING', 'Shipping / Packaging');
define('BOX_CONFIGURATION_PAGE_CACHE', 'Page Cache Settings');
define('BOX_CONFIGURATION_PRODUCT_SETTINGS', 'Product Settings');
define('BOX_CONFIGURATION_PRODUCT_LISTING', 'Product Listing');
define('BOX_CONFIGURATION_PRODUCT_INFO', 'Product Information');
define('BOX_CONFIGURATION_PRODUCT_PRICE_BREAKS', 'Product Price Breaks');
define('BOX_CONFIGURATION_EMAIL', 'Email Options');
define('BOX_CONFIGURATION_DOWNLOAD', 'Downloads');
define('BOX_CONFIGURATION_GZIP', 'GZip Compression');
define('BOX_CONFIGURATION_SESSIONS', 'Sessions');
define('BOX_CONFIGURATION_STOCK', 'Stock');
define('BOX_CONFIGURATION_MC', 'MailChimp Newsletters');
define('BOX_CONFIGURATION_WYSIWYG', 'CK Editor');
define('BOX_CONFIGURATION_TEMPLATES', 'Templates');
define('BOX_CONFIGURATION_TEMPLATE_SETUP', 'Template Setup');
define('BOX_CONFIGURATION_PAGE_MODULES', 'Page Modules');
define('BOX_CONFIGURATION_INFO_PAGES', 'Information Pages');
define('BOX_CONFIGURATION_WELCOME', 'Welcome Message');
define('BOX_CONFIGURATION_OFS', 'Open Featured Sets');
define('BOX_CONFIGURATION_AFFILIATE', 'Affiliate Program');
define('BOX_CONFIGURATION_ACCOUNTS', 'Accounts');
define('BOX_CONFIGURATION_MAINTENANCE', 'Site Maintenance');
define('BOX_CONFIGURATION_MOPICS', 'Dynamic MoPics');
define('BOX_CONFIGURATION_SLIMBOX', 'Slimbox');
define('BOX_CONFIGURATION_CLOUDZOOM', 'CloudZoom');
define('BOX_CONFIGURATION_PRINT', 'Printable Catalog');
define('BOX_CONFIGURATION_ARTICLES', 'Article Configuration');
define('BOX_CONFIGURATION_SEO', 'SEO URLs');
define('BOX_CONFIGURATION_SEO_URLS', 'SEO URLs');
define('BOX_CONFIGURATION_SEO_POPOUT', 'SEO Pop Out Menu');
define('BOX_CONFIGURATION_WISHLIST', 'Wish List Settings');
define('BOX_CONFIGURATION_EDITOR', 'Order Editor');
define('BOX_CONFIGURATION_SEO_VALIDATION', 'SEO URL Validation');
// EOF: Added for super-friendly admin menu:

define('BOX_CONFIGURATION_LOGGING_CACHE', 'Logging / Cache');
define('BOX_CONFIGURATION_USEFUL', 'Useful Links');
define('BOX_CONFIGURATION_OPC', 'One Page Checkout');
define('BOX_CONFIGURATION_CORNER_BANNERS', 'Corner Banners');
define('BOX_CONFIGURATION_CONTACT', 'Contact Us Form');
define('BOX_CONFIGURATION_RECAPTCHA', 'reCaptcha Form');
define('BOX_CONFIGURATION_NOTIFICATIONS', 'Notifications');
define('BOX_CONFIGURATION_SLIDESHOW', 'Slideshow');
define('BOX_CONFIGURATION_SLIDESHOW_SETTINGS', 'Slideshow Settings');
define('BOX_CONFIGURATION_ADDTHIS', 'AddThis');

define('BOX_CONFIGURATION_GOOGLE', 'Google');
define('BOX_CONFIGURATION_GOOGLE_ANALYTICS', 'Google Analytics');
define('BOX_CONFIGURATION_GOOGLE_SITEMAP', 'Google SiteMaps');
define('BOX_CONFIGURATION_GOOGLE_MAPS', 'Google Maps');


// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Modules');
define('BOX_MODULES_PAYMENT', 'Payment');
define('BOX_MODULES_SHIPPING', 'Shipping');
define('BOX_MODULES_ORDER_TOTAL', 'Order Total');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Catalog');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categories/Products');
// BOF QPBPP for SPPC
define('BOX_CATALOG_CATEGORIES_DISCOUNT_CATEGORIES', 'Discount Categories');
// EOF QPBPP for SPPC
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Products Attributes');
define('BOX_CATALOG_MANUFACTURERS', 'Manufacturers');
define('BOX_CATALOG_REVIEWS', 'Reviews');
define('BOX_CATALOG_SPECIALS', 'Specials');
define('BOX_CATALOG_SPECIALS_BY_CAT', 'Specials by category');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Products Expected');
// 2 LINES ADDED - EasyPopulate and Attrib Manager
define('BOX_CATALOG_EASYPOPULATE', 'EasyPopulate');
define('BOX_CATALOG_ATTRIBUTE_MANAGER', 'Attribute Manager');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Customers');
define('BOX_CUSTOMERS_CUSTOMERS', 'Customers');
define('BOX_CUSTOMERS_ORDERS', 'Orders');
// LINE ADDED - Edit customer order
define('BOX_CUSTOMERS_EDIT_ORDERS', 'Edit Orders');

// BOF: MOD - Separate Pricing Per Customer
define('BOX_CUSTOMERS_GROUPS', 'Customers Groups');
// EOF: MOD - Separate Pricing Per Customer
// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Locations / Taxes');
define('BOX_TAXES_COUNTRIES', 'Countries');
define('BOX_TAXES_ZONES', 'Zones');
define('BOX_TAXES_GEO_ZONES', 'Tax Zones');
define('BOX_TAXES_TAX_CLASSES', 'Tax Classes');
define('BOX_TAXES_TAX_RATES', 'Tax Rates');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Reports');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Products Viewed');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Products Purchased');
define('BOX_REPORTS_ORDERS_TOTAL', 'Customer Orders-Total');
define('BOX_REPORTS_CREDITS', 'Customer Credits Report');
//++++ QT Pro: Begin Changed code
define('BOX_REPORTS_STATS_LOW_STOCK_ATTRIB', 'Stock Report');
//++++ QT Pro: End Changed Code
define('BOX_REPORTS_ADMIN_LOGGING', 'Admin Log');
define('BOX_REPORTS_CUST_LOGGING', 'Customer Log');
define('BOX_REPORTS_HTTP_ERROR', 'Http Error Log');
define('BOX_REPORTS_WISHLIST', 'Customer Wishlists');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Tools');
define('BOX_TOOLS_BACKUP', 'Database Backup');
define('BOX_TOOLS_BANNER_MANAGER', 'Banner Manager');
// LINE ADDED: MOD - Batch Print Center
define('BOX_TOOLS_BATCH_CENTER', 'Batch Print Center');
define('BOX_TOOLS_CACHE', 'Cache Control');
define('BOX_TOOLS_QTPRODOCTOR', 'QTPro Doctor');
define('BOX_TOOLS_MAIL', 'Send Email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Newsletter Manager');
define('BOX_TOOLS_SERVER_INFO', 'Server Info');
define('BOX_TOOLS_WHOS_ONLINE', 'Who\'s Online');
define('BOX_TOOLS_PACKAGING', 'Packaging');
define('BOX_TOOLS_UPS_BOXES_USED', 'UPS boxes used');
define('BOX_TOOLS_QUICK_LINKS', 'Quick Links');
define('BOX_TOOLS_SLIDESHOW', 'Slideshow Images');
define('BOX_TOOLS_REGEN', 'Image Manager');
define('BOX_REPORTS_KEYWORDS', 'Search Keywords');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Localization');
define('BOX_LOCALIZATION_CURRENCIES', 'Currencies');
define('BOX_LOCALIZATION_LANGUAGES', 'Languages');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Orders Status');
define('BOX_PREMADE', 'Premade Comments');

// affiliates box text in includes/boxes/affiliate.php
define('BOX_MENU_AFFILIATES', 'Affiliates');

// vouchers box text in includes/boxes/gv_admin.php
define('BOX_HEADING_VOUCHERS', 'Vouchers');

// ADDED 2 LINE- recover cart box text
define('BOX_REPORTS_RECOVER_CART_SALES', 'Recovered Sales Results');
define('BOX_TOOLS_RECOVER_CART', 'Recover Cart Sales');

// LINE ADDED - Monthly Tax-Sales totals
define('BOX_REPORTS_MONTHLY_SALES', 'Monthly Sales/Tax');

// LINE ADDED - InfoBox Admin in includes/boxes/info_boxes.php
define('BOX_HEADING_BOXES', 'Infoboxes');

// javascript messages
define('JS_ERROR', 'Errors have occured during the process of your form!\nPlease make the following corrections:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* The new product atribute needs a price value\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* The new product atribute needs a price prefix\n');

define('JS_PRODUCTS_NAME', '* The new product needs a name\n');
define('JS_PRODUCTS_DESCRIPTION', '* The new product needs a description\n');
define('JS_PRODUCTS_PRICE', '* The new product needs a price value\n');
define('JS_PRODUCTS_WEIGHT', '* The new product needs a weight value\n');
define('JS_PRODUCTS_QUANTITY', '* The new product needs a quantity value\n');
define('JS_PRODUCTS_MODEL', '* The new product needs a model value\n');
define('JS_PRODUCTS_IMAGE', '* The new product needs an image value\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* A new price for this product needs to be set\n');

define('JS_GENDER', '* The \'Gender\' value must be chosen.\n');
define('JS_FIRST_NAME', '* The \'First Name\' entry must have at least ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters.\n');
define('JS_LAST_NAME', '* The \'Last Name\' entry must have at least ' . ENTRY_LAST_NAME_MIN_LENGTH . ' characters.\n');
define('JS_EMAIL_ADDRESS', '* The \'E-Mail Address\' entry must have at least ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' characters.\n');
define('JS_ADDRESS', '* The \'Street Address\' entry must have at least ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' characters.\n');
define('JS_CITY', '* The \'City\' entry must have at least ' . ENTRY_CITY_MIN_LENGTH . ' characters.\n');
define('JS_STATE_SELECT', '-- Select Above --');
define('JS_COUNTRY', '* The \'Country\' value must be chosen.\n');
define('JS_TELEPHONE', '* The \'Telephone Number\' entry must have at least ' . ENTRY_TELEPHONE_MIN_LENGTH . ' characters.\n');
define('JS_PASSWORD', '* The \'Password\' and \'Confirmation\' entries must match and have at least ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.\n');
define('JS_PASSWORD_DONT_MATCH', 'The entered passwords do not match');

define('JS_ORDER_DOES_NOT_EXIST', 'Order Number %s does not exist!');

define('CATEGORY_PERSONAL', 'Personal');
define('CATEGORY_ADDRESS', 'Address');
define('CATEGORY_CONTACT', 'Contact');
define('CATEGORY_COMPANY', 'Company');
define('CATEGORY_OPTIONS', 'Options');
define('CATEGORY_PASSWORD', 'Password');

define('ENTRY_GENDER', 'Gender:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">*</span>');
define('ENTRY_GENDER_TEXT', '&nbsp;&nbsp;<span class="errorText">*</span>');
define('ENTRY_FIRST_NAME', 'First Name:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' chars</span>');
define('ENTRY_FIRST_NAME_TEXT', '&nbsp;<span class="errorText">*</span>');
define('ENTRY_LAST_NAME', 'Last Name:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' chars</span>');
define('ENTRY_LAST_NAME_TEXT', '&nbsp;<span class="errorText">*</span>');
define('ENTRY_DATE_OF_BIRTH', 'Date of Birth:');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Address:');
define('ENTRY_EMAIL_ADDRESS_TEXT' ,'&nbsp;<span class="errorText">*</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' chars</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">The email address doesn\'t appear to be valid!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">This email address already exists!</span>');
define('ENTRY_COMPANY', 'Company name:');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_COMPANY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_COMPANY_MIN_LENGTH . ' chars</span>');
define('ENTRY_STREET_ADDRESS', 'Street Address:');
define('ENTRY_STREET_ADDRESS_TEXT', '&nbsp;<span class="errorText">*</span>');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' chars</span>');
define('ENTRY_CITY', 'City:');
define('ENTRY_CITY_TEXT', '&nbsp;<span class="errorText">*</span>');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' chars</span>');
define('ENTRY_COUNTRY', 'Country:');
define('ENTRY_COUNTRY_TEXT', '&nbsp;<span class="errorText">*</span>');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Telephone Number:');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '&nbsp;<span class="errorText">*</span>');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' chars</span>');
define('ENTRY_FAX_NUMBER', 'Fax Number:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_YES', 'Subscribed');
define('ENTRY_NEWSLETTER_NO', 'Unsubscribed');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Password:');
define('ENTRY_PASSWORD_CONFIRMATION', 'Password Confirmation:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '&nbsp;<span class="errorText">*</span>');
define('ENTRY_PASSWORD_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_PASSWORD_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_PASSWORD_TEXT', '&nbsp;<span class="errorText">*</span>');
define('PASSWORD_HIDDEN', '--HIDDEN--');
// EOF: MOD - ORDER EDIT


// BOF: MOD - Separate Pricing Per Customer
define('ENTRY_COMPANY_TAX_ID', 'Company\'s tax id number:');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
define('ENTRY_CUSTOMERS_GROUP_REQUEST_AUTHENTICATION', 'Switch off alert for authentication:');
define('ENTRY_CUSTOMERS_GROUP_RA_NO', 'Alert off');
define('ENTRY_CUSTOMERS_GROUP_RA_YES', 'Alert on');
define('ENTRY_CUSTOMERS_GROUP_RA_ERROR', '');
// EOF: MOD - Separate Pricing Per Customer



// images
define('IMAGE_ANI_SEND_EMAIL', 'Sending E-Mail');
define('IMAGE_BACK', 'Back');
define('IMAGE_BACKUP', 'Backup');
define('IMAGE_CANCEL', 'Cancel');
define('IMAGE_CONFIRM', 'Confirm');
define('IMAGE_COPY', 'Copy');
define('IMAGE_COPY_TO', 'Copy To');
define('IMAGE_DETAILS', 'Details');
define('IMAGE_DELETE', 'Delete');
define('IMAGE_EDIT', 'Edit');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_FILE_MANAGER', 'File Manager');
define('IMAGE_ICON_STATUS_GREEN', 'Active');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Set Active');
define('IMAGE_ICON_STATUS_RED', 'Inactive');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Set Inactive');
define('IMAGE_ICON_INFO', 'Info');
define('IMAGE_INSERT', 'Insert');
define('IMAGE_LOCK', 'Lock');
define('IMAGE_MODULE_INSTALL', 'Install Module');
define('IMAGE_MODULE_REMOVE', 'Remove Module');
define('IMAGE_MOVE', 'Move');
define('IMAGE_NEW_BANNER', 'New Banner');
define('IMAGE_NEW_CATEGORY', 'New Category');
define('IMAGE_NEW_COUNTRY', 'New Country');
define('IMAGE_NEW_CURRENCY', 'New Currency');
define('IMAGE_NEW_FILE', 'New File');
define('IMAGE_NEW_FOLDER', 'New Folder');
define('IMAGE_NEW_LANGUAGE', 'New Language');
define('IMAGE_NEW_NEWSLETTER', 'New Newsletter');
define('IMAGE_NEW_PRODUCT', 'New Product');
define('IMAGE_NEW_TAX_CLASS', 'New Tax Class');
define('IMAGE_NEW_TAX_RATE', 'New Tax Rate');
define('IMAGE_NEW_TAX_ZONE', 'New Tax Zone');
define('IMAGE_NEW_ZONE', 'New Zone');
define('IMAGE_ORDERS', 'Orders');
define('IMAGE_ORDERS_INVOICE', 'Invoice');
define('IMAGE_ORDERS_PACKINGSLIP', 'Packing Slip');
define('IMAGE_PREVIEW', 'Preview');
define('IMAGE_RESTORE', 'Restore');
define('IMAGE_RESET', 'Reset');
define('IMAGE_SAVE', 'Save');
define('IMAGE_SEARCH', 'Search');
define('IMAGE_SELECT', 'Select');
define('IMAGE_SEND', 'Send');
define('IMAGE_SEND_EMAIL', 'Send Email');
define('IMAGE_UNLOCK', 'Unlock');
define('IMAGE_UPDATE', 'Update');
define('IMAGE_UPDATE_CURRENCIES', 'Update Exchange Rate');
define('IMAGE_UPLOAD', 'Upload');
define('IMAGE_PREV_ORDER', 'Previous Order');
define('IMAGE_NEXT_ORDER', 'Next Order');
// BOF QPBPP for SPPC
define('IMAGE_SHOW_PRODUCTS', 'Show Products');
// EOF QPBPP for SPPC
// BOF Open Featured Sets
define('IMAGE_PICK_COLOR', 'Pick Color');
// EOF Open Featured Sets
define('IMAGE_SETTINGS', 'Settings');
define('IMAGE_SUMMARY', 'Summary');
define('IMAGE_BROWSE', 'Browse');
define('IMAGE_MISSING', 'Missing');
define('IMAGE_ORPHANS', 'Orphans');
define('IMAGE_REGENERATE', 'Regenerate');
define('IMAGE_REGENERATE_ALL', 'Regenerate all images for this product');
define('IMAGE_REGENERATE_EVERYTHING', 'Regenerate all your images');
define('IMAGE_MC_SYNC', 'Sync with MailChimp');
define('IMAGE_HELP', 'Help');
define('IMAGE_LOGOFF', 'Logoff');
define('IMAGE_MANAGE_ACCOUNT', 'Manage Account');
define('IMAGE_BUTTON_UNSUBSCRIBE', 'Unsubscribe');
define('IMAGE_BULK_SET_STATUS', 'Bulk Set Status');
define('IMAGE_ACTIVATE_ALL', 'Activate All');
define('IMAGE_DEACTIVATE_ALL', 'Deactivate All');

define('ICON_CROSS', 'False');
define('ICON_CURRENT_FOLDER', 'Current Folder');
define('ICON_DELETE', 'Delete');
define('ICON_ERROR', 'Error');
define('ICON_FILE', 'File');
define('ICON_FILE_DOWNLOAD', 'Download');
define('ICON_FOLDER', 'Folder');
define('ICON_LOCKED', 'Locked');
define('ICON_PREVIOUS_LEVEL', 'Previous Level');
define('ICON_PREVIEW', 'Preview');
define('ICON_STATISTICS', 'Statistics');
define('ICON_SUCCESS', 'Success');
define('ICON_TICK', 'True');
define('ICON_UNLOCKED', 'Unlocked');
define('ICON_WARNING', 'Warning');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Page %s of %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> banners)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> countries)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> customers)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> currencies)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> languages)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> manufacturers)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> newsletters)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> orders)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> orders status)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products expected)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> product reviews)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products on special)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> tax classes)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> tax zones)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> tax rates)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> zones)');
define('TEXT_DISPLAY_NUMBER_OF_SHIPMENTS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> shipments)');
define('TEXT_DISPLAY_NUMBER_OF_QUICK_LINKS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> quick links)');
define('TEXT_DISPLAY_NUMBER_OF_PM_CONFIGURATION', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> modules)');
define('TEXT_DISPLAY_NUMBER_OF_SLIDESHOW', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> slides)');
define('TEXT_DISPLAY_NUMBER_OF_IMAGES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> images)');

//BOF: MOD - Catagories Discriptions
define('TEXT_EDIT_CATEGORIES_HEADING_TITLE', 'Category Heading Title:');
define('TEXT_EDIT_CATEGORIES_DESCRIPTION', 'Category Description:');
//EOF: MOD - Catagories Discriptions

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'default');
define('TEXT_SET_DEFAULT', 'Set as default');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Required</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Error: There is currently no default currency set. Please set one at: Administration Tool->Localization->Currencies');

define('TEXT_CACHE_CATEGORIES', 'Categories Box');
define('TEXT_CACHE_MANUFACTURERS', 'Manufacturers Box');
define('TEXT_CACHE_ALSO_PURCHASED', 'Also Purchased Module');

define('TEXT_NONE', 'None');
define('TEXT_TOP', 'Top');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Error: Destination does not exist.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Error: Destination not writeable.');
define('ERROR_FILE_NOT_SAVED', 'Error: File upload not saved.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Error: File upload type not allowed.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Success: File upload saved successfully.');
define('WARNING_NO_FILE_UPLOADED', 'Warning: No file uploaded.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Warning: File uploads are disabled in the php.ini configuration file.');

// LINE ADDED - XSell
define('BOX_CATALOG_XSELL_PRODUCTS', 'Cross Sell Products'); // X-Sell

// BOF: MOD - Article Manager
define('BOX_MENU_ARTICLES', 'Articles');
define('BOX_TOPICS_ARTICLES', 'Topics/Articles');
define('BOX_ARTICLES_CONFIG', 'Article Configuration');
define('BOX_ARTICLES_AUTHORS', 'Authors');
define('BOX_ARTICLES_REVIEWS', 'Reviews');
define('BOX_ARTICLES_XSELL', 'Cross-Sell Articles');
define('IMAGE_NEW_TOPIC', 'New Topic');
define('IMAGE_NEW_ARTICLE', 'New Article');
define('TEXT_DISPLAY_NUMBER_OF_AUTHORS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> authors)');
// EOF: MOD - Article Manager

// BOF: MOD - FedEx
define('IMAGE_ORDERS_SHIP', 'Ship Package');
define('IMAGE_ORDERS_FEDEX_LABEL','View or Print FedEx Shipping Label');
define('IMAGE_ORDERS_TRACK','Track FedEx Shipment');
define('IMAGE_ORDERS_CANCEL_SHIPMENT','Cancel FedEx Shipment');
define('BOX_SHIPPING_MANIFEST','FedEx Shipping Manifest');
// EOF: MOD - FedEx

// BOF: PHONE ORDER
define('BOX_PHONE_ORDER', 'Phone Order');
// EOF: PHONE ORDER

// BOF: EXPORT CUSTOMERS TO CSV
define('BOX_CUSTOMERS_EXPORT', 'Export Customers');
// EOF: EXPORT CUSTOMERS TO CSV

// BOF: Customers with purchases report
define('BOX_REPORTS_STATS_REGISTER_CUSTOMER_NO_PURCHASE', 'No purchases report');
// EOF: Customers with purchases report

// BOF: Quicker Product Edit
define('IMAGE_ICON_EDIT', 'Quick Edit');
// EOF: Quicker Product Edit

// BOF: Feed Machine
define('BOX_CATALOG_FEEDMACHINE', 'Feedmachine');
// EOF: Feed Machine

// BOF: Extra Product Fields
define('TEXT_NOT_APPLY', 'Does Not Apply');
define('BOX_CATALOG_PRODUCTS_EXTRA_FIELDS', 'Extra Product Fields');
define('BOX_CATALOG_PRODUCTS_EXTRA_VALUES', 'Extra Field Values');
// EOF: Extra Product Fields

// BOF: MSRP
define('TEXT_PRODUCTS_MSRP', '&nbsp;MSRP:&nbsp;');
define('TEXT_PRODUCTS_OUR_PRICE', '&nbsp;Our&nbsp;Price:&nbsp;');
define('TEXT_PRODUCTS_SALE', '&nbsp;Sale&nbsp;Price:&nbsp;');
define('TEXT_PRODUCTS_SAVINGS', '&nbsp;You&nbsp;Save:&nbsp;');
define('TEXT_PRODUCTS_PRICE_MSRP', 'Products MSRP:');
// EOF: MSRP

define('TEXT_YYYY_MM_DD', '(YYYY-MM-DD)');

define('TEXT_RATING', 'Rating: ');
define('TEXT_POOR', 'Poor');
define('TEXT_FAIR', 'Fair');
define('TEXT_AVERAGE', 'Average');
define('TEXT_GOOD', 'Good');
define('TEXT_EXCELLENT', 'Excellent');

define('BOX_HEADING_SECURITY', 'Security');
define('TEXT_PRODUCTS', 'Products');
define('TEXT_SEARCH', 'Search: ');
define('TEXT_WELCOME', ' Welcome, ');

define('TEXT_WRONG_PASSWORD', 'Wrong Password');
define('TEXT_WRONG_USERNAME', 'Wrong Username');
define('TEXT_LOGGED_IN', 'Logged In');
define('TEXT_LOGGED_OUT', 'Logged Out');
define('TEXT_CONFIG_CHANGE', 'Config Change: ');
define('TEXT_ADMIN_AS_CUSTOMER', 'Admin as Customer');
define('TEXT_ADMIN_HACK_ATTEMPT', 'Hack Attempt');

// Footer defines
define('TEXT_POWERED_BY', 'Powered by ');
define('TEXT_SECURITY', 'Security: ');
define('TEXT_REPORT_BUGS', 'Report Bugs');
define('TEXT_FORUM', 'Forum');
define('TEXT_WIKI', 'Wiki Help Documents');
define('TEXT_COPYRIGHT', 'Copyright');

define('ERROR_CACHE_DIRECTORY_DOES_NOT_EXIST', 'Error: Cache directory does not exist. Please set this Administrator -> Cache.');
define('ERROR_CACHE_DIRECTORY_NOT_WRITEABLE', 'Error: Cache directory is not writeable.');
?>