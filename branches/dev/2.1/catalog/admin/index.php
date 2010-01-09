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
<script language="javascript" src="includes/general.js"></script>	
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->

<table width="95%" align="center">
<tr><td>

<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Sales</a></li>
        <li><a href="#tabs-2">Products</a></li>
        <li><a href="#tabs-3">Admin Log</a></li>
        <li><a href="#tabs-4">Customer Log</a></li>
        <li><a href="#tabs-5">HTTP Error Log</a></li>
    </ul>

<div id="tabs-1">
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

<div id="tabs-2">
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

<div id="tabs-3">
  <table width="95%" align="center">
    <tr valign="top">
      <td><?php include('includes/modules/dashboard/admin_logging.php'); ?></td>
    </tr>
  </table>
</div>

<div id="tabs-4">
  <table width="95%" align="center">
    <tr valign="top">
      <td><?php include('includes/modules/dashboard/customer_logging.php'); ?></td>
    </tr>
  </table>
</div>

<div id="tabs-5">
  <table width="95%" align="center">
    <tr valign="top">
      <td>HTTP Error Logging Coming Soon!<?php //include('includes/modules/dashboard/http_error.php'); ?></td>
    </tr>
  </table>
</div>

</div>
</td></tr></table>

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
</body>
</html>