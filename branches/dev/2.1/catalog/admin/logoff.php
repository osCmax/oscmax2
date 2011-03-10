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
tep_db_query("insert into " . TABLE_ADMIN_LOG . " values ('', '" . $login_username . "', '" . $_SERVER['REMOTE_ADDR'] . "', 'Logged Out', '" . date('F j, Y, g:i a') . "')");

  tep_session_unregister('login_id');
  tep_session_unregister('login_username');
  tep_session_unregister('login_groups_id');

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

<table border="0" width="600" cellspacing="0" cellpadding="0" align="center" style="height:100%;">
  <tr valign="middle">
    <td><table border="0" width="600" cellspacing="0" cellpadding="1" align="center" style="height:440;">
      <tr bgcolor="#000000" valign="middle">
        <td><table border="0" width="600" cellspacing="0" cellpadding="0" style="height:440;">
          <tr bgcolor="#ffffff">
            <td height="50"><?php echo '<a href="http://www.oscmax.com">' . tep_image(DIR_WS_IMAGES . 'oscmax-logo.png', 'osCmax v2.1', '187', '54') . '</a>'; ?></td>
            <td align="right" class="text" nowrap><?php echo '&nbsp;&nbsp;<a href="http://www.aabox.com" target="_blank" class="headerLink">osCmax Hosting</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://shop.oscmax.com/" class="headerLink"  target="_blank">' . HEADER_TITLE_OSCDOX . '</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="http://wiki.oscdox.com/" class="headerLink" target="_blank">Wiki</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . HEADER_TITLE_ADMINISTRATION . '</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="' . tep_catalog_href_link() . '">' . HEADER_TITLE_ONLINE_CATALOG . '</a>'; ?>&nbsp;&nbsp;</td>
          </tr>
          <tr bgcolor="#E7E7E7">
            <td colspan="2" align="center" valign="middle">
                  <table width="320" border="0" cellspacing="0" cellpadding="2">
                    <tr>
                      <td class="login_heading" valign="top"><b><?php echo HEADING_TITLE; ?></b></td>
                    </tr>
                    <tr>
                      <td>
					    <table border="0" width="100%" cellspacing="3" cellpadding="2" bgcolor="#F3F3F3" style="height:100%; border: 1px solid #666666;">
						  <tr>
						    <td class="login"><?php echo TEXT_MAIN; ?></td>
                          </tr>
                          <tr>
                            <td class="login_heading" align="right"><?php echo '<a class="login_heading" href="' . tep_href_link(FILENAME_LOGIN, '', 'SSL') . '">' . tep_image_button('button_back.gif', IMAGE_BACK) . '</a>'; ?></td>
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
        <tr>
          <td><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></td>
        </tr>
      </table>
    </td>
  </tr>
</table>

</body>

</html>