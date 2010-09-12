<?php

  require('includes/application_top.php');

// Moved functions into seperate file
  require(DIR_WS_FUNCTIONS . 'batch_print.php');
  
  $pageloop = "0";
  if ($_GET['mkey']) {

    $key = $_GET['mkey']; 
    $message = $error[$key]; 
    $_GET['act'] = 0; 

  }

  if ($_GET['act'] == '') { $_GET['act'] = 0; }

  if (strlen($_GET['act']) == 1 && is_numeric($_GET['act']))
    {

    switch ($_GET['act']) {

      case 1:

        // check if invoice number is a empty field .. if its not empty do this ..
        // if it is empty skip down to the check date entered code.
        //if ($invoicenumbers != '') {
	 	if ($_POST['invoicenumbers']) {

          if (!isset($_POST['invoicenumbers'])) { message_handler('ERROR_BAD_INVOICENUMBERS');  }
          if (!is_writeable(BATCH_PDF_DIR)) { message_handler('SET_PERMISSIONS'); }
          $time0   = time();
          $invoicenumbers = tep_db_prepare_input($_POST['invoicenumbers']);
          $arr_no = explode(',',$invoicenumbers);
          foreach ($arr_no as $key=>$value) {
            $arr_no[$key]=trim($value);
            if (substr_count($arr_no[$key],'-')>0) {
              $temp_range=explode('-',$arr_no[$key]);
              $arr_no[$key]=implode(',',range((int) $temp_range[0], (int) $temp_range[1]));
            }
          }
          $invoicenumbers=implode(',',$arr_no);

        } else {


  // CHECK DATE ENTERED, GRAB ALL ORDERS FROM THAT DATE, AND CREATE PDF FOR ORDERS
          if (!isset($_POST['startdate'])) { message_handler(); }
          if ((strlen($_POST['startdate']) != 10) || verify_start_date($_POST['startdate'])) { message_handler('ERROR_BAD_DATE'); }
          if (!is_writeable(BATCH_PDF_DIR)) { message_handler('SET_PERMISSIONS'); }
          $time0   = time();
          $startdate = tep_db_prepare_input($_POST['startdate']);

          if (!isset($_POST['enddate'])) { message_handler(); }
          if ((strlen($_POST['enddate']) != 10) || verify_end_date($_POST['enddate'])) { message_handler('ERROR_BAD_DATE'); }
          if (!is_writeable(BATCH_PDF_DIR)) { message_handler('SET_PERMISSIONS'); }
          $time0   = time();
          $enddate = tep_db_prepare_input($_POST['enddate']);
        }

        require(DIR_WS_CLASSES . 'currencies.php');
        require(BATCH_PRINT_INC . 'class.ezpdf.php');
        require(DIR_WS_CLASSES . 'order.php');


        //grab only the page size and layout from template
        require(BATCH_PRINT_INC . 'templates/' . $_POST['file_type']);
        $pageloop = "1";
        //$pdf = new Cezpdf($_POST['page'],$_POST['orientation']);



        if ($_POST['show_comments']) { $get_customer_comments = ' and h.orders_status_id = ' . DEFAULT_ORDERS_STATUS_ID; }
        if ($_POST['pull_status']){ $pull_w_status = " and o.orders_status = ". $_POST['pull_status']; }


        // if there is a invoice number use first order query otherwise use second date style order query
        if ($invoicenumbers != '') {
          $orders_query = tep_db_query("select o.orders_id,h.comments,MIN(h.date_added) from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_STATUS_HISTORY . " h where o.orders_id in (" . tep_db_input($invoicenumbers) . ") and h.orders_id = o.orders_id" . $pull_w_status . $get_customer_comments . ' group by o.orders_id');
        } else {  
          $orders_query = tep_db_query("select o.orders_id,h.comments,MIN(h.date_added) from " . TABLE_ORDERS . " o, " . TABLE_ORDERS_STATUS_HISTORY . " h where o.date_purchased between '" . tep_db_input($startdate) . "' and '" . tep_db_input($enddate) . " 23:59:59'  and h.orders_id = o.orders_id" . $pull_w_status . $get_customer_comments . ' group by o.orders_id');
        }
 
 
        if (!tep_db_num_rows($orders_query) > 0) { message_handler('NO_ORDERS'); }
        $num = 0;
 
        while ($orders = tep_db_fetch_array($orders_query)) {

          $order = new order($orders['orders_id']);
  
          if ($num != 0) { $pdf->EzNewPage(); }


  // start of pdf layout ..   ################################

          require(BATCH_PRINT_INC . 'templates/' . $_POST['file_type']);

  // end pdf layout section     ###############################

          if ($_POST['status'] && ($_POST['status'] != $order->info['orders_status'])){
            $customer_notified = 0; 
            $status = tep_db_prepare_input($_POST['status']);
            $notify_comments = sprintf(EMAIL_TEXT_COMMENTS_UPDATE, BATCH_COMMENTS) . "\n\n";

            if ($_POST['notify']) {
              $status_query = tep_db_query("select orders_status_name as name from " . TABLE_ORDERS_STATUS . " where language_id = '" . $languages_id . "' and orders_status_id = " . tep_db_input($status));
              $status_name = tep_db_fetch_array($status_query);

              $email = STORE_NAME . "\n" . EMAIL_SEPARATOR . "\n" . EMAIL_TEXT_ORDER_NUMBER . ' ' . $orders['orders_id'] . "\n" . EMAIL_TEXT_INVOICE_URL . ' ' . tep_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $orders['orders_id'], 'SSL') . "\n" . EMAIL_TEXT_DATE_ORDERED . ' ' . tep_date_long($order->info['date_purchased']) . "\n\n" . $notify_comments . sprintf(EMAIL_TEXT_STATUS_UPDATE, $status_name['name']);
              tep_mail($order->customer['name'], $order->customer['email_address'], EMAIL_TEXT_SUBJECT, nl2br($email), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
                        $customer_notified = '1';
            }

            tep_db_query("update " . TABLE_ORDERS . " set orders_status = '" . tep_db_input($status) . "', last_modified = now() where orders_id = '" . $orders['orders_id'] . "'");
            tep_db_query("insert into " . TABLE_ORDERS_STATUS_HISTORY . " (orders_id, orders_status_id, date_added, customer_notified, comments) 
            values ('" . $orders['orders_id'] . "', '" . tep_db_input($status) . "', now(), '" . $customer_notified . "', '" . $notify_comments  . "')");
          }
          $num++;
          // Send fake header to avoid timeout, got this trick from phpMyAdmin
          $time1  = time();
          if ($time1 >= $time0 + 30) {
            $time0 = $time1;
            header('X-bpPing: Pong');
          }
        }// EOWHILE

        $pdf_code = $pdf->output();

        $fname = BATCH_PDF_DIR . BATCH_PDF_FILE;
        if ($fp = fopen($fname,'w')) {
          fwrite($fp,$pdf_code);
          fclose($fp);
        } else { message_handler('FAILED_TO_OPEN'); }
        // changed below to cause pdf to open in a new window 
        $message =  'Success: PDF of ' . $num . ' record(s) was created successfully. Please 
        <a href="'.$fname.'" target="_blank"><b>click here</b></a> to open the file.';

      case 0:

        require(BATCH_PRINT_INC . 'batch_print_header.php');
        require(BATCH_PRINT_INC . 'batch_print_body.php');
        require(BATCH_PRINT_INC . 'batch_print_footer.php');
        break;

      default:

        message_handler();

      }//EOSWITCH


    } else {

      message_handler('ERROR_INVALID_INPUT');

    }

?>