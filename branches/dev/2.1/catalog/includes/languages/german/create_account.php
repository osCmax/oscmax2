<?php
/*
$Id$

  osCmax e-Commerce
  http://www.oscmax.com

  Copyright 2000 - 2011 osCmax

  Released under the GNU General Public License
*/

define('NAVBAR_TITLE', 'Konto erstellen');
// PWA BOF
define('NAVBAR_TITLE_PWA', 'Rechnungs- und Versandinformationen');
define('HEADING_TITLE_PWA', 'Rechnungs- und Versandinformationen');
// PWA EOF

define('HEADING_TITLE', 'Informationen zu Ihrem Kundenkonto');

define('TEXT_ORIGIN_LOGIN', '<font color="#FF0000"><small><b>ACHTUNG:</b></font></small> Wenn Sie bereits ein Konto besitzen, so melden Sie sich bitte <a href="%s"><u><b>hier</b></u></a> an.');

define('EMAIL_ACCOUNT_DETAILS', 'Konto-Details: ');
define('EMAIL_ACCOUNT_USERNAME', 'Benutzername: ');
define('ACCOUNT_PASSWORD', 'Kennwort: ');
define('EMAIL_SUBJECT', 'Willkommen zu ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Sehr geehrter Herr ' . stripslashes($_POST['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_MS', 'Sehr geehrte Frau ' . stripslashes($_POST['lastname']) . ',' . "\n\n");
define('EMAIL_GREET_NONE', 'Sehr geehrte ' . stripslashes($_POST['firstname']) . ',' . "\n\n");
define('EMAIL_WELCOME', 'willkommen zu <b>' . STORE_NAME . '</b>.' . "\n\n");
define('EMAIL_TEXT', 'Sie können jetzt unseren <b>Online-Service</b> nutzen. Der Service bietet unter anderem:' . "\n\n" . '<li><b>Kundenwarenkorb</b> - Jeder Artikel bleibt registriert bis Sie zur Kasse gehen, oder die Produkte aus dem Warenkorb entfernen.' . "\n" . '<li><b>Adressbuch</b> - Wir können jetzt die Produkte zu der von Ihnen ausgesuchten Adresse senden. Der perfekte Weg ein Geburtstagsgeschenk zu versenden.' . "\n" . '<li><b>Vorherige Bestellungen</b> - Sie können jederzeit Ihre vorherigen Bestellungen überprüfen.' . "\n" . '<li><b>Meinungen über Produkte</b> - Teilen Sie Ihre Meinung zu unseren Produkten mit anderen Kunden.' . "\n\n");
define('EMAIL_CONTACT', 'Falls Sie Fragen zu unserem Kunden-Service haben, wenden Sie sich bitte an den Vertrieb: ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n\n");
define('EMAIL_WARNING', '<b>Achtung:</b> Diese eMail-Adresse wurde uns von einem Kunden bekannt gegeben. Falls Sie sich nicht angemeldet haben, senden Sie bitte eine eMail an ' . STORE_OWNER_EMAIL_ADDRESS . '.' . "\n");
// BOF - MOD: CREDIT CLASS Gift Voucher Contribution
define('EMAIL_GV_INCENTIVE_HEADER', 'Als Wilkommensgeschenk f&ur Neukunden haben wir Ihnen einen Gutschein im Wert von %s &uuml;bersandt');
define('EMAIL_GV_REDEEM', 'Der Gutscheincode lautet %s und kann entweder bei Ihrem nächsten Einkauf eingelöst werden,');
define('EMAIL_GV_LINK', 'oder wenn Sie diesem Link folgen ');
define('EMAIL_COUPON_INCENTIVE_HEADER', 'Herzlichen Glückwunsch! Um Ihren ersten Einkauf in unserem Onlineshop noch lohnender für Sie zu machen, übersenden wir Ihnen einen Gutschein.' . "\n" . ' Nachstehend finden Sie die Details Ihres pers&ouml;hnlichen Gutscheins' . "\n\n");
define('EMAIL_COUPON_REDEEM', 'Geben Sie einfach Ihren persönlichen Code   %s wShrend des Bezahlvorganges ' . "\n" . 'ein');
// EOF - MOD: CREDIT CLASS Gift Voucher Contribution
define('TERMS_PART_1', 'Bitte best&auml;tigen Sie, da&szlig; Sie unsere AGB gelesen und akzeptiert haben.');
define('TERMS_PART_2', '<b><u>Allgemeine Gesch&auml;ftsbedingungen anzeigen</u></b>');

define('ENTRY_NEWSLETTER_TYPE', 'E-Mail Format:');
?>
