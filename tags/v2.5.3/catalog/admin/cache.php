<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  $action = (isset($_GET['action']) ? $_GET['action'] : '');

  if (tep_not_null($action)) {
    if ($action == 'reset') {
      tep_reset_cache_block($_GET['block']);
    }

    tep_redirect(tep_href_link(FILENAME_CACHE));
  }

// check if the cache directory exists
  if (is_dir(DIR_FS_CACHE)) {
    if (!is_writeable(DIR_FS_CACHE)) $messageStack->add(ERROR_CACHE_DIRECTORY_NOT_WRITEABLE, 'error');
  } else {
    $messageStack->add(ERROR_CACHE_DIRECTORY_DOES_NOT_EXIST, 'error');
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
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CACHE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_DATE_CREATED; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
  if ($messageStack->size < 1) {
    $languages = tep_get_languages();

    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
      if ($languages[$i]['code'] == DEFAULT_LANGUAGE) {
        $language = $languages[$i]['directory'];
      }
    }

//    for ($i=0, $n=sizeof($cache_blocks); $i<$n; $i++) {
//       $cached_file = ereg_replace('-language', '-' . $language, $cache_blocks[$i]['file']);
// 
//       if (file_exists(DIR_FS_CACHE . $cached_file)) {
//         $cache_mtime = strftime(DATE_TIME_FORMAT, filemtime(DIR_FS_CACHE . $cached_file));
//       } else {
//         $cache_mtime = TEXT_FILE_DOES_NOT_EXIST;
//         $dir = dir(DIR_FS_CACHE);
// 
//         while ($cache_file = $dir->read()) {
//           $cached_file = ereg_replace('-language', '-' . $language, $cache_blocks[$i]['file']);
// 
//           if (ereg('^' . $cached_file, $cache_file)) {
//             $cache_mtime = strftime(DATE_TIME_FORMAT, filemtime(DIR_FS_CACHE . $cache_file));
//             break;
//           }
//         }
// 
//         $dir->close();
//       }
// adapted for Hide products and categories from customer groups for SPPC 2008/08/02
        $dir = dir(DIR_FS_CACHE);
        $cached_file_array = array();

        while ($cache_file = $dir->read()) {
          if (strstr($cache_file, '.cache')) {
          $cached_file_array[] = explode('.cache' , $cache_file);
          }
        }
          $dir->close();

      for ($i=0, $n=sizeof($cache_blocks); $i<$n; $i++) {
        $cache_mtime = TEXT_FILE_DOES_NOT_EXIST;
        $cache_block_file = ereg_replace('-language', '-' . $language, $cache_blocks[$i]['file']);

      foreach($cached_file_array as $key => $sub_cached_file_array) {
         // if the file name starts with the kind of file we are looking for, example: categories_box-english
           if (strpos($sub_cached_file_array[0], $cache_block_file, 0) !== false) {
            $name_of_file = $sub_cached_file_array[0] . '.cache' . $sub_cached_file_array[1];
            $cache_mtime = strftime(DATE_TIME_FORMAT, filemtime(DIR_FS_CACHE . $name_of_file));
            // if one file per kind exist, then we know if there is at least one cache file so break
            break;
          }
        }

?>
              <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
                <td class="dataTableContent"><?php echo $cache_blocks[$i]['title']; ?></td>
                <td class="dataTableContent" align="right"><?php echo $cache_mtime; ?></td>
                <td class="dataTableContent" align="right"><?php echo '<a href="' . tep_href_link(FILENAME_CACHE, 'action=reset&amp;block=' . $cache_blocks[$i]['code'], 'NONSSL') . '">' . tep_image(DIR_WS_ICONS . 'icon_reset.gif', 'Reset', 13, 13) . '</a>'; ?>&nbsp;</td>
              </tr>
<?php
    }
  }
?>
              <tr>
                <td class="smallText" colspan="3"><?php echo TEXT_CACHE_DIRECTORY . ' ' . DIR_FS_CACHE; ?></td>
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
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>