<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Administrador de banners');

define('TABLE_HEADING_BANNERS', 'Banners');
define('TABLE_HEADING_GROUPS', 'Grupos');
define('TABLE_HEADING_STATISTICS', 'Impresiones / Clicks');
define('TABLE_HEADING_STATUS', 'Estado');
define('TABLE_HEADING_ACTION', 'Acción');

define('TEXT_BANNERS_TITLE', 'Título del banner:');
define('TEXT_BANNERS_URL', 'URL del banner:');
define('TEXT_BANNERS_GROUP', 'Grupo del banner:');
define('TEXT_BANNERS_NEW_GROUP', ' , o introduce un grupo nuevo:');
define('TEXT_BANNERS_IMAGE', 'Imagen:');
define('TEXT_BANNERS_IMAGE_LOCAL', ', o introduce un fichero local del servidor a continuación');
define('TEXT_BANNERS_IMAGE_TARGET', 'Destino de la imagen (grabar en):');
define('TEXT_BANNERS_HTML_TEXT', 'Texto HTML:');
define('TEXT_BANNERS_EXPIRES_ON', 'Caduca el:');
define('TEXT_BANNERS_OR_AT', ' , o después de ');
define('TEXT_BANNERS_IMPRESSIONS', 'impresiones/visualizaciones.');
define('TEXT_BANNERS_SCHEDULED_AT', 'Programado para el:');
define('TEXT_BANNERS_BANNER_NOTE', '<b>Notas sobre el banner:</b><ul><li>Utiliza imagen o texto HTML para el banner - no ambos.</li><li>El texto HTML tiene prioridad sobre una imagen</li><li>Para enlazar a un sitio web externo asegúrate de incluir <b>http://</b></li></ul>');
define('TEXT_BANNERS_GROUP_NOTE', '<b>Grupos de banners:</b><ul><li>all - se muestra en el pie de página de todas las páginas</li><li>index - se muestra en la página de inicio en el área principal de contenido</li><li>product - se muestra en la  página de product_info</li><li>Se puede cambiar el orden en que se muestran los módulos en ´Configuración -> Plantillas -> Módulos de página</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>Notas sobre imagen:</b><ul><li>El directorio donde suba la imagen debe de tener configurados los permisos de escritura necesarios!</li><li>No rellene el campo \'Grabar en\' si no va a subir una imagen al servidor (por ejemplo, cuando use una imagen ya existente en el servidor -fichero local).</li><li>El campo \'Grabar en\' debe de ser un directorio que exista y terminado en una barra (por ejemplo: banners/).</li></ul>');
define('TEXT_BANNERS_EXPIRCY_NOTE', '<b>Notas sobre caducidad:</b><ul><li>Solo se debe de rellenar uno de los dos campos</li><li>Si el banner no debe de caducar no rellene ninguno de los campos</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>Notas sobre programación:</b><ul><li>Si se configura una fecha de programación el banner se activara en esa fecha.</li><li>Todos los banners programados se marcan como inactivos hasta que llegue su fecha, cuando se marcan activos.</li></ul>');

define('TEXT_BANNERS_DATE_ADDED', 'Añadido el:');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Programado el: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Caduca el: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Caduca tras: <b>%s</b> impresiones');
define('TEXT_BANNERS_STATUS_CHANGE', 'Cambio estado: %s');

define('TEXT_BANNERS_DATA', 'D<br>A<br>T<br>O<br>S');
define('TEXT_BANNERS_LAST_3_DAYS', 'Últimos 3 dias');
define('TEXT_BANNERS_BANNER_VIEWS', 'Impresiones');
define('TEXT_BANNERS_BANNER_CLICKS', 'Clics');

define('TEXT_INFO_DELETE_INTRO', '¿Estás seguro que quieres eliminar este banner?');
define('TEXT_INFO_DELETE_IMAGE', 'Borrar imagen');

define('SUCCESS_BANNER_INSERTED', 'Correcto: Se ha añadido el banner.');
define('SUCCESS_BANNER_UPDATED', 'Correcto: Se ha actualizado el banner.');
define('SUCCESS_BANNER_REMOVED', 'Correcto: Se ha eliminado el banner.');
define('SUCCESS_BANNER_STATUS_UPDATED', 'Correcto: El estado del banner se ha actualizado.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Error: El título del banner es obligatorio.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Error: El grupo del banner es obligatorio.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Error: No existe el directorio destino: %s');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Error: No se puede escribir en el directorio destino: %s');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Error: No existe imagen.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Error: No se puede eliminar la imagen.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Error: Estado desconocido.');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Error: No existe el directorio de gráficos. Por favor crea un directorio llamado \'graphs\' dentro de \'images\'.');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Error: No se puede escribir en el directorio de gráficos.');

define('TEXT_BANNERS_HELP', 'Ayuda del administrador de banners');
?>