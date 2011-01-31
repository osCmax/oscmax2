<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
    echo tep_draw_form('login', tep_href_link(FILENAME_LOGIN, 'action=process', 'SSL')); ?>
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
              <td class="pageHeading" align="right">&nbsp;</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  if (isset($_GET['gv_message'])) {
?>      
      <tr>
        <td class="messageStackAlert"><?php echo tep_image(DIR_WS_ICONS . 'warning.gif', ICON_WARNING) . '&nbsp;' . TEXT_GV_LOGIN_NEEDED; ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>

<?php
  if ($messageStack->size('login') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('login'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }

  if ($cart->count_contents() > 0) {
?>
      <tr>
        <td class="smallText"><?php echo TEXT_VISITORS_CART; ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  }
?>
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="2">

<?php
  // PWA BOF
  if (defined('PURCHASE_WITHOUT_ACCOUNT') && ($cart->count_contents() > 0) && (PURCHASE_WITHOUT_ACCOUNT == 'ja' || PURCHASE_WITHOUT_ACCOUNT == 'yes')) {
?>
            <tr>
              <td colspan="2" width="100%">
                <table border="0" width="100%" cellspacing="1" cellpadding="2">
                  <tr>
                    <td class="login_boxes">
                      <table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="main"><?php echo TEXT_GUEST_INTRODUCTION; ?></td>
                        </tr>
                        <tr>
                          <td>
                            <table border="0" width="100%" cellspacing="0" cellpadding="2">
                              <tr>
                                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_CREATE_ACCOUNT, 'guest=guest', 'SSL') . '">' . tep_image_button('button_checkout.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
<?php
  }
  // PWA EOF
?>
            <tr>
              <td class="main" width="50%" valign="top"><b><?php echo HEADING_NEW_CUSTOMER; ?></b></td>
              <td class="main" width="50%" valign="top"><b><?php echo HEADING_RETURNING_CUSTOMER; ?></b></td>
            </tr>
            <tr>
              <td width="50%" height="100%" valign="top">
                <table border="0" width="100%" cellspacing="1" cellpadding="2">
                  <tr>
                    <td class="login_boxes">
                      <table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <tr>
                          <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                        </tr>
                        <tr>
                          <td class="main" valign="top"><?php echo TEXT_NEW_CUSTOMER . '<br><br>' . TEXT_NEW_CUSTOMER_INTRODUCTION; ?></td>
                        </tr>
                        <tr>
                          <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                        </tr>
                        <tr>
                          <td>
                            <table border="0" width="100%" cellspacing="0" cellpadding="2">
                              <tr>
                                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                                <td align="right"><?php echo '<a href="' . tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL') . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
              <td width="50%" height="100%" valign="top">
                <table border="0" width="100%" cellspacing="1" cellpadding="2">
                  <tr>
                    <td class="login_boxes">
                      <table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <tr>
                          <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                        </tr>
                        <tr>
                          <td class="main" colspan="2"><?php echo TEXT_RETURNING_CUSTOMER; ?></td>
                        </tr>
                        <tr>
                          <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                        </tr>
                        <tr>
                          <td class="main"><b><?php echo ENTRY_EMAIL_ADDRESS; ?></b></td>
                          <td class="main"><?php echo tep_draw_input_field('email_address'); ?></td>
                        </tr>
                        <tr>
                          <td class="main"><b><?php echo ENTRY_PASSWORD; ?></b></td>
                          <td class="main"><?php echo tep_draw_password_field('password'); ?></td>
                        </tr>
                        <tr>
                          <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                        </tr>
                        <tr>
                          <td class="smallText" colspan="2"><?php echo '<a href="' . tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?></td>
                        </tr>
                        <tr>
                          <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                        </tr>
                        <tr>
                          <td colspan="2">
                            <table border="0" width="100%" cellspacing="0" cellpadding="2">
                              <tr>
                                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                                <td align="right"><?php echo tep_image_submit('button_login.gif', IMAGE_BUTTON_LOGIN); ?></td>
                                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                              </tr>
                            </table>
                          </td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
    </form>
    <table align="right">
      <tr>
        <td>
<?php
          // *** BEGIN GOOGLE CHECKOUT ***
          if (defined('MODULE_PAYMENT_GOOGLECHECKOUT_STATUS') && MODULE_PAYMENT_GOOGLECHECKOUT_STATUS == 'True') {
            include_once('googlecheckout/gcheckout.php');
          }
          // *** END GOOGLE CHECKOUT *** 
?>
        </td>
      </tr>
    </table>