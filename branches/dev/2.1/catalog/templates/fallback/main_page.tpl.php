<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
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
  
  if (DISPLAY_SLIDESHOW == true) {
	echo '<script src="http://www.google.com/jsapi"></script>';
    echo '<script>' . "\n";
	echo '// Load jQuery' . "\n";
    echo 'google.load("jquery", "1.4.0");' . "\n";
    echo '</script>' . "\n"; 
 	echo '<script type="text/javascript" src="' . DIR_WS_JAVASCRIPT . 'showcase.2.0.js"></script>';
	require (DIR_WS_JAVASCRIPT . 'slideshow_init.js.php');
  }
  
  if (DISPLAY_DHTML_MENU == 'CoolMenu') {
    echo '<!-- coolMenu //-->';
 	echo '<SCRIPT LANGUAGE="JavaScript1.2" SRC="includes/coolMenu.js"></SCRIPT>';
	echo '<!-- coolMenu_eof //-->';
 }

if ( defined('FWR_SUCKERTREE_MENU_ON') && FWR_SUCKERTREE_MENU_ON === 'true' )
echo '<link rel="stylesheet" type="text/css" href="' . (bts_select('stylesheet', 'fwr_suckertree_css_menu.css')) . '" />';
?>
</head>
<body>

 <?php
 if (DISPLAY_DHTML_MENU == 'CoolMenu') {
    echo '<!-- coolMenu //-->';
 	require(DIR_WS_INCLUDES . 'coolmenu.php');
	echo '<!-- coolMenu_eof //-->';
 }
 ?>
<!-- warnings //-->
<?php require(DIR_WS_INCLUDES . 'warnings.php'); ?>
<!-- warning_eof //-->


<?php
// include i.e. template switcher in every template
if(bts_select('common', 'common_top.php')) include (bts_select('common', 'common_top.php')); // BTSv1.5
// BOF Added: Down for Maintenance Hide header if not to show
if (DOWN_FOR_MAINTENANCE == 'false' or DOWN_FOR_MAINTENANCE_HEADER_OFF =='false') {
?>

<!-- Store width controller -->
<table width="<?php echo STORE_WIDTH; ?>" cellspacing="0" cellpadding="0" align="<?php echo STORE_ALIGN; ?>">
<tr><td>

<!-- header //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr class="header">
    <td valign="middle"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo.gif', STORE_NAME) . '</a>'; ?></td>
    <td align="right" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image(DIR_WS_ICONS . 'account.png', HEADER_TITLE_MY_ACCOUNT) . '</a>&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_ICONS . 'contents.png', HEADER_TITLE_CART_CONTENTS) . '</a>&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . tep_image(DIR_WS_ICONS . 'checkout.png', HEADER_TITLE_CHECKOUT) . '</a>&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_WISHLIST, '', 'SSL') . '">' . tep_image(DIR_WS_ICONS . 'wishlist.png', HEADER_TITLE_WISHLIST) . '</a>'; ?>&nbsp;&nbsp;</td>
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
      &nbsp;|&nbsp; <a href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_CHECKOUT; ?></a>&nbsp;|&nbsp;<a href="<?php echo tep_href_link(FILENAME_WISHLIST, '', 'SSL'); ?>" class="headerNavigation"><?php echo BOX_HEADING_CUSTOMER_WISHLIST; ?></a>&nbsp;</td>
  </tr>
</table>
<!-- header_eof //-->
<?php
}
?>
<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
<?php // Show/Hide Left Column
if (LEFT_COLUMN_SHOW != 'false') { ?>
    <td width="<?php echo BOX_WIDTH_LEFT; ?>" valign="top">
      <table border="0" width="<?php echo BOX_WIDTH_LEFT; ?>" cellspacing="0" cellpadding="2">
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
      </table>
    </td>
<?php
} // end Show/Hide Left Column
?>
<!-- content //-->
    <td width="100%" valign="top">
	  <?php
        require (bts_select ('content')); // BTSv1.5
  	  ?>
    </td>
<!-- content_eof //-->
<?php // Show/Hide Right Column
if (RIGHT_COLUMN_SHOW != 'false') { ?>
    <td width="<?php echo BOX_WIDTH_RIGHT; ?>" valign="top">
      <table border="0" width="<?php echo BOX_WIDTH_RIGHT; ?>" cellspacing="0" cellpadding="2">
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
      </table>
    </td>
<?php
} // end Show/Hide Right Column
?>
  </tr>
<!-- body_eof //-->

<!-- footer //-->
<?php
// BOF Added: Down for Maintenance Hide footer.php if not to show
if (DOWN_FOR_MAINTENANCE == 'false' or DOWN_FOR_MAINTENANCE_FOOTER_OFF =='false') {
?>
  <tr>
    <td colspan="3">
      <!-- Page Module Controller -->
        <?php include (DIR_WS_MODULES . FILENAME_COMMON_PAGE_MODULES); ?>
      <!-- Page Module Controller -->
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

<?php if (GOOGLE_ANALYTICS_STATUS == 'true') { ?>	
<!-- BOF: Google Analytics Code -->
	<script type="text/javascript">
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
	</script>
    
	<script type="text/javascript">
		var pageTracker = _gat._getTracker("<?php echo (GOOGLE_UA_CODE); ?>");
		pageTracker._initData();
		<?php if (GOOGLE_SUBDOMAIN != 'none') {
		echo 'pageTracker._setDomainName("'  . GOOGLE_SUBDOMAIN .'");';
		} ?>
		
		pageTracker._trackPageview();
	</script>
<!-- EOF: Google Analytics Code -->
<?php } ?>

</td></tr>
</table>
<!-- Store width controller -->
</body>
</html>