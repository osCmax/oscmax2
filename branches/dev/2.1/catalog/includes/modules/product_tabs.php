<div id="tabs">

<a class="tab" id="tab1" onclick="return false;" onmousedown="return event.returnValue = showPanel(this, 'panel0');" href=""><?php  echo TAB0; ?></a>

<?php
   if ($product_info['tab1'] > '') {
?>
<a class="tab" onclick="return false;" onmousedown="return event.returnValue = showPanel(this, 'panel1');" href=""><?php  echo TAB1; ?></a> 
<?php } ?>

<?php
   if ($product_info['tab2'] > '') {
?>
<a class="tab" onclick="return false;" onmousedown="return event.returnValue = showPanel(this, 'panel2');" href=""><?php  echo TAB2; ?></a></div>  
<?php } ?>

<?php
   if ($product_info['tab3'] > '') {
?>
<a class="tab" onclick="return false;" onmousedown="return event.returnValue = showPanel(this, 'panel3');" href=""><?php  echo TAB3; ?></a></div>  
<?php } ?>

<?php
   if ($product_info['tab4'] > '') {
?>
<a class="tab" onclick="return false;" onmousedown="return event.returnValue = showPanel(this, 'panel4');" href=""><?php  echo TAB4; ?></a></div>  
<?php } ?>

<?php
   if ($product_info['tab5'] > '') {
?>
<a class="tab" onclick="return false;" onmousedown="return event.returnValue = showPanel(this, 'panel5');" href=""><?php  echo TAB5; ?></a></div>  
<?php } ?>

<?php
   if ($product_info['tab6'] > '') {
?>
<a class="tab" onclick="return false;" onmousedown="return event.returnValue = showPanel(this, 'panel6');" href=""><?php  echo TAB6; ?></a></div>  
<?php } ?>
</div>

<div class="panel" id="panel0" style="display: block"><?php echo stripslashes($product_info['products_description']); ?></div>
<div class="panel" id="panel1" style="display: none"><?php echo stripslashes($product_info['tab1']); ?></div>  
<div class="panel" id="panel2" style="display: none"><?php echo stripslashes($product_info['tab2']); ?></div>
<div class="panel" id="panel3" style="display: none"><?php echo stripslashes($product_info['tab3']); ?></div>
<div class="panel" id="panel4" style="display: none"><?php echo stripslashes($product_info['tab4']); ?></div>
<div class="panel" id="panel5" style="display: none"><?php echo stripslashes($product_info['tab5']); ?></div>
<div class="panel" id="panel6" style="display: none"><?php echo stripslashes($product_info['tab6']); ?></div>
