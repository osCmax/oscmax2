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
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_WISHLIST);

if (RECAPTCHA_ON == 'true') {

  // start modification for reCaptcha
  require_once('includes/classes/recaptchalib.php');
  $publickey = RECAPTCHA_PUBLIC_KEY;
  $privatekey = RECAPTCHA_PRIVATE_KEY;
  // end modification for reCaptcha
  
  	
	// start modification for reCaptcha
    // the response from reCAPTCHA
    $resp = null;

    // was there a reCAPTCHA response?
    $resp = recaptcha_check_answer ($privatekey,
    $_SERVER["REMOTE_ADDR"],
    (isset($_POST["recaptcha_challenge_field"]) ? $_POST["recaptcha_challenge_field"] : ''),
    (isset($_POST["recaptcha_response_field"]) ? $_POST["recaptcha_response_field"] : ''));
	
    // end modification for reCaptcha
}


/*******************************************************************
******* ADD PRODUCT TO WISHLIST IF PRODUCT ID IS REGISTERED ********
*******************************************************************/

  if(tep_session_is_registered('wishlist_id')) {
	$wishList->add_wishlist($wishlist_id, (isset($attributes_id) ? $attributes_id : ''));

	if(WISHLIST_REDIRECT == 'Yes') {
		tep_redirect(tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $wishlist_id));
	} else {
		tep_session_unregister('wishlist_id');
	}
  }


/*******************************************************************
****************** ADD PRODUCT TO SHOPPING CART ********************
*******************************************************************/

  // Check to see if any checkboxes were selected
  if(isset($_POST['add_prod_x']) && (!isset($_POST['add_wishprod']))) {
    $messageStack->add('wishlist', WISHLIST_NO_CHECKBOX_SELECTED_BUY, 'warning');
  }

  if (isset($_POST['add_wishprod'])) {
	if(isset($_POST['add_prod_x'])) {
		foreach ($_POST['add_wishprod'] as $value) {
			$product_id = tep_get_prid($value);
			$cart->add_cart($product_id, $cart->get_quantity(tep_get_uprid($product_id, $_POST['id'][$value]))+1, $_POST['id'][$value]);
		}
	}
  }


/*******************************************************************
****************** DELETE PRODUCT FROM WISHLIST ********************
*******************************************************************/
  
  // Check to see if any checkboxes were selected
  if(isset($_POST['delete_prod_x']) && (!isset($_POST['add_wishprod']))) {
    $messageStack->add('wishlist', WISHLIST_NO_CHECKBOX_SELECTED_DELETE, 'warning');
  }
  
  if (isset($_POST['add_wishprod'])) {
	if(isset($_POST['delete_prod_x'])) {
		foreach ($_POST['add_wishprod'] as $value) {
			$wishList->remove($value);
		}
	}
  }
  
/*******************************************************************
************* EMAIL THE WISHLIST TO MULTIPLE FRIENDS ***************
*******************************************************************/

  $errors = false;
  $guest_errors = "";
  $email_errors = "";
  $message_error = "";
  
  if (isset($_POST['email_prod_x'])) {

		if(strlen($_POST['message']) < '1') {
			$error = true;
			$message_error .= "<div class=\"messageStackError\"><img src=\"images/icons/error.gif\" /> " . ERROR_MESSAGE . "</div>";
		}			

  		if(tep_session_is_registered('customer_id')) {
			$customer_query = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customer_id . "'");
	  		$customer = tep_db_fetch_array($customer_query);
	
			$from_name = $customer['customers_firstname'] . ' ' . $customer['customers_lastname'];
			$from_email = $customer['customers_email_address'];
			$subject = $customer['customers_firstname'] . ' ' . WISHLIST_EMAIL_SUBJECT . STORE_NAME;
			$link = HTTP_SERVER . DIR_WS_CATALOG . FILENAME_WISHLIST_PUBLIC . "?public_id=" . $customer_id;
	
		//REPLACE VARIABLES FROM DEFINE
			$arr1 = array('$from_name', '$link');
			$arr2 = array($from_name, $link);
			$replace = str_replace($arr1, $arr2, WISHLIST_EMAIL_LINK);
			$message = tep_db_prepare_input($_POST['message']);
			$body = $message . $replace . "\n\n" . STORENAME;
		} else {
			if(strlen($_POST['your_name']) < '1') {
				$error = true;
				$guest_errors .= "<div class=\"messageStackError\"><img src=\"images/icons/error.gif\" /> " . ERROR_YOUR_NAME . "</div>";
			}
			if(strlen($_POST['your_email']) < '1') {
				$error = true;
				$guest_errors .= "<div class=\"messageStackError\"><img src=\"images/icons/error.gif\" /> " .ERROR_YOUR_EMAIL . "</div>";
			} elseif(!tep_validate_email($_POST['your_email'])) {
				$error = true;
				$guest_errors .= "<div class=\"messageStackError\"><img src=\"images/icons/error.gif\" /> " . ERROR_VALID_EMAIL . "</div>";
			}

			if (RECAPTCHA_ON == 'true') {
			// reCAPTCHA
			if (!$resp->is_valid) { 
	    		$error = true;
				$guest_errors .= "<div class=\"messageStackError\"><img src=\"images/icons/error.gif\" /> " .  WISHLIST_SECURITY_CHECK_ERROR . " (reCAPTCHA output: " . $resp->error . ")</div>";
        	}
			// reCAPTCHA
			}

			$from_name = stripslashes($_POST['your_name']);
			$from_email = $_POST['your_email'];
			$subject = $from_name . ' ' . WISHLIST_EMAIL_SUBJECT . STORE_NAME;
			$message = stripslashes($_POST['message']);

			$z = 0;
			$prods = "";
			foreach($_POST['prod_name'] as $name) {
				$prods .= stripslashes($name) . "  " . stripslashes($_POST['prod_att'][$z]) . "\n" . $_POST['prod_link'][$z] . "\n\n";
				$z++;
			}
			$body = $message . "\n\n" . $prods . "\n\n" . WISHLIST_EMAIL_GUEST . "\n\n" . STORE_NAME;
	  	}

		//Check each posted name => email for errors.
    $j = 0;
    foreach($_POST['friend'] as $friendx) {
    // secure post
    $friendx = strip_tags($friendx);

    if($j == 0) {
    $friend = $_POST['friend'];

    // secure posts
    $x = 0;
    foreach ($friend as $value) {
        $friend[$x] = strip_tags($value);
        $x++;
     }

    $email = $_POST['email'];
    $x = 0;
    foreach ($email as $value) {
    $email[$x] = strip_tags($value);
    $x++;
   }


				if($friend[0] == '' && $email[0] == '') {
					$error = true;
					$email_errors .= "<div class=\"messageStackError\"><img src=\"images/icons/error.gif\" /> " . ERROR_ONE_EMAIL . "</div>";
				}
			}

			if(isset($friendx) && $friendx != '') {
				if(strlen($email[$j]) < '1') {
					$error = true;
					$email_errors .= "<div class=\"messageStackError\"><img src=\"images/icons/error.gif\" /> " . ERROR_ENTER_EMAIL . "</div>";
				} elseif(!tep_validate_email($email[$j])) {
					$error = true;
					$email_errors .= "<div class=\"messageStackError\"><img src=\"images/icons/error.gif\" /> " . ERROR_VALID_EMAIL . "</div>";
				}
			}

			if(isset($email[$j]) && $email[$j] != '') {
				if(strlen($friendx) < '1') {
					$error = true;
					$email_errors .= "<div class=\"messageStackError\"><img src=\"images/icons/error.gif\" /> " . ERROR_ENTER_NAME . "</div>";
				}
			}
			$j++;
		}
		if($error == false) {
			$j = 0;
			foreach($_POST['friend'] as $friendx) {
				if($friendx != '') {
					tep_mail($friendx, $email[$j], $subject, $friendx . ",\n\n" . $body, $from_name, $from_email);
				}

			//Clear Values
				$friend[$j] = "";
				$email[$j] = "";
				$message = "";

				$j++;
			}

        	$messageStack->add('wishlist', WISHLIST_SENT, 'success');
		}
  }



  $breadcrumb->add(HEADING_TITLE, tep_href_link(FILENAME_WISHLIST, '', 'NONSSL'));

  $content = CONTENT_WISHLIST;

  include (bts_select('main')); // BTSv1.5



  require(DIR_WS_INCLUDES . 'application_bottom.php'); 
  
?>