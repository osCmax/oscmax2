<?php
/*
$Id: password_forgotten.tpl.php 1987 2013-07-29 07:57:31Z cottonbarn $

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

    echo tep_draw_form('password_forgotten', tep_href_link(FILENAME_PASSWORD_FORGOTTEN, 'action=process', 'SSL'), 'post', 'class="form-horizontal"', true); ?>

<?php
  if ($messageStack->size('password_forgotten') > 0) {
    echo $messageStack->output('password_forgotten');
  }
?>
        
  <div class="panel panel-default">     
    <div class="panel-heading">
	  <h3 class="panel-title"><?php echo HEADING_TITLE; ?></h3>
    </div>

    <div class="panel-body">
      <div class="contentContainer">
        <div class="contentText">
          <div class="alert alert-info"><?php echo TEXT_MAIN; ?></div>
    
            <div class="form-group has-feedback">
            <label for="inputEmail" class="control-label col-xs-3"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
              <div class="col-xs-9">
              <?php echo tep_draw_input_field('email_address', NULL, 'required aria-required="true" autofocus="autofocus" id="inputEmail" placeholder="' . ENTRY_EMAIL_ADDRESS . '"'); ?>
              <?php echo FORM_REQUIRED_INPUT; ?>
              </div>
            </div>
          </div>
    
          <div class="buttonSet">
            <?php echo tep_draw_button(IMAGE_BUTTON_BACK, 'glyphicon-chevron-left', tep_href_link(FILENAME_LOGIN, '', 'SSL')); ?>
            <span class="buttonAction pull-right"><?php echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'glyphicon-chevron-right', null, 'primary'); ?></span>
          </div>
          
        </div>
      </div>
    </div>
  </div>
</form>