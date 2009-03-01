<?php
/*
$Id: gv_mail.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Gutschein an Kunden versenden');

define('TEXT_CUSTOMER', 'Kunde:');
define('TEXT_SUBJECT', 'Betreff:');
define('TEXT_FROM', 'Absender:');
define('TEXT_TO', 'eMail an:');
define('TEXT_AMOUNT', 'Betrag:');
define('TEXT_MESSAGE', 'Nachricht:');
define('TEXT_SINGLE_EMAIL', '<span class="smallText">Use this for sending single emails, otherwise use dropdown above</span>');
define('TEXT_SELECT_CUSTOMER', 'Kunden ausw&auml;hlen');
define('TEXT_ALL_CUSTOMERS', 'Alle Kunden');
define('TEXT_NEWSLETTER_CUSTOMERS', 'An alle Newsletter-Abonnenten');

define('NOTICE_EMAIL_SENT_TO', 'Hinweis: eMail wurde versendet an: %s');
define('ERROR_NO_CUSTOMER_SELECTED', 'Fehler: Es wurde kein Kunde ausgew&auml;hlt.');
define('ERROR_NO_AMOUNT_SELECTED', 'Fehler: Sie haben keinen Betrag f&uuml;r den Gutschein eingegeben.');

define('TEXT_GV_WORTH', 'Gutscheinwert ');
define('TEXT_TO_REDEEM', 'Um den Gutschein einzulsen, klicken Sie auf den unten stehenden Link. Bitte notieren Sie sich den Gutschein-Code.');
define('TEXT_WHICH_IS', 'welches ist');
define('TEXT_IN_CASE', ' falls Sie Probleme haben.');
define('TEXT_OR_VISIT', 'oder besuchen Sie ');
define('TEXT_ENTER_CODE', ' und geben den Gutschein-Code ein ');

define ('TEXT_REDEEM_COUPON_MESSAGE_HEADER', 'You recently purchasd a Gift Voucher from our site, for security reasons, the amount of the Gift Voucher was not immediatley credited to you. The shop owner has now released this amount.');
define ('TEXT_REDEEM_COUPON_MESSAGE_AMOUNT', "\n\n" . 'The value of the Gift Voucher was %s');
define ('TEXT_REDEEM_COUPON_MESSAGE_BODY', "\n\n" . 'You can now visit our site, login and send the Gift Voucher amount to anyone you want.');
define ('TEXT_REDEEM_COUPON_MESSAGE_FOOTER', "\n\n");
//Added line
define ('TEXT_EMAIL_BUTTON_TEXT', 'The Back Button is Disabled when using the WYSIWYG editor');
?>