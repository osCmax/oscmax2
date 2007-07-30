<?php
/*
$Id: install.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application.php');

  $page_file = 'install.php';
  $page_title = 'Installation';

  switch ($HTTP_GET_VARS['step']) {
    case '2':
      if (osc_in_array('database', $HTTP_POST_VARS['install'])) {
        $page_contents = 'install_2.php';
      } elseif (osc_in_array('configure', $HTTP_POST_VARS['install'])) {
        $page_contents = 'install_4.php';
      } else {
        $page_contents = 'install.php';
      }
      break;
    case '3':
      if (osc_in_array('database', $HTTP_POST_VARS['install'])) {
        $page_contents = 'install_3.php';
      } else {
        $page_contents = 'install.php';
      }
      break;
    case '4':
      if (osc_in_array('configure', $HTTP_POST_VARS['install'])) {
        $page_contents = 'install_4.php';
      } else {
        $page_contents = 'install.php';
      }
      break;
    case '5':
      if (osc_in_array('configure', $HTTP_POST_VARS['install'])) {
        if (isset($HTTP_POST_VARS['ENABLE_SSL']) && ($HTTP_POST_VARS['ENABLE_SSL'] == 'true')) {
          $page_contents = 'install_5.php';
        } else {
          $page_contents = 'install_6.php';
        }
      } else {
        $page_contents = 'install.php';
      }
      break;
    case '6':
      if (osc_in_array('configure', $HTTP_POST_VARS['install'])) {
        $page_contents = 'install_6.php';
      } else {
        $page_contents = 'install.php';
      }
      break;
    case '7':
      if (osc_in_array('configure', $HTTP_POST_VARS['install'])) {
        $page_contents = 'install_7.php';
      } else {
        $page_contents = 'install.php';
      }
      break;
    default:
      $page_contents = 'install.php';
  }

  require('templates/main_page.php');
?>
