<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

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
    global $_POST;
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

      if ($_POST['status'] && ($_POST['status'] != $order->info['orders_status'])){
        $customer_notified = 0; 
        $status = tep_db_prepare_input($_POST['status']);
        $notify_comments = sprintf(EMAIL_TEXT_COMMENTS_UPDATE, BATCH_COMMENTS) . "\n\n";

        if ($_POST['notify']) {
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