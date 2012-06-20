<?php 
/**
*
* KissER Error Handling & Debugging
* KISS = (Keep It Simple Stupid!) 
* 
* @package KissER Error Handling & Debugging v1.0
* @license http://www.opensource.org/licenses/gpl-2.0.php GNU Public License
* @link http://www.fwrmedia.co.uk
* @copyright Copyright 2008-2009 FWR Media
* @author Robert Fisher, FWR Media, http://www.fwrmedia.co.uk 
* @lastdev $Author:: Rob                                               $:  Author of last commit
* @lastmod $Date:: 2010-01-28 14:40:31 +0000 (Thu, 28 Jan 2010)        $:  Date of last commit
* @version $Rev:: 20                                                   $:  Revision of last commit
* @Id $Id:: kiss_error_handler.php 20 2010-01-28 14:40:31Z Rob         $:  Full Details   
*/

  /**
  * User Main Settings
  */
  define( 'KISS_ERROR_REPORTING_OUTPUT', 'screen' );          // string - screen ( prints to screen ) / suppress ( suppresses errors ) / file ( saves errors to file ).
  define( 'KISS_ERROR_REPORTING_SWITCH', 'on' );              // string - on / off ( off will default back to standard PHP error reporting.
  /**
  * KISS_ERROR_REPORTING_GET_SWITCH is to protect a live site from showing errors to screen but still can be seen on screen by the developer
  * KISS_ERROR_REPORTING_GET_SWITCH only applies when KISS_ERROR_REPORTING_OUTPUT is set to screen
  * If KISS_ERROR_REPORTING_GET_SWITCH is set as 'false' errors and all other output will always be printed to screen.
  * If KISS_ERROR_REPORTING_GET_SWITCH is set anything other than  'false', ( e.g. fwroutput ) output to screen will only occur if the value is in the querystring as a key
  * e.g. www.mysite.com/index.php?fwroutput 
  */
  define( 'KISS_ERROR_REPORTING_GET_SWITCH', 'debug' );   // string - false - user setting - see above comments
  
  /**
  * Extra Settings
  */
  define( 'KISS_ERROR_REPORTING_SUPPRESS_DUPLICATES', 'on' ); // string - on / off ( "on" will stop the repeated output of errors already printed )
  /**
  * Query Debugging
  */
  define( 'KISS_ERROR_REPORTING_QUERIES', 'off' );            // string - on / off ( will output all queries and query times )
  /**
  * Using Break Points
  */
  define( 'KISS_ERROR_REPORTING_BREAKPOINTS', 'off' );        // string - on / off ( will output all breakpoint times and current errors )
  // End user settings
  
  /**
  * Set our own error handling system instead of PHP
  */
  set_error_handler( 'kiss_error_handler' );

  /**
  * kiss_error_handler() takes over the handling of standard PHP errors.
  * 
  * @param int $errno      - error number
  * @param string $errstr  - the error as a descriptive string
  * @param string $errfile - file where the error originated
  * @param mixed $errline  - the line in the file where the error originated
  */
  function kiss_error_handler( $errno, $errstr, $errfile, $errline ) {
    if ( !defined( 'KISS_ERROR_REPORTING_SWITCH' ) || ( strtolower( KISS_ERROR_REPORTING_SWITCH ) != 'on' ) ) {
      // Will default back to standard PHP error reporting.
      return false;
    }
    KissER::i( $errno, $errstr, $errfile, $errline );
  } // end function
  
  /**
  * Error handling class
  */
  final class KissER {
    
    private static $_singleton;
    private $errorfile_path;
    private $error_file = 'kiss_errors.txt';
    private static $registry = array( 'errors' => array() );
    private static $breakpoints = array();
    private static $queries = array();
    private static $reporting = 'file';
    private static $rootpath;
    private static $error_types = array( E_USER_ERROR  => 'E_USER_ERROR',  E_USER_WARNING => 'E_USER_WARNING',
                                         E_USER_NOTICE => 'E_USER_NOTICE', E_WARNING      => 'E_WARNING',
                                         E_NOTICE      => 'E_NOTICE',      E_ERROR        => 'E_ERROR',
                                         E_STRICT      => 'E_STRICT' );
    private $use_htmlentities = true; // Convert screen output to html entities
    
    /**
    * Constructor attempts to create kiss_errors.txt
    * @see makeErrorsFile()
    */
    private function __construct() {
      self::$rootpath = str_replace( 'includes', '', str_replace( DIRECTORY_SEPARATOR, '/', realpath( dirname( __FILE__ ) ) ) ); 
      $this->makeErrorsFile();
    } // end constructor
    
    /**
    * Create a singleton instance of the class.
    * Attaches the current error to the registry
    * 
    * @param int $errno      - error number
    * @param string $errstr  - the error as a descriptive string
    * @param string $errfile - file where the error originated
    * @param mixed $errline  - the line in the file where the error originated
    * @return KISS_Error_Handler
    */
    public static function i( $errno, $errstr, $errfile, $errline ) {
      if ( false === is_object( self::$_singleton ) ) {
        self::$_singleton = new self;
        self::$reporting = strtolower( KISS_ERROR_REPORTING_OUTPUT );
        self::registryAttach( $errno, $errstr, $errfile, $errline );
        return self::$_singleton;
      }
      self::registryAttach( $errno, $errstr, $errfile, $errline );
      return self::$_singleton;
    } // end method
    
    public static function q( $time, $query ) {
      if ( false === is_object( self::$_singleton ) ) {
        self::$_singleton = new self;
        self::$reporting = strtolower( KISS_ERROR_REPORTING_OUTPUT );
        self::logQuery( $time, $query );
        return self::$_singleton;
      }
      self::logQuery( $time, $query );
      return self::$_singleton;
    } // end method
    
    public static function breakpoint( $time, $file, $line, $exit_script = false ) {
      if ( false === is_object( self::$_singleton ) ) {
        self::$_singleton = new self;
        self::$reporting = strtolower( KISS_ERROR_REPORTING_OUTPUT );
        self::setBreakPoint( $time, $file, $line, $exit_script );
        return self::$_singleton;
      }
      self::setBreakPoint( $time, $file, $line, $exit_script );
      return self::$_singleton;
    } // end method
    
    private static function stripRootPath( $full_file_path ) {
      return str_replace( self::$rootpath, '', str_replace( DIRECTORY_SEPARATOR, '/', $full_file_path ) );
    }
    
    /**
    * Handles errors on class destruction
    */
    public function __destruct() {
      $this->outputBreakPoints();
      $this->outputQueries();
      $this->manage();
    } // end destructor
    
    /**
    * Attempt to create the errorfile.txt
    */
    private function makeErrorsFile() {
 
      $this->errorfile_path = self::$rootpath . 'errors/';
      if ( false === is_writable( $this->errorfile_path ) ) {
        return trigger_error( 'Class: ' . __CLASS__ . '<br /> Function: ' . __FUNCTION__  . ' errors directory <b>' . $rootpath . 'errors/' . '</b> is not writeable.', E_USER_WARNING );
      }
      if ( is_writable( $this->errorfile_path . $this->error_file ) ) {
        return;
      } 
      if ( false === ( $handle = @fopen( $this->errorfile_path . $this->error_file, 'a' ) ) ) {
        return trigger_error( 'Class: ' . __CLASS__ . '<br /> Function: ' . __FUNCTION__  . ' cannot open ' . $this->error_file, E_USER_WARNING );
      }
      fclose( $handle );
    } // end method
    
    /**
    * The registry retains all errors up until they are output on class destruct
    * 
    * @param int $errno      - error number
    * @param string $errstr  - the error as a descriptive string
    * @param string $errfile - file where the error originated
    * @param mixed $errline  - the line in the file where the error originated
    */
    private static function registryAttach( $errno, $errstr, $errfile, $errline ) {
      self::$registry['errors'][$errno][] = array( 'type'   => self::$error_types[$errno],
                                                   'string' => $errstr,
                                                   'file'   => $errfile,
                                                   'line'   => $errline );
    } // end method
    
    /**
    * Error output factory
    */
    private function manage() {
      switch ( self::$reporting ) {
        case 'screen':
          if ( ( KISS_ERROR_REPORTING_GET_SWITCH == 'false' ) || ( array_key_exists( KISS_ERROR_REPORTING_GET_SWITCH, $_GET ) ) ) {
            $this->toScreen();
          }
          break;
        case 'suppress':
          return false;
          break;
        default:
          $this->toFile();
          break;
      }
    } // end method
    
    private function outputHtmlTop( $title ) {
?>
  <div style="padding: 3em; font-family: verdana; width: 980px; margin-left: auto; margin-right: auto;">
    <div style="width: 100%; background-color: #ffffdd; border: 1px solid #1659AC; font-size: 10pt;">
      <div style="background-color: #2E8FCA; font-size: 12pt; font-weight: bold; padding: 0.5em; color: #00598E;">
        <div style="float: right; color: #0073BA; font-weight: bold; font-size: 16pt; margin-top: -0.2em;">FWR MEDIA</div>
        <?php echo $title . PHP_EOL; ?>
      </div>
<?php
    }
    
    private function outputHtmlBottom() {
?>
    </div>
  </div>
<?php
    }

    /**
    * Output the error registry to screen
    */
    private function toScreen() {
      $this->outputHtmlTop( 'KissER Error Handling:' );
      foreach ( self::$registry['errors'] as $error_code => $errors_array ) {
        if ( false === isset( self::$error_types[$error_code] ) ) {
          $error_type = 'Unique error code: ' . $error_code;
        } else {
          $error_type = self::$error_types[$error_code];
        }
?>
      <div style="padding: 0.5em; background-color: #B3D6EC; color: #00598E; font-weight: bold; font-size: 10pt;"><?php echo $error_type . ' Error Count: ' . count( self::$registry['errors'][$error_code] ); ?></div>
<?php
        $already_reported = array();
        foreach ( $errors_array as $index => $detail ) {
          $detail['file'] = self::stripRootPath( $detail['file'] );
          if ( is_array( $detail['string'] ) || is_object( $detail['string'] ) ) {
            $detail['string'] = '<pre>' . print_r( $detail['string'], true ) . '</pre>'; 
          } elseif ( false !== $this->use_htmlentities ) {
            $detail['string'] = htmlentities( html_entity_decode( $detail['string'] ) ); 
          }
          if ( false === array_key_exists( md5( $detail['file'] . $detail['line'] . $detail['string'] ) , $already_reported ) ) {
            if ( defined( 'KISS_ERROR_REPORTING_SUPPRESS_DUPLICATES' ) && strtolower( KISS_ERROR_REPORTING_SUPPRESS_DUPLICATES ) == 'on' ) {
              $already_reported[md5( $detail['file'] . $detail['line'] . $detail['string'] )] = 1;
            }
?>
      <div style="padding: 0.5em; background-color: #E0E0E0; color: #027AC6; font-size: 10pt;">Error: <?php echo $detail['string']; ?></div>
      <div style="padding: 0.5em; background-color: #E8E8E8; color: #027AC6; font-size: 10pt;">File: <?php echo $detail['file']; ?></div>
      <div style="border-bottom: 1px solid #2E8FCA; padding: 0.5em; background-color: #F0F0F0; color: #027AC6; font-size: 10pt;">Line: <?php echo $detail['line']; ?></div>
<?php
          }
        }
      }  
      $this->outputHtmlBottom();
    } // end method
    
    /**
    * Output the error registry to file
    */
    private function toFile() {
      foreach ( self::$registry['errors'] as $error_code => $errors_array ) {
        if ( false === isset( self::$error_types[$error_code] ) ) {
          $error_type = 'Unique error code: ' . $error_code;
        } else {
          $error_type = self::$error_types[$error_code];
        }
        $already_reported = array();
        foreach ( $errors_array as $index => $detail ) { 
          $detail['file'] = self::stripRootPath( $detail['file'] );
          if ( is_array( $detail['string'] ) || is_object( $detail['string'] ) ) {
            $detail['string'] = print_r( $detail['string'], true ); 
          }
          if ( false === array_key_exists( md5( $detail['file'] . $detail['line'] . $detail['string'] ) , $already_reported ) ) {
            if ( defined( 'KISS_ERROR_REPORTING_SUPPRESS_DUPLICATES' ) && strtolower( KISS_ERROR_REPORTING_SUPPRESS_DUPLICATES ) == 'on' ) {
              $already_reported[md5( $detail['file'] . $detail['line'] . $detail['string'] )] = 1;
            }
            $error_string = 'Date / Time: ' . date("d-m-Y H:i:s") . PHP_EOL;
            $error_string .= 'Error Type: [' . $error_type . '] ' . $detail['string'] . PHP_EOL;
            $error_string .= 'On line ' . $detail['line'] . PHP_EOL . 'File ' . $detail['file'] . PHP_EOL;
            $error_string .= str_repeat( '-+', 30 ) . PHP_EOL . PHP_EOL;
            $this->writeToFile( $error_string );
          }
        }
      }
    } // end method
    
    private function outputQueries() {
      if ( ( KISS_ERROR_REPORTING_GET_SWITCH == 'false' ) || ( array_key_exists( KISS_ERROR_REPORTING_GET_SWITCH, $_GET ) ) ) {
        if ( ( strtolower( KISS_ERROR_REPORTING_QUERIES ) != 'on' ) || ( strtolower( KISS_ERROR_REPORTING_OUTPUT ) != 'screen' ) ) {
          return false;
        }
        $this->outputHtmlTop( 'KissER Query Output:' );
?>
      <div style="padding: 0.5em; background-color: #fff; color: #027AC6; font-size: 10pt;"><b>Total Queries:</b> <?php echo self::$queries['count']; ?></div>
      <div style="padding: 0.5em; background-color: #fff; color: #027AC6; font-size: 10pt;"><b>Slowest Query Number</b> <?php  echo self::$queries['slowest']['count']; ?><br /><b>Time:</b> <?php echo self::$queries['slowest']['time']; ?> Seconds.</div>
      <div style="padding: 0.5em; background-color: #fff; color: #027AC6; font-size: 10pt;"><b>Total query Time</b> <?php echo self::$queries['total_time']; ?> Seconds.</div>
<?php
        foreach ( self::$queries['queries'] as $index => $detail ) {
?>
      <div style="padding: 0.5em; background-color: #E0E0E0; color: #027AC6; font-size: 10pt;">Number: <?php echo $index; ?></div>
      <div style="padding: 0.5em; background-color: #E8E8E8; color: #027AC6; font-size: 10pt;">Time: <?php echo $detail['time']; ?> Seconds.</div>
      <div style="border-bottom: 1px solid #2E8FCA; padding: 0.5em; background-color: #F0F0F0; color: #027AC6; font-size: 10pt;">Query: <?php echo $detail['query']; ?></div>
<?php
        }
        $this->outputHtmlBottom();
      }
    }
    
    private function outputBreakPoints() {
      if ( ( KISS_ERROR_REPORTING_GET_SWITCH == 'false' ) || ( array_key_exists( KISS_ERROR_REPORTING_GET_SWITCH, $_GET ) ) ) {
        if ( ( strtolower( KISS_ERROR_REPORTING_BREAKPOINTS ) != 'on' ) || ( strtolower( KISS_ERROR_REPORTING_OUTPUT ) != 'screen' ) ) {
          return false;
        }
        $this->outputHtmlTop( 'KissER Break Points:' );
        foreach ( self::$breakpoints['break'] as $index => $detail ) {
?>
      <div style="padding: 0.5em; background-color: #E0E0E0; color: #027AC6; font-size: 10pt;"><b>Number:</b> <?php echo ( $index +1 ); ?> <b>Exit script:</b> <?php echo $detail['exit_script']; ?></div>
      <div style="padding: 0.5em; background-color: #E8E8E8; color: #027AC6; font-size: 10pt;"><b>File:</b> <?php echo $detail['file']; ?> <b>Line:</b> <?php echo $detail['line']; ?></div>
      <div style="border-bottom: 1px solid #2E8FCA; padding: 0.5em; background-color: #F0F0F0; color: #027AC6; font-size: 10pt;"><b>Seconds:</b> <?php echo $detail['seconds']; ?> <b>Queries:</b> <?php echo $detail['queries']; ?> <b>Errors:</b> <?php echo $detail['errors']; ?></div>
<?php
        }
        $this->outputHtmlBottom();
      }
    }
    
    /**
    * Write to the error file.txt
    * 
    * @param string $error_string - the error details
    */
    private function writeToFile( $error_string ) {
     if ( false === ( ( strlen( $error_string ) > 0 ) && @file_put_contents( $this->errorfile_path . $this->error_file, $error_string, FILE_APPEND ) ) ) {
       return false;
     }
     return true;
    } // end method
    
    private static function logQuery( $time, $query ) {
      if ( strtolower( KISS_ERROR_REPORTING_QUERIES ) != 'on' ) {
        return false;
      }
      if ( !array_key_exists( 'count', self::$queries ) ) {
        self::$queries['count'] = 0;
        self::$queries['slowest'] = array( 'count' => 0, 'time' => 0 );
        self::$queries['total_time'] =  0;
      }
      self::$queries['count'] ++;
      self::$queries['total_time'] += $time;
      if ( self::$queries['slowest']['time'] < $time ) {
        self::$queries['slowest'] = array( 'count' => self::$queries['count'], 'time' => $time );
      }
      self::$queries['queries'][self::$queries['count']] = array( 'query' => preg_replace( array( "@[\n\t]+@", "@[\s]+@" ), array( '', ' ' ), $query ),
                                                       'time'  => $time );
    } // end methods
    
    private static function setBreakPoint( $time, $file, $line, $exit_script ) {
      if ( strtolower( KISS_ERROR_REPORTING_BREAKPOINTS ) != 'on' ) {
        return;
      }
      $queries = 0;
      if ( isset( self::$queries['queries'] ) && !empty( self::$queries['queries'] ) ) {
        $queries = count( self::$queries['queries'] ) -1;
      }
      if ( false === isset( self::$breakpoints['start_time'] ) ) {
        self::$breakpoints['start_time'] = $time;
        $time = 0.00;
      } else {
        $time = round( ( $time - self::$breakpoints['start_time'] ), 4 );
      }
      self::$breakpoints['break'][] = array( 'seconds' => $time,
                                             'file'    => self::stripRootPath( $file ),
                                             'line'    => $line,
                                             'queries' => $queries,
                                             'errors'  => self::breakpointsGetErrors(),
                                             'exit_script' => ( ( false === $exit_script ) ? 'false' : 'true' ) );
      if ( false !==  $exit_script ) {
        session_write_close();
        exit;
      }
    } // end method
    
    private static function breakpointsGetErrors() {
      if ( empty( self::$registry['errors'] ) ) {
        return 'No errors recorded';
      }
      $bp_errors = array();
      foreach ( self::$registry['errors'] as $error_code => $errors_array ) {
        $bp_errors[self::$error_types[$error_code]] = count( self::$registry['errors'][$error_code] );
      }
      $br_error_string = '';
      foreach ( $bp_errors as $type => $count ) {
        $br_error_string .= $type . ': ('. $bp_errors[$type] . ') ';
      } 
      return trim( $br_error_string );
    } // End method 
 
  } // end class
?>