<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  @include(DIR_WS_LANGUAGES . $language . '/' . FILENAME_LOGOFF);

//tep_session_destroy();

//Added by PGM
tep_db_query("insert into " . TABLE_ADMIN_LOG . " values ('', '" . $login_username . "', '" . $_SERVER['REMOTE_ADDR'] . "', 'Logged Out', now())");

  tep_session_unregister('login_id');
  tep_session_unregister('login_username');
  tep_session_unregister('login_groups_id');

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
<body style="background-image: url(images/icons/background.png)">

<div id="login_container">
  <div id="login_panel">
    <div id="login_header"><?php echo STORE_NAME; ?>
      <span id="login_logo"><?php echo '<a href="http://www.oscmax.com">' . tep_image(DIR_WS_ADMIN . DIR_WS_ICONS . 'logo.png', PROJECT_VERSION, '187', '54') . '</a>'; ?></span>
    </div>
    <div id="login_links"><?php echo '&nbsp;&nbsp;<a href="http://www.oscmax.com/" target="_blank">' . HEADER_TITLE_AABOX . '</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://shop.oscmax.com">' . HEADER_TITLE_OSCDOX . '</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://wiki.oscdox.com">Wiki</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . HEADER_TITLE_ADMINISTRATION . '</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="' . tep_catalog_href_link() . '">' . HEADER_TITLE_ONLINE_CATALOG . '</a>'; ?></div>
    <div id="login_body">
      <div id="login_input_container">
        <div class="messageAlert"><?php echo TEXT_MAIN; ?></div>
        <?php echo '<center><a href="' . tep_href_link(FILENAME_LOGIN, '' , 'SSL') . '"><button type="button" class="login_button" style="display:inline-block;">Back</button></a></center>';?>
        </div>
      </div>
    </div>
    <div id="login_powered_by"><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></div>
  </div>
</div>

</body>

</html>