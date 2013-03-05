<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Kategorien / Produkte');
define('HEADING_TITLE_SEARCH', 'Suche: ');
define('HEADING_TITLE_GOTO', 'Gehe zu:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Kategorien / Produkte');
define('TABLE_HEADING_MODEL_NUMBER', 'Artikelnummer');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_STATUS', 'Status');

define('TEXT_NEW_PRODUCT', 'Produkte hinzufügen/bearbeiten in &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Kategorien:');
define('TEXT_SUBCATEGORIES', 'Unterkategorien:');
define('TEXT_PRODUCTS', 'Produkte:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Preis:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Steuerklasse:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Durchschnittliche Bewertung:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Anzahl:');
define('TEXT_DATE_ADDED', 'Hinzugefügt am:');
define('TEXT_DATE_AVAILABLE', 'Verfügbar ab:');
define('TEXT_LAST_MODIFIED', 'Letzte Änderung:');
define('TEXT_IMAGE_NONEXISTENT', 'BILD EXISTIERT NICHT');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Bitte fügen Sie eine neue Kategorie oder eine Produkt ein.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Für weitere Informationen besuchen Sie bitte die <a href="http://%s" target="blank"><u>Herstellerhomepage</u></a> dieses Produktes.');
define('TEXT_PRODUCT_DATE_ADDED', 'Diesen Artikel haben wir am %s in unseren Katalog aufgenommen.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Dieser Artikel ist erhältlich ab dem %s.');

define('TEXT_EDIT_INTRO', 'Führen Sie die gewünschten Änderungen durch.');
define('TEXT_EDIT_CATEGORIES_ID', 'Kategorie ID:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Kategoriename:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Kategoriebild:');
define('TEXT_EDIT_SORT_ORDER', 'Sortierung:');

define('TEXT_INFO_COPY_TO_INTRO', 'Bitte wählen Sie eine neue Kategorie aus, in die Sie den Artikel kopieren möchten:');
define('TEXT_INFO_CURRENT_CATEGORIES', 'aktuelle Kategorien:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Neue Kategorie');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Kategorie bearbeiten');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Kategorie löschen');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'Kategorie verschieben');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Produkt löschen');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'Produkt verschieben');
define('TEXT_INFO_HEADING_COPY_TO', 'Kopieren nach');

define('TEXT_DELETE_CATEGORY_INTRO', 'Sind Sie sicher, dass Sie diese Kategorie löschen möchten?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Sind Sie sicher, dass Sie dieses Produkt löschen möchten?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>WARNUNG:</b> Es existieren noch %s (Unter-)Kategorien, die mit dieser Kategorie verbunden sind!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>WARNUNG:</b> Es existieren noch %s Produkt(e), die mit dieser Kategorie verbunden sind!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Bitte wählen Sie die Kategorie, in die Sie <b>%s</b> verschieben möchten');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Bitte wählen Sie die Kategorie, in die Sie <b>%s</b> verschieben möchten');
define('TEXT_MOVE', 'Verschiebe <b>%s</b> nach:');

define('TEXT_NEW_CATEGORY_INTRO', 'Bitte vervollständigen Sie die Angaben zur neuen Kategorie.');
define('TEXT_CATEGORIES_NAME', 'Kategoriename:');
define('TEXT_CATEGORIES_IMAGE', 'Kategoriebild:');
define('TEXT_SORT_ORDER', 'Sortierung:');

define('TEXT_PRODUCTS_STATUS', 'Status:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Lagernd ab:');
define('TEXT_PRODUCT_AVAILABLE', 'Lagernd');
define('TEXT_PRODUCT_DISCONTINUED', 'Nicht mehr lieferbar');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Nicht Lagernd');
define('TEXT_PRODUCTS_MANUFACTURER', 'Hersteller:');
define('TEXT_PRODUCTS_NAME', 'Produktbezeichnung:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Produktbeschreibung:');
define('TEXT_PRODUCTS_QUANTITY', 'Anzahl:');
define('TEXT_PRODUCTS_MODEL', 'Artikelnummer:');
define('TEXT_PRODUCTS_IMAGE', 'Produktbild:');
define('TEXT_PRODUCTS_URL', 'Herstellerlink:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(ohne http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Preis (Netto):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Preis (Brutto):');
define('TEXT_PRODUCTS_MSRP_GROSS', 'UVP (Brutto):');
define('TEXT_PRODUCTS_WEIGHT', 'Gewicht:');
define('TEXT_PRODUCTS_HEIGHT', 'Höhe:');
define('TEXT_PRODUCTS_LENGTH', 'Länge:');
define('TEXT_PRODUCTS_WIDTH', 'Breite:');
define('TEXT_PRODUCTS_READY_TO_SHIP', 'Versandbereit:<br/>(Fedex)');
define('TEXT_PRODUCTS_READY_TO_SHIP_SELECTION', 'Das Produkt kann in der eigenen Verpackung versendet werden.');

// BOF Separate Pricing Per Customer
define('TEXT_CUSTOMERS_GROUPS_NOTE', 'Hinweis: Wenn Sie ein Feld leer lassen, wird kein Preis für diese Kundegruppe in die Datenbank eingefügt.<br />
Wenn ein Preis eingetragen, aber die Auswahlbox nicht angehakt ist, wird ebenfalls kein Preis eingefügt.<br />
Wenn ein Preis bereits in die Datenbank eingetragen ist, aber die Auswahlbox nicht angehakt ist, wird der Preis aus der Datenbank entfernt.');
// EOF Separate Pricing Per Customer

define('EMPTY_CATEGORY', 'Leere Kategorie');

define('TEXT_HOW_TO_COPY', 'Kopiermethode:');
define('TEXT_COPY_AS_LINK', 'Produkt verlinken');
define('TEXT_COPY_AS_DUPLICATE', 'Produkt duplizieren');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Fehler: Produkte können nicht in der gleichen Kategorie verlinkt werden.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Fehler: Das Bildverzeichnis ist schreibgeschützt: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Fehler: Das Bildverzeichnis existiert nicht: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Fehler: Die Kategorie kann nicht in ihre eigene Unterkategorie verschoben werden.');
define('ERROR_CATALOG_THUMBS_DIRECTORY_DOES_NOT_EXIST', 'Fehler: Das Bildverzeichnis existiert nicht: ' . DIR_FS_CATALOG_IMAGES . DYNAMIC_MOPICS_THUMBS_DIR);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Fehler: Die Kategorie kann nicht in ihre eigene Unterkategorie verschoben werden.');

//Select Product Image Directory & Instant Update For Products
define('TEXT_IMAGE_TITLE', 'Bilder Upload &amp Verwaltung');
define('TEXT_PRODUCTS_DIRECTORY_DONT_EXIST_1', 'Fehler: - Der angegebene \'images\' Bilderordner ');
define('TEXT_PRODUCTS_DIRECTORY_DONT_EXIST_2', ' existiert nicht auf dem Server!.');
define('TEXT_PRODUCTS_IMAGE_DIRECTORY', 'Bilderordner:');
define('TEXT_PRODUCTS_IMAGE_ROOT_DIRECTORY', 'Bilderordner');
define('TEXT_PRODUCTS_IMAGE_NEW_FOLDER', 'Neuer Unterordner: ');
define('TEXT_PRODUCTS_UPDATE_PRODUCT', 'Aktualisieren');
define('TEXT_PRODUCTS_INSERT_PRODUCT', 'Einfügen');
define('TEXT_PRODUCTS_WITHOUT_PREVIEW', ' ohne Vorschau ');
define('TEXT_PRODUCTS_MOPICS', 'Extrabild:');
define('TEXT_MOPICS_WARNING', 'Wählen Sie einen Bilderordner VOR dem Hinaufladen');

//Multi image upload 
define('TEXT_MOPICS_CONTENT', 'Dynamic Mopics benötigt alle Bilder im selben Format, zB jpg oder png. Sie können Bildformate<b>nicht</b> mischen.');
define('TEXT_UPLOAD_IMAGES', '<b>Bild hochladen</b>');
define('TEXT_CURRENT_IMAGES', '<b>Aktuelles Bild</b>');
define('TEXT_DELETE_IMAGES', '<b>Löschen?</b>');
define('TEXT_EXTRA_IMAGE', 'Zusätzliches Bild');
define('TEXT_MOPICS_ERROR', 'Bildfolgefehler');
define('TEXT_MOPICS_ERROR_HELP', 'Dynamic Mopics müssen fortlaufend benannt sein und es dürfen keine Bilder fehlen. Wenn ein Bild fehlt (zB _1 -> _3), dann werden die Bilder nach der ersten Lücke nicht mehr angezeigt.');

define('TEXT_SHIPPING_DIMENSIONS', 'Packmaß');

define('TEXT_SPPC_HELP', '<hr />Gruppenpreis:<br />Hinweis: Wenn Sie ein Feld leer lassen, wird kein Preis für diese Kundegruppe in die Datenbank eingefügt.<br />
Wenn ein Preis eingetragen, aber die Auswahlbox nicht angehakt ist, wird ebenfalls kein Preis eingefügt.<br />
Wenn ein Preis bereits in die Datenbank eingetragen ist, aber die Auswahlbox nicht angehakt ist, wird der Preis aus der Datenbank entfernt.');
define('TEXT_SPPC_WARNING', '<br /><strong>Versichern Sie sich, dass Sie die entsprechende Auswahlbox abwählen!</strong><br />');

define('TEXT_CLICK_TO_ENLARGE', 'Bild vergrößern');

define('TAB1', 'Tab 1');
define('TAB2', 'Tab 2');
define('TAB3', 'Tab 3');
define('TAB4', 'Tab 4');
define('TAB5', 'Tab 5');
define('TAB6', 'Tab 6');

// BOF Hide product from groups
define('TEXT_HIDE_PRODUCTS_FROM_GROUP', 'Produkt in diesen Gruppen verstecken:');
define('TEXT_HIDDEN_FROM_GROUPS', 'Versteckt in diesen Gruppen: ');
define('TEXT_GROUPS_NONE', 'keine');
define('TEXT_HIDE_CATEGORIES_FROM_GROUPS', 'Kategorie in diesen Gruppen verstecken:');
define('TABLE_HEADING_HIDE_CATEGORIES', 'Versteckt');
// 0: Icons for all groups for which the category or product is hidden, mouse-over the icons to see what group
// 1: Only one icon and only if the category or product is hidden for a group, mouse-over the icon to what groups
define('LAYOUT_HIDE_FROM', '0'); 
// EOF Hide product from groups

// BOF QPBPP for SPPC
define('TEXT_PRODUCTS_QTY_BLOCKS', 'Verpackungseinheit:');
define('TEXT_PRODUCTS_QTY_BLOCKS_HELP', '(kann nur als Vielfaches der Verpackungseinheit bestellt werden, standardmäßig 1)');
define('TEXT_PRODUCTS_PRICE', 'Preisstaffel');
define('TEXT_PRODUCTS_QTY', 'Stück zum Einzelpreis von');
define('TEXT_PRODUCTS_DELETE', 'Löschen');
define('TEXT_ENTER_QUANTITY', 'Menge');
define('TEXT_PRICE_PER_PIECE', 'Preis pro Stück');
define('TEXT_SAVINGS', 'Ihre Ersparnis');
define('TEXT_DISCOUNT_CATEGORY', 'Rabattkategorie:');
define('ERROR_UPDATE_INSERT_DISCOUNT_CATEGORY', 'Es ist beim Andern oder Anlegen der Tabelle discount_categories ein Fehler aufgetreten');
define('ERROR_ALL_CUSTOMER_GROUPS_DELETED', 'Alle Kundengruppen wurden gelöscht. Bitte legen Sie zumindest retail in der Tabekke customers_groups an (siehe sppc_v421_install.sql)');
define('TEXT_PRODUCTS_MIN_ORDER_QTY', 'Mindestbestellmenge:');
define('TEXT_PRODUCTS_MIN_ORDER_QTY_HELP', '(standardmäßig 1,  Angabe nicht verpflichtend)');
define('TEXT_PRICE_BREAK_INFO', '<acronym title="wie Preis(Menge)">Preissprung</acronym>: ');
define('PB_DROPDOWN_BEFORE', '');
define('PB_DROPDOWN_BETWEEN', ' bei ');
define('PB_DROPDOWN_AFTER', ' je');
define('PB_FROM', 'ab');
// EOF QPBPP for SPPC

// BOF Open Featured Sets
define('TEXT_PRODUCTS_SHORT', 'Kurzbeschreibung des Produktes:');
define('TABLE_HEADING_FEATURED', 'Empfohlen');
define('TABLE_HEADING_FEATURED_PREVIEW', 'Empfehlungen Vorschau');
define('TEXT_CATEGORIES_FEATURED', 'Empfohlene Kategorie');
define('TEXT_CATEGORIES_YES', 'Ja');
define('TEXT_CATEGORIES_NO', 'Nein');
define('TEXT_CATEGORIES_FEATURED_DATE', 'Empfohlen bis Datum ');
define('TEXT_PRODUCTS_FEATURED', 'Empfohlenes Produkt:');
define('TEXT_PRODUCT_NO', 'Nein');
define('TEXT_PRODUCT_YES', 'Ja');
define('TEXT_MORE_INFO', 'mehr...');
// EOF Open Featured Sets

define('HEADING_PRICE_HELP','Preis Hilfe');
define('TEXT_PRICE_HELP', 'Wenn Sie <b>Preis auf Anfrage!</b> anzeigen lassen möchten, geben Sie als Preis -1 ein');
define('HEADING_MSRP_HELP', 'Unverbindlich Verkaufspreis des Herstellers');
define('TEXT_MSRP_HELP', 'Wenn Sie den UVP in Ihrem Onlineshop auf der Produktinformationsseite anzeigen lassen möchten, geben Sie ihn hier ein.');
define('TEXT_ADD_PL', 'Einen weiteren Preissprung hinzufügen');
define('TEXT_FEATURED_UNTIL', 'Empfohlen bis: ');

define('TEXT_THUMBNAIL_IMAGE', 'Vorschaubild:');

// BOF indvship 4.5
define('TEXT_PRODUCTS_ZIPCODE', 'Postleitzahl: ');
define('TEXT_INDIV_SHIPPING_PRICE', 'Versandkosten für dieses Produkt: ');
define('TEXT_INDIV_ADDITIONAL_PRICE', 'Versandkosten für jedes zusätzliche Produkt: ');
// EOF indvship 4.5

define('TEXT_SHIP_SEPARATELY', 'FedEx Ship Separately:');
?>