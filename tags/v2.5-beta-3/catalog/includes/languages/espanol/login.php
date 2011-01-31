<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Entrar');
define('HEADING_TITLE', 'Dejame Entrar!');

define('HEADING_NEW_CUSTOMER', 'Nuevo Cliente');
define('TEXT_NEW_CUSTOMER', 'Soy un nuevo cliente.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'Al crear una cuenta en ' . STORE_NAME . ' podrá realizar sus compras rápidamente, revisar el estado de sus pedidos y consultar sus operaciones anteriores.');

define('HEADING_RETURNING_CUSTOMER', 'Ya Soy Cliente');
define('TEXT_RETURNING_CUSTOMER', 'He comprado otras veces.');

define('TEXT_PASSWORD_FORGOTTEN', '¿Ha olvidado su contraseña? Siga este enlace y se la enviamos.');

define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>ERROR:</b></font> El \'E-Mail\' y/o \'Contraseña\' no figuran en nuestros datos.');
define('TEXT_VISITORS_CART', '<font color="#ff0000"><b>NOTA:</b></font> El contenido de su &quot;Cesta de Visitante&quot; será añadido a su &quot;Cesta de Asociado&quot; una vez que haya entrado. <a href="javascript:session_win();">[Más información]</a>');

// BOF: MOD - Checkout Without Account v0.70 changes
define('PWA_FAIL_ACCOUNT_EXISTS', 'Una cuenta ya existe para la dirección correo electrónico <i>{EMAIL_ADDRESS}</i>.  Usted debe la entrada aquí con la contraseña para esa cuenta antes avanzar para comprobar.');
define('HEADING_CHECKOUT', '<font size="2">Avance para Comprobar Directamente</font>');
define('TEXT_CHECKOUT_INTRODUCTION', 'Avance para Comprobar sin crear una cuenta. Escogiendo esta opción ninguna de su información de usuario se mantendrá en nuestros registros, y en usted no será capaz de revisar su posición de la orden, ni seguir sus órdenes previas.');
define('PROCEED_TO_CHECKOUT', 'Avance para Comprobar sin Registrar');
// EOF: MOD - Checkout Without Account changes

// LINE ADDED: MOD - Separate Pricing Per Customer
// define the email address that can change customer_group_id on login
define('SPPC_TOGGLE_LOGIN_PASSWORD', 'root@localhost');
define('TEXT_GUEST_INTRODUCTION','<b>¿Quieres ir directamente al proceso de pago?</b> <br><br> ¿Te gustaría ver a cabo sin la creación de una cuenta de cliente? Tenga en cuenta que todos nuestros servicios no estarán disponibles para los clientes que no desean crear una cuenta. Además, usted no puede ver el estado de su pedido, y cada vez que usted compra con nosotros usted tendrá que volver a introducir todos sus datos. <br><br> Creación de una cuenta es gratis. Si usted todavía desea seguir a la caja por favor haga clic en el botón de pago y envío de la derecha.');

define('TEXT_GV_LOGIN_NEEDED', 'Tienes que estar logueado para canjear su bono. Por favor, cree una nueva cuenta o ingresa abajo');

?>