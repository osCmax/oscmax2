<?php
/*
$Id: popup_image.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.
// For adding in contribution or modification - parts of this file has been moved to: catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
//       catalog\templates\fallback\contents\<filename>.tpl.php as a default (sub 'fallback' with your current template to see if there is a template specife change).
// (Sub 'fallback' with your current template to see if there is a template specific file.)

  require('includes/application_top.php');

// LINE ADDED: MOD - dynamic mopics functions
  require(DIR_WS_FUNCTIONS . 'dynamic_mopics.php');

// LINE ADDED
  require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . FILENAME_POPUP_IMAGE);

  $navigation->remove_current_page();

  $products_query = tep_db_query("select pd.products_name, p.products_image from " . TABLE_PRODUCTS . " p left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id where p.products_status = '1' and p.products_id = '" . (int)$HTTP_GET_VARS['pID'] . "' and pd.language_id = '" . (int)$languages_id . "'");
  $product_info = tep_db_fetch_array($products_query);

// BOF: MOD - dynamic mopics functions
// Set the large image's basename; replaces "imagebase" in the user's pattern
  $image_base_lg = mopics_get_imagebase($product_info['products_image'], DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR);

// Validate the image type
  $allowed_types = explode(',', str_replace(' ', '', DYNAMIC_MOPICS_BIG_IMAGE_TYPES));
  if (!in_array($_GET['type'], $allowed_types)) {
    die("Requested image was not found.");
  }

  if (isset($_GET['pic']) && tep_not_null($_GET['pic'])) {

  // Get the current count
    $i = $_GET['pic'];

    // Set the search for the str_replace pattern search/replace
    $search = array('imagebase', mopics_match_pattern(DYNAMIC_MOPICS_PATTERN));

    // Set the replace for the str_replace pattern search/replace
    $replace = array($image_base_lg, $i);

    // Set the large image
    $image = str_replace($search, $replace, DYNAMIC_MOPICS_PATTERN) . '.' . $_GET['type'];

  } else {
    $image = $image_base_lg . '.' . $_GET['type'];
  }
// BOF: MOD - dynamic mopics functions
  $content = CONTENT_POPUP_IMAGE;
  $javascript = $content . '.js';
  $body_attributes = ' onload="resize();"';

  require(DIR_WS_TEMPLATES . TEMPLATENAME_POPUP);

  require('includes/application_bottom.php');
?>