<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
/*
  Copyright (C) 2007 Google Inc.
*/

/**
 * Google Checkout v1.5.0
 * 
 * Currently just a copy of the English messages.
 */

define('MODULE_PAYMENT_GOOGLECHECKOUT_TEXT_TITLE', 'GoogleCheckout');
define('MODULE_PAYMENT_GOOGLECHECKOUT_TEXT_DESCRIPTION', 'GoogleCheckout');
define('MODULE_PAYMENT_GOOGLECHECKOUT_TEXT_OPTION','- O bien, utilice -');
define('GOOGLECHECKOUT_STRING_WARN_USING_SANDBOX','GC está configurado para utilizar SandBox. Podrá ser procesada, pero cargada NO.');
define('GOOGLECHECKOUT_STRING_WARN_NO_MERCHANT_ID_KEY','Google Checkout o Id Mercante clave no ha sido setted');
define('GOOGLECHECKOUT_STRING_WARN_VIRTUAL','Algunos productos de descarga en su carrito de la actualidad no están disponibles a través de Google Checkout.');
define('GOOGLECHECKOUT_STRING_WARN_EMPTY_CART','La cesta está vacía');
define('GOOGLECHECKOUT_STRING_WARN_OUT_OF_STOCK','Algunos productos están en stock');
define('GOOGLECHECKOUT_STRING_WARN_MULTIPLE_SHIP_TAX','Hay varias opciones de envío seleccionado y que utilizan diferentes tablas de impuestos de envío o algunas tablas no uso de impuestos');
define('GOOGLECHECKOUT_STRING_WARN_MIX_VERSIONS','La versión del módulo instalado en la interfaz del administrador es %s, y la del paquete es de %s, quitar y reinstalar el módulo');
define('GOOGLECHECKOUT_STRING_WARN_WRONG_SHIPPING_CONFIG','DIR_FS_CATALOG y DIR_WS_MODULES puede estar mal configurado en el archivo includes / configure.php. Este directorio no existe: %s');
define('GOOGLECHECKOUT_STRING_WARN_RESTRICTED_CATEGORY','ALGUNOS artculos estn en la categora GC restringido.');

// This string will be added after the product name and description in the yellow box in the GC confirmation page for all Digital Goods.
define('GOOGLECHECKOUT_STRING_EXTRA_DIGITAL_CONTENT','De 2-5 minutos para obtener toda la transacción procesada.');
  
define('GOOGLECHECKOUT_STRING_ERR_SHIPPING_CONFIG','Error: Métodos de envío no está configurado');
    
define ('GOOGLECHECKOUT_FLAT_RATE_SHIPPING', 'Flat Rate Per Order');
define ('GOOGLECHECKOUT_ITEM_RATE_SHIPPING', 'Flat Rate Per Item');
define ('GOOGLECHECKOUT_TABLE_RATE_SHIPPING', 'Vary by Weight/Price');

define ('GOOGLECHECKOUT_TABLE_NO_MERCHANT_CALCULATION', 'No merchant calculation shipping selected');
define ('GOOGLECHECKOUT_MERCHANT_CALCULATION_NOT_CONFIGURED', ' not configured!<br />');

define ('GOOGLECHECKOUT_ERR_REGULAR_CHECKOUT', 'Google Checkout Can not be used in regular checkout, click in the Google Checkout Button Below');

define ('GOOGLECHECKOUT_ERR_DUPLICATED_ORDER', 'Duplicated NewOrderNotification #%s Cart order #%s');
  
// Google Request Success messages
define('GOOGLECHECKOUT_SUCCESS_SEND_CHARGE_ORDER','Enviado carga Google Comando Orden');
define('GOOGLECHECKOUT_SUCCESS_SEND_PROCESS_ORDER','Enviado el Proceso de Google Comando Orden');
define('GOOGLECHECKOUT_SUCCESS_SEND_DELIVER_ORDER','Enviado Google Entregar Comando Orden');
define('GOOGLECHECKOUT_SUCCESS_SEND_ARCHIVE_ORDER','Enviado el Archivo de Google Comando Orden');
define('GOOGLECHECKOUT_SUCCESS_SEND_REFUND_ORDER','Enviado Google reembolso completo de comandos Orden');
define('GOOGLECHECKOUT_SUCCESS_SEND_CANCEL_ORDER','Enviado Google Cancelar Comando Orden');
define('GOOGLECHECKOUT_SUCCESS_SEND_MESSAGE_ORDER','Envió de mensajes de Google para el Comprador');
define('GOOGLECHECKOUT_SUCCESS_SEND_NEW_USER_CREDENTIALS','Enviado de Verificación de Poderes nuevo comprador para el comprador');
  
define('GOOGLECHECKOUT_SUCCESS_SEND_MERCHANT_ORDER_NUMBER','Mercantes enviados Número de pedido');
define('GOOGLECHECKOUT_SUCCESS_SEND_ADMIN_COPY_EMAIL','Enviado el mensaje de cambio de estado de administración de correo electrónico');

// Google Request warning Messages
define('GOOGLECHECKOUT_WARNING_CHUNK_MESSAGE','Mensajes de Google fue mayor que el %s, fue fragmentada cuando se envía al comprador.');
define('GOOGLECHECKOUT_WARNING_SYSTEM_EMAIL_SENT','Un correo ordinario fue enviado al comprador con el mensaje completo');

// Google Request Error Messages
define('GOOGLECHECKOUT_ERR_SEND_CHARGE_ORDER', 'Error sending Google Charge Order, see error logs');
define('GOOGLECHECKOUT_ERR_SEND_PROCESS_ORDER', 'Error sending Google Process Order, see error logs');
define('GOOGLECHECKOUT_ERR_SEND_DELIVER_ORDER', 'Error sending Google Deliver Order, see error logs');
define('GOOGLECHECKOUT_ERR_SEND_ARCHIVE_ORDER', 'Error sending Google Archive Order, see error logs');
define('GOOGLECHECKOUT_ERR_SEND_REFUND_ORDER','Error sending Google Refund Order, see error logs');
define('GOOGLECHECKOUT_ERR_SEND_CANCEL_ORDER', 'Error sending Google Cancel Order, see error logs');
define('GOOGLECHECKOUT_ERR_SEND_MESSAGE_ORDER', 'Error sending Google Message, see error logs');
define('GOOGLECHECKOUT_ERR_SEND_NEW_USER_CREDENTIALS', 'Error sending New Buyer Credentials, see error logs');
define('GOOGLECHECKOUT_ERR_SEND_MERCHANT_ORDER_NUMBER', 'Error sending Merchant Order Number, see error logs');
define('GOOGLECHECKOUT_ERR_INVALID_STATE_TRANSITION', 'Invalid Google Checkout State transition: %s => %s, revert to %s and try again. See README');
  
// Remember max chars in 255, included that store name, email and pass that will replace the %s
define('GOOGLECHECKOUT_NEW_CREDENTIALS_MESSAGE', 'These are your Credentials to log into %s site. User: %s Pass: %s Please change your password after logging in - Change it in "MyAccount" area.');

// Coupons
define('GOOGLECHECKOUT_COUPON_ERR_ONE_COUPON', 'Sorry, only one coupon per order');
define('GOOGLECHECKOUT_COUPON_ERR_MIN_PURCHASE', 'Sorry, the minimum purchase hasn\'t been reached to use this coupon');

define('GOOGLECHECKOUT_COUPON_DISCOUNT', 'Discount Coupon: ');
define('GOOGLECHECKOUT_COUPON_FREESHIP', 'Free Shipping Coupon: ');

// New Orders
define('GOOGLECHECKOUT_STATE_NEW_ORDER_NUM', 'Google Checkout Order No: ');
define('GOOGLECHECKOUT_STATE_NEW_ORDER_MC_USED', 'Merchant Calculations used: ');
define('GOOGLECHECKOUT_STATE_NEW_ORDER_BUYER_USER', 'NEW Buyer\'s User: ');
define('GOOGLECHECKOUT_STATE_NEW_ORDER_BUYER_PASS', 'Buyer\'s Password: ');

// States
define('GOOGLECHECKOUT_STATE_STRING_TIME','Fecha y hora:');
define('GOOGLECHECKOUT_STATE_STRING_NEW_STATE','Nuevo Estado:');

define('GOOGLECHECKOUT_STATE_STRING_ORDER_READY_CHARGE','listos para ser asignados!');
define('GOOGLECHECKOUT_STATE_STRING_PAYMENT_DECLINED','El pago se ha rechazado!');
define('GOOGLECHECKOUT_STATE_STRING_ORDER_CANCELED','Orden fue cancelada.');
define('GOOGLECHECKOUT_STATE_STRING_ORDER_CANCELED_REASON','Razón:');
define('GOOGLECHECKOUT_STATE_STRING_ORDER_CANCELED_BY_GOOG','Orden fue cancelado por Google.');
define('GOOGLECHECKOUT_STATE_STRING_ORDER_DELIVERED','Pedido fue enviado.');

define('GOOGLECHECKOUT_STATE_STRING_TRACKING','Envío de datos de seguimiento:');
define('GOOGLECHECKOUT_STATE_STRING_TRACKING_CARRIER','Transportista:');
define('GOOGLECHECKOUT_STATE_STRING_TRACKING_NUMBER', 'Tracking Number: ');

define('GOOGLECHECKOUT_STATE_STRING_LATEST_CHARGE', 'Latest charge amount: ');
define('GOOGLECHECKOUT_STATE_STRING_TOTAL_CHARGE', 'Total charge amount: ');

define('GOOGLECHECKOUT_STATE_STRING_LATEST_REFUND', 'Latest refund amount: ');
define('GOOGLECHECKOUT_STATE_STRING_TOTAL_REFUND', 'Total Order refund amount: ');
define('GOOGLECHECKOUT_STATE_STRING_GOOGLE_REFUND', 'Google Refund: ');
define('GOOGLECHECKOUT_STATE_STRING_NET_REVENUE', 'Net revenue: ');

define('GOOGLECHECKOUT_STATE_STRING_RISK_INFO', 'Risk Information: ');
define('GOOGLECHECKOUT_STATE_STRING_RISK_ELEGIBLE', ' Elegible for Protection: ');
define('GOOGLECHECKOUT_STATE_STRING_RISK_AVS', ' Avs Response: ');
define('GOOGLECHECKOUT_STATE_STRING_RISK_CVN', ' Cvn Response: ');
define('GOOGLECHECKOUT_STATE_STRING_RISK_CC_NUM', ' Partial CC number: ');
define('GOOGLECHECKOUT_STATE_STRING_RISK_ACC_AGE', ' Buyer account age: ');

// Custom GC order states names  
define('GOOGLECHECKOUT_CUSTOM_ORDER_STATE_NEW', 'Google New');
define('GOOGLECHECKOUT_CUSTOM_ORDER_STATE_PROCESSING', 'Google Processing');
define('GOOGLECHECKOUT_CUSTOM_ORDER_STATE_SHIPPED', 'Google Shipped');
define('GOOGLECHECKOUT_CUSTOM_ORDER_STATE_REFUNDED', 'Google Refunded');
define('GOOGLECHECKOUT_CUSTOM_ORDER_STATE_SHIPPED_REFUNDED', 'Google Shipped and Refunded');
define('GOOGLECHECKOUT_CUSTOM_ORDER_STATE_CANCELED', 'Google Canceled');

?>