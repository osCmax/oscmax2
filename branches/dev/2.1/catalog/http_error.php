<?php
/*
  $Id: http_error.php,v 1.5 2004/06/30 20:55:23 chaicka Exp $

  Contribution based on:

  osCMax Power E-Commerce
  http://www.oscmax.com

  Copyright 2009 osCMax

  Released under the GNU General Public License
*/
  require('includes/application_top.php');

  require(DIR_WS_LANGUAGES . $language . '/' . FILENAME_HTTP_ERROR);

  $content = http_error; 

  include (bts_select('main', $content_template)); // BTSv1.5

  require(DIR_WS_INCLUDES . 'application_bottom.php'); 

?>