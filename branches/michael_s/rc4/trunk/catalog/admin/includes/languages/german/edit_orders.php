<?php
/*
$Id: edit_orders.php 14 2006-07-28 17:42:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Bestellung bearbeiten');
define('HEADING_TITLE_NUMBER', 'Nr.');
define('HEADING_TITLE_DATE', 'of');
define('HEADING_SUBTITLE', 'Bitte bearbeiten Sie alle Abschnitte wie gew&uuml;nscht und klicken Sie danach unten auf "Aktualisieren".');
define('HEADING_TITLE_STATUS', 'Status:');
define('ADDING_TITLE', 'Artikel zu Bestellung hinzuf&uuml;gen');

define('HINT_UPDATE_TO_CC', 'Set payment method to ');
//ENTRY_CREDIT_CARD should be whatever is saved in your db as the payment method
//when your customer pays by Credit Card
define('ENTRY_CREDIT_CARD', 'Credit Card');
define('HINT_PRESS_UPDATE', 'Klicken Sie auf "Aktualisieren", um alle oben vorgenommenen &Auml;nderungen abzuspeichern.');
define('HINT_PRODUCTS_PRICES', 'Price and weight calculations are done on the fly, but you must hit update in order to save any changes.  Zero and negative values may be entered for quantity. If you want to delete a product, check the delete box and hit update. Weight fields are not editable.');
define('HINT_SHIPPING_ADDRESS', 'If the shipping destination is changed this may change the tax zone the order is in as well.  You will have to press the update button again to properly calculate tax totals in this case.');
define('HINT_TOTALS', 'Feel free to give discounts by adding negative values. Any field with a value of 0 is deleted when updating the order (exception: shipping).  Weight, subtotal, tax total, and total fields are not editable. On-the-fly calculations are estimates; small rounding differences are possible after updating.');
define('HINT_PRESS_UPDATE', 'Please click on "Update" to save all changes.');
define('HINT_BASE_PRICE', 'Price (base) is the products price before products attributes (ie, the catalog price of the item)');
define('HINT_PRICE_EXCL', 'Price (excl) is the base price plus any product attributes prices that may exist');
define('HINT_PRICE_INCL', 'Price (incl) is Price (excl) times tax');
define('HINT_TOTAL_EXCL', 'Total (excl) is Price (excl) times qty');
define('HINT_TOTAL_INCL', 'Total (incl) is Price (excl) times tax and qty');

define('TABLE_HEADING_COMMENTS', 'Kommentar');
define('TABLE_HEADING_STATUS', 'Neuer Status');
define('TABLE_HEADING_QUANTITY', 'Anz.');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Artikel-Nr.');
define('TABLE_HEADING_PRODUCTS_WEIGHT', 'Weight');
define('TABLE_HEADING_PRODUCTS', 'Produkte');
define('TABLE_HEADING_TAX', 'Steuer');
define('TABLE_HEADING_BASE_PRICE', 'Price (base)');
define('TABLE_HEADING_UNIT_PRICE', 'Preis (exkl.)');
define('TABLE_HEADING_UNIT_PRICE_TAXED', 'Preis (inkl.)');
define('TABLE_HEADING_TOTAL_PRICE', 'Total (exkl.)');
define('TABLE_HEADING_TOTAL_PRICE_TAXED', 'Total (inkl.)');
define('TABLE_HEADING_TOTAL_MODULE', 'Totalpreis-Komponente');
define('TABLE_HEADING_TOTAL_AMOUNT', 'Betrag');
define('TABLE_HEADING_TOTAL_WEIGHT', 'Total Weight: ');
define('TABLE_HEADING_DELETE', 'Löschung?');
define('TABLE_HEADING_SHIPPING_TAX', 'Shipping tax: ');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Kunde benachrichtigt');
define('TABLE_HEADING_DATE_ADDED', 'Eintragsdatum');

define('ENTRY_CUSTOMER_NAME', 'Name');
define('ENTRY_CUSTOMER_COMPANY', 'Firma');
define('ENTRY_CUSTOMER_ADDRESS', 'Adresse');
define('ENTRY_CUSTOMER_SUBURB', 'Ort');
define('ENTRY_CUSTOMER_CITY', 'Stadt');
define('ENTRY_CUSTOMER_STATE', 'Kanton');
define('ENTRY_CUSTOMER_POSTCODE', 'PLZ');
define('ENTRY_CUSTOMER_COUNTRY', 'Land');
define('ENTRY_CUSTOMER_PHONE', 'Telefon');
define('ENTRY_CUSTOMER_EMAIL', 'E-Mail');
define('ENTRY_ADDRESS', 'Address');

define('ENTRY_SHIPPING_ADDRESS', 'Versand-Adresse');
define('ENTRY_BILLING_ADDRESS', 'Rechnungs-Adresse');
define('ENTRY_PAYMENT_METHOD', 'Zahlungsart:');
define('ENTRY_CREDIT_CARD_TYPE', 'Karten-Typ:');
define('ENTRY_CREDIT_CARD_OWNER', 'Inhaber:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Nummer:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'G&uuml;ltig bis:');
define('ENTRY_SUB_TOTAL', 'Zwischensumme:');
//do not put a colon (" : ") in the definition of ENTRY_TAX
//ie entry should be 'Tax' NOT 'Tax:'
define('ENTRY_TAX', 'Steuer');
define('ENTRY_TOTAL', 'Gesamt:');
define('ENTRY_STATUS', 'Status der Bestellung:');
define('ENTRY_NOTIFY_CUSTOMER', 'Kunde benachrichtigen:');
define('ENTRY_NOTIFY_COMMENTS', 'Kommentar mitsenden:');

define('TEXT_NO_ORDER_HISTORY', 'Keine Bestellungen vorhanden');
define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_STATUS_UPDATE2', 'If you have questions, please reply to this email.' . "\n\n" . 'With warm regards from your friends at ' . STORE_NAME . "\n");
define('EMAIL_TEXT_SUBJECT', 'Ihre Bestellung bei BatterienOnline wurde aktualisiert');
define('EMAIL_TEXT_ORDER_NUMBER', 'Bestellnummer:');
define('EMAIL_TEXT_INVOICE_URL', 'Details zur Rechnung:');
define('EMAIL_TEXT_DATE_ORDERED', 'Bestelldatum:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Der Status Ihrer Bestellung wurde aktualisiert.' . "\n\n" . 'Neuer Status: %s' . "\n\n" . 'Bei Fragen antworten Sie bitte auf diese eMail.' . "\n\n" . 'Mit freundlichen Grüssen,' . "\n". 'Ihr BatterienOnline-Team' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Anmerkungen zur Bestellung' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Fehler: Bestellung existiert nicht.');
define('SUCCESS_ORDER_UPDATED', 'Fertig: Bestellung erfolgreich aktualisiert.');

define('ADDPRODUCT_TEXT_CATEGORY_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_SELECT_PRODUCT', 'W&auml;hle Artikel');
define('ADDPRODUCT_TEXT_PRODUCT_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_SELECT_OPTIONS', 'W&auml;hle Optionen');
define('ADDPRODUCT_TEXT_OPTIONS_CONFIRM', 'OK');
define('ADDPRODUCT_TEXT_OPTIONS_NOTEXIST', 'Artikel hat keine Optionen, wird &uuml;bersprungen...');
define('ADDPRODUCT_TEXT_CONFIRM_QUANTITY', 'St&uuml;ck des Artikels');
define('ADDPRODUCT_TEXT_CONFIRM_ADDNOW', 'Hinzuf&uuml;gen');
define('ADDPRODUCT_TEXT_STEP', 'Schritt');
define('ADDPRODUCT_TEXT_STEP1', ' &laquo; W&auml;hlen Sie einen Katalog. ');
define('ADDPRODUCT_TEXT_STEP2', ' &laquo; W&auml;hlen Sie einen Artikel. ');
define('ADDPRODUCT_TEXT_STEP3', ' &laquo; W&auml;hlen Sie eine Option. ');

define('MENUE_TITLE_CUSTOMER', '1. Kunden-Daten');
define('MENUE_TITLE_PAYMENT', '2. Zahlungsmodalit&auml;ten');
define('MENUE_TITLE_ORDER', '3. Bestellte Artikel');
define('MENUE_TITLE_TOTAL', '4. Rabatte, Lieferung und Total');
define('MENUE_TITLE_STATUS', '5. Status und Benachrichtigung');
define('MENUE_TITLE_UPDATE', '6. Daten aktualisieren');
?>
