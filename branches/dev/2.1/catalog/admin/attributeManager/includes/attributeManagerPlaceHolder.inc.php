<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
/*  
  Copyright © 2006 Kangaroo Partners
  http://kangaroopartners.com
  osc@kangaroopartners.com
*/


		require_once('attributeManager/classes/attributeManagerConfig.class.php');

if( isset($_GET['pID'])){

		require_once('attributeManager/classes/stopDirectAccess.class.php');
		stopDirectAccess::authorise(AM_SESSION_VALID_INCLUDE);
		
		echo '<div id="attributeManager">';
		echo '</div>';

} else {
		echo '<div id="topBar">';
		echo '<table><tr><td>' . tep_image(DIR_WS_ICONS . 'information.png', IMAGE_ICON_INFO).  '</td><td>' . AM_AJAX_FIRST_SAVE . '</td></tr></table>';
		echo '</div>';
}
?>
