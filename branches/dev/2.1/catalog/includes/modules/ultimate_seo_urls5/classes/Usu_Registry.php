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
 * @author Robert Fisher, FWR Media, http://www.fwrmedia.co.uk 
 * @lastdev $Author:: Rob                                              $:  Author of last commit
 * @lastmod $Date:: 2009-11-29 13:12:25 +0000 (Sun, 29 Nov 2009)       $:  Date of last commit
 * @version $Rev:: 107                                                 $:  Revision of last commit
 * @Id $Id:: Usu_Registry.php 107 2009-11-29 13:12:25Z Rob             $:  Full Details   
 */

 class Usu_Registry {
   
   public $vars = array(); 
   private static $_singleton;
    
   private function __construct(){
   }
    
   public static function getInstance() {
     if ( is_null( self::$_singleton ) ) {
       return self::$_singleton = new self;
     } else {
       return self::$_singleton;
     }
   } # end method

   /**
   * Prepare the vars array to be serialized
   */
   public function __sleep() {
     return array( 'vars' );
   }
   
   public function __wakeup(){
   }

   public function __set( $index, $value ) {
     if ( false === array_key_exists( $index, $this->vars ) ) {
       $this->vars[$index] = $value;
     }
   }

   public function __get( $index ) {
     if ( array_key_exists( $index, $this->vars ) ) {
       return $this->vars[$index];
     }
     return false;
   }
   
   public function attach( $type, $index, $object ) {
     if ( array_key_exists( $type, $this->vars ) ) {
       $this->vars[$type][$index] = $object;
       return;
     }
     return false;
   }
   
   public function addPageDependency( $array ) {
     foreach ( $array as $page => $dependency ) {
       if ( false === isset( $this->page_dependencies[$page] ) ) {
         $this->vars['page_dependencies'][$page] = array();
       }
       $this->vars['page_dependencies'][$page][$dependency] = 1;
     }
   }
   
   public function merge( $type, $array ) {
     if ( false === array_key_exists( $type, $this->vars ) ) {
       $this->vars[$type] = $array;
       return;
     }
     $this->vars[$type] = $this->vars[$type] + $array;
   }  
  } // End class application_Registry
?>