<?php
/*
$Id:$

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
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/javascript/jquery-ui-1.8.2.custom.css">
<script type="text/javascript" src="includes/general.js"></script>
</head>
<body>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top">
      <table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
      <!-- left_navigation //-->
      <?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
      <!-- left_navigation_eof //-->
      </table>
    </td>
<!-- body_text //-->
    <td width="100%" valign="top">
      <table border="0" width="100%" cellspacing="2" cellpadding="0">
        <tr>
          <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
        </tr>
        <!-- Actual code for Specials Admin starts here -->
<?php
  //Fetch all variables
  if (isset($_POST['categories'])) {
	  $categories = (int)$_POST['categories'];
  } elseif (isset($_GET['categories'])) {
	 $categories = (int)$_GET['categories'];
  } else {
	  $categories = '0';
  }

  if (isset($_POST['manufacturer'])) { // from drop-down menu:
	  $manufacturer = (int)$_POST['manufacturer'];
  } elseif (isset($_POST['manufacturers_id'])) {
	  $manufacturer = (int)$_POST['manufacturers_id'];
  } elseif (isset($_GET['manufacturer'])) { // from page links
	  $manufacturer = (int)$_GET['manufacturer'];
  } else {
	  $manufacturer = '0';
  }
 
  if ($manufacturer != '0')  {
  	$man_filter = " and manufacturers_id = '". $manufacturer ."' ";
  } else {
    $man_filter = ' ';
  }

  if (isset($_POST['customers_groups'])) {   // from drop-down menu:
	$customers_group = (int)$_POST['customers_groups'];
  } elseif (isset($_POST['cg_id'])) {   // hidden values in forms
	$customers_group = (int)$_POST['cg_id'];
  } 
  
  if (isset($_POST['page'])) {
	  $this_page = $_POST['page'];
  } elseif (isset($_GET['page'])) {
	  $this_page = $_GET['page'];
  } else {
	  $this_page = '';
  }
	 
  if (array_key_exists('discount',$_POST)) {
  	if (is_numeric($_POST['discount'])) {
  	  $discount = (float)$_POST['discount'];
    } else {
  	  $discount = -1;    	
    }
  } else { 
  	$discount = -1;
  }

  if ($_POST['submit']) {
    foreach($_POST['master'] as $m) {
	  $fullprice = (isset($m['fullprice']) ? $m['fullprice'] : '');
      $productid = (isset($m['productid']) ? (int)$m['productid'] : '0');
      $inputspecialprice = (isset($m['inputspecialprice']) ? $m['inputspecialprice'] : TEXT_NONE);
	  
      if (substr($inputspecialprice, -1) == '%') {
        $productprice = (isset($m['productprice']) ? (float)$m['productprice'] : '');
        $specialprice = ($productprice - (($inputspecialprice / 100) * $productprice));
      } elseif (substr($inputspecialprice, -1) == 'i') {
        $taxrate = (isset($m['taxrate']) ? (float)$m['taxrate'] : '1');
        $productprice = (isset($m['productprice']) ? (float)$m['productprice'] : '');
        $specialprice = ($inputspecialprice /(($taxrate/100)+1));
      } else {
      	$specialprice = $inputspecialprice;
      }
      $alreadyspecial = tep_db_query ("SELECT * FROM " . TABLE_SPECIALS . " WHERE products_id = '" . $productid. "' AND customers_group_id = '" . $customers_group . "'");
      $specialproduct = tep_db_fetch_array($alreadyspecial);
      if (tep_not_null($specialproduct['specials_id'])) {
        tep_db_query ("UPDATE " . TABLE_SPECIALS . " SET specials_new_products_price = '" . $specialprice . "', specials_last_modified = NOW() where specials_id = '" . $specialproduct['specials_id'] . "'"); 
      } else {
        tep_db_query ("INSERT INTO " . TABLE_SPECIALS . " (specials_id, products_id, specials_new_products_price, specials_date_added, specials_last_modified, expires_date, date_status_change, status, customers_group_id)VALUES ('','" . $productid . "','" . $specialprice . "',NOW(),NOW(),'0000-00-00 00:00','','1','" . $customers_group . "')");
      }
	  
	  // Now remove the specials which have the fullprice ignore checkbox ticked.
	  if ( ($fullprice == 'yes') || ($specialprice == 0) ){
        tep_db_query("DELETE FROM " . TABLE_SPECIALS . " WHERE products_id = '" . $productid . "' AND customers_group_id = '" . $customers_group . "'");
      } // end if ($fullprice == 'yes')
	  
	} // end foreach($_POST['master'] as $m) 
  } // end if ($_POST['submit'])
?>
        <tr class="dataTableHeadingRow">
          <td valign="top"><form action="<?php echo $current_page; ?>" method="POST">  
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" align="left">
<?php
    $customers_groups_query = tep_db_query("select customers_group_name, customers_group_id from " . TABLE_CUSTOMERS_GROUPS . " order by customers_group_id ");
    while ($existing_groups =  tep_db_fetch_array($customers_groups_query)) {
      $input_groups[] = array("id" => $existing_groups['customers_group_id'], "text"=> $existing_groups['customers_group_name']);
      $all_groups[$existing_groups['customers_group_id']] = $existing_groups['customers_group_name'];
    }

  echo TEXT_SELECT_CAT .': &nbsp;'. tep_draw_pull_down_menu('categories', tep_get_category_tree(), $categories) . '&nbsp;' . TEXT_SELECT_CUST_GROUP.': &nbsp;'. tep_draw_pull_down_menu('customers_groups', $input_groups, (isset($customers_group) ? $customers_group:'')) . '&nbsp;';
  
  $manufacturers_array = array(array('id' => '0', 'text' => TEXT_NONE));
  $manufacturers_query = tep_db_query("select manufacturers_id, manufacturers_name from " . TABLE_MANUFACTURERS . " order by manufacturers_name");
  while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
    $manufacturers_array[] = array('id' => $manufacturers['manufacturers_id'],
                                 'text' => $manufacturers['manufacturers_name']);
  }
  echo TEXT_SELECT_MAN .' :&nbsp;' . tep_draw_pull_down_menu('manufacturer', $manufacturers_array, $manufacturer) .'&nbsp;' . TEXT_ENTER_DISCOUNT . ':&nbsp; ';
?>

                <input type="text" size="4" name="discount" value="<?php if ($discount > 0) { echo $discount; } ?>"><?php echo TEXT_PCT_AND; ?> 
                <input type="submit" name="top_button" value="<?php echo TEXT_BUTTON_SUBMIT; ?>">
                </td>
              </tr>
            </table>
          </form>
          </td>
          <td class="dataTableHeadingContent" align="left">
          <form action="<?php echo $current_page; ?>" method="POST"><input type="submit" name="reset" value="<?php echo TEXT_BUTTON_RESET; ?>"></form>
          </td>
        </tr>        
              
       
      <!-- next: table with data and prices -->
      <?php
      if ($discount == -1) {
  	    //echo 'do nothing';
      } elseif ($discount == '0') {
	    if ($categories) {
          $result2 = tep_db_query("select p.products_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " ptc WHERE p.products_id = ptc.products_id AND ptc.categories_id= '" . $categories. "' " . $man_filter . "");
	    } else {
		  $result2 = tep_db_query("select p.products_id from " . TABLE_PRODUCTS . " p where " . substr($man_filter, 4) . ""); // substr chops of " and " from $man_filter
	    } // end if ($categories)
    
	    while ( $row = tep_db_fetch_array($result2) ){
          $allrows[] = $row['products_id'];
        } // end while
        
		if (tep_not_null($allrows)) { // implode will give an error when $allrows is empty
          tep_db_query("DELETE FROM " . TABLE_SPECIALS . " WHERE products_id in ('".implode("','",$allrows)."') AND customers_group_id = '" . $customers_group . "'");
        } // end if (tep_not_null($allrows))
      } elseif ($discount > 0) {  
        $specialprice = $discount / 100;
    
        if ($categories) {
          $result2 = tep_db_query("select p.products_id, p.products_price from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_TO_CATEGORIES . " ptc WHERE p.products_id = ptc.products_id AND ptc.categories_id = '" . $categories . "' " . $man_filter . "");
        } else {
    	  $result2 = tep_db_query("select p.products_id, p.products_price from " . TABLE_PRODUCTS . " p where " . substr($man_filter, 5) . ""); // substr chops of " and " from $man_filter
        } // end if ($categories)
    
	    $product_ids[] = '';
        while ( $_row = tep_db_fetch_array($result2) ){
          $row3[] = $_row;
          $product_ids[] = $_row['products_id'];
        } // end while ( $_row = tep_db_fetch_array($result2) )
  
        // now get the group prices if necessary
        if ($customers_group != '0' && tep_not_null($product_ids)) {
	      $cg_prices_query = tep_db_query("select customers_group_price, products_id from " . TABLE_PRODUCTS_GROUPS . " where products_id in ('".implode("','", $product_ids)."') AND customers_group_id = '" . $customers_group . "'");
          while ($cg_prices = tep_db_fetch_array($cg_prices_query)) {
	        for ($x = 0; $x < count($row3); $x++) {
		      if ($row3[$x]['products_id'] == $cg_prices['products_id']) {
			    $row3[$x]['products_price'] = $cg_prices['customers_group_price'];
		      } // end if
	        } // end for ($x = 0; $x < count($row3); $x++)
          } // end while ($cg_prices = tep_db_fetch_array($cg_prices_query))
        } // end if ($customers_group != '0')
  
        // now find those products that are already specials for this customer group
        $result3 = tep_db_query("select * from " . TABLE_SPECIALS . " where products_id in ('".implode("','", $product_ids)."') AND customers_group_id = '" . $customers_group . "'");
        $num_rows = tep_db_num_rows($result3);
        $specials_product_ids_array = array();
        if ($num_rows > 0) {
	      while ($_result3 = tep_db_fetch_array($result3)) {
		    $specials_product_ids_array[] = $_result3['products_id'];
	      } // end while
        } // end if ($num_rows > 0)
      
        for ($x = 0; $x < count($row3); $x++) {
          $hello2 = $row3[$x]['products_price'];
          $hello3 = $hello2 * $specialprice;
          $hello4 = $hello2 - $hello3;
          $number = $row3[$x]['products_id'];

          if (in_array($row3[$x]['products_id'], $specials_product_ids_array)) {
	        tep_db_query ("update " . TABLE_SPECIALS . " set specials_new_products_price = '" . $hello4 . "', specials_last_modified = NOW() where products_id = '" . $number. "' AND customers_group_id = '" . $customers_group . "'"); 
          } else {
            tep_db_query("insert into " . TABLE_SPECIALS . " (products_id, specials_new_products_price, specials_date_added, expires_date, status, customers_group_id) values ('" . $number . "', '" . $hello4 . "', NOW(), '0000-00-00 00:00', '1', '" . $customers_group . "')");
          } // end if
        } // end for ($x = 0; $x < count($row3); $x++)
      } // end elseif ($discount > 0)

     // only show the table when something was chosen
     //if (isset($_POST['top_button']) || isset($_POST['inputupdate']) || isset($_GET['categories'])) {
       if (tep_not_null($categories) && !tep_not_null($manufacturer)) {
         $result2_query_raw = "select pd.products_name, p.products_price, p.products_id, ptc.categories_id, 'N' AS group_price, p.products_tax_class_id, NULL AS specials_new_products_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . 
                          " ptc, " . TABLE_PRODUCTS . " p where pd.products_id=ptc.products_id and p.products_id=ptc.products_id 
               and ptc.categories_id = '" . $categories . "' and pd.language_id = " .(int)$languages_id . " order by pd.products_name asc ";
       } elseif (tep_not_null($manufacturer) && !tep_not_null($categories)) {
         $result2_query_raw = "select pd.products_name, p.products_price, p.products_id, 'N' AS group_price, p.products_tax_class_id, NULL AS specials_new_products_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS . " p where pd.products_id=p.products_id and pd.language_id = " .(int)$languages_id . $man_filter . " order by pd.products_name asc ";	
       } else {
         $result2_query_raw = "select pd.products_name, p.products_price, p.products_id, ptc.categories_id, 'N' AS group_price, p.products_tax_class_id, NULL AS specials_new_products_price from " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_PRODUCTS_TO_CATEGORIES . 
                          " ptc, " . TABLE_PRODUCTS . " p where pd.products_id=ptc.products_id and p.products_id=ptc.products_id 
               and ptc.categories_id = '" . $categories . "' and pd.language_id = " .(int)$languages_id . $man_filter . " order by pd.products_name asc ";
       } // end if (tep_not_null($categories) && !tep_not_null($manufacturer))
   
       $result2_split = new splitPageResults($this_page, MAX_DISPLAY_SEARCH_RESULTS, $result2_query_raw,  $result2_query_numrows);
       $result2_query = tep_db_query($result2_query_raw);
    
       if (tep_db_num_rows($result2_query) > 0) { // only continue when there are products in this category ?>
       
        <tr>
          <td valign="top"> 
          <form action="<?php echo $current_page . '?categories=' . $categories . '&amp;manufacturer=' . $manufacturer . '&amp;message=submitted'; ?>" method="POST">
            <table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" valign="bottom"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_PRODUCTS_PRICE; ?></td>
                <td class="dataTableHeadingContent" align="left"><?php echo TABLE_HEADING_SPECIAL_PRICE; ?></td>
	            <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_GROUP_PRICE; ?></td>
                <td class="dataTableHeadingContent" align="center" valign="bottom"><?php echo TABLE_HEADING_PCT_OFF; ?></td>
                <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_FULL_PRICE; ?></td>
                <td class="dataTableHeadingContent"></td>
              </tr>
       
       <?php
       while ( $_row = tep_db_fetch_array($result2_query) ) {
         $row[] = $_row;
         $product_ids[] = $_row['products_id'];
       } // end while ( $_row = tep_db_fetch_array($result2) )
  
       // now get the group prices if necessary
       if ($customers_group != '0') {
	     $cg_prices_query = tep_db_query("select customers_group_price, products_id from " . TABLE_PRODUCTS_GROUPS . " where customers_group_id = '" . $customers_group . "'");
         while ($cg_prices = tep_db_fetch_array($cg_prices_query)) {
	       for ($x = 0; $x < count($row); $x++) {
		     if ($row[$x]['products_id'] == $cg_prices['products_id']) {
			   $row[$x]['products_price'] = $cg_prices['customers_group_price'];
			   $row[$x]['group_price'] = "Y";
		     }
	       } // end for ($x = 0; $x < count($row); $x++)
         } // end while
       } // end if ($customers_group != '0')

      // now add the special prices for the customers_group
      $result3 = tep_db_query("SELECT * FROM " . TABLE_SPECIALS . " where products_id IN ('" . implode("','", $product_ids) . "') AND customers_group_id = '" . $customers_group . "' ");
      while ( $row2 = tep_db_fetch_array($result3) ) {
	    for ($x = 0; $x < count($row); $x++) {
		  if ($row[$x]['products_id'] == $row2['products_id']) {
		    $row[$x]['specials_new_products_price'] = $row2['specials_new_products_price'];
		  } // end if
	    } // end for ($x = 0; $x < count($row); $x++)
	  } // end while ( $row2 = tep_db_fetch_array($result3) )

      // Start Loop
	  $base = -1;
	  ?>
        
	  <?php	
      for ($x = 0; $x < count($row); $x++) {
	  $base++;
        if ( (!tep_not_null($row[$x]['specials_new_products_price'])) || ($row[$x]['products_price'] == -1) ) {
          $specialprice = "none";
          $implieddiscount = '';
        } else {
          $specialprice = $row[$x]['specials_new_products_price'];
          if ($row[$x]['products_price'] > 0) {
            $implieddiscount = number_format(((($specialprice / $row[$x]['products_price'])*100)-100), 2, '.', '');
	        if ((int)$implieddiscount == $implieddiscount) { // round ##.00 to ##
		      $implieddiscount = (int)$implieddiscount;
	        } // end if 
	        $implieddiscount = $implieddiscount . "%";
          } else {
        	$implieddiscount = '';
          } // end if ($row[$x]['products_price'] > 0)
        } // end else
        $tax_rate = tep_get_tax_rate($row[$x]['products_tax_class_id']);
        ?>
        
              <tr class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)">
                <td class="dataTableContent"><?php echo $row[$x]['products_name']; ?></td>
                <td class="dataTableContent"><?php echo $row[$x]['products_price']; ?></td>
                <td class="dataTableContent"><input name="master[<?php echo $base; ?>][inputspecialprice]" type="text" value="<?php echo $specialprice; ?>" size="10"></td>
                <td class="dataTableContent" align="center"><?php echo $row[$x]['group_price'];?> </td>
                <td class="dataTableContent" align="center"><?php echo $implieddiscount; ?></td>
                <td class="dataTableContent" align="center"><input type="checkbox" name="master[<?php echo $base; ?>][fullprice]" value="yes"></td>
                <td class="dataTableContent">
                  <input type="hidden" name="cg_id" value="<?php echo $customers_group; ?>">
                  <input type="hidden" name="master[<?php echo $base; ?>][categories]" value="<?php echo $categories; ?>">
                  <input type="hidden" name="master[<?php echo $base; ?>][productprice]" value="<?php echo $row[$x]['products_price']; ?>">
                  <input type="hidden" name="master[<?php echo $base; ?>][taxrate]" value="<?php echo $tax_rate; ?>">
                  <input type="hidden" name="master[<?php echo $base; ?>][manufacturers_id]" value="<?php echo $manufacturer; ?>">
                  <input type="hidden" name="page" value="<?php echo $this_page; ?>">
                  <input type="hidden" name="master[<?php echo $base; ?>][productid]" value="<?php echo $row[$x]['products_id']; ?>">
                  <input type="hidden" name="master[<?php echo $base; ?>][inputupdate]" value="yes">
                </td>
              </tr>
              
              <?php
      } // end for ($x = 0; $x < count($row); $x++)
	          ?>
      
              <tr>
                <td colspan="7">
                  <table border="0" width="100%" cellpadding="0" cellspacing="2">
                    <tr>
                      <td class="smallText" valign="top"><?php echo $result2_split->display_count($result2_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $this_page, TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></td>
                      <td class="smallText" align="right"><?php echo $result2_split->display_links($result2_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $this_page, 'categories='.$categories.'&manufacturer='.$manufacturer.'&customers_group='.$customers_group.''); ?></td>
                    </tr>
                  </table>
                </td>
              </tr>
              <?php
              if ($base>=0) { ?>
              <tr>
                <td colspan="7" align="right"><input type="submit" name="submit" value="<?php echo TEXT_BUTTON_UPDATE; ?>"></td>
              </tr>
              <?php } ?>
              
  <?php  
  } else { // end if (tep_db_num_rows($result2_query) > 0) -- ie. no products to display ?>
  
        <tr>
          <td valign="top"><form action="<?php echo $current_page; ?>" method="POST">
            <table width="100%">
              <tr>
                <td class="messageStackAlert" align="center"><?php echo TEXT_NO_PRODUCTS_TO_SHOW; ?></td>
	          </tr>
  <?php
  } // end else
//} // end if (isset($_POST['top_button']) || (isset($_POST['inputupdate']) || isset($_GET['categories']))
?>
            </table> 
          </form>
          </td>
          
          <?php
		  $heading = array();
          $contents = array();
		  
		  $heading[] = array('text' => '<b>' . TEXT_HEADING_SPECIALS_BY_CAT . '</b>');
		  
		  $message = (isset($_GET['message']) ? $_GET['message'] : '');
		  if ($message <> '') {
		  $contents[] = array('text' => '<table width="100%"><tr><td class="messageStackSuccess">' . TEXT_SPECIALS_DONE . '</td></tr></table>');
		  }
		  
          $contents[] = array('text' => TEXT_INSTRUCT);
          ?>
          <td width="25%" valign="top">
		  <?php
		  $box = new box;
          echo $box->infoBox($heading, $contents);
          ?>
          </td>
        </tr>
      </table>
<!-- Code for Specials Admin ends here -->
    </td>
  </tr>
</table>
<!-- body_text_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->

</body>
</html>