<?php
/*
$Id: xsell_products.php 14 2006-07-28 17:42:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License

  cross.sale.php created By Isaac Mualem im@imwebdesigning.com

  Modified by Andrew Edmond (osc@aravia.com)
  Sept 16th, 2002
*/

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<title><?php echo TITLE; ?></title>

<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="JavaScript1.2">

function cOn(td)
{
  if(document.getElementById||(document.all && !(document.getElementById)))
  {
    td.style.backgroundColor="#CCCCCC";
  } 
}

function cOnA(td)
{
  if(document.getElementById||(document.all && !(document.getElementById)))
  {
    td.style.backgroundColor="#CCFFFF";
  }
}

function cOut(td)
{
  if(document.getElementById||(document.all && !(document.getElementById)))
  {
    td.style.backgroundColor="DFE4F4";
  }
}
</script>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<!-- header //-->
<?php include(DIR_WS_INCLUDES . 'header.php');  ?>
<!-- header_eof //-->


<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
    </table></td>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo "Cross-Sell (X-Sell) Admin"; ?></td>
            <td class="pageHeading" align="right">&nbsp;</td>
          </tr>
        </table></td>
     </tr>
   
<!-- body_text //-->
    <td width="100%" valign="top"> 
      <!-- Start of cross sale //-->

      <table width="100%" border="0" cellpadding="0"  cellspacing="0">
        <tr><td align=center>
        <?php
	/* general_db_conct($query) function */
	/* calling the function:  list ($test_a, $test_b) = general_db_conct($query); */
	function general_db_conct($query_1)
	{
	  $result_1 = tep_db_query($query_1);
  	  $num_of_rows = mysql_num_rows($result_1);
	  for ($i=0;$i<$num_of_rows;$i++)
	  {
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
	  }
	return array($a_to_pass,$b_to_pass,$c_to_pass,$d_to_pass,$e_to_pass,$f_to_pass,$g_to_pass,$h_to_pass,$i_to_pass,$j_to_pass,$k_to_pass,$l_to_pass,$m_to_pass,$n_to_pass,$o_to_pass);
	}//end of function	

        // first major piece of the program
        // we have no instructions, so just dump a full list of products and their status for cross selling	

	if (!$add_related_product_ID )
	{
        $query = "select a.products_id, b.products_name, b.products_description, " .
                 "a.products_quantity, a.products_model, a.products_image, " .
                 "b.products_url, a.products_price from products a, products_description b where b.products_id = a.products_id order by b.products_name";
	list ($PRODUCTS_id, $PRODUCTS_name, $PRODUCTS_description  , $PRODUCTS_quantity  , $PRODUCTS_model  , $PRODUCTS_image  , $PRODUCTS_url  , $PRODUCTS_price  ) = general_db_conct($query);
	?>
				
            <table border="0" cellspacing="1" cellpadding="2" bgcolor="#999999">
              <tr class="dataTableHeadingRow"> 
                <td class="dataTableHeadingContent" nowrap align=center>ID</td>
                <td class="dataTableHeadingContent">Product Name</td>
                <td class="dataTableHeadingContent" nowrap>Cross-Associated Products</td>
                <td class="dataTableHeadingContent" colspan=3 nowrap align=center>Cross Sell Actions</td>
              </tr>
               <?php 
			   $num_of_products = sizeof($PRODUCTS_id);
				for ($i=0; $i < $num_of_products; $i++)
					{
					/* now we will query the DB for existing related items */
 $query = "select b.products_name, a.xsell_id from " . TABLE_PRODUCTS_XSELL . " a, products_description b WHERE b.products_id = a.xsell_id and a.products_id ='".$PRODUCTS_id[$i]."' ORDER BY sort_order";
					list ($Related_items, $xsell_ids) = general_db_conct($query);
					
					echo "<tr onMouseOver=\"cOn(this);\" onMouseOut=\"cOut(this);\" bgcolor='#DFE4F4'>";
					echo "<td class=\"dataTableContent\" valign=\"top\">&nbsp;".$PRODUCTS_id[$i]."&nbsp;</td>\n";
					echo "<td class=\"dataTableContent\" valign=\"top\">&nbsp;".$PRODUCTS_name[$i]."&nbsp;</td>\n";
					if ($Related_items)
					{
  					  echo "<td  class=\"dataTableContent\"><ol>";
					  foreach ($Related_items as $display)
 						echo '<li>'. $display .'&nbsp;';
						echo"</ol></td>\n";
						}
					else
						echo "<td class=\"dataTableContent\">--</td>\n";
					echo '<td class="dataTableContent"  valign="top">&nbsp;<a href="' . tep_href_link(FILENAME_XSELL_PRODUCTS, 'add_related_product_ID=' . $PRODUCTS_id[$i], 'NONSSL') . '">Add</a>&nbsp;</td><td class="dataTableContent" valign="top">&nbsp;<a href="' . tep_href_link(FILENAME_XSELL_PRODUCTS, 'add_related_product_ID=' . $PRODUCTS_id[$i], 'NONSSL') . '">Remove</a>&nbsp;</td>';
									
					if (count($Related_items)>1)
					{
					  echo '<td class="dataTableContent" valign="top">&nbsp;<a href="' . tep_href_link(FILENAME_XSELL_PRODUCTS, 'sort=1&add_related_product_ID=' . $PRODUCTS_id[$i], 'NONSSL') . '">Sort</a>&nbsp;</td>';
					} else {
						echo "<td class=\"dataTableContent\" valign=top align=center>--</td>";
						}
					echo "</tr>\n";
					unset($Related_items);
					}
				?>
				
            </table> 
            <?php
			}	// the end of -> if (!$add_related_product_ID)
			
	if ($_POST && !$sort)
	{
  	  if ($_POST[run_update]==true)
	  {
	    $query ="DELETE FROM " . TABLE_PRODUCTS_XSELL . " WHERE products_id = '".$_POST[add_related_product_ID]."'";
	    if (!tep_db_query($query))
		exit('could not delete');
	  }
	  if ($_POST[xsell_id])
		foreach ($_POST[xsell_id] as $temp)
  	  {
	    $query = "INSERT INTO " . TABLE_PRODUCTS_XSELL . " VALUES ('',$_POST[add_related_product_ID],$temp,1)";
	    if (!tep_db_query($query))
		exit('could not insert to DB');
	  }
	  echo '<a href="' . tep_href_link(FILENAME_XSELL_PRODUCTS, '', 'NONSSL') . '">Click Here to add a new cross sale</a><br>' . "\n";
	  if ($_POST[xsell_id])
		echo '<a href="' . tep_href_link(FILENAME_XSELL_PRODUCTS, 'sort=1&add_related_product_ID=' . $_POST[add_related_product_ID], 'NONSSL') . '">Click here to sort (top to bottom) the added cross sale</a>' . "\n";
	}
		
        if ($add_related_product_ID && ! $_POST && !$sort)	
	{	?>	
 	  <table border="0" cellpadding="2" cellspacing="1" bgcolor="#999999">
              <form action="<?php tep_href_link(FILENAME_XSELL_PRODUCTS, '', 'NONSSL'); ?>" method="post">
                <tr class="dataTableHeadingRow"> 
<?php

        $query = "select a.products_id, b.products_name, b.products_description, " .
                 "a.products_quantity, a.products_model, a.products_image, " .
                 "b.products_url, a.products_price from products a, products_description b where b.products_id = a.products_id and a.products_id = '".$add_related_product_ID."'";
			list ($PRODUCTS_id, $PRODUCTS_name, $PRODUCTS_description  , $PRODUCTS_quantity  , $PRODUCTS_model  , $PRODUCTS_image  , $PRODUCTS_url  , $PRODUCTS_price  ) = general_db_conct($query); 
?>

                  <td class="dataTableHeadingContent">&nbsp;</td>
                  <td class="dataTableHeadingContent" nowrap>Item #</td>
                  <td class="dataTableHeadingContent">Item Name</td>
                  <td class="dataTableHeadingContent">$Price</td>
                </tr>
	
                <?php 

        $query = "select a.products_id, b.products_name, b.products_description, " .
                 "a.products_quantity, a.products_model, a.products_image, " .
                 "b.products_url, a.products_price from products a, products_description b where b.products_id = a.products_id and a.products_id != '".$add_related_product_ID."' order by b.products_name";

			list ($PRODUCTS_id, $PRODUCTS_name, $PRODUCTS_description  , $PRODUCTS_quantity  , $PRODUCTS_model  , $PRODUCTS_image  , $PRODUCTS_url  , $PRODUCTS_price  ) = general_db_conct($query); 
			 $num_of_products = sizeof($PRODUCTS_id);
				$query = "select * from " . TABLE_PRODUCTS_XSELL . " WHERE products_id = '".$add_related_product_ID."'";
						list ($ID_PR, $PRODUCTS_id_PR, $xsell_id_PR) = general_db_conct($query); 
					for ($i=0; $i < $num_of_products; $i++)
					{
					?><tr bgcolor='#DFE4F4'>
						<td class="dataTableContent">
					
					<input <?php /* this is to see it it is in the DB */
						$run_update=false; // set to false to insert new entry in the DB
						if ($xsell_id_PR) foreach ($xsell_id_PR as $compare_checked)if ($PRODUCTS_id[$i]===$compare_checked) {echo "checked"; $run_update=true;} ?> size="20"  size="20"  name="xsell_id[]" type="checkbox" value="<?php echo $PRODUCTS_id[$i]; ?>"></td>
					
					<?php echo "<td  class=\"dataTableContent\" align=center>".$PRODUCTS_id[$i]."</td>\n"
						."<td class=\"dataTableContent\">".$PRODUCTS_name[$i]."</td>\n"
						."<td class=\"dataTableContent\">".$currencies->display_price($PRODUCTS_price[$i], tep_get_tax_rate($product_info_values['products_tax_class_id']))."</td></tr>\n";
					}?>
					<tr> 
                  <td colspan="4">
				  
				   <input type="hidden" name="run_update" value="<?php if ($run_update==true) echo "true"; else echo "false" ?>">
				  <input type="hidden" name="add_related_product_ID" value="<?php echo $add_related_product_ID; ?>">
                    <input type="submit" name="Submit" value="Submit"></td>
                </tr>
              </form>
            </table>	
		<?php } 

        // sort routines
	if ($sort==1)
	{ 
	//	first lets take care of the DB update.
  	  $run_once=0;
	  if ($_POST)
		foreach ($_POST as $key_a => $value_a)
	  {
		tep_db_connect();
		$query = "UPDATE " . TABLE_PRODUCTS_XSELL . " SET sort_order = '".$value_a."' WHERE xsell_id= '$key_a' ";
		//$query ="DELETE FROM " . TABLE_PRODUCTS_XSELL . " WHERE products_id = '".$key_a."'";
		if ($value_a != 'Update')
			if (!tep_db_query($query))
				exit('could not UPDATE DB');
			else 
				if ($run_once==0)
				{
					echo '<b>The Database was updated <a href="' . tep_href_link(FILENAME_XSELL_PRODUCTS, '', 'NONSSL') . '">Click here to back to the main page</a></b><br>' . "\n";
					$run_once++;
				}
				
	}// end of foreach.
	?>
	<form method="post" action="<?php tep_href_link(FILENAME_XSELL_PRODUCTS, 'sort=1&add_related_product_ID=' . $add_related_product_ID, 'NONSSL'); ?>">
              <table cellpadding="2" cellspacing="1" bgcolor=999999 border="0">
                <tr class="dataTableHeadingRow"> 
                  <td class="dataTableHeadingContent" width="75">Product ID</td>
                  <td class="dataTableHeadingContent">Name</td>
                  <td class="dataTableHeadingContent" width="150">Price</td>
                  <td class="dataTableHeadingContent" width="150">Order (1=Top)</td>
                </tr>
				<?php 
				$query = "select * from " . TABLE_PRODUCTS_XSELL . " WHERE products_id = '".$add_related_product_ID."'";
				list ($ID_PR, $PRODUCTS_id_PR, $xsell_id_PR, $order_PR) = general_db_conct($query); 
				$ordering_size =sizeof($ID_PR);
				for ($i=0;$i<$ordering_size;$i++) 
					{

        $query = "select a.products_id, b.products_name, b.products_description, " .
                 "a.products_quantity, a.products_model, a.products_image, " .
                 "b.products_url, a.products_price from products a, products_description b where b.products_id = a.products_id and a.products_id = ".$xsell_id_PR[$i]."";

					list ($PRODUCTS_id, $PRODUCTS_name, $PRODUCTS_description  , $PRODUCTS_quantity  , $PRODUCTS_model  , $PRODUCTS_image  , $PRODUCTS_url  , $PRODUCTS_price  ) = general_db_conct($query); 
		
					?>
					<tr class="dataTableContentRow" bgcolor='#DFE4F4'> 
					  <td class="dataTableContent"><?php echo $PRODUCTS_id[0]; ?></td>
					  <td class="dataTableContent"><?php echo $PRODUCTS_name[0]; ?></td>
					  <td class="dataTableContent"><?php echo $currencies->display_price($PRODUCTS_price[0], tep_get_tax_rate($product_info_values['products_tax_class_id'])); ?></td>
					  <td class="dataTableContent"><select name="<?php echo $PRODUCTS_id[0]; ?>">
						  <?php for ($y=1;$y<=$ordering_size;$y++)
						  		{
								echo "<option value=\"$y\"";
									if (!(strcmp($y, "$order_PR[$i]"))) {echo "SELECTED";}
									echo ">$y</option>";
								}
								?>
						</select></td>
					</tr>
					<?php } // the end of foreach	?>
                <tr> 
                  <td colspan="4" bgcolor='#DFE4F4'><input name="runing_update" type="submit" id="runing_update" value="Update"></td>
                </tr>
              </table>
            </form>
			
			<?php }?>
		
		
          </td>
        </tr>	
	</table>
	<!-- End of cross sale //-->
	</td>
<!-- products_attributes_eof //-->
</tr></table>
<!-- body_text_eof //-->
<!-- footer //-->
<?php include(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br>
</body>
</html>
<?php include(DIR_WS_INCLUDES . 'application_bottom.php');?>
