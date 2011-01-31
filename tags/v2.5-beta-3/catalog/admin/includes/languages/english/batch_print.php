<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
define('TEXT_ORDER_NUMBERS_RANGES', 'Order Number (s), either one # or  range, # - #, or #,#,#');
define('HEADING_TITLE', 'Batch Print Center');
define('TABLE_HEADING_COMMENTS', 'Comments');
define('TABLE_HEADING_PRODUCTS_MODEL', 'Model');
define('TABLE_HEADING_PRODUCTS', 'Description');
define('TABLE_HEADING_TAX', 'Tax');
define('TABLE_HEADING_TOTAL', 'Total');
define('TABLE_HEADING_PRICE_EXCLUDING_TAX', 'Price (ex)');
define('TABLE_HEADING_PRICE_INCLUDING_TAX', 'Price (inc)');
define('TABLE_HEADING_TOTAL_EXCLUDING_TAX', 'Total (ex)');
define('TABLE_HEADING_TOTAL_INCLUDING_TAX', 'Total (inc)');
define('ENTRY_SOLD_TO', 'SOLD TO:');
define('ENTRY_SHIP_TO', 'SHIP TO:');
define('ENTRY_PAYMENT_METHOD', 'Payment Method:');
define('ENTRY_PAYMENT_TYPE', 'Credit Card:');
define('PAYMENT_TYPE', 'Credit Card');
define('ENTRY_CC_OWNER', 'Credit Card Owner:');
define('ENTRY_CC_NUMBER', 'Credit Card Number:');
define('ENTRY_CC_EXP', 'Expiration Date:');
define('ENTRY_SUB_TOTAL', 'Sub-Total:');
define('ENTRY_PHONE', 'Phone:');
define('ENTRY_EMAIL', 'E-Mail:');
define('ENTRY_TAX', 'Tax:');
define('ENTRY_SHIPPING', 'Shipping:');
define('ENTRY_TOTAL', 'Total:');
define('TEXT_ORDER_NUMBER','Order Number:');
define('TEXT_ORDER_DATE','Order Date:');
define('TEXT_ORDER_FORMAT','F j, Y');
define('TEXT_CHOOSE_TEMPLATE','Choose the template of file you wish to print');
define('TEXT_CHOOSE_TEMPLATE','Please either enter the order numbers/ranges you want extracted to PDF:<br>(eg. 2577,2580-2585,2588)');
define('TEXT_DATES_ORDERS_EXTRACTRED','Or enter the dates of orders you want extracted to PDF:<br>(enter date in YYYY-MM-DD format)');
define('TEXT_FROM','From:');
define('TEXT_TO','To: ');
define('TEXT_PRINTING_LABELS_BILLING_DELIVERY','When Printing Labels :- Use Billing Address or Delivery Address?');
define('TEXT_DELIVERY','Delivery: ');
define('TEXT_BILLING','Billing: ');
define('TEXT_POSITION_START_PRINTING', 'Position to Start printing from:<br>(0 position is top left label, they increase from left to right then from top to bottom)');
define('TEXT_INCLUDE_ORDERS_STATUS', 'Only include orders with the status:<br>if none, all orders will be included)');
define('TEXT_SHOW_ORDER','Show order date?');
define('TEXT_SHOW_PHONE_NUMBER','Show customer\'s telephone number?');
define('TEXT_SHOW_EMAIL_CUSTOMER','Show customer\'s e-mail address?');
define('TEXT_PAYMENT_INFORMATION','Show payment information?');
define('TEXT_SHOW_CREDIT_CARD_NUMBER','Show credit card number? (for credit card orders only)');
define('TEXT_AUTOMACILLLY_CHANGE_ORDER','Automatically change order statuses to:<br>(if None, no statuses will be changed.)');
define('TEXT_SHOW_OREDERS_COMMENTS','Show orders without comments?<br>(Will NOT show order with comments placed by the customer at time of order.)');
define('TEXT_NOTIFY_CUSTOMER','Notify the customer via e-mail?<br>(This will notify the customer via e-mail with the comments in the batch print  language file.)');
define('TEXT_BANK','Bank: ');
define('TEXT_POST','Post: ');
define('TEXT_SALES','Sales: ');
define('TEXT_PACKED_BY','Packed By:  ______________________');
define('TEXT_VERIFIED_BY','Verified By:  ______________________');
define('TEXT_DEAR','Dear ');
define('TEXT_THX_CHRISMAS','Thanks for your continued support -----');
define('TEXT_RETURNS_LABEL', 'Returns Label Order: ');
define('TEXT_SHIPPING_LABEL', 'Shipping Label Order: ');
define('SHIP_FROM_COUNTRY', '');  //eg. 'United Kingdom'
define('WEBSITE', 'www.Your site.com');
define('TEXT_RETURNS', 'We hope you don\'t need it but we have provided a returns label just in case. Please see our returns policy at www.Your site.com/shipping.php');
define('TEXT_TO', 'To:');
// Change this to a general comment that you would like
define('BATCH_COMMENTS','Automatic order update notification.');
define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Order Update');
define('EMAIL_TEXT_ORDER_NUMBER', 'Order Number:');
define('EMAIL_TEXT_INVOICE_URL', 'Detailed Invoice:');
define('EMAIL_TEXT_DATE_ORDERED', 'Date Ordered:');
define('EMAIL_TEXT_STATUS_UPDATE', 'Your order has been updated to the following status.' . "\n\n" . 'New status: %s' . "\n\n" . 'Please reply to this email if you have any questions.' . "\n");
define('EMAIL_TEXT_COMMENTS_UPDATE', 'The comments for your order are' . "\n\n%s\n\n");

// RGB Colors
define('BLACK', '0,0,0');
define('GREY', '0.9,0.9,0.9');
define('DARK_GREY', '0.7,0.7,0.7');

// Error and Messages
$error['ERROR_INVALID_INPUT'] = 'Error: Internal Error: Unrecognized or invalid script input.';
$error['ERROR_BAD_DATE'] =  'Error: Invalid date, Please enter a valid date in Year-Month-Day (0000-00-00) format.';
$error['ERROR_BAD_INVOICENUMBERS'] =  'Error: Invalid Invoice numbers, Please enter a valid format. (eg. 2577,2580-2585,2588)';
$error['NO_ORDERS'] =  'Error: There were no orders selected for export, try changing your order options.';
$error['SET_PERMISSIONS'] = 'Error: Can\'t write to directory!  Please set the permissions of your temp_pdf folder to CHMOD 0755';
$error['FAILED_TO_OPEN'] = 'Error: Could not open file for writing, make sure correct permissions are set';

// PDF FONT SIZES
define('COMPANY_HEADER_FONT_SIZE','14');
define('SUB_HEADING_FONT_SIZE','11');
define('GENERAL_FONT_SIZE', '11');
define('GENERAL_LEADING', '12');
define('PRODUCT_TOTALS_LEADING', '11');
define('PRODUCT_TOTALS_FONT_SIZE', '10');
define('PRODUCT_ATTRIBUTES_FONT_SIZE', '8');
define('GENERAL_FONT_COLOR', BLACK);

// Margins and Page Size

// This works best with A4, could work with diffferent page sizes,
// However it would require playing with the table values and font values to fit properly
//define('PAGE','A4');
//define('LEFT_MARGIN','30');
// The small indents in the Sold to: Ship to: Text blocks
//define('TEXT_BLOCK_INDENT', '5');
//define('SHIP_TO_COLUMN_START','300');
// This changes the 'Total', 'Sub-Total', 'Tax', and 'Shipping Method' text block
// position, for example if you choose to make the text a bigger font size you need to 
// tweak this value in order to prevent the text from clashing together
//define('PRODUCT_TOTAL_TITLE_COLUMN_START','400');
//define('RIGHT_MARGIN','30');

// Batch Print Misc Vars
define('BATCH_PRINT_INC', DIR_WS_MODULES . 'batch_print/');
define('BATCH_PDF_DIR', BATCH_PRINT_INC . 'temp_pdf/');
//define('LINE_LENGTH', '552');
// If you have attributes for certain products, you can have the text wrap
// or just be written completely on one line, with the text wrap disabled
// it makes the tables smaller appear much better, of course that is only my opinion
// so I made this variable if anyone would like it to wrap.
//define('PRODUCT_ATTRIBUTES_TEXT_WRAP', false);
// This sets the space size between sections
//define('SECTION_DIVIDER', '15');
// Main File
define('BATCH_PRINT_FILE', 'batch_print.php');
// TEMP PDF FILE
define('BATCH_PDF_FILE', 'batch_orders.pdf');

// Product table Settings
//define('TABLE_HEADER_FONT_SIZE', '9');
//define('TABLE_HEADER_BKGD_COLOR', DARK_GREY);
//define('PRODUCT_TABLE_HEADER_WIDTH', '552');
// This is more like cell padding, it moves the text the number
// of points specified to make the rectangle appear padded
//define('PRODUCT_TABLE_BOTTOM_MARGIN', '2');
// Tiny indent right before the product name, again more like
// the cell padding effect
//define('PRODUCT_TABLE_LEFT_MARGIN', '2');
// Height of the product listing rectangles
//define('PRODUCT_TABLE_ROW_HEIGHT', '11');

// The column sizes are where the product listing columns start on the
// PDF page, if you make the TABLE HEADER FONT SIZE any larger you will
// need to tweak these values to prevent text from clashing together
//define('PRODUCTS_COLUMN_SIZE', '172');
//define('PRODUCT_LISTING_BKGD_COLOR',GREY);
//define('MODEL_COLUMN_SIZE', '37');
//define('PRICING_COLUMN_SIZES', '67');

define('FOOTER_TEXT', 'Thank you for shopping with us at ' . STORE_NAME);
?>