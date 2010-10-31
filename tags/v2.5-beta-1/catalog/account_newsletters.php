<?php
/*
$Id: account_newsletters.php 3 2006-05-27 04:59:07Z user $

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

  if (!tep_session_is_registered('customer_id')) {
    $navigation->set_snapshot();
    tep_redirect(tep_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

// needs to be included earlier to set the success message in the messageStack
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ACCOUNT_NEWSLETTERS);

  $newsletter_query = tep_db_query("select customers_newsletter, customers_email_address, customers_newsletter_type from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
  $newsletter = tep_db_fetch_array($newsletter_query);

  if (isset($_POST['action']) && ($_POST['action'] == 'process')) {
    if (isset($_POST['newsletter_general']) && is_numeric($_POST['newsletter_general'])) {
      $newsletter_general = tep_db_prepare_input($_POST['newsletter_general']);
    } else {
      $newsletter_general = '0';
    }

    if ($newsletter_general != $newsletter['customers_newsletter']) {
      $newsletter_general = (($newsletter['customers_newsletter'] == '1') ? '0' : '1');

      tep_db_query("update " . TABLE_CUSTOMERS . " set customers_newsletter = '" . (int)$newsletter_general . "' where customers_id = '" . (int)$customer_id . "'");
	  
	  //Mail Chimp
	  if (MAILCHIMP_ENABLE == true) {
      require_once DIR_WS_CLASSES . 'MCAPI.class.php';
      require DIR_WS_FUNCTIONS . 'mailchimp_functions.php';

	  $api = new MCAPI(MAILCHIMP_API);
	  $list_id = MAILCHIMP_ID;
	  $email_address = $newsletter['customers_email_address'];
	  $email_format = $newsletter['customers_newsletter_type'];

	    if ($newsletter['customers_newsletter'] == '1') {
		  //unsubscribe
	      $retval = $api->listUnsubscribe($list_id, $email_address, MAILCHIMP_DELETE, MAILCHIMP_SEND_GOODBYE, MAILCHIMP_SEND_NOTIFY);
	    } else {
		  //subscribe
 	      $merge_vars = array('');
          if ($email_format == 'TEXT') {
            $format = 'text'; 
          } else {
            $format = 'html'; 
          }
          $retval = $api->listSubscribe($list_id, $email_address, $merge_vars, $format, MAILCHIMP_OPT_IN, true);
		} // end if
	  } // end if MAILCHIMP_ENABLE
	  
    } // end if

    $messageStack->add_session('account', SUCCESS_NEWSLETTER_UPDATED, 'success');

    tep_redirect(tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  }

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ACCOUNT, '', 'SSL'));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ACCOUNT_NEWSLETTERS, '', 'SSL'));

  $content = CONTENT_ACCOUNT_NEWSLETTERS;
  $javascript = $content . '.js';

  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
