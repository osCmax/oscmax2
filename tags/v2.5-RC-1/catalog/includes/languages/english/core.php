<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/


// Global entries for the <html> tag
define('HTML_PARAMS','dir="LTR" lang="en"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Create an Account');
define('HEADER_TITLE_MY_ACCOUNT', 'My Account');
define('HEADER_TITLE_CONTACT_US', 'Contact Us');
define('HEADER_TITLE_CART_CONTENTS', 'Cart Contents');
define('HEADER_TITLE_BASKET_CONTENTS', 'Basket Contents');
define('HEADER_TITLE_CHECKOUT', 'Checkout');
define('HEADER_TITLE_WISHLIST', 'Wish List');
define('HEADER_TITLE_TOP', 'Top');
define('HEADER_TITLE_CATALOG', 'Catalog');
define('HEADER_TITLE_LOGOFF', 'Log Off');
define('HEADER_TITLE_LOGIN', 'Log In');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'requests since');

// text for gender
define('MALE', 'Male');
define('FEMALE', 'Female');
define('MALE_ADDRESS', 'Mr.');
define('FEMALE_ADDRESS', 'Ms.');

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Categories');

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Manufacturers');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'What\'s New?');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Quick Find');
define('BOX_SEARCH_TEXT', '');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Advanced Search');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'Specials');

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Reviews');
define('BOX_REVIEWS_WRITE_REVIEW', 'Write a review on this product!');
define('BOX_REVIEWS_NO_REVIEWS', 'There are currently no product reviews');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s of 5 Stars!');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Shopping Cart');
define('BOX_HEADING_SHOPPING_BASKET', 'Shopping Basket');
define('BOX_SHOPPING_CART_EMPTY', '0 items');

// BOF: MOD - Wishlist 3.5
//wishlist box text in includes/boxes/wishlist.php 
define('BOX_HEADING_CUSTOMER_WISHLIST', 'My Wish List'); 
define('TEXT_WISHLIST_COUNT', 'Currently %s items are on your Wish List.');
define('BOX_TEXT_REMOVE', 'Remove');
define('BOX_TEXT_PRICE', 'Price');
define('BOX_TEXT_PRODUCT', 'Product Name');
define('BOX_TEXT_IMAGE', 'Image');
define('BOX_TEXT_SELECT', 'Select');
define('BOX_TEXT_VIEW', 'Show');
define('BOX_TEXT_HELP', 'Help');
define('BOX_WISHLIST_EMPTY', '0 items');
define('BOX_TEXT_NO_ITEMS', 'There are no products in your Wish List.');
// EOF: MOD - Wishlist 3.5

// order_history box text in includes/boxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'Order History');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Bestsellers');
define('BOX_HEADING_BESTSELLERS_IN', 'Bestsellers in<br>&nbsp;&nbsp;');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Notifications');
define('BOX_NOTIFICATIONS_NOTIFY', 'Notify me of updates to <b>%s</b>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'Do not notify me of updates to <b>%s</b>');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Manufacturer Info');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', '%s Homepage');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Other products');

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Languages');

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'Currencies');

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Information');
define('BOX_INFORMATION_PRIVACY', 'Privacy Notice');
define('BOX_INFORMATION_CONDITIONS', 'Conditions of Use');
define('BOX_INFORMATION_SHIPPING', 'Shipping &amp; Returns');
define('BOX_INFORMATION_CONTACT', 'Contact Us');
// LINE ADDED: SITE MAP
define('BOX_INFORMATION_SITEMAP', 'Site Map');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Tell A Friend');
define('BOX_TELL_A_FRIEND_TEXT', 'Tell someone you know about this product.');

//MailChimp
define('BOX_HEADING_MAILCHIMP', 'Newsletter');
define('MAILCHIMP_INTRO_TEXT', 'If would you like to subscribe to our newsletter please enter your email address here:');
define('MAILCHIMP_INTRO_TEXT_SUBSCRIBED', 'You are currently subscribed to our newsletter');
define('MAILCHIMP_INTRO_TEXT_UNSUBSCRIBED', 'If would you like to subscribe to our newsletter please enter your email address here:');
define('MAILCHIMP_HTML', 'HTML');
define('MAILCHIMP_TEXT', 'Text');
define('MAILCHIMP_MISSING_INTRO', 'Unfortunately, you have not entered all the required information in your MailChimp setup. <br><br><b>Missing Settings:</b>');
define('MAILCHIMP_NEED_ENABLING', '<b>Please enable the module</b>');
define('MAILCHIMP_MISSING_API', 'API Key');
define('MAILCHIMP_MISSING_ID', 'List ID');
define('MAILCHIMP_MISSING_URL', 'List URL');
define('MAILCHIMP_MISSING_U', 'U value');

// LINE ADDED: MOD - allprods modification
define('BOX_INFORMATION_ALLPRODS', 'View All Items');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Delivery Information');
define('CHECKOUT_BAR_PAYMENT', 'Payment Information');
define('CHECKOUT_BAR_CONFIRMATION', 'Confirmation');
define('CHECKOUT_BAR_FINISHED', 'Finished!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Please Select');
define('PULL_DOWN_DEFAULT_DOTS', 'Please Select ... ');
define('PULL_DOWN_NA', 'N/A');
define('TYPE_BELOW', 'Type Below');

// javascript messages
define('JS_ERROR', 'Errors have occured during the process of your form.  Please make the following corrections:');

define('JS_REVIEW_TEXT', ' The \'Review Text\' must have at least ' . REVIEW_TEXT_MIN_LENGTH . ' characters.');
define('JS_REVIEW_RATING', ' You must rate the product for your review.');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', 'Please select a payment method for your order.');

define('JS_ERROR_SUBMITTED', 'This form has already been submitted. Please press Ok and wait for this process to be completed.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Please select a payment method for your order.');

define('CATEGORY_COMPANY', 'Company Details');
define('CATEGORY_PERSONAL', 'Your Personal Details');
define('CATEGORY_ADDRESS', 'Your Address');
define('CATEGORY_CONTACT', 'Your Contact Information');
define('CATEGORY_OPTIONS', 'Options');
define('CATEGORY_PASSWORD', 'Your Password');

define('ENTRY_COMPANY', 'Company Name:');
define('ENTRY_COMPANY_ERROR', 'Please enter your company name');
define('ENTRY_COMPANY_TEXT', '*');
define('ENTRY_COMPANY_TAX_ID', 'Company\'s tax id number:');
define('ENTRY_COMPANY_TAX_ID_ERROR', 'Please enter your company tax id');
define('ENTRY_COMPANY_TAX_ID_TEXT', '*');
define('ENTRY_GENDER', 'Gender:');
define('ENTRY_GENDER_ERROR', 'Please select your Gender.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'First Name:');
define('ENTRY_FIRST_NAME_ERROR', 'Your First Name must contain a minimum of ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Last Name:');
define('ENTRY_LAST_NAME_ERROR', 'Your Last Name must contain a minimum of ' . ENTRY_LAST_NAME_MIN_LENGTH . ' characters.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Date of Birth:');
// if you are looking for the DOB error message and * - look in locale.php
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Address:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Your E-Mail Address must contain a minimum of ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' characters.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Your E-Mail Address does not appear to be valid - please make any necessary corrections.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Your E-Mail Address already exists in our records - please log in with the e-mail address or create an account with a different address.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Street Address:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Your Street Address must contain a minimum of ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' characters.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_CITY', 'City:');
define('ENTRY_CITY_ERROR', 'Your City must contain a minimum of ' . ENTRY_CITY_MIN_LENGTH . ' characters.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE_TEXT', '* (Select country first)');
define('ENTRY_COUNTRY', 'Country:');
define('ENTRY_COUNTRY_ERROR', 'You must select a country from the Countries pull down menu.');
define('ENTRY_COUNTRY_TEXT', '* (Page will refresh when changed)');
define('ENTRY_TELEPHONE_NUMBER', 'Telephone Number:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Your Telephone Number must contain a minimum of ' . ENTRY_TELEPHONE_MIN_LENGTH . ' characters.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Fax Number:');
define('ENTRY_FAX_NUMBER_ERROR', 'Please enter your fax number');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Subscribed');
define('ENTRY_NEWSLETTER_NO', 'Unsubscribed');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Password:');
define('ENTRY_PASSWORD_ERROR', 'Your Password must contain a minimum of ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'The Password Confirmation must match your Password.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Password Confirmation:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Current Password:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Your Password must contain a minimum of ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.');
define('ENTRY_PASSWORD_NEW', 'New Password:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Your new Password must contain a minimum of ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'The Password Confirmation must match your new Password.');
define('PASSWORD_HIDDEN', '--HIDDEN--');

define('FORM_REQUIRED_INFORMATION', '* Required information');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Result Pages:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> orders)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> reviews)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> new products)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> specials)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'First Page');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Previous Page');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Next Page');
define('PREVNEXT_TITLE_LAST_PAGE', 'Last Page');
define('PREVNEXT_TITLE_PAGE_NO', 'Page %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Previous Set of %d Pages');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Next Set of %d Pages');
define('PREVNEXT_BUTTON_FIRST', 'First');
define('PREVNEXT_BUTTON_PREV', 'Previous');
define('PREVNEXT_BUTTON_NEXT', 'Next');
define('PREVNEXT_BUTTON_LAST', 'Last');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Add Address');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Address Book');
define('IMAGE_BUTTON_BACK', 'Back');
define('IMAGE_BUTTON_BUY_NOW', 'Buy Now');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Change Address');
define('IMAGE_BUTTON_CHECKOUT', 'Checkout');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Confirm Order');
define('IMAGE_BUTTON_CONTINUE', 'Continue');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Continue Shopping');
define('IMAGE_BUTTON_DELETE', 'Delete');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Edit Account');
define('IMAGE_BUTTON_HISTORY', 'Order History');
define('IMAGE_BUTTON_LOGIN', 'Sign In');
define('IMAGE_BUTTON_IN_CART', 'Add to Cart');
define('IMAGE_BUTTON_IN_BASKET', 'Add to Basket');
define('IMAGE_OUT_OF_STOCK' ,'Out of Stock');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Notifications');
define('IMAGE_BUTTON_QUICK_FIND', 'Quick Find');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Remove Notifications');
define('IMAGE_BUTTON_REVIEWS', 'Reviews');
define('IMAGE_BUTTON_SEARCH', 'Search');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Shipping Options');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Tell a Friend');
define('IMAGE_BUTTON_UPDATE', 'Update');
define('IMAGE_BUTTON_UPDATE_CART', 'Update Cart');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Write Review');
define('IMAGE_BUTTON_CFP', 'Contact for price');
define('IMAGE_BUTTON_AAQ', 'Ask a question about this product');
define('IMAGE_BUTTON_MORE_INFO', 'More info');
define('IMAGE_BUTTON_REMOVE_PRODUCT', 'Remove Product');
define('IMAGE_BUTTON_SEND', 'Send');
define('IMAGE_BUTTON_WISHLIST_HELP', 'Wish list help');
define('IMAGE_BUTTON_WISHLIST', 'Wish List');

define('SMALL_IMAGE_BUTTON_DELETE', 'Delete');
define('SMALL_IMAGE_BUTTON_EDIT', 'Edit');
define('SMALL_IMAGE_BUTTON_VIEW', 'View');

define('ICON_ARROW_RIGHT', 'more');
define('ICON_CART', 'In Cart');
define('ICON_ERROR', 'Error');
define('ICON_SUCCESS', 'Success');
define('ICON_WARNING', 'Warning');

// BOF: MOD - CATALOG_PRODUCTS_WITH_IMAGES_mod
define('BOX_CATALOG_PRODUCTS_WITH_IMAGES', 'Printable Catalog');
define('IMAGE_BUTTON_UPSORT', 'Sort Asending');
define('IMAGE_BUTTON_DOWNSORT', 'Sort Desending');
// EOF: MOD - CATALOG_PRODUCTS_WITH_IMAGES_mod

//2 LINES ADDED: MOD - Down For Maintenance
define('TEXT_BEFORE_DOWN_FOR_MAINTENANCE', 'NOTICE: This website will be down for maintenance on: ');
define('TEXT_ADMIN_DOWN_FOR_MAINTENANCE', 'NOTICE: the website is currently Down For Maintenance to the public');

define('TEXT_SORT_PRODUCTS', 'Sort products ');
define('TEXT_DESCENDINGLY', 'descendingly');
define('TEXT_ASCENDINGLY', 'ascendingly');
define('TEXT_BY', ' by ');

define('TEXT_REVIEW_BY', 'by %s');
define('TEXT_REVIEW_WORD_COUNT', '%s words');
define('TEXT_REVIEW_RATING', 'Rating: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Date Added: %s');
define('TEXT_NO_REVIEWS', 'There are currently no product reviews.');

define('TEXT_NO_NEW_PRODUCTS', 'There are currently no products.');

define('TEXT_UNKNOWN_TAX_RATE', 'Unknown tax rate');

define('TEXT_REQUIRED', '<span class="errorText">Required</span>');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>TEP ERROR:</small> Cannot send the email through the specified SMTP server. Please check your php.ini setting and correct the SMTP server if necessary.</b></font>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Warning: Installation directory exists at: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/install. Please remove this directory for security reasons.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Warning: I am able to write to the configuration file: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php. This is a potential security risk - please set the right user permissions on this file.');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Warning: The sessions directory does not exist: ' . tep_session_save_path() . '. Sessions will not work until this directory is created.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Warning: I am not able to write to the sessions directory: ' . tep_session_save_path() . '. Sessions will not work until the right user permissions are set.');
define('WARNING_SEO_PHP_VERSION_LOW', 'Warning: Your webserver is running ' . PHP_VERSION . ' which is not sufficient for running SEO URLs. Please disable this module until you have upgraded your version of PHP.');
define('WARNING_SESSION_AUTO_START', 'Warning: session.auto_start is enabled - please disable this php feature in php.ini and restart the web server.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Warning: The downloadable products directory does not exist: ' . DIR_FS_DOWNLOAD . '. Downloadable products will not work until this directory is valid.');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'The expiry date entered for the credit card is invalid. Please check the date and try again.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'The credit card number entered is invalid. Please check the number and try again.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'The first four digits of the number entered are: %s. If this number is correct, we do not accept this type of credit card. If it is wrong, please try again.');
define('WARNING_JAVASCRIPT_DISABLED', 'Alert: We have detected that you have Javascript disabled. For the best user experience you should re-enable it.  If you require help doing this please <b>click here.</b>');
define('WARNING_IE6_DETECTED', 'Warning: We have detected that you are using Internet Explorer 6 which is notoriously unstable.  We strongly recommend that you <b>upgrade your browser</b>.  Why not try <a href="http://www.microsoft.com/windows/internet-explorer/default.aspx"><b>IE</b></a>, <a href="http://www.mozilla.com/"><b>Firefox</b></a> or <a href="http://www.google.co.uk/chrome/"><b>Chrome</b></a>');

define('FOOTER_TEXT_BODY', 'All content and Images Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a><br> Copyright &copy; 2000 - ' . date("Y") .  '<a href="http://oscmax.com"> osCmax</a><br>Powered by <a href="http://www.oscmax.com" target="_blank">' . PROJECT_VERSION . '</a>');


// BOF: MOD - Checkout Without Account
define('IMAGE_BUTTON_CREATE_ACCOUNT', 'Create Account');
define('NAV_ORDER_INFO', 'Order Info');
// EOF: MOD - Checkout Without Account

// BOF: MOD - Article Manager
define('BOX_HEADING_ARTICLES', 'Articles');
define('BOX_ALL_ARTICLES', 'All Articles');
define('BOX_NEW_ARTICLES', 'New Articles');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> articles)');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES_NEW', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> new articles)');
define('TABLE_HEADING_AUTHOR', 'Author');
define('TABLE_HEADING_ABSTRACT', 'Abstract');
define('BOX_HEADING_AUTHORS', 'Articles by Author');
define('NAVBAR_TITLE_DEFAULT', 'Articles');
// EOF: MOD - Article Manager

// BOF: MOD - Login Box My Account
define('BOX_HEADING_LOGIN_BOX', 'Sign in');
define('BOX_LOGINBOX_EMAIL', 'E-mail address:');
define('BOX_LOGINBOX_PASSWORD', 'Password:');
define('BOX_LOGINBOX_TEXT_NEW', 'Create an Account');
define('BOX_LOGINBOX_NEW', 'create an account');
define('BOX_LOGINBOX_FORGOT_PASSWORD', 'Password forgotten');
define('BOX_HEADING_LOGIN_BOX_MY_ACCOUNT','My Account Info');
define('LOGIN_BOX_ACCOUNT_EDIT','Account Information');
define('LOGIN_BOX_ACCOUNT_HISTORY','Previous Orders');
define('LOGIN_BOX_ADDRESS_BOOK','Address Book');
define('LOGIN_BOX_PRODUCT_NOTIFICATIONS','Product Notifications');
define('LOGIN_BOX_MY_ACCOUNT','My Account');
define('LOGIN_BOX_LOGOFF','Log off');
define('LOGIN_BOX_PRODUCTS_NEW','New Products');
define('LOGIN_BOX_SPECIALS', 'Special Offers');
define('LOGIN_BOX_WISHLIST', 'Wish List');
define('LOGIN_BOX_NEWSLETTERS', 'Newsletters');
// EOF: MOD - Login Box My Account

// BOF: QPBPP for SPPC
define('MINIMUM_ORDER_NOTICE', 'Minimum order amount for %s is %d. Your cart has been updated to reflect this.');
define('QUANTITY_BLOCKS_NOTICE', '%s can only by ordered in multiples of %d. Your cart has been updated to reflect this.');
// EOF: QPBPP for SPPC

// BOF: Customer Comments contrib
define('SUCCESS_ORDER_UPDATED', 'Success: Order has been successfully updated.');
define('WARNING_ORDER_NOT_UPDATED', 'Warning: Nothing to change. The order was not updated.');
// EOF: Customer Comments contrib

// BOF: Open Featured Sets
define('OPEN_FEATURED_BOX_HEADING', 'Featured');
define('OPEN_FEATURED_BOX_CATEGORY_HEADING', 'Featured Categories');
define('OPEN_FEATURED_BOX_MANUFACTURERS_HEADING', 'Now Featuring');
define('OPEN_FEATURED_BOX_MANUFACTURER_HEADING', 'Now Featuring');
define('OPEN_FEATURED_TABLE_HEADING_PRICE', ''); //Price: 
define('TEXT_MORE_INFO', 'more...');
// EOF: Open Featured Sets

// BOF: Extra Product Fields
define('TEXT_ANY_VALUE', 'Any Value');
define('TEXT_RESTRICT_TO', 'Restrict <b>%s</b> to: %s and its sub-values (if any).');
// EOF: Extra Product Fields

// LINE ADDED: MOD - EASY CALL FOR PRICE v1.4
define('TEXT_CALL_FOR_PRICE', 'Contact for Price!');

// BOF: MSRP
define('TEXT_PRODUCTS_OUR_PRICE', '&nbsp;Our&nbsp;Price:&nbsp;');
define('TEXT_PRODUCTS_SALE', '&nbsp;WAS:&nbsp;');
define('TEXT_PRODUCTS_SAVINGS', '&nbsp;You&nbsp;Save:&nbsp;');
define('TEXT_PRODUCTS_PRICENOW', '&nbsp;NOW:&nbsp;');
define('TEXT_PRODUCTS_USUALPRICE', '&nbsp;Normally:&nbsp;');
// EOF: MSRP

define('TEXT_LATEST_PRODUCTS', 'Latest Products');
define('TEXT_SPECIALS', 'Specials');
define('TEXT_READ_MORE', ' ... read more ... ');

define('TEXT_MISSING_IMAGE', 'Sorry, product image is currently not available');
define('TEXT_PAGE', 'Page: ');

// Review Ratings
define('TEXT_RATING', 'Rating: ');
define('TEXT_POOR', 'Poor');
define('TEXT_FAIR', 'Fair');
define('TEXT_AVERAGE', 'Average');
define('TEXT_GOOD', 'Good');
define('TEXT_EXCELLENT', 'Excellent');

// Password Text
define('PW_TOO_WEAK', 'Too Weak');
define('PW_WEAK', 'Weak password');
define('PW_NORMAL', 'Normal strength');
define('PW_STRONG', 'Strong password');
define('PW_VERY_STRONG', 'Very strong password');

// Product listing
define('TEXT_PRODUCT_NAME_AZ', 'Product Name (A-Z)');
define('TEXT_PRODUCT_NAME_ZA', 'Product Name (Z-A)');
define('TEXT_PRICE_LOW_HIGH', 'Price (Low - High)');
define('TEXT_PRICE_HIGH_LOW', 'Price (High - Low)');
define('TEXT_SHOW_ALL', 'Show All');
define('TEXT_VIEW_AS_LIST', 'View as List');
define('TEXT_VIEW_AS_GRID', 'View as Grid');
define('TEXT_RESULTS_PAGE', 'Results/Page: ');
define('TEXT_SORT_ORDER', 'Sort Order: ');

?>