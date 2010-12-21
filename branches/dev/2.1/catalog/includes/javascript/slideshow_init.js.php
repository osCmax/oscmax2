
<?php

  $count = 1;
  $images_string = '';
  $clean_images_string = '';
  $slideshow_query_raw = "select slideshow_id, slideshow_image, slideshow_title, slideshow_sort_order, slideshow_link, slideshow_target, date_added, last_modified from " . TABLE_SLIDESHOW . " order by slideshow_sort_order";
  $slideshow_query = tep_db_query($slideshow_query_raw);
  while ($slideshow = tep_db_fetch_array($slideshow_query)) {
	$images_string .= '{url: "' . HTTP_SERVER . DIR_WS_HTTP_CATALOG . DIR_WS_IMAGES . 'slideshow/' . $slideshow['slideshow_image'] . '", description:"' . $slideshow['slideshow_title'] . '", link: "' . $slideshow['slideshow_link'] . '", target: "' . $slideshow['slideshow_target'] . '" },  ';
	$count++;
  }
  
  $clean_images_string .= rtrim($images_string, ", ");

  echo '<script type="text/javascript">' . "\n";
  echo '$(document).ready(function(){' . "\n";
  echo '      $("#slideshow").showcase({' . "\n";								  
  echo '        css: { width:"' . SLIDESHOW_WIDTH . 'px", height:"' . SLIDESHOW_HEIGHT . 'px" },' . "\n";
  echo '        animation: { ' . "\n"; 
  echo '			type: "' . SLIDESHOW_TRANSITION . '", ' . "\n";
  echo '			interval: "' . SLIDESHOW_INTERVAL . '", ' . "\n";
  echo '			speed: "' . SLIDESHOW_TRANSITION_SPEED . '", ' . "\n";
  echo ' 			stopOnHover: true }, ' . "\n";
  echo '        images: [ ' . $clean_images_string . ' ], ' . "\n";  
  echo '        navigator: { ' . "\n"; 
  echo '    	  item: { ' . "\n";
  echo ' 			css: { ' . "\n";
  echo '			  width:"' . SLIDESHOW_THUMB_WIDTH . 'px", height: "' . SLIDESHOW_THUMB_HEIGHT . 'px", borderColor:"' . SLIDESHOW_THUMB_BORDER_COLOR . '", backgroundColor: "' . SLIDESHOW_THUMB_BACKGROUND_COLOR . '", "color":"' . SLIDESHOW_THUMB_FONT_COLOR . '", "font-family": "Verdana, Arial, sans-serif", "font-size": "' . SLIDESHOW_THUMB_FONT_SIZE . 'px", "line-height": "' . SLIDESHOW_THUMB_HEIGHT . 'px" }, cssSelected: { backgroundColor: "' . SLIDESHOW_THUMB_ACTIVE_BACKGROUND_COLOR . '", borderColor: "' . SLIDESHOW_THUMB_ACTIVE_BORDER_COLOR . '", "font-weight": "bold", "color": "' . SLIDESHOW_THUMB_ACTIVE_FONT_COLOR . '" } ' . "\n";
  echo ' 	        }, ' . "\n";
  echo '			showMiniature:' . SLIDESHOW_MINATURE . ', ' . "\n";
  echo '			showNumber:' . SLIDESHOW_NUMBER . ', ' . "\n";
  echo '			autoHide:' . SLIDESHOW_THUMB_AUTOHIDE . ', ' . "\n";
  echo '            position:"' . SLIDESHOW_THUMB_POS . '", ' . "\n";
  echo '			orientation:"' . SLIDESHOW_THUMB_ORIENTATION . '", ' . "\n";
  echo '            css: { padding:"6px", margin:"5px 0px 0px 0px" } ' . "\n";
  echo '          }, ' . "\n";
  echo '        titleBar: { enabled: ' . SLIDESHOW_DISPLAY_TITLE . ', position: "' . SLIDESHOW_TITLE_POSITION . '", css: { backgroundColor: "' . SLIDESHOW_TITLE_COLOR . '", opacity: "' . SLIDESHOW_TITLE_OPACITY . '", height:"' . SLIDESHOW_TITLE_HEIGHT . 'px" } } ' . "\n";
  echo '    }); ' . "\n";
  echo '});' . "\n";
  echo '</script>' . "\n";
?>