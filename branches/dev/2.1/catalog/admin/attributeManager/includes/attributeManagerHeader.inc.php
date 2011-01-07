<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

if('new_product' == $action || 'update_product' == $action) {
$amSessionVar = tep_session_name().'='.tep_session_id();
echo <<<HEADER
<script language="JavaScript" type="text/JavaScript">
	var productsId='{$_GET['pID']}';
	var pageAction='{$_GET['action']}';
	var sessionId='{$amSessionVar}';
</script>
<script language="JavaScript" type="text/JavaScript" src="attributeManager/javascript/requester.js"></script>
<script language="JavaScript" type="text/JavaScript" src="attributeManager/javascript/alertBoxes.js"></script>
<script language="JavaScript" type="text/JavaScript" src="attributeManager/javascript/attributeManager.js"></script>

<link rel="stylesheet" type="text/css" href="attributeManager/css/attributeManager.css" />
HEADER;
}
?>

<script language="JavaScript" type="text/javascript">

function goOnLoad() {
	<?php	if('new_product' == $action || 'update_product' == $action) echo 'attributeManagerInit();';	?>
	SetFocus();
}

</script>
