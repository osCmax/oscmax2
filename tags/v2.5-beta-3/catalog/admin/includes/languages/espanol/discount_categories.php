<?php
/*
$Id: discount_categories.php 1011 2011-01-06 23:38:01Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
  
define('HEADING_TITLE', 'Discount categories');
define('HEADING_TITLE_PRODUCTS_TO_DISCOUNT_CATEGORIES', 'Products to Discount categories');
define('HEADING_TITLE_SEARCH', 'Search:');
define('HEADING_TITLE_NEW_DISCOUNT_CATEGORIES_NAME', '<b>New Discount&#160;Category&#160;</b>');

define('TABLE_HEADING_NAME', 'Name');
define('TABLE_HEADING_ID', 'dcID');
define('TABLE_HEADING_PRODUCTS_ID', 'pID');
define('TABLE_HEADING_MODEL', 'Model');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_DISCOUNT_CATEGORY', 'Discount Category');
define('TABLE_HEADING_DISCOUNT_CATEGORIES_NAME', '/ <b>Name</b>');
define('TABLE_HEADING_NEW_DISCOUNT_CATEGORIES_NAME', ' <b>Name</b>');
define('TABLE_HEADING_DISCOUNT_CATEGORIES_ID', '<b>ID</b>');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_CUSTOMERS_GROUPS', 'Customer&#160;Group');

define('ENTRY_DISCOUNT_CATEGORIES_NAME', '<b>Discount&#160;Category&#160;Name</b>');
define('ENTRY_NEW_DISCOUNT_CATEGORIES_NAME', '<b>New Discount&#160;Category&#160;</b>');
define('ENTRY_DISCOUNT_CATEGORIES_NAME_MAX_LENGTH', ' (max. length: 255 characters)');

define('ERROR_DISCOUNT_CATEGORIES_NAME', 'Please enter a name for the Discount Category');
define('ERROR_DISCOUNT_CATEGORIES_ID', 'No discount category id has been found for this action');
define('ERROR_UPDATE_INSERT_DISCOUNT_CATEGORY', 'Something went wrong when updating or inserting into the table discount_categories');

define('TEXT_DELETE_INTRO', 'Are you sure you want to delete this discount category?');
define('TEXT_DISPLAY_NUMBER_OF_DISCOUNT_CATEGORIES', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> Discount Categories)');
define('TEXT_INFO_HEADING_DELETE_DISCOUNT_CATEGORY', 'Delete Discount Category');
define('TEXT_NO_PRODUCTS','No products found');
define('TEXT_MOUSE_OVER_DISCOUNT_GROUPS_PER_GROUP_POPUP', 'Click to edit discount categories for each customer group for this product in a pop-up window');
define('TEXT_IMAGE_SWITCH_EDIT','Go to categories.php for complete edit');
define('TEXT_IMAGE_EDIT_GROUP_DISCOUNT_CATEGORIES', 'Edit discount categories for each customer group for this product in a pop-up window');
define('NAME_WINDOW_DISCOUNT_GROUPS_PER_GROUP_POPUP', 'DiscountGroupsPerCustomerGroup');
define('SORT_BY_PRODUCTS_ID_ASC', 'Sort by products_id ascending  --> 1-2-3 From Top ');
define('SORT_BY_PRODUCTS_ID_DESC', 'Sort by products_id descending  --> 3-2-1 From Top ');
define('SORT_BY_PRODUCTS_MODEL_ASC', 'Sort by products_model ascending  --> a-b-c From Top ');
define('SORT_BY_PRODUCTS_MODEL_DESC', 'Sort by products_model descending  --> z-y-x From Top ');
define('SORT_BY_PRODUCTS_NAME_ASC', 'Sort by products_name ascending  --> a-b-c From Top ');
define('SORT_BY_PRODUCTS_NAME_DESC', 'Sort by products_name descending  --> z-y-x From Top ');


define('TEXT_MAXI_ROW_BY_PAGE', 'Max. # of rows per page');
define('TEXT_ALL_MANUFACTURERS', 'All Manufacturers');
define('TEXT_ALL_DISCOUNT_CATEGORIES', 'All Discount Categories');
define('TEXT_BACK_TO_DISCOUNT_CATEGORIES','Back to Discount Categories');
define('DISPLAY_CATEGORIES', 'Select Category:');
define('DISPLAY_MANUFACTURERS', 'Select Manufacturer:'); 
define('DISPLAY_DISCOUNT_CATEGORIES', 'Select Discount Category:');

define('DC_ICON_STATUS_RED_LIGHT', 'Inactive');
define('DC_ICON_STATUS_GREEN_LIGHT', 'Active');
?>