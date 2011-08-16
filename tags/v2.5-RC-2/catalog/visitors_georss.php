<?php
/*
Written by Marc-Andre Caron on Aug 5 2009
http://www.ipinfodb.com
Licenced under GPL
*/

include('includes/application_top.php');

/////////////////////////////CONFIGURATION/////////////////////////////
//Server info
define('FLAGSDIR', 'images/flags/');
define('HTTPSERVER', HTTP_SERVER . '/');
define('WEBSITE', HTTP_SERVER . DIR_WS_HTTP_CATALOG);

//Flag image filename
function FlagImage($country_code){

	$image = strtolower($country_code) . ".gif";
	if (file_exists("./" . FLAGSDIR . $image)){
		$flag_link = "&lt;img src=&quot;". HTTPSERVER . FLAGSDIR . $image . "&quot; /&gt;";
	}else{
		$flag_link = false;
	}
	
	return $flag_link;
}

//Get listeners info

$ip_query = tep_db_query("SELECT * FROM `" . TABLE_WHOS_ONLINE . "` WHERE `latitude` != '' AND `longitude` != ''");

header('Content-type: text/xml');
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
echo "<rss version=\"2.0\" xmlns:geo=\"http://www.w3.org/2003/01/geo/wgs84_pos#\">\n";
echo "<channel>\n";

$i = 0;
$g = 0;
$b = 0;
while ($data = mysql_fetch_array($ip_query)){
	$i++;
	$latitude = $data['latitude'];
	$longitude = $data['longitude'];
	$country_code = $data['country_code'];
	$country_name = $data['country_name'];
	$region_name = $data['region_name'];
	//The accented letters in greek city names are garbled.
	//$city = $data['city'];
	$city = iconv("UTF-8", "ISO-8859-1", $data['city']);
	$active_since = round((time() - $data['time_entry'])/60);
	$flag = FlagImage($country_code);
	$br = "&lt;br /&gt;";
	$customer_id = $data['customer_id'];
	$full_name = $data['full_name'];
	$html = utf8_encode("Country : $country_name $flag $br Region : $region_name $br City : $city");
	if ($full_name == 'Guest'){
		$g++;
		$name = 'Guest #' . $g;
	} else {
		if ($customer_id > 0){
			$name = $full_name;
		} else {
			$b++;
			$name = "Bot #" . $b;
		}
	}

	echo "  <item>\n";
	echo "    <title>$name</title>\n";
	echo "    <link>" . WEBSITE . "</link>\n";
	echo "    <description>$html</description>\n";
	echo "    <geo:lat>$latitude</geo:lat>\n";
	echo "    <geo:long>$longitude</geo:long>\n";
	echo "  </item>\n";
}

echo "</channel>\n";
echo "</rss>";
?>