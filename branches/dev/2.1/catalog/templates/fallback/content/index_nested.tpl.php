<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '4'); ?></td>
      </tr>
      
      <?php if (ALLOW_CATEGORY_DESCRIPTIONS == 'true') { ?>
      <tr>
        <td class="productinfo_header">
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="pageHeading">
              <?php
/* bof catdesc for bts1a, replacing "echo HEADING_TITLE;" by "categories_heading_title" */
              if (tep_not_null($category['categories_heading_title'])) {
                 echo $category['categories_heading_title'];
              }
			  $image = tep_db_query("select categories_image from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "' and find_in_set('" . $customer_group_id . "', categories_hide_from_groups) = 0");
              $image = tep_db_fetch_array($image);
			  
			  echo tep_image(DIR_WS_IMAGES . CATEGORY_IMAGES_DIR . $image['categories_image'], $category['categories_heading_title'], HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT, 'style="float:right; margin:5px;"');
			  
			  if (tep_not_null($category['categories_description'])) {
		        echo $category['categories_description'];
              }
			  ?>
              </td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <?php } // end if (ALLOW_CATEGORY_DESCRIPTIONS == 'true') ?>
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td>
<?php
//    if (isset($cPath) && strpos('_', $cPath)) {
// // check to see if there are deeper categories within the current category
//       $category_links = array_reverse($cPath_array);
//       for($i=0, $n=sizeof($category_links); $i<$n; $i++) {
//      $categories_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$category_links[$i] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "'");
//         $categories = tep_db_fetch_array($categories_query);
//         if ($categories['total'] < 1) {
//           // do nothing, go through the loop
//         } else {
//         $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, pcategories.parent_id as grand_parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES . " AS pcategories, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$category_links[$i] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and pcategories.categories_id = '" . (int)$category_links[$i] . "' order by c.sort_order, cd.categories_name");
//           break; // we've found the deepest category the customer is in
//         }
//       }
//     } else {
//    $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, pcategories.parent_id as grand_parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES . " AS pcategories, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and pcategories.categories_id = '" . (int)$current_category_id . "' order by c.sort_order, cd.categories_name");
//     }

    if (isset($cPath) && strpos('_', $cPath)) {
// check to see if there are deeper categories within the current category
      $category_links = array_reverse($cPath_array);
      for($i=0, $n=sizeof($category_links); $i<$n; $i++) {
// BOF SPPC Hide categories from groups
        $categories_query = tep_db_query("select count(*) as total from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$category_links[$i] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and find_in_set('" . $customer_group_id . "', categories_hide_from_groups) = 0");
        $categories = tep_db_fetch_array($categories_query);
        if ($categories['total'] < 1) {
          // do nothing, go through the loop
        } else {
          $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, pcategories.parent_id as grand_parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES . " AS pcategories, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$category_links[$i] . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and pcategories.categories_id = '" . (int)$category_links[$i] . "' and find_in_set('" . $customer_group_id . "', c.categories_hide_from_groups) = 0 order by c.sort_order, cd.categories_name");
          break; // we've found the deepest category the customer is in
        }
      }
    } else {
      $categories_query = tep_db_query("select c.categories_id, cd.categories_name, c.categories_image, c.parent_id, pcategories.parent_id as grand_parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES . " AS pcategories, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . (int)$current_category_id . "' and c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and pcategories.categories_id = '" . (int)$current_category_id . "' and find_in_set('" . $customer_group_id . "', c.categories_hide_from_groups) = 0 order by c.sort_order, cd.categories_name");
    }
// EOF SPPC Hide categories from groups

    $number_of_categories = tep_db_num_rows($categories_query);

    $row = 0;
	$column = 0;
	
    while ($categories = tep_db_fetch_array($categories_query)) {
	  	
	  $cPath_new = tep_get_path($categories['categories_id'], $categories['parent_id'], $categories['grand_parent_id']);	
		
	  $list_box_contents[$row][$column] = array('align' => 'center',
                                                'params' => 'class="categoryListing-data"',
                                                'text'  => '<a href="' . tep_href_link(FILENAME_DEFAULT, $cPath_new) . '">' . tep_image(DIR_WS_IMAGES . CATEGORY_IMAGES_DIR . $categories['categories_image'], $categories['categories_name'], SUBCATEGORY_IMAGE_WIDTH, SUBCATEGORY_IMAGE_HEIGHT) . '<br>' . $categories['categories_name'] . '</a>');
												
	  $column ++;
	  
	  //Adds a spacer column between the product column - checks if it is the last column - if it is leave it out.
	  if ($column != PRODUCT_LIST_NUM_COLUMNS + 2) { // Adds 2 to the column count to allow for spacers
	  $list_box_contents[$row][$column] = array('align' => 'center',
                                                'params' => 'class="categoryListing-data-spacer"',
                                                'text'  => tep_draw_separator('pixel_trans.gif', '10', '10'));
	  }
	  $column ++;
	  
	  if ($column >= PRODUCT_LIST_NUM_COLUMNS + (PRODUCT_LIST_NUM_COLUMNS-1)) {
        	  $row ++;
			  // Add a row spacer between the product rows
			  $list_box_contents[$row][0] = array('align' => 'center',
                                                'params' => 'class="categoryListing-data-spacer"',
                                                'text'  => tep_draw_separator('pixel_trans.gif', '10', '10'));
			  
			  $row ++;
        	  $column = 0;
	  }	
	}
		
 //     $rows++;
 //     $cPath_new = tep_get_path($categories['categories_id'], $categories['parent_id'], $categories['grand_parent_id']);
 //     $width = (int)(100 / MAX_DISPLAY_CATEGORIES_PER_ROW) . '%';
      
//	  echo '                <td align="center" class="productListing-data" width="' . $width . '" valign="top"><a href="' . tep_href_link(FILENAME_DEFAULT, $cPath_new) . '">' . tep_image(DIR_WS_IMAGES . CATEGORY_IMAGES_DIR . $categories['categories_image'], $categories['categories_name'], SUBCATEGORY_IMAGE_WIDTH, SUBCATEGORY_IMAGE_HEIGHT) . '<br>' . $categories['categories_name'] . '</a></td><td>' . tep_draw_separator('pixel_trans.gif', '10', '10') . $rows/ MAX_DISPLAY_CATEGORIES_PER_ROW . ':' . floor($rows / MAX_DISPLAY_CATEGORIES_PER_ROW) . '</td>' . "\n";
  //    if ((($rows / MAX_DISPLAY_CATEGORIES_PER_ROW) == floor($rows / MAX_DISPLAY_CATEGORIES_PER_ROW)) && ($rows != $number_of_categories)) {
    //    echo '              </tr>' . "\n";//
//		echo '              <tr><td>' . tep_draw_separator('pixel_trans.gif', '10', '10') . '</td></tr>';
  //      echo '              <tr>' . "\n";
  //    }
 //   }
	
	new productListingBox($list_box_contents);

// needed for the new products module shown below
    $new_products_category_id = $current_category_id;
?>
                </td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
          </tr>
          <tr>
            <td>          
              <!-- Page Module Controller -->
                <?php include (DIR_WS_MODULES . FILENAME_NESTED_PAGE_MODULES); ?>
              <!-- Page Module Controller -->
            </td>
          </tr>
        </table></td>
      </tr>
    </table>
