<?php

/**
 * The Feedmachine Solution
 *
 * Generate feeds for any product search engine, e.g. Google Product Search, PriceGrabber, BizRate,
 * DealTime, mySimon, Shopping.com, Yahoo! Shopping, PriceRunner.
 * @package the-feedmachine-solution
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link http://www.osc-solutions.co.uk/ osCommerce Solutions
 * @copyright Copyright 2005-, Lech Madrzyk
 * @author Lech Madrzyk
 */

/*
CONFIGURATION
*/

/*
NOTE: You will probably not need to change anything here.
*/

/*
Catalog Directory
This can be the full path or the path relative to the directory in which the feedmachine
files are placed (preferably admin directory) with a trailing slash
The default configuration below will work in 99% of cases
*/
define('FM_CATALOG_DIRECTORY', '../');

/*
Save Location Relative to Catalog Directory
Create a directory in your catalog directory for your product feed files, ensure its writable and set FM_SAVE_LOCATION
below to the name of this directory followed by a foward slash (/)
(i.e. This is the path relative to the path above)
*/
define('FM_SAVE_LOCATION', 'fm-feeds/');

/*
SQL Big Selects
If you are getting MYSQL error 1104, try setting the following to true
*/
define('FM_SQL_BIG_SELECTS', false);

//END OF CONFIGURATION
///////////////////////////////////////////////////////////////////////////////////////

?>