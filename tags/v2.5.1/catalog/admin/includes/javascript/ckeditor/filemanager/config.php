<?php
/*
PDW File Browser v1.3 beta
Date: October 19, 2010
Url: http://www.neele.name

Copyright (c) 2010 Guido Neele

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

chdir ('../../../../');
include ('includes/configure.php');
// include the list of project filenames
  require(DIR_WS_INCLUDES . 'filenames.php');

// include the list of project database tables
  require(DIR_WS_INCLUDES . 'database_tables.php');

// include the database functions
  require(DIR_WS_FUNCTIONS . 'database.php');

// make a connection to the database... now
  tep_db_connect() or die('Unable to connect to database server!');
// set application wide parameters
// Configuration Cache modification start
  require ('includes/configuration_cache_read.php');
// Configuration Cache modification end

// define our general functions used application-wide
  require(DIR_WS_FUNCTIONS . 'general.php');
  require(DIR_WS_FUNCTIONS . 'html_output.php');

// LINE ADDED: MOD - Admin w/access levels
  require(DIR_WS_FUNCTIONS . 'password_funcs.php');

// initialize the logger class
  require(DIR_WS_CLASSES . 'logger.php');

// include shopping cart class
  require(DIR_WS_CLASSES . 'shopping_cart.php');

// define how the session functions will be used
  require(DIR_WS_FUNCTIONS . 'sessions.php');

// set the session name and save path
  tep_session_name('osCAdminID');
  tep_session_save_path(SESSION_WRITE_DIRECTORY);

// set the session cookie parameters
   if (function_exists('session_set_cookie_params')) {
    session_set_cookie_params(0, DIR_WS_ADMIN);
  } elseif (function_exists('ini_set')) {
    ini_set('session.cookie_lifetime', '0');
    ini_set('session.cookie_path', DIR_WS_ADMIN);
  }
if (isset($_POST) && (array_key_exists(tep_session_name(), $_POST))) {
	tep_session_id($_POST[tep_session_name()]);
};

// lets start our session
  tep_session_start();

  if (!tep_session_is_registered('login_id')) {
	if (empty($_POST) && empty($_GET)) {
    	tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
	} else {
		echo '
<script>
document.location=\'' . tep_href_link(FILENAME_LOGIN, '', 'SSL') . '\';
</script>';
		die();
	};
  }; 


chdir ('includes/javascript/ckeditor/filemanager/');
/*
session_start();
if(!isset($_SESSION)){ session_start();}  
//if (!isset($_COOKIE['osCAdminID'])) exit;

/*
 * Uncomment lines below to enable PHP error reporting and displaying PHP errors.
 * Do not do this on a production server. Might be helpful when debugging why PDW File Browser
 * does not work as expected.
 */
// error_reporting(E_ALL);
// ini_set('display_errors', 1);


/**
 * WARNING: You should do your authorization checking right here. config.php is included 
 * in every file so checking it here is securing the whole plug-in. By not checking for 
 * authorization you are allowing "anyone" to upload and list the files in your server. 
 * You must implement some kind of session validation here. You could do something like...
 *
 * if (!(isset($_SESSION['IsAuthorized']) && $_SESSION['IsAuthorized'])){
 *      die("You are not authorized!");
 * }
 *
 * ... where $_SESSION['IsAuthorized'] is set to "true" as soon as the user logs in to your system.
**/
/*
 if (!isset($_COOKIE['osCAdminID'])) {
      print_r($_SESSION);
      die("You are not authorized! No cookie set!");
 }
*/
/* if (!(isset($_SESSION['login_id']) && $_SESSION['login_id'])){
      print_r($_SESSION);
      die("You are not authorized! No login ID set!");
 } */
/*
 * UPLOAD PATH
 * 
 * absolute path from root to upload folder (DON'T FORGET SLASHES)
 *
 * Example 
 * ---------------------------------------
 * http://www.domain.com/images/upload/
 * $uploadpath = '/images/upload/';
 *
 */
/*
 require_once ('../../../configure.php');
*/
$uploadpath = DIR_WS_CATALOG_IMAGES; // absolute path from root to upload folder (DON'T FORGET SLASHES)

/*
 * DEFAULT TIMEZONE
 * 
 * If you use PHP 5 then set default timezone to avoid any date errors. 
 * 
 * Select the timezone you are in.
 *
 * Timezones to select from are http://nl3.php.net/manual/en/timezones.php
 *
 */
//date_default_timezone_set('Europe/Amsterdam');

/*
 * VIEW LAYOUT
 *
 * Set the default view layout when the file browser is first loaded
 *
 * Your options are: 'large_images', 'small_images', 'list', 'content', 'tiles' and 'details'
 *
 */
$viewLayout = 'tiles';

/*
 * DEFAULT LANGUAGE
 * 
 * Set default language to load when &language=? is not included in url
 *
 * See lang directory for included languages. For now your options are 'en' and 'nl'
 * But you are free to translate the language files in the /lang/ directory. Copy the
 * en.php file and translate the lines after the =>
 *
 */
$defaultLanguage = 'en';

/*
 * ALLOWED ACTIONS
 * 
 * Set an action to FALSE to prevent execution.
 * Buttons will be removed from UI when an action is set to FALSE.
 * 
 */
$allowedActions = array(
    'upload' => TRUE,
	'settings' => TRUE,
    'cut_paste' => TRUE,
	'copy_paste' => TRUE,
	'rename' => TRUE,
	'delete' => TRUE,
	'create_folder' => TRUE
); 

/*
 * PDW File Browser depends on $_SERVER['DOCUMENT_ROOT'] to resolve path/filenames. This value is usually
 * correct, but has been known to be broken on some servers. This value allows you to override the default
 * value.
 * Do not modify from the auto-detect default value unless you are having problems.
 */
//define('DOCUMENTROOT', '/home/httpd/httpdocs');
//define('DOCUMENTROOT', 'c:\\webroot\\example.com\\www');
//define('DOCUMENTROOT', $_SERVER['DOCUMENT_ROOT']);
//define('DOCUMENTROOT', $_SERVER['DOCUMENT_ROOT']);
//define('DOCUMENTROOT', realpath((@$_SERVER['DOCUMENT_ROOT'] && file_exists(@$_SERVER['DOCUMENT_ROOT'].$_SERVER['PHP_SELF'])) ? $_SERVER['DOCUMENT_ROOT'] : str_replace(dirname(@$_SERVER['PHP_SELF']), '', str_replace(DIRECTORY_SEPARATOR, '/', realpath('.')))));
define('DOCUMENTROOT', realpath((getenv('DOCUMENT_ROOT') && preg_match('#^'.preg_quote(realpath(getenv('DOCUMENT_ROOT'))).'#', realpath(__FILE__))) ? getenv('DOCUMENT_ROOT') : str_replace(dirname(@$_SERVER['PHP_SELF']), '', str_replace(DIRECTORY_SEPARATOR, '/', dirname(__FILE__)))));
/*
 * CUSTOM FILTERS
 * 
 * If you like to use custom filters then remove "//" to add your own filters.
 * "name of filter" => ".extension1|.extension2"
 */
//$customFilters = array(
//    "MS Office Documents (Custom filter)" => ".doc|.docx|.xsl|.xlsx|.ppt|.pptx",
//    "PDF-Documents (Custom filter)" => ".pdf"
//);

/*
 * DEFAULT SKIN
 * 
 * Take a look inside the /skin/ folder to see which skins are available. If you leave the "//"
 * then redmond (Windows 7 like) will be the default theme.
 */
//$defaultSkin="mountainview";



/*
 * EDITOR
 * 
 * Which editor are we dealing with? PDW File Browser can be used with TinyMCE and CKEditor.
 */
$editor = isset($_GET["editor"]) ? $_GET["editor"] : ''; // If you want to use the file browser for both editors and/or standalone
//$editor="tinymce";
$editor="ckeditor";
//$editor="standalone";


/*
 * UPLOAD SETTINGS
 * 
 */
// Maximum file size
$max_file_size_in_bytes = 16777216; // 16MB in bytes

// Characters allowed in the file name (in a Regular Expression format)               
$valid_chars_regex = '.A-Z0-9_ !@#$%^&()+={}\[\]\',~`-';

// Allowed file extensions
// Remove an extension if you don't want to allow those files to be uploaded.
//$extension_whitelist = "7z,aiff,asf,avi,bmp,csv,doc,docx,fla,flv,gif,gz,gzip,jpeg,jpg,mid,mov,mp3,mp4,mpc,mpeg,mpg,ods,odt,pdf,png,ppt,pptx,pxd,qt,ram,rar,rm,rmi,rmvb,rtf,sdc,sitd,swf,sxc,sxw,tar,tgz,tif,tiff,txt,vsd,wav,wma,wmv,xls,xlsx,zip";
$extension_whitelist = "asf,avi,bmp,fla,flv,gif,jpeg,jpg,mov,mpeg,mpg,png,tif,tiff,wmv"; // Images, video and flash only


/*
 * RETURN LINKS AS ABSOLUTE OR ABSOLUTE WITHOUT HOSTNAME
 *
 * Ex. http://www.example.com/upload/file.jpg instead of /upload/file.jpg 
 */
$absolute_url = true; // When FALSE url will be returned absolute without hostname, like /upload/file.jpg.
$absolute_url_disabled = FALSE; // When TRUE changing from absolute to relative is not possible.







//--------------------------DON'T EDIT BEYOND THIS LINE ----------------------------------









define('STARTINGPATH', DOCUMENTROOT . $uploadpath); //DON'T EDIT

//Check if upload folder exists
if(!@is_dir(STARTINGPATH)) die('Upload folder doesn\'t exist or $uploadpath in config.php is set wrong!');

//Check if editor is set
if(!isset($editor)) die('The variable $editor in config.php is not set!');

// Figure out which language file to load
if(!empty($_REQUEST['language'])) {
	$fm_language = $_REQUEST['language'];
} elseif (isset($_SESSION['fm_language'])) {
	$fm_language = $_SESSION['fm_language'];
} else {
	$fm_language = $defaultLanguage;
}

require_once("lang/".$fm_language.".php");
$_SESSION['fm_language'] = $fm_language;

// Get local settings from language file
$datetimeFormat = $lang["datetime format"];				// 24 hours, AM/PM, etc...
$dec_seperator = $lang["decimal seperator"]; 			// character in front of the decimals
$thousands_separator = $lang["thousands separator"];	// character between every group of thousands


// Check post_max_size (http://us3.php.net/manual/en/features.file-upload.php#73762)
function let_to_num($v){ //This function transforms the php.ini notation for numbers (like '2M') to an integer (2*1024*1024 in this case)
    $l = substr($v, -1);
    $ret = substr($v, 0, -1);
    switch(strtoupper($l)){
        case 'P': $ret *= 1024;
        case 'T': $ret *= 1024;
        case 'G': $ret *= 1024;
        case 'M': $ret *= 1024;
        case 'K': $ret *= 1024;
        break;
    }
    return $ret;
}

$max_upload_size = min(let_to_num(ini_get('post_max_size')), let_to_num(ini_get('upload_max_filesize')));

if ($max_file_size_in_bytes > $max_upload_size) {
    $max_file_size_in_bytes = $max_upload_size;
}
?>
