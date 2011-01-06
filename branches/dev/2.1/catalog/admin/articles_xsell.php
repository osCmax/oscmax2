<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/javascript/jquery-ui-1.8.2.custom.css">
<script type="text/javascript" src="includes/general.js"></script>
<script type="text/javascript">
function ToggleCheckBox($cb) {
	if($('#cb'+$cb).is(':checked')) {
      $('#cb'+$cb).attr('checked', false);
	} else {
	  $('#cb'+$cb).attr('checked', true);
	}
}
</script>
</head>
<body>
<!-- header //-->
<?php include(DIR_WS_INCLUDES . 'header.php');  ?>
<!-- header_eof //-->

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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
              <td class="pageHeading" align="right">&nbsp;</td>
            </tr>
          </table>
        </td>
      </tr>
      <!-- body_text //-->
	  <tr>
        <td width="100%" valign="top"> 
        <!-- Start of cross sale //-->
          <table width="100%" border="0" cellpadding="0"  cellspacing="0">
            <tr>
              <td align="left" class="main" valign="top">
              <?php
		      // Set right hand column arrays
			  $heading = array();
		      $contents = array();
		
              /* general_db_conct($query) function */
              /* calling the function:  list ($test_a, $test_b) = general_db_conct($query); */
              function general_db_conct($query_1) {
                $result_1 = tep_db_query($query_1);
                $num_of_rows = tep_db_num_rows($result_1);
                $a_to_pass = array(); $b_to_pass = array(); $c_to_pass = array(); $d_to_pass = array(); $e_to_pass = array();
				$f_to_pass = array(); $g_to_pass = array(); $h_to_pass = array(); $i_to_pass = array(); $j_to_pass = array();
				$k_to_pass = array(); $l_to_pass = array(); $m_to_pass = array(); $n_to_pass = array(); $o_to_pass = array();
                for ($i=0;$i<$num_of_rows;++$i) {
                  $fields = mysql_fetch_row($result_1);
                  $a_to_pass[$i]= $fields[$y=0];
                  $b_to_pass[$i]= $fields[++$y];
                  $c_to_pass[$i]= $fields[++$y];
                  $d_to_pass[$i]= $fields[++$y];
                  $e_to_pass[$i]= $fields[++$y];
                  $f_to_pass[$i]= $fields[++$y];
                  $g_to_pass[$i]= $fields[++$y];
                  $h_to_pass[$i]= $fields[++$y];
                  $i_to_pass[$i]= $fields[++$y];
                  $j_to_pass[$i]= $fields[++$y];
                  $k_to_pass[$i]= $fields[++$y];
                  $l_to_pass[$i]= $fields[++$y];
                  $m_to_pass[$i]= $fields[++$y];
                  $n_to_pass[$i]= $fields[++$y];
                  $o_to_pass[$i]= $fields[++$y];
                } // end for
                return array($a_to_pass,$b_to_pass,$c_to_pass,$d_to_pass,$e_to_pass,$f_to_pass,$g_to_pass,$h_to_pass,$i_to_pass,$j_to_pass,$k_to_pass,$l_to_pass,$m_to_pass,$n_to_pass,$o_to_pass);
              } //end of function  

              // first major piece of the program
              // we have no instructions, so just dump a full list of products and their status for cross selling 

              if (! isset($_GET['add_related_article_ID']) ) {
		        $heading[] = array('text' => '<b>Cross Sell Articles</b>');
		        $contents[] = array('text' => 'Please select an article that you wish to cross sell your products from by click on a row.<br><br>  If you want change the sort order that these products are shown in please click the <b>sort</b> link in the right hand column.');
				
		
              $query = "select a.articles_id, ad.articles_name, ad.articles_description, ad.articles_url from " . TABLE_ARTICLES . " a, " . TABLE_ARTICLES_DESCRIPTION . " ad where ad.articles_id = a.articles_id and ad.language_id = '" . (int)$languages_id . "' order by ad.articles_name";
              list ($articles_id, $articles_name, $articles_description, $articles_url) = general_db_conct($query);
              ?>
                
              <table border="0" cellspacing="0" cellpadding="3" width="100%">
                <tr class="dataTableHeadingRow"> 
                  <td class="dataTableHeadingContent" align="center" nowrap>ID</td>
                  <td class="dataTableHeadingContent"><?php echo HEADING_ARTICLE_NAME; ?></td>
                  <td class="dataTableHeadingContent" nowrap><?php echo HEADING_CROSS_ASSOCIATION; ?></td>
                  <td class="dataTableHeadingContent" colspan="3" align="center" nowrap><?php echo HEADING_CROSS_SELL_ACTIONS; ?></td>
                </tr>
               <?php 
               $num_of_articles = sizeof($articles_id);
                for ($i=0; $i < $num_of_articles; $i++)
                    {
                    /* now we will query the DB for existing related items */
                    $query = "select pd.products_name, ax.xsell_id from " . TABLE_ARTICLES_XSELL . " ax, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = ax.xsell_id and ax.articles_id ='".$articles_id[$i]."' and pd.language_id = '" . (int)$languages_id . "' order by ax.sort_order";
                    list ($Related_items, $xsell_ids) = general_db_conct($query);

					echo '<tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . tep_href_link(FILENAME_ARTICLES_XSELL, 'add_related_article_ID=' . $articles_id[$i], 'NONSSL') . '\'">' . " ";

                    echo "<td class=\"dataTableContent\" valign=\"top\">&nbsp;".$articles_id[$i]."&nbsp;</td>\n";
                    echo "<td class=\"dataTableContent\" valign=\"top\">&nbsp;".$articles_name[$i]."&nbsp;</td>\n";
                    if ($Related_items)
                    {
                      echo "<td  class=\"dataTableContent\"><ol>";
                      foreach ($Related_items as $display)
                        echo '<li>'. $display .'&nbsp;';
                        echo"</ol></td>\n";
                        }
                    else
                        echo "<td class=\"dataTableContent\">--</td>\n";
                    echo '<td class="dataTableContent"  valign="top">&nbsp;<a href="' . tep_href_link(FILENAME_ARTICLES_XSELL, 'add_related_article_ID=' . $articles_id[$i], 'NONSSL') . '">Add/Remove</a></td>';
                                    
                    if (count($Related_items)>1)
                    {
                      echo '<td class="dataTableContent" valign="top">&nbsp;<a href="' . tep_href_link(FILENAME_ARTICLES_XSELL, 'sort=1&amp;add_related_article_ID=' . $articles_id[$i], 'NONSSL') . '">Sort</a>&nbsp;</td>';
                    } else {
                        echo "<td class=\"dataTableContent\" valign=top align=center>--</td>";
                        }
                    echo "</tr>\n";
                    unset($Related_items);
                    }
                ?>

              </table>
              <?php
              }   // the end of -> if (!$add_related_article_ID)

              if ($_POST && ! isset($_GET['sort'])) {
                if ($_POST['run_update']) {
                  $ids = ' ( ';
                  for ($x = 0; $x < count($_POST['xsell_id']); ++$x) {
                    $ids .= ' xsell_id = ' . (int)$_POST['xsell_id'][$x] . ' or '; 
                  }
                $ids = substr($ids, 0, -3);
                $ids .= ' ) ';
                $query ="DELETE FROM " . TABLE_ARTICLES_XSELL . " WHERE articles_id = '".(int)$_POST['add_related_article_ID']."' and " . $ids;
                if (!tep_db_query($query))
                  exit(TEXT_NO_DELETE);
              } else if (isset($_POST['xsell_id'])) {
                $id = $_GET['add_related_article_ID'];
                foreach ($_POST['xsell_id'] as $temp) {
                  $query = "INSERT INTO " . TABLE_ARTICLES_XSELL . " VALUES ('',$id,$temp,1)";
                  if (!tep_db_query($query))
                    exit(TEXT_NO_INSERT);
                  } 
              } // enf if  
	  
	  		  $heading[] = array('text' => '<b>Cross Sell Articles: Database Updated</b>');
			  $contents[] = array('text' => 'Your changes have been saved to the database please either go back to the main page or click the link to sort the order in which the cross sell products are listed.');
			  ?>
      		  <table border="0" cellpadding="2" cellspacing="0" width="100%" bgcolor="#999999">
      		    <tr class="dataTableHeadingRow">
        		  <td class="dataTableHeadingContent" width="100%"><?php echo TEXT_DATABASE_UPDATED; ?></td>
	  			</tr>
                <tr bgcolor="#FFFFFF">
                  <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                  <td class="main"><?php echo sprintf(TEXT_LINK_SORT_PRODUCTS, tep_href_link(FILENAME_ARTICLES_XSELL, '&sort=1&amp;add_related_article_ID=' . (int)$_POST['add_related_article_ID'], 'NONSSL')); ?></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                  <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                  <td class="main"><?php echo sprintf(TEXT_LINK_MAIN_PAGE, tep_href_link(FILENAME_ARTICLES_XSELL, '', 'NONSSL')); ?></td>
                </tr>
                <tr bgcolor="#FFFFFF">
                  <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
                </tr>
              </table>
              <?php
              //  if ($_POST[xsell_id])
              //  echo '<a href="' . tep_href_link(FILENAME_ARTICLES_XSELL, 'sort=1&add_related_article_ID=' . $_POST[add_related_article_ID], 'NONSSL') . '">Click here to sort (top to bottom) the added cross sale</a>' . "\n";
             } // end function

             if (isset($_GET['add_related_article_ID']) && ! $_POST && ! isset($_GET['sort'])) {   
		       $heading[] = array('text' => '<b>Cross Sell Articles</b>');
		       $contents[] = array('text' => 'Please select the category of the product you wish to cross sell.');
	         ?>
	         <table border="0" cellpadding="2" cellspacing="0" width="100%" bgcolor="#999999">
               <tr class="dataTableHeadingRow">
                 <td class="dataTableHeadingContent" width="100%">Please select a category</td>
	           </tr>
               <tr class="dataTableRow">
                 <td class="dataTableContent">
                 <?php  
		           echo tep_draw_form('goto', "articles_xsell.php", '', 'get') . tep_hide_session_id();
        	       echo '<input type="hidden" name="add_related_article_ID" value="'.(int)$_GET['add_related_article_ID'].'" />';
                   echo SELECT_CATEGORY ."&nbsp;:" . tep_draw_pull_down_menu('cPath', tep_get_category_tree(), $current_category_id, 'onChange="this.form.submit();"');
                   echo '</form>';
		           ?>
                 </td>
               </tr>
             </table>
	
		     <?php
             if (isset($_GET['cPath'])) {
		       $contents[] = array('text' => 'Then select the product you wish to add by checking the tick boxes.');
             ?>
             <table border="0" cellpadding="0" cellspacing="0" width="100%">
               <tr>
                 <td><form action="<?php tep_href_link(FILENAME_ARTICLES_XSELL, '', 'NONSSL'); ?>" method="post">
                   <table border="0" cellpadding="2" cellspacing="0" width="100%" bgcolor="#999999">
                     <tr class="dataTableHeadingRow">
                       <td class="dataTableHeadingContent" width="50" align="center">ID</td>
                       <td class="dataTableHeadingContent" width="50">Model</td>
                       <td class="dataTableHeadingContent" width="<?php echo SMALL_IMAGE_WIDTH; ?>">Image</td>
                       <td class="dataTableHeadingContent"><?php echo HEADING_PRODUCT_NAME; ?></td>
                       <td class="dataTableHeadingContent" width="50">Select</td>
                     </tr>
                     <?php
                     $query = "select p.products_id, p.products_image, p.products_model, pd.products_name, pd.products_description, pd.products_url from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c where p2c.categories_id='".tep_db_input((int)$_GET['cPath'])."' and pd.products_id = p.products_id and p2c.products_id=p.products_id and pd.language_id = '" . (int)$languages_id . "' order by pd.products_name ";
    
                     list ($products_id, $products_image, $products_model, $products_name, $products_description, $products_url ) = general_db_conct($query);
                     $num_of_products = sizeof($products_id);
                     $query = "select * from " . TABLE_ARTICLES_XSELL . " where articles_id = '".(int)$_GET['add_related_article_ID']."'";
                     list ($ID_PR, $products_id_pr, $xsell_id_pr) = general_db_conct($query);
                     $run_update=false; // set to false to insert new entry in the DB
            
                     for ($i=0; $i < $num_of_products; ++$i) {
			         ?>
                     <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" onClick="javascript:ToggleCheckBox(<?php echo $i; ?>)">
                       <td class="dataTableContent" align="center"><?php echo $products_id[$i];?></td>
                       <td class="dataTableContent"><?php echo $products_model[$i];?></td>
                       <td class="dataTableContent" align="center"><?php echo tep_image('../' . DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $products_image[$i], '', SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT); ?></td>
                       <td class="dataTableContent"><?php echo $products_name[$i];?></td>
                       <td class="dataTableContent" align="center"><input 
                       <?php /* this is to see if it is in the DB */
                       if ($xsell_id_pr) {
                         foreach ($xsell_id_pr as $compare_checked) {
                           if ($products_id[$i]===$compare_checked) {
                             echo "checked"; 
                             $run_update=true;
                           } // end if 
                         } // end for 
                       } // end if    
                       ?> size="20" name="xsell_id[]" type="checkbox" id="cb<?php echo $i;?>" value="<?php echo $products_id[$i]; ?>">
                       </td>
                     </tr>
                   <?php
                   } // end for $i=
                   ?>
            
                     <tr class="dataTableRow">
                       <td colspan="5" align="right" class="dataTableContent">
                       <?php
                       // list also those products not in current category
                       $myquery = "SELECT ax.xsell_id AS nid FROM " . TABLE_ARTICLES_XSELL . " ax, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c WHERE ax.articles_id='".(int)$_POST['add_related_article_ID']."' AND ax.xsell_id=p2c.products_id AND categories_id!='".tep_db_input((int)$_GET['cPath'])."'";
                       $myids_query = tep_db_query($myquery);
                       ?>
                       <div style="display:none">
				       <?php
                       while ($tempid = tep_db_fetch_array($myids_query)) {
                         echo  '<input type="checkbox" name="xsell_id[]" value="'.$tempid['nid'].'" checked>';
                       }
                       ?>
                       </div>
                       <input type="hidden" name="run_update" value="<?php echo $run_update; ?>">
                       <input type="hidden" name="add_related_article_ID" value="<?php echo (int)$_GET['add_related_article_ID']; ?>">
                       <?php
                       echo tep_image_submit('button_save.gif', IMAGE_SAVE) . '&nbsp;<a href="' . tep_href_link(FILENAME_ARTICLES_XSELL) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>&nbsp;'; ?>
                       </td>
                     </tr>
                   </table>
                 </form></td>
               </tr>
             </table>
             <?php 
		     } // end if (isset($_GET['cPath']))
          }
          // sort routines
        
          if (isset($_GET['sort']) && $_GET['sort'] == 1) {
            // first lets take care of the DB update.
            $run_once=0;
            if ($_POST) {  
              foreach ($_POST as $key_a => $value_a) {
                tep_db_connect();
                $query = "UPDATE " . TABLE_ARTICLES_XSELL . " SET sort_order = '".$value_a."' WHERE xsell_id= '$key_a' ";
                if ($value_a != 'Update')
                  if (!tep_db_query($query))
                    exit(TEXT_NO_UPDATE);
                  else
                  if ($run_once==0) { 
				  ?>
                    <table border="0" cellpadding="2" cellspacing="0" width="100%" bgcolor="#999999">
                      <tr class="dataTableHeadingRow">
                        <td class="dataTableHeadingContent"><?php echo TEXT_DATABASE_UPDATED; ?></td>
                      </tr>
                    </table>
                    <table>
                      <tr>
                        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
                      </tr>
                      <tr>
                        <td class="main"><?php echo sprintf(TEXT_LINK_MAIN_PAGE, tep_href_link(FILENAME_ARTICLES_XSELL, '', 'NONSSL')); ?></td>
                      </tr>
                      <tr>
                        <td><?php echo tep_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
                      </tr>
                    </table>
                    <?php
                     $run_once++;
                  } // end if ($run_once==0)
            } // end of foreach.
          } // end if       
          ?>
            <form method="post" action="<?php tep_href_link(FILENAME_ARTICLES_XSELL, 'sort=1&amp;add_related_article_ID=' . $_POST['add_related_article_ID'], 'NONSSL'); ?>">
            <table cellpadding="2" cellspacing="0" bgcolor="#CCCCCC" border="0" width="100%">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="center">ID</td>
                <td class="dataTableHeadingContent"><?php echo HEADING_PRODUCT_NAME; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo HEADING_PRODUCT_ORDER; ?></td>
              </tr>
              <?php
              $query = "select * from " . TABLE_ARTICLES_XSELL . " where articles_id = '".(int)$_GET['add_related_article_ID']."'";
              list ($ID_PR, $products_id_pr, $xsell_id_pr, $order_PR) = general_db_conct($query);
              $ordering_size =sizeof($ID_PR);
              for ($i=0;$i<$ordering_size;++$i) {
                $query = "select p.products_id, pd.products_name, pd.products_description, pd.products_url from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pd.language_id = '" . (int)$languages_id . "' and p.products_id = ".$xsell_id_pr[$i]."";
                list ($products_id, $products_name, $products_description, $products_url) = general_db_conct($query);
                ?>
              <tr class="dataTableContentRow" bgcolor="#FFFFFF">
                <td class="dataTableContent" align="center"><?php echo $products_id[0]; ?></td>
                <td class="dataTableContent"><?php echo $products_name[0]; ?></td>
                <td class="dataTableContent" align="center"><select name="<?php echo $products_id[0]; ?>">
                <?php 
				for ($y=1;$y<=$ordering_size;++$y) {
                  echo "<option value=\"$y\"";
                  if (!(strcmp($y, "$order_PR[$i]"))) {echo "SELECTED";}
                    echo ">$y</option>";
                  }
                ?>
                </select></td>
              </tr>
              <?php
              } // the end of foreach
              ?>
              <tr>
                <td bgcolor="#CCCCCC" colspan="3" align="right"><?php echo tep_image_submit('button_save.gif', IMAGE_SAVE) . '&nbsp;<a href="' . tep_href_link(FILENAME_ARTICLES_XSELL) . '">' . tep_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>&nbsp;'; ?></td>
              </tr>
            </table>
            </form>
            <?php } ?>
          </td>
          <td width="25%" valign="top">
          <?php
	      if ( (tep_not_null($heading)) && (tep_not_null($contents)) ) {
		    $box = new box;
			echo $box->infoBox($heading, $contents);
		  } else {
		    $heading[] = array('text' => '<b>Cross Sell Articles</b>');
			$contents[] = array('text' => '<br><br><br>');
			$box = new box;
			echo $box->infoBox($heading, $contents);
		  }
		  ?>
          </td>
        </tr>   
      </table>
      <!-- End of cross sale //-->
    </td>
  </tr>
</table>
</td>
</tr>
</table>
<!-- body_text_eof //-->
<!-- footer //-->
<?php include(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php include(DIR_WS_INCLUDES . 'application_bottom.php'); ?>