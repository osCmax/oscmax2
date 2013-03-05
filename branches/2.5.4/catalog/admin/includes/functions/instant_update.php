<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require_once( DIR_FS_CATALOG . 'ext/phpthumb/phpthumb.class.php');
  require('image_resize.php');

  $images_dir = DIR_WS_IMAGES; // default catalog images folder;
  $root_images_dir = DIR_FS_CATALOG .  $images_dir . DYNAMIC_MOPICS_BIGIMAGES_DIR;
  $root_products_dir = DIR_FS_CATALOG .  $images_dir . DYNAMIC_MOPICS_PRODUCTS_DIR;  
  $root_thumbs_dir = DIR_FS_CATALOG . $images_dir . DYNAMIC_MOPICS_THUMBS_DIR;
  
  $exclude_folders = array("banners","default","icons","mail","infobox","js", ".svn");
  $new_dir = preg_replace('/[^a-zA-Z0-9_.-]/i', '_',$_POST['new_directory']); 
  $dir = (tep_not_null($new_dir) ? $new_dir : $_POST['directory']);
  $cache_dir = 'cache/';  
 
// instant update	
  if ($action == 'new_product_preview') {

// create image folders if needed
    if ($dir && !is_dir($root_images_dir . $dir)) { 
      if (mkdir($root_images_dir . $dir)) $messageStack->add('Folder ' . $dir . ' created in '. $root_images_dir . '.', 'success');
    }
    if ($dir && !is_dir($root_products_dir . $dir)) { 
      if (mkdir($root_products_dir . $dir)) $messageStack->add('Folder ' . $dir . ' created in '. $root_products_dir . '.', 'success');
    }               
    if ($dir && !is_dir($root_thumbs_dir . $dir)) { 
      if (mkdir($root_thumbs_dir . $dir)) $messageStack->add('Folder ' . $dir . ' created in '. $root_thumbs_dir . '.', 'success');
	}
	
// Get the base image filename 
  if ($_FILES['products_image']['name'] == '') { 
    // We need to use the previous image name as the user has not uploaded the base image
    $main_image = $_POST['products_previous_image'];
  } else {
    $main_image = $_FILES['products_image']['name'];
  }
  $ext = substr(strrchr($main_image, '.'), 0);
  $base_image = str_replace($ext, "", $main_image); 	

// work out extension for the mopics images
    for ($img = 0; $img <= NO_OF_DYNAMIC_MOPICS; $img++) {
		
	  if ($img == 0) { // First image so no extension needed
	    $mopics_ext = '';
	  } else { // For each mopic image we need to upload
	    $mopics_ext = '_' . $img;
	  }
	
// now lets upload the images	   
	  if ($_FILES['products_image' . $mopics_ext]['name'] != '') {
        if ($products_image = new upload('products_image' . $mopics_ext, $root_images_dir . ($dir ? $dir .'/' : ''))) {
		  if ($img != 0) { // we are dealing with dynamic mopics images
		    // rename the images to be in the _1, _2, _3 etc. image structure
			rename($root_images_dir . ($dir ? $dir .'/' : '') . $products_image->filename, $root_images_dir . ($dir ? $dir .'/' : '') . $base_image . '_' . $img . $ext);
			// now lets copy them to the products and thumbs directories
		    copy($root_images_dir . ($dir ? $dir .'/' : '') . $base_image . '_' . $img . $ext, $root_products_dir . ($dir ? $dir .'/' : '') . $base_image . '_' . $img . $ext);
	        copy($root_images_dir . ($dir ? $dir .'/' : '') . $base_image . '_' . $img . $ext, $root_thumbs_dir . ($dir ? $dir .'/' : '') . $base_image . '_' . $img . $ext);
	        // now lets resize them all to the correct dimensions
			image_resize($root_images_dir . ($dir ? $dir .'/' : '') . $base_image . '_' . $img . $ext, POPUP_IMAGE_WIDTH, POPUP_IMAGE_HEIGHT, '100');
            image_resize($root_products_dir . ($dir ? $dir .'/' : '') . $base_image . '_' . $img . $ext, PRODUCT_IMAGE_WIDTH, PRODUCT_IMAGE_HEIGHT, '100');
			image_resize($root_thumbs_dir . ($dir ? $dir .'/' : '') . $base_image . '_' . $img . $ext, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, '100');		
		  } else {
			// set the image path in the database to include the $dir path if needed
			$products_image_name =  ($dir ? $dir . '/' : '') . $products_image->filename;
		    // we just need to copy the base image to the products and thumbs directories
			copy($root_images_dir . ($dir ? $dir .'/' : '') . $products_image->filename, $root_products_dir . ($dir ? $dir .'/' : '') . $products_image->filename);
	        copy($root_images_dir . ($dir ? $dir .'/' : '') . $products_image->filename, $root_thumbs_dir . ($dir ? $dir .'/' : '') . $products_image->filename);
			// and then resize them
			image_resize($root_images_dir . ($dir ? $dir .'/' : '') . $products_image->filename, POPUP_IMAGE_WIDTH, POPUP_IMAGE_HEIGHT, '100');
            image_resize($root_products_dir . ($dir ? $dir .'/' : '') . $products_image->filename, PRODUCT_IMAGE_WIDTH, PRODUCT_IMAGE_HEIGHT, '100');
			image_resize($root_thumbs_dir . ($dir ? $dir .'/' : '') . $products_image->filename, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, '100');
		  }
	    }
	  }
    
	  // Finally lets check if the user has selected to delete this image
      if ($_POST['delete_image' . $img] == 'on') {
		if ($img == 0) {
		// If main image being deleted then set the database image name to **delete** so it can be removed later in categories.php
		$products_image_name = '**delete**';
		}
		// Now remove the actual images
		unlink($root_images_dir . ($dir ? $dir .'/' : '') . $base_image . $mopics_ext . $ext);
		unlink($root_products_dir . ($dir ? $dir .'/' : '') . $base_image . $mopics_ext . $ext);
		unlink($root_thumbs_dir . ($dir ? $dir .'/' : '') . $base_image . $mopics_ext . $ext);
	  }

	} // end for ($img = 0; $img <= 5; $img++)
	
// Check if we want to skip the preview page					
	if ($_POST['instant_update'] == 'on') { 
	  $_POST['products_image'] = stripslashes($products_image_name);
        $action = (isset($_GET['pID']) ? 'update_product' : 'insert_product');  
	}
}
?>
