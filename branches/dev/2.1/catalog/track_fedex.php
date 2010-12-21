<?php
/*
$Id: track_fedex.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com


*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');
	require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_TRACK_FEDEX);

	// debugging? 
// LINE CHANGED: Bugfix 0000070
	$debug [] = 0; // 1 for yes, 0 for no
	
	// get tracking number from form
	$tracking_number = $_GET['track'];
	
	if ($tracking_number) {
		$title = 'Package Tracking Results';
		}
	else {
		$title = HEADING_TITLE;
		}
 $content = CONTENT_FEDEX_TRACK;
  include (bts_select('main'); // BTSv1.5

 require(DIR_WS_INCLUDES . 'application_bottom.php');
 ?>