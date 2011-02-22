<?php
/*
$Id: discount_categories.php 1011 2011-01-06 23:38:01Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
  
define('HEADING_TITLE', 'Rabattgruppen');
define('HEADING_TITLE_PRODUCTS_TO_DISCOUNT_CATEGORIES', 'Products to Discount categories');
define('HEADING_TITLE_SEARCH', 'Suchen:');
define('HEADING_TITLE_NEW_DISCOUNT_CATEGORIES_NAME', '<b>Neue Rabattgruppe ;</b>');

define('TABLE_HEADING_NAME', 'Name');
define('TABLE_HEADING_ID', 'dcID');
define('TABLE_HEADING_PRODUCTS_ID', 'pID');
define('TABLE_HEADING_MODEL', 'Art-Nr');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_DISCOUNT_CATEGORY', 'Rabattgruppe');
define('TABLE_HEADING_DISCOUNT_CATEGORIES_NAME', '/ <b>Name</b>');
define('TABLE_HEADING_NEW_DISCOUNT_CATEGORIES_NAME', ' <b>Name</b>');
define('TABLE_HEADING_DISCOUNT_CATEGORIES_ID', '<b>ID</b>');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_CUSTOMERS_GROUPS', 'Kundengruppe');

define('ENTRY_DISCOUNT_CATEGORIES_NAME', '<b>Rabattgruppenbezeichnung</b>');
define('ENTRY_NEW_DISCOUNT_CATEGORIES_NAME', '<b>Neue Rabattgruppe </b>');
define('ENTRY_DISCOUNT_CATEGORIES_NAME_MAX_LENGTH', ' (maximal 255 Zeichen)');

define('ERROR_DISCOUNT_CATEGORIES_NAME', 'Bitte geben Sie einen Namen für die Rabattgruppe an');
define('ERROR_DISCOUNT_CATEGORIES_ID', 'Es existiert keine Kategorie ID bei diesem Vorgang');
define('ERROR_UPDATE_INSERT_DISCOUNT_CATEGORY', 'Es ist ein Fehler während der Änderung der Tabelle discount_categories aufgetreten.');

define('TEXT_DELETE_INTRO', 'Sind Sie sicher, dasss Sie diese Rabattgruppe löschen möchten?');
define('TEXT_DISPLAY_NUMBER_OF_DISCOUNT_CATEGORIES', '<b>%d</b> bis <b>%d</b> (von <b>%d</b> Rabattgruppen)');
define('TEXT_INFO_HEADING_DELETE_DISCOUNT_CATEGORY', 'Rabattgruppe löschen');
define('TEXT_NO_PRODUCTS','Keine Produkte gefunden');
define('TEXT_MOUSE_OVER_DISCOUNT_GROUPS_PER_GROUP_POPUP', 'Klicken zum Bearbeiten der Rabattgruppen dieses Produktes für jede Kundengruppe in einem Popup-Fenster');
define('TEXT_IMAGE_SWITCH_EDIT','Gehen Sie zu categories.php für eine komplette Bearbeitung');
define('TEXT_IMAGE_EDIT_GROUP_DISCOUNT_CATEGORIES', 'Bearbeiten der Rabattgruppen dieses Produktes für jede Kundengruppe in einem Popup-Fenster');
define('NAME_WINDOW_DISCOUNT_GROUPS_PER_GROUP_POPUP', 'Rabattgruppen je Kundengruppe');
define('SORT_BY_PRODUCTS_ID_ASC', 'Aufsteigend sortieren nach Produkt ID  --> 1-2-3 von oben ');
define('SORT_BY_PRODUCTS_ID_DESC', 'Absteigend sortieren nach Produkt ID  --> 3-2-1 von oben ');
define('SORT_BY_PRODUCTS_MODEL_ASC', 'Aufsteigend sortieren nach Artikelnummer  --> a-b-c von oben ');
define('SORT_BY_PRODUCTS_MODEL_DESC', 'Absteigend sortieren nach Artikelnummer  --> z-y-x von oben ');
define('SORT_BY_PRODUCTS_NAME_ASC', 'Aufsteigend sortieren nach Produktbezeichnung  --> a-b-c von oben ');
define('SORT_BY_PRODUCTS_NAME_DESC', 'Absteigend sortieren nach Produktbezeichnung  --> z-y-x von oben ');


define('TEXT_MAXI_ROW_BY_PAGE', 'Maximal # Zeilen pro Seite');
define('TEXT_ALL_MANUFACTURERS', 'Alle Hersteller');
define('TEXT_ALL_DISCOUNT_CATEGORIES', 'Alle Rabattgruppen');
define('TEXT_BACK_TO_DISCOUNT_CATEGORIES','Zurück zu Rabattgruppen');
define('DISPLAY_CATEGORIES', 'Kategorie auswählen:');
define('DISPLAY_MANUFACTURERS', 'Hersteller auswählen:'); 
define('DISPLAY_DISCOUNT_CATEGORIES', 'Rabattgruppe auswählen:');

define('DC_ICON_STATUS_RED_LIGHT', 'Inaktiv');
define('DC_ICON_STATUS_GREEN_LIGHT', 'Aktiv');
?>