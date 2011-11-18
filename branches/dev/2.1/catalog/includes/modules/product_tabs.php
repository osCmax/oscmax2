<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<div id="mytabset">
    <div class="panel">
      <h4><?php  echo TAB0; ?></h4>
       <?php echo stripslashes($product_info['products_description']); ?>
    </div>

	<?php if ($product_info['tab1'] > '') { ?>  
      <div class="panel" id="tab1">
        <h4><?php  echo TAB1; ?></h4>
         <?php echo stripslashes($product_info['tab1']); ?>
      </div>
    <?php } ?>
      
    <?php if ($product_info['tab2'] > '') { ?>  
      <div class="panel" id="tab2">
        <h4><?php  echo TAB2; ?></h4>
         <?php echo stripslashes($product_info['tab2']); ?>
      </div>
    <?php } ?>
    
    <?php if ($product_info['tab3'] > '') { ?>  
      <div class="panel" id="tab3">
        <h4><?php  echo TAB3; ?></h4>
         <?php echo stripslashes($product_info['tab3']); ?>
      </div>
    <?php } ?>
    
    <?php if ($product_info['tab4'] > '') { ?>  
      <div class="panel" id="tab4">
        <h4><?php  echo TAB4; ?></h4>
         <?php echo stripslashes($product_info['tab4']); ?>
      </div>
    <?php } ?>
    
    <?php if ($product_info['tab5'] > '') { ?>  
      <div class="panel" id="tab5">
        <h4><?php  echo TAB5; ?></h4>
         <?php echo stripslashes($product_info['tab5']); ?>
      </div>
    <?php } ?>
    
    <?php if ($product_info['tab6'] > '') { ?>  
      <div class="panel" id="tab6">
        <h4><?php  echo TAB6; ?></h4>
         <?php echo stripslashes($product_info['tab6']); ?>
      </div>
    <?php } ?>  
</div>
