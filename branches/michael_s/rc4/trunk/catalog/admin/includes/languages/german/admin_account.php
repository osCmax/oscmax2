<?php
/*
$Id: admin_account.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Admin Konto');

define('TABLE_HEADING_ACCOUNT', 'Mein Konto');

define('TEXT_INFO_FULLNAME', '<b>Name: </b>');
define('TEXT_INFO_FIRSTNAME', '<b>Vorname: </b>');
define('TEXT_INFO_LASTNAME', '<b>Letzter Name: </b>');
define('TEXT_INFO_EMAIL', '<b>Email Address: </b>');
define('TEXT_INFO_PASSWORD', '<b>Kennwort: </b>');
define('TEXT_INFO_PASSWORD_HIDDEN', '-Versteckt-');
define('TEXT_INFO_PASSWORD_CONFIRM', '<b>Best�tigen Sie Kennwort: </b>');
define('TEXT_INFO_CREATED', '<b>Konto Verursacht: </b>');
define('TEXT_INFO_LOGDATE', '<b>Letzter Zugang: </b>');
define('TEXT_INFO_LOGNUM', '<b>Maschinenbordbuch-Zahl: </b>');
define('TEXT_INFO_GROUP', '<b>Gruppe Niveau: </b>');
define('TEXT_INFO_ERROR', '<font color="red">Email address ist bereits verwendet worden! Bitte Versuch wieder.</font>');
define('TEXT_INFO_MODIFIED', 'Ge�ndert: ');

define('TEXT_INFO_HEADING_DEFAULT', 'Redigieren Sie Konto ');
define('TEXT_INFO_HEADING_CONFIRM_PASSWORD', 'Kennwort-Best�tigung ');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD', 'Kennwort:');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR', '<font color="red"><b>ST�RUNG:</b> falsches Kennwort!</font>');
define('TEXT_INFO_INTRO_DEFAULT', 'Klicken Sie die redigierentaste unten, um Ihre Kontoinformationen zu �ndern.');
define('TEXT_INFO_INTRO_DEFAULT_FIRST_TIME', '<br><b>Warnung:</b><br>Hallo <b>%s</b>, Dieses ist Ihr erstes Mal hier, wir empfehlen Sie �nderung Ihr Kennwort zu den Sicherheit Zwecken!');
define('TEXT_INFO_INTRO_DEFAULT_FIRST', '<br><b>WARNING:</b><br>Hallo <b>%s</b>, Wir empfehlen youchange Ihr email vom <font color="red">admin@localhost</font> und �ndern Ihr Kennwort!');
define('TEXT_INFO_INTRO_EDIT_PROCESS', 'Alles f�ngt werden angefordert auf. Klicken speichert, um einzureichen.');

define('JS_ALERT_FIRSTNAME',        '- Erfordert: Vorname \n');
define('JS_ALERT_LASTNAME',         '- Erfordert: Letzter Name \n');
define('JS_ALERT_EMAIL',            '- Erfordert: Email address \n');
define('JS_ALERT_PASSWORD',         '- Erfordert: Kennwort \n');
define('JS_ALERT_FIRSTNAME_LENGTH', '- Vorname mu� als l�nger sein ');
define('JS_ALERT_LASTNAME_LENGTH',  '- Letzter Name mu� als l�nger sein ');
define('JS_ALERT_PASSWORD_LENGTH',  '- Kennwort mu� als l�nger sein ');
define('JS_ALERT_EMAIL_FORMAT',     '- Email address format ist unzul�ssig! \n');
define('JS_ALERT_EMAIL_USED',       '- Email address ist bereits verwendet worden! \n');
define('JS_ALERT_PASSWORD_CONFIRM', '- Es gibt einen Typo in der Kennwort-Best�tigung auffangen! \n');

define('ADMIN_EMAIL_SUBJECT', 'Pers�nliche Informationen �nderung');
define('ADMIN_EMAIL_TEXT', 'Hallow %s,' . "\n\n" . 'Ihre pers�nlichen Informationen, m�glicherweise einschlie�lich Ihr Kennwort, ist ge�ndert worden.  Wenn dieses ohne Ihr Wissen oder Zustimmung bitte getan wurde, treten Sie mit dem Verwalter immediatly in Verbindung!' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Kennwort: %s' . "\n\n" . 'Danke!' . "\n" . '%s' . "\n\n" . 'Dieses ist eine automatisierte Antwort, bitte antworten Sie nicht!');
?>
