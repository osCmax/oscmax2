/*
/* osCmax v2.5.0 and 2.5.0 PL1 to 2.5.1 Database Upgrade */
/**********************************************************************/
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


/* Alter table in target */
ALTER TABLE configuration 
	CHANGE configuration_value configuration_value varchar(512)  NOT NULL after configuration_key;

/* Alter table in target */
ALTER TABLE information 
	ADD COLUMN show_in_infobox enum('1','0')  NOT NULL DEFAULT '1' after visible, 
	CHANGE language_id language_id int(11)   NOT NULL DEFAULT '0' after show_in_infobox;


SET AUTOCOMMIT = 0;

/* SYNC TABLE : admin_files */

INSERT INTO admin_files VALUES ('', 'configuration.php?gID=208', 'BOX_CONFIGURATION_ADDTHIS', '0', '2', '1', '26');


/* SYNC TABLE : configuration */
INSERT INTO configuration VALUES ('', 'CT_ADD_THIS_ARTICLES', 'ADD_THIS_ARTICLES', 'true', 'CD_ADD_THIS_ARTICLES', '208', '5', now(), now(), '', 'tep_cfg_select_option(array(\'true\',\'false\'),');
INSERT INTO configuration VALUES ('', 'CT_ADD_THIS_ADDRESS_BAR', 'ADD_THIS_ADDRESS_BAR', '', 'CD_ADD_THIS_ADDRESS_BAR', '208', '4', now(), now(), '', 'tep_cfg_textarea(');
INSERT INTO configuration VALUES ('', 'CT_ADD_THIS_JAVASCRIPT', 'ADD_THIS_JAVASCRIPT', '', 'CD_ADD_THIS_JAVASCRIPT', '208', '3', now(), now(), '', 'tep_cfg_textarea(');
INSERT INTO configuration VALUES ('', 'CT_ADD_THIS_CODE', 'ADD_THIS_CODE', '', 'CD_ADD_THIS_CODE', '208', '2', now(), now(), '', 'tep_cfg_textarea(');
INSERT INTO configuration VALUES ('', 'CT_ADD_THIS_ENABLED', 'ADD_THIS_ENABLED', 'true', 'CD_ADD_THIS_ENABLED', '208', '1', now(), now(), '', 'tep_cfg_select_option(array(\'true\',\'false\'),');
INSERT INTO configuration VALUES ('', 'CT_CATEGORY_DROPDOWN_SWITCH', 'DISABLE_CATEGORY_DROPDOWN_SWITCH', 'false', 'CD_CATEGORY_DROPDOWN_SWITCH', '1', '26', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\',  \'false\'), ');
INSERT INTO configuration VALUES ('', 'CT_PRODUCT_LIST_DATE_ADDED', 'PRODUCT_LIST_DATE_ADDED', 'true', 'CD_PRODUCT_LIST_DATE_ADDED', '8', '24', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\',  \'false\'), ');
INSERT INTO configuration VALUES ('', 'CT_SHOW_SHIPPING_NEAR_PRICE', 'SHOW_SHIPPING_NEAR_PRICE', 'false', 'CD_SHOW_SHIPPING_NEAR_PRICE', '1', '23', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\',  \'false\'), ');
INSERT INTO configuration VALUES ('', 'CT_SHOW_TAX_RATE_NEAR_PRICE', 'SHOW_TAX_RATE_NEAR_PRICE', 'false', 'CD_SHOW_TAX_RATE_NEAR_PRICE', '1', '22', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\',  \'false\'), ');
UPDATE configuration SET configuration_id='2660', configuration_title='CT_SCROLLER_WIDTH', configuration_key='SCROLLER_WIDTH', configuration_value='603', configuration_description='CD_SCROLLER_WIDTH', configuration_group_id='201', sort_order='28', last_modified=now(), use_function=NULL, set_function=NULL  WHERE (configuration_id = 2660) ;
UPDATE configuration SET configuration_id='2657', configuration_title='CT_DEFAULT_PRODUCT_TAX_CLASS', configuration_key='DEFAULT_PRODUCT_TAX_CLASS', configuration_value='1', configuration_description='CD_DEFAULT_PRODUCT_TAX_CLASS', configuration_group_id='1', sort_order='24', last_modified=now(), use_function='tep_get_tax_class_title', set_function='tep_cfg_pull_down_tax_classes('  WHERE (configuration_id = 2657) ;
UPDATE configuration SET configuration_id='456', configuration_title='CT_NEW_SIGNUP_DISCOUNT_COUPON', configuration_key='NEW_SIGNUP_DISCOUNT_COUPON', configuration_value='', configuration_description='CD_NEW_SIGNUP_DISCOUNT_COUPON', configuration_group_id='1', sort_order='25', last_modified=now(), use_function=NULL, set_function=NULL  WHERE (configuration_id = 456) ;

/* SYNC TABLE : configuration_group */

/* SYNC TABLE : configuration_group */
INSERT INTO configuration_group VALUES ('', 'BOX_CONFIGURATION_ADDTHIS', 'AddThis', '208', '1');

/* SYNC TABLE : information  - documenting changes only. Live sites may have already customized these, so no need to force changes when not necessary.
INSERT INTO information VALUES ('16', '1', 'FAQ del Programa de afiliados', '<p>\r\n	Su información FAQ de afiliado va aquí</p>', '', '_top', '0', '8', '1', '0', '3');
INSERT INTO information VALUES ('16', '1', 'Affiliate Program FAQ', '<p>\r\n	Your Affiliate FAQ goes in here</p>', '', '_top', '0', '8', '1', '0', '1');
INSERT INTO information VALUES ('16', '1', 'Affiliateprogramm FAQ', '<p>F&uuml;gen Sie hier Ihre FAQ Informationen zum Affiliateprogramm ein.</p>', '', '_top', '0', '8', '1', '0', '2');
UPDATE information SET information_id='8', information_group_id='1', information_title='Versandkosten und Rücksendungen', information_description='<p>\r\n	&nbsp;</p>\r\n<div style=\"font-family: Arial, Verdana, sans-serif; font-size: 12px; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); \">\r\n	<p>\r\n		This Page is for your shipping policies. Edit this in your admin panel under Configuration &gt;&gt; Templates &gt;&gt; Information Pages</p>\r\n</div>', information_url='', information_target='_top', parent_id='0', sort_order='3', visible='1', show_in_infobox='1', language_id='2'  WHERE (information_id = 8 AND language_id = 2) ;
UPDATE information SET information_id='15', information_group_id='1', information_title='Affiliate Information', information_description='<p>\r\n	Your Affiliate Information goes in here</p>', information_url='', information_target='_top', parent_id='0', sort_order='8', visible='1', show_in_infobox='1', language_id='1'  WHERE (information_id = 15 AND language_id = 1) ;
*/

/* SYNC TABLE : zones */
UPDATE zones SET zone_id='2091', zone_country_id='120', zone_code='ML', zone_name='Maryland.'  WHERE (zone_id = 2091) ;
UPDATE zones SET zone_id='3072', zone_country_id='172', zone_code='FLO', zone_name='Florida.'  WHERE (zone_id = 3072) ;

/* SYNC TABLE : zones_to_geo_zones */

/* SYNC TABLE : db_version */

delete from db_version where database_version = 'v2.5.0';
insert into db_version values('v2.5.1');


COMMIT;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
