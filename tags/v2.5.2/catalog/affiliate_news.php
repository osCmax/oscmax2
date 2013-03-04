<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if (!tep_session_is_registered('affiliate_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_AFFILIATE, '', 'SSL'));
  }

  require(bts_select('language', FILENAME_AFFILIATE_NEWS));

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_AFFILIATE_NEWS));
  $content = affiliate_news; 
  include (bts_select('main')); // BTSv1.5

   require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
