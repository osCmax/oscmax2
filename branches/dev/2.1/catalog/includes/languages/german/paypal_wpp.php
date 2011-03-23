<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/
// Copyright 2008 Brian Burton

  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_TITLE', 'PayPal Direct Payment');
  define('MODULE_PAYMENT_PAYPAL_EC_TEXT_TITLE', 'PayPal Express');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_DESCRIPTION', '<center><b><h2>PayPal Pro for osCommerce 2.2MS2+</h2>Direct Payment & Express Checkout<br><br><i>Developed and maintained by:</i><br><a href="http://forums.oscommerce.com/index.php?showuser=80233">Brian Burton (dynamoeffects)</a></b></center>');
  define('MODULE_PAYMENT_PAYPAL_DP_ERROR_HEADING', 'Bedauerlicherweise können wir Ihre Kreditkarte nicht verarbeiten.');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CARD_ERROR', 'Die Kreditkarteninformationen, die Sie eingegeben haben, beinhalten einen Fehler. Bitte überprüfen Sie Ihre Eingaben und versuchen Sie es erneut.');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_FIRSTNAME', 'Vorname laut Kreditkarte:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_LASTNAME', 'Nachname laut Kreditkarte:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_TYPE', 'Art der Kreditkarte:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_NUMBER', 'Kreditkartennummer:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_EXPIRES', 'Kreditkarten-Ablaufdatum:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_CHECKNUMBER', 'Kreditkarten-Sicherheitscode:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_CHECKNUMBER_LOCATION', 'Was ist das?');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_START_MONTH', 'Solo/Maestro gültig ab Monat:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_START_YEAR', 'Solo/Maestro gültig ab Jahr:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_ISSUE_NUMBER', 'Solo/Maestro Ausgabenummer:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_CREDIT_CARD_SWITCHSOLO_ONLY', '(nur nötig bei Maestro/Solo Karten)');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_DECLINED', 'Ihre Kreditkarte wurde abgelehnt. Verwenden Sie eine andere Karte oder kontaktieren Sie Ihre Bank für weitere Auskünfte.<br><br>');
  define('MODULE_PAYMENT_PAYPAL_DP_INVALID_RESPONSE', 'PayPal hat ungültige oder unvollständige Daten zum Abschluß Ihrer Bestellung gesendet. Bitte versuchen Sie es erneut oder wählen Sie eine andere Zahlungsart.<br><br>');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_GEN_ERROR', 'Beim Verbindungsversuch mit dem Paypal-Server ist ein Fehler aufgetreten.<br><br>');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_ERROR', 'Bei der Verarbeitung Ihrer Kreditkartenangaben ist ein Fehler aufgetreten.<br><br>');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_UNVERIFIED', 'Wenn Sie PayPal Express verwenden möchten, müssen Sie bestätigter PayPal Kunde sein.  Lassen Sie Ihr Konto bestätigen oder wählen Sie eine andere Zahlungsart aus.');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_BAD_CARD', 'Bedauerlicherweise akzeptiert PayPal ausschließlich Visa, Master Card, American Express und Discover. Bitte verwenden Sie eine andere Kreditkarte.');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_BAD_LOGIN', 'Bei der Überprüfung Ihres Kontos ist ein Problem aufgetreten. Bitte versuchen Sie es erneut.');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_JS_CC_OWNER', '* Der Name des Kreditkarteneigentümers muss aus mindestens ' . CC_OWNER_MIN_LENGTH . ' Zeichen bestehen.\n');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_JS_CC_NUMBER', '* Die Kreditkartennummer muss aus mindestens ' . CC_NUMBER_MIN_LENGTH . ' Zeichen bestehen.\n');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_JS_CC_CVV2', '* Sie müssen die CVV2 Nummer Ihrer Karte angeben.\n');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_EC_HEADER', 'Schneller, sicherer Kaufabschluß mit PayPal:');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_BUTTON_TEXT', 'Sparen Sie Zeit. Schließen Sie Ihren Einkauf sicher ab.<br>Bezahlen Sie, ohne Ihre Kontoinformationen preiszugeben.');
  define('MODULE_PAYMENT_PAYPAL_DP_TEXT_STATE_ERROR', 'Das angegebene Land in Ihrem Konto ist ungültig. Bitte ändern Sie das Land in Ihren Kontoeinstellungen.');
  define('MODULE_PAYMENT_PAYPAL_DP_MISSING_XML', 'Die PayPal WPP Installation ist unvollständig! Es sollten sich XML Dateien in ' . DIR_FS_CATALOG . DIR_WS_INCLUDES . 'paypal_wpp/xml/ befinden!');
  define('MODULE_PAYMENT_PAYPAL_DP_CURL_NOT_INSTALLED', 'cURL, die vom PayPal Website Payments Pro Modul benötigt wird, ist nicht vorhanden. Bitte kontaktieren Sie Ihren Webhoster und veranlassen Sie die Installation.');
  define('MODULE_PAYMENT_PAYPAL_DP_CERT_NOT_INSTALLED', 'Your Website Payments Pro API certificate could not be found.  Please check the location in your administration section.');
  define('MODULE_PAYMENT_PAYPAL_DP_GEN_ERROR', 'Die Zahlung konnte nicht durchgeführt werden!');
  define('MODULE_PAYMENT_PAYPAL_EC_ALTERNATIVE', '<hr /><p align="center">oder Sie verwenden</p><hr />');
  define('MODULE_PAYMENT_PAYPAL_DP_BUG_1629', 'Ihr Shop hat einen Bug in der checkout_process.php. Daher ist dieses Modul nicht funktionsfähig. Bitte lesen Sie den Troubleshooting Abschnitt von READ_ME.htm, die zu diesem Modul gehört.');
  define('MODULE_PAYMENT_PAYPAL_EC_TEXT_DECLINED', 'Ihre PayPal Transaktion wurde abgelehnt. Bitte wählen Sie eine andere Zahlungsart.<br><br>');
?>