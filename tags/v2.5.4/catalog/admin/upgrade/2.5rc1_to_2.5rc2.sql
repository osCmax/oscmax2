/*
/* osCmax v2.5 RC1 to RC2 Database Upgrade  */
/*********************************************************************/
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE TABLE IF NOT EXISTS db_version (
  database_version varchar(128) DEFAULT NULL
) ;
/* Alter table in target */
ALTER TABLE customers 
	ADD COLUMN customers_paypal_payerid varchar(20) NULL after customers_shipment_allowed, 
	ADD COLUMN customers_paypal_ec tinyint(1) unsigned   NOT NULL DEFAULT '0' after customers_paypal_payerid;

/* SYNC DB : rc1 upgrade to rc2 */ 
SET AUTOCOMMIT = 0;

/* SYNC TABLE : admin_files */

DELETE FROM admin_files  WHERE (admin_files_id = 174) ;
DELETE FROM admin_files  WHERE (admin_files_id = 173) ;
INSERT INTO admin_files VALUES ('213', 'configuration.php?gID=89', 'BOX_CONFIGURATION_GOOGLE_MAPS', '0', '2', '1', '37');
INSERT INTO admin_files VALUES ('212', 'configuration.php?gID=85', 'BOX_CONFIGURATION_GOOGLE_ANALYTICS', '0', '2', '1', '36');
UPDATE admin_files SET admin_files_id='211', admin_files_name='configuration.php?gID=70', admin_display_name='BOX_CONFIGURATION_EDITOR', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='35'  WHERE (admin_files_id = 211) ;
UPDATE admin_files SET admin_files_id='209', admin_files_name='configuration.php?gID=60', admin_display_name='BOX_CONFIGURATION_SEO_URLS', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='33'  WHERE (admin_files_id = 209) ;
UPDATE admin_files SET admin_files_id='208', admin_files_name='configuration.php?gID=456', admin_display_name='BOX_ARTICLES_CONFIG', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='32'  WHERE (admin_files_id = 208) ;
UPDATE admin_files SET admin_files_id='207', admin_files_name='configuration.php?gID=80', admin_display_name='BOX_TOOLS_RECOVER_CART', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='30'  WHERE (admin_files_id = 207) ;
UPDATE admin_files SET admin_files_id='206', admin_files_name='configuration.php?gID=35', admin_display_name='BOX_CONFIGURATION_AFFILIATE', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='29'  WHERE (admin_files_id = 206) ;
UPDATE admin_files SET admin_files_id='205', admin_files_name='configuration.php?gID=65', admin_display_name='BOX_CONFIGURATION_WISHLIST', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='28'  WHERE (admin_files_id = 205) ;
UPDATE admin_files SET admin_files_id='204', admin_files_name='configuration.php?gID=203', admin_display_name='BOX_CONFIGURATION_NOTIFICATIONS', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='28'  WHERE (admin_files_id = 204) ;
UPDATE admin_files SET admin_files_id='203', admin_files_name='configuration.php?gID=87', admin_display_name='BOX_CONFIGURATION_RECAPTCHA', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='27'  WHERE (admin_files_id = 203) ;
UPDATE admin_files SET admin_files_id='202', admin_files_name='configuration.php?gID=207', admin_display_name='BOX_CONFIGURATION_CONTACT', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='26'  WHERE (admin_files_id = 202) ;
UPDATE admin_files SET admin_files_id='201', admin_files_name='configuration.php?gID=205', admin_display_name='BOX_CONFIGURATION_CORNER_BANNERS', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='26'  WHERE (admin_files_id = 201) ;
UPDATE admin_files SET admin_files_id='200', admin_files_name='configuration.php?gID=204', admin_display_name='BOX_CONFIGURATION_SLIDESHOW', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='25'  WHERE (admin_files_id = 200) ;
UPDATE admin_files SET admin_files_id='199', admin_files_name='configuration.php?gID=7575', admin_display_name='BOX_CONFIGURATION_OPC', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='24'  WHERE (admin_files_id = 199) ;
UPDATE admin_files SET admin_files_id='198', admin_files_name='configuration.php?gID=99', admin_display_name='BOX_CONFIGURATION_OFS', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='23'  WHERE (admin_files_id = 198) ;
UPDATE admin_files SET admin_files_id='197', admin_files_name='information_manager.php?gID=2', admin_display_name='BOX_CONFIGURATION_WELCOME', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='22'  WHERE (admin_files_id = 197) ;
UPDATE admin_files SET admin_files_id='196', admin_files_name='information_manager.php?gID=1', admin_display_name='BOX_CONFIGURATION_INFO_PAGES', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='21'  WHERE (admin_files_id = 196) ;
UPDATE admin_files SET admin_files_id='195', admin_files_name='infobox_configuration.php', admin_display_name='BOX_HEADING_BOXES', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='20'  WHERE (admin_files_id = 195) ;
UPDATE admin_files SET admin_files_id='194', admin_files_name='configuration.php?gID=201', admin_display_name='BOX_CONFIGURATION_TEMPLATE_SETUP', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='19'  WHERE (admin_files_id = 194) ;
UPDATE admin_files SET admin_files_id='193', admin_files_name='configuration.php?gID=25', admin_display_name='BOX_CONFIGURATION_WYSIWYG', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='18'  WHERE (admin_files_id = 193) ;
UPDATE admin_files SET admin_files_id='192', admin_files_name='configuration.php?gID=206', admin_display_name='BOX_CONFIGURATION_MC', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='17'  WHERE (admin_files_id = 192) ;
UPDATE admin_files SET admin_files_id='191', admin_files_name='configuration.php?gID=12', admin_display_name='BOX_CONFIGURATION_EMAIL', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='17'  WHERE (admin_files_id = 191) ;
UPDATE admin_files SET admin_files_id='190', admin_files_name='configuration.php?gID=30', admin_display_name='BOX_CONFIGURATION_PRINT', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='16'  WHERE (admin_files_id = 190) ;
UPDATE admin_files SET admin_files_id='189', admin_files_name='configuration.php?gID=13', admin_display_name='BOX_CONFIGURATION_DOWNLOAD', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='15'  WHERE (admin_files_id = 189) ;
UPDATE admin_files SET admin_files_id='188', admin_files_name='configuration.php?gID=9', admin_display_name='BOX_CONFIGURATION_STOCK', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='14'  WHERE (admin_files_id = 188) ;
UPDATE admin_files SET admin_files_id='187', admin_files_name='configuration.php?gID=88', admin_display_name='BOX_CONFIGURATION_PRODUCT_PRICE_BREAKS', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='13'  WHERE (admin_files_id = 187) ;
UPDATE admin_files SET admin_files_id='186', admin_files_name='configuration.php?gID=50', admin_display_name='BOX_CONFIGURATION_PRODUCT_INFO', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='12'  WHERE (admin_files_id = 186) ;
UPDATE admin_files SET admin_files_id='185', admin_files_name='configuration.php?gID=8', admin_display_name='BOX_CONFIGURATION_PRODUCT_LISTING', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='10'  WHERE (admin_files_id = 185) ;
UPDATE admin_files SET admin_files_id='184', admin_files_name='configuration.php?gID=7', admin_display_name='BOX_CONFIGURATION_SHIPPING', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='9'  WHERE (admin_files_id = 184) ;
UPDATE admin_files SET admin_files_id='183', admin_files_name='configuration.php?gID=5', admin_display_name='BOX_CONFIGURATION_CUSTOMER_DETAILS', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='8'  WHERE (admin_files_id = 183) ;
UPDATE admin_files SET admin_files_id='182', admin_files_name='configuration.php?gID=45', admin_display_name='BOX_CONFIGURATION_MOPICS', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='7'  WHERE (admin_files_id = 182) ;
UPDATE admin_files SET admin_files_id='180', admin_files_name='configuration.php?gID=3', admin_display_name='BOX_CONFIGURATION_MAX_VALUES', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='3'  WHERE (admin_files_id = 180) ;
UPDATE admin_files SET admin_files_id='179', admin_files_name='configuration.php?gID=2', admin_display_name='BOX_CONFIGURATION_MIN_VALUES', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='2'  WHERE (admin_files_id = 179) ;
UPDATE admin_files SET admin_files_id='178', admin_files_name='configuration.php?gID=1', admin_display_name='BOX_CONFIGURATION_MYSTORE', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='1'  WHERE (admin_files_id = 178) ;
UPDATE admin_files SET admin_files_id='177', admin_files_name='modules.php?set=ordertotal', admin_display_name='BOX_MODULES_ORDER_TOTAL', admin_files_is_boxes='0', admin_files_to_boxes='4', admin_groups_id='1', admin_sort_order='3'  WHERE (admin_files_id = 177) ;
UPDATE admin_files SET admin_files_id='176', admin_files_name='modules.php?set=shipping', admin_display_name='BOX_MODULES_SHIPPING', admin_files_is_boxes='0', admin_files_to_boxes='4', admin_groups_id='1', admin_sort_order='2'  WHERE (admin_files_id = 176) ;
UPDATE admin_files SET admin_files_id='175', admin_files_name='modules.php?set=payment', admin_display_name='BOX_MODULES_PAYMENT', admin_files_is_boxes='0', admin_files_to_boxes='4', admin_groups_id='1', admin_sort_order='1'  WHERE (admin_files_id = 175) ;
UPDATE admin_files SET admin_files_id='172', admin_files_name='merchant_info.php', admin_display_name='BOX_MERCHANT_INFO', admin_files_is_boxes='0', admin_files_to_boxes='1', admin_groups_id='1', admin_sort_order='13'  WHERE (admin_files_id = 172) ;
UPDATE admin_files SET admin_files_id='171', admin_files_name='configuration.php?gID=16', admin_display_name='BOX_CONFIGURATION_MAINTENANCE', admin_files_is_boxes='0', admin_files_to_boxes='1', admin_groups_id='1', admin_sort_order='10'  WHERE (admin_files_id = 171) ;
UPDATE admin_files SET admin_files_id='170', admin_files_name='configuration.php?gID=15', admin_display_name='BOX_CONFIGURATION_SESSIONS', admin_files_is_boxes='0', admin_files_to_boxes='1', admin_groups_id='1', admin_sort_order='9'  WHERE (admin_files_id = 170) ;
UPDATE admin_files SET admin_files_id='169', admin_files_name='configuration.php?gID=55', admin_display_name='BOX_CONFIGURATION_PAGE_CACHE', admin_files_is_boxes='0', admin_files_to_boxes='1', admin_groups_id='1', admin_sort_order='8'  WHERE (admin_files_id = 169) ;
UPDATE admin_files SET admin_files_id='168', admin_files_name='configuration.php?gID=11', admin_display_name='BOX_CONFIGURATION_CACHE', admin_files_is_boxes='0', admin_files_to_boxes='1', admin_groups_id='1', admin_sort_order='7'  WHERE (admin_files_id = 168) ;
UPDATE admin_files SET admin_files_id='167', admin_files_name='configuration.php?gID=10', admin_display_name='BOX_CONFIGURATION_LOGGING_CACHE', admin_files_is_boxes='0', admin_files_to_boxes='1', admin_groups_id='1', admin_sort_order='6'  WHERE (admin_files_id = 167) ;
UPDATE admin_files SET admin_files_id='166', admin_files_name='admin_members.php?gID=groups', admin_display_name='BOX_ADMIN_GROUPS', admin_files_is_boxes='0', admin_files_to_boxes='1', admin_groups_id='1', admin_sort_order='2'  WHERE (admin_files_id = 166) ;
UPDATE admin_files SET admin_files_id='165', admin_files_name='configuration.php?gID=14', admin_display_name='BOX_CONFIGURATION_GZIP', admin_files_is_boxes='0', admin_files_to_boxes='1', admin_groups_id='1', admin_sort_order='4'  WHERE (admin_files_id = 165) ;
UPDATE admin_files SET admin_files_id='164', admin_files_name='specialsbycategory.php', admin_display_name='BOX_CATALOG_SPECIALS_BY_CAT', admin_files_is_boxes='0', admin_files_to_boxes='3', admin_groups_id='1,2', admin_sort_order='7'  WHERE (admin_files_id = 164) ;
UPDATE admin_files SET admin_files_id='210', admin_files_name='configuration.php?gID=86', admin_display_name='BOX_CONFIGURATION_SEO_POPOUT', admin_files_is_boxes='0', admin_files_to_boxes='2', admin_groups_id='1', admin_sort_order='34'  WHERE (admin_files_id = 210) ;
/* SYNC TABLE : configuration */

/*Start of batch : 1 */
DELETE FROM configuration  WHERE (configuration_id = 3304) ;
DELETE FROM configuration  WHERE (configuration_id = 501) ;
DELETE FROM configuration  WHERE (configuration_id = 2641) ;
DELETE FROM configuration  WHERE (configuration_id = 359) ;
DELETE FROM configuration  WHERE (configuration_id = 3000) ;
DELETE FROM configuration  WHERE (configuration_id = 3062) ;
DELETE FROM configuration  WHERE (configuration_id = 3046) ;
DELETE FROM configuration  WHERE (configuration_id = 3018) ;
DELETE FROM configuration  WHERE (configuration_id = 3003) ;
DELETE FROM configuration  WHERE (configuration_id = 3002) ;
DELETE FROM configuration  WHERE (configuration_id = 3001) ;
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('CT_ORDER_EDITOR_DEFAULT_PAYMENT_METHOD', 'ORDER_EDITOR_DEFAULT_PAYMENT_METHOD', 'Please Select...', 'CD_ORDER_EDITOR_CREDIT_CARD', '70', '6', NULL, now(), NULL, 'tep_cfg_pull_down_payment_methods(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('CT_PRICE_BREAK_PRICE', 'PRICE_BREAK_PRICE', 'off', 'CD_PRICE_BREAK_PRICE', '88', '3', '2011-08-13 17:21:06', now(), NULL, 'tep_cfg_select_option(array(\'high\',\'low\',\'off\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('CT_PRODUCT_LIST_BESTSELLER', 'PRODUCT_LIST_BESTSELLER', '1', 'CD_PRODUCT_LIST_BESTSELLER', '8', '12', NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('CT_ATTRIBUTE_PRICE_DISPLAY', 'ATTRIBUTE_PRICE_DISPLAY', 'separate', 'CD_ATTRIBUTE_PRICE_DISPLAY', '8', '23', NULL, now(), NULL, 'tep_cfg_select_option(array(\'separate\', \'combined\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('CT_INDEX_TAB', 'INDEX_TAB', '6', 'CD_INDEX_TAB', '6', '100', NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('CT_SHOW_SITEMAP', 'SHOW_SITEMAP', 'true', 'CD_SHOW_SITEMAP', '86', '5', '2011-08-13 17:21:06', now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('CT_NO_OF_DYNAMIC_MOPICS', 'NO_OF_DYNAMIC_MOPICS', '5', 'CD_NO_OF_DYNAMIC_MOPICS', '45', '50', NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('CT_TEMPLATE_SWITCHING_MENU', 'TEMPLATE_SWITCHING_MENU', 'false', 'CD_TEMPLATE_SWITCHING_MENU', '201', '4', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
UPDATE configuration SET configuration_id='2660', configuration_title='CT_SCROLLER_WIDTH', configuration_key='SCROLLER_WIDTH',configuration_description='CD_SCROLLER_WIDTH', configuration_group_id='201', sort_order='28', last_modified=now(),use_function=NULL, set_function=NULL  WHERE (configuration_id = 2660) ;
UPDATE configuration SET configuration_id='3076', configuration_title='CT_ONEPAGE_BOX_ONE_CONTENT', configuration_key='ONEPAGE_BOX_ONE_CONTENT', configuration_description='CD_ONEPAGE_BOX_ONE_CONTENT', configuration_group_id='7575', sort_order='16', last_modified=now(), use_function=NULL, set_function='tep_cfg_textarea('  WHERE (configuration_id = 3076) ;
UPDATE configuration SET configuration_id='1305', configuration_title='CT_ORDER_EDITOR_USE_SPPC', configuration_key='ORDER_EDITOR_USE_SPPC', configuration_value='true', configuration_description='CD_ORDER_EDITOR_USE_SPPC', configuration_group_id='70', sort_order='3', last_modified=now(), use_function=NULL, set_function='tep_cfg_select_option(array(\'true\', \'false\'),'  WHERE (configuration_id = 1305) ;
UPDATE configuration SET configuration_id='1224', configuration_title='CT_AFFILIATE_SHOW_BANNERS_DEBUG', configuration_key='AFFILIATE_SHOW_BANNERS_DEBUG', configuration_value='false', configuration_description='CD_AFFILIATE_SHOW_BANNERS_DEBUG', configuration_group_id='35', sort_order='21', last_modified=now(), use_function=NULL, set_function='tep_cfg_select_option(array(\'true\', \'false\'),'  WHERE (configuration_id = 1224) ;
UPDATE configuration SET configuration_id='1', configuration_title='CT_STORE_NAME', configuration_key='STORE_NAME',configuration_description='CD_STORE_NAME', configuration_group_id='1', sort_order='1', last_modified=now(), use_function=NULL, set_function=NULL  WHERE (configuration_id = 1) ;
UPDATE configuration SET configuration_id='4', configuration_title='CT_EMAIL_FROM', configuration_key='EMAIL_FROM', configuration_description='CD_EMAIL_FROM', configuration_group_id='1', sort_order='5', last_modified=now(), use_function=NULL, set_function=NULL  WHERE (configuration_id = 4) ;
UPDATE configuration SET configuration_id='631', configuration_title='CT_MODULE_LOYALTY_DISCOUNT_STATUS', configuration_key='MODULE_LOYALTY_DISCOUNT_STATUS', configuration_value='false', configuration_description='CD_MODULE_LOYALTY_DISCOUNT_STATUS', configuration_group_id='6', sort_order='1', last_modified=now(), use_function=NULL, set_function='tep_cfg_select_option(array(\'true\', \'false\'),'  WHERE (configuration_id = 631) ;
UPDATE configuration SET configuration_id='3125', configuration_title='CT_STORE_LOGO', configuration_key='STORE_LOGO', configuration_description='CD_STORE_LOGO', configuration_group_id='1', sort_order='2', last_modified=now(), use_function=NULL, set_function=NULL  WHERE (configuration_id = 3125) ;
UPDATE configuration SET configuration_id='3088', configuration_title='CT_ONEPAGE_CHECKOUT_HIDE_SHIPPING', configuration_key='ONEPAGE_CHECKOUT_HIDE_SHIPPING', configuration_value='true', configuration_description='CD_ONEPAGE_CHECKOUT_HIDE_SHIPPING', configuration_group_id='7575', sort_order='100', last_modified=now(), use_function=NULL, set_function='tep_cfg_select_option(array(\'true\', \'false\'),'  WHERE (configuration_id = 3088) ;
UPDATE configuration SET configuration_id='387', configuration_title='CT_PERIOD_BEFORE_DOWN_FOR_MAINTENANCE', configuration_key='PERIOD_BEFORE_DOWN_FOR_MAINTENANCE', configuration_description='CD_PERIOD_BEFORE_DOWN_FOR_MAINTENANCE', configuration_group_id='16', sort_order='10', last_modified=now(), use_function=NULL, set_function=NULL  WHERE (configuration_id = 387) ;
UPDATE configuration SET configuration_id='2661', configuration_title='CT_SCROLLER_HEIGHT', configuration_key='SCROLLER_HEIGHT', configuration_description='CD_SCROLLER_HEIGHT', configuration_group_id='201', sort_order='29', last_modified=now(), use_function=NULL, set_function=NULL  WHERE (configuration_id = 2661) ;
/*End   of batch : 1 */
/* SYNC TABLE : configuration_group */

/*Start of batch : 1 */
UPDATE configuration_group SET configuration_group_id='456', configuration_group_title='BOX_CONFIGURATION_ARTICLES', configuration_group_description='Settings for Articles', sort_order='456', visible='1'  WHERE (configuration_group_id = 456) ;
/*End   of batch : 1 */
/* SYNC TABLE : db_version */

REPLACE INTO db_version SET database_version='v2.5_RC2';

/* SYNC TABLE : pm_configuration */

/*Start of batch : 1 */
INSERT INTO pm_configuration (pm_title, pm_description, pm_filename, pm_active, pm_page, pm_sort_order, last_modified, date_added) VALUES ('Recently Viewed', '', 'recently_viewed_products.php', 'yes', 'all', '1', now(), now());
UPDATE pm_configuration SET pm_id='17', pm_title='Banner', pm_description='', pm_filename='banner_all.php', pm_page='all', pm_sort_order='3', last_modified=now()  WHERE (pm_id = 17) ;
UPDATE pm_configuration SET pm_id='16', pm_title='Banner', pm_description='', pm_filename='banner_index.php', pm_page='index', pm_sort_order='9', last_modified=now()  WHERE (pm_id = 16) ;
UPDATE pm_configuration SET pm_id='18', pm_title='Banner', pm_description='', pm_filename='banner_product.php', pm_page='product_info', pm_sort_order='5', last_modified=now()  WHERE (pm_id = 18) ;
UPDATE pm_configuration SET pm_id='8', pm_title='Copyright', pm_description='', pm_filename='copyright.php', pm_page='all', pm_sort_order='4', last_modified=now()  WHERE (pm_id = 8) ;
UPDATE pm_configuration SET pm_id='7', pm_title='Counter', pm_description='', pm_filename='counter.php', pm_page='all', pm_sort_order='2', last_modified=now()  WHERE (pm_id = 7) ;
/*End   of batch : 1 */

COMMIT;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
