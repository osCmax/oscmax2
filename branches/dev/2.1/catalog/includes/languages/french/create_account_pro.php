<?php
/*
  $Id: create_account.php,v 1.11 2003/07/05 13:58:31 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Cr&eacute;ation de compte');

define('HEADING_TITLE', 'Informations &agrave; remplir');
define('ENTRY_COMPANY_TAX_ID_TEXT', 'Entrez votre numéro de TVA');
define('ENTRY_COMPANY_TAX_ID', 'N° de TVA intracommunautaire');
define('ENTRY_COMPANY_RCS', 'N° de SIRET pour les entreprises françaises');
define('ENTRY_COMPANY_RCS_TEXT', 'Entrez votre n° de SIRET');

define('TEXT_ORIGIN_LOGIN', '<font color="#FF0000"><small><b>NOTE&nbsp;:</b></font></small> si vous avez d&eacute;j&agrave; un compte, veuillez vous identifier &agrave; la <a href="%s"><u>page d\'identification</u></a>.');

define('EMAIL_SUBJECT', 'Bienvenue chez <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_GREET_MR', 'Cher partenaire');
define('EMAIL_GREET_NONE', 'Cher %s' . "\n\n");
define('EMAIL_WELCOME', 'Nous vous souhaitons la bienvenue chez <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'Vous pouvez &agrave; pr&eacute;sent acc&eacute;der aux <b>nombreux services</b> que nous vous offrons. Parmis ceux-ci&nbsp;:' . "\n\n" . '<li><b>Panier permanent</b> - Chaque produit ajout&eacute; &agrave; votre panier en ligne y demeure jusqu\'&agrave; ce que vous l\'enleviez ou le commandiez.' . "\n" . '<li><b>Carnet d\'adresses</b> - Nous pouvons maintenant exp&eacute;dier votre commande &agrave; une autre adresse que la v&ocirc;tre&nbsp;! C\'est l\'id&eacute;al pour envoyer un produit directement &agrave; vos clients.' . "\n" . '<li><b>Historique des commandes</b> - Consultez l\'historique des achats effectu&eacute;s aupr&egrave;s de nous.' . "\n" . '' . "\n\n");
define('EMAIL_CONTACT', 'Pour une aide sur les services en ligne, veuillez envoyer un email au responsable en ligne&nbsp;: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Note&nbsp;:</b> Cette adresse courriel nous a &eacute;t&eacute; communiqu&eacute;e par un de nos clients. Si vous ne vous &ecirc;tes pas inscrit comme membre du site, veuillez envoyer un email &agrave; ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");
?>
