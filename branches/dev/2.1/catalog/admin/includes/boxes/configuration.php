<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

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

$contents = ('<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=1', 'NONSSL') . '">' . BOX_CONFIGURATION_GENERAL_SETTINGS . '</a><ul>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=1', 'NONSSL') . '">' . BOX_CONFIGURATION_MYSTORE . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=2', 'NONSSL') . '">' . BOX_CONFIGURATION_MIN_VALUES . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=3', 'NONSSL') . '">' . BOX_CONFIGURATION_MAX_VALUES . '</a></li>' .
              '</ul>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=4', 'NONSSL') . '">' . BOX_CONFIGURATION_IMAGES . '</a><ul>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=4', 'NONSSL') . '">' . BOX_CONFIGURATION_IMAGES . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=45', 'NONSSL') . '">' . BOX_CONFIGURATION_MOPICS . '</a></li>' .
              '</ul>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=5', 'NONSSL') . '">' . BOX_CONFIGURATION_CUSTOMER_DETAILS . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=7', 'NONSSL') . '">' . BOX_CONFIGURATION_SHIPPING . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=8', 'NONSSL') . '">' . BOX_CONFIGURATION_PRODUCT_SETTINGS . '</a><ul>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=8', 'NONSSL') . '">' . BOX_CONFIGURATION_PRODUCT_LISTING . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=50', 'NONSSL') . '">' . BOX_CONFIGURATION_PRODUCT_INFO . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=88', 'NONSSL') . '">' . BOX_CONFIGURATION_PRODUCT_PRICE_BREAKS . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=9', 'NONSSL') . '">' . BOX_CONFIGURATION_STOCK . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=13', 'NONSSL') . '">' . BOX_CONFIGURATION_DOWNLOAD . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=30', 'NONSSL') . '">' . BOX_CONFIGURATION_PRINT . '</a></li>' .
              '</ul>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=12', 'NONSSL') . '">' . BOX_CONFIGURATION_EMAIL . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=206', 'NONSSL') . '">' . BOX_CONFIGURATION_MC . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=25', 'NONSSL') . '">' . BOX_CONFIGURATION_WYSIWYG . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=201', 'NONSSL') . '">' . BOX_CONFIGURATION_TEMPLATES . '</a><ul>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=201', 'NONSSL') . '">' . BOX_CONFIGURATION_TEMPLATE_SETUP . '</a></li>' .
              '<li><a href="' . tep_href_link('page_modules_configuration.php?tID=1') . '">' . BOX_CONFIGURATION_PAGE_MODULES .'</a></li>' .
              '<li><a href="' . tep_href_link('infobox_configuration.php?gID=1', 'NONSSL') . '">' . BOX_HEADING_BOXES . '</a></li>' .
	          '<li><a href="' . tep_href_link(FILENAME_INFORMATION_MANAGER, 'gID=1') . '">' . BOX_CONFIGURATION_INFO_PAGES . '</a></li>' .
			  '<li><a href="' . tep_href_link(FILENAME_INFORMATION_MANAGER, 'gID=2') . '">' . BOX_CONFIGURATION_WELCOME . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=99', 'NONSSL') . '">' . BOX_CONFIGURATION_OFS . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=7575', 'NONSSL') . '">' . BOX_CONFIGURATION_OPC . '</a></li>' .
			  '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=205', 'NONSSL') . '">' . BOX_CONFIGURATION_CORNER_BANNERS . '</a></li>' .
		      '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=207', 'NONSSL') . '">' . BOX_CONFIGURATION_CONTACT . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=87', 'NONSSL') . '">' . BOX_CONFIGURATION_RECAPTCHA . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=203', 'NONSSL') . '">' . BOX_CONFIGURATION_NOTIFICATIONS . '</a></li>' .
			  '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=204', 'NONSSL')  . '">' . BOX_CONFIGURATION_SLIDESHOW . '</a><ul>' .
			     '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=204', 'NONSSL') . '">' . BOX_CONFIGURATION_SLIDESHOW_SETTINGS . '</a></li>' .
				 tep_admin_jqmenu(FILENAME_SLIDESHOW, BOX_TOOLS_SLIDESHOW, 'TOP') .
			  '</ul></li>' .
              '</ul>' .
              
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=65', 'NONSSL') . '">' . BOX_CONFIGURATION_WISHLIST . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=35', 'NONSSL') . '">' . BOX_CONFIGURATION_AFFILIATE . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=80', 'NONSSL') . '">' . BOX_TOOLS_RECOVER_CART . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=456', 'NONSSL') . '">' . BOX_ARTICLES_CONFIG . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=60', 'NONSSL') . '">' . BOX_CONFIGURATION_SEO . '</a><ul>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=60', 'NONSSL') . '">' . BOX_CONFIGURATION_SEO_URLS . '</a></li>' .
			  '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=86', 'NONSSL') . '">' . BOX_CONFIGURATION_SEO_POPOUT . '</a></li>' .
              '</ul>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=70', 'NONSSL') . '">' . BOX_CONFIGURATION_EDITOR . '</a></li>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=85', 'NONSSL') . '">' . BOX_CONFIGURATION_GOOGLE . '</a><ul>' .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=85', 'NONSSL') . '">' . BOX_CONFIGURATION_GOOGLE_ANALYTICS . '</a></li>' . 
			  tep_admin_jqmenu(FILENAME_GOOGLE_SITEMAP, BOX_CONFIGURATION_GOOGLE_SITEMAP, 'TOP') .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=89', 'NONSSL') . '">' . BOX_CONFIGURATION_GOOGLE_MAPS . '</a></li>' .
            '</ul>');

print_r($contents);
?>
<!-- configuration_eof //-->