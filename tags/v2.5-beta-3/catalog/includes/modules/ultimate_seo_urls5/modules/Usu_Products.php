<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
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
 * @lastdev $Author::                                                  $:  Author of last commit
 * @lastmod $Date::                                                    $:  Date of last commit
 * @version $Rev::                                                     $:  Revision of last commit
 */

class Usu_Products extends aDataMap {

  public $dependency = 'products_id';
  public $dependency_tags = array('-p-' => FILENAME_PRODUCT_INFO, '-pr-' => FILENAME_PRODUCT_REVIEWS, '-pri-' => FILENAME_PRODUCT_REVIEWS_INFO);
  private $page_relations = array(FILENAME_PRODUCT_INFO => 1, FILENAME_PRODUCT_REVIEWS => 1, FILENAME_PRODUCT_REVIEWS_INFO => 1);
  private $markers = array('-p-' => 'products_id', '-pr-' => 'products_id', '-pri-' => 'products_id');
  private $query;
  private $base_query;
  private $link_text;
  private $products_id;
  
  public function __construct() {
    $this->base_query = "SELECT products_name FROM " . TABLE_PRODUCTS_DESCRIPTION . " WHERE products_id=':pid' AND language_id=':languages_id' LIMIT 1";
    usu::$registry->merge( 'seo_pages', $this->page_relations );
    usu::$registry->merge( 'markers', $this->markers );
    usu::$registry->addPageDependency( array( FILENAME_PRODUCT_INFO => 'products_id', FILENAME_PRODUCT_REVIEWS => 'products_id', FILENAME_PRODUCT_REVIEWS_INFO => 'products_id' ) );   
  }
  
  protected function acquire( $dependency, $fullpath ) {   
    $this->products_id = (int)$dependency;
    // Bypass the query if already in the registry
    if ( false !== isset( usu::$registry->{$this->dependency}[$this->products_id] ) ) {
      usu::$performance['queries_saved']++;
      return true;
    }
    $placeholders = array( ':pid', ':languages_id' );
    // $values are already type cast
    $values = array( $this->products_id, usu::$languages_id );
    $this->query = str_replace( $placeholders, $values, $this->base_query );
    $result = usu::query( $this->query );
    $this->query = null;
    $row = tep_db_fetch_array( $result );
    tep_db_free_result( $result );
    if ( false === $row ) {
      return false;
    }
    $this->link_text = $this->linkText( $row['products_name'] );

    if ( false === isset( usu::$registry->{$this->dependency} ) ) {
      usu::$registry->{$this->dependency} = array();
    }
    usu::$registry->attach( $this->dependency, $this->products_id, $this->getProperties() );
  } // End method
   
   protected function getProperties() {
     $properties = get_object_vars( $this );
     unset( $properties['page_relations'] );
     return $properties;  
   } // End method
   
   public function buildLink( $page, $valuepair, &$url, &$added_qs, $parameters ) {
     if ( (false === array_key_exists(1, $valuepair)) || ( $valuepair[0] != $this->dependency ) 
                                                      || ( false !== strpos( urldecode( $valuepair[1] ), '{' ) )
                                                      || !tep_not_null( $valuepair[1] ) ) {
       return false;
     }
     if ( !isset( usu::$registry->vars[$valuepair[0]][$valuepair[1]] ) ) {
       if ( false === $this->acquire( $valuepair[1], $fullpath = false ) ) {
         return false;
       }
     } else {
       usu::$performance['queries_saved']++;
     }
     $reg_item = usu::$registry->vars[$valuepair[0]][$valuepair[1]];
     switch( true ){
       case ( $page == FILENAME_PRODUCT_INFO && ( false === strpos( $valuepair[1], '{' ) ) ):
         $url = $this->linkCreate( FILENAME_PRODUCT_INFO, $reg_item['link_text'], '-p-', $valuepair[1] ); 
         break;
       case ( $page == FILENAME_PRODUCT_REVIEWS ):
         $url = $this->linkCreate( FILENAME_PRODUCT_REVIEWS, $reg_item['link_text'], '-pr-', $valuepair[1] );
         break;
       case ( $page == FILENAME_PRODUCT_REVIEWS_INFO ):
         $url = $this->linkCreate( FILENAME_PRODUCT_REVIEWS_INFO, $reg_item['link_text'], '-pri-', $valuepair[1] );
         break;
       default:
         $added_qs[filter_var( $valuepair[0], FILTER_SANITIZE_STRING)] = usu::cleanse($valuepair[1] );
         break;
     } # end switch
   }
}  
?>