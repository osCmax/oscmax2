<?php
/*
$Id: gv_send.php 3 2006-05-27 04:59:07Z user $

  The Exchange Project - Community Made Shopping!
  http://www.theexchangeproject.org

  Gift Voucher System v1.0
  Copyright 2006 osCMax2001,2002 Ian C Wilson
  http://www.phesis.org

  Released under the GNU General Public License
*/

define('HEADING_TITLE', 'Gutschein versenden');
define('NAVBAR_TITLE', 'Gutschein versende');
define('EMAIL_SUBJECT', 'Nachricht von ' . STORE_NAME);
define('HEADING_TEXT','<br>Bitte füllen Sie hier Ihre persönlichen Angaben zum Gutschein aus, falls Sie FRagen bezüglich der Gutscheinfunktion haben, helfen wir Ihnen unter <a href="' . tep_href_link(FILENAME_GV_FAQ,'','NONSSL').'">'.GV_FAQ.'.</a> gerne weiter.<br>');
define('ENTRY_NAME', 'NAme des Empfängers:');
define('ENTRY_EMAIL', 'E-Mail Adresse des Empfängers:');
define('ENTRY_MESSAGE', 'Ihre Nachricht an den Empfänger:');
define('ENTRY_AMOUNT', 'Wert des Gutscheins:');
define('ERROR_ENTRY_AMOUNT_CHECK', '&nbsp;&nbsp;<span class="errorText">Ungültiger Wert</span>');
define('ERROR_ENTRY_EMAIL_ADDRESS_CHECK', '&nbsp;&nbsp;<span class="errorText">Ungültige E-Mail Addresse</span>');
define('MAIN_MESSAGE', 'Sie möchten einen Gutschein über %s an %s ( E-Mmail Adresse lautet %s )<br><br>Folgender Text erscheint in Ihrer E-Mail :<br><br>Hallo %s<br><br>
                        dies ist ein Geschenkgutschein über %s von %s');

define('PERSONAL_MESSAGE', '%s schreibt: ');
define('TEXT_SUCCESS', 'Glückwunsch, Ihr Gutschein wurde versendet !');


define('EMAIL_SEPARATOR', '----------------------------------------------------------------------------------------');
define('EMAIL_GV_TEXT_HEADER', 'Herzlichen Glückwunsch, Sie haben einen Gutschein über %s erhalten !');
define('EMAIL_GV_TEXT_SUBJECT', 'Ein Geschenk von %s');
define('EMAIL_GV_FROM', 'Dieser Gutschein wurde Ihnen übermittelt von %s');
define('EMAIL_GV_MESSAGE', 'Mit der Nachricht ');
define('EMAIL_GV_SEND_TO', 'Hallo, %s');
define('EMAIL_GV_REDEEM', 'Um diesen Gutschein einzulösen, klicken Sie bitte auf den unteren Link. Bitte notieren Sie sich zur Sicherheit Ihren Gutscheincode :  %s, so können wir Ihnen im FAlle eines Problems schneller helfen. Danke..');
define('EMAIL_GV_LINK', 'Um den Gutschein einzulösen klichen Sie bitte auf ');
define('EMAIL_GV_VISIT', ' oder besuchen Sie ');
define('EMAIL_GV_ENTER', ' und geben den Code am Ende Ihrer Bestellung ein. ');
define('EMAIL_GV_FIXED_FOOTER', 'Falls es mit dem obigen Link Probleme beim Einlösen kommen sollte, ' . "\n" .
                                'können Sie den Betrag während des Bestellvorganges verbuchen.' . "\n\n");
define('EMAIL_GV_SHOP_FOOTER', '');
?>