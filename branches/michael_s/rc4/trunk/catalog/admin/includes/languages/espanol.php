<?php
/*
$Id: espanol.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

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
    return substr($date, 3, 2) . substr($date, 0, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 0, 2) . substr($date, 3, 2);
  }
}

// Global entries for the <html> tag
define('HTML_PARAMS','dir="ltr" lang="es"');

// charset for web pages and emails
define('CHARSET', 'iso-8859-1');

// page title
define('TITLE', 'osCMax v2.0');

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
define('HEADER_TITLE_TOP', 'Admin');
define('HEADER_TITLE_SUPPORT_SITE', 'osCommerce');
define('HEADER_TITLE_ONLINE_CATALOG', 'Catalogo');
define('HEADER_TITLE_ADMINISTRATION', 'Admin');
define('HEADER_TITLE_OSCDOX', 'osCDox.com');
define('HEADER_TITLE_AABOX', 'osCMax');

// text for gender
define('MALE', 'Hombre');
define('FEMALE', 'Mujer');

// text for date of birth example
define('DOB_FORMAT_STRING', 'mm/dd/yyyy');

// configuration box text in includes/boxes/configuration.php
define('BOX_HEADING_CONFIGURATION', 'Configuración');
define('BOX_CONFIGURATION_MYSTORE', 'Mi Almacen');
define('BOX_CONFIGURATION_LOGGING', 'Entrar');
define('BOX_CONFIGURATION_CACHE', 'Cache');

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
define('BOX_CONFIGURATION_WYSIWYG', 'WYSIWYG Editor');
define('BOX_CONFIGURATION_AFFILIATE', 'Affiliate Program');
define('BOX_CONFIGURATION_ACCOUNTS', 'Accounts');
define('BOX_CONFIGURATION_MAINTENANCE', 'Site Maintenance');
define('BOX_CONFIGURATION_MOPICS', 'Dynamic MoPics');
define('BOX_CONFIGURATION_PRINT', 'Printable Catalog');
define('BOX_CONFIGURATION_SEO', 'SEO URLs');
// EOF: Added for super-friendly admin menu:

// modules box text in includes/boxes/modules.php
define('BOX_HEADING_MODULES', 'Modulos');
define('BOX_MODULES_PAYMENT', 'Pago');
define('BOX_MODULES_SHIPPING', 'Envio');
define('BOX_MODULES_ORDER_TOTAL', 'Total de Orden');

// categories box text in includes/boxes/catalog.php
define('BOX_HEADING_CATALOG', 'Catalogo');
define('BOX_CATALOG_CATEGORIES_PRODUCTS', 'Categorias/Productos');
define('BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES', 'Atributos de Productos');
define('BOX_CATALOG_MANUFACTURERS', 'Manofacturas');
define('BOX_CATALOG_REVIEWS', 'Revisiones');
define('BOX_CATALOG_SPECIALS', 'Especiales');
define('BOX_CATALOG_PRODUCTS_EXPECTED', 'Expedicion de Productos');
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
define('BOX_CUSTOMERS_ORDERS', 'Ordenes');
// LINE ADDED - Edit customer order
define('BOX_CUSTOMERS_EDIT_ORDERS', 'Editar Ordenes');
// BOF: MOD - Separate Pricing Per Customer
define('BOX_CUSTOMERS_GROUPS', 'Customers Groups');
// EOF: MOD - Separate Pricing Per Customer
// taxes box text in includes/boxes/taxes.php
define('BOX_HEADING_LOCATION_AND_TAXES', 'Localizaciones / Impuestos');
define('BOX_TAXES_COUNTRIES', 'Paises');
define('BOX_TAXES_ZONES', 'Zonas');
define('BOX_TAXES_GEO_ZONES', 'Impuesto por Zonas');
define('BOX_TAXES_TAX_CLASSES', 'Clases de Impuesto');
define('BOX_TAXES_TAX_RATES', 'Tarifas de Impuesto');

// reports box text in includes/boxes/reports.php
define('BOX_HEADING_REPORTS', 'Reportes');
define('BOX_REPORTS_PRODUCTS_VIEWED', 'Productos Visualizados');
define('BOX_REPORTS_PRODUCTS_PURCHASED', 'Productos Comprados');
define('BOX_REPORTS_ORDERS_TOTAL', 'Ordenes Totales por Clientes');

// tools text in includes/boxes/tools.php
define('BOX_HEADING_TOOLS', 'Herramientas');
define('BOX_TOOLS_BACKUP', 'Respaldo Base de Datos');
define('BOX_TOOLS_BANNER_MANAGER', 'Administrador de Banners');
// LINE ADDED: MOD - Batch Print Center
define('BOX_TOOLS_BATCH_CENTER', 'Batch Print Center');
define('BOX_TOOLS_CACHE', 'Control del Cache');
define('BOX_TOOLS_DEFINE_LANGUAGE', 'Definir Lenguaje');
define('BOX_TOOLS_FILE_MANAGER', 'Administrador de Archivo');
define('BOX_TOOLS_MAIL', 'Enviar Correo');
define('BOX_TOOLS_NEWSLETTER_MANAGER', 'Administrador del Boletin de Noticias');
define('BOX_TOOLS_SERVER_INFO', 'Informacion del Servidor');
define('BOX_TOOLS_WHOS_ONLINE', 'Quien esta en linea');

// localizaion box text in includes/boxes/localization.php
define('BOX_HEADING_LOCALIZATION', 'Localizacion');
define('BOX_LOCALIZATION_CURRENCIES', 'Concurrencias');
define('BOX_LOCALIZATION_LANGUAGES', 'Lenguajes');
define('BOX_LOCALIZATION_ORDERS_STATUS', 'Estatus de las Ordenes');

// ADDED 2 LINE- recover cart box text
define('BOX_REPORTS_RECOVER_CART_SALES', 'Recover Carts');
define('BOX_TOOLS_RECOVER_CART', 'Recover Carts');

// LINE ADDED - Monthly Tax-Sales totals
define('BOX_REPORTS_MONTHLY_SALES', 'Monthly Sales/Tax');

// LINE ADDED - InfoBox Admin in includes/boxes/info_boxes.php
define('BOX_HEADING_BOXES', 'Infobox Admin');

// javascript messages
define('JS_ERROR', 'Han ocurrido errores durante el proceso en el formulario!\nPor favor realice las siguientes correcciones:\n\n');

define('JS_OPTIONS_VALUE_PRICE', '* El nuevo producto necesita un nuevo valor en el precio\n');
define('JS_OPTIONS_VALUE_PRICE_PREFIX', '* El atributo del producto nuevo necesita un prefijo del precio\n');

define('JS_PRODUCTS_NAME', '* El producto nuevo necesita un nombre\n');
define('JS_PRODUCTS_DESCRIPTION', '* El producto nuevo necesita una descripción\n');
define('JS_PRODUCTS_PRICE', '* El producto nuevo necesita un valor del precio\n');
define('JS_PRODUCTS_WEIGHT', '* El producto nuevo necesita un valor del peso\n');
define('JS_PRODUCTS_QUANTITY', '* El producto nuevo necesita un valor de la cantidad\n');
define('JS_PRODUCTS_MODEL', '* El producto nuevo necesita un valor modelo\n');
define('JS_PRODUCTS_IMAGE', '* El producto nuevo necesita un valor de la imagen\n');

define('JS_SPECIALS_PRODUCTS_PRICE', '* Un nuevo precio para este producto necesita ser fijado\n');

define('JS_GENDER', '* En \'Genero\' el valor debe ser elegido.\n');
define('JS_FIRST_NAME', '* En \'Primer Nombre\' la entrada debe tener por lo menos ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' caracteres.\n');
define('JS_LAST_NAME', '* En \'Apellido\' la entrada debe tener por lo menos ' . ENTRY_LAST_NAME_MIN_LENGTH . ' caracteres.\n');
define('JS_DOB', '* En \'Fecha de Cumpleaños\' la entrada debe estar en el formato: xx/xx/xxxx (Mes/Día/Año).\n');
define('JS_EMAIL_ADDRESS', '* En \'Dirección de E-Mail\' la entrada debe tener por lo menos ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' caracteres.\n');
define('JS_ADDRESS', '* En \'Dirección\' la entrada debe tener por lo menos ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' caracteres.\n');
define('JS_POST_CODE', '* En \'Codigo\' la entrada debe tener por lo menos ' . ENTRY_POSTCODE_MIN_LENGTH . ' caracteres.\n');
define('JS_CITY', '* En \'Ciudad\' la entrada debe tener por lo menos ' . ENTRY_CITY_MIN_LENGTH . ' caracteres.\n');
define('JS_STATE', '* En \'Estado\' la entrada es debe ser seleccionada.\n');
define('JS_STATE_SELECT', '-- Seleccione Arriba --');
define('JS_ZONE', '* En \'Estado\' la entrada se debe seleccionar de la lista para este país.');
define('JS_COUNTRY', '* En \'País\' el valor debe ser elegido.\n');
define('JS_TELEPHONE', '* En \'Número de Teléfono\' la entrada debe tener por lo menos ' . ENTRY_TELEPHONE_MIN_LENGTH . ' caracteres.\n');
define('JS_PASSWORD', '* En \'Clave\' y \'Confirmación\' las entradas deben ser similares y contener por lo menos ' . ENTRY_PASSWORD_MIN_LENGTH . ' caracteres.\n');

define('JS_ORDER_DOES_NOT_EXIST', 'Número de Orden %s No Existe!');

define('CATEGORY_PERSONAL', 'Personal');
define('CATEGORY_ADDRESS', 'Dirección');
define('CATEGORY_CONTACT', 'Contacto');
define('CATEGORY_COMPANY', 'Compañia');
define('CATEGORY_OPTIONS', 'Opciones');

define('ENTRY_GENDER', 'Genero:');
define('ENTRY_GENDER_ERROR', '&nbsp;<span class="errorText">required</span>');
define('ENTRY_FIRST_NAME', 'Primer Nombre:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' chars</span>');
define('ENTRY_LAST_NAME', 'Apellido:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_LAST_NAME_MIN_LENGTH . ' chars</span>');
define('ENTRY_DATE_OF_BIRTH', 'Fecha de Nacimiento:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<span class="errorText">(eg. 05/21/1970)</span>');
define('ENTRY_EMAIL_ADDRESS', 'Dirección de E-Mail:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' chars</span>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<span class="errorText">la dirección de email no parece ser válida!</span>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<span class="errorText">Este dirección de email ya existe!</span>');
define('ENTRY_COMPANY', 'Nombre de la Compañia:');
define('ENTRY_COMPANY_ERROR', '');

// BOF: MOD - Separate Pricing Per Customer
define('ENTRY_COMPANY_TAX_ID', 'Company\'s tax id number:');
define('ENTRY_COMPANY_TAX_ID_ERROR', '');
define('ENTRY_CUSTOMERS_GROUP_REQUEST_AUTHENTICATION', 'Switch off alert for authentication:');
define('ENTRY_CUSTOMERS_GROUP_RA_NO', 'Alert off');
define('ENTRY_CUSTOMERS_GROUP_RA_YES', 'Alert on');
define('ENTRY_CUSTOMERS_GROUP_RA_ERROR', '');
// EOF: MOD - Separate Pricing Per Customer

define('ENTRY_STREET_ADDRESS', 'Dirección:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' chars</span>');
define('ENTRY_SUBURB', 'Urbanización:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_POST_CODE', 'Codigo postal:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_POSTCODE_MIN_LENGTH . ' chars</span>');
define('ENTRY_CITY', 'Ciudad:');
define('ENTRY_CITY_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_CITY_MIN_LENGTH . ' chars</span>');
define('ENTRY_STATE', 'Estado:');
define('ENTRY_STATE_ERROR', '&nbsp;<span class="errorText">Requerido</span>');
define('ENTRY_COUNTRY', 'País:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_TELEPHONE_NUMBER', 'Número de Teléfono:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<span class="errorText">min ' . ENTRY_TELEPHONE_MIN_LENGTH . ' chars</span>');
define('ENTRY_FAX_NUMBER', 'Número de Fax:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_NEWSLETTER', 'Boletín de noticias:');
define('ENTRY_NEWSLETTER_YES', 'Suscrito');
define('ENTRY_NEWSLETTER_NO', 'No suscrito');
define('ENTRY_NEWSLETTER_ERROR', '');

// images
define('IMAGE_ANI_SEND_EMAIL', 'Enviar E-Mail');
define('IMAGE_BACK', 'Atras');
define('IMAGE_BACKUP', 'Respaldo');
define('IMAGE_CANCEL', 'Cancelar');
define('IMAGE_CONFIRM', 'Confirmar');
define('IMAGE_COPY', 'Copiar');
define('IMAGE_COPY_TO', 'Copiar a');
define('IMAGE_DETAILS', 'Detalles');
define('IMAGE_DELETE', 'Borrar');
define('IMAGE_EDIT', 'Editar');
define('IMAGE_EMAIL', 'Email');
define('IMAGE_FILE_MANAGER', 'Administrador de Archivo');
define('IMAGE_ICON_STATUS_GREEN', 'Activo');
define('IMAGE_ICON_STATUS_GREEN_LIGHT', 'Determinado Activo');
define('IMAGE_ICON_STATUS_RED', 'Inactivo');
define('IMAGE_ICON_STATUS_RED_LIGHT', 'Determinado Inactivo');
define('IMAGE_ICON_INFO', 'Info');
define('IMAGE_INSERT', 'Insertar');
define('IMAGE_LOCK', 'Bloquear');
define('IMAGE_MODULE_INSTALL', 'Modulo de Instalación');
define('IMAGE_MODULE_REMOVE', 'Remover Modulo');
define('IMAGE_MOVE', 'Mover');
define('IMAGE_NEW_BANNER', 'Nuevo Banner');
define('IMAGE_NEW_CATEGORY', 'Nueva Categoría');
define('IMAGE_NEW_COUNTRY', 'Nuevo País');
define('IMAGE_NEW_CURRENCY', 'Nueva Concurrencia');
define('IMAGE_NEW_FILE', 'Nuevo Archivo');
define('IMAGE_NEW_FOLDER', 'Nueva Carpeta');
define('IMAGE_NEW_LANGUAGE', 'Nuevo Lenguaje');
define('IMAGE_NEW_NEWSLETTER', 'Nuevo Boletin de Noticias');
define('IMAGE_NEW_PRODUCT', 'Nuevo Producto');
define('IMAGE_NEW_TAX_CLASS', 'Nueva Clase de Impuesto');
define('IMAGE_NEW_TAX_RATE', 'Nueva Tarifa de Impuesto');
define('IMAGE_NEW_TAX_ZONE', 'Nueva Zona de Impuesto');
define('IMAGE_NEW_ZONE', 'Nueva Zona');
define('IMAGE_ORDERS', 'Ordenes');
define('IMAGE_ORDERS_INVOICE', 'Factura');
define('IMAGE_ORDERS_PACKINGSLIP', 'Embalaje Slip');
define('IMAGE_PREVIEW', 'Previsualizar');
define('IMAGE_RESTORE', 'Restaurar');
define('IMAGE_RESET', 'Reiniciar');
define('IMAGE_SAVE', 'Salvar');
define('IMAGE_SEARCH', 'Buscar');
define('IMAGE_SELECT', 'Seleccionar');
define('IMAGE_SEND', 'Enviar');
define('IMAGE_SEND_EMAIL', 'Enviar Email');
define('IMAGE_UNLOCK', 'Desbloquear');
define('IMAGE_UPDATE', 'Actualizar');
define('IMAGE_UPDATE_CURRENCIES', 'Actualización de tarifa de intercambio');
define('IMAGE_UPLOAD', 'Cargar');

define('ICON_CROSS', 'Falso');
define('ICON_CURRENT_FOLDER', 'Carpeta Actual');
define('ICON_DELETE', 'Borrar');
define('ICON_ERROR', 'Error');
define('ICON_FILE', 'Archivo');
define('ICON_FILE_DOWNLOAD', 'Descargar');
define('ICON_FOLDER', 'Carpeta');
define('ICON_LOCKED', 'Bloquear');
define('ICON_PREVIOUS_LEVEL', 'Nivel Anterior');
define('ICON_PREVIEW', 'Previsualizar');
define('ICON_STATISTICS', 'Estadisticas');
define('ICON_SUCCESS', 'Exitoso');
define('ICON_TICK', 'Verdadero');
define('ICON_UNLOCKED', 'Desbloqueo');
define('ICON_WARNING', 'Advertencia');

// constants for use in tep_prev_next_display function
define('TEXT_RESULT_PAGE', 'Page %s of %d');
define('TEXT_DISPLAY_NUMBER_OF_BANNERS', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> banners)');
define('TEXT_DISPLAY_NUMBER_OF_COUNTRIES', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> paises)');
define('TEXT_DISPLAY_NUMBER_OF_CUSTOMERS', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> clientes)');
define('TEXT_DISPLAY_NUMBER_OF_CURRENCIES', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> concurrencias)');
define('TEXT_DISPLAY_NUMBER_OF_LANGUAGES', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> lenguajes)');
define('TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> manofacturas)');
define('TEXT_DISPLAY_NUMBER_OF_NEWSLETTERS', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> boletin de noticias)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> ordenes)');
define('TEXT_DISPLAY_NUMBER_OF_ORDERS_STATUS', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> estatus de ordenes)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> productos)');
define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_EXPECTED', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> productos especificados)');
define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> productos revisados)');
define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> productos en especial)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_CLASSES', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> Clases de impuestos)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_ZONES', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> Zonas de impuesto)');
define('TEXT_DISPLAY_NUMBER_OF_TAX_RATES', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> Tarifas de Impuestos)');
define('TEXT_DISPLAY_NUMBER_OF_ZONES', 'Mostrando <b>%d</b> de <b>%d</b> (de <b>%d</b> zonas)');

//BOF: MOD - Catagories Discriptions
define('TEXT_EDIT_CATEGORIES_HEADING_TITLE', 'Titulo del Encabezado de Categorías:');
define('TEXT_EDIT_CATEGORIES_DESCRIPTION', 'Descripción de Categorías:');
//EOF: MOD - Catagories Discriptions

define('PREVNEXT_BUTTON_PREV', '&lt;&lt;');
define('PREVNEXT_BUTTON_NEXT', '&gt;&gt;');

define('TEXT_DEFAULT', 'por defecto');
define('TEXT_SET_DEFAULT', 'Colocar por defecto');
define('TEXT_FIELD_REQUIRED', '&nbsp;<span class="fieldRequired">* Requerido</span>');

define('ERROR_NO_DEFAULT_CURRENCY_DEFINED', 'Error: No hay actualmente sistema de concurrencia por defecto. Por favor escoja uno en: Herramientas de Administración->Localización->Concurrencias');

define('TEXT_CACHE_CATEGORIES', 'Caja de Categorías');
define('TEXT_CACHE_MANUFACTURERS', 'Caja de Manofacturas');
define('TEXT_CACHE_ALSO_PURCHASED', 'Modulo de tambien comprado');

define('TEXT_NONE', '--ninguno--');
define('TEXT_TOP', 'Tope');

define('ERROR_DESTINATION_DOES_NOT_EXIST', 'Error: El destinación no existe.');
define('ERROR_DESTINATION_NOT_WRITEABLE', 'Error: Destinación no rescribible.');
define('ERROR_FILE_NOT_SAVED', 'Error: Archivo Cargado no salvado.');
define('ERROR_FILETYPE_NOT_ALLOWED', 'Error: Archivo Cargado de tipo no permitido.');
define('SUCCESS_FILE_SAVED_SUCCESSFULLY', 'Exito: Archivo Cargado salvado correctamente.');
define('WARNING_NO_FILE_UPLOADED', 'Advertencia: No Cargo el Archivo.');
define('WARNING_FILE_UPLOADS_DISABLED', 'Advertencia: Archivo cargados estan desambladas en la configuración del archivo php.ini.');

// LINE ADDED - XSell
define('BOX_CATALOG_XSELL_PRODUCTS', 'Productos cruzados en la venta'); // X-Sell

// LINE ADDED -  Credit Class GV
REQUIRE(DIR_WS_LANGUAGES . 'add_ccgvdc_espanol.php');

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