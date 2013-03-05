<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Cr&eacute;er un compte');

define('HEADING_TITLE', 'Cr&eacute;er un compte');

define('TEXT_ORIGIN_LOGIN', '<span class="notice"><small><b>Attention:</b></span></small> Si vous posedez déja un compt chez nous identifier vous <a href="%s"><u><b>ici</b></u></a>.<br><br><font color="#ffffff">Ouvrir un compte sur Placebo est absolument gratuit !<br><br>Toutes les informations que vous nous donnerez resteront bien &eacute;videmment strictement priv&eacute;es et r&eacute;serv&eacute;es. À aucun moment vos informations ne seront divulgu&eacute;es &agrave; d\'autres parties pour aucune action ou propos commercial. Toutes ces informations ne servent à Placebo que pour mieux vous suivre et vous servir...<br><br> Vous pourrez à tout moment voir, mettre à jour ou supprimer les informations que vous nous aurez donn&eacute;es. Il vous suffira pour cela de vous identifier sur notre site et de cliquer sur le lien "Mon compte" Vous gardez ainsi à tout moment le plein contr&ocirc;le sur les informations que vous nous avez transmises.</font><br><br>');

define('EMAIL_ACCOUNT_DETAILS', 'Account Details:');
define('EMAIL_ACCOUNT_USERNAME', 'Username:');
define('ACCOUNT_PASSWORD','Mot de passe:');
define('EMAIL_SUBJECT', 'Bienvenue sur ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Cher Mr. ' . stripslashes($_POST['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_MS', 'Ch&egrave;re Ms. ' . stripslashes($_POST['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_NONE', 'Cher ' . stripslashes($_POST['firstname']) . ',' . "\n\n");
define('EMAIL_WELCOME', 'Nous vous souhaitons la bienvenue sur <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'Vous pouvez d&eacute;sormais acc&eacute;der à nos services :' . "\n\n" . '<li><b>Un panier permanent</b>' . "\n" . '----------------' . "\n\n" . '     Tous les articles resteront dans votre panier jusqu\'à ce que vous conformiez votre commande. Vous pouvez à tout moment supprimer les articles de votre choix.' . "\n\n" . '<li><b>Carnet d\'adresses</b>' . "\n" . '-----------------' . "\n\n" . '     Vous pouvez cr&eacute;er votre carnet d\'adresse, et nous demander la livraison à toute adresse de votre choix.' . "\n\n" . '<li><b>Historique des commandes</b>' . "\n" . '------------------------' . "\n\n" . '     Vous avez acc&egrave;s à l\'historique de vos commandes sur votre compte.' . "\n\n" . '<li><b>Vos suggestions</b>' . "\n" . '---------------' . "\n\n" . '     N\'h&eacute;sitez pas à exprimer vos opinions sur le site '.STORE_NAME.'.' . "\n\n\n");
define('EMAIL_CONTACT', 'Pour toute aide sur les services, merci de contacter : ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', 'Nous vous remercions pour la confiance que vous nous t&eacute;moigniez en vous enregistrant comme nouveau client sur le site ' . HTTP_COOKIE_DOMAIN . "\n\n" . '<b>Observation :</b> ' . HTTP_COOKIE_DOMAIN . ' ne saurait en aucun cas être responsable des utilisations qui pourraient être effectu&eacute;es sur une boîte email d\'une tierce personne.');
// BOF - MOD: CREDIT CLASS Gift Voucher Contribution
define('EMAIL_GV_INCENTIVE_HEADER', "\n\n" .'Pour votre bienvenue comme nouveau client, nous vous avons envoy&eacute; un ch&egrave;que cadeaux d\'une valeur de %s');
define('EMAIL_GV_REDEEM', 'Le code de ce ch&egrave;que cadeau est : %s, vous pouvez entrer ce code au moment de votre commande');
define('EMAIL_GV_LINK', 'ou en suivant ce lien ');
define('EMAIL_COUPON_INCENTIVE_HEADER', "\n\n" .'F&eacute;licitations, pour votre premi&egrave;re visite à notre magasin en ligne, pour vous remercier nous vous envoyons une remise par coupon.' . "\n" .
                                        ' Ci-dessous les d&eacute;tails du Coupon de Remise cr&eacute;&eacute; juste pour vous.' . "\n");
define('EMAIL_COUPON_REDEEM', 'Utiliser le coupon %s au moment de votre commande');
// EOF - MOD: CREDIT CLASS Gift Voucher Contribution
define('NAVBAR_TITLE_PWA','Entrez facturation');

define('HEADING_TITLE_PWA','Facturation');

define('EMAIL_ACCOUNT_PASSWORD','Mot de passe:');

define('TERMS_PART_1','S\'il vous pla&icirc;t confirmer que vous avez lu notre ');

define('TERMS_PART_2','<u><b>Termes et conditions</b></u>');

define('ENTRY_NEWSLETTER_TYPE','Format du mail:');

?>