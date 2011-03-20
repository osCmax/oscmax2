<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Pagos de afiliados');
define('HEADING_TITLE_SEARCH', 'Buscar:');
define('HEADING_TITLE_STATUS','Estado:');

define('TEXT_ALL_PAYMENTS','Todos los pagos');
define('TEXT_NO_PAYMENT_HISTORY', 'No hay diponible un historial de pagos');

define('TABLE_HEADING_ACTION', 'Acción');
define('TABLE_HEADING_STATUS', 'Estado');
define('TABLE_HEADING_AFILIATE_NAME', 'Afiliado');
define('TABLE_HEADING_PAYMENT','Pago (imp. incl.)');
define('TABLE_HEADING_NET_PAYMENT','Pago (sin imp.)');
define('TABLE_HEADING_DATE_BILLED','Fecha de facturación');
define('TABLE_HEADING_NEW_VALUE', 'Nuevo importe');
define('TABLE_HEADING_OLD_VALUE', 'Importe anterior');
define('TABLE_HEADING_AFFILIATE_NOTIFIED', 'Afiliado notificado');
define('TABLE_HEADING_DATE_ADDED', 'Fecha realizado');

define('TEXT_DATE_PAYMENT_BILLED','Facturado:');
define('TEXT_DATE_ORDER_LAST_MODIFIED','Útlima modificación:');
define('TEXT_AFFILIATE_PAYMENT','Affiliate earned payment');
define('TEXT_AFFILIATE_BILLED','Liquidación');
define('TEXT_AFFILIATE','Afiliado');
define('TEXT_INFO_DELETE_INTRO','¿Seguro que quieres eliminar este pago?');
define('TEXT_DISPLAY_NUMBER_OF_PAYMENTS', 'Mostrando del <b>%d</b> al <b>%d</b> (de <b>%d</b> pagos)');

define('TEXT_AFFILIATE_PAYING_POSSIBILITIES','Puedes pagar a tu afiliado mediante:');
define('TEXT_AFFILIATE_PAYMENT_CHECK','Cheque:');
define('TEXT_AFFILIATE_PAYMENT_CHECK_PAYEE','Beneficiario:');
define('TEXT_AFFILIATE_PAYMENT_PAYPAL','PayPal:');
define('TEXT_AFFILIATE_PAYMENT_PAYPAL_EMAIL','E-mail de cuenta PayPal:');
define('TEXT_AFFILIATE_PAYMENT_BANK_TRANSFER','Transferencia bancaria:');
define('TEXT_AFFILIATE_PAYMENT_BANK_NAME','Nombre del banco:');
define('TEXT_AFFILIATE_PAYMENT_BANK_ACCOUNT_NAME','Titular de la cuenta:');
define('TEXT_AFFILIATE_PAYMENT_BANK_ACCOUNT_NUMBER','Número de cuenta:');
define('TEXT_AFFILIATE_PAYMENT_BANK_BRANCH_NUMBER','Número de sucursal:');
define('TEXT_AFFILIATE_PAYMENT_BANK_SWIFT_CODE','Código SWIFT:');

define('TEXT_INFO_HEADING_DELETE_PAYMENT','Eliminar pago');

define('IMAGE_AFFILIATE_BILLING','Comenzar facturación');

define('ERROR_PAYMENT_DOES_NOT_EXIST','No existe el pago');

define('SUCCESS_BILLING','Se ha facturado correctamente a tus afiliados');
define('SUCCESS_PAYMENT_UPDATED','Se ha actualizado correctamente el estado del pago');

define('PAYMENT_STATUS','Estado del pago');
define('PAYMENT_NOTIFY_AFFILIATE', 'Notificar al afiliado');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Actualización de pago');
define('EMAIL_TEXT_AFFILIATE_PAYMENT_NUMBER', 'Pago número:');
define('EMAIL_TEXT_INVOICE_URL', 'Factura detallada:');
define('EMAIL_TEXT_PAYMENT_BILLED', 'Fecha de facturación');
define('EMAIL_TEXT_STATUS_UPDATE', 'se ha actualizado tu pago al siguiente estado.' . "\n\n" . 'Nuevo estado: %s' . "\n\n" . 'Por favor conteste a este e-mail si tiene cualquier duda.' . "\n");
define('EMAIL_TEXT_NEW_PAYMENT', 'Ha llegado una nueva factura a tus pagos' . "\n");
?>
