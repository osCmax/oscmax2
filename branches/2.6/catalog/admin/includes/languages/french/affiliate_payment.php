<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Paiement des affiliés');
define('HEADING_TITLE_SEARCH', 'Rechercher:');
define('HEADING_TITLE_STATUS', 'Statut:');

define('TEXT_ALL_PAYMENTS', 'Tous les paiements');
define('TEXT_NO_PAYMENT_HISTORY', 'Pas d\'historique de paiement disponible');

define('TABLE_HEADING_ACTION', 'Action');
define('TABLE_HEADING_STATUS', 'Statut');
define('TABLE_HEADING_AFILIATE_NAME', 'Affiliation');
define('TABLE_HEADING_PAYMENT', 'Paiement (incl.)');
define('TABLE_HEADING_NET_PAYMENT', 'Paiement (excl.)');
define('TABLE_HEADING_DATE_BILLED','Date facturée');
define('TABLE_HEADING_NEW_VALUE', 'Nouvelle valeur');
define('TABLE_HEADING_OLD_VALUE', 'Ancienne valeur');
define('TABLE_HEADING_AFFILIATE_NOTIFIED', 'Affilié Notifié');
define('TABLE_HEADING_DATE_ADDED', 'Date Ajoutée');

define('TEXT_DATE_PAYMENT_BILLED', 'Facturé(e):');
define('TEXT_DATE_ORDER_LAST_MODIFIED', 'Dernière modification le :');
define('TEXT_AFFILIATE_PAYMENT', 'Paiement gagné par affilié');
define('TEXT_AFFILIATE_BILLED', 'Jour de paie');
define('TEXT_AFFILIATE', 'Affiliation');
define('TEXT_INFO_DELETE_INTRO', 'Souhaitez-vous réellement supprimé ce paiement ?');
define('TEXT_DISPLAY_NUMBER_OF_PAYMENTS', 'Affiche <b>%d</b> à <b>%d</b> (sur <b>%d</b> paiements)');

define('TEXT_AFFILIATE_PAYING_POSSIBILITIES', 'Vous pouvez réglé votre affilié par :');
define('TEXT_AFFILIATE_PAYMENT_CHECK', 'Chèque:');
define('TEXT_AFFILIATE_PAYMENT_CHECK_PAYEE', 'A l\'ordre de:');
define('TEXT_AFFILIATE_PAYMENT_PAYPAL', 'PayPal:');
define('TEXT_AFFILIATE_PAYMENT_PAYPAL_EMAIL', 'Compte e-mail PAYPAL:');
define('TEXT_AFFILIATE_PAYMENT_BANK_TRANSFER', 'Transaction bancaire:');
define('TEXT_AFFILIATE_PAYMENT_BANK_NAME', 'Nom de la banque :');
define('TEXT_AFFILIATE_PAYMENT_BANK_ACCOUNT_NAME', 'Nom du compte :');
define('TEXT_AFFILIATE_PAYMENT_BANK_ACCOUNT_NUMBER', 'Numéro du compte :');
define('TEXT_AFFILIATE_PAYMENT_BANK_BRANCH_NUMBER', 'Numéro ABA/BSB (numéro de branche):');
define('TEXT_AFFILIATE_PAYMENT_BANK_SWIFT_CODE', 'SWIFT Code:');

define('TEXT_INFO_HEADING_DELETE_PAYMENT', 'Effacer le paiement');

define('IMAGE_AFFILIATE_BILLING', 'Mise en route du Moteur de Facturation ');

define('ERROR_PAYMENT_DOES_NOT_EXIST', 'Paiement inexistant');

define('SUCCESS_BILLING', 'Votre affilié a bien été facturé');
define('SUCCESS_PAYMENT_UPDATED', 'Le statut du paiement a bien été mis à jour');

define('PAYMENT_STATUS', 'Statut de paiement');
define('PAYMENT_NOTIFY_AFFILIATE', 'Informer l\'affilié');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('EMAIL_TEXT_SUBJECT', 'Paiement Mis à jour');
define('EMAIL_TEXT_AFFILIATE_PAYMENT_NUMBER', 'Paiement Numéro:');
define('EMAIL_TEXT_INVOICE_URL', 'Facture détaillée:');
define('EMAIL_TEXT_PAYMENT_BILLED', 'Date affichée');
define('EMAIL_TEXT_STATUS_UPDATE', 'Votre paiement a été mis à jour vers le statut suivant..' . "\n\n" . 'New status: %s' . "\n\n" . 'Merci de répondre à cet e-mail si vous avez des questions..' . "\n");
define('EMAIL_TEXT_NEW_PAYMENT', 'Une nouvelle facture est arrivée dans vos paiements' . "\n");
?>
