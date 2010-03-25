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
define('PRODUCT_TABLE_HEADER_WIDTH', '530');
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
$vilains = array("&#224;", "&#225;",  "&#226;", "&#227;", "&#228;", "&#229;", "&#230;", "&#231;", "&#232;", "&#233;", "&#234;", "&#235;", "&#236;", "&#237;", "&#238;", "&#239;", "&#240;", "&#241;", "&#242;", "&#243;", "&#244;", "&#245;", "&#246;", "&#247;", "&#248;", "&#249;", "&#250;", "&#251;", "&#252;", "&#253;", "&#254;", "&#255;", "&#223;","&#39;", "&nbsp;", "&agrave;", "&aacute;", "&atilde;","&auml;", "&Arond;", "&egrave;", "&aelig;", "&ecirc;", "&euml;", "&igrave;", "&iacute;", "&Iacute;", "&icirc;", "&iuml;", "&ograve;", "&oacute;", "&ocirc;", "&otilde;", "&ouml;", "&oslash;", "&ugrave;", "&uacute;", "&ucirc;", "&uuml;", "&ntilde;", "&ccedil;", "&yacute;", "&lt;","&gt;", "&amp;");
$cools = array('à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ð','ñ','ò','ó','ô','õ','ö','÷','ø','ù','ú','û','ü','ý','þ','ÿ','ß','\'', ' ','à','á','ã','ä','å','è','æ','ê','ë','ì','í','î','Î','ï','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ñ','ç','ý','<','>','&');

$currencies = new currencies();

$pdf->selectFont(BATCH_PDF_DIR . 'Helvetica.afm');
$pdf->setFontFamily(BATCH_PDF_DIR . 'Helvetica.afm');

// company name and details pulled from the my store address and phone number
// in admin configuration mystore 
$y = $pdf->ezText(STORE_NAME_ADDRESS,COMPANY_HEADER_FONT_SIZE);
$y -= 10; 

// logo image  set to right of the above .. change first number to move sideways    
$pdf->addJpegFromFile(BATCH_PRINT_INC . 'templates/' . 'invoicelogo.jpg',365,730,85,85); 

// extra info boxs to be used by staff
$pdf->setStrokeColor(0,0,0);
$pdf->setLineStyle(1);
$pdf->roundedRectangle(470,730,85,85,10,$f=0);
$pdf->rectangle(535,748,10,10);
$pdf->rectangle(535,769,10,10);
$pdf->rectangle(535,790,10,10);
$pdf->addText(480,790,GENERAL_FONT_SIZE,TEXT_BANK);
$pdf->addText(480,769,GENERAL_FONT_SIZE,TEXT_POST);
$pdf->addText(480,748,GENERAL_FONT_SIZE,TEXT_SALES);


// line between header order number and order date
$pdf->setLineStyle(1);
$pdf->line(LEFT_MARGIN,$y,LINE_LENGTH,$y);
$pdf->ezSetY($y);
$dup_y = $y;

// order number
$y = $pdf->ezText("<b>" . TEXT_ORDER_NUMBER . " </b>" . $orders['orders_prefix'] . $orders['orders_id'] ."\n\n",SUB_HEADING_FONT_SIZE);

// order date
if ($_POST['show_order_date']) { 
	$pdf->ezSetY($dup_y);
	$pdf->ezText("<b>" . TEXT_ORDER_DATE . " </b>" . date(TEXT_ORDER_FORMAT, strtotime($order->info['date_purchased'])) ."\n\n",SUB_HEADING_FONT_SIZE,array('justification'=>'right'));
	}




//left rounded rectangle around sold to info
$pdf->setStrokeColor(0,0,0);
$pdf->setLineStyle(1);
$pdf->roundedRectangle(28,580,260,120,10,$f=0);


// sold to info in left rectangle    
$pdf->addText(LEFT_MARGIN,$y,SUB_HEADING_FONT_SIZE,"<b>" . ENTRY_SOLD_TO . "</b>");

$pos = $y;
$indent = LEFT_MARGIN + TEXT_BLOCK_INDENT;

$pdf->addText($indent,$pos -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->billing['name']);
if ($order->billing['company'] && $order->billing['company'] != 'NULL') {
$pdf->addText($indent,$pos -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->billing['company']);
}
$pdf->addText($indent,$pos -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->billing['street_address']);

if ($order->billing['suburb'] && $order->billing['suburb'] != 'NULL') {
$pdf->addText($indent,$pos -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->billing['suburb']);
}

$cty_st_zip = $order->billing['city'] . " " . $order->billing['state'] . ", " . $order->billing['postcode'];
$pdf->addText($indent,$pos -= GENERAL_LEADING,GENERAL_FONT_SIZE,$cty_st_zip);


// right rounded rectangle around ship to info
$pdf->setStrokeColor(0,0,0);
$pdf->setLineStyle(1);
$pdf->roundedRectangle(298,580,260,120,10,$f=0);



// ship to info in right column
$pdf->addText(SHIP_TO_COLUMN_START,$y,SUB_HEADING_FONT_SIZE,"<b>" . ENTRY_SHIP_TO . "</b>");

$pos = $y;
$indent = SHIP_TO_COLUMN_START + TEXT_BLOCK_INDENT;


$pdf->addText($indent,$pos -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->delivery['name']);
if ($order->delivery['company'] && $order->delivery['company'] != 'NULL') {
$pdf->addText($indent,$pos -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->delivery['company']);
}
$pdf->addText($indent,$pos -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->delivery['street_address']);

if ($order->delivery['suburb'] && $order->delivery['suburb'] != 'NULL') {
$pdf->addText($indent,$pos -= GENERAL_LEADING,GENERAL_FONT_SIZE,$order->delivery['suburb']);
}

$cty_st_zip = $order->delivery['city'] . " " . $order->delivery['state'] . ", " . $order->delivery['postcode'];
$pdf->addText($indent,$pos -= GENERAL_LEADING,GENERAL_FONT_SIZE,$cty_st_zip);

$country =  $order->delivery['country'];
$pdf->addText($indent,$pos -= GENERAL_LEADING,GENERAL_FONT_SIZE,$country);


// phone and email statments .. added blank lines if turned off so as to maintain layout
if ($_POST['show_phone'] || $_POST['show_email'] ) {

$pos -= SECTION_DIVIDER;
$pdf->ezSetY($pos - 40 );

if ($_POST['show_phone']) {
$pos = $pdf->ezText("<b>" . ENTRY_PHONE . "</b> " . $order->customer['telephone'],GENERAL_FONT_SIZE);

}  if ($_POST['show_email']) {
$pos = $pdf->ezText("<b>" . ENTRY_EMAIL . "</b> " .$order->customer['email_address'],GENERAL_FONT_SIZE);
}
} else {

$pos -= SECTION_DIVIDER;
$pdf->ezSetY($pos - 40 );

$pos = $pdf->ezText("");
$pos = $pdf->ezText("");


} 
// divider between email and payment method 
 $pos -= SECTION_DIVIDER;
 $pdf->ezSetY($pos);
 
// payment method  
if ($_POST['show_pay_method']) {
$pos = $pdf->ezText("<b>" . ENTRY_PAYMENT_METHOD . "</b> " . str_replace($vilains , $cools, $order->info['payment_method']),GENERAL_FONT_SIZE);

if ($order->info['payment_method'] == PAYMENT_TYPE) {
$pos = $pdf->ezText("<b>" . ENTRY_PAYMENT_TYPE . "</b> " . $order->info['cc_type'],GENERAL_FONT_SIZE);
$pos = $pdf->ezText("<b>" . ENTRY_CC_OWNER . "</b> " . $order->info['cc_owner'],GENERAL_FONT_SIZE);
		if ($_POST['show_cc']) {
		$pos = $pdf->ezText("<b>" . ENTRY_CC_NUMBER . "</b> " . $order->info['cc_number'],GENERAL_FONT_SIZE);
		}
		
		$pos = $pdf->ezText("<b>" . ENTRY_CC_EXP . "</b> " . $order->info['cc_expires'],GENERAL_FONT_SIZE);
	}

}
$pos -= SECTION_DIVIDER;
 
// products , model etc table layout 
change_color(TABLE_HEADER_BKGD_COLOR);
$pdf->filledRectangle(LEFT_MARGIN,$pos-PRODUCT_TABLE_ROW_HEIGHT,PRODUCT_TABLE_HEADER_WIDTH,PRODUCT_TABLE_ROW_HEIGHT);

$x = LEFT_MARGIN + PRODUCT_TABLE_LEFT_MARGIN;
$pos = ($pos-PRODUCT_TABLE_ROW_HEIGHT) + PRODUCT_TABLE_BOTTOM_MARGIN;

change_color(GENERAL_FONT_COLOR);

$pdf->addText($x,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_PRODUCTS);
$pdf->addText($x += PRODUCTS_COLUMN_SIZE,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_PRODUCTS_MODEL);
$pdf->addText($x += MODEL_COLUMN_SIZE,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_TAX);
$pdf->addText($x += PRICING_COLUMN_SIZES,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_PRICE_EXCLUDING_TAX);
$pdf->addText($x += PRICING_COLUMN_SIZES,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_PRICE_INCLUDING_TAX);
$pdf->addText($x += PRICING_COLUMN_SIZES,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_TOTAL_EXCLUDING_TAX);
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
$pdf->addText($x += PRODUCTS_COLUMN_SIZE,$pos,TABLE_HEADER_FONT_SIZE,$order->products[$i]['model']);
$pdf->addText($x += MODEL_COLUMN_SIZE,$pos,TABLE_HEADER_FONT_SIZE,$order->products[$i]['tax']);
$pdf->addText($x += PRICING_COLUMN_SIZES,$pos,TABLE_HEADER_FONT_SIZE,$currencies->format($order->products[$i]['final_price'], true, $order->info['currency'], $order->info['currency_value']));
$pdf->addText($x += PRICING_COLUMN_SIZES,$pos,TABLE_HEADER_FONT_SIZE,$currencies->format(tep_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']));
$pdf->addText($x += PRICING_COLUMN_SIZES,$pos,TABLE_HEADER_FONT_SIZE,$currencies->format($order->products[$i]['final_price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']));
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
  } //EOFOR

$pos -= PRODUCT_TABLE_BOTTOM_MARGIN;
	
	for ($i = 0, $n = sizeof($order->totals); $i < $n; $i++) {
	
$pdf->addText (LEFT_MARGIN ,$pos -= PRODUCT_TOTALS_LEADING,PRODUCT_TOTALS_FONT_SIZE,"<b>" . str_replace($vilains , $cools ,$order->totals[$i]['title']) . "</b>");
$pdf->addText($x,$pos,PRODUCT_TOTALS_FONT_SIZE,$order->totals[$i]['text'], $order->info['currency_value']);
		
		} //EOFOR

$pos -= SECTION_DIVIDER;


$innum = $orders['orders_prefix'].$orders['orders_id'];
$orders_comments_query = tep_db_query("select comments,date_added from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_id = '$innum' order by date_added");
if (tep_db_num_rows($orders_comments_query)) {
    while ($orders_comments = tep_db_fetch_array($orders_comments_query)) {
    if(tep_not_null($orders_comments['comments'])){
            $pdf->ezSetY($pos);
            $pdf->ezText(date(TEXT_ORDER_FORMAT, strtotime($orders_comments['date_added'])) ,6);
            $y = $pdf->ezText("<b>Comments:</b> " . $orders_comments['comments'],GENERAL_FONT_SIZE);
            $pos = ($y -5);
        }
    }
}



//require(BATCH_PRINT_INC . 'templates/' . 'grid.php');


}
?>
