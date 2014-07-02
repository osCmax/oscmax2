/*
/* osCmax v2.5.1 to 2.5.2 Database Upgrade */
/**********************************************************************/
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


/* Alter table in target */
ALTER TABLE orders 
	ADD COLUMN delivery_date DATETIME  NOT NULL after customers_address_format_id;

/* Alter table in target */
ALTER TABLE products 
	ADD COLUMN products_ship_sep tinyint(1) NOT NULL DEFAULT '0' after products_min_order_qty;

/* Alter table in target */
ALTER TABLE pm_configuration 
	ADD COLUMN pm_cg_hide varchar(255) NOT NULL after pm_page;

/* Alter table in target */
ALTER TABLE slideshow 
	ADD COLUMN slideshow_active varchar(3) NOT NULL after slideshow_target;
ALTER TABLE slideshow
	ADD COLUMN slideshow_cg_hide varchar(255) NOT NULL after slideshow_active;


SET AUTOCOMMIT = 0;

/* SYNC TABLE : configuration */
INSERT INTO configuration VALUES ('', 'CT_FORCE_CATALOG_LANGUAGE', 'FORCE_CATALOG_LANGUAGE', 'false', 'CD_FORCE_CATALOG_LANGUAGE', '1', '10', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\',  \'false\'), ');
INSERT INTO configuration VALUES ('', 'CT_FORCE_ADMIN_LANGUAGE', 'FORCE_ADMIN_LANGUAGE', 'false', 'CD_FORCE_ADMIN_LANGUAGE', '1', '10', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\',  \'false\'), ');
INSERT INTO configuration VALUES ('', 'CT_CHECKOUT_SHIPPING_DATE', 'CHECKOUT_SHIPPING_DATE', 'false', 'CD_CHECKOUT_SHIPPING_DATE', 5, '53', NULL , now(), NULL , 'tep_cfg_select_option(array(''true'', ''false''),' );
INSERT INTO configuration VALUES ('', 'CT_RECAPTCHA_EMAIL_URL', 'RECAPTCHA_EMAIL_URL', '', 'CD_RECAPTCHA_EMAIL_URL', 87, 4, NULL, now(), NULL, 'tep_cfg_textarea(');
INSERT INTO configuration VALUES ('', 'CT_RECAPTCHA_EMAIL_FROM', 'RECAPTCHA_EMAIL_FROM', 'CLICK', 'CD_RECAPTCHA_EMAIL_FROM', 87, 5, NULL, now(), NULL, NULL);


/* SYNC TABLE : db_version */

UPDATE db_version SET database_version='v2.5.2';


COMMIT;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
