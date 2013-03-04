<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Estados de pedidos');

define('TABLE_HEADING_ORDERS_STATUS', 'Estado de pedidos');
define('TABLE_HEADING_PUBLIC_STATUS', 'Estado público');
define('TABLE_HEADING_DOWNLOADS_STATUS', 'Estado de descargas');
define('TABLE_HEADING_ACTION', 'Acción');

define('TEXT_INFO_EDIT_INTRO', 'Realiza los cambios necesarios');
define('TEXT_INFO_ORDERS_STATUS_NAME', 'Estado pedidos:');
define('TEXT_INFO_INSERT_INTRO', 'Introduce los datos del nuevo estado de pedidos');
define('TEXT_INFO_DELETE_INTRO', '¿Seguro que quieres eliminar este estado de pedidos?');
define('TEXT_INFO_HEADING_NEW_ORDERS_STATUS', 'Nuevo estado pedidos');
define('TEXT_INFO_HEADING_EDIT_ORDERS_STATUS', 'Editar estado pedidos');
define('TEXT_INFO_HEADING_DELETE_ORDERS_STATUS', 'Eliminar estado pedidos');

define('TEXT_SET_PUBLIC_STATUS', 'Mostrar al cliente el pedido con este estado');
define('TEXT_SET_DOWNLOADS_STATUS', 'Permitir descargas de productos virtuales con este estado');
define('ERROR_REMOVE_DEFAULT_ORDER_STATUS', 'Error: El estado de pedido predeterminado no se puede eliminar. Establece otro estado de pedido como predeterminado y prueba de nuevo.');
define('ERROR_STATUS_USED_IN_ORDERS', 'Error: Este estado de pedido está siendo usado actualmente en algún pedido.');
define('ERROR_STATUS_USED_IN_HISTORY', 'Error: Este estado de pedido está siendo usado actualmente en algún historial de pedido.');
?>