<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

	define('HEADING_TITLE','Options for FedEx Shipment');
	define('IMAGE_SUBMIT','Submit');
	define('ORDER_HISTORY_DELIVERED','Scheduled shipment, tracking number ');
	define('ORDER_HISTORY_CANCELLED','Cancelled shipment');
	define('NO_ORDER_NUMBER_ERROR','No order number specified!');
	define('ERROR_FEDEX_QUOTES_NOT_INSTALLED','Could not find a FedEx account number. Is FedEx RealTime Quotes installed and configured?');
	define('SHIPMENT_REQUEST_DATA','Shipment request data, package number ');
	define('MANIFEST_DATA','Manifest data, package number ');
	define('RUNNING_IN_DEBUG','Running in debug mode, no ship request made');
	define('ERROR_NO_ORDER_SPECIFIED','ERROR: There is no order specified!');
	define('ORDER_NUMBER','Order number ');
	define('COULD_NOT_DELETE_ENTRIES','Could not delete manifest entries.');
	define('ERROR','ERROR: ');
	define('ENTER_PACKAGE_WEIGHT','You must enter a package weight.');
	define('ENTER_NUMBER_PACKAGES','You must enter the number of packages.');

	define('EMAIL_SEPARATOR', '------------------------------------------------------');
    define('EMAIL_TEXT_SUBJECT', 'Order Update');
    define('EMAIL_TEXT_ORDER_NUMBER', 'Order Number:');
    define('EMAIL_TEXT_INVOICE_URL', 'Detailed Invoice:');
    define('EMAIL_TEXT_DATE_ORDERED', 'Date Ordered:');
    define('EMAIL_TEXT_STATUS_UPDATE', 'Your order status is ' . '%s' . "\n\n" . 'Please reply to this email if you have any questions.' . "\n");
    define('EMAIL_TEXT_COMMENTS_UPDATE', 'Comments: ' . "%s\n");
    define('EMAIL_TEXT_TRACKING_NUMBER', 'You can track your packages by clicking the link below.');
    define('URL_TO_TRACK1', 'http://www.fedex.com/cgi-bin/tracking?action=track&tracknumbers=');
		
// form field titles
	define('NUMBER_OF_PACKAGES','Number of Packages:');
	define('OVERSIZED','Oversized?');
	define('PACKAGING_TYPE','Packaging Type ("other" for ground shipments):');
	define('TYPE_OF_SERVICE','Type of Service:');
	define('PAYMENT_TYPE','Payment Type:');
	define('DROPOFF_TYPE','Dropoff Type:');
	define('PICKUP_DATE','Pickup date (yyyymmdd):');

	define('TOTAL_WEIGHT','Total weight for all packages:');
	define('PACKAGE_WEIGHT','Package Weight:');
	
?>