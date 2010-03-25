<?php
// set paper type and size
if ($pageloop == "0") {
$pdf = new Cezpdf(Letter,portrait);
} else {

define('LEFT_MARGIN','30');
// The small indents in the Sold to: Ship to: Text blocks
define('TEXT_BLOCK_SMALL_INDENT', '5');
define('TEXT_BLOCK_INDENT', '25');

define('SHIP_TO_COLUMN_START','330');
define('MIDDLE_COLUMN_START','250');
define('RIGHT_COLUMN_START','450');
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
define('PRODUCT_ATTRIBUTES_TEXT_WRAP', true);
// This sets the space size between sections
define('SECTION_DIVIDER', '15');
// Product table Settings
define('TABLE_HEADER_FONT_SIZE', '10');
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
define('PRODUCTS_COLUMN_SIZE', '215');
define('PRODUCT_LISTING_BKGD_COLOR',GREY);
define('MODEL_COLUMN_SIZE', '62');
define('PRICING_COLUMN_SIZES', '52');

define('SMALL_LEADING', '6');
define('IPS_LEADING', '9');
define('LABEL_LEADING', '12');
define('IPS_FONT_SIZE', '10');
define('LABEL_FONT_SIZE', '12');
define('SENDER_TICKET_SIZE', '8');
define('SENDER_FONT_SIZE', '6');
define('SENDER_SMALL_FONT_SIZE', '7');
define('TICKET_FONT_SIZE', '7');
// This should go in the language file
$vilains = array("&#224;", "&#225;",  "&#226;", "&#227;", "&#228;", "&#229;", "&#230;", "&#231;", "&#232;", "&#233;", "&#234;", "&#235;", "&#236;", "&#237;", "&#238;", "&#239;", "&#240;", "&#241;", "&#242;", "&#243;", "&#244;", "&#245;", "&#246;", "&#247;", "&#248;", "&#249;", "&#250;", "&#251;", "&#252;", "&#253;", "&#254;", "&#255;", "&#223;","&#39;", "&nbsp;", "&agrave;", "&aacute;", "&atilde;","&auml;", "&Arond;", "&egrave;", "&aelig;", "&ecirc;", "&euml;", "&igrave;", "&iacute;", "&Iacute;", "&icirc;", "&iuml;", "&ograve;", "&oacute;", "&ocirc;", "&otilde;", "&ouml;", "&oslash;", "&ugrave;", "&uacute;", "&ucirc;", "&uuml;", "&ntilde;", "&ccedil;", "&yacute;", "&lt;","&gt;", "&amp;");
$cools = array('à','á','â','ã','ä','å','æ','ç','è','é','ê','ë','ì','í','î','ï','ð','ñ','ò','ó','ô','õ','ö','÷','ø','ù','ú','û','ü','ý','þ','ÿ','ß','\'', ' ','à','á','ã','ä','å','è','æ','ê','ë','ì','í','î','Î','ï','ò','ó','ô','õ','ö','ø','ù','ú','û','ü','ñ','ç','ý','<','>','&');

$currencies = new currencies();

$pdf->selectFont(BATCH_PDF_DIR . 'Helvetica.afm');
$pdf->setFontFamily(BATCH_PDF_DIR . 'Helvetica.afm');
 // set up delivery address array
$address_array=explode('<br>',tep_address_format($order->delivery['format_id'], $order->delivery, 1, '', '<br>'));

if (SHIP_FROM_COUNTRY == $address_array[count($address_array)-1]) {
 $address_array[count($address_array)-1] = '';
 }
$delivery_address_array = array();
$i = 0;
foreach ($address_array as $key => $value) {
  if ((!is_null($value))&& ($value !== "")) {
    $delivery_address_array[$i] = $value;
    $i++;
  }
}

 // set up billing address array
$address_array=explode('<br>',tep_address_format($order->billing['format_id'], $order->billing, 1, '', '<br>'));
$lines = count($address_array)-1;
if (SHIP_FROM_COUNTRY == $address_array[$lines]) {
 $address_array[$lines] = '';
 }
$billing_address_array = array();
$i = 0;
foreach ($address_array as $key => $value) {
  if ((!is_null($value))&& ($value !== "")) {
    $billing_address_array[$i] = $value;
    $i++;
  }
}

$address_array=explode('<br>', str_replace("\r\n", "<br>", STORE_NAME_ADDRESS));
$i = 0;
//The first $key number is the number of lines in your store name and address excluding the telephone number at the bottom.
//The second $key number is the number of lines in your store name and address excluding telephone number and country.
foreach ($address_array as $key=>$value)  {
if (((SHIP_FROM_COUNTRY != $order->delivery['country']) && ($key < 5)) || ($key < 4))
 {
    $store_address_array[$i] = $value;
   $i++;
}
}
$y=720;
$pos = $y;



foreach ($delivery_address_array as $key=>$value)  {
 $pdf->addText(LEFT_MARGIN,$pos -= SMALL_LEADING,SENDER_SMALL_FONT_SIZE,$value);
}

    $pos=$y;

//  $address_array=explode('<br>', str_replace("\r\n", "<br>", STORE_NAME_ADDRESS));
foreach ($store_address_array as $key=>$value)  {
// echo $value.'<br>' ;
 $pdf->addText(SHIP_TO_COLUMN_START,$pos -= SMALL_LEADING,SENDER_SMALL_FONT_SIZE,$value);
}
   $y-=55;
// company name and details pulled from the my store address and phone number
// in admin configuration mystore 
$pdf->setStrokeColor(0,0,0);
$pdf->setLineStyle(1);
$pdf->roundedRectangle(28,570,230,120,10,$f=0);

// order number
//$y = $pdf->ezText("" . TEXT_ORDER_NUMBER . " " . $orders['orders_id'] ."\n\n",SENDER_FONT_SIZE);
$indent =  LEFT_MARGIN +  TEXT_BLOCK_SMALL_INDENT;
$pdf->addText($indent,$y,SUB_HEADING_FONT_SIZE,"<b>" . TEXT_TO . "</b>");
//$y = $pdf->ezText(STORE_NAME_ADDRESS,GENERAL_FONT_SIZE);
$pos = $y;
$indent =  LEFT_MARGIN +  TEXT_BLOCK_INDENT;

foreach ($store_address_array as $key=>$value)  {
 $pdf->addText($indent,$pos -= LABEL_LEADING,LABEL_FONT_SIZE,"<b>".$value."</b>");
}


// logo image  set to right of the above .. change first number to move sideways    
// $pdf->addJpegFromFile(BATCH_PRINT_INC . 'templates/' . 'invoicelogo.jpg',365,730,85,85);


$pdf->setStrokeColor(0,0,0);
$pdf->setLineStyle(1);
$pdf->roundedRectangle(330,570,260,120,10,$f=0);


// ship to info in right column
$indent = SHIP_TO_COLUMN_START + TEXT_BLOCK_SMALL_INDENT;
$pdf->addText($indent,$y,SUB_HEADING_FONT_SIZE,"<b>" . TEXT_TO . "</b>");

$pos = $y;
$indent = SHIP_TO_COLUMN_START + TEXT_BLOCK_INDENT;


foreach ($delivery_address_array as $key=>$value)  {
 $pdf->addText($indent,$pos -= LABEL_LEADING,LABEL_FONT_SIZE,"<b>".$value."</b>");
}
$y -=105;
    // order number
 $pdf->addText(LEFT_MARGIN + 55,$y,TICKET_FONT_SIZE,"" . TEXT_RETURNS_LABEL . " " . $orders['orders_prefix'] . $orders['orders_id'] ."");

 $pdf->addText(SHIP_TO_COLUMN_START + 70,$y,TICKET_FONT_SIZE,"" . TEXT_SHIPPING_LABEL . " " . $orders['orders_prefix'] . $orders['orders_id'] ."");

// line between header order number and order date
$y -=30;
   $pdf->addText(LEFT_MARGIN,$y,TICKET_FONT_SIZE, TEXT_RETURNS);
  $y -=3;
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

$y -= 10;


//left rounded rectangle around sold to info
$pdf->setStrokeColor(0,0,0);
$pdf->setLineStyle(1);
$pdf->roundedRectangle(28,400,190,100,10,$f=0);


// sold to info in left rectangle    
$pdf->addText(LEFT_MARGIN,$y,SUB_HEADING_FONT_SIZE,"<b>" . ENTRY_SOLD_TO . "</b>");

$pos = $y;
$indent = LEFT_MARGIN + TEXT_BLOCK_INDENT;

//  $address_array=explode('<br>',tep_address_format($order->billing['format_id'], $order->billing, 1, '', '<br>'));
foreach ($billing_address_array as $key=>$value)  {
 $pdf->addText($indent,$pos -= IPS_LEADING,IPS_FONT_SIZE,$value);
}


if ($order->delivery != $order->billing)     {
// right rounded rectangle around ship to info
  $pdf->setStrokeColor(0,0,0);
  $pdf->setLineStyle(1);
  $pdf->roundedRectangle(228,400,190,100,10,$f=0);

// ship to info in middle column
  $pdf->addText(MIDDLE_COLUMN_START,$y,SUB_HEADING_FONT_SIZE,"<b>" . ENTRY_SHIP_TO . "</b>");

  $pos = $y;
  $indent = MIDDLE_COLUMN_START + TEXT_BLOCK_INDENT;

//  $address_array=explode('<br>',tep_address_format($order->delivery['format_id'], $order->delivery, 1, '', '<br>'));
  foreach ($delivery_address_array as $key=>$value)  {
   $pdf->addText($indent,$pos -= IPS_LEADING,IPS_FONT_SIZE,$value);
  }
}

// logo image  set to right below store name/address.. change first number to move sideways
$pdf->addJpegFromFile(BATCH_PRINT_INC . 'templates/' . 'integrated_logo.jpg',450,400,55,40);

  $pos = $y;
  $address_array=explode('<br>', str_replace("\r\n", "<br>", STORE_NAME_ADDRESS));
foreach ($address_array as $key=>$value)  {
// echo $value.'<br>' ;
 $pdf->addText(RIGHT_COLUMN_START,$pos -= IPS_LEADING,IPS_FONT_SIZE,$value);
}
  $pdf->addText(RIGHT_COLUMN_START,$pos -= IPS_LEADING,IPS_FONT_SIZE,WEBSITE);

// phone and email statments .. added blank lines if turned off so as to maintain layout
//if ($_POST['show_phone'] || $_POST['show_email'] ) {

$pos -= SECTION_DIVIDER;
$pdf->ezSetY($pos - 20 );

//if ($_POST['show_phone']) {
$pos = $pdf->ezText("<b>" . ENTRY_PHONE . "</b> " . $order->customer['telephone'],IPS_FONT_SIZE);

//}  if ($_POST['show_email']) {
$pos = $pdf->ezText("<b>" . ENTRY_EMAIL . "</b> " .$order->customer['email_address'],IPS_FONT_SIZE);
//}
//} else {

//$pos -= SECTION_DIVIDER;
//$pdf->ezSetY($pos - 40 );

//$pos = $pdf->ezText("");



//}
// divider between email and payment method 
 $pos -= SECTION_DIVIDER;
 $pdf->ezSetY($pos);
 
// payment method  
//if ($_POST['show_pay_method']) {
$pos = $pdf->ezText("<b>" . ENTRY_PAYMENT_METHOD . "</b> " . str_replace($vilains , $cools ,$order->info['payment_method']),IPS_FONT_SIZE);

//	if ($order->info['payment_method'] == PAYMENT_TYPE) {
//$pos = $pdf->ezText("<b>" . ENTRY_PAYMENT_TYPE . "</b> " . $order->info['cc_type'],IPS_FONT_SIZE);
//$pos = $pdf->ezText("<b>" . ENTRY_CC_OWNER . "</b> " . $order->info['cc_owner'],IPS_FONT_SIZE);
//		if ($_POST['show_cc']) {
//		$pos = $pdf->ezText("<b>" . ENTRY_CC_NUMBER . "</b> " . $order->info['cc_number'],IPS_FONT_SIZE);
//		}
		
//		$pos = $pdf->ezText("<b>" . ENTRY_CC_EXP . "</b> " . $order->info['cc_expires'],IPS_FONT_SIZE);
//	}

//}
$pos -= SECTION_DIVIDER;
 
// products , model etc table layout 
change_color(TABLE_HEADER_BKGD_COLOR);
$pdf->filledRectangle(LEFT_MARGIN,$pos-PRODUCT_TABLE_ROW_HEIGHT,PRODUCT_TABLE_HEADER_WIDTH,PRODUCT_TABLE_ROW_HEIGHT);

$x = LEFT_MARGIN + PRODUCT_TABLE_LEFT_MARGIN;
$pos = ($pos-PRODUCT_TABLE_ROW_HEIGHT) + PRODUCT_TABLE_BOTTOM_MARGIN;

change_color(GENERAL_FONT_COLOR);

$pdf->addText($x,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_PRODUCTS_MODEL);
$pdf->addText($x += MODEL_COLUMN_SIZE,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_PRODUCTS);
$pdf->addText($x += MODEL_COLUMN_SIZE + PRODUCTS_COLUMN_SIZE, $pos, TABLE_HEADER_FONT_SIZE, TABLE_HEADING_QTY);
if ( $billing_address_array[0] == $delivery_address_array[0]) {
  //$pdf->addText($x += MODEL_COLUMN_SIZE,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_TAX);
  $pdf->addText($x += MODEL_COLUMN_SIZE,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_PRICE_EXCLUDING_TAX);
  //$pdf->addText($x += PRICING_COLUMN_SIZES,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_PRICE_INCLUDING_TAX);
  $pdf->addText($x += PRICING_COLUMN_SIZES,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_TOTAL_EXCLUDING_TAX);
  //$pdf->addText($x += PRICING_COLUMN_SIZES,$pos,TABLE_HEADER_FONT_SIZE,TABLE_HEADING_TOTAL_INCLUDING_TAX);
  }

$pos -= PRODUCT_TABLE_BOTTOM_MARGIN;

// Sort through the products

for ($i = 0, $n = sizeof($order->products); $i < $n; $i++) {

//$prod_str = $order->products[$i]['qty'] . " x " . $order->products[$i]['name'];
$prod_str = $order->products[$i]['name'];


change_color(PRODUCT_LISTING_BKGD_COLOR);
$pdf->filledRectangle(LEFT_MARGIN,$pos-PRODUCT_TABLE_ROW_HEIGHT,PRODUCT_TABLE_HEADER_WIDTH,PRODUCT_TABLE_ROW_HEIGHT);

$x = LEFT_MARGIN + PRODUCT_TABLE_LEFT_MARGIN;
$pos = ($pos-PRODUCT_TABLE_ROW_HEIGHT) + PRODUCT_TABLE_BOTTOM_MARGIN;
//page feed
 if ($pos <= 30) {
 $pdf->ezNewPage();
 $pos =780;
 }
// end page feed
change_color(GENERAL_FONT_COLOR);

$pdf->rectangle(15,$pos-2,8,8);
// $pdf->addText($x += PRODUCTS_COLUMN_SIZE,$pos,TABLE_HEADER_FONT_SIZE,$order->products[$i]['model']);
$pdf->addText($x, $pos, TABLE_HEADER_FONT_SIZE, $order->products[$i]['model']);
$truncated_str = $pdf->addTextWrap($x += MODEL_COLUMN_SIZE,$pos,PRODUCTS_COLUMN_SIZE,TABLE_HEADER_FONT_SIZE,$prod_str);
$pdf->addText($x += MODEL_COLUMN_SIZE + PRODUCTS_COLUMN_SIZE,$pos,TABLE_HEADER_FONT_SIZE,$order->products[$i]['qty']);


if ( $billing_address_array[0] == $delivery_address_array[0]) {
  //$pdf->addText($x += MODEL_COLUMN_SIZE,$pos,TABLE_HEADER_FONT_SIZE,$order->products[$i]['tax']);
  $pdf->addText($x += MODEL_COLUMN_SIZE,$pos,TABLE_HEADER_FONT_SIZE,$currencies->format($order->products[$i]['final_price'], true, $order->info['currency'], $order->info['currency_value']));
  //$pdf->addText($x += PRICING_COLUMN_SIZES,$pos,TABLE_HEADER_FONT_SIZE,$currencies->format(tep_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']));
  $pdf->addText($x += PRICING_COLUMN_SIZES,$pos,TABLE_HEADER_FONT_SIZE,$currencies->format($order->products[$i]['final_price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']));
  //$pdf->addText($x += PRICING_COLUMN_SIZES,$pos,TABLE_HEADER_FONT_SIZE,$currencies->format(tep_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']));
  }
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
		$wrapped_str = $pdf->addTextWrap($reset_x += MODEL_COLUMN_SIZE,$pos,PRODUCTS_COLUMN_SIZE,PRODUCT_ATTRIBUTES_FONT_SIZE,$attrib_string);
		} else { 
		$pdf->addText($reset_x += MODEL_COLUMN_SIZE,$pos,PRODUCT_ATTRIBUTES_FONT_SIZE,$attrib_string);
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
 if ( $billing_address_array[0] == $delivery_address_array[0]) {
  $pos -= PRODUCT_TABLE_BOTTOM_MARGIN;
	
	for ($i = 0, $n = sizeof($order->totals); $i < $n; $i++) {
	
//$pdf->addText (LEFT_MARGIN ,$pos -= PRODUCT_TOTALS_LEADING,PRODUCT_TOTALS_FONT_SIZE,"<b>" . str_replace($vilains , $cools ,$order->totals[$i]['title']) . "</b>");

//$pdf->addText (355 ,$pos -= PRODUCT_TOTALS_LEADING,PRODUCT_TOTALS_FONT_SIZE,"<b>" . str_replace($vilains , $cools ,$order->totals[$i]['title']) . "</b>");   


//addTextWrap($x,$y,$width,$size,$text,$justification='left',$angle=0,$test=0)

$pdf->addTextWrap(250, $pos -= PRODUCT_TOTALS_LEADING, PRODUCTS_COLUMN_SIZE, PRODUCT_TOTALS_FONT_SIZE,"<b>" . str_replace($vilains , $cools ,$order->totals[$i]['title']) . "</b>",$justification='right');

$pdf->addText($x,$pos,PRODUCT_TOTALS_FONT_SIZE,$order->totals[$i]['text'], $order->info['currency_value']);
		
		} //EOFOR
  }
$pos -= SECTION_DIVIDER;

//if ($orders['comments']) {
//$pdf->ezSetY($pos);
//$pdf->ezText("<b>Comments:</b>\n" . $orders['comments'],IPS_FONT_SIZE);
//}

$innum = $orders['orders_id'];
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
