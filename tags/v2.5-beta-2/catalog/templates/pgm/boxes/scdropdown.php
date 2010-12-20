<?php
/*
$Id: shopping_cart.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.

?>

<?php if (!tep_session_is_registered('customer_id') && ENABLE_PAGE_CACHE == 'true' && class_exists('page_cache') ) {
      echo "<%CART_CACHE%>";
      } else {
?>
<!-- shopping_cart //-->
<?php

  $boxContent = '';
  
  $boxContent .='<table class="ddbasket" border="0" width="100%" cellspacing="0" cellpadding="0" ><tr><td colspan="5">' . tep_draw_separator('pixel_trans.gif', '100%', '8') . '</td></tr>';
  
  if ($cart->count_contents() > 0) {
    $products = $cart->get_products();
    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
      $boxContent .= '<tr><td width="8px">&nbsp;</td><td align="right" valign="top" class="infoBoxContents" width="28px">';

      if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        $boxContent .= '<span class="newItemInCart">';
      } else {
        $boxContent .= '<span class="infoBoxContents">';
      }

      $boxContent .= $products[$i]['quantity'] . '&nbsp;x&nbsp;</span></td><td valign="top" class="infoBoxContents" width="198px" style="text-align:left;"><a href="' . tep_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $products[$i]['id']) . '">';

      if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        $boxContent .= '<span class="newItemInCart">';
      } else {
        $boxContent .= '<span class="infoBoxContents">';
      }

      $boxContent .= $products[$i]['name'] . '</td><td class="smalltext" width="50px" align="right">' . $currencies->display_price($products[$i]['final_price'], tep_get_tax_rate($products[$i]['tax_class_id']), $products[$i]['quantity']) . '</span></a></td><td width="8px">&nbsp;</td></tr>';

      if ((tep_session_is_registered('new_products_id_in_cart')) && ($new_products_id_in_cart == $products[$i]['id'])) {
        tep_session_unregister('new_products_id_in_cart');
      }
    }
  } else {
    $boxContent .= '<tr><td width="8px">&nbsp;</td><td class="ddbasket">Your shopping basket is currently empty.</td><td width="8px">&nbsp;</td></tr><tr><td colspan="3">' . tep_draw_separator('pixel_trans.gif', '100%', '8') . '</td></tr>';
  }

  if ($cart->count_contents() > 0) {
    $boxContent .= tep_draw_separator();
    $boxContent .= '<tr><td>&nbsp;</td><td class="smalltext">&nbsp;</td>
<td class="smalltext"><b>TOTAL</b></td><td class="smalltext" align="right"><b>' . $currencies->format($cart->show_total()) . '</b></td>
<td>&nbsp;</td></tr>';

$boxContent .= '<tr><td bgcolor="#ffffff" >&nbsp;</td><td align="right" colspan="3" bgcolor="#bbbbbb"><a href="' . tep_href_link(FILENAME_CHECKOUT_SHIPPING, '') . '">' . tep_image(DIR_WS_TEMPLATES . 'images/checkout.png', '','','','name="checkout2"') . '</a></td><td bgcolor="#ffffff" >&nbsp;</td></tr> ';

$boxContent .= '<tr><td colspan="5">' . tep_draw_separator('pixel_trans.gif', '100%', '8') . '</td></tr></td></tr>';

}
 
 $boxContent .= '</table>'; 

echo $boxContent;
}
?>
<!-- shopping_cart_eof //-->