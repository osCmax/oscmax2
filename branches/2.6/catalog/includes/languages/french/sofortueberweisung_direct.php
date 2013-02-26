<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

    define('MODULE_PAYMENT_SOFORTUEBERWEISUNG_DIRECT_TEXT_DESCRIPTION', '<img src="images/icons/icon_popup.gif" border="0" alt="">&nbsp;<a href="https://www.payment-network.com/deb_com_fr" target="_blank" style="text-decoration: underline; font-weight: bold;">Visiter le site de Sofortbanking</a>&nbsp;<a href="javascript:toggleDivBlock(\'sofortueberweisungInfo\');">(info)</a><span id="sofortueberweisungInfo" style="display: none;"><br><i>En utilisant le lien ci-dessus pour référer un client, osCmax reçoit un petit bonus.</i></span><br><br>Infos test du numéro de compte:<br><br>BLZ#: 88888888');


  define('MODULE_PAYMENT_SOFORTUEBERWEISUNG_DIRECT_TEXT_TITLE', 'SofortBanking');
  define('MODULE_PAYMENT_SOFORTUEBERWEISUNG_DIRECT_TEXT_PUBLIC_TITLE', 'SofortBanking');

  // checkout_payment Informationen via Bild
  define('MODULE_PAYMENT_SOFORTUEBERWEISUNG_DIRECT_TEXT_DESCRIPTION_CHECKOUT_PAYMENT', '
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><a href="#" onclick="window.open(\'https://www.sofortueberweisung.de/cms/index.php?vpartner=21\', \'Popup\',\'toolbar=yes,status=no,menubar=no,scrollbars=yes,width=690,height=500\'); return false;">' . tep_image('ext/modules/payment/sofortueberweisung/images/sofortueberweisung.gif', 'Sofortüberweisung ist der kostenlose, TÜV-zertifizierte Zahlungsdienst der Payment Network AG. Ihre Vorteile: keine zusätzliche Registrierung, automatische Abbuchung von Ihrem Online-Bankkonto, höchste Sicherheitsstandards und sofortiger Versand von Lagerware. Für die Bezahlung mit Sofortüberweisung benötigen Sie Ihre eBanking Zugangsdaten, d.h. Bankverbindung, Kontonummer, PIN und TAN.') . '</a></td>
      </tr>
    </table>');

  define('MODULE_PAYMENT_SOFORTUEBERWEISUNG_DIRECT_TEXT_DESCRIPTION_CHECKOUT_CONFIRMATION', '
    <table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td class="main"><p>Nach Bestätigung der Bestellung werden Sie zum Zahlungssytem von Sofortüberweisung weitergeleitet und können dort eine Online-Überweisung duchführen.</p><p>Hierfür benötigen Sie Ihre eBanking Zugangsdaten, d.h. Bankverbindung, Kontonummer, PIN und TAN. Mehr Informationen finden Sie hier: <a href="#" onclick="window.open(\'https://www.sofortueberweisung.de/cms/index.php?vpartner=21\', \'Popup\',\'toolbar=yes,status=no,menubar=no,scrollbars=yes,width=690,height=500\'); return false;">http://www.sofortueberweisung.de</a>.</p></td>
      </tr>
    </table>');

 // les balise suivantes sont utilisé dans la comunication:
 // {{order_date}} par date de commande
 // {{customer_id}} par numméro client de la base de données
 // {{customer_name}}  par le nom du client
 // {{customer_company}} par le nom de la société du client
 // {{customer_email}} par le courrielle du client

  define('MODULE_PAYMENT_SOFORTUEBERWEISUNG_DIRECT_TEXT_V_ZWECK_1', STORE_NAME);  // max 27 caractères
  define('MODULE_PAYMENT_SOFORTUEBERWEISUNG_DIRECT_TEXT_V_ZWECK_2', 'Nr. {{orderid}} Kd-Nr. {{customer_id}}'); // max 27 caractères
  define('MODULE_PAYMENT_SOFORTUEBERWEISUNG_DIRECT_TEXT_EMAIL_FOOTER', '');
  define('MODULE_PAYMENT_SOFORTUEBERWEISUNG_DIRECT_TEXT_REDIRECT', 'Vous allez être redirigé vers Sofortueberweisung.de. Si cela ne se produira pas s\'il vous plaît appuyez sur le bouton');

  define('MODULE_PAYMENT_SOFORTUEBERWEISUNG_DIRECT_TEXT_ERROR_HEADING', 'L\'erreur suivante a été rapportée pendant le processus de Sofortüberweisung:');
  define('MODULE_PAYMENT_SOFORTUEBERWEISUNG_DIRECT_TEXT_ERROR_MESSAGE', 'Le payement par Sofortüberweisung est malheureusement pas possible, ou a été annulée par le client. S\'il vous plaît choisir un autre mode de paiement.');
  define('MODULE_PAYMENT_SOFORTUEBERWEISUNG_DIRECT_TEXT_CHECK_ERROR', 'La vérification de la transaction de Sofortüberweisungs a échoué. S\'il vous plaît vérifier manuellement');
?>
