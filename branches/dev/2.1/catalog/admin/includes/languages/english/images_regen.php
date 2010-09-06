<?php
/*
$Id: backup.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Product Image Management');
define('TABLE_HEADING_PRODUCT_ID', 'ID');
define('TABLE_HEADING_PRODUCT_NAME', 'Product');
define('TABLE_HEADING_PRODUCT_IMAGE', 'Image Name');
define('TABLE_HEADING_MISSING_PRODUCT_IMAGE', 'Missing Image Name');

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

define('TEXT_INFO_DESCRIPTION', 'This will regenerate product and thumbnail images from pre-existing images held in the "images_big" directory.
		Existing images for thumbnails and products will be overwritten!<br />');
define('TEXT_INFO_WARNING', '<b>Warning:</b> This facility is NOT the best way to reproduce these images and is likely to load the server significantly.<br />
		It is recommended that you batch process images on your local machine instead.<br />');
define('TEXT_INFO_PROCESSING', '<br>Processing<br>');
define('TEXT_INFO_COMPLETED', '<br>Completed<br>');

define('TEXT_CONFIRM_REGENERATE_ALL', 'You have selected to regenerate all of your server images.  <br><br><b>Note:</b> All current images stored in <b>images/' . DYNAMIC_MOPICS_PRODUCTS_DIR . '</b> and <b>images/' . DYNAMIC_MOPICS_THUMBS_DIR . '</b> will be overwritten if a corresponding image exists in the <b>images/' . DYNAMIC_MOPICS_BIGIMAGES_DIR . '</b> folder. <br><br>Please also note that this process may use a large proportion of your server processing power and as such should be <b>only</b> run at quiet period on your store.');

?>