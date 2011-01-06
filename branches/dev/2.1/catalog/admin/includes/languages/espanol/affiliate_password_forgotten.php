<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Login');
define('NAVBAR_TITLE_2', 'Password forgotten?');
define('HEADING_TITLE', 'What was my password?');
define('TEXT_NO_EMAIL_ADDRESS_FOUND', '<font color="#ff0000"><b>ATTENTION:</b></font> The e-mail address you\'ve entered is not registered. Please try again.');
define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - New Affiliate Password');
define('EMAIL_PASSWORD_REMINDER_BODY', 'We got a new password request from ' . $REMOTE_ADDR . ' for your affiliate account.' . "\n\n" . 'Your new password for your affiliate account at \'' . STORE_NAME . '\' is:' . "\n\n" . '   %s' . "\n\n");
define('TEXT_PASSWORD_SENT', 'A new password has been sent to your registered e-mail account.');
?>