<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
define('TEXT_COUPON_REDEEMED', 'Aktionsgutscheine einlösen');
define('REDEEM_DATE_LAST', 'Zuletzt eingelöst am');
define('TOP_BAR_TITLE', 'Statistik');
define('HEADING_TITLE', 'Aktionsgutscheine');
define('HEADING_TITLE_PREVIEW', 'Aktionsgutscheinvorschau');
define('HEADING_TITLE_STATUS', 'Status : ');
define('TEXT_CUSTOMER', 'Kunde:');
define('TEXT_COUPON', 'Gutscheinbezeichnung');
define('TEXT_COUPON_ALL', 'Alle Aktionsgutscheine');
define('TEXT_COUPON_ACTIVE', 'Aktive Aktionsgutscheine');
define('TEXT_COUPON_INACTIVE', 'Inaktive Aktionsgutscheine');
define('TEXT_SUBJECT', 'Betreff:');
define('TEXT_FROM', 'Von:');
define('TEXT_FREE_SHIPPING', 'Gratisversand');
define('TEXT_MESSAGE', 'Nachricht:');
define('TEXT_SELECT_CUSTOMER', 'Kunden auswählen');
define('TEXT_ALL_CUSTOMERS', 'Alle Kunden');
define('TEXT_NEWSLETTER_CUSTOMERS', 'An alle Newsletter-Abonnenten');
define('TEXT_CONFIRM_DELETE', 'Sind Sie sicher, dass Sie diesen Aktionsgutschein löschen möchten?');

define('TEXT_TO_REDEEM', 'Sie können diesen Aktionsgutschein während des Bezahlvorganges eilösen. Geben Sie dazu den Code in das entsprechende Formularfeld ein und klicken Sie auf "Einlösen".');
define('TEXT_IN_CASE', ' im Falle von Problemen oder Unklarheiten. ');
define('TEXT_VOUCHER_IS', 'Der Aktionsgutscheincode lautet ');
define('TEXT_REMEMBER', 'Bewahren Sie den Gutscheincode sicher auf, damit Sie dieses besondere Angebot nutzen können.');
define('TEXT_VISIT', 'wenn Sie ' . HTTP_SERVER . DIR_WS_CATALOG . ' besuchen');
define('TEXT_ENTER_CODE', ' und geben Sie den Code ein ');

define('TABLE_HEADING_ACTION', 'Aktion');

define('CUSTOMER_ID', 'Kunden ID');
define('CUSTOMER_NAME', 'Kundenname');
define('REDEEM_DATE', 'Eingelöst am');
define('IP_ADDRESS', 'IP Adresse');

define('TEXT_REDEMPTIONS', 'Einlösungen');
define('TEXT_REDEMPTIONS_TOTAL', 'Gesamt');
define('TEXT_REDEMPTIONS_CUSTOMER', 'Dieser Kunde');
define('TEXT_NO_FREE_SHIPPING', 'Kein Gratisversand');

define('NOTICE_EMAIL_SENT_TO', 'Hinweis: E-Mail gesendet an: %s');
define('COUPON_NAME', 'Gutscheinbezeichnung');
//define('COUPON_VALUE', 'Coupon Value');
define('COUPON_AMOUNT', 'Gutscheinwert');
define('COUPON_CODE', 'Gutscheincode');
define('COUPON_STARTDATE', 'Gültig ab');
define('COUPON_FINISHDATE', 'Gültig bis');
define('COUPON_FREE_SHIP', 'Gratisversand');
define('COUPON_DESC', 'Gutscheinbeschreibung');
define('COUPON_MIN_ORDER', 'Mindestbestellwert');
define('COUPON_USES_COUPON', 'Verwendungen per Gutschein');
define('COUPON_USES_USER', 'Verwendungen per Kunde');
define('COUPON_PRODUCTS', 'Gültige Produkte');
define('COUPON_CATEGORIES', 'Gültige Kategorien');
define('VOUCHER_NUMBER_USED', 'Anzahl der Verwendungen');
define('DATE_CREATED', 'Erstellt am');
define('DATE_MODIFIED', 'Bearbeitet am');
define('TEXT_HEADING_NEW_COUPON', 'Neuen Aktionsgutschein erstellen');
define('TEXT_NEW_INTRO', 'Bitte vervollständigen Sie die Angaben zum neuen Aktionsgutschein.<br>');

define('COUPON_NAME_HELP', 'Kurzbezeichnung des Gutscheines');
define('COUPON_AMOUNT_HELP', 'Wert des Gutscheins, entweder als Fixbetrag oder als Prozentsatz mit einem abschließenden %-Zeichen.');
define('COUPON_CODE_HELP', 'Sie können Ihren eigenen Code angeben, oder das Feld freilassen, damit ein Code automatisch generiert wird.');
define('COUPON_STARTDATE_HELP', 'Datum, ab wann der Gutschein gültig wird');
define('COUPON_FINISHDATE_HELP', 'Datum, ab wann der Gutschein verfällt');
define('COUPON_FREE_SHIP_HELP', 'Der Gutschein gewährt den Gratisversand bei jeder Bestellung. Hinweis: Damit wird Gutscheinwert ignoriert, nicht jedoch der Mindestbestellwert.');
define('COUPON_DESC_HELP', 'Eine Beschreibung des Gutscheines für den Kunden');
define('COUPON_MIN_ORDER_HELP', 'Eine Mindestbestellmenge, unter der der Gutschein nicht verwendet werden kann');
define('COUPON_USES_COUPON_HELP', 'Eine Angabe, wie oft der Gutschein maximal verwendet werden kann. Lassen Sie das Feld leer, wenn Sie eine unbegrenzte Verwendung wünschen.');
define('COUPON_USES_USER_HELP', 'Eine Angabe, wie oft der Gutschein von einem einzelnen Kunden maximal verwendet werden kann. Lassen Sie das Feld leer, wenn Sie eine unbegrenzte Verwendung wünschen.');
define('COUPON_PRODUCTS_HELP', 'Eine kommaseparierte Liste von Produkt IDs, für die dieser Gutschein gilt. Lassen Sie das Feld leer, wenn Sie den Gutschein nicht auf bestimmte Produkte beschränken möchten.');
define('COUPON_CATEGORIES_HELP', 'Eine kommaseparierte Liste von cpaths, für die dieser Gutschein gilt. Lassen Sie das Feld leer, wenn Sie den Gutschein nicht auf bestimmte Kategorien beschränken möchten.');
define('COUPON_BUTTON_EMAIL_VOUCHER', 'Gutschein versenden');
define('COUPON_BUTTON_EDIT_VOUCHER', 'Gutschein bearbeiten');
define('COUPON_BUTTON_DELETE_VOUCHER', 'Gutschein löschen');
define('COUPON_BUTTON_VOUCHER_REPORT', 'Gutschein Bericht');
define('COUPON_BUTTON_PREVIEW', 'Gutscheinvorschau');
define('COUPON_STATUS', 'Status');
define('COUPON_STATUS_HELP', 'Ändern Sie den Status auf ' . IMAGE_ICON_STATUS_RED . ', um den Gutscheines zu sperren.');
define('COUPON_BUTTON_BACK', 'Zurück');
define('COUPON_BUTTON_CONFIRM', 'Bestätigen');

define('TEXT_ENTRY_REQUIRED', '&nbsp;<span style="color: #ff0000;">*</span>');

define('ERROR_NO_CUSTOMER_SELECTED', 'Fehler: Es wurde kein Kunde ausgewählt.');
define('ERROR_NO_COUPON_AMOUNT', 'Fehler: Es wurde kein Gutscheinwert eingegeben. Geben Sie entweder einen Gutscheinwert ein oder wählen Sie Frachtkostenfrei.');
define('ERROR_COUPON_EXISTS', 'Fehler: Es existiert bereits ein Gutschein mit diesem Code.');
define('ERROR_MISSING_COUPON_NAME', 'Fehler: You have not entered a coupon name in language ');
define('ERROR_MISSING_START_DATE', 'Fehler: Sie müssen ein <b>Startdatum</b> für Ihren Gutschein eingeben.');
define('ERROR_MISSING_FINISH_DATE', 'Fehler: Sie müssen ein <b>Ablaufdatum</b> für Ihren Gutschein eingeben.');

?>