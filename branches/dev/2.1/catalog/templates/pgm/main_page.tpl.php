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

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js"></script>

<script type="text/javascript" src="<?php echo DIR_WS_TEMPLATES; ?>/javascript/hoverIntent.js"></script>
<script type="text/javascript" src="<?php echo DIR_WS_TEMPLATES; ?>/javascript/superfish.js"></script>
<script type="text/javascript" src="<?php echo DIR_WS_TEMPLATES; ?>/javascript/supersubs.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo DIR_WS_TEMPLATES; ?>/javascript/superfish.css">

<script type="text/javascript"> 
// initialise Superfish & jQuery UI Tabs

    $(document).ready(function(){ 
        $("ul.sf-menu").supersubs({ 
            minWidth:    12,   // minimum width of sub-menus in em units 
            maxWidth:    27,   // maximum width of sub-menus in em units 
            extraWidth:  1     // extra width can ensure lines don't sometimes turn over 
                               // due to slight rounding differences and font-family 
        }).superfish();  // call supersubs first, then superfish, so that subs are 
                         // not display:none when measuring. Call before initialising 
                         // containing tabs for same reason. 

    }); 
							  

<!-- SEARCH BOX TEXT -->
<script type="text/javascript">
function clearDefault(dw){dw.value=""};
</script>
<!-- SEARCH BOX TEXT -->

<!-- SUCKERFISH MENU CODE START-->
<script type="text/javascript"><!--//--><![CDATA[//><!--
sfHover = function() {
var sfEls = document.getElementById("nav").getElementsByTagName("LI");
for (var i=0; i<sfEls.length; i++) {
sfEls[i].onmouseover=function() {
this.className+=" sfhover";
}
sfEls[i].onmouseout=function() {
this.className=this.className.replace(new RegExp(" sfhover\\b"), "");
}
}
}
if (window.attachEvent) window.attachEvent("onload", sfHover);

//--><!]]></script>
<link rel="stylesheet" href="<?php echo DIR_WS_TEMPLATES; ?>menu.css" type="text/css" media="screen">
<!-- SUCKERFISH MENU CODE END-->

<!--// JQUERY -->
<script type="text/javascript" src="<?php echo DIR_WS_TEMPLATES; ?>javascript/jquery.js"></script>
<!--// JQUERY -->

<!--// SHOW HIDE BASKET v2-->
<script type="text/javascript">
jQuery(document).ready(function() {
 // hides the slickbox as soon as the DOM is ready
 // (a little sooner than page load)
  jQuery('#slickbox').hide();
  jQuery('#hideb').hide();


 // shows the slickbox on clicking the noted link  
  jQuery('a#slick-show').click(function() {
    jQuery('#showb').hide();
    jQuery('#hideb').show();
    jQuery('#slickbox').slideDown('slow');
    return false;
  });

 // hides the slickbox on clicking the noted link  
  jQuery('a#slick-hide').click(function() {
    jQuery('#showb').show();
    jQuery('#hideb').hide();
    jQuery('#slickbox').slideUp('slow');
    return false;
  });
});
</script>
<!--// SHOW HIDE BASKET v2-->

<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<?php require(DIR_WS_INCLUDES . 'meta_tags.php'); ?>
<title><?php echo META_TAG_TITLE; ?></title>

<meta name="keywords" content="<?php echo META_TAG_KEYWORDS; ?>" >
<meta name="description" content="<?php echo META_TAG_DESCRIPTION; ?>" >
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<?php if (bts_select('stylesheets', $PHP_SELF)) { // if a specific stylesheet exists for this page it will be loaded ?>
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheets', $PHP_SELF)); // BTSv1.5 ?>">

<?php } ?>
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','stylesheet.css')); // BTSv1.5 ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','stylesheet-new.css')); // BTSv1.5 ?>">
<link rel="stylesheet" type="text/css" href="<?php echo (bts_select('stylesheet','print.css')); // BTSv1.5 ?>" media="print">
<link rel="stylesheet" type="text/css" href="<?php echo DIR_WS_TEMPLATES; ?>coolmenu.css">

<?php require('includes/javascript/form_check.js.php'); ?>
<?php if (isset($javascript) && file_exists(DIR_WS_JAVASCRIPT . basename($javascript))) { require(DIR_WS_JAVASCRIPT . basename($javascript)); } ?>

</head>

<body>

<?php //////////////////////////////////////////////START OF TABLES /////////////////////////////////////////////////////?>

<table width="990" border="0" cellpadding="0" cellspacing="0" align="center" class="mainarea">
  <tr>
  <td colspan="3">
  
		  <?php require(DIR_WS_INCLUDES . 'warnings.php'); ?> 
          <?php
          // include i.e. template switcher in every template
          if(bts_select('common', 'common_top.php')) include (bts_select('common', 'common_top.php')); // BTSv1.5
          // BOF Added: Down for Maintenance Hide header if not to show
          if (DOWN_FOR_MAINTENANCE == 'false' or DOWN_FOR_MAINTENANCE_HEADER_OFF =='false') {
          ?>
  </td>
  </tr>
  <tr>
  <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '4'); ?></td>
  </tr>
  <tr>
  <td width="8" >&nbsp;&nbsp;</td><!-- LEFT SPACER -->
  
      <td><!-- MAIN PAGE BLOCK START --> 
      
            <table width="100%" border="0" cellpadding="0" cellspacing="0"><!-- LOGO, SEARCH & BASKET START -->
            <tr>
               <td width="400"><!-- LOGO START -->
			   	  <?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_TEMPLATES . 'images/yourstorelogo.jpg', 'Your Store') . '</a>'; ?>
               </td><!-- LOGO END -->
               
               <td class="smalltext"><!-- SEARCH BOX START -->
                <form name="quick_find" action="advanced_search_result.php" method="get">
                  <input type="text" class="inputField" name="keywords" maxlength="30" value="Search..." onFocus="clearDefault(this)">
                  <input type="hidden" name="search_in_description" value="1">
                  <input type="hidden" name="inc_subcat" value="1">
                  <?php echo tep_image_submit('button_quick_find.gif', BOX_HEADING_SEARCH); ?>
 				</form>
                <br>
                <?php echo '<a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH) . '"><b>' . BOX_SEARCH_ADVANCED_SEARCH . '</b></a><br><a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, 'pfrom=' . '0' . '&amp;pto=' . '10000', 'NONSSL') . '">'; ?>View all products</a>
                                
               </td><!-- SEARCH BOX END -->

<!-- SPACER TO MAINTAIN ROW HEIGHT -->
<td rowspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '100'); ?></td>
               
               <td width="300" align="right" rowspan="2"><!-- BASKET START -->
               <table border="0" cellpadding="0" cellspacing="0" width="300" class="basketbackground">
               <tr valign="top"><td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '12'); ?></td></tr>
               <tr valign="top">
               <td width="100%" align="center">
                  <a href="<?php echo tep_href_link('shopping_cart.php')?>" >
                  <?php echo tep_image(DIR_WS_TEMPLATES . '/images/bag.png', 'my basket'); ?></a>
               </td>
               <td>
                  <table width="180" cellpadding="0" cellspacing="0" border="0">
                    <tr>
                        <td class="basketheader" colspan="2"><a class="basketheader" href="<?php echo tep_href_link('shopping_cart.php')?>"><?php echo tep_image(DIR_WS_TEMPLATES . 'images/mybasket.gif', ''); ?></a></td>
                    </tr>
                    <tr>
                        <td class="baskettotals" colspan="2">&nbsp;<a class="headerNavigation" href="<?php echo tep_href_link('shopping_cart.php')?>" >Contains:&nbsp;<?php echo $cart->count_contents()?> items</a></td>
                    </tr>
                    <tr>
                        <td class="baskettotals" colspan="2">&nbsp;<a class="headerNavigation" href="<?php echo tep_href_link('shopping_cart.php')?>" >Total:&nbsp;<?php echo $currencies->format($cart->show_total()); ?></a></td>
                    </tr>
                    <tr valign="top">
                        <td width="50%">
                            <div id="showb"><a class="basketfooter" href="#" id="slick-show" style="border:0px;"><?php echo tep_image(DIR_WS_TEMPLATES . 'images/show.png', ''); ?>							</a></div>
                            <div id="hideb"><a class="basketfooter" href="#" id="slick-hide" style="border:0px;"><?php echo tep_image(DIR_WS_TEMPLATES . 'images/hide.png', ''); ?></a></div>
							
                        </td>
                        <td width="50%">
	        <a class="basketfooter" href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING, ''); ?>"><?php echo tep_image(DIR_WS_TEMPLATES . 'images/checkout.png', '','','','name="checkout"'); ?></a>
                        </td>
                     </tr>
                  </table>
                </td>
                <td width="10px">&nbsp;&nbsp;&nbsp;<?php echo tep_draw_separator('pixel_trans.gif', '1', '73'); ?></td>
                </tr>
                <tr>
	                <td colspan="3">                
                		<div id="slickbox" class="scdropdown" style="display: none; position:absolute; z-index:20;">
		                <?php include(DIR_WS_TEMPLATES . 'boxes/scdropdown.php'); ?>     
                		</div>
                	</td>
                </tr>
                </table>              
                </td><!-- BASKET END -->
            </tr>
            <tr valign="bottom">
            <td colspan="3" ><!--MENU BAR START-->
            <ul class="sf-menu">
            <li><a href="<?php echo tep_href_link(FILENAME_DEFAULT, 'cPath='); ?>" title=""><span>Category 1</span></a>
            	<ul>
                    <li><a href="<?php echo tep_href_link(FILENAME_DEFAULT, 'cPath='); ?>" title="">Sub Cat 1</a></li>
                    <li><a href="<?php echo tep_href_link(FILENAME_DEFAULT, 'cPath='); ?>" title="">Sub Cat 2</a></li>
                    <li><a href="<?php echo tep_href_link(FILENAME_DEFAULT, 'cPath='); ?>" title="">Sub Cat 3</a></li>
                    <li><a href="<?php echo tep_href_link(FILENAME_DEFAULT, 'cPath='); ?>" title="">Sub Cat 4</a></li>
                    <li><a href="<?php echo tep_href_link(FILENAME_DEFAULT, 'cPath='); ?>" title="">Sub Cat 5</a></li>
                    <li><a href="<?php echo tep_href_link(FILENAME_DEFAULT, 'cPath='); ?>" title="">Sub Cat 6</a></li>
                </ul>
            </li>
            <li><a href="<?php echo tep_href_link(FILENAME_DEFAULT, 'cPath='); ?>" title=""><span>Category 2</span></a></li>
            <li><a href="<?php echo tep_href_link(FILENAME_DEFAULT, 'cPath='); ?>" title=""><span>Category 3</span></a></li>
            <li><a href="<?php echo tep_href_link(FILENAME_DEFAULT, 'cPath='); ?>" title=""><span>Category 4</span></a></li>
            <li><a href="<?php echo tep_href_link(FILENAME_DEFAULT, 'cPath='); ?>" title=""><span>Category 5</span></a></li>
            <li><a href="<?php echo tep_href_link(FILENAME_DEFAULT, 'cPath='); ?>" title=""><span>Category 6</span></a></li>
            </td><!--MENU BAR END-->
            </tr>
            <tr><!-- CONNECTOR BAR -->
            <td colspan="4" class="infoBoxWrapper"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '1'); ?></td>
            </tr>
            <tr valign="bottom">
            <td class="breadcrumb" width="670" colspan="3"><?php echo $breadcrumb->trail(' &raquo; '); ?></td>
            <!-- RIGHT HAND MENU START -->
            <td align="right">
            	<table border="0" width="300" cellspacing="0" cellpadding="0" align="right">
            		<tr valign="top" align="right">
                    	<td width="74">&nbsp;</td>
            			<td align="right">
                <?php if (tep_session_is_registered('customer_id')) { ?>                        
                <ul class="sf-menu">        
               		<li><a href="<?php echo tep_href_link(FILENAME_LOGOFF); ?>" title=""><span>Logoff</span></a></li>
       				<li><a href="<?php echo tep_href_link(FILENAME_ACCOUNT); ?>" title=""><span>Account</span></a></li>
	            	<li><a href="<?php echo tep_href_link(FILENAME_WISHLIST); ?>" title=""><span>Wishlist</span></a></li>
            	</ul>      
            	<?php } else { ?>
                <ul class="sf-menu">        
               		<li><a href="<?php echo tep_href_link(FILENAME_LOGIN); ?>" title=""><span>Logon</span></a></li>
       				<li><a href="<?php echo tep_href_link(FILENAME_ACCOUNT); ?>" title=""><span>Account</span></a></li>
	            	<li><a href="<?php echo tep_href_link(FILENAME_WISHLIST); ?>" title=""><span>Wishlist</span></a></li>
            	</ul>          
                <?php } ?>
                    	</td>
					</tr>
                 </table>
             </td>
             <!-- RIGHT HAND MENU END -->
            </tr>
            </table><!-- LOGO, SEARCH & BASKET END -->
            
      		<table width="100%" border="0" cellpadding="0" cellspacing="0"><!-- BREADCRUMB START-->
            <tr>
               <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '2'); ?></td>
            </tr>
            <tr>
               <td align="center" colspan="2"><?php echo tep_image(DIR_WS_TEMPLATES . 'images/horiz_bar.jpg', ''); ?></td>
            </tr>
            <tr>
               <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '7'); ?></td>
            </tr>
            </table><!-- BREADCRUMB END-->
      
 			<!-- MAIN CONTENT FRAME START -->
                    <table border="0" width="100%" cellspacing="0" cellpadding="0" class="maincontent">
                        <tr>
                            <!-- LEFT BOX START -->
                            <td width="150" valign="top">
                                    <table border="0" width="150" cellspacing="0" cellpadding="0">
                                            <?php // require(bts_select('column', 'column_left.php')); // BTSv1.5 ?>
                                            <?php include(DIR_WS_TEMPLATES . 'includes/column_left.php'); ?>
                                    </table>
                            </td>
                            <!-- LEFT BOX END -->
                            
                            <!-- SPACER BOX START -->
                            <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '10'); ?></td>
                            <!-- SPACER BOX START -->
                                                  
                            <!-- CENTRE BOX START -->
                            <td width="644" valign="top">
                                    <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td align="center">
                                                     <?php require (bts_select ('content')); // BTSv1.5 ?>
                                                </td>
                                            </tr>
                                    </table>
                            </td>
                            <!-- CENTRE BOX END -->

							<!-- SPACER BOX START -->
                            <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '10'); ?></td>
                            <!-- SPACER BOX START -->

                    
                            <!-- RIGHT BOX START-->
                            <td width="0" valign="top">
                                    <table border="0" width="150" cellspacing="0" cellpadding="0">
                                    	<tr><td>
                                            <?php // require(bts_select('column', 'column_right.php')); // BTSv1.5 ?>
                                            <?php include(DIR_WS_TEMPLATES . 'includes/column_right.php'); ?>
                                        </td></tr>
                                    </table>
                            </td>
                            <!-- RIGHT BOX END-->
                        </tr>
                    </table>

            <!-- MAIN CONTENT FRAME END -->     

<!-- FOOTER START -->
<table border="0" width="100%" cellspacing="0" cellpadding="0" class="mainarea" ALIGN="center">
	<tr>
		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '8'); ?></td>
    </tr>
	<tr align="center">
		<td><?php echo tep_image(DIR_WS_TEMPLATES . 'images/horiz_bar.jpg', ''); ?></td>
    </tr>
	<tr>
		<td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '8'); ?></td>
    </tr>
    <tr>
    	<td align="center" class="smallText">
        	
			<?php echo '<a href="' . tep_href_link(FILENAME_SHIPPING) . '">' . BOX_INFORMATION_SHIPPING .  '</a>'; ?> |
        	<?php echo '<a href="' . tep_href_link(FILENAME_PRIVACY) . '">' . BOX_INFORMATION_PRIVACY .  '</a>'; ?> |
        	<?php echo '<a href="' . tep_href_link(FILENAME_CONDITIONS) . '">' . BOX_INFORMATION_CONDITIONS .  '</a>'; ?> |
        	<?php echo '<a href="' . tep_href_link(FILENAME_CONTACT_US) . '">' . BOX_INFORMATION_CONTACT .  '</a>'; ?> |
        	<?php echo '<a href="' . tep_href_link(FILENAME_SITEMAP) . '">' . BOX_INFORMATION_SITEMAP .  '</a>'; ?>
        </td>
    </tr>
    <tr>
		<td align="center" class="footersmallText">
        	Copyright &copy; 2008 - <?php echo date("Y"); ?>. Last update: <?php echo date ('F jS Y');?>
		</td>
	</tr>
</table>

<!-- FOOTER END -->

<?php //////////////////////////////////////////////END OF TABLES /////////////////////////////////////////////////////?>
   <!-- MAIN PAGE BLOCK END -->
  <td width="8" style="background-color:white">&nbsp;&nbsp;</td><!-- RIGHT SPACER -->
  </tr>
</table>

<?php } ?>

</body>
</html>