<?php
/*
  $Id: wishlist_help.php,v 1  2005/02/19 Michael Sasek

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_WISHLIST_HELP);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_WISHLIST_HELP, '', 'NONSSL'));

  $content = CONTENT_WISHLIST_HELP;

  include (bts_select('main'); // BTSv1.5


 require(DIR_WS_INCLUDES . 'application_bottom.php'); 
 
 ?>