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
  case 'reset_admin_log':
	  tep_db_query("delete from " . TABLE_ADMIN_LOG);
	  tep_db_query("optimize table " . TABLE_ADMIN_LOG);
	  $messageStack->add_session(TEXT_ADMIN_LOG_OPTIMISED, 'success');
	  tep_redirect(tep_href_link(FILENAME_STATS_ADMIN_LOGGING));
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
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_USER; ?></td>
                <td class="dataTableHeadingContent"></td>
				<td class="dataTableHeadingContent"><?php echo TABLE_HEADING_EVENT; ?></td>
              </tr>
<?php
  if (isset($_GET['page']) && ($_GET['page'] > 1)) $rows = $_GET['page'] * MAX_DISPLAY_SEARCH_RESULTS - MAX_DISPLAY_SEARCH_RESULTS;
  $logging_query_raw = "select l.login_number, l.user_name, l.ip_address, l.type, l.login_time from " . TABLE_ADMIN_LOG . " l order by l.login_number DESC";

  $logging_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $logging_query_raw, $logging_query_numrows);
// fix counted customers
  $logging_query_numrows = tep_db_query("select login_number from " . TABLE_ADMIN_LOG . " group by login_number");
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
				<td class="dataTableContent"><?php echo tep_datetime_short($logging['login_time']); ?></td>
				<td class="dataTableContent"><?php echo $logging['ip_address']; ?></td>
				<td class="dataTableContent"><?php echo $logging['user_name']; ?></td>
                
		  	  <?php
				switch($logging['type']) {
		          case 'Wrong Password':
                    echo '<td></td><td class="dataTableContent">' . TEXT_WRONG_PASSWORD . '</td>';
                  break;
				  
		          case 'Wrong Username':
                    echo '<td></td><td class="dataTableContent">' . TEXT_WRONG_USERNAME . '</td>';
                  break;
				  
		          case 'Logged In':
                    echo '<td></td><td class="dataTableContent">' . TEXT_LOGGED_IN . '</td>';
                  break;
				  
		          case 'Logged Out':
                    echo '<td></td><td class="dataTableContent">' . TEXT_LOGGED_OUT . '</td>';
                  break;
				} // end switch
				?>
				<?php
			    $pos = strrpos($logging['type'], "Config Change:");
                if ($pos !== false) { 
			      $config_id = str_replace("Config Change: ", "", $logging['type']);
			      $cfg_group_query = tep_db_query("select configuration_title, configuration_description, configuration_group_id from " . TABLE_CONFIGURATION . " where configuration_id = '" . (int)$config_id . "'");
                  $cfg_group = tep_db_fetch_array($cfg_group_query);
			      ?>
                  <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=' . $cfg_group['configuration_group_id']) . '&amp;cID=' . (int)$config_id . '">' . tep_image(DIR_WS_ICONS . 'page_white_edit.png', ''); ?></a></td>
				  <td class="dataTableContent"><?php echo '<span title="' . $cfg_group['configuration_title'] . '|' . strip_tags($cfg_group['configuration_description'], '<p><br><b>') . '">' . TEXT_CONFIG_CHANGE . $config_id; ?></span></td>
                <?php 
				} // end if
			    ?>
                </tr>

<?php
  }
?>
            </table></td>
          </tr>
          <tr>
            <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="smallText" align="left" width="45%"><?php echo $logging_split->display_count($logging_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_LOGS); ?></td>
                <td class="smallText" align="center" width="10%"><?php echo '<a href="' . tep_href_link(FILENAME_STATS_ADMIN_LOGGING, 'action=reset_admin_log') . '">' . tep_image_button('button_reset.gif', IMAGE_RESET) . '</a>'; ?></td>
                <td class="smallText" align="right" width="45%"><?php echo $logging_split->display_links($logging_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?>&nbsp;</td>
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