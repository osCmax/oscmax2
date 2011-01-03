<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ARTICLES_NEW);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ARTICLES_NEW));

 $content = CONTENT_ARTICLES_NEW;

 include (bts_select('main')); // BTSv1.5


 require(DIR_WS_INCLUDES . 'application_bottom.php'); 
 
 ?>