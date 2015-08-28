<?php
/*
$Id: boxes.php 1857 2012-06-20 01:21:38Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  class tableBox {
    var $table_border = '0';
    var $table_width = '100%';
    var $table_cellspacing = '0';
    var $table_cellpadding = '2';
    var $table_parameters = '';
    var $table_row_parameters = '';
    var $table_data_parameters = '';

// class constructor
    function tableBox($contents, $direct_output = false) {
      $tableBox_string = '<div ';
      if (tep_not_null($this->table_parameters)) $tableBox_string .= ' ' . $this->table_parameters;
      $tableBox_string .= '>' . "\n";
     
      for ($i=0, $n=sizeof($contents); $i<$n; $i++) {
        if (isset($contents[$i]['form']) && tep_not_null($contents[$i]['form'])) $tableBox_string .= $contents[$i]['form'] . "\n";
     
        if (isset($contents[$i][0]) && is_array($contents[$i][0])) {
          for ($x=0, $n2=sizeof($contents[$i]); $x<$n2; $x++) {
            if (isset($contents[$i][$x]['text']) && tep_not_null($contents[$i][$x]['text'])) {
           
              if (isset($contents[$i][$x]['id']) && tep_not_null($contents[$i][$x]['id'])) $tableBox_string .= ' id="' . tep_output_string($contents[$i][$x]['id']) . '"';
              //if (isset($contents[$i][$x]['params']) && tep_not_null($contents[$i][$x]['params'])) {
              //  $tableBox_string .= ' ' . $contents[$i][$x]['params'];
              //} elseif (tep_not_null($this->table_data_parameters)) {
              //  $tableBox_string .= ' ' . $this->table_data_parameters; 
              //}
          
              if (isset($contents[$i][$x]['form']) && tep_not_null($contents[$i][$x]['form'])) $tableBox_string .= $contents[$i][$x]['form'];
              $tableBox_string .= $contents[$i][$x]['text'];
              if (isset($contents[$i][$x]['form']) && tep_not_null($contents[$i][$x]['form'])) $tableBox_string .= '</form>';
            }
          }
        }
          $tableBox_string .= '' . $contents[$i]['text'] . "\n";  
       	if (isset($contents[$i]['form']) && tep_not_null($contents[$i]['form'])) $tableBox_string .= '</form>' . "\n";
      	}
		

      	if ($direct_output == true) echo $tableBox_string;

      	return $tableBox_string;
   	 }
  }

  class infoBox extends tableBox {
    function infoBox($contents) {
      $info_box_contents = array();
      $info_box_contents[] = array('text' => $this->infoBoxContents($contents));
      //$this->table_cellpadding = '1';
      $this->table_parameters = 'class="infoBox"';
      $this->tableBox($info_box_contents, true);
    }

    function infoBoxContents($contents) {
      //$this->table_cellpadding = '3';
      $this->table_parameters = 'class="infoBoxContents"';
      $info_box_contents = array();
      $info_box_contents[] = array(array('text' => tep_draw_separator('pixel_trans.gif', '100%', '1')));
      for ($i=0, $n=sizeof($contents); $i<$n; $i++) {
        $info_box_contents[] = array(array('align' => (isset($contents[$i]['align']) ? $contents[$i]['align'] : ''),
                                           'form' => (isset($contents[$i]['form']) ? $contents[$i]['form'] : ''),
                                           'params' => 'class="boxText"',
                                           'text' => (isset($contents[$i]['text']) ? $contents[$i]['text'] : '')));
      }
      $info_box_contents[] = array(array('text' => tep_draw_separator('pixel_trans.gif', '100%', '1')));
      return $this->tableBox($info_box_contents);
    }
  }


  class infoBoxHeading extends tableBox {
    function infoBoxHeading($contents, $left_corner = false, $right_corner = false, $right_arrow = false) {

      if ($right_arrow == true) {
        $right_arrow = '<div class="pull-right"><button type="button" class="btn btn-default btn-xs"><a href="' . $right_arrow . '">More <span class="glyphicon glyphicon-chevron-right"></span></a></button></div>';
      } else {
        $right_arrow = '';
      }

      $info_box_contents = array();
	  $info_box_contents[] = array(array('text' => '<div class="panel panel-default"><div class="panel-heading"><div class="pull-left">' . $contents[0]['text'] . '</div>' . $right_arrow . '<div class="clearfix"></div></div>'));

      $this->tableBox($info_box_contents, true);
    }
  }
  
  class recentHistoryBoxHeading extends tableBox {
    function recentHistoryBoxHeading($contents, $left_corner = false, $right_corner = false, $right_arrow = false) {
	
      if ($right_arrow == true) {
        $right_arrow = '<a href="' . $right_arrow . '">' . tep_image(bts_select('images', 'infobox/clear.png'), ICON_CLEAR_HISTORY) . '</a></div>';
      } else {
        $right_arrow = '';
      }
      
	  $info_box_contents = array();
	  $info_box_contents[] = array(array('text' => '<div class="panel panel-default"><div class="panel-heading"><div class="pull-left">' . $contents[0]['text'] . '</div>' . $right_arrow . '<div class="clearfix"></div></div>'));

      $this->tableBox($info_box_contents, true);
	}  
  }

  class contentBox extends tableBox {
    function contentBox($contents) {
      $info_box_contents = array();
      $info_box_contents[] = array('text' => $this->contentBoxContents($contents));
      //$this->table_cellpadding = '1';
      $this->table_parameters = 'class="panel-body"';
      $this->tableBox($info_box_contents, true);
    }

    function contentBoxContents($contents) {
      //$this->table_cellpadding = '4';
      $this->table_parameters = 'class="contentBoxContents"';
      return $this->tableBox($contents);
    }
  }

  class contentBoxHeading extends tableBox {
    function contentBoxHeading($contents) {

      $info_box_contents = array();
	  $info_box_contents[] = array(array('text' => '<div class="panel panel-default"><div class="panel-heading"><div class="pull-left">' . $contents[0]['text'] . '</div>' . $right_arrow . '<div class="clearfix"></div></div>'));	

      $this->tableBox($info_box_contents, true);
    }
  }

  class errorBox extends tableBox {
    function errorBox($contents) {
      $this->table_data_parameters = 'class="errorBox"';
      $this->tableBox($contents, true);
    }
  }

  class productListingBox extends tableBox {
    function productListingBox($contents) {
      $this->table_parameters = 'class="productListing"';
      $this->tableBox($contents, true);
    }
  }

  class productListingBoxList extends tableBox {
    function productListingBoxList($contents) {
      $this->table_parameters = 'class="productListing-list"';
      $this->tableBox($contents, true);
    }
  }
?>