// BOF Added: Down for Maintenance Hide header if not to show
if (DOWN_FOR_MAINTENANCE == 'false' or DOWN_FOR_MAINTENANCE_HEADER_OFF =='false') {
?>
<!-- header //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr class="header">
    <td valign="middle"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image(DIR_WS_IMAGES . 'store_logo.gif', STORE_NAME) . '</a>'; ?></td>
    <td align="right" valign="bottom"><?php echo '<a href="' . tep_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . tep_image(DIR_WS_ICONS . 'account.png', HEADER_TITLE_MY_ACCOUNT) . '</a>&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_SHOPPING_CART) . '">' . tep_image(DIR_WS_ICONS . 'contents.png', HEADER_TITLE_CART_CONTENTS) . '</a>&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . tep_image(DIR_WS_ICONS . 'checkout.png', HEADER_TITLE_CHECKOUT) . '</a>&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_WISHLIST, '', 'SSL') . '">' . tep_image(DIR_WS_ICONS . 'wishlist.png', HEADER_TITLE_WISHLIST) . '</a>'; ?>&nbsp;&nbsp;</td>
  </tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="1">
  <tr class="headerNavigation">
    <td class="headerNavigation">&nbsp;&nbsp;<?php echo $breadcrumb->trail(' &raquo; '); ?></td>
    <td align="right" class="headerNavigation">&nbsp;|&nbsp;
      <?php if ((tep_session_is_registered('customer_id')) && (!tep_session_is_registered('noaccount'))) // DDB - PWA - 040622 - no display of logoff for PWA customers
	  { ?>
      	<a href="<?php echo tep_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_LOGOFF; ?>
      </a> &nbsp;|&nbsp;
      <?php } ?>

      <?php if (!tep_session_is_registered('noaccount')) // DDB - PWA - 040622 - no display of account for PWA customers
	  { ?>
      	<a href="<?php echo tep_href_link(FILENAME_ACCOUNT, 'my_account_f=1', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_MY_ACCOUNT; ?>						</a> &nbsp;|&nbsp;
	  <?php } ?>

		<a href="<?php echo tep_href_link(FILENAME_SHOPPING_CART); ?>" class="headerNavigation"><?php echo HEADER_TITLE_CART_CONTENTS; ?></a>
      &nbsp;|&nbsp; <a href="<?php echo tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>" class="headerNavigation"><?php echo HEADER_TITLE_CHECKOUT; ?></a>&nbsp;|&nbsp;<a href="<?php echo tep_href_link(FILENAME_WISHLIST, '', 'SSL'); ?>" class="headerNavigation"><?php echo BOX_HEADING_CUSTOMER_WISHLIST; ?></a>&nbsp;</td>
  </tr>
</table>
<!-- header_eof //-->
<?php
}
