<?php
/*
$Id: loginbox.php 1987 2013-07-29 07:57:31Z cottonbarn $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
/*
  IMPORTANT NOTE:

  This script is not part of the official osC distribution
  but an add-on contributed to the osC community. Please
  read the README and  INSTALL documents that are provided
  with this file for further information and installation notes.

  loginbox.php -   Version 5.4
  This puts a login request in a box with a login button.
  If already logged in, will not show anything.

  Modified to utilize SSL to bypass Security Alert
*/


if ((!strstr($_SERVER['PHP_SELF'],'login.php')) && (!strstr($_SERVER['PHP_SELF'],'create_account.php')) && (!strstr($_SERVER['PHP_SELF'],'Order_Info.php')) && (!strstr($_SERVER['PHP_SELF'],'Order_Info_Process.php')) && (!tep_session_is_registered('customer_id'))) {
	
if (!strstr($_SERVER['PHP_SELF'],'checkout.php')) {

if (!tep_session_is_registered('customer_id')) {
		
  $boxHeading = BOX_HEADING_LOGIN_BOX;
  $corner_top_left = 'rounded';
  $corner_top_right = 'rounded';
  $corner_bottom_left = 'rounded';
  $corner_bottom_right = 'rounded';
  
  $boxContent_attributes = ' align="center"';
  $boxLink = '';
  $box_base_name = 'loginbox'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
?>
<!-- loginbox bof //-->
<?php

  
 // $boxContent = '<table border="0" width="100%" cellspacing="0" cellpadding="0">';
 // $boxContent .= '<tr><td align="center" valign="top">';
	$boxContent = tep_draw_form('login', tep_href_link(FILENAME_LOGIN, 'action=process', 'SSL'));
	$boxContent .= BOX_LOGINBOX_EMAIL . '<br>' . tep_draw_input_field('email_address', '', 'size="10" maxlength="100" style="width: ' . ($box_width-30) . 'px"','email') . '<br>';
	$boxContent .= BOX_LOGINBOX_PASSWORD . '<br>' . tep_draw_password_field('password', '', 'size="10" maxlength="40" style="width: ' . ($box_width-30) . 'px"') . '<br>';
	$boxContent .= tep_draw_button(IMAGE_BUTTON_LOGIN, 'glyphicon-log-in', null, 'primary', 'submit', 'btn-default');
	$boxContent .= '</form>';
	$boxContent .= '<a href="' . tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '" >' . BOX_LOGINBOX_FORGOT_PASSWORD . '</a>';
  $boxContent .= '<br>' . '<a href="' . tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'). '">' . BOX_LOGINBOX_TEXT_NEW. '</a>';
//  $boxContent .= '</td></tr></table>';
  
  
// 	$boxContent = array();
//  $boxContent[] = array('align' => 'center',
//                        'text'  => $loginboxcontent);
//  new infoBox($boxContent);


//  } else {
  // If you want to display anything when the user IS logged in, put it
  // in here...  Possibly a "You are logged in as :" box or something.
  
include (bts_select('boxes', $box_base_name)); // BTS 1.5
 } // end if OPC check
}
?>
<!-- loginbox_eof //-->
<?php 
} else {

?>

<?php


// WebMakers.com Added: My Account Info Box (but not for PWA clients
  
  if ((tep_session_is_registered('customer_id')) && (!tep_session_is_registered('noaccount'))) {
  
?>
<!-- my_account_info //-->
<?php

  $boxHeading = BOX_HEADING_LOGIN_BOX_MY_ACCOUNT;
  $corner_left = 'square';
  $corner_right = 'square';
  $box_base_name = 'loginbox'; // for easy unique box template setup (added BTSv1.2)

  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
  
//  $boxContent = array();
//  $boxContent[] = BOX_HEADING_LOGIN_BOX_MY_ACCOUNT;
//  new infoBoxHeading($boxContent, false, false);
//  $boxContent = array();

  $boxContent = '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . LOGIN_BOX_MY_ACCOUNT . '</a><br>' .
                '<a href="' . tep_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL') . '">' . LOGIN_BOX_ACCOUNT_EDIT . '</a><br>' .
                '<a href="' . tep_href_link(FILENAME_ACCOUNT_HISTORY, '', 'SSL') . '">' . LOGIN_BOX_ACCOUNT_HISTORY . '</a><br>' .
				'<a href="' . tep_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL') . '">' . LOGIN_BOX_ADDRESS_BOOK . '</a><br>' .
				'<a href="' . tep_href_link(FILENAME_ACCOUNT_PASSWORD, '', 'SSL') . '">' . LOGIN_BOX_PASSWORD . '</a><br>' .
                '<a href="' . tep_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'NONSSL') . '">' . LOGIN_BOX_PRODUCT_NOTIFICATIONS . '</a><br>' .
				'<a href="' . tep_href_link(FILENAME_WISHLIST, '', 'SSL') . '">' . LOGIN_BOX_WISHLIST . '</a><br>' .
				'<a href="' . tep_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL') . '">' . LOGIN_BOX_NEWSLETTERS . '</a><br><br>' .
                '<a href="' . tep_href_link(FILENAME_LOGOFF, '', 'NONSSL') . '">' . LOGIN_BOX_LOGOFF . '</a><br><br>' . 
				'<a href="' . tep_href_link(FILENAME_DEFAULT, 'new_products=1', 'SSL') . '">' . LOGIN_BOX_PRODUCTS_NEW . '</a><br>' .
				'<a href="' . tep_href_link(FILENAME_DEFAULT, 'show_specials=1', 'SSL') . '">' . LOGIN_BOX_SPECIALS . '</a><br>';

 // new infoBox($boxContent);

 
 

include (bts_select('boxes', $box_base_name)); // BTS 1.5

?>
<!-- my_account_info eof //-->
<?php
  }
}

?>