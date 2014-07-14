<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGIN);
  
  if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
    $email_address = tep_db_prepare_input($_POST['email_address']);
    $username = tep_db_prepare_input($_POST['username']);
    $log_times = $_POST['log_times']+1;
    if ($log_times >= 4) {
      tep_session_register('password_forgotten');
    }
      
// Check if email exists
    $check_admin_query = tep_db_query("select admin_id as check_id, admin_username as check_username, admin_lastname as check_lastname, admin_email_address as check_email_address from " . TABLE_ADMIN . " where admin_email_address = '" . tep_db_input($email_address) . "'");
    if (!tep_db_num_rows($check_admin_query)) {
      $_GET['login'] = 'fail';
    } else {
      $check_admin = tep_db_fetch_array($check_admin_query);
      if ($check_admin['check_username'] != $username) {
        $_GET['login'] = 'fail';
      } else {
        $_GET['login'] = 'success';
        
        function randomize() {
          $salt = "ABCDEFGHIJKLMNOPQRSTUVWXWZabchefghjkmnpqrstuvwxyz0123456789";
          srand((double)microtime()*1000000); 
          $i = 0;
    
          while ($i <= 7) {
            $num = rand() % 33;
    	    $tmp = substr($salt, $num, 1);
    	    $pass = $pass . $tmp;
    	    $i++;
  	  }
  	  return $pass;
        }
        $makePassword = randomize();
      
        tep_mail($check_admin['check_username'] . ' ' . $check_admin['admin_lastname'], $check_admin['check_email_address'], ADMIN_EMAIL_SUBJECT, sprintf(ADMIN_EMAIL_TEXT, $check_admin['check_firstname'], HTTP_SERVER . DIR_WS_ADMIN, $check_admin['check_username'], $makePassword, STORE_OWNER), STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS);            
        tep_db_query("update " . TABLE_ADMIN . " set admin_password = '" . tep_encrypt_password($makePassword) . "' where admin_id = '" . $check_admin['check_id'] . "'");
      }
    }
  }
  
  if (isset($_GET['login']) && ($_GET['login'] == 'success') ) {
    $success_message = TEXT_FORGOTTEN_SUCCESS;
  } elseif (isset($_GET['login']) && ($_GET['login'] == 'fail') ) {
    $info_message = TEXT_FORGOTTEN_ERROR;
  }

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
        <?php echo tep_draw_form('login', FILENAME_PASSWORD_FORGOTTEN, 'action=process'); ?>
        <?php
		if (tep_session_is_registered('password_forgotten')) {
		  echo '<div class="messageWarning">' . TEXT_FORGOTTEN_FAIL . '</div>';
		} elseif (isset($success_message)) {
		  echo '<div class="messageSuccess">' . $success_message . '</div>';	
		} elseif (isset($info_message)) {
		  echo '<div class="messageWarning">' . $info_message . '</div>';
		  echo tep_draw_hidden_field('log_times', $log_times);
	    } else {
		  echo '<div class="login_spacer"></div>';
		  echo tep_draw_hidden_field('log_times', '0');
		}
		?>
        
          <div class="login_text_holder"><?php echo ENTRY_USERNAME; ?></div>
          <div class="login_input_holder"><?php echo tep_draw_input_field('username', '', ' class="login_input"'); ?></div>
          <div class="login_text_holder"><?php echo ENTRY_EMAIL_ADDRESS; ?></div>
	      <div class="login_input_holder"><?php echo tep_draw_input_field('email_address', '', ' class="login_input"'); ?></div>
          <div class="password_forgotten">
          <?php echo '<a href="' . tep_href_link(FILENAME_LOGIN, '' , 'SSL') . '"><button type="button" class="login_back" style="display:inline-block">Back</button></a>';?>
          <button type="submit" class="login_button" style="float:right">Send password</button>
          </div>
          </form>
      </div>
    </div>
  </div>
  <div id="login_powered_by"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
</div>

</body>

</html>