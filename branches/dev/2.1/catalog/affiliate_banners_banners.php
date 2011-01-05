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

  if (!tep_session_is_registered('affiliate_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_AFFILIATE, '', 'SSL'));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_BANNERS_BANNERS);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_AFFILIATE_BANNERS_BANNERS));

  $affiliate_banners_values = tep_db_query("select * from " . TABLE_AFFILIATE_BANNERS . " order by affiliate_banners_title");
  $content = affiliate_banners_banners; 
  include (bts_select('main')); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>