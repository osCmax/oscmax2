<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
/*
  One Page Checkout, Version: 1.08

  I.T. Web Experts
  http://www.itwebexperts.com

  Copyright (c) 2009 I.T. Web Experts

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Einkauf abschlie&szlig;en');
define('NAVBAR_TITLE_1', 'Einkauf abschlie&szlig;en');

define('HEADING_TITLE', 'Einkauf abschlie&szlig;en');

define('TABLE_HEADING_SHIPPING_ADDRESS', 'Lieferadresse');
define('TABLE_HEADING_BILLING_ADDRESS', 'Rechnungsadresse');

define('TABLE_HEADING_PRODUCTS_MODEL', 'Artikelnummer');
define('TABLE_HEADING_PRODUCTS_NAME', 'Produktbezeichnung');
define('TABLE_HEADING_PRODUCTS_QTY', 'Anzahl');
define('TABLE_HEADING_PRODUCTS_PRICE', 'Einzelpreis');
define('TABLE_HEADING_PRODUCTS_FINAL_PRICE', 'Gesamtpreis');
define('TABLE_HEADING_PRODUCTS_REMOVE_ITEM', 'Produkt entfernen');

define('TABLE_HEADING_PRODUCTS', 'Warenkorb');
define('TABLE_HEADING_TAX', 'Steuer');
define('TABLE_HEADING_TOTAL', 'Gesamt');

define('ENTRY_TELEPHONE', 'Telefon: ');

define('TEXT_CHOOSE_SHIPPING_DESTINATION', 'Bitte &auml;hlen Sie in Ihrem Adressbuch eine Lieferanschrift aus.');
define('TEXT_SELECTED_BILLING_DESTINATION', 'Bitte w&auml;hlen Sie in Ihrem Adressbuch eine Rechnungsanschrift aus.');

define('TITLE_SHIPPING_ADDRESS', 'Lieferadresse:');
define('TITLE_BILLING_ADDRESS', 'Rechnungsadresse:');

define('TABLE_HEADING_SHIPPING_METHOD', 'Versandart');
define('TABLE_HEADING_PAYMENT_METHOD', 'Zahlungsart');

define('TEXT_CHOOSE_SHIPPING_METHOD', 'Bitte w&auml;hlen Sie die gew&uuml;nschte Versandart f&uuml;r diese Bestellung aus.');
define('TEXT_SELECT_PAYMENT_METHOD', 'Bitte w&auml;hlen Sie die gew&uuml;nschte Zahlungsart f&uuml;r diese Bestellung aus.');

define('TITLE_PLEASE_SELECT', 'Bitte w&auml;hlen Sie');

define('TEXT_ENTER_SHIPPING_INFORMATION', 'Derzeit steht nur die folgende Versandart zur Verf&uuml;gung.');
define('TEXT_ENTER_PAYMENT_INFORMATION', 'Derzeit steht nur die folgende Zahlungsart zur Verf&uuml;gung.');

define('TABLE_HEADING_COMMENTS', 'F&uuml;gen Sie Ihrer Bestellung eine Anmerkung hinzu');

define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', 'Einkauf abschlie&szlig;en');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', 'Ihre Bestellung wird &uuml;bermittelt.');

define('TEXT_EDIT', '&Auml;ndern');

define('TEXT_SELECTED_SHIPPING_DESTINATION', 'Dies ist die derzeit ausgew&auml;hlte Lieferadresse.');
define('TABLE_HEADING_NEW_ADDRESS', 'Neue Adresse');
define('TABLE_HEADING_EDIT_ADDRESS', 'Adresse &auml;ndern');
define('TEXT_CREATE_NEW_SHIPPING_ADDRESS', 'Bitte benutzen Sie das nachstehende Formular, um eine neue Lieferadresse anzugeben.');
define('TABLE_HEADING_ADDRESS_BOOK_ENTRIES', 'Adressbucheintr&auml;ge');

define('EMAIL_SUBJECT', 'Wilkommen bei ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Sehr geehrter Herr %s,' . "\n\n");
define('EMAIL_GREET_MS', 'Sehr geehrte Frau %s,' . "\n\n");
define('EMAIL_GREET_NONE', 'Sehr geehrte(r) %s' . "\n\n");
define('EMAIL_WELCOME', 'Wir begrüßen Sie im Onlineshop von <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'Sie können nun die <b>erweiterten Funktionen</b> nutzen, die unser Shop für Sie bereit hält, wie etwa:' . "\n\n" . '<li><b>Persönlicher Warenkorb</b> - Der aktuelle Inhalt Ihres Warenkorbes wird beim Abmelden gespeichert und steht Ihnen bei der nächsten Anmeldung wieder zur Verfügung.' . "\n" . '<li><b>Adressbuch</b> - Speichern Sie unterschiedliche Lieferanschriften für künftige Bestellungen in Ihrem persönlichen Adressbuch ab.' . "\n" . '<li><b>Frühere Bestellungen</b> - Sie erhalten eine Übersicht aller von Ihnen getätigten Bestellungen.' . "\n" . '<li><b>Produktbewertungen</b> - Verfassen Sie einen Erfahrungsbericht zu unseren Produkten und veröffentlichen Sie ihn online.' . "\n\n");
define('EMAIL_CONTACT', 'F&uuml;r Fragen zu unserem Onlineshop wenden Sie sich bitte an, please email the store-owner: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Hinweis:</b> Diese email-Adresse wird von einem Kundenkonto in unserem Onlineshop verwendet. Falls Sie sich nicht als Kunde in unserem Onlineshop angemeldtet haben, senden Sie bitte eine email an ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

// Start - CREDIT CLASS Gift Voucher Contribution
define('EMAIL_GV_INCENTIVE_HEADER', "\n\n" .'Als Wilkommensgeschenk f&ur Neukunden haben wir Ihnen einen Gutschein im Wert von %s &uuml;bersandt');
define('EMAIL_GV_REDEEM', 'Der Gutscheincode lautet %s und kann entweder bei Ihrem nächsten Einkauf eingelöst werden,');
define('EMAIL_GV_LINK', 'oder wenn Sie diesem Link folgen ');
define('EMAIL_COUPON_INCENTIVE_HEADER', 'Herzlichen Glückwunsch! Um Ihren ersten Einkauf in unserem Onlineshop noch lohnender für Sie zu machen, übersenden wir Ihnen einen Gutschein.' . "\n" . ' Nachstehend finden Sie die Details Ihres pers&ouml;hnlichen Gutscheins' . "\n");
define('EMAIL_COUPON_REDEEM', 'Um den Gutschein einzul&ouml;sen, geben Sie den angegebenen Code %s beim Abschließen Ihrer Bestellung in das entsprechende Feld ein');
// End - CREDIT CLASS Gift Voucher Contribution

define('TEXT_AGREE_TO_TERMS', 'Ich stimme den allgemeinen Geschäftsbedingungen zu');

// BEGIN - The german Umlauts must not be masked, because they would not be shown propperly in the Address change Popup Windows! Tested with osCmax 2.5 beta 2
define('WINDOW_BUTTON_CANCEL', 'Abbrechen');
define('WINDOW_BUTTON_CONTINUE', 'Übernehmen');
define('WINDOW_BUTTON_NEW_ADDRESS', 'Neue Adresse');
define('WINDOW_BUTTON_EDIT_ADDRESS', 'Adresse ändern');
// END - The german Umlauts...

define('TEXT_PLEASE_SELECT', 'Bitte w&auml;hlen Sie');
define('TEXT_PASSWORD_FORGOTTEN', 'Password vergessen? Hier klicken.');
define('IMAGE_UPDATE_CART', 'Warenkorb aktualisieren');
define('IMAGE_LOGIN', 'Anmelden');
define('TEXT_PAYMENT_METHOD_UPDATE_ERROR', 'Bitte versuchen Sie es noch einmal. Falls das Problem weiterhin besteht, w&auml;hlen Sie bitte eine andere Zahlungsart.');
define('TEXT_HAVE_COUPON_CCGV', 'M&ouml;chten Sie einen Gutschein einlösen?');
define('TEXT_HAVE_COUPON_KGT', 'M&ouml;chten Sie einen Gutschein einlösen?');
define('TEXT_EXISTING_CUSTOMER_LOGIN', 'Haben Sie schon ein Kundenkonto erstellt?');
define('TEXT_DIFFERENT_SHIPPING', 'Abweichend von der Rechnungsadresse?');
define('TEXT_SHIPPING_NO_ADDRESS', 'Bitte geben Sie <b>zumindest</b> Ihre Rechnungsanschrift an, um die Frachtkosten berechnen zu lassen.');
define('TEXT_CHECKOUT_UPDATE_VIEW_ORDER', 'aktualisieren/anzeigen der Bestellung.');
define('CHECKOUT_BAR_CONFIRMATION', 'Bestellung abschliessen');
// Points/Rewards Module V2.1rc2a BOF
define('TABLE_HEADING_REDEEM_SYSTEM', 'Treuepunkte einl&ouml;sen ');
define('TABLE_HEADING_REFERRAL', 'Treuepunkte &uuml;bertragen');
define('TEXT_REDEEM_SYSTEM_START', 'Sie haben ein Guthaben &uuml;ber %s . M&ouml;chten Sie es f&uuml;r diese Bestellung verwenden?<br />Die voraussichtliche Gesamtsumme Ihrer Bestellung betr&auml;gt: %s .');
define('TEXT_REDEEM_SYSTEM_SPENDING', 'Setzen Sie hier einen Haken, wenn Sie die h&ouml;chstm&ouml;gliche Punktezahl einl&ouml;sen m&ouml;chten, die bei diesem Einkauf m&ouml;glich ist. (%s points %s)&nbsp;&nbsp;->');
define('TEXT_REDEEM_SYSTEM_NOTE', '<span class="pointWarning">Die Gesamtsumme ist h&ouml;her als die zul&auml;ssige Treuepunktanzahl, daher m&uuml;ssen Sie auch eine Zahlungsart ausw&auml;hlen</span>');
define('TEXT_REFERRAL_REFERRED', 'Wenn Sie von einem Bekannten an un weiterempfohlen wurden, geben Sie bitte dessen email-Adresse an. ');
// Points/Rewards Module V2.1rc2a EOF
define('TERMS_PART_1', 'Bitte best&auml;tigen Sie, da&szlig; Sie unsere AGB gelesen und akzeptiert haben.');
define('TERMS_PART_2', '<br/><b><u>Allgemeine Gesch&auml;ftsbedingungen anzeigen</u></b>');
?>