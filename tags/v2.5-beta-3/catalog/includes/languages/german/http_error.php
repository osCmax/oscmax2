<?php
/*
$Id: http_error.php 982 2011-01-06 02:53:12Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
define('NAVBAR_TITLE','HTTP-Fehler');
define('HEADING_TITLE', '%s ERROR');
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

define('EMAIL_TEXT_SUBJECT','Ein Kunde hat einen HTTP-Fehler erhalten');

//Client Error Codes 
define('ERROR_400_DESC','Bad Request');
define('ERROR_401_DESC','Authorization Required');
define('ERROR_403_DESC', 'Forbidden');
define('ERROR_404_DESC','Seite nicht gefunden');
define('ERROR_405_DESC','Methode nicht erlaubt');
define('ERROR_408_DESC','Zeitüberschreitung der Anforderung');
define('ERROR_415_DESC','Unterstützte Medientypen');
define('ERROR_416_DESC','Nicht autorisiert');
define('ERROR_417_DESC','Erwartungen sind nicht');

//Server Error Codes
define('ERROR_500_DESC','Internal Server Error');
define('ERROR_501_DESC','Nicht implementiert');
define('ERROR_502_DESC','Bad Gateway');
define('ERROR_503_DESC','Dienst nicht verfügbar');
define('ERROR_504_DESC','Gateway Timeout');
define('ERROR_505_DESC','HTTP-Version nicht unterstützt');
define('UNKNOWN_ERROR_DESC','Undefined Error');
?>