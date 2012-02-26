<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Resumen Ventas/Impuestos mensuales');
define('HEADING_TITLE_STATUS','Estado');
define('HEADING_TITLE_REPORTED','Generado');
//Added line
define('TEXT_DETAIL','Detalles');
define('TEXT_ALL_ORDERS', 'Todos los pedidos');
define('TEXT_NOTHING_FOUND', 'No hay ingresos para esta selección de fecha/estado');
//Added 2 lines
define('TEXT_BUTTON_REPORT_BACK','Volver');
define('TEXT_BUTTON_REPORT_INVERT','Invertir');
define('TEXT_BUTTON_REPORT_PRINT','Imprimir');
define('TEXT_BUTTON_REPORT_SAVE','Guardar CSV');
define('TEXT_BUTTON_REPORT_HELP','Ayuda');
//Added 2 lines
define('TEXT_BUTTON_REPORT_BACK_DESC', 'Volver al resumen por meses');
define('TEXT_BUTTON_REPORT_INVERT_DESC', 'Invertir filas de arriba a abajo');
define('TEXT_BUTTON_REPORT_PRINT_DESC', 'Mostrar informe en una ventana para imprimir');
define('TEXT_BUTTON_REPORT_HELP_DESC', 'Acerca de este informe y cómo utilizar sus características');
//Added line
define('TEXT_BUTTON_REPORT_GET_DETAIL', 'Pulsa para obtener un resumen diario para de este mes');
define('TEXT_REPORT_DATE_FORMAT', 'j M Y -   g:i a'); // date format string
//  as specified in php manual here: http://www.php.net/manual/en/function.date.php
define('TABLE_HEADING_YEAR','Año');
define('TABLE_HEADING_MONTH', 'Mes');
define('TABLE_HEADING_DAY', 'Día');
define('TABLE_HEADING_INCOME', 'Ingresos<br> brutos');
define('TABLE_HEADING_SALES', 'Ventas<br> productos');
define('TABLE_HEADING_NONTAXED', 'Ventas libres <br> de impuestos');
define('TABLE_HEADING_TAXED', 'Ventas sujetas<br> a impuestos');
define('TABLE_HEADING_TAX_COLL', 'Impuestos<br> cobrados');
define('TABLE_HEADING_SHIPHNDL', 'Envío y<br> manipulación');
define('TABLE_HEADING_LOWORDER', 'Cargos por<br> pedido mínimo');
define('TABLE_HEADING_OTHER', 'Cheques<br> regalo');  // could be any other extra class value
define('TABLE_FOOTER_YTD','YTD');
define('TABLE_FOOTER_YEAR','AÑO');
//Added define
define('TEXT_HELP', '<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title>Informe Ventas/Impuestos mensuales</title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/javascript/jquery-ui-1.8.2.custom.css">
</head>
<body>
<center>
<table width="95%"><tr><td>
<p class="main" align="center">
<b>Cómo visualizar y utilizar el informe resumen de ingresos</b>
<p class="main" align="justify">
<b>Presentar la actividad mensual</b>
<p class="smallText" align="justify">
Cuando se selecciona inicialmente desde el menú de Informes, este informe muestra un resumen financiero de todos los pedidos almacenados en la base de datos, por meses. Cada mes del historial de la tienda se resume en una fila, mostrando los ingresos de la tienda y sus componentes, y listando los importes de impuestos, cargos por envío y manipulación, cargos por pedido mínimo y cheques regalo (si no se tienen habilitados los cargos por pedido mínimo o los cheques regalo, estas columnas no se muestran). La actividad se genera en la fecha de la compra.
<p class="smallText" align="justify">
En la fila superior está el mes actual, y las filas debajo de esa resumen cada mes del historial de pedidos. Bajo las filas de cada año de calendario hay una línea, resumiendo los totales de ese año en cada columna del informe. 
<p class="smallText" align="justify">
Para invertir el orden de las columnas, pulsa en el botón de "Invertir".
<p class="main" align="justify">
<b>Presentar el resumen mensual por días</b>
<p class="smallText" align="justify">
El resumen de la actividad diaria dentro de cualquier mes puede ser mostrada al pulsar sobre el nombre del mes, a la izquierda de la fila. Para volver del resumen diario al resumen mensual, pulsa el botón "Volver" en la visualización diaria.
<p class="main" align="justify">
<b>Qué representan las columnas (explicación de las cabeceras)</b>
<p class="smallText" align="justify">
A la izquierda se presentan el mes y el año de la fila. El resto de columnas son, de izquierda a derecha:
<ul><li class="smallText"><b>Ingresos brutos</b> - el total de todos los pedido  
<li class="smallText"><b>Ventas productos</b> - las ventas totales de los productos comprados por los clientes durante el mes
<br>Entonces, las ventas de productos se dividen en dos categorías:
<li class="smallText"><b>Ventas libres de impuestos</b> - el subtotal de las ventas a las que no se les aplicaron impuestos, y 
<li class="smallText"><b>Ventas sujetas a impuestos</b> - el subtotal de las ventas a las que sí se les aplicaron impuestos
<li class="smallText"><b>Impuestos cobrados</b> - el importe cobrada a los clientes en concepto de impuestos
<li class="smallText"><b>Envío y manipulación</b> - el total de cargos cobrados en concepto de envío y manipulación  
<li class="smallText"><b>Cargos por pedido mínimo</b> y <b>Cheques regalo</b> - si están habilitados los cargos por pedido mínimo y/o los cheques regalo, se muestran estos totales en columnas separadas
</ul>
<p class="main" align="justify">
<b>Seleccionar informe resumen por estado</b>
<p class="smallText" align="justify">
Para mostrar la información del resumen mensual o diario para un sólo estado de pedido, selecciona el estado correspondiente en la lista desplegable en la parte de arriba a la derecha de la pantalla del informe. Dependiendo de la configuración de la tienda para esos valores, puede haber estados para "Pendiente" o "Entregado" por ejemplo. Si cambias este estado el informe será recalculado y mostrado en pantalla de nuevo. 
<p class="main" align="justify">
<b>Mostrar los detalles de los impuestos</b>
<p class="smallText" align="justify">
El importe de los impuestos en cualquier fila del informe es un enlace a una ventana emergente, que muestra el nombre de los tipos de impuestos aplicados y los importes individuales.
<p class="main" align="justify">
<b>Imprimir el informe the report</b>
<p class="smallText" align="justify">
Para presentar el informe en una ventana formateado para luego imprimirlo, pulsa en el botón de "Imprimir", después utiliza el comando Imprimir de tu navegador en el menú Fichero. El nombre de la tienda y las cabeceras se añaden para mostrar qué pedidos se seleccionaron, y la fecha y hora de generación del informe. 
<p class="main" align="justify">
<b>Guardar los valores del informe en un fichero</b>
<p class="smallText" align="justify">
Para almacenar los valores del informe a un fichero en tu equipo, pulsa en el botón "Guardar CSV" en la parte inferior del informe. Los valores del informe se enviarán a tu navegador como un fichero de texto, y se te presentará una menú de diálogo de Guardar archivo para que elijas dónde quieres almacenar el fichero. Los conenidos del fichero están en formato Comma Separated Value (CSV) - Valores Separados por Comas, con una línea por cada fila del informe empezando por la línea de cabeceras, y cada valor de la fila está separado por comas. Este fichero puede ser importado con precisión y a conveniencia por herramientas estadísticas y financieras comunes, tales como Excel y QuattroPro. El fichero es proporcionado al navegador con un nombre que consiste en el nombre del informe, el estado seleccionado, y la fecha y hora. <br><br>
<p class="smallText">v 2.1.1
</td></tr>
</table>
</body>
</html>');
?>