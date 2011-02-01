<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.

?>          
<!-- affiliate_system //--> 

<?php 
  $boxHeading = BOX_HEADING_AFFILIATE;
  
  $corner_top_left = 'rounded';
  $corner_top_right = 'rounded';
  $corner_bottom_left = 'rounded';
  $corner_bottom_right = 'rounded'; 
  
  $boxContent_attributes = '';
  $boxLink = '';
  $box_base_name = 'affiliate'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

  if (tep_session_is_registered('affiliate_id')) { 
    $boxContent = '<a href="' . tep_href_link(FILENAME_AFFILIATE_SUMMARY, '', 'SSL') . '">' . BOX_AFFILIATE_SUMMARY . '</a><br>' . 
        '<a href="' . tep_href_link(FILENAME_AFFILIATE_ACCOUNT, '', 'SSL'). '">' . BOX_AFFILIATE_ACCOUNT . '</a><br>' .
        '<b><a href="' . tep_href_link(FILENAME_AFFILIATE_BANNERS). '">' . BOX_AFFILIATE_BANNERS . '</a></b><br>' . 
        '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_BANNERS_BANNERS, '', 'SSL') . '">' . BOX_AFFILIATE_BANNERS_BANNERS . '</a><br>' .
        '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_BANNERS_BUILD, '', 'SSL') . '">' . BOX_AFFILIATE_BANNERS_BUILD . '</a><br>' .
        '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_BANNERS_BUILD_CAT, '', 'SSL') . '">' . BOX_AFFILIATE_BANNERS_BUILD_CAT . '</a><br>' .
        '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_BANNERS_CATEGORY, '', 'SSL') . '">' . BOX_AFFILIATE_BANNERS_CATEGORY . '</a><br>' .
        '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_BANNERS_PRODUCT, '', 'SSL') . '">' . BOX_AFFILIATE_BANNERS_PRODUCT . '</a><br>' .
        '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_BANNERS_TEXT, '', 'SSL') . '">' . BOX_AFFILIATE_BANNERS_TEXT . '</a><br>' .
        '<b><a href="' . tep_href_link(FILENAME_AFFILIATE_REPORTS, '', 'SSL') . '">' . BOX_AFFILIATE_REPORTS . '</a></b><br>' .
        '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_CLICKS, '', 'SSL'). '">' . BOX_AFFILIATE_CLICKRATE . '</a><br>' .
        '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_SALES, '', 'SSL'). '">' . BOX_AFFILIATE_SALES . '</a><br>' .
        '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_AFFILIATE_PAYMENT, '', 'SSL'). '">' . BOX_AFFILIATE_PAYMENT . '</a><br>' .
        '<a href="' . tep_href_link(FILENAME_AFFILIATE_CONTACT, '', 'SSL') . '">' . BOX_AFFILIATE_CONTACT . '</a><br>' .
        '<a href="' . tep_href_link(FILENAME_AFFILIATE_FAQ, '', 'SSL') . '">' . BOX_AFFILIATE_FAQ . '</a><br>' .
        '<a href="' . tep_href_link(FILENAME_AFFILIATE_LOGOUT). '">' . BOX_AFFILIATE_LOGOUT . '</a>' ; 
  } else { 
    $boxContent = '<a href="' . tep_href_link(FILENAME_INFORMATION, 'info_id=' . DEFINE_AFFILIATE_INFO_INFO_NO) . '">' . BOX_AFFILIATE_INFO . '</a><br>' . 
        '<a href="' . tep_href_link(FILENAME_AFFILIATE, '', 'SSL') . '">' . BOX_AFFILIATE_LOGIN . '</a>'; 
  } 

  include (bts_select('boxes', $box_base_name)); // BTS 1.5
?>
<!-- affiliate_system eof//--> 