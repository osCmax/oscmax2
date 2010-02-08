# osCMax Power E-Commerce
# http://oscdox.com
#
# Default Database For osCMax v2.0 RC4
# Copyright (c) 2009 osCMax
#
# Released under the GNU General Public License
#
# NOTE: * Please make any modifications to this file by hand!
#       * DO NOT use a mysqldump created file for new changes!
#       * Please take note of the table structure, and use this
#         structure as a standard for future modifications!
#       * Any tables you add here should be added in admin/backup.php
#         and in catalog/install/includes/functions/database.php
#       * To see the 'diff'erence between MySQL databases, use
#         the mysqldiff perl script located in the extras
#         directory of the 'catalog' module.
#       * Comments should be like these, full line comments.
#         (don't use inline comments)

DROP TABLE IF EXISTS address_book;
CREATE TABLE address_book (
  address_book_id int NOT NULL auto_increment,
  customers_id int NOT NULL,
  entry_gender char(1) NOT NULL,
  entry_company varchar(32),
  entry_company_tax_id varchar(32),
  entry_firstname varchar(32) NOT NULL,
  entry_lastname varchar(32) NOT NULL,
  entry_street_address varchar(64) NOT NULL,
  entry_suburb varchar(32),
  entry_postcode varchar(10) NOT NULL,
  entry_city varchar(32) NOT NULL,
  entry_state varchar(32),
  entry_country_id int DEFAULT '0' NOT NULL,
  entry_zone_id int DEFAULT '0' NOT NULL,
  PRIMARY KEY (address_book_id),
  KEY idx_address_book_customers_id (customers_id)
);

DROP TABLE IF EXISTS address_format;
CREATE TABLE address_format (
  address_format_id int NOT NULL auto_increment,
  address_format varchar(128) NOT NULL,
  address_summary varchar(48) NOT NULL,
  PRIMARY KEY (address_format_id)
);

DROP TABLE IF EXISTS admin;
CREATE TABLE admin (
  admin_id int NOT NULL auto_increment,
  admin_groups_id int,
  admin_username varchar(32) NOT NULL,
  admin_firstname varchar(32) NOT NULL,
  admin_lastname varchar(32),
  admin_email_address varchar(96) NOT NULL,
  admin_password varchar(40) NOT NULL,
  admin_created datetime,
  admin_modified datetime NOT NULL,
  admin_logdate datetime,
  admin_lognum int NOT NULL DEFAULT '0',
  PRIMARY KEY (admin_id),
  UNIQUE KEY admin_username (admin_username),
  UNIQUE KEY admin_email_address (admin_email_address) 
);

DROP TABLE IF EXISTS admin_files;
CREATE TABLE admin_files (
  admin_files_id int NOT NULL auto_increment,
  admin_files_name varchar(64) NOT NULL,
  admin_files_is_boxes tinyint(5) NOT NULL DEFAULT '0',
  admin_files_to_boxes int NOT NULL DEFAULT '0',
  admin_groups_id set('1','2') DEFAULT '1' NOT NULL,
  PRIMARY KEY (admin_files_id)
);

DROP TABLE IF EXISTS admin_groups;
CREATE TABLE admin_groups (
  admin_groups_id int NOT NULL auto_increment,
  admin_groups_name varchar(64) default NULL,
  PRIMARY KEY (admin_groups_id),
  UNIQUE KEY admin_groups_name (admin_groups_name)
);

DROP TABLE IF EXISTS affiliate_affiliate;
CREATE TABLE affiliate_affiliate (
  affiliate_id int(11) NOT NULL auto_increment,
  affiliate_gender char(1) NOT NULL default '',
  affiliate_firstname varchar(32) NOT NULL default '',
  affiliate_lastname varchar(32) NOT NULL default '',
  affiliate_dob datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_email_address varchar(96) NOT NULL default '',
  affiliate_telephone varchar(32) NOT NULL default '',
  affiliate_fax varchar(32) NOT NULL default '',
  affiliate_password varchar(40) NOT NULL default '',
  affiliate_homepage varchar(96) NOT NULL default '',
  affiliate_street_address varchar(64) NOT NULL default '',
  affiliate_suburb varchar(64) NOT NULL default '',
  affiliate_city varchar(32) NOT NULL default '',
  affiliate_postcode varchar(10) NOT NULL default '',
  affiliate_state varchar(32) NOT NULL default '',
  affiliate_country_id int(11) NOT NULL default '0',
  affiliate_zone_id int(11) NOT NULL default '0',
  affiliate_agb tinyint(4) NOT NULL default '0',
  affiliate_company varchar(60) NOT NULL default '',
  affiliate_company_taxid varchar(64) NOT NULL default '',
  affiliate_commission_percent DECIMAL(4,2) NOT NULL default '0.00',
  affiliate_payment_check varchar(100) NOT NULL default '',
  affiliate_payment_paypal varchar(64) NOT NULL default '',
  affiliate_payment_bank_name varchar(64) NOT NULL default '',
  affiliate_payment_bank_branch_number varchar(64) NOT NULL default '',
  affiliate_payment_bank_swift_code varchar(64) NOT NULL default '',
  affiliate_payment_bank_account_name varchar(64) NOT NULL default '',
  affiliate_payment_bank_account_number varchar(64) NOT NULL default '',
  affiliate_date_of_last_logon datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_number_of_logons int(11) NOT NULL default '0',
  affiliate_date_account_created datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_date_account_last_modified datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_lft int(11) NOT NULL,
  affiliate_rgt int(11) NOT NULL,
  affiliate_root int(11) NOT NULL,
  affiliate_newsletter char(1) NOT NULL default '1',
  PRIMARY KEY (affiliate_id)
);

DROP TABLE IF EXISTS affiliate_banners;
CREATE TABLE affiliate_banners (
affiliate_banners_id int(11) NOT NULL auto_increment,
affiliate_banners_title varchar(64) NOT NULL default '',
affiliate_products_id int(11) NOT NULL default '0',
affiliate_category_id int(11) NOT NULL default '0',
affiliate_banners_image varchar(64) NOT NULL default '',
affiliate_banners_group varchar(10) NOT NULL default '',
affiliate_banners_html_text text,
affiliate_expires_impressions int(7) default '0',
affiliate_expires_date datetime default NULL,
affiliate_date_scheduled datetime default NULL,
affiliate_date_added datetime NOT NULL default '0000-00-00 00:00:00',
affiliate_date_status_change datetime default NULL,
affiliate_status int(1) NOT NULL default '1',
PRIMARY KEY (affiliate_banners_id)
);

DROP TABLE IF EXISTS affiliate_banners_history;
CREATE TABLE affiliate_banners_history (
  affiliate_banners_history_id int(11) NOT NULL auto_increment,
  affiliate_banners_products_id int(11) NOT NULL default '0',
  affiliate_banners_id int(11) NOT NULL default '0',
  affiliate_banners_affiliate_id int(11) NOT NULL default '0',
  affiliate_banners_shown int(11) NOT NULL default '0',
  affiliate_banners_clicks tinyint(4) NOT NULL default '0',
  affiliate_banners_history_date date NOT NULL default '0000-00-00',
  PRIMARY KEY  (affiliate_banners_history_id,affiliate_banners_products_id)
);

DROP TABLE IF EXISTS affiliate_clickthroughs;
CREATE TABLE affiliate_clickthroughs (
  affiliate_clickthrough_id int(11) NOT NULL auto_increment,
  affiliate_id int(11) NOT NULL default '0',
  affiliate_clientdate datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_clientbrowser varchar(200) default 'Could Not Find This Data',
  affiliate_clientip varchar(50) default 'Could Not Find This Data',
  affiliate_clientreferer varchar(200) default 'none detected (maybe a direct link)',
  affiliate_products_id int(11) default '0',
  affiliate_banner_id int(11) NOT NULL default '0',
  PRIMARY KEY  (affiliate_clickthrough_id),
  KEY refid (affiliate_id)
);

DROP TABLE IF EXISTS affiliate_news;
CREATE TABLE affiliate_news (
  news_id int(11) NOT NULL auto_increment,
  headline varchar(255) NOT NULL default '',
  content text NOT NULL,
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  news_status tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`news_id`)
);

DROP TABLE IF EXISTS affiliate_newsletters;
CREATE TABLE affiliate_newsletters (
  affiliate_newsletters_id int(11) NOT NULL auto_increment,
  title varchar(255) NOT NULL,
  content text NOT NULL,
  module varchar(255) NOT NULL,
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  date_sent datetime default NULL,
  status int(1) default NULL,
  locked int(1) default '0',
  PRIMARY KEY  (affiliate_newsletters_id)
);

DROP TABLE IF EXISTS affiliate_news_contents;
CREATE TABLE affiliate_news_contents (
  affiliate_news_contents_id int(11) NOT NULL auto_increment,
  affiliate_news_id int(11) NOT NULL default '0',
  affiliate_news_languages_id int(11) NOT NULL default '0',
  affiliate_news_headlines varchar(255) NOT NULL default '',
  affiliate_news_contents text NOT NULL,
  PRIMARY KEY  (affiliate_news_contents_id),
  KEY affiliate_news_id (affiliate_news_id),
  KEY affiliate_news_languages_id (affiliate_news_languages_id)
);

DROP TABLE IF EXISTS affiliate_payment;
CREATE TABLE affiliate_payment (
  affiliate_payment_id int(11) NOT NULL auto_increment,
  affiliate_id int(11) NOT NULL default '0',
  affiliate_payment decimal(15,2) NOT NULL default '0.00',
  affiliate_payment_tax decimal(15,2) NOT NULL default '0.00',
  affiliate_payment_total decimal(15,2) NOT NULL default '0.00',
  affiliate_payment_date datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_payment_last_modified datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_payment_status int(5) NOT NULL default '0',
  affiliate_firstname varchar(32) NOT NULL default '',
  affiliate_lastname varchar(32) NOT NULL default '',
  affiliate_street_address varchar(64) NOT NULL default '',
  affiliate_suburb varchar(64) NOT NULL default '',
  affiliate_city varchar(32) NOT NULL default '',
  affiliate_postcode varchar(10) NOT NULL default '',
  affiliate_country varchar(32) NOT NULL default '0',
  affiliate_company varchar(60) NOT NULL default '',
  affiliate_state varchar(32) NOT NULL default '0',
  affiliate_address_format_id int(5) NOT NULL default '0',
  affiliate_last_modified datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (affiliate_payment_id)
);


DROP TABLE IF EXISTS affiliate_payment_status;
CREATE TABLE affiliate_payment_status (
  affiliate_payment_status_id int(11) NOT NULL default '0',
  affiliate_language_id int(11) NOT NULL default '1',
  affiliate_payment_status_name varchar(32) NOT NULL default '',
  PRIMARY KEY  (affiliate_payment_status_id,affiliate_language_id),
  KEY idx_affiliate_payment_status_name (affiliate_payment_status_name)
);


DROP TABLE IF EXISTS affiliate_payment_status_history;
CREATE TABLE affiliate_payment_status_history (
  affiliate_status_history_id int(11) NOT NULL auto_increment,
  affiliate_payment_id int(11) NOT NULL default '0',
  affiliate_new_value int(5) NOT NULL default '0',
  affiliate_old_value int(5) default NULL,
  affiliate_date_added datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_notified int(1) default '0',
  PRIMARY KEY  (affiliate_status_history_id)
);

DROP TABLE IF EXISTS affiliate_sales;
CREATE TABLE affiliate_sales (
  affiliate_id int(11) NOT NULL default '0',
  affiliate_date datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_browser varchar(100) NOT NULL default '',
  affiliate_ipaddress varchar(20) NOT NULL default '',
  affiliate_orders_id int(11) NOT NULL default '0',
  affiliate_value decimal(15,2) NOT NULL default '0.00',
  affiliate_payment decimal(15,2) NOT NULL default '0.00',
  affiliate_clickthroughs_id int(11) NOT NULL default '0',
  affiliate_billing_status int(5) NOT NULL default '0',
  affiliate_payment_date datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_payment_id int(11) NOT NULL default '0',
  affiliate_percent decimal(4,2) NOT NULL default '0.00',
  affiliate_salesman int(11) NOT NULL default '0',
  PRIMARY KEY (affiliate_orders_id,affiliate_id)
);

DROP TABLE IF EXISTS articles;
CREATE TABLE articles (
  articles_id int NOT NULL auto_increment,
  articles_date_added datetime NOT NULL,
  articles_last_modified datetime,
  articles_date_available datetime,
  articles_status tinyint(1) NOT NULL default '0',
  authors_id int,
  PRIMARY KEY (articles_id),
  KEY idx_articles_date_added (articles_date_added)
);

DROP TABLE IF EXISTS articles_description;
CREATE TABLE articles_description (
  articles_id int NOT NULL auto_increment,
  language_id int NOT NULL default '1',
  articles_name varchar(64) NOT NULL,
  articles_description text,
  articles_url varchar(255) default NULL,
  articles_viewed int(5) default '0',
  articles_head_title_tag varchar(80) default NULL,
  articles_head_desc_tag text,
  articles_head_keywords_tag text,
  PRIMARY KEY (articles_id, language_id),
  KEY articles_name (articles_name)
);

DROP TABLE IF EXISTS articles_to_topics;
CREATE TABLE articles_to_topics (
  articles_id int NOT NULL default '0',
  topics_id int NOT NULL default '0',
  PRIMARY KEY (articles_id,topics_id)
);

DROP TABLE IF EXISTS articles_xsell;
CREATE TABLE articles_xsell (
  ID int(10) NOT NULL auto_increment,
  articles_id int(10) unsigned NOT NULL default '1',
  xsell_id int(10) unsigned NOT NULL default '1',
  sort_order int(10) unsigned NOT NULL default '1',
  PRIMARY KEY (ID)
);

DROP TABLE IF EXISTS article_reviews;
CREATE TABLE article_reviews (
  reviews_id int NOT NULL auto_increment,
  articles_id int NOT NULL default '0',
  customers_id int,
  customers_name varchar(64) NOT NULL,
  reviews_rating int(1),
  date_added datetime,
  last_modified datetime,
  reviews_read int(5) NOT NULL default '0',
  approved tinyint(3) unsigned default '0',
  PRIMARY KEY (reviews_id)
);

DROP TABLE IF EXISTS article_reviews_description;
CREATE TABLE article_reviews_description (
  reviews_id int NOT NULL default '0',
  languages_id int NOT NULL default '0',
  reviews_text text NOT NULL,
  PRIMARY KEY (reviews_id,languages_id)
);
DROP TABLE IF EXISTS authors;
CREATE TABLE authors (
  authors_id int NOT NULL auto_increment,
  authors_name varchar(32) NOT NULL,
  authors_image varchar(64),
  date_added datetime,
  last_modified datetime,
  PRIMARY KEY (authors_id),
  KEY IDX_AUTHORS_NAME (authors_name)
);

DROP TABLE IF EXISTS authors_info;
CREATE TABLE authors_info (
  authors_id int NOT NULL default '0',
  languages_id int NOT NULL default '0',
  authors_description text,
  authors_url varchar(255) NOT NULL,
  url_clicked int(5) NOT NULL default '0',
  date_last_click datetime,
  PRIMARY KEY (authors_id, languages_id)
);

DROP TABLE IF EXISTS banners;
CREATE TABLE banners (
  banners_id int NOT NULL auto_increment,
  banners_title varchar(64) NOT NULL,
  banners_url varchar(255) NOT NULL,
  banners_image varchar(64) NOT NULL,
  banners_group varchar(10) NOT NULL,
  banners_html_text text,
  expires_impressions int(7) DEFAULT '0',
  expires_date datetime DEFAULT NULL,
  date_scheduled datetime DEFAULT NULL,
  date_added datetime NOT NULL,
  date_status_change datetime DEFAULT NULL,
  status int(1) DEFAULT '1' NOT NULL,
  PRIMARY KEY (banners_id),
  KEY idx_banners_group (banners_group)
);

DROP TABLE IF EXISTS banners_history;
CREATE TABLE banners_history (
  banners_history_id int NOT NULL auto_increment,
  banners_id int NOT NULL,
  banners_shown int(5) NOT NULL DEFAULT '0',
  banners_clicked int(5) NOT NULL DEFAULT '0',
  banners_history_date datetime NOT NULL,
  PRIMARY KEY (banners_history_id),
  KEY idx_banners_history_banners_id (banners_id)
);

DROP TABLE IF EXISTS cache;
CREATE TABLE cache (
  cache_id varchar(32) NOT NULL,
  cache_language_id tinyint(1) NOT NULL default '0',
  cache_name varchar(255) NOT NULL,
  cache_data mediumtext NOT NULL,
  cache_global tinyint(1) NOT NULL default '1',
  cache_gzip tinyint(1) NOT NULL default '1',
  cache_method varchar(20) NOT NULL default 'RETURN',
  cache_date datetime NOT NULL,
  cache_expires datetime NOT NULL,
  PRIMARY KEY (cache_id, cache_language_id),
  KEY cache_id (cache_id),
  KEY cache_language_id (cache_language_id),
  KEY cache_global (cache_global)
);

DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
  categories_id int NOT NULL auto_increment,
  categories_image varchar(64),
  parent_id int DEFAULT '0' NOT NULL,
  sort_order int(3),
  date_added datetime,
  last_modified datetime,
  PRIMARY KEY (categories_id),
  KEY idx_categories_parent_id (parent_id)
);

DROP TABLE IF EXISTS categories_description;
CREATE TABLE categories_description (
  categories_id int DEFAULT '0' NOT NULL,
  language_id int DEFAULT '1' NOT NULL,
  categories_name varchar(32) NOT NULL,
  categories_heading_title varchar(64),
  categories_description text,
  PRIMARY KEY (categories_id, language_id),
  KEY idx_categories_name (categories_name)
);

DROP TABLE IF EXISTS configuration;
CREATE TABLE configuration (
  configuration_id int NOT NULL auto_increment,
  configuration_title varchar(255) NOT NULL,
  configuration_key varchar(255) NOT NULL,
  configuration_value varchar(255) NOT NULL,
  configuration_description varchar(255) NOT NULL,
  configuration_group_id int NOT NULL,
  sort_order int(5) NULL,
  last_modified datetime NULL,
  date_added datetime NOT NULL,
  use_function varchar(255) NULL,
  set_function varchar(255) NULL,
  PRIMARY KEY (configuration_id)
);

DROP TABLE IF EXISTS configuration_group;
CREATE TABLE configuration_group (
  configuration_group_id int NOT NULL auto_increment,
  configuration_group_title varchar(64) NOT NULL,
  configuration_group_description varchar(255) NOT NULL,
  sort_order int(5) NULL,
  visible int(1) DEFAULT '1' NULL,
  PRIMARY KEY (configuration_group_id)
);

DROP TABLE IF EXISTS counter;
CREATE TABLE counter (
  startdate char(8),
  counter int(12)
);

DROP TABLE IF EXISTS counter_history;
CREATE TABLE counter_history (
  month char(8),
  counter int(12)
);

DROP TABLE IF EXISTS countries;
CREATE TABLE countries (
  countries_id int NOT NULL auto_increment,
  countries_name varchar(64) NOT NULL,
  countries_iso_code_2 char(2) NOT NULL,
  countries_iso_code_3 char(3) NOT NULL,
  address_format_id int NOT NULL,
  active tinyint(3) unsigned DEFAULT '0',
  PRIMARY KEY (countries_id),
  KEY IDX_COUNTRIES_NAME (countries_name)
);


DROP TABLE IF EXISTS coupons;
CREATE TABLE coupons (
  coupon_id int NOT NULL auto_increment,
  coupon_type char(1) NOT NULL default 'F',
  coupon_code varchar(32) NOT NULL,
  coupon_amount decimal(8,4) NOT NULL default '0.0000',
  coupon_minimum_order decimal(8,4) NOT NULL default '0.0000',
  coupon_start_date datetime NOT NULL default '0000-00-00 00:00:00',
  coupon_expire_date datetime NOT NULL default '0000-00-00 00:00:00',
  uses_per_coupon int(5) NOT NULL default '1',
  uses_per_user int(5) NOT NULL default '0',
  restrict_to_products varchar(255) default NULL,
  restrict_to_categories varchar(255) default NULL,
  restrict_to_customers text,
  coupon_active char(1) NOT NULL default 'Y',
  date_created datetime NOT NULL default '0000-00-00 00:00:00',
  date_modified datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY (coupon_id)
);

DROP TABLE IF EXISTS coupons_description;
CREATE TABLE coupons_description (
  coupon_id int NOT NULL default '0',
  language_id int NOT NULL default '0',
  coupon_name varchar(32) NOT NULL,
  coupon_description text,
  KEY coupon_id (coupon_id)
);
DROP TABLE IF EXISTS coupon_email_track;
CREATE TABLE coupon_email_track (
  unique_id int NOT NULL auto_increment,
  coupon_id int NOT NULL default '0',
  customer_id_sent int NOT NULL default '0',
  sent_firstname varchar(32) default NULL,
  sent_lastname varchar(32) default NULL,
  emailed_to varchar(32) default NULL,
  date_sent datetime NOT NULL,
  PRIMARY KEY (unique_id)
);

DROP TABLE IF EXISTS coupon_gv_customer;
CREATE TABLE coupon_gv_customer (
  customer_id int(5) NOT NULL default '0',
  amount decimal(8,4) NOT NULL default '0.0000',
  PRIMARY KEY (customer_id),
  KEY customer_id (customer_id)
);

DROP TABLE IF EXISTS coupon_gv_queue;
CREATE TABLE coupon_gv_queue (
  unique_id int(5) NOT NULL auto_increment,
  customer_id int(5) NOT NULL default '0',
  order_id int(5) NOT NULL default '0',
  amount decimal(8,4) NOT NULL default '0.0000',
  date_created datetime NOT NULL,
  ipaddr varchar(32) NOT NULL,
  release_flag char(1) NOT NULL default 'N',
  PRIMARY KEY (unique_id),
  KEY uid (unique_id,customer_id,order_id)
);

DROP TABLE IF EXISTS coupon_redeem_track;
CREATE TABLE coupon_redeem_track (
  unique_id int NOT NULL auto_increment,
  coupon_id int NOT NULL default '0',
  customer_id int NOT NULL default '0',
  redeem_date datetime NOT NULL default '0000-00-00 00:00:00',
  redeem_ip varchar(32) NOT NULL,
  order_id int NOT NULL default '0',
  PRIMARY KEY (unique_id)
);

DROP TABLE IF EXISTS currencies;
CREATE TABLE currencies (
  currencies_id int NOT NULL auto_increment,
  title varchar(32) NOT NULL,
  code char(3) NOT NULL,
  symbol_left varchar(12),
  symbol_right varchar(12),
  decimal_point char(1),
  thousands_point char(1),
  decimal_places char(1),
  value float(13,8),
  last_updated datetime NULL,
  PRIMARY KEY (currencies_id),
  KEY idx_currencies_code (code)
);

DROP TABLE IF EXISTS customers;
CREATE TABLE customers (
  customers_id int NOT NULL auto_increment,
  purchased_without_account tinyint(1) unsigned NOT NULL default '0',
  customers_gender char(1) NOT NULL,
  customers_firstname varchar(32) NOT NULL,
  customers_lastname varchar(32) NOT NULL,
  customers_dob datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  customers_email_address varchar(96) NOT NULL,
  customers_default_address_id int,
  customers_telephone varchar(32) NOT NULL,
  customers_fax varchar(32),
  customers_password varchar(40) NOT NULL,
  customers_newsletter char(1),
  guest_account tinyint(1) NOT NULL default '0',
  customers_login varchar(96) DEFAULT NULL,
  customers_group_name varchar(27) DEFAULT 'Retail' NOT NULL,
  customers_group_id int NOT NULL default '0',
  customers_group_ra enum('0','1') NOT NULL default '0',
  customers_payment_allowed varchar(255) NOT NULL,
  customers_shipment_allowed varchar(255) NOT NULL,
  PRIMARY KEY (customers_id),
  UNIQUE KEY idx_customers_login (customers_login),
  KEY purchased_without_account (purchased_without_account),
  KEY idx_customers_email_address (customers_email_address)
);

DROP TABLE IF EXISTS customers_basket;
CREATE TABLE customers_basket (
  customers_basket_id int NOT NULL auto_increment,
  customers_id int NOT NULL,
  products_id tinytext NOT NULL,
  customers_basket_quantity int(2) NOT NULL,
  final_price decimal(15,4),
  customers_basket_date_added char(8),
  PRIMARY KEY (customers_basket_id),
  KEY idx_customers_basket_customers_id (customers_id)
);

DROP TABLE IF EXISTS customers_basket_attributes;
CREATE TABLE customers_basket_attributes (
  customers_basket_attributes_id int NOT NULL auto_increment,
  customers_id int NOT NULL,
  products_id tinytext NOT NULL,
  products_options_id int NOT NULL,
  products_options_value_id int NOT NULL,
  products_options_value_text varchar(32),
  PRIMARY KEY (customers_basket_attributes_id),
  KEY idx_customers_basket_att_customers_id (customers_id)
);

DROP TABLE IF EXISTS customers_groups;
CREATE TABLE customers_groups (
  customers_group_id smallint(5) unsigned NOT NULL default '0',
  customers_group_name varchar(32) NOT NULL,
  customers_group_show_tax enum('1','0') DEFAULT '1' NOT NULL,
  customers_group_tax_exempt enum('0','1') NOT NULL default '0',
  group_payment_allowed varchar(255) NOT NULL,
  group_shipment_allowed varchar(255) NOT NULL,
  PRIMARY KEY (customers_group_id)
);

DROP TABLE IF EXISTS customers_info;
CREATE TABLE customers_info (
  customers_info_id int NOT NULL,
  customers_info_date_of_last_logon datetime,
  customers_info_number_of_logons int(5),
  customers_info_date_account_created datetime,
  customers_info_date_account_last_modified datetime,
  global_product_notifications int(1) DEFAULT '0',
  PRIMARY KEY (customers_info_id)
);

DROP TABLE IF EXISTS customers_wishlist;
CREATE TABLE `customers_wishlist` (
  `products_id` tinytext NOT NULL,
  `customers_id` int(13) NOT NULL default '0'
) TYPE=MyISAM;


DROP TABLE IF EXISTS customers_wishlist_attributes;
CREATE TABLE `customers_wishlist_attributes` (
  `customers_wishlist_attributes_id` int(11) NOT NULL auto_increment,
  `customers_id` int(11) NOT NULL default '0',
  `products_id` tinytext NOT NULL,
  `products_options_id` int(11) NOT NULL default '0',
  `products_options_value_id` int(11) NOT NULL default '0',
  PRIMARY KEY (`customers_wishlist_attributes_id`)
) TYPE=MyISAM; 

DROP TABLE IF EXISTS geo_zones;
CREATE TABLE geo_zones (
  geo_zone_id int NOT NULL auto_increment,
  geo_zone_name varchar(32) NOT NULL,
  geo_zone_description varchar(255) NOT NULL,
  last_modified datetime,
  date_added datetime NOT NULL,
  PRIMARY KEY (geo_zone_id)
);

DROP TABLE IF EXISTS google_checkout;
CREATE TABLE google_checkout (
  customers_id int DEFAULT NULL,
  buyer_id bigint(20) DEFAULT NULL
);

DROP TABLE IF EXISTS google_orders;
CREATE TABLE google_orders (
  orders_id int default NULL,
  google_order_number bigint(20) DEFAULT NULL,
  order_amount decimal(15,4) DEFAULT NULL
);

DROP TABLE IF EXISTS languages;
CREATE TABLE languages (
  languages_id int NOT NULL auto_increment,
  name varchar(32) NOT NULL,
  code char(2) NOT NULL,
  image varchar(64),
  directory varchar(32),
  sort_order int(3),
  PRIMARY KEY (languages_id),
  KEY IDX_LANGUAGES_NAME (name)
);

DROP TABLE IF EXISTS manufacturers;
CREATE TABLE manufacturers (
  manufacturers_id int NOT NULL auto_increment,
  manufacturers_name varchar(32) NOT NULL,
  manufacturers_image varchar(64),
  date_added datetime NULL,
  last_modified datetime NULL,
  PRIMARY KEY (manufacturers_id),
  KEY IDX_MANUFACTURERS_NAME (manufacturers_name)
);

DROP TABLE IF EXISTS manufacturers_info;
CREATE TABLE manufacturers_info (
  manufacturers_id int NOT NULL,
  languages_id int NOT NULL,
  manufacturers_url varchar(255) NOT NULL,
  url_clicked int(5) NOT NULL default '0',
  date_last_click datetime NULL,
  PRIMARY KEY (manufacturers_id, languages_id)
);

DROP TABLE IF EXISTS newsletters;
CREATE TABLE newsletters (
  newsletters_id int NOT NULL auto_increment,
  title varchar(255) NOT NULL,
  content text NOT NULL,
  module varchar(255) NOT NULL,
  date_added datetime NOT NULL,
  date_sent datetime,
  status int(1),
  locked int(1) DEFAULT '0',
  PRIMARY KEY (newsletters_id)
);

DROP TABLE IF EXISTS orders;
CREATE TABLE orders (
  orders_id int NOT NULL auto_increment,
  customers_id int NOT NULL,
  customers_name varchar(64) NOT NULL,
  customers_company varchar(32),
  customers_street_address varchar(64) NOT NULL,
  customers_suburb varchar(32),
  customers_city varchar(32) NOT NULL,
  customers_postcode varchar(10) NOT NULL,
  customers_state varchar(32),
  customers_country varchar(32) NOT NULL,
  customers_telephone varchar(32) NOT NULL,
  customers_email_address varchar(96) NOT NULL,
  customers_address_format_id int(5) NOT NULL,
  customers_dummy_account tinyint(3) unsigned NOT NULL,
  delivery_name varchar(64) NOT NULL,
  delivery_company varchar(32),
  delivery_street_address varchar(64) NOT NULL,
  delivery_suburb varchar(32),
  delivery_city varchar(32) NOT NULL,
  delivery_postcode varchar(10) NOT NULL,
  delivery_state varchar(32),
  delivery_country varchar(32) NOT NULL,
  delivery_address_format_id int(5) NOT NULL,
  billing_name varchar(64) NOT NULL,
  billing_company varchar(32),
  billing_street_address varchar(64) NOT NULL,
  billing_suburb varchar(32),
  billing_city varchar(32) NOT NULL,
  billing_postcode varchar(10) NOT NULL,
  billing_state varchar(32),
  billing_country varchar(32) NOT NULL,
  billing_address_format_id int(5) NOT NULL,
  payment_method varchar(255) NOT NULL,
  cc_type varchar(20),
  cc_owner varchar(64),
  cc_number varchar(32),
  cc_expires varchar(4),
  last_modified datetime,
  date_purchased datetime,
  orders_status int(5) NOT NULL,
  orders_date_finished datetime,
  currency char(3),
  currency_value decimal(14,6),
  paypal_ipn_id int NOT NULL default '0',
  fedex_tracking varchar(20) NOT NULL,
  purchased_without_account tinyint(1) unsigned NOT NULL default '0',
  shipping_tax decimal(7,4) NOT NULL default '0.0000',
  shipping_module varchar(255) default NULL,
  PRIMARY KEY (orders_id),
  KEY idx_orders_customers_id (customers_id)
);

DROP TABLE IF EXISTS orders_products;
CREATE TABLE orders_products (
  orders_products_id int NOT NULL auto_increment,
  orders_id int NOT NULL,
  products_id int NOT NULL,
  products_model varchar(12),
  products_name varchar(64) NOT NULL,
  products_price decimal(15,4) NOT NULL,
  final_price decimal(15,4) NOT NULL,
  products_tax decimal(7,4) NOT NULL,
  products_quantity int(2) NOT NULL,
  products_stock_attributes varchar(255),
  PRIMARY KEY (orders_products_id),
  KEY idx_orders_products_orders_id (orders_id),
  KEY idx_orders_products_products_id (products_id)
);

DROP TABLE IF EXISTS orders_products_attributes;
CREATE TABLE orders_products_attributes (
  orders_products_attributes_id int NOT NULL auto_increment,
  orders_id int NOT NULL,
  orders_products_id int NOT NULL,
  products_options varchar(32) NOT NULL,
  products_options_values varchar(32) NOT NULL,
  options_values_price decimal(15,4) NOT NULL,
  price_prefix char(1) NOT NULL,
  PRIMARY KEY (orders_products_attributes_id),
  KEY idx_orders_products_att_orders_id (orders_id)
);

DROP TABLE IF EXISTS orders_products_download;
CREATE TABLE orders_products_download (
  orders_products_download_id int NOT NULL auto_increment,
  orders_id int NOT NULL default '0',
  orders_products_id int NOT NULL default '0',
  orders_products_filename varchar(255) NOT NULL,
  download_maxdays int(2) NOT NULL default '0',
  download_count int(2) NOT NULL default '0',
  PRIMARY KEY (orders_products_download_id),
  KEY idx_orders_products_download_orders_id (orders_id)
);

DROP TABLE IF EXISTS orders_status;
CREATE TABLE orders_status (
  orders_status_id int DEFAULT '0' NOT NULL,
  language_id int DEFAULT '1' NOT NULL,
  orders_status_name varchar(32) NOT NULL,
  public_flag int DEFAULT '1',
  downloads_flag int DEFAULT '0',
  PRIMARY KEY (orders_status_id, language_id),
  KEY idx_orders_status_name (orders_status_name)
);

DROP TABLE IF EXISTS orders_status_history;
CREATE TABLE orders_status_history (
  orders_status_history_id int NOT NULL auto_increment,
  orders_id int NOT NULL,
  orders_status_id int(5) NOT NULL,
  date_added datetime NOT NULL,
  customer_notified int(1) DEFAULT '0',
  comments text,
  PRIMARY KEY (orders_status_history_id),
  KEY idx_orders_status_history_orders_id (orders_id)
);

DROP TABLE IF EXISTS orders_total;
CREATE TABLE orders_total (
  orders_total_id int unsigned NOT NULL auto_increment,
  orders_id int NOT NULL,
  title varchar(255) NOT NULL,
  text varchar(255) NOT NULL,
  value decimal(15,4) NOT NULL,
  class varchar(32) NOT NULL,
  sort_order int NOT NULL,
  PRIMARY KEY (orders_total_id),
  KEY idx_orders_total_orders_id (orders_id)
);

DROP TABLE IF EXISTS packaging;
CREATE TABLE packaging (
  package_id int NOT NULL auto_increment,
  package_name varchar(64) NOT NULL,
  package_description varchar(255) NOT NULL,
  package_length decimal(6,2) NOT NULL default '5.00',
  package_width decimal(6,2) NOT NULL default '5.00',
  package_height decimal(6,2) NOT NULL default '5.00',
  package_empty_weight decimal(6,2) NOT NULL default '0.00',
  package_max_weight decimal(6,2) NOT NULL default '50.00',
  package_cost int(5) NOT NULL default '0',
  PRIMARY KEY (package_id)
);

DROP TABLE IF EXISTS paypal_ipn;
CREATE TABLE paypal_ipn (
  paypal_ipn_id int(10) unsigned NOT NULL auto_increment,
  txn_type int(10) unsigned NOT NULL default '0',
  reason_code int default NULL,
  payment_type int NOT NULL default '0',
  payment_status int NOT NULL default '0',
  pending_reason int default NULL,
  invoice varchar(64) default NULL,
  mc_currency int NOT NULL default '1',
  first_name varchar(32) NOT NULL,
  last_name varchar(32) NOT NULL,
  payer_business_name varchar(32) default NULL,
  address_name varchar(32) NOT NULL,
  address_street varchar(64) NOT NULL,
  address_city varchar(32) NOT NULL,
  address_state varchar(32) NOT NULL,
  address_zip varchar(64) NOT NULL,
  address_country varchar(32) NOT NULL,
  address_status varchar(64) NOT NULL,
  address_owner varchar(64) NOT NULL default '0',
  payer_email varchar(96) NOT NULL,
  ebay_address_id varchar(96) default NULL,
  payer_id varchar(32) NOT NULL,
  payer_status varchar(32) NOT NULL,
  payment_date varchar(32) NOT NULL,
  business varchar(32) NOT NULL,
  receiver_email varchar(96) NOT NULL,
  receiver_id varchar(32) NOT NULL,
  paypal_address_id varchar(64) NOT NULL,
  txn_id varchar(17) NOT NULL,
  notify_version varchar(17) NOT NULL,
  verify_sign varchar(64) NOT NULL,
  date_added datetime NOT NULL,
  PRIMARY KEY (paypal_ipn_id,txn_id),
  KEY idx_paypal_ipn_paypal_ipn_id (paypal_ipn_id)
);

DROP TABLE IF EXISTS products;
CREATE TABLE products (
  products_id int(11) NOT NULL auto_increment,
  products_quantity int(4) NOT NULL,
  products_model varchar(12) default NULL,
  products_image varchar(64) default NULL,
  products_price decimal(15,4) NOT NULL,
  products_date_added datetime NOT NULL,
  products_last_modified datetime default NULL,
  products_date_available datetime default NULL,
  products_weight decimal(5,2) NOT NULL,
  products_status tinyint(1) NOT NULL,
  products_tax_class_id int(11) NOT NULL,
  manufacturers_id int(11) default NULL,
  products_ordered int(11) NOT NULL default '0',
  products_ship_price decimal(15,4) NOT NULL default '0.0000',
  products_length decimal(6,2) NOT NULL default '12.00',
  products_width decimal(6,2) NOT NULL default '12.00',
  products_height decimal(6,2) NOT NULL default '12.00',
  products_ready_to_ship int(1) NOT NULL default '0',
  PRIMARY KEY  (products_id),
  KEY idx_products_model (products_model),
  KEY idx_products_date_added (products_date_added)
);

DROP TABLE IF EXISTS products_attributes;
CREATE TABLE products_attributes (
  products_attributes_id int NOT NULL auto_increment,
  products_id int NOT NULL,
  options_id int NOT NULL,
  options_values_id int NOT NULL,
  options_values_price decimal(15,4) NOT NULL,
  price_prefix char(1) NOT NULL,
  PRIMARY KEY (products_attributes_id),
  KEY idx_products_attributes_products_id (products_id)
);

DROP TABLE IF EXISTS products_attributes_download;
CREATE TABLE products_attributes_download (
  products_attributes_id int NOT NULL,
  products_attributes_filename varchar(255) NOT NULL,
  products_attributes_maxdays int(2) default '0',
  products_attributes_maxcount int(2) default '0',
  PRIMARY KEY (products_attributes_id)
);

DROP TABLE IF EXISTS products_description;
CREATE TABLE products_description (
  products_id int NOT NULL auto_increment,
  language_id int NOT NULL default '1',
  products_name varchar(64) NOT NULL,
  products_description text,
  products_url varchar(255) default NULL,
  products_viewed int(5) default '0',
  PRIMARY KEY (products_id,language_id),
  KEY products_name (products_name)
);

DROP TABLE IF EXISTS products_groups;
CREATE TABLE products_groups (
  customers_group_id int NOT NULL default '0',
  customers_group_price decimal(15,4) NOT NULL default '0.0000',
  products_id int NOT NULL default '0',
  products_price decimal(15,4) NOT NULL default '0.0000'
);

DROP TABLE IF EXISTS products_notifications;
CREATE TABLE products_notifications (
  products_id int NOT NULL,
  customers_id int NOT NULL,
  date_added datetime NOT NULL,
  PRIMARY KEY (products_id, customers_id)
);

DROP TABLE IF EXISTS products_options;
CREATE TABLE products_options (
  products_options_id int NOT NULL default '0',
  language_id int NOT NULL default '1',
  products_options_name varchar(32) NOT NULL default '',
  products_options_track_stock tinyint(4) NOT NULL default '0',
  products_options_type int(5) NOT NULL default '0',
  products_options_length smallint(2) NOT NULL default '32',
  products_options_comment varchar(32) default NULL,
  PRIMARY KEY (products_options_id,language_id)
);

DROP TABLE IF EXISTS products_options_values;
CREATE TABLE products_options_values (
  products_options_values_id int NOT NULL default '0',
  language_id int NOT NULL default '1',
  products_options_values_name varchar(64) NOT NULL default '',
  PRIMARY KEY (products_options_values_id,language_id)
);

DROP TABLE IF EXISTS products_options_values_to_products_options;
CREATE TABLE products_options_values_to_products_options (
  products_options_values_to_products_options_id int NOT NULL auto_increment,
  products_options_id int NOT NULL,
  products_options_values_id int NOT NULL,
  PRIMARY KEY (products_options_values_to_products_options_id)
);

DROP TABLE IF EXISTS products_stock;
CREATE TABLE products_stock (
  products_stock_id int NOT NULL auto_increment,
  products_id int NOT NULL default '0',
  products_stock_attributes varchar(255) NOT NULL,
  products_stock_quantity int NOT NULL default '0',
  PRIMARY KEY (products_stock_id),
  UNIQUE idx_products_stock_attributes (products_id, products_stock_attributes)
);

DROP TABLE IF EXISTS products_to_categories;
CREATE TABLE products_to_categories (
  products_id int NOT NULL,
  categories_id int NOT NULL,
  PRIMARY KEY (products_id,categories_id)
);

DROP TABLE IF EXISTS products_xsell;
CREATE TABLE products_xsell (
  ID int(10) NOT NULL auto_increment,
  products_id int(10) unsigned NOT NULL default '1',
  xsell_id int(10) unsigned NOT NULL default '1',
  sort_order int(10) unsigned NOT NULL default '1',
  PRIMARY KEY (ID)
);

DROP TABLE IF EXISTS reviews;
CREATE TABLE reviews (
  reviews_id int NOT NULL auto_increment,
  products_id int NOT NULL,
  customers_id int,
  customers_name varchar(64) NOT NULL,
  reviews_rating int(1),
  date_added datetime,
  last_modified datetime,
  reviews_read int(5) NOT NULL default '0',
  PRIMARY KEY (reviews_id),
  KEY idx_reviews_products_id (products_id),
  KEY idx_reviews_customers_id (customers_id)
);

DROP TABLE IF EXISTS reviews_description;
CREATE TABLE reviews_description (
  reviews_id int NOT NULL,
  languages_id int NOT NULL,
  reviews_text text NOT NULL,
  PRIMARY KEY (reviews_id, languages_id)
);

DROP TABLE IF EXISTS scart;
CREATE TABLE scart (
  scartid int(11) NOT NULL AUTO_INCREMENT,
  customers_id int(11) NOT NULL,
  dateadded varchar(8) NOT NULL,
  datemodified varchar(8) NOT NULL,
  PRIMARY KEY (scartid),
  UNIQUE KEY scartid (scartid),
  UNIQUE KEY customers_id (customers_id)
);

DROP TABLE IF EXISTS searchword_swap;
CREATE TABLE searchword_swap (
  sws_id mediumint(11) NOT NULL auto_increment,
  sws_word varchar(100) NOT NULL,
  sws_replacement varchar(100) NOT NULL,
  PRIMARY KEY  (sws_id)
) TYPE=MyISAM;

DROP TABLE IF EXISTS search_queries;
CREATE TABLE search_queries (
  search_id int NOT NULL auto_increment,
  search_text tinytext,
  PRIMARY KEY (search_id)
);

DROP TABLE IF EXISTS search_queries_sorted;
CREATE TABLE search_queries_sorted (
  search_id smallint(6) NOT NULL auto_increment,
  search_text tinytext NOT NULL,
  search_count int NOT NULL default '0',
  PRIMARY KEY (search_id)
);

DROP TABLE IF EXISTS sessions;
CREATE TABLE sessions (
  sesskey varchar(32) NOT NULL,
  expiry int unsigned NOT NULL,
  value text NOT NULL,
  PRIMARY KEY (sesskey)
);

DROP TABLE IF EXISTS shipping_manifest;
CREATE TABLE shipping_manifest (
  delivery_id int(5) NOT NULL auto_increment,
  orders_id int(6) NOT NULL default '0',
  delivery_name varchar(128) NOT NULL,
  delivery_company varchar(128) NOT NULL,
  delivery_address_1 varchar(128) NOT NULL,
  delivery_address_2 varchar(128) NOT NULL,
  delivery_city varchar(64) NOT NULL,
  delivery_state char(2) NOT NULL,
  delivery_postcode varchar(10) NOT NULL,
  delivery_phone varchar(10) NOT NULL,
  package_weight char(3) NOT NULL,
  package_value varchar(4) NOT NULL,
  oversized int(1) NOT NULL default '0',
  pickup_date date NOT NULL default '0000-00-00',
  shipping_type varchar(64) NOT NULL,
  residential char(1) NOT NULL,
  cod int(1) NOT NULL default '0',
  tracking_num varchar(20) NOT NULL,
  multiple int(3) NOT NULL default '0',
  PRIMARY KEY (delivery_id),
  UNIQUE tracking_num (tracking_num)
);

DROP TABLE IF EXISTS specials;
CREATE TABLE specials (
  specials_id int NOT NULL auto_increment,
  products_id int NOT NULL,
  specials_new_products_price decimal(15,4) NOT NULL,
  specials_date_added datetime,
  specials_last_modified datetime,
  expires_date datetime,
  date_status_change datetime,
  status int(1) NOT NULL DEFAULT '1',
  customers_group_id int NOT NULL default '0',
  PRIMARY KEY (specials_id),
  KEY idx_specials_products_id (products_id)
);

DROP TABLE IF EXISTS specials_retail_prices;
CREATE TABLE specials_retail_prices (
  products_id int NOT NULL default '0',
  specials_new_products_price decimal(15,4) NOT NULL default '0.0000',
  `status` tinyint(4) default NULL,
  customers_group_id smallint(6) default NULL,
  PRIMARY KEY (products_id)
);

DROP TABLE IF EXISTS tax_class;
CREATE TABLE tax_class (
  tax_class_id int NOT NULL auto_increment,
  tax_class_title varchar(32) NOT NULL,
  tax_class_description varchar(255) NOT NULL,
  last_modified datetime NULL,
  date_added datetime NOT NULL,
  PRIMARY KEY (tax_class_id)
);

DROP TABLE IF EXISTS tax_rates;
CREATE TABLE tax_rates (
  tax_rates_id int NOT NULL auto_increment,
  tax_zone_id int NOT NULL,
  tax_class_id int NOT NULL,
  tax_priority int(5) DEFAULT 1,
  tax_rate decimal(7,4) NOT NULL,
  tax_description varchar(255) NOT NULL,
  last_modified datetime NULL,
  date_added datetime NOT NULL,
  PRIMARY KEY (tax_rates_id)
);

DROP TABLE IF EXISTS theme_configuration;
CREATE TABLE theme_configuration (
  configuration_id int NOT NULL auto_increment,
  configuration_title varchar(64) NOT NULL,
  configuration_key varchar(64) NOT NULL default 'BOX_HEADING_',
  configuration_value varchar(255) NOT NULL,
  configuration_description varchar(255) NOT NULL,
  configuration_group_id int NOT NULL default '1',
  configuration_column varchar(64) NOT NULL default 'left',
  location int(5) NOT NULL default '0',
  sort_order int(5) default NULL,
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  box_heading varchar(64) NOT NULL,
  PRIMARY KEY (configuration_id)
);

DROP TABLE IF EXISTS topics;
CREATE TABLE topics (
  topics_id int NOT NULL auto_increment,
  topics_image varchar(64) default NULL,
  parent_id int NOT NULL default '0',
  sort_order int(3) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  PRIMARY KEY (topics_id),
  KEY idx_topics_parent_id (parent_id)
);

DROP TABLE IF EXISTS topics_description;
CREATE TABLE topics_description (
  topics_id int NOT NULL default '0',
  language_id int NOT NULL default '1',
  topics_name varchar(32) NOT NULL,
  topics_heading_title varchar(64) default NULL,
  topics_description text,
  PRIMARY KEY (topics_id,language_id),
  KEY idx_topics_name (topics_name)
);

DROP TABLE IF EXISTS ups_boxes_used;
CREATE TABLE ups_boxes_used (
  id int NOT NULL auto_increment,
  date datetime DEFAULT NULL,
  customers_id int NOT NULL,
  boxes text,
  PRIMARY KEY  (id)
);

DROP TABLE IF EXISTS whos_online;
CREATE TABLE whos_online (
  customer_id int,
  full_name varchar(64) NOT NULL,
  session_id varchar(128) NOT NULL,
  ip_address varchar(15) NOT NULL,
  hostname VARCHAR(255) NOT NULL,
  country_code varchar(2) NOT NULL,
  country_name VARCHAR(64) NOT NULL,
  region_name VARCHAR(64) NOT NULL,
  city VARCHAR(64) NOT NULL,
  latitude FLOAT NOT NULL,
  longitude FLOAT NOT NULL,
  time_entry varchar(14) NOT NULL,
  time_last_click varchar(14) NOT NULL,
  last_page_url text NOT NULL,
  http_referer VARCHAR(255) NOT NULL,
  user_agent VARCHAR(255) NOT NULL,
  KEY idx_ip_address (ip_address),
  KEY idx_country_code (country_code)
);

DROP TABLE IF EXISTS zones;
CREATE TABLE zones (
  zone_id int NOT NULL auto_increment,
  zone_country_id int NOT NULL,
  zone_code varchar(32) NOT NULL,
  zone_name varchar(32) NOT NULL,
  PRIMARY KEY (zone_id),
  KEY idx_zones_country_id (zone_country_id),
  KEY idx_zones_to_geo_zones_country_id (zone_country_id)
);

DROP TABLE IF EXISTS zones_to_geo_zones;
CREATE TABLE zones_to_geo_zones (
  association_id int NOT NULL auto_increment,
  zone_country_id int NOT NULL,
  zone_id int NULL,
  geo_zone_id int NULL,
  last_modified datetime NULL,
  date_added datetime NOT NULL,
  PRIMARY KEY (association_id),
  KEY idx_zones_to_geo_zones_country_id (zone_country_id)
);


# data

# 1 - Default, 2 - USA, 3 - Spain, 4 - Singapore, 5 - Germany, 6 - UK
INSERT INTO address_format VALUES (1,'$firstname $lastname$cr$streets$cr$city,$postcode$cr$statecomma$country','$city / $country');
INSERT INTO address_format VALUES (2,'$firstname $lastname$cr$streets$cr$city,$state    $postcode$cr$country','$city,$state / $country');
INSERT INTO address_format VALUES (3,'$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country','$state / $country');
INSERT INTO address_format VALUES (4,'$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country','$postcode / $country');
INSERT INTO address_format VALUES (5,'$firstname $lastname$cr$streets$cr$postcode $city$cr$country','$city / $country');
INSERT INTO address_format VALUES (6,'$firstname $lastname$cr$streets$cr$suburb$cr$city$cr$state$cr$postcode$cr$country','$city / $country');

# INSERT INTO admin VALUES ('1','1','Admin','Default','Admin','admin@localhost.com','05cdeb1aeaffec1c7ae3f12c570a658c:81',now(),NULL,NULL,'1');
  
INSERT INTO admin_files VALUES (1,'administrator.php',1,0,'1');
INSERT INTO admin_files VALUES (2,'configuration.php',1,0,'1');
INSERT INTO admin_files VALUES (3,'catalog.php',1,0,'1');
INSERT INTO admin_files VALUES (4,'modules.php',1,0,'1');
INSERT INTO admin_files VALUES (5,'customers.php',1,0,'1');
INSERT INTO admin_files VALUES (6,'taxes.php',1,0,'1');
INSERT INTO admin_files VALUES (7,'localization.php',1,0,'1');
INSERT INTO admin_files VALUES (8,'reports.php',1,0,'1');
INSERT INTO admin_files VALUES (9,'tools.php',1,0,'1');
INSERT INTO admin_files VALUES (10,'admin_members.php',0,1,'1');
INSERT INTO admin_files VALUES (11,'admin_files.php',0,1,'1');
INSERT INTO admin_files VALUES (12,'configuration.php',0,2,'1');
INSERT INTO admin_files VALUES (13,'categories.php',0,3,'1');
INSERT INTO admin_files VALUES (14,'products_attributes.php',0,3,'1');
INSERT INTO admin_files VALUES (15,'manufacturers.php',0,3,'1');
INSERT INTO admin_files VALUES (16,'reviews.php',0,3,'1');
INSERT INTO admin_files VALUES (17,'specials.php',0,3,'1');
INSERT INTO admin_files VALUES (18,'products_expected.php',0,3,'1');
INSERT INTO admin_files VALUES (19,'modules.php',0,4,'1');
INSERT INTO admin_files VALUES (20,'customers.php',0,5,'1');
INSERT INTO admin_files VALUES (21,'orders.php',0,5,'1');
INSERT INTO admin_files VALUES (22,'countries.php',0,6,'1');
INSERT INTO admin_files VALUES (23,'zones.php',0,6,'1');
INSERT INTO admin_files VALUES (24,'geo_zones.php',0,6,'1');
INSERT INTO admin_files VALUES (25,'tax_classes.php',0,6,'1');
INSERT INTO admin_files VALUES (26,'tax_rates.php',0,6,'1');
INSERT INTO admin_files VALUES (27,'currencies.php',0,7,'1');
INSERT INTO admin_files VALUES (28,'languages.php',0,7,'1');
INSERT INTO admin_files VALUES (29,'orders_status.php',0,7,'1');
INSERT INTO admin_files VALUES (30,'stats_products_viewed.php',0,8,'1');
INSERT INTO admin_files VALUES (31,'stats_products_purchased.php',0,8,'1');
INSERT INTO admin_files VALUES (32,'stats_customers.php',0,8,'1');
INSERT INTO admin_files VALUES (33,'backup.php',0,9,'1');
INSERT INTO admin_files VALUES (34,'banner_manager.php',0,9,'1');
INSERT INTO admin_files VALUES (35,'cache.php',0,9,'1');
INSERT INTO admin_files VALUES (36,'define_language.php',0,9,'1');
INSERT INTO admin_files VALUES (37,'file_manager.php',0,9,'1');
INSERT INTO admin_files VALUES (38,'mail.php',0,9,'1');
INSERT INTO admin_files VALUES (39,'newsletters.php',0,9,'1');
INSERT INTO admin_files VALUES (40,'server_info.php',0,9,'1');
INSERT INTO admin_files VALUES (41,'whos_online.php',0,9,'1');
INSERT INTO admin_files VALUES (42,'banner_statistics.php',0,9,'1');
INSERT INTO admin_files VALUES (43,'affiliate.php',1,0,'1');
INSERT INTO admin_files VALUES (44,'affiliate_affiliates.php',0,43,'1');
INSERT INTO admin_files VALUES (45,'affiliate_clicks.php',0,43,'1');
INSERT INTO admin_files VALUES (46,'affiliate_banners.php',0,43,'1');
INSERT INTO admin_files VALUES (47,'affiliate_contact.php',0,43,'1');
INSERT INTO admin_files VALUES (48,'affiliate_invoice.php',0,43,'1');
INSERT INTO admin_files VALUES (49,'affiliate_payment.php',0,43,'1');
INSERT INTO admin_files VALUES (50,'affiliate_popup_image.php',0,43,'1');
INSERT INTO admin_files VALUES (51,'affiliate_sales.php',0,43,'1');
INSERT INTO admin_files VALUES (52,'affiliate_statistics.php',0,43,'1');
INSERT INTO admin_files VALUES (53,'affiliate_summary.php',0,43,'1');
INSERT INTO admin_files VALUES (54,'gv_admin.php',1,0,'1');
INSERT INTO admin_files VALUES (55,'coupon_admin.php',0,54,'1');
INSERT INTO admin_files VALUES (56,'gv_queue.php',0,54,'1');
INSERT INTO admin_files VALUES (57,'gv_mail.php',0,54,'1');
INSERT INTO admin_files VALUES (58,'gv_sent.php',0,54,'1');
INSERT INTO admin_files VALUES (59,'paypalipn.php',1,0,'1');
INSERT INTO admin_files VALUES (60,'paypalipn_tests.php',0,59,'1');
INSERT INTO admin_files VALUES (61,'paypalipn_txn.php',0,59,'1');
INSERT INTO admin_files VALUES (62,'coupon_restrict.php',0,54,'1');
INSERT INTO admin_files VALUES (64,'xsell_products.php',0,3,'1');
INSERT INTO admin_files VALUES (65,'easypopulate.php',0,3,'1');
INSERT INTO admin_files VALUES (68,'define_mainpage.php',0,3,'1');
INSERT INTO admin_files VALUES (70,'edit_orders.php',0,5,'1');
INSERT INTO admin_files VALUES (71,'validproducts.php',0,54,'1');
INSERT INTO admin_files VALUES (72,'validcategories.php',0,54,'1');
INSERT INTO admin_files VALUES (73,'listcategories.php',0,54,'1');
INSERT INTO admin_files VALUES (74,'listproducts.php',0,54,'1');
INSERT INTO admin_files VALUES (75,'new_attributes.php',0,3,'1');
INSERT INTO admin_files VALUES (80,'paypal_ipn_order.php',0,5,'1');
INSERT INTO admin_files VALUES (78,'paypal_ipn.php',0,5,'1');
INSERT INTO admin_files VALUES (81,'articles.php',1,0,'1');
INSERT INTO admin_files VALUES (82,'article_reviews.php',0,81,'1');
INSERT INTO admin_files VALUES (83,'articles.php',0,81,'1');
INSERT INTO admin_files VALUES (84,'articles_config.php',0,81,'1');
INSERT INTO admin_files VALUES (85,'articles_xsell.php',0,81,'1');
INSERT INTO admin_files VALUES (86,'authors.php',0,81,'1');
INSERT INTO admin_files VALUES (87,'recover_cart_sales.php',0,8,'1');
INSERT INTO admin_files VALUES (88,'stats_recover_cart_sales.php',0,8,'1');
INSERT INTO admin_files VALUES (89,'stats_monthly_sales.php',0,8,'1');
INSERT INTO admin_files VALUES (90,'batch_print.php',0,9,'1');
INSERT INTO admin_files VALUES (91,'stock.php',0,3,'1');
INSERT INTO admin_files VALUES (92,'stats_low_stock_attrib.php',0,3,'1');
INSERT INTO admin_files VALUES (93,'info_boxes.php',1,0,'1');
INSERT INTO admin_files VALUES (94,'infobox_configuration.php',0,93,'1');
INSERT INTO admin_files VALUES (95,'popup_infobox_help.php',0,93,'1');
INSERT INTO admin_files VALUES (98,'customers_groups.php',0,5,'1');
INSERT INTO admin_files VALUES (99,'define_conditions.php',0,3,'1');
INSERT INTO admin_files VALUES (100,'define_privacy.php',0,3,'1');
INSERT INTO admin_files VALUES (101,'define_shipping.php',0,3,'1');
INSERT INTO admin_files VALUES (102,'xsell.php',0,3,'1');
INSERT INTO admin_files VALUES (103,'create_account.php',0,5,'1');
INSERT INTO admin_files VALUES (104,'create_account_process.php',0,5,'1');
INSERT INTO admin_files VALUES (105,'create_account_success.php',0,5,'1');
INSERT INTO admin_files VALUES (106,'create_order.php',0,5,'1');
INSERT INTO admin_files VALUES (107,'create_order_process.php',0,5,'1');
INSERT INTO admin_files VALUES (108,'easypopulate_functions.php',0,3,'1');
INSERT INTO admin_files VALUES (109,'new_attributes_change.php',0,3,'1');
INSERT INTO admin_files VALUES (110,'new_attributes_config.php',0,3,'1');
INSERT INTO admin_files VALUES (111,'new_attributes_functions.php',0,3,'1');
INSERT INTO admin_files VALUES (112,'new_attributes_include.php',0,3,'1');
INSERT INTO admin_files VALUES (113,'new_attributes_select.php',0,3,'1');
INSERT INTO admin_files VALUES (114,'ship_fedex.php',0,8,'1');
INSERT INTO admin_files VALUES (115,'fedex_popup.php',0,8,'1');
INSERT INTO admin_files VALUES (116,'shipping_manifest.php',0,8,'1');
INSERT INTO admin_files VALUES (117,'track_fedex.php',0,8,'1');
INSERT INTO admin_files VALUES (118,'paypal_info.php',0,1,'1');
INSERT INTO admin_files VALUES (119,'affiliate_info.php',0,1,'1');
INSERT INTO admin_files VALUES (120,'domain_info.php',0,1,'1');
INSERT INTO admin_files VALUES (121,'hosting_info.php',0,1,'1');
INSERT INTO admin_files VALUES (122,'merchant_info.php',0,1,'1');
INSERT INTO admin_files VALUES (123,'ssl_info.php',0,1,'1');
INSERT INTO admin_files VALUES (124,'affiliate_news.php',0,43,'1');
INSERT INTO admin_files VALUES (125,'affiliate_newsletters.php',0,43,'1');
INSERT INTO admin_files VALUES (126,'affiliate_validcats.php',0,43,'1');
INSERT INTO admin_files VALUES (127,'affiliate_validproducts.php',0,43,'1');
INSERT INTO admin_files VALUES (128,'edit_orders_add_product.php',0,5,'1');
INSERT INTO admin_files VALUES (129,'edit_orders_ajax.php',0,5,'1');
INSERT INTO admin_files VALUES (130,'attributeManager.php', 0, 3, '1');
INSERT INTO admin_files VALUES (131,'qtprodoctor.php',0,9,'1');
#Bugfix 324: Missing values
INSERT INTO admin_files VALUES (132,'packaging.php',0,9,'1');
INSERT INTO admin_files VALUES (133,'ups_boxes_used.php',0,9,'1');
INSERT INTO admin_files VALUES (134,'stats_credits.php',0,8,'1');
INSERT INTO admin_files VALUES (135,'treeview.php',0,54,'1');


INSERT INTO admin_groups VALUES (1,'Top Administrator');
INSERT INTO admin_groups VALUES (2,'Customer Service');


INSERT INTO affiliate_payment_status VALUES (0,1,'Pending');
INSERT INTO affiliate_payment_status VALUES (0,2,'Offen');
INSERT INTO affiliate_payment_status VALUES (0,3,'Pendiente');
INSERT INTO affiliate_payment_status VALUES (1,1,'Paid');
INSERT INTO affiliate_payment_status VALUES (1,2,'Ausgezahlt');
INSERT INTO affiliate_payment_status VALUES (1,3,'Pagado');


INSERT INTO configuration VALUES (1,'Store Name','STORE_NAME','Store Name','The name of my store','1','1',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (2,'Store Owner','STORE_OWNER','Owners Name','The name of my store owner','1','2',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (3,'E-Mail Address','STORE_OWNER_EMAIL_ADDRESS','your@email.com','The e-mail address of my store owner','1','3',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (4,'E-Mail From','EMAIL_FROM','Your Mail <admin@yourshop.com>','The e-mail address used in (sent) e-mails','1','4',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (5,'Country','STORE_COUNTRY','223','The country my store is located in <br><br><b>Note: Please remember to update the store zone.</b>','1','6',NULL,now(),'tep_get_country_name','tep_cfg_pull_down_country_list(');
INSERT INTO configuration VALUES (6,'Zone','STORE_ZONE','4','The zone my store is located in','1','7',NULL,now(),'tep_cfg_get_zone_name','tep_cfg_pull_down_zone_list(');
INSERT INTO configuration VALUES (7,'Expected Sort Order','EXPECTED_PRODUCTS_SORT','desc','This is the sort order used in the expected products box.','1','8',NULL,now(),NULL,'tep_cfg_select_option(array(''asc'',''desc''),');
INSERT INTO configuration VALUES (8,'Expected Sort Field','EXPECTED_PRODUCTS_FIELD','date_expected','The column to sort by in the expected products box.','1','9',NULL,now(),NULL,'tep_cfg_select_option(array(''products_name'',''date_expected''),');
INSERT INTO configuration VALUES (9,'Switch To Default Language Currency','USE_DEFAULT_LANGUAGE_CURRENCY','false','Automatically switch to the language\'s currency when it is changed','1','10',NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (10,'Send Extra Order Emails To','SEND_EXTRA_ORDER_EMAILS_TO','','Send extra order emails to the following email addresses,in this format: Name 1 &lt;email@address1&gt;,Name 2 &lt;email@address2&gt;','1','11',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (12,'Display Cart After Adding Product','DISPLAY_CART','true','Display the shopping cart after adding a product (or return back to their origin)','1','14',NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (13,'Allow Guest To Tell A Friend','ALLOW_GUEST_TO_TELL_A_FRIEND','false','Allow guests to tell a friend about a product','1','15',NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (14,'Default Search Operator','ADVANCED_SEARCH_DEFAULT_OPERATOR','and','Default search operators','1','17',NULL,now(),NULL,'tep_cfg_select_option(array(\'and\', \'or\'),');
INSERT INTO configuration VALUES (15,'Store Address and Phone','STORE_NAME_ADDRESS','Store Name\nAddress\nCountry\nPhone','This is the Store Name,Address and Phone used on printable documents and displayed online','1','18',NULL,now(),NULL,'tep_cfg_textarea(');
INSERT INTO configuration VALUES (16,'Show Category Counts','SHOW_COUNTS','false','Count recursively how many products are in each category','1','19',NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (17,'Tax Decimal Places','TAX_DECIMAL_PLACES','2','Pad the tax value this amount of decimal places','1','20',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (18,'Display Prices with Tax','DISPLAY_PRICE_WITH_TAX','false','Display prices with tax included (true) or add the tax at the end (false)','1','21',NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');

INSERT INTO configuration VALUES (19,'First Name','ENTRY_FIRST_NAME_MIN_LENGTH','2','Minimum length of first name','2','1',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (20,'Last Name','ENTRY_LAST_NAME_MIN_LENGTH','2','Minimum length of last name','2','2',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (21,'Date of Birth','ENTRY_DOB_MIN_LENGTH','10','Minimum length of date of birth','2','3',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (22,'E-Mail Address','ENTRY_EMAIL_ADDRESS_MIN_LENGTH','6','Minimum length of e-mail address','2','4',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (23,'Street Address','ENTRY_STREET_ADDRESS_MIN_LENGTH','5','Minimum length of street address','2','5',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (24,'Company','ENTRY_COMPANY_MIN_LENGTH','2','Minimum length of company name','2','6',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (25,'Post Code','ENTRY_POSTCODE_MIN_LENGTH','4','Minimum length of post code','2','7',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (26,'City','ENTRY_CITY_MIN_LENGTH','3','Minimum length of city','2','8',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (27,'State','ENTRY_STATE_MIN_LENGTH','2','Minimum length of state','2','9',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (28,'Telephone Number','ENTRY_TELEPHONE_MIN_LENGTH','3','Minimum length of telephone number','2','10',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (29,'Password','ENTRY_PASSWORD_MIN_LENGTH','5','Minimum length of password','2','11',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (30,'Credit Card Owner Name','CC_OWNER_MIN_LENGTH','3','Minimum length of credit card owner name','2','12',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (31,'Credit Card Number','CC_NUMBER_MIN_LENGTH','10','Minimum length of credit card number','2','13',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (32,'Review Text','REVIEW_TEXT_MIN_LENGTH','50','Minimum length of review text','2','14',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (33,'Best Sellers','MIN_DISPLAY_BESTSELLERS','1','Minimum number of best sellers to display','2','15',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (34,'Also Purchased','MIN_DISPLAY_ALSO_PURCHASED','1','Minimum number of products to display in the \'This Customer Also Purchased\' box','2','16',NULL,now(),NULL,NULL);

INSERT INTO configuration VALUES (35,'Address Book Entries','MAX_ADDRESS_BOOK_ENTRIES','5','Maximum address book entries a customer is allowed to have','3','1',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (36,'Search Results','MAX_DISPLAY_SEARCH_RESULTS','20','Amount of products to list','3','2',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (37,'Page Links','MAX_DISPLAY_PAGE_LINKS','5','Number of \'number\' links use for page-sets','3','3',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (38,'Special Products','MAX_DISPLAY_SPECIAL_PRODUCTS','9','Maximum number of products on special to display','3','4',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (39,'New Products Module','MAX_DISPLAY_NEW_PRODUCTS','9','Maximum number of new products to display in a category','3','5',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (40,'Products Expected','MAX_DISPLAY_UPCOMING_PRODUCTS','10','Maximum number of products expected to display','3','6',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (41,'Manufacturers List','MAX_DISPLAY_MANUFACTURERS_IN_A_LIST','0','Used in manufacturers box; when the number of manufacturers exceeds this number,a drop-down list will be displayed instead of the default list','3','7',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (42,'Manufacturers Select Size','MAX_MANUFACTURERS_LIST','1','Used in manufacturers box; when this value is \'1\' the classic drop-down list will be used for the manufacturers box. Otherwise,a list-box with the specified number of rows will be displayed.','3','7',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (43,'Length of Manufacturers Name','MAX_DISPLAY_MANUFACTURER_NAME_LEN','15','Used in manufacturers box; maximum length of manufacturers name to display','3','8',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (44,'New Reviews','MAX_DISPLAY_NEW_REVIEWS','6','Maximum number of new reviews to display','3','9',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (45,'Selection of Random Reviews','MAX_RANDOM_SELECT_REVIEWS','10','How many records to select from to choose one random product review','3','10',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (46,'Selection of Random New Products','MAX_RANDOM_SELECT_NEW','10','How many records to select from to choose one random new product to display','3','11',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (47,'Selection of Products on Special','MAX_RANDOM_SELECT_SPECIALS','10','How many records to select from to choose one random product special to display','3','12',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (48,'Categories To List Per Row','MAX_DISPLAY_CATEGORIES_PER_ROW','3','How many categories to list per row','3','13',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (49,'New Products Listing','MAX_DISPLAY_PRODUCTS_NEW','10','Maximum number of new products to display in new products page','3','14',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (50,'Best Sellers','MAX_DISPLAY_BESTSELLERS','10','Maximum number of best sellers to display','3','15',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (51,'Also Purchased','MAX_DISPLAY_ALSO_PURCHASED','6','Maximum number of products to display in the \'This Customer Also Purchased\' box','3','16',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (52,'Customer Order History Box','MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX','6','Maximum number of products to display in the customer order history box','3','17',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (53,'Order History','MAX_DISPLAY_ORDER_HISTORY','10','Maximum number of orders to display in the order history page','3','18',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (54,'Product Quantities In Shopping Cart','MAX_QTY_IN_CART','99','Maximum number of product quantities that can be added to the shopping cart (0 for no limit)','3','19',NULL,now(),NULL,NULL);

INSERT INTO configuration VALUES (55,'Small Image Width','SMALL_IMAGE_WIDTH','120','The pixel width of small images','4','1',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (56,'Small Image Height','SMALL_IMAGE_HEIGHT','','The pixel height of small images','4','2',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (57,'Heading Image Width','HEADING_IMAGE_WIDTH','100','The pixel width of heading images','4','3',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (58,'Heading Image Height','HEADING_IMAGE_HEIGHT','','The pixel height of heading images','4','4',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (59,'Subcategory Image Width','SUBCATEGORY_IMAGE_WIDTH','100','The pixel width of subcategory images','4','5',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (60,'Subcategory Image Height','SUBCATEGORY_IMAGE_HEIGHT','','The pixel height of subcategory images','4','6',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (61,'Calculate Image Size','CONFIG_CALCULATE_IMAGE_SIZE','true','Calculate the size of images?','4','7',NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (62,'Image Required','IMAGE_REQUIRED','true','Enable to display broken images. Good for development.','4','8',NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');

INSERT INTO configuration VALUES (63,'Gender','ACCOUNT_GENDER','false','Display gender in the customers account','5','1',NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (64,'Date of Birth','ACCOUNT_DOB','false','Display date of birth in the customers account','5','2',NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (65,'Company','ACCOUNT_COMPANY','false','Display company in the customers account','5','3',NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (66,'Suburb','ACCOUNT_SUBURB','false','Display suburb in the customers account','5','4',NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (67,'State','ACCOUNT_STATE','true','Display state in the customers account','5','5',NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');

INSERT INTO configuration VALUES (68,'Installed Modules','MODULE_PAYMENT_INSTALLED','','List of payment module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: cc.php;cod.php;paypal.php)','6','0',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (69,'Installed Modules','MODULE_ORDER_TOTAL_INSTALLED','ot_subtotal.php;ot_shipping.php;ot_tax.php;ot_loyalty_discount.php;ot_loworderfee.php;ot_coupon.php;ot_gv.php;ot_total.php','List of order_total module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php)','6','0',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (70,'Installed Modules','MODULE_SHIPPING_INSTALLED','','List of shipping module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ups.php;flat.php;item.php)','6','0',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES ('77','Google Maps Key','GOOGLE_MAPS_KEY','YOURKEY','Put your Google Maps API Key here.<br><br>You can get one at http://code.google.com/apis/maps/signup.html','1','25',NULL,now(), NULL, 'tep_cfg_textarea(');
INSERT INTO configuration VALUES (85,'Default Currency','DEFAULT_CURRENCY','USD','Default Currency','6','0',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (86,'Default Language','DEFAULT_LANGUAGE','en','Default Language','6','0',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (87,'Default Order Status For New Orders','DEFAULT_ORDERS_STATUS_ID','1','When a new order is created, this order status will be assigned to it.','6','0',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (88,'Display Shipping','MODULE_ORDER_TOTAL_SHIPPING_STATUS','true','Do you want to display the order shipping cost?','6','1',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (89,'Sort Order','MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER','2','Sort order of display.','6','2',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (90,'Allow Free Shipping','MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING','false','Do you want to allow free shipping?','6','3',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (91,'Free Shipping For Orders Over','MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER','50','Provide free shipping for orders over the set amount.','6','4',NULL,now(),'currencies->format',NULL);
INSERT INTO configuration VALUES (92,'Provide Free Shipping For Orders Made','MODULE_ORDER_TOTAL_SHIPPING_DESTINATION','national','Provide free shipping for orders sent to the set destination.','6','5',NULL,now(),NULL, 'tep_cfg_select_option(array(\'national\', \'international\', \'both\'),');
INSERT INTO configuration VALUES (93,'Display Sub-Total','MODULE_ORDER_TOTAL_SUBTOTAL_STATUS','true','Do you want to display the order sub-total cost?','6','1',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (94,'Sort Order','MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER','1','Sort order of display.','6','2',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (95,'Display Tax','MODULE_ORDER_TOTAL_TAX_STATUS','true','Do you want to display the order tax value?','6','1',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (96,'Sort Order','MODULE_ORDER_TOTAL_TAX_SORT_ORDER','3','Sort order of display.','6','2',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (97,'Display Total','MODULE_ORDER_TOTAL_TOTAL_STATUS','true','Do you want to display the total order value?','6','1',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (98,'Sort Order','MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER','4','Sort order of display.','6','2',NULL,now(),NULL,NULL);

INSERT INTO configuration VALUES (99,'Country of Origin','SHIPPING_ORIGIN_COUNTRY','223','Select the country of origin to be used in shipping quotes.','7','1',NULL,now(),'tep_get_country_name','tep_cfg_pull_down_country_list(');
INSERT INTO configuration VALUES (100,'Postal Code','SHIPPING_ORIGIN_ZIP','NONE','Enter the Postal Code (ZIP) of the Store to be used in shipping quotes.','7','2',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (101,'Enter the Maximum Package Weight you will ship','SHIPPING_MAX_WEIGHT','50','Carriers have a max weight limit for a single package. This is a common one for all.','7','3',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (102,'Package Tare weight.','SHIPPING_BOX_WEIGHT','0','What is the weight of typical packaging of small to medium packages?','7','4',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (103,'Larger packages - percentage increase.','SHIPPING_BOX_PADDING','0','For 10% enter 10','7','5',NULL,now(),NULL,NULL);

INSERT INTO configuration VALUES (104,'Display Product Image','PRODUCT_LIST_IMAGE','1','Do you want to display the Product Image?','8','1',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (105,'Display Product Manufaturer Name','PRODUCT_LIST_MANUFACTURER','0','Do you want to display the Product Manufacturer Name?','8','2',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (106,'Display Product Model','PRODUCT_LIST_MODEL','0','Do you want to display the Product Model?','8','3',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (107,'Display Product Name','PRODUCT_LIST_NAME','2','Do you want to display the Product Name?','8','4',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (108,'Display Product Price','PRODUCT_LIST_PRICE','3','Do you want to display the Product Price','8','5',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (109,'Display Product Quantity','PRODUCT_LIST_QUANTITY','0','Do you want to display the Product Quantity?','8','6',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (110,'Display Product Weight','PRODUCT_LIST_WEIGHT','0','Do you want to display the Product Weight?','8','7',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (111,'Display Buy Now column','PRODUCT_LIST_BUY_NOW','4','Do you want to display the Buy Now column?','8','8',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (112,'Display Category/Manufacturer Filter (0=disable; 1=enable)','PRODUCT_LIST_FILTER','1','Do you want to display the Category/Manufacturer Filter?','8','9',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (113,'Location of Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)','PREV_NEXT_BAR_LOCATION','2','Sets the location of the Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)','8','10',NULL,now(),NULL,NULL);

INSERT INTO configuration VALUES (114,'Check stock level','STOCK_CHECK','true','Check to see if sufficent stock is available','9','1',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (115,'Subtract stock','STOCK_LIMITED','true','Subtract product in stock by product orders','9','2',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (116,'Allow Checkout','STOCK_ALLOW_CHECKOUT','true','Allow customer to checkout even if there is insufficient stock','9','3',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (117,'Mark product out of stock','STOCK_MARK_PRODUCT_OUT_OF_STOCK','***','Display something on screen so customer can see which product has insufficient stock','9','4',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (118,'Stock Re-order level','STOCK_REORDER_LEVEL','5','Define when stock needs to be re-ordered','9','5',NULL,now(),NULL,NULL);

INSERT INTO configuration VALUES (119,'Store Page Parse Time','STORE_PAGE_PARSE_TIME','false','Store the time it takes to parse a page','10','1',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (120,'Log Destination','STORE_PAGE_PARSE_TIME_LOG','/var/log/www/tep/page_parse_time.log','Directory and filename of the page parse time log','10','2',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (121,'Log Date Format','STORE_PARSE_DATE_TIME_FORMAT','%d/%m/%Y %H:%M:%S','The date format','10','3',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (122,'Display The Page Parse Time','DISPLAY_PAGE_PARSE_TIME','false','Display the page parse time (store page parse time must be enabled)','10','4',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (123,'Store Database Queries','STORE_DB_TRANSACTIONS','false','Store the database queries in the page parse time log (PHP4 only)','10','5',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

INSERT INTO configuration VALUES (124,'Use Cache','USE_CACHE','false','Use caching features.<br>CAUTION. This may cause issues and crash your site. Test first!','11','1',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (125,'Cache Directory','DIR_FS_CACHE','/tmp/','The directory where the cached files are saved','11','2',NULL,now(),NULL,NULL);

INSERT INTO configuration VALUES (126,'E-Mail Transport Method','EMAIL_TRANSPORT','sendmail','Defines if this server uses a local connection to sendmail or uses an SMTP connection via TCP/IP. Servers running on Windows and MacOS should change this setting to SMTP.','12','1',NULL,now(),NULL, 'tep_cfg_select_option(array(\'sendmail\', \'smtp\'),');
INSERT INTO configuration VALUES (127,'E-Mail Linefeeds','EMAIL_LINEFEED','LF','Defines the character sequence used to separate mail headers.','12','2',NULL,now(),NULL, 'tep_cfg_select_option(array(\'LF\', \'CRLF\'),');
INSERT INTO configuration VALUES (128,'Use MIME HTML When Sending Emails','EMAIL_USE_HTML','false','Send e-mails in HTML format','12','3',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (129,'Verify E-Mail Addresses Through DNS','ENTRY_EMAIL_ADDRESS_CHECK','false','Verify e-mail address through a DNS server','12','4',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (130,'Send E-Mails','SEND_EMAILS','true','Send out e-mails','12','5',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

INSERT INTO configuration VALUES (131,'Enable download','DOWNLOAD_ENABLED','true','Enable the products download functions.','13','1',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (132,'Download by redirect','DOWNLOAD_BY_REDIRECT','true','Use browser redirection for download. Disable on non-Unix systems.','13','2',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (133,'Expiry delay (days)','DOWNLOAD_MAX_DAYS','7','Set number of days before the download link expires. 0 means no limit.','13','3',NULL,now(),NULL, '');
INSERT INTO configuration VALUES (134,'Maximum number of downloads','DOWNLOAD_MAX_COUNT','5','Set the maximum number of downloads. 0 means no download authorized.','13','4',NULL,now(),NULL, '');

INSERT INTO configuration VALUES (135,'Enable GZip Compression','GZIP_COMPRESSION','false','Enable HTTP GZip compression.','14','1',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (136,'Compression Level','GZIP_LEVEL','5','Use this compression level 0-9 (0 = minimum, 9 = maximum).','14','2',NULL,now(),NULL,NULL);

INSERT INTO configuration VALUES (137,'Session Directory','SESSION_WRITE_DIRECTORY','/tmp','If sessions are file based, store them in this directory.','15','1',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (138,'Force Cookie Use','SESSION_FORCE_COOKIE_USE','False','Force the use of sessions when cookies are only enabled.','15','2',NULL,now(),NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO configuration VALUES (139,'Check SSL Session ID','SESSION_CHECK_SSL_SESSION_ID','False','Validate the SSL_SESSION_ID on every secure HTTPS page request.','15','3',NULL,now(),NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO configuration VALUES (140,'Check User Agent','SESSION_CHECK_USER_AGENT','False','Validate the clients browser user agent on every page request.','15','4',NULL,now(),NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO configuration VALUES (141,'Check IP Address','SESSION_CHECK_IP_ADDRESS','False','Validate the clients IP address on every page request.','15','5',NULL,now(),NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO configuration VALUES (142,'Prevent Spider Sessions','SESSION_BLOCK_SPIDERS','True','Prevent known spiders from starting a session.','15','6',NULL,now(),NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO configuration VALUES (143,'Recreate Session','SESSION_RECREATE','False','Recreate the session to generate a new session ID when the customer logs on or creates an account (PHP >=4.1 needed).','15','7',NULL,now(),NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');

# osCMax added
INSERT INTO configuration VALUES (144,'PRODUCT DESCRIPTIONS use WYSIWYG HTMLAREA?','HTML_AREA_WYSIWYG_DISABLE','Enable','Enable/Disable WYSIWYG box','25','0',NULL,now(),NULL, 'tep_cfg_select_option(array(\'Enable\', \'Disable\'),');
INSERT INTO configuration VALUES (145,'Product Description Basic/Advanced Version?','HTML_AREA_WYSIWYG_BASIC_PD','Advanced','Basic Features FASTER<br>Advanced Features SLOWER','25','10',NULL,now(),NULL, 'tep_cfg_select_option(array(\'Basic\', \'Advanced\'),');
INSERT INTO configuration VALUES (146,'Product Description Layout Width','HTML_AREA_WYSIWYG_WIDTH','700','How WIDE should the HTMLAREA be in pixels (default: 505)','25','15',NULL,now(),NULL, '');
INSERT INTO configuration VALUES (147,'Product Description Layout Height','HTML_AREA_WYSIWYG_HEIGHT','400','How HIGH should the HTMLAREA be in pixels (default: 240)','25','19',NULL,now(),NULL, '');
INSERT INTO configuration VALUES (148,'CUSTOMER EMAILS use WYSIWYG HTMLAREA?','HTML_AREA_WYSIWYG_DISABLE_EMAIL','Enable','Use WYSIWYG Area in Email Customers','25','20',NULL,now(),NULL, 'tep_cfg_select_option(array(\'Enable\', \'Disable\'),');
INSERT INTO configuration VALUES (149,'Customer Email Basic/Advanced Version?','HTML_AREA_WYSIWYG_BASIC_EMAIL','Advanced','Basic Features FASTER<br>Advanced Features SLOWER','25','21',NULL,now(),NULL, 'tep_cfg_select_option(array(\'Basic\', \'Advanced\'),');
INSERT INTO configuration VALUES (150,'Customer Email Layout Width','EMAIL_AREA_WYSIWYG_WIDTH','700','How WIDE should the HTMLAREA be in pixels (default: 505)','25','25',NULL,now(),NULL, '');
INSERT INTO configuration VALUES (151,'Customer Email Layout Height','EMAIL_AREA_WYSIWYG_HEIGHT','400','How HIGH should the HTMLAREA be in pixels (default: 140)','25','29',NULL,now(),NULL, '');
INSERT INTO configuration VALUES (152,'NEWSLETTER EMAILS use WYSIWYG HTMLAREA?','HTML_AREA_WYSIWYG_DISABLE_NEWSLETTER','Enable','Use WYSIWYG Area in Email Newsletter','25','30',NULL,now(),NULL, 'tep_cfg_select_option(array(\'Enable\', \'Disable\'),');
INSERT INTO configuration VALUES (153,'Newsletter Email Basic/Advanced Version?','HTML_AREA_WYSIWYG_BASIC_NEWSLETTER','Advanced','Basic Features FASTER<br>Advanced Features SLOWER','25','32',NULL,now(),NULL, 'tep_cfg_select_option(array(\'Basic\', \'Advanced\'),');
INSERT INTO configuration VALUES (154,'Newsletter Email Layout Width','NEWSLETTER_EMAIL_WYSIWYG_WIDTH','505','How WIDE should the HTMLAREA be in pixels (default: 700)','25','35',NULL,now(),NULL, '');
INSERT INTO configuration VALUES (155,'Newsletter Email Layout Height','NEWSLETTER_EMAIL_WYSIWYG_HEIGHT','140','How HIGH should the HTMLAREA be in pixels (default: 400)','25','39',NULL,now(),NULL, '');
INSERT INTO configuration VALUES (156,'DEFINE MAINPAGE use WYSIWYG HTMLAREA?','HTML_AREA_WYSIWYG_DISABLE_DEFINE','Enable','Use WYSIWYG Area in Define Mainpage','25','40',NULL,now(),NULL, 'tep_cfg_select_option(array(\'Enable\', \'Disable\'),');
INSERT INTO configuration VALUES (157,'Define Mainpage Basic/Advanced Version?','HTML_AREA_WYSIWYG_BASIC_DEFINE','Advanced','Basic Features FASTER<br>Advanced Features SLOWER','25','41',NULL,now(),NULL, 'tep_cfg_select_option(array(\'Basic\', \'Advanced\'),');
INSERT INTO configuration VALUES (158,'Define Mainpage Layout Width','DEFINE_MAINPAGE_WYSIWYG_WIDTH','750','How WIDE should the HTMLAREA be in pixels (default: 505)','25','42',NULL,now(),NULL, '');
INSERT INTO configuration VALUES (159,'Define Mainpage Layout Height','DEFINE_MAINPAGE_WYSIWYG_HEIGHT','500','How HIGH should the HTMLAREA be in pixels (default: 140)','25','43',NULL,now(),NULL, '');
INSERT INTO configuration VALUES (160,'GLOBAL - User Interface Font Type','HTML_AREA_WYSIWYG_FONT_TYPE','Verdana','User Interface Font Type<br>(not saved to product description)','25','45',NULL,now(),NULL, 'tep_cfg_select_option(array(\'Arial\', \'Courier New\', \'Georgia\', \'Impact\', \'Tahoma\', \'Times New Roman\', \'Verdana\', \'Wingdings\'),');
INSERT INTO configuration VALUES (161,'GLOBAL - User Interface Font Size','HTML_AREA_WYSIWYG_FONT_SIZE','12','User Interface Font Size (not saved to product description)<p><b>10 Equals 10 pt','25','50',NULL,now(),NULL, 'tep_cfg_select_option(array(\\\'8\\\', \\\'10\\\', \\\'12\\\', \\\'14\\\', \\\'18\\\', \\\'24\\\', \\\'36\\\'),');
INSERT INTO configuration VALUES (162,'GLOBAL - User Interface Font Colour','HTML_AREA_WYSIWYG_FONT_COLOUR','Black','White, Black, C0C0C0, Red, FFFFFF, Yellow, Pink, Blue, Gray, 000000, ect..<br>basically any colour or HTML colour code!<br>(not saved to product description)','25','55',NULL,now(),NULL,'');
INSERT INTO configuration VALUES (163,'GLOBAL - User Interface Background Colour','HTML_AREA_WYSIWYG_BG_COLOUR','White','White, Black, C0C0C0, Red, FFFFFF, Yellow, Pink, Blue, Gray, 000000, ect..<br>basically any colour or html colour code!<br>(not saved to product description)','25','60',NULL,now(),NULL, '');
INSERT INTO configuration VALUES (164,'GLOBAL - ALLOW DEBUG MODE?','HTML_AREA_WYSIWYG_DEBUG','0','Moniter Live-html, It updates as you type in a 2nd field above it.<p>Disable Debug = 0<br>Enable Debug = 1<br>Default = 0 OFF','25','65',NULL,now(),NULL, 'tep_cfg_select_option(array(\'0\', \'1\'),');
INSERT INTO configuration VALUES (178,'Display Total','MODULE_ORDER_TOTAL_COUPON_STATUS','true','Do you want to display the Discount Coupon value?','6','1',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (179,'Sort Order','MODULE_ORDER_TOTAL_COUPON_SORT_ORDER','9','Sort order of display.','6','2',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (180,'Include Shipping','MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING','true','Include Shipping in calculation','6','5',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (181,'Include Tax','MODULE_ORDER_TOTAL_COUPON_INC_TAX','false','Include Tax in calculation.','6','6',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (182,'Re-calculate Tax','MODULE_ORDER_TOTAL_COUPON_CALC_TAX','None','Re-Calculate Tax','6','7',NULL,now(),NULL, 'tep_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'),');
INSERT INTO configuration VALUES (183,'Tax Class','MODULE_ORDER_TOTAL_COUPON_TAX_CLASS','0','Use the following tax class when treating Discount Coupon as Credit Note.','6','0',NULL,now(),'tep_get_tax_class_title','tep_cfg_pull_down_tax_classes(');
INSERT INTO configuration VALUES (184,'Display Total','MODULE_ORDER_TOTAL_GV_STATUS','true','Do you want to display the Gift Voucher value?','6','1',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (185,'Sort Order','MODULE_ORDER_TOTAL_GV_SORT_ORDER','740','Sort order of display.','6','2',NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (186,'Queue Purchases','MODULE_ORDER_TOTAL_GV_QUEUE','true','Do you want to queue purchases of the Gift Voucher?','6','3',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (187,'Include Shipping','MODULE_ORDER_TOTAL_GV_INC_SHIPPING','true','Include Shipping in calculation','6','5',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (188,'Include Tax','MODULE_ORDER_TOTAL_GV_INC_TAX','false','Include Tax in calculation.','6','6',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (189,'Re-calculate Tax','MODULE_ORDER_TOTAL_GV_CALC_TAX','None','Re-Calculate Tax','6','7',NULL,now(),NULL, 'tep_cfg_select_option(array(\'None\', \'Standard\', \'Credit Note\'),');
INSERT INTO configuration VALUES (190,'Tax Class','MODULE_ORDER_TOTAL_GV_TAX_CLASS','0','Use the following tax class when treating Gift Voucher as Credit Note.','6','0',NULL,now(),'tep_get_tax_class_title','tep_cfg_pull_down_tax_classes(');
INSERT INTO configuration VALUES (191,'Credit including Tax','MODULE_ORDER_TOTAL_GV_CREDIT_TAX','false','Add tax to purchased Gift Voucher when crediting to Account','6','8',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (192,'Allow Category Descriptions','ALLOW_CATEGORY_DESCRIPTIONS','true','Allow use of full text descriptions for categories','1','19',NULL,now(),NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

INSERT INTO configuration VALUES (593,'Prevent Adding Out of Stock to Cart','PRODINFO_ATTRIBUTE_NO_ADD_OUT_OF_STOCK','True','Prevents adding an out of stock attribute combination to the cart.',50,40,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (592,'Display Out of Stock Message Line','PRODINFO_ATTRIBUTE_OUT_OF_STOCK_MSGLINE','False','Controls the display of a message line indicating an out of stock attributes is selected.',50,30,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (591,'Mark Out of Stock Attributes','PRODINFO_ATTRIBUTE_MARK_OUT_OF_STOCK','Right','Controls how out of stock attributes are marked as out of stock.',50,20,NULL,now(),NULL,'tep_cfg_select_option(array(\'None\',\'Right\',\'Left\'),');
INSERT INTO configuration VALUES (590,'Show Out of Stock Attributes','PRODINFO_ATTRIBUTE_SHOW_OUT_OF_STOCK','True','Controls the display of out of stock attributes.',50,'10',NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (589,'Product Info Attribute Display Plugin','PRODINFO_ATTRIBUTE_PLUGIN','multiple_dropdowns','The plugin used for displaying attributes on the product information page.',50,'1',NULL,now(),NULL,'tep_cfg_pull_down_class_files(\'pad_\',');

INSERT INTO configuration VALUES (504,'Big Image Types','DYNAMIC_MOPICS_BIG_IMAGE_TYPES','jpg,gif,jpeg,png','The types (extensions) of big images you use,seperated by commas.',45,0,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (503,'Thumbnail Image Types','DYNAMIC_MOPICS_THUMB_IMAGE_TYPES','jpg,gif,jpeg,png','The types (extensions) of extra thumbnails you use,seperated by commas.',45,0,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (499,'Big Images Directory','DYNAMIC_MOPICS_BIGIMAGES_DIR','images_big/','The directory inside catalog/images where your big images are stored.',45,0,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (500,'Thumbnail Images Directory','DYNAMIC_MOPICS_THUMBS_DIR','thumbs/','The directory inside catalog/images where you extra image thumbs are stored.',45,0,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (501,'Main Thumbnail In "Thumbnail Images Directory"','DYNAMIC_MOPICS_MAINTHUMB_IN_THUMBS_DIR','false','If you store your product\'s main thumbnail in the "Thumbnail Images Directory" set this to true.  If it is in the main image directory (uploaded via osCommerce admin),set it false.',45,0,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES(599, 'Category Images Directory', 'CATEGORY_IMAGES_DIR', 'categories/', 'The directory inside catalog/images where your category images are stored.', 45, 0, NULL, '2009-05-28 15:34:10', NULL, NULL);
INSERT INTO configuration VALUES (502,'Extra Image Pattern','DYNAMIC_MOPICS_PATTERN','imagebase_{1}','Your custom defined pattern for extra images.  imagebase is the base of the main thumbnail.  Place the counting method between brackets {}.  Current counting methods can be 1,a,or A.  See readme for more information.',45,0,NULL,now(),NULL,NULL);

INSERT INTO configuration VALUES (458,'Template Switching Allowed','TEMPLATE_SWITCHING_ALLOWED','false','Allow template switching through the url (for easy new template testing).',1,22,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (457,'Default Template Directory','DIR_WS_TEMPLATES_DEFAULT','fallback','Subdirectory (in templates/) where the template files are stored which should be loaded by default.',1,22,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (231,'Enable Display a Dhtml menu','DISPLAY_DHTML_MENU','Default','Do you want to display a DHTML menu instead of the default text based?',1,19,NULL,now(),NULL,'tep_cfg_select_option(array(\'Default\',\'Dhtml\',\'CoolMenu\'),');

INSERT INTO configuration VALUES (358,'Downloads Controller Update Status Value','DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE','100000','What orders_status resets the Download days and Max Downloads - Default is 4',13,90,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (359,'Downloads Controller Download on hold message','DOWNLOADS_CONTROLLER_ON_HOLD_MSG','<BR><font color="FF0000">NOTE: Downloads are not available until payment has been confirmed</font>','Downloads Controller Download on hold message',13,91,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (360,'Downloads Controller Order Status Value','DOWNLOADS_CONTROLLER_ORDERS_STATUS','2','Downloads Controller Order Status Value - Default=2',13,92,NULL,now(),NULL,NULL);

INSERT INTO configuration VALUES (740,'Printable Catalog-Categories column','PRODUCT_LIST_CATALOG_CATEGORIES','show','Do you want to display the Categories column?',30,11,NULL,now(),NULL,'tep_cfg_select_option(array(\'show\',\'hide\'),');
INSERT INTO configuration VALUES (739,'Printable Catalog-Description column','PRODUCT_LIST_CATALOG_DESCRIPTION','hide','Do you want to display the Products Description column?',30,10,NULL,now(),NULL,'tep_cfg_select_option(array(\'show\',\'hide\'),');
INSERT INTO configuration VALUES (738,'Printable Catalog-Manufacturers column','PRODUCT_LIST_CATALOG_MANUFACTURERS','hide','Do you want to display the Manufacturers column?',30,9,NULL,now(),NULL,'tep_cfg_select_option(array(\'show\',\'hide\'),');
INSERT INTO configuration VALUES (737,'Printable Catalog-Name column','PRODUCT_LIST_CATALOG_NAME','show','Do you want to display the Name column?',30,8,NULL,now(),NULL,'tep_cfg_select_option(array(\'show\',\'hide\'),');
INSERT INTO configuration VALUES (736,'Printable Catalog-Options column','PRODUCT_LIST_CATALOG_OPTIONS','hide','Do you want to display the Options colum?',30,7,NULL,now(),NULL,'tep_cfg_select_option(array(\'show\',\'hide\'),');
INSERT INTO configuration VALUES (735,'Printable Catalog-Image column in full catalog link','PRODUCT_LIST_CATALOG_IMAGE_FULL','hide','Do you want to display the Image column in the Full Catalog Script?(hide image for faster page loads on full catalog)',30,6,NULL,now(),NULL,'tep_cfg_select_option(array(\'show\',\'hide\'),');
INSERT INTO configuration VALUES (734,'Printable Catalog-Image column in standard link','PRODUCT_LIST_CATALOG_IMAGE','show','Do you want to display the Image column?',30,5,NULL,now(),NULL,'tep_cfg_select_option(array(\'show\',\'hide\'),');
INSERT INTO configuration VALUES (733,'Printable Catalog-Length of the Description Text','PRODUCT_LIST_DESCRIPTION_LENGTH','400','How many characters in the description to display?',30,4,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (732,'Printable Catalog-Results Per Page','PRODUCT_LIST_CATALOG_PERPAGE','10','How many products do you want to list per page?',30,3,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (731,'Printable Catalog-Number of Page Breaks Displayed','PRODUCT_LIST_PAGEBREAK_NUMBERS_PERPAGE','10','How page breaks numbers to display?',30,2,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (730,'Printable Catalog-Customer Discount in Catalog','PRODUCT_LIST_CUSTOMER_DISCOUNT','show','Setting to -show- will display the catalog with a customer discount applied if logged in. It will display pricing without discount if not logged in. (only valid if Members Discount Mod is loaded. Default if Mod not present is -hide-)',30,0,NULL,now(),NULL,'tep_cfg_select_option(array(\'show\',\'hide\'),');

INSERT INTO configuration VALUES (378,'<B>Down for Maintenance: ON/OFF</B>','DOWN_FOR_MAINTENANCE','false','Down for Maintenance <br>(true=on false=off)',16,1,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (379,'Down for Maintenance: filename','DOWN_FOR_MAINTENANCE_FILENAME','down_for_maintenance.php','Down for Maintenance filename Default=down_for_maintenance.php',16,2,NULL,now(),NULL,'');
INSERT INTO configuration VALUES (380,'Down for Maintenance: Hide Header','DOWN_FOR_MAINTENANCE_HEADER_OFF','true','Down for Maintenance: Hide Header <br>(true=hide false=show)',16,3,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (381,'Down for Maintenance: Hide Column Left','DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF','true','Down for Maintenance: Hide Column Left <br>(true=hide false=show)',16,4,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (382,'Down for Maintenance: Hide Column Right','DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF','true','Down for Maintenance: Hide Column Right <br>(true=hide false=show)r',16,5,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (383,'Down for Maintenance: Hide Footer','DOWN_FOR_MAINTENANCE_FOOTER_OFF','true','Down for Maintenance: Hide Footer <br>(true=hide false=show)',16,6,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (384,'Down for Maintenance: Hide Prices','DOWN_FOR_MAINTENANCE_PRICES_OFF','false','Down for Maintenance: Hide Prices <br>(true=hide false=show)',16,7,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (385,'Down For Maintenance (exclude this IP-Address)','EXCLUDE_ADMIN_IP_FOR_MAINTENANCE','','This IP Address is able to access the website while it is Down For Maintenance (like webmaster)',16,8,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (386,'NOTIFY PUBLIC Before going Down for Maintenance: ON/OFF','WARN_BEFORE_DOWN_FOR_MAINTENANCE','false','Give a WARNING some time before you put your website Down for Maintenance<br>(true=on false=off)<br>If you set the \'Down For Maintenance: ON/OFF\' to true this will automaticly be updated to false',16,9,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (387,'Date and hours for notice before maintenance','PERIOD_BEFORE_DOWN_FOR_MAINTENANCE','16/05/2003  between the hours of 2-3 PM','Date and hours for notice before maintenance website,enter date and hours for maintenance website',16,10,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (388,'Display when webmaster has enabled maintenance','DISPLAY_MAINTENANCE_TIME','true','Display when Webmaster has enabled maintenance <br>(true=on false=off)<br>',16,11,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (389,'Display website maintenance period','DISPLAY_MAINTENANCE_PERIOD','true','Display Website maintenance period <br>(true=on false=off)<br>',16,12,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (390,'Website maintenance period','TEXT_MAINTENANCE_PERIOD_TIME','2h00','Enter Website Maintenance period (hh:mm)',16,13,NULL,now(),NULL,NULL);

INSERT INTO configuration VALUES (456,'Welcome Discount Coupon Code','NEW_SIGNUP_DISCOUNT_COUPON','','Welcome Discount Coupon Code: if you do not want to send a coupon in your create account email leave blank else place the coupon code you wish to use','1',32,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (455,'Welcome Gift Voucher Amount','NEW_SIGNUP_GIFT_VOUCHER_AMOUNT','0','Welcome Gift Voucher Amount: If you do not wish to send a Gift Voucher in your create account email put 0 for no amount else if you do place the amount here i.e. 10.00 or 50.00 no currency signs','1',31,NULL,now(),NULL,NULL);

INSERT INTO configuration VALUES (505,'Display New Articles Link','DISPLAY_NEW_ARTICLES','false','Display a link to New Articles in the Articles box?',456,1,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (506,'Number of Days Display New Articles','NEW_ARTICLES_DAYS_DISPLAY','30','The number of days to display New Articles?',456,2,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (507,'Maximum New Articles Per Page','MAX_NEW_ARTICLES_PER_PAGE','10','The maximum number of New Articles to display per page<br>(New Articles page)',456,3,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (508,'Display All Articles Link','DISPLAY_ALL_ARTICLES','true','Display a link to All Articles in the Articles box?',456,4,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (509,'Maximum Articles Per Page','MAX_ARTICLES_PER_PAGE','10','The maximum number of Articles to display per page<br>(All Articles and Topic/Author pages)',456,5,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (510,'Maximum Display Upcoming Articles','MAX_DISPLAY_UPCOMING_ARTICLES','5','Maximum number of articles to display in the Upcoming Articles module',456,6,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (511,'Enable Article Reviews','ENABLE_ARTICLE_REVIEWS','true','Enable registered users to review articles?',456,7,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (512,'Enable Tell a Friend About Article','ENABLE_TELL_A_FRIEND_ARTICLE','true','Enable Tell a Friend option in the Article Information page?',456,8,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (513,'Minimum Number Cross-Sell Products','MIN_DISPLAY_ARTICLES_XSELL','1','Minimum number of products to display in the articles Cross-Sell listing.',456,9,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (514,'Maximum Number Cross-Sell Products','MAX_DISPLAY_ARTICLES_XSELL','6','Maximum number of products to display in the articles Cross-Sell listing.',456,10,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (515,'Show Article Counts','SHOW_ARTICLE_COUNTS','true','Count recursively how many articles are in each topic',456,11,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (516,'Maximum Length of Author Name','MAX_DISPLAY_AUTHOR_NAME_LEN','20','The maximum length of the author\'s name for display in the Author box',456,12,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (517,'Authors List Style','MAX_DISPLAY_AUTHORS_IN_A_LIST','1','Used in Authors box. When the number of authors exceeds this number,a drop-down list will be displayed instead of the default list',456,13,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (518,'Authors Select Box Size','MAX_AUTHORS_LIST','1','Used in Authors box. When this value is 1 the classic drop-down list will be used for the authors box. Otherwise,a list-box with the specified number of rows will be displayed.',456,14,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (519,'Display Author in Article Listing','DISPLAY_AUTHOR_ARTICLE_LISTING','true','Display the Author in the Article Listing?',456,15,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (520,'Display Topic in Article Listing','DISPLAY_TOPIC_ARTICLE_LISTING','true','Display the Topic in the Article Listing?',456,16,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (521,'Display Abstract in Article Listing','DISPLAY_ABSTRACT_ARTICLE_LISTING','true','Display the Abstract in the Article Listing?',456,17,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (522,'Display Date Added in Article Listing','DISPLAY_DATE_ADDED_ARTICLE_LISTING','true','Display the Date Added in the Article Listing?',456,18,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (523,'Maximum Article Abstract Length','MAX_ARTICLE_ABSTRACT_LENGTH','300','Sets the maximum length of the Article Abstract to be displayed<br><br>(No. of characters)',456,19,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (524,'Display Topic/Author Filter','ARTICLE_LIST_FILTER','true','Do you want to display the Topic/Author Filter?',456,20,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (525,'Location of Prev/Next Navigation Bar','ARTICLE_PREV_NEXT_BAR_LOCATION','bottom','Sets the location of the Previous/Next Navigation Bar<br><br>(top; bottom; both)',456,21,NULL,now(),NULL,'tep_cfg_select_option(array(\'top\',\'bottom\',\'both\'),');
INSERT INTO configuration VALUES (526,'Use WYSIWYG HTMLAREA Editor?','ARTICLE_WYSIWYG_ENABLE','Enable','Use WYSIWYG Editor in Articles and Topic/Author Descriptions?',456,22,NULL,now(),NULL,'tep_cfg_select_option(array(\'Enable\',\'Disable\'),');
INSERT INTO configuration VALUES (527,'WYSIWYG Editor Basic/Advanced Version?','ARTICLE_MANAGER_WYSIWYG_BASIC','Advanced','Basic Features FASTER<br>Advanced Features SLOWER',456,23,NULL,now(),NULL,'tep_cfg_select_option(array(\'Basic\',\'Advanced\'),');
INSERT INTO configuration VALUES (528,'WYSIWYG Editor Layout Width','ARTICLE_MANAGER_WYSIWYG_WIDTH','700','How WIDE should the HTMLAREA be in pixels (default: 605)',456,24,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (529,'WYSIWYG Editor Layout Height','ARTICLE_MANAGER_WYSIWYG_HEIGHT','400','How HIGH should the HTMLAREA be in pixels (default: 300)',456,25,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (530,'WYSIWYG Editor Font Type','ARTICLE_MANAGER_WYSIWYG_FONT_TYPE','Times New Roman','User Interface Font Type<br>(not saved to content)',456,26,NULL,now(),NULL,'tep_cfg_select_option(array(\'Arial\',\'Courier New\',\'Georgia\',\'Impact\',\'Tahoma\',\'Times New Roman\',\'Verdana\',\'Wingdings\'),');
INSERT INTO configuration VALUES (531,'WYSIWYG Editor Font Size','ARTICLE_MANAGER_WYSIWYG_FONT_SIZE','12','User Interface Font Size<br>(not saved to content)<p><b>10 Equals 10 pt',456,27,NULL,now(),NULL,'tep_cfg_select_option(array(\\''8\\'',\\''10\\'',\\''12\\'',\\''14\\'',\\''18\\'',\\''24\\'',\\''36\\''),');
INSERT INTO configuration VALUES (532,'WYSIWYG Editor Font Colour','ARTICLE_MANAGER_WYSIWYG_FONT_COLOUR','Black','White,Black,C0C0C0,Red,FFFFFF,Yellow,Pink,Blue,Gray,000000,etc...<br>basically any colour or HTML colour code!<br>(not saved to content)',456,28,NULL,now(),NULL,'');
INSERT INTO configuration VALUES (533,'WYSIWYG Editor Background Colour','ARTICLE_MANAGER_WYSIWYG_BG_COLOUR','White','White,Black,C0C0C0,Red,FFFFFF,Yellow,Pink,Blue,Gray,000000,etc...<br>basically any colour or html colour code!<br>(not saved to content)',456,29,NULL,now(),NULL,'');
INSERT INTO configuration VALUES (534,'WYSIWYG Editor Allow Debug Mode?','ARTICLE_MANAGER_WYSIWYG_DEBUG','0','Monitor Live-html,It updates as you type in a 2nd field above it.<p>Disable Debug = 0<br>Enable Debug = 1<br>Default = 0 OFF',456,30,NULL,now(),NULL,'tep_cfg_select_option(array(\'0\',\'1\'),');
INSERT INTO configuration VALUES (391,'Down For Maintenance Start Time','TEXT_DATE_TIME','2008-05-03 14:23:52','Show when down for maintenance',16,14,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (700,'Number of Columns for product listings','PRODUCT_LIST_NUM_COLUMNS','4','How many prodcuts per row do you want to display on your product listing page?',8,14,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (701,'Minimum X-Sell products Listed','MIN_DISPLAY_XSELL','1','How many x-sell products per page',8,20,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (650,'Product Display Type (Default = 0 or Columns = 1)','PRODUCT_LIST_TYPE','1','Do you want to display products one per row or multiple columns per row?',8,10,NULL,now(),NULL,NULL);

INSERT INTO configuration VALUES (645,'Tax Class','MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS','0','Use the following tax class on the low order fee.',6,7,NULL,now(),'tep_get_tax_class_title','tep_cfg_pull_down_tax_classes(');
INSERT INTO configuration VALUES (644,'Attach Low Order Fee On Orders Made','MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION','both','Attach low order fee for orders sent to the set destination.',6,6,NULL,now(),NULL,'tep_cfg_select_option(array(\'national\',\'international\',\'both\'),');
INSERT INTO configuration VALUES (643,'Order Fee','MODULE_ORDER_TOTAL_LOWORDERFEE_FEE','5','Low order fee.',6,5,NULL,now(),'currencies->format',NULL);
INSERT INTO configuration VALUES (642,'Order Fee For Orders Under','MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER','50','Add the low order fee to orders under this amount.',6,4,NULL,now(),'currencies->format',NULL);
INSERT INTO configuration VALUES (641,'Allow Low Order Fee','MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE','false','Do you want to allow low order fees?',6,3,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (640,'Sort Order','MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER','5','Sort order of display.',6,2,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (639,'Display Low Order Fee','MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS','true','Do you want to display the low order fee?',6,1,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (638,'Order Status','MODULE_LOYALTY_DISCOUNT_ORDER_STATUS','3','Set the minimum order status for an order to add it to the total amount ordered',6,8,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (637,'Discount Percentage','MODULE_LOYALTY_DISCOUNT_TABLE','1000:5,1500:7.5,2000:10,3000:12.5,5000:15','Set the cumulative order total breaks per period set above,and discount percentages',6,7,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (635,'Calculate Tax','MODULE_LOYALTY_DISCOUNT_CALC_TAX','false','Re-calculate Tax on discounted amount.',6,5,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (636,'Cumulative order total period','MODULE_LOYALTY_DISCOUNT_CUMORDER_PERIOD','year','Set the period over which to calculate cumulative order total.',6,6,NULL,now(),NULL,'tep_cfg_select_option(array(\'alltime\',\'year\',\'quarter\',\'month\'),');
INSERT INTO configuration VALUES (634,'Include Tax','MODULE_LOYALTY_DISCOUNT_INC_TAX','true','Include Tax in calculation.',6,4,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (633,'Include Shipping','MODULE_LOYALTY_DISCOUNT_INC_SHIPPING','true','Include Shipping in calculation',6,3,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (632,'Sort Order','MODULE_LOYALTY_DISCOUNT_SORT_ORDER','4','Sort order of display.',6,2,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (631,'Display Total','MODULE_LOYALTY_DISCOUNT_STATUS','true','Do you want to enable the Order Discount?',6,1,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (601,'Merchant Notifications','MODULE_PAYMENT_AUTHORIZENET_EMAIL_MERCHANT','True','Should Authorize.Net e-mail a receipt to the store owner?',6,0,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (747,'Printable Catalog-Show the Date?','PRODUCT_LIST_CATALOG_DATE_SHOW','hide','Do you want to display the Product Date Added (only valid if Display Printable Catalog Date column is set to -show-)',30,'18',NULL,now(),NULL,'tep_cfg_select_option(array(\'show\',\'hide\'),');
INSERT INTO configuration VALUES (748,'Printable Catalog-Show Currency?','PRODUCT_LIST_CATALOG_CURRENCY','hide','Do you want to display the Currency Pull Down',30,19,NULL,now(),NULL,'tep_cfg_select_option(array(\'show\',\'hide\'),');
INSERT INTO configuration VALUES (746,'Printable Catalog-Date column','PRODUCT_LIST_CATALOG_DATE','hide','Do you want to display the Product Date Added column?',30,17,NULL,now(),NULL,'tep_cfg_select_option(array(\'show\',\'hide\'),');
INSERT INTO configuration VALUES (744,'Printable Catalog-Weight column','PRODUCT_LIST_CATALOG_WEIGHT','hide','Do you want to display the Weight column?',30,15,NULL,now(),NULL,'tep_cfg_select_option(array(\'show\',\'hide\'),');
INSERT INTO configuration VALUES (745,'Printable Catalog-Price column','PRODUCT_LIST_CATALOG_PRICE','show','Do you want to display the Price column?',30,16,NULL,now(),NULL,'tep_cfg_select_option(array(\'show\',\'hide\'),');
INSERT INTO configuration VALUES (742,'Printable Catalog-UPC column','PRODUCT_LIST_CATALOG_UPC','hide','Do you want to display the UPC column? (only valid if Members Discount Mod is loaded Default if not present is -hide-)',30,13,NULL,now(),NULL,'tep_cfg_select_option(array(\'show\',\'hide\'),');
INSERT INTO configuration VALUES (743,'Printable Catalog-Quantity column','PRODUCT_LIST_CATALOG_QUANTITY','hide','Do you want to display the Quantity column?',30,14,NULL,now(),NULL,'tep_cfg_select_option(array(\'show\',\'hide\'),');
INSERT INTO configuration VALUES (741,'Printable Catalog-Model column','PRODUCT_LIST_CATALOG_MODEL','show','Do you want to display the Model column?',30,12,NULL,now(),NULL,'tep_cfg_select_option(array(\'show\',\'hide\'),');

INSERT INTO configuration VALUES (774,'Enable Page Cache','ENABLE_PAGE_CACHE','false','Enable the page cache features to reduce server load and faster page renders?<br><br>Contribution by: <b>Chemo</b>',55,1,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (775,'Cache Lifetime','PAGE_CACHE_LIFETIME','5','How long to cache the pages (in minutes) ?<br><br>Contribution by: <b>Chemo</b>',55,2,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (776,'Turn on Debug Mode?','PAGE_CACHE_DEBUG_MODE','false','Turn on the global debug output (located at the footer) ? This affects ALL browsers and is NOT for live shops!  YOu can turn on debug mode JUST for your browser by adding "?debug=1" to your URL.<br><br>Contribution by: <b>Chemo</b>',55,'3',NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (777,'Disable URL Parameters?','PAGE_CACHE_DISABLE_PARAMETERS','false','In some cases (such as search engine safe URL\'s) or large number of affiliate referrals will cause excessive page writing.<br><br>Contribution by: <b>Chemo</b>',55,4,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (778,'Delete Cache Files?','PAGE_CACHE_DELETE_FILES','true','If set to true the next catalog page request will delete all the cache files and then reset this value to false again.<br><br>Contribution by: <b>Chemo</b>',55,5,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (779,'Config Cache Update File?','PAGE_CACHE_UPDATE_CONFIG_FILES','none','If you have a configuration cache contribution enter the FULL path to the update file.<br><br>Contribution by: <b>Chemo</b>',55,6,NULL,now(),NULL,NULL);

INSERT INTO `configuration` VALUES(1469, 'Enable SEO URLs?', 'SEO_ENABLED', 'false', 'Enable the SEO URLs?  This is a global setting and will turn them off completely.', 60, 0, '2009-02-25 22:59:02', '2009-02-25 22:57:59', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO `configuration` VALUES(1470, 'Add cPath to product URLs?', 'SEO_ADD_CPATH_TO_PRODUCT_URLS', 'false', 'This setting will append the cPath to the end of product URLs (i.e. - some-product-p-1.html?cPath=xx).', 60, 1, '2009-02-25 22:57:59', '2009-02-25 22:57:59', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO `configuration` VALUES(1471, 'Add category parent to begining of URLs?', 'SEO_ADD_CAT_PARENT', 'false', 'This setting will add the category parent name to the beginning of the category URLs (i.e. - parent-category-c-1.html).', 60, 2, '2009-02-25 22:59:09', '2009-02-25 22:57:59', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO `configuration` VALUES(1472, 'Filter Short Words', 'SEO_URLS_FILTER_SHORT_WORDS', '3', 'This setting will filter words less than or equal to the value from the URL.', 60, 3, '2009-02-25 22:57:59', '2009-02-25 22:57:59', NULL, NULL);
INSERT INTO `configuration` VALUES(1473, 'Output W3C valid URLs (parameter string)?', 'SEO_URLS_USE_W3C_VALID', 'false', 'This setting will output W3C valid URLs.', 60, 4, '2009-02-25 22:59:15', '2009-02-25 22:57:59', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO `configuration` VALUES(1474, 'Enable SEO cache to save queries?', 'USE_SEO_CACHE_GLOBAL', 'false', 'This is a global setting and will turn off caching completely.', 60, 5, '2009-02-25 22:59:22', '2009-02-25 22:57:59', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO `configuration` VALUES(1475, 'Enable product cache?', 'USE_SEO_CACHE_PRODUCTS', 'true', 'This will turn off caching for the products.', 60, 6, '2009-02-25 22:57:59', '2009-02-25 22:57:59', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO `configuration` VALUES(1476, 'Enable categories cache?', 'USE_SEO_CACHE_CATEGORIES', 'true', 'This will turn off caching for the categories.', 60, 7, '2009-02-25 22:57:59', '2009-02-25 22:57:59', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO `configuration` VALUES(1477, 'Enable manufacturers cache?', 'USE_SEO_CACHE_MANUFACTURERS', 'true', 'This will turn off caching for the manufacturers.', 60, 8, '2009-02-25 22:57:59', '2009-02-25 22:57:59', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO `configuration` VALUES(1478, 'Enable articles cache?', 'USE_SEO_CACHE_ARTICLES', 'true', 'This will turn off caching for the articles.', 60, 9, '2009-02-25 22:57:59', '2009-02-25 22:57:59', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO `configuration` VALUES(1479, 'Enable topics cache?', 'USE_SEO_CACHE_TOPICS', 'true', 'This will turn off caching for the article topics.', 60, 10, '2009-02-25 22:57:59', '2009-02-25 22:57:59', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO `configuration` VALUES(1480, 'Enable information cache?', 'USE_SEO_CACHE_INFO_PAGES', 'true', 'This will turn off caching for the information pages.', 60, 11, '2009-02-25 22:57:59', '2009-02-25 22:57:59', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO `configuration` VALUES(1481, 'Enable automatic redirects?', 'USE_SEO_REDIRECT', 'false', 'This will activate the automatic redirect code and send 301 headers for old to new URLs.', 60, 12, '2009-02-25 22:57:59', '2009-02-25 22:57:59', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO `configuration` VALUES(1482, 'Choose URL Rewrite Type', 'SEO_REWRITE_TYPE', 'Rewrite', 'Choose which SEO URL format to use.', 60, 13, '2009-02-25 22:57:59', '2009-02-25 22:57:59', NULL, 'tep_cfg_select_option(array(''Rewrite''),');
INSERT INTO `configuration` VALUES(1483, 'Enter special character conversions', 'SEO_CHAR_CONVERT_SET', '', 'This setting will convert characters.<br><br>The format <b>MUST</b> be in the form: <b>char=>conv,char2=>conv2</b>', 60, 14, '2009-02-25 22:57:59', '2009-02-25 22:57:59', NULL, NULL);
INSERT INTO `configuration` VALUES(1484, 'Remove all non-alphanumeric characters?', 'SEO_REMOVE_ALL_SPEC_CHARS', 'false', 'This will remove all non-letters and non-numbers.  This should be handy to remove all special characters with 1 setting.', 60, 15, '2009-02-25 22:57:59', '2009-02-25 22:57:59', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO `configuration` VALUES(1485, 'Reset SEO URLs Cache', 'SEO_URLS_CACHE_RESET', 'false', 'This will reset the cache data for SEO', 60, 17, '2009-02-25 22:57:59', '2009-02-25 22:57:59', 'tep_reset_cache_data_seo_urls', 'tep_cfg_select_option(array(''reset'', ''false''),');
INSERT INTO `configuration` VALUES(1486, 'Enable Seo URL validation?', 'FWR_VALIDATION_ON', 'false', 'Enable the SEO URL validation?', 60, 16, NULL, '2009-02-25 22:57:25', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration VALUES (1073,'Move tax to total amount','MOVE_TAX_TO_TOTAL_AMOUNT','True','Do you want to move the tax to the total amount? If true PayPal will allways show the total amount including tax. (needs Aggregate i.s.o. Per Item to function)',6,4,NULL,now(),NULL, 'tep_cfg_select_option(array(\'True\', \'False\'), ');
#Bugfix 327:Removed duplicate PWA settings
#INSERT INTO configuration VALUES (498,'Purchase Without Account','PWA_ON','true','Allow Customers to purchase without an account',40,1,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');

# New RC4 entires
INSERT INTO configuration VALUES (1202,'Admin Editor Default Width','HTML_AREA_WYSIWYG_EDITOR_WIDTH','700','How WIDE should the HTMLAREA be in pixels (default: 550)',25,66,NULL,now(),NULL,'');
INSERT INTO configuration VALUES (1203,'Admin Editor Default Height','HTML_AREA_WYSIWYG_EDITOR_HEIGHT','400','How HIGH should the HTMLAREA be in pixels (default: 300)',25,67,NULL,now(),NULL,'');
INSERT INTO configuration VALUES (1204,'E-Mail Address','AFFILIATE_EMAIL_ADDRESS','<affiliate@localhost.com>','The E Mail Address for the Affiliate Program',35,1,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (1205,'Affiliate Pay Per Sale Payment % Rate','AFFILIATE_PERCENT','10.0000','Percentage Rate for the Affiliate Program',35,2,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (1206,'Payment Threshold','AFFILIATE_THRESHOLD','50.00','Payment Threshold for paying affiliates',35,3,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (1207,'Cookie Lifetime','AFFILIATE_COOKIE_LIFETIME','7200','How long does the click count (seconds) if customer comes back',35,4,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (1208,'Billing Time','AFFILIATE_BILLING_TIME','30','Orders billed must be at least "30" days old.<br>This is needed if a order is refunded',35,5,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (1209,'Order Min Status','AFFILIATE_PAYMENT_ORDER_MIN_STATUS','3','The status an order must have at least,to be billed',35,6,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (1210,'Pay Affiliates with check','AFFILIATE_USE_CHECK','true','Pay Affiliates with check',35,7,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (1211,'Pay Affiliates with PayPal','AFFILIATE_USE_PAYPAL','true','Pay Affiliates with PayPal',35,8,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (1212,'Pay Affiliates by Bank','AFFILIATE_USE_BANK','true','Pay Affiliates by Bank',35,9,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (1213,'Individual Affiliate Percentage','AFFILATE_INDIVIDUAL_PERCENTAGE','true','Allow per Affiliate provision',35,10,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (1214,'Use Affiliate-tier','AFFILATE_USE_TIER','false','Multilevel Affiliate provisions',35,11,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (1215,'Number of Tierlevels','AFFILIATE_TIER_LEVELS','0','Number of Tierlevels',35,12,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (1216,'Percentage Rate for the Tierlevels','AFFILIATE_TIER_PERCENTAGE','8.00;5.00;1.00','Percent Rates for the tierlevels<br>Example: 8.00;5.00;1.00',35,13,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (1217,'Affiliate News','MAX_DISPLAY_AFFILIATE_NEWS','3','Maximum number of items to display on the Affiliate News page',35,14,NULL,now(),NULL,NULL);

# Edit to add configuration vars from affiliate_configure.php
INSERT INTO configuration VALUES (1218,'Notify Affiliate of new invoice?','AFFILIATE_NOTIFY_AFTER_BILLING','true','Nofify affiliate if they have got a new invoice',35,15,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (1219,'Delete affiliate sale if order deleted?','AFFILIATE_NOTIFY_AFTER_BILLING','true','Delete affiliate sales if an order is deleted (Warning: Only not yet billed sales are deleted)',35,16,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (1220,'Tax Rates used for billing the affiliates','AFFILIATE_TAX_ID','1','Set the tax rate for billing affiliates',35,17,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (1221,'Maintain affiliate clickthroughs','AFFILIATE_DELETE_CLICKTHROUGHS','false','To keep the clickthrough report small you can set the days after which they are deleted (when calling affiliate_summary in the admin).  Set to false or set the number of days.',35,18,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (1222,'Maintain affiliate banner history','AFFILIATE_DELETE_AFFILIATE_BANNER_HISTORY','false','To keep affiliate banner history table  small you can set the days after which they are deleted (when calling affiliate_summary in the admin). Set to false or set the number of days.',35,19,NULL,now(),NULL,NULL);

INSERT INTO configuration VALUES (1291,'Max Wish List','MAX_DISPLAY_WISHLIST_PRODUCTS','12','How many wish list items to show per page on the main wishlist.php file',65,0,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (1292,'Max Wish List Box','MAX_DISPLAY_WISHLIST_BOX','4','How many wish list items to display in the infobox before it changes to a counter',65,0,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (1293,'Display Emails','DISPLAY_WISHLIST_EMAILS','3','How many emails to display when the customer emails their wishlist link',65,0,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (1294,'Wishlist Redirect','WISHLIST_REDIRECT','No','Do you want to redirect back to the product_info.php page when a customer adds a product to their wishlist?',65,0,NULL,now(),NULL,'tep_cfg_select_option(array(\'Yes\',\'No\'),');
INSERT INTO configuration VALUES (1304,'Display the Payment Method dropdown?','ORDER_EDITOR_PAYMENT_DROPDOWN','true','Based on this selection Order Editor will display the payment method as a dropdown menu (true) or as an input field (false).',70,1,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (1305,'Use prices from Separate Pricing Per Customer?','ORDER_EDITOR_USE_SPPC','false','Leave this set at false unless SPPC is installed.',70,3,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (1306,'Allow the use of AJAX to update order information?','ORDER_EDITOR_USE_AJAX','true','This must be set to false if using a browser on which JavaScript is disabled or not available.',70,4,NULL,now(),NULL,'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES (1307,'Select your credit card payment method','ORDER_EDITOR_CREDIT_CARD','Credit Card','Order Editor will display the credit card fields when this payment method is selected.',70,5,NULL,now(),NULL,'tep_cfg_pull_down_payment_methods(');
INSERT INTO configuration VALUES (1449,'Purchase without account','PURCHASE_WITHOUT_ACCOUNT','yes','Do you allow customers to purchase without an account?',5,'10',NULL,now(),NULL,'tep_cfg_select_option(array(\'yes\',\'no\'),');
INSERT INTO configuration VALUES (1450,'Purchase without account shipping address','PURCHASE_WITHOUT_ACCOUNT_SEPARATE_SHIPPING','yes','Do you allow customers without account to create separately shipping address?',5,'11',NULL,now(),NULL,'tep_cfg_select_option(array(\'yes\',\'no\'),');
INSERT INTO configuration VALUES (1487, 'Dimensions Support', 'SHIPPING_DIMENSIONS_SUPPORT', 'No', 'Do you use the additional dimensions support (read dimensions.txt in the UPSXML package)?', 7, 6, NULL, '2009-03-07 13:49:41', NULL, 'tep_cfg_select_option(array(''No'', ''Ready-to-ship only'', ''With product dimensions''), ');
INSERT INTO configuration VALUES (1488, 'Unit Weight', 'SHIPPING_UNIT_WEIGHT', 'LBS', 'By what unit are your packages weighed?', 7, 7, NULL, '2009-03-07 13:49:41', NULL, 'tep_cfg_select_option(array(''LBS'', ''KGS''), ');
INSERT INTO configuration VALUES (1489, 'Unit Length', 'SHIPPING_UNIT_LENGTH', 'IN', 'By what unit are your packages sized?', 7, 8, NULL, '2009-03-07 13:49:41', NULL, 'tep_cfg_select_option(array(''IN'', ''CM''), ');
INSERT INTO configuration VALUES (1490, 'Store result of packing routines', 'SHIPPING_STORE_BOXES_USED', 'false', 'Do you want to store the results of the packing routines in the database? See file store_ups_boxes_used.txt in UPSXML package for details and modifications needed.', 7, 9, NULL, '2009-03-07 13:49:41', NULL, 'tep_cfg_select_option(array(''true'', ''false''), ');
INSERT INTO configuration VALUES (1491, 'Look back days', 'RCS_BASE_DAYS', '30', 'Number of days to look back from today for abandoned carts.', 80, 10, NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration VALUES (1492, 'Skip days', 'RCS_SKIP_DAYS', '5', 'Number of days to skip when looking for abandoned carts.', 80, 11, NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration VALUES (1493, 'Sales Results Report days', 'RCS_REPORT_DAYS', '90', 'Number of days the sales results report takes into account. The more days the longer the SQL queries!.', 80, 15, NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration VALUES (1494, 'Use Calculated taxes', 'RCS_INCLUDE_TAX_IN_PRICES', 'false', 'Try to calculate the tax when determining prices. This may not be 100% correct as determing location being shopped from, etc. may be incorrect.', 80, 16, NULL, '2009-03-07 22:31:53', '', 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration VALUES (1495, 'Use Fixed tax rate', 'RCS_USE_FIXED_TAX_IN_PRICES', 'false', 'Use a fixed tax rate when determining prices (rate set below). Overridden if ''Use Calculated taxes'' is true.', 80, 17, NULL, '2009-03-07 22:31:53', '', 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration VALUES (1496, 'Fixed Tax Rate', 'RCS_FIXED_TAX_RATE', '10.00', 'The fixed tax rate for use when ''Use Fixed tax rate'' is true and ''Use Calculated taxes'' is false.<br><br>Use decimal values, ie: 8.50 for 8 1/2%', 80, 18, NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration VALUES (1497, 'E-Mail time to live', 'RCS_EMAIL_TTL', '90', 'Number of days to give for emails before they no longer show as being sent', 80, 20, NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration VALUES (1498, 'Friendly E-Mails', 'RCS_EMAIL_FRIENDLY', 'true', 'If <b>true</b> then the customer''s name will be used in the greeting. If <b>false</b> then a generic greeting will be used.', 80, 30, NULL, '2009-03-07 22:31:53', '', 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration VALUES (1499, 'E-Mail Copies to', 'RCS_EMAIL_COPIES_TO', '', 'If you want copies of emails that are sent to customers by this contribution, enter the email address here. If empty no copies are sent', 80, 35, NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration VALUES (1500, 'Show Attributes', 'RCS_SHOW_ATTRIBUTES', 'false', 'Controls display of item attributes.<br><br>Some sites have attributes for their items.<br><br>Set this to <b>true</b> if yours does and you want to show them, otherwise set to <b>false</b>.', 80, 40, NULL, '2009-03-07 22:31:53', '', 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration VALUES (1501, 'Ignore Customers with Sessions', 'RCS_CHECK_SESSIONS', 'false', 'If you want the tool to ignore customers with an active session (ie, probably still shopping) set this to <b>true</b>.<br><br>Setting this to <b>false</b> will operate in the default manner of ignoring session data & using less resources.', 80, 40, NULL, '2009-03-07 22:31:53', '', 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration VALUES (1502, 'Current Customer Color', 'RCS_CURCUST_COLOR', '0000FF', 'Color for the word/phrase used to notate a current customer<br><br>A current customer is someone who has purchased items from your store in the past.', 80, 50, NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration VALUES (1503, 'Uncontacted hilight color', 'RCS_UNCONTACTED_COLOR', '9FFF9F', 'Row highlight color for uncontacted customers.<br><br>An uncontacted customer is one that you have <i>not</i> used this tool to send an email to before.', 80, 60, NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration VALUES (1504, 'Contacted hilight color', 'RCS_CONTACTED_COLOR', 'FF9F9F', 'Row highlight color for contacted customers.<br><br>An contacted customer is one that you <i>have</i> used this tool to send an email to before.', 80, 70, NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration VALUES (1505, 'Matching Order Hilight', 'RCS_MATCHED_ORDER_COLOR', '9FFFFF', 'Row highlight color for entrees that may have a matching order.<br><br>An entry will be marked with this color if an order contains one or more of an item in the abandoned cart <b>and</b> matches either the cart''s customer email address or database ID.', 80, 72, NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration VALUES (1506, 'Skip Carts w/Matched Orders', 'RCS_SKIP_MATCHED_CARTS', 'true', 'To ignore carts with an a matching order set this to <b>true</b>.<br><br>Setting this to <b>false</b> will cause entries with a matching order to show, along with the matching order''s status.<br><br>See documentation for details.', 80, 80, NULL, '2009-03-07 22:31:53', '', 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration VALUES (1507, 'Autocheck "safe" carts to email', 'RCS_AUTO_CHECK', 'true', 'To check entries which are most likely safe to email (ie, not existing customers, not previously emailed, etc.) set this to <b>true</b>.<br><br>Setting this to <b>false</b> will leave all entries unchecked (must manually check entries to send an email to)', 80, 82, NULL, '2009-03-07 22:31:53', '', 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration VALUES (1508, 'Match orders from any date', 'RCS_CARTS_MATCH_ALL_DATES', 'true', 'If <b>true</b> then any order found with a matching item will be considered a matched order.<br><br>If <b>false</b> only orders placed after the abandoned cart are considered.', 80, 84, NULL, '2009-03-07 22:31:53', '', 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration VALUES (1509, 'Lowest Pending sales status', 'RCS_PENDING_SALE_STATUS', '1', 'The highest value that an order can have and still be considered pending. Any value higher than this will be considered by RCS as sale which completed.<br><br>See documentation for details.', 80, 85, NULL, '2009-03-07 22:31:53', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
INSERT INTO configuration VALUES (1510, 'Report Even Row Style', 'RCS_REPORT_EVEN_STYLE', 'dataTableRow', 'Style for even rows in results report. Typical options are <i>dataTableRow</i> and <i>attributes-even</i>.', 80, 90, NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration VALUES (1511, 'Report Odd Row Style', 'RCS_REPORT_ODD_STYLE', '', 'Style for odd rows in results report. Typical options are NULL (ie, no entry) and <i>attributes-odd</i>.', 80, 92, NULL, '2009-03-07 22:31:53', '', '');

INSERT INTO configuration VALUES (595,'Product Image Width','PRODUCT_IMAGE_WIDTH','120','The main product image \(thumbnail\) in product information pages.',4,20,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (596,'Product Image Height','PRODUCT_IMAGE_HEIGHT','','The main product image \(thumbnail\) in product information pages. Do NOT specify both!',4,21,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (597,'Product Popup Image Width','POPUP_IMAGE_WIDTH','800','Limits the popup product image \(enlarged\) size during product updates. MUST specify.',4,22,NULL,now(),NULL,NULL);
INSERT INTO configuration VALUES (598,'Product Popup Image Height','POPUP_IMAGE_HEIGHT','600','Limits the popup product image \(enlarged\) size during product updates. MUST specify.',4,23,NULL,now(),NULL,NULL);

INSERT INTO configuration_group VALUES (1,'My Store','General information about my store',1,1);
INSERT INTO configuration_group VALUES (2,'Minimum Values','The minimum values for functions / data',2,1);
INSERT INTO configuration_group VALUES (3,'Maximum Values','The maximum values for functions / data',3,1);
INSERT INTO configuration_group VALUES (4,'Images','Image parameters',4,1);
INSERT INTO configuration_group VALUES (5,'Customer Details','Customer account configuration',5,1);
INSERT INTO configuration_group VALUES (6,'Module Options','Hidden from configuration',6,0);
INSERT INTO configuration_group VALUES (7,'Shipping/Packaging','Shipping options available at my store',7,1);
INSERT INTO configuration_group VALUES (8,'Product Listing','Product Listing    configuration options',8,1);
INSERT INTO configuration_group VALUES (9,'Stock','Stock configuration options',9,1);
INSERT INTO configuration_group VALUES (10,'Logging','Logging configuration options',10,1);
INSERT INTO configuration_group VALUES (11,'Cache','Caching configuration options',11,1);
INSERT INTO configuration_group VALUES (12,'E-Mail Options','General setting for E-Mail transport and HTML E-Mails',12,1);
INSERT INTO configuration_group VALUES (13,'Download','Downloadable products options',13,1);
INSERT INTO configuration_group VALUES (14,'GZip Compression','GZip compression options',14,1);
INSERT INTO configuration_group VALUES (15,'Sessions','Session options',15,1);
# osCMax added....
INSERT INTO configuration_group VALUES (16,'Site Maintenance','Site Maintenance Options',16,1);
INSERT INTO configuration_group VALUES (25,'WYSIWYG Editor','HTMLArea Options',15,1);
INSERT INTO configuration_group VALUES (30,'Printable Catalog','Options for Printable Catalog',30,1);
INSERT INTO configuration_group VALUES (35,'Affiliate Program','Options for the Affiliate Program',50,1);
#Bugfix 327: Removed duplicate PWA settings
#INSERT INTO configuration_group VALUES (40,'Accounts','Configuration of Account settings',40,1);
INSERT INTO configuration_group VALUES (45,'Dynamic MoPics','The options which configure Dynamic MoPics.',45,1);
INSERT INTO configuration_group VALUES (50,'Product Information','Product Information page configuration options',8,1);
INSERT INTO configuration_group VALUES (55,'Page Cache Settings','Settings for the page cache contribution', 20,1);
INSERT INTO configuration_group VALUES (60,'SEO URLs','Options for Ultimate SEO URLs by Chemo', 902,1);
INSERT INTO configuration_group VALUES (65,'Wish List Settings','Settings for your Wish List', 25,1);
INSERT INTO configuration_group VALUES (70,'Order Editor','Configuration options for Order Editor', 903,1);
INSERT INTO configuration_group VALUES (80, 'Recover Cart Sales', 'Recover Cart Sales (RCS) Configuration Values', 55, 1);


INSERT INTO `countries` VALUES(1, 'Afghanistan', 'AF', 'AFG', 1, 0);
INSERT INTO `countries` VALUES(2, 'Albania', 'AL', 'ALB', 1, 0);
INSERT INTO `countries` VALUES(3, 'Algeria', 'DZ', 'DZA', 1, 0);
INSERT INTO `countries` VALUES(4, 'American Samoa', 'AS', 'ASM', 1, 0);
INSERT INTO `countries` VALUES(5, 'Andorra', 'AD', 'AND', 1, 0);
INSERT INTO `countries` VALUES(6, 'Angola', 'AO', 'AGO', 1, 0);
INSERT INTO `countries` VALUES(7, 'Anguilla', 'AI', 'AIA', 1, 0);
INSERT INTO `countries` VALUES(8, 'Antarctica', 'AQ', 'ATA', 1, 0);
INSERT INTO `countries` VALUES(9, 'Antigua and Barbuda', 'AG', 'ATG', 1, 0);
INSERT INTO `countries` VALUES(10, 'Argentina', 'AR', 'ARG', 1, 0);
INSERT INTO `countries` VALUES(11, 'Armenia', 'AM', 'ARM', 1, 0);
INSERT INTO `countries` VALUES(12, 'Aruba', 'AW', 'ABW', 1, 0);
INSERT INTO `countries` VALUES(13, 'Australia', 'AU', 'AUS', 1, 0);
INSERT INTO `countries` VALUES(14, 'Austria', 'AT', 'AUT', 5, 0);
INSERT INTO `countries` VALUES(15, 'Azerbaijan', 'AZ', 'AZE', 1, 0);
INSERT INTO `countries` VALUES(16, 'Bahamas', 'BS', 'BHS', 1, 0);
INSERT INTO `countries` VALUES(17, 'Bahrain', 'BH', 'BHR', 1, 0);
INSERT INTO `countries` VALUES(18, 'Bangladesh', 'BD', 'BGD', 1, 0);
INSERT INTO `countries` VALUES(19, 'Barbados', 'BB', 'BRB', 1, 0);
INSERT INTO `countries` VALUES(20, 'Belarus', 'BY', 'BLR', 1, 0);
INSERT INTO `countries` VALUES(21, 'Belgium', 'BE', 'BEL', 1, 0);
INSERT INTO `countries` VALUES(22, 'Belize', 'BZ', 'BLZ', 1, 0);
INSERT INTO `countries` VALUES(23, 'Benin', 'BJ', 'BEN', 1, 0);
INSERT INTO `countries` VALUES(24, 'Bermuda', 'BM', 'BMU', 1, 0);
INSERT INTO `countries` VALUES(25, 'Bhutan', 'BT', 'BTN', 1, 0);
INSERT INTO `countries` VALUES(26, 'Bolivia', 'BO', 'BOL', 1, 0);
INSERT INTO `countries` VALUES(27, 'Bosnia and Herzegowina', 'BA', 'BIH', 1, 0);
INSERT INTO `countries` VALUES(28, 'Botswana', 'BW', 'BWA', 1, 0);
INSERT INTO `countries` VALUES(29, 'Bouvet Island', 'BV', 'BVT', 1, 0);
INSERT INTO `countries` VALUES(30, 'Brazil', 'BR', 'BRA', 1, 0);
INSERT INTO `countries` VALUES(31, 'British Indian Ocean Territory', 'IO', 'IOT', 1, 0);
INSERT INTO `countries` VALUES(32, 'Brunei Darussalam', 'BN', 'BRN', 1, 0);
INSERT INTO `countries` VALUES(33, 'Bulgaria', 'BG', 'BGR', 1, 0);
INSERT INTO `countries` VALUES(34, 'Burkina Faso', 'BF', 'BFA', 1, 0);
INSERT INTO `countries` VALUES(35, 'Burundi', 'BI', 'BDI', 1, 0);
INSERT INTO `countries` VALUES(36, 'Cambodia', 'KH', 'KHM', 1, 0);
INSERT INTO `countries` VALUES(37, 'Cameroon', 'CM', 'CMR', 1, 0);
INSERT INTO `countries` VALUES(38, 'Canada', 'CA', 'CAN', 1, 0);
INSERT INTO `countries` VALUES(39, 'Cape Verde', 'CV', 'CPV', 1, 0);
INSERT INTO `countries` VALUES(40, 'Cayman Islands', 'KY', 'CYM', 1, 0);
INSERT INTO `countries` VALUES(41, 'Central African Republic', 'CF', 'CAF', 1, 0);
INSERT INTO `countries` VALUES(42, 'Chad', 'TD', 'TCD', 1, 0);
INSERT INTO `countries` VALUES(43, 'Chile', 'CL', 'CHL', 1, 0);
INSERT INTO `countries` VALUES(44, 'China', 'CN', 'CHN', 1, 0);
INSERT INTO `countries` VALUES(45, 'Christmas Island', 'CX', 'CXR', 1, 0);
INSERT INTO `countries` VALUES(46, 'Cocos (Keeling) Islands', 'CC', 'CCK', 1, 0);
INSERT INTO `countries` VALUES(47, 'Colombia', 'CO', 'COL', 1, 0);
INSERT INTO `countries` VALUES(48, 'Comoros', 'KM', 'COM', 1, 0);
INSERT INTO `countries` VALUES(49, 'Congo', 'CG', 'COG', 1, 0);
INSERT INTO `countries` VALUES(50, 'Cook Islands', 'CK', 'COK', 1, 0);
INSERT INTO `countries` VALUES(51, 'Costa Rica', 'CR', 'CRI', 1, 0);
INSERT INTO `countries` VALUES(52, 'Cote D''Ivoire', 'CI', 'CIV', 1, 0);
INSERT INTO `countries` VALUES(53, 'Croatia', 'HR', 'HRV', 1, 0);
INSERT INTO `countries` VALUES(54, 'Cuba', 'CU', 'CUB', 1, 0);
INSERT INTO `countries` VALUES(55, 'Cyprus', 'CY', 'CYP', 1, 0);
INSERT INTO `countries` VALUES(56, 'Czech Republic', 'CZ', 'CZE', 1, 0);
INSERT INTO `countries` VALUES(57, 'Denmark', 'DK', 'DNK', 1, 0);
INSERT INTO `countries` VALUES(58, 'Djibouti', 'DJ', 'DJI', 1, 0);
INSERT INTO `countries` VALUES(59, 'Dominica', 'DM', 'DMA', 1, 0);
INSERT INTO `countries` VALUES(60, 'Dominican Republic', 'DO', 'DOM', 1, 0);
INSERT INTO `countries` VALUES(61, 'East Timor', 'TP', 'TMP', 1, 0);
INSERT INTO `countries` VALUES(62, 'Ecuador', 'EC', 'ECU', 1, 0);
INSERT INTO `countries` VALUES(63, 'Egypt', 'EG', 'EGY', 1, 0);
INSERT INTO `countries` VALUES(64, 'El Salvador', 'SV', 'SLV', 1, 0);
INSERT INTO `countries` VALUES(65, 'Equatorial Guinea', 'GQ', 'GNQ', 1, 0);
INSERT INTO `countries` VALUES(66, 'Eritrea', 'ER', 'ERI', 1, 0);
INSERT INTO `countries` VALUES(67, 'Estonia', 'EE', 'EST', 1, 0);
INSERT INTO `countries` VALUES(68, 'Ethiopia', 'ET', 'ETH', 1, 0);
INSERT INTO `countries` VALUES(69, 'Falkland Islands (Malvinas)', 'FK', 'FLK', 1, 0);
INSERT INTO `countries` VALUES(70, 'Faroe Islands', 'FO', 'FRO', 1, 0);
INSERT INTO `countries` VALUES(71, 'Fiji', 'FJ', 'FJI', 1, 0);
INSERT INTO `countries` VALUES(72, 'Finland', 'FI', 'FIN', 1, 0);
INSERT INTO `countries` VALUES(73, 'France', 'FR', 'FRA', 1, 0);
INSERT INTO `countries` VALUES(74, 'France, Metropolitan', 'FX', 'FXX', 1, 0);
INSERT INTO `countries` VALUES(75, 'French Guiana', 'GF', 'GUF', 1, 0);
INSERT INTO `countries` VALUES(76, 'French Polynesia', 'PF', 'PYF', 1, 0);
INSERT INTO `countries` VALUES(77, 'French Southern Territories', 'TF', 'ATF', 1, 0);
INSERT INTO `countries` VALUES(78, 'Gabon', 'GA', 'GAB', 1, 0);
INSERT INTO `countries` VALUES(79, 'Gambia', 'GM', 'GMB', 1, 0);
INSERT INTO `countries` VALUES(80, 'Georgia', 'GE', 'GEO', 1, 0);
INSERT INTO `countries` VALUES(81, 'Germany', 'DE', 'DEU', 5, 0);
INSERT INTO `countries` VALUES(82, 'Ghana', 'GH', 'GHA', 1, 0);
INSERT INTO `countries` VALUES(83, 'Gibraltar', 'GI', 'GIB', 1, 0);
INSERT INTO `countries` VALUES(84, 'Greece', 'GR', 'GRC', 1, 0);
INSERT INTO `countries` VALUES(85, 'Greenland', 'GL', 'GRL', 1, 0);
INSERT INTO `countries` VALUES(86, 'Grenada', 'GD', 'GRD', 1, 0);
INSERT INTO `countries` VALUES(87, 'Guadeloupe', 'GP', 'GLP', 1, 0);
INSERT INTO `countries` VALUES(88, 'Guam', 'GU', 'GUM', 1, 0);
INSERT INTO `countries` VALUES(89, 'Guatemala', 'GT', 'GTM', 1, 0);
INSERT INTO `countries` VALUES(90, 'Guinea', 'GN', 'GIN', 1, 0);
INSERT INTO `countries` VALUES(91, 'Guinea-bissau', 'GW', 'GNB', 1, 0);
INSERT INTO `countries` VALUES(92, 'Guyana', 'GY', 'GUY', 1, 0);
INSERT INTO `countries` VALUES(93, 'Haiti', 'HT', 'HTI', 1, 0);
INSERT INTO `countries` VALUES(94, 'Heard and Mc Donald Islands', 'HM', 'HMD', 1, 0);
INSERT INTO `countries` VALUES(95, 'Honduras', 'HN', 'HND', 1, 0);
INSERT INTO `countries` VALUES(96, 'Hong Kong', 'HK', 'HKG', 1, 0);
INSERT INTO `countries` VALUES(97, 'Hungary', 'HU', 'HUN', 1, 0);
INSERT INTO `countries` VALUES(98, 'Iceland', 'IS', 'ISL', 1, 0);
INSERT INTO `countries` VALUES(99, 'India', 'IN', 'IND', 1, 0);
INSERT INTO `countries` VALUES(100, 'Indonesia', 'ID', 'IDN', 1, 0);
INSERT INTO `countries` VALUES(101, 'Iran (Islamic Republic of)', 'IR', 'IRN', 1, 0);
INSERT INTO `countries` VALUES(102, 'Iraq', 'IQ', 'IRQ', 1, 0);
INSERT INTO `countries` VALUES(103, 'Ireland', 'IE', 'IRL', 1, 0);
INSERT INTO `countries` VALUES(104, 'Israel', 'IL', 'ISR', 1, 0);
INSERT INTO `countries` VALUES(105, 'Italy', 'IT', 'ITA', 1, 0);
INSERT INTO `countries` VALUES(106, 'Jamaica', 'JM', 'JAM', 1, 0);
INSERT INTO `countries` VALUES(107, 'Japan', 'JP', 'JPN', 1, 0);
INSERT INTO `countries` VALUES(108, 'Jordan', 'JO', 'JOR', 1, 0);
INSERT INTO `countries` VALUES(109, 'Kazakhstan', 'KZ', 'KAZ', 1, 0);
INSERT INTO `countries` VALUES(110, 'Kenya', 'KE', 'KEN', 1, 0);
INSERT INTO `countries` VALUES(111, 'Kiribati', 'KI', 'KIR', 1, 0);
INSERT INTO `countries` VALUES(112, 'Korea, Democratic People''s Republic of', 'KP', 'PRK', 1, 0);
INSERT INTO `countries` VALUES(113, 'Korea, Republic of', 'KR', 'KOR', 1, 0);
INSERT INTO `countries` VALUES(114, 'Kuwait', 'KW', 'KWT', 1, 0);
INSERT INTO `countries` VALUES(115, 'Kyrgyzstan', 'KG', 'KGZ', 1, 0);
INSERT INTO `countries` VALUES(116, 'Lao People''s Democratic Republic', 'LA', 'LAO', 1, 0);
INSERT INTO `countries` VALUES(117, 'Latvia', 'LV', 'LVA', 1, 0);
INSERT INTO `countries` VALUES(118, 'Lebanon', 'LB', 'LBN', 1, 0);
INSERT INTO `countries` VALUES(119, 'Lesotho', 'LS', 'LSO', 1, 0);
INSERT INTO `countries` VALUES(120, 'Liberia', 'LR', 'LBR', 1, 0);
INSERT INTO `countries` VALUES(121, 'Libyan Arab Jamahiriya', 'LY', 'LBY', 1, 0);
INSERT INTO `countries` VALUES(122, 'Liechtenstein', 'LI', 'LIE', 1, 0);
INSERT INTO `countries` VALUES(123, 'Lithuania', 'LT', 'LTU', 1, 0);
INSERT INTO `countries` VALUES(124, 'Luxembourg', 'LU', 'LUX', 1, 0);
INSERT INTO `countries` VALUES(125, 'Macau', 'MO', 'MAC', 1, 0);
INSERT INTO `countries` VALUES(126, 'Macedonia, The Former Yugoslav Republic of', 'MK', 'MKD', 1, 0);
INSERT INTO `countries` VALUES(127, 'Madagascar', 'MG', 'MDG', 1, 0);
INSERT INTO `countries` VALUES(128, 'Malawi', 'MW', 'MWI', 1, 0);
INSERT INTO `countries` VALUES(129, 'Malaysia', 'MY', 'MYS', 1, 0);
INSERT INTO `countries` VALUES(130, 'Maldives', 'MV', 'MDV', 1, 0);
INSERT INTO `countries` VALUES(131, 'Mali', 'ML', 'MLI', 1, 0);
INSERT INTO `countries` VALUES(132, 'Malta', 'MT', 'MLT', 1, 0);
INSERT INTO `countries` VALUES(133, 'Marshall Islands', 'MH', 'MHL', 1, 0);
INSERT INTO `countries` VALUES(134, 'Martinique', 'MQ', 'MTQ', 1, 0);
INSERT INTO `countries` VALUES(135, 'Mauritania', 'MR', 'MRT', 1, 0);
INSERT INTO `countries` VALUES(136, 'Mauritius', 'MU', 'MUS', 1, 0);
INSERT INTO `countries` VALUES(137, 'Mayotte', 'YT', 'MYT', 1, 0);
INSERT INTO `countries` VALUES(138, 'Mexico', 'MX', 'MEX', 1, 0);
INSERT INTO `countries` VALUES(139, 'Micronesia, Federated States of', 'FM', 'FSM', 1, 0);
INSERT INTO `countries` VALUES(140, 'Moldova, Republic of', 'MD', 'MDA', 1, 0);
INSERT INTO `countries` VALUES(141, 'Monaco', 'MC', 'MCO', 1, 0);
INSERT INTO `countries` VALUES(142, 'Mongolia', 'MN', 'MNG', 1, 0);
INSERT INTO `countries` VALUES(143, 'Montserrat', 'MS', 'MSR', 1, 0);
INSERT INTO `countries` VALUES(144, 'Morocco', 'MA', 'MAR', 1, 0);
INSERT INTO `countries` VALUES(145, 'Mozambique', 'MZ', 'MOZ', 1, 0);
INSERT INTO `countries` VALUES(146, 'Myanmar', 'MM', 'MMR', 1, 0);
INSERT INTO `countries` VALUES(147, 'Namibia', 'NA', 'NAM', 1, 0);
INSERT INTO `countries` VALUES(148, 'Nauru', 'NR', 'NRU', 1, 0);
INSERT INTO `countries` VALUES(149, 'Nepal', 'NP', 'NPL', 1, 0);
INSERT INTO `countries` VALUES(150, 'Netherlands', 'NL', 'NLD', 1, 0);
INSERT INTO `countries` VALUES(151, 'Netherlands Antilles', 'AN', 'ANT', 1, 0);
INSERT INTO `countries` VALUES(152, 'New Caledonia', 'NC', 'NCL', 1, 0);
INSERT INTO `countries` VALUES(153, 'New Zealand', 'NZ', 'NZL', 1, 0);
INSERT INTO `countries` VALUES(154, 'Nicaragua', 'NI', 'NIC', 1, 0);
INSERT INTO `countries` VALUES(155, 'Niger', 'NE', 'NER', 1, 0);
INSERT INTO `countries` VALUES(156, 'Nigeria', 'NG', 'NGA', 1, 0);
INSERT INTO `countries` VALUES(157, 'Niue', 'NU', 'NIU', 1, 0);
INSERT INTO `countries` VALUES(158, 'Norfolk Island', 'NF', 'NFK', 1, 0);
INSERT INTO `countries` VALUES(159, 'Northern Mariana Islands', 'MP', 'MNP', 1, 0);
INSERT INTO `countries` VALUES(160, 'Norway', 'NO', 'NOR', 1, 0);
INSERT INTO `countries` VALUES(161, 'Oman', 'OM', 'OMN', 1, 0);
INSERT INTO `countries` VALUES(162, 'Pakistan', 'PK', 'PAK', 1, 0);
INSERT INTO `countries` VALUES(163, 'Palau', 'PW', 'PLW', 1, 0);
INSERT INTO `countries` VALUES(164, 'Panama', 'PA', 'PAN', 1, 0);
INSERT INTO `countries` VALUES(165, 'Papua New Guinea', 'PG', 'PNG', 1, 0);
INSERT INTO `countries` VALUES(166, 'Paraguay', 'PY', 'PRY', 1, 0);
INSERT INTO `countries` VALUES(167, 'Peru', 'PE', 'PER', 1, 0);
INSERT INTO `countries` VALUES(168, 'Philippines', 'PH', 'PHL', 1, 0);
INSERT INTO `countries` VALUES(169, 'Pitcairn', 'PN', 'PCN', 1, 0);
INSERT INTO `countries` VALUES(170, 'Poland', 'PL', 'POL', 1, 0);
INSERT INTO `countries` VALUES(171, 'Portugal', 'PT', 'PRT', 1, 0);
INSERT INTO `countries` VALUES(172, 'Puerto Rico', 'PR', 'PRI', 1, 0);
INSERT INTO `countries` VALUES(173, 'Qatar', 'QA', 'QAT', 1, 0);
INSERT INTO `countries` VALUES(174, 'Reunion', 'RE', 'REU', 1, 0);
INSERT INTO `countries` VALUES(175, 'Romania', 'RO', 'ROM', 1, 0);
INSERT INTO `countries` VALUES(176, 'Russian Federation', 'RU', 'RUS', 1, 0);
INSERT INTO `countries` VALUES(177, 'Rwanda', 'RW', 'RWA', 1, 0);
INSERT INTO `countries` VALUES(178, 'Saint Kitts and Nevis', 'KN', 'KNA', 1, 0);
INSERT INTO `countries` VALUES(179, 'Saint Lucia', 'LC', 'LCA', 1, 0);
INSERT INTO `countries` VALUES(180, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 1, 0);
INSERT INTO `countries` VALUES(181, 'Samoa', 'WS', 'WSM', 1, 0);
INSERT INTO `countries` VALUES(182, 'San Marino', 'SM', 'SMR', 1, 0);
INSERT INTO `countries` VALUES(183, 'Sao Tome and Principe', 'ST', 'STP', 1, 0);
INSERT INTO `countries` VALUES(184, 'Saudi Arabia', 'SA', 'SAU', 1, 0);
INSERT INTO `countries` VALUES(185, 'Senegal', 'SN', 'SEN', 1, 0);
INSERT INTO `countries` VALUES(186, 'Seychelles', 'SC', 'SYC', 1, 0);
INSERT INTO `countries` VALUES(187, 'Sierra Leone', 'SL', 'SLE', 1, 0);
INSERT INTO `countries` VALUES(188, 'Singapore', 'SG', 'SGP', 4, 0);
INSERT INTO `countries` VALUES(189, 'Slovakia (Slovak Republic)', 'SK', 'SVK', 1, 0);
INSERT INTO `countries` VALUES(190, 'Slovenia', 'SI', 'SVN', 1, 0);
INSERT INTO `countries` VALUES(191, 'Solomon Islands', 'SB', 'SLB', 1, 0);
INSERT INTO `countries` VALUES(192, 'Somalia', 'SO', 'SOM', 1, 0);
INSERT INTO `countries` VALUES(193, 'South Africa', 'ZA', 'ZAF', 1, 0);
INSERT INTO `countries` VALUES(194, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 1, 0);
INSERT INTO `countries` VALUES(195, 'Spain', 'ES', 'ESP', 3, 0);
INSERT INTO `countries` VALUES(196, 'Sri Lanka', 'LK', 'LKA', 1, 0);
INSERT INTO `countries` VALUES(197, 'St. Helena', 'SH', 'SHN', 1, 0);
INSERT INTO `countries` VALUES(198, 'St. Pierre and Miquelon', 'PM', 'SPM', 1, 0);
INSERT INTO `countries` VALUES(199, 'Sudan', 'SD', 'SDN', 1, 0);
INSERT INTO `countries` VALUES(200, 'Suriname', 'SR', 'SUR', 1, 0);
INSERT INTO `countries` VALUES(201, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', 1, 0);
INSERT INTO `countries` VALUES(202, 'Swaziland', 'SZ', 'SWZ', 1, 0);
INSERT INTO `countries` VALUES(203, 'Sweden', 'SE', 'SWE', 1, 0);
INSERT INTO `countries` VALUES(204, 'Switzerland', 'CH', 'CHE', 1, 0);
INSERT INTO `countries` VALUES(205, 'Syrian Arab Republic', 'SY', 'SYR', 1, 0);
INSERT INTO `countries` VALUES(206, 'Taiwan', 'TW', 'TWN', 1, 0);
INSERT INTO `countries` VALUES(207, 'Tajikistan', 'TJ', 'TJK', 1, 0);
INSERT INTO `countries` VALUES(208, 'Tanzania, United Republic of', 'TZ', 'TZA', 1, 0);
INSERT INTO `countries` VALUES(209, 'Thailand', 'TH', 'THA', 1, 0);
INSERT INTO `countries` VALUES(210, 'Togo', 'TG', 'TGO', 1, 0);
INSERT INTO `countries` VALUES(211, 'Tokelau', 'TK', 'TKL', 1, 0);
INSERT INTO `countries` VALUES(212, 'Tonga', 'TO', 'TON', 1, 0);
INSERT INTO `countries` VALUES(213, 'Trinidad and Tobago', 'TT', 'TTO', 1, 0);
INSERT INTO `countries` VALUES(214, 'Tunisia', 'TN', 'TUN', 1, 0);
INSERT INTO `countries` VALUES(215, 'Turkey', 'TR', 'TUR', 1, 0);
INSERT INTO `countries` VALUES(216, 'Turkmenistan', 'TM', 'TKM', 1, 0);
INSERT INTO `countries` VALUES(217, 'Turks and Caicos Islands', 'TC', 'TCA', 1, 0);
INSERT INTO `countries` VALUES(218, 'Tuvalu', 'TV', 'TUV', 1, 0);
INSERT INTO `countries` VALUES(219, 'Uganda', 'UG', 'UGA', 1, 0);
INSERT INTO `countries` VALUES(220, 'Ukraine', 'UA', 'UKR', 1, 0);
INSERT INTO `countries` VALUES(221, 'United Arab Emirates', 'AE', 'ARE', 1, 0);
INSERT INTO `countries` VALUES(222, 'United Kingdom', 'GB', 'GBR', 6, 1);
INSERT INTO `countries` VALUES(223, 'United States', 'US', 'USA', 2, 1);
INSERT INTO `countries` VALUES(224, 'United States Minor Outlying Islands', 'UM', 'UMI', 1, 0);
INSERT INTO `countries` VALUES(225, 'Uruguay', 'UY', 'URY', 1, 0);
INSERT INTO `countries` VALUES(226, 'Uzbekistan', 'UZ', 'UZB', 1, 0);
INSERT INTO `countries` VALUES(227, 'Vanuatu', 'VU', 'VUT', 1, 0);
INSERT INTO `countries` VALUES(228, 'Vatican City State (Holy See)', 'VA', 'VAT', 1, 0);
INSERT INTO `countries` VALUES(229, 'Venezuela', 'VE', 'VEN', 1, 0);
INSERT INTO `countries` VALUES(230, 'Viet Nam', 'VN', 'VNM', 1, 0);
INSERT INTO `countries` VALUES(231, 'Virgin Islands (British)', 'VG', 'VGB', 1, 0);
INSERT INTO `countries` VALUES(232, 'Virgin Islands (U.S.)', 'VI', 'VIR', 1, 0);
INSERT INTO `countries` VALUES(233, 'Wallis and Futuna Islands', 'WF', 'WLF', 1, 0);
INSERT INTO `countries` VALUES(234, 'Western Sahara', 'EH', 'ESH', 1, 0);
INSERT INTO `countries` VALUES(235, 'Yemen', 'YE', 'YEM', 1, 0);
INSERT INTO `countries` VALUES(236, 'Yugoslavia', 'YU', 'YUG', 1, 0);
INSERT INTO `countries` VALUES(237, 'Zaire', 'ZR', 'ZAR', 1, 0);
INSERT INTO `countries` VALUES(238, 'Zambia', 'ZM', 'ZMB', 1, 0);
INSERT INTO `countries` VALUES(239, 'Zimbabwe', 'ZW', 'ZWE', 1, 0);


INSERT INTO currencies VALUES (1,'US Dollar','USD','$','','.',',','2','1.0000',now());
INSERT INTO currencies VALUES (2,'Euro','EUR','','EUR','.',',','2','1.1036',now());
INSERT INTO currencies VALUES (3,'UK Pound','GBP','£','','.',',','2', 0.85000002,now());


INSERT INTO customers_groups VALUES (0,'Retail','1','0','','');
INSERT INTO customers_groups VALUES (1,'Wholesale','0','0','','');

INSERT INTO languages VALUES (1,'English','en','icon.gif','english',1);
INSERT INTO languages VALUES (2,'Deutsch','de','icon.gif','german',2);
INSERT INTO languages VALUES (3,'Español','es','icon.gif','espanol',3);

INSERT INTO orders_status VALUES (1,1,'Pending',1,0);
INSERT INTO orders_status VALUES (1,2,'Offen',1,0);
INSERT INTO orders_status VALUES (1,3,'Pendiente',1,0);
INSERT INTO orders_status VALUES (2,1,'Processing',1,1);
INSERT INTO orders_status VALUES (2,2,'In Bearbeitung',1,1);
INSERT INTO orders_status VALUES (2,3,'Proceso',1,1);
INSERT INTO orders_status VALUES (3,1,'Delivered',1,1);
INSERT INTO orders_status VALUES (3,2,'Versendet',1,1);
INSERT INTO orders_status VALUES (3,3,'Entregado',1,1);

INSERT INTO products_attributes_download  VALUES (11, 'Dhtml-coolmenu.zip',7,10);

INSERT INTO products_options VALUES (1,1, 'Version', '0', '0', '32',NULL);
INSERT INTO products_options VALUES (1,2, 'Version', '0', '0', '32',NULL);
INSERT INTO products_options VALUES (1,3, 'Version', '0', '0', '32',NULL);

INSERT INTO products_options_values VALUES (1, 1, 'Download: Windows - English');
INSERT INTO products_options_values VALUES (1, 2, 'Download: Windows - Englisch');
INSERT INTO products_options_values VALUES (1, 3, 'Download: Windows - Inglese');

INSERT INTO products_options_values_to_products_options VALUES (14,1,1);

INSERT INTO tax_class VALUES (1,'Taxable Goods','The following types of products are included non-food,services,etc',now(),now());
INSERT INTO tax_class VALUES (2,'Taxable Item','Any taxable item',now(),now());
INSERT INTO tax_class VALUES (3,'Non Taxable','Non Taxable Goods',now(),now());

# USA/Florida
INSERT INTO tax_rates VALUES (1,1,1,1,7.0,'FL TAX 7.0%',now(),now());
INSERT INTO geo_zones (geo_zone_id,geo_zone_name,geo_zone_description,date_added) VALUES (1,"Florida","Florida local sales tax zone",now());
INSERT INTO zones_to_geo_zones (association_id,zone_country_id,zone_id,geo_zone_id,date_added) VALUES (1,223,18,1,now());

INSERT INTO theme_configuration VALUES (1,'best sellers','BOX_HEADING_BEST_SELLERS','yes','Display Best Sellers box?','1','left','12','1',NULL,now(),'');
INSERT INTO theme_configuration VALUES (3,'currencies','BOX_HEADING_CATEGORIES_CURRENCIES','yes','Display Currencies box?','1','right','8','3',NULL,now(),'');
INSERT INTO theme_configuration VALUES (5,'information','BOX_HEADING_INFORMATION','yes','Display Information box?','1','left','7','5',NULL,now(),'');
INSERT INTO theme_configuration VALUES (6,'languages','BOX_HEADING_LANGUAGES','yes','Display Languages box?','1','right','7','6',NULL,now(),'');
INSERT INTO theme_configuration VALUES (7,'manufacturer info','BOX_HEADING_MANUFACTURER_INFO','yes','Display Manufacturer Info box?','1','right','9','7',NULL,now(),'');
INSERT INTO theme_configuration VALUES (8,'manufacturers','BOX_HEADING_MANUFACTURERS','yes','Display Manufacturers box?','1','left','6','8',NULL,now(),'Manufactures');
INSERT INTO theme_configuration VALUES (9,'order history','BOX_HEADING_ORDER_HISTORY','yes','Display Order History box?','1','right','4','9',NULL,now(),'');
INSERT INTO theme_configuration VALUES (10,'product notifications','BOX_HEADING_PRODUCT_NOTIFICATIONS','yes','Display Product Notifications box?','1','right','9','10',NULL,now(),'');
INSERT INTO theme_configuration VALUES (11,'reviews','BOX_HEADING_REVIEWS','yes','Display Reviews box?','1','right','6','11',NULL,now(),'');
INSERT INTO theme_configuration VALUES (12,'search','BOX_HEADING_SEARCH','yes','Display Search box?','1','left','5','12',NULL,now(),'Quick Find');
INSERT INTO theme_configuration VALUES (13,'shopping cart','BOX_HEADING_SHOPPING_CART','yes','Display Shopping Cart box?','1','right','1','13',NULL,now(),'');
INSERT INTO theme_configuration VALUES (14,'specials','BOX_HEADING_SPECIALS','yes','Display Specials box?','1','right','5','14',NULL,now(),'Specials');
INSERT INTO theme_configuration VALUES (15,'tell a friend','BOX_HEADING_TELL_A_FRIEND','yes','Display Tell a Friend box?','1','right','4','15',NULL,now(),'');
INSERT INTO theme_configuration VALUES (16,'what\'s new','BOX_HEADING_WHATS_NEW','yes','Display What\'s New? box?','1','left','4','16',NULL,now(),'What\'s New');
INSERT INTO theme_configuration VALUES (26,'articles','BOX_HEADING_ARTICLES','yes','','1','right','10',NULL,NULL,now(),'Articles');
INSERT INTO theme_configuration VALUES (25,'loginbox','BOX_HEADING_LOGIN_BOX','yes','','1','right','2',NULL,NULL,now(),'Sign In');
INSERT INTO theme_configuration VALUES (28,'affiliate','BOX_HEADING_AFFILIATE','yes','','1','left','3',NULL,NULL,now(),'Affiliates');
INSERT INTO theme_configuration VALUES (2,'categories','BOX_HEADING_CATEGORIES','yes','','1','left','1',NULL,NULL,now(),'Categories');
INSERT INTO theme_configuration VALUES (22,'wishlist','BOX_HEADING_CUSTOMER_WISHLIST','yes','','1','right','3',NULL,NULL,now(),'My Wish List');
INSERT INTO theme_configuration VALUES (29,'Authors','BOX_HEADING_AUTHORS','yes','','1','right','11',NULL,NULL,now(),'Authors');

# USA
INSERT INTO zones VALUES (1,223,'AL','Alabama');
INSERT INTO zones VALUES (2,223,'AK','Alaska');
INSERT INTO zones VALUES (3,223,'AS','American Samoa');
INSERT INTO zones VALUES (4,223,'AZ','Arizona');
INSERT INTO zones VALUES (5,223,'AR','Arkansas');
INSERT INTO zones VALUES (6,223,'AF','Armed Forces Africa');
INSERT INTO zones VALUES (7,223,'AA','Armed Forces Americas');
INSERT INTO zones VALUES (8,223,'AC','Armed Forces Canada');
INSERT INTO zones VALUES (9,223,'AE','Armed Forces Europe');
INSERT INTO zones VALUES (10,223,'AM','Armed Forces Middle East');
INSERT INTO zones VALUES (11,223,'AP','Armed Forces Pacific');
INSERT INTO zones VALUES (12,223,'CA','California');
INSERT INTO zones VALUES (13,223,'CO','Colorado');
INSERT INTO zones VALUES (14,223,'CT','Connecticut');
INSERT INTO zones VALUES (15,223,'DE','Delaware');
INSERT INTO zones VALUES (16,223,'DC','District of Columbia');
INSERT INTO zones VALUES (17,223,'FM','Federated States Of Micronesia');
INSERT INTO zones VALUES (18,223,'FL','Florida');
INSERT INTO zones VALUES (19,223,'GA','Georgia');
INSERT INTO zones VALUES (20,223,'GU','Guam');
INSERT INTO zones VALUES (21,223,'HI','Hawaii');
INSERT INTO zones VALUES (22,223,'ID','Idaho');
INSERT INTO zones VALUES (23,223,'IL','Illinois');
INSERT INTO zones VALUES (24,223,'IN','Indiana');
INSERT INTO zones VALUES (25,223,'IA','Iowa');
INSERT INTO zones VALUES (26,223,'KS','Kansas');
INSERT INTO zones VALUES (27,223,'KY','Kentucky');
INSERT INTO zones VALUES (28,223,'LA','Louisiana');
INSERT INTO zones VALUES (29,223,'ME','Maine');
INSERT INTO zones VALUES (30,223,'MH','Marshall Islands');
INSERT INTO zones VALUES (31,223,'MD','Maryland');
INSERT INTO zones VALUES (32,223,'MA','Massachusetts');
INSERT INTO zones VALUES (33,223,'MI','Michigan');
INSERT INTO zones VALUES (34,223,'MN','Minnesota');
INSERT INTO zones VALUES (35,223,'MS','Mississippi');
INSERT INTO zones VALUES (36,223,'MO','Missouri');
INSERT INTO zones VALUES (37,223,'MT','Montana');
INSERT INTO zones VALUES (38,223,'NE','Nebraska');
INSERT INTO zones VALUES (39,223,'NV','Nevada');
INSERT INTO zones VALUES (40,223,'NH','New Hampshire');
INSERT INTO zones VALUES (41,223,'NJ','New Jersey');
INSERT INTO zones VALUES (42,223,'NM','New Mexico');
INSERT INTO zones VALUES (43,223,'NY','New York');
INSERT INTO zones VALUES (44,223,'NC','North Carolina');
INSERT INTO zones VALUES (45,223,'ND','North Dakota');
INSERT INTO zones VALUES (46,223,'MP','Northern Mariana Islands');
INSERT INTO zones VALUES (47,223,'OH','Ohio');
INSERT INTO zones VALUES (48,223,'OK','Oklahoma');
INSERT INTO zones VALUES (49,223,'OR','Oregon');
INSERT INTO zones VALUES (50,223,'PW','Palau');
INSERT INTO zones VALUES (51,223,'PA','Pennsylvania');
INSERT INTO zones VALUES (52,223,'PR','Puerto Rico');
INSERT INTO zones VALUES (53,223,'RI','Rhode Island');
INSERT INTO zones VALUES (54,223,'SC','South Carolina');
INSERT INTO zones VALUES (55,223,'SD','South Dakota');
INSERT INTO zones VALUES (56,223,'TN','Tennessee');
INSERT INTO zones VALUES (57,223,'TX','Texas');
INSERT INTO zones VALUES (58,223,'UT','Utah');
INSERT INTO zones VALUES (59,223,'VT','Vermont');
INSERT INTO zones VALUES (60,223,'VI','Virgin Islands');
INSERT INTO zones VALUES (61,223,'VA','Virginia');
INSERT INTO zones VALUES (62,223,'WA','Washington');
INSERT INTO zones VALUES (63,223,'WV','West Virginia');
INSERT INTO zones VALUES (64,223,'WI','Wisconsin');
INSERT INTO zones VALUES (65,223,'WY','Wyoming');

# Canada
INSERT INTO zones VALUES (66,38,'AB','Alberta');
INSERT INTO zones VALUES (67,38,'BC','British Columbia');
INSERT INTO zones VALUES (68,38,'MB','Manitoba');
INSERT INTO zones VALUES (69,38,'NF','Newfoundland');
INSERT INTO zones VALUES (70,38,'NB','New Brunswick');
INSERT INTO zones VALUES (71,38,'NS','Nova Scotia');
INSERT INTO zones VALUES (72,38,'NT','Northwest Territories');
INSERT INTO zones VALUES (73,38,'NU','Nunavut');
INSERT INTO zones VALUES (74,38,'ON','Ontario');
INSERT INTO zones VALUES (75,38,'PE','Prince Edward Island');
INSERT INTO zones VALUES (76,38,'QC','Quebec');
INSERT INTO zones VALUES (77,38,'SK','Saskatchewan');
INSERT INTO zones VALUES (78,38,'YT','Yukon Territory');

# Germany
INSERT INTO zones VALUES (79,81,'NDS','Niedersachsen');
INSERT INTO zones VALUES (80,81,'BAW','Baden-Württemberg');
INSERT INTO zones VALUES (81,81,'BAY','Bayern');
INSERT INTO zones VALUES (82,81,'BER','Berlin');
INSERT INTO zones VALUES (83,81,'BRG','Brandenburg');
INSERT INTO zones VALUES (84,81,'BRE','Bremen');
INSERT INTO zones VALUES (85,81,'HAM','Hamburg');
INSERT INTO zones VALUES (86,81,'HES','Hessen');
INSERT INTO zones VALUES (87,81,'MEC','Mecklenburg-Vorpommern');
INSERT INTO zones VALUES (88,81,'NRW','Nordrhein-Westfalen');
INSERT INTO zones VALUES (89,81,'RHE','Rheinland-Pfalz');
INSERT INTO zones VALUES (90,81,'SAR','Saarland');
INSERT INTO zones VALUES (91,81,'SAS','Sachsen');
INSERT INTO zones VALUES (92,81,'SAC','Sachsen-Anhalt');
INSERT INTO zones VALUES (93,81,'SCN','Schleswig-Holstein');
INSERT INTO zones VALUES (94,81,'THE','Thüringen');

# Austria
INSERT INTO zones VALUES (95,14,'WI','Wien');
INSERT INTO zones VALUES (96,14,'NO','Niederösterreich');
INSERT INTO zones VALUES (97,14,'OO','Oberösterreich');
INSERT INTO zones VALUES (98,14,'SB','Salzburg');
INSERT INTO zones VALUES (99,14,'KN','Kärnten');
INSERT INTO zones VALUES (100,14,'ST','Steiermark');
INSERT INTO zones VALUES (101,14,'TI','Tirol');
INSERT INTO zones VALUES (102,14,'BL','Burgenland');
INSERT INTO zones VALUES (103,14,'VB','Voralberg');

# Swizterland
INSERT INTO zones VALUES (104,204,'AG','Aargau');
INSERT INTO zones VALUES (105,204,'AI','Appenzell Innerrhoden');
INSERT INTO zones VALUES (106,204,'AR','Appenzell Ausserrhoden');
INSERT INTO zones VALUES (107,204,'BE','Bern');
INSERT INTO zones VALUES (108,204,'BL','Basel-Landschaft');
INSERT INTO zones VALUES (109,204,'BS','Basel-Stadt');
INSERT INTO zones VALUES (110,204,'FR','Freiburg');
INSERT INTO zones VALUES (111,204,'GE','Genf');
INSERT INTO zones VALUES (112,204,'GL','Glarus');
INSERT INTO zones VALUES (113,204,'JU','Graubünden');
INSERT INTO zones VALUES (114,204,'JU','Jura');
INSERT INTO zones VALUES (115,204,'LU','Luzern');
INSERT INTO zones VALUES (116,204,'NE','Neuenburg');
INSERT INTO zones VALUES (117,204,'NW','Nidwalden');
INSERT INTO zones VALUES (118,204,'OW','Obwalden');
INSERT INTO zones VALUES (119,204,'SG','St. Gallen');
INSERT INTO zones VALUES (120,204,'SH','Schaffhausen');
INSERT INTO zones VALUES (121,204,'SO','Solothurn');
INSERT INTO zones VALUES (122,204,'SZ','Schwyz');
INSERT INTO zones VALUES (123,204,'TG','Thurgau');
INSERT INTO zones VALUES (124,204,'TI','Tessin');
INSERT INTO zones VALUES (125,204,'UR','Uri');
INSERT INTO zones VALUES (126,204,'VD','Waadt');
INSERT INTO zones VALUES (127,204,'VS','Wallis');
INSERT INTO zones VALUES (128,204,'ZG','Zug');
INSERT INTO zones VALUES (129,204,'ZH','Zürich');

# Spain
INSERT INTO zones VALUES (130,195,'A Coruña','A Coruña');
INSERT INTO zones VALUES (131,195,'Alava','Alava');
INSERT INTO zones VALUES (132,195,'Albacete','Albacete');
INSERT INTO zones VALUES (133,195,'Alicante','Alicante');
INSERT INTO zones VALUES (134,195,'Almeria','Almeria');
INSERT INTO zones VALUES (135,195,'Asturias','Asturias');
INSERT INTO zones VALUES (136,195,'Avila','Avila');
INSERT INTO zones VALUES (137,195,'Badajoz','Badajoz');
INSERT INTO zones VALUES (138,195,'Baleares','Baleares');
INSERT INTO zones VALUES (139,195,'Barcelona','Barcelona');
INSERT INTO zones VALUES (140,195,'Burgos','Burgos');
INSERT INTO zones VALUES (141,195,'Caceres','Caceres');
INSERT INTO zones VALUES (142,195,'Cadiz','Cadiz');
INSERT INTO zones VALUES (143,195,'Cantabria','Cantabria');
INSERT INTO zones VALUES (144,195,'Castellon','Castellon');
INSERT INTO zones VALUES (145,195,'Ceuta','Ceuta');
INSERT INTO zones VALUES (146,195,'Ciudad Real','Ciudad Real');
INSERT INTO zones VALUES (147,195,'Cordoba','Cordoba');
INSERT INTO zones VALUES (148,195,'Cuenca','Cuenca');
INSERT INTO zones VALUES (149,195,'Girona','Girona');
INSERT INTO zones VALUES (150,195,'Granada','Granada');
INSERT INTO zones VALUES (151,195,'Guadalajara','Guadalajara');
INSERT INTO zones VALUES (152,195,'Guipuzcoa','Guipuzcoa');
INSERT INTO zones VALUES (153,195,'Huelva','Huelva');
INSERT INTO zones VALUES (154,195,'Huesca','Huesca');
INSERT INTO zones VALUES (155,195,'Jaen','Jaen');
INSERT INTO zones VALUES (156,195,'La Rioja','La Rioja');
INSERT INTO zones VALUES (157,195,'Las Palmas','Las Palmas');
INSERT INTO zones VALUES (158,195,'Leon','Leon');
INSERT INTO zones VALUES (159,195,'Lleida','Lleida');
INSERT INTO zones VALUES (160,195,'Lugo','Lugo');
INSERT INTO zones VALUES (161,195,'Madrid','Madrid');
INSERT INTO zones VALUES (162,195,'Malaga','Malaga');
INSERT INTO zones VALUES (163,195,'Melilla','Melilla');
INSERT INTO zones VALUES (164,195,'Murcia','Murcia');
INSERT INTO zones VALUES (165,195,'Navarra','Navarra');
INSERT INTO zones VALUES (166,195,'Ourense','Ourense');
INSERT INTO zones VALUES (167,195,'Palencia','Palencia');
INSERT INTO zones VALUES (168,195,'Pontevedra','Pontevedra');
INSERT INTO zones VALUES (169,195,'Salamanca','Salamanca');
INSERT INTO zones VALUES (170,195,'Santa Cruz de Tenerife','Santa Cruz de Tenerife');
INSERT INTO zones VALUES (171,195,'Segovia','Segovia');
INSERT INTO zones VALUES (172,195,'Sevilla','Sevilla');
INSERT INTO zones VALUES (173,195,'Soria','Soria');
INSERT INTO zones VALUES (174,195,'Tarragona','Tarragona');
INSERT INTO zones VALUES (175,195,'Teruel','Teruel');
INSERT INTO zones VALUES (176,195,'Toledo','Toledo');
INSERT INTO zones VALUES (177,195,'Valencia','Valencia');
INSERT INTO zones VALUES (178,195,'Valladolid','Valladolid');
INSERT INTO zones VALUES (179,195,'Vizcaya','Vizcaya');
INSERT INTO zones VALUES (180,195,'Zamora','Zamora');
INSERT INTO zones VALUES (181,195,'Zaragoza','Zaragoza');

# UK
INSERT INTO zones VALUES (182, 222, 'Aberdeen', 'Aberdeen');
INSERT INTO zones VALUES (183, 222, 'Aberdeenshire', 'Aberdeenshire');
INSERT INTO zones VALUES (184, 222, 'Anglesey', 'Anglesey');
INSERT INTO zones VALUES (185, 222, 'Angus', 'Angus');
INSERT INTO zones VALUES (186, 222, 'Argyll and Bute', 'Argyll and Bute');
INSERT INTO zones VALUES (187, 222, 'Bedfordshire', 'Bedfordshire');
INSERT INTO zones VALUES (188, 222, 'Berkshire', 'Berkshire');
INSERT INTO zones VALUES (189, 222, 'Blaenau Gwent', 'Blaenau Gwent');
INSERT INTO zones VALUES (190, 222, 'Bridgend', 'Bridgend');
INSERT INTO zones VALUES (191, 222, 'Bristol', 'Bristol');
INSERT INTO zones VALUES (192, 222, 'Buckinghamshire', 'Buckinghamshire');
INSERT INTO zones VALUES (193, 222, 'Caerphilly', 'Caerphilly');
INSERT INTO zones VALUES (194, 222, 'Cambridgeshire', 'Cambridgeshire');
INSERT INTO zones VALUES (195, 222, 'Cardiff', 'Cardiff');
INSERT INTO zones VALUES (196, 222, 'Carmarthenshire', 'Carmarthenshire');
INSERT INTO zones VALUES (197, 222, 'Ceredigion', 'Ceredigion');
INSERT INTO zones VALUES (198, 222, 'Channel Islands', 'Channel Islands');
INSERT INTO zones VALUES (199, 222, 'Cheshire', 'Cheshire');
INSERT INTO zones VALUES (200, 222, 'Clackmannanshire', 'Clackmannanshire');
INSERT INTO zones VALUES (201, 222, 'Conwy', 'Conwy');
INSERT INTO zones VALUES (202, 222, 'Cornwall', 'Cornwall');
INSERT INTO zones VALUES (203, 222, 'Denbighshire', 'Denbighshire');
INSERT INTO zones VALUES (204, 222, 'Derbyshire', 'Derbyshire');
INSERT INTO zones VALUES (205, 222, 'Devon', 'Devon');
INSERT INTO zones VALUES (206, 222, 'Dorset', 'Dorset');
INSERT INTO zones VALUES (207, 222, 'Dumfries and Galloway', 'Dumfries and Galloway');
INSERT INTO zones VALUES (208, 222, 'Dundee', 'Dundee');
INSERT INTO zones VALUES (209, 222, 'Durham', 'Durham');
INSERT INTO zones VALUES (210, 222, 'East Ayrshire', 'East Ayrshire');
INSERT INTO zones VALUES (211, 222, 'East Dunbartonshire', 'East Dunbartonshire');
INSERT INTO zones VALUES (212, 222, 'East Lothian', 'East Lothian');
INSERT INTO zones VALUES (213, 222, 'East Renfrewshire', 'East Renfrewshire');
INSERT INTO zones VALUES (214, 222, 'East Riding of Yorkshire', 'East Riding of Yorkshire');
INSERT INTO zones VALUES (215, 222, 'East Sussex', 'East Sussex');
INSERT INTO zones VALUES (216, 222, 'Edinburgh', 'Edinburgh');
INSERT INTO zones VALUES (217, 222, 'Essex', 'Essex');
INSERT INTO zones VALUES (218, 222, 'Falkirk', 'Falkirk');
INSERT INTO zones VALUES (219, 222, 'Fife', 'Fife');
INSERT INTO zones VALUES (220, 222, 'Flintshire', 'Flintshire');
INSERT INTO zones VALUES (221, 222, 'Glasgow', 'Glasgow');
INSERT INTO zones VALUES (222, 222, 'Gloucestershire', 'Gloucestershire');
INSERT INTO zones VALUES (223, 222, 'Greater London', 'Greater London');
INSERT INTO zones VALUES (224, 222, 'Greater Manchester', 'Greater Manchester');
INSERT INTO zones VALUES (225, 222, 'Gwynedd', 'Gwynedd');;
INSERT INTO zones VALUES (226, 222, 'Hampshire', 'Hampshire');
INSERT INTO zones VALUES (227, 222, 'Herefordshire', 'Herefordshire');
INSERT INTO zones VALUES (228, 222, 'Hertfordshire', 'Hertfordshire');
INSERT INTO zones VALUES (229, 222, 'Highlands', 'Highlands');
INSERT INTO zones VALUES (230, 222, 'Inverclyde', 'Inverclyde');
INSERT INTO zones VALUES (231, 222, 'Isle of Man', 'Isle of Man');
INSERT INTO zones VALUES (232, 222, 'Isle of Wight', 'Isle of Wight');
INSERT INTO zones VALUES (233, 222, 'Kent', 'Kent');
INSERT INTO zones VALUES (234, 222, 'Lancashire', 'Lancashire');
INSERT INTO zones VALUES (235, 222, 'Leicestershire', 'Leicestershire');
INSERT INTO zones VALUES (236, 222, 'Lincolnshire', 'Lincolnshire');
INSERT INTO zones VALUES (237, 222, 'Merseyside', 'Merseyside');
INSERT INTO zones VALUES (238, 222, 'Merthyr Tydfil', 'Merthyr Tydfil');
INSERT INTO zones VALUES (239, 222, 'Midlothian', 'Midlothian');
INSERT INTO zones VALUES (240, 222, 'Monmouthshire', 'Monmouthshire');
INSERT INTO zones VALUES (241, 222, 'Moray', 'Moray');
INSERT INTO zones VALUES (242, 222, 'Neath Port Talbot', 'Neath Port Talbot');
INSERT INTO zones VALUES (243, 222, 'Newport', 'Newport');
INSERT INTO zones VALUES (244, 222, 'Norfolk', 'Norfolk');
INSERT INTO zones VALUES (245, 222, 'North Ayrshire', 'North Ayrshire');
INSERT INTO zones VALUES (246, 222, 'North Lanarkshire', 'North Lanarkshire');
INSERT INTO zones VALUES (247, 222, 'North Yorkshire', 'North Yorkshire');
INSERT INTO zones VALUES (248, 222, 'Northamptonshire', 'Northamptonshire');
INSERT INTO zones VALUES (249, 222, 'Northumberland', 'Northumberland');
INSERT INTO zones VALUES (250, 222, 'Nottinghamshire', 'Nottinghamshire');
INSERT INTO zones VALUES (251, 222, 'Orkney Islands', 'Orkney Islands');
INSERT INTO zones VALUES (252, 222, 'Oxfordshire', 'Oxfordshire');
INSERT INTO zones VALUES (253, 222, 'Pembrokeshire', 'Pembrokeshire');
INSERT INTO zones VALUES (254, 222, 'Perth and Kinross', 'Perth and Kinross');
INSERT INTO zones VALUES (255, 222, 'Powys', 'Powys');
INSERT INTO zones VALUES (256, 222, 'Renfrewshire', 'Renfrewshire');
INSERT INTO zones VALUES (257, 222, 'Rhondda Cynon Taff', 'Rhondda Cynon Taff');
INSERT INTO zones VALUES (258, 222, 'Rutland', 'Rutland');
INSERT INTO zones VALUES (259, 222, 'Scottish Borders', 'Scottish Borders');
INSERT INTO zones VALUES (260, 222, 'Shetland Islands', 'Shetland Islands');
INSERT INTO zones VALUES (261, 222, 'Shropshire', 'Shropshire');
INSERT INTO zones VALUES (262, 222, 'Somerset', 'Somerset');
INSERT INTO zones VALUES (263, 222, 'South Ayrshire', 'South Ayrshire');
INSERT INTO zones VALUES (264, 222, 'South Lanarkshire', 'South Lanarkshire');
INSERT INTO zones VALUES (265, 222, 'South Yorkshire', 'South Yorkshire');
INSERT INTO zones VALUES (266, 222, 'Staffordshire', 'Staffordshire');
INSERT INTO zones VALUES (267, 222, 'Stirling', 'Stirling');
INSERT INTO zones VALUES (268, 222, 'Suffolk', 'Suffolk');
INSERT INTO zones VALUES (269, 222, 'Surrey', 'Surrey');
INSERT INTO zones VALUES (270, 222, 'Swansea', 'Swansea');
INSERT INTO zones VALUES (271, 222, 'Torfaen', 'Torfaen');
INSERT INTO zones VALUES (272, 222, 'Tyne and Wear', 'Tyne and Wear');
INSERT INTO zones VALUES (273, 222, 'Vale of Glamorgan', 'Vale of Glamorgan');
INSERT INTO zones VALUES (274, 222, 'Warwickshire', 'Warwickshire');
INSERT INTO zones VALUES (275, 222, 'West Dunbartonshire', 'West Dunbartonshire');
INSERT INTO zones VALUES (276, 222, 'West Lothian', 'West Lothian');
INSERT INTO zones VALUES (277, 222, 'West Midlands', 'West Midlands');
INSERT INTO zones VALUES (278, 222, 'West Sussex', 'West Sussex');
INSERT INTO zones VALUES (279, 222, 'West Yorkshire', 'West Yorkshire');
INSERT INTO zones VALUES (280, 222, 'Western Isles', 'Western Isles');
INSERT INTO zones VALUES (281, 222, 'Wiltshire', 'Wiltshire');
INSERT INTO zones VALUES (282, 222, 'Worcestershire', 'Worcestershire');
INSERT INTO zones VALUES (283, 222, 'Wrexham', 'Wrexham');

