<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
// Copyright 2008 Brian Burton

  define('FILENAME_EXPRESS_CHECKOUT_IMG', 'https://www.paypal.com/de_DE/i/btn/btn_xpressCheckout.gif');

  define('TEXT_PAYPALWPP_EC_HEADER', 'Schneller und sicherer Kaufabschluß mit PayPal');
  define('TEXT_PAYPALWPP_EC_BUTTON_TEXT', 'Sparen Sie Zeit. Schließen Sie Ihren Einkauf sicher ab. Bezahlen Sie, ohne Ihre Kontodaten weiterzugeben.');
  
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_TITLE', 'PayPal Direct Payment');
  define('MODULE_PAYMENT_PAYPAL_EC_TEXT_TITLE', 'PayPal Express Checkout');
  define('EMAIL_EC_ACCOUNT_INFORMATION', 'Vielen Dank, dass Sie PayPal Express Checkout benutzen! Um Ihren nächsten Besuch bei uns noch einfacher zu machen, wurde automatisch ein Konto für Sie angelegt. Ihre Anmeldedaten finden Sie nachstehend:' . "\n\n");  

  define('TEXT_PAYPALWPP_EC_SWITCH_METHOD_1', 'Sie schließen Ihren Einkauf mit PayPal Express Checkout ab!');
  define('TEXT_PAYPALWPP_EC_SWITCH_METHOD_2', 'Klicken Sie hier, um eine andere Zahlungsart auszuwählen.');
  
  define('TEXT_PAYPALWPP_IPN_PENDING_COMMENT', 'Der Status Ihrer Zahlung lautet "Schwebend". Der Grund dafür ist:');
  define('TEXT_PAYPALWPP_IPN_REVERSED_COMMENT', 'Der Status Ihrer Zahlung lautet "Rückgebucht" oder "Rückerstattet". Der Grund dafür ist:');
  define('TEXT_PAYPALWPP_IPN_COMPLETED_COMMENT', 'Der Status Ihrer Zahlung lautet "Abgeschlossen."');
  
  define('TEXT_PAYPALWPP_ERROR_PAYMENT_CLASS', 'Anscheinend fehlen Anpassungen in der Datei /includes/classes/payment.php. Bitte lesen Sie die Installationsanleitung für weitere Informationen.');
  
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_ERROR_COUNTRY', 'Leider bieten wir in dem Land, welches Sie gewählt haben, unsere Dienstleistung nicht an. Bitte kontaktieren Sie uns für weitere Auskünfte.');
  
  define('TEXT_PAYPALWPP_3DS_SUBMITTING', 'Sie werden nun auf die Website Ihrer Bank weitergeleitet, um Ihren Einkauf abzuschließen.');
  define('TEXT_PAYPALWPP_3DS_AUTH_SUCCESS', 'Sicherheitsauthentifizierung erfolgreich!');
  define('TEXT_PAYPALWPP_3DS_AUTH_RETURNING_TO_CHECKOUT', 'Ihre Bestellung wird nun bearbeitet.');
?>