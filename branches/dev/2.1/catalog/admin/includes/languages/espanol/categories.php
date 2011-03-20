<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Categorías / Productos');
define('HEADING_TITLE_SEARCH', 'Buscar:');
define('HEADING_TITLE_GOTO', 'Ir a:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Categorías / Productos');
define('TABLE_HEADING_ACTION', 'Acción');
define('TABLE_HEADING_STATUS', 'Estado');

define('TEXT_NEW_PRODUCT', 'Añadir/editar producto en &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Categorías:');
define('TEXT_SUBCATEGORIES', 'Subcategorías:');
define('TEXT_PRODUCTS', 'Productos:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Precio:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Tipo de impuesto:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Valoración media:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Cantidad:');
define('TEXT_DATE_ADDED', 'Fecha añadido:');
define('TEXT_DATE_AVAILABLE', 'Fecha disponibilidad:');
define('TEXT_LAST_MODIFIED', 'Última modificación:');
define('TEXT_IMAGE_NONEXISTENT', 'NO EXISTE IMAGEN');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Inserta una nueva categoría o producto.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Para obtener más información, visite la <a href="http://%s" target="blank"><u>página</u></a> de este producto.');
define('TEXT_PRODUCT_DATE_ADDED', 'Este producto está en nuestro catálogo desde el %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Este producto estará disponible el %s.');

define('TEXT_EDIT_INTRO', 'Realiza los cambios necesarios');
define('TEXT_EDIT_CATEGORIES_ID', 'ID categoría:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Nombre categoría:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Imagen categoría:');
define('TEXT_EDIT_SORT_ORDER', 'Orden:');

define('TEXT_INFO_COPY_TO_INTRO', 'Elige la categoría hacia donde quieres copiar este producto');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Categorías actuales:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nueva categoría');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Editar categoría');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Eliminar categoría');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Mover categoría');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Eliminar producto');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Mover producto');
define('TEXT_INFO_HEADING_COPY_TO', 'Copiar a');

define('TEXT_DELETE_CATEGORY_INTRO', '¿Estás seguro que deseas eliminar esta categoría?');
define('TEXT_DELETE_PRODUCT_INTRO', '¿Estás seguro que deseas eliminar permanentemente este producto?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>ADVERTENCIA:</b> Hay %s (sub)categorías asociadas a esta categoría!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>ADVERTENCIA:</b> Hay %s productos asociados a esta categoría!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Elige la categoría hacia donde quieres mover <b>%s</b>');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Elige la categoría hacia donde quieres mover <b>%s</b>');
define('TEXT_MOVE', 'Mover <b>%s</b> a:');

define('TEXT_NEW_CATEGORY_INTRO', 'Rellene los siguientes datos para la nueva categoría');
define('TEXT_CATEGORIES_NAME', 'Nombre Categoría:');
define('TEXT_CATEGORIES_IMAGE', 'Imagen Categoría:');
define('TEXT_SORT_ORDER', 'Orden:');

define('TEXT_PRODUCTS_STATUS', 'Estado:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Fecha disponibilidad:');
define('TEXT_PRODUCT_AVAILABLE', 'Activo');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Inactivo');
define('TEXT_PRODUCTS_MANUFACTURER', 'Fabricante:');
define('TEXT_PRODUCTS_NAME', 'Nombre del producto:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Descripción del producto:');
define('TEXT_PRODUCTS_QUANTITY', 'Cantidad:');
define('TEXT_PRODUCTS_MODEL', 'Referencia:');
define('TEXT_PRODUCTS_IMAGE', 'Imagen del producto:');
define('TEXT_PRODUCTS_URL', 'URL:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(sin http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Precio (neto):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Precio (bruto):');
define('TEXT_PRODUCTS_MSRP_GROSS', 'PVR (bruto):');
define('TEXT_PRODUCTS_WEIGHT', 'Peso:');
define('TEXT_PRODUCTS_HEIGHT', 'Altura:');
define('TEXT_PRODUCTS_LENGTH', 'Longitud:');
define('TEXT_PRODUCTS_WIDTH', 'Anchura:');
define('TEXT_PRODUCTS_READY_TO_SHIP', 'Listo para enviar:<br/>(Fedex)');
define('TEXT_PRODUCTS_READY_TO_SHIP_SELECTION', 'El producto se puede enviar en su propio envase.');

// BOF Separate Pricing Per Customer
define('TEXT_CUSTOMERS_GROUPS_NOTE', 'Ten en cuenta que si un campo se deja vacío, no se introducirá el precio en la base de datos para ese grupo de clientes.<br />
Si se rellena un campo pero no se marca la casilla de verificación, tampoco se introducirá ningún precio.<br />
Si ya hay un precio en la base de datos pero no se marca la casilla de verificación, se borrará de la base de datos.');
// EOF Separate Pricing Per Customer

define('EMPTY_CATEGORY', 'Categoría vacía');

define('TEXT_HOW_TO_COPY', 'Método de copia:');
define('TEXT_COPY_AS_LINK', 'Vincular el producto');
define('TEXT_COPY_AS_DUPLICATE', 'Duplicar el producto');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Error: No se pueden vincular productos en la misma categoría.');
define('ERROR_CATALOG_BIGIMAGES_DIRECTORY_NOT_WRITEABLE', 'Error: No se puede escribir en el directorio de imágenes del catálogo: ' . DIR_FS_CATALOG_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR);
define('ERROR_CATALOG_THUMBS_DIRECTORY_NOT_WRITEABLE', 'Error: No se puede escribir en el directorio de imágenes del catálogo: ' . DIR_FS_CATALOG_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR);
define('ERROR_CATALOG_BIGIMAGES_DIRECTORY_DOES_NOT_EXIST', 'Error: No existe el directorio de imágenes del catálogo: ' . DIR_FS_CATALOG_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR);
define('ERROR_CATALOG_THUMBS_DIRECTORY_DOES_NOT_EXIST', 'Error: No existe el directorio de imágenes del catálogo: ' . DIR_FS_CATALOG_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Error: No se puede mover una categoría dentro de una subcategoría suya.');

//Select Product Image Directory & Instant Update For Products
define('TEXT_PRODUCTS_DIRECTORY_DONT_EXIST_1', 'Error: - ¡El directorio indicado de \'imágenes\' ');
define('TEXT_PRODUCTS_DIRECTORY_DONT_EXIST_2', ' no existe en el servidor!.');
define('TEXT_PRODUCTS_IMAGE_DIRECTORY', 'Directorio de imágenes:');
define('TEXT_PRODUCTS_IMAGE_ROOT_DIRECTORY', 'Directorio de imágenes');
define('TEXT_PRODUCTS_IMAGE_NEW_FOLDER', 'Nuevo subdirectorio: ');
define('TEXT_PRODUCTS_UPDATE_PRODUCT', 'Actualizar');
define('TEXT_PRODUCTS_INSERT_PRODUCT', 'Insertar');
define('TEXT_PRODUCTS_WITHOUT_PREVIEW', ' sin vista previa ');
define('TEXT_PRODUCTS_MOPICS', 'Imágen adicional:');
define('TEXT_MOPICS_WARNING', 'Selecciona el directorio de imágenes ANTES de subirlas');

define('TEXT_SHIPPING_DIMENSIONS', 'Dimensiones del envío');

define('TEXT_SPPC_HELP', '<hr />Precios para grupos:<br />Si un campo se deja vacío, no se introducirá el precio en la base de datos para ese grupo de clientes.<br />
Si se rellena un campo pero no se marca la casilla de verificación, tampoco se introducirá ningún precio.<br />
Si ya hay un precio en la base de datos pero no se marca la casilla de verificación, se borrará de la base de datos.');
define('TEXT_SPPC_WARNING', '<br /><strong>¡Asegúrate de desmarcar de nuevo las casillas adecuadas!</strong><br />');

define('TEXT_CLICK_TO_ENLARGE', 'Pulsa para ampliar');

define('TAB1', 'Tab 1');
define('TAB2', 'Tab 2');
define('TAB3', 'Tab 3');
define('TAB4', 'Tab 4');
define('TAB5', 'Tab 5');
define('TAB6', 'Tab 6');

// BOF Hide product from groups
define('TEXT_HIDE_PRODUCTS_FROM_GROUP', 'Selecciona los grupos para los que quieres que este producto esté oculto:');
define('TEXT_HIDDEN_FROM_GROUPS', 'Oculto para grupos: ');
define('TEXT_GROUPS_NONE', 'ninguno');
define('TEXT_HIDE_CATEGORIES_FROM_GROUPS', 'Ocultar categorías para grupos:');
define('TABLE_HEADING_HIDE_CATEGORIES', 'Oculto');
// 0: Icons for all groups for which the category or product is hidden, mouse-over the icons to see what group
// 1: Only one icon and only if the category or product is hidden for a group, mouse-over the icon to what groups
define('LAYOUT_HIDE_FROM', '0'); 
// EOF Hide product from groups

// BOF QPBPP for SPPC
define('TEXT_PRODUCTS_QTY_BLOCKS', 'Lotes de unidades:');
define('TEXT_PRODUCTS_QTY_BLOCKS_HELP', '(sólo se pueden pedir en lotes de X unidades, se establece a 1 si se deja vacío)');
define('TEXT_PRODUCTS_PRICE', 'Cantidad para precio por volumen');
define('TEXT_PRODUCTS_QTY', 'unidades a precio/ud.');
define('TEXT_PRODUCTS_DELETE', 'Borrar');
define('TEXT_ENTER_QUANTITY', 'Cantidad');
define('TEXT_PRICE_PER_PIECE', 'Precio/ud.');
define('TEXT_SAVINGS', 'Sus ahorros');
define('TEXT_DISCOUNT_CATEGORY', 'Grupo de descuento:');
define('ERROR_UPDATE_INSERT_DISCOUNT_CATEGORY', 'Algo no ha ido bien mientras se actualizaba o insertaba en la tabla discount_categories');
define('ERROR_ALL_CUSTOMER_GROUPS_DELETED', 'Se han borrado todos los grupos de clientes, por favor inserta al menos el grupo retail en la tabla customers_groups (ver sppc_v421_install.sql)');
define('TEXT_PRODUCTS_MIN_ORDER_QTY', 'Pedido mínimo (unidades):');
define('TEXT_PRODUCTS_MIN_ORDER_QTY_HELP', '(se pone por defecto a 1, no es necesario especificar un valor)');
define('TEXT_PRICE_BREAK_INFO', '<acronym title="precio/ud. (uds.)">Precios por volumen</acronym>: ');
define('PB_DROPDOWN_BEFORE', '');
define('PB_DROPDOWN_BETWEEN', ' en ');
define('PB_DROPDOWN_AFTER', ' cada uno');
define('PB_FROM', 'desde');
// EOF QPBPP for SPPC

// BOF Open Featured Sets
define('TEXT_PRODUCTS_SHORT', 'Descripción corta del producto:');
define('TABLE_HEADING_FEATURED', 'Destacado');
define('TABLE_HEADING_FEATURED_PREVIEW', 'Vista previa');
define('TEXT_CATEGORIES_FEATURED', 'Categoría destacada');
define('TEXT_CATEGORIES_YES', 'Sí');
define('TEXT_CATEGORIES_NO', 'No');
define('TEXT_CATEGORIES_FEATURED_DATE', 'Destadacada hasta ');
define('TEXT_PRODUCTS_FEATURED', 'Producto destacado:');
define('TEXT_PRODUCT_NO', 'No');
define('TEXT_PRODUCT_YES', 'Sí');
define('TEXT_MORE_INFO', 'más...');
// EOF Open Featured Sets

define('HEADING_PRICE_HELP','Ayuda precio');
define('TEXT_PRICE_HELP', 'Si quieres que se muestre <b>Consultar precio</b> establece el precio a -1');
define('HEADING_MSRP_HELP', 'Precio de venta recomendado por el fabricante (PVR)');
define('TEXT_MSRP_HELP', 'Si quieres que se muestre un PVR en la información del producto introdúcelo aquí.');
define('TEXT_ADD_PL', 'Añadir otra cantidad de precio por volumen');
define('TEXT_FEATURED_UNTIL', 'Destacado hasta: ');
define('TEXT_SHIPPING_PRICE', 'Gastos de envío individuales: ');

define('TEXT_THUMBNAIL_IMAGE', 'Imagen en miniatura:');
?>