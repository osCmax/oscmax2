<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Anmelden');
define('NAVBAR_TITLE_2', 'Passwort vergessen');

define('HEADING_TITLE', 'Ich habe mein Passwort vergessen!');

define('TEXT_MAIN', 'Falls Sie Ihr Passwort vergessen haben, geben Sie bitte Ihre E-Mail-Adresse ein, um ein neues Passwort per E-Mail zu erhalten.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Fehler: Die angegebene E-Mail-Adresse wird von keinem Kundenkonto verwendet. Bitte versuchen Sie es noch einmal.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Ihr neues Passwort.');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Über die Adresse ' . isset($REMOTE_ADDR) . ' wurde ein neues Passwort angefordert.' . "\n\n" . 'Ihr neues Passwort für \'' . STORE_NAME . '\' lautet ab sofort:' . "\n\n" . '   %s' . "\n\n");

define('SUCCESS_PASSWORD_SENT', 'Erfolg: Ein neues Passwort wurde per E-Mail an Ihre E-Mail-Adresse versendet.');
?>