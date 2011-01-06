<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Créer un compte');

define('HEADING_TITLE', 'Créer un compte');

define('TEXT_ORIGIN_LOGIN', '<font color="#000000">Ouvrir un compte sur '.STORE_NAME.' est absolument gratuit !<br><br>Toutes les informations que vous nous donnerez resteront bien évidemment strictement privées et réservées. À aucun moment vos informations ne seront divulguées &agrave; d\'autres parties pour aucune action ou propos commercial. Toutes ces informations ne servent à '.STORE_NAME.' que pour mieux vous suivre et vous servir...<br><br> Vous pourrez à tout moment voir, mettre à jour ou supprimer les informations que vous nous aurez données. Il vous suffira pour cela de vous identifier sur notre site et de cliquer sur le lien "Mon compte" Vous gardez ainsi à tout moment le plein contrôle sur les informations que vous nous avez transmises...</font><br><br>');

define('EMAIL_ACCOUNT_DETAILS', 'Account Details:');
define('EMAIL_ACCOUNT_USERNAME', 'Username:');
define('ACCOUNT_PASSWORD', 'Password:');
define('EMAIL_SUBJECT', 'Bienvenue sur ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Cher Mr. ' . stripslashes($_POST['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_MS', 'Chère Ms. ' . stripslashes($_POST['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_NONE', 'Cher ' . stripslashes($_POST['firstname']) . ',' . "\n\n");
define('EMAIL_WELCOME', 'Nous vous souhaitons la bienvenue sur <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'Vous pouvez désormais accéder à nos services :' . "\n\n" . '<li><b>Un panier permanent</b>' . "\n" . '----------------' . "\n\n" . '     Tous les articles resteront dans votre panier jusqu\'à ce que vous conformiez votre commande. Vous pouvez à tout moment supprimer les articles de votre choix.' . "\n\n" . '<li><b>Carnet d\'adresses</b>' . "\n" . '-----------------' . "\n\n" . '     Vous pouvez créer votre carnet d\'adresse, et nous demander la livraison à toute adresse de votre choix.' . "\n\n" . '<li><b>Historique des commandes</b>' . "\n" . '------------------------' . "\n\n" . '     Vous avez accès à l\'historique de vos commandes sur votre compte.' . "\n\n" . '<li><b>Vos suggestions</b>' . "\n" . '---------------' . "\n\n" . '     N\'hésitez pas à exprimer vos opinions sur le site '.STORE_NAME.'.' . "\n\n\n");
define('EMAIL_CONTACT', 'Pour toute aide sur les services, merci de contacter : ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', 'Nous vous remercions pour la confiance que vous nous témoigniez en vous enregistrant comme nouveau client sur le site ' . HTTP_COOKIE_DOMAIN . "\n\n" . '<b>Observation :</b> ' . HTTP_COOKIE_DOMAIN . ' ne saurait en aucun cas être responsable des utilisations qui pourraient être effectuées sur une boîte email d\'une tierce personne.');
// BOF - MOD: CREDIT CLASS Gift Voucher Contribution
define('EMAIL_GV_INCENTIVE_HEADER', "\n\n" .'Pour votre bienvenue comme nouveau client, nous vous avons envoyé un chèque cadeaux d\'une valeur de %s');
define('EMAIL_GV_REDEEM', 'Le code de ce chèque cadeau est : %s, vous pouvez entrer ce code au moment de votre commande');
define('EMAIL_GV_LINK', 'ou en suivant ce lien ');
define('EMAIL_COUPON_INCENTIVE_HEADER', "\n\n" .'Félicitations, pour votre première visite à notre magasin en ligne, pour vous remercier nous vous envoyons une remise par coupon.' . "\n" .
                                        ' Ci-dessous les détails du Coupon de Remise créé juste pour vous.' . "\n");
define('EMAIL_COUPON_REDEEM', 'Utiliser le coupon %s au moment de votre commande');
// EOF - MOD: CREDIT CLASS Gift Voucher Contribution
?>