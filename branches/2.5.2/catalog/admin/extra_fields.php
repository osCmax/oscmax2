<?php
/*
$Id$
  
  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');


  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  $eid = (isset($_GET['eid']) ? $_GET['eid'] : '');
  $confirm = (isset($_GET['confirm']) ? $_GET['confirm'] : '');
  $languages = tep_get_languages();
  $lang = array();
  for ($i=0, $n=sizeof($languages); $i<$n; $i++) { // build array accessed directly by language id
    $lang[$languages[$i]['id']] = array ('name' => $languages[$i]['name'],
                                         'code' => $languages[$i]['code'],
                                         'image' => $languages[$i]['image'],
                                         'directory' => $languages[$i]['directory']);
  }
  $categories = tep_get_category_tree();
  $confirmation_needed = false;
  if (tep_not_null($action)) {
    $messages = array();
    $error = false;
    switch ($action) {
      case 'insert': // validate form
        if (!isset($_POST['status'])) {
          $error = true;
          $messages[] = ERROR_ENTRY_REQUIRED . ENTRY_ACTIVATE_NOW;
        } else {
          $status = ($_POST['status'] == '0') ? 0 : 1;
        }
        if (!isset($_POST['show_admin'])) {
          $error = true;
          $messages[] = ERROR_ENTRY_REQUIRED . ENTRY_SHOW_ADMIN;
        } else {
          $show_admin = ($_POST['show_admin'] == '0') ? 0 : 1;
        }
        $order = (isset($_POST['sort_order'])) ? tep_db_prepare_input($_POST['sort_order']) : 0;
        if (!isset($_POST['search'])) {
          $error = true;
          $messages[] = ERROR_ENTRY_REQUIRED . ENTRY_SEARCH;
        } else {
          $search = ($_POST['search'] == '0') ? 0 : 1;
        }
        if (!isset($_POST['listing'])) {
          $error = true;
          $messages[] = ERROR_ENTRY_REQUIRED . ENTRY_LISTING;
        } else {
          $listing = ($_POST['listing'] == '0') ? 0 : 1;
        }
        //if (!isset($_POST['meta'])) {
        //  $error = true;
        //  $messages[] = ERROR_ENTRY_REQUIRED . ENTRY_META;
        //} else {
        //  $meta = ($_POST['meta'] == '0') ? 0 : 1;
        $meta = 0;
		//}
        if (!isset($_POST['value_list'])) {
          $error = true;
          $messages[] = ERROR_ENTRY_REQUIRED . ENTRY_VALUE_LIST;
        } else {
          $uses_list = ($_POST['value_list'] == '0') ? 0 : 1;
        }
        if ($uses_list === 0) { // values required only if not using value list
          if (!isset($_POST['text_entry'])) {
            $error = true;
            $messages[] = ERROR_ENTRY_REQUIRED . ENTRY_TEXT_ENTRY;
          } else {
            $text_type = ($_POST['text_entry'] == '1') ? 1 : 0;
          }
          if ($text_type && $listing) {
            $error = true;
            $messages[] = ERROR_INCOMPATIBLE_TA_PL;
          }
          if (!$text_type) {
            if (!isset($_POST['size'])) {
              $error = true;
              $messages[] = ERROR_ENTRY_REQUIRED . TEXT_SIZE;
            } else {
              $size = tep_db_prepare_input($_POST['size']);
              if (!is_numeric($size) || ($size < 1) || ($size > 255)) {
                $error = true;
                $messages[] = ERROR_OUTOFRANGE;
              }
            }
          }
        }
        if ($uses_list == 1) {
          $size = 64; 
          $text_type = 0;
          if (!isset($_POST['list_type'])) {
            $error = true;
            $messages[] = ERROR_ENTRY_REQUIRED . TEXT_USER_SELECTS;
          } else {
            $list_type = ($_POST['list_type'] == '1') ? 1 : 0;
          }
          if (!isset($_POST['chain'])) {
            $error = true;
            $messages[] = ERROR_ENTRY_REQUIRED . TEXT_SHOW_PARENTS;
          } else {
            $chain = ($_POST['chain'] == '0') ? 0 : 1;
          }
          if ($chain && $list_type) {
            $error = true;
            $messages[] = ERROR_INCOMPATIBLE_MS_SC;
          }
          if (!isset($_POST['restrict'])) {
            $error = true;
            $messages[] = ERROR_ENTRY_REQUIRED . TEXT_RESTRICTS;
          } else {
            $restrict = ($_POST['restrict'] == '0') ? 0 : 1;
          }
          if ($restrict && $list_type) {
            $error = true;
            $messages[] = ERROR_INCOMPATIBLE_MS_RPL;
          }
          if (!isset($_POST['quicksearch'])) {
            $error = true;
            $messages[] = ERROR_ENTRY_REQUIRED . TEXT_SEARCH_BOX;
          } else {
            $quicksearch = ($_POST['quicksearch'] == '0') ? 0 : 1;
          }
          if ($quicksearch && !$search) {
            $error = true;
            $messages[] = ERROR_AS_REQUIRED;
          }
          if ($quicksearch && $list_type) {
            $error = true;
            $messages[] = ERROR_INCOMPATIBLE_MS_QS;
          }
          if (!isset($_POST['checkboxes']) && !$list_type) {
            $error = true;
            $messages[] = ERROR_ENTRY_REQUIRED . TEXT_SELECTED_BY;
          } else {
            $entry_method = ($_POST['checkboxes'] == '1') ? 1 : 0;
          }
          if ($list_type) $entry_method = 1;
          if (!isset($_POST['columns'])) {
            $error = true;
            $messages[] = ERROR_ENTRY_REQUIRED . TEXT_COLUMNS;
          } else {
            $columns = tep_db_prepare_input($_POST['columns']);
            if (!is_numeric($columns) || ($columns < 1) || ($columns > 255)) {
              $error = true;
              $messages[] = ERROR_COLS_OUTOFRANGE;
            }
          }
          if (!isset($_POST['display_type'])) {
            $error = true;
            $messages[] = ERROR_ENTRY_REQUIRED . TEXT_DISPLAY_TYPE;
          } else {
            $display_type = tep_db_prepare_input($_POST['display_type']);
            if (!in_array($display_type, array('0', '1', '2'))) {
              $display_type = 0;
            }
          }
        } else { // values that do not apply to text fields 
          $chain = 0;
          $restrict = 0;
          $list_type = 0;
          $entry_method = 0;
          $quicksearch = 0;
          $columns = 1;
          $display_type = 0;
        }
        $labels = array();
        $active = false;
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          if (!isset($_POST['langactive_' . $languages[$i]['id']])) {
            $error = true;
            $messages[] = ERROR_ENTRY_REQUIRED . ENTRY_ACTIVE . $languages[$i]['name'];
          } else {
            $lactive = ($_POST['langactive_' . $languages[$i]['id']] == '0') ? 0 : 1;
          }
          $lbl = (isset($_POST['label_' . $languages[$i]['id']])) ? tep_db_prepare_input($_POST['label_' . $languages[$i]['id']]) : '';
          if ($lactive && !tep_not_null($lbl)) {
            $error = true;
            $messages[] = sprintf(ERROR_LABEL, $languages[$i]['name']);
          }
          if ($lactive) $active = true;
          $labels[$languages[$i]['id']] = array('active' => $lactive, 'label' => $lbl);
        }
        if (!$active) {
          $error = true;
          $messages[] = ERROR_ACTIVE;
        }
        if ($error) {  // if error return to entry form
          $action = 'new';
        } else { // otherwise create field
          $data_array = array('epf_order' => (int)$order,
                              'epf_status' => $status,
                              'epf_show_in_admin' => $show_admin,
                              'epf_uses_value_list' => $uses_list,
                              'epf_multi_select' => $list_type,
                              'epf_advanced_search' => $search,
                              'epf_quick_search' => $quicksearch,
                              'epf_show_in_listing' => $listing,
                              'epf_size' => (int)$size,
                              'epf_use_as_meta_keyword' => $meta,
                              'epf_use_to_restrict_listings' => $restrict,
                              'epf_checked_entry' => $entry_method,
                              'epf_show_parent_chain' => $chain,
                              'epf_value_display_type' => $display_type,
                              'epf_num_columns' => (int)$columns,
                              'epf_textarea' => $text_type,
                              'epf_all_categories' => $all_cats,
                              'epf_category_ids' => (!empty($app_cats) ? implode('|', $app_cats) : 'null'));
          tep_db_perform(TABLE_EPF, $data_array);
          $eid = tep_db_insert_id();
          $field = 'extra_value';
          if ($text_type) {
            $mysql_type = ' text default null';
          } else {
            $mysql_type = ' varchar(' . (int)$size . ') default null';
          }
          if ($uses_list) {
            if ($list_type) {
              $field .= '_ms';
              $mysql_type = ' text default null';
            } else {
              $field .= '_id';
              $mysql_type = ' int unsigned not null default 0';
            }
          }
          $field .= $eid;
          tep_db_query('alter table ' . TABLE_PRODUCTS_DESCRIPTION . ' add ' . $field . $mysql_type);
          foreach ($labels as $lid => $value) {
            $label_array = array('epf_id' => $eid,
                                 'languages_id' => $lid,
                                 'epf_label' => ($value['active'] ? $value['label'] : ''),
                                 'epf_active_for_language' => $value['active']);
            tep_db_perform(TABLE_EPF_LABELS, $label_array);
          }
          tep_redirect(tep_href_link(FILENAME_EXTRA_FIELDS, 'eid=' . $eid));
        }
        break;
      case 'update': // validate form
        $all_cats = ($HTTP_POST_VARS['all_cats'] == '0') ? 0 : 1;
        $app_cats = array();
        foreach ($categories as $cat) {
          if (isset($HTTP_POST_VARS['usecat' . $cat['id']]) && ($HTTP_POST_VARS['usecat' . $cat['id']] == $cat['id'])) $app_cats[] = $cat['id'];
        }
        if (empty($app_cats) || in_array(0, $app_cats)) $all_cats = 1; // if no categories selected or TOP category selected set all categories to true
        if ($all_cats)  $app_cats = array(); // force applicable categories to empty if all categories selected
        $query = tep_db_query("select * from " . TABLE_EPF . " where epf_id = " . (int)$eid);
        $field_info = tep_db_fetch_array($query); // retrieve original field information
        if (!isset($_POST['status'])) {
          $error = true;
          $messages[] = ERROR_ENTRY_REQUIRED . ENTRY_ACTIVATE_NOW;
        } else {
          $status = ($_POST['status'] == '0') ? 0 : 1;
        }
        if (!isset($_POST['show_admin'])) {
          $error = true;
          $messages[] = ERROR_ENTRY_REQUIRED . ENTRY_SHOW_ADMIN;
        } else {
          $show_admin = ($_POST['show_admin'] == '0') ? 0 : 1;
        }
        $order = (isset($_POST['sort_order'])) ? tep_db_prepare_input($_POST['sort_order']) : 0;
        if (!isset($_POST['search'])) {
          $error = true;
          $messages[] = ERROR_ENTRY_REQUIRED . ENTRY_SEARCH;
        } else {
          $search = ($_POST['search'] == '0') ? 0 : 1;
        }
        if (!isset($_POST['listing'])) {
          $error = true;
          $messages[] = ERROR_ENTRY_REQUIRED . ENTRY_LISTING;
        } else {
          $listing = ($_POST['listing'] == '0') ? 0 : 1;
        }
        //if (!isset($_POST['meta'])) {
        //  $error = true;
        //  $messages[] = ERROR_ENTRY_REQUIRED . ENTRY_META;
        //} else {
        //  $meta = ($_POST['meta'] == '0') ? 0 : 1;
        //}
		$meta = 0;
        $uses_list = $field_info['epf_uses_value_list'];
        if (($uses_list == 0) && !$field_info['epf_textarea']) { // size required only if standard text field
          if (!isset($_POST['size'])) {
            $error = true;
            $messages[] = ERROR_ENTRY_REQUIRED . TEXT_SIZE;
          } else {
            $size = tep_db_prepare_input($_POST['size']);
            if (!is_numeric($size) || ($size < 1) || ($size > 255)) {
              $error = true;
              $messages[] = ERROR_OUTOFRANGE;
            }
          }
        }
        if ($uses_list == 1) {
          $size = 64;
          if (!$field_info['epf_multi_select']) {
            if (!isset($_POST['chain'])) {
              $error = true;
              $messages[] = ERROR_ENTRY_REQUIRED . TEXT_SHOW_PARENTS;
            } else {
              $chain = ($_POST['chain'] == '0') ? 0 : 1;
            }
            if (!isset($_POST['restrict'])) {
              $error = true;
              $messages[] = ERROR_ENTRY_REQUIRED . TEXT_RESTRICTS;
            } else {
              $restrict = ($_POST['restrict'] == '0') ? 0 : 1;
            }
            if (!isset($_POST['quicksearch'])) {
              $error = true;
              $messages[] = ERROR_ENTRY_REQUIRED . TEXT_SEARCH_BOX;
            } else {
              $quicksearch = ($_POST['quicksearch'] == '0') ? 0 : 1;
            }
            if ($quicksearch && !$search) {
              $error = true;
              $messages[] = ERROR_AS_REQUIRED;
            }
            if (!isset($_POST['checkboxes'])) {
              $error = true;
              $messages[] = ERROR_ENTRY_REQUIRED . TEXT_SELECTED_BY;
            } else {
              $entry_method = ($_POST['checkboxes'] == '1') ? 1 : 0;
            }
          } else {
            $chain = 0;
            $restrict = 0;
            $quicksearch = 0;
            $entry_method = 1;
          }
          if (!isset($_POST['columns'])) {
            $error = true;
            $messages[] = ERROR_ENTRY_REQUIRED . TEXT_COLUMNS;
          } else {
            $columns = tep_db_prepare_input($_POST['columns']);
            if (!is_numeric($columns) || ($columns < 1) || ($columns > 255)) {
              $error = true;
              $messages[] = ERROR_COLS_OUTOFRANGE;
            }
          }
          if (!isset($_POST['display_type'])) {
            $error = true;
            $messages[] = ERROR_ENTRY_REQUIRED . TEXT_DISPLAY_TYPE;
          } else {
            $display_type = tep_db_prepare_input($_POST['display_type']);
            if (!in_array($display_type, array('0', '1', '2'))) {
              $display_type = 0;
            }
          }
        } else { // values that are never active if not using value list 
          $chain = 0;
          $restrict = 0;
          $entry_method = 0;
          $quicksearch = 0;
          $columns = 1;
          $display_type = 0;
        }
        $labels = array();
        $active = false;
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          if (!isset($_POST['langactive_' . $languages[$i]['id']])) {
            $error = true;
            $messages[] = ERROR_ENTRY_REQUIRED . ENTRY_ACTIVE . $languages[$i]['name'];
          } else {
            $lactive = ($_POST['langactive_' . $languages[$i]['id']] == '0') ? 0 : 1;
          }
          $lbl = (isset($_POST['label_' . $languages[$i]['id']])) ? tep_db_prepare_input($_POST['label_' . $languages[$i]['id']]) : '';
          if ($lactive && !tep_not_null($lbl)) {
            $error = true;
            $messages[] = sprintf(ERROR_LABEL, $languages[$i]['name']);
          }
          if ($lactive) $active = true;
          $labels[$languages[$i]['id']] = array('active' => $lactive, 'label' => $lbl);
        }
        if (!$active) { // if no active languages
          $error = true;
          $messages[] = ERROR_ACTIVE;
        }
        if ($error) {  // if error return to entry form
          $action = 'edit';
        } else { // otherwise update field
          $field = 'extra_value';
          $mysql_type = ' varchar(' . (int)$size . ') default null';
          if ($uses_list) {
            if ($field_info['epf_multi_select']) {
              $field .= '_ms';
              $mysql_type = ' text default null';
            } else {
              $field .= '_id';
              $mysql_type = ' int unsigned not null default 0';
            }
          }
          $field .= $eid;
          if (($size < $field_info['epf_size'])) {
            $check_query = tep_db_query("select count(products_id) as total, max(length(" . $field . ")) as maxlen from " . TABLE_PRODUCTS_DESCRIPTION . " where length(" . $field . ") > " . (int)$size);
            $check = tep_db_fetch_array($check_query);
            if ($check['total'] > 1) { // check to see if reducing size will truncate data
              $confirmation_needed = true;
              $messages[] = sprintf(WARNING_TRUNCATE, $check['total'], $check['maxlen']);
            }
          }
          $label_query = tep_db_query("select * from " . TABLE_EPF_LABELS . " where epf_id=" . (int)$eid);
          while ($label_info = tep_db_fetch_array($label_query)) {
            if ($label_info['epf_active_for_language'] > $labels[$label_info['languages_id']]['active']) { // if language being deactivated
              $check_query = tep_db_query("select count(products_id) as total from " . TABLE_PRODUCTS_DESCRIPTION . " where language_id = " . (int)$label_info['languages_id'] . " and " . ($uses_list && !$field_info['epf_multi_select'] ? $field . " > 0" : "length(" . $field . ") > 0"));
              $check = tep_db_fetch_array($check_query);
              if ($check['total'] > 0) { // check to see if langauge is used
                $confirmation_needed = true;
                $messages[] = sprintf(WARNING_LANGUAGE_IN_USE, $check['total'], $lang[$label_info['languages_id']]['name']);
              }
            }
          }
          if ((!$confirmation_needed) || ($confirm == 'yes')) { // if confirmation not needed or changes have been confirmed
            $data_array = array('epf_order' => (int)$order,
                                'epf_status' => $status,
                                'epf_show_in_admin' => $show_admin,
                                'epf_advanced_search' => $search,
                                'epf_quick_search' => $quicksearch,
                                'epf_show_in_listing' => $listing,
                                'epf_size' => (int)$size,
                                'epf_use_as_meta_keyword' => $meta,
                                'epf_use_to_restrict_listings' => $restrict,
                                'epf_checked_entry' => $entry_method,
                                'epf_value_display_type' => $display_type,
                                'epf_show_parent_chain' => $chain,
                                'epf_num_columns' => (int)$columns,
                                'epf_all_categories' => $all_cats,
                                'epf_category_ids' => (!empty($app_cats) ? implode('|', $app_cats) : 'null'));
            tep_db_perform(TABLE_EPF, $data_array, 'update', 'epf_id = ' . (int)$eid);
            if (($uses_list == 0) && ($field_info['epf_size'] != $size)) { // if text field size has changed
              tep_db_query('alter table ' . TABLE_PRODUCTS_DESCRIPTION . '  change ' . $field . ' ' . $field . ' varchar(' . (int)$size . ') default null');
            }
            foreach ($labels as $lid => $value) {
              $label_array = array('epf_label' => $value['label'],
                                   'epf_active_for_language' => $value['active']);
              tep_db_perform(TABLE_EPF_LABELS, $label_array, 'update', '(epf_id = ' . (int)$eid . ') and (languages_id = ' . (int)$lid . ')');
            }
            tep_redirect(tep_href_link(FILENAME_EXTRA_FIELDS, 'eid=' . $eid));
          } else { // request confirmation
            $action = 'edit';
          }
        }
        break;
      case 'delete':
        if ($confirm == 'yes') {
          if (isset($_GET['used']) && ($_GET['used'] > 0)) {
            $double_check = 'yes';
          } else {
            $query = tep_db_query("select epf_uses_value_list, epf_multi_select, epf_has_linked_field, epf_links_to from " . TABLE_EPF . " where epf_id = " . (int)$eid);
            $field_info = tep_db_fetch_array($query); // retrieve field type
            $field = 'extra_value';
            if ($field_info['epf_uses_value_list']) {
              if ($field_info['epf_multi_select']) {
                $field .= '_ms';
              } else {
                $field .= '_id';
              }
            }
            $field .= (int)$eid;
            tep_db_query('alter table ' . TABLE_PRODUCTS_DESCRIPTION . ' drop ' . $field);
            tep_db_query('delete from ' . TABLE_EPF . ' where epf_id = ' . (int)$eid);
            tep_db_query('delete from ' . TABLE_EPF_LABELS . ' where epf_id = ' . (int)$eid);
            if ($field_info['epf_uses_value_list']) {
              if ($field_info['epf_has_linked_field']) {
                $query = tep_db_query("select value_id from " . TABLE_EPF_VALUES . ' where epf_id = ' . (int)$field_info['epf_links_to']);
                $values = array();
                while ($v = tep_db_fetch_array($query)) {
                  $values[] = $v['value_id'];
                }
                if (!empty($values)) {
                  $vlist = implode(',', $values);
                  tep_db_query('update ' . TABLE_EPF_VALUES . ' set value_depends_on = 0 where value_depends_on in (' . $vlist . ')');
                }
                tep_db_query('update ' . TABLE_EPF . ' set epf_has_linked_field = 0, epf_links_to = 0 where epf_id = ' . (int)$field_info['epf_links_to']);
              }
              $query = tep_db_query("select value_id, value_image from " . TABLE_EPF_VALUES . ' where epf_id = ' . (int)$eid);
              $values = array();
              while ($v = tep_db_fetch_array($query)) {
                $values[] = $v['value_id'];
                if (tep_not_null($v['value_image'])) {
                  if (file_exists(DIR_FS_CATALOG_IMAGES . 'epf/' . $v['value_image'])) {
                    @unlink(DIR_FS_CATALOG_IMAGES . 'epf/' . $v['value_image']);
                  }
                }
              }
              if (!empty($values)) {
                $vlist = implode(',', $values);
                tep_db_query('update ' . TABLE_EPF_VALUES . ' set value_depends_on = 0 where value_depends_on in (' . $vlist . ')');
                tep_db_query('delete from ' . TABLE_EPF_EXCLUDE . ' where (value_id1 in (' . $vlist . ')) or (value_id2 in (' . $vlist . '))');
              }
            tep_db_query('delete from ' . TABLE_EPF_VALUES . ' where epf_id = ' . (int)$eid);
            }
            tep_redirect(tep_href_link(FILENAME_EXTRA_FIELDS));
          }
        } else {
          $double_check = 'no';
        }
        break;
      case 'link':
        if ($confirm == 'yes') {
          $error = false;
          $eid = tep_db_prepare_input($_POST['epf_id']);
          $link_to = tep_db_prepare_input($_POST['link_to']);
          $query = tep_db_query('select * from ' . TABLE_EPF . ' where epf_id = ' . (int)$eid);
          if (tep_db_num_rows($query) != 1) {
            $error = true;
            $messageStack->add_session(ERROR_NO_FIELD . ' ' . $eid, 'error');
            $eid = '';
          }
          $source = tep_db_fetch_array($query);
          $query = tep_db_query('select * from ' . TABLE_EPF . ' where epf_id = ' . (int)$link_to);
          if (tep_db_num_rows($query) != 1) {
            $error = true;
            $messageStack->add_session(ERROR_NO_FIELD . ' ' . $link_to, 'error');
          }
          $dest = tep_db_fetch_array($query);
          if (!($source['epf_uses_value_list'] && $dest['epf_uses_value_list'])) {
            $error = true;
            $messageStack->add_session(ERROR_WRONG_TYPE, 'error');
          }
          if ($source['epf_multi_select'] == $dest['epf_multi_select']) {
            $error = true;
            $messageStack->add_session(ERROR_SAME_TYPE, 'error');
          }
          if ($source['epf_has_linked_field']) {
            $error = true;
            $messageStack->add_session(sprintf(ERROR_ALREADY_LINKED, $eid), 'error');
          }
          if ($dest['epf_has_linked_field']) {
            $error = true;
            $messageStack->add_session(sprintf(ERROR_ALREADY_LINKED, $link_to), 'error');
          }
          $label_query = tep_db_query("select languages_id from " . TABLE_EPF_LABELS . " where (epf_id = " . (int)$eid . ") and epf_active_for_language");
          $eid_active_languages = array();
          while ($label = tep_db_fetch_array($label_query)) {
            $eid_active_languages[] = $label['languages_id'];
          }
          if (empty($eid_active_languages)) {
            $error = true;
            $messageStack->add_session(ERROR_NO_FIELD . ' ' . $eid, 'error');            
          } else {
            $check = tep_db_query("select languages_id from " . TABLE_EPF_LABELS . " where (epf_id = " . (int)$link_to . ") and epf_active_for_language and languages_id in (" . implode(',', $eid_active_languages) . ")");
            if (tep_db_num_rows($check) == 0 ) {
              $error = true;
              $messageStack->add_session(TEXT_NOT_LINKABLE, 'error');
            }
          }
          if (!$error) {
            tep_db_query('update ' . TABLE_EPF . ' set epf_has_linked_field = 1, epf_links_to = ' . (int)$link_to . ' where epf_id = ' . (int)$eid);
            tep_db_query('update ' . TABLE_EPF . ' set epf_has_linked_field = 1, epf_links_to = ' . (int)$eid . ' where epf_id = ' . (int)$link_to);
            $messageStack->add_session(sprintf(TEXT_LINK_SUCCESS, $eid, $link_to), 'success');
          }
          tep_redirect(tep_href_link(FILENAME_EXTRA_FIELDS, 'eid=' . $eid));
        }
        break;
      case 'unlink':
        if ($confirm == 'yes') {
          if (isset($_GET['used']) && ($_GET['used'] > 0)) {
            $double_check = 'yes';
          } else {
            $query = tep_db_query("select * from " . TABLE_EPF . " where epf_id = " . (int)$eid);
            $field_info = tep_db_fetch_array($query); // retrieve linked field
            if (!$field_info['epf_has_linked_field'] || ($field_info['epf_links_to'] == 0)) {
              $messageStack->add_session(ERROR_NOT_LINKED, 'error');
              tep_redirect(tep_href_link(FILENAME_EXTRA_FIELDS, 'eid=' . $eid));
            }
            $linked_id = $field_info['epf_links_to'];
            $query = tep_db_query("select value_id from " . TABLE_EPF_VALUES . ' where epf_id = ' . (int)$eid);
            $values = array();
            while ($v = tep_db_fetch_array($query)) {
              $values[] = $v['value_id'];
            }
            if (!empty($values)) {
              $vlist = implode(',', $values);
              tep_db_query('update ' . TABLE_EPF_VALUES . ' set value_depends_on = 0 where value_depends_on in (' . $vlist . ')');
            }
            $query = tep_db_query("select value_id from " . TABLE_EPF_VALUES . ' where epf_id = ' . (int)$linked_id);
            $values = array();
            while ($v = tep_db_fetch_array($query)) {
              $values[] = $v['value_id'];
            }
            if (!empty($values)) {
              $vlist = implode(',', $values);
              tep_db_query('update ' . TABLE_EPF_VALUES . ' set value_depends_on = 0 where value_depends_on in (' . $vlist . ')');
            }
            tep_db_query('update ' . TABLE_EPF . ' set epf_has_linked_field = 0, epf_links_to = 0 where epf_id = ' . (int)$eid);
            tep_db_query('update ' . TABLE_EPF . ' set epf_has_linked_field = 0, epf_links_to = 0 where epf_id = ' . (int)$linked_id);
            tep_redirect(tep_href_link(FILENAME_EXTRA_FIELDS, 'eid=' . $eid));
          }
        } else {
          $double_check = 'no';
        }
        break;
      case 'setflag':
        $flag = (isset($_GET['flag']) ? $_GET['flag'] : 'oops');
        if (!is_numeric($flag) || (($flag != 0) && ($flag != 1))) break; // skip if flag not properly set
        tep_db_query('update ' . TABLE_EPF . ' set epf_status = ' . (int)$flag . ' where epf_id = ' . (int)$eid);
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
<link rel="stylesheet" type="text/css" href="includes/javascript/jquery-ui-1.8.9.custom.css">
<script type="text/javascript" src="includes/general.js"></script>
</head>
<body>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top">
      <table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
      <!-- left_navigation //-->
      <?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
      <!-- left_navigation_eof //-->
      </table>
    </td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?>
            <?php
			if (($action == 'new') || ($action =='edit')) {
			  if ($action == 'edit') {
			    echo ': ' . HEADING_EDIT . $eid . "</p>\n";
              } else {
                echo ': ' . HEADING_NEW . "</p>\n";
              }
			} ?>
          </tr>
        </table></td>
      </tr>
      <?php if (($action == 'new') || ($action =='edit')) {
      if ($action == 'edit') {
        $query = tep_db_query("select * from " . TABLE_EPF . " where epf_id = " . (int)$eid);
        $field = tep_db_fetch_array($query);
        $label_query = tep_db_query("select * from " . TABLE_EPF_LABELS . " where epf_id = " . (int)$eid);
        $epf_label = array();
        while ($label = tep_db_fetch_array($label_query)) {
          $epf_label[$label['languages_id']] = $label;
        }
        $applicable_cats = explode('|', $field['epf_category_ids']);
      } else {
        $applicable_cats = array();
      }
      if (!empty($messages)) {
        echo '<table width="90%">' . "\n";
        foreach ($messages as $message) {
          echo '<tr><td ' . ($error ? 'class="messageStackError"' : 'class="messageStackAlert"') . '>' . $message . "</td></tr>\n";
        }
        echo "</table>\n";
		echo "<table><tr><td>" . tep_draw_separator('pixel_trans.gif', '100%', '10') . "<td></tr></table>";
      }
      echo tep_draw_form('field_entry', FILENAME_EXTRA_FIELDS, 'action=' . (($action == 'new') ? 'insert' : 'update') . '&eid=' . $eid . ($confirmation_needed ? '&amp;confirm=yes' : ''), 'post', 'enctype="multipart/form-data"');
	  ?>
      <table border="0" width="90%" class="formArea">
        <tr>
          <td width="25"></td>
          <td colspan="2"></td>
          <td align="left" width="300"><?php echo ENTRY_ACTIVE; ?></td>
        </tr>
      <?php
      for ($i=0, $n=sizeof($languages); $i<$n; $i++) { ?>
        <tr>
          <td width="25"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?></td>
          <td width="90"><?php echo $languages[$i]['name']; ?></td>
          <td><?php echo ENTRY_LABEL . tep_draw_input_field('label_' . $languages[$i]['id'], $epf_label[$languages[$i]['id']]['epf_label'], "size=64 maxlength=64"); ?></td>
          <td><?php echo tep_draw_radio_field('langactive_' . $languages[$i]['id'], '1', true, $epf_label[$languages[$i]['id']]['epf_active_for_language']) . '&nbsp;' . TEXT_YES . '&nbsp;' . tep_draw_radio_field('langactive_' . $languages[$i]['id'], '0', false, $epf_label[$languages[$i]['id']]['epf_active_for_language']) . '&nbsp;' . TEXT_NO; ?></td>
        </tr>
      <?php } ?>
	    <tr>
          <td><?php echo '<span title="' . ENTRY_ALL_CATEGORIES . '|' . TEXT_ALL_CATEGORIES_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></span></td>
          <td colspan="2"><?php echo ENTRY_ALL_CATEGORIES; ?></td>
          <td><?php echo tep_draw_radio_field('all_cats', '1', true, $field['epf_all_categories'], ' id="all_cats_1"') . '&nbsp;' . TEXT_YES . '&nbsp;' . tep_draw_radio_field('all_cats', '0', false, $field['epf_all_categories'], ' id="all_cats_0"') . '&nbsp;' . TEXT_NO; ?></td>
        </tr>
	    <tr id="all_cats_row">
          <td valign=top></td><td colspan="2"><?php echo ENTRY_CHECK_CATEGORIES; ?></td>
          <td valign="top">
          <?php
            foreach ($categories as $category) {
              echo tep_draw_checkbox_field('usecat' . $category['id'], $category['id'], in_array($category['id'], $applicable_cats)) . $category['text'] . "<br />\n";
            } ?>
          </td>
        </tr>
	    <tr>
          <td><?php echo '<span title="' . ENTRY_ACTIVATE_NOW . '|' . TEXT_ACTIVATE_NOW_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></span></td>
          <td colspan="2"><?php echo ENTRY_ACTIVATE_NOW; ?></td>
          <td><?php echo tep_draw_radio_field('status', '1', true, $field['epf_status']) . '&nbsp;' . TEXT_YES . '&nbsp;' . tep_draw_radio_field('status', '0', false, $field['epf_status']) . '&nbsp;' . TEXT_NO; ?></td>
        </tr>
        <tr>
          <td><?php echo '<span title="' . ENTRY_SHOW_ADMIN . '|' . TEXT_SHOW_ADMIN_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></span></td>
          <td colspan="2"><?php echo ENTRY_SHOW_ADMIN; ?></td>
          <td><?php echo tep_draw_radio_field('show_admin', '1', true, $field['epf_show_in_admin']) . '&nbsp;' . TEXT_YES . '&nbsp;' . tep_draw_radio_field('show_admin', '0', false, $field['epf_show_in_admin']) . '&nbsp;' . TEXT_NO; ?></td>
        </tr>
        <tr>
          <td></td>
          <td colspan="2"><?php echo ENTRY_ORDER; ?></td>
          <td><?php echo tep_draw_input_field('sort_order', $field['epf_order']); ?></td>
        </tr>
        <tr>
          <td><?php echo '<span title="' . ENTRY_SEARCH . '|' . TEXT_SEARCH_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></span></td>
          <td colspan="2"><?php echo ENTRY_SEARCH; ?></td>
          <td><?php echo tep_draw_radio_field('search', '1', true, $field['epf_advanced_search']) . '&nbsp;' . TEXT_YES . '&nbsp;' . tep_draw_radio_field('search', '0', false, $field['epf_advanced_search']) . '&nbsp;' . TEXT_NO; ?></td>
        </tr>
        <tr>
          <td><?php echo '<span title="' . ENTRY_LISTING . '|' . TEXT_LISTING_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></span></td>
          <td colspan="2"><?php echo ENTRY_LISTING; ?></td>
          <td><?php echo tep_draw_radio_field('listing', '1', false, $field['epf_show_in_listing']) . '&nbsp;' . TEXT_YES . '&nbsp;' . tep_draw_radio_field('listing', '0', true, $field['epf_show_in_listing']) . '&nbsp;' . TEXT_NO; ?></td>
        </tr>
	
	  <?php
      // echo '<p>' . ENTRY_META . tep_draw_radio_field('meta', '1', false, $field['epf_use_as_meta_keyword']) . '&nbsp;' . TEXT_YES . '&nbsp;' . tep_draw_radio_field('meta', '0', false, $field['epf_use_as_meta_keyword']) . '&nbsp;' . TEXT_NO . "</p>\n";
      if (($action == 'new') || (!$field['epf_uses_value_list'] && !$field['epf_textarea'])) { ?>
		<tr>
          <td></td>
          <td colspan=2><?php echo ENTRY_SIZE; ?></td>
          <td><?php echo tep_draw_input_field('size', $field['epf_size']); ?></td>
        </tr>
      <?php  
	  } // end (($action == 'new') || (!$field['epf_uses_value_list'] && !$field['epf_textarea']))
      if ($action == 'new') { ?>
        <tr>
          <td><?php echo '<span title="' . ENTRY_TEXT_ENTRY . '|' . TEXT_TEXT_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></span></td>
          <td colspan="2"><?php echo ENTRY_TEXT_ENTRY; ?></td>
          <td><?php echo tep_draw_radio_field('text_entry', '0', true) . '&nbsp;' . TEXT_SINGLE_LINE . '&nbsp;' . tep_draw_radio_field('text_entry', '1', false) . '&nbsp;' . TEXT_MULTILINE; ?>&nbsp;<?php echo '<span title="' . TEXT_MULTILINE . '|' . TEXT_LIST_IGNORES . '<br><br>' . TEXT_TEXTAREA_NOTE . '">' . tep_image(DIR_WS_ICONS . 'information.png', ''); ?></span></td>
        </tr>
        <tr>
          <td><?php echo '<span title="' . ENTRY_VALUE_LIST . '|' . TEXT_VALUE_LIST_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></span></td>
          <td colspan="2"><?php echo ENTRY_VALUE_LIST; ?></td>
          <td><?php echo tep_draw_radio_field('value_list', '1', true, ' id="value_list"') . '&nbsp;' . TEXT_YES . '&nbsp;' . tep_draw_radio_field('value_list', '0', false, ' id="value_list"') . '&nbsp;' . TEXT_NO; ?>&nbsp;<?php echo '<span title="' . ENTRY_VALUE_LIST . '|' . TEXT_VALUE_LIST_WARNING . '">' . tep_image(DIR_WS_ICONS . 'exclamation.png', ''); ?></span></td>
        </tr>
      </table>
      <table border="0" width="90%" class="formArea" id="value_list">
        <tr>
          <td colspan="4"><b><?php echo TEXT_APPLIES_LIST_ONLY; ?></b></td>
        </tr>
        <tr>
          <td width="25"><?php echo '<span title="' . ENTRY_LIST_TYPE . '|' . TEXT_LIST_TYPE_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></span></td>
          <td colspan="2"><?php echo ENTRY_LIST_TYPE; ?></td>
          <td width="300"><?php echo tep_draw_radio_field('list_type', '0', true, $field['epf_multi_select'], ' id="list_type"') . '&nbsp;' . TEXT_SINGLE_VALUE . '&nbsp;' . tep_draw_radio_field('list_type', '1', false, $field['epf_multi_select'], ' id="list_type"') . '&nbsp;' . TEXT_MULTIPLE_VALUE; ?>&nbsp;<?php echo '<span title="' . ENTRY_LIST_TYPE . '|' . TEXT_LIST_TYPE_WARNING . '">' . tep_image(DIR_WS_ICONS . 'exclamation.png', ''); ?></span></td>
        </tr>
      <?php
      } // end if ($action == 'new')
      if (($action == 'new') || ($field['epf_uses_value_list'] && !$field['epf_multi_select'])) { ?>
        <tr id="single_value1">
          <td><?php echo '<span title="' . ENTRY_CHAIN . '|' . TEXT_CHAIN_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></td>
          <td colspan="2"><?php echo ENTRY_CHAIN; ?></td>
          <td><?php echo tep_draw_radio_field('chain', '1', true, $field['epf_show_parent_chain']) . '&nbsp;' . TEXT_YES . '&nbsp;' . tep_draw_radio_field('chain', '0', false, $field['epf_show_parent_chain']) . '&nbsp;' . TEXT_NO; ?></td>
        </tr>
        <tr id="single_value2">
          <td><?php echo '<span title="' . ENTRY_RESTRICT . '|' . TEXT_RESTRICT_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></td>
          <td colspan="2"><?php echo ENTRY_RESTRICT; ?></td>
          <td><?php echo tep_draw_radio_field('restrict', '1', true, $field['epf_use_to_restrict_listings']) . '&nbsp;' . TEXT_YES . '&nbsp;' . tep_draw_radio_field('restrict', '0', false, $field['epf_use_to_restrict_listings']) . '&nbsp;' . TEXT_NO; ?></td>
        </tr>
        <tr id="single_value3">
          <td><?php echo '<span title="' . ENTRY_SEARCH_BOX . '|' . TEXT_SEARCH_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></td>
          <td colspan="2"><?php echo ENTRY_SEARCH_BOX; ?></td>
          <td><?php echo tep_draw_radio_field('quicksearch', '1', false, $field['epf_quick_search']) . '&nbsp;' . TEXT_YES . '&nbsp;' . tep_draw_radio_field('quicksearch', '0', true, $field['epf_quick_search']) . '&nbsp;' . TEXT_NO; ?></td>
        </tr>
        <tr id="single_value4">
          <td><?php echo '<span title="' . ENTRY_CHECKBOX . '|' . TEXT_CHECKBOX_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></td>
          <td colspan="2"><?php echo ENTRY_CHECKBOX; ?></td>
          <td><?php echo tep_draw_radio_field('checkboxes', '0', true, $field['epf_checked_entry']) . '&nbsp;' . TEXT_DROPDOWN . '&nbsp;' . tep_draw_radio_field('checkboxes', '1', false, $field['epf_checked_entry']) . '&nbsp;' . TEXT_RADIO; ?><?php if ($action == 'new') { ?>&nbsp;<?php echo '<span title="' . ENTRY_CHECKBOX . '|' . TEXT_MS_CHECKBOX_NOTE . '">' . tep_image(DIR_WS_ICONS . 'information.png', ''); ?></span><?php } ?></td>
        </tr>
      <?php
      } // end if (($action == 'new') || ($field['epf_uses_value_list'] && !$field['epf_multi_select']))
      if (($action == 'new') || ($field['epf_uses_value_list'])) { ?>
        <tr>
          <td><?php echo '<span title="' . ENTRY_COLUMNS . '|' . TEXT_COLUMNS_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></td>
          <td colspan="2"><?php echo ENTRY_COLUMNS; ?></td>
          <td><?php echo tep_draw_input_field('columns', $field['epf_num_columns']); ?></td>
        </tr>
        <tr>
          <td valign=top></td>
          <td colspan="4"><?php echo ENTRY_DISPLAY_TYPE; ?></td>
        </tr>
        <tr>
          <td valign=top></td>
          <td colspan="4" align="center">
            <table border=0 width="80%">
              <tr valign="top">
                <td width="33%" align="center">
                  <table border="1" class="main">
                    <tr>
                      <td align="center"><?php echo TEXT_TEXT; ?></td>
                    </tr>
                    <tr>
                      <td><?php echo TEXT_SAMPLE; ?></td>
                    </tr>
                    <tr>
                      <td align="center"><?php echo tep_draw_radio_field('display_type', '0', true, $field['epf_value_display_type']); ?></td>
                    </tr>
                  </table>
                </td>
                <td width="33%" align="center">
                  <table border="1" class="main">
                    <tr>
                      <td align="center"><?php echo TEXT_IMAGE; ?></td>
                    </tr>
                    <tr>
                      <td align="center"><?php echo tep_image(DIR_WS_ICONS . 'default.png', TEXT_SAMPLE); ?></td>
                    </tr>
                    <tr>
                      <td align="center"><?php echo tep_draw_radio_field('display_type', '1', false, $field['epf_value_display_type']); ?></td>
                    </tr>
                  </table>
                </td>      
                <td width="33%" align="center">
                  <table border="1" class="main">
                    <tr>
                      <td align="center"><?php echo TEXT_IMAGE_TEXT; ?></td>
                    </tr>
                    <tr>
                    <tr>
                      <td align=center><?php echo tep_image(DIR_WS_ICONS . 'default.png', TEXT_SAMPLE) . '<br>' . TEXT_SAMPLE; ?></td>
                    </tr>
                    <tr>
                      <td align="center">&nbsp;<?php echo tep_draw_radio_field('display_type', '2', false, $field['epf_value_display_type']); ?></td>
                    </tr>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      <?php } // end if (($action == 'new') || ($field['epf_uses_value_list'])) ?>
      <table width="90%">
        <tr>
          <td align="right" class="smallText"><?php echo tep_draw_button(IMAGE_SAVE, 'disk', null, 'primary') . tep_draw_button(IMAGE_CANCEL, 'close', tep_href_link(FILENAME_EXTRA_FIELDS, 'eid=' . $eid), 'primary'); ?></td>
        </tr>
      </table>
      </form>
    </td>
  </tr>
      <?php } elseif ($action == 'delete') { // Confirm deletion of field
        echo '<tr><td><p class="pageHeading">' . HEADING_DELETE . $eid . "</p>\n";
        $query = tep_db_query("select epf_uses_value_list, epf_multi_select, epf_has_linked_field from " . TABLE_EPF . " where epf_id = " . (int)$eid);
        $field_info = tep_db_fetch_array($query); // retrieve field type
        $field = 'extra_value';
        if ($field_info['epf_uses_value_list']) {
          if ($field_info['epf_multi_select']) {
            $field .= '_ms';
          } else {
            $field .= '_id';
          }
        }
        $field .= $eid;
        $used = 0;
        for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
          $label_query = tep_db_query("select * from " . TABLE_EPF_LABELS . " where epf_id = " . (int)$eid . " and languages_id = " . (int)$languages[$i]['id']);
          $label = tep_db_fetch_array($label_query);
          $check_query = tep_db_query("select count(products_id) as total from " . TABLE_PRODUCTS_DESCRIPTION . " where language_id = " . (int)$languages[$i]['id'] . " and " . (($field_info['epf_uses_value_list'] && !$field_info['epf_multi_select']) ? $field . " > 0" : "length(" . $field . ") > 0"));
          $check = tep_db_fetch_array($check_query);
          $used += $check['total']; // total how many descriptions use this field
          echo '<p>' . sprintf(TEXT_FIELD_DATA, $languages[$i]['name'], $label['epf_label'], $check['total']) . "</p>\n";
        }
        if ($double_check == 'no') {
          echo '<p>' . TEXT_ARE_SURE . ($field_info['epf_uses_value_list'] ? TEXT_VALUES_GONE : '') . ($field_info['epf_has_linked_field'] ? TEXT_LINKS_DESTROYED : '') . "</p>\n";
          echo '<p>' . tep_draw_form('yes', FILENAME_EXTRA_FIELDS, 'confirm=yes&amp;action=delete&eid=' . $eid . '&used=' . $used) . tep_draw_input_field('yes', TEXT_YES, 'alt="' . TEXT_YES . '"', false, 'submit') . '</form>&nbsp;&nbsp;';
          echo tep_draw_form('no', FILENAME_EXTRA_FIELDS, 'eid=' . $eid) . tep_draw_input_field('no', TEXT_NO, 'alt="' . TEXT_NO . '"', false, 'submit') . "</form></p>\n";
        } else {
          echo '<p><b>' . TEXT_CONFIRM_DELETE . ($field_info['epf_uses_value_list'] ? TEXT_VALUES_GONE : '') . ($field_info['epf_has_linked_field'] ? TEXT_LINKS_DESTROYED : '') . "</b></p>\n";
          echo '<p>' . tep_draw_form('yes', FILENAME_EXTRA_FIELDS, 'confirm=yes&amp;action=delete&eid=' . $eid) . tep_draw_input_field('yes', TEXT_YES, 'alt="' . TEXT_YES . '"', false, 'submit') . '</form>&nbsp;&nbsp;';
          echo tep_draw_form('no', FILENAME_EXTRA_FIELDS, 'eid=' . $eid) . tep_draw_input_field('no', TEXT_NO, 'alt="' . TEXT_NO . '"', false, 'submit') . "</form></p>\n";
        }
        echo "</td></tr>\n";
      } elseif ($action == 'link') { // get field to link to
        $error = false;
        $messages = array();
        echo '<tr><td><p class="pageHeading">' . BUTTON_LINK . "</p>\n";
        echo TABLE_HEADING_ID . $eid . "<br>\n";
        $query = tep_db_query("select * from " . TABLE_EPF . ' where epf_id = ' . (int)$eid);
        $field_info = tep_db_fetch_array($query);
        if ($field_info === false) {
          $error = true;
          $messages[] = ERROR_NO_FIELD;
        }
		
        $label_query = tep_db_query("select languages_id, epf_label from " . TABLE_EPF_LABELS . " where (epf_id = " . (int)$eid . ") and epf_active_for_language");
        $eid_active_languages = array();
        while ($label = tep_db_fetch_array($label_query)) {
          $eid_active_languages[] = $label['languages_id'];
          echo tep_image(DIR_WS_CATALOG_LANGUAGES . $lang[$label['languages_id']]['directory'] . '/images/' . $lang[$label['languages_id']]['image'], $lang[$label['languages_id']]['name']) . '&nbsp;' . $label['epf_label'] . '<br>';
        }
		
        if (empty($eid_active_languages)) {
          $error = true;
          $messages[] = ERROR_NO_FIELD;
        }
		
        echo '<p>' . tep_draw_form('link_fields', FILENAME_EXTRA_FIELDS, 'confirm=yes&amp;action=link');
        echo tep_draw_hidden_field('epf_id', $eid) . '<b>' . TEXT_SELECT_LINK . "</b></p>\n";
        ?>
        <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ID; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_LABEL; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_SELECT; ?></td>
              </tr>
        <?php
        $field_query = tep_db_query("select * from " . TABLE_EPF . ' where epf_uses_value_list and !epf_has_linked_field and epf_multi_select = ' . ($field_info['epf_multi_select'] ? '0' : '1') . " order by epf_order");
        $any_matching_languages = false;
        while ($epf = tep_db_fetch_array($field_query)) {
          $this_matches_languages = false;
        ?>
              <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
                <td class="dataTableContent"><?php echo $epf['epf_id']; ?></td>
                <td class="dataTableContent">
                <?php $label_query = tep_db_query("select languages_id, epf_label from " . TABLE_EPF_LABELS . " where (epf_id = " . (int)$epf['epf_id'] . ") and epf_active_for_language");
                while ($label = tep_db_fetch_array($label_query)) {
                  if (in_array($label['languages_id'], $eid_active_languages)) {
                    $any_matching_languages = true;
                    $this_matches_languages = true;
                    echo '* ';
                  } // end if 
                  echo tep_image(DIR_WS_CATALOG_LANGUAGES . $lang[$label['languages_id']]['directory'] . '/images/' . $lang[$label['languages_id']]['image'], $lang[$label['languages_id']]['name']) . '&nbsp;' . $label['epf_label'] . '<br>';
                } // end while
                ?>
                </td>
                <td class="dataTableContent" align="center">
<?php
                if ($this_matches_languages) {
                  echo tep_draw_radio_field('link_to', $epf['epf_id']);
                } else {
                  echo TEXT_NOT_LINKABLE;
                } // end if ($this_matches_languages)
?>
                </td>
              </tr>
              
<?php
        } // end while
?>
            </table>
<?php
        if (!$any_matching_languages) {
          $error = true;
          $messages[] = ERROR_NONE_LINKABLE;
        }
        if ($error) {
          if (!empty($messages)) {
            echo '<table class="messageStackError" width="100%">' . "\n";
            foreach ($messages as $message) {
              echo '<tr><td>' . $message . "</td></tr>\n";
            }
            echo "</table>\n";
          }
        } else {
          echo '<p>' . tep_draw_input_field('', BUTTON_CREATE_LINK, 'alt="' . BUTTON_CREATE_LINK . '"', false, 'submit') . '&nbsp;&nbsp;';
        }
        echo '<a href="' . tep_href_link(FILENAME_EXTRA_FIELDS, 'eid=' . $eid) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . "</a>\n" . "</form></p>\n";
        echo "</td></tr>\n";
      } elseif ($action == 'unlink') { // Confirm field unlink
        $query = tep_db_query("select * from " . TABLE_EPF . " where epf_id = " . (int)$eid);
        $field_info = tep_db_fetch_array($query);
        echo '<tr><td><p class="pageHeading">' . sprintf(HEADING_UNLINK, $eid, $field_info['epf_links_to']) . "</p>\n";
        $used = 0;
        if (!$field_info['epf_has_linked_field'] || ($field_info['epf_links_to'] == 0)) {
          $messageStack->add_session(ERROR_NOT_LINKED, 'error');
          tep_redirect(tep_href_link(FILENAME_EXTRA_FIELDS, 'eid=' . $eid));
        }
        if ($field_info['epf_multi_select']) {
          $check_query = tep_db_query('select count(value_id) as total from ' . TABLE_EPF_VALUES . ' where value_depends_on != 0 and epf_id =' . (int)$eid);
        } else {
          $check_query = tep_db_query('select count(value_id) as total from ' . TABLE_EPF_VALUES . ' where value_depends_on != 0 and epf_id =' . (int)$field_info['epf_links_to']);
        }
        $check = tep_db_fetch_array($check_query);
        $used = $check['total']; // how many values are linked
        echo '<p>' . sprintf(TEXT_NUM_LINKED, $used) . "</p>\n";
        if ($double_check == 'no') {
          echo '<p>' . TEXT_SURE_UNLINK . (($used > 0) ? TEXT_LINKS_GONE : '') . "</p>\n";
          echo '<p>' . tep_draw_form('yes', FILENAME_EXTRA_FIELDS, 'confirm=yes&amp;action=unlink&amp;eid=' . $eid . '&amp;used=' . $used) . tep_draw_input_field('yes', TEXT_YES, 'alt="' . TEXT_YES . '"', false, 'submit') . '</form>&nbsp;&nbsp;';
          echo tep_draw_form('no', FILENAME_EXTRA_FIELDS, 'eid=' . $eid) . tep_draw_input_field('no', TEXT_NO, 'alt="' . TEXT_NO . '"', false, 'submit') . "</form></p>\n";
        } else {
          echo '<p><b>' . TEXT_CONFIRM_UNLINK . "</b></p>\n";
          echo '<p>' . tep_draw_form('yes', FILENAME_EXTRA_FIELDS, 'confirm=yes&amp;action=unlink&amp;eid=' . $eid) . tep_draw_input_field('yes', TEXT_YES, 'alt="' . TEXT_YES . '"', false, 'submit') . '</form>&nbsp;&nbsp;';
          echo tep_draw_form('no', FILENAME_EXTRA_FIELDS, 'eid=' . $eid) . tep_draw_input_field('no', TEXT_NO, 'alt="' . TEXT_NO . '"', false, 'submit') . "</form></p>\n";
        }
        echo "</td></tr>\n";
      } else { /* display list of fields */?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ID; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_LABEL; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ORDER; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_STATUS; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php
$field_query = tep_db_query("select * from " . TABLE_EPF . " order by epf_order");
$selected_labels = array();
while ($epf = tep_db_fetch_array($field_query)) {
  if ($eid == '') $eid = $epf['epf_id'];
  if ($epf['epf_id'] == $eid) {
    echo '              <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_EXTRA_FIELDS, 'eid=' . $eid . '&amp;action=edit') . '\'">' . "\n";
    $selected = $epf;
  } else {
    echo '              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_EXTRA_FIELDS, 'eid=' . $epf['epf_id']) . '\'">' . "\n";
  }
?>
                <td class="dataTableContent"><?php echo $epf['epf_id']; ?></td>
                <td class="dataTableContent">
                <?php $label_query = tep_db_query("select languages_id, epf_label from " . TABLE_EPF_LABELS . " where (epf_id = " . (int)$epf['epf_id'] . ") and epf_active_for_language");
                while ($label = tep_db_fetch_array($label_query)) {
                  if ($epf['epf_id'] == $eid) $selected_labels[] = $label;
                  echo tep_image(DIR_WS_CATALOG_LANGUAGES . $lang[$label['languages_id']]['directory'] . '/images/' . $lang[$label['languages_id']]['image'], $lang[$label['languages_id']]['name']) . '&nbsp;' . $label['epf_label'] . '<br>';
                }
                ?>
                </td>
                <td class="dataTableContent" align="right"><?php echo $epf['epf_order']; ?></td>
                <td class="dataTableContent" align="center">
<?php
      if ($epf['epf_status'] == '1') {
        echo tep_image(DIR_WS_ICONS . 'icon_status_green.gif', IMAGE_ICON_STATUS_GREEN, 10, 10) . '&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_EXTRA_FIELDS, 'action=setflag&amp;flag=0&amp;eid=' . $epf['epf_id']) . '">' . tep_image(DIR_WS_ICONS . 'icon_status_red_light.gif', IMAGE_ICON_STATUS_RED_LIGHT, 10, 10) . '</a>';
      } else {
        echo '<a href="' . tep_href_link(FILENAME_EXTRA_FIELDS, 'action=setflag&amp;flag=1&amp;eid=' . $epf['epf_id']) . '">' . tep_image(DIR_WS_ICONS . 'icon_status_green_light.gif', IMAGE_ICON_STATUS_GREEN_LIGHT, 10, 10) . '</a>&nbsp;&nbsp;' . tep_image(DIR_WS_ICONS . 'icon_status_red.gif', IMAGE_ICON_STATUS_RED, 10, 10);
      }
?>
                </td>
                <td class="dataTableContent" align="right"><?php if ($epf['epf_id'] == $eid) { echo tep_image(DIR_WS_ICONS . 'icon_arrow_right.gif'); } else { echo '<a href="' . tep_href_link(FILENAME_EXTRA_FIELDS, 'eid=' . $epf['epf_id']) . '">' . tep_image(DIR_WS_ICONS . 'information.png', '') . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php
}
		if (($action != 'new') && ($action != 'edit')) { ?>
              <tr>
                <td colspan="5" align="right" class="smallText"><?php echo tep_draw_form('new_field', FILENAME_EXTRA_FIELDS, 'action=new') . tep_draw_button(BUTTON_NEW, 'plus', null, 'primary'); ?></form></td>
              </tr>
          <?php } ?>
            </table>
          </td>
<?php // build information box contents
  $heading = array();
  $contents = array();
  if (isset($selected)) {
    $heading[] = array('text' => TABLE_HEADING_ID . ' ' . $selected['epf_id']);
    foreach ($selected_labels as $label) {
     // $heading[] = array('text' => $lang[$label['languages_id']]['name'] . ': ' . $label['epf_label']);
      if ($label['languages_id'] == $languages_id) $admin_language = $languages_id;
    }
    $contents[] = array('align' => 'center', 'text' => tep_draw_button(IMAGE_EDIT, 'document', tep_href_link(FILENAME_EXTRA_FIELDS, 'eid=' . $eid . '&amp;action=edit'),'primary') . tep_draw_button(IMAGE_DELETE, 'trash', tep_href_link(FILENAME_EXTRA_FIELDS, 'eid=' . $eid . '&amp;action=delete'), 'primary'));
    if ($selected['epf_uses_value_list']) {
      $contents[] = array('align' => 'center', 'text' => tep_draw_form('edit_values', FILENAME_EXTRA_VALUES, 'list_id=' . $selected['epf_id'] . '_' . $admin_language) . tep_draw_input_field('edit_values', BUTTON_EDIT_VALUES, 'alt="' . BUTTON_EDIT_VALUES . '"', false, 'submit') . '</form>');
    }
    if ($selected['epf_has_linked_field']) {
      $contents[] = array('align' => 'center', 'text' => tep_draw_form('unlink', FILENAME_EXTRA_FIELDS, 'eid=' . $eid . '&amp;action=unlink') . tep_draw_input_field('unlink', BUTTON_UNLINK, 'alt="' . BUTTON_UNLINK . '"', false, 'submit') . '</form>');
    } elseif ($selected['epf_uses_value_list']) { // check to see if a field link can be made before displaying button
      $query = tep_db_query('select count(epf_id) as total from ' . TABLE_EPF . ' where epf_uses_value_list and !epf_has_linked_field and epf_multi_select = ' . ($selected['epf_multi_select'] ? '0' : '1'));
      $check = tep_db_fetch_array($query);
      if ($check['total'] > 0) {
        $contents[] = array('align' => 'center', 'text' => tep_draw_form('link', FILENAME_EXTRA_FIELDS, 'eid=' . $eid . '&amp;action=link') . tep_draw_input_field('link', BUTTON_LINK, 'alt="' . BUTTON_LINK . '"', false, 'submit') . '</form>');      
      }
    }
    $contents[] = array('text' => TABLE_HEADING_STATUS . ': ' . ($selected['epf_status'] ? TEXT_ENABLED : TEXT_DISABLED));
    $contents[] = array('text' => TEXT_ADMIN_AVAILABLE . ': ' . (($selected['epf_status'] || $selected['epf_show_in_admin']) ? TEXT_ENABLED : TEXT_DISABLED));
    $contents[] = array('text' => ENTRY_ORDER . $selected['epf_order']);
    if (!$selected['epf_uses_value_list'] && !$selected['epf_textarea']) $contents[] = array('text' => TEXT_SIZE . $selected['epf_size']);
    $contents[] = array('text' => TEXT_SEARCHABLE . ($selected['epf_advanced_search'] ? TEXT_YES : TEXT_NO));
    $contents[] = array('text' => ENTRY_LISTING . ($selected['epf_show_in_listing'] ? TEXT_YES : TEXT_NO));
    $contents[] = array('text' => TEXT_META . ($selected['epf_use_as_meta_keyword'] ? TEXT_YES : TEXT_NO));   
    $contents[] = array('text' => ENTRY_VALUE_LIST . ($selected['epf_uses_value_list'] ? TEXT_YES : TEXT_NO)); 
    if ($selected['epf_uses_value_list']) {
      $contents[] = array('text' => TEXT_USER_SELECTS . ($selected['epf_multi_select'] ? TEXT_MULTIPLE_VALUE : TEXT_SINGLE_VALUE)); 
      $contents[] = array('text' => TEXT_SELECTED_BY . ($selected['epf_multi_select'] ? ($selected['epf_checked_entry'] ? TEXT_CHECKBOX : TEXT_DROPDOWN) : ($selected['epf_checked_entry'] ? TEXT_RADIO : TEXT_DROPDOWN))); 
      $contents[] = array('text' => TEXT_RESTRICTS . ($selected['epf_use_to_restrict_listings'] ? TEXT_YES : TEXT_NO)); 
      $contents[] = array('text' => TEXT_SHOW_PARENTS . ($selected['epf_show_parent_chain'] ? TEXT_YES : TEXT_NO)); 
      $contents[] = array('text' => TEXT_SEARCH_BOX . ($selected['epf_quick_search'] ? TEXT_YES : TEXT_NO)); 
      $contents[] = array('text' => TEXT_COLUMNS . $selected['epf_num_columns']);
    }
    $display = TEXT_TEXT;
    if ($selected['epf_uses_value_list']) {
      if ($selected['epf_value_display_type'] == 2) {
        $display = TEXT_IMAGE_TEXT;
      } elseif ($selected['epf_value_display_type'] == 1) {
        $display = TEXT_IMAGE;
      }
    } else {
      $contents[] = array('text' => ENTRY_TEXT_ENTRY . ($selected['epf_textarea'] ? TEXT_MULTILINE : TEXT_SINGLE_LINE));      
    }
    $contents[] = array('text' => TEXT_DISPLAY_TYPE . $display);
    if ($selected['epf_has_linked_field']) {
      $contents[] = array('text' => TEXT_LINKED_TO . $selected['epf_links_to']);
    }
  }
// display information box if it exists
  if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";
    $box = new box;
    echo $box->infoBox($heading, $contents);
    echo '            </td>' . "\n";
  } else {
	$heading[] = array('text' => HEADING_NO_EPF);
    $contents[] = array('text' => TEXT_NO_EPF);  
	  
	echo '            <td width="25%" valign="top">';
	$box = new box;
    echo $box->infoBox($heading, $contents);
    echo '            </td>';  
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
