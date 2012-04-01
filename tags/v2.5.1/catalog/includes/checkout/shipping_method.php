<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
  if (defined('MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING') && MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING == 'true') {
    $pass = false;
  
    switch (MODULE_ORDER_TOTAL_SHIPPING_DESTINATION) {
      case 'national':
        if ($order->delivery['country_id'] == STORE_COUNTRY) {
          $pass = true;
        }
        break;
      case 'international':
        if ($order->delivery['country_id'] != STORE_COUNTRY) {
          $pass = true;
        }
        break;
      case 'both':
        $pass = true;
        break;
    }
    // disable free shipping for Alaska and Hawaii
    $zone_code = tep_get_zone_code($order->delivery['country']['id'], $order->delivery['zone_id'], '');
    if(in_array($zone_code, array('AK', 'HI'))) {
      $pass = false;
    }
  
  
    $free_shipping = false;
    if ($pass == true && ($order->info['total'] - $order->info['shipping_cost']) >= MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER) {
      $free_shipping = true;
      //include(DIR_WS_LANGUAGES . $language . '/modules/order_total/ot_shipping.php');
    }
  } else {
    $free_shipping = false;
  }
  $quotes = $shipping_modules->quote();
  if ( !tep_session_is_registered('shipping') || ( tep_session_is_registered('shipping') && ($shipping == false) && (tep_count_shipping_modules() > 1) ) ){
    if (tep_session_is_registered('shipping')){
      tep_session_unregister('shipping');
    }
    tep_session_register('shipping');
    if($free_shipping == false)
      $shipping = $shipping_modules->cheapest();
    else
    {
      $shipping = array(
              'id' => 'free_free',
              'title' => FREE_SHIPPING_TITLE,
              'cost' => '0'
              );
    }
  }
?>
<table border="0" width="100%" cellspacing="0" cellpadding="2">
<?php
	if (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1) {
?>
 <tr>
  <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
  <td class="main" width="50%" valign="top"><?php echo TEXT_CHOOSE_SHIPPING_METHOD; ?></td>
  <td class="main" width="50%" valign="top" align="right"></td>
  <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
 </tr>
<?php
	} elseif ($free_shipping == false) {
?>
 <tr>
  <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
  <td class="main" width="100%" colspan="2"><?php echo TEXT_ENTER_SHIPPING_INFORMATION; ?></td>
  <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
 </tr>
<?php
	}

	if ($free_shipping == true) {
	  $checked = ($shipping['id'] == 'free_free'?true:false);
?>
 <tr>
  <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
  <td colspan="2" width="100%"><table border="0" width="100%" cellspacing="0" cellpadding="2">
    <tr>
	    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
	    <td class="main" colspan="3"><b><?php echo FREE_SHIPPING_TITLE; ?></b>&nbsp;<?php echo $quotes[$i]['icon']; ?></td>
	    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
    </tr>
    <tr class="moduleRow shippingRow<?php echo ($checked ? ' moduleRowSelected' : '');?>">
	    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
	    <td class="main" width="100%"><?php echo sprintf(FREE_SHIPPING_DESCRIPTION, $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)) //. tep_draw_hidden_field('shipping', 'free_free'); ?></td>
	    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
      <td><?php echo tep_draw_radio_field('shipping', 'free_free', $checked); ?></td>
      <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
    </tr>
  </table></td>
  <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
 </tr>
<?php
	} 
	if(sizeof($quotes) >= 1) {
		for ($i=0, $n=sizeof($quotes); $i<$n; $i++) {
			// start indvship
			if(($quotes[$i]['id']== 'indvship') && (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1)){
			echo '<tr><td>&nbsp;</td>
			<td colSpan="2" class="main">You have '.$shipping_modules->get_indvcount().' product with individual shipping total of '.$currencies->format($shipping_modules->get_shiptotal()).'. This total will be ADDED to the shipping method selected.</td><td>&nbsp;</td>
			</tr>';}
		};
// end indvship 
	  $radio_buttons = 0;
	  for ($i=0, $n=sizeof($quotes); $i<$n; $i++) {
		if(($quotes[$i]['id']== 'indvship') && (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1)){
			continue;
		};
?>
 <tr>
  <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
  <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
   <tr>
	<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
	<td class="main" colspan="3"><b><?php echo $quotes[$i]['module']; ?></b>&nbsp;<?php if (isset($quotes[$i]['icon']) && tep_not_null($quotes[$i]['icon'])) { echo $quotes[$i]['icon']; } ?></td>
	<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
   </tr>
<?php
		if (isset($quotes[$i]['error'])) {
?>
   <tr>
	<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
	<td class="main" colspan="3"><?php echo $quotes[$i]['error']; ?></td>
	<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
   </tr>
<?php
		} else {
		  for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++) {
// set the radio button to be checked if it is the method chosen
			$checked = ($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] == $shipping['id'] ? true : false);
?>
   <tr class="moduleRow shippingRow<?php echo ($checked ? ' moduleRowSelected' : '');?>">
	<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
	<td class="main" width="75%"><?php echo $quotes[$i]['methods'][$j]['title']; ?></td>
<?php
			if ( ($n > 1) || ($n2 > 1) ) {
?>
	<td class="main"><?php echo $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0))); ?></td>
	<td class="main" align="right"><?php echo tep_draw_radio_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'], $checked); ?></td>
<?php
			} else {
				if ($checked) {
				 	$shipping_actual_tax = $quotes[$i]['tax'] / 100;
				 	$shipping_tax = $shipping_actual_tax * $quotes[$i]['methods'][$j]['cost'];

				 	$shipping['cost'] = $quotes[$i]['methods'][$j]['cost'];
				 	$shipping['shipping_tax_total'] = $shipping_tax;
				 	if (isset($onepage['info']['shipping_method']['cost'])) {
				 		$onepage['info']['shipping_method']['cost'] =
						$quotes[$i]['methods'][$j]['cost'];
				    $onepage['info']['shipping_method']['shipping_tax_total'] =
						$shipping_tax;
				 	}
				}

?>
	<td class="main" align="right" colspan="2"><?php echo $currencies->format(tep_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])) . tep_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id']); ?></td>
<?php
			}
?>
	<td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
   </tr>
<?php
			$radio_buttons++;
		  }
		}
?>
  </table></td>
  <td><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
 </tr>
<?php
	  }
	}
?>
</table>