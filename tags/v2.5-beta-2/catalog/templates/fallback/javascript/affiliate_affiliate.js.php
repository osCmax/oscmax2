<link rel="stylesheet" type="text/css" href="ext/jQuery/themes/smoothness/ui.all.css">
<script type="text/javascript" language="javascript" src="ext/jQuery/jQuery.js"></script>
<script type="text/javascript" language="javascript" src="ext/jQuery/jQuery.ui.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	$('#conditions').each(function() {
		var $link = $(this);
		var $dialog = $('<div><\/div>')
			.load($link.attr('href'))
			.dialog({
				autoOpen: false,
				title: $link.attr('title'),
				width: 700,
				height: 400,
				modal: true,
				buttons: { "Ok": function() { 
				  $(this).dialog("close"); 
				} }
			});

		$link.click(function() {
			$dialog.dialog('open');
            
			return false;
		});
	});
});
</script>