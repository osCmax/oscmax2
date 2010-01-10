<!-- START CUSTOMER LOGGING -->
<table border="0" cellspacing="0" cellpadding="0" align="center" width="90%">
	<tr>
    	<td valign="top">
        <table border="0" cellspacing="0" cellpadding="2" align="center" width="100%">
			<tr class="dataTableHeadingRow">
               	<td class="dataTableHeadingContent">No.</td>
               	<td class="dataTableHeadingContent">Time</td>
               	<td class="dataTableHeadingContent">IP Address</td>
               	<td class="dataTableHeadingContent">User ID</td>
               	<td class="dataTableHeadingContent">Event Type</td>
        	</tr>
<?php

  $cust_logging_query_raw = "select l.login_number, l.user_name, l.ip_address, l.type, l.login_time from " . TABLE_CUSTOMER_LOG . " l order by l.login_number DESC limit 20";

  $cust_logging_query = tep_db_query($cust_logging_query_raw);
  while ($cust_logging = tep_db_fetch_array($cust_logging_query)) {

  $Message = $cust_logging['type'];
  $style = '';

//Set format for row  
  if ($Message == 'Wrong Username') { $style = 'Alert';}
  if ($Message == 'Wrong Password') { $style = 'Warning';}

  		echo '<tr class="dataTableRow' . $style . '" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">';
  
?>
				<td class="dataTableContent"><?php echo $cust_logging['login_number']; ?></td>
				<td class="dataTableContent"><?php echo $cust_logging['login_time']; ?></td>
				<td class="dataTableContent"><?php echo $cust_logging['ip_address']; ?></td>
				<td class="dataTableContent"><?php echo $cust_logging['user_name']; ?></td>
				<td class="dataTableContent"><?php echo $cust_logging['type']; ?></td>
			</tr>

<?php
}
?>
		</table>
        </td>
	</tr>
    <tr>
    	<td><?php echo '<a href="' . FILENAME_STATS_CUST_LOGGING . '">'; ?>View complete report</td>
    </tr>
</table>
<!-- END CUSTOMER LOGGING -->