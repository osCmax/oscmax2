<?php
/*
$Id: product_image_upload.php 1459 2011-06-04 19:22:22Z ejsolutions $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
            <td class="main" bgcolor="#DDDDDD" colspan="2">
              <table border="0" cellpadding="2" cellspacing="0" width="100%">
                <tr>
                  <td colspan="4"><?php echo TEXT_IMAGE_TITLE; ?><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
                </tr>
                <tr>
                  <td class="main"><?php echo TEXT_PRODUCTS_IMAGE_DIRECTORY; ?></td>
						<?php 
						// Get the base image name
                        $main_image = $pInfo->products_image;
                        $ext = substr(strrchr($main_image, '.'), 0);
                        $base_image = str_replace($ext, "", $main_image);
				
						// place allowed sub-dirs in array, non-recursive
						$dir_array = array();
						if ($handle = opendir($root_images_dir)) {
								while (false !== ($file = readdir($handle))) {
								if ($file != "." && $file != "..") {
										if (is_dir($root_images_dir.$file) && !in_array($file,$exclude_folders)) $dir_array[] = preg_replace("/\/\//si", "/", $file);
								}
						}
						closedir($handle);
						sort($dir_array);
						} else { die("<table><tr><td class=\"messageStackError\">" . TEXT_PRODUCTS_DIRECTORY_DONT_EXIST_1 . " (" . $root_images_dir . ") " . TEXT_PRODUCTS_DIRECTORY_DONT_EXIST_2 . "</td></tr></table>");}
 					 $drop_array[0] = array('id' => '', 'text' => TEXT_PRODUCTS_IMAGE_ROOT_DIRECTORY);

					 foreach($dir_array as $img_dir) {
					   $drop_array[] = array('id' => $img_dir, 'text' => $img_dir);
					 }
 ?>
                  <td class="main"><?php echo tep_draw_pull_down_menu('directory', $drop_array); ?></td>
                  <td class="main"><?php echo TEXT_PRODUCTS_IMAGE_NEW_FOLDER; ?></td>
                  <td class="main"><?php echo tep_draw_input_field('new_directory'); ?></td>
                  <td rowspan="4" align="center">
                  <?php
                  if (file_exists(DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR . $pInfo->products_image)) {
				     echo tep_image(DIR_WS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $pInfo->products_image);
				  }
				  ?>
				  </td>
                </tr>
                <tr>
                  <td colspan="4"><?php echo tep_draw_separator('pixel_trans.gif', '1', '30'); ?></td>
                </tr>
                <tr>
                  <td class="main" width="152"></td>
                  <td class="main"><?php echo '&nbsp;' . TEXT_UPLOAD_IMAGES . '<span title="' . TEXT_UPLOAD_IMAGES . '|' . TEXT_MOPICS_CONTENT . '">' . tep_image(DIR_WS_ICONS . 'help.png', ''); ?></span></td>
                  <td class="main"><?php echo '&nbsp;' . TEXT_CURRENT_IMAGES; ?></td>
                  <td class="main" align="center"><?php echo '&nbsp;' . TEXT_DELETE_IMAGES; ?></td>
                </tr>
                <tr>
                  <td class="main"><?php echo TEXT_PRODUCTS_IMAGE; ?></td>
                  <td class="main"><?php echo '&nbsp;' . tep_draw_file_field('products_image') . tep_draw_separator('pixel_trans.gif', '24', '15'); ?></td>
                  <td class="main">
				  <?php
				  if (file_exists(DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR . $pInfo->products_image)) {
				    echo '&nbsp;' . $pInfo->products_image;
				  }
				  echo tep_draw_hidden_field('products_previous_image', $pInfo->products_image) . tep_draw_separator('pixel_trans.gif', '24', '15'); 
				  ?>
                  </td>
                  <td class="main" align="center">
				  <?php
				  if (file_exists(DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR . $pInfo->products_image)) {
				     echo tep_draw_checkbox_field('delete_image0');
				  }
				  ?>
                  </td>
                </tr>
                <?php 
          
		        for ($img = 1; $img <= NO_OF_DYNAMIC_MOPICS; $img++) { 
				  $next = $img;
				  $next++;
                  if ( !file_exists(DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR . $base_image . '_' . $img . $ext) && file_exists(DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR . $base_image . '_' . $next . $ext) ) {
			        echo '<tr class="messageStackError">';
				  } else {
				    echo '<tr bgcolor="#eeeeee">';
				  }
				?>
                  <td class="main"><?php echo TEXT_EXTRA_IMAGE . ' (' . $img . ')'; ?></td>
                  <td class="main"><?php echo '&nbsp;' . tep_draw_file_field('products_image_' . $img); ?></td>
                  <td class="main">
                  <?php 
			      if (file_exists(DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR . $base_image . '_' . $img . $ext)) {
			        echo '&nbsp;' . $base_image . '_' . $img . $ext . '</a';
			      } ?></td>
                  <td class="main" align="center">
                  <?php
                  if (file_exists(DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR . $base_image . '_' . $img . $ext)) {
			        echo tep_draw_checkbox_field('delete_image' . $img);
			      } ?>
                  </td>
                  <?php
                  if ( !file_exists(DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR . $base_image . '_' . $img . $ext) && file_exists(DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR . $base_image . '_' . $next . $ext) ) { ?>
                  <td valign="top">
                    <table>
                      <tr class="messageStackError">
                        <td><?php echo '<span title="' . TEXT_MOPICS_ERROR . '|' . TEXT_MOPICS_ERROR_HELP . '">' . tep_image(DIR_WS_ICONS . 'exclamation.png'); ?></span></td>
                        <td><?php echo TEXT_MOPICS_ERROR; ?></td>
                      </tr>
                    </table>
                  </td>
                  <?php
				  } else {
				  ?>
                  <td></td>
                  <?php
				  }
				  ?>
                  </td>
                </tr>
                <?php  
				} // end for ($img = 1; $img <= 5; $img++)
				?>
              </table>
            </td>
