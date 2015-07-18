<?php
/*
$Id: shopping_cart.tpl.php 1857 2012-06-20 01:21:38Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>

  <?php echo tep_draw_form('cart_quantity', tep_href_link(FILENAME_SHOPPING_CART, 'action=update_product'));
  if ($cart->count_contents() > 0) { ?>
    <div class="row">
        <div class="col-md-12">
        	<div class="panel panel-default">
  				<div class="panel-heading"><?php if (BASKET_CART == 'cart') { echo HEADING_TITLE; } else { echo HEADING_TITLE_BASKET; } ?></div>
                    <table class="table table-striped table-condensed table-hover">
                        <thead>
                            <tr>
                                <th class="text-center"><?php echo TABLE_HEADING_REMOVE; ?></th>
                                <th><?php echo TABLE_HEADING_PRODUCTS; ?></th>
                                <th class="text-center"><?php echo TABLE_HEADING_QUANTITY; ?></th>
                                <th class="text-center"><?php echo TABLE_HEADING_PRICE; ?></th>
                                <th class="text-center"><?php echo TABLE_HEADING_TOTAL; ?></th>
                            </tr>
                        </thead>
                        <tbody>

<?php
     
    $any_out_of_stock = 0;
    $products = $cart->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
// Push all attributes information in an array
      if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
        while (list($option, $value) = each($products[$i]['attributes'])) {
          echo tep_draw_hidden_field('id[' . $products[$i]['id'] . '][' . $option . ']', $value);
//++++ QT Pro: Begin Changed code
          $attributes = tep_db_query("select popt.products_options_name, popt.products_options_track_stock, poval.products_options_values_name, pa.options_values_price, pa.price_prefix							   
                                      from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                                      where pa.products_id = '" . (int)$products[$i]['id'] . "'
                                       and pa.options_id = '" . (int)$option . "'
                                       and pa.options_id = popt.products_options_id
                                       and pa.options_values_id = '" . (int)$value . "'
                                       and pa.options_values_id = poval.products_options_values_id
                                       and popt.language_id = '" . (int)$languages_id . "'
                                       and poval.language_id = '" . (int)$languages_id . "'");
          $attributes_values = tep_db_fetch_array($attributes);

          $products[$i][$option]['products_options_name'] = $attributes_values['products_options_name'];
          $products[$i][$option]['options_values_id'] = $value;
          $products[$i][$option]['products_options_values_name'] = $attributes_values['products_options_values_name'];
          $products[$i][$option]['options_values_price'] = $attributes_values['options_values_price'];
          $products[$i][$option]['price_prefix'] = $attributes_values['price_prefix'];
//++++ QT Pro: Begin Changed code
          $products[$i][$option]['track_stock'] = $attributes_values['products_options_track_stock'];
//++++ QT Pro: End Changed Code
        }
      }
    }

    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      if (($i/2) == floor($i/2)) {
        $info_box_contents[] = array('params' => 'class="productListing-even"');
      } else {
        $info_box_contents[] = array('params' => 'class="productListing-odd"');
      }

      $cur_row = sizeof($info_box_contents) - 1;
	  
	  $stock_check = '';
	  if (STOCK_CHECK == 'true') {
//++++ QT Pro: Begin Changed code
        if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
          $stock_check = tep_check_stock($products[$i]['id'], $products[$i]['quantity'], $products[$i]['attributes']); 
        } else {
          $stock_check = tep_check_stock($products[$i]['id'], $products[$i]['quantity']);
        }
//++++ QT Pro: End Changed Code
        if (tep_not_null($stock_check)) {
          $any_out_of_stock = 1;
        }
      }
	  
	  $attributes = '';
	  if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
        reset($products[$i]['attributes']);
        while (list($option, $value) = each($products[$i]['attributes'])) {
          $attributes .= '<h5 class="media-heading"> - ' . $products[$i][$option]['products_options_name'] . ' ' . $products[$i][$option]['products_options_values_name'] . '</h5>';
        }
      }

?>

							<tr>
                            	<td class="col-sm-1 col-md-1 text-center">
                                <?php echo tep_draw_button('Remove', 'glyphicon-remove', tep_href_link(FILENAME_SHOPPING_CART, 'action=remove_product&products_id='.$products[$i]['id'].'', 'NONSSL'),'','','btn-danger'); ?></td>
                                <td class="col-sm-8 col-md-6">
                                <div class="media">
                                    <a class="thumbnail pull-left" href="<?php echo tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products[$i]['id']); ?>" style="margin-bottom:0px;padding:5px;"><?php echo tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $products[$i]['image'], $products[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT); ?></a>
                                    <div class="media-body">
                                        <h4 class="media-heading"><?php echo '<a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products[$i]['id']) . '">' . $products[$i]['name'] . '</a> ' .$stock_check; ?></h4>
                                        <?php echo $attributes; ?>
                                        <span>Code: </span>model
                                    </div>
                                </div></td>
                                <td class="col-sm-2 col-md-2" style="text-align: center">
                                <div class="input-group">
                                  <span class="input-group-btn">
                                      <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]">
                                          +1
                                      </button>
                                  </span>
                                  <?php echo tep_draw_input_field('cart_quantity[]', $products[$i]['quantity'], 'size="4" class="form-control input-number" style="text-align:center;" onblur="document.cart_quantity.submit();"'); ?>
                                  <?php echo tep_draw_hidden_field('products_id[]', $products[$i]['id']); ?>
                                  <span class="input-group-btn">
                                      <button type="button" class="btn btn-danger btn-number"  data-type="minus" data-field="quant[2]">
                                        -1
                                      </button>
                                  </span>
                                </div>
                                  <?php
								  if (tep_not_null($stock_check)) {
								  	echo '<h5>Only ' . tep_get_products_stock($products[$i]['id']) . ' left</h5>';
                                  }
								  ?>
                                </td>
                                <td class="col-sm-1 col-md-1 text-center"><strong><?php echo $currencies->display_price($products[$i]['final_price'], tep_get_tax_rate($products[$i]['tax_class_id']), 1); ?></strong></td>
                                <td class="col-sm-1 col-md-1 text-center"><strong><?php echo $currencies->display_price($products[$i]['final_price'], tep_get_tax_rate($products[$i]['tax_class_id']), $products[$i]['quantity']); ?></strong></td>
                                
                            </tr>

<?php
    }
?>



<?php
    if ($any_out_of_stock == 1) { 
      if (STOCK_ALLOW_CHECKOUT == 'true') {
?>
      <tr>
        <td class="danger" colspan="5"><?php echo sprintf(OUT_OF_STOCK_CAN_CHECKOUT, STOCK_MARK_PRODUCT_OUT_OF_STOCK); ?></td>
      </tr>
<?php
      } else {
?>
      <tr>
        <td class="danger" colspan="5"><?php echo sprintf(OUT_OF_STOCK_CANT_CHECKOUT, STOCK_MARK_PRODUCT_OUT_OF_STOCK, STOCK_MARK_PRODUCT_OUT_OF_STOCK); ?></td>
      </tr>
<?php
      } ?>
<?php }


	
// BOF QPBPP for SPPC
    if ($messageStack->size('cart_notice') > 0) {
?>
      <tr>
        <td><?php echo $messageStack->output('cart_notice'); ?></td>
      </tr>
      
<?php
      }
// EOF QPBPP for SPPC
?>
      <tr>
        <td></td>
        <td></td>
        <td><h4><?php echo SUB_TITLE_SUB_TOTAL; ?></h4></td>
        <td></td>
		<td class="text-center"><h4><?php echo $currencies->format($cart->show_total(true)); ?></h4></td>
      </tr>
      
      </tbody>
    </table>
    <div class="panel-footer">

	  
	  <?php 
	  
					if (BASKET_CART =='cart') { 
	                    
					  echo '<a href="' . tep_href_link(FILENAME_SHOPPING_CART, 'action=clear_cart', 'SSL') . '" onClick="var x=confirm(\'' . CLEAR_CART . '\'); if (x==false) { return false; }">' . tep_image_button('button_clear_cart.gif', IMAGE_CLEAR_CART); 
					} else {
					  echo '<a href="' . tep_href_link(FILENAME_SHOPPING_CART, 'action=clear_cart', 'SSL') . '" onClick="var x=confirm(\'' . CLEAR_CART . '\'); if (x==false) { return false; }">' . tep_image_button('button_clear_basket.gif', IMAGE_CLEAR_BASKET);	
					}
					?>
 
 
 <?php
//BOF Bugfix #384
$back = sizeof($navigation->path)-2;
$count = count($products);
if( isset($products[$count-1]['id']) ) {
$continueButtonId = tep_get_product_path(str_replace(strstr($products[$count-1]['id'], '{'), '', $products[$count-1]['id']));
}
if( isset($continueButtonId) ) {
?>
                    <?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $continueButtonId) . '">' . tep_image_button('button_continue_shopping.gif', IMAGE_BUTTON_CONTINUE_SHOPPING) . '</a>'; ?>
<?php
// if (isset($navigation->path[$back])) { 
} elseif (isset($navigation->path[$back])) {
//
?>
                    <?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue_shopping.gif', IMAGE_BUTTON_CONTINUE_SHOPPING) . '</a>'; ?>
<?php
}
//EOF Bugfix #384
?>   
    
    <?php echo tep_image_submit('button_update_cart.gif', IMAGE_BUTTON_UPDATE_CART); ?>
    
    <?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . tep_image_button('button_checkout.gif', IMAGE_BUTTON_CHECKOUT) . '</a>'; ?>
    
    </div>
  </div>
    
<?php 
  //---PayPal WPP Modification START ---//
    tep_paypal_wpp_ep_button(FILENAME_SHOPPING_CART);
  //---PayPal WPP Modification END ---//
?>

<?php
          // *** BEGIN GOOGLE CHECKOUT ***
          if (defined('MODULE_PAYMENT_GOOGLECHECKOUT_STATUS') && MODULE_PAYMENT_GOOGLECHECKOUT_STATUS == 'True') {
            include_once('../../tab/content/googlecheckout/gcheckout.php');
          }
          // *** END GOOGLE CHECKOUT ***
?>         
 
<?php
    $initialize_checkout_methods = $payment_modules->checkout_initialization_method();

    if (!empty($initialize_checkout_methods)) {
?>

      <tr>
        <td align="right" class="main" style="padding-right: 50px;"><?php echo TEXT_ALTERNATIVE_CHECKOUT_METHODS; ?></td>
      </tr>
<?php
      reset($initialize_checkout_methods);
      while (list(, $value) = each($initialize_checkout_methods)) {
?>

      <tr>
        <td align="right" class="main"><?php echo $value; ?></td>
      </tr>
<?php
      }
    }
  } else {
?>


    <div class="row">
        <div class="col-md-12">
        	<div class="panel panel-default">
  				<div class="panel-heading"><?php if (BASKET_CART == 'cart') { echo HEADING_TITLE; } else { echo HEADING_TITLE_BASKET; } ?></div>
                <div class="panel-body">
    				<?php echo TEXT_CART_EMPTY; ?>
                    <span class="pull-right"><?php echo tep_draw_button(IMAGE_BUTTON_CONTINUE, 'glyphicon-chevron-right', tep_href_link(FILENAME_DEFAULT)); ?></span>
                </div>
            </div>
      	</div>
  	</div>

<?php
  }
?>
  </form>