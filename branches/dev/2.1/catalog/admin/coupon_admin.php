<?php
/*
$Id: coupon_admin.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com
  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'currencies.php');


  $currencies = new currencies();

  if ($HTTP_GET_VARS['selected_box']) {
    $HTTP_GET_VARS['action']='';
    $HTTP_GET_VARS['old_action']='';
  }
  
  if (($HTTP_GET_VARS['action'] == 'send_email_to_user') && ($HTTP_POST_VARS['customers_email_address']) && (!$HTTP_POST_VARS['back_x'])) {
    switch ($HTTP_POST_VARS['customers_email_address']) {
    case '***':
      $mail_query = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS);
      $mail_sent_to = TEXT_ALL_CUSTOMERS;
      break;
    case '**D':
      $mail_query = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_newsletter = '1'");
      $mail_sent_to = TEXT_NEWSLETTER_CUSTOMERS;
      break;
    default:
      $customers_email_address = tep_db_prepare_input($HTTP_POST_VARS['customers_email_address']);
      $mail_query = tep_db_query("select customers_firstname, customers_lastname, customers_email_address from " . TABLE_CUSTOMERS . " where customers_email_address = '" . tep_db_input($customers_email_address) . "'");
      $mail_sent_to = $HTTP_POST_VARS['customers_email_address'];
      break;
    }
    $coupon_query = tep_db_query("select coupon_code from " . TABLE_COUPONS . " where coupon_id = '" . $HTTP_GET_VARS['cid'] . "'");
    $coupon_result = tep_db_fetch_array($coupon_query);
    $coupon_name_query = tep_db_query("select coupon_name from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $HTTP_GET_VARS['cid'] . "' and language_id = '" . $languages_id . "'");
    $coupon_name = tep_db_fetch_array($coupon_name_query);

    $from = tep_db_prepare_input($HTTP_POST_VARS['from']);
    $subject = tep_db_prepare_input($HTTP_POST_VARS['subject']);
    while ($mail = tep_db_fetch_array($mail_query)) {
      $message = tep_db_prepare_input($HTTP_POST_VARS['message']);
      $message .= "\n\n" . TEXT_TO_REDEEM . "\n\n";
      $message .= TEXT_VOUCHER_IS . $coupon_result['coupon_code'] . "\n\n";
      $message .= TEXT_REMEMBER . "\n\n";
      $message .= TEXT_VISIT . "\n\n";
     
      //Let's build a message object using the email class
      $mimemessage = new email(array('X-Mailer: osCMax bulk mailer'));
      // add the message to the object
// MaxiDVD Added Line For WYSIWYG HTML Area: BOF (Send TEXT Email when WYSIWYG Disabled)
    if (HTML_AREA_WYSIWYG_DISABLE_EMAIL == 'Disable') {
    $mimemessage->add_text($message);
    } else {
    $mimemessage->add_html($message);
    }
// MaxiDVD Added Line For WYSIWYG HTML Area: EOF (Send HTML Email when WYSIWYG Enabled)
      $mimemessage->build_message();
      $mimemessage->send($mail['customers_firstname'] . ' ' . $mail['customers_lastname'], $mail['customers_email_address'], '', $from, $subject);
    }

    tep_redirect(tep_href_link(FILENAME_COUPON_ADMIN, 'mail_sent_to=' . urlencode($mail_sent_to)));
  }
 
  if ( ($HTTP_GET_VARS['action'] == 'preview_email') && (!$HTTP_POST_VARS['customers_email_address']) ) {
    $HTTP_GET_VARS['action'] = 'email';
    $messageStack->add(ERROR_NO_CUSTOMER_SELECTED, 'error');
  }

  if ($HTTP_GET_VARS['mail_sent_to']) {
    $messageStack->add(sprintf(NOTICE_EMAIL_SENT_TO, $HTTP_GET_VARS['mail_sent_to']), 'notice');
  }

  $coupon_id = ((isset($HTTP_GET_VARS['cid'])) ? tep_db_prepare_input($HTTP_GET_VARS['cid']) : '');
  switch ($HTTP_GET_VARS['action']) {
    case 'setflag':
      if ( ($HTTP_GET_VARS['flag'] == 'N') || ($HTTP_GET_VARS['flag'] == 'Y') ) {
        if (isset($HTTP_GET_VARS['cid'])) {
          tep_set_coupon_status($coupon_id, $HTTP_GET_VARS['flag']);
        }
      }
      tep_redirect(tep_href_link(FILENAME_COUPON_ADMIN, '&cid=' . $HTTP_GET_VARS['cid']));
      break;
    case 'confirmdelete':
      $delete_query=tep_db_query("delete from " . TABLE_COUPONS . " where coupon_id='" . (int)$coupon_id . "'");
      break;
    case 'update':
      // get all HTTP_POST_VARS and validate
      $HTTP_POST_VARS['coupon_code'] = trim($HTTP_POST_VARS['coupon_code']);
        $languages = tep_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $language_id = $languages[$i]['id'];
          if ($HTTP_POST_VARS['coupon_name'][$language_id]) $HTTP_POST_VARS['coupon_name'][$language_id] = trim($HTTP_POST_VARS['coupon_name'][$language_id]);
          if ($HTTP_POST_VARS['coupon_desc'][$language_id]) $HTTP_POST_VARS['coupon_desc'][$language_id] = trim($HTTP_POST_VARS['coupon_desc'][$language_id]);
        }
      $HTTP_POST_VARS['coupon_amount'] = trim($HTTP_POST_VARS['coupon_amount']);
      $update_errors = 0;
      if ((!tep_not_null($HTTP_POST_VARS['coupon_amount'])) && (!tep_not_null($HTTP_POST_VARS['coupon_free_ship']))) {
        $update_errors = 1;
        $messageStack->add(ERROR_NO_COUPON_AMOUNT, 'error');
      }
      $coupon_code = ((tep_not_null($HTTP_POST_VARS['coupon_code'])) ? $HTTP_POST_VARS['coupon_code'] : create_coupon_code());

      $query1 = tep_db_query("select coupon_code from " . TABLE_COUPONS . " where coupon_code = '" . tep_db_prepare_input($coupon_code) . "'");
      if (tep_db_num_rows($query1) && $HTTP_POST_VARS['coupon_code'] && $HTTP_GET_VARS['oldaction'] != 'voucheredit')  {
        $update_errors = 1;
        $messageStack->add(ERROR_COUPON_EXISTS, 'error');
      }
      if ($update_errors != 0) {
        $HTTP_GET_VARS['action'] = 'new';
      } else {
        $HTTP_GET_VARS['action'] = 'update_preview';
      }
      break;
    case 'update_confirm':
      if ( ($HTTP_POST_VARS['back_x']) || ($HTTP_POST_VARS['back_y']) ) {
        if ($HTTP_GET_VARS['oldaction'] == 'voucheredit') {
          $HTTP_GET_VARS['action'] = 'voucheredit';
        } else {
        $HTTP_GET_VARS['action'] = 'new';
        }
      } else {
        $coupon_type = "F";
        $coupon_amount = $HTTP_POST_VARS['coupon_amount'];
        if (substr($HTTP_POST_VARS['coupon_amount'], -1) == '%') $coupon_type='P';
        if ($HTTP_POST_VARS['coupon_free_ship']) {
          $coupon_type = 'S';
          $coupon_amount = 0;
        }
        $sql_data_array = array('coupon_active' => tep_db_prepare_input($HTTP_POST_VARS['coupon_status']),
                                'coupon_code' => tep_db_prepare_input($HTTP_POST_VARS['coupon_code']),
                                'coupon_amount' => tep_db_prepare_input($coupon_amount),
                                'coupon_type' => tep_db_prepare_input($coupon_type),
                                'uses_per_coupon' => tep_db_prepare_input($HTTP_POST_VARS['coupon_uses_coupon']),
                                'uses_per_user' => tep_db_prepare_input($HTTP_POST_VARS['coupon_uses_user']),
                                'coupon_minimum_order' => tep_db_prepare_input($HTTP_POST_VARS['coupon_min_order']),
                                'restrict_to_products' => tep_db_prepare_input($HTTP_POST_VARS['coupon_products']),
                                'restrict_to_categories' => tep_db_prepare_input($HTTP_POST_VARS['coupon_categories']),
                                'coupon_start_date' => $HTTP_POST_VARS['coupon_startdate'],
                                'coupon_expire_date' => $HTTP_POST_VARS['coupon_finishdate'],
                                'date_created' => (($HTTP_POST_VARS['date_created'] != '0') ? $HTTP_POST_VARS['date_created'] : 'now()'),
                                'date_modified' => 'now()');
        $languages = tep_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $language_id = $languages[$i]['id'];
          $sql_data_marray[$i] = array('coupon_name' => tep_db_prepare_input($HTTP_POST_VARS['coupon_name'][$language_id]),
                                 'coupon_description' => tep_db_prepare_input($HTTP_POST_VARS['coupon_desc'][$language_id])
                                 );
        }
//        $query = tep_db_query("select coupon_code from " . TABLE_COUPONS . " where coupon_code = '" . tep_db_prepare_input($HTTP_POST_VARS['coupon_code']) . "'");
//        if (!tep_db_num_rows($query)) {
        if ($HTTP_GET_VARS['oldaction']=='voucheredit') {
          tep_db_perform(TABLE_COUPONS, $sql_data_array, 'update', "coupon_id='" . (int)$coupon_id . "'"); 
          for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $language_id = $languages[$i]['id'];
            $update = tep_db_query("update " . TABLE_COUPONS_DESCRIPTION . " set coupon_name = '" . tep_db_prepare_input($HTTP_POST_VARS['coupon_name'][$language_id]) . "', coupon_description = '" . tep_db_prepare_input($HTTP_POST_VARS['coupon_desc'][$language_id]) . "' where coupon_id = '" . (int)$coupon_id . "' and language_id = '" . $language_id . "'");
//            tep_db_perform(TABLE_COUPONS_DESCRIPTION, $sql_data_marray[$i], 'update', "coupon_id='" . $HTTP_GET_VARS['cid']."'");
          }
        } else {
          $query = tep_db_perform(TABLE_COUPONS, $sql_data_array);
// to fix bug to prevent errors when adding a new voucher. This will also fix when there is no name or description in final voucher
          $insert_id = tep_db_insert_id();

          for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
            $language_id = $languages[$i]['id'];
            $sql_data_marray[$i]['coupon_id'] = $insert_id;
            $sql_data_marray[$i]['language_id'] = $language_id;
            tep_db_perform(TABLE_COUPONS_DESCRIPTION, $sql_data_marray[$i]);
          }
//        }
      }
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>
<script language="javascript">
  var dateAvailable = new ctlSpiffyCalendarBox("dateAvailable", "new_product", "products_date_available","btnDate1","<?php echo $pInfo->products_date_available; ?>",scBTNMODE_CUSTOMBLUE);
</script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">

<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
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
<?php
  switch ($HTTP_GET_VARS['action']) {
  case 'voucherreport':
?>
      <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo CUSTOMER_ID; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo CUSTOMER_NAME; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo IP_ADDRESS; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo REDEEM_DATE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
    $cc_query_raw = "select * from " . TABLE_COUPON_REDEEM_TRACK . " where coupon_id = '" . (int)$coupon_id . "'";
    $cc_query = tep_db_query($cc_query_raw);
    $cc_query_numrows = tep_db_num_rows($cc_query);
    $cc_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $cc_query_raw, $cc_query_numrows);

    while ($cc_list = tep_db_fetch_array($cc_query)) {
      $rows++;
      if (strlen($rows) < 2) {
        $rows = '0' . $rows;
      }
      if (((!$HTTP_GET_VARS['uid']) || (@$HTTP_GET_VARS['uid'] == $cc_list['unique_id'])) && (!$cInfo)) {
        $cInfo = new objectInfo($cc_list);
      }
      if ( (is_object($cInfo)) && ($cc_list['unique_id'] == $cInfo->unique_id) ) {
        echo '          <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . tep_href_link('coupon_admin.php', tep_get_all_get_params(array('cid', 'action', 'uid')) . 'cid=' . $cInfo->coupon_id . '&action=voucherreport&uid=' . $cinfo->unique_id) . '\'">' . "\n";
      } else {
        echo '          <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . tep_href_link('coupon_admin.php', tep_get_all_get_params(array('cid', 'action', 'uid')) . 'cid=' . $cc_list['coupon_id'] . '&action=voucherreport&uid=' . $cc_list['unique_id']) . '\'">' . "\n";
      }
$customer_query = tep_db_query("select customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . $cc_list['customer_id'] . "'");
$customer = tep_db_fetch_array($customer_query);

?>
                <td class="dataTableContent"><?php echo $cc_list['customer_id']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $customer['customers_firstname'] . ' ' . $customer['customers_lastname']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $cc_list['redeem_ip']; ?></td>
                <td class="dataTableContent" align="center"><?php echo tep_date_short($cc_list['redeem_date']); ?></td>
                <td class="dataTableContent" align="right"><?php if ( (is_object($cInfo)) && ($cc_list['unique_id'] == $cInfo->unique_id) ) { echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif'); } else { echo '<a href="' . tep_href_link(FILENAME_COUPON_ADMIN, 'page=' . $HTTP_GET_VARS['page'] . '&cid=' . $cc_list['coupon_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
    }
?>

             </table></td>
<?php
    $heading = array();
    $contents = array();
      $coupon_description_query = tep_db_query("select coupon_name from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . (int)$coupon_id . "' and language_id = '" . $languages_id . "'");
      $coupon_desc = tep_db_fetch_array($coupon_description_query);
      $count_customers = tep_db_query("select * from " . TABLE_COUPON_REDEEM_TRACK . " where coupon_id = '" . (int)$coupon_id . "' and customer_id = '" . $cInfo->customer_id . "'");
       
      $heading[] = array('text' => '<b>[' . $HTTP_GET_VARS['cid'] . ']' . COUPON_NAME . ' ' . $coupon_desc['coupon_name'] . '</b>');
      $contents[] = array('text' => '<b>' . TEXT_REDEMPTIONS . '</b>');
      $contents[] = array('text' => TEXT_REDEMPTIONS_TOTAL . ':' . tep_db_num_rows($cc_query));
      $contents[] = array('text' => TEXT_REDEMPTIONS_CUSTOMER . ':' . tep_db_num_rows($count_customers));
      $contents[] = array('text' => '');
?>
    <td width="25%" valign="top">
<?php
      $box = new box;
      echo $box->infoBox($heading, $contents);
      echo '            </td>' . "\n";
?>
<?php
    break;
  case 'preview_email':
    $coupon_query = tep_db_query("select coupon_code from " .TABLE_COUPONS . " where coupon_id = '" . (int)$coupon_id . "'");
    $coupon_result = tep_db_fetch_array($coupon_query);
    $coupon_name_query = tep_db_query("select coupon_name from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . (int)$coupon_id . "' and language_id = '" . $languages_id . "'");
    $coupon_name = tep_db_fetch_array($coupon_name_query);
    switch ($HTTP_POST_VARS['customers_email_address']) {
    case '***':
      $mail_sent_to = TEXT_ALL_CUSTOMERS;
      break;
    case '**D':
      $mail_sent_to = TEXT_NEWSLETTER_CUSTOMERS;
      break;
    default:
      $mail_sent_to = $HTTP_POST_VARS['customers_email_address'];
      break;
    }
?>
      <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
          <tr><?php echo tep_draw_form('mail', FILENAME_COUPON_ADMIN, 'action=send_email_to_user&cid=' . $HTTP_GET_VARS['cid']); ?>
            <td><table border="0" width="100%" cellpadding="0" cellspacing="2">
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php echo TEXT_CUSTOMER; ?></b><br><?php echo $mail_sent_to; ?></td>
              </tr>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php echo TEXT_COUPON; ?></b><br><?php echo $coupon_name['coupon_name']; ?></td>
              </tr>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php echo TEXT_FROM; ?></b><br><?php echo htmlspecialchars(stripslashes($HTTP_POST_VARS['from'])); ?></td>
              </tr>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php echo TEXT_SUBJECT; ?></b><br><?php echo htmlspecialchars(stripslashes($HTTP_POST_VARS['subject'])); ?></td>
              </tr>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="smallText"><b><?php if (HTML_AREA_WYSIWYG_DISABLE_EMAIL == 'Enable') { echo (stripslashes($HTTP_POST_VARS['message'])); } else { echo htmlspecialchars(stripslashes($HTTP_POST_VARS['message'])); } ?></td>
              </tr>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td>
<?php
/* Re-Post all POST'ed variables */
    reset($HTTP_POST_VARS);
    while (list($key, $value) = each($HTTP_POST_VARS)) {
      if (!is_array($HTTP_POST_VARS[$key])) {
        echo tep_draw_hidden_field($key, htmlspecialchars(stripslashes($value)));
      }
    }
?>
                <table border="0" width="100%" cellpadding="0" cellspacing="2">
                  <tr>
                    <td><?php ?>&nbsp;</td>
                     <tr>
                    <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_COUPON_ADMIN) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a> ' . tep_image_submit('button_send_mail.gif', IMAGE_SEND_EMAIL); ?></td>
                    </tr>
                    <td class="smallText">
                <?php if (HTML_AREA_WYSIWYG_DISABLE_EMAIL == 'Disable'){echo tep_image_submit('button_back.gif', IMAGE_BACK, 'name="back"');
                } ?><?php if (HTML_AREA_WYSIWYG_DISABLE_EMAIL == 'Disable') {echo(TEXT_EMAIL_BUTTON_HTML);
                 } else { echo(TEXT_EMAIL_BUTTON_TEXT); } ?>
                    </td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </form></tr>
<?php
    break;
  case 'email':
    $coupon_query = tep_db_query("select coupon_code from " . TABLE_COUPONS . " where coupon_id = '" . (int)$coupon_id . "'");
    $coupon_result = tep_db_fetch_array($coupon_query);
    $coupon_name_query = tep_db_query("select coupon_name from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . (int)$coupon_id . "' and language_id = '" . $languages_id . "'");
    $coupon_name = tep_db_fetch_array($coupon_name_query);
?>
      <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>

          <tr><?php echo tep_draw_form('mail', FILENAME_COUPON_ADMIN, 'action=preview_email&cid='. $HTTP_GET_VARS['cid']); ?>
            <td><table border="0" cellpadding="0" cellspacing="2">
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
<?php
    $customers = array();
    $customers[] = array('id' => '', 'text' => TEXT_SELECT_CUSTOMER);
    $customers[] = array('id' => '***', 'text' => TEXT_ALL_CUSTOMERS);
    $customers[] = array('id' => '**D', 'text' => TEXT_NEWSLETTER_CUSTOMERS);
    $mail_query = tep_db_query("select customers_email_address, customers_firstname, customers_lastname from " . TABLE_CUSTOMERS . " order by customers_lastname");
    while($customers_values = tep_db_fetch_array($mail_query)) {
      $customers[] = array('id' => $customers_values['customers_email_address'],
                           'text' => $customers_values['customers_lastname'] . ', ' . $customers_values['customers_firstname'] . ' (' . $customers_values['customers_email_address'] . ')');
    }
?>
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo TEXT_COUPON; ?>&nbsp;&nbsp;</td>
                <td class="main"><?php echo $coupon_name['coupon_name']; ?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo TEXT_CUSTOMER; ?>&nbsp;&nbsp;</td>
                <td><?php echo tep_draw_pull_down_menu('customers_email_address', $customers, $HTTP_GET_VARS['customer']);?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo TEXT_FROM; ?>&nbsp;&nbsp;</td>
                <td><?php echo tep_draw_input_field('from', EMAIL_FROM); ?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
<?php
/*
              <tr>
                <td class="main"><?php echo TEXT_RESTRICT; ?>&nbsp;&nbsp;</td>
                <td><?php echo tep_draw_checkbox_field('customers_restrict', $customers_restrict);?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
*/
?>
              <tr>
                <td class="main"><?php echo TEXT_SUBJECT; ?>&nbsp;&nbsp;</td>
                <td><?php echo tep_draw_input_field('subject'); ?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                <td valign="top" class="main"><?php echo TEXT_MESSAGE; ?></td>
                <td><?php if (HTML_AREA_WYSIWYG_DISABLE_EMAIL == 'Enable') {
// Line Changed - MOD: Ajustable Editor Window
                	echo tep_draw_fckeditor('message', HTML_AREA_WYSIWYG_EDITOR_WIDTH, HTML_AREA_WYSIWYG_EDITOR_HEIGHT, ' ') .'</td>';
                } else { echo tep_draw_textarea_field('message', 'soft', '60', '15') .'</td>';
                }
                ?>
              </tr>
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
              </tr>
              <tr>
                 <td colspan="2" align="right">
                 <?php if (HTML_AREA_WYSIWYG_DISABLE_EMAIL == 'Enable'){ echo tep_image_submit('button_send_mail.gif', IMAGE_SEND_EMAIL, 'onClick="validate();return returnVal;"');
                   } else {
                echo tep_image_submit('button_send_mail.gif', IMAGE_SEND_EMAIL); }?>
                </td>
              </tr>
            </table></td>
          </form></tr>

      </tr>
      </td>
<?php
    break;
  case 'update_preview':
  $coupon_min_order = (($HTTP_POST_VARS['coupon_min_order'] == round($HTTP_POST_VARS['coupon_min_order'])) ? number_format((double)$HTTP_POST_VARS['coupon_min_order'], 2) : number_format($HTTP_POST_VARS['coupon_min_order'], 2));
  $coupon_amount = (($HTTP_POST_VARS['coupon_amount'] == round($HTTP_POST_VARS['coupon_amount'])) ? number_format((double)$HTTP_POST_VARS['coupon_amount'], 2) : number_format($HTTP_POST_VARS['coupon_amount'], 2));
?>
      <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE_PREVIEW; ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
      <td class="main">
<?php echo tep_draw_form('coupon', 'coupon_admin.php', 'action=update_confirm&oldaction=' . $HTTP_GET_VARS['oldaction'] . '&cid=' . $HTTP_GET_VARS['cid']); ?>
      <table border="0" width="100%" cellspacing="0" cellpadding="6">
      <tr>
        <td align="left" class="main" width="270"><?php echo COUPON_STATUS; ?></td>
        <td align="left" class="main"><?php echo (($HTTP_POST_VARS['coupon_status'] == 'Y') ? IMAGE_ICON_STATUS_GREEN : IMAGE_ICON_STATUS_RED); ?></td>
      </tr>
<?php
        $languages = tep_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
            $language_id = $languages[$i]['id'];
?>
      <tr>
        <td align="left" class="main"><?php echo COUPON_NAME; ?></td>
        <td align="left" class="main"><?php echo $HTTP_POST_VARS['coupon_name'][$language_id]; ?></td>
      </tr>
<?php
}
?>
<?php
        $languages = tep_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
            $language_id = $languages[$i]['id'];
?>
      <tr>
        <td align="left" class="main"><?php echo COUPON_DESC; ?></td>
        <td align="left" class="main"><?php echo $HTTP_POST_VARS['coupon_desc'][$language_id]; ?></td>
      </tr>
<?php
}
?>
      <tr>
        <td align="left" class="main"><?php echo COUPON_AMOUNT; ?></td>
        <td align="left" class="main"><?php if (!$HTTP_POST_VARS['coupon_free_ship']) echo $coupon_amount; ?></td>
      </tr>

      <tr>
        <td align="left" class="main"><?php echo COUPON_MIN_ORDER; ?></td>
        <td align="left" class="main"><?php echo $coupon_min_order; ?></td>
      </tr>

      <tr>
        <td align="left" class="main"><?php echo COUPON_FREE_SHIP; ?></td>
<?php
    if ($HTTP_POST_VARS['coupon_free_ship']) {
?>
        <td align="left" class="main"><?php echo TEXT_FREE_SHIPPING; ?></td>
<?php
    } else {
?>
        <td align="left" class="main"><?php echo TEXT_NO_FREE_SHIPPING; ?></td>
<?php
    }
?>
      </tr>
      <tr>
        <td align="left" class="main"><?php echo COUPON_CODE; ?></td>
<?php
    if ($HTTP_POST_VARS['coupon_code']) {
      $c_code = $HTTP_POST_VARS['coupon_code'];
    } else {
      $c_code = $coupon_code;
    }
?>
        <td align="left" class="main"><?php echo $coupon_code; ?></td>
      </tr>

      <tr>
        <td align="left" class="main"><?php echo COUPON_USES_COUPON; ?></td>
        <td align="left" class="main"><?php echo $HTTP_POST_VARS['coupon_uses_coupon']; ?></td>
      </tr>

      <tr>
        <td align="left" class="main"><?php echo COUPON_USES_USER; ?></td>
        <td align="left" class="main"><?php echo $HTTP_POST_VARS['coupon_uses_user']; ?></td>
      </tr>

       <tr>
        <td align="left" class="main"><?php echo COUPON_PRODUCTS; ?></td>
        <td align="left" class="main"><?php echo $HTTP_POST_VARS['coupon_products']; ?></td>
      </tr>


      <tr>
        <td align="left" class="main"><?php echo COUPON_CATEGORIES; ?></td>
        <td align="left" class="main"><?php echo $HTTP_POST_VARS['coupon_categories']; ?></td>
      </tr>
      <tr>
        <td align="left" class="main"><?php echo COUPON_STARTDATE; ?></td>
<?php
    $start_date = date(DATE_FORMAT, mktime(0, 0, 0, $HTTP_POST_VARS['coupon_startdate_month'],$HTTP_POST_VARS['coupon_startdate_day'] ,$HTTP_POST_VARS['coupon_startdate_year'] ));
?>
        <td align="left" class="main"><?php echo $start_date; ?></td>
      </tr>

      <tr>
        <td align="left" class="main"><?php echo COUPON_FINISHDATE; ?></td>
<?php
    $finish_date = date(DATE_FORMAT, mktime(0, 0, 0, $HTTP_POST_VARS['coupon_finishdate_month'],$HTTP_POST_VARS['coupon_finishdate_day'] ,$HTTP_POST_VARS['coupon_finishdate_year'] ));
    echo date('Y-m-d', mktime(0, 0, 0, $HTTP_POST_VARS['coupon_startdate_month'],$HTTP_POST_VARS['coupon_startdate_day'] ,$HTTP_POST_VARS['coupon_startdate_year'] ));
?>
        <td align="left" class="main"><?php echo $finish_date; ?></td>
      </tr>
<?php
    echo tep_draw_hidden_field('coupon_status', $HTTP_POST_VARS['coupon_status']);
        $languages = tep_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
          $language_id = $languages[$i]['id'];
          echo tep_draw_hidden_field('coupon_name[' . $languages[$i]['id'] . ']', $HTTP_POST_VARS['coupon_name'][$language_id]);
          echo tep_draw_hidden_field('coupon_desc[' . $languages[$i]['id'] . ']', $HTTP_POST_VARS['coupon_desc'][$language_id]);
       }
    echo tep_draw_hidden_field('coupon_amount', $HTTP_POST_VARS['coupon_amount']);
    echo tep_draw_hidden_field('coupon_min_order', $HTTP_POST_VARS['coupon_min_order']);
    echo tep_draw_hidden_field('coupon_free_ship', $HTTP_POST_VARS['coupon_free_ship']);
    echo tep_draw_hidden_field('coupon_code', $c_code);
    echo tep_draw_hidden_field('coupon_uses_coupon', $HTTP_POST_VARS['coupon_uses_coupon']);
    echo tep_draw_hidden_field('coupon_uses_user', $HTTP_POST_VARS['coupon_uses_user']);
    echo tep_draw_hidden_field('coupon_products', $HTTP_POST_VARS['coupon_products']);
    echo tep_draw_hidden_field('coupon_categories', $HTTP_POST_VARS['coupon_categories']);
    echo tep_draw_hidden_field('coupon_startdate', date('Y-m-d', mktime(0, 0, 0, $HTTP_POST_VARS['coupon_startdate_month'],$HTTP_POST_VARS['coupon_startdate_day'] ,$HTTP_POST_VARS['coupon_startdate_year'] )));
    echo tep_draw_hidden_field('coupon_finishdate', date('Y-m-d', mktime(0, 0, 0, $HTTP_POST_VARS['coupon_finishdate_month'],$HTTP_POST_VARS['coupon_finishdate_day'] ,$HTTP_POST_VARS['coupon_finishdate_year'] )));
    echo tep_draw_hidden_field('date_created', ((tep_not_null($HTTP_POST_VARS['date_created'])) ? date('Y-m-d', strtotime($HTTP_POST_VARS['date_created'])) : '0'));
?>
     <tr>
        <td align="center" class="main" colspan="2">
		<?php echo tep_image_submit('button_confirm.gif',COUPON_BUTTON_CONFIRM); ?>&nbsp;&nbsp;
        <?php echo tep_image_submit('button_back.gif',COUPON_BUTTON_BACK, 'name=back'); ?>
        </td>
      </tr>

      </td></table></form>
      </tr>

      </table></td>
<?php

    break;
  case 'voucheredit':
    $languages = tep_get_languages();
    for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
      $language_id = $languages[$i]['id'];
      $coupon_query = tep_db_query("select coupon_name,coupon_description from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" .  (int)$coupon_id . "' and language_id = '" . $language_id . "'");
      $coupon = tep_db_fetch_array($coupon_query);
      $coupon_name[$language_id] = $coupon['coupon_name'];
      $coupon_desc[$language_id] = $coupon['coupon_description'];
    }
    $coupon_query=tep_db_query("select coupon_active, coupon_code, coupon_amount, coupon_type, coupon_minimum_order, coupon_start_date, coupon_expire_date, date_created, uses_per_coupon, uses_per_user, restrict_to_products, restrict_to_categories from " . TABLE_COUPONS . " where coupon_id = '" . (int)$coupon_id . "'");
    $coupon=tep_db_fetch_array($coupon_query);
    $coupon_amount = (($coupon['coupon_amount'] == round($coupon['coupon_amount'])) ? number_format($coupon['coupon_amount'], 2) : number_format($coupon['coupon_amount'], 2));
    if ($coupon['coupon_type']=='P') {
      // not floating point value, don't display decimal info
      $coupon_amount = (($coupon_amount == round($coupon_amount)) ? number_format($coupon_amount) : number_format($coupon_amount, 2)) . '%';
    }
    if ($coupon['coupon_type']=='S') {
      $coupon_free_ship .= true;
    }
    $coupon_min_order = (($coupon['coupon_minimum_order'] == round($coupon['coupon_minimum_order'])) ? number_format($coupon['coupon_minimum_order'], 2) : number_format($coupon['coupon_minimum_order'], 2));
    $coupon_code = $coupon['coupon_code'];
    $coupon_uses_coupon = $coupon['uses_per_coupon'];
    $coupon_uses_user = $coupon['uses_per_user'];
    $coupon_products = $coupon['restrict_to_products'];
    $coupon_categories = $coupon['restrict_to_categories'];
    $date_created = $coupon['date_created'];
    $coupon_status = $coupon['coupon_active'];
  case 'new':
// molafish: set default if not editing an existing coupon or showing an error
    if ($HTTP_GET_VARS['action'] == 'new' && !$HTTP_GET_VARS['oldaction'] == 'new') {
      if (!$coupon_uses_user) {
        $coupon_uses_user=1;
      }
      if (!$date_created) {
        $date_created = '0';
      }
    }
    if (!isset($coupon_status)) $coupon_status = 'Y';
    switch ($coupon_status) {
      case 'N': $in_status = false; $out_status = true; break;
      case 'Y':
      default: $in_status = true; $out_status = false;
    }
?>
      <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
      <td>
<?php
    echo tep_draw_form('coupon', 'coupon_admin.php', 'action=update&oldaction='. (($HTTP_GET_VARS['oldaction'] == 'voucheredit') ? $HTTP_GET_VARS['oldaction'] : $HTTP_GET_VARS['action']) . '&cid=' . $HTTP_GET_VARS['cid']);
?>
      <table border="0" width="100%" cellspacing="0" cellpadding="6">
      <tr>
        <td align="left" class="main"><?php echo COUPON_STATUS; ?></td>
        <td align="left" class="main"><?php echo tep_draw_radio_field('coupon_status', 'Y', $in_status) . '&nbsp;' . IMAGE_ICON_STATUS_GREEN . '&nbsp;' . tep_draw_radio_field('coupon_status', 'N', $out_status) . '&nbsp;' . IMAGE_ICON_STATUS_RED; ?></td>
        <td align="left" class="main"><?php echo COUPON_STATUS_HELP; ?></td>
      </tr>
<?php
        $languages = tep_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
        $language_id = $languages[$i]['id'];
?>
      <tr>
        <td align="left" class="main"><?php if ($i==0) echo COUPON_NAME; ?></td>
        <td align="left"><?php echo tep_draw_input_field('coupon_name[' . $languages[$i]['id'] . ']', $coupon_name[$language_id]) . '&nbsp;' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?></td>
        <td align="left" class="main" width="40%"><?php if ($i==0) echo COUPON_NAME_HELP; ?></td>
      </tr>
<?php
}
?>
<?php
        $languages = tep_get_languages();
        for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
        $language_id = $languages[$i]['id'];
?>

      <tr>
        <td align="left" valign="top" class="main"><?php if ($i==0) echo COUPON_DESC; ?></td>
        <td align="left" valign="top"><?php echo tep_draw_textarea_field('coupon_desc[' . $languages[$i]['id'] . ']','physical','24','3', $coupon_desc[$language_id]) . '&nbsp;' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?></td>
        <td align="left" valign="top" class="main"><?php if ($i==0) echo COUPON_DESC_HELP; ?></td>
      </tr>
<?php
}
?>
      <tr>
        <td align="left" class="main"><?php echo COUPON_AMOUNT; ?></td>
        <td align="left"><?php echo tep_draw_input_field('coupon_amount', $coupon_amount); ?></td>
        <td align="left" class="main"><?php echo COUPON_AMOUNT_HELP; ?></td>
      </tr>
      <tr>
        <td align="left" class="main"><?php echo COUPON_MIN_ORDER; ?></td>
        <td align="left"><?php echo tep_draw_input_field('coupon_min_order', $coupon_min_order); ?></td>
        <td align="left" class="main"><?php echo COUPON_MIN_ORDER_HELP; ?></td>
      </tr>
      <tr>
        <td align="left" class="main"><?php echo COUPON_FREE_SHIP; ?></td>
        <td align="left"><?php echo tep_draw_checkbox_field('coupon_free_ship', $coupon_free_ship); ?></td>
        <td align="left" class="main"><?php echo COUPON_FREE_SHIP_HELP; ?></td>
      </tr>
      <tr>
        <td align="left" class="main"><?php echo COUPON_CODE; ?></td>
        <td align="left"><?php echo tep_draw_input_field('coupon_code', $coupon_code); ?></td>
        <td align="left" class="main"><?php echo COUPON_CODE_HELP; ?></td>
      </tr>
      <tr>
        <td align="left" class="main"><?php echo COUPON_USES_COUPON; ?></td>
        <td align="left"><?php echo tep_draw_input_field('coupon_uses_coupon', $coupon_uses_coupon); ?></td>
        <td align="left" class="main"><?php echo COUPON_USES_COUPON_HELP; ?></td>
      </tr>
      <tr>
        <td align="left" class="main"><?php echo COUPON_USES_USER; ?></td>
        <td align="left"><?php echo tep_draw_input_field('coupon_uses_user', $coupon_uses_user); ?></td>
        <td align="left" class="main"><?php echo COUPON_USES_USER_HELP; ?></td>
      </tr>
       <tr>
        <td align="left" class="main"><?php echo COUPON_PRODUCTS; ?></td>
        <td align="left"><?php echo tep_draw_input_field('coupon_products', $coupon_products); ?> <input type=button name=open_popup ONCLICK="window.open('treeview.php', 'popuppage', 'scrollbars=yes,resizable=yes,menubar=yes,width=400,height=600'); " value=" View "></td>
        <td align="left" class="main"><?php echo COUPON_PRODUCTS_HELP; ?></td>
      </tr>
      <tr>
        <td align="left" class="main"><?php echo COUPON_CATEGORIES; ?></td>
        <td align="left"><?php echo tep_draw_input_field('coupon_categories', $coupon_categories); ?> <input type=button name=open_popup ONCLICK="window.open('treeview.php', 'popuppage', 'scrollbars=yes,resizable=yes,menubar=yes,width=400,height=600'); " value=" View "></td>
        <td align="left" class="main"><?php echo COUPON_CATEGORIES_HELP; ?></td>
      </tr>
      <tr>
<?php
// molafish: fixed reset to default of dates when editing an existing coupon or showing an error message
    if ($HTTP_GET_VARS['action'] == 'new' && !$HTTP_POST_VARS['coupon_startdate'] && !$HTTP_GET_VARS['oldaction'] == 'new') {
      $coupon_startdate = explode("[-]", date('Y-m-d'));
    } elseif (tep_not_null($HTTP_POST_VARS['coupon_startdate'])) {
      $coupon_startdate = explode("[-]", $HTTP_POST_VARS['coupon_startdate']);
    } elseif (!$HTTP_GET_VARS['oldaction'] == 'new') {   // for action=voucheredit
      $coupon_startdate = explode("[-]", date('Y-m-d', strtotime($coupon['coupon_start_date'])));
    } else {   // error is being displayed
      $coupon_startdate = explode("[-]", date('Y-m-d', mktime(0, 0, 0, $HTTP_POST_VARS['coupon_startdate_month'],$HTTP_POST_VARS['coupon_startdate_day'] ,$HTTP_POST_VARS['coupon_startdate_year'] )));
    }
    if ($HTTP_GET_VARS['action'] == 'new' && !$HTTP_POST_VARS['coupon_finishdate'] && !$HTTP_GET_VARS['oldaction'] == 'new') {
      $coupon_finishdate = explode("[-]", date('Y-m-d'));
      $coupon_finishdate[0] = $coupon_finishdate[0] + 1;
    } elseif (tep_not_null($HTTP_POST_VARS['coupon_finishdate'])) {
      $coupon_finishdate = explode("[-]", $HTTP_POST_VARS['coupon_finishdate']);
    } elseif (!$HTTP_GET_VARS['oldaction'] == 'new') {   // for action=voucheredit
      $coupon_finishdate = explode("[-]", date('Y-m-d', strtotime($coupon['coupon_expire_date'])));
    } else {   // error is being displayed
      $coupon_finishdate = explode("[-]", date('Y-m-d', mktime(0, 0, 0, $HTTP_POST_VARS['coupon_finishdate_month'],$HTTP_POST_VARS['coupon_finishdate_day'] ,$HTTP_POST_VARS['coupon_finishdate_year'] )));
    }
?>
        <td align="left" class="main"><?php echo COUPON_STARTDATE; ?></td>
        <td align="left"><?php echo tep_draw_date_selector('coupon_startdate', mktime(0,0,0, $coupon_startdate[1], $coupon_startdate[2], $coupon_startdate[0])); ?></td>
        <td align="left" class="main"><?php echo COUPON_STARTDATE_HELP; ?></td>
      </tr>
      <tr>
        <td align="left" class="main"><?php echo COUPON_FINISHDATE; ?></td>
        <td align="left"><?php echo tep_draw_date_selector('coupon_finishdate', mktime(0,0,0, $coupon_finishdate[1], $coupon_finishdate[2], $coupon_finishdate[0])); ?></td>
        <td align="left" class="main"><?php echo COUPON_FINISHDATE_HELP; ?></td>
      </tr>
<?php
      echo tep_draw_hidden_field('date_created', $date_created);
?>
      <tr>
        <td align="right" colspan="2"><?php echo tep_image_submit('button_preview.gif', COUPON_BUTTON_PREVIEW); ?>
        <?php echo '&nbsp;&nbsp;<a href="' . tep_href_link('coupon_admin.php', ''); ?>"><?php echo tep_image_button('button_cancel.gif', IMAGE_CANCEL); ?></a>
      </td>
      </tr>
      </td></table></form>
      </tr>

      </table></td>
<?php
    break;
  default:
?>
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="main"><?php echo tep_draw_form('status', FILENAME_COUPON_ADMIN, '', 'get'); ?>
<?php
    $status_array[] = array('id' => 'Y', 'text' => TEXT_COUPON_ACTIVE);
    $status_array[] = array('id' => 'N', 'text' => TEXT_COUPON_INACTIVE);
    $status_array[] = array('id' => 'R', 'text' => TEXT_COUPON_REDEEMED);
    $status_array[] = array('id' => '*', 'text' => TEXT_COUPON_ALL);

    if ($HTTP_GET_VARS['status']) {
      $status = tep_db_prepare_input($HTTP_GET_VARS['status']);
    } else {
      // Changed from "Y" to "*" to see the Red Active and the Green Inactive status
      $status = '*';
    }
    echo HEADING_TITLE_STATUS . ' ' . tep_draw_pull_down_menu('status', $status_array, $status, 'onChange="this.form.submit();"');
?>
              </form>
           </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo COUPON_NAME; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo COUPON_AMOUNT; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo COUPON_CODE; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TEXT_REDEMPTIONS; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo COUPON_STATUS; ?></td>  
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
    if ($HTTP_GET_VARS['page'] > 1) $rows = $HTTP_GET_VARS['page'] * 20 - 20;
    if ($status == 'Y' || $status == 'N') {
      $cc_query_raw = "select coupon_active, coupon_id, coupon_code, coupon_amount, coupon_minimum_order, coupon_type, coupon_start_date,coupon_expire_date,uses_per_user,uses_per_coupon,restrict_to_products, restrict_to_categories, date_created,date_modified from " . TABLE_COUPONS ." where coupon_active='" . tep_db_input($status) . "' and coupon_type != 'G'";
    } else {
      $cc_query_raw = "select coupon_active, coupon_id, coupon_code, coupon_amount, coupon_minimum_order, coupon_type, coupon_start_date,coupon_expire_date,uses_per_user,uses_per_coupon,restrict_to_products, restrict_to_categories, date_created,date_modified from " . TABLE_COUPONS . " where coupon_type != 'G'";
    }
    $cc_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $cc_query_raw, $cc_query_numrows);
    $cc_query = tep_db_query($cc_query_raw);
    while ($cc_list = tep_db_fetch_array($cc_query)) {
      $redeem_query = tep_db_query("select redeem_date from " . TABLE_COUPON_REDEEM_TRACK . " where coupon_id = '" . $cc_list['coupon_id'] . "'");
      if ($status == 'R' && tep_db_num_rows($redeem_query) == 0) {
        continue;
      }
      $rows++;
      if (strlen($rows) < 2) {
        $rows = '0' . $rows;
      }
      if (((!$HTTP_GET_VARS['cid']) || (@$HTTP_GET_VARS['cid'] == $cc_list['coupon_id'])) && (!$cInfo)) {
        $cInfo = new objectInfo($cc_list);
      }
      if ( (is_object($cInfo)) && ($cc_list['coupon_id'] == $cInfo->coupon_id) ) {
        echo '          <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . tep_href_link('coupon_admin.php', tep_get_all_get_params(array('cid', 'action')) . 'cid=' . $cInfo->coupon_id . '&action=edit') . '\'">' . "\n";
      } else {
        echo '          <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . tep_href_link('coupon_admin.php', tep_get_all_get_params(array('cid', 'action')) . 'cid=' . $cc_list['coupon_id']) . '\'">' . "\n";
      }
      $coupon_description_query = tep_db_query("select coupon_name from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $cc_list['coupon_id'] . "' and language_id = '" . $languages_id . "'");
      $coupon_desc = tep_db_fetch_array($coupon_description_query);
?>
                <td class="dataTableContent"><?php echo $coupon_desc['coupon_name']; ?></td>
                <td class="dataTableContent" align="center">
<?php
      if ($cc_list['coupon_type'] == 'P') {
        // not floating point value, don't display decimal info
        echo (($cc_list['coupon_amount'] == round($cc_list['coupon_amount'])) ? number_format($cc_list['coupon_amount']) : number_format($cc_list['coupon_amount'], 2)) . '%';
      } elseif ($cc_list['coupon_type'] == 'S') {
        echo TEXT_FREE_SHIPPING;
      } else {
        echo $currencies->format($cc_list['coupon_amount']);
      }
?>
            &nbsp;</td>
                <td class="dataTableContent" align="center"><?php echo $cc_list['coupon_code']; ?></td>
                <td class="dataTableContent" align="center">
<?php
      echo tep_db_num_rows($redeem_query);   // number of redemptions
?>
                <td class="dataTableContent" align="center">
<?php
      if ($cc_list['coupon_active'] == 'Y') {
        echo tep_image(DIR_WS_IMAGES . 'icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_COUPON_ADMIN, 'action=setflag&flag=N&cid=' . $cc_list['coupon_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
      } else {
        echo '<a href="' . tep_href_link(FILENAME_COUPON_ADMIN, 'action=setflag&flag=Y&cid=' . $cc_list['coupon_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
      }
?></td>
                <td class="dataTableContent" align="right"><?php if ( (is_object($cInfo)) && ($cc_list['coupon_id'] == $cInfo->coupon_id) ) { echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif'); } else { echo '<a href="' . tep_href_link(FILENAME_COUPON_ADMIN, 'page=' . $HTTP_GET_VARS['page'] . '&cid=' . $cc_list['coupon_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
      $redeem_date = '';
      while ($redeem_list = tep_db_fetch_array($redeem_query)) {   // retrieve last redeem date
        $redeem_date = $redeem_list['redeem_date'];
      }
      if ( (is_object($cInfo)) && ($cc_list['coupon_id'] == $cInfo->coupon_id) ) {   // store for later
        $rInfo = new objectInfo(array('redeem_date' => $redeem_date));
      }
    }
?>
          <tr>
            <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="smallText">&nbsp;<?php echo $cc_split->display_count($cc_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_COUPONS); ?>&nbsp;</td>
                <td align="right" class="smallText">&nbsp;<?php echo $cc_split->display_links($cc_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page'], 'status=' . $status); ?>&nbsp;</td>
              </tr>

              <tr>
                <td align="right" colspan="2" class="smallText"><?php echo '<a href="' . tep_href_link('coupon_admin.php', 'page=' . $HTTP_GET_VARS['page'] . '&cID=' . $cInfo->coupon_id . '&action=new') . '">' . tep_image_button('button_insert.gif', IMAGE_INSERT) . '</a>'; ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>

<?php

    $heading = array();
    $contents = array();

    switch ($HTTP_GET_VARS['action']) {
    case 'release':
      break;
    case 'voucherreport':
      $heading[] = array('text' => '<b>' . TEXT_HEADING_COUPON_REPORT . '</b>');
      $contents[] = array('text' => TEXT_NEW_INTRO);
      break;
    default:
      $heading[] = array('text'=>'['.$cInfo->coupon_id.']  '.$cInfo->coupon_code);
      $amount = $cInfo->coupon_amount;
      if ($cInfo->coupon_type == 'P') {
        // not floating point value, don't display decimal info
        $amount = (($amount == round($amount)) ? number_format($amount) : number_format($amount, 2)) . '%';
      } else {
        $amount = $currencies->format($amount);
      }
      $coupon_min_order = $currencies->format($cInfo->coupon_minimum_order);
      if ($HTTP_GET_VARS['action'] == 'voucherdelete') {
        $contents[] = array('text'=> TEXT_CONFIRM_DELETE . '</br></br>' .
                '<a href="'.tep_href_link('coupon_admin.php','action=confirmdelete&status=' . $status . (($HTTP_GET_VARS['page'] > 1) ? '&page=' . $HTTP_GET_VARS['page']: '') . '&cid='.$HTTP_GET_VARS['cid'],'NONSSL').'">'.tep_image_button('button_confirm.gif',IMAGE_CONFIRM).'</a>' .
                '<a href="'.tep_href_link('coupon_admin.php','cid='.$cInfo->coupon_id,'NONSSL').'">'.tep_image_button('button_cancel.gif',IMAGE_CANCEL).'</a>'
                );
      } else {
        $prod_details = NONE;
        if ($cInfo->restrict_to_products) {
          $prod_details = '<A HREF="listproducts.php?cid=' . $cInfo->coupon_id . '" TARGET="_blank" ONCLICK="window.open(\'listproducts.php?cid=' . $cInfo->coupon_id . '\', \'Valid_Categories\', \'scrollbars=yes,resizable=yes,menubar=yes,width=600,height=600\'); return false">View</A>';
        }
        $cat_details = NONE;
        if ($cInfo->restrict_to_categories) {
          $cat_details = '<A HREF="listcategories.php?cid=' . $cInfo->coupon_id . '" TARGET="_blank" ONCLICK="window.open(\'listcategories.php?cid=' . $cInfo->coupon_id . '\', \'Valid_Categories\', \'scrollbars=yes,resizable=yes,menubar=yes,width=600,height=600\'); return false">View</A>';
        }
        $coupon_name_query = tep_db_query("select coupon_name from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $cInfo->coupon_id . "' and language_id = '" . $languages_id . "'");
        $coupon_name = tep_db_fetch_array($coupon_name_query);
        $contents[] = array('text'=>COUPON_NAME . '&nbsp;:&nbsp;' . $coupon_name['coupon_name'] . '<br>' .
                     COUPON_AMOUNT . '&nbsp;:&nbsp;' . $amount . '<br>' .
                     REDEEM_DATE_LAST . '&nbsp;:&nbsp;' . ((isset($rInfo->redeem_date)) ? tep_date_short($rInfo->redeem_date) : '') . '<br>' .
                     COUPON_MIN_ORDER . '&nbsp;:&nbsp;' . $coupon_min_order . '<br>' .
                     COUPON_STARTDATE . '&nbsp;:&nbsp;' . tep_date_short($cInfo->coupon_start_date) . '<br>' .
                     COUPON_FINISHDATE . '&nbsp;:&nbsp;' . tep_date_short($cInfo->coupon_expire_date) . '<br>' .
                     COUPON_USES_COUPON . '&nbsp;:&nbsp;' . $cInfo->uses_per_coupon . '<br>' .
                     COUPON_USES_USER . '&nbsp;:&nbsp;' . $cInfo->uses_per_user . '<br>' .
                     COUPON_PRODUCTS . '&nbsp;:&nbsp;' . $prod_details . '<br>' .
                     COUPON_CATEGORIES . '&nbsp;:&nbsp;' . $cat_details . '<br>' .
                     DATE_CREATED . '&nbsp;:&nbsp;' . tep_date_short($cInfo->date_created) . '<br>' .
                     DATE_MODIFIED . '&nbsp;:&nbsp;' . tep_date_short($cInfo->date_modified) . '<br><br>' .
                     '<center><a href="'.tep_href_link('coupon_admin.php','action=email&cid='.$cInfo->coupon_id,'NONSSL').'">'.tep_image_button('button_email.gif',COUPON_BUTTON_EMAIL_VOUCHER).'</a>' .
                     '<a href="'.tep_href_link('coupon_admin.php','action=voucheredit&cid='.$cInfo->coupon_id,'NONSSL').'">'.tep_image_button('button_edit.gif',COUPON_BUTTON_EDIT_VOUCHER).'</a>' .
                     '<a href="'.tep_href_link('coupon_admin.php','action=voucherdelete&status=' . $status . (($HTTP_GET_VARS['page'] > 1) ? '&page=' . $HTTP_GET_VARS['page']: '') . '&cid='.$cInfo->coupon_id,'NONSSL').'">'.tep_image_button('button_delete.gif',COUPON_BUTTON_DELETE_VOUCHER).'</a>' .
                     '<br><a href="'.tep_href_link('coupon_admin.php','action=voucherreport&cid='.$cInfo->coupon_id,'NONSSL').'">'.tep_image_button('button_report.gif',COUPON_BUTTON_VOUCHER_REPORT).'</a></center>');
        }
        break;
      }
?>
    <td width="25%" valign="top">
<?php
      $box = new box;
      echo $box->infoBox($heading, $contents);
    echo '            </td>' . "\n";
    }
?>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>