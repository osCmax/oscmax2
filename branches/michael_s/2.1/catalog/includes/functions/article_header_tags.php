<?php
/*
$Id: article_header_tags.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// Modification of Header Tags Contribution
// WebMakers.com Added: Header Tags Generator v2.0 

////
// Get articles_head_title_tag
// TABLES: articles_description
function tep_get_header_tag_articles_title($article_id) {
  global $languages_id, $HTTP_GET_VARS; 

  $article_header_tags = tep_db_query("select articles_head_title_tag from " . TABLE_ARTICLES_DESCRIPTION . " where language_id = '" . (int)$languages_id . "' and articles_id = '" . (int)$HTTP_GET_VARS['articles_id'] . "'");
  $article_header_tags_values = tep_db_fetch_array($article_header_tags);

  return clean_html_comments($article_header_tags_values['articles_head_title_tag']);
  }


////
// Get articles_head_keywords_tag
// TABLES: articles_description
function tep_get_header_tag_articles_keywords($article_id) {
  global $languages_id, $HTTP_GET_VARS; 

  $article_header_tags = tep_db_query("select articles_head_keywords_tag from " . TABLE_ARTICLES_DESCRIPTION . " where language_id = '" . (int)$languages_id . "' and articles_id = '" . (int)$HTTP_GET_VARS['articles_id'] . "'");
  $article_header_tags_values = tep_db_fetch_array($article_header_tags);

  return $article_header_tags_values['articles_head_keywords_tag'];
  }


////
// Get articles_head_desc_tag
// TABLES: articles_description
function tep_get_header_tag_articles_desc($article_id) {
  global $languages_id, $HTTP_GET_VARS; 

  $article_header_tags = tep_db_query("select articles_head_desc_tag from " . TABLE_ARTICLES_DESCRIPTION . " where language_id = '" . (int)$languages_id . "' and articles_id = '" . (int)$HTTP_GET_VARS['articles_id'] . "'");
  $article_header_tags_values = tep_db_fetch_array($article_header_tags);

  return $article_header_tags_values['articles_head_desc_tag'];
  }

?>