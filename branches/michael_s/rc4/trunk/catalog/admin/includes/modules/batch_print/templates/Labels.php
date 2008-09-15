<?php

// set paper type and size
if ($pageloop == "0") {
$pdf = new Cezpdf(A4,portrait);
} else {
$currencies = new currencies();

$pdf->selectFont(BATCH_PDF_DIR . 'Helvetica.afm');
$pdf->setFontFamily(BATCH_PDF_DIR . 'Helvetica.afm');

//How many labels to print on a Page
define('NUM_COLUMNS', '2');
define('NUM_ROWS', '8');
define('NUM_LABELS_PER_PAGE', NUM_ROWS * NUM_COLUMNS);

//These Determine the Locations of the Labels, I think dimensions are (72 * inches)
// 2.54cm = 1 inch
define('LABEL_WIDTH', '284'); //Controls the second column
define('LABEL_HEIGHT', '96'); // controls the space between the labels
define('STARTX', '22'); //controls the first column
define('STARTY', '5'); // controls the space at the top of the file

//these control the little order_id text
define('ORDERIDFONTSIZE', '6');
define('ORDERIDXOFFSET', '20'); //position from the top right corner of label
define('ORDERIDYOFFSET', '-2');

define('GENERAL_FONT_SIZE', '14');
define('GENERAL_LINE_SPACING', '15');
define('GENERAL_FONT_COLOR', BLACK);

if ($HTTP_POST_VARS['pull_status']){ $pull_w_status = " and o.orders_status = ". $HTTP_POST_VARS['pull_status']; }
if ($HTTP_POST_VARS['startpos']){ $startpos = $HTTP_POST_VARS['startpos']; }
else { $startpos = 0; }
if ($HTTP_POST_VARS['address']){ 
if ($HTTP_POST_VARS['address'] == "billing")
$billing = true;
else
$billing = false;
}
else { $billing = false; }

if ($HTTP_POST_VARS['endpos']){ $endpos = $HTTP_POST_VARS['endpos']; }
else { $endpos = NUM_LABELS_PER_PAGE; }


if (!tep_db_num_rows($orders_query) > 0) { message_handler('NO_ORDERS'); }

change_color(GENERAL_FONT_COLOR); 
for($y = $pdf->ez['pageHeight'] - STARTY; $y > LABEL_HEIGHT - STARTY; $y -= LABEL_HEIGHT) {


	for ($x = STARTX; $x < STARTX + NUM_COLUMNS * LABEL_WIDTH; $x += LABEL_WIDTH){
		if ($startpos <= $pos && $num < $endpos){
        
			if (print_address($x, $y, $num))
				$num++;
		}
		$pos++;
	}

// Send fake header to avoid timeout, got this trick from phpMyAdmin
	$time1  = time();
	if ($time1 >= $time0 + 30) {
		$time0 = $time1;
		header('X-bpPing: Pong');
	}
}// EOWHILE



}

?>
