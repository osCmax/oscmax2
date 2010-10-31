<?php
/*
$Id: stats_products_viewed.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

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
<body>
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
<td valign="top">
<table width="95%" align="center">
<tr><td>

<div id="tabs" class="ui-tabs">
    <ul class="ui-tabs ui-tabs-nav">
        <li><a href="#tabs-1"><?php echo TEXT_TAB1; ?></a></li>
        <li><a href="#tabs-2"><?php echo TEXT_TAB2; ?></a></li>
        <li><a href="#tabs-3"><?php echo TEXT_TAB3; ?></a></li>
        <li><a href="#tabs-4"><?php echo TEXT_TAB4; ?></a></li>
        <li><a href="#tabs-5"><?php echo TEXT_TAB5; ?></a></li>
    </ul>

<div id="tabs-1" class="ui-tabs ui-tabs-container ui-tabs-hide">
  <table border="0" width="95%" align="center">
    <tr valign="top">
      <td width="50%" align="center">
        <table border="0" width="100%">
          <tr>
            <td align="center">
              <?php include('includes/modules/dashboard/top_ten_customers.php'); ?>
            </td>
          </tr>
          <tr>
            <td align="center">
              <?php include('includes/modules/dashboard/order_snapshot.php'); ?>
            </td>
          </tr>
          <tr>
            <td align="center">
              <?php include('includes/modules/dashboard/database_snapshot.php'); ?>
            </td>
          </tr>
        </table>
      </td>
      <td width="50%" align="center">
        <?php // include('includes/modules/dashboard/sales_summary.php'); ?>
      </td>
    </tr>
  </table>
</div>

<div id="tabs-2" class="ui-tabs ui-tabs-container ui-tabs-hide">
<table width="95%" align="center">
<tr valign="top">
<td align="center" width="50%">
  <table border="0" width="500" cellspacing="0" cellpadding="2" align="center">
    <tr>
      <td><?php include('includes/modules/dashboard/products_viewed.php'); ?></td>
    </tr>
  </table>
</td>
<td align="center" width="50%">
  <table border="0" width="500" cellspacing="0" cellpadding="2" align="center">
    <tr>
      <td><?php include('includes/modules/dashboard/products_purchased.php'); ?></td>
    </tr>
  </table>
</td>
</tr>
</table>
</div>

<div id="tabs-3" class="ui-tabs-container ui-tabs-hide">
  <table width="95%" align="center">
    <tr valign="top">
      <td><?php include('includes/modules/dashboard/admin_logging.php'); ?></td>
    </tr>
  </table>
</div>

<div id="tabs-4" class="ui-tabs-container ui-tabs-hide">
  <table width="95%" align="center">
    <tr valign="top">
      <td><?php include('includes/modules/dashboard/customer_logging.php'); ?></td>
    </tr>
  </table>
</div>

<div id="tabs-5" class="ui-tabs-container ui-tabs-hide">
  <table width="95%" align="center">
    <tr valign="top">
      <td><?php include('includes/modules/dashboard/http_error.php'); ?></td>
    </tr>
  </table>
</div>

</div>
</td></tr></table>
</table>
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
</body>
</html>