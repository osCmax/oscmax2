<?php
/*
$Id$

  Copyright 2000 - 2011 osCmax

  osCmax e-Commerce
  http://www.oscmax.com

  Released under the GNU General Public License
*/
  require('includes/application_top.php');
  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  include(DIR_WS_LANGUAGES.$language.'/paypal_ipn.php');
  include(DIR_WS_CLASSES . 'paypal_ipn.php');
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/javascript/jquery-ui-1.8.2.custom.css">
<script type="text/javascript" src="includes/general.js"></script>
</head>
<body onLoad="SetFocus();">
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
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ORDER_NUMBER; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TXN_TYPE; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PAYMENT_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_PAYMENT_AMOUNT; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  $ipn_query_raw = "select p.paypal_ipn_id, p.txn_type, p.payment_type, p.payment_status, p.pending_reason, p.mc_currency, p.payer_status, p.mc_currency, p.date_added, po.paypal_ipn_id, po.mc_gross, o.paypal_ipn_id, o.orders_id from " . TABLE_PAYPAL_IPN . " as p, " . TABLE_PAYPAL_IPN_ORDERS . " as po, " .TABLE_ORDERS . " as o  where p.paypal_ipn_id = po.paypal_ipn_id AND po.paypal_ipn_id = o.paypal_ipn_id AND o.paypal_ipn_id = p.paypal_ipn_id order by o.orders_id DESC";
  $ipn_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $ipn_query_raw, $ipn_query_numrows);
  $ipn_query = tep_db_query($ipn_query_raw);
  while ($ipn_trans = tep_db_fetch_array($ipn_query)) {
    if ((!isset($_GET['ipnID']) || (isset($_GET['ipnID']) && ($_GET['ipnID'] == $ipn_trans['paypal_ipn_id']))) && !isset($ipnInfo) ) {
      $ipnInfo = new objectInfo($ipn_trans);
    }

    if (isset($ipnInfo) && is_object($ipnInfo) && ($ipn_trans['paypal_ipn_id'] == $ipnInfo->paypal_ipn_id) ) {
      echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_ORDERS, 'page=' . $_GET['page'] . '&ipnID=' . $ipnInfo->paypal_ipn_id . '&oID=' . $ipnInfo->orders_id . '&action=edit' . '&refer=ipn') . '\'">' . "\n";
    } else {
      echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_PAYPAL_IPN, 'page=' . $_GET['page'] . '&ipnID=' . $ipn_trans['paypal_ipn_id']) . '\'">' . "\n";
    }
?>
                <td class="dataTableContent"> <?php echo $ipn_trans['orders_id'] ?> </td>
                <td class="dataTableContent"> <?php echo paypal_ipn::get_name('txn_type_name','txn_type_id',$ipn_trans['txn_type'],$language,TABLE_PAYPAL_IPN_TXN_TYPE); ?>
                <td class="dataTableContent"><?php echo paypal_ipn::get_name('payment_status_name','payment_status_id',$ipn_trans['payment_status'],$language,TABLE_PAYPAL_IPN_PAYMENT_STATUS); ?></td>
                <td class="dataTableContent" align="right"><?php echo paypal_ipn::get_name('mc_currency_name','mc_currency_id',$ipn_trans['mc_currency'],$language,TABLE_PAYPAL_IPN_MC_CURRENCY).' '.number_format($ipn_trans['mc_gross'], 2); ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($ipnInfo) && is_object($ipnInfo) && ($ipn_trans['paypal_ipn_id'] == $ipnInfo->paypal_ipn_id) ) { echo tep_image(DIR_WS_ICONS . 'icon_arrow_right.gif'); } else { echo '<a href="' . tep_href_link(FILENAME_PAYPAL_IPN, 'page=' . $_GET['page'] . '&ipnID=' . $ipn_trans['paypal_ipn_id']) . '">' . tep_image(DIR_WS_ICONS . 'information.png', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
  }
?>
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $ipn_split->display_count($ipn_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], "Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> IPN's)"); ?></td>
                    <td class="smallText" align="right"><?php echo $ipn_split->display_links($ipn_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'new':
      break;
    case 'edit':
      break;
    case 'delete':
      break;
    default:
      if (is_object($ipnInfo)) {
        $heading[] = array('text' => '<b>' . TEXT_INFO_PAYPAL_IPN_HEADING.' #' . $ipnInfo->paypal_ipn_id . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_ORDERS, tep_get_all_get_params(array('ipnID', 'action')) . 'oID=' . $ipnInfo->orders_id .'&' . 'ipnID=' . $ipnInfo->paypal_ipn_id .'&action=edit' . '&refer=ipn') . '">' . tep_image_button('button_orders.gif', IMAGE_ORDERS) . '</a>');
        $contents[] = array('text' => '<br>' . TABLE_HEADING_DATE_ADDED . ': '. tep_datetime_short($ipnInfo->date_added));
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
