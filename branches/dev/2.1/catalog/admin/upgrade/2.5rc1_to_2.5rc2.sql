/*
osCmax v2.5 RC1 to RC2 Database Upgrade  
*********************************************************************
*/
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/* Alter table in target */
ALTER TABLE `customers` 
	ADD COLUMN `customers_paypal_payerid` varchar(20) NULL after `customers_shipment_allowed`, 
	ADD COLUMN `customers_paypal_ec` tinyint(1) unsigned   NOT NULL DEFAULT '0' after `customers_paypal_payerid`;

/* SYNC DB : rc1 */ 
SET AUTOCOMMIT = 0;

/* SYNC TABLE : `address_book` */

/* SYNC TABLE : `address_format` */

/* SYNC TABLE : `admin` */

/* SYNC TABLE : `admin_files` */

/* SYNC TABLE : `admin_groups` */

/* SYNC TABLE : `admin_log` */

/* SYNC TABLE : `affiliate_affiliate` */

/* SYNC TABLE : `affiliate_banners` */

/* SYNC TABLE : `affiliate_banners_history` */

/* SYNC TABLE : `affiliate_clickthroughs` */

/* SYNC TABLE : `affiliate_news` */

/* SYNC TABLE : `affiliate_news_contents` */

/* SYNC TABLE : `affiliate_newsletters` */

/* SYNC TABLE : `affiliate_payment` */

/* SYNC TABLE : `affiliate_payment_status` */

/* SYNC TABLE : `affiliate_payment_status_history` */

/* SYNC TABLE : `affiliate_sales` */

/* SYNC TABLE : `article_reviews` */

/* SYNC TABLE : `article_reviews_description` */

/* SYNC TABLE : `articles` */

/* SYNC TABLE : `articles_description` */

/* SYNC TABLE : `articles_to_topics` */

/* SYNC TABLE : `articles_xsell` */

/* SYNC TABLE : `authors` */

/* SYNC TABLE : `authors_info` */

/* SYNC TABLE : `banners` */

/* SYNC TABLE : `banners_history` */

/* SYNC TABLE : `cache` */

/* SYNC TABLE : `categories` */

/* SYNC TABLE : `categories_description` */

/* SYNC TABLE : `configuration` */

	/*Start of batch : 1 */
DELETE FROM `configuration`  WHERE (`configuration_id` = 359) ;
DELETE FROM `configuration`  WHERE (`configuration_id` = 3062) ;
DELETE FROM `configuration`  WHERE (`configuration_id` = 3046) ;
DELETE FROM `configuration`  WHERE (`configuration_id` = 3018) ;
DELETE FROM `configuration`  WHERE (`configuration_id` = 3003) ;
DELETE FROM `configuration`  WHERE (`configuration_id` = 3002) ;
DELETE FROM `configuration`  WHERE (`configuration_id` = 3001) ;
DELETE FROM `configuration`  WHERE (`configuration_id` = 3000) ;
DELETE FROM `configuration`  WHERE (`configuration_id` = 501) ;
DELETE FROM `configuration`  WHERE (`configuration_id` = 2641) ;
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('CT_PRODUCT_LIST_BESTSELLER', 'PRODUCT_LIST_BESTSELLER', '1', 'CD_PRODUCT_LIST_BESTSELLER', 8, 12, NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('CT_NO_OF_DYNAMIC_MOPICS', 'NO_OF_DYNAMIC_MOPICS', '5', 'CD_NO_OF_DYNAMIC_MOPICS', 45, 50, NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('CT_SHOW_SITEMAP', 'SHOW_SITEMAP', 'true', 'CD_SHOW_SITEMAP', 86, 5, NULL, now(), NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('CT_ORDER_EDITOR_DEFAULT_PAYMENT_METHOD', 'ORDER_EDITOR_DEFAULT_PAYMENT_METHOD', 'Please Select...', 'CD_ORDER_EDITOR_CREDIT_CARD', 70, 6, NULL, now(), NULL, 'tep_cfg_pull_down_payment_methods(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('CT_PRICE_BREAK_PRICE', 'PRICE_BREAK_PRICE', 'off', 'CD_PRICE_BREAK_PRICE', 88, 3, NULL, now(), NULL, 'tep_cfg_select_option(array(''high'',''low'',''off''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('CT_ATTRIBUTE_PRICE_DISPLAY', 'ATTRIBUTE_PRICE_DISPLAY', 'separate', 'CD_ATTRIBUTE_PRICE_DISPLAY', 8, 23, NULL, now(), NULL, 'tep_cfg_select_option(array(''separate'', ''combined''),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES('CT_INDEX_TAB', 'INDEX_TAB', '6', 'CD_INDEX_TAB', 6, 100, NULL, now(), NULL, NULL);
UPDATE `configuration` SET `configuration_id`='3088', `configuration_title`='CT_ONEPAGE_CHECKOUT_HIDE_SHIPPING', `configuration_key`='ONEPAGE_CHECKOUT_HIDE_SHIPPING', `configuration_value`='true', `configuration_description`='CD_ONEPAGE_CHECKOUT_HIDE_SHIPPING', `configuration_group_id`='7575', `sort_order`='100', `last_modified`=NULL, `date_added`='2011-08-04 16:42:14', `use_function`=NULL, `set_function`='tep_cfg_select_option(array(\'true\', \'false\'),'  WHERE (`configuration_id` = 3088) ;
UPDATE `configuration` SET `configuration_id`='3125', `configuration_title`='CT_STORE_LOGO', `configuration_key`='STORE_LOGO', `configuration_value`='logo.png', `configuration_description`='CD_STORE_LOGO', `configuration_group_id`='1', `sort_order`='2', `last_modified`=NULL, `date_added`='2011-08-04 16:42:14', `use_function`=NULL, `set_function`=NULL  WHERE (`configuration_id` = 3125) ;
UPDATE `configuration` SET `configuration_id`='1224', `configuration_title`='CT_AFFILIATE_SHOW_BANNERS_DEBUG', `configuration_key`='AFFILIATE_SHOW_BANNERS_DEBUG', `configuration_value`='false', `configuration_description`='CD_AFFILIATE_SHOW_BANNERS_DEBUG', `configuration_group_id`='35', `sort_order`='21', `last_modified`=NULL, `date_added`='2011-08-04 16:42:14', `use_function`=NULL, `set_function`='tep_cfg_select_option(array(\'true\', \'false\'),'  WHERE (`configuration_id` = 1224) ;
UPDATE `configuration` SET `configuration_id`='631', `configuration_title`='CT_MODULE_LOYALTY_DISCOUNT_STATUS', `configuration_key`='MODULE_LOYALTY_DISCOUNT_STATUS', `configuration_value`='false', `configuration_description`='CD_MODULE_LOYALTY_DISCOUNT_STATUS', `configuration_group_id`='6', `sort_order`='1', `last_modified`=NULL, `date_added`='2011-08-04 16:42:14', `use_function`=NULL, `set_function`='tep_cfg_select_option(array(\'true\', \'false\'),'  WHERE (`configuration_id` = 631) ;




	/*End   of batch : 1 */
/* SYNC TABLE : `configuration_group` */

	/*Start of batch : 1 */
UPDATE `configuration_group` SET `configuration_group_id`='456', `configuration_group_title`='BOX_CONFIGURATION_ARTICLES', `configuration_group_description`='Settings for Articles', `sort_order`='456', `visible`='1'  WHERE (`configuration_group_id` = 456) ;
	/*End   of batch : 1 */
/* SYNC TABLE : `counter` */

/* SYNC TABLE : `counter_history` */

/* SYNC TABLE : `countries` */

/* SYNC TABLE : `coupon_email_track` */

/* SYNC TABLE : `coupon_gv_customer` */

/* SYNC TABLE : `coupon_gv_queue` */

/* SYNC TABLE : `coupon_redeem_track` */

/* SYNC TABLE : `coupons` */

/* SYNC TABLE : `coupons_description` */

/* SYNC TABLE : `currencies` */

/* SYNC TABLE : `customer_log` */

/* SYNC TABLE : `customers` */

/* SYNC TABLE : `customers_basket` */

/* SYNC TABLE : `customers_basket_attributes` */

/* SYNC TABLE : `customers_groups` */

/* SYNC TABLE : `customers_info` */

/* SYNC TABLE : `customers_notes` */

/* SYNC TABLE : `customers_wishlist` */

/* SYNC TABLE : `customers_wishlist_attributes` */

/* SYNC TABLE : `db_version` */

UPDATE `db_version` SET `database_version`='v2.5_RC2';


/* SYNC TABLE : `discount_categories` */

/* SYNC TABLE : `extra_field_labels` */

/* SYNC TABLE : `extra_field_values` */

/* SYNC TABLE : `extra_product_fields` */

/* SYNC TABLE : `extra_value_exclude` */

/* SYNC TABLE : `feedmachine` */

/* SYNC TABLE : `geo_zones` */

/* SYNC TABLE : `google_checkout` */

/* SYNC TABLE : `google_configuration` */

/* SYNC TABLE : `google_orders` */

/* SYNC TABLE : `help_pages` */

/* SYNC TABLE : `http_error` */

/* SYNC TABLE : `information` */

	/*Start of batch : 1 */
	
UPDATE `information` SET `information_id`='15', `information_group_id`='1', `information_title`='Informaci?n afiliado', `information_description`='<p>\r\n	Su informaci?n de afiliado va aqu?</p>', `information_url`='', `information_target`='_top', `parent_id`='0', `sort_order`='8', `visible`='1', `language_id`='3'  WHERE (`information_id` = 15 AND `language_id` = 3) ;
UPDATE `information` SET `information_id`='14', `information_group_id`='1', `information_title`='T?rminos y condiciones afiliados ', `information_description`='Introduzca aqu? los t?rminos y condiciones de afiliados.', `information_url`='', `information_target`='_top', `parent_id`='0', `sort_order`='7', `visible`='0', `language_id`='3'  WHERE (`information_id` = 14 AND `language_id` = 3) ;
UPDATE `information` SET `information_id`='1', `information_group_id`='2', `information_title`='TEXT_GREETING_PERSONAL', `information_description`='?Bienvenido de nuevo <span class=\"greetUser\">%s!</span> ?Le gustar?a ver qu? <a href=\"%s\"><u>nuevos productos</u></a> hay disponibles?', `information_url`='', `information_target`='_top', `parent_id`='0', `sort_order`='1', `visible`='1', `language_id`='3'  WHERE (`information_id` = 1 AND `language_id` = 3) ;
UPDATE `information` SET `information_id`='13', `information_group_id`='1', `information_title`='Texto p?gina inicio', `information_description`='<p><font face=\"arial, helvetica, sans-serif\">Para modificar el contenido de esta p?gina, vaya al Panel de administraci?n -> Configuraci?n -> Plantillas -> P?ginas de informaci?n.</font></p><hr /><p><font face=\"arial, helvetica, sans-serif\">Esto es osCmax v2.5, completo sistema de compras de comercio electr?nico.</font></p><p><font face=\"Arial\">El sitio web de soporte es <a href=\"http://www.oscmax.com/\"><font color=\"#800080\">http://www.oscmax.com</font></a>. Hay foros de soporte muy activos, wiki, documentaci?n, descargas y todo lo relacionado con <strong><em>osCmax.</em></strong>.</font></p>', `information_url`='', `information_target`='_top', `parent_id`='0', `sort_order`='1', `visible`='0', `language_id`='3'  WHERE (`information_id` = 13 AND `language_id` = 3) ;
UPDATE `information` SET `information_id`='13', `information_group_id`='1', `information_title`='Index-Seite Text', `information_description`='<p><font face=\"arial, helvetica, sans-serif\">&Auml\;ndern Sie diesen Text im Admin Panel unter -&gt\; Einstellungen -&gt\; Templates -&gt\; Informationsseiten.</font></p><hr /><p><font face=\"arial, helvetica, sans-serif\">Dies ist osCmax v2.5, das m&auml\;chtige Onlineshop-System.</font></p><p><font face=\"Arial\">Die offizielle osCmax Support Seite finden Sie unter <a href=\"http://www.oscmax.com\">http://www.oscmax.com</a>. Es existieren dort sehr aktive Support-Foren, ein Wiki, Anleitungen, Downloads und vieles mehr.</font></p>', `information_url`='', `information_target`='_top', `parent_id`='0', `sort_order`='1', `visible`='0', `language_id`='2'  WHERE (`information_id` = 13 AND `language_id` = 2) ;
UPDATE `information` SET `information_id`='2', `information_group_id`='2', `information_title`='TEXT_GREETING_PERSONAL_RELOGON', `information_description`='<small>Si no es %s, por favor <a href=\"%s\"><u>entre aqu?</u></a> e introduzca sus datos.</small>', `information_url`='', `information_target`='_top', `parent_id`='0', `sort_order`='2', `visible`='1', `language_id`='3'  WHERE (`information_id` = 2 AND `language_id` = 3) ;
UPDATE `information` SET `information_id`='13', `information_group_id`='1', `information_title`='Index Page Text', `information_description`='<p><font face=\"arial, helvetica, sans-serif\">To modify the content of this page, go to your Admin Panel -> Configuration -> Templates -> Information Pages.</font></p><hr /><p><font face=\"arial, helvetica, sans-serif\">This is osCmax v2.5, the power e-commerce shopping cart system.</font></p><p><font face=\"Arial\">The official <strong><em>osCmax </em></strong>Support Site is <a href=\"http://www.oscmax.com/\"><font color=\"#800080\">http://www.oscmax.com</font></a> . There are very active support forums, the wiki, documentation, downloads, and everything else related to <strong><em>osCmax.</em></strong></font></p>', `information_url`='', `information_target`='_top', `parent_id`='0', `sort_order`='1', `visible`='0', `language_id`='1'  WHERE (`information_id` = 13 AND `language_id` = 1) ;
UPDATE `information` SET `information_id`='12', `information_group_id`='1', `information_title`='Wartungsarbeiten', `information_description`='<p>Diese Website ist derzeit wegen Wartungsarbeiten leider nicht erreichbar. Bitte besuchen Sie uns sp&auml\;ter noch einmal.</p>', `information_url`='', `information_target`='_top', `parent_id`='0', `sort_order`='2', `visible`='0', `language_id`='2'  WHERE (`information_id` = 12 AND `language_id` = 2) ;
UPDATE `information` SET `information_id`='3', `information_group_id`='2', `information_title`='TEXT_GREETING_GUEST', `information_description`='?Bienvenido <span class=\"greetUser\">Invitado!</span> ?Le gustar?a <a href=\"%s\"><u>entrar en su cuenta</u></a> o preferir?a <a href=\"%s\"><u>crear una cuenta nueva</u></a>?', `information_url`='', `information_target`='_top', `parent_id`='0', `sort_order`='3', `visible`='1', `language_id`='3'  WHERE (`information_id` = 3 AND `language_id` = 3) ;
UPDATE `information` SET `information_id`='11', `information_group_id`='1', `information_title`='AGB', `information_description`='<p>Unsere Allgemeinen Gesch&auml\;ftsbedingungen</p>', `information_url`='', `information_target`='_top', `parent_id`='0', `sort_order`='6', `visible`='1', `language_id`='2'  WHERE (`information_id` = 11 AND `language_id` = 2) ;
UPDATE `information` SET `information_id`='10', `information_group_id`='1', `information_title`='Privacidad', `information_description`='', `information_url`='', `information_target`='_top', `parent_id`='0', `sort_order`='5', `visible`='1', `language_id`='3'  WHERE (`information_id` = 10 AND `language_id` = 3) ;
UPDATE `information` SET `information_id`='8', `information_group_id`='1', `information_title`='Env?os/Devoluciones', `information_description`='<p>\r\n	&nbsp\;</p>\r\n<div style=\"font-family: Arial, Verdana, sans-serif; font-size: 12px; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); \">\r\n	<p>\r\n		Esta p?gina es para las pol?ticas de env?o. Ed?tala en el panel de administraci?n en la secci?n Configuraci?n &gt\;&gt\; Plantillas &gt\;&gt\; P?ginas de informaci?n</p>\r\n</div>', `information_url`='', `information_target`='_top', `parent_id`='0', `sort_order`='3', `visible`='1', `language_id`='3'  WHERE (`information_id` = 8 AND `language_id` = 3) ;
UPDATE `information` SET `information_id`='15', `information_group_id`='1', `information_title`='Affiliate-Information', `information_description`='<p>F&uuml\;gen Sie hier Ihre Informationen zum Affiliateprogramm ein.</p>', `information_url`='', `information_target`='_top', `parent_id`='0', `sort_order`='8', `visible`='1', `language_id`='2'  WHERE (`information_id` = 15 AND `language_id` = 2) ;
UPDATE `information` SET `information_id`='9', `information_group_id`='1', `information_title`='FAQ cheques regalo', `information_description`='', `information_url`='', `information_target`='_top', `parent_id`='0', `sort_order`='4', `visible`='1', `language_id`='3'  WHERE (`information_id` = 9 AND `language_id` = 3) ;
	/*End   of batch : 1 */
/* SYNC TABLE : `information_group` */

/* SYNC TABLE : `languages` */

/* SYNC TABLE : `manufacturers` */

/* SYNC TABLE : `manufacturers_info` */

/* SYNC TABLE : `newsletters` */

/* SYNC TABLE : `orders` */

/* SYNC TABLE : `orders_premade_comments` */

/* SYNC TABLE : `orders_products` */

/* SYNC TABLE : `orders_products_attributes` */

/* SYNC TABLE : `orders_products_download` */

/* SYNC TABLE : `orders_status` */

/* SYNC TABLE : `orders_status_history` */

/* SYNC TABLE : `orders_total` */

/* SYNC TABLE : `packaging` */

/* SYNC TABLE : `paypal_ipn` */

/* SYNC TABLE : `pm_configuration` */

	/*Start of batch : 1 */
INSERT INTO `pm_configuration` VALUES ('19', 'Recently Viewed', '', 'recently_viewed_products.php', 'yes', 'all', '1', '2011-08-04 16:42:15', '2011-08-04 16:42:15');
UPDATE `pm_configuration` SET `pm_id`='17', `pm_title`='Banner', `pm_description`='', `pm_filename`='banner_all.php', `pm_active`='yes', `pm_page`='all', `pm_sort_order`='3', `last_modified`='2011-08-04 16:42:15', `date_added`='2011-08-04 16:42:15'  WHERE (`pm_id` = 17) ;
UPDATE `pm_configuration` SET `pm_id`='8', `pm_title`='Copyright', `pm_description`='', `pm_filename`='copyright.php', `pm_active`='yes', `pm_page`='all', `pm_sort_order`='4', `last_modified`='2011-08-04 16:42:15', `date_added`='2011-08-04 16:42:15'  WHERE (`pm_id` = 8) ;
UPDATE `pm_configuration` SET `pm_id`='7', `pm_title`='Counter', `pm_description`='', `pm_filename`='counter.php', `pm_active`='yes', `pm_page`='all', `pm_sort_order`='2', `last_modified`='2011-08-04 16:42:15', `date_added`='2011-08-04 16:42:15'  WHERE (`pm_id` = 7) ;
	/*End   of batch : 1 */
/* SYNC TABLE : `products` */

/* SYNC TABLE : `products_attributes` */

/* SYNC TABLE : `products_attributes_download` */

/* SYNC TABLE : `products_description` */

/* SYNC TABLE : `products_groups` */

/* SYNC TABLE : `products_notifications` */

/* SYNC TABLE : `products_options` */

/* SYNC TABLE : `products_options_description` */

/* SYNC TABLE : `products_options_types` */

/* SYNC TABLE : `products_options_values` */

/* SYNC TABLE : `products_options_values_to_products_options` */

/* SYNC TABLE : `products_price_break` */

/* SYNC TABLE : `products_stock` */

/* SYNC TABLE : `products_to_categories` */

/* SYNC TABLE : `products_to_discount_categories` */

/* SYNC TABLE : `products_xsell` */

/* SYNC TABLE : `quick_links` */

/* SYNC TABLE : `reviews` */

/* SYNC TABLE : `reviews_description` */

/* SYNC TABLE : `scart` */

/* SYNC TABLE : `search_queries` */

/* SYNC TABLE : `search_queries_sorted` */

/* SYNC TABLE : `searchword_swap` */

/* SYNC TABLE : `sessions` */

/* SYNC TABLE : `shipping_manifest` */

/* SYNC TABLE : `slideshow` */

/* SYNC TABLE : `specials` */

/* SYNC TABLE : `specials_retail_prices` */

/* SYNC TABLE : `tax_class` */

/* SYNC TABLE : `tax_rates` */

/* SYNC TABLE : `theme_configuration` */

/* SYNC TABLE : `topics` */

/* SYNC TABLE : `topics_description` */

/* SYNC TABLE : `ups_boxes_used` */

/* SYNC TABLE : `usu_cache` */

/* SYNC TABLE : `whos_online` */

/* SYNC TABLE : `zones` */

/* SYNC TABLE : `zones_to_geo_zones` */


COMMIT;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
