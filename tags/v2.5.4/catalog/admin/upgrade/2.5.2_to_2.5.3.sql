/*
/* osCmax v2.5.2 to 2.5.3 Incremental Database Upgrade */
/**********************************************************************/
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/* Alter table in target */
ALTER TABLE affiliate_affiliate 
	CHANGE affiliate_date_of_last_logon affiliate_date_of_last_logon datetime NOT NULL DEFAULT '0001-01-01 01:01:01' after affiliate_payment_bank_account_number, 
	CHANGE affiliate_date_account_created affiliate_date_account_created datetime NOT NULL DEFAULT '0001-01-01 01:01:01' after affiliate_number_of_logons, 
	CHANGE affiliate_date_account_last_modified affiliate_date_account_last_modified datetime NOT NULL DEFAULT '0001-01-01 01:01:01' after affiliate_date_account_created;

/* Alter table in target */
ALTER TABLE affiliate_banners 
	CHANGE affiliate_date_added affiliate_date_added datetime NOT NULL DEFAULT '0001-01-01 01:01:01' after affiliate_date_scheduled;

/* Alter table in target */
ALTER TABLE affiliate_banners_history 
	CHANGE affiliate_banners_history_date affiliate_banners_history_date date NOT NULL DEFAULT '0001-01-01' after affiliate_banners_clicks;

/* Alter table in target */
ALTER TABLE affiliate_clickthroughs 
	CHANGE affiliate_clientdate affiliate_clientdate datetime NOT NULL DEFAULT '0001-01-01 01:01:01' after affiliate_id;

/* Alter table in target */
ALTER TABLE affiliate_news 
	CHANGE date_added date_added datetime NOT NULL DEFAULT '0001-01-01 01:01:01' after news_id;

/* Alter table in target */
ALTER TABLE affiliate_newsletters 
	CHANGE date_added date_added datetime NOT NULL DEFAULT '0001-01-01 01:01:01' after module;

/* Alter table in target */
ALTER TABLE affiliate_payment 
	CHANGE affiliate_payment_date affiliate_payment_date datetime NOT NULL DEFAULT '0001-01-01 01:01:01' after affiliate_payment_total, 
	CHANGE affiliate_payment_last_modified affiliate_payment_last_modified datetime NOT NULL DEFAULT '0001-01-01 01:01:01' after affiliate_payment_date, 
	CHANGE affiliate_last_modified affiliate_last_modified datetime NOT NULL DEFAULT '0001-01-01 01:01:01' after affiliate_address_format_id;

/* Alter table in target */
ALTER TABLE affiliate_payment_status_history 
	CHANGE affiliate_date_added affiliate_date_added datetime NOT NULL DEFAULT '0001-01-01 01:01:01' after affiliate_old_value;

/* Alter table in target */
ALTER TABLE affiliate_sales 
	CHANGE affiliate_date affiliate_date datetime NOT NULL DEFAULT '0001-01-01 01:01:01' after affiliate_id;

/* Alter table in target */
ALTER TABLE coupon_redeem_track 
	CHANGE redeem_date redeem_date datetime NOT NULL DEFAULT '0001-01-01 01:01:01' after customer_id;

/* Alter table in target */
ALTER TABLE coupons 
	CHANGE coupon_start_date coupon_start_date datetime NOT NULL DEFAULT '0001-01-01 01:01:01' after coupon_minimum_order, 
	CHANGE coupon_expire_date coupon_expire_date datetime NOT NULL DEFAULT '0001-01-01 01:01:01' after coupon_start_date, 
	ADD COLUMN coupon_exclude_cg varchar(32) NOT NULL after restrict_to_categories, 
	CHANGE restrict_to_customers restrict_to_customers text  NULL after coupon_exclude_cg, 
	CHANGE coupon_active coupon_active char(1) NOT NULL DEFAULT 'Y' after restrict_to_customers, 
	CHANGE date_created date_created datetime NOT NULL DEFAULT '0001-01-01 01:01:01' after coupon_active, 
	CHANGE date_modified date_modified datetime NOT NULL DEFAULT '0001-01-01 01:01:01' after date_created;

/* Alter table in target */
ALTER TABLE customers 
	CHANGE customers_dob customers_dob datetime NOT NULL DEFAULT '0001-01-01 01:01:01' after customers_lastname;

/* Create table in target */
CREATE TABLE customers_to_extra_fields(
	customers_id int(11) NOT NULL DEFAULT '0' , 
	fields_id int(11) NOT NULL DEFAULT '0' , 
	value text NULL  
) ;


/* Create table in target */
CREATE TABLE extra_fields(
	fields_id int(11) NOT NULL  auto_increment , 
	fields_input_type int(11) NOT NULL DEFAULT '0' , 
	fields_input_value text NOT NULL  , 
	fields_status tinyint(2) NOT NULL DEFAULT '0' , 
	fields_required_status tinyint(2) NOT NULL DEFAULT '0' , 
	fields_size int(5) NOT NULL DEFAULT '0' , 
	fields_cef_cg_hide varchar(255) NOT NULL  , 
	PRIMARY KEY (fields_id) 
) ;


/* Create table in target */
CREATE TABLE extra_fields_info(
	fields_id int(11) NOT NULL DEFAULT '0' , 
	languages_id int(11) NOT NULL DEFAULT '0' , 
	fields_name varchar(32) NOT NULL DEFAULT '' 
) ;


/* Alter table in target */
ALTER TABLE information 
	ADD COLUMN info_cg_hide varchar(255) DEFAULT NULL after language_id;

/* Alter table in target */
ALTER TABLE shipping_manifest 
	CHANGE pickup_date pickup_date date NOT NULL DEFAULT '0001-01-01' after oversized;

/* Alter table in target */
ALTER TABLE specials 
	CHANGE specials_new_products_price specials_new_products_price decimal(15,5)   NOT NULL after products_id;

/* Alter table in target */
ALTER TABLE theme_configuration 
	CHANGE date_added date_added datetime NOT NULL DEFAULT '0001-01-01 01:01:01' after last_modified;


SET AUTOCOMMIT = 0;

/* SYNC TABLE : address_format */

UPDATE address_format SET address_format_id='6', address_format='$firstname $lastname$cr$streets$cr$city$cr$state$cr$postcode$cr$country', address_summary='$city / $country'  WHERE (address_format_id = 6) ;

/* SYNC TABLE : admin_files */

INSERT INTO admin_files VALUES ('', 'customers_extra_fields.php', 'BOX_CUSTOMERS_EXTRA_FIELDS_MANAGER', '0', '5', '1', '0');

/* SYNC TABLE : configuration */

INSERT INTO configuration VALUES ('', 'CT_SEND_ALL_EMAIL_COPY_TO', 'SEND_ALL_EMAIL_COPY_TO', '', 'CD_SEND_ALL_EMAIL_COPY_TO', '1', '13', NULL, '0001-01-01 01:01:01', NULL, NULL);
INSERT INTO configuration VALUES ('', 'CT_RECAPTCHA_WISHLIST', 'RECAPTCHA_WISHLIST', 'true', 'CD_RECAPTCHA_WISHLIST', '87', '10', NULL, '0001-01-01 01:01:01', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES ('', 'CT_RECAPTCHA_PRODUCT_REVIEWS_WRITE', 'RECAPTCHA_PRODUCT_REVIEWS_WRITE', 'true', 'CD_RECAPTCHA_PRODUCT_REVIEWS_WRITE', '87', '9', NULL, '0001-01-01 01:01:01', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES ('', 'CT_RECAPTCHA_STYLE', 'RECAPTCHA_STYLE', 'white', 'CD_RECAPTCHA_STYLE', '87', '2', NULL, '0001-01-01 01:01:01', NULL, 'tep_cfg_select_option(array(\'white\', \'red\', \'blackglass\',\'clean\',\'custom\'),');
INSERT INTO configuration VALUES ('', 'CT_RECAPTCHA_CONTACT_US', 'RECAPTCHA_CONTACT_US', 'true', 'CD_RECAPTCHA_CONTACT_US', '87', '8', NULL, '0001-01-01 01:01:01', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES ('', 'CT_RECAPTCHA_CREATE_ACCOUNT', 'RECAPTCHA_CREATE_ACCOUNT', 'true', 'CD_RECAPTCHA_CREATE_ACCOUNT', '87', '7', NULL, '0001-01-01 01:01:01', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES ('', 'CT_ACCOUNT_EMAIL_CONFIRMATION', 'ACCOUNT_EMAIL_CONFIRMATION', 'false', 'CD_ACCOUNT_EMAIL_CONFIRMATION', '5', '6', NULL, '0001-01-01 01:01:01', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES ('', 'CT_CODE_SUFFIX_SEPERATOR', 'CODE_SUFFIX_SEPERATOR', '-', 'CD_CODE_SUFFIX_SEPERATOR', '1', '27', NULL, '0001-01-01 01:01:01', NULL, NULL);

/* SYNC TABLE : db_version */

UPDATE db_version SET database_version='v2.5.3';

/* SYNC TABLE : zones */

UPDATE zones SET zone_id='1269', zone_country_id='75', zone_code='SA', zone_name='Sa'  WHERE (zone_id = 1269) ;
INSERT INTO zones VALUES ('4314', '222', 'Londonderry', 'Londonderry');
INSERT INTO zones VALUES ('4312', '222', 'Down', 'Down');
INSERT INTO zones VALUES ('4311', '222', 'Armagh', 'Armagh');
INSERT INTO zones VALUES ('4310', '222', 'Antrim', 'Antrim');
INSERT INTO zones VALUES ('4313', '222', 'Fermanagh', 'Fermanagh');
INSERT INTO zones VALUES ('4315', '222', 'Tyrone', 'Tyrone');


COMMIT;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
