<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

// PWA BOF
define('TEXT_GUEST_INTRODUCTION', '<b>Do you want to go straight to the checkout process?</b><br><br>Would you like to check out without creating a customer account? Please note that all of our services will not be available to customers that do not wish to create an account. Also, you cannot view the status of your order, and each time you shop with us you will have to re-enter all of your data.<br><br>Creating an account is free. If you still wish to continue to checkout please click the checkout button to your right.');
// PWA BOF
define('NAVBAR_TITLE', 'Connectez-vous');
define('HEADING_TITLE', 'Bienvenue, veuillez-vous connecter');

define('HEADING_NEW_CUSTOMER', 'Nouveau client');
define('TEXT_NEW_CUSTOMER', 'Je suis un nouveau client.');
define('TEXT_NEW_CUSTOMER_INTRODUCTION', 'En cr&eacute;ant votre compte sur ' . STORE_NAME . ' vous pourrez faire vos achats plus rapidements, garder votre panier d\'une visite &agrave; l\'autre et suivre vos commandes.');

define('HEADING_RETURNING_CUSTOMER', 'Client enregistr&eacute;');
define('TEXT_RETURNING_CUSTOMER', 'J\'ai d&eacute;j&agrave; command&eacute;.');

define('TEXT_PASSWORD_FORGOTTEN', 'Vous avez oubli&eacute; votre mot de passe? Cliquez ici.');

define('TEXT_LOGIN_ERROR', 'Erreur: aucun r&eacute;sultat &agrave; cette adresse &eacute;lectronique et/ou mot de passe.');
define('TEXT_VISITORS_CART', '<font color="#ff0000"><b>REMARQUE:</b></font> Le contenu de votre &quot;panier visiteurs&quot; sera ajout&eacute; &agrave; celui de votre &quot;panier membres&quot; d&egrave;s que vous aurez ouvert une session.');

// LINE ADDED: MOD - Separate Pricing Per Customer
// define the email address that can change customer_group_id on login
define('SPPC_TOGGLE_LOGIN_PASSWORD', 'root@localhost');
define('PWA_FAIL_ACCOUNT_EXISTS', 'Un compte existe déjà pour cette adresse e-mail <i>{EMAIL_ADDRESS}</i>.  Vous devez vous identifier avant de procéder à la commande.');

define('HEADING_CHECKOUT', '<font size="2">Passez directement vote commande.</font>');

define('TEXT_CHECKOUT_INTRODUCTION', 'Commandez sans créer un compte.  En choisissant cette option aucune de vos informations d\'utilisateur ne sera gardée en enregistrement, et vous ne pourrez pas consulter l\'historique de vos commande.');

define('PROCEED_TO_CHECKOUT', 'Procédez à la commande sans enregistrement.');

define('TEXT_GV_LOGIN_NEEDED', 'Vous devez être connecté pour échanger votre bon. S\'il vous plaît créer un nouveau compte ou se connecter ci-dessous');
define('TEXT_REVIEW_LOGIN_NEEDED', 'Vous devez être connecté pour écrire un commentaire. S\'il vous plaît créer un nouveau compte ou connectez-vous ci-dessous.');

?>