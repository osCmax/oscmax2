<?php
/*
$Id: wishlist_public.php 3 2006-05-27 04:59:07Z user $
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
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_WISHLIST);

if(!isset($_GET['public_id']) && !isset($_POST['add_wishprod'])) {
  	tep_redirect(tep_href_link(FILENAME_DEFAULT));
}

if((isset($_GET['public_id'])) && ($_GET['public_id'] == '')) {
  	tep_redirect(tep_href_link(FILENAME_DEFAULT));
}

  $public_id = $_GET['public_id'];

// QUERY CUSTOMER INFO FROM ID
 	$customer_query = tep_db_query("select customers_firstname from " . TABLE_CUSTOMERS . " where customers_id = '" . $public_id . "'");
	$customer = tep_db_fetch_array($customer_query);

// ADD PRODUCT TO SHOPPING CART
  if (isset($_POST['add_wishprod'])) {
	if(isset($_POST['add_prod_x'])) {
		foreach ($_POST['add_wishprod'] as $value) {
			$product_id = tep_get_prid($value);
			$cart->add_cart($product_id, $cart->get_quantity(tep_get_uprid($product_id, $_POST['id'][$value]))+1, $_POST['id'][$value]); 
		}
	tep_redirect(tep_href_link(FILENAME_SHOPPING_CART));
	}
  }


  $breadcrumb->add(NAVBAR_TITLE_WISHLIST, tep_href_link(FILENAME_WISHLIST, '', 'SSL'));
  $content = CONTENT_WISHLIST_PUBLIC;

  include (bts_select('main', $content_template)); // BTSv1.5
  require(DIR_WS_INCLUDES . 'application_bottom.php'); 
?>
