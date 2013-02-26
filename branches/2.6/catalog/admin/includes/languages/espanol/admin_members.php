<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

if ($_GET['gID']) {
  define('HEADING_TITLE', 'Grupos de administración');
} elseif ($_GET['gPath']) {
  define('HEADING_TITLE', 'Definir permisos de grupos');
} else {
  define('HEADING_TITLE', 'Miembros de administración');
}

define('TEXT_COUNT_GROUPS', 'Grupos: ');

define('TABLE_HEADING_USERNAME', 'Nombre de usuario');
define('TABLE_HEADING_NAME', 'Nombre completo');
define('TABLE_HEADING_EMAIL', 'Dirección e-mail');
define('TABLE_HEADING_PASSWORD', 'Contraseña');
define('TABLE_HEADING_CONFIRM', 'Confirmar contraseña');
define('TABLE_HEADING_GROUPS', 'Grupo');
define('TABLE_HEADING_CREATED', 'Cuenta creada');
define('TABLE_HEADING_MODIFIED', 'Cuenta modificada');
define('TABLE_HEADING_LOGDATE', 'Último Acceso');
define('TABLE_HEADING_LOGNUM', 'Nº ses.');
define('TABLE_HEADING_LOG_NUM', 'Número sesión');
define('TABLE_HEADING_ACTION', 'Acción');

define('TABLE_HEADING_GROUPS_NAME', 'Nombre del grupo');
define('TABLE_HEADING_GROUPS_DEFINE', 'Selección de menús y ficheros');
define('TABLE_HEADING_GROUPS_GROUP', 'Nivel');
define('TABLE_HEADING_GROUPS_CATEGORIES', 'Permisos de categorías');


define('TEXT_INFO_HEADING_DEFAULT', 'Miembro de administración ');
define('TEXT_INFO_HEADING_DELETE', 'Eliminar miembro ');
define('TEXT_INFO_HEADING_EDIT', 'Editar miembro de administración');
define('TEXT_INFO_HEADING_NEW', 'Nuevo miembro de administración ');

define('TEXT_INFO_DEFAULT_INTRO', 'Grupo de miembro');
define('TEXT_INFO_DELETE_INTRO', '¿Quitar a <b>%s</b> de Miembros de administración?');
define('TEXT_INFO_DELETE_INTRO_NOT', '¡No puedes eliminar el grupo %s!');
define('TEXT_INFO_EDIT_INTRO', 'Configura nivel de permisos aquí: ');

define('TEXT_INFO_USERNAME', 'Nombre de usuario: ');
define('TEXT_INFO_FULLNAME', 'Nombre completo: ');
define('TEXT_INFO_FIRSTNAME', 'Nombre: ');
define('TEXT_INFO_LASTNAME', 'Apellidos: ');
define('TEXT_INFO_EMAIL', 'Dirección e-mail: ');
define('TEXT_INFO_PASSWORD', 'Contraseña: ');
define('TEXT_INFO_CONFIRM', 'Confirmar contrseña: ');
define('TEXT_INFO_CREATED', 'Cuenta creada: ');
define('TEXT_INFO_MODIFIED', 'Cuenta modificada: ');
define('TEXT_INFO_LOGDATE', 'Ultimo acceso: ');
define('TEXT_INFO_LOGNUM', 'Número de registro: ');
define('TEXT_INFO_GROUP', 'Grupo: ');
define('TEXT_INFO_ERROR', 'Esa dirección de e-mail ya está siendo utilizada.<br>Por favor inténtalo de nuevo.');

define('JS_ALERT_USERNAME', '- Obligatorio: Nombre de usuario \n');
define('JS_ALERT_FIRSTNAME', '- Obligatorio: Nombre \n');
define('JS_ALERT_LASTNAME', '- Obligatorio: Apellidos \n');
define('JS_ALERT_EMAIL', '- Obligatorio: Dirección e-mail \n');
define('JS_ALERT_EMAIL_FORMAT', '- ¡El formato de la dirección e-mail no es válido! \n');
define('JS_ALERT_EMAIL_USED', '- ¡Dirección e-mail ya está siendo utilizada! \n');
define('JS_ALERT_LEVEL', '- Obligatorio: Grupo \n');

define('ADMIN_EMAIL_SUBJECT', 'Nuevo miembro de administración');
define('ADMIN_EMAIL_TEXT', 'Hola %s,' . "\n\n" . 'Puedes acceder al Panel de administración con la siguiente contraseña. Una vez que hayas entrado, ¡cambia tu contraseña!' . "\n\n" . 'Sitio web : %s' . "\n" . 'Nombre de usuario: %s' . "\n" . 'Contraseña: %s' . "\n\n" . '¡Gracias!' . "\n" . '%s' . "\n\n" . 'Esto es un mensaje automatizado, por favor no contestes.');
define('ADMIN_EMAIL_EDIT_SUBJECT', 'Perfil de miembro de administración modificado');
define('ADMIN_EMAIL_EDIT_TEXT', 'Hola %s,' . "\n\n" . 'Tus datos personales han sido modificados por un administrador.' . "\n\n" . 'Sitio web : %s' . "\n" . 'Nombre de usuario: %s' . "\n" . 'Contraseña: %s' . "\n\n" . '¡Gracias!' . "\n" . '%s' . "\n\n" . 'Esto es un mensaje automatizado, por favor no contestes.');

define('TEXT_INFO_HEADING_DEFAULT_GROUPS', 'Grupo de administración ');
define('TEXT_INFO_HEADING_DELETE_GROUPS', 'Eliminar grupo ');

define('TEXT_INFO_DEFAULT_GROUPS_INTRO', '<b>NOTA:</b><li><b>nuevos permisos:</b> definir/editar el acceso a los ficheros.</li><li><b>modificar:</b> modificar el nombre del grupo.</li><li><b>eliminar:</b> eliminar el grupo.</li>');
define('TEXT_INFO_DELETE_GROUPS_INTRO', 'Esto eliminará también los miembros del grupo. ¿Quieres eliminar el grupo <b>%s</b>?');
define('TEXT_INFO_DELETE_GROUPS_INTRO_NOT', '¡No puedes eliminar este grupo!');
define('TEXT_INFO_GROUPS_INTRO', 'Elige un nombre de grupo único. Pulsa <b>Guardar</b> para crearlo.');
define('TEXT_INFO_EDIT_GROUPS_INTRO', 'Elige un nombre de grupo único. Pulsa <b>Guardar</b> para modificarlo.');

define('TEXT_INFO_HEADING_EDIT_GROUP', 'Grupo de administración');
define('TEXT_INFO_HEADING_GROUPS', 'Nuevo grupo');
define('TEXT_INFO_GROUPS_NAME', ' <b>Nombre de grupo:</b><br>Elige un nombre de grupo único. Pulsa <b>Guardar</b> para crearlo.<br>');
define('TEXT_INFO_GROUPS_NAME_FALSE', '<font color="red"><b>ERROR:</b> ¡El nombre de grupo tiene que tener al menos 5 caracteres!</font>');
define('TEXT_INFO_GROUPS_NAME_USED', '<font color="red"><b>ERROR:</b> ¡El nombre de grupo ya está siendo utilizado!</font>');
define('TEXT_INFO_GROUPS_LEVEL', 'Nivel grupo: ');
define('TEXT_INFO_GROUPS_BOXES', '<b>Permiso de menús:</b><br>Se da acceso a los menús seleccionados.');
define('TEXT_INFO_GROUPS_BOXES_INCLUDE', 'Incluye file guardados en: ');

define('TEXT_INFO_HEADING_DEFINE', 'Definir permisos de grupo');
if ($_GET['gPath'] == 1) {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>No puedes cambiar los permisos para este grupo.<br><br>');
} else {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>Cambia los permisos para este grupo seleccionando o deseleccionando los menús y los ficheros. Pulsa <b>Guardar</b> para guardar los cambios.<br><br>');
}
?>