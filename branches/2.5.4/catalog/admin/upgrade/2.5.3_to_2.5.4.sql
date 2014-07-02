/*
/* osCmax v2.5.3 to 2.5.4 Incremental Database Upgrade */
/**********************************************************************/
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

ALTER TABLE customers_wishlist CHANGE products_id products_id int(11);
ALTER TABLE customers_wishlist CHANGE customers_id customers_id int(11);
ALTER TABLE pm_configuration CHANGE pm_active pm_active tinyint(1);

CREATE TABLE orders_status_history_transactions (
  orders_status_history_id int(11) NOT NULL,
  transaction_id varchar(64) NOT NULL,
  transaction_type varchar(32) NOT NULL,
  payment_type varchar(32) NOT NULL,
  payment_status varchar(32) NOT NULL,
  transaction_amount decimal(7,2) NOT NULL,
  module_code varchar(32) NOT NULL,
  transaction_avs varchar(64) NOT NULL,
  transaction_cvv2 varchar(64) NOT NULL,
  transaction_msgs varchar(255) NOT NULL,
  PRIMARY KEY (orders_status_history_id),
  KEY transaction_id (transaction_id)
);

SET AUTOCOMMIT = 0;

INSERT INTO configuration VALUES (600, 'CT_POPUP_IMAGE_RESIZE', 'POPUP_IMAGE_RESIZE', 'true', 'CD_POPUP_IMAGE_RESIZE', '4', '3', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (601, 'CT_SMALL_IMAGE_COMPRESSION', 'SMALL_IMAGE_COMPRESSION', '75', 'CD_SMALL_IMAGE_COMPRESSION', '4', '7', NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES (602, 'CT_SUBCATEGORY_IMAGE_COMPRESSION', 'SUBCATEGORY_IMAGE_COMPRESSION', '75', 'CD_SUBCATEGORY_IMAGE_COMPRESSION', '4', '12', NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES (603, 'CT_PRODUCT_IMAGE_COMPRESSION', 'PRODUCT_IMAGE_COMPRESSION', '80', 'CD_PRODUCT_IMAGE_COMPRESSION', '4', '22', NULL, now(), NULL, NULL);
INSERT INTO configuration VALUES (604, 'CT_POPUP_IMAGE_COMPRESSION', 'POPUP_IMAGE_COMPRESSION', '85', 'CD_POPUP_IMAGE_COMPRESSION', '4', '26', NULL, now(), NULL, NULL);

INSERT INTO configuration VALUES (2641, 'CT_SLIDESHOW_COMPRESSION', 'SLIDESHOW_COMPRESSION', '85', 'CD_SLIDESHOW_COMPRESSION', 204, '25', NULL, now(), NULL, NULL);

/* SYNC TABLE : db_version */

UPDATE db_version SET database_version='v2.5.4u';


UPDATE configuration SET sort_order = 5,last_modified = now() WHERE configuration_id = 55;
UPDATE configuration SET sort_order = 6,last_modified = now() WHERE configuration_id = 56;
UPDATE configuration SET sort_order = 8,last_modified = now() WHERE configuration_id = 57;
UPDATE configuration SET sort_order = 9,last_modified = now() WHERE configuration_id = 58;
UPDATE configuration SET sort_order = 10,last_modified = now() WHERE configuration_id = 59;
UPDATE configuration SET sort_order = 11,last_modified = now() WHERE configuration_id = 60;
UPDATE configuration SET sort_order = 4,last_modified = now() WHERE configuration_id = 61;

UPDATE configuration SET sort_order = 2,last_modified = now() WHERE configuration_id = 2103;

UPDATE configuration SET configuration_group_id = 4,sort_order = 20,last_modified = now() WHERE configuration_id = 595;
UPDATE configuration SET configuration_group_id = 4,sort_order = 21,last_modified = now() WHERE configuration_id = 596;
UPDATE configuration SET configuration_group_id = 4,sort_order = 24,last_modified = now() WHERE configuration_id = 597;
UPDATE configuration SET configuration_group_id = 4,sort_order = 25,last_modified = now() WHERE configuration_id = 598;

UPDATE pm_configuration SET pm_active = 1,last_modified = now() WHERE pm_id = 1;
UPDATE pm_configuration SET pm_active = 1,last_modified = now() WHERE pm_id = 2;
UPDATE pm_configuration SET pm_active = 1,last_modified = now() WHERE pm_id = 3;
UPDATE pm_configuration SET pm_active = 1,last_modified = now() WHERE pm_id = 4;
UPDATE pm_configuration SET pm_active = 1,last_modified = now() WHERE pm_id = 5;
UPDATE pm_configuration SET pm_active = 1,last_modified = now() WHERE pm_id = 6;
UPDATE pm_configuration SET pm_active = 1,last_modified = now() WHERE pm_id = 7;
UPDATE pm_configuration SET pm_active = 1,last_modified = now() WHERE pm_id = 8;
UPDATE pm_configuration SET pm_active = 1,last_modified = now() WHERE pm_id = 9;
UPDATE pm_configuration SET pm_active = 1,last_modified = now() WHERE pm_id = 10;
UPDATE pm_configuration SET pm_active = 1,last_modified = now() WHERE pm_id = 11;
UPDATE pm_configuration SET pm_active = 1,last_modified = now() WHERE pm_id = 12;
UPDATE pm_configuration SET pm_active = 1,last_modified = now() WHERE pm_id = 13;
UPDATE pm_configuration SET pm_active = 1,last_modified = now() WHERE pm_id = 14;
UPDATE pm_configuration SET pm_active = 1,last_modified = now() WHERE pm_id = 15;
UPDATE pm_configuration SET pm_active = 1,last_modified = now() WHERE pm_id = 16;
UPDATE pm_configuration SET pm_active = 1,last_modified = now() WHERE pm_id = 17;
UPDATE pm_configuration SET pm_active = 1,last_modified = now() WHERE pm_id = 18;
UPDATE pm_configuration SET pm_active = 1,last_modified = now() WHERE pm_id = 19;

COMMIT;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
