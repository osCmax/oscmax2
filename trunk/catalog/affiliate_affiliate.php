<?php
/*
$Id: affiliate_affiliate.php 3 2006-05-27 04:59:07Z user $

  OSC-Affiliate

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
  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'process')) {
    $affiliate_username = tep_db_prepare_input($HTTP_POST_VARS['affiliate_username']);
    $affiliate_password = tep_db_prepare_input($HTTP_POST_VARS['affiliate_password']);

// Check if username exists
    $check_affiliate_query = tep_db_query("select affiliate_id, affiliate_firstname, affiliate_password, affiliate_email_address from " . TABLE_AFFILIATE . " where affiliate_email_address = '" . tep_db_input($affiliate_username) . "'");

    if (!tep_db_num_rows($check_affiliate_query)) {
      $HTTP_GET_VARS['login'] = 'fail';
    } else {
      $check_affiliate = tep_db_fetch_array($check_affiliate_query);

// Check that password is good
      if (!tep_validate_password($affiliate_password, $check_affiliate['affiliate_password'])) {
        $HTTP_GET_VARS['login'] = 'fail';
      } else {
        $affiliate_id = $check_affiliate['affiliate_id'];
        tep_session_register('affiliate_id');
        $date_now = date('Ymd');
        tep_db_query("update " . TABLE_AFFILIATE . " set affiliate_date_of_last_logon = now(), affiliate_number_of_logons = affiliate_number_of_logons + 1 where affiliate_id = '" . $affiliate_id . "'");
        tep_redirect(tep_href_link(FILENAME_AFFILIATE_SUMMARY,'','SSL'));
      }
    }
  }
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE);
  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_AFFILIATE, '', 'SSL'));

  $content = CONTENT_AFFILIATE;
  include (bts_select('main', $content_template)); // BTSv1.5
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>