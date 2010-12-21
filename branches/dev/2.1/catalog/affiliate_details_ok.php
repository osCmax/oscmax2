<?php
/*
$Id: affiliate_details_ok.php 14 2006-07-28 17:42:07Z user $

  OSC-Affiliate

  Contribution based on:

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/


  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_DETAILS_OK);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_AFFILIATE_DETAILS_OK));

  $content = affiliate_details_ok; 

  include (bts_select('main')); // BTSv1.5


  require(DIR_WS_INCLUDES . 'application_bottom.php'); 
?>
