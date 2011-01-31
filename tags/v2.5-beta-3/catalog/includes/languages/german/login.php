<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Anmelden');
define('HEADING_TITLE', 'Melden Sie sich an');

define('HEADING_NEW_CUSTOMER', 'Neuer Kunde');
define('TEXT_NEW_CUSTOMER', 'Ich bin ein neuer Kunde.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'Durch Ihre Anmeldung bei ' . STORE_NAME . ' sind Sie in der Lage schneller zu bestellen, kennen jederzeit den Status Ihrer Bestellungen und haben immer eine aktuelle &Uuml;bersicht &uuml;ber Ihre bisherigen Bestellungen.');

define('HEADING_RETURNING_CUSTOMER', 'Bereits Kunde');
define('TEXT_RETURNING_CUSTOMER', 'Ich bin bereits Kunde.');

define('TEXT_PASSWORD_FORGOTTEN', 'Sie haben Ihr Passwort vergessen? Dann klicken Sie <u>hier</u>');

define('TEXT_LOGIN_ERROR', 'Fehler: Keine &Uuml;bereinstimmung der eingebenen eMail-Adresse und/oder dem Passwort.');
define('TEXT_VISITORS_CART', '<font color="#ff0000"><b>Achtung:</b></font> Ihre Besuchereingaben werden automatisch mit Ihrem Kundenkonto verbunden. <a href="javascript:session_win();">[Mehr Information]</a>');

// BOF: MOD - Checkout Without Account v0.70 changes
define('PWA_FAIL_ACCOUNT_EXISTS','Ein Konto existiert bereits für die E-Mail-Adresse <i>{EMAIL_ADDRESS}.</i> Sie müssen sich hier anmelden mit dem Passwort für dieses Konto, bevor Sie fortfahren zur Kasse.');
define('HEADING_CHECKOUT','<font size="2">Kasse gehen Sie direkt zu</font>');
define('TEXT_CHECKOUT_INTRODUCTION','Gehen Sie zur Prüfung ohne Erstellen eines Kontos. Durch die Wahl dieser Option keine Ihrer Benutzerdaten werden in unseren Unterlagen aufbewahrt werden, und Sie werden nicht in der Lage sein den Status Ihrer Bestellung zu überprüfen, noch den Überblick über Ihre bisherigen Bestellungen.');
define('PROCEED_TO_CHECKOUT','Gehen Sie zur Prüfung ohne Anmeldung');
// EOF: MOD - Checkout Without Account changes

// LINE ADDED: MOD - Separate Pricing Per Customer
// define the email address that can change customer_group_id on login
define('SPPC_TOGGLE_LOGIN_PASSWORD', 'root@localhost');
define('TEXT_GUEST_INTRODUCTION','<b>Wollen Sie direkt zur Kasse?</b> <br><br> Möchten Sie überprüfen, ohne ein Kundenkonto? Bitte beachten Sie, dass alle unsere Dienste werden nicht verfügbar sein, um Kunden, die nicht wollen, um ein Konto zu erstellen. Sie können auch nicht den Status Ihrer Bestellung, und jedes Mal, wenn Sie bei uns einkaufen, müssen Sie erneut eingeben alle Ihre Daten. <br><br> Erstellen eines Kontos ist kostenlos. Wenn Sie dennoch weiter zur Kasse bitte auf den Button "Kasse" zu Ihrer Rechten.');

define('TEXT_GV_LOGIN_NEEDED', 'Sie müssen angemeldet sein, um Ihren Gutschein einzulösen. Bitte erstellen Sie ein neues Konto oder einloggen');

?>