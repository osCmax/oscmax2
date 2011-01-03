<?php
/*
$Id: ot_coupon.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_ORDER_TOTAL_COUPON_TITLE', 'Discount Coupons');
  define('MODULE_ORDER_TOTAL_COUPON_HEADER', 'Gift Vouchers/Discount Coupons');
  define('MODULE_ORDER_TOTAL_COUPON_DESCRIPTION', 'Discount Coupon');
  define('SHIPPING_NOT_INCLUDED', ' [Shipping not included]');
  define('TAX_NOT_INCLUDED', ' [Tax not included]');
  define('MODULE_ORDER_TOTAL_COUPON_USER_PROMPT', '');
  define('ERROR_NO_INVALID_REDEEM_COUPON', 'Invalid Coupon Code');
// ccgv coupon restrictions error fix
// define('ERROR_REDEEMED_AMOUNT_ZERO', 'a valid coupon number. HOWEVER: No reduction will be applied, please see the coupon restrictions that was sent within your offer email**');
  define('ERROR_REDEEMED_AMOUNT_ZERO', 'This is a valid coupon code. However, no price reduction can be applied, please see the coupon restrictions that were sent with your email offer.');
  define('ERROR_INVALID_STARTDATE_COUPON', 'This coupon is not available yet');
  define('ERROR_INVALID_FINISDATE_COUPON', 'This coupon has expired');
  define('ERROR_INVALID_USES_COUPON', 'This coupon could only be used ');  
  define('TIMES', ' times.');
  define('ERROR_INVALID_USES_USER_COUPON', 'You have used the coupon the maximum number of times allowed per customer.'); 
  define('REDEEMED_COUPON', 'a coupon worth ');  
  define('REDEEMED_MIN_ORDER', 'on orders over ');  
  define('REDEEMED_RESTRICTIONS', ' [Product-Category restrictions apply]');  
  define('TEXT_ENTER_COUPON_CODE', 'Enter Redeem Code&nbsp;&nbsp;');
  define('MODULE_ORDER_TOTAL_COUPON_TEXT_ERROR', 'Redeemed Coupon');
?>
