<?php
/*
$Id: efsnet.php 982 2011-01-06 02:53:12Z michael.oscmax@gmail.com $

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
  define('MODULE_PAYMENT_EFSNET_TEXT_TITLE', 'EFSNet');
  define('MODULE_PAYMENT_EFSNET_TEXT_DESCRIPTION', 'Credit Card Test Info:<br><br>CC#: 4111111111111111<br>Expiry: Any');
  define('MODULE_PAYMENT_EFSNET_TEXT_TYPE','Type:');
  define('MODULE_PAYMENT_EFSNET_TEXT_CREDIT_CARD_OWNER','Titulaire de la carte de crédit:');
  define('MODULE_PAYMENT_EFSNET_TEXT_CREDIT_CARD_NUMBER','Numéro de carte de crédit:');
  define('MODULE_PAYMENT_EFSNET_TEXT_CREDIT_CARD_EXPIRES','Date d\'expiration de la carte:');
  define('MODULE_PAYMENT_EFSNET_TEXT_JS_CC_OWNER','* Le propriétaire nom de la carte de crédit doit être au moins ' . CC_OWNER_MIN_LENGTH . 'caractères.');
  define('MODULE_PAYMENT_EFSNET_TEXT_JS_CC_NUMBER','* Le numéro de carte de crédit doit être au moins ' . CC_NUMBER_MIN_LENGTH . ' caractères. \n');
  define('MODULE_PAYMENT_EFSNET_TEXT_ERROR_MESSAGE','Il ya eu une erreur de traitement de votre carte de crédit. S\'il vous plaît essayez de nouveau.');
  define('MODULE_PAYMENT_EFSNET_TEXT_DECLINED_MESSAGE','Votre carte de crédit a été refusée. S\'il vous plaît essayer une autre carte ou contactez votre banque pour plus d\'infos.');
  define('MODULE_PAYMENT_EFSNET_TEXT_ERROR','Erreur de carte de crédit!');
?>
