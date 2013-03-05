<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<script src="http://www.google.com/jsapi"></script>
<script>
  // Load jQuery
  google.load("jquery", "1.4.0");
</script>

<script type="text/javascript">
function switchMAT() { 
	if($("#MAT").attr("checked")) {
		$("#MATtd").attr("class", "messageStackSuccess");
		$('#disableMAT').hide();
    	$('#enableMAT').show();
	} else {
		$("#MATtd").attr("class", "messageStackAlert");
		$('#disableMAT').show();
    	$('#enableMAT').hide();
	}
}

function warnMAT() {
		$("#MATtd").attr("class", "messageStackWarning");
}

</script>

<?php require('includes/javascript/form_check.js.php'); ?>
<?php require('includes/javascript/password_strength.js'); ?>

<script type="text/javascript">
$(document).ready(function(){
	$("#password_st").password_strength();
	$('#enableMAT').hide();
});
</script>