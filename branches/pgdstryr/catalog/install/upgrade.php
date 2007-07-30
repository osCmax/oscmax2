<?php
/*
$Id: upgrade.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application.php');

  $page_file = 'upgrade.php';
  $page_title = 'Upgrade';

  switch ($HTTP_GET_VARS['step']) {
    case '2':
      $page_contents = 'upgrade_2.php';
      break;
    case '3':
      $page_contents = 'upgrade_3.php';
      break;
    default:
      $page_contents = 'upgrade.php';
  }

  require('templates/main_page.php');
?>
