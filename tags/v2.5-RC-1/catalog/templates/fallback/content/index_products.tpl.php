<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

/* bof catdesc for bts1a */
// Get the category name and description from the database
    $category_query = tep_db_query("select cd.categories_name, cd.categories_heading_title, cd.categories_description, c.categories_image from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . (int)$current_category_id . "' and cd.categories_id = '" . (int)$current_category_id . "' and cd.language_id = '" . (int)$languages_id . "'");
    $category = tep_db_fetch_array($category_query);
/* bof catdesc for bts1a */
?>

    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '4'); ?></td>
      </tr>

      <?php if ( (ALLOW_CATEGORY_DESCRIPTIONS == 'true') && ( (tep_not_null($category['categories_heading_title'])) || (isset($_GET['manufacturers_id'])) || (isset($_GET['new_products'])) || (isset($_GET['show_specials'])) ) ) { ?>
      <tr>
        <td class="productinfo_header">
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="pageHeading">
              
<?php	
// Get the right image for the top-right
    $image = DIR_WS_IMAGES . 'table_background_list.gif';
	$image_folder = '';
    if (isset($_GET['manufacturers_id'])) {
      $manufacturer_query = tep_db_query("select m.manufacturers_image, m.manufacturers_name, mi.manufacturers_description from " . TABLE_MANUFACTURERS . " m, " . TABLE_MANUFACTURERS_INFO . " mi where m.manufacturers_id = mi.manufacturers_id and mi.languages_id = '" . (int)$languages_id . "' and m.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'");
	  while ($manufacturer = tep_db_fetch_array($manufacturer_query)) {
        $image = $manufacturer['manufacturers_image'];
	    $name = $manufacturer['manufacturers_name'];
		$description = $manufacturer['manufacturers_description'];
	  }
	  $image_folder = MANUFACTURERS_IMAGES_DIR;
    } elseif ($current_category_id) {
      $image = tep_db_query("select categories_image from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "' and find_in_set('" . $customer_group_id . "', categories_hide_from_groups) = 0");
      $image = tep_db_fetch_array($image);
      $image = $image['categories_image'];
	  $image_folder = CATEGORY_IMAGES_DIR;
    }
	
/* bof catdesc for bts1a, replacing "echo HEADING_TITLE;" by "categories_heading_title" */
             if (tep_not_null($category['categories_heading_title'])) {
                 echo $category['categories_heading_title'];
               } elseif (isset($_GET['new_products']) && tep_not_null($_GET['new_products'])) { 
			     echo TEXT_LATEST_PRODUCTS;
			   } elseif (isset($_GET['show_specials']) && tep_not_null($_GET['show_specials'])) { 
			     echo TEXT_SPECIALS;
			   } elseif (isset($_GET['manufacturers_id'])) { 
			     echo $name;
			   }
/* eof catdesc for bts1a */ ?>

   <?php if (tep_not_null($category['categories_heading_title'])) {
           if ( (file_exists(DIR_WS_IMAGES . $image_folder . $image)) && ($image !='') ) {
		     echo tep_image(DIR_WS_IMAGES . $image_folder . $image, $category['categories_heading_title'], HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT, 'style="float:right; margin:5px"');
		   }
         } else { 
		   if ( (file_exists(DIR_WS_IMAGES . $image_folder . $image)) && ($image !='') )  { 
		     echo tep_image(DIR_WS_IMAGES . $image_folder . $image, '', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT, 'style="float:right; margin:5px;"');
		   }
         }
		 if ( (tep_not_null($category['categories_description'])) && ($category['categories_description'] != '<br />') ) {
	        echo $category['categories_description']; 
         }
		 // Add manufacturer description
		 if ( (isset($description)) && (tep_not_null($description)) && ($description != '<br />') ) {
		   echo $description;
		 }
         ?>
          </table>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
          <?php } // end if (ALLOW_CATEGORY_DESCRIPTIONS == 'true') ?>
      <tr>
        <td>
        <?php
        // initial set from admin
        if ( (!isset($_GET['gridlist'])) && (!isset($_SESSION['gridlist'])) ) {
		  if (PRODUCT_LIST_TYPE == 0) { $gridlist = 'list'; } else { $gridlist = 'grid'; }
		}
		
        // current request
        if (isset($_GET['gridlist'])) { $gridlist = $_GET['gridlist']; }

        // previous request
        if (isset($_SESSION['gridlist'])) { $gridlist = $_SESSION['gridlist']; }

        if ($gridlist == 'list') {
          include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING);
        } else {
          include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING_COL);
        }
        ?>
        </td>
      </tr>
    </table>