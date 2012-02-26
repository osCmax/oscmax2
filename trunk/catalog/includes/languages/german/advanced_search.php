<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE_1', 'Erweiterte Suche');
define('NAVBAR_TITLE_2', 'Suchergebnisse');

define('HEADING_TITLE_1', 'Erweiterte Suche');
define('HEADING_TITLE_2', 'Diese Produkte beinhalten Ihre Suchbegriffe:');

define('HEADING_SEARCH_CRITERIA', 'Suchbegriffe:');

define('TEXT_SEARCH_IN_DESCRIPTION', 'Produktbeschreibungen in die Suche einschließen');
define('ENTRY_CATEGORIES', 'Kategorien:');
define('ENTRY_INCLUDE_SUBCATEGORIES', 'Unterkategorien in die Suche einschließen');
define('ENTRY_MANUFACTURERS', 'Hersteller:');
define('ENTRY_PRICE_FROM', 'Mindestpreis:');
define('ENTRY_PRICE_TO', 'Höchstpreis:');
define('ENTRY_DATE_FROM', 'Hinzugefügt ab:');
define('ENTRY_DATE_TO', 'Hinzugefügt bis:');

define('TEXT_SEARCH_HELP_LINK', '<u>Hilfe zur erweiterten Suche</u> [?]');

define('TEXT_ALL_CATEGORIES', 'Alle Kategorien');
define('TEXT_ALL_MANUFACTURERS', 'Alle Hersteller');

define('HEADING_SEARCH_HELP', 'Hilfe zur erweiterten Suche');
define('TEXT_SEARCH_HELP', 'Sie haben die Möglichkeit, bei Suchbegriffen logische Operatoren wie "AND" (und) bzw. "OR" (oder) zu verwenden.<br><br>Beispielsweise könnten Sie also angeben: <u>Microsoft AND Maus</u>.<br><br>Zusätzlich können Sie Klammern verwenden, um die Suche zu verschachteln, wie zum Beispiel:<br><br><u>Microsoft AND (Maus OR Tastatur OR "Visual Basic")</u>.<br><br>Mit Anführungszeichen können Sie mehrere Worte zu einem Suchbegriff zusammenfassen.');
define('TEXT_CLOSE_WINDOW', '<u>Fenster schliessen</u> [x]');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', 'Artikelnummer');
define('TABLE_HEADING_PRODUCTS', 'Produktbezeichnung');
define('TABLE_HEADING_MANUFACTURER', 'Hersteller');
define('TABLE_HEADING_QUANTITY', 'Anzahl');
define('TABLE_HEADING_PRICE', 'Preis');
define('TABLE_HEADING_WEIGHT', 'Gewicht');
define('TABLE_HEADING_BUY_NOW', 'Jetzt kaufen');

define('TEXT_NO_PRODUCTS', 'Es wurde leider kein Produkt gefunden, das Ihren Suchbegriffen entspricht.');

define('ERROR_AT_LEAST_ONE_INPUT', 'Mindestens ein Feld des Suchformulars muss ausgefüllt werden.');
define('ERROR_INVALID_FROM_DATE', 'Unzulässiges Datum: Hinzugefügt ab');
define('ERROR_INVALID_TO_DATE', 'Unzulässiges Datum: Hinzugefügt bis');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', 'Das Datum <b>Hinzugefügt bis</b> darf nicht vor <b>Hinzugefügt ab</b> liegen.');
define('ERROR_PRICE_FROM_MUST_BE_NUM', 'Mindestpreis muss eine Zahl sein.');
define('ERROR_PRICE_TO_MUST_BE_NUM', 'Höchstpreis muss eine Zahl sein.');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', 'Der Höchstpreis darf nicht kleiner als der Mindestpreis sein.');
define('ERROR_INVALID_KEYWORDS', 'Suchbegriff unzulässig');

define('TEXT_OPTIONAL', 'Die nachstehenden Suchfilter sind optional. Wenn Sie oben keinen Suchbegriff angeben, muß jedoch mindestens ein Feld ausgefüllt werden.');
define('TEXT_FOR_FIELD','Für dieses Feld passen');
define('TEXT_MATCH_ANY','JEDER ausgewählte Wert oder');
define('TEXT_MATCH_ALL','ALLE ausgewählten Werte');
?>