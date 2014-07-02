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

define('TEXT_SESSION_EXPIRE_WARNING', 'Warning - your session is going to expire in <b>2</b> minutes.');
define('TEXT_SESSION_EXPIRED', 'Sorry your session expired - please log in again.');

// configuration box text in includes/boxes/administrator.php
define('BOX_HEADING_ADMINISTRATOR', 'Administrateur');
define('BOX_ADMINISTRATOR_MEMBERS', 'Member admin');
define('BOX_ADMINISTRATOR_MEMBER', 'Members');
define('BOX_ADMINISTRATOR_BOXES', 'File Access');
define('BOX_ADMINISTRATOR_UPGRADE', 'Upgrade System');
define('BOX_ADMIN_GROUPS', 'Admin Groups');
define('BOX_MERCHANT_INFO', 'Merchant Application');
define('BOX_PAYPAL_INFO', 'Paypal Signup');

// Filename defines for Admin Group Permissions - when file permission needed but not menu item.
define('FILE_GC_DASHBOARD', '</b>Google Checkout Dashboard<b>');
define('FILE_COUPON_RESTRICT', '</b>Coupon Restrict<b>');
define('FILE_VALID_PRODUCTS', '</b>Valid Products<b>');
define('FILE_VALID_CATEGORIES', '</b>Valid Categories<b>');
define('FILE_LIST_PRODUCTS', '</b>List Products<b>');
define('FILE_LIST_CATEGORIES', '</b>List Categories<b>');
define('FILE_TREE_VIEW', '</b>Treeview<b>');
define('FILE_BANNER_STATISTICS', '</b>Banner Statistics File<b>');
define('FILE_STOCK', '</b>Product Stock File<b>');
define('FILE_NEW_ATTRIBUTES_CONFIG', '</b>Attributes Config Variables<b>'); 
define('FILE_COMMON_REPORTS', '</b>Reports File<b>');
define('FILE_FEDEX', '</b>Fedex File<b>');
define('FILE_AFFILIATE', '</b>Affiliate File<b>');
define('FILE_FEEDMACHINE', '</b>Feedmachine File<b>');
define('FILE_EASYPOPULATE', '</b>Easypopulate File<b>');
define('FILE_ATTRIBUTE', '</b>Attributes File<b>');
define('FILE_DISCOUNT_CATEGORIES', '</b>Discount Categories File<b>');
define('FILE_CREATE_ACCOUNT', '</b>Create Account File<b>');
define('FILE_ORDER', '</b>Order File<b>');
define('FILE_PAYPAL', '</b>PayPal File<b>');
define('FILE_INFORMATION', '</b>Information Pages File<b>');

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
define('HTML_PARAMS','dir="ltr" lang="fr"');

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
define('HEADER_TITLE_SUPPORT_SITE', 'Supporter le site');
define('HEADER_TITLE_ONLINE_CATALOG', 'Boutique');
define('HEADER_TITLE_ADMINISTRATION', 'Administration');
define('HEADER_TITLE_OSCDOX', 'osCDox.com');
define('HEADER_TITLE_AABOX', 'osCmax');

// text for gender
define('MALE', 'Homme');
define('FEMALE', 'Femme');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configuration');
define('BOX_CONFIGURATION_GENERAL_SETTINGS', 'General Settings');
define('BOX_CONFIGURATION_MYSTORE', 'Mon magasin');
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

define('BOX_CONFIGURATION_GOOGLE', 'Google');
define('BOX_CONFIGURATION_GOOGLE_ANALYTICS', 'Google Analytics');
define('BOX_CONFIGURATION_GOOGLE_SITEMAP', 'Google SiteMaps');
define('BOX_CONFIGURATION_GOOGLE_MAPS', 'Google Maps');


// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Modules');
define('BOX_MODULES_PAYMENT', 'Paiement');
define('BOX_MODULES_SHIPPING', 'Livraisons');
define('BOX_MODULES_ORDER_TOTAL', 'Total commandes');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Magasin');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Cat&eacute;gories/Produits');
// BOF QPBPP for SPPC
define('BOX_CATALOG_CATEGORIES_DISCOUNT_CATEGORIES', 'Discount Categories');
// EOF QPBPP for SPPC
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Options de Produits');
define('BOX_CATALOG_MANUFACTURERS', 'Fabricants');
define('BOX_CATALOG_REVIEWS', 'Commentaires');
define('BOX_CATALOG_SPECIALS', 'Promotions');
define('BOX_CATALOG_SPECIALS_BY_CAT', 'Specials by category');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Produits &agrave; venir');
// 2 LINES ADDED - EasyPopulate and Attrib Manager
define('BOX_CATALOG_EASYPOPULATE', 'EasyPopulate');
define('BOX_CATALOG_ATTRIBUTE_MANAGER', 'Attribute Manager');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Clients');
define('BOX_CUSTOMERS_CUSTOMERS', 'Clients');
define('BOX_CUSTOMERS_ORDERS', 'Commandes');
// LINE ADDED - Edit customer order
define('BOX_CUSTOMERS_EDIT_ORDERS', 'Edit Orders');

// BOF: MOD - Separate Pricing Per Customer
define('BOX_CUSTOMERS_GROUPS', 'Customers Groups');
// EOF: MOD - Separate Pricing Per Customer
// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Lieux/Taxes');
define('BOX_TAXES_COUNTRIES', 'Pays');
define('BOX_TAXES_ZONES', 'R&eacute;gions');
define('BOX_TAXES_GEO_ZONES', 'Zones de taxation');
define('BOX_TAXES_TAX_CLASSES', 'Classes de taxation');
define('BOX_TAXES_TAX_RATES', 'Taux de taxation');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Rapports');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Produits consult&eacute;s');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Produits achet&eacute;s');
define('BOX_REPORTS_ORDERS_TOTAL', 'Meilleures commandes');
define('BOX_REPORTS_CREDITS', 'Customer Credits Report');
//++++ QT Pro: Begin Changed code
define('BOX_REPORTS_STATS_LOW_STOCK_ATTRIB', 'Stock Report');
//++++ QT Pro: End Changed Code
define('BOX_REPORTS_ADMIN_LOGGING', 'Admin Log');
define('BOX_REPORTS_CUST_LOGGING', 'Customer Log');
define('BOX_REPORTS_HTTP_ERROR', 'Http Error Log');
define('BOX_REPORTS_WISHLIST', 'Customer Wishlists');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Outils');
define('BOX_TOOLS_BACKUP', 'Sauvegarde');
define('BOX_TOOLS_BANNER_MANAGER', 'Gestion Banni&egrave;res');
// LINE ADDED: MOD - Batch Print Center
define('BOX_TOOLS_BATCH_CENTER', 'Batch Print Center');
define('BOX_TOOLS_CACHE', 'Gestion Cache');
define('BOX_TOOLS_QTPRODOCTOR', 'QTPro Doctor');
define('BOX_TOOLS_MAIL', 'Envoyer un mail');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Gestion Newsletter');
define('BOX_TOOLS_SERVER_INFO', 'Infos Serveur');
define('BOX_TOOLS_WHOS_ONLINE', 'Qui est en ligne?');
define('BOX_TOOLS_PACKAGING', 'Emballage');
define('BOX_TOOLS_UPS_BOXES_USED', 'UPS boîtes utilisées');
define('BOX_TOOLS_QUICK_LINKS', 'Liens rapides');
define('BOX_TOOLS_SLIDESHOW', 'Slideshow Images');
define('BOX_TOOLS_REGEN', 'Image Manager');

// localization box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Pays');
define('BOX_LOCALIZATION_CURRENCIES', 'Devises');
define('BOX_LOCALIZATION_LANGUAGES', 'Langues');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Statut commandes');
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
define('JS_ERROR', 'Une erreur est survenue durant le traitement de votre formulaire!\nVeuillez effectuer les corrections suivantes:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* Un prix doit être défini pour la nouvelle option de produit\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Un préfixe de prix doit être défini pour la nouvelle option de produit\n');

define('JS_PRODUCTS_NAME', '* Un nom doit être défini pour le nouveau produit\n');
define('JS_PRODUCTS_DESCRIPTION', '* Une description doit être définie pour le nouveau produit\n');
define('JS_PRODUCTS_PRICE', '* Un prix doit être défini pour le nouveau produit\n');
define('JS_PRODUCTS_WEIGHT', '* Un poids doit être défini pour le nouveau produit\n');
define('JS_PRODUCTS_QUANTITY', '* Une quantité doit être définie pour le nouveau produit\n');
define('JS_PRODUCTS_MODEL', '* Un nom de modèle doit être défini pour le nouveau produit\n');
define('JS_PRODUCTS_IMAGE', '* Une image doit être défini pour le nouveau produit\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Un nouveau prix doit être défini pour ce produit\n');

define('JS_GENDER', '* Le \'Sex\' doit être sélectionné.\n');
define('JS_FIRST_NAME', '* Le \'Prénom\' doit avoir au moins ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caractères.\n');
define('JS_LAST_NAME', '* Le \'Nom\' doit avoir au moins ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caractères.\n');
define('JS_EMAIL_ADDRESS', '* L \'Adresse email\' doit avoir au moins ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caractères.\n');
define('JS_ADDRESS', '* L \'Adresse\' doit avoir au moins ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caractères.\n');
define('JS_CITY', '* La \'Ville\' doit avoir au moins ' . ENTRY_CITY_MIN_LENGTH . ' caractères.\n');
define('JS_STATE_SELECT', '-- Sélectionnez ci-dessus --');
define('JS_COUNTRY', '* Le \'Pays\' doit être sélectionné.\n');
define('JS_TELEPHONE', '* Le \'Téléphone\' doit avoir au moins ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caractères.\n');
define('JS_PASSWORD', '* Le \'Mot de passe\' et sa \'Confirmation\' doivent avoir au moins ' . ENTRY_PASSWORD_MIN_LENGTH . ' caractères.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Le numéro de commande %s n\'existe pas&nbsp;!');

define('CATEGORY_PERSONAL', 'Personnel');
define('CATEGORY_ADDRESS', 'Addresse');
define('CATEGORY_CONTACT', 'Contact');
define('CATEGORY_COMPANY', 'Soci&eacute;t&eacute;');
define('CATEGORY_OPTIONS', 'Options');
define('CATEGORY_PASSWORD', 'Password');

define('ENTRY_GENDER', 'Genre&nbsp;:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">obligatoire</span>');
define('ENTRY_FIRST_NAME', 'Pr&eacute;nom&nbsp;:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caract&egrave;res</span>');
define('ENTRY_LAST_NAME', 'Nom&nbsp;:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caract&egrave;res</span>');
define('ENTRY_DATE_OF_BIRTH', 'Date de naissance&nbsp;:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(ex. 21/05/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'Adresse email&nbsp;:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caract&egrave;res</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">L\'adresse email ne semble pas valide&nbsp;!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Cette adresse email existe d&eacute;j&agrave;&nbsp;!</span>');
define('ENTRY_COMPANY', 'Soci&eacute;t&eacute;&nbsp;:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_STREET_ADDRESS', 'Adresse&nbsp;:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caract&egrave;res</span>');
define('ENTRY_SUBURB', 'Comp. adresse&nbsp;:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Code postal&nbsp;:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' caract&egrave;res</span>');
define('ENTRY_CITY', 'Ville&nbsp;:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' caract&egrave;res</span>');
define('ENTRY_STATE', 'Etat&nbsp;:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">obligatoire</span>');
define('ENTRY_COUNTRY', 'Pays&nbsp;:');
define('ENTRY_COUNTRY_TEXT', '&nbsp;<span class="errorText">*</span>');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'T&eacute;l&eacute;phone&nbsp;:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caract&egrave;res</span>');
define('ENTRY_FAX_NUMBER', 'Fax&nbsp;:');
define('ENTRY_FAX_NUMBER', 'Fax Number:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Newsletter&nbsp;:');
define('ENTRY_NEWSLETTER_YES', 's\'inscrire');
define('ENTRY_NEWSLETTER_NO', 'se d&eacute;sinscrire');
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
define('IMAGE_ANI_SEND_EMAIL', 'Envoyer un email');
define('IMAGE_BACK', 'Retour');
define('IMAGE_BACKUP', 'Sauvegarde');
define('IMAGE_CANCEL', 'Annuler');
define('IMAGE_CONFIRM', 'Valider');
define('IMAGE_COPY', 'Copier');
define('IMAGE_COPY_TO', 'Copier dans');
define('IMAGE_DEFINE', 'D&eacute;finir');
define('IMAGE_DELETE', 'Supprimer');
define('IMAGE_EDIT', 'Modifier');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_FILE_MANAGER', 'Gestionnaire de fichiers');
define('IMAGE_ICON_STATUS_GREEN', 'Actif');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Activer');
define('IMAGE_ICON_STATUS_RED', 'Inactif');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'D&eacute;sactiver');
define('IMAGE_ICON_INFO', 'Informamtion');
define('IMAGE_INSERT', 'Ins&eacute;rer');
define('IMAGE_LOCK', 'V&eacute;rouiller');
define('IMAGE_MODULE_INSTALL', 'Installer un module');
define('IMAGE_MODULE_REMOVE', 'Enlever un module');
define('IMAGE_MOVE', 'D&eacute;placer');
define('IMAGE_NEW_BANNER', 'Nouvelle banni&egrave;re');
define('IMAGE_NEW_CATEGORY', 'Nouvelle cat&eacute;gorie');
define('IMAGE_NEW_COUNTRY', 'Nouveau pays');
define('IMAGE_NEW_CURRENCY', 'Nouvelle devise');
define('IMAGE_NEW_FILE', 'Nouveau fichier');
define('IMAGE_NEW_FOLDER', 'Nouveau r&eacute;pertoire');
define('IMAGE_NEW_LANGUAGE', 'Nouvelle langue');
define('IMAGE_NEW_NEWSLETTER', 'Nouvelle newsletter');
define('IMAGE_NEW_PRODUCT', 'Nouveau produit');
define('IMAGE_NEW_TAX_CLASS', 'Nouvelle classe de taxation');
define('IMAGE_NEW_TAX_RATE', 'Nouveau taux de taxation');
define('IMAGE_NEW_TAX_ZONE', 'Nouvelle zone de taxation');
define('IMAGE_NEW_ZONE', 'Nouvelle r&eacute;gion');
define('IMAGE_ORDERS', 'Commandes');
define('IMAGE_ORDERS_INVOICE', 'Facture');
define('IMAGE_ORDERS_PACKINGSLIP', 'Bon d\'exp&eacute;dition');
define('IMAGE_PREVIEW', 'Aper&ccedil;u');
define('IMAGE_RESTORE', 'Restaurer');
define('IMAGE_RESET', 'Annuler');
define('IMAGE_SAVE', 'Enregistrer');
define('IMAGE_SEARCH', 'Rechercher');
define('IMAGE_SELECT', 'S&eacute;lectionner');
define('IMAGE_SEND', 'Envoyer');
define('IMAGE_SEND_EMAIL', 'Envoyer un email');
define('IMAGE_UNLOCK', 'D&eacute;verouiller');
define('IMAGE_UPDATE', 'Mettre &agrave; jour');
define('IMAGE_UPDATE_CURRENCIES', 'Mettre &agrave; jour le taux de change');
define('IMAGE_UPLOAD', 'T&eacute;l&eacute;charger');
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

define('ICON_CROSS', 'Faux');
define('ICON_CURRENT_FOLDER', 'R&eacute;pertoire courant');
define('ICON_DELETE', 'Supprimer');
define('ICON_ERROR', 'Erreur');
define('ICON_FILE', 'Fichier');
define('ICON_FILE_DOWNLOAD', 'T&eacute;l&eacute;chargement');
define('ICON_FOLDER', 'R&eacute;pertoire');
define('ICON_LOCKED', 'V&eacute;rouill&eacute;');
define('ICON_PREVIOUS_LEVEL', 'Niveau pr&eacute;c&eacute;dent');
define('ICON_PREVIEW', 'Aper&ccedil;u');
define('ICON_STATISTICS', 'Statistiques');
define('ICON_SUCCESS', 'Succ&egrave;s');
define('ICON_TICK', 'Vrai');
define('ICON_UNLOCKED', 'D&eacute;v&eacute;rouill&eacute;');
define('ICON_WARNING', 'Avertissement');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Page %s sur %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> banni&egrave;res)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> pays)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> clients)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> devises)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> langues)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> fabricants)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> newsletters)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> commandes)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> &eacute;tats de commande)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> produits)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> produits &agrave; venir)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> critiques de produit)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> promotions)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> classes de taxation)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> zones de taxation)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> taux de taxation)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> r&eacute;gions)');
define('TEXT_DISPLAY_NUMBER_OF_SHIPMENTS', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> les expéditions)');
define('TEXT_DISPLAY_NUMBER_OF_QUICK_LINKS', 'Voir de <b>%d</b> &agrave; <b>%d</b> (sur <b>%d</b> liens rapides)');
define('TEXT_DISPLAY_NUMBER_OF_PM_CONFIGURATION', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> modules)');
define('TEXT_DISPLAY_NUMBER_OF_SLIDESHOW', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> slides)');
define('TEXT_DISPLAY_NUMBER_OF_IMAGES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> images)');

//BOF: MOD - Catagories Discriptions
define('TEXT_EDIT_CATEGORIES_HEADING_TITLE', 'Category Heading Title:');
define('TEXT_EDIT_CATEGORIES_DESCRIPTION', 'Category Description:');
//EOF: MOD - Catagories Discriptions

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'd&eacute;faut');
define('TEXT_SET_DEFAULT', 'Par d&eacute;faut');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* obligatoire</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Erreur&nbsp;: Il n\'y a encore aucune devise par d&eacute;faut de d&eacute;finie. Veuillez en d&eacute;finir une &agrave;&nbsp;: Administration Outils->Localisation->Devises');

define('TEXT_CACHE_CATEGORIES', 'Cadre des cat&eacute;gories');
define('TEXT_CACHE_MANUFACTURERS', 'Cadre des fabricants');
define('TEXT_CACHE_ALSO_PURCHASED', 'Module des achats');

define('TEXT_NONE', '--aucun--');
define('TEXT_TOP', 'Haut');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Erreur&nbsp;: Le r&eacute;pertoire de destination n\'existe pas.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Erreur&nbsp;: Le r&eacute;pertoire de destination n\'est pas accessible en &eacute;criture.');
define('ERROR_FILE_NOT_SAVED', 'Erreur&nbsp;: Le fichier &agrave; t&eacute;l&eacute;charger n\'a pas &eacute;t&eacute; enregistr&eacute;.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Erreur&nbsp;: Le type du fichier &agrave; t&eacute;l&eacute;charger n\'est pas autoris&eacute;.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Succ&egrave;s&nbsp;: Le fichier &agrave; t&eacute;l&eacute;charger a &eacute;t&eacute; enregistr&eacute; avec succ&egrave;s.');
define('WARNING_NO_FILE_UPLOADED', 'Attention&nbsp;: Aucun fichier t&eacute;l&eacute;charg&eacute;.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Attention&nbsp;: Le t&eacute;l&eacute;chargement de fichiers a &eacute;t&eacute; d&eacute;sactiv&eacute; dans le fichier de configuration de php&nbsp;: php.ini.');

// LINE ADDED - XSell
define('BOX_CATALOG_XSELL_PRODUCTS', 'Cross Sell Products'); // X-Sell

// BOF: MOD - Article Manager
define('BOX_MENU_ARTICLES', 'Articles');
define('BOX_TOPICS_ARTICLES', 'Topics/Articles');
define('BOX_ARTICLES_CONFIG', 'Configuration articles');
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

// BOF osCmax Security
define('BOX_TOOLS_CHECK_PERMISSIONS', 'Check Permissions');
define('BOX_HEADING_SITEMONITOR', 'SiteMonitor'); //not used in osCmax 2.5 included for consistency
define('BOX_SITEMONITOR_ADMIN', 'Site Monitor Admin'); // used in the security menu
define('BOX_SITEMONITOR_CONFIG_SETUP', 'Site Monitor Configure');// used in the security menu
define('IMAGE_EXCLUDE', 'Exclude');
// EOF osCmax Security

?>