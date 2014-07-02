<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '4'); ?></td>
      </tr>
	  <tr>
        <td class="productinfo_header"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main" colspan="4"><?php echo TEXT_AFFILIATE_HEADER . ' <b>' . $affiliate_clickthroughs_numrows; ?></b></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="infoBoxHeading" width="90">&nbsp;&nbsp;<?php echo TABLE_HEADING_DATE; ?><?php echo '<span title="' . HEADING_DATE_HELP . '|' . TEXT_DATE_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></span></td>
 	        <td class="infoBoxHeading" width="128"><?php echo TABLE_HEADING_CLICKED_PRODUCT; ?><?php echo '<span title="' . HEADING_PRODUCT_HELP . '|' . TEXT_CLICKED_PRODUCT_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></span></td>
	        <td class="infoBoxHeading"><?php echo TABLE_HEADING_REFFERED; ?><?php echo '<span title="' . HEADING_REFFERED_HELP . '|' . TEXT_REFFERED_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></span></td>
          </tr>
          </table>
          <table border="0" width="100%" cellspacing="0" cellpadding="4">
<?php
  if ($affiliate_clickthroughs_split->number_of_rows > 0) {
    $affiliate_clickthroughs_values = tep_db_query($affiliate_clickthroughs_split->sql_query);
    $number_of_clickthroughs = '0';
    while ($affiliate_clickthroughs = tep_db_fetch_array($affiliate_clickthroughs_values)) {
      $number_of_clickthroughs++;

      if (($number_of_clickthroughs / 2) == floor($number_of_clickthroughs / 2)) {
        echo '          <tr class="productListing-even">';
      } else {
        echo '          <tr class="productListing-odd">';
      }
?>
            <td class="smallText" width="80"><?php echo tep_date_short($affiliate_clickthroughs['affiliate_clientdate']); ?></td>
<?php
      if ($affiliate_clickthroughs['affiliate_products_id'] > 0) {
        $link_to = '<a href="' . tep_href_link (FILENAME_PRODUCT_INFO, 'products_id=' . $affiliate_clickthroughs['affiliate_products_id']) . '" target="_blank">' . $affiliate_clickthroughs['products_name'] . '</a>';
      } else {
        $link_to = "Startpage";
      }
?>
            <td class="smallText" width="120"><?php echo $link_to; ?></td>
            <td class="smallText"><?php echo $affiliate_clickthroughs['affiliate_clientreferer']; ?></td>
          </tr>
<?php
    }
  } else {
?>
          <tr class="productListing-odd">
            <td colspan="4" class="smallText"><?php echo TEXT_NO_CLICKS; ?></td>
          </tr>
<?php
  }
?>
<?php 
  if ($affiliate_clickthroughs_split->number_of_rows > 0) {
?>
          <tr>
            <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="4" class="filterbox">
              <tr>
                <td class="smallText"><?php echo $affiliate_clickthroughs_split->display_count(TEXT_DISPLAY_NUMBER_OF_CLICKS); ?></td>
                <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE; ?> <?php echo $affiliate_clickthroughs_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
              </tr>
            </table></td>
          </tr>
<?php
  }
?>
                 <tr>
                  <td align="center" class="boxText" colspan="4"><b><?php echo TEXT_CLICKS_1 . tep_image(DIR_WS_ICONS . 'help.png', '') . TEXT_CLICKS_2; ?><b></td>
                </tr>
        </table></td>
      </tr>
    </table>