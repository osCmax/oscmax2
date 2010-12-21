<?php
/*
$Id: article_reviews_write.php 3 2006-05-27 04:59:07Z user $

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

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  $article_info_query = tep_db_query("select a.articles_id, ad.articles_name from " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_DESCRIPTION . " ad where a.articles_id = '" . (int)$_GET['articles_id'] . "' and a.articles_status = '1' and a.articles_id = ad.articles_id and ad.language_id = '" . (int)$languages_id . "'");
  if (!tep_db_num_rows($article_info_query)) {
    tep_redirect(tep_href_link(FILENAME_ARTICLE_REVIEWS, tep_get_all_get_params(array('action'))));
  } else {
    $article_info = tep_db_fetch_array($article_info_query);
  }

  $customer_query = tep_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
  $customer = tep_db_fetch_array($customer_query);

  if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
    $rating = tep_db_prepare_input($_POST['rating']);
    $review = tep_db_prepare_input($_POST['review']);

    $error = false;
    if (strlen($review) < REVIEW_TEXT_MIN_LENGTH) {
      $error = true;

      $messageStack->add('review', JS_REVIEW_TEXT);
    }

    if (($rating < 1) || ($rating > 5)) {
      $error = true;

      $messageStack->add('review', JS_REVIEW_RATING);
    }

    if ($error == false) {
      tep_db_query("insert into " . TABLE_ARTICLE_REVIEWS . " (articles_id, customers_id, customers_name, reviews_rating, date_added) values ('" . (int)$_GET['articles_id'] . "', '" . (int)$customer_id . "', '" . tep_db_input($customer['customers_firstname']) . ' ' . tep_db_input($customer['customers_lastname']) . "', '" . tep_db_input($rating) . "', now())");
      $insert_id = tep_db_insert_id();

      tep_db_query("insert into " . TABLE_ARTICLE_REVIEWS_DESCRIPTION . " (reviews_id, languages_id, reviews_text) values ('" . (int)$insert_id . "', '" . (int)$languages_id . "', '" . tep_db_input($review) . "')");

      tep_redirect(tep_href_link(FILENAME_ARTICLE_REVIEWS, tep_get_all_get_params(array('action'))));
    }
  }

  $articles_name = $article_info['articles_name'];

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ARTICLE_REVIEWS_WRITE);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ARTICLE_REVIEWS, tep_get_all_get_params()));

 $content = CONTENT_ARTICLES_REVIEWS_WRITE;
 $javascript = $content . '.js';

  include (bts_select('main')); // BTSv1.5


require(DIR_WS_INCLUDES . 'application_bottom.php'); 

?>
