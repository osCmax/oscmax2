<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html {htmlparams}>

<head>
{headertags}
{stylesheet}
{suckertree}
{pagename}
</head>
<body>
{warnings}


{templateswitch}
{DFM-headeropen}

<!-- Store width controller -->
<table width="{storewidth}" cellspacing="0" cellpadding="0" align="{storealign}">
<tr><td>

<!-- header //-->
<table border="0" width="100%" cellspacing="0" cellpadding="0">
  <tr class="header">
    <td valign="middle">{mainlogo}</td>
    <td align="right" valign="bottom">{navicongroup}&nbsp;&nbsp;</td>
  </tr>
</table>
<table border="0" width="100%" cellspacing="0" cellpadding="1">
  <tr class="headerNavigation">
    <td class="headerNavigation">&nbsp;&nbsp;{breadcrumbs}</td>
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
{DMF-tagclose}
<!-- body //-->
<table border="0" width="100%" cellspacing="3" cellpadding="3">
  <tr>
  {columnleft}
<!-- content //-->
    <td width="100%" valign="top">
	  {content}
    </td>
<!-- content_eof //-->
  {columnright}
  </tr>
<!-- body_eof //-->
{DMF-footeropen}
<!-- footer //-->

  <tr>
    <td colspan="3">
{modulecontroller}
    </td>
  </tr>
</table>
{banner}
<!-- footer_eof //-->
{DMF-tagclose}
{googleanalytics}
</td></tr>
</table>
<!-- Store width controller -->

{javascript}
{slideshow}
{coolmenu}
{sbcustom}
</body>
</html>
