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

tep_redirect(tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=1&amp;cID=' . $cID));
        break;
      case 'setflagcolumn': //set the status of a box left or right.
       if ( ($_GET['flag'] == 'left') || ($_GET['flag'] == 'right') ) {
         if ($_GET['cID']) {
           tep_db_query("update " . TABLE_THEME_CONFIGURATION . " set configuration_column = '" . $_GET['flag'] . "' where configuration_id = '" . $_GET['cID'] . "'");
          }
        }        

tep_redirect(tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=1&amp;cID=' . $cID));
        break;
      case 'save':
	    $configuration_title = tep_db_prepare_input($_POST['configuration_title']);
        $configuration_key = tep_db_prepare_input($_POST['configuration_key']);
        $configuration_value = tep_db_prepare_input($_POST['configuration_value']);
        $configuration_column = tep_db_prepare_input($_POST['configuration_column']);
        $location = tep_db_prepare_input($_POST['location']);
        $cID = tep_db_prepare_input($_GET['cID']);

        tep_db_query("update " . TABLE_THEME_CONFIGURATION . " set configuration_title = '" . tep_db_input($configuration_title) . "', configuration_key = '" . tep_db_input($configuration_key) . "', location = '" . tep_db_input($location) . "', configuration_column = '" . tep_db_input($configuration_column) . "', configuration_value = '" . tep_db_input($configuration_value) . "', last_modified = now() where configuration_id = '" . tep_db_input($cID) . "'");
        tep_redirect(tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&amp;cID=' . $cID));
        break;

 case 'insert':
      $configuration_title = tep_db_prepare_input($_POST['configuration_title']);
      $configuration_key = tep_db_prepare_input($_POST['configuration_key']);
      $configuration_value = tep_db_prepare_input($_POST['configuration_value']);
      $configuration_column = tep_db_prepare_input($_POST['configuration_column']);
      $location = tep_db_prepare_input($_POST['location']);
      $box_heading = tep_db_prepare_input($_POST['box_heading']);

      tep_db_query("insert into " . TABLE_THEME_CONFIGURATION . " (configuration_title, configuration_value, configuration_key, configuration_column, location, box_heading) values ('" . tep_db_input($configuration_title) . "', '" . tep_db_input($configuration_value) . "', '" . tep_db_input($configuration_key) . "', '" . tep_db_input($configuration_column) . "', '" . tep_db_input($location) . "', '" . tep_db_input($box_heading) . "')");
        tep_redirect(tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=1&amp;cID=' . $cID));

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
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CONFIGURATION_VALUE; ?></td>
                <td class="dataTableHeadingContent" align="center" width="100"><?php echo TABLE_HEADING_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="center" width="100"><?php echo TABLE_HEADING_COLUMN; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="center" width="100"><?php echo TABLE_HEADING_SORT_ORDER; ?>&nbsp;</td>
                <td class="dataTableHeadingContent" align="right" width="60"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
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
      echo '                  <tr class="dataTableRowSelected" onmouseover="this.style.cursor=\'hand\'" onclick="document.location.href=\'' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&amp;cID=' . $cInfo->configuration_id . '&amp;action=edit') . '\'">' . "\n";
    } else {
      echo '                  <tr class="dataTableRow" onmouseover="this.className=\'dataTableRowOver\';this.style.cursor=\'hand\'" onmouseout="this.className=\'dataTableRow\'" onclick="document.location.href=\'' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&amp;cID=' . $configuration['configuration_id']) . '\'">' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo $configuration['configuration_title']; ?></td>
                <td class="dataTableContent" align="center">
<?php
      if ($configuration['configuration_value'] == 'yes') {
        echo tep_image(DIR_WS_ICONS .  'icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'action=setflag&amp;flag=no&amp;cID=' . $configuration['configuration_id']) . '">' . tep_image(DIR_WS_ICONS . 'icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
      } else {
        echo '<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'action=setflag&amp;flag=yes&amp;cID=' . $configuration['configuration_id']) . '">' . tep_image(DIR_WS_ICONS . 'icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_ICONS . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
      }
?></td>
                <td class="dataTableContent" align="center"><?php
      if ($configuration['configuration_column'] == 'left') {
        echo tep_image(DIR_WS_ICONS . 'icon_infobox_green.gif', IMAGE_INFOBOX_STATUS_GREEN, 14, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'action=setflagcolumn&amp;flag=right&amp;cID=' . $configuration['configuration_id']) . '">' . tep_image(DIR_WS_ICONS . 'icon_infobox_red_light.gif', IMAGE_INFOBOX_STATUS_RED_LIGHT, 14, 10) . '</a>';
      } else {
        echo '<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'action=setflagcolumn&amp;flag=left&amp;cID=' . $configuration['configuration_id']) . '">' . tep_image(DIR_WS_ICONS . 'icon_infobox_green_light.gif', IMAGE_INFOBOX_STATUS_GREEN_LIGHT, 14, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_ICONS . 'icon_infobox_red.gif', IMAGE_INFOBOX_STATUS_RED, 14, 10);
      }
?></td>
              <!--  <td class="dataTableContent" align="right"><?php echo htmlspecialchars($cfgcol); ?></td> -->
                <td class="dataTableContent" align="center"><?php echo htmlspecialchars($cfgloc); ?></td>
                <td class="dataTableContent" align="right"><?php if ( (is_object($cInfo)) && ($configuration['configuration_id'] == $cInfo->configuration_id) ) { echo tep_image(DIR_WS_ICONS . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&amp;cID=' . $configuration['configuration_id']) . '">' . tep_image(DIR_WS_ICONS . 'information.png', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
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

      $contents = array('form' => tep_draw_form('configuration', FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&amp;cID=' . $cInfo->configuration_id . '&amp;action=save'));
      $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
      
	  $contents[] = array('text' => '<br><span title="' . TEXT_HELP_HEADING_NEW_INFOBOX . '|' . TEXT_INFOBOX_HELP_FILENAME . '">' . tep_image(DIR_WS_ICONS . 'help.png', IMAGE_ICON_INFO) . '</span><b>' . TEXT_INFOBOX_FILENAME . '</b><br> ' . tep_draw_input_field('configuration_title', $cInfo->configuration_title, '', 'true'));
	  	  
	  $contents[] = array('text' => '<br><span title="' . TEXT_HELP_HEADING_NEW_INFOBOX . '|' . TEXT_INFOBOX_HELP_DEFINE . '">' . tep_image(DIR_WS_ICONS . 'help.png', IMAGE_ICON_INFO) . '</span><b>' . TEXT_INFOBOX_DEFINE_KEY . '</b><br>' . tep_draw_input_field('configuration_key', $cInfo->configuration_key, '', 'true'));
	  
	  $contents[] = array('text' => '<br><span title="' . TEXT_HELP_HEADING_NEW_INFOBOX . '|' . TEXT_INFOBOX_HELP_COLUMN . '">' . tep_image(DIR_WS_ICONS . 'help.png', IMAGE_ICON_INFO) . '</span><b>' . TEXT_INFOBOX_COLUMN . '</b><br>' . tep_draw_input_field('configuration_column', $cInfo->configuration_column, 'maxlength="5"', 'true'));
	  
	  $contents[] = array('text' => '<br><span title="' . TEXT_HELP_HEADING_NEW_INFOBOX . '|' . TEXT_INFOBOX_HELP_POSITION . '">' . tep_image(DIR_WS_ICONS . 'help.png', IMAGE_ICON_INFO) . '</span><b>' . TEXT_INFOBOX_POSITION . '</b><br>' . tep_draw_input_field('location',$cInfo->location, '', 'true'));

	  $contents[] = array('text' => '<b>' . TEXT_INFOBOX_ACTIVE . '</b><br>' . $value_field_value . '</b><br><br>');
	  
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&amp;cID=' . $cInfo->configuration_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
    break;

	case 'new':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_NEW_INFOBOX . '</b>');

      $value_field_value =  (tep_cfg_select_option(array('yes', 'no'),$cInfo->configuration_value));

      $contents = array('form' => tep_draw_form('TABLE_THEME_CONFIGURATION', FILENAME_INFOBOX_CONFIGURATION, tep_get_all_get_params(array('action')) . 'action=insert', 'post', 'onSubmit="javascript check_form();"') . tep_draw_hidden_field('cID', $cInfo->configuration_id));

      $contents[] = array('text' => TEXT_INFO_INSERT_INTRO);
      $contents[] = array('text' => '<br><span title="' . TEXT_HELP_HEADING_NEW_INFOBOX . '|' . TEXT_INFOBOX_HELP_FILENAME . '">' . tep_image(DIR_WS_ICONS . 'help.png', IMAGE_ICON_INFO) . '</span><b>' . TEXT_INFOBOX_FILENAME . '</b><br> ' . tep_draw_input_field('configuration_title','what\'s new','','true'));
	  
	  //This is set in languages - otherwise BOX_HEADINGS could not be multi-lingual
      //$contents[] = array('text' => '<br><span title="' . TEXT_HELP_HEADING_NEW_INFOBOX . '|' . TEXT_INFOBOX_HELP_HEADING . '">' . tep_image(DIR_WS_ICONS . 'help.png', IMAGE_ICON_INFO) . '</span><b>The infoBox heading? </b>' . tep_draw_input_field('box_heading','What\'s New','','true'));
	  
      $contents[] = array('text' => '<br><span title="' . TEXT_HELP_HEADING_NEW_INFOBOX . '|' . TEXT_INFOBOX_HELP_DEFINE . '">' . tep_image(DIR_WS_ICONS . 'help.png', IMAGE_ICON_INFO) . '</span><b>' . TEXT_INFOBOX_DEFINE_KEY . '</b><br>' . tep_draw_input_field('configuration_key','BOX_HEADING_????','','true'));

      $contents[] = array('text' => '<br><span title="' . TEXT_HELP_HEADING_NEW_INFOBOX . '|' . TEXT_INFOBOX_HELP_COLUMN . '">' . tep_image(DIR_WS_ICONS . 'help.png', IMAGE_ICON_INFO) . '</span><b>' . TEXT_INFOBOX_COLUMN . '</b><br>' . tep_draw_input_field('configuration_column','left','maxlength="5"','true'));
	  
      $contents[] = array('text' => '<br><span title="' . TEXT_HELP_HEADING_NEW_INFOBOX . '|' . TEXT_INFOBOX_HELP_POSITION . '">' . tep_image(DIR_WS_ICONS . 'help.png', IMAGE_ICON_INFO) . '</span><b>' . TEXT_INFOBOX_POSITION . '</b><br>' . tep_draw_input_field('location','10'));

      $contents[] = array('text' => '<br><span title="' . TEXT_HELP_HEADING_NEW_INFOBOX . '|' . TEXT_INFOBOX_HELP_ACTIVE . '">' . tep_image(DIR_WS_ICONS . 'help.png', IMAGE_ICON_INFO) . '</span><b>' . TEXT_INFOBOX_ACTIVE . '</b><br>' . $value_field_value . '</b><br>');

      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_insert.gif', IMAGE_INSERT) . '&nbsp;<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID']) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
    break;
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_INFO_HEADING_DELETE_INFOBOX . '</b>');

      $contents = array('form' => tep_draw_form('configuration', FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&amp;cID=' . $cInfo->configuration_id . '&amp;action=deleteconfirm'));
      $contents[] = array('text' => TEXT_INFO_DELETE_INTRO);
      $contents[] = array('align' => 'center','text' => '<br><b>' . $cInfo->configuration_title . '</b>');
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . '&nbsp;<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&amp;cID=' . $cInfo->configuration_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
    break;

    default:
      if (is_object($cInfo)) {
        $heading[] = array('text' => '<b>' . $cInfo->configuration_title . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&amp;cID=' . $cInfo->configuration_id . '&amp;action=edit') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&amp;cID=' . $cInfo->configuration_id . '&amp;action=delete') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a><br><br><a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=' . $_GET['gID'] . '&amp;action=new') . '">' . tep_image_button('button_new_infobox.gif', IMAGE_NEW_INFOBOX) . '</a> ');
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