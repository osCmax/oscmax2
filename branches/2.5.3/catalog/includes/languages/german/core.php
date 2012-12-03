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
define('HEADER_TITLE_CREATE_ACCOUNT', 'Konto erstellen');
define('HEADER_TITLE_MY_ACCOUNT', 'Mein Konto');
define('HEADER_TITLE_CONTACT_US', 'Kontakt');
define('HEADER_TITLE_CART_CONTENTS', 'Warenkorb');
define('HEADER_TITLE_BASKET_CONTENTS', 'Warenkorb');
define('HEADER_TITLE_CHECKOUT', 'Kasse');
define('HEADER_TITLE_WISHLIST', 'Wunschliste');
define('HEADER_TITLE_TOP', 'Home');
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
define('BOX_HEADING_WHATS_NEW', 'Neuheiten');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Schnellsuche');
define('BOX_SEARCH_TEXT', '');
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
define('BOX_HEADING_CUSTOMER_WISHLIST', 'Wunschliste'); 
define('TEXT_WISHLIST_COUNT', 'Es befinden sich derzeit %s Produkte auf Ihrer Wunschliste.');

define('BOX_TEXT_PRICE', 'Preis:');
define('BOX_TEXT_PRODUCT', 'Produktbezeichnung');
define('BOX_TEXT_IMAGE', 'Bild');
define('BOX_TEXT_SELECT', 'Wählen Sie');
define('BOX_TEXT_VIEW', 'Anzeigen');
define('BOX_TEXT_HELP', 'Hilfe');
define('BOX_WISHLIST_EMPTY', '0 Produkte');
define('BOX_TEXT_NO_ITEMS', 'Es befinden sich derzeit keine Produkte auf Ihrer Wunschliste.');
// EOF: MOD - Wishlist 3.5

// order_history box text in includes/boxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'Bestellübersicht');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Bestseller');
define('BOX_HEADING_BESTSELLERS_IN', 'Bestseller in<br>&nbsp;&nbsp;');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Benachrichtigungen');
define('BOX_NOTIFICATIONS_NOTIFY', 'Benachrichtigen Sie mich über Neuigkeiten zu diesem Artikel <b>%s</b>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'Benachrichtigen Sie mich nicht mehr zu diesem Artikel <b>%s</b>');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Hersteller Info');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', '%s Homepage');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Weitere Produkte');

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Sprachen');

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'Währungen');

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Informationen');
define('BOX_INFORMATION_PRIVACY', 'Datenschutz');
define('BOX_INFORMATION_CONDITIONS', 'AGB');
define('BOX_INFORMATION_SHIPPING', 'Versandkosten');
define('BOX_INFORMATION_CONTACT', 'Kontakt');
// LINE ADDED: SITE MAP
define('BOX_INFORMATION_SITEMAP', 'Sitemap');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Weiterempfehlen');
define('BOX_TELL_A_FRIEND_TEXT', 'Empfehlen Sie dieses Produkt per E-Mail weiter.');

//MailChimp
define('BOX_HEADING_MAILCHIMP', 'Newsletter');
define('MAILCHIMP_INTRO_TEXT', 'Wenn Sie unseren Newsletter abonnieren möchten, geben Sie bitte Ihre E-Mail-Adresse an:');
define('MAILCHIMP_INTRO_TEXT_SUBSCRIBED', 'Sie haben unseren Newsletter derzeit abonniert');
define('MAILCHIMP_INTRO_TEXT_UNSUBSCRIBED', 'Wenn Sie unseren Newsletter abonnieren möchten, geben Sie bitte Ihre E-Mail-Adresse an:');
define('MAILCHIMP_EXISTING_USER_UNSUBSCRIBED', 'Sie haben unseren Newsletter derzeit <strong>nicht</strong> abonniert');
define('MAILCHIMP_HTML', 'HTML');
define('MAILCHIMP_TEXT', 'Text');
define('MAILCHIMP_MISSING_INTRO', 'Die Angaben in Ihren Mailchimp Einstellungen sind nicht vollständig. <br><br><b>Folgende Angaben fehlen:</b>');
define('MAILCHIMP_NEED_ENABLING', '<b>Bitte aktivieren Sie das Modul</b>');
define('MAILCHIMP_MISSING_API', 'API Key');
define('MAILCHIMP_MISSING_ID', 'List ID');
define('MAILCHIMP_MISSING_URL', 'List URL');
define('MAILCHIMP_MISSING_U', 'U value');
define('IMAGE_BUTTON_UNSUBSCRIBE', 'Abmelden');
define('IMAGE_BUTTON_SUBSCRIBE', 'Abonnieren');

// LINE ADDED: MOD - allprods modification
define('BOX_INFORMATION_ALLPRODS', 'Alle Produkte anzeigen');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Versandart');
define('CHECKOUT_BAR_PAYMENT', 'Zahlungsart');
define('CHECKOUT_BAR_CONFIRMATION', 'Bestätigung');
define('CHECKOUT_BAR_FINISHED', 'Einkauf abeschlossen!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Bitte wählen Sie');
define('PULL_DOWN_DEFAULT_DOTS', 'Bitte auswählen... ');
define('PULL_DOWN_NA', 'Keine Angabe');
define('TYPE_BELOW', 'Nachstehend eingeben');

// javascript messages
define('JS_ERROR', 'Notwendige Angaben fehlen! Bitte vervollständigen Sie die folgenden Angaben:');

define('JS_REVIEW_TEXT', '* Der Text muss mindestens aus ' . REVIEW_TEXT_MIN_LENGTH . ' Buchstaben bestehen.\n');
define('JS_REVIEW_RATING', '* Sie müssen das Produkt für Ihre Bewertung benoten.');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', 'Bitte wählen Sie eine Zahlungsart für Ihre Bestellung.\n');

define('JS_ERROR_SUBMITTED', 'Dieses Formular wurde bereits übermittelt. Klicken Sie auf OK und warten Sie, bis der Vorgang abgeschlossen wurde.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Bitte wählen Sie eine Zahlungsweise für Ihre Bestellung.');

define('CATEGORY_COMPANY', 'Firmendaten');
define('CATEGORY_PERSONAL', 'Ihre persönlichen Angaben');
define('CATEGORY_ADDRESS', 'Ihre Adresse');
define('CATEGORY_CONTACT', 'Ihre Kontaktinformationen');
define('CATEGORY_OPTIONS', 'Optionen');
define('CATEGORY_PASSWORD', 'Ihr Passwort');

define('ENTRY_COMPANY', 'Firmenname:');
define('ENTRY_COMPANY_ERROR', 'Bitte geben Sie Ihren Firmennamen an.');
define('ENTRY_COMPANY_TEXT', '*');
define('ENTRY_COMPANY_TAX_ID', 'UID Nummer:');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
define('ENTRY_COMPANY_TAX_ID_TEXT', '');
define('ENTRY_GENDER', 'Geschlecht:');
define('ENTRY_GENDER_ERROR', 'Bitte wählen Sie Ihr Geschlecht.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Vorname:');
define('ENTRY_FIRST_NAME_ERROR', 'Der Vorname muss mindestens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Nachname:');
define('ENTRY_LAST_NAME_ERROR', 'Der Nachname muss mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Geburtsdatum:');
// if you are looking for the DOB error message and * - look in locale.php
define('ENTRY_EMAIL_ADDRESS', 'E-Mail-Adresse:');
define('ENTRY_EMAIL_CONFIRMATION', 'E-Mail Confirmation:');
define('ENTRY_EMAIL_CONFIRMATION_TEXT', '*');
define('ENTRY_EMAIL_ERROR_NOT_MATCHING', 'The E-Mail Confirmation must match your E-Mail Address.');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Die E-Mail-Adresse muss mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Die E-Mail-Adresse scheint nicht gültig zu sein - bitte korrigieren.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Die E-Mail-Adresse ist bereits gespeichert - bitte melden Sie sich mit dieser Adresse an oder eröffnen Sie ein neues Konto mit einer anderen Adresse.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Straße/Nr.:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Die Straße muss mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_CITY', 'Ort:');
define('ENTRY_CITY_ERROR', 'Der Ort muss mindestens ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE_TEXT', '* (Wählen Sie zuerst ein Land)');
define('ENTRY_COUNTRY', 'Land:');
define('ENTRY_COUNTRY_ERROR', 'Bitte wählen Sie ein Land aus der Liste.');
define('ENTRY_COUNTRY_TEXT', '* (Die Seite wird nach einer Änderung aktualisiert)');
define('ENTRY_TELEPHONE_NUMBER', 'Telefonnummer:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Die Telefonnummer muss mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Telefaxnummer:');
define('ENTRY_FAX_NUMBER_ERROR', 'Bitte geben Sie Ihre Faxnummer an');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Abonniert');
define('ENTRY_NEWSLETTER_NO', 'Nicht abonniert');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Passwort:');
define('ENTRY_PASSWORD_ERROR', 'Das Passwort muss mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'Beide eingegebenen Passwörter müssen identisch sein.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Bestätigung:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Aktuelles Passwort:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Das Passwort muss mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_PASSWORD_NEW', 'Neues Passwort:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Das neue Passwort muss mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'Beide eingegebenen Passwörter müssen identisch sein.');
define('PASSWORD_HIDDEN', '*************');

define('FORM_REQUIRED_INFORMATION', '* Pflichtangabe');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Seiten:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', '<b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Produkten)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', '<b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Bestellungen)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', '<b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Bewertungen)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', '<b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> neuen Produkten)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', '<b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Sonderangeboten)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Erste Seite');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Vorherige Seite');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Nächste Seite');
define('PREVNEXT_TITLE_LAST_PAGE', 'Letzte Seite');
define('PREVNEXT_TITLE_PAGE_NO', 'Seite %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Vorherige %d Seiten');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Nächste %d Seiten');
define('PREVNEXT_BUTTON_FIRST', 'Angfang');
define('PREVNEXT_BUTTON_PREV', 'Vorige');
define('PREVNEXT_BUTTON_NEXT', 'Nächste');
define('PREVNEXT_BUTTON_LAST', 'Ende');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Adresse hinzufügen');
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
define('IMAGE_BUTTON_IN_CART', 'In den Warenkorb');
define('IMAGE_BUTTON_IN_BASKET', 'In den Warenkorb');
define('IMAGE_OUT_OF_STOCK', 'Ausverkauft');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Benachrichtigungen');
define('IMAGE_BUTTON_QUICK_FIND', 'Schnellsuche');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Benachrichtigungen löschen');
define('IMAGE_BUTTON_REVIEWS', 'Bewertungen');
define('IMAGE_BUTTON_SEARCH', 'Suchen');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Versandoptionen');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Weiterempfehlen');
define('IMAGE_BUTTON_UPDATE', 'Aktualisieren');
define('IMAGE_BUTTON_UPDATE_CART', 'Warenkorb aktualisieren');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Bewertung erstellen');
define('IMAGE_BUTTON_CFP', 'Preis auf Anfrage');
define('IMAGE_BUTTON_AAQ', 'Eine Frage zu diesem Artikel stellen');
define('IMAGE_BUTTON_MORE_INFO', 'Weitere Informationen');
define('IMAGE_BUTTON_REMOVE_PRODUCT', 'Artikel entfernen');
define('IMAGE_BUTTON_SEND', 'Senden');
define('IMAGE_BUTTON_WISHLIST_HELP', 'Hilfe Wunschliste');
define('IMAGE_BUTTON_WISHLIST', 'Wunschliste');

define('SMALL_IMAGE_BUTTON_DELETE', 'Löschen');
define('SMALL_IMAGE_BUTTON_EDIT', 'Bearbeiten');
define('SMALL_IMAGE_BUTTON_VIEW', 'Ansehen');

define('ICON_ARROW_RIGHT', 'mehr');
define('ICON_CLEAR_HISTORY', 'Historie löschen');
define('ICON_CART', 'In den Warenkorb');
define('ICON_ERROR', 'Fehler');
define('ICON_SUCCESS', 'Erfolg');
define('ICON_WARNING', 'Warnung');

// BOF: MOD - CATALOG_PRODUCTS_WITH_IMAGES_mod
define('BOX_CATALOG_PRODUCTS_WITH_IMAGES', 'Druckbarer Katalog');
define('IMAGE_BUTTON_UPSORT', 'Aufsteigend sortieren');
define('IMAGE_BUTTON_DOWNSORT', 'Absteigend sortieren');
// EOF: MOD - CATALOG_PRODUCTS_WITH_IMAGES_mod

//2 LINES ADDED: MOD - Down For Maintenance
define('TEXT_BEFORE_DOWN_FOR_MAINTENANCE', 'Hinweis: Diese Webseite wird wegen Wartungsarbeiten in diesem Zeitraum nicht erreichbar sein: ');
define('TEXT_ADMIN_DOWN_FOR_MAINTENANCE', 'Hinweis: Diese Website ist wegen Wartungsarbeiten derzeit nicht erreichbar');

define('TEXT_SORT_PRODUCTS', 'Produktsortierung ');
define('TEXT_DESCENDINGLY', 'absteigend');
define('TEXT_ASCENDINGLY', 'aufsteigend');
define('TEXT_BY', ' von ');

define('TEXT_REVIEW_BY', 'von %s');
define('TEXT_REVIEW_WORD_COUNT', '%s Worte');
define('TEXT_REVIEW_RATING', 'Benotung: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Hinzugefügt am: %s');
define('TEXT_NO_REVIEWS', 'Es liegen noch keine Bewertungen vor.');

define('TEXT_NO_NEW_PRODUCTS', 'Zur Zeit gibt es keine Produkte.');

define('TEXT_UNKNOWN_TAX_RATE', 'Unbekannter Steuersatz');

define('TEXT_REQUIRED', '<span class="errorText">Pflichtfeld</span>');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>TEP Fehler:</small> Die E-Mail kann nicht über den angegebenen SMTP-Server verschickt werden. Bitte kontrollieren Sie die Einstellungen in der php.ini Datei und führen Sie notwendige Korrekturen durch!</b></font>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Warnung: Das Installationverzeichnis ist noch vorhanden auf: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/install. Bitte löschen Sie das Verzeichnis aus Sicherheitsgründen!');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Warnung: Ihre Konfigurationsdatei ist beschreibbar: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php. Dies stellt ein mögliches Sicherheitsrisiko dar - bitte korrigieren Sie die Benutzerberechtigungen zu dieser Datei!');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Warnung: Das Sessions-Verzeichnis existiert nicht: ' . tep_session_save_path() . '. Sessions funktionieren nicht, solange das Verzeichnis nicht existiert!');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Warnung: Das Sessions-Verzeichnis ist schreibgeschützt: ' . tep_session_save_path() . '. Sessions funktionieren nicht, solange die richtigen Benutzerberechtigungen nicht gesetzt wurden!');
define('WARNING_SEO_PHP_VERSION_LOW', 'Warnung: Auf Ihrem Webserver läuft ' . PHP_VERSION . ' , welches inkompatibel für den Betrieb der SEO URLs ist. Bitte deaktivieren Sie dieses Modul, bis Sie Ihre Version von PHP aktualisiert haben.');
define('WARNING_SESSION_AUTO_START', 'Warnung: session.auto_start ist aktiviert - Bitte deaktivieren Sie dieses PHP Feature in der php.ini und starten Sie den Webserver neu!');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Warnung: Das Verzeichnis für den Artikel Download existiert nicht: ' . DIR_FS_DOWNLOAD . '. Der Artikeldownload funktioniert nicht, bis das Verzeichnis erstellt wurde!');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'Das Ablaufdatum dieser Kreditkarte ist ungültig. Bitte korrigieren Sie Ihre Angaben und versuchen Sie es erneut.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'Die Kreditkartennummer ist ungültig. Bitte korrigieren Sie Ihre Angaben und versuchen Sie es erneut.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Die ersten 4 Ziffern Ihrer Kreditkarte lauten: %s. Wenn diese Angaben stimmen, wird dieser Kartentyp leider nicht akzeptiert. Bitte korrigieren Sie Ihre Angaben gegebenfalls.');
define('WARNING_JAVASCRIPT_DISABLED', 'Achtung: In Ihrem Browser ist Javascript nicht aktiviert. Um alle Funktionen dieses Onlineshops fehlerfrei nutzen zu können, sollten Sie Javascript unbedingt aktivieren. Falls Sie dabei Hilfe benötigen, klicken Sie hier: <b>Google Suche</b>');
define('WARNING_IE6_DETECTED', 'Warnung: Sie verwenden Internet Explorer 6, dessen Technologie veraltet ist. Wir empfehlen Ihnen, auf einen <b>aktuellen Browser umzusteigen</b>.  Beliebte aktuelle Webbrowser sind zum Beispiel <a href="http://www.microsoft.com/germany/windows/internet-explorer/default.aspx"><b>Internet Explorer</b></a>, <a href="http://www.mozilla-europe.org/de/firefox/"><b>Firefox</b></a> oder <a href="www.google.com/chrome?hl=de"><b>Chrome</b></a>');

define('FOOTER_TEXT_BODY', 'Alle Rechte vorbehalten &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a><br> Copyright &copy; 2000 - ' . date("Y") .  '<a href="http://oscmax.com"> osCMax</a><br>Powered by <a href="http://www.oscmax.com" target="_blank">' . PROJECT_VERSION . '</a>');


// BOF: MOD - Checkout Without Account
define('IMAGE_BUTTON_CREATE_ACCOUNT', 'Konto erstellen');
define('NAV_ORDER_INFO', 'Bestellinfo');
// EOF: MOD - Checkout Without Account

// BOF: MOD - Article Manager
define('BOX_HEADING_ARTICLES', 'Artikel');
define('BOX_ALL_ARTICLES', 'Alle Artikel');
define('BOX_NEW_ARTICLES', 'Neue Artikel');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES', '<b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Artikeln)');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES_NEW', '<b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> neuen Artikeln)');
define('TABLE_HEADING_AUTHOR', 'Autor');
define('TABLE_HEADING_ABSTRACT', 'Inhaltsangabe');
define('BOX_HEADING_AUTHORS', 'Artikel nach Autor');
define('NAVBAR_TITLE_DEFAULT', 'Artikel');
// EOF: MOD - Article Manager

// BOF: MOD - Login Box My Account
define('BOX_HEADING_LOGIN_BOX', 'Anmelden');
define('BOX_LOGINBOX_EMAIL', 'E-Mail-Adresse:');
define('BOX_LOGINBOX_PASSWORD', 'Passwort:');
define('BOX_LOGINBOX_TEXT_NEW', 'Konto anlegen');
define('BOX_LOGINBOX_NEW', 'Konto anlegen');
define('BOX_LOGINBOX_FORGOT_PASSWORD', 'Passwort vergessen');
define('BOX_HEADING_LOGIN_BOX_MY_ACCOUNT','Mein Konto');
define('LOGIN_BOX_ACCOUNT_EDIT','Kontodaten');
define('LOGIN_BOX_ACCOUNT_HISTORY','Getätigten Bestellungen');
define('LOGIN_BOX_ADDRESS_BOOK','Adressbuch');
define('LOGIN_BOX_PASSWORD', 'Mein Passwort');
define('LOGIN_BOX_PRODUCT_NOTIFICATIONS','Produktbenachrichtigungen');
define('LOGIN_BOX_MY_ACCOUNT','Mein Konto');
define('LOGIN_BOX_LOGOFF','Abmelden');
define('LOGIN_BOX_PRODUCTS_NEW','Neue Produkte');
define('LOGIN_BOX_SPECIALS', 'Sonderangebote');
define('LOGIN_BOX_WISHLIST', 'Wunschliste');
define('LOGIN_BOX_NEWSLETTERS', 'Newsletter');
// EOF: MOD - Login Box My Account

// BOF: QPBPP for SPPC
define('MINIMUM_ORDER_NOTICE', 'Der Mindestbestellwert von %s beträgt %d. Der Inhalt Ihres Warenkorbes wurde entsprechend angepaßt.');
define('QUANTITY_BLOCKS_NOTICE', 'Von %s kann nur als ein Mehrfaches von %d bestellt werden. Der Inhalt Ihres Warenkorbes wurde entsprechend angepaßt.');
// EOF: QPBPP for SPPC

// BOF: Customer Comments contrib
define('SUCCESS_ORDER_UPDATED', 'Erfolg: Die Bestellung wurde erfolgreich aktualisiert.');
define('WARNING_ORDER_NOT_UPDATED', 'Warnung: Es liegen keine Änderungen vor. Ihre Bestellung wurde nicht aktualisiert.');
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
define('TEXT_RESTRICT_TO', 'Beschränke <b>%s</b> auf: %s und seine Unterwerte (falls vorhanden).');
// EOF: Extra Product Fields

// LINE ADDED: MOD - EASY CALL FOR PRICE v1.4
define('TEXT_CALL_FOR_PRICE', 'Preis auf Anfrage!');

// BOF: MSRP
define('TEXT_PRODUCTS_OUR_PRICE', '&nbsp;Unser&nbsp;Preis:&nbsp;');
define('TEXT_PRODUCTS_SALE', '&nbsp;BISHER:&nbsp;');
define('TEXT_PRODUCTS_SAVINGS', '&nbsp;Ihre&nbsp;Ersparnis:&nbsp;');
define('TEXT_PRODUCTS_PRICENOW', '&nbsp;JETZT:&nbsp;');
define('TEXT_PRODUCTS_USUALPRICE', '&nbsp;Unser Listenpreis:&nbsp;');
// EOF: MSRP

define('TEXT_LATEST_PRODUCTS', 'Neueste Produkte');
define('TEXT_SPECIALS', 'Sonderangebote');
define('TEXT_READ_MORE','Lesen Sie mehr...');

define('TEXT_MISSING_IMAGE','Leider ist derzeit keine Produktbild verfügbar');
define('TEXT_PAGE', 'Seite: ');

// Review Ratings
define('TEXT_RATING', 'Benotung: ');
define('TEXT_POOR', 'Nicht zufriedenstellend');
define('TEXT_FAIR', 'Ausreichend');
define('TEXT_AVERAGE', 'Durchschnittlich');
define('TEXT_GOOD', 'Gut');
define('TEXT_EXCELLENT', 'Ausgezeichnet');

// Password Text
define('PW_TOO_WEAK', 'Zu unsicher');
define('PW_WEAK', 'Unsicheres Passwort');
define('PW_NORMAL', 'Durchschnittlich sicher');
define('PW_STRONG', 'Sicheres Passwort');
define('PW_VERY_STRONG', 'Sehr sicheres Passwort');

// Product listing
define('TEXT_PRODUCT_NAME_AZ', 'Produktname (A-Z)');
define('TEXT_PRODUCT_NAME_ZA', 'Produktname (Z-A)');
define('TEXT_PRICE_LOW_HIGH', 'Preis (Niedrig - Hoch)');
define('TEXT_PRICE_HIGH_LOW', 'Preis (Hoch - Niedrig)');
define('TEXT_SHOW_ALL', 'Alles anzeigen');
define('TEXT_VIEW_AS_LIST', 'Listenansicht');
define('TEXT_VIEW_AS_GRID', 'Gitteransicht');
define('TEXT_RESULTS_PAGE', 'Ergebnisse/Seite: ');
define('TEXT_SORT_ORDER', 'Sortierung: ');
define('TEXT_PRICE_BESTSELLER', 'Bestseller');

// Recent History
define('TEXT_LAST_VISITED_PRODUCTS', 'Angesehene Produkte');

// Question links to contact form - %20 = space - needed to maintain W3C compliance in URLs
define('TEXT_QUESTION_ABOUT', 'Anfrage%20zu:%20');
define('TEXT_QUESTION_MODEL', 'Art-Nr:');
define('TEXT_QUESTION_PRODUCT_ID', 'Produkt%20ID:');
define('TEXT_QUESTION_TYPE', 'Stellen%20%20Sie%20nachfolgend%20Ihre%20Frage:');
define('TEXT_QUESTION_PRICE_ENQUIRY', 'Preisanfrage');
define('TEXT_QUESTION_PRODUCT_NAME', 'Produktbezeichnung:');

define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG', 'HINWEIS: Downloads sind vor Bestätigung des Zahlungseinganges nicht verfügbar.');

define('TEXT_REPLACEMENT_SUGGESTION', 'Meinten Sie: ');

// BOF qpbpp
define('TEXT_PRICE_BREAKS', 'Ab');
define('TEXT_ON_SALE', '');
// EOF qpbpp

// BOF Show tax and Shipping near price
define('TAX_RATE_NEAR_PRICE_INC', 'Inkl. USt. von ');
define('TAX_RATE_NEAR_PRICE_EX', 'Exkl. USt. von ');
define('TEXT_SHIPPING_NEAR_PRICE', 'Versandkosten');
// EOF Show tax and Shipping near price

// BOF Customers extra fields
define('ENTRY_EXTRA_FIELDS_ERROR', 'Das Feld %s muss mindestens %d Zeichen enthalten');
define('CATEGORY_EXTRA_FIELDS', 'Weitere Informationen');
// EOF Customers extra fields   

// BOF reCaptcha
define('ENTRY_SECURITY_CHECK', 'Sicherheitsabfrage:');
define('ENTRY_SECURITY_CHECK_ERROR', 'Die Sicherheitsabfrage wurde nicht korrekt beantwortet. Bitte versuchen Sie es noch einmal.');
define('SECURITY_PROMPT', 'Bitte vervollständigen Sie die <b>Sicherheitsabfrage</b> auf der rechten Seite -->');
define('CATEGORY_RECAPTCHA', 'Sicherheitsabfrage');
define('ENTRY_RECAPTCHA', 'Sicherheitsabfrage:');
// EOF reCaptcha
?>