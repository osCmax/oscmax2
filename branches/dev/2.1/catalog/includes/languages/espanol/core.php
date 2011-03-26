<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/


// Global entries for the <html> tag
define('HTML_PARAMS','dir="LTR" lang="es"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', STORE_NAME);

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Crear cuenta');
define('HEADER_TITLE_MY_ACCOUNT', 'Mi cuenta');
define('HEADER_TITLE_CONTACT_US', 'Contacto');
define('HEADER_TITLE_CART_CONTENTS', 'Ver carrito');
define('HEADER_TITLE_BASKET_CONTENTS', 'Ver cesta');
define('HEADER_TITLE_CHECKOUT', 'Realizar pedido');
define('HEADER_TITLE_WISHLIST', 'Favoritos');
define('HEADER_TITLE_TOP', 'Inicio');
define('HEADER_TITLE_CATALOG', 'Catálogo');
define('HEADER_TITLE_LOGOFF', 'Cerrar sesión');
define('HEADER_TITLE_LOGIN', 'Iniciar sesión');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'peticiones desde');

// text for gender
define('MALE', 'Hombre');
define('FEMALE', 'Mujer');
define('MALE_ADDRESS', 'Sr.');
define('FEMALE_ADDRESS', 'Sra.');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/aaaa');

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Categorías');

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Fabricantes');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Novedades');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'Búsqueda rápida');
define('BOX_SEARCH_TEXT', 'Use palabras clave para encontrar el producto que busca.');
define('BOX_SEARCH_ADVANCED_SEARCH', 'Búsqueda avanzada');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'Ofertas');

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Comentarios');
define('BOX_REVIEWS_WRITE_REVIEW', 'Escriba un comentario para este producto');
define('BOX_REVIEWS_NO_REVIEWS', 'Actualmente no hay ningun comentario');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s de 5 estrellas');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Carrito');
define('BOX_HEADING_SHOPPING_BASKET', 'Cesta');
define('BOX_SHOPPING_CART_EMPTY', '0 productos');

// BOF: MOD - Wishlist 3.5
//wishlist box text in includes/boxes/wishlist.php 
define('BOX_HEADING_CUSTOMER_WISHLIST', 'Mis favoritos'); 
define('TEXT_WISHLIST_COUNT', 'Actualmente tiene %s productos en favoritos.');
define('BOX_TEXT_REMOVE', 'Quitar');
define('BOX_TEXT_PRICE', 'Precio');
define('BOX_TEXT_PRODUCT', 'Nombre del producto');
define('BOX_TEXT_IMAGE', 'Imagen');
define('BOX_TEXT_SELECT', 'Seleccionar');
define('BOX_TEXT_VIEW', 'Mostrar');
define('BOX_TEXT_HELP', 'Ayuda');
define('BOX_WISHLIST_EMPTY', '0 productos');
define('BOX_TEXT_NO_ITEMS', 'No tiene productos en favoritos. <br /><br /><b><a href="' . tep_href_link(FILENAME_WISHLIST_HELP) . '"><u>Pulse aquí</u></a> para leer la ayuda sobre los favoritos</b>');
// EOF: MOD - Wishlist 3.5

// order_history box text in includes/boxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'Mis pedidos');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Los más vendidos');
define('BOX_HEADING_BESTSELLERS_IN', 'Los más vendidos en <br>&nbsp;&nbsp;');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Avisos');
define('BOX_NOTIFICATIONS_NOTIFY', 'Avíseme de cambios de <b>%s</b>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'No me avise de cambios de <b>%s</b>');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Fabricante');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', 'Página de %s');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Otros productos');

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Idiomas');

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'Monedas');

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Información');
define('BOX_INFORMATION_PRIVACY', 'Política de privacidad');
define('BOX_INFORMATION_CONDITIONS', 'Condiciones de uso');
define('BOX_INFORMATION_SHIPPING', 'Envíos/Devoluciones');
define('BOX_INFORMATION_CONTACT', 'Contacte con nosotros');
// LINE ADDED: SITE MAP
define('BOX_INFORMATION_SITEMAP', 'Mapa web');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Cuéntaselo a un amigo');
define('BOX_TELL_A_FRIEND_TEXT', 'Cuéntale a un amigo que conoces este producto.');

//MailChimp
define('BOX_HEADING_MAILCHIMP', 'Boletín');
define('MAILCHIMP_INTRO_TEXT', 'Si desea suscribirse a nuestro boletín, por favor introduzca aquí su email:');
define('MAILCHIMP_INTRO_TEXT_SUBSCRIBED', 'Actualmente se encuentra suscrito a nuestro boletín');
define('MAILCHIMP_INTRO_TEXT_UNSUBSCRIBED', 'Si desea suscribirse a nuestro boletín, por favor introduzca aquí su email:');
define('MAILCHIMP_HTML', 'HTML');
define('MAILCHIMP_TEXT', 'Texto');
define('MAILCHIMP_MISSING_INTRO', 'La información en la configuración de Mailchimp no está completa. <br><br><b>Faltan los parámetros:</b>');
define('MAILCHIMP_NEED_ENABLING', '<b>Por favor habilite el módulo</b>');
define('MAILCHIMP_MISSING_API', 'API Key');
define('MAILCHIMP_MISSING_ID', 'List ID');
define('MAILCHIMP_MISSING_URL', 'List URL');
define('MAILCHIMP_MISSING_U', 'U value');

// LINE ADDED: MOD - allprods modification
define('BOX_INFORMATION_ALLPRODS', 'Vea todos los productos');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Datos de entrega');
define('CHECKOUT_BAR_PAYMENT', 'Datos de pago');
define('CHECKOUT_BAR_CONFIRMATION', 'Confirmación');
define('CHECKOUT_BAR_FINISHED', '¡Finalizado!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Seleccione');
define('PULL_DOWN_DEFAULT_DOTS', 'Selecciona por favor...');
define('PULL_DOWN_NA', 'N/D');
define('TYPE_BELOW', 'Escriba a continuación');

// javascript messages
define('JS_ERROR', 'Se han producido errores al procesar su formulario. Por favor, realice las siguientes correciones:');

define('JS_REVIEW_TEXT', '* Su \'Comentario\' debe tener al menos ' . REVIEW_TEXT_MIN_LENGTH . ' letras.\n');
define('JS_REVIEW_RATING', '* Debe valorar el producto sobre el que opina.\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Por favor seleccione una forma de pago para su pedido.\n');

define('JS_ERROR_SUBMITTED', 'Ya se ha enviado el formulario. Pulse Aceptar y espere a que termine el proceso.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Por favor seleccione una forma de pago para su pedido.');

define('CATEGORY_COMPANY', 'Datos de la empresa');
define('CATEGORY_PERSONAL', 'Datos personales');
define('CATEGORY_ADDRESS', 'Dirección');
define('CATEGORY_CONTACT', 'Información de contacto');
define('CATEGORY_OPTIONS', 'Opciones');
define('CATEGORY_PASSWORD', 'Contraseña');

define('ENTRY_COMPANY', 'Nombre de la empresa:');
define('ENTRY_COMPANY_ERROR', 'Por favor introduzca el nombre de su empresea');
define('ENTRY_COMPANY_TEXT', '*');
define('ENTRY_COMPANY_TAX_ID', 'NIF empresa:');
define('ENTRY_COMPANY_TAX_ID_ERROR', 'Por favor introduzca el NIF de su empresa');
define('ENTRY_COMPANY_TAX_ID_TEXT', '*');
define('ENTRY_GENDER', 'Sexo:');
define('ENTRY_GENDER_ERROR', 'Por favor seleccione una opción.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Nombre:');
define('ENTRY_FIRST_NAME_ERROR', 'Su nombre debe tener al menos ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' letras.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Apellidos:');
define('ENTRY_LAST_NAME_ERROR', 'Sus apellidos deben tener al menos ' . ENTRY_LAST_NAME_MIN_LENGTH . ' letras.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Fecha de nacimiento:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Su fecha de nacimiento debe tener este formato: DD/MM/AAAA (p.ej. 21/05/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (p.ej. 21/05/1970)');
define('ENTRY_EMAIL_ADDRESS', 'Dirección e-mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Su dirección de e-mail debe tener al menos ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' letras.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Su dirección de e-mail no parece válida - por favor haga los cambios necesarios.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Su dirección de e-mail ya figura entre nuestros clientes - puede entrar a su cuenta con esta dirección o crear una cuenta nueva con una dirección diferente.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Dirección:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Su dirección debe tener al menos ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' letras.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', 'Línea 2 de dirección');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Código postal:');
define('ENTRY_POST_CODE_ERROR', 'Su código postal debe tener al menos ' . ENTRY_POSTCODE_MIN_LENGTH . ' letras.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Población:');
define('ENTRY_CITY_ERROR', 'Su población debe tener al menos ' . ENTRY_CITY_MIN_LENGTH . ' letras.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Provincia:');
define('ENTRY_STATE_ERROR', 'Su provincia debe tener al menos ' . ENTRY_STATE_MIN_LENGTH . ' letras.');
define('ENTRY_STATE_ERROR_SELECT', 'Por favor seleccione de la lista desplegable.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'País:');
define('ENTRY_COUNTRY_ERROR', 'Debe seleccionar un país de la lista desplegable.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'Teléfono:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Su número de teléfono debe tener al menos ' . ENTRY_TELEPHONE_MIN_LENGTH . ' letras.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_FAX_NUMBER_ERROR', 'Por favor introduzca su número de fax');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Boletín de noticias:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'suscribirse');
define('ENTRY_NEWSLETTER_NO', 'no suscribirse');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Contraseña:');
define('ENTRY_PASSWORD_ERROR', 'Su contraseña debe tener al menos ' . ENTRY_PASSWORD_MIN_LENGTH . ' letras.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'La confirmación de la contraseña debe ser igual a la contraseña.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Confirme contraseña:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Contraseña actual:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Su contraseña debe tener al menos ' . ENTRY_PASSWORD_MIN_LENGTH . ' letras.');
define('ENTRY_PASSWORD_NEW', 'Nueva contraseña:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Su contraseña nueva debe tener al menos ' . ENTRY_PASSWORD_MIN_LENGTH . ' letras.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'La confirmación de su contraseña debe coincidir con su contraseña nueva.');
define('PASSWORD_HIDDEN', '--OCULTO--');

define('FORM_REQUIRED_INFORMATION', '* Dato obligatorio');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Páginas de resultados:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Mostrando del <b>%d</b> al <b>%d</b> (de <b>%d</b> productos)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Mostrando del <b>%d</b> al <b>%d</b> (de <b>%d</b> pedidos)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Mostrando del <b>%d</b> al <b>%d</b> (de <b>%d</b> comentarios)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Mostrando del <b>%d</b> al <b>%d</b> (de <b>%d</b> productos nuevos)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Mostrando del<b>%d</b> al <b>%d</b> (de <b>%d</b> ofertas)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Primera página');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'Página anterior');
define('PREVNEXT_TITLE_NEXT_PAGE', 'Página siguiente');
define('PREVNEXT_TITLE_LAST_PAGE', 'Última página');
define('PREVNEXT_TITLE_PAGE_NO', 'Página %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Anteriores %d páginas');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Siguientes %d páginas');
define('PREVNEXT_BUTTON_FIRST', 'Primera');
define('PREVNEXT_BUTTON_PREV', 'Anterior');
define('PREVNEXT_BUTTON_NEXT', 'Siguiente');
define('PREVNEXT_BUTTON_LAST', 'Última');

define('IMAGE_BUTTON_ADD_ADDRESS', 'Añadir dirección');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Agenda de direcciones');
define('IMAGE_BUTTON_BACK', 'Volver');
define('IMAGE_BUTTON_BUY_NOW', 'Compre ahora');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Cambiar dirección');
define('IMAGE_BUTTON_CHECKOUT', 'Realizar pedido');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Confirmar pedido');
define('IMAGE_BUTTON_CONTINUE', 'Continuar');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Seguir comprando');
define('IMAGE_BUTTON_DELETE', 'Eliminar');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Modificar cuenta');
define('IMAGE_BUTTON_HISTORY', 'Historial de pedidos');
define('IMAGE_BUTTON_LOGIN', 'Inicio de sesión');
define('IMAGE_BUTTON_IN_CART', 'Añadir al carrito');
define('IMAGE_BUTTON_IN_BASKET', 'Añadir a la cesta');
define('IMAGE_OUT_OF_STOCK', 'Agotado');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Avisos');
define('IMAGE_BUTTON_QUICK_FIND', 'Búsqueda rápida');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Quitar avisos');
define('IMAGE_BUTTON_REVIEWS', 'Comentarios');
define('IMAGE_BUTTON_SEARCH', 'Buscar');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Opciones de envío');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Cuéntaselo a un amigo');
define('IMAGE_BUTTON_UPDATE', 'Actualizar');
define('IMAGE_BUTTON_UPDATE_CART', 'Actualizar carrito');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Escribir comentario');
define('IMAGE_BUTTON_CFP', 'Consultar precio');
define('IMAGE_BUTTON_AAQ', 'Pregúntenos sobre este producto');
define('IMAGE_BUTTON_MORE_INFO', 'Más información');
define('IMAGE_BUTTON_REMOVE_PRODUCT', 'Quitar producto');
define('IMAGE_BUTTON_SEND', 'Enviar');
define('IMAGE_BUTTON_WISHLIST_HELP', 'Ayuda de favoritos');
define('IMAGE_BUTTON_WISHLIST', 'Añadir a favoritos');

define('SMALL_IMAGE_BUTTON_DELETE', 'Eliminar');
define('SMALL_IMAGE_BUTTON_EDIT', 'Modificar');
define('SMALL_IMAGE_BUTTON_VIEW', 'Ver');

define('ICON_ARROW_RIGHT', 'más');
define('ICON_CART', 'En carrito');
define('ICON_ERROR', 'Error');
define('ICON_SUCCESS', 'Correcto');
define('ICON_WARNING', 'Advertencia');

// BOF: MOD - CATALOG_PRODUCTS_WITH_IMAGES_mod
define('BOX_CATALOG_PRODUCTS_WITH_IMAGES', 'Catálogo imprimible');
define('IMAGE_BUTTON_UPSORT', 'Orden ascendente');
define('IMAGE_BUTTON_DOWNSORT', 'Orden descendente');
// EOF: MOD - CATALOG_PRODUCTS_WITH_IMAGES_mod

//2 LINES ADDED: MOD - Down For Maintenance
define('TEXT_BEFORE_DOWN_FOR_MAINTENANCE', 'NOTA: Este sitio web estará cerrado por mantenimiento el: ');
define('TEXT_ADMIN_DOWN_FOR_MAINTENANCE', 'NOTA: El sitio web está actualmente cerrado por mantenimiento');

define('TEXT_SORT_PRODUCTS', 'Ordenar productos ');
define('TEXT_DESCENDINGLY', 'descendentemente');
define('TEXT_ASCENDINGLY', 'ascendentemente');
define('TEXT_BY', ' por ');

define('TEXT_REVIEW_BY', 'por %s');
define('TEXT_REVIEW_WORD_COUNT', '%s palabras');
define('TEXT_REVIEW_RATING', 'Valoración: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Fecha de publicación: %s');
define('TEXT_NO_REVIEWS', 'Actualmente no hay ningun comentario.');

define('TEXT_NO_NEW_PRODUCTS', 'En este momento no hay novedades.');

define('TEXT_UNKNOWN_TAX_RATE', 'Impuesto desconocido');

define('TEXT_REQUIRED', '<span class="errorText">Obligatorio</span>');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>Error:</small> No he podido enviar el email con el servidor SMTP especificado. Revisa la configuración del archivo php.ini y corrija el servidor SMTP si es necesario.</b></font>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Advertencia: El directorio de instalación existe en: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/install. Por razones de seguridad, elimine este directorio completamente.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Advertencia: Se puede escribir en el fichero de configuración: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php. En determinadas circunstancias esto puede suponer un riesgo de seguridad - por favor corrija los permisos de este fichero.');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Advertencia: El directorio para guardar datos de sesión no existe: ' . tep_session_save_path() . '. Las sesiones no funcionarán hasta que no se cree el directorio.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Avertencia: No puedo escribir en el directorio para datos de sesión: ' . tep_session_save_path() . '. Las sesiones no funcionarán hasta que no se establezcan correctamente los permisos del directorio.');
define('WARNING_SEO_PHP_VERSION_LOW', 'Avertencia: Tu servidor web está funcionando con la versión de PHP ' . PHP_VERSION . ' que no es suficiente para el funcionamiento de SEO URLs. Por favor deshabilita este módulo hasta que hayas actualizado la versión de PHP.');
define('WARNING_SESSION_AUTO_START', 'Advertencia: session.auto_start esta activado - desactiva esta característica en el fichero php.ini y reinicia el servidor web.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Advertencia: El directorio para productos descargables no existe: ' . DIR_FS_DOWNLOAD . '. Los productos descargables no funcionarán hasta que este directorio exista y sea válido.');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'La fecha de caducidad de la tarjeta de crédito es incorrecta. Compruebe la fecha e inténtelo de nuevo.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'El número de la tarjeta de crédito es incorrecto. Compruebe el número e inténtelo de nuevo.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Los primeros cuatro digitos de su tarjeta son: %s. Si este número es correcto, no aceptamos este tipo de tarjetas. Si es incorrecto, inténtelo de nuevo.');
define('WARNING_JAVASCRIPT_DISABLED', 'Alerta: Se ha detectado que tiene Javascript desactivado. Para conseguir una mejor experiencia debería activarlo. Si necesita ayuda con esto por favor <b>pulse aquí.</b>');
define('WARNING_IE6_DETECTED', 'Advertencia: Se ha detectado que está usando Internet Explorer 6, cuya tecnología es obsoleta. Le recomendamos fervientemente que <b>actualice su navegador</b>. Pruebe con los navegadores más populares como <a href="http://www.microsoft.com/spain/windows/internet-explorer/default.aspx"><b>Internet Explorer</b></a>, <a href="http://www.mozilla-europe.org/es/firefox/"><b>Firefox</b></a> ó <a href="http://www.google.com/chrome?hl=es"><b>Chrome</b></a>');

define('FOOTER_TEXT_BODY', 'Todo el contenido e imágenes Copyright &copy; ' . date('Y') . ' <a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . STORE_NAME . '</a><br> Copyright &copy; 2000 - ' . date("Y") .  '<a href="http://oscmax.com"> osCmax</a><br>Powered by <a href="http://www.oscmax.com" target="_blank">' . PROJECT_VERSION . '</a>');


// BOF: MOD - Checkout Without Account
define('IMAGE_BUTTON_CREATE_ACCOUNT', 'Crear cuenta');
define('NAV_ORDER_INFO', 'Información del pedido');
// EOF: MOD - Checkout Without Account

// BOF: MOD - Article Manager
define('BOX_HEADING_ARTICLES', 'Noticias');
define('BOX_ALL_ARTICLES', 'Todas las noticias');
define('BOX_NEW_ARTICLES', 'Últimas noticias');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES', 'Mostrando de <b>%d</b> a <b>%d</b> (de <b>%d</b> noticias)');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES_NEW', 'Mostrando de <b>%d</b> a <b>%d</b> (de <b>%d</b> últimas noticias)');
define('TABLE_HEADING_AUTHOR', 'Autor');
define('TABLE_HEADING_ABSTRACT', 'Extracto');
define('BOX_HEADING_AUTHORS', 'Noticias por autor');
define('NAVBAR_TITLE_DEFAULT', 'Noticias');
// EOF: MOD - Article Manager

// BOF: MOD - Login Box My Account
define('BOX_HEADING_LOGIN_BOX', 'Iniciar sesión');
define('BOX_LOGINBOX_EMAIL', 'Dirección e-mail:');
define('BOX_LOGINBOX_PASSWORD', 'Contraseña:');
define('BOX_LOGINBOX_TEXT_NEW', 'Crear una cuenta');
define('BOX_LOGINBOX_NEW', 'crear una cuenta');
define('BOX_LOGINBOX_FORGOT_PASSWORD', '¿Olvidó su contraseña?');
define('BOX_HEADING_LOGIN_BOX_MY_ACCOUNT','Mi cuenta');
define('LOGIN_BOX_ACCOUNT_EDIT','Modificar datos');
define('LOGIN_BOX_ACCOUNT_HISTORY','Historial de pedidos');
define('LOGIN_BOX_ADDRESS_BOOK','Agenda de direcciones');
define('LOGIN_BOX_PRODUCT_NOTIFICATIONS','Avisos de productos');
define('LOGIN_BOX_MY_ACCOUNT','Datos de mi cuenta');
define('LOGIN_BOX_LOGOFF','Cerrar sesión');
define('LOGIN_BOX_PRODUCTS_NEW','Novedades');
define('LOGIN_BOX_SPECIALS', 'Ofertas');
define('LOGIN_BOX_WISHLIST', 'Mis favoritos');
define('LOGIN_BOX_NEWSLETTERS', 'Boletines');
// EOF: MOD - Login Box My Account

// BOF: QPBPP for SPPC
define('MINIMUM_ORDER_NOTICE', 'El pedido mínimo de %s es de %d unidades. El contenido del carrito se ha modificado en consecuencia.');
define('QUANTITY_BLOCKS_NOTICE', '%s sólo se puede pedir como un múltiplo de %d. El contenido del carrito se ha modificado en consecuencia.');
// EOF: QPBPP for SPPC

// BOF: Customer Comments contrib
define('SUCCESS_ORDER_UPDATED', 'Correcto: El pedido se a actualizado correctamente.');
define('WARNING_ORDER_NOT_UPDATED', 'Advertencia: No hay cambios. El pedido no ha cambiado.');
// EOF: Customer Comments contrib

// BOF: Open Featured Sets
define('OPEN_FEATURED_BOX_HEADING', 'Productos destacados');
define('OPEN_FEATURED_BOX_CATEGORY_HEADING', 'Categorías destacadas');
define('OPEN_FEATURED_BOX_MANUFACTURERS_HEADING', 'Destacamos');
define('OPEN_FEATURED_BOX_MANUFACTURER_HEADING', 'Destacamos');
define('OPEN_FEATURED_TABLE_HEADING_PRICE', ''); //Price: 
define('TEXT_MORE_INFO', 'más...');
// EOF: Open Featured Sets

// BOF: Extra Product Fields
define('TEXT_ANY_VALUE', 'Cualquier valor');
define('TEXT_RESTRICT_TO', 'Restringir <b>%s</b> a: %s y sus subvalores (si tiene).');
// EOF: Extra Product Fields

// LINE ADDED: MOD - EASY CALL FOR PRICE v1.4
define('TEXT_CALL_FOR_PRICE', '¡Consultar precio!');

// BOF: MSRP
define('TEXT_PRODUCTS_OUR_PRICE', '&nbsp;Nuestro&nbsp;precio:&nbsp;');
define('TEXT_PRODUCTS_SALE', '&nbsp;era:&nbsp;');
define('TEXT_PRODUCTS_SAVINGS', '&nbsp;Se&nbsp;ahorra:&nbsp;');
define('TEXT_PRODUCTS_PRICENOW', '&nbsp;ahora:&nbsp;');
define('TEXT_PRODUCTS_USUALPRICE', '&nbsp;Precio habitual:&nbsp;');
// EOF: MSRP

define('TEXT_LATEST_PRODUCTS', 'Últimos productos');
define('TEXT_SPECIALS', 'Ofertas');
define('TEXT_READ_MORE', ' ... leer más ... ');

define('TEXT_MISSING_IMAGE','Lo sentimos, la imagen del producto no está disponible');
define('TEXT_PAGE', 'Página: ');

// Review Ratings
define('TEXT_RATING', 'Valoración: ');
define('TEXT_POOR', 'Regular');
define('TEXT_FAIR', 'Aceptable');
define('TEXT_AVERAGE', 'Bueno');
define('TEXT_GOOD', 'Muy bueno');
define('TEXT_EXCELLENT', 'Excelente');

// Password Text
define('PW_TOO_WEAK', 'Muy débil');
define('PW_WEAK', 'Contraseña débil');
define('PW_NORMAL', 'Fortaleza normal');
define('PW_STRONG', 'Contraseña fuerte');
define('PW_VERY_STRONG', 'Contraseña muy fuerte');

// Product listing
define('TEXT_PRODUCT_NAME_AZ', 'Nombre producto (A-Z)');
define('TEXT_PRODUCT_NAME_ZA', 'Nombre producto (Z-A)');
define('TEXT_PRICE_LOW_HIGH', 'Precio (Menor - Mayor)');
define('TEXT_PRICE_HIGH_LOW', 'Precio (Mayor - Menor)');
define('TEXT_SHOW_ALL', 'Mostrar todos');
define('TEXT_VIEW_AS_LIST', 'Mostrar como lista');
define('TEXT_VIEW_AS_GRID', 'Mostrar en cuadrícula');
define('TEXT_RESULTS_PAGE', 'Resultados/página: ');
define('TEXT_SORT_ORDER', 'Orden: ');

?>