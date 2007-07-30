<?php
/*
$Id: Order_Info_Check.php 3 2006-05-27 04:59:07Z user $
	by Cheng
  
        OSCommerce v2.2 CVS (09/17/02)
  
   Modified versions of create_account.php and related
  files.  Allowing 'purchase without account'.        


  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

  $newsletter_array = array(array('id' => '1',
                                  'text' => ENTRY_NEWSLETTER_YES),
                            array('id' => '0',
                                  'text' => ENTRY_NEWSLETTER_NO));
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td class="formAreaTitle"><?php echo CATEGORY_PERSONAL; ?></td>
  </tr>
  <tr>
    <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
      <tr>
        <td class="main"><table border="0" cellspacing="0" cellpadding="2">
<?php
  if (ACCOUNT_GENDER == 'true') {
    $male = ($account['customers_gender'] == 'm') ? true : false;
    $female = ($account['customers_gender'] == 'f') ? true : false;
?>
          <tr>
            <td class="main"> <?php echo ENTRY_GENDER; ?></td>
            <td class="main"> 
<?php
    if ($is_read_only) {
      echo ($account['customers_gender'] == 'm') ? MALE : FEMALE;
    } elseif ($error) {
      if ($entry_gender_error) {
        echo tep_draw_radio_field('gender', 'm', $male) . '  ' . MALE . '  ' . tep_draw_radio_field('gender', 'f', $female) . '  ' . FEMALE . ' ' . ENTRY_GENDER_ERROR;
      } else {
        echo ($gender == 'm') ? MALE : FEMALE;
        echo tep_draw_hidden_field('gender');
      }
    } else {
      echo tep_draw_radio_field('gender', 'm', $male) . '  ' . MALE . '  ' . tep_draw_radio_field('gender', 'f', $female) . '  ' . FEMALE . ' ' . ENTRY_GENDER_TEXT;
    }
?></td>
          </tr>
<?php
  }
?>
          <tr>
            <td class="main"> <?php echo ENTRY_FIRST_NAME; ?></td>
            <td class="main"> 
<?php
  if ($is_read_only) {
    echo $account['customers_firstname'];
  } elseif ($error) {
    if ($entry_firstname_error) {
      echo tep_draw_input_field('firstname') . ' ' . ENTRY_FIRST_NAME_ERROR;
    } else {
      echo $firstname . tep_draw_hidden_field('firstname');
    }
  } else {
    echo tep_draw_input_field('firstname', $account['customers_firstname']) . ' ' . ENTRY_FIRST_NAME_TEXT;
  }
?></td>
          </tr>
          <tr>
            <td class="main"> <?php echo ENTRY_LAST_NAME; ?></td>
            <td class="main"> 
<?php
  if ($is_read_only) {
    echo $account['customers_lastname'];
  } elseif ($error) {
    if ($entry_lastname_error) {
      echo tep_draw_input_field('lastname') . ' ' . ENTRY_LAST_NAME_ERROR;
    } else {
      echo $lastname . tep_draw_hidden_field('lastname');
    }
  } else {
    echo tep_draw_input_field('lastname', $account['customers_lastname']) . ' ' . ENTRY_LAST_NAME_TEXT;
  }
?></td>
          </tr>
<?php
  if (ACCOUNT_DOB == 'true') {
?>
          <tr>
            <td class="main"> <?php echo ENTRY_DATE_OF_BIRTH; ?></td>
            <td class="main"> 
<?php
    if ($is_read_only) {
      echo tep_date_short($account['customers_dob']);
    } elseif ($error) {
      if ($entry_date_of_birth_error) {
        echo tep_draw_input_field('dob') . ' ' . ENTRY_DATE_OF_BIRTH_ERROR;
      } else {
        echo $dob . tep_draw_hidden_field('dob');
      }
    } else {
      echo tep_draw_input_field('dob', tep_date_short($account['customers_dob'])) . ' ' . ENTRY_DATE_OF_BIRTH_TEXT;
    }
?></td>
          </tr>
<?php
  }
?>
          <tr>
            <td class="main"> <?php echo ENTRY_EMAIL_ADDRESS; ?></td>
            <td class="main"> 
<?php
  if ($is_read_only) {
    echo $account['customers_email_address'];
  } elseif ($error) {
    if ($entry_email_address_error) {
      echo tep_draw_input_field('email_address') . ' ' . ENTRY_EMAIL_ADDRESS_ERROR;
    } elseif ($entry_email_address_check_error) {
      echo tep_draw_input_field('email_address') . ' ' . ENTRY_EMAIL_ADDRESS_CHECK_ERROR;
    } elseif ($entry_email_address_exists) {
      echo tep_draw_input_field('email_address') . ' ' . ENTRY_EMAIL_ADDRESS_ERROR_EXISTS;
    } else {
      echo $email_address . tep_draw_hidden_field('email_address');
    }
  } else {
    echo tep_draw_input_field('email_address', $account['customers_email_address']) . ' ' . ENTRY_EMAIL_ADDRESS_TEXT;
  }
?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
<?php
  if (ACCOUNT_COMPANY == 'true') {
?>  
  <tr>
    <td class="formAreaTitle"><br><?php echo CATEGORY_COMPANY; ?></td>
  </tr>
  <tr>
    <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
      <tr>
        <td class="main"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"> <?php echo ENTRY_COMPANY; ?></td>
            <td class="main"> 
<?php
    if ($is_read_only) {
      echo $account['entry_company'];
    } elseif ($error) {
      if ($entry_company_error) {
        echo tep_draw_input_field('company') . ' ' . ENTRY_COMPANY_ERROR;
      } else {
        echo $company . tep_draw_hidden_field('company');
      }
    } else {
      echo tep_draw_input_field('company', $account['entry_company']) . ' ' . ENTRY_COMPANY_TEXT;
    }
?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
<?php
  }
?>
  <tr>
    <td class="formAreaTitle"><br><?php echo CATEGORY_ADDRESS; ?></td>
  </tr>
  <tr>
    <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
      <tr>
        <td class="main"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"> <?php echo ENTRY_STREET_ADDRESS; ?></td>
            <td class="main"> 
<?php
  if ($is_read_only) {
    echo $account['entry_street_address'];
  } elseif ($error) {
    if ($entry_street_address_error) {
      echo tep_draw_input_field('street_address') . ' ' . ENTRY_STREET_ADDRESS_ERROR;
    } else {
      echo $street_address . tep_draw_hidden_field('street_address');
    }
  } else {
    echo tep_draw_input_field('street_address', $account['entry_street_address']) . ' ' . ENTRY_STREET_ADDRESS_TEXT;
  }
?></td>
          </tr>
<?php
  if (ACCOUNT_SUBURB == 'true') {
?>
          <tr>
            <td class="main"> <?php echo ENTRY_SUBURB; ?></td>
            <td class="main"> 
<?php
    if ($is_read_only) {
      echo $account['entry_suburb'];
    } elseif ($error) {
      if ($entry_suburb_error) {
        echo tep_draw_input_field('suburb') . ' ' . ENTRY_SUBURB_ERROR;
      } else {
        echo $suburb . tep_draw_hidden_field('suburb');
      }
    } else {
      echo tep_draw_input_field('suburb', $account['entry_suburb']) . ' ' . ENTRY_SUBURB_TEXT;
    }
?></td>
          </tr>
<?php
  }
?>

          <tr>
            <td class="main"> <?php echo ENTRY_CITY; ?></td>
            <td class="main"> 
<?php
  if ($is_read_only) {
    echo $account['entry_city'];
  } elseif ($error) {
    if ($entry_city_error) {
      echo tep_draw_input_field('city') . ' ' . ENTRY_CITY_ERROR;
    } else {
      echo $city . tep_draw_hidden_field('city');
    }
  } else {
    echo tep_draw_input_field('city', $account['entry_city']) . ' ' . ENTRY_CITY_TEXT;
  }
?></td>

<?php
  if (ACCOUNT_STATE == 'true') {
?>
          <tr>
            <td class="main"> <?php echo ENTRY_STATE; ?></td>
            <td class="main"> 
<?php
    $state = tep_get_zone_name($country, $zone_id, $state);
    if ($is_read_only) {
      echo tep_get_zone_name($account['entry_country_id'], $account['entry_zone_id'], $account['entry_state']);
    } elseif ($error) {
      if ($entry_state_error) {
        if ($entry_state_has_zones) {
          $zones_array = array();
          $zones_query = tep_db_query("select zone_name from " . TABLE_ZONES . " where zone_country_id = '" . tep_db_input($country) . "' order by zone_name");
          while ($zones_values = tep_db_fetch_array($zones_query)) {
            $zones_array[] = array('id' => $zones_values['zone_name'], 'text' => $zones_values['zone_name']);
          }
          echo tep_draw_pull_down_menu('state', $zones_array) . ' ' . ENTRY_STATE_ERROR;
        } else {
          echo tep_draw_input_field('state') . ' ' . ENTRY_STATE_ERROR;
        }
      } else {
        echo $state . tep_draw_hidden_field('zone_id') . tep_draw_hidden_field('state');
      }
    } else {
      echo tep_draw_input_field('state', tep_get_zone_name($account['entry_country_id'], $account['entry_zone_id'], $account['entry_state'])) . ' ' . ENTRY_STATE_TEXT;
    }
?></td>
          </tr>
<?php
  }
?>		  
          <tr>
            <td class="main"> <?php echo ENTRY_POST_CODE; ?></td>
            <td class="main"> 
<?php
  if ($is_read_only) {
    echo $account['entry_postcode'];
  } elseif ($error) {
    if ($entry_post_code_error) {
      echo tep_draw_input_field('postcode') . ' ' . ENTRY_POST_CODE_ERROR;
    } else {
      echo $postcode . tep_draw_hidden_field('postcode');
    }
  } else {
    echo tep_draw_input_field('postcode', $account['entry_postcode']) . ' ' . ENTRY_POST_CODE_TEXT;
  }
?></td>
          </tr>
          </tr>
          <tr>
            <td class="main"> <?php echo ENTRY_COUNTRY; ?></td>
            <td class="main"> 
<?php
  if ($is_read_only) {
    echo tep_get_country_name($account['entry_country_id']);
  } elseif ($error) {
    if ($entry_country_error) {
      echo tep_get_country_list('country') . ' ' . ENTRY_COUNTRY_ERROR;
    } else {
      echo tep_get_country_name($country) . tep_draw_hidden_field('country');
    }
  } else {
    echo tep_get_country_list('country', $account['entry_country_id']) . ' ' . ENTRY_COUNTRY_TEXT;
  }
?></td>
          </tr>


        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="formAreaTitle"><br><?php echo CATEGORY_CONTACT; ?></td>
  </tr>
  <tr>
    <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
      <tr>
        <td class="main"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"> <?php echo ENTRY_TELEPHONE_NUMBER; ?></td>
            <td class="main"> 
<?php
  if ($is_read_only) {
    echo $account['customers_telephone'];
  } elseif ($error) {
    if ($entry_telephone_error) {
      echo tep_draw_input_field('telephone') . ' ' . ENTRY_TELEPHONE_NUMBER_ERROR;
    } else {
      echo $telephone . tep_draw_hidden_field('telephone');
    }
  } else {
    echo tep_draw_input_field('telephone', $account['customers_telephone']) . ' ' . ENTRY_TELEPHONE_NUMBER_TEXT;
  }
?></td>
          </tr>
          <tr>
            <td class="main"> <?php echo ENTRY_FAX_NUMBER; ?></td>
            <td class="main"> 
<?php
  if ($is_read_only) {
    echo $account['customers_fax'];
  } elseif ($processed) {
    echo $fax . tep_draw_hidden_field('fax');
  } else {
    echo tep_draw_input_field('fax', $account['customers_fax']) . ' ' . ENTRY_FAX_NUMBER_TEXT;
  }
?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td class="formAreaTitle"><br><?php echo CATEGORY_OPTIONS; ?></td>
  </tr>
  <tr>
    <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
      <tr>
        <td class="main"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main"> <?php echo ENTRY_NEWSLETTER; ?></td>
            <td class="main"> 
<?php
  if ($is_read_only) {
    if ($account['customers_newsletter'] == '1') {
      echo ENTRY_NEWSLETTER_YES;
    } else {
      echo ENTRY_NEWSLETTER_NO;
    }
  } elseif ($processed) {
    if ($newsletter == '1') {
      echo ENTRY_NEWSLETTER_YES;
    } else {
      echo ENTRY_NEWSLETTER_NO;
    }
    echo tep_draw_hidden_field('newsletter');  
  } else {
    echo tep_draw_pull_down_menu('newsletter', $newsletter_array, $account['customers_newsletter']) . ' ' . ENTRY_NEWSLETTER_TEXT;
  }
?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
<?php
  if (!$is_read_only) {
?>
  <!--tr>
    <td class="formAreaTitle"><br><?php echo CATEGORY_PASSWORD; ?></td>
  </tr>
  <tr>
    <td class="main"><table border="0" width="100%" cellspacing="0" cellpadding="2" class="formArea">
      <tr>
        <td class="main"><table border="0" cellspacing="0" cellpadding="2">
          <tr>
            <td class="main">&nbsp;<?php echo ENTRY_PASSWORD; ?></td>
            <td class="main">&nbsp;
<?php
    if ($error) {
      if ($entry_password_error) {
        echo tep_draw_password_field('password') . '&nbsp;' . ENTRY_PASSWORD_ERROR;
      } else {
        echo PASSWORD_HIDDEN . tep_draw_hidden_field('password') . tep_draw_hidden_field('confirmation');
      }
    } else {
      echo tep_draw_password_field('password') . '&nbsp;' . ENTRY_PASSWORD_TEXT;
    }
?></td>
         </tr>
<?php
    if ( (!$error) || ($entry_password_error) ) {
?>
          <tr>
            <td class="main">&nbsp;<?php echo ENTRY_PASSWORD_CONFIRMATION; ?></td>
            <td class="main">&nbsp;
<?php
      echo tep_draw_password_field('confirmation') . '&nbsp;' . ENTRY_PASSWORD_CONFIRMATION_TEXT;
?></td>
          </tr>
<?php
    }
?>
        </table></td>
      </tr>
    </table></td>
  </tr//-->
<?php
  }
?>
</table>
