<?php
/*
$Id$

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
      $tableBox_string = '<table border="' . tep_output_string($this->table_border) . '" width="' . tep_output_string($this->table_width) . '" cellspacing="' . tep_output_string($this->table_cellspacing) . '" cellpadding="' . tep_output_string($this->table_cellpadding) . '"';
      if (tep_not_null($this->table_parameters)) $tableBox_string .= ' ' . $this->table_parameters;
      $tableBox_string .= '>' . "\n";

      for ($i=0, $n=sizeof($contents); $i<$n; $i++) {
        if (isset($contents[$i]['form']) && tep_not_null($contents[$i]['form'])) $tableBox_string .= $contents[$i]['form'] . "\n";
        $tableBox_string .= '  <tr';
        if (tep_not_null($this->table_row_parameters)) $tableBox_string .= ' ' . $this->table_row_parameters;
        if (isset($contents[$i]['params']) && tep_not_null($contents[$i]['params'])) $tableBox_string .= ' ' . $contents[$i]['params'];
        $tableBox_string .= '>' . "\n";

        if (isset($contents[$i][0]) && is_array($contents[$i][0])) {
          for ($x=0, $n2=sizeof($contents[$i]); $x<$n2; $x++) {
            if (isset($contents[$i][$x]['text']) && tep_not_null($contents[$i][$x]['text'])) {
              $tableBox_string .= '    <td';
              if (isset($contents[$i][$x]['align']) && tep_not_null($contents[$i][$x]['align'])) $tableBox_string .= ' align="' . tep_output_string($contents[$i][$x]['align']) . '"';
              if (isset($contents[$i][$x]['params']) && tep_not_null($contents[$i][$x]['params'])) {
                $tableBox_string .= ' ' . $contents[$i][$x]['params'];
              } elseif (tep_not_null($this->table_data_parameters)) {
                $tableBox_string .= ' ' . $this->table_data_parameters;
              }
              $tableBox_string .= '>';
              if (isset($contents[$i][$x]['form']) && tep_not_null($contents[$i][$x]['form'])) $tableBox_string .= $contents[$i][$x]['form'];
              $tableBox_string .= $contents[$i][$x]['text'];
              if (isset($contents[$i][$x]['form']) && tep_not_null($contents[$i][$x]['form'])) $tableBox_string .= '</form>';
              $tableBox_string .= '</td>' . "\n";
            }
          }
        } else {
          $tableBox_string .= '    <td';
          if (isset($contents[$i]['align']) && tep_not_null($contents[$i]['align'])) $tableBox_string .= ' align="' . tep_output_string($contents[$i]['align']) . '"';
          if (isset($contents[$i]['params']) && tep_not_null($contents[$i]['params'])) {
            $tableBox_string .= ' ' . $contents[$i]['params'];
          } elseif (tep_not_null($this->table_data_parameters)) {
            $tableBox_string .= ' ' . $this->table_data_parameters;
          }
          $tableBox_string .= '>' . $contents[$i]['text'] . '</td>' . "\n";
        }

        $tableBox_string .= '  </tr>' . "\n";
        if (isset($contents[$i]['form']) && tep_not_null($contents[$i]['form'])) $tableBox_string .= '</form>' . "\n";
      }

      $tableBox_string .= '</table>' . "\n";

      if ($direct_output == true) echo $tableBox_string;

      return $tableBox_string;
    }
  }

  class infoBox extends tableBox {
    function infoBox($contents) {
      $info_box_contents = array();
      $info_box_contents[] = array('text' => $this->infoBoxContents($contents));
      $this->table_cellpadding = '1';
      $this->table_parameters = 'class="infoBox"';
      $this->tableBox($info_box_contents, true);
    }

    function infoBoxContents($contents) {
      $this->table_cellpadding = '3';
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
      $this->table_cellpadding = '0';

      if ($left_corner == true) {
        $left_corner = tep_image(bts_select('images', 'infobox/top_left.png'));
      } else {
        $left_corner = tep_image(bts_select('images', 'infobox/top_spacer.png'));
      }
      if ($right_arrow == true) {
        $right_arrow = '<a href="' . $right_arrow . '">' . tep_image(bts_select('images', 'infobox/arrow_right.png'), ICON_ARROW_RIGHT) . '</a>';
      } else {
        $right_arrow = '';
      }
      if ($right_corner == true) {
        $right_corner = tep_image(bts_select('images', 'infobox/top_right.png'));
      } else {
        $right_corner = tep_image(bts_select('images', 'infobox/top_spacer.png'));
      }

      $info_box_contents = array();
      $info_box_contents[] = array(array('params' => 'class="infoBoxHeading"',
                                         'text' => $left_corner),
                                   array('params' => 'width="100%" class="infoBoxHeading"',
                                         'text' => $contents[0]['text']),
                                   array('params' => 'class="infoBoxHeading"',
                                         'text' => $right_arrow),
                                   array('params' => 'class="infoBoxHeading" nowrap',
                                         'text' => $right_corner));

      $this->tableBox($info_box_contents, true);
    }
  }
  
  class recentHistoryBoxHeading extends tableBox {
    function recentHistoryBoxHeading($contents, $left_corner = false, $right_corner = false, $right_arrow = false) {
	  $this->table_cellpadding = '0';
		
	  if ($left_corner == true) {
        $left_corner = tep_image(bts_select('images', 'infobox/top_left.png'));
      } else {
        $left_corner = tep_image(bts_select('images', 'infobox/top_spacer.png'));
      }
      if ($right_arrow == true) {
        $right_arrow = '<a href="' . $right_arrow . '">' . tep_image(bts_select('images', 'infobox/clear.png'), ICON_CLEAR_HISTORY) . '</a>';
      } else {
        $right_arrow = '';
      }
      if ($right_corner == true) {
        $right_corner = tep_image(bts_select('images', 'infobox/top_right.png'));
      } else {
        $right_corner = tep_image(bts_select('images', 'infobox/top_spacer.png'));
      }
	  
	  $info_box_contents = array();
      $info_box_contents[] = array(array('params' => 'class="infoBoxHeading"',
                                         'text' => $left_corner),
                                   array('params' => 'width="100%" class="infoBoxHeading"',
                                         'text' => $contents[0]['text']),
                                   array('params' => 'class="infoBoxHeading"',
                                         'text' => $right_arrow),
                                   array('params' => 'class="infoBoxHeading" nowrap',
                                         'text' => $right_corner));

      $this->tableBox($info_box_contents, true);
	}  
  }

  class contentBox extends tableBox {
    function contentBox($contents) {
      $info_box_contents = array();
      $info_box_contents[] = array('text' => $this->contentBoxContents($contents));
      $this->table_cellpadding = '1';
      $this->table_parameters = 'class="contentBox"';
      $this->tableBox($info_box_contents, true);
    }

    function contentBoxContents($contents) {
      $this->table_cellpadding = '4';
      $this->table_parameters = 'class="contentBoxContents"';
      return $this->tableBox($contents);
    }
  }

  class contentBoxHeading extends tableBox {
    function contentBoxHeading($contents) {
      $this->table_width = '100%';
      $this->table_cellpadding = '0';

      $info_box_contents = array();
      $info_box_contents[] = array(array('params' => 'class="contentBoxHeading"',
                                         'text' => tep_image(bts_select('images', 'infobox/top_left.png'))),
                                   array('params' => 'class="contentBoxHeading" width="100%"',
                                         'text' => $contents[0]['text']),
                                   array('params' => 'class="contentBoxHeading"',
                                         'text' => tep_image(bts_select('images', 'infobox/top_right.png'))));

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