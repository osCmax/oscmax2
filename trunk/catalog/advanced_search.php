<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADVANCED_SEARCH);

// begin Extra Product Fields
    $epf_query = tep_db_query("select * from " . TABLE_EPF . " e join " . TABLE_EPF_LABELS . " l where e.epf_status and e.epf_advanced_search and (e.epf_id = l.epf_id) and (l.languages_id = " . (int)$languages_id . ") and l.epf_active_for_language order by e.epf_order");
    $epf = array();
    while ($e = tep_db_fetch_array($epf_query)) {
      $field = 'extra_value';
      if ($e['epf_uses_value_list']) {
        if ($e['epf_multi_select']) {
          $field .= '_ms';
        } else {
          $field .= '_id';
        }
      }
      $field .= $e['epf_id'];
      $epf[] = array('id' => $e['epf_id'],
                     'label' => $e['epf_label'],
                     'uses_list' => $e['epf_uses_value_list'],
                     'multi_select' => $e['epf_multi_select'],
                     'use_checkbox' => $e['epf_checked_entry'],
                     'columns' => $e['epf_num_columns'],
                     'display_type' => $e['epf_value_display_type'],
                     'field' => $field);
    }
// end Extra Product Fields

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ADVANCED_SEARCH));

  $content = CONTENT_ADVANCED_SEARCH;
  $javascript = $content . '.js.php';

  include (bts_select('main')); // BTSv1.5


  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
