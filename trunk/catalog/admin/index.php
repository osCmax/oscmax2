<?php
/*
$Id: index.php 14 2006-07-28 17:42:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

  require('includes/application_top.php');

  $cat = array(
               array('title' => BOX_HEADING_MY_ACCOUNT,
                     'access' => 'true',
                     'image' => 'my_account.gif',
                     'href' => tep_href_link(FILENAME_ADMIN_ACCOUNT),
                     'cols' => 1,
                     'children' => array(array('title' => HEADER_TITLE_ACCOUNT, 'link' => tep_href_link(FILENAME_ADMIN_ACCOUNT),
                                               'access' => 'true'),
                                         array('title' => HEADER_TITLE_LOGOFF, 'link' => tep_href_link(FILENAME_LOGOFF),
                                               'access' => 'true'))),

               array('title' => BOX_HEADING_CATALOG,
// Added line for Admin w/access levels
                     'access' => tep_admin_check_boxes('catalog.php'),
                     'image' => 'catalog.gif',
                     'href' => tep_href_link(FILENAME_CATEGORIES, 'selected_box=catalog'),
                     'cols' => 7,
                     'children' => array(array('title' => BOX_CATALOG_CATEGORIES_PRODUCTS, 'link' => tep_href_link(FILENAME_CATEGORIES, 'selected_box=catalog')),
                                         array('title' => BOX_CATALOG_CATEGORIES_PRODUCTS_ATTRIBUTES, 'link' => tep_href_link(FILENAME_PRODUCTS_ATTRIBUTES, 'selected_box=catalog')),
                                         array('title' => BOX_CATALOG_MANUFACTURERS, 'link' => tep_href_link(FILENAME_MANUFACTURERS, 'selected_box=catalog')),
                                         array('title' => BOX_CATALOG_REVIEWS, 'link' => tep_href_link(FILENAME_REVIEWS, 'selected_box=catalog')),
                                         array('title' => BOX_CATALOG_SPECIALS, 'link' => tep_href_link(FILENAME_SPECIALS, 'selected_box=catalog')),
                                         array('title' => BOX_CATALOG_PRODUCTS_EXPECTED, 'link' => tep_href_link(FILENAME_PRODUCTS_EXPECTED, 'selected_box=catalog')),
                                         array('title' => BOX_CATALOG_XSELL_PRODUCTS, 'link' => tep_href_link(FILENAME_XSELL_PRODUCTS, 'selected_box=catalog')),
                                         array('title' => BOX_CATALOG_EASYPOPULATE, 'link' => tep_href_link(FILENAME_EASYPOPULATE, 'selected_box=catalog')),
                                         array('title' => BOX_CATALOG_DEFINE_MAINPAGE, 'link' => tep_href_link(FILENAME_DEFINE_MAINPAGE, 'selected_box=catalog')),
                                         array('title' => BOX_CATALOG_DEFINE_CONDITIONS, 'link' => tep_href_link(FILENAME_DEFINE_CONDITIONS, 'selected_box=catalog')),
                                         array('title' => BOX_CATALOG_DEFINE_PRIVACY, 'link' => tep_href_link(FILENAME_DEFINE_PRIVACY, 'selected_box=catalog')),
                                         array('title' => BOX_CATALOG_DEFINE_SHIPPING, 'link' => tep_href_link(FILENAME_DEFINE_SHIPPING, 'selected_box=catalog')),
                                         array('title' => BOX_CATALOG_ATTRIBUTE_MANAGER, 'link' => tep_href_link(FILENAME_NEW_ATTRIBUTES, 'selected_box=catalog')),
                                         )),

               array('title' => BOX_HEADING_CUSTOMERS,
// Added line for Admin w/access levels
                     'access' => tep_admin_check_boxes('customers.php'),
                     'image' => 'customers.gif',
                     'href' => tep_href_link(FILENAME_CUSTOMERS, 'selected_box=customers'),
                     'cols' => 3,
                     'children' => array(array('title' => BOX_CUSTOMERS_CUSTOMERS, 'link' => tep_href_link(FILENAME_CUSTOMERS, 'selected_box=customers')),
                                         array('title' => BOX_CUSTOMERS_GROUPS, 'link' => tep_href_link(FILENAME_CUSTOMERS_GROUPS, 'selected_box=customers')),
                                         array('title' => BOX_MANUAL_ORDER_CREATE_ACCOUNT, 'link' => tep_href_link(FILENAME_CREATE_ACCOUNT, 'selected_box=customers')),
                                         array('title' => BOX_MANUAL_ORDER_CREATE_ORDER, 'link' => tep_href_link(FILENAME_CREATE_ORDER, 'selected_box=customers')),
                                         array('title' => BOX_CUSTOMERS_ORDERS, 'link' => tep_href_link(FILENAME_ORDERS, 'selected_box=customers')))),
               array('title' => BOX_HEADING_REPORTS,
// Added line for Admin w/access levels
                     'access' => tep_admin_check_boxes('reports.php'),
                     'image' => 'reports.gif',
                     'cols' => 3,
                     'href' => tep_href_link(FILENAME_STATS_PRODUCTS_PURCHASED, 'selected_box=reports'),
                     'children' => array(array('title' => BOX_REPORTS_PRODUCTS_VIEWED, 'link' => tep_href_link(FILENAME_STATS_PRODUCTS_VIEWED, 'selected_box=reports')),
                                         array('title' => BOX_REPORTS_PRODUCTS_PURCHASED, 'link' => tep_href_link(FILENAME_STATS_PRODUCTS_PURCHASED, 'selected_box=reports')),
                                         array('title' => BOX_REPORTS_MONTHLY_SALES, 'link' => tep_href_link(FILENAME_STATS_MONTHLY_SALES, 'selected_box=reports')),
                                         array('title' => BOX_REPORTS_RECOVER_CART_SALES, 'link' => tep_href_link(FILENAME_RECOVER_CART_SALES, 'selected_box=reports')),
                                         array('title' => BOX_SHIPPING_MANIFEST, 'link' => tep_href_link(FILENAME_SHIPPING_MANIFEST, 'selected_box=reports')),
                                         array('title' => BOX_REPORTS_ORDERS_TOTAL, 'link' => tep_href_link(FILENAME_STATS_CUSTOMERS, 'selected_box=reports')))),


               array('title' => BOX_HEADING_TOOLS,
// Added line for Admin w/access levels
                     'access' => tep_admin_check_boxes('tools.php'),
                     'image' => 'tools.gif',
                     'href' => tep_href_link(FILENAME_BACKUP, 'selected_box=tools'),
                     'cols' => 5,
                     'children' => array(array('title' => BOX_TOOLS_BACKUP, 'link' => tep_href_link(FILENAME_BACKUP, 'selected_box=tools')),
                                         array('title' => BOX_TOOLS_BATCH_CENTER, 'link' => tep_href_link(FILENAME_BATCH_PRINT, 'selected_box=tools')),
                                         array('title' => BOX_TOOLS_BANNER_MANAGER, 'link' => tep_href_link(FILENAME_BANNER_MANAGER, 'selected_box=tools')),
                                         array('title' => BOX_TOOLS_CACHE, 'link' => tep_href_link(FILENAME_CACHE, 'selected_box=tools')),
                                         array('title' => BOX_TOOLS_MAIL, 'link' => tep_href_link(FILENAME_MAIL, 'selected_box=tools')),
                                         array('title' => BOX_TOOLS_NEWSLETTER_MANAGER, 'link' => tep_href_link(FILENAME_NEWSLETTERS, 'selected_box=tools')),
                                         array('title' => BOX_TOOLS_SERVER_INFO, 'link' => tep_href_link(FILENAME_SERVER_INFO, 'selected_box=tools')),
                                         array('title' => BOX_TOOLS_WHOS_ONLINE, 'link' => tep_href_link(FILENAME_WHOS_ONLINE, 'selected_box=tools')))),
// BOF - Affiliate Mod
          		 array('title' => BOX_HEADING_AFFILIATE,
                     'image' => 'affiliate.gif',
                     'cols' => 4,
                     'href' => tep_href_link(FILENAME_AFFILIATE_SUMMARY, 'selected_box=affiliate'),
                     'children' => array(array('title' => BOX_AFFILIATE_SUMMARY, 'link' => tep_href_link(FILENAME_AFFILIATE_SUMMARY, 'selected_box=affiliate')),
                                         array('title' => BOX_AFFILIATE, 'link' => tep_href_link(FILENAME_AFFILIATE, 'selected_box=affiliate')),
                                         array('title' => BOX_AFFILIATE_PAYMENT, 'link' => tep_href_link(FILENAME_AFFILIATE_PAYMENT, 'selected_box=affiliate')),
                                         array('title' => BOX_AFFILIATE_SALES, 'link' => tep_href_link(FILENAME_AFFILIATE_SALES, 'selected_box=affiliate')),
                                         array('title' => BOX_AFFILIATE_CLICKS, 'link' => tep_href_link(FILENAME_AFFILIATE_CLICKS, 'selected_box=affiliate')),
                                         array('title' => BOX_AFFILIATE_BANNERS, 'link' => tep_href_link(FILENAME_AFFILIATE_BANNER_MANAGER, 'selected_box=affiliate')),
                                         array('title' => BOX_AFFILIATE_CONTACT, 'link' => tep_href_link(FILENAME_AFFILIATE_CONTACT, 'selected_box=affiliate')))),
// EOF - Affiliate Mod

// BOF - GV-ADMIN
               array('title' => BOX_HEADING_GV_ADMIN,
// Added line for Admin w/access levels
                     'access' => tep_admin_check_boxes('gv_admin.php'),
                     'image' => 'gift.gif',
                     'cols' => 2,
                     'href' => tep_href_link(FILENAME_COUPON_ADMIN, 'selected_box=gv_admin'),
                     'children' => array(array('title' => BOX_COUPON_ADMIN, 'link' => tep_href_link(FILENAME_COUPON_ADMIN, 'selected_box=gv_admin')),
                                         array('title' => BOX_GV_ADMIN_MAIL, 'link' => tep_href_link(FILENAME_GV_MAIL, 'selected_box=gv_admin')),
                                         array('title' => BOX_GV_ADMIN_QUEUE, 'link' => tep_href_link(FILENAME_GV_QUEUE, 'selected_box=gv_admin')),
                                         array('title' => BOX_GV_ADMIN_SENT, 'link' => tep_href_link(FILENAME_GV_SENT, 'selected_box=gv_admin')))),
// EOF - GV-ADMIN
               array('title' => BOX_HEADING_CONFIGURATION,
// Added line for Admin w/access levels
                     'access' => tep_admin_check_boxes('configuration.php'),
                     'image' => 'configuration.gif',
                     'href' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=1'),
                     'cols' => 14,
                     'children' => array(array('title' => BOX_CONFIGURATION_MYSTORE, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=1')),
                                         array('title' => BOX_CONFIGURATION_MIN_VALUES, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=2')),
                                         array('title' => BOX_CONFIGURATION_MAX_VALUES, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=3')),
                                         array('title' => BOX_CONFIGURATION_IMAGES, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=4')),
                                         array('title' => BOX_CONFIGURATION_CUSTOMER_DETAILS, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=5')),
                                         array('title' => BOX_CONFIGURATION_SHIPPING, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=7')),
                                         array('title' => BOX_CONFIGURATION_PRODUCT_LISTING, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=8')),
                                         array('title' => BOX_CONFIGURATION_PRODUCT_INFO, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=50')),
                                         array('title' => BOX_CONFIGURATION_STOCK, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=9')),
                                         array('title' => BOX_CONFIGURATION_LOGGING, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=10')),
                                         array('title' => BOX_CONFIGURATION_CACHE, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=11')),
                                         array('title' => BOX_CONFIGURATION_EMAIL, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=12')),
                                         array('title' => BOX_CONFIGURATION_DOWNLOAD, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=13')),
                                         array('title' => BOX_CONFIGURATION_GZIP, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=14')),
                                         array('title' => BOX_CONFIGURATION_SESSIONS, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=15')),
                                         array('title' => BOX_CONFIGURATION_WYSIWYG, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=25')),
                                         array('title' => BOX_CONFIGURATION_AFFILIATE, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=35')),
                                         array('title' => BOX_CONFIGURATION_ACCOUNTS, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=40')),
                                         array('title' => BOX_CONFIGURATION_MAINTENANCE, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=16')),
                                         array('title' => BOX_CONFIGURATION_PAGE_CACHE, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=55')),
                                         array('title' => BOX_CONFIGURATION_MOPICS, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=45')),
                                         array('title' => BOX_CONFIGURATION_PRINT, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=30')),
                                         array('title' => BOX_CONFIGURATION_SEO, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=60')),
                                         array('title' => BOX_CONFIGURATION_WISHLIST, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=65')),
                                         array('title' => BOX_CONFIGURATION_EDITOR, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=70')),
                                         array('title' => BOX_CONFIGURATION_SEO_VALIDATION, 'link' => tep_href_link(FILENAME_CONFIGURATION, 'selected_box=configuration&gID=75')))),

               array('title' => BOX_HEADING_LOCATION_AND_TAXES,
// Added line for Admin w/access levels
                     'access' => tep_admin_check_boxes('taxes.php'),
                     'image' => 'location.gif',
                     'href' => tep_href_link(FILENAME_COUNTRIES, 'selected_box=taxes'),
                     'children' => array(array('title' => BOX_TAXES_COUNTRIES, 'link' => tep_href_link(FILENAME_COUNTRIES, 'selected_box=taxes')),
                                         array('title' => BOX_TAXES_ZONES, 'link' => tep_href_link(FILENAME_ZONES, 'selected_box=taxes')),
                                         array('title' => BOX_TAXES_GEO_ZONES, 'link' => tep_href_link(FILENAME_GEO_ZONES, 'selected_box=taxes')),
                                         array('title' => BOX_TAXES_TAX_CLASSES, 'link' => tep_href_link(FILENAME_TAX_CLASSES, 'selected_box=taxes')),
                                         array('title' => BOX_TAXES_TAX_RATES, 'link' => tep_href_link(FILENAME_TAX_RATES, 'selected_box=taxes')))),

               array('title' => BOX_HEADING_LOCALIZATION,
// Added line for Admin w/access levels
                     'access' => tep_admin_check_boxes('localization.php'),
                     'image' => 'localization.gif',
                     'href' => tep_href_link(FILENAME_CURRENCIES, 'selected_box=localization'),
                     'children' => array(array('title' => BOX_LOCALIZATION_CURRENCIES, 'link' => tep_href_link(FILENAME_CURRENCIES, 'selected_box=localization')),
                                         array('title' => BOX_LOCALIZATION_LANGUAGES, 'link' => tep_href_link(FILENAME_LANGUAGES, 'selected_box=localization')),
                                         array('title' => BOX_LOCALIZATION_ORDERS_STATUS, 'link' => tep_href_link(FILENAME_ORDERS_STATUS, 'selected_box=localization')))),

               array('title' => BOX_HEADING_MODULES,
// Added line for Admin w/access levels
                     'access' => tep_admin_check_boxes('modules.php'),
                     'image' => 'modules.gif',
                     'href' => tep_href_link(FILENAME_MODULES, 'selected_box=modules&set=payment'),
                     'children' => array(array('title' => BOX_MODULES_PAYMENT, 'link' => tep_href_link(FILENAME_MODULES, 'selected_box=modules&set=payment')),
                                         array('title' => BOX_MODULES_SHIPPING, 'link' => tep_href_link(FILENAME_MODULES, 'selected_box=modules&set=shipping')),
                                         array('title' => BOX_MODULES_ORDER_TOTAL, 'link' => tep_href_link(FILENAME_MODULES, 'selected_box=modules&set=ordertotal')))),

               array('title' => BOX_HEADING_ADMINISTRATOR,
// Added line for Admin w/access levels
                     'access' => tep_admin_check_boxes('administrator.php'),
                     'image' => 'administrator.gif',
                     'href' => tep_href_link(tep_selected_file('administrator.php'), 'selected_box=administrator'),
                     'children' => array(array('title' => BOX_ADMINISTRATOR_MEMBER, 'link' => tep_href_link(FILENAME_ADMIN_MEMBERS, 'selected_box=administrator')),
                                         array('title' => 'Merchant Account Application', 'link' => tep_href_link('merchant_info.php', 'selected_box=administrator')),
                                         array('title' => 'Paypal Account Application', 'link' => tep_href_link('paypal_info.php', 'selected_box=administrator')),
                                         array('title' => 'Secure SSL Certificates', 'link' => tep_href_link('ssl_info.php', 'selected_box=administrator')),
                                         array('title' => 'osCMax eCommerce Hosting', 'link' => tep_href_link('hosting_info.php', 'selected_box=administrator')),
                                         array('title' => 'Domain Registration', 'link' => tep_href_link('domain_info.php', 'selected_box=administrator')),
                                         array('title' => 'Hosting Affiliate Program', 'link' => tep_href_link('affiliate_info.php', 'selected_box=administrator')),
                                               'access' => tep_admin_check_boxes(FILENAME_ADMIN_MEMBERS, 'sub_boxes'),
                                         array('title' => BOX_ADMINISTRATOR_BOXES, 'link' => tep_href_link(FILENAME_ADMIN_FILES, 'selected_box=administrator'),
                                               'access' => tep_admin_check_boxes(FILENAME_ADMIN_FILES, 'sub_boxes')))),
  );

  $languages = tep_get_languages();
  $languages_array = array();
  $languages_selected = DEFAULT_LANGUAGE;
  for ($i = 0, $n = sizeof($languages); $i < $n; $i++) {
    $languages_array[] = array('id' => $languages[$i]['code'],
                               'text' => $languages[$i]['name']);
    if ($languages[$i]['directory'] == $language) {
      $languages_selected = $languages[$i]['code'];
    }
  }
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<meta name="robots" content="noindex,nofollow">
<title><?php echo TITLE; ?></title>
<style type="text/css"><!--
.style1 {color: #FF0000}
a { color: #2A2A2A; text-decoration:none; }
a:hover { color: #818181; text-decoration:underline; }
a.text:link, a.text:visited { color: #B5B5B5; text-decoration: none; }
a:text:hover { color: #000000; text-decoration: underline; }
a.main:link, a.main:visited { color: Black; text-decoration: none; }
A.main:hover { color: #939393; text-decoration: underline; }
a.sub:link, a.sub:visited { color: #C5C5C5; text-decoration: none; }
A.sub:hover { color: #dddddd; text-decoration: underline; }
a:link.headerLink { font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000; font-weight: bold; text-decoration: none; }
a:visited.headerLink { font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000; font-weight: bold; text-decoration: none }
a:active.headerLink { font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000; font-weight: bold; text-decoration: none; }
a:hover.headerLink { font-family: Verdana, Arial, sans-serif; font-size: 10px; color: #000000; font-weight: bold; text-decoration: underline; }

#.heading { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 20px; font-weight: bold; line-height: 1.5; color: #000000; }
.heading { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 15px; font-weight: bold; line-height: 1.5; color: Black; }
.main { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 13px; font-weight: bold; line-height: 1.5; color: #000000; }
.sub { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; font-weight: bold; line-height: 1.5; color: #dddddd; }
.text { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px; font-weight: bold; line-height: 1.5; color: #000000; }
#.menuBoxHeading { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: #ffffff; font-weight: bold; background-color: #093570; border-color: #093570; border-style: solid; border-width: 1px; }
.menuBoxHeading { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 12px; color: Black; font-weight: bold; background-color: #F3F3F3; border-color: #B6B6B6; border-style: solid; border-width: 1px; }
.infoBox { font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 10px; color: #2C2C2C; background-color: #ffffff; border-color: #B6B6B6; border-style: solid; border-width: 1px; }
.smallText { font-family: Verdana, Arial, sans-serif; font-size: 10px; }

.menusub { font-family: Verdana, Arial, sans-serif; font-size: 10px; }

//--></style>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">
<br>
<table border="0" width="600" height="100%" cellspacing="0" cellpadding="0" align="center" valign="middle">
  <tr>
    <td><table border="0" width="600" height="440" cellspacing="0" cellpadding="1" align="center" valign="middle">
      <tr bgcolor="#000000">
        <td><table border="0" width="600" height="440" cellspacing="0" cellpadding="0">
          <tr bgcolor="#ffffff" height="50">
            <td height="50"><?php echo '<a href="http://www.oscmax.com">' . tep_image(DIR_WS_IMAGES . 'oscmax-logo.png', 'osCMax v2.0', '85', '80') . '</a>'; ?></td>
            <td align="right" class="text" nowrap><?php echo '&nbsp;&nbsp;<a href="http://www.oscmax.com/forums/" class="headerLink">' . BOX_ENTRY_SUPPORT_FORUMS . '</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="' . tep_href_link(FILENAME_DEFAULT) . '" class="headerLink">' . HEADER_TITLE_ADMINISTRATION . '</a>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="' . tep_catalog_href_link() . '" class="headerLink">' . HEADER_TITLE_ONLINE_CATALOG . '</a>'; ?>&nbsp;&nbsp<br>Current Version: <?php echo PROJECT_VERSION ?>&nbsp;&nbsp;</td>
          </tr>
          <tr bgcolor="#E7E7E7">
            <td colspan="2"><table border="0" width="100%" height="390" cellspacing="0" cellpadding="0">
              <tr valign="top">
                <td width="140" valign="top"><table border="0" width="140" height="390" cellspacing="0" cellpadding="0">
                  <tr>
                    <td valign="top"><br><br><br>
<?php
  $heading = array();
  $contents = array();

  $heading[] = array('params' => 'class="menuBoxHeading"',
                     'text'  => 'osCMax v2.0');

  $contents[] = array('params' => 'class="infoBox"',
                      'text'  => '<a href="http://www.oscmax.com" target="_blank">' . BOX_ENTRY_SUPPORT_SITE . '</a><br>' .
                                 '<a href="http://www.oscmax.com/forums" target="_blank">' . BOX_ENTRY_SUPPORT_FORUMS . '</a><br>' .
                                 '<a href="http://www.oscmax.com/template_store_oscmax_skins_0" target="_blank">' . BOX_ENTRY_TEMPLATE_STORE . '</a><br>' .
                                 '<a href="http://bugtrack.oscmax.com/" target="_blank">' . BOX_ENTRY_BUG_REPORTS . '</a><br>' .
                                 '<a href="https://www.paypal.com/us/mrb/pal=QFHLNU89TLJYA" target="_blank">' . BOX_ENTRY_PAYPAL . '</a><br>' .
                                 '<a href="https://www.cdgcommerce.com/internet-services.php?R=1017" target="_blank">' . BOX_ENTRY_MERCHANT . '</a><br>');
                            //   '<a href="http://www.aabox.com/domains.htm?oscmax" target="_blank">' . BOX_ENTRY_DOMAINS . '</a><br>' .
                            //   '<a href="http://www.aabox.com/ssl-compare.htm?oscmax" target="_blank">' . BOX_ENTRY_SSL . '</a><br>' .
               	            //	 '<a href="http://www.aabox.com/virtual-hosting-oscmax.htm" target="_blank">' . BOX_ENTRY_AABOX . '</a>');

  $box = new box;
  echo $box->menuBox($heading, $contents);

  echo '<br>';

  $orders_contents = '';
  $orders_status_query = tep_db_query("select orders_status_name, orders_status_id from " . TABLE_ORDERS_STATUS . " where language_id = '" . $languages_id . "'");
  while ($orders_status = tep_db_fetch_array($orders_status_query)) {
    $orders_pending_query = tep_db_query("select count(*) as count from " . TABLE_ORDERS . " where orders_status = '" . $orders_status['orders_status_id'] . "'");
    $orders_pending = tep_db_fetch_array($orders_pending_query);
// BOF: MOD - Admin w/access levels
//  $orders_contents .= '<a href="' . tep_href_link(FILENAME_ORDERS, 'selected_box=customers&status=' . $orders_status['orders_status_id']) . '">' . $orders_status['orders_status_name'] . '</a>: ' . $orders_pending['count'] . '<br>';
    if (tep_admin_check_boxes(FILENAME_ORDERS, 'sub_boxes') == true) {
      $orders_contents .= '<a href="' . tep_href_link(FILENAME_ORDERS, 'selected_box=customers&status=' . $orders_status['orders_status_id']) . '">' . $orders_status['orders_status_name'] . '</a>: ' . $orders_pending['count'] . '<br>';
    } else {
      $orders_contents .= '' . $orders_status['orders_status_name'] . ': ' . $orders_pending['count'] . '<br>';
    }
// EOF: MOD - Admin w/access levels
  }
  $orders_contents = substr($orders_contents, 0, -4);

  $heading = array();
  $contents = array();

  $heading[] = array('params' => 'class="menuBoxHeading"',
                     'text'  => BOX_TITLE_ORDERS);

  $contents[] = array('params' => 'class="infoBox"',
                      'text'  => $orders_contents);

  $box = new box;
  echo $box->menuBox($heading, $contents);

  echo '<br>';

  $customers_query = tep_db_query("select count(*) as count from " . TABLE_CUSTOMERS);
  $customers = tep_db_fetch_array($customers_query);
  $products_query = tep_db_query("select count(*) as count from " . TABLE_PRODUCTS . " where products_status = '1'");
  $products = tep_db_fetch_array($products_query);
  $reviews_query = tep_db_query("select count(*) as count from " . TABLE_REVIEWS);
  $reviews = tep_db_fetch_array($reviews_query);

  $heading = array();
  $contents = array();

  $heading[] = array('params' => 'class="menuBoxHeading"',
                     'text'  => BOX_TITLE_STATISTICS);

  $contents[] = array('params' => 'class="infoBox"',
                      'text'  => BOX_ENTRY_CUSTOMERS . ' ' . $customers['count'] . '<br>' .
                                 BOX_ENTRY_PRODUCTS . ' ' . $products['count'] . '<br>' .
                                 BOX_ENTRY_REVIEWS . ' ' . $reviews['count']);

  $box = new box;
  echo $box->menuBox($heading, $contents);

  echo '<br>';

  $contents = array();

  if (getenv('HTTPS') == 'on') {
    $size = ((getenv('SSL_CIPHER_ALGKEYSIZE')) ? getenv('SSL_CIPHER_ALGKEYSIZE') . '-bit' : '<i>' . BOX_CONNECTION_UNKNOWN . '</i>');
    $contents[] = array('params' => 'class="infoBox"',
                        'text' => tep_image(DIR_WS_ICONS . 'locked.gif', ICON_LOCKED, '', '', 'align="right"') . sprintf(BOX_CONNECTION_PROTECTED, $size));
  } else {
    $contents[] = array('params' => 'class="infoBox"',
                        'text' => tep_image(DIR_WS_ICONS . 'unlocked.gif', ICON_UNLOCKED, '', '', 'align="right"') . BOX_CONNECTION_UNPROTECTED);
  }

  $box = new box;
  echo $box->tableBlock($contents);
?>
                    </td>
                  </tr>
                </table></td>
                <td width="636" align="center"><table border="0" width="606" height="390" cellspacing="0" cellpadding="2">
                  <tr>
                    <td colspan="2"><table border="0" width="100%" cellspacing="0" cellpadding="2">
                      <tr><?php echo tep_draw_form('languages', 'index.php', '', 'get'); ?>
                        <td class="heading"><?php echo HEADING_TITLE; ?></td>
                        <td align="right"><?php echo tep_draw_pull_down_menu('language', $languages_array, $languages_selected, 'onChange="this.form.submit();"'); ?></td>
                      <?php echo tep_hide_session_id(); ?></form></tr>
                    </table></td>
                  </tr>
<?php
  $col = 2;
  $counter = 0;
  for ($i = 0, $n = sizeof($cat); $i < $n; $i++) {
    $counter++;
    if ($counter < $col) {
//      echo '                  <tr>' . "\n";
    }

    $cn = ($i >= 7 ? 2 : 1);

    ${'c' . $cn}.= '                    <table border="0" cellspacing="0" cellpadding="2" width="100%" bgcolor="#F3F3F3">' . "\n" .
         '                      <tr>' . "\n" .
         '                        <td valign="top"><a href="' . $cat[$i]['href'] . '">' . tep_image(DIR_WS_IMAGES . 'categories/' . $cat[$i]['image'], $cat[$i]['title'], '32', '32') . '</a></td>' . "\n" .
         '                        <td width="100%"><table border="0" cellspacing="0" cellpadding="2" width="100%">' . "\n" .
         '                          <tr bgcolor="#FFFFFF">' . "\n" .
         '                            <td class="main"><a href="' . $cat[$i]['href'] . '" class="main">' . $cat[$i]['title'] . '</a></td>' . "\n" .
         '                          </tr>' . "\n" .
         '                          <tr>' . "\n" .
         '                            <td class="menusub" width="100%">';

    $children = '';
    $children1 = '';
    $children2 = '';

    for ($j = 0, $k = sizeof($cat[$i]['children']); $j < $k; $j++) {

      if(isset($cat[$i]['cols'])) {
        if($j >= $cat[$i]['cols']) {
          $chn = 2;
        } else {
          $chn = 1;
        }
        ${'children'.$chn} .= '<a href="' . $cat[$i]['children'][$j]['link'] . '" class="menusub">' . $cat[$i]['children'][$j]['title'] . '</a><br>';
      } else {
        $children .= '<a href="' . $cat[$i]['children'][$j]['link'] . '" class="menusub">' . $cat[$i]['children'][$j]['title'] . '</a><br>';
      }
    }
    $children .= '<table width="100%"><tr><td valign="top" width="50%">' . $children1 . '</td><td valign="top" width="50%">' . $children2 . '</td></tr></table>';


    ${'c' . $cn} .= $children;

    ${'c' . $cn} .='</td> ' . "\n" .
         '                          </tr>' . "\n" .
         '                        </table></td>' . "\n" .
         '                      </tr>' . "\n" .
         '                    </table>' . "\n";

    if ($counter >= $col) {
//      echo '                  </tr>' . "\n";
      $counter = 0;
    }
  }
?>

                  <tr>
                    <td valign="top">
                      <table width="98%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="heading">Store Management</td>
                        </tr>
                      </table>
                      <?php echo $c1;?>
                    </td>
                    <td valign="top">
                      <table width="98%" border="0" cellpadding="0" cellspacing="0">
                        <tr>
                          <td class="heading">Store Setup</td>
                        </tr>
                      </table>
                      <?php echo $c2;?>
                    </td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
          <td><?php require(DIR_WS_INCLUDES . 'footer.php'); ?></td>
        </tr>
    </table></td>
  </tr>
</table>

</body>

</html>
