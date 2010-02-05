<?php
/*
  $Id: affiliate_password_forgotten.php,v 1.2.2.1 2005/06/12 00:03:45 Michael Sasek Exp $

  OSC-Affiliate

  Contribution based on:

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright (c) 2002 - 2003 osCommerce

  Released under the GNU General Public License
*/
define('NAVBAR_TITLE', 'Affiliate Password Forgotten');
define('NAVBAR_TITLE_1', 'Login');
define('NAVBAR_TITLE_2', 'Affiliate Password Forgotten');
define('HEADING_TITLE', 'Forgotten Affiliate password?');
define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<font color="#ff0000"><b>NOTE:</b></font> The E-Mail Address was not found in our records. Please try again.');
define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - New Affiliate Password');
define('EMAIL_PASSWORD_REMINDER_BODY', 'A new affiliate password was requested from ' . $REMOTE_ADDR . '.' . "\n\n" . 'Your new affiliate password to \'' . STORE_NAME . '\' is:' . "\n\n" . '   %s' . "\n\n");
define('TEXT_PASSWORD_SENT', 'A New Affiliate Password Has Been Sent To Your Email Address');
?>