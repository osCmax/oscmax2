<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<script src="http://www.google.com/jsapi" type="text/javascript"></script>
<script type="text/javascript">
  // Load jQuery
  google.load("jquery", "1.4.2");
</script>
<script type="text/javascript" src="includes/javascript/slimbox2/slimbox2.js"></script>
<?php include(DIR_WS_INCLUDES . 'javascript/sbcustom.php'); ?>
<?php include(DIR_WS_INCLUDES . 'javascript/cloud-zoom.1.0.2.js.php'); ?>
<script type="text/javascript" src="includes/javascript/jquery.scrollTo-min.js"></script>
<script type="text/javascript" src="includes/javascript/jquery.serialScroll-min.js"></script>
<script type="text/javascript" src="includes/javascript/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="includes/javascript/scrollable.min.js"></script>
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
	
	/*Code for Cloud Zoom -> Slimbox integration */
	function openimg() {
        /* Now need to find which image in the string the link one is */
		var image_array = "<?php echo $sb_image_string; ?>".split(",");
		var image_clicked = $("#zoom1").attr("href");
		
		var index, value, result;
		result = 0;
        
		for (index = 0; index < image_array.length; ++index) {
          value = image_array[index];
		  if (value.indexOf(image_clicked) == true) {
            result = index;
            break;
          }
        }		
		jQuery.slimbox(<?php echo $sb_string; ?>, result);
	 } 
//--></script>
<script language="javascript" type="text/javascript">
<!--// TABS -->
/*
jquery.semantictabs.js
Creates semantic tabs from nested divs
Chris Yates

Inspired by Niall Doherty's jQuery Coda-Slider v1.1 - http://www.ndoherty.com/coda-slider

Usage:
$("#mycontainer").semantictabs({
  panel:'.mypanelclass',         //-- Selector of individual panel body
  head:'headelement',           //-- Selector of element containing panel header
  active:':first',              //-- Which panel to activate by default
  activate:':eq(2)'             //-- Argument used to activate panel programmatically
});

1 Nov 2007

Bug fixes 15 Dec 2009:
http://plugins.jquery.com/node/11834
http://plugins.jquery.com/node/8486
(thanks zenmonkey)

Feature update 4 Jan 2010:
Now works with arbitrary jQuery selectors, not just 'class' attribute.

*/

jQuery.fn.semantictabs = function(passedArgsObj) {
  /* defaults */
  var defaults = {panel:'.panel', head:'h3', active:':first', activate:false};

  /* override the defaults if necessary */
  var args = jQuery.extend(defaults,passedArgsObj);
  
  // Allow activation of specific tab, by index
	if (args.activate) {
	  return this.each(function(){
	    var container = jQuery(this);
			container.find(args.panel).hide();
			container.find("ul.tabs li").removeClass("active");
			container.find(args.panel + ":eq(" + args.activate + ")").show();
			container.find("ul.tabs li:eq(" + args.activate + ")").addClass("active");
	  });
	} else {
    return this.each(function(){
  		// Load behavior
  		var container = jQuery(this);
        container.find(args.panel).hide();
  		container.find(args.panel + args.active).show();
  		container.prepend("<ul class=\"tabs semtabs\"><\/ul>");
  		container.find(args.panel).each( function() {
  		  var title = jQuery(this).find(args.head).text();
  		  this.title = title;
  			container.find("ul.tabs").append("<li><a href=\"javascript:void(0);\">"+title+"<\/a><\/li>");
  		});
  		container.find("ul li" + args.active).addClass("active");
  		// Tab click behavior
  		container.find("ul.tabs li").click(function(){
  			container.find(args.panel).hide();
  			container.find("ul.tabs li").removeClass("active");
  			container.find(args.panel + "[title='"+jQuery(this).text()+"']").show();
  			jQuery(this).addClass("active");
  		});                                
  		container.find("#remtabs").click(function(){
  			container.find("ul.tabs").remove();
  			container.find(args.container + " " + args.panel).show();
  			container.find("#remtabs").remove();
  		});
  	});
	}
		
};
<!--// TABS & SCROLLERS-->
</script>
<script type="text/javascript"> 
// initialise Tabs

$(document).ready(function(){
	$("#mytabset").semantictabs({
  		head:'h4',        //-- Selector of element containing panel header, i.e. h3
  		active:':first'            //-- Which panel to activate by default
	});

	$('#slideshow').serialScroll({
		items:'li',
		prev:'img.prev',
		next:'img.next',
		offset:-50, //when scrolling to photo, stop 230 before reaching it (from the left)
		start:0, //as we are centering it, start at the 2nd
		duration:1200,
		force:true,
		stop:true,
		lock:false,
		cycle:true, //don't pull back once you reach the end
		jump: false //click on the images to scroll to them
	});
	
	$(".scrollable").scrollable({ easing: "swing", circular: true });
	$(".scrollable_ap").scrollable({ easing: "swing", circular: true });


});
</script>
<script type="text/javascript"> 
// Plus/Minus Code
function TextBox_AddToIntValue(targetId,addToValue,minOrder)
{var input=document.getElementById(targetId);var textInt=parseInt(input.value);if(isNaN(textInt))
{textInt=0;}
input.value=textInt+addToValue;if(input.value<=minOrder){input.value=minOrder;}}
</script>
