<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Änderung einer Bestellung #%s vom %s');
define('ADDING_TITLE', 'Artikel hinzufügen zur Bestellung #%s');

define('ENTRY_UPDATE_TO_CC', '(Aktualisiere ' . ORDER_EDITOR_CREDIT_CARD . ' um die Kreditkartenfelder zu sehen.)');
define('TABLE_HEADING_COMMENTS', 'Anmerkung');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_NEW_STATUS', 'Neuer Status');
define('TABLE_HEADING_ACTION', 'Ausführen');
define('TABLE_HEADING_DELETE', 'Löschen?');
define('TABLE_HEADING_QUANTITY', 'Menge');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Artikel-Nr.');
define('TABLE_HEADING_PRODUCTS', 'Artikel');
define('TABLE_HEADING_TAX', 'Steuer');
define('TABLE_HEADING_TOTAL', 'Gesamt');
define('TABLE_HEADING_BASE_PRICE', 'Grund<br>Preis');
define('TABLE_HEADING_UNIT_PRICE', 'Preis<br>(netto)');
define('TABLE_HEADING_UNIT_PRICE_TAXED', 'Preis<br>(brutto)');
define('TABLE_HEADING_TOTAL_PRICE', 'Gesamt<br>(netto)');
define('TABLE_HEADING_TOTAL_PRICE_TAXED', 'Gesamt<br>(brutto)');
define('TABLE_HEADING_OT_TOTALS', 'Order Gesamt:');
define('TABLE_HEADING_OT_VALUES', 'Wert:');
define('TABLE_HEADING_SHIPPING_QUOTES', 'Versandarten:');
define('TABLE_HEADING_NO_SHIPPING_QUOTES', 'Es gibt keine Versandarten zum Anzeigen!');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Kunde<br>benachrichtigt');
define('TABLE_HEADING_DATE_ADDED', 'hinzugefügt am');

define('ENTRY_CUSTOMER', 'Kunde');
define('ENTRY_NAME', 'Name:');
define('ENTRY_CITY_STATE', 'Stadt, Land:');
define('ENTRY_SHIPPING_ADDRESS', 'Lieferadresse');
define('ENTRY_BILLING_ADDRESS', 'Rechnungsadresse');
define('ENTRY_PAYMENT_METHOD', 'Zahlungsweise');
define('ENTRY_CREDIT_CARD_TYPE', 'Kreditkarte:');
define('ENTRY_CREDIT_CARD_OWNER', 'Karteninhaber:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Kartennummer:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'gültig bis:');
define('ENTRY_SUB_TOTAL', 'Zwischensumme:');
define('ENTRY_TYPE_BELOW', 'unten angeben');

//the definition of ENTRY_TAX is important when dealing with certain tax components and scenarios
define('ENTRY_TAX', 'Steuer');
//do not use a colon (:) in the defintion, ie 'VAT' is ok, but 'VAT:' is not

define('ENTRY_SHIPPING', 'Lieferung:');
define('ENTRY_TOTAL', 'Gesamt:');
define('ENTRY_STATUS', 'Status:');
define('ENTRY_NOTIFY_CUSTOMER', 'Kunde benachrichtigen:');
define('ENTRY_NOTIFY_COMMENTS', 'Sende Anmerkung:');
define('ENTRY_CURRENCY_TYPE', 'Währung');
define('ENTRY_CURRENCY_VALUE', 'Währungswert');

define('TEXT_INFO_PAYMENT_METHOD', 'Zahlungsweise:');
define('TEXT_NO_ORDER_PRODUCTS', 'Diese Bestellung enthält keine Artikel');
define('TEXT_ADD_NEW_PRODUCT', 'Artikel hinzufügen');
define('TEXT_PACKAGE_WEIGHT_COUNT', 'Gewicht: %s  |  Artikelanzahl: %s');

define('TEXT_STEP_1', '<b>Schritt 1:</b>');
define('TEXT_STEP_2', '<b>Schritt 2:</b>');
define('TEXT_STEP_3', '<b>Schritt 3:</b>');
define('TEXT_STEP_4', '<b>Schritt 4:</b>');
define('TEXT_SELECT_CATEGORY', '- Wähle Kategorie aus der Liste -');
define('TEXT_PRODUCT_SEARCH', '<b>- ODER gebe einen Suchbegriff ein -</b>');
define('TEXT_ALL_CATEGORIES', 'Alle Kategorien/Alle Artikel');
define('TEXT_SELECT_PRODUCT', '- Wähle einen Artikel -');
define('TEXT_BUTTON_SELECT_OPTIONS', 'auswählen');
define('TEXT_BUTTON_SELECT_CATEGORY', 'Wähle diese Kategorie');
define('TEXT_BUTTON_SELECT_PRODUCT', 'Wähle diesen Artikel');
define('TEXT_SKIP_NO_OPTIONS', '<em>Keine Optionen - Überspringen...</em>');
define('TEXT_QUANTITY', 'Menge:');
define('TEXT_BUTTON_ADD_PRODUCT', 'Zur Order hinzufügen');
define('TEXT_CLOSE_POPUP', '<u>Schließen</u> [x]');
define('TEXT_ADD_PRODUCT_INSTRUCTIONS', 'Füge Artikel hinzu bist Du fertig bist. <br> Dann schließe dieses/n Tab/Fenster, kehre zum Hauptfenster zurück, und drücke die Schaltfläche "Aktualisieren".');
define('TEXT_PRODUCT_NOT_FOUND', '<b>Artikel nicht gefunden<b>');
define('TEXT_SHIPPING_SAME_AS_BILLING', 'Lieferadresse ist gleich Rechnungsadresse');
define('TEXT_BILLING_SAME_AS_CUSTOMER', 'Rechnungsadresse ist gleich Kundenadresse');

define('IMAGE_ADD_NEW_OT', 'neue Kundenorder nach dieser erstellen');
define('IMAGE_REMOVE_NEW_OT', 'Lösche diese Order');
define('IMAGE_NEW_ORDER_EMAIL', 'Sende neue Bestellbestätigung per Email');

define('TEXT_NO_ORDER_HISTORY', 'Keine Bestellhistorie verfügbar');

define('PLEASE_SELECT', 'Bitte wählen');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Ihre Bestellung wurde bearbeitet');
define('EMAIL_TEXT_ORDER_NUMBER', 'Bestellnummer:');
define('EMAIL_TEXT_INVOICE_URL', 'Detaillierte Übersicht:');
define('EMAIL_TEXT_DATE_ORDERED', 'Bestelldatum:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Herzlichen Dank für Ihre Bestellung!!' . "\n\n" . 'Der Status Ihrer Bestellung wurde geändert.' . "\n\n" . 'Der neue Status ist: %s' . "\n\n");
define('EMAIL_TEXT_STATUS_UPDATE2', 'Bei Fragen antworten Sie einfach auf diese Email.' . "\n\n" . 'Herzlichen Dank und freundliche Grüße vom Team ' . STORE_NAME . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Anmerkungen zu Ihrer Bestellung' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Fehler: Die Bestellung %s existiert nicht.');
define('ERROR_NO_ORDER_SELECTED', 'Du hast keine Bestellung zum Ändern ausgewählt, oder die Order-ID existiert nicht.');
define('SUCCESS_ORDER_UPDATED', 'Die Bestellung wurde erfolgreich aktualisiert.');
define('SUCCESS_EMAIL_SENT', 'Die Bestellung wurde erfolgreich aktualisiert und die Kundenemail wurde versandt.');

//the hints
define('HINT_UPDATE_TO_CC', 'Wenn die Zahlungsart auf ' . ORDER_EDITOR_CREDIT_CARD . ' gesetzt wird, erscheinen die Eingabefelder für die Kreditkartendaten automatisch.  Bei anderen Zahlungsweisen sind diese Felder unsichtbar.  Die Zahlungsart die Sie angeben müssen, um die Kreditkarteneingabefelder erscheinen zu lassen, wird unter Konfiguration "Order Editor" angegeben.');
define('HINT_UPDATE_CURRENCY', 'Eine Änderung der Währung erzeugt eine Aktualisierung der Gesamtsumme und der Versandarten.');
define('HINT_SHIPPING_ADDRESS', 'Nach Änderung der Lieferadresse (Postleitzahl, Stadt oder Land) erscheint die Option die Gesamtsumme neu zu berechnen und die Versandarten zu aktualisieren.');
define('HINT_TOTALS', 'Es ist möglich durch die Angabe "negativer Werte" einen Rabatt zu gewähren. Zwischensumme, Mehrwertsteuer und Gesamtsumme sind nicht editierbar. Beim Hinzufügen eines Wertes, ist es beim Einsatz von Ajax wichtig, das Feld umgehend auszufüllen, denn ansonsten bleibt es leer und wird dann automatisch wieder gelöscht.');
define('HINT_PRESS_UPDATE', 'Um die Änderungen durchzuführen, bitte "Aktualisieren" drücken.');
define('HINT_BASE_PRICE', 'Grundpreis ist der Artikelpreis ohne Produktattribute (z.B., der Katalogpreis)');
define('HINT_PRICE_EXCL', 'Price (excl) is the base price plus any product attributes prices that may exist');
define('HINT_PRICE_INCL', 'Preis (brutto) ist der Nettopreis multipliziert mit Mehrwertsteuer');
define('HINT_TOTAL_EXCL', 'Gesamt (netto) ist der Nettopreis multipliziert mit Menge');
define('HINT_TOTAL_INCL', 'Gesamt (brutto) ist der Nettopreis multipliziert mit Menge und Mehrwertsteuer');
//end hints

//new order confirmation email- this is a separate email from order status update
define('ENTRY_SEND_NEW_ORDER_CONFIRMATION', 'Um neue Bestellbestätigung per Email zu senden, bitte anklicken:');
define('EMAIL_TEXT_DATE_MODIFIED', 'Änderungsdatum:');
define('EMAIL_TEXT_PRODUCTS', 'Artikel');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Lieferadresse');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Rechnungsadresse');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Zahlungsweise');
// If you want to include extra payment information, enter text below (use <br> for line breaks):
//define('EMAIL_TEXT_PAYMENT_INFO', ''); //why would this be useful???
// If you want to include footer text, enter text below (use <br> for line breaks):
define('EMAIL_TEXT_FOOTER', '');
//end email

//add-on for downloads
define('ENTRY_DOWNLOAD_COUNT', 'Download #');
define('ENTRY_DOWNLOAD_FILENAME', 'Dateiname');
define('ENTRY_DOWNLOAD_MAXDAYS', 'Gültigkeitstage');
define('ENTRY_DOWNLOAD_MAXCOUNT', 'wie oft downgeloaded');

//add-on for Ajax
define('AJAX_CONFIRM_PRODUCT_DELETE', 'Artikel aus der Bestellung löschen?');
define('AJAX_CONFIRM_COMMENT_DELETE', 'Anmerkung aus der Bestellhistorie löschen?');
define('AJAX_MESSAGE_STACK_SUCCESS', ' \' + %s + \' wurde aktualisiert');
define('AJAX_CONFIRM_RELOAD_TOTALS', 'Du hast die Versandart geändert. Willst Du die Versandkosten und die Gesamtsumme neu berechnen?');
define('AJAX_CANNOT_CREATE_XMLHTTP', 'Kann keine XMLHTTP Umgebung erstellen');
define('AJAX_SUBMIT_COMMENT', 'Sende neue Anmerkungen und/oder den Status');
define('AJAX_NO_QUOTES', 'Es gibt keine Versandarten zum Anzeigen.');
define('AJAX_SELECTED_NO_SHIPPING', 'Du hast eine Versandart gewählt. Bisher waren keine Versandgebühren berechnet. Möchtest Du diese Versandgebühren hinzufügen?');
define('AJAX_RELOAD_TOTALS', 'Die neue Lieferadresse wurde gespeichert. Jetzt muss die Gesamtsumme neu berechnet werden.  Klicke OK zum neu berechnen.  Wenn Deine Internetverbindung langsam ist, so warte bitte bis alle Daten geladen wurden und klicke dann erst auf OK.');
define('AJAX_NEW_ORDER_EMAIL', 'Willst Du eine neue Bestellbestätigung per Email senden?');
define('AJAX_INPUT_NEW_EMAIL_COMMENTS', 'Anmerkungen eingeben.  Einfach leer lassen, wenn keine Anmerkungen gemacht werden sollen.  ACHTUNG: Zeilenumbrüche sind derzeit nicht möglich. -> "Enter" versendet die Email.');
define('AJAX_SUCCESS_EMAIL_SENT', 'Eine neue Bestellbestätigung wurde versendet an %s');
define('AJAX_WORKING', 'Beschäftigt, bitte warten....');
?>
