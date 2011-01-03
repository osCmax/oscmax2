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
 * @lastmod $Date:: 2009-11-29 13:12:25 +0000 (Sun, 29 Nov 2009)       $:  Date of last commit
 * @version $Rev:: 107                                                 $:  Revision of last commit
 * @Id $Id:: Usu_Newsdesk_Index.php 107 2009-11-29 13:12:25Z Rob       $:  Full Details   
 */

class Usu_Newsdesk_Index extends aDataMap {

  const MARKER = '-nc-';  // Could for example be -c- or -l- etc.
  const DEPENDENCY = 'newspath'; // _GET key like e.g. cPath or lPath etc.
  const FILENAME = 'newsdesk_index.php'; // The filename define of the file where this code will be actioned
  public $dependency = self::DEPENDENCY;
  public $dependency_tags = array( self::MARKER => self::FILENAME ); // key value pair of tag (like e.g. -c-) => filename ( e.g. FILENAME_DEFAULT )
  private $page_relations = array( self::FILENAME => 1 ); // Page relation for this module ( e.g. FILENAME_DEFAULT or FILENAME_LINKS )
  private $markers = array( self::MARKER => self::DEPENDENCY ); // Markers as key value pair like -c- => cPath or perhaps -l- => lPath
  private $base_query; // Template query with placeholders ( :placeholder ) waiting for real values
  private $query; // The final query which will be $base_query but with the placeholders replaced with real values
  private $categories_name; // property populated in the acquire() method, there may be multiples of these, rename in line with the query results
  private $dependency_value; // Dependency value, so if the dependency was cPath and cPath = 27 then this value would be 27
  private $installed = false; // Unless it is a core module $installed should only be true if the contribution is installed ( e.g. articles or links manager etc )
  private $suppress_underscores = true; // Set to true Produce only base paths like -t-32 not parent paths like 3_5_23
  
  public function __construct(){
    if ( defined('FILENAME_NEWSDESK_INDEX') && defined('TABLE_NEWSDESK_CATEGORIES_DESCRIPTION') ){
      // The items with a colon : are placeholders which must match the $placeholders array in method acquire()
      $this->base_query = "SELECT categories_name FROM " . TABLE_NEWSDESK_CATEGORIES_DESCRIPTION . " WHERE categories_id=':newspath' AND language_id=':languages_id' LIMIT 1";
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
  }
  
  protected function acquire( $base_path, $full_path ) {
    $this->dependency_value = $full_path; // Full path perhaps with underscores
    /**
    * About placeholders
    *  
    * The placeholders (items with a colon :) must match those in the query ( $this->base_query in the constructor )
    */
    $placeholders = array( ':newspath', ':languages_id' );
    // Do the below values need to be typecast?
    $values = array( (int)$base_path, (int)usu::$languages_id ); // xxx These values will replace the placeholders above in $this->base_query
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
    $this->categories_name = $this->linkText( $row['categories_name'] );
    
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
   
   private function get_full_path( $path ) {
     // Only used for modules that require paths with parents like .. 2_6_35
     // See Usu_Categories.php for usage
     return $path;
   } // End method
   
   private function get_parents() {
     // Only used for modules that require paths with parents like .. 2_6_35
     // See Usu_Categories.php for usage
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
                                                || ( false === $this->installed )
                                                || !tep_not_null( $valuepair[1] ) ) {
       return false; // Either this module is not installed or the value pair does not meet our requirements so abort
     }
     $base_path = $valuepair[1]; // well it might be a single top level item
     if ( false === $this->suppress_underscores ) {
       if ( false !== strpos( $valuepair[1], '_' ) ) { // It is a path with parents? ( has underscores )
         $base_path = ltrim( strrchr( $valuepair[1], '_' ), '_' ); // Grab the base path which is the number at the end of a path with parents ( e.g. 2_23_37_52 = 52 ) 
       }
     }
     // Sanity check - if the $base_path is not numeric then we dump it
     if ( false === is_numeric( str_replace( '_', '', $base_path ) ) ) {
       trigger_error( __CLASS__ . ' Incorrect ' . self::DEPENDENCY . ' presented: ' . $valuepair[1], E_USER_WARNING );
       return false;
     }
     // Get a full path with underscores from the database
     $full_path = $this->get_full_path( $base_path );
     // If this item is not already in the registry we use the acquire() method to query for the data
     if ( !isset( usu::$registry->vars[self::DEPENDENCY][$full_path] ) ) {
       if ( false === $this->acquire( $base_path, $full_path ) ) {
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
     $reg_item = usu::$registry->vars[$valuepair[0]][$full_path];
     
     /**
     * Set the link text from reg_item
     * e.g. $link_text = $reg_item['parentname'] . '-' . $reg_item['catname'];
     */
     $link_text = $reg_item['categories_name']; // the property added in the acquire function this would have been set in the acquire method like $this->xxxname
     

     switch( true ){
       case $page == self::FILENAME:
         $url = $this->linkCreate( self::FILENAME, $link_text, self::MARKER, $full_path );
         break;
       default:
         // Add leftovers to the querystring _GET
         $added_qs[filter_var( $valuepair[0], FILTER_SANITIZE_STRING )] = usu::cleanse( $valuepair[1] );
         break;
     } # end switch
   }
}  
?>