<?php
//begin{htmlparams}
  echo HTML_PARAMS;
  // BOF Separate Pricing Per Customer
    if(!tep_session_is_registered('sppc_customer_group_id')) {
    $customer_group_id = '0';
    } else {
     $customer_group_id = $sppc_customer_group_id;
    }
  // EOF Separate Pricing Per Customer       
//end{htmlparams}

//begin{headertags}
  ?>
<title><?php echo META_TAG_TITLE; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>" />
<meta name="keywords" content="<?php echo META_TAG_KEYWORDS; ?>" />
<meta name="description" content="<?php echo META_TAG_DESCRIPTION; ?>" />
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>" />
  <?php        
//end{headertags}

//begin{stylesheet}
  ?>
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','stylesheet.css')); // BTSv1.5 ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','print.css')); // BTSv1.5 ?>" media="print" /> 
  <?php
//end{stylesheet}

//begin{javascript}
if (bts_select('javascript', $PHP_SELF)) { // if a specific javscript file exists for this page it will be loaded
      require(bts_select('javascript', $PHP_SELF));
} else {
  if (isset($javascript) && file_exists(DIR_WS_JAVASCRIPT . basename($javascript))) { require(DIR_WS_JAVASCRIPT . basename($javascript)); }
}
//end{javascript}
      
//begin{mopics}	  
	//// BEGIN:  Added for Dynamic MoPics v3.000
?>
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','dynamic_mopics.css')); // BTSv1.5 ?>" />
<script type="text/javascript"><!--
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
//end{mopics}	  

//begin{slimbox}
?>
<!-- BOF SLIMBOX2 -->
<script type="text/javascript" src="slimbox2/jquery.js"></script>
<script type="text/javascript" src="slimbox2/slimbox2.js"></script>
<?php include(DIR_WS_INCLUDES . 'javascript/sbcustom.php'); ?>
<link rel="stylesheet" href="slimbox2/slimbox2.css" type="text/css" media="screen" />
<!-- EOF SLIMBOX2 -->
<?php
//end{slimbox}

//begin{suckertree}
if ( defined('FWR_SUCKERTREE_MENU_ON') && FWR_SUCKERTREE_MENU_ON === 'true' )
echo '<link rel="stylesheet" type="text/css" href="' . (bts_select('stylesheet', 'fwr_suckertree_css_menu.css')) . '" />';
//end{suckertree}

//begin{warnings}
?>
<!-- warnings //-->
<?php require(DIR_WS_INCLUDES . 'warnings.php'); ?>
<!-- warning_eof //-->
<?php
//end{warnings}

//begin{templateswitch}
// include i.e. template switcher in every template
if(bts_select('common', 'common_top.php')) include (bts_select('common', 'common_top.php')); // BTSv1.5
//end{templateswitch}

////// Store Width Controller Tags ///////

//begin{storewidth}
 echo STORE_WIDTH;
//end{storewidth}

//begin{storealign}
 echo STORE_ALIGN;
//end{storealign}





	  
//begin{common}
 // include content
 require (bts_select ('common', 'common_top.php')); // BTSv1.5
//end{common}

////////// Template Icons/Logos //////////
       
//begin{mainlogo}
  // show logo      
  echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo.gif', STORE_NAME) . '</a>'; 
//end{mainlogo}
        
//begin{myaccounticon}
  echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image(DIR_WS_ICONS . 'account.png', HEADER_TITLE_MY_ACCOUNT) . '</a>';      
//end{myaccountlogo}
        
//begin{carticon}
  echo '<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_ICONS . 'contents.png', HEADER_TITLE_CART_CONTENTS) . '</a>';      
//end{cartlogo}
        
//begin{checkouticon}
  echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . tep_image(DIR_WS_ICONS . 'checkout.png', HEADER_TITLE_CHECKOUT) . '</a>';      
//end{checkoutlogo}

//begin{wishlisticon}
  echo '<a href="' . tep_href_link(FILENAME_WISHLIST, '', 'SSL') . '">' . tep_image(DIR_WS_ICONS . 'wishlist.png', HEADER_TITLE_WISHLIST) . '</a>';
//end{wishlisticon}

//begin{navicongroup}
  echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image(DIR_WS_ICONS . 'account.png', HEADER_TITLE_MY_ACCOUNT) . '</a>&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_ICONS . 'contents.png', HEADER_TITLE_CART_CONTENTS) . '</a>&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . tep_image(DIR_WS_ICONS . 'checkout.png', HEADER_TITLE_CHECKOUT) . '</a>&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_WISHLIST, '', 'SSL') . '">' . tep_image(DIR_WS_ICONS . 'wishlist.png', HEADER_TITLE_WISHLIST) . '</a>';
//end{navicongroup}        




//begin{breadcrumbs}
  echo $breadcrumb->trail(' &raquo; '); 
//end{breadcrumbs}


////////// Template header links ////////// 

//begin{logoff}
      if ((tep_session_is_registered('customer_id')) && (!tep_session_is_registered('noaccount'))) // DDB - PWA - 040622 - no display of logoff for PWA customers
	 { ?>
      &nbsp;|&nbsp; 
      <a href="<?php echo tep_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_LOGOFF; ?>
      </a>&nbsp;|&nbsp;
      <?php }
//end{logoff}

                     
//begin{myaccount}
  if (!tep_session_is_registered('noaccount')) // DDB - PWA - 040622 - no display of account for PWA customers
	{ ?>
	&nbsp;|&nbsp;
      	<a href="<?php echo tep_href_link(FILENAME_ACCOUNT, 'my_account_f=1', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_MY_ACCOUNT; ?>						
	</a>&nbsp;|&nbsp;
  <?php }
//end{myaccount}
          
//begin{cartcontents}
  ?>
<a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>" class="headerNavigation"><?php echo HEADER_TITLE_CART_CONTENTS; ?></a>
  <?php
//end{cartcontents}       
               
//begin{checkout}
  ?>
<a href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_CHECKOUT; ?></a>        
  <?php
//end{checkout}

//begin{wishlist}
?>
<a href="<?php echo tep_href_link(FILENAME_WISHLIST, '', 'SSL'); ?>" class="headerNavigation"><?php echo BOX_HEADING_CUSTOMER_WISHLIST; ?></a>
<?php
//end{wishlist}           

//begin{content}
  require (bts_select ('content')); // BTSv1.5        
//end{content}
        
//begin{columnleft}
// Show/Hide Left Column
if (LEFT_COLUMN_SHOW != 'false') { ?>
    <td width="<?php echo BOX_WIDTH_LEFT; ?>" valign="top">
      <table border="0" width="<?php echo BOX_WIDTH_LEFT; ?>" cellspacing="0" cellpadding="2">
        <tr>
<?php
// Hide Left Column if not to show
// BOF One Page Checkout custom column code

if (DOWN_FOR_MAINTENANCE == 'false' or DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF =='false') {
              if ($pfile != 'checkout.php') {
		     ?>
		    <td class="leftcol" width="<?php echo BOX_WIDTH_LEFT; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH_LEFT; ?>" cellspacing="0" cellpadding="2">
		    <!-- left_navigation //-->
		    <?php require(bts_select('column', 'column_left.php')); // BTSv1.5 ?>
		    <!-- left_navigation_eof //-->
		    </table></td>
		<?php
	        } else {  
	               if (ONEPAGE_SHOW_OSC_COLUMNS == 'true') {  
			?>
			    <td class="leftcol" width="<?php echo BOX_WIDTH_LEFT; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH_LEFT; ?>" cellspacing="0" cellpadding="2">
			    <!-- left_navigation //-->
			    <?php require(bts_select('column', 'column_left.php')); // BTSv1.5 ?>
			    <!-- left_navigation_eof //-->
			    </table></td>
			<?php
                        } 
	       
	          }
     }	
// EOF One Page Checkout custom column code     	  
?>
      </table>
    </td>
<?php
} // end Show/Hide Left Column
//end{columnleft}       
                
//begin{columnright}
// Show/Hide Right Column
if (RIGHT_COLUMN_SHOW != 'false') { ?>
    <td width="<?php echo BOX_WIDTH_RIGHT; ?>" valign="top">
      <table border="0" width="<?php echo BOX_WIDTH_RIGHT; ?>" cellspacing="0" cellpadding="2">
<?php
// Hide column_left.php if not to show
// BOF One Page Checkout custom column code
if (DOWN_FOR_MAINTENANCE == 'false' or DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF =='false') {
              if ($pfile != 'checkout.php') {
		     ?>
         <tr>
		    <td class="rightcol" width="<?php echo BOX_WIDTH_RIGHT; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH_RIGHT; ?>" cellspacing="0" cellpadding="2">
		    <!-- right_navigation //-->
		    <?php require(bts_select('column', 'column_right.php')); // BTSv1.5 ?>
		    <!-- right_navigation_eof //-->
		    </table></td>
		<?php
	        } else {  
	               if (ONEPAGE_SHOW_OSC_COLUMNS == 'true') {  
			?>
			    <td class="rightcol" width="<?php echo BOX_WIDTH_RIGHT; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH_RIGHT; ?>" cellspacing="0" cellpadding="2">
			    <!-- right_navigation //-->
			    <?php require(bts_select('column', 'column_right.php')); // BTSv1.5 ?>
			    <!-- right_navigation_eof //-->
			    </table></td>
			<?php
                        }  elseif (ONEPAGE_SHOW_CUSTOM_COLUMN == 'true'){
			    ?>  
				<td width="<?php echo BOX_WIDTH_RIGHT; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH_RIGHT; ?>" cellspacing="0" cellpadding="2">
			    <!-- right_navigation //-->
			       <?php require(DIR_WS_INCLUDES . 'checkout/column_right.php'); ?>
			    <!-- right_navigation_eof //-->
				</table></td>
     
			<?php
		       }
     
	        }
      }
// EOF One Page Checkout custom column code      		  
?>  
      </table>
    </td>
<?php
} // end Show/Hide Right Column
//end{columnright}

//begin{modulecontroller}
?>
      <!-- Page Module Controller -->
        <?php include (DIR_WS_MODULES . FILENAME_COMMON_PAGE_MODULES); ?>
      <!-- Page Module Controller -->
<?php
//end{modulecontroller}        
                
//begin{categorybox}                      
  // boxes (left)      
  if ((USE_CACHE == 'true') && empty($SID)) {
    echo tep_cache_categories_box();
  } else {
    include(DIR_WS_BOXES . 'categories.php');
  } 
//end{categorybox}        
               
//begin{manufacturerbox}
        if ((USE_CACHE == 'true') && empty($SID)) {
          echo tep_cache_manufacturers_box();
        } else {
          include(DIR_WS_BOXES . 'manufacturers.php');
        }
//end{manufacturerbox}        
        
//begin{whatsnewbox}
        require(DIR_WS_BOXES . 'whats_new.php');
//end{whatsnewbox}        
        
//begin{searchbox}
        require(DIR_WS_BOXES . 'search.php');  
//end{searchbox}        
          
//begin{informationbox}
        require(DIR_WS_BOXES . 'information.php'); 
//end{informationbox}

// boxes (right)        
  //begin{cartbox}      
  require(DIR_WS_BOXES . 'shopping_cart.php'); 
  //end{cartbox}        
        
//begin{maninfobox}
        if (isset($_GET['products_id'])) include(DIR_WS_BOXES . 'manufacturer_info.php');
//end{maninfobox}        
                
//begin{orderhistorybox}

//end{orderhistorybox}

//begin{bestsellersbox}
        include(DIR_WS_BOXES . 'best_sellers.php');
//end{bestsellersbox}
                
//begin{specialfriendbox}

//end{specialfriendbox}

//begin{reviewsbox}
        require(DIR_WS_BOXES . 'reviews.php');
//end{reviewsbox}
                
//begin{languagebox}
        if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
          include(DIR_WS_BOXES . 'languages.php');
        }
//end{languagebox} 
               
//begin{currenciesbox}
        if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
          include(DIR_WS_BOXES . 'currencies.php');
        }
               
//end{currenciesbox}     

// end boxes

//begin{footer}
// BOF Added: Down for Maintenance Hide footer.php if not to show
if (DOWN_FOR_MAINTENANCE == 'false' or DOWN_FOR_MAINTENANCE_FOOTER_OFF =='false') {
<!-- footer //-->
echo FOOTER_TEXT_BODY;
{banner}
<!-- footer_eof //-->
       
//end{footer}
            
//
//begin{banner}
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
//end{banner}
        //begin{date}
        echo strftime(DATE_FORMAT_LONG); 
//

        //begin{numrequests}
        echo $counter_now . ' ' . FOOTER_TEXT_REQUESTS_SINCE . ' ' . $counter_startdate_formatted;
//
        //begin{BTSsid}
        // if ($SID == '') echo ''; elseif (!isset($_GET[tep_session_name()])) echo '?' . $SID;
        if ($SID == '') echo ''; else echo '?' . $SID;      
//


//begin{year}
      echo date('Y');
//	  

//begin{googleanalytics}
if (GOOGLE_ANALYTICS_STATUS == 'true') { ?>	
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
<?php }
//end{googleanalytics}

//begin{pagename}
  $page =  $_SERVER["SCRIPT_NAME"];
  $break = Explode('/', $page);
  $pfile = $break[count($break) - 1];
  //echo $pfile; //debug code - displays current page name.
//end{pagename}
//begin{slideshow}
  if ($pfile == 'index.php') {
      if ( (DISPLAY_SLIDESHOW == true) ) {   
      echo '<script type="text/javascript" src="http://www.google.com/jsapi"></script>';
      echo '<script type="text/javascript">' . "\n";
      echo '// Load jQuery' . "\n";
      echo 'google.load("jquery", "1.4.2");' . "\n";
      echo '</script>' . "\n";    
      echo '<script type="text/javascript" src="' . DIR_WS_JAVASCRIPT . 'showcase.2.0.js"></script>';
	  require (DIR_WS_JAVASCRIPT . 'slideshow_init.js.php');
    }
  }
//end{slideshow}
//begin{sbcustom}
include(DIR_WS_INCLUDES . 'javascript/sbcustom.php');
//end{sbcustom}
//begin{jquery}
?>
<script src="http://www.google.com/jsapi"></script>
<script>
  // Load jQuery
  google.load("jquery", "1.4.2");
</script>
<?php   
//end{jquery}
?>