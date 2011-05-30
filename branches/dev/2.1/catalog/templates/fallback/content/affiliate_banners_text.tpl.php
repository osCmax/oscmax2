<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<!-- body_text //-->
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '4'); ?></td>
      </tr>
	  <tr>
        <td class="productinfo_header"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td align="right">&nbsp;</td>
          </tr>
	  <tr>
            <td colspan=2 class="main"><?php echo TEXT_INFORMATION; ?></td>
          </tr>
        </table>
	</td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table width="100%" align="center" border="0" cellpadding="0" cellspacing="0"><tr><td>
<?php 
if (tep_db_num_rows($affiliate_banners_values)) { 

   while ($affiliate_banners = tep_db_fetch_array($affiliate_banners_values)) { 
     $prod_id = $affiliate_banners['affiliate_products_id']; 
     $cat_id = $affiliate_banners['affiliate_category_id']; 
     $prod_name = $affiliate_banners['affiliate_banners_title']; 
     $ban_id = $affiliate_banners['affiliate_banners_id']; 
    
	switch (AFFILIATE_KIND_OF_BANNERS) { 
     case 1: 
   // Link to Products 
   if ($prod_id > 0) { 

    $link= '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_PRODUCT_INFO . '?ref=' . $affiliate_id . '&amp;products_id=' . $prod_id . '&amp;affiliate_banner_id=' . $ban_id . '" target="_blank"><img src="' . HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . $affiliate_banners['affiliate_banners_image'] . '" border="0"></a>'; 
    $link2= '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_PRODUCT_INFO . '?ref=' . $affiliate_id . '&amp;products_id=' . $prod_id . '&amp;affiliate_banner_id=' . $ban_id . '" target="_blank">' . $prod_name . '</a>'; 
   } 
   // generic_link 
   else { 
    $link= '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_DEFAULT . '?ref=' . $affiliate_id . '&amp;affiliate_banner_id=' . $ban_id . '" target="_blank"><img src="' . HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . $affiliate_banners['affiliate_banners_image'] . '" border="0"></a>'; 
    $link2= '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_DEFAULT . '?ref=' . $affiliate_id . '&amp;affiliate_banner_id=' . $ban_id . '" target="_blank">' . $prod_name . '</a>'; 
             } 
   break; 
  case 2: 
   // Link to Products 
   if ($prod_id > 0) { 

    $link= '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_PRODUCT_INFO . '?ref=' . $affiliate_id . '&amp;products_id=' . $prod_id . '&amp;affiliate_banner_id=' . $ban_id . '" target="_blank"><img src="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_AFFILIATE_SHOW_BANNER . '?ref=' . $affiliate_id . '&amp;affiliate_banner_id=' . $ban_id . '" border="0"></a>'; 
    $link2= '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_PRODUCT_INFO . '?ref=' . $affiliate_id . '&amp;products_id=' . $prod_id . '&amp;affiliate_banner_id=' . $ban_id . '" target="_blank">' . $prod_name . '</a>'; 
   } 
   // generic_link 
   else { 
    $link= '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_DEFAULT . '?ref=' . $affiliate_id . '&amp;affiliate_banner_id=' . $ban_id . '" target="_blank"><img src="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_AFFILIATE_SHOW_BANNER . '?ref=' . $affiliate_id . '&amp;affiliate_banner_id=' . $ban_id . '" border="0"></a>'; 
    $link2= '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_DEFAULT . '?ref=' . $affiliate_id . '&amp;affiliate_banner_id=' . $ban_id . '" target="_blank">' . $prod_name . '</a>'; 
             } 
   break;  
     } 

?>
        <table width="95%" align="center" border="0" cellpadding="4" cellspacing="0" class="infoBoxContents">
          <tr>
            <td class="infoBoxHeading">
            <?php if ($prod_id < 1 && $cat_id < 1) { // Homepage banner
		      echo TEXT_AFFILIATE_WEBSITE_BANNER;
			} elseif ($prod_id > 0  && $cat_id < 1) { // Product banner
			  echo TEXT_AFFILIATE_PRODUCT_BANNER; 
			} elseif ($prod_id < 1  && $cat_id > 0) { // Category banner
			  echo TEXT_AFFILIATE_CATEGORY_BANNER;	
			}
		    echo $affiliate_banners['affiliate_banners_title']; ?>
            </td>
          </tr> 
          <tr> 
            <td class="smallText" align="center"><b><?php echo TEXT_AFFILIATE_TEXT_VERSION; ?></b> <?php echo $link2; ?></td> 
          </tr> 
          <tr> 
            <td class="smallText"><?php echo TEXT_AFFILIATE_INFO; ?></td> 
          </tr> 
          <tr> 
            <td class="smallText" align="center"> 
             <textarea cols="50" rows="3" class="boxText"><?php echo $link2; ?></textarea> 
   </td> 
          </tr>
          </table>
<?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>
<?php 
   }
}
?>
          </table>
	 </td>
      </tr>
     </table>
<!-- body_text_eof //-->
