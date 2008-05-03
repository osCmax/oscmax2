<?php
/*
$Id: login.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

if ($HTTP_GET_VARS['origin'] == FILENAME_CHECKOUT_PAYMENT) {
  define('NAVBAR_TITLE', 'Order');
  define('HEADING_TITLE', 'Ordering online is easy.');
  define('TEXT_STEP_BY_STEP', 'We\'ll walk you through the process, step by step.');
} else {
define('NAVBAR_TITLE', 'Zeichen Innen');
define('HEADING_TITLE', 'Willkommen. Bitte Zeichen Innen');
define('TEXT_STEP_BY_STEP', ''); // should be empty


define('HEADING_RETURNING_ADMIN', 'Zeichen In der Verkleidung:');
define('HEADING_PASSWORD_FORGOTTEN', 'Kennwort Vergessen:');
define('TEXT_RETURNING_ADMIN', 'Nur Personal!');
define('ENTRY_EMAIL_ADDRESS', 'Email Adresse:');
define('ENTRY_PASSWORD', 'Kennwort:');
define('ENTRY_FIRSTNAME', 'Vorname:');
define('IMAGE_BUTTON_LOGIN', 'Reichen Sie ein');

define('TEXT_PASSWORD_FORGOTTEN', 'Kennwort vergessen?');

define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>Störung:</b></font> Falsches username oder Kennwort!');
define('TEXT_FORGOTTEN_ERROR', '<font color="#ff0000"><b>Störung:</b></font> Vorname und Kennwort passen nicht zusammen!');
define('TEXT_FORGOTTEN_FAIL', 'Sie haben über 3mal versucht. Aus Sicherheit Gründen treten Sie bitte mit Ihrem Hauptverwalter in Verbindung, um ein neues Kennwort zu erhalten.<br>&nbsp;<br>&nbsp;');
define('TEXT_FORGOTTEN_SUCCESS', 'Ein neues Kennwort ist zu Ihrer E-mail Adresse geschickt worden. Überprüfen Sie bitte Ihre E-mail und klicken Sie die "rückseitige" Taste an, um innen zu unterzeichnen.<br>&nbsp;<br>&nbsp;');

define('ADMIN_EMAIL_SUBJECT', 'Neues Kennwort');
define('ADMIN_EMAIL_TEXT', 'Hallo %s,' . "\n\n" . 'Sie können die Leitung Verkleidung mit dem folgenden Kennwort zugänglich machen. Sobald Sie die Verkleidung zugänglich machen, ändern Sie bitte Ihr Kennwort aus Sicherheit Gründen!' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Kennwort: %s' . "\n\n" . 'Danke!' . "\n" . '%s' . "\n\n" . 'Dieses ist eine automatisierte Antwort, bitte antworten Sie nicht!');
?>
