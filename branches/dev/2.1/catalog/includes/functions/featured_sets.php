<?php
/*
  $Id$

  Open Featured Sets functions module

Made for:
  osCommerce, Open Source E-Commerce Solutions 
  http://www.oscommerce.com 
  Copyright 2000 - 2011 osCmax
  Released under the GNU General Public License 
*/

////
// Recursively go through the categories and retreive all sub-categories IDs
// TABLES: categories
  function tep_get_sub_categories(&$categories, $categories_id) {
    $sub_categories_query = tep_db_query("select categories_id from " . TABLE_CATEGORIES . " where parent_id = '" . (int)$categories_id . "'");
    while ($sub_categories = tep_db_fetch_array($sub_categories_query)) {
      if ($sub_categories['categories_id'] == 0) return true;
      $categories[sizeof($categories)] = $sub_categories['categories_id'];
      if ($sub_categories['categories_id'] != $categories_id) {
        tep_get_sub_categories($categories, $sub_categories['categories_id']);
      }
    }
  }

////
// Sets the status of a featured product
  function tep_set_featured_status($products_id, $featured) {
    return tep_db_query("update " . TABLE_PRODUCTS . " set products_featured = '" . $featured . "', products_last_modified = now() where products_id = '" . (int)$products_id . "'");
  }

////
// Auto expire products on special
  function tep_expire_featured() {
    $featured_query = tep_db_query("SELECT products_id from " . TABLE_PRODUCTS . " where products_featured = '1' and now() >= products_featured_until and products_featured_until > 0");
    if (tep_db_num_rows($featured_query)) {
      while ($featured = tep_db_fetch_array($featured_query)) {
        tep_set_featured_status($featured['products_id'], '0');
      }
    }
  }

////
// Sets the status of a featured manufacturers
  function tep_set_featured_manufacturers_status($manufacturers_id, $featured) {
    return tep_db_query("update " . TABLE_MANUFACTURERS . " set manufacturers_featured = '" . $featured . "', last_modified = now() where manufacturers_id = '" . (int)$manufacturers_id . "'");
  }

////
// Auto expire manufacturers
  function tep_expire_featured_manufacturers() {
    $featured_manufacturers_query = tep_db_query("SELECT manufacturers_id from " . TABLE_MANUFACTURERS . " where manufacturers_featured = '1' and now() >= manufacturers_featured_until and manufacturers_featured_until > 0");
    if (tep_db_num_rows($featured_manufacturers_query)) {
      while ($featured = tep_db_fetch_array($featured_manufacturers_query)) {
        tep_set_featured_manufacturers_status($featured['manufacturers_id'], '0');
      }
    }
  }

////
// Sets the status of a featured manufacturer
  function tep_set_featured_manufacturer_status($manufacturers_id, $featured) {
    return tep_db_query("update " . TABLE_MANUFACTURERS . " set manufacturer_featured = '" . $featured . "', last_modified = now() where manufacturers_id = '" . (int)$manufacturers_id . "'");
  }

////
// Auto expire manufacturer
  function tep_expire_featured_manufacturer() {
    $featured_manufacturer_query = tep_db_query("SELECT manufacturers_id from " . TABLE_MANUFACTURERS . " where manufacturer_featured = '1' and now() >= manufacturer_featured_until and manufacturer_featured_until > 0");
    if (tep_db_num_rows($featured_manufacturer_query)) {
      while ($featured = tep_db_fetch_array($featured_manufacturer_query)) {
        tep_set_featured_manufacturer_status($featured['manufacturers_id'], '0');
      }
    }
  }

////
// Sets the status of a featured categories
  function tep_set_featured_categories_status($categories_id, $featured) {
    return tep_db_query("update " . TABLE_CATEGORIES . " set categories_featured = '" . $featured . "', last_modified = now() where categories_id = '" . (int)$categories_id . "'");
  }

////
// Auto expire categories
  function tep_expire_featured_categories() {
    $featured_categories_query = tep_db_query("SELECT categories_id from " . TABLE_CATEGORIES . " where categories_featured = '1' and now() >= categories_featured_until and categories_featured_until > 0");
    if (tep_db_num_rows($featured_categories_query)) {
      while ($featured = tep_db_fetch_array($featured_categories_query)) {
        tep_set_featured_categories_status($featured['categories_id'], '0');
      }
    }
  }
?>