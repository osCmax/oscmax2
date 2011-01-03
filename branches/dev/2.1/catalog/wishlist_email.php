<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');

 if (tep_session_is_registered('customer_id')) {
    $account = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id = '" . $customer_id . "'");
    $account_values = tep_db_fetch_array($account);
  } elseif (ALLOW_GUEST_TO_TELL_A_FRIEND == 'false') {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

 require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_WISHLIST_SEND);

 $wishliststring = FORM_FIELD_TEXT_AREA;
 $wishlist_query_raw = "select tab2.products_id, tab1.products_name from " . TABLE_WISHLIST . " as tab2, " . TABLE_PRODUCTS_DESCRIPTION . " as tab1 where tab2.customers_id='" . (int)$customer_id . "' and tab1.products_id = tab2.products_id and tab1.language_id = '" . (int)$languages_id . "' order by products_name";
 $wishlist_query = tep_db_query($wishlist_query_raw);

 while ($resultarray=mysql_fetch_row($wishlist_query)) {
      $wishliststring .=""."<font face=verdana size=2><li><a href=\"". HTTP_SERVER . DIR_WS_CATALOG ."product_info.php?products_id=".$resultarray[0] ."\">".$resultarray[1]."</a></li></font>"  . "\n" . HTTP_SERVER . DIR_WS_CATALOG ."product_info.php?products_id=".$resultarray[0] . "\n";
 }

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_WISHLIST_SEND, '', 'NONSSL'));

  $content = CONTENT_WISHLIST_SEND;

  include (bts_select('main')); // BTSv1.5


  require(DIR_WS_INCLUDES . 'application_bottom.php');

?>
