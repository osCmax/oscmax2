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
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td align="right">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="main" colspan="4"><?php echo TEXT_AFFILIATE_HEADER . ' ' . tep_db_num_rows(tep_db_query($affiliate_payment_raw)); ?></td>
          </tr>
          <tr>
            <td colspan="4"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
            <td class="infoBoxHeading" width="25%"><?php echo TABLE_HEADING_PAYMENT_ID; ?><?php echo '<span title="' . HEADING_PAYMENT_ID_HELP . '|' . TEXT_PAYMENT_ID_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></span></td>
            <td class="infoBoxHeading" width="25%" align="center"><?php echo TABLE_HEADING_DATE; ?><?php echo '<span title="' . HEADING_DATE_HELP . '|' . TEXT_DATE_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></span></td>
            <td class="infoBoxHeading" width="25%" align="right"><?php echo TABLE_HEADING_PAYMENT; ?><?php echo '<span title="' . HEADING_PAYMENT_HELP . '|' . TEXT_PAYMENT_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></td>
            <td class="infoBoxHeading" width="25%" align="right"><?php echo TABLE_HEADING_STATUS; ?><?php echo '<span title="' . HEADING_STATUS_HELP . '|' . TEXT_STATUS_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></td>
          </tr>
         </table>
         <table border="0" width="100%" cellspacing="0" cellpadding="2">
         
<?php
  if ($affiliate_payment_split->number_of_rows > 0) {
    $affiliate_payment_values = tep_db_query($affiliate_payment_split->sql_query);
    $number_of_payment = 0;
    while ($affiliate_payment = tep_db_fetch_array($affiliate_payment_values)) {
      $number_of_payment++;

      if (($number_of_payment / 2) == floor($number_of_payment / 2)) {
        echo '          <tr class="productListing-even">';
      } else {
        echo '          <tr class="productListing-odd">';
      }
?>
            <td class="smallText" width="25%"><?php echo $affiliate_payment['affiliate_payment_id']; ?></td>
            <td class="smallText" width="25%" align="center"><?php echo tep_date_short($affiliate_payment['affiliate_payment_date']); ?></td>
            <td class="smallText" width="25%" align="right"><?php echo $currencies->display_price($affiliate_payment['affiliate_payment_total'], ''); ?></td>
            <td class="smallText" width="25%" align="right"><?php echo $affiliate_payment['affiliate_payment_status_name']; ?></td>
          </tr>
<?php
    }
  } else {
?>
          <tr class="productListing-odd">
            <td colspan="4" class="main"><?php echo TEXT_NO_PAYMENTS; ?></td>
          </tr>
<?php
  }
?>
          <tr>
            <td colspan="4">&nbsp;</td>
          </tr>
<?php 
  if ($affiliate_payment_split->number_of_rows > 0) {
?>    
          <tr>
            <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="4" class="filterbox">
              <tr>
                <td class="smallText"><?php echo $affiliate_payment_split->display_count(TEXT_DISPLAY_NUMBER_OF_PAYMENTS); ?></td>
                <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE; ?> <?php echo $affiliate_payment_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
              </tr>
            </table></td>
          </tr>
<?php
  }
  $affiliate_payment_values = tep_db_query("select sum(affiliate_payment_total) as total from " . TABLE_AFFILIATE_PAYMENT . " where affiliate_id = '" . $affiliate_id . "'");
  $affiliate_payment = tep_db_fetch_array($affiliate_payment_values);
?>
          <tr>
            <td class="main" colspan="4"><br>
			<?php 
			if ($affiliate_payment['total'] != 0) {
			  echo TEXT_INFORMATION_PAYMENT_TOTAL . ' ' . $currencies->display_price($affiliate_payment['total'], '');
			} else {
			  echo TEXT_INFORMATION_PAYMENT_TOTAL . ' ' . TEXT_NO_PAYMENTS;
			}
			?>
            </td>
          </tr>
        </table></td>
      </tr>
    </table>