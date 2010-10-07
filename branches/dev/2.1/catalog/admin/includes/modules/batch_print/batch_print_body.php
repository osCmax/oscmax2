<?php 
$order_statuses = array();
$orders_status_query = tep_db_query("select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . " where language_id = '" . $languages_id . "'");
$orders_statuses[] = array('id' => 0, 'text' => 'None');
while ($orders_status = tep_db_fetch_array($orders_status_query)) {
$orders_statuses[] = array('id' => $orders_status['orders_status_id'],'text' => $orders_status['orders_status_name']);
}
?>
<?php
$directory = BATCH_PRINT_INC . 'templates';
$resc = opendir($directory);
if (!$resc) {
echo "Error: Problem opening directory $directory. Error: $php_errormsg";
exit;
}
$file_type_array = array();
$file_type_array[] = array('id' => $file,'text' => 'Please select ...');
while ($file = readdir($resc)) {
  $ext = strrchr($file, ".");
  if ($ext == ".php") {
    $filename = str_replace('_', " ",$file);
    $filename = str_replace('-', " ",$filename);
    $filename = str_replace($ext, "",$filename);
    $file_type_array[] = array('id' => $file,'text' => $filename);
  }
}
?>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
	<tr>
<?php echo tep_draw_form('batch', FILENAME_BATCH_PRINT, 'act=1'); ?>    
		<td width="75%" valign="top">
	    <table border="0" cellspacing="0" cellpadding="4" width="100%">
        	<tr class="dataTableRow">
                <td class="dataTableContent"><?php echo TEXT_CHOOSE_TEMPLATE; ?></td>
                <td width="50%"><?php echo tep_draw_pull_down_menu('file_type', $file_type_array, 1, 'id="file_type"'); ?></td>
            </tr>
            <tr class="dataTableRow">
				<td class="dataTableContent" width="50%"><?php echo TEXT_ORDER_NUMBERS_RANGES; ?></td>
                <td width="50%" class="dataTableContent"><?php echo tep_draw_input_field('invoicenumbers'); ?></td>
            </tr>
            <tr class="dataTableRow">
		   		<td class="dataTableContent" width="50%"><?php echo TEXT_DATES_ORDERS_EXTRACTRED; ?></td>
           		<td width="50%" class="dataTableContent">
                	<table>
                    	<tr>
                        	<td class="dataTableContent" ><?php echo TEXT_FROM; ?></td>
							<td><?php echo tep_draw_input_field('startdate', '', 'id="batch_print_start" autocomplete="off"'); ?></td>
                            <td class="dataTableContent" ><?php echo TEXT_TO; ?></td>
							<td><?php echo tep_draw_input_field('enddate', '', 'id="batch_print_end" autocomplete="off"'); ?></td>
                  		</tr>
                  	</table>
               </td>            
            </tr>
			<tr class="dataTableRow">
                <td class="dataTableContent"><?php echo TEXT_INCLUDE_ORDERS_STATUS; ?></td>
                <td width="50%"><?php echo tep_draw_pull_down_menu('pull_status', $orders_statuses, 0); ?></td>
            </tr>
			<tr class="dataTableRow">
                <td class="dataTableContent"><?php echo TEXT_AUTOMACILLLY_CHANGE_ORDER; ?></td>
                <td width="50%"><?php echo tep_draw_pull_down_menu('status', $orders_statuses, 0); ?></td>
            </tr>
			<tr class="dataTableRow">
			    <td class="dataTableContent"><?php echo TEXT_SHOW_OREDERS_COMMENTS; ?></td>
			    <td><?php echo tep_draw_selection_field('show_comments', 'checkbox', true, false); ?></td>
	      	</tr>
			<tr class="dataTableRow">
			    <td class="dataTableContent"><?php echo TEXT_NOTIFY_CUSTOMER; ?></td>
			    <td><?php echo tep_draw_selection_field('notify', 'checkbox', true, false); ?></td>
	      	</tr>
            <tr>
              	<td align="right" colspan="2"><div id="send_button"><?php echo tep_image_submit('button_send.gif', IMAGE_SEND_EMAIL); ?></div></td>
            </tr>
		</table>
		</td>
	    <td width="25%" valign="top">
			<div id="Labels">
            <table border="0" cellspacing="0" cellpadding="2" width="100%">
               	<tr class="infoBoxHeading">
                	<td class="infoBoxHeading" colspan="2">Batch Print Center Options</td>
                </tr>               
                <tr>
                    <td class="infoBoxContent" colspan="2"><?php echo TEXT_PRINTING_LABELS_BILLING_DELIVERY; ?></td>
                </tr>
                <tr>
                    <td class="infoBoxContent" align="center" colspan="2"><?php echo TEXT_DELIVERY; ?><?php echo tep_draw_selection_field('address', 'radio', "delivery", true); ?><?php echo TEXT_BILLING; ?><?php echo tep_draw_selection_field('address', 'radio', "billing", false); ?></td>
                </tr>
                <tr>
                    <td class="infoBoxContent" colspan="2"><?php echo TEXT_POSITION_START_PRINTING; ?></td>
                </tr>
                <tr>
                    <td class="infoBoxContent" align="center" colspan="2"><?php echo tep_draw_input_field('startpos', '0'); ?></td>
                </tr>
          	</table>
            </div>
            <div id="Invoices">
            <table border="0" cellspacing="0" cellpadding="2" width="100%">
                <tr class="infoBoxHeading">
                	<td class="infoBoxHeading" colspan="2">Batch Print Center Options</td>
                </tr>
                <tr>
                    <td class="infoBoxContent"><?php echo TEXT_SHOW_ORDER; ?></td>
                    <td class="infoBoxContent" width="10%"><?php echo tep_draw_selection_field('show_order_date', 'checkbox', true, true); ?></td>
                </tr>
                <tr>
                    <td class="infoBoxContent"><?php echo TEXT_SHOW_PHONE_NUMBER; ?></td>
                    <td class="infoBoxContent" width="10%"><?php echo tep_draw_selection_field('show_phone', 'checkbox', true, true); ?></td>
                </tr>
                <tr>
                    <td class="infoBoxContent"><?php echo TEXT_SHOW_EMAIL_CUSTOMER; ?></td>
                    <td class="infoBoxContent" width="10%"><?php echo tep_draw_selection_field('show_email', 'checkbox', true, true); ?></td>
                </tr>
                <tr>
                    <td class="infoBoxContent"><?php echo TEXT_PAYMENT_INFORMATION; ?></td>
                    <td class="infoBoxContent" width="10%"><?php echo tep_draw_selection_field('show_pay_method', 'checkbox', true, true); ?></td>
                </tr>
                <tr>
                    <td class="infoBoxContent"><?php echo TEXT_SHOW_CREDIT_CARD_NUMBER; ?></td>
                    <td class="infoBoxContent" width="10%"><?php echo tep_draw_selection_field('show_cc', 'checkbox', true, true); ?></td>
                </tr>
            </table>
            </div>
            <div id="No_Options">
            <table border="0" cellspacing="0" cellpadding="2" width="100%">
                <tr class="infoBoxHeading">
                	<td class="infoBoxHeading" colspan="2">Batch Print Center Options</td>
                </tr>
                <tr>
                    <td class="infoBoxContent">There are no options available for your selected option.</td>
                    <td class="infoBoxContent"></td>
                </tr>
            </table>
            </div>
        </td>
    </form>
</tr>