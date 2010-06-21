<?php
/*
$Id: dynamic_mopics.php 3 2006-05-27 04:59:07Z user $
  Dynamic MoPics version 3.000, built for osCommerce MS2
  Copyright 2006 osCMax2004-2005 Josh Dechant
  Released under the GNU General Public License

 Dynamic MoPics: Modded by ejsolutions (E Jonsen) April 2009 oscMax v2.0.2
  ---------------------------------------------------
  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax
  Released under the GNU General Public License
*/
if (isset($product_info_values) && is_object($product_info_values)) {
		$product_info =& $product_info_values;
	}
	// Set the thumbnail basename; replaces "imagebase" in the user's pattern
	$image_base = mopics_get_imagebase($product_info['products_image'], DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR);
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
      <?php 
	  $image_ext = mopics_file_exists(str_replace($search, $replace, DYNAMIC_MOPICS_PATTERN));
	  $image_fix = $image_base_lg . '.' . $image_ext;
	  echo '<a href="' . tep_href_link($image_fix) . '" target="_blank" rel="lightbox[group]" title="'.$product_info['products_name'].'" >' .  tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $product_info['products_image'], $product_info['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a>';?>
	</li>
    	
<?php	
	$row = 0;
	// Loop until all of this product's thumbnails have been found and displayed
		while ($image_ext = mopics_file_exists(str_replace($search, $replace, DYNAMIC_MOPICS_PATTERN))) {
			$row++;
			// Set the thumbnail image for this loop
			$image = str_replace($search, $replace, DYNAMIC_MOPICS_PATTERN) . '.' . $image_ext;
			// Parse this thumbnail through tep_image for clients with javascript disabled
			$extraImageImage = tep_image($image, stripslashes($product_info['products_name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
			// Set large image replacement for the str_replace pattern search/replace
			$replace_lg = array($image_base_lg, $i);
			// Only link to the popup if a larger image exists
			if ($lg_image_ext = mopics_file_exists(str_replace($search, $replace_lg, DYNAMIC_MOPICS_PATTERN))) {
				// Set the large image for this loop
				$image_lg = str_replace($search, $replace_lg, DYNAMIC_MOPICS_PATTERN) . '.' . $lg_image_ext;
				// Get the large image's size
				$image_size = @getimagesize(DIR_WS_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR . $image_lg);
				// Set large image's URL for clients with javascript disabled
				$extraImageURL = tep_href_link($image_lg);
				// Parse this thumbnail through tep_image for clients with javascript enabled
				$extraImagePopupImage = tep_image($image, addslashes($product_info['products_name']), SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
				// Set the large image's popup width
				$extraImagePopupWidth = ((int)$image_size[0] + 5);
				// Set the large image's popup height
				$extraImagePopupHeight = ((int)$image_size[1] + 20);
				// Set the large image's popup URL text
				$extraImageURLText = TEXT_CLICK_TO_ENLARGE;
				// Set the large image's popup URL
				$extraImagePopupURL = tep_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $product_info['products_id'] . '&pic=' . $i . '&type=' . $lg_image_ext);
?>
				<li>             
                  <!-- LIGHTBOX/SLIMBOX -->
                  <script type="text/javascript"><!--
                  document.write('<?php echo '<a href="' . tep_href_link($image_lg) . '" target="_blank" rel="lightbox[group]" title="'.$product_info['products_name'].'" >' . $extraImagePopupImage; ?></a>');
                  //--></script>
                  <!-- EOF LIGHTBOX/SLIMBOX -->

                  <noscript>
                    <a href="<?php echo $extraImageURL; ?>" target="_blank"><?php echo $extraImageImage; ?></a>
                  </noscript>
				</li>
<?php
			} else {
				// No larger image found; Only display the thumbnail without a "click to enlarge" link
				echo '<li>' . $extraImageImage . '</li>';
			}
			// Increase current count
			$i++;
			// Update the replace for the str_replace pattern search/replace for next image in the sequence
			$replace = array($image_base, $i);
		}
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

<?php	
	} else {
		// No extra images found for this product
		// echo '<p class="noScreenshots"><span class="smallText">' . TEXT_NO_MOPICS . '</span></p>';      
    }
?>			