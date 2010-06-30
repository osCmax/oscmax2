<?php
/*
$Id: xsell.php 3 2006-05-27 04:59:07Z user $ 

osCMax Power E-Commerce 
http://oscdox.com 

Copyright 2006 osCMax2005 osCMax, 2002 osCommerce 

Released under the GNU General Public License 

xsell.php
Original Idea From Isaac Mualem im@imwebdesigning.com <mailto:im@imwebdesigning.com> 
Complete Recoding From Stephen Walker admin@snjcomputers.com
*/ 

define('CROSS_SELL_SUCCESS', 'Cross-Sell Produkten erfolgreich aktualisiert für Cross-Sell Produkt #'.$_GET['add_related_product_ID']);
define('SORT_CROSS_SELL_SUCCESS', 'Sortierreihenfolge erfolgreich aktualisiert für Cross-Sell Produkt #'.$_GET['add_related_product_ID']);
define('HEADING_TITLE', 'Cross-Sell (X-Sell) Verwaltung');
define('TABLE_HEADING_PRODUCT_ID', 'Produkt Id');
define('TABLE_HEADING_PRODUCT_MODEL', 'Produkt-Modell');
define('TABLE_HEADING_PRODUCT_NAME', 'Produkt Name');
define('TABLE_HEADING_CURRENT_SELLS', 'Strom Cross-Sells');
define('TABLE_HEADING_UPDATE_SELLS', 'Aktualisierung Cross-Sells');
define('TABLE_HEADING_PRODUCT_IMAGE', 'Produkt Bild');
define('TABLE_HEADING_PRODUCT_PRICE', 'Produkt Price');
define('TABLE_HEADING_CROSS_SELL_THIS', 'Cross-Sell das?');
define('TEXT_EDIT_SELLS', 'Bearbeiten');
define('TEXT_SORT', 'Priorisieren');
define('TEXT_SETTING_SELLS', 'Einstellungen für Cross-Sells');
define('TEXT_PRODUCT_ID', 'Produkt Id');
define('TEXT_MODEL', 'Modell');
define('TABLE_HEADING_PRODUCT_SORT', 'Sortierreihenfolge');
define('TEXT_NO_IMAGE', 'Kein Bild');
define('TEXT_CROSS_SELL', 'Cross-Sell');

?>