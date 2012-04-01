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
define('GOOGLECHECKOUT_STRING_WARN_USING_SANDBOX','GC está configurado para utilizar SandBox. El pedido será procesado, pero no cobrado.');
define('GOOGLECHECKOUT_STRING_WARN_NO_MERCHANT_ID_KEY','No se ha configurado la ID o Key de Google Checkout Merchant');
define('GOOGLECHECKOUT_STRING_WARN_VIRTUAL','Algunos productos descargables en su carrito no están disponibles actualmente a través de Google Checkout.');
define('GOOGLECHECKOUT_STRING_WARN_EMPTY_CART','El carrito está vacío');
define('GOOGLECHECKOUT_STRING_WARN_OUT_OF_STOCK','Algunos productos están agotados');
define('GOOGLECHECKOUT_STRING_WARN_MULTIPLE_SHIP_TAX','Hay varias opciones de envío seleccionado y utilizan diferentes tablas de impuestos de envío o algunas no utilizan tablas de impuestos');
define('GOOGLECHECKOUT_STRING_WARN_MIX_VERSIONS','La versión del módulo instalado en la interfaz del administrador es %s, y la del paquete es de %s, quitar/reinstalar el módulo');
define('GOOGLECHECKOUT_STRING_WARN_WRONG_SHIPPING_CONFIG','DIR_FS_CATALOG y DIR_WS_MODULES puede estar mal configurado en el archivo includes/configure.php. Este directorio no existe: %s');
define('GOOGLECHECKOUT_STRING_WARN_RESTRICTED_CATEGORY','Algunos productos están en la categoría restringida de GC.');

// This string will be added after the product name and description in the yellow box in the GC confirmation page for all Digital Goods.
define('GOOGLECHECKOUT_STRING_EXTRA_DIGITAL_CONTENT','Espere 2-5 minutos para permitir que se procese toda la transacción.');
  
define('GOOGLECHECKOUT_STRING_ERR_SHIPPING_CONFIG','Error: Formas de envío no configurados');
    
define ('GOOGLECHECKOUT_FLAT_RATE_SHIPPING', 'Tarifa plana por pedido');
define ('GOOGLECHECKOUT_ITEM_RATE_SHIPPING', 'Tarifa plana por producto');
define ('GOOGLECHECKOUT_TABLE_RATE_SHIPPING', 'Variar por peso/precio');

define ('GOOGLECHECKOUT_TABLE_NO_MERCHANT_CALCULATION', 'No se ha seleccionado ningún cálculo de envío merchant');
define ('GOOGLECHECKOUT_MERCHANT_CALCULATION_NOT_CONFIGURED', ' no configurado!<br />');

define ('GOOGLECHECKOUT_ERR_REGULAR_CHECKOUT', 'Google Checkout no se puede utilizar para la realización nomal del pedido, pulsa el botón de Google Checkout situado debajo');

define ('GOOGLECHECKOUT_ERR_DUPLICATED_ORDER', 'Duplicada NewOrderNotification #%s Pedido #%s');
  
// Google Request Success messages
define('GOOGLECHECKOUT_SUCCESS_SEND_CHARGE_ORDER', 'Enviado comando Google Charge Order');
define('GOOGLECHECKOUT_SUCCESS_SEND_PROCESS_ORDER', 'Enviado comando Google Process Order');
define('GOOGLECHECKOUT_SUCCESS_SEND_DELIVER_ORDER', 'Enviado comando Google Deliver Order');
define('GOOGLECHECKOUT_SUCCESS_SEND_ARCHIVE_ORDER', 'Enviado comando Google Archive Order');
define('GOOGLECHECKOUT_SUCCESS_SEND_REFUND_ORDER', 'Enviado comando Google Full Refund Order');
define('GOOGLECHECKOUT_SUCCESS_SEND_CANCEL_ORDER', 'Enviado comando Google Cancel Order ');
define('GOOGLECHECKOUT_SUCCESS_SEND_MESSAGE_ORDER', 'Enviado Google Message al comprador');
define('GOOGLECHECKOUT_SUCCESS_SEND_NEW_USER_CREDENTIALS', 'Enviado New Buyer Credentials al comprador');
  
define('GOOGLECHECKOUT_SUCCESS_SEND_MERCHANT_ORDER_NUMBER', 'Enviado Merchant Order Number');
define('GOOGLECHECKOUT_SUCCESS_SEND_ADMIN_COPY_EMAIL', 'Enviado Status Change Message al e-mail del administrador');

// Google Request warning Messages
define('GOOGLECHECKOUT_WARNING_CHUNK_MESSAGE','El mensaje de Google era más largo que %s, se fragmentó al enviárselo al comprador.');
define('GOOGLECHECKOUT_WARNING_SYSTEM_EMAIL_SENT','Se envió un e-mail normal al comprador con el mensaje completo');

// Google Request Error Messages
define('GOOGLECHECKOUT_ERR_SEND_CHARGE_ORDER', 'Error al enviar Google Charge Order, mirar en los logs de error');
define('GOOGLECHECKOUT_ERR_SEND_PROCESS_ORDER', 'Error al enviar Google Process Order, mirar en los logs de error');
define('GOOGLECHECKOUT_ERR_SEND_DELIVER_ORDER', 'Error al enviar Google Deliver Order, mirar en los logs de error');
define('GOOGLECHECKOUT_ERR_SEND_ARCHIVE_ORDER', 'Error al enviar Google Archive Order, mirar en los logs de error');
define('GOOGLECHECKOUT_ERR_SEND_REFUND_ORDER', 'Error al enviar Google Refund Order, mirar en los logs de error');
define('GOOGLECHECKOUT_ERR_SEND_CANCEL_ORDER', 'Error al enviar Google Cancel Order, mirar en los logs de error');
define('GOOGLECHECKOUT_ERR_SEND_MESSAGE_ORDER', 'Error al enviar Google Message, mirar en los logs de error');
define('GOOGLECHECKOUT_ERR_SEND_NEW_USER_CREDENTIALS', 'Error al enviar New Buyer Credentials, mirar en los logs de error');
define('GOOGLECHECKOUT_ERR_SEND_MERCHANT_ORDER_NUMBER', 'Error al enviar Merchant Order Number, mirar en los logs de error');
define('GOOGLECHECKOUT_ERR_INVALID_STATE_TRANSITION', 'Transición Google Checkout State no válida: %s => %s, vuelva a %s e inténtelo de nuevo. Lea README');
  
// Remember max chars in 255, included that store name, email and pass that will replace the %s
define('GOOGLECHECKOUT_NEW_CREDENTIALS_MESSAGE', 'Estas son sus credenciales para iniciar sesión en el sitio %s. Usuario: %s Contraseña: %s Por favor cambie su contraseña despúes de iniciar la sesión - Cámbiela en el área de "Mi cuenta".');

// Coupons
define('GOOGLECHECKOUT_COUPON_ERR_ONE_COUPON', 'Lo sentimos, sólo se permite un vale por pedido');
define('GOOGLECHECKOUT_COUPON_ERR_MIN_PURCHASE', 'Lo sentimos, no se ha alcanzado la compra mínima para poder usar este vale');

define('GOOGLECHECKOUT_COUPON_DISCOUNT', 'Vale descuento: ');
define('GOOGLECHECKOUT_COUPON_FREESHIP', 'Vale de gastos de envío gratis: ');

// New Orders
define('GOOGLECHECKOUT_STATE_NEW_ORDER_NUM', 'Nº de pedido Google Checkout: ');
define('GOOGLECHECKOUT_STATE_NEW_ORDER_MC_USED', 'Cálculos Merchant utilizados: ');
define('GOOGLECHECKOUT_STATE_NEW_ORDER_BUYER_USER', 'Usuario del comprador: ');
define('GOOGLECHECKOUT_STATE_NEW_ORDER_BUYER_PASS', 'Contraseña del usuario: ');

// States
define('GOOGLECHECKOUT_STATE_STRING_TIME','Fecha y hora:');
define('GOOGLECHECKOUT_STATE_STRING_NEW_STATE','Nuevo estado:');

define('GOOGLECHECKOUT_STATE_STRING_ORDER_READY_CHARGE','¡Pedido listo para ser cobrado!');
define('GOOGLECHECKOUT_STATE_STRING_PAYMENT_DECLINED','¡El pago se ha rechazado!');
define('GOOGLECHECKOUT_STATE_STRING_ORDER_CANCELED','El pedido ha sido cancelado.');
define('GOOGLECHECKOUT_STATE_STRING_ORDER_CANCELED_REASON','Motivo:');
define('GOOGLECHECKOUT_STATE_STRING_ORDER_CANCELED_BY_GOOG','El pedido ha sido cancelado por Google.');
define('GOOGLECHECKOUT_STATE_STRING_ORDER_DELIVERED','El pedido ha sido enviado.');

define('GOOGLECHECKOUT_STATE_STRING_TRACKING','Datos de seguimiento del envío:');
define('GOOGLECHECKOUT_STATE_STRING_TRACKING_CARRIER','Transportista:');
define('GOOGLECHECKOUT_STATE_STRING_TRACKING_NUMBER', 'Número de seguimiento: ');

define('GOOGLECHECKOUT_STATE_STRING_LATEST_CHARGE', 'Latest charge amount: ');
define('GOOGLECHECKOUT_STATE_STRING_TOTAL_CHARGE', 'Total charge amount: ');

define('GOOGLECHECKOUT_STATE_STRING_LATEST_REFUND', 'Último reembolso: ');
define('GOOGLECHECKOUT_STATE_STRING_TOTAL_REFUND', 'Total de reembolso: ');
define('GOOGLECHECKOUT_STATE_STRING_GOOGLE_REFUND', 'Reembolso Google: ');
define('GOOGLECHECKOUT_STATE_STRING_NET_REVENUE', 'Ingresos netos: ');

define('GOOGLECHECKOUT_STATE_STRING_RISK_INFO', 'Información del riesgo: ');
define('GOOGLECHECKOUT_STATE_STRING_RISK_ELEGIBLE', ' Elegible para protección: ');
define('GOOGLECHECKOUT_STATE_STRING_RISK_AVS', ' Respuesta Avs: ');
define('GOOGLECHECKOUT_STATE_STRING_RISK_CVN', ' Respuesta Cvn: ');
define('GOOGLECHECKOUT_STATE_STRING_RISK_CC_NUM', ' Número parcial TC: ');
define('GOOGLECHECKOUT_STATE_STRING_RISK_ACC_AGE', ' Antiguedad de la cuenta del comprador: ');

// Custom GC order states names  
define('GOOGLECHECKOUT_CUSTOM_ORDER_STATE_NEW', 'Google Nuevo');
define('GOOGLECHECKOUT_CUSTOM_ORDER_STATE_PROCESSING', 'Google Procesando');
define('GOOGLECHECKOUT_CUSTOM_ORDER_STATE_SHIPPED', 'Google Enviado');
define('GOOGLECHECKOUT_CUSTOM_ORDER_STATE_REFUNDED', 'Google Reembolsado');
define('GOOGLECHECKOUT_CUSTOM_ORDER_STATE_SHIPPED_REFUNDED', 'Google Enviado y reembolsado');
define('GOOGLECHECKOUT_CUSTOM_ORDER_STATE_CANCELED', 'Google Cancelado');

?>