<?php
/*
$Id: admin_members.php 3 2006-05-27 04:59:07Z user $

  osCMax Power E-Commerce
  http://oscdox.com

  Copyright 2009 osCMax

  Released under the GNU General Public License
*/

if ($HTTP_GET_VARS['gID']) {
  define('HEADING_TITLE', 'Groupes Administration');
} elseif ($HTTP_GET_VARS['gPath']) {
  define('HEADING_TITLE', 'D&eacute;finir Groupes');
} else {
  define('HEADING_TITLE', 'Administrateurs');
}

define('TEXT_COUNT_GROUPS', 'Groups: ');

define('TABLE_HEADING_USERNAME', 'Nom d'utilisateur');
define('TABLE_HEADING_NAME', 'Nom');
define('TABLE_HEADING_EMAIL', 'Email');
define('TABLE_HEADING_PASSWORD', 'Mot de passe');
define('TABLE_HEADING_CONFIRM', 'Confirmation');
define('TABLE_HEADING_GROUPS', 'Groupes');
define('TABLE_HEADING_CREATED', 'Compte cr&eacute;&eacute;');
define('TABLE_HEADING_MODIFIED', 'Compte modifi&eacute;');
define('TABLE_HEADING_LOGDATE', 'Derni&egrave;re connexion');
define('TABLE_HEADING_LOGNUM', 'NumLog');
define('TABLE_HEADING_LOG_NUM', 'Num&eacute;ro Log');
define('TABLE_HEADING_ACTION', 'Action');

define('TABLE_HEADING_GROUPS_NAME', 'Nom Groupes');
define('TABLE_HEADING_GROUPS_DEFINE', 'Selection Boites et Fichiers');
define('TABLE_HEADING_GROUPS_GROUP', 'Niveau');
define('TABLE_HEADING_GROUPS_CATEGORIES', 'Autorisations');


define('TEXT_INFO_HEADING_DEFAULT', 'Administrateur');
define('TEXT_INFO_HEADING_DELETE', 'Supprimer autorisation ');
define('TEXT_INFO_HEADING_EDIT', 'Editer Categorie / ');
define('TEXT_INFO_HEADING_NEW', 'Nouvel Administrateur ');

define('TEXT_INFO_DEFAULT_INTRO', 'Groupe');
define('TEXT_INFO_DELETE_INTRO', 'Supprimer <nobr><b>%s</b></nobr> de la catégorie <nobr>Administrateurs?</nobr>');
define('TEXT_INFO_DELETE_INTRO_NOT', 'Vous ne pouvez pas supprimer le <nobr>groupe %s!</nobr>');
define('TEXT_INFO_EDIT_INTRO', 'Indiquer ici le niveau d\'autorisation: ');

define('TEXT_INFO_USERNAME', 'Nom d'utilisateur: ');
define('TEXT_INFO_FULLNAME', 'Nom complet: ');
define('TEXT_INFO_FIRSTNAME', 'Pr&eacute;nom: ');
define('TEXT_INFO_LASTNAME', 'Nom: ');
define('TEXT_INFO_EMAIL', 'Email: ');
define('TEXT_INFO_PASSWORD', 'Mot de passe: ');
define('TEXT_INFO_CONFIRM', 'Confirmation: ');
define('TEXT_INFO_CREATED', 'Compte cr&eacute;&eacute;: ');
define('TEXT_INFO_MODIFIED', 'Compte modifi&eacute;: ');
define('TEXT_INFO_LOGDATE', 'Derni&egrave;re connexion: ');
define('TEXT_INFO_LOGNUM', 'Num&eacute;ro Log: ');
define('TEXT_INFO_GROUP', 'Groupe: ');
define('TEXT_INFO_ERROR', '<font color="red">Votre Email est d&eacute;j&agrave; utilis&eacute;! Veuillez recommencer.</font>');

define('JS_ALERT_USERNAME', '- Obligatoire: Nom d'utilisateur \n');
define('JS_ALERT_FIRSTNAME', '- Obligatoire: Pr&eacute;nom \n');
define('JS_ALERT_LASTNAME', '- Obligatoire: Nom \n');
define('JS_ALERT_EMAIL', '- Obligatoire: Email \n');
define('JS_ALERT_EMAIL_FORMAT', '- Votre Email n\'est pas valide! \n');
define('JS_ALERT_EMAIL_USED', '- Votre Email est d&eacute;j&agrave; utilis&eacute;! \n');
define('JS_ALERT_LEVEL', '- Obligatoire: Groupe \n');

define('ADMIN_EMAIL_SUBJECT', 'Nouvel Administrateur');
define('ADMIN_EMAIL_TEXT', 'Bonjour %s,' . "\n\n" . 'Vous pouvez acceder au module d\'administration avec le mot de passe suivant. Une fois connect&eacute;, veuillez modifier votre mot d passe!' . "\n\n" . 'Site : %s' . "\n" . 'Login: %s' . "\n" . 'Mot de passe: %s' . "\n\n" . 'Merci!' . "\n" . '%s' . "\n\n" . 'Ceci est un mail automatique, veuillez ne pas y r&eacute;pondre!');
define('ADMIN_EMAIL_EDIT_SUBJECT', 'Edition profil administrateur');
define('ADMIN_EMAIL_EDIT_TEXT', 'Bonjour %s,' . "\n\n" . 'Vos informations personnelles ont &eacute;t&eacute; mises &agrave; jour par un administrateur.' . "\n\n" . 'Site : %s' . "\n" . 'Login: %s' . "\n" . 'Mot de passe: %s' . "\n\n" . 'Merci!' . "\n" . '%s' . "\n\n" . 'Ceci est un mail automatique, veuillez ne pas y r&eacute;pondre!');

define('TEXT_INFO_HEADING_DEFAULT_GROUPS', 'Groupe Admin ');
define('TEXT_INFO_HEADING_DELETE_GROUPS', 'Supprimer Groupe ');

define('TEXT_INFO_DEFAULT_GROUPS_INTRO', '<b>NOTE:</b><li><b>&eacute;diter:</b> &eacute;diter le nom du groupe.</li><li><b>supprimer:</b> supprimer le groupe.</li><li><b>d&eacute;finir:</b> d&eacute;finir les droits du groupe.</li>');
define('TEXT_INFO_DELETE_GROUPS_INTRO', 'Cette action supprimera aussi les membres du groupe. Etes-vous sur de vouloir supprimer <nobr>le groupe <b>%s</b>?</nobr>');
define('TEXT_INFO_DELETE_GROUPS_INTRO_NOT', 'Vous ne pouvez pas supprimer ces groupes!');
define('TEXT_INFO_GROUPS_INTRO', 'Donnez un nom de groupe. Cliquer suivant pour envoyer.');
define('TEXT_INFO_EDIT_GROUPS_INTRO', 'Donnez un nom de groupe. Cliquer suivant pour envoyer.');

define('TEXT_INFO_HEADING_EDIT_GROUP', 'Groupes Administration');
define('TEXT_INFO_HEADING_GROUPS', 'Nouveau Groupe');
define('TEXT_INFO_GROUPS_NAME', ' <b>Nom du groupe:</b><br>Donnez un nom de groupe. Cliquer suivant pour envoyer.<br>');
define('TEXT_INFO_GROUPS_NAME_FALSE', '<font color="red"><b>ERREUR:</b> Le nom de groupe doit avoir au moins 5 caract&egrave;res!</font>');
define('TEXT_INFO_GROUPS_NAME_USED', '<font color="red"><b>ERREUR:</b> Le nom de groupe est d&eacute;j&agrave; utilis&eacute;!</font>');
define('TEXT_INFO_GROUPS_LEVEL', 'Groupe: ');
define('TEXT_INFO_GROUPS_BOXES', '<b>Autorisation Boites:</b><br> Donnez les droits pour les boites.');
define('TEXT_INFO_GROUPS_BOXES_INCLUDE', 'Fichiers stock&eacute;s dans: ');

define('TEXT_INFO_HEADING_DEFINE', 'D&eacute;finir Groupe');
if ($HTTP_GET_VARS['gPath'] == 1) {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>Vous ne pouvez pas changer les droits pour ce groupe.<br><br>');
} else {
  define('TEXT_INFO_DEFINE_INTRO', '<b>%s :</b><br>Changez les droits de ce groupe en s&eacute;lectionnant ou en d&eacute;s&eacute;lectionnant les boites et les fichiers propos&eacute;s. Cliquer sur <b>sauver</b> pour sauvegarder les changements.<br><br>');
}
?>