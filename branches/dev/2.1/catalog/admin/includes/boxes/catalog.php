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
  $contents = (                    tep_admin_jqmenu(FILENAME_CATEGORIES, BOX_CATALOG_CATEGORIES_PRODUCTS) .
                                   tep_admin_jqmenu(FILENAME_PRODUCTS_ATTRIBUTES, BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES) .
                                   tep_admin_jqmenu(FILENAME_MANUFACTURERS, BOX_CATALOG_MANUFACTURERS) .
                                   tep_admin_jqmenu(FILENAME_REVIEWS, BOX_CATALOG_REVIEWS) .
                                   tep_admin_jqmenu(FILENAME_SPECIALS, BOX_CATALOG_SPECIALS) .
                                   tep_admin_jqmenu(FILENAME_XSELL_PRODUCTS, BOX_CATALOG_XSELL_PRODUCTS) .
                                   tep_admin_jqmenu(FILENAME_EASYPOPULATE, BOX_CATALOG_EASYPOPULATE) .
                                   tep_admin_jqmenu(FILENAME_NEW_ATTRIBUTES, BOX_CATALOG_ATTRIBUTE_MANAGER) .
                                   tep_admin_jqmenu(FILENAME_PRODUCTS_EXPECTED, BOX_CATALOG_PRODUCTS_EXPECTED) .
								   tep_admin_jqmenu(FILENAME_FLASH_CAROUSEL, BOX_FLASH_CAROUSEL_PRODUCTS) .
// Added: info boxes
							'<li><a href="' . tep_href_link('#', 'NONSSL') . '">Define Pages</a><ul>' .
								   tep_admin_jqmenu(FILENAME_DEFINE_MAINPAGE, BOX_CATALOG_DEFINE_MAINPAGE) .
								   tep_admin_jqmenu(FILENAME_DEFINE_ABOUT, BOX_CATALOG_DEFINE_ABOUT) .
								   tep_admin_jqmenu(FILENAME_DEFINE_PRIVACY, BOX_CATALOG_DEFINE_PRIVACY) .
                                   tep_admin_jqmenu(FILENAME_DEFINE_CONDITIONS, BOX_CATALOG_DEFINE_CONDITIONS) .
                                   tep_admin_jqmenu(FILENAME_DEFINE_SHIPPING, BOX_CATALOG_DEFINE_SHIPPING) .
							'</ul></li>');
// EOF: MOD - Admin w/access levels

  print_r($contents);
?>
<!-- catalog_eof //-->