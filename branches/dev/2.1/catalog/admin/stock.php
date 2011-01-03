<?php
/*
      QT Pro Version 4.1
  
      stock.php
  
      Contribution extension to:
        osCmax e-Commerce
        http://www.oscmax.com
     
      Copyright 2006 osCmax2004, 2005 Ralph Day
      Released under the GNU General Public License
  
      Based on prior works released under the GNU General Public License:
        QT Pro prior versions
          Ralph Day, October 2004
          Tom Wojcik aka TomThumb 2004/07/03 based on work by Michael Coffman aka coffman
          FREEZEHELL - 08/11/2003 freezehell@hotmail.com Copyright 2006 osCmax2003 IBWO
          Joseph Shain, January 2003
        osCommerce MS2
          Copyright 2006 osCmax
          
      Modifications made:
        11/2004 - Add input validation
                  clean up register globals off problems
                  use table name constant for products_stock instead of hard coded table name
        03/2005 - Change $_SERVER to $HTTP_SERVER_VARS for compatibility with older php versions
        
*******************************************************************************************
  
      QT Pro Stock Add/Update
  
      This is a page to that is linked from the osCommerce admin categories page when an
      item is selected.  It displays a products attributes stock and allows it to be updated.

*******************************************************************************************

$Id$

  Enhancement module fo  osCmax e-Commerce
  http://www.oscmax.com
  
  Credit goes to original QTPRO developer.
  Attributes Inventory - FREEZEHELL - 08/11/2003 freezehell@hotmail.com
  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
  require('includes/application_top.php');

  if ($HTTP_SERVER_VARS['REQUEST_METHOD']=="GET") {
    $VARS=$_GET;
  } else {
    $VARS=$_POST;
  }
  if ($VARS['action']=="Add") {
    $inputok = true;
    if (!(is_numeric($VARS['product_id']) and ($VARS['product_id']==(int)$VARS['product_id']))) $inputok = false;
    while(list($v1,$v2)=each($VARS)) {
      if (preg_match("/^option(\d+)$/",$v1,$m1)) {
        if (is_numeric($v2) and ($v2==(int)$v2)) $val_array[]=$m1[1]."-".$v2;
        else $inputok = false;
      }
    }
    if (!(is_numeric($VARS['quantity']) and ($VARS['quantity']==(int)$VARS['quantity']))) $inputok = false;

    if (($inputok)) {
      sort($val_array, SORT_NUMERIC);
      $val=join(",",$val_array);
      $q=tep_db_query("select products_stock_id as stock_id from " . TABLE_PRODUCTS_STOCK . " where products_id=" . (int)$VARS['product_id'] . " and products_stock_attributes='" . $val . "' order by products_stock_attributes");
      if (tep_db_num_rows($q)>0) {
        $stock_item=tep_db_fetch_array($q);
        $stock_id=$stock_item[stock_id];
        if ($VARS['quantity']=intval($VARS['quantity'])) {
          tep_db_query("update " . TABLE_PRODUCTS_STOCK . " set products_stock_quantity=" . (int)$VARS['quantity'] . " where products_stock_id=$stock_id");
        } else {
          tep_db_query("delete from " . TABLE_PRODUCTS_STOCK . " where products_stock_id=$stock_id");
        }
      } else {
        tep_db_query("insert into " . TABLE_PRODUCTS_STOCK . " values (0," . (int)$VARS['product_id'] . ",'$val'," . (int)$VARS['quantity'] . ")");
      }
      $q=tep_db_query("select sum(products_stock_quantity) as summa from " . TABLE_PRODUCTS_STOCK . " where products_id=" . (int)$VARS['product_id'] . " and products_stock_quantity>0");
      $list=tep_db_fetch_array($q);
      $summa= (empty($list[summa])) ? 0 : $list[summa];
      tep_db_query("update " . TABLE_PRODUCTS . " set products_quantity=$summa where products_id=" . (int)$VARS['product_id']);
      if (($summa<1) && (STOCK_ALLOW_CHECKOUT == 'false')) {
        tep_db_query("update " . TABLE_PRODUCTS . " set products_status='0' where products_id=" . (int)$VARS['product_id']);
      }
    }
  }
  if ($VARS['action']=="Update") {
    tep_db_query("update " . TABLE_PRODUCTS . " set products_quantity=" . (int)$VARS['quantity'] . " where products_id=" . (int)$VARS['product_id']);
    if (($VARS['quantity']<1) && (STOCK_ALLOW_CHECKOUT == 'false')) {
      tep_db_query("update " . TABLE_PRODUCTS . " set products_status='0' where products_id=" . (int)$VARS['product_id']);
    }
  }
  if ($VARS['action']=="Apply to all") {

  }
  $q=tep_db_query($sql="select products_name,products_options_name as _option,products_attributes.options_id as _option_id,products_options_values_name as _value,products_attributes.options_values_id as _value_id from ".
                  "products_description, products_attributes,products_options,products_options_values where ".
                  "products_attributes.products_id=products_description.products_id and ".
                  "products_attributes.products_id=" . (int)$VARS['product_id'] . " and ".
                  "products_attributes.options_id=products_options.products_options_id and ".
                  "products_attributes.options_values_id=products_options_values.products_options_values_id and ".
                  "products_description.language_id=" . (int)$languages_id . " and ".
                  "products_options_values.language_id=" . (int)$languages_id . " and products_options.products_options_track_stock=1 and ".
                  "products_options.language_id=" . (int)$languages_id . " order by products_attributes.options_id, products_attributes.options_values_id");
 //list($product_name,$option_name,$option_id,$value,$value_id)
  if (tep_db_num_rows($q)>0) {
    $flag=1;
    while($list=tep_db_fetch_array($q)) {
      $options[$list[_option_id]][]=array($list[_value],$list[_value_id]);
      $option_names[$list[_option_id]]=$list[_option];
      $product_name=$list[products_name];
    }
 } 
 //Commented out so items with 0 stock will show up in the stock report.
 else {
  //  $flag=0;
   $q=tep_db_query("select products_quantity,products_name from " . TABLE_PRODUCTS . " p,products_description pd where pd.products_id=" . (int)$VARS['product_id'] . " and p.products_id=" . (int)$VARS['product_id']);
    $list=tep_db_fetch_array($q);
    $db_quantity=$list[products_quantity];
    $product_name=stripslashes($list[products_name]);
  }
  
  $product_investigation = qtpro_doctor_investigate_product($VARS['product_id']); 
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/javascript/jquery-ui-1.8.2.custom.css">
</head>
<body>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
  <table border="0" width="100%" cellspacing="2" cellpadding="2">
    <tr>
      <td width="<?php echo BOX_WIDTH; ?>" valign="top">
        <table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
          <!-- left_navigation //-->
          <?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
          <!-- left_navigation_eof //-->
        </table>
      </td>
<!-- body_text //-->
      <td valign="top">
        <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo PRODUCTS_STOCK . ': ' . $product_name; ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
          </tr>
          <tr>
            <td width="75%">
              <table border="0" width="100%" cellspacing="0" cellpadding="0">
                <tr>
                  <td><form action="<?php echo $PHP_SELF;?>" method=get>
                    <table border="0" width="100%" cellspacing="0" cellpadding="0">
                      <tr>
                        <td valign="top">
                          <table border="0" width="100%" cellspacing="0" cellpadding="2">
                            <tr class="dataTableHeadingRow">
                            <?php
                              $title_num=1;
                              if ($flag) {
                                while(list($k,$v)=each($options)) {
                                  echo "<td class=\"dataTableHeadingContent\" valign=\"middle\">&nbsp;&nbsp;$option_names[$k]</td>";
                                  $title[$title_num]=$k;
                                }
                                echo "<td class=\"dataTableHeadingContent\" valign=\"middle\"><span class=smalltext>" . TABLE_HEADING_QTY . "</span></td><td width=\"100%\" colspan=\"2\">&nbsp;</td>";
                                echo "</tr>";
                                $q=tep_db_query("select * from " . TABLE_PRODUCTS_STOCK . " where products_id=" . $VARS['product_id'] . " order by products_stock_attributes");
                                while($rec=tep_db_fetch_array($q)) {
                                  $val_array=explode(",",$rec[products_stock_attributes]);
                                  echo "<tr>";
                                  foreach($val_array as $val) {
                                    if (preg_match("/^(\d+)-(\d+)$/",$val,$m1)) {
                                      echo "<td class=smalltext>&nbsp;&nbsp;&nbsp;".tep_values_name($m1[2])."</td>";
                                    } else {
                                      echo "<td>&nbsp;</td>";
                                    }
                                  }
                                  for($i=0;$i<sizeof($options)-sizeof($val_array);$i++) {
                                    echo "<td>&nbsp;</td>";
                                  }
                                  echo "<td class=smalltext>&nbsp;&nbsp;&nbsp;&nbsp;$rec[products_stock_quantity]</td><td>&nbsp;</td></tr>";
                                }
                                echo "<tr>";
                                reset($options);
                                $i=0;
                                while(list($k,$v)=each($options)) {
                                  echo "<td class=dataTableHeadingRow><select name=option$k>";
                                  foreach($v as $v1) {
                                    echo "<option value=".$v1[1].">".$v1[0];
                                  }
                                  echo "</select></td>";
                                  $i++;
                                }
                              } else {
                                $i=1;
                                echo "<td class=dataTableHeadingContent valign=\"middle\">" . TABLE_HEADING_QTY . "</td>";
                              }
                              echo "<td class=dataTableHeadingRow valign=\"middle\"><input type=text name=quantity size=4 value=\"" . $db_quantity . "\"><input type=hidden name=product_id value=\"" . $VARS['product_id'] . "\">&nbsp;</td><td width=\"100%\" class=dataTableHeadingRow valign=\"middle\">&nbsp;<input type=submit name=action value=" . ($flag?"Add":"Update") . ">&nbsp;</td><td width=\"100%\" class=dataTableHeadingRow>&nbsp;</td>";
                            ?>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </form></td>
                </tr>
                <tr>
                  <td><br>
                    <table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td class="dataTableHeadingRow">
                          <table width="100%" class="boxText" border="0" cellspacing="3" cellpadding="6"> 
                            <tr valign="top">
                              <td class="dataTableHeadingContent" width="400" style="font-size: 12;"><?php echo TABLE_HEADING_QTPRO; ?></td>
                              <td class="dataTableHeadingContent" style="font-size: 12;"><?php echo TABLE_HEADING_LINKS; ?></td>
                            </tr>
                            <tr valign="top">
                              <td class="menuBoxHeading" width="400">
                                <span style="font-family: Verdana, Arial, sans-serif; font-size: 10px; color: black;">
                                <?php 
                                    print qtpro_doctor_formulate_product_investigation($product_investigation, 'detailed');
                                ?>
                                </span>
                              </td>
                              <td class="menuBoxHeading">
                                <?php 
                                echo '<br><ul><li><a href="' . tep_href_link(FILENAME_CATEGORIES, 'pID=' . $VARS['product_id'] . '&amp;action=new_product') . '" class="menuBoxContentLink">' . TEXT_EDIT_PRODUCT . '</a></li>';
                                echo '<li><a href="' . tep_href_link(FILENAME_STATS_LOW_STOCK_ATTRIB, '', 'NONSSL') . '" class="menuBoxContentLink">' .TEXT_GOTO_LOW_STOCK . '</a><br></li>';
            
                                //class="menuBoxHeading columnLeft
                                //We shall now generate links back to the product in the admin/categories.php page.
                                //The same product can exist in differend categories.
                                  
                                  //Generate both the text (in $path_array) and the parameter (in $cpath_string_array)
                                  $raw_path_array =tep_generate_category_path($VARS['product_id'], 'product');
                                  $path_array = array();
                                  $cpath_string_array = array();
                                  foreach($raw_path_array as $raw_path){
                                    $path_in_progress='';
                                    $cpath_string_in_progress='';
                                    foreach($raw_path as $raw_path_piece){
                                      $path_in_progress .= $raw_path_piece['text'].' >> ';
                                      $cpath_string_in_progress .= $raw_path_piece['id'].'_';
                                    }
                                    $path_array[]= substr($path_in_progress, 0, -4);
                                    $cpath_string_array[] = substr($cpath_string_in_progress, 0, -1);
                                  }
                                  
                                  if (sizeof($raw_path_array)>0) {  
                                    $curr_pos = 0;
                                    foreach($path_array as $neverusedvariable) {
                                      print '<li><a href="' . tep_href_link(FILENAME_CATEGORIES, 'pID=' . $VARS['product_id'] . '&amp;cPath=' .  $cpath_string_array[$curr_pos], 'NONSSL') . '" class="menuBoxContentLink">' . TEXT_GOTO_PRODUCT . $path_array[$curr_pos] . '</a></li>';
                                      $curr_pos++;
                                    }
                                 } else {
                                    echo '<li>' . TEXT_LOST_PRODUCT . '</li>';				
                                 }
                                echo '</ul>';
                                ?>
                              </td>
                            </tr>
                          </table>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>
              </table>
    		</td>
    		<td width="25%" valign="top">
              <?php
			  //PGM sets contents of right hand column arrays
			  $heading = array();
			  $contents = array();
			  
			  $heading[] = array('text' => HEADING_DEFAULT_STOCK);
    		  $contents[] = array('text' => TEXT_DEFAULT_STOCK);
			  $box = new box;
              echo $box->infoBox($heading, $contents);
			  
 			  ?>
            </td>
          </tr>
        </table>
      </td>
      <!-- body_text_eof //-->
    </tr>
  </table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>