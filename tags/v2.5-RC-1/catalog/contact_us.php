<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CONTACT_US);

// start modification for reCaptcha
if (RECAPTCHA_ON == 'true') {
  require_once('includes/classes/recaptchalib.php');
  $publickey = RECAPTCHA_PUBLIC_KEY;
  $privatekey = RECAPTCHA_PRIVATE_KEY;
}
// end modification for reCaptcha

// Adds functionality to have affiliate emails
  $source = $_GET['source'];

    $error = false;
  if (isset($_GET['action']) && ($_GET['action'] == 'send')) {
    $name = tep_db_prepare_input($_POST['name']);
    $email_address = tep_db_prepare_input($_POST['email']);
    $enquiry = tep_db_prepare_input($_POST['enquiry']);

// start modification for reCaptcha
if (RECAPTCHA_ON == 'true') {

	// the response from reCAPTCHA
    $resp = null;

	// was there a reCaptcha response?
    $resp = recaptcha_check_answer ($privatekey,
    $_SERVER["REMOTE_ADDR"],
    $_POST["recaptcha_challenge_field"],
    $_POST["recaptcha_response_field"]);
}
// end modification for reCaptcha


// BOF: Added
$_POST['email'] = preg_replace( "/\n/", " ", $_POST['email'] );
$_POST['name'] = preg_replace( "/\n/", " ", $_POST['name'] );
$_POST['email'] = preg_replace( "/\r/", " ", $_POST['email'] );
$_POST['name'] = preg_replace( "/\r/", " ", $_POST['name'] );
$_POST['email'] = str_replace("Content-Type:","",$_POST['email']);
$_POST['name'] = str_replace("Content-Type:","",$_POST['name']);
// EOF: Added

  $error = false;
  if (isset($_GET['action']) && ($_GET['action'] == 'send')) {
    $name = tep_db_prepare_input($_POST['name']);
    $email_address = tep_db_prepare_input($_POST['email']);
    $enquiry = tep_db_prepare_input($_POST['enquiry']);
  }

 // BOF: Remove blank emails
// if (tep_validate_email($email_address)) {
// tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT, $enquiry, $name, $email_address);
// tep_redirect(tep_href_link(FILENAME_CONTACT_US, 'action=success'));
// } else {
// $error = true;
// $messageStack->add('contact', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    if (! tep_validate_email($email_address)) {
        $error = true;
        $messageStack->add('contact', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }
    if ($enquiry == '') {
        $error = true;
        $messageStack->add('contact', ENTRY_EMAIL_CONTENT_CHECK_ERROR);
    }

// start modification for reCaptcha
if (RECAPTCHA_ON == 'true') {
	if (!$resp->is_valid) { 
	    $error = true;
        $messageStack->add('contact', ENTRY_SECURITY_CHECK_ERROR . " (reCAPTCHA output: " . $resp->error . ")");
    }
}
// end modification for reCaptcha

    if ($error == false) {
	  if ($source == 'affiliate') {
		tep_mail(STORE_OWNER, AFFILIATE_EMAIL_ADDRESS, EMAIL_SUBJECT, $enquiry, $name, $email_address);
	  } else {
        tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT, $enquiry, $name, $email_address);
	  }
      tep_redirect(tep_href_link(FILENAME_CONTACT_US, 'action=success'));
// EOF: Remove blank emails
    }
  }  

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CONTACT_US));

  $content = CONTENT_CONTACT_US;

  include (bts_select('main')); // BTSv1.5


  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>