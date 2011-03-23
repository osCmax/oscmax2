<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_TITLE', 'Kreditkarte/Debitkarte (via PayPal)');
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_DESCRIPTION', 'PayPal IPN v2.4');
  // BOF add by AlexStudio
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_SELECTION', '<img src="https://www.paypal.com/en_US/i/logo/PayPal_mark_37x23.gif" align="left" style="margin-right:7px;"> Kreditkarte/Debitkarte (via PayPal)');
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_LAST_CONFIRM', '<img src="https://www.paypal.com/en_US/i/logo/PayPal_mark_37x23.gif" align="left" style="margin-right:7px;"> Kreditkarte/Debitkarte (via PayPal)');
  // EOF add by AlexStudio

  // Sets the text for the "continue" button on the PayPal Payment Complete Page
  // Maximum of 60 characters!  
  define('CONFIRMATION_BUTTON_TEXT', 'Schließen Sie Ihren  Einkauf ab');
  
  define('EMAIL_PAYPAL_PENDING_NOTICE', 'Ihre Zahlung ist derzeit in Schwebe. Wir werden Ihnen eine Kopie Ihrer Bestellung senden, sobald die Zahlung eingegangen ist.');
  
  define('EMAIL_TEXT_SUBJECT', 'Auftragsabwicklung');
  define('EMAIL_TEXT_ORDER_NUMBER', 'Bestellnummer:');
  define('EMAIL_TEXT_INVOICE_URL', 'Detaillierte Rechnung:');
  define('EMAIL_TEXT_DATE_ORDERED', 'Bestelldatum:');
  define('EMAIL_TEXT_PRODUCTS', 'Produkte');
  define('EMAIL_TEXT_SUBTOTAL', 'Zwischensumme:');
  define('EMAIL_TEXT_TAX', 'Steuer:        ');
  define('EMAIL_TEXT_SHIPPING', 'Versand: ');
  define('EMAIL_TEXT_TOTAL', 'Gesamtsumme:    ');
  define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Lieferanschrift');
  define('EMAIL_TEXT_BILLING_ADDRESS', 'Rechnungsanschrift');
  define('EMAIL_TEXT_PAYMENT_METHOD', 'Zahlungsart');

  define('EMAIL_SEPARATOR', '------------------------------------------------------');
  define('TEXT_EMAIL_VIA', 'durch'); 

  define('PAYPAL_ADDRESS', 'Kunden-PayPal-Adresse');

/* If you want to include a message with the order email, enter text here: */
/* Use \n for line breaks */
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_EMAIL_FOOTER', '');
?>