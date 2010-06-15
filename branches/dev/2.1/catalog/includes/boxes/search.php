<?php
/*
$Id: search.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.

?>
<!-- search //-->
<?php
  $boxHeading = BOX_HEADING_SEARCH;
  
  $corner_top_left = 'rounded';
  $corner_top_right = 'rounded';
  $corner_bottom_left = 'rounded';
  $corner_bottom_right = 'rounded'; 
  
  $boxContent_attributes = ' align="center"';
  $box_base_name = 'search'; // for easy unique box template setup (added BTSv1.2)

  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
  $boxContent = tep_draw_form('quick_find', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get');
  $boxContent .= tep_draw_hidden_field('search_in_description','1') . tep_draw_input_field('keywords', '', 'size="10" maxlength="30" ') . '&nbsp;' . tep_hide_session_id() . tep_image_submit('button_quick_find.gif', BOX_HEADING_SEARCH) . '<br>' . BOX_SEARCH_TEXT . '<br><a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH) . '"><b>' . BOX_SEARCH_ADVANCED_SEARCH . '</b></a>';
  $boxContent .= '</form>' .
                  '<br><a href="' . tep_href_link(FILENAME_ALLPRODS, '', 'NONSSL') . '">' . BOX_INFORMATION_ALLPRODS . '</a><br>';




include (bts_select('boxes', $box_base_name)); // BTS 1.5
  $boxContent_attributes = '';
?>
<!-- search_eof //-->
