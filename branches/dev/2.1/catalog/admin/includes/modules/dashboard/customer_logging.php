<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<!-- START CUSTOMER LOGGING -->
<table border="0" cellspacing="0" cellpadding="0" align="center" width="100%">
	<tr>
    	<td valign="top">
        <table border="0" cellspacing="0" cellpadding="2" align="center" width="100%">
			<tr class="dataTableHeadingRow">
               	<td class="dataTableHeadingContent"><?php echo DASHBOARD_NO; ?></td>
               	<td class="dataTableHeadingContent"><?php echo DASHBOARD_TIME; ?></td>
               	<td class="dataTableHeadingContent"><?php echo DASHBOARD_IP; ?></td>
               	<td class="dataTableHeadingContent"><?php echo DASHBOARD_USER; ?></td>
               	<td class="dataTableHeadingContent"><?php echo DASHBOARD_EVENT; ?></td>
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
				<td class="dataTableContent"><?php echo tep_datetime_short($cust_logging['login_time']); ?></td>
				<td class="dataTableContent"><?php echo $cust_logging['ip_address']; ?></td>
				<td class="dataTableContent"><?php echo $cust_logging['user_name']; ?></td>
				<td class="dataTableContent">
                <?php
				switch($cust_logging['type']) {
		          case 'Wrong Password':
                    echo TEXT_WRONG_PASSWORD;
                  break;
				  
		          case 'Wrong Username':
                    echo TEXT_WRONG_USERNAME;
                  break;
				  
		          case 'Logged In':
                    echo TEXT_LOGGED_IN;
                  break;
				  
		          case 'Logged Out':
                    echo TEXT_LOGGED_OUT;
                  break;
				  
				  case 'Admin as Customer':
				    echo TEXT_ADMIN_AS_CUSTOMER;
				  break;
				  
				  case 'Hack Attempt':
				    echo TEXT_ADMIN_HACK_ATTEMPT;
				  break;
				} // end switch
				?>
                </td>
			</tr>

<?php
}
?>
		</table>
        </td>
	</tr>
    <tr>
    	<td><?php echo '<a href="' . FILENAME_STATS_CUST_LOGGING . '">'; ?><?php echo VIEW_COMPLETE_REPORT; ?></a></td>
    </tr>
</table>
<!-- END CUSTOMER LOGGING -->