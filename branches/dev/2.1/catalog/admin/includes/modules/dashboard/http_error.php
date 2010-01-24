<!-- START HTTP ERROR LOGGING -->
<table border="0" cellspacing="0" cellpadding="0" align="center" width="90%">
	<tr>
    	<td valign="top">
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
        	<tr class="dataTableHeadingRow">
            	<td class="dataTableHeadingContent" width="50">No.</td>
                <td class="dataTableHeadingContent" width="100">Time</td>
                <td class="dataTableHeadingContent" width="100">IP Address</td>
                <td class="dataTableHeadingContent" width="200">URL</td>
                <td class="dataTableHeadingContent">Browser</td>
                <td class="dataTableHeadingContent" width="100">Referer</td>
                <td class="dataTableHeadingContent" width="50">Error Type</td>
          	</tr>
<?php
  if (isset($HTTP_GET_VARS['page']) && ($HTTP_GET_VARS['page'] > 1)) $rows = $HTTP_GET_VARS['page'] * MAX_DISPLAY_SEARCH_RESULTS - MAX_DISPLAY_SEARCH_RESULTS;
  $http_error_query_raw = "select he.error_number, he.error_code, he.error_url, he.error_ip, he. error_browser, he.error_refer, he.error_timestamp from " . TABLE_HTTP_ERROR . " he order by he.error_number DESC";

  $http_error_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $http_error_query_raw, $http_error_query_numrows);
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
                <td colspan="4" align="left"><?php echo '<a href="' . FILENAME_STATS_HTTP_ERROR . '">'; ?>View complete report</td>
            </tr>
        </table>
        </td>
	</tr>            
</table>
<!-- END HTTP ERROR LOGGING -->