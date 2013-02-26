<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Gestionnaire de bannière d\'affiliation');

define('TABLE_HEADING_BANNERS', 'Bannières');
define('TABLE_HEADING_GROUPS', 'Groupees');
define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_STATISTICS', 'Statistiques');
define('TABLE_HEADING_PRODUCT_ID', 'ID produit');
define('TEXT_VALID_CATEGORIES_LIST', 'Liste de Catégorie');
define('TEXT_VALID_CATEGORIES_ID', 'Category #');
define('TEXT_VALID_CATEGORIES_NAME', 'Nom de Catégorie');
define('TABLE_HEADING_CATEGORY_ID', 'Cat ID');
define('TEXT_BANNERS_LINKED_CATEGORY', 'Catégorie ID');
define('TEXT_BANNERS_LINKED_CATEGORY_NOTE', 'Si vous voulez lier la Bannière à une catégorie spécifique entrez l\'ID Catégorie ici. Si vous voulez lier à la page par défaut, entrez "0"');
define('TEXT_AFFILIATE_VALIDCATS', 'Cliquez ici:');
define('TEXT_AFFILIATE_CATEGORY_BANNER_VIEW', 'pour afficher les catégories disponibles.');
define('TEXT_AFFILIATE_CATEGORY_BANNER_HELP', 'Sélectionnez le numéro de catégorie dans la fenêtre et entrez le numéro dans le champ ID de catégorie.');

define('TEXT_BANNERS_TITLE', 'Bannière Titre :');
define('TEXT_BANNERS_GROUP', 'Bannière Groupe:');
define('TEXT_BANNERS_NEW_GROUP', ', ou entrez un nouveau(elle) bannière groupe ci-dessous');
define('TEXT_BANNERS_IMAGE', 'Image :');
define('TEXT_BANNERS_IMAGE_LOCAL', ', ou entrez un fichier local ci-dessous');
define('TEXT_BANNERS_IMAGE_TARGET', 'Image cible :');
define('TEXT_BANNERS_HTML_TEXT', 'Texte HTML:');
define('TEXT_AFFILIATE_BANNERS_NOTE', '<b>Bannière Notes:</b><ul><li>Utilisez une image ou du Texte HTML pour la bannière - pas les deux.</li><li>HTML Text avait prioritoire au dessus d\'un image</li></ul>');

define('TEXT_BANNERS_LINKED_PRODUCT', 'Produit ID');
define('TEXT_BANNERS_LINKED_PRODUCT_NOTE', 'Si vous voulez lier la Bannière à un produit spécifique entrez l\'ID Produit ici. Si vous voulez lier à la page par défaut, entrez "0"');

define('TEXT_BANNERS_DATE_ADDED', 'Date Ajoutée:');
define('TEXT_BANNERS_STATUS_CHANGE', 'Edité dernièrement le: %s');

define('TEXT_AFFILIATE_VALIDPRODUCTS', 'Cliquez ici :');
define('TEXT_AFFILIATE_INDIVIDUAL_BANNER_VIEW', 'Pour voir les produits disponibles.');
define('TEXT_AFFILIATE_INDIVIDUAL_BANNER_HELP', 'Sélectionnez le numéro de produit à partir de la popup et entrez le numéro dans le champ Produit ID.');

define('TEXT_VALID_PRODUCTS_LIST', 'Liste Produits Disponible(s)');
define('TEXT_VALID_PRODUCTS_ID', 'Produit #');
define('TEXT_VALID_PRODUCTS_NAME', 'Nom des Produits');

define('TEXT_CLOSE_WINDOW', '<u>Fermer cette fenêtre</u> [x]');
define('TEXT_INFO_DELETE_INTRO', 'Êtes-vous certain de vouloir effacer cette bannière?');
define('TEXT_INFO_DELETE_IMAGE', 'Effacer l\'image bannière');

define('SUCCESS_BANNER_INSERTED', 'Success: The bannière a été insérée.');
define('SUCCESS_BANNER_UPDATED', 'Success: The bannière a été mise à jour.');
define('SUCCESS_BANNER_REMOVED', 'Success: The bannière a été enlevée.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Erreur: titre de la Bannière requis.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Erreur: groupe de la Bannière requis.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Erreur: Dossier cible n\'existe pas.');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Erreur: Dossier cible n\'est pas en mode écriture.');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Erreur: Image inexistante.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Erreur: Image impossible à enlever.');
?>