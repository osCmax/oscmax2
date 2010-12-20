<?php
/*
$Id: countries.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'insert':
        $countries_name = tep_db_prepare_input($_POST['countries_name']);
        $countries_iso_code_2 = tep_db_prepare_input($_POST['countries_iso_code_2']);
        $countries_iso_code_3 = tep_db_prepare_input($_POST['countries_iso_code_3']);
        $address_format_id = tep_db_prepare_input($_POST['address_format_id']);

        tep_db_query("insert into " . TABLE_COUNTRIES . " (countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) values ('" . tep_db_input($countries_name) . "', '" . tep_db_input($countries_iso_code_2) . "', '" . tep_db_input($countries_iso_code_3) . "', '" . (int)$address_format_id . "')");

        tep_redirect(tep_href_link(FILENAME_COUNTRIES));
        break;
      case 'save':
        $countries_id = tep_db_prepare_input($_GET['cID']);
        $countries_name = tep_db_prepare_input($_POST['countries_name']);
        $countries_iso_code_2 = tep_db_prepare_input($_POST['countries_iso_code_2']);
        $countries_iso_code_3 = tep_db_prepare_input($_POST['countries_iso_code_3']);
        $address_format_id = tep_db_prepare_input($_POST['address_format_id']);

        tep_db_query("update " . TABLE_COUNTRIES . " set countries_name = '" . tep_db_input($countries_name) . "', countries_iso_code_2 = '" . tep_db_input($countries_iso_code_2) . "', countries_iso_code_3 = '" . tep_db_input($countries_iso_code_3) . "', address_format_id = '" . (int)$address_format_id . "' where countries_id = '" . (int)$countries_id . "'");

        tep_redirect(tep_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&cID=' . $countries_id));
        break;
      case 'deleteconfirm':
        $countries_id = tep_db_prepare_input($_GET['cID']);

        tep_db_query("delete from " . TABLE_COUNTRIES . " where countries_id = '" . (int)$countries_id . "'");

        tep_redirect(tep_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page']));
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
        <td><?php echo tep_draw_form('search_countries', FILENAME_COUNTRIES, '', 'get'); ?>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
              <td class="pageHeading" align="right">&nbsp;</td>
              <td class="smallText" align="right"><?php echo HEADING_TITLE_SEARCH . ' ' . tep_draw_input_field('search_countries'); ?></td>
            </tr>
          </table><?php echo tep_hide_session_id(); ?></form>
        </td>
      </tr>      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_COUNTRY_NAME; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_COUNTRY_CODES . ' (2)'; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_COUNTRY_CODES . ' (3)'; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php

    $search = '';
    if (isset($_GET['search_countries']) && tep_not_null($_GET['search_countries'])) {
      $keywords = tep_db_input(tep_db_prepare_input($_GET['search_countries']));
      $search = " where countries_name like '%" . $keywords . "%' or countries_iso_code_2 like '%" . $keywords . "%' or countries_iso_code_3 like '%" . $keywords . "%' ";
    }

  $countries_query_raw = "select countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id from " . TABLE_COUNTRIES . " " . $search . " order by countries_name";
  $countries_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $countries_query_raw, $countries_query_numrows);
  $countries_query = tep_db_query($countries_query_raw);
  while ($countries = tep_db_fetch_array($countries_query)) {
    if ((!isset($_GET['cID']) || (isset($_GET['cID']) && ($_GET['cID'] == $countries['countries_id']))) && !isset($cInfo) && (substr($action, 0, 3) != 'new')) {
      $cInfo = new objectInfo($countries);
    }

    if (isset($cInfo) && is_object($cInfo) && ($countries['countries_id'] == $cInfo->countries_id)) {
      echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&amp;cID=' . $cInfo->countries_id . '&amp;action=edit') . '\'">' . "\n";
    } else {
      echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&amp;cID=' . $countries['countries_id']) . '\'">' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo $countries['countries_name']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $countries['countries_iso_code_2']; ?></td>
                <td class="dataTableContent" align="center"><?php echo $countries['countries_iso_code_3']; ?></td>
                <td class="dataTableContent" align="right"><?php if (isset($cInfo) && is_object($cInfo) && ($countries['countries_id'] == $cInfo->countries_id) ) { echo tep_image(DIR_WS_ICONS . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&amp;cID=' . $countries['countries_id']) . '">' . tep_image(DIR_WS_ICONS . 'information.png', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
  }
?>
              <tr>
                <td colspan="4"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $countries_split->display_count($countries_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_COUNTRIES); ?></td>
                    <td class="smallText" align="right"><?php echo $countries_split->display_links($countries_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], tep_get_all_get_params(array('page', 'cID', 'action'))); ?></td>
                  </tr>
<?php
    if (!empty($keywords)) {
?>
		          <tr>
                    <td colspan="2" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_ZONES) . '">' . tep_image_button('button_reset.gif', IMAGE_RESET) . '</a>'; ?></td>
                  </tr>
<?php
	} elseif (empty($action)) {
?>
                  <tr>
                    <td colspan="2" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&amp;action=new') . '">' . tep_image_button('button_new_country.gif', IMAGE_NEW_COUNTRY) . '</a>'; ?></td>
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

  if ($countries_query_numrows == 0) { $action = 'no_search_results'; }

  switch ($action) {
    case 'no_search_results':
	  $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NO_COUNTRIES_FOUND . '</b>');
      $contents[] = array('text' => TEXT_INFO_NO_COUNTRIES_FOUND);
	  break;
    case 'new':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_COUNTRY . '</b>');

      $contents = array('form' => tep_draw_form('countries', FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&amp;action=insert'));
      $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_NAME . '<br>' . tep_draw_input_field('countries_name'));
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_CODE_2 . '<br>' . tep_draw_input_field('countries_iso_code_2'));
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_CODE_3 . '<br>' . tep_draw_input_field('countries_iso_code_3'));
      $contents[] = array('text' => '<br>' . TEXT_INFO_ADDRESS_FORMAT . '<br>' . tep_draw_pull_down_menu('address_format_id', tep_get_address_formats()));
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_insert.gif', IMAGE_INSERT) . '&nbsp;<a href="' . tep_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page']) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'edit':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_EDIT_COUNTRY . '</b>');

      $contents = array('form' => tep_draw_form('countries', FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&amp;cID=' . $cInfo->countries_id . '&amp;action=save'));
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_NAME . '<br>' . tep_draw_input_field('countries_name', $cInfo->countries_name));
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_CODE_2 . '<br>' . tep_draw_input_field('countries_iso_code_2', $cInfo->countries_iso_code_2));
      $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_CODE_3 . '<br>' . tep_draw_input_field('countries_iso_code_3', $cInfo->countries_iso_code_3));
      $contents[] = array('text' => '<br>' . TEXT_INFO_ADDRESS_FORMAT . '<br>' . tep_draw_pull_down_menu('address_format_id', tep_get_address_formats(), $cInfo->address_format_id));
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . tep_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&amp;cID=' . $cInfo->countries_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_COUNTRY . '</b>');

      $contents = array('form' => tep_draw_form('countries', FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&amp;cID=' . $cInfo->countries_id . '&amp;action=deleteconfirm'));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . $cInfo->countries_name . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . tep_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&amp;cID=' . $cInfo->countries_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (is_object($cInfo)) {
        $heading[] = array('text' => '<b>' . $cInfo->countries_name . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&amp;cID=' . $cInfo->countries_id . '&amp;action=edit') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_COUNTRIES, 'page=' . $_GET['page'] . '&amp;cID=' . $cInfo->countries_id . '&amp;action=delete') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_NAME . '<br>' . $cInfo->countries_name);
        $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_CODE_2 . ' ' . $cInfo->countries_iso_code_2);
        $contents[] = array('text' => '<br>' . TEXT_INFO_COUNTRY_CODE_3 . ' ' . $cInfo->countries_iso_code_3);
        $contents[] = array('text' => '<br>' . TEXT_INFO_ADDRESS_FORMAT . ' ' . $cInfo->address_format_id);
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
