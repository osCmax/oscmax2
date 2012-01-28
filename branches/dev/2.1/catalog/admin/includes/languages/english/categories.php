<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Categories / Products');
define('HEADING_TITLE_SEARCH', 'Search:');
define('HEADING_TITLE_GOTO', 'Go To:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Categories / Products');
define('TABLE_HEADING_MODEL_NUMBER', 'Model');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_STATUS', 'Status');

define('TEXT_NEW_PRODUCT', 'Add/Edit Product in &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Categories:');
define('TEXT_SUBCATEGORIES', 'Subcategories:');
define('TEXT_PRODUCTS', 'Products:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Price:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Tax Class:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Average Rating:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Quantity:');
define('TEXT_DATE_ADDED', 'Date Added:');
define('TEXT_DATE_AVAILABLE', 'Date Available:');
define('TEXT_LAST_MODIFIED', 'Last Modified:');
define('TEXT_IMAGE_NONEXISTENT', 'IMAGE DOES NOT EXIST');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Please insert a new category or product in this level.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'For more information, please visit this products <a href="http://%s" target="blank"><u>webpage</u></a>.');
define('TEXT_PRODUCT_DATE_ADDED', 'This product was added to our catalog on %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'This product will be in stock on %s.');

define('TEXT_EDIT_INTRO', 'Please make any necessary changes');
define('TEXT_EDIT_CATEGORIES_ID', 'Category ID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Category Name:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Category Image:');
define('TEXT_EDIT_SORT_ORDER', 'Sort Order:');

define('TEXT_INFO_COPY_TO_INTRO', 'Please choose a new category you wish to copy this product to');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Current Categories:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'New Category');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Edit Category');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Delete Category');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Move Category');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Delete Product');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Move Product');
define('TEXT_INFO_HEADING_COPY_TO', 'Copy To');

define('TEXT_DELETE_CATEGORY_INTRO', 'Are you sure you want to delete this category?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Are you sure you want to permanently delete this product?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>WARNING:</b> There are %s (child-)categories still linked to this category!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>WARNING:</b> There are %s products still linked to this category!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Please select which category you wish <b>%s</b> to reside in');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Please select which category you wish <b>%s</b> to reside in');
define('TEXT_MOVE', 'Move <b>%s</b> to:');

define('TEXT_NEW_CATEGORY_INTRO', 'Please fill out the following information for the new category');
define('TEXT_CATEGORIES_NAME', 'Category Name:');
define('TEXT_CATEGORIES_IMAGE', 'Category Image:');
define('TEXT_SORT_ORDER', 'Sort Order:');

define('TEXT_PRODUCTS_STATUS', 'Status:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Date Available:');
define('TEXT_PRODUCT_AVAILABLE', 'Active');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Inactive');
define('TEXT_PRODUCTS_MANUFACTURER', 'Manufacturer:');
define('TEXT_PRODUCTS_NAME', 'Product Name:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Description:');
define('TEXT_PRODUCTS_QUANTITY', 'Quantity:');
define('TEXT_PRODUCTS_MODEL', 'Ref/Model:');
define('TEXT_PRODUCTS_IMAGE', 'Product Image:');
define('TEXT_PRODUCTS_URL', 'URL:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(without http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Price (Net):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Price (Gross):');
define('TEXT_PRODUCTS_MSRP_GROSS', 'MSRP (Gross):');
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

define('EMPTY_CATEGORY', 'Empty Category');

define('TEXT_HOW_TO_COPY', 'Copy Method:');
define('TEXT_COPY_AS_LINK', 'Link product');
define('TEXT_COPY_AS_DUPLICATE', 'Duplicate product');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Error: Can not link products in the same category.');
define('ERROR_CATALOG_BIGIMAGES_DIRECTORY_NOT_WRITEABLE', 'Error: Catalog images directory is not writeable: ' . DIR_FS_CATALOG_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR);
define('ERROR_CATALOG_THUMBS_DIRECTORY_NOT_WRITEABLE', 'Error: Catalog images directory is not writeable: ' . DIR_FS_CATALOG_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR);
define('ERROR_CATALOG_BIGIMAGES_DIRECTORY_DOES_NOT_EXIST', 'Error: Catalog images directory does not exist: ' . DIR_FS_CATALOG_IMAGES . DYNAMIC_MOPICS_BIGIMAGES_DIR);
define('ERROR_CATALOG_THUMBS_DIRECTORY_DOES_NOT_EXIST', 'Error: Catalog images directory does not exist: ' . DIR_FS_CATALOG_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Error: Category cannot be moved into child category.');

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