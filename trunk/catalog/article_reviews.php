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

  $article_info_query = tep_db_query("select a.articles_id, ad.articles_name from " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_DESCRIPTION . " ad where a.articles_id = '" . (int)$_GET['articles_id'] . "' and a.articles_status = '1' and a.articles_id = ad.articles_id and ad.language_id = '" . (int)$languages_id . "'");
  if (!tep_db_num_rows($article_info_query)) {
    tep_redirect(tep_href_link(FILENAME_REVIEWS));
  } else {
    $article_info = tep_db_fetch_array($article_info_query);
  }

  $articles_name = $article_info['articles_name'];

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ARTICLE_REVIEWS);

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_ARTICLE_REVIEWS, tep_get_all_get_params()));
  
  $content = CONTENT_ARTICLES_REVIEWS;

  include (bts_select('main')); // BTSv1.5
 
  
   require(DIR_WS_INCLUDES . 'application_bottom.php');
   
?>