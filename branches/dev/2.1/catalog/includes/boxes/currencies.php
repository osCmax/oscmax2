<?php
/*
$Id: currencies.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

// Most of this file is changed or moved to BTS - Basic Template System - format.

  if (substr(basename($PHP_SELF), 0, 8) != 'checkout') {
  	if (isset($currencies) && is_object($currencies)) {
?>
<!-- currencies //-->
<?php
    $boxHeading = BOX_HEADING_CURRENCIES;
    
	$corner_top_left = 'rounded';
    $corner_top_right = 'rounded';
    $corner_bottom_left = 'rounded';
    $corner_bottom_right = 'rounded'; 

	$boxContent_attributes = ' align="center"';
    $boxLink = '';
    $box_base_name = 'currencies'; // for easy unique box template setup (added BTSv1.2)
    $box_id = $box_base_name . 'Box';  // for CSS styling paulm (editted BTSv1.2)

    reset($currencies->currencies);
    $currencies_array = array();
    while (list($key, $value) = each($currencies->currencies)) {
      $currencies_array[] = array('id' => $key, 'text' => $value['title']);
    }

    $hidden_get_variables = '';
    reset($_GET);
    while (list($key, $value) = each($_GET)) {
      if ( ($key != 'currency') && ($key != tep_session_name()) && ($key != 'x') && ($key != 'y') ) {
        $hidden_get_variables .= tep_draw_hidden_field($key, $value);
      }
    }

    $boxContent = tep_draw_form('currencies', tep_href_link(basename($PHP_SELF), '', $request_type, false), 'get');
/*  deleted style for CSS layout paulm
    $boxContent .= tep_draw_pull_down_menu('currency', $currencies_array, $currency, 'onChange="this.form.submit();" style="width: 100%"');
*/
    $boxContent .= tep_draw_pull_down_menu('currency', $currencies_array, $currency, 'onChange="this.form.submit();" class="input-style"');
    $boxContent .= $hidden_get_variables;
    $boxContent .= tep_hide_session_id();
    $boxContent .= '</form>';


include (bts_select('boxes', $box_base_name)); // BTS 1.5

}
  $boxContent_attributes = '';
 }
?>
<!-- currencies eof//-->