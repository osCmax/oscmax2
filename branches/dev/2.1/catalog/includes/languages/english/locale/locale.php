<?php
// look in your $PATH_LOCALE/locale directory for available locales
// or type locale -a on the server.
// Examples:
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
if (ENGLISH_SWITCH == 'UK') { // Use UK format for store
@setlocale(LC_TIME, 'en_UK.ISO_8859-1'); 

define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
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

date_default_timezone_set('Europe/London');

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'GBP');

// LINE ADDED: Country-State Selector
define ('DEFAULT_COUNTRY', '222');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Your Date of Birth must be in this format: DD/MM/YYYY (eg 21/05/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (eg. 21/05/1970)');

// text for addresses
define('ENTRY_SUBURB', 'Address Line 2:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Post Code:');
define('ENTRY_POST_CODE_ERROR', 'Your Post Code must contain a minimum of ' . ENTRY_POSTCODE_MIN_LENGTH . ' characters.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_STATE', 'County:');
define('ENTRY_STATE_ERROR', 'Your County must contain a minimum of ' . ENTRY_STATE_MIN_LENGTH . ' characters.');
define('ENTRY_STATE_ERROR_SELECT', 'Please select a County from the Counties pull down menu.');

// BOF: MSRP
define('TEXT_PRODUCTS_MSRP', '&nbsp;RRP:&nbsp;');
define('TEXT_PRODUCTS_SAVINGS_RRP', '&nbsp;You&nbsp;Save&nbsp;(Off&nbsp;RRP):&nbsp;');
// EOF: MSRP

////
} else { // Use US format for store
////

@setlocale(LC_TIME, 'en_US.ISO_8859-1');

define('DATE_FORMAT_SHORT', '%m/%d/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'm/d/Y'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

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

date_default_timezone_set('America/New_York');

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'USD');

// LINE ADDED: Country-State Selector
define ('DEFAULT_COUNTRY', '223');

// text for date of birth example
define('DOB_FORMAT_STRING', 'mm/dd/yyyy');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Your Date of Birth must be in this format: MM/DD/YYYY (eg 05/21/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (eg. 05/21/1970)');

// text for addresses
define('ENTRY_SUBURB', 'Suburb:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Zip Code:');
define('ENTRY_POST_CODE_ERROR', 'Your Zip Code must contain a minimum of ' . ENTRY_POSTCODE_MIN_LENGTH . ' characters.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_STATE', 'State/Province:');
define('ENTRY_STATE_ERROR', 'Your State must contain a minimum of ' . ENTRY_STATE_MIN_LENGTH . ' characters.');
define('ENTRY_STATE_ERROR_SELECT', 'Please select a state from the States pull down menu.');

// BOF: MSRP
define('TEXT_PRODUCTS_MSRP', '&nbsp;MSRP:&nbsp;');
define('TEXT_PRODUCTS_SAVINGS_RRP', '&nbsp;You&nbsp;Save&nbsp;(Off&nbsp;MSRP):&nbsp;');
// EOF: MSRP

} // End English Type format if
////
