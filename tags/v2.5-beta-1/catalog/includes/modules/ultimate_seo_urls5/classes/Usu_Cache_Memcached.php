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
 * @Id $Id:: Usu_Cache_Memcached.php 107 2009-11-29 13:12:25Z Rob      $:  Full Details   
 */
 
  final class Usu_Cache_Memcached extends Memcache implements Interface_Cache {
    
    private $cachename;
    private $memcache_host = 'localhost';
    private $memcache_port = '11211';
    private $memcache_prefix = 'usu_';
    
    public function __construct( $cachename, $cachepath = false ) {
      $this->cachename = $this->memcache_prefix . $cachename;
      if ( false === $this->connect( $this->memcache_host, $this->memcache_port ) ) {
        trigger_error( 'Could not connect to memcache server', E_USER_WARNING );
        return false;
      }
    }
    
    public function __destruct(){
    }
    
    public function store() {
      if ( SEO_URLS_ENABLED != 'false'  ) {
        $data = serialize( usu::$registry );
        $rawdata = base64_encode( gzdeflate( $data ) );
        if ( false === $this->add( $this->cachename, $rawdata, 0, 3600 ) ) {
          $this->replace( $this->cachename, $rawdata, 0, 3600 );
        }
        return true;
      }
    }
    
    public function retrieve() {
      if ( SEO_URLS_ENABLED != 'false' ) {
        usu::$performance['time'] = microtime( true );
        if ( false === ( $rawdata = gzinflate( base64_decode( $this->get($this->cachename ) ) ) ) ) {
          return usu::$registry = Usu_Registry::getInstance();
        }
        usu::$cachefile_size = number_format( strlen( $this->get($this->cachename ) ) / 1024, 2 ) . ' kb';
        usu::$registry = unserialize( $rawdata );
        usu::$performance['time'] = round( ( microtime( true ) - usu::$performance['time'] ),4 );
      }
    }
    
    public function gc() {
      $this->delete( $this->cachename );
    }
    
    public function flushOut() {
      $this->flush();
    }
  } 
?>