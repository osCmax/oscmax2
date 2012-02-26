<?php /* template for all boxes, edit and "save as" for individual boxes */ ?>
<div id="<?php if (isset($box_id)) {echo $box_id . 'LT';} ?>" summary="infoBox">
    <ul>
    	<li>
	    <h2><?php echo $boxHeading; ?><?php if (isset($boxLink)) echo $boxLink; ?></h2>
	   
        
		
		<?php echo $boxContent; ?>
        </li>	
         <ul>
	 	<li></li><p></p>
	 </ul>
    </ul>
</div>
