<?php
/*
$Id: index.php 14 2006-07-28 17:42:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com
  adapted for Separate Pricing per Customer 2007/06/24, Hide products and categories from groups 2008/08/03

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');

// BOF: MOD - Customer Groups
global $customer_group_id;
  if(!isset($customer_group_id)) { $customer_group_id = '0'; }
// EOF: MOD - Customer Groups

// the following cPath references come from application_top.php
  $category_depth = 'top';
  if (isset($cPath) && tep_not_null($cPath)) {
    $categories_products_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "'");
    $categories_products = tep_db_fetch_array($categories_products_query);
    if ($categories_products['total'] > 0) {
      $category_depth = 'products'; // display products
    } else {
      $category_parent_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " where parent_id = '" . (int)$current_category_id . "'");
      $category_parent = tep_db_fetch_array($category_parent_query);
      if ($category_parent['total'] > 0) {
        $category_depth = 'nested'; // navigate through the categories
      } else {
        $category_depth = 'products'; // category has no products, but display the 'no products' message
      }
    }
  }

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_DEFAULT);

  if ($category_depth == 'nested') {
// BOF: MOD - Categories Description 1.5
//    $category_query = tep_db_query("select cd.categories_name, c.categories_image from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . (int)$current_category_id . "' and cd.categories_id = '" . (int)$current_category_id . "' and cd.language_id = '" . (int)$languages_id . "'");
//  $category_query = tep_db_query("select cd.categories_name, cd.categories_heading_title, cd.categories_description, c.categories_image from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . $current_category_id . "' and cd.categories_id = '" . $current_category_id . "' and cd.language_id = '" . $languages_id . "'");
// BOF SPPC Hide categories from groups
    $category_query = tep_db_query("select cd.categories_name, cd.categories_heading_title, cd.categories_description, c.categories_image from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . (int)$current_category_id . "' and cd.categories_id = '" . (int)$current_category_id . "' and cd.language_id = '" . (int)$languages_id . "' and find_in_set('".$customer_group_id."', categories_hide_from_groups) = 0");
// EOF SPPC Hide categories from groups
// EOF: MOD - Categories Description 1.5

    $category = tep_db_fetch_array($category_query);

    $content = CONTENT_INDEX_NESTED;

  } elseif ( ($category_depth == 'products') || (isset($_GET['manufacturers_id'])) || (isset($_GET['show_specials'])) || (isset($_GET['new_products'])) ) {
// create column list
    $define_list = array('PRODUCT_LIST_MODEL' => PRODUCT_LIST_MODEL,
                         'PRODUCT_LIST_NAME' => PRODUCT_LIST_NAME,
                         'PRODUCT_LIST_MANUFACTURER' => PRODUCT_LIST_MANUFACTURER,
                         'PRODUCT_LIST_PRICE' => PRODUCT_LIST_PRICE,
                         'PRODUCT_LIST_QUANTITY' => PRODUCT_LIST_QUANTITY,
                         'PRODUCT_LIST_WEIGHT' => PRODUCT_LIST_WEIGHT,
                         'PRODUCT_LIST_IMAGE' => PRODUCT_LIST_IMAGE,
                         'PRODUCT_LIST_BUY_NOW' => PRODUCT_LIST_BUY_NOW,
						 'PRODUCT_CORNER_BANNER' => PRODUCT_CORNER_BANNER);

    asort($define_list);

    $column_list = array();
    reset($define_list);
    while (list($key, $value) = each($define_list)) {
      if ($value > 0) $column_list[] = $key;
    }
// BOF: MOD - Separate Pricing Per Customer
   if(!tep_session_is_registered('sppc_customer_group_id')) {
     $customer_group_id = '0';
     } else {
      $customer_group_id = $sppc_customer_group_id;
   }
   // this will build the table with specials prices for the retail group or update it if needed
   // this function should have been added to includes/functions/database.php
   if ($customer_group_id == '0') {
   tep_db_check_age_specials_retail_table();
   }
   $status_product_prices_table = false;
   $status_need_to_get_prices = false;

   // find out if sorting by price has been requested
   if ( (isset($_GET['sort'])) && (preg_match('/[1-8][ad]/', $_GET['sort'])) && (substr($_GET['sort'], 0, 1) <= sizeof($column_list)) && $customer_group_id != '0' ){
    $_sort_col = substr($_GET['sort'], 0 , 1);
    if ($column_list[$_sort_col-1] == 'PRODUCT_LIST_PRICE') {
      $status_need_to_get_prices = true;
      }
   }

   if ($status_need_to_get_prices == true && $customer_group_id != '0') {
   $product_prices_table = TABLE_PRODUCTS_GROUP_PRICES.$customer_group_id;
   // the table with product prices for a particular customer group is re-built only a number of times per hour
   // (setting in /includes/database_tables.php called MAXIMUM_DELAY_UPDATE_PG_PRICES_TABLE, in minutes)
   // to trigger the update the next function is called (new function that should have been
   // added to includes/functions/database.php)
   tep_db_check_age_products_group_prices_cg_table($customer_group_id);
   $status_product_prices_table = true;

   } // end if ($status_need_to_get_prices == true && $customer_group_id != '0')
// EOF: MOD - Separate Pricing Per Customer

    $select_column_list = '';

    for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
      switch ($column_list[$i]) {
        case 'PRODUCT_LIST_MODEL':
          $select_column_list .= 'p.products_model, ';
          break;
        case 'PRODUCT_LIST_NAME':
          $select_column_list .= 'pd.products_name, ';
          break;
        case 'PRODUCT_LIST_MANUFACTURER':
          $select_column_list .= 'm.manufacturers_name, ';
          break;
        case 'PRODUCT_LIST_QUANTITY':
          $select_column_list .= 'p.products_quantity, ';
          break;
        case 'PRODUCT_LIST_IMAGE':
          $select_column_list .= 'p.products_image, ';
          break;
        case 'PRODUCT_LIST_WEIGHT':
          $select_column_list .= 'p.products_weight, ';
          break;
      }
    }

// BOF: Extra Product Fields
    $epf_query = tep_db_query("select * from " . TABLE_EPF . " e join " . TABLE_EPF_LABELS . " l where e.epf_status and (e.epf_show_in_listing or e.epf_use_to_restrict_listings) and (e.epf_id = l.epf_id) and (l.languages_id = " . (int)$languages_id . ") and l.epf_active_for_language order by e.epf_order");
    $epf = array();
    while ($e = tep_db_fetch_array($epf_query)) {
      $field = 'extra_value';
      if ($e['epf_uses_value_list']) {
        if ($e['epf_multi_select']) {
          $field .= '_ms';
        } else {
          $field .= '_id';
        }
      }
      $field .= $e['epf_id'];
      $epf[] = array('id' => $e['epf_id'],
                     'label' => $e['epf_label'],
                     'uses_list' => $e['epf_uses_value_list'],
                     'show_chain' => $e['epf_show_parent_chain'],
                     'restrict' => $e['epf_use_to_restrict_listings'],
                     'listing' => $e['epf_show_in_listing'],
                     'multi_select' => $e['epf_multi_select'],
                     'field' => $field);
      $select_column_list .= 'pd.' . $field . ', ';
    }
// EOF: Extra Product Fields

// BOF: MOD - Categories Description 1.5
// Get the category name and description
    $category_query = tep_db_query("select cd.categories_name, cd.categories_heading_title, cd.categories_description, c.categories_image from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . $current_category_id . "' and cd.categories_id = '" . $current_category_id . "' and cd.language_id = '" . $languages_id . "'");
    $category = tep_db_fetch_array($category_query);
// EOF: MOD - Categories Description 1.5

// show the products of a specified manufacturer
    if (isset($_GET['manufacturers_id'])) { // 1
      if (isset($_GET['filter_id']) && tep_not_null($_GET['filter_id'])) { // 2
        // We are asked to show only a specific category
        // BOF Separate Pricing Per Customer
        // LINE MODED: MSRP: Added "p.products_msrp,"
        // LINE MODED: Corner Banners: Added "p.products_featured, p.products_quantity,"
	    if ($status_product_prices_table == true) { // 3 changed for SPPC hide categories -- ok in mysql 5
	      $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_msrp, tmp_pp.products_price, p.products_tax_class_id, p.products_featured, p.products_quantity, IF(tmp_pp.status, tmp_pp.specials_new_products_price, NULL) as specials_new_products_price, IF(tmp_pp.status, tmp_pp.specials_new_products_price, tmp_pp.products_price) as final_price from " . TABLE_PRODUCTS . " p left join " . $product_prices_table . " as tmp_pp using(products_id), " . TABLE_PRODUCTS_DESCRIPTION . " pd left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c using(products_id) left join " . TABLE_CATEGORIES . " c using(categories_id), " . TABLE_MANUFACTURERS . " m where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$_GET['filter_id'] . "'";
	    } else { // 3 either retail or no need to get correct special prices -- changed for mysql 5 and
        // SPPC hide categories for groups
        // LINE MODED: MSRP: Added "p.products_msrp,"
        // LINE MODED: Corner Banners: Added "p.products_featured, p.products_quantity,"
	      $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_msrp, p.products_price, p.products_tax_class_id, p.products_featured, p.products_quantity, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS_RETAIL_PRICES . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES . " c using(categories_id) where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$_GET['filter_id'] . "'";
	    } // 3 end else { // either retail...
// EOF Separate Pricing Per Customer
      } else { // 2
        // We show them all
        // BOF Separate Pricing Per Customer
        // LINE MODED: MSRP: Added "p.products_msrp,"
        // LINE MODED: Corner Banners: Added "p.products_featured, p.products_quantity,"
        if ($status_product_prices_table == true) { // 4
          $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_msrp, tmp_pp.products_price, p.products_tax_class_id, p.products_featured, p.products_quantity, IF(tmp_pp.status, tmp_pp.specials_new_products_price, NULL) as specials_new_products_price, IF(tmp_pp.status, tmp_pp.specials_new_products_price, tmp_pp.products_price) as final_price from " . TABLE_PRODUCTS . " p left join " . $product_prices_table . " as tmp_pp using(products_id) left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on p.products_id = p2c.products_id left join " . TABLE_CATEGORIES . " c using(categories_id), " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m where p.products_status = '1' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'";
	    } else { // 4 either retail or no need to get correct special prices -- changed for mysql 5 & SPPC hide categories
          // LINE MODED: MSRP: Added "p.products_msrp,"
          // LINE MODED: Corner Banners: Added "p.products_featured, p.products_quantity,"
          $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_msrp, p.products_price, p.products_tax_class_id, p.products_featured, p.products_quantity, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p left join " . TABLE_SPECIALS_RETAIL_PRICES . " s on p.products_id = s.products_id left join " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c on p.products_id = p2c.products_id left join " . TABLE_CATEGORIES . " c using(categories_id), " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m where p.products_status = '1' and pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'";
	    } // 4 end else { // either retail...
// EOF Separate Pricing Per Customer
      } // 2 end
	
    } elseif (isset($_GET['show_specials']) && tep_not_null($_GET['show_specials'])) { // 1
	// show only the specials  
	  if ($status_product_prices_table == true) { // 6
        $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_msrp, tmp_pp.products_price, p.products_tax_class_id, p.products_featured, p.products_quantity, IF(tmp_pp.status, tmp_pp.specials_new_products_price, NULL) as specials_new_products_price, IF(tmp_pp.status, tmp_pp.specials_new_products_price, tmp_pp.products_price) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd left join " . $product_prices_table . " as tmp_pp using(products_id), " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES . " c using(categories_id) where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and tmp_pp.status = '1'";
      } else { // 6
		$listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_msrp, p.products_price, p.products_tax_class_id, p.products_featured, p.products_quantity, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_SPECIALS_RETAIL_PRICES . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES . " c using(categories_id) where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and s.status = '1'";
      } //6
	} elseif (isset($_GET['new_products']) && tep_not_null($_GET['new_products'])) { // 1
	// show only the new products
	  if ($status_product_prices_table == true) { // 10
        $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_msrp, tmp_pp.products_price, p.products_tax_class_id, p.products_featured, p.products_quantity, IF(tmp_pp.status, tmp_pp.specials_new_products_price, NULL) as specials_new_products_price, IF(tmp_pp.status, tmp_pp.specials_new_products_price, tmp_pp.products_price) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd left join " . $product_prices_table . " as tmp_pp using(products_id), " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES . " c using(categories_id) where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "'";
      } else { // 10
		$listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_msrp, p.products_price, p.products_tax_class_id, p.products_featured, p.products_quantity, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_SPECIALS_RETAIL_PRICES . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES . " c using(categories_id) where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "'";
      } // 10
	} else { // 1
      // show the products in a given categorie
      if (isset($_GET['filter_id']) && tep_not_null($_GET['filter_id'])) { //7
// We are asked to show only specific catgeory;
// BOF Separate Pricing Per Customer
// LINE MODED: MSRP: Added "p.products_msrp,"
// LINE MODED: Corner Banners: Added "p.products_featured, p.products_quantity,"
        if ($status_product_prices_table == true) { // 8 ok for mysql 5, SPPC hide categories for groups added
          $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_msrp, tmp_pp.products_price, p.products_tax_class_id, p.products_featured, p.products_quantity, IF(tmp_pp.status, tmp_pp.specials_new_products_price, NULL) as specials_new_products_price, IF(tmp_pp.status, tmp_pp.specials_new_products_price, tmp_pp.products_price) as final_price from " . TABLE_PRODUCTS . " p left join " . $product_prices_table . " as tmp_pp using(products_id), " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES . " c using(categories_id) where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['filter_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$current_category_id . "'";
        } else { // 8 either retail or no need to get correct special prices -- ok for mysql 5
		// SPPC hide categories for groups added
// LINE MODED: MSRP: Added "p.products_msrp,"
// LINE MODED: Corner Banners: Added "p.products_featured, p.products_quantity,"
          $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_msrp, p.products_price, p.products_tax_class_id, p.products_featured, p.products_quantity, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_MANUFACTURERS . " m, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_SPECIALS_RETAIL_PRICES . " s using(products_id) left join " . TABLE_CATEGORIES . " c on p2c.categories_id = c.categories_id where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and m.manufacturers_id = '" . (int)$_GET['filter_id'] . "' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$current_category_id . "'";
        } // 8 end else { // either retail...
// EOF Separate Pricing Per Customer
      } else { // 7
// We show them all
// BOF Separate Pricing Per Customer --last query changed for mysql 5 compatibility
        if ($status_product_prices_table == true) { // 9 ok in mysql 5
// SPPC hide categories for groups added
// LINE MODED: MSRP: Added "p.products_msrp,"
// LINE MODED: Corner Banners: Added "p.products_featured, p.products_quantity,"
          $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_msrp, tmp_pp.products_price, p.products_tax_class_id, p.products_featured, p.products_quantity, IF(tmp_pp.status, tmp_pp.specials_new_products_price, NULL) as specials_new_products_price, IF(tmp_pp.status, tmp_pp.specials_new_products_price, tmp_pp.products_price) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd left join " . $product_prices_table . " as tmp_pp using(products_id), " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES . " c using(categories_id) where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$current_category_id . "'";
        } else { // 9 either retail or no need to get correct special prices -- changed for mysql 5
// SPPC hide categories for groups added
// LINE MODED: MSRP: Added "p.products_msrp,"
// LINE MODED: Corner Banners: Added "p.products_featured, p.products_quantity,"
          $listing_sql = "select " . $select_column_list . " p.products_id, p.manufacturers_id, p.products_msrp, p.products_price, p.products_tax_class_id, p.products_featured, p.products_quantity, IF(s.status, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status, s.specials_new_products_price, p.products_price) as final_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m on p.manufacturers_id = m.manufacturers_id left join " . TABLE_SPECIALS_RETAIL_PRICES . " s on p.products_id = s.products_id, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES . " c using(categories_id) where p.products_status = '1' and p.products_id = p2c.products_id and pd.products_id = p2c.products_id and pd.language_id = '" . (int)$languages_id . "' and p2c.categories_id = '" . (int)$current_category_id . "'";
        } // 9 end else { // either retail...
// EOF Separate Pricing per Customer
      } // 7
    } // 1
	
// BOF SPPC Hide products and categories from groups
 $listing_sql .= " and find_in_set('".$customer_group_id."', products_hide_from_groups) = 0 ";
 $listing_sql .= " and find_in_set('" . $customer_group_id . "', c.categories_hide_from_groups) = 0 ";
 // EOF SPPC Hide products and categories from groups

// BOF: extra product fields
    $restrict_by = '';
    foreach ($epf as $e) {
      if ($e['restrict']) {
        if (isset($_GET[$e['field']]) && is_numeric($_GET[$e['field']])) {
          $restrict_by .= ' and (pd.' . $e['field'] . ' in (' . (int)$_GET[$e['field']] . tep_list_epf_children($_GET[$e['field']]) . '))';
        }
      }       
    }
    $listing_sql .= $restrict_by;
// EOF: extra product fields

    if ( (!isset($_GET['sort'])) || (!preg_match('/^[1-8][ad]$/', $_GET['sort'])) || (substr($_GET['sort'], 0, 1) > sizeof($column_list)) ) {
      for ($i=0, $n=sizeof($column_list); $i<$n; $i++) {
        if ($column_list[$i] == 'PRODUCT_LIST_NAME') {
          $_GET['sort'] = $i+1 . 'a';
          $listing_sql .= " order by pd.products_name";
          break;
        }
      }
    } else {
      $sort_col = substr($_GET['sort'], 0 , 1);
      $sort_order = substr($_GET['sort'], 1);

      switch ($column_list[$sort_col]) {
        case 'PRODUCT_LIST_MODEL':
          $listing_sql .= " order by p.products_model " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
        case 'PRODUCT_LIST_NAME':
          $listing_sql .= " order by pd.products_name " . ($sort_order == 'd' ? 'desc' : '');
          break;
        case 'PRODUCT_LIST_MANUFACTURER':
          $listing_sql .= " order by m.manufacturers_name " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
        case 'PRODUCT_LIST_QUANTITY':
          $listing_sql .= " order by p.products_quantity " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
        case 'PRODUCT_LIST_IMAGE':
          $listing_sql .= " order by pd.products_name";
          break;
        case 'PRODUCT_LIST_WEIGHT':
          $listing_sql .= " order by p.products_weight " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
        case 'PRODUCT_LIST_PRICE':
          $listing_sql .= " order by final_price " . ($sort_order == 'd' ? 'desc' : '') . ", pd.products_name";
          break;
      }
    }
	
// Add new products limit and order
	if (isset($_GET['new_products']) && tep_not_null($_GET['new_products'])) { 
      $listing_sql .= ", products_date_added";
	}
    $content = CONTENT_INDEX_PRODUCTS;
  } else { // default page
    $content = CONTENT_INDEX_DEFAULT;
  }

  include (bts_select('main', $content_template)); // BTSv1.5
  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>