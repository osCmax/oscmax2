<?php
/*
$Id: create_account.tpl.php 1987 2013-07-29 07:57:31Z cottonbarn $

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>

<!-- reCAPTCHA - start -->
<?php if (RECAPTCHA_ON == 'true' && RECAPTCHA_CREATE_ACCOUNT == 'true') { ?>
<script type="text/javascript">
var RecaptchaOptions = { theme : '<?php echo RECAPTCHA_STYLE; ?>', tabindex : 3, lang : '<?php echo in_array($code, array('en', 'fr', 'de', 'es')) ? $code : 'en' ?>' };
</script>
<?php } ?>
<!-- reCAPTCHA - end -->

<?php 
if ($messageStack->size('create_account') > 0) {
  echo $messageStack->output('create_account');
}
?>

<div class="row">
  <p class="col-xs-12"><?php echo sprintf(TEXT_ORIGIN_LOGIN, tep_href_link(FILENAME_LOGIN, tep_get_all_get_params(), 'SSL')); ?></p>
</div>


    <!-- PWA BOF -->
    <?php echo tep_draw_form('create_account', tep_href_link(FILENAME_CREATE_ACCOUNT, (isset($_GET['guest'])? 'guest=guest':''), 'SSL'), 'post', 'onSubmit="return check_form(create_account);" class="form-horizontal"') . tep_draw_hidden_field('action', 'process'); ?><table border="0" width="100%" cellspacing="0" cellpadding="0">
    <!-- PWA EOF -->
    
    <div class="panel panel-default">     
     <div class="panel-heading">
	   <h3 class="panel-title">
	   <?php
            if (!isset($_GET['guest']) && !isset($_POST['guest'])) {
              echo HEADING_TITLE;
            } else {
              echo HEADING_TITLE_PWA;
			}
       ?>
       <span class="inputRequirement pull-right"><?php echo FORM_REQUIRED_INFORMATION; ?></span>
       </h3>
     </div>


     <div class="panel-body">

       <div class="contentContainer">
	   <legend><?php echo CATEGORY_PERSONAL; ?></legend>	
       
  		 <div class="contentText">
  
<?php
  if (ACCOUNT_GENDER == 'true') {
?>
              <div class="form-group">
      			<label class="control-label col-xs-2"><?php echo ENTRY_GENDER; ?></label>
      			<div class="col-xs-10">
        		  <label class="checkbox-inline">
          		    <?php echo tep_draw_radio_field('gender', 'm', 1) . ' ' . MALE; ?>
        		  </label>
        		  <label class="checkbox-inline">
          		    <?php echo tep_draw_radio_field('gender', 'f') . ' ' . FEMALE; ?>
        		  </label>
        		</div>
    		  </div>
<?php
  }
?>
			<div class="form-group has-feedback <?php echo (ENTRY_FIRST_NAME_TEXT == "*" ? "required" : ""); ?>">
              <label for="inputFirstName" class="control-label col-xs-2"><?php echo ENTRY_FIRST_NAME; ?></label>
              <div class="col-xs-10">
                <?php
                echo tep_draw_input_field('firstname', NULL, 'required aria-required="true" id="inputFirstName" placeholder="' . ENTRY_FIRST_NAME . '"');
                ?>
              </div>
            </div>
            <div class="form-group has-feedback <?php echo (ENTRY_LAST_NAME_TEXT == "*" ? "required" : ""); ?>">
              <label for="inputLastName" class="control-label col-xs-2"><?php echo ENTRY_LAST_NAME; ?></label>
              <div class="col-xs-10">
                <?php
                echo tep_draw_input_field('lastname', NULL, 'required aria-required="true" id="inputLastName" placeholder="' . ENTRY_LAST_NAME . '"');
                ?>
              </div>
            </div>
<?php
  if (ACCOUNT_DOB == 'true') {
?>
            <div class="form-group has-feedback">
              <label for="inputName" class="control-label col-xs-2"><?php echo ENTRY_DATE_OF_BIRTH; ?></label>
              <div class="col-xs-10">
                <?php
                echo tep_draw_input_field('dob', tep_date_short($account['customers_dob']), 'required aria-required="true" id="dob" placeholder="' . ENTRY_DATE_OF_BIRTH . '"');
                
                if (tep_not_null(ENTRY_DATE_OF_BIRTH_TEXT)) echo '<span class="help-block">' . ENTRY_DATE_OF_BIRTH_TEXT . '</span>';
                ?>
              </div>
              <script>
			  $('#dob').datepicker({
				dateFormat: '<?php echo JQUERY_DATEPICKER_FORMAT; ?>',
				viewMode: 2
			  });
			  </script>
            </div>
<?php
  }
?>
            <div class="form-group has-feedback <?php echo (ENTRY_EMAIL_ADDRESS_TEXT == "*" ? "required" : ""); ?>">
              <label for="inputEmail" class="control-label col-xs-2"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
              <div class="col-xs-10">
                <?php
                echo tep_draw_input_field('email_address', NULL, 'required aria-required="true" id="inputEmail" placeholder="' . ENTRY_EMAIL_ADDRESS . '"');
                ?>
              </div>
            </div>

       
<?php if (ACCOUNT_EMAIL_CONFIRMATION == 'true') { ?>
            <div class="form-group has-feedback <?php echo (ENTRY_EMAIL_CONFIRMATION_TEXT == "*" ? "required" : ""); ?>">
              <label for="inputEmailConfirmation" class="control-label col-xs-2"><?php echo ENTRY_EMAIL_CONFIRMATION; ?></label>
              <div class="col-xs-10">
                <?php
                echo tep_draw_input_field('email_confirmation', NULL, 'required aria-required="true" id="inputEmailConfirmation" placeholder="' . ENTRY_EMAIL_ADDRESS . '"');
                ?>
              </div>
            </div>
<?php } ?>
</div>

<?php
if (ACCOUNT_COMPANY == 'true') {
?>

  <legend><?php echo CATEGORY_COMPANY; ?></legend>
  
  <div class="contentText">
    <div class="form-group">
      <label for="inputCompany" class="control-label col-xs-2"><?php echo ENTRY_COMPANY; ?></label>
      <div class="col-xs-10">
        <?php
        echo tep_draw_input_field('company', NULL, 'id="inputCompany" placeholder="' . ENTRY_COMPANY . '"');
        ?>
      </div>
    </div>
    <div class="form-group">
      <label for="inputCompanyTaxID" class="control-label col-xs-2"><?php echo ENTRY_COMPANY; ?></label>
      <div class="col-xs-10">
        <?php
        echo tep_draw_input_field('company_tax_id', NULL, 'id="inputCompanyTaxID" placeholder="' . ENTRY_COMPANY_TAX_ID . '"');
        ?>
      </div>
    </div>
  </div>

<?php
  }
?>

      <legend><?php echo CATEGORY_ADDRESS; ?></legend>
      
      <div class="form-group has-feedback">
              <label for="inputCountry" class="control-label col-xs-2"><?php echo ENTRY_COUNTRY; ?></label>
              <div class="col-xs-10">
                <?php
                echo tep_get_country_list('country', $country, 'onChange="getStates(this.value, \'states\');" required aria-required="true" id="inputCountry"');
                if (tep_not_null(ENTRY_COUNTRY_TEXT)) echo '<span class="help-block">' . ENTRY_COUNTRY_TEXT . '</span>';
                ?>
              </div>
            </div>
      
      <div class="contentText">
        <div class="form-group has-feedback">
          <label for="inputStreet" class="control-label col-xs-2"><?php echo ENTRY_STREET_ADDRESS; ?></label>
          <div class="col-xs-10">
            <?php
            echo tep_draw_input_field('street_address', NULL, 'required aria-required="true" id="inputStreet" placeholder="' . ENTRY_STREET_ADDRESS . '"');
            ?>
          </div>
        </div>
        
<?php
  if (ACCOUNT_SUBURB == 'true') {
?>
        <div class="form-group">
        <label for="inputSuburb" class="control-label col-xs-2"><?php echo ENTRY_SUBURB; ?></label>
          <div class="col-xs-10">
            <?php
            echo tep_draw_input_field('suburb', NULL, 'id="inputSuburb" placeholder="' . ENTRY_SUBURB . '"');
            ?>
          </div>
        </div>
<?php
  }
?>
        <div class="form-group has-feedback">
          <label for="inputCity" class="control-label col-xs-2"><?php echo ENTRY_CITY; ?></label>
          <div class="col-xs-10">
            <?php
            echo tep_draw_input_field('city', NULL, 'required aria-required="true" id="inputCity" placeholder="' . ENTRY_CITY. '"');
            ?>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label for="inputZip" class="control-label col-xs-2"><?php echo ENTRY_POST_CODE; ?></label>
          <div class="col-xs-10">
            <?php
            echo tep_draw_input_field('postcode', NULL, 'required aria-required="true" id="inputZip" placeholder="' . ENTRY_POST_CODE . '"');
            ?>
         </div>
        </div>
    
<?php
  if (ACCOUNT_STATE == 'true') {
?>
              <div class="form-group has-feedback">
      			<label for="inputState" class="control-label col-xs-2"><?php echo ENTRY_STATE; ?></label>
      			<div class="col-xs-10">
                  <div id="states">
<?php
				  // +Country-State Selector
				  echo ajax_get_zones_html($country,'',false);
				  // -Country-State Selector
				  ?>
                  </div>
                </div>
              </div>
<?php
  }
?>
            
            
      </div>

      
      
      <!-- // BOF Customers extra fields -->
      <?php echo tep_get_extra_fields($customer_id, $languages_id, $customer_group_id);?>
      <!-- // EOF Customers extra fields -->

<?php
// PWA BOF
  if (!isset($_GET['guest']) && !isset($_POST['guest'])) {
// PWA EOF
?>
      <legend><?php echo CATEGORY_CONTACT; ?></legend>
  
  <div class="contentText">
    <div class="form-group has-feedback">
      <label for="inputTelephone" class="control-label col-xs-2"><?php echo ENTRY_TELEPHONE_NUMBER; ?></label>
      <div class="col-xs-10">
        <?php
        echo tep_draw_input_field('telephone', NULL, 'required aria-required="true" id="inputTelephone" placeholder="' . ENTRY_TELEPHONE_NUMBER . '"');
        ?>
      </div>
    </div>
    <div class="form-group">
      <label for="inputFax" class="control-label col-xs-2"><?php echo ENTRY_FAX_NUMBER; ?></label>
      <div class="col-xs-10">
        <?php
        echo tep_draw_input_field('fax', $account['customers_fax'], 'id="inputFax" placeholder="' . ENTRY_FAX_NUMBER . '"');
        ?>
      </div>
    </div>
  </div>
    
    <legend><?php echo CATEGORY_OPTIONS; ?></legend>
  
    	<div class="contentText">
            <div class="form-group">
              <label for="inputNewsletter" class="control-label col-xs-2"><?php echo ENTRY_NEWSLETTER; ?></label>
              <div class="col-xs-10">
                <div class="checkbox-inline">
                  <label>
                    <?php
                    echo tep_draw_checkbox_field('newsletter', '1', NULL, 'id="inputNewsletter"');
                    ?>
                  </label>
                </div>
              </div>
            </div>
    		  <div class="form-group">
      			<label class="control-label col-xs-2"><?php echo ENTRY_NEWSLETTER; ?></label>
      			<div class="col-xs-10">
        		  <label class="checkbox-inline">
          		    <?php echo tep_draw_radio_field('EMAILTYPE', 'html', true) . '&nbsp;&nbsp;' . MAILCHIMP_HTML ; ?>
        		  </label>
        		  <label class="checkbox-inline">
          		    <?php echo tep_draw_radio_field('EMAILTYPE', 'text', false) . '&nbsp;&nbsp;' . MAILCHIMP_TEXT; ?>
        		  </label>
        		  </div>
    		  </div>  
        </div>   
      
      
  <legend><?php echo CATEGORY_PASSWORD; ?></legend>
  
  <div class="contentText">
    <div class="form-group has-feedback">
      <label for="inputPassword" class="control-label col-xs-2"><?php echo ENTRY_PASSWORD; ?></label>
      <div class="col-xs-10">
        <?php
        echo tep_draw_password_field('password', NULL, 'required aria-required="true" id="inputPassword" placeholder="' . ENTRY_PASSWORD . '"');
        ?>
      </div>
    </div>
    <div class="form-group has-feedback">
      <label for="inputConfirmation" class="control-label col-xs-2"><?php echo ENTRY_PASSWORD_CONFIRMATION; ?></label>
      <div class="col-xs-10">
        <?php
        echo tep_draw_password_field('confirmation', NULL, 'required aria-required="true" id="inputConfirmation" placeholder="' . ENTRY_PASSWORD_CONFIRMATION . '"');
        ?>
      </div>
    </div>
  </div>
  
<?php
  // PWA BOF
  }
  else
  { // Ingo PWA Ende
    echo tep_draw_hidden_field('guest', 'guest');
  } 
// PWA EOF
?>

<!-- reCAPTCHA - start -->
<?php if (RECAPTCHA_ON == 'true' && RECAPTCHA_CREATE_ACCOUNT == 'true') { ?>
      
      <legend><?php echo CATEGORY_RECAPTCHA; ?></legend>
      
      <div class="form-group has-feedback">
          <label for="inputRecaptcha" class="control-label col-xs-2"><?php echo ENTRY_RECAPTCHA; ?></label>
          <div class="col-xs-10">
            <?php echo recaptcha_get_html(RECAPTCHA_PUBLIC_KEY); ?>
          </div>
        </div>
        
<?php } ?>
<!-- reCAPTCHA - end -->
</div>
</div>
</div>
<?php if (MAT == 'true') { ?>

	<div class="alert alert-warning clearfix" role="alert" id="MATtd">
    	<?php echo tep_draw_checkbox_field('MAT','true', false, 'id="MAT" onClick="javascript:switchMAT()"'); ?> <?php echo TERMS_PART_1; ?> 
              <a id="conditions" href="<?php echo $HTTP_SERVER . DIR_WS_CATALOG . 'conditions.php?info_id=11&amp;languages_id=' . (isset($languages_id) ? $languages_id : '1'); ?>"><?php echo TERMS_PART_2; ?>
    
                      <div id="enableMAT" class="clearfix">
            			<span class="pull-right" ><?php echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'glyphicon-user', null, 'primary'); ?></span>
                      </div>
                      
                      <div id="disableMAT" class="clearfix">
            			<span class="pull-right" ><?php echo tep_draw_button('Please accept terms', 'glyphicon-warning-sign', 'javascript:warnMAT()' , null, array('type' => 'button'), 'btn-warning pull-right'); ?></span>
          			  </div>
                      
      
	</div>
      
<?php } else { ?>

      <div class="buttonSet">
        <span class="buttonAction"><?php echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'glyphicon-user', null, 'primary'); ?></span>
  	  </div>
<?php } // end MAT if ?>  
   
  </div>
  </div> 
  </div>
  
</form>