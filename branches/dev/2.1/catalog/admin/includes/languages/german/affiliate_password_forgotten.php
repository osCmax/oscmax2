<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Anmelden');
define('NAVBAR_TITLE_2', 'Passwort zum Partnerprogramm vergessen');
define('HEADING_TITLE', 'Wie war noch mal mein Passwort?');
define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<font color="#ff0000"><b>ACHTUNG:</b></font> Die eingegebene eMail-Adresse ist nicht registriert. Bitte versuchen Sie es noch einmal.');
define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Neues Passwort zum Partnerprogramm');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Über die Adresse ' . $REMOTE_ADDR . ' haben wir eine Anfrage zur Passworterneuerung für Ihren Zugang zum Partnerprogramm erhalten.' . "\n\n" . 'Ihr neues Passwort für Ihren Zugang zum Partnerprogramm von \'' . STORE_NAME . '\' lautet ab sofort:' . "\n\n" . '   %s' . "\n\n");
define('TEXT_PASSWORD_SENT', 'Ein neues Passwort wurde per eMail verschickt.');
?>