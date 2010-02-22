<div id="container">
		<div class="minitabsNav">
				<ul>
					<?php if ($product_info['tab1'] > '') { ?><li id="panel0"><?php  echo TAB0; ?></li><?php } ?>
                    <?php if ($product_info['tab1'] > '') { ?><li id="panel1"><?php  echo TAB1; ?></li><?php } ?>
                    <?php if ($product_info['tab2'] > '') { ?><li id="panel2"><?php  echo TAB2; ?></li><?php } ?>
                    <?php if ($product_info['tab3'] > '') { ?><li id="panel3"><?php  echo TAB3; ?></li><?php } ?>
                    <?php if ($product_info['tab4'] > '') { ?><li id="panel4"><?php  echo TAB4; ?></li><?php } ?>
                    <?php if ($product_info['tab5'] > '') { ?><li id="panel5"><?php  echo TAB5; ?></li><?php } ?>
					<?php if ($product_info['tab6'] > '') { ?><li id="panel6"><?php  echo TAB6; ?></li><?php } ?>
				</ul>
		</div>

<div class="minitabsContent" id="panel0" style="display: block"><?php echo stripslashes($product_info['products_description']); ?></div>
<div class="minitabsContent" id="panel1" style="display: none"><?php echo stripslashes($product_info['tab1']); ?></div>  
<div class="minitabsContent" id="panel2" style="display: none"><?php echo stripslashes($product_info['tab2']); ?></div>
<div class="minitabsContent" id="panel3" style="display: none"><?php echo stripslashes($product_info['tab3']); ?></div>
<div class="minitabsContent" id="panel4" style="display: none"><?php echo stripslashes($product_info['tab4']); ?></div>
<div class="minitabsContent" id="panel5" style="display: none"><?php echo stripslashes($product_info['tab5']); ?></div>
<div class="minitabsContent" id="panel6" style="display: none"><?php echo stripslashes($product_info['tab6']); ?></div>
</div>