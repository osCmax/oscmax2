<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Compte Administrateur');

define('TABLE_HEADING_ACCOUNT', 'Mon Compte');

define('TEXT_INFO_FULLNAME', '<b>Nom complet: </b>');
define('TEXT_INFO_USERNAME', '<b>Nom d'utilisateur: </b>');
define('TEXT_INFO_FIRSTNAME', '<b>Pr&eacute;om: </b>');
define('TEXT_INFO_LASTNAME', '<b>Nom: </b>');
define('TEXT_INFO_EMAIL', '<b>Email: </b>');
define('TEXT_INFO_PASSWORD', '<b>Mot de Passe: </b>');
define('TEXT_INFO_PASSWORD_HIDDEN', '-Cach&eacute;-');
define('TEXT_INFO_PASSWORD_CONFIRM', '<b>Confirmation: </b>');
define('TEXT_INFO_CREATED', '<b>Cr&eacute;ation Compte: </b>');
define('TEXT_INFO_LOGDATE', '<b>Derni&egrave;re connexion: </b>');
define('TEXT_INFO_LOGNUM', '<b>Num&eacute;ro Log: </b>');
define('TEXT_INFO_GROUP', '<b>Groupe: </b>');
define('TEXT_INFO_ERROR', '<font color="red">Email utilis&eacute;!.</font>');
define('TEXT_INFO_MODIFIED', 'Modifi&eacute;: ');

define('TEXT_INFO_HEADING_DEFAULT', 'Editer Compte ');
define('TEXT_INFO_HEADING_CONFIRM_PASSWORD', 'Confirmation ');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD', 'Mot de Passe:');
define('TEXT_INFO_INTRO_CONFIRM_PASSWORD_ERROR', '<font color="red"><b>ERREUR:</b> Mot de passe faux!</font>');
define('TEXT_INFO_INTRO_DEFAULT', 'Cliquez <b>modifier</b> pour modifier votre compte.');
define('TEXT_INFO_INTRO_DEFAULT_FIRST_TIME', '<br><b>ATTENTION:</b><br>Bonjour <b>%s</b>, C\'est votre premi&egrave;re visite. Nous vous recommandons de modifier votre mot de passe!');
define('TEXT_INFO_INTRO_DEFAULT_FIRST', '<br><b>ATTENTION:</b><br>Bonjour <b>%s</b>, nous vous recommandons de cahnger votre email (<font color="red">admin@localhost</font>) et votre mot de passe!');
define('TEXT_INFO_INTRO_EDIT_PROCESS', 'Tous les champs sont obligatoires. Cliquez Sauver.');

define('JS_ALERT_USERNAME',         '- Obligatoire: Nom d'utilisateur \n');
define('JS_ALERT_FIRSTNAME',        '- Obligatoire: Pr&eacutenom \n');
define('JS_ALERT_LASTNAME',         '- Obligatoire: Nom \n');
define('JS_ALERT_EMAIL',            '- Obligatoire: Email \n');
define('JS_ALERT_PASSWORD',         '- Obligatoire: Mot de passe \n');
define('JS_ALERT_USERNAME_LENGTH',  '- Taille pr&eacute;nom d'utilisateur insuffisante ');
define('JS_ALERT_FIRSTNAME_LENGTH', '- Taille pr&eacute;nom insuffisante ');
define('JS_ALERT_LASTNAME_LENGTH',  '- Taille nom insuffisante ');
define('JS_ALERT_PASSWORD_LENGTH',  '- Taille mot de passe insuffisante ');
define('JS_ALERT_EMAIL_FORMAT',     '- Email invalide! \n');
define('JS_ALERT_EMAIL_USED',       '- Email d&eacute;j&agrave; utilis&eacute;! \n');
define('JS_ALERT_PASSWORD_CONFIRM', '- Champ confirmation vide! \n');

define('ADMIN_EMAIL_SUBJECT', 'Changement informations personnelles');
define('ADMIN_EMAIL_TEXT', 'Bonjour %s,' . "\n\n" . 'vos informations personnelles, dont peut-etre votre mot de passe, ont &eacute;t&eacute; modifi&eacute;es. Si cela a &eacute;t&eacute; fait sans votre consentement, veuillez contacter imm&eacute;diatement l\'administrateur!' . "\n\n" . 'Site : %s' . "\n" . 'Login: %s' . "\n" . 'Mot de passe: %s' . "\n\n" . 'Merci!' . "\n" . '%s' . "\n\n" . 'Ceci est un mail automatique, veuillez ne pas y r&eacute;pondre!');
?>