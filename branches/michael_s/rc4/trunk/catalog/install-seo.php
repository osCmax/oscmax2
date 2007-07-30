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
# Configuration  group insert SQL
$sort_order_query = "SELECT MAX(sort_order) as max_sort FROM `configuration_group`";
$sort = tep_db_fetch_array( tep_db_query($sort_order_query) );
$next_sort = $sort['max_sort'] + 1;
$insert_group = "INSERT INTO `configuration_group` VALUES ('', 'SEO URLs', 'Options for Ultimate SEO URLs by Chemo', '".$next_sort."', '1')";
# Configuration insert SQL
$insert_values = array();
$insert_values[] = "INSERT INTO `configuration` VALUES ('', 'Enable SEO URLs?', 'SEO_URLS', 'false', 'Enable the SEO URLs?  This is a global setting and will turn them off completely.', GROUP_INSERT_ID, 0, NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),')";
$insert_values[] = "INSERT INTO `configuration` VALUES ('', 'Choose URL Type', 'SEO_URLS_TYPE', 'cName', 'Choose which SEO URL format to use:<br><br><b>cName =></b> /index.php?cName=XXX<br><b>Rewrite =></b> /XXX-c-1.html', GROUP_INSERT_ID, 1, NOW(), NOW(), NULL, 'tep_cfg_select_option(array(''cName'', ''Rewrite''),')";
$insert_values[] = "INSERT INTO `configuration` VALUES ('', 'Filter Short Words', 'SEO_URLS_FILTER_SHORT_WORDS', '3', 'This setting only affects the Rewrite option.  It will filter words less than or equal to the value from the URL.', GROUP_INSERT_ID, 2, NOW(), NOW(), NULL, NULL)";
$insert_values[] = "INSERT INTO `configuration` VALUES ('', 'Reset SEO URLs Cache', 'SEO_URLS_CACHE_RESET', 'false', 'This will reset the cache data for SEO', GROUP_INSERT_ID, 3, NOW(), NOW(), 'tep_reset_cache_data_seo_urls', 'tep_cfg_select_option(array(''reset'', ''false''),')";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
<head>
<title>Install (and Uninstall) Database Settings script for Ultimate SEO URLs 
- by Chemo</title>
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
	echo '<p>STEP 1 => Add configuration group</p>';
	tep_db_query($insert_group);
	$group_id = tep_db_insert_id();
	echo "<p>Added the configuration group (id=$group_id) successfully...adding configuration values</p>";
	echo '<p>STEP 2 => Add configuration settings</p>';
	foreach ($insert_values as $index => $value_query){
		$value_query = str_replace('GROUP_INSERT_ID', $group_id, $value_query);
		tep_db_query($value_query);
		echo "<blockquote>Success...</blockquote>";
	}
}
elseif ( isset($_GET['action']) && $_GET['action'] == 'delete' ){
	echo '<p><b>Uninstall option selected...running queries</b></p>';
	echo '<p>STEP 1 => Delete the configuration group from configuration_group table</p>';
	tep_db_query("DELETE FROM `configuration_group` WHERE `configuration_group_title` LIKE '%SEO URL%'");
	echo '<blockquote>Deleted the configuration group successfully...removing configuration values</blockquote>';
	echo '<p>STEP 2 => Delete configuraton values</p>';
	tep_db_query("DELETE FROM `configuration` WHERE `configuration_key` LIKE '%SEO%'");
	echo '<blockquote>Deleted the configuration values successfully...</blockquote>';
	echo '<p>STEP 3 => Analyzing configuration_group and configuration table</p>';
	tep_db_query("ANALYZE TABLE `configuration_group`");
		echo "<blockquote>Analyze configuration_group success...</blockquote>";
	tep_db_query("ANALYZE TABLE `configuration`");
		echo "<blockquote>Analyze configuration success...</blockquote>";
	tep_db_query("OPTIMIZE TABLE `configuration_group`");
		echo "<blockquote>Optimize configuration_group success...</blockquote>";
	tep_db_query("OPTIMIZE TABLE `configuration`");
		echo "<blockquote>Optimize configuration success...</blockquote>";
	echo "<p><b>All done!  You should delete this script from the server...or not...you're choice.</b></p>";	
}
else {
?>
<p>Welcome to the barebones Ultimate SEO URLs installation script (<a href="http://forums.oscommerce.com/index.php?showuser=9196">by 
  Chemo</a>)!</p>
<p>This contribution is GPL and the target audience is anyone with an osCommerce 
  store and wants an easy to use contribution for search engine friendly URLs.&nbsp; 
  I encourage each of you to look over the code and add functionality so that 
  the rest of us can benefit as well.</p>
<p>There are two options for this script:</p>
<p><strong>INSTALL</strong></p>
<blockquote>
  <p>This option is self explanatory :)&nbsp; It will add a configuration group 
    with the title &quot;SEO URLs&quot; and set the sort order to be the last 
    one listed in the configuration menu.&nbsp; The script will then add values 
    to the configuration table that are the options for this contribution.&nbsp; 
    Currently, these are available:</p>
  <ul>
    <li> Global Enable true / false</li>
    <li>Choose URL Type: cName or Rewrite</li>
    <li>Cache Directory</li>
    <li>Compress SEO Cache File</li>
  </ul>
</blockquote>
<p align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=install"><b>INSTALL</b> THE DATABASE VALUES FOR ULTIMATE SEO URLs</a></p>
<p align="left"><strong>UNINSTALL</strong></p>
<blockquote>
  <p align="left">Hopefully, this option is self-explanatory too :)&nbsp; This 
    will delete all the values associated with Ultimate SEO URLs from the configuration_group 
    and configuration tables.&nbsp; Then it will analyze the tables to reset the 
    cardinality of the tables</p>
</blockquote>
<p align="center"><a href="<?php echo $_SERVER['PHP_SELF']; ?>?action=delete"><b>UNINSTALL</b> THE DATABASE VALUES FOR ULTIMATE SEO URLs</a></p>
<p align="left"><strong>NOTES</strong>: By default all values are set to false.&nbsp; 
  So, once you have the files uploaded and necessary changes have been made you'll 
  have to enable it through the admin control panel.&nbsp; </p>
<blockquote>
  <p align="left">Configuration -&gt; Explain Queries -&gt; SEO URLs -&gt; Enable SEO URL's -&gt; true</p>
  <p align="left">Configuration -&gt; Explain Queries -&gt; SEO URLs -&gt; Cache Directory -&gt; /your/path/to/the/cache/dir/</p>
</blockquote>
<?php
} # End default page
?>
</body>
</html>