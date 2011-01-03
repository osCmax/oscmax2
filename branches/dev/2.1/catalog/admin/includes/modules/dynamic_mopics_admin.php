<?php
/*
$Id$

  Dynamic MoPics Admin, built for osCmax 2.0.4/2.1 ejsolutions
  Copyright 2000 - 2011 osCmax
  Released under the GNU General Public License
  ---------------------------------------------------
  osCmax e-Commerce
  http://www.oscmax.com
  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
	// Backwards support for older osCommerce versions
	if (isset($product_info_values) && is_object($product_info_values)) {
		$product_info =& $product_info_values;
	}
	// Set the thumbnail basename; replaces "imagebase" in the user's pattern
	$image_base = mopics_get_imagebase($products_image_name, $root_thumbs);
	// Set the large image's basename; replaces "imagebase" in the user's pattern
	$image_base_lg = mopics_get_imagebase($products_image_name, $root_images_dir);
	// Get the counting method for the user's pattern (1,2,3; a,b,c; A,B,C; etc)
	$i = mopics_getmethod(DYNAMIC_MOPICS_PATTERN);
	// Set the search for the str_replace pattern search/replace
	$search = array('imagebase', mopics_match_pattern(DYNAMIC_MOPICS_PATTERN));
	// Set the initial replace for the str_replace pattern search/replace
	$replace = array($image_base, $i);
	// Are there any extra thumbnails for this product?
	if (mopics_file_exists(str_replace($search, $replace, DYNAMIC_MOPICS_PATTERN))) {
	?>
	<tr>
      	<td>
		<div class="screenshotsHeader">
		<div class="screenshotsHeaderText">Other images for this product:</div>
		</div>
		<div class="screenshotsBlock"> 
		           <div align="center">
				<div class="screenshots">
       <?php
	$row = 0;

	// Loop until all of this product's thumbnails have been found and displayed
		while ($image_ext = mopics_file_exists(str_replace($search, $replace, DYNAMIC_MOPICS_PATTERN))) {
			$row++;
			// Set the thumbnail image for this loop
			$image = str_replace($search, $replace, DYNAMIC_MOPICS_PATTERN) . '.' . $image_ext;
			$html_image = "../" . str_replace(DIR_FS_CATALOG, '', $image);
			// Parse this thumbnail through tep_image for clients with javascript disabled
			$extraImageImage = tep_image($image, stripslashes($products_image_name), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
			// Set large image replacement for the str_replace pattern search/replace
			$replace_lg = array($image_base_lg, $i);
			// Only link to the popup if a larger image exists
			if ($lg_image_ext = mopics_file_exists(str_replace($search, $replace_lg, DYNAMIC_MOPICS_PATTERN))) {

				// Set the large image for this loop
				$image_lg = str_replace($search, $replace_lg, DYNAMIC_MOPICS_PATTERN) . '.' . $lg_image_ext;
				$html_image_lg = HTTP_SERVER . DIR_WS_CATALOG . str_replace(DIR_FS_CATALOG, '', $image_lg);
			
				// Get the large image's size
				$image_size = @getimagesize($html_images_dir . $image_lg);
				// Set large image's URL for clients with javascript disabled
				$extraImageURL = tep_href_link($image_lg);
				// Parse this thumbnail through tep_image for clients with javascript enabled
				$extraImagePopupImage = tep_image($image, addslashes($products_image_name), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
				// Set the large image's popup width
				$extraImagePopupWidth = ((int)$image_size[0] + 5);
				// Set the large image's popup height
				$extraImagePopupHeight = ((int)$image_size[1] + 30);

?>
<centre>
<!-- LIGHTBOX/SLIMBOX -->
<script type="text/javascript"><!--
document.write('<?php echo '<a href="' . $html_image_lg . '" target="_blank" rel="lightbox[group]" title="'.$product_info['products_name'].'" >' . tep_image($html_image, $product_info['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT, 'hspace="4" vspace="4"') . '</a>'; ?>');
//--></script>
<!-- EOF LIGHTBOX/SLIMBOX -->
          <noscript>
            <a href="<?php echo $html_image_lg; ?>" target="_blank"><?php echo '<img src="' . $html_image . '">'; ?></a>
          </noscript>
</centre>
<?php
			} else {
				// No larger image found; Only display the thumbnail without a "click to enlarge" link
				echo '<div class="screenshots">' . $html_image_lg . '</div>';
			}
			// Increase current count
			$i++;
			// Update the replace for the str_replace pattern search/replace for next image in the sequence
			$replace = array($image_base, $i);
		}
		// All thumbnails have been found and displayed; clear all of the CSS floats
		echo '<div class="clearScreenshots"><hr /></div>';
	} else {
		// No extra images found for this product
		// echo '<p class="noScreenshots"><span class="smallText">' . TEXT_NO_MOPICS . '</span></p>';
	}
?>
           </div>
       </td>
    </tr>