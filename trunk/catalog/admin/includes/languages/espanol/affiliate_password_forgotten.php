<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Inicio de sesión');
define('NAVBAR_TITLE_2', '¿Ha olvidado la contraseña?');
define('HEADING_TITLE', '¿Cuál era mi contraseña?');
define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<font color="#ff0000"><b>ATENCIÓN:</b></font> La dirección e-mail que ha introducido no está en nuestros archivos. Por favor inténtelo de nuevo.');
define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Nueva contraseña de afiliado');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Tnemos una petición de nueva contraseña desde ' . $REMOTE_ADDR . ' para su cuenta de afiliado.' . "\n\n" . 'Su nueva contraseña para su cuenta de afiliado en \'' . STORE_NAME . '\' es:' . "\n\n" . '   %s' . "\n\n");
define('TEXT_PASSWORD_SENT', 'Se ha enviado una nueva contraseña a su dirección e-mail que consta en nuestro archivos.');
?>