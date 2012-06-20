<?php
/*
$Id: sbcustom.php 983 2011-01-06 03:17:08Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<script type="text/javascript"><!--
jQuery(function($) {
	$("a[rel^='lightbox']").slimbox({
	/* Put custom options here */
	loop: <?php echo SLIMBOX_LOOP ;?>,
	initialWidth: <?php echo SLIMBOX_WIDTH ;?>,
	initialHeight: <?php echo SLIMBOX_HEIGHT ;?>,
	overlayOpacity: <?php echo SLIMBOX_OPACITY ;?>,
	overlayFadeDuration: <?php echo SLIMBOX_FADE ;?>,
	imageFadeDuration: <?php echo SLIMBOX_IMAGE ;?>,
	resizeDuration: <?php echo SLIMBOX_RESIZE ;?>,
	counterText: <?php echo SLIMBOX_COUNTER ;?>,
	captionAnimationDuration: <?php echo SLIMBOX_CAPTION ;?>, 
	resizeEasing: <?php echo SLIMBOX_EASING ;?> 
	/* End of custom options */
	}, null, function(el) {
		return (this == el) || ((this.rel.length > 8) && (this.rel == el.rel));
	});
});
//--></script>