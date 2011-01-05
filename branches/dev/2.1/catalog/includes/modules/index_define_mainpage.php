<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  $information_query = tep_db_query("SELECT information_title, information_description FROM " . TABLE_INFORMATION . " WHERE information_id='" . (int)DEFINE_MAINPAGE_TEXT_INFO_NO . "' and language_id='" . (int)$languages_id ."'");
  $information = tep_db_fetch_array($information_query);
  $title = stripslashes($information['information_title']);
  $page_description = stripslashes($information['information_description']);
	
  // Added as noticed by infopages module
  if (!preg_match("/([\<])([^\>]{1,})*([\>])/i", $page_description)) {
	$page_description = str_replace("\r\n", "<br>\r\n", $page_description); 
  }


?>
<!-- index define mainpage //-->
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td class="main"><?php echo $page_description; ?></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
        </table>
<!-- index define mainpage eof //-->
