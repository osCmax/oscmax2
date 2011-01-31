<?php
/*
$Id: http_error.php 982 2011-01-06 02:53:12Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
define('NAVBAR_TITLE','Error HTTP');
define('HEADING_TITLE','%s ERROR');
define('TEXT_INFORMATION', 'We\'re sorry but the page you have requested has encountered the following error:
<br><br><b>%s</b><br><br>Please feel free to browse the rest of our store. You may also use the Advanced Search feature provided below to find the product you are looking for. We apologize for any inconvenience caused.');

define('EMAIL_BODY', 
'------------------------------------------------------' . "\n" .
'Site: %s.' . "\n" .
'Error Code: %s - %s' . "\n" .
'Occurred: %s' . "\n" .
'Requested URL: %s' . "\n" .
'User Address: %s' . "\n" .
'User Agent: %s' . "\n" .
'Referer: %s' . "\n" .
'------------------------------------------------------'
);

define('EMAIL_TEXT_SUBJECT', 'A Customer has received an HTTP Error');

//Client Error Codes 
define('ERROR_400_DESC','Solicitud incorrecta');
define('ERROR_401_DESC','Se requiere autorización');
define('ERROR_403_DESC','Prohibida');
define('ERROR_404_DESC','Página no encontrada');
define('ERROR_405_DESC','Método no permitido');
define('ERROR_408_DESC','Tiempo de espera agotado');
define('ERROR_415_DESC','Tipo de soporte no compatibles');
define('ERROR_416_DESC','Range No requerido satisfactible');
define('ERROR_417_DESC','Expectativa Error');

//Server Error Codes
define('ERROR_500_DESC','Error interno del servidor');
define('ERROR_501_DESC','No implementado');
define('ERROR_502_DESC','Bad Gateway');
define('ERROR_503_DESC','Servicio no disponible');
define('ERROR_504_DESC','Puerta de enlace de tiempo de espera');
define('ERROR_505_DESC','Versión de HTTP no compatible');
define('UNKNOWN_ERROR_DESC','Error Indefinido');
?>