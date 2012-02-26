<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Búsqueda avanzada');
define('NAVBAR_TITLE_2', 'Resultados de la búsqueda');

define('HEADING_TITLE_1', 'Búsqueda avanzada');
define('HEADING_TITLE_2', 'Productos que satisfacen los criterios de búsqueda');

define('HEADING_SEARCH_CRITERIA', 'Búsqueda avanzada');

define('TEXT_SEARCH_IN_DESCRIPTION', 'Buscar también en la descripción');
define('ENTRY_CATEGORIES', 'Categorías:');
define('ENTRY_INCLUDE_SUBCATEGORIES', 'Incluir subcategorías');
define('ENTRY_MANUFACTURERS', 'Fabricante:');
define('ENTRY_PRICE_FROM', 'Desde precio:');
define('ENTRY_PRICE_TO', 'Hasta precio:');
define('ENTRY_DATE_FROM', 'Desde fecha:');
define('ENTRY_DATE_TO', 'Hasta fecha:');

define('TEXT_SEARCH_HELP_LINK', '<u>Ayuda</u> [?]');

define('TEXT_ALL_CATEGORIES', 'Todas');
define('TEXT_ALL_MANUFACTURERS', 'Todos');

define('HEADING_SEARCH_HELP', 'Consejos para la búsqueda avanzada');
define('TEXT_SEARCH_HELP', 'El motor de búsqueda le permite hacer una búsqueda por palabras clave en el modelo, nombre y descripción del producto y en el nombre del fabricante.<br><br>Cuando haga una búsqueda por palabras o frases clave, puede separar estas con los operadores lógicos AND y OR. Por ejemplo, puede hacer una búsqueda por <u>microsoft AND ratón</u>. Esta búsqueda daría como resultado los productos que contengan ambas palabras. Por el contrario, si teclea  <u>ratón OR teclado</u>, conseguirá una lista de los productos que contengan las dos o sólo una de las palabras. Si no se separan las palabras o frases clave con AND o con OR, la búsqueda se hará usando por defecto el operador logico AND.<br><br>Puede realizar búsquedas exactas de varias palabras encerrándolas entre comillas. Por ejemplo, si busca <u>"ordenador portátil"</u>, obtendrás una lista de productos que tengan exactamente esa cadena de texto en ellos.<br><br>Se pueden usar paréntensis para controlar el orden de las operaciones lógicas. Por ejemplo, puede introducir <u>microsoft and (teclado or ratón or "visual basic")</u>.');
define('TEXT_CLOSE_WINDOW', '<u>Cerrar ventana</u> [x]');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', 'Modelo');
define('TABLE_HEADING_PRODUCTS', 'Descripción');
define('TABLE_HEADING_MANUFACTURER', 'Fabricante');
define('TABLE_HEADING_QUANTITY', 'Cantidad');
define('TABLE_HEADING_PRICE', 'Precio');
define('TABLE_HEADING_WEIGHT', 'Peso');
define('TABLE_HEADING_BUY_NOW', 'Compre ahora');

define('TEXT_NO_PRODUCTS', 'No hay productos que correspondan con los criterios de búsqueda.');

define('ERROR_AT_LEAST_ONE_INPUT', 'Debe introducir al menos un criterio de búsqueda.');
define('ERROR_INVALID_FROM_DATE', 'La fecha introducida en Desde fecha es inválida');
define('ERROR_INVALID_TO_DATE', 'La fecha introducida en Hasta fecha es inválida');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', 'La fecha de Hasta fecha debe ser mayor que la de Desde fecha');
define('ERROR_PRICE_FROM_MUST_BE_NUM', 'El campo Desde precio debe ser númerico');
define('ERROR_PRICE_TO_MUST_BE_NUM', 'El campo Hasta precio debe ser númerico');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', 'El precio de Hasta precio debe ser mayor o igual que el de Desde precio');
define('ERROR_INVALID_KEYWORDS', 'Palabras clave incorrectas');
define('TEXT_OPTIONAL','Las entradas en los siguientes campos son opcionales a menos que el criterio de búsqueda se deja en blanco. En este caso, se debe rellenar al menos un campo de los siguientes.');

define('TEXT_FOR_FIELD','Para este campo coincide ');

define('TEXT_MATCH_ANY','Cualquier valor seleccionado o ');

define('TEXT_MATCH_ALL','Todos los valores seleccionados');

?>
