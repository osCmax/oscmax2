<?php
/*
$Id: password_forgotten.php 1268 2011-03-20 14:59:02Z cottonbarn $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Iniciar sesión');
define('NAVBAR_TITLE_2', 'Contraseña olvidada');

define('HEADING_TITLE', 'He olvidado mi contraseña');

define('TEXT_MAIN', 'Si ha olvidado su contraseña, introduzca su dirección de e-mail y le enviaremos un mensaje por e-mail con una contraseña nueva.');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', 'Error: Ese e-mail no figura en nuestros datos, inténtelo de nuevo.');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - Nueva contraseña');
define('EMAIL_PASSWORD_REMINDER_BODY', 'Se ha solicitado una nueva contraseña desde ' . isset($REMOTE_ADDR) . '.' . "\n\n" . 'Su nueva contraseña para \'' . STORE_NAME . '\' es:' . "\n\n" . '   %s' . "\n\n");

define('SUCCESS_PASSWORD_SENT', 'Éxito: Se le ha enviado una nueva contraseña a su e-mail');
?>
