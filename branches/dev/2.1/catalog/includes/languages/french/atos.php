<?php
/*
  CyberPlus Paiement ATOS/SIPS for Banque Populaire
  (http://www.atos-group.com/sips/)

  This module has been developed to fit latest osCommerce product requirement
  by e-network (http://www.e-network.fr/).

  It is compatible with version 2.2 MS1 or higher of the osCommerce
  product.

  You MUST have the ATOS/SIPS API version 5.00 or higher.
  This API has been released on september 2002.

  Originally written by D. Nazim (a.k.a. vanadium2 <vanadium2@yahoo.com>).

  Modified and enhanced to fit new purchase process of the osCommerce and
  new ATOS/SIPS binaries by S. Guiboud-Ribaud <devteam@e-network.fr>.

  Copyright 2000 - 2011 osCmax

  Release under the GNU General Public License.
*/

  define('MODULE_PAYMENT_ATOS_TEXT_TITLE', 'Carte de Crédit');

  define('MODULE_PAYMENT_ATOS_TEXT_TITLE_DEMOMODE', 'Ce mode de paiement est en démonstration. Il sera bientôt disponible et vous pourrez effectuer vos paiements en toute sécurité par carte bancaire. Vous pouvez essayer cette démonstration, mais pour effectuer réellement votre transaction, il vous faudra utiliser un autre mode de paiement');

  define('MODULE_PAYMENT_ATOS_TEXT_DESCRIPTION', 'Carte de Crédit / SIPS-ATOS');
  define('MODULE_PAYMENT_ATOS_TEXT_EMAIL_FOOTER', '');
  define('MODULE_PAYMENT_ATOS_TEXT_ERROR_MESSAGE', 'Erreur de traitement. Essayer à nouveau.');

  define('MODULE_PAYMENT_ATOS_CALL_REQUEST_ERROR', 'Une erreur inattendue est arrivée au cours de la demande.<br>Veuillez choisir un autre moyen de paiement.<br>');

  define('MODULE_PAYMENT_ATOS_PAYMENT_MEANS_CB',         'Carte Bleue');
  define('MODULE_PAYMENT_ATOS_PAYMENT_MEANS_VISA',       'VISA');
  define('MODULE_PAYMENT_ATOS_PAYMENT_MEANS_AMEX',       'American Express');
  define('MODULE_PAYMENT_ATOS_PAYMENT_MEANS_MASTERCARD', 'Eurocard/Mastercard');

  define('MODULE_PAYMENT_ATOS_ERROR_02', 'Referral, authorization required by phone');
  define('MODULE_PAYMENT_ATOS_ERROR_03', 'Merchand id invalid : contact ATOS support');
  define('MODULE_PAYMENT_ATOS_ERROR_05', 'Transaction cancelled. No detail about security.');
  define('MODULE_PAYMENT_ATOS_ERROR_12', 'Invalid amount');
  define('MODULE_PAYMENT_ATOS_ERROR_13', 'Invalid transaction, fields invalId$
  define('MODULE_PAYMENT_ATOS_ERROR_17', 'Cancelled by customer');
  define('MODULE_PAYMENT_ATOS_ERROR_30', 'Format error: contact ATOS hotline for more details');
  define('MODULE_PAYMENT_ATOS_ERROR_63', 'HIGH PROBLEM OF SECURITY: must log out the customer and remove its session id');
  define('MODULE_PAYMENT_ATOS_ERROR_75', 'More than 3 tries failed');
  define('MODULE_PAYMENT_ATOS_ERROR_90', 'Service unavailable');
  define('MODULE_PAYMENT_ATOS_ERROR_94', 'Transaction already played');
  define('MODULE_PAYMENT_ATOS_ERROR_INVALID_CODE', 'Invalid error code');

  define('MODULE_PAYMENT_ATOS_CERTIFICATE_NAME_CYBERPLUS',    'Test CyberPlus (Banque Populaire)');
  define('MODULE_PAYMENT_ATOS_CERTIFICATE_NAME_ETRANSACTION', 'Test E-Transactions (Crédit Agricole)');
  define('MODULE_PAYMENT_ATOS_CERTIFICATE_NAME_MERCANET',     'Test Mercanet (BNP Paribas)');
  define('MODULE_PAYMENT_ATOS_CERTIFICATE_NAME_SOGENACTIF',   'Test Sogénactif (Société Général)');
  define('MODULE_PAYMENT_ATOS_CERTIFICATE_NAME_SCELLIUS',     'Test Scellius (La Poste)');
  define('MODULE_PAYMENT_ATOS_CERTIFICATE_NAME_SHERLOCKS',    'Test Sherlocks (Crédit Lyonnais)');
?>
