<?php
/* bof catdesc for bts1a */
// Get the category name and description from the database
    $category_query = tep_db_query("select cd.categories_name, cd.categories_heading_title, cd.categories_description, c.categories_image from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = '" . (int)$current_category_id . "' and cd.categories_id = '" . (int)$current_category_id . "' and cd.language_id = '" . (int)$languages_id . "'");
    $category = tep_db_fetch_array($category_query);
/* bof catdesc for bts1a */
?>

    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="pageHeading">
<?php
/* bof catdesc for bts1a, replacing "echo HEADING_TITLE;" by "categories_heading_title" */
             if ( (ALLOW_CATEGORY_DESCRIPTIONS == 'true') && (tep_not_null($category['categories_heading_title'])) ) {
                 echo $category['categories_heading_title'];
               } else {
                 echo HEADING_TITLE;
               }
/* eof catdesc for bts1a */ ?>
              </td>
<?php
// optional Product List Filter
//    if (PRODUCT_LIST_FILTER > 0) {
//       if (isset($_GET['manufacturers_id'])) {
//      $filterlist_sql = "select distinct c.categories_id as id, cd.categories_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where p.products_status = '1' and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p2c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' order by cd.categories_name";
//       } else {
//      $filterlist_sql= "select distinct m.manufacturers_id as id, m.manufacturers_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_MANUFACTURERS . " m where p.products_status = '1' and p.manufacturers_id = m.manufacturers_id and p.products_id = p2c.products_id and p2c.categories_id = '" . (int)$current_category_id . "' order by m.manufacturers_name";
//       }
// BOF SPPC Hide products and categories from groups
    if (PRODUCT_LIST_FILTER > 0) {
      if (isset($_GET['manufacturers_id'])) {
        $filterlist_sql = "select distinct c.categories_id as id, cd.categories_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where p.products_status = '1' and find_in_set('" . $customer_group_id . "', categories_hide_from_groups) = 0 and find_in_set('".$customer_group_id."', products_hide_from_groups) = 0 and p.products_id = p2c.products_id and p2c.categories_id = c.categories_id and p2c.categories_id = cd.categories_id and cd.language_id = '" . (int)$languages_id . "' and p.manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "' order by cd.categories_name";
      } else {
        $filterlist_sql= "select distinct m.manufacturers_id as id, m.manufacturers_name as name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c left join " . TABLE_CATEGORIES . " using(categories_id), " . TABLE_MANUFACTURERS . " m where p.products_status = '1' and find_in_set('" . $customer_group_id . "', categories_hide_from_groups) = 0 and find_in_set('".$customer_group_id."', products_hide_from_groups) = 0 and p.manufacturers_id = m.manufacturers_id and p.products_id = p2c.products_id and p2c.categories_id = '" . (int)$current_category_id . "' order by m.manufacturers_name";
      }
// EOF SPPC Hide products and categories from groups

      $filterlist_query = tep_db_query($filterlist_sql);
      if (tep_db_num_rows($filterlist_query) > 1) {
        echo '            <td align="center" class="main">' . tep_draw_form('filter', FILENAME_DEFAULT, 'get') . TEXT_SHOW . '&nbsp;';
        if (isset($_GET['manufacturers_id'])) {
          echo tep_draw_hidden_field('manufacturers_id', $_GET['manufacturers_id']);
          $options = array(array('id' => '', 'text' => TEXT_ALL_CATEGORIES));
        } else {
          echo tep_draw_hidden_field('cPath', $cPath);
          $options = array(array('id' => '', 'text' => TEXT_ALL_MANUFACTURERS));
        }
        echo tep_draw_hidden_field('sort', $_GET['sort']);
        while ($filterlist = tep_db_fetch_array($filterlist_query)) {
          $options[] = array('id' => $filterlist['id'], 'text' => $filterlist['name']);
        }
        echo tep_draw_pull_down_menu('filter_id', $options, (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''), 'onchange="this.form.submit()"');
        echo tep_hide_session_id() . '</form></td>' . "\n";
      }
    }

// Get the right image for the top-right
    $image = DIR_WS_IMAGES . 'table_background_list.gif';
    if (isset($_GET['manufacturers_id'])) {
      $image = tep_db_query("select manufacturers_image from " . TABLE_MANUFACTURERS . " where manufacturers_id = '" . (int)$_GET['manufacturers_id'] . "'");
      $image = tep_db_fetch_array($image);
      $image = $image['manufacturers_image'];
	  $image_folder = MANUFACTURERS_IMAGES_DIR;
    } elseif ($current_category_id) {
//      $image = tep_db_query("select categories_image from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "'");
// BOF SPPC Hide products and categories from groups
      $image = tep_db_query("select categories_image from " . TABLE_CATEGORIES . " where categories_id = '" . (int)$current_category_id . "' and find_in_set('" . $customer_group_id . "', categories_hide_from_groups) = 0");
// EOF SPPC Hide products and categories from groups
      $image = tep_db_fetch_array($image);
      $image = $image['categories_image'];
	  $image_folder = CATEGORY_IMAGES_DIR;
    }
?>
   <?php if ( (ALLOW_CATEGORY_DESCRIPTIONS == 'true') && (tep_not_null($category['categories_heading_title'])) ) { ?>
              <td align="right"><?php echo tep_image(DIR_WS_IMAGES . $image_folder . $image, $category['categories_heading_title'], HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
            </tr>
        <?php } else { ?>
              <td align="right"><?php echo tep_image(DIR_WS_IMAGES . $image_folder . $image, HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
            </tr>
        <?php } ?>
	  <?php if ( (ALLOW_CATEGORY_DESCRIPTIONS == 'true') && (tep_not_null($category['categories_description'])) ) { ?>
	        <tr>
              <td align="left" colspan="2" class="category_desc"><?php echo $category['categories_description']; ?></td>
	        </tr>
	  <?php } ?>
          </table>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td>
        <?php
		
		if (PRODUCT_LIST_TYPE == 0) { $gridlist = 'list'; } else { $gridlist = 'grid'; }
		  
		$thumbnail_view = (isset($_GET['list']) ? $_GET['list'] : $gridlist); 
		  
		if ($thumbnail_view == 'list')  {
        include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING);
       } else {
        include(DIR_WS_MODULES . FILENAME_PRODUCT_LISTING_COL);
       }
        ?>
        </td>
      </tr>
    </table>