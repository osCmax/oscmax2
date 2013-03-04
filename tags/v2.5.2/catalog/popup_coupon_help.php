<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  $navigation->remove_current_page();

  require(bts_select('language', FILENAME_POPUP_COUPON_HELP));
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<base href="<?php echo (($request_type == 'SSL') ? HTTPS_SERVER : HTTP_SERVER) . DIR_WS_CATALOG; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="<?php echo DIR_WS_TEMPLATES; ?>/stylesheet.css">
</head>
<style type="text/css"><!--
BODY { margin-bottom: 10px; margin-left: 10px; margin-right: 10px; margin-top: 10px; }
//--></style>
<body>

<?php
// v5.13: security flaw fixed in query
//  $coupon_query = tep_db_query("select * from " . TABLE_COUPONS . " where coupon_id = '" . $_GET['cID'] . "'");
  $coupon_query = tep_db_query("select * from " . TABLE_COUPONS . " where coupon_id = '" . intval($_GET['cID']) . "'");
  $coupon = tep_db_fetch_array($coupon_query);
  $coupon_desc_query = tep_db_query("select * from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $_GET['cID'] . "' and language_id = '" . $languages_id . "'");
  $coupon_desc = tep_db_fetch_array($coupon_desc_query);
  $text_coupon_help = '';
  
  $text_coupon_help .= sprintf(TEXT_COUPON_HELP_NAME, $coupon_desc['coupon_name']);
  
  if (tep_not_null($coupon_desc['coupon_description'])) $text_coupon_help .= sprintf(TEXT_COUPON_HELP_DESC, $coupon_desc['coupon_description']);
  
  $coupon_amount = $coupon['coupon_amount'];
  switch ($coupon['coupon_type']) {
    case 'F':
    $text_coupon_help .= sprintf(TEXT_COUPON_HELP_FIXED, $currencies->format($coupon['coupon_amount']));
    break;
    case 'P':
    $text_coupon_help .= sprintf(TEXT_COUPON_HELP_FIXED, number_format($coupon['coupon_amount'],2). '%');
    break;
    case 'S':
    $text_coupon_help .= TEXT_COUPON_HELP_FREESHIP;
    break;
    default:
  }
  if ($coupon['coupon_minimum_order'] > 0 ) $text_coupon_help .= sprintf(TEXT_COUPON_HELP_MINORDER, $currencies->format($coupon['coupon_minimum_order']));
  
  if ($coupon['coupon_start_date'] != 0 && $coupon['coupon_expire_date'] != 0) {
    $text_coupon_help .= sprintf(TEXT_COUPON_HELP_DATE, tep_date_short($coupon['coupon_start_date']),tep_date_short($coupon['coupon_expire_date']));
  }
  
  
  // Coupon Category and Product Restrictions
  // Build Category Restrictions
  $coupon_get = tep_db_query("SELECT restrict_to_categories FROM " . TABLE_COUPONS . " WHERE coupon_id='" . $_GET['cID'] . "'");
  $get_result = tep_db_fetch_array($coupon_get);
  if (substr($get_result['restrict_to_categories'], -1) == ',') { // removes trailing ,
    $clean_cat_ids = substr($get_result['restrict_to_categories'], 0, -1); 
  } else {
    $clean_cat_ids = $get_result['restrict_to_categories'];
  }
  
  $cat_ids = explode(",", $clean_cat_ids);
  
  $cats = '';
  for ($i = 0; $i < count($cat_ids); $i++) {
    $result = tep_db_query("SELECT * FROM categories, categories_description WHERE categories.categories_id = categories_description.categories_id and categories_description.language_id = '" . $languages_id . "' and categories.categories_id='" . $cat_ids[$i] . "'");
    if ($row = tep_db_fetch_array($result)) {
      $cats .= '<br>' . $row["categories_name"];
    }
  }
  
  // Build Product Restrictions
  $coupon_get = tep_db_query("SELECT restrict_to_products FROM " . TABLE_COUPONS . " WHERE coupon_id='" . $_GET['cID'] . "'");
  $get_result = tep_db_fetch_array($coupon_get);
  if (substr($get_result['restrict_to_products'], -1) == ',') { // removes trailing ,
    $clean_product_ids = substr($get_result['restrict_to_products'], 0, -1);
  } else {
    $clean_product_ids = $get_result['restrict_to_products'];
  }
  
  $pr_ids = explode(",", $clean_product_ids);
    
  $prods = '';
  for ($i = 0; $i < count($pr_ids); $i++) {
    $result = tep_db_query("SELECT * FROM products, products_description WHERE products.products_id = products_description.products_id and products_description.language_id = '" . $languages_id . "'and products.products_id = '" . $pr_ids[$i] . "'");
    if ($row = tep_db_fetch_array($result)) {
      $prods .= '<br>' . $row['products_name'];
    }
  }
  
  // Only add to output if they are not blank
  if (($prods != '') || ($cats != '')) {
    $text_coupon_help .= '<b>' . TEXT_COUPON_HELP_RESTRICT . '</b>';
    if ($cats != '') $text_coupon_help .= '<br><br><b>' .  TEXT_COUPON_HELP_CATEGORIES . '</b>' . $cats;
	if ($prods != '') $text_coupon_help .= '<br><br><b>' .  TEXT_COUPON_HELP_PRODUCTS . '</b>' . $prods;  
  }

  // Add header
  $info_box_contents = array();
  $info_box_contents[] = array('text' => HEADING_COUPON_HELP);
  
  new infoBoxHeading($info_box_contents, true, true);

  // Add content
  $info_box_contents = array();
  $info_box_contents[] = array('text' => $text_coupon_help);

  new infoBox($info_box_contents);
?>

<p class="smallText" align="right"><?php echo '<a href="javascript:window.close()">' . TEXT_CLOSE_WINDOW . '</a>'; ?></p>

</body>
</html>
<?php require('includes/application_bottom.php'); ?>