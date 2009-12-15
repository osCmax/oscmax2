<?php
/*
  $Id: affiliate_banners_build_cat.php,v 2.00 2003/10/12

  OSC-Affiliate

  Contribution based on:

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 - 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if (!tep_session_is_registered('affiliate_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_AFFILIATE, '', 'SSL'));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_BANNERS_BUILD_CAT);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_AFFILIATE_BANNERS_BUILD_CAT));

  $affiliate_banners_values = tep_db_query("select * from " . TABLE_AFFILIATE_BANNERS . " order by affiliate_banners_title");
  $content = affiliate_banners_build_cat; 
  include (bts_select('main', $content_template)); // BTSv1.5
  require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
