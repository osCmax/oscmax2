<!-- START DATABASE SNAPSHOT -->
  <table border="0" width="500" cellspacing="0" cellpadding="2" align="center">
<tr>
<td class="pageheading"><?php echo DASHBOARD_DATABASE; ?></td>
</tr>
    <tr class="dataTableHeadingRow">
      <td class="dataTableHeadingContent"></td>
      <td class="dataTableHeadingContent" align="center"><?php echo DASHBOARD_QUANTITY; ?></td>
  <?php
  $customers_query = tep_db_query("select count(*) as count from " . TABLE_CUSTOMERS);
  $customers = tep_db_fetch_array($customers_query);
  $products_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS . " where products_status = '1'");
  $products = tep_db_fetch_array($products_query);
  $specials_query = tep_db_query("select count(*) as count from " . TABLE_SPECIALS);
  $specials = tep_db_fetch_array($specials_query);
  
  
  
  echo '<tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" ><td class="dataTableContent">' . DASHBOARD_DATABASE_CUST . '</td><td class="dataTableContent" align="center"> ' . $customers['count'] . '</td></tr>';
  echo '<tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" ><td class="dataTableContent">' . DASHBOARD_DATABASE_PROD . '</td><td class="dataTableContent" align="center"> ' . $products['count'] . '</td></tr>';
  echo '<tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" ><td class="dataTableContent"><a href="specials.php">' . DASHBOARD_DATABASE_SPEC . '</a></td><td class="dataTableContent" align="center"> ' . $specials['count'] . '</td></tr>';
  ?>
  </table>
<!-- END DATBASE SNAPSHOT -->
