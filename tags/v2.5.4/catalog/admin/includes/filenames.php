<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

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
  define('FILENAME_SPECIALS_BY_CAT', 'specialsbycategory.php');
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
  define('FILENAME_KEYWORDS', 'stats_keywords.php');

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

// BOF QPBPP for SPPC v4.2 2008/03/07, QPBPP for SPPC v2.0 2008/09/05
  define('FILENAME_DISCOUNT_CATEGORIES', 'discount_categories.php');
  define('FILENAME_DISCOUNT_CATEGORIES_GROUPS_PP', 'discount_categories_groups_pp.php');
// BOF QPBPP for SPPC

// BOF: Canned Comments
define('FILENAME_PREMADE', 'premade_comments.php');
// EOF: Canned Comments

//BOF: Page Modules
define('FILENAME_PM_CONFIGURATION', 'page_modules_configuration.php');
//EOF: Page Modules

//BOF: Wishlist Report
define('FILENAME_STATS_WISHLIST', 'stats_wishlist.php');
//EOF: Wishlist Report

//BOF: Slideshow
define('FILENAME_SLIDESHOW', 'slideshow.php');
//EOF: Slideshow

//BOF: Extra Product Fields
define('FILENAME_EXTRA_FIELDS', 'extra_fields.php');
define('FILENAME_EXTRA_VALUES', 'extra_values.php');
//EOF: Extra Product Fields

define('FILENAME_IMAGES_REGEN', 'images_regen.php');

// BOF: Information Pages Unlimited
define('FILENAME_INFORMATION_MANAGER', 'information_manager.php');
// EOF: Information Pages Unlimited

define('FILENAME_ADMIN_GROUPS', 'admin_members.php?gID=groups');
define('FILENAME_CONFIGURATION_GZIP', FILENAME_CONFIGURATION . '?gID=14');
define('FILENAME_CONFIGURATION_LOGGING_CACHE', FILENAME_CONFIGURATION . '?gID=10'); 
define('FILENAME_CONFIGURATION_CACHER', FILENAME_CONFIGURATION . '?gID=11'); 
define('FILENAME_CONFIGURATION_PAGE_CACHE', FILENAME_CONFIGURATION . '?gID=55');
define('FILENAME_CONFIGURATION_SESSIONS', FILENAME_CONFIGURATION . '?gID=15');
define('FILENAME_CONFIGURATION_MAINTENANCE', FILENAME_CONFIGURATION . '?gID=16');
define('FILENAME_AFFILIATE_INFO', 'affiliate_info.php');
define('FILENAME_MERCHANT_INFO', 'merchant_info.php');
define('FILENAME_PAYPAL_INFO', 'paypal_info.php');
define('FILENAME_UPGRADE', 'upgrade.php');

// Modules
define('FILENAME_MODULES_PAYMENT', FILENAME_MODULES . '?set=payment');
define('FILENAME_MODULES_SHIPPING', FILENAME_MODULES . '?set=shipping');
define('FILENAME_MODULES_ORDER_TOTAL', FILENAME_MODULES . '?set=ordertotal');

define('FILENAME_CONFIGURATION_GENERAL_SETTINGS', FILENAME_CONFIGURATION . '?gID=1');
define('FILENAME_CONFIGURATION_MIN_VALUES', FILENAME_CONFIGURATION . '?gID=2');
define('FILENAME_CONFIGURATION_MAX_VALUES', FILENAME_CONFIGURATION . '?gID=3');
define('FILENAME_CONFIGURATION_IMAGES', FILENAME_CONFIGURATION . '?gID=4');
define('FILENAME_CONFIGURATION_MOPICS', FILENAME_CONFIGURATION . '?gID=45'); 
define('FILENAME_CONFIGURATION_SLIMBOX', FILENAME_CONFIGURATION . '?gID=46'); 
define('FILENAME_CONFIGURATION_CLOUDZOOM', FILENAME_CONFIGURATION . '?gID=47'); 
define('FILENAME_CONFIGURATION_CUSTOMER_DETAILS', FILENAME_CONFIGURATION . '?gID=5'); 
define('FILENAME_CONFIGURATION_SHIPPING', FILENAME_CONFIGURATION . '?gID=7'); 
define('FILENAME_CONFIGURATION_PRODUCT_LISTING', FILENAME_CONFIGURATION . '?gID=8'); 
define('FILENAME_CONFIGURATION_PRODUCT_INFO', FILENAME_CONFIGURATION . '?gID=50'); 
define('FILENAME_CONFIGURATION_PRODUCT_PRICE_BREAKS', FILENAME_CONFIGURATION . '?gID=88'); 
define('FILENAME_CONFIGURATION_STOCK', FILENAME_CONFIGURATION . '?gID=9'); 
define('FILENAME_CONFIGURATION_DOWNLOAD', FILENAME_CONFIGURATION . '?gID=13'); 
define('FILENAME_CONFIGURATION_PRINT', FILENAME_CONFIGURATION . '?gID=30');
define('FILENAME_CONFIGURATION_EMAIL', FILENAME_CONFIGURATION . '?gID=12');
define('FILENAME_CONFIGURATION_MC', FILENAME_CONFIGURATION . '?gID=206');
define('FILENAME_CONFIGURATION_WYSIWYG', FILENAME_CONFIGURATION . '?gID=25');
define('FILENAME_CONFIGURATION_TEMPLATES', FILENAME_CONFIGURATION . '?gID=201');
define('FILENAME_CONFIGURATION_PAGE_MODULES', 'page_modules_configuration.php');
define('FILENAME_HEADING_BOXES', 'infobox_configuration.php');
define('FILENAME_CONFIGURATION_INFO_PAGES', FILENAME_INFORMATION_MANAGER . '?gID=1');
define('FILENAME_CONFIGURATION_WELCOME', FILENAME_INFORMATION_MANAGER . '?gID=2');
define('FILENAME_CONFIGURATION_OFS', FILENAME_CONFIGURATION . '?gID=99');
define('FILENAME_CONFIGURATION_OPC', FILENAME_CONFIGURATION . '?gID=7575');
define('FILENAME_CONFIGURATION_SLIDESHOW', FILENAME_CONFIGURATION . '?gID=204');
define('FILENAME_CONFIGURATION_CORNER_BANNERS', FILENAME_CONFIGURATION . '?gID=205');
define('FILENAME_CONFIGURATION_CONTACT', FILENAME_CONFIGURATION . '?gID=207');
define('FILENAME_CONFIGURATION_RECAPTCHA', FILENAME_CONFIGURATION . '?gID=87');
define('FILENAME_CONFIGURATION_NOTIFICATIONS', FILENAME_CONFIGURATION . '?gID=203');
define('FILENAME_CONFIGURATION_WISHLIST', FILENAME_CONFIGURATION . '?gID=65');
define('FILENAME_CONFIGURATION_AFFILIATE', FILENAME_CONFIGURATION . '?gID=35'); 
define('FILENAME_TOOLS_RECOVER_CART', FILENAME_CONFIGURATION . '?gID=80');
define('FILENAME_ARTICLES_CONFIG', FILENAME_CONFIGURATION . '?gID=456');
define('FILENAME_CONFIGURATION_SEO_URLS', FILENAME_CONFIGURATION . '?gID=60');
define('FILENAME_CONFIGURATION_SEO_POPOUT', FILENAME_CONFIGURATION . '?gID=86');
define('FILENAME_CONFIGURATION_EDITOR', FILENAME_CONFIGURATION . '?gID=70');
define('FILENAME_CONFIGURATION_GOOGLE_ANALYTICS', FILENAME_CONFIGURATION . '?gID=85');
define('FILENAME_CONFIGURATION_GOOGLE_MAPS', FILENAME_CONFIGURATION . '?gID=89');
define('FILENAME_CONFIGURATION_ADDTHIS', FILENAME_CONFIGURATION . '?gID=208');


// Configuration Cache modification start
define('FILENAME_CONFIGURATION_CACHE', '../cache/cachefile.inc.php') ; 
// Configuration Cache modification end

// BOF Customers extra fields
define('FILENAME_CUSTOMERS_EXTRA_FIELDS','customers_extra_fields.php');
// EOF Customers extra fields
?>