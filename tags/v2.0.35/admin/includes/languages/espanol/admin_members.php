<?php
/*
$Id: admin_members.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2009 osCMax

  Released under the GNU General Public License
*/

if ($HTTP_GET_VARS['gID']) {
  define('HEADING_TITLE', 'Grupos de Admin');
} elseif ($HTTP_GET_VARS['gPath']) {
  define('HEADING_TITLE', 'Definicion Grupos');
} else {
  define('HEADING_TITLE', 'Miembros de Admin');
}

define('TEXT_COUNT_GROUPS', 'Grupos: ');

define('TABLE_HEADING_USERNAME', 'Nombre de usuario');
define('TABLE_HEADING_NAME', 'Nombre completo');
define('TABLE_HEADING_EMAIL', 'Email');
define('TABLE_HEADING_PASSWORD', 'Password');
define('TABLE_HEADING_CONFIRM', 'Confirma Password');
define('TABLE_HEADING_GROUPS', 'Nivel Grupos');
define('TABLE_HEADING_CREATED', 'Cuenta Creada');
define('TABLE_HEADING_MODIFIED', 'Cuenta Creada');
define('TABLE_HEADING_LOGDATE', 'Ultimo Acceso');
define('TABLE_HEADING_LOGNUM', 'LogNum');
define('TABLE_HEADING_LOG_NUM', 'Log Numero');
define('TABLE_HEADING_ACTION', 'Actión');

define('TABLE_HEADING_GROUPS_NAME', 'Nombre Grupos');
define('TABLE_HEADING_GROUPS_DEFINE', 'Selecció Boxes y Files');
define('TABLE_HEADING_GROUPS_GROUP', 'Nivel');
define('TABLE_HEADING_GROUPS_CATEGORIES', 'Permisos Categorias');


define('TEXT_INFO_HEADING_DEFAULT', 'Miembros de Admin ');
define('TEXT_INFO_HEADING_DELETE', 'Cancelar Permiso ');
define('TEXT_INFO_HEADING_EDIT', 'Cambia Categoria / ');
define('TEXT_INFO_HEADING_NEW', 'Nuevo Miembro Admin ');

define('TEXT_INFO_DEFAULT_INTRO', 'grupo Miembro');
define('TEXT_INFO_DELETE_INTRO', 'Remover <nobr><b>%s</b></nobr> desde <nobr>Miembros de Admin?</nobr>');
define('TEXT_INFO_DELETE_INTRO_NOT', 'No puedes eliminar el <nobr>grupo %s!</nobr>');
define('TEXT_INFO_EDIT_INTRO', 'Configura nivel de permiso aqui: ');

define('TEXT_INFO_USERNAME', 'Nombre de usuario: ');
define('TEXT_INFO_FULLNAME', 'Nombre completo: ');
define('TEXT_INFO_FIRSTNAME', 'Nombre: ');
define('TEXT_INFO_LASTNAME', 'Apellido: ');
define('TEXT_INFO_EMAIL', 'Email: ');
define('TEXT_INFO_PASSWORD', 'Password: ');
define('TEXT_INFO_CONFIRM', 'Confirma Password: ');
define('TEXT_INFO_CREATED', 'Cuenta Creada: ');
define('TEXT_INFO_MODIFIED', 'Cuenta Modificada: ');
define('TEXT_INFO_LOGDATE', 'Ultimo Acceso: ');
define('TEXT_INFO_LOGNUM', 'Log Numero: ');
define('TEXT_INFO_GROUP', 'Nivel Grupo: ');
define('TEXT_INFO_ERROR', '<font color="red">Direccion Email ya utilizado!</font>');

define('JS_ALERT_USERNAME', '- Obligatorio: Nombre de usuario \n');
define('JS_ALERT_FIRSTNAME', '- Obligatorio: Nombre \n');
define('JS_ALERT_LASTNAME', '- Obligatorio: Apellido \n');
define('JS_ALERT_EMAIL', '- Obligatorio: Dirección Email \n');
define('JS_ALERT_EMAIL_FORMAT', '- Formado Email invalido! \n');
define('JS_ALERT_EMAIL_USED', '- Direccion Email ya utilizado! \n');
define('JS_ALERT_LEVEL', '- Obligatorio: Miembro Grupo \n');

define('ADMIN_EMAIL_SUBJECT', 'Nuevo  Miembro Admin');
define('ADMIN_EMAIL_TEXT', 'Hola %s,' . "\n\n" . 'Puedes entrar en el Panel de administracion con la siguiente password. Apenas entrado, cambia tu password!' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Password: %s' . "\n\n" . 'Gracias!' . "\n" . '%s' . "\n\n" . 'Esto es un mail automatico, entonces no respondes!');
define('ADMIN_EMAIL_EDIT_SUBJECT', 'Edita Profilo Miembro Admin');
define('ADMIN_EMAIL_EDIT_TEXT', 'Hola %s,' . "\n\n" . 'Tus datos personales han sido modificados por el administrador.' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Password: %s' . "\n\n" . 'Gracias!' . "\n" . '%s' . "\n\n" . 'Esto es un mail automatico, entonces no respondes!');

define('TEXT_INFO_HEADING_DEFAULT_GROUPS', 'Grupo Admin ');
define('TEXT_INFO_HEADING_DELETE_GROUPS', 'Eliminar Grupo ');

define('TEXT_INFO_DEFAULT_GROUPS_INTRO', '<b>NOTA:</b><li><b>edita:</b> edita nombre grupo.</li><li><b>eliminar:</b> elimina grupo.</li><li><b>definir:</b> para definir acceso grupo.</li>');
define('TEXT_INFO_DELETE_GROUPS_INTRO', 'Esto elimina tambien los miembros del grupo. Quieres eliminar el <nobr>grupo <b>%s</b>?</nobr>');
define('TEXT_INFO_DELETE_GROUPS_INTRO_NOT', 'No puedes eliminar estos grupos!');
define('TEXT_INFO_GROUPS_INTRO', 'Elijes un nombre de grupo univoco. Click <b>sigue</b> para enviar.');
define('TEXT_INFO_EDIT_GROUPS_INTRO', 'Elijes un nombre de grupo univoco. Click <b>sigue</b> para enviar.');

define('TEXT_INFO_HEADING_EDIT_GROUP', 'Grupo Admin');
define('TEXT_INFO_HEADING_GROUPS', 'Nuevo Grupo');
define('TEXT_INFO_GROUPS_NAME', ' <b>Nombre Grupo:</b><br>Elijes un nombre de grupo univoco. Pues, click <b>sigue</b> para enviar.<br>');
define('TEXT_INFO_GROUPS_NAME_FALSE', '<font color="red"><b>ERROR:</b> El nombre de grupo tienes que ser mas largo que 5 caracteros!</font>');
define('TEXT_INFO_GROUPS_NAME_USED', '<font color="red"><b>ERROR:</b> Nombre Grupo ya utilizado!</font>');
define('TEXT_INFO_GROUPS_LEVEL', 'Nivel Grupo: ');
define('TEXT_INFO_GROUPS_BOXES', '<b>Permiso  Boxes:</b><br>Das acceso al box seleccionado.');
define('TEXT_INFO_GROUPS_BOXES_INCLUDE', 'Incluye file guardados en: ');

define('TEXT_INFO_HEADING_DEFINE', 'Definir Grupo');
if ($HTTP_GET_VARS['gPath'] == 1) {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>No puedes cambiar los Permisos a los File por este grupo.<br><br>');
} else {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>Cambia permiso a este grupo seleccionando o deseleccionando los boxes y los files. Click <b>grabar</b> para guardar cambios.<br><br>');
}
?>