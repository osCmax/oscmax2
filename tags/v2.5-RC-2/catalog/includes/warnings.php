<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// check if the 'install' directory exists, and warn of its existence
  if (WARN_INSTALL_EXISTENCE == 'true') {
    if (file_exists(dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/install')) {
      $messageStack->add('header', WARNING_INSTALL_DIRECTORY_EXISTS, 'warning');
    }
  }

// check if the configure.php file is writeable
  if (WARN_CONFIG_WRITEABLE == 'true') {
    if ( (file_exists(dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php')) && (is_writeable(dirname($HTTP_SERVER_VARS['SCRIPT_FILENAME']) . '/includes/configure.php')) ) {
      $messageStack->add('header', WARNING_CONFIG_FILE_WRITEABLE, 'warning');
    }
  }

// check if the session folder is writeable
  if (WARN_SESSION_DIRECTORY_NOT_WRITEABLE == 'true') {
    if (STORE_SESSIONS == '') {
      if (!is_dir(tep_session_save_path())) {
        $messageStack->add('header', WARNING_SESSION_DIRECTORY_NON_EXISTENT, 'warning');
      } elseif (!is_writeable(tep_session_save_path())) {
        $messageStack->add('header', WARNING_SESSION_DIRECTORY_NOT_WRITEABLE, 'warning');
      }
    }
  }

//Check if Warn before down for maintenance is enabled
  if ( (WARN_BEFORE_DOWN_FOR_MAINTENANCE == 'true') && (DOWN_FOR_MAINTENANCE == 'false') ) {
    $messageStack->add('header', TEXT_BEFORE_DOWN_FOR_MAINTENANCE . PERIOD_BEFORE_DOWN_FOR_MAINTENANCE, 'warning');
  }

// Check for IE6
if (IE6_CHECK == 'true') {
  $browser = $_SERVER['HTTP_USER_AGENT'];
  $pos = (strrpos($browser, "MSIE 6.0"));
	if($pos > 0) { 
      $messageStack->add('header', WARNING_IE6_DETECTED, 'warning');
	}
}

// check session.auto_start is disabled
  if ( (function_exists('ini_get')) && (WARN_SESSION_AUTO_START == 'true') ) {
    if (ini_get('session.auto_start') == '1') {
      $messageStack->add('header', WARNING_SESSION_AUTO_START, 'warning');
    }
  }

  if ( (WARN_DOWNLOAD_DIRECTORY_NOT_READABLE == 'true') && (DOWNLOAD_ENABLED == 'true') ) {
    if (!is_dir(DIR_FS_DOWNLOAD)) {
      $messageStack->add('header', WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT, 'warning');
    }
  }

// BOF QPBPP for SPPC
// query names of products for which the min order quantity was not met or 
// didn't match the quantity blocks
  $moq_pids = array();
  $qtb_pids = array();
  if (isset($_SESSION['min_order_qty_not_met']) && count($_SESSION['min_order_qty_not_met']) > 0) {
    foreach ($_SESSION['min_order_qty_not_met'] as $moq_key => $moq_pid) {
      if ((int)$moq_pid > 0) {
        $moq_pids[] = (int)$moq_pid;
      }
    }
  } // end if (isset($_SESSION['min_order_qty_not_met']) && ...

  if (isset($_SESSION['qty_blocks_not_met']) && count($_SESSION['qty_blocks_not_met']) > 0) {
    foreach ($_SESSION['qty_blocks_not_met'] as $qtb_key => $qtb_pid) {
      if ((int)$qtb_pid > 0) {
        $qtb_pids[] = (int)$qtb_pid;
      }
    }
   } // end if (isset($_SESSION['qty_blocks_not_met']) &&
   $moq_qtb_pids = array_merge($moq_pids, $qtb_pids);
   $moq_qtb_pids = array_unique($moq_qtb_pids);

    if (count($moq_qtb_pids) > 0  && tep_not_null($moq_qtb_pids[0])) {
        if (isset($_SESSION['sppc_customer_group_id']) && $_SESSION['sppc_customer_group_id'] != '0') {
           $customer_group_id = $_SESSION['sppc_customer_group_id'];
        } else {
           $customer_group_id = '0';
        }
        if ($customer_group_id == '0') {
          $product_names_query = tep_db_query("select p.products_id, pd.products_name, p.products_min_order_qty, p.products_qty_blocks from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id in (" . implode(',', $moq_qtb_pids) . ") and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'");
        } else {
          $product_names_query = tep_db_query("select pd.products_id, pd.products_name, pg.products_min_order_qty, pg.products_qty_blocks from " . TABLE_PRODUCTS_DESCRIPTION . " pd left join (select products_id, products_min_order_qty, products_qty_blocks from " . TABLE_PRODUCTS_GROUPS . " where customers_group_id = '" . $customer_group_id . "' and products_id in (" . implode(',', $moq_qtb_pids) . ")) pg on pd.products_id = pg.products_id where pd.products_id in (" . implode(',', $moq_qtb_pids) . ") and pd.language_id = '" . (int)$languages_id . "'");
        }
      while ($_product_names = tep_db_fetch_array($product_names_query)) {
        if (in_array($_product_names['products_id'], $moq_pids)) {
          $messageStack->add('cart_notice', sprintf(MINIMUM_ORDER_NOTICE, $_product_names['products_name'], $_product_names['products_min_order_qty']), 'warning');
        }
        if (in_array($_product_names['products_id'], $qtb_pids)) {
          $messageStack->add('cart_notice', sprintf(QUANTITY_BLOCKS_NOTICE, $_product_names['products_name'], $_product_names['products_qty_blocks']), 'warning');
        }
      }      
    } // end if (count($moq_qtb_pids) > 0))
// EOF QPBPP for SPPC

  if ($messageStack->size('header') > 0) {
    echo $messageStack->output('header');
  }
// BOF QPBPP for SPPC
// show messages in header if the page we are at is not catalog/shopping_cart.php
  if (basename($_SERVER['PHP_SELF']) != FILENAME_SHOPPING_CART && $messageStack->size('cart_notice') > 0) {
    echo $messageStack->output('cart_notice');
  }
// EOF QPBPP for SPPC

  if (isset($_GET['error_message']) && tep_not_null($_GET['error_message'])) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr class="headerError">
    <td class="headerError"><?php echo htmlspecialchars(stripslashes(urldecode($_GET['error_message']))); ?></td>
  </tr>
</table>
<?php
  }

  if (isset($_GET['info_message']) && tep_not_null($_GET['info_message'])) {
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr class="headerInfo">
    <td class="headerInfo"><?php echo htmlspecialchars(stripslashes(urldecode($_GET['info_message']))); ?></td>
  </tr>
</table>
<?php
  }

// Check for javascript enabled
if (JAVASCRIPT_CHECK == 'true') {
?>

<noscript>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td class="messageStackAlert"><?php echo tep_image(DIR_WS_ICONS . 'warning.gif'); ?> <a href="http://www.google.com/search?q=enable+javascript+browser" target="_blank" class="nojavascript"><?php echo WARNING_JAVASCRIPT_DISABLED; ?></a></td>
  </tr>
</table>
</noscript>

<?php 
}
?>