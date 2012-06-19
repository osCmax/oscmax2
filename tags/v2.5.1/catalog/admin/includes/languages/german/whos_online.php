<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// added for version 1.9 - to be translated to the right language BOF ******
define('AZER_WHOSONLINE_WHOIS_URL', 'http://www.dnsstuff.com/tools/whois.ch?ip='); //for version 2.9 by azer - whois ip
define('TEXT_NOT_AVAILABLE', '   <b>Hinweis:</b> N/A = IP nicht verfügbar'); //for version 2.9 by azer was missing
define('TEXT_LAST_REFRESH', 'Letzte Aktualisierung'); //for version 2.9 by azer was missing
define('TEXT_EMPTY', 'Leer'); //for version 2.8 by azer was missing
define('TEXT_MY_IP_ADDRESS', 'Meine IP Adresse '); //for version 2.8 by azer was missing
define('TABLE_HEADING_COUNTRY', 'Land'); // azerc : 25oct05 for contrib whos_online with country and flag
// added for version 1.9 EOF *************************************************

define('HEADING_TITLE', 'Wer ist Online?');  // Version update to 3.2 because of multiple 1.x and 2.x jumble.  apr-07 by nerbonne
define('TABLE_HEADING_ONLINE', 'Online');
define('TABLE_HEADING_CUSTOMER_ID', 'ID');
define('TABLE_HEADING_FULL_NAME', 'Name');
define('TABLE_HEADING_IP_ADDRESS', 'IP Adresse');
define('TABLE_HEADING_ENTRY_TIME', 'Startzeit');
define('TABLE_HEADING_LAST_CLICK', 'Letzter Klick');
define('TABLE_HEADING_LAST_PAGE_URL', 'Letzte URL');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_SHOPPING_CART', 'Warenkorb');
define('TEXT_SHOPPING_CART_SUBTOTAL', 'Insgesamt');
define('TEXT_NUMBER_OF_CUSTOMERS', 'Besucher online (werden nach 5 Minuten als inaktiv eingestuft und nach 15 Minuten entfernt)');
define('TABLE_HEADING_HTTP_REFERER', 'Referer?');
define('TEXT_HTTP_REFERER_URL', 'HTTP Referer URL');
define('TEXT_HTTP_REFERER_FOUND', 'Ja');
define('TEXT_HTTP_REFERER_NOT_FOUND', 'Nicht gefunden');
define('TEXT_STATUS_ACTIVE_CART', 'Aktiv mit Warenkorb');
define('TEXT_STATUS_ACTIVE_NOCART', 'Aktiv ohne Warenkorb');
define('TEXT_STATUS_INACTIVE_CART', 'Inaktiv mit Warenkorb');
define('TEXT_STATUS_INACTIVE_NOCART', 'Inaktiv ohne Warenkorb');
define('TEXT_STATUS_NO_SESSION_BOT', 'Inaktiver Bot ohne Session?'); //Azer !!! check if right description
define('TEXT_STATUS_INACTIVE_BOT', 'Inaktiver Bot mit Session '); //Azer !!! check if right description
define('TEXT_STATUS_ACTIVE_BOT', 'Aktiver Bot mit Session '); //Azer !!! check if right description
define('TABLE_HEADING_COUNTRY', 'Land');
define('TABLE_HEADING_USER_SESSION', 'Session?');
define('TEXT_IN_SESSION', 'Ja');
define('TEXT_NO_SESSION', 'Nein');

define('TEXT_NUMBER_OF_CUSTOMER', 'Kundenanzahl');
define('TEXT_OSCID', 'osCsid');
define('TEXT_PROFILE_DISPLAY', 'Profilanzeige');
define('TEXT_USER_AGENT', 'User agent');
define('TEXT_ERROR', 'Fehler!');
define('TEXT_ADMIN', 'Admin');
define('TEXT_DUPLICATE_IP', 'Gleiche IP');
define('TEXT_DUPLICATE_IPS', 'Gleiche IPs');
define('TEXT_BOT', 'Bot');
define('TEXT_BOTS', 'Bots');
define('TEXT_ME', 'Ich selbst!');
define('TEXT_ALL', 'Alle');
define('TEXT_REAL_CUSTOMER', 'Echter Kunde');
define('TEXT_REAL_CUSTOMERS', 'Echte Kunden');
define('TEXT_ACTIVE_CUSTOMER', ' ist aktiv.');
define('TEXT_ACTIVE_CUSTOMERS', ' sind aktiv.');

define('TEXT_YOUR_IP_ADDRESS', 'Ihre IP Adresse');
define('TEXT_SET_REFRESH_RATE', 'Aktualisierungsrate');
define('TEXT_NONE_', 'Keine');
define('TEXT_CUSTOMERS', 'Kunden');
define('TEXT_SHOW_BOTS', 'Zeige Bots');
define('TEXT_SHOW_MAP', 'Zeige Karte');
define('TEXT_COUNTRY', 'Land');
define('TEXT_REGION', 'Bundesland');
define('TEXT_CITY', 'Ort');
?>