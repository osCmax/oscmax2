<?php
/*
$Id: performance.php 3 2006-05-27 04:59:07Z user $
  orig : performance.php,v 1.5 2004/11/21 00:04:53 Chemo Exp $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

  if (DISPLAY_PAGE_PARSE_TIME == 'true') {
    $time_start = explode(' ', PAGE_PARSE_START_TIME);
    $time_end = explode(' ', microtime());
    $parse_time = number_format(($time_end[1] + $time_end[0] - ($time_start[1] + $time_start[0])), 3);
    echo '<div align="center"><span class="smallText">Current Parse Time: <b>' . $parse_time . ' s</b> with <b>' . sizeof($debug['QUERIES']) . ' queries</b></span></div>';
    if (DISPLAY_QUERIES == 'true') {
      echo '<b>QUERY DEBUG:</b> ';
      print_r($debug);
      echo '<hr>';
      echo '<b>SESSION:</b> ';
      print_r($_SESSION);
      echo '<hr>';
      echo '<b>COOKIE:</b> ';
      print_r($_COOKIE);
	  echo '<hr>';
      echo '<b>POST:</b> ';
      print_r($_POST);
      echo '<hr>';
      echo '<b>GET:</b> ';
      print_r($_GET);
    } # END if request
  }
  unset($debug);
?>