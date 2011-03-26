<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
// Copyright 2008 Brian Burton

  define('TEXT_PAYPALWPP_EC_HEADER', 'Pago rápido y seguro con PayPal');
  define('TEXT_PAYPALWPP_EC_BUTTON_TEXT', 'Ahorre tiempo. Pague con seguridad. Pague sin compartir sus datos financieros.');
  
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_TITLE', 'Pago directo PayPal');
  define('MODULE_PAYMENT_PAYPAL_EC_TEXT_TITLE', 'Pago exprés PayPal');
  define('EMAIL_EC_ACCOUNT_INFORMATION', '¡Gracias por utilizar el PAgo exprés Paypal! Para hace que su próxima visita sea aún más fluída, se ha creado automáticamente una cuenta para usted. Sus datos de inicio de sesión se han incluido a continuación:' . "\n\n");  

  define('TEXT_PAYPALWPP_EC_SWITCH_METHOD_1', '¡Actualmente está realizando el pago con el Pago exprés Paypal!');
  define('TEXT_PAYPALWPP_EC_SWITCH_METHOD_2', 'Pulse aquí para elejir otra forma de pago.');
  
  define('TEXT_PAYPALWPP_IPN_PENDING_COMMENT', 'El estado de su pago es "Pendiente" por el siguiente motivo:');
  define('TEXT_PAYPALWPP_IPN_REVERSED_COMMENT', 'El estado de su pago es "Revocado" o "Reembolsado" por el siguiente motivo:');
  define('TEXT_PAYPALWPP_IPN_COMPLETED_COMMENT', 'El estado de su pago es "Completado."');
  
  define('TEXT_PAYPALWPP_ERROR_PAYMENT_CLASS', 'Parece que faltan modificaciones en /includes/classes/payment.php. Por favor consulte la guía de instalación para obtener asistencia.');
  
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_ERROR_COUNTRY', 'Por desgracia no damos servicio en el país de la dirección que ha seleccionado. Si tiene alguna pregunta, por favor póngase en contacto con nosotros.');
  
  define('TEXT_PAYPALWPP_3DS_SUBMITTING', 'Está siendo enviado al sitio web de su banco para completar el proceso de pago.');
  define('TEXT_PAYPALWPP_3DS_AUTH_SUCCESS', '¡Autentificación de seguridad realizada con éxito!');
  define('TEXT_PAYPALWPP_3DS_AUTH_RETURNING_TO_CHECKOUT', 'Su pedido está siendo procesado ahora.');
?>