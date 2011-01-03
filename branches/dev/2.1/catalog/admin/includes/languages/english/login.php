<?php
/*
$Id: login.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2008 osCMax

  Released under the GNU General Public License
*/

define('TEXT_CREATE_FIRST_ADMINISTRATOR', 'No administrators exist in the database table. Please fill in the following information to create the first administrator. (A manual login is still required after this step)');

define('ERROR_INVALID_ADMINISTRATOR', 'Error: Invalid administrator login attempt.');

define('BUTTON_LOGIN', 'Login');
define('BUTTON_CREATE_ADMINISTRATOR', 'Create Administrator');
define('NAVBAR_TITLE', 'Login');
define('HEADING_TITLE', 'Admin Login');
define('TEXT_STEP_BY_STEP', ''); // should be empty
define('HEADING_RETURNING_ADMIN', 'Login Panel:');
define('HEADING_PASSWORD_FORGOTTEN', 'Password Forgotten:');
define('TEXT_RETURNING_ADMIN', 'Staff only!');
define('ENTRY_USERNAME', 'Username:');
define('ENTRY_FIRSTNAME', 'First Name:');
define('ENTRY_LASTNAME', 'Last Name:');

define('TEXT_PASSWORD_FORGOTTEN', 'Password forgotten?');

define('TEXT_LOGIN_ERROR', '<font color="#ff0000"><b>ERROR:</b></font> Wrong username or password!');
define('TEXT_FORGOTTEN_ERROR', '<font color="#ff0000"><b>ERROR:</b></font> first name and password not match!');
define('TEXT_FORGOTTEN_FAIL', 'You have try over 3 times. For security reason, please contact your Web Administrator to get new password.<br>&nbsp;<br>&nbsp;');
define('TEXT_FORGOTTEN_SUCCESS', 'The new password have sent to your email address. Please check your email and click back to login.<br>&nbsp;<br>&nbsp;');

define('ADMIN_EMAIL_SUBJECT', 'New Password');
define('ADMIN_EMAIL_TEXT', 'Hi %s,' . "\n\n" . 'You can access the admin panel with the following password. Once you access the admin, please change your password!' . "\n\n" . 'Website : %s' . "\n" . 'Username: %s' . "\n" . 'Password: %s' . "\n\n" . 'Thanks!' . "\n" . '%s' . "\n\n" . 'This is an automated response, please do not reply!');

define('IMAGE_BUTTON_LOGIN', 'Login');
?>