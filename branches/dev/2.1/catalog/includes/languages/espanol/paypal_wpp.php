<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
// Copyright 2008 Brian Burton

  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_TITLE', 'Pago directo PayPal');
  define('MODULE_PAYMENT_PAYPAL_EC_TEXT_TITLE', 'Pago exprés PayPal');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_DESCRIPTION', '<center><b><h2>PayPal Pro para osCommerce 2.2MS2+</h2>Direct Payment & Express Checkout<br><br><i>Desarrollado y mantenido por:</i><br><a href="http://forums.oscommerce.com/index.php?showuser=80233">Brian Burton (dynamoeffects)</a></b></center>');
  define('MODULE_PAYMENT_PAYPAL_DP_ERROR_HEADING', 'Lo sentimos, pero no se pudo procesar la información de su tarjeta de crédito.');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CARD_ERROR', 'Los datos de la tarjeta de crédito introducidos contienen un error. Por favor revíselos y pruebe de nuevo.');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_FIRSTNAME', 'Nombre en tarjeta de crédito:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_LASTNAME', 'Apellidos en tarjeta de crédito:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_TYPE', 'Tipo de tarjeta:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_NUMBER', 'Número de tarjeta:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_EXPIRES', 'Fecha validez tarjeta:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_CHECKNUMBER', 'Código de seguridad de tarjeta:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_CHECKNUMBER_LOCATION', '¿Qué es esto?');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_START_MONTH', 'Mes inicio Solo/Maestro:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_START_YEAR', 'Año inicio Solo/Maestro:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_ISSUE_NUMBER', 'Código seguridad (issue number) Solo/Maestro:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_SWITCHSOLO_ONLY', '(necesario sólo para tarjetas Maestro/Solo)');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_DECLINED', 'Su tarjeta ha sido rechazada. Por favor pruebe con otra tarjeta o contacte con su banco para obtener más información.<br><br>');
  define('MODULE_PAYMENT_PAYPAL_DP_INVALID_RESPONSE', 'Paypal ha devuelto información no válida o incompleta para realizar el pedido. Por favor pruebe de nuevo o seleccione una forma de pago distinta.<br><br>');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_GEN_ERROR', 'Se ha producido un error mientras intentábamos contactar con los servidores de Paypal.<br><br>');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_ERROR', 'Se ha producido un error mientras intentábamos procesar la información de su tarjeta de crédito.<br><br>');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_UNVERIFIED', 'Para mantener un alto nivel de seguridad, los clientes que utilizan Pago exprés deben ser clientes con cuenta en Paypal verificada. Por favor verifique su cuenta en Paypal o elija otra forma de pago.');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_BAD_CARD', 'Acepte nuestras disculpas por el inconveniente, pero Paypal sólo acepta Visa, Master Card, Discover y American Express. Por favor utilice una tarjeta de crédito distinta.');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_BAD_LOGIN', 'Ha habido un problema validando su cuenta. Por favor pruebe de nuevo.');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_JS_CC_OWNER', '* El titular de la tarjeta debe ser de al menos ' . CC_OWNER_MIN_LENGTH . ' caracteres.\n');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_JS_CC_NUMBER', '* El número de tarjeta debe tener al menos ' . CC_NUMBER_MIN_LENGTH . ' caracteres.\n');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_JS_CC_CVV2', '* Debe introducir el código CVV2 de su tarjeta.\n');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_EC_HEADER', 'Pago rápido y seguro con PayPal:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_BUTTON_TEXT', 'Ahorre tiempo. Pague con seguridad.<br>Pague sin compartir sus datos financieros.');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_STATE_ERROR', 'La provincia asignada a su cuenta no es válida. Por favor vaya a la configuración de su cuenta y cámbiela.');
  define('MODULE_PAYMENT_PAYPAL_DP_MISSING_XML', '¡Instalación de PayPal WPP incompleta! ¡Debería haber un fichero XML en ' . DIR_FS_CATALOG . DIR_WS_INCLUDES . 'paypal_wpp/xml/ !');
  define('MODULE_PAYMENT_PAYPAL_DP_CURL_NOT_INSTALLED', 'cURL, que es requerido por el módulo PayPal Website Payments Pro, no está presente. Por favor póngase en contacto con el administrador del alojamiento de su web y pídale que esté instalado.');
  define('MODULE_PAYMENT_PAYPAL_DP_CERT_NOT_INSTALLED', 'No se ha podido encontrar su certificado de API de Website Payments Pro. Por favor compruebe su localización en la sección de administración.');
  define('MODULE_PAYMENT_PAYPAL_DP_GEN_ERROR', '¡Pago no procesado!');
  define('MODULE_PAYMENT_PAYPAL_EC_ALTERNATIVE', '<hr /><p align="center">o puede utilizar</p><hr />');
  define('MODULE_PAYMENT_PAYPAL_DP_BUG_1629', 'La tienda tiene un error en checkout_process.php que impide funcionar a este módulo. Por favor consulte la sección Troubleshooting en READ_ME.htm que venía con el módulo para más información.');
  define('MODULE_PAYMENT_PAYPAL_EC_TEXT_DECLINED', 'Se ha rechazado su transacción PayPal. Por favor selecciona otra forma de pago.<br><br>');
?>