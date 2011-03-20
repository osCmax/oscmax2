<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
define('TEXT_ORDER_NUMBERS_RANGES', 'Número de pedido(s), puede introducir uno # o un rango, # - #, ó #,#,#');
define('TEXT_DIR_ERROR', ' Error: Problema abriendo directorio ');
define('TEXT_BPC_OPTIONS', 'Opciones del centro de impresión por lotes');
define('TEXT_BPC_NO_OPTIONS', 'No hay opciones disponibles para la opción seleccionada.');
define('HEADING_TITLE', 'Centro de impresión por lotes');
define('TABLE_HEADING_COMMENTS', 'Comentarios');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Referencia');
define('TABLE_HEADING_PRODUCTS', 'Artículos');
define('TABLE_HEADING_TAX', 'Impuestos(%)');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Precio (sin imp.)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Precio (imp. incl.)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Total (sin imp.)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Total (imp. incl.)');
define('ENTRY_SOLD_TO', 'Dirección de facturación:');
define('ENTRY_SHIP_TO', 'Dirección de envío:');
define('ENTRY_PAYMENT_METHOD', 'Forma de pago:');
define('ENTRY_PAYMENT_TYPE', 'Tarjeta de crédito:');
define('PAYMENT_TYPE', 'Tarjeta de crédito');
define('ENTRY_CC_OWNER', 'Titular de la tarjeta:');
define('ENTRY_CC_NUMBER', 'Número de tarjeta:');
define('ENTRY_CC_EXP', 'Fecha de caducidad:');
define('ENTRY_SUB_TOTAL', 'Subtotal:');
define('ENTRY_PHONE', 'Teléfono:');
define('ENTRY_EMAIL', 'E-mail:');
define('ENTRY_TAX', 'Impuestos:');
define('ENTRY_SHIPPING', 'Gastos de envío:');
define('ENTRY_TOTAL', 'Total:');
define('TEXT_ORDER_NUMBER','Número de pedido:');
define('TEXT_ORDER_DATE','Fecha de pedido:');
define('TEXT_ORDER_FORMAT','F j, Y');
define('TEXT_CHOOSE_TEMPLATE','Seleccione la plantilla para imprimir');
define('TEXT_CHOOSE_TEMPLATE','Por favor introduce los números o rango de números de pedidos que quieres imprimir en un fichero PDF:<br>(p.ej.: 2577,2580-2585,2588)');
define('TEXT_DATES_ORDERS_EXTRACTRED','<b>O</b> introduce las fechas de pedidos que quieres imprimir en un fichero PDF:<br>(las fechas debe tener un formato AAAA-MM-DD) Si ambas se dejan en blanco se mostrarán TODAS (límite: 500)');
define('TEXT_FROM','Desde:');
define('TEXT_TO','hasta: ');
define('TEXT_PRINTING_LABELS_BILLING_DELIVERY','Al imprimir etiquetas : ¿Usar dirección de facturación o de entrega?');
define('TEXT_DELIVERY','Entrega: ');
define('TEXT_BILLING','Facturación: ');
define('TEXT_POSITION_START_PRINTING', 'Posición inicial para la impresión:<br>(Posición 0 es arriba a la izquierda de la etiqueta, se incrementa de izquierda a derecha y de arriba a abajo)');
define('TEXT_INCLUDE_ORDERS_STATUS', 'Incluir solamente pedidos con estado:<br>(si se selecciona Ninguno, se incluirán todos los pedidos)');
define('TEXT_SHOW_ORDER','¿Mostrar fecha de pedido?');
define('TEXT_SHOW_PHONE_NUMBER','¿Mostrar teléfono del cliente?');
define('TEXT_SHOW_EMAIL_CUSTOMER','¿Mostrar e-mail del cliente?');
define('TEXT_PAYMENT_INFORMATION','¿Mostrar datos del pago?');
define('TEXT_SHOW_CREDIT_CARD_NUMBER','¿Mostrar número de tarjeta? (sólo para pedidos con tarjeta de crédito)');
define('TEXT_AUTOMACILLLY_CHANGE_ORDER','Cambiar automáticamente estados de pedidos a:<br>(si se selecciona Ninguno, no se cambiará ningún estado)');
define('TEXT_SHOW_OREDERS_COMMENTS','¿Mostrar pedidos sin comentarios?<br>(NO mostrará los pedidos con comentarios hechos por los clientes en el momento del pedido)');
define('TEXT_NOTIFY_CUSTOMER','Notificar al cliente por e-mail?<br>(El cliente será notificado con un e-mail con los comentarios in the batch print  language file.)');
define('TEXT_BANK','Banco: ');
define('TEXT_POST','Post: ');
define('TEXT_SALES','Ventas: ');
define('TEXT_PACKED_BY','Empaquetado por:  ______________________');
define('TEXT_VERIFIED_BY','Comprobado por:  ______________________');
define('TEXT_DEAR','Estimado/a ');
define('TEXT_THX_CHRISMAS','Gracias por su apoyo contínuo -----');
define('TEXT_RETURNS_LABEL', 'Etiqueta para devolución pedido: ');
define('TEXT_SHIPPING_LABEL', 'Etiqueta para envío pedido: ');
define('SHIP_FROM_COUNTRY', '');  //eg. 'United Kingdom'
define('WEBSITE', 'www.Your site.com');
define('TEXT_RETURNS', 'Esperamos que no la necesite, pero hemos adjuntado una etiqueta de devolución por si acaso. Por favor lea nuestra política de devoluciones en www.Your site.com/information.php?info_id=8');
define('TEXT_TO', 'Para:');
// Change this to a general comment that you would like
define('BATCH_COMMENTS','Notificación de actualización de pedido automática.');
define('EMAIL_SEPARATOR', '---------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Actualización de pedido');
define('EMAIL_TEXT_ORDER_NUMBER', 'Número de pedido:');
define('EMAIL_TEXT_INVOICE_URL', 'Factura detallada:');
define('EMAIL_TEXT_DATE_ORDERED', 'Fecha de pedido:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Se ha actualizado su pedido al siguiente estado.' . "\n\n" . 'Nuevo estado: %s' . "\n\n" . 'Por favor responda a ente e-mail si tiene alguna duda.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'Los comentarios para su pedido son' . "\n\n%s\n\n");

// RGB Colors
define('BLACK', '0,0,0');
define('GREY', '0.9,0.9,0.9');
define('DARK_GREY', '0.7,0.7,0.7');

// Error and Messages
$error['ERROR_INVALID_INPUT'] = 'Error: La entrada no se reconoce o no es válida.';
$error['ERROR_BAD_START_DATE'] =  'Error: Fecha de inicio no válida, por favor introduce una fecha con el formato Año-Mes-Día (0000-00-00).';
$error['ERROR_BAD_END_DATE'] =  'Error: Fecha final no válida, por favor introduce una fecha con el formato Año-Mes-Día (0000-00-00).';
$error['ERROR_BAD_INVOICENUMBERS'] =  'Error: Números de factura no válidos, por favor introdúcelos con formato válido. (eg. 2577,2580-2585,2588)';
$error['NO_ORDERS'] =  'Error: No existen pedidos con esos parámetros, inténtalo cambiando las opciones de los pedidos.';
$error['SET_PERMISSIONS'] = 'Error: ¡No se puede escribir en el directorio! Por favor configura los permisos del directorio temp_pdf a CHMOD 0777';
$error['FAILED_TO_OPEN'] = 'Error: No se ha podido abrir el fichero para escritura, asegúrate que están configuradon los permisos adecuados';

define('SUCCESS_1', 'Correcto: Un fichero PDF con ');
define('SUCCESS_2', ' registro(s) fue creado correctamente. Por favor ');
define('SUCCESS_3', 'pulsa aquí');
define('SUCCESS_4', ' para abrir el fichero.');

// PDF FONT SIZES
define('COMPANY_HEADER_FONT_SIZE','14');
define('SUB_HEADING_FONT_SIZE','11');
define('GENERAL_FONT_SIZE', '11');
define('GENERAL_LEADING', '12');
define('PRODUCT_TOTALS_LEADING', '11');
define('PRODUCT_TOTALS_FONT_SIZE', '10');
define('PRODUCT_ATTRIBUTES_FONT_SIZE', '8');
define('GENERAL_FONT_COLOR', BLACK);

// Margins and Page Size

// This works best with A4, could work with diffferent page sizes,
// However it would require playing with the table values and font values to fit properly
//define('PAGE','A4');
//define('LEFT_MARGIN','30');
// The small indents in the Sold to: Ship to: Text blocks
//define('TEXT_BLOCK_INDENT', '5');
//define('SHIP_TO_COLUMN_START','300');
// This changes the 'Total', 'Sub-Total', 'Tax', and 'Shipping Method' text block
// position, for example if you choose to make the text a bigger font size you need to 
// tweak this value in order to prevent the text from clashing together
//define('PRODUCT_TOTAL_TITLE_COLUMN_START','400');
//define('RIGHT_MARGIN','30');

// Batch Print Misc Vars
define('BATCH_PRINT_INC', DIR_WS_MODULES . 'batch_print/');
define('BATCH_PDF_DIR', BATCH_PRINT_INC . 'temp_pdf/');
//define('LINE_LENGTH', '552');
// If you have attributes for certain products, you can have the text wrap
// or just be written completely on one line, with the text wrap disabled
// it makes the tables smaller appear much better, of course that is only my opinion
// so I made this variable if anyone would like it to wrap.
//define('PRODUCT_ATTRIBUTES_TEXT_WRAP', false);
// This sets the space size between sections
//define('SECTION_DIVIDER', '15');
// Main File
define('BATCH_PRINT_FILE', 'batch_print.php');
// TEMP PDF FILE
define('BATCH_PDF_FILE', 'batch_orders.pdf');

// Product table Settings
//define('TABLE_HEADER_FONT_SIZE', '9');
//define('TABLE_HEADER_BKGD_COLOR', DARK_GREY);
//define('PRODUCT_TABLE_HEADER_WIDTH', '552');
// This is more like cell padding, it moves the text the number
// of points specified to make the rectangle appear padded
//define('PRODUCT_TABLE_BOTTOM_MARGIN', '2');
// Tiny indent right before the product name, again more like
// the cell padding effect
//define('PRODUCT_TABLE_LEFT_MARGIN', '2');
// Height of the product listing rectangles
//define('PRODUCT_TABLE_ROW_HEIGHT', '11');

// The column sizes are where the product listing columns start on the
// PDF page, if you make the TABLE HEADER FONT SIZE any larger you will
// need to tweak these values to prevent text from clashing together
//define('PRODUCTS_COLUMN_SIZE', '172');
//define('PRODUCT_LISTING_BKGD_COLOR',GREY);
//define('MODEL_COLUMN_SIZE', '37');
//define('PRICING_COLUMN_SIZES', '67');

define('FOOTER_TEXT', 'Gracias por comprar con nosotros en ' . STORE_NAME);
?>