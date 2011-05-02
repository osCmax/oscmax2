<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');
  
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();
  
  $action = (isset($_GET['action']) ? $_GET['action'] : '');
  
  switch($action) {
// reset the admin log
    case 'reset_products_ordered':
	  tep_db_query("update " . TABLE_PRODUCTS . " set products_ordered= '0'");
	  $messageStack->add_session('Best Products Purchased sucessfully reset to zero.', 'success');
	  tep_redirect(tep_href_link(FILENAME_STATS_PRODUCTS_PURCHASED));
      break;
  }
    
  if ($_GET['month'] == '') {
    $month = 0;
    $year = 0;
  } else {
    $month = $_GET['month'];
    $year = $_GET['year'];
  }
  
  if(tep_not_null($_GET['gross']))
  	$gross = $_GET['gross'];

  $months = array();
  $months[] = array('id' => 0, 'text' => TEXT_SELECT_MONTH);
  $months[] = array('id' => 1, 'text' => TEXT_JANUARY);
  $months[] = array('id' => 2, 'text' => TEXT_FEBRUARY);
  $months[] = array('id' => 3, 'text' => TEXT_MARCH);
  $months[] = array('id' => 4, 'text' => TEXT_APRIL);
  $months[] = array('id' => 5, 'text' => TEXT_MAY);
  $months[] = array('id' => 6, 'text' => TEXT_JUNE);
  $months[] = array('id' => 7, 'text' => TEXT_JULY);
  $months[] = array('id' => 8, 'text' => TEXT_AUGUST);
  $months[] = array('id' => 9, 'text' => TEXT_SEPTEMBER);
  $months[] = array('id' => 10, 'text' => TEXT_OCTOBER);
  $months[] = array('id' => 11, 'text' => TEXT_NOVEMBER);
  $months[] = array('id' => 12, 'text' => TEXT_DECEMBER);

  $years = array();
  $current_year = date("Y");
  $years[] = array('id' => 0, 'text' => TEXT_SELECT_YEAR);
  for ($i = 0; $i <= 10; $i++) {
	$years[] = array('id' => $current_year, 'text' => $current_year);
	$current_year--;
	$i++;
  }
  
  
  $max = (isset($_GET['max']) ? $_GET['max'] : MAX_DISPLAY_SEARCH_RESULTS);
  for ($i=1, $n=5; $i<$n; $i++) {		
    $max_display[] = array('id' => MAX_DISPLAY_SEARCH_RESULTS * $i, 'text' => MAX_DISPLAY_SEARCH_RESULTS * $i); 
  }	
  $max_display[] = array('id' => 1000000, 'text' => TEXT_SHOW_ALL);
  
  
  $status = (int)$_GET['status'];


  $statuses_query = tep_db_query("select * from orders_status where language_id = '" . (int)$languages_id . "' order by orders_status_id");
  $statuses = array();
  $statuses[] = array('id' => 0, 'text' => TEXT_ORDERS_STATUS);
  while ($st = tep_db_fetch_array($statuses_query)) {
     $statuses[] = array('id' => $st['orders_status_id'], 'text' => $st['orders_status_name']);
  }

  if (isset($_GET['keywords']) && $_GET['keywords'] != '') {
  	$keywords = trim($_GET['keywords']);
  }
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
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="<?php echo BOX_WIDTH; ?>" valign="top"><table border="0" width="<?php echo BOX_WIDTH; ?>" cellspacing="1" cellpadding="1" class="columnLeft">
<!-- left_navigation //-->
<?php require(DIR_WS_INCLUDES . 'column_left.php'); ?>
<!-- left_navigation_eof //-->
        </table></td>
<!-- body_text //-->
    <td width="100%" valign="top">
    <?php echo tep_draw_form('date_range', FILENAME_STATS_PRODUCTS_PURCHASED, '', 'get'); ?><?php echo tep_hide_session_id(); ?>
      <table border="0" width="100%" cellspacing="0" cellpadding="2">
        <tr>
          <td>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
                <td class="smallText" align="right">
                <?php 
				  echo ENTRY_DISPLAY . '&nbsp;' .tep_draw_pull_down_menu('max', $max_display, $max_results, 'onChange="this.form.submit();"') . '&nbsp;';
			      echo ENTRY_STATUS . '&nbsp;' . tep_draw_pull_down_menu('status', $statuses, $status, 'onchange=\'this.form.submit();\'') . '&nbsp;';
	              echo ENTRY_MONTH . '&nbsp;' . tep_draw_pull_down_menu('month', $months, $month, 'onchange=\'this.form.submit();\'') . '&nbsp;';
			      echo ENTRY_YEAR . '&nbsp;' . tep_draw_pull_down_menu('year', $years, $year, 'onchange=\'this.form.submit();\'') . '&nbsp;';
			     ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
	      <td>
		    <table border="0" align="right" cellspacing="0" cellpadding="2">
		      <tr>
			    <td class="smallText" valign="top">
<?php
	$manufacturers_query = tep_db_query("select manufacturers_id, manufacturers_name from " . TABLE_MANUFACTURERS . " order by manufacturers_name");
     $manufacturers_array = array();
	 $manufacturers_array[] = array('id' => '0', 'text' => TEXT_SELECT_MANUFACTURER);
      while ($manufacturers = tep_db_fetch_array($manufacturers_query)) {
        $manufacturers_name = $manufacturers['manufacturers_name'];
        $manufacturers_array[] = array('id' => $manufacturers['manufacturers_id'],
                                       'text' => $manufacturers_name);
	}    
	
	echo ENTRY_KEYWORDS . '&nbsp;&nbsp;' . tep_draw_input_field('keywords', $keywords, 'size="20"') . '</td><td>';
	echo '&nbsp;' . '<a href="javascript:document.forms[\'date_range\'].submit();">' . tep_image_button('button_search.gif', IMAGE_SEARCH) . '</a>&nbsp;';
	echo '<a href="' . tep_href_link(FILENAME_STATS_PRODUCTS_PURCHASED) . '">' . tep_image_button('button_reset.gif', IMAGE_RESET) . '</a>';
    
    $totalgross = 0;
	$totalquantity = 0;
?>
                </td>
	  	      </tr>
		    </table>
          </td>
	    </tr>
        <tr>
          <td>
            <table border="0" width="100%" cellspacing="0" cellpadding="0">
              <tr>
                <td valign="top">
                  <table border="0" width="100%" cellspacing="0" cellpadding="2">
                    <tr class="dataTableHeadingRow">
                      <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_NUMBER; ?></td>
                      <td class="dataTableHeadingContent"><?php echo tep_draw_pull_down_menu('manufacturers_id', $manufacturers_array, (isset($_GET['manufacturers_id']) ? $_GET['manufacturers_id'] : ''), 'onChange="this.form.submit();" size="1"') . '&nbsp;'; ?></td>
                      <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_PRODUCTS; ?></td>
                      <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_MODEL; ?></td>
                      <td class="dataTableHeadingContent" align="center"><?php echo TABLE_HEADING_PURCHASED; ?></td>
                      <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CUSTOMERS; ?></td>
                      <td class="dataTableHeadingContent" align="right"><?php echo tep_draw_checkbox_field('gross', $gross, '', '', ' onClick="document.forms[\'date_range\'].submit();"') . TABLE_HEADING_GROSS; ?></td>
                    </tr>      
                
<?php
	// generate query string
	$products_query_raw = "select o.customers_name, op.products_id, m.manufacturers_name, op.products_model, op.products_name, sum(op.products_quantity) as quantitysum, sum(op.products_price*op.products_quantity)as gross FROM " . TABLE_ORDERS . " as o, " . TABLE_ORDERS_PRODUCTS . " as op, " . TABLE_MANUFACTURERS . " as m, " . TABLE_PRODUCTS . " as p WHERE ";
	
	if($month > 0)
		$products_query_raw .= " month(o.date_purchased) = " . $month . " and ";
	
	if($year > 0)
		$products_query_raw .= " year(o.date_purchased) = " . $year . " and ";
	
	if($status > 0)
		$products_query_raw .= "o.orders_status = " . $status . " and ";
		
	$products_query_raw .= " o.orders_id = op.orders_id and op.products_id = p.products_id and p.manufacturers_id = m.manufacturers_id ";
	
	if (isset($_GET['manufacturers_id']) && $_GET['manufacturers_id'] > 0) {
		$products_query_raw .= " and p.manufacturers_id = " . $_GET['manufacturers_id'] . " ";
	}
	
	$products_query_raw .=(isset($keywords) ? " AND (op.products_name LIKE '%" . $keywords . "%' OR op.products_model LIKE '%" . $keywords . "%' OR manufacturers_name LIKE '%" . $keywords . "%' OR manufacturers_name LIKE '%" . $keywords . "%' OR o.customers_name LIKE '%" . $keywords . "%') " : '');
	
	$products_query_raw .= " GROUP BY op.products_id ORDER BY ";
	
	if ($gross == 'on') {
		$products_query_raw .= " gross DESC, ";
	} 
	$products_query_raw .= " quantitysum DESC";
	
	if (isset($_GET['manufacturers_id']) && $_GET['manufacturers_id'] > 0) {
		$products_query_raw .= " , op.products_model ";
	}
	
	$products_query_raw .= " LIMIT " . $max;
	// end of generate query string
		
  //echo $products_query_raw . '<br><br>';
  
  $rows = 0;
  $products_query = tep_db_query($products_query_raw);
  
  while ($products = tep_db_fetch_array($products_query)) {
    $rows ++;
    
    $totalgross = $totalgross + $products['gross']; 
    $totalquantity = $totalquantity + $products['quantitysum'];
	
    if (strlen($rows) < 2) {
     $rows = '0' . $rows;
    }
	
	// While running this query lets build a list of the customers who purchased the products for each product
	$customers_query_raw = "SELECT o.customers_id, o.orders_id, o.customers_name, count(o.customers_id) as multiorder, sum(op.products_quantity) as quantity FROM " . TABLE_ORDERS . " as o, " . TABLE_ORDERS_PRODUCTS . " as op WHERE o.orders_id = op.orders_id AND op.products_id = '" . $products['products_id'] . "' GROUP BY o.customers_id";
	$customers_query = tep_db_query($customers_query_raw);
    while ($customers = tep_db_fetch_array($customers_query)) {
	  $customers_string .= '(' . $customers['quantity'] . '): <a href="' . tep_href_link(FILENAME_CUSTOMERS, 'cID=' . $customers['customers_id']) .'">' . $customers['customers_name'] . '</a>';
	  
	  if ($customers['multiorder'] > 1) {
	    // More than one order of this product type - need another query to return the order numbers
	    $multi_order_query_raw = "SELECT o.orders_id FROM " . TABLE_ORDERS . " as o, " . TABLE_ORDERS_PRODUCTS . " as op WHERE o.orders_id = op.orders_id AND op.products_id = '" . $products['products_id'] . "' and o.customers_id ='" . $customers['customers_id'] . "'";
	    $multi_order_query = tep_db_query($multi_order_query_raw);
        while ($multi_order = tep_db_fetch_array($multi_order_query)) {	  
	      $customers_string .= ' <a href="' . tep_href_link(FILENAME_ORDERS, 'action=edit&amp;oID=' . $multi_order['orders_id']) . '">[' . $multi_order['orders_id'] . ']</a>';
		}
	  } else {
	  // There is only one just add the order number	  
	    $customers_string .= ' <a href="' . tep_href_link(FILENAME_ORDERS, 'action=edit&amp;oID=' . $customers['orders_id']) . '">[' . $customers['orders_id'] . ']</a>';
	  }
	  $customers_string .= '<br>'; 
	}
?>
                    <tr bgcolor="<?php echo ((++$cnt)%2 == 0) ? '#E0E0E0' : '#FFFFFF' ?>" id="defaultSelected" class="dataTableRow" onMouseOver="rowOverEffect(this)" onMouseOut="rowOutEffect(this)" valign="top">
                      <td class="dataTableContent">&nbsp;<?php echo $rows; ?>.</td>
			          <td class="dataTableContent"><?php echo $products['manufacturers_name']; ?>
                      <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_CATEGORIES, 'action=new_product_preview&read=only&pID=' . $products['products_id']) . '">' . $products['products_name'] . '</a>'; ?></td>
                      <td class="dataTableContent"><?php echo $products['products_model']; ?>
                      <td class="dataTableContent" align="center"><?php echo $products['quantitysum']; ?>&nbsp;</td>
                      <td class="dataTableContent"><?php echo $customers_string; ?></td>
                      <td class="dataTableContent" align="right"><?php echo sprintf('%01.2f', $products['gross']); ?>&nbsp;</td>
                    </tr>
<?php
   // Reset the customers string
   $customers_string = '';
   }
?>
                  <?php if ($totalquantity > 0) { ?>
                    <tr class="dataTableHeadingRow">
			          <td class="dataTableContent"></td>
			          <td class="dataTableContent"></td>
			          <td class="dataTableContent"></td>
			          <td class="dataTableContent"></td>
			          <td class="dataTableContent" align="center"><b><?php echo $totalquantity; ?></b>&nbsp;</td>
                      <td class="dataTableContent"></td>
			          <td class="dataTableContent" align="right"><b><?php echo TEXT_TOTAL . '&nbsp;' ?><?php echo $currencies->display_price($totalgross,'',1); ?></b>&nbsp;</td>
		 	        </tr> 
                  <?php } ?>
                  </table>
                </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>
      </form>
    </td>
  </tr>
</table></td>
<!-- body_text_eof //-->
  </tr>
</table>
<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
