<?php
/*
$Id: gv_redeem.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscmax.com

  Gift Voucher System v1.0
  Copyright 2006 osCMax2001,2002 Ian C Wilson

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Redeem Gift Certificate');
define('HEADING_TITLE', 'Redeem Gift Certificate');
define('TEXT_INFORMATION', 'For more information regarding Gift Certificates, please see our <a href="' . tep_href_link(FILENAME_GV_FAQ,'','NONSSL').'">'.GV_FAQ.'.</a>');
define('TEXT_INVALID_GV', 'The Gift Certificate number may be invalid or has already been redeemed. To contact the shop owner please use the Contact Page');
define('TEXT_VALID_GV', 'Congratulations, you have redeemed a Gift Certificate worth %s');
define('TEXT_NEEDS_TO_LOGIN', 'We are sorry but we are unable to process your Gift Voucher claim at this time. You need to login first or create an account with us, if you don\'t already have one, before you can claim your Gift Voucher. Please <a href="' . tep_href_link(FILENAME_LOGIN,'','SSL').'">click here to login or create an account.</a> ');
?>