<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

 require('includes/application_top.php');

  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  $image = (isset($_GET['image']) ? $_GET['image'] : '');
  
  $root_images_dir = DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR;
  $root_products_dir = DIR_FS_CATALOG .  DIR_WS_IMAGES . DYNAMIC_MOPICS_PRODUCTS_DIR;  
  $root_thumbs_dir = DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR;
  
if (tep_not_null($action)) {
	switch ($action) {
	  case 'regenerate_all':
		listDirectory($root_images_dir);
	  case 'regenerate_missing':		 
		$regen_image_set_count  = listDirectory_onlymissing($root_images_dir);
	  break;
	}      
}    

//Function to convert bytes to proper image sizes
function format_size($size) {
      $sizes = array(" Bytes", " KB", " MB", " GB", " TB", " PB", " EB", " ZB", " YB");
      if ($size == 0) { return('n/a'); } else {
      return (round($size/pow(1024, ($i = floor(log($size, 1024)))), $i > 1 ? 2 : 0) . $sizes[$i]); }
}
?>

<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/javascript/jquery-ui-1.8.2.custom.css">
<script type="text/javascript" src="includes/general.js"></script>
</head>
<body>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top">
      <table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
      <!-- left_navigation //-->
      <?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
      <!-- left_navigation_eof //-->
      </table>
    </td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
              <td align="right" class="main">
              
              <?php if ($action == 'browse') {
				echo tep_draw_form('filter', FILENAME_IMAGES_REGEN, tep_get_all_get_params(array()), 'get');
                echo tep_hide_session_id();
				echo tep_draw_hidden_field('action', 'browse');
				echo TEXT_IMAGE_SIZE . tep_draw_input_field('max_image_size', (isset($_GET['max_image_size']) ? $_GET['max_image_size'] : ''), 'size=5') . 'kB &nbsp; ';
                echo TEXT_FILTER . tep_draw_pull_down_menu('categories_id', tep_get_category_tree(), '', 'onChange="this.form.submit();"');
				echo '</form>';
              } ?>
              </td>
            </tr>
            <?php if ($action == 'regenerate_all') { ?>
		    <tr>
              <td class="messageStackSuccess" colspan="2"><?php echo TEXT_SUCCESS_1; ?><b><?php echo DYNAMIC_MOPICS_BIGIMAGES_DIR; ?></b><?php echo TEXT_SUCCESS_2; ?></td>
			</tr>
			<?php } ?>
            <?php if ($action == 'regenerate_missing') { ?>
		    <tr>
              <td class="messageStackSuccess" colspan="2"><?php echo TEXT_SUCCESS_1; ?><b><?php echo DYNAMIC_MOPICS_BIGIMAGES_DIR; ?></b><?php echo TEXT_SUCCESS_2; ?><br><?php echo TEXT_SUCESS_TOTAL . $regen_image_set_count; ?></td>
			</tr>
			<?php } ?>
          </table>
        </td>
      </tr>
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td valign="top" width="75%">
                <!-- START OF LHS CONTENT -->
                <!-- START OF BROWSE -->
                <?php
	              switch ($action) {
                    case 'browse':
					
					// Regenerate single or multi-images in browse mode
					$regenerate_html = '';			
					if ( (tep_not_null($image)) && ($image != '') )  {
					  $multi_image = explode(',', $image);
					  $multi_image_count = count($multi_image);
                        for ($i = 0; $i < $multi_image_count; ++$i) { 
                   	      $source_bigimage = $root_images_dir . '/' . $multi_image[$i];
		                  require('includes/functions/image_generator.php');
						} // end for

					  $regenerate_html = '<table><tr><td class="messageStackSuccess">' . TEXT_IMAGES_FOR . '<b>' . $multi_image['0'] . '</b>' . TEXT_SUC_REGEN . '</td></tr></table>';
                    } // end if

				?>
                <table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr class="dataTableHeadingRow">
                    <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_ID; ?></td>
                    <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_NAME; ?></td>
                    <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_IMAGE; ?></td>
                    <td class="dataTableHeadingContent" align="center"><span title="Large Image|This column shows if there is a image file stored in your <b>big image folder</b> for the product's database entry."><?php echo TABLE_HEADING_L; ?></span></td>
                    <td class="dataTableHeadingContent" align="center"><span title="Medium|This column shows if there is a image file stored in your <b>product image folder</b> for the product's database entry."><?php echo TABLE_HEADING_M; ?></span></td>
                    <td class="dataTableHeadingContent" align="center"><span title="Small|This column shows if there is a image file stored in your <b>thumbs image folder</b> for the product's database entry."><?php echo TABLE_HEADING_S; ?></span></td>
                    <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_IMAGE_FILE_SIZE_LG; ?></td>
                    <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_IMAGE_FILE_SIZE_MD; ?></td>
                    <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_IMAGE_FILE_SIZE_SM; ?></td>
                    <td class="dataTableHeadingContent" align="center"><span title="Dynamic Mopics Large Image|This column shows the count of the Dynamic Mopics Large images in the images_big folder."><?php echo TABLE_HEADING_DL; ?></span></td>
                    <td class="dataTableHeadingContent" align="center"><span title="Dynamic Mopics Medium Image|This column shows the count of the Dynamic Mopics Medium images in the product image folder."><?php echo TABLE_HEADING_DM; ?></span></td>
                    <td class="dataTableHeadingContent" align="center"><span title="Dynamic Mopics Small Image|This column shows the count of the Dynamic Mopics Small images in the thumbnails image folder."><?php echo TABLE_HEADING_DS; ?></span></td>
                    <td class="dataTableHeadingContent" align="center">&nbsp;</td>
                    <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
                  </tr>
                    
					<?php			
					$cat_filter = '';
					if (isset($_GET['categories_id']) && $_GET['categories_id'] != '0') {
					  $cat_filter = ' and p2c.categories_id = ' . (int)$_GET['categories_id'];
					}
					
                    $images_query_raw = "select distinct p.products_id, p.products_image, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p.products_id = pd.products_id and p.products_id = p2c.products_id " . $cat_filter . " and pd.language_id = '" . (int)$languages_id . "'";
                    $images_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $images_query_raw, $images_query_numrows);
                    $images_query = tep_db_query($images_query_raw);
                    while ($images = tep_db_fetch_array($images_query)) {
					
					if ((!isset($_GET['iID']) || (isset($_GET['iID']) && ($_GET['iID'] == $images['products_id']))) && !isset($iInfo) && (substr($action, 0, 3) != 'new')) {
                      $iInfo = new objectInfo($images);
                    }
					
					//Get image size for images_big
					$image_file_size_lg = filesize($root_images_dir . $images['products_image']);
					$image_file_size_md = filesize($root_products_dir . $images['products_image']);
					$image_file_size_sm = filesize($root_thumbs_dir . $images['products_image']);		
					
					//Check large image exisits			
					$file_found_lg = 0;
					$image_sub_dir = '';
					$slash_pos = strripos($images['products_image'], '/');  // find last / in the image name
					$image_sub_dir = substr($images['products_image'], 0, $slash_pos); // Add this to the search path
					  $dir = opendir ($root_images_dir . $image_sub_dir);
					  while (false !== ($file = readdir($dir))) {
                        if ( ($file != '.') && ($file != '..') ) {
						  $pos = strpos($images['products_image'], $file);
						  if ($pos !== false) {
                            $file_found_lg++;
                          } // end if
					    } // end if
					  } // end while
					
					//Count Mopics for big images			
					$mopics_count_lg = 0;
					$image_sub_dir = '';
					$slash_pos = strripos($images['products_image'], '/');  // find last / in the image name
					if ($slash_pos > 0) {
					  $image_sub_dir = substr($images['products_image'], 0, $slash_pos). '/'; // Add this to the search path
					  $image_file_no_ext = substr($images['products_image'],$slash_pos+1);
					  $image_file_no_ext = substr_replace($image_file_no_ext,  "", -4); // Strip off the extension
					} else {
					$image_file_no_ext = substr_replace($images['products_image'],  "", -4); // Strip off the extension
					}
					
					for ($i=1; $i < 9; ++$i) {
					  $image_file_mopics = $image_file_no_ext . '_' . $i;
					  $dir = opendir ($root_images_dir . $image_sub_dir);
					  while (false !== ($file = readdir($dir))) {
                        if ( ($file != '.') && ($file != '..') ) {
						  $pos = strpos($file, $image_file_mopics);
						  if ($pos !== false) {
                            $mopics_count_lg++;
                          } // end if
					    } // end if
					  } // end while
					} // end for
					
					//Count Mopics for product images			
					$mopics_count_md = 0;
					for ($i=1; $i < 9; ++$i) {
					  $image_file_mopics = $image_file_no_ext . '_' . $i;
					  $dir = opendir ($root_products_dir . $image_sub_dir);
					  while (false !== ($file = readdir($dir))) {
                        if ( ($file != '.') && ($file != '..') ) {
						  $pos = strpos($file, $image_file_mopics);
						  if ($pos !== false) {
                            $mopics_count_md++;
                          } // end if
					    } // end if
					  } // end while
					} // end for
					
					//Count Mopics for thumbnail images			
					$mopics_count_sm = 0;
					for ($i=1; $i < 9; ++$i) {
					  $image_file_mopics = $image_file_no_ext . '_' . $i;
					  $dir = opendir ($root_thumbs_dir . $image_sub_dir);
					  while (false !== ($file = readdir($dir))) {
                        if ( ($file != '.') && ($file != '..') ) {
						  $pos = strpos($file, $image_file_mopics);
						  if ($pos !== false) {
                            $mopics_count_sm++;
                          } // end if
					    } // end if
					  } // end while
					} // end for
					
					if (!isset($_POST['max_image_size']) || ($image_file_size_lg > ($_POST['max_image_size'] * 1024))) {
					  
			        if (isset($iInfo) && is_object($iInfo) && ($images['products_id'] == $iInfo->products_id) ) {
                      echo '<tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_IMAGES_REGEN, tep_get_all_get_params(array('browse')) . 'page=' . $_GET['page'] . '&amp;iID=' . $iInfo->products_id . '&amp;action=browse') . '\'">' . "\n";
                    } else {
                      echo '<tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_IMAGES_REGEN, tep_get_all_get_params(array('browse')) . 'page=' . $_GET['page'] . '&amp;iID=' . $images['products_id']) . '&amp;action=browse' . '\'">' . "\n";
    }
	                  ?>
					  <td class="dataTableContent"><?php echo $images['products_id']; ?></td>
                      <td class="dataTableContent"><?php echo $images['products_name']; ?></td>
                      <td class="dataTableContent"><?php echo $images['products_image']; ?></td>
                      <td class="dataTableContent"align="center"><?php if ($image_file_size_lg == 0) { echo tep_image(DIR_WS_ICONS . 'icon_status_red.gif', 'Image Missing', 10, 10); } else { echo tep_image(DIR_WS_ICONS . 'icon_status_green.gif', 'Image Found', 10, 10); } ?></td>
                      <td class="dataTableContent"align="center"><?php if ($image_file_size_md == 0) { echo tep_image(DIR_WS_ICONS . 'icon_status_red.gif', 'Image Missing', 10, 10); } else { echo tep_image(DIR_WS_ICONS . 'icon_status_green.gif', 'Image Found', 10, 10); } ?></td>
                      <td class="dataTableContent"align="center"><?php if ($image_file_size_sm == 0) { echo tep_image(DIR_WS_ICONS . 'icon_status_red.gif', 'Image Missing', 10, 10); } else { echo tep_image(DIR_WS_ICONS . 'icon_status_green.gif', 'Image Found', 10, 10); } ?></td>
                      <td class="dataTableContent" align="center"><?php echo format_size($image_file_size_lg); ?></td>
                      <td class="dataTableContent" align="center"><?php echo format_size($image_file_size_md); ?></td>  
                      <td class="dataTableContent" align="center"><?php echo format_size($image_file_size_sm); ?></td>                        
                      <td class="dataTableContent" align="center"><?php echo $mopics_count_lg; ?></td>
                      <td class="dataTableContent" align="center"><?php echo $mopics_count_md; ?></td>
                      <td class="dataTableContent" align="center"><?php echo $mopics_count_sm; ?></td>
                      <td class="dataTableContent" align="center">
                        <?php if ( ($mopics_count_lg != $mopics_count_md) || ($mopics_count_lg != $mopics_count_sm) || ($mopics_count_md != $mopics_count_sm) ) { echo tep_image(DIR_WS_ICONS . 'warning.gif', 'Missing dynamic mopics image(s)'); } ?>
                      </td>
                      <td class="dataTableContent" align="right"><?php if (isset($iInfo) && is_object($iInfo) && ($images['products_id'] == $iInfo->products_id) ) { echo tep_image(DIR_WS_ICONS . 'icon_arrow_right.gif'); } else { echo '<a href="' . tep_href_link(FILENAME_IMAGES_REGEN, 'page=' . $_GET['page'] . '&amp;iID=' . $images['products_id']) . '&amp;action=browse">' . tep_image(DIR_WS_ICONS . 'information.png', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
                  </tr>
                  
                  
				  <?php
					  }
					}
				  ?>
                  <tr>
                    <td colspan="14">
                      <table border="0" width="100%" cellspacing="0" cellpadding="2">
                        <tr>
                          <td class="smallText" valign="top"><?php echo $images_split->display_count($images_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_IMAGES); ?></td>
                          <td class="smallText" align="right"><?php echo $images_split->display_links($images_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page'], tep_get_all_get_params(array('page', 'iID'))); ?></td>
                        </tr>
                      </table>
                    </td>
                  </tr>
                </table>
                <?php
				  break;
				?>
                <!-- END OF BROWSE -->
                <!-- START OF MISSING -->
                <?php
                    case 'missing':
				?>
				<?php
				$image_columns = array('products_image');
                $image_count = 0;
  
                foreach ($image_columns as $column) {
                  if ($column_query_string != '') $column_query_string .= ', ';
                  $column_query_string .= $column;
                }
				
				$image_array = array();
                $images_query = tep_db_query("SELECT products_id, " . $column_query_string . " FROM " . TABLE_PRODUCTS);
                while ($row = tep_db_fetch_array($images_query)) {
                  $image_array[$row['products_id']] = array();
                  foreach ($image_columns as $column) {
                    if ($row[$column] != '') {
                      $image_array[$row['products_id']][] = array('image' => $row[$column], 'column' => $column);
                      $image_count++;
                    } // end if
                  } // end foreach
                } // end while

				$missing_images_lg = array();
                foreach ($image_array as $id => $product) {
                  foreach ($product as $image) {
                    if (!is_file($root_images_dir . $image['image'])) {
                      if (!is_array($missing_images_lg[$id])) $missing_images_lg[$id] = array();
                        $missing_images_lg[$id][] = $image['image'];
                    } // end if
                  } // end foreach
                } // end foreach
				
				$missing_images_md = array();
                foreach ($image_array as $id => $product) {
                  foreach ($product as $image) {
                    if (!is_file($root_products_dir . $image['image'])) {
                      if (!is_array($missing_images_md[$id])) $missing_images_md[$id] = array();
                        $missing_images_md[$id][] = $image['image'];
                    } // end if
                  } // end foreach
                } // end foreach

				$missing_images_sm = array();
                foreach ($image_array as $id => $product) {
                  foreach ($product as $image) {
                    if (!is_file($root_thumbs_dir . $image['image'])) {
                      if (!is_array($missing_images_sm[$id])) $missing_images_sm[$id] = array();
                        $missing_images_sm[$id][] = $image['image'];
                    } // end if
                  } // end foreach
                } // end foreach

				?>
                <?php 
				if ( (count($missing_images_lg) > 0) || (count($missing_images_md) > 0) || (count($missing_images_sm) > 0) ) { ?>
                  <table border="0" width="100%" cellspacing="0" cellpadding="2">
                    <tr class="dataTableHeadingRow">
                      <td class="dataTableHeadingContent" align="center" width="30"><?php echo TABLE_HEADING_PRODUCT_ID; ?></td>
                      <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_MODEL; ?></td>
                      <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCT_NAME; ?></td>
                      <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_MISSING_PRODUCT_IMAGE; ?></td>
                      <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_IMAGE_FOLDER; ?></td>
                    </tr>
                  
                  <?php
				  // Checking Large Images
				  if (count($missing_images_lg) > 0) {
                    foreach ($missing_images_lg as $id => $files) { 
                    $product_query = tep_db_query("SELECT pd.products_name, p.products_model FROM products_description pd, products p WHERE pd.products_id = '" . (int)$id . "' AND pd.products_id = p.products_id AND pd.language_id = '" . ($language_id > 0 ? (int)$language_id : '1') . "'");
                    $product = tep_db_fetch_array($product_query);
                  ?>
                    <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
                      <td class="dataTableContent" align="center" width="30"><?php echo $id; ?></td>
                      <td class="dataTableContent"><?php echo $product['products_model']; ?></td>
                      <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'pID=' . $id . '&action=new_product') . '">' . $product['products_name']; ?></a></td>
                      <td class="dataTableContent">
                      <?php     
                      foreach ($files as $f) {
                        echo $f;
                      } // end foreach
                      ?>
                      </td>
                      <td class="dataTableContent"><?php echo DYNAMIC_MOPICS_BIGIMAGES_DIR?></td>
                    </tr>
                  <?php
                    } // end foreach
				  } // end if
				  ?>
                  
                  <?php 
				  // Checking Medium Images
				  if (count($missing_images_md) > 0) {
                    foreach ($missing_images_md as $id => $files) { 
                    $product_query = tep_db_query("SELECT pd.products_name, p.products_model FROM products_description pd, products p WHERE pd.products_id = '" . (int)$id . "' AND pd.products_id = p.products_id AND pd.language_id = '" . ($language_id > 0 ? (int)$language_id : '1') . "'");
                    $product = tep_db_fetch_array($product_query);
                  ?>
                    <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
                      <td class="dataTableContent" align="center" width="30"><?php echo $id; ?></td>
                      <td class="dataTableContent"><?php echo $product['products_model']; ?></td>
                      <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'pID=' . $id . '&action=new_product') . '">' . $product['products_name']; ?></a></td>
                      <td class="dataTableContent">
                      <?php     
                      foreach ($files as $f) {
                        echo $f;
                      } // end foreach
                      ?>
                      </td>
                      <td class="dataTableContent"><?php echo DYNAMIC_MOPICS_PRODUCTS_DIR?></td>
                    </tr>
                  <?php
                    } // end foreach
				  } // end if
				  ?>
                
                  <?php 
				  // Checking Small Images
				  if (count($missing_images_sm) > 0) {
                    foreach ($missing_images_sm as $id => $files) { 
                    $product_query = tep_db_query("SELECT pd.products_name, p.products_model FROM products_description pd, products p WHERE pd.products_id = '" . (int)$id . "' AND pd.products_id = p.products_id AND pd.language_id = '" . ($language_id > 0 ? (int)$language_id : '1') . "'");
                    $product = tep_db_fetch_array($product_query);
                  ?>
                    <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
                      <td class="dataTableContent" align="center" width="30"><?php echo $id; ?></td>
                      <td class="dataTableContent"><?php echo $product['products_model']; ?></td>
                      <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'pID=' . $id . '&action=new_product') . '">' . $product['products_name']; ?></a></td>
                      <td class="dataTableContent">
                      <?php     
                      foreach ($files as $f) {
                        echo $f;
                      } // end foreach
                      ?>
                      </td>
                      <td class="dataTableContent"><?php echo DYNAMIC_MOPICS_THUMBS_DIR?></td>
                    </tr>
                  <?php
                    } // end foreach
				  } // end if
				?>
                </table>
				
				<?php } else { // (count($missing_images_lg) > 0) ?>
                
                <table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr class="dataTableHeadingRow">
                    <td class="dataTableHeadingContent"><?php echo TEXT_MISSING_IMAGES; ?></td>
                  </tr>
                </table>
                <table border="0" width="100%" cellspacing="5" cellpadding="2">  
                  <tr>
                   <td class="messageStackSuccess"><?php echo TEXT_YOU_HAVE; ?><b><?php echo $image_count . ' product image' . ($image_count == 1 ? '' : 's'); ?></b><?php echo TEXT_ACCOUNT_FOR; ?></b></td>
                 </tr>
                </table>
                
				<?php  } // end if (count($missing_images_lg) > 0) ?>
        
			    <?php
				  break;
			    ?>
                <!-- END OF MISSING -->
                <!-- START OF ORPHANS -->
                <?php
                   case 'orphans':
				   case 'delete_orphans_confirm':
				   case 'delete_orphans':
			    ?>
                <table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr class="dataTableHeadingRow">
                    <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_ORPHAN_IMAGES; ?></td>
                    <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_FOLDER; ?></td>
                  </tr>
                <?php
				//Start by creating an array of any images that are being used in the database
				$database_image_array = array();
                $database_images_query = tep_db_query("SELECT products_image FROM " . TABLE_PRODUCTS);
                while ($database_images = tep_db_fetch_array($database_images_query)) {
				  $database_image_array[] = $database_images['products_image'];   
                } // end while

				// Next load all the images_big into an array
				$server_images_lg = array();
                $dir = opendir ($root_images_dir);
                while (false !== ($file = readdir($dir))) {
                  if ( ($file != '.') && ($file != '..') ) {
					if (strripos($file, '.') > 0) { // checks it is a file not a dir
				      $server_images_lg[] = $file;
					}
				  }
				}
				$count_server_lg_raw = count($server_images_lg);
								
				// Next load all the products images into an array
				$server_images_md = array();
                $dir = opendir ($root_products_dir);
                while (false !== ($file = readdir($dir))) {
                  if ( ($file != '.') && ($file != '..') ) {
					if (strripos($file, '.') > 0) { // checks it is a file not a dir
				      $server_images_md[] = $file;
					}
				  }
				}
				$count_server_md_raw = count($server_images_md);
				
				// Next load all the thumbnail images into an array
				$server_images_sm = array();
                $dir = opendir ($root_thumbs_dir);
                while (false !== ($file = readdir($dir))) {
                  if ( ($file != '.') && ($file != '..') ) {
					if (strripos($file, '.') > 0) { // checks it is a file not a dir
					  $server_images_sm[] = $file;
					}
				  }
				}
				$count_server_sm_raw = count($server_images_sm);
								
				//Now remove any large images that have the mopics extension
                sort($server_images_lg);
                for ($i = 0; $i < count($server_images_lg); ++$i) { 
                  for ($j = 0; $j < 9; ++$j) { 
	                if (strpos(strtolower($server_images_lg[$i]),strtolower('_' . $j . '.'))) {
		              unset($server_images_lg[$i]);
	                }
	              }
                }
				$count_server_lg = count($server_images_lg);
				$count_mopics_lg = $count_server_lg_raw - $count_server_lg;
				
				//Now remove any medium images that have the mopics extension
                sort($server_images_md);
                for ($i = 0; $i < count($server_images_md); ++$i) { 
                  for ($j = 0; $j < 9; ++$j) { 
	                if (strpos(strtolower($server_images_md[$i]),strtolower('_' . $j . '.'))) {
		              unset($server_images_md[$i]);
	                }
	              }
                }
				$count_server_md = count($server_images_md);
				$count_mopics_md = $count_server_md_raw - $count_server_md;
				
				//Now remove any small images that have the mopics extension
                sort($server_images_sm);
                for ($i = 0; $i < count($server_images_sm); ++$i) { 
                  for ($j = 0; $j < 9; ++$j) { 
	                if (strpos(strtolower($server_images_sm[$i]),strtolower('_' . $j . '.'))) {
		              unset($server_images_sm[$i]);
	                }
	              }
                }
				$count_server_sm = count($server_images_sm);
				$count_mopics_sm = $count_server_sm_raw - $count_server_sm;
								
				//Now find the large ones that don't match and we should have our orphan images
				$orphans_lg = array();				
				$orphans_lg = array_diff($server_images_lg, $database_image_array);
				$count_orphans_lg = count($orphans_lg);
												
                if ($count_orphans_lg > 0) { 
                  for ($i = 0; $i < $count_server_lg_raw + $count_orphans_lg; ++$i) {
                    if ($orphans_lg[$i]) {
					?>	
                      <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
                        <td class="dataTableContent"><?php echo $orphans_lg[$i]; ?></td>
                        <td class="dataTableContent"><?php echo DYNAMIC_MOPICS_BIGIMAGES_DIR; ?></td>
                      </tr>
                    <?php
                    } // end if
				  } // end for
				} // end if
                
                //Now find the medium ones that don't match and we should have our orphan images
				$orphans_md = array();				
				$orphans_md = array_diff($server_images_md, $database_image_array);
				$count_orphans_md = count($orphans_md);
												
                if ($count_orphans_md > 0) { 
                  for ($i = 0; $i < $count_server_md_raw + $count_orphans_md; ++$i) {
                    if ($orphans_md[$i]) {
					?>	
                      <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
                        <td class="dataTableContent"><?php echo $orphans_md[$i]; ?></td>
                        <td class="dataTableContent"><?php echo DYNAMIC_MOPICS_PRODUCTS_DIR; ?></td>
                      </tr>
                    <?php
                    } // end if
				  } // end for
				} // end if 
                  
                //Now find the small ones that don't match and we should have our orphan images
				$orphans_sm = array();				
				$orphans_sm = array_diff($server_images_sm, $database_image_array);
				$count_orphans_sm = count($orphans_sm);
												
                if ($count_orphans_sm > 0) { 
                  for ($i = 0; $i < $count_server_sm_raw + $count_orphans_sm; ++$i) {
                    if ($orphans_sm[$i]) {
					?>	
                      <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
                        <td class="dataTableContent"><?php echo $orphans_sm[$i]; ?></td>
                        <td class="dataTableContent"><?php echo DYNAMIC_MOPICS_THUMBS_DIR; ?></td>
                      </tr>
                    <?php
                    } // end if
				  } // end for
				} // end if
				?>
                
                </table>
                                
                <?php
				$total_orphans = $count_orphans_lg + $count_orphans_md + $count_orphans_sm;
                if ($total_orphans == 0) {
				?>
				<table border="0" width="100%" cellspacing="5" cellpadding="2">  
                  <tr>
                   <td class="messageStackSuccess"><?php echo TEXT_YOU_HAVE . '<b>' . ($count_server_lg_raw + $count_server_md_raw + $count_server_sm_raw) . '</b>' . TEXT_IMAGES_ON_SERVER . '<b>' . ($count_mopics_lg + $count_mopics_md + $count_mopics_sm) . TEXT_DYNAMIC . ($count_mopics_lg + $count_mopics_md + $count_mopics_sm == 1 ? '' : 's') . '</b>' . TEXT_ACCOUNTED_FOR . '</b>'; ?></td>
                 </tr>
                </table>
                <?php	
				}// end if
                
                // Delete orphans
                if ($action == 'delete_orphans') {
				  $images_removed = 0;
	                foreach ($orphans_lg as $large_orphan) {
					  unlink(DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR . $large_orphan);
					  $images_removed++;
					}
					foreach ($orphans_md as $medium_orphan) {
					  unlink(DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_PRODUCTS_DIR . $medium_orphan);
					  $images_removed++;
				    }
					foreach ($orphans_sm as $small_orphan) {
					  unlink(DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $small_orphan);
					  $images_removed++;
				    }
				} // end if ($action == 'delete_orphans')
                ?>
                <?php
				  break;
				?>
                <!-- END OF ORPHANS -->
                <!-- START OF SUMMARY -->
                <?php
                    default:

                    //Analyse image directories
                    $jpg_count_lg = $jpg_count_md = $jpg_count_sm = 0;
                    $png_count_lg = $png_count_md = $png_count_sm = 0;
                    $gif_count_lg = $gif_count_md = $gif_count_sm = 0;
                    $unknown_lg = $unknown_md = $unknown_sm =0;
					
					//Large Images
                    $dir = opendir ($root_images_dir);
                    while (false !== ($file = readdir($dir))) {
                      if ( ($file != '.') && ($file != '..') ) { 
                        if (strpos($file, '.jpg',1)) {
                          $jpg_count_lg++;
                        } elseif (strpos($file, '.png',1)) {
                          $png_count_lg++;
                        } elseif (strpos($file, '.gif',1)) {
                          $gif_count_lg++;
                        } else {
                          $unknown_lg++;
                        } // end if
                      } // end if
                    } // end while

                    //Medium Images
                    $dir = opendir ($root_products_dir);
                    while (false !== ($file = readdir($dir))) {
                      if ( ($file != '.') && ($file != '..') ) { 
                        if (strpos($file, '.jpg',1)) {
                          $jpg_count_md++;
                        } elseif (strpos($file, '.png',1)) {
                          $png_count_md++;
                        } elseif (strpos($file, '.gif',1)) {
                          $gif_count_md++;
                        } else {
                          $unknown_md++;
                        } // end if
                      } // end if
                    } // end while

                    //Small Images
                    $dir = opendir ($root_thumbs_dir);
                    while (false !== ($file = readdir($dir))) {
                      if ( ($file != '.') && ($file != '..') ) { 
                        if (strpos($file, '.jpg',1)) {
                          $jpg_count_sm++;
                        } elseif (strpos($file, '.png',1)) {
                          $png_count_sm++;
                        } elseif (strpos($file, '.gif',1)) {
                          $gif_count_sm++;
                        } else {
                          $unknown_sm++;
                        } // end if
                      } // end if
                    } // end while

                ?>
                <table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr class="dataTableHeadingRow">
                    <td class="dataTableHeadingContent" width="20%"><b><?php echo TABLE_HEADING_IMAGE_SIZE; ?></b></td><td class="dataTableHeadingContent" width="10%" align="center"><b><?php echo TABLE_HEADING_WIDTH; ?></b></td><td class="dataTableHeadingContent" width="10%" align="center"><b><?php echo TABLE_HEADING_HEIGHT; ?></b></td><td class="dataTableHeadingContent" width="10%" align="center"><b><?php echo TABLE_HEADING_JPG; ?></b></td><td class="dataTableHeadingContent" width="10%" align="center"><b><?php echo TABLE_HEADING_PNG; ?></b></td><td class="dataTableHeadingContent" width="10%" align="center"><b><?php echo TABLE_HEADING_GIF; ?></b></td><td class="dataTableHeadingContent" width="10%" align="center"><b><?php echo TABLE_HEADING_UNKNOWN; ?></b></td><td class="dataTableHeadingContent" width="10%" align="center"><b><?php echo TABLE_HEADING_TOTAL; ?></b></td>
                  </tr>
                  <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
                    <td class="dataTableContent"><b><?php echo TEXT_SMALL_IMAGE; ?></b></td><td class="dataTableContent" align="center"><?php echo SMALL_IMAGE_WIDTH; ?></td><td class="dataTableContent" align="center"><?php echo SMALL_IMAGE_HEIGHT; ?></td><td class="dataTableContent" align="center"><?php echo $jpg_count_sm; ?></td><td class="dataTableContent" align="center"><?php echo $png_count_sm; ?></td><td class="dataTableContent" align="center"><?php echo $gif_count_sm; ?></td><td class="dataTableContent" align="center"><?php echo $unknown_sm; ?></td><td class="dataTableContent" align="center"><?php echo $jpg_count_sm + $png_count_sm + $gif_count_sm; ?></td>
                  </tr>
                  <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
                    <td class="dataTableContent"><b><?php echo TEXT_MEDIUM_IMAGE; ?></b></td><td class="dataTableContent" align="center"><?php echo PRODUCT_IMAGE_WIDTH; ?></td><td class="dataTableContent" align="center"><?php echo PRODUCT_IMAGE_HEIGHT; ?></td><td class="dataTableContent" align="center"><?php echo $jpg_count_md; ?></td><td class="dataTableContent" align="center"><?php echo $png_count_md; ?></td><td class="dataTableContent" align="center"><?php echo $gif_count_md; ?></td><td class="dataTableContent" align="center"><?php echo $unknown_md; ?></td><td class="dataTableContent" align="center"><?php echo $jpg_count_md + $png_count_md + $gif_count_md; ?></td>
                  </tr>
                  <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
                    <td class="dataTableContent"><b><?php echo TEXT_LARGE_IMAGE; ?></b></td><td class="dataTableContent" align="center"><?php echo POPUP_IMAGE_WIDTH; ?></td><td class="dataTableContent" align="center"><?php echo POPUP_IMAGE_HEIGHT; ?></td><td class="dataTableContent" align="center"><?php echo $jpg_count_lg; ?></td><td class="dataTableContent" align="center"><?php echo $png_count_lg; ?></td><td class="dataTableContent" align="center"><?php echo $gif_count_lg; ?></td><td class="dataTableContent" align="center"><?php echo $unknown_lg; ?></td><td class="dataTableContent" align="center"><?php echo $jpg_count_lg + $png_count_lg + $gif_count_lg; ?></td>
                  </tr>
                  <tr class="dataTableHeadingRow">
                    <td class="dataTableHeadingContent"><b><?php echo TABLE_HEADING_TOTAL; ?></b></td><td class="dataTableHeadingContent" align="center">&nbsp;</td><td class="dataTableHeadingContent" align="center">&nbsp;</td><td class="dataTableHeadingContent" align="center"><?php echo $jpg_count_sm + $jpg_count_md + $jpg_count_lg; ?></td><td class="dataTableHeadingContent" align="center"><?php echo $png_count_sm + $png_count_md + $png_count_lg; ?></td><td class="dataTableHeadingContent" align="center"><?php echo $gif_count_sm + $gif_count_md + $gif_count_lg; ?></td><td class="dataTableHeadingContent" align="center"><?php echo $unknown_sm + $unknown_md + $unknown_lg; ?></td><td class="dataTableHeadingContent" align="center"><?php echo $jpg_count_sm + $jpg_count_md + $jpg_count_lg + $png_count_sm + $png_count_md + $png_count_lg + $gif_count_sm + $gif_count_md + $gif_count_lg; ?></td>
                  </tr>                        
                </table>
                <?php
				    break;
				?>
                <!-- END OF SUMMARY -->
                <!-- END OF LHS CONTENT -->
                <?php } // end case ?>
              <td valign="top" width="25%">
                <table border="0" width="100%" cellspacing="0" cellpadding="0">
                  <tr>
                    <td>
                    <?php
                    $heading = array();
                    $contents = array();
					
                    switch ($action) {
						case 'browse':
						  $image_string = '';
						  $missing_big_images = 0;
							
						  if (is_object($iInfo)) {  
                            $image_file_size_sm = filesize($root_thumbs_dir . $iInfo->products_image);
							$image_file_size_md = filesize($root_products_dir . $iInfo->products_image);
							$image_file_size_lg = filesize($root_images_dir . $iInfo->products_image);
							
							list($width_sm, $height_sm, $type_sm, $attr_sm) = getimagesize($root_thumbs_dir . $iInfo->products_image);
							list($width_md, $height_md, $type_sm, $attr_md) = getimagesize($root_products_dir . $iInfo->products_image);
							list($width_lg, $height_lg, $type_sm, $attr_lg) = getimagesize($root_images_dir . $iInfo->products_image);
							 
						    $heading[] = array('text' => '<b>' . $iInfo->products_name . '</b>');
							$contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_IMAGES_REGEN) . '">' . tep_image_button('button_summary.gif', IMAGE_SUMMARY) . '</a> <a href="' . tep_href_link(FILENAME_IMAGES_REGEN, 'action=browse') . '">' . tep_image_button('button_browse.gif', IMAGE_BROWSE) . '</a> <a href="' . tep_href_link(FILENAME_IMAGES_REGEN, 'action=missing') . '">' . tep_image_button('button_missing.gif', IMAGE_MISSING) . '</a> <a href="' . tep_href_link(FILENAME_IMAGES_REGEN, 'action=orphans') . '">' . tep_image_button('button_orphans.gif', IMAGE_ORPHANS) . '</a><hr>');
							$contents[] = array('text' => $regenerate_html);
							if (file_exists($root_thumbs_dir . $iInfo->products_image)) {
							  $contents[] = array('text' => '<center>' . tep_image(HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $iInfo->products_image, $iInfo->products_name) . '</center><br>');
							} else {
							  $contents[] = array('text' => '<br><center>' . tep_image(HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . 'icons/missing_image.png', IMAGE_MISSING_IMAGE) . '</center><br>');
							}
                            $contents[] = array('text' => '<center><table cellpadding="2" cellspacing="2" class="smallText"><tr><td colspan="3"><b>' . TEXT_MAIN_IMAGE . '</b>' . $iInfo->products_image . '</td></tr><tr><td>&nbsp;</td><td><b>' . TABLE_HEADING_WIDTH . '</b></td><td><b> ' . TABLE_HEADING_HEIGHT . '</b></td><td><b>' . TEXT_FILE_SIZE . '</b></td></tr><tr><td>' . TEXT_SMALL_IMAGE . '</td><td align="center">' . $width_sm . '</td><td align="center">' . $height_sm . '</td><td align="center">' . format_size($image_file_size_sm) . '</td></tr><tr><td>' . TEXT_PRODUCT_IMAGE . '</td><td align="center">' . $width_md . '</td><td align="center">' . $height_md . '</td><td align="center">' . format_size($image_file_size_md) . '</td></tr><tr><td>' . TEXT_LARGE_IMAGE . '</td><td align="center">' . $width_lg . '</td><td align="center">' . $height_lg . '</td><td align="center">' . format_size($image_file_size_lg) . '</td></tr></table></center><br>');
							if (file_exists($root_images_dir . $iInfo->products_image)) { 
						      $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_IMAGES_REGEN, tep_get_all_get_params(array('image'))) . '&amp;image=' . $iInfo->products_image . '">' . tep_image_button('button_regenerate.gif', IMAGE_REGENERATE) . '</a><br><hr>');
							} else {
							  $contents[] = array('align' => 'center', 'text' => TEXT_MISSING_FROM . '<b>' . DYNAMIC_MOPICS_BIGIMAGES_DIR . '</b>' . TEXT_NO_GENERATE . '<br><hr>');
							      $missing_big_images++;
							}
							
							$image_string .= $iInfo->products_image;
							
							// Check for dynamic mopics versions of the image - if found show them as well
							$found_mopic = 0;
							for ($i = 1; $i < 9; ++$i) {
							  $mopics_filename_no_ext = substr_replace($iInfo->products_image,  "", -4);
							  $mopics_filename_ext = substr($iInfo->products_image, -4);
							  $mopics_filename = $mopics_filename_no_ext . '_' . $i . $mopics_filename_ext;	
							  
							  
							  if (file_exists($root_images_dir . $mopics_filename)) {
								
								$found_mopic++;							
								
							    $image_file_size_sm = filesize($root_thumbs_dir . $mopics_filename);
							    $image_file_size_md = filesize($root_products_dir . $mopics_filename);
							    $image_file_size_lg = filesize($root_images_dir . $mopics_filename);
							
							    list($width_sm, $height_sm, $type_sm, $attr_sm) = getimagesize($root_thumbs_dir . $mopics_filename);
							    list($width_md, $height_md, $type_sm, $attr_md) = getimagesize($root_products_dir . $mopics_filename);
							    list($width_lg, $height_lg, $type_sm, $attr_lg) = getimagesize($root_images_dir . $mopics_filename);
								
								if (file_exists($root_thumbs_dir . $mopics_filename)) {
							      $contents[] = array('text' => '<center>' . tep_image(HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $mopics_filename, $mopics_filename) . '</center><br>');
							    } else {
							      $contents[] = array('text' => '<br><center>' . tep_image(HTTP_SERVER . DIR_WS_CATALOG . DIR_WS_IMAGES . 'icons/missing_image.png', 'Missing Image') . '</center><br>');
							    } // end if file_exists
                                $contents[] = array('text' => '<center><table cellpadding="2" cellspacing="2" class="smallText"><tr><td colspan="3"><b>' . TEXT_MOPICS_IMAGE . '</b>' . $mopics_filename . '</td></tr><tr><td>&nbsp;</td><td><b>' . TABLE_HEADING_WIDTH . '</b></td><td><b>' . TABLE_HEADING_HEIGHT . '</b></td><td><b>' . TEXT_FILE_SIZE . '</b></td></tr><tr><td>' . TEXT_SMALL_IMAGE . '</td><td align="center">' . $width_sm . '</td><td align="center">' . $height_sm . '</td><td align="center">' . format_size($image_file_size_sm) . '</td></tr><tr><td>' . TEXT_PRODUCT_IMAGE . '</td><td align="center">' . $width_md . '</td><td align="center">' . $height_md . '</td><td align="center">' . format_size($image_file_size_md) . '</td></tr><tr><td>' . TEXT_LARGE_IMAGE . '</td><td align="center">' . $width_lg . '</td><td align="center">' . $height_lg . '</td><td align="center">' . format_size($image_file_size_lg) . '</td></tr></table></center><br>');
								
								if (file_exists($root_images_dir . $mopics_filename)) { 
								  $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_IMAGES_REGEN, tep_get_all_get_params(array('image'))) . 'image=' . $mopics_filename . '">' . tep_image_button('button_regenerate.gif', IMAGE_REGENERATE) . '</a><br><hr>');
								} else {
								  $contents[] = array('align' => 'center', 'text' => TEXT_MISSING_FROM . '<b>' . DYNAMIC_MOPICS_BIGIMAGES_DIR . '</b>' . TEXT_NO_GENERATE . '<br><hr>');
							      $missing_big_images++;
								}
								$image_string .= ',' . $mopics_filename;
								
							  } // end if file_exists
							} // end for $i	
						  } // end if (is_object($iInfo))
						  if ( ($found_mopic >= 1) && ($missing_big_images == 0) ) {
						    $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_IMAGES_REGEN, tep_get_all_get_params(array('image'))) . 'image=' . $image_string . '">' . tep_image_button('button_regenerate_all.gif', IMAGE_REGENERATE_ALL) . '</a><br><br>');
						  }
						  break;
						case 'missing':
						  $heading[] = array('text' => '<b>' . MISSING_IMAGES . '</b>');
					      $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_IMAGES_REGEN) . '">' . tep_image_button('button_summary.gif', IMAGE_SUMMARY) . '</a> <a href="' . tep_href_link(FILENAME_IMAGES_REGEN, 'action=browse') . '">' . tep_image_button('button_browse.gif', IMAGE_BROWSE) . '</a> <a href="' . tep_href_link(FILENAME_IMAGES_REGEN, 'action=missing') . '">' . tep_image_button('button_missing.gif', IMAGE_MISSING) . '</a> <a href="' . tep_href_link(FILENAME_IMAGES_REGEN, 'action=orphans') . '">' . tep_image_button('button_orphans.gif', IMAGE_ORPHANS) . '</a>');
						  $contents[] = array('text' => '<br>' . TEXT_OUT_OF . '<b>' . $image_count . '</b>' . TEXT_PRODUCTS_YOU_HAVE . '<b>' . (count($missing_images_lg) + count($missing_images_md) + count($missing_images_sm)) . '</b>' . TEXT_MISSING_IMAGE . ($image_count == 1 ? '' : 's') . '.<br><br>');
						  break;
						case 'orphans':
						case 'delete_orphans':
						  $heading[] = array('text' => '<b>' . ORPHAN_IMAGES . '</b>');
						  if ($images_removed != 0) {
                            $contents[] = array('text' => '<table width="100%"><tr><td class="messageStackSuccess">' . tep_image(DIR_WS_ICONS . 'success.gif', ICON_SUCCESS) . '&nbsp;' . $images_removed . '&nbsp;' . TEXT_ORPHAN_REMOVED . '</td></tr></table>');
                          }
					      $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_IMAGES_REGEN) . '">' . tep_image_button('button_summary.gif', IMAGE_SUMMARY) . '</a> <a href="' . tep_href_link(FILENAME_IMAGES_REGEN, 'action=browse') . '">' . tep_image_button('button_browse.gif', IMAGE_BROWSE) . '</a> <a href="' . tep_href_link(FILENAME_IMAGES_REGEN, 'action=missing') . '">' . tep_image_button('button_missing.gif', IMAGE_MISSING) . '</a> <a href="' . tep_href_link(FILENAME_IMAGES_REGEN, 'action=orphans') . '">' . tep_image_button('button_orphans.gif', IMAGE_ORPHANS) . '</a><br><br>');
						  $contents[] = array('text' => '<b>' . TEXT_NO_MOPICS . '</b><br><br>');
						  if ($total_orphans > 0) {
						    $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_IMAGES_REGEN, 'action=delete_orphans_confirm') . '">' . tep_image_button('button_empty.gif', IMAGE_DELETE) . '</a><br><br>');
						  }
						  break;
						case 'delete_orphans_confirm':
						  $heading[] = array('text' => '<b>' . TEXT_DELETE_ORPHANS . '</b>');
						  $contents[] = array('text' => TEXT_CONFIRM_DELETE_ORPHANS);
						  $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_IMAGES_REGEN, 'action=delete_orphans') . '">' . tep_image_button('button_confirm.gif', IMAGE_CONFIRM) . '</a> <a href="' . tep_href_link(FILENAME_IMAGES_REGEN) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
						  break;
						case 'regenerate_confirm':
						  $heading[] = array('text' => '<b>' . TEXT_REGENERATE_ALL . '</b>');
						  $contents[] = array('text' => TEXT_CONFIRM_REGENERATE_ALL);
						  $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_IMAGES_REGEN, 'action=regenerate_all') . '">' . tep_image_button('button_confirm.gif', IMAGE_CONFIRM) . '</a> <a href="' . tep_href_link(FILENAME_IMAGES_REGEN) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
						  break;
						case 'regenerate_confirm_only_missing':
						  $heading[] = array('text' => '<b>' . TEXT_REGENERATE_MISSING . '</b>');
						  $contents[] = array('text' => TEXT_CONFIRM_REGENERATE_MISSING);
						  $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_IMAGES_REGEN, 'action=regenerate_missing') . '">' . tep_image_button('button_confirm.gif', IMAGE_CONFIRM) . '</a> <a href="' . tep_href_link(FILENAME_IMAGES_REGEN) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
						  break;
						default:
						  $heading[] = array('text' => '<b>' . SUMMARY . '</b>');
					      $contents[] = array('align' => 'center', 'text' => '<a href="' . tep_href_link(FILENAME_IMAGES_REGEN) . '">' . tep_image_button('button_summary.gif', IMAGE_SUMMARY) . '</a> <a href="' . tep_href_link(FILENAME_IMAGES_REGEN, 'action=browse') . '">' . tep_image_button('button_browse.gif', IMAGE_BROWSE) . '</a> <a href="' . tep_href_link(FILENAME_IMAGES_REGEN, 'action=missing') . '">' . tep_image_button('button_missing.gif', IMAGE_MISSING) . '</a> <a href="' . tep_href_link(FILENAME_IMAGES_REGEN, 'action=orphans') . '">' . tep_image_button('button_orphans.gif', IMAGE_ORPHANS) . '</a>');
						  $contents[] = array('align' => 'center', 'text' => '<br><br><a href="' . tep_href_link(FILENAME_IMAGES_REGEN, 'action=regenerate_confirm_only_missing') . '">' . tep_image_button('button_regenerate_missing.gif', IMAGE_REGENERATE_MISSING) . '</a>');
						  $contents[] = array('align' => 'center', 'text' => '<br><br><a href="' . tep_href_link(FILENAME_IMAGES_REGEN, 'action=regenerate_confirm') . '">' . tep_image_button('button_regenerate_everything.gif', IMAGE_REGENERATE_EVERYTHING) . '</a><br><br>');
						  break;
					}
		
		            $box = new box;
                    echo $box->infoBox($heading, $contents);
	                ?>
                    </td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>        
    </table></td>  
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>

<?php
function listDirectory($path) {
  @ini_set('max_execution_time', 3600);
  $handle = @opendir($path);
  while (false !== ($file = readdir($handle))) {
    if ($file == '.' || $file == '..' || $file == '.svn') continue;
	  if ( is_dir("$path$file")) {  // Directory
        $source_bigimage = listDirectory("$path$file");
      } else {  // File
        $source_bigimage = "$path/$file";
      }  
	
	if ($source_bigimage) {
    		require('includes/functions/image_generator.php'); 
	}
	
  } // end while
    closedir($handle);
}

function listDirectory_onlymissing($path) {
  $handle = @opendir($path);
  $file_exists_count = '';
  $regen_image_set_count = '0'; 

  while (false !== ($file = readdir($handle))) {
    if ($file == '.' || $file == '..' || $file == '.svn') continue;
	  if ( is_dir("$path$file")) {  // Directory
        $source_bigimage = listDirectory("$path$file");
      } else {  // File
        $source_bigimage = "$path/$file";
      }  

	if ($source_bigimage) {
	  $slash_pos = strripos($source_bigimage, '/');  // find last / in the image name
	  $image_name_only = substr($source_bigimage, $slash_pos ); // Add this to the search path
	  $filename_products = DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_PRODUCTS_DIR . $image_name_only ;
	  $filename_thumbs = DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $image_name_only ;
	  $file_does_not_exist_count = ''; //reset count

	  //check if product verions of picture exists
	  if (file_exists($filename_products)) {
    	// no nothing
	  } else {
   		$file_does_not_exist_count++;
	  }

	  //check if thumb verions of picture exists
	  if (file_exists($filename_thumbs)) {
    	// no nothing
	  } else {
   		$file_does_not_exist_count++;
	  }

	  if ($file_does_not_exist_count != 0) { //indicates a missing file so regen image set
	    $regen_image_set_count++;
		//regenerate thumbs/products/images_big picture set with the file name of '$source_bigimage'
		require('includes/functions/image_generator.php'); 
	  }
	}
  } // end while
  closedir($handle);	
  return $regen_image_set_count;
}
?>