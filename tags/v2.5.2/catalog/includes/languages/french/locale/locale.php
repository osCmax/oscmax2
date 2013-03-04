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
// on Linux try 'fr_FR'
// on FreeBSD try 'fr_FR.ISO_8859-1'
// on Windows try 'fr', or 'French'
@setlocale(LC_TIME, 'fr_FR.ISO_8859-1');

define('DATE_FORMAT_SHORT', '%d/%m/%Y');  // this is used for strftime()
define('DATE_FORMAT_LONG', '%A %d %B, %Y'); // this is used for strftime()
define('DATE_FORMAT', 'd/m/Y'); // this is used for date()
define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Retourne date au format brut
// $date doit etre au format dd/mm/yyyy (francais)
// Date au format burt est de la forme YYYYMMDD, or DDMMYYYY
function tep_date_raw($date, $reverse = false) {
  if ($reverse) {
    return substr($date, 0, 2) . substr($date, 3, 2) . substr($date, 6, 4);
  } else {
    return substr($date, 6, 4) . substr($date, 3, 2) . substr($date, 0, 2);
  }
}

date_default_timezone_set('Europe/Paris');

// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
define('LANGUAGE_CURRENCY', 'EUR');

// LINE ADDED: Country-State Selector
define ('DEFAULT_COUNTRY', '73');

// text for date of birth example
define('DOB_FORMAT_STRING', 'dd/mm/yyyy');
define('ENTRY_DATE_OF_BIRTH_ERROR', 'Votre date de naissance doit être dans ce format: DD/MM/YYYY (EX 21/05/1970)');
define('ENTRY_DATE_OF_BIRTH_TEXT', '* (EX. 21/05/1970)');

// text for addresses
define('ENTRY_SUBURB', 'Adresse 2:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Code postal:');
define('ENTRY_POST_CODE_ERROR', 'Votre code postal doit contenir un minimum de ' . ENTRY_POSTCODE_MIN_LENGTH . ' caractères.');
define('ENTRY_POST_CODE_TEXT', '*');
define('ENTRY_STATE', 'Région:');
define('ENTRY_STATE_ERROR', 'Votre région doit contenir un minimum de ' . ENTRY_STATE_MIN_LENGTH . ' caractères.');
define('ENTRY_STATE_ERROR_SELECT', 'S\'il vous plaît sélectionner une région dans la menu déroulant.');

// BOF: MSRP
define('TEXT_PRODUCTS_MSRP', '&nbsp;PR:&nbsp;');
define('TEXT_PRODUCTS_SAVINGS_RRP', '&nbsp;Vous&nbsp;économisez&nbsp;(de&nbsp;pr):&nbsp;');
// EOF: MSRP
?>