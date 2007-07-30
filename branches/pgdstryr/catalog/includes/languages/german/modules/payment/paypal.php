<?php
/*
$Id: paypal.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_PAYPAL_TEXT_TITLE', 'PayPal');
  define('MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION', 'PayPal');
// BOF: MOD - PayPal_Shopping_Cart_IPN
  define('MODULE_PAYMENT_PAYPAL_CUSTOMER_COMMENTS', 'Add Comments About Your Order');
//begin DEBUG Text
  define('UNKNOWN_TXN_TYPE', 'Unknown Transaction Type');
  define('UNKNOWN_TXN_TYPE_MSG', 'An unknown transaction (%s) occurred from ' . $_SERVER['REMOTE_ADDR'] . "\nAre you running any tests?\n\n");
  define('UNKNOWN_POST', 'Unknown Post');
  define('UNKNOWN_POST_MSG', "An unknown POST from %s was received.\nAre you running any tests?\n\n");
  define('EMAIL_SEPARATOR', "------------------------------------------------------");
  define('HTTP_ERROR', 'HTTP Error');
  define('HTTP_ERROR_MSG', "An HTTP Error occured during authentication\n".EMAIL_SEPARATOR."\ncurl= %s, socket= %s, domain= %s, port= %s\n\n");
  define('RESPONSE_VERIFIED', 'Verified');
  define('RESPONSE_INVALID', 'Invalid');
  define('RESPONSE_UNKNOWN', 'Unknown Verfication');
  define('RESPONSE_MSG', "Connection Type\n".EMAIL_SEPARATOR."\ncurl= %s, socket= %s, domain= %s, port= %s \n\nPayPal Response\n".EMAIL_SEPARATOR."\n%s \n\n");
  define('EMAIL_RECEIVER', 'Email and Business ID config');
  define('EMAIL_RECEIVER_MSG', STORE_NAME."\nPrimary PayPal Email Address: %s\nBusiness ID: %s\n".EMAIL_SEPARATOR."\nPrimary PayPal Email Address: %s\nBusiness ID: %s\n\n");
  define('EMAIL_RECEIVER_ERROR_MSG', STORE_NAME."\nPrimary PayPal Email Address: %s\nBusiness ID: %s\n".EMAIL_SEPARATOR."\nPrimary PayPal Email Address: %s\nBusiness ID: %s\n\nPayPal Transaction ID: %s\n\n");
  define('TXN_DUPLICATE', 'Duplicate Transaction');
  define('TXN_DUPLICATE_MSG', "A duplicate IPN transaction (%s) has been received.\nPlease check your PayPal Account\n\n");
  define('DEBUG', 'Debug');
  define('DEBUG_MSG', EMAIL_SEPARATOR."\nPayPal ORIGINAL POST\n".EMAIL_SEPARATOR."\n%s\n\n".EMAIL_SEPARATOR."\nPayPal Reconstructed Post\n".EMAIL_SEPARATOR."\n%s\n\n");
  define('PAYMENT_CART_DESCRIPTION', 'Cart - Web Accept');
  define('PAYMENT_CART_DESCRIPTION_MSG', "You have received a payment of %s %s\n".EMAIL_SEPARATOR."\nThis payment was sent by customer %s %s via the osCommerce / PayPal Shopping Cart\n\n");
  define('PAYMENT_CART_DESCRIPTION_ERROR_MSG', "COULD NOT PROCESS: You have received a payment of %s %s\n".EMAIL_SEPARATOR."\nThis payment was sent by customer %s %s via the osCommerce / PayPal Shopping Cart\n\n");
  define('PAYMENT_SEND_MONEY_DESCRIPTION', 'Money Received');
  define('PAYMENT_SEND_MONEY_DESCRIPTION_MSG', "You have received a payment of %s %s \n".EMAIL_SEPARATOR."\nThis payment was sent by someone from the PayPal website, using the Send Money tab\n\n");
  define('PAYMENT_REVERSAL_DESCRIPTION', 'Reversal');
  define('PAYMENT_REVERSAL_DESCRIPTION_MSG', "A payment of %s %s has been reversed.\n".EMAIL_SEPARATOR."\nThis means the transaction was reversed. If payment_status is Completed, ".
    "then a reversal to a transaction has occurred, and money has been transferred from your ".
    "account back to the customer. If it is  Canceled, then a previous reversal has been reversed, ".
    "and the money has been returned to your account.\n\n");
  define('PAYMENT_UNKNOWN_DESCRIPTION', 'Unknown');
  define('PAYMENT_UNKNOWN_DESCRIPTION_MSG', "A transaction may have occured please check your PayPal Account\n\n");
  define('CHECK_NUM_CART_CONTENTS', 'Validate No Of Items In Cart');
  define('CHECK_NUM_CART_CONTENTS_MSG', "Incorrect Cart Contents\nPayPal: %s\nSession: %s\n\n");
  define('CHECK_CURRENCY', 'Validate No Of Items In Cart');
  define('CHECK_CURRENCY_MSG', "Incorrect Currency\nPayPal: %s\nSession: %s\n\n");
  define('CHECK_CURRENCY', 'Validate Currency');
  define('CHECK_CURRENCY_MSG', "Incorrect Currency\nPayPal: %s\nSession: %s\n\n");
  define('CHECK_TOTAL', 'Validate Total Transaction Amount');
  define('CHECK_TOTAL_MSG', "Incorrect Total\nPayPal: %s\nSession: %s\n\n");
  define('IPN_TXN_INSERT', "IPN INSERTED");
  define('IPN_TXN_INSERT_MSG', "IPN %s has been inserted\n\n");
//end DEBUG Text
//EOF: MOD - PayPal_Shopping_Cart_IPN
?>
