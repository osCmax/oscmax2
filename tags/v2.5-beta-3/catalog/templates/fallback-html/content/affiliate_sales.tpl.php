<?php
/*
$Id: affiliate_sales.tpl.php 1026 2011-01-07 18:18:43Z michael.oscmax@gmail.com $

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
            <td class="main" colspan="5"><?php echo TEXT_AFFILIATE_HEADER . ' ' . tep_db_num_rows(tep_db_query($affiliate_sales_raw)); ?></td>
          </tr>
          <tr>
            <td colspan="5"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
            <td class="infoBoxHeading" width="74"><?php echo TABLE_HEADING_DATE; ?><?php echo '<span title="' . HEADING_DATE_HELP . '|' . TEXT_DATE_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></span></td>
            <td class="infoBoxHeading" width="130" align="right"><?php echo TABLE_HEADING_VALUE; ?><?php echo '<span title="' . HEADING_SALE_VALUE_HELP . '|' . TEXT_SALE_VALUE_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></span></td>
            <td class="infoBoxHeading" width="130" align="right"><?php echo TABLE_HEADING_PERCENTAGE; ?><?php echo '<span title="' . HEADING_COMMISSION_RATE_HELP . '|' . TEXT_COMMISSION_RATE_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></td>
            <td class="infoBoxHeading" width="130" align="right"><?php echo TABLE_HEADING_SALES; ?><?php echo '<span title="' . HEADING_COMMISSION_VALUE_HELP . '|' . TEXT_COMMISSION_VALUE_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></td>
            <td class="infoBoxHeading" align="right"><?php echo TABLE_HEADING_STATUS; ?><?php echo '<span title="' . HEADING_STATUS_HELP . '|' . TEXT_STATUS_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></td>
          </tr>
        </table>
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if ($affiliate_sales_split->number_of_rows > 0) {
    $affiliate_sales_values = tep_db_query($affiliate_sales_split->sql_query);
    $number_of_sales = 0;
    $sum_of_earnings = 0;
    while ($affiliate_sales = tep_db_fetch_array($affiliate_sales_values)) {
      $number_of_sales++;
      if ($affiliate_sales['orders_status_id'] >= AFFILIATE_PAYMENT_ORDER_MIN_STATUS) $sum_of_earnings += $affiliate_sales['affiliate_payment'];
      if (($number_of_sales / 2) == floor($number_of_sales / 2)) {
        echo '          <tr class="productListing-even">';
      } else {
        echo '          <tr class="productListing-odd">';
      }
?>
            <td class="smallText" width="70"><?php echo tep_date_short($affiliate_sales['affiliate_date']); ?></td>
            <td class="smallText" width="126" align="right"><?php echo $currencies->display_price($affiliate_sales['affiliate_value'], ''); ?></td>
            <td class="smallText" width="126" align="right"><?php echo $affiliate_sales['affiliate_percent'] . " %"; ?></td>
            <td class="smallText" width="126" align="right"><?php echo $currencies->display_price($affiliate_sales['affiliate_payment'], ''); ?></td>
            <td class="smallText" align="right"><?php if ($affiliate_sales['orders_status']) echo $affiliate_sales['orders_status']; else echo TEXT_DELETED_ORDER_BY_ADMIN; ?></td>
          </tr>
<?php
    }
  } else {
?>
          <tr class="productListing-odd">
            <td class="main" colspan="5"><?php echo TEXT_NO_SALES; ?></td>
          </tr>
<?php
  }
?>

          <tr>
            <td class="main" colspan="5">&nbsp;</td>
          </tr>

<?php 
  if ($affiliate_sales_split->number_of_rows > 0) {
?>
          <tr>
            <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="4" class="filterbox">
              <tr>
                <td class="smallText"><?php echo $affiliate_sales_split->display_count(TEXT_DISPLAY_NUMBER_OF_SALES); ?></td>
                <td class="smallText" align="right"><?php echo TEXT_RESULT_PAGE; ?> <?php echo $affiliate_sales_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
<?php
  }
?>
            <td class="main" colspan="5"><br><?php echo TEXT_INFORMATION_SALES_TOTAL . ' ' .  $currencies->display_price($sum_of_earnings,'') . TEXT_INFORMATION_SALES_TOTAL2; ?></td>
          </tr>
        </table></td>
      </tr>
    </table>