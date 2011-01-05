<?php
  /*
  osCmax e-Commerce
  http://oscmax.com

  Copyright 2010 osCMax

  Released under the GNU General Public License
  */

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');

		$info_id = intval($_GET['info_id']);
		$languages_id = intval($_GET['languages_id']);
		$information_query = tep_db_query("SELECT information_title, information_description FROM " . TABLE_INFORMATION . " WHERE information_id='" . $info_id . "' and language_id='" . (int)$languages_id . "'");
		$information = tep_db_fetch_array($information_query);
		$title = stripslashes($information['information_title']);
		$page_description = stripslashes($information['information_description']);
	
		// Added as noticed by infopages module
		if (!preg_match("/([\<])([^\>]{1,})*([\>])/i", $page_description)) 
		{
		  	$page_description = str_replace("\r\n", "<br>\r\n", $page_description); 
		}

  echo $page_description;
  
  require(DIR_WS_INCLUDES . 'application_bottom.php'); 
?>