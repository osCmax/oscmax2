<?php

/**

 * Google XML Sitemap Feed Cron Script
 *
 * The Google sitemap service was announced on 2 June 2005 and represents
 * a huge development in terms of crawler technology.  This contribution is
 * designed to create the sitemap XML feed per the specification delineated 
 * by Google.  This cron script will call the code to create the scripts and 
 * eliminate the session auto start issues. 
 * @package Google-XML-Sitemap-Feed

 * @license http://opensource.org/licenses/gpl-license.php GNU Public License

 * @version 1.2

 * @link http://www.oscommerce-freelancers.com/ osCommerce-Freelancers
 * @link http://www.google.com/webmasters/sitemaps/docs/en/about.html About Google Sitemap 
 * @copyright Copyright 2005, Bobby Easland 
 * @author Bobby Easland 
 
 * @version 2

 * @link http://www.eurobigstore.com
 * @link http://www.google.com/webmasters/sitemaps/docs/en/about.html About Google Sitemap 
 * @copyright Copyright 2006, Davide Duca 
 * @author Davide Duca 
 * @filesource
 */
  $language = $_GET['language'];
  require('includes/application_top.php');
  
  require(bts_select('language', FILENAME_GOOGLE_SITEMAPS));
  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_GOOGLE_SITEMAPS));
	
	chdir('../');

	/**
	 * Option to compress the files
	 */

	define('GOOGLE_SITEMAP_COMPRESS', 'false');
	/**
	 * Option for change frequency of products
	 */

	define('GOOGLE_SITEMAP_PROD_CHANGE_FREQ', 'weekly');
	/**
	 * Option for change frequency of categories
	 */

	define('GOOGLE_SITEMAP_CAT_CHANGE_FREQ', 'weekly');
	/**
	 * Carried over from application_top.php for compatibility
	 */
	 
    require_once('includes/configure.php');

	define('DIR_WS_CATALOG', DIR_WS_HTTP_CATALOG);	
	
	require_once(DIR_WS_INCLUDES . 'filenames.php');
	require_once(DIR_WS_INCLUDES . 'database_tables.php');
	require_once(DIR_WS_FUNCTIONS . 'database.php');
	require_once(DIR_WS_FUNCTIONS . 'general.php');


	tep_db_connect() or die('Unable to connect to database server!');

	$configuration_query = tep_db_query('select configuration_key as cfgKey, configuration_value as cfgValue from ' . TABLE_CONFIGURATION);

	while ($configuration = tep_db_fetch_array($configuration_query)) {
		define($configuration['cfgKey'], $configuration['cfgValue']);
	}



	//function tep_not_null($value) {
		//if (is_array($value)) {
		//  if (sizeof($value) > 0) {
			//return true;
		//  } else {
			//return false;
		//  }
		//} else {
		//  if (($value != '') && (strtolower($value) != 'null') && (strlen(trim($value)) > 0)) {
			//return true;
		//  } else {
			//return false;
		//  }
		//}
	//} # end function

	include_once(DIR_WS_CLASSES . 'language.php');
	$lng = new language();
	$languages_id = $lng->language['id'];

//if ( defined('SEO_URLS') && SEO_URLS == 'true' || defined('SEO_ENABLED') && SEO_ENABLED == 'true' ) {

 if ( (SEARCH_ENGINE_FRIENDLY_URLS == 'true') ) {
// Commentati Davide Duca
//	function tep_session_is_registered( $var ){
//		return false;
//	}  # end function


//	function tep_session_name(){
//		return false;
//	} # end function
	

//	function tep_session_id(){
//		return false;

//	} # end function

	//function tep_parse_input_field_data($data, $parse) {
		//return strtr(trim($data), $parse);
	//} # end function
// Fine Commento Davide Duca

//	function tep_output_string($string, $translate = false, $protected = false) {
//		if ($protected == true) {
//		  return htmlspecialchars($string);
	//	} else {
	//	  if ($translate == false) {
			//return tep_parse_input_field_data($string, array('"' => '&quot;'));
		//  } else {
			//return tep_parse_input_field_data($string, $translate);
		//  }
		//}
	//} # end function	

	if ( file_exists(DIR_WS_CLASSES . 'seo.class.php') ){
		require_once(DIR_WS_CLASSES . 'seo.class.php');
		$seo_urls = new SEO_URL($languages_id);
	}	

	require_once(DIR_WS_FUNCTIONS . 'html_output.php');
	if ( file_exists(DIR_WS_CLASSES . 'cache.class.php') ){
		include(DIR_WS_CLASSES . 'cache.class.php');
		$cache = new cache($languages_id);
		if ( file_exists('includes/seo_cache.php') ){
			include('includes/seo_cache.php');
		}
		$cache->get_cache('GLOBAL');
	}
} # end if

require_once('sitemap.class.php');

$google = new GoogleSitemap(DB_SERVER, DB_SERVER_USERNAME, DB_DATABASE, DB_SERVER_PASSWORD);
$submit = true;

echo '<p class="main">';

if ($google->GenerateProductSitemap()){

	echo GOOGLE_SITEMAPS_PRODUCT_SUCCESS . "<br><br>";

} else {

	$submit = false;

	echo GOOGLE_SITEMAPS_PRODUCT_ERROR . "<br><br>";

}



if ($google->GenerateCategorySitemap()){

	echo GOOGLE_SITEMAPS_CATEGORY_SUCCESS . "<br><br>";

} else {

	$submit = false;

	echo GOOGLE_SITEMAPS_CATEGORY_ERROR . "<br><br>";

}



if ($google->GenerateSitemapIndex()){
	echo GOOGLE_SITEMAPS_INDEX_SUCCESS . "<br><br>";

} else {

	$submit = false;

	echo GOOGLE_SITEMAPS_INDEX_ERROR . "<br><br>";

}



if ($submit) {

	echo '<b>' . GOOGLE_SITEMAPS_CONGRATULATION . "</b><br><br>";

	echo GOOGLE_SITEMAPS_HIGHLY_RECCOMMEND . "<br><br>";

	echo GOOGLE_SITEMAPS_HERE_INDEX . '<a href="' . $google->base_url . 'sitemapindex.xml" target="_blank">' .  $google->base_url . 'sitemapindex.xml' . "</a><br>";

	echo GOOGLE_SITEMAPS_HERE_PRODUCT . '<a href="' . $google->base_url . 'sitemapproducts.xml" target="_blank">' . $google->base_url . 'sitemapproducts.xml' . "</a><br>";

	echo GOOGLE_SITEMAPS_HERE_CATEGORY . '<a href="' . $google->base_url . 'sitemapcategories.xml" target="_blank">' . $google->base_url . 'sitemapcategories.xml' . "</a><br><br><br>";

	echo GOOGLE_SITEMAPS_CONVENIENCE . "<br>";

	echo 'php ' . dirname($_SERVER['SCRIPT_FILENAME']) . '/sitemaps.index.php' . "<br><br>";

} else {

	print_r($google->debug);

}

echo '</p>';

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
</head>
<body bgcolor="#FFFFFF">