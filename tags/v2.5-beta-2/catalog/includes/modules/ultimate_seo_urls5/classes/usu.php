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
 * @lastmod $Date:: 2009-12-10 11:07:43 +0000 (Thu, 10 Dec 2009)       $:  Date of last commit
 * @version $Rev:: 133                                                 $:  Revision of last commit
 * @Id $Id:: usu.php 133 2009-12-10 11:07:43Z Rob                      $:  Full Details   
 */

/**
* Main ULTIMATE Seo Urls class
*/
class usu {
  
  private $modules_path, $interface_path, $abstracts_path, $base_url, $base_url_ssl, $querystring, $cache_name,
          $urlType, $words_filter, $md5check, $cache;
          
  private $constants = array( 'SEO_URLS_ENABLED', 'SEO_URLS_TYPE', 'SEO_URLS_CACHE_DAYS', 'SEO_URLS_FILTER_SHORT_WORDS',
                              'SEO_URLS_CHAR_CONVERT_SET', 'SEO_URLS_REMOVE_ALL_SPEC_CHARS', 'SEO_URLS_USE_W3C_VALID', 'SEO_URLS_OUPUT_PERFORMANCE',
                              'SEO_URLS_ADD_CPATH_TO_PRODUCT_URLS', 'SEO_URLS_ADD_CAT_PARENT', 'SEO_URLS_CACHE_SYSTEM' );
  
  public $enabled;
  
  public static $languages_id, $session_started, $sid, $request_type, $performance, $usuPath, $cachefile_size, $cachedays;

  public static $registry = array();
  public static $modules = array();
  public static $queries = array();
  public static $character_conversion = false;

  private static $language; 
  
  public function __construct( $languages_id, $request_type, $session_started, $sid ) {

    $this->definesAvailable();
    self::$languages_id = (int)$languages_id;
    self::$session_started = (bool)$session_started;
    self::$sid = tep_not_null( $sid ) ? filter_var( $sid, FILTER_SANITIZE_STRING ) : false;
    self::$request_type = filter_var( $request_type, FILTER_SANITIZE_STRING );
    $this->enabled = SEO_URLS_ENABLED;
    $this->urlType = SEO_URLS_TYPE;
    self::$cachedays = SEO_URLS_CACHE_DAYS;
    $this->words_filter = SEO_URLS_FILTER_SHORT_WORDS;
    self::$usuPath = DIR_WS_MODULES . 'ultimate_seo_urls5' . DIRECTORY_SEPARATOR;
    $this->abstracts_path = self::$usuPath . 'abstracts' . DIRECTORY_SEPARATOR;
    $this->interfaces_path = self::$usuPath . 'interfaces' . DIRECTORY_SEPARATOR;
    $this->modules_path = self::$usuPath . 'modules' . DIRECTORY_SEPARATOR;
    $this->cache_path = $this->getRealPath() . self::$usuPath . 'cache' . DIRECTORY_SEPARATOR;
    $this->cache_name = self::$languages_id . '_usucache.cache';
    $this->base_url = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
    $this->base_url_ssl = HTTPS_SERVER . DIR_WS_HTTPS_CATALOG;
    $this->urlType = SEO_URLS_TYPE;
    $this->enabled = SEO_URLS_ENABLED;
    require_once 'Usu_Registry.php';
    self::$performance = array( 'seo_urls'       => 0,
                                'seo_url_array'  => array(),
                                'std_urls'       => 0,
                                'std_url_array'  => array(),
                                'queries_saved'  => 0,
                                'querycount'     => 0,
                                'time'           => 'false' );
    $this->loadRegistry();
    include_once self::$usuPath . 'includes' . DIRECTORY_SEPARATOR . 'Usu_General_Functions.php';
    self::$registry->seo_pages = array();
  } // End constructor
  
  /**
  * A number of osC users don't have a full path in DIR_FS_CATALOG which was causing the caching to fail
  * so sadly we have to do this to find the full path.
  */
  private function getRealPath() {
    $realpath = '';
    if( function_exists( 'realpath' ) ) {
      $realpath = str_replace( '\\', '/', realpath( '.' ) ) . '/';
      if( file_exists( $realpath . 'product_info.php' ) && !empty( $realpath ) ) {
        return $realpath;
      }
    }
    if( function_exists( 'getcwd' ) ) {
      $realpath = str_replace( '\\', '/', getcwd() ) . '/';
      if( file_exists( $realpath . 'product_info.php' ) && !empty( $realpath ) ) {
        return $realpath;
      }
    }
    if ( file_exists( DIR_FS_CATALOG . 'product_info.php' ) ) {
      return DIR_FS_CATALOG;
    }
    trigger_error( 'Usu5 cannot find the full filepath, please ensure that DIR_FS_CATALOG in configure.php contains a FULL path' );
  }

  /**
  * destructor
  * 
  * Saves the serialized registry as a cache file
  */
  public function __destruct() {
    self::performance();
    $this->cache->store();
  } // End destructor
  
  private function cacheSystem( $type = SEO_URLS_CACHE_SYSTEM ) {
    $class =  'Usu_Cache_' . $type;
    include_once $this->interfaces_path . 'Interface_Cache.php';
    if ( is_readable( self::$usuPath . 'classes' . DIRECTORY_SEPARATOR . $class . '.php' ) ) {
      include_once self::$usuPath . 'classes' . DIRECTORY_SEPARATOR . $class . '.php'; 
      if ( $this->cache = new $class( $this->cache_name, $this->cache_path ) ) {
        return;
      }
    }
    include_once self::$usuPath . 'classes' . DIRECTORY_SEPARATOR . 'Usu_Cache_FileSystem.php'; 
    $this->cache = new Usu_Cache_FileSystem( $this->cache_name, $this->cache_path );
  }
  
  /**
  * Checks for the core defines
  * 
  * if all the core defines are not available we fall back on Usu_Init.php
  */
  private function definesAvailable() {
    foreach ( $this->constants as $index => $define ) {
      if ( false === defined( $define ) ){
        include_once DIR_WS_MODULES . 'ultimate_seo_urls5' . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR . 'Usu_Init.php';
        return false;
      }
    }
    return true;
  } // End method
  
  /**
  * Initiate the class
  * 
  * @param mixed $sid - osCsid
  * @param int $languages_id - id of the chosen language
  */
  public function initiate( $sid, $languages_id, $language ) {
    self::$languages_id = (int)$languages_id;
    self::$sid = tep_not_null( $sid ) ? filter_var( $sid, FILTER_SANITIZE_STRING ) : false;
    self::$language = filter_var( $language, FILTER_SANITIZE_STRING );
    self::$character_conversion = self::characterConversionSet();
    if ( SEO_URLS_ENABLED != 'false'  ) {
      // ensure that the broken search engine safe urls are set to off
      $this->turnOffBrokenUrls();                             
      $this->getUsuModules();
      $this->validate();
    }
  } // End method
  
  /**
  * Include the validator
  * 
  * @see Usu_Validator
  * The validator examines the request - determines the type of request and matches against criteria.
  * If the request does not match a valid Seo Url the user is 301 redirected.
  * If the validator cannot produce an seo url a 404 header page is displayed.
  */
  private function validate() {
    include_once self::$usuPath . 'classes' . DIRECTORY_SEPARATOR . 'Usu_Validator.php';
    new Usu_Validator;
  }
  
  /**
  * Loads the registry
  * 
  * Loads the registry data from cache or gets an instance of the class
  */
  private function loadRegistry() {
    $this->cacheSystem();
    $this->cache->retrieve();  
  } // End method
  
  /**
  * Load modules for Seo Urls
  * 
  * Modules allow Seo Urls to deal with the different requests and added contributions
  * @example categories, products, manufacturers - contributions may be articles or information pages
  */
  private function getUsuModules() {
    include_once $this->abstracts_path . 'aDataMap.php';
    $modules = $this->dirIterator( $this->modules_path );
    foreach ( $modules as $index => $module ) {
      $class = str_replace( '.php', '', $module );
      include_once $this->modules_path . $module;
      $class = new $class();
      self::$modules[$class->dependency] = $class;
    }
  } // End method
  
  /**
  * Directory iterator
  * 
  * @param string $fullpath - full path to the director we wish to iterate
  * @return array - numerical index of returned pages
  */
  private function dirIterator( $fullpath ) {
    $it = new DirectoryIterator( $fullpath );
    while( $it->valid() ) {
     if ( !$it->isDot() && $it->isFile() && $it->isReadable() && ( substr( $it->getFilename(), -4, 4 ) == '.php' ) ) {
       $files[] = $it->getFilename();
     }
     $it->next();
    }
    return $files;
  } // End method
  
  /**
  * Query wrapper
  * 
  * Purely exists to allow monitoring of the number and content of queries
  * @param string $sql - The query
  * @return resource - query result
  */
  public static function query( $sql ) {
    self::$performance['querycount']++;
    self::$queries[] = $sql;
    return tep_db_query( $sql );
  }  // End method
  
  /**
  * Converter for the special character conversion string
  * 
  * Converts the comma seperated string e.g. a=>b,z=>y to an array of key=>value pairs
  * or if a language character conversion file exists - use it overriding the db settings
  */
  private static function characterConversionSet(){
    // Check to see if there is a character conversion language file before trying the admin settings
    $character_conv_filepath = self::$usuPath . 'includes' .  DIRECTORY_SEPARATOR  . 'character_conversion' . DIRECTORY_SEPARATOR . self::$language . '.php';
    if ( is_readable( $character_conv_filepath ) ) {
      include_once $character_conv_filepath;
      if ( isset( $char_convert ) && is_array( $char_convert ) && !empty( $char_convert ) ) {
        return $char_convert;
      }
    }
    if ( defined( 'SEO_URLS_CHAR_CONVERT_SET' ) && tep_not_null( SEO_URLS_CHAR_CONVERT_SET ) ) {
      self::$character_conversion = array();
      $comma_separation = explode( ',', SEO_URLS_CHAR_CONVERT_SET );
      foreach ( $comma_separation as $index => $value_pairs ) {
        $pairs = @explode( '=>', $value_pairs );
        self::$character_conversion[trim($pairs[0])] = trim($pairs[1]);
      }
      return self::$character_conversion; 
    }
    return self::$character_conversion = false;
  } // End method
  
  /**
  * Replacement for the stock osCommerce tep_href_link() function
  * 
  * @param string $page - filename of the current requested page
  * @param string $parameters - _GET string
  * @param string $connection - request type NONSSL / SSL
  * @param bool $add_session_id - whether or not to append the session_id
  * @return string - the final formatted link
  */
  public function href_link( $page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true ) { 
    // Some sites have hardcoded &amp;
    $parameters = str_replace( '&amp;', '&', $parameters );
    // Some contributions incorrectly use $_SERVER['PHP_SELF'] or basename( $PHP_SELF ) which can have nasty consequences with standard seo urls
    if ( false === strpos( $page, 'ext/modules/payment/' ) ) {
      if( ( false !== strpos( $page, '/' ) ) || ( substr( $page, -4, 4 ) != '.php' ) ) {
        preg_match( '@\b[a-z_]+\.php\b@i', $page, $matches ); // Is our filename in there somewhere??
        if ( array_key_exists( '0', $matches ) && ( substr( $matches[0], -4, 4 ) == '.php' ) ) {
          $page = $matches[0]; 
        } else {
          $tags_to_files = $this->getTagsToFiles();
          foreach ( $tags_to_files as $marker => $filename ) {
            if ( false !== strpos( $page, $marker ) ) {  // is there a seo url marker in the page name?
              $page = $filename; // Grab the correct page name from the registry
            }
          }
        }
      }
    }
    // End some contributions incorrectly use $_SERVER['PHP_SELF'] or basename( $PHP_SELF )

    if ( ( false === array_key_exists( $page, self::$registry->seo_pages ) ) || SEO_URLS_ENABLED == 'false' ) {
      self::$performance['std_urls']++;
      return osc_href_link( $page, $parameters, $connection, $add_session_id );
    }
    self::$performance['seo_urls']++;
    $link = $connection == 'NONSSL' ? $this->base_url : $this->base_url_ssl;
    $separator = '?';
    if ( tep_not_null( $parameters ) ) {
      if ( false === ( $linkseo = $this->buildLink( $page, tep_output_string( $parameters ) ) ) ) {
        return osc_href_link( $page, $parameters, $connection, $add_session_id );
      } 
      $link .= $linkseo;        
    } else {
      $link .= $page;
    }
    if ( count( $this->querystring ) > 0 ) {
      $link .= $separator . http_build_query( $this->querystring );
      // Unset the querystring so we do not pass it to the next link
      $this->querystring = null;
      $separator = '&';
    }
    $this->add_sid( $link, $add_session_id, $connection, $separator ); 
    
    switch( SEO_URLS_USE_W3C_VALID ) {
      case 'true':
        self::$performance['seo_url_array'][] = $link;
        return htmlspecialchars( utf8_encode( $link ) );
        break;
      default:
        self::$performance['seo_url_array'][] = $link;
        return $link;
        break;
    }
  } # end method
  
  private function getTagsToFiles() {
    $tags_to_files = array();
    foreach( self::$modules as $object ) {
      foreach( $object->dependency_tags as $tag => $filename ) {
        $tags_to_files[$tag] = $filename;
      } 
    }
    return $tags_to_files;
  } // End method
  
  /**
  * Add the session id to the querystring
  * 
  * @param string $link - current link prior to session id
  * @param bool $add_session_id
  * @param string $connection - request type NONSSL / SSL
  * @param string $separator - query separator ? / &
  */
  function add_sid( &$link, $add_session_id, $connection, $separator ) {
    // Add the session ID when moving from different HTTP and HTTPS servers, or when SID is defined
    if ( ( $add_session_id == true ) && ( self::$session_started == true ) && ( SESSION_FORCE_COOKIE_USE == 'False' ) ) {
      if ( tep_not_null( self::$sid ) ) {
        $_sid = self::$sid;
      } elseif ( ( ( self::$request_type == 'NONSSL' ) && ( $connection == 'SSL' ) && ( ENABLE_SSL == true ) ) || ( ( self::$request_type == 'SSL' ) && ( $connection == 'NONSSL' ) ) ) {
        if ( HTTP_COOKIE_DOMAIN != HTTPS_COOKIE_DOMAIN ) {
          $_sid = tep_session_name() . '=' . tep_session_id();
        }
      }
    }
    if ( isset( $_sid ) ) {
      $link .= $separator . tep_output_string( $_sid );
    }
 } # end function
  
  /**
  * Link builder
  * 
  * Checks for link modules based on _GET key and calls their buildLink()
  * if this object does not exists the key=>value pair is added to the querystring
  * @param string $page - requested page
  * @param string $parameters - querystring
  */
  private function buildLink( $page, $parameters ) {
   $pair_array = @explode( '&', $parameters );
   krsort( $pair_array );
   $added_qs = array();
   $url = false;

   foreach ( $pair_array as $index => $pair_string ) {
     $valuepair = @explode( '=', $pair_string );
     if ( array_key_exists( 1, $valuepair ) && ( false !== strpos( urldecode( $valuepair[1] ), '{' ) ) ) {
       // Returning false forces the use of the standard osC href_link 
       return false;
     }
     // Have we got an seo url module to deal with this _GET key
     if ( isset( self::$modules[$valuepair[0]] ) && is_object( self::$modules[$valuepair[0]] ) ) {
       self::$modules[$valuepair[0]]->buildLink( $page, $valuepair, $url, $added_qs, $parameters );
       // Remove cPath from the product uri if SEO_URLS_ADD_CPATH_TO_PRODUCT_URLS is not set to true
       if ( defined( 'SEO_URLS_ADD_CPATH_TO_PRODUCT_URLS' ) && ( SEO_URLS_ADD_CPATH_TO_PRODUCT_URLS != 'true' ) && ( $page === FILENAME_PRODUCT_INFO ) ) {
         if ( array_key_exists( 'cPath', $added_qs ) ) {
           unset( $added_qs['cPath'] );
         } 
       }
     } else {
       // No module so we'll add it to the querystring
       if ( false !== array_key_exists( 1, $valuepair ) ) {
         $added_qs[$valuepair[0]] = $valuepair[1];
       }
     }
   }
   $this->querystring = $added_qs;
   if ( false !== $url ) {
     return $url;
   }
   // Returning false forces the use of the standard osC href_link
   return false;
  } // End method
  
  /**
  * Performance reporting
  * 
  * reports on links built queries used, time to load cache, cache size
  */
  private static function performance() {

    if ( SEO_URLS_OUPUT_PERFORMANCE !== 'true' ) {
      return false;
    }
    $performance_time = ( 'false' !== self::$performance['time'] ) ? self::$performance['time'] . ' seconds' : '<span style="color: red;">cache not loaded</span>';
?>
  <div style="padding: 3em; font-family: verdana; width: 750px;">
    <div style="width: 100%; background-color: #ffffdd; border: 1px solid #1659AC; font-size: 10pt;">
      <div style="background-color: #2E8FCA; font-size: 12pt; font-weight: bold; padding: 0.5em; color: #00598E;">
        <div style="float: right; color: #0073BA; font-weight: bold; font-size: 16pt; margin-top: -0.2em;">FWR MEDIA</div>
        ULTIMATE Seo Urls 5 - Performance
      </div>
      <div style="padding: 0.5em; background-color: #CCE3F1; color: #027AC6; font-size: 10pt;">Standard URI produced: <?php echo self::$performance['std_urls']; ?></div>
      <div style="padding: 0.5em; color: #027AC6; font-size: 10pt;">SEO URI produced: <?php echo self::$performance['seo_urls']; ?></div>
      <div style="padding: 0.5em; background-color: #CCE3F1; color: #027AC6; font-size: 10pt;">Query Count: <?php echo self::$performance['querycount']; ?></div>
      <div style="padding: 0.5em; color: #027AC6; font-size: 10pt;">Queries Saved: <?php echo self::$performance['queries_saved']; ?></div>
      <div style="padding: 0.5em; background-color: #CCE3F1; color: #027AC6; font-size: 10pt;">Cache load time: <?php echo $performance_time; ?></div>
      <div style="padding: 0.5em; color: #027AC6; font-size: 10pt;">Cache File Size: <?php echo self::$cachefile_size; ?></div>
      <div style="padding: 0.5em; background-color: #CCE3F1; color: #027AC6; font-size: 10pt;"><div style="padding: 0.5em;"><span style="font-weight: bold; text-decoration: underline;">Standard Urls:</span></div>
        <div>
<?php
    foreach ( self::$performance['std_url_array'] as $index => $url ) {
      echo '          ' . $url . '<br />' . PHP_EOL;
    } 
?>
        </div>
      </div>
      <div style="padding: 0.5em; color: #027AC6; font-size: 10pt;"><div style="padding: 0.5em;"><span style="font-weight: bold; text-decoration: underline;">Seo Urls:</span></div>
        <div>
<?php
    foreach ( self::$performance['seo_url_array'] as $index => $url ) {
      echo '          ' . $url . '<br />' . PHP_EOL;
    } 
?>
        </div>
      </div>
      <div style="background-color: #fff; padding: 0.5em; color: #737373; font-size: 10pt;"><div style="padding: 0.5em;"><span style="font-weight: bold; text-decoration: underline;">Queries:</span></div>
<?php
    foreach ( self::$queries as $index => $query ) {
      echo '        <div style="padding: 0.2em; font-family: tahoma; font-size: 7pt;">' . $query . '</div>' . PHP_EOL;
    }
?>
      </div>
    </div>
  </div>
<?php
  //self::pa( self::$registry );
  }
  
  /**
  * Automatically turn off osC Search-Engine Safe URLs (still in development)
  */
  private function turnOffBrokenUrls() {
    if ( defined( 'SEARCH_ENGINE_FRIENDLY_URLS' ) && ( SEARCH_ENGINE_FRIENDLY_URLS == 'true' ) ) {
      $sql = "UPDATE " . TABLE_CONFIGURATION . " SET configuration_value = 'false' WHERE configuration_key = 'SEARCH_ENGINE_FRIENDLY_URLS'";
      tep_db_query( $sql );
    }
  }
  
  public static function cleanse( $get_var ) {
    // heavy whitelist of _GET values
    return preg_replace( "/[^{}a-z0-9_]/i", "", urldecode( $get_var ) );
  }

  /**
  * Generic print array debugging tool
  * 
  * @param array $array - array to print
  * @param bool $exit - whether to kill the script on printing
  */
  public static function pa( $array, $exit = false ) {
    echo '<pre>' . print_r( $array, true ) . '</pre>';
    if ( false !== $exit ) {
      exit;
    }
  } // End method

} // End class   
?>