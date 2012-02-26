<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

	define('HEADING_TITLE','Opciones para envío por FedEx');
	define('IMAGE_SUBMIT','Enviar');
	define('ORDER_HISTORY_DELIVERED','Envío programado, número de seguimiento ');
	define('ORDER_HISTORY_CANCELLED','Envío cancelado');
	define('NO_ORDER_NUMBER_ERROR','¡No se ha especificado un número de pedido!');
	define('ERROR_FEDEX_QUOTES_NOT_INSTALLED','No se ha podido encontrar un número de cuenta FedEx. ¿Está instalado y configurado FedEx RealTime Quotes?');
	define('SHIPMENT_REQUEST_DATA','Información solicitud envío, número de paquete ');
	define('MANIFEST_DATA','Información lista de carga, número de paquete ');
	define('RUNNING_IN_DEBUG','Ejecutándose en modo depuración de errores, no se ha hecho solicitud de envío');
	define('ERROR_NO_ORDER_SPECIFIED','ERROR: ¡No se ha especificado un pedido!');
	define('ORDER_NUMBER','Número de pedido ');
	define('COULD_NOT_DELETE_ENTRIES','No se ha podido eliminar entradas de la lista de carga.');
	define('ERROR','ERROR: ');
	define('ENTER_PACKAGE_WEIGHT','Se debe especificar el peso del paquete.');
	define('ENTER_NUMBER_PACKAGES','Se debe especificar el número de paquetes.');

	define('EMAIL_SEPARATOR', '------------------------------------------------------');
    define('EMAIL_TEXT_SUBJECT', 'Actualización del pedido');
    define('EMAIL_TEXT_ORDER_NUMBER', 'Número de pedido:');
    define('EMAIL_TEXT_INVOICE_URL', 'Detalles del pedido:');
    define('EMAIL_TEXT_DATE_ORDERED', 'Fecha del pedido:');
    define('EMAIL_TEXT_STATUS_UPDATE', 'El estado de su pedido es ' . '%s' . "\n\n" . 'Por favor conteste a este e-mail si tiene alguna pregunta.' . "\n");
    define('EMAIL_TEXT_COMMENTS_UPDATE', 'Comentarios: ' . "%s\n");
    define('EMAIL_TEXT_TRACKING_NUMBER', 'Puede hacer un seguimiento de su paquete pulsando el enlace a continuación.');
    define('URL_TO_TRACK1', 'http://www.fedex.com/cgi-bin/tracking?action=track&tracknumbers=');
		
// form field titles
	define('NUMBER_OF_PACKAGES','Número de paquetes:');
	define('OVERSIZED','¿Se ha pasado de tamaño?');
	define('PACKAGING_TYPE','Tipo de paquete ("other" para envíos por tierra):');
	define('TYPE_OF_SERVICE','Tipo de servicio:');
	define('PAYMENT_TYPE','Tipo de pago:');
	define('DROPOFF_TYPE','Tipo de entrega:');
	define('PICKUP_DATE','Fecha de recogida (yyyymmdd):');

	define('TOTAL_WEIGHT','Peso total de todos los paquetes:');
	define('PACKAGE_WEIGHT','Peso del paquete:');
	
?>