<?php
/*
$Id: paypal_ipn.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

  class paypal_ipn {
    var $info, $txn, $customer;

    function paypal_ipn($paypal_ipn_id,$languages_ids_id) {
      $this->info = array();
      $this->txn = array();
      $this->customer = array();
      $this->query($paypal_ipn_id,$languages_ids_id);
    }

    function query($paypal_ipn_id,$languages_id) {
      $ipn_query = tep_db_query("select * from " . TABLE_PAYPAL_IPN . " where paypal_ipn_id = '" . (int)$paypal_ipn_id . "'");
      $ipn = tep_db_fetch_array($ipn_query);
      $this->info = array(
        'txn_type'            => $this->get_name('txn_type_name','txn_type_id',$ipn['txn_type'],$languages_id,TABLE_PAYPAL_IPN_TXN_TYPE),
        'reason_code'         => $this->get_name('reason_code_name','reason_code_id',$ipn['reason_code'],$languages_id,TABLE_PAYPAL_IPN_REASON_CODE),
        'payment_type'        => $this->get_name('payment_type_name','payment_type_id',$ipn['payment_type'],$languages_id,TABLE_PAYPAL_IPN_PAYMENT_TYPE),
        'payment_status'      => $this->get_name('payment_status_name','payment_status_id',$ipn['payment_status'],$languages_id,TABLE_PAYPAL_IPN_PAYMENT_STATUS),
        'pending_reason'      => $this->get_name('pending_reason_name','pending_reason_id',$ipn['pending_reason'],$languages_id,TABLE_PAYPAL_IPN_PAYMENT_PENDING_REASON),
        'invoice'             => $ipn['invoice'],
        'mc_currency'         => $this->get_name('mc_currency_name','mc_currency_id',$ipn['mc_currency'],$languages_id,TABLE_PAYPAL_IPN_MC_CURRENCY),
        'payment_date'        => $ipn['payment_date'],
        'business'            => $ipn['business'],
        'receiver_email'      => $ipn['receiver_email'],
        'receiver_id'         => $ipn['receiver_id'],
        'paypal_address_id'   => $ipn['papal_address_id'],
        'txn_id'              => $ipn['txn_id'],
        'notify_version'      => $ipn['notify_version'],
        'verify_sign'         => $ipn['verify_sign'],
        'date_added'          => $ipn['date_added']);

      $ipn_query = tep_db_query("select * from " . TABLE_PAYPAL_IPN_ORDERS . " where paypal_ipn_id = '" . (int)$paypal_ipn_id . "'");
      $ipn_orders = tep_db_fetch_array($ipn_query);

      $ipn_query = tep_db_query("select * from " . TABLE_PAYPAL_IPN_ORDERS_MEMO . " where paypal_ipn_id = '" . (int)$paypal_ipn_id . "'");
      $ipn_memo = tep_db_fetch_array($ipn_query);

      $this->txn = array(
        'num_cart_items'      => $ipn_orders['num_cart_items'],
        'mc_gross'            => $ipn_orders['mc_gross'],
        'mc_fee'              => $ipn_orders['mc_fee'],
        'payment_gross'       => $ipn_orders['payment_gross'],
        'payment_fee'         => $ipn_orders['payment_fee'],
        'settle_amount'       => $ipn_orders['settle_amount'],
        'settle_currency'     => $ipn_orders['settle_currency'],
        'exchange_rate'       => $ipn_orders['exchange_rate']);

      $this->customer = array('first_name'          => $ipn['first_name'],
                              'last_name'           => $ipn['last_name'],
                              'payer_business_name' => $ipn['payer_business_name'],
                              'address_name'        => $ipn['address_name'],
                              'address_street'      => $ipn['address_street'],
                              'address_city'        => $ipn['address_city'],
                              'address_state'       => $ipn['address_state'],
                              'address_zip'         => $ipn['address_zip'],
                              'address_country'     => $ipn['address_country'],
                              'address_status'      => $this->get_name('address_status_name','address_status_id',$ipn['address_status'],$languages_id,TABLE_PAYPAL_IPN_PAYMENT_ADDRESS_STATUS),
                              'address_owner'       => $ipn['address_owner'],
                              'payer_email'         => $ipn['payer_email'],
                              'ebay_address_id'     => $ipn['ebay_address_id'],
                              'payer_id'            => $ipn['payer_id'],
                              'payer_status'        => $ipn['payer_status'],
                              'memo'                => $ipn_memo['memo']);
    }

  function get_name($column_name,$column_id,$column_value,$languages_id,$table_name) {
    $sql_query = tep_db_query("select ".$column_name." from " . $table_name . " where ".$column_id." = '" . (int)$column_value . " and language_id=".$languages_id."'");
    if (!tep_db_num_rows($sql_query)) {
      return '';
    } else {
      $result = tep_db_fetch_array($sql_query);
      return $result[$column_name];
    }
  }

  }//end class
?>
