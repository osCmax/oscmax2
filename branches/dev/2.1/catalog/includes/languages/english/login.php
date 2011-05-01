<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// PWA BOF
define('TEXT_GUEST_INTRODUCTION', '<b>Do you want to go straight to the checkout process?</b><br><br>Would you like to check out without creating a customer account? Please note that all of our services will not be available to customers that do not wish to create an account. Also, you cannot view the status of your order, and each time you shop with us you will have to re-enter all of your data.<br><br>Creating an account is free. If you still wish to continue to checkout please click the checkout button to your right.');
// PWA BOF
define('NAVBAR_TITLE', 'Login');
define('HEADING_TITLE', 'Welcome, Please Sign In');

define('HEADING_NEW_CUSTOMER', 'New Customer');
define('TEXT_NEW_CUSTOMER', 'I am a new customer.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'By creating an account at ' . STORE_NAME . ' you will be able to shop faster, be up to date on an orders status, and keep track of the orders you have previously made.');

define('HEADING_RETURNING_CUSTOMER', 'Returning Customer');
define('TEXT_RETURNING_CUSTOMER', 'I am a returning customer.');

define('TEXT_PASSWORD_FORGOTTEN', 'Password forgotten? Click here.');

define('TEXT_LOGIN_ERROR', 'Error: No match for E-Mail Address and/or Password.');
define('TEXT_VISITORS_CART', '<font color="#ff0000"><b>Note:</b></font> The contents of your cart will remain after you have logged in.');

// LINE ADDED: MOD - Separate Pricing Per Customer
// define the email address that can change customer_group_id on login
define('SPPC_TOGGLE_LOGIN_PASSWORD', 'root@localhost');
define('PWA_FAIL_ACCOUNT_EXISTS','An account already exists for the email address {EMAIL_ADDRESS}. You must login here with the password for that account before proceeding to checkout.');

define('HEADING_CHECKOUT','<font size="2">Proceed Directly to Checkout</font>');

define('TEXT_CHECKOUT_INTRODUCTION','Proceed to Checkout without creating an account. By choosing this option none of your user information will be kept in our records, and you will not be able to review your order status, nor keep track of your previous orders.');

define('PROCEED_TO_CHECKOUT','Proceed to Checkout without Registering');

define('TEXT_GV_LOGIN_NEEDED', 'You need to be logged in to redeem your voucher.  Please create a new account or login below.');
define('TEXT_REVIEW_LOGIN_NEEDED', 'You need to be logged in to write a review.  Please create a new account or login below.');

?>