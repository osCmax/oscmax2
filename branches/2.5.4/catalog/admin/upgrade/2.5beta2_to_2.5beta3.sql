#$Id:$
#
# Upgrade database - osCMax v2.5 Beta 2 to v2.5 Beta 3 
#
# # It is higly suggested that you first try this script on a TEST version or copy of your store - not a LIVE/Production.
#
##
# NEW TABLES
#
# No New Tables in this release
#
# CHANGED TABLES
#

ALTER TABLE configuration 
	CHANGE set_function set_function text NULL after use_function, COMMENT='';


ALTER TABLE information 
	ADD COLUMN information_url varchar(255) NOT NULL after information_description, 
	ADD COLUMN information_target varchar(255) NOT NULL after information_url, 
	CHANGE parent_id parent_id int(11) NULL after information_target, 
	CHANGE sort_order sort_order tinyint(3) unsigned NOT NULL DEFAULT '0' after parent_id, 
	CHANGE visible visible enum('1','0') NOT NULL DEFAULT '1' after sort_order, 
	CHANGE language_id language_id int(11) NOT NULL DEFAULT '0' after visible, COMMENT='';


ALTER TABLE manufacturers_info 
	ADD COLUMN manufacturers_description text NULL after manufacturers_url, 
	CHANGE url_clicked url_clicked int(5) NOT NULL DEFAULT '0' after manufacturers_description, 
	CHANGE date_last_click date_last_click datetime NULL after url_clicked, COMMENT='';


ALTER TABLE reviews 
	ADD COLUMN approved tinyint(3) unsigned NULL DEFAULT '0' after reviews_rating, 
	CHANGE date_added date_added datetime NULL after approved, 
	CHANGE last_modified last_modified datetime NULL after date_added, 
	CHANGE reviews_read reviews_read int(5) NOT NULL DEFAULT '0' after last_modified, COMMENT='';


#Data Changes
/* SYNC TABLE : admin_files */
INSERT INTO admin_files VALUES ('163', 'gc_dashboard.php', '0', '4', '1');

/* SYNC TABLE : configuration */
INSERT INTO configuration VALUES ('2103', 'Replace missing product images with default image?', 'PRODUCT_IMAGE_REPLACE', 'true', 'Do you want to replace any missing thumbnail images in your store with a default image?', '4', '1', NULL, '', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES ('2665', 'Enable customer product reviews?', 'PRODUCT_REVIEWS_ENABLE', 'True', 'Do you want to allow customers to write product reviews?', '8', '22', NULL, '', NULL, 'tep_cfg_select_option(array(\'True\', \'False\'),');
INSERT INTO configuration VALUES ('2666', 'Affiliate Info Information Manager Info Number', 'DEFINE_AFFILIATE_INFO_INFO_NO', '15', 'What number is the Affiliate Info in the Information Manager? (Default: 15)', '201', '32', '', '', NULL, NULL);
INSERT INTO configuration VALUES ('497', 'Image Zoomer on product info page', 'IMAGEZOOMER', 'true', 'Do you want to use the javscript image zoomer on your product pages?', '45', '30', NULL, '', NULL, 'tep_cfg_select_option(array(\'true\', \'false\'),');
INSERT INTO configuration VALUES ('2664', 'Use Basket or Cart', 'BASKET_CART', 'cart', 'What do you want to call the thing your customers put their products in?', '201', '30', NULL, '', NULL, 'tep_cfg_select_option(array(\'cart\', \'basket\'),');
INSERT INTO configuration VALUES ('193', 'Admin Listing Results', 'MAX_DISPLAY_SEARCH_RESULTS', '20', 'Amount of products or items to list within the admin panel', '3', '2', NULL, '', NULL, NULL);
UPDATE configuration SET configuration_id='36', configuration_title='Catalog Search Results', configuration_key='MAX_CATALOG_DISPLAY_SEARCH_RESULTS', configuration_value='20', configuration_description='Amount of products to list in the catalog', configuration_group_id='3', sort_order='2', last_modified=NULL, date_added='', use_function=NULL, set_function=NULL  WHERE (configuration_id = 36) ;
UPDATE configuration SET configuration_id='55', configuration_title='Small Image Width', configuration_key='SMALL_IMAGE_WIDTH', configuration_value='120', configuration_description='The pixel width of small images', configuration_group_id='4', sort_order='2', last_modified=NULL, date_added='', use_function=NULL, set_function=NULL  WHERE (configuration_id = 55) ;
UPDATE configuration SET configuration_id='56', configuration_title='Small Image Height', configuration_key='SMALL_IMAGE_HEIGHT', configuration_value='', configuration_description='The pixel height of small images', configuration_group_id='4', sort_order='3', last_modified=NULL, date_added='', use_function=NULL, set_function=NULL  WHERE (configuration_id = 56) ;
UPDATE configuration SET configuration_id='57', configuration_title='Heading Image Width', configuration_key='HEADING_IMAGE_WIDTH', configuration_value='100', configuration_description='The pixel width of heading images', configuration_group_id='4', sort_order='4', last_modified=NULL, date_added='', use_function=NULL, set_function=NULL  WHERE (configuration_id = 57) ;
UPDATE configuration SET configuration_id='58', configuration_title='Heading Image Height', configuration_key='HEADING_IMAGE_HEIGHT', configuration_value='', configuration_description='The pixel height of heading images', configuration_group_id='4', sort_order='5', last_modified=NULL, date_added='', use_function=NULL, set_function=NULL  WHERE (configuration_id = 58) ;
UPDATE configuration SET configuration_id='59', configuration_title='Subcategory Image Width', configuration_key='SUBCATEGORY_IMAGE_WIDTH', configuration_value='100', configuration_description='The pixel width of subcategory images', configuration_group_id='4', sort_order='6', last_modified=NULL, date_added='', use_function=NULL, set_function=NULL  WHERE (configuration_id = 59) ;
UPDATE configuration SET configuration_id='60', configuration_title='Subcategory Image Height', configuration_key='SUBCATEGORY_IMAGE_HEIGHT', configuration_value='57', configuration_description='The pixel height of subcategory images', configuration_group_id='4', sort_order='7', last_modified=NULL, date_added='', use_function=NULL, set_function=NULL  WHERE (configuration_id = 60) ;
UPDATE configuration SET configuration_id='61', configuration_title='Calculate Image Size', configuration_key='CONFIG_CALCULATE_IMAGE_SIZE', configuration_value='true', configuration_description='Calculate the size of images?', configuration_group_id='4', sort_order='8', last_modified=NULL, date_added='', use_function=NULL, set_function='tep_cfg_select_option(array(\'true\', \'false\'),'  WHERE (configuration_id = 61) ;
UPDATE configuration SET configuration_id='62', configuration_title='Category Image Required?', configuration_key='CATEGORY_IMAGE_REQUIRED', configuration_value='true', configuration_description='Enable to display broken category images. Good for development.', configuration_group_id='4', sort_order='1', last_modified=NULL, date_added='', use_function=NULL, set_function='tep_cfg_select_option(array(\'true\', \'false\'),'  WHERE (configuration_id = 62) ;
UPDATE configuration SET configuration_id='192', configuration_title='Display Category Descriptions', configuration_key='ALLOW_CATEGORY_DESCRIPTIONS', configuration_value='true', configuration_description='Do you want to display category descriptions in your store?', configuration_group_id='8', sort_order='11', last_modified=NULL, date_added='', use_function=NULL, set_function='tep_cfg_select_option(array(\'true\', \'false\'),'  WHERE (configuration_id = 192) ;
UPDATE configuration SET configuration_id='594', configuration_title='Display stock information', configuration_key='PRODINFO_ATTRIBUTE_DISPLAY_STOCK_LIST', configuration_value='true', configuration_description='<b>If true:</b> A table with information about what\'s in stock will be displayed. If the product doesn\'t have any attributes with tracked stock, the table won\'t be displayed.<br /><br /><b>Default is false.</b>', configuration_group_id='9', sort_order='6', last_modified=NULL, date_added='', use_function=NULL, set_function='tep_cfg_select_option(array(\'true\', \'false\'),'  WHERE (configuration_id = 594) ;
UPDATE configuration SET configuration_id='2663', configuration_title='Main Page Text Information Manager Info Number', configuration_key='DEFINE_MAINPAGE_TEXT_INFO_NO', configuration_value='13', configuration_description='What number is the Main Page in the Information Manager? (Default: 13)', configuration_group_id='201', sort_order='31', last_modified='', date_added='', use_function=NULL, set_function=NULL  WHERE (configuration_id = 2663) ;

/* SYNC TABLE : pm_configuration */
INSERT INTO pm_configuration VALUES ('15', 'New Products', '', 'new_products.php', 'yes', 'nested', '1', '', '');

/* SYNC TABLE : information */
INSERT INTO information VALUES ('15', '1', 'Informaci?n de afiliado', '<p>\r\n	Su Informaci&oacute;n del Afiliado va en este</p>', '', '_top', '0', '8', '1', '3');
INSERT INTO information VALUES ('15', '1', 'Affiliate Information', '<p>\r\n	Your Affiliate Information Goes in Here</p>', '', '_top', '0', '8', '1', '1');
INSERT INTO information VALUES ('15', '1', 'Werbepartner Informationen', '<p>\r\n	F&uuml;gen Sie hier Ihre Informationen zum Werbepartnerprogramm ein.</p>', '', '_top', '0', '8', '1', '2');
UPDATE information SET information_id='2', information_group_id='2', information_title='TEXT_GREETING_PERSONAL_RELOGON', information_description='<small>If you are not %s, please <a href=\"%s\"><u>log yourself in</u></a> with your account information.</small>', information_url='', information_target='_top', parent_id='0', sort_order='2', visible='1', language_id='1'  WHERE (information_id = 2 AND language_id = 1) ;
UPDATE information SET information_id='2', information_group_id='2', information_title='TEXT_GREETING_PERSONAL_RELOGON', information_description='<small>Wenn Sie nicht %s sind, melden Sie sich bitte <a href=\"%s\"><u>hier</u></a> mit Ihrem Kundenkonto an.</small>', information_url='', information_target='_top', parent_id='0', sort_order='2', visible='1', language_id='2'  WHERE (information_id = 2 AND language_id = 2) ;
UPDATE information SET information_id='2', information_group_id='2', information_title='TEXT_GREETING_PERSONAL_RELOGON', information_description='<small>Si no es %s, por favor <a href=\"%s\"><u>entre aqui</u></a> e introduzca sus datos.</small>', information_url='', information_target='_top', parent_id='0', sort_order='2', visible='1', language_id='3'  WHERE (information_id = 2 AND language_id = 3) ;
UPDATE information SET information_id='3', information_group_id='2', information_title='TEXT_GREETING_GUEST', information_description='Welcome <span class=\"greetUser\">Guest!</span> Would you like to <a href=\"%s\"><u>log yourself in</u></a>? Or would you prefer to <a href=\"%s\"><u>create an account</u></a>?', information_url='', information_target='_top', parent_id='0', sort_order='3', visible='1', language_id='1'  WHERE (information_id = 3 AND language_id = 1) ;
UPDATE information SET information_id='3', information_group_id='2', information_title='TEXT_GREETING_GUEST', information_description='Herzlich Willkommen <span class=\"greetUser\">Gast!</span> M&ouml;chten Sie sich <a href=\"%s\"><u>anmelden</u></a>? Oder wollen Sie ein <a href=\"%s\"><u>Kundenkonto</u></a> er&ouml;ffnen?', information_url='', information_target='_top', parent_id='0', sort_order='3', visible='1', language_id='2'  WHERE (information_id = 3 AND language_id = 2) ;
UPDATE information SET information_id='3', information_group_id='2', information_title='TEXT_GREETING_GUEST', information_description='Bienvenido <span class=\"greetUser\">Invitado!</span> &iquest;Le gustaria <a href=\"%s\"><u>entrar en su cuenta</u></a> o preferiria <a href=\"%s\"><u>crear una cuenta nueva</u></a>?', information_url='', information_target='_top', parent_id='0', sort_order='3', visible='1', language_id='3'  WHERE (information_id = 3 AND language_id = 3) ;
UPDATE information SET information_id='8', information_group_id='1', information_title='Shipping &amp; Returns', information_description='<p>\r\n	This Page is for your shipping policies. Edit this in your admin panel under Configuration &gt;&gt; Templates &gt;&gt; Information Pages</p>', information_url='', information_target='_top', parent_id='0', sort_order='3', visible='1', language_id='1'  WHERE (information_id = 8 AND language_id = 1) ;
UPDATE information SET information_id='8', information_group_id='1', information_title='Liefer- und Versandkosten', information_description='<p>\r\n	&nbsp;</p>\r\n<div style=\"font-family: Arial, Verdana, sans-serif; font-size: 12px; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); \">\r\n	<p>\r\n		This Page is for your shipping policies. Edit this in your admin panel under Configuration &gt;&gt; Templates &gt;&gt; Information Pages</p>\r\n</div>', information_url='', information_target='_top', parent_id='0', sort_order='3', visible='1', language_id='2'  WHERE (information_id = 8 AND language_id = 2) ;
UPDATE information SET information_id='8', information_group_id='1', information_title='Envios/Devoluciones', information_description='<p>\r\n	&nbsp;</p>\r\n<div style=\"font-family: Arial, Verdana, sans-serif; font-size: 12px; color: rgb(34, 34, 34); background-color: rgb(255, 255, 255); \">\r\n	<p>\r\n		This Page is for your shipping policies. Edit this in your admin panel under Configuration &gt;&gt; Templates &gt;&gt; Information Pages</p>\r\n</div>', information_url='', information_target='_top', parent_id='0', sort_order='3', visible='1', language_id='3'  WHERE (information_id = 8 AND language_id = 3) ;
UPDATE information SET information_id='9', information_group_id='1', information_title='Gift Voucher FAQ', information_description='<p>\r\n	<b>Purchasing Gift Vouchers</b></p>\r\n<p>\r\n	Gift Vouchers are purchased just like any other item in our store. You can pay for them using the store&#39;s standard payment method(s). Once purchased the value of the Gift Voucher will be added to your own personal Gift Voucher Account. If you have funds in your Gift Voucher Account, you will notice that the amount now shows in the Shopping Cart box, and also provides a link to a page where you can send the Gift Voucher to someone via email.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<b>How to Send Gift Vouchers</b></p>\r\n<p>\r\n	To send a Gift Voucher that you have purchased, you need to go to our Send Gift Voucher Page. You can find the link to this page in the Shopping Cart Box in the right hand column of each page. When you send a Gift Voucher, you need to specify the following:<br />\r\n	<br />\r\n	The name of the person you are sending the Gift Voucher to.<br />\r\n	The email address of the person you are sending the Gift Voucher to.<br />\r\n	The amount you want to send. (Note you don&#39;t have to send the full amount that is in your Gift Voucher Account.)&nbsp;<br />\r\n	A short message which will appear in the email.<br />\r\n	<br />\r\n	Please ensure that you have entered all of the information correctly, although you will be given the opportunity to change this as much as you want before the email is actually sent.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<b>Buying with Gift Vouchers</b></p>\r\n<p>\r\n	If you have funds in your Gift Voucher Account, you can use those funds to purchase other items in our store. At the checkout stage, an extra box will appear. Clicking this box will apply those funds in your Gift Voucher Account. Please note, you will still have to select another payment method if there is not enough in your Gift Voucher Account to cover the cost of your purchase. If you have more funds in your Gift Voucher Account than the total cost of your purchase the balance will be left in your Gift Voucher Account for the future.</p>\r\n<p>\r\n	&nbsp;</p>\r\n<p>\r\n	<b>Redeeming Gift Vouchers</b></p>\r\n<p>\r\n	If you receive a Gift Voucher by email it will contain details of who sent you the Gift Voucher, along with possibly a short message from them. The Email will also contain the Gift Voucher Number. It is probably a good idea to print out this email for future reference. You can now redeem the Gift Voucher in two ways:</p>\r\n<ol>\r\n	<li>\r\n		By clicking on the link contained within the email for this express purpose. This will take you to the store&#39;s Redeem Voucher page. you will then be requested to create an account, before the Gift Voucher is validated and placed in your Gift Voucher Account ready for you to spend it on whatever you want.<br />\r\n		&nbsp;</li>\r\n	<li>\r\n		During the checkout process, on the same page that you select a payment method there will be a box to enter a Redeem Code. Enter the code here, and click the redeem button. The code will be validated and added to your Gift Voucher account. You can then use the amount to purchase any item from our store</li>\r\n</ol>', information_url='', information_target='_top', parent_id='0', sort_order='4', visible='1', language_id='1'  WHERE (information_id = 9 AND language_id = 1) ;
UPDATE information SET information_id='9', information_group_id='1', information_title='Gutschein einl?sen', information_description='', information_url='', information_target='_top', parent_id='0', sort_order='4', visible='1', language_id='2'  WHERE (information_id = 9 AND language_id = 2) ;
UPDATE information SET information_id='9', information_group_id='1', information_title='Vale de Regalo FAQ', information_description='', information_url='', information_target='_top', parent_id='0', sort_order='4', visible='1', language_id='3'  WHERE (information_id = 9 AND language_id = 3) ;
UPDATE information SET information_id='10', information_group_id='1', information_title='Privacy Notice', information_description='<p>\r\n	Privacy Policy</p>', information_url='', information_target='_top', parent_id='0', sort_order='5', visible='1', language_id='1'  WHERE (information_id = 10 AND language_id = 1) ;
UPDATE information SET information_id='1', information_group_id='2', information_title='TEXT_GREETING_PERSONAL', information_description='Bienvenido de nuevo <span class=\"greetUser\">%s!</span> &iquest;Le gustaria ver que <a href=\"%s\"><u>nuevos productos</u></a> hay disponibles?', information_url='', information_target='_top', parent_id='0', sort_order='1', visible='1', language_id='3'  WHERE (information_id = 1 AND language_id = 3) ;
UPDATE information SET information_id='10', information_group_id='1', information_title='Confidencialidad', information_description='', information_url='', information_target='_top', parent_id='0', sort_order='5', visible='1', language_id='3'  WHERE (information_id = 10 AND language_id = 3) ;
UPDATE information SET information_id='11', information_group_id='1', information_title='Conditions of Use', information_description='<p>\r\n	Conditions of Use</p>', information_url='', information_target='_top', parent_id='0', sort_order='6', visible='1', language_id='1'  WHERE (information_id = 11 AND language_id = 1) ;
UPDATE information SET information_id='11', information_group_id='1', information_title='Unsere AGB\'s', information_description='<p>\r\n	Unsere AGB&#39;s</p>', information_url='', information_target='_top', parent_id='0', sort_order='6', visible='1', language_id='2'  WHERE (information_id = 11 AND language_id = 2) ;
UPDATE information SET information_id='11', information_group_id='1', information_title='Condiciones de uso', information_description='<p>\r\n	Condiciones de uso</p>', information_url='', information_target='_top', parent_id='0', sort_order='6', visible='1', language_id='3'  WHERE (information_id = 11 AND language_id = 3) ;
UPDATE information SET information_id='12', information_group_id='1', information_title='Down for maintenance', information_description='<p>The site is currently down for maintenance. Please excuse the dust, and try back later.</p>', information_url='', information_target='_top', parent_id='0', sort_order='2', visible='0', language_id='1'  WHERE (information_id = 12 AND language_id = 1) ;
UPDATE information SET information_id='12', information_group_id='1', information_title='Offen f?r Wartung', information_description='<p>Die Website ist derzeit f?r Wartungsarbeiten heruntergefahren. Bitte versuchen Sie es sp?ter noch einmal.</p>', information_url='', information_target='_top', parent_id='0', sort_order='2', visible='0', language_id='2'  WHERE (information_id = 12 AND language_id = 2) ;
UPDATE information SET information_id='12', information_group_id='1', information_title='Cerrado por mantenimiento', information_description='<p>El sitio est? actualmente cerrado por mantenimiento. Por favor, int?ntelo de nuevo m?s tarde.</p>', information_url='', information_target='_top', parent_id='0', sort_order='2', visible='0', language_id='3'  WHERE (information_id = 12 AND language_id = 3) ;
UPDATE information SET information_id='13', information_group_id='1', information_title='Index Page Text', information_description='<p><font face=\"arial, helvetica, sans-serif\">To modify the content of this page, go to your Admin Panel -> Configuration -> Templates -> Information Manager.</font></p><hr /><p><font face=\"arial, helvetica, sans-serif\">This is osCmax v2.5, the power e-commerce shopping cart system.</font></p><p><font face=\"Arial\">The official <strong><em>osCmax </em></strong>Support Site is <a href=\"http://www.oscmax.com/\"><font color=\"#800080\">http://www.oscmax.com</font></a> . There are very active support forums, the wiki, documentation, downloads, and everything else related to <strong><em>osCmax.</em></strong></font></p>', information_url='', information_target='_top', parent_id='0', sort_order='1', visible='0', language_id='1'  WHERE (information_id = 13 AND language_id = 1) ;
UPDATE information SET information_id='13', information_group_id='1', information_title='Index-Seite Text', information_description='<p><font face=\"arial, helvetica, sans-serif\">So ?ndern Sie den Inhalt dieser Seite, gehen Sie zu Admin Panel -> Konfiguration -> Templates -> Information Manager.</font></p><hr /><p><font face=\"arial, helvetica, sans-serif\">Dies ist osCmax v2.5, die Macht E-Commerce-Warenkorb-System.</font></p><p><font face=\"Arial\">Die offizielle osCMax Support Site ist http://www.oscmax.com. Es gibt sehr aktive Support-Foren, das Wiki, Dokumentation, Downloads und alles andere im Zusammenhang mit osCMax.</font></p>', information_url='', information_target='_top', parent_id='0', sort_order='1', visible='0', language_id='2'  WHERE (information_id = 13 AND language_id = 2) ;
UPDATE information SET information_id='13', information_group_id='1', information_title='?ndice Texto p?gina', information_description='<p><font face=\"arial, helvetica, sans-serif\">Para modificar el contenido de esta p?gina, vaya al Panel de Administraci?n -> Configuraci?n -> Plantillas -> Administrador de informaci?n.</font></p><hr /><p><font face=\"arial, helvetica, sans-serif\">Esto es osCmax v2.5, el poder de compras de comercio electr?nico sistema del carro.</font></p><p><font face=\"Arial\">El funcionario de Apoyo osCMax es http://www.oscmax.com. Hay foros de soporte muy activo, wiki, documentaci?n, descargas y todo lo relacionado con osCmax.</font></p>', information_url='', information_target='_top', parent_id='0', sort_order='1', visible='0', language_id='3'  WHERE (information_id = 13 AND language_id = 3) ;
UPDATE information SET information_id='14', information_group_id='1', information_title='Affiliate AGB', information_description='Legen Sie Ihre Affiliate-Bedingungen hier.', information_url='', information_target='_top', parent_id='0', sort_order='7', visible='0', language_id='2'  WHERE (information_id = 14 AND language_id = 2) ;
UPDATE information SET information_id='14', information_group_id='1', information_title='Afiliados T?rminos y Condiciones', information_description='Introduzca los t?rminos de afiliados y condiciones aqu', information_url='', information_target='_top', parent_id='0', sort_order='7', visible='0', language_id='3'  WHERE (information_id = 14 AND language_id = 3) ;
UPDATE information SET information_id='1', information_group_id='2', information_title='TEXT_GREETING_PERSONAL', information_description='Sch&ouml;n das Sie wieder da sind <span class=\"greetUser\">%s!</span> M&ouml;chten Sie die <a href=\"%s\"><u>neue Produkte</u></a> ansehen?', information_url='', information_target='_top', parent_id='0', sort_order='1', visible='1', language_id='2'  WHERE (information_id = 1 AND language_id = 2) ;
UPDATE information SET information_id='10', information_group_id='1', information_title='Privatsph?re und Datenschutz', information_description='', information_url='', information_target='_top', parent_id='0', sort_order='5', visible='1', language_id='2'  WHERE (information_id = 10 AND language_id = 2) ;
UPDATE information SET information_id='1', information_group_id='2', information_title='TEXT_GREETING_PERSONAL', information_description='Welcome back <span class=\"greetUser\">%s!</span> Would you like to see which <a href=\"%s\"><u>new products</u></a> are available to purchase?', information_url='', information_target='_top', parent_id='0', sort_order='1', visible='1', language_id='1'  WHERE (information_id = 1 AND language_id = 1) ;

/* SYNC TABLE : zones */
UPDATE zones SET zone_id='4152', zone_country_id='224', zone_code='NI', zone_name='Navassa Island'  WHERE (zone_id = 4152) ;
UPDATE zones SET zone_id='4307', zone_country_id='239', zone_code='MN', zone_name='Matabeleland North'  WHERE (zone_id = 4307) ;
UPDATE zones SET zone_id='4306', zone_country_id='239', zone_code='MV', zone_name='Masvingo'  WHERE (zone_id = 4306) ;
UPDATE zones SET zone_id='4305', zone_country_id='239', zone_code='MW', zone_name='Mashonaland West'  WHERE (zone_id = 4305) ;
UPDATE zones SET zone_id='4304', zone_country_id='239', zone_code='ME', zone_name='Mashonaland East'  WHERE (zone_id = 4304) ;
UPDATE zones SET zone_id='4303', zone_country_id='239', zone_code='MC', zone_name='Mashonaland Central'  WHERE (zone_id = 4303) ;
UPDATE zones SET zone_id='4302', zone_country_id='239', zone_code='ML', zone_name='Manicaland'  WHERE (zone_id = 4302) ;
UPDATE zones SET zone_id='4301', zone_country_id='239', zone_code='HA', zone_name='Harare'  WHERE (zone_id = 4301) ;
UPDATE zones SET zone_id='4300', zone_country_id='239', zone_code='BU', zone_name='Bulawayo'  WHERE (zone_id = 4300) ;
UPDATE zones SET zone_id='4299', zone_country_id='238', zone_code='WE', zone_name='Western'  WHERE (zone_id = 4299) ;
UPDATE zones SET zone_id='4298', zone_country_id='238', zone_code='SO', zone_name='Southern'  WHERE (zone_id = 4298) ;
UPDATE zones SET zone_id='4297', zone_country_id='238', zone_code='NW', zone_name='North-Western'  WHERE (zone_id = 4297) ;
UPDATE zones SET zone_id='4296', zone_country_id='238', zone_code='NO', zone_name='Northern'  WHERE (zone_id = 4296) ;
UPDATE zones SET zone_id='4295', zone_country_id='238', zone_code='LK', zone_name='Lusaka'  WHERE (zone_id = 4295) ;
UPDATE zones SET zone_id='4294', zone_country_id='238', zone_code='LP', zone_name='Luapula'  WHERE (zone_id = 4294) ;
UPDATE zones SET zone_id='4293', zone_country_id='238', zone_code='EA', zone_name='Eastern'  WHERE (zone_id = 4293) ;
UPDATE zones SET zone_id='4292', zone_country_id='238', zone_code='CB', zone_name='Copperbelt'  WHERE (zone_id = 4292) ;
UPDATE zones SET zone_id='4291', zone_country_id='238', zone_code='CE', zone_name='Central'  WHERE (zone_id = 4291) ;
UPDATE zones SET zone_id='4290', zone_country_id='237', zone_code='SK', zone_name='Sud-Kivu'  WHERE (zone_id = 4290) ;
UPDATE zones SET zone_id='4289', zone_country_id='237', zone_code='OR', zone_name='Orientale'  WHERE (zone_id = 4289) ;
UPDATE zones SET zone_id='4288', zone_country_id='237', zone_code='NK', zone_name='Nord-Kivu'  WHERE (zone_id = 4288) ;
UPDATE zones SET zone_id='4287', zone_country_id='237', zone_code='MA', zone_name='Maniema'  WHERE (zone_id = 4287) ;
UPDATE zones SET zone_id='4286', zone_country_id='237', zone_code='KW', zone_name='Kasai-Occidental'  WHERE (zone_id = 4286) ;
UPDATE zones SET zone_id='4285', zone_country_id='237', zone_code='KN', zone_name='Kinshasa'  WHERE (zone_id = 4285) ;
UPDATE zones SET zone_id='4284', zone_country_id='237', zone_code='KE', zone_name='Kasai-Oriental'  WHERE (zone_id = 4284) ;
UPDATE zones SET zone_id='4283', zone_country_id='237', zone_code='KA', zone_name='Katanga'  WHERE (zone_id = 4283) ;
UPDATE zones SET zone_id='4282', zone_country_id='237', zone_code='EQ', zone_name='Equateur'  WHERE (zone_id = 4282) ;
UPDATE zones SET zone_id='4281', zone_country_id='237', zone_code='BN', zone_name='Bandundu'  WHERE (zone_id = 4281) ;
UPDATE zones SET zone_id='4280', zone_country_id='237', zone_code='BC', zone_name='Bas-Congo'  WHERE (zone_id = 4280) ;
UPDATE zones SET zone_id='4279', zone_country_id='236', zone_code='VOJ', zone_name='Vojvodina'  WHERE (zone_id = 4279) ;
UPDATE zones SET zone_id='4278', zone_country_id='236', zone_code='SER', zone_name='Serbia'  WHERE (zone_id = 4278) ;
UPDATE zones SET zone_id='4277', zone_country_id='236', zone_code='MON', zone_name='Montenegro'  WHERE (zone_id = 4277) ;
UPDATE zones SET zone_id='4276', zone_country_id='236', zone_code='KOS', zone_name='Kosovo'  WHERE (zone_id = 4276) ;
UPDATE zones SET zone_id='4275', zone_country_id='235', zone_code='TA', zone_name='Ta\'izz'  WHERE (zone_id = 4275) ;
UPDATE zones SET zone_id='4274', zone_country_id='235', zone_code='SH', zone_name='Shabwah'  WHERE (zone_id = 4274) ;
UPDATE zones SET zone_id='4273', zone_country_id='235', zone_code='SN', zone_name='San\'a'  WHERE (zone_id = 4273) ;
UPDATE zones SET zone_id='4272', zone_country_id='235', zone_code='SD', zone_name='Sa\'dah'  WHERE (zone_id = 4272) ;
UPDATE zones SET zone_id='4271', zone_country_id='235', zone_code='MW', zone_name='Al Mahwit'  WHERE (zone_id = 4271) ;
UPDATE zones SET zone_id='4270', zone_country_id='235', zone_code='MR', zone_name='Al Mahrah'  WHERE (zone_id = 4270) ;
UPDATE zones SET zone_id='4035', zone_country_id='222', zone_code='Middlesex', zone_name='Middlesex'  WHERE (zone_id = 4035) ;
UPDATE zones SET zone_id='4036', zone_country_id='222', zone_code='Midlothian', zone_name='Midlothian'  WHERE (zone_id = 4036) ;
UPDATE zones SET zone_id='4037', zone_country_id='222', zone_code='Monmouthshire', zone_name='Monmouthshire'  WHERE (zone_id = 4037) ;
UPDATE zones SET zone_id='4038', zone_country_id='222', zone_code='Moray', zone_name='Moray'  WHERE (zone_id = 4038) ;
UPDATE zones SET zone_id='4039', zone_country_id='222', zone_code='Neath Port Talbot', zone_name='Neath Port Talbot'  WHERE (zone_id = 4039) ;
UPDATE zones SET zone_id='4040', zone_country_id='222', zone_code='Newport', zone_name='Newport'  WHERE (zone_id = 4040) ;
UPDATE zones SET zone_id='4041', zone_country_id='222', zone_code='Norfolk', zone_name='Norfolk'  WHERE (zone_id = 4041) ;
UPDATE zones SET zone_id='4042', zone_country_id='222', zone_code='North Ayrshire', zone_name='North Ayrshire'  WHERE (zone_id = 4042) ;
UPDATE zones SET zone_id='4043', zone_country_id='222', zone_code='North Lanarkshire', zone_name='North Lanarkshire'  WHERE (zone_id = 4043) ;
UPDATE zones SET zone_id='4044', zone_country_id='222', zone_code='North Yorkshire', zone_name='North Yorkshire'  WHERE (zone_id = 4044) ;
UPDATE zones SET zone_id='4045', zone_country_id='222', zone_code='Northamptonshire', zone_name='Northamptonshire'  WHERE (zone_id = 4045) ;
UPDATE zones SET zone_id='4046', zone_country_id='222', zone_code='Northumberland', zone_name='Northumberland'  WHERE (zone_id = 4046) ;
UPDATE zones SET zone_id='4047', zone_country_id='222', zone_code='Nottinghamshire', zone_name='Nottinghamshire'  WHERE (zone_id = 4047) ;
UPDATE zones SET zone_id='4048', zone_country_id='222', zone_code='Orkney Islands', zone_name='Orkney Islands'  WHERE (zone_id = 4048) ;
UPDATE zones SET zone_id='4049', zone_country_id='222', zone_code='Oxfordshire', zone_name='Oxfordshire'  WHERE (zone_id = 4049) ;
UPDATE zones SET zone_id='4050', zone_country_id='222', zone_code='Pembrokeshire', zone_name='Pembrokeshire'  WHERE (zone_id = 4050) ;
UPDATE zones SET zone_id='4051', zone_country_id='222', zone_code='Perth and Kinross', zone_name='Perth and Kinross'  WHERE (zone_id = 4051) ;
UPDATE zones SET zone_id='4052', zone_country_id='222', zone_code='Powys', zone_name='Powys'  WHERE (zone_id = 4052) ;
UPDATE zones SET zone_id='4053', zone_country_id='222', zone_code='Renfrewshire', zone_name='Renfrewshire'  WHERE (zone_id = 4053) ;
UPDATE zones SET zone_id='4054', zone_country_id='222', zone_code='Rhondda Cynon Taff', zone_name='Rhondda Cynon Taff'  WHERE (zone_id = 4054) ;
UPDATE zones SET zone_id='4055', zone_country_id='222', zone_code='Rutland', zone_name='Rutland'  WHERE (zone_id = 4055) ;
UPDATE zones SET zone_id='4056', zone_country_id='222', zone_code='Scottish Borders', zone_name='Scottish Borders'  WHERE (zone_id = 4056) ;
UPDATE zones SET zone_id='4057', zone_country_id='222', zone_code='Shetland Islands', zone_name='Shetland Islands'  WHERE (zone_id = 4057) ;
UPDATE zones SET zone_id='4058', zone_country_id='222', zone_code='Shropshire', zone_name='Shropshire'  WHERE (zone_id = 4058) ;
UPDATE zones SET zone_id='4059', zone_country_id='222', zone_code='Somerset', zone_name='Somerset'  WHERE (zone_id = 4059) ;
UPDATE zones SET zone_id='4060', zone_country_id='222', zone_code='South Ayrshire', zone_name='South Ayrshire'  WHERE (zone_id = 4060) ;
UPDATE zones SET zone_id='4061', zone_country_id='222', zone_code='South Lanarkshire', zone_name='South Lanarkshire'  WHERE (zone_id = 4061) ;
UPDATE zones SET zone_id='4062', zone_country_id='222', zone_code='South Yorkshire', zone_name='South Yorkshire'  WHERE (zone_id = 4062) ;
UPDATE zones SET zone_id='4063', zone_country_id='222', zone_code='Staffordshire', zone_name='Staffordshire'  WHERE (zone_id = 4063) ;
UPDATE zones SET zone_id='4064', zone_country_id='222', zone_code='Stirling', zone_name='Stirling'  WHERE (zone_id = 4064) ;
UPDATE zones SET zone_id='4065', zone_country_id='222', zone_code='Suffolk', zone_name='Suffolk'  WHERE (zone_id = 4065) ;
UPDATE zones SET zone_id='4066', zone_country_id='222', zone_code='Surrey', zone_name='Surrey'  WHERE (zone_id = 4066) ;
UPDATE zones SET zone_id='4067', zone_country_id='222', zone_code='Swansea', zone_name='Swansea'  WHERE (zone_id = 4067) ;
UPDATE zones SET zone_id='4068', zone_country_id='222', zone_code='Torfaen', zone_name='Torfaen'  WHERE (zone_id = 4068) ;
UPDATE zones SET zone_id='4069', zone_country_id='222', zone_code='Tyne and Wear', zone_name='Tyne and Wear'  WHERE (zone_id = 4069) ;
UPDATE zones SET zone_id='4070', zone_country_id='222', zone_code='Vale of Glamorgan', zone_name='Vale of Glamorgan'  WHERE (zone_id = 4070) ;
UPDATE zones SET zone_id='4071', zone_country_id='222', zone_code='Warwickshire', zone_name='Warwickshire'  WHERE (zone_id = 4071) ;
UPDATE zones SET zone_id='4072', zone_country_id='222', zone_code='West Dunbartonshire', zone_name='West Dunbartonshire'  WHERE (zone_id = 4072) ;
UPDATE zones SET zone_id='4073', zone_country_id='222', zone_code='West Lothian', zone_name='West Lothian'  WHERE (zone_id = 4073) ;
UPDATE zones SET zone_id='4074', zone_country_id='222', zone_code='West Midlands', zone_name='West Midlands'  WHERE (zone_id = 4074) ;
UPDATE zones SET zone_id='4075', zone_country_id='222', zone_code='West Sussex', zone_name='West Sussex'  WHERE (zone_id = 4075) ;
UPDATE zones SET zone_id='4076', zone_country_id='222', zone_code='West Yorkshire', zone_name='West Yorkshire'  WHERE (zone_id = 4076) ;
UPDATE zones SET zone_id='4077', zone_country_id='222', zone_code='Western Isles', zone_name='Western Isles'  WHERE (zone_id = 4077) ;
UPDATE zones SET zone_id='4078', zone_country_id='222', zone_code='Wiltshire', zone_name='Wiltshire'  WHERE (zone_id = 4078) ;
UPDATE zones SET zone_id='4079', zone_country_id='222', zone_code='Worcestershire', zone_name='Worcestershire'  WHERE (zone_id = 4079) ;
UPDATE zones SET zone_id='4080', zone_country_id='222', zone_code='Wrexham', zone_name='Wrexham'  WHERE (zone_id = 4080) ;
UPDATE zones SET zone_id='4081', zone_country_id='223', zone_code='AL', zone_name='Alabama'  WHERE (zone_id = 4081) ;
UPDATE zones SET zone_id='4082', zone_country_id='223', zone_code='AK', zone_name='Alaska'  WHERE (zone_id = 4082) ;
UPDATE zones SET zone_id='4083', zone_country_id='223', zone_code='AS', zone_name='American Samoa'  WHERE (zone_id = 4083) ;
UPDATE zones SET zone_id='4084', zone_country_id='223', zone_code='AZ', zone_name='Arizona'  WHERE (zone_id = 4084) ;
UPDATE zones SET zone_id='4085', zone_country_id='223', zone_code='AR', zone_name='Arkansas'  WHERE (zone_id = 4085) ;
UPDATE zones SET zone_id='4086', zone_country_id='223', zone_code='AF', zone_name='Armed Forces Africa'  WHERE (zone_id = 4086) ;
UPDATE zones SET zone_id='4087', zone_country_id='223', zone_code='AA', zone_name='Armed Forces Americas'  WHERE (zone_id = 4087) ;
UPDATE zones SET zone_id='4088', zone_country_id='223', zone_code='AC', zone_name='Armed Forces Canada'  WHERE (zone_id = 4088) ;
UPDATE zones SET zone_id='4089', zone_country_id='223', zone_code='AE', zone_name='Armed Forces Europe'  WHERE (zone_id = 4089) ;
UPDATE zones SET zone_id='4090', zone_country_id='223', zone_code='AM', zone_name='Armed Forces Middle East'  WHERE (zone_id = 4090) ;
UPDATE zones SET zone_id='4091', zone_country_id='223', zone_code='AP', zone_name='Armed Forces Pacific'  WHERE (zone_id = 4091) ;
UPDATE zones SET zone_id='4092', zone_country_id='223', zone_code='CA', zone_name='California'  WHERE (zone_id = 4092) ;
UPDATE zones SET zone_id='4093', zone_country_id='223', zone_code='CO', zone_name='Colorado'  WHERE (zone_id = 4093) ;
UPDATE zones SET zone_id='4094', zone_country_id='223', zone_code='CT', zone_name='Connecticut'  WHERE (zone_id = 4094) ;
UPDATE zones SET zone_id='4095', zone_country_id='223', zone_code='DE', zone_name='Delaware'  WHERE (zone_id = 4095) ;
UPDATE zones SET zone_id='4096', zone_country_id='223', zone_code='DC', zone_name='District of Columbia'  WHERE (zone_id = 4096) ;
UPDATE zones SET zone_id='4097', zone_country_id='223', zone_code='FM', zone_name='Federated States Of Micronesia'  WHERE (zone_id = 4097) ;
UPDATE zones SET zone_id='4098', zone_country_id='223', zone_code='FL', zone_name='Florida'  WHERE (zone_id = 4098) ;
UPDATE zones SET zone_id='4099', zone_country_id='223', zone_code='GA', zone_name='Georgia'  WHERE (zone_id = 4099) ;
UPDATE zones SET zone_id='4100', zone_country_id='223', zone_code='GU', zone_name='Guam'  WHERE (zone_id = 4100) ;
UPDATE zones SET zone_id='4101', zone_country_id='223', zone_code='HI', zone_name='Hawaii'  WHERE (zone_id = 4101) ;
UPDATE zones SET zone_id='4102', zone_country_id='223', zone_code='ID', zone_name='Idaho'  WHERE (zone_id = 4102) ;
UPDATE zones SET zone_id='4103', zone_country_id='223', zone_code='IL', zone_name='Illinois'  WHERE (zone_id = 4103) ;
UPDATE zones SET zone_id='4104', zone_country_id='223', zone_code='IN', zone_name='Indiana'  WHERE (zone_id = 4104) ;
UPDATE zones SET zone_id='4105', zone_country_id='223', zone_code='IA', zone_name='Iowa'  WHERE (zone_id = 4105) ;
UPDATE zones SET zone_id='4106', zone_country_id='223', zone_code='KS', zone_name='Kansas'  WHERE (zone_id = 4106) ;
UPDATE zones SET zone_id='4107', zone_country_id='223', zone_code='KY', zone_name='Kentucky'  WHERE (zone_id = 4107) ;
UPDATE zones SET zone_id='4108', zone_country_id='223', zone_code='LA', zone_name='Louisiana'  WHERE (zone_id = 4108) ;
UPDATE zones SET zone_id='4109', zone_country_id='223', zone_code='ME', zone_name='Maine'  WHERE (zone_id = 4109) ;
UPDATE zones SET zone_id='4110', zone_country_id='223', zone_code='MH', zone_name='Marshall Islands'  WHERE (zone_id = 4110) ;
UPDATE zones SET zone_id='4111', zone_country_id='223', zone_code='MD', zone_name='Maryland'  WHERE (zone_id = 4111) ;
UPDATE zones SET zone_id='4112', zone_country_id='223', zone_code='MA', zone_name='Massachusetts'  WHERE (zone_id = 4112) ;
UPDATE zones SET zone_id='4113', zone_country_id='223', zone_code='MI', zone_name='Michigan'  WHERE (zone_id = 4113) ;
UPDATE zones SET zone_id='4114', zone_country_id='223', zone_code='MN', zone_name='Minnesota'  WHERE (zone_id = 4114) ;
UPDATE zones SET zone_id='4115', zone_country_id='223', zone_code='MS', zone_name='Mississippi'  WHERE (zone_id = 4115) ;
UPDATE zones SET zone_id='4116', zone_country_id='223', zone_code='MO', zone_name='Missouri'  WHERE (zone_id = 4116) ;
UPDATE zones SET zone_id='4117', zone_country_id='223', zone_code='MT', zone_name='Montana'  WHERE (zone_id = 4117) ;
UPDATE zones SET zone_id='4118', zone_country_id='223', zone_code='NE', zone_name='Nebraska'  WHERE (zone_id = 4118) ;
UPDATE zones SET zone_id='4119', zone_country_id='223', zone_code='NV', zone_name='Nevada'  WHERE (zone_id = 4119) ;
UPDATE zones SET zone_id='4120', zone_country_id='223', zone_code='NH', zone_name='New Hampshire'  WHERE (zone_id = 4120) ;
UPDATE zones SET zone_id='4121', zone_country_id='223', zone_code='NJ', zone_name='New Jersey'  WHERE (zone_id = 4121) ;
UPDATE zones SET zone_id='4122', zone_country_id='223', zone_code='NM', zone_name='New Mexico'  WHERE (zone_id = 4122) ;
UPDATE zones SET zone_id='4123', zone_country_id='223', zone_code='NY', zone_name='New York'  WHERE (zone_id = 4123) ;
UPDATE zones SET zone_id='4124', zone_country_id='223', zone_code='NC', zone_name='North Carolina'  WHERE (zone_id = 4124) ;
UPDATE zones SET zone_id='4125', zone_country_id='223', zone_code='ND', zone_name='North Dakota'  WHERE (zone_id = 4125) ;
UPDATE zones SET zone_id='4126', zone_country_id='223', zone_code='MP', zone_name='Northern Mariana Islands'  WHERE (zone_id = 4126) ;
UPDATE zones SET zone_id='4127', zone_country_id='223', zone_code='OH', zone_name='Ohio'  WHERE (zone_id = 4127) ;
UPDATE zones SET zone_id='4128', zone_country_id='223', zone_code='OK', zone_name='Oklahoma'  WHERE (zone_id = 4128) ;
UPDATE zones SET zone_id='4129', zone_country_id='223', zone_code='OR', zone_name='Oregon'  WHERE (zone_id = 4129) ;
UPDATE zones SET zone_id='4130', zone_country_id='223', zone_code='PW', zone_name='Palau'  WHERE (zone_id = 4130) ;
UPDATE zones SET zone_id='4131', zone_country_id='223', zone_code='PA', zone_name='Pennsylvania'  WHERE (zone_id = 4131) ;
UPDATE zones SET zone_id='4132', zone_country_id='223', zone_code='PR', zone_name='Puerto Rico'  WHERE (zone_id = 4132) ;
UPDATE zones SET zone_id='4133', zone_country_id='223', zone_code='RI', zone_name='Rhode Island'  WHERE (zone_id = 4133) ;
UPDATE zones SET zone_id='4134', zone_country_id='223', zone_code='SC', zone_name='South Carolina'  WHERE (zone_id = 4134) ;
UPDATE zones SET zone_id='4135', zone_country_id='223', zone_code='SD', zone_name='South Dakota'  WHERE (zone_id = 4135) ;
UPDATE zones SET zone_id='4136', zone_country_id='223', zone_code='TN', zone_name='Tennessee'  WHERE (zone_id = 4136) ;
UPDATE zones SET zone_id='4137', zone_country_id='223', zone_code='TX', zone_name='Texas'  WHERE (zone_id = 4137) ;
UPDATE zones SET zone_id='4138', zone_country_id='223', zone_code='UT', zone_name='Utah'  WHERE (zone_id = 4138) ;
UPDATE zones SET zone_id='4139', zone_country_id='223', zone_code='VT', zone_name='Vermont'  WHERE (zone_id = 4139) ;
UPDATE zones SET zone_id='4140', zone_country_id='223', zone_code='VI', zone_name='Virgin Islands'  WHERE (zone_id = 4140) ;
UPDATE zones SET zone_id='4141', zone_country_id='223', zone_code='VA', zone_name='Virginia'  WHERE (zone_id = 4141) ;
UPDATE zones SET zone_id='4142', zone_country_id='223', zone_code='WA', zone_name='Washington'  WHERE (zone_id = 4142) ;
UPDATE zones SET zone_id='4143', zone_country_id='223', zone_code='WV', zone_name='West Virginia'  WHERE (zone_id = 4143) ;
UPDATE zones SET zone_id='4144', zone_country_id='223', zone_code='WI', zone_name='Wisconsin'  WHERE (zone_id = 4144) ;
UPDATE zones SET zone_id='4145', zone_country_id='223', zone_code='WY', zone_name='Wyoming'  WHERE (zone_id = 4145) ;
UPDATE zones SET zone_id='4146', zone_country_id='224', zone_code='BI', zone_name='Baker Island'  WHERE (zone_id = 4146) ;
UPDATE zones SET zone_id='4147', zone_country_id='224', zone_code='HI', zone_name='Howland Island'  WHERE (zone_id = 4147) ;
UPDATE zones SET zone_id='4148', zone_country_id='224', zone_code='JI', zone_name='Jarvis Island'  WHERE (zone_id = 4148) ;
UPDATE zones SET zone_id='4149', zone_country_id='224', zone_code='JA', zone_name='Johnston Atoll'  WHERE (zone_id = 4149) ;
UPDATE zones SET zone_id='4150', zone_country_id='224', zone_code='KR', zone_name='Kingman Reef'  WHERE (zone_id = 4150) ;
UPDATE zones SET zone_id='4151', zone_country_id='224', zone_code='MA', zone_name='Midway Atoll'  WHERE (zone_id = 4151) ;
UPDATE zones SET zone_id='4308', zone_country_id='239', zone_code='MS', zone_name='Matabeleland South'  WHERE (zone_id = 4308) ;
UPDATE zones SET zone_id='4153', zone_country_id='224', zone_code='PA', zone_name='Palmyra Atoll'  WHERE (zone_id = 4153) ;
UPDATE zones SET zone_id='4154', zone_country_id='224', zone_code='WI', zone_name='Wake Island'  WHERE (zone_id = 4154) ;
UPDATE zones SET zone_id='4155', zone_country_id='225', zone_code='AR', zone_name='Artigas'  WHERE (zone_id = 4155) ;
UPDATE zones SET zone_id='4156', zone_country_id='225', zone_code='CA', zone_name='Canelones'  WHERE (zone_id = 4156) ;
UPDATE zones SET zone_id='4157', zone_country_id='225', zone_code='CL', zone_name='Cerro Largo'  WHERE (zone_id = 4157) ;
UPDATE zones SET zone_id='4158', zone_country_id='225', zone_code='CO', zone_name='Colonia'  WHERE (zone_id = 4158) ;
UPDATE zones SET zone_id='4159', zone_country_id='225', zone_code='DU', zone_name='Durazno'  WHERE (zone_id = 4159) ;
UPDATE zones SET zone_id='4160', zone_country_id='225', zone_code='FS', zone_name='Flores'  WHERE (zone_id = 4160) ;
UPDATE zones SET zone_id='4161', zone_country_id='225', zone_code='FA', zone_name='Florida'  WHERE (zone_id = 4161) ;
UPDATE zones SET zone_id='4162', zone_country_id='225', zone_code='LA', zone_name='Lavalleja'  WHERE (zone_id = 4162) ;
UPDATE zones SET zone_id='4163', zone_country_id='225', zone_code='MA', zone_name='Maldonado'  WHERE (zone_id = 4163) ;
UPDATE zones SET zone_id='4164', zone_country_id='225', zone_code='MO', zone_name='Montevideo'  WHERE (zone_id = 4164) ;
UPDATE zones SET zone_id='4165', zone_country_id='225', zone_code='PA', zone_name='Paysandu'  WHERE (zone_id = 4165) ;
UPDATE zones SET zone_id='4166', zone_country_id='225', zone_code='RN', zone_name='Rio Negro'  WHERE (zone_id = 4166) ;
UPDATE zones SET zone_id='4167', zone_country_id='225', zone_code='RV', zone_name='Rivera'  WHERE (zone_id = 4167) ;
UPDATE zones SET zone_id='4168', zone_country_id='225', zone_code='RO', zone_name='Rocha'  WHERE (zone_id = 4168) ;
UPDATE zones SET zone_id='4169', zone_country_id='225', zone_code='SL', zone_name='Salto'  WHERE (zone_id = 4169) ;
UPDATE zones SET zone_id='4170', zone_country_id='225', zone_code='SJ', zone_name='San Jose'  WHERE (zone_id = 4170) ;
UPDATE zones SET zone_id='4171', zone_country_id='225', zone_code='SO', zone_name='Soriano'  WHERE (zone_id = 4171) ;
UPDATE zones SET zone_id='4172', zone_country_id='225', zone_code='TA', zone_name='Tacuarembo'  WHERE (zone_id = 4172) ;
UPDATE zones SET zone_id='4173', zone_country_id='225', zone_code='TT', zone_name='Treinta y Tres'  WHERE (zone_id = 4173) ;
UPDATE zones SET zone_id='4174', zone_country_id='226', zone_code='AN', zone_name='Andijon'  WHERE (zone_id = 4174) ;
UPDATE zones SET zone_id='4175', zone_country_id='226', zone_code='BU', zone_name='Buxoro'  WHERE (zone_id = 4175) ;
UPDATE zones SET zone_id='4176', zone_country_id='226', zone_code='FA', zone_name='Farg\'ona'  WHERE (zone_id = 4176) ;
UPDATE zones SET zone_id='4177', zone_country_id='226', zone_code='JI', zone_name='Jizzax'  WHERE (zone_id = 4177) ;
UPDATE zones SET zone_id='4178', zone_country_id='226', zone_code='NG', zone_name='Namangan'  WHERE (zone_id = 4178) ;
UPDATE zones SET zone_id='4179', zone_country_id='226', zone_code='NW', zone_name='Navoiy'  WHERE (zone_id = 4179) ;
UPDATE zones SET zone_id='4180', zone_country_id='226', zone_code='QA', zone_name='Qashqadaryo'  WHERE (zone_id = 4180) ;
UPDATE zones SET zone_id='4181', zone_country_id='226', zone_code='QR', zone_name='Qoraqalpog\'iston Republikasi'  WHERE (zone_id = 4181) ;
UPDATE zones SET zone_id='4182', zone_country_id='226', zone_code='SA', zone_name='Samarqand'  WHERE (zone_id = 4182) ;
UPDATE zones SET zone_id='4183', zone_country_id='226', zone_code='SI', zone_name='Sirdaryo'  WHERE (zone_id = 4183) ;
UPDATE zones SET zone_id='4184', zone_country_id='226', zone_code='SU', zone_name='Surxondaryo'  WHERE (zone_id = 4184) ;
UPDATE zones SET zone_id='4185', zone_country_id='226', zone_code='TK', zone_name='Toshkent City'  WHERE (zone_id = 4185) ;
UPDATE zones SET zone_id='4186', zone_country_id='226', zone_code='TO', zone_name='Toshkent Region'  WHERE (zone_id = 4186) ;
UPDATE zones SET zone_id='4187', zone_country_id='226', zone_code='XO', zone_name='Xorazm'  WHERE (zone_id = 4187) ;
UPDATE zones SET zone_id='4188', zone_country_id='227', zone_code='MA', zone_name='Malampa'  WHERE (zone_id = 4188) ;
UPDATE zones SET zone_id='4189', zone_country_id='227', zone_code='PE', zone_name='Penama'  WHERE (zone_id = 4189) ;
UPDATE zones SET zone_id='4190', zone_country_id='227', zone_code='SA', zone_name='Sanma'  WHERE (zone_id = 4190) ;
UPDATE zones SET zone_id='4191', zone_country_id='227', zone_code='SH', zone_name='Shefa'  WHERE (zone_id = 4191) ;
UPDATE zones SET zone_id='4192', zone_country_id='227', zone_code='TA', zone_name='Tafea'  WHERE (zone_id = 4192) ;
UPDATE zones SET zone_id='4193', zone_country_id='227', zone_code='TO', zone_name='Torba'  WHERE (zone_id = 4193) ;
UPDATE zones SET zone_id='4194', zone_country_id='229', zone_code='AM', zone_name='Amazonas'  WHERE (zone_id = 4194) ;
UPDATE zones SET zone_id='4195', zone_country_id='229', zone_code='AN', zone_name='Anzoategui'  WHERE (zone_id = 4195) ;
UPDATE zones SET zone_id='4196', zone_country_id='229', zone_code='AP', zone_name='Apure'  WHERE (zone_id = 4196) ;
UPDATE zones SET zone_id='4197', zone_country_id='229', zone_code='AR', zone_name='Aragua'  WHERE (zone_id = 4197) ;
UPDATE zones SET zone_id='4198', zone_country_id='229', zone_code='BA', zone_name='Barinas'  WHERE (zone_id = 4198) ;
UPDATE zones SET zone_id='4199', zone_country_id='229', zone_code='BO', zone_name='Bolivar'  WHERE (zone_id = 4199) ;
UPDATE zones SET zone_id='4200', zone_country_id='229', zone_code='CA', zone_name='Carabobo'  WHERE (zone_id = 4200) ;
UPDATE zones SET zone_id='4201', zone_country_id='229', zone_code='CO', zone_name='Cojedes'  WHERE (zone_id = 4201) ;
UPDATE zones SET zone_id='4202', zone_country_id='229', zone_code='DA', zone_name='Delta Amacuro'  WHERE (zone_id = 4202) ;
UPDATE zones SET zone_id='4203', zone_country_id='229', zone_code='DF', zone_name='Dependencias Federales'  WHERE (zone_id = 4203) ;
UPDATE zones SET zone_id='4204', zone_country_id='229', zone_code='DI', zone_name='Distrito Federal'  WHERE (zone_id = 4204) ;
UPDATE zones SET zone_id='4205', zone_country_id='229', zone_code='FA', zone_name='Falcon'  WHERE (zone_id = 4205) ;
UPDATE zones SET zone_id='4206', zone_country_id='229', zone_code='GU', zone_name='Guarico'  WHERE (zone_id = 4206) ;
UPDATE zones SET zone_id='4207', zone_country_id='229', zone_code='LA', zone_name='Lara'  WHERE (zone_id = 4207) ;
UPDATE zones SET zone_id='4208', zone_country_id='229', zone_code='ME', zone_name='Merida'  WHERE (zone_id = 4208) ;
UPDATE zones SET zone_id='4209', zone_country_id='229', zone_code='MI', zone_name='Miranda'  WHERE (zone_id = 4209) ;
UPDATE zones SET zone_id='4210', zone_country_id='229', zone_code='MO', zone_name='Monagas'  WHERE (zone_id = 4210) ;
UPDATE zones SET zone_id='4211', zone_country_id='229', zone_code='NE', zone_name='Nueva Esparta'  WHERE (zone_id = 4211) ;
UPDATE zones SET zone_id='4212', zone_country_id='229', zone_code='PO', zone_name='Portuguesa'  WHERE (zone_id = 4212) ;
UPDATE zones SET zone_id='4213', zone_country_id='229', zone_code='SU', zone_name='Sucre'  WHERE (zone_id = 4213) ;
UPDATE zones SET zone_id='4214', zone_country_id='229', zone_code='TA', zone_name='Tachira'  WHERE (zone_id = 4214) ;
UPDATE zones SET zone_id='4215', zone_country_id='229', zone_code='TR', zone_name='Trujillo'  WHERE (zone_id = 4215) ;
UPDATE zones SET zone_id='4216', zone_country_id='229', zone_code='VA', zone_name='Vargas'  WHERE (zone_id = 4216) ;
UPDATE zones SET zone_id='4217', zone_country_id='229', zone_code='YA', zone_name='Yaracuy'  WHERE (zone_id = 4217) ;
UPDATE zones SET zone_id='4218', zone_country_id='229', zone_code='ZU', zone_name='Zulia'  WHERE (zone_id = 4218) ;
UPDATE zones SET zone_id='4219', zone_country_id='230', zone_code='AG', zone_name='An Giang'  WHERE (zone_id = 4219) ;
UPDATE zones SET zone_id='4220', zone_country_id='230', zone_code='BG', zone_name='Bac Giang'  WHERE (zone_id = 4220) ;
UPDATE zones SET zone_id='4221', zone_country_id='230', zone_code='BK', zone_name='Bac Kan'  WHERE (zone_id = 4221) ;
UPDATE zones SET zone_id='4222', zone_country_id='230', zone_code='BL', zone_name='Bac Lieu'  WHERE (zone_id = 4222) ;
UPDATE zones SET zone_id='4223', zone_country_id='230', zone_code='BC', zone_name='Bac Ninh'  WHERE (zone_id = 4223) ;
UPDATE zones SET zone_id='4224', zone_country_id='230', zone_code='BR', zone_name='Ba Ria-Vung Tau'  WHERE (zone_id = 4224) ;
UPDATE zones SET zone_id='4225', zone_country_id='230', zone_code='BN', zone_name='Ben Tre'  WHERE (zone_id = 4225) ;
UPDATE zones SET zone_id='4226', zone_country_id='230', zone_code='BH', zone_name='Binh Dinh'  WHERE (zone_id = 4226) ;
UPDATE zones SET zone_id='4227', zone_country_id='230', zone_code='BU', zone_name='Binh Duong'  WHERE (zone_id = 4227) ;
UPDATE zones SET zone_id='4228', zone_country_id='230', zone_code='BP', zone_name='Binh Phuoc'  WHERE (zone_id = 4228) ;
UPDATE zones SET zone_id='4229', zone_country_id='230', zone_code='BT', zone_name='Binh Thuan'  WHERE (zone_id = 4229) ;
UPDATE zones SET zone_id='4230', zone_country_id='230', zone_code='CM', zone_name='Ca Mau'  WHERE (zone_id = 4230) ;
UPDATE zones SET zone_id='4231', zone_country_id='230', zone_code='CT', zone_name='Can Tho'  WHERE (zone_id = 4231) ;
UPDATE zones SET zone_id='4232', zone_country_id='230', zone_code='CB', zone_name='Cao Bang'  WHERE (zone_id = 4232) ;
UPDATE zones SET zone_id='4233', zone_country_id='230', zone_code='DL', zone_name='Dak Lak'  WHERE (zone_id = 4233) ;
UPDATE zones SET zone_id='4234', zone_country_id='230', zone_code='DG', zone_name='Dak Nong'  WHERE (zone_id = 4234) ;
UPDATE zones SET zone_id='4235', zone_country_id='230', zone_code='DN', zone_name='Da Nang'  WHERE (zone_id = 4235) ;
UPDATE zones SET zone_id='4236', zone_country_id='230', zone_code='DB', zone_name='Dien Bien'  WHERE (zone_id = 4236) ;
UPDATE zones SET zone_id='4237', zone_country_id='230', zone_code='DI', zone_name='Dong Nai'  WHERE (zone_id = 4237) ;
UPDATE zones SET zone_id='4238', zone_country_id='230', zone_code='DT', zone_name='Dong Thap'  WHERE (zone_id = 4238) ;
UPDATE zones SET zone_id='4239', zone_country_id='230', zone_code='GL', zone_name='Gia Lai'  WHERE (zone_id = 4239) ;
UPDATE zones SET zone_id='4240', zone_country_id='230', zone_code='HG', zone_name='Ha Giang'  WHERE (zone_id = 4240) ;
UPDATE zones SET zone_id='4241', zone_country_id='230', zone_code='HD', zone_name='Hai Duong'  WHERE (zone_id = 4241) ;
UPDATE zones SET zone_id='4242', zone_country_id='230', zone_code='HP', zone_name='Hai Phong'  WHERE (zone_id = 4242) ;
UPDATE zones SET zone_id='4243', zone_country_id='230', zone_code='HM', zone_name='Ha Nam'  WHERE (zone_id = 4243) ;
UPDATE zones SET zone_id='4244', zone_country_id='230', zone_code='HI', zone_name='Ha Noi'  WHERE (zone_id = 4244) ;
UPDATE zones SET zone_id='4245', zone_country_id='230', zone_code='HT', zone_name='Ha Tay'  WHERE (zone_id = 4245) ;
UPDATE zones SET zone_id='4246', zone_country_id='230', zone_code='HH', zone_name='Ha Tinh'  WHERE (zone_id = 4246) ;
UPDATE zones SET zone_id='4247', zone_country_id='230', zone_code='HB', zone_name='Hoa Binh'  WHERE (zone_id = 4247) ;
UPDATE zones SET zone_id='4248', zone_country_id='230', zone_code='HC', zone_name='Ho Chin Minh'  WHERE (zone_id = 4248) ;
UPDATE zones SET zone_id='4249', zone_country_id='230', zone_code='HU', zone_name='Hau Giang'  WHERE (zone_id = 4249) ;
UPDATE zones SET zone_id='4250', zone_country_id='230', zone_code='HY', zone_name='Hung Yen'  WHERE (zone_id = 4250) ;
UPDATE zones SET zone_id='4251', zone_country_id='232', zone_code='C', zone_name='Saint Croix'  WHERE (zone_id = 4251) ;
UPDATE zones SET zone_id='4252', zone_country_id='232', zone_code='J', zone_name='Saint John'  WHERE (zone_id = 4252) ;
UPDATE zones SET zone_id='4253', zone_country_id='232', zone_code='T', zone_name='Saint Thomas'  WHERE (zone_id = 4253) ;
UPDATE zones SET zone_id='4254', zone_country_id='233', zone_code='A', zone_name='Alo'  WHERE (zone_id = 4254) ;
UPDATE zones SET zone_id='4255', zone_country_id='233', zone_code='S', zone_name='Sigave'  WHERE (zone_id = 4255) ;
UPDATE zones SET zone_id='4256', zone_country_id='233', zone_code='W', zone_name='Wallis'  WHERE (zone_id = 4256) ;
UPDATE zones SET zone_id='4257', zone_country_id='235', zone_code='AB', zone_name='Abyan'  WHERE (zone_id = 4257) ;
UPDATE zones SET zone_id='4258', zone_country_id='235', zone_code='AD', zone_name='Adan'  WHERE (zone_id = 4258) ;
UPDATE zones SET zone_id='4259', zone_country_id='235', zone_code='AM', zone_name='Amran'  WHERE (zone_id = 4259) ;
UPDATE zones SET zone_id='4260', zone_country_id='235', zone_code='BA', zone_name='Al Bayda'  WHERE (zone_id = 4260) ;
UPDATE zones SET zone_id='4261', zone_country_id='235', zone_code='DA', zone_name='Ad Dali'  WHERE (zone_id = 4261) ;
UPDATE zones SET zone_id='4262', zone_country_id='235', zone_code='DH', zone_name='Dhamar'  WHERE (zone_id = 4262) ;
UPDATE zones SET zone_id='4263', zone_country_id='235', zone_code='HD', zone_name='Hadramawt'  WHERE (zone_id = 4263) ;
UPDATE zones SET zone_id='4264', zone_country_id='235', zone_code='HJ', zone_name='Hajjah'  WHERE (zone_id = 4264) ;
UPDATE zones SET zone_id='4265', zone_country_id='235', zone_code='HU', zone_name='Al Hudaydah'  WHERE (zone_id = 4265) ;
UPDATE zones SET zone_id='4266', zone_country_id='235', zone_code='IB', zone_name='Ibb'  WHERE (zone_id = 4266) ;
UPDATE zones SET zone_id='4267', zone_country_id='235', zone_code='JA', zone_name='Al Jawf'  WHERE (zone_id = 4267) ;
UPDATE zones SET zone_id='4268', zone_country_id='235', zone_code='LA', zone_name='Lahij'  WHERE (zone_id = 4268) ;
UPDATE zones SET zone_id='4269', zone_country_id='235', zone_code='MA', zone_name='Ma\'rib'  WHERE (zone_id = 4269) ;
INSERT INTO zones VALUES ('4309', '239', 'MD', 'Midlands');
