<?php
/*
    Specify Fixed Product Image Height or Width
    Ridexbuilder - http://ejsolutions.co.uk
    osCMax 2010
    Released under GPL
*/
  $images_dir = DIR_WS_IMAGES; // default catalog images folder;
  $root_images_dir = DIR_FS_CATALOG .  $images_dir . DYNAMIC_MOPICS_BIGIMAGES_DIR;
  $root_products_dir = DIR_FS_CATALOG .  $images_dir . DYNAMIC_MOPICS_PRODUCTS_DIR;  
  $root_thumbs_dir = DIR_FS_CATALOG . $images_dir . DYNAMIC_MOPICS_THUMBS_DIR;
  $new_dir = preg_replace('/[^a-zA-Z0-9_.-]/i', '_',$_POST['new_directory']); 
  $dir = (tep_not_null($new_dir) ? $new_dir : $_POST['directory']);
  $cache_dir = 'cache/';  
 
// instant update	
   if ($action == 'new_product_preview') {

// copy image only if modified
        if ($dir && !is_dir($root_images_dir . $dir)) { 
				   if (mkdir($root_images_dir . $dir)) $messageStack->add('Folder ' . $dir . ' created in '. $root_images_dir . '.', 'success');
				}
        if ($dir && !is_dir($root_products_dir . $dir)) { 
                   if (mkdir($root_products_dir . $dir)) $messageStack->add('Folder ' . $dir . ' created in '. $root_products_dir . '.', 'success');
                }               
        if ($dir && !is_dir($root_thumbs_dir . $dir)) { 
                   if (mkdir($root_thumbs_dir . $dir)) $messageStack->add('Folder ' . $dir . ' created in '. $root_thumbs_dir . '.', 'success');
				}				
        $products_image = new upload('products_image');
        $products_image->set_destination($root_images_dir . ($dir ? $dir .'/' : ''));
        
        if ($products_image->parse() && $products_image->save()) {
          $products_image_name =  ($dir ? $dir . '/' : '') . $products_image->filename;

require_once( DIR_FS_CATALOG . 'ext/phpthumb/phpthumb.class.php');

// create phpThumb object
$phpThumb = new phpThumb();
        if (PRODUCT_IMAGE_WIDTH !='') {
            // create 3 sizes of image based on width
            $resized_images = array(SMALL_IMAGE_WIDTH => $root_thumbs_dir, PRODUCT_IMAGE_WIDTH => $root_products_dir, POPUP_IMAGE_WIDTH => $root_images_dir);
            foreach ($resized_images as $resized_width => $dest_dir) {
	// this is very important when using a single object to process multiple images
	$phpThumb->resetObject();

// set data source -- do this first, any settings must be made AFTER this call
if (is_uploaded_file(@$_FILES['userfile']['tmp_name'])) {
	$phpThumb->setSourceFilename($_FILES['userfile']['tmp_name']);
                $output_filename = $dest_dir . $dir .basename($_FILES['userfile']['name']).'_'.$resized_width.'.'.$phpThumb->config_output_format;
} else {
	$phpThumb->setSourceData(file_get_contents($root_images_dir . $products_image_name));
	$output_filename = $dest_dir . $products_image_name;
}

// set parameters (see "URL Parameters" in phpthumb.readme.txt)
		$phpThumb->setParameter('config_cache_directory', $cache_dir);
                $phpThumb->setParameter('w', $resized_width);

                if ($dest_dir == $root_images_dir) { 
	$phpThumb->setParameter('h', POPUP_IMAGE_HEIGHT);  //specify max height for popup
	$phpThumb->setParameter('q', 90);  //maintain higher quality for popup
	}

                if ($dest_dir == $root_products_dir) {
                	if (PRODUCT_IMAGE_WIDTH == '') {
                	  $phpThumb->setParameter('h', PRODUCT_IMAGE_HEIGHT);
                	} else {
                 	  $phpThumb->setParameter('w', PRODUCT_IMAGE_WIDTH);  
                 	}             		 
                    $phpThumb->setParameter('q', 80);  //maintain high quality for product image
                }

                if ($dest_dir == $root_thumbs_dir) {
                  	if (PRODUCT_IMAGE_WIDTH == '') {
                	  $phpThumb->setParameter('h', SMALL_IMAGE_HEIGHT);
                	} else {
                 	  $phpThumb->setParameter('w', SMALL_IMAGE_WIDTH);  
                 	}             		 
                    $phpThumb->setParameter('q', 75);
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
        } else {
            // create 3 sizes of image based on height
            $resized_images = array(SMALL_IMAGE_HEIGHT => $root_thumbs_dir, PRODUCT_IMAGE_HEIGHT => $root_products_dir, POPUP_IMAGE_HEIGHT => $root_images_dir);
            foreach ($resized_images as $resized_height => $dest_dir) {
                // this is very important when using a single object to process multiple images
                $phpThumb->resetObject();

                // set data source -- do this first, any settings must be made AFTER this call
                if (is_uploaded_file(@$_FILES['userfile']['tmp_name'])) {
                $phpThumb->setSourceFilename($_FILES['userfile']['tmp_name']);
                $output_filename = $dest_dir . $dir .basename($_FILES['userfile']['name']).'_'.$resized_height.'.'.$phpThumb->config_output_format;
                } else {
                $phpThumb->setSourceData(file_get_contents($root_images_dir . $products_image_name));
                $output_filename = $dest_dir . $products_image_name;
                }

                // set parameters (see "URL Parameters" in phpthumb.readme.txt)
		$phpThumb->setParameter('config_cache_directory', $cache_dir);
                $phpThumb->setParameter('h', $resized_height);

                if ($dest_dir == $root_images_dir) { 
                    $phpThumb->setParameter('w', POPUP_IMAGE_WIDTH);  //specify max width for popup
                    $phpThumb->setParameter('q', 90);  //maintain higher quality for popup
                }

                if ($dest_dir == $root_products_dir) {
                	if (PRODUCT_IMAGE_WIDTH == '') {
                	  $phpThumb->setParameter('h', PRODUCT_IMAGE_HEIGHT);
                	} else {
                 	  $phpThumb->setParameter('w', PRODUCT_IMAGE_WIDTH);  
                 	}             		 
                    $phpThumb->setParameter('q', 80);  //maintain high quality for product image
                }

                if ($dest_dir == $root_thumbs_dir) {
                  	if (PRODUCT_IMAGE_WIDTH == '') {
                	  $phpThumb->setParameter('h', SMALL_IMAGE_HEIGHT);
                	} else {
                 	  $phpThumb->setParameter('w', SMALL_IMAGE_WIDTH);  
                 	}             		 
                    $phpThumb->setParameter('q', 75);
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
        }
// end thumbnail creation                
        } else {
          $products_image_name = (isset($_POST['products_previous_image']) ? $_POST['products_previous_image'] : '');
        }

	if ($_POST['instant_update'] == 'on') { 
	  $_POST['products_image'] = stripslashes($products_image_name);
        $action = (isset($_GET['pID']) ? 'update_product' : 'insert_product');  
	}
}
?>
