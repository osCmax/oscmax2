<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  function tep_get_category_heading_title($category_id, $language_id) {
    $category_query = tep_db_query("select categories_heading_title from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . $category_id . "' and language_id = '" . $language_id . "'");
    $category = tep_db_fetch_array($category_query);
    return $category['categories_heading_title'];
  }

  function tep_get_category_description($category_id, $language_id) {
    $category_query = tep_db_query("select categories_description from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . $category_id . "' and language_id = '" . $language_id . "'");
    $category = tep_db_fetch_array($category_query);
    return $category['categories_description'];
  }

?>
