<?php
/*
$Id: reviews.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.

  if (isset($_GET['products_id'])) {
  	
?>
<!-- reviews //-->
<?php
  $boxHeading = BOX_HEADING_REVIEWS;
  $corner_left = 'square';
  $corner_right = 'square';
  $boxLink = '<a href="' . tep_href_link(FILENAME_REVIEWS) . '"><img src="' . DIR_WS_TEMPLATES . 'images/more.png" border="0" alt="more" title=" more " width="16" height="16"></a>';
  $box_base_name = 'reviews'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

  $random_select = "select r.reviews_id, r.reviews_rating, p.products_id, p.products_image, pd.products_name from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_status = '1' and p.products_id = r.products_id and r.reviews_id = rd.reviews_id and rd.languages_id = '" . (int)$languages_id . "' and p.products_id = pd.products_id and pd.language_id = '" . (int)$languages_id . "'";
  if (isset($_GET['products_id'])) {
    $random_select .= " and p.products_id = '" . (int)$_GET['products_id'] . "'";
  }
  $random_select .= " order by r.reviews_id desc limit " . MAX_RANDOM_SELECT_REVIEWS;
  $random_product = tep_random_select($random_select);

  if ($random_product) {
// display random review box
    $review_query = tep_db_query("select substring(reviews_text, 1, 60) as reviews_text from " . TABLE_REVIEWS_DESCRIPTION . " where reviews_id = '" . (int)$random_product['reviews_id'] . "' and languages_id = '" . (int)$languages_id . "'");
    $review = tep_db_fetch_array($review_query);

    $review = tep_break_string(tep_output_string_protected($review['reviews_text']), 15, '-<br>');

    $boxContent = '<div align="center"><a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $random_product['products_id'] . '&reviews_id=' . $random_product['reviews_id']) . '">' . tep_image(DIR_WS_IMAGES . $random_product['products_image'], $random_product['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></div><a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_INFO, 'products_id=' . $random_product['products_id'] . '&reviews_id=' . $random_product['reviews_id']) . '">' . $review . ' ..</a><br><div align="center">' . tep_image(DIR_WS_IMAGES . 'icons/stars_' . $random_product['reviews_rating'] . '.gif' , sprintf(BOX_REVIEWS_TEXT_OF_5_STARS, $random_product['reviews_rating'])) . '</div>';
  } elseif (isset($_GET['products_id'])) {
// display 'write a review' box
    $boxContent = '<table border="0" cellspacing="0" cellpadding="2"><tr><td class="infoBoxContents" align="center"><a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, 'products_id=' . $_GET['products_id']) . '">' . tep_image(DIR_WS_IMAGES . 'box_write_review.gif', IMAGE_BUTTON_WRITE_REVIEW) . '</a></td></tr><tr><td class="infoBoxContents"><a href="' . tep_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, 'products_id=' . $_GET['products_id']) . '">' . BOX_REVIEWS_WRITE_REVIEW .'</a></td></tr></table>';
  } else {
// display 'no reviews' box
    $boxContent = BOX_REVIEWS_NO_REVIEWS;
  }





include (bts_select('boxes', $box_base_name)); // BTS 1.5
  $boxLink = '';
}  
?>
<!-- reviews_eof //-->
