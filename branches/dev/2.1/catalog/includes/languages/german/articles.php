<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('TEXT_MAIN', '');
define('TABLE_HEADING_NEW_ARTICLES', 'Neue Artikel in %s');

if ( ($topic_depth == 'articles') || (isset($_GET['authors_id'])) ) {
  define('HEADING_TITLE', $topics['topics_name']);
  define('TABLE_HEADING_ARTICLES', 'Artikel');
  define('TABLE_HEADING_AUTHOR', 'Autor');
  define('TEXT_NO_ARTICLES', 'Derzeit existieren keine Artikel unter diesem Thema.');
  define('TEXT_NO_ARTICLES2', 'Derzeit existieren keine Artikel dieses Autors.');
  define('TEXT_NUMBER_OF_ARTICLES', 'Anzahl der Artikel: ');
  define('TEXT_SHOW', 'Anzeigen:');
  define('TEXT_NOW', '\' jetzt');
  define('TEXT_ALL_TOPICS', 'Alle Themen');
  define('TEXT_ALL_AUTHORS', 'Alle Autoren');
  define('TEXT_ARTICLES_BY', 'Artikel von ');
  define('TEXT_ARTICLES', 'Die nachstehende Liste zeigt die Artikel an, beginnend mit den aktuellsten.');  
  define('TEXT_DATE_ADDED', 'Ver&ouml;ffentlicht:');
  define('TEXT_AUTHOR', 'Autor:');
  define('TEXT_TOPIC', 'Thema:');
  define('TEXT_BY', 'von');
  define('TEXT_READ_MORE', 'Weiter lesen...');
  define('TEXT_MORE_INFORMATION', 'Weitere Informationen finden Sie auf der <a href="http://%s" target="_blank">Homepage</a> dieses Autors.');
} elseif ($topic_depth == 'top') {
  define('HEADING_TITLE', 'Alle Artikel');
  define('TEXT_ALL_ARTICLES', 'Die nachstehende Liste zeigt alle Artikel, beginnend mit den aktuellsten.');
  define('TEXT_ARTICLES', 'Die nachstehende Liste zeigt alle Artikel, beginnend mit den aktuellsten.');  
  define('TEXT_CURRENT_ARTICLES', 'Aktuelle Artikel');
  define('TEXT_UPCOMING_ARTICLES', 'Noch unveröffentlichte Artikel');
  define('TEXT_NO_ARTICLES', 'Derzeit sind keine Artikel gelistet.');
  define('TEXT_DATE_ADDED', 'Ver&ouml;ffentlicht:');
  define('TEXT_DATE_EXPECTED', 'Voraussichtlich:');
  define('TEXT_AUTHOR', 'Autor:');
  define('TEXT_TOPIC', 'Thema:');
  define('TEXT_BY', 'von');
  define('TEXT_READ_MORE', 'Weiter lesen...');
} elseif ($topic_depth == 'nested') {
  define('HEADING_TITLE', 'Artikel');
}

define('NAVBAR_TITLE_1','Artikel');

?>
