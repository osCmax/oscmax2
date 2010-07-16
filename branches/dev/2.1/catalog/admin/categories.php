<?php
/*
$Id: categories.php 16 2006-07-30 03:27:26Z user $

  osCMax Power E-Commerce
  http://oscdox.com
  adapted for Separate Pricing Per Customer v4.2 2007/08/05, QPBPP for SPPC v2.0 2008/11/23, Hide products and categories from groups 2008/08/03

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
// LINE ADDED: Categories Description 1.5
  require('includes/functions/categories_description.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

// BOF QPBPP for SPPC
// include the admin version of price formatter for the price breaks contribution
  require(DIR_WS_CLASSES . 'PriceFormatterAdmin.php');
  $pf = new PriceFormatter;
// EOF QPBPP for SPPC

  $action = (isset($_GET['action']) ? $_GET['action'] : '');
// BOF: Extra Product Fields
  function get_exclude_list($value_id) {
    $exclude_list = array();
    $query = tep_db_query('select value_id1 from ' . TABLE_EPF_EXCLUDE . ' where value_id2 = ' . (int)$value_id);
    while ($check = tep_db_fetch_array($query)) {
      $exclude_list[] = $check['value_id1'];
    }
    $query = tep_db_query('select value_id2 from ' . TABLE_EPF_EXCLUDE . ' where value_id1 = ' . (int)$value_id);
    while ($check = tep_db_fetch_array($query)) {
      $exclude_list[] = $check['value_id2'];
    }
    return $exclude_list;
  }
  function get_children($value_id) {
    return explode(',', $value_id . tep_list_epf_children($value_id));
  }
  function get_parent_list($value_id) {
    $sql = tep_db_query("select parent_id from " . TABLE_EPF_VALUES . " where value_id = " . (int)$value_id);
    $value = tep_db_fetch_array($sql);
    if ($value['parent_id'] > 0) {
      return get_parent_list($value['parent_id']) . ',' . $value_id;
    } else {
      return $value_id;
    }
  }
  $epf_query = tep_db_query("select * from " . TABLE_EPF . " e join " . TABLE_EPF_LABELS . " l where (e.epf_status or e.epf_show_in_admin) and (e.epf_id = l.epf_id) order by e.epf_order");
  $epf = array();
  $xfields = array();
  $link_groups = array();
  $linked_fields = array();
  while ($e = tep_db_fetch_array($epf_query)) {  // retrieve all active extra fields for all languages
    $field = 'extra_value';
    if ($e['epf_uses_value_list']) {
      if ($e['epf_multi_select']) {
        $field .= '_ms';
      } else {
        $field .= '_id';
      }
    }
    $field .= $e['epf_id'];
    $values = '';
    if ($e['epf_uses_value_list'] && $e['epf_active_for_language'] && ($e['epf_has_linked_field'] || $e['epf_multi_select'])) { // if field requires javascript during entry
      $values = array();
      $value_query = tep_db_query('select value_id, value_depends_on from ' . TABLE_EPF_VALUES . ' where epf_id = ' . (int)$e['epf_id'] . ' and languages_id = ' . (int)$e['languages_id']);
      while ($v = tep_db_fetch_array($value_query)) {
        $values[] = $v['value_id'];
        if ($e['epf_has_linked_field'] && $e['epf_multi_select'] && ($v['value_depends_on'] != 0)) {
          $linked_fields[$e['epf_links_to']][$e['languages_id']][$v['value_depends_on']][] = $v['value_id'];
          if (!in_array($v['value_depends_on'], $link_groups[$e['epf_links_to']][$e['languages_id']])) $link_groups[$e['epf_links_to']][$e['languages_id']][] = $v['value_depends_on'];
        }
      }
    }
    $epf[] = array('id' => $e['epf_id'],
                   'label' => $e['epf_label'],
                   'uses_list' => $e['epf_uses_value_list'],
                   'multi_select' => $e['epf_multi_select'],
                   'show_chain' => $e['epf_show_parent_chain'],
                   'checkbox' => $e['epf_checked_entry'],
                   'display_type' => $e['epf_value_display_type'],
                   'columns' => $e['epf_num_columns'],
                   'linked' => $e['epf_has_linked_field'],
                   'links_to' => $e['epf_links_to'],
                   'size' => $e['epf_size'],
                   'language' => $e['languages_id'],
                   'language_active' => $e['epf_active_for_language'],
                   'values' => $values,
                   'textarea' => $e['epf_textarea'],
                   'field' => $field);
    if (!in_array( $field, $xfields))
      $xfields[] = $field; // build list of distinct fields    
  }
// EOF: Extra Product Fields

// BOF instant update & image directory
  require_once('includes/functions/instant_update.php');
// EOF instant update & image directory
 if (tep_not_null($action)) {
    // ULTIMATE Seo Urls 5 by FWR Media
    // If the action will affect the cache entries
    if ( $action == 'insert' || $action == 'update' || $action == 'setflag' ) {
      tep_reset_cache_data_seo_urls('reset');
    }
    switch ($action) {
      case 'setflag':
        if ( ($_GET['flag'] == '0') || ($_GET['flag'] == '1') ) {
          if (isset($_GET['pID'])) {
            tep_set_product_status($_GET['pID'], $_GET['flag']);
          }

          if (USE_CACHE == 'true') {
            tep_reset_cache_block('categories');
            tep_reset_cache_block('also_purchased');
          }
        }

        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $_GET['cPath'] . '&pID=' . $_GET['pID']));
        break;

// BOF Open Featured Sets
      case 'setflag_featured':
        if ( ($_GET['flag'] == '0') || ($_GET['flag'] == '1') ) {
          if (isset($_GET['pID'])) {
            tep_set_product_featured($_GET['pID'], $_GET['flag']);
          }

          if (USE_CACHE == 'true') {
            tep_reset_cache_block('categories');
            tep_reset_cache_block('also_purchased');
          }
        }

        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $_GET['cPath'] . '&pID=' . $_GET['pID']));
        break;

      case 'setflag_categories_featured':
        if ( ($_GET['flag'] == '0') || ($_GET['flag'] == '1') ) {
          if (isset($_GET['cID'])) {
            tep_set_categories_featured($_GET['cID'], $_GET['flag']);
          }

          if (USE_CACHE == 'true') {
            tep_reset_cache_block('categories');
          }
        }
        if ($categories['parent_id'] == '0') {
          tep_redirect(tep_href_link(FILENAME_CATEGORIES));
        } else {
          tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath));
        }
     //   tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $_GET['cPath']));
        break;
// EOF Open Featured Sets

// BOF: MOD for Categories Description 1.5
      case 'new_category':
      case 'edit_category':
        if (ALLOW_CATEGORY_DESCRIPTIONS == 'true')
          $_GET['action']=$_GET['action'] . '_ACD';
        break;
// EOF: MOD for Categories Description 1.5
      case 'insert_category':
      case 'update_category':
// BOF: MOD for Categories Description 1.5
        if ( ($_POST['edit_x']) || ($_POST['edit_y']) ) {
          $_GET['action'] = 'edit_category_ACD';
        } else {
// EOF: MOD for Categories Description 1.5
          if (isset($_POST['categories_id'])) $categories_id = tep_db_prepare_input($_POST['categories_id']);
// BOF: MOD for Categories Description 1.5
          if ($categories_id == '') {
             $categories_id = tep_db_prepare_input($_GET['cID']);
           }
// EOF: MOD for Categories Description 1.5
//          $sort_order = tep_db_prepare_input($_POST['sort_order']);

//        $sql_data_array = array('sort_order' => (int)$sort_order);
// BOF Separate Pricing Per Customer, hide categories from groups
        $hide_cats_from_these_groups = '@,';
          if ( $_POST['hide_cat'] ) { // if any of the checkboxes are checked
              foreach($_POST['hide_cat'] as $val) {
              $hide_cats_from_these_groups .= tep_db_prepare_input($val).',';
              } // end foreach
           }
           $hide_cats_from_these_groups = substr($hide_cats_from_these_groups,0,strlen($hide_cats_from_these_groups)-1); // remove last comma

        $sort_order = tep_db_prepare_input($_POST['sort_order']);

        $sql_data_array = array('sort_order' => $sort_order,
        'categories_hide_from_groups' => $hide_cats_from_these_groups);
// EOF Separate Pricing Per Customer, hide categories from groups

          if ($action == 'insert_category') {
            $insert_sql_data = array('parent_id' => $current_category_id,
// BOF Open Featured Sets
                                     'date_added' => 'now()',
				   					 'categories_featured' => tep_db_prepare_input($_POST['categories_featured']),
				   					 'categories_featured_until' => tep_db_prepare_input($_POST['categories_featured_until']));
// EOF Open Featured Sets

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

            tep_db_perform(TABLE_CATEGORIES, $sql_data_array);

            $categories_id = tep_db_insert_id();
            } elseif ($action == 'update_category') {
// BOF Open Featured Sets
            $update_sql_data = array('last_modified' => 'now()',
				   					 'categories_featured' => tep_db_prepare_input($_POST['categories_featured']),
				   					 'categories_featured_until' => tep_db_prepare_input($_POST['categories_featured_until']));
// EOF Open Featured Sets

              $sql_data_array = array_merge($sql_data_array, $update_sql_data);

              tep_db_perform(TABLE_CATEGORIES, $sql_data_array, 'update', "categories_id = '" . (int)$categories_id . "'");
            }

            $languages = tep_get_languages();
            for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
              $categories_name_array = $_POST['categories_name'];

              $language_id = $languages[$i]['id'];

              $sql_data_array = array('categories_name' => tep_db_prepare_input($categories_name_array[$language_id]));

// BOF: MOD for Categories Description 1.5
              if (ALLOW_CATEGORY_DESCRIPTIONS == 'true') {
                $sql_data_array = array('categories_name' => tep_db_prepare_input($_POST['categories_name'][$language_id]),
                                        'categories_heading_title' => tep_db_prepare_input($_POST['categories_heading_title'][$language_id]),
                                        'categories_description' => tep_db_prepare_input($_POST['categories_description'][$language_id]));
              }
// EOF: MOD for Categories Description 1.5
              if ($action == 'insert_category') {
                $insert_sql_data = array('categories_id' => $categories_id,
                                         'language_id' => $languages[$i]['id']);

                $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

                tep_db_perform(TABLE_CATEGORIES_DESCRIPTION, $sql_data_array);
              } elseif ($action == 'update_category') {
                tep_db_perform(TABLE_CATEGORIES_DESCRIPTION, $sql_data_array, 'update', "categories_id = '" . (int)$categories_id . "' and language_id = '" . (int)$languages[$i]['id'] . "'");
              }
            }

// BOF: MOD for Categories Description 1.5
//OLD-    if ($categories_image = new upload('categories_image', DIR_FS_CATALOG_IMAGES)) {
//          tep_db_query("update " . TABLE_CATEGORIES . " set categories_image = '" . //tep_db_input($categories_image->filename) . "' where categories_id = '" . (int)$categories_id . "'");
//Added the following to replacce above code
          if (ALLOW_CATEGORY_DESCRIPTIONS == 'true') {
            tep_db_query("update " . TABLE_CATEGORIES . " set categories_image = '" . $_POST['categories_image'] . "' where categories_id = '" .  tep_db_input($categories_id) . "'");
            $categories_image = '';
          } else {
        $categories_image = new upload('categories_image');
		        $categories_image->set_destination(DIR_FS_CATALOG_IMAGES . CATEGORY_IMAGES_DIR);

        if ($categories_image->parse() && $categories_image->save()) {
              tep_db_query("update " . TABLE_CATEGORIES . " set categories_image = '" . tep_db_input($categories_image->filename) . "' where categories_id = '" . (int)$categories_id . "'");
            }
// EOF: MOD for Categories Description 1.5
          }

          if (USE_CACHE == 'true') {
            tep_reset_cache_block('categories');
            tep_reset_cache_block('also_purchased');
          }

          tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $categories_id));
// BOF: MOD for Categories Description 1.5
        }
// EOF: MOD for Categories Description 1.5
        break;
      case 'delete_category_confirm':
        if (isset($_POST['categories_id'])) {
          $categories_id = tep_db_prepare_input($_POST['categories_id']);

          $categories = tep_get_category_tree($categories_id, '', '0', '', true);
          $products = array();
          $products_delete = array();

          for ($i=0, $n=sizeof($categories); $i<$n; $i++) {
            $product_ids_query = tep_db_query("select products_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id = '" . (int)$categories[$i]['id'] . "'");

            while ($product_ids = tep_db_fetch_array($product_ids_query)) {
              $products[$product_ids['products_id']]['categories'][] = $categories[$i]['id'];
            }
          }

          reset($products);
          while (list($key, $value) = each($products)) {
            $category_ids = '';

            for ($i=0, $n=sizeof($value['categories']); $i<$n; $i++) {
              $category_ids .= "'" . (int)$value['categories'][$i] . "', ";
            }
            $category_ids = substr($category_ids, 0, -2);

            $check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$key . "' and categories_id not in (" . $category_ids . ")");
            $check = tep_db_fetch_array($check_query);
            if ($check['total'] < '1') {
              $products_delete[$key] = $key;
            }
          }

// removing categories can be a lengthy process
          tep_set_time_limit(0);
          for ($i=0, $n=sizeof($categories); $i<$n; $i++) {
            tep_remove_category($categories[$i]['id']);
          }

          reset($products_delete);
          while (list($key) = each($products_delete)) {
            tep_remove_product($key);
          }
        }

        if (USE_CACHE == 'true') {
          tep_reset_cache_block('categories');
          tep_reset_cache_block('also_purchased');
        }

        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath));
        break;
      case 'delete_product_confirm':
        if (isset($_POST['products_id']) && isset($_POST['product_categories']) && is_array($_POST['product_categories'])) {
          $product_id = tep_db_prepare_input($_POST['products_id']);
          $product_categories = $_POST['product_categories'];

          for ($i=0, $n=sizeof($product_categories); $i<$n; $i++) {
            tep_db_query("delete from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$product_id . "' and categories_id = '" . (int)$product_categories[$i] . "'");

// LINE ADDED: MOD - Separate Price per Customer
           tep_db_query("delete from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . tep_db_input($product_id) . "' ");
          }

// BOF QPBPP for SPPC
            tep_db_query("delete from " . TABLE_PRODUCTS_PRICE_BREAK . " where products_id = '" . (int)$product_id . "'");
// EOF QPBPP for SPPC

          $product_categories_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$product_id . "'");
          $product_categories = tep_db_fetch_array($product_categories_query);

          if ($product_categories['total'] == '0') {
            tep_remove_product($product_id);
          }
        }

        if (USE_CACHE == 'true') {
          tep_reset_cache_block('categories');
          tep_reset_cache_block('also_purchased');
        }

        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath));
        break;
      case 'move_category_confirm':
        if (isset($_POST['categories_id']) && ($_POST['categories_id'] != $_POST['move_to_category_id'])) {
          $categories_id = tep_db_prepare_input($_POST['categories_id']);
          $new_parent_id = tep_db_prepare_input($_POST['move_to_category_id']);

          $path = explode('_', tep_get_generated_category_path_ids($new_parent_id));

          if (in_array($categories_id, $path)) {
            $messageStack->add_session(ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT, 'error');

            tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $categories_id));
          } else {
            tep_db_query("update " . TABLE_CATEGORIES . " set parent_id = '" . (int)$new_parent_id . "', last_modified = now() where categories_id = '" . (int)$categories_id . "'");

            if (USE_CACHE == 'true') {
              tep_reset_cache_block('categories');
              tep_reset_cache_block('also_purchased');
            }

            tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $new_parent_id . '&cID=' . $categories_id));
          }
        }

        break;
      case 'move_product_confirm':
        $products_id = tep_db_prepare_input($_POST['products_id']);
        $new_parent_id = tep_db_prepare_input($_POST['move_to_category_id']);

        $duplicate_check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$products_id . "' and categories_id = '" . (int)$new_parent_id . "'");
        $duplicate_check = tep_db_fetch_array($duplicate_check_query);
        if ($duplicate_check['total'] < 1) tep_db_query("update " . TABLE_PRODUCTS_TO_CATEGORIES . " set categories_id = '" . (int)$new_parent_id . "' where products_id = '" . (int)$products_id . "' and categories_id = '" . (int)$current_category_id . "'");

        if (USE_CACHE == 'true') {
          tep_reset_cache_block('categories');
          tep_reset_cache_block('also_purchased');
        }

        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $new_parent_id . '&pID=' . $products_id));
        break;
      case 'insert_product':
      case 'update_product':
        if (isset($_POST['edit_x']) || isset($_POST['edit_y'])) {
          $action = 'new_product';
        } else {
          if (isset($_GET['pID'])) $products_id = tep_db_prepare_input($_GET['pID']);
          $products_date_available = tep_db_prepare_input($_POST['products_date_available']);

          $products_date_available = (date('Y-m-d') < $products_date_available) ? $products_date_available : 'null';
// BOF Separate Pricing Per Customer, hide products and categories from groups
    $hide_from_these_groups = '@,';
             if ( $_POST['hide'] ) { // if any of the checkboxes are checked
                 foreach($_POST['hide'] as $val) {
                 $hide_from_these_groups .= tep_db_prepare_input($val).',';
                 } // end foreach
              }
     $hide_from_these_groups = substr($hide_from_these_groups,0,strlen($hide_from_these_groups)-1); // remove last comma
// EOF Separate Pricing Per Customer, hide products and categories from groups

          $sql_data_array = array('products_quantity' => (int)tep_db_prepare_input($_POST['products_quantity']),
//LINE ADDED: MOD - indvship
                                  'products_ship_price' => tep_db_prepare_input($_POST['products_ship_price']), //indvship
                                  'products_model' => tep_db_prepare_input($_POST['products_model']),
                                  'products_price' => tep_db_prepare_input($_POST['products_price']),
// BOF QPBPP for SPPC
                                  'products_qty_blocks' => (($i = (int)tep_db_prepare_input($_POST['products_qty_blocks'][0])) < 1) ? 1 : $i,
                                  'products_min_order_qty' => (($min_i = (int)tep_db_prepare_input($_POST['products_min_order_qty'][0])) < 1) ? 1 : $min_i,
// EOF QPBPP for SPPC
                                  'products_date_available' => $products_date_available,
                                  'products_weight' => (float)tep_db_prepare_input($_POST['products_weight']),
// BOF Open Featured Sets
                                  'products_featured' => tep_db_prepare_input($_POST['products_featured']),
     				  			  'products_featured_until' => tep_db_prepare_input($_POST['products_featured_until']),
// EOF Open Featured Sets
                                  'products_height' => tep_db_prepare_input($_POST['products_height']),
                                  'products_length' => tep_db_prepare_input($_POST['products_length']),
                                  'products_width' => tep_db_prepare_input($_POST['products_width']),
                                  'products_ready_to_ship' => tep_db_prepare_input($_POST['products_ready_to_ship']),
                                  'products_status' => tep_db_prepare_input($_POST['products_status']),
                                  'products_tax_class_id' => tep_db_prepare_input($_POST['products_tax_class_id']),
// BOF Separate Price Per Customer, hide for these groups modification
                                  'products_hide_from_groups' => $hide_from_these_groups,
// EOF Separate Price Per Customer, hide for these groups modification
                                  'manufacturers_id' => (int)tep_db_prepare_input($_POST['manufacturers_id']));
		//++++ QT Pro: Begin Added code
			if($product_investigation['has_tracked_options'] or $product_investigation['stock_entries_count'] > 0){
				//Do not modify the stock from this page if the product has database entries or has tracked options
				unset($sql_data_array['products_quantity']);
			}

		//++++ QT Pro: End Added code

          if (isset($_POST['products_image']) && tep_not_null($_POST['products_image']) && ($_POST['products_image'] != 'none')) {
            $sql_data_array['products_image'] = tep_db_prepare_input($_POST['products_image']);
          }

          if ($action == 'insert_product') {
            $insert_sql_data = array('products_date_added' => 'now()');

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

            tep_db_perform(TABLE_PRODUCTS, $sql_data_array);
            $products_id = tep_db_insert_id();

            tep_db_query("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_id) values ('" . (int)$products_id . "', '" . (int)$current_category_id . "')");
          } elseif ($action == 'update_product') {
            $update_sql_data = array('products_last_modified' => 'now()');

            $sql_data_array = array_merge($sql_data_array, $update_sql_data);

            tep_db_perform(TABLE_PRODUCTS, $sql_data_array, 'update', "products_id = '" . (int)$products_id . "'");
          }

//BOF: MOD - AJAX Attribute Manager
          require_once('attributeManager/includes/attributeManagerUpdateAtomic.inc.php');
//EOF: MOD - AJAX Attribute Manager


// BOF QPBPP for SPPC
// BOF entries in products_groups
 $customers_group_query = tep_db_query("select customers_group_id, customers_group_name from " . TABLE_CUSTOMERS_GROUPS . " where customers_group_id != '0' order by customers_group_id");
while ($customers_group = tep_db_fetch_array($customers_group_query)) // Gets all of the customers groups
  {
  $attributes_query = tep_db_query("select customers_group_id, customers_group_price, products_qty_blocks, products_min_order_qty from " . TABLE_PRODUCTS_GROUPS . " where ((products_id = '" . $products_id . "') && (customers_group_id = " . $customers_group['customers_group_id'] . ")) order by customers_group_id");
  $attributes = tep_db_fetch_array($attributes_query);
// set default values for quantity blocks and min order quantity
  $pg_products_qty_blocks = 1;
  $pg_products_min_order_qty = 1;
  $delete_row_from_pg = false;

  if (isset($_POST['products_qty_blocks'][$customers_group['customers_group_id']]) && (int)$_POST['products_qty_blocks'][$customers_group['customers_group_id']] > 1) {
     $pg_products_qty_blocks = (int)$_POST['products_qty_blocks'][$customers_group['customers_group_id']];
  }
  if (isset($_POST['products_min_order_qty'][$customers_group['customers_group_id']]) && (int)$_POST['products_min_order_qty'][$customers_group['customers_group_id']] > 1) {
     $pg_products_min_order_qty = (int)$_POST['products_min_order_qty'][$customers_group['customers_group_id']];
  }
  if ($_POST['sppcprice'][$customers_group['customers_group_id']] == '' && $pg_products_qty_blocks == 1 && $pg_products_min_order_qty == 1) {
    $delete_row_from_pg = true; // no need to have default values for qty blocks and min order qty in the table
  }
  if ($_POST['sppcprice'][$customers_group['customers_group_id']] == '') {
    $pg_cg_group_price = 'null';
  } else {
    $pg_cg_group_price = "'" . (float)$_POST['sppcprice'][$customers_group['customers_group_id']] . "'";
  }

  if (tep_db_num_rows($attributes_query) > 0 && $delete_row_from_pg == false) {
// there is already a row inserted in products_groups, update instead of insert
    if ($_POST['sppcoption'][$customers_group['customers_group_id']]) { // this is checking if the check box is checked
        tep_db_query("update " . TABLE_PRODUCTS_GROUPS . " set customers_group_price = " . $pg_cg_group_price . ", products_qty_blocks = " . $pg_products_qty_blocks . ", products_min_order_qty = " . $pg_products_min_order_qty . " where customers_group_id = '" . $attributes['customers_group_id'] . "' and products_id = '" . $products_id . "'");
    }
    else {
      tep_db_query("delete from " . TABLE_PRODUCTS_GROUPS . " where customers_group_id = '" . $customers_group['customers_group_id'] . "' and products_id = '" . $products_id . "'");
    }
  } elseif (tep_db_num_rows($attributes_query) > 0 && $delete_row_from_pg == true) {
      tep_db_query("delete from " . TABLE_PRODUCTS_GROUPS . " where customers_group_id = '" . $customers_group['customers_group_id'] . "' and products_id = '" . $products_id . "'");
  } elseif (($_POST['sppcoption'][$customers_group['customers_group_id']]) && $delete_row_from_pg == false) {
    tep_db_query("insert into " . TABLE_PRODUCTS_GROUPS . " (products_id, customers_group_id, customers_group_price, products_qty_blocks, products_min_order_qty) values ('" . $products_id . "', '" . $customers_group['customers_group_id'] . "', " . $pg_cg_group_price . ", " . $pg_products_qty_blocks . ", " . $pg_products_min_order_qty . ")");
  }
} // end while ($customers_group = tep_db_fetch_array($customers_group_query))
// EOF entries in products_groups

// BOF entries in products_to_discount_categories
  foreach ($_POST['discount_categories_id'] as $dc_cg_id => $dc_id) {
    $current_discount_category = (int)$_POST['current_discount_cat_id'][$dc_cg_id];
    $new_discount_category = (int)$dc_id;
    $discount_category_result = qpbpp_insert_update_discount_cats($products_id, $current_discount_category, $new_discount_category, $dc_cg_id);
      if ($discount_category_result == false) {
          $messageStack->add_session(ERROR_UPDATE_INSERT_DISCOUNT_CATEGORY, 'error');
       }
  } // end foreach ($_POST['discount_categories_id'] as $dc_cg_id => $dc_id
// EOF entries in products_to_discount_categories

// BOF entries in products_price_break
  foreach ($_POST['products_price_break'] as $pbb_cg_id => $price_break_array) {
    foreach ($price_break_array as $key1 => $products_price) {
      $pb_action = 'insert'; // re-set default to insert
      $where_clause = '';
      if (isset($_POST['products_delete'][$pbb_cg_id][$key1]) && $_POST['products_delete'][$pbb_cg_id][$key1] == 'y' && isset($_POST['products_price_break_id'][$pbb_cg_id][$key1])) {
        $delete_from_ppb_array[] = (int)$_POST['products_price_break_id'][$pbb_cg_id][$key1];
        continue;
      }
      if (!tep_not_null($products_price)) {
        continue; // if price is empty this price break is unused
      } elseif (!tep_not_null($_POST['products_qty'][$pbb_cg_id][$key1])) {
        continue; // if qty is not entered we will not update or insert this in the table
      } else {
        $sql_price_break_data_array = array(
           'products_id' => (int)$products_id,
           'products_price' => (float)$products_price,
           'products_qty' => (int)$_POST['products_qty'][$pbb_cg_id][$key1],
           'customers_group_id' => $pbb_cg_id
           );

        if (isset($_POST['products_price_break_id'][$pbb_cg_id][$key1]) && (int)$_POST['products_price_break_id'][$pbb_cg_id][$key1] > 0) {
          $pb_action = 'update';
          $where_clause = " products_price_break_id = '" . (int)$_POST['products_price_break_id'][$pbb_cg_id][$key1] . "'";
        }
        tep_db_perform(TABLE_PRODUCTS_PRICE_BREAK, $sql_price_break_data_array, $pb_action, $where_clause);
      } // end if/else (!tep_not_null($products_price))
    } // end foreach ($price_break_array as $key1 => $products_price)
  } // end foreach ($_POST['products_price_break'] as $pbb_cg_id => $price_break_array)

// delete the unwanted price breaks using their products_price_break_id's
    if (isset($delete_from_ppb_array) && sizeof($delete_from_ppb_array > 0) && tep_not_null($delete_from_ppb_array[0])) {
      tep_db_query("delete from " . TABLE_PRODUCTS_PRICE_BREAK . " where products_price_break_id in (" . implode(',', $delete_from_ppb_array) . ")");
    }
// EOF entries in products_price_break
// EOF QPBPP for SPPC

          $languages = tep_get_languages();
          for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
            $language_id = $languages[$i]['id'];

            $sql_data_array = array('products_name' => tep_db_prepare_input($_POST['products_name'][$language_id]),
// BOF Open Featured Sets
                                    'products_short' => tep_db_prepare_input($_POST['products_short'][$language_id]),
// EOF Open Featured Sets
                                    'products_description' => tep_db_prepare_input($_POST['products_description'][$language_id]),
// BOF: Tabs by PGM
									'tab1' => tep_db_prepare_input($_POST['tab1'][$language_id]),
									'tab2' => tep_db_prepare_input($_POST['tab2'][$language_id]),
									'tab3' => tep_db_prepare_input($_POST['tab3'][$language_id]),
									'tab4' => tep_db_prepare_input($_POST['tab4'][$language_id]),
									'tab5' => tep_db_prepare_input($_POST['tab5'][$language_id]),
									'tab6' => tep_db_prepare_input($_POST['tab6'][$language_id]),
// EOF: Tabs by PGM
                                    'products_url' => tep_db_prepare_input($_POST['products_url'][$language_id]));

 // BOF: Extra Product Fields
            foreach ($epf as $e) {
              if ($e['language'] == $language_id) {
                if ($e['language_active']) {
                  if ($e['multi_select']) {
                    if (empty($_POST[$e['field']][$language_id])) {
                      $value = 'null';
                    } else {
                      //validate multi-select values in case JavaScript was turned off and couldn't prevent errors
                      $value_list = $_POST[$e['field']][$language_id];
                      if ($e['linked']) { // validate linked values if field is linked
                        $link_validated_list = array();
                        $lv = 0;
                        foreach ($epf as $lf) {
                          if ($lf['id'] == $e['links_to']) {
                            $lv = (int)$_POST[$lf['field']][$language_id];
                          }
                        }
                        $validation_query_raw = 'select value_id from ' . TABLE_EPF_VALUES . ' where epf_id = ' . (int)$e['id'] . ' and languages_id = ' . (int)$e['language'] . ' and ';
                        if ($lv == 0) {
                          $validation_query_raw .= 'value_depends_on = 0';
                        } else {
                          $validation_query_raw .= '(value_depends_on in (0,' . get_parent_list($lv) . '))';
                        }
                        $validation_query = tep_db_query($validation_query_raw);
                        $valid_values = array();
                        while ($valid = tep_db_fetch_array($validation_query)) {
                          $valid_values[] = $valid['value_id'];
                        }
                        foreach ($value_list as $v) {
                          if (in_array($v, $valid_values)) $link_validated_list[] = $v;
                        }
                      } else {
                        $link_validated_list = $value_list;
                      }
                      $validated_value_list = array(); // validate excluded values
                      $excluded_values = array();
                      foreach ($link_validated_list as $v) {
                        if (!in_array($v, $excluded_values)) {
                          $validated_value_list[] = $v;
                          $tmp = get_exclude_list($v);
                          $excluded_values = array_merge($excluded_values, $tmp);
                        }
                      }
                      $value = '|';
                      $sort_query = tep_db_query('select value_id from ' . TABLE_EPF_VALUES . ' where epf_id = ' . (int)$e['id'] . ' and languages_id = ' . (int)$e['language'] . ' order by sort_order, epf_value');
                      while ($val = tep_db_fetch_array($sort_query)) { // store input values in sorted order
                        if (in_array($val['value_id'], $validated_value_list))
                          $value .= tep_db_prepare_input($val['value_id']) . '|';
                      }
                    }
                  } else {
                    $value = tep_db_prepare_input($_POST[$e['field']][$language_id]);
                    if ($value == '')
                      $value = (($e['uses_list'] && !$e['multi_select']) ? 0 : 'null');
                  }
                  $extra = array($e['field'] => $value);
                } else {
                  $extra = array($e['field'] => (($e['uses_list'] && !$e['multi_select']) ? 0 : 'null'));
                }
                $sql_data_array = array_merge($sql_data_array, $extra);
              }
            }
// EOF: Extra Product Fields

            if ($action == 'insert_product') {
              $insert_sql_data = array('products_id' => $products_id,
                                       'language_id' => $language_id);

              $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

              tep_db_perform(TABLE_PRODUCTS_DESCRIPTION, $sql_data_array);
            } elseif ($action == 'update_product') {
              tep_db_perform(TABLE_PRODUCTS_DESCRIPTION, $sql_data_array, 'update', "products_id = '" . (int)$products_id . "' and language_id = '" . (int)$language_id . "'");
            }
          }

          if (USE_CACHE == 'true') {
            tep_reset_cache_block('categories');
            tep_reset_cache_block('also_purchased');
          }
// BOF instant update  redirect not needed + it stops messages.
//          tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products_id));
// EOF instant update

        }
        break;
      case 'copy_to_confirm':
        if (isset($_POST['products_id']) && isset($_POST['categories_id'])) {
          $products_id = tep_db_prepare_input($_POST['products_id']);
          $categories_id = tep_db_prepare_input($_POST['categories_id']);

          if ($_POST['copy_as'] == 'link') {
            if ($categories_id != $current_category_id) {
              $check_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$products_id . "' and categories_id = '" . (int)$categories_id . "'");
              $check = tep_db_fetch_array($check_query);
              if ($check['total'] < '1') {
                tep_db_query("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_id) values ('" . (int)$products_id . "', '" . (int)$categories_id . "')");
              }
            } else {
              $messageStack->add_session(ERROR_CANNOT_LINK_TO_SAME_CATEGORY, 'error');
            }
          } elseif ($_POST['copy_as'] == 'duplicate') {
// LINE MODED: Added "products_ship_price and dimensions for upsxml"
// LINE MODED: Separate Pricing Per Customer adapted for QPBPP for SPPC v4.2
// LINE MODED: Open Feature Sets: Added "products_featured, products_featured_until"
            $product_query = tep_db_query("select products_ship_price, products_quantity, products_model, products_image, products_price, products_date_available, products_weight, products_length, products_width, products_height, products_ready_to_ship, products_tax_class_id, manufacturers_id, products_qty_blocks, products_min_order_qty, products_featured, products_featured_until from " . TABLE_PRODUCTS . " where products_id = '" . (int)$products_id . "'");
            $product = tep_db_fetch_array($product_query);

// LINE CHANGED: MS2 update 501112 - Added :(empty($product['products_date_available']) ? "null" : ...{some code}... ") . "
// LINE MODED: Added "products_ship_price and dimensions for upsxml"
// LINE MODED: Separate Pricing Per Customer adapted for QPBPP for SPPC v4.2
// LINE MODED: Open Feature Sets: Added "products_featured, products_featured_until"
            tep_db_query("insert into " . TABLE_PRODUCTS . " (products_quantity, products_model, products_ship_price, products_image, products_price, products_date_added, products_date_available, products_weight, products_length, products_width, products_height, products_ready_to_ship, products_status, products_tax_class_id, manufacturers_id, products_qty_blocks, products_min_order_qty, products_featured, products_featured_until) values ('" . tep_db_input($product['products_quantity']) . "', '" . tep_db_input($product['products_model']) . "', '" . $product['products_ship_price'] . "', '" . tep_db_input($product['products_image']) . "', '" . tep_db_input($product['products_price']) . "',  now(), " . (empty($product['products_date_available']) ? "null" : "'" . tep_db_input($product['products_date_available']) . "'") . ", '" . tep_db_input($product['products_weight']) . "', '" . $product['products_length'] . "', '" . $product['products_width'] . "', '" . $product['products_height']. "', '" . $product['products_ready_to_ship'] . "', '0', '" . (int)$product['products_tax_class_id'] . "', '" . (int)$product['manufacturers_id'] . "', '" . (int)$product['products_qty_blocks'] . "', '" . (int)$product['products_min_order_qty'] . "', '" . (int)$product['products_featured'] . "', '" . (int)$product['products_featured_until'] . "')");
            $dup_products_id = tep_db_insert_id();

// Tabs by PGM LINE EDIT
// LINE MODED: Open Feature Sets: Added "products_short"
            $description_query = tep_db_query("select language_id, products_name, products_description, products_short, tab1, tab2, tab3, tab4, tab5, tab6, products_url from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$products_id . "'");
//          $description_query = tep_db_query("select language_id, products_name, products_description, products_url from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$products_id . "'");
            while ($description = tep_db_fetch_array($description_query)) {
// Tabs by PGM LINE EDIT
// LINE MODED: Open Feature Sets: Added "products_short"
              tep_db_query("insert into " . TABLE_PRODUCTS_DESCRIPTION . " (products_id, language_id, products_name, products_description, products_short, tab1, tab2, tab3, tab4, tab5, tab6, products_url, products_viewed) values ('" . (int)$dup_products_id . "', '" . (int)$description['language_id'] . "', '" . tep_db_input($description['products_name']) . "', '" . tep_db_input($description['products_description']) . "', '" . tep_db_input($description['products_short']) . "', '" . tep_db_input($description['tab1']) . "', '" . tep_db_input($description['tab2']) . "', '" . tep_db_input($description['tab3']) . "', '" . tep_db_input($description['tab4']) . "', '" . tep_db_input($description['tab5']) . "', '" . tep_db_input($description['tab6']) . "', '" . tep_db_input($description['products_url']) . "', '0')");
//	      tep_db_query("insert into " . TABLE_PRODUCTS_DESCRIPTION . " (products_id, language_id, products_name, products_description, products_url, products_viewed) values ('" . (int)$dup_products_id . "', '" . (int)$description['language_id'] . "', '" . tep_db_input($description['products_name']) . "', '" . tep_db_input($description['products_description']) . "', '" . tep_db_input($description['products_url']) . "', '0')");
            }

            tep_db_query("insert into " . TABLE_PRODUCTS_TO_CATEGORIES . " (products_id, categories_id) values ('" . (int)$dup_products_id . "', '" . (int)$categories_id . "')");
            $products_id = $dup_products_id;

// BOF Separate Pricing Per Customer originally 2006-04-26 by Infobroker
      $cg_price_query = tep_db_query("select customers_group_id, customers_group_price from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . $products_id . "' order by customers_group_id");

// insert customer group prices in table products_groups when there are any for the copied product
    if (tep_db_num_rows($cg_price_query) > 0) {
      while ( $cg_prices = tep_db_fetch_array($cg_price_query)) {
        tep_db_query("insert into " . TABLE_PRODUCTS_GROUPS . " (customers_group_id, customers_group_price, products_id) values ('" . (int)$cg_prices['customers_group_id'] . "', '" . tep_db_input($cg_prices['customers_group_price']) . "', '" . (int)$dup_products_id . "')");
      } // end while ( $cg_prices = tep_db_fetch_array($cg_price_query))
    } // end if (tep_db_num_rows($cg_price_query) > 0)

// EOF Separate Pricing Per Customer originally 2006-04-26 by Infobroker


          }

          if (USE_CACHE == 'true') {
            tep_reset_cache_block('categories');
            tep_reset_cache_block('also_purchased');
          }
        }

        tep_redirect(tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $categories_id . '&pID=' . $products_id));
        break;
//      case 'new_product_preview':
// section moved, instant update
    }
  }

// check if the catalog image directory exists
  if (is_dir(DIR_FS_CATALOG_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR)) {
    if (!is_writeable(DIR_FS_CATALOG_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR)) $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE, 'error');
  } else {
    $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST, 'error');
  }
  if (is_dir(DIR_FS_CATALOG_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR)) {
    if (!is_writeable(DIR_FS_CATALOG_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR)) $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE, 'error');
  } else {
    $messageStack->add(ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST, 'error');
  }
  //++++ QT Pro: Begin Changed code
  if($product_investigation['any_problems']){
  	$messageStack->add('<b>Warning: </b>'. qtpro_doctor_formulate_product_investigation($product_investigation, 'short_suggestion') ,'warning');
  }
  //++++ QT Pro: End Changed code
?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">

<?php
 	// BOF Open Featured Sets
?>
<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>
<script type="text/javascript"><!--
var CategoriesFeaturedUntil = new ctlSpiffyCalendarBox("CategoriesFeaturedUntil", "newcategory", "categories_featured_until","btnDate1","<?php echo $cInfo->categories_featured_until; ?>", scBTNMODE_CUSTOMBLUE);
//--></script>
<script type="text/javascript"><!--
var CategoriesEditFeaturedUntil = new ctlSpiffyCalendarBox("CategoriesEditFeaturedUntil", "categories", "categories_featured_until","btnDate1","<?php echo $cInfo->categories_featured_until; ?>", scBTNMODE_CUSTOMBLUE);
//--></script>
<?php
 	// EOF Open Featured Sets
?>

<script type="text/javascript" src="includes/general.js"></script>
<!-- CKeditor -->
<script type="text/javascript" src="<?php echo DIR_WS_INCLUDES . 'javascript/ckeditor/ckeditor.js'?>"></script>
<!-- CKeditor End -->
<!-- AJAX Attribute Manager  -->
<?php require_once( 'attributeManager/includes/attributeManagerHeader.inc.php' )?>
<!-- AJAX Attribute Manager  end -->
<!--// SLIMBOX2 -->
	<link rel="stylesheet" href="../slimbox2/slimbox2.css" type="text/css" media="screen">
    <script type="text/javascript" src="../slimbox2/jquery.js"></script>
	<script type="text/javascript" src="../slimbox2/slimbox2.js"></script>
<!--// SLIMBOX2 -->
<?php 
// BOF: Extra Product Fields
if ($action == 'new_product') {
  foreach ($epf as $e) {
    if ($e['language_active']) {
      if ($e['multi_select']) {
        echo '<script language="javascript" type="text/javascript">' . "\n";
        echo "function process_" . $e['field'] . '_' . $e['language'] . "(id) {\n";
        echo "  var thisbox = document.getElementById('ms' + id);\n";
        echo "  if (thisbox.checked) {\n";
        echo "    switch (id) {\n";
        foreach ($e['values'] as $val) {
          $el = get_exclude_list($val);
          if (!empty($el)) {
            echo "      case " . $val . ":\n";
            foreach($el as $i) {
              echo "        var cb = document.getElementById('ms" . $i . "');\n";
              echo "        cb.checked = false;\n";
            }
            echo "        break;\n";
          }
        }
        echo "      default: ;\n";
        echo "    }\n";
        echo "  }\n";
        echo "}\n";
        echo "</script>\n";
      } elseif ($e['uses_list'] && $e['linked']) {
        echo '<script language="javascript" type="text/javascript">' . "\n";
        if ($e['checkbox']) {
          echo "function process_" . $e['field'] . '_' . $e['language'] . "(id) {\n";
        } else {
          echo "function process_" . $e['field'] . '_' . $e['language'] . "() {\n";
          echo "  var id = document.getElementById('lv" . $e['id'] . '_' . $e['language'] . "').value;\n";
        }
        if (!empty($link_groups[$e['id']][$e['language']])) {
          foreach ($link_groups[$e['id']][$e['language']] as $val) {
            echo "  var lf = document.getElementById('lf" . $e['id'] . '_' . $e['language'] . '_' . $val . "');\n";
            echo "  lf.style.display = 'none'; lf.disabled = true;\n";
            foreach ($linked_fields[$e['id']][$e['language']][$val] as $id) {
              echo "  document.getElementById('ms" . $id . "').disabled = true;\n";
            }
          }
          foreach ($link_groups[$e['id']][$e['language']] as $val) {
            echo "  if (";
            $first = true;
            $enables = '';
            foreach(get_children($val) as $x) {
              if ($first) {
                $first = false;
              } else {
                echo ' || ';
              }
              echo '(id == ' . $x . ')';
            }
            echo ") {\n";
            echo "    var lf = document.getElementById('lf" . $e['id'] . '_' . $e['language'] . '_' . $val . "');\n";
            echo "    lf.style.display = ''; lf.disabled = false;\n";
            foreach ($linked_fields[$e['id']][$e['language']][$val] as $id) {
              $enables .= "    document.getElementById('ms" . $id . "').disabled = false;\n";
            }
            echo $enables;
            echo "  }\n";
          }
          foreach ($linked_fields[$e['id']][$e['language']] as $group) {
            foreach ($group as $id) {
              echo "  var lv = document.getElementById('ms" . $id . "');\n";
              echo "  if (lv.disabled == true) { lv.checked = false; }\n";
            }
          }
        }
        echo "}\n";
        echo "</script>\n";
      }
    }
  }
} // EOF: Extra Product Fields
?>
</head>
<body onLoad="goOnLoad();">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
<?php // BOF: MOD  new_category / edit_category (when ALLOW_CATEGORY_DESCRIPTIONS is 'true')
//    <td width="100%" valign="top">
//  if ($action == 'new_product') {
?>
       <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
  <?php   //----- new_category / edit_category (when ALLOW_CATEGORY_DESCRIPTIONS is 'true') -----
  if (isset($_GET['action']) && ($_GET['action'] == 'new_category_ACD' ||  $_GET['action'] == 'edit_category_ACD')) {
    if ( ($_GET['cID']) && (!$_POST) ) {
      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, cd.categories_heading_title, cd.categories_description, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified, c.categories_featured, c.categories_featured_until from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . $_GET['cID'] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . $languages_id . "' order by c.sort_order, cd.categories_name");
      $category = tep_db_fetch_array($categories_query);

      $cInfo = new objectInfo($category);
    } elseif ($_POST) {
      $cInfo = new objectInfo($_POST);
      $categories_name = $_POST['categories_name'];
      $categories_heading_title = $_POST['categories_heading_title'];
      $categories_description = $_POST['categories_description'];
      $categories_url = $_POST['categories_url'];
    } else {
      $cInfo = new objectInfo(array());
    }

    $languages = tep_get_languages();

    $text_new_or_edit = ($_GET['action']=='new_category_ACD') ? TEXT_INFO_HEADING_NEW_CATEGORY : TEXT_INFO_HEADING_EDIT_CATEGORY;
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo sprintf($text_new_or_edit, tep_output_generated_category_path($current_category_id)); ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr><?php echo tep_draw_form('new_category', FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $_GET['cID'] . '&action=new_category_preview', 'post', 'enctype="multipart/form-data"'); ?>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
          	<td colspan="2">
            <div id="categorytabs">
      	    <ul>
				<?php for ($i=0; $i<sizeof($languages); $i++) { ?>
                    <li>
                      <a href="#categorytabs-<?php echo $i ?>">
                         <?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>
                      </a>
                    </li>
                <?php } ?>
  			</ul>

            <?php for ($i=0; $i<sizeof($languages); $i++) { ?>
                <div id="categorytabs-<?php echo $i ?>">
                <table width="100%">
                	<tr>
            			<td class="main"><?php echo TEXT_EDIT_CATEGORIES_NAME; ?></td>
            			<td class="main"><?php echo tep_draw_input_field('categories_name[' . $languages[$i]['id'] . ']', (($categories_name[$languages[$i]['id']]) ? stripslashes($categories_name[$languages[$i]['id']]) : tep_get_category_name($cInfo->categories_id, $languages[$i]['id']))); ?></td>
          			</tr>
					<tr>
            			<td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          			</tr>
                    <tr>
            			<td class="main"><?php echo TEXT_EDIT_CATEGORIES_HEADING_TITLE; ?></td>
            			<td class="main"><?php echo tep_draw_input_field('categories_heading_title[' . $languages[$i]['id'] . ']', (($categories_name[$languages[$i]['id']]) ? stripslashes($categories_name[$languages[$i]['id']]) : tep_get_category_heading_title($cInfo->categories_id, $languages[$i]['id']))); ?></td>
          			</tr>
                    <tr>
            			<td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          			</tr>
                    <tr>
            			<td class="main" valign="top"><?php echo TEXT_EDIT_CATEGORIES_DESCRIPTION; ?></td>
            			<td><table border="0" cellspacing="0" cellpadding="0">
              				<tr>
                				<td class="main" valign="top"></td>
                				<td class="main">
                				<?php if(HTML_AREA_WYSIWYG_DISABLE == 'Enable') {
							   echo tep_draw_textarea_field('categories_description[' . $languages[$i]['id'].']','soft','70','15',(isset($categories_description[$languages[$i]['id']]) ? $categories_description[$languages[$i]['id']] : tep_get_category_description($cInfo->categories_id, $languages[$i]['id'])),'id = category_description[' . $languages[$i]['id'] . '] class="ckeditor"') . '</td>';
			                  } else { echo tep_draw_textarea_field('categories_description[' . $languages[$i]['id'].']','soft','70','15',(isset($categories_description[$languages[$i]['id']]) ? $categories_description[$languages[$i]['id']] : tep_get_category_description($cInfo->categories_id, $languages[$i]['id']))) . '</td>';
            				    } // EOF: CKeditor
                				?>
              				</tr>
             			</table></td>
          			</tr>
                    </table>
                	</div>
            <?php } ?>
            </div>
            </td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
          <tr>
            <td class="main">
           	<?php // EOF Open Featured Sets
 			  echo  TEXT_CATEGORIES_FEATURED . '</td><td class="main">' . tep_draw_separator('pixel_trans.gif', '24', '15') . tep_draw_radio_field('categories_featured', '1', $in_fc_status) . '&nbsp;' . TEXT_CATEGORIES_YES . '&nbsp;' . tep_draw_radio_field('categories_featured', '0', $out_fc_status) . '&nbsp;' . TEXT_CATEGORIES_NO; ?>
            </td>
          </tr>
		  <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php
   			  echo TEXT_CATEGORIES_FEATURED_DATE . '<small>(YYYY-MM-DD)</small></td><td class="main">' . tep_draw_separator('pixel_trans.gif', '24', '15') . tep_draw_input_field('categories_featured_until', $cInfo->categories_featured_until, 'id="categories_featured_until"'); ?></td>
            <?php // EOF Open Featured Sets ?>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <?php // BOF SPPC hide products and categories from groups
        	  echo '<td class="main"> ' . TEXT_HIDE_CATEGORIES_FROM_GROUPS . '</td><td>';
         		for ($i = 0; $i < count($customers_groups); $i++) {
            		echo tep_draw_checkbox_field('hide_cat[' . $customers_groups[$i]['id'] . ']',  $customers_groups[$i]['id'] , (in_array($customers_groups[$i]['id'], $hide_cat_from_groups_array)) ? 1: 0) . '&#160;&#160;' . $customers_groups[$i]['text'];
          		}
		  	  echo '</td>';

				  // EOF SPPC hide products and categories from groups ?>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_EDIT_CATEGORIES_IMAGE; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_file_field('categories_image') . '<br>' . tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . $cInfo->categories_image . tep_draw_hidden_field('categories_previous_image', $cInfo->categories_image); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_EDIT_SORT_ORDER; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('sort_order', $cInfo->sort_order, 'size="2"'); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main" align="right"><?php echo tep_draw_hidden_field('categories_date_added', (($cInfo->date_added) ? $cInfo->date_added : date('Y-m-d'))) . tep_draw_hidden_field('parent_id', $cInfo->parent_id) . tep_image_submit('button_preview.gif', IMAGE_PREVIEW) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $_GET['cID']) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
      </form></tr>
<?php

  //----- new_category_preview (active when ALLOW_CATEGORY_DESCRIPTIONS is 'true') -----
  } elseif (isset($_GET['action']) && ($_GET['action'] == 'new_category_preview')) {
    if ($_POST) {
      $cInfo = new objectInfo($_POST);
      $categories_name = $_POST['categories_name'];
      $categories_heading_title = $_POST['categories_heading_title'];
      $categories_description = $_POST['categories_description'];

// copy image only if modified
        $categories_image = new upload('categories_image');
        $categories_image->set_destination(DIR_FS_CATALOG_IMAGES . CATEGORY_IMAGES_DIR);
        if ($categories_image->parse() && $categories_image->save()) {
          $categories_image_name = $categories_image->filename;
        } else {
        $categories_image_name = $_POST['categories_previous_image'];
      }
#     if ( ($categories_image != 'none') && ($categories_image != '') ) {
#       $image_location = DIR_FS_CATALOG_IMAGES . $categories_image_name;
#       if (file_exists($image_location)) @unlink($image_location);
#       copy($categories_image, $image_location);
#     } else {
#       $categories_image_name = $_POST['categories_previous_image'];
#     }
    } else {
      $category_query = tep_db_query("select c.categories_id, cd.language_id, cd.categories_name, cd.categories_heading_title, cd.categories_description, c.categories_image, c.sort_order, c.date_added, c.last_modified from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id and c.categories_id = '" . $_GET['cID'] . "'");
      $category = tep_db_fetch_array($category_query);

      $cInfo = new objectInfo($category);
      $categories_image_name = $cInfo->categories_image;
    }

    $form_action = ($_GET['cID']) ? 'update_category' : 'insert_category';

    echo tep_draw_form($form_action, FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $_GET['cID'] . '&action=' . $form_action, 'post', 'enctype="multipart/form-data"');

    $languages = tep_get_languages();
    for ($i=0; $i<sizeof($languages); $i++) {
      if ($_GET['read'] == 'only') {
        $cInfo->categories_name = tep_get_category_name($cInfo->categories_id, $languages[$i]['id']);
        $cInfo->categories_heading_title = tep_get_category_heading_title($cInfo->categories_id, $languages[$i]['id']);
        $cInfo->categories_description = tep_get_category_description($cInfo->categories_id, $languages[$i]['id']);
      } else {
        $cInfo->categories_name = tep_db_prepare_input($categories_name[$languages[$i]['id']]);
        $cInfo->categories_heading_title = tep_db_prepare_input($categories_heading_title[$languages[$i]['id']]);
        $cInfo->categories_description = tep_db_prepare_input($categories_description[$languages[$i]['id']]);
      }
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . $cInfo->categories_heading_title; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><?php echo tep_image(DIR_WS_CATALOG_IMAGES . CATEGORY_IMAGES_DIR . $categories_image_name, $cInfo->categories_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'align="right" hspace="5" vspace="5"') . $cInfo->categories_description; ?></td>
      </tr>

<?php
    }
    if ($_GET['read'] == 'only') {
      if ($_GET['origin']) {
        $pos_params = strpos($_GET['origin'], '?', 0);
        if ($pos_params != false) {
          $back_url = substr($_GET['origin'], 0, $pos_params);
          $back_url_params = substr($_GET['origin'], $pos_params + 1);
        } else {
          $back_url = $_GET['origin'];
          $back_url_params = '';
        }
      } else {
        $back_url = FILENAME_CATEGORIES;
        $back_url_params = 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id;
      }
?>
      <tr>
        <td align="right"><?php echo '<a href="' . tep_href_link($back_url, $back_url_params, 'NONSSL') . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
      </tr>
<?php
    } else {
?>
      <tr>
        <td align="right" class="smallText">
<?php
/* Re-Post all POST'ed variables */
      reset($_POST);
      while (list($key, $value) = each($_POST)) {
        if (!is_array($_POST[$key])) {
          echo tep_draw_hidden_field($key, htmlspecialchars(stripslashes($value)));
        }
      }
      $languages = tep_get_languages();
      for ($i=0; $i<sizeof($languages); $i++) {
        echo tep_draw_hidden_field('categories_name[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($categories_name[$languages[$i]['id']])));
        echo tep_draw_hidden_field('categories_heading_title[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($categories_heading_title[$languages[$i]['id']])));
        echo tep_draw_hidden_field('categories_description[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($categories_description[$languages[$i]['id']])));
      }
      echo tep_draw_hidden_field('X_categories_image', stripslashes($categories_image_name));
      echo tep_draw_hidden_field('categories_image', stripslashes($categories_image_name));

      echo tep_image_submit('button_back.gif', IMAGE_BACK, 'name="edit"') . '&nbsp;&nbsp;';

      if ($_GET['cID']) {
        echo tep_image_submit('button_update.gif', IMAGE_UPDATE);
      } else {
        echo tep_image_submit('button_insert.gif', IMAGE_INSERT);
      }
      echo '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $_GET['cID']) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>';
?></td>
      </form></tr>
<?php
    }

  } elseif ($action == 'new_product') {
// EOF: MOD  new_category / edit_category (when ALLOW_CATEGORY_DESCRIPTIONS is 'true')
    $parameters = array('products_name' => '',
                       'products_description' => '',
// BOF Open Featured Sets
                       'products_short' => '',
// EOF Open Featured Sets
// BOF: Tabs by PGM
                       'tab1' => '',
                       'tab2' => '',
                       'tab3' => '',
                       'tab4' => '',
                       'tab5' => '',
                       'tab6' => '',
// EOF: Tabs by PGM
                       'products_url' => '',
                       'products_id' => '',
                       'products_quantity' => '',
                       'products_model' => '',
                       'products_image' => '',
                       'products_price' => '',
// BOF QPBPP for SPPC
                       'products_qty_blocks' => '',
                       'products_min_order_qty' => '',
// EOF QPBPP for SPPC
                       'products_weight' => '',
                       'products_length' => '',
                       'products_width' => '',
                       'products_height' => '',
                       'products_ready_to_ship' => '',
                       'products_date_added' => '',
                       'products_last_modified' => '',
                       'products_date_available' => '',
// BOF Open Featured Sets
                       'products_featured' => '',
                       'products_featured_until' => '',
// EOF Open Featured Sets
                       'products_status' => '',
                       'products_tax_class_id' => '',
// BOF SPPC hide from groups mod
                       'products_hide_from_groups' => '',
// EOF SPPC hide from groups mod
                       'manufacturers_id' => '');

// BOF: Extra Product Fields
    foreach ($xfields as $f) {
      $parameters = array_merge($parameters, array($f => ''));
    }
// EOF: Extra Product Fields

    $pInfo = new objectInfo($parameters);

    if (isset($_GET['pID']) && empty($_POST)) { // BOF SPPC hide from groups mod
//LINE MODED: Added "p.products_ship_price"
//    $product_query = tep_db_query("select p.products_ship_price, pd.products_name, pd.products_description, pd.products_url, p.products_id, p.products_quantity, p.products_model, p.products_image, p.products_price, p.products_weight, products_length, products_width, products_height, products_ready_to_ship, p.products_date_added, p.products_last_modified, date_format(p.products_date_available, '%Y-%m-%d') as products_date_available, p.products_status, p.products_tax_class_id,                              p.manufacturers_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . (int)$_GET['pID'] . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'");
//LINE MODED: SPPC hide from groups mod & Tabs by PGM
// LINE MODED: Separate Pricing Per Customer adapted for QPBPP for SPPC v4.2
// LINE MODED: Open Feature Sets : Added ", p.products_featured, p.products_featured_until"
// BOF: Extra Product Fields
//	  $product_query = tep_db_query("select p.products_ship_price, pd.products_name, pd.products_description, pd.tab1, pd.tab2, pd.tab3, pd.tab4, pd.tab5, pd.tab6, pd.products_url, p.products_id, p.products_quantity, p.products_model, p.products_image, p.products_price, p.products_qty_blocks, p.products_min_order_qty, p.products_weight, products_length, products_width, products_height, products_ready_to_ship, p.products_date_added, p.products_last_modified, date_format(p.products_date_available, '%Y-%m-%d') as products_date_available, p.products_status, p.products_tax_class_id, p.products_hide_from_groups, p.manufacturers_id, p.products_featured, p.products_featured_until from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . (int)$_GET['pID'] . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'");

	  $query = "select p.products_ship_price, pd.products_name, pd.products_description, pd.tab1, pd.tab2, pd.tab3, pd.tab4, pd.tab5, pd.tab6, pd.products_url, p.products_id, p.products_quantity, p.products_model, p.products_image, p.products_price, p.products_qty_blocks, p.products_min_order_qty, p.products_weight, products_length, products_width, products_height, products_ready_to_ship, p.products_date_added, p.products_last_modified, date_format(p.products_date_available, '%Y-%m-%d') as products_date_available, p.products_status, p.products_tax_class_id, p.products_hide_from_groups, p.manufacturers_id, p.products_featured, p.products_featured_until ";
	foreach ($xfields as $f) {
      $query .= ", pd." . $f;
      }
      $query .= " from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = '" . (int)$_GET['pID'] . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'";
	  $product_query = tep_db_query($query);
// EOF: Extra Product Fields

// EOF SPPC hide from groups mod
      $product = tep_db_fetch_array($product_query);

      $pInfo->objectInfo($product);

// BOF QPBPP for SPPC
// move retail settings for quantity blocks and min order qty to an array indexed
// by customer_group_id, as we will get back in $_POST values
      unset($pInfo->products_qty_blocks);
      $pInfo->products_qty_blocks[0] = $product['products_qty_blocks'];
      unset($pInfo->products_min_order_qty);
      $pInfo->products_min_order_qty[0] = $product['products_min_order_qty'];
// next is getting the group prices, products_qty_blocks, and products_min_order_qty for groups
      $cg_prices_query = tep_db_query("select customers_group_id, customers_group_price, products_qty_blocks, products_min_order_qty from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . $pInfo->products_id . "' order by customers_group_id");
      while ($cg_prices = tep_db_fetch_array($cg_prices_query)) {
// and adding them to $pInfo for later use
        if (tep_not_null($cg_prices['customers_group_price'])) {
        $pInfo->sppcprice[$cg_prices['customers_group_id']] = $cg_prices['customers_group_price'];
        }
        $pInfo->products_qty_blocks[$cg_prices['customers_group_id']] = $cg_prices['products_qty_blocks'];
        $pInfo->products_min_order_qty[$cg_prices['customers_group_id']] = $cg_prices['products_min_order_qty'];
      } // end while ($cg_prices = tep_db_fetch_array($cg_prices_query))

      $price_breaks_array = array();
      $price_breaks_query = tep_db_query("select products_price_break_id, products_price, products_qty, customers_group_id from " . TABLE_PRODUCTS_PRICE_BREAK . " where products_id = '" . tep_db_input($pInfo->products_id) . "' order by customers_group_id, products_qty");
      while ($price_break = tep_db_fetch_array($price_breaks_query)) {
        $pInfo->products_price_break[$price_break['customers_group_id']][] = $price_break['products_price'];
        $pInfo->products_qty[$price_break['customers_group_id']][] = $price_break['products_qty'];
        $pInfo->products_price_break_id[$price_break['customers_group_id']][] = $price_break['products_price_break_id'];
      }
      $product_discount_categories = array();
      $products_discount_query = tep_db_query("select customers_group_id, discount_categories_id from " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " where products_id = '" . tep_db_input($pInfo->products_id) . "' order by customers_group_id");
      while ($products_discount_results = tep_db_fetch_array($products_discount_query)) {
        $pInfo->discount_categories_id[$products_discount_results['customers_group_id']] = $products_discount_results['discount_categories_id'];
      }
// EOF QPBPP for SPPC

    } elseif (tep_not_null($_POST)) {
      $pInfo->objectInfo($_POST);
      $products_name = $_POST['products_name'];
// BOF Open Featured Sets
      $products_short = $_POST['products_short'];
// EOF Open Featured Sets
      $products_description = $_POST['products_description'];
// BOF: Tabs by PGM
      $tab1 = $_POST['tab1'];
      $tab2 = $_POST['tab2'];
      $tab3 = $_POST['tab3'];
      $tab4 = $_POST['tab4'];
      $tab5 = $_POST['tab5'];
      $tab6 = $_POST['tab6'];
// EOF: Tabs by PGM
      $products_url = $_POST['products_url'];
// BOF Open Featured Sets
      $products_featured = $_POST['products_featured'];
      $products_featured_until = $_POST['products_featured_until'];
// EOF Open Featured Sets
// BOF: Extra Product Fields
      $extra = array();
      foreach ($xfields as $f) {
        $extra[$f] = $_POST[$f];
      } // end for each
// EOF: Extra Product Fields
    } // end elseif

    $manufacturers_array = array(array('id' => '', 'text' => TEXT_NONE));
    $manufacturers_query = tep_db_query("select manufacturers_id, manufacturers_name from " . TABLE_MANUFACTURERS . " order by manufacturers_name");
    while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
      $manufacturers_array[] = array('id' => $manufacturers['manufacturers_id'],
                                     'text' => $manufacturers['manufacturers_name']);
    }

    $tax_class_array = array(array('id' => '0', 'text' => TEXT_NONE));
    $tax_class_query = tep_db_query("select tax_class_id, tax_class_title from " . TABLE_TAX_CLASS . " order by tax_class_title");
    while ($tax_class = tep_db_fetch_array($tax_class_query)) {
      $tax_class_array[] = array('id' => $tax_class['tax_class_id'],
                                 'text' => $tax_class['tax_class_title']);
    }

// BOF QPBPP for SPPC
    $discount_categories_array = array(array('id' => '0', 'text' => TEXT_NONE));
    $discount_categories_query = tep_db_query("select discount_categories_id, discount_categories_name from " . TABLE_DISCOUNT_CATEGORIES . " order by discount_categories_name");
    while ($discount_categories = tep_db_fetch_array($discount_categories_query)) {
      $discount_categories_array[] = array('id' => $discount_categories['discount_categories_id'],
                                           'text' => $discount_categories['discount_categories_name']);
    }
// EOF QPBPP for SPPC

    $languages = tep_get_languages();

    if (!isset($pInfo->products_status)) $pInfo->products_status = '1';
    switch ($pInfo->products_status) {
      case '0': $in_status = false; $out_status = true; break;
      case '1':
      default: $in_status = true; $out_status = false;
    }

// BOF Open Featured Sets
	if (empty($pInfo->products_featured)) $pInfo->products_featured = '0';
    switch ($pInfo->products_featured) {
      case '0': $in_f_status = false; $out_f_status = true; break;
      case '1':
      default: $in_f_status = true; $out_f_status = false;
    }
// EOF Open Featured Sets

?>

<script type="text/javascript"><!--
var tax_rates = new Array();
<?php
    for ($i=0, $n=sizeof($tax_class_array); $i<$n; $i++) {
      if ($tax_class_array[$i]['id'] > 0) {
        echo 'tax_rates["' . $tax_class_array[$i]['id'] . '"] = ' . tep_get_tax_rate_value($tax_class_array[$i]['id']) . ';' . "\n";
      }
    }
?>

function doRound(x, places) {
  return Math.round(x * Math.pow(10, places)) / Math.pow(10, places);
}

function getTaxRate() {
  var selected_value = document.forms["new_product"].products_tax_class_id.selectedIndex;
  var parameterVal = document.forms["new_product"].products_tax_class_id[selected_value].value;

  if ( (parameterVal > 0) && (tax_rates[parameterVal] > 0) ) {
    return tax_rates[parameterVal];
  } else {
    return 0;
  }
}

function updateGross() {
  var taxRate = getTaxRate();
  var grossValue = document.forms["new_product"].products_price.value;

/* BOF QPBPP for SPPC - auto-update Retail readonly price field */
  document.forms["new_product"].products_price_retail_net.value = document.forms["new_product"].products_price.value;
/* EOF QPBPP for SPPC - auto-update Retail readonly price field */

  if (taxRate > 0) {
    grossValue = grossValue * ((taxRate / 100) + 1);
  }

  document.forms["new_product"].products_price_gross.value = doRound(grossValue, 4);
}

function updateNet() {
  var taxRate = getTaxRate();
  var netValue = document.forms["new_product"].products_price_gross.value;

  if (taxRate > 0) {
    netValue = netValue / ((taxRate / 100) + 1);
  }

  document.forms["new_product"].products_price.value = doRound(netValue, 4);

/* BOF QPBPP for SPPC - auto-update Retail readonly price field */
  document.forms["new_product"].products_price_retail_net.value = document.forms["new_product"].products_price.value;
/* EOF QPBPP for SPPC - auto-update Retail readonly price field */
}
//--></script>
    <?php echo tep_draw_form('new_product', FILENAME_CATEGORIES, 'cPath=' . $cPath . (isset($_GET['pID']) ? '&pID=' . $_GET['pID'] : '') . '&action=new_product_preview', 'post', 'enctype="multipart/form-data"'); ?>
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo sprintf(TEXT_NEW_PRODUCT, tep_output_generated_category_path($current_category_id)); ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_STATUS; ?></td>
            <td class="main" colspan="2">
            <?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_radio_field('products_status', '1', $in_status) . '&nbsp;' . TEXT_PRODUCT_AVAILABLE . '&nbsp;' . tep_draw_radio_field('products_status', '0', $out_status) . '&nbsp;' . TEXT_PRODUCT_NOT_AVAILABLE .
            tep_draw_separator('pixel_trans.gif', '24', '15') . TEXT_PRODUCTS_DATE_AVAILABLE . '&nbsp;<small>(YYYY-MM-DD)</small>&nbsp;' .  tep_draw_input_field('products_date_available', $pInfo->products_date_available, 'id="product_available"'); ?>
            </td>
          </tr>
<?php
// BOF Open Featured Sets
?>
		  <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_FEATURED; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_radio_field('products_featured', '1', $in_f_status) . '&nbsp;' . TEXT_PRODUCT_YES . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . tep_draw_radio_field('products_featured', '0', $out_f_status) . '&nbsp;' . TEXT_PRODUCT_NO . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Featured Until: '; ?><small>(YYYY-MM-DD)</small>&nbsp; <?php echo tep_draw_input_field('products_featured_until', $pInfo->products_featured_until, 'id="products_featured_until"'); ?> </td>
          </tr>
<?php
// EOF Open Featured Sets
?>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_MANUFACTURER; ?></td>
            <td class="main" colspan="2">
            <?php echo tep_draw_separator('pixel_trans.gif', '24', '12') . '&nbsp;' . tep_draw_pull_down_menu('manufacturers_id', $manufacturers_array, $pInfo->manufacturers_id) .
            tep_draw_separator('pixel_trans.gif', '40', '12') . TEXT_PRODUCTS_MODEL . '&nbsp;&nbsp;' . tep_draw_input_field('products_model', $pInfo->products_model); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
<?php
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
?>
          <tr>
            <td class="main"><?php if ($i == 0) echo TEXT_PRODUCTS_NAME; ?></td>
<?php /* LINE CHANGED: MS2 update 501112 - Added: stripslashes(...) */ ?>
            <td class="main">
            <?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('products_name[' . $languages[$i]['id'] . ']', (isset($products_name[$languages[$i]['id']]) ? stripslashes($products_name[$languages[$i]['id']]) : tep_get_products_name($pInfo->products_id, $languages[$i]['id']))) .
            tep_draw_separator('pixel_trans.gif', '15', '12') ; ?>
            <?php if ($i == 0) {
                        echo TEXT_PRODUCTS_URL . TEXT_PRODUCTS_URL_WITHOUT_HTTP . tep_draw_separator('pixel_trans.gif', '30', '12');
                        } else {
                        echo tep_draw_separator('pixel_trans.gif', '140', '12');
                        }
            echo tep_draw_input_field('products_url[' . $languages[$i]['id'] . ']', (isset($products_url[$languages[$i]['id']]) ? stripslashes($products_url[$languages[$i]['id']]) : tep_get_products_url($pInfo->products_id, $languages[$i]['id']))); ?>
            </td>
          </tr>
<?php
    }
?>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr bgcolor="#ebebff">
            <td class="main"><?php echo TEXT_PRODUCTS_TAX_CLASS; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_pull_down_menu('products_tax_class_id', $tax_class_array, $pInfo->products_tax_class_id, 'onchange="updateGross()"'); ?></td>
          </tr>
          <tr bgcolor="#ebebff">
            <td class="main"><?php echo TEXT_PRODUCTS_PRICE_NET; ?><?php echo '<span title="' . HEADING_PRICE_HELP . '|' . TEXT_PRICE_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png'); ?></span></td>
            <td class="main" colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('products_price', $pInfo->products_price, 'onKeyUp="updateGross()"') .
            tep_draw_separator('pixel_trans.gif', '24', '15') . TEXT_PRODUCTS_PRICE_GROSS . '&nbsp;' . tep_draw_input_field('products_price_gross', $pInfo->products_price, 'OnKeyUp="updateNet()"'); ?></td>
          </tr>

<!-- BOF Separate Pricing Per Customer - QPBPP for SPPC - in tabbed menu -->
<?php
// the query is changed to also get the results for group 0 (retail) so that the
// results of the query can be used for others mods (like hide products, QPBPP for SPPC) too
    $customers_group_query = tep_db_query("select customers_group_id, customers_group_name from " . TABLE_CUSTOMERS_GROUPS . " order by customers_group_id");
    $header = false;
    if (!tep_db_num_rows($customers_group_query) > 0) {
      $messageStack->add_session(ERROR_ALL_CUSTOMER_GROUPS_DELETED, 'error');
   } else {
// to avoid confusion and/or duplication of code we re-use some code originally used
// for the "hide products for customers groups for sppc" mod here so both can co-exist
     while ($customers_group = tep_db_fetch_array($customers_group_query)) {
       $_hide_customers_group[] = $customers_group;
     }
   } ?>
          <tr>
            <td colspan="2">
              <div id="qpbpp" class="cgtabs">
                <ul class="tabnav"> <?php
                  foreach ($_hide_customers_group as $key => $cust_groups) {
                    echo '  <li><a href="#pricebreak-' . $cust_groups['customers_group_id'] . '">' . $cust_groups['customers_group_name'] . '</a></li>' ."\n";
                  }
                ?>
                </ul>
<?php
 foreach ($_hide_customers_group as $key => $cust_groups) {
   $CustGroupID = $cust_groups['customers_group_id'];
?>
                  <div id="pricebreak-<?php echo $CustGroupID; ?>" class="tabdiv">
                    <table border="0" width="100%">
                      <tr bgcolor="#ebebff">
                        <td class="main"><?php echo ENTRY_CUSTOMERS_GROUP_NAME ?></td>
                        <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . $cust_groups['customers_group_name']; ?></td>
                      </tr>
                      <tr bgcolor="#fffff">
                        <td class="main" colspan="2"><small><i><?php if ($CustGroupID != 0) echo TEXT_CUSTOMERS_GROUPS_NOTE; ?></i></small></td>
                      </tr>
                      <tr bgcolor="#fffff">
                        <td class="main"><?php echo TEXT_PRODUCTS_PRICE_NET ?></td>
                        <td class="main"><?php
                        if ($CustGroupID != 0) {
                          if (isset($pInfo->sppcoption)) {
                            echo tep_draw_checkbox_field('sppcoption[' . $CustGroupID . ']', 'sppcoption[' . $CustGroupID . ']', (isset($pInfo->sppcoption[$CustGroupID])) ? 1: 0);
                          } else {
                            echo tep_draw_checkbox_field('sppcoption[' . $CustGroupID . ']', 'sppcoption[' . $CustGroupID . ']', true);
                          }
                            if (isset($pInfo->sppcprice[$CustGroupID])) {
                              $sppc_cg_price = $pInfo->sppcprice[$CustGroupID];
                            } else { // nothing in the db, nothing in the post variables
                              $sppc_cg_price = '';
                            }
                            echo '&nbsp;' . tep_draw_input_field('sppcprice[' . $CustGroupID . ']', $sppc_cg_price );
                        } else {
                          echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('products_price_retail_net', $pInfo->products_price, 'readonly');
                        } // end if/else ($CustGroupID != 0) ?>
                        </td>
                      </tr>
                      <tr bgcolor="#ebebff">
                        <td class="main"><?php echo TEXT_DISCOUNT_CATEGORY ?></td>
                        <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_pull_down_menu('discount_categories_id[' . $CustGroupID . ']', $discount_categories_array, $pInfo->discount_categories_id[$CustGroupID]) . tep_draw_hidden_field('current_discount_cat_id[' . $CustGroupID . ']', (isset($pInfo->current_discount_cat_id[$CustGroupID]) ? (int)$pInfo->current_discount_cat_id[$CustGroupID] : $pInfo->discount_categories_id[$CustGroupID])); ?></td>
                      </tr>
                      <tr bgcolor="#ffffff">
                        <td class="main"><?php echo TEXT_PRODUCTS_QTY_BLOCKS; ?></td>
                        <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('products_qty_blocks[' . $CustGroupID . ']', $pInfo->products_qty_blocks[$CustGroupID], 'size="10"') . "&nbsp;" . TEXT_PRODUCTS_QTY_BLOCKS_HELP; ?></td>
                      </tr>
                      <tr bgcolor="#ebebff">
                        <td class="main"><?php echo TEXT_PRODUCTS_MIN_ORDER_QTY; ?></td>
                        <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('products_min_order_qty[' . $CustGroupID . ']', $pInfo->products_min_order_qty[$CustGroupID], 'size="10"') . "&nbsp;" . TEXT_PRODUCTS_MIN_ORDER_QTY_HELP; ?></td>
                      </tr>
<?php
    $i = 0; // for alternate coloring of rows (zebra striping)
    for ($count = 0; $count <= (PRICE_BREAK_NOF_LEVELS - 1); $count++) {
      $bgcolor = ($i++ & 1) ? '#ebebff' : '#ffffff'; // for zebra striping
?>
                      <tr bgcolor="<?php echo $bgcolor; ?>">
                        <td class="main"><?php echo TEXT_PRODUCTS_PRICE  . " " . ($count + 1); ?></td>
                        <td class="main" align="left"> <?php
                            if(is_array($pInfo->products_price_break[$CustGroupID]) && array_key_exists($count, $pInfo->products_price_break[$CustGroupID])) {
                              echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('products_price_break[' . $CustGroupID .'][' . $count . ']', $pInfo->products_price_break[$CustGroupID][$count], 'size="10"');
                              echo tep_draw_separator('pixel_trans.gif', '24', '15') . TEXT_PRODUCTS_QTY;
                              echo tep_draw_separator('pixel_trans.gif', '24', '15') . tep_draw_input_field('products_qty[' . $CustGroupID .'][' . $count . ']', $pInfo->products_qty[$CustGroupID][$count], 'size="10"');
                              echo tep_draw_hidden_field('products_price_break_id[' . $CustGroupID .'][' . $count . ']', $pInfo->products_price_break_id[$CustGroupID][$count]);
// only show a delete box for a price break that has been set (needed for when the
// back button is used after a preview
                              if (isset($pInfo->products_price_break_id[$CustGroupID][$count]) && tep_not_null($pInfo->products_price_break_id[$CustGroupID][$count])) {
                                echo tep_draw_separator('pixel_trans.gif', '24', '15') . tep_draw_checkbox_field('products_delete[' . $CustGroupID .'][' . $count . ']', 'y', (isset($pInfo->products_delete[$CustGroupID][$count]) ? 1 : 0)) . TEXT_PRODUCTS_DELETE;
                              }
                            } else {
                              echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('products_price_break[' . $CustGroupID .'][' . $count . ']', '', 'size="10"');
                              echo tep_draw_separator('pixel_trans.gif', '24', '15') . TEXT_PRODUCTS_QTY;
                              echo tep_draw_separator('pixel_trans.gif', '24', '15') . tep_draw_input_field('products_qty[' . $CustGroupID .'][' . $count . ']', '', 'size="10"');
                            } ?>
                        </td>
                      </tr>
<?php
   } // end for ($count = 0; $count <= (PRICE_BREAK_NOF_LEVELS - 1); $count++)
?>
                    </table>
                  </div>
<?php
 } // end foreach ($_hide_customers_group as $key => $cust_groups)
?>
              </div>
            </td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
<!-- EOF  Separate Pricing Per Customer - QPBPP for SPPC - in tabbed menu -->


<script type="text/javascript"><!--
updateGross();
//--></script>

<!-- AJAX Attribute Manager  -->
          <tr>
          	<td colspan="2"><?php require_once( 'attributeManager/includes/attributeManagerPlaceHolder.inc.php' )?></td>
          </tr>
<!-- AJAX Attribute Manager end -->

<!-- BOF SPPC hide from groups mod -->
          <tr>
            <td colspan="2" class="main" ><?php echo TEXT_HIDE_PRODUCTS_FROM_GROUP; ?></td>
          </tr>
<?php
   $hide_from_groups_array = explode(',',$pInfo->products_hide_from_groups);
   $hide_from_groups_array = array_slice($hide_from_groups_array, 1); // remove "@" from the array

   foreach ($_hide_customers_group as $key => $hide_customers_group) {
?>
      <tr bgcolor="#ebebff">
       <td class="main" colspan="2"><?php
      if (isset($pInfo->hide)) {
        echo tep_draw_checkbox_field('hide[' . $hide_customers_group['customers_group_id'] . ']',  $hide_customers_group['customers_group_id'] , (isset($pInfo->hide[ $hide_customers_group['customers_group_id']])) ? 1: 0);
      } else {
        echo tep_draw_checkbox_field('hide[' . $hide_customers_group['customers_group_id'] . ']',  $hide_customers_group['customers_group_id'] , (in_array($hide_customers_group['customers_group_id'], $hide_from_groups_array)) ? 1: 0);
      } ?>&#160;&#160;<?php echo $hide_customers_group['customers_group_name']; ?></td>
      </tr>
<?php
        } // end foreach ($_hide_customers_group as $key => $hide_customers_group)
?>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
<!-- EOF SPPC hide from groups mod -->
<?php
// BOF: Tabs by PGM
if(USE_PRODUCT_DESCRIPTION_TABS != 'True') {
// EOF: Tabs by PGM
?>

<?php
// BOF Open Featured Sets
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
?>
          <tr>
            <td class="main" valign="top"><?php if ($i == 0) echo TEXT_PRODUCTS_SHORT; ?></td>
            <td><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="main" valign="top"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;</td>
                <td class="main"><?php echo tep_draw_textarea_field('products_short[' . $languages[$i]['id'] . ']', 'soft', '70', '4', (isset($products_short[$languages[$i]['id']]) ? $products_short[$languages[$i]['id']] : tep_get_products_short($pInfo->products_id, $languages[$i]['id']))); ?></td>
              </tr>
            </table></td>
          </tr>
<?php
    }
// EOF Open Featured Sets
?>

<?php
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
?>
          <tr>
            <td class="main" valign="top"><?php if ($i == 0) echo TEXT_PRODUCTS_DESCRIPTION; ?></td>
            <td><table border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td class="main" valign="top"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?>&nbsp;</td>
<?php // BOF: MOD WYSIWYG Editor
/*              <td class="main"><?php echo tep_draw_textarea_field('products_description[' . $languages[$i]['id'] . ']', 'soft', '70', '15', (isset($products_description[$languages[$i]['id']]) ? $products_description[$languages[$i]['id']] : tep_get_products_description($pInfo->products_id, $languages[$i]['id']))); ?></td> */?>
                <td class="main"><?php if(HTML_AREA_WYSIWYG_DISABLE == 'Enable') {
      // BOF: MOD CKeditor
      echo tep_draw_textarea_field('products_description[' . $languages[$i]['id'] . ']', 'soft', '70', '10', (isset($products_description[$languages[$i]['id']]) ? stripslashes($products_description[$languages[$i]['id']]) : tep_get_products_description($pInfo->products_id, $languages[$i]['id'])),'id = products_description[' . $languages[$i]['id'] . '] class="ckeditor"');
      //echo tep_draw_fckeditor ('products_description[' . $languages[$i]['id'] . ']', '550', '300', (isset($products_description[$languages[$i]['id']]) ? stripslashes($products_description[$languages[$i]['id']]) : tep_get_products_description($pInfo->products_id, $languages[$i]['id']))) . '</td>';
      // EOF: MOD CKeditor

    } else {

      echo tep_draw_textarea_field('products_description[' . $languages[$i]['id'].']','soft','70','15',(isset($products_description[$languages[$i]['id']]) ? stripslashes($products_description[$languages[$i]['id']]) : tep_get_products_description($pInfo->products_id, $languages[$i]['id']))) . '</td>';
    }
// EOF: MOD WYSIWYG Editor ?>
              </tr>
            </table></td>
          </tr>
<?php
    }
?>

<?php
// BOF: Tabs by PGM
} else { include ('includes/modules/product_tabs.php'); }
// EOF: Tabs by PGM
?>

          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_QUANTITY; ?></td>
             <?php //++++ QT Pro: Begin Changed code
			if($product_investigation['has_tracked_options'] or $product_investigation['stock_entries_count'] > 0)
			{
		  	?>
			<td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;<a href="' . tep_href_link("stock.php", 'product_id=' . $pInfo->products_id) . ' " target="_blank">' . tep_image_button('button_stock.gif', "Stock") . '</a>'?></td>
			<?php

			}else{
			?>
			<td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('products_quantity', $pInfo->products_quantity); ?></td>
			<?php
			}
			//++++ QT Pro: End Changed code
		  	?>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '15'); ?></td>
          </tr>

<!-- image directory -->
          <tr>
            <td class="main" bgcolor="#DDDDDD"><?php echo TEXT_PRODUCTS_IMAGE_DIRECTORY; ?></td>
						<?php // place allowed sub-dirs in array, non-recursive
						$dir_array = array();
						if ($handle = opendir($root_images_dir)) {
								while (false !== ($file = readdir($handle))) {
								if ($file != "." && $file != "..") {
										if (is_dir($root_images_dir.$file) && !in_array($file,$exclude_folders)) $dir_array[] = preg_replace("/\/\//si", "/", $file);
								}
						}
						closedir($handle);
						sort($dir_array);
						} else { die("<center><br><br><b> " . TEXT_PRODUCTS_DIRECTORY_DONT_EXIST_1 . " (" . $root_images_dir . ") " . TEXT_PRODUCTS_DIRECTORY_DONT_EXIST_2 . "</b></center><br><br>");}
 					 $drop_array[0] = array('id' => '', 'text' => TEXT_PRODUCTS_IMAGE_ROOT_DIRECTORY);

					 foreach($dir_array as $img_dir) {
					   $drop_array[] = array('id' => $img_dir, 'text' => $img_dir);
					 }
 ?>
            <td class="main" bgcolor="#DDDDDD"><?php echo tep_draw_separator('pixel_trans.gif', '25', '15') . tep_draw_pull_down_menu('directory', $drop_array) . tep_draw_separator('pixel_trans.gif', '25', '15') . TEXT_PRODUCTS_IMAGE_NEW_FOLDER . tep_draw_separator('pixel_trans.gif', '20', '15') . tep_draw_input_field('new_directory'); ?></td>
          </tr>
          <tr>
            <td colspan="2" bgcolor="#DDDDDD"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
<!-- eof image directory -->
          <tr>
            <td class="main" bgcolor="#DDDDDD"><?php echo TEXT_PRODUCTS_IMAGE; ?></td>
            <td class="main" bgcolor="#DDDDDD"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_file_field('products_image') . '&nbsp;' . tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . $pInfo->products_image . tep_draw_hidden_field('products_previous_image', $pInfo->products_image); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo TEXT_PRODUCTS_WEIGHT; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('products_weight', $pInfo->products_weight); ?></td>
          </tr>
<?php  
// BOF: Extra Product Fields
          foreach ($epf as $e) {
        	  for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        	    if ($e['language'] == $languages[$i]['id']) {
        	      if ($e['language_active']) {
      	          $currentval = (isset($extra[$e['field']][$languages[$i]['id']]) ? stripslashes($extra[$e['field']][$languages[$i]['id']]) : tep_get_product_extra_value($e['id'], $pInfo->products_id, $languages[$i]['id']));
        	        if ($e['uses_list']) {
        	          if ($e['multi_select']) {
           	          $currentval = (isset($extra[$e['field']][$languages[$i]['id']]) ? $extra[$e['field']][$languages[$i]['id']] : explode('|', trim(tep_get_product_extra_value($e['id'], $pInfo->products_id, $languages[$i]['id']), '|')));
        	            $value_query = tep_db_query('select value_id, value_depends_on from ' . TABLE_EPF_VALUES . ' where epf_id = ' . (int) $e['id'] . ' and languages_id = ' . (int)$e['language'] . ' order by value_depends_on, sort_order, epf_value');
        	            $epfvals = array(array());
        	            while ($val = tep_db_fetch_array($value_query)) {
        	              $epfvals[$val['value_depends_on']][] = $val['value_id'];
        	            }
        	            $inp = '';
        	            if ($e['linked']) {
        	              $tmp =  (isset($extra['extra_value_id' . $e['links_to']][$languages[$i]['id']]) ? stripslashes($extra['extra_value_id' . $e['links_to']][$languages[$i]['id']]) : tep_get_product_extra_value($e['links_to'], $pInfo->products_id, $languages[$i]['id']));
        	              $tmp = get_parent_list($tmp);
        	              $current_linked_val = explode(',', $tmp);
        	            } else {
        	              $current_linked_val = array(0);
        	            }
        	            foreach ($epfvals as $key => $vallist) {
                        $col = 0;
                        if ($e['linked']) {
                          $tparms = ' id="lf' . $e['links_to'] . '_' . $languages[$i]['id'] . '_' . $key . '"';
                          if (($key != 0) && !in_array($key, $current_linked_val))
                            $tparms .= ' style="display: none" disabled';
                        } else {
                          $tparms = '';
                        }
                        $inp .= '<table' . $tparms . '><tr>';
                        foreach ($vallist as $value) {
                          $col++;
                          if ($col > $e['columns']) {
                            $inp .= '</tr><tr>';
                            $col = 1;
                          }
                          $inp .= '<td>' . tep_draw_checkbox_field($e['field'] . "[" . $languages[$i]['id'] . "][]", $value, in_array($value, $currentval), '', 'onClick="process_' . $e['field'] . '_' . $e['language'] . '(' . $value . ')" id="ms' . $value . '"') . '</td><td>' . ($value == '0' ? TEXT_NOT_APPLY : tep_get_extra_field_list_value($value, false, $e['display_type'])) . '<td><td>&nbsp;</td>';
                        }
                        $inp .= '</tr></table>';
        	            }
        	          } else {
          	          $epfvals = tep_build_epf_pulldown($e['id'], $languages[$i]['id'], array(array('id' => 0, 'text' => TEXT_NOT_APPLY)));
          	          if ($e['checkbox']) {
                        $col = 0;
                        $inp = '<table><tr>';
                        foreach ($epfvals as $value) {
                          $col++;
                          if ($col > $e['columns']) {
                            $inp .= '</tr><tr>';
                            $col = 1;
                          }
                          $inp .= '<td>' . tep_draw_radio_field($e['field'] . "[" . $languages[$i]['id'] . "]", $value['id'], false, $currentval, ($e['linked'] ? 'onClick="process_' . $e['field'] . '_' . $e['language'] . '(' . $value['id'] . ')"' : '')) . '</td><td>' . ($value['id'] == '0' ? TEXT_NOT_APPLY : tep_get_extra_field_list_value($value['id'], false, $e['display_type'])) . '<td><td>&nbsp;</td>';
                        }
                        $inp .= '</tr></table>';
          	          } else {
          	            $inp = tep_draw_pull_down_menu($e['field'] . "[" . $languages[$i]['id'] . "]",  $epfvals, $currentval, ($e['linked'] ? 'onChange="process_' . $e['field'] . '_' . $e['language'] . '()" id="lv' . $e['id'] . '_' . $languages[$i]['id'] . '"' : ''));
          	          }
        	          }
        	        } else {
        	          if ($e['textarea']) {
          	            $inp = tep_draw_textarea_field($e['field'] . "[" . $languages[$i]['id'] . "]", 'soft', '70', '5', $currentval, 'id="' . $e['field'] . "_" . $languages[$i]['id'] . '"');
        	          } else {
          	            $inp = tep_draw_input_field($e['field'] . "[" . $languages[$i]['id'] . "]", $currentval, "maxlength=" . $e['size'] . " size=" . $e['size']);
        	          }
        	        }
?>
          <tr bgcolor="#ebebff">
            <td class="main"><?php echo $e['label']; ?>:</td>
            <td class="main"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . $inp; ?></td>
          </tr>
<?php
                }
              }
            }
          } 
// EOF: Extra Product Fields
?>        
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
<?php // EOF: MOD - indvship ?>
          <tr bgcolor="#ebebff">
            <td class="main"><?php echo 'Indv. Shipping Price:'; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_input_field('products_ship_price', $pInfo->products_ship_price); ?></td>
          </tr>
<?php // EOF: MOD - indvship ?>
          <tr bgcolor="#ebebff">
            <td class="main"><?php echo TEXT_SHIPPING_DIMENSIONS; ?></td>
            <td class="main" colspan="2">
            <?php echo tep_draw_separator('pixel_trans.gif', '26', '12') . TEXT_PRODUCTS_LENGTH .  '&nbsp;' . tep_draw_input_field('products_length', $pInfo->products_length) .
            tep_draw_separator('pixel_trans.gif', '10', '12') . TEXT_PRODUCTS_WIDTH .  '&nbsp;' . tep_draw_input_field('products_width', $pInfo->products_width) .
            tep_draw_separator('pixel_trans.gif', '10', '12') . TEXT_PRODUCTS_HEIGHT .  '&nbsp;' . tep_draw_input_field('products_height', $pInfo->products_height); ?></td>
          </tr>
          <tr bgcolor="#ebebff">
            <td class="main"><?php echo TEXT_PRODUCTS_READY_TO_SHIP; ?></td>
            <td class="main"><?php echo tep_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . tep_draw_checkbox_field('products_ready_to_ship', '1', (($product['products_ready_to_ship'] == '1') ? true : false)); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
<!-- instant update -->
       <td class="main" align="right"><?php echo (isset($_GET['pID']) ? TEXT_PRODUCTS_UPDATE_PRODUCT : TEXT_PRODUCTS_INSERT_PRODUCT ) . TEXT_PRODUCTS_WITHOUT_PREVIEW; ?><input type="checkbox" name="instant_update" ></td>
<!-- EOF instant update  -->
        <td class="main" align="right"><?php echo tep_draw_hidden_field('products_date_added', (tep_not_null($pInfo->products_date_added) ? $pInfo->products_date_added : date('Y-m-d'))) . tep_image_submit('button_update.gif', TEXT_PRODUCTS_UPDATE_PRODUCT) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . (isset($_GET['pID']) ? '&pID=' . $_GET['pID'] : '')) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>'; ?></td>
      </tr>
    </table></form>
<?php
  } elseif ($action == 'new_product_preview') {
    if (tep_not_null($_POST)) {
      $pInfo = new objectInfo($_POST);
      $products_name = $_POST['products_name'];
      $products_description = $_POST['products_description'];
// BOF Open Featured Sets
      $products_short = $_POST['products_short'];
// EOF Open Featured Sets
// BOF: Tabs by PGM
      $tab1 = $_POST['tab1'];
      $tab2 = $_POST['tab2'];
      $tab3 = $_POST['tab3'];
      $tab4 = $_POST['tab4'];
      $tab5 = $_POST['tab5'];
      $tab6 = $_POST['tab6'];
// EOF: Tabs by PGM
      $products_url = $_POST['products_url'];
// BOF: Extra Product Fields
      $extra = array();
      foreach ($xfields as $f) {
        $extra[$f] = $_POST[$f];
      }
// EOF: Extra Product Fields
	  
// LINE CHANGED: Added p.products_shipped_price and dimensions for upsxml
//    $product_query = tep_db_query("select p.products_ship_price, p.products_id, pd.language_id, pd.products_name, pd.products_description, pd.products_url, p.products_quantity, p.products_model, p.products_image, p.products_price, p.products_weight, p.products_length, p.products_width, p.products_height, p.products_ready_to_ship, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p.manufacturers_id  from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and p.products_id = '" . (int)$_GET['pID'] . "'");
// LINE MODED: Tabs by PGM

// BOF QPBPP for SPPC
      $price_breaks_array = array();
      if (isset($_POST['products_price_break'][0]) && isset($_POST['products_qty'][0])) {
        foreach ($_POST['products_price_break'][0] as $index => $products_price ) {
          if (tep_not_null($products_price) && tep_not_null($_POST['products_qty'][0][$index]) && !isset($_POST['products_delete'][0][$index])) {
            $price_breaks_array[] = array(
              'products_price' => $products_price,
              'products_qty' => $_POST['products_qty'][0][$index]);
          }
        } // end foreach ($_POST['products_price_break'][0] as ...
      usort($price_breaks_array, "sortByQty");
      } // end if (isset($_POST['products_price_break'][0]) && ...
// EOF QPBPP for SPPC

      } else {
// LINE MODED: Separate Pricing Per Customer adapted for QPBPP for SPPC v4.2
// LINE MODED: Open Feature Sets : Added ", pd.products_short"
//      $product_query = tep_db_query("select p.products_ship_price, p.products_id, pd.language_id, pd.products_name, pd.products_description, pd.products_short, pd.tab1, pd.tab2, pd.tab3, pd.tab4, pd.tab5, pd.tab6, pd.products_url, p.products_quantity, p.products_model, p.products_image, p.products_price, p.products_weight, p.products_length, p.products_width, p.products_height, p.products_ready_to_ship, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p.manufacturers_id, p.products_qty_blocks, p.products_min_order_qty  from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and p.products_id = '" . (int)$_GET['pID'] . "'");

// BOF: Extra Product Fields
        $query = "select p.products_ship_price, p.products_id, pd.language_id, pd.products_name, pd.products_description, pd.products_short, pd.tab1, pd.tab2, pd.tab3, pd.tab4, pd.tab5, pd.tab6, pd.products_url, p.products_quantity, p.products_model, p.products_image, p.products_price, p.products_weight, p.products_length, p.products_width, p.products_height, p.products_ready_to_ship, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p.manufacturers_id, p.products_qty_blocks, p.products_min_order_qty ";
	  foreach ($xfields as $f) {
        $query .= ', pd.' . $f;
      }       
	    $query .= " from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and p.products_id = '" . (int)$_GET['pID'] . "'";
	    $product_query = tep_db_query($query);
// EOF: Extra Product Fields

      $product = tep_db_fetch_array($product_query);

      $pInfo = new objectInfo($product);
      $products_image_name = $pInfo->products_image;

// move retail settings for quantity blocks and min order qty to an array indexed
// by customer_group_id, like we get back in $_POST values
      unset($pInfo->products_qty_blocks);
      $pInfo->products_qty_blocks[0] = $product['products_qty_blocks'];
      unset($pInfo->products_min_order_qty);
      $pInfo->products_min_order_qty[0] = $product['products_min_order_qty'];
// price_breaks_array is taken care of by PriceFormatterAdmin.php
// EOF QPBPP for SPPC
    }

    $form_action = (isset($_GET['pID'])) ? 'update_product' : 'insert_product';

    echo tep_draw_form($form_action, FILENAME_CATEGORIES, 'cPath=' . $cPath . (isset($_GET['pID']) ? '&pID=' . $_GET['pID'] : '') . '&action=' . $form_action, 'post', 'enctype="multipart/form-data"');

    $languages = tep_get_languages();
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
      if (isset($_GET['read']) && ($_GET['read'] == 'only')) {
        $pInfo->products_name = tep_get_products_name($pInfo->products_id, $languages[$i]['id']);
// BOF Open Featured Sets
        $pInfo->products_short = tep_get_products_short($pInfo->products_id, $languages[$i]['id']);
// EOF Open Featured Sets
        $pInfo->products_description = tep_get_products_description($pInfo->products_id, $languages[$i]['id']);
// BOF: Tabs by PGM
        $pInfo->tab1 = tep_get_tab1($pInfo->products_id, $languages[$i]['id']);
        $pInfo->tab2 = tep_get_tab2($pInfo->products_id, $languages[$i]['id']);
        $pInfo->tab3 = tep_get_tab3($pInfo->products_id, $languages[$i]['id']);
        $pInfo->tab4 = tep_get_tab4($pInfo->products_id, $languages[$i]['id']);
        $pInfo->tab5 = tep_get_tab5($pInfo->products_id, $languages[$i]['id']);
        $pInfo->tab6 = tep_get_tab6($pInfo->products_id, $languages[$i]['id']);
// EOF: Tabs by PGM
        $pInfo->products_url = tep_get_products_url($pInfo->products_id, $languages[$i]['id']);
      } else {
        $pInfo->products_name = tep_db_prepare_input($products_name[$languages[$i]['id']]);
// BOF Open Featured Sets
        $pInfo->products_short = tep_db_prepare_input($products_short[$languages[$i]['id']]);
// EOF Open Featured Sets
        $pInfo->products_description = tep_db_prepare_input($products_description[$languages[$i]['id']]);
// BOF: Tabs by PGM
        $pInfo->tab1 = tep_db_prepare_input($tab1[$languages[$i]['id']]);
        $pInfo->tab2 = tep_db_prepare_input($tab2[$languages[$i]['id']]);
        $pInfo->tab3 = tep_db_prepare_input($tab3[$languages[$i]['id']]);
        $pInfo->tab4 = tep_db_prepare_input($tab4[$languages[$i]['id']]);
        $pInfo->tab5 = tep_db_prepare_input($tab5[$languages[$i]['id']]);
        $pInfo->tab6 = tep_db_prepare_input($tab6[$languages[$i]['id']]);
// EOF: Tabs by PGM
        $pInfo->products_url = tep_db_prepare_input($products_url[$languages[$i]['id']]);
      }
?>
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . $pInfo->products_name; ?></td>
            <td class="pageHeading" align="right"><?php
// BOF QPBPP for SPPC
            $pf->loadProduct((int)$_GET['pID'], $pInfo->products_price, $pInfo->products_tax_class_id, (int)$pInfo->products_qty_blocks[0], $price_breaks_array, (int)$pInfo->products_min_order_qty[0]);
            echo $pf->getPriceString();
// EOF QPBPP for SPPC ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main" valign="top" width="70%">
                        <?php echo $pInfo->products_description; ?>
        </td>
        <td width="25%">
                <?php echo '<a href="' . $html_images_dir . $products_image_name . '" target="_blank" rel="lightbox[group]" title="'.$product_info['products_name'].'" >' . tep_image($html_thumbs . $products_image_name, $product_info['products_name'], PRODUCT_IMAGE_WIDTH, PRODUCT_IMAGE_HEIGHT, 'hspace="4" vspace="4" align="right"') . '<br>' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>
        </td>
      </tr>
<?php
// BOF: Extra Product Fields
         foreach ($epf as $e) {
           if ($e['language'] == $languages[$i]['id']) {
             if ($e['language_active']) {
               if (isset($_GET['read']) && ($_GET['read'] == 'only')) {
                 $value = tep_get_product_extra_value($e['id'], $pInfo->products_id, $languages[$i]['id']);
                 if ($e['multi_select'] && ($value != '')) {
                   $value = explode('|', trim($value, '|'));
                 }
               } else {
                 if ($e['multi_select']) {
                   $value = $extra[$e['field']][$languages[$i]['id']];
                 } else {
                   $value = tep_db_prepare_input($extra[$e['field']][$languages[$i]['id']]);
                   if ($e['uses_list'] && ($value == 0)) $value = '';
                 }
               }
               if (tep_not_null($value)) {
                 echo '<tr><td class="main"><b>' . $e['label'] . ': </b>';
                 if ($e['uses_list']) {
                   if ($e['multi_select']) {
                     $output = array();
                     foreach ($value as $val) {
                       $output[] = tep_get_extra_field_list_value($val, $e['show_chain'], $e['display_type']);
                     }
                     echo implode(', ', $output);
                   } else {
                     echo tep_get_extra_field_list_value($value, $e['show_chain'], $e['display_type']);
                   }
                 } else {
                   echo $value;
                 }
                 echo "</td></tr>\n";
               }
             }
           }
         }
// EOF: Extra Product Fields
	
      if ($pInfo->products_url) {
?>
      <tr>
        <td width="100%"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><?php echo sprintf(TEXT_PRODUCT_MORE_INFORMATION, $pInfo->products_url); ?></td>
      </tr>
<?php
      }
?>
      <tr>
        <td width="100%"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
<?php
      if ($pInfo->products_date_available > date('Y-m-d')) {
?>
      <tr>
        <td align="center" class="smallText"><?php echo sprintf(TEXT_PRODUCT_DATE_AVAILABLE, tep_date_long($pInfo->products_date_available)); ?></td>
      </tr>
<?php
      } else {
?>
      <tr>
        <td align="center" class="smallText"><?php echo sprintf(TEXT_PRODUCT_DATE_ADDED, tep_date_long($pInfo->products_date_added)); ?></td>
      </tr>
<?php
      }
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
<?php
 	// BOF Open Featured Sets
?>
	  <tr>
        <td><br><br></td>
      </tr>
	  <tr>
        <td>
		<b><?php echo TABLE_HEADING_FEATURED_PREVIEW; ?></b><br>
		<table border="1" width="450" cellspacing="0" cellpadding="16">
		<tr>
			<td>
				<table border="0" width="100%" cellspacing="0" cellpadding="2">
				<tr>
					<td width="<?php echo SMALL_IMAGE_WIDTH + 10; ?>" rowspan="4" align="right" valign="top" class="main"><?php echo tep_image( ((!empty($_SERVER['HTTPS'])) ? HTTPS_CATALOG_SERVER : HTTP_CATALOG_SERVER).DIR_WS_CATALOG_IMAGES . $products_image_name, $pInfo->products_name, 0, 0, 'align="right" hspace="5" vspace="5"'); ?></td>
					<td width="80%" valign="top" class="main"><div align="left"><?php echo '<b><u>' . $pInfo->products_name . '</u></b>'; ?></div></td>
				</tr>
				<tr>
					<td valign="top" class="smalltext"><?php
					  if ($pInfo->products_short != '') {
						  echo $pInfo->products_short;
					  } else {
					   $bah = explode(" ", $pInfo->products_description);
					   for($desc=0 ; $desc<MAX_FEATURED_WORD_DESCRIPTION; $desc++)
						  {
						  echo "$bah[$desc] ";
						  }
						  echo '&nbsp;<a target="_blank" href="'.HTTP_CATALOG_SERVER.DIR_WS_CATALOG.'product_info.php?products_id='.(isset($_GET['pID'])?$_GET['pID']:'').'"><u>'.TEXT_MORE_INFO.'</u></a>';
					  }
					?>
					</td>
				</tr>
				<tr>
					<td valign="top" class="main">&nbsp;</td>
				</tr>
				<tr>
					<td align="left" valign="top" class="smalltext"><?php echo tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5') . '<br>' . TEXT_PRODUCTS_PRICE_INFO . ' ' . $currencies->format($pInfo->products_price); ?><br><?php echo '<img src='.HTTP_CATALOG_SERVER.DIR_WS_CATALOG_LANGUAGES.'english/images/buttons/button_buy_now.gif>';?></td>
				</tr>
				</table>
			</td>
		</tr>
		</table>

	    </td>
      </tr>
	  <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '20'); ?></td>
      </tr>
<?php
 	// EOF Open Featured Sets
    }

    if (isset($_GET['read']) && ($_GET['read'] == 'only')) {
      if (isset($_GET['origin'])) {
        $pos_params = strpos($_GET['origin'], '?', 0);
        if ($pos_params != false) {
          $back_url = substr($_GET['origin'], 0, $pos_params);
          $back_url_params = substr($_GET['origin'], $pos_params + 1);
        } else {
          $back_url = $_GET['origin'];
          $back_url_params = '';
        }
      } else {
        $back_url = FILENAME_CATEGORIES;
        $back_url_params = 'cPath=' . $cPath . '&pID=' . $pInfo->products_id;
      }
?>
      <tr>
        <td align="right"><?php echo '<a href="' . tep_href_link($back_url, $back_url_params, 'NONSSL') . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
      </tr>
<?php
    } else {
?>
      <tr>
        <td align="right" class="smallText">
<?php
/* Re-Post all POST'ed variables */
      reset($_POST);
      while (list($key, $value) = each($_POST)) {
// BOF Separate Pricing per Customer adapted for QPBPP for SPPC
        if (is_array($value)) {
          while (list($k, $v) = each($value)) {
            if (is_array($v)) {
              foreach ($v as $subkey => $subvalue) {
                echo tep_draw_hidden_field($key . '[' . $k . '][' . $subkey . ']', htmlspecialchars(stripslashes($subvalue)));
              }
            } else {
              echo tep_draw_hidden_field($key . '[' . $k . ']', htmlspecialchars(stripslashes($v)));
            }
          }
        } else {
// EOF Separate Pricing per Customer adapted for QPBPP for SPPC

          echo tep_draw_hidden_field($key, htmlspecialchars(stripslashes($value)));
        }
       }
      $languages = tep_get_languages();
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        echo tep_draw_hidden_field('products_name[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($products_name[$languages[$i]['id']])));
// BOF Open Featured Sets
        echo tep_draw_hidden_field('products_short[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($products_short[$languages[$i]['id']])));
// EOF Open Featured Sets
        echo tep_draw_hidden_field('products_description[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($products_description[$languages[$i]['id']])));
// BOF: Tabs by PGM
        echo tep_draw_hidden_field('tab1[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($tab1[$languages[$i]['id']])));
        echo tep_draw_hidden_field('tab2[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($tab2[$languages[$i]['id']])));
        echo tep_draw_hidden_field('tab3[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($tab3[$languages[$i]['id']])));
        echo tep_draw_hidden_field('tab4[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($tab4[$languages[$i]['id']])));
        echo tep_draw_hidden_field('tab5[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($tab5[$languages[$i]['id']])));
        echo tep_draw_hidden_field('tab6[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($tab6[$languages[$i]['id']])));
// EOF: Tabs by PGM
        echo tep_draw_hidden_field('products_url[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($products_url[$languages[$i]['id']])));
// BOF: Extra Product Fields
        foreach ($epf as $e) {
          if ($e['language'] == $languages[$i]['id']) {
            if ($e['language_active']) {
              if ($e['multi_select']) {
                foreach ($extra[$e['field']][$languages[$i]['id']] as $value) {
                  echo tep_draw_hidden_field($e['field'] . '[' . $languages[$i]['id'] . '][]', htmlspecialchars(stripslashes($value)));
                }
              } else {
                echo tep_draw_hidden_field($e['field'] . '[' . $languages[$i]['id'] . ']', htmlspecialchars(stripslashes($extra[$e['field']][$languages[$i]['id']])));
              }
            }
          }
        }
// EOF: Extra Product Fields
	  } // end for
      echo tep_draw_hidden_field('products_image', stripslashes($products_image_name));

      echo tep_image_submit('button_back.gif', IMAGE_BACK, 'name="edit"') . '&nbsp;&nbsp;';

      if (isset($_GET['pID'])) {
        echo tep_image_submit('button_update.gif', IMAGE_UPDATE);
      } else {
        echo tep_image_submit('button_insert.gif', IMAGE_INSERT);
      }
      echo '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . (isset($_GET['pID']) ? '&pID=' . $_GET['pID'] : '')) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>';
?></td>
      </tr>
    </table></form>
<?php
    }
  } else {
?>
    <table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
            <td align="right"><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="smallText" align="right">
<?php
    echo tep_draw_form('search', FILENAME_CATEGORIES, '', 'get');
    echo HEADING_TITLE_SEARCH . ' ' . tep_draw_input_field('search');
    echo tep_hide_session_id() . '</form>';
?>
                </td>
              </tr>
              <tr>
                <td class="smallText" align="right">
<?php
    echo tep_draw_form('goto', FILENAME_CATEGORIES, '', 'get');
    echo HEADING_TITLE_GOTO . ' ' . tep_draw_pull_down_menu('cPath', tep_get_category_tree(), $current_category_id, 'onChange="this.form.submit();"');
    echo tep_hide_session_id() . '</form>';
?>
                </td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CATEGORIES_PRODUCTS; ?></td>
<?php // BOF SPPC hide products and categories from groups ?>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_HIDE_CATEGORIES; ?></td>
<?php // EOF SPPC hide products and categories from groups ?>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_STATUS; ?></td>
<?php
 	// BOF Open Featured Sets
?>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_FEATURED; ?></td>
<?php
 	// EOF Open Featured Sets
?>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
//    $categories_count = 0;
//     $rows = 0;
//     if (isset($_GET['search'])) {
//       $search = tep_db_prepare_input($_GET['search']);
//
//       $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and cd.categories_name like '%" . tep_db_input($search) . "%' order by c.sort_order, cd.categories_name");
//     } else {
//       $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by c.sort_order, cd.categories_name");
//     }
    $categories_count = 0;
    $rows = 0;
// BOF SPPC hide products and categories from groups
    $customers_group_query = tep_db_query("select customers_group_id, customers_group_name from " . TABLE_CUSTOMERS_GROUPS . " order by customers_group_id");
    while ($customer_groups = tep_db_fetch_array($customers_group_query)) {
      $customers_groups[] = array('id' => $customer_groups['customers_group_id'], 'text' => $customer_groups['customers_group_name']);
    }
    if (isset($_GET['search'])) {
      $search = tep_db_prepare_input($_GET['search']);
//LINE MODED: Open Feature Sets: Added ", c.categories_featured, c.categories_featured_until"
      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified, c.categories_hide_from_groups, c.categories_featured, c.categories_featured_until from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and cd.categories_name like '%" . tep_db_input($search) . "%' order by c.sort_order, cd.categories_name");
    } else {
//LINE MODED: Open Feature Sets: Added ", c.categories_featured, c.categories_featured_until"
      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, c.sort_order, c.date_added, c.last_modified, c.categories_hide_from_groups, c.categories_featured, c.categories_featured_until from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by c.sort_order, cd.categories_name");
    }
// EOF SPPC hide products and categories from groups
    while ($categories = tep_db_fetch_array($categories_query)) {
      $categories_count++;
      $rows++;

// Get parent_id for subcategories if search
      if (isset($_GET['search'])) $cPath= $categories['parent_id'];

      if ((!isset($_GET['cID']) && !isset($_GET['pID']) || (isset($_GET['cID']) && ($_GET['cID'] == $categories['categories_id']))) && !isset($cInfo) && (substr($action, 0, 3) != 'new')) {
        $category_childs = array('childs_count' => tep_childs_in_category_count($categories['categories_id']));
        $category_products = array('products_count' => tep_products_in_category_count($categories['categories_id']));

        $cInfo_array = array_merge($categories, $category_childs, $category_products);
        $cInfo = new objectInfo($cInfo_array);
      }

      if (isset($cInfo) && is_object($cInfo) && ($categories['categories_id'] == $cInfo->categories_id) ) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_CATEGORIES, tep_get_path($categories['categories_id'])) . '\'">' . "\n";
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $categories['categories_id']) . '\'">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, tep_get_path($categories['categories_id'])) . '">' . tep_image(DIR_WS_ICONS . 'folder.gif', ICON_FOLDER) . '</a>&nbsp;<b>' . $categories['categories_name'] . '</b>'; ?></td>



<?php // BOF SPPC hide products and categories from groups ?>
       <td class="dataTableContent" align="center"><?php
    $hide_cat_from_groups_array = explode(',', $categories['categories_hide_from_groups']);
    $hide_cat_from_groups_array = array_slice($hide_cat_from_groups_array, 1); // remove "@" from the array
   $category_hidden_from_string = '';
   if (LAYOUT_HIDE_FROM == '1') {
         for ($i = 0; $i < count($customers_groups); $i++) {
           if (in_array($customers_groups[$i]['id'], $hide_cat_from_groups_array)) {
           $category_hidden_from_string .= $customers_groups[$i]['text'] . ', ';
           }
         } // end for ($i = 0; $i < count($customers_groups); $i++)
         $category_hidden_from_string = rtrim($category_hidden_from_string); // remove space on the right
         $category_hidden_from_string = substr($category_hidden_from_string,0,strlen($category_hidden_from_string) -1); // remove last comma
         if (!tep_not_null($category_hidden_from_string)) {
         $category_hidden_from_string = TEXT_GROUPS_NONE;
         }
         $category_hidden_from_string = TEXT_HIDDEN_FROM_GROUPS . $category_hidden_from_string;
         // if the string in the database field is @, everything will work fine, however tep_not_null
         // will not discover the associative array is empty therefore the second check on the value
     if (tep_not_null($hide_cat_from_groups_array) && tep_not_null($hide_cat_from_groups_array[0])) {
        echo tep_image(DIR_WS_ICONS . 'tick_black.gif', $category_hidden_from_string, 20, 16);
      } else {
        echo tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', $category_hidden_from_string, 20, 16);
     }
   } else {
// default layout: icons for all groups
      for ($i = 0; $i < count($customers_groups); $i++) {
        if (in_array($customers_groups[$i]['id'], $hide_cat_from_groups_array)) {
          echo tep_image(DIR_WS_ICONS . 'icon_tick.gif', $customers_groups[$i]['text'], 11, 11) . '&nbsp;&nbsp;';
        } else {
          echo tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', 11, 11) . '&nbsp;&nbsp;';
        }
      }
   }
?></td><?php // EOF SPPC hide products and categories from groups ?>
                <td class="dataTableContent" align="center">&nbsp;</td>
<?php
 	// BOF Open Featured Sets
?>
				<td class="dataTableContent" align="center">
<?php
	 if (!isset($cInfo) && is_object($cInfo) && ($cInfo->categories_featured)) $cInfo->categories_featured = '0';
    switch ($cInfo->categories_featured) {
      case '0': $in_fc_status = false; $out_fc_status = true; break;
      case '1':
      default: $in_fc_status = true; $out_fc_status = false;
	  }

      if ($categories['categories_featured'] == '1') {
        echo tep_image(DIR_WS_ICONS . 'icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setflag_categories_featured&flag=0&cPath=' . $cPath . '&cID=' . $categories['categories_id']) . '">' . tep_image(DIR_WS_ICONS . 'icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
      } else {
        echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setflag_categories_featured&flag=1&cPath=' . $cPath . '&cID=' . $categories['categories_id']) . '">' . tep_image(DIR_WS_ICONS . 'icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_ICONS . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
      }
?></td>
<?php
 	// EOF Open Featured Sets
?>

                <td class="dataTableContent" align="right"><?php if (isset($cInfo) && is_object($cInfo) && ($categories['categories_id'] == $cInfo->categories_id) ) { echo tep_image(DIR_WS_ICONS . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $categories['categories_id']) . '">' . tep_image(DIR_WS_ICONS . 'information.png', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }

    $products_count = 0;
    if (isset($_GET['search'])) {
// LINE CHANGED: Added p.products_shipped_price
//    $products_query = tep_db_query("select p.products_id, pd.products_name, p.products_quantity, p.products_image, p.products_price, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status,                              p2c.categories_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and (pd.products_name like '%" . tep_db_input($search) . "%' or p.products_model like '%" . tep_db_input($search) . "%') order by pd.products_name");
// BOF SPPC hide products from groups
// LINE MODED: Separate Pricing Per Customer adapted for QPBPP for SPPC v4.2
// LINE MODED: Open Feature Sets: Added ", p.products_featured, p.products_featured_until"
      $products_query = tep_db_query("select p.products_id, pd.products_name, p.products_quantity, p.products_image, p.products_price, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p.products_hide_from_groups, p.products_qty_blocks, p.products_min_order_qty, p2c.categories_id, p.products_featured, p.products_featured_until from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and (pd.products_name like '%" . tep_db_input($search) . "%' or p.products_model like '%" . tep_db_input($search) . "%') order by pd.products_name");

    } else {
// LINE CHANGED: Added p.products_shipped_price
//    $products_query = tep_db_query("select p.products_id, pd.products_name, p.products_quantity, p.products_image, p.products_price, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status from ". TABLE_PRODUCTS .                                                        " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and p2c.categories_id = '" . (int)$current_category_id . "' order by pd.products_name");
// LINE MODED: Separate Pricing Per Customer adapted for QPBPP for SPPC v4.2
// LINE MODED: Open Feature Sets: Added ", p.products_featured, p.products_featured_until"
      $products_query = tep_db_query("select p.products_id, pd.products_name, p.products_quantity, p.products_image, p.products_price, p.products_date_added, p.products_last_modified, p.products_date_available, p.products_status, p.products_hide_from_groups, p.products_qty_blocks, p.products_min_order_qty, p.products_featured, p.products_featured_until from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = p2c.products_id and p2c.categories_id = '" . (int)$current_category_id . "' order by pd.products_name");
// EOF SPPC hide products from groups
    }
    while ($products = tep_db_fetch_array($products_query)) {
      $products_count++;
      $rows++;

// Get categories_id for product if search
      if (isset($_GET['search'])) $cPath = $products['categories_id'];

      if ( (!isset($_GET['pID']) && !isset($_GET['cID']) || (isset($_GET['pID']) && ($_GET['pID'] == $products['products_id']))) && !isset($pInfo) && !isset($cInfo) && (substr($action, 0, 3) != 'new')) {
// find out the rating average from customer reviews
        $reviews_query = tep_db_query("select (avg(reviews_rating) / 5 * 100) as average_rating from " . TABLE_REVIEWS . " where products_id = '" . (int)$products['products_id'] . "'");
        $reviews = tep_db_fetch_array($reviews_query);
        $pInfo_array = array_merge($products, $reviews);
        $pInfo = new objectInfo($pInfo_array);
      }

      if (isset($pInfo) && is_object($pInfo) && ($products['products_id'] == $pInfo->products_id) ) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products['products_id'] . '&action=new_product_preview&read=only') . '\'">' . "\n";
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products['products_id']) . '\'">' . "\n";
      }
?>
                <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products['products_id'] . '&action=new_product_preview&read=only') . '">' . tep_image(DIR_WS_ICONS . 'page_white_text.png', ICON_PREVIEW) . '</a>&nbsp;' . $products['products_name']; ?></td>
<?php  //BOF SPPC hide products and categories from groups ?>
      <td class="dataTableContent" align="center"><?php
    $hide_prods_from_groups_array = explode(',', $products['products_hide_from_groups']);
    $hide_prods_from_groups_array = array_slice($hide_prods_from_groups_array, 1); // remove "@" from the array
      if (LAYOUT_HIDE_FROM == '1') {
        $product_hidden_from_string = '';
         for ($i = 0; $i < count($customers_groups); $i++) {
           if (in_array($customers_groups[$i]['id'], $hide_prods_from_groups_array)) {
           $product_hidden_from_string .= $customers_groups[$i]['text'] . ', ';
           }
         } // end for ($i = 0; $i < count($customers_groups); $i++)
         $product_hidden_from_string = rtrim($product_hidden_from_string); // remove space on the right
         $product_hidden_from_string = substr($product_hidden_from_string,0,strlen($product_hidden_from_string) -1); // remove last comma
   if (tep_not_null($hide_prods_from_groups_array)&& tep_not_null($hide_prods_from_groups_array[0])) {
         $product_hidden_from_string = TEXT_GROUPS_NONE;
         }
         $product_hidden_from_string = TEXT_HIDDEN_FROM_GROUPS . $product_hidden_from_string;
   if (tep_not_null($hide_prods_from_groups_array)) {
        echo tep_image(DIR_WS_ICONS . 'tick_black.gif', $product_hidden_from_string, 20, 16);
     } else {
        echo tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', $product_hidden_from_string, 20, 16);
     }
   } else {
// default layout: icons for all groups
      for ($i = 0; $i < count($customers_groups); $i++) {
        if (in_array($customers_groups[$i]['id'], $hide_prods_from_groups_array)) {
          echo tep_image(DIR_WS_ICONS . 'icon_tick.gif', $customers_groups[$i]['text'], 11, 11) . '&nbsp;&nbsp;';
        } else {
          echo tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', 11, 11) . '&nbsp;&nbsp;';
        }
      }
   } // end if/else (LAYOUT_HIDE_FROM == '1')
?></td><?php // EOF SPPC hide products and categories from groups ?>
                <td class="dataTableContent" align="center">
<?php
      if ($products['products_status'] == '1') {
        echo tep_image(DIR_WS_ICONS .  'icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setflag&flag=0&pID=' . $products['products_id'] . '&cPath=' . $cPath) . '">' . tep_image(DIR_WS_ICONS . 'icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
      } else {
        echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setflag&flag=1&pID=' . $products['products_id'] . '&cPath=' . $cPath) . '">' . tep_image(DIR_WS_ICONS . 'icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_ICONS . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
      }
?></td>
<?php
 	// BOF Open Featured Sets
?>
                <td class="dataTableContent" align="center">
<?php
      if ($products['products_featured'] == '1') {
        echo tep_image(DIR_WS_ICONS . 'icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setflag_featured&flag=0&pID=' . $products['products_id'] . '&cPath=' . $cPath) . '">' . tep_image(DIR_WS_ICONS . 'icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
      } else {
        echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=setflag_featured&flag=1&pID=' . $products['products_id'] . '&cPath=' . $cPath) . '">' . tep_image(DIR_WS_ICONS . 'icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_ICONS . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
      }
?></td>
<?php
 	// BOF Open Featured Sets
?>
                <td class="dataTableContent" align="right">
				<?php
                //BOF Quicker Product Edit
                if (!(isset($pInfo) && is_object($pInfo) && ($products['products_id'] == $pInfo->products_id))) { echo ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products['products_id']) . '&action=new_product' . '">' . tep_image(DIR_WS_ICONS . 'page_white_edit.png', IMAGE_ICON_EDIT) . '</a>&nbsp;';}
                //EOF Quicker Product Edit

				if (isset($pInfo) && is_object($pInfo) && ($products['products_id'] == $pInfo->products_id)) { echo tep_image(DIR_WS_ICONS . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $products['products_id']) . '">' . tep_image(DIR_WS_ICONS . 'information.png', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }

    $cPath_back = '';
    if (sizeof($cPath_array) > 0) {
      for ($i=0, $n=sizeof($cPath_array)-1; $i<$n; $i++) {
        if (empty($cPath_back)) {
          $cPath_back .= $cPath_array[$i];
        } else {
          $cPath_back .= '_' . $cPath_array[$i];
        }
      }
    }

    $cPath_back = (tep_not_null($cPath_back)) ? 'cPath=' . $cPath_back . '&' : '';
?>
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText"><?php echo TEXT_CATEGORIES . '&nbsp;' . $categories_count . '<br>' . TEXT_PRODUCTS . '&nbsp;' . $products_count; ?></td>
                    <td align="right" class="smallText"><?php if (sizeof($cPath_array) > 0) echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, $cPath_back . 'cID=' . $current_category_id) . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a>&nbsp;'; if (!isset($_GET['search'])) echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&action=new_category') . '">' . tep_image_button('button_new_category.gif', IMAGE_NEW_CATEGORY) . '</a>&nbsp;<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&action=new_product') . '">' . tep_image_button('button_new_product.gif', IMAGE_NEW_PRODUCT) . '</a>'; ?>&nbsp;</td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
<?php
    $heading = array();
    $contents = array();
// BOF SPPC hide products and categories from groups
    $hide_cat_from_groups_array = explode(',',$cInfo->categories_hide_from_groups);
    $hide_cat_from_groups_array = array_slice($hide_cat_from_groups_array, 1); // remove "@" from the array
    $hide_product_from_groups_array = explode(',',$pInfo->products_hide_from_groups);
    $hide_product_from_groups_array = array_slice($hide_product_from_groups_array, 1); // remove "@" from the array
// EOF SPPC hide products and categories from groups
    switch ($action) {
      case 'new_category':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_CATEGORY . '</b>');

        $contents = array('form' => tep_draw_form('newcategory', FILENAME_CATEGORIES, 'action=insert_category&cPath=' . $cPath, 'post', 'enctype="multipart/form-data"'));
        $contents[] = array('text' => TEXT_NEW_CATEGORY_INTRO);

        $category_inputs_string = '';
        $languages = tep_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $category_inputs_string .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_name[' . $languages[$i]['id'] . ']');
        }

        $contents[] = array('text' => '<br>' . TEXT_CATEGORIES_NAME . $category_inputs_string);
        $contents[] = array('text' => '<br>' . TEXT_CATEGORIES_IMAGE . '<br>' . tep_draw_file_field('categories_image'));
        $contents[] = array('text' => '<br>' . TEXT_SORT_ORDER . '<br>' . tep_draw_input_field('sort_order', '', 'size="2"'));
// BOF Open Featured Sets
 		$contents[] = array('text' => '<br>' . TEXT_CATEGORIES_FEATURED . '<br>' . tep_draw_radio_field('categories_featured', '1', $in_fc_status) . '&nbsp;' . TEXT_CATEGORIES_YES . '&nbsp;' . tep_draw_radio_field('categories_featured', '0', $out_fc_status) . '&nbsp;' . TEXT_CATEGORIES_NO);
 		$contents[] = array('text' => '<br>' . TEXT_CATEGORIES_FEATURED_DATE . '<small>(YYYY-MM-DD)</small><br>' . $cInfo->categories_featured_until . '<br><script type="text/javascript">CategoriesFeaturedUntil.writeControl(); CategoriesFeaturedUntil.dateFormat="yyyy-MM-dd";</script>');
// EOF Open Featured Sets
// BOF SPPC hide products and categories from groups
        $category_hide_string = '<br>'. "\n" . TEXT_HIDE_CATEGORIES_FROM_GROUPS;
          for ($i = 0; $i < count($customers_groups); $i++) {
            $category_hide_string .= '<br>' . "\n" . tep_draw_checkbox_field('hide_cat[' . $customers_groups[$i]['id'] . ']',  $customers_groups[$i]['id'] , 0) . '&#160;&#160;' . $customers_groups[$i]['text'];
          }
        $contents[] = array('text' => $category_hide_string);
// EOF SPPC hide products and categories from groups
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
        break;
      case 'edit_category':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_EDIT_CATEGORY . '</b>');

        $contents = array('form' => tep_draw_form('categories', FILENAME_CATEGORIES, 'action=update_category&cPath=' . $cPath, 'post', 'enctype="multipart/form-data"') . tep_draw_hidden_field('categories_id', $cInfo->categories_id));
        $contents[] = array('text' => TEXT_EDIT_INTRO);

        $category_inputs_string = '';
        $languages = tep_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $category_inputs_string .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('categories_name[' . $languages[$i]['id'] . ']', tep_get_category_name($cInfo->categories_id, $languages[$i]['id']));
        }

        $contents[] = array('text' => '<br>' . TEXT_EDIT_CATEGORIES_NAME . $category_inputs_string);
        $contents[] = array('text' => '<br>' . tep_image(DIR_FS_CATALOG_IMAGES . CATEGORY_IMAGES_DIR . $cInfo->categories_image, $cInfo->categories_name) . '<br>' . DIR_FS_CATALOG_IMAGES . CATEGORY_IMAGES_DIR . '<br><b>' . $cInfo->categories_image . '</b>');
        $contents[] = array('text' => '<br>' . TEXT_EDIT_CATEGORIES_IMAGE . '<br>' . tep_draw_file_field('categories_image'));
        $contents[] = array('text' => '<br>' . TEXT_EDIT_SORT_ORDER . '<br>' . tep_draw_input_field('sort_order', $cInfo->sort_order, 'size="2"'));
// EOF Open Featured Sets
 		$contents[] = array('text' => '<br>' . TEXT_CATEGORIES_FEATURED . '<br>' . tep_draw_radio_field('categories_featured', '1', $in_fc_status) . '&nbsp;' . TEXT_CATEGORIES_YES . '&nbsp;' . tep_draw_radio_field('categories_featured', '0', $out_fc_status) . '&nbsp;' . TEXT_CATEGORIES_NO);
 		$contents[] = array('text' => '<br>' . TEXT_CATEGORIES_FEATURED_DATE . '<small>(YYYY-MM-DD)</small><br>' . $cInfo->categories_featured_until . '<br><script type="text/javascript">CategoriesEditFeaturedUntil.writeControl(); CategoriesEditFeaturedUntil.dateFormat="yyyy-MM-dd";</script>');
// EOF Open Featured Sets
// BOF SPPC hide products and categories from groups
        $category_hide_string = '<br>'. "\n" . TEXT_HIDE_CATEGORIES_FROM_GROUPS;
         for ($i = 0; $i < count($customers_groups); $i++) {
            $category_hide_string .= '<br>' . "\n" . tep_draw_checkbox_field('hide_cat[' . $customers_groups[$i]['id'] . ']',  $customers_groups[$i]['id'] , (in_array($customers_groups[$i]['id'], $hide_cat_from_groups_array)) ? 1: 0) . '&#160;&#160;' . $customers_groups[$i]['text'];
          }
        $contents[] = array('text' => $category_hide_string);
// EOF SPPC hide products and categories from groups
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
        break;
      case 'delete_category':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_CATEGORY . '</b>');

        $contents = array('form' => tep_draw_form('categories', FILENAME_CATEGORIES, 'action=delete_category_confirm&cPath=' . $cPath) . tep_draw_hidden_field('categories_id', $cInfo->categories_id));
        $contents[] = array('text' => TEXT_DELETE_CATEGORY_INTRO);
        $contents[] = array('text' => '<br><b>' . $cInfo->categories_name . '</b>');
        if ($cInfo->childs_count > 0) $contents[] = array('text' => '<br>' . sprintf(TEXT_DELETE_WARNING_CHILDS, $cInfo->childs_count));
        if ($cInfo->products_count > 0) $contents[] = array('text' => '<br>' . sprintf(TEXT_DELETE_WARNING_PRODUCTS, $cInfo->products_count));
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
        break;
      case 'move_category':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_MOVE_CATEGORY . '</b>');

        $contents = array('form' => tep_draw_form('categories', FILENAME_CATEGORIES, 'action=move_category_confirm&cPath=' . $cPath) . tep_draw_hidden_field('categories_id', $cInfo->categories_id));
        $contents[] = array('text' => sprintf(TEXT_MOVE_CATEGORIES_INTRO, $cInfo->categories_name));
        $contents[] = array('text' => '<br>' . sprintf(TEXT_MOVE, $cInfo->categories_name) . '<br>' . tep_draw_pull_down_menu('move_to_category_id', tep_get_category_tree(), $current_category_id));
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_move.gif', IMAGE_MOVE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&cID=' . $cInfo->categories_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
        break;
      case 'delete_product':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_PRODUCT . '</b>');

        $contents = array('form' => tep_draw_form('products', FILENAME_CATEGORIES, 'action=delete_product_confirm&cPath=' . $cPath) . tep_draw_hidden_field('products_id', $pInfo->products_id));
        $contents[] = array('text' => TEXT_DELETE_PRODUCT_INTRO);
        $contents[] = array('text' => '<br><b>' . $pInfo->products_name . '</b>');

        $product_categories_string = '';
        $product_categories = tep_generate_category_path($pInfo->products_id, 'product');
        for ($i = 0, $n = sizeof($product_categories); $i < $n; $i++) {
          $category_path = '';
          for ($j = 0, $k = sizeof($product_categories[$i]); $j < $k; $j++) {
            $category_path .= $product_categories[$i][$j]['text'] . '&nbsp;&gt;&nbsp;';
          }
          $category_path = substr($category_path, 0, -16);
          $product_categories_string .= tep_draw_checkbox_field('product_categories[]', $product_categories[$i][sizeof($product_categories[$i])-1]['id'], true) . '&nbsp;' . $category_path . '<br>';
        }
        $product_categories_string = substr($product_categories_string, 0, -4);

        $contents[] = array('text' => '<br>' . $product_categories_string);
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
        break;
      case 'move_product':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_MOVE_PRODUCT . '</b>');

        $contents = array('form' => tep_draw_form('products', FILENAME_CATEGORIES, 'action=move_product_confirm&cPath=' . $cPath) . tep_draw_hidden_field('products_id', $pInfo->products_id));
        $contents[] = array('text' => sprintf(TEXT_MOVE_PRODUCTS_INTRO, $pInfo->products_name));
        $contents[] = array('text' => '<br>' . TEXT_INFO_CURRENT_CATEGORIES . '<br><b>' . tep_output_generated_category_path($pInfo->products_id, 'product') . '</b>');
        $contents[] = array('text' => '<br>' . sprintf(TEXT_MOVE, $pInfo->products_name) . '<br>' . tep_draw_pull_down_menu('move_to_category_id', tep_get_category_tree(), $current_category_id));
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_move.gif', IMAGE_MOVE) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
        break;
      case 'copy_to':
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_COPY_TO . '</b>');

        $contents = array('form' => tep_draw_form('copy_to', FILENAME_CATEGORIES, 'action=copy_to_confirm&cPath=' . $cPath) . tep_draw_hidden_field('products_id', $pInfo->products_id));
        $contents[] = array('text' => TEXT_INFO_COPY_TO_INTRO);
        $contents[] = array('text' => '<br>' . TEXT_INFO_CURRENT_CATEGORIES . '<br><b>' . tep_output_generated_category_path($pInfo->products_id, 'product') . '</b>');
        $contents[] = array('text' => '<br>' . TEXT_CATEGORIES . '<br>' . tep_draw_pull_down_menu('categories_id', tep_get_category_tree(), $current_category_id));
        $contents[] = array('text' => '<br>' . TEXT_HOW_TO_COPY . '<br>' . tep_draw_radio_field('copy_as', 'link', true) . ' ' . TEXT_COPY_AS_LINK . '<br>' . tep_draw_radio_field('copy_as', 'duplicate') . ' ' . TEXT_COPY_AS_DUPLICATE);
        $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_copy.gif', IMAGE_COPY) . ' <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
        break;
      default:
        if ($rows > 0) {
          if (isset($cInfo) && is_object($cInfo)) { // category info box contents
            $category_path_string = '';
            $category_path = tep_generate_category_path($cInfo->categories_id);
            for ($i=(sizeof($category_path[0])-1); $i>0; $i--) {
              $category_path_string .= $category_path[0][$i]['id'] . '_';
            }
            $category_path_string = substr($category_path_string, 0, -1);
            $heading[] = array('text' => '<b>' . $cInfo->categories_name . '</b>');

            $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&cID=' . $cInfo->categories_id . '&action=edit_category') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&cID=' . $cInfo->categories_id . '&action=delete_category') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $category_path_string . '&cID=' . $cInfo->categories_id . '&action=move_category') . '">' . tep_image_button('button_move.gif', IMAGE_MOVE) . '</a>');
            $contents[] = array('text' => '<br>' . TEXT_DATE_ADDED . ' ' . tep_date_short($cInfo->date_added));
            if (tep_not_null($cInfo->last_modified)) $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . tep_date_short($cInfo->last_modified));
//            $contents[] = array('text' => '<br>' . tep_info_image($cInfo->categories_image, $cInfo->categories_name, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT) . '<br>' . $cInfo->categories_image);
            $contents[] = array('text' => '<br>' . tep_info_image(CATEGORY_IMAGES_DIR . $cInfo->categories_image, $cInfo->categories_name, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT) . '<br>' . $cInfo->categories_image);
            $contents[] = array('text' => '<br>' . TEXT_SUBCATEGORIES . ' ' . $cInfo->childs_count . '<br>' . TEXT_PRODUCTS . ' ' . $cInfo->products_count);
// BOF SPPC hide products and categories from groups
       $category_hidden_from_string = '';
         for ($i = 0; $i < count($customers_groups); $i++) {
           if (in_array($customers_groups[$i]['id'], $hide_cat_from_groups_array)) {
           $category_hidden_from_string .= $customers_groups[$i]['text'] . ', ';
           }
         } // end for ($i = 0; $i < count($customers_groups); $i++)
         $category_hidden_from_string = rtrim($category_hidden_from_string); // remove space on the right
         $category_hidden_from_string = substr($category_hidden_from_string,0,strlen($category_hidden_from_string) -1); // remove last comma
         if (!tep_not_null($category_hidden_from_string)) {
         $category_hidden_from_string = TEXT_GROUPS_NONE;
         }
         $category_hidden_from_string = '<br>'. "\n" . TEXT_HIDDEN_FROM_GROUPS . $category_hidden_from_string;
            $contents[] = array('text' => $category_hidden_from_string);
// EOF SPPC hide products and categories from groups
          } elseif (isset($pInfo) && is_object($pInfo)) { // product info box contents
            $heading[] = array('text' => '<b>' . tep_get_products_name($pInfo->products_id, $languages_id) . '</b>');

// LINE CHANGED: MOD - QT Pro
//          $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=new_product') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=delete_product') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=move_product') . '">' . tep_image_button('button_move.gif', IMAGE_MOVE) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=copy_to') . '">' . tep_image_button('button_copy_to.gif', IMAGE_COPY_TO) . '</a>');
            $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=new_product') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=delete_product') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=move_product') . '">' . tep_image_button('button_move.gif', IMAGE_MOVE) . '</a> <a href="' . tep_href_link(FILENAME_CATEGORIES, 'cPath=' . $cPath . '&pID=' . $pInfo->products_id . '&action=copy_to') . '">' . tep_image_button('button_copy_to.gif', IMAGE_COPY_TO) . '</a><a href="' . tep_href_link("stock.php", 'product_id=' . $pInfo->products_id) . '">' . tep_image_button('button_stock.gif', "Stock") . '</a>');
            $contents[] = array('text' => '<br>' . TEXT_DATE_ADDED . ' ' . tep_date_short($pInfo->products_date_added));
            if (tep_not_null($pInfo->products_last_modified)) $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . tep_date_short($pInfo->products_last_modified));
            if (date('Y-m-d') < $pInfo->products_date_available) $contents[] = array('text' => TEXT_DATE_AVAILABLE . ' ' . tep_date_short($pInfo->products_date_available));
// BOF: MoPics in Admin
           $contents[] = array('text' => 'Main Image (shown as a thumbnail):<br />' . DIR_WS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $image_subdirectory . $pInfo->products_image . '<br /><br /><center><img src="' . HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $image_subdirectory . $pInfo->products_image . '" width="' . SMALL_IMAGE_WIDTH . '" height="' . SMALL_IMAGE_HEIGHT . '" /></center>');
// EOF: MoPics in Admin
            $contents[] = array('text' => '<br>' . TEXT_PRODUCTS_PRICE_INFO . ' ' . $currencies->format($pInfo->products_price) . '<br>' . TEXT_PRODUCTS_QUANTITY_INFO . ' ' . $pInfo->products_quantity);
            $contents[] = array('text' => '<br>' . TEXT_PRODUCTS_AVERAGE_RATING . ' ' . number_format($pInfo->average_rating, 2) . '%');

//BOF QPBPP for SPPC v4.2
            $retail_price = $pInfo->products_price;
            unset($pInfo->products_price);
            $pInfo->products_price[0] = $retail_price;
            $retail_products_qty_blocks = $pInfo->products_qty_blocks;
            unset($pInfo->products_qty_blocks);
            $pInfo->products_qty_blocks[0] = $retail_products_qty_blocks;
            $retail_products_min_order_qty = $pInfo->products_min_order_qty;
            unset($pInfo->products_min_order_qty);
            $pInfo->products_min_order_qty[0] = $retail_products_min_order_qty;
// query the customer groups together with discount categories first, then products_groups
// for group prices, quantity blocks and min order quantities and lastly for price breaks.
// the first query needs minimum MySQL version to be 4.1 (release date february 2003...)
            $customer_groups_dc_query = tep_db_query("select cg.customers_group_id, cg.customers_group_name, dc.discount_categories_name from " . TABLE_CUSTOMERS_GROUPS . " cg left join (select customers_group_id, discount_categories_id from " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " ptdc where ptdc.products_id = '" . $pInfo->products_id. "') as p2dc on p2dc.customers_group_id = cg.customers_group_id left join " . TABLE_DISCOUNT_CATEGORIES . " dc on p2dc.discount_categories_id = dc.discount_categories_id order by customers_group_id");
            while ($customer_groups_dc_results =  tep_db_fetch_array($customer_groups_dc_query)) {
              $customer_groups[$customer_groups_dc_results['customers_group_id']] = $customer_groups_dc_results['customers_group_name'];
              $discount_categories[$customer_groups_dc_results['customers_group_id']] = $customer_groups_dc_results['discount_categories_name'];
            }
            if (count($customer_groups) > 1) {
              $cg_group_price_query = tep_db_query("select customers_group_id, customers_group_price, products_qty_blocks, products_min_order_qty from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . $pInfo->products_id. "'");
              while ($cg_group_price_results = tep_db_fetch_array($cg_group_price_query)) {
                $pInfo->products_price[$cg_group_price_results['customers_group_id']] = $cg_group_price_results['customers_group_price'];
                $pInfo->products_qty_blocks[$cg_group_price_results['customers_group_id']] = $cg_group_price_results['products_qty_blocks'];
                $pInfo->products_min_order_qty[$cg_group_price_results['customers_group_id']] = $cg_group_price_results['products_min_order_qty'];
              }
            } // end if (count($customer_groups) > 1)
            $price_break_query = tep_db_query("select customers_group_id, products_price, products_qty from " . TABLE_PRODUCTS_PRICE_BREAK . " where products_id = '" . $pInfo->products_id. "' order by customers_group_id, products_qty");
            while ($price_break_results = tep_db_fetch_array($price_break_query)) {
              $price_breaks[$price_break_results['customers_group_id']][] = $price_break_results;
            }
            foreach ($customer_groups as $cg_id => $cg_name) {
              $price_break_info = TEXT_PRICE_BREAK_INFO;
              if (isset($price_breaks[$cg_id])) {
                foreach ($price_breaks[$cg_id] as $key => $price_break) {
                  $price_break_info .= $currencies->format($price_break['products_price']) . ' (' . $price_break['products_qty'] . ') <b>::</b> ';
                }
                $price_break_info = substr($price_break_info, 0, -10);
              }
              $contents[] = array('text' => '<p class="infoBoxHeading" style="font-weight:bold;">&nbsp;' . $cg_name . '</p><p>' . TEXT_PRODUCTS_PRICE_INFO . ' ' . (isset($pInfo->products_price[$cg_id]) ? $currencies->format($pInfo->products_price[$cg_id]) : " - ") . '<br>' . TEXT_PRODUCTS_QTY_BLOCKS . ' ' . (isset($pInfo->products_qty_blocks[$cg_id]) ? $pInfo->products_qty_blocks[$cg_id] : "1") . '<br>' . TEXT_PRODUCTS_MIN_ORDER_QTY . ' ' . (isset($pInfo->products_min_order_qty[$cg_id]) ? $pInfo->products_min_order_qty[$cg_id] : "1") . '<br>'. TEXT_DISCOUNT_CATEGORY . ' ' . (isset($discount_categories[$cg_id]) ? $discount_categories[$cg_id] : TEXT_NONE) . '<br>' . $price_break_info . '</p>');
            }
//EOF QPBPP for SPPC


// BOF SPPC hide products and categories from groups
       $product_hidden_from_string = '';
         for ($i = 0; $i < count($customers_groups); $i++) {
           if (in_array($customers_groups[$i]['id'], $hide_product_from_groups_array)) {
             $product_hidden_from_string .= $customers_groups[$i]['text'] . ', ';
           }
         } // end for ($i = 0; $i < count($customers_groups); $i++)
         $product_hidden_from_string = rtrim($product_hidden_from_string); // remove space on the right
         $product_hidden_from_string = substr($product_hidden_from_string,0,strlen($product_hidden_from_string) -1); // remove last comma
         if (!tep_not_null($product_hidden_from_string)) {
           $product_hidden_from_string = TEXT_GROUPS_NONE;
         }
         $product_hidden_from_string = '<br>'. "\n" . TEXT_HIDDEN_FROM_GROUPS . $product_hidden_from_string;
            $contents[] = array('text' => $product_hidden_from_string);
// EOF SPPC hide products and categories from groups
          }
        } else { // create category/product info
          $heading[] = array('text' => '<b>' . EMPTY_CATEGORY . '</b>');

          $contents[] = array('text' => TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS);
        }
        break;
    }

    if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
      echo '            <td width="25%" valign="top">' . "\n";

      $box = new box;
      echo $box->infoBox($heading, $contents);

      echo '            </td>' . "\n";
    }
?>
          </tr>
        </table></td>
      </tr>
    </table>
<?php
  }
?>
    </td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php');
?>