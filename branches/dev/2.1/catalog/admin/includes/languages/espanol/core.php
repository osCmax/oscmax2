<?php
/*
$Id: core.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2008 osCMax

  Released under the GNU General Public License
*/

// BOF: MOD - Admin w/levels
// header text in includes/header.php
define('HEADER_TITLE_ACCOUNT', 'Mi cuenta');
define('HEADER_TITLE_LOGOFF', 'Salir');

// Admin Account
define('BOX_HEADING_MY_ACCOUNT', 'Mi cuenta');

// configuration box text in includes/boxes/administrator.php
define('BOX_HEADING_ADMINISTRATOR', 'Administrador');
define('BOX_ADMINISTRATOR_MEMBERS', 'Grupo de Miembros');
define('BOX_ADMINISTRATOR_MEMBER', 'Miembros');
define('BOX_ADMINISTRATOR_BOXES', 'Acceso a Archivos');

// images
define('IMAGE_FILE_PERMISSION', 'Permiso de Archivos');
define('IMAGE_GROUPS', 'Lista de Grupos');
define('IMAGE_INSERT_FILE', 'Ingresar Archivo');
define('IMAGE_MEMBERS', 'Lista de Miembros');
define('IMAGE_NEW_GROUP', 'Nuevo Grupo');
define('IMAGE_NEW_MEMBER', 'Nuevo Miembro');
define('IMAGE_NEXT', 'Siguiente');

// constants for use in tep_prev_next_display function
define('TEXT_DISPLAY_NUMBER_OF_FILENAMES', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> Nombre de Archivos)');
define('TEXT_DISPLAY_NUMBER_OF_MEMBERS', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> Miembros)');
// EOF: MOD - Admin w/levels

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat6.0 I used 'es_ES'
// on FreeBSD 4.0 I use 'es_ES.ISO_8859-1'
// this may not work under win32 environments..
setlocale(LC_TIME, 'es_ES.ISO_8859-1');
define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y');  // this is used for date()
define('PHP_DATE_TIME_FORMAT', 'd/m/Y H:i:s'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

// LINE ADDED: MOD -Separate Pricing per Customer
define('ENTRY_CUSTOMERS_GROUP_NAME', 'Grupo de Clientes:');

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

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="es"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', PROJECT_VERSION);

// BOF: MOD - ORDER EDIT
// Create account & order
define('BOX_HEADING_MANUAL_ORDER', 'Manual Orders');
define('BOX_MANUAL_ORDER_CREATE_ACCOUNT', 'Create Account');
define('BOX_MANUAL_ORDER_CREATE_ORDER', 'Create Order');

// pull down default text
define('PULL_DOWN_DEFAULT', 'Please Select');
define('TYPE_BELOW', 'Type Below');

define('JS_ERROR', 'Errors have occured during the process of your form!\nPlease make the following corrections:\n\n');

define('JS_GENDER', '* The \'Gender\' value must be chosen.\n');
define('JS_FIRST_NAME', '* The \'First Name\' entry must have at least ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' characters.\n');
define('JS_LAST_NAME', '* The \'Last Name\' entry must have at least ' . ENTRY_LAST_NAME_MIN_LENGTH . ' characters.\n');
define('JS_DOB', '* The \'Date of Birth\' entry must be in the format: xx/xx/xxxx (month/day/year).\n');
define('JS_EMAIL_ADDRESS', '* The \'E-Mail Address\' entry must have at least ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' characters.\n');
define('JS_ADDRESS', '* The \'Street Address\' entry must have at least ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' characters.\n');
define('JS_POST_CODE', '* The \'Post Code\' entry must have at least ' . ENTRY_POSTCODE_MIN_LENGTH . ' characters.\n');
define('JS_CITY', '* The \'City\' entry must have at least ' . ENTRY_CITY_MIN_LENGTH . ' characters.\n');
define('JS_STATE', '* The \'State\' entry must be selected.\n');
define('JS_STATE_SELECT', '-- Select Above --');
define('JS_ZONE', '* The \'State\' entry must be selected from the list for this country.\n');
define('JS_COUNTRY', '* The \'Country\' entry must be selected.\n');
define('JS_TELEPHONE', '* The \'Telephone Number\' entry must have at least ' . ENTRY_TELEPHONE_MIN_LENGTH . ' characters.\n');
define('JS_PASSWORD', '* The \'Password\' and \'Confirmation\' entries must match and have at least ' . ENTRY_PASSWORD_MIN_LENGTH . ' characters.\n');

define('CATEGORY_COMPANY', 'Company Details');
define('CATEGORY_PERSONAL', 'Personal Details');
define('CATEGORY_ADDRESS', 'Address');
define('CATEGORY_CONTACT', 'Contact Information');
define('CATEGORY_OPTIONS', 'Options');
define('CATEGORY_PASSWORD', 'Password');
define('CATEGORY_CORRECT', 'If this is the right customer, press the Confirm button below.');
define('ENTRY_CUSTOMERS_ID', 'ID:');
define('ENTRY_CUSTOMERS_ID_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_COMPANY', 'Company Name:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Gender:');
define('ENTRY_GENDER_ERROR', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_GENDER_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_FIRST_NAME', 'First Name:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_FIRST_NAME_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_LAST_NAME', 'Last Name:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_LAST_NAME_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_DATE_OF_BIRTH', 'Date of Birth:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<small><font color="#FF0000">(eg. 05/21/1970)</font></small>');
define('ENTRY_DATE_OF_BIRTH_TEXT', '&nbsp;<small>(eg. 05/21/1970) <font color="#AABBDD">required</font></small>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail Address:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<small><font color="#FF0000">Your email address doesn\'t appear to be valid!</font></small>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<small><font color="#FF0000">email address already exists!</font></small>');
define('ENTRY_EMAIL_ADDRESS_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_STREET_ADDRESS', 'Street Address:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_STREET_ADDRESS_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_SUBURB', 'Suburb:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Post Code:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_POST_CODE_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_CITY', 'City:'); //Changed for osCMax bug #27
define('ENTRY_CITY_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_CITY_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_CITY_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_STATE', 'State/Province:');
define('ENTRY_STATE_ERROR', '&nbsp;<small><font color="#FF0000">required</font></small>');
define('ENTRY_STATE_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_COUNTRY', 'Country:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_COUNTRY_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_TELEPHONE_NUMBER', 'Telephone Number:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_FAX_NUMBER', 'Fax Number:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Subscribed');
define('ENTRY_NEWSLETTER_NO', 'Unsubscribed');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Password:');
define('ENTRY_PASSWORD_CONFIRMATION', 'Password Confirmation:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('ENTRY_PASSWORD_ERROR', '&nbsp;<small><font color="#FF0000">min ' . ENTRY_PASSWORD_MIN_LENGTH . ' chars</font></small>');
define('ENTRY_PASSWORD_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');
define('PASSWORD_HIDDEN', '--HIDDEN--');
// EOF: MOD - ORDER EDIT

// header text in includes/header.php
define('HEADER_TITLE_TOP', 'Administraci&oacute;n');
define('HEADER_TITLE_SUPPORT_SITE', 'osCMax');
define('HEADER_TITLE_ONLINE_CATALOG', 'Cat&aacute;logo');
define('HEADER_TITLE_ADMINISTRATION', 'Administraci&oacute;n');
define('HEADER_TITLE_OSCDOX', 'osCDox.com');
define('HEADER_TITLE_AABOX', 'osCMax');

// text for gender
define('MALE', 'Var&oacute;n');
define('FEMALE', 'Mujer');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/aaaa');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configuraci&oacute;n');
define('BOX_CONFIGURATION_MYSTORE', 'Mi Tienda');
define('BOX_CONFIGURATION_LOGGING', 'Registro');
define('BOX_CONFIGURATION_CACHE', 'Cach&eacute;');

// BOF: Added for super-friendly admin menu:
define('BOX_CONFIGURATION_MIN_VALUES', 'Min Values');
define('BOX_CONFIGURATION_MAX_VALUES', 'Max Values');
define('BOX_CONFIGURATION_IMAGES', 'Images');
define('BOX_CONFIGURATION_CUSTOMER_DETAILS', 'Customer Details');
define('BOX_CONFIGURATION_SHIPPING', 'Shipping');
define('BOX_CONFIGURATION_PAGE_CACHE', 'Page Cache Settings');
define('BOX_CONFIGURATION_PRODUCT_LISTING', 'Product Listing');
define('BOX_CONFIGURATION_PRODUCT_INFO', 'Product Information');
define('BOX_CONFIGURATION_EMAIL', 'Email');
define('BOX_CONFIGURATION_DOWNLOAD', 'Download');
define('BOX_CONFIGURATION_GZIP', 'GZip');
define('BOX_CONFIGURATION_SESSIONS', 'Sessions');
define('BOX_CONFIGURATION_STOCK', 'Stock');
define('BOX_CONFIGURATION_WYSIWYG', 'CK Editor');
define('BOX_CONFIGURATION_AFFILIATE', 'Affiliate Program');
define('BOX_CONFIGURATION_ACCOUNTS', 'Accounts');
define('BOX_CONFIGURATION_MAINTENANCE', 'Site Maintenance');
define('BOX_CONFIGURATION_MOPICS', 'Dynamic MoPics');
define('BOX_CONFIGURATION_PRINT', 'Printable Catalog');
define('BOX_CONFIGURATION_SEO', 'SEO URLs');
// EOF: Added for super-friendly admin menu:

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'M&oacute;dulos');
define('BOX_MODULES_PAYMENT', 'Pago');
define('BOX_MODULES_SHIPPING', 'Env&iacute;o');
define('BOX_MODULES_ORDER_TOTAL', 'Totalizaci&oacute;n');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Cat&aacute;logo');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categorias/Productos');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Atributos');
define('BOX_CATALOG_MANUFACTURERS', 'Fabricantes');
define('BOX_CATALOG_REVIEWS', 'Comentarios');
define('BOX_CATALOG_SPECIALS', 'Ofertas');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Pr&oacute;ximamente');

// 2 LINES ADDED - EasyPopulate and Attrib Manager
define('BOX_CATALOG_EASYPOPULATE', 'Facilpublicacion');
define('BOX_CATALOG_ATTRIBUTE_MANAGER', 'Administrador de Atributos');
// BOF: Added INFO Pages
define('BOX_CATALOG_DEFINE_MAINPAGE', 'Define MainPage');
define('BOX_CATALOG_DEFINE_CONDITIONS', 'Conditions Page');
define('BOX_CATALOG_DEFINE_PRIVACY', 'Privacy Page');
define('BOX_CATALOG_DEFINE_SHIPPING', 'Shipping Page');
// EOF: Added INFO Pages

// customers box text in includes/boxes/customers.php
define('BOX_HEADING_CUSTOMERS', 'Clientes');
define('BOX_CUSTOMERS_CUSTOMERS', 'Clientes');
define('BOX_CUSTOMERS_ORDERS', 'Pedidos');
// LINE ADDED - Edit customer order
define('BOX_CUSTOMERS_EDIT_ORDERS', 'Editar Ordenes');
// BOF: MOD - Separate Pricing Per Customer
define('BOX_CUSTOMERS_GROUPS', 'Customers Groups');
// EOF: MOD - Separate Pricing Per Customer
// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Zonas/Impuestos');
define('BOX_TAXES_COUNTRIES', 'Paises');
define('BOX_TAXES_ZONES', 'Provincias');
define('BOX_TAXES_GEO_ZONES', 'Zonas de Impuestos');
define('BOX_TAXES_TAX_CLASSES', 'Tipos de Impuestos');
define('BOX_TAXES_TAX_RATES', 'Impuestos');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Informes');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Los Mas Vistos');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Los Mas Comprados');
define('BOX_REPORTS_ORDERS_TOTAL', 'Total por Cliente');
define('BOX_REPORTS_CREDITS', 'Customer Credits Report');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Herramientas');
define('BOX_TOOLS_BACKUP', 'Copia de Seguridad');
define('BOX_TOOLS_BANNER_MANAGER', 'Banners');
// LINE ADDED: MOD - Batch Print Center
define('BOX_TOOLS_BATCH_CENTER', 'Batch Print Center');
define('BOX_TOOLS_CACHE', 'Control de Cach&eacute;');
define('BOX_TOOLS_MAIL', 'Enviar Email');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Boletines');
define('BOX_TOOLS_SERVER_INFO', 'Informaci&oacute;n');
define('BOX_TOOLS_WHOS_ONLINE', 'Usuarios conectados');
define('BOX_TOOLS_PACKAGING', 'Envases');
define('BOX_TOOLS_UPS_BOXES_USED', 'UPS cajas usadas');
define('BOX_TOOLS_QUICK_LINKS', 'Rápida Enlaces');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Localizaci&oacute;n');
define('BOX_LOCALIZATION_CURRENCIES', 'Monedas');
define('BOX_LOCALIZATION_LANGUAGES', 'Idiomas');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Estado Pedidos');

// ADDED 2 LINE- recover cart box text
define('BOX_REPORTS_RECOVER_CART_SALES', 'Recover Carts');
define('BOX_TOOLS_RECOVER_CART', 'Recover Carts');

// LINE ADDED - Monthly Tax-Sales totals
define('BOX_REPORTS_MONTHLY_SALES', 'Monthly Sales/Tax');

// LINE ADDED - InfoBox Admin in includes/boxes/info_boxes.php
define('BOX_HEADING_BOXES', 'Infobox Admin');

// javascript messages
define('JS_ERROR', 'Ha habido errores procesando su formulario!\nPor favor, haga las siguientes modificaciones:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* El atributo necesita un precio\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* El atributo necesita un prefijo para el precio\n');

define('JS_PRODUCTS_NAME', '* El producto necesita un nombre\n');
define('JS_PRODUCTS_DESCRIPTION', '* El producto necesita una descripci&oacute;n\n');
define('JS_PRODUCTS_PRICE', '* El producto necesita un precio\n');
define('JS_PRODUCTS_WEIGHT', '* Debe especificar el peso del producto\n');
define('JS_PRODUCTS_QUANTITY', '* Debe especificar la cantidad\n');
define('JS_PRODUCTS_MODEL', '* Debe especificar el modelo\n');
define('JS_PRODUCTS_IMAGE', '* Debe suministrar una imagen\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Debe rellenar el precio\n');

define('JS_GENDER', '* Debe elegir un \'Sexo\'.\n');
define('JS_FIRST_NAME', '* El \'Nombre\' debe tener al menos ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' letras.\n');
define('JS_LAST_NAME', '* El \'Apellido\' debe tener al menos ' . ENTRY_LAST_NAME_MIN_LENGTH . ' letras.\n');
define('JS_DOB', '* La \'Fecha de Nacimiento\' debe tener el formato: xx/xx/xxxx (dia/mes/a&ntilde;o).\n');
define('JS_EMAIL_ADDRESS', '* El \'E-Mail\' debe tener al menos ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' letras.\n');
define('JS_ADDRESS', '* El \'Domicilio\' debe tener al menos ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' letras.\n');
define('JS_POST_CODE', '* El \'C&oacute;digo Postal\' debe tener al menos ' . ENTRY_POSTCODE_MIN_LENGTH . ' letras.\n');
define('JS_CITY', '* La \'Ciudad\' debe tener al menos ' . ENTRY_CITY_MIN_LENGTH . ' letras.\n');
define('JS_STATE', '* Debe indicar la \'Provincia\'.\n');
define('JS_STATE_SELECT', '-- Seleccione Arriba --');
define('JS_ZONE', '* La \'Provincia\' se debe seleccionar de la lista para este pais.');
define('JS_COUNTRY', '* Debe seleccionar un \'Pais\'.\n');
define('JS_TELEPHONE', '* El \'Telefono\' debe tener al menos ' . ENTRY_TELEPHONE_MIN_LENGTH . ' letras.\n');
define('JS_PASSWORD', '* La \'Contrase&ntilde;a\' y \'Confirmaci&oacute;n\' deben ser iguales y tener al menos ' . ENTRY_PASSWORD_MIN_LENGTH . ' letras.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'El n&uacute;mero de pedido %s no existe!');

define('CATEGORY_PERSONAL', 'Personal');
define('CATEGORY_ADDRESS', 'Domicilio');
define('CATEGORY_CONTACT', 'Contacto');
define('CATEGORY_COMPANY', 'Empresa');
define('CATEGORY_OPTIONS', 'Opciones');

define('ENTRY_GENDER', 'Sexo:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">obligatorio</span>');
define('ENTRY_FIRST_NAME', 'Nombre:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' letras</span>');
define('ENTRY_LAST_NAME', 'Apellidos:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' letras</span>');
define('ENTRY_DATE_OF_BIRTH', 'Fecha de Nacimiento:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(p.ej. 21/05/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' letras</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">Su Email no parece correcto!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">email ya existe!</span>');
define('ENTRY_COMPANY', 'Nombre empresa:');
define('ENTRY_COMPANY_ERROR', '');

// BOF: MOD - Separate Pricing Per Customer
define('ENTRY_COMPANY_TAX_ID', 'Company\'s tax id number:');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
define('ENTRY_CUSTOMERS_GROUP_REQUEST_AUTHENTICATION', 'Switch off alert for authentication:');
define('ENTRY_CUSTOMERS_GROUP_RA_NO', 'Alert off');
define('ENTRY_CUSTOMERS_GROUP_RA_YES', 'Alert on');
define('ENTRY_CUSTOMERS_GROUP_RA_ERROR', '');
// EOF: MOD - Separate Pricing Per Customer

define('ENTRY_STREET_ADDRESS', 'Direcci&oacute;n:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' letras</span>');
define('ENTRY_SUBURB', 'Urbanización:');
define('ENTRY_SUBURB', '');
define('ENTRY_POST_CODE', 'C&oacute;digo Postal:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' letras</span>');
define('ENTRY_CITY', 'Poblaci&oacute;n:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' letras</span>');
define('ENTRY_STATE', 'Provincia:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">obligatorio</span>');
define('ENTRY_COUNTRY', 'Pa&iacute;s:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Tel&eacute;fono:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' letras</span>');
define('ENTRY_FAX_NUMBER', 'Fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Bolet&iacute;n:');
define('ENTRY_NEWSLETTER_YES', 'suscrito');
define('ENTRY_NEWSLETTER_NO', 'no suscrito');
define('ENTRY_NEWSLETTER_ERROR', '');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Enviando E-Mail');
define('IMAGE_BACK', 'Volver');
define('IMAGE_BACKUP', 'Copiar');
define('IMAGE_CANCEL', 'Cancelar');
define('IMAGE_CONFIRM', 'Confirmar');
define('IMAGE_COPY', 'Copiar');
define('IMAGE_COPY_TO', 'Copiar A');
define('IMAGE_DETAILS', 'Detalle');
define('IMAGE_DELETE', 'Eliminar');
define('IMAGE_EDIT', 'Editar');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_FILE_MANAGER', 'Archivos');
define('IMAGE_ICON_STATUS_GREEN', 'Activado');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Activar');
define('IMAGE_ICON_STATUS_RED', 'Desactivado');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Desactivar');
define('IMAGE_ICON_INFO', 'Datos');
define('IMAGE_INSERT', 'Insertar');
define('IMAGE_LOCK', 'Bloqueado');
define('IMAGE_MODULE_INSTALL', 'Instalar M&oacute;dulo');
define('IMAGE_MODULE_REMOVE', 'Quitar M&oacute;dulo');
define('IMAGE_MOVE', 'Mover');
define('IMAGE_NEW_BANNER', 'Nuevo Banner');
define('IMAGE_NEW_CATEGORY', 'Nueva Categoria');
define('IMAGE_NEW_COUNTRY', 'Nuevo Pais');
define('IMAGE_NEW_CURRENCY', 'Nueva Moneda');
define('IMAGE_NEW_FILE', 'Nuevo Fichero');
define('IMAGE_NEW_FOLDER', 'Nueva Carpeta');
define('IMAGE_NEW_LANGUAGE', 'Nueva Idioma');
define('IMAGE_NEW_NEWSLETTER', 'Nuevo Bolet&iacute;n');
define('IMAGE_NEW_PRODUCT', 'Nuevo Producto');
define('IMAGE_NEW_TAX_CLASS', 'Nuevo Tipo de Impuesto');
define('IMAGE_NEW_TAX_RATE', 'Nuevo Impuesto');
define('IMAGE_NEW_TAX_ZONE', 'Nueva Zona');
define('IMAGE_NEW_ZONE', 'Nueva Zona');
define('IMAGE_ORDERS', 'Pedidos');
define('IMAGE_ORDERS_INVOICE', 'Factura');
define('IMAGE_ORDERS_PACKINGSLIP', 'Albar&aacute;n');
define('IMAGE_PREVIEW', 'Ver');
define('IMAGE_RESTORE', 'Restaurar');
define('IMAGE_RESET', 'Resetear');
define('IMAGE_SAVE', 'Grabar');
define('IMAGE_SEARCH', 'Buscar');
define('IMAGE_SELECT', 'Seleccionar');
define('IMAGE_SEND', 'Enviar');
define('IMAGE_SEND_EMAIL', 'Send Email');
define('IMAGE_UNLOCK', 'Desbloqueado');
define('IMAGE_UPDATE', 'Actualizar');
define('IMAGE_UPDATE_CURRENCIES', 'Actualizar Cambio de Moneda');
define('IMAGE_UPLOAD', 'Subir');

define('ICON_CROSS', 'Falso');
define('ICON_CURRENT_FOLDER', 'Directorio Actual');
define('ICON_DELETE', 'Eliminar');
define('ICON_ERROR', 'Error');
define('ICON_FILE', 'Fichero');
define('ICON_FILE_DOWNLOAD', 'Descargar');
define('ICON_FOLDER', 'Carpeta');
define('ICON_LOCKED', 'Bloqueado');
define('ICON_PREVIOUS_LEVEL', 'Nivel Anterior');
define('ICON_PREVIEW', 'Ver');
define('ICON_STATISTICS', 'Estadisticas');
define('ICON_SUCCESS', 'Exito');
define('ICON_TICK', 'Verdadero');
define('ICON_UNLOCKED', 'Desbloqueado');
define('ICON_WARNING', 'Advertencia');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'P&aacute;gina %s de %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> banners)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> paises)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> clientes)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> monedas)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> idiomas)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> fabricantes)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> boletines)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> pedidos)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> estado de pedidos)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> productos)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> productos esperados)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> comentarios)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> ofertas)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> zonas de impuestos)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> porcentajes de impuestos)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> tipos de impuesto)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> zonas)');
define('TEXT_DISPLAY_NUMBER_OF_SHIPMENTS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> envíos)');
define('TEXT_DISPLAY_NUMBER_OF_QUICK_LINKS', 'Viendo del <b>%d</b> al <b>%d</b> (de <b>%d</b> rápido enlaces)');

//BOF: MOD - Catagories Discriptions
define('TEXT_EDIT_CATEGORIES_HEADING_TITLE', 'Titulo del Encabezado de Categorías:');
define('TEXT_EDIT_CATEGORIES_DESCRIPTION', 'Descripción de Categorías:');
//EOF: MOD - Catagories Discriptions

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'predeterminado/a');
define('TEXT_SET_DEFAULT', 'Establecer como predeterminado/a');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Obligatorio</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Error: No hay moneda predeterminada. Por favor establezca una en: Herramientas de Administracion->Localizaci&oacute;n->Monedas');

define('TEXT_CACHE_CATEGORIES', 'Categorias');
define('TEXT_CACHE_MANUFACTURERS', 'Fabricantes');
define('TEXT_CACHE_ALSO_PURCHASED', 'Tambi&eacute;n Han Comprado');

define('TEXT_NONE', '--ninguno--');
define('TEXT_TOP', 'Principio');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Error: Destino no existe.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Error: No se puede escribir en el destino.');
define('ERROR_FILE_NOT_SAVED', 'Error: El archivo subido no se ha guardado.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Error: Extension de fichero no permitida.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Exito: Fichero guardado con &eacute;xito.');
define('WARNING_NO_FILE_UPLOADED', 'Advertencia: No se ha subido ningun archivo.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Warning: Se ha desactivado la subida de archivos en el fichero de configuraci&oacute;n php.ini.');

// LINE ADDED - XSell
define('BOX_CATALOG_XSELL_PRODUCTS', 'Productos cruzados en la venta'); // X-Sell

// BOF: MOD - Article Manager
define('BOX_HEADING_ARTICLES', 'Article Manager');
define('BOX_TOPICS_ARTICLES', 'Topics/Articles');
define('BOX_ARTICLES_CONFIG', 'Configuration');
define('BOX_ARTICLES_AUTHORS', 'Authors');
define('BOX_ARTICLES_REVIEWS', 'Reviews');
define('BOX_ARTICLES_XSELL', 'Cross-Sell Articles');
define('IMAGE_NEW_TOPIC', 'New Topic');
define('IMAGE_NEW_ARTICLE', 'New Article');
define('TEXT_DISPLAY_NUMBER_OF_AUTHORS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> authors)');
// EOF: MOD - Article Manager

// BOF: MOD - FedEx
define('IMAGE_ORDERS_SHIP', 'Ship Package');
define('IMAGE_ORDERS_FEDEX_LABEL','View or Print FedEx Shipping Label');
define('IMAGE_ORDERS_TRACK','Track FedEx Shipment');
define('IMAGE_ORDERS_CANCEL_SHIPMENT','Cancel FedEx Shipment');
define('BOX_SHIPPING_MANIFEST','Fedx Shipping Manifest');
// EOF: MOD - FedEx
?>