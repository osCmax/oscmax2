<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License

  eProcessingNetwork.php was developed for eProcessingNetwork

  http://www.quantumgateway.com

  by

  Andres Roca - CDG Commerce
  andresr@cdgcommerce.com
*/

  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_TITLE', 'QuantumGateway');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_PUBLIC_TITLE', 'Tarjeta de cr&eacute;dito');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_DESCRIPTION', 'Tarjeta de crédito para pruebas:<br><br>Número: 4111111111111111<br>Caducidad: Cualquiera');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_TYPE', 'Tipo de tarjeta:');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_CREDIT_CARD_OWNER', 'Titular de la tarjeta:');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_CREDIT_CARD_NUMBER', 'Número de la tarjeta:');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_CREDIT_CARD_EXPIRES', 'Fecha de caducidad:');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_CREDIT_CARD_CVV', 'Tarjeta de cr&eacute;dito CVV:');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_NOT_CVV', 'Active si no puede ecribir el c&oacute;digo CVV:');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_REASON_NOT_CVV', '&iquest;Por qu&eacute; no puede escribir el c&oacute;digo CVV?:');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_JS_CC_OWNER', '* El campo titular de la tarjeta debe contener al menos ' . CC_OWNER_MIN_LENGTH . ' caracteres.\n');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_JS_CC_NUMBER', '* El número de la tarjeta debe ser de al menos ' . CC_NUMBER_MIN_LENGTH . ' caracteres.\n');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_MISSING_CC_NUMBER', 'Debe introducir un n&uacute;mero de tarjeta de cr&uacute;dito.\n');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_ERROR_MESSAGE', 'Ha ocurrido un error procesando su tarjeta. Por favor inténtelo de nuevo.');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_ERROR', '¡Error en tarjeta de crédito!');
?>