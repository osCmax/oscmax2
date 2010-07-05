<?php
/*
  $Id: extra_values 2.0 2010-06-12 $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2008 osCommerce

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Values Maintenance for Extra Product Fields');
define('TABLE_HEADING_ID', 'ID #');
define('TABLE_HEADING_ORDER', 'Sort Order');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_PARENT', 'Parent ID#');
define('TABLE_HEADING_VALUE', 'Value');
define('TABLE_HEADING_IMAGE', 'Image');
define('TABLE_HEADING_REQUIRED', 'Required ID#');
define('TABLE_HEADING_EXCLUDES', 'Excludes ID#s');
define('TABLE_HEADING_LINKED', 'Linked ID#s');
define('TEXT_FIELD_ID', 'Value for Extra Field ID #');
define('TEXT_LANGAUGE', 'Language: ');
define('BUTTON_SUBVALUE', 'Add A Sub-Value To This Value');
define('BUTTON_NEW', "Add A Value To This Field/Language");
define('TEXT_SELECT_FIELD', 'Select a Language/ Field from the drop down list');
define('ERROR_NO_LIST_FIELDS', 'ERROR! There are no Extra Fields defined to use a list of values!');
define('HEADING_NEW', 'Creating New Value for ');
define('HEADING_EDIT', 'Editing Existing Value #');
define('ENTRY_ORDER', 'Sort Order: ');
define('ENTRY_VALUE', 'Value: ');
define('ENTRY_IMAGE', 'Optional Image: ');
define('ERROR_VALUE', 'Value must not be empty!');
define('TEXT_PREVIEW', 'The field entry for this list of values will look like this: ');
define('TEXT_CHAIN', 'Value Chain: ');
define('HEADING_DELETE', 'Delete Value ID #');
define('TEXT_FIELD_DATA', 'This value for Language: %s Field Label: %s or one of its sub-values is being used by %d products.');
define('TEXT_YES', 'Yes');
define('TEXT_NO', 'No');
define('TEXT_ARE_SURE', 'Are you sure you want to delete this value?');
define('TEXT_VALUES_GONE', ' All sub-values for this value will also be deleted!');
define('TEXT_CONFIRM_DELETE', 'Are you really sure you want to delete this value? All products that use this value or one of its sub-values will have their data for this field erased!');
define('WARNING_VALUE_USED', 'WARNING: This value is being used by %d products. While changing the sort order will not matter, any change to the value itself other than minor spelling corrections or clarifications could have unintended consequences in your online catalog.');
define('ERROR_FILENAME_USED', 'ERROR! The image filename being loaded is already used by another extra field value!');
define('TEXT_FIELD_LINKS', 'This value for Language: %s Field Label: %s or one of its sub-values is linked to %d values of linked field ID #%d.');
define('ENTRY_VALUE_REQUIREMENT', 'To use this value the following value from the linked field (or one of its subvalues) is required:');
define('ENTRY_NO_VALUE_REQUIRED', 'no specific value is required');
define('TEXT_REQUIRES', 'Value from linked field required to use this value:');
define('ENTRY_EXCLUDES', 'Checkmark any values which may not be selected at the same time as this value:');
define('TEXT_ALWAYS_AVAILABLE', 'The following values will be available during product entry for any value of linked field ID #');
define('TEXT_AVAILABLE_REQUIRED', 'The following values will be available during product entry only if one of the following values of linked field ID <b>#%s</b> is chosen: ');
?>
