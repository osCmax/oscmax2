<?php
/*
$Id: information.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.

  $boxHeading = BOX_HEADING_INFORMATION;
  $corner_left = 'square';
  $corner_right = 'square';
  $box_base_name = 'information'; // for easy unique box template setup (added BTSv1.2)

  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
?>
<!-- information bof //-->
<?php

  $boxContent = '<a href="' . tep_href_link(FILENAME_SHIPPING) . '"> ' . BOX_INFORMATION_SHIPPING . '</a><br>' .
                '<a href="' . tep_href_link(FILENAME_PRIVACY) . '"> ' . BOX_INFORMATION_PRIVACY . '</a><br>' .
                '<a href="' . tep_href_link(FILENAME_CONDITIONS) . '"> ' . BOX_INFORMATION_CONDITIONS . '</a><br>' .
                '<a href="' . tep_href_link(FILENAME_CONTACT_US) . '"> ' . BOX_INFORMATION_CONTACT . '</a><br>'.
                '<a href="' . tep_href_link(FILENAME_CATALOG_PRODUCTS_WITH_IMAGES, '', 'NONSSL') . '">' . BOX_CATALOG_PRODUCTS_WITH_IMAGES . '</a><br>' .
// BOF - MOD: CREDIT CLASS Gift Voucher Contribution
                '<a href="' . tep_href_link(FILENAME_GV_FAQ, '', 'NONSSL') . '"> ' . BOX_INFORMATION_GV . '</a><br>' . //ICW ORDER TOTAL CREDIT CLASS/GV
// EOF - MOD: CREDIT CLASS Gift Voucher Contribution
                '<a href="' . tep_href_link(FILENAME_SITEMAP) . '">' . BOX_INFORMATION_SITEMAP . '</a>';


include (bts_select('boxes', $box_base_name)); // BTS 1.5

?>
<!-- information eof //-->