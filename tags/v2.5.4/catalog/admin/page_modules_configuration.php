<?php
/*
$Id: page_modules_configuration.php 3 2010-03-31 user pgm

  osCmax e-Commerce
  http://oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
		
	  case 'setflag': 
        if (($_GET['flag'] == '0') || ($_GET['flag'] == '1')) {
          if ($_GET['tID']) {
            tep_db_query("update " . TABLE_PM_CONFIGURATION . " set pm_active = '" . $_GET['flag'] . "' where pm_id = '" . $_GET['tID'] . "'");
          }
        }
 	    tep_redirect(tep_href_link(FILENAME_PM_CONFIGURATION, 'page=' . $_GET['page'] . '&tID=' . $_GET['tID']));
      break;
      
	  case 'insert':
        $pm_id = tep_db_prepare_input($_POST['pm_id']);
		$pm_title = tep_db_prepare_input($_POST['pm_title']);
        $pm_filename = tep_db_prepare_input($_POST['pm_filename']);
        $pm_page = tep_db_prepare_input($_POST['pm_page']);
		$pm_active = tep_db_prepare_input($_POST['pm_active']);
		$pm_cg_hide = tep_db_prepare_input($_POST['pm_cg_hide']);
        $pm_sort_order = tep_db_prepare_input($_POST['pm_sort_order']);

        tep_db_query("insert into " . TABLE_PM_CONFIGURATION . " (pm_id, pm_title, pm_filename, pm_page, pm_active, pm_cg_hide, pm_sort_order, date_added) values ('" . (int)$pm_id . "', '" . $pm_title . "', '" . $pm_filename . "', '" . tep_db_input($pm_page) . "', '" . tep_db_input($pm_active) . "', '" . tep_db_input($pm_cg_hide) . "', '" . tep_db_input($pm_sort_order) . "', now())");

        tep_redirect(tep_href_link(FILENAME_PM_CONFIGURATION));
      break;
	  
      case 'save':
        $pm_id = tep_db_prepare_input($_GET['tID']);
		$pm_title = tep_db_prepare_input($_POST['pm_title']);
        $pm_filename = tep_db_prepare_input($_POST['pm_filename']);
        $pm_page = tep_db_prepare_input($_POST['pm_page']);
		$pm_active = tep_db_prepare_input($_POST['pm_active']);
		$pm_cg_hide = tep_db_prepare_input($_POST['pm_cg_hide']);
        $pm_sort_order = tep_db_prepare_input($_POST['pm_sort_order']);
        
        tep_db_query("update " . TABLE_PM_CONFIGURATION . " set pm_id = '" . (int)$pm_id . "', pm_title = '" . $pm_title . "', pm_filename = '" . $pm_filename . "', pm_page = '" . tep_db_input($pm_page) . "', pm_active = '" . tep_db_input($pm_active) . "', pm_cg_hide = '" . tep_db_input($pm_cg_hide) . "', pm_sort_order = '" . tep_db_input($pm_sort_order) . "', last_modified = now() where pm_id = '" . (int)$pm_id . "'");

        tep_redirect(tep_href_link(FILENAME_PM_CONFIGURATION, 'page=' . $_GET['page'] . '&tID=' . $pm_id));
        break;
      case 'deleteconfirm':
        $pm_id = tep_db_prepare_input($_GET['tID']);

        tep_db_query("delete from " . TABLE_PM_CONFIGURATION . " where pm_id = '" . (int)$pm_id . "'");

        tep_redirect(tep_href_link(FILENAME_PM_CONFIGURATION, 'page=' . $_GET['page']));
        break;
    }
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
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PM_TITLE; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PM_FILENAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PM_PAGE; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_PM_ACTIVE; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_PM_CG_HIDE; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_PM_SORT_ORDER; ?></td>
                <td class="dataTableHeadingContent" align="right">&nbsp;</td>
              </tr>
<?php
  $pm_query_raw = "select pm_id, pm_title, pm_filename, pm_page, pm_active, pm_cg_hide, pm_sort_order, date_added, last_modified from " . TABLE_PM_CONFIGURATION . " order by pm_page, pm_sort_order";
  $pm_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $pm_query_raw, $pm_query_numrows);
  $pm_query = tep_db_query($pm_query_raw);
  while ($links = tep_db_fetch_array($pm_query)) {
    if ((!isset($_GET['tID']) || (isset($_GET['tID']) && ($_GET['tID'] == $links['pm_id']))) && !isset($trInfo) && (substr($action, 0, 3) != 'new')) {
      $trInfo = new objectInfo($links);
    }

    if (isset($trInfo) && is_object($trInfo) && ($links['pm_id'] == $trInfo->pm_id)) {
      echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_PM_CONFIGURATION, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->pm_id . '&amp;action=edit') . '\'">' . "\n";
    } else {
      echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_PM_CONFIGURATION, 'page=' . $_GET['page'] . '&amp;tID=' . $links['pm_id']) . '\'">' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo $links['pm_title']; ?></td>
                <td class="dataTableContent"><?php echo $links['pm_filename']; ?></td>
                <td class="dataTableContent"><?php echo $links['pm_page']; ?></td>               
                <td class="dataTableContent" align="center">
					<?php
                          if ($links['pm_active'] == '1') {
                            echo tep_image(DIR_WS_ICONS .  'icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_PM_CONFIGURATION, 'action=setflag&amp;flag=0&amp;page=' . $_GET['page'] . '&amp;tID=' . $links['pm_id']) . '">' . tep_image(DIR_WS_ICONS . 'icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
                          } else {
                            echo '<a href="' . tep_href_link(FILENAME_PM_CONFIGURATION, 'action=setflag&amp;flag=1&amp;page=' . $_GET['page'] . '&amp;tID=' . $links['pm_id']) . '">' . tep_image(DIR_WS_ICONS . 'icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_ICONS . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
                          }
                    ?>
				</td>
                <td class="dataTableContent" align="center"><?php echo $links['pm_cg_hide']; ?></td>              
                <td class="dataTableContent" align="center"><?php echo $links['pm_sort_order']; ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($trInfo) && is_object($trInfo) && ($links['pm_id'] == $trInfo->pm_id)) { echo tep_image(DIR_WS_ICONS . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_PM_CONFIGURATION, 'page=' . $_GET['page'] . '&amp;tID=' . $links['pm_id']) . '">' . tep_image(DIR_WS_ICONS . 'information.png', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
  }
?>
              <tr>
                <td colspan="7"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $pm_split->display_count($pm_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_PM_CONFIGURATION); ?></td>
                    <td class="smallText" align="right"><?php echo $pm_split->display_links($pm_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
<?php
  if (empty($action)) {
?>
                  <tr>
                    <td colspan="6" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_PM_CONFIGURATION, 'page=' . $_GET['page'] . '&amp;action=new') . '">' . tep_image_button('button_insert.gif', IMAGE_INSERT) . '</a>'; ?></td>
                  </tr>
<?php
  }
?>
                </table></td>
              </tr>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'new':

      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_PM_CONFIGURATION . '</b>');

      $contents = array('form' => tep_draw_form('links', FILENAME_PM_CONFIGURATION, 'page=' . $_GET['page'] . '&amp;action=insert'));
      $contents[] = array('text' => TEXT_PM_CONFIGURATION_INSERT_INTRO);
      $contents[] = array('text' => '<br>' . TEXT_PM_TITLE . '<br>' . tep_draw_input_field('pm_title'));
      $contents[] = array('text' => '<br>' . TEXT_PM_FILENAME . '<br>' . tep_draw_input_field('pm_filename', ''));
	  $contents[] = array('text' => '<br>' . TEXT_PM_PAGE . '<br>' . tep_draw_input_field('pm_page', 'index'));
	  $contents[] = array('text' => '<br>' . TEXT_PM_ACTIVE . '<br>' . tep_select_option(array('1', '0'), pm_active, $trInfo->pm_active));
	  $contents[] = array('text' => '<br>' . TEXT_PM_CG_HIDE . '<br>' . tep_draw_input_field('pm_cg_hide', ''));
      $contents[] = array('text' => '<br>' . TEXT_PM_SORT_ORDER . '<br>' . tep_draw_input_field('pm_sort_order'));
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_insert.gif', IMAGE_INSERT) . '&nbsp;<a href="' . tep_href_link(FILENAME_PM_CONFIGURATION, 'page=' . $_GET['page']) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
    break;
    
	case 'edit':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_PM_CONFIGURATION . '</b>');

      $contents = array('form' => tep_draw_form('links', FILENAME_PM_CONFIGURATION, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->pm_id  . '&amp;action=save'));
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      $contents[] = array('text' => '<br>' . TEXT_PM_TITLE . '<br>' . tep_draw_input_field('pm_title', $trInfo->pm_title));		
	  $contents[] = array('text' => '<br>' . TEXT_PM_FILENAME . '<br>' . tep_draw_input_field('pm_filename', $trInfo->pm_filename));
      $contents[] = array('text' => '<br>' . TEXT_PM_PAGE . '<br>' . tep_draw_input_field('pm_page', $trInfo->pm_page));
	  $contents[] = array('text' => '<br>' . TEXT_PM_ACTIVE . '<br>' . tep_select_option(array('1', '0'), pm_active, $trInfo->pm_active));
	  $contents[] = array('text' => '<br>' . TEXT_PM_CG_HIDE . '<br>' . tep_draw_input_field('pm_cg_hide', $trInfo->pm_cg_hide));
      $contents[] = array('text' => '<br>' . TEXT_PM_SORT_ORDER . '<br>' . tep_draw_input_field('pm_sort_order', $trInfo->pm_sort_order));
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . tep_href_link(FILENAME_PM_CONFIGURATION, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->pm_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
    break;
    
	case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_PM_CONFIGURATION . '</b>');

      $contents = array('form' => tep_draw_form('links', FILENAME_PM_CONFIGURATION, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->pm_id  . '&amp;action=deleteconfirm'));
      $contents[] = array('text' => TEXT_PM_CONFIGURATION_DELETE_INTRO);
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . '&nbsp;<a href="' . tep_href_link(FILENAME_PM_CONFIGURATION, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->pm_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
    break;
    
	default:
      if (is_object($trInfo)) {
        $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_EDIT_PM_CONFIGURATION . '</b>');
						
		$contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_PM_CONFIGURATION, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->pm_id . '&amp;action=edit') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_PM_CONFIGURATION, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->pm_id . '&amp;action=delete') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_PM_CONFIGURATION_DATE_ADDED . ' ' . tep_date_short($trInfo->date_added));
        $contents[] = array('text' => '' . TEXT_PM_CONFIGURATION_LAST_MODIFIED . ' ' . tep_date_short($trInfo->last_modified));
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