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

  if (!tep_session_is_registered('customer_id') && (ALLOW_GUEST_TO_TELL_A_FRIEND == 'false')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  $valid_product = false;
  if (isset($_GET['products_id'])) {
    $product_info_query = tep_db_query("select pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = '" . (int)$_GET['products_id'] . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'");
    if (tep_db_num_rows($product_info_query)) {
      $valid_product = true;

      $product_info = tep_db_fetch_array($product_info_query);
    } else {
      tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id']));
    }
  }

// BOF: MOD - Article Manager
//if ($valid_product == false) {
//  tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id']));
  $valid_article = false;
  
  $_artid = isset($_GET['articles_id']) ? $_GET['articles_id'] : (isset($_POST['articles_id']) ? $_POST['articles_id'] : null);
  $_GET['articles_id'] = $_artid;
  
  if (isset($_artid )) {
    $article_info_query = tep_db_query("select pd.articles_name from " . TABLE_ARTICLES . " p, " . TABLE_ARTICLES_DESCRIPTION . " pd where p.articles_status = '1' and p.articles_id = '" . (int)$_GET['articles_id'] . "' and p.articles_id = pd.articles_id and pd.language_id = '" . (int)$languages_id . "'");
    if (tep_db_num_rows($article_info_query)) {
      $valid_article = true;

      $article_info = tep_db_fetch_array($article_info_query);
    } else {
      tep_redirect(tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id=' . $_GET['articles_id']));
    }
// EOF: MOD - Article Manager
  }

  require(bts_select('language', FILENAME_TELL_A_FRIEND));

  if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
    $error = false;

    $to_email_address = tep_db_prepare_input($_POST['to_email_address']);
    $to_name = tep_db_prepare_input($_POST['to_name']);
    $from_email_address = tep_db_prepare_input($_POST['from_email_address']);
    $from_name = tep_db_prepare_input($_POST['from_name']);
    $message = tep_db_prepare_input($_POST['message']);

    if (empty($from_name)) {
      $error = true;

      $messageStack->add('friend', ERROR_FROM_NAME);
    }

    if (!tep_validate_email($from_email_address)) {
      $error = true;

      $messageStack->add('friend', ERROR_FROM_ADDRESS);
    }

    if (empty($to_name)) {
      $error = true;

      $messageStack->add('friend', ERROR_TO_NAME);
    }

    if (!tep_validate_email($to_email_address)) {
      $error = true;

      $messageStack->add('friend', ERROR_TO_ADDRESS);
    }

    if ($error == false) {
// BOF: MOD - Article Manager
// Modify e-mail depending on whether product or article
// if product
    if ($valid_product) {
// EOF: MOD - Article Manager
      $email_subject = sprintf(TEXT_EMAIL_SUBJECT, $from_name, STORE_NAME);
      $email_body = sprintf(TEXT_EMAIL_INTRO, $to_name, $from_name, $product_info['products_name'], STORE_NAME) . "\n\n";

      if (tep_not_null($message)) {
        $email_body .= $message . "\n\n";
      }

      $email_body .= sprintf(TEXT_EMAIL_LINK, tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id'], 'NONSSL', false)) . "\n\n" .
                     sprintf(TEXT_EMAIL_SIGNATURE, STORE_NAME . "\n" . HTTP_SERVER . DIR_WS_CATALOG . "\n");

      tep_mail($to_name, $to_email_address, $email_subject, $email_body, $from_name, $from_email_address);

      $messageStack->add_session('header', sprintf(TEXT_EMAIL_SUCCESSFUL_SENT, $product_info['products_name'], tep_output_string_protected($to_name)), 'success');

      tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $_GET['products_id']));
// BOF: MOD - Article Manager
      // if article
    } else if ($valid_article) {
      $email_subject = sprintf(TEXT_EMAIL_SUBJECT, $from_name, STORE_NAME);
      $email_body = sprintf(TEXT_EMAIL_INTRO, $to_name, $from_name, $article_info['articles_name'], STORE_NAME) . "\n\n";

      if (tep_not_null($message)) {
        $email_body .= $message . "\n\n";
      }

      $email_body .= sprintf(TEXT_EMAIL_LINK_ARTICLE, tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id=' . $_GET['articles_id'])) . "\n\n" .
                     sprintf(TEXT_EMAIL_SIGNATURE, STORE_NAME . "\n" . HTTP_SERVER . DIR_WS_CATALOG . "\n");

      tep_mail($to_name, $to_email_address, $email_subject, $email_body, $from_name, $from_email_address);

      $messageStack->add_session('header', sprintf(TEXT_EMAIL_SUCCESSFUL_SENT, $article_info['articles_name'], tep_output_string_protected($to_name)), 'success');

      tep_redirect(tep_href_link(FILENAME_ARTICLE_INFO, 'articles_id=' . $_GET['articles_id']));
      }
// EOF: MOD - Article Manager
    }
  } elseif (tep_session_is_registered('customer_id')) {
    $account_query = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
    $account = tep_db_fetch_array($account_query);

    $from_name = $account['customers_firstname'] . ' ' . $account['customers_lastname'];
    $from_email_address = $account['customers_email_address'];
  }

// LINE ADDED: MOD - Article Manager
  if ($valid_product) {
    $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_TELL_A_FRIEND, 'products_id=' . $_GET['products_id']));
// BOF: MOD - Article Manager
  } else if ($valid_article) {
    $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_TELL_A_FRIEND, 'articles_id=' . $_GET['articles_id']));
      }
// EOF: MOD - Article Manager

  $content = CONTENT_TELL_A_FRIEND;

  include (bts_select('main')); // BTSv1.5


  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
