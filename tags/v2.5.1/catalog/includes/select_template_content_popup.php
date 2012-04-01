<?php
  /* bof BTSv1.4 */
  if(file_exists(DIR_WS_CONTENT . $content . '.tpl.php')) {
	  require(DIR_WS_CONTENT . $content . '.tpl.php');
  } else {
	  require(DIR_WS_CONTENT_FALLBACK . $content . '.tpl.php');	  
  }
?>