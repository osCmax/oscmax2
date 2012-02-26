<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Bestellung #%s vom %s bearbeiten');
define('ADDING_TITLE', 'Artikel zur Bestellung #%s hinzufügen');

define('ENTRY_UPDATE_TO_CC', '(Aktualisiere ' . ORDER_EDITOR_CREDIT_CARD . ' , um die Kreditkartenfelder zu sehen.)');
define('TABLE_HEADING_COMMENTS', 'Anmerkung');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_NEW_STATUS', 'Neuer Status');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_DELETE', 'Löschen?');
define('TABLE_HEADING_QUANTITY', 'Menge');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Artikelnummer');
define('TABLE_HEADING_PRODUCTS', 'Produkte');
define('TABLE_HEADING_TAX', 'Steuer');
define('TABLE_HEADING_TOTAL', 'Gesamt');
define('TABLE_HEADING_BASE_PRICE', 'Grundreis');
define('TABLE_HEADING_UNIT_PRICE', 'Preis<br>(exkl. USt.)');
define('TABLE_HEADING_UNIT_PRICE_TAXED', 'Preis<br>(inkl. USt.)');
define('TABLE_HEADING_TOTAL_PRICE', 'Gesamt<br>(exkl. USt.)');
define('TABLE_HEADING_TOTAL_PRICE_TAXED', 'Gesamt<br>(inkl. USt.)');
define('TABLE_HEADING_OT_TOTALS', 'Order Gesamt:');
define('TABLE_HEADING_OT_VALUES', 'Wert:');
define('TABLE_HEADING_SHIPPING_QUOTES', 'Versandarten:');
define('TABLE_HEADING_NO_SHIPPING_QUOTES', 'Es können keine Versandarten angezeigt werden!');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Kunde benachrichtigt');
define('TABLE_HEADING_DATE_ADDED', 'Hinzugefügt am');

define('ENTRY_CUSTOMER', 'Kunde');
define('ENTRY_NAME', 'Name:');
define('ENTRY_CITY_STATE', 'Ort:');
define('ENTRY_SHIPPING_ADDRESS', 'Lieferadresse');
define('ENTRY_BILLING_ADDRESS', 'Rechnungsadresse');
define('ENTRY_PAYMENT_METHOD', 'Zahlungsart');
define('ENTRY_CREDIT_CARD_TYPE', 'Kreditkarte:');
define('ENTRY_CREDIT_CARD_OWNER', 'Karteninhaber:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Kartennummer:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'gültig bis:');
define('ENTRY_SUB_TOTAL', 'Zwischensumme:');
define('ENTRY_TYPE_BELOW', 'unten angeben');

//the definition of ENTRY_TAX is important when dealing with certain tax components and scenarios
define('ENTRY_TAX', 'Umsatzsteuer');
//do not use a colon (:) in the defintion, ie 'VAT' is ok, but 'VAT:' is not

define('ENTRY_SHIPPING', 'Versandart:');
define('ENTRY_TOTAL', 'Gesamt:');
define('ENTRY_STATUS', 'Status:');
define('ENTRY_NOTIFY_CUSTOMER', 'Kunde benachrichtigen:');
define('ENTRY_NOTIFY_COMMENTS', 'Sende Anmerkung:');
define('ENTRY_CURRENCY_TYPE', 'Währung');
define('ENTRY_CURRENCY_VALUE', 'Währungswert');

define('TEXT_INFO_PAYMENT_METHOD', 'Zahlungsart:');
define('TEXT_NO_ORDER_PRODUCTS', 'Diese Bestellung enthält keine Produkte');
define('TEXT_ADD_NEW_PRODUCT', 'Produkt hinzufügen');
define('TEXT_PACKAGE_WEIGHT_COUNT', 'Verpackungsgewicht: %s  |  Artikelanzahl: %s');

define('TEXT_STEP_1', '<b>Schritt 1:</b>');
define('TEXT_STEP_2', '<b>Schritt 2:</b>');
define('TEXT_STEP_3', '<b>Schritt 3:</b>');
define('TEXT_STEP_4', '<b>Schritt 4:</b>');
define('TEXT_SELECT_CATEGORY', '- Kategorie aus der Liste auswählen -');
define('TEXT_PRODUCT_SEARCH', '<b>- ODER einen Suchbegriff eingebe -</b>');
define('TEXT_ALL_CATEGORIES', 'Alle Kategorien/Alle Produkte');
define('TEXT_SELECT_PRODUCT', '- Ein Produkt auswählen -');
define('TEXT_BUTTON_SELECT_OPTIONS', 'Option auswählen');
define('TEXT_BUTTON_SELECT_CATEGORY', 'Diese Kategorie auswählen');
define('TEXT_BUTTON_SELECT_PRODUCT', 'Diesen Artikel auswählen');
define('TEXT_SKIP_NO_OPTIONS', '<em>Keine Optionen - Übersprungen...</em>');
define('TEXT_QUANTITY', 'Menge:');
define('TEXT_BUTTON_ADD_PRODUCT', 'Zur Bestellung hinzufügen');
define('TEXT_CLOSE_POPUP', '<u>Schließen</u> [x]');
define('TEXT_ADD_PRODUCT_INSTRUCTIONS', 'Fügen Sie Artikel hinzu, bis Sie fertig sind. <br> Schließen Sie danach dieses/n Tab/Fenster, kehren zum Hauptfenster zurück, und klicken auf "Aktualisieren".');
define('TEXT_PRODUCT_NOT_FOUND', '<b>Produkt nicht gefunden<b>');
define('TEXT_SHIPPING_SAME_AS_BILLING', 'Lieferadresse ist gleich Rechnungsadresse');
define('TEXT_BILLING_SAME_AS_CUSTOMER', 'Rechnungsadresse ist gleich Kundenadresse');

define('IMAGE_ADD_NEW_OT', 'Eine zusätzliche Zwischensumme einfügen');
define('IMAGE_REMOVE_NEW_OT', 'Zusätzliche Zwischensumme löschen');
define('IMAGE_NEW_ORDER_EMAIL', 'Bestellbestätigung per E-Mail versenden');

define('TEXT_NO_ORDER_HISTORY', 'Keine Bestellhistorie verfügbar');

define('PLEASE_SELECT', 'Bitte auswählen');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Ihre Bestellung wurde bearbeitet');
define('EMAIL_TEXT_ORDER_NUMBER', 'Bestellnummer:');
define('EMAIL_TEXT_INVOICE_URL', 'Detaillierte Rechnung:');
define('EMAIL_TEXT_DATE_ORDERED', 'Bestelldatum:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Herzlichen Dank für Ihre Bestellung!!' . "\n\n" . 'Der Status Ihrer Bestellung wurde geändert.' . "\n\n" . 'Der neue Status ist: %s' . "\n\n");
define('EMAIL_TEXT_STATUS_UPDATE2', 'Bei Fragen antworten Sie einfach auf diese Email.' . "\n\n" . 'Herzlichen Dank und freundliche Grüße vom Team ' . STORE_NAME . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Anmerkungen zu Ihrer Bestellung' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Fehler: Die Bestellung %s existiert nicht.');
define('ERROR_NO_ORDER_SELECTED', 'Sie haben keine Bestellung zum Ändern ausgewählt oder die Bestell-ID existiert nicht.');
define('SUCCESS_ORDER_UPDATED', 'Die Bestellung wurde erfolgreich aktualisiert.');
define('SUCCESS_EMAIL_SENT', 'Die Bestellung wurde erfolgreich aktualisiert und eine E-Mail wurde an den Kunden versandt.');

//the hints
define('HINT_UPDATE_TO_CC', 'Wenn die Zahlungsart auf ' . ORDER_EDITOR_CREDIT_CARD . ' gesetzt wird, erscheinen die Eingabefelder für die Kreditkartendaten automatisch. Bei anderen Zahlungsweisen sind diese Felder unsichtbar. Die Zahlungsart die Sie angeben müssen, um die Kreditkarteneingabefelder erscheinen zu lassen, wird unter Konfiguration "Order Editor" angegeben.');
define('HINT_UPDATE_CURRENCY', 'Eine Änderung der Währung erzeugt eine Aktualisierung der Gesamtsumme und der Versandarten.');
define('HINT_SHIPPING_ADDRESS', 'Nach Änderung der Lieferadresse (Postleitzahl, Stadt oder Land) können Sie die Gesamtsumme neu berechnen und die Versandarten aktualisieren.');
define('HINT_TOTALS', 'Sie können durch Angabe eines "negativer Wertes" einen Rabatt gewähren. Zwischensumme, Mehrwertsteuer und Gesamtsumme sind nicht änderbar. Beim Hinzufügen eines Wertes via Ajax ist es wichtig, das Titelfeld als erstes auszufüllen, denn ansonsten wird der Eintrag nicht erkannt und wird automatisch von der Bestellung gelöscht.');
define('HINT_PRESS_UPDATE', 'Zum Speichern der Änderungen bitte auf "Aktualisieren" klicken.');
define('HINT_BASE_PRICE', 'Der Grundpreis ist der Artikelpreis ohne Berücksichtigung der Produktattribute (z.B., der Katalogpreis)');
define('HINT_PRICE_EXCL', 'Der Nettopreis ist der Grundpreis zuzüglich etwaiger Attributpreise');
define('HINT_PRICE_INCL', 'Der Bruttopreis ist der Nettopreis einschließlich der Mehrwertsteuer');
define('HINT_TOTAL_EXCL', 'Der Nettogesamtpreis ist der Nettopreis multipliziert mit der Menge');
define('HINT_TOTAL_INCL', 'Der Bruttogesamtpreis ist der Nettopreis multipliziert mit der Menge und einschließlich der Mehrwertsteuer');
//end hints

//new order confirmation email- this is a separate email from order status update
define('ENTRY_SEND_NEW_ORDER_CONFIRMATION', 'Neue Bestellung bestätigen:');
define('EMAIL_TEXT_DATE_MODIFIED', 'Geändert am:');
define('EMAIL_TEXT_PRODUCTS', 'Produkte');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Lieferadresse');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Rechnungsadresse');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Zahlungsart');
// If you want to include extra payment information, enter text below (use <br> for line breaks):
//define('EMAIL_TEXT_PAYMENT_INFO', ''); //why would this be useful???
// If you want to include footer text, enter text below (use <br> for line breaks):
define('EMAIL_TEXT_FOOTER', '');
//end email

//add-on for downloads
define('ENTRY_DOWNLOAD_COUNT', 'Download #');
define('ENTRY_DOWNLOAD_FILENAME', 'Dateiname');
define('ENTRY_DOWNLOAD_MAXDAYS', 'Gültigkeitstage');
define('ENTRY_DOWNLOAD_MAXCOUNT', 'Verbleibende Downloads');

//add-on for Ajax
define('AJAX_CONFIRM_PRODUCT_DELETE', 'Sind Sie sicher, dass Sie das Produkt von der Bestellung löschen möchten?');
define('AJAX_CONFIRM_COMMENT_DELETE', 'Anmerkung aus der Bestellhistorie löschen?');
define('AJAX_MESSAGE_STACK_SUCCESS', ' \' + %s + \' wurde aktualisiert');
define('AJAX_CONFIRM_RELOAD_TOTALS', 'Sie haben die Versandart geändert. Möchten Sie Versandkosten und die Gesamtsumme neu berechnen?');
define('AJAX_CANNOT_CREATE_XMLHTTP', 'Kann keine XMLHTTP Umgebung erstellen');
define('AJAX_SUBMIT_COMMENT', 'Neue Anmerkungen und/oder Status versenden');
define('AJAX_NO_QUOTES', 'Es können keine Versandarten angezeigt werden.');
define('AJAX_SELECTED_NO_SHIPPING', 'Sie haben eine Versandart gewählt. Bisher waren keine Versandgebühren berechnet. Möchten Sie diese Versandgebühren hinzufügen?');
define('AJAX_RELOAD_TOTALS', 'Die neue Lieferadresse wurde gespeichert. Jetzt muss die Gesamtsumme neu berechnet werden. Klicken Sie auf OK für eine Neuberechnung. Wenn Ihre Internetverbindung langsam ist, warten Sie bitte, bis alle Daten geladen wurden, bevor Sie auf OK klicken.');
define('AJAX_NEW_ORDER_EMAIL', 'Möchten Sie eine neue Bestellbestätigung per E-Mail versenden?');
define('AJAX_INPUT_NEW_EMAIL_COMMENTS', 'Anmerkungen eingeben.  Einfach leer lassen, wenn keine Anmerkungen gemacht werden sollen.  ACHTUNG: Zeilenumbrüche sind derzeit nicht möglich. -> "Enter" versendet die Email.');
define('AJAX_SUCCESS_EMAIL_SENT', 'Eine neue Bestellbestätigung wurde versendet an %s');
define('AJAX_WORKING', 'Beschäftigt, bitte warten....');
?>
