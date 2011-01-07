<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<!-- information //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_INFORMATION,
                     'link'  => tep_href_link(FILENAME_INFORMATION_MANAGER, 'selected_box=information'));

  if ($selected_box == 'information') {
    $info_groups = '';
    $information_groups_query = tep_db_query("select information_group_id as igID, information_group_title as igTitle from " . TABLE_INFORMATION_GROUP . " where visible = '1' order by sort_order");
    while ($information_groups = tep_db_fetch_array($information_groups_query)) {
      $info_groups .= '<a href="' . tep_href_link(FILENAME_INFORMATION_MANAGER, 'gID=' . $information_groups['igID'], 'NONSSL') . '" class="menuBoxContentLink">' . $information_groups['igTitle'] . '</a><br>';
    }

    $contents[] = array('text'  => $info_groups);
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- information_eof //-->
