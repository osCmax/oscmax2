<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
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

<?php require(DIR_WS_INCLUDES . 'meta_tags.php'); 

//Page Name variable - places current php file name into a variable
  $page =  $_SERVER["SCRIPT_NAME"];
  $break = Explode('/', $page);
  $pfile = $break[count($break) - 1];
  //echo $pfile; //debug code - displays current page name. 

// BOF: Remove & Prevent duplicate content with the canonical tag V1.3.2
CanonicalLink( $xhtml = false, 'SSL' ); 
// EOF: Remove & Prevent duplicate content with the canonical tag V1.3.2
?>
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
<?php  } 

if ( defined('FWR_SUCKERTREE_MENU_ON') && FWR_SUCKERTREE_MENU_ON === 'true' )
echo '<link rel="stylesheet" type="text/css" href="' . (bts_select('stylesheet', 'fwr_suckertree_css_menu.css')) . '">';

// Below is a work around to allow conditional css when javascript is disabled for product tabs.
?>
<link id="noscriptStyle" rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','no_javascript.css')); ?>">
<script type="text/javascript">document.getElementById('noscriptStyle').parentNode.removeChild(document.getElementById('noscriptStyle'));</script>

<?php if (GOOGLE_ANALYTICS_STATUS == 'true') { ?>
<!-- BOF: Google Analytics Code -->
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', '<?php echo (GOOGLE_UA_CODE); ?>']);
  _gaq.push(['_trackPageview']);
<?php
if (GOOGLE_SUBDOMAIN != 'none') {
echo '_gaq.push([\'_setDomainName\', \'' . GOOGLE_SUBDOMAIN . '\']);';
}
if ($pfile == 'checkout_success.php') {
include(DIR_WS_MODULES . 'analytics.php');
}
?>

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
<!-- EOF: Google Analytics Code -->
<?php } ?>
</head>
<body>

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
    <td valign="middle"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_TEMPLATES . 'images/' . STORE_LOGO, STORE_NAME) . '</a>'; ?></td>
    <td align="right" valign="bottom">
    
    <div id="header">
      <ul>
        <?php if ((tep_session_is_registered('customer_id')) && (!tep_session_is_registered('noaccount'))) { ?>
        <li><a href="<?php echo tep_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGOFF; ?></a></li>
        <?php } ?>
        <?php echo '<li><a href="' . tep_href_link(FILENAME_CONTACT_US) . '">' . HEADER_TITLE_CONTACT_US . '</a></li>' . 
	               '<li><a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . HEADER_TITLE_MY_ACCOUNT . '</a></li>' .
			       '<li><a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">';
        if (BASKET_CART =='cart') {
		      echo HEADER_TITLE_CART_CONTENTS; } else {  echo HEADER_TITLE_BASKET_CONTENTS; } ?>
	    <?php echo '</a></li><li><a href="' . tep_href_link(FILENAME_WISHLIST, '', 'SSL') . '">' . HEADER_TITLE_WISHLIST . '</a></li>'; ?>
        <?php
	    if ($cart->count_contents() > 0) {
	          echo '<li><a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . HEADER_TITLE_CHECKOUT . '</a></li>'; ?>
        <?php } ?>
      </ul>
    </div>
    </td>
    <td>&nbsp;</td>
  </tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr class="headerNavigation">
    <td class="breadcrumb_left" width="5"><?php echo tep_draw_separator('pixel_trans.gif', '1', '24'); ?></td>
    <td class="breadcrumb">&nbsp;&nbsp;<?php echo $breadcrumb->trail(' &raquo; '); ?></td>
    <td class="breadcrumb_right" width="5">&nbsp;</td>
  </tr>
</table>
<!-- header_eof //-->
<?php
}
?>
<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
<?php
// Hide Left Column if not to show
// BOF One Page Checkout custom column code
if (DOWN_FOR_MAINTENANCE == 'false' or DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF =='false') {
  if (LEFT_COLUMN_SHOW != 'false' and $pfile != 'checkout.php') { ?>
    <td width="<?php echo BOX_WIDTH_LEFT; ?>" valign="top">
	  <table border="0" width="<?php echo BOX_WIDTH_LEFT; ?>" cellspacing="0" cellpadding="2">
        <tr>   
		  <td class="leftcol" width="<?php echo BOX_WIDTH_LEFT; ?>" valign="top">
            <table border="0" width="<?php echo BOX_WIDTH_LEFT; ?>" cellspacing="0" cellpadding="2">
		      <!-- left_navigation //-->
		      <?php require(bts_select('column', 'column_left.php')); // BTSv1.5 ?>
		      <!-- left_navigation_eof //-->
		    </table>
          </td>
        </tr>
      </table>
    </td>
  <?php
  } //End Show/Hide left column
    // One Page Checkout - Left Column display
		 if ($pfile == 'checkout.php') {  
	      if (ONEPAGE_SHOW_OSC_COLUMNS == 'true') {  
			?>
			<td width="<?php echo BOX_WIDTH_LEFT; ?>" valign="top">
					<table border="0" width="<?php echo BOX_WIDTH_LEFT; ?>" cellspacing="0" cellpadding="2">
        		<tr> 
			    		<td class="leftcol" width="<?php echo BOX_WIDTH_LEFT; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH_LEFT; ?>" cellspacing="0" cellpadding="2">
			    			<!-- left_navigation //-->
			    			<?php require(bts_select('column', 'column_left.php')); // BTSv1.5 ?>
			    			<!-- left_navigation_eof //-->
			      </table></td>
				</table>
				</td>
			<?php
          } 
	      }
     	}	
// EOF One Page Checkout custom column code     	  
?>
<!-- content //-->
    <td width="100%" valign="top">
	  <?php
        require (bts_select ('content')); // BTSv1.5
  	  ?>
    </td>
<!-- content_eof //-->
<?php // Show/Hide Right Column

if (DOWN_FOR_MAINTENANCE == 'false' or DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF =='false') {

//only show right column if triggered in admin and only show right column if not on the checkout page
if (RIGHT_COLUMN_SHOW != 'false' and $pfile != 'checkout.php' ) { ?>
          <td width="<?php echo BOX_WIDTH_RIGHT; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH_RIGHT; ?>" cellspacing="0" cellpadding="2">
              <tr>
                <td class="rightcol" width="<?php echo BOX_WIDTH_RIGHT; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH_RIGHT; ?>" cellspacing="0" cellpadding="2">
                    <!-- right_navigation //-->
                    <?php require(bts_select('column', 'column_right.php')); // BTSv1.5 ?>
                    <!-- right_navigation_eof //-->
                  </table></td>
              </tr>
            </table></td>
          <?php
} // end Show/Hide Right Column
?>
          <?php   
//if on the checkout page decide which right column to show if applicable
if ($pfile == 'checkout.php') { 

   if (ONEPAGE_SHOW_OSC_COLUMNS == 'true') {?>
          <td width="<?php echo BOX_WIDTH_RIGHT; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH_RIGHT; ?>" cellspacing="0" cellpadding="2">
              <tr>
                <td class="rightcol" width="<?php echo BOX_WIDTH_RIGHT; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH_RIGHT; ?>" cellspacing="0" cellpadding="2">
                    <!-- right_navigation //-->
                    <?php require(bts_select('column', 'column_right.php')); // BTSv1.5 ?>
                    <!-- right_navigation_eof //-->
                  </table></td>
              </tr>
            </table></td>
          <?php
            }  elseif (ONEPAGE_SHOW_CUSTOM_COLUMN == 'true'){
		?>
          <td width="<?php echo BOX_WIDTH_RIGHT; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH_RIGHT; ?>" cellspacing="0" cellpadding="2">
              <td width="<?php echo BOX_WIDTH_RIGHT; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH_RIGHT; ?>" cellspacing="0" cellpadding="2">
                    <!-- right_navigation //-->
                    <?php require(DIR_WS_INCLUDES . 'checkout/column_right.php'); ?>
                    <!-- right_navigation_eof //-->
                  </table></td>
            </table></td>
          <?php
		       }
     
	        }
      } else   { ?>
          <td>&nbsp;</td>
          <?php
      }
// EOF One Page Checkout custom column code      		  
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
<!-- footer_eof //-->
<?php
}
?>
</td></tr>
</table>
<!-- Store width controller -->

<?php 
if (bts_select('javascript', $PHP_SELF)) { // if a specific javscript file exists for this page it will be loaded
  require(bts_select('javascript', $PHP_SELF));
} else {
  if (isset($javascript) && file_exists(DIR_WS_JAVASCRIPT . basename($javascript))) { require(DIR_WS_JAVASCRIPT . basename($javascript)); }

  }

  if ($pfile == 'index.php') {
	if (isset($LoadSlideshowJS) && $LoadSlideshowJS == true) {
        echo '<script type="text/javascript" src="http://www.google.com/jsapi"></script>';
        echo '<script type="text/javascript">' . "\n";
        echo '// Load jQuery' . "\n";
        echo 'google.load("jquery", "1.4.0");' . "\n";
        echo '</script>' . "\n"; 
        echo '<script type="text/javascript" src="' . DIR_WS_JAVASCRIPT . 'showcase.2.0.js"></script>';
        require (DIR_WS_JAVASCRIPT . 'slideshow_init.js.php');
    }
  }
?>

<script type="text/javascript"><!--
function couponpopupWindow(url) {
window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=450,height=280,screenX=150,screenY=150,top=150,left=150')
}
//--></script> 
</body>
</html>