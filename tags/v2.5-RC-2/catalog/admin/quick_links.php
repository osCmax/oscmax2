<?php
/*
$Id: quick_links.php 3 2010-03-31 user pgm

  osCmax e-Commerce
  http://oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'insert':
        $quick_links_id = tep_db_prepare_input($_POST['quick_links_id']);
		$quick_links_image = tep_db_prepare_input($_POST['quick_links_image']);
        $quick_links_name = tep_db_prepare_input($_POST['quick_links_name']);
        $quick_links_link = tep_db_prepare_input($_POST['quick_links_link']);
        $quick_links_target = tep_db_prepare_input($_POST['quick_links_target']);
        $quick_links_sort_order = tep_db_prepare_input($_POST['quick_links_sort_order']);
		$quick_links_cg = tep_db_prepare_input($_POST['quick_links_cg']);

        tep_db_query("insert into " . TABLE_QUICK_LINKS . " (quick_links_id, quick_links_image, quick_links_name, quick_links_link, quick_links_target, quick_links_sort_order, quick_links_cg, date_added) values ('" . (int)$quick_links_id . "', '" . $quick_links_image . "', '" . $quick_links_name . "', '" . tep_db_input($quick_links_link) . "', '" . tep_db_input($quick_links_target) . "', '" . tep_db_input($quick_links_sort_order) . "', '" . tep_db_input($quick_links_cg) . "', now())");

        tep_redirect(tep_href_link(FILENAME_QUICK_LINKS));
        break;
      case 'save':
        $quick_links_id = tep_db_prepare_input($_GET['tID']);
		$quick_links_image = tep_db_prepare_input($_POST['quick_links_image']);
        $quick_links_name = tep_db_prepare_input($_POST['quick_links_name']);
        $quick_links_link = tep_db_prepare_input($_POST['quick_links_link']);
        $quick_links_target = tep_db_prepare_input($_POST['quick_links_target']);
        $quick_links_sort_order = tep_db_prepare_input($_POST['quick_links_sort_order']);
		$quick_links_cg = tep_db_prepare_input($_POST['quick_links_cg']);

        tep_db_query("update " . TABLE_QUICK_LINKS . " set quick_links_id = '" . (int)$quick_links_id . "', quick_links_image = '" . $quick_links_image . "', quick_links_name = '" . $quick_links_name . "', quick_links_link = '" . tep_db_input($quick_links_link) . "', quick_links_target = '" . tep_db_input($quick_links_target) . "', quick_links_sort_order = '" . tep_db_input($quick_links_sort_order) . "', quick_links_cg = '" . tep_db_input($quick_links_cg) . "', last_modified = now() where quick_links_id = '" . (int)$quick_links_id . "'");

        tep_redirect(tep_href_link(FILENAME_QUICK_LINKS, 'page=' . $_GET['page'] . '&tID=' . $quick_links_id));
        break;
      case 'deleteconfirm':
        $quick_links_id = tep_db_prepare_input($_GET['tID']);

        tep_db_query("delete from " . TABLE_QUICK_LINKS . " where quick_links_id = '" . (int)$quick_links_id . "'");

        tep_redirect(tep_href_link(FILENAME_QUICK_LINKS, 'page=' . $_GET['page']));
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
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_QUICK_LINKS_IMAGE; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_QUICK_LINKS_NAME; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_QUICK_LINKS_LINK; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_QUICK_LINKS_TARGET; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_QUICK_LINKS_SORT_ORDER; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_QUICK_LINKS_CG; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="right">&nbsp;</td>
              </tr>
<?php
  $quick_links_query_raw = "select quick_links_id, quick_links_image, quick_links_name, quick_links_sort_order, quick_links_link, quick_links_target, quick_links_cg, date_added, last_modified from " . TABLE_QUICK_LINKS . " order by quick_links_sort_order";
  $quick_links_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $quick_links_query_raw, $quick_links_query_numrows);
  $quick_links_query = tep_db_query($quick_links_query_raw);
  while ($links = tep_db_fetch_array($quick_links_query)) {
    if ((!isset($_GET['tID']) || (isset($_GET['tID']) && ($_GET['tID'] == $links['quick_links_id']))) && !isset($trInfo) && (substr($action, 0, 3) != 'new')) {
      $trInfo = new objectInfo($links);
    }

    if (isset($trInfo) && is_object($trInfo) && ($links['quick_links_id'] == $trInfo->quick_links_id)) {
      echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_QUICK_LINKS, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->quick_links_id . '&amp;action=edit') . '\'">' . "\n";
    } else {
      echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_QUICK_LINKS, 'page=' . $_GET['page'] . '&amp;tID=' . $links['quick_links_id']) . '\'">' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo $links['quick_links_image']; ?></td>
                <td class="dataTableContent"><?php echo $links['quick_links_name']; ?></td>
                <td class="dataTableContent"><?php echo $links['quick_links_link']; ?></td>
                <td class="dataTableContent"><?php echo $links['quick_links_target']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $links['quick_links_sort_order']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $links['quick_links_cg']; ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($trInfo) && is_object($trInfo) && ($links['quick_links_id'] == $trInfo->quick_links_id)) { echo tep_image(DIR_WS_ICONS . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_QUICK_LINKS, 'page=' . $_GET['page'] . '&amp;tID=' . $links['quick_links_id']) . '">' . tep_image(DIR_WS_ICONS . 'information.png', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
  }
?>
              <tr>
                <td colspan="7"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $quick_links_split->display_count($quick_links_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_QUICK_LINKS); ?></td>
                    <td class="smallText" align="right"><?php echo $quick_links_split->display_links($quick_links_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
<?php
  if (empty($action)) {
?>
                  <tr>
                    <td colspan="7" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_QUICK_LINKS, 'page=' . $_GET['page'] . '&amp;action=new') . '">' . tep_image_button('button_insert.gif', IMAGE_INSERT) . '</a>'; ?></td>
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
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_QUICK_LINKS . '</b>');

      $contents = array('form' => tep_draw_form('links', FILENAME_QUICK_LINKS, 'page=' . $_GET['page'] . '&amp;action=insert'));
      $contents[] = array('text' => TEXT_QUICK_LINKS_INSERT_INTRO);
      $contents[] = array('text' => '<br>' . TEXT_QUICK_LINKS_IMAGE . '<br>' . tep_draw_input_field('quick_links_image'));
      $contents[] = array('text' => '<br>' . TEXT_QUICK_LINKS_NAME . '<br>' . tep_draw_input_field('quick_links_name'));
	  $contents[] = array('text' => '<br>' . TEXT_QUICK_LINKS_LINK . '<br>' . tep_draw_input_field('quick_links_link'));
      $contents[] = array('text' => '<br>' . TEXT_QUICK_LINKS_TARGET . '<br>' . tep_draw_input_field('quick_links_target'));
      $contents[] = array('text' => '<br>' . TEXT_QUICK_LINKS_SORT_ORDER . '<br>' . tep_draw_input_field('quick_links_sort_order'));
      $contents[] = array('text' => '<br>' . TEXT_QUICK_LINKS_CG . '<br>' . tep_draw_input_field('quick_links_cg'));
	  
	  $admin_group_query = tep_db_query("select admin_groups_id, admin_groups_name from " . TABLE_ADMIN_GROUPS . " order by admin_groups_id");
      while ($admin_groups = tep_db_fetch_array($admin_group_query)) {
	  $contents[] = array('text' => $admin_groups['admin_groups_id'] . ' = ' . $admin_groups['admin_groups_name']);  
	  }
	  
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_insert.gif', IMAGE_INSERT) . '&nbsp;<a href="' . tep_href_link(FILENAME_QUICK_LINKS, 'page=' . $_GET['page']) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'edit':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_EDIT_QUICK_LINKS . '</b>');

      $contents = array('form' => tep_draw_form('links', FILENAME_QUICK_LINKS, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->quick_links_id  . '&amp;action=save'));
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      $contents[] = array('text' => '<br>' . TEXT_QUICK_LINKS_IMAGE . '<br>' . tep_draw_input_field('quick_links_image', $trInfo->quick_links_image));		
	  $contents[] = array('text' => '<br>' . TEXT_QUICK_LINKS_NAME . '<br>' . tep_draw_input_field('quick_links_name', $trInfo->quick_links_name));
      $contents[] = array('text' => '<br>' . TEXT_QUICK_LINKS_LINK . '<br>' . tep_draw_input_field('quick_links_link', $trInfo->quick_links_link));
      $contents[] = array('text' => '<br>' . TEXT_QUICK_LINKS_TARGET . '<br>' . tep_draw_input_field('quick_links_target', $trInfo->quick_links_target));
      $contents[] = array('text' => '<br>' . TEXT_QUICK_LINKS_SORT_ORDER . '<br>' . tep_draw_input_field('quick_links_sort_order', $trInfo->quick_links_sort_order));
	  $contents[] = array('text' => '<br>' . TEXT_QUICK_LINKS_CG . '<br>' . tep_draw_input_field('quick_links_cg', $trInfo->quick_links_cg));
	  
	  $admin_group_query = tep_db_query("select admin_groups_id, admin_groups_name from " . TABLE_ADMIN_GROUPS . " order by admin_groups_id");
      while ($admin_groups = tep_db_fetch_array($admin_group_query)) {
	  $contents[] = array('text' => $admin_groups['admin_groups_id'] . ' = ' . $admin_groups['admin_groups_name']);  
	  }
	  
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . tep_href_link(FILENAME_QUICK_LINKS, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->quick_links_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_QUICK_LINKS . '</b>');

      $contents = array('form' => tep_draw_form('links', FILENAME_QUICK_LINKS, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->quick_links_id  . '&amp;action=deleteconfirm'));
      $contents[] = array('text' => TEXT_QUICK_LINKS_DELETE_INTRO);
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . '&nbsp;<a href="' . tep_href_link(FILENAME_QUICK_LINKS, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->quick_links_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (is_object($trInfo)) {
        $heading[] = array('text' => '<b>' . HEADING_TITLE . '</b>');
						
		$contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_QUICK_LINKS, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->quick_links_id . '&amp;action=edit') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_QUICK_LINKS, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->quick_links_id . '&amp;action=delete') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_QUICK_LINKS_DATE_ADDED . ' ' . tep_date_short($trInfo->date_added));
        $contents[] = array('text' => '' . TEXT_QUICK_LINKS_LAST_MODIFIED . ' ' . tep_date_short($trInfo->last_modified));
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