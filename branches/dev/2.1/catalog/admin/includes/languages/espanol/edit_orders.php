<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Editar pedido nº%s con fecha %s');
define('ADDING_TITLE', 'Añadiendo producto(s) al pedido  #%s');

define('ENTRY_UPDATE_TO_CC', '(Actualizar ' . ORDER_EDITOR_CREDIT_CARD . ' para ver datos de tarjeta de crédito.)');
define('TABLE_HEADING_COMMENTS', 'Comentarios');
define('TABLE_HEADING_STATUS', 'Estado');
define('TABLE_HEADING_NEW_STATUS', 'Nuevo estado');
define('TABLE_HEADING_ACTION', 'Acción');
define('TABLE_HEADING_DELETE', '¿Eliminar?');
define('TABLE_HEADING_QUANTITY', 'Cant.');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Referencia');
define('TABLE_HEADING_PRODUCTS', 'Productos');
define('TABLE_HEADING_TAX', 'Impuestos');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_BASE_PRICE', 'Precio<br>(base)');
define('TABLE_HEADING_UNIT_PRICE', 'Precio<br>(sin imp.)');
define('TABLE_HEADING_UNIT_PRICE_TAXED', 'Precio<br>(imp. incl.)');
define('TABLE_HEADING_TOTAL_PRICE', 'Total<br>(sin imp.)');
define('TABLE_HEADING_TOTAL_PRICE_TAXED', 'Total<br>(imp. incl.)');
define('TABLE_HEADING_OT_TOTALS', 'Totales del pedido:');
define('TABLE_HEADING_OT_VALUES', 'Valor:');
define('TABLE_HEADING_SHIPPING_QUOTES', 'Formas de envío:');
define('TABLE_HEADING_NO_SHIPPING_QUOTES', '¡No hay formas de envío para mostrar!');

define('TABLE_HEADING_CUSTOMER_NOTIFIED', 'Cliente notificado');
define('TABLE_HEADING_DATE_ADDED', 'Fecha añadido');

define('ENTRY_CUSTOMER', 'Cliente');
define('ENTRY_NAME', 'Nombre:');
define('ENTRY_CITY_STATE', 'Población, provincia:');
define('ENTRY_SHIPPING_ADDRESS', 'Dirección de envío');
define('ENTRY_BILLING_ADDRESS', 'Dirección de facturación');
define('ENTRY_PAYMENT_METHOD', 'Forma de pago:');
define('ENTRY_CREDIT_CARD_TYPE', 'Tipo de tarjeta:');
define('ENTRY_CREDIT_CARD_OWNER', 'Titular de la tarjeta:');
define('ENTRY_CREDIT_CARD_NUMBER', 'Número de tarjeta:');
define('ENTRY_CREDIT_CARD_EXPIRES', 'Caducidad tarjeta:');
define('ENTRY_SUB_TOTAL', 'Subtotal:');
define('ENTRY_TYPE_BELOW', 'Escriba a continuación');

//the definition of ENTRY_TAX is important when dealing with certain tax components and scenarios
define('ENTRY_TAX', 'Impuestos');
//do not use a colon (:) in the defintion, ie 'VAT' is ok, but 'VAT:' is not

define('ENTRY_SHIPPING', 'Envío:');
define('ENTRY_TOTAL', 'Total:');
define('ENTRY_STATUS', 'Estado:');
define('ENTRY_NOTIFY_CUSTOMER', 'Notificar al cliente:');
define('ENTRY_NOTIFY_COMMENTS', 'Enviar comentarios:');
define('ENTRY_CURRENCY_TYPE', 'Moneda');
define('ENTRY_CURRENCY_VALUE', 'Valor de moneda');

define('TEXT_INFO_PAYMENT_METHOD', 'Forma de pago:');
define('TEXT_NO_ORDER_PRODUCTS', 'Este pedido no contiene ningún producto');
define('TEXT_ADD_NEW_PRODUCT', 'Añadir productos');
define('TEXT_PACKAGE_WEIGHT_COUNT', 'Peso del paquete: %s  |  Cantidad de productos: %s');

define('TEXT_STEP_1', '<b>Paso 1:</b>');
define('TEXT_STEP_2', '<b>Paso 2:</b>');
define('TEXT_STEP_3', '<b>Paso 3:</b>');
define('TEXT_STEP_4', '<b>Paso 4:</b>');
define('TEXT_SELECT_CATEGORY', '- Selecciona una categoría de la lista -');
define('TEXT_PRODUCT_SEARCH', '<b>- O introduce un término de búsqueda a continuación -</b>');
define('TEXT_ALL_CATEGORIES', 'Todas las categorías/Todos los productos');
define('TEXT_SELECT_PRODUCT', '- Selecciona un producto -');
define('TEXT_BUTTON_SELECT_OPTIONS', 'Selecciona estas opciones');
define('TEXT_BUTTON_SELECT_CATEGORY', 'Selecciona esta categoría');
define('TEXT_BUTTON_SELECT_PRODUCT', 'Selecciona este producto');
define('TEXT_SKIP_NO_OPTIONS', '<em>No hay opciones - Omitido...</em>');
define('TEXT_QUANTITY', 'Cantidad:');
define('TEXT_BUTTON_ADD_PRODUCT', 'Añadir al pedido');
define('TEXT_CLOSE_POPUP', '<u>Cerrar</u> [x]');
define('TEXT_ADD_PRODUCT_INSTRUCTIONS', 'Sigue añadiendo productos hasta que hayas finalizado.<br>Después cierra esta pestaña/ventana, vuelve a la pestaña/ventana principal, y pulsa el botón "Actualizar".');
define('TEXT_PRODUCT_NOT_FOUND', '<b>Producto no encontrado<b>');
define('TEXT_SHIPPING_SAME_AS_BILLING', 'Dirección de envío igual que la de facturación');
define('TEXT_BILLING_SAME_AS_CUSTOMER', 'Dirección de facturación igual que la del cliente');

define('IMAGE_ADD_NEW_OT', 'Inserte un nuevo concepto después de este');
define('IMAGE_REMOVE_NEW_OT', 'Quitar este concepto');
define('IMAGE_NEW_ORDER_EMAIL', 'Enviar por e-mail una nueva confirmación del pedido');

define('TEXT_NO_ORDER_HISTORY', 'No existe el historial del pedido');

define('PLEASE_SELECT', 'Por favor selecciona');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Su pedido ha sido actualizado');
define('EMAIL_TEXT_ORDER_NUMBER', 'Número de pedido:');
define('EMAIL_TEXT_INVOICE_URL', 'Detalles del pedido:');
define('EMAIL_TEXT_DATE_ORDERED', 'Fecha de pedido:');
define('EMAIL_TEXT_STATUS_UPDATE', '¡Muchas gracias por su pedido!' . "\n\n" . 'El estado de su pedido ha sido actualizado.' . "\n\n" . 'Nuevo estado: %s' . "\n\n");
define('EMAIL_TEXT_STATUS_UPDATE2', 'Si tiene cualquier pregunta, por favor responda a este correo.' . "\n\n" . 'Reciba un cordial saludo de sus amigos de ' . STORE_NAME . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Estos son los comentarios sobre su pedido:' . "\n\n%s\n\n");

define('ERROR_ORDER_DOES_NOT_EXIST', 'Error: No existe el pedido %s.');
define('ERROR_NO_ORDER_SELECTED', 'No has seleccionado un pedido para editar, o no se ha establecido la variable ID del pedido.');
define('SUCCESS_ORDER_UPDATED', 'Correcto: El pedido ha sido actualizado correctamente.');
define('SUCCESS_EMAIL_SENT', 'Completado: El pedido ha sido actualizado y se ha enviado un e-mail con la nueva información.');

//the hints
define('HINT_UPDATE_TO_CC', 'Si estableces la forma de pago a ' . ORDER_EDITOR_CREDIT_CARD . ' se mostrarán automáticamente los campos de tarjeta de crédito, que permanecen ocultos mientras esté seleccionado otra forma de pago. El nombre de la forma de pago que hace que al seleccionarse se muestren los campos de tarjeta de crédito se puede configurar en el área de Editor de pedidos de la sección Configuración del Panel de administración.');
define('HINT_UPDATE_CURRENCY', 'Cambiar la moneda hará que se recalculen las tarifas de envío y los totales del pedido.');
define('HINT_SHIPPING_ADDRESS', 'Si cambias la provincia, código postal o país de envío se te dará la opción de recalcular o no los totales y recargar las tarifas de envío.');
define('HINT_TOTALS', 'Puedes otorgar descuentos introduciendo vaores negativos. El subtotal, impuestos y total no son editables. Cuando añadas conceptos vía AJAX asegúrate de introducir primero el nombre o el programa no reconocerá la entrada (es decir, un concepto con un nombre en blanco será eliminado del pedido).');
define('HINT_PRESS_UPDATE', 'Por favor pulsa en "Actualizar" para guardar todos los cambios.');
define('HINT_BASE_PRICE', 'Precio (base) es el precio del producto sin considerar los atributos del producto (es decir, el precio en catálogo)');
define('HINT_PRICE_EXCL', 'Precio (sin imp.) es el precio base más los precios de atributos que puedan existir');
define('HINT_PRICE_INCL', 'Precio (imp. incl.) es Precio (sin imp.) sumándole impuestos');
define('HINT_TOTAL_EXCL', 'Total (sin imp.) es Precio (sin imp.) multiplicado por cant.');
define('HINT_TOTAL_INCL', 'Total (imp. incl.) es Precio (sin imp.) sumándole impuestos y multiplicado por cant.');
//end hints

//new order confirmation email- this is a separate email from order status update
define('ENTRY_SEND_NEW_ORDER_CONFIRMATION', 'Nueva confirmación de pedido:');
define('EMAIL_TEXT_DATE_MODIFIED', 'Fecha modificado:');
define('EMAIL_TEXT_PRODUCTS', 'Productos');
define('EMAIL_TEXT_DELIVERY_ADDRESS', 'Dirección de entrega');
define('EMAIL_TEXT_BILLING_ADDRESS', 'Dirección de facturación');
define('EMAIL_TEXT_PAYMENT_METHOD', 'Forma de pago');
// If you want to include extra payment information, enter text below (use <br> for line breaks):
//define('EMAIL_TEXT_PAYMENT_INFO', ''); //why would this be useful???
// If you want to include footer text, enter text below (use <br> for line breaks):
define('EMAIL_TEXT_FOOTER', '');
//end email

//add-on for downloads
define('ENTRY_DOWNLOAD_COUNT', 'Descargar #');
define('ENTRY_DOWNLOAD_FILENAME', 'Nombre fichero');
define('ENTRY_DOWNLOAD_MAXDAYS', 'Días de validez');
define('ENTRY_DOWNLOAD_MAXCOUNT', 'Descargas restantes');

//add-on for Ajax
define('AJAX_CONFIRM_PRODUCT_DELETE', '¿Estás seguro que quieres quitar este producto del pedido?');
define('AJAX_CONFIRM_COMMENT_DELETE', '¿Estás seguro que quieres eliminar este comentario del historial de estados del pedido?');
define('AJAX_MESSAGE_STACK_SUCCESS', '¡Correcto! \' + %s + \' ha sido actualizado!');
define('AJAX_CONFIRM_RELOAD_TOTALS', 'Has cambiado algún dato de envío. ¿Quieres recalcular los totales del pedido y las tarifas de envío?');
define('AJAX_CANNOT_CREATE_XMLHTTP', 'No se puede crear una instancia XMLHTTP');
define('AJAX_SUBMIT_COMMENT', 'Enviar nuevos comentarios y/o estado');
define('AJAX_NO_QUOTES', 'No hay formas de envío para mostrar.');
define('AJAX_SELECTED_NO_SHIPPING', 'Has seleccionado una forma de envío para este pedido pero parece que no hay ya una almacenada en la base de datos. ¿Te gustaría añadir este gasto de envío al pedido?');
define('AJAX_RELOAD_TOTALS', 'El nuevo concepto de envío ha sido almacenado en la base de datos pero no se han recalculado los totales todavía. Pulsa ok ahora para recalcular los totales del pedido. Si tu conexión es lenta espera a que se carguen todos los datos antes de pulsar ok.');
define('AJAX_NEW_ORDER_EMAIL', '¿Estás seguro que quieres enviar un e-mail de nueva confirmación para este pedido?');
define('AJAX_INPUT_NEW_EMAIL_COMMENTS', 'Introduce los comentarios. Se puede dejar esto en blanco si no quieres incluir ninguno. Por favor recuerda mientras escribas que pulsar la tecla "Enter" provocará el envío del comentario tal como esté. No es posible aún introducir saltos de línea.');
define('AJAX_SUCCESS_EMAIL_SENT', '¡Correcto! Se ha enviado un e-mail de nueva confirmación de pedido a %s');
define('AJAX_WORKING', 'En proceso, por favor espera....');
?>