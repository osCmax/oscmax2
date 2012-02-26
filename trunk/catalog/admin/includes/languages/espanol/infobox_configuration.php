<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/


define('HEADER_TITLE', 'Visualización, actualización y creación de Infoboxes');
define('TABLE_HEADING_CONFIGURATION_TITLE', 'Título');
define('TABLE_HEADING_CONFIGURATION_VALUE', 'Nombre fichero');
define('TABLE_HEADING_STATUS', 'Estado');
define('TABLE_HEADING_ACTION', 'Acción');
define('TABLE_HEADING_COLUMN', 'Columna');
define('TABLE_HEADING_SORT_ORDER', 'Posición');

define('TEXT_INFO_EDIT_INTRO', 'Por favor realiza los cambios necesarios');
define('TEXT_INFO_DATE_ADDED', 'Fecha añadida:');
define('TEXT_INFO_LAST_MODIFIED', 'Última modificación:');
define('TEXT_INFO_HEADING_NEW_INFOBOX', 'Añadiendo una nueva Infobox');
define('TEXT_INFO_INSERT_INTRO', 'Se muestra un ejemplo para la Infobox <b> what\'s_new.php</b>');
define('TEXT_INFO_DELETE_INTRO', '<P STYLE="color: red; font-weight: bold;">Confirmación para eliminar Infobox');
define('TEXT_INFO_HEADING_DELETE_INFOBOX', '¿Eliminar Infobox?');

define('IMAGE_INFOBOX_STATUS_GREEN', 'Izquierda');
define('IMAGE_INFOBOX_STATUS_GREEN_LIGHT', 'Configurar a la izquierda');
define('IMAGE_INFOBOX_STATUS_RED', 'Derecha');
define('IMAGE_INFOBOX_STATUS_RED_LIGHT', 'Configurar a la derecha');
define('BOX_HEADING_BOXES', 'Administrador Infoboxes');

define('TEXT_INFOBOX_FILENAME', 'Nombre fichero');
define('TEXT_INFOBOX_DEFINE_KEY', 'Definir clave');
define('TEXT_INFOBOX_COLUMN', 'Columna (izquierda->left o derecha->right)');
define('TEXT_INFOBOX_POSITION', 'Orden');
define('TEXT_INFOBOX_ACTIVE', '¿Establecer esta caja como activa?'); 


define('TEXT_HELP_HEADING_NEW_INFOBOX', 'Ayuda Infobox ');

define('TEXT_INFOBOX_HELP_FILENAME', 'Esto debe representar el nombre del fichero de la caja que se ponga en la carpeta <u>catalog/includes/boxes</u> folder.<br><br> Debe estar en minúsculas, pero puede tener espacios en lugar de usar el guión bajo (_) y puede incluir \'s ya que el sistema los quitará automáticamente.<br><br>Por ejemplo:<br>La nueva Infobox se llama <b>new_box.php</b>, aquí se escribiría <b> new box</b><br><br>Otro ejemplo sería la caja <b>whats_new</b>.<br><br> Obviamente se llama <b>whats_new.php </b>, pero se podría escribir aquí <b>what\'s new</b>');

define('TEXT_INFOBOX_HELP_HEADING', 'Esto es simplemente lo que se mostrará encima de la Infobox en el catálogo.');

define('TEXT_INFOBOX_HELP_DEFINE', 'Un ejemplo de esto sería: <b>BOX_HEADING_WHATS_NEW</b>.  <br><br>Los ficheros de idioma usan esto para proporcionar la traducción correcta al encabezado de la Infobox que se está editando o creando.  <br><br>Si deseas definir esto por favor examina el fichero de idioma para la Infobox actual.');

define('TEXT_INFOBOX_HELP_COLUMN', 'Introduce <b>left</b> para izquierda o <b>right</b> para derecha');

define('TEXT_INFOBOX_HELP_POSITION', 'Introduce aquí cualquier número que quieras. Cuanto más alto sea el número más abajo de la columna seleccionada aparecerá la Infobox.<br><br> Si introduces el mismo número para más de una Infobox, se mostrarán por orden alfabético');

define('TEXT_INFOBOX_HELP_ACTIVE', 'Selecciona <b>sí</b> o <b>no</b>. <br><br><b>sí</b> mostrará la Infobox y <b>no</b> no la mostrará.');

define('TEXT_CLOSE_WINDOW', '<u>Cerrar ventana</u> [x]');

define('COUNT_1', 'Actualmente hay: ');
define('COUNT_2', ' cajas en la columna izquierda y ');
define('COUNT_3', ' cajas en la columna derecha.');

?>