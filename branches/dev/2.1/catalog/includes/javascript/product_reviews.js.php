<script src="http://www.google.com/jsapi"></script>
<script>
  // Load jQuery
  google.load("jquery", "1.4.0");
</script>
<script type="text/javascript" src="includes/javascript/slimbox2/slimbox2.js"></script>
<?php include(DIR_WS_INCLUDES . 'javascript/sbcustom.php'); ?>
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','slimbox2.css')); // BTSv1.5 ?>">
<script type="text/javascript">
function popupWindow(url) {
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=100,height=100,screenX=150,screenY=150,top=150,left=150')
}
//--></script>
<script type="text/javascript"> 
// Plus/Minus Code
function TextBox_AddToIntValue(targetId,addToValue)
{var input=document.getElementById(targetId);var textInt=parseInt(input.value);if(isNaN(textInt))
{textInt=0;}
input.value=textInt+addToValue;if(input.value<=1){input.value=1;}}
</script>