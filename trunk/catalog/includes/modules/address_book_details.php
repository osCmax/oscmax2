<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  if (!isset($process)) $process = false;
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td class="main"><b><?php echo NEW_ADDRESS_TITLE; ?></b></td>
        <td class="inputRequirement" align="right"><?php echo FORM_REQUIRED_INFORMATION; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
      <tr class="infoBoxContents">
        <td><table border="0" cellspacing="2" cellpadding="2">
<?php
  if (ACCOUNT_GENDER == 'true') {
    $male = $female = false;
    if (isset($gender)) {
      $male = ($gender == 'm') ? true : false;
      $female = !$male;
    } elseif (isset($entry['entry_gender'])) {
      $male = ($entry['entry_gender'] == 'm') ? true : false;
      $female = !$male;
    }
?>
          <tr>
            <td class="main"><?php echo ENTRY_GENDER; ?></td>
            <td class="main"><?php echo tep_draw_radio_field('gender', 'm', $male) . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . tep_draw_radio_field('gender', 'f', $female) . '&nbsp;&nbsp;' . FEMALE . '&nbsp;' . (tep_not_null(ENTRY_GENDER_TEXT) ? '<span class="inputRequirement">' . ENTRY_GENDER_TEXT . '</span>': ''); ?></td>
          </tr>
<?php
  }
?>
          <tr>
            <td class="main" width="100"><?php echo ENTRY_FIRST_NAME; ?></td>
            <td class="main"><?php echo tep_draw_input_field('firstname', isset($entry['entry_firstname']) ? $entry['entry_firstname'] : '') . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_LAST_NAME; ?></td>
            <td class="main"><?php echo tep_draw_input_field('lastname', isset($entry['entry_lastname']) ? $entry['entry_lastname'] : '') . '&nbsp;' . (tep_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?></td>
          </tr>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
<?php
  if (ACCOUNT_COMPANY == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_COMPANY; ?></td>
            <td class="main"><?php echo tep_draw_input_field('company', isset($entry['entry_company']) ? $entry['entry_company'] : '') . '&nbsp;' . (tep_not_null(ENTRY_COMPANY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?></td>
          </tr>
<?php // BOF: MOD - Separate Pricing Per Customer
   if (tep_not_null($entry['entry_company_tax_id'])) {
   ?>
          <tr>
            <td class="main"><?php echo ENTRY_COMPANY_TAX_ID; ?></td>
            <td class="main"><?php echo $entry['entry_company_tax_id'] ; ?></td>
          </tr>
 <?php
   } else { // end if (tep_not_null($entry['entry_company_tax_id'])) 
 ?>       <tr>
            <td class="main"><?php echo ENTRY_COMPANY_TAX_ID; ?></td>
            <td class="main"><?php echo tep_draw_input_field('company_tax_id') . '&nbsp;' . (tep_not_null(ENTRY_COMPANY_TAX_ID_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TAX_ID_TEXT . '</span>': ''); ?></td>
          </tr>
 <?php
   } // end else 
// EOF: MOD - Separate Pricing Per Customer
?>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
<?php
  }
?>
          <tr>
            <td class="main"><?php echo ENTRY_STREET_ADDRESS; ?></td>
            <td class="main"><?php echo tep_draw_input_field('street_address', isset($entry['entry_street_address']) ? $entry['entry_street_address'] : '') . '&nbsp;' . (tep_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?></td>
          </tr>
<?php
  if (ACCOUNT_SUBURB == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_SUBURB; ?></td>
            <td class="main"><?php echo tep_draw_input_field('suburb', isset($entry['entry_suburb']) ? $entry['entry_suburb'] : '') . '&nbsp;' . (tep_not_null(ENTRY_SUBURB_TEXT) ? '<span class="inputRequirement">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?></td>
          </tr>
<?php
  }
?>
          <tr>
            <td class="main"><?php echo ENTRY_POST_CODE; ?></td>
            <td class="main"><?php echo tep_draw_input_field('postcode', isset($entry['entry_postcode']) ? $entry['entry_postcode'] : '') . '&nbsp;' . (tep_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="inputRequirement">' . ENTRY_POST_CODE_TEXT . '</span>': ''); ?></td>
          </tr>
          <tr>
            <td class="main"><?php echo ENTRY_CITY; ?></td>
            <td class="main"><?php echo tep_draw_input_field('city', isset($entry['entry_city']) ? $entry['entry_city'] : '') . '&nbsp;' . (tep_not_null(ENTRY_CITY_TEXT) ? '<span class="inputRequirement">' . ENTRY_CITY_TEXT . '</span>': ''); ?></td>
          </tr>
<?php
  if (ACCOUNT_STATE == 'true') {
?>
          <tr>
            <td class="main"><?php echo ENTRY_STATE; ?></td>
            <td class="main">
                <div id="states">
				<?php
				// +Country-State Selector
				echo ajax_get_zones_html($entry['entry_country_id'], ((isset($entry['entry_zone_id']) && $entry['entry_zone_id'] != 0) ? $entry['entry_zone_id'] : 0), false);
				// -Country-State Selector
				?>
				</div>
            </td>
          </tr>
<?php
  }
?>
          <tr>
            <td class="main"><?php echo ENTRY_COUNTRY; ?><div id="indicator"><?php echo tep_image(DIR_WS_ICONS . 'ajax-loader.gif'); ?></div></td>
			<?php // +Country-State Selector ?>
            <td class="main"><?php echo tep_get_country_list('country', $entry['entry_country_id'],'onChange="getStates(this.value,\'states\');"') . '&nbsp;' . (tep_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COUNTRY_TEXT . '</span>': ''); ?></td>
            <?php // -Country-State Selector ?>
          </tr>
<?php
  if ((isset($_GET['edit']) && ($customer_default_address_id != $_GET['edit'])) || (isset($_GET['edit']) == false) ) {
?>
          <tr>
            <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
            <td colspan="2" class="main"><?php echo tep_draw_checkbox_field('primary', 'on', false, 'id="primary"') . ' ' . SET_AS_PRIMARY; ?></td>
          </tr>
<?php
  }
?>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
