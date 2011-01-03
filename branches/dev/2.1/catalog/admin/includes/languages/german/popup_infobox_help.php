<?php
/*
$Id: popup_infobox_help.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Infobox Help');
define('TEXT_INFO_HEADING_NEW_INFOBOX', 'Infobox Help');

define('TEXT_INFOBOX_HELP_FILENAME', 'This must represent the name of the box file you have put in your <u>catalog/includes/boxes</u> folder.<br><br> It must be lowercase, but can have spaces instead of using the underscore (_)<br><br>For example:<br>Your new Infobox is named <b>new_box.php</b>, you would type in here "<b> new box</b>"<br><br>Another example would be the <b>whats_new</b> box.<br> Obviuosly it is named <b>whats_new.php </b>, you could type in here <b>what\'s new</b>');

define('TEXT_INFOBOX_HELP_HEADING', 'This is quite simply what will be displayed above the Infobox in your catalog.<br><div align="center"><img border="0" src="images/help1.gif"><br></div>');

define('TEXT_INFOBOX_HELP_DEFINE', 'An example of this would be: <b>BOX_HEADING_WHATS_NEW</b>.<br> This is then used with the main logic of your store as this: <b> define(\'BOX_HEADING_WHATS_NEW\', \'What\'s New?\');</b><br><br> If you open the file <u>catalog/includes/languages/english.php</u> you can see plenty of examples, the ones that contain BOX_HEADING are no longer needed as they are now stored within the database and defined in the files <b>column_left.php</b> and <b>column_right.php</b>.<br>But there is no need to delete them!! ');

define('TEXT_INFOBOX_HELP_COLUMN', 'Easy one this!! Enter either <b>left</b> or <b>right</b><br> If you want the Infobox displayed in the left column -- enter <b>left</b> or if you want it the right column -- enter <b>right</b><br><br><br> To be honest I wanted to use the <b>tep_cfg_select_option</b>, but as I am using it to activate the Infobox for some reason I could\'nt.<br> It would only select one of them.<br><br> If anyone can shed any light on why I would be most grateful for the info.<a href="mailto:paul_langford@btopenworld.com"> mail me</a>');



define('TEXT_INFOBOX_HELP_POSITION', 'Enter any number you like in here. The higher the number the lower down the selected column the Infobox will appear.<br><br> If you enter the same number for more than one Infobox they are displayed alphabetically first');
define('TEXT_INFOBOX_HELP_ACTIVE', 'Again either select <b>yes</b> or <b>no</b>. <b>yes</b> will display the Infobox and <b>no</b> will not allow the Infobox to be displayed.');
define('TEXT_CLOSE_WINDOW', '<u>Close Window</u> [x]');

?>
