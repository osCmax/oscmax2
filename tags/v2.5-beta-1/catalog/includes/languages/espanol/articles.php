<?php
/*
$Id: articles.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

define('TEXT_MAIN', '');
define('TABLE_HEADING_NEW_ARTICLES', 'Nuevas noticias en %s');

if ( ($topic_depth == 'articles') || (isset($_GET['authors_id'])) ) {
  define('HEADING_TITLE', $topics['topics_name']);
  define('TABLE_HEADING_ARTICLES', 'Noticias');
  define('TABLE_HEADING_AUTHOR', 'Autor');
  define('TEXT_NO_ARTICLES', 'Actualmente no hay noticias en esta secci&oacute;n.');
  define('TEXT_NO_ARTICLES2', 'Actualmente no ha noticias disponible de este autor.');
  define('TEXT_NUMBER_OF_ARTICLES', 'N&uacute;mero de noticias: ');
  define('TEXT_SHOW', 'Mostrar:');
  define('TEXT_NOW', '\' ahora');
  define('TEXT_ALL_TOPICS', 'Todas las secciones');
  define('TEXT_ALL_AUTHORS', 'Todos los autores');
  define('TEXT_ARTICLES_BY', 'Noticias por ');
  define('TEXT_ARTICLES', 'Debajo hay una lista de todas las noticias con las m&aacute;s recientes listadas al principio.');
  define('TEXT_DATE_ADDED', 'Publicado:');
  define('TEXT_AUTHOR', 'Autor:');
  define('TEXT_TOPIC', 'Secci&oacute;n:');
  define('TEXT_BY', 'por');
  define('TEXT_READ_MORE', 'Leer m&aacute;s...');
  define('TEXT_MORE_INFORMATION', 'Para obtener m&aacute;s informaci&oacute;n, visita estos autores <a href="http://%s" target="_blank">aqu&iacute;</a>.');
} elseif ($topic_depth == 'arriba') {
  define('HEADING_TITLE', 'Todas las noticias');
  define('TEXT_ALL_ARTICLES', 'Debajo hay una lista de todas las noticias con las m&aacute;s recientes listadas al principio.');
  define('TEXT_ARTICLES', 'Debajo hay una lista de todas las noticias con las m&aacute;s recientes listadas al principio.');  
  define('TEXT_CURRENT_ARTICLES', 'Noticias disponibles');
  define('TEXT_UPCOMING_ARTICLES', 'Pr&oacute;ximas noticias');
  define('TEXT_NO_ARTICLES', 'TNo hay noticias disponibles.');
  define('TEXT_DATE_ADDED', 'Publicado:');
  define('TEXT_DATE_EXPECTED', 'Esperado:');
  define('TEXT_AUTHOR', 'Autor:');
  define('TEXT_TOPIC', 'Secci&oacute;n:');
  define('TEXT_BY', 'por');
  define('TEXT_READ_MORE', 'Leer m&aacute;s...');
} elseif ($topic_depth == 'nested') {
  define('HEADING_TITLE', 'Noticias');
}

?>
