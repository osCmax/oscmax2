<?php
/*
$Id$
  orig : performance.php,v 1.5 2004/11/21 00:04:53 Chemo Exp $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  if (DISPLAY_PAGE_PARSE_TIME == 'true') {
    $time_start = explode(' ', PAGE_PARSE_START_TIME);
    $time_end = explode(' ', microtime());
    $parse_time = number_format(($time_end[1] + $time_end[0] - ($time_start[1] + $time_start[0])), 3);
    echo '<div align="center"><span class="smallText">Current Parse Time: <b>' . $parse_time . ' s</b> with <b>' . sizeof($debug['QUERIES']) . ' queries</b></span></div>';
	
    if (DISPLAY_QUERIES == 'true') {
      echo '<p class="main"><b>QUERY DEBUG:</b> ';
      print_r($debug);
      echo '</p><hr>';
      echo '<p class="main"><b>SESSION:</b> ';
      print_r($_SESSION);
      echo '</p><hr>';
      echo '<p class="main"><b>COOKIE:</b> ';
      print_r($_COOKIE);
	  echo '</p><hr>';
      echo '<p class="main"><b>POST:</b> ';
      print_r($_POST);
      echo '</p><hr>';
      echo '<p class="main"><b>GET:</b>';
      print_r($_GET);
	  echo '</p>';
    } # END if request
  }
  unset($debug);
?>