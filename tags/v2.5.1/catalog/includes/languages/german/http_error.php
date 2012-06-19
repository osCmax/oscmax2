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
define('TEXT_INFORMATION', 'Leider ist bei der von Ihnen aufgerufenen Seite der folgende Fehler aufgetreten:
<br><br><b>%s</b><br><br>Bitte versuchen Sie es mit einer anderen Seite unseres Online-Shops. Sie können auch die Erweiterte Suchfunktion verwenden, um das gesuchte Produkt zu finden. Wir bitten für die entstandenen Unannehmlichkeiten um Entschuldigung.');

define('EMAIL_BODY', 
'------------------------------------------------------' . "\n" .
'Site: %s.' . "\n" .
'Fehlercode: %s - %s' . "\n" .
'Aufgetreten: %s' . "\n" .
'Angeforderte URL: %s' . "\n" .
'Benutzeradresse: %s' . "\n" .
'User Agent: %s' . "\n" .
'Referer: %s' . "\n" .
'------------------------------------------------------'
);

define('EMAIL_TEXT_SUBJECT','Ein Kunde hat einen HTTP-Fehler erhalten');

//Client Error Codes 
define('ERROR_400_DESC', 'Bad Request');
define('ERROR_401_DESC', 'Authorization Required');
define('ERROR_403_DESC', 'Forbidden');
define('ERROR_404_DESC', 'Page Not Found');
define('ERROR_405_DESC', 'Method Not Allowed');
define('ERROR_408_DESC', 'Request Timed Out');
define('ERROR_415_DESC', 'Unsupported Media Type');
define('ERROR_416_DESC', 'Requested Range Not Satisfiable');
define('ERROR_417_DESC', 'Expectation Failed');

//Server Error Codes
define('ERROR_500_DESC', 'Internal Server Error');
define('ERROR_501_DESC', 'Not Implemented');
define('ERROR_502_DESC', 'Bad Gateway');
define('ERROR_503_DESC', 'Service Unavailable');
define('ERROR_504_DESC', 'Gateway Timeout');
define('ERROR_505_DESC', 'HTTP Version Not Supported');
define('UNKNOWN_ERROR_DESC', 'Undefined Error');
?>