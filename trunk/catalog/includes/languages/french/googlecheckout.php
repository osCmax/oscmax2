<?php
/*
$Id: googlecheckout.php 982 2011-01-06 02:53:12Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
/*
  Copyright (C) 2007 Google Inc.
*/

/**
 * Google Checkout v1.5.0
 */

define('MODULE_PAYMENT_GOOGLECHECKOUT_TEXT_TITLE', 'GoogleCheckout');
define('MODULE_PAYMENT_GOOGLECHECKOUT_TEXT_DESCRIPTION', 'GoogleCheckout');
define('MODULE_PAYMENT_GOOGLECHECKOUT_TEXT_OPTION','- Ou encore, utilisez -');
define('GOOGLECHECKOUT_STRING_WARN_USING_SANDBOX','GC est configur&eacute; pour utiliser SANDBOX. Commande sera trait&eacute;e mais non inculp&eacute;s.');
define('GOOGLECHECKOUT_STRING_WARN_NO_MERCHANT_ID_KEY','Id marchands Google Checkout ou Key n\'a pas &eacute;t&eacute; mis en place');
define('GOOGLECHECKOUT_STRING_WARN_VIRTUAL','Certains produits de t&eacute;l&eacute;charger dans votre panier ne sont pas actuellement disponibles via Google Checkout.');
define('GOOGLECHECKOUT_STRING_WARN_EMPTY_CART','Le panier est vide');
define('GOOGLECHECKOUT_STRING_WARN_OUT_OF_STOCK','Certains produits sont Rupture de stock');
define('GOOGLECHECKOUT_STRING_WARN_MULTIPLE_SHIP_TAX','Il existe de multiples options de livraison s&eacute;lectionn&eacute; et ils utilisent diff&eacute;rentes tables d\'impôt exp&eacute;dition ou certains tableaux n\'avez pas la taxe d\'utilisation');
define('GOOGLECHECKOUT_STRING_WARN_MIX_VERSIONS','La version du module install&eacute; dans l\'interface d\'administration est %s et celui de l\'emballage est %s, supprimer / r&eacute;installer le module');
define('GOOGLECHECKOUT_STRING_WARN_WRONG_SHIPPING_CONFIG', 'DIR_FS_CATALOG and DIR_WS_MODULES may be wrong configured in includes/configure.php file. This dir doens\'t exists: %s');
define('GOOGLECHECKOUT_STRING_WARN_RESTRICTED_CATEGORY', 'Some items are in GC restricted category.');

// This string will be added after the product name and description in the yellow box in the GC confirmation page for all Digital Goods.
define('GOOGLECHECKOUT_STRING_EXTRA_DIGITAL_CONTENT', 'Allow 2-5 minutes to get all the transaction processed.');
  
define('GOOGLECHECKOUT_STRING_ERR_SHIPPING_CONFIG', ' Error: Shipping Methods not configured ');
    
define ('GOOGLECHECKOUT_FLAT_RATE_SHIPPING', 'Flat Rate Per Order');
define ('GOOGLECHECKOUT_ITEM_RATE_SHIPPING', 'Flat Rate Per Item');
define ('GOOGLECHECKOUT_TABLE_RATE_SHIPPING', 'Vary by Weight/Price');

define ('GOOGLECHECKOUT_TABLE_NO_MERCHANT_CALCULATION', 'No merchant calculation shipping selected');
define ('GOOGLECHECKOUT_MERCHANT_CALCULATION_NOT_CONFIGURED', ' not configured!<br />');

define ('GOOGLECHECKOUT_ERR_REGULAR_CHECKOUT', 'Google Checkout Can not be used in regular checkout, click in the Google Checkout Button Below');

define ('GOOGLECHECKOUT_ERR_DUPLICATED_ORDER', 'Duplicated NewOrderNotification #%s Cart order #%s');
  
// Google Request Success messages
define('GOOGLECHECKOUT_SUCCESS_SEND_CHARGE_ORDER', 'Sent Google Charge Order Command');
define('GOOGLECHECKOUT_SUCCESS_SEND_PROCESS_ORDER', 'Sent Google Process Order Command');
define('GOOGLECHECKOUT_SUCCESS_SEND_DELIVER_ORDER', 'Sent Google Deliver Order Command');
define('GOOGLECHECKOUT_SUCCESS_SEND_ARCHIVE_ORDER', 'Sent Google Archive Order Command');
define('GOOGLECHECKOUT_SUCCESS_SEND_REFUND_ORDER', 'Sent Google Full Refund Order Command');
define('GOOGLECHECKOUT_SUCCESS_SEND_CANCEL_ORDER', 'Sent Google Cancel Order Command');
define('GOOGLECHECKOUT_SUCCESS_SEND_MESSAGE_ORDER', 'Sent Google Message to the Buyer');
define('GOOGLECHECKOUT_SUCCESS_SEND_NEW_USER_CREDENTIALS', 'Sent New Buyer Credentials to the Buyer');
  
define('GOOGLECHECKOUT_SUCCESS_SEND_MERCHANT_ORDER_NUMBER', 'Sent Merchant Order Number');
define('GOOGLECHECKOUT_SUCCESS_SEND_ADMIN_COPY_EMAIL', 'Sent Status Change Message to Admin email');

// Google Request warning Messages
define('GOOGLECHECKOUT_WARNING_CHUNK_MESSAGE', 'Google Message was longer than %s, it was chunked when sent to the buyer.');
define('GOOGLECHECKOUT_WARNING_SYSTEM_EMAIL_SENT', 'A regular email was sent to the buyer with the full message');

// Google Request Error Messages
define('GOOGLECHECKOUT_ERR_SEND_CHARGE_ORDER', 'Error sending Google Charge Order, see error logs');
define('GOOGLECHECKOUT_ERR_SEND_PROCESS_ORDER', 'Error sending Google Process Order, see error logs');
define('GOOGLECHECKOUT_ERR_SEND_DELIVER_ORDER', 'Error sending Google Deliver Order, see error logs');
define('GOOGLECHECKOUT_ERR_SEND_ARCHIVE_ORDER', 'Error sending Google Archive Order, see error logs');
define('GOOGLECHECKOUT_ERR_SEND_REFUND_ORDER', 'Error sending Google Refund Order, see error logs');
define('GOOGLECHECKOUT_ERR_SEND_CANCEL_ORDER', 'Error sending Google Cancel Order, see error logs');
define('GOOGLECHECKOUT_ERR_SEND_MESSAGE_ORDER', 'Error sending Google Message, see error logs');
define('GOOGLECHECKOUT_ERR_SEND_NEW_USER_CREDENTIALS', 'Error sending New Buyer Credentials, see error logs');
define('GOOGLECHECKOUT_ERR_SEND_MERCHANT_ORDER_NUMBER', 'Error sending Merchant Order Number, see error logs');
define('GOOGLECHECKOUT_ERR_INVALID_STATE_TRANSITION', 'Invalid Google Checkout State transition: %s => %s, revert to %s and try again. See README');
  
// Remember max chars in 255, included that store name, email and pass that will replace the %s
define('GOOGLECHECKOUT_NEW_CREDENTIALS_MESSAGE', 'These are your Credentials to log into %s site. User: %s Pass: %s Please change your password after logging in - Change it in "MyAccount" area.');

// Coupons
define('GOOGLECHECKOUT_COUPON_ERR_ONE_COUPON', 'Sorry, only one coupon per order');
define('GOOGLECHECKOUT_COUPON_ERR_MIN_PURCHASE', 'Sorry, the minimum purchase hasn\'t been reached to use this coupon');

define('GOOGLECHECKOUT_COUPON_DISCOUNT', 'Discount Coupon: ');
define('GOOGLECHECKOUT_COUPON_FREESHIP', 'Free Shipping Coupon: ');

// New Orders
define('GOOGLECHECKOUT_STATE_NEW_ORDER_NUM', 'Google Checkout Order No: ');
define('GOOGLECHECKOUT_STATE_NEW_ORDER_MC_USED', 'Merchant Calculations used: ');
define('GOOGLECHECKOUT_STATE_NEW_ORDER_BUYER_USER', 'NEW Buyer\'s User: ');
define('GOOGLECHECKOUT_STATE_NEW_ORDER_BUYER_PASS', 'Buyer\'s Password: ');

// States
define('GOOGLECHECKOUT_STATE_STRING_TIME', 'Time: ');
define('GOOGLECHECKOUT_STATE_STRING_NEW_STATE', 'New State: ');

define('GOOGLECHECKOUT_STATE_STRING_ORDER_READY_CHARGE', 'Order ready to be charged!');
define('GOOGLECHECKOUT_STATE_STRING_PAYMENT_DECLINED', 'Payment was declined!');
define('GOOGLECHECKOUT_STATE_STRING_ORDER_CANCELED', 'Order was canceled.');
define('GOOGLECHECKOUT_STATE_STRING_ORDER_CANCELED_REASON', 'Reason: ');
define('GOOGLECHECKOUT_STATE_STRING_ORDER_CANCELED_BY_GOOG', 'Order was canceled by Google.');
define('GOOGLECHECKOUT_STATE_STRING_ORDER_DELIVERED', 'Order was Shipped.');

define('GOOGLECHECKOUT_STATE_STRING_TRACKING', 'Shipping Tracking Data: ');
define('GOOGLECHECKOUT_STATE_STRING_TRACKING_CARRIER', 'Carrier: ');
define('GOOGLECHECKOUT_STATE_STRING_TRACKING_NUMBER', 'Tracking Number: ');

define('GOOGLECHECKOUT_STATE_STRING_LATEST_CHARGE', 'Latest charge amount: ');
define('GOOGLECHECKOUT_STATE_STRING_TOTAL_CHARGE', 'Total charge amount: ');

define('GOOGLECHECKOUT_STATE_STRING_LATEST_REFUND', 'Latest refund amount: ');
define('GOOGLECHECKOUT_STATE_STRING_TOTAL_REFUND', 'Total Order refund amount: ');
define('GOOGLECHECKOUT_STATE_STRING_GOOGLE_REFUND', 'Google Refund: ');
define('GOOGLECHECKOUT_STATE_STRING_NET_REVENUE', 'Net revenue: ');

define('GOOGLECHECKOUT_STATE_STRING_RISK_INFO', 'Risk Information: ');
define('GOOGLECHECKOUT_STATE_STRING_RISK_ELEGIBLE', ' Elegible for Protection: ');
define('GOOGLECHECKOUT_STATE_STRING_RISK_AVS', ' Avs Response: ');
define('GOOGLECHECKOUT_STATE_STRING_RISK_CVN', ' Cvn Response: ');
define('GOOGLECHECKOUT_STATE_STRING_RISK_CC_NUM', ' Partial CC number: ');
define('GOOGLECHECKOUT_STATE_STRING_RISK_ACC_AGE', ' Buyer account age: ');

// Custom GC order states names  
define('GOOGLECHECKOUT_CUSTOM_ORDER_STATE_NEW', 'Google New');
define('GOOGLECHECKOUT_CUSTOM_ORDER_STATE_PROCESSING', 'Google Processing');
define('GOOGLECHECKOUT_CUSTOM_ORDER_STATE_SHIPPED', 'Google Shipped');
define('GOOGLECHECKOUT_CUSTOM_ORDER_STATE_REFUNDED', 'Google Refunded');
define('GOOGLECHECKOUT_CUSTOM_ORDER_STATE_SHIPPED_REFUNDED', 'Google Shipped and Refunded');
define('GOOGLECHECKOUT_CUSTOM_ORDER_STATE_CANCELED', 'Google Canceled');

?>