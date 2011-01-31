    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">&nbsp;&nbsp;<?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '1', '27'); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  if ($messageStack->size('account') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('account'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>

<table width="100%">
<tr>
<td width="30">&nbsp;</td>
<td width="50"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL') . '">'; ?><?php echo tep_image(DIR_WS_TEMPLATES . 'images/accountinfo.png'); ?></a></td>
<td width="325" class="infoBoxContents"><?php echo '<a style="text-decoration:none" href="' . tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL') . '">'; ?><b>Account Information</b><br /><i>View or update your account details</i></a></td>
<td width="30">&nbsp;</td>
<td width="50"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL') . '">'; ?><?php echo tep_image(DIR_WS_TEMPLATES . 'images/productinfo.png'); ?></a></td>
<td width="325" class="infoBoxContents"><?php echo '<a style="text-decoration:none" href="' . tep_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL') . '">'; ?><b>Product Notifications</b><br /><i>View or update your product notifications</i></td>
<td width="30">&nbsp;</td>
</tr>
<tr>
<td width="30">&nbsp;</td>
<td width="50"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">'; ?><?php echo tep_image(DIR_WS_TEMPLATES . 'images/previous.png'); ?></a></td>
<td width="325" class="infoBoxContents"><?php echo '<a style="text-decoration:none" href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">'; ?><b>Previous Orders</b><br /><i>View my previous orders</i></td>
<td width="30">&nbsp;</td>
<td width="50"><?php echo '<a href="' . tep_href_link(FILENAME_WISHLIST, '', 'SSL') . '">'; ?><?php echo tep_image(DIR_WS_TEMPLATES . 'images/wishlist.png'); ?></a></td>
<td width="325" class="infoBoxContents"><?php echo '<a style="text-decoration:none" href="' . tep_href_link(FILENAME_WISHLIST, '', 'SSL') . '">'; ?><b>Wish List</b><br /><i>View your wishlist</i></td>
<td width="30">&nbsp;</td>
</tr>
<tr>
<td width="30">&nbsp;</td>
<td width="50"><?php echo '<a href="' . tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL') . '">'; ?><?php echo tep_image(DIR_WS_TEMPLATES . 'images/address.png'); ?></a></td>
<td width="325" class="infoBoxContents"><?php echo '<a style="text-decoration:none" href="' . tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL') . '">'; ?><b>Address Book</b><br /><i>View or update your address details</i></td>
<td width="30">&nbsp;</td>
<td width="50"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL') . '">'; ?><?php echo tep_image(DIR_WS_TEMPLATES . 'images/newsletters.png'); ?></a></td>
<td width="325" class="infoBoxContents"><?php echo '<a style="text-decoration:none" href="' . tep_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL') . '">'; ?><b>Newsletters</b></br><i>Subscribe or unsubscribe from newsletters</i></td>
<td width="30">&nbsp;</td>
</tr>
<tr>
<td width="30">&nbsp;</td>
<td width="50"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL') . '">'; ?><?php echo tep_image(DIR_WS_TEMPLATES . 'images/password.png'); ?></a></td>
<td width="325" class="infoBoxContents"><?php echo '<a style="text-decoration:none" href="' . tep_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL') . '">'; ?><b>Password</b><br /><i>Change my account password</i></td>
<td width="30">&nbsp;</td>
<td width="50">&nbsp;</td>
<td width="325">&nbsp;</td>
<td width="30">&nbsp;</td>
</tr>
</table>
<?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>
<?php
  if (tep_count_customer_orders() > 0) {
?>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo OVERVIEW_TITLE; ?></b></td>
            <td class="main"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '"><u>(View all orders)</u></a>'; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
    $orders_query = tep_db_query("select o.orders_id, o.date_purchased, o.delivery_name, o.delivery_country, o.billing_name, o.billing_country, ot.text as order_total, s.orders_status_name from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_TOTAL . " ot, " . TABLE_ORDERS_STATUS . " s where o.customers_id = '" . (int)$customer_id . "' and o.orders_id = ot.orders_id and ot.class = 'ot_total' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and s.public_flag = '1' order by orders_id desc limit 8");
    while ($orders = tep_db_fetch_array($orders_query)) {
      if (tep_not_null($orders['delivery_name'])) {
        $order_name = $orders['delivery_name'];
        $order_country = $orders['delivery_country'];
      } else {
        $order_name = $orders['billing_name'];
        $order_country = $orders['billing_country'];
      }
?>
                  <tr class="moduleRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="document.location.href='<?php echo tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $orders['orders_id'], 'SSL'); ?>'">
                    <td class="main" width="80"><?php echo tep_date_short($orders['date_purchased']); ?></td>
                    <td class="main"><?php echo '#' . $orders['orders_id']; ?></td>
                    <td class="main"><?php echo tep_output_string_protected($order_name) . ', ' . $order_country; ?></td>
                    <td class="main"><?php echo $orders['orders_status_name']; ?></td>
                    <td class="main" align="right"><?php echo $orders['order_total']; ?></td>
                    <td class="main" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $orders['orders_id'], 'SSL') . '">' . tep_image_button('small_view.gif', SMALL_IMAGE_BUTTON_VIEW) . '</a>'; ?></td>
                  </tr>
<?php
    }
?>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <?php
  }
?>   