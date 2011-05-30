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
                  <td><?php if ($corner_top_left == 'rounded') { $corner = 'top_left.png'; } else { $corner = 'top_spacer.png'; } ?><?php echo tep_image(bts_select('images', 'infobox/' . $corner)); ?></td>
                  <td class="infoBoxHeading" width="100%" >&nbsp;<?php echo $boxHeading; ?></td>
                  <td class="infoBoxHeading"><?php if (isset($boxLink)) echo $boxLink; ?></td>
                  <td><?php if ($corner_top_right == 'rounded') { $corner = 'top_right.png'; } else { $corner = 'top_spacer.png'; } ?><?php echo tep_image(bts_select('images', 'infobox/' . $corner)); ?></td>
                </tr>
              </table>
              <table border="0" width="100%" cellspacing="0" cellpadding="0" class="infoBoxColumn">
                <tr>
                  <td>
                    <table border="0" width="100%" cellspacing="0" cellpadding="3">
                      <tr>
                        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '1'); ?></td>
                      </tr>
                      <tr>
                        <td class="boxText"<?php if (isset($boxContent_attributes)) echo $boxContent_attributes; ?>><?php echo $boxContent; ?></td>
                      </tr>
                      <tr>
                        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '1'); ?></td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td><?php if ($corner_bottom_left == 'rounded') { $corner = 'bottom_left.png'; } else { $corner = 'bottom_left_sq.png'; } ?><?php echo tep_image(bts_select('images', 'infobox/' . $corner)); ?></td>
                  <td width="100%" height="5" class="infoBoxBottom"></td>
                  <td><?php if ($corner_bottom_left == 'rounded') { $corner = 'bottom_right.png'; } else { $corner = 'bottom_right_sq.png'; } ?><?php echo tep_image(bts_select('images', 'infobox/' . $corner)); ?></td>
                </tr>
              </table>
            </td>
          </tr>
