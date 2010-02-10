<?php
/*
$Id: logoff.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGOFF);

  $breadcrumb->add(NAVBAR_TITLE);
  // PWA BOF 2b
  if (tep_session_is_registered('customer_is_guest')){
    //delete the temporary account
    tep_db_query("delete from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
  }
  // PWA EOF 2b

  tep_session_unregister('customer_id');
  tep_session_unregister('customer_default_address_id');
  tep_session_unregister('customer_first_name');
// BOF: MOD - Separate Pricing per Customer
  tep_session_unregister('sppc_customer_group_id');
  tep_session_unregister('sppc_customer_group_show_tax');
  tep_session_unregister('sppc_customer_group_tax_exempt');
// EOF: MOD - Separate Pricing per Customer
  tep_session_unregister('customer_country_id');
  tep_session_unregister('customer_zone_id');
  tep_session_unregister('comments');
// PWA BOF
  tep_session_unregister('customer_is_guest');
// PWA EOF
// BOF - MOD: CREDIT CLASS Gift Voucher Contribution
  tep_session_unregister('gv_id');
  tep_session_unregister('cot_gv');
  tep_session_unregister('cc_id');
// EOF - MOD: CREDIT CLASS Gift Voucher Contribution

  $cart->reset();
  
// BOF: MOD - Wishlist 3.5
   $wishList->reset();  
// EOF: MOD - Wishlist 3.5
  $content = CONTENT_LOGOFF;

  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>