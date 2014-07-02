<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<link rel="stylesheet" type="text/css" href="ext/jQuery/themes/smoothness/ui.all.css">
<script type="text/javascript">    
document.write("\<script src='//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js' type='text/javascript'>\<\/script>");
document.write("\<script src='//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js' type='text/javascript'>\<\/script>");
</script>

<script type="text/javascript" language="javascript" src="<?php echo DIR_WS_TEMPLATES; ?>javascript/jqprint.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$('#conditions').each(function() {
		var $link = $(this);
		var $dialog = $('<div id="terms"><\/div>')
			.load($link.attr('href'))
			.dialog({
				autoOpen: false,
				title: $link.attr('title'),
				width: 700,
				height: 400,
				modal: true,
				buttons: { 
				"Ok": function() { $(this).dialog("close"); },
				"Print": function() { $("#terms").jqprint(); }
				}
			});

		$link.click(function() {
			$dialog.dialog('open');
            
			return false;
		});
	});
});
</script>