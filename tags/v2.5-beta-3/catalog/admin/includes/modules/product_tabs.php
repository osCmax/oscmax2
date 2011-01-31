<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<tr>
  <td colspan="2">
    <div id="languagetabs">
      <ul>
<!-- START OF LANGUAGE LOOP FOR LANGUAGE TAB HEADER-->
<?php
    for ($j=0, $n=sizeof($languages); $j<$n; $j++) {
?>
		<li>
                  <a href="#languagetabs-<?php echo $j ?>">
                     <?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$j]['directory'] . '/images/' . $languages[$j]['image'], $languages[$j]['name']); ?>
                  </a>
                </li>   
<?php
    }
?>
<!-- END OF LANGUAGE LOOP FOR LANGUAGE TAB HEADER -->
      </ul>

<?php
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
?>
<!-- START OF LANGUAGE LOOP FOR LANGUAGE TAB CONTENT -->
<div id="languagetabs-<?php echo $i ?>">

<!-- START TABS FOR PRODUCT DESCRIPTIONS -->
<div id="descriptiontabs<?php echo $i ?>">
	<ul>
		<li><a href="#descriptiontabs<?php echo $i ?>-0"><?php echo TEXT_PRODUCTS_DESCRIPTION; ?></a></li>
        <li><a href="#descriptiontabs<?php echo $i ?>-10"><?php echo TEXT_PRODUCTS_SHORT; ?></a></li>
		<li><a href="#descriptiontabs<?php echo $i ?>-1"><?php echo TAB1; ?></a></li>
		<li><a href="#descriptiontabs<?php echo $i ?>-2"><?php echo TAB2; ?></a></li>
		<li><a href="#descriptiontabs<?php echo $i ?>-3"><?php echo TAB3; ?></a></li>
		<li><a href="#descriptiontabs<?php echo $i ?>-4"><?php echo TAB4; ?></a></li>
		<li><a href="#descriptiontabs<?php echo $i ?>-5"><?php echo TAB5; ?></a></li>
		<li><a href="#descriptiontabs<?php echo $i ?>-6"><?php echo TAB6; ?></a></li>
	</ul>

	<div id="descriptiontabs<?php echo $i ?>-0">
        <?php echo tep_draw_textarea_field('products_description[' . $languages[$i]['id'] . ']', '70', '10', (isset($products_description[$languages[$i]['id']]) ? stripslashes($products_description[$languages[$i]['id']]) : tep_get_products_description($pInfo->products_id, $languages[$i]['id'])),'id = products_description[' . $languages[$i]['id'] . '] class="ckeditor"'); ?>   
	</div>

	<div id="descriptiontabs<?php echo $i ?>-10">
        <?php echo tep_draw_textarea_field('products_short[' . $languages[$i]['id'] . ']', '70', '10', (isset($products_short[$languages[$i]['id']]) ? stripslashes($products_short[$languages[$i]['id']]) : tep_get_products_short($pInfo->products_id, $languages[$i]['id'])),'id = products_short[' . $languages[$i]['id'] . '] class="ckeditor"'); ?>   
	</div>

	<div id="descriptiontabs<?php echo $i ?>-1">
         <?php echo tep_draw_textarea_field('tab1[' . $languages[$i]['id'] . ']', '70', '10', (isset($tab1[$languages[$i]['id']]) ? stripslashes($tab1[$languages[$i]['id']]) : tep_get_tab1($pInfo->products_id, $languages[$i]['id'])),'id = tab1[' . $languages[$i]['id'] . '] class="ckeditor"'); ?>
	</div>

	<div id="descriptiontabs<?php echo $i ?>-2">
         <?php echo tep_draw_textarea_field('tab2[' . $languages[$i]['id'] . ']', '70', '10', (isset($tab2[$languages[$i]['id']]) ? stripslashes($tab2[$languages[$i]['id']]) : tep_get_tab2($pInfo->products_id, $languages[$i]['id'])),'id = tab2[' . $languages[$i]['id'] . '] class="ckeditor"'); ?>
	</div>

	<div id="descriptiontabs<?php echo $i ?>-3">
         <?php echo tep_draw_textarea_field('tab3[' . $languages[$i]['id'] . ']', '70', '10', (isset($tab3[$languages[$i]['id']]) ? stripslashes($tab3[$languages[$i]['id']]) : tep_get_tab3($pInfo->products_id, $languages[$i]['id'])),'id = tab3[' . $languages[$i]['id'] . '] class="ckeditor"'); ?>
	</div>

	<div id="descriptiontabs<?php echo $i ?>-4">
         <?php echo tep_draw_textarea_field('tab4[' . $languages[$i]['id'] . ']', '70', '10', (isset($tab4[$languages[$i]['id']]) ? stripslashes($tab4[$languages[$i]['id']]) : tep_get_tab4($pInfo->products_id, $languages[$i]['id'])),'id = tab4[' . $languages[$i]['id'] . '] class="ckeditor"'); ?>
	</div>

	<div id="descriptiontabs<?php echo $i ?>-5">
          <?php echo tep_draw_textarea_field('tab5[' . $languages[$i]['id'] . ']', '70', '10', (isset($tab5[$languages[$i]['id']]) ? stripslashes($tab5[$languages[$i]['id']]) : tep_get_tab5($pInfo->products_id, $languages[$i]['id'])),'id = tab5[' . $languages[$i]['id'] . '] class="ckeditor"'); ?>    
	</div>

	<div id="descriptiontabs<?php echo $i ?>-6">
          <?php echo tep_draw_textarea_field('tab6[' . $languages[$i]['id'] . ']', '70', '10', (isset($tab6[$languages[$i]['id']]) ? stripslashes($tab6[$languages[$i]['id']]) : tep_get_tab6($pInfo->products_id, $languages[$i]['id'])),'id = tab6[' . $languages[$i]['id'] . '] class="ckeditor"'); ?>    
	</div>

</div><!-- END descriptiontabs DIV -->
</div>
<!-- END TABS FOR PRODUCT DESCRIPTIONS -->

<!-- END OF LANGUAGE LOOP FOR LANGUAGE TAB CONTENT -->
<?php
    }
?> 
    </div><!-- END languagetabs DIV -->
    
  </td>
</tr>