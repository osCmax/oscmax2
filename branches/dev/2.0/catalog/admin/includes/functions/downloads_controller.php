<?php
/*

  WebMakers.com Added: Downloads Controller Functions
  NOTE: Some function may already exist in other Add-Ons I have created.

*/
?>
<?php

////
// BOF: WebMakers.com Added: configuration key value lookup
  function tep_get_configuration_key_value($lookup) {
    $configuration_query_raw= tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key='" . $lookup . "'");
    $configuration_query= tep_db_fetch_array($configuration_query_raw);
    $lookup_value= $configuration_query['configuration_value'];
    return $lookup_value;
  }
// EOF: WebMakers.com Added: configuration key value lookup

?>
