     <tr>
      <td><?php
       $info_box_contents = array();
       $info_box_contents[] = array(
           'text' => ONEPAGE_BOX_ONE_HEADING
       );
       
       new infoBoxHeading($info_box_contents, false, false);
       
       $info_box_contents = array();
       $info_box_contents[] = array(
           'text' => ONEPAGE_BOX_ONE_CONTENT
       );
       
       new infoBox($info_box_contents);
      ?></td>
     </tr>

     <tr>
      <td><?php
       $info_box_contents = array();
       $info_box_contents[] = array(
           'text' => ONEPAGE_BOX_TWO_HEADING
       );
       
       new infoBoxHeading($info_box_contents, false, false);
       
       $info_box_contents = array();
       $info_box_contents[] = array(
           'text' => ONEPAGE_BOX_TWO_CONTENT
       );
       
       new infoBox($info_box_contents);
      ?></td>
     </tr>