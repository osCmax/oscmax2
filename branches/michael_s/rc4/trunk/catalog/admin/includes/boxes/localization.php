<?php
/*
$Id: localization.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- localization //-->
          <tr>
            <td>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('text'  => BOX_HEADING_LOCALIZATION,
                     'link'  => tep_href_link(FILENAME_CURRENCIES, 'selected_box=localization'));

  if ($selected_box == 'localization') {
// BOF: MOD - Admin w/access levels
// Old OSC line  $contents[] = array('text'  => '<a href="' . tep_href_link(FILENAME_CURRENCIES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_LOCALIZATION_CURRENCIES . '</a><br>' .
// Old OSC line                    '<a href="' . tep_href_link(FILENAME_LANGUAGES, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_LOCALIZATION_LANGUAGES . '</a><br>' .
// Old OSC line                    '<a href="' . tep_href_link(FILENAME_ORDERS_STATUS, '', 'NONSSL') . '" class="menuBoxContentLink">' . BOX_LOCALIZATION_ORDERS_STATUS . '</a>');
    $contents[] = array('text'  => tep_admin_files_boxes(FILENAME_CURRENCIES, BOX_LOCALIZATION_CURRENCIES) .
                                   tep_admin_files_boxes(FILENAME_LANGUAGES, BOX_LOCALIZATION_LANGUAGES) .
                                   tep_admin_files_boxes(FILENAME_ORDERS_STATUS, BOX_LOCALIZATION_ORDERS_STATUS));
// EOF: MOD - Admin w/access levels
  }

  $box = new box;
  echo $box->menuBox($heading, $contents);
?>
            </td>
          </tr>
<!-- localization_eof //-->
