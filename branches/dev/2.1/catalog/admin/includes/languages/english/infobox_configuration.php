<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/


define('HEADER_TITLE', 'Infobox Display, Update and Create');
define('TABLE_HEADING_CONFIGURATION_TITLE', 'Title');
define('TABLE_HEADING_CONFIGURATION_VALUE', 'Filename');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_COLUMN', 'Column');
define('TABLE_HEADING_SORT_ORDER', 'Position');

define('TEXT_INFO_EDIT_INTRO', 'Please make any necessary changes');
define('TEXT_INFO_DATE_ADDED', 'Date Added:');
define('TEXT_INFO_LAST_MODIFIED', 'Last Modified:');
define('TEXT_INFO_HEADING_NEW_INFOBOX', 'Adding a new Infobox');
define('TEXT_INFO_INSERT_INTRO', 'An example for the<b> what\'s_new.php</b> infobox is selected');
define('TEXT_INFO_DELETE_INTRO', '<P STYLE="color: red; font-weight: bold;">Confirm OK to delete the Infobox');
define('TEXT_INFO_HEADING_DELETE_INFOBOX', 'Delete Infobox?');

define('IMAGE_INFOBOX_STATUS_GREEN', 'Left');
define('IMAGE_INFOBOX_STATUS_GREEN_LIGHT', 'Set left');
define('IMAGE_INFOBOX_STATUS_RED', 'Right');
define('IMAGE_INFOBOX_STATUS_RED_LIGHT', 'Set Right');
define('BOX_HEADING_BOXES', 'Boxes admin');

define('TEXT_INFOBOX_FILENAME', 'Filename');
define('TEXT_INFOBOX_DEFINE_KEY', 'Define Key');
define('TEXT_INFOBOX_COLUMN', 'Column (left or right)');
define('TEXT_INFOBOX_POSITION', 'Sort Order');
define('TEXT_INFOBOX_ACTIVE', 'Set this box as active?'); 


define('TEXT_HELP_HEADING_NEW_INFOBOX', 'Infobox Help');

define('TEXT_INFOBOX_HELP_FILENAME', 'This must represent the name of the box file you have put in your <u>catalog/includes/boxes</u> folder.<br><br> It must be lowercase, but can have spaces instead of using the underscore (_) and may include \'s as the system will remove these for you.<br><br>For example:<br>Your new Infobox is named <b>new_box.php</b>, you would type in here <b> new box</b><br><br>Another example would be the <b>whats_new</b> box.<br><br> Obviously it is named <b>whats_new.php </b>, you could type in here <b>what\'s new</b>');

define('TEXT_INFOBOX_HELP_HEADING', 'This is quite simply what will be displayed above the Infobox in your catalog.');

define('TEXT_INFOBOX_HELP_DEFINE', 'An example of this would be: <b>BOX_HEADING_WHATS_NEW</b>.  <br><br>This is used by the language files to deliver the correct translation of the infobox heading that you are creating or editing.  <br><br>If you wish to define this please look in the language file for the current infobox.');

define('TEXT_INFOBOX_HELP_COLUMN', 'Enter either <b>left</b> or <b>right</b>');

define('TEXT_INFOBOX_HELP_POSITION', 'Enter any number you like in here. The higher the number the lower down the selected column the Infobox will appear.<br><br> If you enter the same number for more than one Infobox they are displayed alphabetically first');

define('TEXT_INFOBOX_HELP_ACTIVE', 'Select <b>yes</b> or <b>no</b>. <br><br><b>yes</b> will display the Infobox and <b>no</b> will not.');

define('TEXT_CLOSE_WINDOW', '<u>Close Window</u> [x]');

define('COUNT_1', 'There are currently: ');
define('COUNT_2', ' boxes in the left column and ');
define('COUNT_3', ' boxes in the right column.');

?>