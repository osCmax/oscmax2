<!-- START HTTP ERROR LOGGING -->
<table border="0" cellspacing="0" cellpadding="0" align="center" width="90%">
	<tr>
    	<td valign="top">
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
        	<tr class="dataTableHeadingRow">
            	<td class="dataTableHeadingContent" width="50"><?php echo DASHBOARD_NO; ?></td>
                <td class="dataTableHeadingContent" width="100"><?php echo DASHBOARD_TIME; ?></td>
                <td class="dataTableHeadingContent" width="100"><?php echo DASHBOARD_IP; ?></td>
                <td class="dataTableHeadingContent" width="200"><?php echo DASHBOARD_HTTP_URL; ?></td>
                <td class="dataTableHeadingContent"><?php echo DASHBOARD_HTTP_BROWSER; ?></td>
                <td class="dataTableHeadingContent" width="100"><?php echo DASHBOARD_HTTP_REFER; ?></td>
                <td class="dataTableHeadingContent" width="50"><?php echo DASHBOARD_HTTP_ERROR; ?></td>
          	</tr>
<?php
  if (isset($_GET['page']) && ($_GET['page'] > 1)) $rows = $_GET['page'] * MAX_DISPLAY_SEARCH_RESULTS - MAX_DISPLAY_SEARCH_RESULTS;
  $http_error_query_raw = "select he.error_number, he.error_code, he.error_url, he.error_ip, he. error_browser, he.error_refer, he.error_timestamp from " . TABLE_HTTP_ERROR . " he order by he.error_number DESC";

  $http_error_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $http_error_query_raw, $http_error_query_numrows);
// fix counted customers
  $http_error_query_numrows = tep_db_query("select error_number from " . TABLE_HTTP_ERROR . " group by error_number");
  $http_error_query_numrows = tep_db_num_rows($http_error_query_numrows);

  $rows = 0;
  $http_error_query = tep_db_query($http_error_query_raw);
  while ($http_error = tep_db_fetch_array($http_error_query)) {
    $rows++;

    if (strlen($rows) < 2) {
      $rows = '0' . $rows;
    }

?>
			<tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">
        		<td class="dataTableContent"><?php echo $http_error['error_number']; ?></td>
       		 	<td class="dataTableContent"><?php echo $http_error['error_timestamp']; ?></td>
        		<td class="dataTableContent"><?php echo $http_error['error_ip']; ?></td>
                <td class="dataTableContent"><?php echo $http_error['error_url']; ?></td>
                <td class="dataTableContent"><?php echo $http_error['error_browser']; ?></td>
                <td class="dataTableContent"><?php echo $http_error['error_refer']; ?></td>
                <td class="dataTableContent"><?php echo $http_error['error_code']; ?></td>
			</tr>
<?php
  }
?>
            <tr>
                <td colspan="4" align="left"><?php echo '<a href="' . FILENAME_STATS_HTTP_ERROR . '">'; ?><?php echo VIEW_COMPLETE_REPORT; ?></a></td>
            </tr>
        </table>
        </td>
	</tr>            
</table>
<!-- END HTTP ERROR LOGGING -->