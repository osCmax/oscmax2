              <tr> 
                
              <td class="main" width="33%" valign="top" align="center">&nbsp;</TD>
                
              <td class="main" width="33%" valign="top" align="center">&nbsp;</TD>
                
              <td class="main" width="33%" valign="top" align="center">&nbsp;</td>
                <td class="main" width="33%" valign="top">&nbsp;</td>
              </tr>
              <tr> 
                <td width="33%" height="100%" valign="top" align="center"> <table width="100%" height="100%" border="0" cellpadding="1" cellspacing="0" class="infoBox">
                  <tr> 
                      
                    <td valign="top"> 
                      <table width="100%" height="250" border="0" cellpadding="2" cellspacing="0" class="infoBoxContents">
                        <tr>
                          <td height="20" align="center" valign="top"><b><?php echo HEADING_CHECKOUT; ?><br>
                            </b></td>
                        </tr>
                        <tr> 
                          <td height="10" valign="top"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                        </tr>
                        <tr> 
                          <td height="100" valign="top" class="main"><?php echo TEXT_CHECKOUT_INTRODUCTION; ?></td>
                        </tr>
                          <td height="20" align="center" valign="bottom" class="main"><br>
                            <?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT, '', 'SSL') . '">' . tep_image_button('button_checkout.gif', IMAGE_BUTTON_CHECKOUT) . '</a>'; ?></td>
                        </tr>
                        <tr> 
                          <td height="10" valign="top"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                        </tr>
                      </table></td>
                    </tr>
                  </table> 
                                  
                
              </td>
                <td width="33%" valign="top" align="center">
                                
                                <table width="100%" height="100%" border="0" cellpadding="1" cellspacing="0" class="infoBox">
                  <tr> 
                      
                    <td valign="top"> 
                      <table width="100%" height="250" border="0" cellpadding="2" cellspacing="0" class="infoBoxContents">
                        <tr>
                          <td height="20" align="center" valign="top"><b><?php echo HEADING_NEW_CUSTOMER; ?><br>
                            <br>
                            </b></td>
                        </tr>
                        <tr> 
                          <td height="10" valign="top"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                        </tr>
                          <td height="100" valign="top" class="main"> <?php echo TEXT_NEW_CUSTOMER_INTRODUCTION; ?></td>
                        </tr>
                        <tr> 
                          <td height="20" align="center" valign="bottom" class="main"><br>
                            <br>
                            <br>
                            <?php echo '<a href="' . tep_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL') . '">' . tep_image_button('button_create_account.gif', IMAGE_BUTTON_CREATE_ACCOUNT) . '</a>'; ?></td>
                        </tr>
                        <tr> 
                          <td height="10" valign="top"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                        </tr>
                      </table>
                                                
                                                </td>
                    </tr>
                  </table>
                                  
                                  
                
              </td>
                <td width="33%" height="100%" valign="top" align="center"> <table width="100%" height="100%" border="0" cellpadding="1" cellspacing="0" class="infoBox">
                  <tr> 
                      
                    <td valign="top">
<table width="100%" height="250" border="0" cellpadding="2" cellspacing="0" class="infoBoxContents">
                        <!--<tr>
                    <td class="main" colspan="2"><?php echo TEXT_RETURNING_CUSTOMER; ?></td>
                  </tr>//-->
                        <tr align="center"> 
                          <td height="20" colspan="2"><b><?php echo HEADING_RETURNING_CUSTOMER; ?><br>
                            <br>
                            </b></td>
                        </tr>
                        <tr valign="top"> 
                          <td height="10" colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                        </tr>
                        <tr valign="top"> 
                          <td height="50" class="main"><b><?php echo ENTRY_EMAIL_ADDRESS; ?></b></td>
                          <td height="50" class="main"><?php echo tep_draw_input_field('email_address'); ?></td>
                        </tr>
                        <tr valign="top"> 
                          <td height="50" class="main"><b><?php echo ENTRY_PASSWORD; ?></b></td>
                          <td height="50" class="main"><?php echo tep_draw_password_field('password'); ?></td>
                        </tr>
                        <tr valign="top"> 
                          <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                        </tr>
                        <tr valign="top"> 
                          <td colspan="2" class="smallText"><?php echo '<a href="' . tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?></td>
                        </tr>
                        <tr valign="bottom"> 
                          <td height="20" colspan="2" align="center" class="smallText"><br>
                            <?php echo tep_image_submit('button_login.gif', IMAGE_BUTTON_LOGIN); ?></td>
                        </tr>
                        <tr> 
                          <td height="10" colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                        </tr>
                      </table></td>
              </tr>
            </table>
                
              </td>
          </tr>
          <tr>
              <td width="33%" align="center" valign="top">&nbsp;</TD>  
              <td width="33%" align="center" valign="top">&nbsp;</td>
              <td width="33%" align="center" valign="top">&nbsp;</td>
          </tr>
