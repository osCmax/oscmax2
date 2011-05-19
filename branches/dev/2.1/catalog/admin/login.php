<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
    $username = tep_db_prepare_input($_POST['username']);
    $password = tep_db_prepare_input($_POST['password']);

// Check if usename exists
    $check_admin_query = tep_db_query("select admin_id as login_id, admin_groups_id as login_groups_id, admin_username as login_username, admin_password as login_password, admin_modified as login_modified, admin_logdate as login_logdate, admin_lognum as login_lognum from " . TABLE_ADMIN . " where admin_username = '" . tep_db_input($username) . "'");
    if (!tep_db_num_rows($check_admin_query)) {

//Added by PGM
    tep_db_query("insert into " . TABLE_ADMIN_LOG . " values (NULL, '" . $username . "', '" . $_SERVER['REMOTE_ADDR'] . "', 'Wrong Username', now())");

      $_GET['login'] = 'fail';
    } else {
      $check_admin = tep_db_fetch_array($check_admin_query);
      // Check that password is good
      if (!tep_validate_password($password, $check_admin['login_password'])) {

//Added by PGM
    tep_db_query("insert into " . TABLE_ADMIN_LOG . " values (NULL, '" . $username . "', '" . $_SERVER['REMOTE_ADDR'] . "', 'Wrong Password', now())");

        $_GET['login'] = 'fail';
      } else {
        if (tep_session_is_registered('password_forgotten')) {
          tep_session_unregister('password_forgotten');
        }

        $login_id = $check_admin['login_id'];
      $login_groups_id = $check_admin['login_groups_id'];
        $login_username = $check_admin['login_username'];
        $login_logdate = $check_admin['login_logdate'];
        $login_lognum = $check_admin['login_lognum'];
        $login_modified = $check_admin['login_modified'];

        tep_session_register('login_id');
        tep_session_register('login_groups_id');
        tep_session_register('login_username');

        //$date_now = date('Ymd');
        tep_db_query("update " . TABLE_ADMIN . " set admin_logdate = now(), admin_lognum = admin_lognum+1 where admin_id = '" . $login_id . "'");

//Added by PGM
    tep_db_query("insert into " . TABLE_ADMIN_LOG . " values (NULL, '" . $login_username . "', '" . $_SERVER['REMOTE_ADDR'] . "', 'Logged In', now())");

// There is no more default ADMIN - so don't need to check for DEFAULT user
//      if (($login_lognum == 0) || !($login_logdate) || ($login_email_address == 'admin@localhost') || ($login_modified == '0000-00-00 00:00:00')) {
//        tep_redirect(tep_href_link(FILENAME_ADMIN_ACCOUNT));
//      } else {
          tep_redirect(tep_href_link(FILENAME_DEFAULT));
//      }

      }
    }
  }

  @include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN);
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<meta name="robots" content="noindex,nofollow">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body onLoad="document.login.username.focus()">

<table border="0" width="600" cellspacing="0" cellpadding="0" align="center" style="height:100%;">
  <tr valign="middle">
    <td><table border="0" width="600" cellspacing="0" cellpadding="1" align="center" style="height:440px;">
      <tr bgcolor="#000000" valign="middle">
        <td><table border="0" width="600" cellspacing="0" cellpadding="0" style="height:440px">
          <tr bgcolor="#ffffff">
            <td height="50"><?php echo '<a href="http://www.oscmax.com">' . tep_image(DIR_WS_ADMIN . DIR_WS_ICONS . 'logo.png', PROJECT_VERSION, '187', '54') . '</a>'; ?></td>
            <td align="right" class="text" nowrap><?php echo '&nbsp;&nbsp;<a href="http://www.oscmax.com/" target="_blank" class="headerLink">' . HEADER_TITLE_AABOX . '</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://shop.oscmax.com" class="headerLink">' . HEADER_TITLE_OSCDOX . '</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://wiki.oscdox.com" class="headerLink">Wiki</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . HEADER_TITLE_ADMINISTRATION . '</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="' . tep_catalog_href_link() . '">' . HEADER_TITLE_ONLINE_CATALOG . '</a>'; ?>&nbsp;&nbsp;</td>
          </tr>
          <tr bgcolor="#E7E7E7">
            <td colspan="2" align="center" valign="middle">
                          <?php echo tep_draw_form('login', FILENAME_LOGIN, 'action=process'); ?>
                            <table width="320" border="0" cellspacing="0" cellpadding="2">
                              <tr>
                                <td class="login_heading" valign="top">&nbsp;<b><?php echo HEADING_RETURNING_ADMIN; ?></b></td>
                              </tr>
                              <tr>
                                <td height="100%" valign="top" align="center">
                                <table border="0" cellspacing="0" cellpadding="1" bgcolor="#666666" style="height:100%; width:100%;">
                                  <tr><td>
                                    <table border="0" width="100%" cellspacing="3" cellpadding="2" bgcolor="#F3F3F3" style="height:100%">
<?php
  if (isset($_GET['login']) && ($_GET['login'] == 'fail')) {
    $info_message = TEXT_LOGIN_ERROR;
  }

  if (isset($info_message)) {
?>
                            <tr>
                              <td colspan="2" class="smallText" align="center"><?php echo $info_message; ?></td>
                            </tr>
<?php
  } else {
?>
                            <tr>
                              <td colspan="2"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
                            </tr>
<?php
  }
?>
                            <tr>
                              <td class="login" align="right"><?php echo ENTRY_USERNAME; ?></td>
                              <td class="login"><?php echo tep_draw_input_field('username'); ?></td>
                            </tr>
                            <tr>
                              <td class="login" align="right"><?php echo ENTRY_PASSWORD; ?></td>
                              <td class="login"><?php echo tep_draw_password_field('password'); ?></td>
                            </tr>
                            <tr>
                              <td colspan="2" align="right" valign="top"><?php echo tep_image_submit('button_confirm.gif', IMAGE_BUTTON_LOGIN); ?>&nbsp;</td>
                            </tr>
                          </table>
                        </td></tr>
                      </table>
                    </td>
                  </tr>
                  <tr>
                    <td valign="top" align="right"><?php echo '<a class="sub" href="' . tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '">' . TEXT_PASSWORD_FORGOTTEN . '</a><span class="sub">&nbsp;</span>'; ?></td>
                  </tr>
                </table>
              </form>
            </td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></td>
      </tr>
    </table></td>
  </tr>
</table>

</body>

</html>