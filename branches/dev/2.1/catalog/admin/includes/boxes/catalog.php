<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
?>
<!-- catalog-->
<?php
  $contents = '';
  $contents = (                    tep_admin_jqmenu(FILENAME_CATEGORIES, BOX_CATALOG_CATEGORIES_PRODUCTS, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_PRODUCTS_ATTRIBUTES, BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES, 'TOP') .
								   tep_admin_jqmenu(FILENAME_DISCOUNT_CATEGORIES, BOX_CATALOG_CATEGORIES_DISCOUNT_CATEGORIES, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_MANUFACTURERS, BOX_CATALOG_MANUFACTURERS, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_REVIEWS, BOX_CATALOG_REVIEWS, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_SPECIALS, BOX_CATALOG_SPECIALS, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_SPECIALS_BY_CAT, BOX_CATALOG_SPECIALS_BY_CAT, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_XSELL_PRODUCTS, BOX_CATALOG_XSELL_PRODUCTS, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_EASYPOPULATE, BOX_CATALOG_EASYPOPULATE, 'TOP') .
								   tep_admin_jqmenu(FILENAME_FEEDMACHINE, BOX_CATALOG_FEEDMACHINE, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_NEW_ATTRIBUTES, BOX_CATALOG_ATTRIBUTE_MANAGER, 'TOP') .
                                   tep_admin_jqmenu(FILENAME_PRODUCTS_EXPECTED, BOX_CATALOG_PRODUCTS_EXPECTED, 'TOP') . 
								   tep_admin_jqmenu(FILENAME_EXTRA_FIELDS, BOX_CATALOG_PRODUCTS_EXTRA_FIELDS, 'TOP') . 
								   tep_admin_jqmenu(FILENAME_EXTRA_VALUES, BOX_CATALOG_PRODUCTS_EXTRA_VALUES, 'TOP'));
// EOF: MOD - Admin w/access levels

  print_r($contents);
?>
<!-- catalog_eof //-->