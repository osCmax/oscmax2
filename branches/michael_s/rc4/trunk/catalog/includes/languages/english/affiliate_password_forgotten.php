<?php
/*
$Id: affiliate_password_forgotten.php 14 2006-07-28 17:42:07Z user $

  OSC-Affiliate

  Contribution based on:

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Affiliate Password Forgotten');
define('NAVBAR_TITLE_1', 'Login');
define('NAVBAR_TITLE_2', 'Affiliate Password Forgotten');
define('HEADING_TITLE', 'I\'ve Forgotten My Affiliate Password!');
define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<font color="#ff0000"><b>NOTE:</b></font> The E-Mail Address was not found in our records. Please try again.');
define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - New Affiliate Password');
define('EMAIL_PASSWORD_REMINDER_BODY', 'A new affiliate password was requested from ' . $REMOTE_ADDR . '.' . "\n\n" . 'Your new affiliate password to \'' . STORE_NAME . '\' is:' . "\n\n" . '   %s' . "\n\n");
define('TEXT_PASSWORD_SENT', 'A New Affiliate Password Has Been Sent To Your Email Address');
?>