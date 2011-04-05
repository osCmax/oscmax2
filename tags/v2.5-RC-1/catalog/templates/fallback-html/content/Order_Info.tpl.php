<?php
/*
$Id: Order_Info.tpl.php 1026 2011-01-07 18:18:43Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<!-- body_text //-->

    <form name="account_edit" method="post" <?php echo 'action="' .
tep_href_link('Order_Info_Process.php', '', 'SSL')
. '"'; ?> onSubmit="return check_form(this);"><input type="hidden" name="action" value="process"><table border="0" width="75%" cellspacing="0" cellpadding="0" align="center">
      <tr>
        <td><table border="0" width="75%" cellspacing="0" cellpadding="0">
          <!--tr>
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
          </tr//-->
        </table></td>
      </tr>
<?php
  if (sizeof($navigation->snapshot) > 0) {
?>
      <tr>
        <td class="smallText"><br><?php echo sprintf(TEXT_ORIGIN_LOGIN, tep_href_link(FILENAME_LOGIN, tep_get_all_get_params(), 'SSL')); ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td>
<?php
  $email_address = tep_db_prepare_input($_GET['email_address']);
  $account['entry_country_id'] = STORE_COUNTRY;

  require(DIR_WS_MODULES . 'Order_Info_Check.php');
?>
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
        <td align="right" class="main"><br><?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></form>
<!-- body_text_eof //-->