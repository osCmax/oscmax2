<?php

/**

 * Google XML Sitemap Feed

 *

 * The Google sitemap service was announced on 2 June 2005 and represents

 * a huge development in terms of crawler technology.  This contribution is

 * designed to create the sitemap XML feed per the specification delineated

 * by Google.

 * @package Google-XML-Sitemap-Feed

 * @license http://opensource.org/licenses/gpl-license.php GNU Public License

 * @version 1.0

 * @link http://www.oscommerce-freelancers.com/ osCommerce-Freelancers

 * @link http://www.google.com/webmasters/sitemaps/docs/en/about.html About Google Sitemap

 * @copyright Copyright 2005, Bobby Easland

 * @author Bobby Easland

 * @version 2.0

 * @link http://www.eurobigstore.com

 * @link http://www.google.com/webmasters/sitemaps/docs/en/about.html About Google Sitemap

 * @copyright Copyright 2006, Davide Duca

 * @author Davide Duca

 * @filesource


 */



/**

 * MySQL_Database Class

 *

 * The MySQL_Database class provides abstraction so the databaes can be accessed

 * without having to use tep API functions. This class has minimal error handling

 * so make sure your code is tight!

 * @package Google-XML-Sitemap-Feed

 * @license http://opensource.org/licenses/gpl-license.php GNU Public License

 * @version 1.1

 * @link http://www.oscommerce-freelancers.com/ osCommerce-Freelancers

 * @copyright Copyright 2005, Bobby Easland

 * @author Bobby Easland

 */

class MySQL_DataBase{

	/**

 	* Database host (localhost, IP based, etc)

	* @var string

 	*/

	var $host;

	/**

 	* Database user

	* @var string

 	*/

	var $user;

	/**

 	* Database name

	* @var string

 	*/

	var $db;

	/**

 	* Database password

	* @var string

 	*/

	var $pass;

	/**

 	* Database link

	* @var resource

 	*/

	var $link_id;



/**

 * MySQL_DataBase class constructor

 * @author Bobby Easland

 * @version 1.0

 * @param string $host

 * @param string $user

 * @param string $db

 * @param string $pass

 */

	function MySQL_DataBase($host, $user, $db, $pass){

		$this->host = $host;

		$this->user = $user;

		$this->db = $db;

		$this->pass = $pass;

		$this->ConnectDB();

		$this->SelectDB();

	} # end function



/**

 * Function to connect to MySQL

 * @author Bobby Easland

 * @version 1.0

 */

	function ConnectDB(){

		$this->link_id = mysql_connect($this->host, $this->user, $this->pass);

	} # end function



/**

 * Function to select the database

 * @author Bobby Easland

 * @version 1.0

 * @return resoource

 */

	function SelectDB(){

		return mysql_select_db($this->db);

	} # end function



/**

 * Function to perform queries

 * @author Bobby Easland

 * @version 1.0

 * @param string $query SQL statement

 * @return resource

 */

	function Query($query){

		return @mysql_query($query, $this->link_id);

	} # end function



/**

 * Function to fetch array

 * @author Bobby Easland

 * @version 1.0

 * @param resource $resource_id

 * @param string $type MYSQL_BOTH or MYSQL_ASSOC

 * @return array

 */

	function FetchArray($resource_id, $type = MYSQL_BOTH){

		return @mysql_fetch_array($resource_id, $type);

	} # end function



/**

 * Function to fetch the number of rows

 * @author Bobby Easland

 * @version 1.0

 * @param resource $resource_id

 * @return mixed

 */

	function NumRows($resource_id){

		return @mysql_num_rows($resource_id);

	} # end function



/**

 * Function to free the resource

 * @author Bobby Easland

 * @version 1.0

 * @param resource $resource_id

 * @return boolean

 */

	function Free($resource_id){

		return @mysql_free_result($resource_id);

	} # end function



/**

 * Function to add slashes

 * @author Bobby Easland

 * @version 1.0

 * @param string $data

 * @return string

 */

	function Slashes($data){

		return addslashes($data);

	} # end function



/**

 * Function to perform DB inserts and updates - abstracted from osCommerce-MS-2.2 project

 * @author Bobby Easland

 * @version 1.0

 * @param string $table Database table

 * @param array $data Associative array of columns / values

 * @param string $action insert or update

 * @param string $parameters

 * @return resource

 */

	function DBPerform($table, $data, $action = 'insert', $parameters = '') {

		reset($data);

		if ($action == 'insert') {

		  $query = 'INSERT INTO `' . $table . '` (';

		  while (list($columns, ) = each($data)) {

			$query .= '`' . $columns . '`, ';

		  }

		  $query = substr($query, 0, -2) . ') values (';

		  reset($data);

		  while (list(, $value) = each($data)) {

			switch ((string)$value) {

			  case 'now()':

				$query .= 'now(), ';

				break;

			  case 'null':

				$query .= 'null, ';

				break;

			  default:

				$query .= "'" . $this->Slashes($value) . "', ";

				break;

			}

		  }

		  $query = substr($query, 0, -2) . ')';

		} elseif ($action == 'update') {

		  $query = 'UPDATE `' . $table . '` SET ';

		  while (list($columns, $value) = each($data)) {

			switch ((string)$value) {

			  case 'now()':

				$query .= '`' .$columns . '`=now(), ';

				break;

			  case 'null':

				$query .= '`' .$columns .= '`=null, ';

				break;

			  default:

				$query .= '`' .$columns . "`='" . $this->Slashes($value) . "', ";

				break;

			}

		  }

		  $query = substr($query, 0, -2) . ' WHERE ' . $parameters;

		}

		return $this->Query($query);

	} # end function

} # end class



/**

 * Google Sitemap Base Class

 *

 * The MySQL_Database class provides abstraction so the databaes can be accessed

 * @package Google-XML-Sitemap-Feed

 * @license http://opensource.org/licenses/gpl-license.php GNU Public License

 * @version 1.2

 * @link http://www.oscommerce-freelancers.com/ osCommerce-Freelancers

 * @link http://www.google.com/webmasters/sitemaps/docs/en/about.html About Google Sitemap

 * @copyright Copyright 2005, Bobby Easland

 * @author Bobby Easland

 */

class GoogleSitemap{

	/**

 	* $DB is the database object

	* @var object

 	*/

	var $DB;

	/**

 	* $filename is the base name of the feeds (i.e. - 'sitemap')

	* @var string

 	*/

	var $filename;

	/**

 	* $savepath is the path where the feeds will be saved - store root

	* @var string

 	*/

	var $savepath;

	/**

 	* $base_url is the URL for the catalog

	* @var string

 	*/

	var $base_url;

	/**

 	* $debug holds all the debug data

	* @var array

 	*/

	var $debug;





/**

 * GoogleSitemap class constructor

 * @author Bobby Easland

 * @version 1.0

 * @param string $host Database host setting (i.e. - localhost)

 * @param string $user Database user

 * @param string $db Database name

 * @param string $pass Database password

 */

	function GoogleSitemap($host, $user, $db, $pass){

		$this->DB = new MySQL_Database($host, $user, $db, $pass);

		$this->filename = "sitemap";

		$this->savepath = DIR_FS_CATALOG;

		$this->base_url = HTTP_SERVER . DIR_WS_HTTP_CATALOG;

		$this->debug = array();

	} # end class constructor



/**

 * Function to save the sitemap data to file as either XML or XML.GZ format

 * @author Bobby Easland

 * @version 1.1

 * @param string $data XML data

 * @param string $type Feed type (index, products, categories)

 * @return boolean

 */

	function SaveFile($data, $type){

		//$filename = $this->savepath . '/' . $this->filename . $type;
		$filename = $this->savepath . $this->filename . $type;

		$compress = defined('GOOGLE_SITEMAP_COMPRESS') ? GOOGLE_SITEMAP_COMPRESS : 'false';

		if ($type == 'index') $compress = 'false';

		switch($compress){

			case 'true':

				$filename .= '.xml.gz';

				if ($gz = gzopen($filename,'wb9')){

					gzwrite($gz, $data);

					gzclose($gz);

					$this->debug['SAVE_FILE_COMPRESS'][] = array('file' => $filename, 'status' => 'success', 'file_exists' => 'true');

					return true;

				} else {

					$file_check = file_exists($filename) ? 'true' : 'false';

					$this->debug['SAVE_FILE_COMPRESS'][] = array('file' => $filename, 'status' => 'failure', 'file_exists' => $file_check);

					return false;

				}

				break;

			default:

				$filename .= '.xml';
				
				if ($fp = fopen($filename, 'w+')){

					fwrite($fp, $data);

					fclose($fp);

					$this->debug['SAVE_FILE_XML'][] = array('file' => $filename, 'status' => 'success', 'file_exists' => 'true');

					return true;

				} else {

					$file_check = file_exists($filename) ? 'true' : 'false';

					$this->debug['SAVE_FILE_XML'][] = array('file' => $filename, 'status' => 'failure', 'file_exists' => $file_check);

					return false;

				}

				break;

		} # end switch

	} # end function



/**

 * Function to compress a normal file

 * @author Bobby Easland

 * @version 1.0

 * @param string $file

 * @return boolean

 */

	function CompressFile($file){

		$source = $this->savepath . $file . '.xml';

		$filename = $this->savepath . $file . '.xml.gz';

		$error_encountered = false;

		if( $gz_out = gzopen($filename, 'wb9') ){

			if($fp_in = fopen($source,'rb')){

				while(!feof($fp_in)) gzwrite($gz_out, fread($fp_in, 1024*512));

					fclose($fp_in);



			} else {

				$error_encountered = true;

			}

			gzclose($gz_out);

		} else {

			$error_encountered = true;

		}

		if($error_encountered){

			return false;

		} else {

			return true;

		}

	} # end function



/**

 * Function to generate sitemap file from data

 * @author Bobby Easland

 * @version 1.0

 * @param array $data

 * @param string $file

 * @return boolean

 */

	function GenerateSitemap($data, $file){

		$content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
		$content = '<?xml-stylesheet type="text/xsl" href="gss.xsl"?>' . "\n";

		$content .= '<urlset xmlns="http://www.google.com/schemas/sitemap/0.84">' . "\n";

		foreach ($data as $url){

			$content .= "\t" . '<url>' . "\n";

			$content .= "\t\t" . '<loc>'.$url['loc'].'</loc>' . "\n";

			$content .= "\t\t" . '<lastmod>'.$url['lastmod'].'</lastmod>' . "\n";

			$content .= "\t\t" . '<changefreq>'.$url['changefreq'].'</changefreq>' . "\n";

			$content .= "\t\t" . '<priority>'.$url['priority'].'</priority>' . "\n";

			$content .= "\t" . '</url>' . "\n";

		} # end foreach

		$content .= '</urlset>';

		return $this->SaveFile($content, $file);
		
	} # end function



/**

 * Function to generate sitemap index file

 * @author Bobby Easland

 * @version 1.1

 * @return boolean

 */

	function GenerateSitemapIndex(){

		$content = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
		$content = '<?xml-stylesheet type="text/xsl" href="gss.xsl"?>' . "\n";

		$content .= '<sitemapindex xmlns="http://www.google.com/schemas/sitemap/0.84">' . "\n";

		$pattern = defined('GOOGLE_SITEMAP_COMPRESS')

				     ?	GOOGLE_SITEMAP_COMPRESS == 'true'

					 		?	"sitemap*.xml.gz"

							: 	"sitemap*.xml"

					 :	"sitemap*.xml";

		foreach ( array_merge(glob($this->savepath . $pattern)) as $filename ) {

		   if ( eregi('index', $filename) ) continue;

		   $content .= "\t" . '<sitemap>' . "\n";

		   $content .= "\t\t" . '<loc>'.$this->base_url . basename($filename).'</loc>' . "\n";

		   $content .= "\t\t" . '<lastmod>'.date ("Y-m-d", filemtime($filename)).'</lastmod>' . "\n";

		   $content .= "\t" . '</sitemap>' . "\n";

		} # end foreach

		$content .= '</sitemapindex>';

		return $this->SaveFile($content, 'index');

	} # end function



/**

 * Function to generate product sitemap data

 * @author Bobby Easland

 * @version 1.1

 * @return boolean

 */

	function GenerateProductSitemap(){

		$sql = "SELECT products_id as pID, products_date_added as date_added, products_last_modified as last_mod, products_ordered

			    FROM " . TABLE_PRODUCTS . "

				WHERE products_status='1'

				ORDER BY products_ordered DESC";


		if ( $products_query = $this->DB->Query($sql) ){

			$this->debug['QUERY']['PRODUCTS']['STATUS'] = 'success';

			$this->debug['QUERY']['PRODUCTS']['NUM_ROWS'] = $this->DB->NumRows($products_query);

			$container = array();

			$number = 0;

			$top = 0;

			while( $result = $this->DB->FetchArray($products_query) ){

				$top = max($top, $result['products_ordered']);

				//$location = $this->hrefLink('product' . $result['pID'] . FILENAME_PRODUCT_INFO, 'source=google', 'NONSSL', false);
				//$location = $this->hrefLink(FILENAME_PRODUCT_INFO, 'products_id=' . $result['pID'], 'NONSSL', false);
                $location = tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $result['pID'], 'NONSSL', false);  
				
				$lastmod = $this->NotNull($result['last_mod']) ? $result['last_mod'] : $result['date_added'];

				$changefreq = GOOGLE_SITEMAP_PROD_CHANGE_FREQ;

				$ratio = $top > 0 ? $result['products_ordered']/$top : 0;

				$priority = $ratio < .1 ? .1 : number_format($ratio, 1, '.', '');



				$container[] = array('loc' => htmlspecialchars(utf8_encode($location)),

				                     'lastmod' => date ("Y-m-d", strtotime($lastmod)),

									 'changefreq' => $changefreq,

									 'priority' => $priority

				                     );

				if ( sizeof($container) >= 50000 ){

					$type = $number == 0 ? 'products' : 'products' . $number;

					$this->GenerateSitemap($container, $type);

					$container = array();

					$number++;

				}

			} # end while

			$this->DB->Free($products_query);

			if ( sizeof($container) >= 1 ) {

				$type = $number == 0 ? 'products' : 'products' . $number;

				return $this->GenerateSitemap($container, $type);

			} # end if

		} else {

			$this->debug['QUERY']['PRODUCTS']['STATUS'] = 'false';

			$this->debug['QUERY']['PRODUCTS']['NUM_ROWS'] = '0';

		}
		

	} # end function



/**

 * Funciton to generate category sitemap data

 * @author Bobby Easland

 * @version 1.1

 * @return boolean

 */

	function GenerateCategorySitemap(){

		$sql = "SELECT categories_id as cID, date_added, last_modified as last_mod

			    FROM " . TABLE_CATEGORIES . "

				ORDER BY parent_id ASC, sort_order ASC, categories_id ASC";

		if ( $categories_query = $this->DB->Query($sql) ){

			$this->debug['QUERY']['CATEOGRY']['STATUS'] = 'success';

			$this->debug['QUERY']['CATEOGRY']['NUM_ROWS'] = $this->DB->NumRows($categories_query);

			$container = array();

			$number = 0;

			while( $result = $this->DB->FetchArray($categories_query) ){

				//$location = $this->hrefLink('category' . $this->GetFullcPath($result['cID']) . FILENAME_DEFAULT, 'source=google', 'NONSSL', false);
				//$location = $this->hrefLink(FILENAME_DEFAULT, 'cPath=' . $this->GetFullcPath($result['cID']), 'NONSSL', false);
				$location = tep_href_link(FILENAME_DEFAULT, 'cPath=' . $this->GetFullcPath($result['cID']), 'NONSSL', false); 

				$lastmod = $this->NotNull($result['last_mod']) ? $result['last_mod'] : $result['date_added'];

				$changefreq = GOOGLE_SITEMAP_CAT_CHANGE_FREQ;

				$priority = .5;



				$container[] = array('loc' => htmlspecialchars(utf8_encode($location)),

				                     'lastmod' => date ("Y-m-d", strtotime($lastmod)),

									 'changefreq' => $changefreq,

									 'priority' => $priority

				                     );

				if ( sizeof($container) >= 50000 ){

					$type = $number == 0 ? 'categories' : 'categories' . $number;

					$this->GenerateSitemap($container, $type);

					$container = array();

					$number++;

				}

			} # end while

			$this->DB->Free($categories_query);

			if ( sizeof($container) >= 1 ) {

				$type = $number == 0 ? 'categories' : 'categories' . $number;

				return $this->GenerateSitemap($container, $type);

			} # end if

		} else {

			$this->debug['QUERY']['CATEOGRY']['STATUS'] = 'false';

			$this->debug['QUERY']['CATEOGRY']['NUM_ROWS'] = '0';

		}

	} # end function



/**

 * Function to retrieve full cPath from category ID

 * @author Bobby Easland

 * @version 1.0

 * @param mixed $cID Could contain cPath or single category_id

 * @return string Full cPath string

 */

	function GetFullcPath($cID){

		if ( ereg('_', $cID) ){

			return $cID;

		} else {

			$c = array();

			$this->GetParentCategories($c, $cID);

			$c = array_reverse($c);

			$c[] = $cID;

			$cID = sizeof($c) > 1 ? implode('_', $c) : $cID;

			return $cID;

		}

	} # end function



/**

 * Recursion function to retrieve parent categories from category ID

 * @author Bobby Easland

 * @version 1.0

 * @param mixed $categories Passed by reference

 * @param integer $categories_id

 */

	function GetParentCategories(&$categories, $categories_id) {

		$sql = "SELECT parent_id

		        FROM " . TABLE_CATEGORIES . "

				WHERE categories_id='" . (int)$categories_id . "'";

		$parent_categories_query = $this->DB->Query($sql);

		while ($parent_categories = $this->DB->FetchArray($parent_categories_query)) {

			if ($parent_categories['parent_id'] == 0) return true;

			$categories[sizeof($categories)] = $parent_categories['parent_id'];

			if ($parent_categories['parent_id'] != $categories_id) {

				$this->GetParentCategories($categories, $parent_categories['parent_id']);

			}

		}

	} # end function



/**

 * Function to check if a value is NULL

 * @author Bobby Easland as abstracted from osCommerce-MS2.2

 * @version 1.0

 * @param mixed $value

 * @return boolean

 */

	function NotNull($value) {

		if (is_array($value)) {

			if (sizeof($value) > 0) {

				return true;

			} else {

				return false;

			}

		} else {

			if (($value != '') && (strtolower($value) != 'null') && (strlen(trim($value)) > 0)) {

				return true;

			} else {

				return false;

			}

		}

	} # end function



/**

 * Function to return href_link

 * @author Bobby Easland

 * @version 1.0

 * @param mixed $value

 * @return boolean

 */

	function hrefLink($page, $parameters, $connection, $add_session_id) {

			return $this->base_url . $page . '?' . $parameters;

	} # end function



/**

 * Utility function to read and return the contents of a GZ formatted file

 * @author Bobby Easland

 * @version 1.0

 * @param string $file File to open

 * @return string

 */

	function ReadGZ( $file ){

		$file = $this->savepath . $file;

		$lines = gzfile($file);

		return implode('', $lines);

	} # end function



/**

 * Utility function to generate the submit URL

 * @author Bobby Easland

 * @version 1.0

 * @return string

 */

	function GenerateSubmitURL(){

		$url = urlencode($this->base_url . 'sitemapindex.xml');

		return htmlspecialchars(utf8_encode('http://www.google.com/webmasters/sitemaps/ping?sitemap=' . $url));

	} # end function

} #  end class

?>
