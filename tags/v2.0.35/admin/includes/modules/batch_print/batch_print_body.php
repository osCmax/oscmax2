<?php if (!$message) { ?>
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
echo "Problem opening directory $directory. Error: $php_errormsg";
exit;
}
$file_type_array = array();
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

<tr>
<?php echo tep_draw_form('batch', FILENAME_BATCH_PRINT, 'act=1'); ?>
<td>
	    <table border="0" cellpadding="5" cellspacing="0" width="100%">
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              			  <tr class="dataTableRow">
                <td class="dataTableContent"><?php echo TEXT_CHOOSE_TEMPLATE; ?></td>
                <td width="50%"><?php echo tep_draw_pull_down_menu('file_type', $file_type_array, 1); ?></td>
              </tr>
               <tr class="dataTableRow">
		<td class="dataTableContent" width="50%"><?php echo TEXT_ORDER_NUMBERS_RANGES; ?></td>
                 <td width="50%" class="dataTableContent"><?php echo tep_draw_input_field('invoicenumbers'); ?></td>
              </tr>
              <tr class="dataTableRow">
		   <td class="dataTableContent" width="50%"><?php echo TEXT_DATES_ORDERS_EXTRACTRED; ?></td>
           <td width="50%" class="dataTableContent">
                   <?php echo TEXT_FROM; ?><script language="javascript">dateAvailable.writeControl(); dateAvailable.dateFormat="yyyy-MM-dd";</script><br>&nbsp;&nbsp;
                   <?php echo TEXT_TO; ?>  <script language="javascript">dateAvailable1.writeControl(); dateAvailable1.dateFormat="yyyy-MM-dd";</script>
               </td>            
               </tr>
              <tr class="dataTableRow">
                <td width="50%" class="dataTableContent"><?php echo TEXT_PRINTING_LABELS_BILLING_DELIVERY; ?></td>
                <td width="50%" class="dataTableContent"><?php echo TEXT_DELIVERY; ?><?php echo tep_draw_selection_field('address', 'radio', "delivery", true); ?><?php echo TEXT_BILLING; ?><?php echo tep_draw_selection_field('address', 'radio', "billing", false); ?></td>
              </tr>
                            <tr class="dataTableRow">
		   <td class="dataTableContent" width="50%"><?php echo TEXT_POSITION_START_PRINTING; ?></td>
                 <td width="50%" class="dataTableContent"><?php echo tep_draw_input_field('startpos', '0'); ?></td>
              </tr>


			  <tr class="dataTableRow">
                <td class="dataTableContent"><?php echo TEXT_INCLUDE_ORDERS_STATUS; ?></td>
                <td width="50%"><?php echo tep_draw_pull_down_menu('pull_status', $orders_statuses, 0); ?></td>
              </tr>
			  <tr class="dataTableRow">
                <td class="dataTableContent"><?php echo TEXT_SHOW_ORDER; ?></td>
                <td width="50%"><?php echo tep_draw_selection_field('show_order_date', 'checkbox', true, true); ?></td>
              </tr>
              <tr class="dataTableRow">
                <td class="dataTableContent"><?php echo TEXT_SHOW_PHONE_NUMBER; ?></td>
                <td width="50%"><?php echo tep_draw_selection_field('show_phone', 'checkbox', true, true); ?></td>
              </tr>
			  <tr class="dataTableRow">
                <td class="dataTableContent"><?php echo TEXT_SHOW_EMAIL_CUSTOMER; ?></td>
                <td width="50%"><?php echo tep_draw_selection_field('show_email', 'checkbox', true, true); ?></td>
              </tr>
			  <tr class="dataTableRow">
                <td class="dataTableContent"><?php echo TEXT_PAYMENT_INFORMATION; ?></td>
                <td width="50%"><?php echo tep_draw_selection_field('show_pay_method', 'checkbox', true, true); ?></td>
              </tr>
			  <tr class="dataTableRow">
                <td class="dataTableContent"><?php echo TEXT_SHOW_CREDIT_CARD_NUMBER; ?></td>
                <td width="50%"><?php echo tep_draw_selection_field('show_cc', 'checkbox', true, true); ?></td>
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
              <td align="right" colspan="2"><?php echo tep_image_submit('button_send.gif', IMAGE_SEND_EMAIL); ?></td>
              </tr>
			  </table>
</td>
</form>
</tr>
<?php } else { ?>
<tr>
<td>
	    <table border="0" cellpadding="5" cellspacing="0" width="100%">
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr class="dataTableRowSelected">
		<td class="dataTableContent" width="50%"><b>Program Message:</b></td>
		</tr>
                <tr class="dataTableRow">
                <td class="dataTableContent"><?php echo $message; ?></td>
              </tr>
			  </table>
<?php } ?>