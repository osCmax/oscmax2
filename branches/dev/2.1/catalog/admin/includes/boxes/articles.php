<?php
/*
$Id: articles.php 3 2009-11-14 19:38:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2009 osCMax, 2006 osCMax ,2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

?>
<!-- articles //-->
<?php
  $contents = '';
  $contents = ( 				  tep_admin_jqmenu(FILENAME_AUTHORS, BOX_ARTICLES_AUTHORS, 'TOP') .
								  tep_admin_jqmenu(FILENAME_ARTICLES, BOX_TOPICS_ARTICLES, 'TOP') .
								  tep_admin_jqmenu(FILENAME_ARTICLE_REVIEWS, BOX_ARTICLES_REVIEWS, 'TOP') .
								  tep_admin_jqmenu(FILENAME_ARTICLES_XSELL, BOX_ARTICLES_XSELL, 'TOP'));
  print_r($contents);
?>
<!-- articles_eof //-->