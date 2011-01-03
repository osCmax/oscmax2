<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// calculate the previous and next
  if (isset($_GET['manufacturers_id'])) { 
    $products_ids = tep_db_query("select p.products_id from " . TABLE_PRODUCTS . " p where p.products_status = '1' and p.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'");
    $category_name_query = tep_db_query("select manufacturers_name from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'");
    $category_name_row = tep_db_fetch_array($category_name_query);
    $prev_next_in = $category_name_row['manufacturers_name'];
    $fPath = 'manufacturers_id=' . (int)$_GET['manufacturers_id'];
  } else {
    if (!$current_category_id) {
      $cPath_query = tep_db_query ("select categories_id FROM " . TABLE_PRODUCTS_TO_CATEGORIES . " where products_id = '" .  (int)$_GET['products_id'] . "'");
      $cPath_row = tep_db_fetch_array($cPath_query);
      $current_category_id = $cPath_row['categories_id'];
    }
	$products_ids = tep_db_query("select p.products_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_status = '1' and p.products_id = p2c.products_id and p2c.categories_id = '" . (int)$current_category_id . "'");
    $category_name_query = tep_db_query("select categories_name from " . TABLE_CATEGORIES_DESCRIPTION . " where categories_id = '" . (int)$current_category_id . "' and language_id = '" . (int)$languages_id . "'");
    $category_name_row = tep_db_fetch_array($category_name_query);
    $prev_next_in = ' <a href="' . tep_href_link(FILENAME_DEFAULT, tep_get_path($current_category_id = '')) . '">' . $category_name_row['categories_name'] . '</a>';
    $fPath = 'cPath=' . $cPath;
  }

// Check if there is at least 1 product
  if($product_row = tep_db_fetch_array($products_ids)) {
    $position = 1;
    $counter = tep_db_num_rows($products_ids);
// Just in case there is no other product, previous and next will be the same as the current product
    $previous = $next_item = $product_row['products_id'];
// First row is the current product, so previous product will be the last one
    if($product_row['products_id'] == (int)$_GET['products_id']) {
// Set the next row
      if($product_row = tep_db_fetch_array($products_ids)) {
        $previous = $next_item = $product_row['products_id'];
        while ($product_row = tep_db_fetch_array($products_ids))
        $previous = $product_row['products_id'];
      }
    } else {// First row is not the current one
// Look for the current item
      while ($product_row = tep_db_fetch_array($products_ids)) {
        $position++;
// This is the current product, we now just need to look at the next one if exist
        if($product_row['products_id'] == (int)$_GET['products_id']) {
          if($product_row = tep_db_fetch_array($products_ids))
          $next_item = $product_row['products_id'];
        break;
        }
// Update previous id
        else
          $previous = $product_row['products_id'];
        }
    }
	
// Products Id of the first product in the category
    tep_db_data_seek($products_ids, 0);
	$product_row = tep_db_fetch_array($products_ids);
	$first = $product_row['products_id'];
	
// Products Id of the last product in the category
    tep_db_data_seek($products_ids, $counter-1);
	$product_row = tep_db_fetch_array($products_ids);
	$last = $product_row['products_id'];
	
	if ($counter > 1) {
?>
	  <!-- Next Previous Module Starts -->
		<table border="0" cellspacing="0" cellpadding="3">
          <tr>
<?php
          if ($first != (int)$_GET['products_id']) {
?>
            <td align="right" class="main" width="40"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, "$fPath&products_id=$first") . '">' . tep_image(DIR_WS_ICONS . 'control_start.png', ALT_FIRST_PRODUCT) . '</a>  <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, "$fPath&products_id=$previous") . '">' . tep_image(DIR_WS_ICONS . 'control_rewind.png', ALT_PREVIOUS_PRODUCT) . '</a>'; ?></td>
<?php
          } else {
?>
            <td align="right" class="main" width="40">&nbsp;</td>
<?php
  		  }
?>

            <td align="center" class="main"><?php echo PREV_NEXT_PRODUCT . $position . PREV_NEXT_OF . $counter . PREV_NEXT_IN . $prev_next_in; ?></td>
<?php
  		  if ($last != (int)$_GET['products_id']) {
?>
            <td align="left" class="main" width="40"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, "$fPath&products_id=$next_item") . '">' . tep_image(DIR_WS_ICONS . 'control_fastforward.png', ALT_NEXT_PRODUCT) . '</a>  <a href="' . tep_href_link(FILENAME_PRODUCT_INFO, "$fPath&products_id=$last") . '">' . tep_image(DIR_WS_ICONS . 'control_end.png', ALT_LAST_PRODUCT) . '</a>'; ?></td>
<?php
  		  } else {
?>
            <td align="left" class="main" width="40">&nbsp;</td>
<?php
  }
?>
          </tr>
        </table>
        <table cellpadding="0" cellspacing="0" border="0">
    	  <tr>
            <td colspan="3"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
    	  </tr>
		</table>
      <!-- Next Previous Module Ends -->
<?php
    }
  }
?>