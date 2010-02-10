<?php
/*
  $Id: psigate.php,v 1.3 2002/11/18 14:45:25 project3000 Exp $

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright (c) 2002 osCommerce

  Released under the GNU General Public License
*/

  define('MODULE_PAYMENT_PSIGATE_TEXT_TITLE', 'PSiGate');
  define('MODULE_PAYMENT_PSIGATE_TEXT_DESCRIPTION', 'Information test carte de cr&eacute;dit&nbsp;:<br><br>CC#: 4111111111111111<br>Expire&nbsp;: Toute date');
  define('MODULE_PAYMENT_PSIGATE_TEXT_CREDIT_CARD_OWNER', 'Titulaire carte de cr&eacute;dit&nbsp;:');
  define('MODULE_PAYMENT_PSIGATE_TEXT_CREDIT_CARD_NUMBER', 'Num&eacute;ro carte de cr&eacute;dit&nbsp;:');
  define('MODULE_PAYMENT_PSIGATE_TEXT_CREDIT_CARD_EXPIRES', 'Date d\'expiration carte de cr&eacute;dit&nbsp;:');
  define('MODULE_PAYMENT_PSIGATE_TEXT_TYPE', 'Type&nbsp;:');
  define('MODULE_PAYMENT_PSIGATE_TEXT_JS_CC_NUMBER', '* Le numéro de la carte doit avoir au moins ' . CC_NUMBER_MIN_LENGTH . ' caractères.\n');
  define('MODULE_PAYMENT_PSIGATE_TEXT_ERROR_MESSAGE', 'Une erreur s\'est produite dans le traitement de votre carte de cr&eacute;dit. Veuillez essayer &agrave; nouveau.');
  define('MODULE_PAYMENT_PSIGATE_TEXT_ERROR', 'Erreur carte de cr&eacute;dit&nbsp;!');
?>