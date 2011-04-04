<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

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