<!-- categories //-->

<?php

/*
  Dynamic DHTL MenuBar for category listing v 0.2.1
  This is a combination of modified categories.php and
  HV Menu javacript written by Ger Versluis (c) 2000 version 5.411 24 December 2001 (updated Jan 31st, 2003 by Dynamic Drive for Opera7)
*	HV Menu found on Dynamic Drive ONLY may be used on both commercial and non commerical sites	*
*	For info about HV Menu write to menus@burmees.nl			

  Modifications for osCommerce menuBar_0_2 made by John Guerra 2/9/2003
  oscommerce@apodigm.com
*/
  define('LEFT_LINK_HEIGHT',20);
  define('LEFT_LINK_WIDTH',110);

  $boxHeading = BOX_HEADING_CATEGORIES;
  $corner_left = 'square';
  $corner_right = 'square';
  $box_base_name = 'categories'; // for easy unique box template setup (added BTSv1.2)

  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

?>
<script type='text/javascript'><!-- categories_dhtml_bof //-->
/*********************************************************************************************************************************************
*	(c) Ger Versluis 2000 version 5.411 24 December 2001 (updated Jan 31st, 2003 by Dynamic Drive for Opera7)
*	HV Menu found on Dynamic Drive ONLY may be used on both commercial and non commerical sites	*
*	For info write to menus@burmees.nl							        *
*       This script featured on Dynamic Drive DHTML code library: http://www.dynamicdrive.com
**********************************************************************************************************************************************/

	var LowBgColor='transparent';			// Background color when mouse is not over
	var LowSubBgColor='white';			// Background color when mouse is not over on subs
	var HighBgColor='transparent';			// Background color when mouse is over
	var HighSubBgColor='white';			// Background color when mouse is over on subs
	var FontLowColor='black';			// Font color when mouse is not over
	var FontSubLowColor='black';			// Font color subs when mouse is not over
	var FontHighColor='#6699cc';			// Font color when mouse is over
	var FontSubHighColor='#6699cc';			// Font color subs when mouse is over
	var BorderColor='transparent';			// Border color
	var BorderSubColor='#6699cc';			// Border color for subs
	var BorderWidth=1;				// Border width
	var BorderBtwnElmnts=0;			// Border between elements 1 or 0
	var FontFamily="Verdana, Arial, sans-serif"	// Font family menu items
	var FontSize=8;				// Font size menu items
	var FontBold=0;				// Bold menu items 1 or 0
	var FontItalic=0;				// Italic menu items 1 or 0
	var MenuTextCentered='left';			// Item text position 'left', 'center' or 'right'
	var MenuCentered='left';			// Menu horizontal position 'left', 'center' or 'right'
	var MenuVerticalCentered='top';		// Menu vertical position 'top', 'middle','bottom' or static
	var ChildOverlap=.0;				// horizontal overlap child/ parent
	var ChildVerticalOverlap=.0;			// vertical overlap child/ parent
	var StartTop=0;				// Menu offset x coordinate
	var StartLeft=0;				// Menu offset y coordinate
	var VerCorrect=0;				// Multiple frames y correction
	var HorCorrect=0;				// Multiple frames x correction
	var LeftPaddng=1;				// Left padding
	var TopPaddng=0;				// Top padding
	var DissapearDelay=500;			// delay before menu folds in

	var FirstLineHorizontal=0;			// SET TO 1 FOR HORIZONTAL MENU, 0 FOR VERTICAL
	var MenuFramesVertical=1;			// Frames in cols or rows 1 or 0
	var TakeOverBgColor=1;			// Menu frame takes over background color subitem frame
	var FirstLineFrame='navig';			// Frame where first level appears
	var SecLineFrame='space';			// Frame where sub levels appear
	var DocTargetFrame='space';			// Frame where target documents appear
	var TargetLoc='MenuBar';				// span id for relative positioning
	var HideTop=0;				// Hide first level when loading new document 1 or 0
	var MenuWrap=1;				// enables/ disables menu wrap 1 or 0
	var RightToLeft=0;				// enables/ disables right to left unfold 1 or 0
	var UnfoldsOnClick=0;			// Level 1 unfolds onclick/ onmouseover
	var WebMasterCheck=0;			// menu tree checking on or off 1 or 0
	var ShowArrow=0;				// Uses arrow gifs when 1
	var KeepHilite=1;				// Keep selected path highligthed
	var Arrws=['<?php echo DIR_WS_IMAGES; ?>tri.gif',5,10,'<?php echo DIR_WS_IMAGES; ?>tridown.gif',10,5,'<?php echo DIR_WS_IMAGES; ?>trileft.gif',5,10];	// Arrow source, width and height

function BeforeStart(){return}
function AfterBuild(){return}
function BeforeFirstOpen(){return}
function AfterCloseAll(){return}
function Go(){return}

<?php  

 $number_top_levels = 0;
 $categories_string='';
  $number_top_levels = build_menus(0,'','');
  echo 'var NoOffFirstLineMenus= ' . $number_top_levels. ';'	;		// Number of first level items
  echo $categories_string;

function build_menus($currentParID,$menustr,$catstr) {
    global $categories_string, $id, $languages_id;
    $tmpCount;
   
   $tmpCount = 0;
   $haschildren = 0; //default

// BOF Enable - Disable Categories Contribution-------------------------------------- 
// BOF Original line
     $categories_query_catmenu = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.parent_id = '" . $currentParID . "' and c.categories_id = cd.categories_id and cd.language_id='" . $languages_id ."' order by sort_order, cd.categories_name");
// EOF Original line

// BOF Enable - Disable Categories
//   $categories_query_catmenu = tep_db_query("select c.categories_id, cd.categories_name, c.parent_id from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_status = '1' and c.parent_id = '" . $currentParID . "' and c.categories_id = cd.categories_id and cd.language_id='" . $languages_id ."' order by sort_order, cd.categories_name");
// EOF Enable - Disable Categories
// EOF Enable - Disable Categories Contribution-------------------------------------- 

   
   while ($categories = tep_db_fetch_array($categories_query_catmenu))  {
     $tmpString = '';
     $tmpCount += 1;
     $haschildren=tep_has_category_subcategories($categories['categories_id']);

     if ($haschildren) {
         if($menustr != ''){
           $menu_tmp = $menustr . '_' . $tmpCount;
         } else {
           $menu_tmp = $tmpCount;
         }
         if($catstr != ''){
           $cat_tmp = $catstr . '_' . $categories['categories_id'];
         } else {
           $cat_tmp = $categories['categories_id'];
         }
       $NumChildren = build_menus($categories['categories_id'],$menu_tmp,$cat_tmp);     } else {
       $NumChildren = 0; 
      }

    if ($id==$categories['categories_id']) {
      $tmpString .= '<b>';
    }
    // display category name
    $tmpString .= $categories['categories_name'];

    if ( $id==$categories['categories_id'] ) {
      $tmpString .= '</b>';
    }
    if (SHOW_COUNTS == 'true') {
      $products_in_category = tep_count_products_in_category($categories['categories_id']);
      if ($products_in_category > 0) {
        $tmpString .= ' (' . $products_in_category . ')';
      }
    }

     if($catstr != ''){
        $cPath_new = 'cPath=' . $catstr . '_' . $categories['categories_id'];
     } else {
        $cPath_new = 'cPath=' . $categories['categories_id'];
     }

  // Menu tree
//	Menu1_1_1=new Array(Text to show, Link, background image (optional), number of sub elements, height, width);
         if($menustr != ''){
           $menu_tmp = $menustr . '_' . $tmpCount;
         } else {
           $menu_tmp = $tmpCount;
         }
$categories_string .=  'Menu' . ($menustr!=''?$menustr.'_':'') . $tmpCount;
$categories_string .=  '= new Array("' . $tmpString . '","';
$categories_string .=  tep_href_link(FILENAME_DEFAULT, $cPath_new);
$categories_string .= '","",' ;
$categories_string .= $NumChildren;
$categories_string .= ',' . LEFT_LINK_HEIGHT . ',' . LEFT_LINK_WIDTH ;
$categories_string .= '); ';
   
    }// end while
    return $tmpCount;
  }  //end build menus

echo '</script>';

$tabletext ="<table><tr><td><div id='MenuBar' style='position:relative; width: " . LEFT_LINK_WIDTH . "; height: " . ($number_top_levels*LEFT_LINK_HEIGHT) . ";'>&nbsp;</div></td></tr></table>";

//  $info_box_contents = array();
//$info_box_contents[] = array('align' => 'left',
//                               'text'  => $tabletext
//                              );
// new infoBox($info_box_contents);
$boxContent = $tabletext;

include (bts_select('boxes', $box_base_name)); // BTS 1.5

?>
<SCRIPT LANGUAGE="JavaScript1.2" SRC="includes/menu_animation.js"></SCRIPT>

           
<!-- categories_dhtml_eof //-->
