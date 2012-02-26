<?php
  /* BTSv1.4 */   
   if (isset($content_template) && file_exists(DIR_WS_CONTENT . basename($content_template))) { 
    // load special dynamic template from "templates/yourtemplatedir/content/" or else from "templates/fallback/content/"
    if(is_file(DIR_WS_CONTENT . $content_template)) { require(DIR_WS_CONTENT . basename($content_template)); } else { require(DIR_WS_CONTENT_FALLBACK . basename($content_template)); }
  } else {
    // load default/static template from "templates/yourtemplatedir/content/" or else from "templates/fallback/content/"
    if(is_file(DIR_WS_CONTENT . $content . '.tpl.php')) { require(DIR_WS_CONTENT . $content . '.tpl.php'); } else { require(DIR_WS_CONTENT_FALLBACK . $content . '.tpl.php'); }
  } 

?>