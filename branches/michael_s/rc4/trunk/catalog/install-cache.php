<?php
/*-----------------------------------------------------------------------------*\
#################################################################################
#	Script name: admin/install-seo.php
#	Version: v1.3
#
#	Copyright 2006 osCMax2005 Bobby Easland
#	Internet moniker: Chemo
#	Contact: chemo@mesoimpact.com
#
#	This script is free software; you can redistribute it and/or
#	modify it under the terms of the GNU General Public License
#	as published by the Free Software Foundation; either version 2
#	of the License, or (at your option) any later version.
#
#	This program is distributed in the hope that it will be useful,
#	but WITHOUT ANY WARRANTY; without even the implied warranty of
#	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
#	GNU General Public License for more details.
#
#	Script is intended to be used with:
#	osCMax Power E-Commerce
#	http://oscdox.com
#	Copyright 2006 osCMax
################################################################################
\*-----------------------------------------------------------------------------*/

require('includes/application_top.php');
$insert_values = array();

$insert_values[] = "DROP TABLE IF EXISTS `cache`";
$insert_values[] = "CREATE TABLE `cache` (
  `cache_id` varchar(32) NOT NULL default '',
  `cache_language_id` tinyint(1) NOT NULL default '0',
  `cache_name` varchar(255) NOT NULL default '',
  `cache_data` mediumtext NOT NULL,
  `cache_global` tinyint(1) NOT NULL default '1',
  `cache_gzip` tinyint(1) NOT NULL default '1',
  `cache_method` varchar(20) NOT NULL default 'RETURN',
  `cache_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `cache_expires` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`cache_id`,`cache_language_id`),
  KEY `cache_id` (`cache_id`),
  KEY `cache_language_id` (`cache_language_id`),
  KEY `cache_global` (`cache_global`)
) TYPE=MyISAM;"
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Install (and Uninstall) Database Table script for osC-Cache - by Chemo</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
body {
	font-family: Arial, Helvetica, sans-serif;
	background-attachment: fixed;
	background-image: url(http://forums.oscommerce.com/uploads/av-9196.jpg);
	background-repeat: no-repeat;
	background-position: right top;
	font-size: 12px;
}
-->
</style>
</head>
<body>
<?php
if ( isset($_GET['action']) && $_GET['action'] == 'install' ){
	echo '<p><b>Install option selected...running queries</b></p>';
	echo '<p>STEP 1 => Add cache table</p>';
	foreach ($insert_values as $index => $value_query){
		tep_db_query($value_query);
		echo "<p>$value_query<blockquote>Success...</blockquote></p>";
	}
	echo "<a href='".$_SERVER['PHP_SELF']."'><b>All done...back to the index</b></a>";
}
elseif ( isset($_GET['action']) && $_GET['action'] == 'delete' ){
	echo '<p><b>Uninstall option selected...running queries</b></p>';
	echo '<p>STEP 1 => Drop cache table</p>';
	tep_db_query("DROP TABLE `cache`");
	echo "<p>Cache table dropped<blockquote>Success...</blockquote></p>";
	echo "<a href='".$_SERVER['PHP_SELF']."'><b>All done...back to the index</b></a>";
}
else {
?>
<p>Welcome to the barebones osC-Cache installation script (<a href="http://forums.oscommerce.com/index.php?showuser=9196">by Chemo</a>)!</p>
<p>This contribution is GPL and the target audience is the advanced developer or store owner. Minimal support will be given for this but I wanted to upload it in case some wanted a copy. </p>
<p>There are two options for this script:</p>
<p><strong>INSTALL</strong></p>
<blockquote>
  <p>This option is self explanatory :) This will add the cache table. </p>
</blockquote>
<p align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=install"><b>INSTALL</b> THE DATABASE VALUES FOR ULTIMATE SEO URLs</a></p>
<p align="left"><strong>UNINSTALL</strong></p>
<blockquote>
  <p align="left">Hopefully, this option is self-explanatory too :)&nbsp; This will delete the cache table.</p>
</blockquote>
<p align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=delete"><b>UNINSTALL</b> THE DATABASE VALUES FOR ULTIMATE SEO URLs</a></p>
<?php
} # End default page
?>
</body>
</html>