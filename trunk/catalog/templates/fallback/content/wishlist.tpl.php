	  <table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td>
		  <table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading" colspan="3"><?php echo HEADING_TITLE; ?></td>
            <td class="pageHeading" align="right"><?php echo tep_image(DIR_WS_IMAGES . 'table_background_wishlist.gif', HEADING_TITLE, HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
          </table>
		</td>
      </tr>
      <tr>
        <td><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
<?php
  $wishlist_query_raw = "select * from " . TABLE_WISHLIST . " where customers_id = '" . $customer_id . "' order by products_name";
// $wishlist_split = new splitPageResults($HTTP_GET_VARS['page'], MAX_DISPLAY_WISHLIST_PRODUCTS, $wishlist_query_raw, $wishlist_numrows);
  $wishlist_split = new splitPageResults($wishlist_query_raw, MAX_DISPLAY_WISHLIST_PRODUCTS);
  $wishlist_query = tep_db_query($wishlist_split->sql_query);

?>
<!-- customer_wishlist //-->
<?php
    $info_box_contents = array();

  if (tep_db_num_rows($wishlist_query)) {
    $product_ids = '';
    while ($wishlist = tep_db_fetch_array($wishlist_query)) {
	      $product_ids .= $wishlist['products_id'] . ',';
    }
    $product_ids = substr($product_ids, 0, -1);
?>
<?php

//    $products_query = tep_db_query("select products_id, products_name from " . TABLE_PRODUCTS_DESCRIPTION . " where products_id in (" . $product_ids . ") and language_id = '" . $languages_id . "' order by products_name");
    $products_query = tep_db_query("select pd.products_id, pd.products_name, pd.products_description, p.products_image, p.products_price, p.products_tax_class_id from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id in (" . $product_ids . ") and p.products_id = pd.products_id and pd.language_id = '" . $languages_id . "' order by products_name");

// BOF PAGING_MOVED
	if ($wishlist_split > 0 && (PREV_NEXT_BAR_LOCATION == '1' || PREV_NEXT_BAR_LOCATION == '3')) {
?>
      <tr>
        <td>
		<table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
            <td class="smallText"><?php echo $wishlist_split->display_count(TEXT_DISPLAY_NUMBER_OF_WISHLIST); ?></td>
            <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $wishlist_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>
        </table>
		</td>
      </tr>

<?php
  }

?>
      <tr>
        <td colspan="4">
		<table border="0" width="100%" cellspacing="0" cellpadding="2">
			<tr>
             <?php  // Wish List 2.3 Start
            // Change line to avoid HTTP get vars ?>
            <td colspan="4"width="100%" valign="top"><?php echo tep_draw_form('cart_quantity', tep_href_link(FILENAME_WISHLIST)) . tep_draw_hidden_field('wishlist_action', 'add_delete_products_wishlist'); ?></td>
            <?php  // Wish List 2.3 End ?>
			</tr>
			<tr>
<?php // EOF PAGING_MOVED

    // Wish List 2.3 Start
    $row = 0;
    while ($products = tep_db_fetch_array($products_query)) {
    $row++;
	// Wish List 2.3 End
?>
			  <td valign="top" align="left" class="smallText">
                <a href="<?php echo tep_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . tep_get_product_path($products['products_id']) . '&products_id=' . $products['products_id'], 'NONSSL'); ?>"><?php echo tep_image(DIR_WS_IMAGES . $products['products_image'], $products['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT); ?></a><br>
              </td>
			  <td valign="top" align="left" class="smallText"><b><a href="<?php echo tep_href_link(FILENAME_PRODUCT_INFO, 'cPath=' . tep_get_product_path($products['products_id']) . '&products_id=' . $products['products_id'], 'NONSSL'); ?>"><?php echo $products['products_name']; ?></a></b></div>
                <?php
                  // Begin Wish List Code w/Attributes
                  $attributes_addon_price = 0;

                  // Now get and populate product attributes
                  if ($customer_id > 0) {
                       $wishlist_products_attributes_query = tep_db_query("select products_options_id as po, products_options_value_id as pov from " . TABLE_WISHLIST_ATTRIBUTES . " where customers_id='" . $customer_id . "' and products_id = '" . $products['products_id'] . "'");
                    while ($wishlist_products_attributes = tep_db_fetch_array($wishlist_products_attributes_query)) {
                      // We now populate $id[] hidden form field with product attributes
                      echo tep_draw_hidden_field('id['.$products['products_id'].']['.$wishlist_products_attributes['po'].']', $wishlist_products_attributes['pov']);
                      // And Output the appropriate attribute name
                      $attributes = tep_db_query("select popt.products_options_name, poval.products_options_values_name, pa.options_values_price, pa.price_prefix
                                      from " . TABLE_PRODUCTS_OPTIONS . " popt, " . TABLE_PRODUCTS_OPTIONS_VALUES . " poval, " . TABLE_PRODUCTS_ATTRIBUTES . " pa
                                      where pa.products_id = '" . $products['products_id'] . "'
                                       and pa.options_id = '" . $wishlist_products_attributes['po'] . "'
                                       and pa.options_id = popt.products_options_id
                                       and pa.options_values_id = '" . $wishlist_products_attributes['pov'] . "'
                                       and pa.options_values_id = poval.products_options_values_id
                                       and popt.language_id = '" . $languages_id . "'
                                       and poval.language_id = '" . $languages_id . "'");
                       $attributes_values = tep_db_fetch_array($attributes);
                       if ($attributes_values['price_prefix'] == '+')
                         { $attributes_addon_price += $attributes_values['options_values_price']; }
                       else if ($attributes_values['price_prefix'] == '-')
                         { $attributes_addon_price -= $attributes_values['options_values_price']; }
                       echo '<br><small><i> ' . $attributes_values['products_options_name'] . ' ' . $attributes_values['products_options_values_name'] . '</i></small>';
                    } // end while attributes for product

                    if ($new_price = tep_get_products_special_price($products['products_id'])) {
                       $products_price = '<s>' . $currencies->display_price($products['products_price']+$attributes_addon_price, tep_get_tax_rate($products['products_tax_class_id'])) . '</s> <span class="productSpecialPrice">' . $currencies->display_price($new_price+$attributes_addon_price, tep_get_tax_rate($products['products_tax_class_id'])) . '</span>';
                    } else {
                       $products_price = $currencies->display_price($products['products_price']+$attributes_addon_price, tep_get_tax_rate($products['products_tax_class_id']));
                    }

                  }
                ?>
                <?php
                echo tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5').'<br>';
                echo BOX_TEXT_PRICE . '&nbsp;' . $products_price. '<br>';
                // End Wish List Code w/Attributes
                ?>
                <br>
                <?php echo tep_draw_checkbox_field('add_wishprod[]',$products['products_id']); ?><br>
                        <?php echo tep_image(DIR_WS_IMAGES . 'pixel_trans.gif', '', '1', '5'); ?></td>
<?php
      if ((($row / 2) == floor($row / 2))) {
?>
  </tr>
  <tr>
<?php
      }
?>
<?php
    }
?>
	</tr>
  <tr>
    <td colspan="4"><?php echo tep_draw_separator('pixel_black.gif', '100%', '1'); ?></td>
  </tr>
	</table>
	</td>
</tr> <!-- Added by MTH -->
<tr>
<td colspan="2" class="main" align="left"><font color="BD1415"><?php echo '<b>'.BOX_TEXT_SELECT_PRODUCT.':</b><br></font>'.BOX_TEXT_MOVE_TO_CART.':' . tep_draw_radio_field('borrar', '0', 'checked') . BOX_TEXT_DELETE . tep_draw_radio_field('borrar', '1'); ?></font>
<br><?php echo tep_image_submit('button_continue.gif', IMAGE_BUTTON_CONTINUE); ?></form></td>
 </tr>
  <tr>
    <td colspan="4"><?php echo tep_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
  </tr>
	  <tr>
        <td colspan="4">
<!-- tell_a_friend //-->
<?php
    $info_box_contents = array();
    $info_box_contents[] = array('text' => BOX_HEADING_SEND_WISHLIST);

    new infoBoxHeading($info_box_contents, false, false);

    $info_box_contents = array();
    $info_box_contents[] = array('form' => tep_draw_form('tell_a_friend', tep_href_link(FILENAME_WISHLIST_SEND, '', 'NONSSL', false), 'get'),
                                                         'align' => 'center',
                                                         'text' => tep_draw_input_field('send_to', '', 'size="20"') . '&nbsp;' . tep_image_submit('button_tell_a_friend.gif', BOX_TEXT_SEND) . tep_draw_hidden_field('products_ids', $HTTP_GET_VARS['products_ids']) . tep_hide_session_id() . '<br>' . BOX_TEXT_SEND);

  new infoBox($info_box_contents);
?>
<!-- tell_a_friend_eof //-->
<?php
  if ($wishlist_split > 0 && (PREV_NEXT_BAR_LOCATION == '2' || PREV_NEXT_BAR_LOCATION == '3')) {
?>
		<table border="0" width="100%" cellspacing="0" cellpadding="2">
          <tr>
             <td class="smallText"><?php echo $wishlist_split->display_count(TEXT_DISPLAY_NUMBER_OF_WISHLIST); ?></td>
             <td align="right" class="smallText"><?php echo TEXT_RESULT_PAGE . ' ' . $wishlist_split->display_links(MAX_DISPLAY_PAGE_LINKS, tep_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
          </tr>

        </table></td>
      </tr>
<?php
  }
?>
<?php
	} else { // Nothing in the customers wishlist
?>
<tr><td>
    <table border="0" width="100%" cellspacing="0" cellpadding="0">
	  <tr>
		<td class="main"><?php echo BOX_TEXT_NO_ITEMS;?></td>
	  </tr>
	</table>
<?php
	}
?>
<!-- customer_wishlist_eof //-->
		</td>
      </tr>
    </table>
<!-- body_text_eof //-->
