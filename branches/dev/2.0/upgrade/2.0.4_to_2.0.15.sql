# Upgrade database - osCMax v2.0.4 to v2.0.15 
#
# PLEASE PLEASE PLEASE make sure you have backup your database before using this script
# 
#
# It is higly suggested that you first try this script on a TEST version or copy of your store - not a LIVE/Production.
#
#
#
# Run this file in you phpmyadmin in your store database
#
#


#
# NEW TABLES
#
# No New Tables in this release
#
# CHANGED TABLES
#

ALTER TABLE affiliate_affiliate 
	CHANGE affiliate_gender affiliate_gender char(1)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_id, 
	CHANGE affiliate_firstname affiliate_firstname varchar(32)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_gender, 
	CHANGE affiliate_lastname affiliate_lastname varchar(32)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_firstname, 
	CHANGE affiliate_dob affiliate_dob datetime   NOT NULL DEFAULT '0000-00-00 00:00:00' after affiliate_lastname, 
	CHANGE affiliate_email_address affiliate_email_address varchar(96)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_dob, 
	CHANGE affiliate_telephone affiliate_telephone varchar(32)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_email_address, 
	CHANGE affiliate_fax affiliate_fax varchar(32)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_telephone, 
	CHANGE affiliate_password affiliate_password varchar(40)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_fax, 
	CHANGE affiliate_homepage affiliate_homepage varchar(96)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_password, 
	CHANGE affiliate_street_address affiliate_street_address varchar(64)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_homepage, 
	CHANGE affiliate_suburb affiliate_suburb varchar(64)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_street_address, 
	CHANGE affiliate_city affiliate_city varchar(32)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_suburb, 
	CHANGE affiliate_postcode affiliate_postcode varchar(10)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_city, 
	CHANGE affiliate_state affiliate_state varchar(32)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_postcode, 
	CHANGE affiliate_company affiliate_company varchar(60)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_agb, 
	CHANGE affiliate_company_taxid affiliate_company_taxid varchar(64)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_company, 
	CHANGE affiliate_payment_check affiliate_payment_check varchar(100)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_commission_percent, 
	CHANGE affiliate_payment_paypal affiliate_payment_paypal varchar(64)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_payment_check, 
	CHANGE affiliate_payment_bank_name affiliate_payment_bank_name varchar(64)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_payment_paypal, 
	CHANGE affiliate_payment_bank_branch_number affiliate_payment_bank_branch_number varchar(64)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_payment_bank_name, 
	CHANGE affiliate_payment_bank_swift_code affiliate_payment_bank_swift_code varchar(64)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_payment_bank_branch_number, 
	CHANGE affiliate_payment_bank_account_name affiliate_payment_bank_account_name varchar(64)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_payment_bank_swift_code, 
	CHANGE affiliate_payment_bank_account_number affiliate_payment_bank_account_number varchar(64)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_payment_bank_account_name, COMMENT='';


ALTER TABLE affiliate_banners 
	CHANGE affiliate_banners_title affiliate_banners_title varchar(64)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_banners_id, 
	CHANGE affiliate_banners_image affiliate_banners_image varchar(64)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_category_id, 
	CHANGE affiliate_banners_group affiliate_banners_group varchar(10)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_banners_image, COMMENT='';


ALTER TABLE affiliate_news 
	ADD COLUMN headline varchar(255)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after news_id, 
	ADD COLUMN content text  COLLATE latin1_swedish_ci NOT NULL after headline, 
	CHANGE date_added date_added datetime   NOT NULL DEFAULT '0000-00-00 00:00:00' after content, 
	CHANGE news_status news_status tinyint(1)   NOT NULL DEFAULT '0' after date_added, COMMENT='';


ALTER TABLE affiliate_news_contents 
	CHANGE affiliate_news_headlines affiliate_news_headlines varchar(255)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_news_languages_id, COMMENT='';


ALTER TABLE affiliate_payment 
	CHANGE affiliate_firstname affiliate_firstname varchar(32)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_payment_status, 
	CHANGE affiliate_lastname affiliate_lastname varchar(32)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_firstname, 
	CHANGE affiliate_street_address affiliate_street_address varchar(64)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_lastname, 
	CHANGE affiliate_suburb affiliate_suburb varchar(64)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_street_address, 
	CHANGE affiliate_city affiliate_city varchar(32)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_suburb, 
	CHANGE affiliate_postcode affiliate_postcode varchar(10)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_city, 
	CHANGE affiliate_company affiliate_company varchar(60)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_country, COMMENT='';


ALTER TABLE affiliate_payment_status 
	CHANGE affiliate_payment_status_name affiliate_payment_status_name varchar(32)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_language_id, COMMENT='';


ALTER TABLE affiliate_sales 
	CHANGE affiliate_browser affiliate_browser varchar(100)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_date, 
	CHANGE affiliate_ipaddress affiliate_ipaddress varchar(20)  COLLATE latin1_swedish_ci NOT NULL DEFAULT '' after affiliate_browser, 
	CHANGE affiliate_payment_date affiliate_payment_date datetime   NOT NULL DEFAULT '0000-00-00 00:00:00' after affiliate_billing_status, COMMENT='';


ALTER TABLE countries 
	ADD COLUMN active tinyint(3) unsigned   NULL DEFAULT '0' after address_format_id, COMMENT='';


ALTER TABLE customers 
	ADD COLUMN guest_account tinyint(1)   NOT NULL DEFAULT '0' after customers_newsletter, 
	CHANGE customers_login customers_login varchar(96)  COLLATE latin1_swedish_ci NULL after guest_account, 
	CHANGE customers_group_name customers_group_name varchar(27)  COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Retail' after customers_login, 
	CHANGE customers_group_id customers_group_id int(11)   NOT NULL DEFAULT '0' after customers_group_name, 
	CHANGE customers_group_ra customers_group_ra enum('0','1')  COLLATE latin1_swedish_ci NOT NULL DEFAULT '0' after customers_group_id, 
	CHANGE customers_payment_allowed customers_payment_allowed varchar(255)  COLLATE latin1_swedish_ci NOT NULL after customers_group_ra, 
	CHANGE customers_shipment_allowed customers_shipment_allowed varchar(255)  COLLATE latin1_swedish_ci NOT NULL after customers_payment_allowed, COMMENT='';


ALTER TABLE customers_wishlist 
	CHANGE products_id products_id tinytext  COLLATE latin1_swedish_ci NOT NULL first, 
	CHANGE customers_id customers_id int(13)   NOT NULL DEFAULT '0' after products_id, 
	DROP COLUMN products_model, 
	DROP COLUMN products_name, 
	DROP COLUMN products_price, 
	DROP COLUMN final_price, 
	DROP COLUMN products_quantity, 
	DROP COLUMN wishlist_name, COMMENT='';


ALTER TABLE whos_online 
	ADD COLUMN hostname varchar(255)  COLLATE latin1_swedish_ci NOT NULL after ip_address, 
	ADD COLUMN country_code varchar(2)  COLLATE latin1_swedish_ci NOT NULL after hostname, 
	ADD COLUMN country_name varchar(64)  COLLATE latin1_swedish_ci NOT NULL after country_code, 
	ADD COLUMN region_name varchar(64)  COLLATE latin1_swedish_ci NOT NULL after country_name, 
	ADD COLUMN city varchar(64)  COLLATE latin1_swedish_ci NOT NULL after region_name, 
	ADD COLUMN latitude float   NOT NULL after city, 
	ADD COLUMN longitude float   NOT NULL after latitude, 
	CHANGE time_entry time_entry varchar(14)  COLLATE latin1_swedish_ci NOT NULL after longitude, 
	CHANGE time_last_click time_last_click varchar(14)  COLLATE latin1_swedish_ci NOT NULL after time_entry, 
	CHANGE last_page_url last_page_url text  COLLATE latin1_swedish_ci NOT NULL after time_last_click, 
	ADD COLUMN http_referer varchar(255)  COLLATE latin1_swedish_ci NOT NULL after last_page_url, 
	ADD COLUMN user_agent varchar(255)  COLLATE latin1_swedish_ci NOT NULL after http_referer, 
	ADD KEY idx_country_code(country_code), 
	ADD KEY idx_ip_address(ip_address), COMMENT='';


#
# DELETED TABLE VALUES
#

DELETE FROM `configuration`  WHERE (`configuration_id` = 498) ;
DELETE FROM `configuration`  WHERE (`configuration_id` = 651) ;
DELETE FROM `configuration`  WHERE (`configuration_id` = 652) ;
DELETE FROM `configuration`  WHERE (`configuration_id` = 11) ;

DELETE FROM `configuration_group`  WHERE (`configuration_group_id` = 75) ;
DELETE FROM `configuration_group`  WHERE (`configuration_group_id` = 40) ;


#
# UPDATED TABLE VALUES
#

UPDATE `configuration` SET `configuration_id`='55', `configuration_title`='Small Image Width', `configuration_key`='SMALL_IMAGE_WIDTH', `configuration_value`='120', `configuration_description`='The pixel width of small images', `configuration_group_id`='4', `sort_order`='1', `last_modified`=NULL, `date_added`='2010-02-08 18:53:47', `use_function`=NULL, `set_function`=NULL  WHERE (`configuration_id` = 55) ;
UPDATE `configuration` SET `configuration_id`='56', `configuration_title`='Small Image Height', `configuration_key`='SMALL_IMAGE_HEIGHT', `configuration_value`='', `configuration_description`='The pixel height of small images', `configuration_group_id`='4', `sort_order`='2', `last_modified`=NULL, `date_added`='2010-02-08 18:53:47', `use_function`=NULL, `set_function`=NULL  WHERE (`configuration_id` = 56) ;
UPDATE `configuration` SET `configuration_id`='57', `configuration_title`='Heading Image Width', `configuration_key`='HEADING_IMAGE_WIDTH', `configuration_value`='100', `configuration_description`='The pixel width of heading images', `configuration_group_id`='4', `sort_order`='3', `last_modified`=NULL, `date_added`='2010-02-08 18:53:47', `use_function`=NULL, `set_function`=NULL  WHERE (`configuration_id` = 57) ;
UPDATE `configuration` SET `configuration_id`='58', `configuration_title`='Heading Image Height', `configuration_key`='HEADING_IMAGE_HEIGHT', `configuration_value`='', `configuration_description`='The pixel height of heading images', `configuration_group_id`='4', `sort_order`='4', `last_modified`=NULL, `date_added`='2010-02-08 18:53:47', `use_function`=NULL, `set_function`=NULL  WHERE (`configuration_id` = 58) ;
UPDATE `configuration` SET `configuration_id`='59', `configuration_title`='Subcategory Image Width', `configuration_key`='SUBCATEGORY_IMAGE_WIDTH', `configuration_value`='100', `configuration_description`='The pixel width of subcategory images', `configuration_group_id`='4', `sort_order`='5', `last_modified`=NULL, `date_added`='2010-02-08 18:53:47', `use_function`=NULL, `set_function`=NULL  WHERE (`configuration_id` = 59) ;
UPDATE `configuration` SET `configuration_id`='60', `configuration_title`='Subcategory Image Height', `configuration_key`='SUBCATEGORY_IMAGE_HEIGHT', `configuration_value`='', `configuration_description`='The pixel height of subcategory images', `configuration_group_id`='4', `sort_order`='6', `last_modified`=NULL, `date_added`='2010-02-08 18:53:47', `use_function`=NULL, `set_function`=NULL  WHERE (`configuration_id` = 60) ;
UPDATE `configuration` SET `configuration_id`='61', `configuration_title`='Calculate Image Size', `configuration_key`='CONFIG_CALCULATE_IMAGE_SIZE', `configuration_value`='true', `configuration_description`='Calculate the size of images?', `configuration_group_id`='4', `sort_order`='7', `last_modified`=NULL, `date_added`='2010-02-08 18:53:47', `use_function`=NULL, `set_function`='tep_cfg_select_option(array(\'true\', \'false\'),'  WHERE (`configuration_id` = 61) ;
UPDATE `configuration` SET `configuration_id`='62', `configuration_title`='Image Required', `configuration_key`='IMAGE_REQUIRED', `configuration_value`='true', `configuration_description`='Enable to display broken images. Good for development.', `configuration_group_id`='4', `sort_order`='8', `last_modified`=NULL, `date_added`='2010-02-08 18:53:47', `use_function`=NULL, `set_function`='tep_cfg_select_option(array(\'true\', \'false\'),'  WHERE (`configuration_id` = 62) ;
UPDATE `configuration` SET `configuration_id`='499', `configuration_title`='Big Images Directory', `configuration_key`='DYNAMIC_MOPICS_BIGIMAGES_DIR', `configuration_value`='images_big/', `configuration_description`='The directory inside catalog/images where your big images are stored.', `configuration_group_id`='45', `sort_order`='0', `last_modified`=NULL, `date_added`='2010-02-08 18:53:48', `use_function`=NULL, `set_function`=NULL  WHERE (`configuration_id` = 499) ;
UPDATE `configuration` SET `configuration_id`='500', `configuration_title`='Thumbnail Images Directory', `configuration_key`='DYNAMIC_MOPICS_THUMBS_DIR', `configuration_value`='thumbs/', `configuration_description`='The directory inside catalog/images where you extra image thumbs are stored.', `configuration_group_id`='45', `sort_order`='0', `last_modified`=NULL, `date_added`='2010-02-08 18:53:48', `use_function`=NULL, `set_function`=NULL  WHERE (`configuration_id` = 500) ;
UPDATE `configuration` SET `configuration_id`='501', `configuration_title`='Main Thumbnail In \"Thumbnail Images Directory\"', `configuration_key`='DYNAMIC_MOPICS_MAINTHUMB_IN_THUMBS_DIR', `configuration_value`='false', `configuration_description`='If you store your product\'s main thumbnail in the \"Thumbnail Images Directory\" set this to true.  If it is in the main image directory (uploaded via osCommerce admin),set it false.', `configuration_group_id`='45', `sort_order`='0', `last_modified`=NULL, `date_added`='2010-02-08 18:53:48', `use_function`=NULL, `set_function`='tep_cfg_select_option(array(\'true\', \'false\'),'  WHERE (`configuration_id` = 501) ;
UPDATE `configuration` SET `configuration_id`='502', `configuration_title`='Extra Image Pattern', `configuration_key`='DYNAMIC_MOPICS_PATTERN', `configuration_value`='imagebase_{1}', `configuration_description`='Your custom defined pattern for extra images.  imagebase is the base of the main thumbnail.  Place the counting method between brackets {}.  Current counting methods can be 1,a,or A.  See readme for more information.', `configuration_group_id`='45', `sort_order`='0', `last_modified`=NULL, `date_added`='2010-02-08 18:53:48', `use_function`=NULL, `set_function`=NULL  WHERE (`configuration_id` = 502) ;
UPDATE `configuration` SET `configuration_id`='503', `configuration_title`='Thumbnail Image Types', `configuration_key`='DYNAMIC_MOPICS_THUMB_IMAGE_TYPES', `configuration_value`='jpg,gif,jpeg,png', `configuration_description`='The types (extensions) of extra thumbnails you use,seperated by commas.', `configuration_group_id`='45', `sort_order`='0', `last_modified`=NULL, `date_added`='2010-02-08 18:53:48', `use_function`=NULL, `set_function`=NULL  WHERE (`configuration_id` = 503) ;
UPDATE `configuration` SET `configuration_id`='504', `configuration_title`='Big Image Types', `configuration_key`='DYNAMIC_MOPICS_BIG_IMAGE_TYPES', `configuration_value`='jpg,gif,jpeg,png', `configuration_description`='The types (extensions) of big images you use,seperated by commas.', `configuration_group_id`='45', `sort_order`='0', `last_modified`=NULL, `date_added`='2010-02-08 18:53:48', `use_function`=NULL, `set_function`=NULL  WHERE (`configuration_id` = 504) ;

UPDATE `configuration` SET `configuration_id`='1486', `configuration_title`='Enable Seo URL validation?', `configuration_key`='FWR_VALIDATION_ON', `configuration_value`='false', `configuration_description`='Enable the SEO URL validation?', `configuration_group_id`='60', `sort_order`='16', `last_modified`=NULL, `date_added`='2009-02-25 22:57:25', `use_function`=NULL, `set_function`='tep_cfg_select_option(array(\'true\', \'false\'),'  WHERE (`configuration_id` = 1486) ;

#
# ADDED TABLE VALUES
#

INSERT INTO `address_format` VALUES ('6', '$firstname $lastname$cr$streets$cr$suburb$cr$city$cr$state$cr$postcode$cr$country', '$city / $country');
INSERT INTO `admin_files` VALUES ('135', 'treeview.php', '0', '54', '1');
INSERT INTO `admin_files` VALUES ('133', 'ups_boxes_used.php', '0', '9', '1');
INSERT INTO `admin_files` VALUES ('132', 'packaging.php', '0', '9', '1');
INSERT INTO `admin_files` VALUES ('131', 'qtprodoctor.php', '0', '9', '1');
INSERT INTO `admin_files` VALUES ('134', 'stats_credits.php', '0', '8', '1');
INSERT INTO `configuration` VALUES ('1220', 'Tax Rates used for billing the affiliates', 'AFFILIATE_TAX_ID', '1', 'Set the tax rate for billing affiliates', '35', '17', NULL, '2010-02-08 18:53:48', NULL, NULL);
INSERT INTO `configuration` VALUES ('599', 'Category Images Directory', 'CATEGORY_IMAGES_DIR', 'categories/', 'The directory inside catalog/images where your category images are stored.', '45', '0', NULL, '2009-05-28 15:34:10', NULL, NULL);
INSERT INTO `configuration` VALUES ('598', 'Product Popup Image Height', 'POPUP_IMAGE_HEIGHT', '600', 'Limits the popup product image (enlarged) size during product updates. MUST specify.', '4', '23', NULL, '2010-02-08 18:53:48', NULL, NULL);
INSERT INTO `configuration` VALUES ('597', 'Product Popup Image Width', 'POPUP_IMAGE_WIDTH', '800', 'Limits the popup product image (enlarged) size during product updates. MUST specify.', '4', '22', NULL, '2010-02-08 18:53:48', NULL, NULL);
INSERT INTO `configuration` VALUES ('596', 'Product Image Height', 'PRODUCT_IMAGE_HEIGHT', '', 'The main product image (thumbnail) in product information pages. Do NOT specify both!', '4', '21', NULL, '2010-02-08 18:53:48', NULL, NULL);
INSERT INTO `configuration` VALUES ('1219', 'Delete affiliate sale if order deleted?', 'AFFILIATE_NOTIFY_AFTER_BILLING', 'true', 'Delete affiliate sales if an order is deleted (Warning: Only not yet billed sales are deleted)', '35', '16', NULL, '2010-02-08 18:53:48', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('1218', 'Notify Affiliate of new invoice?', 'AFFILIATE_NOTIFY_AFTER_BILLING', 'true', 'Nofify affiliate if they have got a new invoice', '35', '15', NULL, '2010-02-08 18:53:48', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO `configuration` VALUES ('595', 'Product Image Width', 'PRODUCT_IMAGE_WIDTH', '120', 'The main product image (thumbnail) in product information pages.', '4', '20', NULL, '2010-02-08 18:53:48', NULL, NULL);
INSERT INTO `configuration` VALUES ('1222', 'Maintain affiliate banner history', 'AFFILIATE_DELETE_AFFILIATE_BANNER_HISTORY', 'false', 'To keep affiliate banner history table  small you can set the days after which they are deleted (when calling affiliate_summary in the admin). Set to false or set the number of days.', '35', '19', NULL, '2010-02-08 18:53:48', NULL, NULL);
INSERT INTO `configuration` VALUES ('1221', 'Maintain affiliate clickthroughs', 'AFFILIATE_DELETE_CLICKTHROUGHS', 'false', 'To keep the clickthrough report small you can set the days after which they are deleted (when calling affiliate_summary in the admin).  Set to false or set the number of days.', '35', '18', NULL, '2010-02-08 18:53:48', NULL, NULL);
INSERT INTO `configuration` VALUES ('77', 'Google Maps Key', 'GOOGLE_MAPS_KEY', 'YOURKEY', 'Put your Google Maps API Key here.<br><br>You can get one at http://code.google.com/apis/maps/signup.html', '1', '25', NULL, '2010-02-08 18:53:47', NULL, 'tep_cfg_textarea(');
INSERT INTO `currencies` VALUES ('3', 'UK Pound', 'GBP', '£', '', '.', ',', '2', '1.00000000', '2010-02-08 18:53:48');
INSERT INTO `zones` VALUES ('283', '222', 'Wrexham', 'Wrexham');
INSERT INTO `zones` VALUES ('281', '222', 'Wiltshire', 'Wiltshire');
INSERT INTO `zones` VALUES ('280', '222', 'Western Isles', 'Western Isles');
INSERT INTO `zones` VALUES ('279', '222', 'West Yorkshire', 'West Yorkshire');
INSERT INTO `zones` VALUES ('278', '222', 'West Sussex', 'West Sussex');
INSERT INTO `zones` VALUES ('277', '222', 'West Midlands', 'West Midlands');
INSERT INTO `zones` VALUES ('276', '222', 'West Lothian', 'West Lothian');
INSERT INTO `zones` VALUES ('275', '222', 'West Dunbartonshire', 'West Dunbartonshire');
INSERT INTO `zones` VALUES ('274', '222', 'Warwickshire', 'Warwickshire');
INSERT INTO `zones` VALUES ('273', '222', 'Vale of Glamorgan', 'Vale of Glamorgan');
INSERT INTO `zones` VALUES ('272', '222', 'Tyne and Wear', 'Tyne and Wear');
INSERT INTO `zones` VALUES ('271', '222', 'Torfaen', 'Torfaen');
INSERT INTO `zones` VALUES ('270', '222', 'Swansea', 'Swansea');
INSERT INTO `zones` VALUES ('269', '222', 'Surrey', 'Surrey');
INSERT INTO `zones` VALUES ('268', '222', 'Suffolk', 'Suffolk');
INSERT INTO `zones` VALUES ('267', '222', 'Stirling', 'Stirling');
INSERT INTO `zones` VALUES ('266', '222', 'Staffordshire', 'Staffordshire');
INSERT INTO `zones` VALUES ('265', '222', 'South Yorkshire', 'South Yorkshire');
INSERT INTO `zones` VALUES ('264', '222', 'South Lanarkshire', 'South Lanarkshire');
INSERT INTO `zones` VALUES ('263', '222', 'South Ayrshire', 'South Ayrshire');
INSERT INTO `zones` VALUES ('262', '222', 'Somerset', 'Somerset');
INSERT INTO `zones` VALUES ('261', '222', 'Shropshire', 'Shropshire');
INSERT INTO `zones` VALUES ('260', '222', 'Shetland Islands', 'Shetland Islands');
INSERT INTO `zones` VALUES ('259', '222', 'Scottish Borders', 'Scottish Borders');
INSERT INTO `zones` VALUES ('258', '222', 'Rutland', 'Rutland');
INSERT INTO `zones` VALUES ('257', '222', 'Rhondda Cynon Taff', 'Rhondda Cynon Taff');
INSERT INTO `zones` VALUES ('256', '222', 'Renfrewshire', 'Renfrewshire');
INSERT INTO `zones` VALUES ('255', '222', 'Powys', 'Powys');
INSERT INTO `zones` VALUES ('254', '222', 'Perth and Kinross', 'Perth and Kinross');
INSERT INTO `zones` VALUES ('253', '222', 'Pembrokeshire', 'Pembrokeshire');
INSERT INTO `zones` VALUES ('252', '222', 'Oxfordshire', 'Oxfordshire');
INSERT INTO `zones` VALUES ('251', '222', 'Orkney Islands', 'Orkney Islands');
INSERT INTO `zones` VALUES ('250', '222', 'Nottinghamshire', 'Nottinghamshire');
INSERT INTO `zones` VALUES ('249', '222', 'Northumberland', 'Northumberland');
INSERT INTO `zones` VALUES ('248', '222', 'Northamptonshire', 'Northamptonshire');
INSERT INTO `zones` VALUES ('247', '222', 'North Yorkshire', 'North Yorkshire');
INSERT INTO `zones` VALUES ('246', '222', 'North Lanarkshire', 'North Lanarkshire');
INSERT INTO `zones` VALUES ('245', '222', 'North Ayrshire', 'North Ayrshire');
INSERT INTO `zones` VALUES ('244', '222', 'Norfolk', 'Norfolk');
INSERT INTO `zones` VALUES ('243', '222', 'Newport', 'Newport');
INSERT INTO `zones` VALUES ('242', '222', 'Neath Port Talbot', 'Neath Port Talbot');
INSERT INTO `zones` VALUES ('241', '222', 'Moray', 'Moray');
INSERT INTO `zones` VALUES ('240', '222', 'Monmouthshire', 'Monmouthshire');
INSERT INTO `zones` VALUES ('239', '222', 'Midlothian', 'Midlothian');
INSERT INTO `zones` VALUES ('238', '222', 'Merthyr Tydfil', 'Merthyr Tydfil');
INSERT INTO `zones` VALUES ('237', '222', 'Merseyside', 'Merseyside');
INSERT INTO `zones` VALUES ('236', '222', 'Lincolnshire', 'Lincolnshire');
INSERT INTO `zones` VALUES ('235', '222', 'Leicestershire', 'Leicestershire');
INSERT INTO `zones` VALUES ('234', '222', 'Lancashire', 'Lancashire');
INSERT INTO `zones` VALUES ('233', '222', 'Kent', 'Kent');
INSERT INTO `zones` VALUES ('232', '222', 'Isle of Wight', 'Isle of Wight');
INSERT INTO `zones` VALUES ('231', '222', 'Isle of Man', 'Isle of Man');
INSERT INTO `zones` VALUES ('230', '222', 'Inverclyde', 'Inverclyde');
INSERT INTO `zones` VALUES ('229', '222', 'Highlands', 'Highlands');
INSERT INTO `zones` VALUES ('228', '222', 'Hertfordshire', 'Hertfordshire');
INSERT INTO `zones` VALUES ('227', '222', 'Herefordshire', 'Herefordshire');
INSERT INTO `zones` VALUES ('226', '222', 'Hampshire', 'Hampshire');
INSERT INTO `zones` VALUES ('225', '222', 'Gwynedd', 'Gwynedd');
INSERT INTO `zones` VALUES ('224', '222', 'Greater Manchester', 'Greater Manchester');
INSERT INTO `zones` VALUES ('223', '222', 'Greater London', 'Greater London');
INSERT INTO `zones` VALUES ('222', '222', 'Gloucestershire', 'Gloucestershire');
INSERT INTO `zones` VALUES ('221', '222', 'Glasgow', 'Glasgow');
INSERT INTO `zones` VALUES ('220', '222', 'Flintshire', 'Flintshire');
INSERT INTO `zones` VALUES ('219', '222', 'Fife', 'Fife');
INSERT INTO `zones` VALUES ('218', '222', 'Falkirk', 'Falkirk');
INSERT INTO `zones` VALUES ('217', '222', 'Essex', 'Essex');
INSERT INTO `zones` VALUES ('216', '222', 'Edinburgh', 'Edinburgh');
INSERT INTO `zones` VALUES ('215', '222', 'East Sussex', 'East Sussex');
INSERT INTO `zones` VALUES ('214', '222', 'East Riding of Yorkshire', 'East Riding of Yorkshire');
INSERT INTO `zones` VALUES ('213', '222', 'East Renfrewshire', 'East Renfrewshire');
INSERT INTO `zones` VALUES ('212', '222', 'East Lothian', 'East Lothian');
INSERT INTO `zones` VALUES ('211', '222', 'East Dunbartonshire', 'East Dunbartonshire');
INSERT INTO `zones` VALUES ('210', '222', 'East Ayrshire', 'East Ayrshire');
INSERT INTO `zones` VALUES ('209', '222', 'Durham', 'Durham');
INSERT INTO `zones` VALUES ('208', '222', 'Dundee', 'Dundee');
INSERT INTO `zones` VALUES ('207', '222', 'Dumfries and Galloway', 'Dumfries and Galloway');
INSERT INTO `zones` VALUES ('206', '222', 'Dorset', 'Dorset');
INSERT INTO `zones` VALUES ('205', '222', 'Devon', 'Devon');
INSERT INTO `zones` VALUES ('204', '222', 'Derbyshire', 'Derbyshire');
INSERT INTO `zones` VALUES ('203', '222', 'Denbighshire', 'Denbighshire');
INSERT INTO `zones` VALUES ('202', '222', 'Cornwall', 'Cornwall');
INSERT INTO `zones` VALUES ('201', '222', 'Conwy', 'Conwy');
INSERT INTO `zones` VALUES ('200', '222', 'Clackmannanshire', 'Clackmannanshire');
INSERT INTO `zones` VALUES ('199', '222', 'Cheshire', 'Cheshire');
INSERT INTO `zones` VALUES ('198', '222', 'Channel Islands', 'Channel Islands');
INSERT INTO `zones` VALUES ('197', '222', 'Ceredigion', 'Ceredigion');
INSERT INTO `zones` VALUES ('196', '222', 'Carmarthenshire', 'Carmarthenshire');
INSERT INTO `zones` VALUES ('195', '222', 'Cardiff', 'Cardiff');
INSERT INTO `zones` VALUES ('194', '222', 'Cambridgeshire', 'Cambridgeshire');
INSERT INTO `zones` VALUES ('193', '222', 'Caerphilly', 'Caerphilly');
INSERT INTO `zones` VALUES ('192', '222', 'Buckinghamshire', 'Buckinghamshire');
INSERT INTO `zones` VALUES ('191', '222', 'Bristol', 'Bristol');
INSERT INTO `zones` VALUES ('190', '222', 'Bridgend', 'Bridgend');
INSERT INTO `zones` VALUES ('189', '222', 'Blaenau Gwent', 'Blaenau Gwent');
INSERT INTO `zones` VALUES ('188', '222', 'Berkshire', 'Berkshire');
INSERT INTO `zones` VALUES ('187', '222', 'Bedfordshire', 'Bedfordshire');
INSERT INTO `zones` VALUES ('186', '222', 'Argyll and Bute', 'Argyll and Bute');
INSERT INTO `zones` VALUES ('185', '222', 'Angus', 'Angus');
INSERT INTO `zones` VALUES ('184', '222', 'Anglesey', 'Anglesey');
INSERT INTO `zones` VALUES ('183', '222', 'Aberdeenshire', 'Aberdeenshire');
INSERT INTO `zones` VALUES ('182', '222', 'Aberdeen', 'Aberdeen');
INSERT INTO `zones` VALUES ('282', '222', 'Worcestershire', 'Worcestershire');

