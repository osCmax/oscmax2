<?php
/*
$Id: manufacturers.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  require('includes/functions/image_resize.php');  

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (tep_not_null($action)) {
    switch ($action) {
      case 'insert':
      case 'save':
        if (isset($_GET['mID'])) $manufacturers_id = tep_db_prepare_input($_GET['mID']);
        $manufacturers_name = tep_db_prepare_input($_POST['manufacturers_name']);

        $sql_data_array = array('manufacturers_name' => $manufacturers_name);

        if ($action == 'insert') {
          // BOF Open Featured Sets
          $insert_sql_data = array('date_added' => 'now()',
				   'manufacturers_featured' => tep_db_prepare_input($_POST['manufacturers_featured']),
				   'manufacturers_featured_until' => tep_db_prepare_input($_POST['manufacturers_featured_until']),
				   'manufacturer_featured' => tep_db_prepare_input($_POST['manufacturer_featured']),
				   'manufacturer_featured_until' => tep_db_prepare_input($_POST['manufacturer_featured_until']));
		  // EOF Open Featured Sets

          $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

          tep_db_perform(TABLE_MANUFACTURERS, $sql_data_array);
          $manufacturers_id = tep_db_insert_id();
        } elseif ($action == 'save') {
          // BOF Open Featured Sets
          $update_sql_data = array('last_modified' => 'now()',
				   'manufacturers_featured' => tep_db_prepare_input($_POST['manufacturers_featured']),
				   'manufacturers_featured_until' => tep_db_prepare_input($_POST['manufacturers_featured_until']),
				   'manufacturer_featured' => tep_db_prepare_input($_POST['manufacturer_featured']),
				   'manufacturer_featured_until' => tep_db_prepare_input($_POST['manufacturer_featured_until']));
		  // EOF Open Featured Sets
          
		  $sql_data_array = array_merge($sql_data_array, $update_sql_data);

          tep_db_perform(TABLE_MANUFACTURERS, $sql_data_array, 'update', "manufacturers_id = '" . (int)$manufacturers_id . "'");
        }

        if($_FILES['manufacturers_image']['name'] != '') {
          if ($manufacturers_image = new upload('manufacturers_image', DIR_FS_CATALOG_IMAGES . MANUFACTURERS_IMAGES_DIR)) {
          // BOF Image Resize
            image_resize(DIR_FS_CATALOG_IMAGES . MANUFACTURERS_IMAGES_DIR . $manufacturers_image->filename, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, '80');
          // EOF Image Resize
            tep_db_query("update " . TABLE_MANUFACTURERS . " set manufacturers_image = '" . $manufacturers_image->filename . "' where manufacturers_id = '" . (int)$manufacturers_id . "'");
          }
        }

        $languages = tep_get_languages();
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          $manufacturers_url_array = $_POST['manufacturers_url'];
          $language_id = $languages[$i]['id'];

          $sql_data_array = array('manufacturers_url' => tep_db_prepare_input($manufacturers_url_array[$language_id]));

          if ($action == 'insert') {
            $insert_sql_data = array('manufacturers_id' => $manufacturers_id,
                                     'languages_id' => $language_id);

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

            tep_db_perform(TABLE_MANUFACTURERS_INFO, $sql_data_array);
          } elseif ($action == 'save') {
            tep_db_perform(TABLE_MANUFACTURERS_INFO, $sql_data_array, 'update', "manufacturers_id = '" . (int)$manufacturers_id . "' and languages_id = '" . (int)$language_id . "'");
          }
        }

        if (USE_CACHE == 'true') {
          tep_reset_cache_block('manufacturers');
        }

        tep_redirect(tep_href_link(FILENAME_MANUFACTURERS, (isset($_GET['page']) ? 'page=' . $_GET['page'] . '&' : '') . 'mID=' . $manufacturers_id));
        break;
				
// BOF Open Featured Sets		
	  case 'setflag_manufacturers_featured':
        if ( ($_GET['flag'] == '0') || ($_GET['flag'] == '1') ) {
          if (isset($_GET['mID'])) {
            tep_set_manufacturers_featured($_GET['mID'], $_GET['flag']);
          }

          if (USE_CACHE == 'true') {
            tep_reset_cache_block('manufacturers');
          }
        }
        tep_redirect(tep_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page']));
        break;

	  case 'setflag_manufacturer_featured':
        if ( ($_GET['flag'] == '0') || ($_GET['flag'] == '1') ) {
          if (isset($_GET['mID'])) {
            tep_set_manufacturer_featured($_GET['mID'], $_GET['flag']);
          }

          if (USE_CACHE == 'true') {
            tep_reset_cache_block('manufacturers');
          }
        }
        tep_redirect(tep_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page']));
        break;
// EOF Open Featured Sets
	
      case 'deleteconfirm':
        $manufacturers_id = tep_db_prepare_input($_GET['mID']);

        if (isset($_POST['delete_image']) && ($_POST['delete_image'] == 'on')) {
          $manufacturer_query = tep_db_query("select manufacturers_image from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$manufacturers_id . "'");
          $manufacturer = tep_db_fetch_array($manufacturer_query);

          $image_location = DIR_FS_DOCUMENT_ROOT . DIR_WS_CATALOG_IMAGES . MANUFACTURERS_IMAGES_DIR . $manufacturer['manufacturers_image'];

          if (file_exists($image_location)) @unlink($image_location);
        }

        tep_db_query("delete from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$manufacturers_id . "'");
        tep_db_query("delete from " . TABLE_MANUFACTURERS_INFO . " where manufacturers_id = '" . (int)$manufacturers_id . "'");

        if (isset($_POST['delete_products']) && ($_POST['delete_products'] == 'on')) {
          $products_query = tep_db_query("select products_id from " . TABLE_PRODUCTS . " where manufacturers_id = '" . (int)$manufacturers_id . "'");
          while ($products = tep_db_fetch_array($products_query)) {
            tep_remove_product($products['products_id']);
          }
        } else {
          tep_db_query("update " . TABLE_PRODUCTS . " set manufacturers_id = '' where manufacturers_id = '" . (int)$manufacturers_id . "'");
        }

        if (USE_CACHE == 'true') {
          tep_reset_cache_block('manufacturers');
        }

        tep_redirect(tep_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page']));
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

<?php
 	// BOF Open Featured Sets
?>
<div id="spiffycalendar" class="text"></div>
<?php
 	// EOF Open Featured Sets
?>

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
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
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
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_MANUFACTURERS; ?></td>
                <?php
 	// BOF Open Featured Sets
?>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_MANUFACTURERS_FEATURED; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_MANUFACTURER_FEATURED; ?></td>
<?php
 	// EOF Open Featured Sets
?>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  // BOF Open Featured Sets
  $manufacturers_query_raw = "select manufacturers_id, manufacturers_name, manufacturers_image, date_added, last_modified, manufacturers_featured, manufacturers_featured_until, manufacturer_featured, manufacturer_featured_until from " . TABLE_MANUFACTURERS . " order by manufacturers_name";
 	// EOF Open Featured Sets
  $manufacturers_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $manufacturers_query_raw, $manufacturers_query_numrows);
  $manufacturers_query = tep_db_query($manufacturers_query_raw);
  while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
    if ((!isset($_GET['mID']) || (isset($_GET['mID']) && ($_GET['mID'] == $manufacturers['manufacturers_id']))) && !isset($mInfo) && (substr($action, 0, 3) != 'new')) {
      $manufacturer_products_query = tep_db_query("select count(*) as products_count from " . TABLE_PRODUCTS . " where manufacturers_id = '" . (int)$manufacturers['manufacturers_id'] . "'");
      $manufacturer_products = tep_db_fetch_array($manufacturer_products_query);

      $mInfo_array = array_merge($manufacturers, $manufacturer_products);
      $mInfo = new objectInfo($mInfo_array);
    }

    if (isset($mInfo) && is_object($mInfo) && ($manufacturers['manufacturers_id'] == $mInfo->manufacturers_id)) {
      echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&amp;mID=' . $manufacturers['manufacturers_id'] . '&amp;action=edit') . '\'">' . "\n";
    } else {
      echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&amp;mID=' . $manufacturers['manufacturers_id']) . '\'">' . "\n";
    }
?>
                <td class="dataTableContent"><?php echo $manufacturers['manufacturers_name']; ?></td>
                
<?php
 	// BOF Open Featured Sets
?>
				<td class="dataTableContent" align="center">
<?php
	 if (!isset($mInfo) && is_object($mInfo) && ($mInfo->manufacturers_featured)) $mInfo->manufacturers_featured = '0';
    switch ($mInfo->manufacturers_featured) {
      case '0': $in_fms_status = false; $out_fms_status = true; break;
      case '1':
      default: $in_fms_status = true; $out_fms_status = false;
	  }
	  
      if ($manufacturers['manufacturers_featured'] == '1') {
        echo tep_image(DIR_WS_ICONS . 'icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_MANUFACTURERS, 'action=setflag_manufacturers_featured&amp;flag=0&amp;mID=' . $manufacturers['manufacturers_id']) . '">' . tep_image(DIR_WS_ICONS . 'icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
      } else {
        echo '<a href="' . tep_href_link(FILENAME_MANUFACTURERS, 'action=setflag_manufacturers_featured&amp;flag=1&amp;mID=' . $manufacturers['manufacturers_id']) . '">' . tep_image(DIR_WS_ICONS . 'icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_ICONS . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
      }
?></td>
				<td class="dataTableContent" align="center">
<?php
	 if (!isset($mInfo) && is_object($mInfo) && ($mInfo->manufacturer_featured)) $mInfo->manufacturer_featured = '0';
    switch ($mInfo->manufacturer_featured) {
      case '0': $in_fm_status = false; $out_fm_status = true; break;
      case '1':
      default: $in_fm_status = true; $out_fm_status = false;
	  }
	  
      if ($manufacturers['manufacturer_featured'] == '1') {
        echo tep_image(DIR_WS_ICONS . 'icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_MANUFACTURERS, 'action=setflag_manufacturer_featured&amp;flag=0&amp;mID=' . $manufacturers['manufacturers_id']) . '">' . tep_image(DIR_WS_ICONS . 'icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
      } else {
        echo '<a href="' . tep_href_link(FILENAME_MANUFACTURERS, 'action=setflag_manufacturer_featured&amp;flag=1&amp;mID=' . $manufacturers['manufacturers_id']) . '">' . tep_image(DIR_WS_ICONS . 'icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_ICONS . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
      }
?></td>
<?php
 	// EOF Open Featured Sets
?>

                
                <td class="dataTableContent" align="right"><?php if (isset($mInfo) && is_object($mInfo) && ($manufacturers['manufacturers_id'] == $mInfo->manufacturers_id)) { echo tep_image(DIR_WS_ICONS . 'icon_arrow_right.gif'); } else { echo '<a href="' . tep_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&amp;mID=' . $manufacturers['manufacturers_id']) . '">' . tep_image(DIR_WS_ICONS . 'information.png', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
  }
?>
              <tr>
                <td colspan="5"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="smallText" valign="top"><?php echo $manufacturers_split->display_count($manufacturers_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_MANUFACTURERS); ?></td>
                    <td class="smallText" align="right"><?php echo $manufacturers_split->display_links($manufacturers_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']); ?></td>
                  </tr>
                </table></td>
              </tr>
<?php
  if (empty($action)) {
?>
              <tr>
                <td align="right" colspan="5" class="smallText"><?php echo '<a href="' . tep_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&amp;mID=' . $mInfo->manufacturers_id . '&amp;action=new') . '">' . tep_image_button('button_insert.gif', IMAGE_INSERT) . '</a>'; ?></td>
              </tr>
<?php
  }
?>
            </table></td>
<?php
  $heading = array();
  $contents = array();

  switch ($action) {
    case 'new':
      $heading[] = array('text' => '<b>' . TEXT_HEADING_NEW_MANUFACTURER . '</b>');

      $contents = array('form' => tep_draw_form('manufacturers', FILENAME_MANUFACTURERS, 'action=insert', 'post', 'enctype="multipart/form-data"'));
      $contents[] = array('text' => TEXT_NEW_INTRO);
      $contents[] = array('text' => '<br>' . TEXT_MANUFACTURERS_NAME . '<br>' . tep_draw_input_field('manufacturers_name'));
      $contents[] = array('text' => '<br>' . TEXT_MANUFACTURERS_IMAGE . '<br>' . tep_draw_file_field('manufacturers_image'));

// BOF Open Featured Sets
      $contents[] = array('text' => '<br>' . TEXT_MANUFACTURERS_FEATURED . '<br>' . tep_draw_radio_field('manufacturers_featured', '1', $in_fms_status) . '&nbsp;' . TEXT_MANUFACTURERS_YES . '&nbsp;' . tep_draw_radio_field('manufacturers_featured', '0', $out_fms_status) . '&nbsp;' . TEXT_MANUFACTURERS_NO);
      $contents[] = array('text' => '<br>' . TEXT_MANUFACTURERS_FEATURED_DATE . '<small>(YYYY-MM-DD)</small><br>' . tep_draw_input_field('manufacturers_featured_until', (isset($mInfo->manufacturers_featured_until) ? $mInfo->manufacturers_featured_until : ''), 'id="manufacturers_featured_until"'));
      $contents[] = array('text' => '<br>' . TEXT_MANUFACTURER_FEATURED . '<br>' . tep_draw_radio_field('manufacturer_featured', '1', $in_fm_status) . '&nbsp;' . TEXT_MANUFACTURER_YES . '&nbsp;' . tep_draw_radio_field('manufacturer_featured', '0', $out_fm_status) . '&nbsp;' . TEXT_MANUFACTURER_NO);
      $contents[] = array('text' => '<br>' . TEXT_MANUFACTURER_FEATURED_DATE . '<small>(YYYY-MM-DD)</small><br>' . tep_draw_input_field('manufacturer_featured_until', (isset($mInfo->manufacturer_featured_until) ? $mInfo->manufacturer_featured_until : ''), 'id="manufacturer_featured_until"'));
// EOF Open Featured Sets

      $manufacturer_inputs_string = '';
      $languages = tep_get_languages();
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        $manufacturer_inputs_string .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('manufacturers_url[' . $languages[$i]['id'] . ']');
      }

      $contents[] = array('text' => '<br>' . TEXT_MANUFACTURERS_URL . $manufacturer_inputs_string);
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . tep_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&amp;mID=' . $_GET['mID']) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'edit':
      $heading[] = array('text' => '<b>' . TEXT_HEADING_EDIT_MANUFACTURER . '</b>');

      $contents = array('form' => tep_draw_form('manufacturers', FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&amp;mID=' . $mInfo->manufacturers_id . '&amp;action=save', 'post', 'enctype="multipart/form-data"'));
      $contents[] = array('text' => TEXT_EDIT_INTRO);
      $contents[] = array('text' => '<br>' . TEXT_MANUFACTURERS_NAME . '<br>' . tep_draw_input_field('manufacturers_name', $mInfo->manufacturers_name));
      $contents[] = array('text' => '<br>' . TEXT_MANUFACTURERS_IMAGE . '<br>' . tep_draw_file_field('manufacturers_image') . '<br>' . $mInfo->manufacturers_image);

// BOF Open Featured Sets
      $contents[] = array('text' => '<br>' . TEXT_MANUFACTURERS_FEATURED . '<br>' . tep_draw_radio_field('manufacturers_featured', '1', $in_fms_status) . '&nbsp;' . TEXT_MANUFACTURERS_YES . '&nbsp;' . tep_draw_radio_field('manufacturers_featured', '0', $out_fms_status) . '&nbsp;' . TEXT_MANUFACTURERS_NO);
      $contents[] = array('text' => '<br>' . TEXT_MANUFACTURERS_FEATURED_DATE . '<small>(YYYY-MM-DD)</small><br>' . tep_draw_input_field('manufacturers_featured_until', (isset($mInfo->manufacturers_featured_until) ? $mInfo->manufacturers_featured_until : ''), 'id="manufacturers"'));
      $contents[] = array('text' => '<br>' . TEXT_MANUFACTURER_FEATURED . '<br>' . tep_draw_radio_field('manufacturer_featured', '1', $in_fm_status) . '&nbsp;' . TEXT_MANUFACTURER_YES . '&nbsp;' . tep_draw_radio_field('manufacturer_featured', '0', $out_fm_status) . '&nbsp;' . TEXT_MANUFACTURER_NO);
      $contents[] = array('text' => '<br>' . TEXT_MANUFACTURER_FEATURED_DATE . '<small>(YYYY-MM-DD)</small><br>' . tep_draw_input_field('manufacturer_featured_until', (isset($mInfo->manufacturer_featured_until) ? $mInfo->manufacturer_featured_until : ''), 'id="manufacturer"'));
// EOF Open Featured Sets

      $manufacturer_inputs_string = '';
      $languages = tep_get_languages();
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
        $manufacturer_inputs_string .= '<br>' . tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']) . '&nbsp;' . tep_draw_input_field('manufacturers_url[' . $languages[$i]['id'] . ']', tep_get_manufacturer_url($mInfo->manufacturers_id, $languages[$i]['id']));
      }

      $contents[] = array('text' => '<br>' . TEXT_MANUFACTURERS_URL . $manufacturer_inputs_string);
      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . tep_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&amp;mID=' . $mInfo->manufacturers_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    case 'delete':
      $heading[] = array('text' => '<b>' . TEXT_HEADING_DELETE_MANUFACTURER . '</b>');

      $contents = array('form' => tep_draw_form('manufacturers', FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&amp;mID=' . $mInfo->manufacturers_id . '&amp;action=deleteconfirm'));
      $contents[] = array('text' => TEXT_DELETE_INTRO);
      $contents[] = array('text' => '<br><b>' . $mInfo->manufacturers_name . '</b>');
      $contents[] = array('text' => '<br>' . tep_draw_checkbox_field('delete_image', '', true) . ' ' . TEXT_DELETE_IMAGE);

      if ($mInfo->products_count > 0) {
        $contents[] = array('text' => '<br>' . tep_draw_checkbox_field('delete_products') . ' ' . TEXT_DELETE_PRODUCTS);
        $contents[] = array('text' => '<br>' . sprintf(TEXT_DELETE_WARNING_PRODUCTS, $mInfo->products_count));
      }

      $contents[] = array('align' => 'center', 'text' => '<br>' . tep_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . tep_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&amp;mID=' . $mInfo->manufacturers_id) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
      break;
    default:
      if (isset($mInfo) && is_object($mInfo)) {
        $heading[] = array('text' => '<b>' . $mInfo->manufacturers_name . '</b>');

        $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&amp;mID=' . $mInfo->manufacturers_id . '&amp;action=edit') . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_MANUFACTURERS, 'page=' . $_GET['page'] . '&amp;mID=' . $mInfo->manufacturers_id . '&amp;action=delete') . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
        $contents[] = array('text' => '<br>' . TEXT_DATE_ADDED . ' ' . tep_date_short($mInfo->date_added));
        if (tep_not_null($mInfo->last_modified)) $contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . tep_date_short($mInfo->last_modified));
//        $contents[] = array('text' => '<br>' . tep_info_image($mInfo->manufacturers_image, $mInfo->manufacturers_name));
        $contents[] = array('text' => '<br>' . tep_info_image(MANUFACTURERS_IMAGES_DIR . $mInfo->manufacturers_image, $mInfo->manufacturers_name));
  	    $contents[] = array('text' => '<br>' . TEXT_PRODUCTS . ' ' . $mInfo->products_count);
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