<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax
  
  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Cat&eacute;gories / Produits');
define('HEADING_TITLE_SEARCH', 'Rechercher:');
define('HEADING_TITLE_GOTO', 'Aller &aacute;:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Cat&eacute;gories / Produits');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_STATUS', 'Statut');

define('TEXT_NEW_PRODUCT', 'Nouveau Produit dans &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Cat&eacute;gories:');
define('TEXT_SUBCATEGORIES', 'Sous-cat&eacute;gories:');
define('TEXT_PRODUCTS', 'Produits:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Prix:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Classe Fiscale:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Ratio moyen:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Quantit&eacute;:');
define('TEXT_DATE_ADDED', 'Date d\'ajout:');
define('TEXT_DATE_AVAILABLE', 'Date disponibilit&eacute;:');
define('TEXT_LAST_MODIFIED', 'Derni&egrave;re modification:');
define('TEXT_IMAGE_NONEXISTENT', 'L\'IMAGE N\'EXISTE PAS');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Merci de cr&eacute;er une nouvelle catégorie ou un produit dans ce niveau.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Pour plus d\'information, merci de visiter cette <a href="http://%s" target="blank"><u>page web</u></a> de produits.');
define('TEXT_PRODUCT_DATE_ADDED', 'Ce produit a &eacute;t&eacute; ajout&eacute; &agrave; notre catalogue le %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Ce produit sera en stock le %s.');

define('TEXT_EDIT_INTRO', 'Merci de effectuer tous les changements necessaires');
define('TEXT_EDIT_CATEGORIES_ID', 'ID de la cat&eacute;gorie:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Nom de la cat&eacute;gorie:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Image de la cat&eacute;gorie:');
define('TEXT_EDIT_SORT_ORDER', 'Ordre de tri:');

define('TEXT_INFO_COPY_TO_INTRO', 'Veuillez choisir une nouvelle cat&eacute;gorie dans laquelle vous voulez copier ce produit');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Cat&eacute;gories courantes:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nouvelle cat&eacute;gorie');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Editer cat&eacute;gorie');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Supprimer cat&eacute;gorie');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'D&eacute;placer cat&eacute;gorie');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Supprimer produit');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'D&eacute;placer produit');
define('TEXT_INFO_HEADING_COPY_TO', 'Copier vers');

define('TEXT_DELETE_CATEGORY_INTRO', 'Etes vous sur de vouloir supprimer cette cat&eacute;gorie?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Etes vous sur de vouloir supprimer d&eacute;finitivement ce produit?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>ATTENTION:</b> Il y a %s (sous-)cat&eacute;gories li&eacute;es &aacute; cette cat&eacute;gorie!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>ATTENTION:</b> Il y a %s produits li&eacute;es &aacute; cette cat&eacute;gorie!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Merci de s&eacute;lectionner la cat&eacute;gorie ou vous voudriez que <b>%s</b> soit plac&eacute;');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Merci de s&eacute;lectionner la cat&eacute;gorie ou vous voudriez que <b>%s</b> soit plac&eacute;');
define('TEXT_MOVE', 'D&eacute;placer <b>%s</b> vers:');

define('TEXT_NEW_CATEGORY_INTRO', 'Merci de compl&eacute;ter les informations suivantes pour la nouvelle cat&eacute;gorie');
define('TEXT_CATEGORIES_NAME', 'Nom de la cat&eacute;gorie:');
define('TEXT_CATEGORIES_IMAGE', 'Image de la cat&eacute;gorie:');
define('TEXT_SORT_ORDER', 'Ordre de tri:');

define('TEXT_PRODUCTS_STATUS', 'Statut des produits:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Date de disponibilit&eacute;:');
define('TEXT_PRODUCT_AVAILABLE', 'En stock');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Hors stock');
define('TEXT_PRODUCTS_MANUFACTURER', 'Fabriquant du produit:');
define('TEXT_PRODUCTS_NAME', 'Nom du produit:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Description du produit:');
define('TEXT_PRODUCTS_QUANTITY', 'Quantit&eacute; de produit:');
define('TEXT_PRODUCTS_MODEL', 'Mod&egrave;le du produit:');
define('TEXT_PRODUCTS_IMAGE', 'Image du produit:');
define('TEXT_PRODUCTS_URL', 'URL du produit:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(sans http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Prix du produit (Ht):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Prix du produit (TTC):');
define('TEXT_PRODUCTS_WEIGHT', 'Poids du produit:');
define('TEXT_PRODUCTS_WEIGHT', 'Weight:');
define('TEXT_PRODUCTS_HEIGHT', 'Height:');
define('TEXT_PRODUCTS_LENGTH', 'Length:');
define('TEXT_PRODUCTS_WIDTH', 'Width:');
define('TEXT_PRODUCTS_READY_TO_SHIP', 'Ready to ship:<br/>(Fedex)');
define('TEXT_PRODUCTS_READY_TO_SHIP_SELECTION', 'Product can be shipped in its own container.');

// BOF Separate Pricing Per Customer
define('TEXT_CUSTOMERS_GROUPS_NOTE', 'Note that if a field is left empty, no price for that customer group will be inserted in the database.<br />
If a field is filled, but the checkbox is unchecked no price will be inserted either.<br />
If a price is already inserted in the database, but the checkbox unchecked it will be removed from the database.');
// EOF Separate Pricing Per Customer

define('EMPTY_CATEGORY', 'Cat&eacute;gorie vide');

define('TEXT_HOW_TO_COPY', 'M&eacute;thode de copie:');
define('TEXT_COPY_AS_LINK', 'Lien produit');
define('TEXT_COPY_AS_DUPLICATE', 'Dupliquer produit');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Erreur: Impossible de lier des produits dans la m&ecirc;me cat&eacutegorie.');
define('ERROR_CATALOG_BIGIMAGES_DIRECTORY_NOT_WRITEABLE', 'Error: Catalog images directory is not writeable: ' . DIR_FS_CATALOG_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR);
define('ERROR_CATALOG_THUMBS_DIRECTORY_NOT_WRITEABLE', 'Error: Catalog images directory is not writeable: ' . DIR_FS_CATALOG_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR);
define('ERROR_CATALOG_BIGIMAGES_DIRECTORY_DOES_NOT_EXIST', 'Error: Catalog images directory does not exist: ' . DIR_FS_CATALOG_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR);
define('ERROR_CATALOG_THUMBS_DIRECTORY_DOES_NOT_EXIST', 'Error: Catalog images directory does not exist: ' . DIR_FS_CATALOG_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Erreur: La cat&eacute;gorie ne peut pas &ecirc;tre d&eacute;plac&eacute;e dans la sous-cat&eacute;gorie.');
//Select Product Image Directory & Instant Update For Products
define('TEXT_IMAGE_TITLE', 'Image Upload &amp Control');
define('TEXT_PRODUCTS_DIRECTORY_DONT_EXIST_1', 'Error: - The provided \'images\' directory ');
define('TEXT_PRODUCTS_DIRECTORY_DONT_EXIST_2', ' does not exist on the server!!.');
define('TEXT_PRODUCTS_IMAGE_DIRECTORY', 'Image Directory:');
define('TEXT_PRODUCTS_IMAGE_ROOT_DIRECTORY', 'Images Directory');
define('TEXT_PRODUCTS_IMAGE_NEW_FOLDER', 'New Subdirectory: ');
define('TEXT_PRODUCTS_UPDATE_PRODUCT', 'Update');
define('TEXT_PRODUCTS_INSERT_PRODUCT', 'Insert');
define('TEXT_PRODUCTS_WITHOUT_PREVIEW', ' without preview ');
define('TEXT_PRODUCTS_MOPICS', 'Extra Image:');
define('TEXT_MOPICS_WARNING', 'Select Image Directory above PRIOR to uploading');

//Multi image upload 
define('TEXT_MOPICS_CONTENT', 'Dynamic Mopics requires that all of the image types are the same. Ie. Use all jpg or png.  You can <b>not</b> mix the image types.');
define('TEXT_UPLOAD_IMAGES', '<b>Upload Image</b>');
define('TEXT_CURRENT_IMAGES', '<b>Current Image</b>');
define('TEXT_DELETE_IMAGES', '<b>Delete?</b>');
define('TEXT_EXTRA_IMAGE', 'Extra Image');
define('TEXT_MOPICS_ERROR', 'Image sequence error');
define('TEXT_MOPICS_ERROR_HELP', 'Dynamic Mopics must be in sequence - you can not have gaps in the run.  If you have a gap (eg. _1 -> _3) then the system will stop displaying your images at the first gap.');

define('TEXT_SHIPPING_DIMENSIONS', 'Shipping Dimensions');

define('TEXT_SPPC_HELP', '<hr />Group Pricing:<br />If a field is left empty, no price for that customer group will be inserted in the database.<br />
If a field is filled, but the checkbox is unchecked no price will be inserted either.<br />
If a price is already inserted in the database, but the checkbox unchecked it will be removed from the database.');
define('TEXT_SPPC_WARNING', '<br /><strong>Make sure you uncheck the appropriate boxes again!</strong><br />');

define('TEXT_CLICK_TO_ENLARGE', 'Click to enlarge');

define('TAB1', 'Tab 1');
define('TAB2', 'Tab 2');
define('TAB3', 'Tab 3');
define('TAB4', 'Tab 4');
define('TAB5', 'Tab 5');
define('TAB6', 'Tab 6');

// BOF Hide product from groups
define('TEXT_HIDE_PRODUCTS_FROM_GROUP', 'Select Groups To Hide This Product From:');
define('TEXT_HIDDEN_FROM_GROUPS', 'Hidden from groups: ');
define('TEXT_GROUPS_NONE', 'none');
define('TEXT_HIDE_CATEGORIES_FROM_GROUPS', 'Hide categories from groups:');
define('TABLE_HEADING_HIDE_CATEGORIES', 'Hidden');
// 0: Icons for all groups for which the category or product is hidden, mouse-over the icons to see what group
// 1: Only one icon and only if the category or product is hidden for a group, mouse-over the icon to what groups
define('LAYOUT_HIDE_FROM', '0'); 
// EOF Hide product from groups

// BOF QPBPP for SPPC
define('TEXT_PRODUCTS_QTY_BLOCKS', 'Quantity Blocks:');
define('TEXT_PRODUCTS_QTY_BLOCKS_HELP', '(can only order in blocks of X quantity, defaults to 1)');
define('TEXT_PRODUCTS_PRICE', 'Quantity level');
define('TEXT_PRODUCTS_QTY', 'units at Price');
define('TEXT_PRODUCTS_DELETE', 'Delete');
define('TEXT_ENTER_QUANTITY', 'Quantity');
define('TEXT_PRICE_PER_PIECE', 'Price&nbsp;for&nbsp;each');
define('TEXT_SAVINGS', 'Your savings');
define('TEXT_DISCOUNT_CATEGORY', 'Discount category:');
define('ERROR_UPDATE_INSERT_DISCOUNT_CATEGORY', 'Something went wrong when updating or inserting into the table discount_categories');
define('ERROR_ALL_CUSTOMER_GROUPS_DELETED', 'All customer groups have been deleted, please re-enter at least retail in table customers_groups (see sppc_v421_install.sql)');
define('TEXT_PRODUCTS_MIN_ORDER_QTY', 'Minimum order quantity:');
define('TEXT_PRODUCTS_MIN_ORDER_QTY_HELP', '(defaults to 1,  no need to set a value)');
define('TEXT_PRICE_BREAK_INFO', '<acronym title="as Price(Qty)">Price breaks</acronym>: ');
define('PB_DROPDOWN_BEFORE', '');
define('PB_DROPDOWN_BETWEEN', ' at ');
define('PB_DROPDOWN_AFTER', ' each');
define('PB_FROM', 'from');
// EOF QPBPP for SPPC

// BOF Open Featured Sets
define('TEXT_PRODUCTS_SHORT', 'Products Short Description:');
define('TABLE_HEADING_FEATURED', 'Featured Sets');
define('TABLE_HEADING_FEATURED_PREVIEW', 'Featured Preview');
define('TEXT_CATEGORIES_FEATURED', 'Featured Category');
define('TEXT_CATEGORIES_YES', 'Yes');
define('TEXT_CATEGORIES_NO', 'No');
define('TEXT_CATEGORIES_FEATURED_DATE', 'Featured Until Date ');
define('TEXT_PRODUCTS_FEATURED', 'Featured Products:');
define('TEXT_PRODUCT_NO', 'No');
define('TEXT_PRODUCT_YES', 'Yes');
define('TEXT_MORE_INFO', 'more...');
// EOF Open Featured Sets

define('HEADING_PRICE_HELP','Price Help');
define('TEXT_PRICE_HELP', 'If you want to display <b>Contact for Price</b> set the price to -1');
define('HEADING_MSRP_HELP', 'Manufacturer Suggested Retail Price');
define('TEXT_MSRP_HELP', 'If you wish to display a MSRP price on your product information page then please enter it here.');
define('TEXT_ADD_PL', 'Add another Price Break');
define('TEXT_FEATURED_UNTIL', 'Featured Until: ');
define('TEXT_SHIPPING_PRICE', 'Indv. Shipping Price: ');

define('TEXT_THUMBNAIL_IMAGE', 'Thumbnail Image:');
?>
