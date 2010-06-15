<?php
/*
$Id: languages.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.

  if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
?>
<!-- languages //-->
<?php
  $boxHeading = BOX_HEADING_LANGUAGES;
  
  $corner_top_left = 'rounded';
  $corner_top_right = 'rounded';
  $corner_bottom_left = 'rounded';
  $corner_bottom_right = 'rounded'; 
    
  $boxContent_attributes = ' align="center"';
  $boxLink = '';
  
  $box_base_name = 'languages'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

  if (!isset($lng) || (isset($lng) && !is_object($lng))) {
    include(DIR_WS_CLASSES . 'language.php');
    $lng = new language;
  }

  $boxContent = '';
  reset($lng->catalog_languages);
  while (list($key, $value) = each($lng->catalog_languages)) {
    $boxContent .= ' <a href="' . tep_href_link(basename($PHP_SELF), tep_get_all_get_params(array('language', 'currency')) . 'language=' . $key, $request_type) . '">' . tep_image(DIR_WS_LANGUAGES .  $value['directory'] . '/images/' . $value['image'], $value['name']) . '</a> ';
  }





include (bts_select('boxes', $box_base_name)); // BTS 1.5
  $boxContent_attributes = '';
}
?>