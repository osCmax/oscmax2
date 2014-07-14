/*
/* osCmax v2.5 RC2 to 2.5.0-Stable Database Upgrade  */
/*********************************************************************/
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


/* Alter table in target */
ALTER TABLE products 
	CHANGE products_length products_length decimal(6,2)   NOT NULL DEFAULT '12.00' after products_ordered, 
	CHANGE products_width products_width decimal(6,2)   NOT NULL DEFAULT '12.00' after products_length, 
	CHANGE products_height products_height decimal(6,2)   NOT NULL DEFAULT '12.00' after products_width, 
	CHANGE products_ready_to_ship products_ready_to_ship int(1)   NOT NULL DEFAULT '0' after products_height, 
	CHANGE products_hide_from_groups products_hide_from_groups varchar(255)  NOT NULL DEFAULT '@' after products_ready_to_ship, 
	CHANGE products_qty_blocks products_qty_blocks int(4)   NOT NULL DEFAULT '1' after products_hide_from_groups, 
	CHANGE products_min_order_qty products_min_order_qty int(4)   NOT NULL DEFAULT '1' after products_qty_blocks, 
	DROP COLUMN products_ship_price;


/* Create table in target */
CREATE TABLE products_shipping(
	products_id int(11) NOT NULL  DEFAULT '0' , 
	products_ship_methods_id int(11) NULL  , 
	products_ship_zip varchar(32) NULL  , 
	products_ship_price varchar(10) NULL  , 
	products_ship_price_two varchar(10) NULL  
) ;

SET AUTOCOMMIT = 0;


/* SYNC TABLE : admin_files */

	/*Start of batch : 1 */
INSERT INTO admin_files VALUES ('', 'paypal_wpp_refund.php', 'FILE_PAYPAL', '0', '5', '1,2', '99');
INSERT INTO admin_files VALUES ('', 'paypal_wpp_charge.php', 'FILE_PAYPAL', '0', '5', '1,2', '99');
INSERT INTO admin_files VALUES ('', 'paypal_wpp_capture.php', 'FILE_PAYPAL', '0', '5', '1,2', '99');
INSERT INTO admin_files VALUES ('', 'configuration.php?gID=47', 'BOX_CONFIGURATION_CLOUDZOOM', '0', '2', '1', '7');
INSERT INTO admin_files VALUES ('', 'configuration.php?gID=46', 'BOX_CONFIGURATION_SLIMBOX', '0', '2', '1', '7');
INSERT INTO admin_files VALUES ('', 'stats_keywords.php', 'BOX_REPORTS_KEYWORDS', '0', '8', '1', '10');
INSERT INTO admin_files VALUES ('', 'paypal_wpp_include.php', 'FILE_PAYPAL', '0', '5', '1,2', '99');
	/*End   of batch : 1 */

/* SYNC TABLE : configuration */

	/*Start of batch : 1 */
INSERT INTO configuration VALUES ('', 'CT_INDIVIDUAL_SHIP_INCREASE', 'INDIVIDUAL_SHIP_INCREASE', '3', 'CD_INDIVIDUAL_SHIP_INCREASE', '7', NULL, NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES ('', 'CT_INDIVIDUAL_SHIP_HOME_COUNTRY', 'INDIVIDUAL_SHIP_HOME_COUNTRY', '223', 'CD_INDIVIDUAL_SHIP_HOME_COUNTRY', '7', NULL, NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES ('', 'CT_CLOUDZOOM_TITLEOPACITY', 'CLOUDZOOM_TITLEOPACITY', '0.5', 'CD_CLOUDZOOM_TITLEOPACITY', '47', '13', NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES ('', 'CT_CLOUDZOOM_SHOWTITLE', 'CLOUDZOOM_SHOWTITLE', 'true', 'CD_CLOUDZOOM_SHOWTITLE', '47', '12', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES ('', 'CT_CLOUDZOOM_SMOOTHMOVE', 'CLOUDZOOM_SMOOTHMOVE', '3', 'CD_CLOUDZOOM_SMOOTHMOVE', '47', '11', NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES ('', 'CT_CLOUDZOOM_SOFTFOCUS', 'CLOUDZOOM_SOFTFOCUS', 'false', 'CD_CLOUDZOOM_SOFTFOCUS', '47', '10', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES ('', 'CT_CLOUDZOOM_LENSOPACITY', 'CLOUDZOOM_LENSOPACITY', '0.5', 'CD_CLOUDZOOM_LENSOPACITY', '47', '9', NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES ('', 'CT_CLOUDZOOM_TINTOPACITY', 'CLOUDZOOM_TINTOPACITY', '0.5', 'CD_CLOUDZOOM_TINTOPACITY', '47', '8', NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES ('', 'CT_CLOUDZOOM_TINT', 'CLOUDZOOM_TINT', 'false', 'CD_CLOUDZOOM_TINT', '47', '7', NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES ('', 'CT_CLOUDZOOM_ADJUSTY', 'CLOUDZOOM_ADJUSTY', '-4', 'CD_CLOUDZOOM_ADJUSTY', '47', '6', NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES ('', 'CT_CLOUDZOOM_ADJUSTX', 'CLOUDZOOM_ADJUSTX', '10', 'CD_CLOUDZOOM_ADJUSTX', '47', '5', NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES ('', 'CT_CLOUDZOOM_POSITION', 'CLOUDZOOM_POSITION', 'right', 'CD_CLOUDZOOM_POSITION', '47', '4', NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES ('', 'CT_CLOUDZOOM_HEIGHT', 'CLOUDZOOM_HEIGHT', 'auto', 'CD_CLOUDZOOM_HEIGHT', '47', '3', NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES ('', 'CT_CLOUDZOOM_WIDTH', 'CLOUDZOOM_WIDTH', 'auto', 'CD_CLOUDZOOM_WIDTH', '47', '2', NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES ('', 'CT_STOCK_SET_INACTIVE', 'STOCK_SET_INACTIVE', 'false', 'CD_STOCK_SET_INACTIVE', '9', '9', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
UPDATE configuration SET configuration_id='2643', set_function='tep_cfg_select_option(array(\'US\', \'AUS\', \'UK\'), '  WHERE (configuration_id = 2643) ;
UPDATE configuration SET configuration_id='2508', configuration_title='CT_STOCK_IMAGE_SWITCH', configuration_key='STOCK_IMAGE_SWITCH', configuration_description='CD_STOCK_IMAGE_SWITCH', configuration_group_id='9', sort_order='6', last_modified= now(), use_function=NULL, set_function='tep_cfg_select_option(array(\'true\', \'false\'),'  WHERE (configuration_id = 2508) ;
UPDATE configuration SET configuration_id='1159', configuration_title='CT_SLIMBOX_COUNTER', configuration_key='SLIMBOX_COUNTER', configuration_description='CD_SLIMBOX_COUNTER', configuration_group_id='46', sort_order='39', last_modified= now(), use_function=NULL, set_function=NULL  WHERE (configuration_id = 1159) ;
UPDATE configuration SET configuration_id='1158', configuration_title='CT_SLIMBOX_CAPTION', configuration_key='SLIMBOX_CAPTION', configuration_description='CD_SLIMBOX_CAPTION', configuration_group_id='46', sort_order='38', last_modified= now(), use_function=NULL, set_function=NULL  WHERE (configuration_id = 1158) ;
UPDATE configuration SET configuration_id='1157', configuration_title='CT_SLIMBOX_IMAGE', configuration_key='SLIMBOX_IMAGE', configuration_description='CD_SLIMBOX_IMAGE', configuration_group_id='46', sort_order='37', last_modified= now(), use_function=NULL, set_function=NULL  WHERE (configuration_id = 1157) ;
UPDATE configuration SET configuration_id='1156', configuration_title='CT_SLIMBOX_HEIGHT', configuration_key='SLIMBOX_HEIGHT', configuration_description='CD_SLIMBOX_HEIGHT', configuration_group_id='46', sort_order='36', last_modified= now(), use_function=NULL, set_function=NULL  WHERE (configuration_id = 1156) ;
UPDATE configuration SET configuration_id='1155', configuration_title='CT_SLIMBOX_WIDTH', configuration_key='SLIMBOX_WIDTH', configuration_description='CD_SLIMBOX_WIDTH', configuration_group_id='46', sort_order='35', last_modified= now(), use_function=NULL, set_function=NULL  WHERE (configuration_id = 1155) ;
UPDATE configuration SET configuration_id='1154', configuration_title='CT_SLIMBOX_EASING', configuration_key='SLIMBOX_EASING', configuration_description='CD_SLIMBOX_EASING', configuration_group_id='46', sort_order='34', last_modified= now(), use_function=NULL, set_function=NULL  WHERE (configuration_id = 1154) ;
UPDATE configuration SET configuration_id='1153', configuration_title='CT_SLIMBOX_RESIZE', configuration_key='SLIMBOX_RESIZE', configuration_description='CD_SLIMBOX_RESIZE', configuration_group_id='46', sort_order='33', last_modified= now(), use_function=NULL, set_function=NULL  WHERE (configuration_id = 1153) ;
UPDATE configuration SET configuration_id='1152', configuration_title='CT_SLIMBOX_FADE', configuration_key='SLIMBOX_FADE', configuration_description='CD_SLIMBOX_FADE', configuration_group_id='46', sort_order='32', last_modified= now(), use_function=NULL, set_function=NULL  WHERE (configuration_id = 1152) ;
UPDATE configuration SET configuration_id='1151', configuration_title='CT_SLIMBOX_OPACITY', configuration_key='SLIMBOX_OPACITY', configuration_description='CD_SLIMBOX_OPACITY', configuration_group_id='46', sort_order='31', last_modified= now(), use_function=NULL, set_function=NULL  WHERE (configuration_id = 1151) ;
UPDATE configuration SET configuration_id='1150', configuration_title='CT_SLIMBOX_LOOP', configuration_key='SLIMBOX_LOOP', configuration_description='CD_SLIMBOX_LOOP', configuration_group_id='46', sort_order='30', last_modified= now(), use_function=NULL, set_function=NULL  WHERE (configuration_id = 1150) ;
UPDATE configuration SET configuration_id='593', configuration_title='CT_PRODINFO_ATTRIBUTE_NO_ADD_OUT_OF_STOCK', configuration_key='PRODINFO_ATTRIBUTE_NO_ADD_OUT_OF_STOCK', configuration_description='CD_PRODINFO_ATTRIBUTE_NO_ADD_OUT_OF_STOCK', configuration_group_id='9', sort_order='8', last_modified= now(), use_function=NULL, set_function='tep_cfg_select_option(array(\'true\', \'false\'),'  WHERE (configuration_id = 593) ;
UPDATE configuration SET configuration_id='497', configuration_title='CT_IMAGEZOOMER', configuration_key='IMAGEZOOMER', configuration_description='CD_IMAGEZOOMER', configuration_group_id='47', sort_order='1', last_modified= now(), use_function=NULL, set_function='tep_cfg_select_option(array(\'true\', \'false\'),'  WHERE (configuration_id = 497) ;
UPDATE configuration SET configuration_id='143', configuration_title='CT_SESSION_RECREATE', configuration_key='SESSION_RECREATE', configuration_value='True', configuration_description='CD_SESSION_RECREATE', configuration_group_id='15', sort_order='7', last_modified= now(), use_function=NULL, set_function='tep_cfg_select_option(array(\'True\', \'False\'),'  WHERE (configuration_id = 143) ;
	/*End   of batch : 1 */
/* SYNC TABLE : configuration_group */

	/*Start of batch : 1 */
INSERT INTO configuration_group VALUES ('47', 'BOX_CONFIGURATION_CLOUDZOOM', 'The options which configure CloudZoom.', '47', '1');
INSERT INTO configuration_group VALUES ('46', 'BOX_CONFIGURATION_SLIMBOX', 'The options which configure Slimbox.', '46', '1');
	/*End   of batch : 1 */

/* SYNC TABLE : zones */

	/*Start of batch : 6 */
INSERT INTO zones VALUES ('', '239', 'MD', 'Midlands');
	/*End   of batch : 6 */

/* SYNC TABLE : db_version */

delete from db_version where database_version = 'v2.5_RC2';
insert into db_version values('v2.5.0');


COMMIT;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
