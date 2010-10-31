<?php
/*
$Id: contact_us.php 7 2006-06-22 02:48:30Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Contact Us');
define('NAVBAR_TITLE', 'Contact Us');
define('TEXT_SUCCESS', 'Your enquiry has been successfully sent to the Store Owner.');
define('EMAIL_SUBJECT', 'Enquiry from ' . STORE_NAME);

define('ENTRY_NAME', 'Full Name:');
define('ENTRY_EMAIL', 'E-Mail Address:');
define('ENTRY_ENQUIRY', 'Enquiry:');

define('ENTRY_EMAIL_CONTENT_CHECK_ERROR', 'Missing content, please type a message.');
define('ENTRY_SECURITY_CHECK', 'Security Check:');
define('ENTRY_SECURITY_CHECK_ERROR', 'The Security Check code wasn\'t typed correctly. Try again.');
define('INSTRUCTIONS_TEXT', 'Please feel free to use this form to get in touch with us or you can contact us using the details shown on the right.');
define('SECURITY_PROMPT', 'Please complete the <b>security question</b> shown to the right -->');
define('CONTACT_INFORMATION', '
                <b>YourStore Opening Hours:</b><br />
				We are open Monday to Thursday from 9.00am to 4.30pm and Fridays from 9.00am to 12.30pm.
				<br /><br />
                <b>Email us: </b><br />email@yourstore.com<br /><br />
                <b>Phone us: </b><br />01234 567 890<br /><br />
                <b>Write to us: </b>
				<br /><br />
                Address Line 1<br />
                Address Line 2<br />
                City<br />
                State<br />');

define('REASON_1', 'Sales');
define('REASON_2', 'Support');
define('REASON_3', 'Delivery');
define('REASON_4', 'Returns');
define('REASON_5', 'Marketing');
define('REASON_6', 'Other');
?>