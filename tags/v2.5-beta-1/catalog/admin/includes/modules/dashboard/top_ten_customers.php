<!-- BOF: Top 10 Customers //-->
<table border="0" width="500" cellspacing="0" cellpadding="0" align="center">
<tr>
<td class="pageheading"><?php echo DASHBOARD_TOP_TEN; ?></td>
</tr>
     <tr valign="top">
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo DASHBOARD_RANK; ?></td>
                <td class="dataTableHeadingContent"><?php echo DASHBOARD_TOP_TEN_CUSTOMER; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo DASHBOARD_TOP_TEN_TOTAL; ?></td>
              </tr>
<?php

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $top_ten_query_raw = "select c.customers_firstname, c.customers_lastname, sum(op.products_quantity * op.final_price) as ordersum from " . TABLE_CUSTOMERS . " c, " . TABLE_ORDERS_PRODUCTS . " op, " . TABLE_ORDERS . " o where c.customers_id = o.customers_id and o.orders_id = op.orders_id group by c.customers_firstname, c.customers_lastname order by ordersum DESC limit 10";

// fix counted customers
  $top_ten_query_numrows = tep_db_query("select customers_id from " . TABLE_ORDERS . " group by customers_id");
  $top_ten_query_numrows = tep_db_num_rows($top_ten_query_numrows);

  $rows = 0;
  $top_ten_query = tep_db_query($top_ten_query_raw);
  while ($top_ten = tep_db_fetch_array($top_ten_query)) {
    $rows++;

    if (strlen($rows) < 2) {
      $rows = '0' . $rows;
    }
?>
              <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="document.location.href='<?php echo tep_href_link(FILENAME_CUSTOMERS, 'search=' . $top_ten['customers_lastname'], 'NONSSL'); ?>'">
                <td class="dataTableContent"><?php echo $rows; ?>.</td>
                <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_CUSTOMERS, 'search=' . $top_ten['customers_lastname'], 'NONSSL') . '">' . $top_ten['customers_firstname'] . ' ' . $top_ten['customers_lastname'] . '</a>'; ?></td>
                <td class="dataTableContent" align="center">
<?php echo $currencies->format($top_ten['ordersum']); ?>&nbsp;</td>
              </tr>
<?php
  }
?>
</table>
</td></tr>
     <tr><td><?php echo '<a href="' . FILENAME_STATS_CUSTOMERS . '">'; ?><?php echo VIEW_COMPLETE_REPORT; ?></a>
     </td></tr>
</table>
</td></tr>
</table>

<!-- EOF: Top 10 Customers //-->