<?php
/*
$Id: slideshow.php 3 2010-03-31 user pgm

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
        $slideshow_id = tep_db_prepare_input($_POST['slideshow_id']);
		$slideshow_image = tep_db_prepare_input($_POST['slideshow_image']);
        $slideshow_title = tep_db_prepare_input($_POST['slideshow_title']);
        $slideshow_link = tep_db_prepare_input($_POST['slideshow_link']);
        $slideshow_target = tep_db_prepare_input($_POST['slideshow_target']);
        $slideshow_sort_order = tep_db_prepare_input($_POST['slideshow_sort_order']);

        tep_db_query("insert into " . TABLE_SLIDESHOW . " (slideshow_id, slideshow_image, slideshow_title, slideshow_link, slideshow_target, slideshow_sort_order, date_added) values ('" . (int)$slideshow_id . "', '" . $slideshow_image . "', '" . $slideshow_title . "', '" . tep_db_input($slideshow_link) . "', '" . tep_db_input($slideshow_target) . "', '" . tep_db_input($slideshow_sort_order) . "', now())");

        tep_redirect(tep_href_link(FILENAME_SLIDESHOW));
        break;
      case 'save':
        $slideshow_id = tep_db_prepare_input($_GET['tID']);
		$slideshow_image = tep_db_prepare_input($_POST['slideshow_image']);
        $slideshow_title = tep_db_prepare_input($_POST['slideshow_title']);
        $slideshow_link = tep_db_prepare_input($_POST['slideshow_link']);
        $slideshow_target = tep_db_prepare_input($_POST['slideshow_target']);
        $slideshow_sort_order = tep_db_prepare_input($_POST['slideshow_sort_order']);

        tep_db_query("update " . TABLE_SLIDESHOW . " set slideshow_id = '" . (int)$slideshow_id . "', slideshow_image = '" . $slideshow_image . "', slideshow_title = '" . $slideshow_title . "', slideshow_link = '" . tep_db_input($slideshow_link) . "', slideshow_target = '" . tep_db_input($slideshow_target) . "', slideshow_sort_order = '" . tep_db_input($slideshow_sort_order) . "', last_modified = now() where slideshow_id = '" . (int)$slideshow_id . "'");

        tep_redirect(tep_href_link(FILENAME_SLIDESHOW, 'page=' . $_GET['page'] . '&tID=' . $slideshow_id));
        break;
      case 'deleteconfirm':
        $slideshow_id = tep_db_prepare_input($_GET['tID']);

        tep_db_query("delete from " . TABLE_SLIDESHOW . " where slideshow_id = '" . (int)$slideshow_id . "'");

        tep_redirect(tep_href_link(FILENAME_SLIDESHOW, 'page=' . $_GET['page']));
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
                <td class="dataTableHeadingContent"  width="140"><?php echo TABLE_HEADING_SLIDESHOW_IMAGE; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_SLIDESHOW_TITLE; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_SLIDESHOW_LINK; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_SLIDESHOW_TARGET; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_SLIDESHOW_SORT_ORDER; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="right">&nbsp;</td>
              </tr>
<?php
  $slideshow_query_raw = "select slideshow_id, slideshow_image, slideshow_title, slideshow_sort_order, slideshow_link, slideshow_target, date_added, last_modified from " . TABLE_SLIDESHOW . " order by slideshow_sort_order";
  $slideshow_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $slideshow_query_raw, $slideshow_query_numrows);
  $slideshow_query = tep_db_query($slideshow_query_raw);
  while ($links = tep_db_fetch_array($slideshow_query)) {
    if ((!isset($_GET['tID']) || (isset($_GET['tID']) && ($_GET['tID'] == $links['slideshow_id']))) && !isset($trInfo) && (substr($action, 0, 3) != 'new')) {
      $trInfo = new objectInfo($links);
    }

    if (isset($trInfo) && is_object($trInfo) && ($links['slideshow_id'] == $trInfo->slideshow_id)) {
      echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_SLIDESHOW, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->slideshow_id . '&amp;action=edit') . '\'">' . "\n";
    } else {
      echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_SLIDESHOW, 'page=' . $_GET['page'] . '&amp;tID=' . $links['slideshow_id']) . '\'">' . "\n";
    }
?>
                <td class="dataTableContent" width="140"><?php echo tep_image(' ../' . DIR_WS_IMAGES . 'slideshow/' . $links['slideshow_image'] . '', 'Slide', '130', '50'); ?></td>
                <td class="dataTableContent"><?php echo $links['slideshow_title']; ?></td>
                <td class="dataTableContent"><?php echo $links['slideshow_link']; ?></td>
                <td class="dataTableContent"><?php echo $links['slideshow_target']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $links['slideshow_sort_order']; ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($trInfo) && is_object($trInfo) && ($links['slideshow_id'] == $trInfo->slideshow_id)) { echo tep_image(DIR_WS_ICONS . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_SLIDESHOW, 'page=' . $_GET['page'] . '&amp;tID=' . $links['slideshow_id']) . '">' . tep_image(DIR_WS_ICONS . 'information.png', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
  }
?>
              <tr>
                <td colspan="6"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $slideshow_split->display_count($slideshow_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_SLIDESHOW); ?></td>
                    <td class="smallText" align="right"><?php echo $slideshow_split->display_links($slideshow_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
<?php
  if (empty($action)) {
?>
                  <tr>
                    <td colspan="6" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_SLIDESHOW, 'page=' . $_GET['page'] . '&amp;action=new') . '">' . tep_image_button('button_insert.gif', IMAGE_NEW_TAX_RATE) . '</a>'; ?></td>
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
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_SLIDESHOW . '</b>');

      $contents = array('form' => tep_draw_form('links', FILENAME_SLIDESHOW, 'page=' . $_GET['page'] . '&amp;action=insert'));
      $contents[] = array('text' => TEXT_SLIDESHOW_INSERT_INTRO);
      $contents[] = array('text' => '<br>' . TEXT_SLIDESHOW_IMAGE . '<br>' . tep_draw_input_field('slideshow_image'));
      $contents[] = array('text' => '<br>' . TEXT_SLIDESHOW_TITLE . '<br>' . tep_draw_input_field('slideshow_title'));
	  $contents[] = array('text' => '<br>' . TEXT_SLIDESHOW_LINK . '<br>' . tep_draw_input_field('slideshow_link'));
      $contents[] = array('text' => '<br>' . TEXT_SLIDESHOW_TARGET . '<br>' . tep_draw_input_field('slideshow_target'));
      $contents[] = array('text' => '<br>' . TEXT_SLIDESHOW_SORT_ORDER . '<br>' . tep_draw_input_field('slideshow_sort_order'));
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_insert.gif', IMAGE_INSERT) . '&nbsp;<a href="' . tep_href_link(FILENAME_SLIDESHOW, 'page=' . $_GET['page']) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'edit':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_EDIT_SLIDESHOW . '</b>');

      $contents = array('form' => tep_draw_form('links', FILENAME_SLIDESHOW, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->slideshow_id  . '&amp;action=save'));
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      $contents[] = array('text' => '<br>' . TEXT_SLIDESHOW_IMAGE . '<br>' . tep_draw_input_field('slideshow_image', $trInfo->slideshow_image));		
	  $contents[] = array('text' => '<br>' . TEXT_SLIDESHOW_TITLE . '<br>' . tep_draw_input_field('slideshow_title', $trInfo->slideshow_title));
      $contents[] = array('text' => '<br>' . TEXT_SLIDESHOW_LINK . '<br>' . tep_draw_input_field('slideshow_link', $trInfo->slideshow_link));
      $contents[] = array('text' => '<br>' . TEXT_SLIDESHOW_TARGET . '<br>' . tep_draw_input_field('slideshow_target', $trInfo->slideshow_target));
      $contents[] = array('text' => '<br>' . TEXT_SLIDESHOW_SORT_ORDER . '<br>' . tep_draw_input_field('slideshow_sort_order', $trInfo->slideshow_sort_order));
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . tep_href_link(FILENAME_SLIDESHOW, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->slideshow_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_SLIDESHOW . '</b>');

      $contents = array('form' => tep_draw_form('links', FILENAME_SLIDESHOW, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->slideshow_id  . '&amp;action=deleteconfirm'));
      $contents[] = array('text' => TEXT_SLIDESHOW_DELETE_INTRO);
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . '&nbsp;<a href="' . tep_href_link(FILENAME_SLIDESHOW, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->slideshow_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (is_object($trInfo)) {
        $heading[] = array('text' => '<b>' . HEADING_TITLE . '</b>');
						
		$contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_SLIDESHOW, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->slideshow_id . '&amp;action=edit') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_SLIDESHOW, 'page=' . $_GET['page'] . '&amp;tID=' . $trInfo->slideshow_id . '&amp;action=delete') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_SLIDESHOW_DATE_ADDED . ' ' . tep_date_short($trInfo->date_added));
        $contents[] = array('text' => '' . TEXT_SLIDESHOW_LAST_MODIFIED . ' ' . tep_date_short($trInfo->last_modified));
		$contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=204', 'NONSSL') . '">' . tep_image_button('button_settings.gif', IMAGE_SETTINGS) . '</a><br><br>');
      }
      break;
  }

  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";

    $box = new box;
    echo $box->infoBox($heading, $contents);

    echo '            </td>' . "\n";
  } else {
	$heading[] = array('text' => HEADING_NO_SLIDESHOW);
    $contents[] = array('text' => TEXT_NO_SLIDESHOW);  
	$contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=204', 'NONSSL') . '">' . tep_image_button('button_settings.gif', IMAGE_SETTINGS) . '</a><br><br>');
	  
	echo '            <td width="25%" valign="top">';
	$box = new box;
    echo $box->infoBox($heading, $contents);
    echo '            </td>';  
  
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