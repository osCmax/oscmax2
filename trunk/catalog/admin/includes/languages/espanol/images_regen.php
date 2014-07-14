<?php
/*
$Id: images_regen.php 1011 2011-01-06 23:38:01Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Administrador de imágenes de producto');
define('TABLE_HEADING_PRODUCT_ID', 'ID');
define('TABLE_HEADING_PRODUCT_MODEL', 'Model');
define('TABLE_HEADING_PRODUCT_NAME', 'Producto');
define('TABLE_HEADING_PRODUCT_IMAGE', 'Nombre imagen');
define('TABLE_HEADING_MISSING_PRODUCT_IMAGE', 'Nombre imagen perdida');
define('TABLE_HEADING_IMAGE_FOLDER', 'Carpeta de imágenes');
define('TABLE_HEADING_ORPHAN_IMAGES', 'Imágenes huérfanas');
define('TABLE_HEADING_FOLDER', 'Carpeta');
define('TABLE_HEADING_IMAGE_SIZE', 'Tamaño imagen');
define('TABLE_HEADING_WIDTH', 'Ancho');
define('TABLE_HEADING_HEIGHT', 'Alto');
define('TABLE_HEADING_JPG', 'JPG');
define('TABLE_HEADING_PNG', 'PNG');
define('TABLE_HEADING_GIF', 'GIF');
define('TABLE_HEADING_UNKNOWN', 'Desconocido');
define('TABLE_HEADING_TOTAL', 'Total');	   
define('MISSING_IMAGES', 'Imágenes perdidas');
define('ORPHAN_IMAGES', 'Imágenes huérfanas');
define('SUMMARY', 'Resumen');

define('TABLE_HEADING_L', 'G');
define('TABLE_HEADING_M', 'M');
define('TABLE_HEADING_S', 'P'); 
define('TABLE_HEADING_DL', 'DG');
define('TABLE_HEADING_DM', 'DM');
define('TABLE_HEADING_DS', 'DP');
define('TABLE_HEADING_IMAGE_FILE_SIZE_LG', 'G Kb');
define('TABLE_HEADING_IMAGE_FILE_SIZE_MD', 'M Kb');
define('TABLE_HEADING_IMAGE_FILE_SIZE_SM', 'P Kb');
define('TABLE_HEADING_ACTION', 'Acción');

define('TEXT_MISSING_IMAGES', 'Imágenes perdidas');
define('TEXT_YOU_HAVE', 'Tienes ');
define('TEXT_ACCOUNT_FOR', ' en la base de datos de la tienda y todas están justificadas.');
define('TEXT_SUCCESS_1', 'Todas las imágenes que se podían regenerar desde ');
define('TEXT_SUCCESS_2', '  han sido correctamente regeneradas');
define('TEXT_IMAGES_ON_SERVER', ' imágenes en el servidor incluyendo ');
define('TEXT_DYNAMIC', ' mopics dinámica');
define('TEXT_ACCOUNTED_FOR', ' (p.ej. _1, _2, etc.) y todas están justificadas.');
define('TEXT_IMAGES_FOR', 'Las imágenes para ');
define('TEXT_SUC_REGEN', ' han sido regeneradas correctamente');
define('TEXT_SMALL_IMAGE', 'Imagen pequeña');
define('TEXT_MEDIUM_IMAGE', 'Imagen mediana');
define('TEXT_LARGE_IMAGE', 'Imagen grande');
define('TEXT_FILE_SIZE', 'Tamaño de fichero');
define('TEXT_MAIN_IMAGE', 'Imagen principal: ');
define('TEXT_SMALL_IMAGE', 'Imagen pequeña');
define('TEXT_PRODUCT_IMAGE', 'Imágenes de producto');
define('TEXT_LARGE_IMAGE', 'Imagen grande');
define('TEXT_MISSING_FROM', 'Falta el fichero de imagen de ');
define('TEXT_NO_GENERATE', ' sin el cual no se pueden regenerar las imágenes.');
define('TEXT_MOPICS_IMAGE', 'Imagen mopics: ');
define('TEXT_OUT_OF', 'De ');
define('TEXT_PRODUCTS_YOU_HAVE', ' producto(s) hay ');
define('TEXT_MISSING_IMAGE', ' imágenes perdida');
define('TEXT_NO_MOPICS', 'Por favor téngase en cuenta que han sido excluidos de este repaso los ficheros que utilicen la estructura numérica de mopics dinámicas (_1, _2, etc.).');
define('TEXT_REGENERATE_ALL', 'Regenerar todas las imágenes en el servidor - ¡confirmar por favor!');
define('TEXT_INFO_DESCRIPTION', 'Esto regenerará las imágenes de producto y miniaturas a partir de imágenes que ya existan y estén guardadas en el directorio "images_big".
		¡Se sobreescribirán las imágenes de producto y miniaturas que ya existan!<br />');
define('TEXT_INFO_WARNING', '<b>Advertencia:</b> Esta herramienta NO es la mejor manera de volver a tener estas imágenes y es muy posible que se aumente de forma considerable la carga del servidor.<br />
		Es recomedable que en lugar de esto proceses por lotes imágenes en tu máquina local.<br />');
define('TEXT_INFO_PROCESSING', '<br>Procesando<br>');
define('TEXT_INFO_COMPLETED', '<br>Completado<br>');

define('TEXT_CONFIRM_REGENERATE_ALL', 'Has seleccionado regenerar todas las imágenes del servidor.  <br><br><b>Nota:</b> Se sobreescribirán todas las imágenes actualmente almacenadas en <b>images/' . DYNAMIC_MOPICS_PRODUCTS_DIR . '</b> y en <b>images/' . DYNAMIC_MOPICS_THUMBS_DIR . '</b> si existe una imagen que le corresponda en la carpeta <b>images/' . DYNAMIC_MOPICS_BIGIMAGES_DIR . '</b> folder. <br><br>Por favor, téngase también en cuenta que este proceso puede acaparar una gran proporción de la capacidad de proceso del servidor y como tal <b>sólo</b> debería ejecutarse en períodos tranquilos en la tienda.');

define('IMAGE_MISSING_IMAGE', 'Imagen miniatura perdida');

define('IMAGE_REGENERATE_MISSING','Regenerar perdidas');
define('TEXT_SUCESS_TOTAL', 'Total de conjuntos de imágenes regenerados = ');
define('TEXT_REGENERATE_MISSING', 'Regenerar imágenes perdidas - ¡confirmar por favor!');
define('TEXT_CONFIRM_REGENERATE_MISSING', 'Has seleccionado regenerar todas las imágenes perdidas del servidor.  <br><br><b>Nota:</b> Se sobreescribirán todas las imágenes actualmente almacenadas en <b>images/' . DYNAMIC_MOPICS_PRODUCTS_DIR . '</b> y en <b>images/' . DYNAMIC_MOPICS_THUMBS_DIR . '</b> si existe una imagen que le corresponda en la carpeta <b>images/' . DYNAMIC_MOPICS_BIGIMAGES_DIR . '</b>. <br><br>Por favor, téngase también en cuenta que este proceso puede acaparar una gran proporción de la capacidad de proceso del servidor y como tal <b>sólo</b> debería ejecutarse en períodos tranquilos en la tienda.');

define('TEXT_DELETE_ORPHANS', 'Borrar imágenes huérfanas');
define('TEXT_CONFIRM_DELETE_ORPHANS', 'Por favor, confirma que quieres eliminar todas las imágenes huérfanas.<br><br>  Esta acción <b>no se puede deshacer</b> y se <i>recomienda encarecidamente</i> que <b>hagas una copia de seguridad de tus datos</b> antes de usar esta función.');
define('TEXT_ORPHAN_REMOVED', 'imágen(es) huérfana(s) eliminada(s).');

define('TEXT_IMAGE_SIZE', 'Hide images < than: ');
define('TEXT_FILTER', 'Filter by category: ');

?>