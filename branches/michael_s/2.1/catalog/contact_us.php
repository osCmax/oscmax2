<?php
/*
$Id: contact_us.php 8 2006-06-22 02:48:59Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_CONTACT_US);

// BOF: Added
$_POST['email'] = preg_replace( "/\n/", " ", $_POST['email'] );
$_POST['name'] = preg_replace( "/\n/", " ", $_POST['name'] );
$_POST['email'] = preg_replace( "/\r/", " ", $_POST['email'] );
$_POST['name'] = preg_replace( "/\r/", " ", $_POST['name'] );
$_POST['email'] = str_replace("Content-Type:","",$_POST['email']);
$_POST['name'] = str_replace("Content-Type:","",$_POST['name']);
// EOF: Added

  $error = false;
  if (isset($HTTP_GET_VARS['action']) && ($HTTP_GET_VARS['action'] == 'send')) {
    $name = tep_db_prepare_input($HTTP_POST_VARS['name']);
    $email_address = tep_db_prepare_input($HTTP_POST_VARS['email']);
    $enquiry = tep_db_prepare_input($HTTP_POST_VARS['enquiry']);


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

    if ($error == false) {
      tep_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_SUBJECT, $enquiry, $name, $email_address);
      tep_redirect(tep_href_link(FILENAME_CONTACT_US, 'action=success'));
// EOF: Remove blank emails
    }
  }

  $breadcrumb->add(NAVBAR_TITLE, tep_href_link(FILENAME_CONTACT_US));

  $content = CONTENT_CONTACT_US;

  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
