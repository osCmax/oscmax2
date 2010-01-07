<!-- START ORDER SNAPSHOT -->  
<table border="0" width="500" cellspacing="0" cellpadding="2" align="center">
<tr>
<td class="pageheading">Orders Snapshot</td>
</tr>
  <tr class="dataTableHeadingRow">
      <td class="dataTableHeadingContent">Order Status</td>
      <td class="dataTableHeadingContent" align="center">Qty</td>
  <tr>        
  <?php
$orders_contents = '';
  $orders_status_query = tep_db_query("select orders_status_name, orders_status_id from " . TABLE_ORDERS_STATUS . " where language_id = '" . $languages_id . "'");
  while ($orders_status = tep_db_fetch_array($orders_status_query)) {
    $orders_pending_query = tep_db_query("select count(*) as count from " . TABLE_ORDERS . " where orders_status = '" . $orders_status['orders_status_id'] . "'");
    $orders_pending = tep_db_fetch_array($orders_pending_query);

if (tep_admin_check_boxes(FILENAME_ORDERS, 'sub_boxes') == true) {
      $orders_contents .= '<tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" ><td class="dataTableContent"><a href="' . tep_href_link(FILENAME_ORDERS, 'selected_box=customers&status=' . $orders_status['orders_status_id']) . '">' . $orders_status['orders_status_name'] . '</a>:</td><td class="dataTableContent" align="center"> ' . $orders_pending['count'] . '</td></tr>';
    } else {
      $orders_contents .= '' . $orders_status['orders_status_name'] . ': ' . $orders_pending['count'] . '<br>';
    }
// EOF: MOD - Admin w/access levels
  }
  
  $contents = array();

echo $orders_contents;
  ?>
  </table>
<!-- END ORDER SNAPSHOT -->  