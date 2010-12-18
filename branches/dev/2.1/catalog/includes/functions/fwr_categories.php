<?php
/**
 * SeoPopOutMenu contribution - oscommerce
 * 
 * oscommerce version compatability - MS-2.2, RC1, RC2, RC2a
 * PHP5, MySQL5 (STRICT TRANS TABLES)
 * Offers a pop out menu system
 * SEO benefits beccause all layer links are in source code as standard html
 * Compatable with multiple category layers
 * @package SeoPopOutMenu
 * @link http://www.fwrmedia.co.uk/ FWR Media
 * @copyright Copyright 2008, FWR Media
 * @author Robert Fisher
 * @filesource catalog/includes/boxes/categories.php
 * @version 1.1.2
 * SuckerTree Vertical Menu 1.1 code by ...
 * Dynamic Drive: http://www.dynamicdrive.com/style/
 * filename categories.php
 */
?>
<!-- categories //-->
<tr>
  <td>
<?php
/**
 * Include the main functions
 */
require_once('includes/functions/fwr_cat_functions.php');
/**
 * If $cachepath = '' cache.ser files will write to catalog root
 * If $cachepath = constant(FWR_MENU_CACHE_PATH) cache.ser files will be writtend to DIR_FS_CACHE
 */
if(false === FWR_MENU_CACHE_PATH) {
$cachepath = ''; // Tries to create the cache file in shop root
} else $cachepath = constant(FWR_MENU_CACHE_PATH);
/**
 * Or we simple load the <languages_id>_categories.ser file and use no query.
 * @param $categories variable is created in includes/functions/fwr_cat_functions.php
 * by function buildCategoriesCache() $categories array can be seperated for understanding into 3 sub variables
 * $categories[<category_id>] holds all of the category info and is multi dimensional
 * $categories['menuid_string'] contains the id of all the parent categories which is needed by suckertree
 * $categories['menuid_js'] contains javascript for suckertree that prints var menuids= using $categories['menuid_string']
 */

//  If the cache file exists OR we are resetting the menu we rebuild the cache using our one query.
if(!file_exists($cachepath . $languages_id . "_categories.ser") 
    || (defined('FWR_MENU_RESET') && FWR_MENU_RESET == 'true') ) {
  $categories = buildCategoriesCache($cachepath, FWR_MENU_ORDER_BY, $languages_id);
} else {
  $categories = loadSerializedFile($cachepath, $languages_id, "_categories.ser");
}
/**
 * @param $menuid_string is set from $categories['menuid_string']
 * it is used later by the sitemap addon of this script
 */
$menuid_string = $categories['menuid_string'];
// Print the javascript for the suckertree var menuids
echo $categories['menuid_js'] . PHP_EOL;
unset($categories['menuid_string'], $categories['menuid_js']); // Housekeeping

  $boxHeading = BOX_HEADING_CATEGORIES;
  
  $corner_top_left = 'rounded';
  $corner_top_right = 'rounded';
  $corner_bottom_left = 'rounded';
  $corner_bottom_right = 'rounded';
  
  $boxContent_attributes = '';
  $boxLink = '';
  $box_base_name = 'categories'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

  ob_start(); // Start output buffering
  displayCategories($categories); // Read categories into buffer
  $info_box_categories = ob_get_contents(); // Pass buffer contents to $info_box_categories
  ob_end_clean(); // Clear the buffer
  
  $boxContent = $info_box_categories;

  include (bts_select('boxes', $box_base_name)); // BTS 1.5
?>
  </td>
</tr>
<!-- categories_eof //-->