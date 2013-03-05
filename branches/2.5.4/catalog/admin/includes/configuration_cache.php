<?php
/*
$Id: configuration_cache.php,v 1.32 2004/04/06 20:24:09 daemonj Exp $

osCommerce, Open Source E-Commerce Solutions
http://www.oscommerce.com

Copyright (c) 2003 osCommerce

Released under the GNU General Public License
*/

if (isset($config_cache_file) && $config_cache_file != '') {
   $config_cache_output = '<?php' . "\n";
   $configuration_query = tep_db_query('select distinct configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);
   while ($configuration = tep_db_fetch_array($configuration_query)) {
      $config_cache_output .= 'define(\'' . $configuration['cfgKey'] . '\',\'' . addslashes($configuration['cfgValue']) . '\'); ' . "\n";
   }
   $config_cache_output .= '?>';

   if (isset($config_cache_compress) && $config_cache_compress == 'true') {

      if (!isset($config_cache_compression_level) || ($config_cache_compression_level < 0 || $config_cache_compression_level > 4)) {
         // if the compression level is not defined, is negative, or greater than 5 then default to 1
         $config_cache_compression_level = 1;
      }

      $config_cache_output     = gzdeflate("?>$config_cache_output<?", $config_cache_compression_level);
      $config_cache_output     = base64_encode($config_cache_output);
      $new_config_cache_output = '';

      while (strlen($config_cache_output) > 0) {
         $new_config_cache_output .= substr($config_cache_output, 0, 80) . "\n";
         $config_cache_output = substr($config_cache_output, 80);
      }

      $config_cache_output = "<?php eval(gzinflate(base64_decode('\n$new_config_cache_output'))); ?>";
   }

   if (file_exists($config_cache_file))
     unlink($config_cache_file);
   $fp   = fopen($config_cache_file, 'w');
   $fout = fwrite($fp, $config_cache_output);
   fclose($fp);
}
?>