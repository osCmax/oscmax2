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

define('HEADING_TITLE', 'Wie lautet mein Passwort?');

define('TEXT_MAIN', 'Sollten Sie Ihr Passwort vergessen haben, geben Sie bitte Ihre eMail-Adresse ein, um umgehend ein neues Passwort per E-Mail zu erhalten.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Fehler: Die eingegebene eMail-Adresse ist nicht registriert. Bitte versuchen Sie es noch einmal.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Ihr neues Passwort.');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Über die Adresse ' . $REMOTE_ADDR . ' haben wir eine Anfrage zur Passworterneuerung erhalten.' . "\n\n" . 'Ihr neues Passwort für \'' . STORE_NAME . '\' lautet ab sofort:' . "\n\n" . '   %s' . "\n\n");

define('SUCCESS_PASSWORD_SENT', 'Success: Ein neues Passwort wurde per eMail an die angegebene Adresse verschickt.');
?>
