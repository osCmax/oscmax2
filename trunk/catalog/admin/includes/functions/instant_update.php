<?php
  $images_dir = DIR_WS_IMAGES; // default catalog images folder;
  $exclude_folders = array("banners","default","icons","mail","infobox","js"); // folders to exclude from adding new images
  $root_images_dir = DIR_FS_CATALOG .  $images_dir . DYNAMIC_MOPICS_BIGIMAGES_DIR;
  $root_thumbs = DIR_FS_CATALOG . $images_dir . DYNAMIC_MOPICS_THUMBS_DIR;
  $html_images_dir =  DIR_WS_CATALOG .  $images_dir . DYNAMIC_MOPICS_BIGIMAGES_DIR;
  $html_thumbs =  DIR_WS_CATALOG .  $images_dir . DYNAMIC_MOPICS_THUMBS_DIR;  
  $new_dir = preg_replace('/[^a-zA-Z0-9_.-]/i', '_',$_POST['new_directory']); 
  $dir = (tep_not_null($new_dir) ? $new_dir : $_POST['directory']);
 
// instant update	
   if ($action == 'new_product_preview') {

// copy image only if modified
        if ($dir && !is_dir($root_images_dir . $dir)) { 
				   if (mkdir($root_images_dir . $dir)) $messageStack->add('Folder ' . $dir . ' created in '. $root_images_dir . '.', 'success');
				}
        if ($dir && !is_dir($root_thumbs . $dir)) { 
				   if (mkdir($root_thumbs . $dir)) $messageStack->add('Folder ' . $dir . ' created in '. $root_thumbs . '.', 'success');
				}				
        $products_image = new upload('products_image');
        $products_image->set_destination($root_images_dir . ($dir ? $dir .'/' : ''));
        
        if ($products_image->parse() && $products_image->save()) {
          $products_image_name =  ($dir ? $dir . '/' : '') . $products_image->filename;

require_once( DIR_FS_CATALOG . 'ext/phpthumb/phpthumb.class.php');

// create phpThumb object
$phpThumb = new phpThumb();

// create 2 sizes of 'thumbnail'
// Note: thumbnail referenced below applies to both image sizes.
$thumbnails = array(PRODUCT_IMAGE_WIDTH => $root_thumbs, POPUP_IMAGE_WIDTH => $root_images_dir);
foreach ($thumbnails as $thumbnail_width => $dest_dir) {
	// this is very important when using a single object to process multiple images
	$phpThumb->resetObject();

// set data source -- do this first, any settings must be made AFTER this call
if (is_uploaded_file(@$_FILES['userfile']['tmp_name'])) {
	$phpThumb->setSourceFilename($_FILES['userfile']['tmp_name']);
		$output_filename = $dest_dir . $dir .basename($_FILES['userfile']['name']).'_'.$thumbnail_width.'.'.$phpThumb->config_output_format;
} else {
	$phpThumb->setSourceData(file_get_contents($root_images_dir . $products_image_name));
	$output_filename = $dest_dir . $products_image_name;
}

// set parameters (see "URL Parameters" in phpthumb.readme.txt)
$phpThumb->setParameter('config_cache_directory', DIR_FS_CATALOG . 'cache/'); //doesn't work!
$phpThumb->setParameter('w', $thumbnail_width);
if ($dest_dir = $root_images_dir) { 
	$phpThumb->setParameter('h', POPUP_IMAGE_HEIGHT);  //specify max height for popup
	$phpThumb->setParameter('q', 90);  //maintain higher quality for popup
	}

// generate & output thumbnail
if ($phpThumb->GenerateThumbnail()) { // this line is VERY important, do not remove it!
	if ($phpThumb->RenderToFile($output_filename)) {
		// do something on success
	} else {
		// do something with debug/error messages
		echo 'Failed:<pre>'.implode("\n\n", $phpThumb->debugmessages).'</pre>';
	}
} else {
	// do something with debug/error messages
	echo 'Failed:<pre>'.$phpThumb->fatalerror."\n\n".implode("\n\n", $phpThumb->debugmessages).'</pre>';
}
}
// end thumbnail creation                
        } else {
          $products_image_name = (isset($HTTP_POST_VARS['products_previous_image']) ? $HTTP_POST_VARS['products_previous_image'] : '');
        }

	if ($_POST['instant_update'] == 'on') { 
	  $_POST['products_image'] = stripslashes($products_image_name);
        $action = (isset($_GET['pID']) ? 'update_product' : 'insert_product');  
	}
}
?>