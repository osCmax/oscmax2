<?php
/*
$Id: stats_customers.php 3 2006-05-27 04:59:07Z user $

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
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr><!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_NUMBER; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TIME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_IP; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_USER; ?></td>
				<td class="dataTableHeadingContent"><?php echo TABLE_HEADING_EVENT; ?></td>
              </tr>
<?php
  if (isset($HTTP_GET_VARS['page']) && ($HTTP_GET_VARS['page'] > 1)) $rows = $HTTP_GET_VARS['page'] * MAX_DISPLAY_SEARCH_RESULTS - MAX_DISPLAY_SEARCH_RESULTS;
  $logging_query_raw = "select l.login_number, l.user_name, l.ip_address, l.type, l.login_time from " . TABLE_CUSTOMER_LOG . " l order by l.login_number DESC";

  $logging_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $logging_query_raw, $logging_query_numrows);
// fix counted customers
  $logging_query_numrows = tep_db_query("select login_number from " . TABLE_CUSTOMER_LOG . " group by login_number");
  $logging_query_numrows = tep_db_num_rows($logging_query_numrows);

  $rows = 0;
  $logging_query = tep_db_query($logging_query_raw);
  while ($logging = tep_db_fetch_array($logging_query)) {
    $rows++;

    if (strlen($rows) < 2) {
      $rows = '0' . $rows;
    }

  $Message = $logging['type'];
  $style = '';

//Set format for row  
  if ($Message == 'Wrong Username') { $style = 'Alert';}
  if ($Message == 'Wrong Password') { $style = 'Warning';}

  echo '<tr class="dataTableRow' . $style . '" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)">';
  
?>
				<td class="dataTableContent"><?php echo $logging['login_number']; ?></td>
				<td class="dataTableContent"><?php echo $logging['login_time']; ?></td>
				<td class="dataTableContent"><?php echo $logging['ip_address']; ?></td>
				<td class="dataTableContent"><?php echo $logging['user_name']; ?></td>
				<td class="dataTableContent"><?php echo $logging['type']; ?></td>
			  </tr>

<?php
  }
?>
          </table></td>
          </tr>
          <tr>
            <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="smallText" valign="top"><?php echo $logging_split->display_count($logging_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_LOGS); ?></td>
                <td class="smallText" align="right"><?php echo $logging_split->display_links($logging_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page']); ?>&nbsp;</td>
              </tr>
            </table></td>
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
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>