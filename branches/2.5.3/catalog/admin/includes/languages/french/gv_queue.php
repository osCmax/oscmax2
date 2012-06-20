<?php
/*
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Ch&egrave;ques cadeaux en attente');

define('TABLE_HEADING_CUSTOMERS', 'Clients');
define('TABLE_HEADING_ORDERS_ID', 'Num&eacute;ro de la commande');
define('TABLE_HEADING_VOUCHER_VALUE', 'Valeur du ch&egrave;que');
define('TABLE_HEADING_DATE_PURCHASED', 'Date de l\'achat');
define('TABLE_HEADING_RELEASED', 'Status');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'Vous avez récemment acheté un chèque cadeau dans notre magasin.' . "\n"
                                          . 'Pour des raisons de sécurité il n\'était pas immédiatement disponible sur votre compte.' . "\n"
                                          . 'Cependant le montant a maintenant été enregistré.' . "\n"
                                          . 'Vous pouvez maintenant visiter notre magasin et vous retrouverez ce chèque sur votre compte dans le panier.' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', 'Le montant du chèque cadeau que vous avez acheté est de %s' . "\n\n");

define('TEXT_REDEEM_COUPON_MESSAGE_BODY', '');
define('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', '');
define('TEXT_REDEEM_COUPON_SUBJECT', 'Validation chèque cadeau');
define('TEXT_PAYMENT_CHECK', 'If you are sure that you have received cleared funds for this Gift Voucher then please click redeem to release the voucher from the queue and allow the customer to use it.');
define('TEXT_PAYMENT_CHECK_CONFIRM', 'Are you sure you want to release this Gift Voucher?');
define('TEXT_RELEASED_ALREADY', 'This coupon has already been released from the queue.  <br><br><b>Released: </b>');
define('TEXT_GV_STATUS', 'Pending');

define('HEADING_TITLE_STATUS', 'Status:');
define('TEXT_GV_REDEEMED', 'Redeemed');
define('TEXT_GV_PENDING', 'Pending');
define('TEXT_GV_ALL', 'Show Vouchers');
?>