<?php
/*
$Id: index_articles.php 3 2010-05-03 PGM

  osCMax Power E-Commerce
  http://www.oscmax.com

  Copyright 2010 osCMax

  Released under the GNU General Public License
*/


  $articles_query = tep_db_query("select a.articles_id, a.articles_date_added, ad.articles_name, ad.articles_description from " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_DESCRIPTION . " ad where (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now())) and a.articles_status = '1' and a.articles_index_status = '1' and ad.language_id = '" . (int)$languages_id . "' and a.articles_id = ad.articles_id order by a.articles_date_added desc, ad.articles_name");

  if (tep_db_num_rows($articles_query) > 0) {
?>
<!-- index_articles //-->
<?php

	$info_box_contents = array();
	$info_box_contents[] = array('align' => 'left', 'text' => '<a href="' . tep_href_link(FILENAME_ARTICLES) . '" class="headerNavigation">' . TABLE_HEADING_DEFAULT_ARTICLES . '</a>');
	new infoBoxHeading($info_box_contents, true, true, tep_href_link(FILENAME_ARTICLES));

	while ($index_articles = tep_db_fetch_array($articles_query)) {
?>
		<table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td>
            	<table border="0" width="100%" cellspacing="0" cellpadding="2" class="infoBoxContents">
              		<tr>
                    	<td class="articleTextBox"><b><?php echo $index_articles['articles_name']; ?></b></td>
                    </tr>
                    <tr>
                    	<td class="articleTextBox"><?php echo $index_articles['articles_description']; ?></td>
                    </tr>    
            	</table>
            </td>
          </tr>
          <tr>
          	<td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
        </table>
<!-- index_articles_eof //-->
	<?php } // end while ?>

<?php } ?> 