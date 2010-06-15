<?php
/*
$Id: categories.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com
  adapted for Separate Pricing Per Customer, Hide products and categories from groups 2008/08/04

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.

if(defined('FWR_SUCKERTREE_MENU_ON') && 'true' === FWR_SUCKERTREE_MENU_ON) {
include(DIR_WS_FUNCTIONS . 'fwr_categories.php');
} else

   if ((USE_CACHE == 'true') && empty($SID)) {
     echo tep_cache_categories_box();
   } else {

     if ( DISPLAY_DHTML_MENU == 'Dhtml' ) {
       include(DIR_WS_BOXES . 'categories_dhtml.php');
   } elseif (DISPLAY_DHTML_MENU == 'CoolMenu') {
 	  include(DIR_WS_BOXES . 'coolmenu.php');
   } else {


  $boxHeading = BOX_HEADING_CATEGORIES;
  
  $corner_top_left = 'rounded';
  $corner_top_right = 'rounded';
  $corner_bottom_left = 'square';
  $corner_bottom_right = 'rounded';
  
  $boxContent_attributes = '';
  $boxLink = '';
  
  $box_base_name = 'categories'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

  function tep_show_category($counter) {
    
// BoF - Contribution Category Box Enhancement 1.1
//  global $tree, $boxContent, $cPath_array, $cat_name;
//adapted for Separate Pricing Per Customer, Hide products and categories from groups
//    global $tree, $categories_string, $cPath_array, $customer_group_id;
    global $tree, $boxContent, $cPath_array, $customer_group_id, $cat_name;

    for ($i=0; $i<$tree[$counter]['level']; $i++) {
      $boxContent .= "&nbsp;&nbsp;";
    }
    $cPath_new = 'cPath=' . $tree[$counter]['path'];
    $boxContent .= '<a href="';
    $boxContent .= tep_href_link(FILENAME_DEFAULT, $cPath_new) . '">';
   
    if (tep_has_category_subcategories($counter)) {
      $boxContent .= tep_image(DIR_WS_IMAGES . 'pointer_blue.gif', '');
    }
    else {
      $boxContent .= tep_image(DIR_WS_IMAGES . 'pointer_blue_light.gif', '');
    }

    if (isset($cPath_array) && in_array($counter, $cPath_array)) {
      $boxContent .= '<b>';
    }
    
    if ($cat_name == $tree[$counter]['name']) {
      $boxContent .= '<span class="errorText">';
    }

// display category name
    $boxContent .= $tree[$counter]['name'];

                if ($cat_name == $tree[$counter]['name']) {
                        $boxContent .= '</span>';
    }

    if (isset($cPath_array) && in_array($counter, $cPath_array)) {
      $boxContent .= '</b>';
    }
//         EoF Category Box Enhancement

    $boxContent .= '</a>';

    if (SHOW_COUNTS == 'true') {
      $products_in_category = tep_count_products_in_category($counter);
      if ($products_in_category > 0) {
        $boxContent .= '&nbsp;(' . $products_in_category . ')';
      }
    }

    $boxContent .= '<br>';

    if ($tree[$counter]['next_id'] != false) {
      tep_show_category($tree[$counter]['next_id']);
    }
  }
?>
<!-- categories //-->
<?php
// BoF - Contribution Category Box Enhancement 1.1
 if (isset($cPath_array)) {
                for ($i=0, $n=sizeof($cPath_array); $i<$n; $i++) {
                                $categories_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$cPath_array[$i] . "' and language_id = '" . (int)$languages_id . "'");
                                if (tep_db_num_rows($categories_query) > 0)
                                $categories = tep_db_fetch_array($categories_query);
                }
        $cat_name = $categories['categories_name']; 
        }
// EoF Category Box Enhancement

  $boxContent = '';
  $tree = array();

// categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '0' and c.categories_id = cd.categories_id and cd.language_id='" . (int)$languages_id ."' order by sort_order, cd.categories_name");
// BOF SPPC hide categories from groups
  $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '0' and c.categories_id = cd.categories_id and cd.language_id='" . (int)$languages_id ."' and find_in_set('" . $customer_group_id . "', categories_hide_from_groups) = 0 order by sort_order, cd.categories_name");
// EOF SPPC hide categories from groups
  while ($categories = tep_db_fetch_array($categories_query))  {
    $tree[$categories['categories_id']] = array('name' => $categories['categories_name'],
                                                'parent' => $categories['parent_id'],
                                                'level' => 0,
                                                'path' => $categories['categories_id'],
                                                'next_id' => false);

    if (isset($parent_id)) {
      $tree[$parent_id]['next_id'] = $categories['categories_id'];
    }

    $parent_id = $categories['categories_id'];

    if (!isset($first_element)) {
      $first_element = $categories['categories_id'];
    }
  }

  //------------------------
  if (tep_not_null($cPath)) {
    $new_path = '';
    reset($cPath_array);
    while (list($key, $value) = each($cPath_array)) {
      unset($parent_id);
      unset($first_id);
//      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$value . "' and c.categories_id = cd.categories_id and cd.language_id='" . (int)$languages_id ."' order by sort_order, cd.categories_name");
      // BOF SPPC hide categories from groups
      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$value . "' and c.categories_id = cd.categories_id and cd.language_id='" . (int)$languages_id ."' and find_in_set('" . $customer_group_id . "', categories_hide_from_groups) = 0 order by sort_order, cd.categories_name");
      // EOF SPPC hide categories from groups
      if (tep_db_num_rows($categories_query)) {
        $new_path .= $value;
        while ($row = tep_db_fetch_array($categories_query)) {
          $tree[$row['categories_id']] = array('name' => $row['categories_name'],
                                               'parent' => $row['parent_id'],
                                               'level' => $key+1,
                                               'path' => $new_path . '_' . $row['categories_id'],
                                               'next_id' => false);

          if (isset($parent_id)) {
            $tree[$parent_id]['next_id'] = $row['categories_id'];
          }

          $parent_id = $row['categories_id'];

          if (!isset($first_id)) {
            $first_id = $row['categories_id'];
          }

          $last_id = $row['categories_id'];
        }
        $tree[$last_id]['next_id'] = $tree[$value]['next_id'];
        $tree[$value]['next_id'] = $first_id;
        $new_path .= '_';
      } else {
        break;
      }
    }
  }
  tep_show_category($first_element); 


include (bts_select('boxes', $box_base_name)); // BTS 1.5
}
}
?><!-- categories_eof //-->
