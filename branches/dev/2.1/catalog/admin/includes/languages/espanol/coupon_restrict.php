<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('TOP_BAR_TITLE', 'Estadísticas');
define('HEADING_TITLE', 'Vales descuento');
define('HEADING_TITLE_STATUS', 'Estado : ');
define('TEXT_CUSTOMER', 'Cliente:');
define('TEXT_COUPON', 'Nombre del vale');
define('TEXT_COUPON_ALL', 'Todos los vales');
define('TEXT_COUPON_ACTIVE', 'Vales activos');
define('TEXT_COUPON_INACTIVE', 'Vales inactivos');
define('TEXT_SUBJECT', 'Asunto:');
define('TEXT_FROM', 'De:');
define('TEXT_FREE_SHIPPING', 'Gastos de envío gratuitos');
define('TEXT_MESSAGE', 'Mensaje:');
define('TEXT_SELECT_CUSTOMER', 'Seleecciona cliente');
define('TEXT_ALL_CUSTOMERS', 'Todos los clientes');
define('TEXT_NEWSLETTER_CUSTOMERS', 'Para todos los suscritos al boletín');
define('TEXT_CONFIRM_DELETE', '¿Estás seguro que quieres eliminar este vale?');

define('TEXT_TO_REDEEM', 'Puede canjar este vale durante la realización del pedido. Simplemente introduzca el código en el campo que se mostrará, y pulse el botón canjear.');
define('TEXT_IN_CASE', ' en el caso que tenga algún problema. ');
define('TEXT_VOUCHER_IS', 'El código del vale es ');
define('TEXT_REMEMBER', 'No pierda el código del vale, asegúrese de mantenerlo seguro para que pueda beneficiarse de esta promoción especial.');
define('TEXT_VISIT', 'cuando visite ' . HTTP_SERVER . DIR_WS_CATALOG);
define('TEXT_ENTER_CODE', ' e introduzca el código ');

define('TABLE_HEADING_ACTION', 'Acción');



define('NOTICE_EMAIL_SENT_TO', 'Nota: E-mail enviado a: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Error: No se ha seleccionado ningún cliente.');
define('COUPON_NAME', 'Nombre del vale');
//define('COUPON_VALUE', 'Coupon Value');
define('COUPON_AMOUNT', 'Importe del vale');
define('COUPON_CODE', 'Código del vale');
define('COUPON_STARTDATE', 'Fecha de inicio');
define('COUPON_FINISHDATE', 'Fecha de final');
define('COUPON_FREE_SHIP', 'Gastos de envío gratuitos');
define('COUPON_DESC', 'Descripción del vale');
define('COUPON_MIN_ORDER', 'Pedido mínimo');
define('COUPON_USES_COUPON', 'Usos por vale');
define('COUPON_USES_USER', 'Usos por cliente');
define('COUPON_PRODUCTS', 'Productos válidos');
define('COUPON_CATEGORIES', 'Categorías válidas');
define('VOUCHER_NUMBER_USED', 'Número veces usado');
define('DATE_CREATED', 'Fecha creación');
define('DATE_MODIFIED', 'Fecha modificación');
define('TEXT_HEADING_NEW_COUPON', 'Crear nuevo vale');
define('TEXT_NEW_INTRO', 'Por favor rellena la siguiente información para el nuevo vale.<br>');


define('COUPON_NAME_HELP', 'Un nombre corto para el vale');
define('COUPON_AMOUNT_HELP', 'El importe de descuento del vale, ya sea un valor fijo o añadiendo % al final para representar un porcentaje de descuento.');
define('COUPON_CODE_HELP', 'Puedes introducir aquí tu propio código, o dejarlo en blanco para asignarle uno generado automáticamente.');
define('COUPON_STARTDATE_HELP', 'La fecha a partir de la cual el vale será válido');
define('COUPON_FINISHDATE_HELP', 'La fecha en la que caduca el vale');
define('COUPON_FREE_SHIP_HELP', 'El vale otorga gastos de envío gratuitos en un pedido. Nota: esto anula el valor \'Importe del vale\' pero respeta el valor de pedido mínimo');
define('COUPON_DESC_HELP', 'Una descripción del vale para el cliente');
define('COUPON_MIN_ORDER_HELP', 'El importe mínimo de un pedido para que se pueda usar el vale');
define('COUPON_USES_COUPON_HELP', 'El máximo número de veces que un vale puede ser usado, déjalo en blanco si quieres que no haya límite.');
define('COUPON_USES_USER_HELP', 'Número de veces que un usuario puede utilizar el vlae, déjalo en blanco si quieres que no haya límite.');
define('COUPON_PRODUCTS_HELP', 'Una lista separada por comas de ids de producto(product_ids) con los que se puede usar este vale. Déjalo en blanco si quieres que se pueda utilizar para todos los productos.');
define('COUPON_CATEGORIES_HELP', 'Una lista separada por comas de las categorías(cpaths) en las que se puede usar este vale, Déjalo en blanco si quieres que se pueda utilizar en todas las categorías.');
?>