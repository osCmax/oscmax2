<?php
/*
$Id:$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('TEXT_OSCMAX_WEBSITE', 'Web osCmax');
define('TEXT_FORUM', 'Soporte');
define('TEXT_DOCUMENTATION', 'Documentación');
define('TEXT_WIKI', 'Wiki');
define('TEXT_FOOTER_DISCLAIMER', 'osCmax no ofrece ninguna garantía y es redistribuible bajo la <a href="http://www.fsf.org/licenses/gpl.txt" target="_blank">GNU General Public License</a>');

define('TAB_START', 'Inicio');
define('TAB_DATABASE_SERVER', 'Servidor base datos');
define('TAB_WEB_SERVER', 'Servidor web');
define('TAB_STORE_SETTINGS', 'Configuración tienda');
define('TAB_FINISHED', 'Finalizado');

define('TEXT_PHP_VERSION', 'Versión PHP');
define('TEXT_PHP_SETTINGS', 'Configuración PHP');
define('TEXT_PHP_EXTENSIONS', 'Extensiones PHP');
define('TEXT_ON', 'On');
define('TEXT_OFF', 'Off');

define('IMAGE_CONTINUE', 'Continuar');
define('IMAGE_CANCEL', 'Cancelar');
define('IMGAE_RETRY', 'Reintentar');
define('IMAGE_ADMIN', 'Panel Administración');
define('IMAGE_CATALOG', 'Catálogo');

// Start Page
define('TEXT_WELCOME_TO_OSCMAX', 'Bienvenido a osCmax ');
define('TEXT_INDEX_MAIN_BLOCK', '<p>osCmax te permite vender productos en todo el mundo con tu propia tienda online. La parte de administración gestiona los productos, clientes, pedidos, boletines, ofertas y mucho más para construir y prosperar con éxito en tu negocio online.</p>
  <p>osCmax está basado en osCommerce Online Merchant 2.2 y su objetivo es hacer más rápida y sencilla que nunca la implementación de tu sitio web. osCmax es compatible hacia atrás con osCommerce Online Merchant 2.2 y por lo tanto puedes aprovechar que tenga la comunidad más grande de una solución de tienda online con carrito de la compra: más de 140.000 propietarios de tiendas registrados que se ayudan unos a otros y que han proporcionado más de 4.000 complementos que extienden las funciones, características y el potencial de tu tienda online.</p>
  <p>osCmax y sus complementos están disponibles de forma gratuita y libre bajo una licencia Open Source para ayudarte a vender online lo antes posible sin ninguna cuota por licencia o cualquier otra limitación involucrada.</p><p>&nbsp;</p><p>&nbsp;</p><br />');
define('TEXT_REGISTER_GLOBALS_ERROR', 'A partir de PHP 4.3+ está soportada la compatibilidad con register_globals. Este parámetro <u>debe estar habilitado</u> debido a que se está usando una versión de PHP más antigua.');
define('TEXT_PERMISSIONS_ERROR', '<p>El servidor web no puede guardar los parámetros de la instalación en sus ficheros de configuración.</p><p>Es necesario que los siguientes ficheros tengan sus permisos configurados como escribibles por todos (chmod 777):</p><p></p>');
define('TEXT_CORRECT_ERROR', '<p class="messageStackAlert">Por favor corrige los errores  mostrados a la derecha y vuelve a intentar ejecutar el procedimiento de instalación con los cambios aplicados.</p>
');
define('TEXT_RESTART_WEB_SERVER_ERROR', '<p class="messageStackAlert"><i>El cambio de los parámetros de configuración del servidor web puede hacer necesario que se reinicie el servicio del servidor web para que los cambios hagan efecto.</i>');
define('TEXT_SERVER_SUCCESS', 'Se ha verificado el entorno del servidor web para para proceder con una correcta instalación y configuración de la tienda online.<br /><br />Por favor continúa para comenzar el proceso de instalación.');

// Step 1 - Database Server
define('TEXT_DATABASE_SERVER_BLOCK', '<p>El servidor de base de datos almacena el contenido de la tienda online, como por ejemplo la información de productos, clientes y pedidos que se hayan hecho.</p><p>Por favor consulta con tu administrador del servidor si todavía no se conocen los parámetros del servidor de la base de datos.</p>');
define('TEXT_DATABASE_SERVER', 'Servidor de base de datos');
define('TEXT_DATABASE_SERVER_DESC', 'Dirección del servidor de base de datos en la forma de un nombre de host o una dirección IP.');
define('TEXT_DATABASE_USERNAME', 'Nombre de usuario');
define('TEXT_DATABASE_USERNAME_DESC', 'Nombre de usuario utilizado para conectarse al servidor de base de datos.');
define('TEXT_DATABASE_PASSWORD', 'Contraseña');
define('TEXT_DATABASE_PASSWORD_DESC', 'Contraseña utilizada junto con nombre de usuario para conectarse al servidor de base de datos.');
define('TEXT_DATABASE_NAME', 'Nombre de la base de datos');
define('TEXT_DATABASE_NAME_DESC', 'Nombre de la base de datos para almacenar la información.');
define('TEXT_DATABASE_SUCCESS', 'Bas de datos importada correctamente.');
define('TEXT_DATABASE_IMPORTING', 'En estos momentos se está importando la estructura de la base de datos. Por favor ten un poco de paciencia mientras dura este proceso.');
define('TEXT_DATABASE_PROBLEM', 'Ha habido un problema al importar la base de datos. Ha ocurrido el siguiente error:<br><br>%s<br><br>Por favor comprueba los parámetros de conexión y vuelve a intentarlo.');
define('TEXT_DATBASE_CONNECTION_ERROR', 'Ha habido un problema al conectarse a la base de datos. Ha ocurrido el siguiente error:<br><br>%s<br><br>Por favor comprueba los parámetros de conexión y vuelve a intentarlo.');
define('TEXT_TESTING_DATABASE', 'Comprobando la conexión a la base de datos.');

// Step 2 - Web Server
define('TEXT_WEB_SERVER', '<p>El servidor web se ocupa de servir las página de la tienda online a los visitantes y clientes. Los parámetros del servidor web hacen que los enlaces a las páginas apunten a los lugares correctos.</p>');
define('TEXT_WWW_ADDRESS', 'Dirección WWW');
define('TEXT_WEB_ADDRESS', 'Dirección web de la tienda online.');
define('TEXT_WEBSERVER_ROOT_DIR', 'Directorio raíz del servidor web');
define('TEXT_WEBSERVER_DIRECTORY', 'Directorio donde está instalada la tienda online en el servidor.');

// Step 3 - Store Setup
define('TEXT_STORE_SETUP', '<p>Aquí puedes definir el nombre de la tienda online y los datos de contacto del propietario de la tienda.</p><p>El nombre de usuario y la contrseña del administrador son usados para iniciar sesión en la sección protegida del panel de administración.</p>');
define('TEXT_STORE_NAME', 'Nombre de la tienda');
define('TEXT_STORE_NAME_DESC', 'El nombre de la tienda online que se muestra al público.');
define('TEXT_FIRST_NAME', 'Nombre del propietario de la tienda');
define('TEXT_FIRST_NAME_DESC', 'El nombre del propietario de la tienda que se muestra al público.');
define('TEXT_LAST_NAME', 'Apellidos del propietario de la tienda');
define('TEXT_LAST_NAME_DESC', 'Los apellidos del propietario de la tienda que se muestran al público.');
define('TEXT_EMAIL', 'Dirección e-mail del propietario de la tienda');
define('TEXT_EMAIL_DESC', 'La dirección de e-mail del propietario de la tienda que se muestra al público.');
define('TEXT_USERNAME', 'Nombre de usuario del administrador');
define('TEXT_USERNAME_DESC', 'El nombre de usuario del administrador para utilizarlo en el panel de administración.');
define('TEXT_PASSWORD', 'Contraseña del administrador');
define('TEXT_PASSWORD_DESC', 'La contraseña para utilizar con la cuenta de administrador.');
define('TEXT_ADMIN_FOLDER_NAME', 'Nombre de la carpeta de administración');
define('TEXT_CHANGE_ADMIN_FOLDER', 'El nombre donde se mantienen los ficheros de administración. Se <b>recomienda que lo cambies</b> en lugar de usar por defecto <b>admin</b> para mejorar la seguridad del sitio web. Si quieres leer más acerca de la seguridad, por favor <a href="http://wiki.oscdox.com/v2.5/setting_up_security" target="_blank">consulta el wiki</a>.');
define('TEXT_ADMIN_NO_PERMISSION', 'No se ha podido obtener el permiso de fichero adecuado para permitirte cambiar el nombre de la carpeta <b>admin/</b>.  Deberías cambiar el nombre de esta carpeta para mejorar la seguridad de la tienda. Para obtener instrucciones acerca de cómo cambiar esto manualmente una vez que hayas corregido los parámetros del servidor, por favor <a href="http://wiki.oscdox.com/v2.1/setting_up_security" target="_blank">consulta el wiki</a>.');
define('TEXT_NO_CONFIG_PERMISSIONS', 'The installer cannot create your configure.php files. <br/> Permissions are incorrect on several directories!');
define('TEXT_NO_CONFIG_PERMISSIONS_DESC', ' You will need to change permissions to 755 or 777 on the following directories. <br />Once you have done this, reload this page and you will be able to continue the installation. If you still see this error after changing permissions and reloading this page, see the documentation for in depth <a href="http://wiki.oscdox.com/v2.5/installation_troubleshooting" target="_blank">Troubleshooting</a>. <br><br>Change permissions to 755 or 777 (hint, try 755 first. If it doesn\'t work, try 777) on the following directories:<br><br>');


// Finished
define('TEXT_FINISHED', '<h1>Instalación completada</h1><p>¡Enhorabuena por instalar y configurar osCmax como tu solución de tienda online!</p><p>Te deseamos todo lo mejor para el éxito de tu tienda online y te damos la bienvenida para que te unas y participes en nuestra comunidad.</p><p align="right"><i><b>- El equipo de osCmax</b></i></p>');
define('TEXT_ADMIN_RENAMED_1', '¡Felicidades! La carpeta admin se ha renombrado como ');
define('TEXT_ADMIN_RENAMED_2', '.<br><br>Si quieres leer más información sobre mayores medidas de seguridad puedes echarle un vistazo a la <a href="http://wiki.oscdox.com/v2.5/setting_up_security" target="_blank">documentación en el Wiki.</a>');
define('TEXT_ADMIN_NOT_RENAMED', '¡No le has cambiado el nombre a la carpeta <b>admin</b>!Para tiendas en producción te recomendamos encarecidamente que lo hagas, con el objetivo de aumentar la seguridad.  <br><br>Por favor, lee la <a href="http://wiki.oscdox.com/v2.5/setting_up_security" target="_blank">documentación en el Wiki para obtener más información sobre cómo tener una adecuada seguridad en tu sitio web.</a>');
define('TEXT_INSTALLATION_SUCCESSFUL', '¡La instalación y configuración se realizaron correctamente!');
?>