<?php
/*
  $Id: catalog_products_with_images.php V 3.0
  by Tom St.Croix <managememt@betterthannature.com> V 3.0

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License

  notes: added to the catalog/includes/languages/english.php 
  define('IMAGE_BUTTON_UPSORT', 'Sort Asending');
  define('IMAGE_BUTTON_DOWNSORT', 'Sort Desending');
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CATALOG_PRODUCTS_WITH_IMAGES);

  // Use $location if you have a pre breadcrumb release of OSC then comment out $breadcrumb line
  //$location = ' &raquo; <a href="' . tep_href_link(FILENAME_CATALOG_PRODUCTS_WITH_IMAGES, '', 'NONSSL') . '" class="headerNavigation">' . NAVBAR_TITLE . '</a>';

  // Use $breadcrumb if you have a breadcrumb release of OSC then comment out $location line
  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CATALOG_PRODUCTS_WITH_IMAGES, '', 'NONSSL'));

  $content = CONTENT_PRINTABLE_CATALOG;

  include (bts_select('main')); // BTSv1.5


   require(DIR_WS_INCLUDES . 'application_bottom.php');
   
?>