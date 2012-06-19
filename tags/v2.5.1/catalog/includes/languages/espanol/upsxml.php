<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

	define('MODULE_SHIPPING_UPSXML_RATES_TEXT_TITLE', 'United Parcel Service');
	define('MODULE_SHIPPING_UPSXML_RATES_TEXT_DESCRIPTION', 'United Parcel Service (XML)');
	define('MODULE_SHIPPING_UPSXML_RATES_TEXT_UNKNOWN_ERROR', 'Se ha producido un error desconocido al calcular los gastos de envío de UPS.');
	define('MODULE_SHIPPING_UPSXML_RATES_TEXT_IF_YOU_PREFER', 'Si prefiere utilizar UPS para su envío, por favor póngase en contacto con nosotros');
	define('MODULE_SHIPPING_UPSXML_RATES_TEXT_COMM_ERROR', 'Se ha producido un error de comunicación al intentar contactar con la pasarela de UPS');
	define('MODULE_SHIPPING_UPSXML_RATES_TEXT_COMM_UNKNOWN_ERROR', 'Se ha producido un error desconocido al intentar contactar con la pasarela de UPS');
	define('MODULE_SHIPPING_UPSXML_RATES_TEXT_COMM_VERSION_ERROR', 'Este módulo sólo soporta xpci versión 1.0001 de UPS Rates Interface. Por favor póngase en contacto con el webmaster para obtener asistencia adicional.');
	define('MODULE_SHIPPING_UPSXML_TIME_IN_TRANSIT_TEXT_NO_RATES','UPS responde que ha sido correcto, pero no se han encontrado EDDs');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_US_ORIGIN_01', 'UPS Next Day Air');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_US_ORIGIN_02', 'UPS 2nd Day Air');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_US_ORIGIN_03', 'UPS Ground');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_US_ORIGIN_07', 'UPS Worldwide Express');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_US_ORIGIN_08', 'UPS Worldwide Expedited');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_US_ORIGIN_11', 'UPS Standard');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_US_ORIGIN_12', 'UPS 3 Day Select');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_US_ORIGIN_13', 'UPS Next Day Air Saver');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_US_ORIGIN_14', 'UPS Next Day Air Early A.M.');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_US_ORIGIN_54', 'UPS Worldwide Express Plus');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_US_ORIGIN_59', 'UPS 2nd Day Air A.M.');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_US_ORIGIN_65', 'UPS Saver');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_CANADA_ORIGIN_01', 'UPS Express');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_CANADA_ORIGIN_02', 'UPS Expedited');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_CANADA_ORIGIN_07', 'UPS Worldwide Express');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_CANADA_ORIGIN_08', 'UPS Worldwide Expedited');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_CANADA_ORIGIN_11', 'UPS Standard');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_CANADA_ORIGIN_12', 'UPS 3 Day Select');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_CANADA_ORIGIN_13', 'UPS Saver');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_CANADA_ORIGIN_14', 'UPS Express Early A.M.');
	// CANADA origin 54 will not be offered after Jan 2, 2007
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_CANADA_ORIGIN_54', 'UPS Worldwide Express Plus');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_CANADA_ORIGIN_65', 'UPS Saver');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_EU_ORIGIN_07', 'UPS Express');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_EU_ORIGIN_11', 'UPS Standard');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_EU_ORIGIN_54', 'UPS Worldwide Express Plus');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_EU_ORIGIN_65', 'UPS Saver');
	// next three services Poland domestic only (Stolica) 
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_EU_ORIGIN_82', 'UPS Today Standard');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_EU_ORIGIN_83', 'UPS Today Dedicated Courier');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_EU_ORIGIN_84', 'UPS Today Intercity');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_PR_ORIGIN_01', 'UPS Next Day Air');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_PR_ORIGIN_02', 'UPS 2nd Day Air');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_PR_ORIGIN_03', 'UPS Ground');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_PR_ORIGIN_07', 'UPS Worldwide Express');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_PR_ORIGIN_08', 'UPS Worldwide Expedited');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_PR_ORIGIN_14', 'UPS Next Day Air Early A.M.');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_PR_ORIGIN_54', 'UPS Worldwide Express Plus');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_PR_ORIGIN_65', 'UPS Saver');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_MEXICO_ORIGIN_07', 'UPS Express');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_MEXICO_ORIGIN_08', 'UPS Expedited');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_MEXICO_ORIGIN_54', 'UPS Express Plus');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_MEXICO_ORIGIN_65', 'UPS Saver');
	// service 7 seems to be gone by Jan 2, 2007 for other origins
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_OTHER_ORIGIN_07', 'UPS Worldwide Express');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_OTHER_ORIGIN_08', 'UPS Worldwide Expedited');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_OTHER_ORIGIN_54', 'UPS Worldwide Express Plus');
	define('MODULE_SHIPPING_UPSXML_SERVICE_CODE_PR_ORIGIN_65', 'UPS Saver');

	define('UPSXML_US_01', 'Next Day Air');
	define('UPSXML_US_02', '2nd Day Air');
	define('UPSXML_US_03', 'Ground');
	define('UPSXML_US_07', 'Worldwide Express');
	define('UPSXML_US_08', 'Worldwide Expedited');
	define('UPSXML_US_11', 'Standard');
	define('UPSXML_US_12', '3 Day Select');
	define('UPSXML_US_13', 'Next Day Air Saver');
	define('UPSXML_US_14', 'Next Day Air Early A.M.');
	define('UPSXML_US_54', 'Worldwide Express Plus');
	define('UPSXML_US_59', '2nd Day Air A.M.');
	define('UPSXML_US_65', 'Saver');
	define('UPSXML_CAN_01', 'Express');
	define('UPSXML_CAN_02', 'Expedited');
	define('UPSXML_CAN_14', 'Express Early A.M.');
	define('UPSXML_EU_82', 'Today Standard');
	define('UPSXML_EU_83', 'Today Dedicated Courier');
	define('UPSXML_EU_84', 'Today Intercity');
	define('UPSXML_MEX_54', 'Express Plus');
?>