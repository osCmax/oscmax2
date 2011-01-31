<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  $cache_dir = 'cache/';
  $root_images_dir = DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR;
  $root_products_dir = DIR_FS_CATALOG .  DIR_WS_IMAGES . DYNAMIC_MOPICS_PRODUCTS_DIR;  
  $root_thumbs_dir = DIR_FS_CATALOG . DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR;

  $products_path_image = str_replace($root_images_dir,'',$source_bigimage);
  
  $products_image_name = trim(strrchr($products_path_image,"/"),"/");
  $new_dir = str_replace($products_image_name,'',$products_path_image);
  $dir = (tep_not_null($new_dir) ? $new_dir : ".");  

// create sub-directories if required
        if ($dir && !is_dir($root_products_dir . $dir)) { 
            mkdir($root_products_dir . $dir);
        }               
        if ($dir && !is_dir($root_thumbs_dir . $dir)) { 
            mkdir($root_thumbs_dir . $dir);
	}	

// Start image generation        

include_once( DIR_FS_CATALOG . 'ext/phpthumb/phpthumb.class.php');

// create phpThumb object
$phpThumb = new phpThumb();
        if (PRODUCT_IMAGE_WIDTH !='') {
            // create 2 sizes of image based on width
            $resized_images = array(SMALL_IMAGE_WIDTH => $root_thumbs_dir, PRODUCT_IMAGE_WIDTH => $root_products_dir);
            foreach ($resized_images as $resized_width => $dest_dir) {
	// this is very important when using a single object to process multiple images
	$phpThumb->resetObject();

	// set data source -- do this first, any settings must be made AFTER this call

	$phpThumb->setSourceFilename($source_bigimage);	
	$output_filename = $dest_dir . $dir . $products_image_name;

	// set parameters (see "URL Parameters" in phpthumb.readme.txt)
		$phpThumb->setParameter('config_cache_directory', $cache_dir); //doesn't work!
                $phpThumb->setParameter('w', $resized_width);

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
                    $phpThumb->setParameter('q', 75);  //maintain high quality for product image
                }                
		// generate & output thumbnail
		if ($phpThumb->GenerateThumbnail()) { // this line is VERY important, do not remove it!
			if ($phpThumb->RenderToFile($output_filename)) {
			// do something on success
			//	echo "#";
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
            // create 2 sizes of image based on height
            $resized_images = array(SMALL_IMAGE_HEIGHT => $root_thumbs_dir, PRODUCT_IMAGE_HEIGHT => $root_products_dir);
            foreach ($resized_images as $resized_height => $dest_dir) {
                // this is very important when using a single object to process multiple images
                $phpThumb->resetObject();

                // set data source -- do this first, any settings must be made AFTER this call
		$phpThumb->setSourceFilename($source_bigimage);
		$output_filename = $dest_dir . $dir . $products_image_name;

                // set parameters (see "URL Parameters" in phpthumb.readme.txt)
		$phpThumb->setParameter('config_cache_directory', $cache_dir); //doesn't work!
                $phpThumb->setParameter('h', $resized_height);

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
                    $phpThumb->setParameter('q', 75);  //maintain high quality for product image
                }                
                // generate & output thumbnail
                if ($phpThumb->GenerateThumbnail()) { // this line is VERY important, do not remove it!
                    if ($phpThumb->RenderToFile($output_filename)) {
                    // do something on success
				echo "#";
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
?>