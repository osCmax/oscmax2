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
    tep_db_query("insert into " . TABLE_ADMIN_LOG . " values (NULL, '" . tep_db_input($username) . "', '" . $_SERVER['REMOTE_ADDR'] . "', 'Wrong Username', now())");

      $_GET['login'] = 'fail';
    } else {
      $check_admin = tep_db_fetch_array($check_admin_query);
      // Check that password is good
      if (!tep_validate_password($password, $check_admin['login_password'])) {

//Added by PGM
    tep_db_query("insert into " . TABLE_ADMIN_LOG . " values (NULL, '" . tep_db_input($username) . "', '" . $_SERVER['REMOTE_ADDR'] . "', 'Wrong Password', now())");

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
    tep_db_query("insert into " . TABLE_ADMIN_LOG . " values (NULL, '" . tep_db_input($login_username) . "', '" . $_SERVER['REMOTE_ADDR'] . "', 'Logged In', now())");

// There is no more default ADMIN - so don't need to check for DEFAULT user
//      if (($login_lognum == 0) || !($login_logdate) || ($login_email_address == 'admin@localhost') || ($login_modified == '0000-00-00 00:00:00')) {
//        tep_redirect(tep_href_link(FILENAME_ADMIN_ACCOUNT));
//      } else {
          tep_redirect(tep_href_link(FILENAME_DEFAULT));
//      }

      }
    }
  }
  
  if (isset($_GET['session_expired'])) {
    $info_message = TEXT_SESSION_EXPIRED;	  
  }
  
  if (isset($_GET['login']) && ($_GET['login'] == 'fail')) {
    $info_message = TEXT_LOGIN_ERROR;
  }

  @include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN);
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<meta name="robots" content="noindex,nofollow">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/javascript/jquery-ui-1.8.9.custom.css">
</head>
<script type="text/javascript">    
document.write("\<script src='//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js' type='text/javascript'>\<\/script>");
document.write("\<script src='//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js' type='text/javascript'>\<\/script>");
</script>
<body onLoad="document.login.username.focus()" style="background-image: url(images/icons/background.png)">

<div id="login_container">
  <div id="login_panel">
    <div id="login_header"><?php echo STORE_NAME; ?>
      <span id="login_logo"><?php echo '<a href="http://www.oscmax.com">' . tep_image(DIR_WS_ADMIN . DIR_WS_ICONS . 'logo.png', PROJECT_VERSION, '187', '54') . '</a>'; ?></span>
    </div>
    <div id="login_links"><?php echo '&nbsp;&nbsp;<a href="http://www.oscmax.com/" target="_blank">' . HEADER_TITLE_AABOX . '</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://shop.oscmax.com">' . HEADER_TITLE_OSCDOX . '</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://wiki.oscdox.com">Wiki</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . HEADER_TITLE_ADMINISTRATION . '</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="' . tep_catalog_href_link() . '">' . HEADER_TITLE_ONLINE_CATALOG . '</a>'; ?></div>
    <div id="login_body">
      
      <div id="login_input_container">
        <?php
		if (isset($info_message)) {
		  echo '<div class="messageWarning">' . $info_message . '</div>';
	    } else {
		  echo '<div class="login_spacer"></div>';
		}?>
        <?php echo tep_draw_form('login', FILENAME_LOGIN, 'action=process'); ?>
          <div class="login_text_holder"><?php echo ENTRY_USERNAME; ?></div>
          <div class="login_input_holder"><?php echo tep_draw_input_field('username', '', ' class="login_input"'); ?></div>
          <div class="login_text_holder"><?php echo ENTRY_PASSWORD; ?></div>
	      <div class="login_input_holder"><input type="password" name="password" maxlength="40" class="login_input"></div>
          <div class="password_forgotten"><?php echo '<a href="' . tep_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '" style="font-size:12px;">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?>
          <button type="submit" class="login_button" style="float:right">Log in</button>
          </div>
          </form>
      </div>
    </div>
  </div>
  <div id="login_powered_by"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>

</body>
</html>