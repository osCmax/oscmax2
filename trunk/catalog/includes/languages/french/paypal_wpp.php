<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
// Copyright 2008 Brian Burton

  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_TITLE', 'Paiement direct par PayPal');
  define('MODULE_PAYMENT_PAYPAL_EC_TEXT_TITLE', 'Paiement express apr Paypal');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_DESCRIPTION', '<center><b><h2>PayPal Pro pour osCommerce 2.2MS2+</h2> Paiement direct & Express de Paypal<br><br><i>Développé et maintenu par:</i><br><a href="http://forums.oscommerce.com/index.php?showuser=80233">Brian Burton (dynamoeffects)</a></b></center>');
  define('MODULE_PAYMENT_PAYPAL_DP_ERROR_HEADING', 'Nous sommes désolés, mais nous n\'avons pas pu traiter votre carte de crédit.');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CARD_ERROR', 'Les informations de carte de crédit que vous avez entré contient une erreur. S\'il vous plaît vérifiez et essayez de nouveau.');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_FIRSTNAME', 'Prénom sur la carte de crédit:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_LASTNAME', 'Nom de famile sur la carte de crédit:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_TYPE', 'Type de carte de crédit:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_NUMBER', 'Numéro de carte de crédit:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_EXPIRES', 'Date d\'expiration de carte de crédit:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_CHECKNUMBER', 'Code de sécurité des cartes de crédit:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_CHECKNUMBER_LOCATION', 'Qu\'est-que s\'est?');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_START_MONTH', 'Maestro mois de début :');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_START_YEAR', 'Maestro l\'année de début:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_ISSUE_NUMBER', 'Maestro numéro:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_SWITCHSOLO_ONLY', '(nécessaire uniquement pour cartes Maestro)');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_DECLINED', 'Votre carte de crédit a été refusée. S\'il vous plaît essayez avec une autre carte ou contacter votre banque pour plus d\'infos.<br><br>');
  define('MODULE_PAYMENT_PAYPAL_DP_INVALID_RESPONSE', 'PayPal a renvoyé des données invalides ou incomplètes pour compléter votre commande. S\'il vous plaît essayer de nouveau ou de sélectionner une mode de paiement alternative.<br><br>');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_GEN_ERROR', 'Une erreur s\'est produite lorsque nous avons essayé de contacter des serveurs de PayPal.<br><br>');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_ERROR', 'Une erreur s\'est produite lorsque nous avons essayé de traiter votre carte de crédit.<br><br>');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_UNVERIFIED', 'Pour maintenir un niveau élevé de sécurité, les clients utilisant Express Checkout doit être des clients vérifiés de PayPal. S\'il vous plaît vérifier votre compte shez PayPal ou choisez un autre moyen de paiement.');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_BAD_CARD', 'Nous nous excusons pour ce désagrément, mais PayPal accepte uniquement les cartes Visa, Master Card, Discover et American Express. S\'il vous plaît utiliser une carte de crédit différente.');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_BAD_LOGIN', 'Il y avait un problème de validation de votre compte. S\'il vous plaît essayez de nouveau.');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_JS_CC_OWNER', '* Le nom du propriétaire de la carte de crédit doit avoir au moins ' . CC_OWNER_MIN_LENGTH . ' charactèrs.\n');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_JS_CC_NUMBER', '* Le numéro de carte de crédit doit avoir au moins ' . CC_NUMBER_MIN_LENGTH . ' charactèrs.\n');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_JS_CC_CVV2', '* Vous devez entrer le numéro de contrôle qui se trouve sur le verso de votre carte.\n');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_EC_HEADER', 'C\'est rapide et sécurisé avec PayPal:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_BUTTON_TEXT', 'Gagnez du temps et payer en toute sécurité.<br>Payer sans partager vos informations financières.');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_STATE_ERROR', 'L\'état attribué à votre compte n\'est pas valide. S\'il vous plaît aller dans les paramètres de votre compte et rectifiez le probléme.');
  define('MODULE_PAYMENT_PAYPAL_DP_MISSING_XML', 'PayPal WPP installation incomplète! Il devrait y avoir des fichiers XML situés dans ' . DIR_FS_CATALOG . DIR_WS_INCLUDES . 'paypal_wpp/xml/ !');
  define('MODULE_PAYMENT_PAYPAL_DP_CURL_NOT_INSTALLED', 'cURL, qui est requis par le module de payement PayPal Pro, n\'est pas présent.  S\'il vous plaît contactez votre hébergeur et lui demander que ce soit installé.');
  define('MODULE_PAYMENT_PAYPAL_DP_CERT_NOT_INSTALLED', 'Le certificat e l\'API du payement Pro n\'a pas pu être trouvé. S\'il vous plaît vérifier l\'emplacement de votre section d\'administration.');
  define('MODULE_PAYMENT_PAYPAL_DP_GEN_ERROR', 'Paiement non traitées!');
  define('MODULE_PAYMENT_PAYPAL_EC_ALTERNATIVE', '<hr /><p align="center">ou vous pouvez utiliser</p><hr />');
  define('MODULE_PAYMENT_PAYPAL_DP_BUG_1629', 'Votre magasin dispose d\'un bug dans checkout_process.php qui empêche ce module de fonctioné. S\'il vous plaît lisez la section de dépannage du READ_ME.htm fourni avec le module pour plus d\'informations.');
  define('MODULE_PAYMENT_PAYPAL_EC_TEXT_DECLINED', 'Votre transaction de PayPal a été refusée. S\'il vous plaît sélectionner un mode différent.<br><br>');
?>