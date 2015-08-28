<?php
/*
$Id: slideshow.php 1857 2012-06-20 01:21:38Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>

<?php // Set conditional load of showcase
  $LoadSlideshowJS=true;
?>
<!-- slideshow module starts -->
    <div class="hidden-xs">
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td>
          <?php
          $slideshow_query = tep_db_query("select slideshow_image from " . TABLE_SLIDESHOW . " where NOT find_in_set('" . $customer_group_id . "', slideshow_cg_hide) and slideshow_active = 'yes' order by slideshow_sort_order"); 
		  $slideshow = tep_db_fetch_array($slideshow_query); 
          $images_string = HTTP_SERVER . DIR_WS_HTTP_CATALOG . DIR_WS_IMAGES . 'slideshow/' . $slideshow['slideshow_image'] ;
          ?>
           <div style="background-image:url( <?php echo $images_string; ?>);height:<?php echo SLIDESHOW_HEIGHT;?>px;width:<?php echo SLIDESHOW_WIDTH;?>px">
           <div id="slideshow"></div>
           </div>
        </td>
      </tr>
    </table>
    </div>
<!-- slideshow module ends -->