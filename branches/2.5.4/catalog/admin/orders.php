<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
//---PayPal WPP Modification START ---//
  //Since the admin's configure.php file is STILL missing defines
  include(DIR_FS_CATALOG . DIR_WS_INCLUDES . 'configure.php');
  require(DIR_WS_CLASSES . 'order.php');
  
  // *** BEGIN GOOGLE CHECKOUT ***
  if (defined('MODULE_PAYMENT_GOOGLECHECKOUT_STATUS') && MODULE_PAYMENT_GOOGLECHECKOUT_STATUS == 'True') {
  require_once(DIR_FS_CATALOG . 'googlecheckout/inserts/admin/orders1.php');
  }
  // *** END GOOGLE CHECKOUT ***
// BOF: Orders search by customer information

// search query (oid, customer or company)
$search_query = null;
if ( isset($_GET['q']) && $_GET['q']!="" ) { // query is set in address
  $search_query = $_GET['q'];
  if ( (preg_match("/^\d+$/",$search_query)) && (strpos($search_query, " ") !== true) ) { // oid
    // show given order
    tep_redirect(tep_href_link(FILENAME_ORDERS, 'oID=' . $search_query . '&action=edit'));
    exit;
  } else { // name (customer or company)
    $q_array = explode(' ', ($search_query));
    $q_customer = '(o.customers_name LIKE \'%' . $q_array[0] . '%\'';
    $q_company = '(o.customers_company LIKE \'%' . $q_array[0] . '%\'';
	$q_orderno = '(o.orders_id LIKE \'%' . $q_array[0] . '%\'';
    // more than one search term
    for ($i = 1 ; $i < sizeof($q_array) ; $i++) {
      $q_customer .= ' OR o.customers_name LIKE \'%' . $q_array[$i] . '%\'';
      $q_company .= ' OR o.customers_company LIKE \'%' . $q_array[$i] . '%\'';
	  $q_orderno .= ' OR o.orders_id LIKE \'%' . $q_array[$i] . '%\'';
    }
    $q_customer .= ')';
    $q_company .= ')';
	$q_orderno .= ')';
    $search_query = ' AND (' . $q_customer . ' OR ' . $q_company . ' OR ' . $q_orderno . ')';
  }
} // ends if ($search_query = $_GET['q'])

// EOF: Orders search by customer information

  $oID = (isset($_GET['oID']) ? $_GET['oID'] : '');
  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  $pdf_check = (isset($_GET['pdf_check']) ? $_GET['pdf_check'] : '');
  
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();
  
  include(DIR_WS_INCLUDES . 'paypal_wpp/paypal_wpp_include.php');
  $paypal_wpp = new paypal_wpp_admin;
//---PayPal WPP Modification END ---//

  $orders_statuses = array();
  $orders_status_array = array();
  $orders_status_query = tep_db_query("select orders_status_id, orders_status_name from " . TABLE_ORDERS_STATUS . " where language_id = '" . (int)$languages_id . "'");
  while ($orders_status = tep_db_fetch_array($orders_status_query)) {
    $orders_statuses[] = array('id' => $orders_status['orders_status_id'],
                               'text' => $orders_status['orders_status_name']);
    $orders_status_array[$orders_status['orders_status_id']] = $orders_status['orders_status_name'];
  }


  if (tep_not_null($pdf_check)) {
	define('BATCH_PRINT_INC', DIR_WS_MODULES . 'batch_print/');
    define('BATCH_PDF_DIR', BATCH_PRINT_INC . 'temp_pdf/');
    define('BATCH_PRINT_FILE', 'batch_print.php');
    define('BATCH_PDF_FILE', 'batch_orders.pdf');

    require_once (DIR_WS_CLASSES . 'order.php');
	require (DIR_WS_FUNCTIONS . 'batch_print.php');
	
	$orders_query = tep_db_query("select o.orders_id from " . TABLE_ORDERS . " o where o.orders_id = '" . $oID . "'");
	
	$pageloop = "1";
    
	    include(DIR_WS_LANGUAGES . $language . '/batch_print.php');
        require(DIR_WS_MODULES . 'batch_print/class.ezpdf.php');
		$pdf = new Cezpdf(A4,portrait);

          while ($orders = tep_db_fetch_array($orders_query)) {
            $order = new order($orders['orders_id']);
			switch ($pdf_check) {
              case 'invoice':
                require(DIR_WS_MODULES . 'batch_print/templates/Invoice_s3.php');
			  break;
			  case 'packingslip':
                require(DIR_WS_MODULES . 'batch_print/templates/Packing-Slip.php');
			  break;
			  default:
			  break;
			} // end switch
		  } // end while
		  
		$pdf_code = $pdf->output();
		       
	    $fname = BATCH_PDF_DIR . BATCH_PDF_FILE;
        if ($fp = fopen($fname,'w')) {
          fwrite($fp, $pdf_code);
          fclose($fp);
        } // end if

        tep_redirect(tep_href_link(DIR_WS_MODULES . 'batch_print/temp_pdf/batch_orders.pdf', '', 'NONSSL', false));

  } // end if pdf
	  
  if (tep_not_null($action)) {
    switch ($action) {
      case 'update_order':
        $oID = tep_db_prepare_input($_GET['oID']);
        $status = tep_db_prepare_input($_POST['status']);
        $comments = tep_db_prepare_input($_POST['comments']);

        $order_updated = false;
        $check_status_query = tep_db_query("select customers_name, customers_email_address, orders_status, date_purchased from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");
        $check_status = tep_db_fetch_array($check_status_query);

// BOF: MOD - Downloads Controller
// always update date and time on order_status
// original        if ( ($check_status['orders_status'] != $status) || tep_not_null($comments)) {
                   if ( ($check_status['orders_status'] != $status) || $comments != '' || ($status == DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE) ) {
          tep_db_query("update " . TABLE_ORDERS . " set orders_status = '" . tep_db_input($status) . "', last_modified = now() where orders_id = '" . (int)$oID . "'");
        $check_status_query2 = tep_db_query("select customers_name, customers_email_address, orders_status, date_purchased from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");
        $check_status2 = tep_db_fetch_array($check_status_query2);
      if ( $check_status2['orders_status']==DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE ) {
        tep_db_query("update " . TABLE_ORDERS_PRODUCTS_DOWNLOAD . " set download_maxdays = '" . tep_get_configuration_key_value('DOWNLOAD_MAX_DAYS') . "', download_count = '" . tep_get_configuration_key_value('DOWNLOAD_MAX_COUNT') . "' where orders_id = '" . (int)$oID . "'");
      }
// EOF: MOD - Downloads Controller

          // *** BEGIN GOOGLE CHECKOUT ***
          if (defined('MODULE_PAYMENT_GOOGLECHECKOUT_STATUS') && MODULE_PAYMENT_GOOGLECHECKOUT_STATUS == 'True') {
          require_once(DIR_FS_CATALOG . 'googlecheckout/inserts/admin/orders2.php');
          } else {
          // *** END GOOGLE CHECKOUT ***
          $customer_notified = '0';
          if (isset($_POST['notify']) && ($_POST['notify'] == 'on')) {
            $notify_comments = '';
            if (isset($_POST['notify_comments']) && ($_POST['notify_comments'] == 'on') && (strlen($comments) > 0)) {
              $notify_comments = sprintf(EMAIL_TEXT_COMMENTS_UPDATE, $comments) . "\n\n";
            }

            $email = STORE_NAME . "\n" . EMAIL_SEPARATOR . "\n" . EMAIL_TEXT_ORDER_NUMBER . ' ' . $oID . "\n" . EMAIL_TEXT_INVOICE_URL . ' ' . tep_catalog_href_link(FILENAME_CATALOG_ACCOUNT_HISTORY_INFO, 'order_id=' . $oID, 'SSL') . "\n" . EMAIL_TEXT_DATE_ORDERED . ' ' . tep_date_long($check_status['date_purchased']) . "\n\n" . $notify_comments . sprintf(EMAIL_TEXT_STATUS_UPDATE, $orders_status_array[$status]);

            tep_mail($check_status['customers_name'], $check_status['customers_email_address'], EMAIL_TEXT_SUBJECT, $email, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);

            $customer_notified = '1';
          }
         }
          tep_db_query("insert into " . TABLE_ORDERS_STATUS_HISTORY . " (orders_id, orders_status_id, date_added, customer_notified, comments) values ('" . (int)$oID . "', '" . tep_db_input($status) . "', now(), '" . tep_db_input($customer_notified) . "', '" . tep_db_input($comments)  . "')");

          $order_updated = true;
        }

        if ($order_updated == true) {
         $messageStack->add_session(SUCCESS_ORDER_UPDATED, 'success');
        } else {
          $messageStack->add_session(WARNING_ORDER_NOT_UPDATED, 'warning');
        }

        tep_redirect(tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array('action')) . 'action=edit'));
        break;
      case 'deleteconfirm':
        $oID = tep_db_prepare_input($_GET['oID']);

        tep_remove_order($oID, $_POST['restock']);

        tep_redirect(tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array('oID', 'action'))));
        break;
    }
  }

  if (($action == 'edit') && isset($_GET['oID'])) {
    $oID = tep_db_prepare_input($_GET['oID']);

    $orders_query = tep_db_query("select orders_id from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");
    $order_exists = true;
    if (!tep_db_num_rows($orders_query)) {
      $order_exists = false;
      $messageStack->add(sprintf(ERROR_ORDER_DOES_NOT_EXIST, $oID), 'error');
    }
  }
// BOF: MOD - Downloads Controller - Extra order info
// Look up things in orders
  $the_extra_query= tep_db_query("select * from " . TABLE_ORDERS . " where orders_id = '" . (int)$oID . "'");
  $the_extra= tep_db_fetch_array($the_extra_query);
  $the_customers_id= $the_extra['customers_id'];
// Look up things in customers
  $the_extra_query= tep_db_query("select * from " . TABLE_CUSTOMERS . " where customers_id = '" . $the_customers_id . "'");
  $the_extra= tep_db_fetch_array($the_extra_query);
  $the_customers_fax= $the_extra['customers_fax'];
// EOF: MOD - Downloads Controller - Extra order info
  //---PayPal WPP Modification START ---//
  //include(DIR_WS_CLASSES . 'order.php');
  //---PayPal WPP Modification END ---//
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/javascript/jquery-ui-1.8.2.custom.css">
<script type="text/javascript" src="includes/general.js"></script>
<?php 
  //---PayPal WPP Modification START ---//
  $paypal_wpp->add_javascript();
  //---PayPal WPP Modification END ---//
?>
</head>
<body onLoad="document.search_orders.q.focus()">
<!-- header //-->
<?php
  require(DIR_WS_INCLUDES . 'header.php');
?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
  if (($action == 'edit') && ($order_exists == true)) {
    $order = new order($oID);
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <!-- PWA BOF -->
            <td class="pageHeading"><?php echo HEADING_TITLE . (($order->customer['is_dummy_account'])? ' <b>no account!</b>':''); ?></td>
            <!-- PWA EOF -->
            <td class="pageHeading" align="right">&nbsp;</td>

            <td class="pageHeading" align="right"><?php if( $nextid = get_order_id($oID,'prev')) { echo '<a href="' .tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array('oID', 'action')) . 'oID=' . $nextid . '&action=edit') . '">' . tep_image(DIR_WS_ICONS . 'prev.gif', IMAGE_PREV_ORDER) . '</a>&nbsp;'; } ?><?php if( $previd = get_order_id($oID)) echo '<a href="' .tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array('oID', 'action')) . 'oID=' . $previd . '&action=edit') . '">' . tep_image(DIR_WS_ICONS . 'next.gif', IMAGE_NEXT_ORDER) . '</a>&nbsp;'; ?><?php echo '<a href="' . tep_href_link(FILENAME_ORDERS_EDIT, 'oID=' . $_GET['oID']) . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_ORDERS_INVOICE, 'oID=' . $_GET['oID']) . '" TARGET="_blank">' . tep_image_button('button_invoice.gif', IMAGE_ORDERS_INVOICE) . '</a> <a href="' . tep_href_link(FILENAME_ORDERS_PACKINGSLIP, 'oID=' . $_GET['oID']) . '" TARGET="_blank">' . tep_image_button('button_packingslip.gif', IMAGE_ORDERS_PACKINGSLIP) . '</a> <a href="' . tep_href_link(FILENAME_ORDERS, 'pdf_check=invoice&amp;oID=' . $_GET['oID']) . '" target="_blank">' . tep_image_button('button_invoice_pdf.gif', IMAGE_ORDERS_INVOICE) . '</a> <a href="' . tep_href_link(FILENAME_ORDERS, 'pdf_check=packingslip&amp;oID=' . $_GET['oID']) . '" target="_blank">' . tep_image_button('button_packingslip_pdf.gif', IMAGE_ORDERS_PACKINGSLIP) . '</a> <a href="' . tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array('action'))) . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a> '; ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table width="100%" border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td colspan="3"><?php echo tep_draw_separator(); ?></td>
          </tr>
          <tr>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top" width="200"><b><?php echo ENTRY_CUSTOMER; ?></b></td>
                <td class="main"><?php echo tep_address_format($order->customer['format_id'], $order->customer, 1, '', '<br>'); ?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
              </tr>
              <tr>
                <td class="main"><b><?php echo ENTRY_TELEPHONE_NUMBER; ?></b></td>
                <td class="main"><?php echo $order->customer['telephone']; ?></td>
              </tr>
<?php
// BOF: MOD - Downloads Controller - Extra order info
?>
              <tr>
                <td class="main"><b><?php echo ENTRY_FAX_NUMBER; ?></b></td>
                <td class="main"><?php echo $the_customers_fax; ?></td>
              </tr>
<?php
// EOF: MOD - Downloads Controller - Extra order info
?>
              <tr>
                <td class="main"><b><?php echo ENTRY_EMAIL_ADDRESS; ?></b></td>
                <td class="main"><?php echo '<a href="mailto:' . $order->customer['email_address'] . '"><u>' . $order->customer['email_address'] . '</u></a>'; ?></td>
              </tr>
            </table></td>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top"><b><?php echo ENTRY_SHIPPING_ADDRESS; ?></b></td>
                <td class="main"><?php echo tep_address_format($order->delivery['format_id'], $order->delivery, 1, '', '<br>'); ?></td>
              </tr>
            </table></td>
            <td valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
              <tr>
                <td class="main" valign="top"><b><?php echo ENTRY_BILLING_ADDRESS; ?></b></td>
                <td class="main"><?php echo tep_address_format($order->billing['format_id'], $order->billing, 1, '', '<br>'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="2">
<?php
// BOF: MOD - Downloads Controller - Extra order info
?>
<!-- add Order # // -->
      <tr>
        <td class="main" width="200"><b><?php echo TEXT_ORDER_ID; ?></b></td>
        <td class="main"><?php echo tep_db_input($oID); ?></td>
      </tr>
<!-- add date/time // -->
      <tr>
        <td class="main"><b><?php echo TEXT_ORDER_DATE_TIME; ?></b></td>
        <td class="main"><?php echo tep_datetime_short($order->info['date_purchased']); ?></td>
      </tr>
<?php
// EOF: MOD - Downloads Controller - Extra order info
?>
          <tr>
            <td class="main"><b><?php echo ENTRY_PAYMENT_METHOD; ?></b></td>
            <td class="main"><?php echo $order->info['payment_method']; ?></td>
          </tr>
<!-- ship date -->
          <tr>
            <td class="main"><b><?php echo DELIVERY_DATE; ?></b></td>
            <td class="main"><?php echo tep_date_long($order->info['delivery_date']); ?></td>
          </tr>
<!-- ship date -->
<?php
    if (tep_not_null($order->info['cc_type']) || tep_not_null($order->info['cc_owner']) || tep_not_null($order->info['cc_number'])) {
?>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_CREDIT_CARD_TYPE; ?></td>
            <td class="main"><?php echo $order->info['cc_type']; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_CREDIT_CARD_OWNER; ?></td>
            <td class="main"><?php echo $order->info['cc_owner']; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_CREDIT_CARD_NUMBER; ?></td>
            <td class="main"><?php echo $order->info['cc_number']; ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_CREDIT_CARD_EXPIRES; ?></td>
            <td class="main"><?php echo $order->info['cc_expires']; ?></td>
          </tr>
<?php
    }
?>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" colspan="2"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS_MODEL; ?></td>
            <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_TAX; ?></td>
            <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_PRICE_EXCLUDING_TAX; ?></td>
            <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_PRICE_INCLUDING_TAX; ?></td>
            <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_TOTAL_EXCLUDING_TAX; ?></td>
            <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_TOTAL_INCLUDING_TAX; ?></td>
          </tr>
<?php
    for ($i=0, $n=sizeof($order->products); $i<$n; $i++) {
      echo '          <tr class="dataTableRow">' . "\n" .
           '            <td class="dataTableContent" valign="top" align="right">' . $order->products[$i]['qty'] . '&nbsp;x</td>' . "\n" .
           '            <td class="dataTableContent" valign="top">' . $order->products[$i]['name'];

      if (isset($order->products[$i]['attributes']) && (sizeof($order->products[$i]['attributes']) > 0)) {
        for ($j = 0, $k = sizeof($order->products[$i]['attributes']); $j < $k; $j++) {
          echo '<br><nobr><small>&nbsp;<i> - ' . $order->products[$i]['attributes'][$j]['option'] . ': ' . $order->products[$i]['attributes'][$j]['value'];
          if ($order->products[$i]['attributes'][$j]['price'] != '0') echo ' (' . $order->products[$i]['attributes'][$j]['prefix'] . $currencies->format($order->products[$i]['attributes'][$j]['price'] * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ')';
          echo '</i></small></nobr>';
        }
      }
  // BOF: Attributes Product Codes - If product code exists, use it, else default to product model.
      echo '            </td>' . "\n";
      if(tep_not_null($order->products[$i]['code'])){
         echo '            <td class="dataTableContent" valign="top">' .  $order->products[$i]['code'] . '</td>' . "\n" ;
       } else {
         echo '            <td class="dataTableContent" valign="top">' .  $order->products[$i]['model'] . '</td>' . "\n" ;
       }
      echo '            <td class="dataTableContent" align="right" valign="top">' . tep_display_tax_value($order->products[$i]['tax']) . '%</td>' . "\n" .
  // EOF: Attributes Product Codes
           '            <td class="dataTableContent" align="right" valign="top"><b>' . $currencies->display_price($order->products[$i]['final_price'], 0, 1, $order->info['currency']) . '</b></td>' . "\n" .
           '            <td class="dataTableContent" align="right" valign="top"><b>' . $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], 1, $order->info['currency']) . '</b></td>' . "\n" .
           '            <td class="dataTableContent" align="right" valign="top"><b>' . $currencies->display_price($order->products[$i]['final_price'], 0, $order->products[$i]['qty'], $order->info['currency']) . '</b></td>' . "\n" .
           '            <td class="dataTableContent" align="right" valign="top"><b>' . $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty'], $order->info['currency']) . '</b></td>' . "\n";
      echo '          </tr>' . "\n";
    }
?>
          <tr>
            <td align="right" colspan="8"><table border="0" cellspacing="0" cellpadding="2">
<?php
    for ($i = 0, $n = sizeof($order->totals); $i < $n; $i++) {
      echo '              <tr>' . "\n" .
           '                <td align="right" class="smallText">' . $order->totals[$i]['title'] . '</td>' . "\n" .
           '                <td align="right" class="smallText">' . $order->totals[$i]['text'] . '</td>' . "\n" .
           '              </tr>' . "\n";
    }
?>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo TABLE_HEADING_COMMENTS; ?></b></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
<?php 
  //---PayPal WPP Modification START ---//
  $paypal_wpp->display_buttons($oID);
  //---PayPal WPP Modification END ---//
?>

<?php
	  $ias_notes_query = tep_db_query("SELECT DISTINCT customers_id, customers_notes_id, customers_notes_message, customers_notes_editor, customers_notes_date FROM customers_notes WHERE customers_id = " . $the_customers_id);
			if(!tep_db_num_rows($ias_notes_query)) { // No Comments Available 
			} else {
?>				
      <tr>
        <td class="main"><table border="0" cellspacing="0" cellpadding="5" width="100%">
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" width="150"><?php echo TABLE_HEADING_DATE_ADDED; ?></td>
            <td class="dataTableHeadingContent" width="150" align="center"><?php echo TABLE_HEADING_AUTHOR; ?></td>
            <td class="dataTableHeadingContent" width="180"><?php echo TABLE_HEADING_STATUS; ?></td>
            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CUSTOMER_COMMENTS; ?></td>
      <?php //---PayPal WPP Modification START ---// ?>
            <td class="smallText" align="center"><b><?php echo TABLE_HEADING_TRANSACTION_INFO; ?></b></td>
      <?php //---PayPal WPP Modification END ---// ?>
          </tr>
 <?php
 		function notedate($fdate) {
					list($year, $month, $day) = explode("-", $fdate);
					return sprintf("%02d-%02d-%04d", $month, $day, $year);
		} // end function
				
		while ($ias_notes = tep_db_fetch_array($ias_notes_query)) {
?>			
		  <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
		    <td class="smallText" align="center"><?php echo tep_date_short($ias_notes['customers_notes_date']); ?></td>
            <td class="smallText" align="center"><?php echo $ias_notes["customers_notes_editor"]; ?></td>
            <td class="smallText"><?php echo TEXT_ACTIVE; ?></td>
            <td class="smallText"><?php echo $ias_notes["customers_notes_message"]; ?></td>
            <td class="smallText"></td>
          </tr>  		
<?php		
		} // end while
?>
		</table></td>
        </tr>
 		<tr>
        	<td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      	</tr>
<?php
//---PayPal WPP Modification START ---//
    $orders_history_query = tep_db_query("select orders_status_history_id, orders_status_id, date_added, customer_notified, comments from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_id = '" . tep_db_input($oID) . "' order by date_added");
//---PayPal WPP Modification END ---//
	} // end if
?>
      <tr>
        <td class="main"><table border="0" cellspacing="0" cellpadding="5" width="100%">
          <tr class="dataTableHeadingRow">
            <td class="dataTableHeadingContent" width="150"><?php echo TABLE_HEADING_DATE_ADDED; ?></td>
            <td class="dataTableHeadingContent" width="150" align="center"><?php echo TABLE_HEADING_CUSTOMER_NOTIFIED; ?></td>
            <td class="dataTableHeadingContent" width="180"><?php echo TABLE_HEADING_STATUS; ?></td>
            <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ORDER_COMMENTS; ?></td>
            <td class="dataTableHeadingContent"></td>
          </tr>
<?php
    $orders_history_query = tep_db_query("select orders_status_id, date_added, customer_notified, comments from " . TABLE_ORDERS_STATUS_HISTORY . " where orders_id = '" . tep_db_input($oID) . "' order by date_added");
    if (tep_db_num_rows($orders_history_query)) {
      while ($orders_history = tep_db_fetch_array($orders_history_query)) {
        echo '          <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">' . "\n" .
             '            <td class="smallText" align="center">' . tep_datetime_short($orders_history['date_added']) . '</td>' . "\n" .
             '            <td class="smallText" align="center">';
        if ($orders_history['customer_notified'] == '1') {
          echo tep_image(DIR_WS_ICONS . 'tick.png', ICON_TICK) . "</td>\n";
        } else {
          echo tep_image(DIR_WS_ICONS . 'cross.png', ICON_CROSS) . "</td>\n";
        }
        echo '            <td class="smallText">' . $orders_status_array[$orders_history['orders_status_id']] . '</td>' . "\n" .
             '            <td class="smallText">' . nl2br(tep_db_output($orders_history['comments'])) . '&nbsp;</td>' . "\n" .
//---PayPal WPP Modification START ---//
             '            <td class="smallText">' . $paypal_wpp->get_transaction_info($orders_history['orders_status_history_id']) . '</td>' . "\n" .
//---PayPal WPP Modification END ---//
             '          </tr>' . "\n";
      }
    } else {
        echo '          <tr>' . "\n" .
             '            <td class="smallText" colspan="5">' . TEXT_NO_ORDER_HISTORY . '</td>' . "\n" .
             '          </tr>' . "\n";
    }
?>
        </table></td>
      </tr>
      <tr>
        <td class="main"><br><b><?php echo TABLE_HEADING_NEW_ORDER_COMMENTS; ?></b></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '5'); ?></td>
      </tr>
      <tr>
        <td class="main"><?php echo tep_draw_form('status', FILENAME_ORDERS, tep_get_all_get_params(array('action')) . 'action=update_order'); ?>
			<table border="0" cellspacing="0" cellpadding="5" width="100%">
            	<tr class="dataTableHeadingRow">
                	<td class="dataTableHeadingContent" width="150"></td>
                    <td class="dataTableHeadingContent" width="150" align="center"><?php echo ENTRY_NOTIFY_CUSTOMER; ?></td>
                    <td class="dataTableHeadingContent" width="180"><?php echo ENTRY_STATUS; ?></td>
                    <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_NEW_ORDER_COMMENTS; ?></td>
	            </tr>                    
            	<tr class="dataTableRow">
                	<td class="smallText"></td>
                    <td class="smallText" align="center"><?php echo tep_draw_checkbox_field('notify', '', true); ?></td>
                    <td class="smallText" align="center"><?php echo tep_draw_pull_down_menu('status', $orders_statuses, $order->info['orders_status']); ?></td>
                    <td class="smallText">
						<table width="100%">
							<tr>
								<td><?php echo tep_draw_textarea_field('comments', '50', '5'); ?></td>
                                <td>
                                	<table>
                                    	<tr>
                                        	<td valign="top">
<!-- BOF: Canned Comments -->
												<select name="responses" onChange="setMessage()">
													<option value=""><?php echo OPTION_SELECT_COMMENT; ?></option>
                                                    <option value="<?php echo $order->customer['name']; ?>"><?php echo OPTION_NAME_OF_CUSTOMER; ?></option>
													<?php
														$get_premades_query = tep_db_query("select * from " . TABLE_ORDERS_PREMADE_COMMENTS . " order by id");
														while($result = mysql_fetch_array($get_premades_query)) {
															echo '<option value="'.$result["text"].'">'. $result["title"].'</option>';
														}
													?>
												</select>
                                                <?php echo '<span title="' . HEADING_CANNED_COMMENTS_HELP . '|' . TEXT_CANNED_COMMENTS_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', 'Help'); ?></span>
<!-- EOF: Canned Comments -->
                                                                                                     
                                            </td>
                                        </tr>
                                    	<tr>
                                        	<td class="smallText"><b><?php echo ENTRY_NOTIFY_COMMENTS; ?></b> <?php echo tep_draw_checkbox_field('notify_comments', '', true); ?></td>
                                        </tr>
                                        <tr>
                                        	<td class="smallText" align="right"><?php echo tep_image_submit('button_update.gif', IMAGE_UPDATE); ?></td>
                                        </tr>
                                    </table>
                                </td>
                    		</tr>
						</table>
                     </td>
                 </tr>
            </table>
         </form></td>	
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
      </tr>
      <tr>
            <td colspan="3"><?php echo tep_draw_separator(); ?></td>
      </tr>
      <tr>
       <td colspan="2" align="right"><?php if( $nextid = get_order_id($oID,'prev')) { echo '<a href="' .tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array('oID', 'action')) . 'oID=' . $nextid . '&action=edit') . '">' . tep_image(DIR_WS_ICONS . 'prev.gif', IMAGE_PREV_ORDER) . '</a>&nbsp;'; } ?><?php if( $previd = get_order_id($oID)) echo '<a href="' .tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array('oID', 'action')) . 'oID=' . $previd . '&action=edit') . '">' . tep_image(DIR_WS_ICONS . 'next.gif', IMAGE_NEXT_ORDER) . '</a>&nbsp;'; ?><?php echo '<a href="' . tep_href_link(FILENAME_ORDERS_EDIT, 'oID=' . $_GET['oID']) . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_ORDERS_INVOICE, 'oID=' . $_GET['oID']) . '" TARGET="_blank">' . tep_image_button('button_invoice.gif', IMAGE_ORDERS_INVOICE) . '</a> <a href="' . tep_href_link(FILENAME_ORDERS_PACKINGSLIP, 'oID=' . $_GET['oID']) . '" TARGET="_blank">' . tep_image_button('button_packingslip.gif', IMAGE_ORDERS_PACKINGSLIP) . '</a> <a href="' . tep_href_link(FILENAME_ORDERS, 'pdf_check=invoice&amp;oID=' . $_GET['oID']) . '" target="_blank">' . tep_image_button('button_invoice_pdf.gif', IMAGE_ORDERS_INVOICE) . '</a> <a href="' . tep_href_link(FILENAME_ORDERS, 'pdf_check=packingslip&amp;oID=' . $_GET['oID']) . '" target="_blank">' . tep_image_button('button_packingslip_pdf.gif', IMAGE_ORDERS_PACKINGSLIP) . '</a> <a href="' . tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array('action'))) . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a> '; ?></td>
<!-- *** BEGIN GOOGLE CHECKOUT *** -->
<?php 
if (defined('MODULE_PAYMENT_GOOGLECHECKOUT_STATUS') && MODULE_PAYMENT_GOOGLECHECKOUT_STATUS == 'True') { 
require_once(DIR_FS_CATALOG . 'googlecheckout/inserts/admin/orders3.php');
}
?>
<!-- *** END GOOGLE CHECKOUT *** -->
      </tr>
<?php
  } else {
?>
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
            <td align="right">
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="smallText" align="right"><?php echo tep_draw_form('orders', FILENAME_ORDERS, '', 'get'); ?>
				  <?php
                  $onfocus=' onfocus="this.value=\'\';"';
                  // echo HEADING_TITLE_SEARCH_ALL . ' ' . tep_draw_input_field('q', '', "size=\"32\"$onfocus");
                  echo tep_hide_session_id(); 
				  ?>
                  </form></td>
                </tr>
                <tr>
                  <td class="smallText" align="right"><?php echo tep_draw_form('status', FILENAME_ORDERS, '', 'get'); ?><?php echo HEADING_TITLE_STATUS . ' ' . tep_draw_pull_down_menu('status', array_merge(array(array('id' => '', 'text' => TEXT_ALL_ORDERS)), $orders_statuses), '', 'onChange="this.form.submit();"'); ?><?php echo tep_hide_session_id(); ?></form></td>
                </tr>
              </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ORDER_NUM; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CUSTOMERS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ORDER_TOTAL; ?></td>
                <td></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_DATE_PURCHASED; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
    if (isset($_GET['cID'])) {
      $cID = tep_db_prepare_input($_GET['cID']);
//LINE CHANGED: MOD - fedex added "o.fedex_tracking"
// BOF: Orders search by customers info - Changed queries below - added " . (!is_null($search_query)?$search_query:''). "
      $orders_query_raw = "select o.orders_id, o.customers_name, o.customers_id, o.payment_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, o.fedex_tracking, ot.text as order_total from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.customers_id = '" . (int)$cID . "' and o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and ot.class = 'ot_total' order by orders_id DESC";
// LINE CHANGED: MS2 update 501112
//  } elseif (isset($_GET['status'])) {
    } elseif (isset($_GET['status']) && is_numeric($_GET['status']) && ($_GET['status'] > 0)) {
      $status = tep_db_prepare_input($_GET['status']);
//LINE CHANGED: MOD - fedex added "o.fedex_tracking"
      $orders_query_raw = "select o.orders_id, o.customers_name, o.payment_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, o.fedex_tracking, ot.text as order_total from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and s.orders_status_id = '" . (int)$status . "' and ot.class = 'ot_total'  " . (!is_null($search_query)?$search_query:''). " order by o.orders_id DESC";
    } else {
//LINE CHANGED: MOD - fedex added "o.fedex_tracking"
      $orders_query_raw = "select o.orders_id, o.customers_name, o.payment_method, o.date_purchased, o.last_modified, o.currency, o.currency_value, s.orders_status_name, o.fedex_tracking, ot.text as order_total from " . TABLE_ORDERS . " o left join " . TABLE_ORDERS_TOTAL . " ot on (o.orders_id = ot.orders_id), " . TABLE_ORDERS_STATUS . " s where o.orders_status = s.orders_status_id and s.language_id = '" . (int)$languages_id . "' and ot.class = 'ot_total' " . (!is_null($search_query)?$search_query:''). " order by o.orders_id DESC";
    }
// EOF: Orders search by customers info    
    $orders_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $orders_query_raw, $orders_query_numrows);
    $orders_query = tep_db_query($orders_query_raw);
    while ($orders = tep_db_fetch_array($orders_query)) {
    if ((!isset($_GET['oID']) || (isset($_GET['oID']) && ($_GET['oID'] == $orders['orders_id']))) && !isset($oInfo)) {
        $oInfo = new objectInfo($orders);
      }

      if (isset($oInfo) && is_object($oInfo) && ($orders['orders_id'] == $oInfo->orders_id)) {
        echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&amp;action=edit') . '\'">' . "\n";
      } else {
        echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array('oID')) . 'oID=' . $orders['orders_id']) . '\'">' . "\n";
      }
?>
				<td class="dataTableContent"><?php echo $orders['orders_id']; ?></td>
                <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array('oID', 'action')) . 'oID=' . $orders['orders_id'] . '&amp;action=edit') . '">' . tep_image(DIR_WS_ICONS . 'page_white_text.png', ICON_PREVIEW) . '</a>&nbsp;' . $orders['customers_name']; ?></td>
                <td class="dataTableContent" align="right"><?php echo strip_tags($orders['order_total']); ?></td>
                
                <?php // BOF: Orders quick viewer
				$order_viewer = "";
				$products_query = tep_db_query("SELECT orders_products_id, products_name, products_quantity, products_model FROM " . TABLE_ORDERS_PRODUCTS . " WHERE orders_id = '" . $orders['orders_id'] . "' ");
					while($products_rows = tep_db_fetch_array($products_query)) {
						$order_viewer .= ($products_rows["products_quantity"]) . "x ". $products_rows["products_model"]. "  " . (tep_html_noquote($products_rows["products_name"])) . "<br>";
						$result_attributes = tep_db_query("SELECT products_options, products_options_values FROM " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . " WHERE orders_id = '" . $orders['orders_id']. "' AND orders_products_id = '" . $products_rows["orders_products_id"] . "' ORDER BY products_options");
						while($row_attributes = tep_db_fetch_array($result_attributes)) {
							$order_viewer .=" - " . (tep_html_noquote($row_attributes["products_options"])) . ": " . (tep_html_noquote($row_attributes["products_options_values"])) . "<br>";
						}
					}			
				?>	
                
				<td><?php echo '<span title="' . TEXT_ORDER_SUMMARY . '|' . $order_viewer . '">' . tep_image(DIR_WS_ICONS . 'page_white_find.png'); ?></span></td>
                <?php // EOF: Orders quick viewer ?>
                
                <td class="dataTableContent" align="center"><?php echo tep_datetime_short($orders['date_purchased']); ?></td>
                <td class="dataTableContent" align="right"><?php echo $orders['orders_status_name']; ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($oInfo) && is_object($oInfo) && ($orders['orders_id'] == $oInfo->orders_id)) { echo tep_image(DIR_WS_ICONS . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array('oID')) . 'oID=' . $orders['orders_id']) . '">' . tep_image(DIR_WS_ICONS . 'information.png', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }
?>
              <tr>
                <td colspan="7"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $orders_split->display_count($orders_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_ORDERS); ?></td>
                    <td class="smallText" align="right"><?php echo $orders_split->display_links($orders_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], tep_get_all_get_params(array('page', 'oID', 'action'))); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_ORDER . '</b>');

      $contents = array('form' => tep_draw_form('orders', FILENAME_ORDERS, tep_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&amp;action=deleteconfirm'));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO . '<br><br><b>' . $cInfo->customers_firstname . ' ' . $cInfo->customers_lastname . '</b>');
      $contents[] = array('text' => '<br>' . tep_draw_checkbox_field('restock') . ' ' . TEXT_INFO_RESTOCK_PRODUCT_QUANTITY);
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (isset($oInfo) && is_object($oInfo)) {
        $heading[] = array('text' => '<b>[' . $oInfo->orders_id . ']&nbsp;&nbsp;' . tep_datetime_short($oInfo->date_purchased) . '</b>');

// BOF: MOD - FedEx 
// first determine whether this is on the test or production server to send
// in the url (there may be a better place to do this...)
	$value_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_FEDEX1_SERVER'");
	$value = tep_db_fetch_array($value_query);
	$fedex_gateway = $value['configuration_value'];	

// check for a fedex tracking number in the order record
// if yes tracking number, show "fedex label," "track" and "cancel" options
	$fedex_tracking = $oInfo->fedex_tracking;

// get the current order status				
	$check_fedex_status_query = tep_db_query("select orders_status from " . TABLE_ORDERS . " where orders_id = '" . $oInfo->orders_id . "'");
	$check_fedex_status = tep_db_fetch_array($check_fedex_status_query);

	if ($fedex_tracking) {
// display the label
          $contents[] = array('align' => 'center', 'text' => '<a href="fedex_popup.php?num=' . $fedex_tracking . '&amp;oID=' . $oInfo->orders_id . '">' . tep_image_button('button_fedex_label.gif', IMAGE_ORDERS_FEDEX_LABEL) . '</a>');
					
// track the package (no gateway needs to be specified)
          $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_TRACK_FEDEX, 'oID=' .$oInfo->orders_id . '&amp;num=' . $fedex_tracking) . '&amp;fedex_gateway=track">' . tep_image_button('button_track.gif', IMAGE_ORDERS_TRACK) . '</a>');

// cancel the request				
					
          $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_SHIP_FEDEX, 'oID=' .$oInfo->orders_id . '&amp;num=' . $fedex_tracking . '&amp;action=cancel&amp;fedex_gateway=' . $fedex_gateway) . '" onClick="return(window.confirm(\'Cancel shipment of order number ' . $oInfo->orders_id . '?\'));">' . tep_image_button('button_cancel_shipment.gif', IMAGE_ORDERS_CANCEL_SHIPMENT) . '</a>');
        }
// if no fedex tracking number, AND if the order has not been manually marked "delivered,"
// display the "ship" button

        elseif ((!$fedex_tracking) && (($check_fedex_status['orders_status']) != 3)) {
		  // Check Fedex Module is installed first
		  if ( (defined('MODULE_SHIPPING_FEDEX1_STATUS')) && (MODULE_SHIPPING_FEDEX1_STATUS == 'True') ) {
            $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_SHIP_FEDEX, 'oID=' .$oInfo->orders_id . '&amp;action=new&amp;status=3') . '">' . tep_image_button('button_ship.gif', IMAGE_ORDERS_SHIP) . '</a>');
		  }
        }
// EOF: MOD - FedEx 
       $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&amp;action=edit') . '">' . tep_image_button('button_details.gif', IMAGE_DETAILS) . '</a> <a href="' . tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array('oID', 'action')) . 'oID=' . $oInfo->orders_id . '&amp;action=delete') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a>  <a href="' . tep_href_link(FILENAME_ORDERS_EDIT, 'oID=' . $oInfo->orders_id) . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a><br><br>');
       $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_ORDERS_INVOICE, 'oID=' . $oInfo->orders_id) . '" TARGET="_blank">' . tep_image_button('button_invoice.gif', IMAGE_ORDERS_INVOICE) . '</a> <a href="' . tep_href_link(FILENAME_ORDERS_PACKINGSLIP, 'oID=' . $oInfo->orders_id) . '" TARGET="_blank">' . tep_image_button('button_packingslip.gif', IMAGE_ORDERS_PACKINGSLIP) . '</a>');
	   $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_ORDERS, 'pdf_check=invoice&amp;oID=' . $oInfo->orders_id) . '" target="_blank">' . tep_image_button('button_invoice_pdf.gif', IMAGE_ORDERS_INVOICE) . '</a> <a href="' . tep_href_link(FILENAME_ORDERS, 'pdf_check=packingslip&amp;oID=' . $oInfo->orders_id) . '" target="_blank">' . tep_image_button('button_packingslip_pdf.gif', IMAGE_ORDERS_PACKINGSLIP) . '</a>');
		
       $contents[] = array('text' => '<br>' . TEXT_DATE_ORDER_CREATED . ' ' . tep_date_short($oInfo->date_purchased));
       if (tep_not_null($oInfo->last_modified)) $contents[] = array('text' => TEXT_DATE_ORDER_LAST_MODIFIED . ' ' . tep_date_short($oInfo->last_modified));
         $contents[] = array('text' => '<br>' . TEXT_INFO_PAYMENT_METHOD . ' '  . $oInfo->payment_method);
		
		
      }
      break;
  }

  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  }
?>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>