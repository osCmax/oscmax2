<?php
/*
$Id: recover_cart_sales.php 3 2006-05-27 04:59:07Z user $
  Recover Cart Sales v 1.4 FRENCH Language File

  Recover Cart Sales contrib: JM Ivler (c)
  osCMax Power E-Commerce
  http://oscdox.com

  Released under the GNU General Public License

  Modifed by Aalst (recover_cart_sales.php,v 1.2)
  aalst@aalst.com
  Nov 28th 2003

  Modifed by Aalst (recover_cart_sales.php,v 1.3)
  aalst@aalst.com
  Nov 29th 2003

  Modifed by Aalst (recover_cart_sales.php,v 1.3.5)
  aalst@aalst.com
  Nov 30th 2003

  Modifed by Aalst (recover_cart_sales.php,v 1.3.6)
  aalst@aalst.com
  Dec 2nd 2003
  
  Modifed by willross (recover_cart_sales.php,v 1.4)
  reply@qwest.net
  Mar 31st 2004
  - don't forget to flush the 'scart' db table every so often

  Modifed by Lane (stats_recover_cart_sales.php,v 1.4d)
  lane@ifd.com www.osc-modsquad.com / www.ifd.com
  Nov 12, 2004
*/

define('MESSAGE_STACK_CUSTOMER_ID', 'Panier pour Client-ID ');
define('MESSAGE_STACK_DELETE_SUCCESS', ' suppression réussie');
define('HEADING_TITLE', 'Traiter les paniers non validés');
define('HEADING_EMAIL_SENT', 'rapport par e-mail');
define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Demande de '.  STORE_NAME );
define('EMAIL_TEXT_SALUTATION', 'Cher ' );
define('EMAIL_TEXT_NEWCUST_INTRO', "\n\n" . 'Vous avez choisi ' . STORE_NAME .
                                   ' pour vos achats. ');
define('EMAIL_TEXT_CURCUST_INTRO', "\n\n" . 'Nous vous remercions des achats que vous avez déja
                                   passés sur ' . STORE_NAME . '. ');
define('EMAIL_TEXT_COMMON_BODY', 'Nous avons remarqué que lors d\'une visite sur notre boutique
                                  vous avez choisi les articles suivants:' . "\n%s\n\n" . 'Nous
                                  serions intéressés pour savoir ce qui s\'est produit et s\'il y
                                  avait une raison pour laquelle vous avez décidé de ne pas acheter
                                  avec ' . STORE_NAME . '.' . "\n\n" . 'Auriez vous l\'amabilité de
                                  nous expliquer la raison de la non finalisation de votre commande?
                                  Toujours soucieux de proposer le meilleur service, votre expérience
                                  nous permettrait d\'améliorer nos propositions.' . "\n\n" . 
                                 'Cordialement,' ."\n\n" . STORE_OWNER . "\n". STORE_NAME . "\n".
                                 HTTP_SERVER . DIR_WS_CATALOG . "\n");
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