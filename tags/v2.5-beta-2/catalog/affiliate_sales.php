<?php
/*
$Id: affiliate_sales.php 14 2006-07-28 17:42:07Z user $

  OSC-Affiliate

  Contribution based on:

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

  if (!tep_session_is_registered('affiliate_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_AFFILIATE, '', 'SSL'));
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_SALES);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_AFFILIATE_SALES, '', 'SSL'));

  $affiliate_sales_raw = "
    select  a.*, o.orders_status as orders_status_id, os.orders_status_name as orders_status from " . TABLE_AFFILIATE_SALES . " a 
    left join " . TABLE_ORDERS . " o on (a.affiliate_orders_id = o.orders_id) 
    left join " . TABLE_ORDERS_STATUS . " os on (o.orders_status = os.orders_status_id and language_id = '" . $languages_id . "') 
    where a.affiliate_id = '" . $affiliate_id . "'	 
    order by affiliate_date DESC
    ";

  $affiliate_sales_split = new splitPageResults($affiliate_sales_raw, MAX_DISPLAY_SEARCH_RESULTS);

  $content = affiliate_sales; 

  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php'); 
?>