<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright (c) 2004 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_TITLE', 'Carte de crédit/débit (via PayPal)');
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_DESCRIPTION', 'PayPal IPN v2.4');
  // BOF add by AlexStudio
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_SELECTION', '<img src="https://www.paypal.com/en_US/i/logo/PayPal_mark_37x23.gif" align="left" style="margin-right:7px;"> Carte de crédit/débit (via PayPal)');
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_LAST_CONFIRM', '<img src="https://www.paypal.com/en_US/i/logo/PayPal_mark_37x23.gif" align="left" style="margin-right:7px;"> Credit/Debit Card (via PayPal)');
  // EOF add by AlexStudio

  // Sets the text for the "continue" button on the PayPal Payment Complete Page
  // Maximum of 60 characters!  
  define('CONFIRMATION_BUTTON_TEXT', 'Compl&eacute;tez votre confirmation de commande');

  define('EMAIL_PAYPAL_PENDING_NOTICE', 'Votre paiement est actuellement en instance. Nous vous enverrons une copie de votre commande une fois que le paiement exécuté.');

  define('EMAIL_TEXT_SUBJECT', 'Processus de commande');
  define('EMAIL_TEXT_ORDER_NUMBER', 'Num&eacute;ro de commande:');
  define('EMAIL_TEXT_INVOICE_URL', 'Facture d&eacute;taill&eacute;e:');
  define('EMAIL_TEXT_DATE_ORDERED', 'Date de la commande:');
  define('EMAIL_TEXT_PRODUCTS', 'Produits');
  define('EMAIL_TEXT_SUBTOTAL', 'Sous-total:');
  define('EMAIL_TEXT_TAX', 'TVA:        ');
  define('EMAIL_TEXT_SHIPPING', 'Livraison:');
  define('EMAIL_TEXT_TOTAL', 'Total:');
  define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Adresse de livraison');
  define('EMAIL_TEXT_BILLING_ADDRESS', 'Adresse de facturation');
  define('EMAIL_TEXT_PAYMENT_METHOD', 'Mode de paiement');

  define('EMAIL_SEPARATOR', '------------------------------------------------------');
  define('TEXT_EMAIL_VIA', 'via');

  define('PAYPAL_ADDRESS', 'Adresse client de Paypal');

/* If you want to include a message with the order email, enter text here: */
/* Use \n for line breaks */
define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_EMAIL_FOOTER', '');
?>