<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  // Check language pack for installer
  if (isset($_GET['language'])) {
    $language_selected = ($_GET['language']);
  } elseif (isset($_POST['language'])) {
	$language_selected = ($_POST['language']);  
  } else {
	$language_selected = 'english';
  }

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
    <li><a href="index.php" id="first"><?php echo TAB_START; ?></a></li>
    <li><a href="install.php?step=1&language=<?php echo $language_selected; ?>"><?php echo TAB_DATABASE_SERVER; ?></a></li>
    <li><a href="install.php?step=2&language=<?php echo $language_selected; ?>"><?php echo TAB_WEB_SERVER; ?></a></li>
    <li><a href="#" id="active"><?php echo TAB_STORE_SETTINGS; ?></a></li>
    <li><a href="#" id="last"><?php echo TAB_FINISHED; ?></a></li>
  </ul>
</div>

<div class="mainBlock">
  <?php echo TEXT_STORE_SETUP; ?>
</div>

<div class="contentBlock">
  <div class="contentPane">

    <form name="installForm" id="installForm" action="install.php?step=4" method="post">

    <table border="0" width="100%" cellspacing="0" cellpadding="5" class="inputForm">
      <tr>
        <td class="inputField"><?php echo TEXT_STORE_NAME . '<br />' . osc_draw_input_field('CFG_STORE_NAME', null, 'class="text"'); ?></td>
        <td class="inputDescription"><?php echo TEXT_STORE_NAME_DESC; ?></td>
      </tr>
      <tr>
        <td class="inputField"><?php echo TEXT_FIRST_NAME . '<br />' . osc_draw_input_field('CFG_STORE_OWNER_FIRSTNAME', null, 'class="text"'); ?></td>
        <td class="inputDescription"><?php echo TEXT_FIRST_NAME_DESC; ?></td>
      </tr>
      <tr>
        <td class="inputField"><?php echo TEXT_LAST_NAME . '<br />' . osc_draw_input_field('CFG_STORE_OWNER_LASTNAME', null, 'class="text"'); ?></td>
        <td class="inputDescription"><?php echo TEXT_LAST_NAME_DESC; ?></td>
      </tr>
      <tr>
        <td class="inputField"><?php echo TEXT_EMAIL . '<br />' . osc_draw_input_field('CFG_STORE_OWNER_EMAIL_ADDRESS', null, 'class="text"'); ?></td>
        <td class="inputDescription"><?php echo TEXT_EMAIL_DESC; ?></td>
      </tr>
      <tr>
        <td class="inputField"><?php echo TEXT_USERNAME . '<br />' . osc_draw_input_field('CFG_ADMINISTRATOR_USERNAME', null, 'class="text"'); ?></td>
        <td class="inputDescription"><?php echo TEXT_USERNAME_DESC; ?></td>
      </tr>
      <tr>
        <td class="inputField"><?php echo TEXT_PASSWORD . '<br />' . osc_draw_password_field('CFG_ADMINISTRATOR_PASSWORD', null, 'class="text"'); ?></td>
        <td class="inputDescription"><?php echo TEXT_PASSWORD_DESC; ?></td>
      </tr>

<?php if (is_writable($dir_fs_document_root) && is_writable($dir_fs_document_root . 'admin')) { ?>
      <tr>
        <td class="inputField"><?php echo TEXT_ADMIN_FOLDER_NAME . '<br />' . osc_draw_input_field('CFG_ADMIN_FOLDER', 'admin', 'class="text"'); ?></td>
        <td class="inputDescription"><?php echo TEXT_CHANGE_ADMIN_FOLDER; ?></td>
      </tr>
<?php } else { ?>
      <tr>
        <td class="inputField"><?php echo TEXT_ADMIN_FOLDER_NAME . '<br /><img src="images/failed.gif" align="left" hspace="5" vspace="5" border="0">';?></td>
        <td class="inputDescription"><?php echo TEXT_ADMIN_NO_PERMISSION; ?></td>
      </tr>
<?php } ?>
    </table>

<div id="buttons">
  <table width="100%">
    <tr>
      <td align="right"><input type="image" src="includes/languages/<?php echo $language_selected; ?>/images/buttons/button_continue.gif" alt="<?php echo IMAGE_CONTINUE; ?>" id="inputButton" /></td>
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
