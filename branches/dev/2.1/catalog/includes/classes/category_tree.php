<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

 class osC_CategoryTree {
   var $root_category_id = 0,
       $max_level = 0,
       $data = array(),
       $root_start_string = '',
       $root_end_string = '',
       $parent_start_string = '',
       $parent_end_string = '',
       $parent_group_start_string = '<ul>',
       $parent_group_end_string = '</ul>',
       $child_start_string = '<li>',
       $child_end_string = '</li>',
       $spacer_string = '',
       $spacer_multiplier = 1;

   function osC_CategoryTree($load_from_database = true) {
     global $languages_id;
         $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' order by c.parent_id, c.sort_order, cd.categories_name");
         $this->data = array();
         while ($categories = tep_db_fetch_array($categories_query)) {
           $this->data[$categories['parent_id']][$categories['categories_id']] = array('name' => $categories['categories_name'], 'count' => 0);
         }
   }

   function buildBranch($parent_id, $level = 0) {
     $result = $this->parent_group_start_string;

     if (isset($this->data[$parent_id])) {
       foreach ($this->data[$parent_id] as $category_id => $category) {
         $category_link = $category_id;
         $result .= $this->child_start_string;
         if (isset($this->data[$category_id])) {
           $result .= $this->parent_start_string;
         }

         if ($level == 0) {
           $result .= $this->root_start_string;
         }
         $result .= str_repeat($this->spacer_string, $this->spacer_multiplier * $level) . '<a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $category_link) . '">';
         $result .= $category['name'];
         $result .= '</a>';

         if ($level == 0) {
           $result .= $this->root_end_string;
         }

         if (isset($this->data[$category_id])) {
           $result .= $this->parent_end_string;
         }

         $result .= $this->child_end_string;

         if (isset($this->data[$category_id]) && (($this->max_level == '0') || ($this->max_level > $level+1))) {
           $result .= $this->buildBranch($category_id, $level+1);
         }
       }
     }

     $result .= $this->parent_group_end_string;

     return $result;
   }

   function buildTree() {
     return $this->buildBranch($this->root_category_id);
   }
 }
?>