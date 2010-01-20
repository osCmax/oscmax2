<?php
/*
$Id: info_boxes.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- reports //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_BOXES,
                     'link'  => tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=1&selected_box=infobox'));
//                     'link'  => tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('selected_box')) . 'selected_box=infobox'));
                     
  if ($selected_box == 'infobox') {
    $contents[] = array('text'  => '<a href="' . tep_href_link(FILENAME_INFOBOX_CONFIGURATION, 'gID=1', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_HEADING_BOXES . '</a>');
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- reports_eof //-->