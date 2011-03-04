<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('TEXT_MAIN', '');
define('TABLE_HEADING_NEW_ARTICLES','Nouveaux articles dans %s');

if ( ($topic_depth == 'articles') || (isset($_GET['authors_id'])) ) {
  define('HEADING_TITLE', $topics['topics_name']);
  define('TABLE_HEADING_ARTICLES', 'Articles');
  define('TEXT_NO_ARTICLES', 'There are currently no articles in this topic.');
  define('TEXT_NO_ARTICLES2','Il ya actuellement aucun article disponible auprès de cet auteur.');
  define('TEXT_NUMBER_OF_ARTICLES','Nombre d\'articles:');
  define('TEXT_SHOW','Affichage:');
  define('TEXT_NOW','\' maintenant');
  define('TEXT_ALL_TOPICS','Tous les sujets');
  define('TEXT_ALL_AUTHORS','Tous les auteurs');
  define('TEXT_ARTICLES_BY','Les articles de');
  define('TEXT_ARTICLES','Voici une liste d\'articles avec les plus récents en premier.');  
  define('TEXT_DATE_ADDED','Publié le:');
  define('TEXT_AUTHOR','Auteur:');
  define('TEXT_TOPIC','Sujet:');
  define('TEXT_READ_MORE','Lire la suite ...');
  define('TEXT_MORE_INFORMATION', 'For more information, please visit this authors <a href="http://%s" target="_blank">web page</a>.');
} elseif ($topic_depth == 'top') {
  define('HEADING_TITLE', 'All Articles');
  define('TEXT_ALL_ARTICLES','Voici une liste de tous les articles avec les plus récents en premier.');
  define('TEXT_CURRENT_ARTICLES','Articles récents');
  define('TEXT_UPCOMING_ARTICLES','Articles à venir');
  define('TEXT_NO_ARTICLES', 'There are currently no articles listed.');
  define('TEXT_DATE_ADDED', 'Published:');
  define('TEXT_DATE_EXPECTED','Attendus:');
  define('TEXT_AUTHOR', 'Author:');
  define('TEXT_TOPIC', 'Topic:');
  define('TEXT_READ_MORE', 'Read More...');
} elseif ($topic_depth == 'nested') {
  define('HEADING_TITLE', 'Articles');
}

define('NAVBAR_TITLE_1','Articles');

?>
