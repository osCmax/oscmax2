<script src="http://www.google.com/jsapi"></script>
<script>
  // Load jQuery
  google.load("jquery", "1.4.0");
</script>
<script type="text/javascript" src="<?php echo DIR_WS_JAVASCRIPT . 'slimbox2/slimbox2.js' ?>"></script>
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
var panels=new Array('panel0', 'panel1','panel2','panel3','panel4','panel5','panel6');var selectedTab=null;function showPanel(tab,name)
{if(selectedTab)
{selectedTab.style.backgroundColor='';selectedTab.style.paddingTop='';selectedTab.style.marginTop='4px';}
selectedTab=tab;selectedTab.style.backgroundColor='white';selectedTab.style.paddingTop='6px';selectedTab.style.marginTop='0px';for(i=0;i<panels.length;i++)
document.getElementById(panels[i]).style.display=(name==panels[i])?'block':'none';return false;}
<!--// TABS-->
</script>