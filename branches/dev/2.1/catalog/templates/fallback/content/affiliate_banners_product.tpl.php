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
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
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
      $affiliate_products_query = tep_db_query("select products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id = '" . $affiliate_banners['affiliate_products_id'] . "' and language_id = '" . $languages_id . "'");
      $affiliate_products = tep_db_fetch_array($affiliate_products_query);
      $prod_id = $affiliate_banners['affiliate_products_id'];
      $ban_id = $affiliate_banners['affiliate_banners_id'];
      switch (AFFILIATE_KIND_OF_BANNERS) {
        case 1: // Link to Products
          if ($prod_id > 0) {
            $link = '<a href="' . HTTPS_SERVER . DIR_WS_CATALOG . FILENAME_PRODUCT_INFO . '?ref=' . $affiliate_id . '&amp;products_id=' . $prod_id . '&amp;affiliate_banner_id=' . $ban_id . '" target="_blank"><img src="' . HTTPS_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . $affiliate_banners['affiliate_banners_image'] . '" border="0" alt="' . $affiliate_products['products_name'] . '"></a>';
            $link1 = '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_PRODUCT_INFO . '?ref=' . $affiliate_id . '&amp;products_id=' . $prod_id . '&amp;affiliate_banner_id=' . $ban_id . '" target="_blank"><img src="' . HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . $affiliate_banners['affiliate_banners_image'] . '" border="0" alt="' . $affiliate_products['products_name'] . '"></a>';
            $link2 = '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_PRODUCT_INFO . '?ref=' . $affiliate_id . '&amp;products_id=' . $prod_id . '&amp;affiliate_banner_id=' . $ban_id . '" target="_blank">' . $affiliate_products['products_name'] . '</a>';
			}
          break;
        case 2: // Link to Products
          if ($prod_id > 0) {
            $link = '<a href="' . HTTPS_SERVER . DIR_WS_CATALOG . FILENAME_PRODUCT_INFO . '?ref=' . $affiliate_id . '&products_id=' . $prod_id . '&affiliate_banner_id=' . $ban_id . '" target="_blank"><img src="' . HTTPS_SERVER . DIR_WS_CATALOG . FILENAME_AFFILIATE_SHOW_BANNER . '?ref=' . $affiliate_id . '&affiliate_banner_id=' . $ban_id . '" border="0" alt="' . $affiliate_products['products_name'] . '"></a>';
            $link1 = '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_PRODUCT_INFO . '?ref=' . $affiliate_id . '&products_id=' . $prod_id . '&affiliate_banner_id=' . $ban_id . '" target="_blank"><img src="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_AFFILIATE_SHOW_BANNER . '?ref=' . $affiliate_id . '&affiliate_banner_id=' . $ban_id . '" border="0" alt="' . $affiliate_products['products_name'] . '"></a>';
            $link2 = '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . FILENAME_PRODUCT_INFO . '?ref=' . $affiliate_id . '&products_id=' . $prod_id . '&affiliate_banner_id=' . $ban_id . '" target="_blank">' . $affiliate_products['products_name'] . '</a>';
			}
          break;
      }

          if ($prod_id > 0) {
?>
        <table width="95%" align="center" border="0" cellpadding="4" cellspacing="0" class="infoBoxContents">
          <tr>
            <td class="infoBoxHeading"><?php echo TEXT_AFFILIATE_NAME . $affiliate_banners['affiliate_banners_title']; ?></td>
          </tr>
          <tr> 
            <td class="smallText" align="center"><?php echo $link; ?></td> 
          </tr> 
          <tr> 
            <td class="smallText"><?php echo TEXT_AFFILIATE_INFO; ?></td> 
          </tr> 
          <tr> 
            <td class="smallText" align="center"> 
             <textarea cols="60" rows="4" class="boxText"><?php echo $link1; ?></textarea> 
   </td> 
          </tr> 
          <tr> 
            <td>&nbsp;<td> 
          </tr> 
          <tr>
            <td class="infoBoxHeading"><?php echo TEXT_AFFILIATE_NAME . $affiliate_banners['affiliate_banners_title']; ?></td>
          </tr>
          <tr> 
            <td class="smallText" align="center"><b><?php echo TEXT_AFFILIATE_TEXT_VERSION; ?></b> <?php echo $link2; ?></td> 
          </tr> 
          <tr> 
            <td class="smallText"><?php echo TEXT_AFFILIATE_INFO; ?></td> 
          </tr> 
          <tr> 
            <td class="smallText" align="center"> 
             <textarea cols="60" rows="3" class="boxText"><?php echo $link2; ?></textarea> 
   </td> 
          </tr>
          </table>
<?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?>

<?php }
}
}
?>
          </table>
	 </td>
      </tr>
     </table>
<!-- body_text_eof //-->
