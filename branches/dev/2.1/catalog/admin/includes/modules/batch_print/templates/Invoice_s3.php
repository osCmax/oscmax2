<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// set paper type and size
if ($pageloop == "0") {
$pdf = new Cezpdf(A4,portrait);
} else {

$pdf->ezStartPageNumbers(300,500,20,'left','','');

define('LEFT_MARGIN','30');
// The small indents in the Sold to: Ship to: Text blocks
define('TEXT_BLOCK_INDENT', '5');
define('SHIP_TO_COLUMN_START','300');
// This changes the 'Total', 'Sub-Total', 'Tax', and 'Shipping Method' text block
// position, for example if you choose to make the text a bigger font size you need to 
// tweak this value in order to prevent the text from clashing together
define('PRODUCT_TOTAL_TITLE_COLUMN_START','400');
define('RIGHT_MARGIN','30');
define('LINE_LENGTH', '565');
// If you have attributes for certain products, you can have the text wrap
// or just be written completely on one line, with the text wrap disabled
// it makes the tables smaller appear much better, of course that is only my opinion
// so I made this variable if anyone would like it to wrap.
define('PRODUCT_ATTRIBUTES_TEXT_WRAP', false);
// This sets the space size between sections
define('SECTION_DIVIDER', '15');
// Product table Settings
define('TABLE_HEADER_FONT_SIZE', '9');
define('TABLE_HEADER_BKGD_COLOR', GREY);
define('PRODUCT_TABLE_HEADER_WIDTH', '535');
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
define('PRODUCTS_COLUMN_SIZE', '320');
define('PRODUCT_LISTING_BKGD_COLOR', '1,1,1');
define('MODEL_COLUMN_SIZE', '87');
define('PRICING_COLUMN_SIZES', '67');

$vilains = array("&#224;", "&#225;",  "&#226;", "&#227;", "&#228;", "&#229;", "&#230;", "&#231;", "&#232;", "&#233;", "&#234;", "&#235;", "&#236;", "&#237;", "&#238;", "&#239;", "&#240;", "&#241;", "&#242;", "&#243;", "&#244;", "&#245;", "&#246;", "&#247;", "&#248;", "&#249;", "&#250;", "&#251;", "&#252;", "&#253;", "&#254;", "&#255;", "&#223;","&#39;", "&nbsp;", "&agrave;", "&aacute;", "&atilde;","&auml;", "&Arond;", "&egrave;", "&aelig;", "&ecirc;", "&euml;", "&igrave;", "&iacute;", "&Iacute;", "&icirc;", "&iuml;", "&ograve;", "&oacute;", "&ocirc;", "&otilde;", "&ouml;", "&oslash;", "&ugrave;", "&uacute;", "&ucirc;", "&uuml;", "&ntilde;", "&ccedil;", "&yacute;", "&lt;","&gt;", "&amp;", "&eacute;");
$cools = array('à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ð','ñ','ò','ó','ô','õ','ö','÷','ø','ù','ú','û','ü','ý','þ','ÿ','ß','\'', ' ','à','á','ã','ä','å','è','æ','ê','ë','ì','í','î','Î','ï','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ñ','ç','ý','<','>','&','é');

$currencies = new currencies();
//$pdf->setPreferences(array("HideToolbar" => 'false', "HideWindowUI" => 'false'));
$pdf->selectFont(BATCH_PDF_DIR . 'Helvetica.afm');
$pdf->setFontFamily(BATCH_PDF_DIR . 'Helvetica.afm');

// logo image
list($w, $h) = getimagesize(DIR_WS_IMAGES . STORE_LOGO);
if(stristr(STORE_LOGO, '.png') === FALSE) {
  $pdf->addJpegFromFile(DIR_WS_IMAGES . STORE_LOGO,30,730,$w,$h); 
} else {
  $pdf->addPngFromFile(DIR_WS_IMAGES . STORE_LOGO,30,730,$w,$h); 	
}

// invoice number and box
$pdf->setStrokeColor(0,0,0);
$pdf->setLineStyle(0.5);
$pdf->Rectangle(390,793,175,20);
$y = $pdf->ezText("<b>" . str_replace($vilains , $cools , TEXT_ORDER_NUMBER) . " </b>" . $orders['orders_prefix'] . $orders['orders_id'] ."\n\n",SUB_HEADING_FONT_SIZE, array('aleft'=>'400'));

// company name and details pulled from the my store address and phone number
// in admin configuration mystore 
$y += 10; 
$y = $pdf->ezText(STORE_NAME_ADDRESS,COMPANY_HEADER_FONT_SIZE,array('aleft'=>'400'));
$y -= 10; 

    // Add in the order titles	
	$totalsy = 230;
	$pdf->ezSetY($totalsy);
	for ($j = 0, $n = sizeof($order->totals); $j < $n; $j++) {
		$totaltext = str_replace($vilains , $cools ,$order->totals[$j]['title']);
		$fullstop = stripos($totaltext, ".");
		
		// Cuts shipping title at first '.' and replaces with :
		if ($fullstop != '0') {
		  $totaltext = substr($totaltext, 0, $fullstop);
		  $totaltext .= ":";
		} 
		
	  $pdf->ezText("<b>" . $totaltext . "</b>", PRODUCT_TOTALS_FONT_SIZE, array('justification' => 'right', 'right' => 80));

	} // end for
	
	//Add in the order totals
	$totalsy = 230;
	$pdf->ezSetY($totalsy);
	for ($j = 0, $n = sizeof($order->totals); $j < $n; $j++) {
	  $pdf->ezText($order->totals[$j]['text'], PRODUCT_TOTALS_FONT_SIZE, array('justification' => 'right', 'right' => 10));	
	}


$pdf->ezSetY($y);

// sold to address 
$pos = 720;
$indent = LEFT_MARGIN + TEXT_BLOCK_INDENT;

$pdf->addText($indent,$pos -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->billing['name']);

if ($order->billing['company'] && $order->billing['company'] != 'NULL') {
$pdf->addText($indent,$pos -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->billing['company']);
}

if ($order->billing['street_address'] && $order->billing['street_address'] != 'NULL') {
$pdf->addText($indent,$pos -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->billing['street_address']);
}

if ($order->billing['suburb'] && $order->billing['suburb'] != 'NULL') {
$pdf->addText($indent,$pos -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->billing['suburb']);
}

if ($order->billing['city'] && $order->billing['city'] != 'NULL') {
$pdf->addText($indent,$pos -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->billing['city']);
}

if ($order->billing['state'] && $order->billing['state'] != 'NULL') {
$pdf->addText($indent,$pos -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->billing['state']);
}

if ($order->billing['postcode'] && $order->billing['postcode'] != 'NULL') {
$pdf->addText($indent,$pos -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->billing['postcode']);
}

// phone and email statments - $pos reset to fix height
  $pos = 610;
  $pdf->ezSetY($pos);

    $pos = $pdf->ezText("<b>" . ENTRY_PHONE . "</b> " . $order->customer['telephone'],GENERAL_FONT_SIZE);
    $pos = $pdf->ezText("<b>" . ENTRY_EMAIL . "</b> " .$order->customer['email_address'],GENERAL_FONT_SIZE);
  
// payment method  
  $dup_y = 610;
  $pdf->ezSetY($dup_y);

  $dup_y = $pdf->ezText("<b>" . str_replace($vilains , $cools,  ENTRY_PAYMENT_METHOD) . "</b> " . str_replace($vilains , $cools, $order->info['payment_method']),GENERAL_FONT_SIZE, array('justification'=>'right'));

// order date
  $pdf->ezText("<b>" . str_replace($vilains , $cools,  TEXT_ORDER_DATE) . " </b>" . date(TEXT_ORDER_FORMAT, strtotime($order->info['date_purchased'])) ."\n\n",SUB_HEADING_FONT_SIZE,array('justification'=>'right'));


// divider between email and payment method 
 $pos -= SECTION_DIVIDER;
 $pdf->ezSetY($pos);
 
// Add Shipping Address in s3 box
$labelx = 90;
$labely = 180;

$pdf->addText($labelx,$labely,GENERAL_FONT_SIZE,$order->delivery['name']);

if ($order->delivery['company'] && $order->delivery['company'] != 'NULL') {
$pdf->addText($labelx,$labely -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->delivery['company']);
}

if ($order->delivery['street_address'] && $order->delivery['street_address'] != 'NULL') {
$pdf->addText($labelx,$labely -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->delivery['street_address']);
}

if ($order->delivery['suburb'] && $order->delivery['suburb'] != 'NULL') {
$pdf->addText($labelx,$labely -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->delivery['suburb']);
}

if ($order->delivery['city'] && $order->delivery['city'] != 'NULL') {
$pdf->addText($labelx,$labely -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->delivery['city']);
}

if ($order->delivery['state'] && $order->delivery['state'] != 'NULL') {
$pdf->addText($labelx,$labely -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->delivery['state']);
}

if ($order->delivery['postcode'] && $order->delivery['postcode'] != 'NULL') {
$pdf->addText($labelx,$labely -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->delivery['postcode']);
}

if ($order->delivery['country'] && $order->delivery['country'] != 'NULL') {
$pdf->addText($labelx,$labely -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->delivery['country']);
}

//Add order number to shipping label for s3
$pdf->ezSetY(90);
$pdf->ezText($orders['orders_id'], 6, array('left'=>'220'));

//Add footer text
$pdf->ezSetY(50);
$pdf->ezText(str_replace($vilains, $cools, FOOTER_TEXT),9, array('justification'=>'center'));

//Add some lines to make things look a bit neater!
//Add Footer Line
$pdf->setStrokeColor(0,0,0);
$pdf->setLineStyle(0.5);
$pdf->line(30,50,565,50);

//Add line to split for totals
$pdf->setStrokeColor(0,0,0);
$pdf->setLineStyle(0.5);
$pdf->line(30,240,565,240);

//Add line to top of products table
$pdf->setStrokeColor(0,0,0);
$pdf->setLineStyle(0.5);
$pdf->line(30,581,565,581);

//Set cursor to make sure products display in same place each time
$pos = 580;

// products table layout 
change_color(TABLE_HEADER_BKGD_COLOR);
$pdf->filledRectangle(LEFT_MARGIN,$pos-PRODUCT_TABLE_ROW_HEIGHT,PRODUCT_TABLE_HEADER_WIDTH,PRODUCT_TABLE_ROW_HEIGHT);

$x = LEFT_MARGIN + PRODUCT_TABLE_LEFT_MARGIN;
$pos = ($pos-PRODUCT_TABLE_ROW_HEIGHT) + PRODUCT_TABLE_BOTTOM_MARGIN;

change_color(GENERAL_FONT_COLOR);

$pdf->addText($x,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_PRODUCTS);

$pdf->addText($x += PRODUCTS_COLUMN_SIZE,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_PRODUCTS_MODEL);

$pdf->addText($x += MODEL_COLUMN_SIZE,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_PRICE_INCLUDING_TAX);

$pdf->addText($x += PRICING_COLUMN_SIZES,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_TOTAL_INCLUDING_TAX);

$pos -= PRODUCT_TABLE_BOTTOM_MARGIN;

// Sort through the products
for ($i = 0, $n = sizeof($order->products); $i < $n; $i++) {

$prod_str = $order->products[$i]['qty'] . " x " . $order->products[$i]['name'];

change_color(PRODUCT_LISTING_BKGD_COLOR);
$pdf->filledRectangle(LEFT_MARGIN,$pos-PRODUCT_TABLE_ROW_HEIGHT,PRODUCT_TABLE_HEADER_WIDTH,PRODUCT_TABLE_ROW_HEIGHT);

$x = LEFT_MARGIN + PRODUCT_TABLE_LEFT_MARGIN;
$pos = ($pos-PRODUCT_TABLE_ROW_HEIGHT) + PRODUCT_TABLE_BOTTOM_MARGIN;

change_color(GENERAL_FONT_COLOR);
$truncated_str = $pdf->addTextWrap($x,$pos,PRODUCTS_COLUMN_SIZE,TABLE_HEADER_FONT_SIZE,$prod_str);
$pdf->addText($x += PRODUCTS_COLUMN_SIZE,$pos,TABLE_HEADER_FONT_SIZE,$order->products[$i]['code']);

$pdf->addText($x += MODEL_COLUMN_SIZE,$pos,TABLE_HEADER_FONT_SIZE,$currencies->format(tep_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']));

$pdf->addText($x += PRICING_COLUMN_SIZES,$pos,TABLE_HEADER_FONT_SIZE,$currencies->format(tep_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']));
$pos -= PRODUCT_TABLE_BOTTOM_MARGIN;
if ($truncated_str) { 
	
	change_color(PRODUCT_LISTING_BKGD_COLOR);
	$pdf->filledRectangle(LEFT_MARGIN,$pos-PRODUCT_TABLE_ROW_HEIGHT,PRODUCT_TABLE_HEADER_WIDTH,PRODUCT_TABLE_ROW_HEIGHT);
	$pos = ($pos-PRODUCT_TABLE_ROW_HEIGHT) + PRODUCT_TABLE_BOTTOM_MARGIN;
	change_color(GENERAL_FONT_COLOR);
	$reset_x = LEFT_MARGIN + PRODUCT_TABLE_LEFT_MARGIN;
	$pdf->addText($reset_x,$pos,TABLE_HEADER_FONT_SIZE,$truncated_str);
	$pos -= PRODUCT_TABLE_BOTTOM_MARGIN;
	
	}
	
	if ( ($k = sizeof($order->products[$i]['attributes'])) > 0) {
        for ($j = 0; $j < $k; $j++) {
		$attrib_string = '<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
		if ($order->products[$i]['attributes'][$j]['price'] != '0') { 
		$attrib_string .= ' (' . $order->products[$i]['attributes'][$j]['prefix'] . 
		$currencies->format($order->products[$i]['attributes'][$j]['price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ')'; 
		
		}
		
		$attrib_string .= '</i>';
		change_color(PRODUCT_LISTING_BKGD_COLOR);
		$pdf->filledRectangle(LEFT_MARGIN,$pos-PRODUCT_TABLE_ROW_HEIGHT,PRODUCT_TABLE_HEADER_WIDTH,PRODUCT_TABLE_ROW_HEIGHT);
		$pos = ($pos-PRODUCT_TABLE_ROW_HEIGHT) + PRODUCT_TABLE_BOTTOM_MARGIN;
		change_color(GENERAL_FONT_COLOR);
		$reset_x = LEFT_MARGIN + PRODUCT_TABLE_LEFT_MARGIN;
		if (PRODUCT_ATTRIBUTES_TEXT_WRAP) {
		$wrapped_str = $pdf->addTextWrap($reset_x,$pos,PRODUCTS_COLUMN_SIZE,PRODUCT_ATTRIBUTES_FONT_SIZE,$attrib_string);
		} else { 
		$pdf->addText($reset_x,$pos,PRODUCT_ATTRIBUTES_FONT_SIZE,$attrib_string);
		}
		$pos -= PRODUCT_TABLE_BOTTOM_MARGIN;
	  			
					if ($wrapped_str) { 
					change_color(PRODUCT_LISTING_BKGD_COLOR);
					$pdf->filledRectangle(LEFT_MARGIN,$pos-PRODUCT_TABLE_ROW_HEIGHT,PRODUCT_TABLE_HEADER_WIDTH,PRODUCT_TABLE_ROW_HEIGHT);
					$pos = ($pos-PRODUCT_TABLE_ROW_HEIGHT) + PRODUCT_TABLE_BOTTOM_MARGIN;
					change_color(GENERAL_FONT_COLOR);
					$pdf->addText($reset_x,$pos,PRODUCT_ATTRIBUTES_FONT_SIZE,$wrapped_str);
					$pos -= PRODUCT_TABLE_BOTTOM_MARGIN;
					}
				}
			}

  // order runs over one page! 
  if ($pos <= 260) { 

    //Now add a new page
    $pdf->ezNewPage(); 
	

    //Add footer text
    $pdf->ezSetY(45);
    $pdf->ezText(FOOTER_TEXT,9, array('justification'=>'center'));

    //Add some lines to make things look a bit neater!
    //Add Footer Line
    $pdf->setStrokeColor(0,0,0);
    $pdf->setLineStyle(0.5);
    $pdf->line(30,50,565,50);

     //Add line to split for totals
    $pdf->setStrokeColor(0,0,0);
    $pdf->setLineStyle(0.5);
    $pdf->line(30,240,565,240);

    //Add line to top of products table
    $pdf->setStrokeColor(0,0,0);
    $pdf->setLineStyle(0.5);
    $pdf->line(30,821,565,821);

    //after first page set start pos higher up
    $pos = 820;

    // products table layout 
change_color(TABLE_HEADER_BKGD_COLOR);
$pdf->filledRectangle(LEFT_MARGIN,$pos-PRODUCT_TABLE_ROW_HEIGHT,PRODUCT_TABLE_HEADER_WIDTH,PRODUCT_TABLE_ROW_HEIGHT);

$x = LEFT_MARGIN + PRODUCT_TABLE_LEFT_MARGIN;
$pos = ($pos-PRODUCT_TABLE_ROW_HEIGHT) + PRODUCT_TABLE_BOTTOM_MARGIN;

change_color(GENERAL_FONT_COLOR);

$pdf->addText($x,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_PRODUCTS);

$pdf->addText($x += PRODUCTS_COLUMN_SIZE,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_PRODUCTS_MODEL);

$pdf->addText($x += MODEL_COLUMN_SIZE,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_PRICE_INCLUDING_TAX);

$pdf->addText($x += PRICING_COLUMN_SIZES,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_TOTAL_INCLUDING_TAX);

$pos -= PRODUCT_TABLE_BOTTOM_MARGIN;

 
  } // end if

} //end FOR

$pos -= PRODUCT_TABLE_BOTTOM_MARGIN;

// Add in the order titles (again incase order runs to two pages)
	$totalsy = 230;
	$pdf->ezSetY($totalsy);
	for ($j = 0, $n = sizeof($order->totals); $j < $n; $j++) {
		$totaltext = str_replace($vilains , $cools ,$order->totals[$j]['title']);
		$fullstop = stripos($totaltext, ".");
		
		// Cuts shipping title at first '.' and replaces with :
		if ($fullstop != '0') {
		  $totaltext = substr($totaltext, 0, $fullstop);
		  $totaltext .= ":";
		} 
		
	  $pdf->ezText("<b>" . $totaltext . "</b>", PRODUCT_TOTALS_FONT_SIZE, array('justification' => 'right', 'right' => 80));

	} // end for
	
	//Add in the order totals
	$totalsy = 230;
	$pdf->ezSetY($totalsy);
	for ($j = 0, $n = sizeof($order->totals); $j < $n; $j++) {
	  $pdf->ezText($order->totals[$j]['text'], PRODUCT_TOTALS_FONT_SIZE, array('justification' => 'right', 'right' => 10));	
	}
}



//require(BATCH_PRINT_INC . 'templates/' . 'grid.php');

?>