<?php
/*
$Id$
  Recover Cart Sales v2.22 ENGLISH Language File

  Recover Cart Sales contrib: JM Ivler (c)
  osCmax e-Commerce
  http://www.oscmax.com

  Released under the GNU General Public License

  Modifed by Aalst (recover_cart_sales.php,v 1.2 .. 1.36)
  aalst@aalst.com
  
  Modifed by willross (recover_cart_sales.php,v 1.4)
  reply@qwest.net
  - don't forget to flush the 'scart' db table every so often

  Modifed by Lane (stats_recover_cart_sales.php,v 1.4d .. 2.22)
  lane@ifd.com www.osc-modsquad.com / www.ifd.com
*/

define('MESSAGE_STACK_CUSTOMER_ID', 'Carrito de Cliente-ID ');
define('MESSAGE_STACK_DELETE_SUCCESS', ' borrado Satisfactoriamente');
define('HEADING_TITLE', 'recuperar carritos olvidados');
define('HEADING_EMAIL_SENT', 'E-mail reportes');
define('EMAIL_TEXT_LOGIN', 'Login en tu cuenta aqui:');
define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Aviso desde '.  STORE_NAME );
define('EMAIL_TEXT_SALUTATION', 'Hola ' );
define('EMAIL_TEXT_NEWCUST_INTRO', "\n\n" . 'Gracias por visitar ' . STORE_NAME .
                                   ' y considerarnos para tus compras. ');
define('EMAIL_TEXT_CURCUST_INTRO', "\n\n" . 'Queremos darte las gracias por haber llenado tu carrito en ' .
                                   STORE_NAME . ' hacer unos dias. ');
define('EMAIL_TEXT_BODY_HEADER',
	'Hemos detectado que durante tu ultima visita en nuestra tienda te dejaste ' .
	'los siguientes productos en tu carrito de la compra, pero por alguna razon ' .
	'no pudiste finalizar el pedido.' . "\n\n" .
	'Contenido de tu carrito:' . "\n\n"
	);
	
define('EMAIL_TEXT_BODY_FOOTER',
	'Estamos interesados ademas en saber la posible razón o error que te condujo a no poder finalizar la compra ' .
	
	'Por favor retorna a la tienda para poder finalizar la compra.'."\n\n".

	'De nuevo, te damos las gracias por tu tiempo y consideración en hacernos mejorar ' .
	' ' . STORE_NAME .  " .\n\n Atentamente,\n\n"
	);

define('DAYS_FIELD_PREFIX', 'Enseñar para los últimos ');
define('DAYS_FIELD_POSTFIX', ' dias ');
define('DAYS_FIELD_BUTTON', 'Go');
define('TABLE_HEADING_DATE', 'FECHA');
define('TABLE_HEADING_CONTACT', 'CONTACTADO');
define('TABLE_HEADING_CUSTOMER', 'NOMBRE CLIENTE');
define('TABLE_HEADING_EMAIL', 'E-MAIL');
define('TABLE_HEADING_PHONE', 'TELEFONO');
define('TABLE_HEADING_MODEL', 'PRODUCTO');
define('TABLE_HEADING_DESCRIPTION', 'DESCRIPCION');
define('TABLE_HEADING_QUANTY', 'NUM');
define('TABLE_HEADING_PRICE', 'PRECIO');
define('TABLE_HEADING_TOTAL', 'TOTAL');
define('TABLE_GRAND_TOTAL', 'Gran Total: ');
define('TABLE_CART_TOTAL', 'Carrito Total: ');
define('TEXT_CURRENT_CUSTOMER', 'CLIENTE');
define('TEXT_SEND_EMAIL', 'Enviar E-mail');
define('TEXT_RETURN', '[Clic aqui para volver]');
define('TEXT_NOT_CONTACTED', 'NO Avisado!!');
define('PSMSG', 'Mensaje adicional a enviar: ');
?>