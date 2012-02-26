<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  // +Country-State Selector
  require(DIR_WS_FUNCTIONS . 'ajax.php');
if (isset($_POST['action']) && $_POST['action'] == 'getStates' && isset($_POST['country'])) {
	ajax_get_zones_html(tep_db_prepare_input($_POST['country']), true);
} else {
  // -Country-State Selector

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CREATE_ACCOUNT);

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
  <title><?php echo TITLE ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/javascript/jquery-ui-1.8.2.custom.css">
<?php require('includes/form_check.js.php'); ?>
<script language="javascript" type="text/javascript"><!--
function getObject(name) { 
   var ns4 = (document.layers) ? true : false; 
   var w3c = (document.getElementById) ? true : false; 
   var ie4 = (document.all) ? true : false; 

   if (ns4) return eval('document.' + name); 
   if (w3c) return document.getElementById(name); 
   if (ie4) return eval('document.all.' + name); 
   return false; 
}

//Gets the browser specific XmlHttpRequest Object
function getXmlHttpRequestObject() {
	if (window.XMLHttpRequest) {
		return new XMLHttpRequest();
	} else if(window.ActiveXObject) {
		return new ActiveXObject("Microsoft.XMLHTTP");
	} else {
		alert("Your browser does not support this feature.  Please upgrade or use a different browser. Older (pre-v2.8) versions of Order Editor do not have this restriction.");
	}
}

//Our XmlHttpRequest object to get the auto suggest
var request = getXmlHttpRequestObject();
/***************************************************
 GET STATES FUNCTIONS 
 ***************************************************/
function getStates(countryID, div_element) {
	if (request.readyState == 4 || request.readyState == 0) {
		// indicator make visible here..
		getObject("indicator").style.visibility = 'visible';
		var contentType = "application/x-www-form-urlencoded; charset=UTF-8";
		var fields = "action=getStates&country="+countryID;
					
		request.open("POST", 'create_account.php', true);
		//request.onreadystatechange = getStatesRequest;
		request.onreadystatechange = function() {
			getStatesRequest(request, div_element);
		};
		
		request.setRequestHeader("Content-Type", contentType);		
		request.send(fields);
	}
}										
//Called when the AJAX response is returned.
function getStatesRequest(request, div_element) {
	if (request.readyState == 4) {
		var obj_div = getObject(div_element);
		// make hidden
		getObject('indicator').style.visibility = 'hidden';
	  obj_div.innerHTML = request.responseText;
		
		for (i=0; i<obj_div.childNodes.length; i++){
			if (obj_div.childNodes[i].nodeName=="SELECT")
				obj_div.childNodes[i].focus();
		}
	}
}
//--></script>
</head>
<body>
<!-- header //-->
<?php
  require(DIR_WS_INCLUDES . 'header.php');
?>
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
    <td width="75%" valign="top"><form name="account_edit" method="post" <?php echo 'action="' . tep_href_link(FILENAME_CREATE_ACCOUNT_PROCESS, '', 'SSL') . '"'; ?> onSubmit="return check_form();"><input type="hidden" name="action" value="process"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            </tr>
          </table>
        </td>
      </tr>

      <?php if ( (isset($_GET['account'])) && ($_GET['account'] == 'success') ) { ?>     
      <tr>
        <td class="messageStackSuccess"><?php echo TEXT_ACCOUNT_CREATED; ?></td>
      </tr>
      <?php } ?>

<?php
  if (sizeof($navigation->snapshot) > 0) {
?>
      <tr>
        <td class="smallText"><br><?php echo sprintf(TEXT_ORIGIN_LOGIN, tep_href_link(FILENAME_LOGIN, tep_get_all_get_params(), 'SSL')); ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td>
<?php
  //$email_address = tep_db_prepare_input($_GET['email_address']);
   // +Country-State Selector 
if (!isset($country)){$country = DEFAULT_COUNTRY;}
// -Country-State Selector

  $account['entry_country_id'] = STORE_COUNTRY;
  $account['entry_zone_id'] = STORE_ZONE;

  require(DIR_WS_MODULES . 'account_details.php');
?>
        </td>
      </tr>
      <tr>
        <td align="right" class="main"><br><?php echo tep_image_submit('button_create_order.gif', IMAGE_BUTTON_CREATE); ?></td>
      </tr>
    </table></form></td>
<!-- body_text_eof //-->
    <td width="25%" valign="top">
      <table border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td>&nbsp;</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php
    require(DIR_WS_INCLUDES . 'footer.php');
?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php
// +Country-State Selector 
}
// -Country-State Selector 
   require(DIR_WS_INCLUDES . 'application_bottom.php');
?>