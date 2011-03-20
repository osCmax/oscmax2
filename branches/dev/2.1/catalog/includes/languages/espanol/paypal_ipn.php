<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_TITLE', 'Tarjeta de crédito/débito (por PayPal)');
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_DESCRIPTION', 'PayPal IPN v2.4');
  // BOF add by AlexStudio
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_SELECTION', '<img src="https://www.paypal.com/en_US/i/logo/PayPal_mark_37x23.gif" align="left" style="margin-right:7px;"> Tarjeta de crédito/débito (con PayPal)');
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_LAST_CONFIRM', '<img src="https://www.paypal.com/en_US/i/logo/PayPal_mark_37x23.gif" align="left" style="margin-right:7px;"> Tarjeta de crédito/débito (con PayPal)');
  // EOF add by AlexStudio

  // Sets the text for the "continue" button on the PayPal Payment Complete Page
  // Maximum of 60 characters!  
  define('CONFIRMATION_BUTTON_TEXT','Complete su confirmación del pedido');
  
  define('EMAIL_PAYPAL_PENDING_NOTICE','Su pago está pendiente. Le enviaremos una copia de su solicitud una vez que el pago haya sido aprobado.');
  
  define('EMAIL_TEXT_SUBJECT', 'Pedido');
  define('EMAIL_TEXT_ORDER_NUMBER', 'Número de pedido:');
  define('EMAIL_TEXT_INVOICE_URL', 'Detalles del pedido:');
  define('EMAIL_TEXT_DATE_ORDERED', 'Fecha del pedido:');
  define('EMAIL_TEXT_PRODUCTS', 'Productos');
  define('EMAIL_TEXT_SUBTOTAL', 'Subtotal:');
  define('EMAIL_TEXT_TAX', 'Impuestos:      ');
  define('EMAIL_TEXT_SHIPPING', 'Gastos de envío: ');
  define('EMAIL_TEXT_TOTAL', 'Total:    ');
  define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Direcciön de entrega');
  define('EMAIL_TEXT_BILLING_ADDRESS', 'Dirección de eacturación');
  define('EMAIL_TEXT_PAYMENT_METHOD', 'Forma de pago');

  define('EMAIL_SEPARATOR', '------------------------------------------------------');
  define('TEXT_EMAIL_VIA', 'por');
  
  define('PAYPAL_ADDRESS', 'Customer PayPal address');  

/* If you want to include a message with the order email, enter text here: */
/* Use \n for line breaks */
  define('MODULE_PAYMENT_PAYPAL_IPN_TEXT_EMAIL_FOOTER', '');
?>