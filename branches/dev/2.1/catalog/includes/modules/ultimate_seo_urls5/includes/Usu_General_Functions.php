<?php
/*
  $Id: Usu_General_Functions.php 107 2009-11-29 13:12:25Z Rob $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/
    
  function osc_href_link( $page = '', $parameters = '', $connection = 'NONSSL', $add_session_id = true, $search_engine_safe = true ) {

    if ( !tep_not_null( $page ) ) {
      die( '</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine the page link!<br><br>' );
    }

    if ( $connection == 'NONSSL' ) {
      $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
    } elseif ( $connection == 'SSL' ) {
      if ( ENABLE_SSL == true ) {
        $link = HTTPS_SERVER . DIR_WS_HTTPS_CATALOG;
      } else {
        $link = HTTP_SERVER . DIR_WS_HTTP_CATALOG;
      }
    } else {
      die( '</td></tr></table></td></tr></table><br><br><font color="#ff0000"><b>Error!</b></font><br><br><b>Unable to determine connection method on a link!<br><br>Known methods: NONSSL SSL</b><br><br>' );
    }

    if ( tep_not_null( $parameters ) ) {
      $link .= $page . '?' . tep_output_string( $parameters );
      $separator = '&';
    } else {
      $link .= $page;
      $separator = '?';
    }

    while ( ( substr( $link, -1 ) == '&' ) || ( substr( $link, -1 ) == '?' ) ) $link = substr( $link, 0, -1 );

// Add the session ID when moving from different HTTP and HTTPS servers, or when SID is defined
    if ( ( $add_session_id == true ) && ( usu::$session_started == true ) && ( SESSION_FORCE_COOKIE_USE == 'False' ) ) {
      if ( tep_not_null( usu::$sid ) ) {
        $_sid = usu::$sid;
      } elseif ( ( ( usu::$request_type == 'NONSSL' ) && ( $connection == 'SSL' ) && ( ENABLE_SSL == true ) ) || ( ( usu::$request_type == 'SSL' ) && ( $connection == 'NONSSL' ) ) ) {
        if ( HTTP_COOKIE_DOMAIN != HTTPS_COOKIE_DOMAIN ) {
          $_sid = tep_session_name() . '=' . tep_session_id();
        }
      }
    }

    if ( ( SEARCH_ENGINE_FRIENDLY_URLS == 'true' ) && ( $search_engine_safe == true ) ) {
      while ( strstr( $link, '&&' ) ) $link = str_replace( '&&', '&', $link );

      $link = str_replace( '?', '/', $link );
      $link = str_replace( '&', '/', $link );
      $link = str_replace( '=', '/', $link );

      $separator = '?';
    }

    if ( isset( $_sid ) ) {
      $link .= $separator . tep_output_string( $_sid );
    }
    usu::$performance['std_url_array'][] = $link;
    if ( defined( 'SEO_URLS_USE_W3C_VALID' ) && ( SEO_URLS_USE_W3C_VALID == 'true' ) ) {
      return htmlspecialchars( utf8_encode( $link ) );
    }
    return $link;
  } // End method
?>