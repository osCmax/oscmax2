#$Id$
#
# osCMax 2.0 Update script for version RC3 to RC4
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
# --------------------------------------------------------
# Source info
# Database: oscmaxrc3
# --------------------------------------------------------
# Target info
# Database: oscmaxrc4
# --------------------------------------------------------
#


#
# NEW TABLES
#
CREATE TABLE affiliate_news (
    news_id int(11) NOT NULL auto_increment,
    date_added datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    news_status tinyint(1) NOT NULL DEFAULT '0',
    PRIMARY KEY (news_id)
);

CREATE TABLE affiliate_news_contents (
    affiliate_news_contents_id int(11) NOT NULL auto_increment,
    affiliate_news_id int(11) NOT NULL DEFAULT '0',
    affiliate_news_languages_id int(11) NOT NULL DEFAULT '0',
    affiliate_news_headlines varchar(255) NOT NULL DEFAULT '',
    affiliate_news_contents text NOT NULL DEFAULT '',
    PRIMARY KEY (affiliate_news_contents_id),
    INDEX affiliate_news_id (affiliate_news_id),
    INDEX affiliate_news_languages_id (affiliate_news_languages_id)
);

CREATE TABLE affiliate_newsletters (
    affiliate_newsletters_id int(11) NOT NULL auto_increment,
    title varchar(255) NOT NULL DEFAULT '',
    content text NOT NULL DEFAULT '',
    module varchar(255) NOT NULL DEFAULT '',
    date_added datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
    date_sent datetime NULL DEFAULT NULL,
    status int(1) NULL DEFAULT NULL,
    locked int(1) NULL DEFAULT '0',
    PRIMARY KEY (affiliate_newsletters_id)
);

CREATE TABLE google_checkout (
    customers_id int(11) NULL DEFAULT NULL,
    buyer_id bigint(20) NULL DEFAULT NULL
);

CREATE TABLE google_orders (
    orders_id int(11) NULL DEFAULT NULL,
    google_order_number bigint(20) NULL DEFAULT NULL,
    order_amount decimal(15,4) NULL DEFAULT NULL
);

CREATE TABLE ups_boxes_used (
    id int NOT NULL auto_increment,
    date datetime NULL DEFAULT NULL,
    customers_id int(11) NOT NULL,
    boxes text,
    PRIMARY KEY (id)
);

#
# MODIFY EXISTING TABLES
#
ALTER TABLE admin
    ADD admin_username varchar(32) NOT NULL DEFAULT '' AFTER admin_groups_id,
    ADD UNIQUE admin_username (admin_username);

ALTER TABLE affiliate_affiliate
    ADD affiliate_newsletter char(1) NOT NULL DEFAULT '1' AFTER affiliate_root;

ALTER TABLE affiliate_banners
    ADD affiliate_category_id int(11) NOT NULL DEFAULT '0' AFTER affiliate_products_id;

ALTER TABLE banners
    ADD INDEX idx_banners_group (banners_group);

ALTER TABLE banners_history
    ADD INDEX idx_banners_history_banners_id (banners_id);

ALTER TABLE configuration
    MODIFY configuration_title varchar(255) NOT NULL DEFAULT '',
    MODIFY configuration_key varchar(255) NOT NULL DEFAULT '';

ALTER TABLE currencies
    ADD INDEX idx_currencies_code (code);

ALTER TABLE customers
    ADD customers_login varchar(96) NULL DEFAULT NULL AFTER customers_newsletter,
    ADD UNIQUE idx_customers_login (customers_login),
    ADD INDEX idx_customers_email_address (customers_email_address);

ALTER TABLE customers_basket
    ADD INDEX idx_customers_basket_customers_id (customers_id);

ALTER TABLE customers_basket_attributes
    ADD INDEX idx_customers_basket_att_customers_id (customers_id);

ALTER TABLE orders
    ADD customers_dummy_account tinyint(3) unsigned NOT NULL AFTER customers_address_format_id,
    ADD shipping_module varchar(255) NULL DEFAULT NULL AFTER shipping_tax,
    MODIFY payment_method varchar(255) NOT NULL,
    ADD INDEX idx_orders_customers_id (customers_id);

ALTER TABLE orders_products
    ADD INDEX idx_orders_products_orders_id (orders_id),
    ADD INDEX idx_orders_products_products_id (products_id);

ALTER TABLE orders_products_attributes
    ADD INDEX idx_orders_products_att_orders_id (orders_id);

ALTER TABLE orders_products_download
    ADD INDEX idx_orders_products_download_orders_id (orders_id);

ALTER TABLE orders_status
    ADD public_flag int(11) NULL DEFAULT '1' AFTER orders_status_name,
    ADD downloads_flag int(11) NULL DEFAULT '0' AFTER public_flag;

ALTER TABLE orders_status_history
    ADD INDEX idx_orders_status_history_orders_id (orders_id);

ALTER TABLE products
    ADD INDEX idx_products_model (products_model);

ALTER TABLE products_attributes
    ADD INDEX idx_products_attributes_products_id (products_id);

ALTER TABLE reviews
    ADD INDEX idx_reviews_products_id (products_id),
    ADD INDEX idx_reviews_customers_id (customers_id);

ALTER TABLE scart
    ADD datemodified varchar(8) NOT NULL DEFAULT '' AFTER dateadded,
    ADD UNIQUE scartid (scartid),
    ADD UNIQUE customers_id (customers_id);

ALTER TABLE specials
    ADD INDEX idx_specials_products_id (products_id);

ALTER TABLE whos_online
    MODIFY last_page_url text NOT NULL;

ALTER TABLE zones
    ADD INDEX idx_zones_country_id (zone_country_id),
    ADD INDEX idx_zones_to_geo_zones_country_id (zone_country_id);

ALTER TABLE zones_to_geo_zones
    ADD INDEX idx_zones_to_geo_zones_country_id (zone_country_id);

#
# DELETED TABLE VALUES
#
DELETE FROM configuration WHERE configuration.configuration_key = 'SEO_URLS' LIMIT 1 ;
DELETE FROM configuration WHERE configuration.configuration_key = 'SEO_URLS_TYPE' LIMIT 1 ;
DELETE FROM configuration WHERE configuration.configuration_key = 'SEO_URLS_FILTER_SHORT_WORDS' LIMIT 1 ;
DELETE FROM configuration WHERE configuration.configuration_key = 'SEO_URLS_CACHE_RESET' LIMIT 1 ;
DELETE FROM configuration WHERE configuration.configuration_key = 'DISPLAY_PAYMENT_METHOD_DROPDOWN' LIMIT 1 ;

#
# UPDATED TABLE VALUES
#
UPDATE admin SET admin_username = admin_email_address;

UPDATE configuration SET configuration_description = 'Monitor Live-html,It updates as you type in a 2nd field above it.<p><p>Disable Debug = 0<p>Enable Debug = 1<p>Default = 0 OFF' WHERE configuration.configuration_id =534 LIMIT 1 ;
UPDATE configuration SET configuration_group_id = '25' WHERE configuration.configuration_group_id =112 ;
UPDATE configuration SET configuration_group_id = '30' WHERE configuration.configuration_group_id =899 ;
UPDATE configuration SET configuration_group_id = '45' WHERE configuration.configuration_group_id =901 ;
UPDATE configuration SET configuration_group_id = '50' WHERE configuration.configuration_group_id =888001 ;
UPDATE configuration SET configuration_group_id = '55' WHERE configuration.configuration_group_id =26229 ;


UPDATE configuration_group SET configuration_group_id = '25', configuration_group_title = 'WYSIWYG Editor', configuration_group_description = 'HTMLArea Options', sort_order = '15' WHERE configuration_group.configuration_group_id =112 LIMIT 1 ;
UPDATE configuration_group SET configuration_group_id = '30', sort_order = '30', sort_order = '30' WHERE configuration_group.configuration_group_id =899 LIMIT 1 ;
UPDATE configuration_group SET configuration_group_id = '35', sort_order = '50' WHERE configuration_group.configuration_group_id =900 LIMIT 1 ;
UPDATE configuration_group SET configuration_group_id = '45', sort_order = '45', sort_order = '45' WHERE configuration_group.configuration_group_id =901 LIMIT 1 ;
UPDATE configuration_group SET configuration_group_id = '50', sort_order = '8' WHERE configuration_group.configuration_group_id =888001 LIMIT 1 ;
UPDATE configuration_group SET configuration_group_id = '55', sort_order = '20' WHERE configuration_group.configuration_group_id =26229 LIMIT 1 ;
UPDATE configuration_group SET configuration_group_id = '60', sort_order = '902' WHERE configuration_group.configuration_group_id =888002 LIMIT 1 ;

#
# ADDED TABLE VALUES
#
INSERT INTO admin_files (admin_files_name,admin_files_is_boxes,admin_files_to_boxes,admin_groups_id) VALUES ('affiliate_news.php','0','43','1');
INSERT INTO admin_files (admin_files_name,admin_files_is_boxes,admin_files_to_boxes,admin_groups_id) VALUES ('affiliate_newsletters.php','0','43','1');
INSERT INTO admin_files (admin_files_name,admin_files_is_boxes,admin_files_to_boxes,admin_groups_id) VALUES ('affiliate_validcats.php','0','43','1');
INSERT INTO admin_files (admin_files_name,admin_files_is_boxes,admin_files_to_boxes,admin_groups_id) VALUES ('affiliate_validproducts.php','0','43','1');
INSERT INTO admin_files (admin_files_name,admin_files_is_boxes,admin_files_to_boxes,admin_groups_id) VALUES ('edit_orders_add_product.php','0','5','1');
INSERT INTO admin_files (admin_files_name,admin_files_is_boxes,admin_files_to_boxes,admin_groups_id) VALUES ('edit_orders_ajax.php','0','5','1');
INSERT INTO admin_files (admin_files_name,admin_files_is_boxes,admin_files_to_boxes,admin_groups_id) VALUES ('attributeManager.php','0','3','1');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Product Quantities In Shopping Cart','MAX_QTY_IN_CART','99','Maximum number of product quantities that can be added to the shopping cart (0 for no limit)','3','19','', now(),'','');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Enable SEO URLs?', 'SEO_ENABLED', 'false', 'Enable the SEO URLs?  This is a global setting and will turn them off completely.', '60', '0', '2009-02-25 22:59:02', '2009-02-25 22:57:59', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Add cPath to product URLs?', 'SEO_ADD_CPATH_TO_PRODUCT_URLS', 'false', 'This setting will append the cPath to the end of product URLs (i.e. - some-product-p-1.html?cPath=xx).', '60', '1', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Add category parent to begining of URLs?', 'SEO_ADD_CAT_PARENT', 'false', 'This setting will add the category parent name to the beginning of the category URLs (i.e. - parent-category-c-1.html).', '60', '2', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Filter Short Words', 'SEO_URLS_FILTER_SHORT_WORDS', '3', 'This setting will filter words less than or equal to the value from the URL.', '60', '3', NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Output W3C valid URLs (parameter string)?', 'SEO_URLS_USE_W3C_VALID', 'false', 'This setting will output W3C valid URLs.', '60', '4', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Enable SEO cache to save queries?', 'USE_SEO_CACHE_GLOBAL', 'false', 'This is a global setting and will turn off caching completely.', '60', '5', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Enable product cache?', 'USE_SEO_CACHE_PRODUCTS', 'true', 'This will turn off caching for the products.', '60', '6', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Enable categories cache?', 'USE_SEO_CACHE_CATEGORIES', 'true', 'This will turn off caching for the categories.', '60', '7', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Enable manufacturers cache?', 'USE_SEO_CACHE_MANUFACTURERS', 'true', 'This will turn off caching for the manufacturers.', '60', '8', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Enable articles cache?', 'USE_SEO_CACHE_ARTICLES', 'true', 'This will turn off caching for the articles.', '60', '9', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Enable topics cache?', 'USE_SEO_CACHE_TOPICS', 'true', 'This will turn off caching for the article topics.', '60', '10', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Enable information cache?', 'USE_SEO_CACHE_INFO_PAGES', 'true', 'This will turn off caching for the information pages.', '60', '11', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Enable automatic redirects?', 'USE_SEO_REDIRECT', 'false', 'This will activate the automatic redirect code and send 301 headers for old to new URLs.', '60', '12', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Choose URL Rewrite Type', 'SEO_REWRITE_TYPE', 'Rewrite', 'Choose which SEO URL format to use.', '60', '13', NULL, now(), NULL, 'tep_cfg_select_option(array(\'Rewrite\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Enter special character conversions', 'SEO_CHAR_CONVERT_SET', '', 'This setting will convert characters.<br><br>The format <b>MUST</b> be in the form: <b>char=>conv,char2=>conv2</b>', '60', '14', NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Remove all non-alphanumeric characters?', 'SEO_REMOVE_ALL_SPEC_CHARS', 'false', 'This will remove all non-letters and non-numbers.  This should be handy to remove all special characters with 1 setting.', '60', '15', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Reset SEO URLs Cache', 'SEO_URLS_CACHE_RESET', 'false', 'This will reset the cache data for SEO', '60', '16', NULL, now(), 'tep_reset_cache_data_seo_urls', 'tep_cfg_select_option(array(\'reset\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Enable Seo URL validation?', 'FWR_VALIDATION_ON', 'false', 'Enable the SEO URL validation?', '75', '1', NULL, '2009-02-25 22:57:25', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Admin Editor Default Width', 'HTML_AREA_WYSIWYG_EDITOR_WIDTH', '550', 'How WIDE should the HTMLAREA be in pixels (default: 550)', '25', '66', NULL, now(), NULL, '');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Admin Editor Default Height', 'HTML_AREA_WYSIWYG_EDITOR_HEIGHT', '300', 'How HIGH should the HTMLAREA be in pixels (default: 300)', '25', '67', NULL, now(), NULL, '');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('E-Mail Address', 'AFFILIATE_EMAIL_ADDRESS', '<affiliate@localhost.com>', 'The E Mail Address for the Affiliate Program', '35', '1', NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Affiliate Pay Per Sale Payment % Rate', 'AFFILIATE_PERCENT', '10.0000', 'Percentage Rate for the Affiliate Program', '35', '2', NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Payment Threshold', 'AFFILIATE_THRESHOLD', '50.00', 'Payment Threshold for paying affiliates', '35', '3', NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Cookie Lifetime', 'AFFILIATE_COOKIE_LIFETIME', '7200', 'How long does the click count (seconds) if customer comes back', '35', '4', NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Billing Time', 'AFFILIATE_BILLING_TIME', '30', 'Orders billed must be at least \"30\" days old.<br>This is needed if a order is refunded', '35', '5', NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Order Min Status', 'AFFILIATE_PAYMENT_ORDER_MIN_STATUS', '3', 'The status an order must have at least,to be billed', '35', '6', NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Pay Affiliates with check', 'AFFILIATE_USE_CHECK', 'true', 'Pay Affiliates with check', '35', '7', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Pay Affiliates with PayPal', 'AFFILIATE_USE_PAYPAL', 'true', 'Pay Affiliates with PayPal', '35', '8', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Pay Affiliates by Bank', 'AFFILIATE_USE_BANK', 'true', 'Pay Affiliates by Bank', '35', '9', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Individual Affiliate Percentage', 'AFFILATE_INDIVIDUAL_PERCENTAGE', 'true', 'Allow per Affiliate provision', '35', '10', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Use Affiliate-tier', 'AFFILATE_USE_TIER', 'false', 'Multilevel Affiliate provisions', '35', '11', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Number of Tierlevels', 'AFFILIATE_TIER_LEVELS', '0', 'Number of Tierlevels', '35', '12', NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Percentage Rate for the Tierlevels', 'AFFILIATE_TIER_PERCENTAGE', '', 'Percent Rates for the tierlevels<br>Example:', '35', '13', NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Affiliate News', 'MAX_DISPLAY_AFFILIATE_NEWS', '3', 'Maximum number of items to display on the Affiliate News page', '35', '14', NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Max Wish List', 'MAX_DISPLAY_WISHLIST_PRODUCTS', '12', 'How many wish list items to show per page on the main wishlist.php file', '65', '0', NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Max Wish List Box', 'MAX_DISPLAY_WISHLIST_BOX', '4', 'How many wish list items to display in the infobox before it changes to a counter', '65', '0', NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Display Emails', 'DISPLAY_WISHLIST_EMAILS', '10', 'How many emails to display when the customer emails their wishlist link', '65', '0', NULL, now(), NULL, NULL);
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Wishlist Redirect', 'WISHLIST_REDIRECT', 'No', 'Do you want to redirect back to the product_info.php page when a customer adds a product to their wishlist?', '65', '0', NULL, now(), NULL, 'tep_cfg_select_option(array(\'Yes\',\'No\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Display the Payment Method dropdown?', 'ORDER_EDITOR_PAYMENT_DROPDOWN', 'true', 'Based on this selection Order Editor will display the payment method as a dropdown menu (true) or as an input field (false).', '70', '1', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Use prices from Separate Pricing Per Customer?', 'ORDER_EDITOR_USE_SPPC', 'false', 'Leave this set at false unless SPPC is installed.', '70', '3', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Allow the use of AJAX to update order information?', 'ORDER_EDITOR_USE_AJAX', 'true', 'This must be set to false if using a browser on which JavaScript is disabled or not available.', '70', '4', NULL, now(), NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Select your credit card payment method', 'ORDER_EDITOR_CREDIT_CARD', 'Credit Card', 'Order Editor will display the credit card fields when this payment method is selected.', '70', '5', NULL, now(), NULL, 'tep_cfg_pull_down_payment_methods(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Purchase without account', 'PURCHASE_WITHOUT_ACCOUNT', 'yes', 'Do you allow customers to purchase without an account?', '5', '10', NULL, now(), NULL, 'tep_cfg_select_option(array(\'yes\',\'no\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Purchase without account shipping address', 'PURCHASE_WITHOUT_ACCOUNT_SEPARATE_SHIPPING', 'yes', 'Do you allow customers without account to create separately shipping address?', '5', '11', NULL, now(), NULL, 'tep_cfg_select_option(array(\'yes\',\'no\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Dimensions Support', 'SHIPPING_DIMENSIONS_SUPPORT', 'No', 'Do you use the additional dimensions support (read dimensions.txt in the UPSXML package)?', '7', '6', NULL, '2009-03-07 13:49:41', NULL, 'tep_cfg_select_option(array(\'No\', \'Ready-to-ship only\', \'With product dimensions\'), ');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Unit Weight', 'SHIPPING_UNIT_WEIGHT', 'LBS', 'By what unit are your packages weighed?', '7', '7', NULL, '2009-03-07 13:49:41', NULL, 'tep_cfg_select_option(array(\'LBS\', \'KGS\'), ');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Unit Length', 'SHIPPING_UNIT_LENGTH', 'IN', 'By what unit are your packages sized?', '7', '8', NULL, '2009-03-07 13:49:41', NULL, 'tep_cfg_select_option(array(\'IN\', \'CM\'), ');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Store result of packing routines', 'SHIPPING_STORE_BOXES_USED', 'false', 'Do you want to store the results of the packing routines in the database? See file store_ups_boxes_used.txt in UPSXML package for details and modifications needed.', '7', '9', NULL, '2009-03-07 13:49:41', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'), ');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Look back days', 'RCS_BASE_DAYS', '30', 'Number of days to look back from today for abandoned carts.', '80', '10', NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Skip days', 'RCS_SKIP_DAYS', '5', 'Number of days to skip when looking for abandoned carts.', '80', '11', NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Sales Results Report days', 'RCS_REPORT_DAYS', '90', 'Number of days the sales results report takes into account. The more days the longer the SQL queries!.', '80', '15', NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Use Calculated taxes', 'RCS_INCLUDE_TAX_IN_PRICES', 'false', 'Try to calculate the tax when determining prices. This may not be 100% correct as determing location being shopped from, etc. may be incorrect.', '80', '16', NULL, '2009-03-07 22:31:53', '', 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Use Fixed tax rate', 'RCS_USE_FIXED_TAX_IN_PRICES', 'false', 'Use a fixed tax rate when determining prices (rate set below). Overridden if \'Use Calculated taxes\' is true.', '80', '17', NULL, '2009-03-07 22:31:53', '', 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Fixed Tax Rate', 'RCS_FIXED_TAX_RATE', '10.00', 'The fixed tax rate for use when \'Use Fixed tax rate\' is true and \'Use Calculated taxes\' is false.<br><br>Use decimal VALUES, ie: 8.50 for 8 1/2%', '80', '18', NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('E-Mail time to live', 'RCS_EMAIL_TTL', '90', 'Number of days to give for emails before they no longer show as being sent', '80', '20', NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Friendly E-Mails', 'RCS_EMAIL_FRIENDLY', 'true', 'If <b>true</b> then the customer\'s name will be used in the greeting. If <b>false</b> then a generic greeting will be used.', '80', '30', NULL, '2009-03-07 22:31:53', '', 'tep_cfg_select_option(array(\'true\', \'false\'),');

INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('E-Mail Copies to', 'RCS_EMAIL_COPIES_TO', '', 'If you want copies of emails that are sent to customers by this contribution, enter the email address here. If empty no copies are sent', '80', '35', NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Show Attributes', 'RCS_SHOW_ATTRIBUTES', 'false', 'Controls display of item attributes.<br><br>Some sites have attributes for their items.<br><br>Set this to <b>true</b> if yours does and you want to show them, otherwise set to <b>false</b>.', '80', '40', NULL, '2009-03-07 22:31:53', '', 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Ignore Customers with Sessions', 'RCS_CHECK_SESSIONS', 'false', 'If you want the tool to ignore customers with an active session (ie, probably still shopping) set this to <b>true</b>.<br><br>Setting this to <b>false</b> will operate in the default manner of ignoring session data & using less resources.', '80', '40', NULL, '2009-03-07 22:31:53', '', 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Current Customer Color', 'RCS_CURCUST_COLOR', '0000FF', 'Color for the word/phrase used to notate a current customer<br><br>A current customer is someone who has purchased items from your store in the past.', '80', '50', NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Uncontacted hilight color', 'RCS_UNCONTACTED_COLOR', '9FFF9F', 'Row highlight color for uncontacted customers.<br><br>An uncontacted customer is one that you have <i>not</i> used this tool to send an email to before.', '80', '60', NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Contacted hilight color', 'RCS_CONTACTED_COLOR', 'FF9F9F', 'Row highlight color for contacted customers.<br><br>An contacted customer is one that you <i>have</i> used this tool to send an email to before.', '80', '70', NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Matching Order Hilight', 'RCS_MATCHED_ORDER_COLOR', '9FFFFF', 'Row highlight color for entrees that may have a matching order.<br><br>An entry will be marked with this color if an order contains one or more of an item in the abandoned cart <b>and</b> matches either the cart\'s customer email address or database ID.', '80', '72', NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Skip Carts w/Matched Orders', 'RCS_SKIP_MATCHED_CARTS', 'true', 'To ignore carts with an a matching order set this to <b>true</b>.<br><br>Setting this to <b>false</b> will cause entries with a matching order to show, along with the matching order\'s status.<br><br>See documentation for details.', '80', '80', NULL, '2009-03-07 22:31:53', '', 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Autocheck \"safe\" carts to email', 'RCS_AUTO_CHECK', 'true', 'To check entries which are most likely safe to email (ie, not existing customers, not previously emailed, etc.) set this to <b>true</b>.<br><br>Setting this to <b>false</b> will leave all entries unchecked (must manually check entries to send an email to)', '80', '82', NULL, '2009-03-07 22:31:53', '', 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Match orders from any date', 'RCS_CARTS_MATCH_ALL_DATES', 'true', 'If <b>true</b> then any order found with a matching item will be considered a matched order.<br><br>If <b>false</b> only orders placed after the abandoned cart are considered.', '80', '84', NULL, '2009-03-07 22:31:53', '', 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Lowest Pending sales status', 'RCS_PENDING_SALE_STATUS', '1', 'The highest value that an order can have and still be considered pending. Any value higher than this will be considered by RCS as sale which completed.<br><br>See documentation for details.', '80', '85', NULL, '2009-03-07 22:31:53', 'tep_get_order_status_name', 'tep_cfg_pull_down_order_statuses(');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Report Even Row Style', 'RCS_REPORT_EVEN_STYLE', 'dataTableRow', 'Style for even rows in results report. Typical options are <i>dataTableRow</i> and <i>attributes-even</i>.', '80', '90', NULL, '2009-03-07 22:31:53', '', '');
INSERT INTO configuration (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, last_modified, date_added, use_function, set_function) VALUES ('Report Odd Row Style', 'RCS_REPORT_ODD_STYLE', '', 'Style for odd rows in results report. Typical options are NULL (ie, no entry) and <i>attributes-odd</i>.', '80', '92', NULL, '2009-03-07 22:31:53', '', '');

INSERT INTO configuration_group (configuration_group_id,configuration_group_title,configuration_group_description,sort_order,visible) VALUES ('65','Wish List Settings','Settings for your Wish List','25','1');
INSERT INTO configuration_group (configuration_group_id,configuration_group_title,configuration_group_description,sort_order,visible) VALUES ('70','Order Editor','Configuration options for Order Editor','903','1');
INSERT INTO configuration_group (configuration_group_id,configuration_group_title,configuration_group_description,sort_order,visible) VALUES ('75','SEO URL Validation','Validation For Ultimate SEO URLs','950','1');
INSERT INTO configuration_group (configuration_group_id,configuration_group_title,configuration_group_description,sort_order,visible) VALUES ('80','Recover Cart Sales','Recover Cart Sales (RCS) Configuration Values','55','1');

INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('1','3','Pendiente','1','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('2','3','Proceso','1','1');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('100000','3','Updated','1','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('100002','1','Preparing [PayPal Standard]','0','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('100002','2','Preparing [PayPal Standard]','0','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('100002','3','Preparing [PayPal Standard]','0','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('100003','1','Sofortüberweisung Vorbereitung','0','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('100003','2','Sofortüberweisung Vorbereitung','0','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('100003','3','Sofortüberweisung Vorbereitung','0','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('100','1','Google New','1','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('100','2','Google New','1','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('100','3','Google New','1','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('101','1','Google Processing','1','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('101','2','Google Processing','1','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('101','3','Google Processing','1','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('102','1','Google Shipped','1','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('102','2','Google Shipped','1','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('102','3','Google Shipped','1','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('103','1','Google Refunded','1','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('103','2','Google Refunded','1','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('103','3','Google Refunded','1','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('104','1','Google Shipped and Refunded','1','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('104','2','Google Shipped and Refunded','1','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('104','3','Google Shipped and Refunded','1','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('105','1','Google Canceled','1','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('105','2','Google Canceled','1','0');
INSERT INTO orders_status (orders_status_id,language_id,orders_status_name,public_flag,downloads_flag) VALUES ('105','3','Google Canceled','1','0');
