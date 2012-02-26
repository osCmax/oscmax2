<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('EMAIL_PASS_1', 'Por favor tome nota de su contraseña ');
define('EMAIL_PASS_2', ' que puede modificar cuando acceda a su nueva cuenta.' . "\n\n");

define('NAVBAR_TITLE', 'Crear una cuenta');
define('HEADING_TITLE', 'Datos de cuenta');
define('HEADING_NEW', 'Proceso de pedido');
define('NAVBAR_NEW_TITLE', 'Proceso de pedido');

define('EMAIL_SUBJECT', 'Bienvenido/a a ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Estimado Sr. ' . stripslashes($_POST['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_MS', 'Estimada Sra. ' . stripslashes($_POST['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_NONE', 'Estimado/a ' . stripslashes($_POST['firstname']) . ',' . "\n\n");
define('EMAIL_WELCOME', 'Le damos la bienvenida a <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'A partir de ahora puede disfrutar de los <b>distintos servicios</b> que le ofrecemos. Algunos de estos servicios son:' . "\n\n" . '<li><b>Carrito permanente</b> - Cualquier producto añadido a su carrito permanecerá ahí hasta que lo quite o realice el pedido.' . "\n" . '<li><b>Agenda de direcciones</b> - Podemos enviarle los productos a otras direcciones aparte de la suya. Perfecto para enviar regalos directamente a la persona destinataria.' . "\n" . '<li><b>Historial de pedidos</b> - Vea la relación de pedidos que ha realizado con nosotros.' . "\n" . '<li><b>Comentarios de productos</b> - Comparta su opinión sobre los productos con otros clientes.' . "\n\n");
define('EMAIL_CONTACT', 'Para cualquier consulta sobre nuestros servicios, por favor escriba al propietario: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Nota:</b> Esta dirección fue suministrada por uno de nuestros clientes. Si usted no se ha inscrito como cliente, por favor comuníquelo a ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");
define('TEXT_ACCOUNT_PROBLEM', 'Se ha producido un error al verificar el formulario. Por favor corrija los datos siguiente.');
define('IMAGE_BUTTON_CREATE', 'Crear cuenta');
define('ENTRY_STATE_TEXT', '&nbsp;<span class="errorText">* (Selecciona país primero)</span>');
define('ENTRY_CUSTOMER_GROUP', 'Grupo de cliente');
?>