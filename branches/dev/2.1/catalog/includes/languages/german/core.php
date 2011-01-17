<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/


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
define('HEADER_TITLE_WISHLIST', 'Wunschliste');
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

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Kategorien');

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Hersteller');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Neue Artikel');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Schnellsuche');
define('BOX_SEARCH_TEXT', 'Verwenden Sie Stichworte, um ein Produkt zu finden.');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Erweiterte Suche');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'Sonderangebote');

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Bewertungen');
define('BOX_REVIEWS_WRITE_REVIEW', 'Bewerten Sie dieses Produkt!');
define('BOX_REVIEWS_NO_REVIEWS', 'Es liegen noch keine Bewertungen vor');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s von 5 Sternen!');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Warenkorb');
define('BOX_HEADING_SHOPPING_BASKET', 'Warenkorb');
define('BOX_SHOPPING_CART_EMPTY', '0 Produkte');

// BOF: MOD - Wishlist 3.5
//wishlist box text in includes/boxes/wishlist.php 
define('BOX_HEADING_CUSTOMER_WISHLIST', 'My Wishlist'); 
define('TEXT_WISHLIST_COUNT', 'Currently %s items are on your Wish List.');
define('BOX_TEXT_PRICE', 'Preis:');
define('BOX_TEXT_PRODUCT', 'Product Name');
define('BOX_TEXT_IMAGE', 'Image');
define('BOX_TEXT_SELECT', 'Select');
define('BOX_TEXT_VIEW', 'Anzeigen');
define('BOX_TEXT_HELP', 'Hilfe');
define('BOX_WISHLIST_EMPTY', '0 items');
define('BOX_TEXT_NO_ITEMS', 'Keine Produkte in Ihrer Wunschliste');
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
define('BOX_INFORMATION_PRIVACY', 'Datenschutz');
define('BOX_INFORMATION_CONDITIONS', 'Unsere AGB');
define('BOX_INFORMATION_SHIPPING', 'Liefer- und<br>&nbsp;Versandkosten');
define('BOX_INFORMATION_CONTACT', 'Kontakt');
// LINE ADDED: SITE MAP
define('BOX_INFORMATION_SITEMAP', 'Site Map');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Weiterempfehlen');
define('BOX_TELL_A_FRIEND_TEXT', 'Empfehlen Sie diesen Artikel per E-Mail weiter.');

//MailChimp
define('BOX_HEADING_MAILCHIMP', 'Newsletter');
define('MAILCHIMP_INTRO_TEXT', 'Wenn Sie unseren Newsletter abonnieren m&ouml;chten, so geben Sie bitte Ihre E-Mail-Adresse an:');
define('MAILCHIMP_INTRO_TEXT_SUBSCRIBED', 'Sie haben unseren Newsletter derzeit abonniert.');
define('MAILCHIMP_INTRO_TEXT_UNSUBSCRIBED', 'Wenn Sie unseren Newsletter abonnieren m&ouml;chten, so geben Sie bitte Ihre E-Mail-Adresse an:');
define('MAILCHIMP_HTML', 'HTML');
define('MAILCHIMP_TEXT', 'Text');
define('MAILCHIMP_MISSING_INTRO', 'Die Angaben in Ihren Mailchimp Einstellungen sind nicht vollst&auml;ndig. <br><br><b>Folgende Angaben fehlen:</b>');
define('MAILCHIMP_NEED_ENABLING', '<b>Bitte aktivieren Sie das Modul</b>');
define('MAILCHIMP_MISSING_API', 'API Key');
define('MAILCHIMP_MISSING_ID', 'List ID');
define('MAILCHIMP_MISSING_URL', 'List URL');
define('MAILCHIMP_MISSING_U', 'U value');

// LINE ADDED: MOD - allprods modification
define('BOX_INFORMATION_ALLPRODS', 'Alle Produkte anzeigen');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Versandart');
define('CHECKOUT_BAR_PAYMENT', 'Zahlungsart');
define('CHECKOUT_BAR_CONFIRMATION', 'Best&auml;tigung');
define('CHECKOUT_BAR_FINISHED', 'Einkauf abeschlossen!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Bitte w&auml;hlen');
define('TYPE_BELOW', 'bitte nachstehend eingeben');

// javascript messages
define('JS_ERROR', 'Notwendige Angaben fehlen!\nBitte richtig ausf&uml;llen.\n\n');

define('JS_REVIEW_TEXT', '* Der Text muss mindestens aus ' . REVIEW_TEXT_MIN_LENGTH . ' Buchstaben bestehen.\n');
define('JS_REVIEW_RATING', '* Geben Sie Ihre Bewertung ein.\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Bitte wählen Sie eine Zahlungsweise für Ihre Bestellung.\n');

define('JS_ERROR_SUBMITTED', 'Diese Seite wurde bereits bestätigt. Betätigen Sie bitte OK und warten bis der Prozess durchgeführt wurde.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Bitte wählen Sie eine Zahlungsweise für Ihre Bestellung.');

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
define('ENTRY_COMPANY_TAX_ID', 'UID Nummer:');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
define('ENTRY_COMPANY_TAX_ID_TEXT', '');
// EOF: MOD - Separate Pricing Per Customer
define('ENTRY_GENDER', 'Geschlecht:');
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
define('ENTRY_EMAIL_ADDRESS', 'E-Mail-Adresse:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Die E-Mail-Adresse sollte mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Die E-Mail-Adresse scheint nicht gültig zu sein - bitte korrigieren.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Die E-Mail-Adresse ist bereits gespeichert - bitte melden Sie sich mit dieser Adresse an oder eröffnen Sie ein neues Konto mit einer anderen Adresse.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Stra&szlig;e/Nr.:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Die Stra&szlig;enadresse sollte mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen enthalten.');
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
define('ENTRY_STATE_ERROR_SELECT', 'Bitte wählen Sie ein Bundesland aus der Liste.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'Land:');
define('ENTRY_COUNTRY_ERROR', 'Bitte wählen Sie ein Land aus der Liste.');
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
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Beide eingegebenen Passwörter müssen identisch sein.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Best&auml;tigung:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Aktuelles Passwort:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Das Passwort sollte mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_PASSWORD_NEW', 'New Password:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Das neue Passwort sollte mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Die Passwort-Bestätigung muss mit Ihrem neuen Passwort übereinstimmen.');
define('PASSWORD_HIDDEN', '--VERSTECKT--');

define('FORM_REQUIRED_INFORMATION', '* Notwendige Eingabe');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Seiten:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'angezeigte Artikel: <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'angezeigte Bestellungen: <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'angezeigte Meinungen: <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'angezeigte neue Artikel: <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'angezeigte Sonderangebote <b>%d</b> bis <b>%d</b> (von <b>%d</b> insgesamt)');

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
define('IMAGE_BUTTON_BACK', 'Zurück');
define('IMAGE_BUTTON_BUY_NOW', 'Jetzt kaufen');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Adresse ändern');
define('IMAGE_BUTTON_CHECKOUT', 'Kasse');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Bestellung durchführen');
define('IMAGE_BUTTON_CONTINUE', 'Weiter');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Einkauf fortsetzen');
define('IMAGE_BUTTON_DELETE', 'Löschen');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Konto ändern');
define('IMAGE_BUTTON_HISTORY', 'Bestellübersicht');
define('IMAGE_BUTTON_LOGIN', 'Anmelden');
define('IMAGE_OUT_OF_STOCK', 'Nicht lagernd');
define('IMAGE_BUTTON_IN_CART', 'In den Warenkorb');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Benachrichtigungen');
define('IMAGE_BUTTON_QUICK_FIND', 'Schnellsuche');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Benachrichtigungen löschen');
define('IMAGE_BUTTON_REVIEWS', 'Bewertungen');
define('IMAGE_BUTTON_SEARCH', 'Suchen');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Versandoptionen');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Weiterempfehlen');
define('IMAGE_BUTTON_UPDATE', 'Aktualisieren');
define('IMAGE_BUTTON_UPDATE_CART', 'Warenkorb aktualisieren');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Bewertung schreiben');
define('IMAGE_BUTTON_CFP', 'Preis auf Anfrage');
define('IMAGE_BUTTON_AAQ', 'Eine Frage zu diesem Artikel stellen');
define('IMAGE_BUTTON_MORE_INFO', 'Weitere Informationen');
define('IMAGE_BUTTON_REMOVE_PRODUCT', 'Artikel entfernen');

define('SMALL_IMAGE_BUTTON_DELETE', 'Löschen');
define('SMALL_IMAGE_BUTTON_EDIT', 'Ändern');
define('SMALL_IMAGE_BUTTON_VIEW', 'Ansehen');

define('ICON_ARROW_RIGHT', 'mehr');
define('ICON_CART', 'In den Warenkorb');
define('ICON_ERROR', 'Fehler');
define('ICON_SUCCESS', 'Erfolg');
define('ICON_WARNING', 'Warnung');

// BOF: MOD - CATALOG_PRODUCTS_WITH_IMAGES_mod
define('BOX_CATALOG_PRODUCTS_WITH_IMAGES', 'Druckbarer Katalog');
define('IMAGE_BUTTON_UPSORT', 'Aufsteigend sortieren');
define('IMAGE_BUTTON_DOWNSORT', 'Absteigend sortieren');
// EOF: MOD - CATALOG_PRODUCTS_WITH_IMAGES_mod

// LINE ADDED: Country-State Selector
define ('DEFAULT_COUNTRY', '223');

//2 LINES ADDED: MOD - Down For Maintenance
define('TEXT_BEFORE_DOWN_FOR_MAINTENANCE', 'Hinweis: Diese Webseite wird wegen Wartungsarbeiten in diesem Zeitraum nicht erreichbar sein: ');
define('TEXT_ADMIN_DOWN_FOR_MAINTENANCE', 'Hinweis: Diese Website ist wegen Wartungsarbeiten derzeit nicht erreichbar');

define('TEXT_SORT_PRODUCTS', 'Sortierung der Artikel ist ');
define('TEXT_DESCENDINGLY', 'absteigend');
define('TEXT_ASCENDINGLY', 'aufsteigend');
define('TEXT_BY', ' von ');

define('TEXT_REVIEW_BY', 'von %s');
define('TEXT_REVIEW_WORD_COUNT', '%s Worte');
define('TEXT_REVIEW_RATING', 'Bewertung: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'verfasst am %s');
define('TEXT_NO_REVIEWS', 'Es liegen noch keine Bewertungen vor.');

define('TEXT_NO_NEW_PRODUCTS', 'Zur Zeit gibt es keine neuen Produkte.');

define('TEXT_UNKNOWN_TAX_RATE', 'Unbekannter Steuersatz');

define('TEXT_REQUIRED', '<span class="errorText">erforderlich</span>');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>Fehler:</small> Die eMail kann nicht &uuml;ber den angegebenen SMTP-Server verschickt werden. Bitte kontrollieren Sie die Einstellungen in der php.ini Datei und f&uuml;hren Sie notwendige Korrekturen durch!</b></font>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Warnung: Das Installationverzeichnis ist noch vorhanden auf: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/install. Bitte l&ouml;schen Sie das Verzeichnis aus Sicherheitsgr&uuml;nden!');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Warnung: osC kann in die Konfigurationsdatei schreiben: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php. Das stellt ein m&ouml;gliches Sicherheitsrisiko dar - bitte korrigieren Sie die Benutzerberechtigungen zu dieser Datei!');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Warnung: Das Verzeichnis f&uuml;r die Sessions existiert nicht: ' . tep_session_save_path() . '. Die Sessions funktionieren nicht, solange das Verzeichnis nicht erstellt wurde!');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Warnung: osC kann nicht in das Sessions Verzeichnis schreiben: ' . tep_session_save_path() . '. Die Sessions funktionieren nicht, solange die richtigen Benutzerberechtigungen nicht gesetzt wurden!');
define('WARNING_SEO_PHP_VERSION_LOW', 'Warnung: Auf Ihrem Webserver ist ' . PHP_VERSION . ' installiert, welches nicht ausreichend für den Betrieb der SEO URLs ist. Bitte deaktivieren Sie dieses Modul, bis Sie Ihre Version von PHP aktualisiert haben.');
define('WARNING_SESSION_AUTO_START', 'Warnung: session.auto_start ist enabled - Bitte disablen Sie dieses PHP Feature in der php.ini und starten Sie den Webserver neu!');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Warnung: Das Verzeichnis für den Artikel Download existiert nicht: ' . DIR_FS_DOWNLOAD . '. Der Artikeldownload funktioniert nicht, bis das Verzeichnis erstellt wurde!');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'Das "G&uuml;ltig bis" Datum ist ung&uuml;ltig. Bitte korrigieren Sie Ihre Angaben.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Die Kreditkartennummer ist ung&uuml;ltig. Bitte korrigieren Sie Ihre Angaben.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Die ersten 4 Ziffern Ihrer Kreditkarte lauten: %s. Wenn diese Angaben stimmen, wird dieser Kartentyp leider nicht akzeptiert. Bitte korrigieren Sie Ihre Angaben gegebenfalls.');
define('WARNING_JAVASCRIPT_DISABLED', 'Achtung: In Ihrem Browser ist Javascript nicht aktiviert. Um diesen Onlineshop fehlerfrei nutzen zu k&ouml;nnen, sollten Sie Javascript unbedingt aktivieren. Falls Sie dabei Hilfe ben&ouml;tigen, klicken Sie hier: <b>Google Suche</b>');
define('WARNING_IE6_DETECTED', 'Achtung: Sie verwenden Internet Explorer 6, dessen Technologie veraltet ist. Wir empfehlen Ihnen, auf einen <b>aktuellen Browser umzusteigen</b>.  Beliebte aktuelle Webbrowser sind zum Beispiel <a href="http://www.microsoft.com/germany/windows/internet-explorer/default.aspx"><b>Internet Explorer</b></a>, <a href="http://www.mozilla-europe.org/de/firefox/"><b>Firefox</b></a> oder <a href="www.google.com/chrome?hl=de"><b>Chrome</b></a>');

define('FOOTER_TEXT_BODY', 'All content and Images Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a><br> Copyright &copy; 2000 - ' . date("Y") .  '<a href="http://oscmax.com"> osCMax</a><br>Powered by <a href="http://www.oscmax.com" target="_blank">' . PROJECT_VERSION . '</a>');

// BOF: MOD - Checkout Without Account
define('IMAGE_BUTTON_CREATE_ACCOUNT', 'Konto erstellen');
define('NAV_ORDER_INFO', 'Bestellinfo');
// EOF: MOD - Checkout Without Account

// BOF: MOD - Article Manager
define('BOX_HEADING_ARTICLES', 'Artikel');
define('BOX_ALL_ARTICLES', 'All Artikel');
define('BOX_NEW_ARTICLES', 'New Artikel');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Artikeln)');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES_NEW', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> neuen Artikeln)');
define('TABLE_HEADING_AUTHOR', 'Autor');
define('TABLE_HEADING_ABSTRACT', 'Inhaltsangabe');
define('BOX_HEADING_AUTHORS', 'Artikle vom Autor');
define('NAVBAR_TITLE_DEFAULT', 'Artikel');
// EOF: MOD - Article Manager

// BOF: MOD - Login Box My Account
define('BOX_HEADING_LOGIN_BOX', 'Anmelden');
define('BOX_LOGINBOX_EMAIL', 'E-Mail-Adresse:');
define('BOX_LOGINBOX_PASSWORD', 'Passwort:');
define('BOX_LOGINBOX_TEXT_NEW', 'Neues Konto anlegen');
define('BOX_LOGINBOX_NEW', 'Neues Konto anlegen');
define('BOX_LOGINBOX_FORGOT_PASSWORD', 'Passwort vergessen?');
define('BOX_HEADING_LOGIN_BOX_MY_ACCOUNT','Ihr Konto');
define('LOGIN_BOX_ACCOUNT_EDIT','Daten &auml;ndern');
define('LOGIN_BOX_ACCOUNT_HISTORY','Get&auml;tigten Bestellungen');
define('LOGIN_BOX_ADDRESS_BOOK','Adressbuch');
define('LOGIN_BOX_PRODUCT_NOTIFICATIONS','Produktbenachrichtigungen');
define('LOGIN_BOX_MY_ACCOUNT','Pers&ouml;nlichen Daten');
define('LOGIN_BOX_LOGOFF','Abmelden');
define('LOGIN_BOX_PRODUCTS_NEW','Neue Produkte');

define('LOGIN_BOX_SPECIALS', 'Sonderangebote');
define('LOGIN_BOX_WISHLIST', 'Wunschliste');
define('LOGIN_BOX_NEWSLETTERS', 'Newsletter');
// EOF: MOD - Login Box My Account

// BOF: QPBPP for SPPC
define('MINIMUM_ORDER_NOTICE', 'Der Mindestbestellmenge von %s betr&auml;gt %d. Der Inhalt Ihres Warenkorbes wurde entsprechend ge&auml;ndert.');
define('QUANTITY_BLOCKS_NOTICE', 'Von %s kann nur als ein Mehrfaches von %d bestellt werden. Der Inhalt Ihres Warenkorbes wurde entsprechend ge&auml;ndert.');
// EOF: QPBPP for SPPC

// BOF: Customer Comments contrib
define('SUCCESS_ORDER_UPDATED', 'Erfolg: Die Bestellung wurde erfolgreich ge&auml;ndert.');
define('WARNING_ORDER_NOT_UPDATED', 'Warnung: Es liegen keine &Auml;nderungen vor. Ihre Bestellung wurde nicht ver&auml;ndert.');
// EOF: Customer Comments contrib

// BOF: Open Featured Sets
define('OPEN_FEATURED_BOX_HEADING', 'Empfohlene Produkte');
define('OPEN_FEATURED_BOX_CATEGORY_HEADING', "Empfohlene Kategorien");
define('OPEN_FEATURED_BOX_MANUFACTURERS_HEADING', "Empfehlungen");
define('OPEN_FEATURED_BOX_MANUFACTURER_HEADING', "Empfehlungen");
define('OPEN_FEATURED_TABLE_HEADING_PRICE', ''); //Price: 
define('TEXT_MORE_INFO', 'mehr...');
// EOF: Open Featured Sets

// BOF: Extra Product Fields
define('TEXT_ANY_VALUE', 'Jeder Wert');
define('TEXT_RESTRICT_TO', 'Beschr&auml;nke <b>%s</b> auf: %s und seine Unterwerte (falls welche vorliegen).');
// EOF: Extra Product Fields

// LINE ADDED: MOD - EASY CALL FOR PRICE v1.4
define('TEXT_CALL_FOR_PRICE', 'Preis auf Anfrage!');

// BOF: MSRP
define('TEXT_PRODUCTS_OUR_PRICE', '&nbsp;Unser&nbsp;Preis:&nbsp;');
define('TEXT_PRODUCTS_SALE', '&nbsp;bisher:&nbsp;');
define('TEXT_PRODUCTS_SAVINGS', '&nbsp;Ihre&nbsp;Ersparnis:&nbsp;');
define('TEXT_PRODUCTS_PRICENOW', '&nbsp;Jetzt nur noch:&nbsp;');
define('TEXT_PRODUCTS_USUALPRICE', '&nbsp;Unser Listenpreis:&nbsp;');
// EOF: MSRP

define('TEXT_LATEST_PRODUCTS', 'Neueste Produkte');
define('TEXT_SPECIALS', 'Sonderangebote');
define('BOX_TEXT_REMOVE','Entfernen');

?>