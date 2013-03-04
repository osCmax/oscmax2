<?php
/*
$Id: extra_fields.php 1125 2011-02-05 17:47:57Z cottonbarn $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', "Extra Product Fields");
define('TABLE_HEADING_ID', "ID #");
define('TABLE_HEADING_LABEL', 'Language/Label');
define('TABLE_HEADING_ORDER', 'Sort Order');
define('TABLE_HEADING_STATUS', 'Catalog Status');
define('TABLE_HEADING_ACTION', 'Action');
define('TEXT_YES', 'Yes');
define('TEXT_NO', 'No');
define('BUTTON_NEW', 'New Extra Field');
define('BUTTON_EDIT_VALUES', 'Edit Value List');
define('ENTRY_LABEL', 'Label: ');
define('ENTRY_ACTIVE', '<b>Field Active</b>');
define('ENTRY_ACTIVATE_NOW', 'Display field to customers: ');
define('ENTRY_SHOW_ADMIN', 'Display field in admin panel even if hidden from customers: ');
define('ENTRY_ORDER', 'Sort Order: ');
define('ENTRY_VALUE_LIST', 'Uses a List Of Values: ');
define('ENTRY_SEARCH', 'Enable Advanced Search on this field: ');
define('ENTRY_TEXT_ENTRY', 'Enter text using: ');
define('TEXT_SINGLE_LINE', 'single line');
define('TEXT_MULTILINE', 'text area');
define('TEXT_LIST_IGNORES', ' Text Area is ignored if field uses a List of Values.');
define('TEXT_TEXTAREA_NOTE', 'NOTE: Textarea fields may not be displayed in the product listing.');
define('ENTRY_LISTING', 'Show Field In Product Listings: ');
define('ENTRY_SIZE', 'Maximum number of characters allowed in field (ignored if field uses List of Values or text area): ');
define('ENTRY_META', 'Use Value Of Field As A META Keyword For Search Engines: ');
define('ENTRY_LIST_TYPE', 'From list of values user may select: ');
define('TEXT_SINGLE_VALUE', 'single value');
define('TEXT_MULTIPLE_VALUE', 'multiple values');
define('ENTRY_CHAIN', 'Show Chain Of Parent Values For Field (requires single value list): ');
define('ENTRY_RESTRICT', 'Allow Field To Be Used To Restrict Product Listings (requires single value list): ');
define('ENTRY_SEARCH_BOX', 'Use Field In Advanced Quick Search Box (requires single value list and advanced search): ');
define('ENTRY_CHECKBOX', 'Values Are Selected Using: ');
define('TEXT_DROPDOWN', 'Pull Down Menu');
define('TEXT_CHECKBOX', 'Check Boxes');
define('TEXT_RADIO', 'Radio Buttons');
define('TEXT_MS_CHECKBOX_NOTE', 'NOTE: This entry only applies to Single Value Select Lists which use the selected entry type except in the Advanced Quick Search box where a drop down menu is always used. Multiple Value Select Lists always use checkboxes for data entry.');
define('ENTRY_COLUMNS', 'Number of columns of values to use for checkbox/radio entry: ');
define('ENTRY_DISPLAY_TYPE', 'Display List Field Values As: ');
define('TEXT_TEXT', 'Text Only');
define('TEXT_IMAGE', 'Image Only (with alt text)');
define('TEXT_IMAGE_TEXT', 'Image &amp; Text');
define('TEXT_SAMPLE', 'Example Display');
define('ERROR_COLS_OUTOFRANGE', 'Number Of Columns must be a number between 1 and 255!');
define('ERROR_OUTOFRANGE', 'Maximum size must be a number between 1 and 255!');
define('ERROR_ENTRY_REQUIRED', 'Entry is missing! ');
define('ERROR_INCOMPATIBLE_MS_SC', 'Fields using a multiple-select value list cannot show a chain of parent values!');
define('ERROR_INCOMPATIBLE_TA_PL', 'Fields entering using a textarea field cannot be shown in the product listing!');
define('ERROR_INCOMPATIBLE_MS_RPL', 'Fields using a multiple-select value list cannot restrict product listings!');
define('ERROR_INCOMPATIBLE_MS_QS', 'Fields using a multiple-select value list cannot be used in the Advanced Quick Search box!');
define('ERROR_AS_REQUIRED', 'This field will not display in the Advanced Quick Search box unless you enable Advanced Search for this field.');
define('TEXT_APPLIES_LIST_ONLY', 'The following entries apply only if Uses List Of Values is set to Yes. You may ignore them for text area fields.');
define('TEXT_ENABLED', 'Enabled');
define('TEXT_DISABLED', 'Disabled');
define('TEXT_SIZE', 'Maximum Size: ');
define('TEXT_SEARCHABLE', 'Directly Searchable: ');
define('TEXT_META', 'META Keyword: ');
define('TEXT_USER_SELECTS', 'User May Select: ');
define('TEXT_SELECTED_BY', 'Selected Using: ');
define('TEXT_RESTRICTS', 'Restricts Product Listings: ');
define('TEXT_SHOW_PARENTS', 'Show Parent Values: ');
define('TEXT_SEARCH_BOX', 'Quick Search Box: ');
define('TEXT_COLUMNS', 'Number Of Check/Radio Columns: ');
define('TEXT_DISPLAY_TYPE', 'Display Values As: ');
define('TEXT_LINKED_TO', 'Linked To Field #');
define('HEADING_NEW', 'Creating New Field');
define('HEADING_EDIT', 'Editing Existing Field #');
define('ERROR_ACTIVE', 'Field must be active for at least one language!');
define('ERROR_LABEL', 'Field label for active language %s must not be blank!');
define('WARNING_TRUNCATE', 'Data will be lost if you reduce the field length to this size! Currently %d product descriptions contain values that are longer than this size! To avoid data loss this field would need to be at least %d characters long. If you really want to reduce the size of this field and cause data to be truncated then click the Save button to confirm the change.');
define('WARNING_LANGUAGE_IN_USE', 'This field currently has %d products with values set for the language %s! If you really want to deactivate the field for this language then click on the Save button to confirm the change. The currently entered information will not be deleted but it will also not be viewable or changeable.');
define('HEADING_DELETE', 'Delete Extra Product Field #');
define('TEXT_FIELD_DATA', '&nbsp;<b>Label:</b> %s <b>Used By:</b> %d products');
define('TEXT_ARE_SURE', 'Are you sure you want to delete this field?');
define('TEXT_VALUES_GONE', ' All values stored in the value lists for this field will also be deleted!');
define('TEXT_LINKS_DESTROYED', ' This field is linked to another field and all value links between this field and the other will be destroyed if you delete this field!');
define('TEXT_CONFIRM_DELETE', 'Are you really sure you want to delete this field? All data stored for this field will be lost!');
define('BUTTON_UNLINK', 'Unlink Field');
define('BUTTON_LINK', 'Link This Field To Another');
define('BUTTON_CREATE_LINK', 'Create Link To Selected Field');
define('HEADING_UNLINK', 'Unlink Field %d From Field %d');
define('TEXT_NUM_LINKED', 'Currently %d values from this field are linked to the other field.');
define('TEXT_SURE_UNLINK', 'Are you sure you want to unlink these two fields?');
define('TEXT_LINKS_GONE', ' All value links between this field and the other will be destroyed if you continue!');
define('TEXT_CONFIRM_UNLINK', 'Are you really sure you want to unlink these fields? All value links between this field and the other will be destroyed if you continue!');
define('ERROR_NO_FIELD', 'Field to link not found!');
define('TABLE_HEADING_SELECT', 'Select');
define('TEXT_SELECT_LINK', ' Select a field from the list below to link to this field. Languages in the list marked with a * may have values linked to this field.');
define('TEXT_NOT_LINKABLE', 'This field does not have any active languages that match the field to be linked and therefore may not be linked to that field.');
define('ERROR_NONE_LINKABLE', 'No fields were found that could be linked to this field!');
define('ERROR_WRONG_TYPE', 'Fields to link must both use value lists!');
define('ERROR_SAME_TYPE', 'One field to link must use a single select value list while the other must use a multiple select value list!');
define('ERROR_ALREADY_LINKED', 'Field %d is already linked to another field!');
define('TEXT_LINK_SUCCESS', 'Field %d has been successfully linked to field %d.');
define('ERROR_NOT_LINKED', 'This field is not linked to another field!');
define('TEXT_ADMIN_AVAILABLE', 'Available In Admin: ');

define('HEADING_NO_EPF', 'Extra Product Fields');
define('TEXT_NO_EPF', 'You currently have no extra fields set.<br><br>Please click <b>insert</b> to create a new one.');
define('ENTRY_ALL_CATEGORIES', 'Does this field apply to all categories?');
define('ENTRY_CHECK_CATEGORIES', 'Select the boxes for the categories to which this field applies: <br>Please note these will ignored if Does this field apply to all categories is set to YES. <ul><li>If a category is checked all subcategories underneath it are also automatically included. </li><li>If no categories are checked then the Does this field apply to all categories will set to YES.</li><li>Selecting the Top category is the same as selecting all categories.</li></ul>');
define('TEXT_ALL_CATEGORIES_HELP', 'Do this field apply to all categories in your store.  If not, set this setting to No and select the categories that do apply in the box which will show below.');
define('TEXT_ACTIVATE_NOW_HELP', 'Controls whether or not product data for the field will be displayed in the catalog.');
define('TEXT_SHOW_ADMIN_HELP', 'Controls whether or not data for the field can be entered and viewed during product entry if the field has been set to not visible in the catalog. This setting allows you to enter data for products while keeping that data hidden from customers using the catalog side of your web site.<br><br>This allows you to have fields that store data for a product that is useful only to the store but not to the store\'s customers. It also makes is possible to keep a field hidden from the catalog until data for that field has been entered for all of the products in the catalog. If both this field and Visible In Catalog are set to NO then no product data entry for the field can take place. Remember that a field that is visible in the catalog is always visible in admin as well.');
define('TEXT_LISTING_HELP', 'controls whether or not the field will be displayed as an available entry on the advanced search catalog page. All fields created with this contribution will be searched for the Search Criteria whenever the search descriptions option is chosen but this enables users to search a specific field for a certain value.');
define('TEXT_TEXT_HELP', 'A single line or a text area determines which type of text field you create in the database. If set to single line a VARCHAR type of field is created in the products description table of the database using the Maximum Number of Characters. If set to text area then a TEXT type field is created and the Maximum Number of Characters is ignored. Once you have created a text field you cannot change the type between single line and text area. This value will be ignored if you set Uses a List of Values to YES.');
define('TEXT_VALUE_LIST_HELP', 'Determines whether data for the field is entered in a standard empty text field (if set to NO) or as a list of preset values (if set to YES). If a list of values is chosen then the Maximum Number of Characters is ignored as all Value List values are allowed a maximum length of 64 characters.');
define('TEXT_VALUE_LIST_WARNING', ' Once this value for the new extra field is set it <b>cannot be changed</b>. A text field must remain a text field and a list field must stay a list field. If you set the wrong value for this question you will have to delete the field and create a new one.');
define('TEXT_LIST_TYPE_HELP', 'Select if you want to be able to select a single or multiple value.  Please read the warning message before saving your Extra Product Field.');
define('TEXT_LIST_TYPE_WARNING', 'The values for products for the two different types of list fields are stored in a totally different format in the product_descriptions database file so once you set this type it <b>cannot be changed</b>. <br><br>Single Select Lists store the product value as an integer which is simply a pointer to the actual value in the value list file. <br><br>Multi-Select Lists store the product value in a text field as a series of pointers separated by a delimiter. How many pointers are stored depends entirely on how many values are selected for the product.  <br><br><b>If you set the wrong value for this question you will have to delete the field and create a new one.</b>');
define('TEXT_CHAIN_HELP', 'This option  applies only if only a single value can be selected from the list. Multi-Select Lists cannot have parent values. For example, if you created a field for product type and one of the values for that field was <b>Movies</b> then you could create values under Movies of <b>VHS, DVD and BluRay</b>. If a product then had the value set to DVD, with Show Chain enabled the value would display as <b>Movies : DVD</b>. Otherwise the value would display as just <b>DVD</b>.');
define('TEXT_RESTRICT_HELP', 'The Restrict Product Listings option allows users to restrict the results of a product listing in the store. Please note that Multiple values List of Values cannot restrict the product listing.');
define('TEXT_SEARCH_HELP','Determines whether or not a Single Select List of Values will have a drop down menu appear for it in the Advanced Quick Search Box.');
define('TEXT_CHECKBOX_HELP', 'Sets which method a Single Select List of Values uses for data entry, both in the admin side during product entry and on the advanced search page of the catalog. Longer lists of values are better set to use a pull down menu.');
define('TEXT_COLUMNS_HELP', 'Determines how many values are listed in each row during data entry when using <b>radio buttons</b> for single select value lists or when using a <b>multi value</b> List of Values (which always uses <b>check boxes</b> for entry). Note that the actual number of columns shown can end up being less for a multi-select value list if you have linked it to another field.');

?>