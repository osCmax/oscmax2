<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS;
  // BOF Separate Pricing Per Customer
    if(!tep_session_is_registered('sppc_customer_group_id')) {
    $customer_group_id = '0';
    } else {
     $customer_group_id = $sppc_customer_group_id;
    }
  // EOF Separate Pricing Per Customer
?>>

<head>


<?php require(DIR_WS_INCLUDES . 'meta_tags.php'); ?>
<title><?php echo META_TAG_TITLE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<meta name="keywords" content="<?php echo META_TAG_KEYWORDS; ?>">
<meta name="description" content="<?php echo META_TAG_DESCRIPTION; ?>">
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','dynamic_mopics.css')); // BTSv1.5 ?>">
   <?php if (bts_select('stylesheets', $PHP_SELF)) { // if a specific stylesheet exists for this page it will be loaded ?>
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheets', $PHP_SELF)); // BTSv1.5 ?>">

<?php
} else { ?> 
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','stylesheet.css')); // BTSv1.5 ?>">
<?php  } ?> 
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','stylesheet-new.css')); // BTSv1.5 ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','print.css')); // BTSv1.5 ?>" media="print">
<link rel="stylesheet" type="text/css" href="<?php echo DIR_WS_TEMPLATES; ?>coolmenu.css">
   <?php if (bts_select('javascript', $PHP_SELF)) { // if a specific javscript file exists for this page it will be loaded
      require(bts_select('javascript', $PHP_SELF));
} else {
  if (isset($javascript) && file_exists(DIR_WS_JAVASCRIPT . basename($javascript))) { require(DIR_WS_JAVASCRIPT . basename($javascript)); }

  } 
?> 
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
<script language="javascript" type="text/javascript"><!--
	function popupImage(url, imageHeight, imageWidth) {
		var newImageHeight = (parseInt(imageHeight) + 20);
		var yPos = ((screen.height / 2) - (parseInt(newImageHeight) / 2));
		var xPos = ((screen.width / 2) - (parseInt(imageWidth) / 2));

		imageWindow = window.open(url,'popupImages','toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=no,resizable=no,copyhistory=no,width=' + imageWidth + ',height=' + newImageHeight + ',screenY=' + yPos + ',screenX=' + xPos + ',top=' + yPos + ',left=' + xPos);

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

<!-- BOF SLIMBOX2 -->
<link rel="stylesheet" href="slimbox2/slimbox2.css" type="text/css" media="screen" />
<script type="text/javascript" src="slimbox2/jquery.js"></script>
<script type="text/javascript" src="slimbox2/slimbox2.js"></script>
<?php require('slimbox2/sbcustom.php'); ?>
<!-- EOF SLIMBOX2 -->

</head>
<body>
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
// BOF Added: Down for Maintenance Hide header if not to show
if (DOWN_FOR_MAINTENANCE == 'false' or DOWN_FOR_MAINTENANCE_HEADER_OFF =='false') {
?>
<!-- header //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr class="header">
    <td valign="middle"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(bts_select('images','store_logo.gif'), STORE_NAME) . '</a>'; ?></td>
    <td align="right" valign="bottom">
    <?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image(bts_select('images','header_account.gif'), HEADER_TITLE_MY_ACCOUNT) . '</a>&nbsp;&nbsp;
    <a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(bts_select('images','header_cart.gif'), HEADER_TITLE_CART_CONTENTS) . '</a>&nbsp;&nbsp;
    <a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . tep_image(bts_select('images','header_checkout.gif'), HEADER_TITLE_CHECKOUT) . '</a>'; ?>&nbsp;&nbsp;
    </td>
  </tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="1">
  <tr class="headerNavigation">
    <td class="headerNavigation">&nbsp;&nbsp;<?php echo $breadcrumb->trail(' &raquo; '); ?></td>
    <td align="right" class="headerNavigation">&nbsp;|&nbsp;
      <?php if ((tep_session_is_registered('customer_id')) && (!tep_session_is_registered('noaccount'))) // DDB - PWA - 040622 - no display of logoff for PWA customers
	  { ?>
      	<a href="<?php echo tep_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_LOGOFF; ?>
      </a> &nbsp;|&nbsp;
      <?php } ?>

      <?php if (!tep_session_is_registered('noaccount')) // DDB - PWA - 040622 - no display of account for PWA customers
	  { ?>
      	<a href="<?php echo tep_href_link(FILENAME_ACCOUNT, 'my_account_f=1', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_MY_ACCOUNT; ?>						</a> &nbsp;|&nbsp;
	  <?php } ?>

		<a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>" class="headerNavigation"><?php echo HEADER_TITLE_CART_CONTENTS; ?></a>
      &nbsp;|&nbsp; <a href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_CHECKOUT; ?>&nbsp;|&nbsp;</a><a href="<?php echo tep_href_link(FILENAME_WISHLIST, '', 'SSL'); ?>" class="headerNavigation"><?php echo BOX_HEADING_CUSTOMER_WISHLIST; ?></a>&nbsp;</td>
  </tr>
</table>
<!-- header_eof //-->
<?php
}
?>
<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<?php
// Hide Left Column if not to show
if (DOWN_FOR_MAINTENANCE == 'false' or DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF =='false') {
?>
<!-- left_navigation //-->
<?php require(bts_select('column', 'column_left.php')); // BTSv1.5 ?>
<!-- left_navigation_eof //-->
<?php
}
?>
    </table></td>
<!-- content //-->
    <td width="100%" valign="top"><?php
     require (bts_select ('content')); // BTSv1.5
  ?></td>
<!-- content_eof //-->
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="0" cellpadding="2">
<?php
// Hide column_left.php if not to show
if (DOWN_FOR_MAINTENANCE == 'false' or DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF =='false') {
?>								
<!-- right_navigation //-->
  <?php require(bts_select('column', 'column_right.php')); // BTSv1.5 ?>
<!-- right_navigation_eof //-->
<?php
}
?>  		 
    </table></td>
  </tr>
</table>
<!-- body_eof //-->

<?php
// BOF Added: Down for Maintenance Hide footer.php if not to show
if (DOWN_FOR_MAINTENANCE == 'false' or DOWN_FOR_MAINTENANCE_FOOTER_OFF =='false') {
?>
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
     <br>
<?php
/*
  The following copyright announcement can only be
  appropriately modified or removed if the layout of
  the site theme has been modified to distinguish
  itself from the default osCommerce-copyrighted
  theme or the default osCMax copyrighted theme.

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
<?php
}
?>
</body>
</html>
