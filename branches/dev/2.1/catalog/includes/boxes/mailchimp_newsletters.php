<?php
/*
$Id: mailchimp.php $

osCmax e-Commerce
http://www.osCmax.com

Copyright 2000 - 2010 osCmax

Released under the GNU General Public License
*/

if ((!strstr($_SERVER['PHP_SELF'],'login.php')) && (!strstr($_SERVER['PHP_SELF'],'create_account.php')) && (!strstr($_SERVER['PHP_SELF'],'Order_Info.php')) && (!strstr($_SERVER['PHP_SELF'],'Order_Info_Process.php')) && (!tep_session_is_registered('customer_id'))) {

if (!tep_session_is_registered('customer_id')) {
		
  $boxHeading = BOX_HEADING_MAILCHIMP;
  $corner_top_left = 'rounded';
  $corner_top_right = 'rounded';
  $corner_bottom_left = 'rounded';
  $corner_bottom_right = 'rounded';
  
  $boxContent_attributes = ' align="left"';
  $boxLink = '';
  $box_base_name = 'mailchimp'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
?>
<!-- mailchimp bof //-->
<?php
    $boxContent = MAILCHIMP_INTRO_TEXT;
	$boxContent .= '<br><center><form action="' . MAILCHIMP_URL . '?method="post">';
	$boxContent .= tep_draw_input_field('EMAIL', '', 'size="10" maxlength="100" style="width: ' . (BOX_WIDTH-10) . 'px"') . '<br>';
	$boxContent .= tep_draw_radio_field('EMAILTYPE', 'html', true) . '&nbsp;&nbsp;' . MAILCHIMP_HTML . '&nbsp;&nbsp;' . tep_draw_radio_field('EMAILTYPE', 'text', false) . '&nbsp;&nbsp;' . MAILCHIMP_TEXT;
	$boxContent .= '<table width="100%"><tr><td align="center">' . tep_image_submit('button_subscribe.gif', IMAGE_BUTTON_SUBSCRIBE) . '</td></tr></table>';
	$boxContent .= '<input type="hidden" name="id" value="' . MAILCHIMP_ID . '">';
	$boxContent .= '<input type="hidden" name="u" value="' . MAILCHIMP_U . '">';
	$boxContent .= '</form></center>';
  
//  } else {
  // If you want to display anything when the user IS logged in, put it
  // in here...  Possibly a "You are logged in as :" box or something.
  
include (bts_select('boxes', $box_base_name)); // BTS 1.5
 }
 
?>
<!-- mailchimp_eof //-->
<?php 
} else {

?>

<?php


// WebMakers.com Added: My Account Info Box (but not for PWA clients
  
  if ((tep_session_is_registered('customer_id')) && (!tep_session_is_registered('noaccount'))) {
  
?>
<!-- mailchimp //-->
<?php

  $boxHeading = BOX_HEADING_MAILCHIMP;
  $corner_top_left = 'rounded';
  $corner_top_right = 'rounded';
  $corner_bottom_left = 'rounded';
  $corner_bottom_right = 'rounded';
  
  $boxContent_attributes = ' align="center"';
  $boxLink = '';
  $box_base_name = 'mailchimp'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
  
  $mailchimp_query = tep_db_query("select customers_newsletter from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
  $mailchimp = tep_db_fetch_array($mailchimp_query);
    if ($mailchimp['customers_newsletter'] == 1) {
		$boxContent = MAILCHIMP_INTRO_TEXT_SUBSCRIBED;
		$boxContent .= '<table width="100%"><tr><td align="center"><a href="' . tep_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '') . '">' . tep_image_button('button_unsubscribe.gif', IMAGE_BUTTON_UNSUBSCRIBE) . '</a></td></tr></table>';
	} else {
		$boxContent = MAILCHIMP_INTRO_TEXT_UNSUBSCRIBED;
		$boxContent .= '<br>' . tep_draw_form('mailchimp', tep_href_link(MAILCHIMP_URL, 'action=post'));
	    $boxContent .= BOX_LOGINBOX_EMAIL . '<br>' . tep_draw_input_field('EMAIL', '', 'size="10" maxlength="100" style="width: ' . (BOX_WIDTH-10) . 'px"') . '<br>';
	    $boxContent .= tep_draw_radio_field('EMAILTYPE', 'html', true) . '&nbsp;&nbsp;' . MAILCHIMP_HTML . '&nbsp;&nbsp;' . tep_draw_radio_field('EMAILTYPE', 'text', false) . '&nbsp;&nbsp;' . MAILCHIMP_TEXT;
	    $boxContent .= '<table width="100%"><tr><td align="center">' . tep_image_submit('button_subscribe.gif', IMAGE_BUTTON_SUBSCRIBE) . '</td></tr></table>';
	    $boxContent .= '</form>';
	} // end if

include (bts_select('boxes', $box_base_name)); // BTS 1.5

?>
<!-- mailchimp eof //-->
<?php
  }
}

?>