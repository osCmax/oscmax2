<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
    <table border="0" width="100%" cellspacing="0" cellpadding="0"> 
      <tr> 
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0"> 
          <tr> 
            <td class="pageHeading"><?php echo HEADING_TITLE; ?></td> 
            <td rowspan="2" class="pageHeading" align="right">&nbsp;</td> 
          </tr> 
        </table></td> 
      </tr> 
      <tr> 
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td> 
      </tr> 
<?php 
  if (isset($_GET['login']) && ($_GET['login'] == 'fail')) { 
    $info_message = TEXT_LOGIN_ERROR; 
  } 

  if (isset($info_message)) { 
?> 

      <tr> 
        <td class="messageStackError"><?php echo tep_image(DIR_WS_ICONS . 'error.gif', ICON_ERROR) . $info_message; ?></td> 
      </tr> 
      <tr> 
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td> 
      </tr> 
<?php 
  } 
?> 
      <tr> 
        <td><?php echo tep_draw_form('affiliate_login', tep_href_link(FILENAME_AFFILIATE, 'action=process', 'SSL')); ?>
          <table border="0" width="100%" cellspacing="0" cellpadding="2" style="height:100%"> 
            <tr> 
              <td class="main" width="50%" valign="top"><b><?php echo HEADING_NEW_AFFILIATE; ?></b></td> 
              <td class="main" width="50%" valign="top"><b><?php echo HEADING_RETURNING_AFFILIATE; ?></b></td> 
            </tr> 
            <tr> 
              <td width="50%" height="100%" valign="top">
                <table border="0" width="100%" cellspacing="0" cellpadding="1" class="infoBox" style="height:100%"> 
                  <tr> 
                    <td>
                      <table border="0" width="100%" cellspacing="0" cellpadding="2" class="infoBoxContents" style="height:100%"> 
                        <tr> 
                          <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td> 
                        </tr> 
                        <tr> 
                          <td class="main" valign="top"><?php echo TEXT_NEW_AFFILIATE . '<br><br>' . TEXT_NEW_AFFILIATE_INTRODUCTION; ?></td> 
                        </tr> 
                        <tr> 
                          <td class="smallText" colspan="2"><b><a id="conditions" href="<?php echo $HTTP_SERVER . DIR_WS_CATALOG . 'conditions.php?info_id=14&amp;languages_id=' . (isset($languages_id) ? $languages_id : '1'); ?>" title="<?php echo TEXT_NEW_AFFILIATE_TERMS; ?>"> <?php echo TEXT_NEW_AFFILIATE_TERMS; ?></a></b></td> 
                        </tr> 
                        <tr> 
                          <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td> 
                        </tr> 
                        <tr> 
                          <td colspan="2" align="right" valign="top"><?php echo '<a href="' . tep_href_link(FILENAME_AFFILIATE_SIGNUP, '', 'SSL') . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td> 
                        </tr>
                        <tr> 
                          <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td> 
                        </tr>

                      </table>
                    </td> 
                  </tr> 
                </table>
              </td> 
              <td width="50%" height="100%" valign="top">
                <table border="0" width="100%" cellspacing="0" cellpadding="1" class="infoBox" style="height:100%"> 
                  <tr> 
                    <td>
                      <table border="0" width="100%" cellspacing="0" cellpadding="2" class="infoBoxContents" style="height:100%"> 
                        <tr> 
                          <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td> 
                        </tr> 
                        <tr> 
                          <td class="main" colspan="2"><?php echo TEXT_RETURNING_AFFILIATE; ?></td> 
                        </tr> 
                        <tr> 
                          <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td> 
                        </tr> 
                        <tr> 
                          <td class="main"><b><?php echo TEXT_AFFILIATE_ID; ?></b></td> 
                          <td class="main"><?php echo tep_draw_input_field('affiliate_username'); ?></td> 
                        </tr> 
                        <tr> 
                          <td class="main"><b><?php echo TEXT_AFFILIATE_PASSWORD; ?></b></td> 
                          <td class="main"><?php echo tep_draw_password_field('affiliate_password'); ?></td> 
                        </tr> 
                        <tr> 
                          <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td> 
                        </tr> 
                        <tr> 
                          <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td> 
                        </tr>
                        <tr> 
                          <td colspan="2" align="right" valign="top"><?php echo tep_image_submit('button_login.gif', IMAGE_BUTTON_LOGIN); ?></td> 
                        </tr>  
                        <tr> 
                          <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '5'); ?></td> 
                        </tr>
                      </table>
                    </td> 
                  </tr> 
                </table>
              </td> 
            </tr> 
          </table>
        </form></td>  
      </tr> 
    </table>