<?php
/*
$Id: german.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'de_DE'
// on FreeBSD try 'de_DE.ISO_8859-1'
// on Windows try 'de' or 'German'
@setlocale(LC_TIME, 'de_DE.ISO_8859-1');

define('DATE_FORMAT_SHORT', '%d.%m.%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A, %d. %B %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd.m.Y');  // this is used for strftime()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
}

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'EUR');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="LTR" lang="de"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Neues Konto');
define('HEADER_TITLE_MY_ACCOUNT', 'Ihr Konto');
define('HEADER_TITLE_CART_CONTENTS', 'Warenkorb');
define('HEADER_TITLE_CHECKOUT', 'Kasse');
define('HEADER_TITLE_TOP', 'Startseite');
define('HEADER_TITLE_CATALOG', 'Katalog');
define('HEADER_TITLE_LOGOFF', 'Abmelden');
define('HEADER_TITLE_LOGIN', 'Anmelden');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'Zugriffe seit');

// text for gender
define('MALE', 'Herr');
define('FEMALE', 'Frau');
define('MALE_ADDRESS', 'Herr');
define('FEMALE_ADDRESS', 'Frau');

// text for date of birth example
define('DOB_FORMAT_STRING', 'tt.mm.jjjj');

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Kategorien');

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Hersteller');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Neue Produkte');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Schnellsuche');
define('BOX_SEARCH_TEXT', 'Verwenden Sie Stichworte, um ein Produkt zu finden.');
define('BOX_SEARCH_ADVANCED_SEARCH', 'erweiterte Suche');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'Angebote');

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Bewertungen');
define('BOX_REVIEWS_WRITE_REVIEW', 'Bewerten Sie dieses Produkt!');
define('BOX_REVIEWS_NO_REVIEWS', 'Es liegen noch keine Bewertungen vor');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s von 5 Sternen!');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Warenkorb');
define('BOX_SHOPPING_CART_EMPTY', '0 Produkte');

// BOF: MOD - Wishlist 3.5
//wishlist box text in includes/boxes/wishlist.php 
define('BOX_HEADING_CUSTOMER_WISHLIST', 'My Wishlist'); 
define('TEXT_WISHLIST_COUNT', 'Currently %s items are on your Wish List.');
// EOF: MOD - Wishlist 3.5

// order_history box text in includes/boxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'Bestell&uuml;bersicht');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Bestseller');
define('BOX_HEADING_BESTSELLERS_IN', 'Bestseller<br>&nbsp;&nbsp;');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Benachrichtigungen');
define('BOX_NOTIFICATIONS_NOTIFY', 'Benachrichtigen Sie mich &uuml;ber Aktuelles zu diesem Artikel <b>%s</b>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'Benachrichtigen Sie mich nicht mehr zu diesem Artikel <b>%s</b>');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Hersteller Info');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', '%s Homepage');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Mehr Produkte');

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Sprachen');

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'W&auml;hrungen');

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Informationen');
define('BOX_INFORMATION_PRIVACY', 'Privatsph&auml;re<br>&nbsp;und Datenschutz');
define('BOX_INFORMATION_CONDITIONS', 'Unsere AGB\'s');
define('BOX_INFORMATION_SHIPPING', 'Liefer- und<br>&nbsp;Versandkosten');
define('BOX_INFORMATION_CONTACT', 'Kontakt');
// LINE ADDED: SITE MAP
define('BOX_INFORMATION_SITEMAP', 'Site Map');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Weiterempfehlen');
define('BOX_TELL_A_FRIEND_TEXT', 'Empfehlen Sie diesen Artikel einfach per eMail weiter.');

// LINE ADDED: MOD - allprods modification
define('BOX_INFORMATION_ALLPRODS', 'View All Items');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Versandinformationen');
define('CHECKOUT_BAR_PAYMENT', 'Zahlungsweise');
define('CHECKOUT_BAR_CONFIRMATION', 'Best&auml;tigung');
define('CHECKOUT_BAR_FINISHED', 'Fertig!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Bitte w&auml;hlen');
define('TYPE_BELOW', 'bitte unten eingeben');

// javascript messages
define('JS_ERROR', 'Notwendige Angaben fehlen!\nBitte richtig ausf&uml;llen.\n\n');

define('JS_REVIEW_TEXT', '* Der Text muss mindestens aus ' . REVIEW_TEXT_MIN_LENGTH . ' Buchstaben bestehen.\n');
define('JS_REVIEW_RATING', '* Geben Sie Ihre Bewertung ein.\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Bitte w�hlen Sie eine Zahlungsweise f�r Ihre Bestellung.\n');

define('JS_ERROR_SUBMITTED', 'Diese Seite wurde bereits best�tigt. Bet�tigen Sie bitte OK und warten bis der Prozess durchgef�hrt wurde.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Bitte w�hlen Sie eine Zahlungsweise f�r Ihre Bestellung.');

define('CATEGORY_COMPANY', 'Firmendaten');
define('CATEGORY_PERSONAL', 'Ihre pers&ouml;nlichen Daten');
define('CATEGORY_ADDRESS', 'Ihre Adresse');
define('CATEGORY_CONTACT', 'Ihre Kontaktinformationen');
define('CATEGORY_OPTIONS', 'Optionen');
define('CATEGORY_PASSWORD', 'Ihr Passwort');

define('ENTRY_COMPANY', 'Firmenname:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
// BOF: MOD - Separate Pricing Per Customer
define('ENTRY_COMPANY_TAX_ID', 'Company\'s tax id number:');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
define('ENTRY_COMPANY_TAX_ID_TEXT', '');
// EOF: MOD - Separate Pricing Per Customer
define('ENTRY_GENDER', 'Anrede:');
define('ENTRY_GENDER_ERROR', 'Bitte das Geschlecht angeben.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Vorname:');
define('ENTRY_FIRST_NAME_ERROR', 'Der Vorname sollte mindestens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Nachname:');
define('ENTRY_LAST_NAME_ERROR', 'Der Nachname sollte mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Geburtsdatum:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Bitte geben Sie Ihr Geburtsdatum in folgendem Format ein: TT.MM.JJJJ (z.B. 21.05.1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (z.B. 21.05.1970)');
define('ENTRY_EMAIL_ADDRESS', 'eMail-Adresse:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Die eMail Adresse sollte mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Die eMail Adresse scheint nicht g�ltig zu sein - bitte korrigieren.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Die eMail Adresse ist bereits gespeichert - bitte melden Sie sich mit dieser Adresse an oder er�ffnen Sie ein neues Konto mit einer anderen Adresse.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Strasse/Nr.:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Die Strassenadresse sollte mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', 'Stadtteil:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Postleitzahl:');
define('ENTRY_POST_CODE_ERROR', 'Die Postleitzahl sollte mindestens ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Ort:');
define('ENTRY_CITY_ERROR', 'Die Stadt sollte mindestens ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Bundesland:');
define('ENTRY_STATE_ERROR', 'Das Bundesland sollte mindestens ' . ENTRY_STATE_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_STATE_ERROR_SELECT', 'Bitte w�hlen Sie ein Bundesland aus der Liste.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'Land:');
define('ENTRY_COUNTRY_ERROR', 'Bitte w�hlen Sie ein Land aus der Liste.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Telefonnummer:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Die Telefonnummer sollte mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Telefaxnummer:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'abonniert');
define('ENTRY_NEWSLETTER_NO', 'nicht abonniert');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Passwort:');
define('ENTRY_PASSWORD_ERROR', 'Das Passwort sollte mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Beide eingegebenen Passw�rter m�ssen identisch sein.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Best&auml;tigung:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Current Password:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Das Passwort sollte mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_PASSWORD_NEW', 'New Password:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Das neue Passwort sollte mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Die Passwort-Best�tigung muss mit Ihrem neuen Passwort �bereinstimmen.');
define('PASSWORD_HIDDEN', '--VERSTECKT--');

define('FORM_REQUIRED_INFORMATION', '* Notwendige Eingabe');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Seiten:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'angezeigte Produkte: <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'angezeigte Bestellungen: <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'angezeigte Meinungen: <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'angezeigte neue Produkte: <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'angezeigte Angebote <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'erste Seite');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'vorherige Seite');
define('PREVNEXT_TITLE_NEXT_PAGE', 'n&auml;chste Seite');
define('PREVNEXT_TITLE_LAST_PAGE', 'letzte Seite');
define('PREVNEXT_TITLE_PAGE_NO', 'Seite %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Vorhergehende %d Seiten');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'N&auml;chste %d Seiten');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;ERSTE');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;vorherige]');
define('PREVNEXT_BUTTON_NEXT', '[n&auml;chste&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'LETZTE&gt;&gt;');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Neue Adresse');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Adressbuch');
define('IMAGE_BUTTON_BACK', 'Zur�ck');
define('IMAGE_BUTTON_BUY_NOW', 'Buy Now');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Adresse �ndern');
define('IMAGE_BUTTON_CHECKOUT', 'Kasse');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Bestellung best�tigen');
define('IMAGE_BUTTON_CONTINUE', 'Weiter');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Einkauf fortsetzen');
define('IMAGE_BUTTON_DELETE', 'L�schen');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Daten �ndern');
define('IMAGE_BUTTON_HISTORY', 'Bestell�bersicht');
define('IMAGE_BUTTON_LOGIN', 'Anmelden');
define('IMAGE_OUT_OF_STOCK', 'Nicht Verf�gbar');
define('IMAGE_BUTTON_IN_CART', 'In den Warenkorb');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Benachrichtigungen');
define('IMAGE_BUTTON_QUICK_FIND', 'Schnellsuche');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Benachrichtigungen l�schen');
define('IMAGE_BUTTON_REVIEWS', 'Bewertungen');
define('IMAGE_BUTTON_SEARCH', 'Suchen');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Versandoptionen');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Weiterempfehlen');
define('IMAGE_BUTTON_UPDATE', 'Aktualisieren');
define('IMAGE_BUTTON_UPDATE_CART', 'Warenkorb aktualisieren');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Bewertung schreiben');

define('SMALL_IMAGE_BUTTON_DELETE', 'Delete');
define('SMALL_IMAGE_BUTTON_EDIT', 'Edit');
define('SMALL_IMAGE_BUTTON_VIEW', 'View');

define('ICON_ARROW_RIGHT', 'Zeige mehr');
define('ICON_CART', 'In den Warenkorb');
define('ICON_ERROR', 'Fehler');
define('ICON_SUCCESS', 'Success');
define('ICON_WARNING', 'Warnung');

// BOF: MOD - CATALOG_PRODUCTS_WITH_IMAGES_mod
define('BOX_CATALOG_PRODUCTS_WITH_IMAGES', 'Printable Catalog');
define('IMAGE_BUTTON_UPSORT', 'Sort Asending');
define('IMAGE_BUTTON_DOWNSORT', 'Sort Desending');
// EOF: MOD - CATALOG_PRODUCTS_WITH_IMAGES_mod

//2 LINES ADDED: MOD - Down For Maintenance
define('TEXT_BEFORE_DOWN_FOR_MAINTENANCE', 'NOTICE: This website will be down for maintenance on: ');
define('TEXT_ADMIN_DOWN_FOR_MAINTENANCE', 'NOTICE: the website is currently Down For Maintenance to the public');

define('TEXT_GREETING_PERSONAL', 'Sch&ouml;n das Sie wieder da sind <span class="greetUser">%s!</span> M&ouml;chten Sie die <a href="%s"><u>neue Produkte</u></a> ansehen?');
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Wenn Sie nicht %s sind, melden Sie sich bitte <a href="%s"><u>hier</u></a> mit Ihrem Kundenkonto an.</small>');
define('TEXT_GREETING_GUEST', 'Herzlich Willkommen <span class="greetUser">Gast!</span> M&ouml;chten Sie sich <a href="%s"><u>anmelden</u></a>? Oder wollen Sie ein <a href="%s"><u>Kundenkonto</u></a> er&ouml;ffnen?');

define('TEXT_SORT_PRODUCTS', 'Sortierung der Artikel ist ');
define('TEXT_DESCENDINGLY', 'absteigend');
define('TEXT_ASCENDINGLY', 'aufsteigend');
define('TEXT_BY', ' nach ');

define('TEXT_REVIEW_BY', 'von %s');
define('TEXT_REVIEW_WORD_COUNT', '%s Worte');
define('TEXT_REVIEW_RATING', 'Bewertung: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Datum hinzugef&uuml;gt: %s');
define('TEXT_NO_REVIEWS', 'Es liegen noch keine Bewertungen vor.');

define('TEXT_NO_NEW_PRODUCTS', 'Zur Zeit gibt es keine neuen Produkte.');

define('TEXT_UNKNOWN_TAX_RATE', 'Unbekannter Steuersatz');

define('TEXT_REQUIRED', '<span class="errorText">erforderlich</span>');

// LINE ADDED: Country-State Selector
define ('DEFAULT_COUNTRY', '223');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>Fehler:</small> Die eMail kann nicht &uuml;ber den angegebenen SMTP-Server verschickt werden. Bitte kontrollieren Sie die Einstellungen in der php.ini Datei und f&uuml;hren Sie notwendige Korrekturen durch!</b></font>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Warnung: Das Installationverzeichnis ist noch vorhanden auf: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/install. Bitte l&ouml;schen Sie das Verzeichnis aus Gr&uuml;nden der Sicherheit!');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Warnung: osC kann in die Konfigurationsdatei schreiben: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php. Das stellt ein m&ouml;gliches Sicherheitsrisiko dar - bitte korrigieren Sie die Benutzerberechtigungen zu dieser Datei!');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Warnung: Das Verzeichnis f&uuml;r die Sessions existiert nicht: ' . tep_session_save_path() . '. Die Sessions werden nicht funktionieren bis das Verzeichnis erstellt wurde!');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Warnung: osC kann nicht in das Sessions Verzeichnis schreiben: ' . tep_session_save_path() . '. Die Sessions werden nicht funktionieren bis die richtigen Benutzerberechtigungen gesetzt wurden!');
define('WARNING_SESSION_AUTO_START', 'Warnung: session.auto_start ist enabled - Bitte disablen Sie dieses PHP Feature in der php.ini und starten Sie den WEB-Server neu!');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Warnung: Das Verzeichnis f�r den Artikel Download existiert nicht: ' . DIR_FS_DOWNLOAD . '. Diese Funktion wird nicht funktionieren bis das Verzeichnis erstellt wurde!');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'Das "G&uuml;ltig bis" Datum ist ung&uuml;ltig. Bitte korrigieren Sie Ihre Angaben.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Die "KreditkarteNummer", die Sie angegeben haben, ist ung&uuml;ltig. Bitte korrigieren Sie Ihre Angaben.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Die ersten 4 Ziffern Ihrer Kreditkarte sind: %s. Wenn diese Angaben stimmen, wird dieser Kartentyp leider nicht akzeptiert. Bitte korrigieren Sie Ihre Angaben gegebenfalls.');

define('FOOTER_TEXT_BODY', 'All content and Images Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a><br> Copyright &copy; 2000 - ' . date("Y") .  '<a href="http://oscmax.com"> osCMax</a><br>Powered by <a href="http://www.oscmax.com" target="_blank">' . PROJECT_VERSION . '</a>');

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
define('BOX_HEADING_LOGIN_BOX', 'Anmelden');
define('BOX_LOGINBOX_EMAIL', 'eMail-Adresse:');
define('BOX_LOGINBOX_PASSWORD', 'Passwort:');
define('BOX_LOGINBOX_TEXT_NEW', 'Ein neuer Kunde?');
define('BOX_LOGINBOX_NEW', 'ein Kundenkonto er�ffnen');
define('BOX_LOGINBOX_FORGOT_PASSWORD', '(vergessen)');
define('IMAGE_BUTTON_LOGIN', 'Anmelden');
define('BOX_HEADING_LOGIN_BOX_MY_ACCOUNT','Ihr Konto');
define('LOGIN_BOX_ACCOUNT_EDIT','Daten �ndern');
define('LOGIN_BOX_ACCOUNT_HISTORY','Get�tigten Bestellungen');
define('LOGIN_BOX_ADDRESS_BOOK','Pers�nliches Adressbuch');
define('LOGIN_BOX_PRODUCT_NOTIFICATIONS','Produktbenachrich-<br>tigungen');
define('LOGIN_BOX_MY_ACCOUNT','Pers�nlichen Daten');
define('LOGIN_BOX_LOGOFF','Abmeldung');
define('LOGIN_BOX_PRODUCTS_NEW','New Products');
// EOF: MOD - Login Box My Account

// BOF - MOD: CREDIT CLASS Gift Voucher Contribution
define('FILENAME_STATS_CREDITS', 'stats_credits.php');
require(DIR_WS_LANGUAGES . 'add_ccgvdc_german.php');
// EOF - MOD: CREDIT CLASS Gift Voucher Contribution
?>
