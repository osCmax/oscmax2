<?php
/*
$Id: filenames.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// define the content used in the project
  define('CONTENT_ACCOUNT', 'account');
  define('CONTENT_ACCOUNT_EDIT', 'account_edit');
  define('CONTENT_ACCOUNT_HISTORY', 'account_history');
  define('CONTENT_ACCOUNT_HISTORY_INFO', 'account_history_info');
  define('CONTENT_ACCOUNT_NEWSLETTERS', 'account_newsletters');
  define('CONTENT_ACCOUNT_NOTIFICATIONS', 'account_notifications');
  define('CONTENT_ACCOUNT_PASSWORD', 'account_password');
  define('CONTENT_ADDRESS_BOOK', 'address_book');
  define('CONTENT_ADDRESS_BOOK_PROCESS', 'address_book_process');
  define('CONTENT_ADVANCED_SEARCH', 'advanced_search');
  define('CONTENT_ADVANCED_SEARCH_RESULT', 'advanced_search_result');
  define('CONTENT_ALSO_PURCHASED_PRODUCTS', 'also_purchased_products');
  define('CONTENT_CHECKOUT_CONFIRMATION', 'checkout_confirmation');
  define('CONTENT_CHECKOUT_PAYMENT', 'checkout_payment');
  define('CONTENT_CHECKOUT_PAYMENT_ADDRESS', 'checkout_payment_address');
  define('CONTENT_CHECKOUT_SHIPPING', 'checkout_shipping');
  define('CONTENT_CHECKOUT_SHIPPING_ADDRESS', 'checkout_shipping_address');
  define('CONTENT_CHECKOUT_SUCCESS', 'checkout_success');
  define('CONTENT_CONTACT_US', 'contact_us');
  define('CONTENT_CONDITIONS', 'conditions');
  define('CONTENT_CONDITIONS_CONTENT', 'conditions_content');
  define('CONTENT_COOKIE_USAGE', 'cookie_usage');
  define('CONTENT_CREATE_ACCOUNT', 'create_account');
  define('CONTENT_CREATE_ACCOUNT_SUCCESS', 'create_account_success');
  define('CONTENT_DOWNLOAD', 'download');
  define('CONTENT_INDEX_DEFAULT', 'index_default');
  define('CONTENT_INDEX_NESTED', 'index_nested');
  define('CONTENT_INDEX_PRODUCTS', 'index_products');
  define('CONTENT_INFO_SHOPPING_CART', 'info_shopping_cart');
  define('CONTENT_LOGIN', 'login');
  define('CONTENT_LOGOFF', 'logoff');
  define('CONTENT_NEW_PRODUCTS', 'new_products');
  define('CONTENT_PASSWORD_FORGOTTEN', 'password_forgotten');
  define('CONTENT_POPUP_IMAGE', 'popup_image');
  define('CONTENT_POPUP_SEARCH_HELP', 'popup_search_help');
  define('CONTENT_PRIVACY', 'privacy');
  define('CONTENT_PRIVACY_CONTENT', 'privacy_content');
  define('CONTENT_PRODUCT_INFO', 'product_info');
  define('CONTENT_PRODUCT_LISTING', 'product_listing');
  define('CONTENT_PRODUCT_REVIEWS', 'product_reviews');
  define('CONTENT_PRODUCT_REVIEWS_INFO', 'product_reviews_info');
  define('CONTENT_PRODUCT_REVIEWS_WRITE', 'product_reviews_write');
  define('CONTENT_PRODUCTS_NEW', 'products_new');
  define('CONTENT_REVIEWS', 'reviews');
  define('CONTENT_SHIPPING', 'shipping');
  define('CONTENT_SHIPPING_CONTENT', 'shipping_content');
  define('CONTENT_SHOPPING_CART', 'shopping_cart');
  define('CONTENT_SPECIALS', 'specials');
  define('CONTENT_SSL_CHECK', 'ssl_check');
  define('CONTENT_TELL_A_FRIEND', 'tell_a_friend');
  define('CONTENT_UPCOMING_PRODUCTS', 'upcoming_products');
  define('CONTENT_CHECKOUT_PROCESS', 'checkout_process');
  define('CONTENT_GV_FAQ', 'gv_faq');
  define('CONTENT_GV_REDEEM', 'gv_redeem');
  define('CONTENT_GV_SEND', 'gv_send');
  define('CONTENT_PRINTABLE_CATALOG', 'catalog_products_with_images');
  define('CONTENT_ALLPRODS', 'allprods');
  define('CONTENT_DOWN_FOR_MAINT', 'down_for_maintenance');
//BTS for Articles 1.0
  define('CONTENT_ARTICLES', 'article_info');
  define('CONTENT_ARTICLES_REVIEWS', 'article_reviews');
  define('CONTENT_ARTICLES_REVIEWS_INFO', 'article_reviews_info');
  define('CONTENT_ARTICLES_REVIEWS_WRITE', 'article_reviews_write');
  define('CONTENT_ARTICLES_MAIN', 'articles');
  define('CONTENT_ARTICLES_NEW', 'articles_new');
 //BTS for Wishlist 3.5
  define('CONTENT_WISHLIST', 'wishlist');
  define('CONTENT_WISHLIST_HELP', 'wishlist_help');
  define('CONTENT_WISHLIST_PUBLIC', 'wishlist_public');
  define('CONTENT_WISHLIST_SEND', 'wishlist_email');
  
 // One Page Checkout
  define('CONTENT_ONE_PAGE_CHECKOUT', 'checkout');   

// LINE ADDED: WYSIWYG HTML Area
  define('FILENAME_DEFINE_MAINPAGE', 'mainpage.php');

// define the filenames used in the project
  define('FILENAME_ACCOUNT', CONTENT_ACCOUNT . '.php');
  define('FILENAME_ACCOUNT_EDIT', CONTENT_ACCOUNT_EDIT . '.php');
  define('FILENAME_ACCOUNT_HISTORY', CONTENT_ACCOUNT_HISTORY . '.php');
  define('FILENAME_ACCOUNT_HISTORY_INFO', CONTENT_ACCOUNT_HISTORY_INFO . '.php');
  define('FILENAME_ACCOUNT_NEWSLETTERS', CONTENT_ACCOUNT_NEWSLETTERS . '.php');
  define('FILENAME_ACCOUNT_NOTIFICATIONS', CONTENT_ACCOUNT_NOTIFICATIONS . '.php');
  define('FILENAME_ACCOUNT_PASSWORD', CONTENT_ACCOUNT_PASSWORD . '.php');
  define('FILENAME_ADDRESS_BOOK', CONTENT_ADDRESS_BOOK . '.php');
  define('FILENAME_ADDRESS_BOOK_PROCESS', CONTENT_ADDRESS_BOOK_PROCESS . '.php');
  define('FILENAME_ADVANCED_SEARCH', CONTENT_ADVANCED_SEARCH . '.php');
  define('FILENAME_ADVANCED_SEARCH_RESULT', CONTENT_ADVANCED_SEARCH_RESULT . '.php');
  define('FILENAME_ALSO_PURCHASED_PRODUCTS', CONTENT_ALSO_PURCHASED_PRODUCTS . '.php');
  define('FILENAME_ARTICLE_INFO', 'article_info.php');
  define('FILENAME_ARTICLE_LISTING', 'article_listing.php');
  define('FILENAME_ARTICLE_REVIEWS', 'article_reviews.php');
  define('FILENAME_ARTICLE_REVIEWS_INFO', 'article_reviews_info.php');
  define('FILENAME_ARTICLE_REVIEWS_WRITE', 'article_reviews_write.php');
  define('FILENAME_ARTICLES', 'articles.php');
  define('FILENAME_ARTICLES_NEW', 'articles_new.php');
  define('FILENAME_ARTICLES_UPCOMING', 'articles_upcoming.php');
  define('FILENAME_ARTICLES_XSELL', 'articles_xsell.php');
  define('FILENAME_ARTICLES_PXSELL', 'articles_pxsell.php');
  define('FILENAME_NEW_ARTICLES', 'new_articles.php');
  define('FILENAME_CATALOG_PRODUCTS_WITH_IMAGES', 'catalog_products_with_images.php'); // CATALOG_PRODUCTS_WITH_IMAGES_mod
/* One Page Checkout - BEGIN */  
  define('FILENAME_CHECKOUT', 'checkout.php');
/* One Page Checkout - END */ 
  define('FILENAME_CHECKOUT_CONFIRMATION', CONTENT_CHECKOUT_CONFIRMATION . '.php');
  define('FILENAME_CHECKOUT_PAYMENT', CONTENT_CHECKOUT_PAYMENT . '.php');
  define('FILENAME_CHECKOUT_PAYMENT_ADDRESS', CONTENT_CHECKOUT_PAYMENT_ADDRESS . '.php');
  define('FILENAME_CHECKOUT_PROCESS', CONTENT_CHECKOUT_PROCESS . '.php');
  define('FILENAME_CHECKOUT_SHIPPING', CONTENT_CHECKOUT_SHIPPING . '.php');
  define('FILENAME_CHECKOUT_SHIPPING_ADDRESS', CONTENT_CHECKOUT_SHIPPING_ADDRESS . '.php');
  define('FILENAME_CHECKOUT_SUCCESS', CONTENT_CHECKOUT_SUCCESS . '.php');
  define('FILENAME_CONTACT_US', CONTENT_CONTACT_US . '.php');
  define('FILENAME_CONDITIONS', CONTENT_CONDITIONS . '.php');
  define('FILENAME_CONDITIONS_CONTENT', CONTENT_CONDITIONS_CONTENT . '.php');
  define('FILENAME_COOKIE_USAGE', CONTENT_COOKIE_USAGE . '.php');
  define('FILENAME_CREATE_ACCOUNT', CONTENT_CREATE_ACCOUNT . '.php');
  define('FILENAME_CREATE_ACCOUNT_SUCCESS', CONTENT_CREATE_ACCOUNT_SUCCESS . '.php');
  define('FILENAME_CVS_HELP', 'cvs_help.php');
  define('FILENAME_DEFAULT', 'index.php');
  define('FILENAME_DEFAULT_SPECIALS', 'default_specials.php');
  define('FILENAME_DOWNLOAD', CONTENT_DOWNLOAD . '.php');
  define('FILENAME_INFO_SHOPPING_CART', CONTENT_INFO_SHOPPING_CART . '.php');
  define('FILENAME_LOGIN', CONTENT_LOGIN . '.php');
  define('FILENAME_LOGOFF', CONTENT_LOGOFF . '.php');
  define('FILENAME_NEW_PRODUCTS', CONTENT_NEW_PRODUCTS . '.php');
  define('FILENAME_PASSWORD_FORGOTTEN', CONTENT_PASSWORD_FORGOTTEN . '.php');
  define('FILENAME_POPUP_CVS_HELP', 'popup_cvs_help.php');
  define('FILENAME_POPUP_IMAGE', CONTENT_POPUP_IMAGE . '.php');
  define('FILENAME_POPUP_INFOBOX_HELP', 'popup_infobox_help.php');
  define('FILENAME_POPUP_SEARCH_HELP', CONTENT_POPUP_SEARCH_HELP . '.php');
  define('FILENAME_PRIVACY', CONTENT_PRIVACY . '.php');
  define('FILENAME_PRIVACY_CONTENT', CONTENT_PRIVACY_CONTENT . '.php');
  define('FILENAME_PRODUCT_INFO', CONTENT_PRODUCT_INFO . '.php');
  define('FILENAME_PRODUCT_LISTING', CONTENT_PRODUCT_LISTING . '.php');
  define('FILENAME_PRODUCT_REVIEWS', CONTENT_PRODUCT_REVIEWS . '.php');
  define('FILENAME_PRODUCT_REVIEWS_INFO', CONTENT_PRODUCT_REVIEWS_INFO . '.php');
  define('FILENAME_PRODUCT_REVIEWS_WRITE', CONTENT_PRODUCT_REVIEWS_WRITE . '.php');
  define('FILENAME_PRODUCTS_NEW', CONTENT_PRODUCTS_NEW . '.php');
  define('FILENAME_REDIRECT', 'redirect.php');
  define('FILENAME_REVIEWS', CONTENT_REVIEWS . '.php');
  define('FILENAME_SHIPPING', CONTENT_SHIPPING . '.php');
  define('FILENAME_SHIPPING_CONTENT', CONTENT_SHIPPING_CONTENT . '.php');
  define('FILENAME_SHOPPING_CART', CONTENT_SHOPPING_CART . '.php');
  define('FILENAME_SITEMAP', 'sitemap.php');
  define('FILENAME_SPECIALS', CONTENT_SPECIALS . '.php');
  define('FILENAME_SSL_CHECK', CONTENT_SSL_CHECK . '.php');
  define('FILENAME_TELL_A_FRIEND', CONTENT_TELL_A_FRIEND . '.php');
  define('FILENAME_UPCOMING_PRODUCTS', CONTENT_UPCOMING_PRODUCTS . '.php');

// BOF: MOD - Affiliate Mod
  define('CONTENT_AFFILIATE', 'affiliate_affiliate');
  define('CONTENT_AFFILIATE_BANNERS', 'affiliate_banners');
  define('CONTENT_AFFILIATE_CLICKS', 'affiliate_clicks');
  define('CONTENT_AFFILIATE_CONTACT', 'affiliate_contact');
  define('CONTENT_AFFILIATE_DETAILS', 'affiliate_details');
  define('CONTENT_AFFILIATE_DETAILS_OK', 'affiliate_details_ok');
  define('CONTENT_AFFILIATE_FAQ', 'affiliate_faq');
  define('CONTENT_AFFILIATE_INFO', 'affiliate_info');
  define('CONTENT_AFFILIATE_LOGOUT', 'affiliate_logout');
  define('CONTENT_AFFILIATE_PASSWORD_FORGOTTEN', 'affiliate_password_forgotten');
  define('CONTENT_AFFILIATE_PAYMENT', 'affiliate_payment');
  define('CONTENT_AFFILIATE_SALES', 'affiliate_sales');
  define('CONTENT_AFFILIATE_SHOW_BANNER', 'affiliate_show_banner');
  define('CONTENT_AFFILIATE_SIGNUP', 'affiliate_signup');
  define('CONTENT_AFFILIATE_SIGNUP_OK', 'affiliate_signup_ok');
  define('CONTENT_AFFILIATE_SUMMARY', 'affiliate_summary');
  define('CONTENT_AFFILIATE_TERMS', 'affiliate_terms');
  define('FILENAME_CATEGORIES_INFO', 'index.php'); 
// EOF: MOD - Affiliate Mod

// BOF: MOD Xsell Products
  define('FILENAME_XSELL_PRODUCTS', 'xsell_products.php');
  define('FILENAME_PRODUCT_LISTING_COL', 'product_listing_col.php');
// EOF: MOD Xsell Products
// LINE ADDED: MOD - allprods modification
  define('FILENAME_ALLPRODS', 'allprods.php');
// LINE ADDED: MOD - Dynamic MoPics
  define('FILENAME_DYNAMIC_MOPICS', 'dynamic_mopics.php');
/* moved to configure_bts.php 2003/12/23
// define the templatenames used in the project
  define('TEMPLATENAME_BOX', 'box.tpl.php');
  define('TEMPLATENAME_MAIN_PAGE', 'main_page.tpl.php');
  define('TEMPLATENAME_POPUP', 'popup.tpl.php');
  define('TEMPLATENAME_STATIC', 'static.tpl.php');
*/
// BOF: MOD - Checkout Without Account Modifications
  define('FILENAME_PWA_PWA_LOGIN', 'login_pwa.php');
  define('FILENAME_PWA_ACC_LOGIN', 'login_acc.php');
  define('FILENAME_ORDER_INFO', 'Order_Info.php');
  define('FILENAME_ORDER_INFO_PROCESS', 'Order_Info_Process.php');
// EOF: MOD - Checkout Without Account Modifications
// BOF: MOD - Wish List 3.5
  define('FILENAME_WISHLIST', 'wishlist.php');
  define('FILENAME_WISHLIST_HELP', 'wishlist_help.php');
  define('FILENAME_WISHLIST_PUBLIC', 'wishlist_public.php');
// EOF: MOD - Wish List 3.5
// BOF: MOD - FedEx
  define('FILENAME_FEDEX_TRACK', 'track_fedex.php');
  define('CONTENT_FEDEX_TRACK', 'track_fedex');
  define('FILENAME_TRACK_FEDEX', 'track_fedex.php');
  define('FILENAME_SHIP_FEDEX', 'ship_fedex.php');
  define('FILENAME_SHIPPING_MANIFEST', 'shipping_manifest.php');
// EOF: MOD - FedEx

// BOF: Http Error Log
  define('FILENAME_HTTP_ERROR', 'http_error.php');
// EOF: Http Error Log  

// BOF: Google Sitmap
  define('FILENAME_GOOGLE_SITEMAPS', 'sitemaps.index.php');
// EOF: Google Sitmap

// BOF: Page Module Controller
  define('FILENAME_INDEX_PAGE_MODULES', 'index_page_modules.php');
  define('FILENAME_PI_PAGE_MODULES', 'pi_page_modules.php');
  define('FILENAME_COMMON_PAGE_MODULES', 'common_page_modules.php');
// EOF: Page Module Controller  

// BOF: Open Featured Sets
  define('FILENAME_FEATURED_SETS', 'featured_sets.php');
  define('FILENAME_FEATURED_SBOX_CATEGORIES', 'featured_sbox_categories.php');
  define('FILENAME_FEATURED_SBOX_MANUFACTURER', 'featured_sbox_manufacturer.php');
  define('FILENAME_FEATURED_SBOX_PRODUCTS', 'featured_sbox_products.php');
  define('FILENAME_FEATURED_MANUFACTURERS', 'featured_manufacturers.php');
  define('FILENAME_FEATURED_GBOX_CATEGORIES', 'featured_gbox_categories.php');
  define('FILENAME_FEATURED_GBOX_MANUFACTURER', 'featured_gbox_manufacturer.php');
  define('FILENAME_FEATURED_GBOX_PRODUCTS', 'featured_gbox_products.php');
// EOF: Open Featured Sets

?>