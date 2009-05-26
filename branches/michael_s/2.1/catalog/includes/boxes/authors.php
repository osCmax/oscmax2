<?php
/*
$Id: authors.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.

  $authors_query = tep_db_query("select authors_id, authors_name from " . TABLE_AUTHORS . " order by authors_name");
  if ($number_of_author_rows = tep_db_num_rows($authors_query)) {

?>
<!-- authors //-->
 <?php
  $boxHeading = BOX_HEADING_AUTHORS;
  $corner_left = 'square';
  $corner_right = 'square';
  $box_base_name = 'authors'; // for easy unique box template setup (added BTSv1.2)

  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

//    $info_box_contents = array();
//    $info_box_contents[] = array('text' => BOX_HEADING_AUTHORS);

//    new infoBoxHeading($info_box_contents, false, false);


    if ($number_of_author_rows <= MAX_DISPLAY_AUTHORS_IN_A_LIST) {
// Display a list
      $authors_list = '';
      while ($authors = tep_db_fetch_array($authors_query)) {
        $authors_name = ((strlen($authors['authors_name']) > MAX_DISPLAY_AUTHOR_NAME_LEN) ? substr($authors['authors_name'], 0, MAX_DISPLAY_AUTHOR_NAME_LEN) . '..' : $authors['authors_name']);
        if (isset($HTTP_GET_VARS['authors_id']) && ($HTTP_GET_VARS['authors_id'] == $authors['authors_id'])) $authors_name = '<b>' . $authors_name .'</b>';
        $authors_list .= '<a href="' . tep_href_link(FILENAME_ARTICLES, 'authors_id=' . $authors['authors_id']) . '">' . $authors_name . '</a><br>';
      }

      $authors_list = substr($authors_list, 0, -4);

//    $info_box_contents = array();
      $boxContent = $authors_list;
    } else {
// Display a drop-down
      $authors_array = array();
      if (MAX_AUTHORS_LIST < 2) {
        $authors_array[] = array('id' => '', 'text' => PULL_DOWN_DEFAULT);
      }

      while ($authors = tep_db_fetch_array($authors_query)) {
        $authors_name = ((strlen($authors['authors_name']) > MAX_DISPLAY_AUTHOR_NAME_LEN) ? substr($authors['authors_name'], 0, MAX_DISPLAY_AUTHOR_NAME_LEN) . '..' : $authors['authors_name']);
        $authors_array[] = array('id' => $authors['authors_id'],
                                       'text' => $authors_name);
      }

      $boxContent = array();
      $boxContent[] = array('form' => tep_draw_form('authors', tep_href_link(FILENAME_ARTICLES, '', 'NONSSL', false), 'get'),
                                   'text' => tep_draw_pull_down_menu('authors_id', $authors_array, (isset($HTTP_GET_VARS['authors_id']) ? $HTTP_GET_VARS['authors_id'] : ''), 'onChange="this.form.submit();" size="' . MAX_AUTHORS_LIST . '" style="width: 100%"') . tep_hide_session_id());
    }

//    new infoBox($info_box_contents);

}
?>

<!-- authors_eof //-->
<?php

include (bts_select('boxes', $box_base_name)); // BTS 1.5

$boxContent = '';
$boxHeading = '';
?>