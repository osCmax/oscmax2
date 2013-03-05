<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
define('TOP_BAR_TITLE', 'Catalog Imprimable');
//define('HEADING_TITLE', '<table border="0" width="100%" cellspacing="3" cellpadding="3"><tr><td width="30%" class="pageHeading"><h5>' . STORE_NAME_ADDRESS . '</h5></td><td width="70%"><h6><u>Note</U>:<br> All prices are subject to change without notice. All products will be billed in Canadian Currency only. The Currency feature is just for your convenience. This catalog is current on the day of printing.</h6></td></tr></table>');
define('HEADING_TITLE', '<h6>'.STORE_NAME.'<br>'.nl2br(STORE_NAME_ADDRESS).'<br>Email: <a href="mailto:'.STORE_OWNER_EMAIL_ADDRESS.'">'.STORE_OWNER_EMAIL_ADDRESS.'</a><br>Important: Tous les prix indiqu&eacute;s peuvent varier selon les conditions &eacute;conomiques à la commande. Tous les produits sont affich&eacute;s dans notre devise € .<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Les prix indiqu&eacute;s correspondent à ceux de notre site web. Ils sont automatiquement mis à jour à chauqe fois que vous g&eacute;n&eacute;rez le catalogue imprimable.</h6>');
// comment the above line and uncomment out the line above it if you have an older OSC Release before Nov1 2002
define('TABLE_HEADING_IMAGES', 'Image');
define('TABLE_HEADING_MANUFACTURERS', 'Constructeur');
define('TABLE_HEADING_PRODUCTS', 'Nom');
define('TABLE_HEADING_DESCRIPTION', 'Description');
define('TABLE_HEADING_OPTIONS','Options');
define('TABLE_HEADING_CATEGORIES', 'Cat&eacute;gories');
define('TABLE_HEADING_MODEL', 'Mod&egrave;le');
define('TABLE_HEADING_UPC', 'UPC');
define('TABLE_HEADING_QUANTITY', 'Quantit&eacute;');
define('TABLE_HEADING_WEIGHT', 'Poids');
define('TABLE_HEADING_PRICE', 'Prix');
define('BOX_STATS_PRODUCTS_WITH_IMAGES', 'Catalogue Imprimable');
define('FONT_STYLE_TOP_BAR', 'Catalogue Imprimable');
define('NAVBAR_TITLE', 'Catalogue Imprimable');
define('TABLE_HEADING_DATE','Mis en ligne'); 
define('BOX_CATALOG_NEXT', 'Suivant');
define('BOX_CATALOG_PREV', 'Pr&eacute;c&eacute;dent');
?>
