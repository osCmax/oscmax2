<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<!-- modules -->
<?php
$contents = '';

    $contents = (				   '<li><a href="' . tep_href_link(FILENAME_MODULES, 'set=payment', 'NONSSL') . '">' . BOX_MODULES_PAYMENT . '</a></li>' .
                                   '<li><a href="' . tep_href_link(FILENAME_MODULES, 'set=shipping', 'NONSSL') . '">' . BOX_MODULES_SHIPPING . '</a></li>' .
                                   '<li><a href="' . tep_href_link(FILENAME_MODULES, 'set=ordertotal', 'NONSSL') . '">' . BOX_MODULES_ORDER_TOTAL . '</a></li>');
  print_r($contents);
?>
<!-- modules_eof //-->