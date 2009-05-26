<?php
/*
$Id: articles.php 3 2006-05-27 04:59:07Z user $

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

// the following tPath references come from application_top.php
  $topic_depth = 'top';

  if (isset($tPath) && tep_not_null($tPath)) {
    $topics_articles_query = tep_db_query("select count(*) as total from " . TABLE_ARTICLES_TO_TOPICS . " where topics_id = '" . (int)$current_topic_id . "'");
    $topics_articles = tep_db_fetch_array($topics_articles_query);
    if ($topics_articles['total'] > 0) {
      $topic_depth = 'articles'; // display articles
    } else {
      $topic_parent_query = tep_db_query("select count(*) as total from " . TABLE_TOPICS . " where parent_id = '" . (int)$current_topic_id . "'");
      $topic_parent = tep_db_fetch_array($topic_parent_query);
      if ($topic_parent['total'] > 0) {
        $topic_depth = 'nested'; // navigate through the topics
      } else {
        $topic_depth = 'articles'; // topic has no articles, but display the 'no articles' message
      }
    }
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ARTICLES);

  if ($topic_depth == 'top' && !isset($HTTP_GET_VARS['authors_id'])) {
    $breadcrumb->add(NAVBAR_TITLE_DEFAULT, tep_href_link(FILENAME_ARTICLES));
  }


 $content = CONTENT_ARTICLES_MAIN;

  include (bts_select('main', $content_template)); // BTSv1.5

 
 require(DIR_WS_INCLUDES . 'application_bottom.php'); 
 
 ?>