<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
  
*/
// EXAMPLE TO MAKE REQUIRED VISIBLE
// define('ENTRY_STREET_ADDRESS_TEXT', '&nbsp;<small><font color="#AABBDD">required</font></small>');

// ### END ORDER MAKER ###
// pull down default text
define('PULL_DOWN_DEFAULT', 'Auswählen');
define('TYPE_BELOW', 'Unten eingeben');

define('JS_ERROR', 'Sie haben das Formular nicht korrekt ausgefüllt\nBitte korrigieren Sie die folgenden Angaben:\n\n');

define('JS_GENDER', '* Bitte das \'Geschlecht\' angeben.\n');
define('JS_FIRST_NAME', '* Der \'Vorname\' muss mindestens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen enthalten.\n');
define('JS_LAST_NAME', '* Der \'Nachname\' muss mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen enthalten.\n');
define('JS_DOB', '* Das \'Geburtsdatum\' muss im folgenden Format eingegeben werden: xx/xx/xxxx (Monat/Tag/Jahr).\n');
define('JS_EMAIL_ADDRESS', '* Die \'E-Mail-Adresse\' muss mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen enthalten.\n');
define('JS_ADDRESS', '* Die \'Straße\' muss mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen enthalten.\n');
define('JS_POST_CODE', '* Die \'Postleitzahl\' muss mindestens ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zeichen enthalten.\n');
define('JS_CITY', '* Der \'Ort\' muss mindestens ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen enthalten.\n');
define('JS_STATE', '* Ein \'Bundesland\' muss ausgewählt werden.\n');
define('JS_STATE_SELECT', '-- Oben auswählen --');
define('JS_ZONE', '* Ein \'Bundesland\' muss ausgewählt werden.\n');
define('JS_COUNTRY', '* Ein \'Land\' muss ausgewählt werden.\n');
define('JS_TELEPHONE', '* Die \'Telefonnummer\' muss mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen enthalten.\n');
define('JS_PASSWORD', '* Das \'Passwort\' und die \'Passwortwiederholung\' müssen übereinstimmen und mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen enthalten.\n');

define('CATEGORY_COMPANY', 'Firma');
define('CATEGORY_PERSONAL', 'Persönliche Angaben');
define('CATEGORY_ADDRESS', 'Adresse');
define('CATEGORY_CONTACT', 'Kontakt');
define('CATEGORY_OPTIONS', 'Optionen');
define('CATEGORY_PASSWORD', 'Passwort');
define('CATEGORY_CORRECT', 'Bitte prüfen Sie die nachstehenden Angaben und klicken Sie auf Bestätigen.');
define('ENTRY_CUSTOMERS_ID', 'Kunden ID:');
define('ENTRY_CUSTOMERS_ID_TEXT', '&nbsp;');
define('ENTRY_COMPANY', 'Company Name:');
define('ENTRY_COMPANY_ERROR', '');
define('ENTRY_COMPANY_TEXT', '');
define('ENTRY_GENDER', 'Gender:');
define('ENTRY_GENDER_FEMALE', 'Frau:');
define('ENTRY_GENDER_MALE', 'Herr:');
define('ENTRY_GENDER_ERROR', '&nbsp;');
define('ENTRY_GENDER_TEXT', '&nbsp;');
define('ENTRY_FIRST_NAME', 'Vorname:');
define('ENTRY_FIRST_NAME_ERROR', '&nbsp;<small><font color="#FF0000">mindestens ' . ENTRY_FIRST_NAME_MIN_LENGTH . ' Zeichen</font></small>');
define('ENTRY_FIRST_NAME_TEXT', '&nbsp;');
define('ENTRY_LAST_NAME', 'Last Name:');
define('ENTRY_LAST_NAME_ERROR', '&nbsp;<small><font color="#FF0000">mindestens ' . ENTRY_LAST_NAME_MIN_LENGTH . ' Zeichen</font></small>');
define('ENTRY_LAST_NAME_TEXT', '&nbsp;');
define('ENTRY_DATE_OF_BIRTH', 'Date of Birth:');
define('ENTRY_DATE_OF_BIRTH_ERROR', '&nbsp;<small><font color="#FF0000">(zB. 21.05.1970)</font></small>');
define('ENTRY_DATE_OF_BIRTH_TEXT', '&nbsp;<small>(zB 21.05.1970) ');
define('ENTRY_EMAIL_ADDRESS', 'E-Mail-Adresse:');
define('ENTRY_EMAIL_ADDRESS_ERROR', '&nbsp;<small><font color="#FF0000">mindestens ' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . ' Zeichen</font></small>');
define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '&nbsp;<small><font color="#FF0000">Ihre E-Mail-Adresse ist nicht gültig!</font></small>');
define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '&nbsp;<small><font color="#FF0000">Die E-Mail-Adresse wird bereits verwendet!</font></small>');
define('ENTRY_EMAIL_ADDRESS_TEXT', '&nbsp;');
define('ENTRY_STREET_ADDRESS', 'Straße:');
define('ENTRY_STREET_ADDRESS_ERROR', '&nbsp;<small><font color="#FF0000">mindestens ' . ENTRY_STREET_ADDRESS_MIN_LENGTH . ' Zeichen</font></small>');
define('ENTRY_STREET_ADDRESS_TEXT', '&nbsp;');
define('ENTRY_SUBURB', 'Ortsteil:');
define('ENTRY_SUBURB_ERROR', '');
define('ENTRY_SUBURB_TEXT', '');
define('ENTRY_POST_CODE', 'Postleitzahl:');
define('ENTRY_POST_CODE_ERROR', '&nbsp;<small><font color="#FF0000">mindestens ' . ENTRY_POSTCODE_MIN_LENGTH . ' Zeichen</font></small>');
define('ENTRY_POST_CODE_TEXT', '&nbsp;');
define('ENTRY_CITY', 'Ort:');
define('ENTRY_CITY_ERROR', '&nbsp;<small><font color="#FF0000">mindestens ' . ENTRY_CITY_MIN_LENGTH . ' Zeichen</font></small>');
define('ENTRY_CITY_TEXT', '&nbsp;');
define('ENTRY_STATE', 'Bundesland:');
define('ENTRY_STATE_ERROR', '&nbsp;');
define('ENTRY_STATE_TEXT', '&nbsp;');
define('ENTRY_COUNTRY', 'Land:');
define('ENTRY_COUNTRY_ERROR', '');
define('ENTRY_COUNTRY_TEXT', '&nbsp;');
define('ENTRY_TELEPHONE_NUMBER', 'Telefonnummer:');
define('ENTRY_TELEPHONE_NUMBER_ERROR', '&nbsp;<small><font color="#FF0000">mindestens ' . ENTRY_TELEPHONE_MIN_LENGTH . ' Zeichen</font></small>');
define('ENTRY_TELEPHONE_NUMBER_TEXT', '&nbsp;');
define('ENTRY_FAX_NUMBER', 'Fax Number:');
define('ENTRY_FAX_NUMBER_ERROR', '');
define('ENTRY_FAX_NUMBER_TEXT', '');
define('ENTRY_NEWSLETTER', 'Newsletter:');
define('ENTRY_NEWSLETTER_TEXT', '');
define('ENTRY_NEWSLETTER_YES', 'Abonniert');
define('ENTRY_NEWSLETTER_NO', 'Nicht abonniert');
define('ENTRY_NEWSLETTER_ERROR', '');
define('ENTRY_PASSWORD', 'Passwort:');
define('ENTRY_PASSWORD_CONFIRMATION', 'Passwort wiederholen:');
define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '&nbsp;');
define('ENTRY_PASSWORD_ERROR', '&nbsp;<small><font color="#FF0000">mindestens ' . ENTRY_PASSWORD_MIN_LENGTH . ' Zeichen</font></small>');
define('ENTRY_PASSWORD_TEXT', '&nbsp;');
define('PASSWORD_HIDDEN', '--VERSTECKT--');
// ### END ORDER MAKER ###
define('CREATE_ORDER_TEXT_EXISTING_CUST', 'Existierendes Kundenkonto');
define('CREATE_ORDER_TEXT_NEW_CUST', 'Neues Kundenkonto');
define('CREATE_ORDER_TEXT_NO_CUST', 'Ohne Kundenkonto');

define('HEADING_TITLE', 'Neue Bestellung');
define('TEXT_SELECT_CUST', '- Kunden auswählen -'); 

define('TEXT_SELECT_CURRENCY', '- Währung auswählen -');
define('TEXT_SELECT_CURRENCY_TITLE', 'Währung auswählen');
define('BUTTON_TEXT_SELECT_CUST', 'Kunden auswählen:'); 
define('TEXT_OR_BY', 'oder Kunden ID auswählen:'); 
define('TEXT_STEP_1', 'Wählen Sie einen Kunden, um seine Daten ins Formular zu übertragen oder geben Sie die Kundendaten manuell an.');
define('TEXT_STEP_2', 'Schritt 2 - Bestätigen Sie die Angaben oder geben Sie neue Kunden/Versand/Rechnungs-angaben ein.');
define('BUTTON_SUBMIT', 'Wählen');
define('ENTRY_CURRENCY','Währung: ');
define('ENTRY_ADMIN','Bestellung erfasst von:');
define('TEXT_CS','Kundendienst');

define('ACCOUNT_EXTRAS','Kontoextras');
define('ENTRY_ACCOUNT_PASSWORD','Passwort');
define('ENTRY_NEWSLETTER_SUBSCRIBE','Newsletter');
define('ENTRY_ACCOUNT_PASSWORD_TEXT','');
define('ENTRY_NEWSLETTER_SUBSCRIBE_TEXT','1 = abonniert, oder 0 (Null) = nicht abonniert.');
define('CATEGORY_ORDER_DETAILS', 'Währung wählen:');
define('TEXT_CREATE_ORDER', 'Bestellung erfassen');

define('IMAGE_BUTTON_CONFIRM', 'Bestätigen');
?>