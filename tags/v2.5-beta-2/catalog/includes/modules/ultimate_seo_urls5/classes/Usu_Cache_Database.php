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
 * @Id $Id:: Usu_Cache_Database.php 107 2009-11-29 13:12:25Z Rob       $:  Full Details   
 */
 
  final class Usu_Cache_Database implements Interface_Cache {
    
    private $cachename, $md5check;
    private $extract_query = "SELECT * FROM `usu_cache` WHERE cache_name = ':cache_name'";
    private $gc_query      = "DELETE FROM `usu_cache` WHERE cache_name = ':cache_name'";
    private $insert_query  = "INSERT INTO `usu_cache` (cache_name, cache_data, cache_date) VALUES (':cache_name', ':cache_data', ':cache_date')";
    private $update_query  = "UPDATE `usu_cache` SET cache_data = ':cache_data', cache_date = ':cache_date' WHERE cache_name = ':cache_name'";
    private $retrieved = false;
    
    public function __construct( $cachename, $cachepath = false ) {
      $this->cachename = $cachename;
    }
    
    public function __destruct() {
    }
    
    public function store() {
      if ( SEO_URLS_ENABLED != 'false'  ) {
        $data = serialize( usu::$registry );
        $rawdata = base64_encode( gzdeflate( $data ) );
        $md5check = md5( $rawdata );
        // If the cache is unchanged we do not insert nor update
        if ( $this->md5check !== $md5check ) {
          $targets = array( ':cache_name', ':cache_data', ':cache_date' );
          $values = array( tep_db_input( $this->cachename ), tep_db_input( $rawdata ), date( "Y-m-d H:i:s" ) ); 
          $query = str_replace( $targets, $values, $this->update_query );
          usu::query( $query );
          if ( ( mysql_affected_rows() == 0 ) && ( false === $this->retrieved ) ) {
            $query = str_replace( $targets, $values, $this->insert_query );
            usu::query( $query );
          }
        }
      }
    }
    
    public function retrieve() {
      if ( SEO_URLS_ENABLED != 'false' ) {
        $query = str_replace( ':cache_name', $this->cachename, $this->extract_query );
        $result = usu::query( $query );
        $row = tep_db_fetch_array( $result );
        tep_db_free_result( $result );
        if ( !empty( $row ) ) {
          $cache_seconds = ( usu::$cachedays * 24 * 60 * 60 );
          if ( time() > (strtotime( $row['cache_date']) + $cache_seconds ) ) {
            $this->gc();
          } else {
            usu::$cachefile_size = number_format( strlen( $row['cache_data'] ) / 1024, 2 ) . ' kb';
            usu::$performance['time'] = microtime( true );
            $this->md5check = md5( $row['cache_data'] );
            $rawdata = gzinflate( base64_decode( $row['cache_data'] ) );
            usu::$registry = unserialize( $rawdata );
            usu::$performance['time'] = round( ( microtime( true ) - usu::$performance['time']),4);
            $this->retrieved = true;
            return true;
          }
        }
      }
      usu::$registry = Usu_Registry::getInstance();
    }
    
    public function gc(){
      $query = str_replace( ':cache_name', $this->cachename, $this->gc_query );
      usu::query( $query );
      $this->retrieved = false;
    }
  } 
?>