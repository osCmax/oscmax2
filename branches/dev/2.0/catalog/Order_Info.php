<?php
/*
$Id: Order_Info.php 3 2006-05-27 04:59:07Z user $
        by Cheng

        OSCommerce v2.2 CVS (09/17/02)

   Modified versions of create_account.php and related
  files.  Allowing 'purchase without account'.

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

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);

// BOF: MOD - Country-State Selector
  if ($HTTP_POST_VARS['action'] == 'refresh') {$state = '';}
  if (!isset($country)){$country = DEFAULT_COUNTRY;}
// EOF: MOD - Country-State Selector

  $breadcrumb->add(NAV_ORDER_INFO, tep_href_link('Order_Info.php', '', 'SSL'));

$content = Order_Info;

  include (bts_select('main', $content_template)); // BTSv1.5


 require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>