<?php
/*
$Id: admin_account.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2009 osCMax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Admin Konto');

define('TABLE_HEADING_ACCOUNT', 'Mein Konto');

define('TEXT_INFO_FULLNAME', '<b>Name: </b>');
define('TEXT_INFO_USERNAME', '<b>Benutzername: </b>');
define('TEXT_INFO_FIRSTNAME', '<b>Vorname: </b>');
define('TEXT_INFO_LASTNAME', '<b>Letzter Name: </b>');
define('TEXT_INFO_EMAIL', '<b>Email Address: </b>');
define('TEXT_INFO_PASSWORD', '<b>Kennwort: </b>');
define('TEXT_INFO_PASSWORD_HIDDEN', '-Versteckt-');
define('TEXT_INFO_PASSWORD_CONFIRM', '<b>Bestätigen Sie Kennwort: </b>');
define('TEXT_INFO_CREATED', '<b>Konto erstellt: </b>');
define('TEXT_INFO_LOGDATE', '<b>Letzter Login: </b>');
define('TEXT_INFO_LOGNUM', '<b>Maschinenbordbuch-Zahl: </b>');
define('TEXT_INFO_GROUP', '<b>Gruppe Niveau: </b>');
define('TEXT_INFO_ERROR', '<font color="red">Email Adresse ist bereits verwendet worden! Bitte erneut versuchen.</font>');
define('TEXT_INFO_MODIFIED', 'Geändert: ');

define('TEXT_INFO_HEADING_DEFAULT', 'Konto bearbeiten ');
define('TEXT_INFO_HEADING_CONFIRM_PASSWORD', 'Kennwort-Bestätigung ');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD', 'Kennwort:');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR', '<font color="red"><b>STÖRUNG:</b> falsches Kennwort!</font>');
define('TEXT_INFO_INTRO_DEFAULT', 'Klicken Sie die Bearbeitentaste unten, um Ihre Kontoinformationen zu ändern.');
define('TEXT_INFO_INTRO_DEFAULT_FIRST_TIME', '<br><b>Warnung:</b><br>Hallo <b>%s</b>, Dies ist Ihr erster Besuch, wir empfehlen dringend eine Änderung des Passworts!');
define('TEXT_INFO_INTRO_DEFAULT_FIRST', '<br><b>WARNING:</b><br>Hallo <b>%s</b>, Wir empfehlen eine Änderung Ihrer Email von <font color="red">admin@localhost</font> und Ihres Kennworts!');
define('TEXT_INFO_INTRO_EDIT_PROCESS', 'Alles fängt werden angefordert auf. Klicken speichert, um einzureichen.');

define('JS_ALERT_USERNAME',         '- Erfordert: Benutzername \n');
define('JS_ALERT_FIRSTNAME',        '- Erfordert: Vorname \n');
define('JS_ALERT_LASTNAME',         '- Erfordert: Nachname \n');
define('JS_ALERT_EMAIL',            '- Erfordert: Email Addresse \n');
define('JS_ALERT_PASSWORD',         '- Erfordert: Kennwort \n');
define('JS_ALERT_USERNAME_LENGTH',  '- Benutzername ist zu kurz ');
define('JS_ALERT_FIRSTNAME_LENGTH', '- Vorname ist zu kurz ');
define('JS_ALERT_LASTNAME_LENGTH',  '- Nachnahme ist zu kurz ');
define('JS_ALERT_PASSWORD_LENGTH',  '- Kennwort ist zu kurz ');
define('JS_ALERT_EMAIL_FORMAT',     '- Format der Email Adresse ist unzulässig! \n');
define('JS_ALERT_EMAIL_USED',       '- Email Adresse ist bereits vergeben! \n');
define('JS_ALERT_PASSWORD_CONFIRM', '- Es gibt einen Typo in der Kennwort-Bestätigung auffangen! \n');

define('ADMIN_EMAIL_SUBJECT', 'Persönliche Informationen bearbeiten');
define('ADMIN_EMAIL_TEXT', 'Hallo %s,' . "\n\n" . 'Ihre persönlichen Informationen, möglicherweise auch Ihr Kennwort, sind geändert worden.  Wenn dies ohne Ihr Wissen oder Ihre Zustimmung geschehen ist, treten Sie mit dem Administrator schnellstens in Verbindung!' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Kennwort: %s' . "\n\n" . 'Danke!' . "\n" . '%s' . "\n\n" . 'Dies ist eine automatisierte Nachricht, bitte antworten Sie nicht!');
?>