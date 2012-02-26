<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<?php

  // Check language pack for installer
  if (isset($_GET['language'])) {
    $language_selected = ($_GET['language']);
  } elseif (isset($_POST['language'])) {
	$language_selected = ($_POST['language']);  
  } else {
	$language_selected = 'english';
  }
  
$languages_array = array();
$full_path = "includes/languages/";
if ($handle = opendir("$full_path")) {
  while (false !== ($file = readdir($handle))) {
    if (is_dir($full_path . "/" . $file)) {
      if ($file != '..' && $file != '.') {
        $languages_array[] = $file;
	  }
    } 
  }
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>osCmax e-Commerce</title>
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
    <div style="float: right; padding-top: 25px; padding-right: 25px; color: #000000; font-size:14px; font-weight: bold;"><a href="http://www.oscmax.com" target="_blank"><?php echo TEXT_OSCMAX_WEBSITE; ?></a> &nbsp;|&nbsp; <a href="http://www.osCmax.com/forums" target="_blank"><?php echo TEXT_FORUM; ?></a> &nbsp;|&nbsp; <a href="http://shop.oscmax.com/" target="_blank"><?php echo TEXT_DOCUMENTATION; ?></a> &nbsp;|&nbsp; <a href="http://wiki.oscdox.com/" target="_blank"><?php echo TEXT_WIKI; ?></a></div>

    <a href="index.php"><img src="images/oscmax-logo.png" border="0" width="187" height="54" alt="osCmax" title="Copyright 2000 - 2011 osCmax <?php echo PROJECT_VERSION; ?>" style="margin: 5px 10px 0px 10px;" /></a>
    
    <form name="languages" action="index.php" method="post" style="text-align:right">
    <select name="language" onChange="this.form.submit();">
    <?php 
	for ($i=0, $n=sizeof($languages_array); $i<$n; $i++) { 
      if ($language_selected == $languages_array[$i]) {
        echo '<option value="' . $languages_array[$i] . '" selected="selected">' . $languages_array[$i] . '</option>';
      } else {
		echo '<option value="' . $languages_array[$i] . '">' . $languages_array[$i] . '</option>';  
	  }
    } // end for
	?>
    </select>&nbsp;
    </form>
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
    <td width="60%" align="center">Copyright &copy; 2000-<?php echo date("Y"); ?> <a href="http://www.osCmax.com" target="_blank">osCmax</a> <br /><?php echo TEXT_FOOTER_DISCLAIMER; ?></td>
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