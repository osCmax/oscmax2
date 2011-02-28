<?php
//begin{htmlparams}
  echo HTML_PARAMS;       
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
	  
//begin{common}
 // include content
 require (bts_select ('common', 'common_top.php')); // BTSv1.5
//end{common}
       
//begin{cataloglogo}
  // show logo      
  echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo.gif', STORE_NAME) . '</a>'; 
//end{cataloglogo}
        
//begin{myaccountlogo}
  echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image(DIR_WS_IMAGES . 'header_account.gif', HEADER_TITLE_MY_ACCOUNT) . '</a>';      
//end{myaccountlogo}
        
//begin{cartlogo}
  echo '<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_IMAGES . 'header_cart.gif', HEADER_TITLE_CART_CONTENTS) . '</a>';      
//end{cartlogo}
        
//begin{checkoutlogo}
  echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . tep_image(DIR_WS_IMAGES . 'header_checkout.gif', HEADER_TITLE_CHECKOUT) . '</a>';      
//end{checkoutlogo}
        
//begin{breadcrumbs}
  echo $breadcrumb->trail(' &raquo; '); 
//end{breadcrumbs}
                      
//begin{myaccount}
 ?>
<a href="<?php echo tep_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_MY_ACCOUNT; ?></a>
  <?php       
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

//begin{content}
  require (bts_select ('content')); // BTSv1.5        
//end{content}
        
//begin{columnleft}
  require(bts_select('column', 'column_left.php'));
//end{columnleft}       
                
//begin{columnright}
  require(bts_select('column', 'column_right.php'));
//end{columnright}        
                
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

//end{footer}
        echo FOOTER_TEXT_BODY;       
//
        //begin{banner}
        if ($banner = tep_banner_exists('dynamic', '468x50')) {
          echo tep_display_banner('static', $banner);
        }     
//
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

?>