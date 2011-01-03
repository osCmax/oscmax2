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
 * @lastmod $Date:: 2009-12-06 12:10:34 +0000 (Sun, 06 Dec 2009)       $:  Date of last commit
 * @version $Rev:: 131                                                 $:  Revision of last commit
 * @Id $Id:: aDataMap.php 131 2009-12-06 12:10:34Z Rob                 $:  Full Details   
 */

abstract class aDataMap { 
 
  abstract protected function acquire( $base_path, $full_path );

  abstract protected function getProperties();
  
  abstract public function buildLink($page, $valuepair, &$url, &$added_qs, $parameters);
  
  /**
  * Return a correctly formatted seo uri
  * 
  * @param string $page - base filename
  * @param string $text - link string for the seo uri
  * @param string $seperator - seo uri marker like -p- or -c-
  * @param mixed $value - effectively the _GET variable .. usually numeric .. cPath has underscores
  */
  protected function linkCreate( $page, $text, $seperator, $value ) {
    if ( SEO_URLS_TYPE == 'rewrite' ) {
      $url = $text . $seperator . $value . '.html';
    } else {
      $url = $page . '/' . $text . $seperator . $value;
    }
    return $url;
  }
  
  /**
  * Formatter for URI text
  * 
  * Takes a text string and formats it based on existing settings
  * @param string $string - The raw URI string to be converted
  * @return string - the final formated URI string
  */
  protected function linkText( $string ) {
    // Action character conversions
    if ( is_array( usu::$character_conversion ) ) {
      $string = strtr( $string, usu::$character_conversion );
    }
    // Remove special characters
    $pattern = ( defined( 'SEO_URLS_REMOVE_ALL_SPEC_CHARS' ) && SEO_URLS_REMOVE_ALL_SPEC_CHARS == 'true' ) ?  "@[^\sa-z0-9]@i" : "@[!#\$%&'\"()\*\+,\-\./:;<=>\?\@\[\]\^_`\{|\}~]+@";
    $link_text = preg_replace( $pattern, '', strtolower( $string ) );
    if ( PHP_VERSION <= '5.2.3' ) {
      $link_text = preg_replace( "@[\s]+@", '-', $link_text );
    } else {
      $link_text = preg_replace( "@[\s\v]+@", '-', $link_text );
    }
    // No short words so return the base text
    if ( false === strpos($link_text, '-') ) {
      return $link_text;
    }
    // Remove any words less than or equal in legnth the our filter
    if ( ( defined( 'SEO_URLS_FILTER_SHORT_WORDS' ) && is_numeric( SEO_URLS_FILTER_SHORT_WORDS ) ) ) {
      $to_array = @explode( '-', $link_text );
      $parts = array();
      foreach ( $to_array as $index => $value ) {
        if ( strlen( $value ) > SEO_URLS_FILTER_SHORT_WORDS ) {
          $parts[] = $value;
        }               
      } // end foreach
      return implode( '-', $parts );
    }
    return $link_text;
  } // End method
} // End class  
?>