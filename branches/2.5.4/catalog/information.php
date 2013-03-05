<?php
/*
$Id$

  osCmax e-Commerce
  http://oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');
  
  require(bts_select('language', FILENAME_INFORMATION));
		
	// Added for information pages
	if (!isset($_GET['info_id']) || !tep_not_null($_GET['info_id']) || !is_numeric($_GET['info_id']) ) {
	  $title = INFORMATION_PAGE404_TITLE;
	  $page_description = INFORMATION_PAGE404_DESCRIPTION;
	  $breadcrumb->add($title);
	  require (DIR_WS_LANGUAGES . $language . '/' . FILENAME_INFORMATION);
	} else {
	  $info_id = intval($_GET['info_id']);
	  $information_query = tep_db_query("SELECT information_title, information_description FROM " . TABLE_INFORMATION . " WHERE visible='1' AND information_id='" . $info_id . "' and language_id='" . (int)$languages_id ."'");
	  $information = tep_db_fetch_array($information_query);
	  $title = stripslashes($information['information_title']);
	  $page_description = stripslashes($information['information_description']);
	
	  // Added as noticed by infopages module
	  if (!preg_match("/([\<])([^\>]{1,})*([\>])/i", $page_description)) {
	  	$page_description = str_replace("\r\n", "<br>\r\n", $page_description); 
	  }
	  $breadcrumb->add($title, tep_href_link(FILENAME_INFORMATION, 'info_id=' . $_GET['info_id'], 'NONSSL'));
	}
	
	define('NAVBAR_TITLE', $title);

  $content = CONTENT_INFORMATION;

  include (bts_select('main')); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php'); 
 
?>