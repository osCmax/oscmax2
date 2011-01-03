<?php
/*
  $Id$

  osCommerce, Open Source E-Commerce Solutions
  http://www.oscommerce.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
  Based on Ausbank.php ; adapted/translated in French by Gelong Shenphen
*/

  define('MODULE_PAYMENT_VIREMENT_BANCAIRE_ACCNAM', 'Joe Lagrenouille');
  define('MODULE_PAYMENT_VIREMENT_BANCAIRE_ACCNUM', 'xxxxxx');
  define('MODULE_PAYMENT_VIREMENT_BANCAIRE_IBAN', 'xxxx-xxxx-xxxx-xxxx-xxxx-xxxx-xxx');
  define('MODULE_PAYMENT_VIREMENT_BANCAIRE_BIC', 'xxxxxxxx');
  define('MODULE_PAYMENT_VIREMENT_BANCAIRE_BANKNAM', 'Votre banque');
  define('MODULE_PAYMENT_VIREMENT_BANCAIRE_TEXT_TITLE', 'Paiement par Virement Bancaire');
  define('MODULE_PAYMENT_VIREMENT_BANCAIRE_TEXT_DESCRIPTION', '<BR>Utilisez les informations suivantes pour effectuer le virement de la somme totale de votre commande:<br><br>No de compte: ' . MODULE_PAYMENT_VIREMENT_BANCAIRE_ACCNUM . '<BR>Numéro IBAN: ' . MODULE_PAYMENT_VIREMENT_BANCAIRE_IBAN . '<br>Code BIC : ' . MODULE_PAYMENT_VIREMENT_BANCAIRE_BIC . '<BR>Titulaire du compte: ' . MODULE_PAYMENT_VIREMENT_BANCAIRE_ACCNAM . '<BR>Nom et domiciliation de la banque: ' . MODULE_PAYMENT_VIREMENT_BANCAIRE_BANKNAM . '<br><br>Votre commande sera postée à réception de votre paiement.');
  define('MODULE_PAYMENT_VIREMENT_BANCAIRE_TEXT_DESCRIPTION2', 'Gestion des coordonnées bancaires pour virement');
  define('MODULE_PAYMENT_VIREMENT_BANCAIRE_TEXT_EMAIL_FOOTER', "Utilisez les informations suivantes pour effectuer le virement de la somme totale de votre commande:\n\nNo du compte:  " . MODULE_PAYMENT_VIREMENT_BANCAIRE_ACCNUM . "\nNo IBAN:    " . MODULE_PAYMENT_VIREMENT_BANCAIRE_IBAN . "\nCode BIC:    " . MODULE_PAYMENT_VIREMENT_BANCAIRE_BIC . "\nTitulaire du compte: " . MODULE_PAYMENT_VIREMENT_BANCAIRE_ACCNAM . "\nNom et domiciliation de la banque:    " . MODULE_PAYMENT_VIREMENT_BANCAIRE_BANKNAM . "\n\nVotre commande sera postée à réception de votre paiement.");
?>
