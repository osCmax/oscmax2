<?php

// set paper type and size
if ($pageloop == "0") {
$pdf = new Cezpdf(A4,portrait);
} else {

$pdf->selectFont(BATCH_PDF_DIR . 'Helvetica.afm');
$pdf->setFontFamily(BATCH_PDF_DIR . 'Helvetica.afm');
$y=10;
$i=0;
do
{
$i++;
$y = $y+20;
$pdf->setLineStyle(1);
$pdf->line(0,$y,600,$y);
$pdf->addText(0,$y,8,"$y");
$pdf->ezSetY($y);
$dup_y = $y;
}
while ($i<40);


$x=10;
$i=0;
do
{
$i++;
$x = $x+20;
$pdf->setLineStyle(1);
$pdf->line($x,0,$x,900);
$pdf->addText($x,0,8,"$x");
$pdf->ezSetY($x);
$dup_x = $x;
}
while ($i<30);

}
?>
