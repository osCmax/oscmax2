<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

/**
 * SeoPopOutMenu contribution - oscommerce
 * 
 * @link http://www.fwrmedia.co.uk/ FWR Media
 * @copyright Copyright 2008, FWR Media
 * @author Robert Fisher
 */

if(!defined('PHP_EOL'))
define('PHP_EOL', "\r\n"); // May as well start getting used to using it

/**
 * has_children() function
 *
 * @param Category id $id
 * @param Categories array $categories
 * @param Categories already assigned $attributed
 * @param Category layer level $level
 * @return Return the $attributed value
 * This function recursively runs through categories and their children
 */
function has_children($id, $categories, $attributed, $level = 0){
  static $attributed, $level;
  ( isset($attributed) ? NULL : $attributed = array());
  (isset($level) ? NULL : $level = 0);
  if(isset($categories[$id]['children'])){ // Are there any children?
    $level++; // Raise the vevel
    $children = explode(",", $categories[$id]['children']); // Explode the comma seperated list of children
    echo str_repeat("  ", $level+1) . '<ul>' . PHP_EOL; // Open an UL for this child
    echo "<!-- Level $level -->" . PHP_EOL;
    foreach($children as $child_id){ // Loop through the children
      if(isset($categories[$child_id]['name'])){ // Check the child exists
        array_push($attributed, $child_id); // Add the child to the $attributed array as it is now used
        $string =  $categories[$child_id]['name'];
      }
      if(isset($categories[$child_id]['children'])){ // Does this child have its own children?
        echo str_repeat("  ", ($level+2)) . '<li><a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $categories[$child_id]['path']) . '" title="' . $string . '">' . $string . '</a>' . PHP_EOL; // Child has children so dont close the <li>
        has_children($child_id, $categories, $attributed, $level); // Loop through the function again
        echo str_repeat("  ", ($level+2)) . '</li>' . PHP_EOL; // Close the <li> after looping through children
      } elseif(isset($categories[$child_id]['name'])) { // Ensure it is not a blank loop
        echo str_repeat("  ", ($level+2)) . '<li><a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $categories[$child_id]['path']) . '" title="' . $string . '">' . $string . '</a></li>' . PHP_EOL; // Child has no children so close the <li>
      }
      $string = NULL; // Reset the $string to NULL
    } // End child foreach loop
    echo str_repeat("  ", $level+1) . '</ul>' . PHP_EOL; // Close the <ul>
  } // End Are there any children?
  $level = 0; // We are returning to the parent loop so reset $level to 0
  return $attributed; // Return the array of categories that have already
}

/**
 * ULLI() function
 *
 * @param Category Path $path
 * @param Category title $detail
 * @param Category layer level $level
 * @param Parent id or false $parent
 * ULLI works for parents only creating the initial <ul><li>
 */
function ULLI($path, $detail, $level = 0, $parent = false){
  if(false !== $parent) $ULid =  ' id="menu_' . $parent . '"';
  else $ULid = '';
  if ($level === 0){
    echo
    '<ul' . $ULid . '>' . PHP_EOL .
    "<!-- Level $level -->" . PHP_EOL .
    '  <li><a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $path) . '" title="' . $detail . '">' . $detail . '</a>' . PHP_EOL;
  } elseif ($level >= 1){
    echo
    str_repeat('  ', $level+1) . '<ul>' .PHP_EOL .
    str_repeat('  ', ($level+2)) . '<li><a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $path) . '" title="' . $detail . '">' . $detail . '</a>' . PHP_EOL;
  }
}

/**
 * CloseULLI() closes the </li></ul> created in function ULLI()
 *
 * @param Category layer level $level
 * @return Returns the current $level minus 1
 */
function CloseULLI($level = 0){
  if ($level === 0){
    echo
    '  </li>' . PHP_EOL .
    '</ul>' . PHP_EOL;
  } elseif ($level >= 1){
    echo
    str_repeat('  ', ($level+2)) . '</li>' . PHP_EOL .
    str_repeat('  ', $level) . '</ul>' . PHP_EOL;
  }
  return $level--;
}

/**
 * Saves the serialized categories array 
 *
 * @param Full path to cache $filepath
 * @param The serialized $categories array  $serialized
 */
function saveSerializedFile($filepath, $serialized, $languages_id, $filename){
  $handle = fopen($filepath . $languages_id . $filename, "w") or die('Couldn\'t fopen ' . $filename . '.ser');
  fwrite($handle, $serialized) or die('Couldn\'t fwrite ' . $filename . '.ser');
  fclose($handle);

}

/**
 * Loads the serialized $categories array
 *
 * @param Name of the cached file $filename
 * @return Returns the unserialized $categories array
 */
function loadSerializedFile($cachepath, $languages_id, $filename) {
  $filepath = $cachepath . $languages_id . $filename;
  $handle = fopen($filepath, "r");
  $ser_info = fread($handle, filesize($filepath));
  fclose($handle);
  $categories = unserialize($ser_info);
  return $categories;
}

/**
 * Full categories scan
 * 
 * This would be a heavy query for a large site
 *
 * @param can be user defined $order_by
 * @return Returns the SQL result
 */
// Bug Fix #964 - added categories_hide_from_groups section to query. 
function categoriesFullScan($order_by, $languages_id){
global $customer_group_id;
  $sql = "
SELECT c.categories_id, c.parent_id, c.sort_order, cDescr.categories_name
FROM " . TABLE_CATEGORIES . " AS c
INNER JOIN " . TABLE_CATEGORIES_DESCRIPTION . " AS cDescr
WHERE c.categories_id = cDescr.categories_id
AND (cDescr.language_id = '" . (int)$languages_id . "' 
AND find_in_set('" . $customer_group_id . "', categories_hide_from_groups) = 0)
ORDER BY c.parent_id, $order_by, cDescr.categories_name
DESC";

  return tep_db_query($sql);
}

/**
 * Actually print the categories
 *
 * @param The $categories array $categories
 */
function displayCategories($categories){
  $attributed = array();
  $string = '';
?>
    <div class="menudiv">
<?php
foreach($categories as $id => $detail) {
  $level = 0;
  if(!in_array($id, $attributed)){
    $string =  $detail['name'];
    ULLI($detail['path'], $string, $level, $parent = $id);
    $attributed = has_children($id, $categories, $attributed);
  }
  if(!in_array($id, $attributed)) CloseULLI($level);
}
?>
    </div>
<?php  
}

/**
 *  * Building the $categories array
 *
 * @param $filepath - Full path to cache
 * @param $order_by sort setting chosed in oscommerce admin
 * @param $languages_id
 * @return Returns the fully built $categories array as well as javascript
 * Copyright for SuckerTree Vertical Menu 1.1
 * @copyright Dynamic Drive: http://www.dynamicdrive.com/style/
 */
function buildCategoriesCache($filepath, $order_by, $languages_id) {
  $result = categoriesFullScan($order_by, $languages_id);

  $javamenustring = '';
/**
 * Loop through each row
 * creating the raw $categories array
 */
  while($row = tep_db_fetch_array($result)){
    $categories[$row['categories_id']] = array('id'       => $row['categories_id'],
                                               'parent'   => $row['parent_id'],
                                               'sort'     => $row['sort_order'],
                                               'path'     => '',
                                               'name'     => htmlentities($row['categories_name']));

  }
  tep_db_free_result($result); // Housekeeping
/**
 * Loop through the raw $categories array
 * This time we are adding the following:
 * $categories[<cat_id>]['children'] which is a comma seperated list of this categories children
 * $categories[<cat_id>]['path'] which is the cPath but only for parent categories
 * @param $javamenustring a comma seperated string which is later passed to $categories['menuid_string'] 
 */
  foreach($categories as $cat_id => $key) {
    if($key['parent'] != '0'){
      ( isset($categories[$key['parent']]['children']) && $categories[$key['parent']]['children'] !== NULL ? NULL : $categories[$key['parent']]['children'] = '' );
      $categories[$key['parent']]['children'] .= $key['id'] . ',';
    } else {
      $javamenustring .= '"menu_' . $key['id'] . '",';
      $categories[$key['id']]['path'] .= $key['id'];
    }
  }
  // added version 1.1.2
/**
 * Loop through the $categories array yet again
 * $categories[<cat_id>]['path'] is created for all categories EXCEPT parent categories
 * Calls on function setCpath to generate muli layer cPaths
 * 
 */
  foreach($categories as $cat_id => $key) {
    $fullcatpath = '';
    if($key['parent'] != '0') {
      $fullcatpath = setCpath($categories, $key['id']);
      $categories[$key['id']]['path'] = $fullcatpath;
    }
  }

  $javamenustring = rtrim  ($javamenustring, ',');
  $categories['menuid_string'] = $javamenustring;
  $categories['menuid_js'] =
  <<<JSSCRIPT
<script language="javascript" type="text/javascript">
function get_menu_ids() {
var menuids=[$javamenustring] //Enter id(s) of SuckerTree UL menus, separated by commas
return menuids;
}
</script>
<script src="includes/javascript/suckertree.js" type="text/javascript"></script>
JSSCRIPT;

  // Serialize and save the $categories array
  $serialized = serialize($categories);
  if( (defined('FWR_MENU_RESET') && FWR_MENU_RESET == 'true')
  || defined('FWR_SUCKERTREE_MENU_ON') && ('true' === FWR_SUCKERTREE_MENU_ON) && (!file_exists($filepath . $languages_id . "_categories.ser")) ) {
/**
 * We are deleting the old cache files so we will delete all files
 * on the relevant directory path with a  .ser filename
 */
    foreach (glob($filepath . "*.ser") as $filename) {
      unlink($filename);
    }
    // Write the new cache
    saveSerializedFile($filepath, $serialized, $languages_id, "_categories.ser");
    // FWR DOM XML - uncomment the line below to activate
    //if( class_exists('DOMDocument') ) sitemapXML($filepath, $categories);
    $sql = "
UPDATE " . TABLE_CONFIGURATION . "
SET `configuration_value` = 'false'
WHERE `configuration_key` = 'FWR_MENU_RESET'";
    //Reset the FWR Menu reset back to false
    tep_db_query($sql) or die('Update failed ' . mysql_error());
  }
  return $categories;
}

// added version 1.1.2
/**
 * Creates cPaths for multi layer categories
 * Recursive function
 *
 * @param $categories
 * @param $id either the initial category_id which is converted to $entry_id
 * or when recursive will be a parent category id of $entry_id
 * @return Returns the cPath in the following format 37_35_36
 */
function setCpath($categories, $id) {
  static $entry_id, $cpatharray;
  if(!isset($entry_id) || $entry_id == NULL) $entry_id = $id;
  ( empty($cpatharray) ? $cpatharray = array($id) : NULL );
  array_push($cpatharray, $categories[$id]['parent']);
  if( ( isset($categories[$categories[$id]['parent']]['parent'])
  && $categories[$categories[$id]['parent']]['parent'] != '0') ) {
    setCpath($categories, $categories[$id]['parent']);
  }
  $fwrcpath = implode('_', array_reverse($cpatharray));
  if($id == $entry_id) {
    $entry_id = NULL;
    $cpatharray = array();
    return $fwrcpath;
  }
}

/**
 * Called from catalog/sitemap.php
 * Builds a sitemap using both the cached categories and the mapBoxes function
 *
 * @param $cachepath path to cache directory
 * @param $languages_id
 * @param $info_box_categories this variable is created in includes/functions/fwr_categories.php
 * and contains menu xhtml complete with divs uls etc
 * @return Returns sitemap code ready to echo with the array $sitemaptd in two parts
 * $sitemaptd[0], $sitemaptd[1] which print to the left <td> and right <td> in catalog/sitemap.php 
 */
function buildSiteMap($cachepath, $languages_id) {
  global $info_box_categories, $menuid_string;
  if(isset($info_box_categories) && tep_not_null($info_box_categories)) {
    $ids = explode(',', $menuid_string);
    $firsttd =  round(count($ids)/2); // number of parent categories split in two then rounded
    // seperate the $info_box_categories into two parts using $firsttd
    // strstr will give us all code AFTER e.g.  <ul id="menu_33">
    $sitemaptd[1] = strstr($info_box_categories, '<ul id=' . $ids[$firsttd] . '>');
    // Then we str_replace it from $info_box_categories to get the first half 
    $sitemaptd[0] = str_replace($sitemaptd[1], '', $info_box_categories);
    unset($info_box_categories); // Housekeeping
    for($i=0; $i<2; $i++) {
      foreach($ids as $value) {
        // change xhtml like <ul id="menu_33"> to <ul class="sitemap">
        $sitemaptd[$i] = str_replace('id=' . $value, 'class="sitemap"', $sitemaptd[$i]);
      }
      // Strip the divs
      $sitemaptd[$i] = str_replace(array('<div class="menudiv">', '</div>'), '', $sitemaptd[$i]);
    }
    // Now we'll map the boxes using mapBoxes() and add the mapped boxes to the right <td> of catalog/sitemap.php 
    $sitemaptd[1] .= mapBoxes($cachepath, $languages_id);
    return $sitemaptd;
  } else return false;
}

/**
 * Dynamic Sitemap function
 * 
 * Includes all boxes in includes/boxes/
 * indexes their title and links
 * Converts this into xhtml <ul><li></li></ul>
 * Creates a cache file called <languages_id>_boxes.ser
 * indexing is not needed or performed once the cache is created.
 *
 * @param $cachepath path to the .ser cache files
 * @param $languages_id
 * @param $exclude_array an array of boxes files to exclude
 * mapBoxes is dynamic but a bit stupid/greedy it will try to index everything
 * if a box is just not working then add the filename to the $exclude_array
 * A prime example is best_sellers.php that doesn't use propper html links
 * 
 * @return returns well formed code to be added to the right <td> of catalog/sitemap.php
 */
function mapBoxes($cachepath, $languages_id) {
  $boxes_cache_path = $cachepath . $languages_id . '_boxes.ser';
  // If the file doesn't exist or we are resetting then we'll recache
  if(!file_exists($boxes_cache_path)
  || (defined('FWR_MENU_RESET') && FWR_MENU_RESET == 'true') ) {
    // Exclude boxes that are not appropriate for the site map
    $exclude_array = array('categories.php',
    'currencies.php',
    'languages.php',
    'manufacturer.php',
    'order_history.php',
    'product_notifications.php',
    'reviews.php',
    'search.php',
    'shopping_cart.php',
    'specials.php',
    'tell_a_friend.php',
    'whats_new.php',
	'wishlist.php');

    $path = DIR_WS_INCLUDES . 'boxes/';
    $handle = opendir( DIR_WS_INCLUDES . 'boxes/' );
    // Grab all the boxes files
    while ( $file = readdir($handle) ) {
      if( $file != '.' && $file != '..' && $file != '.svn' && strrchr($file, '.php') === '.php') {
        if ( is_file($path . $file) ) {  // Has to be a full path or catches files too
          if( !in_array($file, $exclude_array)) {
            $boxes_files[] = $file;
          }
        }
      }
    }
    closedir( $handle );
    $i = 0;
    foreach($boxes_files as $file) {
      $files[] = $file;
      ob_start(); // Start output buffering
      include($path . $file); // include the /includes/boxes file 
      $html = ob_get_contents(); // Pass buffer contents to $html
      ob_end_clean(); // Clear the buffer
      $pattern = '@<a[^>]+>([^<]+)</a>@'; //pattern to grab all propper html links
      preg_match_all($pattern, $html, $matches);
      $all_matches[$file] = $matches;
      unset($html);
    }
    $serialized = serialize($all_matches); // Serialize the code for storage
    // Save the serialized code so that next load we have little work to do
    saveSerializedFile($cachepath, $serialized, $languages_id, "_boxes.ser");
  } else {
    // We are not resetting and the cache file exists so lets load the serialized file
    $all_matches = loadSerializedFile($cachepath, $languages_id, "_boxes.ser");
  }


/**
 * Loop through the matches created by the preg_match_all() search for links for this file
 */
  foreach($all_matches as $file => $value) {
    $fwr_boxheading = '';
/**
 * Find the box heading title
 * 
 * Firstly check if the defined exists and is using propper oscommerce structure
 * e.g. the defined heading title for example_box.php should be BOX_HEADING_EXAMPLE_BOX
 * If not we will just have to use the file name and hope it is reasonably named
 * e.g. example_box.php will be converted to Example Box
 */
    if (!empty($value[0])) { // If it is empty we'll ignore it and move to the next loop
      ob_start(); // Start output buffering
      $file_stripped = str_replace('.php', '', $file);
      if ( defined('BOX_HEADING_' . strtoupper($file_stripped)) ) {
        $fwr_boxheading = constant('BOX_HEADING_' . strtoupper($file_stripped));
      } else $fwr_boxheading = ucwords(str_replace(array('_', '-'), array(' ', ' '), $file_stripped));
?>
<ul>
  <li><?php echo $fwr_boxheading . "\n"; ?>
   <ul>
<?php
$count = count($value[0]); // How many links did we find?
/**
 * Loop through each <a href="">link</a>
 * Stripping it into its component parts
 */
for($i=0; $i<$count; $i++) {
  // Reformat the url
  $end_link = strstr($value[0][$i], '.php'); // Holds from .php to the end
  $link_close = strstr($end_link, '"');      // Holds from the next " after .php to the end of the link ">title</a>
  // Strip down to the querystring and replacing the ? with &
  $querystring = str_replace(array($link_close, '?'), array('', '&'), strstr($end_link, '?'));
  $qs_array = explode('&', $querystring); // explode the querystring into an array via &
  $filename = str_replace('/', '', strrchr(str_replace($end_link, '', $value[0][$i]), '/')) . '.php'; // The filename.php
  unset($end_link, $querystring, $value[0][$i]); // Housekeeping
  $count2 = count($qs_array); // How many querystring items do we have?
  $seperator = '';
  for($qsi=0; $qsi<$count2; $qsi++) { // Loop through the querystring parts
    if( false === is_integer(strpos($qs_array[$qsi], 'osCsid')) ) { // Ignore it if is an osCsid -- GO AWAY NOT WANTED!
      $params .= $seperator . $qs_array[$qsi]; // Add it to our params with the correct seperator
      $seperator = '&amp;'; // If we are here then we have used the '' seperator so we have to start using &
    }
  }
  // Below we generate a shiny new URL
?>
     <li><a href="<?php echo tep_href_link($filename, $params) . $link_close; ?></li>
<?php
}
?>
   </ul>  
  </li>
</ul>
<?php
$boxes_string .= ob_get_contents(); // Pass the buffer contents to $boxes_string
ob_end_clean(); // Clear the buffer
}
}
return $boxes_string; // We've mapped our boxes so send it back to buildSiteMap where it will be added to catalog/sitemap.php
}

// FWR DOM XML - uncomment the line below to activate
/*
function sitemapXML($filepath, $categories){
  global $languages_id;
  // Does the index exist?
  if( false === file_exists('sitemapIndex.xml') ) {
    $doc = new DOMDocument('1.0', 'UTF-8');
    $doc->formatOutput = true;
    $root = $doc->createElement( "sitemapindex" );
    $root->setAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");

    $doc->appendChild( $root );

    $sitemap1 = $doc->createElement( "sitemap" );
    $loc = $doc->createElement( "loc" );
    $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG . 'sitemapCategories.xml';
    $loc->appendChild(
    $doc->createTextNode( $link ));
    $mod = $doc->createElement( "lastmod" );
    $mod->appendChild(
    $doc->createTextNode( date("Y-m-d") ));
    $sitemap1->appendChild( $loc );
    $sitemap1->appendChild( $mod );
    $root->appendChild( $sitemap1 );

    $sitemap2 = $doc->createElement( "sitemap" );
    $loc2 = $doc->createElement( "loc" );
    $link2 = HTTP_SERVER . DIR_WS_HTTP_CATALOG . 'sitemapProducts.xml';
    $loc2->appendChild(
    $doc->createTextNode( $link2 ));
    $mod2 = $doc->createElement( "lastmod" );
    $mod2->appendChild(
    $doc->createTextNode( date("Y-m-d") ));
    $sitemap2->appendChild( $loc2 );
    $sitemap2->appendChild( $mod2 );
    $root->appendChild( $sitemap2 );

    $doc->save('sitemapIndex.xml');
    unset($root, $doc, $mod, $mod2, $link, $link2, $sitemaqp1, $sitemap2, $loc, $loc2);
  }

  $doc = new DOMDocument('1.0', 'UTF-8');
  $doc->formatOutput = true;
  // Creat the root node
  $root = $doc->createElement( "urlset" );
  $root->setAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");


  $doc->appendChild( $root );

  // Now do the categories
  foreach($categories as $id => $detail) {
    if(preg_match('@[0-9_]@', $detail['path'])){
      $path = $detail['path'];
      $link = tep_href_link(FILENAME_DEFAULT, 'cPath=' . $path, 'NONSSL', false);
      $parent = $doc->createElement( "url" );
      $current = $doc->createElement( "loc" );
      $current->appendChild(
      $doc->createTextNode( $link ));
      //
      $mod = $doc->createElement( "lastmod" );
      $mod->appendChild(
      $doc->createTextNode( date("Y-m-d") ));
      //
      //
      $freq = $doc->createElement( "changefreq" );
      $freq->appendChild(
      $doc->createTextNode( "weekly" ));
      //
      //
      $priority = $doc->createElement( "priority" );
      $priority->appendChild(
      $doc->createTextNode( "0.5" ));
      //
      $parent->appendChild( $current );
      $parent->appendChild( $mod );
      $parent->appendChild( $freq );
      $parent->appendChild( $priority );
      $root->appendChild( $parent );

    }
  }
  $doc->save('sitemapCategories.xml');

  // And finally the products, sadly we need a query here
  $doc = new DOMDocument('1.0', 'UTF-8');
  $doc->formatOutput = true;
  // Creat the root node
  $root = $doc->createElement( "urlset" );
  $root->setAttribute("xmlns", "http://www.sitemaps.org/schemas/sitemap/0.9");


  $doc->appendChild( $root );

  if( false === file_exists($filepath . $languages_id . "_products.ser") ) {

    $sql = "
    SELECT p.products_id, p2c.categories_id,  LEFT(pd.products_description,300), pd.products_name
    FROM " . TABLE_PRODUCTS . " p
    INNER JOIN products_to_categories p2c
    ON p.products_id = p2c.products_id
    INNER JOIN products_description pd
    ON pd.products_id = p.products_id
    WHERE p.products_status = '1'
    AND pd.language_id = '" . (int)$languages_id . "'";
    $result = tep_db_query($sql);
    while( list($id, $cat_id, $description, $name) = mysql_fetch_row($result) ) {

      $fwr_products[$id] = array('link'     => tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $id, 'NONSSL', false),
      'cat_id' => $cat_id,
      'description' => $description,
      'name'   => $name);
    }
    tep_db_free_result($result);
    $serialized = serialize($fwr_products);
    saveSerializedFile($filepath, $serialized, $languages_id, "_products.ser");
  } else {
    $fwr_products = loadSerializedFile($filepath, $languages_id, "_products.ser");
  }

  foreach( $fwr_products as $key => $value ) {
    $parent = $doc->createElement( "url" );
    $current = $doc->createElement( "loc" );
    $current->appendChild(
    $doc->createTextNode( $value['link'] ));

    $mod = $doc->createElement( "lastmod" );
    $mod->appendChild(
    $doc->createTextNode( date("Y-m-d") ));

    $freq = $doc->createElement( "changefreq" );
    $freq->appendChild(
    $doc->createTextNode( "weekly" ));

    $priority = $doc->createElement( "priority" );
    $priority->appendChild(
    $doc->createTextNode( "0.5" ));

    $parent->appendChild( $current );
    $parent->appendChild( $mod );
    $parent->appendChild( $freq );
    $parent->appendChild( $priority );
    $root->appendChild( $parent );
    unset($parent, $current, $mod, $freq, $priority);

  }
  $doc->save('sitemapProducts.xml');

  $rss_title = STORE_NAME;
  $rss_link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
  $rss_description = 'This is my shop description';
  $rss_build = date("Y-m-d");
  $rss_ttl = "60";
  $rssdoc = new DOMDocument('1.0', 'UTF-8');
  $rssdoc->formatOutput = true;

  $rss = $rssdoc->createElement( "rss" );
  $rss->setAttribute("version", "2.0");
  $rssdoc->appendChild( $rss );

  $channel = $rssdoc->createElement( "channel" );

  $title =  $rssdoc->createElement( "title" );
  $title->appendChild(
  $rssdoc->createTextNode( $rss_title ));
  $link =  $rssdoc->createElement( "link" );
  $link->appendChild(
  $rssdoc->createTextNode( $rss_link ));
  $description =  $rssdoc->createElement( "description" );
  $description->appendChild(
  $rssdoc->createTextNode( $rss_description));
  $builddate =  $rssdoc->createElement( "lastBuildDate" );
  $builddate->appendChild(
  $rssdoc->createTextNode( $rss_build ));
  $ttl =  $rssdoc->createElement( "ttl" );
  $ttl->appendChild(
  $rssdoc->createTextNode( $rss_ttl ));


  $channel->appendChild( $title );
  $channel->appendChild( $link );
  $channel->appendChild( $description );
  $channel->appendChild( $builddate );
  $channel->appendChild( $ttl );

  reset($fwr_products);
  foreach( $fwr_products as $key => $value ) {
    $item = $rssdoc->createElement( "item" );
    $ittitle = $rssdoc->createElement( "title" );
    $ittitle->appendChild(
    $rssdoc->createTextNode( utf8_encode($value['name']) ));
    $itlink = $rssdoc->createElement( "link" );
    $itlink->appendChild(
    $rssdoc->createTextNode( $value['link'] ));
    $itdescrip = $rssdoc->createElement( "description" );
    $itdescrip->appendChild(
    $rssdoc->createTextNode( utf8_encode($value['description']) . ' ...' ));

    $item->appendChild( $ittitle );
    $item->appendChild( $itlink );
    $item->appendChild( $itdescrip );

    $channel->appendChild( $item );
  }

  $rss->appendChild( $channel );
  $rssdoc->save('fwrrss.xml');
}
// FWR DOM XML - uncomment the line below to activate
*/
?>