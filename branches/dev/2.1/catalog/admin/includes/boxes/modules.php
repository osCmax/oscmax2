<?php
/*
$Id: administrator.php 2009-11-14 19:38:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2009 osCMax, 2006 osCMax ,2005 osCMax, 2002 osCommerce

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