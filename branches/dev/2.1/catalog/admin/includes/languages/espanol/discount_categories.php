<?php
/*
$Id: discount_categories.php 1011 2011-01-06 23:38:01Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
  
define('HEADING_TITLE', 'Grupos de descuento');
define('HEADING_TITLE_PRODUCTS_TO_DISCOUNT_CATEGORIES', 'Productos a grupos de descuento');
define('HEADING_TITLE_SEARCH', 'Buscar:');
define('HEADING_TITLE_NEW_DISCOUNT_CATEGORIES_NAME', '<b>Nuevo grupo&#160;de&#160;descuento&#160;</b>');

define('TABLE_HEADING_NAME', 'Nombre');
define('TABLE_HEADING_ID', 'dcID');
define('TABLE_HEADING_PRODUCTS_ID', 'pID');
define('TABLE_HEADING_MODEL', 'Referencia');
define('TABLE_HEADING_STATUS', 'Estado');
define('TABLE_HEADING_DISCOUNT_CATEGORY', 'Grupo descuento');
define('TABLE_HEADING_DISCOUNT_CATEGORIES_NAME', '/ <b>Nombre</b>');
define('TABLE_HEADING_NEW_DISCOUNT_CATEGORIES_NAME', ' <b>Nombre</b>');
define('TABLE_HEADING_DISCOUNT_CATEGORIES_ID', '<b>ID</b>');
define('TABLE_HEADING_ACTION', 'Acción');
define('TABLE_HEADING_CUSTOMERS_GROUPS', 'Grupo&#160;cliente');

define('ENTRY_DISCOUNT_CATEGORIES_NAME', '<b>Nombre&#160;grupo&#160;de&#160;descuento</b>');
define('ENTRY_NEW_DISCOUNT_CATEGORIES_NAME', '<b>Nuevo grupo&#160;de&#160;descuento&#160;</b>');
define('ENTRY_DISCOUNT_CATEGORIES_NAME_MAX_LENGTH', ' (longitud máx.: 255 caracteres)');

define('ERROR_DISCOUNT_CATEGORIES_NAME', 'Por favor introduce un nombre par el grupo de descuento');
define('ERROR_DISCOUNT_CATEGORIES_ID', 'No se ha encontrado ningún grupo de descuento para esta acción');
define('ERROR_UPDATE_INSERT_DISCOUNT_CATEGORY', 'Algo no ha ido bien mientras se actualizaba o insertaba en la tabla discount_categories');

define('TEXT_DELETE_INTRO', '¿Seguro que quieres eliminar este grupo de descuento?');
define('TEXT_DISPLAY_NUMBER_OF_DISCOUNT_CATEGORIES', 'Mostrando del <b>%d</b> al <b>%d</b> (de <b>%d</b> Grupos de descuento)');
define('TEXT_INFO_HEADING_DELETE_DISCOUNT_CATEGORY', 'Eliminar grupo de descuento');
define('TEXT_NO_PRODUCTS','No se han encontrado productos');
define('TEXT_MOUSE_OVER_DISCOUNT_GROUPS_PER_GROUP_POPUP', 'Pulsa para editar los grupos de descuento de este producto para cada grupo de cliente en una ventana emergente');
define('TEXT_IMAGE_SWITCH_EDIT','Para una edición completa dirígete a la página del producto');
define('TEXT_IMAGE_EDIT_GROUP_DISCOUNT_CATEGORIES', 'Editar grupos de descuento discount de este producto para cada grupo de cliente en una ventana emergente');
define('NAME_WINDOW_DISCOUNT_GROUPS_PER_GROUP_POPUP', 'Grupos de descuento por grupo de cliente');
define('SORT_BY_PRODUCTS_ID_ASC', 'Ordenar de forma ascendente por ID producto  --> 1-2-3 desde arriba ');
define('SORT_BY_PRODUCTS_ID_DESC', 'Ordenar de forma descendente por ID producto  --> 3-2-1 desde arriba ');
define('SORT_BY_PRODUCTS_MODEL_ASC', 'Ordenar de forma ascendente por referencia  --> a-b-c desde arriba ');
define('SORT_BY_PRODUCTS_MODEL_DESC', 'Ordenar de forma descendente por referencia  --> z-y-x desde arriba ');
define('SORT_BY_PRODUCTS_NAME_ASC', 'Ordenar de forma ascendente por nombre  --> a-b-c desde arriba ');
define('SORT_BY_PRODUCTS_NAME_DESC', 'Ordenar de forma descendente por nombre  --> z-y-x desde arriba ');


define('TEXT_MAXI_ROW_BY_PAGE', 'Máx. nº de filas por página');
define('TEXT_ALL_MANUFACTURERS', 'Todos los fabricantes');
define('TEXT_ALL_DISCOUNT_CATEGORIES', 'Todos los grupos de descuento');
define('TEXT_BACK_TO_DISCOUNT_CATEGORIES','Back to grupos de descuento');
define('DISPLAY_CATEGORIES', 'Selecciona categoría:');
define('DISPLAY_MANUFACTURERS', 'Selecciona fabricante:'); 
define('DISPLAY_DISCOUNT_CATEGORIES', 'Selecciona grupo de descuento:');

define('DC_ICON_STATUS_RED_LIGHT', 'Desactivado');
define('DC_ICON_STATUS_GREEN_LIGHT', 'Activado');
?>