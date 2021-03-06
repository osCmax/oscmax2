<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
  // Add-on - Information Pages Unlimited
  require_once(DIR_WS_FUNCTIONS . 'information.php');
  $boxHeading = BOX_HEADING_INFORMATION;
  
  $corner_top_left = 'rounded';
  $corner_top_right = 'rounded';
  $corner_bottom_left = 'rounded';
  $corner_bottom_right = 'rounded'; 
  
  $boxContent_attributes = '';
  $boxLink = '';
  $box_base_name = 'information'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
?>
<!-- information bof //-->
<?php
// Modified for Information Pages Unlimited
  $boxContent = tep_information_show_category(1);
  	/*	'<a href="' . tep_href_link(FILENAME_SHIPPING) . '"> ' . BOX_INFORMATION_SHIPPING . '</a><br>' .
                '<a href="' . tep_href_link(FILENAME_PRIVACY) . '"> ' . BOX_INFORMATION_PRIVACY . '</a><br>' .
                '<a href="' . tep_href_link(FILENAME_CONDITIONS) . '"> ' . BOX_INFORMATION_CONDITIONS . '</a><br>' .
                '<a href="' . tep_href_link(FILENAME_CONTACT_US) . '"> ' . BOX_INFORMATION_CONTACT . '</a><br>'.
*/
if (PRODUCT_LIST_ENABLE == 'true') {
   $boxContent .= '<a href="' . tep_href_link(FILENAME_CATALOG_PRODUCTS_WITH_IMAGES, '', 'NONSSL') . '">' . BOX_CATALOG_PRODUCTS_WITH_IMAGES . '</a><br>' ;
}

/* BOF - MOD: CREDIT CLASS Gift Voucher Contribution
   $boxContent .= '<a href="' . tep_href_link(FILENAME_GV_FAQ, '', 'NONSSL') . '"> ' . BOX_INFORMATION_GV . '</a><br>' . //ICW ORDER TOTAL CREDIT CLASS/GV
EOF - MOD: CREDIT CLASS Gift Voucher Contribution */
if (FWR_SUCKERTREE_MENU_ON == 'true' && SHOW_SITEMAP == 'true') {   
   $boxContent .= '<a href="' . tep_href_link(FILENAME_SITEMAP) . '">' . BOX_INFORMATION_SITEMAP . '</a>';
}

include (bts_select('boxes', $box_base_name)); // BTS 1.5

?>
<!-- information eof //-->