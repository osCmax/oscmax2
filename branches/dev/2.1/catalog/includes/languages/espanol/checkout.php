<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
/*
  One Page Checkout, Version: 1.08

  I.T. Web Experts
  http://www.itwebexperts.com

  Copyright (c) 2009 I.T. Web Experts
*/

define('NAVBAR_TITLE', 'Realizar pedido');
define('NAVBAR_TITLE_1', 'Realizar pedido');

define('HEADING_TITLE', 'Realizar pedido');

define('TABLE_HEADING_SHIPPING_ADDRESS', 'Dirección de entrega');
define('TABLE_HEADING_BILLING_ADDRESS', 'Dirección de facturación');

define('TABLE_HEADING_PRODUCTS_MODEL', 'Modelo del producto');
define('TABLE_HEADING_PRODUCTS_NAME', 'Nombre del producto');
define('TABLE_HEADING_PRODUCTS_QTY', 'Cantidad');
define('TABLE_HEADING_PRODUCTS_PRICE', 'Precio ud.');
define('TABLE_HEADING_PRODUCTS_FINAL_PRICE', 'Precio total');
define('TABLE_HEADING_PRODUCTS_REMOVE_ITEM', 'Quitar producto');

define('TABLE_HEADING_PRODUCTS', 'Carrito de la compra');
define('TABLE_HEADING_TAX', 'Impuestos');
define('TABLE_HEADING_TOTAL', 'Total');

define('ENTRY_TELEPHONE', 'Teléfono: ');

define('TEXT_CHOOSE_SHIPPING_DESTINATION', 'Por favor, seleccione la dirección de su agenda de direcciones donde le gustaría recibir el pedido.');
define('TEXT_SELECTED_BILLING_DESTINATION', 'Por favor, seleccionede la dirección de su agenda de direcciones donde le gustaría que le enviáramos la factura.');

define('TITLE_SHIPPING_ADDRESS', 'Dirección de entrega:');
define('TITLE_BILLING_ADDRESS', 'Dirección de facturación:');

define('TABLE_HEADING_SHIPPING_METHOD', 'Forma de envío');
define('TABLE_HEADING_PAYMENT_METHOD', 'Forma de pago');

define('TEXT_CHOOSE_SHIPPING_METHOD', 'Por favor seleccione la forma de envío preferido para este pedido.');
define('TEXT_SELECT_PAYMENT_METHOD', 'Por favor seleccione la forma de pago preferida para este pedido.');

define('TITLE_PLEASE_SELECT', 'Por favor seleccione');

define('TEXT_ENTER_SHIPPING_INFORMATION', 'Actualmente este es la única forma de envío disponible para este pedido.');
define('TEXT_ENTER_PAYMENT_INFORMATION', 'Actualmente este es la única forma de pago disponible para este pedido.');

define('TABLE_HEADING_COMMENTS', 'Puede añadir comentarios sobre su pedido');

define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', 'Continuar con el proceso de compra');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', 'para confirmar este pedido.');

define('TEXT_EDIT', 'Modificar');

define('TEXT_SELECTED_SHIPPING_DESTINATION', 'Esta es la dirección de entrega actualmente seleccionada donde se le enviará el pedido.');
define('TABLE_HEADING_NEW_ADDRESS', 'Nueva dirección');
define('TABLE_HEADING_EDIT_ADDRESS', 'Modificar dirección');
define('TEXT_CREATE_NEW_SHIPPING_ADDRESS', 'Por favor utilice el siguiente formulario para crear una nueva dirección de entrega para este pedido.');
define('TABLE_HEADING_ADDRESS_BOOK_ENTRIES', 'Entradas en la agenda de direcciones');

define('EMAIL_SUBJECT', 'Bienvenido/a a ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Estimado Sr. %s,' . "\n\n");
define('EMAIL_GREET_MS', 'Estimada Sra. %s,' . "\n\n");
define('EMAIL_GREET_NONE', 'Estimado/a %s' . "\n\n");
define('EMAIL_WELCOME', 'Le damos la bienvenida a <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'A partir de ahora puede disfrutar de los <b>distintos servicios</b> que le ofrecemos. Algunos de estos servicios son:' . "\n\n" . '<li><b>Carrito permanente</b> - Cualquier producto añadido a su carrito permanecerá ahí hasta que lo quite o realizce el pedido.' . "\n" . '<li><b>Agenda de direcciones</b> - Podemos enviarle los productos a otras direcciones aparte de la suya. Perfecto para enviar regalos directamente a la persona destinataria.' . "\n" . '<li><b>Historial de pedidos</b> - Vea la relación de pedidos que ha realizado con nosotros.' . "\n" . '<li><b>Comentarios de productos</b> - Comparta su opinión sobre los productos con otros clientes.' . "\n\n");
define('EMAIL_CONTACT', 'Para cualquier consulta sobre nuestros servicios, por favor escriba al propietario: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Nota:</b> Esta dirección fue suministrada por uno de nuestros clientes. Si usted no se ha inscrito como cliente, por favor comuníquelo a ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");

// Start - CREDIT CLASS Gift Voucher Contribution
define('EMAIL_GV_INCENTIVE_HEADER', "\n\n" .'Como parte de nuestra bienvenida a los nuevos clientes, le obsequiamos con un cheque regalos por valor de %s');
define('EMAIL_GV_REDEEM', 'El código para canjear el cheque regalo es %s, podrá introducir este código cuando realice una compra ');
define('EMAIL_GV_LINK', 'o pulsando en este enlace ');
define('EMAIL_COUPON_INCENTIVE_HEADER', 'Felicidades, para hacer de su primera visita a nuestra tienda online una experiencia más gratificante le obsequiamos con un vale descuento.' . "\n" .
										' Debajo se encuentran los detalles del vale descuento creado solamente para usted' . "\n");
define('EMAIL_COUPON_REDEEM', 'Para usar el vale debe introducir el código %s durante la realización del pedido');
// End - CREDIT CLASS Gift Voucher Contribution

define('TEXT_AGREE_TO_TERMS', 'Acepto los Términos y Condiciones');

define('WINDOW_BUTTON_CANCEL', 'Cancelar');
define('WINDOW_BUTTON_CONTINUE', 'Continuar');
define('WINDOW_BUTTON_NEW_ADDRESS', 'Nueva dirección');
define('WINDOW_BUTTON_EDIT_ADDRESS', 'Modificar dirección');

define('TEXT_PLEASE_SELECT', 'Por favor seleccione');
define('TEXT_PASSWORD_FORGOTTEN', 'Olvidó su contraseña? Pulse aquí.');
define('IMAGE_UPDATE_CART', 'Actualizar carrito');
define('IMAGE_LOGIN', 'Inicio de sesión');
define('TEXT_PAYMENT_METHOD_UPDATE_ERROR', 'Por favor inténtelo de nuevo y si continúan los problemas, por favor pruebe con otra forma de pago.');
define('TEXT_HAVE_COUPON_CCGV', '¿Dispone de algún vale descuento/cheque regalo?');
define('TEXT_HAVE_COUPON_KGT', '¿Dispone de algún vale descuento/cheque regalo?');
define('TEXT_EXISTING_CUSTOMER_LOGIN', 'Ya dispone de una cuenta?');
define('TEXT_DIFFERENT_SHIPPING', 'Es diferente de la dirección de facturación?');
define('TEXT_SHIPPING_NO_ADDRESS', 'Por favor rellene <b>al menos</b> la dirección de facturación para ver los gastos de envío.');
define('TEXT_CHECKOUT_UPDATE_VIEW_ORDER', 'para actualizar/ver su pedido.');
define('CHECKOUT_BAR_CONFIRMATION', 'confirmación');
// Points/Rewards Module V2.1rc2a BOF
define('TABLE_HEADING_REDEEM_SYSTEM', 'Canjear puntos ');
define('TABLE_HEADING_REFERRAL', 'Programa de referencias');
define('TEXT_REDEEM_SYSTEM_START', 'Tiene un saldo de %s, le gustaría utilizarlo para el pago en este pedido?<br />El total estimado de la compra es: %s .');
define('TEXT_REDEEM_SYSTEM_SPENDING', 'Marque aquí para utilizar el máximo de puntos permitido para este pedido. (%s puntos %s)&nbsp;&nbsp;->');
define('TEXT_REDEEM_SYSTEM_NOTE', '<span class="pointWarning">El importe total de la compra es superior al máximo de puntos permitodo, también necesitará seleccionar una forma de pago</span>');
define('TEXT_REFERRAL_REFERRED', 'Si un amigo le ha hablado de nosotros por favor indique aquí su dirección de email. ');
// Points/Rewards Module V2.1rc2a EOF
define('TERMS_PART_1', 'Por favor confirme que ha leído nuestros ');
define('TERMS_PART_2', '<b><u>Términos y Condiciones</u></b>');

define('TEXT_NO_JAVASCRIPT', 'Hemos detectado que Javascript está deshabilitado en su navegador.');
define('TEXT_ENABLE_JAVSCRIPT_INSTRUCTIONS', '<p style="font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold">Por favor siga las instrucciones para su navegador para completar su pedido:<br /><br />Internet Explorer</p>
 <ol style="font-family: Arial, Helvetica, sans-serif; font-size:12px;">
  <li>En el menú&nbsp;<strong>Herramientas</strong>, pulse&nbsp;<strong>Opciones de Internet</strong>, y después pulse la pestaña&nbsp;<strong>Seguridad</strong>.</li>
  <li>Pulse en la zona de&nbsp;<strong>Internet</strong>.</li>
  <li>Si no tiene que personalizar la configuración de seguridad de Internet, pulse&nbsp;<strong>Nivel predeterminado</strong>. Después siga el paso 4<blockquote>Si tiene que personalizar su configuración de seguridad de Internet, siga estos pasos:<br />
	a. Pulse&nbsp;<strong>Nivel personalizado...</strong>.<br />
	b. En el cuadro de diálogo de&nbsp;<strong>Configuración de seguridad &ndash; zona de Internet</strong>, pulse&nbsp;<strong>Habilitar</strong>&nbsp;en&nbsp;<strong>Active scripting</strong>&nbsp;en la sección de&nbsp;<strong>Automatización</strong>.</blockquote></li>
  <li>Pulse el botón&nbsp;<strong>Aceptar</strong>&nbsp;para volver a la página anterior, y entonces pulse el botón&nbsp;<strong>Actualizar</strong>&nbsp;para ejecutar scripts.</li>
 </ol>
 <p style="font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold"><br />Firefox</p>
 <ol style="font-family: Arial, Helvetica, sans-serif; font-size:12px;">
  <li>En el menú&nbsp;<strong>Herramientas</strong>, pulse&nbsp;<strong>Opciones</strong>.</li>
  <li>En la pestaña&nbsp;<strong>Contenido</strong>, pulse en la casilla de &nbsp;<strong>Activar JavaScript</strong>&nbsp;para habilitarlo.</li>
  <li>Pulse el botón&nbsp;<strong>Aceptar</strong>&nbsp;para volver a la página anterior, y entonces pulsa el botón&nbsp;<strong>Recargar esta página</strong>&nbsp;para ejecutar scripts.</li>
 </ol>
 <p style="font-family: Arial, Helvetica, sans-serif; font-size:12px; font-weight:bold"><br />Safari</p>
 <ol style="font-family: Arial, Helvetica, sans-serif; font-size:12px;">
  <li>Pulsa el menú <strong>Safari</strong>.</li>
  <li>Selecciona <strong>Preferencias</strong>.</li>
  <li>Pulsa la pestaña <strong>Seguridad</strong>.</li>
  <li>Selecciona la casilla <stong>Activar JavaScript</stong>.</li>
 </ol>
 <p>&nbsp;</p>');
 
 define('TEXT_CHECKOUT_CREATE_ACCOUNT', 'Si desea crear una cuenta, por favor introduzca una contraseña a continuación: ');
?>