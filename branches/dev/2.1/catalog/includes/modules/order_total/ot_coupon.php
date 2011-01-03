<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

Released under the GNU General Public License
*/

class ot_coupon {
var $title, $output;

function ot_coupon() {

	$this->code = 'ot_coupon';
	$this->header = MODULE_ORDER_TOTAL_COUPON_HEADER;
	$this->title = MODULE_ORDER_TOTAL_COUPON_TITLE;
	$this->description = MODULE_ORDER_TOTAL_COUPON_DESCRIPTION;
	$this->user_prompt = '';
	$this->enabled = MODULE_ORDER_TOTAL_COUPON_STATUS;
	$this->sort_order = MODULE_ORDER_TOTAL_COUPON_SORT_ORDER;
	$this->include_shipping = MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING;
	$this->include_tax = MODULE_ORDER_TOTAL_COUPON_INC_TAX;
	$this->calculate_tax = MODULE_ORDER_TOTAL_COUPON_CALC_TAX;
	$this->tax_class = MODULE_ORDER_TOTAL_COUPON_TAX_CLASS;
	$this->credit_class = true;
	$this->output = array();

}

function process() {
global $PHP_SELF, $order, $currencies;


	$order_total=$this->get_order_total();
	$od_amount = $this->calculate_credit($order_total);
	$tod_amount = 0.0; //Fred
	$this->deduction = $od_amount;
	if ($this->calculate_tax != 'None') { //Fred - changed from 'none' to 'None'!
		$tod_amount = $this->calculate_tax_deduction($order_total, $this->deduction, $this->calculate_tax);
	}

	if ($od_amount > 0) {
		$order->info['total'] = $order->info['total'] - $od_amount;
		$this->output[] = array('title' => $this->title . ':' . $this->coupon_code .':','text' => '<b>-' . $currencies->format($od_amount) . '</b>', 'value' => $od_amount); //Fred added hyphen
	
	//New code for tax recalculation fix
        if ($tod_amount == 0 || $tod_amount == '') {
            $pct = $order->info['tax'] / $order->info['subtotal'];
            $order->info['tax'] = $order->info['tax'] - ($pct * $od_amount);
            foreach ($order->info['tax_groups'] as $key => $value) {
                $value = $value - ($pct * $od_amount);
                $order->info['tax_groups'][$key] = $value;
                $order->info['total'] -= ($pct * $od_amount);
            }
        }
//end new code
	
	}
}

function selection_test() {
	return false;
}


function pre_confirmation_check($order_total) {
global $customer_id;
	return $this->calculate_credit($order_total);
}

function use_credit_amount() {
	return $output_string;
}


function credit_selection() {
global $customer_id, $currencies, $language;
  // START Checkout Display Fix by BTBlomberg
  $selection_string  = '<tr><td></td><td>';		
  $selection_string .= tep_draw_form('checkout_payment_gift', tep_href_link(FILENAME_CHECKOUT_CONFIRMATION, '', 'SSL'), 'post');
  $selection_string .= '<table border="0" width="100%"><tr><td class="main" width="275">';
  $selection_string .= TEXT_ENTER_GV_CODE . tep_draw_input_field('gv_redeem_code', TEXT_GV_CODE_INPUT_DEFAULT) ;
  $selection_string .= '</td><td align="left">';
  $selection_string .= tep_image_submit('button_redeem.gif', IMAGE_REDEEM_VOUCHER, 'onclick="return submitFunction()"');
  $selection_string .= '</td></tr></table></form></td></tr>';
	// END Checkout Display Fix by BTBlomberg
	return $selection_string;
}


function collect_posts() {
// All tep_redirect URL parameters modified for this function in v5.13 by Rigadin
global $_POST, $customer_id, $currencies, $cc_id;
	if ($_POST['gv_redeem_code']) {

// get some info from the coupon table
	$coupon_query=tep_db_query("select coupon_id, coupon_amount, coupon_type, coupon_minimum_order,uses_per_coupon, uses_per_user, restrict_to_products,restrict_to_categories from " . TABLE_COUPONS . " where coupon_code='".$_POST['gv_redeem_code']."' and coupon_active='Y'");
	$coupon_result=tep_db_fetch_array($coupon_query);

	if ($coupon_result['coupon_type'] != 'G') {

		if (tep_db_num_rows($coupon_query)==0) {
			tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error='.$this->code.'&error=' . urlencode(ERROR_NO_INVALID_REDEEM_COUPON), 'SSL'));
		}

		$date_query=tep_db_query("select coupon_start_date from " . TABLE_COUPONS . " where coupon_start_date <= now() and coupon_code='".$_POST['gv_redeem_code']."'");

		if (tep_db_num_rows($date_query)==0) {
			tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error='.$this->code.'&error=' . urlencode(ERROR_INVALID_STARTDATE_COUPON), 'SSL'));
		}

		$date_query=tep_db_query("select coupon_expire_date from " . TABLE_COUPONS . " where coupon_expire_date >= now() and coupon_code='".$_POST['gv_redeem_code']."'");

    if (tep_db_num_rows($date_query)==0) {
			tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error='.$this->code.'&error=' . urlencode(ERROR_INVALID_FINISDATE_COUPON), 'SSL'));
		}

		$coupon_count = tep_db_query("select coupon_id from " . TABLE_COUPON_REDEEM_TRACK . " where coupon_id = '" . $coupon_result['coupon_id']."'");
		$coupon_count_customer = tep_db_query("select coupon_id from " . TABLE_COUPON_REDEEM_TRACK . " where coupon_id = '" . $coupon_result['coupon_id']."' and customer_id = '" . $customer_id . "'");

		if (tep_db_num_rows($coupon_count)>=$coupon_result['uses_per_coupon'] && $coupon_result['uses_per_coupon'] > 0) {
			tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error='.$this->code.'&error=' . urlencode(ERROR_INVALID_USES_COUPON . $coupon_result['uses_per_coupon'] . TIMES ), 'SSL'));
		}

		if (tep_db_num_rows($coupon_count_customer)>=$coupon_result['uses_per_user'] && $coupon_result['uses_per_user'] > 0) {
			tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error='.$this->code.'&error=' . urlencode(ERROR_INVALID_USES_USER_COUPON . $coupon_result['uses_per_user'] . TIMES ), 'SSL'));
		}
//**si** 09-11-05
/*
		if ($coupon_result['coupon_type']=='S') {
			$coupon_amount = $order->info['shipping_cost'];
		} else {
			$coupon_amount = $currencies->format($coupon_result['coupon_amount']) . ' ';
		}
		if ($coupon_result['coupon_type']=='P') $coupon_amount = $coupon_result['coupon_amount'] . '% ';
		if ($coupon_result['coupon_minimum_order']>0) $coupon_amount .= 'on orders greater than ' . $coupon_result['coupon_minimum_order'];
		if (!tep_session_is_registered('cc_id')) tep_session_register('cc_id'); //Fred - this was commented out before
		$cc_id = $coupon_result['coupon_id']; //Fred ADDED, set the global and session variable
    tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error='.$this->code.'&error=' . urlencode(ERROR_REDEEMED_AMOUNT), 'SSL')); // Added in v5.13a by Rigadin
*/
    global $order,$ot_coupon,$currency;
// BEGIN >>> CCVG 5.15 - Custom Modification - fix Coupon code redemption error
// Moved code up a few lines
    if (!tep_session_is_registered('cc_id')) tep_session_register('cc_id');
    $cc_id = $coupon_result['coupon_id'];
// END <<< CCVG 5.15 - Custom Modification - fix Coupon code redemption error

    $coupon_amount= tep_round($ot_coupon->pre_confirmation_check($order->info['subtotal']), $currencies->currencies[$currency]['decimal_places']); // $cc_id
/* you will need to uncomment this if your tax order total module is AFTER shipping eg you have all of your tax, including tax from shipping module, in your tax total.
    if ($coupon_result['coupon_type']=='S')  {
      //if not zero rated add vat to shipping
      $coupon_amount = tep_add_tax($coupon_amount, '17.5');
    }
*/
    $coupon_amount_out = $currencies->format($coupon_amount) . ' ';
    if ($coupon_result['coupon_minimum_order']>0) $coupon_amount_out .= 'on orders greater than ' . $currencies->format($coupon_result['coupon_minimum_order']);

    if (!tep_session_is_registered('cc_id')) tep_session_register('cc_id');
    $cc_id = $coupon_result['coupon_id'];

    if ( strlen($cc_id)>0 && $coupon_amount==0 ) {
// ccgv coupon restrictions error fix
//  $err_msg = ERROR_REDEEMED_AMOUNT.ERROR_REDEEMED_AMOUNT_ZERO;
    $err_msg = ERROR_REDEEMED_AMOUNT_ZERO;
	tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error='.$this->code.'&error=' . urlencode($err_msg), 'SSL'));
    } else {
      $err_msg = ERROR_REDEEMED_AMOUNT.$coupon_amount_out;
	  tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_success='.$this->code.'&error=' . urlencode($err_msg), 'SSL'));
    }
    
//**si** 09-11-05 end

    // $_SESSION['cc_id'] = $coupon_result['coupon_id']; //Fred commented out, do not use $_SESSION[] due to backward comp. Reference the global var instead.
    } // ENDIF valid coupon code
  } // ENDIF code entered
  // v5.13a If no code entered and coupon redeem button pressed, give an alarm
  if ($_POST['submit_redeem_coupon_x']) tep_redirect(tep_href_link(FILENAME_CHECKOUT_PAYMENT, 'payment_error='.$this->code.'&error=' . urlencode(ERROR_NO_REDEEM_CODE), 'SSL'));
}

function calculate_credit($amount) {
global $customer_id, $order, $cc_id;
//$cc_id = $_SESSION['cc_id']; //Fred commented out, do not use $_SESSION[] due to backward comp. Reference the global var instead.
	$od_amount = 0;
	if (isset($cc_id) ) {
		$coupon_query = tep_db_query("select coupon_code from " . TABLE_COUPONS . " where coupon_id = '" . $cc_id . "'");
		if (tep_db_num_rows($coupon_query) !=0 ) {
			$coupon_result = tep_db_fetch_array($coupon_query);
			$this->coupon_code = $coupon_result['coupon_code'];
			$coupon_get = tep_db_query("select coupon_amount, coupon_minimum_order, restrict_to_products, restrict_to_categories, coupon_type from " . TABLE_COUPONS ." where coupon_code = '". $coupon_result['coupon_code'] . "'");
			$get_result = tep_db_fetch_array($coupon_get);
			$c_deduct = $get_result['coupon_amount'];
			if ($get_result['coupon_type']=='S') $c_deduct = $order->info['shipping_cost'];
      if ($get_result['coupon_type']=='S' && $get_result['coupon_amount'] > 0 ) $c_deduct = $order->info['shipping_cost'] + $get_result['coupon_amount'];
			if ($get_result['coupon_minimum_order'] <= $this->get_order_total()) {
				if ($get_result['restrict_to_products'] || $get_result['restrict_to_categories']) {
					for ($i=0; $i<sizeof($order->products); $i++) {
						if ($get_result['restrict_to_products']) {
							$pr_ids = split("[,]", $get_result['restrict_to_products']);
							for ($ii = 0; $ii < count($pr_ids); $ii++) {
								if ($pr_ids[$ii] == tep_get_prid($order->products[$i]['id'])) {
									if ($get_result['coupon_type'] == 'P') {
											/* Fixes to Gift Voucher module 5.03
											=================================
											Submitted by Rob Cote, robc@traininghott.com

											original code: $od_amount = round($amount*10)/10*$c_deduct/100;
											$pr_c = $order->products[$i]['final_price']*$order->products[$i]['qty'];
											$pod_amount = round($pr_c*10)/10*$c_deduct/100;
											*/
											//$pr_c = $order->products[$i]['final_price']*$order->products[$i]['qty'];
											//$pr_c = $this->product_price($pr_ids[$ii]); //Fred 2003-10-28, fix for the row above, otherwise the discount is calc based on price excl VAT!
             									          $pr_c = ($order->products[$i]['final_price'] * $order->products[$i]['qty']);
											$pod_amount = round($pr_c*10)/10*$c_deduct/100;
											$od_amount = $od_amount + $pod_amount;
										} else {
											$od_amount = $c_deduct;
										}
									}
								}
							} else {
								$cat_ids = split("[,]", $get_result['restrict_to_categories']);
								for ($i=0; $i<sizeof($order->products); $i++) {
									$my_path = tep_get_product_path(tep_get_prid($order->products[$i]['id']));
									$sub_cat_ids = split("[_]", $my_path);
									for ($iii = 0; $iii < count($sub_cat_ids); $iii++) {
										for ($ii = 0; $ii < count($cat_ids); $ii++) {
											if ($sub_cat_ids[$iii] == $cat_ids[$ii]) {
												if ($get_result['coupon_type'] == 'P') {
													/* Category Restriction Fix to Gift Voucher module 5.04
													Date: August 3, 2003
													=================================
													Nick Stanko of UkiDev.com, nick@ukidev.com

													original code:
													$od_amount = round($amount*10)/10*$c_deduct/100;
													$pr_c = $order->products[$i]['final_price']*$order->products[$i]['qty'];
													$pod_amount = round($pr_c*10)/10*$c_deduct/100;
													*/
													//$od_amount = round($amount*10)/10*$c_deduct/100;
													//$pr_c = $order->products[$i]['final_price']*$order->products[$i]['qty'];
                          $pr_c = $this->product_price(tep_get_prid($order->products[$i]['id'])); //Fred 2003-10-28, fix for the row above, otherwise the discount is calc based on price excl VAT!
                          // Fix for bug that causes to deduct the coupon amount from the shipping costs.
                          $pr_c = $this->product_price($order->products[$i]['id']);
                          $pod_amount = round($pr_c*10)/10*$c_deduct/100;
                          $od_amount = $od_amount + $pod_amount;
                          continue 3;  // v5.13a Tanaka 2005-4-30: to prevent double counting of a product discount
                        } else {
                          $od_amount = $c_deduct;
                          continue 3;  // Tanaka 2005-4-30: to prevent double counting of a product discount
                        }
											}
										}
									}
								}
							}
						}
					} else {
						if ($get_result['coupon_type'] !='P') {
							$od_amount = $c_deduct;
						} else {
							$od_amount = $amount * $get_result['coupon_amount'] / 100;
						}
					}
				}
			}
		if ($od_amount>$amount) $od_amount = $amount;
		}
  return tep_round($od_amount,2);
}

function calculate_tax_deduction($amount, $od_amount, $method) {
global $customer_id, $order, $cc_id, $cart;
//$cc_id = $_SESSION['cc_id']; //Fred commented out, do not use $_SESSION[] due to backward comp. Reference the global var instead.
	$coupon_query = tep_db_query("select coupon_code from " . TABLE_COUPONS . " where coupon_id = '" . $cc_id . "'");
	if (tep_db_num_rows($coupon_query) !=0 ) {
		$coupon_result = tep_db_fetch_array($coupon_query);
		$coupon_get = tep_db_query("select coupon_amount, coupon_minimum_order, restrict_to_products, restrict_to_categories, coupon_type from " . TABLE_COUPONS . " where coupon_code = '". $coupon_result['coupon_code'] . "'");
		$get_result = tep_db_fetch_array($coupon_get);
		if ($get_result['coupon_type'] != 'S') {

			//RESTRICTION--------------------------------
			if ($get_result['restrict_to_products'] || $get_result['restrict_to_categories']) {
				// What to do here.
				// Loop through all products and build a list of all product_ids, price, tax class
				// at the same time create total net amount.
				// then
				// for percentage discounts. simply reduce tax group per product by discount percentage
				// or
				// for fixed payment amount
				// calculate ratio based on total net
				// for each product reduce tax group per product by ratio amount.
				$products = $cart->get_products();
				$valid_product = false;
				for ($i=0; $i<sizeof($products); $i++) {
				$valid_product = false;
					$t_prid = tep_get_prid($products[$i]['id']);
					$cc_query = tep_db_query("select products_tax_class_id from " . TABLE_PRODUCTS . " where products_id = '" . $t_prid . "'");
					$cc_result = tep_db_fetch_array($cc_query);
					if ($get_result['restrict_to_products']) {
						$pr_ids = split("[,]", $get_result['restrict_to_products']);
						for ($p = 0; $p < sizeof($pr_ids); $p++) {
							if ($pr_ids[$p] == $t_prid) $valid_product = true;
						}
					}
					if ($get_result['restrict_to_categories']) {
            // Tanaka 2005-4-30:  Original Code
            /*$cat_ids = split("[,]", $get_result['restrict_to_categories']);
            for ($c = 0; $c < sizeof($cat_ids); $c++) {
              // Tanaka 2005-4-30:  changed $products_id to $t_prid and changed $i to $c
              $cat_query = tep_db_query("select products_id from products_to_categories where products_id = '" . $t_prid . "' and categories_id = '" . $cat_ids[$c] . "'");
              if (tep_db_num_rows($cat_query) !=0 ) $valid_product = true;
            }*/
            // v5.13a Tanaka 2005-4-30:  New code, this correctly identifies valid products in subcategories
            $cat_ids = split("[,]", $get_result['restrict_to_categories']);
            $my_path = tep_get_product_path($t_prid);
            $sub_cat_ids = split("[_]", $my_path);
            for ($iii = 0; $iii < count($sub_cat_ids); $iii++) {
              for ($ii = 0; $ii < count($cat_ids); $ii++) {
                if ($sub_cat_ids[$iii] == $cat_ids[$ii]) {
                  $valid_product = true;
                  continue 2;
                }
              }
						}
					}
					if ($valid_product) {
						$price_excl_vat = $products[$i]['final_price'] * $products[$i]['quantity']; //Fred - added
						$price_incl_vat = $this->product_price($t_prid); //Fred - added
						$valid_array[] = array('product_id' => $t_prid, 'products_price' => $price_excl_vat, 'products_tax_class' => $cc_result['products_tax_class_id']); //jason //Fred - changed from $products[$i]['final_price'] 'products_tax_class' => $cc_result['products_tax_class_id']);
//						$total_price += $price_incl_vat; //Fred - changed
						$total_price += $price_excl_vat; // changed
					}
				}
				if (sizeof($valid_array) > 0) { // if ($valid_product) {
					if ($get_result['coupon_type'] == 'P') {
						$ratio = $get_result['coupon_amount']/100;
					} else {
						$ratio = $od_amount / $total_price;
					}
					if ($get_result['coupon_type'] == 'S') $ratio = 1;
					if ($method=='Credit Note') {
						$tax_rate = tep_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
						$tax_desc = tep_get_tax_description($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
						if ($get_result['coupon_type'] == 'P') {
							$tod_amount = $od_amount / (100 + $tax_rate)* $tax_rate;
						} else {
							$tod_amount = $order->info['tax_groups'][$tax_desc] * $od_amount/100;
						}
						$order->info['tax_groups'][$tax_desc] -= $tod_amount;
						$order->info['total'] -= $tod_amount; //  need to modify total ...OLD
						$order->info['tax'] -= $tod_amount; //Fred - added
					} else {
						for ($p=0; $p<sizeof($valid_array); $p++) {
							$tax_rate = tep_get_tax_rate($valid_array[$p]['products_tax_class'], $order->delivery['country']['id'], $order->delivery['zone_id']);
							$tax_desc = tep_get_tax_description($valid_array[$p]['products_tax_class'], $order->delivery['country']['id'], $order->delivery['zone_id']);
							if ($tax_rate > 0) {
								//Fred $tod_amount[$tax_desc] += ($valid_array[$p]['products_price'] * $tax_rate)/100 * $ratio; //OLD
								$tod_amount = ($valid_array[$p]['products_price'] * $tax_rate)/100 * $ratio; // calc total tax Fred - added
								$order->info['tax_groups'][$tax_desc] -= ($valid_array[$p]['products_price'] * $tax_rate)/100 * $ratio;
								$order->info['total'] -= ($valid_array[$p]['products_price'] * $tax_rate)/100 * $ratio; // adjust total
								$order->info['tax'] -= ($valid_array[$p]['products_price'] * $tax_rate)/100 * $ratio; // adjust tax -- Fred - added
							}
						}
					}
				}
				//NO RESTRICTION--------------------------------
			} else {
				if ($get_result['coupon_type'] =='F') {
					$tod_amount = 0;
					if ($method=='Credit Note') {
						$tax_rate = tep_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
						$tax_desc = tep_get_tax_description($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
						$tod_amount = $od_amount / (100 + $tax_rate)* $tax_rate;
						$order->info['tax_groups'][$tax_desc] -= $tod_amount;
					} else {
//						$ratio1 = $od_amount/$amount;   // this produces the wrong ratipo on fixed amounts
						reset($order->info['tax_groups']);
						while (list($key, $value) = each($order->info['tax_groups'])) {
							$ratio1 = $od_amount/($amount-$order->info['tax_groups'][$key]); ////debug
							$tax_rate = tep_get_tax_rate_from_desc($key);
							$net = $tax_rate * $order->info['tax_groups'][$key];
							if ($net>0) {
								$god_amount = $order->info['tax_groups'][$key] * $ratio1;
								$tod_amount += $god_amount;
								$order->info['tax_groups'][$key] = $order->info['tax_groups'][$key] - $god_amount;
							}
						}
					}
					$order->info['total'] -= $tod_amount; //OLD
					$order->info['tax'] -= $tod_amount; //Fred - added
			}
			if ($get_result['coupon_type'] =='P') {
				$tod_amount=0;
				if ($method=='Credit Note') {
					$tax_desc = tep_get_tax_description($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
					$tod_amount = $order->info['tax_groups'][$tax_desc] * $od_amount/100;
					$order->info['tax_groups'][$tax_desc] -= $tod_amount;
				} else {
					reset($order->info['tax_groups']);
					while (list($key, $value) = each($order->info['tax_groups'])) {
						$god_amount=0;
						$tax_rate = tep_get_tax_rate_from_desc($key);
						$net = $tax_rate * $order->info['tax_groups'][$key];
						if ($net>0) {
							$god_amount = $order->info['tax_groups'][$key] * $get_result['coupon_amount']/100;
							$tod_amount += $god_amount;
							$order->info['tax_groups'][$key] = $order->info['tax_groups'][$key] - $god_amount;
						}
					}
				}
				$order->info['total'] -= $tod_amount; // have to modify total also
				$order->info['tax'] -= $tod_amount;
			}
		}
	}
}
return $tod_amount;
}

  function update_credit_account($i, $order_id=0) {
	return false;
}

function apply_credit() {
global $insert_id, $customer_id, $REMOTE_ADDR, $cc_id;
	//$cc_id = $_SESSION['cc_id']; //Fred commented out, do not use $_SESSION[] due to backward comp. Reference the global var instead.
	if ($this->deduction !=0) {
		tep_db_query("insert into " . TABLE_COUPON_REDEEM_TRACK . " (coupon_id, redeem_date, redeem_ip, customer_id, order_id) values ('" . $cc_id . "', now(), '" . $REMOTE_ADDR . "', '" . $customer_id . "', '" . $insert_id . "')");
	}
	tep_session_unregister('cc_id');
}

function get_order_total() {
global $order, $cart, $customer_id, $cc_id;
	//$cc_id = $_SESSION['cc_id']; //Fred commented out, do not use $_SESSION[] due to backward comp. Reference the global var instead.
	$order_total = $order->info['total'];
	// Check if gift voucher is in cart and adjust total
	$products = $cart->get_products();
	for ($i=0; $i<sizeof($products); $i++) {
		$t_prid = tep_get_prid($products[$i]['id']);
		$gv_query = tep_db_query("select products_price, products_tax_class_id, products_model from " . TABLE_PRODUCTS . " where products_id = '" . $t_prid . "'");
		$gv_result = tep_db_fetch_array($gv_query);
		if (preg_match('/^GIFT/', addslashes($gv_result['products_model']))) {
			$qty = $cart->get_quantity($t_prid);
			$products_tax = tep_get_tax_rate($gv_result['products_tax_class_id']);
			if ($this->include_tax =='false') {
				$gv_amount = $gv_result['products_price'] * $qty;
			} else {
				$gv_amount = ($gv_result['products_price'] + tep_calculate_tax($gv_result['products_price'],$products_tax)) * $qty;
			}
			$order_total=$order_total - $gv_amount;
		}
	}
	if ($this->include_tax == 'false') $order_total=$order_total-$order->info['tax'];
	if ($this->include_shipping == 'false') $order_total=$order_total-$order->info['shipping_cost'];
	// OK thats fine for global coupons but what about restricted coupons
	// where you can only redeem against certain products/categories.
	// and I though this was going to be easy !!!
	$coupon_query=tep_db_query("select coupon_code from " . TABLE_COUPONS . " where coupon_id='".$cc_id."'");
	if (tep_db_num_rows($coupon_query) !=0) {
		$coupon_result=tep_db_fetch_array($coupon_query);
		$coupon_get=tep_db_query("select coupon_amount, coupon_minimum_order,restrict_to_products,restrict_to_categories, coupon_type from " . TABLE_COUPONS . " where coupon_code='".$coupon_result['coupon_code']."'");
		$get_result=tep_db_fetch_array($coupon_get);
		$in_cat = true;
		if ($get_result['restrict_to_categories']) {
			$cat_ids = split("[,]", $get_result['restrict_to_categories']);
			$in_cat=false;
			for ($i = 0; $i < count($cat_ids); $i++) {
				if (is_array($this->contents)) {
					reset($this->contents);
					while (list($products_id, ) = each($this->contents)) {
						$cat_query = tep_db_query("select products_id from products_to_categories where products_id = '" . $products_id . "' and categories_id = '" . $cat_ids[$i] . "'");
						if (tep_db_num_rows($cat_query) !=0 ) {
							$in_cat = true;
							$total_price += $this->get_product_price($products_id);
						}
					}
				}
			}
		}
		$in_cart = true;
		if ($get_result['restrict_to_products']) {

			$pr_ids = split("[,]", $get_result['restrict_to_products']);

			$in_cart=false;
			$products_array = $cart->get_products();

			for ($i = 0; $i < sizeof($pr_ids); $i++) {
				for ($ii = 1; $ii<=sizeof($products_array); $ii++) {
					if (tep_get_prid($products_array[$ii-1]['id']) == $pr_ids[$i]) {
						$in_cart=true;
						$total_price += $this->get_product_price($products_array[$ii-1]['id']);
					}
				}
			}
			$order_total = $total_price;
		}
	}
return $order_total;
}

function get_product_price($product_id) {
global $cart, $order;
	$products_id = tep_get_prid($product_id);
	// products price
	$qty = $cart->contents[$product_id]['qty'];
	$product_query = tep_db_query("select products_id, products_price, products_tax_class_id, products_weight from " . TABLE_PRODUCTS . " where products_id='" . $product_id . "'");
	if ($product = tep_db_fetch_array($product_query)) {
		$prid = $product['products_id'];
		$products_tax = tep_get_tax_rate($product['products_tax_class_id']);
		$products_price = $product['products_price'];
		$specials_query = tep_db_query("select specials_new_products_price from " . TABLE_SPECIALS . " where products_id = '" . $prid . "' and status = '1'");
		if (tep_db_num_rows ($specials_query)) {
			$specials = tep_db_fetch_array($specials_query);
			$products_price = $specials['specials_new_products_price'];
		}
		if ($this->include_tax == 'true') {
			$total_price += ($products_price + tep_calculate_tax($products_price, $products_tax)) * $qty;
//			echo("total price = " . $total_price . " products_price = " . $products_price . " products_tax = " . $products_tax . "<br>");

		} else {
			$total_price += $products_price * $qty;
		}

		// attributes price
		if (isset($cart->contents[$product_id]['attributes'])) {
			reset($cart->contents[$product_id]['attributes']);
			while (list($option, $value) = each($cart->contents[$product_id]['attributes'])) {
				$attribute_price_query = tep_db_query("select options_values_price, price_prefix from " . TABLE_PRODUCTS_ATTRIBUTES . " where products_id = '" . $prid . "' and options_id = '" . $option . "' and options_values_id = '" . $value . "'");
				$attribute_price = tep_db_fetch_array($attribute_price_query);
				if ($attribute_price['price_prefix'] == '+') {
					if ($this->include_tax == 'true') {
						$total_price += $qty * ($attribute_price['options_values_price'] + tep_calculate_tax($attribute_price['options_values_price'], $products_tax));
					} else {
						$total_price += $qty * ($attribute_price['options_values_price']);
					}
				} else {
					if ($this->include_tax == 'true') {
						$total_price -= $qty * ($attribute_price['options_values_price'] + tep_calculate_tax($attribute_price['options_values_price'], $products_tax));
					} else {
						$total_price -= $qty * ($attribute_price['options_values_price']);
					}
				}
			}
		}
	}
	if ($this->include_shipping == 'true') {

		$total_price += $order->info['shipping_cost'];
	}
	return $total_price;
}

//Added by Fred -- BOF -----------------------------------------------------
//JUST RETURN THE PRODUCT PRICE (INCL ATTRIBUTE PRICES) WITH OR WITHOUT TAX
function product_price($product_id) {
	$total_price = $this->get_product_price($product_id);
	if ($this->include_shipping == 'true') $total_price -= $order->info['shipping_cost'];
	return $total_price;
}
//Added by Fred -- EOF -----------------------------------------------------

// START added by Rigadin in v5.13, needed to show module errors on checkout_payment page
    function get_error() {
      global $_GET;

      $error = array('title' => MODULE_ORDER_TOTAL_COUPON_TEXT_ERROR,
                     'error' => stripslashes(urldecode($_GET['error'])));

      return $error;
    }
// END added by Rigadin

function check() {
	if (!isset($this->check)) {
		$check_query = tep_db_query("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_ORDER_TOTAL_COUPON_STATUS'");
		$this->check = tep_db_num_rows($check_query);
	}

	return $this->check;
}

function keys() {
	return array('MODULE_ORDER_TOTAL_COUPON_STATUS', 'MODULE_ORDER_TOTAL_COUPON_SORT_ORDER', 'MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING', 'MODULE_ORDER_TOTAL_COUPON_INC_TAX', 'MODULE_ORDER_TOTAL_COUPON_CALC_TAX', 'MODULE_ORDER_TOTAL_COUPON_TAX_CLASS');
}

function install() {
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Display Total', 'MODULE_ORDER_TOTAL_COUPON_STATUS', 'true', 'Do you want to display the Discount Coupon value?', '6', '1','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('Sort Order', 'MODULE_ORDER_TOTAL_COUPON_SORT_ORDER', '9', 'Sort order of display.', '6', '2', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Include Shipping', 'MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING', 'true', 'Include Shipping in calculation', '6', '5', 'tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Include Tax', 'MODULE_ORDER_TOTAL_COUPON_INC_TAX', 'true', 'Include Tax in calculation.', '6', '6','tep_cfg_select_option(array(\'true\', \'false\'), ', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function ,date_added) values ('Re-calculate Tax', 'MODULE_ORDER_TOTAL_COUPON_CALC_TAX', 'None', 'Re-Calculate Tax', '6', '7','tep_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'), ', now())");
	tep_db_query("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('Tax Class', 'MODULE_ORDER_TOTAL_COUPON_TAX_CLASS', '0', 'Use the following tax class when treating Discount Coupon as Credit Note.', '6', '0', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(', now())");
}

function remove() {
	$keys = '';
	$keys_array = $this->keys();
	for ($i=0; $i<sizeof($keys_array); $i++) {
		$keys .= "'" . $keys_array[$i] . "',";
	}
	$keys = substr($keys, 0, -1);

	tep_db_query("delete from " . TABLE_CONFIGURATION . " where configuration_key in (" . $keys . ")");
	}
}
?>
