<?php
/*
$Id: affiliate_configure.php 3 2006-05-27 04:59:07Z user $

  OSC-Affiliate
  
  Contribution based on:
  
  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

  define ('AFFILIATE_NOTIFY_AFTER_BILLING','true'); // Nofify affiliate if he got a new invoice
  define ('AFFILIATE_DELETE_ORDERS','false');       // Delete affiliate_sales if an order is deleted (Warning: Only not yet billed sales are deleted)

  define ('AFFILIATE_TAX_ID','1');  // Tax Rates used for billing the affiliates 
                                   // you get this from the URl (tID) when you select you Tax Rate at the admin: tax_rates.php?tID=1
// If set, the following actions take place each time you call the admin/affiliate_summary 									
  define ('AFFILIATE_DELETE_CLICKTHROUGHS','false');  // (days / false) To keep the clickthrough report small you can set the days after which they are deleted (when calling affiliate_summary in the admin) 
  define ('AFFILIATE_DELETE_AFFILIATE_BANNER_HISTORY','false');  // (days / false) To keep thethe table AFFILIATE_BANNER_HISTORY small you can set the days after which they are deleted (when calling affiliate_summary in the admin) 
   
?>