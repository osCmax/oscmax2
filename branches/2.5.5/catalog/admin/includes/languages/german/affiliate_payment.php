<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Zahlungsbericht');
define('HEADING_TITLE_SEARCH', 'Suchen:');
define('HEADING_TITLE_STATUS','Status:');

define('TEXT_ALL_PAYMENTS', 'Alle Zahlungen');
define('TEXT_NO_PAYMENT_HISTORY', 'Keine Zahlungshistorie verfügbar!');

define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_AFILIATE_NAME', 'Affiliate');
define('TABLE_HEADING_PAYMENT','Provision (inkl.)');
define('TABLE_HEADING_NET_PAYMENT','Provision (exkl.)');
define('TABLE_HEADING_DATE_BILLED','Abgerechnet am');
define('TABLE_HEADING_NEW_VALUE', 'Neuer Wert');
define('TABLE_HEADING_OLD_VALUE', 'Alter Wert');
define('TABLE_HEADING_AFFILIATE_NOTIFIED', 'Affiliate benachrichtigen');
define('TABLE_HEADING_DATE_ADDED', 'Hinzugefügt am:');

define('TEXT_DATE_PAYMENT_BILLED', 'Verrechnet am:');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Zuletzt geändert am:');
define('TEXT_AFFILIATE_PAYMENT', 'Provision');
define('TEXT_AFFILIATE_BILLED', 'Abrechnungstag');
define('TEXT_AFFILIATE', 'Affiliate');
define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie diese Provisionszahlung löschen möchten?');
define('TEXT_DISPLAY_NUMBER_OF_PAYMENTS', '<b>%d</b> bis <b>%d</b> (von insgesamt <b>%d</b> Provisionszahlungen)');

define('TEXT_AFFILIATE_PAYING_POSSIBILITIES', 'Auszahlungsmöglichkeiten:');
define('TEXT_AFFILIATE_PAYMENT_CHECK', 'per Scheck:');
define('TEXT_AFFILIATE_PAYMENT_CHECK_PAYEE', 'Empfänger des Schecks:');
define('TEXT_AFFILIATE_PAYMENT_PAYPAL', 'PayPal:');
define('TEXT_AFFILIATE_PAYMENT_PAYPAL_EMAIL', 'PayPal Konto E-Mail:');
define('TEXT_AFFILIATE_PAYMENT_BANK_TRANSFER', 'per Banküberweisung:');
define('TEXT_AFFILIATE_PAYMENT_BANK_NAME', 'Kreditinstitut:');
define('TEXT_AFFILIATE_PAYMENT_BANK_ACCOUNT_NAME', 'Kontoinhaber:');
define('TEXT_AFFILIATE_PAYMENT_BANK_ACCOUNT_NUMBER', 'Konto-Nr.:');
define('TEXT_AFFILIATE_PAYMENT_BANK_BRANCH_NUMBER', 'Bankleitzahl:');
define('TEXT_AFFILIATE_PAYMENT_BANK_SWIFT_CODE', 'SWIFT Code:');

define('TEXT_INFO_HEADING_DELETE_PAYMENT', 'Provisionszahlung löschen');

define('IMAGE_AFFILIATE_BILLING', 'Verrechnungs Engine starten');

define('ERROR_PAYMENT_DOES_NOT_EXIST', 'Fehler: Die Zahlung existiert nicht!');

define('SUCCESS_BILLING', 'Ihre Provisionen wurden erfolgreich abgerechnet!');
define('SUCCESS_PAYMENT_UPDATED', 'Der Status dieser Provisionsabrechnung wurde erfolgreich aktualisiert.');

define('PAYMENT_STATUS', 'Zahlungsstatus');
define('PAYMENT_NOTIFY_AFFILIATE', 'Affiliate benachrichtigen');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Provisionsaktualisierung');
define('EMAIL_TEXT_AFFILIATE_PAYMENT_NUMBER', 'Zahlungs-Nr.:');
define('EMAIL_TEXT_INVOICE_URL', 'Detaillierte Abrechnung:');
define('EMAIL_TEXT_PAYMENT_BILLED', 'Abgerechnet am');
define('EMAIL_TEXT_STATUS_UPDATE', 'Der Status Ihrer Provisionszahlung wurde geändert.' . "\n\n" . 'Neuer Status: %s' . "\n\n" . 'Bei Fragen zu Ihrer Provisionsabrechnung antworten Sie bitte auf diese eMail.' . "\n");
define('EMAIL_TEXT_NEW_PAYMENT', 'Eine neue Abrechnung über Ihre Provisionszahlungen wurde erstellt.' . "\n");
?>
