<?php /* template for all boxes, edit and "save as" for individual boxes */ ?>
<li><div id="sidebar"><table cellspacing="0" id="<?php if (isset($box_id)) {echo $box_id . 'LT';} ?>" summary="infoBox">
 <tr><td><div><h2><?php echo $boxHeading; ?></h2></div><?php echo $boxLink; ?></td></tr>
 <tr><td><ul><li><?php echo $boxContent; ?></li></ul></td></tr>
</table></div></li>
