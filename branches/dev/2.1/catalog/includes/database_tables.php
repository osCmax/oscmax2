<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// define the database table names used in the project
  define('TABLE_ADDRESS_BOOK', 'address_book');
  define('TABLE_ADDRESS_FORMAT', 'address_format');
// Line added: Mod RC2A
  define('TABLE_ADMINISTRATORS', 'admin');
// BOF: MOD - Article Manager
  define('TABLE_ARTICLE_REVIEWS', 'article_reviews');
  define('TABLE_ARTICLE_REVIEWS_DESCRIPTION', 'article_reviews_description');
  define('TABLE_ARTICLES', 'articles');
  define('TABLE_ARTICLES_DESCRIPTION', 'articles_description');
  define('TABLE_ARTICLES_TO_TOPICS', 'articles_to_topics');
  define('TABLE_ARTICLES_XSELL', 'articles_xsell');
  define('TABLE_AUTHORS', 'authors');
  define('TABLE_AUTHORS_INFO', 'authors_info');
// EOF: MOD - Article Manager
  define('TABLE_BANNERS', 'banners');
  define('TABLE_BANNERS_HISTORY', 'banners_history');
  define('TABLE_CATEGORIES', 'categories');
  define('TABLE_CATEGORIES_DESCRIPTION', 'categories_description');
  define('TABLE_CONFIGURATION', 'configuration');
  define('TABLE_CONFIGURATION_GROUP', 'configuration_group');
  define('TABLE_COUNTER', 'counter');
  define('TABLE_COUNTER_HISTORY', 'counter_history');
  define('TABLE_COUNTRIES', 'countries');
  define('TABLE_CURRENCIES', 'currencies');
  define('TABLE_CUSTOMERS', 'customers');
  define('TABLE_CUSTOMERS_BASKET', 'customers_basket');
  define('TABLE_CUSTOMERS_BASKET_ATTRIBUTES', 'customers_basket_attributes');
  define('TABLE_CUSTOMERS_INFO', 'customers_info');
  define('TABLE_LANGUAGES', 'languages');
  define('TABLE_MANUFACTURERS', 'manufacturers');
  define('TABLE_MANUFACTURERS_INFO', 'manufacturers_info');
  define('TABLE_ORDERS', 'orders');
  define('TABLE_ORDERS_PRODUCTS', 'orders_products');
  define('TABLE_ORDERS_PRODUCTS_ATTRIBUTES', 'orders_products_attributes');
  define('TABLE_ORDERS_PRODUCTS_DOWNLOAD', 'orders_products_download');
  define('TABLE_ORDERS_STATUS', 'orders_status');
  define('TABLE_ORDERS_STATUS_HISTORY', 'orders_status_history');
  define('TABLE_ORDERS_TOTAL', 'orders_total');
  define('TABLE_PRODUCTS', 'products');
  define('TABLE_PRODUCTS_ATTRIBUTES', 'products_attributes');
  define('TABLE_PRODUCTS_ATTRIBUTES_DOWNLOAD', 'products_attributes_download');
  define('TABLE_PRODUCTS_DESCRIPTION', 'products_description');
  define('TABLE_PRODUCTS_NOTIFICATIONS', 'products_notifications');
  define('TABLE_PRODUCTS_OPTIONS', 'products_options');
  define('TABLE_PRODUCTS_OPTIONS_VALUES', 'products_options_values');
  define('TABLE_PRODUCTS_OPTIONS_VALUES_TO_PRODUCTS_OPTIONS', 'products_options_values_to_products_options');
  define('TABLE_PRODUCTS_TO_CATEGORIES', 'products_to_categories');
  define('TABLE_REVIEWS', 'reviews');
  define('TABLE_REVIEWS_DESCRIPTION', 'reviews_description');
  define('TABLE_SESSIONS', 'sessions');
  define('TABLE_SPECIALS', 'specials');
  define('TABLE_TAX_CLASS', 'tax_class');
  define('TABLE_TAX_RATES', 'tax_rates');
// LINE ADDED: MOD - BTS
  define('TABLE_THEME_CONFIGURATION', 'theme_configuration');
// BOF: MOD - Article Manager
  define('TABLE_TOPICS', 'topics');
  define('TABLE_TOPICS_DESCRIPTION', 'topics_description');
// EOF: MOD - Article Manager
  define('TABLE_GEO_ZONES', 'geo_zones');
  define('TABLE_ZONES_TO_GEO_ZONES', 'zones_to_geo_zones');
  define('TABLE_WHOS_ONLINE', 'whos_online');
  define('TABLE_ZONES', 'zones');
// LINE ADDED: MOD - Xsell Products
  define('TABLE_PRODUCTS_XSELL', 'products_xsell'); 
// BOF: MOD - Wish List 3.5
  define('TABLE_WISHLIST', 'customers_wishlist');
  define('TABLE_WISHLIST_ATTRIBUTES', 'customers_wishlist_attributes');
// EOF: MOD - Wish List 3.5
// LINE ADDED: MOD - QT Pro: Begin Changed code
  define('TABLE_PRODUCTS_STOCK', 'products_stock');
// BOF: MOD - Separate Pricing per Customer
  define('TABLE_PRODUCTS_GROUPS', 'products_groups');
  define('TABLE_SPECIALS_RETAIL_PRICES', 'specials_retail_prices');
  define('TABLE_PRODUCTS_GROUP_PRICES', 'products_group_prices_cg_');
  define('TABLE_CUSTOMERS_GROUPS', 'customers_groups');
  // this will define the maximum time in minutes between updates of a products_group_prices_cg_# table
  // changes in table specials will trigger an immediate update if a query needs this particular table
  define('MAXIMUM_DELAY_UPDATE_PG_PRICES_TABLE', '15');
// EOF: MOD - Separate Pricing per Customer

// LINE ADDED
  define('TABLE_PACKAGING', 'packaging');
  define('TABLE_UPS_BOXES_USED', 'ups_boxes_used');
  
// BOF: Customer Logging
  define('TABLE_CUSTOMER_LOG','customer_log');
// EOF: Customer Logging

// BOF: Http Error Logging
  define('TABLE_HTTP_ERROR', 'http_error');
// EOF: Http Error Logging

// BOF QPBPP for SPPC v4.2
  define('TABLE_PRODUCTS_PRICE_BREAK', 'products_price_break');
  define('TABLE_DISCOUNT_CATEGORIES', 'discount_categories');
  define('TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES', 'products_to_discount_categories');
// EOF QPBPP for SPPC v4.2

// BOF: Page Module Controller
  define('TABLE_PM_CONFIGURATION', 'pm_configuration');
// EOF: Page Module Controller 

// BOF: Page Module Slideshow
define('TABLE_SLIDESHOW', 'slideshow');
// EOF: Page Module Slideshow

// BOF: Extra Product Fields
define('TABLE_EPF', 'extra_product_fields');
define('TABLE_EPF_LABELS', 'extra_field_labels');
define('TABLE_EPF_VALUES', 'extra_field_values');
define('TABLE_EPF_EXCLUDE', 'extra_value_exclude');
// EOF: Extra Product Fields

// BOF: Information Pages Unlimited
  define('TABLE_INFORMATION', 'information');
// EOF: Information Pages Unlimited

// BOF: Product Option Types
  define('TABLE_PRODUCTS_OPTIONS_TYPES', 'products_options_types');
  define('TABLE_PRODUCTS_OPTIONS_DESCRIPTION', 'products_options_description');
// EOF: Product Option Types

  define('TABLE_SEARCH_QUERIES', 'search_queries');
?>