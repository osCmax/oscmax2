<?php
/*
$Id: espanol.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'es_ES'
// on FreeBSD try 'es_ES.ISO_8859-1'
// on Windows try 'sp', or 'Spanish'
@setlocale(LC_TIME, 'es_ES.ISO_8859-1');

define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y');  // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format mm/dd/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
}

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'EUR');

// Global entries for the <html> tag
define('HTML_PARAMS','dir="LTR" lang="es"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', 'osCMax v2.0');

// header text in includes/header.php
define('HEADER_TITLE_CREATE_ACCOUNT', 'Crear una Cuenta');
define('HEADER_TITLE_MY_ACCOUNT', 'Mi Cuenta');
define('HEADER_TITLE_CART_CONTENTS', 'Contenido del Carrito');
define('HEADER_TITLE_CHECKOUT', 'Chequeo');
define('HEADER_TITLE_TOP', 'Top');
define('HEADER_TITLE_CATALOG', 'Catalogo');
define('HEADER_TITLE_LOGOFF', 'Salir');
define('HEADER_TITLE_LOGIN', 'Entrar');

// footer text in includes/footer.php
define('FOOTER_TEXT_REQUESTS_SINCE', 'solicitudes desde');

// text for gender
define('MALE', 'Hombre');
define('FEMALE', 'Mujer');
define('MALE_ADDRESS', 'Sr.');
define('FEMALE_ADDRESS', 'Sra.');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/aaaa');

// categories box text in includes/boxes/categories.php
define('BOX_HEADING_CATEGORIES', 'Categorias');

// manufacturers box text in includes/boxes/manufacturers.php
define('BOX_HEADING_MANUFACTURERS', 'Fabricantes');

// whats_new box text in includes/boxes/whats_new.php
define('BOX_HEADING_WHATS_NEW', 'Que hay de nuevo?');

// quick_find box text in includes/boxes/quick_find.php
define('BOX_HEADING_SEARCH', 'B�squeda r�pida');
define('BOX_SEARCH_TEXT', 'Utilize palabras clave para encontrar lo que busca.');
define('BOX_SEARCH_ADVANCED_SEARCH', 'B�squeda Avanzada');

// specials box text in includes/boxes/specials.php
define('BOX_HEADING_SPECIALS', 'Especiales');

// reviews box text in includes/boxes/reviews.php
define('BOX_HEADING_REVIEWS', 'Resumenes');
define('BOX_REVIEWS_WRITE_REVIEW', 'Escriba un resumen sobre este producto!');
define('BOX_REVIEWS_NO_REVIEWS', 'No hay actualmente ningun resumen de este producto');
define('BOX_REVIEWS_TEXT_OF_5_STARS', '%s de 5 Estrellas!');

// shopping_cart box text in includes/boxes/shopping_cart.php
define('BOX_HEADING_SHOPPING_CART', 'Carrito de Compras');
define('BOX_SHOPPING_CART_EMPTY', '0 objetos');

// order_history box text in includes/boxes/order_history.php
define('BOX_HEADING_CUSTOMER_ORDERS', 'Historia de Pedido');

// best_sellers box text in includes/boxes/best_sellers.php
define('BOX_HEADING_BESTSELLERS', 'Bestsellers');
define('BOX_HEADING_BESTSELLERS_IN', 'Bestsellers in<br>&nbsp;&nbsp;');

// notifications box text in includes/boxes/products_notifications.php
define('BOX_HEADING_NOTIFICATIONS', 'Notificaciones');
define('BOX_NOTIFICATIONS_NOTIFY', 'Notif�queme de actualizaciones <b>%s</b>');
define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', 'No me notif�que de actualizaciones <b>%s</b>');

// manufacturer box text
define('BOX_HEADING_MANUFACTURER_INFO', 'Informaci�n del fabricantes');
define('BOX_MANUFACTURER_INFO_HOMEPAGE', '%s Homepage');
define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', 'Otros productos');

// languages box text in includes/boxes/languages.php
define('BOX_HEADING_LANGUAGES', 'Idiomas');

// currencies box text in includes/boxes/currencies.php
define('BOX_HEADING_CURRENCIES', 'Divisas');

// information box text in includes/boxes/information.php
define('BOX_HEADING_INFORMATION', 'Informaci�n');
define('BOX_INFORMATION_PRIVACY', 'Aviso de Intimidad');
define('BOX_INFORMATION_CONDITIONS', 'Condiciones de Uso');
define('BOX_INFORMATION_SHIPPING', 'Transporte y Retornos');
define('BOX_INFORMATION_CONTACT', 'Cont�ctenos');
// LINE ADDED: SITE MAP
define('BOX_INFORMATION_SITEMAP', 'Site Map');

// tell a friend box text in includes/boxes/tell_a_friend.php
define('BOX_HEADING_TELL_A_FRIEND', 'Dile a un Amigo');
define('BOX_TELL_A_FRIEND_TEXT', 'Dile a alguien que usted sabe de este producto.');

// LINE ADDED: MOD - allprods modification
define('BOX_INFORMATION_ALLPRODS', 'Vea Todos los Art�culos');

// 2 LINES ADDED: MOD - Recover Carts
define('BOX_REPORTS_RECOVER_CART_SALES', 'Recover Carts');
define('BOX_TOOLS_RECOVER_CART', 'Recover Carts');

// checkout procedure text
define('CHECKOUT_BAR_DELIVERY', 'Informaci�n de entrega');
define('CHECKOUT_BAR_PAYMENT', 'Informaci�n de pago');
define('CHECKOUT_BAR_CONFIRMATION', 'Confirmaci�n');
define('CHECKOUT_BAR_FINISHED', 'Terminado!');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Seleccione');
define('TYPE_BELOW', 'Escriba Debajo');

// javascript messages
define('JS_ERROR', 'Los errores han ocurrido durante el proceso de su forma.\n\nPor favor haga las correcciones siguientes:\n\n');

define('JS_REVIEW_TEXT', '* The \'Review Text\' must have at least ' . REVIEW_TEXT_MIN_LENGTH . ' characters.\n');
define('JS_REVIEW_RATING', '* Usted debe tasar el producto para su revisi�n.\n');

define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* Por favor seleccione un m�todo de pago para su pedido.\n');

define('JS_ERROR_SUBMITTED', 'Esta forma ya ha sido subscrita. Por favor confirme con la tecla OK y espere este proceso para ser completado.');

define('ERROR_NO_PAYMENT_MODULE_SELECTED', 'Por favor seleccione un m�todo de pago para su pedido.');

define('CATEGORY_COMPANY', 'Detalles de la Empresa');
define('CATEGORY_PERSONAL', 'Sus Detalles Personales');
define('CATEGORY_ADDRESS', 'Su Direcci�n');
define('CATEGORY_CONTACT', 'Su Informaci�n de Contacto');
define('CATEGORY_OPTIONS', 'Opciones');
define('CATEGORY_PASSWORD', 'Su Contrase�a');

define('ENTRY_COMPANY', 'Nombre de la compa��a:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
// BOF: MOD - Separate Pricing Per Customer
define('ENTRY_COMPANY_TAX_ID', 'Company\'s tax id number:');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
define('ENTRY_COMPANY_TAX_ID_TEXT', '');
// EOF: MOD - Separate Pricing Per Customer
define('ENTRY_GENDER', 'G�nero:');
define('ENTRY_GENDER_ERROR', 'Por favor seleccione su G�nero.');
define('ENTRY_GENDER_TEXT', '*');
define('ENTRY_FIRST_NAME', 'Nombre:');
define('ENTRY_FIRST_NAME_ERROR', 'Su Nombre  debe contener un m�nimo ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres.');
define('ENTRY_FIRST_NAME_TEXT', '*');
define('ENTRY_LAST_NAME', 'Apellido:');
define('ENTRY_LAST_NAME_ERROR', 'Su Apellido debe contener un m�nimo ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caracteres.');
define('ENTRY_LAST_NAME_TEXT', '*');
define('ENTRY_DATE_OF_BIRTH', 'Fecha de nacimiento:');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Su Fecha de nacimiento debe estar en este formato: MM/DD/AAAA (eg 05/21/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (eg. 05/21/1970)');
define('ENTRY_EMAIL_ADDRESS', 'Direcci�n de correo electr�nico:');
define('ENTRY_EMAIL_ADDRESS_ERROR', 'Su Direcci�n de correo electr�nico debe contener un m�nimo de ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caracteres.');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', 'Su Direcci�n de correo electr�nico no aparece ser v�lida - por favor haga cualquier correcci�n necesaria.');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', 'Su Direcci�n de correo electr�nico ya existe en nuestros registros - por favor con�ctese con la direcci�n de correo electr�nico o cree una cuenta con una direcci�n diferente.');
define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
define('ENTRY_STREET_ADDRESS', 'Direcci�n:');
define('ENTRY_STREET_ADDRESS_ERROR', 'Su Direcci�n debe contener un m�nimo de ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caracteres.');
define('ENTRY_STREET_ADDRESS_TEXT', '*');
define('ENTRY_SUBURB', 'Suburbio:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'C�digo Postal:');
define('ENTRY_POST_CODE_ERROR', 'Su C�digo Postal debe contener un m�nimo de ' . ENTRY_POSTCODE_MIN_LENGTH . ' caracteres.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_CITY', 'Ciudad:');
define('ENTRY_CITY_ERROR', 'Su Ciudad debe contener un m�nimo de ' . ENTRY_CITY_MIN_LENGTH . ' caracteres.');
define('ENTRY_CITY_TEXT', '*');
define('ENTRY_STATE', 'Estado/Provincia:');
define('ENTRY_STATE_ERROR', 'Su Estado debe contener un m�nimo de ' . ENTRY_STATE_MIN_LENGTH . ' caracteres.');
define('ENTRY_STATE_ERROR_SELECT', 'Por favor seleccione un estado de el men�.');
define('ENTRY_STATE_TEXT', '*');
define('ENTRY_COUNTRY', 'Pa�s:');
define('ENTRY_COUNTRY_ERROR', 'Usted debe seleccionar un pa�s de los Pa�ses del men�.');
define('ENTRY_COUNTRY_TEXT', '*');
define('ENTRY_TELEPHONE_NUMBER', 'N�mero telef�nico:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', 'Su N�mero telef�nico debe contener un m�nimo de' . ENTRY_TELEPHONE_MIN_LENGTH . ' caracteres.');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
define('ENTRY_FAX_NUMBER', 'N�mero de fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Bolet�n de noticias:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Suscrito');
define('ENTRY_NEWSLETTER_NO', 'No suscrito');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Contrase�a:');
define('ENTRY_PASSWORD_ERROR', 'Su Contrase�a debe contener un m�nimo de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.');
define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', 'La Confirmaci�n de Contrase�a debe concordar con su Contrase�a.');
define('ENTRY_PASSWORD_TEXT', '*');
define('ENTRY_PASSWORD_CONFIRMATION', 'Confirmaci�n de Contrase�a:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT', 'Contrase�a actual:');
define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
define('ENTRY_PASSWORD_CURRENT_ERROR', 'Su Contrase�a debe contener un m�nimo de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.');
define('ENTRY_PASSWORD_NEW', 'Nueva Contrase�a:');
define('ENTRY_PASSWORD_NEW_TEXT', '*');
define('ENTRY_PASSWORD_NEW_ERROR', 'Su nueva Contrase�a debe contener un m�nimo de ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.');
define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', 'La Confirmaci�n de Contrase�a debe concordar con su nueva Contrase�a.');
define('PASSWORD_HIDDEN', '--HIDDEN--');

define('FORM_REQUIRED_INFORMATION', '* Informaci�n requerida');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'P�ginas de Resultado:');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> products)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> orders)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> reviews)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> new products)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> specials)');

define('PREVNEXT_TITLE_FIRST_PAGE', 'Primera P�gina');
define('PREVNEXT_TITLE_PREVIOUS_PAGE', 'P�gina Anterior');
define('PREVNEXT_TITLE_NEXT_PAGE', 'P�gina siguiente');
define('PREVNEXT_TITLE_LAST_PAGE', '�ltima P�gina');
define('PREVNEXT_TITLE_PAGE_NO', 'Page %d');
define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', 'Previous Set of %d Pages');
define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', 'Next Set of %d Pages');
define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;FIRST');
define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;Prev]');
define('PREVNEXT_BUTTON_NEXT', '[Next&nbsp;&gt;&gt;]');
define('PREVNEXT_BUTTON_LAST', 'LAST&gt;&gt;');

define('IMAGE_BUTTON_ADD_ADDRESS', 'A�ada Direcci�n');
define('IMAGE_BUTTON_ADDRESS_BOOK', 'Libro de direcciones');
define('IMAGE_BUTTON_BACK', 'Detr�s');
define('IMAGE_BUTTON_BUY_NOW', 'Comprar Ahora');
define('IMAGE_BUTTON_CHANGE_ADDRESS', 'Cambiar direcci�n');
define('IMAGE_BUTTON_CHECKOUT', 'Chequear');
define('IMAGE_BUTTON_CONFIRM_ORDER', 'Confirme Orden');
define('IMAGE_BUTTON_CONTINUE', 'Continuar');
define('IMAGE_BUTTON_CONTINUE_SHOPPING', 'Continue Comprando');
define('IMAGE_BUTTON_DELETE', 'Borrar');
define('IMAGE_BUTTON_EDIT_ACCOUNT', 'Editar Cuenta');
define('IMAGE_BUTTON_HISTORY', 'Historia de Pedido');
define('IMAGE_BUTTON_LOGIN', 'Entrar');
define('IMAGE_BUTTON_IN_CART', 'A�adir al Carrito');
define('IMAGE_BUTTON_NOTIFICATIONS', 'Notificaciones');
define('IMAGE_BUTTON_QUICK_FIND', 'Hallazgo R�pido');
define('IMAGE_BUTTON_REMOVE_NOTIFICATIONS', 'Quite Notificaciones');
define('IMAGE_BUTTON_REVIEWS', 'Resumenes');
define('IMAGE_BUTTON_SEARCH', 'Buscar');
define('IMAGE_BUTTON_SHIPPING_OPTIONS', 'Opciones de Transporte');
define('IMAGE_BUTTON_TELL_A_FRIEND', 'Dile a un Amigo');
define('IMAGE_BUTTON_UPDATE', 'Actualizar');
define('IMAGE_BUTTON_UPDATE_CART', 'Actualizar Carrito');
define('IMAGE_BUTTON_WRITE_REVIEW', 'Escriba Resumen');

define('SMALL_IMAGE_BUTTON_DELETE', 'Borrar');
define('SMALL_IMAGE_BUTTON_EDIT', 'Editar');
define('SMALL_IMAGE_BUTTON_VIEW', 'Ver');

define('ICON_ARROW_RIGHT', 'mas');
define('ICON_CART', 'En Carrito');
define('ICON_ERROR', 'Error');
define('ICON_SUCCESS', 'Exitoso');
define('ICON_WARNING', 'Advertencia');

// BOF: MOD - CATALOG_PRODUCTS_WITH_IMAGES_mod
  define('BOX_CATALOG_PRODUCTS_WITH_IMAGES', 'Catalogo Imprimible');
define('IMAGE_BUTTON_UPSORT', 'Sort Asending');
define('IMAGE_BUTTON_DOWNSORT', 'Sort Desending');
// EOF: MOD - CATALOG_PRODUCTS_WITH_IMAGES_mod

//2 LINES ADDED: MOD - Down For Maintenance
define('TEXT_BEFORE_DOWN_FOR_MAINTENANCE', 'NOTA: Este sitio web estar� abajo por mantenimiento: ');
define('TEXT_ADMIN_DOWN_FOR_MAINTENANCE', 'NOTA: el sitio web est� actualmente Abajo por Mantenimiento al p�blico');

define('TEXT_GREETING_PERSONAL', 'Bienvenido de nuevo <span class="greetUser">%s!</span> Quisiera Ud ver que <a href="%s"><u>nuevos productos</u></a> est�n disponible para comprar?');
define('TEXT_GREETING_PERSONAL_RELOGON', '<small>Si usted no es %s, por favor <a href="%s"><u>reg�strese en</u></a> con su informaci�n de cuenta.</small>');
define('TEXT_GREETING_GUEST', 'Bienvemido <span class="greetUser">Usuario!</span> Le gustaria <a href="%s"><u>reg�strarse en</u></a>? O usted prefiere <a href="%s"><u>crear una cuenta</u></a>?');

define('TEXT_SORT_PRODUCTS', 'Rotar Productos ');
define('TEXT_DESCENDINGLY', 'descendiendo');
define('TEXT_ASCENDINGLY', 'ascendiendo');
define('TEXT_BY', ' por ');

define('TEXT_REVIEW_BY', 'por %s');
define('TEXT_REVIEW_WORD_COUNT', '%s palabras');
define('TEXT_REVIEW_RATING', 'Rating: %s [%s]');
define('TEXT_REVIEW_DATE_ADDED', 'Fecha A�adida: %s');
define('TEXT_NO_REVIEWS', 'No hay actualmente ningun resumen de producto.');

define('TEXT_NO_NEW_PRODUCTS', 'No hay actualmente ningun producto.');

define('TEXT_UNKNOWN_TAX_RATE', 'Tasa impositiva desconocida');

define('TEXT_REQUIRED', '<span class="errorText">Requerido</span>');

// LINE ADDED: Country-State Selector
define ('DEFAULT_COUNTRY', '223');

define('ERROR_TEP_MAIL', '<font face="Verdana, Arial" size="2" color="#ff0000"><b><small>TEP ERROR:</small> No puede enviar el correo electr�nico por el servidor especificado SMTP. Por favor compruebe su ajuste de php.ini y corrija al servidor SMTP si fuera necesario.</b></font>');
define('WARNING_INSTALL_DIRECTORY_EXISTS', 'Advertencia: El directorio de instalaci�n existe en: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/instalar. Por favor quite este directorio para motivos de seguridad.');
define('WARNING_CONFIG_FILE_WRITEABLE', 'Warning: I am able to write to the configuration file: ' . dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php. This is a potential security risk - please set the right user permissions on this file.');
define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', 'Advertencia: El directorio de sesiones no existe: ' . tep_session_save_path() . '. Las sesiones no trabajar�n hasta que este directorio sea creado.');
define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', 'Warning: I am not able to write to the sessions directory: ' . tep_session_save_path() . '. Sessions will not work until the right user permissions are set.');
define('WARNING_SESSION_AUTO_START', 'Advertencia: la sesi�n auto_start es permitida - por favor incapacite este rasgo de php en php.ini y comience de nuevo al servidor de web.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Advertencia: El directorio de productos transmitible no existe: ' . DIR_FS_DOWNLOAD . '. Productos transmitibles no trabajar�n hasta que este directorio sea v�lido.');

define('TEXT_CCVAL_ERROR_INVALID_DATE', 'La fecha de vencimiento particip� en la tarjeta de cr�dito es inv�lido.<br>Por favor compruebe la fecha e intentelo otra vez.');
define('TEXT_CCVAL_ERROR_INVALID_NUMBER', 'El n�mero de la tarjeta de cr�dito entrado es inv�lido. <br> Por favor compruebe el n�mero y el intento otra vez.');
define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', 'Los cuatro primeros d�gitos del n�mero entrado son: %s<br>Si aquel n�mero es correcto, no aceptamos aquel tipo de tarjeta de cr�dito.<br>Si esto se equivoca, por favor intente otra vez.');

/*
  The following copyright announcement can only be
  appropriately modified or removed if the layout of
  the site theme has been modified to distinguish
  itself from the default osCMax/osCDox-copyrighted
  theme.

  For more information please go to the osCMax
  support site:

  http://oscdox.com/

  Please leave this comment intact together with the
  following copyright announcement.
*/
define('FOOTER_TEXT_BODY', 'Copyright &copy; 2005 <a href="http://oscdox.com">osCDox</a>, <a href="http://aabox.com">AABox Web Hosting</a>,<br>
Powered by <a href="http://aabox.com/ms2-max.html" target="_blank">osCMax 1.7</a>');
// ADDED LINE: MOD - Gift and Voucher
require(DIR_WS_LANGUAGES . 'add_ccgvdc_english.php');

// BOF: MOD - Checkout Without Account
define('IMAGE_BUTTON_CREATE_ACCOUNT', 'Create Account');
define('NAV_ORDER_INFO', 'Order Info');
// EOF: MOD - Checkout Without Account

// BOF: MOD - Article Manager
define('BOX_HEADING_ARTICLES', 'Articles');
define('BOX_ALL_ARTICLES', 'All Articles');
define('BOX_NEW_ARTICLES', 'New Articles');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> articles)');
define('TEXT_DISPLAY_NUMBER_OF_ARTICLES_NEW', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> new articles)');
define('TABLE_HEADING_AUTHOR', 'Author');
define('TABLE_HEADING_ABSTRACT', 'Abstract');
define('BOX_HEADING_AUTHORS', 'Articles by Author');
define('NAVBAR_TITLE_DEFAULT', 'Articles');
// EOF: MOD - Article Manager

// BOF: MOD - Login Box My Account
define('BOX_HEADING_LOGIN_BOX', 'Sign in');
define('BOX_LOGINBOX_EMAIL', '<center>E-mail address:</center>');
define('BOX_LOGINBOX_PASSWORD', '<center>Password:<center>');
define('BOX_LOGINBOX_TEXT_NEW', '<center>Create an Account<center>');
define('BOX_LOGINBOX_NEW', '<center><u>create an account</u><center>');
define('BOX_LOGINBOX_FORGOT_PASSWORD', '<center><u>(forgotten)</u></center><br>');
define('IMAGE_BUTTON_LOGIN', 'Login');
define('BOX_HEADING_LOGIN_BOX_MY_ACCOUNT','My account info');
define('LOGIN_BOX_ACCOUNT_EDIT','Edit account info.');
define('LOGIN_BOX_ACCOUNT_HISTORY','Account history');
define('LOGIN_BOX_ADDRESS_BOOK','My address book');
define('LOGIN_BOX_PRODUCT_NOTIFICATIONS','Product notifications');
define('LOGIN_BOX_MY_ACCOUNT','General information');
define('LOGIN_BOX_LOGOFF','Log off');
define('LOGIN_BOX_PRODUCTS_NEW','New Products');
// EOF: MOD - Login Box My Account

// BOF: MOD - Wish List 2.3 box text in includes/boxes/wishlist.php
define('BOX_HEADING_CUSTOMER_WISHLIST', 'My Wishlist');
define('BOX_WISHLIST_EMPTY', 'You have no items on your Wishlist');
define('IMAGE_BUTTON_ADD_WISHLIST', 'Add to Wishlist');
define('TEXT_WISHLIST_COUNT', 'Currently %s items are on your Wishlist.');
define('TEXT_DISPLAY_NUMBER_OF_WISHLIST', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> items on your wishlist)');
define('BOX_HEADING_CUSTOMER_WISHLIST_HELP', 'Wishlist Help');
define('BOX_HEADING_SEND_WISHLIST', 'Send your Wishlist');
define('BOX_TEXT_MOVE_TO_CART', 'Move to Cart');
define('BOX_TEXT_DELETE', 'Delete');
// EOF: MOD - Wish List 2.3 box text in includes/boxes/wishlist.php
?>