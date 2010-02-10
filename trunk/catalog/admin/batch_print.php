<?php

  require('includes/application_top.php');
  $pageloop = "0";
  if ($HTTP_GET_VARS['mkey']) {

    $key = $HTTP_GET_VARS['mkey']; 
    $message = $error[$key]; 
    $HTTP_GET_VARS['act'] = 0; 

  }

  if ($HTTP_GET_VARS['act'] == '') { $HTTP_GET_VARS['act'] = 0; }

  if (strlen($HTTP_GET_VARS['act']) == 1 && is_numeric($HTTP_GET_VARS['act']))
    {

    switch ($HTTP_GET_VARS['act']) {

      case 1:

        // check if invoice number is a empty field .. if its not empty do this ..
        // if it is empty skip down to the check date entered code.
        if ($invoicenumbers != '') {

          if (!isset($HTTP_POST_VARS['invoicenumbers'])) { message_handler('ERROR_BAD_INVOICENUMBERS');  }
          if (!is_writeable(BATCH_PDF_DIR)) { message_handler('SET_PERMISSIONS'); }
          $time0   = time();
          $invoicenumbers = tep_db_prepare_input($HTTP_POST_VARS['invoicenumbers']);
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
          if (!isset($HTTP_POST_VARS['startdate'])) { message_handler(); }
          if ((strlen($HTTP_POST_VARS['startdate']) != 10) || verify_start_date($HTTP_POST_VARS['startdate'])) { message_handler('ERROR_BAD_DATE'); }
          if (!is_writeable(BATCH_PDF_DIR)) { message_handler('SET_PERMISSIONS'); }
          $time0   = time();
          $startdate = tep_db_prepare_input($HTTP_POST_VARS['startdate']);

          if (!isset($HTTP_POST_VARS['enddate'])) { message_handler(); }
          if ((strlen($HTTP_POST_VARS['enddate']) != 10) || verify_end_date($HTTP_POST_VARS['enddate'])) { message_handler('ERROR_BAD_DATE'); }
          if (!is_writeable(BATCH_PDF_DIR)) { message_handler('SET_PERMISSIONS'); }
          $time0   = time();
          $enddate = tep_db_prepare_input($HTTP_POST_VARS['enddate']);
        }

        require(DIR_WS_CLASSES . 'currencies.php');
        require(BATCH_PRINT_INC . 'class.ezpdf.php');
        require(DIR_WS_CLASSES . 'order.php');


        //grab only the page size and layout from template
        require(BATCH_PRINT_INC . 'templates/' . $HTTP_POST_VARS['file_type']);
        $pageloop = "1";
        //$pdf = new Cezpdf($HTTP_POST_VARS['page'],$HTTP_POST_VARS['orientation']);



        if ($HTTP_POST_VARS['show_comments']) { $get_customer_comments = ' and h.orders_status_id = ' . DEFAULT_ORDERS_STATUS_ID; }
        if ($HTTP_POST_VARS['pull_status']){ $pull_w_status = " and o.orders_status = ". $HTTP_POST_VARS['pull_status']; }


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

          require(BATCH_PRINT_INC . 'templates/' . $HTTP_POST_VARS['file_type']);

  // end pdf layout section     ###############################

          if ($HTTP_POST_VARS['status'] && ($HTTP_POST_VARS['status'] != $order->info['orders_status'])){
            $customer_notified = 0; 
            $status = tep_db_prepare_input($HTTP_POST_VARS['status']);
            $notify_comments = sprintf(EMAIL_TEXT_COMMENTS_UPDATE, BATCH_COMMENTS) . "\n\n";

            if ($HTTP_POST_VARS['notify']) {
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
        $message =  'A PDF of ' . $num . ' record(s) was successful! 
        <a href="'.$fname.'" target="_blank"><b>Click here</b></a> to download the order file.';

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

    // FUNCTION AREA
    function message_handler($message=''){

      if ($message) {
        header("Location: " . tep_href_link(BATCH_PRINT_FILE, 'mkey=' . $message));
      } else {
        header("Location: " . tep_href_link(BATCH_PRINT_FILE));
      }
      exit(0);
    }

    function change_color($color) {
      global $pdf;

      list($r,$g,$b) = explode(',', $color);
      $pdf->setColor($r,$g,$b);
    }

    function verify_start_date($startdate) {
      $error = 0;
      list($year,$month,$day) = explode('-', $startdate);

      if ((strlen($year) != 4) || !is_numeric($year)) {
        $error++;
      }
      if ((strlen($month) != 2) || !is_numeric($month)) {
        $error++;
      }
      if ((strlen($day) != 2) || !is_numeric($day)) {
        $error++;
      }
    return $error;
    }


    function verify_end_date($enddate) {
      $error = 0;
      list($year,$month,$day) = explode('-', $enddate);

      if ((strlen($year) != 4) || !is_numeric($year)) {
        $error++;
      }
      if ((strlen($month) != 2) || !is_numeric($month)) {
        $error++;
      }
      if ((strlen($day) != 2) || !is_numeric($day)) {
        $error++;
      }
      return $error;
    }


    function print_address($x, $y, $nums){
    global $pdf, $num, $billing;
    $pos = $y;
    global $orders_query;
    global $order;
    global $orders;
    global $languages_id;
    global $HTTP_POST_VARS;
    if ($order){
      if ($billing == true)
        $addressparts = explode("\n", tep_address_format($order->billing['format_id'], $order->billing, 1, '', " \n"));
      else
        $addressparts = explode("\n", tep_address_format($order->delivery['format_id'], $order->delivery, 1, '', " \n"));
      foreach($addressparts as $addresspart){
        $fontsize = GENERAL_FONT_SIZE;
        while ($pdf->getTextWidth($fontsize, $addresspart) > LABEL_WIDTH){
          $fontsize--;
        }
        //$addresspart = preg_replace("%,[[:space:]]*$%", "", $addresspart);
        $pdf->addText($x,$pos -=GENERAL_LINE_SPACING,$fontsize,$addresspart);
      }
      $pdf->addText($x + LABEL_WIDTH - ORDERIDXOFFSET - 22,$y + ORDERIDYOFFSET,ORDERIDFONTSIZE,$orders['orders_id']);

      if ($HTTP_POST_VARS['status'] && ($HTTP_POST_VARS['status'] != $order->info['orders_status'])){
        $customer_notified = 0; 
        $status = tep_db_prepare_input($HTTP_POST_VARS['status']);
        $notify_comments = sprintf(EMAIL_TEXT_COMMENTS_UPDATE, BATCH_COMMENTS) . "\n\n";

        if ($HTTP_POST_VARS['notify']) {
          $status_query = tep_db_query("select orders_status_name as name from " . TABLE_ORDERS_STATUS . " where language_id = " . $languages_id . " and orders_status_id = " . tep_db_input($status));
          $status_name = tep_db_fetch_array($status_query);

          $email = STORE_NAME . "\n" . EMAIL_SEPARATOR . "\n" . EMAIL_TEXT_ORDER_NUMBER . ' ' . $orders['orders_id'] . "\n" . EMAIL_TEXT_DATE_ORDERED . ' ' . tep_date_long($order->info['date_purchased']) . "\n\n" . $notify_comments . sprintf(EMAIL_TEXT_STATUS_UPDATE, $status_name['name']);
          tep_mail($order->customer['name'], $order->customer['email_address'], EMAIL_TEXT_SUBJECT, nl2br($email), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);
          $customer_notified = '1';
        }

        tep_db_query("update " . TABLE_ORDERS . " set orders_status = '" . tep_db_input($status) . "', last_modified = now() where orders_id = '" . $orders['orders_id'] . "'");
        tep_db_query("insert into " . TABLE_ORDERS_STATUS_HISTORY . " (orders_id, orders_status_id, date_added, customer_notified, comments) 
        values ('" . $orders['orders_id'] . "', '" . tep_db_input($status) . "', now(), '" . $customer_notified . "', '" . $notify_comments  . "')");
      }

      if(($nums % NUM_LABELS_PER_PAGE) == (NUM_LABELS_PER_PAGE-1))
      {
        $order = false;
        return false;
      } else {
        if($orders = tep_db_fetch_array($orders_query)) {
          $order = new order($orders['orders_id']);
          return true;
        } else {
          $order = false;
          return false;
        }
      }

    } else {
      return false;
    }
  }
?>