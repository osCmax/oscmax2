<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
/**
 * The Feedmachine Solution - osCommerce MS-2.2
 *
 * Generate feeds for any product search engine, e.g. Google Product Search, PriceGrabber, BizRate,
 * DealTime, mySimon, Shopping.com, Yahoo! Shopping, PriceRunner.
 * Simply configure the feeds and run the script to generate them from
 * your product database. Highly flexible system and easy to modify.
 * @package feedmachine
 * @license http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link http://www.osc-solutions.co.uk/ osCommerce Solutions
 * @copyright Copyright 2005-, Lech Madrzyk
 * @author Lech Madrzyk
 * @filesource http://www.osc-solutions.co.uk/
 */

/*
LOADING BAY
This is the place to load general user functions, classes and extra arrays that your
configurations can access as the feeds are built.

It is recommended that user functions begin with "FM_UF_" to ensure there are no conflicts.
User Functions take the $product array containing all database fields for that product
as their only parameter and should return the output field.
"Include Record Function" decides whether the record (product or product variation) should
be included and should return true or false.
Note: The $product array is loaded by reference for performance reasons - you can also
use this to your advantage
*/

//Example record include function 
function FM_UF_include_record($product) {
  return $product['products_quantity'] > 0;
}

//END OF LOADINGBAY
///////////////////////////////////////////////////////////////////////////////////////

?>