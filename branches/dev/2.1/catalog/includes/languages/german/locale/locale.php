<?php
// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'de_DE'
// on FreeBSD try 'de_DE.ISO_8859-1'
// on Windows try 'de' or 'German'
@setlocale(LC_TIME, 'de_DE.ISO_8859-1');

define('DATE_FORMAT_SHORT', '%d.%m.%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A, %d. %B %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd.m.Y');  // this is used for strftime()
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

// BOF: MSRP
define('TEXT_PRODUCTS_MSRP', '&nbsp;UVP:&nbsp;');
define('TEXT_PRODUCTS_SAVINGS_RRP', '&nbsp;SIE&nbsp;sparen&nbsp;(ab&nbsp;UVP):&nbsp;');
// EOF: MSRP
?>