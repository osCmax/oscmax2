<?php
/*
  $Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
  Translated by Gunt - Contact : webmaster@webdesigner.com.fr
*/

define('NAVBAR_TITLE', 'Ouverture de session');
define('HEADING_TITLE', 'Bienvenue, veuillez ouvrir une session');

define('HEADING_NEW_CUSTOMER', 'Nouveau client');
define('TEXT_NEW_CUSTOMER', 'Je suis un nouveau client.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'En cr&eacute;ant votre compte sur ' . STORE_NAME . ' vous pourrez faire vos achats plus rapidements, garder votre panier d\'une visite &agrave; l\'autre et suivre vos commandes.');

define('HEADING_RETURNING_CUSTOMER', 'Client enregistr&eacute;');
define('TEXT_RETURNING_CUSTOMER', 'J\'ai d&eacute;j&agrave; command&eacute;.');

define('TEXT_PASSWORD_FORGOTTEN', 'Vous avez oubli&eacute; votre mot de passe? Cliquez ici.');

define('TEXT_LOGIN_ERROR', 'Erreur: aucun r&eacute;sultat &agrave; cette adresse &eacute;lectronique et/ou mot de passe.');
define('TEXT_VISITORS_CART', '<font color="#ff0000"><b>REMARQUE:</b></font> Le contenu de votre &quot;panier visiteurs&quot; sera ajout&eacute; &agrave; celui de votre &quot;panier membres&quot; d&egrave;s que vous aurez ouvert une session. <a href="javascript:session_win();">[Plus d\'info]</a>');

//BOF - Checkout Without Account v0.70 changes
define('PWA_FAIL_ACCOUNT_EXISTS', 'Un compte existe déjà pour cette adresse e-mail <i>{EMAIL_ADDRESS}</i>.  Vous devez vous identifier avant de procéder à la commande.');
define('HEADING_CHECKOUT', '<font size="2">Passez directement vote commande.</font>');
define('TEXT_CHECKOUT_INTRODUCTION', 'Commandez sans créer un compte.  En choisissant cette option aucune de vos informations d\'utilisateur ne sera gardée en enregistrement, et vous ne pourrez pas consulter l\'historique de vos commande.');
define('PROCEED_TO_CHECKOUT', 'Procédez à la commande sans enregistrement.');
// EOF - Checkout Without Account changes

// BOF Separate Pricing Per Customer
// define the email address that can change customer_group_id on login
define('SPPC_TOGGLE_LOGIN_PASSWORD', '');
// EOF Separate Pricing Per Customer
?>
