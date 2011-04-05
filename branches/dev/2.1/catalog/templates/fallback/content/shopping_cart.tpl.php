<?php
/*
$Id$

  osCmax e-Commerce
  http://www.osCmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

    echo tep_draw_form('cart_quantity', tep_href_link(FILENAME_SHOPPING_CART, 'action=update_product')); ?>
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td>
          <table border="0" width="100%" cellspacing="0" cellpadding="0">
            <tr>
              <td class="pageHeading"><?php if (BASKET_CART == 'cart') { echo HEADING_TITLE; } else { echo HEADING_TITLE_BASKET; } ?></td>
              <td class="pageHeading" align="right">&nbsp;</td>
            </tr>
          </table>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  if ($cart->count_contents() > 0) {
    $info_box_contents = array();
    $info_box_contents[0][] = array('align' => 'center',
                                    'params' => 'class="productListing-heading"',
                                    'text' => TABLE_HEADING_REMOVE);

    $info_box_contents[0][] = array('params' => 'class="productListing-heading"',
                                    'text' => TABLE_HEADING_PRODUCTS);

    $info_box_contents[0][] = array('align' => 'center',
                                    'params' => 'class="productListing-heading"',
                                    'text' => TABLE_HEADING_QUANTITY);

    $info_box_contents[0][] = array('align' => 'right',
                                    'params' => 'class="productListing-heading"',
                                    'text' => TABLE_HEADING_TOTAL);

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

      $info_box_contents[$cur_row][] = array('align' => 'center',
                                             'params' => 'class="productListing-data-list" valign="middle"',
                                             //  'text' => tep_draw_checkbox_field('cart_delete[]', $products[$i]['id']));
											 'text' => '<a href="' . tep_href_link(FILENAME_SHOPPING_CART, 'action=remove_product&products_id='.$products[$i]['id'].'', 'NONSSL').'">' . tep_image(DIR_WS_ICONS . 'basket_delete.png', IMAGE_BUTTON_REMOVE_PRODUCT, 16, 16) . '</a>');

      $products_name = '<table border="0" cellspacing="2" cellpadding="2">' .
                       '  <tr>' .
                       '    <td class="productListing-data-blank" align="center"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products[$i]['id']) . '">' . tep_image(DIR_WS_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR . $products[$i]['image'], $products[$i]['name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT) . '</a></td>' .
                       '    <td class="productListing-data-blank" valign="top"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products[$i]['id']) . '"><b>' . $products[$i]['name'] . '</b></a>';

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

          $products_name .= $stock_check;
        }
      }

      if (isset($products[$i]['attributes']) && is_array($products[$i]['attributes'])) {
        reset($products[$i]['attributes']);
        while (list($option, $value) = each($products[$i]['attributes'])) {
          $products_name .= '<br><small><i> - ' . $products[$i][$option]['products_options_name'] . ' ' . $products[$i][$option]['products_options_values_name'] . '</i></small>';
        }
      }

      $products_name .= '    </td>' .
                        '  </tr>' .
                        '</table>';

      $info_box_contents[$cur_row][] = array('params' => 'class="productListing-data-list"',
                                             'text' => $products_name);

      $info_box_contents[$cur_row][] = array('align' => 'center',
                                             'params' => 'class="productListing-data-list" valign="top"',
                                             'text' => tep_draw_input_field('cart_quantity[]', $products[$i]['quantity'], 'size="4" style="width:30px; text-align:center;" onblur="document.cart_quantity.submit();"') . tep_draw_hidden_field('products_id[]', $products[$i]['id']));

      $info_box_contents[$cur_row][] = array('align' => 'right',
                                             'params' => 'class="productListing-data-list" valign="top"',
                                             'text' => '<b>' . $currencies->display_price($products[$i]['final_price'], tep_get_tax_rate($products[$i]['tax_class_id']), $products[$i]['quantity']) . '</b>');
    }
?>
<?php
    if ($any_out_of_stock == 1) { 
      if (STOCK_ALLOW_CHECKOUT == 'true') {
?>
      <tr>
        <td class="messageStackAlert" align="center"><?php echo OUT_OF_STOCK_CAN_CHECKOUT; ?></td>
      </tr>
<?php
      } else {
?>
      <tr>
        <td class="messageStackWarning" align="center"><?php echo OUT_OF_STOCK_CANT_CHECKOUT; ?></td>
      </tr>
<?php
      } ?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php }
	
// BOF QPBPP for SPPC
    if ($messageStack->size('cart_notice') > 0) {
?>
      <tr>
        <td style="padding-top: 10px"><?php echo $messageStack->output('cart_notice'); ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      
<?php
      }
// EOF QPBPP for SPPC
?>
      <tr>
        <td class="infoBoxHeading">
<?php
    new productListingBoxList($info_box_contents);
?>
        </td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td align="right" class="main"><b><?php echo SUB_TITLE_SUB_TOTAL; ?> <?php echo $currencies->format($cart->show_total()); ?></b></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="productinfo_buttons">
          <table border="0" width="100%" cellspacing="1" cellpadding="2">
            <tr>
              <td>
                <table border="0" width="100%" cellspacing="0" cellpadding="2">
                  <tr>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                    <td class="main" align="left">
					<?php 
					if (BASKET_CART =='cart') { 
					  echo '<a href="' . tep_href_link(FILENAME_SHOPPING_CART, 'action=clear_cart', 'SSL') . '" onClick="var x=confirm(\'' . CLEAR_CART . '\'); if (x==false) { return false; }">' . tep_image_button('button_clear_cart.gif', IMAGE_CLEAR_CART); 
					} else {
					  echo '<a href="' . tep_href_link(FILENAME_SHOPPING_CART, 'action=clear_cart', 'SSL') . '" onClick="var x=confirm(\'' . CLEAR_CART . '\'); if (x==false) { return false; }">' . tep_image_button('button_clear_basket.gif', IMAGE_CLEAR_BASKET);	
					}
					?>
                    </a></td>

<?php
//BOF Bugfix #384
$back = sizeof($navigation->path)-2;
$count = count($products);
if( isset($products[$count-1]['id']) ) {
$continueButtonId = tep_get_product_path(str_replace(strstr($products[$count-1]['id'], '{'), '', $products[$count-1]['id']));
}
if( isset($continueButtonId) ) {
?>
                    <td align="center" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT, 'cPath=' . $continueButtonId) . '">' . tep_image_button('button_continue_shopping.gif', IMAGE_BUTTON_CONTINUE_SHOPPING) . '</a>'; ?></td>
<?php
// if (isset($navigation->path[$back])) { 
} elseif (isset($navigation->path[$back])) {
//
?>
                    <td align="center" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue_shopping.gif', IMAGE_BUTTON_CONTINUE_SHOPPING) . '</a>'; ?></td>
<?php
}
//EOF Bugfix #384
?>

                    <td class="main"><noscript><?php echo tep_image_submit('button_update_cart.gif', IMAGE_BUTTON_UPDATE_CART); ?></noscript></td>

                    <td align="right" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL') . '">' . tep_image_button('button_checkout.gif', IMAGE_BUTTON_CHECKOUT) . '</a>'; ?></td>
                    <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                  </tr>
                </table>
              </td>
            </tr>
          </table>
        </td>
      </tr>
<?php 
  //---PayPal WPP Modification START ---//
    tep_paypal_wpp_ep_button(FILENAME_SHOPPING_CART);
  //---PayPal WPP Modification END ---//
?>
    </form>
      <tr>
        <td>
<?php
          // *** BEGIN GOOGLE CHECKOUT ***
          if (defined('MODULE_PAYMENT_GOOGLECHECKOUT_STATUS') && MODULE_PAYMENT_GOOGLECHECKOUT_STATUS == 'True') {
            include_once('googlecheckout/gcheckout.php');
          }
          // *** END GOOGLE CHECKOUT ***
?>         
        </td>
      </tr>
    <form>  
<?php
    $initialize_checkout_methods = $payment_modules->checkout_initialization_method();

    if (!empty($initialize_checkout_methods)) {
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td align="right" class="main" style="padding-right: 50px;"><?php echo TEXT_ALTERNATIVE_CHECKOUT_METHODS; ?></td>
      </tr>
<?php
      reset($initialize_checkout_methods);
      while (list(, $value) = each($initialize_checkout_methods)) {
?>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td align="right" class="main"><?php echo $value; ?></td>
      </tr>
<?php
      }
    }
  } else {
?>
      <tr>
        <td align="center" class="main"><?php if (BASKET_CART == 'cart') { new infoBox(array(array('text' => TEXT_CART_EMPTY))); } else { new infoBox(array(array('text' => TEXT_CART_EMPTY_BASKET))); } ?></td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
      <tr>
        <td class="productinfo_buttons"><table border="0" width="100%" cellspacing="1" cellpadding="2">
          <tr>
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td align="right" class="main"><?php echo '<a href="' . tep_href_link(FILENAME_DEFAULT) . '">' . tep_image_button('button_continue.gif', IMAGE_BUTTON_CONTINUE) . '</a>'; ?></td>
                <td width="10"><?php echo tep_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
<?php
  }
?>
  </table>
  </form>