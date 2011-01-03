<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Gift Voucher System v1.0
  Copyright 2000 - 2011 osCmax
  http://www.phesis.org

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Purchased Gift Voucher Release Queue');

define('TABLE_HEADING_CUSTOMERS', 'Customers');
define('TABLE_HEADING_ORDERS_ID', 'Order-No.');
define('TABLE_HEADING_VOUCHER_VALUE', 'Voucher Value');
define('TABLE_HEADING_DATE_PURCHASED', 'Date Purchased');
define('TABLE_HEADING_RELEASED', 'Status');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'You recently purchased a Gift Voucher from our online store.' . "\n"
                                          . 'For security reasons this was not made immediately available to you.' . "\n"
                                          . 'However this amount has now been released. You can now visit our store' . "\n"
                                          . 'and send the value via email to someone else' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', 'The Gift Voucher(s) you purchased are worth %s' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_BODY', '');
define('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', '');
define('TEXT_REDEEM_COUPON_SUBJECT', 'Gift Voucher Purchase');
define('TEXT_PAYMENT_CHECK', 'If you are sure that you have received cleared funds for this Gift Voucher then please click redeem to release the voucher from the queue and allow the customer to use it.');
define('TEXT_PAYMENT_CHECK_CONFIRM', 'Are you sure you want to release this Gift Voucher?');
define('TEXT_RELEASED_ALREADY', 'This coupon has already been released from the queue.  <br><br><b>Released: </b>');
define('TEXT_GV_STATUS', 'Pending');

define('HEADING_TITLE_STATUS', 'Status:');
define('TEXT_GV_REDEEMED', 'Redeemed');
define('TEXT_GV_PENDING', 'Pending');
define('TEXT_GV_ALL', 'Show Vouchers');
?>