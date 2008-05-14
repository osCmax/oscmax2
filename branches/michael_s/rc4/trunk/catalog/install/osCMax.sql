# osCMax Power E-Commerce
# http://oscdox.com
#
# Default Database For osCMax v2.0 RC4
# Copyright (c) 2008 osCMax
#
# Database: osCMax v2.0 RC4
#

DROP TABLE IF EXISTS address_book;
CREATE TABLE address_book (
  address_book_id int(11) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default '0',
  entry_gender char(1) NOT NULL,
  entry_company varchar(32) default NULL,
  entry_company_tax_id varchar(32) default NULL,
  entry_firstname varchar(32) NOT NULL,
  entry_lastname varchar(32) NOT NULL,
  entry_street_address varchar(64) NOT NULL,
  entry_suburb varchar(32) default NULL,
  entry_postcode varchar(10) NOT NULL,
  entry_city varchar(32) NOT NULL,
  entry_state varchar(32) default NULL,
  entry_country_id int(11) NOT NULL default '0',
  entry_zone_id int(11) NOT NULL default '0',
  PRIMARY KEY  (address_book_id),
  KEY idx_address_book_customers_id (customers_id)
) TYPE=MyISAM ;


DROP TABLE IF EXISTS address_format;
CREATE TABLE address_format (
  address_format_id int(11) NOT NULL auto_increment,
  address_format varchar(128) NOT NULL,
  address_summary varchar(48) NOT NULL,
  PRIMARY KEY  (address_format_id)
) TYPE=MyISAM ;


INSERT INTO address_format (address_format_id, address_format, address_summary) VALUES(1, '$firstname $lastname$cr$streets$cr$city, $postcode$cr$statecomma$country', '$city / $country');
INSERT INTO address_format (address_format_id, address_format, address_summary) VALUES(2, '$firstname $lastname$cr$streets$cr$city, $state    $postcode$cr$country', '$city, $state / $country');
INSERT INTO address_format (address_format_id, address_format, address_summary) VALUES(3, '$firstname $lastname$cr$streets$cr$city$cr$postcode - $statecomma$country', '$state / $country');
INSERT INTO address_format (address_format_id, address_format, address_summary) VALUES(4, '$firstname $lastname$cr$streets$cr$city ($postcode)$cr$country', '$postcode / $country');
INSERT INTO address_format (address_format_id, address_format, address_summary) VALUES(5, '$firstname $lastname$cr$streets$cr$postcode $city$cr$country', '$city / $country');
DROP TABLE IF EXISTS admin;
CREATE TABLE admin (
  admin_id int(11) NOT NULL auto_increment,
  admin_groups_id int(11) default NULL,
  admin_firstname varchar(32) NOT NULL,
  admin_lastname varchar(32) default NULL,
  admin_email_address varchar(96) NOT NULL,
  admin_password varchar(40) NOT NULL,
  admin_created datetime default NULL,
  admin_modified datetime NOT NULL default '0000-00-00 00:00:00',
  admin_logdate datetime default NULL,
  admin_lognum int(11) NOT NULL default '0',
  PRIMARY KEY  (admin_id),
  UNIQUE KEY admin_email_address (admin_email_address)
) TYPE=MyISAM ;

INSERT INTO admin (admin_id, admin_groups_id, admin_firstname, admin_lastname, admin_email_address, admin_password, admin_created, admin_modified, admin_logdate, admin_lognum) VALUES(1, 1, 'Default', 'Admin', 'admin@localhost.com', '05cdeb1aeaffec1c7ae3f12c570a658c:81', '2003-07-17 11:35:03', '2003-08-02 19:43:11', '2008-05-03 22:48:41', 28);
DROP TABLE IF EXISTS admin_files;
CREATE TABLE admin_files (
  admin_files_id int(11) NOT NULL auto_increment,
  admin_files_name varchar(64) NOT NULL,
  admin_files_is_boxes tinyint(5) NOT NULL default '0',
  admin_files_to_boxes int(11) NOT NULL default '0',
  admin_groups_id set('1','2') NOT NULL default '1',
  PRIMARY KEY  (admin_files_id)
) TYPE=MyISAM ;


INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(1, 'administrator.php', 1, 0, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(2, 'configuration.php', 1, 0, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(3, 'catalog.php', 1, 0, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(4, 'modules.php', 1, 0, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(5, 'customers.php', 1, 0, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(6, 'taxes.php', 1, 0, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(7, 'localization.php', 1, 0, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(8, 'reports.php', 1, 0, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(9, 'tools.php', 1, 0, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(10, 'admin_members.php', 0, 1, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(11, 'admin_files.php', 0, 1, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(12, 'configuration.php', 0, 2, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(13, 'categories.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(14, 'products_attributes.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(15, 'manufacturers.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(16, 'reviews.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(17, 'specials.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(18, 'products_expected.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(19, 'modules.php', 0, 4, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(20, 'customers.php', 0, 5, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(79, 'orders.php', 0, 5, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(22, 'countries.php', 0, 6, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(23, 'zones.php', 0, 6, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(24, 'geo_zones.php', 0, 6, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(25, 'tax_classes.php', 0, 6, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(26, 'tax_rates.php', 0, 6, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(27, 'currencies.php', 0, 7, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(28, 'languages.php', 0, 7, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(29, 'orders_status.php', 0, 7, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(30, 'stats_products_viewed.php', 0, 8, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(31, 'stats_products_purchased.php', 0, 8, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(32, 'stats_customers.php', 0, 8, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(33, 'backup.php', 0, 9, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(34, 'banner_manager.php', 0, 9, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(35, 'cache.php', 0, 9, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(36, 'define_language.php', 0, 9, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(37, 'file_manager.php', 0, 9, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(38, 'mail.php', 0, 9, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(39, 'newsletters.php', 0, 9, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(40, 'server_info.php', 0, 9, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(41, 'whos_online.php', 0, 9, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(42, 'banner_statistics.php', 0, 9, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(43, 'affiliate.php', 1, 0, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(44, 'affiliate_affiliates.php', 0, 43, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(45, 'affiliate_clicks.php', 0, 43, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(46, 'affiliate_banners.php', 0, 43, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(47, 'affiliate_contact.php', 0, 43, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(48, 'affiliate_invoice.php', 0, 43, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(49, 'affiliate_payment.php', 0, 43, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(50, 'affiliate_popup_image.php', 0, 43, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(51, 'affiliate_sales.php', 0, 43, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(52, 'affiliate_statistics.php', 0, 43, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(53, 'affiliate_summary.php', 0, 43, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(54, 'gv_admin.php', 1, 0, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(55, 'coupon_admin.php', 0, 54, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(56, 'gv_queue.php', 0, 54, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(57, 'gv_mail.php', 0, 54, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(58, 'gv_sent.php', 0, 54, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(59, 'paypalipn.php', 1, 0, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(60, 'paypalipn_tests.php', 0, 59, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(61, 'paypalipn_txn.php', 0, 59, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(62, 'coupon_restrict.php', 0, 54, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(64, 'xsell_products.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(65, 'easypopulate.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(68, 'define_mainpage.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(70, 'edit_orders.php', 0, 5, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(71, 'validproducts.php', 0, 54, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(72, 'validcategories.php', 0, 54, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(73, 'listcategories.php', 0, 54, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(74, 'listproducts.php', 0, 54, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(75, 'new_attributes.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(80, 'paypal_ipn_order.php', 0, 5, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(78, 'paypal_ipn.php', 0, 5, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(81, 'articles.php', 1, 0, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(82, 'article_reviews.php', 0, 81, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(83, 'articles.php', 0, 81, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(84, 'articles_config.php', 0, 81, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(85, 'articles_xsell.php', 0, 81, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(86, 'authors.php', 0, 81, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(87, 'recover_cart_sales.php', 0, 8, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(88, 'stats_recover_cart_sales.php', 0, 8, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(89, 'stats_monthly_sales.php', 0, 8, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(90, 'batch_print.php', 0, 9, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(91, 'stock.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(92, 'stats_low_stock_attrib.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(93, 'info_boxes.php', 1, 0, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(94, 'infobox_configuration.php', 0, 93, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(95, 'popup_infobox_help.php', 0, 93, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(98, 'customers_groups.php', 0, 5, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(99, 'define_conditions.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(100, 'define_privacy.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(101, 'define_shipping.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(102, 'xsell.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(103, 'create_account.php', 0, 5, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(104, 'create_account_process.php', 0, 5, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(105, 'create_account_success.php', 0, 5, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(106, 'create_order.php', 0, 5, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(107, 'create_order_process.php', 0, 5, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(108, 'easypopulate_functions.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(109, 'new_attributes_change.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(110, 'new_attributes_config.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(111, 'new_attributes_functions.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(112, 'new_attributes_include.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(113, 'new_attributes_select.php', 0, 3, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(114, 'ship_fedex.php', 0, 8, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(115, 'fedex_popup.php', 0, 8, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(116, 'shipping_manifest.php', 0, 8, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(117, 'track_fedex.php', 0, 8, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(118, 'paypal_info.php', 0, 1, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(119, 'affiliate_info.php', 0, 1, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(120, 'domain_info.php', 0, 1, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(121, 'hosting_info.php', 0, 1, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(122, 'merchant_info.php', 0, 1, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(123, 'ssl_info.php', 0, 1, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(124, 'affiliate_news.php', 0, 43, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(125, 'affiliate_newsletters.php', 0, 43, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(126, 'affiliate_validcats.php', 0, 43, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(127, 'affiliate_validproducts.php', 0, 43, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(128, 'edit_orders_add_product.php', 0, 5, '1');
INSERT INTO admin_files (admin_files_id, admin_files_name, admin_files_is_boxes, admin_files_to_boxes, admin_groups_id) VALUES(129, 'edit_orders_ajax.php', 0, 5, '1');
DROP TABLE IF EXISTS admin_groups;
CREATE TABLE admin_groups (
  admin_groups_id int(11) NOT NULL auto_increment,
  admin_groups_name varchar(64) default NULL,
  PRIMARY KEY  (admin_groups_id),
  UNIQUE KEY admin_groups_name (admin_groups_name)
) TYPE=MyISAM ;


INSERT INTO admin_groups (admin_groups_id, admin_groups_name) VALUES(1, 'Top Administrator');
INSERT INTO admin_groups (admin_groups_id, admin_groups_name) VALUES(2, 'Marketing');
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
  affiliate_commission_percent decimal(4,2) NOT NULL default '0.00',
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
  PRIMARY KEY  (affiliate_id)
) TYPE=MyISAM ;


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
  PRIMARY KEY  (affiliate_banners_id)
) TYPE=MyISAM ;


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
) TYPE=MyISAM ;


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
) TYPE=MyISAM ;


DROP TABLE IF EXISTS affiliate_news;
CREATE TABLE affiliate_news (
  news_id int(11) NOT NULL auto_increment,
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  news_status tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (news_id)
) TYPE=MyISAM ;
DROP TABLE IF EXISTS affiliate_newsletters;
CREATE TABLE affiliate_newsletters (
  affiliate_newsletters_id int(11) NOT NULL auto_increment,
  title varchar(255) NOT NULL default '',
  content text NOT NULL,
  module varchar(255) NOT NULL default '',
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  date_sent datetime default NULL,
  `status` int(1) default NULL,
  locked int(1) default '0',
  PRIMARY KEY  (affiliate_newsletters_id)
) TYPE=MyISAM ;
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
) TYPE=MyISAM ;
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
) TYPE=MyISAM;


DROP TABLE IF EXISTS affiliate_payment_status;
CREATE TABLE affiliate_payment_status (
  affiliate_payment_status_id int(11) NOT NULL default '0',
  affiliate_language_id int(11) NOT NULL default '1',
  affiliate_payment_status_name varchar(32) NOT NULL default '',
  PRIMARY KEY  (affiliate_payment_status_id,affiliate_language_id),
  KEY idx_affiliate_payment_status_name (affiliate_payment_status_name)
) TYPE=MyISAM;


INSERT INTO affiliate_payment_status (affiliate_payment_status_id, affiliate_language_id, affiliate_payment_status_name) VALUES(0, 1, 'Pending');
INSERT INTO affiliate_payment_status (affiliate_payment_status_id, affiliate_language_id, affiliate_payment_status_name) VALUES(1, 1, 'Paid');
DROP TABLE IF EXISTS affiliate_payment_status_history;
CREATE TABLE affiliate_payment_status_history (
  affiliate_status_history_id int(11) NOT NULL auto_increment,
  affiliate_payment_id int(11) NOT NULL default '0',
  affiliate_new_value int(5) NOT NULL default '0',
  affiliate_old_value int(5) default NULL,
  affiliate_date_added datetime NOT NULL default '0000-00-00 00:00:00',
  affiliate_notified int(1) default '0',
  PRIMARY KEY  (affiliate_status_history_id)
) TYPE=MyISAM;


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
  PRIMARY KEY  (affiliate_orders_id,affiliate_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS articles;
CREATE TABLE articles (
  articles_id int(11) NOT NULL auto_increment,
  articles_date_added datetime NOT NULL default '0000-00-00 00:00:00',
  articles_last_modified datetime default NULL,
  articles_date_available datetime default NULL,
  articles_status tinyint(1) NOT NULL default '0',
  authors_id int(11) default NULL,
  PRIMARY KEY  (articles_id),
  KEY idx_articles_date_added (articles_date_added)
) TYPE=MyISAM ;


DROP TABLE IF EXISTS articles_description;
CREATE TABLE articles_description (
  articles_id int(11) NOT NULL auto_increment,
  language_id int(11) NOT NULL default '1',
  articles_name varchar(64) NOT NULL,
  articles_description text,
  articles_url varchar(255) default NULL,
  articles_viewed int(5) default '0',
  articles_head_title_tag varchar(80) default NULL,
  articles_head_desc_tag text,
  articles_head_keywords_tag text,
  PRIMARY KEY  (articles_id,language_id),
  KEY articles_name (articles_name)
) TYPE=MyISAM ;


DROP TABLE IF EXISTS articles_to_topics;
CREATE TABLE articles_to_topics (
  articles_id int(11) NOT NULL default '0',
  topics_id int(11) NOT NULL default '0',
  PRIMARY KEY  (articles_id,topics_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS articles_xsell;
CREATE TABLE articles_xsell (
  ID int(10) NOT NULL auto_increment,
  articles_id int(10) unsigned NOT NULL default '1',
  xsell_id int(10) unsigned NOT NULL default '1',
  sort_order int(10) unsigned NOT NULL default '1',
  PRIMARY KEY  (ID)
) TYPE=MyISAM;


DROP TABLE IF EXISTS article_reviews;
CREATE TABLE article_reviews (
  reviews_id int(11) NOT NULL auto_increment,
  articles_id int(11) NOT NULL default '0',
  customers_id int(11) default NULL,
  customers_name varchar(64) NOT NULL,
  reviews_rating int(1) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  reviews_read int(5) NOT NULL default '0',
  approved tinyint(3) unsigned default '0',
  PRIMARY KEY  (reviews_id)
) TYPE=MyISAM;
DROP TABLE IF EXISTS article_reviews_description;
CREATE TABLE article_reviews_description (
  reviews_id int(11) NOT NULL default '0',
  languages_id int(11) NOT NULL default '0',
  reviews_text text NOT NULL,
  PRIMARY KEY  (reviews_id,languages_id)
) TYPE=MyISAM;
DROP TABLE IF EXISTS authors;
CREATE TABLE authors (
  authors_id int(11) NOT NULL auto_increment,
  authors_name varchar(32) NOT NULL,
  authors_image varchar(64) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  PRIMARY KEY  (authors_id),
  KEY IDX_AUTHORS_NAME (authors_name)
) TYPE=MyISAM ;


DROP TABLE IF EXISTS authors_info;
CREATE TABLE authors_info (
  authors_id int(11) NOT NULL default '0',
  languages_id int(11) NOT NULL default '0',
  authors_description text,
  authors_url varchar(255) NOT NULL,
  url_clicked int(5) NOT NULL default '0',
  date_last_click datetime default NULL,
  PRIMARY KEY  (authors_id,languages_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS banners;
CREATE TABLE banners (
  banners_id int(11) NOT NULL auto_increment,
  banners_title varchar(64) NOT NULL,
  banners_url varchar(255) NOT NULL,
  banners_image varchar(64) NOT NULL,
  banners_group varchar(10) NOT NULL,
  banners_html_text text,
  expires_impressions int(7) default '0',
  expires_date datetime default NULL,
  date_scheduled datetime default NULL,
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  date_status_change datetime default NULL,
  `status` int(1) NOT NULL default '1',
  PRIMARY KEY  (banners_id),
  KEY idx_banners_group (banners_group)
) TYPE=MyISAM;


DROP TABLE IF EXISTS banners_history;
CREATE TABLE banners_history (
  banners_history_id int(11) NOT NULL auto_increment,
  banners_id int(11) NOT NULL default '0',
  banners_shown int(5) NOT NULL default '0',
  banners_clicked int(5) NOT NULL default '0',
  banners_history_date datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (banners_history_id),
  KEY idx_banners_history_banners_id (banners_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS cache;
CREATE TABLE `cache` (
  cache_id varchar(32) NOT NULL,
  cache_language_id tinyint(1) NOT NULL default '0',
  cache_name varchar(255) NOT NULL,
  cache_data mediumtext NOT NULL,
  cache_global tinyint(1) NOT NULL default '1',
  cache_gzip tinyint(1) NOT NULL default '1',
  cache_method varchar(20) NOT NULL default 'RETURN',
  cache_date datetime NOT NULL default '0000-00-00 00:00:00',
  cache_expires datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (cache_id,cache_language_id),
  KEY cache_id (cache_id),
  KEY cache_language_id (cache_language_id),
  KEY cache_global (cache_global)
) TYPE=MyISAM;


DROP TABLE IF EXISTS categories;
CREATE TABLE categories (
  categories_id int(11) NOT NULL auto_increment,
  categories_image varchar(64) default NULL,
  parent_id int(11) NOT NULL default '0',
  sort_order int(3) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  PRIMARY KEY  (categories_id),
  KEY idx_categories_parent_id (parent_id)
) TYPE=MyISAM ;


DROP TABLE IF EXISTS categories_description;
CREATE TABLE categories_description (
  categories_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '1',
  categories_name varchar(32) NOT NULL,
  categories_heading_title varchar(64) default NULL,
  categories_description text,
  PRIMARY KEY  (categories_id,language_id),
  KEY idx_categories_name (categories_name)
) TYPE=MyISAM;


DROP TABLE IF EXISTS configuration;
CREATE TABLE configuration (
  configuration_id int(11) NOT NULL auto_increment,
  configuration_title varchar(255) NOT NULL,
  configuration_key varchar(255) NOT NULL,
  configuration_value text NOT NULL,
  configuration_description varchar(255) NOT NULL,
  configuration_group_id int(11) NOT NULL default '0',
  sort_order int(5) default NULL,
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '1900-05-05 11:00:00',
  use_function varchar(255) default NULL,
  set_function text,
  PRIMARY KEY  (configuration_id)
) TYPE=MyISAM ;


INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1, 'Store Name', 'STORE_NAME', 'Store Name', 'The name of my store', 1, 1, '2004-05-05 08:40:17', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(2, 'Store Owner', 'STORE_OWNER', 'Owners Name', 'The name of my store owner', 1, 2, '2004-05-05 08:40:34', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(3, 'E-Mail Address', 'STORE_OWNER_EMAIL_ADDRESS', 'your@email.com', 'The e-mail address of my store owner', 1, 3, '2004-05-05 08:43:13', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(4, 'E-Mail From', 'EMAIL_FROM', 'Your Mail <admin@yourshop.com>', 'The e-mail address used in (sent) e-mails', 1, 4, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(5, 'Country', 'STORE_COUNTRY', '223', 'The country my store is located in <br><br><b>Note: Please remember to update the store zone.</b>', 1, 6, '2008-04-12 22:04:26', '2003-07-17 10:29:22', 'tep_get_country_name', 'tep_cfg_pull_down_country_list(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(6, 'Zone', 'STORE_ZONE', '4', 'The zone my store is located in', 1, 7, '2003-09-12 09:51:09', '2003-07-17 10:29:22', 'tep_cfg_get_zone_name', 'tep_cfg_pull_down_zone_list(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(7, 'Expected Sort Order', 'EXPECTED_PRODUCTS_SORT', 'desc', 'This is the sort order used in the expected products box.', 1, 8, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''asc'', ''desc''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(8, 'Expected Sort Field', 'EXPECTED_PRODUCTS_FIELD', 'date_expected', 'The column to sort by in the expected products box.', 1, 9, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''products_name'', ''date_expected''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(9, 'Switch To Default Language Currency', 'USE_DEFAULT_LANGUAGE_CURRENCY', 'false', 'Automatically switch to the language''s currency when it is changed', 1, 10, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(10, 'Send Extra Order Emails To', 'SEND_EXTRA_ORDER_EMAILS_TO', '', 'Send extra order emails to the following email addresses, in this format: Name 1 &lt;email@address1&gt;, Name 2 &lt;email@address2&gt;', 1, 11, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(11, 'Use Search-Engine Safe URLs (still in development)', 'SEARCH_ENGINE_FRIENDLY_URLS', 'false', 'Use search-engine safe urls for all site links', 1, 12, '2003-08-06 03:41:57', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(12, 'Display Cart After Adding Product', 'DISPLAY_CART', 'true', 'Display the shopping cart after adding a product (or return back to their origin)', 1, 14, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(13, 'Allow Guest To Tell A Friend', 'ALLOW_GUEST_TO_TELL_A_FRIEND', 'false', 'Allow guests to tell a friend about a product', 1, 15, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(14, 'Default Search Operator', 'ADVANCED_SEARCH_DEFAULT_OPERATOR', 'and', 'Default search operators', 1, 17, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''and'', ''or''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(15, 'Store Address and Phone', 'STORE_NAME_ADDRESS', '5000 E Anystreet 555-555-5555', 'This is the Store Name, Address and Phone used on printable documents and displayed online', 1, 18, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_textarea(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(16, 'Show Category Counts', 'SHOW_COUNTS', 'false', 'Count recursively how many products are in each category', 1, 19, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(17, 'Tax Decimal Places', 'TAX_DECIMAL_PLACES', '2', 'Pad the tax value this amount of decimal places', 1, 20, '2005-04-23 23:16:49', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(18, 'Display Prices with Tax', 'DISPLAY_PRICE_WITH_TAX', 'true', 'Display prices with tax included (true) or add the tax at the end (false)', 1, 21, '2005-07-21 19:06:37', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(19, 'First Name', 'ENTRY_FIRST_NAME_MIN_LENGTH', '2', 'Minimum length of first name', 2, 1, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(20, 'Last Name', 'ENTRY_LAST_NAME_MIN_LENGTH', '2', 'Minimum length of last name', 2, 2, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(21, 'Date of Birth', 'ENTRY_DOB_MIN_LENGTH', '10', 'Minimum length of date of birth', 2, 3, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(22, 'E-Mail Address', 'ENTRY_EMAIL_ADDRESS_MIN_LENGTH', '6', 'Minimum length of e-mail address', 2, 4, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(23, 'Street Address', 'ENTRY_STREET_ADDRESS_MIN_LENGTH', '5', 'Minimum length of street address', 2, 5, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(24, 'Company', 'ENTRY_COMPANY_MIN_LENGTH', '2', 'Minimum length of company name', 2, 6, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(25, 'Post Code', 'ENTRY_POSTCODE_MIN_LENGTH', '4', 'Minimum length of post code', 2, 7, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(26, 'City', 'ENTRY_CITY_MIN_LENGTH', '3', 'Minimum length of city', 2, 8, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(27, 'State', 'ENTRY_STATE_MIN_LENGTH', '2', 'Minimum length of state', 2, 9, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(28, 'Telephone Number', 'ENTRY_TELEPHONE_MIN_LENGTH', '3', 'Minimum length of telephone number', 2, 10, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(29, 'Password', 'ENTRY_PASSWORD_MIN_LENGTH', '5', 'Minimum length of password', 2, 11, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(30, 'Credit Card Owner Name', 'CC_OWNER_MIN_LENGTH', '3', 'Minimum length of credit card owner name', 2, 12, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(31, 'Credit Card Number', 'CC_NUMBER_MIN_LENGTH', '10', 'Minimum length of credit card number', 2, 13, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(32, 'Review Text', 'REVIEW_TEXT_MIN_LENGTH', '50', 'Minimum length of review text', 2, 14, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(33, 'Best Sellers', 'MIN_DISPLAY_BESTSELLERS', '1', 'Minimum number of best sellers to display', 2, 15, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(34, 'Also Purchased', 'MIN_DISPLAY_ALSO_PURCHASED', '1', 'Minimum number of products to display in the ''This Customer Also Purchased'' box', 2, 16, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(35, 'Address Book Entries', 'MAX_ADDRESS_BOOK_ENTRIES', '5', 'Maximum address book entries a customer is allowed to have', 3, 1, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(36, 'Search Results', 'MAX_DISPLAY_SEARCH_RESULTS', '10', 'Amount of products to list', 3, 2, '2003-08-06 12:35:41', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(37, 'Page Links', 'MAX_DISPLAY_PAGE_LINKS', '5', 'Number of ''number'' links use for page-sets', 3, 3, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(38, 'Special Products', 'MAX_DISPLAY_SPECIAL_PRODUCTS', '9', 'Maximum number of products on special to display', 3, 4, '2005-08-03 19:54:19', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(39, 'New Products Module', 'MAX_DISPLAY_NEW_PRODUCTS', '3', 'Maximum number of new products to display in a category', 3, 5, '2003-08-06 12:35:10', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(40, 'Products Expected', 'MAX_DISPLAY_UPCOMING_PRODUCTS', '3', 'Maximum number of products expected to display', 3, 6, '2003-08-06 12:36:07', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(41, 'Manufacturers List', 'MAX_DISPLAY_MANUFACTURERS_IN_A_LIST', '0', 'Used in manufacturers box; when the number of manufacturers exceeds this number, a drop-down list will be displayed instead of the default list', 3, 7, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(42, 'Manufacturers Select Size', 'MAX_MANUFACTURERS_LIST', '1', 'Used in manufacturers box; when this value is ''1'' the classic drop-down list will be used for the manufacturers box. Otherwise, a list-box with the specified number of rows will be displayed.', 3, 7, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(43, 'Length of Manufacturers Name', 'MAX_DISPLAY_MANUFACTURER_NAME_LEN', '15', 'Used in manufacturers box; maximum length of manufacturers name to display', 3, 8, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(44, 'New Reviews', 'MAX_DISPLAY_NEW_REVIEWS', '6', 'Maximum number of new reviews to display', 3, 9, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(45, 'Selection of Random Reviews', 'MAX_RANDOM_SELECT_REVIEWS', '10', 'How many records to select from to choose one random product review', 3, 10, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(46, 'Selection of Random New Products', 'MAX_RANDOM_SELECT_NEW', '10', 'How many records to select from to choose one random new product to display', 3, 11, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(47, 'Selection of Products on Special', 'MAX_RANDOM_SELECT_SPECIALS', '10', 'How many records to select from to choose one random product special to display', 3, 12, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(48, 'Categories To List Per Row', 'MAX_DISPLAY_CATEGORIES_PER_ROW', '3', 'How many categories to list per row', 3, 13, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(49, 'New Products Listing', 'MAX_DISPLAY_PRODUCTS_NEW', '10', 'Maximum number of new products to display in new products page', 3, 14, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(50, 'Best Sellers', 'MAX_DISPLAY_BESTSELLERS', '10', 'Maximum number of best sellers to display', 3, 15, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(51, 'Also Purchased', 'MAX_DISPLAY_ALSO_PURCHASED', '6', 'Maximum number of products to display in the ''This Customer Also Purchased'' box', 3, 16, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(52, 'Customer Order History Box', 'MAX_DISPLAY_PRODUCTS_IN_ORDER_HISTORY_BOX', '6', 'Maximum number of products to display in the customer order history box', 3, 17, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(53, 'Order History', 'MAX_DISPLAY_ORDER_HISTORY', '10', 'Maximum number of orders to display in the order history page', 3, 18, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(54, 'Small Image Width', 'SMALL_IMAGE_WIDTH', '100', 'The pixel width of small images', 4, 1, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(55, 'Small Image Height', 'SMALL_IMAGE_HEIGHT', '', 'The pixel height of small images', 4, 2, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(56, 'Heading Image Width', 'HEADING_IMAGE_WIDTH', '57', 'The pixel width of heading images', 4, 3, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(57, 'Heading Image Height', 'HEADING_IMAGE_HEIGHT', '', 'The pixel height of heading images', 4, 4, '2005-05-13 20:23:37', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(58, 'Subcategory Image Width', 'SUBCATEGORY_IMAGE_WIDTH', '100', 'The pixel width of subcategory images', 4, 5, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(59, 'Subcategory Image Height', 'SUBCATEGORY_IMAGE_HEIGHT', '', 'The pixel height of subcategory images', 4, 6, '2005-05-13 20:23:31', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(60, 'Calculate Image Size', 'CONFIG_CALCULATE_IMAGE_SIZE', 'true', 'Calculate the size of images?', 4, 7, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(61, 'Image Required', 'IMAGE_REQUIRED', 'true', 'Enable to display broken images. Good for development.', 4, 8, '2005-09-18 12:00:20', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(62, 'Gender', 'ACCOUNT_GENDER', 'false', 'Display gender in the customers account', 5, 1, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(63, 'Date of Birth', 'ACCOUNT_DOB', 'false', 'Display date of birth in the customers account', 5, 2, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(64, 'Company', 'ACCOUNT_COMPANY', 'false', 'Display company in the customers account', 5, 3, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(65, 'Suburb', 'ACCOUNT_SUBURB', 'false', 'Display suburb in the customers account', 5, 4, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(66, 'State', 'ACCOUNT_STATE', 'true', 'Display state in the customers account', 5, 5, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(67, 'Installed Modules', 'MODULE_PAYMENT_INSTALLED', 'cc.php;googlecheckout.php;paypal_direct.php;paypal_express.php', 'List of payment module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: cc.php;cod.php;paypal.php)', 6, 0, '2008-05-03 22:50:07', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(68, 'Installed Modules', 'MODULE_ORDER_TOTAL_INSTALLED', 'ot_subtotal.php;ot_shipping.php;ot_tax.php;ot_loyalty_discount.php;ot_loworderfee.php;ot_coupon.php;ot_gv.php;ot_total.php', 'List of order_total module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ot_subtotal.php;ot_tax.php;ot_shipping.php;ot_total.php)', 6, 0, '2005-03-30 14:15:00', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(69, 'Installed Modules', 'MODULE_SHIPPING_INSTALLED', 'flat.php', 'List of shipping module filenames separated by a semi-colon. This is automatically updated. No need to edit. (Example: ups.php;flat.php;item.php)', 6, 0, '2005-09-18 11:05:24', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(498, 'Purchase Without Account', 'PWA_ON', 'false', 'Allow Customers to purchase without an account', 40, 1, '2008-05-03 23:15:17', '2003-04-08 12:10:51', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(84, 'Default Currency', 'DEFAULT_CURRENCY', 'USD', 'Default Currency', 6, 0, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(85, 'Default Language', 'DEFAULT_LANGUAGE', 'en', 'Default Language', 6, 0, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(86, 'Default Order Status For New Orders', 'DEFAULT_ORDERS_STATUS_ID', '1', 'When a new order is created, this order status will be assigned to it.', 6, 0, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(87, 'Display Shipping', 'MODULE_ORDER_TOTAL_SHIPPING_STATUS', 'true', 'Do you want to display the order shipping cost?', 6, 1, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(88, 'Sort Order', 'MODULE_ORDER_TOTAL_SHIPPING_SORT_ORDER', '2', 'Sort order of display.', 6, 2, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(89, 'Allow Free Shipping', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING', 'false', 'Do you want to allow free shipping?', 6, 3, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(90, 'Free Shipping For Orders Over', 'MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER', '5', 'Provide free shipping for orders over the set amount.', 6, 4, NULL, '2003-07-17 10:29:22', 'currencies->format', NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(91, 'Provide Free Shipping For Orders Made', 'MODULE_ORDER_TOTAL_SHIPPING_DESTINATION', 'national', 'Provide free shipping for orders sent to the set destination.', 6, 5, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''national'', ''international'', ''both''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(92, 'Display Sub-Total', 'MODULE_ORDER_TOTAL_SUBTOTAL_STATUS', 'true', 'Do you want to display the order sub-total cost?', 6, 1, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(93, 'Sort Order', 'MODULE_ORDER_TOTAL_SUBTOTAL_SORT_ORDER', '1', 'Sort order of display.', 6, 2, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(454, 'Sort Order', 'MODULE_ORDER_TOTAL_TAX_SORT_ORDER', '3', 'Sort order of display.', 6, 2, NULL, '2003-11-11 21:46:37', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(453, 'Display Tax', 'MODULE_ORDER_TOTAL_TAX_STATUS', 'true', 'Do you want to display the order tax value?', 6, 1, NULL, '2003-11-11 21:46:37', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(96, 'Display Total', 'MODULE_ORDER_TOTAL_TOTAL_STATUS', 'true', 'Do you want to display the total order value?', 6, 1, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(97, 'Sort Order', 'MODULE_ORDER_TOTAL_TOTAL_SORT_ORDER', '800', 'Sort order of display.', 6, 2, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(98, 'Country of Origin', 'SHIPPING_ORIGIN_COUNTRY', '223', 'Select the country of origin to be used in shipping quotes.', 7, 1, NULL, '2003-07-17 10:29:22', 'tep_get_country_name', 'tep_cfg_pull_down_country_list(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(99, 'Postal Code', 'SHIPPING_ORIGIN_ZIP', '85014', 'Enter the Postal Code (ZIP) of the Store to be used in shipping quotes.', 7, 2, '2005-08-03 21:28:19', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(100, 'Enter the Maximum Package Weight you will ship', 'SHIPPING_MAX_WEIGHT', '50', 'Carriers have a max weight limit for a single package. This is a common one for all.', 7, 3, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(101, 'Package Tare weight.', 'SHIPPING_BOX_WEIGHT', '1', 'What is the weight of typical packaging of small to medium packages?', 7, 4, '2003-07-29 15:06:50', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(102, 'Larger packages - percentage increase.', 'SHIPPING_BOX_PADDING', '10', 'For 10% enter 10', 7, 5, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(103, 'Display Product Image', 'PRODUCT_LIST_IMAGE', '1', 'Do you want to display the Product Image?', 8, 1, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(104, 'Display Product Manufaturer Name', 'PRODUCT_LIST_MANUFACTURER', '0', 'Do you want to display the Product Manufacturer Name?', 8, 2, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(105, 'Display Product Model', 'PRODUCT_LIST_MODEL', '0', 'Do you want to display the Product Model?', 8, 3, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(106, 'Display Product Name', 'PRODUCT_LIST_NAME', '2', 'Do you want to display the Product Name?', 8, 4, '2003-09-08 23:04:04', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(107, 'Display Product Price', 'PRODUCT_LIST_PRICE', '3', 'Do you want to display the Product Price', 8, 5, '2005-02-15 22:35:28', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(108, 'Display Product Quantity', 'PRODUCT_LIST_QUANTITY', '0', 'Do you want to display the Product Quantity?', 8, 6, '2005-02-15 22:35:18', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(109, 'Display Product Weight', 'PRODUCT_LIST_WEIGHT', '0', 'Do you want to display the Product Weight?', 8, 7, '2003-09-12 23:17:48', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(110, 'Display Buy Now column', 'PRODUCT_LIST_BUY_NOW', '4', 'Do you want to display the Buy Now column?', 8, 8, '2003-09-08 23:04:54', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(111, 'Display Category/Manufacturer Filter (0=disable; 1=enable)', 'PRODUCT_LIST_FILTER', '1', 'Do you want to display the Category/Manufacturer Filter?', 8, 9, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(112, 'Location of Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)', 'PREV_NEXT_BAR_LOCATION', '2', 'Sets the location of the Prev/Next Navigation Bar (1-top, 2-bottom, 3-both)', 8, 10, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(113, 'Check stock level', 'STOCK_CHECK', 'true', 'Check to see if sufficent stock is available', 9, 1, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(114, 'Subtract stock', 'STOCK_LIMITED', 'true', 'Subtract product in stock by product orders', 9, 2, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(115, 'Allow Checkout', 'STOCK_ALLOW_CHECKOUT', 'true', 'Allow customer to checkout even if there is insufficient stock', 9, 3, '2005-02-15 22:32:31', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(116, 'Mark product out of stock', 'STOCK_MARK_PRODUCT_OUT_OF_STOCK', '***', 'Display something on screen so customer can see which product has insufficient stock', 9, 4, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(117, 'Stock Re-order level', 'STOCK_REORDER_LEVEL', '5', 'Define when stock needs to be re-ordered', 9, 5, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(118, 'Store Page Parse Time', 'STORE_PAGE_PARSE_TIME', 'false', 'Store the time it takes to parse a page', 10, 1, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(119, 'Log Destination', 'STORE_PAGE_PARSE_TIME_LOG', '/var/log/www/tep/page_parse_time.log', 'Directory and filename of the page parse time log', 10, 2, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(120, 'Log Date Format', 'STORE_PARSE_DATE_TIME_FORMAT', '%d/%m/%Y %H:%M:%S', 'The date format', 10, 3, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(121, 'Display The Page Parse Time', 'DISPLAY_PAGE_PARSE_TIME', 'false', 'Display the page parse time (store page parse time must be enabled)', 10, 4, '2005-09-18 10:18:50', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(122, 'Store Database Queries', 'STORE_DB_TRANSACTIONS', 'false', 'Store the database queries in the page parse time log (PHP4 only)', 10, 5, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(123, 'Use Cache', 'USE_CACHE', 'false', 'Use caching features', 11, 1, '2005-05-13 20:21:40', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(124, 'Cache Directory', 'DIR_FS_CACHE', '', 'The directory where the cached files are saved', 11, 2, '2005-05-13 20:21:47', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(125, 'E-Mail Transport Method', 'EMAIL_TRANSPORT', 'sendmail', 'Defines if this server uses a local connection to sendmail or uses an SMTP connection via TCP/IP. Servers running on Windows and MacOS should change this setting to SMTP.', 12, 1, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''sendmail'', ''smtp''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(126, 'E-Mail Linefeeds', 'EMAIL_LINEFEED', 'LF', 'Defines the character sequence used to separate mail headers.', 12, 2, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''LF'', ''CRLF''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(127, 'Use MIME HTML When Sending Emails', 'EMAIL_USE_HTML', 'false', 'Send e-mails in HTML format', 12, 3, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(128, 'Verify E-Mail Addresses Through DNS', 'ENTRY_EMAIL_ADDRESS_CHECK', 'false', 'Verify e-mail address through a DNS server', 12, 4, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(129, 'Send E-Mails', 'SEND_EMAILS', 'true', 'Send out e-mails', 12, 5, '2005-09-18 10:19:06', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(130, 'Enable download', 'DOWNLOAD_ENABLED', 'true', 'Enable the products download functions.', 13, 1, '2003-07-29 15:38:22', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(131, 'Download by redirect', 'DOWNLOAD_BY_REDIRECT', 'true', 'Use browser redirection for download. Disable on non-Unix systems.', 13, 2, '2005-05-13 20:20:53', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(132, 'Expiry delay (days)', 'DOWNLOAD_MAX_DAYS', '7', 'Set number of days before the download link expires. 0 means no limit.', 13, 3, NULL, '2003-07-17 10:29:22', NULL, '');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(133, 'Maximum number of downloads', 'DOWNLOAD_MAX_COUNT', '5', 'Set the maximum number of downloads. 0 means no download authorized.', 13, 4, NULL, '2003-07-17 10:29:22', NULL, '');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(134, 'Enable GZip Compression', 'GZIP_COMPRESSION', 'false', 'Enable HTTP GZip compression.', 14, 1, '2004-05-01 18:47:42', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(135, 'Compression Level', 'GZIP_LEVEL', '5', 'Use this compression level 0-9 (0 = minimum, 9 = maximum).', 14, 2, NULL, '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(136, 'Session Directory', 'SESSION_WRITE_DIRECTORY', '', 'If sessions are file based, store them in this directory.', 15, 1, '2005-05-13 20:19:49', '2003-07-17 10:29:22', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(137, 'Force Cookie Use', 'SESSION_FORCE_COOKIE_USE', 'False', 'Force the use of sessions when cookies are only enabled.', 15, 2, '2004-03-28 10:39:20', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(138, 'Check SSL Session ID', 'SESSION_CHECK_SSL_SESSION_ID', 'False', 'Validate the SSL_SESSION_ID on every secure HTTPS page request.', 15, 3, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(139, 'Check User Agent', 'SESSION_CHECK_USER_AGENT', 'False', 'Validate the clients browser user agent on every page request.', 15, 4, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(140, 'Check IP Address', 'SESSION_CHECK_IP_ADDRESS', 'False', 'Validate the clients IP address on every page request.', 15, 5, NULL, '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(141, 'Prevent Spider Sessions', 'SESSION_BLOCK_SPIDERS', 'True', 'Prevent known spiders from starting a session.', 15, 6, '2003-07-17 10:34:45', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(142, 'Recreate Session', 'SESSION_RECREATE', 'False', 'Recreate the session to generate a new session ID when the customer logs on or creates an account (PHP >=4.1 needed).', 15, 7, '2005-05-13 20:20:10', '2003-07-17 10:29:22', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(143, 'PRODUCT DESCRIPTIONS use WYSIWYG HTMLAREA?', 'HTML_AREA_WYSIWYG_DISABLE', 'Enable', 'Enable/Disable WYSIWYG box', 112, 0, '2008-05-02 11:01:59', '2003-07-17 12:41:25', NULL, 'tep_cfg_select_option(array(''Enable'', ''Disable''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(144, 'Product Description Basic/Advanced Version?', 'HTML_AREA_WYSIWYG_BASIC_PD', 'Advanced', 'Basic Features FASTER<br>Advanced Features SLOWER', 112, 10, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, 'tep_cfg_select_option(array(''Basic'', ''Advanced''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(145, 'Product Description Layout Width', 'HTML_AREA_WYSIWYG_WIDTH', '505', 'How WIDE should the HTMLAREA be in pixels (default: 505)', 112, 15, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(146, 'Product Description Layout Height', 'HTML_AREA_WYSIWYG_HEIGHT', '240', 'How HIGH should the HTMLAREA be in pixels (default: 240)', 112, 19, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(147, 'CUSTOMER EMAILS use WYSIWYG HTMLAREA?', 'HTML_AREA_WYSIWYG_DISABLE_EMAIL', 'Enable', 'Use WYSIWYG Area in Email Customers', 112, 20, '2005-05-13 17:52:41', '2003-07-17 12:41:25', NULL, 'tep_cfg_select_option(array(''Enable'', ''Disable''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(148, 'Customer Email Basic/Advanced Version?', 'HTML_AREA_WYSIWYG_BASIC_EMAIL', 'Advanced', 'Basic Features FASTER<br>Advanced Features SLOWER', 112, 21, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, 'tep_cfg_select_option(array(''Basic'', ''Advanced''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(149, 'Customer Email Layout Width', 'EMAIL_AREA_WYSIWYG_WIDTH', '505', 'How WIDE should the HTMLAREA be in pixels (default: 505)', 112, 25, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(150, 'Customer Email Layout Height', 'EMAIL_AREA_WYSIWYG_HEIGHT', '140', 'How HIGH should the HTMLAREA be in pixels (default: 140)', 112, 29, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(151, 'NEWSLETTER EMAILS use WYSIWYG HTMLAREA?', 'HTML_AREA_WYSIWYG_DISABLE_NEWSLETTER', 'Enable', 'Use WYSIWYG Area in Email Newsletter', 112, 30, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, 'tep_cfg_select_option(array(''Enable'', ''Disable''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(152, 'Newsletter Email Basic/Advanced Version?', 'HTML_AREA_WYSIWYG_BASIC_NEWSLETTER', 'Advanced', 'Basic Features FASTER<br>Advanced Features SLOWER', 112, 32, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, 'tep_cfg_select_option(array(''Basic'', ''Advanced''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(153, 'Newsletter Email Layout Width', 'NEWSLETTER_EMAIL_WYSIWYG_WIDTH', '505', 'How WIDE should the HTMLAREA be in pixels (default: 505)', 112, 35, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(154, 'Newsletter Email Layout Height', 'NEWSLETTER_EMAIL_WYSIWYG_HEIGHT', '140', 'How HIGH should the HTMLAREA be in pixels (default: 140)', 112, 39, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(155, 'DEFINE MAINPAGE use WYSIWYG HTMLAREA?', 'HTML_AREA_WYSIWYG_DISABLE_DEFINE', 'Enable', 'Use WYSIWYG Area in Define Mainpage', 112, 40, '2005-05-13 18:45:01', '2003-07-17 12:41:25', NULL, 'tep_cfg_select_option(array(''Enable'', ''Disable''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(156, 'Define Mainpage Basic/Advanced Version?', 'HTML_AREA_WYSIWYG_BASIC_DEFINE', 'Advanced', 'Basic Features FASTER<br>Advanced Features SLOWER', 112, 41, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, 'tep_cfg_select_option(array(''Basic'', ''Advanced''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(157, 'Define Mainpage Layout Width', 'DEFINE_MAINPAGE_WYSIWYG_WIDTH', '605', 'How WIDE should the HTMLAREA be in pixels (default: 505)', 112, 42, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(158, 'Define Mainpage Layout Height', 'DEFINE_MAINPAGE_WYSIWYG_HEIGHT', '300', 'How HIGH should the HTMLAREA be in pixels (default: 140)', 112, 43, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(159, 'GLOBAL - User Interface Font Type', 'HTML_AREA_WYSIWYG_FONT_TYPE', 'Verdana', 'User Interface Font Type<br>(not saved to product description)', 112, 45, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, 'tep_cfg_select_option(array(''Arial'', ''Courier New'', ''Georgia'', ''Impact'', ''Tahoma'', ''Times New Roman'', ''Verdana'', ''Wingdings''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(160, 'GLOBAL - User Interface Font Size', 'HTML_AREA_WYSIWYG_FONT_SIZE', '12', 'User Interface Font Size (not saved to product description)<p><b>10 Equals 10 pt', 112, 50, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, 'tep_cfg_select_option(array(\\''8\\'', \\''10\\'', \\''12\\'', \\''14\\'', \\''18\\'', \\''24\\'', \\''36\\''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(161, 'GLOBAL - User Interface Font Colour', 'HTML_AREA_WYSIWYG_FONT_COLOUR', 'Black', 'White, Black, C0C0C0, Red, FFFFFF, Yellow, Pink, Blue, Gray, 000000, ect..<br>basically any colour or HTML colour code!<br>(not saved to product description)', 112, 55, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(162, 'GLOBAL - User Interface Background Colour', 'HTML_AREA_WYSIWYG_BG_COLOUR', 'White', 'White, Black, C0C0C0, Red, FFFFFF, Yellow, Pink, Blue, Gray, 000000, ect..<br>basically any colour or html colour code!<br>(not saved to product description)', 112, 60, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(163, 'GLOBAL - ALLOW DEBUG MODE?', 'HTML_AREA_WYSIWYG_DEBUG', '0', 'Moniter Live-html, It updates as you type in a 2nd field above it.<p>Disable Debug = 0<br>Enable Debug = 1<br>Default = 0 OFF', 112, 65, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, 'tep_cfg_select_option(array(''0'', ''1''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(164, 'E-Mail Address', 'AFFILIATE_EMAIL_ADDRESS', '<affiliate@localhost.com>', 'The E Mail Address for the Affiliate Programm', 900, 1, '2003-07-17 21:46:04', '2003-07-17 13:48:39', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(165, 'Affiliate Pay Per Sale Payment % Rate', 'AFFILIATE_PERCENT', '10.0000', 'Percentage Rate for the Affiliate Program', 900, 2, NULL, '2003-07-17 13:48:39', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(166, 'Payment Threshold', 'AFFILIATE_THRESHOLD', '50.00', 'Payment Threshold for paying affiliates', 900, 3, NULL, '2003-07-17 13:48:39', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(167, 'Cookie Lifetime', 'AFFILIATE_COOKIE_LIFETIME', '7200', 'How long does the click count (seconds) if customer comes back', 900, 4, NULL, '2003-07-17 13:48:39', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(168, 'Billing Time', 'AFFILIATE_BILLING_TIME', '30', 'Orders billed must be at least "30" days old.<br>This is needed if a order is refunded', 900, 5, NULL, '2003-07-17 13:48:39', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(169, 'Order Min Status', 'AFFILIATE_PAYMENT_ORDER_MIN_STATUS', '3', 'The status an order must have at least, to be billed', 900, 6, NULL, '2003-07-17 13:48:39', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(170, 'Pay Affiliates with check', 'AFFILIATE_USE_CHECK', 'false', 'Pay Affiliates with check', 900, 7, '2008-04-12 22:06:11', '2003-07-17 13:48:39', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(171, 'Pay Affiliates with PayPal', 'AFFILIATE_USE_PAYPAL', 'true', 'Pay Affiliates with PayPal', 900, 8, NULL, '2003-07-17 13:48:39', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(172, 'Pay Affiliates by Bank', 'AFFILIATE_USE_BANK', 'false', 'Pay Affiliates by Bank', 900, 9, '2008-04-12 22:06:18', '2003-07-17 13:48:39', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(173, 'Individual Affiliate Percentage', 'AFFILATE_INDIVIDUAL_PERCENTAGE', 'true', 'Allow per Affiliate provision', 900, 10, NULL, '2003-07-17 13:48:39', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(174, 'Use Affiliate-tier', 'AFFILATE_USE_TIER', 'true', 'Multilevel Affiliate provisions', 900, 11, '2008-04-12 22:06:27', '2003-07-17 13:48:39', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(175, 'Number of Tierlevels', 'AFFILIATE_TIER_LEVELS', '3', 'Number of Tierlevels', 900, 12, '2008-04-12 22:06:34', '2003-07-17 13:48:39', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(176, 'Percentage Rate for the Tierlevels', 'AFFILIATE_TIER_PERCENTAGE', '8.00;5.00;1.00', 'Percent Rates for the tierlevels<br>Example: 8.00;5.00;1.00', 900, 13, NULL, '2003-07-17 13:48:39', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(177, 'Display Total', 'MODULE_ORDER_TOTAL_COUPON_STATUS', 'true', 'Do you want to display the Discount Coupon value?', 6, 1, NULL, '2003-07-26 14:23:49', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(178, 'Sort Order', 'MODULE_ORDER_TOTAL_COUPON_SORT_ORDER', '9', 'Sort order of display.', 6, 2, NULL, '2003-07-26 14:23:49', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(179, 'Include Shipping', 'MODULE_ORDER_TOTAL_COUPON_INC_SHIPPING', 'true', 'Include Shipping in calculation', 6, 5, NULL, '2003-07-26 14:23:49', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(180, 'Include Tax', 'MODULE_ORDER_TOTAL_COUPON_INC_TAX', 'false', 'Include Tax in calculation.', 6, 6, NULL, '2003-07-26 14:23:49', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(181, 'Re-calculate Tax', 'MODULE_ORDER_TOTAL_COUPON_CALC_TAX', 'None', 'Re-Calculate Tax', 6, 7, NULL, '2003-07-26 14:23:49', NULL, 'tep_cfg_select_option(array(''None'', ''Standard'', ''Credit Note''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(182, 'Tax Class', 'MODULE_ORDER_TOTAL_COUPON_TAX_CLASS', '0', 'Use the following tax class when treating Discount Coupon as Credit Note.', 6, 0, NULL, '2003-07-26 14:23:49', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(183, 'Display Total', 'MODULE_ORDER_TOTAL_GV_STATUS', 'true', 'Do you want to display the Gift Voucher value?', 6, 1, NULL, '2003-07-26 14:23:56', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(184, 'Sort Order', 'MODULE_ORDER_TOTAL_GV_SORT_ORDER', '740', 'Sort order of display.', 6, 2, NULL, '2003-07-26 14:23:56', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(185, 'Queue Purchases', 'MODULE_ORDER_TOTAL_GV_QUEUE', 'true', 'Do you want to queue purchases of the Gift Voucher?', 6, 3, NULL, '2003-07-26 14:23:56', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(186, 'Include Shipping', 'MODULE_ORDER_TOTAL_GV_INC_SHIPPING', 'true', 'Include Shipping in calculation', 6, 5, NULL, '2003-07-26 14:23:56', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(187, 'Include Tax', 'MODULE_ORDER_TOTAL_GV_INC_TAX', 'false', 'Include Tax in calculation.', 6, 6, NULL, '2003-07-26 14:23:56', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(188, 'Re-calculate Tax', 'MODULE_ORDER_TOTAL_GV_CALC_TAX', 'None', 'Re-Calculate Tax', 6, 7, NULL, '2003-07-26 14:23:56', NULL, 'tep_cfg_select_option(array(''None'', ''Standard'', ''Credit Note''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(189, 'Tax Class', 'MODULE_ORDER_TOTAL_GV_TAX_CLASS', '0', 'Use the following tax class when treating Gift Voucher as Credit Note.', 6, 0, NULL, '2003-07-26 14:23:56', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(190, 'Credit including Tax', 'MODULE_ORDER_TOTAL_GV_CREDIT_TAX', 'false', 'Add tax to purchased Gift Voucher when crediting to Account', 6, 8, NULL, '2003-07-26 14:23:56', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(211, 'Allow Category Descriptions', 'ALLOW_CATEGORY_DESCRIPTIONS', 'true', 'Allow use of full text descriptions for categories', 1, 19, '2003-08-29 16:47:38', '2003-08-02 13:42:39', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(593, 'Prevent Adding Out of Stock to Cart', 'PRODINFO_ATTRIBUTE_NO_ADD_OUT_OF_STOCK', 'True', 'Prevents adding an out of stock attribute combination to the cart.', 888001, 40, '2005-02-20 14:15:06', '2005-02-20 14:10:46', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(592, 'Display Out of Stock Message Line', 'PRODINFO_ATTRIBUTE_OUT_OF_STOCK_MSGLINE', 'False', 'Controls the display of a message line indicating an out of stock attributes is selected.', 888001, 30, '2005-08-14 07:50:50', '2005-02-20 14:10:46', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(591, 'Mark Out of Stock Attributes', 'PRODINFO_ATTRIBUTE_MARK_OUT_OF_STOCK', 'Right', 'Controls how out of stock attributes are marked as out of stock.', 888001, 20, NULL, '2005-02-20 14:10:46', NULL, 'tep_cfg_select_option(array(''None'', ''Right'', ''Left''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(590, 'Show Out of Stock Attributes', 'PRODINFO_ATTRIBUTE_SHOW_OUT_OF_STOCK', 'True', 'Controls the display of out of stock attributes.', 888001, 10, NULL, '2005-02-20 14:10:46', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(589, 'Product Info Attribute Display Plugin', 'PRODINFO_ATTRIBUTE_PLUGIN', 'multiple_dropdowns', 'The plugin used for displaying attributes on the product information page.', 888001, 1, '2005-09-18 10:18:11', '2005-02-20 14:10:46', NULL, 'tep_cfg_pull_down_class_files(''pad_'',');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(504, 'Big Image Types', 'DYNAMIC_MOPICS_BIG_IMAGE_TYPES', 'jpg, gif, jpeg, tiff, png, bmp', 'The types (extensions) of big images you use, seperated by commas.', 901, 0, NULL, '2005-01-16 21:44:44', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(503, 'Thumbnail Image Types', 'DYNAMIC_MOPICS_THUMB_IMAGE_TYPES', 'jpg, gif, jpeg, tiff, png, bmp', 'The types (extensions) of extra thumbnails you use, seperated by commas.', 901, 0, NULL, '2005-01-16 21:44:44', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(499, 'Big Images Directory', 'DYNAMIC_MOPICS_BIGIMAGES_DIR', '/', 'The directory inside catalog/images where your big images are stored.', 901, 0, '2005-09-18 12:00:08', '2005-01-16 21:44:44', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(500, 'Thumbnail Images Directory', 'DYNAMIC_MOPICS_THUMBS_DIR', 'thumbs/', 'The directory inside catalog/images where you extra image thumbs are stored.', 901, 0, NULL, '2005-01-16 21:44:44', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(501, 'Main Thumbnail In "Thumbnail Images Directory"', 'DYNAMIC_MOPICS_MAINTHUMB_IN_THUMBS_DIR', 'false', 'If you store your product''s main thumbnail in the "Thumbnail Images Directory" set this to true.  If it is in the main image directory (uploaded via osCommerce admin), set it false.', 901, 0, '2005-02-01 14:53:33', '2005-01-16 21:44:44', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(502, 'Extra Image Pattern', 'DYNAMIC_MOPICS_PATTERN', 'imagebase_{1}', 'Your custom defined pattern for extra images.  imagebase is the base of the main thumbnail.  Place the counting method between brackets {}.  Current counting methods can be 1, a, or A.  See readme for more information.', 901, 0, '2005-01-17 21:34:27', '2005-01-16 21:44:44', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(458, 'Template Switching Allowed', 'TEMPLATE_SWITCHING_ALLOWED', 'true', 'Allow template switching through the url (for easy new template testing).', 1, 22, '2004-01-17 16:27:30', '2004-01-17 16:07:41', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(457, 'Default Template Directory', 'DIR_WS_TEMPLATES_DEFAULT', 'fallback', 'Subdirectory (in templates/) where the template files are stored which should be loaded by default.', 1, 22, '2008-05-03 14:19:51', '2004-01-17 16:07:41', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(231, 'Enable Display a Dhtml menu', 'DISPLAY_DHTML_MENU', 'Default', 'Do you want to display a DHTML menu instead of the default text based?', 1, 19, '2005-04-01 12:03:38', '2003-03-07 20:37:02', NULL, 'tep_cfg_select_option(array(''Default'', ''Dhtml'',''CoolMenu''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1394, 'API Signature', 'MODULE_PAYMENT_PAYPAL_EXPRESS_API_SIGNATURE', 'AYoXlSOZcg-yQ90OkFYbGyDMexorAoPVRP16HtItNkdDv5o0qaochFCh', 'The signature to use for the PayPal API service', 6, 0, NULL, '2008-05-03 09:20:33', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(358, 'Downloads Controller Update Status Value', 'DOWNLOADS_ORDERS_STATUS_UPDATED_VALUE', '100000', 'What orders_status resets the Download days and Max Downloads - Default is 4', 13, 90, '2003-09-07 13:13:56', '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(359, 'Downloads Controller Download on hold message', 'DOWNLOADS_CONTROLLER_ON_HOLD_MSG', '<BR><font color="FF0000">NOTE: Downloads are not available until payment has been confirmed</font>', 'Downloads Controller Download on hold message', 13, 91, '2003-02-18 13:22:32', '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(360, 'Downloads Controller Order Status Value', 'DOWNLOADS_CONTROLLER_ORDERS_STATUS', '2', 'Downloads Controller Order Status Value - Default=2', 13, 92, '2003-09-07 13:14:39', '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(740, 'Printable Catalog-Categories column', 'PRODUCT_LIST_CATALOG_CATEGORIES', 'show', 'Do you want to display the Categories column?', 899, 11, '2005-04-24 14:30:53', '2005-04-24 14:30:53', NULL, 'tep_cfg_select_option(array(''show'', ''hide''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(739, 'Printable Catalog-Description column', 'PRODUCT_LIST_CATALOG_DESCRIPTION', 'hide', 'Do you want to display the Products Description column?', 899, 10, '2005-04-24 14:30:53', '2005-04-24 14:30:53', NULL, 'tep_cfg_select_option(array(''show'', ''hide''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(738, 'Printable Catalog-Manufacturers column', 'PRODUCT_LIST_CATALOG_MANUFACTURERS', 'hide', 'Do you want to display the Manufacturers column?', 899, 9, '2005-04-24 14:30:53', '2005-04-24 14:30:53', NULL, 'tep_cfg_select_option(array(''show'', ''hide''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(737, 'Printable Catalog-Name column', 'PRODUCT_LIST_CATALOG_NAME', 'show', 'Do you want to display the Name column?', 899, 8, '2005-04-24 14:30:53', '2005-04-24 14:30:53', NULL, 'tep_cfg_select_option(array(''show'', ''hide''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(736, 'Printable Catalog-Options column', 'PRODUCT_LIST_CATALOG_OPTIONS', 'hide', 'Do you want to display the Options colum?', 899, 7, '2005-04-24 14:30:53', '2005-04-24 14:30:53', NULL, 'tep_cfg_select_option(array(''show'', ''hide''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(735, 'Printable Catalog-Image column in full catalog link', 'PRODUCT_LIST_CATALOG_IMAGE_FULL', 'hide', 'Do you want to display the Image column in the Full Catalog Script?(hide image for faster page loads on full catalog)', 899, 6, '2005-04-24 14:30:53', '2005-04-24 14:30:53', NULL, 'tep_cfg_select_option(array(''show'', ''hide''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(734, 'Printable Catalog-Image column in standard link', 'PRODUCT_LIST_CATALOG_IMAGE', 'show', 'Do you want to display the Image column?', 899, 5, '2005-04-24 14:30:53', '2005-04-24 14:30:53', NULL, 'tep_cfg_select_option(array(''show'', ''hide''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(733, 'Printable Catalog-Length of the Description Text', 'PRODUCT_LIST_DESCRIPTION_LENGTH', '400', 'How many characters in the description to display?', 899, 4, '2005-04-24 14:30:53', '2005-04-24 14:30:53', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(732, 'Printable Catalog-Results Per Page', 'PRODUCT_LIST_CATALOG_PERPAGE', '10', 'How many products do you want to list per page?', 899, 3, '2005-04-24 14:30:53', '2005-04-24 14:30:53', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(731, 'Printable Catalog-Number of Page Breaks Displayed', 'PRODUCT_LIST_PAGEBREAK_NUMBERS_PERPAGE', '10', 'How page breaks numbers to display?', 899, 2, '2005-04-24 14:30:53', '2005-04-24 14:30:53', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(730, 'Printable Catalog-Customer Discount in Catalog', 'PRODUCT_LIST_CUSTOMER_DISCOUNT', 'show', 'Setting to -show- will display the catalog with a customer discount applied if logged in. It will display pricing without discount if not logged in. (only valid if Members Discount Mod is loaded. Default if Mod not present is -hide-)', 899, 0, '2005-04-24 14:44:46', '2005-04-24 14:30:53', NULL, 'tep_cfg_select_option(array(''show'', ''hide''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(378, '<B>Down for Maintenance: ON/OFF</B>', 'DOWN_FOR_MAINTENANCE', 'false', 'Down for Maintenance <br>(true=on false=off)', 16, 1, '2008-05-03 14:23:52', '2003-09-07 21:43:00', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(379, 'Down for Maintenance: filename', 'DOWN_FOR_MAINTENANCE_FILENAME', 'down_for_maintenance.php', 'Down for Maintenance filename Default=down_for_maintenance.php', 16, 2, NULL, '2003-09-07 21:43:00', NULL, '');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(380, 'Down for Maintenance: Hide Header', 'DOWN_FOR_MAINTENANCE_HEADER_OFF', 'true', 'Down for Maintenance: Hide Header <br>(true=hide false=show)', 16, 3, '2008-05-03 14:08:19', '2003-09-07 21:43:00', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(381, 'Down for Maintenance: Hide Column Left', 'DOWN_FOR_MAINTENANCE_COLUMN_LEFT_OFF', 'true', 'Down for Maintenance: Hide Column Left <br>(true=hide false=show)', 16, 4, '2008-05-03 14:08:13', '2003-09-07 21:43:00', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(382, 'Down for Maintenance: Hide Column Right', 'DOWN_FOR_MAINTENANCE_COLUMN_RIGHT_OFF', 'true', 'Down for Maintenance: Hide Column Right <br>(true=hide false=show)r', 16, 5, '2008-05-03 13:32:24', '2003-09-07 21:43:00', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(383, 'Down for Maintenance: Hide Footer', 'DOWN_FOR_MAINTENANCE_FOOTER_OFF', 'true', 'Down for Maintenance: Hide Footer <br>(true=hide false=show)', 16, 6, '2008-05-03 13:51:36', '2003-09-07 21:43:00', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(384, 'Down for Maintenance: Hide Prices', 'DOWN_FOR_MAINTENANCE_PRICES_OFF', 'false', 'Down for Maintenance: Hide Prices <br>(true=hide false=show)', 16, 7, '2003-09-07 21:55:34', '2003-09-07 21:43:00', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(385, 'Down For Maintenance (exclude this IP-Address)', 'EXCLUDE_ADMIN_IP_FOR_MAINTENANCE', '', 'This IP Address is able to access the website while it is Down For Maintenance (like webmaster)', 16, 8, '2003-09-07 21:56:14', '2003-03-21 21:20:07', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(386, 'NOTIFY PUBLIC Before going Down for Maintenance: ON/OFF', 'WARN_BEFORE_DOWN_FOR_MAINTENANCE', 'false', 'Give a WARNING some time before you put your website Down for Maintenance<br>(true=on false=off)<br>If you set the ''Down For Maintenance: ON/OFF'' to true this will automaticly be updated to false', 16, 9, '0000-00-00 00:00:00', '2003-03-21 11:42:47', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(387, 'Date and hours for notice before maintenance', 'PERIOD_BEFORE_DOWN_FOR_MAINTENANCE', '16/05/2003  between the hours of 2-3 PM', 'Date and hours for notice before maintenance website, enter date and hours for maintenance website', 16, 10, '2004-02-11 18:14:46', '2003-03-21 11:42:47', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(388, 'Display when webmaster has enabled maintenance', 'DISPLAY_MAINTENANCE_TIME', 'true', 'Display when Webmaster has enabled maintenance <br>(true=on false=off)<br>', 16, 11, '2004-02-11 18:14:57', '2003-03-21 11:42:47', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(389, 'Display website maintenance period', 'DISPLAY_MAINTENANCE_PERIOD', 'true', 'Display Website maintenance period <br>(true=on false=off)<br>', 16, 12, '2004-02-11 18:15:05', '2003-03-21 11:42:47', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(390, 'Website maintenance period', 'TEXT_MAINTENANCE_PERIOD_TIME', '2h00', 'Enter Website Maintenance period (hh:mm)', 16, 13, '2003-03-21 13:08:25', '2003-03-21 11:42:47', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(456, 'Welcome Discount Coupon Code', 'NEW_SIGNUP_DISCOUNT_COUPON', '', 'Welcome Discount Coupon Code: if you do not want to send a coupon in your create account email leave blank else place the coupon code you wish to use', 1, 32, '2005-05-18 17:14:42', '2003-12-05 05:01:41', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(455, 'Welcome Gift Voucher Amount', 'NEW_SIGNUP_GIFT_VOUCHER_AMOUNT', '0', 'Welcome Gift Voucher Amount: If you do not wish to send a Gift Voucher in your create account email put 0 for no amount else if you do place the amount here i.e. 10.00 or 50.00 no currency signs', 1, 31, '2004-01-04 22:31:03', '2003-12-05 05:01:41', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(505, 'Display New Articles Link', 'DISPLAY_NEW_ARTICLES', 'false', 'Display a link to New Articles in the Articles box?', 456, 1, '2005-04-30 13:11:29', '2005-01-27 13:49:14', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(506, 'Number of Days Display New Articles', 'NEW_ARTICLES_DAYS_DISPLAY', '30', 'The number of days to display New Articles?', 456, 2, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(507, 'Maximum New Articles Per Page', 'MAX_NEW_ARTICLES_PER_PAGE', '10', 'The maximum number of New Articles to display per page<br>(New Articles page)', 456, 3, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(508, 'Display All Articles Link', 'DISPLAY_ALL_ARTICLES', 'true', 'Display a link to All Articles in the Articles box?', 456, 4, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(509, 'Maximum Articles Per Page', 'MAX_ARTICLES_PER_PAGE', '10', 'The maximum number of Articles to display per page<br>(All Articles and Topic/Author pages)', 456, 5, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(510, 'Maximum Display Upcoming Articles', 'MAX_DISPLAY_UPCOMING_ARTICLES', '5', 'Maximum number of articles to display in the Upcoming Articles module', 456, 6, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(511, 'Enable Article Reviews', 'ENABLE_ARTICLE_REVIEWS', 'true', 'Enable registered users to review articles?', 456, 7, '2008-04-12 19:59:08', '2005-01-27 13:49:14', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(512, 'Enable Tell a Friend About Article', 'ENABLE_TELL_A_FRIEND_ARTICLE', 'true', 'Enable Tell a Friend option in the Article Information page?', 456, 8, '2008-04-12 19:59:13', '2005-01-27 13:49:14', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(513, 'Minimum Number Cross-Sell Products', 'MIN_DISPLAY_ARTICLES_XSELL', '1', 'Minimum number of products to display in the articles Cross-Sell listing.', 456, 9, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(514, 'Maximum Number Cross-Sell Products', 'MAX_DISPLAY_ARTICLES_XSELL', '6', 'Maximum number of products to display in the articles Cross-Sell listing.', 456, 10, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(515, 'Show Article Counts', 'SHOW_ARTICLE_COUNTS', 'true', 'Count recursively how many articles are in each topic', 456, 11, '2008-04-12 19:59:18', '2005-01-27 13:49:14', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(516, 'Maximum Length of Author Name', 'MAX_DISPLAY_AUTHOR_NAME_LEN', '20', 'The maximum length of the author''s name for display in the Author box', 456, 12, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(517, 'Authors List Style', 'MAX_DISPLAY_AUTHORS_IN_A_LIST', '1', 'Used in Authors box. When the number of authors exceeds this number, a drop-down list will be displayed instead of the default list', 456, 13, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(518, 'Authors Select Box Size', 'MAX_AUTHORS_LIST', '1', 'Used in Authors box. When this value is 1 the classic drop-down list will be used for the authors box. Otherwise, a list-box with the specified number of rows will be displayed.', 456, 14, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(519, 'Display Author in Article Listing', 'DISPLAY_AUTHOR_ARTICLE_LISTING', 'true', 'Display the Author in the Article Listing?', 456, 15, '2008-04-12 19:59:24', '2005-01-27 13:49:14', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(520, 'Display Topic in Article Listing', 'DISPLAY_TOPIC_ARTICLE_LISTING', 'true', 'Display the Topic in the Article Listing?', 456, 16, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(521, 'Display Abstract in Article Listing', 'DISPLAY_ABSTRACT_ARTICLE_LISTING', 'true', 'Display the Abstract in the Article Listing?', 456, 17, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(522, 'Display Date Added in Article Listing', 'DISPLAY_DATE_ADDED_ARTICLE_LISTING', 'true', 'Display the Date Added in the Article Listing?', 456, 18, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(523, 'Maximum Article Abstract Length', 'MAX_ARTICLE_ABSTRACT_LENGTH', '300', 'Sets the maximum length of the Article Abstract to be displayed<br><br>(No. of characters)', 456, 19, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(524, 'Display Topic/Author Filter', 'ARTICLE_LIST_FILTER', 'true', 'Do you want to display the Topic/Author Filter?', 456, 20, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(525, 'Location of Prev/Next Navigation Bar', 'ARTICLE_PREV_NEXT_BAR_LOCATION', 'bottom', 'Sets the location of the Previous/Next Navigation Bar<br><br>(top; bottom; both)', 456, 21, '2005-04-30 13:12:52', '2005-01-27 13:49:14', NULL, 'tep_cfg_select_option(array(''top'', ''bottom'', ''both''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(526, 'Use WYSIWYG HTMLAREA Editor?', 'ARTICLE_WYSIWYG_ENABLE', 'Enable', 'Use WYSIWYG Editor in Articles and Topic/Author Descriptions?', 456, 22, '2005-05-13 17:34:32', '2005-01-27 13:49:14', NULL, 'tep_cfg_select_option(array(''Enable'', ''Disable''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(527, 'WYSIWYG Editor Basic/Advanced Version?', 'ARTICLE_MANAGER_WYSIWYG_BASIC', 'Advanced', 'Basic Features FASTER<br>Advanced Features SLOWER', 456, 23, '2005-04-30 13:13:04', '2005-01-27 13:49:14', NULL, 'tep_cfg_select_option(array(''Basic'', ''Advanced''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(528, 'WYSIWYG Editor Layout Width', 'ARTICLE_MANAGER_WYSIWYG_WIDTH', '605', 'How WIDE should the HTMLAREA be in pixels (default: 605)', 456, 24, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(529, 'WYSIWYG Editor Layout Height', 'ARTICLE_MANAGER_WYSIWYG_HEIGHT', '300', 'How HIGH should the HTMLAREA be in pixels (default: 300)', 456, 25, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(530, 'WYSIWYG Editor Font Type', 'ARTICLE_MANAGER_WYSIWYG_FONT_TYPE', 'Times New Roman', 'User Interface Font Type<br>(not saved to content)', 456, 26, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, 'tep_cfg_select_option(array(''Arial'', ''Courier New'', ''Georgia'', ''Impact'', ''Tahoma'', ''Times New Roman'', ''Verdana'', ''Wingdings''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(531, 'WYSIWYG Editor Font Size', 'ARTICLE_MANAGER_WYSIWYG_FONT_SIZE', '12', 'User Interface Font Size<br>(not saved to content)<p><b>10 Equals 10 pt', 456, 27, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, 'tep_cfg_select_option(array(\\''8\\'', \\''10\\'', \\''12\\'', \\''14\\'', \\''18\\'', \\''24\\'', \\''36\\''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(532, 'WYSIWYG Editor Font Colour', 'ARTICLE_MANAGER_WYSIWYG_FONT_COLOUR', 'Black', 'White, Black, C0C0C0, Red, FFFFFF, Yellow, Pink, Blue, Gray, 000000, etc...<br>basically any colour or HTML colour code!<br>(not saved to content)', 456, 28, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, '');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(533, 'WYSIWYG Editor Background Colour', 'ARTICLE_MANAGER_WYSIWYG_BG_COLOUR', 'White', 'White, Black, C0C0C0, Red, FFFFFF, Yellow, Pink, Blue, Gray, 000000, etc...<br>basically any colour or html colour code!<br>(not saved to content)', 456, 29, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, '');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(534, 'WYSIWYG Editor Allow Debug Mode?', 'ARTICLE_MANAGER_WYSIWYG_DEBUG', '0', 'Moniter Live-html, It updates as you type in a 2nd field above it.<p>Disable Debug = 0<br>Enable Debug = 1<br>Default = 0 OFF', 456, 30, '2005-01-27 13:49:14', '2005-01-27 13:49:14', NULL, 'tep_cfg_select_option(array(''0'', ''1''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(391, 'Down For Maintenance Start Time', 'TEXT_DATE_TIME', '2008-05-03 14:23:52', 'Show when down for maintenance', 16, 14, '2008-05-03 14:23:52', '2005-01-27 13:49:14', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(700, 'Number of Columns for product listings', 'PRODUCT_LIST_NUM_COLUMNS', '4', 'How many prodcuts per row do you want to display on your product listing page?', 8, 14, '2005-04-06 07:43:07', '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(701, 'Minimum X-Sell products Listed', 'MIN_DISPLAY_XSELL', '1', 'How many x-sell products per page', 8, 20, '2005-04-07 08:41:40', '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(652, 'Max Wish List Box', 'MAX_DISPLAY_WISHLIST_BOX', '4', 'How many wish list items to display in the infobox before it changes to a counter', 3, 0, NULL, '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(651, 'Max Wish List', 'MAX_DISPLAY_WISHLIST_PRODUCTS', '12', 'How many wish list items to show per page on the main wishlist.php file', 3, 0, NULL, '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(650, 'Product Display Type (Default = 0 or Columns = 1)', 'PRODUCT_LIST_TYPE', '1', 'Do you want to display products one per row or multiple columns per row?', 8, 10, '2005-04-02 16:55:11', '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(645, 'Tax Class', 'MODULE_ORDER_TOTAL_LOWORDERFEE_TAX_CLASS', '0', 'Use the following tax class on the low order fee.', 6, 7, NULL, '2005-03-30 14:14:41', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(644, 'Attach Low Order Fee On Orders Made', 'MODULE_ORDER_TOTAL_LOWORDERFEE_DESTINATION', 'both', 'Attach low order fee for orders sent to the set destination.', 6, 6, NULL, '2005-03-30 14:14:41', NULL, 'tep_cfg_select_option(array(''national'', ''international'', ''both''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(643, 'Order Fee', 'MODULE_ORDER_TOTAL_LOWORDERFEE_FEE', '5', 'Low order fee.', 6, 5, NULL, '2005-03-30 14:14:41', 'currencies->format', NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(642, 'Order Fee For Orders Under', 'MODULE_ORDER_TOTAL_LOWORDERFEE_ORDER_UNDER', '50', 'Add the low order fee to orders under this amount.', 6, 4, NULL, '2005-03-30 14:14:41', 'currencies->format', NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(641, 'Allow Low Order Fee', 'MODULE_ORDER_TOTAL_LOWORDERFEE_LOW_ORDER_FEE', 'false', 'Do you want to allow low order fees?', 6, 3, NULL, '2005-03-30 14:14:41', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(640, 'Sort Order', 'MODULE_ORDER_TOTAL_LOWORDERFEE_SORT_ORDER', '5', 'Sort order of display.', 6, 2, NULL, '2005-03-30 14:14:41', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(639, 'Display Low Order Fee', 'MODULE_ORDER_TOTAL_LOWORDERFEE_STATUS', 'true', 'Do you want to display the low order fee?', 6, 1, NULL, '2005-03-30 14:14:41', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(638, 'Order Status', 'MODULE_LOYALTY_DISCOUNT_ORDER_STATUS', '3', 'Set the minimum order status for an order to add it to the total amount ordered', 6, 8, NULL, '2005-03-30 14:09:29', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(637, 'Discount Percentage', 'MODULE_LOYALTY_DISCOUNT_TABLE', '1000:5,1500:7.5,2000:10,3000:12.5,5000:15', 'Set the cumulative order total breaks per period set above, and discount percentages', 6, 7, NULL, '2005-03-30 14:09:29', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(635, 'Calculate Tax', 'MODULE_LOYALTY_DISCOUNT_CALC_TAX', 'false', 'Re-calculate Tax on discounted amount.', 6, 5, NULL, '2005-03-30 14:09:29', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(636, 'Cumulative order total period', 'MODULE_LOYALTY_DISCOUNT_CUMORDER_PERIOD', 'year', 'Set the period over which to calculate cumulative order total.', 6, 6, NULL, '2005-03-30 14:09:29', NULL, 'tep_cfg_select_option(array(''alltime'', ''year'', ''quarter'', ''month''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(634, 'Include Tax', 'MODULE_LOYALTY_DISCOUNT_INC_TAX', 'true', 'Include Tax in calculation.', 6, 4, NULL, '2005-03-30 14:09:29', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(633, 'Include Shipping', 'MODULE_LOYALTY_DISCOUNT_INC_SHIPPING', 'true', 'Include Shipping in calculation', 6, 3, NULL, '2005-03-30 14:09:29', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(632, 'Sort Order', 'MODULE_LOYALTY_DISCOUNT_SORT_ORDER', '4', 'Sort order of display.', 6, 2, NULL, '2005-03-30 14:09:29', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(631, 'Display Total', 'MODULE_LOYALTY_DISCOUNT_STATUS', 'true', 'Do you want to enable the Order Discount?', 6, 1, NULL, '2005-03-30 14:09:29', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(601, 'Merchant Notifications', 'MODULE_PAYMENT_AUTHORIZENET_EMAIL_MERCHANT', 'True', 'Should Authorize.Net e-mail a receipt to the store owner?', 6, 0, NULL, '2005-03-27 16:40:34', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(747, 'Printable Catalog-Show the Date?', 'PRODUCT_LIST_CATALOG_DATE_SHOW', 'hide', 'Do you want to display the Product Date Added (only valid if Display Printable Catalog Date column is set to -show-)', 899, 18, '2005-04-24 14:30:53', '2005-04-24 14:30:53', NULL, 'tep_cfg_select_option(array(''show'', ''hide''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(748, 'Printable Catalog-Show Currency?', 'PRODUCT_LIST_CATALOG_CURRENCY', 'hide', 'Do you want to display the Currency Pull Down', 899, 19, '2005-04-24 14:30:53', '2005-04-24 14:30:53', NULL, 'tep_cfg_select_option(array(''show'', ''hide''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(746, 'Printable Catalog-Date column', 'PRODUCT_LIST_CATALOG_DATE', 'hide', 'Do you want to display the Product Date Added column?', 899, 17, '2005-04-24 14:30:53', '2005-04-24 14:30:53', NULL, 'tep_cfg_select_option(array(''show'', ''hide''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(744, 'Printable Catalog-Weight column', 'PRODUCT_LIST_CATALOG_WEIGHT', 'hide', 'Do you want to display the Weight column?', 899, 15, '2005-04-24 14:30:53', '2005-04-24 14:30:53', NULL, 'tep_cfg_select_option(array(''show'', ''hide''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(745, 'Printable Catalog-Price column', 'PRODUCT_LIST_CATALOG_PRICE', 'show', 'Do you want to display the Price column?', 899, 16, '2005-04-24 14:30:53', '2005-04-24 14:30:53', NULL, 'tep_cfg_select_option(array(''show'', ''hide''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(742, 'Printable Catalog-UPC column', 'PRODUCT_LIST_CATALOG_UPC', 'hide', 'Do you want to display the UPC column? (only valid if Members Discount Mod is loaded Default if not present is -hide-)', 899, 13, '2005-04-24 14:30:53', '2005-04-24 14:30:53', NULL, 'tep_cfg_select_option(array(''show'', ''hide''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(743, 'Printable Catalog-Quantity column', 'PRODUCT_LIST_CATALOG_QUANTITY', 'hide', 'Do you want to display the Quantity column?', 899, 14, '2005-04-24 14:30:53', '2005-04-24 14:30:53', NULL, 'tep_cfg_select_option(array(''show'', ''hide''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(741, 'Printable Catalog-Model column', 'PRODUCT_LIST_CATALOG_MODEL', 'show', 'Do you want to display the Model column?', 899, 12, '2005-04-24 14:30:53', '2005-04-24 14:30:53', NULL, 'tep_cfg_select_option(array(''show'', ''hide''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(774, 'Enable Page Cache', 'ENABLE_PAGE_CACHE', 'false', 'Enable the page cache features to reduce server load and faster page renders?<br><br>Contribution by: <b>Chemo</b>', 26229, 1, '2005-05-17 09:27:54', '0000-00-00 00:00:00', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(775, 'Cache Lifetime', 'PAGE_CACHE_LIFETIME', '5', 'How long to cache the pages (in minutes) ?<br><br>Contribution by: <b>Chemo</b>', 26229, 2, NULL, '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(776, 'Turn on Debug Mode?', 'PAGE_CACHE_DEBUG_MODE', 'false', 'Turn on the global debug output (located at the footer) ? This affects ALL browsers and is NOT for live shops!  YOu can turn on debug mode JUST for your browser by adding "?debug=1" to your URL.<br><br>Contribution by: <b>Chemo</b>', 26229, 3, '2005-05-15 15:46:18', '0000-00-00 00:00:00', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(777, 'Disable URL Parameters?', 'PAGE_CACHE_DISABLE_PARAMETERS', 'false', 'In some cases (such as search engine safe URL''s) or large number of affiliate referrals will cause excessive page writing.<br><br>Contribution by: <b>Chemo</b>', 26229, 4, NULL, '0000-00-00 00:00:00', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(778, 'Delete Cache Files?', 'PAGE_CACHE_DELETE_FILES', 'true', 'If set to true the next catalog page request will delete all the cache files and then reset this value to false again.<br><br>Contribution by: <b>Chemo</b>', 26229, 5, '2005-06-29 17:51:38', '0000-00-00 00:00:00', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(779, 'Config Cache Update File?', 'PAGE_CACHE_UPDATE_CONFIG_FILES', 'none', 'If you have a configuration cache contribution enter the FULL path to the update file.<br><br>Contribution by: <b>Chemo</b>', 26229, 6, NULL, '0000-00-00 00:00:00', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(780, 'Enable SEO URLs?', 'SEO_URLS', 'false', 'Enable the SEO URLs?  This is a global setting and will turn them off completely.', 888002, 0, '2005-05-25 12:42:01', '2005-05-15 18:37:32', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(781, 'Choose URL Type', 'SEO_URLS_TYPE', 'cName', 'Choose which SEO URL format to use:<br><br><b>cName =></b> /index.php?cName=XXX<br><b>Rewrite =></b> /XXX-c-1.html', 888002, 1, '2005-05-15 18:37:32', '2005-05-15 18:37:32', NULL, 'tep_cfg_select_option(array(''cName'', ''Rewrite''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(782, 'Filter Short Words', 'SEO_URLS_FILTER_SHORT_WORDS', '3', 'This setting only affects the Rewrite option.  It will filter words less than or equal to the value from the URL.', 888002, 2, '2005-05-15 18:37:32', '2005-05-15 18:37:32', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(783, 'Reset SEO URLs Cache', 'SEO_URLS_CACHE_RESET', 'false', 'This will reset the cache data for SEO', 888002, 3, '2005-05-25 11:31:20', '2005-05-15 18:37:32', 'tep_reset_cache_data_seo_urls', 'tep_cfg_select_option(array(''reset'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1161, 'Sort Order', 'MODULE_SHIPPING_FLAT_SORT_ORDER', '5', 'Sort order of display.', 6, 0, NULL, '2005-09-17 10:39:49', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1158, 'Shipping Cost', 'MODULE_SHIPPING_FLAT_COST', '5.00', 'The shipping cost for all orders using this shipping method.', 6, 0, NULL, '2005-09-17 10:39:49', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1159, 'Tax Class', 'MODULE_SHIPPING_FLAT_TAX_CLASS', '0', 'Use the following tax class on the shipping fee.', 6, 0, NULL, '2005-09-17 10:39:49', 'tep_get_tax_class_title', 'tep_cfg_pull_down_tax_classes(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1160, 'Shipping Zone', 'MODULE_SHIPPING_FLAT_ZONE', '0', 'If a zone is selected, only enable this shipping method for that zone.', 6, 0, NULL, '2005-09-17 10:39:49', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1157, 'Enable Flat Shipping', 'MODULE_SHIPPING_FLAT_STATUS', 'True', 'Do you want to offer flat rate shipping?', 6, 0, NULL, '2005-09-17 10:39:49', NULL, 'tep_cfg_select_option(array(''True'', ''False''), ');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1200, 'Order Editor- Display Payment Method dropdown?', 'DISPLAY_PAYMENT_METHOD_DROPDOWN', 'true', 'Display Payment Method in Order Editor as dropdown menu (true) or as input field (false)', 1, 21, NULL, '2006-04-02 11:51:01', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1201, 'Product Quantities In Shopping Cart', 'MAX_QTY_IN_CART', '99', 'Maximum number of product quantities that can be added to the shopping cart (0 for no limit)', 3, 19, NULL, '2008-04-12 18:49:24', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1202, 'Admin Editor Default Width', 'HTML_AREA_WYSIWYG_EDITOR_WIDTH', '550', 'How WIDE should the HTMLAREA be in pixels (default: 550)', 112, 66, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1203, 'Admin Editor Default Height', 'HTML_AREA_WYSIWYG_EDITOR_HEIGHT', '300', 'How HIGH should the HTMLAREA be in pixels (default: 300)', 112, 67, '2003-07-17 12:41:25', '2003-07-17 12:41:25', NULL, '');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1204, 'E-Mail Address', 'AFFILIATE_EMAIL_ADDRESS', '<affiliate@localhost.com>', 'The E Mail Address for the Affiliate Program', 900, 1, NULL, '2008-04-13 13:57:56', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1205, 'Affiliate Pay Per Sale Payment % Rate', 'AFFILIATE_PERCENT', '10.0000', 'Percentage Rate for the Affiliate Program', 900, 2, NULL, '2008-04-13 13:57:56', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1206, 'Payment Threshold', 'AFFILIATE_THRESHOLD', '50.00', 'Payment Threshold for paying affiliates', 900, 3, NULL, '2008-04-13 13:57:56', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1207, 'Cookie Lifetime', 'AFFILIATE_COOKIE_LIFETIME', '7200', 'How long does the click count (seconds) if customer comes back', 900, 4, NULL, '2008-04-13 13:57:56', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1208, 'Billing Time', 'AFFILIATE_BILLING_TIME', '30', 'Orders billed must be at least "30" days old.<br>This is needed if a order is refunded', 900, 5, NULL, '2008-04-13 13:57:56', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1209, 'Order Min Status', 'AFFILIATE_PAYMENT_ORDER_MIN_STATUS', '3', 'The status an order must have at least, to be billed', 900, 6, NULL, '2008-04-13 13:57:56', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1210, 'Pay Affiliates with check', 'AFFILIATE_USE_CHECK', 'true', 'Pay Affiliates with check', 900, 7, NULL, '2008-04-13 13:57:56', NULL, 'tep_cfg_select_option(array(''true'', ''false''), ');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1211, 'Pay Affiliates with PayPal', 'AFFILIATE_USE_PAYPAL', 'true', 'Pay Affiliates with PayPal', 900, 8, NULL, '2008-04-13 13:57:56', NULL, 'tep_cfg_select_option(array(''true'', ''false''), ');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1212, 'Pay Affiliates by Bank', 'AFFILIATE_USE_BANK', 'true', 'Pay Affiliates by Bank', 900, 9, NULL, '2008-04-13 13:57:56', NULL, 'tep_cfg_select_option(array(''true'', ''false''), ');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1213, 'Individual Affiliate Percentage', 'AFFILATE_INDIVIDUAL_PERCENTAGE', 'true', 'Allow per Affiliate provision', 900, 10, NULL, '2008-04-13 13:57:56', NULL, 'tep_cfg_select_option(array(''true'', ''false''), ');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1214, 'Use Affiliate-tier', 'AFFILATE_USE_TIER', 'false', 'Multilevel Affiliate provisions', 900, 11, NULL, '2008-04-13 13:57:56', NULL, 'tep_cfg_select_option(array(''true'', ''false''), ');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1215, 'Number of Tierlevels', 'AFFILIATE_TIER_LEVELS', '0', 'Number of Tierlevels', 900, 12, NULL, '2008-04-13 13:57:56', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1216, 'Percentage Rate for the Tierlevels', 'AFFILIATE_TIER_PERCENTAGE', '8.00;5.00;1.00', 'Percent Rates for the tierlevels<br>Example: 8.00;5.00;1.00', 900, 13, NULL, '2008-04-13 13:57:56', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1217, 'Affiliate News', 'MAX_DISPLAY_AFFILIATE_NEWS', '3', 'Maximum number of items to display on the Affiliate News page', 900, 14, NULL, '2008-04-13 13:57:56', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1391, 'Enable PayPal Express Checkout', 'MODULE_PAYMENT_PAYPAL_EXPRESS_STATUS', 'True', 'Do you want to accept PayPal Express Checkout payments?', 6, 1, NULL, '2008-05-03 09:20:33', NULL, 'tep_cfg_select_option(array(''True'', ''False''), ');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1390, 'cURL Program Location', 'MODULE_PAYMENT_PAYPAL_DIRECT_CURL', '', 'The location to the cURL program application.', 6, 0, NULL, '2008-05-03 09:19:32', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1388, 'Sort order of display.', 'MODULE_PAYMENT_PAYPAL_DIRECT_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', 6, 0, NULL, '2008-05-03 09:19:32', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1389, 'Set Order Status', 'MODULE_PAYMENT_PAYPAL_DIRECT_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value.', 6, 0, NULL, '2008-05-03 09:19:32', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1387, 'Payment Zone', 'MODULE_PAYMENT_PAYPAL_DIRECT_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', 6, 2, NULL, '2008-05-03 09:19:32', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1386, 'Card Acceptance Page', 'MODULE_PAYMENT_PAYPAL_DIRECT_CARD_INPUT_PAGE', 'Confirmation', 'The location to accept card information. Either on the Checkout Confirmation page or the Checkout Payment page.', 6, 0, NULL, '2008-05-03 09:19:32', NULL, 'tep_cfg_select_option(array(''Confirmation'', ''Payment''), ');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1384, 'Transaction Server', 'MODULE_PAYMENT_PAYPAL_DIRECT_TRANSACTION_SERVER', 'Sandbox', 'Use the live or testing (sandbox) gateway server to process transactions?', 6, 0, NULL, '2008-05-03 09:19:32', NULL, 'tep_cfg_select_option(array(''Live'', ''Sandbox''), ');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1385, 'Transaction Method', 'MODULE_PAYMENT_PAYPAL_DIRECT_TRANSACTION_METHOD', 'Sale', 'The processing method to use for each transaction.', 6, 0, NULL, '2008-05-03 09:19:32', NULL, 'tep_cfg_select_option(array(''Authorization'', ''Sale''), ');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1382, 'API Password', 'MODULE_PAYMENT_PAYPAL_DIRECT_API_PASSWORD', '1209834503', 'The password to use for the PayPal API service.', 6, 0, NULL, '2008-05-03 09:19:32', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1383, 'API Signature', 'MODULE_PAYMENT_PAYPAL_DIRECT_API_SIGNATURE', 'AYoXlSOZcg-yQ90OkFYbGyDMexorAoPVRP16HtItNkdDv5o0qaochFCh', 'The signature to use for the PayPal API service.', 6, 0, NULL, '2008-05-03 09:19:32', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1381, 'API Username', 'MODULE_PAYMENT_PAYPAL_DIRECT_API_USERNAME', 'admin_1209834493_biz_api1.aabox.com', 'The username to use for the PayPal API service.', 6, 0, NULL, '2008-05-03 09:19:32', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1306, 'Allow the use of AJAX to update order information?', 'ORDER_EDITOR_USE_AJAX', 'true', 'This must be set to false if using a browser on which JavaScript is disabled or not available.', 72, 4, '2008-04-27 07:07:40', '2008-04-27 07:07:40', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1307, 'Select your credit card payment method', 'ORDER_EDITOR_CREDIT_CARD', 'Credit Card', 'Order Editor will display the credit card fields when this payment method is selected.', 72, 5, '2008-04-27 07:07:40', '2008-04-27 07:07:40', NULL, 'tep_cfg_pull_down_payment_methods(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1393, 'API Password', 'MODULE_PAYMENT_PAYPAL_EXPRESS_API_PASSWORD', '1209834503', 'The password to use for the PayPal API service', 6, 0, NULL, '2008-05-03 09:20:33', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1294, 'Wishlist Redirect', 'WISHLIST_REDIRECT', 'No', 'Do you want to redirect back to the product_info.php page when a customer adds a product to their wishlist?', 12954, 0, '2008-04-13 20:07:42', '2008-04-13 20:07:42', NULL, 'tep_cfg_select_option(array(''Yes'', ''No''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1293, 'Display Emails', 'DISPLAY_WISHLIST_EMAILS', '10', 'How many emails to display when the customer emails their wishlist link', 12954, 0, '2008-04-13 20:07:42', '2008-04-13 20:07:42', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1292, 'Max Wish List Box', 'MAX_DISPLAY_WISHLIST_BOX', '4', 'How many wish list items to display in the infobox before it changes to a counter', 12954, 0, '2008-04-13 20:07:42', '2008-04-13 20:07:42', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1291, 'Max Wish List', 'MAX_DISPLAY_WISHLIST_PRODUCTS', '12', 'How many wish list items to show per page on the main wishlist.php file', 12954, 0, '2008-04-13 20:07:42', '2008-04-13 20:07:42', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1305, 'Use prices from Separate Pricing Per Customer?', 'ORDER_EDITOR_USE_SPPC', 'false', 'Leave this set at false unless SPPC is installed.', 72, 3, '2008-04-27 07:07:40', '2008-04-27 07:07:40', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1304, 'Display the Payment Method dropdown?', 'ORDER_EDITOR_PAYMENT_DROPDOWN', 'true', 'Based on this selection Order Editor will display the payment method as a dropdown menu (true) or as an input field (false).', 72, 1, '2008-04-27 07:07:40', '2008-04-27 07:07:40', NULL, 'tep_cfg_select_option(array(''true'', ''false''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1392, 'API Username', 'MODULE_PAYMENT_PAYPAL_EXPRESS_API_USERNAME', 'admin_1209834493_biz_api1.aabox.com', 'The username to use for the PayPal API service', 6, 0, NULL, '2008-05-03 09:20:33', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1380, 'Enable PayPal Direct', 'MODULE_PAYMENT_PAYPAL_DIRECT_STATUS', 'True', 'Do you want to accept PayPal Direct payments?', 6, 1, NULL, '2008-05-03 09:19:32', NULL, 'tep_cfg_select_option(array(''True'', ''False''), ');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1450, 'Purchase without account shippingaddress', 'PURCHASE_WITHOUT_ACCOUNT_SEPARATE_SHIPPING', 'yes', 'Do you allow customers without account to create separately shipping address?', 5, 11, NULL, '2008-05-03 22:52:34', NULL, 'tep_cfg_select_option(array(''yes'', ''no''), ');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1449, 'Purchase without account', 'PURCHASE_WITHOUT_ACCOUNT', 'yes', 'Do you allow customers to purchase without an account?', 5, 10, NULL, '2008-05-03 22:52:34', NULL, 'tep_cfg_select_option(array(''yes'', ''no''), ');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1448, 'Set Order Status', 'MODULE_PAYMENT_CC_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', 6, 0, NULL, '2008-05-03 22:50:06', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1446, 'Sort order of display.', 'MODULE_PAYMENT_CC_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', 6, 0, NULL, '2008-05-03 22:50:06', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1447, 'Payment Zone', 'MODULE_PAYMENT_CC_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', 6, 2, NULL, '2008-05-03 22:50:06', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1445, 'Split Credit Card E-Mail Address', 'MODULE_PAYMENT_CC_EMAIL', '', 'If an e-mail address is entered, the middle digits of the credit card number will be sent to the e-mail address (the outside digits are stored in the database with the middle digits censored)', 6, 0, NULL, '2008-05-03 22:50:06', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1444, 'Enable Credit Card Module', 'MODULE_PAYMENT_CC_STATUS', 'True', 'Do you want to accept credit card payments?', 6, 0, NULL, '2008-05-03 22:50:06', NULL, 'tep_cfg_select_option(array(''True'', ''False''), ');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1395, 'Transaction Server', 'MODULE_PAYMENT_PAYPAL_EXPRESS_TRANSACTION_SERVER', 'Sandbox', 'Use the live or testing (sandbox) gateway server to process transactions?', 6, 0, NULL, '2008-05-03 09:20:33', NULL, 'tep_cfg_select_option(array(''Live'', ''Sandbox''), ');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1400, 'cURL Program Location', 'MODULE_PAYMENT_PAYPAL_EXPRESS_CURL', '', 'The location to the cURL program application.', 6, 0, NULL, '2008-05-03 09:20:33', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1398, 'Sort order of display.', 'MODULE_PAYMENT_PAYPAL_EXPRESS_SORT_ORDER', '0', 'Sort order of display. Lowest is displayed first.', 6, 0, NULL, '2008-05-03 09:20:33', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1399, 'Set Order Status', 'MODULE_PAYMENT_PAYPAL_EXPRESS_ORDER_STATUS_ID', '0', 'Set the status of orders made with this payment module to this value', 6, 0, NULL, '2008-05-03 09:20:33', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1397, 'Payment Zone', 'MODULE_PAYMENT_PAYPAL_EXPRESS_ZONE', '0', 'If a zone is selected, only enable this payment method for that zone.', 6, 2, NULL, '2008-05-03 09:20:33', 'tep_get_zone_class_title', 'tep_cfg_pull_down_zone_classes(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1396, 'Transaction Method', 'MODULE_PAYMENT_PAYPAL_EXPRESS_TRANSACTION_METHOD', 'Sale', 'The processing method to use for each transaction.', 6, 0, NULL, '2008-05-03 09:20:33', NULL, 'tep_cfg_select_option(array(''Authorization'', ''Sale''), ');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1421, 'Google Checkout Module Version', 'MODULE_PAYMENT_GOOGLECHECKOUT_VERSION', 'osCMax v1.4.5_CCS', 'Version of the installed Module', 6, 0, NULL, '2008-05-03 19:59:56', NULL, 'tep_cfg_select_option(array(''osCMax v1.4.5_CCS''), ');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1422, 'Enable GoogleCheckout Module', 'MODULE_PAYMENT_GOOGLECHECKOUT_STATUS', 'True', 'Accepts payments through Google Checkout on your site', 6, 3, NULL, '2008-05-03 19:59:56', NULL, 'tep_cfg_select_option(array(''True'', ''False''), ');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1423, 'Select Mode of Operation', 'MODULE_PAYMENT_GOOGLECHECKOUT_MODE', 'https://sandbox.google.com/checkout/', 'Select either the Developer''s Sandbox or live Production environment<br />Note that different Id/Key pair will be used depending on the environment selected', 6, 3, NULL, '2008-05-03 19:59:56', NULL, 'tep_cfg_select_option(array(''https://sandbox.google.com/checkout/'', ''https://checkout.google.com/''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1424, 'Production Merchant ID', 'MODULE_PAYMENT_GOOGLECHECKOUT_MERCHANTID', '', 'Your merchant ID is listed on the "Integration" page under the "Settings" tab', 6, 1, NULL, '2008-05-03 19:59:56', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1425, 'Production Merchant Key', 'MODULE_PAYMENT_GOOGLECHECKOUT_MERCHANTKEY', '', 'Your merchant key is also listed on the "Integration" page under the "Settings" tab', 6, 2, NULL, '2008-05-03 19:59:56', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1426, 'Sandbox Merchant ID', 'MODULE_PAYMENT_GOOGLECHECKOUT_MERCHANTID_SNDBOX', '152381248163249', 'Your merchant ID is listed on the "Integration" page under the "Settings" tab', 6, 1, NULL, '2008-05-03 19:59:56', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1427, 'Sandbox Merchant Key', 'MODULE_PAYMENT_GOOGLECHECKOUT_MERCHANTKEY_SNDBOX', 'H4SOuyQDtasUOJxmYCrIZw', 'Your merchant key is also listed on the "Integration" page under the "Settings" tab', 6, 2, NULL, '2008-05-03 19:59:56', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1428, '.htaccess Basic Authentication Mode', 'MODULE_PAYMENT_GOOGLECHECKOUT_CGI', 'False', 'Your site Site in installed with PHP over CGI? <br /> This configuration will <b>disable</b> PHP Basic Authentication that is NOT compatible with CGI used in the responsehandler.php to validate Google Checkout messages.<br />If setted True you MUST config', 6, 4, NULL, '2008-05-03 19:59:56', NULL, 'tep_cfg_select_option(array(''False'', ''True''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1429, 'Disable Google Checkout for Virtual Goods?', 'MODULE_PAYMENT_GOOGLECHECKOUT_VIRTUAL_GOODS', 'False', 'If this configuration is enabled and there is any virtual good in the cart the Google Checkout button will be shown disabled.', 6, 4, NULL, '2008-05-03 19:59:56', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1430, 'Allow US PO BOX shipping?', 'MODULE_PAYMENT_GOOGLECHECKOUT_USPOBOX', 'False', 'Allow sending items to US PO Boxes?', 6, 4, NULL, '2008-05-03 19:59:56', NULL, 'tep_cfg_select_option(array(''True'', ''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1431, 'Select Merchant Calculation Mode of Operation', 'MODULE_PAYMENT_GOOGLECHECKOUT_MC_MODE', 'https', 'Merchant calculation URL for Sandbox environment. (Checkout production environemnt always requires HTTPS.)', 6, 4, NULL, '2008-05-03 19:59:56', NULL, 'tep_cfg_select_option(array(''http'', ''https''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1432, 'Default Values for Real Time Shipping Rates', 'MODULE_PAYMENT_GOOGLECHECKOUT_SHIPPING', '', 'Default values for real time rates in case the webservice call fails.<br />Set <b>Default Value</b> to <b>0</b> to disable the method <br/><a href="../googlecheckout/shipping_generator/">Shipping Generator</a>', 6, 0, NULL, '2008-05-03 19:59:56', NULL, 'gc_cfg_select_shipping(array(''not''), ');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1433, 'GoogleCheckout Carrier Calculated Shipping', 'MODULE_PAYMENT_GOOGLECHECKOUT_CARRIER_CALCULATED_ENABLED', 'True', 'Do you want to use GC Carrier calculated shipping? This feature can be mixed with Flat Rate Shipping, but not Merchant Calculated.', 6, 4, NULL, '2008-05-03 19:59:56', NULL, 'tep_cfg_select_option(array(''True'',''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1434, 'Carrier Calculater Shipping Configuration', 'MODULE_PAYMENT_GOOGLECHECKOUT_CARRIER_CALCULATED', 'fedexGrounddomestic_types_CCS:1.00|0|0, fedexHome Deliverydomestic_types_CCS:1.00|0|0, fedexExpress Saverdomestic_types_CCS:1.00|0|0, fedex2Daydomestic_types_CCS:1.00|0|0, fedexStandard Overnightdomestic_types_CCS:1.00|0|0, fedexPriority Overnightdomestic_types_CCS:1.00|0|0, fedexFirst Overnightdomestic_types_CCS:1.00|0|0, upsGrounddomestic_types_CCS:1.00|0|0, ups3 Day Selectdomestic_types_CCS:1.00|0|0, ups2nd Day Airdomestic_types_CCS:1.00|0|0, upsNext Day Air Saverdomestic_types_CCS:1.00|0|0, upsNext Day Airdomestic_types_CCS:1.00|0|0, upsNext Day Air Early AMdomestic_types_CCS:1.00|0|0, uspsMedia Maildomestic_types_CCS:1.00|0|0, uspsParcel Postdomestic_types_CCS:1.00|0|0, uspsExpress Maildomestic_types_CCS:1.00|0|0', 'Set Default Values, Fix and Variable charge<br />Set <b>Def. Value</b> to <b>0</b> to disable the method', 6, 5, NULL, '2008-05-03 19:59:56', NULL, 'gc_cfg_select_CCshipping(');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1435, 'Rounding Policy Mode', 'MODULE_PAYMENT_GOOGLECHECKOUT_TAXMODE', 'HALF_EVEN', 'This configuration specifies the methodology that will be used to round values to two decimal places. <a href="http://code.google.com/apis/checkout/developer/Google_Checkout_Rounding_Policy.html">More info</a>', 6, 4, NULL, '2008-05-03 19:59:56', NULL, 'tep_cfg_select_option(array(''UP'',''DOWN'',''CEILING'',''HALF_UP'',''HALF_DOWN'', ''HALF_EVEN''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1436, 'Rounding Policy Rule', 'MODULE_PAYMENT_GOOGLECHECKOUT_TAXRULE', 'PER_LINE', 'This configuration specifies when rounding rules should be applied to monetary values while Google Checkout is computing an order total.', 6, 4, NULL, '2008-05-03 19:59:56', NULL, 'tep_cfg_select_option(array(''PER_LINE'',''TOTAL''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1437, 'Cart Expiration Time (Minutes)', 'MODULE_PAYMENT_GOOGLECHECKOUT_EXPIRATION', 'NONE', 'Set the time in minutes after which the cart will expire. NONE for no-expiration', 6, 1, NULL, '2008-05-03 19:59:56', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1438, 'Also send notifications with OSC', 'MODULE_PAYMENT_GOOGLECHECKOUT_USE_CART_MESSAGING', 'False', 'Do you also want to send notifications to buyers using OSC''s mailing system?', 6, 4, NULL, '2008-05-03 19:59:56', NULL, 'tep_cfg_select_option(array(''True'',''False''),');
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1439, 'Google Analytics Id', 'MODULE_PAYMENT_GOOGLECHECKOUT_ANALYTICS', 'NONE', 'Do you want to integrate the module with Google Analytics? Add your GA Id (UA-XXXXXX-X), NONE to disable. <br/> More info <a href=''http://code.google.com/apis/checkout/developer/checkout_analytics_integration.html''>here</a>', 6, 1, NULL, '2008-05-03 19:59:56', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1440, '3rd Party Tracking', 'MODULE_PAYMENT_GOOGLECHECKOUT_3RD_PARTY_TRACKING', 'NONE', 'Do you want to integrate the module 3rd party tracking? Add the tracker URL, NONE to disable. <br/> More info <a href=''http://code.google.com/apis/checkout/developer/checkout_pixel_tracking.html''>here</a>', 6, 1, NULL, '2008-05-03 19:59:56', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1441, 'Google Checkout restricted product categories', 'MODULE_PAYMENT_GOOGLECHECKOUT_RESTRICTED_CATEGORIES', '', 'Specify the ids separated by commas '','' of the product categories for which the GC button should be disabled.<br />Check <a href="http://checkout.google.com/support/sell/bin/answer.py?answer=46174&topic=8681">Google Policy</a>', 6, 8, NULL, '2008-05-03 19:59:56', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1442, 'Continue shopping URL.', 'MODULE_PAYMENT_GOOGLECHECKOUT_CONTINUE_URL', 'checkout_success.php', 'Specify the page customers will be directed to if they choose to continue shopping after checkout.', 6, 8, NULL, '2008-05-03 19:59:56', NULL, NULL);
INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES(1443, 'Sort order of display.', 'MODULE_PAYMENT_GOOGLECHECKOUT_SORT_ORDER', '5', 'Sort order of display. Lowest is displayed first.', 6, 0, NULL, '2008-05-03 19:59:56', NULL, NULL);


DROP TABLE IF EXISTS configuration_group;
CREATE TABLE configuration_group (
  configuration_group_id int(11) NOT NULL auto_increment,
  configuration_group_title varchar(64) NOT NULL,
  configuration_group_description varchar(255) NOT NULL,
  sort_order int(5) default NULL,
  visible int(1) default '1',
  PRIMARY KEY  (configuration_group_id)
) TYPE=MyISAM ;


INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(1, 'My Store', 'General information about my store', 1, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(2, 'Minimum Values', 'The minimum values for functions / data', 2, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(3, 'Maximum Values', 'The maximum values for functions / data', 3, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(4, 'Images', 'Image parameters', 4, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(5, 'Customer Details', 'Customer account configuration', 5, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(6, 'Module Options', 'Hidden from configuration', 6, 0);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(7, 'Shipping/Packaging', 'Shipping options available at my store', 7, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(8, 'Product Listing', 'Product Listing    configuration options', 8, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(9, 'Stock', 'Stock configuration options', 9, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(10, 'Logging', 'Logging configuration options', 10, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(11, 'Cache', 'Caching configuration options', 11, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(12, 'E-Mail Options', 'General setting for E-Mail transport and HTML E-Mails', 12, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(13, 'Download', 'Downloadable products options', 13, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(14, 'GZip Compression', 'GZip compression options', 14, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(15, 'Sessions', 'Session options', 15, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(112, 'WYSIWYG Editor 1.7', 'HTMLArea 1.7 Options', 15, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(900, 'Affiliate Program', 'Options for the Affiliate Program', 50, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(901, 'Dynamic MoPics', 'The options which configure Dynamic MoPics.', 901, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(899, 'Printable Catalog', 'Options for Printable Catalog', 899, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(16, 'Site Maintenance', 'Site Maintenance Options', 16, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(40, 'Accounts', 'Configuration of Account settings', 40, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(888001, 'Product Information', 'Product Information page configuration options', 8, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(26229, 'Page Cache Settings', 'Settings for the page cache contribution', 20, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(888002, 'SEO URLs', 'Options for Ultimate SEO URLs by Chemo', 902, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(12954, 'Wish List Settings', 'Settings for your Wish List', 25, 1);
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES(888003, 'Order Editor', 'Configuration options for Order Editor', 903, 1);
DROP TABLE IF EXISTS counter;
CREATE TABLE counter (
  startdate char(8) default NULL,
  counter int(12) default NULL
) TYPE=MyISAM;


DROP TABLE IF EXISTS counter_history;
CREATE TABLE counter_history (
  `month` char(8) default NULL,
  counter int(12) default NULL
) TYPE=MyISAM;


DROP TABLE IF EXISTS countries;
CREATE TABLE countries (
  countries_id int(11) NOT NULL auto_increment,
  countries_name varchar(64) NOT NULL,
  countries_iso_code_2 char(2) NOT NULL,
  countries_iso_code_3 char(3) NOT NULL,
  address_format_id int(11) NOT NULL default '0',
  PRIMARY KEY  (countries_id),
  KEY IDX_COUNTRIES_NAME (countries_name)
) TYPE=MyISAM ;


INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(1, 'Afghanistan', 'AF', 'AFG', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(2, 'Albania', 'AL', 'ALB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(3, 'Algeria', 'DZ', 'DZA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(4, 'American Samoa', 'AS', 'ASM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(5, 'Andorra', 'AD', 'AND', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(6, 'Angola', 'AO', 'AGO', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(7, 'Anguilla', 'AI', 'AIA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(8, 'Antarctica', 'AQ', 'ATA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(9, 'Antigua and Barbuda', 'AG', 'ATG', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(10, 'Argentina', 'AR', 'ARG', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(11, 'Armenia', 'AM', 'ARM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(12, 'Aruba', 'AW', 'ABW', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(13, 'Australia', 'AU', 'AUS', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(14, 'Austria', 'AT', 'AUT', 5);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(15, 'Azerbaijan', 'AZ', 'AZE', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(16, 'Bahamas', 'BS', 'BHS', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(17, 'Bahrain', 'BH', 'BHR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(18, 'Bangladesh', 'BD', 'BGD', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(19, 'Barbados', 'BB', 'BRB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(20, 'Belarus', 'BY', 'BLR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(21, 'Belgium', 'BE', 'BEL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(22, 'Belize', 'BZ', 'BLZ', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(23, 'Benin', 'BJ', 'BEN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(24, 'Bermuda', 'BM', 'BMU', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(25, 'Bhutan', 'BT', 'BTN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(26, 'Bolivia', 'BO', 'BOL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(27, 'Bosnia and Herzegowina', 'BA', 'BIH', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(28, 'Botswana', 'BW', 'BWA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(29, 'Bouvet Island', 'BV', 'BVT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(30, 'Brazil', 'BR', 'BRA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(31, 'British Indian Ocean Territory', 'IO', 'IOT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(32, 'Brunei Darussalam', 'BN', 'BRN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(33, 'Bulgaria', 'BG', 'BGR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(34, 'Burkina Faso', 'BF', 'BFA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(35, 'Burundi', 'BI', 'BDI', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(36, 'Cambodia', 'KH', 'KHM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(37, 'Cameroon', 'CM', 'CMR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(38, 'Canada', 'CA', 'CAN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(39, 'Cape Verde', 'CV', 'CPV', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(40, 'Cayman Islands', 'KY', 'CYM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(41, 'Central African Republic', 'CF', 'CAF', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(42, 'Chad', 'TD', 'TCD', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(43, 'Chile', 'CL', 'CHL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(44, 'China', 'CN', 'CHN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(45, 'Christmas Island', 'CX', 'CXR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(46, 'Cocos (Keeling) Islands', 'CC', 'CCK', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(47, 'Colombia', 'CO', 'COL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(48, 'Comoros', 'KM', 'COM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(49, 'Congo', 'CG', 'COG', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(50, 'Cook Islands', 'CK', 'COK', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(51, 'Costa Rica', 'CR', 'CRI', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(52, 'Cote D''Ivoire', 'CI', 'CIV', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(53, 'Croatia', 'HR', 'HRV', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(54, 'Cuba', 'CU', 'CUB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(55, 'Cyprus', 'CY', 'CYP', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(56, 'Czech Republic', 'CZ', 'CZE', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(57, 'Denmark', 'DK', 'DNK', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(58, 'Djibouti', 'DJ', 'DJI', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(59, 'Dominica', 'DM', 'DMA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(60, 'Dominican Republic', 'DO', 'DOM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(61, 'East Timor', 'TP', 'TMP', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(62, 'Ecuador', 'EC', 'ECU', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(63, 'Egypt', 'EG', 'EGY', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(64, 'El Salvador', 'SV', 'SLV', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(65, 'Equatorial Guinea', 'GQ', 'GNQ', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(66, 'Eritrea', 'ER', 'ERI', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(67, 'Estonia', 'EE', 'EST', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(68, 'Ethiopia', 'ET', 'ETH', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(69, 'Falkland Islands (Malvinas)', 'FK', 'FLK', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(70, 'Faroe Islands', 'FO', 'FRO', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(71, 'Fiji', 'FJ', 'FJI', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(72, 'Finland', 'FI', 'FIN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(73, 'France', 'FR', 'FRA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(74, 'France, Metropolitan', 'FX', 'FXX', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(75, 'French Guiana', 'GF', 'GUF', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(76, 'French Polynesia', 'PF', 'PYF', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(77, 'French Southern Territories', 'TF', 'ATF', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(78, 'Gabon', 'GA', 'GAB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(79, 'Gambia', 'GM', 'GMB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(80, 'Georgia', 'GE', 'GEO', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(81, 'Germany', 'DE', 'DEU', 5);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(82, 'Ghana', 'GH', 'GHA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(83, 'Gibraltar', 'GI', 'GIB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(84, 'Greece', 'GR', 'GRC', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(85, 'Greenland', 'GL', 'GRL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(86, 'Grenada', 'GD', 'GRD', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(87, 'Guadeloupe', 'GP', 'GLP', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(88, 'Guam', 'GU', 'GUM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(89, 'Guatemala', 'GT', 'GTM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(90, 'Guinea', 'GN', 'GIN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(91, 'Guinea-bissau', 'GW', 'GNB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(92, 'Guyana', 'GY', 'GUY', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(93, 'Haiti', 'HT', 'HTI', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(94, 'Heard and Mc Donald Islands', 'HM', 'HMD', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(95, 'Honduras', 'HN', 'HND', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(96, 'Hong Kong', 'HK', 'HKG', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(97, 'Hungary', 'HU', 'HUN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(98, 'Iceland', 'IS', 'ISL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(99, 'India', 'IN', 'IND', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(100, 'Indonesia', 'ID', 'IDN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(101, 'Iran (Islamic Republic of)', 'IR', 'IRN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(102, 'Iraq', 'IQ', 'IRQ', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(103, 'Ireland', 'IE', 'IRL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(104, 'Israel', 'IL', 'ISR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(105, 'Italy', 'IT', 'ITA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(106, 'Jamaica', 'JM', 'JAM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(107, 'Japan', 'JP', 'JPN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(108, 'Jordan', 'JO', 'JOR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(109, 'Kazakhstan', 'KZ', 'KAZ', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(110, 'Kenya', 'KE', 'KEN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(111, 'Kiribati', 'KI', 'KIR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(112, 'Korea, Democratic People''s Republic of', 'KP', 'PRK', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(113, 'Korea, Republic of', 'KR', 'KOR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(114, 'Kuwait', 'KW', 'KWT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(115, 'Kyrgyzstan', 'KG', 'KGZ', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(116, 'Lao People''s Democratic Republic', 'LA', 'LAO', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(117, 'Latvia', 'LV', 'LVA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(118, 'Lebanon', 'LB', 'LBN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(119, 'Lesotho', 'LS', 'LSO', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(120, 'Liberia', 'LR', 'LBR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(121, 'Libyan Arab Jamahiriya', 'LY', 'LBY', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(122, 'Liechtenstein', 'LI', 'LIE', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(123, 'Lithuania', 'LT', 'LTU', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(124, 'Luxembourg', 'LU', 'LUX', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(125, 'Macau', 'MO', 'MAC', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(126, 'Macedonia, The Former Yugoslav Republic of', 'MK', 'MKD', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(127, 'Madagascar', 'MG', 'MDG', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(128, 'Malawi', 'MW', 'MWI', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(129, 'Malaysia', 'MY', 'MYS', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(130, 'Maldives', 'MV', 'MDV', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(131, 'Mali', 'ML', 'MLI', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(132, 'Malta', 'MT', 'MLT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(133, 'Marshall Islands', 'MH', 'MHL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(134, 'Martinique', 'MQ', 'MTQ', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(135, 'Mauritania', 'MR', 'MRT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(136, 'Mauritius', 'MU', 'MUS', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(137, 'Mayotte', 'YT', 'MYT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(138, 'Mexico', 'MX', 'MEX', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(139, 'Micronesia, Federated States of', 'FM', 'FSM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(140, 'Moldova, Republic of', 'MD', 'MDA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(141, 'Monaco', 'MC', 'MCO', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(142, 'Mongolia', 'MN', 'MNG', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(143, 'Montserrat', 'MS', 'MSR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(144, 'Morocco', 'MA', 'MAR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(145, 'Mozambique', 'MZ', 'MOZ', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(146, 'Myanmar', 'MM', 'MMR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(147, 'Namibia', 'NA', 'NAM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(148, 'Nauru', 'NR', 'NRU', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(149, 'Nepal', 'NP', 'NPL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(150, 'Netherlands', 'NL', 'NLD', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(151, 'Netherlands Antilles', 'AN', 'ANT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(152, 'New Caledonia', 'NC', 'NCL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(153, 'New Zealand', 'NZ', 'NZL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(154, 'Nicaragua', 'NI', 'NIC', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(155, 'Niger', 'NE', 'NER', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(156, 'Nigeria', 'NG', 'NGA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(157, 'Niue', 'NU', 'NIU', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(158, 'Norfolk Island', 'NF', 'NFK', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(159, 'Northern Mariana Islands', 'MP', 'MNP', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(160, 'Norway', 'NO', 'NOR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(161, 'Oman', 'OM', 'OMN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(162, 'Pakistan', 'PK', 'PAK', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(163, 'Palau', 'PW', 'PLW', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(164, 'Panama', 'PA', 'PAN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(165, 'Papua New Guinea', 'PG', 'PNG', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(166, 'Paraguay', 'PY', 'PRY', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(167, 'Peru', 'PE', 'PER', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(168, 'Philippines', 'PH', 'PHL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(169, 'Pitcairn', 'PN', 'PCN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(170, 'Poland', 'PL', 'POL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(171, 'Portugal', 'PT', 'PRT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(172, 'Puerto Rico', 'PR', 'PRI', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(173, 'Qatar', 'QA', 'QAT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(174, 'Reunion', 'RE', 'REU', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(175, 'Romania', 'RO', 'ROM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(176, 'Russian Federation', 'RU', 'RUS', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(177, 'Rwanda', 'RW', 'RWA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(178, 'Saint Kitts and Nevis', 'KN', 'KNA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(179, 'Saint Lucia', 'LC', 'LCA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(180, 'Saint Vincent and the Grenadines', 'VC', 'VCT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(181, 'Samoa', 'WS', 'WSM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(182, 'San Marino', 'SM', 'SMR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(183, 'Sao Tome and Principe', 'ST', 'STP', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(184, 'Saudi Arabia', 'SA', 'SAU', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(185, 'Senegal', 'SN', 'SEN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(186, 'Seychelles', 'SC', 'SYC', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(187, 'Sierra Leone', 'SL', 'SLE', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(188, 'Singapore', 'SG', 'SGP', 4);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(189, 'Slovakia (Slovak Republic)', 'SK', 'SVK', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(190, 'Slovenia', 'SI', 'SVN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(191, 'Solomon Islands', 'SB', 'SLB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(192, 'Somalia', 'SO', 'SOM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(193, 'South Africa', 'ZA', 'ZAF', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(194, 'South Georgia and the South Sandwich Islands', 'GS', 'SGS', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(195, 'Spain', 'ES', 'ESP', 3);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(196, 'Sri Lanka', 'LK', 'LKA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(197, 'St. Helena', 'SH', 'SHN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(198, 'St. Pierre and Miquelon', 'PM', 'SPM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(199, 'Sudan', 'SD', 'SDN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(200, 'Suriname', 'SR', 'SUR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(201, 'Svalbard and Jan Mayen Islands', 'SJ', 'SJM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(202, 'Swaziland', 'SZ', 'SWZ', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(203, 'Sweden', 'SE', 'SWE', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(204, 'Switzerland', 'CH', 'CHE', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(205, 'Syrian Arab Republic', 'SY', 'SYR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(206, 'Taiwan', 'TW', 'TWN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(207, 'Tajikistan', 'TJ', 'TJK', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(208, 'Tanzania, United Republic of', 'TZ', 'TZA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(209, 'Thailand', 'TH', 'THA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(210, 'Togo', 'TG', 'TGO', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(211, 'Tokelau', 'TK', 'TKL', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(212, 'Tonga', 'TO', 'TON', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(213, 'Trinidad and Tobago', 'TT', 'TTO', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(214, 'Tunisia', 'TN', 'TUN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(215, 'Turkey', 'TR', 'TUR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(216, 'Turkmenistan', 'TM', 'TKM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(217, 'Turks and Caicos Islands', 'TC', 'TCA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(218, 'Tuvalu', 'TV', 'TUV', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(219, 'Uganda', 'UG', 'UGA', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(220, 'Ukraine', 'UA', 'UKR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(221, 'United Arab Emirates', 'AE', 'ARE', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(222, 'United Kingdom', 'GB', 'GBR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(223, 'United States', 'US', 'USA', 2);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(224, 'United States Minor Outlying Islands', 'UM', 'UMI', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(225, 'Uruguay', 'UY', 'URY', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(226, 'Uzbekistan', 'UZ', 'UZB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(227, 'Vanuatu', 'VU', 'VUT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(228, 'Vatican City State (Holy See)', 'VA', 'VAT', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(229, 'Venezuela', 'VE', 'VEN', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(230, 'Viet Nam', 'VN', 'VNM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(231, 'Virgin Islands (British)', 'VG', 'VGB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(232, 'Virgin Islands (U.S.)', 'VI', 'VIR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(233, 'Wallis and Futuna Islands', 'WF', 'WLF', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(234, 'Western Sahara', 'EH', 'ESH', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(235, 'Yemen', 'YE', 'YEM', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(236, 'Yugoslavia', 'YU', 'YUG', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(237, 'Zaire', 'ZR', 'ZAR', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(238, 'Zambia', 'ZM', 'ZMB', 1);
INSERT INTO countries (countries_id, countries_name, countries_iso_code_2, countries_iso_code_3, address_format_id) VALUES(239, 'Zimbabwe', 'ZW', 'ZWE', 1);
DROP TABLE IF EXISTS coupons;
CREATE TABLE coupons (
  coupon_id int(11) NOT NULL auto_increment,
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
  PRIMARY KEY  (coupon_id)
) TYPE=MyISAM;

DROP TABLE IF EXISTS coupons_description;
CREATE TABLE coupons_description (
  coupon_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '0',
  coupon_name varchar(32) NOT NULL,
  coupon_description text,
  KEY coupon_id (coupon_id)
) TYPE=MyISAM;
DROP TABLE IF EXISTS coupon_email_track;
CREATE TABLE coupon_email_track (
  unique_id int(11) NOT NULL auto_increment,
  coupon_id int(11) NOT NULL default '0',
  customer_id_sent int(11) NOT NULL default '0',
  sent_firstname varchar(32) default NULL,
  sent_lastname varchar(32) default NULL,
  emailed_to varchar(32) default NULL,
  date_sent datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (unique_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS coupon_gv_customer;
CREATE TABLE coupon_gv_customer (
  customer_id int(5) NOT NULL default '0',
  amount decimal(8,4) NOT NULL default '0.0000',
  PRIMARY KEY  (customer_id),
  KEY customer_id (customer_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS coupon_gv_queue;
CREATE TABLE coupon_gv_queue (
  unique_id int(5) NOT NULL auto_increment,
  customer_id int(5) NOT NULL default '0',
  order_id int(5) NOT NULL default '0',
  amount decimal(8,4) NOT NULL default '0.0000',
  date_created datetime NOT NULL default '0000-00-00 00:00:00',
  ipaddr varchar(32) NOT NULL,
  release_flag char(1) NOT NULL default 'N',
  PRIMARY KEY  (unique_id),
  KEY uid (unique_id,customer_id,order_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS coupon_redeem_track;
CREATE TABLE coupon_redeem_track (
  unique_id int(11) NOT NULL auto_increment,
  coupon_id int(11) NOT NULL default '0',
  customer_id int(11) NOT NULL default '0',
  redeem_date datetime NOT NULL default '0000-00-00 00:00:00',
  redeem_ip varchar(32) NOT NULL,
  order_id int(11) NOT NULL default '0',
  PRIMARY KEY  (unique_id)
) TYPE=MyISAM;

DROP TABLE IF EXISTS currencies;
CREATE TABLE currencies (
  currencies_id int(11) NOT NULL auto_increment,
  title varchar(32) NOT NULL,
  `code` char(3) NOT NULL,
  symbol_left varchar(12) default NULL,
  symbol_right varchar(12) default NULL,
  decimal_point char(1) default NULL,
  thousands_point char(1) default NULL,
  decimal_places char(1) default NULL,
  `value` float(13,8) default NULL,
  last_updated datetime default NULL,
  PRIMARY KEY  (currencies_id),
  KEY idx_currencies_code (`code`)
) TYPE=MyISAM ;


insert into currencies (currencies_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated) values ('1', 'US Dollar', 'USD', '$', '', '.', ',', '2', '1.00000000', '2005-09-18 11:09:20');
insert into currencies (currencies_id, title, code, symbol_left, symbol_right, decimal_point, thousands_point, decimal_places, value, last_updated) values ('2', 'Euro', 'EUR', '', 'EUR', '.', ',', '2', '0.81730002', '2005-09-18 11:09:20');
DROP TABLE IF EXISTS customers;
CREATE TABLE customers (
  customers_id int(11) NOT NULL auto_increment,
  purchased_without_account tinyint(1) unsigned NOT NULL default '0',
  customers_gender char(1) NOT NULL,
  customers_firstname varchar(32) NOT NULL,
  customers_lastname varchar(32) NOT NULL,
  customers_dob datetime NOT NULL default '0000-00-00 00:00:00',
  customers_email_address varchar(96) NOT NULL,
  customers_default_address_id int(11) NOT NULL default '0',
  customers_telephone varchar(32) NOT NULL,
  customers_fax varchar(32) default NULL,
  customers_password varchar(40) default NULL,
  customers_newsletter char(1) default NULL,
  customers_login varchar(96) default NULL,
  customers_group_name varchar(27) NOT NULL default 'Retail',
  customers_group_id int(11) NOT NULL default '0',
  customers_group_ra enum('0','1') NOT NULL default '0',
  customers_payment_allowed varchar(255) NOT NULL,
  customers_shipment_allowed varchar(255) NOT NULL,
  PRIMARY KEY  (customers_id),
  UNIQUE KEY idx_customers_login (customers_login),
  KEY purchased_without_account (purchased_without_account),
  KEY idx_customers_email_address (customers_email_address)
) TYPE=MyISAM ;


DROP TABLE IF EXISTS customers_basket;
CREATE TABLE customers_basket (
  customers_basket_id int(11) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default '0',
  products_id tinytext NOT NULL,
  customers_basket_quantity int(2) NOT NULL default '0',
  final_price decimal(15,4) NOT NULL default '0.0000',
  customers_basket_date_added varchar(8) default NULL,
  PRIMARY KEY  (customers_basket_id),
  KEY idx_customers_basket_customers_id (customers_id)
) TYPE=MyISAM ;


DROP TABLE IF EXISTS customers_basket_attributes;
CREATE TABLE customers_basket_attributes (
  customers_basket_attributes_id int(11) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default '0',
  products_id tinytext NOT NULL,
  products_options_id int(11) NOT NULL default '0',
  products_options_value_id int(11) NOT NULL default '0',
  products_options_value_text varchar(32) default NULL,
  PRIMARY KEY  (customers_basket_attributes_id),
  KEY idx_customers_basket_att_customers_id (customers_id)
) TYPE=MyISAM ;


DROP TABLE IF EXISTS customers_groups;
CREATE TABLE customers_groups (
  customers_group_id smallint(5) unsigned NOT NULL default '0',
  customers_group_name varchar(32) NOT NULL,
  customers_group_show_tax enum('1','0') NOT NULL default '1',
  customers_group_tax_exempt enum('0','1') NOT NULL default '0',
  group_payment_allowed varchar(255) NOT NULL,
  group_shipment_allowed varchar(255) NOT NULL,
  PRIMARY KEY  (customers_group_id)
) TYPE=MyISAM;


insert into customers_groups (customers_group_id, customers_group_name, customers_group_show_tax, customers_group_tax_exempt, group_payment_allowed, group_shipment_allowed) values ('0', 'Retail', '1', '0', '', '');
insert into customers_groups (customers_group_id, customers_group_name, customers_group_show_tax, customers_group_tax_exempt, group_payment_allowed, group_shipment_allowed) values ('1', 'Wholesale', '0', '0', '', '');
DROP TABLE IF EXISTS customers_info;
CREATE TABLE customers_info (
  customers_info_id int(11) NOT NULL default '0',
  customers_info_date_of_last_logon datetime default NULL,
  customers_info_number_of_logons int(5) default NULL,
  customers_info_date_account_created datetime default NULL,
  customers_info_date_account_last_modified datetime default NULL,
  global_product_notifications int(1) default '0',
  PRIMARY KEY  (customers_info_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS customers_wishlist;
CREATE TABLE customers_wishlist (
  products_id tinytext NOT NULL,
  customers_id int(13) NOT NULL default '0'
) TYPE=MyISAM;


DROP TABLE IF EXISTS customers_wishlist_attributes;
CREATE TABLE customers_wishlist_attributes (
  customers_wishlist_attributes_id int(11) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default '0',
  products_id tinytext NOT NULL,
  products_options_id int(11) NOT NULL default '0',
  products_options_value_id int(11) NOT NULL default '0',
  PRIMARY KEY  (customers_wishlist_attributes_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS geo_zones;
CREATE TABLE geo_zones (
  geo_zone_id int(11) NOT NULL auto_increment,
  geo_zone_name varchar(32) NOT NULL,
  geo_zone_description varchar(255) NOT NULL,
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (geo_zone_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS google_checkout;
CREATE TABLE google_checkout (
  customers_id int(11) default NULL,
  buyer_id bigint(20) default NULL
) TYPE=MyISAM;

DROP TABLE IF EXISTS google_orders;
CREATE TABLE google_orders (
  orders_id int(11) default NULL,
  google_order_number bigint(20) default NULL,
  order_amount decimal(15,4) default NULL
) TYPE=MyISAM;

DROP TABLE IF EXISTS languages;
CREATE TABLE languages (
  languages_id int(11) NOT NULL auto_increment,
  `name` varchar(32) NOT NULL,
  `code` char(2) NOT NULL,
  image varchar(64) default NULL,
  `directory` varchar(32) default NULL,
  sort_order int(3) default NULL,
  PRIMARY KEY  (languages_id),
  KEY IDX_LANGUAGES_NAME (`name`)
) TYPE=MyISAM ;


INSERT INTO languages (languages_id, name, code, image, directory, sort_order) VALUES(1, 'English', 'en', 'icon.gif', 'english', 1);
INSERT INTO languages (languages_id, name, code, image, directory, sort_order) VALUES(2, 'Deutsch', 'de', 'icon.gif', 'german', 2);
INSERT INTO languages (languages_id, name, code, image, directory, sort_order) VALUES(3, 'Espanol', 'es', 'icon.gif', 'espanol', 3);
DROP TABLE IF EXISTS manufacturers;
CREATE TABLE manufacturers (
  manufacturers_id int(11) NOT NULL auto_increment,
  manufacturers_name varchar(32) NOT NULL,
  manufacturers_image varchar(64) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  PRIMARY KEY  (manufacturers_id),
  KEY IDX_MANUFACTURERS_NAME (manufacturers_name)
) TYPE=MyISAM ;


DROP TABLE IF EXISTS manufacturers_info;
CREATE TABLE manufacturers_info (
  manufacturers_id int(11) NOT NULL default '0',
  languages_id int(11) NOT NULL default '0',
  manufacturers_url varchar(255) NOT NULL,
  url_clicked int(5) NOT NULL default '0',
  date_last_click datetime default NULL,
  PRIMARY KEY  (manufacturers_id,languages_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS newsletters;
CREATE TABLE newsletters (
  newsletters_id int(11) NOT NULL auto_increment,
  title varchar(255) NOT NULL,
  content text NOT NULL,
  module varchar(255) NOT NULL,
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  date_sent datetime default NULL,
  `status` int(1) default NULL,
  locked int(1) default '0',
  PRIMARY KEY  (newsletters_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS orders;
CREATE TABLE orders (
  orders_id int(11) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default '0',
  customers_name varchar(64) NOT NULL,
  customers_company varchar(32) default NULL,
  customers_street_address varchar(64) NOT NULL,
  customers_suburb varchar(32) default NULL,
  customers_city varchar(32) NOT NULL,
  customers_postcode varchar(10) NOT NULL,
  customers_state varchar(32) default NULL,
  customers_country varchar(32) NOT NULL,
  customers_telephone varchar(32) NOT NULL,
  customers_email_address varchar(96) NOT NULL,
  customers_address_format_id int(5) NOT NULL default '0',
  customers_dummy_account tinyint(3) unsigned NOT NULL,
  delivery_name varchar(64) NOT NULL,
  delivery_company varchar(32) default NULL,
  delivery_street_address varchar(64) NOT NULL,
  delivery_suburb varchar(32) default NULL,
  delivery_city varchar(32) NOT NULL,
  delivery_postcode varchar(10) NOT NULL,
  delivery_state varchar(32) default NULL,
  delivery_country varchar(32) NOT NULL,
  delivery_address_format_id int(5) NOT NULL default '0',
  billing_name varchar(64) NOT NULL,
  billing_company varchar(32) default NULL,
  billing_street_address varchar(64) NOT NULL,
  billing_suburb varchar(32) default NULL,
  billing_city varchar(32) NOT NULL,
  billing_postcode varchar(10) NOT NULL,
  billing_state varchar(32) default NULL,
  billing_country varchar(32) NOT NULL,
  billing_address_format_id int(5) NOT NULL default '0',
  payment_method varchar(255) NOT NULL,
  cc_type varchar(20) default NULL,
  cc_owner varchar(64) default NULL,
  cc_number varchar(32) default NULL,
  cc_expires varchar(4) default NULL,
  last_modified datetime default NULL,
  date_purchased datetime default NULL,
  orders_status int(5) NOT NULL default '0',
  orders_date_finished datetime default NULL,
  currency char(3) default NULL,
  currency_value decimal(14,6) default NULL,
  paypal_ipn_id int(11) NOT NULL default '0',
  fedex_tracking varchar(20) NOT NULL,
  purchased_without_account tinyint(1) unsigned NOT NULL default '0',
  shipping_tax decimal(7,4) NOT NULL default '0.0000',
  shipping_module varchar(255) default NULL,
  PRIMARY KEY  (orders_id),
  KEY idx_orders_customers_id (customers_id)
) TYPE=MyISAM ;

DROP TABLE IF EXISTS orders_products;
CREATE TABLE orders_products (
  orders_products_id int(11) NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  products_id int(11) NOT NULL default '0',
  products_model varchar(12) default NULL,
  products_name varchar(64) NOT NULL,
  products_price decimal(15,4) NOT NULL default '0.0000',
  final_price decimal(15,4) NOT NULL default '0.0000',
  products_tax decimal(7,4) NOT NULL default '0.0000',
  products_quantity int(2) NOT NULL default '0',
  products_stock_attributes varchar(255) default NULL,
  PRIMARY KEY  (orders_products_id),
  KEY idx_orders_products_orders_id (orders_id),
  KEY idx_orders_products_products_id (products_id)
) TYPE=MyISAM ;


DROP TABLE IF EXISTS orders_products_attributes;
CREATE TABLE orders_products_attributes (
  orders_products_attributes_id int(11) NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  orders_products_id int(11) NOT NULL default '0',
  products_options varchar(32) NOT NULL,
  products_options_values varchar(32) NOT NULL,
  options_values_price decimal(15,4) NOT NULL default '0.0000',
  price_prefix char(1) NOT NULL,
  PRIMARY KEY  (orders_products_attributes_id),
  KEY idx_orders_products_att_orders_id (orders_id)
) TYPE=MyISAM ;


DROP TABLE IF EXISTS orders_products_download;
CREATE TABLE orders_products_download (
  orders_products_download_id int(11) NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  orders_products_id int(11) NOT NULL default '0',
  orders_products_filename varchar(255) NOT NULL,
  download_maxdays int(2) NOT NULL default '0',
  download_count int(2) NOT NULL default '0',
  PRIMARY KEY  (orders_products_download_id),
  KEY idx_orders_products_download_orders_id (orders_id)
) TYPE=MyISAM ;


DROP TABLE IF EXISTS orders_status;
CREATE TABLE orders_status (
  orders_status_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '1',
  orders_status_name varchar(32) NOT NULL,
  public_flag int(11) default '1',
  downloads_flag int(11) default '0',
  PRIMARY KEY  (orders_status_id,language_id),
  KEY idx_orders_status_name (orders_status_name)
) TYPE=MyISAM;


INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(1, 1, 'Pending', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(1, 2, 'Offen', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(2, 1, 'Processing', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(2, 2, 'In Bearbeitung', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(3, 1, 'Delivered', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(3, 2, 'Versendet', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(100000, 1, 'Updated', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(100000, 2, 'Updated', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(100001, 1, 'Preparing [PayPal IPN]', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(100001, 2, 'Preparing [PayPal IPN]', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(100001, 3, 'Preparing [PayPal IPN]', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(100002, 1, 'Preparing [PayPal Standard]', 0, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(100002, 2, 'Preparing [PayPal Standard]', 0, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(100002, 3, 'Preparing [PayPal Standard]', 0, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(100003, 1, 'Sofortüberweisung Vorbereitung', 0, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(100003, 2, 'Sofortüberweisung Vorbereitung', 0, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(100003, 3, 'Sofortüberweisung Vorbereitung', 0, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(100, 1, 'Google New', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(100, 2, 'Google New', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(100, 3, 'Google New', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(101, 1, 'Google Processing', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(101, 2, 'Google Processing', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(101, 3, 'Google Processing', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(102, 1, 'Google Shipped', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(102, 2, 'Google Shipped', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(102, 3, 'Google Shipped', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(103, 1, 'Google Refunded', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(103, 2, 'Google Refunded', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(103, 3, 'Google Refunded', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(104, 1, 'Google Shipped and Refunded', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(104, 2, 'Google Shipped and Refunded', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(104, 3, 'Google Shipped and Refunded', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(105, 1, 'Google Canceled', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(105, 2, 'Google Canceled', 1, 0);
INSERT INTO orders_status (orders_status_id, language_id, orders_status_name, public_flag, downloads_flag) VALUES(105, 3, 'Google Canceled', 1, 0);
DROP TABLE IF EXISTS orders_status_history;
CREATE TABLE orders_status_history (
  orders_status_history_id int(11) NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  orders_status_id int(5) NOT NULL default '0',
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  customer_notified int(1) default '0',
  comments text,
  PRIMARY KEY  (orders_status_history_id),
  KEY idx_orders_status_history_orders_id (orders_id)
) TYPE=MyISAM ;


DROP TABLE IF EXISTS orders_total;
CREATE TABLE orders_total (
  orders_total_id int(10) unsigned NOT NULL auto_increment,
  orders_id int(11) NOT NULL default '0',
  title varchar(255) NOT NULL,
  `text` varchar(255) NOT NULL,
  `value` decimal(15,4) NOT NULL default '0.0000',
  class varchar(32) NOT NULL,
  sort_order int(11) NOT NULL default '0',
  PRIMARY KEY  (orders_total_id),
  KEY idx_orders_total_orders_id (orders_id)
) TYPE=MyISAM ;


DROP TABLE IF EXISTS packaging;
CREATE TABLE packaging (
  package_id int(11) NOT NULL auto_increment,
  package_name varchar(64) NOT NULL,
  package_description varchar(255) NOT NULL,
  package_length decimal(6,2) NOT NULL default '5.00',
  package_width decimal(6,2) NOT NULL default '5.00',
  package_height decimal(6,2) NOT NULL default '5.00',
  package_empty_weight decimal(6,2) NOT NULL default '0.00',
  package_max_weight decimal(6,2) NOT NULL default '50.00',
  package_cost int(5) NOT NULL default '0',
  PRIMARY KEY  (package_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS paypal_ipn;
CREATE TABLE paypal_ipn (
  paypal_ipn_id int(10) unsigned NOT NULL auto_increment,
  txn_type int(10) unsigned NOT NULL default '0',
  reason_code int(11) default NULL,
  payment_type int(11) NOT NULL default '0',
  payment_status int(11) NOT NULL default '0',
  pending_reason int(11) default NULL,
  invoice varchar(64) default NULL,
  mc_currency int(11) NOT NULL default '1',
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
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (paypal_ipn_id,txn_id),
  KEY idx_paypal_ipn_paypal_ipn_id (paypal_ipn_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS products;
CREATE TABLE products (
  products_id int(11) NOT NULL auto_increment,
  products_quantity int(4) NOT NULL default '0',
  products_model varchar(25) default NULL,
  products_image varchar(64) default NULL,
  products_price decimal(15,4) NOT NULL default '0.0000',
  products_date_added datetime NOT NULL default '0000-00-00 00:00:00',
  products_last_modified datetime default NULL,
  products_date_available datetime default NULL,
  products_weight decimal(5,2) NOT NULL default '0.00',
  products_status tinyint(1) NOT NULL default '0',
  products_tax_class_id int(11) NOT NULL default '0',
  manufacturers_id int(11) default NULL,
  products_ordered int(11) NOT NULL default '0',
  products_ship_price decimal(15,4) NOT NULL default '0.0000',
  products_length decimal(6,2) NOT NULL default '12.00',
  products_width decimal(6,2) NOT NULL default '12.00',
  products_height decimal(6,2) NOT NULL default '12.00',
  products_ready_to_ship int(1) NOT NULL default '0',
  PRIMARY KEY  (products_id),
  KEY idx_products_date_added (products_date_added),
  KEY idx_products_model (products_model)
) TYPE=MyISAM ;


DROP TABLE IF EXISTS products_attributes;
CREATE TABLE products_attributes (
  products_attributes_id int(11) NOT NULL auto_increment,
  products_id int(11) NOT NULL default '0',
  options_id int(11) NOT NULL default '0',
  options_values_id int(11) NOT NULL default '0',
  options_values_price decimal(15,4) NOT NULL default '0.0000',
  price_prefix char(1) NOT NULL,
  PRIMARY KEY  (products_attributes_id),
  KEY idx_products_attributes_products_id (products_id)
) TYPE=MyISAM ;


DROP TABLE IF EXISTS products_attributes_download;
CREATE TABLE products_attributes_download (
  products_attributes_id int(11) NOT NULL default '0',
  products_attributes_filename varchar(255) NOT NULL,
  products_attributes_maxdays int(2) default '0',
  products_attributes_maxcount int(2) default '0',
  PRIMARY KEY  (products_attributes_id)
) TYPE=MyISAM;


insert into products_attributes_download (products_attributes_id, products_attributes_filename, products_attributes_maxdays, products_attributes_maxcount) values ('11', 'Dhtml-coolmenu.zip', '7', '10');
DROP TABLE IF EXISTS products_description;
CREATE TABLE products_description (
  products_id int(11) NOT NULL auto_increment,
  language_id int(11) NOT NULL default '1',
  products_name varchar(64) NOT NULL,
  products_description text,
  products_url varchar(255) default NULL,
  products_viewed int(5) default '0',
  PRIMARY KEY  (products_id,language_id),
  KEY products_name (products_name)
) TYPE=MyISAM ;


DROP TABLE IF EXISTS products_groups;
CREATE TABLE products_groups (
  customers_group_id int(11) NOT NULL default '0',
  customers_group_price decimal(15,4) NOT NULL default '0.0000',
  products_id int(11) NOT NULL default '0',
  products_price decimal(15,4) NOT NULL default '0.0000'
) TYPE=MyISAM;


DROP TABLE IF EXISTS products_notifications;
CREATE TABLE products_notifications (
  products_id int(11) NOT NULL default '0',
  customers_id int(11) NOT NULL default '0',
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (products_id,customers_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS products_options;
CREATE TABLE products_options (
  products_options_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '1',
  products_options_name varchar(32) NOT NULL,
  products_options_track_stock tinyint(4) NOT NULL default '0',
  products_options_type int(5) NOT NULL default '0',
  products_options_length smallint(2) NOT NULL default '32',
  products_options_comment varchar(32) default NULL,
  PRIMARY KEY  (products_options_id,language_id)
) TYPE=MyISAM;


INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_track_stock, products_options_type, products_options_length, products_options_comment) VALUES(1, 1, 'Version', 0, 0, 32, NULL);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_track_stock, products_options_type, products_options_length, products_options_comment) VALUES(1, 2, '', 0, 0, 32, NULL);
INSERT INTO products_options (products_options_id, language_id, products_options_name, products_options_track_stock, products_options_type, products_options_length, products_options_comment) VALUES(1, 3, '', 0, 0, 32, NULL);
DROP TABLE IF EXISTS products_options_values;
CREATE TABLE products_options_values (
  products_options_values_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '1',
  products_options_values_name varchar(64) NOT NULL,
  PRIMARY KEY  (products_options_values_id,language_id)
) TYPE=MyISAM;


INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES(1, 2, 'Download: Windows - English');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES(1, 1, 'Download: Windows - English');
INSERT INTO products_options_values (products_options_values_id, language_id, products_options_values_name) VALUES(1, 3, '');
DROP TABLE IF EXISTS products_options_values_to_products_options;
CREATE TABLE products_options_values_to_products_options (
  products_options_values_to_products_options_id int(11) NOT NULL auto_increment,
  products_options_id int(11) NOT NULL default '0',
  products_options_values_id int(11) NOT NULL default '0',
  PRIMARY KEY  (products_options_values_to_products_options_id)
) TYPE=MyISAM ;


insert into products_options_values_to_products_options (products_options_values_to_products_options_id, products_options_id, products_options_values_id) values ('14', '1', '1');
DROP TABLE IF EXISTS products_stock;
CREATE TABLE products_stock (
  products_stock_id int(11) NOT NULL auto_increment,
  products_id int(11) NOT NULL default '0',
  products_stock_attributes varchar(255) NOT NULL,
  products_stock_quantity int(11) NOT NULL default '0',
  PRIMARY KEY  (products_stock_id),
  UNIQUE KEY idx_products_stock_attributes (products_id,products_stock_attributes)
) TYPE=MyISAM ;


DROP TABLE IF EXISTS products_to_categories;
CREATE TABLE products_to_categories (
  products_id int(11) NOT NULL default '0',
  categories_id int(11) NOT NULL default '0',
  PRIMARY KEY  (products_id,categories_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS products_xsell;
CREATE TABLE products_xsell (
  ID int(10) NOT NULL auto_increment,
  products_id int(10) unsigned NOT NULL default '1',
  xsell_id int(10) unsigned NOT NULL default '1',
  sort_order int(10) unsigned NOT NULL default '1',
  PRIMARY KEY  (ID)
) TYPE=MyISAM;


DROP TABLE IF EXISTS reviews;
CREATE TABLE reviews (
  reviews_id int(11) NOT NULL auto_increment,
  products_id int(11) NOT NULL default '0',
  customers_id int(11) default NULL,
  customers_name varchar(64) NOT NULL,
  reviews_rating int(1) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  reviews_read int(5) NOT NULL default '0',
  PRIMARY KEY  (reviews_id),
  KEY idx_reviews_products_id (products_id),
  KEY idx_reviews_customers_id (customers_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS reviews_description;
CREATE TABLE reviews_description (
  reviews_id int(11) NOT NULL default '0',
  languages_id int(11) NOT NULL default '0',
  reviews_text text NOT NULL,
  PRIMARY KEY  (reviews_id,languages_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS scart;
CREATE TABLE scart (
  scartid int(11) NOT NULL auto_increment,
  customers_id int(11) NOT NULL default '0',
  dateadded varchar(8) NOT NULL,
  PRIMARY KEY  (scartid)
) TYPE=MyISAM;


DROP TABLE IF EXISTS searchword_swap;
CREATE TABLE searchword_swap (
  sws_id mediumint(11) NOT NULL auto_increment,
  sws_word varchar(100) NOT NULL,
  sws_replacement varchar(100) NOT NULL,
  PRIMARY KEY  (sws_id)
) TYPE=MyISAM;

DROP TABLE IF EXISTS search_queries;
CREATE TABLE search_queries (
  search_id int(11) NOT NULL auto_increment,
  search_text tinytext,
  PRIMARY KEY  (search_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS search_queries_sorted;
CREATE TABLE search_queries_sorted (
  search_id smallint(6) NOT NULL auto_increment,
  search_text tinytext NOT NULL,
  search_count int(11) NOT NULL default '0',
  PRIMARY KEY  (search_id)
) TYPE=MyISAM;



DROP TABLE IF EXISTS sessions;
CREATE TABLE sessions (
  sesskey varchar(32) NOT NULL,
  expiry int(11) unsigned NOT NULL default '0',
  `value` text NOT NULL,
  PRIMARY KEY  (sesskey)
) TYPE=MyISAM;


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
  PRIMARY KEY  (delivery_id),
  UNIQUE KEY tracking_num (tracking_num)
) TYPE=MyISAM;


DROP TABLE IF EXISTS specials;
CREATE TABLE specials (
  specials_id int(11) NOT NULL auto_increment,
  products_id int(11) NOT NULL default '0',
  specials_new_products_price decimal(15,4) NOT NULL default '0.0000',
  specials_date_added datetime default NULL,
  specials_last_modified datetime default NULL,
  expires_date datetime default NULL,
  date_status_change datetime default NULL,
  `status` int(1) NOT NULL default '1',
  customers_group_id int(11) NOT NULL default '0',
  PRIMARY KEY  (specials_id),
  KEY idx_specials_products_id (products_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS specials_retail_prices;
CREATE TABLE specials_retail_prices (
  products_id int(11) NOT NULL default '0',
  specials_new_products_price decimal(15,4) NOT NULL default '0.0000',
  `status` tinyint(4) default NULL,
  customers_group_id smallint(6) default NULL,
  PRIMARY KEY  (products_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS tax_class;
CREATE TABLE tax_class (
  tax_class_id int(11) NOT NULL auto_increment,
  tax_class_title varchar(32) NOT NULL,
  tax_class_description varchar(255) NOT NULL,
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (tax_class_id)
) TYPE=MyISAM ;


INSERT INTO tax_class (tax_class_id, tax_class_title, tax_class_description, last_modified, date_added) VALUES(2, 'Taxable Item', 'Any taxable item', NULL, '2005-03-30 14:40:20');
INSERT INTO tax_class (tax_class_id, tax_class_title, tax_class_description, last_modified, date_added) VALUES(3, 'Non Taxable', 'Non Taxable Goods', NULL, '2005-03-30 14:40:28');
DROP TABLE IF EXISTS tax_rates;
CREATE TABLE tax_rates (
  tax_rates_id int(11) NOT NULL auto_increment,
  tax_zone_id int(11) NOT NULL default '0',
  tax_class_id int(11) NOT NULL default '0',
  tax_priority int(5) default '1',
  tax_rate decimal(7,4) NOT NULL default '0.0000',
  tax_description varchar(255) NOT NULL,
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (tax_rates_id)
) TYPE=MyISAM;


DROP TABLE IF EXISTS theme_configuration;
CREATE TABLE theme_configuration (
  configuration_id int(11) NOT NULL auto_increment,
  configuration_title varchar(64) NOT NULL,
  configuration_key varchar(64) NOT NULL default 'BOX_HEADING_',
  configuration_value varchar(255) NOT NULL,
  configuration_description varchar(255) NOT NULL,
  configuration_group_id int(11) NOT NULL default '1',
  configuration_column varchar(64) NOT NULL default 'left',
  location int(5) NOT NULL default '0',
  sort_order int(5) default NULL,
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  box_heading varchar(64) NOT NULL,
  PRIMARY KEY  (configuration_id)
) TYPE=MyISAM ;


INSERT INTO theme_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, configuration_column, location, sort_order, last_modified, date_added, box_heading) VALUES(1, 'best sellers', 'BOX_HEADING_BEST_SELLERS', 'yes', 'Display Best Sellers box?', 1, 'left', 12, 1, '2005-04-01 12:31:54', '2003-04-15 11:01:05', '');
INSERT INTO theme_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, configuration_column, location, sort_order, last_modified, date_added, box_heading) VALUES(3, 'currencies', 'BOX_HEADING_CATEGORIES_CURRENCIES', 'yes', 'Display Currencies box?', 1, 'right', 8, 3, '2003-04-15 18:16:37', '2003-04-15 11:01:05', '');
INSERT INTO theme_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, configuration_column, location, sort_order, last_modified, date_added, box_heading) VALUES(5, 'information', 'BOX_HEADING_INFORMATION', 'yes', 'Display Information box?', 1, 'left', 7, 5, '2005-02-22 19:36:38', '2003-04-15 11:01:05', '');
INSERT INTO theme_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, configuration_column, location, sort_order, last_modified, date_added, box_heading) VALUES(6, 'languages', 'BOX_HEADING_LANGUAGES', 'yes', 'Display Languages box?', 1, 'right', 7, 6, '2003-04-15 18:16:33', '2003-04-15 11:01:05', '');
INSERT INTO theme_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, configuration_column, location, sort_order, last_modified, date_added, box_heading) VALUES(7, 'manufacturer info', 'BOX_HEADING_MANUFACTURER_INFO', 'yes', 'Display Manufacturer Info box?', 1, 'right', 9, 7, '2003-04-15 18:40:37', '2003-04-15 11:01:05', '');
INSERT INTO theme_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, configuration_column, location, sort_order, last_modified, date_added, box_heading) VALUES(8, 'manufacturers', 'BOX_HEADING_MANUFACTURERS', 'yes', 'Display Manufacturers box?', 1, 'left', 6, 8, NULL, '2003-04-15 11:01:05', 'Manufactures');
INSERT INTO theme_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, configuration_column, location, sort_order, last_modified, date_added, box_heading) VALUES(9, 'order history', 'BOX_HEADING_ORDER_HISTORY', 'yes', 'Display Order History box?', 1, 'right', 4, 9, '2005-02-22 18:29:03', '2003-04-15 11:01:05', '');
INSERT INTO theme_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, configuration_column, location, sort_order, last_modified, date_added, box_heading) VALUES(10, 'product notifications', 'BOX_HEADING_PRODUCT_NOTIFICATIONS', 'yes', 'Display Product Notifications box?', 1, 'right', 9, 10, '2003-04-17 01:32:54', '2003-04-15 11:01:05', '');
INSERT INTO theme_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, configuration_column, location, sort_order, last_modified, date_added, box_heading) VALUES(11, 'reviews', 'BOX_HEADING_REVIEWS', 'yes', 'Display Reviews box?', 1, 'right', 6, 11, '2003-04-15 18:16:22', '2003-04-15 11:01:05', '');
INSERT INTO theme_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, configuration_column, location, sort_order, last_modified, date_added, box_heading) VALUES(12, 'search', 'BOX_HEADING_SEARCH', 'yes', 'Display Search box?', 1, 'left', 5, 12, NULL, '2003-04-15 11:01:05', 'Quick Find');
INSERT INTO theme_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, configuration_column, location, sort_order, last_modified, date_added, box_heading) VALUES(13, 'shopping cart', 'BOX_HEADING_SHOPPING_CART', 'yes', 'Display Shopping Cart box?', 1, 'right', 1, 13, '2005-02-23 22:16:01', '2003-04-15 11:01:05', '');
INSERT INTO theme_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, configuration_column, location, sort_order, last_modified, date_added, box_heading) VALUES(14, 'specials', 'BOX_HEADING_SPECIALS', 'yes', 'Display Specials box?', 1, 'right', 5, 14, '2003-04-15 18:16:17', '2003-04-15 11:01:05', 'Specials');
INSERT INTO theme_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, configuration_column, location, sort_order, last_modified, date_added, box_heading) VALUES(15, 'tell a friend', 'BOX_HEADING_TELL_A_FRIEND', 'yes', 'Display Tell a Friend box?', 1, 'right', 4, 15, '2003-04-15 18:16:03', '2003-04-15 11:01:05', '');
INSERT INTO theme_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, configuration_column, location, sort_order, last_modified, date_added, box_heading) VALUES(16, 'what''s new', 'BOX_HEADING_WHATS_NEW', 'yes', 'Display What''s New? box?', 1, 'left', 4, 16, NULL, '2003-04-15 11:01:05', 'What''s New');
INSERT INTO theme_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, configuration_column, location, sort_order, last_modified, date_added, box_heading) VALUES(26, 'articles', 'BOX_HEADING_ARTICLES', 'yes', '', 1, 'right', 10, NULL, NULL, '0000-00-00 00:00:00', 'Articles');
INSERT INTO theme_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, configuration_column, location, sort_order, last_modified, date_added, box_heading) VALUES(25, 'loginbox', 'BOX_HEADING_LOGIN_BOX', 'yes', '', 1, 'right', 2, NULL, '2005-02-23 22:16:12', '0000-00-00 00:00:00', 'Sign In');
INSERT INTO theme_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, configuration_column, location, sort_order, last_modified, date_added, box_heading) VALUES(28, 'affiliate', 'BOX_HEADING_AFFILIATE', 'yes', '', 1, 'left', 3, NULL, NULL, '0000-00-00 00:00:00', 'Affiliates');
INSERT INTO theme_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, configuration_column, location, sort_order, last_modified, date_added, box_heading) VALUES(2, 'categories', 'BOX_HEADING_CATEGORIES', 'yes', '', 1, 'left', 1, NULL, NULL, '0000-00-00 00:00:00', 'Categories');
INSERT INTO theme_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, configuration_column, location, sort_order, last_modified, date_added, box_heading) VALUES(22, 'wishlist', 'BOX_HEADING_CUSTOMER_WISHLIST', 'yes', '', 1, 'right', 3, NULL, '2005-02-22 18:28:48', '0000-00-00 00:00:00', 'My Wish List');
INSERT INTO theme_configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, configuration_column, location, sort_order, last_modified, date_added, box_heading) VALUES(29, 'Authors', 'BOX_HEADING_AUTHORS', 'yes', '', 1, 'right', 11, NULL, NULL, '0000-00-00 00:00:00', 'Authors');
DROP TABLE IF EXISTS topics;
CREATE TABLE topics (
  topics_id int(11) NOT NULL auto_increment,
  topics_image varchar(64) default NULL,
  parent_id int(11) NOT NULL default '0',
  sort_order int(3) default NULL,
  date_added datetime default NULL,
  last_modified datetime default NULL,
  PRIMARY KEY  (topics_id),
  KEY idx_topics_parent_id (parent_id)
) TYPE=MyISAM ;


DROP TABLE IF EXISTS topics_description;
CREATE TABLE topics_description (
  topics_id int(11) NOT NULL default '0',
  language_id int(11) NOT NULL default '1',
  topics_name varchar(32) NOT NULL,
  topics_heading_title varchar(64) default NULL,
  topics_description text,
  PRIMARY KEY  (topics_id,language_id),
  KEY idx_topics_name (topics_name)
) TYPE=MyISAM;


DROP TABLE IF EXISTS whos_online;
CREATE TABLE whos_online (
  customer_id int(11) default NULL,
  full_name varchar(64) NOT NULL,
  session_id varchar(128) NOT NULL,
  ip_address varchar(15) NOT NULL,
  time_entry varchar(14) NOT NULL,
  time_last_click varchar(14) NOT NULL,
  last_page_url text NOT NULL
) TYPE=MyISAM;


DROP TABLE IF EXISTS zones;
CREATE TABLE zones (
  zone_id int(11) NOT NULL auto_increment,
  zone_country_id int(11) NOT NULL default '0',
  zone_code varchar(32) NOT NULL,
  zone_name varchar(32) NOT NULL,
  PRIMARY KEY  (zone_id),
  KEY idx_zones_to_geo_zones_country_id (zone_country_id)
) TYPE=MyISAM ;


INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(1, 223, 'AL', 'Alabama');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(2, 223, 'AK', 'Alaska');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(3, 223, 'AS', 'American Samoa');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(4, 223, 'AZ', 'Arizona');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(5, 223, 'AR', 'Arkansas');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(6, 223, 'AF', 'Armed Forces Africa');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(7, 223, 'AA', 'Armed Forces Americas');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(8, 223, 'AC', 'Armed Forces Canada');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(9, 223, 'AE', 'Armed Forces Europe');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(10, 223, 'AM', 'Armed Forces Middle East');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(11, 223, 'AP', 'Armed Forces Pacific');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(12, 223, 'CA', 'California');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(13, 223, 'CO', 'Colorado');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(14, 223, 'CT', 'Connecticut');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(15, 223, 'DE', 'Delaware');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(16, 223, 'DC', 'District of Columbia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(17, 223, 'FM', 'Federated States Of Micronesia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(18, 223, 'FL', 'Florida');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(19, 223, 'GA', 'Georgia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(20, 223, 'GU', 'Guam');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(21, 223, 'HI', 'Hawaii');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(22, 223, 'ID', 'Idaho');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(23, 223, 'IL', 'Illinois');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(24, 223, 'IN', 'Indiana');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(25, 223, 'IA', 'Iowa');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(26, 223, 'KS', 'Kansas');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(27, 223, 'KY', 'Kentucky');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(28, 223, 'LA', 'Louisiana');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(29, 223, 'ME', 'Maine');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(30, 223, 'MH', 'Marshall Islands');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(31, 223, 'MD', 'Maryland');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(32, 223, 'MA', 'Massachusetts');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(33, 223, 'MI', 'Michigan');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(34, 223, 'MN', 'Minnesota');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(35, 223, 'MS', 'Mississippi');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(36, 223, 'MO', 'Missouri');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(37, 223, 'MT', 'Montana');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(38, 223, 'NE', 'Nebraska');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(39, 223, 'NV', 'Nevada');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(40, 223, 'NH', 'New Hampshire');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(41, 223, 'NJ', 'New Jersey');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(42, 223, 'NM', 'New Mexico');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(43, 223, 'NY', 'New York');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(44, 223, 'NC', 'North Carolina');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(45, 223, 'ND', 'North Dakota');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(46, 223, 'MP', 'Northern Mariana Islands');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(47, 223, 'OH', 'Ohio');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(48, 223, 'OK', 'Oklahoma');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(49, 223, 'OR', 'Oregon');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(50, 223, 'PW', 'Palau');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(51, 223, 'PA', 'Pennsylvania');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(52, 223, 'PR', 'Puerto Rico');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(53, 223, 'RI', 'Rhode Island');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(54, 223, 'SC', 'South Carolina');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(55, 223, 'SD', 'South Dakota');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(56, 223, 'TN', 'Tennessee');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(57, 223, 'TX', 'Texas');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(58, 223, 'UT', 'Utah');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(59, 223, 'VT', 'Vermont');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(60, 223, 'VI', 'Virgin Islands');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(61, 223, 'VA', 'Virginia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(62, 223, 'WA', 'Washington');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(63, 223, 'WV', 'West Virginia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(64, 223, 'WI', 'Wisconsin');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(65, 223, 'WY', 'Wyoming');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(66, 38, 'AB', 'Alberta');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(67, 38, 'BC', 'British Columbia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(68, 38, 'MB', 'Manitoba');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(69, 38, 'NF', 'Newfoundland');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(70, 38, 'NB', 'New Brunswick');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(71, 38, 'NS', 'Nova Scotia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(72, 38, 'NT', 'Northwest Territories');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(73, 38, 'NU', 'Nunavut');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(74, 38, 'ON', 'Ontario');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(75, 38, 'PE', 'Prince Edward Island');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(76, 38, 'QC', 'Quebec');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(77, 38, 'SK', 'Saskatchewan');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(78, 38, 'YT', 'Yukon Territory');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(79, 81, 'NDS', 'Niedersachsen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(80, 81, 'BAW', 'Baden-Württemberg');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(81, 81, 'BAY', 'Bayern');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(82, 81, 'BER', 'Berlin');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(83, 81, 'BRG', 'Brandenburg');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(84, 81, 'BRE', 'Bremen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(85, 81, 'HAM', 'Hamburg');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(86, 81, 'HES', 'Hessen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(87, 81, 'MEC', 'Mecklenburg-Vorpommern');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(88, 81, 'NRW', 'Nordrhein-Westfalen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(89, 81, 'RHE', 'Rheinland-Pfalz');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(90, 81, 'SAR', 'Saarland');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(91, 81, 'SAS', 'Sachsen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(92, 81, 'SAC', 'Sachsen-Anhalt');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(93, 81, 'SCN', 'Schleswig-Holstein');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(94, 81, 'THE', 'Thüringen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(95, 14, 'WI', 'Wien');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(96, 14, 'NO', 'Niederösterreich');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(97, 14, 'OO', 'Oberösterreich');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(98, 14, 'SB', 'Salzburg');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(99, 14, 'KN', 'Kärnten');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(100, 14, 'ST', 'Steiermark');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(101, 14, 'TI', 'Tirol');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(102, 14, 'BL', 'Burgenland');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(103, 14, 'VB', 'Voralberg');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(104, 204, 'AG', 'Aargau');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(105, 204, 'AI', 'Appenzell Innerrhoden');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(106, 204, 'AR', 'Appenzell Ausserrhoden');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(107, 204, 'BE', 'Bern');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(108, 204, 'BL', 'Basel-Landschaft');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(109, 204, 'BS', 'Basel-Stadt');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(110, 204, 'FR', 'Freiburg');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(111, 204, 'GE', 'Genf');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(112, 204, 'GL', 'Glarus');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(113, 204, 'JU', 'Graubünden');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(114, 204, 'JU', 'Jura');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(115, 204, 'LU', 'Luzern');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(116, 204, 'NE', 'Neuenburg');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(117, 204, 'NW', 'Nidwalden');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(118, 204, 'OW', 'Obwalden');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(119, 204, 'SG', 'St. Gallen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(120, 204, 'SH', 'Schaffhausen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(121, 204, 'SO', 'Solothurn');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(122, 204, 'SZ', 'Schwyz');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(123, 204, 'TG', 'Thurgau');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(124, 204, 'TI', 'Tessin');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(125, 204, 'UR', 'Uri');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(126, 204, 'VD', 'Waadt');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(127, 204, 'VS', 'Wallis');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(128, 204, 'ZG', 'Zug');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(129, 204, 'ZH', 'Zürich');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(130, 195, 'A Coruña', 'A Coruña');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(131, 195, 'Alava', 'Alava');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(132, 195, 'Albacete', 'Albacete');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(133, 195, 'Alicante', 'Alicante');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(134, 195, 'Almeria', 'Almeria');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(135, 195, 'Asturias', 'Asturias');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(136, 195, 'Avila', 'Avila');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(137, 195, 'Badajoz', 'Badajoz');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(138, 195, 'Baleares', 'Baleares');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(139, 195, 'Barcelona', 'Barcelona');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(140, 195, 'Burgos', 'Burgos');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(141, 195, 'Caceres', 'Caceres');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(142, 195, 'Cadiz', 'Cadiz');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(143, 195, 'Cantabria', 'Cantabria');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(144, 195, 'Castellon', 'Castellon');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(145, 195, 'Ceuta', 'Ceuta');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(146, 195, 'Ciudad Real', 'Ciudad Real');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(147, 195, 'Cordoba', 'Cordoba');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(148, 195, 'Cuenca', 'Cuenca');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(149, 195, 'Girona', 'Girona');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(150, 195, 'Granada', 'Granada');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(151, 195, 'Guadalajara', 'Guadalajara');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(152, 195, 'Guipuzcoa', 'Guipuzcoa');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(153, 195, 'Huelva', 'Huelva');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(154, 195, 'Huesca', 'Huesca');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(155, 195, 'Jaen', 'Jaen');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(156, 195, 'La Rioja', 'La Rioja');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(157, 195, 'Las Palmas', 'Las Palmas');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(158, 195, 'Leon', 'Leon');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(159, 195, 'Lleida', 'Lleida');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(160, 195, 'Lugo', 'Lugo');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(161, 195, 'Madrid', 'Madrid');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(162, 195, 'Malaga', 'Malaga');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(163, 195, 'Melilla', 'Melilla');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(164, 195, 'Murcia', 'Murcia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(165, 195, 'Navarra', 'Navarra');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(166, 195, 'Ourense', 'Ourense');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(167, 195, 'Palencia', 'Palencia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(168, 195, 'Pontevedra', 'Pontevedra');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(169, 195, 'Salamanca', 'Salamanca');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(170, 195, 'Santa Cruz de Tenerife', 'Santa Cruz de Tenerife');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(171, 195, 'Segovia', 'Segovia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(172, 195, 'Sevilla', 'Sevilla');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(173, 195, 'Soria', 'Soria');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(174, 195, 'Tarragona', 'Tarragona');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(175, 195, 'Teruel', 'Teruel');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(176, 195, 'Toledo', 'Toledo');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(177, 195, 'Valencia', 'Valencia');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(178, 195, 'Valladolid', 'Valladolid');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(179, 195, 'Vizcaya', 'Vizcaya');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(180, 195, 'Zamora', 'Zamora');
INSERT INTO zones (zone_id, zone_country_id, zone_code, zone_name) VALUES(181, 195, 'Zaragoza', 'Zaragoza');


DROP TABLE IF EXISTS zones_to_geo_zones;
CREATE TABLE zones_to_geo_zones (
  association_id int(11) NOT NULL auto_increment,
  zone_country_id int(11) NOT NULL default '0',
  zone_id int(11) default NULL,
  geo_zone_id int(11) default NULL,
  last_modified datetime default NULL,
  date_added datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (association_id)
) TYPE=MyISAM;