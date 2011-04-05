<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Cola de emisión de cheques regalo comprados');

define('TABLE_HEADING_CUSTOMERS', 'Cliente');
define('TABLE_HEADING_ORDERS_ID', 'Nº pedido');
define('TABLE_HEADING_VOUCHER_VALUE', 'Valor cheque');
define('TABLE_HEADING_DATE_PURCHASED', 'Fecha compra');
define('TABLE_HEADING_RELEASED', 'Estado');
define('TABLE_HEADING_ACTION', 'Acción');

define('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Recientemente adquirió un cheque regalos de nuestra tienda online.' . "\n"
                                          . 'Por motivos de seguridad el importe del cheque regalo no le fue abonado inmediatamente.' . "\n"
                                          . 'Sin embargo ya se ha puesto ese importe a su disposición. Ahora puede visitar nuestra tienda' . "\n"
                                          . 'y enviar esa cantidad de dinero por e-mail a cualquier persona' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', 'El(los) cheque(s) regalo(s) que adquirió tiene un valor de %s' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_BODY', '');
define('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', '');
define('TEXT_REDEEM_COUPON_SUBJECT', 'Compra de cheque regalo');
define('TEXT_PAYMENT_CHECK', 'Si estás seguro que has recibido fondos por este cheque regalo entonces pulsa Canjear para emitir el cheque y permitir al cliente utilizarlo.');
define('TEXT_PAYMENT_CHECK_CONFIRM', '¿Estás seguro que quiere emitir este cheque regalo?');
define('TEXT_RELEASED_ALREADY', 'Este cheque regalo ya se ha emitido.  <br><br><b>Emitido: </b>');
define('TEXT_GV_STATUS', 'Pendiente');

define('HEADING_TITLE_STATUS', 'Estado:');
define('TEXT_GV_REDEEMED', 'Canjeado');
define('TEXT_GV_PENDING', 'Pendiente');
define('TEXT_GV_ALL', 'Mostrar cheques regalo');
?>