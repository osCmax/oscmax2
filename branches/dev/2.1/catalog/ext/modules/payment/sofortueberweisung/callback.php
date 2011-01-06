<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  chdir('../../../../');
  require ('includes/application_top.php');

  $order_id = $customer_id = $pw = $betrag_integer = '';

  if (isset($_GET['kunden_var_0'])) {
    $order_id = $_GET['kunden_var_0'];
  } elseif (isset($_POST['kunden_var_0'])) {
    $order_id = $_POST['kunden_var_0'];
  }

  if (isset($_GET['kunden_var_1'])) {
    $customer_id = $_GET['kunden_var_1'];
  } elseif (isset($_POST['kunden_var_1'])) {
    $customer_id = $_POST['kunden_var_1'];
  }

  if (isset($_GET['pw'])) {
    $pw = $_GET['pw'];
  } elseif (isset($_POST['pw'])) {
    $pw = $_POST['pw'];
  }

  if (isset($_GET['betrag_integer'])) {
    $betrag_integer = $_GET['betrag_integer'];
  } elseif (isset($_POST['betrag_integer'])) {
    $betrag_integer = $_POST['betrag_integer'];
  }

  // Check if Order exists
  if (empty($order_id) || empty($customer_id) || empty($pw)) {
    exit();
  }

  $comment = '';

  if ($pw != MODULE_PAYMENT_SOFORTUEBERWEISUNG_DIRECT_BNA_PASSWORT) {
    $comment = 'ungültiges Benachrichtigung Passwort' . "\n";
  }

  // check if order exists
  $order_query = tep_db_query("select * from " . TABLE_ORDERS . " where orders_id = '" . (int)$order_id . "' and customers_id = '" . (int)$customer_id . "'");
  if (tep_db_num_rows($order_query) > 0) {
    $order = tep_db_fetch_array($order_query);

    if ($order['orders_status'] == MODULE_PAYMENT_SOFORTUEBERWEISUNG_DIRECT_PREPARE_ORDER_STATUS_ID) {
      $total_query = tep_db_query("select value from " . TABLE_ORDERS_TOTAL . " where orders_id = '" .  (int)$order_id . "' and class = 'ot_total' limit 1");
      $total = tep_db_fetch_array($total_query);

      $order_total_integer = number_format($total['value'] * $currencies->get_value('EUR'), 2, '.','')*100;
      if ($order_total_integer < 1) {
        $order_total_integer = '000';
      } elseif ($order_total_integer < 10) {
        $order_total_integer = '00' . $order_total_integer;
      } elseif ($order_total_integer < 100) {
        $order_total_integer = '0' . $order_total_integer;
      }

      if ((int)$betrag_integer == (int)$order_total_integer) {
        $comment = 'Zahlung durch Sofortüberweisung Benachrichtigung bestätigt!';
      } else {
        $comment = "Sofortüberweisungs Transaktionscheck fehlgeschlagen. Bitte manuell überprüfen\n" . ($betrag_integer/100) . '!=' . ($order_total_integer/100);
      }

      if (MODULE_PAYMENT_SOFORTUEBERWEISUNG_DIRECT_STORE_TRANSACTION_DETAILS == 'True') {
        $comment .= "\n" . serialize($_GET) . "\n" . serialize($_POST);
      }

      $order_status = (MODULE_PAYMENT_SOFORTUEBERWEISUNG_DIRECT_ORDER_STATUS_ID > 0 ? (int)MODULE_PAYMENT_SOFORTUEBERWEISUNG_DIRECT_ORDER_STATUS_ID : (int)DEFAULT_ORDERS_STATUS_ID);

      $sql_data_array = array('orders_id' => (int)$order_id,
                              'orders_status_id' => $order_status,
                              'date_added' => 'now()',
                              'customer_notified' => '0',
                              'comments' => $comment);

      tep_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array);

      tep_db_query("update " . TABLE_ORDERS . " set orders_status = '" . $order_status . "', last_modified = now() where orders_id = '" . (int)$order_id . "'");
    }
  }
?>
