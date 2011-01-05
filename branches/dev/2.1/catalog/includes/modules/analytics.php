<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

/*
==========================================================
	Include Google Analystics module for osCommerce
  	Added by  Clement Nicolaescu (http://www.osCoders.biz) 
	v. 1.0.0 - 2005/11/15
  
  Google Analytics Beta modification v 2.1.0 2008/01/15 by:
  Tomas Hesseling (www.boxershortz.nl) &
  Mathieu Burgerhout (www.seo-for-osc.com)
==========================================================	
*/

// ############## Google Analytics - start ###############

// Get order id
    $orders_query = tep_db_query("select orders_id from " . TABLE_ORDERS . " where customers_id = '" . (int)$customer_id . "' order by date_purchased desc limit 1");
    $orders = tep_db_fetch_array($orders_query);
	$order_id = $orders['orders_id'];

// Get order info for Analytics "Transaction line" (affiliation, city, state, country, total, tax and shipping)

// Set value for  "affiliation"

	$analytics_affiliation = '';


// Get info for "city", "state", "country"
    $orders_query = tep_db_query("select customers_city, customers_state, customers_country from " . TABLE_ORDERS . " where orders_id = '" . $order_id . "' AND customers_id = '" . (int)$customer_id . "'");
    $orders = tep_db_fetch_array($orders_query);

    $totals_query = tep_db_query("select value, class from " . TABLE_ORDERS_TOTAL . " where orders_id = '" . (int)$order_id . "' order by sort_order");
// Set values for "total", "tax" and "shipping"
    $analytics_total = '';
    $analytics_tax = '';
    $analytics_shipping = '';
    
     while ($totals = tep_db_fetch_array($totals_query)) {

        if ($totals['class'] == 'ot_total') {
$analytics_total = number_format($totals['value'], 2, '.', '');
$total_flag = 'true';
} else if ($totals['class'] == 'ot_tax') {
$analytics_tax = number_format($totals['value'], 2, '.', '');
$tax_flag = 'true';
} else if ($totals['class'] == 'ot_shipping') {
$analytics_shipping = number_format($totals['value'], 2, '.', '');
$shipping_flag = 'true';
}

     }

// Prepare the Analytics "Transaction line" string

	$transaction_string = '"' . $order_id . '"," ' . $analytics_affiliation . '","' . $analytics_total . '","' . $analytics_tax . '","' . $analytics_shipping . '","' . $orders['customers_city'] . '","' . $orders['customers_state'] . '","' . $orders['customers_country'] . '"';

// Get products info for Analytics "Item lines"

	$item_string = '';
    $items_query = tep_db_query("select products_id, products_model, products_name, final_price, products_tax, products_quantity from " . TABLE_ORDERS_PRODUCTS . " where orders_id = '" . $order_id . "' order by products_name");
    while ($items = tep_db_fetch_array($items_query)) {
		$category_query = tep_db_query("select p2c.categories_id, cd.categories_name from " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c, " . TABLE_CATEGORIES_DESCRIPTION . " cd where p2c.products_id = '" . $items['products_id'] . "' AND cd.categories_id = p2c.categories_id AND cd.language_id = '" . (int)$languages_id . "'");
		$category = tep_db_fetch_array($category_query);
		
	  $item_string .=  "pageTracker._addItem(\n\"" . $order_id . "\",\"" . $items['products_id'] . "\",\"" . $items['products_name'] . "\",\"" . $category['categories_name'] . "\",\"" . number_format(tep_add_tax($items['final_price'], $items['products_tax']), 2) . "\",\"" . $items['products_quantity'] . "\");\n";
    }

// ############## Google Analytics - end ###############

?>

pageTracker._addTrans(
	<?php echo $transaction_string; ?>

);

<?php echo $item_string; ?>


pageTracker._trackTrans();


