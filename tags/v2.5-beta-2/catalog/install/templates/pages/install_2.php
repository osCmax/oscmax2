<?php
/*
$Id: install_2.php 3 2006-05-27 04:59:07Z user $

  osCmax Power E-Commerce
  http://oscdox.com

  Copyright 2008 osCmax

  Released under the GNU General Public License
*/

  $www_location = 'http://' . $HTTP_SERVER_VARS['HTTP_HOST'];

  if (isset($HTTP_SERVER_VARS['REQUEST_URI']) && !empty($HTTP_SERVER_VARS['REQUEST_URI'])) {
    $www_location .= $HTTP_SERVER_VARS['REQUEST_URI'];
  } else {
    $www_location .= $HTTP_SERVER_VARS['SCRIPT_FILENAME'];
  }

  $www_location = substr($www_location, 0, strpos($www_location, 'install'));

  $dir_fs_www_root = osc_realpath(dirname(__FILE__) . '/../../../') . '/';
?>


<div id="menublock">
  <ul id="menutabs">
    <li><a href="index.php" id="first">Start</a></li>
    <li><a href="install.php?step=1">Database Server</a></li>
    <li><a href="#" id="active">Web Server</a></li>
    <li><a href="#">Store Settings</a></li>
    <li><a href="#" id="last">Finished</a></li>
  </ul>
</div>

<div class="mainBlock">
      <p>The web server takes care of serving the pages of your online store to your guests and customers. The web server parameters make sure the links to the pages point to the correct location.</p>
</div>

<div class="contentBlock">
  <div class="contentPane">

    <form name="installForm" id="installForm" action="install.php?step=3" method="post">

    <table border="0" width="100%" cellspacing="0" cellpadding="5" class="inputForm">
      <tr>
        <td class="inputField"><?php echo 'WWW Address<br />' . osc_draw_input_field('HTTP_WWW_ADDRESS', $www_location, 'class="text"'); ?></td>
        <td class="inputDescription">The web address to the online store.</td>
      </tr>
      <tr>
        <td class="inputField"><?php echo 'Webserver Root Directory<br />' . osc_draw_input_field('DIR_FS_DOCUMENT_ROOT', $dir_fs_www_root, 'class="text"'); ?></td>
        <td class="inputDescription">The directory where the online store is installed on the server.</td>
      </tr>
    </table>

<div id="buttons">
  <table width="100%">
    <tr>
      <td align="right"><input type="image" src="images/button_continue.gif" alt="Continue" id="inputButton" /></td>
    </tr>
  </table>
</div>

<?php
  reset($_POST);
  while (list($key, $value) = each($_POST)) {
    if (($key != 'x') && ($key != 'y')) {
      if (is_array($value)) {
        for ($i=0, $n=sizeof($value); $i<$n; $i++) {
          echo osc_draw_hidden_field($key . '[]', $value[$i]);
        }
      } else {
        echo osc_draw_hidden_field($key, $value);
      }
    }
  }
?>

    </form>
  </div>
</div>
