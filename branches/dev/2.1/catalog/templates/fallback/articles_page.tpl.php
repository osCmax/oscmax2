<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<?php require(DIR_WS_INCLUDES . 'meta_tags.php'); ?>
<title><?php echo META_TAG_TITLE; ?></title>
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<meta name="description" content="<?php echo META_TAG_DESCRIPTION; ?>" />
<meta name="keywords" content="<?php echo META_TAG_KEYWORDS; ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','stylesheet.css')); // BTSv1.5 ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','stylesheet-new.css')); // BTSv1.5 ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','print.css')); // BTSv1.5 ?>" media="print">
<link rel="stylesheet" type="text/css" href="<?php echo DIR_WS_TEMPLATES; ?>coolmenu.css">
<?php if (isset($javascript) && file_exists(DIR_WS_JAVASCRIPT . basename($javascript))) { require(DIR_WS_JAVASCRIPT . basename($javascript)); } ?>
 <!-- coolMenu //-->
 <?php 
 if (DISPLAY_DHTML_MENU == 'CoolMenu') {
 	echo '<SCRIPT LANGUAGE="JavaScript1.2" SRC="includes/coolMenu.js"></SCRIPT>';
 }
 ?>
 <!-- coolMenu_eof //-->
<?php
	//// BEGIN:  Added for Dynamic MoPics v3.000
?>
<link rel="stylesheet" type="text/css" href="dynamic_mopics.css">
<script language="javascript" type="text/javascript"><!--
	function popupImage(url, imageHeight, imageWidth) {
		var newImageHeight = (parseInt(imageHeight) + 40);
		var yPos = ((screen.height / 2) - (parseInt(newImageHeight) / 2));
		var xPos = ((screen.width / 2) - (parseInt(imageWidth) / 2));
		
		imageWindow = window.open(url,'popupImages','toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=' + imageWidth + ',height=' + newImageHeight + ',screenY=' + yPos + ',screenX=' + xPos + ',top=' + yPos + ',left=' + xPos);

		imageWindow.moveTo(xPos, yPos);
		imageWindow.resizeTo(parseInt(imageWidth), parseInt(newImageHeight));
		
		if (window.focus) {
			imageWindow.focus();
		}
	}
//--></script>
<?php
	//// END:  Added for Dynamic MoPics v3.000
?>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
 <!-- coolMenu //-->
 <?php 
 if (DISPLAY_DHTML_MENU == 'CoolMenu') {
 	require(DIR_WS_INCLUDES . 'coolmenu.php'); 
 }
 ?>
 <!-- coolMenu_eof //-->
<!-- warnings //-->
<?php require(DIR_WS_INCLUDES . 'warnings.php'); ?>
<!-- warning_eof //-->
<?php
// include i.e. template switcher in every template
if(bts_select('common', 'common_top.php')) include (bts_select('common', 'common_top.php')); // BTSv1.5
?>
<!-- header //-->
<table width="100%" border="0" cellspacing="0" cellpadding="0">  
  <tr> 
     <div id="navcontainer"> 
        <ul id="navlist">
          <li id="active"><a href="#" id="current">Home</a> 
            <ul id="subnavlist">
              <li id="subactive"><a href="#" id="subcurrent">Quick Quote</a></li>
              <li><a href="#">Featured Products</a></li>
              <li><a href="#">Guestbook</a></li>
              <li><a href="#">Resources</a></li>
              <li><a href="#">Forum</a></li>
              <li><a href="#">Links</a></li>
            </ul>
          </li>
		  <li><a href="#">About Us</a></li>
          <li><a href="#">Why Buy From Us</a></li>
          <li><a href="#">Custom Yacht Project Division</a></li>
          <li><a href="#">Special Orders</a></li>
          <li><a href="#">Contact Us</a></li>
        </ul>
      </div>
      </tr>
    </table>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr> 
          <td width="64%"><img src="images/Logo2.png" width="525" height="87"></td>
          <td width="36%"><?php echo '<form name="login" method="post" action="' . tep_href_link(FILENAME_LOGIN, 'action=process', 'SSL') . '">' ?>
              <table width="100%" border="0" cellspacing="2" cellpadding="1">
                <tr> 
                  <td class="formAreaTitle" colspan="2"><div align="center"><span>Client Login </span></div></td>
                </tr>
                <tr> 
                  <td class="headerBoxText" width="50%"> <div align="right">EMAIL ADDRESS:</div></td>
                  <td width="50%"><input name="email_address" type="text" value="Enter your Email here" size="35" maxlength="225"></td>
                </tr>
                <tr> 
                  <td class="headerBoxText" width="50%"> <div align="right">PASSWORD:</div></td>
                  <td width="50%"><input name="password" type="password" size="35" maxlength="35"></td>
                </tr>
                <tr> 
                  <td width="50%">&nbsp;</td>
                  <td width="50%"><?php echo tep_image_submit('button_login.gif', IMAGE_BUTTON_LOGIN, 'SSL') ?></td>
                </tr>
              </table>
            </form></td>
        </tr>
      </table>
  <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center">
    <td valign="top" class="formAreaTitle"> 
        <form name="quick_find" method="get" action="advanced_search_result.php">
          <div align="center"><span class="formAreaTitle">Search all our Products: 
            </span> 
            <input type="text" name="keywords" size="10" maxlength="30" value="" style="width: 115px">
            <input type="hidden" name="search_in_description" value="1">
            <span class="formAreaTitle"> 
            <input type="submit" value="go">
            <a href="advanced_search.php">or Click 
            here for an Advanced Search</a></span><br>
          </div>
        </form>
  </table>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr class="headerNavigation">
    <td class="headerNavigation">&nbsp;&nbsp;<?php echo $breadcrumb->trail(' &raquo; '); ?></td>
    <td align="right" class="headerNavigation"><?php if (tep_session_is_registered('customer_id')) { ?><a href="<?php echo tep_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_LOGOFF; ?></a> &nbsp;|&nbsp; <?php } ?><a href="<?php echo tep_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_MY_ACCOUNT; ?></a> &nbsp;|&nbsp; <a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>" class="headerNavigation"><?php echo HEADER_TITLE_CART_CONTENTS; ?></a> &nbsp;|&nbsp; <a href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_CHECKOUT; ?></a> &nbsp;&nbsp;</td>
  </tr>  
</table>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- left_navigation //-->
<?php require(bts_select('column', 'column_left.php')); // BTSv1.5 ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- content //-->
    <td width="100%" valign="top">
<?php
     require (bts_select ('content')); // BTSv1.5 
?>
    </td>
<!-- content_eof //-->
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<!-- right_navigation //-->
<?php require(bts_select('column', 'column_right.php')); // BTSv1.5 ?>
<!-- right_navigation_eof //-->
    </table></td>
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'counter.php'); ?>
<table border="0" width="100%" cellspacing="0" cellpadding="1">
  <tr class="footer">
    <td class="footer">&nbsp;&nbsp;<?php echo strftime(DATE_FORMAT_LONG); ?>&nbsp;&nbsp;</td>
    <td align="right" class="footer">&nbsp;&nbsp;<?php echo $counter_now . ' ' . FOOTER_TEXT_REQUESTS_SINCE . ' ' . $counter_startdate_formatted; ?>&nbsp;&nbsp;</td>
  </tr>
</table>
<br>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center" class="smallText">
<?php
/*
  The following copyright announcement can only be
  appropriately modified or removed if the layout of
  the site theme has been modified to distinguish
  itself from the default osCommerce-copyrighted
  theme.

  For more information please read the following
  Frequently Asked Questions entry on the osCommerce
  support site:

  http://www.oscmax.com/community.php/faq,26/q,50

  Please leave this comment intact together with the
  following copyright announcement.
*/

  echo FOOTER_TEXT_BODY
?>
    </td>
  </tr>
</table>
<?php
  if ($banner = tep_banner_exists('dynamic', '468x50')) {
?>
<br>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><?php echo tep_display_banner('static', $banner); ?></td>
  </tr>
</table>
<?php
  }
?>
<!-- footer_eof //-->
<br>
</body>
</html>
