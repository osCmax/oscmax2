<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax
  
  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Cat&eacute;gories / Produits');
define('HEADING_TITLE_SEARCH', 'Rechercher:');
define('HEADING_TITLE_GOTO', 'Aller &aacute;:');

define('TABLE_HEADING_ID', 'ID');
define('TABLE_HEADING_CATEGORIES_PRODUCTS', 'Cat&eacute;gories / Produits');
define('TABLE_HEADING_MODEL_NUMBER', 'Mod&egrave;le');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_STATUS', 'Statut');

define('TEXT_NEW_PRODUCT', 'Nouveau Produit dans &quot;%s&quot;');
define('TEXT_CATEGORIES', 'Cat&eacute;gories:');
define('TEXT_SUBCATEGORIES', 'Sous-cat&eacute;gories:');
define('TEXT_PRODUCTS', 'Produits:');
define('TEXT_PRODUCTS_PRICE_INFO', 'Prix:');
define('TEXT_PRODUCTS_TAX_CLASS', 'Classe Fiscale:');
define('TEXT_PRODUCTS_AVERAGE_RATING', 'Ratio moyen:');
define('TEXT_PRODUCTS_QUANTITY_INFO', 'Quantit&eacute;:');
define('TEXT_DATE_ADDED', 'Date d\'ajout:');
define('TEXT_DATE_AVAILABLE', 'Date disponibilit&eacute;:');
define('TEXT_LAST_MODIFIED', 'Derni&egrave;re modification:');
define('TEXT_IMAGE_NONEXISTENT', 'L\'IMAGE N\'EXISTE PAS');
define('TEXT_NO_CHILD_CATEGORIES_OR_PRODUCTS', 'Merci de cr&eacute;er une nouvelle catégorie ou un produit dans ce niveau.');
define('TEXT_PRODUCT_MORE_INFORMATION', 'Pour plus d\'information, merci de visiter cette <a href="http://%s" target="blank"><u>page web</u></a> de produits.');
define('TEXT_PRODUCT_DATE_ADDED', 'Ce produit a &eacute;t&eacute; ajout&eacute; &agrave; notre catalogue le %s.');
define('TEXT_PRODUCT_DATE_AVAILABLE', 'Ce produit sera en stock le %s.');

define('TEXT_EDIT_INTRO', 'Merci de effectuer tous les changements necessaires');
define('TEXT_EDIT_CATEGORIES_ID', 'ID de la cat&eacute;gorie:');
define('TEXT_EDIT_CATEGORIES_NAME', 'Nom de la cat&eacute;gorie:');
define('TEXT_EDIT_CATEGORIES_IMAGE', 'Image de la cat&eacute;gorie:');
define('TEXT_EDIT_SORT_ORDER', 'Ordre de tri:');

define('TEXT_INFO_COPY_TO_INTRO', 'Veuillez choisir une nouvelle cat&eacute;gorie dans laquelle vous voulez copier ce produit');
define('TEXT_INFO_CURRENT_CATEGORIES', 'Cat&eacute;gories courantes:');

define('TEXT_INFO_HEADING_NEW_CATEGORY', 'Nouvelle cat&eacute;gorie');
define('TEXT_INFO_HEADING_EDIT_CATEGORY', 'Editer cat&eacute;gorie');
define('TEXT_INFO_HEADING_DELETE_CATEGORY', 'Supprimer cat&eacute;gorie');
define('TEXT_INFO_HEADING_MOVE_CATEGORY', 'D&eacute;placer cat&eacute;gorie');
define('TEXT_INFO_HEADING_DELETE_PRODUCT', 'Supprimer produit');
define('TEXT_INFO_HEADING_MOVE_PRODUCT', 'D&eacute;placer produit');
define('TEXT_INFO_HEADING_COPY_TO', 'Copier vers');

define('TEXT_DELETE_CATEGORY_INTRO', 'Etes vous sur de vouloir supprimer cette cat&eacute;gorie?');
define('TEXT_DELETE_PRODUCT_INTRO', 'Etes vous sur de vouloir supprimer d&eacute;finitivement ce produit?');

define('TEXT_DELETE_WARNING_CHILDS', '<b>ATTENTION:</b> Il y a %s (sous-)cat&eacute;gories li&eacute;es &aacute; cette cat&eacute;gorie!');
define('TEXT_DELETE_WARNING_PRODUCTS', '<b>ATTENTION:</b> Il y a %s produits li&eacute;es &aacute; cette cat&eacute;gorie!');

define('TEXT_MOVE_PRODUCTS_INTRO', 'Merci de s&eacute;lectionner la cat&eacute;gorie ou vous voudriez que <b>%s</b> soit plac&eacute;');
define('TEXT_MOVE_CATEGORIES_INTRO', 'Merci de s&eacute;lectionner la cat&eacute;gorie ou vous voudriez que <b>%s</b> soit plac&eacute;');
define('TEXT_MOVE', 'D&eacute;placer <b>%s</b> vers:');

define('TEXT_NEW_CATEGORY_INTRO', 'Merci de compl&eacute;ter les informations suivantes pour la nouvelle cat&eacute;gorie');
define('TEXT_CATEGORIES_NAME', 'Nom de la cat&eacute;gorie:');
define('TEXT_CATEGORIES_IMAGE', 'Image de la cat&eacute;gorie:');
define('TEXT_SORT_ORDER', 'Ordre de tri:');

define('TEXT_PRODUCTS_STATUS', 'Statut des produits:');
define('TEXT_PRODUCTS_DATE_AVAILABLE', 'Date de disponibilit&eacute;:');
define('TEXT_PRODUCT_AVAILABLE', 'En stock');
define('TEXT_PRODUCT_NOT_AVAILABLE', 'Hors stock');
define('TEXT_PRODUCTS_MANUFACTURER', 'Fabriquant du produit:');
define('TEXT_PRODUCTS_NAME', 'Nom du produit:');
define('TEXT_PRODUCTS_DESCRIPTION', 'Description du produit:');
define('TEXT_PRODUCTS_QUANTITY', 'Quantit&eacute; de produit:');
define('TEXT_PRODUCTS_MODEL', 'Mod&egrave;le du produit:');
define('TEXT_PRODUCTS_IMAGE', 'Image du produit:');
define('TEXT_PRODUCTS_URL', 'URL du produit:');
define('TEXT_PRODUCTS_URL_WITHOUT_HTTP', '<small>(sans http://)</small>');
define('TEXT_PRODUCTS_PRICE_NET', 'Prix du produit (TTC):');
define('TEXT_PRODUCTS_PRICE_GROSS', 'Prix du produit (HT):');
define('TEXT_PRODUCTS_WEIGHT', 'Poids du produit:');

define('EMPTY_CATEGORY', 'Cat&eacute;gorie vide');

define('TEXT_HOW_TO_COPY', 'M&eacute;thode de copie:');
define('TEXT_COPY_AS_LINK', 'Lien produit');
define('TEXT_COPY_AS_DUPLICATE', 'Dupliquer produit');

define('ERROR_CANNOT_LINK_TO_SAME_CATEGORY', 'Erreur: Impossible de lier des produits dans la m&ecirc;me cat&eacutegorie.');
define('ERROR_CATALOG_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Erreur: Impossible d\'&eacute;crire dans le r&eacute;pertoire images: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CATALOG_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Erreur: Le r&eacute;pertoire d\'images n\'existe pas: ' . DIR_FS_CATALOG_IMAGES);
define('ERROR_CANNOT_MOVE_CATEGORY_TO_PARENT', 'Erreur: La cat&eacute;gorie ne peut pas &ecirc;tre d&eacute;plac&eacute;e dans la sous-cat&eacute;gorie.');

// BOF indvship 4.5
define('TEXT_PRODUCTS_ZIPCODE', 'Shipping zip code: ');
define('TEXT_INDIV_SHIPPING_PRICE', 'Shipping price: ');
define('TEXT_INDIV_ADDITIONAL_PRICE', 'Each additional price: ');
// EOF indvship 4.5
?>
