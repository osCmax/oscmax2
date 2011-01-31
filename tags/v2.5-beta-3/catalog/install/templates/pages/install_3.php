<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

$dir_fs_document_root = $HTTP_POST_VARS['DIR_FS_DOCUMENT_ROOT'];
  if ((substr($dir_fs_document_root, -1) != '\\') && (substr($dir_fs_document_root, -1) != '/')) {
    if (strrpos($dir_fs_document_root, '\\') !== false) {
      $dir_fs_document_root .= '\\';
    } else {
      $dir_fs_document_root .= '/';
    }
  }

?>

<div id="menublock">
  <ul id="menutabs">
    <li><a href="index.php" id="first">Start</a></li>
    <li><a href="install.php?step=1">Database Server</a></li>
    <li><a href="install.php?step=2">Web Server</a></li>
    <li><a href="#" id="active">Store Settings</a></li>
    <li><a href="#" id="last">Finished</a></li>
  </ul>
</div>

<div class="mainBlock">
      <p>Here you can define the name of your online store and the contact information for the store owner.</p>
      <p>The administrator username and password are used to log into the protected administration tool section.</p>
</div>

<div class="contentBlock">
  <div class="contentPane">

    <form name="installForm" id="installForm" action="install.php?step=4" method="post">

    <table border="0" width="100%" cellspacing="0" cellpadding="5" class="inputForm">
      <tr>
        <td class="inputField"><?php echo 'Store Name<br />' . osc_draw_input_field('CFG_STORE_NAME', null, 'class="text"'); ?></td>
        <td class="inputDescription">The name of the online store that is presented to the public.</td>
      </tr>
      <tr>
        <td class="inputField"><?php echo 'Store Owner First Name<br />' . osc_draw_input_field('CFG_STORE_OWNER_FIRSTNAME', null, 'class="text"'); ?></td>
        <td class="inputDescription">The first name of the store owner that is presented to the public.</td>
      </tr>
      <tr>
        <td class="inputField"><?php echo 'Store Owner Last Name<br />' . osc_draw_input_field('CFG_STORE_OWNER_LASTNAME', null, 'class="text"'); ?></td>
        <td class="inputDescription">The last name of the store owner that is presented to the public.</td>
      </tr>
      <tr>
        <td class="inputField"><?php echo 'Store Owner E-Mail Address<br />' . osc_draw_input_field('CFG_STORE_OWNER_EMAIL_ADDRESS', null, 'class="text"'); ?></td>
        <td class="inputDescription">The e-mail address of the store owner that is presented to the public.</td>
      </tr>
      <tr>
        <td class="inputField"><?php echo 'Administrator Username<br />' . osc_draw_input_field('CFG_ADMINISTRATOR_USERNAME', null, 'class="text"'); ?></td>
        <td class="inputDescription">The administrator username to use for the administration tool.</td>
      </tr>
      <tr>
        <td class="inputField"><?php echo 'Administrator Password<br />' . osc_draw_password_field('CFG_ADMINISTRATOR_PASSWORD', null, 'class="text"'); ?></td>
        <td class="inputDescription">The password to use for the administrator account.</td>
      </tr>

<?php if (is_writable($dir_fs_document_root) && is_writable($dir_fs_document_root . 'admin')) { ?>
      <tr>
        <td class="inputField"><?php echo 'Admin Folder Name<br />' . osc_draw_input_field('CFG_ADMIN_FOLDER', 'admin', 'class="text"'); ?></td>
        <td class="inputDescription">The name of folder in which the admin files should be kept.  It is <b>recommended that you change this</b> from the default setting of <b>admin</b> to improve your site's security. If you want to read more about security please <a href="http://wiki.oscdox.com/v2.5/setting_up_security" target="_blank">read the wiki</a>.</td>
      </tr>
<?php } else { ?>
      <tr>
        <td class="inputField"><?php echo 'Admin Folder Name<br /><img src="images/failed.gif" align="left" hspace="5" vspace="5" border="0">';?></td>
        <td class="inputDescription">We have been unable to obtain sufficient file permissions to allow you to change the name of your <b>admin/</b> folder.  You should rename this folder to improve your store security.  For instructions on how to manually do this once you have corrected your server settings please <a href="http://wiki.oscdox.com/v2.1/setting_up_security" target="_blank">read the wiki</a>.</td>
      </tr>
<?php } ?>
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
