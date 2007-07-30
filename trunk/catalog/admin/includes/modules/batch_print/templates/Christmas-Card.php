<?php

// set paper type and size
if ($pageloop == "0") {
$pdf = new Cezpdf(A4,portrait);
} else {
$currencies = new currencies();

$pdf->selectFont(BATCH_PDF_DIR . 'Helvetica.afm');
$pdf->setFontFamily(BATCH_PDF_DIR . 'Helvetica.afm');


// logo image  set to right of the above .. change first number to move sideways    
$pdf->addJpegFromFile(BATCH_PRINT_INC . 'templates/' . 'christmascard.jpg',0,0,590,820); 

$pdf->addText(330,330,GENERAL_FONT_SIZE,Dear );
$pdf->addText(350,310,GENERAL_FONT_SIZE,$order->billing['name']);
$pdf->addText(350,290,GENERAL_FONT_SIZE,'Thanks for your continued support');

//require(BATCH_PRINT_INC . 'templates/' . 'grid.php');

}

?>
