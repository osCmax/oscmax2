<?php
/*
$Id: search.php 1775 2012-04-01 19:13:57Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.

?>
<!-- search //-->
<?php
  $boxHeading = '<a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH) . '">' . BOX_HEADING_SEARCH . '</a>';
  
  $corner_top_left = 'rounded';
  $corner_top_right = 'rounded';
  $corner_bottom_left = 'rounded';
  $corner_bottom_right = 'rounded'; 
  
  $boxContent_attributes = ' align="center"';
  $boxLink = '<a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH) . '">' . tep_image(bts_select('images', 'infobox/arrow_right.png'), ICON_ARROW_RIGHT) . '</a>';
  $box_base_name = 'search'; // for easy unique box template setup (added BTSv1.2)
  $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)
  
  $boxContent = tep_draw_form('quick_find', tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '', 'NONSSL', false), 'get');
  $boxContent .= tep_draw_hidden_field('search_in_description','1') . tep_draw_input_field('keywords', '', 'id="txtSearch" size="10" maxlength="30" style="width: 100%"') . '&nbsp;<span style="width: 100%")>' . tep_hide_session_id() . tep_image_submit('button_quick_find.gif', BOX_HEADING_SEARCH) . '</span><br>' . BOX_SEARCH_TEXT . '<br><a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH) . '"><b>' . BOX_SEARCH_ADVANCED_SEARCH . '</b></a>';
  $boxContent .= '</form>' .
                  '<br><a href="' . tep_href_link(FILENAME_ADVANCED_SEARCH_RESULT, '&amp;pfrom=0&amp;pto=100000', 'NONSSL') . '">' . BOX_INFORMATION_ALLPRODS . '</a><br>';
  include (bts_select('boxes', $box_base_name)); // BTS 1.5
  $boxContent_attributes = '';
  
if (AJAX_SEARCH_SUGGEST == 'true') {
?>

<script language="JavaScript" type="text/javascript" src="includes/class.OSCFieldSuggest.js"></script>
<script language="JavaScript" type="text/javascript">
  /*<![CDATA[*/
  //Attention!!! put always this code above the HTML code of your field!!!
  var oscSearchSuggest = new OSCFieldSuggest('txtSearch', 'includes/search_suggest.xsl', 'searchsuggest.php');
  //Adds autocomplete off to search fields
  var e = document.getElementById('txtSearch');
	e.autocomplete = 'off'; // Maybe should be false

  /*]]>*/
</script>

<?php
} // end if
?>
<!-- search_eof //-->
