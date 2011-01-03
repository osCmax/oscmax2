<?php
/*
$Id$
  Recover Cart Sales v 1.4 FRENCH Language File

  Recover Cart Sales contrib: JM Ivler (c)
  osCmax e-Commerce
  http://www.oscmax.com

  Released under the GNU General Public License

  Modifed by Aalst (recover_cart_sales.php,v 1.2 .. 1.36)
  aalst@aalst.com
  
  Modifed by willross (recover_cart_sales.php,v 1.4)
  reply@qwest.net
  - don't forget to flush the 'scart' db table every so often

  Modifed by Lane (stats_recover_cart_sales.php,v 1.4d .. 2.22)
  lane@ifd.com www.osc-modsquad.com / www.ifd.com
*/

define('MESSAGE_STACK_CUSTOMER_ID', 'Panier pour Client-ID ');
define('MESSAGE_STACK_DELETE_SUCCESS', ' suppression réussie');
define('HEADING_TITLE', 'Traiter les paniers non validés v2.22');
define('HEADING_EMAIL_SENT', 'rapport par e-mail');
define('EMAIL_TEXT_LOGIN', 'Login to your account here:');
define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Demande de '.  STORE_NAME );
define('EMAIL_TEXT_SALUTATION', 'Dear ' );
define('EMAIL_TEXT_NEWCUST_INTRO', "\n\n" . 'Vous avez choisi ' . STORE_NAME .
                                   ' pour vos achats. ');
define('EMAIL_TEXT_CURCUST_INTRO', "\n\n" . 'Nous vous remercions des achats que vous avez déja passés sur ' . STORE_NAME . '. ');
define('EMAIL_TEXT_BODY_HEADER', 'Nous avons remarqué que lors d\'une visite sur notre boutique vous avez choisi les articles suivants:' . "\n\n");
define('EMAIL_TEXT_BODY_FOOTER', 'Nous serions intéressés pour savoir ce qui s\'est produit et s\'il y avait une raison pour laquelle vous
avez décidé de ne pas acheter avec ' . STORE_NAME . '.' .
                                 "\n\n" . 'Auriez vous l\'amabilité de nous expliquer la raison de la non finalisation de votre commande? Toujours soucieux de proposer le meilleur service, votre expérience nous permettrait d\'améliorer nos propositions.' .
                                 "\n\n" . 'Cordialement,' ."\n\n");
define('DAYS_FIELD_PREFIX', 'Montrer depuis les derniers ');
define('DAYS_FIELD_POSTFIX', ' jours ');
define('DAYS_FIELD_BUTTON', 'Go');
define('TABLE_HEADING_DATE', 'DATE');
define('TABLE_HEADING_CONTACT', 'CONTACT');
define('TABLE_HEADING_CUSTOMER', 'NOM');
define('TABLE_HEADING_EMAIL', 'E-MAIL');
define('TABLE_HEADING_PHONE', 'TELEPHONE');
define('TABLE_HEADING_MODEL', 'MODEL');
define('TABLE_HEADING_DESCRIPTION', 'ARTICLE');
define('TABLE_HEADING_QUANTY', 'QTY');
define('TABLE_HEADING_PRICE', 'PRIX');
define('TABLE_HEADING_TOTAL', 'TOTAL');
define('TABLE_GRAND_TOTAL', 'Grand Total: ');
define('TABLE_CART_TOTAL', 'Panier Total: ');
define('TEXT_CURRENT_CUSTOMER', 'CUSTOMER');
define('TEXT_SEND_EMAIL', 'Envoyer e-mail');
define('TEXT_RETURN', '[Retour]');
define('TEXT_NOT_CONTACTED', 'Non contacté');
define('PSMSG', 'facultatif PS Message: ');
?>