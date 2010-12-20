<?php
/*
$Id: main_page.php 3 2006-05-27 04:59:07Z user $

  osCmax Power E-Commerce
  http://oscdox.com

  Copyright 2008 osCmax

  Released under the GNU General Public License
*/
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>osCmax, osCommerce with teeth!</title>
<meta name="robots" content="noindex,nofollow">
<link rel="stylesheet" type="text/css" href="templates/main_page/stylesheet.css">
<link rel="stylesheet" type="text/css" href="ext/niftycorners/niftyCorners.css">
<script type="text/javascript" src="ext/niftycorners/nifty.js"></script>
</head>

<body>
<center>
<table width="960" border="0" cellpadding="0" cellspacing="0">
<tr>
<td>
<div id="pageHeader">
  <div>
    <div style="float: right; padding-top: 25px; padding-right: 25px; color: #000000; font-size:14px; font-weight: bold;"><a href="http://www.oscmax.com" target="_blank">osCmax Website</a> &nbsp;|&nbsp; <a href="http://www.osCmax.com/forums" target="_blank">Support</a> &nbsp;|&nbsp; <a href="http://shop.oscmax.com/" target="_blank">Documentation</a> &nbsp;|&nbsp; <a href="http://wiki.oscdox.com/" target="_blank">Wiki</a></div>

    <a href="index.php"><img src="images/oscmax-logo.png" border="0" width="187" height="54" alt="osCmax" title="osCmax Power E-Commerce <?php echo PROJECT_VERSION; ?>" style="margin: 5px 10px 0px 10px;" /></a>
  </div>
</div>

<script type="text/javascript">
<!--
  if (NiftyCheck()) {
    Rounded("div#pageHeader", "all", "#FFFFFF", "#f7f7f5", "smooth border #b3b6b0");
  }
//-->
</script>

<div id="pageContent">
<?php require('templates/pages/' . $page_contents); ?>
</div>

<div id="pageFooter">
<center>
<table width="100%"> 
  <tr>
    <td width="20%">&nbsp;</td>
    <td width="60%" align="center">Copyright &copy; 2000-<?php echo date("Y"); ?> <a href="http://www.osCmax.com" target="_blank">osCmax</a> <br />osCmax provides no warranty and is redistributable under the <a href="http://www.fsf.org/licenses/gpl.txt" target="_blank">GNU General Public License</a></td>
    <td width="20%" align="right"><a href="http://users.skynet.be/mgueury/mozilla/"><img src="http://users.skynet.be/mgueury/mozilla/serial_16.gif" alt="Validated by HTML Validator" height="16" width="39"/></a></td>
  </tr>
</table>
</center>
</div>
</td>
</tr>
</table>
</center>
</body>

</html>