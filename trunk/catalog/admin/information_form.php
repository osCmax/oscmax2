<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<table>
<tr>
	<td class="pageHeading"><?php echo tep_output_string($title); ?></td>
</tr>
<tr>
	<td>

<table border="0" cellpadding="0" cellspacing="2" width="100%">
<?php
if(!strstr($info_group['locked'], 'visible')) {
?>
	<tr>
		<td class="main"><?php echo ENTRY_STATUS; ?></td>
		<td class="main"><?php echo tep_draw_radio_field('visible', '1', true, $edit['visible']) . '&nbsp;&nbsp;' . STATUS_ACTIVE . '&nbsp;&nbsp;' . tep_draw_radio_field('visible', '0', false, $edit['visible']) . '&nbsp;&nbsp;' . STATUS_INACTIVE; ?></td>
	</tr>
	<tr>
		<td colspan="2" height="10"></td>
	</tr>
<?php
}

if(!strstr($info_group['locked'], 'show_in_infobox')) {
?>
	<tr>
		<td class="main"><?php echo PUBLIC_INFORMATION; ?></td>
		<td class="main"><?php echo tep_draw_radio_field('show_in_infobox', '1', true, $edit['show_in_infobox']) . '&nbsp;&nbsp;' . STATUS_ACTIVE . '&nbsp;&nbsp;' . tep_draw_radio_field('show_in_infobox', '0', false, $edit['show_in_infobox']) . '&nbsp;&nbsp;' . STATUS_INACTIVE; ?></td>
	</tr>
	<tr>
		<td colspan="2" height="10"></td>
	</tr>
<?php
}

if(!strstr($info_group['locked'], 'parent_id')) {
?>
	<tr>
		<td class="main"><?php echo ENTRY_PARENT_PAGE; ?></td>
		<td class="main">
<?php
  if ((sizeof($data) > 0) ) {
	$options = '<option value="0">-</option>';
	reset($data);
	while (list($key, $val) = each($data)) {
		$selected = ($val['information_id'] == $edit['parent_id']) ? 'selected' : '';
		$options .= '<option value="' . $val['information_id'] . '" ' . $selected . '>' . $val['information_title'] . '</option>';
	}
	echo '<select name="parent_id">' . $options . '</select>';
  } else {
  	echo '<span class="messageStackError">' . WARNING_PARENT_PAGE .'</span>';
  }
?>
		</td>
	</tr>
	<tr>
		<td colspan="2" height="10"></td>
	</tr>
<?php
}

if(!strstr($info_group['locked'], 'sort_order')) {
?>
	<tr>
		<td class="main"><?php echo ENTRY_SORT_ORDER;?></td>
		<td><?php if ($edit[sort_order]) {$no=$edit[sort_order];}; echo tep_draw_input_field('sort_order', "$no", 'size=3 maxlength=4'); ?></td>
	</tr>
	<tr>
		<td colspan="2" height="10"></td>
	</tr>
<?php
}

if(!strstr($info_group['locked'], 'information_url')) {
?>
	<tr>
		<td class="main"><?php echo ENTRY_URL;?>&nbsp;<?php echo '<span title="' . HEADING_URL_HELP . '|' . TEXT_URL_HELP . '">' . tep_image(DIR_WS_ICONS . 'help.png', IMAGE_ICON_INFO); ?></span></td>
		<td><?php if ($edit[information_url]) {$url=$edit[information_url];}; echo tep_draw_input_field('information_url', "$url", 'size=70'); ?></td>
	</tr>
	<tr>
		<td colspn="2" height="10" class="smallText" style="color: #bbbbbb"><?php echo TEXT_INCLUDE_HTTP; ?></td>
	</tr>
<?php
}

if(!strstr($info_group['locked'], 'information_target')) {
?>
	<tr>
		<td class="main"><?php echo ENTRY_TARGET; ?></td>
		<td class="main"><?php echo tep_draw_radio_field('information_target', '_top', true, $edit['information_target']) . '&nbsp;&nbsp;' . TARGET_TOP . '&nbsp;&nbsp;' . tep_draw_radio_field('information_target', '_blank', false, $edit['information_target']) . '&nbsp;&nbsp;' . TARGET_BLANK; ?></td>
	</tr>
	<tr>
		<td colspan="2" height="10"></td>
	</tr>
<?php
}
?>
    <tr>
      <td colspan="2">
        <div id="informationtabs">
	      <ul>
<?php	
    for ($i=0, $n=sizeof($languages); $i<$n; $i++) {
?>
            <li><a href="#informationtabs-<?php echo $i; ?>"><?php echo tep_image(DIR_WS_CATALOG_LANGUAGES . $languages[$i]['directory'] . '/images/' . $languages[$i]['image'], $languages[$i]['name']); ?></a></li>
<?php
    } // end for
?>
          </ul>
<?php
    for ($j=0, $n=sizeof($languages); $j<$n; $j++) {
?>
	  
          <div id="informationtabs-<?php echo $j; ?>">
		    <table width="100%">
              <?php if(!strstr($info_group['locked'], 'information_title')) { ?>
              <tr>
                <td class="main"><?php echo ENTRY_TITLE . tep_draw_input_field('information_title[' . $languages[$j]['id'] . ']', (($languages[$j]['id'] == $languages_id) ? stripslashes($edit[information_title]) : tep_get_information_entry($information_id, $languages[$j]['id'], 'information_title')), 'size=40 maxlength=255'); ?></td>
              </tr>
              <?php } // end if ?>

              <tr>
                <td class="main" width="100%"><?php echo tep_draw_textarea_field('information_description[' . $languages[$j]['id'] . ']', '100', '20', (($languages[$j]['id'] == $languages_id) ? stripslashes($edit[information_description]) : tep_get_information_entry($information_id, $languages[$j]['id'], 'information_description')),'id="information_description' . $languages[$j]['id'] . '" class="ckeditor"'); ?></td>
              </tr>
            </table>
          </div>
<?php           
	} // end for
?>
        </div>
      </td>
    </tr>
	<tr>
		<td colspan="2" align="right"><?php
				// Decide when to show the buttons (Determine or 'locked' is active)
				if( (empty($info_group['locked'])) || ($_GET['information_action'] == 'Edit')) {
					echo tep_image_submit('button_insert.gif', IMAGE_INSERT);
				}
				echo '&nbsp;<a href="' . tep_href_link(FILENAME_INFORMATION_MANAGER, "gID=" . $gID, 'NONSSL') . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>';
			?></td>
	</tr>
</table>


	</td>
</tr>
</table>
</form>