<?php
/*
$Id: core.php 1267 2011-03-20 14:07:41Z cottonbarn $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('TEXT_OSCMAX_WEBSITE', 'osCmax Website');
define('TEXT_FORUM', 'Support');
define('TEXT_DOCUMENTATION', 'Dokumentation');
define('TEXT_WIKI', 'Wiki');
define('TEXT_FOOTER_DISCLAIMER', 'Die Verwendung von osCmax erfolgt ohne Gewähr und unterliegt der <a href="http://www.fsf.org/licenses/gpl.txt" target="_blank">GNU General Public License</a>.');

define('TAB_START', 'Start');
define('TAB_DATABASE_SERVER', 'Datenbankserver');
define('TAB_WEB_SERVER', 'Webserver');
define('TAB_STORE_SETTINGS', 'Shopeinstellungen');
define('TAB_FINISHED', 'Fertig');

define('TEXT_PHP_VERSION', 'PHP Version');
define('TEXT_PHP_SETTINGS', 'PHP Einstellungen');
define('TEXT_PHP_EXTENSIONS', 'PHP Erweiterungen');
define('TEXT_ON', 'On');
define('TEXT_OFF', 'Off');

define('IMAGE_CONTINUE', 'Fortsetzen');
define('IMAGE_CANCEL', 'Abbrechen');
define('IMGAE_RETRY', 'Wiederholen');
define('IMAGE_ADMIN', 'Verwaltungswerkzeug');
define('IMAGE_CATALOG', 'Catalog');

// Start Page
define('TEXT_WELCOME_TO_OSCMAX', 'Willkommen bei osCmax ');
define('TEXT_INDEX_MAIN_BLOCK', '<p>Mit osCmax können Sie weltweit Produkte über Ihren eigenen Online-Shop vertreiben. Verwalten Sie Produkte, Kunden, Bestellungen, Newsletter, Sonderangebote und mehr und führen Sie so Ihren Onlineshop zum Erfolg.</p>
  <p>osCmax basiert auf osCommerce Online Merchant 2.2 und macht die Entwicklung Ihrer Site schneller und einfacher als jemals zuvor. osCmax ist mit osCommerce Online Merchant 2.2 abwärtskompatibel. Somit profitieren Sie von der größten Community einer Shoplösung: Über 140.000 registrierte Shop-Betreiber und Entwickler geben Hilfestellung und haben über 4.000 Erweiterungen entwickelt, die die Funktionalität und das Potential Ihres Shops erweitern.</p>
  <p>osCmax und seine Erweiterungen sind kostenlos unter Verwendung einer Open-Source-Lizenz verfügbar, damit Sie schneller und ohne Einschränkungen oder Lizenzgebühren online verkaufen können.</p><p>&nbsp;</p><p>&nbsp;</p><br />');
define('TEXT_REGISTER_GLOBALS_ERROR', 'Die Kompatibilität mit register_globals wird seit PHP 4.3+ unterstützt. Diese Einstellung <u>muss aktiviert werden</u>, da eine ältere PHP Version verwendet wird.');
define('TEXT_PERMISSIONS_ERROR', '<p>Der Webserver kann die Installationsparameter nicht in seine Konfigurationsdateien speichern.</p><p>Bei den folgenden Dateien müssen die Zugriffsberechtigungen auf world-writeable (chmod 777) gesetzt werden:</p><p></p>');
define('TEXT_CORRECT_ERROR', '<p class="messageStackAlert">Bitte beheben Sie die rechts aufgelisteten Fehler und wiederholen Sie die Installation.</p>
');
define('TEXT_RESTART_WEB_SERVER_ERROR', '<p class="messageStackAlert"><i>Die Änderung von Webserver-Konfiguartionsparameter könnte den Neustart des Webserverdienstes erforderlich machen, damit die Änderungen wirksam werden.</i>');
define('TEXT_SERVER_SUCCESS', 'Die Webserverumgebung wurde überprüft, damit Ihr Onlineshop erfolgreich installiert und konfiguriert werden kann.<br /><br />Sie können nun mit dem Installationsvorgang beginnen.');

// Step 1 - Database Server
define('TEXT_DATABASE_SERVER_BLOCK', '<p>Der Datenbankserver speichert den Inhalt des Shops, wie etwa Produktdaten, Kundendaten und getätigte Bestellungen.</p><p>Bitte kontaktieren Sie Ihren Serveradministrator, falls Ihnen die Datenbankserver-Parameter nicht bekannt sind.</p>');
define('TEXT_DATABASE_SERVER', 'Datenbankserver');
define('TEXT_DATABASE_SERVER_DESC', 'Die Adresse des Datenbankservers als Hostname oder IP-Adresse.');
define('TEXT_DATABASE_USERNAME', 'Benutzername');
define('TEXT_DATABASE_USERNAME_DESC', 'Der Benutzername wird zur Verbindungsaufnahme mit dem Datenbankserver benötigt.');
define('TEXT_DATABASE_PASSWORD', 'Passwort');
define('TEXT_DATABASE_PASSWORD_DESC', 'Das Passwort wird zur Verbindungsaufnahme mit dem Datenbankserver benötigt.');
define('TEXT_DATABASE_NAME', 'Datenbankname');
define('TEXT_DATABASE_NAME_DESC', 'Diese Datenbank wird die Shopdaten speichern.');
define('TEXT_DATABASE_SUCCESS', 'Datenbank erfolgreich importiert.');
define('TEXT_DATABASE_IMPORTING', 'Die Datenbankstruktur wird jetzt importiert. Bitte unterbrechen Sie diesen Vorgang nicht!');
define('TEXT_DATABASE_PROBLEM', 'Beim Datenbankimport ist ein Fehler aufgetreten:<br><br>%s<br><br>Bitte überprüfen Sie die Verbindungsparameter und versuchen Sie es erneut.');
define('TEXT_DATBASE_CONNECTION_ERROR', 'Beim Verbindungsversuch mit dem Datenbankserver ist ein Fehler aufgetreten:<br><br>%s<br><br>Bitte überprüfen Sie die Verbindungsparameter und versuchen Sie es erneut.');
define('TEXT_TESTING_DATABASE', 'Die Verbindung zur Datenbank wird überprüft.');

// Step 2 - Web Server
define('TEXT_WEB_SERVER', '<p>Der Webserver liefert die Seiten Ihres Onlineshops an Besucher und Kunden aus. Die Webserverparameter stellen sicher, dass Ihre Seiten richtig verlinkt werden.</p>');
define('TEXT_WWW_ADDRESS', 'WWW Adresse');
define('TEXT_WEB_ADDRESS', 'Die Webadresse Ihres Onlineshops.');
define('TEXT_WEBSERVER_ROOT_DIR', 'Webserver-Wurzelverzeichnis');
define('TEXT_WEBSERVER_DIRECTORY', 'In dieses Serververzeichnis wird Ihr Onlineshop installiert.');

// Step 3 - Store Setup
define('TEXT_STORE_SETUP', '<p>Hier können Sie Angaben zum Namen Ihres Onlineshops oder Kontaktinformationen hinterlegen.</p><p>Der Administrator-Benutzername und das Passwort werden zur Anmeldung in den Administrations-Bereich benötigt.</p>');
define('TEXT_STORE_NAME', 'Shopname');
define('TEXT_STORE_NAME_DESC', 'Diese Information wird öffentlich angezeigt.');
define('TEXT_FIRST_NAME', 'Vorname des Shopbetreibers');
define('TEXT_FIRST_NAME_DESC', 'Diese Information wird öffentlich angezeigt.');
define('TEXT_LAST_NAME', 'Nachname des Shopbetreibers');
define('TEXT_LAST_NAME_DESC', 'Diese Information wird öffentlich angezeigt.');
define('TEXT_EMAIL', 'E-Mail-Adresse des Shopbetreibers');
define('TEXT_EMAIL_DESC', 'Diese Information wird öffentlich angezeigt.');
define('TEXT_USERNAME', 'Benutzername des Administrators');
define('TEXT_USERNAME_DESC', 'Der Benutzername wird für den Zugang zum Administrations-Bereich benötigt.');
define('TEXT_PASSWORD', 'Administrator Passwort');
define('TEXT_PASSWORD_DESC', 'Das Passwort für das Administrator-Konto.');
define('TEXT_ADMIN_FOLDER_NAME', 'Verzeichnisname des Administrations-Bereiches');
define('TEXT_CHANGE_ADMIN_FOLDER', 'In diesem Verzeichnis befindet sich der Administrations-Bereich. Aus Sicherheitsgründen sollte der <b>Verzeichnisname unbedingt geändert werden</b>, da der standardmäßig verwendete Name <b>admin</b> unsicher ist. Weitere Informationen zum Thema Sicherheit finden Sie im <a href="http://wiki.oscdox.com/v2.5/setting_up_security" target="_blank">Wiki</a>.');
define('TEXT_ADMIN_NO_PERMISSION', 'Sie besitzen keine ausreichende Berechtigung, um das <b>admin/</b> Verzeichnis umzubenennen. Sie sollten das Verzeichnis umbenennen, um die Sicherheit Ihres Onlineshops zu verbessern. Passen Sie Ihre Servereinstellungen an und folgen Sie <a href="http://wiki.oscdox.com/v2.1/setting_up_security" target="_blank">dieser Anleitung</a> zur manuellen Umbenennung.');
define('TEXT_NO_CONFIG_PERMISSIONS', 'Der Installer kann Ihre configure.php Dateien nicht erstellen. <br/> Die Zugriffsrechte sind inkorrekt bei mehreren Verzeichnissen!');
define('TEXT_NO_CONFIG_PERMISSIONS_DESC', ' Sie müssen die Zugriffsrechte auf 755 or 777 bei den folgenden Verzeichnissen ändern. <br />Sobald dies geschehen ist, laden Sie diese Seite neu und Sie können die Installation fortsetzen. Falls Sie dennoch weiterhin diesen Fehler sehen, lesen Sie  die Dokumentation <a href="http://wiki.oscdox.com/v2.5/installation_troubleshooting" target="_blank">Troubleshooting</a>. <br><br>Ändern Sie die Zugriffsrechte auf 755 oder 777 (Tip: Versuchen Sie zuerst 755. Falls das nicht funktioniert, versuchen Sie 777.) bei den folgenden Verzeichnissen:<br><br>');


// Finished
define('TEXT_FINISHED', '<h1>Installation abgeschlossen</h1><p>Herzlichen Glückwunsch zur erfolgreichen Einrichtung Ihres Onlineshops!</p><p>Wir wünschen Ihnen viel Erfolg mit Ihrem Onlineshop und laden Sie ein, Teil unserer Community zu werden.</p><p align="right"><i><b>- Ihr osCmax Team</b></i></p>');
define('TEXT_ADMIN_RENAMED_1', 'Herzlichen Glückwunsch! Ihr admin Verzeichnis wurde erfolgreich umbenannt zu ');
define('TEXT_ADMIN_RENAMED_2', '.<br><br>Falls Sie mehr über zusätzliche Sicherheitsmaßnahmen erfahren möchten, lesen Sie bitte die Informationen im <a href="http://wiki.oscdox.com/v2.5/setting_up_security" target="_blank">Wiki</a>.');
define('TEXT_ADMIN_NOT_RENAMED', 'Sie haben das <b>admin</b>-Verzeichnis nicht umbenannt! Bei öffentlich zugänglichen Shops wird dies aus Sicherheitsgründen jedoch dringend empfohlen. <br><br>Bitte lesen Sie die <a href="http://wiki.oscdox.com/v2.5/setting_up_security" target="_blank">Wiki-Dokumentation zur Absicherung Ihres Onlineshops.</a>');
define('TEXT_INSTALLATION_SUCCESSFUL', 'Die Installation und Einrichtung war erfolgreich!');
?>