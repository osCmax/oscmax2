<?php
/*
$Id: configuration_cache_read.php,v 1.10 2004/04/06 20:56:34 daemonj Exp $

osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com

Copyright (c) 2003 osCommerce

Released under the GNU General Public License
*/
$config_cache_file              = FILENAME_CONFIGURATION_CACHE;
$config_cache_compress          = 'false'; // be sure to enclose in single quotes.
$config_cache_compression_level = 1; // 1 is the lowest and 4 is the highest.  1 should be used on busy and/or shared servers.
$config_cache_read              = false;
if (isset($config_cache_file) && $config_cache_file != '') {
   if (file_exists($config_cache_file)) {
      include($config_cache_file);
      $config_cache_read = true;
   }
}
if ($config_cache_read == false) {
   $configuration_query = tep_db_query("select configuration_key as cfgKey, configuration_value as cfgValue from " . TABLE_CONFIGURATION . " where configuration_key != ''");
   while ($configuration = tep_db_fetch_array($configuration_query)) {
      define($configuration['cfgKey'], $configuration['cfgValue']);
   }
}
?>