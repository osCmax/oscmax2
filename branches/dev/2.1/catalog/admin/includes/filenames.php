<?php
/*
$Id: filenames.php 14 2006-07-28 17:42:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// define the filenames used in the project
  define('FILENAME_BACKUP', 'backup.php');
  define('FILENAME_BANNER_MANAGER', 'banner_manager.php');
  define('FILENAME_BANNER_STATISTICS', 'banner_statistics.php');
// LINE ADDED: MOD - BATCH PRINT CENTER
  define('FILENAME_BATCH_PRINT', 'batch_print.php');
  define('FILENAME_CACHE', 'cache.php');
  define('FILENAME_CATALOG_ACCOUNT_HISTORY_INFO', 'account_history_info.php');
  define('FILENAME_CATEGORIES', 'categories.php');
  define('FILENAME_CONFIGURATION', 'configuration.php');
  define('FILENAME_COUNTRIES', 'countries.php');
  define('FILENAME_CURRENCIES', 'currencies.php');
  define('FILENAME_CUSTOMERS', 'customers.php');
  define('FILENAME_DEFAULT', 'index.php');
  define('FILENAME_DEFINE_LANGUAGE', 'define_language.php');
  define('FILENAME_FILE_MANAGER', 'file_manager.php');
  define('FILENAME_GEO_ZONES', 'geo_zones.php');
  define('FILENAME_LANGUAGES', 'languages.php');
  define('FILENAME_MAIL', 'mail.php');
  define('FILENAME_MANUFACTURERS', 'manufacturers.php');
  define('FILENAME_MODULES', 'modules.php');
// LINE ADDED: MOD - attribute manager
  define('FILENAME_NEW_ATTRIBUTES', 'new_attributes.php');
  define('FILENAME_NEWSLETTERS', 'newsletters.php');
  define('FILENAME_ORDERS', 'orders.php');
  define('FILENAME_ORDERS_INVOICE', 'invoice.php');
  define('FILENAME_ORDERS_PACKINGSLIP', 'packingslip.php');
  define('FILENAME_ORDERS_STATUS', 'orders_status.php');
  define('FILENAME_PACKAGING', 'packaging.php');
  define('FILENAME_POPUP_IMAGE', 'popup_image.php');
  define('FILENAME_PRODUCTS_ATTRIBUTES', 'products_attributes.php');
  define('FILENAME_PRODUCTS_EXPECTED', 'products_expected.php');
  define('FILENAME_REVIEWS', 'reviews.php');
  define('FILENAME_SERVER_INFO', 'server_info.php');
  define('FILENAME_SHIPPING_MODULES', 'shipping_modules.php');
  define('FILENAME_SPECIALS', 'specials.php');
  define('FILENAME_STATS_CUSTOMERS', 'stats_customers.php');
  define('FILENAME_STATS_PRODUCTS_PURCHASED', 'stats_products_purchased.php');
  define('FILENAME_STATS_PRODUCTS_VIEWED', 'stats_products_viewed.php');
  define('FILENAME_TAX_CLASSES', 'tax_classes.php');
  define('FILENAME_TAX_RATES', 'tax_rates.php');
  define('FILENAME_WHOS_ONLINE', 'whos_online.php');
  define('FILENAME_ZONES', 'zones.php');

// LINE ADDED - PGM - QUICK LINKS
  define('FILENAME_QUICK_LINKS', 'quick_links.php');

// BOF: MOD - Create & Edit Order & customers
  define('FILENAME_CREATE_ACCOUNT', 'create_account.php');
  define('FILENAME_CREATE_ACCOUNT_PROCESS', 'create_account_process.php');
  define('FILENAME_CREATE_ACCOUNT_SUCCESS', 'create_account_success.php');
  define('FILENAME_CREATE_ORDER_PROCESS', 'create_order_process.php');
  define('FILENAME_CREATE_ORDER', 'create_order.php');
  define('FILENAME_ORDERS_EDIT', 'edit_orders.php');
  define('FILENAME_EDIT_ORDERS', 'edit_orders.php');
  define('FILENAME_ORDERS_EDIT_ADD_PRODUCT', 'edit_orders_add_product.php');
  define('FILENAME_ORDERS_EDIT_AJAX', 'edit_orders_ajax.php');
// EOF: MOD - Create & Edit Order & customers

// BOF: MOD - Admin w/access levels
  define('FILENAME_ADMIN_ACCOUNT', 'admin_account.php');
  define('FILENAME_ADMIN_FILES', 'admin_files.php');
  define('FILENAME_ADMIN_MEMBERS', 'admin_members.php');
  define('FILENAME_FORBIDDEN', 'forbidden.php');
  define('FILENAME_LOGIN', 'login.php');
  define('FILENAME_LOGOFF', 'logoff.php');
  define('FILENAME_PASSWORD_FORGOTTEN', 'password_forgotten.php');
// EOF: MOD - Admin w/access levels

// BOF: MOD - wysiwyg content & infobox pages
  define('FILENAME_DEFINE_MAINPAGE', 'define_mainpage.php');
  define('FILENAME_DEFINE_CONDITIONS', 'define_conditions.php');
  define('FILENAME_DEFINE_ABOUT_US','define_about_us.php');
  define('FILENAME_DEFINE_PRIVACY', 'define_privacy.php');
  define('FILENAME_DEFINE_SHIPPING', 'define_shipping.php');
  define('FILENAME_DEFINE_CONTACT_US','define_contact_us.php');
  define('FILENAME_DEFINE_MAINPAGE_CONTENT', 'mainpage.php');
  define('FILENAME_DEFINE_CONDITIONS_CONTENT', 'conditions_content.php');
  define('FILENAME_DEFINE_ABOUT_US_CONTENT','about_us_content.php');
  define('FILENAME_DEFINE_PRIVACY_CONTENT', 'privacy_content.php');
  define('FILENAME_DEFINE_SHIPPING_CONTENT', 'shipping_content.php');
  define('FILENAME_INFOBOX_CONFIGURATION', 'infobox_configuration.php');
  define('FILENAME_POPUP_INFOBOX_HELP', 'popup_infobox_help.php');
// EOF: MOD - wysiwyg content pages

// LINE ADDED - X-Sell
  define('FILENAME_XSELL_PRODUCTS', 'xsell.php'); // X-Sell

// LINE ADDED - EasyPopulate
  define('FILENAME_EASYPOPULATE', 'easypopulate.php');

// BOF: MOD - Articles
  define('FILENAME_ARTICLE_REVIEWS', 'article_reviews.php');
  define('FILENAME_ARTICLES', 'articles.php');
  define('FILENAME_ARTICLES_CONFIG', 'articles_config.php');
  define('FILENAME_ARTICLES_XSELL', 'articles_xsell.php');
  define('FILENAME_AUTHORS', 'authors.php');
//EOF: MOD - Articles

// LINE ADDED: MOD - Monthly Sales Reports
  define('FILENAME_STATS_MONTHLY_SALES', 'stats_monthly_sales.php');

// LINE ADDED
  define('FILENAME_RECOVER_CART_SALES', 'recover_cart_sales.php');
// LINE ADDED
  define('FILENAME_STATS_RECOVER_CART_SALES', 'stats_recover_cart_sales.php');
  define('FILENAME_CATALOG_PRODUCT_INFO', 'product_info.php');

// BOF: MOD - QT Pro
  define('FILENAME_STATS_LOW_STOCK_ATTRIB', 'stats_low_stock_attrib.php');
  define('FILENAME_STOCK', 'stock.php');
  define('FILENAME_QTPRODOCTOR', 'qtprodoctor.php');
// EOF: MOD - QT Pro
  define('FILENAME_STATS_ADMIN_LOGGING', 'stats_admin_logging.php');
  define('FILENAME_STATS_CUST_LOGGING', 'stats_cust_logging.php');

// LINE ADDED: Special Price per Customer 4.0
  define('FILENAME_CUSTOMERS_GROUPS', 'customers_groups.php');

// BOF: MOD - fedex
  define('FILENAME_TRACK_FEDEX', 'track_fedex.php');
  define('FILENAME_SHIP_FEDEX', 'ship_fedex.php');
  define('FILENAME_SHIPPING_MANIFEST', 'shipping_manifest.php');
// EOF: MOD - fedex

// LINE ADDED: CREDIT CLASS Gift Voucher Contribution
  define('FILENAME_STATS_CREDITS', 'stats_credits.php');
  
  define('FILENAME_UPS_BOXES_USED', 'ups_boxes_used.php');

// BOF: PHONE ORDER
  define('FILENAME_PHONE_ORDER', 'phone_order.php');
// EOF: PHONE ORDER

// BOF: EXPORT CUSTOMERS TO CSV
  define('FILENAME_CUSTOMERS_EXPORT', 'customer_export.php');
// EOF: EXPORT CUSTOMERS TO CSV

// BOF: Http Error Log
  define('FILENAME_STATS_HTTP_ERROR', 'stats_http_error.php');
// EOF: Http Error Log 

// BOF: Customers with purchases report
  define('FILENAME_STATS_REGISTER_CUSTOMER_NO_PURCHASE', 'stats_register_customer_no_purchase.php');
// EOF: Customers with purchases report

// BOF: Google SiteMap
  define('FILENAME_GOOGLE_SITEMAP', 'googlesitemap.php');
// EOF: Google SiteMap

// BOF: Feed Machine
 define('FILENAME_FEEDMACHINE', 'feedmachine_admin.php');
// EOF: Feed Machine
?>