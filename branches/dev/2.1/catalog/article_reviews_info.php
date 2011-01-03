<?php
/*
$Id: article_reviews_info.php 3 2006-05-27 04:59:07Z user $

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

  if (isset($_GET['reviews_id']) && tep_not_null($_GET['reviews_id']) && isset($_GET['articles_id']) && tep_not_null($_GET['articles_id'])) {
    $review_check_query = tep_db_query("select count(*) as total from " . TABLE_ARTICLE_REVIEWS . " r, " . TABLE_ARTICLE_REVIEWS_DESCRIPTION . " rd where r.reviews_id = '" . (int)$_GET['reviews_id'] . "' and r.articles_id = '" . (int)$_GET['articles_id'] . "' and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$languages_id . "'");
    $review_check = tep_db_fetch_array($review_check_query);

    if ($review_check['total'] < 1) {
      tep_redirect(tep_href_link(FILENAME_ARTICLE_REVIEWS, tep_get_all_get_params(array('reviews_id'))));
    }
  } else {
    tep_redirect(tep_href_link(FILENAME_ARTICLE_REVIEWS, tep_get_all_get_params(array('reviews_id'))));
  }

  tep_db_query("update " . TABLE_ARTICLE_REVIEWS . " set reviews_read = reviews_read+1 where reviews_id = '" . (int)$_GET['reviews_id'] . "'");

  $review_query = tep_db_query("select rd.reviews_text, r.reviews_rating, r.reviews_id, r.customers_name, r.date_added, r.reviews_read, a.articles_id, ad.articles_name from " . TABLE_ARTICLE_REVIEWS . " r, " . TABLE_ARTICLE_REVIEWS_DESCRIPTION . " rd, " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_DESCRIPTION . " ad where r.reviews_id = '" . (int)$_GET['reviews_id'] . "' and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$languages_id . "' and r.articles_id = a.articles_id and a.articles_status = '1' and a.articles_id = ad.articles_id and ad.language_id = '". (int)$languages_id . "'");
  $review = tep_db_fetch_array($review_query);

  $articles_name = $review['articles_name'];

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ARTICLE_REVIEWS_INFO);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ARTICLE_REVIEWS, tep_get_all_get_params()));

  $content = CONTENT_ARTICLES_REVIEWS_INFO;

  include (bts_select('main')); // BTSv1.5


 require(DIR_WS_INCLUDES . 'application_bottom.php');
 
?>