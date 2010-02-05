<?php
/*
  $Id: catalog_products_with_images.php V 3.0

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/
define('TOP_BAR_TITLE', 'Catalog Imprimable');
//define('HEADING_TITLE', '<table border="0" width="100%" cellspacing="3" cellpadding="3"><tr><td width="30%" class="pageHeading"><h5>' . STORE_NAME_ADDRESS . '</h5></td><td width="70%"><h6><u>Note</U>:<br> All prices are subject to change without notice. All products will be billed in Canadian Currency only. The Currency feature is just for your convenience. This catalog is current on the day of printing.</h6></td></tr></table>');
define('HEADING_TITLE', '<h6>'.STORE_NAME.'<br>'.nl2br(STORE_NAME_ADDRESS).'<br>Email: <a href="mailto:'.STORE_OWNER_EMAIL_ADDRESS.'">'.STORE_OWNER_EMAIL_ADDRESS.'</a><br>Important: Tous les prix indiqués peuvent varier selon les conditions économiques à la commande. Tous les produits sont affichés dans notre devise € .<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Les prix indiqués correspondent à ceux de notre site web. Ils sont automatiquement mis à jour à chauqe fois que vous générez le catalogue imprimable.</h6>');
// comment the above line and uncomment out the line above it if you have an older OSC Release before Nov1 2002
define('TABLE_HEADING_IMAGES', 'Image');
define('TABLE_HEADING_MANUFACTURERS', 'Constructeur');
define('TABLE_HEADING_PRODUCTS', 'Nom');
define('TABLE_HEADING_DESCRIPTION', 'Description');
define('TABLE_HEADING_OPTIONS','Options');
define('TABLE_HEADING_CATEGORIES', 'Catégories');
define('TABLE_HEADING_MODEL', 'Modèle');
define('TABLE_HEADING_UPC', 'UPC');
define('TABLE_HEADING_QUANTITY', 'Quantité');
define('TABLE_HEADING_WEIGHT', 'Poids');
define('TABLE_HEADING_PRICE', 'Prix');
define('BOX_STATS_PRODUCTS_WITH_IMAGES', 'Catalogue Imprimable');
define('FONT_STYLE_TOP_BAR', 'Catalogue Imprimable');
define('NAVBAR_TITLE', 'Catalogue Imprimable');
define('TABLE_HEADING_DATE','Mis en ligne'); 
define('BOX_CATALOG_NEXT', 'Suivant');
define('BOX_CATALOG_PREV', 'Précédent');
?>
