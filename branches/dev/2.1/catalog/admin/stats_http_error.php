<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  
  switch($action) {
// reset the admin log
  case 'reset_http_error':
	  tep_db_query("delete from " . TABLE_HTTP_ERROR);
	  tep_db_query("optimize table " . TABLE_HTTP_ERROR);
	  $messageStack->add_session('Http Error Log data reset (Log start number continues from previous record).  Http Error Log table has been optimized.', 'success');
	  tep_redirect(tep_href_link(FILENAME_STATS_HTTP_ERROR));
  break;
  }

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
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_NUMBER; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_TIME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_IP; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_URL; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_BROWSER; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_REFERER; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ERROR_TYPE; ?></td>
              </tr>
<?php
  if (isset($_GET['page']) && ($_GET['page'] > 1)) $rows = $_GET['page'] * MAX_DISPLAY_SEARCH_RESULTS - MAX_DISPLAY_SEARCH_RESULTS;
  $http_error_query_raw = "select he.error_number, he.error_code, he.error_url, he.error_ip, he. error_browser, he.error_refer, he.error_timestamp from " . TABLE_HTTP_ERROR . " he order by he.error_number DESC";

  $http_error_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $http_error_query_raw, $http_error_query_numrows);
// fix counted customers
  $http_error_query_numrows = tep_db_query("select error_number from " . TABLE_HTTP_ERROR . " group by error_number");
  $http_error_query_numrows = tep_db_num_rows($http_error_query_numrows);

  $rows = 0;
  $http_error_query = tep_db_query($http_error_query_raw);
  while ($http_error = tep_db_fetch_array($http_error_query)) {
    $rows++;

    if (strlen($rows) < 2) {
      $rows = '0' . $rows;
    }

?>
              <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
                <td class="dataTableContent"><?php echo $http_error['error_number']; ?></td>
                <td class="dataTableContent"><?php echo $http_error['error_timestamp']; ?></td>
                <td class="dataTableContent"><?php echo $http_error['error_ip']; ?></td>
                <td class="dataTableContent"><?php echo $http_error['error_url']; ?></td>
                <td class="dataTableContent"><?php echo $http_error['error_browser']; ?></td>
                <td class="dataTableContent"><?php echo $http_error['error_refer']; ?></td>
<td class="dataTableContent"><?php echo $http_error['error_code']; ?></td>
</tr>
<?php
  }
?>
            </table></td>
          </tr>
          <tr>
            <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="smallText" align="left" width="45%"><?php echo $http_error_split->display_count($http_error_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_ERRORS); ?></td>
                <td class="smallText" align="center" width="10%"><?php echo '<a href="' . tep_href_link(FILENAME_STATS_HTTP_ERROR, 'action=reset_http_error') . '">' . tep_image_button('button_reset.gif', IMAGE_RESET) . '</a>'; ?></td>
                <td class="smallText" align="right" width="45%"><?php echo $http_error_split->display_links($http_error_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?>&nbsp;</td>
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