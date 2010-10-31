<?php
/*
$Id: install.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2008 osCMax

  Released under the GNU General Public License
*/

  require('includes/application.php');

  $page_contents = 'install.php';

  if (isset($_GET['step']) && is_numeric($_GET['step'])) {
    switch ($_GET['step']) {
      case '2':
        $page_contents = 'install_2.php';
        break;

      case '3':
        $page_contents = 'install_3.php';
        break;

      case '4':
        $page_contents = 'install_4.php';
        break;
    }
  }

  require('templates/main_page.php');
?>
