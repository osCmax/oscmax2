<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
// LINE ADDED: MOD - ORDER EDIT
define('TABLE_HEADING_EDIT_ORDERS', 'To modify the order');

define('HEADING_TITLE', 'Bestellungen');
define('HEADING_TITLE_SEARCH', 'Bestell-Nr.:');
define('HEADING_TITLE_STATUS', 'Status:');
//BOF: Orders search by customers info
define('HEADING_TITLE_SEARCH_ALL', 'Suche (Bestellnummer, Kunde oder Firmenname):');
//EOF: Orders search by customers info
define('TABLE_HEADING_COMMENTS', 'Kommentare');
define('TABLE_HEADING_NEW_COMMENTS', 'Kommentar hinzufügen');
define('TABLE_HEADING_CUSTOMERS', 'Kunden');
define('TABLE_HEADING_ORDER_TOTAL', 'Gesamtwert');
define('TABLE_HEADING_DATE_PURCHASED', 'Bestelldatum');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_QUANTITY', 'Anzahl');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Artikel-Nr.');
define('TABLE_HEADING_PRODUCTS', 'Produkte');
define('TABLE_HEADING_TAX', 'USt.');
define('TABLE_HEADING_TOTAL', 'Gesamtsumme');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Preis (exkl. USt.)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Preis (inkl. USt.)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Total (exkl. USt.)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Total (inkl. USt.)');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Kunde benachrichtigt');
define('TABLE_HEADING_DATE_ADDED', 'Hinzugefügt am:');

define('ENTRY_CUSTOMER', 'Kunde:');
define('ENTRY_SOLD_TO', 'Verkauft an:');
define('ENTRY_DELIVERY_TO', 'Lieferadresse:');
define('ENTRY_SHIP_TO', 'Lieferadresse:');
define('ENTRY_SHIPPING_ADDRESS', 'Lieferadresse:');
define('ENTRY_BILLING_ADDRESS', 'Rechnungsadresse:');
define('ENTRY_PAYMENT_METHOD', 'Zahlungsart:');
define('ENTRY_CREDIT_CARD_TYPE', 'Kreditkartentyp:');
define('ENTRY_CREDIT_CARD_OWNER', 'Kreditkarteninhaber:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Kerditkartennnummer:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Kreditkarte läuft ab am:');
define('ENTRY_SUB_TOTAL', 'Zwischensumme:');
define('ENTRY_TAX', 'USt.:');
define('ENTRY_SHIPPING', 'Versandkosten:');
define('ENTRY_TOTAL', 'Gesamtsumme:');
define('ENTRY_DATE_PURCHASED', 'Bestelldatum:');
define('ENTRY_STATUS', 'Status:');
define('ENTRY_DATE_LAST_UPDATED', 'Zuletzte aktualisiert am:');
define('ENTRY_NOTIFY_CUSTOMER', 'Kunde benachrichtigen:');
define('ENTRY_NOTIFY_COMMENTS', 'Kommentare mitsenden:');
define('ENTRY_PRINTABLE', 'Rechnung drucken');

define('TEXT_INFO_HEADING_DELETE_ORDER', 'Bestellung löschen');
define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie diese Bestellung löschen möchten?');
define('TEXT_INFO_RESTOCK_PRODUCT_QUANTITY', 'Artikelanzahl dem Lager gutschreiben');
define('TEXT_DATE_ORDER_CREATED', 'Erstellt am:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Zuletzt geändert am:');
define('TEXT_INFO_PAYMENT_METHOD', 'Zahlungsart:');

define('TEXT_ALL_ORDERS', 'Alle Bestellungen');
define('TEXT_NO_ORDER_HISTORY', 'Keine Bestellhistorie verfügbar');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Statusänderung Ihrer Bestellung');
define('EMAIL_TEXT_ORDER_NUMBER', 'Bestell-Nr.:');
define('EMAIL_TEXT_INVOICE_URL', 'Ihre Bestellung können Sie unter folgender Adresse einsehen:');
define('EMAIL_TEXT_DATE_ORDERED', 'Bestelldatum:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Der Status Ihrer Bestellung wurde geändert.' . "\n\n" . 'Neuer Status: %s' . "\n\n" . 'Bei Fragen zu Ihrer Bestellung antworten Sie bitte auf diese eMail.' . "\n\n" . 'Mit freundlichen Grüßen' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Kommentare zu Ihrer Bestellung:' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Fehler: Diese Bestellung existiert nicht!.');
define('SUCCESS_ORDER_UPDATED', 'Hinweis: Die Bestellung wurde erfolgreich aktualisiert.');
define('WARNING_ORDER_NOT_UPDATED', 'Hinweis: Es wurde nichts geändert. Daher wurde diese Bestellung nicht aktualisiert.');

define('HEADING_CANNED_COMMENTS_HELP', 'Vorgefertigte Kommentare Hilfe');
define('TEXT_CANNED_COMMENTS_HELP', 'Um neue vorgefertigte Kommentare zu erstellen, gehen Sie bitte zu <b>Lokalisierung --> Vorgefertigte Kommentare</b> und folgen Sie den Anweisungen. Wenn Sie weiterführende Hilfe benötigen, lesen Sie bitte in der <b>Wiki</b> nach.');

define('TABLE_HEADING_AUTHOR', 'Autor');
define('TABLE_HEADING_CUSTOMER_COMMENTS', 'Kundenkommentare');
define('TEXT_ACTIVE', 'Aktiv');
define('TABLE_HEADING_ORDER_COMMENTS', 'Bestellkommentare');
define('TABLE_HEADING_NEW_ORDER_COMMENTS', 'Bestellkommentar hinzufügen');
define('TEXT_ORDER_SUMMARY', 'Bestellungszusammenfassung');

define('TEXT_ORDER_ID', 'Bestell-Nr.:');
define('TEXT_ORDER_DATE_TIME', 'Bestellt am');

define('OPTION_SELECT_COMMENT', 'Kommentar auswählen...');
define('OPTION_NAME_OF_CUSTOMER', 'Kundenname');
?>