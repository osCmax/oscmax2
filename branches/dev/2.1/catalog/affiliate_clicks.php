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

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_CLICKS);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_AFFILIATE_CLICKS, '', 'SSL'));

  $affiliate_clickthroughs_raw = "
    select a.*, pd.products_name from " . TABLE_AFFILIATE_CLICKTHROUGHS . " a 
    left join " . TABLE_PRODUCTS . " p on (p.products_id = a.affiliate_products_id) 
    left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on (pd.products_id = p.products_id and pd.language_id = '" . $languages_id . "') 
    where a.affiliate_id = '" . $affiliate_id . "'  ORDER BY a.affiliate_clientdate desc
    ";
  $affiliate_clickthroughs_split = new splitPageResults($affiliate_clickthroughs_raw, MAX_DISPLAY_SEARCH_RESULTS);

  $affiliate_clickthroughs_numrows_raw = "select count(*) as count from " . TABLE_AFFILIATE_CLICKTHROUGHS . " where affiliate_id = '" . $affiliate_id . "'";
  $affiliate_clickthroughs_query = tep_db_query($affiliate_clickthroughs_numrows_raw);
  $affiliate_clickthroughs_numrows = tep_db_fetch_array($affiliate_clickthroughs_query);
  $affiliate_clickthroughs_numrows =$affiliate_clickthroughs_numrows['count'];

  $content = affiliate_clicks;
   
  include (bts_select('main')); // BTSv1.5


  require(DIR_WS_INCLUDES . 'application_bottom.php'); 
?>