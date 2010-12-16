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

$contents = ('<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=1', 'NONSSL') . '">General Settings</a><ul>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=1', 'NONSSL') . '">My Store</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=2', 'NONSSL') . '">Minimum Values</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=3', 'NONSSL') . '">Maximum Values</a></li>' .
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
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=88', 'NONSSL') . '">Product Price Breaks</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=9', 'NONSSL') . '">Stock</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=13', 'NONSSL') . '">Downloads</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=30', 'NONSSL') . '">Printable Catalog</a></li>' .
              '</ul>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=12', 'NONSSL') . '">Email Options</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=206', 'NONSSL') . '">MailChimp Newsletters</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=25', 'NONSSL') . '">CK Editor</a></li>' .
              '<li><a href="' . tep_href_link('#', 'NONSSL') . '">Templates</a><ul>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=201', 'NONSSL') . '">Template Setup</a></li>' .
              '<li><a href="' . tep_href_link('page_modules_configuration.php?tID=1') . '">Page Modules</a></li>' .
              '<li><a href="' . tep_href_link('infobox_configuration.php?gID=1', 'NONSSL') . '">Infoboxes</a></li>' .
	          '<li><a href="' . tep_href_link(FILENAME_INFORMATION_MANAGER, 'selected_box=information') . '">Information Pages</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=99', 'NONSSL') . '">Open Featured Sets</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=7575', 'NONSSL') . '">One Page Checkout</a></li>' .
			  '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=205', 'NONSSL') . '">Corner Banners</a></li>' .
		      '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=207', 'NONSSL') . '">Contact Us Form</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=87', 'NONSSL') . '">reCaptcha Form</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=203', 'NONSSL') . '">Notifications</a></li>' .
			  '<li><a href="' . tep_href_link('#', 'NONSSL') . '">Slideshow</a><ul>' .
			     '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=204', 'NONSSL') . '">Slideshow Settings</a></li>' .
				 tep_admin_jqmenu(FILENAME_SLIDESHOW, BOX_TOOLS_SLIDESHOW, 'TOP') .
			  '</ul></li>' .
              '</ul>' .
              
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=65', 'NONSSL') . '">Wish List Settings</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=35', 'NONSSL') . '">Affiliate Program</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=80', 'NONSSL') . '">Recover Cart Sales</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=456', 'NONSSL') . '">Article Configuration</a></li>' .
              '<li><a href="' . tep_href_link('#', 'NONSSL') . '">SEO</a><ul>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=60', 'NONSSL') . '">SEO URLs</a></li>' .
			  '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=86', 'NONSSL') . '">SEO Pop Out Menu</a></li>' .
              '</ul>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=70', 'NONSSL') . '">Order Editor</a></li>' .
              '<li><a href="' . tep_href_link('#', 'NONSSL') . '">Google</a><ul>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=85', 'NONSSL') . '">Google Analytics</a></li>' . 
			  tep_admin_jqmenu(FILENAME_GOOGLE_SITEMAP, BOX_GOOGLE_SITEMAP, 'TOP') .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=89', 'NONSSL') . '">Google Maps</a></li>' .
            '</ul>');

print_r($contents);
?>
<!-- configuration_eof //-->