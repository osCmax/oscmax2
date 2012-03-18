<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Crear una Cuenta');
// PWA BOF
define('NAVBAR_TITLE_PWA', 'Introduzca los datos de facturación y envío');
define('HEADING_TITLE_PWA', 'Datos de facturación y envío');
// PWA EOF

define('HEADING_TITLE', 'Datos de mi cuenta');

define('TEXT_ORIGIN_LOGIN', '<span class="notice"><small><b>NOTA:</b></span></small> Si ya tiene una cuenta, por favor <a href="%s"><u>inicie sesión</u></a>.');

define('EMAIL_ACCOUNT_DETAILS', 'Detalles de la cuenta: ');
define('EMAIL_ACCOUNT_USERNAME', 'Nombre de usuario: ');
define('EMAIL_ACCOUNT_PASSWORD','Contraseña: ');
define('EMAIL_SUBJECT', 'Bienvenido/a a ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Estimado Sr.' . stripslashes($_POST['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_MS', 'Estimada Sra.' . stripslashes($_POST['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_NONE', 'Estimado/a ' . stripslashes($_POST['firstname']) . ',' . "\n\n");
define('EMAIL_WELCOME', 'Le damos la bienvenida a <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'A partir de ahora puede disfrutar de los <b>distintos servicios</b> que le ofrecemos. Algunos de estos servicios son:' . "\n\n" . '<li><b>Carrito permanente</b> - Cualquier producto añadido a su carrito permanecerá ahí hasta que lo quite o realizce el pedido.' . "\n" . '<li><b>Agenda de direcciones</b> - Podemos enviarle los productos a otras direcciones aparte de la suya. Perfecto para enviar regalos directamente a la persona destinataria.' . "\n" . '<li><b>Historial de pedidos</b> - Vea la relación de pedidos que ha realizado con nosotros.' . "\n" . '<li><b>Comentarios de productos</b> - Comparta su opinión sobre los productos con otros clientes.' . "\n\n");
define('EMAIL_CONTACT', 'Para cualquier consulta sobre nuestros servicios, por favor escriba al propietario: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Nota:</b> Esta dirección fue suministrada por uno de nuestros clientes. Si usted no se ha inscrito como cliente, por favor comuníquelo a ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");
// BOF - MOD: CREDIT CLASS Gift Voucher Contribution
define('EMAIL_GV_INCENTIVE_HEADER', "\n\n" .'Como parte de nuestra bienvenida a los nuevos clientes, le obsequiamos con un cheque regalos por valor de %s');
define('EMAIL_GV_REDEEM', 'El código para canjear el cheque regalo es %s, podrá introducir este código cuando realice una compra ');
define('EMAIL_GV_LINK', 'o pulsando en este enlace ');
define('EMAIL_COUPON_INCENTIVE_HEADER', 'Felicidades, para hacer de su primera visita a nuestra tienda online una experiencia más gratificante le obsequiamos con un vale descuento.' . "\n" .
										' Debajo se encuentran los detalles del vale descuento creado solamente para usted' . "\n");
define('EMAIL_COUPON_REDEEM', 'Para usar el vale debe introducir el código %s durante la realización del pedido');
// EOF - MOD: CREDIT CLASS Gift Voucher Contribution
define('TERMS_PART_1','Por favor, confirme que ha leído nuestros');
define('TERMS_PART_2','<u><b>Términos y Condiciones</b></u>');

define('ENTRY_NEWSLETTER_TYPE','Formato de e-mail:');
define('ACCOUNT_PASSWORD', 'Contraseña: ');

?>