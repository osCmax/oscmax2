<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
  //azer 31oct05 Custom HTTP Error Page v1.5 (http://www.oscommerce.com/community/contributions,933)
*/
define('NAVBAR_TITLE', 'HTTP Error');
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

define('EMAIL_TEXT_SUBJECT', 'A Customer has received an HTTP Error');

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