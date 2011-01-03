<?php
/*
  $Id: compatibility.php 1739 2007-12-20 00:52:16Z user $

  osCMax Power E-Commerce
  http://www.oscmax.com

  Copyright 2009 osCMax

  Released under the GNU General Public License
*/

  if (PHP_VERSION >= 4.1) {
    $HTTP_GET_VARS =& $_GET;
    $HTTP_POST_VARS =& $_POST;
    $HTTP_COOKIE_VARS =& $_COOKIE;
    $HTTP_SESSION_VARS =& $_SESSION;
    $HTTP_SERVER_VARS =& $_SERVER;
  } else {
    if (!is_array($_GET)) $_GET = array();
    if (!is_array($_POST)) $_POST = array();
    if (!is_array($HTTP_COOKIE_VARS)) $HTTP_COOKIE_VARS = array();
  }

  if (!function_exists('is_numeric')) {
    function is_numeric($param) {
      return ereg('^[0-9]{1,50}.?[0-9]{0,50}$', $param);
    }
  }
?>
