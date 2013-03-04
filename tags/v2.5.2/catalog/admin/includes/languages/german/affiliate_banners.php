<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Affiliate Bannerverwaltung');

define('TABLE_HEADING_BANNERS', 'Banner');
define('TABLE_HEADING_GROUPS', 'Gruppe');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_STATISTICS', 'Anzeigen / Klicks');
define('TABLE_HEADING_PRODUCT_ID', 'Produkt ID');
define('TEXT_VALID_CATEGORIES_LIST', 'Verfügbare Kategorien');
define('TEXT_VALID_CATEGORIES_ID', 'Kategorie #');
define('TEXT_VALID_CATEGORIES_NAME', 'Kategoriename');
define('TABLE_HEADING_CATEGORY_ID', 'Kat ID');
define('TEXT_BANNERS_LINKED_CATEGORY','Kategorie ID');
define('TEXT_BANNERS_LINKED_CATEGORY_NOTE','Wenn Sie das Banner auf eine bestimmte Kategorie verlinken möchten, geben Sie die Kategorie-ID an. Wenn Sie auf die Standard-Seite verlinken möchten, geben Sie "0" an');
define('TEXT_AFFILIATE_VALIDCATS', 'Hier klicken:');
define('TEXT_AFFILIATE_CATEGORY_BANNER_VIEW','um die verfügbaren Kategorien anzuzeigen.');
define('TEXT_AFFILIATE_CATEGORY_BANNER_HELP','Wählen Sie die Kategorienummer aus dem Popup-Fenster und geben Sie die Nummer in das Kategorie-ID-Feld ein.');

define('TEXT_BANNERS_TITLE', 'Bannertitel:');
define('TEXT_BANNERS_GROUP', 'Banner-Gruppe:');
define('TEXT_BANNERS_NEW_GROUP', ', oder geben Sie unten eine neue Banner-Gruppe ein');
define('TEXT_BANNERS_IMAGE', 'Bild (Datei):');
define('TEXT_BANNERS_IMAGE_LOCAL', ', oder geben Sie unten die lokale Datei auf Ihrem Server an');
define('TEXT_BANNERS_IMAGE_TARGET', 'Bildziel (Speichern nach):');
define('TEXT_BANNERS_HTML_TEXT', 'HTML Text:');
define('TEXT_AFFILIATE_BANNERS_NOTE', '<b>Banner Bemerkung:</b><ul><li>Sie können Bild- oder HTML-Text-Banner verwenden, beides gleichzeitig ist nicht möglich.</li><li>Wenn Sie beide Bannerarten gleichzeitig verwenden, wird nur der HTML-Text Banner angezeigt.</li></ul>');

define('TEXT_BANNERS_LINKED_PRODUCT','Produkt ID');
define('TEXT_BANNERS_LINKED_PRODUCT_NOTE','Wenn Sie das Banner mit einem Produkt verlinken wollen, geben Sie hier die Produkt ID ein. Wenn Sie auf die Startseite verlinken wollen, geben Sie "0" ein.');

define('TEXT_BANNERS_DATE_ADDED', 'hinzugefügt am:');
define('TEXT_BANNERS_STATUS_CHANGE', 'Status geändert: %s');

define('TEXT_AFFILIATE_VALIDPRODUCTS', 'Hier klicken:');
define('TEXT_AFFILIATE_INDIVIDUAL_BANNER_VIEW', 'um die verfügbaren Produkte aufzulisten.');
define('TEXT_AFFILIATE_INDIVIDUAL_BANNER_HELP', 'Wählen Sie die Produktnummer aus dem Popup-Fenster und geben Sie die Nummer in das Produkt-ID-Feld ein.');

define('TEXT_VALID_PRODUCTS_LIST', 'Verfügbare Produkte');
define('TEXT_VALID_PRODUCTS_ID', 'Produkt ID');
define('TEXT_VALID_PRODUCTS_NAME', 'Produktbezeichnung');

define('TEXT_CLOSE_WINDOW', '<u>Fenster schließen</u> [x]');
define('TEXT_INFO_DELETE_INTRO', 'Sind Sie sicher, dass Sie dieses Banner löschen möchten?');
define('TEXT_INFO_DELETE_IMAGE', 'Bannerbild löschen');

define('SUCCESS_BANNER_INSERTED', 'Erfolg: Der Banner wurde eingefügt.');
define('SUCCESS_BANNER_UPDATED', 'Erfolg: Der Banner wurde aktualisiert.');
define('SUCCESS_BANNER_REMOVED', 'Erfolg: Der Banner wurde gelöscht.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Fehler: Ein Bannertitel ist erforderlich.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Fehler: Eine Bannergruppe ist erforderlich.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Fehler: Zielverzeichnis existiert nicht %s.');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Fehler: Zielverzeichnis ist schreibgeschützt: %s');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Fehler: Bild existiert nicht.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Fehler: Bild kann nicht gelöscht werden.');
?>