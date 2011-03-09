<?php
/*
$Id: premade_comments.php 1084 2011-01-23 19:10:38Z cottonbarn $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Premade Order Comments');

define('TEXT_SAVED_COMMENT', 'You have saved your changes to your premade comment.');
define('TEXT_DELETED_COMMENT', 'You have deleted a premade comment.');
define('TEXT_ADDED_COMMENT', 'You have added a new premade comment.');
define('TEXT_INSTRUCTIONS_DEFAULT', 'Please either <b>Select</b> an existing Premade Comment from the drop down list or <b>Add new</b> comment.');

define('TEXT_DUPLICATE', '_duplicate');

define('ERROR_TITLE', 'The required field <b>Title</b> is missing.<br>');
define('ERROR_TEXT', 'The required field <b>Text</b> is missing.<br>');
define('ERROR_COMMENT', 'Comment already exists.<br>');
define('ERROR_COMMENT_FIX', 'You have used a <b>Title</b> that already exists.  The system has created this for you with a suffix of <b>' . TEXT_DUPLICATE . '</b>.<br>Please select this comment and choose a unique title then delete the one marked ' . TEXT_DUPLICATE . '.<br>');

define('TEXT_PREMADE_REPLIES', 'Premade Replies:');
define('BUTTON_SELECT', 'Select');
define('BUTTON_ADD_NEW', 'Add New');

define('TEXT_EDIT_COMMENT', 'Edit Premade Comment:');
define('TEXT_TITLE', 'Title:');
define('TEXT_TEXT', 'Text:');
define('BUTTON_DELETE', 'Delete');
define('BUTTON_SAVE_CHANGES', 'Save Changes');
define('TEXT_CREATE_COMMENT', 'Create New Premade Comment:');
define('BUTTON_CREATE_REPLY', 'Create Comment');
?>