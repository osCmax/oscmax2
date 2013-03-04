<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Cr&eacute;er un compte');
// PWA BOF
define('NAVBAR_TITLE_PWA',  'Saisisez les informations de facturation et d\'expédition');
define('HEADING_TITLE_PWA', 'informations de facturation et d\'expédition');
// PWA EOF

define('HEADING_TITLE', 'Information sur mon compte');

define('TEXT_ORIGIN_LOGIN', '<font color="#FF0000">Ouvrir un compte sur '.STORE_NAME.' est absolument gratuit !<br><br>Toutes les informations que vous nous donnerez resteront bien &eacute;videmment strictement priv&eacute;es et r&eacute;serv&eacute;es. &agrave; aucun moment vos informations ne seront divulgu&eacute;es &agrave; d\'autres parties pour aucune action ou propos commercial. Toutes ces informations ne servent &agrave; '.STORE_NAME.' que pour mieux vous suivre et vous servir...<br><br> Vous pourrez &agrave; tout moment voir, mettre &agrave; jour ou supprimer les informations que vous nous aurez donn&eacute;es. Il vous suffira pour cela de vous identifier sur notre site et de cliquer sur le lien "Mon compte" Vous gardez ainsi &agrave; tout moment le plein contr&ocirc;le sur les informations que vous nous avez transmises...</font><br><br>');

define('EMAIL_ACCOUNT_DETAILS', 'Détails du compte:');
define('EMAIL_ACCOUNT_USERNAME', 'Nom d\'utilisateur:');
define('EMAIL_ACCOUNT_PASSWORD', 'Mot de passe:');
define('EMAIL_SUBJECT', 'Bienvenue chez ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Monsieur, %s!' . "\n\n");
define('EMAIL_GREET_MS', 'Madame,  . %s,' . "\n\n");
define('EMAIL_GREET_NONE', 'Cher  . %s' . "\n\n");
define('EMAIL_WELCOME', 'Nous vous souhaitons la bienvenue chez <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'Vous pouvez d&eacute;sormais acc&eacute;der &agrave; de <b>multiples services</b> comme, ' . "\n\n" . '<li><b>Un panier permanent</b> - Tous les articles resteront dans votre panier jusqu\'&agrave; ce que vous conformiez votre commande. Vous pouvez &agrave; tout moment supprimer les articles de votre choix.' . "\n" . '<li><b>Carnet d\'adresses</b> - Vous pouvez cr&eacute;er votre carnet d\'adresse, et nous demander la livraison &agrave; toute adresse de votre choix.' . "\n" . '<li><b>Historique des commandes</b> - Vous avez acc&egrave;s &agrave; l\'historique de vos commandes sur votre compte.' . "\n" . '<li><b>Vos commentaires</b> - N\'h&eacute;sitez pas &agrave; exprimer vos opinions sur le site '.STORE_NAME.'.' . "\n\n");
define('EMAIL_CONTACT', 'Pour toute aide sur les services, merci de nous contacter: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Note:</b> Cette adresse email nous a été donné par l\'un de nos clients. Si vous n\'avez pas ' . HTTP_COOKIE_DOMAIN . "\n\n" . '<b>Observation :</b> ' . HTTP_COOKIE_DOMAIN . ' ne saurait en aucun cas &ecirc;tre responsable des utilisations qui pourraient &ecirc;tre effectu&eacute;es sur une bo&icirc;te email d\'une tierce personne.');
// BOF - MOD: CREDIT CLASS Gift Voucher Contribution
define('EMAIL_GV_INCENTIVE_HEADER', "\n\n" .'Pour votre bienvenue comme nouveau client, nous vous avons envoy&eacute; un ch&egrave;que cadeaux d\'une valeur de %s');
define('EMAIL_GV_REDEEM', 'Le code de ce ch&egrave;que cadeau est : %s, vous pouvez entrer ce code au moment de votre commande');
define('EMAIL_GV_LINK', 'ou en suivant ce lien ');
define('EMAIL_COUPON_INCENTIVE_HEADER', "\n\n" .'F&eacute;licitations, pour votre premi&egrave;re visite &agrave; notre magasin en ligne, pour vous remercier nous vous envoyons une remise par coupon.' . "\n" .
                                        ' Ci-dessous les d&eacute;tails du Coupon de Remise cr&eacute;&eacute; juste pour vous.' . "\n");
define('EMAIL_COUPON_REDEEM', 'Utiliser le bon %s au moment de votre commande');
// EOF - MOD: CREDIT CLASS Gift Voucher Contribution
define('TERMS_PART_1', 'S\'il vous pla&icirc;t confirmer que vous avez lu nos');
define('TERMS_PART_2', '<u><b>Conditions générales</b></u>');

define('ENTRY_NEWSLETTER_TYPE', 'Format du courriel:');
define('ACCOUNT_PASSWORD', 'Mot de passe:');

?>