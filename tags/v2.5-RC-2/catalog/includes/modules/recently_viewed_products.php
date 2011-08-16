<?php
/*
$Id: product_listing.php 1158 2011-02-18 22:14:25Z cottonbarn $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// Adpated by pgm from: http://addons.oscommerce.com/info/7759

// Lets set the number of history items to display
$display_count = 4;
$visited_output = '';

$action = (isset($_GET['action']) ? $_GET['action'] : '');
if ($action == 'clear_history') {
  unset($_SESSION['last_product_views']);
}

// Build history string
$last_product_views = $_SESSION['last_product_views'];
if ($last_product_views != "") {
  $visited_array = explode('|', $_SESSION['last_product_views']);
  $output_count = 1;	
	foreach ($visited_array as $visited_array_item) {
	  $visited_item = trim($visited_array_item);
		if ( ($visited_item != "") && ($output_count <= $display_count) ) {
			$item_pieces = explode("^", $visited_item);
			$item_image = trim($item_pieces[0]);
			$item_name = trim($item_pieces[1]);
			$item_url = trim($item_pieces[2]);
			$visited_output .= '<td align="center" class="main">';
			$last_visited_thumb = tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $item_image, $item_name, SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT);
			$visited_output .= '<a href="http://' . $item_url . '">' . $last_visited_thumb . '</a><br>' . $item_name;
			$output_count++;
		}
	}
}

// Now look at the current page
if (basename($_SERVER['SCRIPT_NAME']) == "product_info.php") {
	// First remove the action=clear_history from the url
	$current_product_path = str_replace('&action=clear_history', '', $_SERVER['HTTP_HOST']  . $_SERVER['REQUEST_URI']);
	//$pieces = explode("?osCsid", $current_product_path);
	//$current_product_path = $pieces[0];
	$new_array_item = $product_info['products_image'] . '^' . $product_info['products_name']. '^' . $current_product_path;

// and add it to the $_SESSION variable
  $last_product_views = $_SESSION['last_product_views'];
  if ($last_product_views == "") {
	$_SESSION['last_product_views'] = trim($new_array_item);
  } else {
	$items_array = explode('|', $_SESSION['last_product_views']);	
	$count = 1;
	$new_array_string = '';
	  foreach ($items_array as $array_item) {
		if ($count <= $display_count) {
		  $array_item = trim($array_item);
		  if ($array_item != "") {
			if ($array_item != $new_array_item) {
		      $new_array_string .= "|" . $array_item;
			  $count++;
			}	
		  }
		}
      }
	$_SESSION['last_product_views'] = $new_array_item . '|' . $new_array_string;
  }
}

// Display history string to browser
if ($last_product_views != "") {
      $info_box_contents = array();
      $info_box_contents[] = array('align' => 'left', 'text' => '&nbsp;' . TEXT_LAST_VISITED_PRODUCTS);
      new recentHistoryBoxHeading($info_box_contents, 'true', 'true', tep_href_link($_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'], tep_get_all_get_params(array('action')) . 'action=clear_history'));
	  
	  $info_box_contents = array();
      $info_box_contents[] = array('align' => 'left', 'text' => $visited_output);
      new contentBox($info_box_contents);
	  ?>
	  <table>
	    <tr>
          <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
        </tr>
      </table>
      <?php
} // end if ($last_product_views != "")
?>