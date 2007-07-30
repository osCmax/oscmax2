<?php

// set paper type and size
if ($pageloop == "0") {
$pdf = new Cezpdf(A4,portrait);
} else {

define('LEFT_MARGIN','30');
// The small indents in the Sold to: Ship to: Text blocks
define('TEXT_BLOCK_INDENT', '5');
define('SHIP_TO_COLUMN_START','300');
// This changes the 'Total', 'Sub-Total', 'Tax', and 'Shipping Method' text block
// position, for example if you choose to make the text a bigger font size you need to 
// tweak this value in order to prevent the text from clashing together
define('PRODUCT_TOTAL_TITLE_COLUMN_START','400');
define('RIGHT_MARGIN','30');


define('LINE_LENGTH', '552');
// If you have attributes for certain products, you can have the text wrap
// or just be written completely on one line, with the text wrap disabled
// it makes the tables smaller appear much better, of course that is only my opinion
// so I made this variable if anyone would like it to wrap.
define('PRODUCT_ATTRIBUTES_TEXT_WRAP', false);
// This sets the space size between sections
define('SECTION_DIVIDER', '15');
// Product table Settings
define('TABLE_HEADER_FONT_SIZE', '9');
define('TABLE_HEADER_BKGD_COLOR', DARK_GREY);
define('PRODUCT_TABLE_HEADER_WIDTH', '540');
// This is more like cell padding, it moves the text the number
// of points specified to make the rectangle appear padded
define('PRODUCT_TABLE_BOTTOM_MARGIN', '2');
// Tiny indent right before the product name, again more like
// the cell padding effect
define('PRODUCT_TABLE_LEFT_MARGIN', '2');
// Height of the product listing rectangles
define('PRODUCT_TABLE_ROW_HEIGHT', '11');
// The column sizes are where the product listing columns start on the
// PDF page, if you make the TABLE HEADER FONT SIZE any larger you will
// need to tweak these values to prevent text from clashing together
define('PRODUCTS_COLUMN_SIZE', '165');
define('PRODUCT_LISTING_BKGD_COLOR',GREY);
define('MODEL_COLUMN_SIZE', '37');
define('PRICING_COLUMN_SIZES', '67');


$currencies = new currencies();

$pdf->selectFont(BATCH_PDF_DIR . 'Helvetica.afm');
$pdf->setFontFamily(BATCH_PDF_DIR . 'Helvetica.afm');
//watermark
$pdf->addJpegFromFile(BATCH_PRINT_INC . 'templates/' . 'watermark.jpg',30,110,550,550); 
// company name and details pulled from the my store address and phone number
// in admin configuration mystore 
//$pdf->addJpegFromFile('./invoicelogo.jpg',23,150,567,567); 
//$pdf->addText(132,489,70,"YOUR WATERMARK",-45);
$y = $pdf->ezText(STORE_NAME_ADDRESS,COMPANY_HEADER_FONT_SIZE);
$y -= 10; 

// logo image  set to right of the above .. change first number to move sideways    
$pdf->addJpegFromFile(BATCH_PRINT_INC . 'templates/' . 'invoicelogo.jpg',480,730,85,85); 

// line between header and rest of page
$pdf->setLineStyle(1);
$pdf->line(LEFT_MARGIN,$y,LINE_LENGTH,$y);
$pdf->ezSetY($y);
$dup_y = $y;


$pos -= SECTION_DIVIDER;

}
?>
