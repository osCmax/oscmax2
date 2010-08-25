<?php
/*
  $Id: extra_values.php ver 2.02 by Kevin L. Shelton 2010-06-22
  
  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2009 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

// set the following two defines to the maximum size you want an extra value image to have
  define('EPF_IMAGE_MAX_WIDTH', 70);
  define('EPF_IMAGE_MAX_HEIGHT', 70);

  function resizeWithGD($image, $max_width = EPF_IMAGE_MAX_WIDTH, $max_height = EPF_IMAGE_MAX_HEIGHT) {
    $img_type = false;
    switch (strtolower(substr($image, (strrpos($image, '.')+1)))) {
      case 'jpg':
      case 'jpeg':
        if (imagetypes() & IMG_JPG) {
          $img_type = 'jpg';
        }
        break;
      case 'gif':
        if (imagetypes() & IMG_GIF) {
          $img_type = 'gif';
        }
        break;
      case 'png':
        if (imagetypes() & IMG_PNG) {
          $img_type = 'png';
        }
        break;
    }
    if ($img_type !== false) {
      list($orig_width, $orig_height) = getimagesize(DIR_FS_CATALOG_IMAGES . 'epf/' . $image);
      if (($orig_width <= $max_width) && ($orig_height <= $max_height)) return; // skip if resize not needed
      $height = $max_height;
      $width = $max_width;
      $new_ratio = $height / $width;
			$image_ratio = $orig_height / $orig_width;
			if ($new_ratio >= $image_ratio)	{
				$height = round($orig_height * $width / $orig_width);
			}	else {
				$width = round($orig_width * $height / $orig_height);
			}
      switch ($img_type) {
        case 'jpg':
          $im = imagecreatefromjpeg(DIR_FS_CATALOG_IMAGES . 'epf/' . $image);
          break;
        case 'gif':
          $im = imagecreatefromgif(DIR_FS_CATALOG_IMAGES . 'epf/' . $image);
          break;
        case 'png':
          $im = imagecreatefrompng(DIR_FS_CATALOG_IMAGES . 'epf/' . $image);
          break;
      }
      $true_color = true;
      if (function_exists(imageistruecolor))
        $true_color = imageistruecolor($im);
      if ($true_color) {
        $im_p = imagecreatetruecolor($width, $height);
      } else {
        $im_p =imagecreate($width, $height);
        imagepalettecopy($im_p, $im);
      }
      if ( ($img_type == 'gif') || ($img_type == 'png') ) {
        $trnprt_indx = imagecolortransparent($im);
        if ($trnprt_indx >= 0) { // If we have a specific transparent color
          // Get the original image's transparent color's RGB values
          $trnprt_color = imagecolorsforindex($im, $trnprt_indx);
          // Allocate the same color in the new image resource
          $trnprt_indx = imagecolorallocate($im_p, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);
          // Completely fill the background of the new image with allocated color.
          imagefill($im_p, 0, 0, $trnprt_indx);
          // Set the background color for new image to transparent
          imagecolortransparent($im_p, $trnprt_indx);
        } elseif ($img_type == 'png') { // Always make a transparent background color for PNGs that don't have one allocated already
          // Turn off transparency blending (temporarily)
          imagealphablending($im_p, false);
          // Create a new transparent color for image
          $color = imagecolorallocatealpha($im_p, 0, 0, 0, 127);
          // Completely fill the background of the new image with allocated color.
          imagefill($im_p, 0, 0, $color);
          // Restore transparency blending
          imagesavealpha($im_p, true);
        }
      }
      imagecopyresampled($im_p, $im, 0, 0, 0, 0, $width, $height, $orig_width, $orig_height);
      switch ($img_type) {
        case 'jpg':
          imagejpeg($im_p, DIR_FS_CATALOG_IMAGES . 'epf/' . $image);
          break;
        case 'gif':
          imagegif($im_p, DIR_FS_CATALOG_IMAGES . 'epf/' . $image);
          break;
        case 'png':
          imagepng($im_p, DIR_FS_CATALOG_IMAGES . 'epf/' . $image);
          break;
      }
      imagedestroy($im_p);
      imagedestroy($im);
      chmod(DIR_FS_CATALOG_IMAGES . 'epf/' . $image, 0777);
    } else {
      return false;
    }
  }
  function build_value_list($epf_id, $lang_id, $value_array = '', $parent_id = 0) {
    if (!is_array($value_array)) $value_array = array();
    $sql = tep_db_query("select * from " . TABLE_EPF_VALUES . " where epf_id = " . (int)$epf_id . " and languages_id = " . (int)$lang_id . " and parent_id = " . (int)$parent_id . " order by value_depends_on, sort_order, epf_value");
    while ($v = tep_db_fetch_array($sql)) {
      $value_array[] = $v;
      $value_array = build_value_list($epf_id, $lang_id, $value_array, $v['value_id']);
    }
    return $value_array;
  }
  function get_exclude_list($value_id) {
    $exclude_list = array();
    $query = tep_db_query('select value_id1 from ' . TABLE_EPF_EXCLUDE . ' where value_id2 = ' . (int)$value_id);
    while ($check = tep_db_fetch_array($query)) {
      $exclude_list[] = $check['value_id1'];
    }
    $query = tep_db_query('select value_id2 from ' . TABLE_EPF_EXCLUDE . ' where value_id1 = ' . (int)$value_id);
    while ($check = tep_db_fetch_array($query)) {
      $exclude_list[] = $check['value_id2'];
    }
    return $exclude_list;
  }
  function get_parent_list($value_id) {
    $sql = tep_db_query("select parent_id from " . TABLE_EPF_VALUES . " where value_id = " . (int)$value_id);
    $value = tep_db_fetch_array($sql);
    if ($value['parent_id'] > 0) {
      return get_parent_list($value['parent_id']) . ',' . $value_id;
    } else {
      return $value_id;
    }
  }

  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  $list_id = (isset($_GET['list_id']) ? $_GET['list_id'] : '_');
  list($eid, $lid) = explode('_', $list_id);
  $query = tep_db_query("select * from " . TABLE_EPF . " where epf_id = " . (int)$eid);
  $field_info = tep_db_fetch_array($query); // retrieve field information
  $field = 'extra_value';
  if ($field_info['epf_uses_value_list']) {
    if ($field_info['epf_multi_select']) {
      $field .= '_ms';
    } else {
      $field .= '_id';
    }
  }
  $field .= $eid;
  $vid = (isset($_GET['vid']) ? $_GET['vid'] : '');
  $confirm = (isset($_GET['confirm']) ? $_GET['confirm'] : '');
  $parent_id = (isset($_GET['parent']) ? $_GET['parent'] : 0);
  $languages = tep_get_languages();
  $lang = array();
  for ($i=0, $n=sizeof($languages); $i<$n; $i++) { // build array accessed directly by language id
    $lang[$languages[$i]['id']] = array ('name' => $languages[$i]['name'],
                                         'code' => $languages[$i]['code'],
                                         'image' => $languages[$i]['image'],
                                         'directory' => $languages[$i]['directory']);
  }
  $query = tep_db_fetch_array(tep_db_query("select epf_label from " . TABLE_EPF_LABELS . " where epf_id = " . (int)$eid . " and languages_id = " . (int)$lid));
  $current_label = $query['epf_label'];
  if ($current_label == '') { // if invalid label get first matching label and use that information
    $query = tep_db_fetch_array(tep_db_query("select l.epf_label, l.languages_id, l.epf_id from " . TABLE_EPF_LABELS . " l join " . TABLE_EPF . " e where e.epf_id = l.epf_id and l.epf_active_for_language and e.epf_uses_value_list order by e.epf_order"));
    $current_label = $query['epf_label'];
    $eid = $query['epf_id'];
    $lid = $query['languages_id'];
    $list_id = $eid . '_' . $lid;
    $_GET['list_id'] = $list_id; // set so dropdown list of fields will match value list chosen
  }
  if (tep_not_null($action)) {
    $messages = array();
    $error = false;
    switch ($action) {
      case 'insert':
        $value = (isset($_POST['value']) ? tep_db_prepare_input($_POST['value']) : '');
        $order = (isset($_POST['sort_order']) ? tep_db_prepare_input($_POST['sort_order']) : 0);
        $depends_on = (isset($_POST['depends_on']) ? tep_db_prepare_input($_POST['depends_on']) : 0);
        $excludes = (isset($_POST['excludes']) ? $_POST['excludes'] : array());
        if (!tep_not_null($value)) { // validate form
          $error = true;
          $messages[] = ERROR_VALUE;
          $action = 'new';
        }
        $data_array = array('epf_id' => (int)$eid,
                            'languages_id' => (int)$lid,
                            'parent_id' => (int)$parent_id,
                            'sort_order' => (int)$order,
                            'value_depends_on' => (int)$depends_on,
                            'epf_value' => $value);
        $value_image = new upload('values_image');
        $webimgetypes = array ('jpg', 'jpeg', 'gif', 'png');
        $value_image->set_extensions($webimgtypes);
        $value_image->set_output_messages('session');
        $value_image->set_destination(DIR_FS_CATALOG_IMAGES . 'epf/');
        if ($value_image->parse()) {
          $check_query = tep_db_query('select value_id from ' . TABLE_EPF_VALUES . ' where value_image = "' . tep_db_input($value_image->filename) . '"');
          if (tep_db_num_rows($check_query) > 0) {
            $error = true;
            $messages[] = ERROR_FILENAME_USED;
            $action = 'new';
          } elseif ($value_image->save()) {
            $data_array['value_image'] = $value_image->filename;
            resizeWithGD($value_image->filename);
          }
        }
        if (!$error) {
          tep_db_perform(TABLE_EPF_VALUES, $data_array);
          $vid = tep_db_insert_id();
          foreach ($excludes as $val) {
            tep_db_query('insert into ' . TABLE_EPF_EXCLUDE . ' set value_id1 = ' . (int)$vid . ', value_id2 = ' . (int)$val);
          }
          tep_redirect(tep_href_link(FILENAME_EXTRA_VALUES, 'vid=' . $vid . '&list_id=' . $list_id));
        }
        break;
      case 'update': // validate form
        $value = (isset($_POST['value']) ? tep_db_prepare_input($_POST['value']) : '');
        $order = (isset($_POST['sort_order']) ? tep_db_prepare_input($_POST['sort_order']) : 0);
        $depends_on = (isset($_POST['depends_on']) ? tep_db_prepare_input($_POST['depends_on']) : 0);
        $excludes = (isset($_POST['excludes']) ? $_POST['excludes'] : array());
        if (!tep_not_null($value)) {
          $error = true;
          $messages[] = ERROR_VALUE;
          $action = 'edit';
        }
        $check = tep_db_query("select value_image from " . TABLE_EPF_VALUES . " where value_id = " . (int)$vid);
        $current = tep_db_fetch_array($check);
        $data_array = array('sort_order' => (int)$order,
                            'value_depends_on' => (int)$depends_on,
                            'epf_value' => $value);
        $value_image = new upload('values_image');
        $webimgetypes = array ('jpg', 'jpeg', 'gif', 'png');
        $value_image->set_extensions($webimgtypes);
        $value_image->set_output_messages('session');
        $value_image->set_destination(DIR_FS_CATALOG_IMAGES . 'epf/');
        if ($value_image->parse()) {
          $check_query = tep_db_query('select value_id from ' . TABLE_EPF_VALUES . ' where value_image = "' . tep_db_input($value_image->filename) . '"');
          $num_found = tep_db_num_rows($check_query);
          $check = tep_db_fetch_array($check_query);
          if (($num_found > 0) && ($check['value_id'] != $vid)) {
            $error = true;
            $messages[] = ERROR_FILENAME_USED;
            $action = 'edit';
          } elseif ($value_image->save()) {
            $data_array['value_image'] = $value_image->filename;
            if (($current['value_image'] != '') && ($value_image->filename != $current['value_image'])) {
            // image file name has changed, remove old file
              if (file_exists(DIR_FS_CATALOG_IMAGES . 'epf/' . $current['value_image'])) {
                @unlink(DIR_FS_CATALOG_IMAGES . 'epf/' . $current['value_image']);
              }
            }
            resizeWithGD($value_image->filename);
          }
        }
        if (!$error) {
          tep_db_perform(TABLE_EPF_VALUES, $data_array, 'update', 'value_id = ' . (int)$vid);
          tep_db_query('delete from ' . TABLE_EPF_EXCLUDE . ' where value_id1 =' . (int)$vid . ' or value_id2 = ' . (int)$vid);  // remove old exclusions
          foreach ($excludes as $val) { // insert new list of exclusions
            tep_db_query('insert into ' . TABLE_EPF_EXCLUDE . ' set value_id1 = ' . (int)$vid . ', value_id2 = ' . (int)$val);
          }
          tep_redirect(tep_href_link(FILENAME_EXTRA_VALUES, 'vid=' . $vid . '&list_id=' . $list_id));
        }
        break;
      case 'delete':
        if ($confirm == 'yes') {
          if (isset($_GET['used']) && ($_GET['used'] > 0)) {
            $double_check = 'yes';
          } else {
            $check = tep_db_query("select * from " . TABLE_EPF_VALUES . " where value_id = " . (int)$vid);
            $current = tep_db_fetch_array($check);
            if (tep_not_null($current['value_image'])) {
              if (file_exists(DIR_FS_CATALOG_IMAGES . 'epf/' . $current['value_image'])) {
                @unlink(DIR_FS_CATALOG_IMAGES . 'epf/' . $current['value_image']);
              }
            }
            if ($field_info['epf_multi_select']) {
              $query = tep_db_query("select * from " . TABLE_PRODUCTS_DESCRIPTION . " where " . $field . " like '%|" . (int)$vid . "|%'");
              while ($check = tep_db_fetch_array($query)) {
                $old_list = explode('|', trim($check[$field] , '|'));
                $new_list = array();
                foreach ($old_list as $value) {
                  if ($value != $vid) $new_list[] = $value;
                }
                if (empty($new_list)) {
                  $value = 'null';
                } else {
                  $value = '|' . implode('|', $new_list) . '|';
                }
                $data_array = array($field => $value);
                tep_db_perform(TABLE_PRODUCTS_DESCRIPTION, $data_array, 'update', 'products_id = ' . (int)$check['products_id'] . ' and language_id = ' . (int)$check['language_id']);
              }
              $children = '';
              tep_db_query('delete from ' . TABLE_EPF_EXCLUDE . ' where value_id1 =' . (int)$vid . ' or value_id2 = ' . (int)$vid);
            } else {
              $children = tep_list_epf_children($vid);
              tep_db_query("update " . TABLE_PRODUCTS_DESCRIPTION . " set " . $field . " = 0 where language_id = " . (int)$lid . " and " . $field . " in (" . (int)$vid . $children . ")");
              if ($field_info['epf_has_linked_field']) {
                tep_db_query('update ' . TABLE_EPF_VALUES . ' set value_depends_on = 0 where value_depends_on in (' . (int)$vid . $children . ")");
              }
            }
            tep_db_query('delete from ' . TABLE_EPF_VALUES . ' where value_id in (' . (int)$vid . $children . ")");
            tep_redirect(tep_href_link(FILENAME_EXTRA_VALUES, 'list_id=' . $list_id));
          }
        } else {
          $double_check = 'no';
        }
        break;
      case 'edit':
        if ($field_info['epf_multi_select']) {
          $check_query = tep_db_query("select count(products_id) as total from " . TABLE_PRODUCTS_DESCRIPTION . " where " . $field . " like '%|" . (int)$vid . "|%'");
        } else {
          $check_query = tep_db_query("select count(products_id) as total from " . TABLE_PRODUCTS_DESCRIPTION . " where " . $field . " = " . (int)$vid);
        }
        $check = tep_db_fetch_array($check_query);
        if ($check['total'] > 0) $messages[] = sprintf(WARNING_VALUE_USED, $check['total']);
        break;
    }
  }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE . ' ' . HEADING_TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/javascript/jquery-ui-1.8.2.custom.css">
<script type="text/javascript" language="javascript" src="includes/general.js"></script>
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
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
          </tr>
          <?php if (($action != 'new') && ($action != 'edit')) {
            $query = tep_db_query("select epf_id from " . TABLE_EPF . " where epf_uses_value_list");
            if (tep_db_num_rows($query) == 0) {
              echo '<tr><td colspan="2" class="messageStackError">' . tep_image(DIR_WS_ICONS . 'error.gif') . ERROR_NO_LIST_FIELDS . '</td></tr></table></td></tr></table></td></tr></table>';
              exit;
            }
            $fields = array();
            while ($epf = tep_db_fetch_array($query)) {
              $label_query = tep_db_query("select languages_id, epf_label from " . TABLE_EPF_LABELS . " where epf_id = " . $epf['epf_id'] . " and epf_active_for_language");
              while($label = tep_db_fetch_array($label_query)) {
                $fields[] = array('id' => $epf['epf_id'] . '_' . $label['languages_id'], 'text' => $lang[$label['languages_id']]['name'] . ': ' . $label['epf_label']);
              }
            }
          ?>
          <tr>
            <td colspan="2" class="main"><?php echo TEXT_SELECT_FIELD . '&nbsp;&nbsp;' . tep_draw_form('select_field', FILENAME_EXTRA_VALUES, '', 'get') . tep_draw_pull_down_menu('list_id', $fields, '', 'onchange="this.form.submit()"'); ?></form></td>
          </tr>
          <tr>
            <td colspan=2 align="right" class="main"><?php echo tep_draw_form('new', FILENAME_EXTRA_VALUES, 'action=new&list_id=' . $list_id) . tep_draw_input_field('new', BUTTON_NEW, 'alt="' . BUTTON_NEW . '"', false, 'submit') . '</form>&nbsp;&nbsp;'; ?></td>
          </tr>
          <?php } ?>
        </table></td>
      </tr>
      <?php if (($action == 'new') || ($action =='edit')) {
      if ($action == 'edit') {
        $query = tep_db_query("select * from " . TABLE_EPF_VALUES . " where value_id = " . (int)$vid);
        $value = tep_db_fetch_array($query);
        echo '<tr><td><p class="pageHeading">' . HEADING_EDIT . $vid . "</p>\n";
      } else {
        if ($parent_id > 0) {
          $query = tep_db_query("select * from " . TABLE_EPF_VALUES . " where value_id = " . (int)$parent_id);
          $parent = tep_db_fetch_array($query);
        }
        echo '<tr><td><p class="pageHeading">' . HEADING_NEW . $lang[$lid]['name']. ': ' . $current_label;
        echo ($parent_id > 0 ? '<br>' . TABLE_HEADING_PARENT . $parent['value_id'] . ' ' . ENTRY_VALUE . $parent['epf_value'] : '') . "</p>\n";
      }
      if (!empty($messages)) {
        echo '<table width="100%">' . "\n";
        foreach ($messages as $message) {
          echo '<tr><td ' . ($error ? 'class="messageStackError"' : 'class="messageStackWarning"') . '>' . $message . "</td></tr>\n";
        }
        echo "</table>\n";
      }
      echo tep_draw_form('value_entry', FILENAME_EXTRA_VALUES, 'action=' . (($action == 'new') ? 'insert' : 'update') . '&vid=' . $vid . '&list_id=' . $list_id . '&parent=' . $parent_id . ($confirmation_needed ? '&confirm=yes' : ''), 'post', 'enctype="multipart/form-data"');
	  echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">' . "\n";
	  echo '  <tr>' . "\n";
      echo '    <td width="130" class="main">' . ENTRY_ORDER . '</td><td>' . tep_draw_input_field('sort_order', $value['sort_order']) . "</td>\n";
	  echo '  </tr>' . "\n";
	  echo '  <tr>' . "\n";
      echo '    <td class="main">' . ENTRY_VALUE . '</td><td>' . tep_draw_input_field('value', $value['epf_value'], 'size=64 maxlength=64') . "</td>\n";
      echo '  </tr>' . "\n";
	  echo '  <tr>' . "\n";
	  echo '    <td class="main">' . ENTRY_IMAGE . '</td><td>' . tep_draw_file_field('values_image') . '<br>' . $value['value_image'] . "</td>\n";
	  echo '  </tr>' . "\n";
	  echo '</table><br>' . "\n";
      if ($field_info['epf_multi_select']) {
        if ($field_info['epf_has_linked_field']) {
          $link_query = tep_db_query("select * from " . TABLE_EPF . " where epf_id = " . (int)$field_info['epf_links_to']);
          $linked_field_info = tep_db_fetch_array($link_query);
          $link_values = tep_build_epf_pulldown($field_info['epf_links_to'], $lid, array(array('id' => 0, 'text' => ENTRY_NO_VALUE_REQUIRED)));
          echo '<p>' . ENTRY_VALUE_REQUIREMENT . '<br>';
          if ($linked_field_info['epf_checked_entry']) {
            $col = 0;
            echo '<table><tr>';
            foreach ($link_values as $lval) {
              $col++;
              if ($col > $linked_field_info['epf_num_columns']) {
                echo '</tr><tr>';
                $col = 1;
              }
              echo '<td>' . tep_draw_radio_field('depends_on', $lval['id'], false, $value['value_depends_on']) . '</td><td>' . ($lval['id'] == 0 ? ENTRY_NO_VALUE_REQUIRED : tep_get_extra_field_list_value($lval['id'], false, $linked_field_info['epf_value_display_type'])) . '</td><td>&nbsp;</td>';
            }
            echo '</tr></table>';
          } else {
            echo tep_draw_pull_down_menu('depends_on', $link_values, $value['value_depends_on']);
          }
          echo "</p>\n";
        }
        $exclude_list = get_exclude_list($vid);
        $query =  build_value_list($eid, $lid);
        $value_list = array();
        foreach ($query as $val)
          if ($val['value_id'] != $vid)
            $value_list[] = $val;
        if (!empty($value_list)) echo '<p>' . ENTRY_EXCLUDES . '<br>';
        $col = 0;
        echo '<table><tr>';
        foreach ($value_list as $val) {
          $col++;
          if ($col > $field_info['epf_num_columns']) {
            echo '</tr><tr>';
            $col = 1;
          }
          echo '<td>' . tep_draw_checkbox_field('excludes[]', $val['value_id'], in_array($val['value_id'], $exclude_list)) . '</td><td>' . tep_get_extra_field_list_value($val['value_id'], false, $field_info['epf_value_display_type']) . '</td><td>&nbsp;</td>';
        }
        echo "</tr></table></p>\n";
      }
      echo tep_image_submit('button_save.gif', IMAGE_SAVE) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_EXTRA_VALUES, 'list_id=' . $list_id . "&vid=" . $vid) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . "</a>\n"
      ?>
      </form></td></tr>
      <?php } elseif ($action == 'delete') {
        echo '<tr><td><p class="pageHeading">' . HEADING_DELETE . $vid . "</p>\n";
        $links = 0;
        if ($field_info['epf_multi_select']) {
          $children = '';
          $check_query = tep_db_query("select count(products_id) as total from " . TABLE_PRODUCTS_DESCRIPTION . " where language_id = " . (int)$lid . " and " . $field . " like '%|" . (int)$vid . "|%'");
        } else {
          $children = tep_list_epf_children($vid);
          $check_query = tep_db_query("select count(products_id) as total from " . TABLE_PRODUCTS_DESCRIPTION . " where language_id = " . (int)$lid . " and " . $field . " in (" . (int)$vid . $children . ")");
          if ($field_info['epf_has_linked_field']) {
            $query = tep_db_query("select count(value_id) as total from " . TABLE_EPF_VALUES . " where value_depends_on in (" . (int)$vid . $children . ")");
            $check = tep_db_fetch_array($query);
            $links = $check['total'];
            echo '<p>' . sprintf(TEXT_FIELD_LINKS, $lang[$lid]['name'], $current_label, $links, $field_info['epf_links_to']) . "</p>\n";
          }
        }
        $check = tep_db_fetch_array($check_query);
        echo '<p>' . sprintf(TEXT_FIELD_DATA, $lang[$lid]['name'], $current_label, $check['total']) . "</p>\n";
        if ($double_check == 'no') {
          echo '<p>' . TEXT_ARE_SURE . ($children != '' ? TEXT_VALUES_GONE : '') . "</p>\n";
          echo '<p>' . tep_draw_form('yes', FILENAME_EXTRA_VALUES, 'confirm=yes&action=delete&vid=' . $vid . '&list_id=' . $list_id . '&used=' . ($check['total'] + $links)) . tep_draw_input_field('yes', TEXT_YES, 'alt="' . TEXT_YES . '"', false, 'submit') . '</form>&nbsp;&nbsp;';
          echo tep_draw_form('no', FILENAME_EXTRA_VALUES, 'vid=' . $vid . '&list_id=' . $list_id) . tep_draw_input_field('no', TEXT_NO, 'alt="' . TEXT_NO . '"', false, 'submit') . "</form></p>\n";
        } else {
          echo '<p><b>' . TEXT_CONFIRM_DELETE . ($children != '' ? TEXT_VALUES_GONE : '') . "</b></p>\n";
          echo '<p>' . tep_draw_form('yes', FILENAME_EXTRA_VALUES, 'confirm=yes&action=delete&vid=' . $vid . '&list_id=' . $list_id) . tep_draw_input_field('yes', TEXT_YES, 'alt="' . TEXT_YES . '"', false, 'submit') . '</form>&nbsp;&nbsp;';
          echo tep_draw_form('no', FILENAME_EXTRA_VALUES, 'vid=' . $vid . '&list_id=' . $list_id) . tep_draw_input_field('no', TEXT_NO, 'alt="' . TEXT_NO . '"', false, 'submit') . "</form></p>\n";
        }
        echo "</td></tr>\n";
      } else { /* display list of values */?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ID; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_VALUE; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_IMAGE; ?></td>
                <td class="dataTableHeadingContent"><?php echo ($field_info['epf_multi_select'] ? TABLE_HEADING_EXCLUDES : TABLE_HEADING_PARENT); ?></td>
                <?php if ($field_info['epf_has_linked_field']) { ?>
                <td class="dataTableHeadingContent"><?php echo ($field_info['epf_multi_select'] ? TABLE_HEADING_REQUIRED : TABLE_HEADING_LINKED); ?></td>                
                <?php } ?>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_ORDER; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
$query = build_value_list($eid, $lid);
$selected = array();
foreach ($query as $value) {
  if ($field_info['epf_has_linked_field'] && !$field_info['epf_multi_select']) {
    $linked = array();
    $check_query = tep_db_query('select value_id from ' . TABLE_EPF_VALUES . ' where value_depends_on = ' . (int)$value['value_id']);
    while ($check = tep_db_fetch_array($check_query)) {
      $linked[] = $check['value_id'];
    }
  }
  if ($vid == '') $vid = $value['value_id'];
  if ($value['value_id'] == $vid) {
    echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_EXTRA_VALUES, 'vid=' . $vid . '&action=edit&list_id=' . $list_id) . '\'">' . "\n";
    $selected = $value;
  } else {
    echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_EXTRA_VALUES, 'vid=' . $value['value_id'] . '&list_id=' . $list_id) . '\'">' . "\n";
  }
?>
                <td class="dataTableContent"><?php echo $value['value_id']; ?></td>
                <td class="dataTableContent"><?php echo $value['epf_value']; ?></td>
                <td class="dataTableContent"><?php if ($value['value_image'] != '') echo tep_image(HTTP_CATALOG_SERVER . DIR_WS_CATALOG_IMAGES . 'epf/' . $value['value_image'], $value['epf_value']); ?></td>
                <td class="dataTableContent"><?php echo ($field_info['epf_multi_select'] ? implode(', ', get_exclude_list($value['value_id'])) : $value['parent_id']); ?></td>
                <?php if ($field_info['epf_has_linked_field']) { ?>
                <td class="dataTableContent"><?php echo ($field_info['epf_multi_select'] ? $value['value_depends_on'] : implode(', ', $linked)); ?></td>
                <?php } ?>
                <td class="dataTableContent" align="center"><?php echo $value['sort_order']; ?></td>
                <td class="dataTableContent" align="right"><?php if ($value['value_id'] == $vid) { echo tep_image(DIR_WS_IMAGES . 'icon_arrow_right.gif'); } else { echo '<a href="' . tep_href_link(FILENAME_EXTRA_VALUES, 'vid=' . $value['value_id'] . '&list_id=' . $list_id) . '">' . tep_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
}
?>
              <tr><td colspan="7" class="main">
              <?php
              echo TEXT_PREVIEW . '<br>';
              if ($field_info['epf_has_linked_field'] && $field_info['epf_multi_select']) {
                $vallist = array();
                foreach ($query as $val) {
                  $vallist[$val['value_depends_on']][] = $val['value_id'];
                }
                $query = tep_db_query('select epf_label from ' . TABLE_EPF_LABELS . ' where epf_id = ' . $field_info['epf_links_to'] . ' and languages_id = ' . (int)$lid);
                $value = tep_db_fetch_array($query);
                $label = $field_info['epf_links_to'] . ' ' . $value['epf_label'];
                $link_query = tep_db_query("select epf_value_display_type from " . TABLE_EPF . " where epf_id = " . (int)$field_info['epf_links_to']);
                $linked_field_info = tep_db_fetch_array($link_query);
                foreach ($vallist as $required => $values) {
                  if ($required == 0) {
                    echo TEXT_ALWAYS_AVAILABLE . $label;
                  } else {
                    echo sprintf(TEXT_AVAILABLE_REQUIRED, $label);
                    $check = explode(',', (string)$required . tep_list_epf_children($required));
                    $reqlist = array();
                    foreach ($check as $val) {
                      $reqlist[] = tep_get_extra_field_list_value($val, false, $linked_field_info['epf_value_display_type']);
                    }
                    echo implode(', ', $reqlist);
                  }
                  $col = 0;
                  echo '<table><tr>';
                  foreach ($values as $val) {
                    $col++;
                    if ($col > $field_info['epf_num_columns']) {
                      echo '</tr><tr>';
                      $col = 1;
                    }
                    echo '<td>' . tep_draw_checkbox_field('example', $val['value_id']) . '</td><td>' . tep_get_extra_field_list_value($val, false, $field_info['epf_value_display_type']) . '</td><td>&nbsp;</td>';
                  }
                  echo '</tr></table>';
                }
              } elseif ($field_info['epf_checked_entry'] || $field_info['epf_multi_select']) {
                $col = 0;
                echo '<table><tr>';
                foreach ($query as $val) {
                  $col++;
                  if ($col > $field_info['epf_num_columns']) {
                    echo '</tr><tr>';
                    $col = 1;
                  }
                  echo '<td>' . ($field_info['epf_multi_select'] ? tep_draw_checkbox_field('example', $val['value_id']) : tep_draw_radio_field('example', $val['value_id'])) . '</td><td>' . tep_get_extra_field_list_value($val['value_id'], false, $field_info['epf_value_display_type']) . '</td><td>&nbsp;</td>';
                }
                echo '</tr></table>';
              } else {
                echo tep_draw_pull_down_menu('preview', tep_build_epf_pulldown($eid, $lid));
              }
              ?>
              </td></tr>
              </table>
            </td>
<?php // build information box contents
  $heading = array();
  $contents = array();
  if (!empty($selected)) {
    $heading[] = array('text' => $lang[$lid]['name'] . ': ' . $current_label);
    $heading[] = array('text' => TABLE_HEADING_ID . $selected['value_id']);
    $heading[] = array('text' => ENTRY_VALUE . $selected['epf_value']);
    $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_EXTRA_VALUES, 'vid=' . $vid . '&action=edit&list_id=' . $list_id) . '">' . tep_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . tep_href_link(FILENAME_EXTRA_VALUES, 'vid=' . $vid . '&action=delete&list_id=' . $list_id) . '">' . tep_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
    if (!$field_info['epf_multi_select'])
      $contents[] = array('align' => 'center', 'text' => tep_draw_form('subvalue', FILENAME_EXTRA_VALUES, 'list_id=' . $selected['epf_id'] . '_' . $selected['languages_id'] . '&parent=' . $selected['value_id'] . "&action=new" ) . tep_draw_input_field('subvalues', BUTTON_SUBVALUE, 'alt="' . BUTTON_SUBVALUES . '"', false, 'submit') . '</form>');
    $contents[] = array('text' => ENTRY_VALUE . $selected['epf_value']);
    $contents[] = array('text' => TABLE_HEADING_PARENT . ': ' . $selected['parent_id']);
    $contents[] = array('text' => TABLE_HEADING_ORDER . ': ' . $selected['sort_order']);
    $contents[] = array('text' => TEXT_FIELD_ID . $selected['epf_id']);
    $contents[] = array('text' => TEXT_LANGAUGE . $lang[$selected['languages_id']]['name']);
    $contents[] = array('text' => TEXT_CHAIN . tep_get_extra_field_list_value($selected['value_id'], true));
    if ($selected['value_depends_on'] != 0)
      $contents[] = array('text' => TEXT_REQUIRES . '<br>' . tep_get_extra_field_list_value($selected['value_depends_on']));
  }
// display information box if it exists
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
      <?php } ?>
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
