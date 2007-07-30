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
                <td class="dataTableContent">Choose the template of file you wish to print</td>
                <td width="50%"><?php echo tep_draw_pull_down_menu('file_type', $file_type_array, 1); ?></td>
              </tr>
               <tr class="dataTableRow">
		<td class="dataTableContent" width="50%">Please either enter the order numbers/ranges you want extracted to PDF:<br>(eg. 2577,2580-2585,2588)</td>
                 <td width="50%" class="dataTableContent"><?php echo tep_draw_input_field('invoicenumbers'); ?></td>
              </tr>
              <tr class="dataTableRow">
		   <td class="dataTableContent" width="50%">Or enter the dates of orders you want extracted to PDF:<br>(enter date in YYYY-MM-DD format)</td>
           <td width="50%" class="dataTableContent">
                   From<script language="javascript">dateAvailable.writeControl(); dateAvailable.dateFormat="yyyy-MM-dd";</script><br>&nbsp;&nbsp;
                   To  <script language="javascript">dateAvailable1.writeControl(); dateAvailable1.dateFormat="yyyy-MM-dd";</script>
               </td>            
               </tr>
              <tr class="dataTableRow">
                <td width="50%" class="dataTableContent"> When Printing Labels :- Use Billing Address or Delivery Address?</td>
                <td width="50%" class="dataTableContent">Delivery: <?php echo tep_draw_selection_field('address', 'radio', "delivery", true); ?> Billing: <?php echo tep_draw_selection_field('address', 'radio', "billing", false); ?></td>
              </tr>
                            <tr class="dataTableRow">
		   <td class="dataTableContent" width="50%">When Printing Labels :- If you are printing labels what to start on</td>
                 <td width="50%" class="dataTableContent"><?php echo tep_draw_input_field('startpos', '0'); ?></td>
              </tr>


			  <tr class="dataTableRow">
                <td class="dataTableContent">Only include orders with the status:<br>(if none, all orders for date specifed will be included)</td>
                <td width="50%"><?php echo tep_draw_pull_down_menu('pull_status', $orders_statuses, 0); ?></td>
              </tr>
			  <tr class="dataTableRow">
                <td class="dataTableContent">Show order date?</td>
                <td width="50%"><?php echo tep_draw_selection_field('show_order_date', 'checkbox', true, true); ?></td>
              </tr>
              <tr class="dataTableRow">
                <td class="dataTableContent">Show customer's telephone number?</td>
                <td width="50%"><?php echo tep_draw_selection_field('show_phone', 'checkbox', true, true); ?></td>
              </tr>
			  <tr class="dataTableRow">
                <td class="dataTableContent">Show customer's e-mail address?</td>
                <td width="50%"><?php echo tep_draw_selection_field('show_email', 'checkbox', true, true); ?></td>
              </tr>
			  <tr class="dataTableRow">
                <td class="dataTableContent">Show payment information?</td>
                <td width="50%"><?php echo tep_draw_selection_field('show_pay_method', 'checkbox', true, true); ?></td>
              </tr>
			  <tr class="dataTableRow">
                <td class="dataTableContent">Show credit card number? (for credit card orders only)</td>
                <td width="50%"><?php echo tep_draw_selection_field('show_cc', 'checkbox', true, true); ?></td>
              </tr>
             
			  <tr class="dataTableRow">
                <td class="dataTableContent">Automatically change order statuses to:<br>
                  (if none, no statuses will be changed.)</td>
                <td width="50%"><?php echo tep_draw_pull_down_menu('status', $orders_statuses, 0); ?></td>
              </tr>
			  <tr class="dataTableRow">
			    <td class="dataTableContent">Show orders without comments?<br>
		      (Will NOT show order with comments placed by the customer at time of order.)</td>
			    <td><?php echo tep_draw_selection_field('show_comments', 'checkbox', true, false); ?></td>
	      </tr>
			  <tr class="dataTableRow">
			    <td class="dataTableContent">Notify the customer via e-mail?<br>
(This will notify the customer via e-mail with the comments in the batch print
  language file.) </td>
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