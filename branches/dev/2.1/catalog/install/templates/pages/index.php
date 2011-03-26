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

  $compat_register_globals = true;

  if (function_exists('ini_get') && (PHP_VERSION < 4.3) && ((int)ini_get('register_globals') == 0)) {
    $compat_register_globals = false;
  }
?>

<div id="menublock">
  <ul id="menutabs">
    <li><a href="#" id="firstactive"><?php echo TAB_START; ?></a></li>
    <li><a href="install.php?step=1&language=<?php echo $language_selected; ?>"><?php echo TAB_DATABASE_SERVER; ?></a></li>
    <li><a href="#" class="inactive"><?php echo TAB_WEB_SERVER; ?></a></li>
    <li><a href="#" class="inactive"><?php echo TAB_STORE_SETTINGS; ?></a></li>
    <li><a href="#" class="inactive"><?php echo TAB_FINISHED; ?></a></li>
  </ul>
</div>

<div class="mainBlock">
  <div class="stepsBox">
  
      <table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td><b><?php echo TEXT_PHP_VERSION; ?></b></td>
          <td align="right"><?php echo PHP_VERSION; ?></td>
          <td align="right" width="25"><img src="images/<?php echo ((PHP_VERSION >= 4) ? 'tick.png' : 'cross.png'); ?>" border="0" width="16" height="16" alt=""></td>
        </tr>
      </table>

<?php
  if (function_exists('ini_get')) {
?>

      <br />

      <table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td><b><?php echo TEXT_PHP_SETTINGS; ?></b></td>
          <td align="right"></td>
          <td align="right" width="25"></td>
        </tr>
        <tr>
          <td>register_globals</td>
          <td align="right"><?php echo (((int)ini_get('register_globals') == 0) ? TEXT_OFF : TEXT_ON); ?></td>
          <td align="right"><img src="images/<?php echo (($compat_register_globals == true) ? 'tick.png' : 'cross.png'); ?>" border="0" width="16" height="16" alt=""></td>
        </tr>
        <tr>
          <td>magic_quotes</td>
          <td align="right"><?php echo (((int)ini_get('magic_quotes') == 0) ? TEXT_OFF : TEXT_ON); ?></td>
          <td align="right"><img src="images/<?php echo (((int)ini_get('magic_quotes') == 0) ? 'tick.png' : 'cross.png'); ?>" border="0" width="16" height="16" alt=""></td>
        </tr>
        <tr>
          <td>file_uploads</td>
          <td align="right"><?php echo (((int)ini_get('file_uploads') == 0) ? TEXT_OFF : TEXT_ON); ?></td>
          <td align="right"><img src="images/<?php echo (((int)ini_get('file_uploads') == 1) ? 'tick.png' : 'cross.png'); ?>" border="0" width="16" height="16" alt=""></td>
        </tr>
        <tr>
          <td>session.auto_start</td>
          <td align="right"><?php echo (((int)ini_get('session.auto_start') == 0) ? TEXT_OFF : TEXT_ON); ?></td>
          <td align="right"><img src="images/<?php echo (((int)ini_get('session.auto_start') == 0) ? 'tick.png' : 'cross.png'); ?>" border="0" width="16" height="16" alt=""></td>
        </tr>
        <tr>
          <td>session.use_trans_sid</td>
          <td align="right"><?php echo (((int)ini_get('session.use_trans_sid') == 0) ? TEXT_OFF : TEXT_ON); ?></td>
          <td align="right"><img src="images/<?php echo (((int)ini_get('session.use_trans_sid') == 0) ? 'tick.png' : 'cross.png'); ?>" border="0" width="16" height="16" alt=""></td>
        </tr>
      </table>

      <br />

      <table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td><b><?php echo TEXT_PHP_EXTENSIONS; ?></b></td>
          <td align="right" width="25"></td>
        </tr>
        <tr>
          <td>MySQL</td>
          <td align="right"><img src="images/<?php echo (extension_loaded('mysql') ? 'tick.png' : 'cross.png'); ?>" border="0" width="16" height="16" alt=""></td>
        </tr>
        <tr>
          <td>GD</td>
          <td align="right"><img src="images/<?php echo (extension_loaded('gd') ? 'tick.png' : 'cross.png'); ?>" border="0" width="16" height="16" alt=""></td>
        </tr>
        <tr>
          <td>cURL</td>
          <td align="right"><img src="images/<?php echo (extension_loaded('curl') ? 'tick.png' : 'cross.png'); ?>" border="0" width="16" height="16" alt=""></td>
        </tr>
        <tr>
          <td>OpenSSL</td>
          <td align="right"><img src="images/<?php echo (extension_loaded('openssl') ? 'tick.png' : 'cross.png'); ?>" border="0" width="16" height="16" alt=""></td>
        </tr>
      </table>

<?php
  }
?>
  
  </div>

  <h1><?php echo TEXT_WELCOME_TO_OSCMAX . PROJECT_VERSION; ?></h1>

  <?php echo TEXT_INDEX_MAIN_BLOCK; ?>
</div>

<div class="contentBlock">

  <div class="contentPane">
<?php
  $configfile_array = array();

  if (file_exists(osc_realpath(dirname(__FILE__) . '/../../../includes') . '/configure.php') && !is_writeable(osc_realpath(dirname(__FILE__) . '/../../../includes') . '/configure.php')) {
    @chmod(osc_realpath(dirname(__FILE__) . '/../../../includes') . '/configure.php', 0777);
  }

  if (file_exists(osc_realpath(dirname(__FILE__) . '/../../../admin/includes') . '/configure.php') && !is_writeable(osc_realpath(dirname(__FILE__) . '/../../../admin/includes') . '/configure.php')) {
    @chmod(osc_realpath(dirname(__FILE__) . '/../../../admin/includes') . '/configure.php', 0777);
  }

  if (file_exists(osc_realpath(dirname(__FILE__) . '/../../../includes') . '/configure.php') && !is_writeable(osc_realpath(dirname(__FILE__) . '/../../../includes') . '/configure.php')) {
    $configfile_array[] = osc_realpath(dirname(__FILE__) . '/../../../includes') . '/configure.php';
  }

  if (file_exists(osc_realpath(dirname(__FILE__) . '/../../../admin/includes') . '/configure.php') && !is_writeable(osc_realpath(dirname(__FILE__) . '/../../../admin/includes') . '/configure.php')) {
    $configfile_array[] = osc_realpath(dirname(__FILE__) . '/../../../admin/includes') . '/configure.php';
  }

  $warning_array = array();

  if (function_exists('ini_get')) {
    if ($compat_register_globals == false) {
      $warning_array['register_globals'] = TEXT_REGISTER_GLOBALS_ERROR;
    }
  }

  if ((sizeof($configfile_array) > 0) || (sizeof($warning_array) > 0)) {
?>

    <div class="noticeBox">

<?php
    if (sizeof($warning_array) > 0) {
?>

      <table border="0" width="100%" cellspacing="0" cellpadding="2" style="background: #fffbdf; border: 1px solid #ffc20b; padding: 2px;">

<?php
      reset($warning_array);
      while (list($key, $value) = each($warning_array)) {
        echo '        <tr>' . "\n" .
             '          <td valign="top"><b>' . $key . '</b></td>' . "\n" .
             '          <td valign="top">' . $value . '</td>' . "\n" .
             '        </tr>' . "\n";
      }
?>

      </table>
<?php
    }

    if (sizeof($configfile_array) > 0) {

	echo TEXT_PERMISSIONS_ERROR;

      for ($i=0, $n=sizeof($configfile_array); $i<$n; $i++) {
        echo $configfile_array[$i];

        if (isset($configfile_array[$i+1])) {
          echo '<br />';
        }
      }
?>

      </p>

<?php
    }
?>

    </div>

<?php
  }

  if ((sizeof($configfile_array) > 0) || (sizeof($warning_array) > 0)) {
	  
  echo TEXT_CORRECT_ERROR;

    if (sizeof($warning_array) > 0) {
      echo TEXT_RESTART_WEB_SERVER_ERROR;
    }
?>
<table width="100%">
  <tr>
    <td align="right">
    <form name="installForm2" id="installForm2" action="index.php" method="post">
      <input type="hidden" name="language" value="<?php echo $language_selected; ?>">
      <input type="image" src="includes/languages/<?php echo $language_selected; ?>/images/buttons/button_retry.gif" alt="<?php echo IMAGE_RETRY; ?>" id="inputButton" />
    </form>
    </td>
  </tr>
</table>

<?php

  } else {  
  echo '<p class="messageStackSuccess">' . TEXT_SERVER_SUCCESS . '</p>';
?>
<table width="100%">
  <tr>
    <td align="right">
    <form name="installForm2" id="installForm2" action="install.php" method="post">
      <input type="hidden" name="language" value="<?php echo $language_selected; ?>">
      <input type="image" src="includes/languages/<?php echo $language_selected; ?>/images/buttons/button_continue.gif" alt="<?php echo IMAGE_CONTINUE; ?>" id="inputButton" />
    </form>
    </td>
  </tr>
</table>

<?php
  }
?>

  </div>
</div>
