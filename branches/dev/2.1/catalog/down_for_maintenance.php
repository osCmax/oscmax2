<?php
/*
$Id: down_for_maintenance.php 3 2006-05-27 04:59:07Z user $

  Created by: Linda McGrath osCOMMERCE@WebMakers.com
  
  Update by: fram 05-05-2003
  Updated by: Donald Harriman - 08-08-2003 - MS2

  down_for_maintenance.php v1.1

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . DOWN_FOR_MAINTENANCE_FILENAME);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(DOWN_FOR_MAINTENANCE_FILENAME));

  $content = CONTENT_DOWN_FOR_MAINT;

  include (bts_select('main'); // BTSv1.5



 require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>