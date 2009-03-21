<?php
/*
  $Id: create_account.php,v 1.11 2003/07/24 13:58:31 Strider Exp $
  $Id: create_account.php,v 1.11 2003/07/05 13:58:31 hpdl Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2003 osCommerce

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Créer un compte');

define('HEADING_TITLE', 'Créer un compte');

define('TEXT_ORIGIN_LOGIN', '<font color="#000000">Ouvrir un compte sur '.STORE_NAME.' est absolument gratuit !<br><br>Toutes les informations que vous nous donnerez resteront bien évidemment strictement privées et réservées. A aucun moment vos informations ne seront divulguées &agrave; d\'autres parties ou pour aucune action ou propos commercial. Toutes ces informations ne servent à '.STORE_NAME.' que pour mieux vous suivre et vous servir...<br><br> Vous pourrez à tout moment voir, mettre à jour ou supprimer les informations que vous nous aurez données. Il vous suffira pour cela de vous identifier sur notre site et de cliquer sur le lien "Mon compte" Vous garder ainsi à tout moment le plein contrôle sur les informations que vous nous avez transmis...</font><br><br>');

define('EMAIL_SUBJECT', 'Bienvenue chez' . STORE_NAME);
define('EMAIL_GREET_MR', 'Cher Mr. ' . stripslashes($HTTP_POST_VARS['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_MS', 'Chère Ms. ' . stripslashes($HTTP_POST_VARS['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_NONE', 'Cher ' . stripslashes($HTTP_POST_VARS['firstname']) . ',' . "\n\n");
define('EMAIL_WELCOME', 'Nous vous souhaitons la bienvenue sur <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'Vous pouvez désormais accéder à nos services, suivant :' . "\n\n" . '<li><b>Panier permanent</b>' . "\n" . '----------------' . "\n\n" . '     Tous les articles resteront dans votre panier jusqu\'à ce que vous soldiez votre commande. Vous pouvez à tout moment supprimer les articles de votre choix.' . "\n\n" . '<li><b>Carnet d\'adresses</b>' . "\n" . '-----------------' . "\n\n" . '     Vous pouvez créer votre carnet d\'adresse, et nous demander la livraison à toute adresse de votre choix.' . "\n\n" . '<li><b>Historique des commandes</b>' . "\n" . '------------------------' . "\n\n" . '     Vous avez accès à l\'historique de vos commandes sur votre compte.' . "\n\n" . '<li><b>Vos suggestions</b>' . "\n" . '---------------' . "\n\n" . '     N\'hésitez pas à exprimer vos opinions sur le site '.STORE_NAME.'.' . "\n\n\n");
define('EMAIL_CONTACT', 'Pour toute aide sur les services, merci de contacter : ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', 'Nous vous remercions pour la confiance que vous nous témoigniez en vous enregistrant comme nouveau client sur le site ' . HTTP_COOKIE_DOMAIN . "\n\n" . '<b>Observation :</b> ' . HTTP_COOKIE_DOMAIN . ' ne saurait en aucun cas responsable des utilisations qui pourrait être effectuées sur une boîte email d\'une tierce personne.');

// Start - CREDIT CLASS Gift Voucher Contribution
define('EMAIL_GV_INCENTIVE_HEADER', "\n\n" .'Pour votre bienvenue comme nouveaux clients, nous vous avons envoyé un chèque cadeaux d\'une valeur de %s');
define('EMAIL_GV_REDEEM', 'Le code de ce chèque cadeau est : %s, vous pouvez entrer ce code au moment de votre commande');
define('EMAIL_GV_LINK', 'ou en suivant ce lien ');
define('EMAIL_COUPON_INCENTIVE_HEADER', "\n\n" .'Félicitations, pour votre première visite à notre magasin en ligne, pour vous remerciez nous vous envoyons une remise par coupon.' . "\n" .
                                        ' Ci-dessous les détails du Coupon de Remise créé juste pour vous.' . "\n");
define('EMAIL_COUPON_REDEEM', 'Utiliser le coupon %s au moment de votre commande');
// End - CREDIT CLASS Gift Voucher Contribution
?>
