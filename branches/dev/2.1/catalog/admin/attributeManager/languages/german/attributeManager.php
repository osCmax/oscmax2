<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
/*

  German translation to AJAX-AttributeManager-V2.7
  
  by Shimon Doodkin and ragerbua
  http://help.me.pro.googlepages.com
  helpmepro1@gmail.com
*/

//attributeManagerPrompts.inc.php

define('AM_AJAX_YES', 'Ja');
define('AM_AJAX_NO', 'Nein');
define('AM_AJAX_UPDATE', 'Aktualisieren');
define('AM_AJAX_CANCEL', 'Abbrechen');
define('AM_AJAX_OK', 'OK');

define('AM_AJAX_SORT', 'Sortieren:');
define('AM_AJAX_TRACK_STOCK', 'Lagerstand prüfen?');
define('AM_AJAX_TRACK_STOCK_IMGALT', 'Lagerstand für dieses Attribut prüfen?');

define('AM_AJAX_ENTER_NEW_OPTION_NAME', 'Bitte geben Sie einen neuen Optionsnamen ein');
define('AM_AJAX_ENTER_NEW_OPTION_VALUE_NAME', 'Bitte geben Sie einen neuen Optionsnamen ein');
define('AM_AJAX_ENTER_NEW_OPTION_VALUE_NAME_TO_ADD_TO', 'Bitte geben Sie einen Namen für den Optionswert ein, den Sie zu %s hinzufügen möchten');

define('AM_AJAX_PROMPT_REMOVE_OPTION_AND_ALL_VALUES', 'Sind Sie sicher, dass Sie %s und alle zugehörigen Werte für dieses Produkt löschen möchten?');
define('AM_AJAX_PROMPT_REMOVE_OPTION', 'Sind Sie sicher, dass Sie %s von diesem Produkt löschen möchten?');
define('AM_AJAX_PROMPT_STOCK_COMBINATION', 'Sind Sie sicher, dass Sie diese Lager-Kombination von diesem Produkt löschen möchten?');

define('AM_AJAX_PROMPT_LOAD_TEMPLATE', 'Sind Sie sicher, dass Sie das %s Template laden möchten? <br />Dadurch werden alle bestehenden Optionen ersetzt. Dies kann nicht rückgängig gemacht werden.');
define('AM_AJAX_NEW_TEMPLATE_NAME_HEADER', 'Bitte geben Sie einen Namen für das neue Template eingeben. Oder...');
define('AM_AJAX_NEW_NAME', 'Neuer Name:');
define('AM_AJAX_CHOOSE_EXISTING_TEMPLATE_TO_OVERWRITE', ' ...<br /> ... einen Existierenden zum überschreiben auswählen');
define('AM_AJAX_CHOOSE_EXISTING_TEMPLATE_TITLE', 'Existiert:'); 
define('AM_AJAX_RENAME_TEMPLATE_ENTER_NEW_NAME', 'Bitte einen neuen Namen für das Template %s eingeben');
define('AM_AJAX_PROMPT_DELETE_TEMPLATE', 'Sind Sie sicher, dass Sie das Template %s löschen möchten?<br>Dies kann nicht rückgängig gemacht werden!');

//attributeManager.php

define('AM_AJAX_ADDS_ATTRIBUTE_TO_OPTION', 'Fügt das links ausgewählte Attribut zu der Option %s hinzu');
define('AM_AJAX_ADDS_NEW_VALUE_TO_OPTION', 'Fügt einen neuen Wert zu der Option %s hinzu');
define('AM_AJAX_PRODUCT_REMOVES_OPTION_AND_ITS_VALUES', 'Löscht, die Option %1$s und die %2$d Optionswert(e) die nachfolgen, von diesem Produkt');
define('AM_AJAX_CHANGES', 'Ändern'); 
define('AM_AJAX_LOADS_SELECTED_TEMPLATE', 'Lädt die ausgewählte Vorlage');
define('AM_AJAX_SAVES_ATTRIBUTES_AS_A_NEW_TEMPLATE', 'Sichert die aktuellen Attribut als eine neue Vorlage');
define('AM_AJAX_RENAMES_THE_SELECTED_TEMPLATE', 'Benennt die ausgewählte Vorlage um');
define('AM_AJAX_DELETES_THE_SELECTED_TEMPLATE', 'Löscht die ausgewählte Vorlage');
define('AM_AJAX_NAME', 'Name');
define('AM_AJAX_ACTION', 'Aktion');
define('AM_AJAX_PRODUCT_REMOVES_VALUE_FROM_OPTION', 'Löscht %1$s von %2$s, aus diesem Produkt');
define('AM_AJAX_MOVES_VALUE_UP', 'Optionswert nach oben verschieben');
define('AM_AJAX_MOVES_VALUE_DOWN', 'Optionswert nach unten verschieben');
define('AM_AJAX_ADDS_NEW_OPTION', 'Fügt eine neue Option zur Liste hinzu');
define('AM_AJAX_OPTION', 'Option:');
define('AM_AJAX_VALUE', 'Wert:');
define('AM_AJAX_PREFIX', 'Prefix:');
define('AM_AJAX_PRICE', 'Preis:');
define('AM_AJAX_WEIGHT_PREFIX', 'Prefix:');
define('AM_AJAX_WEIGHT', 'Gewicht:');
define('AM_AJAX_SORT', 'Sortieren:');
define('AM_AJAX_ADDS_NEW_OPTION_VALUE', 'Fügt einen neuen Optionswert zur Liste hinzu');
define('AM_AJAX_ADDS_ATTRIBUTE_TO_PRODUCT', 'Fügt das Attribut zum aktuellen Produkt hinzu');
define('AM_AJAX_DELETES_ATTRIBUTE_FROM_PRODUCT', 'Löscht Attribut oder Attributkombination aus diesem Produkt');
define('AM_AJAX_QUANTITY', 'Anzahl');
define('AM_AJAX_PRODUCT_REMOVE_ATTRIBUTE_COMBINATION_AND_STOCK', 'Löscht diese Attribut kombination und löst Lagerbestände von diesem Produkt auf');
define('AM_AJAX_UPDATE_OR_INSERT_ATTRIBUTE_COMBINATIONBY_QUANTITY', 'Aktualisiert oder fügt die Attributkombination mit den angegebenen Eigenschaften hinzu');


//attributeManager.class.php
define('AM_AJAX_TEMPLATES', '-- Vorlagen --');

//----------------------------
// Change: download attributes for AM
//
// author: mytool
//-----------------------------
define('AM_AJAX_FILENAME', 'Datei');
define('AM_AJAX_FILE_DAYS', 'Tage');
define('AM_AJAX_FILE_COUNT', 'Max. Downloads');
define('AM_AJAX_DOWLNOAD_EDIT', 'Download-Option bearbeiten');
define('AM_AJAX_DOWLNOAD_ADD_NEW', 'Download-Option hinzufügen');
define('AM_AJAX_DOWLNOAD_DELETE', 'Download-Option löschen');
define('AM_AJAX_HEADER_DOWLNOAD_ADD_NEW', 'Download-Option hinzufügen für \"%s\"');
define('AM_AJAX_HEADER_DOWLNOAD_EDIT', 'Download-Option für \"%s\" bearbeiten');
define('AM_AJAX_HEADER_DOWLNOAD_DELETE', 'Download-Option für \"%s\" löschen');
define('AM_AJAX_FIRST_SAVE', 'Das Produkt muss gespeichert sein, bevor Optionen hinzugefügt werden können');

//----------------------------
// EOF Change: download attributes for AM
//-----------------------------

define('AM_AJAX_OPTION_NEW_PANEL','Neue Option:');
?>
