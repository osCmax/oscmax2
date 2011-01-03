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

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_SUMMARY);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_AFFILIATE_SUMMARY));

  $affiliate_banner_history_raw = "select sum(affiliate_banners_shown) as count from " . TABLE_AFFILIATE_BANNERS_HISTORY .  " where affiliate_banners_affiliate_id  = '" . $affiliate_id . "'";
  $affiliate_banner_history_query=tep_db_query($affiliate_banner_history_raw);
  $affiliate_banner_history = tep_db_fetch_array($affiliate_banner_history_query);
  $affiliate_impressions = $affiliate_banner_history['count'];
  if ($affiliate_impressions == 0) $affiliate_impressions="n/a"; 

  $affiliate_clickthroughs_raw = "select count(*) as count from " . TABLE_AFFILIATE_CLICKTHROUGHS . " where affiliate_id = '" . $affiliate_id . "'";
  $affiliate_clickthroughs_query = tep_db_query($affiliate_clickthroughs_raw);
  $affiliate_clickthroughs = tep_db_fetch_array($affiliate_clickthroughs_query);
  $affiliate_clickthroughs =$affiliate_clickthroughs['count'];

  $affiliate_sales_raw = "
			select count(*) as count, sum(affiliate_value) as total, sum(affiliate_payment) as payment from " . TABLE_AFFILIATE_SALES . " a 
			left join " . TABLE_ORDERS . " o on (a.affiliate_orders_id=o.orders_id) 
			where a.affiliate_id = '" . $affiliate_id . "' and o.orders_status >= " . AFFILIATE_PAYMENT_ORDER_MIN_STATUS . " 
			";
  $affiliate_sales_query = tep_db_query($affiliate_sales_raw);
  $affiliate_sales = tep_db_fetch_array($affiliate_sales_query);

  $affiliate_transactions=$affiliate_sales['count'];
  if ($affiliate_clickthroughs > 0) {
	$affiliate_conversions = tep_round(($affiliate_transactions / $affiliate_clickthroughs)*100, 2) . "%";
  } else {
    $affiliate_conversions = "n/a";
  }
  $affiliate_amount = $affiliate_sales['total'];
  if ($affiliate_transactions>0) {
	$affiliate_average = tep_round($affiliate_amount / $affiliate_transactions, 2);
  } else {
	$affiliate_average = "n/a";
  }
  $affiliate_commission = $affiliate_sales['payment'];

  $affiliate_values = tep_db_query("select * from " . TABLE_AFFILIATE . " where affiliate_id = '" . $affiliate_id . "'");
  $affiliate = tep_db_fetch_array($affiliate_values);
  $affiliate_percent = 0;
  $affiliate_percent = $affiliate['affiliate_commission_percent'];
  if ($affiliate_percent < AFFILIATE_PERCENT) $affiliate_percent = AFFILIATE_PERCENT;

  $content = CONTENT_AFFILIATE_SUMMARY; 
  $javascript = $content . '.js.php';

  include (bts_select('main')); // BTSv1.5


  require(DIR_WS_INCLUDES . 'application_bottom.php'); 
?>