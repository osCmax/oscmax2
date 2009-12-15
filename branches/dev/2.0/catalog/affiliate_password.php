<?php
/*
  $Id: affiliate_password.php,v 2.00 2003/10/12

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

// needs to be included earlier to set the success message in the messageStack
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_AFFILIATE_PASSWORD);

  if (isset($HTTP_POST_VARS['action']) && ($HTTP_POST_VARS['action'] == 'process')) {
    $password_current = tep_db_prepare_input($HTTP_POST_VARS['password_current']);
    $password_new = tep_db_prepare_input($HTTP_POST_VARS['password_new']);
    $password_confirmation = tep_db_prepare_input($HTTP_POST_VARS['password_confirmation']);

    $error = false;

    if (strlen($password_current) < ENTRY_PASSWORD_MIN_LENGTH) {
      $error = true;

      $messageStack->add('a_password', ENTRY_PASSWORD_CURRENT_ERROR);
    } elseif (strlen($password_new) < ENTRY_PASSWORD_MIN_LENGTH) {
      $error = true;

      $messageStack->add('a_password', ENTRY_PASSWORD_NEW_ERROR);
    } elseif ($password_new != $password_confirmation) {
      $error = true;

      $messageStack->add('a_password', ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING);
    }

    if ($error == false) {
      $check_affiliate_query = tep_db_query("select affiliate_password from " . TABLE_AFFILIATE . " where affiliate_id = '" . (int)$affiliate_id . "'");
      $check_affiliate = tep_db_fetch_array($check_affiliate_query);

      if (tep_validate_password($password_current, $check_affiliate['affiliate_password'])) {
        tep_db_query("update " . TABLE_AFFILIATE . " set affiliate_password = '" . tep_encrypt_password($password_new) . "' where affiliate_id = '" . (int)$affiliate_id . "'");

        $messageStack->add_session('account', SUCCESS_PASSWORD_UPDATED, 'success');

        tep_redirect(tep_href_link(FILENAME_AFFILIATE_SUMMARY, '', 'SSL'));
      } else {
        $error = true;

        $messageStack->add('a_password', ERROR_CURRENT_PASSWORD_NOT_MATCHING);
      }
    }
  }

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_AFFILIATE, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_AFFILIATE_PASSWORD, '', 'SSL'));
  $content = affiliate_password; 
  include (bts_select('main', $content_template)); // BTSv1.5
   require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>