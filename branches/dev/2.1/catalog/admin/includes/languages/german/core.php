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
define('HEADER_TITLE_ACCOUNT', 'Mein Konto/Passwort');
define('HEADER_TITLE_LOGOFF', 'Abmelden');

// Admin Account
define('BOX_HEADING_MY_ACCOUNT', 'Mein Konto');

// configuration box text in includes/boxes/administrator.php
define('BOX_HEADING_ADMINISTRATOR', 'Administrator');
define('BOX_ADMINISTRATOR_MEMBERS', 'Verwaltungsgruppen');
define('BOX_ADMINISTRATOR_MEMBER', 'Mitglieder');
define('BOX_ADMINISTRATOR_BOXES', 'Boxmenü');

// images
define('IMAGE_FILE_PERMISSION', 'Dateiberechtigungen');
define('IMAGE_GROUPS', 'Gruppenliste');
define('IMAGE_INSERT_FILE', 'Datei einfügen');
define('IMAGE_MEMBERS', 'Mitgliederliste');
define('IMAGE_NEW_GROUP', 'Neue Gruppe');
define('IMAGE_NEW_MEMBER', 'Neues Mitglied');
define('IMAGE_NEXT', 'Weiter');

// constants for use in tep_prev_next_display function
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Dateinamen)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Mitgliedern)');
// EOF: MOD - Admin w/levels

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'en_US'
// on FreeBSD 4.0 I use 'en_US.ISO_8859-1'
// this may not work under win32 environments..

////












































setlocale(LC_TIME, 'de_DE.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%d.%m.%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A, %d %B %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd.m.Y'); // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd.m.Y H:i:s'); // this is used for date()
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
define('DOB_FORMAT_STRING', 'tt.mm.jjjj');

define('JS_STATE', '* Das \'Bundesland\' muß ausgewählt werden.\n');
define('JS_DOB', '* Das \'Geburtsdatum\' muß dieses Format haben: tt.mm.jjjj.\n');
define('JS_ZONE', '* Das \'Bundesland\' muß aus der Liste dieses Landes ausgewählt werden.');
define('JS_POST_CODE', '* Die \'Postleitzahl\' mu&szlig; mindestens ' . ENTRY_POSTCODE_MIN_LENGTH . ' Stellen aufweisen.\n');

define('ENTRY_SUBURB', 'Adresszeile 2:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Postleitzahl:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(zB 21.05.1970)</span>');
define('ENTRY_DATE_OF_BIRTH_TEXT', '&nbsp;<span class="errorText">*</span>&nbsp;(zB 21.05.1970)');
define('ENTRY_STATE', 'Bundesland:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">notwendig</span>');




// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="de"');

// LINE ADDED: MOD -Separate Pricing per Customer
define('ENTRY_CUSTOMERS_GROUP_NAME', 'Kundengruppe:');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', PROJECT_VERSION);

// BOF: MOD - ORDER EDIT
// Create account & order
define('BOX_HEADING_MANUAL_ORDER', 'Manuelle Bestellungen');
define('BOX_MANUAL_ORDER_CREATE_ACCOUNT', 'Konto erstellen');
define('BOX_MANUAL_ORDER_CREATE_ORDER', 'Bestellung erstellen');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Bitte ausw&azml;hlen');
define('TYPE_BELOW', 'Nachstehend eingeben');

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Admin');
define('HEADER_TITLE_SUPPORT_SITE', 'osCmax Forum');
define('HEADER_TITLE_ONLINE_CATALOG', 'Katalog');
define('HEADER_TITLE_ADMINISTRATION', 'Admin');
define('HEADER_TITLE_OSCDOX', 'osCmax Benutzerhandbuch');
define('HEADER_TITLE_AABOX', 'osCmax');

// text for gender
define('MALE', 'Herr');
define('FEMALE', 'Frau');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Einstellungen');
define('BOX_CONFIGURATION_GENERAL_SETTINGS', 'Grundeinstellungen');
define('BOX_CONFIGURATION_MYSTORE', 'Mein Shop');
define('BOX_CONFIGURATION_LOGGING', 'Logging');
define('BOX_CONFIGURATION_CACHE', 'Cache');

// BOF: Added for super-friendly admin menu:
define('BOX_CONFIGURATION_MIN_VALUES', 'Mindestwerte');
define('BOX_CONFIGURATION_MAX_VALUES', 'Höchstwerte');
define('BOX_CONFIGURATION_IMAGES', 'Bilder');
define('BOX_CONFIGURATION_CUSTOMER_DETAILS', 'Kundendaten');
define('BOX_CONFIGURATION_SHIPPING', 'Versandart');
define('BOX_CONFIGURATION_PAGE_CACHE', 'Page Cache Einstellungen');
define('BOX_CONFIGURATION_PRODUCT_SETTINGS', 'Produkteinstellungen');
define('BOX_CONFIGURATION_PRODUCT_LISTING', 'Produktliste');
define('BOX_CONFIGURATION_PRODUCT_INFO', 'Produktinformation');
define('BOX_CONFIGURATION_PRODUCT_PRICE_BREAKS', 'Produkt Staffelpreise');
define('BOX_CONFIGURATION_EMAIL', 'E-Mail Optionen');
define('BOX_CONFIGURATION_DOWNLOAD', 'Download');
define('BOX_CONFIGURATION_GZIP', 'GZip Kompression');
define('BOX_CONFIGURATION_SESSIONS', 'Sessions');
define('BOX_CONFIGURATION_STOCK', 'Lager');
define('BOX_CONFIGURATION_MC', 'MailChimp Newsletter');
define('BOX_CONFIGURATION_WYSIWYG', 'CK Editor');
define('BOX_CONFIGURATION_TEMPLATES', 'Templates');
define('BOX_CONFIGURATION_TEMPLATE_SETUP', 'Templateeinstellungen');
define('BOX_CONFIGURATION_PAGE_MODULES', 'Seitenmodules');
define('BOX_CONFIGURATION_INFO_PAGES', 'Informationsseiten');
define('BOX_CONFIGURATION_WELCOME', 'Wilkommensnachricht');
define('BOX_CONFIGURATION_OFS', 'Empfehlungen');
define('BOX_CONFIGURATION_AFFILIATE', 'Affiliate');
define('BOX_CONFIGURATION_ACCOUNTS', 'Konten');
define('BOX_CONFIGURATION_MAINTENANCE', 'Seitenwartung');
define('BOX_CONFIGURATION_MOPICS', 'Dynamic MoPics');
define('BOX_CONFIGURATION_PRINT', 'Druckbarer Katalog');
define('BOX_CONFIGURATION_SEO', 'SEO URLs');
define('BOX_CONFIGURATION_SEO_URLS', 'SEO URLs');
define('BOX_CONFIGURATION_SEO_POPOUT', 'SEO Pop Out Menü');
define('BOX_CONFIGURATION_WISHLIST', 'Wunschlisteneinstellungen');
define('BOX_CONFIGURATION_EDITOR', 'Bestellungseditor');
define('BOX_CONFIGURATION_SEO_VALIDATION', 'SEO URL Überprüfung');
// EOF: Added for super-friendly admin menu:

define('BOX_CONFIGURATION_LOGGING_CACHE', 'Logging / Cache');
define('BOX_CONFIGURATION_USEFUL', 'Nützliche Links');
define('BOX_CONFIGURATION_OPC', 'One Page Checkout');
define('BOX_CONFIGURATION_CORNER_BANNERS', 'Eckbanner');
define('BOX_CONFIGURATION_CONTACT', 'Kontaktformular');
define('BOX_CONFIGURATION_RECAPTCHA', 'reCaptcha Formular');
define('BOX_CONFIGURATION_NOTIFICATIONS', 'Benachrichtigungen');
define('BOX_CONFIGURATION_SLIDESHOW', 'Diashow');
define('BOX_CONFIGURATION_SLIDESHOW_SETTINGS', 'Diashoweinstellungen');

define('BOX_CONFIGURATION_GOOGLE', 'Google');
define('BOX_CONFIGURATION_GOOGLE_ANALYTICS', 'Google Analytics');
define('BOX_CONFIGURATION_GOOGLE_SITEMAP', 'Google SiteMaps');
define('BOX_CONFIGURATION_GOOGLE_MAPS', 'Google Maps');


// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Module');
define('BOX_MODULES_PAYMENT', 'Zahlungsart');
define('BOX_MODULES_SHIPPING', 'Versandart');
define('BOX_MODULES_ORDER_TOTAL', 'Endsumme');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Katalog');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Kategorien/Produkte');
// BOF QPBPP for SPPC
define('BOX_CATALOG_CATEGORIES_DISCOUNT_CATEGORIES', 'Rabattkategorien');
// EOF QPBPP for SPPC
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Produktattribute');
define('BOX_CATALOG_MANUFACTURERS', 'Hersteller');
define('BOX_CATALOG_REVIEWS', 'Bewertungen');
define('BOX_CATALOG_SPECIALS', 'Sonderangebote');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Künftige Produkte');
// 2 LINES ADDED - EasyPopulate and Attrib Manager
define('BOX_CATALOG_EASYPOPULATE', 'EasyPopulate');
define('BOX_CATALOG_ATTRIBUTE_MANAGER', 'Attributmanager');

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Kunden');
define('BOX_CUSTOMERS_CUSTOMERS', 'Kunden');
define('BOX_CUSTOMERS_ORDERS', 'Bestellungen');
// LINE ADDED - Edit customer order
define('BOX_CUSTOMERS_EDIT_ORDERS', 'Bestellungen bearbeiten');

// BOF: MOD - Separate Pricing Per Customer
define('BOX_CUSTOMERS_GROUPS', 'Kundengruppen');
// EOF: MOD - Separate Pricing Per Customer
// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Gebiet / Steuern');
define('BOX_TAXES_COUNTRIES', 'Länder');
define('BOX_TAXES_ZONES', 'Bundesländer');
define('BOX_TAXES_GEO_ZONES', 'Steuerzonen');
define('BOX_TAXES_TAX_CLASSES', 'Steuerklassen');
define('BOX_TAXES_TAX_RATES', 'Steuersätze');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Berichte');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Besuchte Produkte');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Gekaufte Produkte');
define('BOX_REPORTS_ORDERS_TOTAL', 'Gesamtumsätze');
define('BOX_REPORTS_CREDITS', 'Guthaben');
//++++ QT Pro: Begin Changed code
define('BOX_REPORTS_STATS_LOW_STOCK_ATTRIB', 'Lagerstand');
//++++ QT Pro: End Changed Code
define('BOX_REPORTS_ADMIN_LOGGING', 'Admin Log');
define('BOX_REPORTS_CUST_LOGGING', 'Kunden Log');
define('BOX_REPORTS_HTTP_ERROR', 'Http Error Log');
define('BOX_REPORTS_WISHLIST', 'Wunschlisten');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Werkzeuge');
define('BOX_TOOLS_BACKUP', 'Datenbanksicherung');
define('BOX_TOOLS_BANNER_MANAGER', 'Banner Manager');
// LINE ADDED: MOD - Batch Print Center
define('BOX_TOOLS_BATCH_CENTER', 'Seriendruck Center');
define('BOX_TOOLS_CACHE', 'Cache Kontrolle');
define('BOX_TOOLS_QTPRODOCTOR', 'QTPro Doctor');
define('BOX_TOOLS_MAIL', 'E-Mail senden');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Newsletter Manager');
define('BOX_TOOLS_SERVER_INFO', 'Server Info');
define('BOX_TOOLS_WHOS_ONLINE', 'Wer ist online');
define('BOX_TOOLS_PACKAGING', 'Packstücke');
define('BOX_TOOLS_UPS_BOXES_USED', 'UPS Sendungen');
define('BOX_TOOLS_QUICK_LINKS', 'Schnelllinks');
define('BOX_TOOLS_SLIDESHOW', 'Diashow Bilder');
define('BOX_TOOLS_REGEN', 'Bildermanager');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Lokalisierung');
define('BOX_LOCALIZATION_CURRENCIES', 'Währungen');
define('BOX_LOCALIZATION_LANGUAGES', 'Sprachen');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Bestellstatus');
define('BOX_PREMADE', 'Vorgefertigte Kommentare');

// affiliates box text in includes/boxes/affiliate.php
define('BOX_HEADING_AFFILIATES', 'Affiliates');

// vouchers box text in includes/boxes/gv_admin.php
define('BOX_HEADING_VOUCHERS', 'Gutscheine');

// ADDED 2 LINE- recover cart box text
define('BOX_REPORTS_RECOVER_CART_SALES', 'Wiederhergestellte Verkäufe');
define('BOX_TOOLS_RECOVER_CART', 'Warenkorb wiederherstellen');

// LINE ADDED - Monthly Tax-Sales totals
define('BOX_REPORTS_MONTHLY_SALES', 'Monatlicher Umsatz/Steuer');

// LINE ADDED - InfoBox Admin in includes/boxes/info_boxes.php
define('BOX_HEADING_BOXES', 'Infoboxen');

// javascript messages
define('JS_ERROR', 'Während der Verarbeitung des Formulares sind Fehler aufgetreten!\nBitte korrigieren Sie Folgendes:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* Das neue Produkt braucht eine Preisangabe\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* Das neue Produktattribut braucht ein Preisvorzeichen\n');

define('JS_PRODUCTS_NAME', '* Das neue Produkt braucht einen Namen\n');
define('JS_PRODUCTS_DESCRIPTION', '* Das neue Produkt braucht eine Beschreibung\n');
define('JS_PRODUCTS_PRICE', '* Das neue Produkt braucht eine Preisangabe\n');
define('JS_PRODUCTS_WEIGHT', '* Das neue Produkt braucht eine Gewichtsangabe\n');
define('JS_PRODUCTS_QUANTITY', '* Das neue Produkt braucht eine Gewichtsangabe\n');
define('JS_PRODUCTS_MODEL', '* Das neue Produkt braucht eine Artikelnummer\n');
define('JS_PRODUCTS_IMAGE', '* Das neue Produkt braucht ein Bild\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Für dieses Produkt muß ein neuer Preis angegeben werden\n');

define('JS_GENDER', '* Das \'Geschlecht\' muß ausgewählt werden.\n');
define('JS_FIRST_NAME', '* Der \'Vorname\' muß mindestens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen enthalten.\n');
define('JS_LAST_NAME', '* Der \'Nachname\' muß mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen enthalten.\n');
define('JS_EMAIL_ADDRESS', '* Die \'E-Mail-Adresse\' muß mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen enthalten.\n');
define('JS_ADDRESS', '* Die \'Straße\' muß mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen enthalten.\n');
define('JS_CITY', '* Der \'Ort\' muß mindestens ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen enthalten.\n');
define('JS_STATE_SELECT', '-- Oben auswählen --');
define('JS_COUNTRY', '* Ein \'Land\' muß ausgewählt werden.\n');
define('JS_TELEPHONE', '* Die \'Telefonnnummer\' muß mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen enthalten.\n');
define('JS_PASSWORD', '* Das \'Passwort\' und die \'Bestätigung\' muß übereinstimmen und mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen enthalten.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Bestellnummer %s existiert nicht!');

define('CATEGORY_PERSONAL', 'Name/E-Mail-Adresse');
define('CATEGORY_ADDRESS', 'Adresse');
define('CATEGORY_CONTACT', 'Kontakt');
define('CATEGORY_COMPANY', 'Firma');
define('CATEGORY_OPTIONS', 'Optionen');
define('CATEGORY_PASSWORD', 'Passwort');

define('ENTRY_GENDER', 'Geschlecht:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">*</span>');
define('ENTRY_GENDER_TEXT', '&nbsp;&nbsp;<span class="errorText">*</span>');
define('ENTRY_FIRST_NAME', 'Vorname:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_FIRST_NAME_TEXT', '&nbsp;<span class="errorText">*</span>');
define('ENTRY_LAST_NAME', 'Nachname:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_LAST_NAME_TEXT', '&nbsp;<span class="errorText">*</span>');
define('ENTRY_DATE_OF_BIRTH', 'Geburtsdatum:');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail-Adresse:');
define('ENTRY_EMAIL_ADDRESS_TEXT' ,'&nbsp;<span class="errorText">*</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">Diese E-Mail-Adresse ist nicht gültig!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Diese E-Mail-Adresse existiert bereits!</span>');
define('ENTRY_COMPANY', 'Firmenname:');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_COMPANY_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_COMPANY_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_STREET_ADDRESS', 'Straße:');
define('ENTRY_STREET_ADDRESS_TEXT', '&nbsp;<span class="errorText">*</span>');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_CITY', 'Ort:');
define('ENTRY_CITY_TEXT', '&nbsp;<span class="errorText">*</span>');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_COUNTRY', 'Land:');
define('ENTRY_COUNTRY_TEXT', '&nbsp;<span class="errorText">*</span>');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Telefonnummer:');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '&nbsp;<span class="errorText">*</span>');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen</span>');
define('ENTRY_FAX_NUMBER', 'Fax Number:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_YES', 'Abonniert');
define('ENTRY_NEWSLETTER_NO', 'Nicht abonniert');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Passwort:');
define('ENTRY_PASSWORD_CONFIRMATION', 'Passwort bestätigen:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '&nbsp;<span class="errorText">*</span>');
define('ENTRY_PASSWORD_ERROR', '&nbsp;<small><font color="#FF0000">mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen</font></small>');
define('ENTRY_PASSWORD_TEXT', '&nbsp;<span class="errorText">*</span>');
define('PASSWORD_HIDDEN', '--VERSTECKT--');
// EOF: MOD - ORDER EDIT


// BOF: MOD - Separate Pricing Per Customer
define('ENTRY_COMPANY_TAX_ID', 'UID-Nummer:');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
define('ENTRY_CUSTOMERS_GROUP_REQUEST_AUTHENTICATION', 'Schalten Sie den Alarm für die Authentifizierung aus:');
define('ENTRY_CUSTOMERS_GROUP_RA_NO', 'Alarm aus');
define('ENTRY_CUSTOMERS_GROUP_RA_YES', 'Alarm ein');
define('ENTRY_CUSTOMERS_GROUP_RA_ERROR', '');
// EOF: MOD - Separate Pricing Per Customer



// images
define('IMAGE_ANI_SEND_EMAIL', 'E-Mail versenden');
define('IMAGE_BACK', 'Zurück');
define('IMAGE_BACKUP', 'Backup');
define('IMAGE_CANCEL', 'Abbrechen');
define('IMAGE_CONFIRM', 'Bestätigen');
define('IMAGE_COPY', 'Kopieren');
define('IMAGE_COPY_TO', 'Kopieren nach');
define('IMAGE_DETAILS', 'Details');
define('IMAGE_DELETE', 'Löschen');
define('IMAGE_EDIT', 'ändern');
define('IMAGE_EMAIL', 'E-Mail');
define('IMAGE_FILE_MANAGER', 'Datei Manager');
define('IMAGE_ICON_STATUS_GREEN', 'Aktiv');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Aktivieren');
define('IMAGE_ICON_STATUS_RED', 'Inaktiv');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Deaktivieren');
define('IMAGE_ICON_INFO', 'Info');
define('IMAGE_INSERT', 'Einfügen');
define('IMAGE_LOCK', 'Sperren');
define('IMAGE_MODULE_INSTALL', 'Modul installieren');
define('IMAGE_MODULE_REMOVE', 'Module entfernen');
define('IMAGE_MOVE', 'Verschieben');
define('IMAGE_NEW_BANNER', 'Neuer Banner');
define('IMAGE_NEW_CATEGORY', 'Neue Kategorie');
define('IMAGE_NEW_COUNTRY', 'Neues Land');
define('IMAGE_NEW_CURRENCY', 'Neue Währung');
define('IMAGE_NEW_FILE', 'Neue Datei');
define('IMAGE_NEW_FOLDER', 'Neuer Ordner');
define('IMAGE_NEW_LANGUAGE', 'Neue Sprache');
define('IMAGE_NEW_NEWSLETTER', 'Neuer Newsletter');
define('IMAGE_NEW_PRODUCT', 'Neues Produkt');
define('IMAGE_NEW_TAX_CLASS', 'Neue Steuerklasse');
define('IMAGE_NEW_TAX_RATE', 'Neuer Steuersatz');
define('IMAGE_NEW_TAX_ZONE', 'Neue Steuerzone');
define('IMAGE_NEW_ZONE', 'Neue Zone');
define('IMAGE_ORDERS', 'Bestellungen');
define('IMAGE_ORDERS_INVOICE', 'Rechnung');
define('IMAGE_ORDERS_PACKINGSLIP', 'Packzettel');
define('IMAGE_PREVIEW', 'Vorschau');
define('IMAGE_RESTORE', 'Wiederherstellen');
define('IMAGE_RESET', 'Zurücksetzen');
define('IMAGE_SAVE', 'Speichern');
define('IMAGE_SEARCH', 'Suchen');
define('IMAGE_SELECT', 'Auswählen');
define('IMAGE_SEND', 'Senden');
define('IMAGE_SEND_EMAIL', 'E-mail versenden');
define('IMAGE_UNLOCK', 'Entsperren');
define('IMAGE_UPDATE', 'Aktualisieren');
define('IMAGE_UPDATE_CURRENCIES', 'Wechselkurs aktualisieren');
define('IMAGE_UPLOAD', 'Upload');
// BOF QPBPP for SPPC
define('IMAGE_SHOW_PRODUCTS', 'Zeige Produkte');
// EOF QPBPP for SPPC
// BOF Open Featured Sets
define('IMAGE_PICK_COLOR', 'Farbe auswählen');
// EOF Open Featured Sets
define('IMAGE_SETTINGS', 'Einstellungen');
define('IMAGE_SUMMARY', 'Zusammenfassung');
define('IMAGE_BROWSE', 'Browse');
define('IMAGE_MISSING', 'Fehlend');
define('IMAGE_ORPHANS', 'Verwaist');
define('IMAGE_REGENERATE_ALL', 'Alle Bilder zu diesem Produkt regenerieren');
define('IMAGE_REGENERATE_EVERYTHING', 'Alle Bilder regenerieren');
define('IMAGE_MC_SYNC', 'Mit MailChimp synchronisieren');

define('ICON_CROSS', 'Falsch');
define('ICON_CURRENT_FOLDER', 'Aktueller Ordner');
define('ICON_DELETE', 'Löschen');
define('ICON_ERROR', 'Fehler');
define('ICON_FILE', 'Datei');
define('ICON_FILE_DOWNLOAD', 'Herunterladen');
define('ICON_FOLDER', 'Ordner');
define('ICON_LOCKED', 'Gesperrt');
define('ICON_PREVIOUS_LEVEL', 'Vorherige Ebene');
define('ICON_PREVIEW', 'Vorschau');
define('ICON_STATISTICS', 'Statistiken');
define('ICON_SUCCESS', 'Erfolg');
define('ICON_TICK', 'Wahr');
define('ICON_UNLOCKED', 'Entsperrt');
define('ICON_WARNING', 'Warnung');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Seite %s von %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Banner)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Ländern)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Kunden)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Währungen)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Sprachen)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Herstellern)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Newsletter)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Bestellungen)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Bestellstatus)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Produkten)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> künftigen Produkten)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Produktbewertungen)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Sonderangeboten)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Steuerklassen)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Steuerzonen)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Steuersätzen)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Zonen)');
define('TEXT_DISPLAY_NUMBER_OF_SHIPMENTS', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Versendungen)');
define('TEXT_DISPLAY_NUMBER_OF_QUICK_LINKS', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> quick links)');
define('TEXT_DISPLAY_NUMBER_OF_PM_CONFIGURATION', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> modules)');
define('TEXT_DISPLAY_NUMBER_OF_SLIDESHOW', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> slides)');
define('TEXT_DISPLAY_NUMBER_OF_IMAGES', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> images)');

//BOF: MOD - Catagories Discriptions
define('TEXT_EDIT_CATEGORIES_HEADING_TITLE', 'Kategorieüberschrift:');
define('TEXT_EDIT_CATEGORIES_DESCRIPTION', 'Kategoriebeschreibung:');
//EOF: MOD - Catagories Discriptions

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'Standard');
define('TEXT_SET_DEFAULT', 'Als Standard speichern');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Erforderlich</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Fehler: Es ist keine Standardwährung ausgewählt. Bitte treffen Sie Ihre Auswahl im Administrationstool unter Lokalisierung/Währungen');

define('TEXT_CACHE_CATEGORIES', 'Kategorien Box');
define('TEXT_CACHE_MANUFACTURERS', 'Hersteller Box');
define('TEXT_CACHE_ALSO_PURCHASED', 'Auch gekauft Modul');

define('TEXT_NONE', 'Keine Angabe');
define('TEXT_TOP', 'Top');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Fehler: Ziel existiert nicht.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Fehler: Ziel ist schreibgeschützt.');
define('ERROR_FILE_NOT_SAVED', 'Fehler: Dateiupload wurde nicht gespeichert.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Fehler: Dateityp nicht zur/auml;ssig.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Erfolg: Dateiupload wurde gespeichert.');
define('WARNING_NO_FILE_UPLOADED', 'Warnung: Keine Datei geuploaded.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Warnung: Dateiuploads sind in der php.ini Konfigurationsdatei deaktiviert.');

// LINE ADDED - XSell
define('BOX_CATALOG_XSELL_PRODUCTS', 'Cross Sell Produkte'); // X-Sell

// BOF: MOD - Article Manager
define('BOX_HEADING_ARTICLES', 'Artikel');
define('BOX_TOPICS_ARTICLES', 'Themen/Artikel');
define('BOX_ARTICLES_CONFIG', 'Artikeleinstellungen');
define('BOX_ARTICLES_AUTHORS', 'Autoren');
define('BOX_ARTICLES_REVIEWS', 'Bewertungen');
define('BOX_ARTICLES_XSELL', 'Cross-Sell Artikel');
define('IMAGE_NEW_TOPIC', 'Neues Thema');
define('IMAGE_NEW_ARTICLE', 'Neuer Artikel');
define('TEXT_DISPLAY_NUMBER_OF_AUTHORS', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Autoren)');
// EOF: MOD - Article Manager

// BOF: MOD - FedEx
define('IMAGE_ORDERS_SHIP', 'Versende PaketShip Package');
define('IMAGE_ORDERS_FEDEX_LABEL','FedEx Versandetikett ansehen oder drucken');
define('IMAGE_ORDERS_TRACK','FedEx Sendung nachverfolgen');
define('IMAGE_ORDERS_CANCEL_SHIPMENT','FedEx Sendung stornieren');
define('BOX_SHIPPING_MANIFEST','FedEx Ladeliste');
// EOF: MOD - FedEx

// BOF: PHONE ORDER
define('BOX_PHONE_ORDER', 'Telefonische Bestellung');
// EOF: PHONE ORDER

// BOF: EXPORT CUSTOMERS TO CSV
define('BOX_CUSTOMERS_EXPORT', 'Kunden exportieren');
// EOF: EXPORT CUSTOMERS TO CSV

// BOF: Customers with purchases report
define('BOX_REPORTS_STATS_REGISTER_CUSTOMER_NO_PURCHASE', 'Kunden ohne Umsatz');
// EOF: Customers with purchases report

// BOF: Quicker Product Edit
define('IMAGE_ICON_EDIT', 'Schnelländerung');
// EOF: Quicker Product Edit

// BOF: Feed Machine
define('BOX_CATALOG_FEEDMACHINE', 'Feedmachine');
// EOF: Feed Machine

// BOF: Extra Product Fields
define('TEXT_NOT_APPLY', 'Nicht ausgewählt');
define('BOX_CATALOG_PRODUCTS_EXTRA_FIELDS', 'Produkt-Extrafelder');
define('BOX_CATALOG_PRODUCTS_EXTRA_VALUES', 'Produkt-Extrafeld-Werte');
// EOF: Extra Product Fields

// BOF: MSRP
define('TEXT_PRODUCTS_MSRP', '&nbsp;unverbindliche Preisempfehlung des Herstellers:&nbsp;');
define('TEXT_PRODUCTS_OUR_PRICE', '&nbsp;Unser&nbsp;Preis:&nbsp;');
define('TEXT_PRODUCTS_SALE', '&nbsp;Aktionspreis:&nbsp;');
define('TEXT_PRODUCTS_SAVINGS', '&nbsp;Ihre&nbsp;Ersparnis:&nbsp;');
define('TEXT_PRODUCTS_PRICE_MSRP', 'UVP:');
// EOF: MSRP

define('TEXT_YYYY_MM_DD', '(JJJJ-MM-TT)');

define('TEXT_RATING', 'Benotung: ');
define('TEXT_POOR', 'Nicht zufriedenstellend');
define('TEXT_FAIR', 'Ausreichend');
define('TEXT_AVERAGE', 'Durchschnittlich');
define('TEXT_GOOD', 'Gut');
define('TEXT_EXCELLENT', 'Ausgezeichnet');

define('BOX_HEADING_SECURITY', 'Sicherheit');
define('TEXT_PRODUCTS', 'Produkte');
define('TEXT_SEARCH', 'Suchen: ');
define('TEXT_WELCOME', ' Willkommen, ');

define('TEXT_WRONG_PASSWORD', 'Falsches Passwort');
define('TEXT_WRONG_USERNAME', 'Falscher Benutzername');
define('TEXT_LOGGED_IN', 'Angemeldet');
define('TEXT_LOGGED_OUT', 'Abgemeldet');
define('TEXT_CONFIG_CHANGE', 'Einstellungsänderung: ');
?>