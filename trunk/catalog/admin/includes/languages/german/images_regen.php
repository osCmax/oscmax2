<?php
/*
$Id: images_regen.php 1011 2011-01-06 23:38:01Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Produktbildverwaltung');
define('TABLE_HEADING_PRODUCT_ID', 'ID');
define('TABLE_HEADING_PRODUCT_MODEL', 'ArtNr');
define('TABLE_HEADING_PRODUCT_NAME', 'Produkt');
define('TABLE_HEADING_PRODUCT_IMAGE', 'Bildname');
define('TABLE_HEADING_MISSING_PRODUCT_IMAGE', 'Fehlender Bildname');
define('TABLE_HEADING_IMAGE_FOLDER', 'Bildverzeichnis');
define('TABLE_HEADING_ORPHAN_IMAGES', 'Verwaiste Bilder');
define('TABLE_HEADING_FOLDER', 'Verzeichnis');
define('TABLE_HEADING_IMAGE_SIZE', 'Bildgröße');
define('TABLE_HEADING_WIDTH', 'Breite');
define('TABLE_HEADING_HEIGHT', 'Höhe');
define('TABLE_HEADING_JPG', 'JPG');
define('TABLE_HEADING_PNG', 'PNG');
define('TABLE_HEADING_GIF', 'GIF');
define('TABLE_HEADING_UNKNOWN', 'Unbekannt');
define('TABLE_HEADING_TOTAL', 'Gesamt');	   
define('MISSING_IMAGES', 'Fehlende Bilder');
define('ORPHAN_IMAGES', 'Verwaiste Bilder');
define('SUMMARY', 'Zusammenfassung');

define('TABLE_HEADING_L', 'L');
define('TABLE_HEADING_M', 'M');
define('TABLE_HEADING_S', 'S'); 
define('TABLE_HEADING_DL', 'DL');
define('TABLE_HEADING_DM', 'DM');
define('TABLE_HEADING_DS', 'DS');
define('TABLE_HEADING_IMAGE_FILE_SIZE_LG', 'L Kb');
define('TABLE_HEADING_IMAGE_FILE_SIZE_MD', 'M Kb');
define('TABLE_HEADING_IMAGE_FILE_SIZE_SM', 'S Kb');
define('TABLE_HEADING_ACTION', 'Aktion');

define('TEXT_MISSING_IMAGES', 'Fehlende Bilder');
define('TEXT_YOU_HAVE', 'Sie haben ');
define('TEXT_ACCOUNT_FOR', ' in Ihrer Datenbank, die alle gegengeprüft wurden.');
define('TEXT_SUCCESS_1', 'Alle Bilder konnten regeneriert werden von ');
define('TEXT_SUCCESS_2', '  wurden erfolgreich regeneriert.');
define('TEXT_IMAGES_ON_SERVER', ' Bilder auf Ihrem Server einschließlich ');
define('TEXT_DYNAMIC', 'dynamic mopics Bild');
define('TEXT_ACCOUNTED_FOR', ' (zB. _1, _2, usw.) and they are all accounted for.');
define('TEXT_IMAGES_FOR', 'Bilder für ');
define('TEXT_SUC_REGEN', ' erfolgreich regeneriert');
define('TEXT_SMALL_IMAGE', 'Kleines Bild');
define('TEXT_MEDIUM_IMAGE', 'Mittleres Bild');
define('TEXT_LARGE_IMAGE', 'Großes Bild');
define('TEXT_FILE_SIZE', 'Dateigröße');
define('TEXT_MAIN_IMAGE', 'Hauptbild: ');
define('TEXT_SMALL_IMAGE', 'Kleines Bild');
define('TEXT_PRODUCT_IMAGE', 'Produktbilder');
define('TEXT_LARGE_IMAGE', 'Großes Bild');
define('TEXT_MISSING_FROM', 'Es fehlt die Bilddatei von ');
define('TEXT_NO_GENERATE', ' ohne die Sie Ihre Bilder nicht regenerieren können.');
define('TEXT_MOPICS_IMAGE', 'Mopics Bild: ');
define('TEXT_OUT_OF', 'Von ');
define('TEXT_PRODUCTS_YOU_HAVE', ' Produkten fehlen ');
define('TEXT_MISSING_IMAGE', ' Bilder');
define('TEXT_NO_MOPICS', 'Bitte beachten Sie, dass alle Dateien, die die numerische (_1, _2, etc.) Dynamic Mopics Struktur verwenden, nicht in diesem Scan berücksichtigt werden.');
define('TEXT_REGENERATE_ALL', 'Alle Serverbilder regenerieren - bitte bestätigen!');
define('TEXT_INFO_DESCRIPTION', 'Dieser Vorgang regeneriert Produkt- und Thumbnailbilder von den bestehenden Bildern im Verzeichnis "images_big".
		Bestehende Produkt- und Thumbnailsbilder werden überschrieben!<br />');
define('TEXT_INFO_WARNING', '<b>Warnung:</b> Dieser Vorgang ist NICHT der beste Weg, um diese Bilder zu reproduzieren, da es den Server beträchtlich belasten kann.<br />
		Empfehlenswerter ist die Stapelverarbeitung der Bilder auf Ihrem lokalen Rechner.<br />');
define('TEXT_INFO_PROCESSING', '<br>Verarbeitung<br>');
define('TEXT_INFO_COMPLETED', '<br>Abgeschlossen<br>');

define('TEXT_CONFIRM_REGENERATE_ALL', 'Sie möchten alle Ihre Serverbilder regenerieren.  <br><br><b>Note:</b> Alle derzeit in <b>images/' . DYNAMIC_MOPICS_PRODUCTS_DIR . '</b> und <b>images/' . DYNAMIC_MOPICS_THUMBS_DIR . '</b> gespeicherten Bilder werden überschrieben, wenn ein passendes Bild im <b>images/' . DYNAMIC_MOPICS_BIGIMAGES_DIR . '</b> Verzeichnis existiert. <br><br>Bitte beachten Sie, dass dieser Vorgang einen großen Teil der Rechenkapazität Ihres Servers benötigt und daher <b>nur</b> während eines ruhigen Zeitraumes durchgeführt werden sollte.');

define('IMAGE_MISSING_IMAGE', 'Fehlendes Thumbnailbild');

define('IMAGE_REGENERATE_MISSING','Fehlende regenerieren');
define('TEXT_SUCESS_TOTAL', 'Insgesamt regenerierte Bildersets = ');
define('TEXT_REGENERATE_MISSING', 'Fehlende Serverbilder regenerieren - bitte bestätigen!');
define('TEXT_CONFIRM_REGENERATE_MISSING', 'Möchten Sie wirklich alle fehlenden Serverbilder regenerieren?  <br><br><b>Hinweis:</b> Alle Bilder, die derzeit in <b>images/' . DYNAMIC_MOPICS_PRODUCTS_DIR . '</b> und <b>images/' . DYNAMIC_MOPICS_THUMBS_DIR . '</b> gespeichert sind, werden überschrieben werden, falls ein passendes Bild in <b>images/' . DYNAMIC_MOPICS_BIGIMAGES_DIR . '</b> existiert. <br><br>Bitte beachten Sie, dass dieser Vorgang einen großen Teil der Rechenkapazität Ihres Servers benötigt und daher <b>nur</b> während eines ruhigen Zeitraumes durchgeführt werden sollte.');

define('TEXT_DELETE_ORPHANS', 'Verwaiste Bilder löschen');
define('TEXT_CONFIRM_DELETE_ORPHANS', 'Möchten Sie wirklich alle verwaisten Bilder löschen?<br><br>  Dieser Vorgang <b>kann nicht rückgängig gemacht werden</b> und Sie sollten daher <i>unbedingt</i> eine <b>Sicherung Ihrer Daten</b> anlegen, bevor Sie diese Funktion nutzen.');
define('TEXT_ORPHAN_REMOVED', 'verwaiste Bilder entfernt.');

define('TEXT_IMAGE_SIZE', 'Bilder < als verstecken: ');
define('TEXT_FILTER', 'Nach Kategorie filtern: ');
?>