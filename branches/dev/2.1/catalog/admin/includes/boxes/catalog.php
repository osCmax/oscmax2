<?php
/*
$Id: catalog.php 2009-11-14 19:38:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2009 osCMax, 2006 osCMax ,2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- catalog-->
<?php
  $contents = '';
  $contents = (                    tep_admin_jqmenu(FILENAME_CATEGORIES, BOX_CATALOG_CATEGORIES_PRODUCTS, TOP) .
                                   tep_admin_jqmenu(FILENAME_PRODUCTS_ATTRIBUTES, BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES, TOP) .
                                   tep_admin_jqmenu(FILENAME_MANUFACTURERS, BOX_CATALOG_MANUFACTURERS, TOP) .
                                   tep_admin_jqmenu(FILENAME_REVIEWS, BOX_CATALOG_REVIEWS, TOP) .
                                   tep_admin_jqmenu(FILENAME_SPECIALS, BOX_CATALOG_SPECIALS, TOP) .
                                   tep_admin_jqmenu(FILENAME_XSELL_PRODUCTS, BOX_CATALOG_XSELL_PRODUCTS, TOP) .
                                   tep_admin_jqmenu(FILENAME_EASYPOPULATE, BOX_CATALOG_EASYPOPULATE, TOP) .
								   tep_admin_jqmenu(FILENAME_FEEDMACHINE, BOX_CATALOG_FEEDMACHINE, TOP) .
                                   tep_admin_jqmenu(FILENAME_NEW_ATTRIBUTES, BOX_CATALOG_ATTRIBUTE_MANAGER, TOP) .
                                   tep_admin_jqmenu(FILENAME_PRODUCTS_EXPECTED, BOX_CATALOG_PRODUCTS_EXPECTED, TOP));
// EOF: MOD - Admin w/access levels

  print_r($contents);
?>
<!-- catalog_eof //-->