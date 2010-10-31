<?php
/*
$Id: affiliate_signup.php 14 2006-07-28 17:42:07Z user $

  OSC-Affiliate

  Contribution based on:

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Affiliate Program');
define('HEADING_TITLE', 'Affiliate Program - Sign Up');

define('MAIL_AFFILIATE_SUBJECT', 'Welcome to ' . STORE_NAME . ' Affiliate Program');
define('MAIL_GREET_NONE', 'Dear %s' . "\n\n");//em001
define('MAIL_AFFILIATE_HEADER', 'Thank you for joining <b>' . STORE_NAME . '</b> Affiliate Program' . "\n\n" .'Your Account Information:
**********************************************'."\n\n");
define('MAIL_AFFILIATE_ID', 'Your Affiliate ID is: %s' . "\n");
define('MAIL_AFFILIATE_USERNAME', 'Your Affiliate Username is: %s' . "\n");
define('MAIL_AFFILIATE_PASSWORD', 'Your Password is: %s' . "\n");
define('MAIL_AFFILIATE_LINK', 'Link to your account: %s');
define('MAIL_AFFILIATE_FOOTER', 'Have fun earning referral fees!'."\n\n".'Your <b>' . STORE_NAME . '</b> Affiliate Team' . "\n" . AFFILIATE_EMAIL_ADDRESS);
?>