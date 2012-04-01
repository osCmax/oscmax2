<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/


define('HEADER_TITLE', 'Infoboxen anzeigen, aktualisieren und erstellen');
define('TABLE_HEADING_CONFIGURATION_TITLE', 'Titel');
define('TABLE_HEADING_CONFIGURATION_VALUE', 'Dateiname');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Aktion');
define('TABLE_HEADING_COLUMN', 'Spalte');
define('TABLE_HEADING_SORT_ORDER', 'Position');

define('TEXT_INFO_EDIT_INTRO', 'Führen Sie die gewünschten Änderungen durch.');
define('TEXT_INFO_DATE_ADDED', 'Hinzugefügt am:');
define('TEXT_INFO_LAST_MODIFIED', 'Zuletzt geändert am:');
define('TEXT_INFO_HEADING_NEW_INFOBOX', 'Neue Infobox hinzufügen');
define('TEXT_INFO_INSERT_INTRO', 'Ein Beispiel für eine<b> what\'s_new.php</b> Infobox wird angezeigt.');
define('TEXT_INFO_DELETE_INTRO', '<p style="color: red; font-weight: bold;">Confirm OK to delete the Infobox</p>');
define('TEXT_INFO_HEADING_DELETE_INFOBOX', 'Infobox löschen?');

define('IMAGE_INFOBOX_STATUS_GREEN', 'Links');
define('IMAGE_INFOBOX_STATUS_GREEN_LIGHT', 'Nach links verschieben');
define('IMAGE_INFOBOX_STATUS_RED', 'Rechts');
define('IMAGE_INFOBOX_STATUS_RED_LIGHT', 'Nach rechts verschieben');
define('BOX_HEADING_BOXES', 'Boxenverwaltung');

define('TEXT_INFOBOX_FILENAME', 'Dateiname');
define('TEXT_INFOBOX_DEFINE_KEY', 'Definiere Schlüssel');
define('TEXT_INFOBOX_COLUMN', 'Spalte (left/right)');
define('TEXT_INFOBOX_POSITION', 'Position');
define('TEXT_INFOBOX_ACTIVE', 'Box aktivieren?'); 


define('TEXT_HELP_HEADING_NEW_INFOBOX', 'Infobox Hilfe');

define('TEXT_INFOBOX_HELP_FILENAME', 'Muss dem Namen der Boxdatei entsprechen, die Sie im <u>catalog/includes/boxes</u>-Ordner angelegt haben.<br><br> Er muss in Kleinbuchstaben geschrieben sein. Leerzeichen statt Unterstriche (_) sind zulässig und dürfen \'s enthalten, da sie vom System entfernt werden.<br><br>Beispiel Eins:<br>Ihre neue Infobox heißt <b>neue_box.php</b>, Sie können hier <b>neue box</b> eingeben. <br><br>Beispiel Zwei: Die <b>whats_new</b> Box heißt <b>whats_new.php </b>. Sie können hier <b>what\'s new</b> eingeben.');

define('TEXT_INFOBOX_HELP_HEADING', 'Dies ist der Titel Ihrer Infobox im Catalog.');

define('TEXT_INFOBOX_HELP_DEFINE', 'Beispiel: <b>BOX_HEADING_WHATS_NEW</b>.  <br><br>Wird von den Sprachdateien verwendet, um die richtige Übersetzung der erstellten Infobx-Überschrift zu liefern.  <br><br>Wenn Sie das definieren möchten, sehen Sie sich bitte die Sprachdatei für diese Infobox an.');

define('TEXT_INFOBOX_HELP_COLUMN', 'Geben Sie <b>left</b>(Links) oder <b>right</b>(Rechts) an.');

define('TEXT_INFOBOX_HELP_POSITION', 'Geben Sie eine beliebige Zahl an. Höhere Zahlen führen zu einer Positionierung weiter unten<br><br> Bei gleichen Zahlen werden die Infoboxen alphabetisch gereiht.');

define('TEXT_INFOBOX_HELP_ACTIVE', 'Wählen Sie <b>yes</b>(Ja) oder <b>no</b>(Nein). <br><br><b>yes</b> macht die Infobox sichtbar, <b>no</b> unsichtbar.');

define('TEXT_CLOSE_WINDOW', '<u>Fenster schließen</u> [x]');

define('COUNT_1', 'Es befinden sich derzeit ');
define('COUNT_2', ' Boxen in der linken Spalte und ');
define('COUNT_3', ' Boxes in der rechten Spalte.');

?>