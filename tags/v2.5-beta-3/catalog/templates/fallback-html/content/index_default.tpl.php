<?php
/*
$Id: index_default.tpl.php 1026 2011-01-07 18:18:43Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">      
            <tr>
              <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '3'); ?></td>
            </tr>
            <tr>
              <td>          
                <!-- Page Module Controller -->
                    <?php include (DIR_WS_MODULES . FILENAME_INDEX_PAGE_MODULES); ?>
                <!-- Page Module Controller -->
              </td>
            </tr>  
          </table>