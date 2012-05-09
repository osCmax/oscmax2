<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Recommander ce produit à quelq\'un');

define('HEADING_TITLE', 'Informer quelq\'un propos de \'%s\'');

define('FORM_TITLE_CUSTOMER_DETAILS', 'Vos coordonnées');
define('FORM_TITLE_FRIEND_DETAILS', 'Les coordonnées  de votre ami(e)');
define('FORM_TITLE_FRIEND_MESSAGE', 'Votre message');

define('FORM_FIELD_CUSTOMER_NAME', 'Votre nom:');
define('FORM_FIELD_CUSTOMER_EMAIL', 'Votre adresse courriel:');
define('FORM_FIELD_FRIEND_NAME', 'Le nom de votre ami(e):');
define('FORM_FIELD_FRIEND_EMAIL', 'L\adresse courriel de votre ami(e):');

define('TEXT_EMAIL_SUCCESSFUL_SENT', 'Votre courriel &agrave; propos de <b>%s</b> a été envoyé avec succès à <b>%s</b>.');

define('TEXT_EMAIL_SUBJECT', 'Votre ami %s a recommand&eacute; ce superbe produit de %s');
define('TEXT_EMAIL_INTRO', 'Bonjour %s!' . "\n\n" . 'Votre ami(e), %s, a pens&eacute; que vous seriez int&eacute;ress&eacute;s par %s de %s.');
define('TEXT_EMAIL_LINK', 'Pour voir ce produit cliquez sur le lien ci-dessous ou copiez et collez le dans votre navigateur Internet :' . "\n\n" . '%s');
// LINE ADDED: MOD - ARTICLE MANAGER
define('TEXT_EMAIL_LINK_ARTICLE', 'Pour voir l\'article cliquez sur le lien ci-dessous ou copiez et collez le dans votre navigateur web:' . "\n\n" . '%s');
define('TEXT_EMAIL_SIGNATURE', 'Amicalement,' . "\n\n" . '%s');

define('ERROR_TO_NAME', 'Erreur: Le champ du nom de votre ami(e) ne doit pas &ecirc;tre vide.');
define('ERROR_TO_ADDRESS', 'Erreur: Le champ de l\'adresse courriel de votre ami(e) doit correspondre à une adresse courriel valide.');
define('ERROR_FROM_NAME', 'Erreur: Le champ de votre nom ne doit pas &ecirc;tre vide.');
define('ERROR_FROM_ADDRESS', 'Erreur: Le champ de votre adresse courriel doit correspondre à une adresse courriel valide.');
?>