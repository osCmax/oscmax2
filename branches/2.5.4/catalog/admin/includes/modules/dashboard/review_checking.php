<?php
/*
$Id: review_checking.php 1477 2011-06-20 22:35:57Z cottonbarn $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

      $reviews_query = tep_db_query("select count(*) as count from " . TABLE_REVIEWS . " where approved = '0'");
      $reviews_unapproved = tep_db_fetch_array($reviews_query);
        
      $article_reviews_query = tep_db_query("select count(*) as count from " . TABLE_ARTICLE_REVIEWS . " where approved = '0'");
      $article_reviews_unapproved = tep_db_fetch_array($article_reviews_query);
      
?>
<!-- Start check for New Product or Article Reviews -->
<table border="0" width="500" cellspacing="0" cellpadding="0" align="center">
  <tr>
    <td class="pageheading"><?php echo DASHBOARD_REVIEWS; ?></td>
  </tr>
  <tr valign="top">
    <td>
      <table border="0" width="100%" cellspacing="0" cellpadding="0">
        <tr>
          <td valign="top">
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="left"><?php echo DASHBOARD_REVIEWS; ?></td>
              </tr>
              <?php
              if ($reviews_unapproved['count'] > 0) { ?>
              <tr>
                <td class="messageStackError"><a href="<?php echo tep_href_link(FILENAME_REVIEWS, '', 'SSL'); ?>"><?php echo sprintf(DASHBOARD_REVIEWS_PRODUCTS_OPEN, $reviews_unapproved['count']); ?></a></td>
              </tr> 
              <?php } 
              if ($article_reviews_unapproved['count'] > 0) { ?>
              <tr>
                <td class="messageStackError"><a href="<?php echo tep_href_link(FILENAME_ARTICLE_REVIEWS, '', 'SSL'); ?>"><?php echo sprintf(DASHBOARD_REVIEWS_ARTICLES_OPEN, $article_reviews_unapproved['count']); ?></td>
              </tr> 
              <?php	} 
			  if ( ($reviews_unapproved['count'] == 0) && ($article_reviews_unapproved['count'] == 0) ) { ?>
              <tr>
                <td class="messageStackSuccess"><?php echo DASHBOARD_REVIEW_COMPLETE; ?></td>
              </tr>
              <?php } ?>
            </table>
          </td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<!-- End check for New Product or Article Reviews -->