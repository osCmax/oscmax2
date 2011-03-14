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
*/

define('NAVBAR_TITLE', 'Einkauf abschließen');
define('NAVBAR_TITLE_1', 'Einkauf abschließen');

define('HEADING_TITLE', 'Einkauf abschließen');

define('TABLE_HEADING_SHIPPING_ADDRESS', 'Lieferadresse');
define('TABLE_HEADING_BILLING_ADDRESS', 'Rechnungsadresse');

define('TABLE_HEADING_PRODUCTS_MODEL', 'Artikelnummer');
define('TABLE_HEADING_PRODUCTS_NAME', 'Produktbezeichnung');
define('TABLE_HEADING_PRODUCTS_QTY', 'Anzahl');
define('TABLE_HEADING_PRODUCTS_PRICE', 'Einzelpreis');
define('TABLE_HEADING_PRODUCTS_FINAL_PRICE', 'Gesamtpreis');
define('TABLE_HEADING_PRODUCTS_REMOVE_ITEM', 'Produkt entfernen');

define('TABLE_HEADING_PRODUCTS', 'Warenkorb');
define('TABLE_HEADING_TAX', 'USt.');
define('TABLE_HEADING_TOTAL', 'Gesamt');

define('ENTRY_TELEPHONE', 'Telefon: ');

define('TEXT_CHOOSE_SHIPPING_DESTINATION', 'Bitte wählen Sie eine Lieferanschrift aus Ihrem Adressbuch aus.');
define('TEXT_SELECTED_BILLING_DESTINATION', 'Bitte wählen Sie eine Rechnungsanschrift aus Ihrem Adressbuch aus.');

define('TITLE_SHIPPING_ADDRESS', 'Lieferadresse:');
define('TITLE_BILLING_ADDRESS', 'Rechnungsadresse:');

define('TABLE_HEADING_SHIPPING_METHOD', 'Versandart');
define('TABLE_HEADING_PAYMENT_METHOD', 'Zahlungsart');

define('TEXT_CHOOSE_SHIPPING_METHOD', 'Bitte wählen Sie die gewünschte Versandart für diese Bestellung aus.');
define('TEXT_SELECT_PAYMENT_METHOD', 'Bitte wählen Sie die gewünschte Zahlungsart für diese Bestellung aus.');

define('TITLE_PLEASE_SELECT', 'Bitte wählen Sie');

define('TEXT_ENTER_SHIPPING_INFORMATION', 'Derzeit steht nur die folgende Versandart zur Verfügung.');
define('TEXT_ENTER_PAYMENT_INFORMATION', 'Derzeit steht nur die folgende Zahlungsart zur Verfügung.');

define('TABLE_HEADING_COMMENTS', 'Sie können Ihrer Bestellung eine Anmerkung hinzufügen');

define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', 'Setzen Sie den Vorgang fort,');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', 'um Ihre Bestellung abzuschließen.');

define('TEXT_EDIT', 'Bearbeiten');

define('TEXT_SELECTED_SHIPPING_DESTINATION', 'Dies ist die derzeit ausgewählte Lieferadresse.');
define('TABLE_HEADING_NEW_ADDRESS', 'Neue Adresse');
define('TABLE_HEADING_EDIT_ADDRESS', 'Adresse bearbeiten');
define('TEXT_CREATE_NEW_SHIPPING_ADDRESS', 'Bitte benutzen Sie das nachstehende Formular, um eine neue Lieferadresse zu erstellen.');
define('TABLE_HEADING_ADDRESS_BOOK_ENTRIES', 'Adressbucheinträge');

define('EMAIL_SUBJECT', 'Willkommen bei ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Sehr geehrter Herr %s,' . "\n\n");
define('EMAIL_GREET_MS', 'Sehr geehrte Frau %s,' . "\n\n");
define('EMAIL_GREET_NONE', 'Hallo %s' . "\n\n");
define('EMAIL_WELCOME', 'Willkommen im Onlineshop von <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'Sie können nun die <b>erweiterten Funktionen</b> nutzen, die unser Shop für Sie bereit hält, wie etwa:' . "\n\n" . '<li><b>Persönlicher Warenkorb</b> - Der aktuelle Inhalt Ihres Warenkorbes wird beim Abmelden gespeichert und steht Ihnen bei der nächsten Anmeldung wieder zur Verfügung.' . "\n" . '<li><b>Adressbuch</b> - Speichern Sie unterschiedliche Lieferanschriften für künftige Bestellungen in Ihrem persönlichen Adressbuch ab.' . "\n" . '<li><b>Frühere Bestellungen</b> - Sie erhalten eine Übersicht aller von Ihnen getätigten Bestellungen.' . "\n" . '<li><b>Produktbewertungen</b> - Verfassen Sie einen Erfahrungsbericht zu unseren Produkten und veröffentlichen Sie ihn online.' . "\n\n");
define('EMAIL_CONTACT', 'Bei Fragen zu unserem Onlineshop wenden Sie sich bitte an: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Hinweis:</b> Diese email-Adresse wird von einem Kundenkonto in unserem Onlineshop verwendet. Falls Sie sich nicht als Kunde in unserem Onlineshop angemeldtet haben, senden Sie bitte eine email an ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

// Start - CREDIT CLASS Gift Voucher Contribution
define('EMAIL_GV_INCENTIVE_HEADER', "\n\n" .'Als Wilkommensgeschenk f&ur Neukunden haben wir Ihnen einen Gutschein im Wert von %s übersandt');
define('EMAIL_GV_REDEEM', 'Der Gutscheincode lautet %s und kann entweder bei Ihrem nächsten Einkauf eingelöst werden,');
define('EMAIL_GV_LINK', 'oder wenn Sie diesem Link folgen ');
define('EMAIL_COUPON_INCENTIVE_HEADER', 'Herzlichen Glückwunsch! Um Ihren ersten Einkauf in unserem Onlineshop noch lohnender für Sie zu machen, übersenden wir Ihnen einen Gutschein.' . "\n" . ' Nachstehend finden Sie die Details Ihres persönlichen Gutscheins' . "\n");

define('EMAIL_COUPON_REDEEM', 'Um den Gutschein einzulösen, geben Sie den angegebenen Code %s beim Abschließen Ihrer Bestellung in das entsprechende Feld ein');
// End - CREDIT CLASS Gift Voucher Contribution

define('TEXT_AGREE_TO_TERMS', 'Ich stimme den Allgemeinen Geschäftsbedingungen zu');

define('WINDOW_BUTTON_CANCEL', 'Abbrechen');
define('WINDOW_BUTTON_CONTINUE', 'Übernehmen');
define('WINDOW_BUTTON_NEW_ADDRESS', 'Neue Adresse');
define('WINDOW_BUTTON_EDIT_ADDRESS', 'Adresse bearbeiten');

define('TEXT_PLEASE_SELECT', 'Bitte wählen Sie');
define('TEXT_PASSWORD_FORGOTTEN', 'Password vergessen? Hier klicken.');
define('IMAGE_UPDATE_CART', 'Warenkorb aktualisieren');
define('IMAGE_LOGIN', 'Anmelden');
define('TEXT_PAYMENT_METHOD_UPDATE_ERROR', 'Bitte versuchen Sie es noch einmal. Falls das Problem weiterhin besteht, wählen Sie bitte eine andere Zahlungsart.');
define('TEXT_HAVE_COUPON_CCGV', 'Möchten Sie einen Gutschein einlösen?');
define('TEXT_HAVE_COUPON_KGT', 'Möchten Sie einen Gutschein einlösen?');
define('TEXT_EXISTING_CUSTOMER_LOGIN', 'Haben Sie schon ein Kundenkonto erstellt?');
define('TEXT_DIFFERENT_SHIPPING', 'Abweichend von der Rechnungsadresse?');
define('TEXT_SHIPPING_NO_ADDRESS', 'Bitte geben Sie <b>zumindest</b> Ihre Rechnungsanschrift an, um die Frachtkosten berechnen zu lassen.');
define('TEXT_CHECKOUT_UPDATE_VIEW_ORDER', 'aktualisieren/anzeigen der Bestellung.');
define('CHECKOUT_BAR_CONFIRMATION', 'Bestellung abschließen');
// Points/Rewards Module V2.1rc2a BOF
define('TABLE_HEADING_REDEEM_SYSTEM', 'Treuepunkte einlösen ');
define('TABLE_HEADING_REFERRAL', 'Treuepunkte übertragen');
define('TEXT_REDEEM_SYSTEM_START', 'Sie haben ein Guthaben von %s . Möchten Sie es für diese Bestellung verwenden?<br />Die voraussichtliche Gesamtsumme Ihrer Bestellung beträgt: %s .');
define('TEXT_REDEEM_SYSTEM_SPENDING', 'Setzen Sie hier einen Haken, wenn Sie die höchstmögliche Punktezahl einlösen möchten, die bei diesem Einkauf möglich ist. (%s Punktes %s)&nbsp;&nbsp;->');
define('TEXT_REDEEM_SYSTEM_NOTE', '<span class="pointWarning">Die Gesamtsumme ist höher, als die höchstzulässige Treuepunktanzahl, daher müssen Sie auch eine Zahlungsart auswählen</span>');
define('TEXT_REFERRAL_REFERRED', 'Wenn Sie von einem Bekannten an un weiterempfohlen wurden, geben Sie bitte dessen email-Adresse an. ');
// Points/Rewards Module V2.1rc2a EOF
define('TERMS_PART_1', 'Bitte bestätigen Sie, dass Sie unsere AGB gelesen und akzeptiert haben:');
define('TERMS_PART_2', '<br/><b><u>Allgemeine Geschäftsbedingungen</u></b>');

define('TEXT_NO_JAVASCRIPT', 'Sie haben JavaScript deaktiviert.');
define('TEXT_ENABLE_JAVSCRIPT_INSTRUCTIONS', '<p style="font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold">Bitte befolgen Sie die Anweisungen für Ihren Webbrowser, um Ihre Bestellung abschließen zu können:<br /><br />Internet Explorer</p>
 <ol style="font-family: Arial, Helvetica, sans-serif; font-size:12px;">
  <li>Klicken Sie im Hauptmenü auf&nbsp;<strong>Extras</strong>, anschließend auf&nbsp;<strong>Internetoptionen</strong>&nbsp;und dann auf den Karteireiter&nbsp;<strong>Sicherheit</strong>.</li>
  <li>Klicken Sie auf das&nbsp;<strong>Internet</strong>&nbsp;Symbol.</li>
  <li>Wenn Sie die Grundeinstellungen aktivieren möchten, klicken Sie auf&nbsp;<strong>Standardstufe</strong>. Folgen Sie nun den Anweisungen bei Punkt 4.<blockquote>Wenn Sie Ihre Interneteinstellungen behalten und nur JavaScript aktivieren möchten, befolgen Sie diese Schritte:<br />
	a. Klicken Sie auf&nbsp;<strong>Stufe anpassen...</strong>.<br />
	b. Im Fenster&nbsp;<strong>Sicherheitseinstellungen &ndash; Internetzone</strong>&nbsp;gehen Sie zu&nbsp;<strong>Skripting</strong>&nbsp;und klicken unter&nbsp;<strong>Active Scripting</strong>&nbsp;auf <strong>Aktivieren</strong>.</blockquote></li>
  <li>Klicken Sie auf&nbsp;<strong>OK</strong>, um die Einstellungsfenster zu verlassen. Laden Sie im Browser die Seite neu, indem Sie entweder die <strong>F5-Taste</strong> drücken oder den <strong>Refresh-Button</strong> anklicken.</li>
 </ol>
 <p style="font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold"><br />Firefox</p>
 <ol style="font-family: Arial, Helvetica, sans-serif; font-size:12px;">
  <li>Klicken Sie im Menü <strong>Extras</strong>&nbsp;auf&nbsp;<strong>Einstellungen...</strong>.</li>
  <li>Klicken Sie auf das Symbol&nbsp;<strong>Inhalt</strong>&nbsp; und haken Sie&nbsp;<strong>JavaScript aktiviert</strong>&nbsp;an.</li>
  <li>Klicken Sie auf&nbsp;<strong>OK</strong>, um die Einstellungsfenster zu verlassen. Laden Sie die Seite neu, indem Sie entweder die <strong>F5-Taste</strong> drücken oder den <strong>Refresh-Button</strong> anklicken.</li>
 </ol>
 <p style="font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold"><br />Safari</p>
 <ol style="font-family: Arial, Helvetica, sans-serif; font-size:12px;">
  <li>Klicken Sie im Menü auf <strong>Ein Menü für allgemeine Safarieinstellungen anzeigen.</strong>-Menü.</li>
  <li>Wählen Sie die <strong>Einstellungen ...</strong>.</li>
  <li>Klicken Sie auf das Symbol&nbsp;<strong>Inhalt</strong>.</li>
  <li>Haken Sie&nbsp;<strong>JavaScript aktivieren</strong>&nbsp;an.</li>
 </ol>
 <p>&nbsp;</p>');
?>