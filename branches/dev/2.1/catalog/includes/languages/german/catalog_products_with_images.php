<?php
/*
  $Id: catalog_products_with_images.php V 3.4
  by Tom St.Croix <managememt@betterthannature.com> V 3.4

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax2005 osCMax, 2002 osCommerce

  Released under the GNU General Public License
*/

define('TOP_BAR_TITLE', 'Druckbare Artikelübersicht');
//define('HEADING_TITLE', '<table border="0" width="100%" cellspacing="3" cellpadding="3"><tr><td width="30%" class="pageHeading"><h5>' . STORE_NAME_ADDRESS . '</h5></td><td width="70%"><h6><u>Note</U>:<br> All prices are subject to change without notice. All products will be billed in Canadian Currency only. The Currency feature is just for your convenience. This catalog is current on the day of printing.</h6></td></tr></table>');
define('HEADING_TITLE', '<h6>'.STORE_NAME.'<br>'.nl2br(STORE_NAME_ADDRESS).'<br>Email: <a href="mailto:'.STORE_OWNER_EMAIL_ADDRESS.'">'.STORE_OWNER_EMAIL_ADDRESS.'</a><br>Hinweis: Alle Preise ohne Gewähr. <br>Diese Übersicht ist nur gültig am Tag des Ausdrucks.</h6>');
// comment the above line and uncomment out the line above it if you have an older OSC Release before Nov1 2002
// kommentieren die oben genannte Linie und das uncomment aus der Linie über ihr, wenn Sie eine ältere OSZILLATOR-Freigabe vor Nov1 2002 haben
define('TABLE_HEADING_IMAGES', 'Bild');
define('TABLE_HEADING_MANUFACTURERS', 'Hersteller');
define('TABLE_HEADING_PRODUCTS', 'Name');
define('TABLE_HEADING_DESCRIPTION', 'Beschreibung');
define('TABLE_HEADING_OPTIONS','Optionen');
define('TABLE_HEADING_CATEGORIES', 'Kategorie');
define('TABLE_HEADING_MODEL', 'Modell');
define('TABLE_HEADING_UPC', 'UPC');
define('TABLE_HEADING_QUANTITY', 'Menge');
define('TABLE_HEADING_WEIGHT', 'Gewicht');
define('TABLE_HEADING_PRICE', 'Preis');
define('BOX_STATS_PRODUCTS_WITH_IMAGES', 'Druckbare Artikelübersicht');
define('FONT_STYLE_TOP_BAR', 'Druckbare Artikelübersicht');
define('NAVBAR_TITLE', 'Druckbare Artikelübersicht');
define('TABLE_HEADING_DATE','Hinzugefügt am '); 
define('BOX_CATALOG_NEXT', 'weiter');
define('BOX_CATALOG_PREV', 'zurück');
?>
