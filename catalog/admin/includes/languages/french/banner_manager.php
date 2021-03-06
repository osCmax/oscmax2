<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Gestionnaire de banni&egrave;res');

define('TABLE_HEADING_BANNERS', 'Banni&egrave;res');
define('TABLE_HEADING_GROUPS', 'Groupes');
define('TABLE_HEADING_STATISTICS', 'Affichages / Clics');
define('TABLE_HEADING_STATUS', 'Statut');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_BANNERS_TITLE', 'Titre de la banni&egrave;re:');
define('TEXT_BANNERS_URL', 'URL banni&egrave;re:');
define('TEXT_BANNERS_GROUP', 'Groupe banni&egrave;re:');
define('TEXT_BANNERS_NEW_GROUP', ', ou entrez un nouveau groupe banni&egrave;re ci-dessous');
define('TEXT_BANNERS_IMAGE', 'Image:');
define('TEXT_BANNERS_IMAGE_LOCAL', ', ou sp&eacute;cifiez un fichier local ci-dessous');
define('TEXT_BANNERS_IMAGE_TARGET', 'Cible de l\'image (Sauvegarder dans):');
define('TEXT_BANNERS_HTML_TEXT', 'Texte HTML:');
define('TEXT_BANNERS_EXPIRES_ON', 'Expires le:');
define('TEXT_BANNERS_OR_AT', ', ou &agrave;');
define('TEXT_BANNERS_IMPRESSIONS', 'Impressions/Vues.');
define('TEXT_BANNERS_SCHEDULED_AT', 'Planifi&eacute; le:');
define('TEXT_BANNERS_BANNER_NOTE', '<b>Remarque sur la banni&egrave;res:</b><ul><li>Utilisez une image ou du texte HTML pour la banni&egrave;re mais pas les deux.</li><li>Le texte HTML a priorit&eacute; sur l\'image</li></ul>');
define('TEXT_BANNERS_GROUP_NOTE', '<b>Banner Groups:</b><ul><li>all - displays in the footer on all pages</li><li>index - displays on the index page in the main content area</li><li>product - displays on the product_info page</li><li>You can change the sort order of display in Configuration -> Templates -> Page Modules</li></ul>');
define('TEXT_BANNERS_INSERT_NOTE', '<b>Remarque sur l\'image:</b><ul><li>Le r&eacute;pertoire de destination lors du transfert doit avoir les bonnes permissions (&eacute;criture) sur le serveur!</li><li>Ne remplissez pas la cible de l\'image (\'Sauvegarder dans\') si vous ne transf&eacute;rez pas d\'image sur le serveur web (dans le cas ou vous utilisez une image d&eacute;ja pr&eacute;sente sur celui-ci).</li><li>La cible de l\'image (\'Sauvegarder dans\') doit pointer sur un r&eacute;pertoire existant et le slash de fin doit &ecirc;tre pr&eacute;sent (ex., banners/).</li></ul>');
define('TEXT_BANNERS_EXPIRCY_NOTE', '<b>Remarque sur l\'expiration:</b><ul><li>Only one of the two fields should be submitted</li><li>If the banner is not to expire automatically, then leave these fields blank</li></ul>');
define('TEXT_BANNERS_SCHEDULE_NOTE', '<b>Remarque sur la planification:</b><ul><li>Si la date de planification est pr&eacute;cis&eacute;e, la banni&egrave;re sera activ&eacute;e seulement &agrave; partir de cette date.</li><li>Toutes las banni&egrave;res planifi&eacute;es seront marqu&eacute;es inactives jusqu\'&agrave; ce que la date de planification soit atteinte. Elles seront alors actives.</li></ul>');

define('TEXT_BANNERS_DATE_ADDED', 'Date d\'ajout:');
define('TEXT_BANNERS_SCHEDULED_AT_DATE', 'Planifi&eacute; &agrave;: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_DATE', 'Expire le: <b>%s</b>');
define('TEXT_BANNERS_EXPIRES_AT_IMPRESSIONS', 'Expire au bout de: <b>%s</b> affichages');
define('TEXT_BANNERS_STATUS_CHANGE', 'Changement du statut: %s');

define('TEXT_BANNERS_DATA', 'D<br>A<br>T<br>A');
define('TEXT_BANNERS_LAST_3_DAYS', 'Les 3 derniers jours');
define('TEXT_BANNERS_BANNER_VIEWS', 'Nombre d\'affichages');
define('TEXT_BANNERS_BANNER_CLICKS', 'Nombre de clics');

define('TEXT_INFO_DELETE_INTRO', 'Etes vous sur de vouloir supprimer cette banni&egrave;re?');
define('TEXT_INFO_DELETE_IMAGE', 'Supprimer l\'image de la banni&egrave;re');

define('SUCCESS_BANNER_INSERTED', 'Success: La bani&egrave;re a &eacute;t&eacute; ins&eacute;r&eacute;e.');
define('SUCCESS_BANNER_UPDATED', 'Success: La bani&egrave;re a &eacute;t&eacute; mise &agrave; jour.');
define('SUCCESS_BANNER_REMOVED', 'Success: La bani&egrave;re a &eacute;t&eacute; supprim&eacute;e.');
define('SUCCESS_BANNER_STATUS_UPDATED', 'Success: Le statut de la bani&egrave;re a &eacute;t&eacute; mis &agrave; jour.');

define('ERROR_BANNER_TITLE_REQUIRED', 'Erreur: Titre de bani&egrave;re requis.');
define('ERROR_BANNER_GROUP_REQUIRED', 'Erreur: Groupe de bani&egrave;re requis.');
define('ERROR_IMAGE_DIRECTORY_DOES_NOT_EXIST', 'Erreur: Le r&eacute;pertoire cible n\'existe pas: %s');
define('ERROR_IMAGE_DIRECTORY_NOT_WRITEABLE', 'Erreur: Target directory is not writeable: %s');
define('ERROR_IMAGE_DOES_NOT_EXIST', 'Erreur: L\'image n\'existe pas.');
define('ERROR_IMAGE_IS_NOT_WRITEABLE', 'Erreur: L\'image ne peut pas &ecirc;tre supprim&eacute;e.');
define('ERROR_UNKNOWN_STATUS_FLAG', 'Erreur: Statut flag inconnu.');

define('ERROR_GRAPHS_DIRECTORY_DOES_NOT_EXIST', 'Erreurr: Le r&eacute;pertoire de banni&egrave;res n\'existe pas. Cr&eacute;er un r&eacute;pertoire \'graphs\' dans \'images\'.');
define('ERROR_GRAPHS_DIRECTORY_NOT_WRITEABLE', 'Erreur: Le r&eacute;pertoire de banni&egrave;res n\'est pas autoris&eacute; en &eacute;criture.');

define('TEXT_BANNERS_HELP', 'Banner Manager Help');
?>