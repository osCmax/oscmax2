<?php
/*
  $Id: stats_customers.php,v 1.31 2003/06/29 22:50:52 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();
  
  require('common_reports.php');  //for session dates  
  
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<script language="javascript" src="includes/general.js"></script>
<script language="JavaScript" src="includes/javascript/spiffycal/spiffycal_v2_1.js"></script>
<link rel="stylesheet" type="text/css" href="includes/javascript/spiffycal/spiffycal_v2_1.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<div id="spiffycalendar" class="text"></div>
<script language="javascript"><!--
  var cal11 = new ctlSpiffyCalendarBox("cal11", "dailyreportform", "date1","btndate3","",scBTNMODE_CALBTN);
  cal11.readonly=true;
  cal11.displayLeft=true;
  // cal1.JStoRunOnSelect="document.dailyreportform.submit();";
  //cal1.JStoRunOnSelect="document.dailyreportform.action='<?php echo basename($_SERVER['PHP_SELF'])?>?date='+document.dailyreportform.reportdate.value; document.dailyreportform.submit();";
  cal11.useDateRange=true;
  cal11.setMinDate(2004,1,1);
  cal11.setMaxDate( <?php echo $cal1maxdate; ?> );

  var cal12 = new ctlSpiffyCalendarBox("cal12", "dailyreportform", "date2","btndate3","",scBTNMODE_CALBTN);
  cal12.readonly=true;
  cal12.displayLeft=true;
  // cal1.JStoRunOnSelect="document.dailyreportform.submit();";
  //cal1.JStoRunOnSelect="document.dailyreportform.action='<?php echo basename($_SERVER['PHP_SELF'])?>?date='+document.dailyreportform.reportdate.value; document.dailyreportform.submit();";
  cal12.useDateRange=true;
  cal12.setMinDate(2004,1,1);
  cal12.setMaxDate( <?php echo $cal1maxdate; ?> );
//--></script>
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
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo "Customer with no purchases from " . $date1 . " to ".$date2; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
		   <tr>
            <form method="GET" action=" <?php echo basename($_SERVER['PHP_SELF']) . '?date1=' . $date1.'&date2='.$date2; ?>" name="dailyreportform">
            <td class="main" colspan="2">
                
                <input type="hidden" name="action" value="dailyreportaction">
                <?php // <br>cal1 value:<script language="javascript">document.write( document.forms.dailyreportform.action);</script><br> ?>
                <?php echo 'Select Date '; ?>
                <script language="javascript">cal11.writeControl(); cal11.dateFormat="yyyy-MM-dd"; dailyreportform.date1.value="<?php echo $date1; ?>"</script> 
                 - to -
		        <script language="javascript">cal12.writeControl(); cal12.dateFormat="yyyy-MM-dd"; dailyreportform.date2.value="<?php echo $date2; ?>"</script>
		<input type="submit"></td>
                </form>
				
          </tr>
		  
		  
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="90%" cellspacing="0" cellpadding="2">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent"><?php echo 'No'; ?></td>
                <td class="dataTableHeadingContent"><?php echo Customers; ?></td>
				
				
                <td class="dataTableHeadingContent" align="center">
				 <?php echo 'Purchases'; ?>&nbsp;
				</td>
								
				 <td class="dataTableHeadingContent" align="right">
				 <?php echo 'Join date'; ?>&nbsp;
				 </td>
              </tr>
<?php

  if (isset($HTTP_GET_VARS['page']) && ($HTTP_GET_VARS['page'] > 1)) $rows = $HTTP_GET_VARS['page'] * MAX_DISPLAY_SEARCH_RESULTS - MAX_DISPLAY_SEARCH_RESULTS;
//  $customers_query_raw = "select c.customers_firstname, c.customers_lastname, count(o.orders_id) as ordersum from " . TABLE_CUSTOMERS . " c, " . TABLE_ORDERS . " o where c.customers_id = o.customers_id group by c.customers_firstname, c.customers_lastname order by ordersum DESC";  
  //$customers_query_raw = "select c.customers_firstname, c.customers_lastname, sum(op.products_quantity * op.final_price) as ordersum ,count(o.orders_id) as ordercnt  from " . TABLE_CUSTOMERS . " c, " . TABLE_ORDERS_PRODUCTS . " op, " . TABLE_ORDERS . " o where c.customers_id = o.customers_id and o.orders_id = op.orders_id group by c.customers_firstname, c.customers_lastname order by $ORDER_BY";
  $customers_query_raw ="select distinct(c.customers_id) from customers c , customers_info ci where c.customers_id=ci.customers_info_id  and c.customers_id not in ( select distinct(`customers_id`) from `orders`) and DATE(ci.customers_info_date_account_created)>=DATE(\"$date1%\") and DATE(ci.customers_info_date_account_created)<=DATE(\"$date2%\")";
  
  $customers_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_SEARCH_RESULTS, $customers_query_raw, $customers_query_numrows);


  $rows = 0;
  $customers_query = tep_db_query($customers_query_raw);
  while ($customers = tep_db_fetch_array($customers_query)) {
    $rows++;

    if (strlen($rows) < 2) {
      $rows = '0' . $rows;
    }
?>
              
              <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href='<?php echo tep_href_link(FILENAME_CUSTOMERS, 'search='. $customers['customers_id'], 'NONSSL'); ?>'">

                <td class="dataTableContent"><?php echo $rows; ?>.</td>
                <td class="dataTableContent"><?php echo '<a href="' . tep_href_link(FILENAME_CUSTOMERS, 'search=' . tep_customers_lname($customers['customers_id']), 'NONSSL') . '">' . tep_customers_name($customers['customers_id']) . '</a>'; ?></td>
                <td class="dataTableContent" align="center"><?php echo $currencies->format(0); ?>&nbsp;</td>
				 <td class="dataTableContent" align="right"><?php echo tep_date_short(tep_customers_join_date($customers['customers_id']));  ?>&nbsp;</td>
              </tr>
<?php
  }
?>
            </table></td>
          </tr>
          <tr>
            <td colspan="3"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td class="smallText" valign="top"><?php echo $customers_split->display_count($customers_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $HTTP_GET_VARS['page'], TEXT_DISPLAY_NUMBER_OF_CUSTOMERS); ?></td>
                <td class="smallText" align="right"><?php echo $customers_split->display_links($customers_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $HTTP_GET_VARS['page'], "date1={$_GET['date1']}&date2={$_GET['date2']}&sort={$_GET['sort']}"); ?>&nbsp;</td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
<!-- body_text_eof //-->
  </tr>
</table>

<?php  //// these functions only used by this program, left off by original author
function tep_customers_join_date($customers_id) {
    $customers = tep_db_query("select customers_info_date_account_created from " . TABLE_CUSTOMERS_INFO . " where customers_info_id = '" . (int)$customers_id . "'");
    $customers_values = tep_db_fetch_array($customers);

    return $customers_values['customers_info_date_account_created'];
}

function tep_customers_lname($customers_id) {
    $customers = tep_db_query("select customers_lastname from " . TABLE_CUSTOMERS . " where customers_id = '" . (int)$customers_id . "'");
    $customers_values = tep_db_fetch_array($customers);

    return $customers_values['customers_lastname'];
}

?>

<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
