<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

class paypal_ipn_cart {
  function valid_payment(&$ipn,&$cart,$currency) {
    //check that there are the correct number of items in the transaction
    /*
    if ( $ipn->key['num_cart_items'] != $cart->count_contents() && $ipn->txn_type() == 'cart' ) {
      if ( $ipn->_debug > 1 ) $ipn->send_email(CHECK_NUM_CART_CONTENTS,sprintf(CHECK_NUM_CART_CONTENTS_MSG,$ipn->key['num_cart_items'],$cart->count_contents()));
      return false;
    }
    //check the payment_currency
    if( $ipn->key['mc_currency'] != $currency) {
      if ( $ipn->_debug > 1 ) $ipn->send_email(CHECK_CURRENCY,sprintf(CHECK_CURRENCY,$ipn->key['mc_currency'],$currency));
      return false;
    }
    //check the payment_amount
    if ( $ipn->key['mc_gross'] != $cart->show_total() ) {
      if ( $ipn->_debug > 1 ) $ipn->send_email(CHECK_TOTAL,sprintf(CHECK_TOTAL_MSG,$ipn->key['mc_gross'],$cart->show_total()));
      return false;
    }
    */
    return true;
  }
}//end class
?>
