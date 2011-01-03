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
 * @Id $Id:: Usu_Cache_FileSystem.php 107 2009-11-29 13:12:25Z Rob     $:  Full Details   
 */
 
  final class Usu_Cache_FileSystem implements Interface_Cache {
    
    private $cachepath, $md5check;
    
    public function __construct( $cachename, $cachepath ) {
      $this->cachpath = $cachepath . $cachename;
    }
    
    public function __destruct() {
    }
    
    public function store() {
    if ( SEO_URLS_ENABLED != 'false'  ) {
      $save = gzdeflate( serialize( usu::$registry ), 1 );
      $md5check = md5( $save ); 
      if ( $this->md5check !== $md5check ) {
        file_put_contents( $this->cachpath, $save, LOCK_EX );
      }
    } 
    }
    
    public function retrieve() {
      if ( is_readable( $this->cachpath ) && ( SEO_URLS_ENABLED != 'false' ) && !$this->gc() ) {
        usu::$cachefile_size = number_format( filesize( $this->cachpath ) / 1024, 2 ) . ' kb';
        usu::$performance['time'] = microtime( true );
        $this->md5check = md5( file_get_contents( $this->cachpath ) );
        usu::$registry = unserialize( gzinflate( file_get_contents( $this->cachpath ) ) );
        usu::$performance['time'] = round( ( microtime( true ) - usu::$performance['time'] ), 4 );
        return true;
      }
      usu::$registry = Usu_Registry::getInstance();
    }
    
    public function gc() {
      $cache_seconds = ( usu::$cachedays * 24 * 60 * 60 );
      if ( is_readable( $this->cachpath ) ) {
        $fileInfo = new SplFileInfo( $this->cachpath );
        if ( time() > ( $fileInfo->getMTime() + $cache_seconds ) ) {
          unlink( $this->cachpath );
          return true;
        } 
      }
      return false;
    }
  } 
?>