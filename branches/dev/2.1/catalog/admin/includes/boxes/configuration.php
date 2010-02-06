<?php
/*
$Id: configuration.php 2009-11-14 19:38:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2009 osCMax, 2006 osCMax ,2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/
?>
<!-- configuration //-->
<?php
  $contents = '';

//    $cfg_groups = '';
//    $configuration_groups_query = tep_db_query("select configuration_group_id as cgID, configuration_group_title as cgTitle from " . TABLE_CONFIGURATION_GROUP . " where visible = '1' order by sort_order");
//    while ($configuration_groups = tep_db_fetch_array($configuration_groups_query)) {
//      $contents .= '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=' . $configuration_groups['cgID'], 'NONSSL') . '">' . $configuration_groups['cgTitle'] . '</a></li>';
//    }

  $contents = ( '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=1', 'NONSSL') . '">General Settings</a><ul>' .
			       '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=1', 'NONSSL') . '">My Store</a></li>' .
                   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=2', 'NONSSL') . '">Minimum Values</a></li>' .
                   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=3', 'NONSSL') . '">MaximumValues</a></li>' .
				   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=40', 'NONSSL') . '">Accounts</a></li>' .   
				   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=16', 'NONSSL') . '">Site Maintenance</a></li>' .
				'</ul>' .
				'<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=4', 'NONSSL') . '">Images</a><ul>' .
				   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=4', 'NONSSL') . '">Images</a></li>' .
				   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=45', 'NONSSL') . '">Dynamic Mopics</a></li>' .
				'</ul>' .
				'<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=5', 'NONSSL') . '">Customer Details</a></li>' .
				'<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=7', 'NONSSL') . '">Shipping / Packing</a></li>' .
				'<li><a href="' . tep_href_link('#', 'NONSSL') . '">Product Settings</a><ul>' .
				   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=8', 'NONSSL') . '">Product Listing</a></li>' .
                   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=50', 'NONSSL') . '">Product Information</a></li>' .
				   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=9', 'NONSSL') . '">Stock</a></li>' .
				   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=13', 'NONSSL') . '">Downloads</a></li>' .
				   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=30', 'NONSSL') . '">Printable Catalog</a></li>' .
				'</ul>' .
				'<li><a href="' . tep_href_link('#', 'NONSSL') . '">Logging / Cache</a><ul>' .
				   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=10', 'NONSSL') . '">Logging</a></li>' .
                   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=11', 'NONSSL') . '">Cache</a></li>' .
				   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=55', 'NONSSL') . '">Page Cache Settings</a></li>' .
				'</ul>' .
				'<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=12', 'NONSSL') . '">Email Options</a></li>' .
				'<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=14', 'NONSSL') . '">GZIP Compression</a></li>' .
				'<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=25', 'NONSSL') . '">FCK Editor</a></li>' .
				'<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=15', 'NONSSL') . '">Sessions</a></li>' .
				'<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=65', 'NONSSL') . '">Wish List Settings</a></li>' .
				'<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=35', 'NONSSL') . '">Affiliate Program</a></li>' .
				'<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=80', 'NONSSL') . '">Recover Cart Sales</a></li>' .
				'<li><a href="' . tep_href_link('#', 'NONSSL') . '">SEO</a><ul>' .
				   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=60', 'NONSSL') . '">SEO URLs</a></li>' .
                   '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=75', 'NONSSL') . '">SEO URL Validation</a></li>' .
				'</ul>' .   
				'<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=70', 'NONSSL') . '">Order Editor</a></li>' .
				'<li><a href="' . tep_href_link('#', 'NONSSL') . '">Google</a><ul>' .
					'<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=85', 'NONSSL') . '">Google Analytics</a></li>' .
				'</ul>' .
				'<li><a href="' . tep_href_link('#', 'NONSSL') . '">Define Pages</a><ul>' .
								   tep_admin_jqmenu(FILENAME_DEFINE_MAINPAGE, BOX_CATALOG_DEFINE_MAINPAGE, TOP) .
								   tep_admin_jqmenu(FILENAME_DEFINE_ABOUT, BOX_CATALOG_DEFINE_ABOUT, TOP) .
								   tep_admin_jqmenu(FILENAME_DEFINE_PRIVACY, BOX_CATALOG_DEFINE_PRIVACY, TOP) .
                                   tep_admin_jqmenu(FILENAME_DEFINE_CONDITIONS, BOX_CATALOG_DEFINE_CONDITIONS, TOP) .
                                   tep_admin_jqmenu(FILENAME_DEFINE_SHIPPING, BOX_CATALOG_DEFINE_SHIPPING, TOP) .
				'</ul></li>'
				);

  print_r($contents);
?>
<!-- configuration_eof //-->