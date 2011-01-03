<?php
/*
$Id: tell_a_friend.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.

    
    if (isset($_GET['products_id'])) {  
    if (basename($PHP_SELF) != FILENAME_TELL_A_FRIEND){
    	    	
?>
<!-- tell_a_friend //-->
<?php
  $boxHeading = BOX_HEADING_TELL_A_FRIEND;
  
  $corner_top_left = 'rounded';
  $corner_top_right = 'rounded';
  $corner_bottom_left = 'rounded';
  $corner_bottom_right = 'rounded'; 
  
  $boxContent_attributes = ' align="center"';
  $boxLink = '';
  $box_base_name = 'tell_a_friend'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
  
  $boxContent = tep_draw_form('tell_a_friend', tep_href_link(FILENAME_TELL_A_FRIEND, '', 'NONSSL', false), 'get');
  $boxContent .= tep_draw_input_field('to_email_address', '', 'size="10"') . '&nbsp;' . tep_image_submit('button_tell_a_friend.gif', BOX_HEADING_TELL_A_FRIEND) . tep_draw_hidden_field('products_id', $_GET['products_id']) . tep_hide_session_id() . '<br>' . BOX_TELL_A_FRIEND_TEXT;
$boxContent .= '</form>';





include (bts_select('boxes', $box_base_name)); // BTS 1.5
  $boxContent_attributes = '';
 } 
}
?>
<!-- tell_a_friend_eof //-->
