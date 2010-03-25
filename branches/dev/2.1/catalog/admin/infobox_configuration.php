<?php
/*
$Id: infobox_configuration.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if ($_GET['action']) {
    switch ($_GET['action']) {

      case 'setflag': //set the status of a news item.
        if ( ($_GET['flag'] == 'no') || ($_GET['flag'] == 'yes') ) {
          if ($_GET['cID']) {
            tep_db_query("update " . TABLE_THEME_CONFIGURATION . " set configuration_value = '" . $_GET['flag'] . "' where configuration_id = '" . $_GET['cID'] . "'");
          }
        }

tep_redirect(tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=1&cID=' . $cID));
        break;
      case 'setflagcolumn': //set the status of a box left or right.
       if ( ($_GET['flag'] == 'left') || ($_GET['flag'] == 'right') ) {
         if ($_GET['cID']) {
           tep_db_query("update " . TABLE_THEME_CONFIGURATION . " set configuration_column = '" . $_GET['flag'] . "' where configuration_id = '" . $_GET['cID'] . "'");
          }
        }        

tep_redirect(tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=1&cID=' . $cID));
        break;
      case 'save':
        $configuration_value = tep_db_prepare_input($_POST['configuration_value']);
        $configuration_column = tep_db_prepare_input($_POST['configuration_column']);
        $location = tep_db_prepare_input($_POST['location']);
        $cID = tep_db_prepare_input($_GET['cID']);

        tep_db_query("update " . TABLE_THEME_CONFIGURATION . " set location = '" . tep_db_input($location) . "',configuration_column = '" . tep_db_input($configuration_column) . "', configuration_value = '" . tep_db_input($configuration_value) . "', last_modified = now() where configuration_id = '" . tep_db_input($cID) . "'");
        tep_redirect(tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&cID=' . $cID));
        break;

 case 'insert':
      $configuration_title = tep_db_prepare_input($_POST['configuration_title']);
      $configuration_key = tep_db_prepare_input($_POST['configuration_key']);
      $configuration_value = tep_db_prepare_input($_POST['configuration_value']);
      $configuration_column = tep_db_prepare_input($_POST['configuration_column']);
      $location = tep_db_prepare_input($_POST['location']);
      $box_heading = tep_db_prepare_input($_POST['box_heading']);

      tep_db_query("insert into " . TABLE_THEME_CONFIGURATION . " (configuration_title, configuration_value, configuration_key, configuration_column, location, box_heading) values ('" . tep_db_input($configuration_title) . "', '" . tep_db_input($configuration_value) . "', '" . tep_db_input($configuration_key) . "', '" . tep_db_input($configuration_column) . "', '" . tep_db_input($location) . "', '" . tep_db_input($box_heading) . "')");
        tep_redirect(tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=1&cID=' . $cID));

        break;
    case 'deleteconfirm':
      $cID = tep_db_prepare_input($_GET['cID']);;

      tep_db_query("delete from " . TABLE_THEME_CONFIGURATION . " where configuration_id = '" . tep_db_input($cID) . "'");

        tep_redirect(tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=1'));
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
<script language="javascript" src="includes/general.js"></script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onLoad="SetFocus();">
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
            <td class="pageHeading"><?php echo HEADER_TITLE;?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CONFIGURATION_TITLE; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CONFIGURATION_VALUE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_COLUMN; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_SORT_ORDER; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
$count_left=0;
$count_right=0;
  $configuration_query = tep_db_query("select configuration_id, configuration_title, configuration_value, configuration_column, location from " . TABLE_THEME_CONFIGURATION . " where configuration_group_id = '" . $_GET['gID'] . "' order by configuration_column ");
  while ($configuration = tep_db_fetch_array($configuration_query)) {

      $cfgloc = $configuration['location'];
      $cfgValue = $configuration['configuration_value'];
      $cfgcol = $configuration['configuration_column'];
if ($cfgcol != 'left') { $count_right++; } else { $count_left++; }


    if (((!$_GET['cID']) || (@$_GET['cID'] == $configuration['configuration_id'])) && (!$cInfo) && (substr($_GET['action'], 0, 3) != 'new')) {
      $cfg_extra_query = tep_db_query("select configuration_key, configuration_description, configuration_column,date_added, last_modified from " . TABLE_THEME_CONFIGURATION . " where configuration_id = '" . $configuration['configuration_id'] . "'");
      $cfg_extra = tep_db_fetch_array($cfg_extra_query);

      $cInfo_array = array_merge($configuration, $cfg_extra);
      $cInfo = new objectInfo($cInfo_array);
    }

    if ( (is_object($cInfo)) && ($configuration['configuration_id'] == $cInfo->configuration_id) ) {
      echo '                  <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id . '&action=edit') . '\'">' . "\n";
    } else {
      echo '                  <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&cID=' . $configuration['configuration_id']) . '\'">' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo $configuration['configuration_title']; ?></td>
                <td class="dataTableContent">
<?php
      if ($configuration['configuration_value'] == 'yes') {
        echo tep_image(DIR_WS_IMAGES . 'icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'action=setflag&flag=no&cID=' . $configuration['configuration_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
      } else {
        echo '<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'action=setflag&flag=yes&cID=' . $configuration['configuration_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
      }
?></td>
                <td class="dataTableContent" align="right"><?php
      if ($configuration['configuration_column'] == 'left') {
        echo tep_image(DIR_WS_IMAGES . 'icon_infobox_green.gif', IMAGE_INFOBOX_STATUS_GREEN, 14, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'action=setflagcolumn&flag=right&cID=' . $configuration['configuration_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_infobox_red_light.gif', IMAGE_INFOBOX_STATUS_RED_LIGHT, 14, 10) . '</a>';
      } else {
        echo '<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'action=setflagcolumn&flag=left&cID=' . $configuration['configuration_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_infobox_green_light.gif', IMAGE_INFOBOX_STATUS_GREEN_LIGHT, 14, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_IMAGES . 'icon_infobox_red.gif', IMAGE_INFOBOX_STATUS_RED, 14, 10);
      }
?></td>
              <!--  <td class="dataTableContent" align="right"><?php echo htmlspecialchars($cfgcol); ?></td> -->
                <td class="dataTableContent" align="center"><?php echo htmlspecialchars($cfgloc); ?></td>
                <td class="dataTableContent" align="right"><?php if ( (is_object($cInfo)) && ($configuration['configuration_id'] == $cInfo->configuration_id) ) { echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&cID=' . $configuration['configuration_id']) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
  }
?>

            </table></td>
<?php
  $heading = array();
  $contents = array();
  switch ($_GET['action']) {
    case 'edit':
      $heading[] = array('text' => '<b>' . $cInfo->configuration_title . '</b>');

      $value_field_value =  (tep_cfg_select_option(array('yes', 'no'),$cInfo->configuration_value));

      $value_field_column =  tep_draw_input_field('configuration_column', $cInfo->configuration_column);


      $value_field_location =  tep_draw_input_field('location', $cInfo->location);

      $contents = array('form' => tep_draw_form('configuration', FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id . '&action=save'));
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      $contents[] = array('text' => '<br><b> Activate this box? </b><br>' . $value_field_value . '</b><br><br><b> Which column? </b><br>' . $value_field_column . '<br><br><b> What order? </b><br>' . $value_field_location);
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;

case 'new':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_INFOBOX . '</b>');

      $value_field_value =  (tep_cfg_select_option(array('yes', 'no'),$cInfo->configuration_value));


      $contents = array('form' => tep_draw_form('TABLE_THEME_CONFIGURATION', FILENAME_INFOBOX_CONFIGURATION, tep_get_all_get_params(array('action')) . 'action=insert', 'post', 'onSubmit="return check_form();"') . tep_draw_hidden_field('cID', $cInfo->configuration_id));

      $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);
      $contents[] = array('text' => '<br><a href="javascript:popupWindow(\'' . tep_href_link(FILENAME_POPUP_INFOBOX_HELP,'action=filename') . '\')">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a><b>   Filename</b><br> ' . tep_draw_input_field('configuration_title','what\'s new','','true'));
      $contents[] = array('text' => '<br><a href="javascript:popupWindow(\'' . tep_href_link(FILENAME_POPUP_INFOBOX_HELP,'action=heading') . '\')">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a><b>  The infoBox heading? </b>' . tep_draw_input_field('box_heading','What\'s New','','true'));
      $contents[] = array('text' => '<br><a href="javascript:popupWindow(\'' . tep_href_link(FILENAME_POPUP_INFOBOX_HELP,'action=define') . '\')">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a><b>  Define key </b><br>' . tep_draw_input_field('configuration_key','BOX_HEADING_????','','true'));

      $contents[] = array('text' => '<br><a href="javascript:popupWindow(\'' . tep_href_link(FILENAME_POPUP_INFOBOX_HELP,'action=column') . '\')">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a><b>  Which column? </b><br>' . tep_draw_input_field('configuration_column','','maxlength="5"','true'));
      $contents[] = array('text' => '<br><a href="javascript:popupWindow(\'' . tep_href_link(FILENAME_POPUP_INFOBOX_HELP,'action=position') . '\')">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a><b>  what Position? </b><br>' . tep_draw_input_field('location'));

      $contents[] = array('text' => '<br><a href="javascript:popupWindow(\'' . tep_href_link(FILENAME_POPUP_INFOBOX_HELP,'action=active') . '\')">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a><b>  Set this box Active? </b><br>' . $value_field_value . '</b><br>');

      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_insert.gif', IMAGE_INSERT) . '&nbsp;<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID']) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_INFOBOX . '</b>');

      $contents = array('form' => tep_draw_form('configuration', FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id . '&action=deleteconfirm'));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('align' => 'center','text' => '<br><b>' . $cInfo->configuration_title . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . '&nbsp;<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;

    default:
      if (is_object($cInfo)) {
        $heading[] = array('text' => '<b>' . $cInfo->configuration_title . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id . '&action=edit') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id . '&action=delete') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a><br><br><a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&action=new') . '">' . tep_image_button('button_new_infobox.gif', IMAGE_NEW_INFOBOX) . '</a> ');
        $contents[] = array('text' => '<br>' . $cInfo->configuration_description);

        $contents[] = array('text' => '<br>' . TEXT_INFO_DATE_ADDED . ' ' . tep_date_short($cInfo->date_added));
        if (tep_not_null($cInfo->last_modified)) $contents[] = array('text' => TEXT_INFO_LAST_MODIFIED . ' ' . tep_date_short($cInfo->last_modified));
        $contents[] = array('text' => '<br>There are currently <br>'. $count_left . ' boxes in the left column and <br>'. $count_right . ' boxes in the right column');
      }
      break;
  }

  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top" align="center">' . "\n";

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
<SCRIPT language=JavaScript>

function check_form() {
  var error = 0;
  var error_message = "<?php echo JS_ERROR; ?>";

  var configuration_title = document.theme_configuration.configuration_title.value;
  var box_heading = document.theme_configuration.box_heading.value;
  var configuration_key = document.theme_configuration.configuration_key.value;
  var configuration_column = document.theme_configuration.configuration_column.value;

  if (configuration_title == "") {
    error_message = error_message + "<?php echo JS_INFO_BOX_FILENAME; ?>";
    error = 1;
  }

  if (box_heading == "") {
    error_message = error_message + "<?php echo JS_INFO_BOX_HEADING; ?>";
    error = 1;
  }


  if (configuration_key == "" || configuration_key == "BOX_HEADING_????") {
    error_message = error_message + "<?php echo JS_BOX_HEADING; ?>";
    error = 1;
  }

  if (configuration_column != "left" && configuration_column != "right") {
    error_message = error_message + "<?php echo JS_BOX_LOCATION; ?>";
    error = 1;
  }

  if (error == 1) {
    alert(error_message);
    return false;
  } else {
    return true;
  }
}

function popupWindow(url) {
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=500,height=280,screenX=150,screenY=150,top=150,left=150')
}

//--></script>