<?php
/*
$Id: images_regen.php 1407 2011-05-15 16:01:42Z cottonbarn $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Product Image Management');
define('TABLE_HEADING_PRODUCT_ID', 'ID');
define('TABLE_HEADING_PRODUCT_MODEL', 'Model');
define('TABLE_HEADING_PRODUCT_NAME', 'Product');
define('TABLE_HEADING_PRODUCT_IMAGE', 'Image Name');
define('TABLE_HEADING_MISSING_PRODUCT_IMAGE', 'Missing Image Name');
define('TABLE_HEADING_IMAGE_FOLDER', 'Image Folder');
define('TABLE_HEADING_ORPHAN_IMAGES', 'Orphan Images');
define('TABLE_HEADING_FOLDER', 'Folder');
define('TABLE_HEADING_IMAGE_SIZE', 'Image Size');
define('TABLE_HEADING_WIDTH', 'Width');
define('TABLE_HEADING_HEIGHT', 'Height');
define('TABLE_HEADING_JPG', 'JPG');
define('TABLE_HEADING_PNG', 'PNG');
define('TABLE_HEADING_GIF', 'GIF');
define('TABLE_HEADING_UNKNOWN', 'Unknown');
define('TABLE_HEADING_TOTAL', 'Total');	   
define('MISSING_IMAGES', 'Missing Images');
define('ORPHAN_IMAGES', 'Orphan Images');
define('SUMMARY', 'Summary');

define('TABLE_HEADING_L', 'L');
define('TABLE_HEADING_M', 'M');
define('TABLE_HEADING_S', 'S'); 
define('TABLE_HEADING_DL', 'DL');
define('TABLE_HEADING_DM', 'DM');
define('TABLE_HEADING_DS', 'DS');
define('TABLE_HEADING_IMAGE_FILE_SIZE_LG', 'L Kb');
define('TABLE_HEADING_IMAGE_FILE_SIZE_MD', 'M Kb');
define('TABLE_HEADING_IMAGE_FILE_SIZE_SM', 'S Kb');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_MISSING_IMAGES', 'Missing Images');
define('TEXT_YOU_HAVE', 'You have ');
define('TEXT_ACCOUNT_FOR', ' in your store database and they are all accounted for.');
define('TEXT_SUCCESS_1', 'All images that could be regenerated from ');
define('TEXT_SUCCESS_2', '  have been regenerated successfully');
define('TEXT_IMAGES_ON_SERVER', ' images on your server including ');
define('TEXT_DYNAMIC', 'dynamic mopics image');
define('TEXT_ACCOUNTED_FOR', ' (eg. _1, _2, etc.) and they are all accounted for.');
define('TEXT_IMAGES_FOR', 'Images for ');
define('TEXT_SUC_REGEN', ' successfully regenerated');
define('TEXT_SMALL_IMAGE', 'Small Image');
define('TEXT_MEDIUM_IMAGE', 'Medium Image');
define('TEXT_LARGE_IMAGE', 'Large Image');
define('TEXT_FILE_SIZE', 'File Size');
define('TEXT_MAIN_IMAGE', 'Main Image: ');
define('TEXT_SMALL_IMAGE', 'Small Image');
define('TEXT_PRODUCT_IMAGE', 'Product Images');
define('TEXT_LARGE_IMAGE', 'Large Image');
define('TEXT_MISSING_FROM', 'You are missing the image file from ');
define('TEXT_NO_GENERATE', ' without which you can not regenerate your images.');
define('TEXT_MOPICS_IMAGE', 'Mopics image: ');
define('TEXT_OUT_OF', 'Out of ');
define('TEXT_PRODUCTS_YOU_HAVE', ' products you have ');
define('TEXT_MISSING_IMAGE', ' missing image');
define('TEXT_NO_MOPICS', 'Please note that any files using the numerical (_1, _2, etc.) Dynamic Mopics structure have been excluded from this scan.');
define('TEXT_REGENERATE_ALL', 'Regenerate all server images - please confirm!');
define('TEXT_INFO_DESCRIPTION', 'This will regenerate product and thumbnail images from pre-existing images held in the "images_big" directory.
		Existing images for thumbnails and products will be overwritten!<br />');
define('TEXT_INFO_WARNING', '<b>Warning:</b> This facility is NOT the best way to reproduce these images and is likely to load the server significantly.<br />
		It is recommended that you batch process images on your local machine instead.<br />');
define('TEXT_INFO_PROCESSING', '<br>Processing<br>');
define('TEXT_INFO_COMPLETED', '<br>Completed<br>');

define('TEXT_CONFIRM_REGENERATE_ALL', 'You have selected to regenerate all of your server images.  <br><br><b>Note:</b> All current images stored in <b>images/' . DYNAMIC_MOPICS_PRODUCTS_DIR . '</b> and <b>images/' . DYNAMIC_MOPICS_THUMBS_DIR . '</b> will be overwritten if a corresponding image exists in the <b>images/' . DYNAMIC_MOPICS_BIGIMAGES_DIR . '</b> folder. <br><br>Please also note that this process may use a large proportion of your server processing power and as such should be <b>only</b> run at quiet period on your store.');

define('IMAGE_MISSING_IMAGE', 'Missing Thumbnail Image');

define('IMAGE_REGENERATE_MISSING','Regenerate Missing');
define('TEXT_SUCESS_TOTAL', 'Total image sets regenerated = ');
define('TEXT_REGENERATE_MISSING', 'Regenerate missing server images - please confirm!');
define('TEXT_CONFIRM_REGENERATE_MISSING', 'You have selected to regenerate all missing server images.  <br><br><b>Note:</b> All current images stored in <b>images/' . DYNAMIC_MOPICS_PRODUCTS_DIR . '</b> and <b>images/' . DYNAMIC_MOPICS_THUMBS_DIR . '</b> will be overwritten if a corresponding image exists in the <b>images/' . DYNAMIC_MOPICS_BIGIMAGES_DIR . '</b> folder. <br><br>Please also note that this process may use a large proportion of your server processing power and as such should be <b>only</b> run at quiet period on your store.');

define('TEXT_DELETE_ORPHANS', 'Delete Orphan Images');
define('TEXT_CONFIRM_DELETE_ORPHANS', 'Please confirm that you wish to delete all your orphan images.<br><br>  This action <b>can not be undone</b> and it is <i>strongly recommended</i> that you <b>back up your data</b> prior to using this function.');
define('TEXT_ORPHAN_REMOVED', 'orphan(s) image removed.');

define('TEXT_IMAGE_SIZE', 'Hide images < than: ');
define('TEXT_FILTER', 'Filter by category: ');

?>