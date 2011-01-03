<?php
 /**
 *
 * ULTIMATE Seo Urls 5
 *
 * 
 * @package Ultimate Seo Urls 5
 * @license http://www.opensource.org/licenses/gpl-2.0.php GNU Public License
 * @link http://www.fwrmedia.co.uk
 * @copyright Copyright 2008-2009 FWR Media
 * @copyright Portions Copyright 2005 Bobby Easland
 * @author Robert Fisher, FWR Media, http://www.fwrmedia.co.uk 
 * @lastdev $Author:: Rob                                              $:  Author of last commit
 * @lastmod $Date:: 2009-11-29 17:56:51 +0000 (Sun, 29 Nov 2009)       $:  Date of last commit
 * @version $Rev:: 108                                                 $:  Revision of last commit
 * @Id $Id:: Usu_Categories.php 108 2009-11-29 17:56:51Z Rob           $:  Full Details   
 */

class Usu_Categories extends aDataMap {

  const MARKER = '-c-';  // Could for example be -c- or -l- etc.
  const DEPENDENCY = 'cPath'; // _GET key like e.g. cPath or lPath etc.
  const FILENAME = FILENAME_DEFAULT; // The filename define of the file where this code will be actioned
  public $dependency = self::DEPENDENCY;
  public $dependency_tags = array( self::MARKER => self::FILENAME ); // key value pair of tag (like e.g. -c-) => filename ( e.g. FILENAME_DEFAULT )
  private $page_relations = array( self::FILENAME => 1 ); // Page relation for this module ( e.g. FILENAME_DEFAULT or FILENAME_LINKS )
  private $markers = array( self::MARKER => self::DEPENDENCY ); // Markers as key value pair like -c- => cPath or perhaps -l- => lPath
  private $base_query; // Template query with placeholders ( :placeholder ) waiting for real values
  private $query; // The final query which will be $base_query but with the placeholders replaced with real values
  private $catname; // property populated in the acquire() method, there may be multiples of these, rename in line with the query results
  private $parentname; // property populated in the acquire() method, there may be multiples of these, rename in line with the query results
  private $dependency_value; // Dependency value, so if the dependency was cPath and cPath = 27 then this value would be 27
  private $installed = false; // Unless it is a core module $installed should only be true if the contribution is installed ( e.g. articles or links manager etc )
  
  public function __construct(){
    // The items with a colon : are placeholders which must match the $placeholders array in method acquire()
    $this->base_query = "SELECT cd.categories_name AS cName, cd2.categories_name AS pName FROM " . TABLE_CATEGORIES . " c LEFT JOIN " . TABLE_CATEGORIES_DESCRIPTION . " cd2 ON c.parent_id = cd2.categories_id AND c.parent_id = cd2.categories_id AND cd2.language_id = :languages_id, " . TABLE_CATEGORIES_DESCRIPTION . " cd WHERE c.categories_id = cd.categories_id AND c.categories_id = :cid AND cd.language_id = :languages_id";
    usu::$registry->merge( 'seo_pages', $this->page_relations );
    usu::$registry->merge( 'markers', $this->markers );
    usu::$registry->addPageDependency( array( self::FILENAME => self::DEPENDENCY ));
    /**
    * For modules which are optional ( like information pages etc)
    * we would check for the existance of certain defines and if present set $this->installed to true
    * e.g. for the links contribution we would use ..
    * if ( defined( 'FILENAME_LINKS' ) && defined( 'TABLE_LINK_CATEGORIES_DESCRIPTION' ) ) {
    *   $this->installed = true;
    * }  
    */
    $this->installed = true; // xxx Hardcoded to true in this instance - see above comment.
  }
  
  protected function acquire( $path, $fullpath ) {
    $this->dependency_value = $path; // This is a single item not a path with parents
    /**
    * About placeholders
    *  
    * The placeholders (items with a colon :) must match those in the query ( $this->base_query in the constructor )
    */
    $placeholders = array( ':cid', ':languages_id' );
    // Do the below values need to be typecast?
    $values = array( (int)$this->dependency_value, (int)usu::$languages_id ); // These values will replace the placeholders above in $this->base_query
    $this->query = str_replace( $placeholders, $values, $this->base_query ); // Replace the placeholders with actual values
    $result = usu::query( $this->query ); // Action the query
    $this->query = null; // Unset the query for future usage
    $row = tep_db_fetch_array( $result ); // Return the array of data ( or false if there are no results )
    tep_db_free_result( $result ); // Housekeeping
    if ( false === $row ) {
      return false; // No results for the query so abort
    }
    /**
    *  Values obtained from the query, these properties will populate the registry via the method getProperties()
    * Method $this->linkText() should be used here to convert the text into seo url format e.g.
    * my great product .. may become .. my-great-product
    * You may have more than one of these like ..
    * $this->parentname, $this->catname dependent on how many results you retrieve from your query
    */
    $this->catname = $this->linkText( $row['cName'] );
    $this->parentname = tep_not_null( $row['pName'] ) ? $this->linkText( $row['pName'] ) : 'false';
    
    // If the registry item doesn't exist as a key then set a blank array
    if ( false === isset( usu::$registry->{self::DEPENDENCY} ) ) {
      usu::$registry->{self::DEPENDENCY} = array();
    }
    /**
    * Populate the registry with the properties we have set in this class
    */
    usu::$registry->attach( self::DEPENDENCY, $this->dependency_value, $this->getProperties() );
  } // End method
   
   protected function getProperties() {
     $properties = get_object_vars( $this ); // $properties becomes an array of all properties within this class
     unset( $properties['page_relations'] ); // Get rid of this key as it is not needed in the registry
     return $properties;  
   } // End method
   
   private function get_full_path( $cID ) {
     // Take multiple cPaths back to single
     $initial_input = $cID;
     if ( false !== strpos( $cID, '_' ) ){
       $temp = @explode( '_', $cID );
       $cID = $temp[count( $temp )-1]; // Grab the last number ( e.g. 2_25_35 = 35  )
     }
     // Single category id should be numeric
     if ( false === is_numeric( $cID ) ) {
       trigger_error( 'Passed invalid cPath: ' . $initial_input, E_USER_WARNING );
       return false;
     }
     $c = array();
     $this->get_parents( $c, $cID );
     $c = array_reverse( $c );
     $c[] = $cID;
     $cID = count( $c ) > 1 ? implode( '_', $c ) : $cID;
     return $cID;
   } // End method
   
   private function get_parents( &$categories, $categories_id ) {
     $query = "SELECT parent_id 
     FROM " . TABLE_CATEGORIES . " 
     WHERE categories_id='" . (int)$categories_id . "'";
     $parent_category_query = usu::query( $query );
     $parent_category = tep_db_fetch_array( $parent_category_query );
     tep_db_free_result( $parent_category_query );
     if ( $parent_category['parent_id'] == 0 ){
       return; // We are at the top level so return ending the loop
     }
     $categories[count( $categories )] = $parent_category['parent_id'];
     if ( $parent_category['parent_id'] != $categories_id ) {
       $this->get_parents( $categories, $parent_category['parent_id'] );
     }
   } // End method
   
   /**
   * Builds the seo url
   * 
   * @param string $page - file name of the calling page e.g. index.php
   * @param array $valuepair - key => value pair array containing dependency(e.g. cPath) => value (e.g. 2_24_52)
   * @param string $url - $url passed by reference created by the method linkCreate() 
   * @param array $added_qs - passed by reference containing key value pairs for _GET
   * @param string $parameters - Currently unused
   */
   public function buildLink( $page, $valuepair, &$url, &$added_qs, $parameters ) {
     if ( ( $valuepair[0] != self::DEPENDENCY ) || ( false === array_key_exists( 1, $valuepair ) ) 
                                                || !tep_not_null( $valuepair[1] ) 
                                                || ( false === $this->installed ) ) {
       return false; // Either this module is not installed or the value pair does not meet our requirements so abort
     }
     $base_path = $valuepair[1]; // well it might be a single top level item
     if ( false !== strpos( $valuepair[1], '_' ) ) { // It is a path with parents? ( has underscores )
       $base_path = ltrim( strrchr( $valuepair[1], '_' ), '_' ); // Grab the base path which is the number at the end of a path with parents ( e.g. 2_23_37_52 = 52 ) 
     }
     // Sanity check - if the $base_path is not numeric then we dump it
     if ( false === is_numeric( $base_path ) ) {
       trigger_error( __CLASS__ . ' Incorrect ' . self::DEPENDENCY . ' presented: ' . $valuepair[1], E_USER_WARNING );
       return false;
     }
     // Check if the registry fullpaths array exists, if not then create it
     if ( false === array_key_exists( 'fullpaths', usu::$registry->vars ) ) {
       usu::$registry->vars['fullpaths'] = array();
     }
     // If the $base_path is not in the registry let's add it
     if ( false === array_key_exists( $base_path, usu::$registry->vars['fullpaths'] ) ) {
       $valuepair[1] = $this->get_full_path( $valuepair[1] ); // Get the full path including any parents
       usu::$registry->vars['fullpaths'][$base_path] = $valuepair[1]; // Add to the registry - base_category => full path
     } else { // It is already in the registry so no need for queries
       $countpaths = 1; // Could be a single item with no parents so set it here
       // If multiple paths a query would be needed for each path
       if ( false !== strpos( usu::$registry->vars['fullpaths'][$base_path], '_' ) ) { // If it is a path with parents
         $countpaths = ( substr_count( usu::$registry->vars['fullpaths'][$base_path], '_' ) + 1 ); // Count the number of underscores and add one
       }
       usu::$performance['queries_saved'] += $countpaths;
       $valuepair[1] = usu::$registry->vars['fullpaths'][$base_path]; // Set $valuepair[1] from the registry ( e.g. the value of cPath so could be like 4_21_54)
     }
     // If this item is not already in the registry we use the acquire() method to query for the data
     if ( !isset( usu::$registry->vars[self::DEPENDENCY][$base_path] ) ) {
       if ( false === $this->acquire( $base_path, $fullpath = false ) ) {
         return false; // Looks like an invalid request so dump it
       }
     } else {
       usu::$performance['queries_saved']++; // Already in the registry so we saved one query
     }
     /**
     * About $reg_item
     * 
     * We grab the array of data from the registry and place it in $reg_item for convenience
     * The data stored in the registry was set in the method acquire as properties of this class
     * These are then set in the registry using the method getProperties()
     * the specific array keys like $reg_item['catname'] will be specific and differ in each module 
     */
     $reg_item = array();
     $reg_item = usu::$registry->vars[$valuepair[0]][$base_path];
     
     /**
     * Set the link text from reg_item
     * e.g. $link_text = $reg_item['parentname'] . '-' . $reg_item['catname'];
     */
     if ( defined( 'SEO_URLS_ADD_CAT_PARENT' ) && ( SEO_URLS_ADD_CAT_PARENT == 'true' ) && ( $reg_item['parentname'] != 'false' ) ){
       $link_text = $reg_item['parentname'] . '-' . $reg_item['catname'];
     } else {
       $link_text = $reg_item['catname'];
     }
     

     switch( true ){
       case $page == self::FILENAME:
         $url = $this->linkCreate( self::FILENAME, $link_text, self::MARKER, $valuepair[1] );
         break;
       default:
         // Add leftovers to the querystring _GET
         $added_qs[filter_var( $valuepair[0], FILTER_SANITIZE_STRING )] = usu::cleanse( $valuepair[1] );
         break;
     } # end switch
   }
}  
?>