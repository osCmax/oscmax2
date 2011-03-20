<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Cuenta de administrador');

define('TABLE_HEADING_ACCOUNT', 'Mi cuenta');

define('TEXT_INFO_FULLNAME', '<b>Nombre completo: </b>');
define('TEXT_INFO_USERNAME', '<b>Nombre de usuario: </b>');
define('TEXT_INFO_FIRSTNAME', '<b>Nombre: </b>');
define('TEXT_INFO_LASTNAME', '<b>Apellidos: </b>');
define('TEXT_INFO_EMAIL', '<b>Dirección e-mail: </b>');
define('TEXT_INFO_PASSWORD', '<b>Contraseña: </b>');
define('TEXT_INFO_PASSWORD_HIDDEN', '-Oculto-');
define('TEXT_INFO_PASSWORD_CONFIRM', '<b>Confirmar contraseña: </b>');
define('TEXT_INFO_CREATED', '<b>Cuenta creada: </b>');
define('TEXT_INFO_LOGDATE', '<b>Último acceso: </b>');
define('TEXT_INFO_LOGNUM', '<b>Número de registro: </b>');
define('TEXT_INFO_GROUP', '<b>Nivel de grupo: </b>');
define('TEXT_INFO_ERROR', '¡Esa dirección de e-mail ya está siendo utilizada! Por favor inténtalo de nuevo.');
define('TEXT_INFO_MODIFIED', 'Modificado: ');

define('TEXT_INFO_HEADING_DEFAULT', 'Modificar cuenta ');
define('TEXT_INFO_HEADING_CONFIRM_PASSWORD', 'Confirmación de contraseña ');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD', 'Contraseña:');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR', 'Contraseña incorrecta');
define('TEXT_INFO_INTRO_DEFAULT', 'Pulsa <b>Editar</b> para hacer cambios en tu cuenta.');
define('TEXT_INFO_INTRO_DEFAULT_FIRST_TIME', '<b>%s</b>, hemos detectado que no has cambiado tu contraseña desde la instalación. Te recomendamos cambiar la contraseña ahora.');
define('TEXT_INFO_INTRO_DEFAULT_FIRST', '<br><b>AVISO:</b><br>Hello <b>%s</b>, ¡te recomendamos que cambies tu e-mail (<font color="red">admin@localhost</font>) y tu contraseña!');
define('TEXT_INFO_INTRO_EDIT_PROCESS', 'Todos los campos son obligatorios. Pulsa guardar para grabarlos.');

define('JS_ALERT_USERNAME',         '- Obligatorio: Nombre de usuario \n');
define('JS_ALERT_FIRSTNAME',        '- Obligatorio: Nombre \n');
define('JS_ALERT_LASTNAME',         '- Obligatorio: Apellidos \n');
define('JS_ALERT_EMAIL',            '- Obligatorio: Dirección e-mail \n');
define('JS_ALERT_PASSWORD',         '- Obligatorio: Contraseña \n');
define('JS_ALERT_USERNAME_LENGTH',  '- Nombre de usuario debe ser más largo que ');
define('JS_ALERT_FIRSTNAME_LENGTH', '- Nombre debe ser más largo que ');
define('JS_ALERT_LASTNAME_LENGTH',  '- Apellidos debe ser más largo que ');
define('JS_ALERT_PASSWORD_LENGTH',  '- Password debe ser más largo que ');
define('JS_ALERT_EMAIL_FORMAT',     '- ¡Dirección e-mail no válido! \n');
define('JS_ALERT_EMAIL_USED',       '- ¡Dirección e-mail ya está siendo utilizada! \n');
define('JS_ALERT_PASSWORD_CONFIRM', '- ¡Confirma tu Contraseña! \n');

define('ADMIN_EMAIL_SUBJECT', 'Cambios en los datos personales');
define('ADMIN_EMAIL_TEXT', 'Hola %s,' . "\n\n" . 'Tus datos personales, tal vez incluso tu contraseña, han sido modificados. Si esto se ha hecho sin tu conocimiento o consentimiento, por favor ponte en contacto con el administrador inmediatamente.' . "\n\n" . 'Sitio web : %s' . "\n" . 'Nombre de usuario: %s' . "\n" . 'Contraseña: %s' . "\n\n" . '¡Gracias!' . "\n" . '%s' . "\n\n" . 'Esto es un mensaje automatizado, por favor no contestes.');
?>