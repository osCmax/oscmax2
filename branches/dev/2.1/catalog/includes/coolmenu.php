<?php

/* ------------------------------------------------

  coolMenu for osCommerce
  
  author:	Andreas Kothe 
  url:		http://www.oddbyte.de


  Released under the GNU General Public License
  
  ------------------------------------------------ 
*/




// --- CONFIG ---

define('SHOW_COUNT','false');
define('SUB_CATEGORIES','4');





 if (MAX_MANUFACTURERS_LIST < 2) {
    $cat_choose = array(array('id' => '', 'text' => BOX_CATEGORIES_CHOOSE));
 } else {
    $cat_choose = '';
 }

?>



  		<!-- 	Copyright 2002 www.dhtmlcentral.com  --  modified for PHP and osCommerce by Andreas Kothe - www.oddbyte.de	-->

		<script>

		oCMenu=new makeCM("oCMenu") //Making the menu object. Argument: menuname

		//Menu properties
		oCMenu.pxBetween=0
		oCMenu.fromLeft=10
		oCMenu.fromTop=100
		oCMenu.rows=0
		oCMenu.menuPlacement="left"

		oCMenu.offlineRoot=""
		oCMenu.onlineRoot=""
		oCMenu.resizeCheck=1
		oCMenu.wait=500
		oCMenu.fillImg="cm_fill.gif"
		oCMenu.zIndex=0

		//Background bar properties
		oCMenu.useBar=1
		oCMenu.barWidth="menu"
		oCMenu.barHeight="menu"
		oCMenu.barClass="clBar"
		oCMenu.barX="menu"
		oCMenu.barY="menu"
		oCMenu.barBorderX=0
		oCMenu.barBorderY=0
		oCMenu.barBorderClass=""

		oCMenu.level[0]=new cm_makeLevel()
		oCMenu.level[0].width=150
		oCMenu.level[0].height=28
		oCMenu.level[0].regClass="clLevel0"
		oCMenu.level[0].overClass="clLevel0over"
		oCMenu.level[0].borderX=1
		oCMenu.level[0].borderY=1
		oCMenu.level[0].borderClass="clLevel0border"
		oCMenu.level[0].offsetX=0
		oCMenu.level[0].offsetY=0
		oCMenu.level[0].rows=0
		oCMenu.level[0].arrow="images/icons/arrow.gif"
		oCMenu.level[0].arrowWidth=11
		oCMenu.level[0].arrowHeight=11
		oCMenu.level[0].align="right"
		oCMenu.level[0].filter="progid:DXImageTransform.Microsoft.Fade(duration=0.8)"
<?php
	for ($i=1; $i<SUB_CATEGORIES; $i++) { 
		echo'	
			oCMenu.level[' . $i . ']=new cm_makeLevel()
			oCMenu.level[' . $i . '].width=250
			oCMenu.level[' . $i . '].height=14
			oCMenu.level[' . $i . '].regClass="clLevel1"
			oCMenu.level[' . $i . '].overClass="clLevel1over"
			oCMenu.level[' . $i . '].borderX=1
			oCMenu.level[' . $i . '].borderY=1
			oCMenu.level[' . $i . '].align="right"
			oCMenu.level[' . $i . '].offsetX=0
			oCMenu.level[' . $i . '].offsetY=0
			oCMenu.level[' . $i . '].borderClass="clLevel1border"
			oCMenu.level[' . $i . '].align="right"
			oCMenu.level[' . $i . '].filter="progid:DXImageTransform.Microsoft.Fade(duration=0.6)"
			
			
		';
	} // end for
	



 // ---

	function blank_length($text) {
		$count = 0;
		while(substr($text, 0,12) == "&nbsp;&nbsp;") {
			$text = substr($text, 12);
			$count++;
		}
		return $count;
	}




 // ---


	function print_menu_line($categories, $depth_size,$depth_parentid, $depth) {

		$size=0;
		for($i=0; $depth_size[$i]!=0; $i++) {
			$size++;
		}


		echo "oCMenu.makeMenu('";

		if ($depth == 0) {
			echo "top" . '_'.$depth_size[0] . "','','";
		} else if ($depth == 1) {
			echo "sub" .'_'.$depth_size[0] .'_'. $depth_size[1] . "','top" .'_'. $depth_size[0] . "','";
		} else { // $depth < 1
			echo "sub";
			for ($i=0; $i<$size; $i++) {
				echo ($depth_size[$i] != 0) ? '_'.$depth_size[$i] : '_';
			}
			echo "','sub";
			for ($i=0; $i<$size-1; $i++) {
				echo ($depth_size[$i] != 0) ? '_'.$depth_size[$i] : '_';
			}
			echo "','";
		}
		echo $categories['text'];
		if (SHOW_COUNT == 'true') {
			$products_in_category = tep_count_products_in_category($categories['id']);
			if ($products_in_category > 0) {
				echo "<FONT COLOR=\"#c0c0c0\"> &nbsp;(" . $products_in_category . ")</FONT>";
			}
		}
  
        $cPathNew = "cPath=";
		for ($i=0; $i<$size-1; $i++) {
			$cPathNew .= ($depth_size[$i] != 0) ? $depth_parentid[$i].'_':'';
        }
        $cPathNew .= $categories['id'];
		echo "','" . tep_href_link(FILENAME_DEFAULT,$cPathNew) . "')\n";
	}



 // ---


	$categories = tep_get_categories('');

	$height.= 2.65*count($categories);

	$depth=0;
	$blank_length;
	$depth_size;
	$depth_parentid;

	for($i=0; $i<count($categories); $i++) {	// don't insert 1st entry ("please choose ...")
		$blank_length = blank_length($categories[$i]['text']);

		if($blank_length == $depth) {
			$categories[$i]['depth'] = $depth;
			$depth_size[$depth]++;
		} else if ($blank_length > $depth) {
			$depth++;
			$categories[$i]['depth'] = $depth;
			$depth_size[$depth]++;
		} else if ($blank_length < $depth) {
			for ($j=$depth; $j>$blank_length; $j--) {
				$depth_size[$j] = 0;
				$depth--;
			}
			$categories[$i]['depth'] = $depth;
			$depth_size[$depth]++;

		}
	        $depth_parentid[$categories[$i]['depth']] = $categories[$i]['id'];
	
		// remove blanks
		$categories[$i]['text'] = substr($categories[$i]['text'], 12*$blank_length);
	
		print_menu_line($categories[$i], $depth_size,$depth_parentid, $depth);
	}



?>	
	
		// create menu
		oCMenu.construct()

  		<!-- 	Copyright 2002 www.dhtmlcentral.com  --  modified for PHP and osCommerce by Andreas Kothe - www.oddbyte.de	-->

		</SCRIPT>