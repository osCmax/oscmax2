<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Compte administrateur');

define('TABLE_HEADING_ACCOUNT', 'Mon Compte');

define('TEXT_INFO_FULLNAME', '<b>Nom complet: </b>');
define('TEXT_INFO_USERNAME', '<b>Nom d\'utilisateur: </b>');
define('TEXT_INFO_FIRSTNAME', '<b>Prénom: </b>');
define('TEXT_INFO_LASTNAME', '<b>Nom: </b>');
define('TEXT_INFO_EMAIL', '<b>Email: </b>');
define('TEXT_INFO_PASSWORD', '<b>Mot de passe: </b>');
define('TEXT_INFO_PASSWORD_HIDDEN', '-Caché-');
define('TEXT_INFO_PASSWORD_CONFIRM', '<b>Confirmer le mot de passe: </b>');
define('TEXT_INFO_CREATED', '<b>Compte créé: </b>');
define('TEXT_INFO_LOGDATE', '<b>Dernière connexion: </b>');
define('TEXT_INFO_LOGNUM', '<b>Numéro Log: </b>');
define('TEXT_INFO_GROUP', '<b>Niveau du groupe: </b>');
define('TEXT_INFO_ERROR', '<Adresse e-mail a déjà été utilisé! S\'il vous plaît essayez à nouveau.');
define('TEXT_INFO_MODIFIED', 'A été modifié: ');

define('TEXT_INFO_HEADING_DEFAULT', 'Editer le compte ');
define('TEXT_INFO_HEADING_CONFIRM_PASSWORD', 'Confirmation du mot de passe ');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD', 'Mot de passe:');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR', 'Mauvais mot de passe</font>');
define('TEXT_INFO_INTRO_DEFAULT', 'Cliquez la bouton <b>éditer</b> pour modifier votre compte.');
define('TEXT_INFO_INTRO_DEFAULT_FIRST_TIME', '<b>%s</b>, nous avons détecté que vous n\'avez pas changer votre mot de passe depuis son premier encodage. Nous vous recommandons de le modifier!');
define('TEXT_INFO_INTRO_DEFAULT_FIRST', '<b>ATTENTION:</b><br>Bonjour <b>%s</b>, nous vous recommandons de cahnger votre email (<font color="red">admin@localhost</font>) et votre mot de passe!');
define('TEXT_INFO_INTRO_EDIT_PROCESS', 'Tous les champs sont obligatoires. Cliquez pour sauvegarder.');

define('JS_ALERT_USERNAME',         '- Obligatoire: Nom d\'utilisateur \n');
define('JS_ALERT_FIRSTNAME',        '- Obligatoire: Pr&eacutenom \n');
define('JS_ALERT_LASTNAME',         '- Obligatoire: Nom \n');
define('JS_ALERT_EMAIL',            '- Obligatoire: Email \n');
define('JS_ALERT_PASSWORD',         '- Obligatoire: Mot de passe \n');
define('JS_ALERT_USERNAME_LENGTH',  '- La taille du nom utilisateur doit être superieur à ');
define('JS_ALERT_FIRSTNAME_LENGTH', '- La taille du prénom doit être superieur à ');
define('JS_ALERT_LASTNAME_LENGTH',  '- La taille nom de famile doit être superieur à ');
define('JS_ALERT_PASSWORD_LENGTH',  '- La taille du mot de passe doit être superieur à ');
define('JS_ALERT_EMAIL_FORMAT',     '- Le ormat de l\'email est invalide! \n');
define('JS_ALERT_EMAIL_USED',       '- L\'adresse e-mail a déjà été utilisé! \n');
define('JS_ALERT_PASSWORD_CONFIRM', '- Erreur du champ de confirmation mot de passe! \n');

define('ADMIN_EMAIL_SUBJECT', 'Changement d\'informations personnelles');
define('ADMIN_EMAIL_TEXT', 'Bonjour %s,' . "\n\n" . 'vos informations personnelles, dont peut-être votre mot de passe, ont &eacute;t&eacute; modifi&eacute;es. Si cela a &eacute;t&eacute; fait sans votre consentement, veuillez contacter imm&eacute;diatement l\'administrateur!' . "\n\n" . 'Site: %s' . "\n" . 'Login: %s' . "\n" . 'Mot de passe: %s' . "\n\n" . 'Merci!' . "\n" . '%s' . "\n\n" . 'Ceci est un mail automatique, veuillez ne pas y r&eacute;pondre!');
?>