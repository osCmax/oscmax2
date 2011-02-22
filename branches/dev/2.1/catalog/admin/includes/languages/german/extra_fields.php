<?php
/*
$Id: extra_fields.php 1011 2011-01-06 23:38:01Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', "Produkt-Extrafelder");
define('TABLE_HEADING_ID', "ID #");
define('TABLE_HEADING_LABEL', 'Sprache/Bezeichnung');
define('TABLE_HEADING_ORDER', 'Sortierung');
define('TABLE_HEADING_STATUS', 'Katalogstatus');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TEXT_YES', 'Ja');
define('TEXT_NO', 'Nein');
define('BUTTON_NEW', "Neues Extrafeld erstellen");
define('BUTTON_EDIT_VALUES', 'Werteliste bearbeiten');
define('ENTRY_LABEL', 'Bezeichnung: ');
define('ENTRY_ACTIVE', 'Feld ist in dieser Sprache aktiviert: ');
define('ENTRY_ACTIVATE_NOW', 'Feld ist im Katalog sichtbar: ');
define('ENTRY_SHOW_ADMIN', 'Feld wird auf Admin Seite angezeigt, sogar wenn es im Katalog deaktiviert ist: ');
define('ENTRY_ORDER', 'Sortierung: ');
define('ENTRY_VALUE_LIST', 'Benutzt eine Werteliste: ');
define('ENTRY_SEARCH', 'Aktiviere erweiterte Suche für dieses Feld: ');
define('ENTRY_TEXT_ENTRY', 'Texteingabe per: ');
define('TEXT_SINGLE_LINE', 'Einzelzeile');
define('TEXT_MULTILINE', 'Textfeld');
define('TEXT_LIST_IGNORES', ' (wird ignoriert, falls das Feld eine Werteliste verwendet)');
define('TEXT_TEXTAREA_NOTE', 'Hinweis: Textfelder werden möglicherweise nicht in der Produktliste angezeigt.');
define('ENTRY_LISTING', 'Feld in den Produktlisten anzeigen: ');
define('ENTRY_SIZE', 'Maximale Zeichenanzahl im Feld (wird ignoriert, falls eine Werteliste oder ein Textfeld verwendet wird): ');
define('ENTRY_META', 'Feldwert als META keyword für Suchmaschinen verwenden: ');
define('ENTRY_LIST_TYPE', 'Benutzer kann aus der Werteliste auswählen: ');
define('TEXT_SINGLE_VALUE', 'Einzelwert');
define('TEXT_MULTIPLE_VALUE', 'mehrere Werte');
define('ENTRY_CHAIN', 'Zeige Kette der übergeordneten Werte für das Feld (benötigt Einzelwertliste): ');
define('ENTRY_RESTRICT', 'Feld schränkt Produktliste ein (benötigt Einzelwertliste): ');
define('ENTRY_SEARCH_BOX', 'Feld in der Schnellsuchbox verwenden (benötigt Einzelwertliste und erweiterte Suche): ');
define('ENTRY_CHECKBOX', 'Werte auswählen per: ');
define('TEXT_DROPDOWN', 'Pull Down Menü');
define('TEXT_CHECKBOX', 'Check Boxen');
define('TEXT_RADIO', 'Radio Buttons');
define('TEXT_MS_CHECKBOX_NOTE', 'NOTE: Dieser Eintrag betrifft nur Einzelwert-Auswahllisten, die die gewählte Eintragsart aufweisen, ausser in der Schnellsuchbox, wo immer ein Drop Down Menü verwendet wird. Die Mehrfachwerte-Auswahlliste verwendet immer Checkboxen zur Datenauswahl.');
define('ENTRY_COLUMNS', 'Anzahl der Wertspalten für die Check Box bzw. Radio Button Einträge: ');
define('ENTRY_DISPLAY_TYPE', 'Wertliste anzeigen per als: ');
define('TEXT_TEXT', 'Nur Text');
define('TEXT_IMAGE', 'Nur Bild (mit alt Text)');
define('TEXT_IMAGE_TEXT', 'Bild &amp; Text');
define('TEXT_SAMPLE', 'Beispielansicht');
define('ERROR_COLS_OUTOFRANGE', '&nbsp;&nbsp;Die Spaltenanzahl muss zwischen 1 und 255 liegen!');
define('ERROR_OUTOFRANGE', '&nbsp;&nbsp;Die maximale Zeichenanzahl muss zwischen 1 und 255 liegen!');
define('ERROR_ENTRY_REQUIRED', '&nbsp;&nbsp;Eintrag fehlt! ');
define('ERROR_INCOMPATIBLE_MS_SC', '&nbsp;&nbsp;Felder mit einer Mehrfachwert-Auswahlliste können übergeordnete Werte nicht anzeigen!');
define('ERROR_INCOMPATIBLE_TA_PL', '&nbsp;&nbsp;Felder mit einem Textfeld werden in der Produktliste nicht angezeigt!');
define('ERROR_INCOMPATIBLE_MS_RPL', '&nbsp;&nbsp;Felder mit einer Mehrfachwert-Auswahlliste können die Produktlisten nicht einschränken!');
define('ERROR_INCOMPATIBLE_MS_QS', '&nbsp;&nbsp;Felder mit einer Mehrfachwert-Auswahlliste können in erweiterten Suche nicht verwendet werden!');
define('ERROR_AS_REQUIRED', '&nbsp;&nbsp; Dieses Feld wird in der Erweiterten Suche nicht angezeigt, ausser Sie aktivieren die Erweiterte Suche für dieses Feld.');
define('TEXT_APPLIES_LIST_ONLY', 'Die folgenden Einträge werden nur verwendet, wenn eine Werteliste benutzt wird. Ignorieren Sie sie bei Textfeldern.');
define('TEXT_ENABLED', 'Aktiviert');
define('TEXT_DISABLED', 'Deaktiviert');
define('TEXT_SIZE', 'Maximale Größe: ');
define('TEXT_SEARCHABLE', 'Direkt durchsuchbar: ');
define('TEXT_META', 'META Keyword: ');
define('TEXT_USER_SELECTS', 'Kunde kann wählen: ');
define('TEXT_SELECTED_BY', 'Ausgewählt durch: ');
define('TEXT_RESTRICTS', 'Eingeschränkte Produktlisten: ');
define('TEXT_SHOW_PARENTS', 'Übergeordnete Werte anzeigen: ');
define('TEXT_SEARCH_BOX', 'Schnellsuchbox: ');
define('TEXT_COLUMNS', 'Anzahl der Check/Radio Spalten: ');
define('TEXT_DISPLAY_TYPE', 'Wert anzeigen als: ');
define('TEXT_LINKED_TO', 'Verknüpft mit Feld #');
define('HEADING_NEW', 'Neues Feld erstellen');
define('HEADING_EDIT', 'Bestehendes Feld bearbeiten #');
define('ERROR_ACTIVE', '&nbsp;&nbsp;Feld muss für mindestens eine Sprache aktiviert werden!');
define('ERROR_LABEL', '&nbsp;&nbsp;Feldbezeichnung für die aktive Sprache %s darf nicht leer sein');
define('WARNING_TRUNCATE', '&nbsp;&nbsp;Es gehen Daten verloren, wenn Sie die Feldlänge auf diesen Wert reduzieren. Derzeit enthalten %d Produktbeschreibungen Werte, die länger sind! Eine Feldlänge von mindestens %d Zeichen kann im Gegensatz dazu ohne Datenverlust eingestellt werden. Wenn Sie wirklich die Feldlänge reduzieren wollen und den Datenverlust in Kauf nehmen, dann klicken Sie auf Speichern.');
define('WARNING_LANGUAGE_IN_USE', '&nbsp;&nbsp;Dieses Feld enthält derzeit %d Produkte mit Werten in der Sprache %s! Wenn Sie wirklich das Feld in dieser Sprache deaktivieren möchten, dann klicken Sie auf Speichern. Die derzeit eingegebenen Informationen werden nicht gelöscht, können aber auch nicht mehr angezeigt oder geändert werden.');
define('HEADING_DELETE', 'Produkt-Extrafeld löschen #');
define('TEXT_FIELD_DATA', '&nbsp;<b>Bezeichnung:</b> %s <b>Verwendet von:</b> %d Produkten');
define('TEXT_ARE_SURE', 'Sind Sie sicher, dass Sie dieses Feld löschen möchten?');
define('TEXT_VALUES_GONE', ' Alle Werte in der Werteliste dieses Feldes werden ebenfalls gelöscht!');
define('TEXT_LINKS_DESTROYED', ' Wenn dieses Feld mit einem anderen Feld verknüpft ist, werden alle Verknüpfungen der Werte ebenfalls gelöscht, wenn Sie dieses Feld löschen!');
define('TEXT_CONFIRM_DELETE', 'Sind Sie sicher, dass Sie dieses Feld löschen möchten? Alle gespeicherten Daten zu diesem Feld werden gelöscht!');
define('BUTTON_UNLINK', 'Link entfernen');
define('BUTTON_LINK', 'Feld verlinken');
define('BUTTON_CREATE_LINK', 'Link auf ausgewähltes Feld erstellen');
define('HEADING_UNLINK', 'Link auf Feld %d von Feld %d entfernen');
define('TEXT_NUM_LINKED', 'Derzeit sind %d Werte dieses Feldes mit dem anderen Feld verknüpft.');
define('TEXT_SURE_UNLINK', 'Sind Sie sicher, dass sie die Verknüpfung zwischen den beiden Feldern entfernen möchten?');
define('TEXT_LINKS_GONE', ' Alle Verknüpfungen zwischen den Werten der beiden Felder werden entfernt, wenn Sie fortsetzen!');
define('TEXT_CONFIRM_UNLINK', 'Sind Sie sicher, dass Sie die Verknüpfung zwischen den Fehlern entfernen möchten? Die Verknüpfungen aller Werte der beiden Felder wird entfernt, wenn Sie fortsetzen!');
define('ERROR_NO_FIELD', '&nbsp;&nbsp;Zu verknüpfendes Feld nicht gefunden!');
define('TABLE_HEADING_SELECT', 'Wählen Sie');
define('TEXT_SELECT_LINK', ' Wählen Sie ein Feld aus der nachstehenden Liste, um eine Verknüpfung zu erstellen. Gelistete Sprachen mit einem * könnten Werte enthalten, die mit diesem Feld verknüpft sind.');
define('TEXT_NOT_LINKABLE', 'Eine Verknüpfung kann nicht erstellt werden, da in den beiden Feldern keine einzige gemeinsame Srache aktiviert ist.');
define('ERROR_NONE_LINKABLE', '&nbsp;&nbsp;Es wurden keine Felder gefunden, die mit diesem Feld hätten verlinkt werden können!');
define('ERROR_WRONG_TYPE', '&nbsp;&nbsp;Die zu verknüpfenden Felder müssen beide eine Werteliste verwenden!');
define('ERROR_SAME_TYPE', '&nbsp;&nbsp;Ein Feld muss eine Einzelauswahlliste verwenden, währen das zweite eine Mehrfachauswahlliste verwenden muss!');
define('ERROR_ALREADY_LINKED', '&nbsp;&nbsp;Feld %d ist bereist mit einem anderen Feld verknüpft!');
define('TEXT_LINK_SUCCESS', 'Feld %d wurde erfolgreich mit Feld %d verknüpft.');
define('ERROR_NOT_LINKED', 'Dieses Feld ist mit keinem anderen Feld verknüpft!');
define('TEXT_ADMIN_AVAILABLE', 'Verfügbar in Admin: ');

define('HEADING_NO_EPF', 'Produkt-Extrafelder');
define('TEXT_NO_EPF', 'Sie haben derzeit keine Extrafelder erstellt.<br><br>Bitte klicken Sie auf <b>Einfügen</b>, um ein neues Feld zu erstellen.');
?>