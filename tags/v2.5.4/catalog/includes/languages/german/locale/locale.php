<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

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
// $date should be in format dd/mm/yyyy
// raw date is in format YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
}

date_default_timezone_set('Europe/Berlin');

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'EUR');

// LINE ADDED: Country-State Selector
define ('DEFAULT_COUNTRY', '81');

// text for date of birth example
define('DOB_FORMAT_STRING', 'TT.MM.JJJJ');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Geben Sie Ihr Geburtsdatum in diesem Format an: TT/MM/JJJJ (eg 21/05/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (zB 21.05.1970)');

// text for addresses
define('ENTRY_SUBURB', 'Addresszeile 2:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Postleitzahl:');
define('ENTRY_POST_CODE_ERROR', 'Ihre Postleitzahl muß mindestens ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zeichen enthalten.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_STATE', 'Bundesland:');
define('ENTRY_STATE_ERROR', 'Your County must contain a minimum of ' . ENTRY_STATE_MIN_LENGTH . ' characters.');
define('ENTRY_STATE_ERROR_SELECT', 'Please select a County from the Counties pull down menu.');

// BOF: MSRP
define('TEXT_PRODUCTS_MSRP', '&nbsp;UVP:&nbsp;');
define('TEXT_PRODUCTS_SAVINGS_RRP', '&nbsp;SIE&nbsp;sparen&nbsp;(ab&nbsp;UVP):&nbsp;');
// EOF: MSRP
?>