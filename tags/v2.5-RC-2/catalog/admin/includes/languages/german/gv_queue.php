<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Geschenkgutschein Freigabe Queue');

define('TABLE_HEADING_CUSTOMERS', 'Kunde');
define('TABLE_HEADING_ORDERS_ID', 'Bestell-Nr.');
define('TABLE_HEADING_VOUCHER_VALUE', 'Gutscheinwert');
define('TABLE_HEADING_DATE_PURCHASED', 'Bestelldatum');
define('TABLE_HEADING_RELEASED', 'Status');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Sie haben kürzlich einen Gutschein in unserem Webshop bestellt.' . "\n"
                                          . 'Aus Sicherheitsgründen war dieser Gutschein nicht sofort verfügbar.' . "\n"
                                          . 'Nun wurde der Gutschein freigegeben und Sie können nun unseren Webshop besuchen' . "\n"
                                          . 'und den Gutschein per E-Mail an einen Empfänger Ihrer Wahl versenden' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', 'Der von Ihnen bestellte Geschenkgutschein hat einen Wert von %s' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_BODY', '');
define('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', '');
define('TEXT_REDEEM_COUPON_SUBJECT', 'Geschenkgutschein kaufen');
define('TEXT_PAYMENT_CHECK', 'Wenn Sie sicher sind, dass der Geschenkgutschein bezahlt worden ist, klicken Sie auf Einlösen, um den Gutschein zur Verwendung durch den Kunden freizugeben.');
define('TEXT_PAYMENT_CHECK_CONFIRM', 'Sind Sie sicher, dass Sie diesen Geschenkgutschein freigeben möchten?');
define('TEXT_RELEASED_ALREADY', 'Dieser Gutschein wurde bereits freigegeben.  <br><br><b>Released: </b>');
define('TEXT_GV_STATUS', 'Pending');

define('HEADING_TITLE_STATUS', 'Status:');
define('TEXT_GV_REDEEMED', 'Eingelöst');
define('TEXT_GV_PENDING', 'Nicht eingelöst');
define('TEXT_GV_ALL', 'Gutscheine anzeigen');
?>