<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/


    if (!defined ('DIR_FS_CATALOG')) die ("Access denied.");
    /* infobox template  */ 
?>
          <tr>
            <td>
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td class="infoBoxHeading"><img src="<?php echo DIR_WS_TEMPLATES;?>images/infobox/<?php switch ($corner_top_left) { case 'square': echo 'top_spacer.png'; break; case 'rounded': echo 'top_left.png'; break;} ?>" border="0" alt=""></td>
                  <td class="infoBoxHeading" width="100%" ><?php echo $boxHeading; ?></td>
                  <td class="infoBoxHeading"><?php if (isset($boxLink)) echo $boxLink; ?></td>
                  <td class="infoBoxHeading"><img src="<?php echo DIR_WS_TEMPLATES;?>images/infobox/<?php switch ($corner_top_right) { case 'square': echo 'top_spacer.png';    break; case 'rounded': echo 'top_right.png'; break;} ?>" border="0" alt=""></td>
                </tr>
              </table>
              <table border="0" width="100%" cellspacing="0" cellpadding="0" class="infoBoxColumn">
                <tr>
                  <td>
                    <table border="0" width="100%" cellspacing="0" cellpadding="3">
                      <tr>
                        <td><img src="images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
                      </tr>
                      <tr>
                        <td class="boxText"<?php if (isset($boxContent_attributes)) echo $boxContent_attributes; ?>><?php echo $boxContent; ?></td>
                      </tr>
                      <tr>
                        <td><img src="images/pixel_trans.gif" border="0" alt="" width="100%" height="1"></td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td><img src="<?php echo DIR_WS_TEMPLATES;?>images/infobox/<?php switch ($corner_bottom_left) { case 'square': echo 'bottom_left_sq.png'; break; case 'rounded': echo 'bottom_left.png'; break;} ?>" border="0" alt=""></td>
                  <td width="100%" height="5" class="infoBoxBottom"></td>
                  <td><img src="<?php echo DIR_WS_TEMPLATES;?>images/infobox/<?php switch ($corner_bottom_right) { case 'square': echo 'bottom_right_sq.png';   break; case 'rounded': echo 'bottom_right.png'; break;} ?>" border="0" alt=""></td>
                </tr>
              </table>
            </td>
          </tr>
