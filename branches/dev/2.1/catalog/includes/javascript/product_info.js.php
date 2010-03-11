<script src="http://www.google.com/jsapi"></script>
<script>
  // Load jQuery
  google.load("jquery", "1.4.0");
</script>
<script type="text/javascript" src="includes/javascript/slimbox2/slimbox2.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','slimbox2.css')); // BTSv1.5 ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','dynamic_mopics.css')); // BTSv1.5 ?>">
<script language="javascript" type="text/javascript"><!--
	function popupImage(url, imageHeight, imageWidth) {
		var newImageHeight = (parseInt(imageHeight) + 40);
		var yPos = ((screen.height / 2) - (parseInt(newImageHeight) / 2));
		var xPos = ((screen.width / 2) - (parseInt(imageWidth) / 2));

		imageWindow = window.open(url,'popupImages','toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=' + imageWidth + ',height=' + newImageHeight + ',screenY=' + yPos + ',screenX=' + xPos + ',top=' + yPos + ',left=' + xPos);

		imageWindow.moveTo(xPos, yPos);
		imageWindow.resizeTo(parseInt(imageWidth), parseInt(newImageHeight));

		if (window.focus) {
			imageWindow.focus();
		}
	}
//--></script>
<script language="javascript" type="text/javascript">
<!--// TABS -->
/**
 * minitabs (jQuery plugin)
 * Nizam Sayeed (nizam@nomadjourney.com)
 * Licensed under the MIT license (http://www.opensource.org/licenses/mit-license.php) 
 *
 * Version: 1.0
 * Requires: jQuery 1.2.6+
 * 
 * Based on simpleTabs (http://supercanard.phpnet.org/jquery-test/simpleTabs/)
 * Originally developed by: Jonathan Coulet (j.coulet@gmail.com)
 *
 * Example:
 *
 *     $( '#myTabs' ).minitabs({
 *         first: '#minitabFoo',
 *         callback: myFunc,
 *         speed: 'slow'
 *     });
 *
 **/
(function( $ ) {
	$.fn.minitabs = function( opt ) {
		var options = jQuery.extend( {
			first: '',            // id of first tab to activate
			callback: null,       // callback function when a tab is switched
			speed: 'fast'         // transition effect speed
		}, opt );

		$( this ).each( function() {
			var tabContainer = '#' + this.id;
			hideAll();

			// if first tab id is not provided, try to guess
			if( options.first == '' ) {
				var first = $( this ).children( 'div.minitabsNav' ).children( 
					'ul' ).children( 'li' )[ 0 ];
				options.first = '#' + $( first ).attr( 'id' );
			}
			changeTab( options.first );
			
			// hide all tab content divs
			function hideAll() {
				$( tabContainer + ' .minitabsContent' ).hide();
			}
			
			// change active tab
			function changeTab( tabId ) {
				hideAll();
				$( tabContainer + ' .minitabsNav li' ).removeClass( 'active' );
				$( tabContainer + ' .minitabsNav ' + tabId ).addClass( 'active' );
				$( tabContainer + ' div.minitabsContent' + tabId ).fadeIn( options.speed );
				if( $.isFunction( options.callback ) ) {
					options.callback.apply();
				}
			}

			// attach tab click event
			$( tabContainer + ' .minitabsNav li' ).click( function() {
				changeTab( '#' + this.id );
			});
		});
	}
})( jQuery );

$( document ).ready( function() {			
			$( '#container' ).minitabs();
		});

<!--// TABS-->
</script>