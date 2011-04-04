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

$contents = ( tep_admin_jqmenu(FILENAME_CONFIGURATION_GENERAL_SETTINGS, BOX_CONFIGURATION_GENERAL_SETTINGS, 'TOP', 'submenu') . '<ul>' .
                tep_admin_jqmenu(FILENAME_CONFIGURATION_GENERAL_SETTINGS, BOX_CONFIGURATION_MYSTORE, 'TOP') .
			    tep_admin_jqmenu(FILENAME_CONFIGURATION_MIN_VALUES, BOX_CONFIGURATION_MIN_VALUES, 'TOP') .
			    tep_admin_jqmenu(FILENAME_CONFIGURATION_MAX_VALUES, BOX_CONFIGURATION_MAX_VALUES, 'TOP') .
              '</ul>' .
			  tep_admin_jqmenu(FILENAME_CONFIGURATION_IMAGES, BOX_CONFIGURATION_IMAGES, 'TOP', 'submenu') . '<ul>' .
			    tep_admin_jqmenu(FILENAME_CONFIGURATION_IMAGES, BOX_CONFIGURATION_IMAGES, 'TOP') .
			    tep_admin_jqmenu(FILENAME_CONFIGURATION_MOPICS, BOX_CONFIGURATION_MOPICS, 'TOP') .
              '</ul>' .
			  tep_admin_jqmenu(FILENAME_CONFIGURATION_CUSTOMER_DETAILS, BOX_CONFIGURATION_CUSTOMER_DETAILS, 'TOP') .
			  tep_admin_jqmenu(FILENAME_CONFIGURATION_SHIPPING, BOX_CONFIGURATION_SHIPPING, 'TOP') .
			  tep_admin_jqmenu(FILENAME_CONFIGURATION_PRODUCT_LISTING, BOX_CONFIGURATION_PRODUCT_SETTINGS, 'TOP', 'submenu') . '<ul>' .
			    tep_admin_jqmenu(FILENAME_CONFIGURATION_PRODUCT_LISTING, BOX_CONFIGURATION_PRODUCT_LISTING, 'TOP') .
			    tep_admin_jqmenu(FILENAME_CONFIGURATION_PRODUCT_INFO, BOX_CONFIGURATION_PRODUCT_INFO, 'TOP') .
			    tep_admin_jqmenu(FILENAME_CONFIGURATION_PRODUCT_PRICE_BREAKS, BOX_CONFIGURATION_PRODUCT_PRICE_BREAKS, 'TOP') .
			    tep_admin_jqmenu(FILENAME_CONFIGURATION_STOCK, BOX_CONFIGURATION_STOCK, 'TOP') .
			    tep_admin_jqmenu(FILENAME_CONFIGURATION_DOWNLOAD, BOX_CONFIGURATION_DOWNLOAD, 'TOP') .
			    tep_admin_jqmenu(FILENAME_CONFIGURATION_PRINT, BOX_CONFIGURATION_PRINT, 'TOP') .
              '</ul>' .
			  tep_admin_jqmenu(FILENAME_CONFIGURATION_EMAIL, BOX_CONFIGURATION_EMAIL, 'TOP') .
			  tep_admin_jqmenu(FILENAME_CONFIGURATION_MC, BOX_CONFIGURATION_MC, 'TOP') .
			  tep_admin_jqmenu(FILENAME_CONFIGURATION_WYSIWYG, BOX_CONFIGURATION_WYSIWYG, 'TOP') .
			  tep_admin_jqmenu(FILENAME_CONFIGURATION_TEMPLATES, BOX_CONFIGURATION_TEMPLATES, 'TOP', 'submenu') . '<ul>' .
			    tep_admin_jqmenu(FILENAME_CONFIGURATION_TEMPLATES, BOX_CONFIGURATION_TEMPLATE_SETUP, 'TOP') . 
			    tep_admin_jqmenu(FILENAME_CONFIGURATION_PAGE_MODULES, BOX_CONFIGURATION_PAGE_MODULES, 'TOP') .
				tep_admin_jqmenu(FILENAME_HEADING_BOXES, BOX_HEADING_BOXES, 'TOP') .
				tep_admin_jqmenu(FILENAME_CONFIGURATION_INFO_PAGES, BOX_CONFIGURATION_INFO_PAGES, 'TOP') .
				tep_admin_jqmenu(FILENAME_CONFIGURATION_WELCOME, BOX_CONFIGURATION_WELCOME, 'TOP') .
				tep_admin_jqmenu(FILENAME_CONFIGURATION_OFS, BOX_CONFIGURATION_OFS, 'TOP') .
				tep_admin_jqmenu(FILENAME_CONFIGURATION_OPC, BOX_CONFIGURATION_OPC, 'TOP') .
				tep_admin_jqmenu(FILENAME_CONFIGURATION_SLIDESHOW, BOX_CONFIGURATION_SLIDESHOW, 'TOP', 'submenu') . '<ul>' .
				  tep_admin_jqmenu(FILENAME_CONFIGURATION_SLIDESHOW, BOX_CONFIGURATION_SLIDESHOW_SETTINGS, 'TOP') .
				  tep_admin_jqmenu(FILENAME_SLIDESHOW, BOX_TOOLS_SLIDESHOW, 'TOP') .
			    '</ul></li>' .
				tep_admin_jqmenu(FILENAME_CONFIGURATION_CORNER_BANNERS, BOX_CONFIGURATION_CORNER_BANNERS, 'TOP') .
				tep_admin_jqmenu(FILENAME_CONFIGURATION_CONTACT, BOX_CONFIGURATION_CONTACT, 'TOP') .
				tep_admin_jqmenu(FILENAME_CONFIGURATION_RECAPTCHA, BOX_CONFIGURATION_RECAPTCHA, 'TOP') .
				tep_admin_jqmenu(FILENAME_CONFIGURATION_NOTIFICATIONS, BOX_CONFIGURATION_NOTIFICATIONS, 'TOP') . 
              '</ul>' . 
			  tep_admin_jqmenu(FILENAME_CONFIGURATION_WISHLIST, BOX_CONFIGURATION_WISHLIST, 'TOP') . 
			  tep_admin_jqmenu(FILENAME_CONFIGURATION_AFFILIATE, BOX_CONFIGURATION_AFFILIATE, 'TOP') .
			  tep_admin_jqmenu(FILENAME_TOOLS_RECOVER_CART, BOX_TOOLS_RECOVER_CART, 'TOP') .  		  
			  tep_admin_jqmenu(FILENAME_ARTICLES_CONFIG, BOX_ARTICLES_CONFIG, 'TOP') . 
			  tep_admin_jqmenu(FILENAME_CONFIGURATION_SEO_URLS, BOX_CONFIGURATION_SEO, 'TOP', 'submenu') . '<ul>' .
			    tep_admin_jqmenu(FILENAME_CONFIGURATION_SEO_URLS, BOX_CONFIGURATION_SEO, 'TOP') .
			    tep_admin_jqmenu(FILENAME_CONFIGURATION_SEO_POPOUT, BOX_CONFIGURATION_SEO_POPOUT, 'TOP') .
              '</ul>' .
			  tep_admin_jqmenu(FILENAME_CONFIGURATION_EDITOR, BOX_CONFIGURATION_EDITOR, 'TOP') . 
			  tep_admin_jqmenu(FILENAME_CONFIGURATION_GOOGLE_ANALYTICS, BOX_CONFIGURATION_GOOGLE, 'TOP', 'submenu') . '<ul>' .
			    tep_admin_jqmenu(FILENAME_CONFIGURATION_GOOGLE_ANALYTICS, BOX_CONFIGURATION_GOOGLE_ANALYTICS, 'TOP') . 
 			    tep_admin_jqmenu(FILENAME_GOOGLE_SITEMAP, BOX_CONFIGURATION_GOOGLE_SITEMAP, 'TOP') .
              '<li><a href="' . tep_href_link(FILENAME_CONFIGURATION, 'gID=89', 'NONSSL') . '">' . BOX_CONFIGURATION_GOOGLE_MAPS . '</a></li>' .
            '</ul>');

print_r($contents);
?>
<!-- configuration_eof //-->