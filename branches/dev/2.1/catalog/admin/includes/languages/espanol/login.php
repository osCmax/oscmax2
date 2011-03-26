<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('TEXT_CREATE_FIRST_ADMINISTRATOR', 'No existen administradores en la base de datos. Por favor introduce a continuación los datos para crear el primer administrador. (Después de este paso todavía es necesario un inicio de sesión manual)');

define('ERROR_INVALID_ADMINISTRATOR', 'Error: Intento no válido de inicio de sesión.');

define('BUTTON_LOGIN', 'Inicio de sesión');
define('BUTTON_CREATE_ADMINISTRATOR', 'Crear administrador');
define('NAVBAR_TITLE', 'Inicio de sesión');
define('HEADING_TITLE', 'Inicio de sesión de administración');
define('TEXT_STEP_BY_STEP', ''); // should be empty
define('HEADING_RETURNING_ADMIN', 'Panel de inicio de sesión:');
define('HEADING_PASSWORD_FORGOTTEN', 'Contraseña olvidada:');
define('TEXT_RETURNING_ADMIN', '¡Sólo personal de la tienda!');
define('ENTRY_USERNAME', 'Nombre de usuario:');
define('ENTRY_FIRSTNAME', 'Nombre:');
define('ENTRY_LASTNAME', 'Apellidos:');

define('TEXT_PASSWORD_FORGOTTEN', '¿Has olvidado la contraseña?');

define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>ERROR:</b></font> Nombre de usuario o contraseña equivocados');
define('TEXT_FORGOTTEN_ERROR', '<font color="#ff0000"><b>ERROR:</b></font> ¡El nombre y la contraseña no coinciden!');
define('TEXT_FORGOTTEN_FAIL', 'Se han realizado más de 3 intentos. Por razones de seguridad ponte en contacto con tu administrador web para obtener una nueva contraseña.<br>&nbsp;<br>&nbsp;');
define('TEXT_FORGOTTEN_SUCCESS', 'Se ha enviado tu nueva contraseña a tu correo electrónico. Comprueba tu e-mail y pulsa Volver para iniciar sesión.<br>&nbsp;<br>&nbsp;');

define('ADMIN_EMAIL_SUBJECT', 'Nueva contraseña');
define('ADMIN_EMAIL_TEXT', 'Hola %s,' . "\n\n" . 'Puedes acceder al panel de administración con la siguiente contraseña. Una vez que hayas accedido, ¡por favor cambia la contraseña!' . "\n\n" . 'Sitio web : %s' . "\n" . 'Nombre de usuario: %s' . "\n" . 'Contraseña: %s' . "\n\n" . '¡Gracias!' . "\n" . '%s' . "\n\n" . 'Esto es un mail automático, ¡por favor no respondas!');

define('IMAGE_BUTTON_LOGIN', 'Inicio de sesión');
?>