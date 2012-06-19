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
define('TEXT_INFORMATION', 'Lo sentimos pero la página solicitada ha dado el siguiente error:
<br><br><b>%s</b><br><br>Puede visitar el resto de nuestra tienda. También puede utilizar la función de búsqueda avanzada presentada a continuación para encontrar el producto deseado. Acepte nuestras disculpas por los inconvenientes causados.');

define('EMAIL_BODY', 
'------------------------------------------------------' . "\n" .
'Sitio web: %s.' . "\n" .
'Código de error: %s - %s' . "\n" .
'Ocurrido: %s' . "\n" .
'URL solicitada: %s' . "\n" .
'Dirección del usuario: %s' . "\n" .
'Agente de usuario: %s' . "\n" .
'Origen: %s' . "\n" .
'------------------------------------------------------'
);

define('EMAIL_TEXT_SUBJECT', 'Un cliente ha recibido un error HTTP');

//Client Error Codes 
define('ERROR_400_DESC','Solicitud incorrecta');
define('ERROR_401_DESC','No autorizado');
define('ERROR_403_DESC','Prohibido');
define('ERROR_404_DESC','Página no encontrada');
define('ERROR_405_DESC','Método no permitido');
define('ERROR_408_DESC','Tiempo de espera agotado');
define('ERROR_415_DESC','Tipo de medio no soportado');
define('ERROR_416_DESC','Rango solicitado no disponible');
define('ERROR_417_DESC','Falló expectativa');

//Server Error Codes
define('ERROR_500_DESC','Error interno del servidor');
define('ERROR_501_DESC','No implementado');
define('ERROR_502_DESC','Pasarela incorrecta');
define('ERROR_503_DESC','Servicio no disponible');
define('ERROR_504_DESC','Tiempo de espera de la pasarela agotado');
define('ERROR_505_DESC','Versión de HTTP no soportada');
define('UNKNOWN_ERROR_DESC','Error no definido');
?>