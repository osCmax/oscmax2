
    <!-- PWA BOF -->
    <?php echo tep_draw_form('create_account', tep_href_link(FILENAME_CREATE_ACCOUNT, (isset($_GET['guest'])? 'guest=guest':''), 'SSL'), 'post', 'onSubmit="return check_form(create_account);"') . tep_draw_hidden_field('action', 'process'); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
    <!-- PWA EOF -->
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <?php
            // PWA BOF
            if (!isset($_GET['guest']) && !isset($_POST['guest'])){
            ?>
              <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <?php }else{ ?>
              <td class="pageHeading"><?php echo HEADING_TITLE_PWA; ?></td>
            <?php }
            // PWA EOF 
            ?>
            <td class="pageHeading" align="right">&nbsp;</td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="smallText"><br><?php echo sprintf(TEXT_ORIGIN_LOGIN, tep_href_link(FILENAME_LOGIN, tep_get_all_get_params(), 'SSL')); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  if ($messageStack->size('create_account') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('create_account'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><b><?php echo CATEGORY_PERSONAL; ?></b></td>
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
?>
              <tr>
                <td class="main"  width="150"><?php echo ENTRY_GENDER; ?></td>
                <td class="main"><?php echo tep_draw_radio_field('gender', 'm') . '&nbsp;&nbsp;' . MALE . '&nbsp;&nbsp;' . tep_draw_radio_field('gender', 'f') . '&nbsp;&nbsp;' . FEMALE . '&nbsp;' . (tep_not_null(ENTRY_GENDER_TEXT) ? '<span class="inputRequirement">' . ENTRY_GENDER_TEXT . '</span>': ''); ?></td>
              </tr>
<?php
  }
?>
              <tr>
                <td class="main" width="150"><?php echo ENTRY_FIRST_NAME; ?></td>
                <td class="main"><?php echo tep_draw_input_field('firstname') . '&nbsp;' . (tep_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?></td>
              </tr>
              <tr>
                <td class="main" width="150"><?php echo ENTRY_LAST_NAME; ?></td>
                <td class="main"><?php echo tep_draw_input_field('lastname') . '&nbsp;' . (tep_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="inputRequirement">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?></td>
              </tr>
<?php
  if (ACCOUNT_DOB == 'true') {
?>
              <tr>
                <td class="main" width="150"><?php echo ENTRY_DATE_OF_BIRTH; ?></td>
                <td class="main"><?php echo tep_draw_input_field('dob') . '&nbsp;' . (tep_not_null(ENTRY_DATE_OF_BIRTH_TEXT) ? '<span class="inputRequirement">' . ENTRY_DATE_OF_BIRTH_TEXT . '</span>': ''); ?></td>
              </tr>
<?php
  }
?>
              <tr>
                <td class="main" width="150"><?php echo ENTRY_EMAIL_ADDRESS; ?></td>
                <td class="main"><?php echo tep_draw_input_field('email_address') . '&nbsp;' . (tep_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
  if (ACCOUNT_COMPANY == 'true') {
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo CATEGORY_COMPANY; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td class="main" width="150"><?php echo ENTRY_COMPANY; ?></td>
                <td class="main"><?php echo tep_draw_input_field('company') . '&nbsp;' . (tep_not_null(ENTRY_COMPANY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TEXT . '</span>': ''); ?></td>
              </tr>
<!-- BOF Separate Pricing Per Customer: field for tax id number -->
              <tr>
                <td class="main" width="150"><?php echo ENTRY_COMPANY_TAX_ID; ?></td>
                <td class="main"><?php echo tep_draw_input_field('company_tax_id') . '&nbsp;' . (tep_not_null(ENTRY_COMPANY_TAX_ID_TEXT) ? '<span class="inputRequirement">' . ENTRY_COMPANY_TAX_ID_TEXT . '</span>': ''); ?></td>
              </tr>
<!-- EOF Separate Pricing Per Customer: field for tax id number -->
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo CATEGORY_ADDRESS; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td class="main" width="150"><?php echo ENTRY_STREET_ADDRESS; ?></td>
                <td class="main"><?php echo tep_draw_input_field('street_address') . '&nbsp;' . (tep_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="inputRequirement">' . ENTRY_STREET_ADDRESS_TEXT . '</span>': ''); ?></td>
              </tr>
<?php
  if (ACCOUNT_SUBURB == 'true') {
?>
              <tr>
                <td class="main" width="150"><?php echo ENTRY_SUBURB; ?></td>
                <td class="main"><?php echo tep_draw_input_field('suburb') . '&nbsp;' . (tep_not_null(ENTRY_SUBURB_TEXT) ? '<span class="inputRequirement">' . ENTRY_SUBURB_TEXT . '</span>': ''); ?></td>
              </tr>
<?php
  }
?>
              <tr>
                <td class="main" width="150"><?php echo ENTRY_POST_CODE; ?></td>
                <td class="main"><?php echo tep_draw_input_field('postcode') . '&nbsp;' . (tep_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="inputRequirement">' . ENTRY_POST_CODE_TEXT . '</span>': ''); ?></td>
              </tr>
              <tr>
                <td class="main" width="150"><?php echo ENTRY_CITY; ?></td>
                <td class="main"><?php echo tep_draw_input_field('city') . '&nbsp;' . (tep_not_null(ENTRY_CITY_TEXT) ? '<span class="inputRequirement">' . ENTRY_CITY_TEXT . '</span>': ''); ?></td>
              </tr>
<?php
  if (ACCOUNT_STATE == 'true') {
?>
              <tr>
                <td class="main" width="150"><?php echo ENTRY_STATE; ?></td>
                      <td class="main"><div id="states">
<?php
				// +Country-State Selector
				echo ajax_get_zones_html($country,'',false);
				// -Country-State Selector
				?>
                        </div></td>
              </tr>
<?php
  }
?>
              <tr>
                <td class="main" width="150"><?php echo ENTRY_COUNTRY; ?><span id="indicator"><?php echo tep_image(DIR_WS_IMAGES . 'ajax-loader.gif'); ?></span></td>
				<?php // +Country-State Selector ?>
                <td class="main"><?php echo tep_get_country_list('country',$country,'onChange="getStates(this.value, \'states\');"') . '&nbsp;' . (tep_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="inputRequirement">' . ENTRY_COUNTRY_TEXT . '</span>': ''); ?></td>
				<?php // -Country-State Selector ?>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo CATEGORY_CONTACT; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td class="main" width="150"><?php echo ENTRY_TELEPHONE_NUMBER; ?></td>
                <td class="main"><?php echo tep_draw_input_field('telephone') . '&nbsp;' . (tep_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_TELEPHONE_NUMBER_TEXT . '</span>': ''); ?></td>
              </tr>
              <tr>
                <td class="main" width="150"><?php echo ENTRY_FAX_NUMBER; ?></td>
                <td class="main"><?php echo tep_draw_input_field('fax') . '&nbsp;' . (tep_not_null(ENTRY_FAX_NUMBER_TEXT) ? '<span class="inputRequirement">' . ENTRY_FAX_NUMBER_TEXT . '</span>': ''); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
// PWA BOF
  if (!isset($_GET['guest']) && !isset($_POST['guest'])) {
// PWA EOF
?>
      <tr>
        <td class="main"><b><?php echo CATEGORY_OPTIONS; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td class="main" width="150"><?php echo ENTRY_NEWSLETTER; ?></td>
                <td class="main"><?php echo tep_draw_checkbox_field('newsletter', '1') . '&nbsp;' . (tep_not_null(ENTRY_NEWSLETTER_TEXT) ? '<span class="inputRequirement">' . ENTRY_NEWSLETTER_TEXT . '</span>': ''); ?></td>
              </tr>
              <tr>
                <td class="main"><?php echo ENTRY_NEWSLETTER_TYPE; ?></td>
                <td class="main"><?php echo tep_draw_radio_field('EMAILTYPE', 'html', true) . '&nbsp;&nbsp;' . MAILCHIMP_HTML . '&nbsp;&nbsp;' . tep_draw_radio_field('EMAILTYPE', 'text', false) . '&nbsp;&nbsp;' . MAILCHIMP_TEXT; ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="main"><b><?php echo CATEGORY_PASSWORD; ?></b></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td class="main" width="150"><?php echo ENTRY_PASSWORD; ?></td>
                <td class="main"><?php echo tep_draw_password_field_st('password') . '&nbsp;' . (tep_not_null(ENTRY_PASSWORD_TEXT) ? '<span class="inputRequirement">' . ENTRY_PASSWORD_TEXT . '</span>': ''); ?>
</td>
              </tr>
              <tr>
                <td class="main" width="150"><?php echo ENTRY_PASSWORD_CONFIRMATION; ?></td>
                <td class="main"><?php echo tep_draw_password_field('confirmation') . '&nbsp;' . (tep_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT) ? '<span class="inputRequirement">' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '</span>': ''); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
  // PWA BOF
  }
  else
  { // Ingo PWA Ende
?>
 <tr>
   <td><?php echo tep_draw_hidden_field('guest', 'guest'); ?></td>
 </tr>
<?php } 
// PWA EOF
?>
<?php if (MAT == 'true') { ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="1" cellpadding="2">
            <tr>
              <td id="MATtd" class="messageStackAlert" align="center"><?php echo tep_draw_checkbox_field('MAT','true', false, 'id="MAT" onClick="javascript:switchMAT()"'); ?><?php echo TERMS_PART_1 . '<a href="' . tep_href_link(FILENAME_CONDITIONS) . '">' . TERMS_PART_2 . '</a>';?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td align="right">
                  <span id="enableMAT"><?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></span>
                  <span id="disableMAT" style="cursor: pointer;"><?php echo tep_image_button('button_MAT.gif', IMAGE_BUTTON_MAT, ' onClick="javascript:warnMAT()"'); ?></span>
                </td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      
<?php } else { ?>

      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td align="right"><?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php } // end MAT if ?>     
    </table>
</form>