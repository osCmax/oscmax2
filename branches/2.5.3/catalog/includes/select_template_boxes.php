<?php

  if(file_exists(DIR_WS_BOX_TEMPLATES . $box_base_name . '.tpl.php'))
  {
  // if exists, load unique box template for this box from templates/boxes/
      require(DIR_WS_BOX_TEMPLATES . $box_base_name . '.tpl.php');
  }
  elseif(file_exists(DIR_WS_BOX_TEMPLATES_FALLBACK . $box_base_name . '.tpl.php'))
  {
      // if exists, load unique box template for this box from templates/boxes/
          require(DIR_WS_BOX_TEMPLATES_FALLBACK . $box_base_name . '.tpl.php');
  }
         
  elseif(file_exists(DIR_WS_BOX_TEMPLATES . TEMPLATENAME_BOX)) 
  {
      // if exists, load unique box template for this box from templates/boxes/
	            require(DIR_WS_BOX_TEMPLATES . TEMPLATENAME_BOX);
  }
  else
  {
          require(DIR_WS_BOX_TEMPLATES_FALLBACK . TEMPLATENAME_BOX);	            
  
  }
?>