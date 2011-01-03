<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Partnerprogramm Bannerverwaltung');

define('TABLE_HEADING_BANNERS', 'Banner');
define('TABLE_HEADING_GROUPS', 'Gruppe');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_STATISTICS', 'Anzeigen / Klicks');
define('TABLE_HEADING_PRODUCT_ID', 'Produkt ID');
define('TEXT_VALID_CATEGORIES_LIST', 'Available Categories List');
define('TEXT_VALID_CATEGORIES_ID', 'Category #');
define('TEXT_VALID_CATEGORIES_NAME', 'Categories Name');
define('TABLE_HEADING_CATEGORY_ID', 'Cat ID');
define('TEXT_BANNERS_LINKED_CATEGORY','Category ID');
define('TEXT_BANNERS_LINKED_CATEGORY_NOTE','If you want to link the Banner to a specific CATEGORY enter its CATEGORY ID here. If you want to link to the default page enter "0"');
define('TEXT_AFFILIATE_VALIDCATS', 'Click Here:');
define('TEXT_AFFILIATE_CATEGORY_BANNER_VIEW', 'to view available CATEGORIES.');
define('TEXT_AFFILIATE_CATEGORY_BANNER_HELP', 'Select the category number from the popup window and enter the number in the Category ID field.');

define('TEXT_BANNERS_TITLE', 'Titel des Banners:');
define('TEXT_BANNERS_GROUP', 'Banner-Gruppe:');
define('TEXT_BANNERS_NEW_GROUP', ', oder geben Sie unten eine neue Banner-Gruppe ein');
define('TEXT_BANNERS_IMAGE', 'Bild (Datei):');
define('TEXT_BANNERS_IMAGE_LOCAL', ', oder geben Sie unten die lokale Datei auf Ihrem Server an');
define('TEXT_BANNERS_IMAGE_TARGET', 'Bildziel (Speichern nach):');
define('TEXT_BANNERS_HTML_TEXT', 'HTML Text:');
define('TEXT_AFFILIATE_BANNERS_NOTE', '<b>Banner Bemerkung:</b><ul><li>Sie k&ouml;nnen Bild- oder HTML-Text-Banner verwenden, beides gleichzeitig ist nicht m&ouml;glich.</li><li>Wenn Sie beide Bannerarten gleichzeitig verwenden, wird nur der HTML-Text Banner angezeigt.</li></ul>');

define('TEXT_BANNERS_LINKED_PRODUCT','Produkt ID');
define('TEXT_BANNERS_LINKED_PRODUCT_NOTE','Wenn Sie das Banner mit einem Produkt verlinken wollen, geben Sie hier die Produkt ID ein. Wenn Sie mit der Startseite verlinken wollen geben Sie "0" ein.');

define('TEXT_BANNERS_DATE_ADDED', 'hinzugef&uuml;gt am:');
define('TEXT_BANNERS_STATUS_CHANGE', 'Status ge&auml;ndert: %s');

define('TEXT_AFFILIATE_VALIDPRODUCTS', 'Click Here:');
define('TEXT_AFFILIATE_INDIVIDUAL_BANNER_VIEW', 'to view available products.');
define('TEXT_AFFILIATE_INDIVIDUAL_BANNER_HELP', 'Select the product number from the popup window and enter the number in the Product ID field.');

define('TEXT_VALID_PRODUCTS_LIST', 'Available Products List');
define('TEXT_VALID_PRODUCTS_ID', 'Product #');
define('TEXT_VALID_PRODUCTS_NAME', 'Products Name');

define('TEXT_CLOSE_WINDOW', '<u>Close Window</u> [x]');
define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie diesen Banner l&ouml;schen m&ouml;chten?');
define('TEXT_INFO_DELETE_IMAGE', 'Bannerbild l&ouml;schen');

define('SUCCESS_BANNER_INSERTED', 'Erfolg: Der Banner wurde eingef&uuml;gt.');
define('SUCCESS_BANNER_UPDATED', 'Erfolg: Der Banner wurde aktualisiert.');
define('SUCCESS_BANNER_REMOVED', 'Erfolg: Der Banner wurde gel&ouml;scht.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Fehler: Ein Bannertitel wird ben&ouml;tigt.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Fehler: Eine Bannergruppe wird ben&ouml;tigt.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Fehler: Zielverzeichnis existiert nicht %s.');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Fehler: Zielverzeichnis ist nicht beschreibbar: %s');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Fehler: Bild existiert nicht.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Fehler: Bild kann nicht gel&ouml;scht werden.');
?>