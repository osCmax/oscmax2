<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  // Check language pack for installer
  if (isset($_POST['language'])) {
    $language_selected = ($_POST['language']);
  } else {
	$language_selected = 'english';
  }

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
    <li><a href="index.php" id="first"><?php echo TAB_START; ?></a></li>
    <li><a href="install.php?step=1"><?php echo TAB_DATABASE_SERVER; ?></a></li>
    <li><a href="#" id="active"><?php echo TAB_WEB_SERVER; ?></a></li>
    <li><a href="#"><?php echo TAB_STORE_SETTINGS; ?></a></li>
    <li><a href="#" id="last"><?php echo TAB_FINISHED; ?></a></li>
  </ul>
</div>

<div class="mainBlock">
      <?php echo TEXT_WEB_SERVER; ?>
</div>

<div class="contentBlock">
  <div class="contentPane">

    <form name="installForm" id="installForm" action="install.php?step=3" method="post">

    <table border="0" width="100%" cellspacing="0" cellpadding="5" class="inputForm">
      <tr>
        <td class="inputField"><?php echo TEXT_WWW_ADDRESS . '<br />' . osc_draw_input_field('HTTP_WWW_ADDRESS', $www_location, 'class="text"'); ?></td>
        <td class="inputDescription"><?php echo TEXT_WEB_ADDRESS; ?></td>
      </tr>
      <tr>
        <td class="inputField"><?php echo TEXT_WEBSERVER_ROOT_DIR . '<br />' . osc_draw_input_field('DIR_FS_DOCUMENT_ROOT', $dir_fs_www_root, 'class="text"'); ?></td>
        <td class="inputDescription"><?php echo TEXT_WEBSERVER_DIRECTORY; ?></td>
      </tr>
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
