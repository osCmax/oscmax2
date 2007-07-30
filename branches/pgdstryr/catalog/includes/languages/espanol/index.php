<?php
/*
$Id: index.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2006 osCMax

  Released under the GNU General Public License
*/

define('TEXT_MAIN', 'Esto es un sistema de falta del proyecto de osCommerce, los productos mostrados son para objetivos de demonstrational, <b> cualquier producto comprado no será entregado ni va al cliente ser facturado </b>. Cualquier información vista sobre estos productos debe ser tratada como ficticio.<br><br><table border="0" width="100%" cellspacing="5" cellpadding="2"><tr><td class="main" valign="top">' . tep_image(DIR_WS_IMAGES . 'default/1.gif') . '</td><td class="main" valign="top"><b>Error Messages</b><br><br>Si hay cualquier error o advertencia de mensajes mostrados encima, por favor corríjalos primero antes del proceder.<br><br>Los mensajes de error son mostrados en la cima misma de la página con un completo <span class="messageStackError">background</span> color.<br><br>Several checks are performed to ensure a healthy setup of your online store - these checks can be disabled by editing the appropriate parameters at the bottom of the includes/application_top.php file.</td></tr><td class="main" valign="top">' . tep_image(DIR_WS_IMAGES . 'default/2.gif') . '</td><td class="main" valign="top"><b>Editing Page Texts</b><br><br>The text shown here can be modified in the following file, on each language basis:<br><br><nobr class="messageStackSuccess">[path to catalog]/includes/languages/' . $language . '/' . FILENAME_DEFAULT . '</nobr><br><br>That file can be edited manually, or via the Administration Tool with the <nobr class="messageStackSuccess">Languages->' . ucfirst($language) . '->Define</nobr> or <nobr class="messageStackSuccess">Tools->File Manager</nobr> modules.<br><br>The text is set in the following manner:<br><br><nobr>define(\'TEXT_MAIN\', \'<span class="messageStackSuccess">This is a default setup of the osCommerce project...</span>\');</nobr><br><br>The text highlighted in green may be modified - it is important to keep the define() of the TEXT_MAIN keyword. To remove the text for TEXT_MAIN completely, the following example is used where only two single quote characters exist:<br><br><nobr>define(\'TEXT_MAIN\', \'\');</nobr><br><br>More information concerning the PHP define() function can be read <a href="http://www.php.net/define" target="_blank"><u>here</u></a>.</td></tr><tr><td class="main" valign="top">' . tep_image(DIR_WS_IMAGES . 'default/3.gif') . '</td><td class="main" valign="top"><b>Securing The Administration Tool</b><br><br>It is important to secure the Administration Tool as there is currently no security implementation available.</td></tr><tr><td class="main" valign="top">' . tep_image(DIR_WS_IMAGES . 'default/4.gif') . '</td><td class="main" valign="top"><b>Online Documentation</b><br><br>Online documentation can be read at the <a href="http://wiki.oscommerce.com" target="_blank"><u>osCommerce Wiki Documentation Effort</u></a> site.<br><br>Community support is available at the <a href="http://forums.oscommerce.com" target="_blank"><u>osCommerce Community Support Forums</u></a> site.</td></tr></table><br>If you wish to download the solution powering this shop, or if you wish to contribute to the osCommerce project, please visit the <a href="http://oscdox.com" target="_blank"><u>support site of osCommerce</u></a>. This shop is running on osCommerce version <font color="#f0000"><b>' . PROJECT_VERSION . '</b></font>.');
define('TABLE_HEADING_NEW_PRODUCTS', 'Nuevos Productos para %s');
define('TABLE_HEADING_UPCOMING_PRODUCTS', 'Próximos Productos');
define('TABLE_HEADING_DATE_EXPECTED', 'Fecha de Expedición');
// LINE ADDED: MOD - default specials
define('TABLE_HEADING_DEFAULT_SPECIALS', 'Especiales para %s');

if ( ($category_depth == 'products') || (isset($HTTP_GET_VARS['manufacturers_id'])) ) {
  define('HEADING_TITLE', 'Vea lo que tenemos aquí');
  define('TABLE_HEADING_IMAGE', '');
  define('TABLE_HEADING_MODEL', 'Modelo');
  define('TABLE_HEADING_PRODUCTS', 'Nombre del Producto');
  define('TABLE_HEADING_MANUFACTURER', 'Manofactura');
  define('TABLE_HEADING_QUANTITY', 'Cantidad');
  define('TABLE_HEADING_PRICE', 'Precio');
  define('TABLE_HEADING_WEIGHT', 'Peso');
  define('TABLE_HEADING_BUY_NOW', 'Comprar Ahora');
  define('TEXT_NO_PRODUCTS', 'No hay productos para listar en esta categoría.');
  define('TEXT_NO_PRODUCTS2', 'No hay productos para listar en esta categoría.');
  define('TEXT_NUMBER_OF_PRODUCTS', 'Número de Productos: ');
  define('TEXT_SHOW', '<b>Mostrar:</b>');
  define('TEXT_BUY', 'Comprar 1 \'');
  define('TEXT_NOW', '\' Ahora');
  define('TEXT_ALL_CATEGORIES', 'Todas las Categorias');
  define('TEXT_ALL_MANUFACTURERS', 'Todas las Manofacturas');
} elseif ($category_depth == 'top') {
  define('HEADING_TITLE', 'Bienvenidos a AABox.com\'s MS2-MAX');
} elseif ($category_depth == 'nested') {
  define('HEADING_TITLE', 'Categoría');
}
?>
