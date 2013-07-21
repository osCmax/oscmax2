<?php
/*
  $Id: USPS_methods_utility.php ver 1.0 by Kevin L. Shelton 2011-08-20
  
  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
if (PHP_VERSION >= '5.0.0') { // PHP 5 does not need to use call-time pass by reference
  require_once ('includes/classes/xml_5.php');
} else {
  require_once ('includes/classes/xml.php');
}
if ( !function_exists('htmlspecialchars_decode') ) {
  function htmlspecialchars_decode($text) {
    return strtr($text, array_flip(get_html_translation_table(HTML_SPECIALCHARS)));
  }
}
  $action = (isset($HTTP_GET_VARS['action']) ? $HTTP_GET_VARS['action'] : '');
  $id = (isset($HTTP_POST_VARS['id']) ? tep_db_prepare_input($HTTP_POST_VARS['id']) : '');
  if (defined('MODULE_SHIPPING_USPS_USERID') && (MODULE_SHIPPING_USPS_USERID != 'NONE')) {
    $action = 'process';
    $id = MODULE_SHIPPING_USPS_USERID;
  }

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/javascript/jquery-ui-1.8.9.custom.css">
<script type="text/javascript" src="includes/general.js"></script>
</head>
<body onLoad="SetFocus();">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading">Utility to get all USPS shipping methods</td>
            <td class="pageHeading" align="right"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td>
      <?php if ($action != 'process') {
      echo tep_draw_form('id_entry', 'USPS_methods_utility.php', 'action=process', 'post');
      echo '<p>Enter the USPS USERID assigned to you. You must contact USPS to have them switch you to the Production server. Otherwise this module will not work! ' . tep_draw_input_field('id') . "</p>\n";
      echo tep_image_submit('button_save.gif', IMAGE_SAVE) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_DEFAULT, 'eid=' . $eid) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . "</a>\n";
      ?>
      </form></td></tr>
<?php } else { // get USPS method values
?>
      <tr>
        <td>Copy the following four statements and paste them into function usps in the catalog/includes/modules/shipping/usps.php file overwriting the existing statements that set these variables. Remove the USPS module in admin and then reinstall it in order to make use of the new methods.</td>
      </tr>
      <tr>
        <td class="main"><p></p><p></p>
<?php
// domestic
$request  = '<RateV4Request USERID="' . $id . '"><Revision>2</Revision><Package ID="1st"><Service>ONLINE</Service><ZipOrigination>95993</ZipOrigination><ZipDestination>95993</ZipDestination><Pounds>0</Pounds><Ounces>1</Ounces><Container/><Size>REGULAR</Size><Machinable>true</Machinable></Package></RateV4Request>';
$request = 	'API=RateV4&XML=' . urlencode($request);
$usps_server = 'production.shippingapis.com';
$api_dll = 'ShippingApi.dll';
$body = '';
if (!class_exists('httpClient')) {
	include(DIR_FS_CATALOG . 'includes/classes/http_client.php');
}
$http = new httpClient();
if ($http->Connect($usps_server, 80)) {
  $http->addHeader('Host', $usps_server);
	$http->addHeader('User-Agent', 'osCommerce');
	$http->addHeader('Connection', 'Close');
	if ($http->Get('/' . $api_dll . '?' . $request)) $body = $http->getBody();
  $http->Disconnect();
} else {
  $body = '<error>Connection Failed</error>';
}
$doc = XML_unserialize($body);
$usps_dmstc_types = array();
if (is_array($doc['RateV4Response']['Package']['Postage'])) {
  foreach($doc['RateV4Response']['Package']['Postage'] as $key => $value) {
    if ((strpos($key, 'attr') === false) && (strpos($value['MailService'], 'Postcard') === false)) { // not class id attribute for postage or Postcard mail type
      $usps_dmstc_types[$key]['name'] = htmlspecialchars_decode($value['MailService']);
    }
  }
}
$dmtsc_types = array();
foreach ($usps_dmstc_types as $type) {
  $dmtsc_types[str_replace(array('<sup>', '</sup>', '&reg;', '&trade;'), '', $type['name'])] = $type['name'];
}
echo "&nbsp;&nbsp;&nbsp;&nbsp;\$this->types = array(<br>\n";
$statement = array();
foreach($dmtsc_types as $key => $value) {
 $statement[] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'" . htmlspecialchars($key . "' => '" . $value . "'");
}
echo implode(",<br>\n", $statement);
echo "<br>\n&nbsp;&nbsp;&nbsp;&nbsp;);<br>\n";
echo "&nbsp;&nbsp;&nbsp;&nbsp;\$this->type_to_request = array(<br>\n";
$statement = array();
foreach($dmtsc_types as $key => $value) {
 $request = '';
 if (strpos($key, 'Express') === 0) {
   if (strpos($key, 'Sunday') !== false) {
     $request = 'Express SH Commercial';
   } elseif (strpos($key, 'Hold') !== false) {
     $request = 'Express HFP Commercial';
   } else {
     $request = 'Express Commercial';
   }
 }
 if (strpos($key, 'Priority') === 0) {
   if (strpos($key, 'Hold') !== false) {
     $request = 'Priority HFP Commercial';
   } else {
     $request = 'Priority Commercial';
   }
 }
 if (strpos($key, 'First') === 0) {
   if (strpos($key, 'Hold') !== false) {
     $request = 'First Class HFP Commercial';
   } elseif (strpos($key, 'Package') !== false) {
     $request = 'First Class Commercial';
   } else {
     $request = 'First-Class Mail';
   }
 }
 if (strpos($key, 'Standard') === 0) {
   $request = 'Parcel Post';
 }
 if (strpos($key, 'Media') === 0) {
   $request = 'Media';
 }
 if (strpos($key, 'Library') === 0) {
   $request = 'Library';
 }
 $statement[] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'" . $key . "' => '" . $request . "'";
}
echo implode(",<br>\n", $statement);
echo "<br>\n&nbsp;&nbsp;&nbsp;&nbsp;);<br>\n";
echo "&nbsp;&nbsp;&nbsp;&nbsp;\$this->type_to_container = array(<br>\n";
$statement = array();
foreach($dmtsc_types as $key => $value) {
 $container = '';
 if (strpos($key, 'Express') === 0) {
   if (strpos($key, 'Sunday') !== false) {
     $container = (string)substr($key, 36);
   } elseif (strpos($key, 'Hold') !== false) {
     $container = (string)substr($key, 12, strlen($key) - 28);
   } else {
     $container = (string)substr($key, 12);
   }
 }
 if (strpos($key, 'Priority') === 0) {
   if (strpos($key, 'Hold') !== false) {
     $container = (string)substr($key, 13, strlen($key) - 29);
   } else {
     $container = (string)substr($key, 13);
   }
 }
 $container = str_replace(array('Small', 'Medium', 'Large'), array('SM', 'MD', 'LG'), trim($container));
 $statement[] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'" . $key . "' => '" . $container . "'";
}
echo implode(",<br>\n", $statement);
echo "<br>\n&nbsp;&nbsp;&nbsp;&nbsp;);<br>\n";

// international
$intl_types = array();
$x = array(array('l' => 16, 'w' => 12, 'h' => 3, 'g' => 20, 'c' => 'NONRECTANGULAR', 'p' => 10, 'o' => 10), array('l' => 5, 'w' => 3, 'h' => 0.1, 'g' => 6.2, 'c' => 'RECTANGULAR', 'p' => 0, 'o' => 1));
foreach ($x as $d) { // international requires two requests to get all types
  $request  = '<IntlRateV2Request USERID="' . $id . '"><Revision>2</Revision><Package ID="1st"><Pounds>' . $d['p'] . '</Pounds><Ounces>' . $d['o'] . '</Ounces><Machinable>true</Machinable><MailType>All</MailType><GXG><POBoxFlag>N</POBoxFlag><GiftFlag>N</GiftFlag></GXG><ValueOfContents>0</ValueOfContents><Country>Canada</Country><Container>' . $d['c'] . '</Container><Size>' . ((max($d['w'], $d['l'], $d['h']) > 12) ? 'LARGE' : 'REGULAR') . '</Size><Width>' . $d['w'] . '</Width><Length>' . $d['l'] . '</Length><Height>' . $d['h'] . '</Height><Girth>' . $d['g'] . '</Girth></Package></IntlRateV2Request>';
  $request = 	'API=IntlRateV2&XML=' . urlencode($request);
  $usps_server = 'production.shippingapis.com';
  $api_dll = 'shippingAPI.dll';
  $body = '';
  if (!class_exists('httpClient')) {
  	include(DIR_FS_CATALOG . 'includes/classes/http_client.php');
  }
  $http = new httpClient();
  if ($http->Connect($usps_server, 80)) {
    $http->addHeader('Host', $usps_server);
  	$http->addHeader('User-Agent', 'osCommerce');
  	$http->addHeader('Connection', 'Close');
  	if ($http->Get('/' . $api_dll . '?' . $request)) $body = $http->getBody();
    $http->Disconnect();
  } else {
    $body = '<error>Connection Failed</error>';
  }
  $doc = XML_unserialize ($body);
  $usps_intl_types = array();
  if (isset($doc['IntlRateV2Response']['Package']['Service'])) {
    foreach($doc['IntlRateV2Response']['Package']['Service'] as $key => $method) {
      if (isset($method['SvcDescription'])) {
        $usps_intl_types[$key]['name'] = htmlspecialchars_decode($method['SvcDescription']);
      }
    }
  }
  foreach ($usps_intl_types as $type) {
    if (!in_array($type['name'], $intl_types)) {
      $intl_types[str_replace(array('<sup>' , '&reg;', '</sup>', '&trade;'), '', $type['name'])] = $type['name'];
    }
  }
}
echo "&nbsp;&nbsp;&nbsp;&nbsp;\$this->intl_types = array(<br>\n";
$statement = array();
foreach($intl_types as $key => $value) {
 $statement[] = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'" . htmlspecialchars($key . "' => '" . $value . "'");
}
echo implode(",<br>\n", $statement);
echo "<br>\n&nbsp;&nbsp;&nbsp;&nbsp;);<br>\n";
?>
            </td>
          </tr>
        </table></td>
      </tr>
      <?php } ?>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
