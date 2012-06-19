<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
/*
  
  English translation to AJAX-AttributeManager-V2.7
  
  by Shimon Doodkin
  http://help.me.pro.googlepages.com
  helpmepro1@gmail.com
*/

//attributeManagerPrompts.inc.php

define('AM_AJAX_YES', 'Sí');
define('AM_AJAX_NO', 'No');
define('AM_AJAX_UPDATE', 'Actualizar');
define('AM_AJAX_CANCEL', 'Cancelar');
define('AM_AJAX_OK', 'OK');

define('AM_AJAX_SORT', 'Ordenar:');
define('AM_AJAX_TRACK_STOCK', '¿Seguimiento de existencias?');
define('AM_AJAX_TRACK_STOCK_IMGALT', '¿Seguimiento de existencias de este atributo?');

define('AM_AJAX_ENTER_NEW_OPTION_NAME', 'Por favor introduce el nombre de la nueva opción');
define('AM_AJAX_ENTER_NEW_OPTION_VALUE_NAME', 'Por favor introduce el valor de la nueva opción');
define('AM_AJAX_ENTER_NEW_OPTION_VALUE_NAME_TO_ADD_TO', 'Por facor introduce un nombre para el valor de la opción que se va a añadir a %s');

define('AM_AJAX_PROMPT_REMOVE_OPTION_AND_ALL_VALUES', '¿Seguro que quieres quitar %s y todos sus valores para este producto?');
define('AM_AJAX_PROMPT_REMOVE_OPTION', '¿Seguro que quieres quitar %s de este producto?');
define('AM_AJAX_PROMPT_STOCK_COMBINATION', '¿Seguro que quieres quitar esta combinación de existencias de este producto?');

define('AM_AJAX_PROMPT_LOAD_TEMPLATE', '¿Seguro que quieres cargar la plantilla %s? <br />Se sobreescribirán las opciones actuales del producto y esto no se puede deshacer');
define('AM_AJAX_NEW_TEMPLATE_NAME_HEADER', 'Por favor introduce un nombre para la nueva plantilla. O...');
define('AM_AJAX_NEW_NAME', 'Nuevo nombre:');
define('AM_AJAX_CHOOSE_EXISTING_TEMPLATE_TO_OVERWRITE', ' ...<br /> ... escoja una que ya exista y se sobreescribirá');
define('AM_AJAX_CHOOSE_EXISTING_TEMPLATE_TITLE', 'Ya existe:'); 
define('AM_AJAX_RENAME_TEMPLATE_ENTER_NEW_NAME', 'Por favor introduce el nuevo nombre para la plantilla %s');
define('AM_AJAX_PROMPT_DELETE_TEMPLATE', '¿Seguro que quieres eliminar la plantilla %s?<br>¡Esta operación no se puede deshacer!');

//attributeManager.php

define('AM_AJAX_ADDS_ATTRIBUTE_TO_OPTION', 'Agrega a la opción %s el atributo seleccionado a la izquierda');
define('AM_AJAX_ADDS_NEW_VALUE_TO_OPTION', 'Añade un nuevo valor a la opción %s');
define('AM_AJAX_PRODUCT_REMOVES_OPTION_AND_ITS_VALUES', 'Quita de este producto la opción %1$s y los %2$d valor(es) bajo esa opción');
define('AM_AJAX_CHANGES', 'Cambios'); 
define('AM_AJAX_LOADS_SELECTED_TEMPLATE', 'Carga la plantilla seleccionada');
define('AM_AJAX_SAVES_ATTRIBUTES_AS_A_NEW_TEMPLATE', 'Guardar los atributos actuales como una nueva plantilla');
define('AM_AJAX_RENAMES_THE_SELECTED_TEMPLATE', 'Renombrar la plantilla seleccionada');
define('AM_AJAX_DELETES_THE_SELECTED_TEMPLATE', 'Eliminar la plantilla seleccionada');
define('AM_AJAX_NAME', 'Nombre');
define('AM_AJAX_ACTION', 'Acción');
define('AM_AJAX_PRODUCT_REMOVES_VALUE_FROM_OPTION', 'Quita %1$s de %2$s, para este producto');
define('AM_AJAX_MOVES_VALUE_UP', 'Mover el valor hacia arriba');
define('AM_AJAX_MOVES_VALUE_DOWN', 'Mover el valor hacia abajo');
define('AM_AJAX_ADDS_NEW_OPTION', 'Añadir una nueva opción a la lista');
define('AM_AJAX_OPTION', 'Opción:');
define('AM_AJAX_VALUE', 'Valor:');
define('AM_AJAX_PREFIX', 'Prefijo:');
define('AM_AJAX_PRICE', 'Precio:');
define('AM_AJAX_WEIGHT_PREFIX', 'Prefijo peso:');
define('AM_AJAX_WEIGHT', 'Peso:');
define('AM_AJAX_SORT', 'Orden:');
define('AM_AJAX_ADDS_NEW_OPTION_VALUE', 'Añadir un nuevo valor de opción a la lista');
define('AM_AJAX_ADDS_ATTRIBUTE_TO_PRODUCT', 'Añadir el atributo al producto actual');
define('AM_AJAX_DELETES_ATTRIBUTE_FROM_PRODUCT', 'Eliminar el atributo o combinación de atributos del producto actual');
define('AM_AJAX_QUANTITY', 'Cantidad:');
define('AM_AJAX_PRODUCT_REMOVE_ATTRIBUTE_COMBINATION_AND_STOCK', 'Quitar esta combinación de atributos y sus existencias del producto');
define('AM_AJAX_UPDATE_OR_INSERT_ATTRIBUTE_COMBINATIONBY_QUANTITY', 'Insertar o actualizar la combinación de atributos con la cantidad determinada');
define('AM_AJAX_UPDATE_PRODUCT_QUANTITY', 'Establece las existencias del producto actual a la cantidad especificada');

//attributeManager.class.php
define('AM_AJAX_TEMPLATES', '-- Plantillas --');

//----------------------------
// Change: download attributes for AM
//
// author: mytool
//-----------------------------
define('AM_AJAX_FILENAME', 'Archivo');
define('AM_AJAX_FILE_DAYS', 'Días');
define('AM_AJAX_FILE_COUNT', 'Descargas máximas');
define('AM_AJAX_DOWLNOAD_EDIT', 'Editar opción de descarga');
define('AM_AJAX_DOWLNOAD_ADD_NEW', 'Añadir opción de descarga');
define('AM_AJAX_DOWLNOAD_DELETE', 'Eliminar opción de descarga');
define('AM_AJAX_HEADER_DOWLNOAD_ADD_NEW', 'Añadir opción de descarga para \"%s\"');
define('AM_AJAX_HEADER_DOWLNOAD_EDIT', 'Editar opción de descarga para\"%s\"');
define('AM_AJAX_HEADER_DOWLNOAD_DELETE', 'Eliminar opción de descarga para\"%s\"');
define('AM_AJAX_FIRST_SAVE', 'Hay que guardar el producto antes de añadir opciones');

//----------------------------
// EOF Change: download attributes for AM
//-----------------------------

define('AM_AJAX_OPTION_NEW_PANEL','Nueva opción:');
?>
