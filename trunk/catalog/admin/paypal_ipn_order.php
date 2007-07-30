<?php
/*
$Id: paypal_ipn_order.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

  include(DIR_WS_LANGUAGES.$language.'/paypal_ipn.php');
  include(DIR_WS_CLASSES . 'paypal_ipn.php');
  $ipn = new paypal_ipn($order->info['paypal_ipn_id'],$languages_id);
?>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo HEADING_DEATILS_CUSTOMER_REGISTRATION_TITLE;?></b></td>
          </tr>
          <tr>
            <td class="main">
              <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr valign="top">
                <td>
                      <table border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td class="main"><b><?php echo ENTRY_FIRST_NAME; ?></b></td><td class="main">&nbsp;<?php echo $ipn->customer['first_name'];?></td>
                      </tr>
                      <tr>
                        <td class="main"><b><?php echo ENTRY_LAST_NAME; ?></b></td><td class="main">&nbsp;<?php echo $ipn->customer['last_name'];?></td>
                      </tr>
                      <tr>
                        <td class="main"><b><?php echo ENTRY_BUSINESS_NAME; ?></b></td><td class="main">&nbsp;<?php echo $ipn->customer['payer_business_name'];?></td>
                      </tr>
                      <tr>
                        <td class="main"><b><?php echo ENTRY_ADDRESS_NAME; ?></b></td><td class="main">&nbsp;<?php echo $ipn->customer['address_name'];?></td>
                      </tr>
                      </table>
                </td>

                <td>
                      <table border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td class="main"><b><?php echo ENTRY_ADDRESS_STREET; ?></b></td><td class="main">&nbsp;<?php echo $ipn->customer['address_street'];?></td>
                      </tr>
                      <tr>
                        <td class="main"><b><?php echo ENTRY_ADDRESS_CITY; ?></b></td><td class="main">&nbsp;<?php echo $ipn->customer['address_city'];?></td>
                      </tr>
                      <tr>
                        <td class="main"><b><?php echo ENTRY_ADDRESS_STATE; ?></b></td><td class="main">&nbsp;<?php echo $ipn->customer['address_state'];?></td>
                      </tr>
                      <tr>
                        <td class="main"><b><?php echo ENTRY_ADDRESS_ZIP; ?></b></td><td class="main">&nbsp;<?php echo $ipn->customer['address_zip'];?></td>
                      </tr>
                      <tr>
                        <td class="main"><b><?php echo ENTRY_ADDRESS_COUNTRY; ?></b></td><td class="main">&nbsp;<?php echo $ipn->customer['address_country'];?></td>
                      </tr>
                      </table>
                </td>

                <td>
                      <table border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td class="main"><b><?php echo ENTRY_EMAIL_ADDRESS; ?></b></td><td class="main">&nbsp;<?php echo $ipn->customer['payer_email'];?></td>
                      </tr>
                      <tr>
                        <td class="main"><b><?php echo ENTRY_EBAY_ID; ?></b></td><td class="main">&nbsp;<?php echo $ipn->customer['ebay_address_id'];?></td>
                      </tr>
                      <tr>
                        <td class="main"><b><?php echo ENTRY_PAYER_ID; ?></b></td><td class="main">&nbsp;<?php echo $ipn->customer['payer_id'];?></td>
                      </tr>
                      <tr>
                        <td class="main"><b><?php echo ENTRY_PAYER_STATUS; ?></b></td><td class="main">&nbsp;<?php echo $ipn->customer['payer_status'];?></td>
                      </tr>
                      <tr>
                        <td class="main"><b><?php echo ENTRY_ADDRESS_STATUS; ?></b></td><td class="main">&nbsp;<?php echo $ipn->customer['address_status'];?></td>
                      </tr>
                      </table>
                </td>
              </tr>
              </table>
           </td>
          </tr>
          <tr>
            <td class="main"><b><?php echo HEADING_DETAILS_REGISTRATION_TITLE;?></b> #<?php echo $ipn->info['txn_id'];?></td>
          </tr>
          <tr>
            <td class="main">
              <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr valign="top">
                <td>
                      <table border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td class="main"><b><?php echo ENTRY_PAYMENT_TYPE; ?></b></td><td class="main">&nbsp;<?php echo $ipn->info['payment_type'];?></td>
                      </tr>
                      <tr>
                        <td class="main"><b><?php echo ENTRY_PAYMENT_STATUS; ?></b></td><td class="main">&nbsp;<?php echo $ipn->info['payment_status'];?></td>
                      </tr>
                      <tr>
                        <td class="main"><b><?php echo ENTRY_PENDING_REASON; ?></b></td><td class="main">&nbsp;<?php echo $ipn->info['pending_reason'];?></td>
                      </tr>
                      <tr>
                        <td class="main"><b><?php echo ENTRY_INVOICE; ?></b></td><td class="main">&nbsp;<?php echo $ipn->info['invoice'];?></td>
                      </tr>
                      <tr>
                        <td class="main"><b><?php echo ENTRY_PAYMENT_DATE; ?></b></td><td class="main">&nbsp;<?php echo $ipn->info['payment_date'];?></td>
                      </tr>
                      </table>
                </td>

                <td>
                      <table border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td class="main"><b><?php echo ENTRY_CURRENCY; ?></b></td><td class="main">&nbsp;<?php echo $ipn->info['mc_currency'];?></td>
                      </tr>
                      <tr>
                        <td class="main"><b><?php echo ENTRY_GROSS_AMOUNT; ?></b></td><td class="main">&nbsp;<?php echo $ipn->txn['mc_gross'];?></td>
                      </tr>
                      <tr>
                        <td class="main"><b><?php echo ENTRY_PAYMENT_FEE; ?></b></td><td class="main">&nbsp;<?php echo $ipn->txn['mc_fee'];?></td>
                      </tr>
                      <tr>
                        <td class="main"><b><?php echo ENTRY_EXCHANGE_RATE; ?></b></td><td class="main">&nbsp;<?php echo $ipn->txn['exchange_rate'];?></td>
                      </tr>
                      <tr>
                        <td class="main"><b><?php echo ENTRY_CART_ITEMS; ?></b></td><td class="main">&nbsp;<?php echo $ipn->txn['num_cart_items'];?></td>
                      </tr>
                      </table>
                </td>
                <td>
                      <table border="0" cellspacing="0" cellpadding="2">
                      <tr>
                        <td class="main">&nbsp;<b><?php echo ENTRY_CUSTOMER_COMMENTS; ?></b></td>
                      </tr>
                      <tr>
                        <td class="main">&nbsp;<?php echo nl2br(tep_db_output($ipn->customer['memo']));?></td>
                      </tr>
                      </table>
                </td>
              </tr>
              </table>
           </td>
          </tr>
