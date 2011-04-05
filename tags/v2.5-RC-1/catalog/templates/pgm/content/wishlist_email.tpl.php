<!-- body_text //-->
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo sprintf(HEADING_TITLE, $product_info['products_name']); ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', '1', '27'); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
    $error = false;

    if (isset($_GET['action']) && ($_GET['action'] == 'process') && !tep_validate_email(trim($_POST['friendemail']))) {
      $friendemail_error = true;
      $error = true;
    } else {
      $friendemail_error = false;
    }

    if (isset($_GET['action']) && ($_GET['action'] == 'process') && empty($_POST['friendname'])) {
      $friendname_error = true;
      $error = true;
    } else {
      $friendname_error = false;
    }

    if (tep_session_is_registered('customer_id')) {
      $from_name = $account_values['customers_firstname'] . ' ' . $account_values['customers_lastname'];
      $from_email_address = $account_values['customers_email_address'];
    } else {
      $from_name = $_POST['yourname'];
      $from_email_address = $_POST['from'];
    }

    if (!tep_session_is_registered('customer_id')) {
      if (isset($_GET['action']) && ($_GET['action'] == 'process') && !tep_validate_email(trim($from_email_address))) {
        $fromemail_error = true;
        $error = true;
      } else {
        $fromemail_error = false;
      }
    }

    if (isset($_GET['action']) && ($_GET['action'] == 'process') && empty($from_name)) {
      $fromname_error = true;
      $error = true;
    } else {
      $fromname_error = false;
    }

    if (isset($_GET['action']) && ($_GET['action'] == 'process') && ($error == false)) {
      $email_subject = sprintf(TEXT_EMAIL_SUBJECT, $from_name, STORE_NAME);
      $email_body = sprintf(TEXT_EMAIL_INTRO, $_POST['friendname'], $from_name, $_POST['products_name'], STORE_NAME) . "\n\n";

//      if (tep_not_null($_POST['yourmessage'])) {
        $email_body .= $wishliststring . "\n\n" . $_POST['yourmessage'] . "\n\n";
//      }

      $email_body .= sprintf(TEXT_EMAIL_SIGNATURE, STORE_NAME . "\n"). "<A HREF=\"". HTTP_SERVER . DIR_WS_CATALOG ."\"><b><i>".STORE_NAME."</i></b></A> "."\n";

                     "\n\n" . $mywishlist .= $wishlist_query_array[1] ."\n";


      tep_mail($_POST['friendname'], $_POST['friendemail'], $email_subject, stripslashes($email_body), '', $from_email_address);
?>
      <tr>
        <td><br><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"><?php echo sprintf(TEXT_EMAIL_SUCCESSFUL_SENT, $_POST['friendemail']); ?></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td class="main"><?php echo '<a href="' . tep_href_link(FILENAME_WISHLIST) . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
      </tr>
<?php
    } else {
      if (tep_session_is_registered('customer_id')) {
        $your_name_prompt = $account_values['customers_firstname'] . ' ' . $account_values['customers_lastname'];
        $your_email_address_prompt = $account_values['customers_email_address'];
      } else {
        $your_name_prompt = tep_draw_input_field('yourname', (($fromname_error == true) ? $_POST['yourname'] : $_GET['yourname']));
        if ($fromname_error == true) $your_name_prompt .= '&nbsp;' . TEXT_REQUIRED;
        $your_email_address_prompt = tep_draw_input_field('from', (($fromemail_error == true) ? $_POST['from'] : $_GET['from']));
        if ($fromemail_error == true) $your_email_address_prompt .= ENTRY_EMAIL_ADDRESS_CHECK_ERROR;
      }
?>
      <tr>
        <td><?php echo tep_draw_form('email_friend', tep_href_link(FILENAME_WISHLIST_SEND, 'action=process&products_id=' . $_GET['products_id'])) . tep_draw_hidden_field('products_name', $product_info['products_name']); ?><table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="formAreaTitle"><?php echo FORM_TITLE_CUSTOMER_DETAILS; ?></td>
          </tr>
          <tr>
            <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
              <tr>
                <td class="main"><table border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><?php echo FORM_FIELD_CUSTOMER_NAME; ?></td>
                    <td class="main"><?php echo $your_name_prompt; ?></td>
                  </tr>
                  <tr>
                    <td class="main"><?php echo FORM_FIELD_CUSTOMER_EMAIL; ?></td>
                    <td class="main"><?php echo $your_email_address_prompt; ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td class="formAreaTitle"><br><?php echo FORM_TITLE_FRIEND_DETAILS; ?></td>
          </tr>
          <tr>
            <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
              <tr>
                <td class="main"><table border="0" cellspacing="0" cellpadding="2">
                  <tr>
                    <td class="main"><?php echo FORM_FIELD_FRIEND_NAME; ?></td>
                    <td class="main"><?php echo tep_draw_input_field('friendname', (($friendname_error == true) ? $_POST['friendname'] : $_GET['friendname'])); if ($friendname_error == true) echo '&nbsp;' . TEXT_REQUIRED;?></td>
                  </tr>
                  <tr>
                    <td class="main"><?php echo FORM_FIELD_FRIEND_EMAIL; ?></td>
                    <td class="main"><?php echo tep_draw_input_field('friendemail', (($friendemail_error == true) ? $_POST['friendemail'] : $_GET['send_to'])); if ($friendemail_error == true) echo ENTRY_EMAIL_ADDRESS_CHECK_ERROR; ?></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td class="formAreaTitle"><br><?php echo FORM_TITLE_FRIEND_MESSAGE; ?></td>
          </tr>
          <tr>
            <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
              <tr>
                <td><textarea name="yourmessage" cols=40 rows=4></textarea></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><br><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="main"><?php echo '<a href="' . tep_href_link(FILENAME_WISHLIST) . '">' . tep_image_button('button_back.gif', IMAGE_BUTTON_BACK) . '</a>'; ?></td>
                <td align="right" class="main"><?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></form></td>
      </tr>
<?php
    }

?>
    </table>
<!-- body_text_eof //-->