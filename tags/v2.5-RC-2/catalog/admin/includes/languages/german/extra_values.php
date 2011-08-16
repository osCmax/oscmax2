<?php
/*
$Id: extra_values.php 1011 2011-01-06 23:38:01Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Werteverwaltung für Produkt-Extrafelder');
define('TABLE_HEADING_ID', 'ID #');
define('TABLE_HEADING_ORDER', 'Sortierung');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_PARENT', 'Übergeordnete ID#');
define('TABLE_HEADING_VALUE', 'Wert');
define('TABLE_HEADING_IMAGE', 'Bild');
define('TABLE_HEADING_REQUIRED', 'Erforderliche ID#');
define('TABLE_HEADING_EXCLUDES', 'Ausgeschlossene ID#s');
define('TABLE_HEADING_LINKED', 'Verknüpfte ID#s');
define('TEXT_FIELD_ID', 'Wert für Produkt-Extrafeld ID #');
define('TEXT_LANGAUGE', 'Sprache: ');
define('BUTTON_SUBVALUE', 'Unterwert zu diesem Wert hinzugfügen');
define('BUTTON_NEW', "Wert zu diesem Feld/dieser Sprache hinzufügen");
define('TEXT_SELECT_FIELD', 'Sprache/Wert aus der Dropdown Liste auswählen');
define('ERROR_NO_LIST_FIELDS', '&nbsp;&nbsp;Es sind keine Extrafelder definiert, die mit einer Werteliste benutzt werden können!');
define('ERROR_NO_LIST_FIELDS2', 'Klicken Sie <u>hier</u>, um welche zu definieren');
define('HEADING_NEW', 'Neuen Wert erstellen für ');
define('HEADING_EDIT', 'Bearbeite Wert #');
define('ENTRY_ORDER', 'Sortierung: ');
define('ENTRY_VALUE', 'Wert: ');
define('ENTRY_IMAGE', 'Optionales Bild: ');
define('ERROR_VALUE', 'Wert darf nicht leer sein!');
define('TEXT_PREVIEW', 'Der Feldeintrag für diese Werteliste sieht so aus: ');
define('TEXT_CHAIN', 'Wertekette: ');
define('HEADING_DELETE', 'Lösche Wert ID #');
define('TEXT_FIELD_DATA', 'Dieser Wert in der Sprache: %s Feldbezeichnung: %s oder einer seiner Unterwerte wird von  %d Produkten verwendet.');
define('TEXT_YES', 'Ja');
define('TEXT_NO', 'Nein');
define('TEXT_ARE_SURE', 'Sind Sie sicher, dass Sie diesen Wert löschen möchten?');
define('TEXT_VALUES_GONE', ' Alle Unterwerte dieses Wertes werden ebenfalls gelöscht!');
define('TEXT_CONFIRM_DELETE', 'Sind Sie sicher, dass Sie diesen Wert löschen möchten? Dieser Wert bzw. einer seiner Unterwerte wird von allen Produkten entfernt!');
define('WARNING_VALUE_USED', '&nbsp;&nbsp;Dieser Wert wird von %d Produkten verwendet. Eine Änderung des Wertes könnte unerwünschte Änderungen im Online-Katalog verursachen. Änderungen in der Sortierung sind davon nicht betroffen.');
define('ERROR_FILENAME_USED', '&nbsp;&nbsp;Der Name der geladenen Datei wird bereits von einem anderen Extrafeld-Wert verwendet.!');
define('TEXT_FIELD_LINKS', 'Dieser Wert für die Sprache: %s Feldbezeichnung: %s oder einer seiner Unterwerte ist mit %d Werten des verknüpften Feldes ID #%d verknüpft.');
define('ENTRY_VALUE_REQUIREMENT', 'Um diesen Wert zu benutzen, ist der folgende Wert des verknüpften Feldes (oder eines Untewertes) erforderlich:');
define('ENTRY_NO_VALUE_REQUIRED', 'kein bestimmter Wert erforderlich');
define('TEXT_REQUIRES', 'Wert des verknüpften Feldes erforderlich, um diesen Wert zu benutzen:');
define('ENTRY_EXCLUDES', 'Haken Sie jene Werte an, die nicht zur selben Zeit wie dieser Wert ausgewählt werden:');
define('TEXT_ALWAYS_AVAILABLE', 'The following values will be available during product entry for any value of linked field ID #');
define('TEXT_AVAILABLE_REQUIRED', 'The following values will be available during product entry only if one of the following values of linked field ID <b>#%s</b> is chosen: ');
?>