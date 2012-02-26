<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Administrador de banners de afiliados');

define('TABLE_HEADING_BANNERS', 'Banners');
define('TABLE_HEADING_GROUPS', 'Grupos');
define('TABLE_HEADING_ACTION', 'Acción');
define('TABLE_HEADING_STATISTICS', 'Estadísticas');
define('TABLE_HEADING_PRODUCT_ID', 'ID productos');
define('TEXT_VALID_CATEGORIES_LIST', 'Lista de categorías disponibles');
define('TEXT_VALID_CATEGORIES_ID', 'ID categoría');
define('TEXT_VALID_CATEGORIES_NAME', 'Nombre de categoría');
define('TABLE_HEADING_CATEGORY_ID', 'ID cat');
define('TEXT_BANNERS_LINKED_CATEGORY','ID de categoría');
define('TEXT_BANNERS_LINKED_CATEGORY_NOTE','Si quieres que el banner enlace a una CATEGORÍA específica introduce aquí el ID DE CATEGORÍA. Si quieres que enlace a la página por defecto introduce "0"');
define('TEXT_AFFILIATE_VALIDCATS', 'Pulsa aquí:');
define('TEXT_AFFILIATE_CATEGORY_BANNER_VIEW','para ver las CATEGORÍAS disponibles.');
define('TEXT_AFFILIATE_CATEGORY_BANNER_HELP','Selecciona el número de categoría de los que se muestran en la ventana emergente e introduce ese número en el campo ID de categoría.');

define('TEXT_BANNERS_TITLE', 'Título de banner:');
define('TEXT_BANNERS_GROUP', 'Grupo de banner:');
define('TEXT_BANNERS_NEW_GROUP', ', o introduce un grupo nuevo');
define('TEXT_BANNERS_IMAGE', 'Imagen:');
define('TEXT_BANNERS_IMAGE_LOCAL', ', o introduce un fichero local');
define('TEXT_BANNERS_IMAGE_TARGET', 'Destino de la imagen (grabar en):');
define('TEXT_BANNERS_HTML_TEXT', 'Texto HTML:');
define('TEXT_AFFILIATE_BANNERS_NOTE', '<b>Notas sobre el Banner:</b><ul><li>Utiliza una imagen o texto HTML para el banner - no ambos.</li><li>El texto HTML tiene prioridad sobre una imagen</li></ul>');

define('TEXT_BANNERS_LINKED_PRODUCT','ID producto');
define('TEXT_BANNERS_LINKED_PRODUCT_NOTE','Si quieres que el banner enlace un producto específico introduce aquí su ID de producto. Si quieres que enlace a la página por defecto introduce "0"');

define('TEXT_BANNERS_DATE_ADDED', 'Añadido el:');
define('TEXT_BANNERS_STATUS_CHANGE', 'Última modificación: %s');

define('TEXT_AFFILIATE_VALIDPRODUCTS', 'Pulsa aquí:');
define('TEXT_AFFILIATE_INDIVIDUAL_BANNER_VIEW', 'para ver los productos disponibles.');
define('TEXT_AFFILIATE_INDIVIDUAL_BANNER_HELP', 'Selecciona el número de producto que quieras de los que se muestran en la ventana emergente e introduce ese número en el campo ID de producto.');

define('TEXT_VALID_PRODUCTS_LIST', 'Lista de productos disponibles');
define('TEXT_VALID_PRODUCTS_ID', 'ID producto');
define('TEXT_VALID_PRODUCTS_NAME', 'Nombre de producto');

define('TEXT_CLOSE_WINDOW', '<u>Cerrar ventana</u> [x]');
define('TEXT_INFO_DELETE_INTRO', 'Seguro que quieres eliminar este banner?');
define('TEXT_INFO_DELETE_IMAGE', 'Borrar imagen de banner');

define('SUCCESS_BANNER_INSERTED', 'Correcto: Se ha insertado el banner.');
define('SUCCESS_BANNER_UPDATED', 'Correcto: Se ha actualizado el banner.');
define('SUCCESS_BANNER_REMOVED', 'Correcto: Se ha quitado el banner.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Error: El título de banner es obligatorio.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Error: El grupo de banner es obligatorio.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: El directorio de destino no existe.');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Error: No se puede escribir en el directorio de destino.');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Error: La imagen no existe.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Error: La imagen no se puede quitar.');
?>