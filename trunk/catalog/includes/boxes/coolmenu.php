<?php
/* ------------------------------------------------

  coolMenu for osCommerce
  
  author:	Andreas Kothe 
  url:		http://www.oddbyte.de


  Released under the GNU General Public License
  
  ------------------------------------------------ 
*/

?>
<!-- coolMenu //-->

<!-- copyright 2003 Andreas Kothe - www.oddbyte.de // -->


<?php
 $boxHeading = BOX_HEADING_CATEGORIES;
  $corner_left = 'rounded';
  $corner_right = 'square';
  $box_base_name = 'categories'; // for easy unique box template setup (added BTSv1.2)

  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)


  



include (bts_select('boxes', $box_base_name)); // BTS 1.5
?>

<!-- coolMenu_eof //-->
