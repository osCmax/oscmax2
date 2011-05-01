<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Aktion wählen..');

define('BOX_TITLE_ORDERS', 'Bestellungen');
define('BOX_TITLE_STATISTICS', 'Statistik');

define('BOX_ENTRY_SUPPORT_SITE', 'Supportseite');
define('BOX_ENTRY_SUPPORT_FORUMS', 'Supportforum');
define('BOX_ENTRY_MAILING_LISTS', 'Mailinglisten');
define('BOX_ENTRY_BUG_REPORTS', 'Bugreporte');
define('BOX_ENTRY_FAQ', 'FAQ');
define('BOX_ENTRY_LIVE_DISCUSSIONS', 'Livediskussionen');
define('BOX_ENTRY_CVS_REPOSITORY', 'CVS Repository');
define('BOX_ENTRY_INFORMATION_PORTAL', 'Informationsportal');
define('BOX_ENTRY_OSCDOX', 'osCDox.com');
define('BOX_ENTRY_TEMPLATE_STORE', 'osCmax Templates');

define('BOX_ENTRY_AABOX', 'osCmax Hosting<br>$12.99/mo');
define('BOX_ENTRY_PAYPAL', 'Paypal Kontoanmeldung');
define('BOX_ENTRY_MERCHANT', 'Händlerkonto beantragen');
define('BOX_ENTRY_DOMAINS', 'Domains kaufen');
define('BOX_ENTRY_SSL', 'SSL Certifikat kaufen');

define('BOX_ENTRY_CUSTOMERS', 'Kunden:');
define('BOX_ENTRY_PRODUCTS', 'Produkte:');
define('BOX_ENTRY_REVIEWS', 'Bewertungen:');

define('BOX_CONNECTION_PROTECTED', 'Sie sind durch eine %s sichere SSL Verbindung geschützt.');
define('BOX_CONNECTION_UNPROTECTED', 'Sie sind <font color="#ff0000">nicht</font> durch eine sichere SSL Verbindung gesichert.');
define('BOX_CONNECTION_UNKNOWN', 'unbekannt');

define('CATALOG_CONTENTS', 'Inhalt');

define('REPORTS_PRODUCTS', 'Produkte');
define('REPORTS_ORDERS', 'Bestellungen');

define('TOOLS_BACKUP', 'Datensicherung');
define('TOOLS_BANNERS', 'Bannerverwaltung');
define('TOOLS_FILES', 'Dateiverwaltung');

define('TEXT_TAB1', 'Verkäufe');
define('TEXT_TAB2', 'Produkte');
define('TEXT_TAB3', 'Admin Log');
define('TEXT_TAB4', 'Kunde Log');
define('TEXT_TAB5', 'HTTP Fehler Log');
define('TEXT_TAB6', 'System');

define('VIEW_COMPLETE_REPORT', 'Gesamten Bericht anzeigen');

define('DASHBOARD_IP', 'IP Adresse');
define('DASHBOARD_NO', 'Nr.');
define('DASHBOARD_TIME', 'Datum und Zeit');
define('DASHBOARD_USER', 'Benutzer ID');
define('DASHBOARD_EVENT', 'Ereignistyp');
define('DASHBOARD_RANK', 'Rang');
define('DASHBOARD_PRODUCT', 'Produkt');
define('DASHBOARD_QUANTITY', 'Anzahl');
define('DASHBOARD_VIEWED', 'Besuchte Produkte');

define('DASHBOARD_TOP_TEN', 'Top Ten Kunden');
define('DASHBOARD_TOP_TEN_CUSTOMER', 'Kundenname');
define('DASHBOARD_TOP_TEN_TOTAL', 'Gesamt');

define('DASHBOARD_ORDERS', 'Bestellungen derzeit');
define('DASHBOARD_ORDERS_STATUS', 'Bestellstatus');

define('DASHBOARD_DATABASE', 'Datenbank derzeit');
define('DASHBOARD_DATABASE_CUST', 'Kundenanzahl:');
define('DASHBOARD_DATABASE_PROD', 'Produktanzahl:');
define('DASHBOARD_DATABASE_SPEC', 'Sonderangebote:');


define('DASHBOARD_PRODUCTS_V', 'Besuchte Produkte');
define('DASHBOARD_PRODUCTS_V_VIEWS', 'Besuche');

define('DASHBOARD_PRODUCTS_P', 'Gekaufte Produkte');
define('DASHBOARD_PRODUCTS_P_PURCHASED', 'Gekauft');

define('DASHBOARD_HTTP_URL', 'URL');
define('DASHBOARD_HTTP_BROWSER', 'Browser');
define('DASHBOARD_HTTP_REFER', 'Referer');
define('DASHBOARD_HTTP_ERROR', 'Fehlertyp');


define('DASHBOARD_SYSTEM_CONFIG', 'Systemkonfiguration');
define('DASHBOARD_SYSTEM_SETUP', 'Systemeinrichtung');
define('DASHBOARD_PERMISSIONS', 'Berechtigungen & Sicherheit'); 

define('DASHBOARD_NO_ERRORS_DETECTED_CONFIG', 'Keine Fehler in Ihrer Systemkonfiguration gefunden.');
define('DASHBOARD_ALERT_ERRORS_DETECTED_CONFIG', ' Systemkonfigurationsfehler;');
define('DASHBOARD_ALERT_WARNINGS_DETECTED_CONFIG', ' Systemkonfigurationswarnung(en);');

define('DASHBOARD_NO_ERRORS_DETECTED_SETUP', 'Keine Fehler in Ihrer Systemeinrichtung gefunden.');
define('DASHBOARD_ALERT_ERRORS_DETECTED_SETUP', ' Systemeinrichtungsfehler; ');
define('DASHBOARD_ALERT_WARNINGS_DETECTED_SETUP', ' Systemeinrichtungswarnung(en); ');

define('DASHBOARD_NO_ERRORS_DETECTED_PERMISSION', 'Kein Fehler in Ihren Berechtigungen gefunden.');
define('DASHBOARD_ALERT_ERRORS_DETECTED_PERMISSION', ' Berechtigungsfehler; ');
define('DASHBOARD_ALERT_WARNINGS_DETECTED_PERMISSION', ' Berechtigungswarnung(en); ');

define('DASHBOARD_PWA_OPC_ERROR', 'Fehler: Sie haben <u><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=7575&cID=3069', 'NONSSL') . '">One Page Checkout</a></u> und <u><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=5&cID=1449', 'NONSSL') . '">Purchase Without Account</a></u> aktiviert.  Bitte deaktivieren Sie eines dieser Module.');
define('DASHBOARD_OPC_EMAIL_ERROR', 'Warnung: Sie haben One Page Checkout aktiviert, aber keine <u><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=7575&cID=3079', 'NONSSL') . '">Debug E-Mail-Adresse<a></u> hinterlegt.');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Fehler: Das Installationsverzeichnis befindet sich in: ' . (DIR_FS_CATALOG . 'install/') . '. Bitte entfernen Sie das Verzeichnis aus Sicherheitsgründen.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Fehler: Die Konfigurationsdatei: ' . (DIR_FS_CATALOG) . 'includes/configure.php ist beschreibbar. Dies ist ein potenzielles Sicherheitsrisiko - bitte ändern Sie die entsprechenden Berechtigungen dieser Datei.');
define('WARNING_ADMIN_CONFIG_FILE_WRITEABLE', 'Fehler: Die Konfigurationsdatei: ' . (DIR_FS_ADMIN) . 'includes/configure.php ist beschreibbar. Dies ist ein potenzielles Sicherheitsrisiko - bitte ändern Sie die entsprechenden Berechtigungen dieser Datei.');

define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Fehler: Das Sessions Verzeichnis existiert nicht: ' . tep_session_save_path() . '. Sessions funktionieren nicht, solange dieses Verzeichnis fehlt.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Warnung: Das Sessions Verzeichnis ist nicht beschreibbar: ' . tep_session_save_path() . '. Sessions funktionieren nicht, solange das Verzeichnis schreibgeschützt ist.');
define('WARNING_SEO_PHP_VERSION_LOW', 'Fehler: Auf Ihrem Webserver läuft ' . PHP_VERSION . ', was nicht ausreichend zum Betrieb der SEO URLs ist. Bitte deaktivieren Sie dieses Modul, bis Sie PHP aktualisiert haben.');
define('WARNING_SESSION_AUTO_START', 'Warnung: session.auto_start ist aktiviert - bitte deaktivieren Sie diese PHP Funktion in der php.ini und starten Sie den Webserver neu.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Warnung: Das Verzeichnis der herunterladbaren Produkte existiert nicht: ' . dirname(DIR_FS_CATALOG) . '/download. Die herunterladbaren Produkte werden nicht funktionieren, solange kein gültiges Verzeichnis existiert.');
define('WARNING_ADMIN_NOT_RENAMED', 'Warnung: Das admin-Verzeichnis wurde nicht umbenannt.  Dies ist ein potenzielles Sicherheitsrisiko. <u><a href="http://wiki.oscdox.com/v2.5/setting_up_security" target="_blank">Bitte lesen Sie dazu die Anleitung in der Wiki</a></u>.');
define('WARNING_PHP_FILES_IN_BIGIMAGES', 'Warnung: Es befinden sich Dateien in ' . DIR_FS_CATALOG . DYNAMIC_MOPICS_BIGIMAGES_DIR . ', die keine Bilder sind. Dies könnte auf eine Infizierung Ihres Servers durch bösartige Software hindeuten.');
define('WARNING_PHP_FILES_IN_PRODUCTS', 'Warnung: Es befinden sich Dateien in ' . DIR_FS_CATALOG . DYNAMIC_MOPICS_PRODUCTS_DIR . ', die keine Bilder sind. Dies könnte auf eine Infizierung Ihres Servers durch bösartige Software hindeuten.');
define('WARNING_PHP_FILES_IN_THUMBS', 'Warnung: Es befinden sich Dateien in ' . DIR_FS_CATALOG . DYNAMIC_MOPICS_THUMBS_DIR . ', die keine Bilder sind. Dies könnte auf eine Infizierung Ihres Servers durch bösartige Software hindeuten.');
define('DASHBOARD_AFFILIATE_EMAIL_ERROR', 'Warnung: Die Affiliate Infobox ist in Ihrem Shop aktiviert, aber Sie haben die Standard-E-Mail-Adresse nicht geändert. Bitte <u><a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=1&amp;cID=28', 'NONSSL') . '">deaktivieren Sie dieses Modul</a></u>, oder <u><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=35&amp;cID=1204&amp;action=edit', 'NONSSL') . '"> ändern Sie die E-Mail-Adresse</a></u>.');
?>