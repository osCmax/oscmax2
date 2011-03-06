<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// PWA BOF
define('TEXT_GUEST_INTRODUCTION', '<b>Möchten Sie direkt zur Kasse gehen?</b><br><br>Sie können Ihren Einkauf mit oder ohne Kundenkonto abschließen. Beachten Sie jedoch, dass bei einem die  Einkauf ohne Kundenkonto gewisse Funktionen in diesem Shop nicht zur Verfügung stehen. Sie können den Status Ihrer Bestellung nicht verfolgen und bei einem künftigen Einkauf müssen Sie alle Angaben erneut machen.<br><br>Das Erstellen eines Kontos ist kostenlos. Wenn Sie dennoch Ihren Einkauf abschließen möchten, klicken Sie auf den "Kasse" Button.');
// PWA BOF
define('NAVBAR_TITLE', 'Anmelden');
define('HEADING_TITLE', 'Herzlich Willkommen! Bitte melden Sie sich an');

define('HEADING_NEW_CUSTOMER', 'Neuer Kunde');
define('TEXT_NEW_CUSTOMER', 'Ich bin ein neuer Kunde.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'Durch Ihre Anmeldung bei ' . STORE_NAME . ' sind Sie in der Lage, schneller zu bestellen, kennen jederzeit den Status Ihrer Bestellungen und haben immer eine aktuelle Übersicht über Ihre bisherigen Bestellungen.');

define('HEADING_RETURNING_CUSTOMER', 'Bestehender Kunde');
define('TEXT_RETURNING_CUSTOMER', 'Ich bin bereits Kunde.');

define('TEXT_PASSWORD_FORGOTTEN', 'Passwort vergessen? Hier klicken.');

define('TEXT_LOGIN_ERROR', 'Fehler: Die E-Mail-Adresse und/oder das Passwort sind nicht korrekt.');
define('TEXT_VISITORS_CART', '<font color="#ff0000"><b>Hinweis:</b></font> Der Inhalt Ihres Warenkorbes bleibt erhalten, wenn Sie sich anmelden.');

// LINE ADDED: MOD - Separate Pricing Per Customer
// define the email address that can change customer_group_id on login
define('SPPC_TOGGLE_LOGIN_PASSWORD', 'root@localhost');
define('PWA_FAIL_ACCOUNT_EXISTS','Es existiert bereits ein Konto für die E-Mail-Adresse {EMAIL_ADDRESS}. Sie müssen sich hier anmelden mit dem Passwort für dieses Konto, bevor Sie Ihren Einkauf abschließen können.');

define('HEADING_CHECKOUT','<font size="2">Gehen Sie direkt zur Kasse</font>');

define('TEXT_CHECKOUT_INTRODUCTION','Gehen Sie zur Kasse, ohne ein Kundenkonto zu erstellen. Bei dieser Option werden keine Ihrer Benutzerdaten zur weiteren Verwendung gespeichertwerden in unseren Unterlagen aufbewahrt werden. Sie können den Status Ihrer Bestellung nicht verfolgen und bei einem künftigen Einkauf müssen Sie alle Angaben erneut machen.');

define('PROCEED_TO_CHECKOUT','Gehen Sie zur Kasse, ohne ein Kundenkonto zu erstellen');

define('TEXT_GV_LOGIN_NEEDED', 'Sie müssen angemeldet sein, um Ihren Gutschein einlösen zu können. Bitte erstellen Sie ein neues Konto oder melden Sie sich an.');

?>