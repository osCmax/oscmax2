<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
       echo tep_draw_form('advanced_search', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get', 'onSubmit="return check_form(this);"') . tep_hide_session_id(); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '4'); ?></td>
      </tr>
	  <tr>
        <td class="productinfo_header"><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo HEADING_TITLE_1; ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  if ($messageStack->size('search') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('search'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td height="14"><?php echo tep_image(bts_select('images', 'infobox/top_left.png')); ?></td>
            <td width="100%" height="14" class="infoBoxHeading">&nbsp;<?php echo HEADING_SEARCH_CRITERIA; ?></td>
            <td height="14" nowrap><?php echo tep_image(bts_select('images', 'infobox/top_right.png')); ?></td>
          </tr>
        </table>
        <table border="0" width="100%" cellspacing="0" cellpadding="1" class="infoBox">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="3" class="infoBoxContents">
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '1'); ?></td>
              </tr>
              <tr>
                <td class="boxText" align="center"><?php echo tep_draw_input_field('keywords', '', 'style="width: 80%"'); ?></td>
              </tr>
              <tr>
                <td class="boxText" align="center"><?php echo tep_draw_checkbox_field('search_in_description', '1') . ' ' . TEXT_SEARCH_IN_DESCRIPTION; ?></td>
              </tr>
              <tr>
                <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo '<a href="javascript:popupWindow(\'' . tep_href_link(FILENAME_POPUP_SEARCH_HELP) . '\')">' . TEXT_SEARCH_HELP_LINK . '</a>'; ?></td>
            <td class="smallText" align="right"><?php echo tep_image_submit('button_search.gif', IMAGE_BUTTON_SEARCH); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="120"></td>
                <td class="fieldKey"><?php echo TEXT_OPTIONAL; ?></td>
              </tr>
              <tr>
                <td class="fieldKey"><?php echo ENTRY_CATEGORIES; ?></td>
                <td class="fieldValue"><?php echo tep_draw_pull_down_menu('categories_id', tep_get_categories(array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES)))); ?></td>
              </tr>
              <tr>
                <td class="fieldKey">&nbsp;</td>
                <td class="smallText"><?php echo tep_draw_checkbox_field('inc_subcat', '1', true) . ' ' . ENTRY_INCLUDE_SUBCATEGORIES; ?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
              </tr>
              <tr>
                <td class="fieldKey"><?php echo ENTRY_MANUFACTURERS; ?></td>
                <td class="fieldValue"><?php echo tep_draw_pull_down_menu('manufacturers_id', tep_get_manufacturers(array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS)))); ?></td>
              </tr>
<?php
// begin Extra Product Fields
    foreach ($epf as $e) {
?>
              <tr>
                <td class="fieldKey"><?php echo $e['label']; ?></td>
                <td class="fieldValue">
                <?php if ($e['uses_list']) {
                  $epf_values = tep_build_epf_pulldown($e['id'], $languages_id);
                  if ($e['multi_select']) { // multi-select field
                    echo TEXT_FOR_FIELD . tep_draw_radio_field('match' . $e['id'], 'any', true) . TEXT_MATCH_ANY . tep_draw_radio_field('match' . $e['id'], 'all') . TEXT_MATCH_ALL . '</td></tr><tr><td class="fieldKey">' . $e['label'] . '</td><td class="fieldValue">';
                    $col = 0;
                    echo '<table><tr>';
                    foreach ($epf_values as $value) {
                      $col++;
                      if ($col > $e['columns']) {
                        echo '</tr><tr>';
                        $col = 1;
                      }
                      echo '<td>' . tep_draw_checkbox_field($e['field'] . '[]', $value['id'], false, 'id="' . $value['id'] . '"') . '</td><td>' . tep_get_extra_field_list_value($value['id'], false, $e['display_type']) . '<td><td>&nbsp;</td>';
                    }
                    echo '</tr></table>';
                  } else { // single select field
                    $epf_values = array_merge( array(array('id' => '', 'text' => TEXT_ANY_VALUE)), $epf_values);
                    if ($e['use_checkbox']) {
                      $col = 0;
                      echo '<table><tr>';
                      foreach ($epf_values as $value) {
                        $col++;
                        if ($col > $e['columns']) {
                          echo '</tr><tr>';
                          $col = 1;
                        }
                        echo '<td>' . tep_draw_radio_field($e['field'], $value['id'], $value['id'] == '', 'id="' . $e['field'] . '_' . $value['id'] . '"') . '</td><td>' . ($value['id'] == '' ? TEXT_ANY_VALUE : tep_get_extra_field_list_value($value['id'], false, $e['display_type'])) . '<td><td>&nbsp;</td>';
                      }
                      echo '</tr></table>';
                    } else {
                      echo tep_draw_pull_down_menu($e['field'], $epf_values);
                    }
                  }
                } else { // text field
                  echo tep_draw_input_field($e['field'], '', 'style="width: 300px"');
                } ?>
                </td>
              </tr>
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_silver.gif', '100%', '1'); ?></td>
              </tr>
<?php
} 
// end Extra Product Fields
?>           
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
              </tr>
              <tr>
                <td class="fieldKey"><?php echo ENTRY_PRICE_FROM; ?></td>
                <td class="fieldValue"><?php echo tep_draw_input_field('pfrom'); ?></td>
              </tr>
              <tr>
                <td class="fieldKey"><?php echo ENTRY_PRICE_TO; ?></td>
                <td class="fieldValue"><?php echo tep_draw_input_field('pto'); ?></td>
              </tr>
              <tr>
                <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
              </tr>
              <tr>
                <td class="fieldKey"><?php echo ENTRY_DATE_FROM; ?></td>
                <td class="fieldValue"><?php echo tep_draw_input_field('dfrom', '') . '&nbsp;(' . DOB_FORMAT_STRING . ')'; ?></td>
              </tr>
              <tr>
                <td class="fieldKey"><?php echo ENTRY_DATE_TO; ?></td>
                <td class="fieldValue"><?php echo tep_draw_input_field('dto','') . '&nbsp;(' . DOB_FORMAT_STRING . ')'; ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></form>
