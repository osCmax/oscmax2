<?php
/*
$Id: advanced_search_result.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_ADVANCED_SEARCH);
  
// begin Extra Product Fields
  $epf_query = tep_db_query("select * from " . TABLE_EPF . " e join " . TABLE_EPF_LABELS . " l where e.epf_status and (e.epf_id = l.epf_id) and (l.languages_id = " . (int)$languages_id . ") and l.epf_active_for_language order by e.epf_order");
  $epf = array();
  while ($e = tep_db_fetch_array($epf_query)) {  // retrieve all active extra fields
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
                   'show_chain' => $e['epf_show_parent_chain'],
                   'search' => $e['epf_advanced_search'],
                   'listing' => $e['epf_show_in_listing'],
                   'field' => $field);
  }
  $epf_empty = true;
  $epf_values = array();
  foreach ($epf as $e) {
    if ($e['search'])  // only advanced searchable fields will have separate values
      if (isset($_GET[$e['field']]) && !empty($_GET[$e['field']])) {
        if ($e['uses_list'] && !$e['multi_select'] && ($_GET[$e['field']] == 'on')) {
          $_GET[$e['field']] = '';
        } else {
      		$epf_empty = false;
      		if (!$e['uses_list']) 
        		$epf_values[] = $_GET[$e['field']];
        }
      }
  }
// end Extra Product Fields

  $error = false;

  if ( (isset($_GET['keywords']) && empty($_GET['keywords'])) &&
// BOF: Extra Product Fields
       $epf_empty &&
       (isset($_GET['categories_id']) && empty($_GET['categories_id'])) &&
       (isset($_GET['manufacturers_id']) && empty($_GET['manufacturers_id'])) &&
// EOF: Extra Product Fields
       (isset($_GET['dfrom']) && (empty($_GET['dfrom']) || ($_GET['dfrom'] == DOB_FORMAT_STRING))) &&
       (isset($_GET['dto']) && (empty($_GET['dto']) || ($_GET['dto'] == DOB_FORMAT_STRING))) &&
       (isset($_GET['pfrom']) && !is_numeric($_GET['pfrom'])) &&
       (isset($_GET['pto']) && !is_numeric($_GET['pto'])) ) {
    $error = true;

    $messageStack->add_session('search', ERROR_AT_LEAST_ONE_INPUT);
  } else {
    $dfrom = '';
    $dto = '';
    $pfrom = '';
    $pto = '';
    $keywords = '';

    if (isset($_GET['dfrom'])) {
      $dfrom = (($_GET['dfrom'] == DOB_FORMAT_STRING) ? '' : $_GET['dfrom']);
    }

    if (isset($_GET['dto'])) {
      $dto = (($_GET['dto'] == DOB_FORMAT_STRING) ? '' : $_GET['dto']);
    }

    if (isset($_GET['pfrom'])) {
      $pfrom = $_GET['pfrom'];
    }

    if (isset($_GET['pto'])) {
      $pto = $_GET['pto'];
    }

    if (isset($_GET['keywords'])) {
      $keywords = $_GET['keywords'];
    }

    $date_check_error = false;
    if (tep_not_null($dfrom)) {
      if (!tep_checkdate($dfrom, DOB_FORMAT_STRING, $dfrom_array)) {
        $error = true;
        $date_check_error = true;

        $messageStack->add_session('search', ERROR_INVALID_FROM_DATE);
      }
    }

    if (tep_not_null($dto)) {
      if (!tep_checkdate($dto, DOB_FORMAT_STRING, $dto_array)) {
        $error = true;
        $date_check_error = true;

        $messageStack->add_session('search', ERROR_INVALID_TO_DATE);
      }
    }

    if (($date_check_error == false) && tep_not_null($dfrom) && tep_not_null($dto)) {
      if (mktime(0, 0, 0, $dfrom_array[1], $dfrom_array[2], $dfrom_array[0]) > mktime(0, 0, 0, $dto_array[1], $dto_array[2], $dto_array[0])) {
        $error = true;

        $messageStack->add_session('search', ERROR_TO_DATE_LESS_THAN_FROM_DATE);
      }
    }

    $price_check_error = false;
    if (tep_not_null($pfrom)) {
      if (!settype($pfrom, 'double')) {
        $error = true;
        $price_check_error = true;

        $messageStack->add_session('search', ERROR_PRICE_FROM_MUST_BE_NUM);
      }
    }

    if (tep_not_null($pto)) {
      if (!settype($pto, 'double')) {
        $error = true;
        $price_check_error = true;

        $messageStack->add_session('search', ERROR_PRICE_TO_MUST_BE_NUM);
      }
    }

    if (($price_check_error == false) && is_float($pfrom) && is_float($pto)) {
      if ($pfrom >= $pto) {
        $error = true;

        $messageStack->add_session('search', ERROR_PRICE_TO_LESS_THAN_PRICE_FROM);
      }
    }

    if (tep_not_null($keywords)) {
      if (!tep_parse_search_string(stripslashes($keywords), $search_keywords)) {	
        $error = true;

        $messageStack->add_session('search', ERROR_INVALID_KEYWORDS);
      }
    }
	// BOF: Extra Product Fields
    if (tep_not_null($epf_values)) {
      foreach ($epf_values as $value) {
        if (!tep_parse_search_string($value, $epf_value_keywords)) {
          $error = true;
          $messageStack->add_session('search', ERROR_INVALID_KEYWORDS . $value );
        }
      }
    }
	// EOF: Extra Product Fields
  }

  if (empty($dfrom) && empty($dto) && empty($pfrom) && empty($pto) && empty($keywords) 
// BOF: Extra Product Fields
     && $epf_empty &&
     (isset($_GET['categories_id']) && empty($_GET['categories_id'])) &&
     (isset($_GET['manufacturers_id']) && empty($_GET['manufacturers_id']))
// EOF: Extra Product Fields
     ) {

    $error = true;

    $messageStack->add_session('search', ERROR_AT_LEAST_ONE_INPUT);
  }

  if ($error == true) {
    tep_redirect(tep_href_link(FILENAME_ADVANCED_SEARCH, tep_get_all_get_params(), 'NONSSL', true, false));
  }

  $breadcrumb->add(NAVBAR_TITLE_1, tep_href_link(FILENAME_ADVANCED_SEARCH));
  $breadcrumb->add(NAVBAR_TITLE_2, tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, tep_get_all_get_params(), 'NONSSL', true, false));

  $content = CONTENT_ADVANCED_SEARCH_RESULT;

  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php');
?>
