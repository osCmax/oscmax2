<?php
/*
$Id$
  
  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax
  
  Released under the GNU General Public License
*/  


/*
  Dynamic MoPics version 3.000, built for osCommerce MS2
  Copyright 2006 Josh Dechant
  Released under the GNU General Public License

 Dynamic MoPics: Modded by ejsolutions (E Jonsen) April 2009
  ---------------------------------------------------
*/
if (isset($product_info_values) && is_object($product_info_values)) {
		$product_info =& $product_info_values;
	}
	// Set the thumbnail basename; replaces "imagebase" in the user's pattern
	$image_base = mopics_get_imagebase($product_info['products_image'], DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR);
	// Set the product image's basename; replaces "imagebase" in the user's pattern
	$image_base_prod = mopics_get_imagebase($product_info['products_image'], DIR_WS_IMAGES . DYNAMIC_MOPICS_PRODUCTS_DIR);
	// Set the large image's basename; replaces "imagebase" in the user's pattern
	$image_base_lg = mopics_get_imagebase($product_info['products_image'], DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR);
	// Get the counting method for the user's pattern (1,2,3; a,b,c; A,B,C; etc)
	$i = mopics_getmethod(DYNAMIC_MOPICS_PATTERN);
	// Set the search for the str_replace pattern search/replace
	$search = array('imagebase', mopics_match_pattern(DYNAMIC_MOPICS_PATTERN));
	// Set the initial replace for the str_replace pattern search/replace
	$replace = array($image_base, $i);
	// Are there any extra thumbnails for this product?
	if (mopics_file_exists(str_replace($search, $replace, DYNAMIC_MOPICS_PATTERN))) {
	?>
  <table width="100%" cellpadding="0" cellspacing="0" border="0">
	<tr>
      <td class="productinfo_thumbnail">
        <div class="screen2">
        <table width="100%" cellpadding="0" cellspacing="0" border="0">
          <tr>
            <td>
		      <img class="prev" src="images/icons/control_rewind.png" alt="prev">
 			</td>
            <td>           
			  <div id="slideshow">
           		<ul>
                
                <!-- If there are extra pictures we need to add the big image thumbnail to display as well otherwise you can not switch back! -->
	            <li>            
                  <a href='<?php echo $lightlarge; ?>' id='cz0' class='cloud-zoom-gallery' title='Thumbnail 1' rel="useZoom: 'zoom1', smallImage: '<?php echo DIR_WS_IMAGES . DYNAMIC_MOPICS_PRODUCTS_DIR . $product_info['products_image']; ?>' ">
                  <img src="<?php echo DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $product_info['products_image']; ?>" alt = "Thumbnail 1"/>
                  </a>
	            </li>
    	
<?php	
	$row = 0;
	// Need to build a string like jQuery.slimbox([["cat.jpg", "Nice cat"], ["dog.jpg"]], 0);
	$sb_string = '[';
	// Need another string built to find index of image clicked
	$sb_image_string = '';
	// Now add the first image shown as it will always be there
	$sb_string .= '["' . $lightlarge . '", "' . $product_info['products_name'] . '"],'; 
	$sb_image_string .= $lightlarge;
	// Loop until all of this product's thumbnails have been found and displayed
		while ($image_ext = mopics_file_exists(str_replace($search, $replace, DYNAMIC_MOPICS_PATTERN))) {
			$row++;
			// Set the thumbnail image for this loop
			$image = str_replace($search, $replace, DYNAMIC_MOPICS_PATTERN) . '.' . $image_ext;
			// Parse this thumbnail through tep_image for clients with javascript disabled
			$extraImageImage = tep_image($image, stripslashes($product_info['products_name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
			// Set product image replacement for the str_replace pattern search/replace
			$replace_prod = array($image_base_prod, $i);
			// Set large image replacement for the str_replace pattern search/replace
			$replace_lg = array($image_base_lg, $i);
			// Only link to the popup if a larger image exists
			if ($lg_image_ext = mopics_file_exists(str_replace($search, $replace_lg, DYNAMIC_MOPICS_PATTERN))) {
				// Set the product image for this loop
				$image_prod = str_replace($search, $replace_prod, DYNAMIC_MOPICS_PATTERN) . '.' . $lg_image_ext;
				// Set the large image for this loop
				$image_lg = str_replace($search, $replace_lg, DYNAMIC_MOPICS_PATTERN) . '.' . $lg_image_ext;
				// Get the large image's size
				$image_size = @getimagesize(DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR . $image_lg);
?>
				<li>             
                  <a href='<?php echo $image_lg; ?>' id='cz<?php echo $row;?>' class='cloud-zoom-gallery' title='<?php echo $product_info['products_name']; ?>' rel="useZoom: 'zoom1', smallImage: '<?php echo $image_prod; ?>' ">
                  <img src="<?php echo $image; ?>" alt = "<?php echo $product_info['products_name']; ?>">
                  </a>
				</li>
<?php
                // Now lets generate an image string for Slimbox to open
				$sb_string .= '["' . $image_lg . '", "' . htmlspecialchars($product_info['products_name']) . '"],';
				$sb_image_string .= ', ' . $image_lg;
				
			} else {
				// No larger image found; Only display the thumbnail without a "click to enlarge" link
				echo '<li>' . $extraImageImage . '</li>';
			}
			// Increase current count
			$i++;
			// Update the replace for the str_replace pattern search/replace for next image in the sequence
			$replace = array($image_base, $i);
		}
		// Finish looping through mopics - need to close Slimbox string builer
		$sb_string = substr($sb_string, 0, -1);
		$sb_string .= ']';
		
		// All thumbnails have been found and displayed; clear all of the CSS floats
?>  
		        </ul>
              </div>
			</td>
            <td>
              <img class="next" src="images/icons/control_fastforward.png" alt="next">
            </td>
          </tr>
        </table>
        </div>
        </td>
      </tr>		
    </table>
<?php	
	} else {
		// No extra images found for this product we need to let Cloud Zoom open the single image on click
		$sb_string = '[["' . $lightlarge . '", "' . $product_info['products_name'] . '"]]'; 
		$sb_image_string = $lightlarge;
	}
?>			