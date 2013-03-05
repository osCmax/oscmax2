<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// Set the level of error reporting
  error_reporting(E_ALL & ~E_NOTICE);

  require('includes/functions/compatibility.php');
  require('includes/functions/general.php');
  require('includes/functions/database.php');
  require('includes/functions/html_output.php');
  
// Adds language defines to installer
  if (isset($_GET['language'])) {
        $language_selected = ($_GET['language']);
  }
  if (isset($_POST['language'])) {
        $language_selected = ($_POST['language']);
  }
  
  if (file_exists('includes/languages/' . $language_selected . '/core.php')) {
    require_once('includes/languages/' . $language_selected . '/core.php');
  } else {
    if (file_exists('includes/languages/english/core.php')) {
      require_once('includes/languages/english/core.php');
    }
  }
  
  define('PROJECT_VERSION', 'v2.5.3');
?>
