<?php
/*
$Id: general.php 14 2006-07-28 17:42:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com
adapted for Separate Pricing Per Customer v4.20 2005/01/29, QPBPP for SPPC v2.0 2008/10/25 and Hide products and categories from customer groups
  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// BOF: MOD - Admin w/access levels
//Check login and file access
function tep_admin_check_login() {
  global $PHP_SELF, $login_groups_id;
  if (!tep_session_is_registered('login_id')) {
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  } else {
    $filename = basename( $PHP_SELF );
    if ($filename != FILENAME_DEFAULT && $filename != FILENAME_FORBIDDEN && $filename != FILENAME_LOGOFF && $filename != FILENAME_ADMIN_ACCOUNT && $filename != FILENAME_POPUP_IMAGE && $filename != 'packingslip.php' && $filename != 'invoice.php') {
      $db_file_query = tep_db_query("select admin_files_name from " . TABLE_ADMIN_FILES . " where FIND_IN_SET( '" . $login_groups_id . "', admin_groups_id) and admin_files_name = '" . $filename . "'");
      if (!tep_db_num_rows($db_file_query)) {
        tep_redirect(tep_href_link(FILENAME_FORBIDDEN));
      }
    }
  }
}

////
//Return 'true' or 'false' value to display boxes and files in index.php and column_left.php
function tep_admin_check_boxes($filename, $boxes='') {
  global $login_groups_id;

  $is_boxes = 1;
  if ($boxes == 'sub_boxes') {
    $is_boxes = 0;
  }
  $dbquery = tep_db_query("select admin_files_id from " . TABLE_ADMIN_FILES . " where FIND_IN_SET( '" . $login_groups_id . "', admin_groups_id) and admin_files_is_boxes = '" . $is_boxes . "' and admin_files_name = '" . $filename . "'");

  $return_value = false;
  if (tep_db_num_rows($dbquery)) {
    $return_value = true;
  }
  return $return_value;
}

////
//Return files stored in box that can be accessed by user
function tep_admin_files_boxes($filename, $sub_box_name, $target_window) {
  global $login_groups_id;
  $sub_boxes = '';

  $dbquery = tep_db_query("select admin_files_name from " . TABLE_ADMIN_FILES . " where FIND_IN_SET( '" . $login_groups_id . "', admin_groups_id) and admin_files_is_boxes = '0' and admin_files_name = '" . $filename . "'");
  if (tep_db_num_rows($dbquery)) {
    $sub_boxes = '<a href="' . tep_href_link($filename) . '" class="menuBoxContentLink" target="_' . $target_window . '">' . $sub_box_name . '</a><br>';
  }
  return $sub_boxes;
}

////
//Return Superfish code for menu items that can be accessed by user - PGM
function tep_admin_jqmenu($filename, $sub_box_name, $target_window) {
  global $login_groups_id;
  $menu_items = '';

  $dbquery = tep_db_query("select admin_files_name from " . TABLE_ADMIN_FILES . " where FIND_IN_SET( '" . $login_groups_id . "', admin_groups_id) and admin_files_is_boxes = '0' and admin_files_name = '" . $filename . "'");
  if (tep_db_num_rows($dbquery)) {
    $menu_items = '<li><a href="' . tep_href_link($filename) . '" target="_' . strtolower($target_window) . '">' . $sub_box_name . '</a></li>';
  }
  return $menu_items;
}

////
//Get selected file for index.php
function tep_selected_file($filename) {
  global $login_groups_id;
  $randomize = FILENAME_ADMIN_ACCOUNT;

  $dbquery = tep_db_query("select admin_files_id as boxes_id from " . TABLE_ADMIN_FILES . " where FIND_IN_SET( '" . $login_groups_id . "', admin_groups_id) and admin_files_is_boxes = '1' and admin_files_name = '" . $filename . "'");
  if (tep_db_num_rows($dbquery)) {
    $boxes_id = tep_db_fetch_array($dbquery);
    $randomize_query = tep_db_query("select admin_files_name from " . TABLE_ADMIN_FILES . " where FIND_IN_SET( '" . $login_groups_id . "', admin_groups_id) and admin_files_is_boxes = '0' and admin_files_to_boxes = '" . $boxes_id['boxes_id'] . "'");
    if (tep_db_num_rows($randomize_query)) {
      $file_selected = tep_db_fetch_array($randomize_query);
      $randomize = $file_selected['admin_files_name'];
    }
  }
  return $randomize;
}
// EOF: MOD - Admin w/access levels

////
// Redirect to another page or site
  function tep_redirect($url) {
    global $logger;
// BOF: MS2 update 501112-Added
    if ( (strstr($url, "\n") != false) || (strstr($url, "\r") != false) ) {
      tep_redirect(tep_href_link(FILENAME_DEFAULT, '', 'NONSSL', false));
    }
// EOF: MS2 update 501112-Added

    header('Location: ' . $url);

    if (STORE_PAGE_PARSE_TIME == 'true') {
      if (!is_object($logger)) $logger = new logger;
      $logger->timer_stop();
    }

    exit;
  }

////
// Parse the data used in the html tags to ensure the tags will not break
  function tep_parse_input_field_data($data, $parse) {
    return strtr(trim($data), $parse);
  }

  function tep_output_string($string, $translate = false, $protected = false) {
    if ($protected == true) {
      return htmlspecialchars($string);
    } else {
      if ($translate == false) {
        return tep_parse_input_field_data($string, array('"' => '&quot;'));
      } else {
        return tep_parse_input_field_data($string, $translate);
      }
    }
  }

  function tep_output_string_protected($string) {
    return tep_output_string($string, false, true);
  }

  function tep_sanitize_string($string) {
    $patterns = array ('/ +/','/[<>]/');
    $replace = array (' ', '_');
    return preg_replace($patterns, $replace, trim($string));
  }

  function tep_customers_name($customers_id) {
    $customers = tep_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customers_id . "'");
    $customers_values = tep_db_fetch_array($customers);

    return $customers_values['customers_firstname'] . ' ' . $customers_values['customers_lastname'];
  }

  function tep_get_path($current_category_id = '') {
    global $cPath_array;

    if ($current_category_id == '') {
      $cPath_new = implode('_', $cPath_array);
    } else {
      if (sizeof($cPath_array) == 0) {
        $cPath_new = $current_category_id;
      } else {
        $cPath_new = '';
        $last_category_query = tep_db_query("select parent_id from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$cPath_array[(sizeof($cPath_array)-1)] . "'");
        $last_category = tep_db_fetch_array($last_category_query);

        $current_category_query = tep_db_query("select parent_id from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "'");
        $current_category = tep_db_fetch_array($current_category_query);

        if ($last_category['parent_id'] == $current_category['parent_id']) {
          for ($i = 0, $n = sizeof($cPath_array) - 1; $i < $n; $i++) {
            $cPath_new .= '_' . $cPath_array[$i];
          }
        } else {
          for ($i = 0, $n = sizeof($cPath_array); $i < $n; $i++) {
            $cPath_new .= '_' . $cPath_array[$i];
          }
        }

        $cPath_new .= '_' . $current_category_id;

        if (substr($cPath_new, 0, 1) == '_') {
          $cPath_new = substr($cPath_new, 1);
        }
      }
    }

    return 'cPath=' . $cPath_new;
  }

  function tep_get_all_get_params($exclude_array = '') {
    global $_GET;

    if ($exclude_array == '') $exclude_array = array();

    $get_url = '';

    reset($_GET);
    while (list($key, $value) = each($_GET)) {
      if (($key != tep_session_name()) && ($key != 'error') && (!in_array($key, $exclude_array))) $get_url .= $key . '=' . $value . '&amp;';
    }

    return $get_url;
  }

  function tep_date_long($raw_date) {
    if ( ($raw_date == '0000-00-00 00:00:00') || ($raw_date == '') ) return false;

    $year = (int)substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = (int)substr($raw_date, 8, 2);
    $hour = (int)substr($raw_date, 11, 2);
    $minute = (int)substr($raw_date, 14, 2);
    $second = (int)substr($raw_date, 17, 2);

    return strftime(DATE_FORMAT_LONG, mktime($hour, $minute, $second, $month, $day, $year));
  }

////
// Output a raw date string in the selected locale date format
// $raw_date needs to be in this format: YYYY-MM-DD HH:MM:SS
// NOTE: Includes a workaround for dates before 01/01/1970 that fail on windows servers
  function tep_date_short($raw_date) {
    if ( ($raw_date == '0000-00-00 00:00:00') || ($raw_date == '') ) return false;

    $year = substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = (int)substr($raw_date, 8, 2);
    $hour = (int)substr($raw_date, 11, 2);
    $minute = (int)substr($raw_date, 14, 2);
    $second = (int)substr($raw_date, 17, 2);

    if (@date('Y', mktime($hour, $minute, $second, $month, $day, $year)) == $year) {
      return date(DATE_FORMAT, mktime($hour, $minute, $second, $month, $day, $year));
    } else {
      return preg_replace('/2037$/', $year, date(DATE_FORMAT, mktime($hour, $minute, $second, $month, $day, 2037)));
    }

  }

  function tep_datetime_short($raw_datetime) {
    if ( ($raw_datetime == '0000-00-00 00:00:00') || ($raw_datetime == '') ) return false;

    $year = (int)substr($raw_datetime, 0, 4);
    $month = (int)substr($raw_datetime, 5, 2);
    $day = (int)substr($raw_datetime, 8, 2);
    $hour = (int)substr($raw_datetime, 11, 2);
    $minute = (int)substr($raw_datetime, 14, 2);
    $second = (int)substr($raw_datetime, 17, 2);

    return strftime(DATE_TIME_FORMAT, mktime($hour, $minute, $second, $month, $day, $year));
  }

  function tep_get_category_tree($parent_id = '0', $spacing = '', $exclude = '', $category_tree_array = '', $include_itself = false) {
    global $languages_id;

    if (!is_array($category_tree_array)) $category_tree_array = array();
    if ( (sizeof($category_tree_array) < 1) && ($exclude != '0') ) $category_tree_array[] = array('id' => '0', 'text' => TEXT_TOP);

    if ($include_itself) {
      $category_query = tep_db_query("select cd.categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " cd where cd.language_id = '" . (int)$languages_id . "' and cd.categories_id = '" . (int)$parent_id . "'");
      $category = tep_db_fetch_array($category_query);
      $category_tree_array[] = array('id' => $parent_id, 'text' => $category['categories_name']);
    }

    $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and c.parent_id = '" . (int)$parent_id . "' order by c.sort_order, cd.categories_name");
    while ($categories = tep_db_fetch_array($categories_query)) {
      if ($exclude != $categories['categories_id']) $category_tree_array[] = array('id' => $categories['categories_id'], 'text' => $spacing . $categories['categories_name']);
      $category_tree_array = tep_get_category_tree($categories['categories_id'], $spacing . '&nbsp;&nbsp;&nbsp;', $exclude, $category_tree_array);
    }

    return $category_tree_array;
  }

  function tep_draw_products_pull_down($name, $parameters = '', $exclude = '') {
    global $currencies, $languages_id;

    if ($exclude == '') {
      $exclude = array();
    }

    $select_string = '<select name="' . $name . '"';

    if ($parameters) {
      $select_string .= ' ' . $parameters;
    }

    $select_string .= '>';
// BOF: MOD - Separate Price Per Customer
      $all_groups=array();
      $customers_groups_query = tep_db_query("select customers_group_name, customers_group_id from " . TABLE_CUSTOMERS_GROUPS . " order by customers_group_id ");
      while ($existing_groups =  tep_db_fetch_array($customers_groups_query)) {
          $all_groups[$existing_groups['customers_group_id']]=$existing_groups['customers_group_name'];
      }
// EOF: MOD - Separate Price Per Customer

    $products_query = tep_db_query("select p.products_id, pd.products_name, p.products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "' order by products_name");
    while ($products = tep_db_fetch_array($products_query)) {

// BOF: MOD - Separate Price Per Customer
//      if (!in_array($products['products_id'], $exclude)) {
//        $select_string .= '<option value="' . $products['products_id'] . '">' . $products['products_name'] . ' (' . $currencies->format($products['products_price']) . ')</option>';
     if (!in_array($products['products_id'], $exclude)) {
         $price_query=tep_db_query("select customers_group_price, customers_group_id from " . TABLE_PRODUCTS_GROUPS . " where products_id = " . $products['products_id']);
         $product_prices=array();
         while($prices_array=tep_db_fetch_array($price_query)){
             $product_prices[$prices_array['customers_group_id']]=$prices_array['customers_group_price'];
         }
         reset($all_groups);
         $price_string="";
         $sde=0;
         while(list($sdek,$sdev)=each($all_groups)){
             if (!in_array((int)$products['products_id'].":".(int)$sdek, $exclude)) {
                 if($sde)
                    $price_string.=", ";
                 $price_string.=$sdev.": ".$currencies->format(isset($product_prices[$sdek]) ? $product_prices[$sdek]:$products['products_price']);
                 $sde=1;
             }
         }
         $select_string .= '<option value="' . $products['products_id'] . '">' . $products['products_name'] . ' (' . $price_string . ')</option>\n';
// EOF: MOD - Separate Price Per Customer
      }
    }

    $select_string .= '</select>';

    return $select_string;
  }

  function tep_options_name($options_id) {
    global $languages_id;

    $options = tep_db_query("select products_options_name from " . TABLE_PRODUCTS_OPTIONS . " where products_options_id = '" . (int)$options_id . "' and language_id = '" . (int)$languages_id . "'");
    $options_values = tep_db_fetch_array($options);

    return $options_values['products_options_name'];
  }

  function tep_values_name($values_id) {
    global $languages_id;

    $values = tep_db_query("select products_options_values_name from " . TABLE_PRODUCTS_OPTIONS_VALUES . " where products_options_values_id = '" . (int)$values_id . "' and language_id = '" . (int)$languages_id . "'");
    $values_values = tep_db_fetch_array($values);

    return $values_values['products_options_values_name'];
  }

  function tep_info_image($image, $alt, $width = '', $height = '') {
    if (tep_not_null($image) && (file_exists(DIR_FS_CATALOG_IMAGES . $image)) ) {
      $image = tep_image(DIR_WS_CATALOG_IMAGES . $image, $alt, $width, $height);
    } else {
      $image = TEXT_IMAGE_NONEXISTENT;
    }

    return $image;
  }

  function tep_break_string($string, $len, $break_char = '-') {
    $l = 0;
    $output = '';
    for ($i=0, $n=strlen($string); $i<$n; $i++) {
      $char = substr($string, $i, 1);
      if ($char != ' ') {
        $l++;
      } else {
        $l = 0;
      }
      if ($l > $len) {
        $l = 1;
        $output .= $break_char;
      }
      $output .= $char;
    }

    return $output;
  }

  function tep_get_country_name($country_id) {
    $country_query = tep_db_query("select countries_name from " . TABLE_COUNTRIES . " where countries_id = '" . (int)$country_id . "' and active = 1 order by countries_name");

    if (!tep_db_num_rows($country_query)) {
      return $country_id;
    } else {
      $country = tep_db_fetch_array($country_query);
      return $country['countries_name'];
    }
  }

  function tep_get_zone_name($country_id, $zone_id, $default_zone) {
    $zone_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country_id . "' and zone_id = '" . (int)$zone_id . "'");
    if (tep_db_num_rows($zone_query)) {
      $zone = tep_db_fetch_array($zone_query);
      return $zone['zone_name'];
    } else {
      return $default_zone;
    }
  }

  function tep_not_null($value) {
    if (is_array($value)) {
      if (sizeof($value) > 0) {
        return true;
      } else {
        return false;
      }
    } else {
      if ( (is_string($value) || is_int($value)) && ($value != '') && ($value != 'NULL') && (strlen(trim($value)) > 0)) {
        return true;
      } else {
        return false;
      }
    }
  }

  function tep_browser_detect($component) {
    global $HTTP_USER_AGENT;

    return stristr($HTTP_USER_AGENT, $component);
  }

  function tep_tax_classes_pull_down($parameters, $selected = '') {
    $select_string = '<select ' . $parameters . '>';
    $classes_query = tep_db_query("select tax_class_id, tax_class_title from " . TABLE_TAX_CLASS . " order by tax_class_title");
    while ($classes = tep_db_fetch_array($classes_query)) {
      $select_string .= '<option value="' . $classes['tax_class_id'] . '"';
      if ($selected == $classes['tax_class_id']) $select_string .= ' SELECTED';
      $select_string .= '>' . $classes['tax_class_title'] . '</option>';
    }
    $select_string .= '</select>';

    return $select_string;
  }

  function tep_geo_zones_pull_down($parameters, $selected = '') {
    $select_string = '<select ' . $parameters . '>';
    $zones_query = tep_db_query("select geo_zone_id, geo_zone_name from " . TABLE_GEO_ZONES . " order by geo_zone_name");
    while ($zones = tep_db_fetch_array($zones_query)) {
      $select_string .= '<option value="' . $zones['geo_zone_id'] . '"';
      if ($selected == $zones['geo_zone_id']) $select_string .= ' SELECTED';
      $select_string .= '>' . $zones['geo_zone_name'] . '</option>';
    }
    $select_string .= '</select>';

    return $select_string;
  }

  function tep_get_geo_zone_name($geo_zone_id) {
    $zones_query = tep_db_query("select geo_zone_name from " . TABLE_GEO_ZONES . " where geo_zone_id = '" . (int)$geo_zone_id . "'");

    if (!tep_db_num_rows($zones_query)) {
      $geo_zone_name = $geo_zone_id;
    } else {
      $zones = tep_db_fetch_array($zones_query);
      $geo_zone_name = $zones['geo_zone_name'];
    }

    return $geo_zone_name;
  }

////
// Returns the address_format_id for the given country
// TABLES: countries;
  function tep_get_address_format_id($country_id) {
    $address_format_query = tep_db_query("select address_format_id as format_id from " . TABLE_COUNTRIES . " where countries_id = '" . (int)$country_id . "'");
    if (tep_db_num_rows($address_format_query)) {
      $address_format = tep_db_fetch_array($address_format_query);
      return $address_format['format_id'];
    } else {
      return '1';
    }
  }



  function tep_address_format($address_format_id, $address, $html, $boln, $eoln) {
    $address_format_query = tep_db_query("select address_format as format from " . TABLE_ADDRESS_FORMAT . " where address_format_id = '" . (int)$address_format_id . "'");
    $address_format = tep_db_fetch_array($address_format_query);

    $company = tep_output_string_protected(ucwords($address['company']));
    if (isset($address['firstname']) && tep_not_null($address['firstname'])) {
      $firstname = tep_output_string_protected (ucwords($address['firstname']));
      $lastname = tep_output_string_protected(ucwords($address['lastname']));
    } elseif (isset($address['name']) && tep_not_null($address['name'])) {
      $firstname = tep_output_string_protected(ucwords($address['name']));
      $lastname = '';
    } else {
      $firstname = '';
      $lastname = '';
    }
    $street = tep_output_string_protected(ucwords($address['street_address']));
    $suburb = tep_output_string_protected(ucwords($address['suburb']));
    $city = tep_output_string_protected(ucwords($address['city']));
    $state = tep_output_string_protected($address['state']);
    if (isset($address['country_id']) && tep_not_null($address['country_id'])) {
      $country = tep_get_country_name($address['country_id']);

      if (isset($address['zone_id']) && tep_not_null($address['zone_id'])) {
        $state = tep_get_zone_code($address['country_id'], $address['zone_id'], $state);
      }
    } elseif (isset($address['country']) && tep_not_null($address['country'])) {
      $country = tep_output_string_protected($address['country']);
    } else {
      $country = '';
    }
    $postcode = tep_output_string_protected($address['postcode']);
    $zip = $postcode;

    if ($html) {
// HTML Mode
      $HR = '<hr>';
      $hr = '<hr>';
      if ( ($boln == '') && ($eoln == "\n") ) { // Values not specified, use rational defaults
        $CR = '<br>';
        $cr = '<br>';
        $eoln = $cr;
      } else { // Use values supplied
        $CR = $eoln . $boln;
        $cr = $CR;
      }
    } else {
// Text Mode
      $CR = $eoln;
      $cr = $CR;
      $HR = '----------------------------------------';
      $hr = '----------------------------------------';
    }

    $statecomma = '';
    $streets = $street;
    if ($suburb != '') $streets = $street . $cr . $suburb;
    if ($country == '') $country = tep_output_string_protected($address['country']);
    if ($state != '') $statecomma = $state . ', ';

    $fmt = $address_format['format'];
    eval("\$address = \"$fmt\";");

    if ( (ACCOUNT_COMPANY == 'true') && (tep_not_null($company)) ) {
      $address = $company . $cr . $address;
    }

    return $address;
  }

  ////////////////////////////////////////////////////////////////////////////////////////////////
  //
  // Function    : tep_get_zone_code
  //
  // Arguments   : country           country code string
  //               zone              state/province zone_id
  //               def_state         default string if zone==0
  //
  // Return      : state_prov_code   state/province code
  //
  // Description : Function to retrieve the state/province code (as in FL for Florida etc)
  //
  ////////////////////////////////////////////////////////////////////////////////////////////////
  function tep_get_zone_code($country, $zone, $def_state) {

    $state_prov_query = tep_db_query("select zone_code from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country . "' and zone_id = '" . (int)$zone . "'");

    if (!tep_db_num_rows($state_prov_query)) {
      $state_prov_code = $def_state;
    }
    else {
      $state_prov_values = tep_db_fetch_array($state_prov_query);
      $state_prov_code = $state_prov_values['zone_code'];
    }

    return $state_prov_code;
  }

  function tep_get_uprid($prid, $params) {
    $uprid = $prid;
    if ( (is_array($params)) && (!strstr($prid, '{')) ) {
      while (list($option, $value) = each($params)) {
        $uprid = $uprid . '{' . $option . '}' . $value;
      }
    }

    return $uprid;
  }

  function tep_get_prid($uprid) {
    $pieces = explode('{', $uprid);

    return $pieces[0];
  }

  function tep_get_languages() {
    $languages_query = tep_db_query("select languages_id, name, code, image, directory from " . TABLE_LANGUAGES . " order by sort_order");
    while ($languages = tep_db_fetch_array($languages_query)) {
      $languages_array[] = array('id' => $languages['languages_id'],
                                 'name' => $languages['name'],
                                 'code' => $languages['code'],
                                 'image' => $languages['image'],
                                 'directory' => $languages['directory']);
    }

    return $languages_array;
  }

  function tep_get_category_name($category_id, $language_id) {
    $category_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$category_id . "' and language_id = '" . (int)$language_id . "'");
    $category = tep_db_fetch_array($category_query);

    return $category['categories_name'];
  }

  function tep_get_orders_status_name($orders_status_id, $language_id = '') {
    global $languages_id;

    if (!$language_id) $language_id = $languages_id;
    $orders_status_query = tep_db_query("select orders_status_name from " . TABLE_ORDERS_STATUS . " where orders_status_id = '" . (int)$orders_status_id . "' and language_id = '" . (int)$language_id . "'");
    $orders_status = tep_db_fetch_array($orders_status_query);

    return $orders_status['orders_status_name'];
  }

  function tep_get_orders_status() {
    global $languages_id;

    $orders_status_array = array();
    $orders_status_query = tep_db_query("select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$languages_id . "' order by orders_status_id");
    while ($orders_status = tep_db_fetch_array($orders_status_query)) {
      $orders_status_array[] = array('id' => $orders_status['orders_status_id'],
                                     'text' => $orders_status['orders_status_name']);
    }

    return $orders_status_array;
  }

  function tep_get_products_name($product_id, $language_id = 0) {
    global $languages_id;

    if ($language_id == 0) $language_id = $languages_id;
    $product_query = tep_db_query("select products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_name'];
  }

  function tep_get_products_description($product_id, $language_id) {
    $product_query = tep_db_query("select products_description from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_description'];
  }

// BOF Open Featured Sets
  function tep_get_products_short($product_id, $language_id) {
    $product_query = tep_db_query("select products_short from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . $product_id . "' and language_id = '" . $language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_short'];
  }
// EOF Open Featured Sets

// BOF: Tabs by PGM

  function tep_get_tab1($product_id, $language_id) {
    $product_query = tep_db_query("select tab1 from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['tab1'];
  }

  function tep_get_tab2($product_id, $language_id) {
    $product_query = tep_db_query("select tab2 from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['tab2'];
  }

  function tep_get_tab3($product_id, $language_id) {
    $product_query = tep_db_query("select tab3 from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['tab3'];
  }

  function tep_get_tab4($product_id, $language_id) {
    $product_query = tep_db_query("select tab4 from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['tab4'];
  }

  function tep_get_tab5($product_id, $language_id) {
    $product_query = tep_db_query("select tab5 from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['tab5'];
  }

  function tep_get_tab6($product_id, $language_id) {
    $product_query = tep_db_query("select tab6 from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['tab6'];
  }

// EOF: Tabs by PGM

  function tep_get_products_url($product_id, $language_id) {
    $product_query = tep_db_query("select products_url from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_url'];
  }

////
// Return the manufacturers URL in the needed language
// TABLES: manufacturers_info
  function tep_get_manufacturer_url($manufacturer_id, $language_id) {
    $manufacturer_query = tep_db_query("select manufacturers_url from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$manufacturer_id . "' and languages_id = '" . (int)$language_id . "'");
    $manufacturer = tep_db_fetch_array($manufacturer_query);

    return $manufacturer['manufacturers_url'];
  }

////
// Wrapper for class_exists() function
// This function is not available in all PHP versions so we test it before using it.
  function tep_class_exists($class_name) {
    if (function_exists('class_exists')) {
      return class_exists($class_name);
    } else {
      return true;
    }
  }

////
// Count how many products exist in a category
// TABLES: products, products_to_categories, categories
  function tep_products_in_category_count($categories_id, $include_deactivated = false) {
    $products_count = 0;

    if ($include_deactivated) {
      $products_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = p2c.products_id and p2c.categories_id = '" . (int)$categories_id . "'");
    } else {
      $products_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = p2c.products_id and p.products_status = '1' and p2c.categories_id = '" . (int)$categories_id . "'");
    }

    $products = tep_db_fetch_array($products_query);

    $products_count += $products['total'];

    $childs_query = tep_db_query("select categories_id from " . TABLE_CATEGORIES . " where parent_id = '" . (int)$categories_id . "'");
    if (tep_db_num_rows($childs_query)) {
      while ($childs = tep_db_fetch_array($childs_query)) {
        $products_count += tep_products_in_category_count($childs['categories_id'], $include_deactivated);
      }
    }

    return $products_count;
  }

////
// Count how many subcategories exist in a category
// TABLES: categories
  function tep_childs_in_category_count($categories_id) {
    $categories_count = 0;

    $categories_query = tep_db_query("select categories_id from " . TABLE_CATEGORIES . " where parent_id = '" . (int)$categories_id . "'");
    while ($categories = tep_db_fetch_array($categories_query)) {
      $categories_count++;
      $categories_count += tep_childs_in_category_count($categories['categories_id']);
    }

    return $categories_count;
  }

//// BOF: Modified $countries_query to use new Active switch for countries
// Returns an array with countries
// TABLES: countries
  function tep_get_countries($default = '') {
    $countries_array = array();
    if ($default) {
      $countries_array[] = array('id' => '',
                                 'text' => $default);
    }
    $countries_query = tep_db_query("select countries_id, countries_name from " . TABLE_COUNTRIES . "  where active = 1 order by countries_name");
    while ($countries = tep_db_fetch_array($countries_query)) {
      $countries_array[] = array('id' => $countries['countries_id'],
                                 'text' => $countries['countries_name']);
    }

    return $countries_array;
  }

////
// return an array with country zones
  function tep_get_country_zones($country_id) {
    $zones_array = array();
    $zones_query = tep_db_query("select zone_id, zone_name from " . TABLE_ZONES . " where zone_country_id = '" . (int)$country_id . "' order by zone_name");
    while ($zones = tep_db_fetch_array($zones_query)) {
      $zones_array[] = array('id' => $zones['zone_id'],
                             'text' => $zones['zone_name']);
    }

    return $zones_array;
  }

  function tep_prepare_country_zones_pull_down($country_id = '') {
// preset the width of the drop-down for Netscape
    $pre = '';
    if ( (!tep_browser_detect('MSIE')) && (tep_browser_detect('Mozilla/4')) ) {
      for ($i=0; $i<45; $i++) $pre .= '&nbsp;';
    }

    $zones = tep_get_country_zones($country_id);

    if (sizeof($zones) > 0) {
      $zones_select = array(array('id' => '', 'text' => PLEASE_SELECT));
      $zones = array_merge($zones_select, $zones);
    } else {
      $zones = array(array('id' => '', 'text' => TYPE_BELOW));
// create dummy options for Netscape to preset the height of the drop-down
      if ( (!tep_browser_detect('MSIE')) && (tep_browser_detect('Mozilla/4')) ) {
        for ($i=0; $i<9; $i++) {
          $zones[] = array('id' => '', 'text' => $pre);
        }
      }
    }

    return $zones;
  }

////
// Get list of address_format_id's
  function tep_get_address_formats() {
    $address_format_query = tep_db_query("select address_format_id from " . TABLE_ADDRESS_FORMAT . " order by address_format_id");
    $address_format_array = array();
    while ($address_format_values = tep_db_fetch_array($address_format_query)) {
      $address_format_array[] = array('id' => $address_format_values['address_format_id'],
                                      'text' => $address_format_values['address_format_id']);
    }
    return $address_format_array;
  }

////
// Alias function for Store configuration values in the Administration Tool
  function tep_cfg_pull_down_country_list($country_id) {
    return tep_draw_pull_down_menu('configuration_value', tep_get_countries(), $country_id);
  }

  function tep_cfg_pull_down_zone_list($zone_id) {
    return tep_draw_pull_down_menu('configuration_value', tep_get_country_zones(STORE_COUNTRY), $zone_id);
  }

          /* One Page Checkout - BEGIN*/
        function tep_cfg_pull_down_zone_list_one_page($zone_id) {
    return tep_draw_pull_down_menu('configuration_value', tep_get_country_zones(ONEPAGE_AUTO_SHOW_DEFAULT_COUNTRY), $zone_id);
  }
          /* One Page Checkout - END*/

  function tep_cfg_pull_down_tax_classes($tax_class_id, $key = '') {
    $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');

    $tax_class_array = array(array('id' => '0', 'text' => TEXT_NONE));
    $tax_class_query = tep_db_query("select tax_class_id, tax_class_title from " . TABLE_TAX_CLASS . " order by tax_class_title");
    while ($tax_class = tep_db_fetch_array($tax_class_query)) {
      $tax_class_array[] = array('id' => $tax_class['tax_class_id'],
                                 'text' => $tax_class['tax_class_title']);
    }

    return tep_draw_pull_down_menu($name, $tax_class_array, $tax_class_id);
  }

// BOF: MOD - QT Pro
// Function to build menu of available class files given a file prefix
// Used for configuring plug-ins for product information attributes
  function tep_cfg_pull_down_class_files($prefix, $current_file) {
    $d=DIR_FS_CATALOG . DIR_WS_CLASSES;
    $function_directory = dir ($d);

    while (false !== ($function = $function_directory->read())) {
      if (preg_match('/^'.$prefix.'(.+)\.php$/',$function,$function_name)) {
          $file_list[]=array('id'=>$function_name[1], 'text'=>$function_name[1]);
      }
    }
    $function_directory->close();

    return tep_draw_pull_down_menu('configuration_value', $file_list, $current_file);
  }
// EOF: MOD - QT Pro

////
// Function to read in text area in admin
 function tep_cfg_textarea($text) {
    return tep_draw_textarea_field('configuration_value', '35', '5', $text);
  }

  function tep_cfg_get_zone_name($zone_id) {
    $zone_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_id = '" . (int)$zone_id . "'");

    if (!tep_db_num_rows($zone_query)) {
      return $zone_id;
    } else {
      $zone = tep_db_fetch_array($zone_query);
      return $zone['zone_name'];
    }
  }

////
// Sets the status of a banner
  function tep_set_banner_status($banners_id, $status) {
    if ($status == '1') {
      return tep_db_query("update " . TABLE_BANNERS . " set status = '1', expires_impressions = NULL, expires_date = NULL, date_status_change = NULL where banners_id = '" . $banners_id . "'");
    } elseif ($status == '0') {
      return tep_db_query("update " . TABLE_BANNERS . " set status = '0', date_status_change = now() where banners_id = '" . $banners_id . "'");
    } else {
      return -1;
    }
  }

////
// Sets the status of a product
  function tep_set_product_status($products_id, $status) {
    if ($status == '1') {
      return tep_db_query("update " . TABLE_PRODUCTS . " set products_status = '1', products_last_modified = now() where products_id = '" . (int)$products_id . "'");
    } elseif ($status == '0') {
	  // BOF Open Featured Sets
      return tep_db_query("update " . TABLE_PRODUCTS . " set products_status = '0',  products_featured = '0', products_last_modified = now() where products_id = '" . (int)$products_id . "'");
 	// EOF Open Featured Set
    } else {
      return -1;
    }
  }

// BOF Open Featured Sets
////
// Sets the featured status of a product
  function tep_set_product_featured($products_id, $featured) {
    if ($featured == '1') {
      return tep_db_query("update " . TABLE_PRODUCTS . " set products_featured = '1', products_last_modified = now(), products_featured_until = '". date('Y/m/d', time() + 86400 * DAYS_UNTIL_FEATURED_PRODUCTS)."' where products_id = '" . (int)$products_id . "'");
    } elseif ($featured == '0') {
      return tep_db_query("update " . TABLE_PRODUCTS . " set products_featured = '0', products_last_modified = now(), products_featured_until = NULL where products_id = '" . (int)$products_id . "'");
    } else {
      return -1;
    }
  }

////
// Sets the featured status of manufacturers
  function tep_set_manufacturers_featured($manufacturers_id, $featured) {
    if ($featured == '1') {
      return tep_db_query("update " . TABLE_MANUFACTURERS . " set manufacturers_featured = '1', last_modified = now(), manufacturers_featured_until = '". date('Y/m/d', time() + 86400 * DAYS_UNTIL_FEATURED_MANUFACTURERS)."' where manufacturers_id = '" . (int)$manufacturers_id . "'");
    } elseif ($featured == '0') {
      return tep_db_query("update " . TABLE_MANUFACTURERS . " set manufacturers_featured = '0', last_modified = now(), manufacturers_featured_until = NULL where manufacturers_id = '" . (int)$manufacturers_id . "'");
    } else {
      return -1;
    }
  }

////
// Sets the featured status of manufacturer
  function tep_set_manufacturer_featured($manufacturers_id, $featured) {
    if ($featured == '1') {
      return tep_db_query("update " . TABLE_MANUFACTURERS . " set manufacturer_featured = '1', last_modified = now(), manufacturer_featured_until = '". date('Y/m/d', time() + 86400 * DAYS_UNTIL_FEATURED_MANUFACTURER)."' where manufacturers_id = '" . (int)$manufacturers_id . "'");
    } elseif ($featured == '0') {
      return tep_db_query("update " . TABLE_MANUFACTURERS . " set manufacturer_featured = '0', last_modified = now(), manufacturer_featured_until = NULL where manufacturers_id = '" . (int)$manufacturers_id . "'");
    } else {
      return -1;
    }
  }

////
// Sets the featured status of categories
  function tep_set_categories_featured($categories_id, $featured) {
    if ($featured == '1') {
      return tep_db_query("update " . TABLE_CATEGORIES . " set categories_featured = '1', last_modified = now(), categories_featured_until = '". date('Y/m/d', time() + 86400 * DAYS_UNTIL_FEATURED_CATEGORIES)."' where categories_id = '" . (int)$categories_id . "'");
    } elseif ($featured == '0') {
      return tep_db_query("update " . TABLE_CATEGORIES . " set categories_featured = '0', last_modified = now(), categories_featured_until = NULL where categories_id = '" . (int)$categories_id . "'");
    } else {
      return -1;
    }
  }
// EOF Open Featured Sets


////
// Sets the status of a product on special
  function tep_set_specials_status($specials_id, $status) {
    if ($status == '1') {
      return tep_db_query("update " . TABLE_SPECIALS . " set status = '1', expires_date = NULL, date_status_change = NULL where specials_id = '" . (int)$specials_id . "'");
    } elseif ($status == '0') {
      return tep_db_query("update " . TABLE_SPECIALS . " set status = '0', date_status_change = now() where specials_id = '" . (int)$specials_id . "'");
    } else {
      return -1;
    }
  }

////
// Return a product's special price (returns nothing if there is no offer)
// TABLES: products
  function tep_get_products_special_price($product_id) {
// BOF Separate Pricing Per Customer
  if (isset($_SESSION['sppc_customer_group_id']) && $_SESSION['sppc_customer_group_id'] != '0') {
    $customer_group_id = $_SESSION['sppc_customer_group_id'];
  } else {
    $customer_group_id = '0';
  }

    $product_query = tep_db_query("select specials_new_products_price from " . TABLE_SPECIALS . " where products_id = '" . (int)$product_id . "' and status and customers_group_id = '" . (int)$customer_group_id . "'");
// EOF Separate Pricing Per Customer
    $product = tep_db_fetch_array($product_query);

    return $product['specials_new_products_price'];
  }

// Sets timeout for the current script.
// Cant be used in safe mode.
  function tep_set_time_limit($limit) {
    if (!get_cfg_var('safe_mode')) {
      set_time_limit($limit);
    }
  }

////
// Alias function for Store configuration values in the Administration Tool
  function tep_cfg_select_option($select_array, $key_value, $key = '') {
    $string = '';

    for ($i=0, $n=sizeof($select_array); $i<$n; $i++) {
      $name = ((tep_not_null($key)) ? 'configuration[' . $key . ']' : 'configuration_value');

      $string .= '<br><input type="radio" name="' . $name . '" value="' . $select_array[$i] . '"';

      if ($key_value == $select_array[$i]) $string .= ' CHECKED';

      $string .= '> ' . $select_array[$i];
    }

    return $string;
  }

////
// Alias function for module configuration keys
  function tep_mod_select_option($select_array, $key_name, $key_value) {
    reset($select_array);
    while (list($key, $value) = each($select_array)) {
      if (is_int($key)) $key = $value;
      $string .= '<br><input type="radio" name="configuration[' . $key_name . ']" value="' . $key . '"';
      if ($key_value == $key) $string .= ' CHECKED';
      $string .= '> ' . $value;
    }

    return $string;
  }

////
// Retreive server information
  function tep_get_system_information() {
    global $_SERVER;

    $db_query = tep_db_query("select now() as datetime");
    $db = tep_db_fetch_array($db_query);

    list($system, $host, $kernel) = preg_split('/[\s,]+/', @exec('uname -a'), 5);

    return array('date' => tep_datetime_short(date('Y-m-d H:i:s')),
                 'system' => $system,
                 'kernel' => $kernel,
                 'host' => $host,
                 'ip' => gethostbyname($host),
                 'uptime' => @exec('uptime'),
                 'http_server' => $_SERVER['SERVER_SOFTWARE'],
                 'php' => PHP_VERSION,
                 'zend' => (function_exists('zend_version') ? zend_version() : ''),
                 'db_server' => DB_SERVER,
                 'db_ip' => gethostbyname(DB_SERVER),
                 'db_version' => 'MySQL ' . (function_exists('mysql_get_server_info') ? mysql_get_server_info() : ''),
                 'db_date' => tep_datetime_short($db['datetime']));
  }

  function tep_generate_category_path($id, $from = 'category', $categories_array = '', $index = 0) {
    global $languages_id;

    if (!is_array($categories_array)) $categories_array = array();

    if ($from == 'product') {
      $categories_query = tep_db_query("select categories_id from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$id . "'");
      while ($categories = tep_db_fetch_array($categories_query)) {
        if ($categories['categories_id'] == '0') {
          $categories_array[$index][] = array('id' => '0', 'text' => TEXT_TOP);
        } else {
          $category_query = tep_db_query("select cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . (int)$categories['categories_id'] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "'");
          $category = tep_db_fetch_array($category_query);
          $categories_array[$index][] = array('id' => $categories['categories_id'], 'text' => $category['categories_name']);
          if ( (tep_not_null($category['parent_id'])) && ($category['parent_id'] != '0') ) $categories_array = tep_generate_category_path($category['parent_id'], 'category', $categories_array, $index);
          $categories_array[$index] = array_reverse($categories_array[$index]);
        }
        $index++;
      }
    } elseif ($from == 'category') {
      $category_query = tep_db_query("select cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . (int)$id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "'");
      $category = tep_db_fetch_array($category_query);
      $categories_array[$index][] = array('id' => $id, 'text' => $category['categories_name']);
      if ( (tep_not_null($category['parent_id'])) && ($category['parent_id'] != '0') ) $categories_array = tep_generate_category_path($category['parent_id'], 'category', $categories_array, $index);
    }

    return $categories_array;
  }

  function tep_output_generated_category_path($id, $from = 'category') {
    $calculated_category_path_string = '';
    $calculated_category_path = tep_generate_category_path($id, $from);
    for ($i=0, $n=sizeof($calculated_category_path); $i<$n; $i++) {
      for ($j=0, $k=sizeof($calculated_category_path[$i]); $j<$k; $j++) {
        $calculated_category_path_string .= $calculated_category_path[$i][$j]['text'] . '&nbsp;&gt;&nbsp;';
      }
      $calculated_category_path_string = substr($calculated_category_path_string, 0, -16) . '<br>';
    }
    $calculated_category_path_string = substr($calculated_category_path_string, 0, -4);

    if (strlen($calculated_category_path_string) < 1) $calculated_category_path_string = TEXT_TOP;

    return $calculated_category_path_string;
  }

  function tep_get_generated_category_path_ids($id, $from = 'category') {
    $calculated_category_path_string = '';
    $calculated_category_path = tep_generate_category_path($id, $from);
    for ($i=0, $n=sizeof($calculated_category_path); $i<$n; $i++) {
      for ($j=0, $k=sizeof($calculated_category_path[$i]); $j<$k; $j++) {
        $calculated_category_path_string .= $calculated_category_path[$i][$j]['id'] . '_';
      }
      $calculated_category_path_string = substr($calculated_category_path_string, 0, -1) . '<br>';
    }
    $calculated_category_path_string = substr($calculated_category_path_string, 0, -4);

    if (strlen($calculated_category_path_string) < 1) $calculated_category_path_string = TEXT_TOP;

    return $calculated_category_path_string;
  }

  function tep_remove_category($category_id) {
    $category_image_query = tep_db_query("select categories_image from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$category_id . "'");
    $category_image = tep_db_fetch_array($category_image_query);

    $duplicate_image_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " where categories_image = '" . tep_db_input($category_image['categories_image']) . "'");
    $duplicate_image = tep_db_fetch_array($duplicate_image_query);

    if ($duplicate_image['total'] < 2) {
      if (file_exists(DIR_FS_CATALOG_IMAGES . $category_image['categories_image'])) {
        @unlink(DIR_FS_CATALOG_IMAGES . $category_image['categories_image']);
      }
    }

    tep_db_query("delete from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$category_id . "'");
    tep_db_query("delete from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$category_id . "'");
    tep_db_query("delete from " . TABLE_PRODUCTS_TO_CATEGORIES . " where categories_id = '" . (int)$category_id . "'");

    if (USE_CACHE == 'true') {
      tep_reset_cache_block('categories');
      tep_reset_cache_block('also_purchased');
    }
  }

  function tep_remove_product($product_id) {
    $product_image_query = tep_db_query("select products_image from " . TABLE_PRODUCTS . " where products_id = '" . (int)$product_id . "'");
    $product_image = tep_db_fetch_array($product_image_query);

    $duplicate_image_query = tep_db_query("select count(*) as total from " . TABLE_PRODUCTS . " where products_image = '" . tep_db_input($product_image['products_image']) . "'");
    $duplicate_image = tep_db_fetch_array($duplicate_image_query);

    if ($duplicate_image['total'] < 2) {
      if (file_exists(DIR_FS_CATALOG_IMAGES . $product_image['products_image'])) {
        @unlink(DIR_FS_CATALOG_IMAGES . $product_image['products_image']);
      }
    }

    tep_db_query("delete from " . TABLE_SPECIALS . " where products_id = '" . (int)$product_id . "'");
    tep_db_query("delete from " . TABLE_PRODUCTS . " where products_id = '" . (int)$product_id . "'");
// LINE ADDED: MOD - Separate Price per Customer
    tep_db_query("delete from " . TABLE_PRODUCTS_GROUPS . " where products_id = '" . (int)$product_id . "'");
// BOF QPBPP for SPPC
    tep_db_query("delete from " . TABLE_PRODUCTS_PRICE_BREAK . " where products_id = '" . (int)$product_id . "'");
    tep_db_query("delete from " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " where products_id = '" . (int)$product_id . "'");
// EOF QPBPP for SPPC
    tep_db_query("delete from " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" . (int)$product_id . "'");
    tep_db_query("delete from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "'");
    tep_db_query("delete from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . (int)$product_id . "'");
    tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET . " where products_id = '" . (int)$product_id . "' or products_id like '" . (int)$product_id . "{%'");
    tep_db_query("delete from " . TABLE_CUSTOMERS_BASKET_ATTRIBUTES . " where products_id = '" . (int)$product_id . "' or products_id like '" . (int)$product_id . "{%'");

// BOF: MOD - Wishlist addition to delete products from the wishlist when deleted
    tep_db_query("delete from " . TABLE_WISHLIST . " where products_id = '" . (int)$product_id . "'");
    tep_db_query("delete from " . TABLE_WISHLIST_ATTRIBUTES . " where products_id = '" . (int)$product_id . "'");
// EOF: MOD - Wishlist addition to delete products from the wishlist when deleted

    $product_reviews_query = tep_db_query("select reviews_id from " . TABLE_REVIEWS . " where products_id = '" . (int)$product_id . "'");
    while ($product_reviews = tep_db_fetch_array($product_reviews_query)) {
      tep_db_query("delete from " . TABLE_REVIEWS_DESCRIPTION . " where reviews_id = '" . (int)$product_reviews['reviews_id'] . "'");
    }
    tep_db_query("delete from " . TABLE_REVIEWS . " where products_id = '" . (int)$product_id . "'");

    if (USE_CACHE == 'true') {
      tep_reset_cache_block('categories');
      tep_reset_cache_block('also_purchased');
    }
        //++++ QT Pro: Begin Changed code
        qtpro_doctor_amputate_all_from_product($product_id);
        //++++ QT Pro: End Changed code
  }

  function tep_remove_order($order_id, $restock = false) {
    if ($restock == 'on') {
// BOF: MOD - QT Pro
//old $order_query = tep_db_query("select products_id, products_quantity from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$order_id . "'");
//    while ($order = tep_db_fetch_array($order_query)) {
//      tep_db_query("update " . TABLE_PRODUCTS . " set products_quantity = products_quantity + " . $order['products_quantity'] . ", products_ordered = products_ordered - " . $order['products_quantity'] . " where products_id = '" . (int)$order['products_id'] . "'");
      $order_query = tep_db_query("select products_id, products_quantity, products_stock_attributes from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$order_id . "'");
      while ($order = tep_db_fetch_array($order_query)) {
        $product_stock_adjust = 0;
        if (tep_not_null($order['products_stock_attributes'])) {
          if ($order['products_stock_attributes'] != '$$DOWNLOAD$$') {
            $attributes_stock_query = tep_db_query("SELECT products_stock_quantity
                                                    FROM " . TABLE_PRODUCTS_STOCK . "
                                                    WHERE products_stock_attributes = '" . $order['products_stock_attributes'] . "'
                                                    AND products_id = '" . (int)$order['products_id'] . "'");
            if (tep_db_num_rows($attributes_stock_query) > 0) {
                $attributes_stock_values = tep_db_fetch_array($attributes_stock_query);
                tep_db_query("UPDATE " . TABLE_PRODUCTS_STOCK . "
                              SET products_stock_quantity = products_stock_quantity + '" . (int)$order['products_quantity'] . "'
                              WHERE products_stock_attributes = '" . $order['products_stock_attributes'] . "'
                              AND products_id = '" . (int)$order['products_id'] . "'");
                $product_stock_adjust = min($order['products_quantity'],  $order['products_quantity']+$attributes_stock_values['products_stock_quantity']);
            } else {
                tep_db_query("INSERT into " . TABLE_PRODUCTS_STOCK . "
                              (products_id, products_stock_attributes, products_stock_quantity)
                              VALUES ('" . (int)$order['products_id'] . "', '" . $order['products_stock_attributes'] . "', '" . (int)$order['products_quantity'] . "')");
                $product_stock_adjust = $order['products_quantity'];
            }
          }
        } else {
            $product_stock_adjust = $order['products_quantity'];
        }
        tep_db_query("UPDATE " . TABLE_PRODUCTS . "
                      SET products_quantity = products_quantity + " . $product_stock_adjust . ", products_ordered = products_ordered - " . (int)$order['products_quantity'] . "
                      WHERE products_id = '" . (int)$order['products_id'] . "'");
//++++ QT Pro: End Changed Code
      }
    }
    tep_db_query("delete from " . TABLE_ORDERS . " where orders_id = '" . (int)$order_id . "'");
    tep_db_query("delete from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . (int)$order_id . "'");
    tep_db_query("delete from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " where orders_id = '" . (int)$order_id . "'");
    tep_db_query("delete from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_id = '" . (int)$order_id . "'");
    tep_db_query("delete from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$order_id . "'");
  }

//  function tep_reset_cache_block($cache_block) {
//     global $cache_blocks;
//
//     for ($i=0, $n=sizeof($cache_blocks); $i<$n; $i++) {
//       if ($cache_blocks[$i]['code'] == $cache_block) {
//         if ($cache_blocks[$i]['multiple']) {
//           if ($dir = @opendir(DIR_FS_CACHE)) {
//             while ($cache_file = readdir($dir)) {
//               $cached_file = $cache_blocks[$i]['file'];
//               $languages = tep_get_languages();
//               for ($j=0, $k=sizeof($languages); $j<$k; $j++) {
//                 $cached_file_unlink = ereg_replace('-language', '-' . $languages[$j]['directory'], $cached_file);
//                 if (ereg('^' . $cached_file_unlink, $cache_file)) {
//                   @unlink(DIR_FS_CACHE . $cache_file);
//                 }
//               }
//             }
//             closedir($dir);
//           }
//         } else {
//           $cached_file = $cache_blocks[$i]['file'];
//           $languages = tep_get_languages();
//           for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
//             $cached_file = ereg_replace('-language', '-' . $languages[$i]['directory'], $cached_file);
//             @unlink(DIR_FS_CACHE . $cached_file);
//           }
//         }
//         break;
//       }
//     }
//   }
//  adapted for Hide products and categories from customer groups for SPPC 2008/08/02
   function tep_reset_cache_block($cache_block) {
    global $cache_blocks;

    for ($i=0, $n=sizeof($cache_blocks); $i<$n; $i++) {
      if ($cache_blocks[$i]['code'] == $cache_block) {
        if ($cache_blocks[$i]['multiple']) {
          if ($dir = @opendir(DIR_FS_CACHE)) {
            while ($cache_file = readdir($dir)) {
              $cached_file = $cache_blocks[$i]['file'];
              $languages = tep_get_languages();
              for ($j=0, $k=sizeof($languages); $j<$k; $j++) {
                $cached_file_unlink = preg_replace('/-language/', '-' . $languages[$j]['directory'], $cached_file);
                // if the file name starts with one of those we are looking for and is a cache file (by
                // checking if it contains the string ".cache" we delete the cache file
                if (preg_match('/^' . $cached_file_unlink .'/', $cache_file)) {
                  @unlink(DIR_FS_CACHE . $cache_file);
                }
              }
            }
            closedir($dir);
          }
        } else {
          // not used using hide products or regular osC, but if so, it assumes the $cache_blocks[$i]['file'] does
          // contain the .cache on the end for example whatever_box-language.cache
          $cached_file = $cache_blocks[$i]['file'];
          $languages = tep_get_languages();
          for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
            $cached_file = preg_replace('/-language/', '-' . $languages[$i]['directory'], $cached_file);
            @unlink(DIR_FS_CACHE . $cached_file);
          }
        }
        break;
      }
    }
  }

  function tep_get_file_permissions($mode) {
// determine type
    if ( ($mode & 0xC000) == 0xC000) { // unix domain socket
      $type = 's';
    } elseif ( ($mode & 0x4000) == 0x4000) { // directory
      $type = 'd';
    } elseif ( ($mode & 0xA000) == 0xA000) { // symbolic link
      $type = 'l';
    } elseif ( ($mode & 0x8000) == 0x8000) { // regular file
      $type = '-';
    } elseif ( ($mode & 0x6000) == 0x6000) { //bBlock special file
      $type = 'b';
    } elseif ( ($mode & 0x2000) == 0x2000) { // character special file
      $type = 'c';
    } elseif ( ($mode & 0x1000) == 0x1000) { // named pipe
      $type = 'p';
    } else { // unknown
      $type = '?';
    }

// determine permissions
    $owner['read']    = ($mode & 00400) ? 'r' : '-';
    $owner['write']   = ($mode & 00200) ? 'w' : '-';
    $owner['execute'] = ($mode & 00100) ? 'x' : '-';
    $group['read']    = ($mode & 00040) ? 'r' : '-';
    $group['write']   = ($mode & 00020) ? 'w' : '-';
    $group['execute'] = ($mode & 00010) ? 'x' : '-';
    $world['read']    = ($mode & 00004) ? 'r' : '-';
    $world['write']   = ($mode & 00002) ? 'w' : '-';
    $world['execute'] = ($mode & 00001) ? 'x' : '-';

// adjust for SUID, SGID and sticky bit
    if ($mode & 0x800 ) $owner['execute'] = ($owner['execute'] == 'x') ? 's' : 'S';
    if ($mode & 0x400 ) $group['execute'] = ($group['execute'] == 'x') ? 's' : 'S';
    if ($mode & 0x200 ) $world['execute'] = ($world['execute'] == 'x') ? 't' : 'T';

    return $type .
           $owner['read'] . $owner['write'] . $owner['execute'] .
           $group['read'] . $group['write'] . $group['execute'] .
           $world['read'] . $world['write'] . $world['execute'];
  }

  function tep_remove($source) {
    global $messageStack, $tep_remove_error;

    if (isset($tep_remove_error)) $tep_remove_error = false;

    if (is_dir($source)) {
      $dir = dir($source);
      while ($file = $dir->read()) {
        if ( ($file != '.') && ($file != '..') ) {
          if (is_writeable($source . '/' . $file)) {
            tep_remove($source . '/' . $file);
          } else {
            $messageStack->add(sprintf(ERROR_FILE_NOT_REMOVEABLE, $source . '/' . $file), 'error');
            $tep_remove_error = true;
          }
        }
      }
      $dir->close();

      if (is_writeable($source)) {
        rmdir($source);
      } else {
        $messageStack->add(sprintf(ERROR_DIRECTORY_NOT_REMOVEABLE, $source), 'error');
        $tep_remove_error = true;
      }
    } else {
      if (is_writeable($source)) {
        unlink($source);
      } else {
        $messageStack->add(sprintf(ERROR_FILE_NOT_REMOVEABLE, $source), 'error');
        $tep_remove_error = true;
      }
    }
  }

////
// Output the tax percentage with optional padded decimals
  function tep_display_tax_value($value, $padding = TAX_DECIMAL_PLACES) {
    if (strpos($value, '.')) {
      $loop = true;
      while ($loop) {
        if (substr($value, -1) == '0') {
          $value = substr($value, 0, -1);
        } else {
          $loop = false;
          if (substr($value, -1) == '.') {
            $value = substr($value, 0, -1);
          }
        }
      }
    }

    if ($padding > 0) {
      if ($decimal_pos = strpos($value, '.')) {
        $decimals = strlen(substr($value, ($decimal_pos+1)));
        for ($i=$decimals; $i<$padding; $i++) {
          $value .= '0';
        }
      } else {
        $value .= '.';
        for ($i=0; $i<$padding; $i++) {
          $value .= '0';
        }
      }
    }

    return $value;
  }

  function tep_mail($to_name, $to_email_address, $email_subject, $email_text, $from_email_name, $from_email_address) {
    if (SEND_EMAILS != 'true') return false;

    // Instantiate a new mail object
    $message = new email(array('X-Mailer: osCmax Mailer'));

    // Build the text version
    $text = strip_tags($email_text);
    if (EMAIL_USE_HTML == 'true') {
      $message->add_html($email_text, $text);
    } else {
      $message->add_text($text);
    }

    // Send message
    $message->build_message();
    $message->send($to_name, $to_email_address, $from_email_name, $from_email_address, $email_subject);
  }

  function tep_get_tax_class_title($tax_class_id) {
    if ($tax_class_id == '0') {
      return TEXT_NONE;
    } else {
      $classes_query = tep_db_query("select tax_class_title from " . TABLE_TAX_CLASS . " where tax_class_id = '" . (int)$tax_class_id . "'");
      $classes = tep_db_fetch_array($classes_query);

      return $classes['tax_class_title'];
    }
  }

  function tep_banner_image_extension() {
    if (function_exists('imagetypes')) {
      if (imagetypes() & IMG_PNG) {
        return 'png';
      } elseif (imagetypes() & IMG_JPG) {
        return 'jpg';
      } elseif (imagetypes() & IMG_GIF) {
        return 'gif';
      }
    } elseif (function_exists('imagecreatefrompng') && function_exists('imagepng')) {
      return 'png';
    } elseif (function_exists('imagecreatefromjpeg') && function_exists('imagejpeg')) {
      return 'jpg';
    } elseif (function_exists('imagecreatefromgif') && function_exists('imagegif')) {
      return 'gif';
    }

    return false;
  }

////
// Wrapper function for round() for php3 compatibility
  function tep_round($value, $precision) {
    return round($value, $precision);
  }

////
// Round up function for non whole numbers by GREG DEETH
// The value for the precision variable determines how many digits after the decimal and rounds the last digit up to the next value
// Precision = 0 -> xx.xxxx = x+
// Precision = 1 -> xx.xxxx = xx.+
// Precision = 2 -> xx.xxxx = xx.x+
  function tep_round_up($number, $precision) {
    $number_whole = '';
    $num_left_dec = 0;
    $num_right_dec = 0;
    $num_digits = strlen($number);
    $number_out = '';
    $i = 0;
    while ($i + 1 <= strlen($number))
    {
        $current_digit = substr($number, $i, ($i + 1) - $num_digits);
        if ($current_digit == '.') {
            $i = $num_digits + 1;
            $num_left_dec = strlen($number_whole);
            $num_right_dec = ($num_left_dec + 1) - $num_digits;
        } else {
            $number_whole = $number_whole . $current_digit;
            $i = $i + 1;
        }
    }
    if ($num_digits > 3 && $precision < ($num_digits - $num_left_dec - 1) && $precision >= 0) {
        $i = $precision;
        $addable = 1;
        while ($i > 0) {
            $addable = $addable * .1;
            $i = $i - 1;
        } 
        $number_out = substr($number, 0, $num_right_dec + $precision) + $addable;
    } else {
        $number_out = $number;
    }
    return $number_out;
  }

////
// Add tax to a products price
  function tep_add_tax($price, $tax, $override = false) {
    if ( ( (DISPLAY_PRICE_WITH_TAX == 'true') || ($override == true) ) && ($tax > 0) ) {
      return $price + tep_calculate_tax($price, $tax);
    } else {
      return $price;
    }
  }

// Calculates Tax rounding the result
  function tep_calculate_tax($price, $tax) {
    return $price * $tax / 100;
  }

////
// Returns the tax rate for a zone / class
// TABLES: tax_rates, zones_to_geo_zones
  function tep_get_tax_rate($class_id, $country_id = -1, $zone_id = -1) {
    global $customer_zone_id, $customer_country_id;

    if ( ($country_id == -1) && ($zone_id == -1) ) {
      if (!tep_session_is_registered('customer_id')) {
        $country_id = STORE_COUNTRY;
        $zone_id = STORE_ZONE;
      } else {
        $country_id = $customer_country_id;
        $zone_id = $customer_zone_id;
      }
    }

    $tax_query = tep_db_query("select sum(tax_rate) as tax_rate from " . TABLE_TAX_RATES . " tr left join " . TABLE_ZONES_TO_GEO_ZONES . " za on (tr.tax_zone_id = za.geo_zone_id) left join " . TABLE_GEO_ZONES . " tz on (tz.geo_zone_id = tr.tax_zone_id) where (za.zone_country_id is null or za.zone_country_id = '0' or za.zone_country_id = '" . (int)$country_id . "') and (za.zone_id is null or za.zone_id = '0' or za.zone_id = '" . (int)$zone_id . "') and tr.tax_class_id = '" . (int)$class_id . "' group by tr.tax_priority");
    if (tep_db_num_rows($tax_query)) {
      $tax_multiplier = 1.0;
      while ($tax = tep_db_fetch_array($tax_query)) {
        $tax_multiplier *= 1.0 + ($tax['tax_rate'] / 100);
      }
      return ($tax_multiplier - 1.0) * 100;
    } else {
      return 0;
    }
  }

////
// Returns the tax rate for a tax class
// TABLES: tax_rates
  function tep_get_tax_rate_value($class_id) {
    $tax_query = tep_db_query("select SUM(tax_rate) as tax_rate from " . TABLE_TAX_RATES . " where tax_class_id = '" . (int)$class_id . "' group by tax_priority");
    if (tep_db_num_rows($tax_query)) {
      $tax_multiplier = 0;
      while ($tax = tep_db_fetch_array($tax_query)) {
        $tax_multiplier += $tax['tax_rate'];
      }
      return $tax_multiplier;
    } else {
      return 0;
    }
  }

  function tep_call_function($function, $parameter, $object = '') {
    if ($object == '') {
      return call_user_func($function, $parameter);

    } else {
      return call_user_func(array($object, $function), $parameter);
    }
  }

  function tep_get_zone_class_title($zone_class_id) {
    if ($zone_class_id == '0') {
      return TEXT_NONE;
    } else {
      $classes_query = tep_db_query("select geo_zone_name from " . TABLE_GEO_ZONES . " where geo_zone_id = '" . (int)$zone_class_id . "'");
      $classes = tep_db_fetch_array($classes_query);

      return $classes['geo_zone_name'];
    }
  }

  function tep_cfg_pull_down_zone_classes($zone_class_id, $key = '') {
    $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');

    $zone_class_array = array(array('id' => '0', 'text' => TEXT_NONE));
    $zone_class_query = tep_db_query("select geo_zone_id, geo_zone_name from " . TABLE_GEO_ZONES . " order by geo_zone_name");
    while ($zone_class = tep_db_fetch_array($zone_class_query)) {
      $zone_class_array[] = array('id' => $zone_class['geo_zone_id'],
                                  'text' => $zone_class['geo_zone_name']);
    }

    return tep_draw_pull_down_menu($name, $zone_class_array, $zone_class_id);
  }

  function tep_cfg_pull_down_order_statuses($order_status_id, $key = '') {
    global $languages_id;

    $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');

    $statuses_array = array(array('id' => '0', 'text' => TEXT_DEFAULT));
    $statuses_query = tep_db_query("select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$languages_id . "' order by orders_status_name");
    while ($statuses = tep_db_fetch_array($statuses_query)) {
      $statuses_array[] = array('id' => $statuses['orders_status_id'],
                                'text' => $statuses['orders_status_name']);
    }

    return tep_draw_pull_down_menu($name, $statuses_array, $order_status_id);
  }

  function tep_get_order_status_name($order_status_id, $language_id = '') {
    global $languages_id;

    if ($order_status_id < 1) return TEXT_DEFAULT;

    if (!is_numeric($language_id)) $language_id = $languages_id;

    $status_query = tep_db_query("select orders_status_name from " . TABLE_ORDERS_STATUS . " where orders_status_id = '" . (int)$order_status_id . "' and language_id = '" . (int)$language_id . "'");
    $status = tep_db_fetch_array($status_query);

    return $status['orders_status_name'];
  }

////
// Return a random value
  function tep_rand($min = null, $max = null) {
    static $seeded;

    if (!$seeded) {
      mt_srand((double)microtime()*1000000);
      $seeded = true;
    }

    if (isset($min) && isset($max)) {
      if ($min >= $max) {
        return $min;
      } else {
        return mt_rand($min, $max);
      }
    } else {
      return mt_rand();
    }
  }

// nl2br() prior PHP 4.2.0 did not convert linefeeds on all OSs (it only converted \n)
  function tep_convert_linefeeds($from, $to, $string) {
    if ((PHP_VERSION < "4.0.5") && is_array($from)) {
      return preg_replace('/(' . implode('|', $from) . ')/', $to, $string);
    } else {
      return str_replace($from, $to, $string);
    }
  }

  function tep_string_to_int($string) {
    return (int)$string;
  }

////
// Parse and secure the cPath parameter values
  function tep_parse_category_path($cPath) {
// make sure the category IDs are integers
    $cPath_array = array_map('tep_string_to_int', explode('_', $cPath));

// make sure no duplicate category IDs exist which could lock the server in a loop
    $tmp_array = array();
    $n = sizeof($cPath_array);
    for ($i=0; $i<$n; $i++) {
      if (!in_array($cPath_array[$i], $tmp_array)) {
        $tmp_array[] = $cPath_array[$i];
      }
    }

    return $tmp_array;
  }

// BOF Open Featured Sets
////
// Alias function for featured configuration values in the Administration Tool
  function tep_cfg_select_featured($select_array, $key_value, $key = '') {
    $string = '';

    for ($i=0, $n=sizeof($select_array); $i<$n; $i++) {
      $name = ((tep_not_null($key)) ? 'configuration[' . $key . ']' : 'configuration_value');

      $string .= '<input type="radio" name="' . $name . '" value="' . $select_array[$i] . '"';

      if ($key_value == $select_array[$i]) $string .= ' CHECKED';

      $string .= '> ' . $select_array[$i];
    }

    return $string;
  }

////
// Alias function for Store configuration values in the Administration Tool
  function tep_cfg_select_color($key_value, $key = '') {
    $string = '';

    $name = ((tep_not_null($key)) ? 'configuration[' . $key . ']' : 'configuration_value');

    $string .= '<SCRIPT LANGUAGE="JavaScript"> var cp = new ColorPicker(\'window\'); </SCRIPT>';
    $string .= '<br><table border="0" cellspacing="0" cellpadding="0"><tr><td><input type="text" name="' . $name . '" id="' . $name . '" value="' . $key_value . '" size="6"></td><td>&nbsp;</td>';
    $string .= '<td><a href="javascript:;" onclick="cp.select(document.configuration.'.$name.',\'pick\');return false;" name="pick" id="pick">'.tep_image_button('button_pick_color.gif', IMAGE_PICK_COLOR).'</a></td></tr></table><br>';

    return $string;
  }
// EOF Open Featured Sets


//++++ QT Pro: Begin Changed code
require(DIR_WS_FUNCTIONS . 'qtpro_functions.php');
//++++ QT Pro: End Changed code
// BOF: MOD - Order Editor
//////create a pull down for all payment installed payment methods for Order Editor configuration
// Get list of all payment modules available
  function tep_cfg_pull_down_payment_methods() {
  global $language;
  $enabled_payment = array();
  $module_directory = DIR_FS_CATALOG_MODULES . 'payment/';
  $file_extension = '.php';

  if ($dir = @dir($module_directory)) {
    while ($file = $dir->read()) {
      if (!is_dir( $module_directory . $file)) {
        if (substr($file, strrpos($file, '.')) == $file_extension) {
          $directory_array[] = $file;
        }
      }
    }
    sort($directory_array);
    $dir->close();
  }

  // For each available payment module, check if enabled
  for ($i=0, $n=sizeof($directory_array); $i<$n; $i++) {
    $file = $directory_array[$i];

    include(DIR_FS_CATALOG_LANGUAGES . $language . '/modules/payment/' . $file);
    include($module_directory . $file);

    $class = substr($file, 0, strrpos($file, '.'));
    if (tep_class_exists($class)) {
      $module = new $class;
      if ($module->check() > 0) {
        // If module enabled create array of titles
        $enabled_payment[] = array('id' => $module->title, 'text' => $module->title);

      }
   }
 }

    $enabled_payment[] = array('id' => 'Other', 'text' => 'Other');

                //draw the dropdown menu for payment methods and default to the order value
          return tep_draw_pull_down_menu('configuration_value', $enabled_payment, '', '');
                }
/////end payment method dropdown
// EOF: MOD - Order Editor

// LINE ADDED: MOD - Downloads Controller
  require(DIR_WS_FUNCTIONS . 'downloads_controller.php');

// LINE ADDED: MOD - IndvShip
//require(DIR_WS_FUNCTIONS . 'indvship_status.php');

// BOF: MOD - FedEx functions
  function tep_ship_request($shipData,$ship_type,$order) {

    $fed = new FedExDC($shipData[0][10],$shipData[1][498]);

    $ship_Ret = $fed->$ship_type($shipData);
    // todo: add appropriate error checking for at least some of the possible errors
    if ($error = $fed->getError()) {
      // in case the ship date is a holiday, check for the error and correct the date
      // todo: correct the date!
      if (preg_match('/FF43/',$error)) {
        echo 'You cannot schedule a pickup on a weekend or holiday! Please go back and change
        the pickup date.';
        die();
      } else {
        echo 'This transaction could not be completed. Please note the error message
              below.<br><br>';
        die("ERROR: ". $error);
      }

    // if successful, we get the tracking number, write the label *.png file to images/fedex,
    // and display the label
    } else {
      $trackNum = $ship_Ret[29];
      // decode and save label, named for the tracking number
      $fed->label(DIR_WS_FEDEX_LABELS . $trackNum . '.png');
    }
    return $trackNum;
  }
// EOF: MOD - FedEx functions

// ULTIMATE Seo Urls 5 by FWR Media
// Reset the seo urls cache
function tep_reset_cache_data_seo_urls($action = false){
  if ( $action == 'reset' ){
    $usu5_path = DIR_FS_CATALOG . DIR_WS_MODULES . 'ultimate_seo_urls5' . DIRECTORY_SEPARATOR;
    switch( SEO_URLS_CACHE_SYSTEM ){
      case 'FileSystem':
        $path_to_cache = realpath($usu5_path . 'cache') . DIRECTORY_SEPARATOR;
        $it = new DirectoryIterator($path_to_cache);
        while( $it->valid() ){
          if ( !$it->isDot() && is_readable($path_to_cache . $it->getFilename()) && (substr($it->getFilename(), -6) == '.cache') ){
            unlink($path_to_cache . $it->getFilename());
          }
          $it->next();
        }
        break;
      case 'Database':
        tep_db_query("TRUNCATE TABLE `usu_cache`");
        break;
      case 'Memcached':
        if ( class_exists('Memcache') ){
          include_once $usu5_path . 'interfaces' . DIRECTORY_SEPARATOR . 'Interface_Cache.php';
          include_once $usu5_path . 'classes' . DIRECTORY_SEPARATOR . 'Usu_Cache_Memcached.php';
          $mc = new Usu_Cache_Memcached('dummy');
          $mc->flushOut();
        }
        break;
    }
    tep_db_query("UPDATE " . TABLE_CONFIGURATION . " SET configuration_value='false' WHERE configuration_key='SEO_URLS_CACHE_RESET'");
  }
}


  function tep_get_products_seo_url($product_id, $language_id = 0) {
    global $languages_id;

    if ($language_id == 0) $language_id = $languages_id;
    $product_query = tep_db_query("select products_seo_url from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);

    return $product['products_seo_url'];
  }
// EOF: ULTIMATE Seo Urls 5 by FWR Media

// BOF: MOD - WebMakers.com Pull the shipping method used on an order
// Return orders shipping method
  function tep_get_orders_shipping_method($order_id) {
    $check_order_query= tep_db_query("select title from " . TABLE_ORDERS_TOTAL . " where orders_id='" . $order_id . "' and class='ot_shipping'");
    $check_order= tep_db_fetch_array($check_order_query);
    if (SHOW_INVOICE_SHIPPING=='2' and ($check_order['title']=='United Parcel Service' or $check_order['title']=='United States Postal Service')) {
      // return short version on UPS and USPS
      $short_shipping_end= strpos($check_order['title'], '');
      $short_shipping= substr($check_order['title'], 1, $short_shipping_end);
      return $short_shipping;
    } else {
      // return normal shipping
      return $check_order['title'];
    }
  }
// EOF: MOD - WebMakers.com Pull the shipping method used on an order
  // >>> BEGIN REGISTER_GLOBALS
  // Work-around functions to allow disabling of register_globals in php.ini
  // These functions perform a similar operation as the 'link_session_variable'
  // function added to .../functions/sessions.php but for the GET, POST, etc
  // variables
  //
  // Parameters:
  // var_name - Name of session variable
  //
  // Returns:
  // None
  function link_get_variable($var_name)
  {
    // Map global to GET variable
    if (isset($_GET[$var_name]))
    {
      $GLOBALS[$var_name] =& $_GET[$var_name];
    }
  }

  function link_post_variable($var_name)
  {
    // Map global to POST variable
    if (isset($_POST[$var_name]))
    {
      $GLOBALS[$var_name] =& $_POST[$var_name];
    }
  }
// <<< END REGISTER_GLOBALS

//BOF QPBPP for SPPC
function qpbpp_insert_update_discount_cats($products_id, $current_discount_categories_id, $new_discount_categories_id, $customers_group_id) {
  if (!tep_not_null($products_id)) {
    return false; // if $products_id is not set stop here
  }
  if ($current_discount_categories_id == $new_discount_categories_id) {
    return true; // if they are the same no update is necessary
  }
  if ($current_discount_categories_id == 0 && $new_discount_categories_id > 0) {
    // insert needed
    tep_db_query("insert into " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " (products_id, discount_categories_id, customers_group_id) values ('" . (int)$products_id . "', '" . (int)$new_discount_categories_id . "', '" . (int)$customers_group_id . "')");
    return true;
  }
  if ($current_discount_categories_id > 0 && $new_discount_categories_id == 0) {
    // delete needed
    tep_db_query("delete from " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " where products_id = '" . (int)$products_id . "' and customers_group_id = '" . (int)$customers_group_id . "'");
    return true;
  }
  if ($current_discount_categories_id > 0 && ($current_discount_categories_id !== $new_discount_categories_id)) {
    // update needed
    tep_db_query("update " . TABLE_PRODUCTS_TO_DISCOUNT_CATEGORIES . " set discount_categories_id = '" . (int)$new_discount_categories_id . "' where products_id = '" . (int)$products_id . "' and discount_categories_id = '" . (int)$current_discount_categories_id . "' and customers_group_id = '" . (int)$customers_group_id . "'");
    return true;
  }
  return false; // for good measure
}

  function sortByQty($a, $b) {
    if ($a['products_qty'] == $b['products_qty']) {
      return 0;
    }
     if ($a['products_qty'] < $b['products_qty']) {
      return -1;
    }
      return 1;
  }
//EOF QPBPP for SPPC

// for customer comments
  function tep_cfg_pull_down_status_change_cancel_list($order_status_id, $key = '') {
    global $languages_id;

    $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');

    $statuses_array = array(array('id' => '0', 'text' => TEXT_DEFAULT));
    $statuses_query = tep_db_query("select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . " where language_id = '" . $languages_id . "' order by orders_status_id");
    while ($statuses = tep_db_fetch_array($statuses_query)) {
      $statuses_array[] = array('id' => $statuses['orders_status_id'],
                                'text' => $statuses['orders_status_name']);
    }

    return tep_draw_pull_down_menu($name, $statuses_array, $order_status_id);
  }

// Function to create pulldown menu for templates by PGM
function tep_cfg_pull_down_templates() {
  $dir_array = array();
  $name = (($key) ? 'configuration[' . $key . ']' : 'configuration_value');

  if ($handle = opendir(DIR_FS_CATALOG.'templates/')) {
    while (false !== ($file = readdir($handle))) {
      if ($file != "." && $file != ".." && $file !=".svn") {
        if (is_dir(DIR_FS_CATALOG.'templates/'.$file)) $dir_array[] = array('id' => $file, 'text' => $file);
      }
    }

  closedir($handle);
  sort($dir_array);

  } else { die("<center><b>No Template Folders!</b></center>");}

  return tep_draw_pull_down_menu($name, $dir_array, '');
}

// strips apostrophes from strings
  function tep_html_noquote($string) {
    $string=str_replace('&#39;', '', $string);
    $string=str_replace("'", "", $string);
    $string=str_replace('"', '', $string);
    $string=preg_replace("/\\r\\n|\\n|\\r/", "<BR>", $string);
  return $string;
  }

// BOF: Extra Product Fields
  function tep_get_extra_field_list_value($value_id, $show_chain = false, $display_type = 0) {
    $sql = tep_db_query("select epf_value, value_image, parent_id from " . TABLE_EPF_VALUES . " where value_id = " . (int)$value_id);
    $value = tep_db_fetch_array($sql);
    $display = $value['epf_value'];
    if (tep_not_null($value['value_image'])) {
      if ($display_type == 2) {
      	$browser = (isset($_SERVER['HTTP_USER_AGENT']) ? strtolower($_SERVER['HTTP_USER_AGENT']) : '');
      	$pos = strpos($browser, 'msie');
      	if ($pos !== false) { // using Internet Explorer requires different display type for inline tables
       	  $vpos = strpos($browser, ';', $pos);
      	  $version = substr($browser, $pos +5, $vpos - $pos - 5);
      	  if ($version < 9) {
      	    $tt = 'inline';
      	  } else {
      	    $tt = 'inline-table';
      	  }
       	} else {
      	  $tt = 'inline-table';
        }
        $display = '<table style="display: ' . $tt . '; vertical-align: middle; text-align: center"><tr><td>' . tep_image(HTTP_CATALOG_SERVER . DIR_WS_CATALOG_IMAGES . 'epf/' . $value['value_image'], $value['epf_value']) . '<br />' . $value['epf_value'] . '</td></tr></table>';
      } elseif ($display_type == 1) {
        $display = tep_image(HTTP_CATALOG_SERVER . DIR_WS_CATALOG_IMAGES . 'epf/' . $value['value_image'], $value['epf_value']);
      }
    }
    if ($show_chain && ($value['parent_id'] > 0)) {
      return tep_get_extra_field_list_value($value['parent_id'], true, $display_type) . ' | ' . $display;
    } else {
      return $display;
    }
  }
  
  function tep_list_epf_children($parent_id) {
    $sql = tep_db_query("select value_id from " . TABLE_EPF_VALUES . " where parent_id = " . (int)$parent_id);
    $list = '';
    while ($i = tep_db_fetch_array($sql)) {
      $list .= ',' . $i['value_id'] . tep_list_epf_children($i['value_id']);
    }
    return $list;
  }
  
  function tep_build_epf_pulldown($epf_id, $languages_id, $value_array = '', $parent_id = 0, $indent = '') {
    if (!is_array($value_array)) $value_array = array();
    $sql = tep_db_query("select epf_value, value_id from " . TABLE_EPF_VALUES . " where epf_id = " . (int)$epf_id . " and languages_id = " . (int)$languages_id . " and parent_id = " . (int)$parent_id . " order by sort_order, epf_value");
    while ($v = tep_db_fetch_array($sql)) {
      $value_array[] = array('id' => $v['value_id'], 'text' => $indent . $v['epf_value']);
      $value_array = tep_build_epf_pulldown($epf_id, $languages_id, $value_array, $v['value_id'], $indent . '&middot;');
    }
    return $value_array;
  }
  
  function tep_get_product_extra_value($epf_id, $product_id, $language_id) {
    $epf_query = tep_db_query("select epf_id, epf_uses_value_list, epf_multi_select from " . TABLE_EPF . " where epf_id = " . (int)$epf_id);
    $e = tep_db_fetch_array($epf_query);
    $field = 'extra_value';
    if ($e['epf_uses_value_list']) {
      if ($e['epf_multi_select']) {
        $field .= '_ms';
      } else {
        $field .= '_id';
      }
    }
    $field .= $e['epf_id'];
    $product_query = tep_db_query("select " . $field . " from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . (int)$product_id . "' and language_id = '" . (int)$language_id . "'");
    $product = tep_db_fetch_array($product_query);
    return $product[$field];
  }
// EOF: Extra Product Fields

?>