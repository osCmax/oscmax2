<?php
/*
$Id: wishlist.php 3 2006-05-27 04:59:07Z user $
  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');

  if (!tep_session_is_registered('customer_id')) {
  $SESSION_WISHLIST = $HTTP_POST_VARS['products_id'];
  tep_session_register('SESSION_WISHLIST');
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
  //ADDED FOR WHEN USERS ARE NOT LOGGED IN TO KEEP THE PRODUCT_ID

  if(tep_session_is_registered('SESSION_WISHLIST')) {
   // Queries below replace old product instead of adding to quantity.
   tep_db_query("delete from " . TABLE_WISHLIST . " where products_id = '" . $SESSION_WISHLIST . "' and customers_id = '" . $customer_id . "'");
   tep_db_query("insert into " . TABLE_WISHLIST . " (customers_id, products_id, products_model, products_name, products_price) values ('" . $customer_id . "', '" . $SESSION_WISHLIST . "', '" . $products_model . "', '" . $products_name . "', '" . $products_price . "' )");
   tep_db_query("delete from " . TABLE_WISHLIST_ATTRIBUTES . " where products_id = '" . $SESSION_WISHLIST . "' and customers_id = '" . $customer_id . "'");
   // Read array of options and values for attributes in id[]
    if (isset ($id)) {
    foreach($id as $att_option=>$att_value) {
    // Add to customers_wishlist_attributes table
    tep_db_query("insert into " . TABLE_WISHLIST_ATTRIBUTES . " (customers_id, products_id, products_options_id , products_options_value_id) values ('" . $customer_id . "', '" . $SESSION_WISHLIST . "', '" . $att_option . "', '" . $att_value . "' )");
    }
   }
  tep_session_unregister('SESSION_WISHLIST');
  }

  //END OF ADDITION
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_WISHLIST);

  $breadcrumb->add(HEADING_TITLE, tep_href_link(FILENAME_WISHLIST, '', 'NONSSL'));

  $content = CONTENT_WISHLIST;

  include (bts_select('main', $content_template)); // BTSv1.5


  require(DIR_WS_INCLUDES . 'application_bottom.php'); 
  
?>