<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr> 
    <!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr> 
          <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr> 
                <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
              </tr>
            </table></td>
        </tr>
        <tr> 
          <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
        </tr>
        <?php
  $articles_new_array = array();
	$listing_sql = "select a.articles_id, a.articles_date_added, ad.articles_name, ad.articles_head_desc_tag, au.authors_id, au.authors_name, td.topics_id, td.topics_name from ((" . TABLE_ARTICLES . " a), " . TABLE_ARTICLES_TO_TOPICS . " a2t) left join " . TABLE_TOPICS_DESCRIPTION . " td on a2t.topics_id = td.topics_id left join " . TABLE_AUTHORS . " au on a.authors_id = au.authors_id, " . TABLE_ARTICLES_DESCRIPTION . " ad where (a.articles_date_available IS NULL or to_days(a.articles_date_available) <= to_days(now())) and a.articles_id = a2t.articles_id and a.articles_status = '1' and a.articles_id = ad.articles_id and ad.language_id = '" . (int)$languages_id . "' and td.language_id = '" . (int)$languages_id . "' and a.articles_date_added > SUBDATE(now( ), INTERVAL '" . NEW_ARTICLES_DAYS_DISPLAY . "' DAY) order by a.articles_date_added desc, ad.articles_name";
	$listing_no_article = sprintf(TEXT_NO_NEW_ARTICLES, NEW_ARTICLES_DAYS_DISPLAY);
      
  //$articles_new_split = new splitPageResults($listing_sql, MAX_NEW_ARTICLES_PER_PAGE);

?>

<?php include(DIR_WS_MODULES . FILENAME_ARTICLE_LISTING); ?></td>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      </table></td>
    <!-- body_text_eof //-->
  </tr>
</table>
