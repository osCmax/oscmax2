<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('TOP_BAR_TITLE', 'Catálogo imprimible');
//define('HEADING_TITLE', '<table border="0" width="100%" cellspacing="3" cellpadding="3"><tr><td width="30%" class="pageHeading"><h5>' . STORE_NAME_ADDRESS . '</h5></td><td width="70%"><h6><u>Nota</U>:<br> Todos los precios están sujetos a cambio sin previo aviso.  Todos los productos serán facturados en moneda canadiense sólamente.  La funcionalidad de moneda está simplemente por su comodidad.  Este catálogo está actualizado al día de la impresión.</h6></td></tr></table>');
define('HEADING_TITLE', '<h6>'.STORE_NAME.'<br>'.nl2br(STORE_NAME_ADDRESS).'<br>Email: <a href="mailto:'.STORE_OWNER_EMAIL_ADDRESS.'">'.STORE_OWNER_EMAIL_ADDRESS.'</a><br>Nota: Todos los precios están sujetos a cambio sin previo aviso. Todos los productos serán facturados con la moneda de nuestra tienda sólamente.<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;La funcionalidad de moneda está simplemente por su comodidad.  Este catálogo está actualizado al día de la impresión.</h6>');
// comment the above line and uncomment out the line above it if you have an older OSC Release before Nov1 2002
// comenta la línea anterior y quita el comentario de la línea sobre ella si tienes una versión de OSC de antes de Nov1 2002
define('TABLE_HEADING_IMAGES', 'Imagen');
define('TABLE_HEADING_MANUFACTURERS', 'Fabricante');
define('TABLE_HEADING_PRODUCTS', 'Nombre');
define('TABLE_HEADING_DESCRIPTION', 'Descripción');
define('TABLE_HEADING_OPTIONS','Opciones');
define('TABLE_HEADING_CATEGORIES', 'Categoría');
define('TABLE_HEADING_MODEL', 'Modelo');
define('TABLE_HEADING_UPC', 'UPC');
define('TABLE_HEADING_QUANTITY', 'Cantidad');
define('TABLE_HEADING_WEIGHT', 'Peso');
define('TABLE_HEADING_PRICE', 'Precio');
define('BOX_STATS_PRODUCTS_WITH_IMAGES', 'Catálogo imprimible');
define('FONT_STYLE_TOP_BAR', 'Catálogo imprimible');
define('NAVBAR_TITLE', 'Catálogo imprimible');
define('TABLE_HEADING_DATE','Fecha en que se añadió'); 
define('BOX_CATALOG_NEXT', 'Siguiente');
define('BOX_CATALOG_PREV', 'Anterior');
?>
