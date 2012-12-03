<?php
/*
  $Id: quantumqgwdbe.php 1498 2011-07-21 01:43:31Z michael.oscmax@gmail.com $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License

  eProcessingNetwork.php was developed for eProcessingNetwork

  http://www.quantumgateway.com

  by

  Andres Roca - CDG Commerce
  andresr@cdgcommerce.com
*/

  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_TITLE', 'QuantumGateway');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_DESCRIPTION', 'Infos du test dela carte de cr&eacute;dit:<br><br>CC#: 4111111111111111<br>Expire: toute');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_TYPE', 'Type:');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_CREDIT_CARD_OWNER', 'Propri&eacute;taire de la carte:');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_CREDIT_CARD_NUMBER', 'Numm&eacute;ro de la carte de cr&eacute;dit:');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_CREDIT_CARD_EXPIRES', 'Date d\'expiration de la carte de cr&eacute;dit:');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_NOT_CVV', 'Cochez ici si vous ne pouvez pas taper le code CVV:');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_REASON_NOT_CVV', 'Pourquoi vous ne pouvez pas taper le code CVV?:');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_JS_CC_OWNER', '* Tle nom du propri&eacute;taire de la carte de cr&eacute;dit doit avoir au moins ' . CC_OWNER_MIN_LENGTH . ' charact&egrave;rs.\n');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_JS_CC_NUMBER', '* Le num&eacute;ro de carte de cr&eacute;dit doit avoir au moins ' . CC_NUMBER_MIN_LENGTH . ' characte&egrave;rs.\n');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_ERROR_MESSAGE', 'Il y a eu une erreur de traitement de votre carte de cr&eacute;dit. S\'il vous plaît essayez de nouveau.');
  define('MODULE_PAYMENT_QUANTUMQGWDBE_TEXT_ERROR', 'Erreur de carte de cr&eacute;dit!');
?>
