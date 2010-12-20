<?php
// TWEAK THE SETTINGS TO SUIT YOUR LABELWRITER.
// set paper type and size
if ($pageloop == "0") {


define('PAGE_WIDTH', '8.9');
define('PAGE_HEIGHT', '3.6');
$pdf = new Cezpdf(array(PAGE_WIDTH, PAGE_HEIGHT));
 } else {
$currencies = new currencies();

$pdf->selectFont(BATCH_PDF_DIR . 'Helvetica.afm');
$pdf->setFontFamily(BATCH_PDF_DIR . 'Helvetica.afm');

$pdf->selectFont(LABEL_PDF_DIR . 'Helvetica.afm');
$pdf->setFontFamily(LABEL_PDF_DIR . 'Helvetica.afm');

//These Determine the Locations of the Labels, I think dimensions are (72 * inches)
// 2.54cm = 1 inch
define('SHIP_FROM_COUNTRY',  '');   // eg. 'United Kingdom'
define('BOX_WIDTH', '300');
define('LABEL_WIDTH', '200'); //Controls the second column
define('LABEL_HEIGHT', '90'); // controls the space between the labels
define('LEFT_MARGIN','190');
define('STARTX', '15'); //controls the first column
define('STARTY', '5'); // controls the space at the top of the file

//these control the little order_id text
define('ORDERIDFONTSIZE', '6');
define('ORDERIDXOFFSET', '20'); //position from the top right corner of label
define('ORDERIDYOFFSET', '-2');
define('SMALL_LEADING', '6');
define('SENDER_SMALL_FONT_SIZE', '5');
define('LABEL_FONT_SIZE', '9');
define('LABEL_LINE_SPACING', '10');
define('LABEL_FONT_COLOR', BLACK);

if ($_POST['pull_status']){ $pull_w_status = " and o.orders_status = ". $_POST['pull_status']; }
if ($_POST['startpos']){ $startpos = $_POST['startpos']; }
else { $startpos = 0; }

if ($_POST['endpos']){ $endpos = $_POST['endpos']; }
else { $endpos = NUM_LABELS_PER_PAGE; }


if (!tep_db_num_rows($orders_query) > 0) { message_handler('NO_ORDERS'); }

change_color(LABEL_FONT_COLOR);
//if ($num != 0)  $pdf->EzNewPage();
    $x=STARTX;
    $y=LABEL_HEIGHT;
$pos = $y;
//if ($orders = tep_db_fetch_array($orders_query)){
//$order = new order($orders['orders_id']);

$address_array=explode('<br>', str_replace("\r\n", "<br>", STORE_NAME_ADDRESS));

//The first $key number is the number of lines in your store name and address excluding the telephone number at the bottom.
//The second $key number is the number of lines in your store name and address excluding telephone number and country.
foreach ($address_array as $key=>$value)  {
if (((SHIP_FROM_COUNTRY != $order->delivery['country']) && ($key < 5)) || ($key < 4))
 {
      switch ($key)
   {
   case 0:
     $store_address_array[$key] = $value;
     break;
   case 1:
     $store_address_array[1] = $value;
     break;
        case 2:
     $store_address_array[2] = $value;
     break;
        case 3:
     $store_address_array[3] = $value;
     break;
        case 4:
     $store_address_array[4] = $value;
     break;
   default:
    $store_address_array[4] .= ', ';
    $store_address_array[4] .= $value;
    break;
   }

}
}
$pdf->setStrokeColor(0,0,0);
$pdf->setLineStyle(1);
$pdf->roundedRectangle(10,5,170,90,10,$f=0);
   $pos=$y - (2*GENERAL_LEADING);

//  $address_array=explode('<br>', str_replace("\r\n", "<br>", STORE_NAME_ADDRESS));
foreach ($store_address_array as $key=>$value)  {
// echo $value.'<br>' ;
 $pdf->addText(LEFT_MARGIN,$pos -= SMALL_LEADING,SENDER_SMALL_FONT_SIZE,$value);
}
$pdf->addText(LEFT_MARGIN,$pos -= LABEL_LINE_SPACING,ORDERIDFONTSIZE,'Order '.$orders['orders_id']);
$pos =$y;

if ($billing == true)
  $address_array=explode('<br>',tep_address_format($order->delivery['format_id'], $order->billing, 1, '', '<br>'));
else
  $address_array=explode('<br>',tep_address_format($order->delivery['format_id'], $order->delivery, 1, '', '<br>'));

if (SHIP_FROM_COUNTRY == $address_array[count($address_array)-1]) {
 $address_array[count($address_array)-1] = '';
 }
$print_address_array = array();
foreach ($address_array as $key => $value) {
  if ((!is_null($value))&& ($value !== "")) {
	$fontsize = LABEL_FONT_SIZE;
	while ($pdf->getTextWidth($fontsize, $value) > 160){
		$fontsize--;
	}
    $pdf->addText($x,$pos -= LABEL_LINE_SPACING,$fontsize,'<b>'.$value.'</b>');
  }
  }


}
?>
