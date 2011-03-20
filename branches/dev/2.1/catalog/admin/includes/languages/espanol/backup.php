<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Administrador de copias de seguridad de la base de datos');

define('TABLE_HEADING_TITLE', 'Título');
define('TABLE_HEADING_FILE_DATE', 'Fecha');
define('TABLE_HEADING_FILE_SIZE', 'Tamaño');
define('TABLE_HEADING_ACTION', 'Acción');

define('TEXT_INFO_HEADING_NEW_BACKUP', 'Nueva copia de seguridad');
define('TEXT_INFO_HEADING_RESTORE_LOCAL', 'Restaurar local');
define('TEXT_INFO_NEW_BACKUP', 'No interrumpas el proceso de copia, que puede durar unos minutos.');
define('TEXT_INFO_UNPACK', '<br><br>(despues de descomprimir el archivo)');
define('TEXT_INFO_RESTORE', 'No interrumpas el proceso de restauración.<br><br>Cuanto mas grande sea la copia de seguridad, mas tardará este proceso.<br><br>Si es posible, utiliza el cliente de mysql.<br><br>Por ejemplo:<br><br><b>mysql -h' . DB_SERVER . ' -u' . DB_SERVER_USERNAME . ' -p ' . DB_DATABASE . ' < %s </b> %s');
define('TEXT_INFO_RESTORE_LOCAL', 'No interrumpas el proceso de restauración.<br><br>Cuanto mas grande sea la copia de seguridad, mas tardará este proceso.');
define('TEXT_INFO_RESTORE_LOCAL_RAW_FILE', 'El fichero subido debe ser un fichero SQL de texto.');
define('TEXT_INFO_DATE', 'Fecha:');
define('TEXT_INFO_SIZE', 'Tamaño:');
define('TEXT_INFO_COMPRESSION', 'Compresión:');
define('TEXT_INFO_USE_GZIP', 'Usar GZIP');
define('TEXT_INFO_USE_ZIP', 'Usar ZIP');
define('TEXT_INFO_USE_NO_COMPRESSION', 'Sin compresión (directamente SQL)');
define('TEXT_INFO_DOWNLOAD_ONLY', 'Bajar sólo (no almacenar en el servidor)');
define('TEXT_INFO_BEST_THROUGH_HTTPS', 'Preferiblemente con una conexión segura HTTPS');
define('TEXT_DELETE_INTRO', '¿Seguro que quieres eliminar esta copia?');
define('TEXT_NO_EXTENSION', 'Ninguna');
define('TEXT_BACKUP_DIRECTORY', 'Directorio para copias de seguridad:');
define('TEXT_LAST_RESTORATION', 'Ultima restauración:');
define('TEXT_FORGET', '(<u>olvidar</u>)');

define('ERROR_BACKUP_DIRECTORY_DOES_NOT_EXIST', 'Error: No existe el directorio de copias de seguridad. Por favor configúralo en configure.php');
define('ERROR_BACKUP_DIRECTORY_NOT_WRITEABLE', 'Error: El directorio de copias de seguridad no tiene permisos de escritura.');
define('ERROR_DOWNLOAD_LINK_NOT_ACCEPTABLE', 'Error: El enlace de descarga no es válido.');

define('SUCCESS_LAST_RESTORE_CLEARED', 'Correcto: La fecha de última restauración ha sido borrada.');
define('SUCCESS_DATABASE_SAVED', 'Correcto: Se ha guardado la base de datos.');
define('SUCCESS_DATABASE_RESTORED', 'Correcto: Se ha restaurado la base de datos.');
define('SUCCESS_BACKUP_DELETED', 'Correcto: Se ha eliminado la copia de seguridad.');

define('HEADING_NO_BACKUP','<b>No hay copias de seguridad disponibles</b>');
define('TEXT_NO_BACKUP','Por favor, asegúrate de haber hecho una copia de seguridad de la tienda. Pulsa el botón de <b>Realizar copia</b> para crear una.');

?>